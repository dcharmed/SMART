<?php
//Include Common Files @1-3C50B250
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "ticketdetails.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @2-C518F6CD
include_once(RelativePath . "/Admin/adminheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsRecordsmart_ticket { //smart_ticket Class @5-5C9491E3

//Variables @5-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @5-94D15995
    function clsRecordsmart_ticket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->DataSource = new clssmart_ticketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_ticket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->tckt_refnumber = & new clsControl(ccsTextBox, "tckt_refnumber", "Ref. Number", ccsText, "", CCGetRequestParam("tckt_refnumber", $Method, NULL), $this);
			$this->tckt_refnumber->Required = true;
            $this->tckt_status = & new clsControl(ccsListBox, "tckt_status", "Status", ccsText, "", CCGetRequestParam("tckt_status", $Method, NULL), $this);
            $this->tckt_status->DSType = dsTable;
            $this->tckt_status->DataSource = new clsDBSMART();
            $this->tckt_status->ds = & $this->tckt_status->DataSource;
            $this->tckt_status->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->tckt_status->DataSource->Order = "ref_rank";
            list($this->tckt_status->BoundColumn, $this->tckt_status->TextColumn, $this->tckt_status->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_status->DataSource->Parameters["expr73"] = tcktstatus;
            $this->tckt_status->DataSource->wp = new clsSQLParameters();
            $this->tckt_status->DataSource->wp->AddParameter("1", "expr73", ccsText, "", "", $this->tckt_status->DataSource->Parameters["expr73"], "", false);
            $this->tckt_status->DataSource->wp->Criterion[1] = $this->tckt_status->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_status->DataSource->wp->GetDBValue("1"), $this->tckt_status->DataSource->ToSQL($this->tckt_status->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_status->DataSource->Where = 
                 $this->tckt_status->DataSource->wp->Criterion[1];
            $this->tckt_status->DataSource->Order = "ref_rank";
            $this->tckt_r_date = & new clsControl(ccsTextBox, "tckt_r_date", "Date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_r_date", $Method, NULL), $this);
            $this->tckt_r_date->Required = true;
            $this->DatePicker_tckt_r_date = & new clsDatePicker("DatePicker_tckt_r_date", "smart_ticket", "tckt_r_date", $this);

			$this->tckt_toppanid = & new clsControl(ccsListBox, "tckt_toppanid", "tckt_toppanid", ccsText, "", CCGetRequestParam("tckt_toppanid", $Method, NULL), $this);
            $this->tckt_toppanid->DSType = dsTable;
            $this->tckt_toppanid->DataSource = new clsDBSMART();
            $this->tckt_toppanid->ds = & $this->tckt_toppanid->DataSource;
            $this->tckt_toppanid->DataSource->SQL = "SELECT * \n" .
"FROM smart_eqtoppan {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_toppanid->BoundColumn, $this->tckt_toppanid->TextColumn, $this->tckt_toppanid->DBFormat) = array("eqtop_toppan", "eqtop_toppan", "");
			$this->tckt_toppanid->Required = false;

            $this->tckt_esc = & new clsControl(ccsListBox, "tckt_esc", "Esc", ccsText, "", CCGetRequestParam("tckt_esc", $Method, NULL), $this);
			$this->tckt_esc->DSType = dsTable;
            $this->tckt_esc->DataSource = new clsDBSMART();
            $this->tckt_esc->ds = & $this->tckt_esc->DataSource;
            $this->tckt_esc->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_esc->BoundColumn, $this->tckt_esc->TextColumn, $this->tckt_esc->DBFormat) = array("ref_value", "ref_value", "");
            $this->tckt_esc->DataSource->Parameters["expr83"] = esc;
            $this->tckt_esc->DataSource->wp = new clsSQLParameters();
            $this->tckt_esc->DataSource->wp->AddParameter("1", "expr83", ccsText, "", "", $this->tckt_esc->DataSource->Parameters["expr83"], "", false);
            $this->tckt_esc->DataSource->wp->Criterion[1] = $this->tckt_esc->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_esc->DataSource->wp->GetDBValue("1"), $this->tckt_esc->DataSource->ToSQL($this->tckt_esc->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_esc->DataSource->Where = 
                 $this->tckt_esc->DataSource->wp->Criterion[1];
            $this->tckt_esc->Required = false;

			$this->tckt_equipment = & new clsControl(ccsListBox, "tckt_equipment", "tckt_equipment", ccsText, "", CCGetRequestParam("tckt_equipment", $Method, NULL), $this);
            $this->tckt_equipment->DSType = dsTable;
            $this->tckt_equipment->DataSource = new clsDBSMART();
            $this->tckt_equipment->ds = & $this->tckt_equipment->DataSource;
            $this->tckt_equipment->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_equipment->BoundColumn, $this->tckt_equipment->TextColumn, $this->tckt_equipment->DBFormat) = array("eqpmt_code", "eqpmt_name", "");
			$this->tckt_equipment->Required = false;

            $this->tckt_eqpmtserial = & new clsControl(ccsTextBox, "tckt_eqpmtserial", "Eqpmtserial", ccsText, "", CCGetRequestParam("tckt_eqpmtserial", $Method, NULL), $this);
            $this->tckt_description = & new clsControl(ccsTextArea, "tckt_description", "Description", ccsMemo, "", CCGetRequestParam("tckt_description", $Method, NULL), $this);
            $this->tckt_description->Required = true;
            $this->tckt_severity = & new clsControl(ccsListBox, "tckt_severity", "Severity", ccsInteger, "", CCGetRequestParam("tckt_severity", $Method, NULL), $this);
            $this->tckt_severity->DSType = dsTable;
            $this->tckt_severity->DataSource = new clsDBSMART();
            $this->tckt_severity->ds = & $this->tckt_severity->DataSource;
            $this->tckt_severity->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_severity->BoundColumn, $this->tckt_severity->TextColumn, $this->tckt_severity->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_severity->DataSource->Parameters["expr83"] = tcktseverity;
            $this->tckt_severity->DataSource->wp = new clsSQLParameters();
            $this->tckt_severity->DataSource->wp->AddParameter("1", "expr83", ccsText, "", "", $this->tckt_severity->DataSource->Parameters["expr83"], "", false);
            $this->tckt_severity->DataSource->wp->Criterion[1] = $this->tckt_severity->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_severity->DataSource->wp->GetDBValue("1"), $this->tckt_severity->DataSource->ToSQL($this->tckt_severity->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_severity->DataSource->Where = 
                 $this->tckt_severity->DataSource->wp->Criterion[1];
            $this->tckt_severity->Required = true;
            $this->raised_date = & new clsControl(ccsLabel, "raised_date", "raised_date", ccsDate, array("GeneralDate"), CCGetRequestParam("raised_date", $Method, NULL), $this);
			$this->raised_date->Required = true;
            $this->bygroupid = & new clsControl(ccsListBox, "bygroupid", "bygroupid", ccsText, "", CCGetRequestParam("bygroupid", $Method, NULL), $this);
            $this->bygroupid->DSType = dsListOfValues;
            $this->bygroupid->Values = array(array("3", "Engineers"), array("5", "Helpdesk"), array("6", "Adukom"));
            $this->customer = & new clsControl(ccsTextBox, "customer", "Raised: Customer", ccsText, "", CCGetRequestParam("customer", $Method, NULL), $this);
			$this->customer->Required = true;
			$this->bycontact = & new clsControl(ccsTextBox, "bycontact", "Raised : Contact", ccsText, "", CCGetRequestParam("bycontact", $Method, NULL), $this);
			$this->bycontact->Required = true;
			$this->bycontact2 = & new clsControl(ccsTextBox, "bycontact2", "Raised : Contact 2", ccsText, "", CCGetRequestParam("bycontact2", $Method, NULL), $this);
			$this->bycontact2->Required = false;
            $this->tckt_c_date = & new clsControl(ccsTextBox, "tckt_c_date", "Close Date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_c_date", $Method, NULL), $this);
            $this->closedby = & new clsControl(ccsTextBox, "closedby", "Closed: Customer", ccsText, "", CCGetRequestParam("closedby", $Method, NULL), $this);
			$this->closedby->Required = false;
            $this->closedadukom = & new clsControl(ccsTextBox, "closedadukom", "closedadukom", ccsText, "", CCGetRequestParam("closedadukom", $Method, NULL), $this);
            $this->closedreportedbyid = & new clsControl(ccsHidden, "closedreportedbyid", "Closed: Helpdesk", ccsText, "", CCGetRequestParam("closedreportedbyid", $Method, NULL), $this);
			$this->closedreportedbyid->Required = false;
			$this->closedreportedbyname = & new clsControl(ccsTextBox, "closedreportedbyname", "Closed: Helpdesk", ccsText, "", CCGetRequestParam("closedreportedbyname", $Method, NULL), $this);
			$this->closedreportedbyname->Required = false;
			$this->DatePicker_tckt_c_date = & new clsDatePicker("DatePicker_tckt_c_date", "smart_ticket", "tckt_c_date", $this);
            $this->state = & new clsControl(ccsListBox, "state", "State", ccsText, "", CCGetRequestParam("state", $Method, NULL), $this);
            $this->state->DSType = dsTable;
            $this->state->DataSource = new clsDBSMART();
            $this->state->ds = & $this->state->DataSource;
            $this->state->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->state->DataSource->Order = "ref_rank";
            list($this->state->BoundColumn, $this->state->TextColumn, $this->state->DBFormat) = array("ref_value", "ref_description", "");
            $this->state->DataSource->Parameters["expr62"] = state;
            $this->state->DataSource->wp = new clsSQLParameters();
            $this->state->DataSource->wp->AddParameter("1", "expr62", ccsText, "", "", $this->state->DataSource->Parameters["expr62"], "", false);
            $this->state->DataSource->wp->Criterion[1] = $this->state->DataSource->wp->Operation(opEqual, "ref_type", $this->state->DataSource->wp->GetDBValue("1"), $this->state->DataSource->ToSQL($this->state->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->state->DataSource->Where = 
                 $this->state->DataSource->wp->Criterion[1];
            $this->state->DataSource->Order = "ref_rank";
			$this->state->Required = true;
            $this->tckt_branch = & new clsControl(ccsListBox, "tckt_branch", "Branch", ccsText, "", CCGetRequestParam("tckt_branch", $Method, NULL), $this);
            $this->tckt_branch->DSType = dsTable;
            $this->tckt_branch->DataSource = new clsDBSMART();
            $this->tckt_branch->ds = & $this->tckt_branch->DataSource;
            $this->tckt_branch->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_branch->BoundColumn, $this->tckt_branch->TextColumn, $this->tckt_branch->DBFormat) = array("ref_value", "ref_value", "");
            $this->tckt_branch->Required = true;
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->tckt_related = & new clsControl(ccsListBox, "tckt_related", "tckt_related", ccsText, "", CCGetRequestParam("tckt_related", $Method, NULL), $this);
            $this->tckt_related->DSType = dsTable;
            $this->tckt_related->DataSource = new clsDBSMART();
            $this->tckt_related->ds = & $this->tckt_related->DataSource;
            $this->tckt_related->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_related->BoundColumn, $this->tckt_related->TextColumn, $this->tckt_related->DBFormat) = array("ref_value", "ref_description", "");
            $this->lblTicketNumber = & new clsControl(ccsLabel, "lblTicketNumber", "lblTicketNumber", ccsText, "", CCGetRequestParam("lblTicketNumber", $Method, NULL), $this);
            $this->EditStatus = & new clsPanel("EditStatus", $this);
            $this->linkStatus = & new clsControl(ccsLink, "linkStatus", "linkStatus", ccsText, "", CCGetRequestParam("linkStatus", $Method, NULL), $this);
            $this->linkStatus->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->linkStatus->Page = "#";
            $this->tckt_category = & new clsControl(ccsListBox, "tckt_category", "Category", ccsText, "", CCGetRequestParam("tckt_category", $Method, NULL), $this);
            $this->tckt_category->DSType = dsTable;
            $this->tckt_category->DataSource = new clsDBSMART();
            $this->tckt_category->ds = & $this->tckt_category->DataSource;
            $this->tckt_category->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->tckt_category->DataSource->Order = "ref_rank";
            list($this->tckt_category->BoundColumn, $this->tckt_category->TextColumn, $this->tckt_category->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_category->DataSource->Parameters["expr57"] = probcat;
            $this->tckt_category->DataSource->wp = new clsSQLParameters();
            $this->tckt_category->DataSource->wp->AddParameter("1", "expr57", ccsText, "", "", $this->tckt_category->DataSource->Parameters["expr57"], "", false);
            $this->tckt_category->DataSource->wp->Criterion[1] = $this->tckt_category->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_category->DataSource->wp->GetDBValue("1"), $this->tckt_category->DataSource->ToSQL($this->tckt_category->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_category->DataSource->Where = 
                 $this->tckt_category->DataSource->wp->Criterion[1];
            $this->tckt_category->DataSource->Order = "ref_rank";
            $this->tckt_category->Required = false;
            $this->tckt_subcat = & new clsControl(ccsListBox, "tckt_subcat", "tckt_subcat", ccsText, "", CCGetRequestParam("tckt_subcat", $Method, NULL), $this);
            $this->tckt_subcat->DSType = dsTable;
            $this->tckt_subcat->DataSource = new clsDBSMART();
            $this->tckt_subcat->ds = & $this->tckt_subcat->DataSource;
            $this->tckt_subcat->DataSource->SQL = "SELECT ref_value, ref_description, ref_type \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->tckt_subcat->DataSource->Order = "ref_rank";
            list($this->tckt_subcat->BoundColumn, $this->tckt_subcat->TextColumn, $this->tckt_subcat->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_subcat->DataSource->Order = "ref_rank";
            $this->hid_status = & new clsControl(ccsHidden, "hid_status", "hid_status", ccsText, "", CCGetRequestParam("hid_status", $Method, NULL), $this);
            $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", $Method, NULL), $this);
            $this->byadukom = & new clsControl(ccsTextBox, "byadukom", "Adukom #", ccsText, "", CCGetRequestParam("byadukom", $Method, NULL), $this);
            $this->reportedby = & new clsControl(ccsHidden, "reportedby", "Raised : Helpdesk", ccsText, "", CCGetRequestParam("reportedby", $Method, NULL), $this);
			$this->reportedby->Required = false;
			$this->helpdeskName = & new clsControl(ccsTextBox, "helpdeskName", "Raised : Helpdesk", ccsText, "", CCGetRequestParam("helpdeskName", $Method, NULL), $this);
			$this->helpdeskName->Required = false;
            $this->tckt_engineer = & new clsControl(ccsTextBox, "tckt_engineer", "Ticket Eng", ccsText, "", CCGetRequestParam("tckt_engineer", $Method, NULL), $this);
			$this->tckt_engineer->Required = false;
			$this->lblNoteRef = & new clsControl(ccsLabel, "lblNoteRef", "lblNoteRef", ccsText, "", CCGetRequestParam("lblNoteRef", $Method, NULL), $this);
			$this->byEngineer = & new clsControl(ccsListBox, "byEngineer", "byEngineer", ccsText, "", CCGetRequestParam("byEngineer", $Method, NULL), $this);
            $this->byEngineer->DSType = dsTable;
            $this->byEngineer->DataSource = new clsDBSMART();
            $this->byEngineer->ds = & $this->byEngineer->DataSource;
            $this->byEngineer->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->byEngineer->BoundColumn, $this->byEngineer->TextColumn, $this->byEngineer->DBFormat) = array("id", "usr_username", "");
            $this->byEngineer->DataSource->Parameters["expr300"] = 3;
            $this->byEngineer->DataSource->wp = new clsSQLParameters();
            $this->byEngineer->DataSource->wp->AddParameter("1", "expr300", ccsInteger, "", "", $this->byEngineer->DataSource->Parameters["expr300"], "", false);
            $this->byEngineer->DataSource->wp->Criterion[1] = $this->byEngineer->DataSource->wp->Operation(opEqual, "usr_group", $this->byEngineer->DataSource->wp->GetDBValue("1"), $this->byEngineer->DataSource->ToSQL($this->byEngineer->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->byEngineer->DataSource->Where = 
                 $this->byEngineer->DataSource->wp->Criterion[1];
            $this->byadukomid = & new clsControl(ccsTextBox, "byadukomid", "Adukom ID", ccsText, "", CCGetRequestParam("byadukomid", $Method, NULL), $this);
            $this->EditStatus->AddComponent("linkStatus", $this->linkStatus);
            if(!$this->FormSubmitted) {
                if(!is_array($this->tckt_r_date->Value) && !strlen($this->tckt_r_date->Value) && $this->tckt_r_date->Value !== false)
                    $this->tckt_r_date->SetValue(time());
                if(!is_array($this->tckt_c_date->Value) && !strlen($this->tckt_c_date->Value) && $this->tckt_c_date->Value !== false)
                    $this->tckt_c_date->SetValue(time());
                if(!is_array($this->hid_status->Value) && !strlen($this->hid_status->Value) && $this->hid_status->Value !== false)
                    $this->hid_status->SetText(1);
                if(!is_array($this->byadukom->Value) && !strlen($this->byadukom->Value) && $this->byadukom->Value !== false)
                    $this->byadukom->SetText("");
                if(!is_array($this->byadukomid->Value) && !strlen($this->byadukomid->Value) && $this->byadukomid->Value !== false)
                    $this->byadukomid->SetText("");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @5-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @5-C0A40143
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tckt_refnumber->Validate() && $Validation);
        $Validation = ($this->tckt_status->Validate() && $Validation);
        $Validation = ($this->tckt_r_date->Validate() && $Validation);
        $Validation = ($this->tckt_esc->Validate() && $Validation);
        $Validation = ($this->tckt_description->Validate() && $Validation);
        $Validation = ($this->tckt_severity->Validate() && $Validation);
        $Validation = ($this->bygroupid->Validate() && $Validation);
        $Validation = ($this->bycontact->Validate() && $Validation);
        $Validation = ($this->tckt_c_date->Validate() && $Validation);
        $Validation = ($this->closedby->Validate() && $Validation);
        $Validation = ($this->closedadukom->Validate() && $Validation);
        $Validation = ($this->closedreportedbyname->Validate() && $Validation);
        $Validation = ($this->state->Validate() && $Validation);
        $Validation = ($this->tckt_branch->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->tckt_related->Validate() && $Validation);
        $Validation = ($this->tckt_category->Validate() && $Validation);
        $Validation = ($this->hid_status->Validate() && $Validation);
        $Validation = ($this->id->Validate() && $Validation);
        $Validation = ($this->byadukom->Validate() && $Validation);
        $Validation = ($this->reportedby->Validate() && $Validation);
        $Validation = ($this->byEngineer->Validate() && $Validation);
        $Validation = ($this->byadukomid->Validate() && $Validation);
        $Validation = ($this->customer->Validate() && $Validation);
        $Validation = ($this->helpdeskName->Validate() && $Validation);
        $Validation = ($this->closedreportedbyid->Validate() && $Validation);
        $Validation = ($this->tckt_equipment->Validate() && $Validation);
        $Validation = ($this->tckt_eqpmtserial->Validate() && $Validation);
        $Validation = ($this->tckt_toppanid->Validate() && $Validation);
        $Validation = ($this->tckt_subcat->Validate() && $Validation);
        $Validation = ($this->tckt_engineer->Validate() && $Validation);
        $Validation = ($this->bycontact2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tckt_refnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_r_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_esc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_severity->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bygroupid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bycontact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_c_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedadukom->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedreportedbyname->Errors->Count() == 0);
        $Validation =  $Validation && ($this->state->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_related->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_category->Errors->Count() == 0);
        $Validation =  $Validation && ($this->hid_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->byadukom->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reportedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->byEngineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->byadukomid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->helpdeskName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedreportedbyid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_equipment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_eqpmtserial->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_toppanid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_subcat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_engineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bycontact2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-017E5F3A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_esc->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->raised_date->Errors->Count());
        $errors = ($errors || $this->bygroupid->Errors->Count());
        $errors = ($errors || $this->bycontact->Errors->Count());
        $errors = ($errors || $this->tckt_c_date->Errors->Count());
        $errors = ($errors || $this->closedby->Errors->Count());
        $errors = ($errors || $this->closedadukom->Errors->Count());
        $errors = ($errors || $this->closedreportedbyname->Errors->Count());
        $errors = ($errors || $this->DatePicker_tckt_c_date->Errors->Count());
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->tckt_branch->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->tckt_related->Errors->Count());
        $errors = ($errors || $this->lblTicketNumber->Errors->Count());
        $errors = ($errors || $this->linkStatus->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->hid_status->Errors->Count());
        $errors = ($errors || $this->id->Errors->Count());
        $errors = ($errors || $this->byadukom->Errors->Count());
        $errors = ($errors || $this->reportedby->Errors->Count());
        $errors = ($errors || $this->byEngineer->Errors->Count());
        $errors = ($errors || $this->byadukomid->Errors->Count());
        $errors = ($errors || $this->customer->Errors->Count());
        $errors = ($errors || $this->helpdeskName->Errors->Count());
        $errors = ($errors || $this->closedreportedbyid->Errors->Count());
        $errors = ($errors || $this->tckt_equipment->Errors->Count());
        $errors = ($errors || $this->tckt_eqpmtserial->Errors->Count());
        $errors = ($errors || $this->tckt_toppanid->Errors->Count());
        $errors = ($errors || $this->lblNoteRef->Errors->Count());
        $errors = ($errors || $this->tckt_subcat->Errors->Count());
        $errors = ($errors || $this->tckt_engineer->Errors->Count());
        $errors = ($errors || $this->bycontact2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @5-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @5-13AE15C8
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "tcktid", "id", "new", "s_status"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @5-DBFBC41B
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->tckt_refnumber->SetValue($this->tckt_refnumber->GetValue(true));
        $this->DataSource->tckt_status->SetValue($this->tckt_status->GetValue(true));
        $this->DataSource->tckt_r_date->SetValue($this->tckt_r_date->GetValue(true));
        $this->DataSource->tckt_esc->SetValue($this->tckt_esc->GetValue(true));
        $this->DataSource->tckt_description->SetValue($this->tckt_description->GetValue(true));
        $this->DataSource->tckt_severity->SetValue($this->tckt_severity->GetValue(true));
        $this->DataSource->raised_date->SetValue($this->raised_date->GetValue(true));
        $this->DataSource->bygroupid->SetValue($this->bygroupid->GetValue(true));
        $this->DataSource->bycontact->SetValue($this->bycontact->GetValue(true));
        $this->DataSource->tckt_c_date->SetValue($this->tckt_c_date->GetValue(true));
        $this->DataSource->closedby->SetValue($this->closedby->GetValue(true));
        $this->DataSource->closedadukom->SetValue($this->closedadukom->GetValue(true));
        $this->DataSource->closedreportedbyname->SetValue($this->closedreportedbyname->GetValue(true));
        $this->DataSource->state->SetValue($this->state->GetValue(true));
        $this->DataSource->tckt_branch->SetValue($this->tckt_branch->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->tckt_related->SetValue($this->tckt_related->GetValue(true));
        $this->DataSource->lblTicketNumber->SetValue($this->lblTicketNumber->GetValue(true));
        $this->DataSource->linkStatus->SetValue($this->linkStatus->GetValue(true));
        $this->DataSource->tckt_category->SetValue($this->tckt_category->GetValue(true));
        $this->DataSource->hid_status->SetValue($this->hid_status->GetValue(true));
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->byadukom->SetValue($this->byadukom->GetValue(true));
        $this->DataSource->reportedby->SetValue($this->reportedby->GetValue(true));
        $this->DataSource->byEngineer->SetValue($this->byEngineer->GetValue(true));
        $this->DataSource->byadukomid->SetValue($this->byadukomid->GetValue(true));
        $this->DataSource->customer->SetValue($this->customer->GetValue(true));
        $this->DataSource->helpdeskName->SetValue($this->helpdeskName->GetValue(true));
        $this->DataSource->closedreportedbyid->SetValue($this->closedreportedbyid->GetValue(true));
        $this->DataSource->tckt_equipment->SetValue($this->tckt_equipment->GetValue(true));
        $this->DataSource->tckt_eqpmtserial->SetValue($this->tckt_eqpmtserial->GetValue(true));
        $this->DataSource->tckt_toppanid->SetValue($this->tckt_toppanid->GetValue(true));
        $this->DataSource->lblNoteRef->SetValue($this->lblNoteRef->GetValue(true));
        $this->DataSource->tckt_subcat->SetValue($this->tckt_subcat->GetValue(true));
        $this->DataSource->tckt_engineer->SetValue($this->tckt_engineer->GetValue(true));
        $this->DataSource->bycontact2->SetValue($this->bycontact2->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @5-0C1AA057
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->tckt_refnumber->SetValue($this->tckt_refnumber->GetValue(true));
        $this->DataSource->tckt_status->SetValue($this->tckt_status->GetValue(true));
        $this->DataSource->tckt_r_date->SetValue($this->tckt_r_date->GetValue(true));
        $this->DataSource->tckt_esc->SetValue($this->tckt_esc->GetValue(true));
        $this->DataSource->tckt_description->SetValue($this->tckt_description->GetValue(true));
        $this->DataSource->tckt_severity->SetValue($this->tckt_severity->GetValue(true));
        $this->DataSource->raised_date->SetValue($this->raised_date->GetValue(true));
        $this->DataSource->bygroupid->SetValue($this->bygroupid->GetValue(true));
        $this->DataSource->bycontact->SetValue($this->bycontact->GetValue(true));
        $this->DataSource->tckt_c_date->SetValue($this->tckt_c_date->GetValue(true));
        $this->DataSource->closedby->SetValue($this->closedby->GetValue(true));
        $this->DataSource->closedadukom->SetValue($this->closedadukom->GetValue(true));
        $this->DataSource->closedreportedbyname->SetValue($this->closedreportedbyname->GetValue(true));
        $this->DataSource->state->SetValue($this->state->GetValue(true));
        $this->DataSource->tckt_branch->SetValue($this->tckt_branch->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->tckt_related->SetValue($this->tckt_related->GetValue(true));
        $this->DataSource->lblTicketNumber->SetValue($this->lblTicketNumber->GetValue(true));
        $this->DataSource->linkStatus->SetValue($this->linkStatus->GetValue(true));
        $this->DataSource->tckt_category->SetValue($this->tckt_category->GetValue(true));
        $this->DataSource->hid_status->SetValue($this->hid_status->GetValue(true));
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->byadukom->SetValue($this->byadukom->GetValue(true));
        $this->DataSource->reportedby->SetValue($this->reportedby->GetValue(true));
        $this->DataSource->byEngineer->SetValue($this->byEngineer->GetValue(true));
        $this->DataSource->byadukomid->SetValue($this->byadukomid->GetValue(true));
        $this->DataSource->customer->SetValue($this->customer->GetValue(true));
        $this->DataSource->helpdeskName->SetValue($this->helpdeskName->GetValue(true));
        $this->DataSource->closedreportedbyid->SetValue($this->closedreportedbyid->GetValue(true));
        $this->DataSource->tckt_equipment->SetValue($this->tckt_equipment->GetValue(true));
        $this->DataSource->tckt_eqpmtserial->SetValue($this->tckt_eqpmtserial->GetValue(true));
        $this->DataSource->tckt_toppanid->SetValue($this->tckt_toppanid->GetValue(true));
        $this->DataSource->lblNoteRef->SetValue($this->lblNoteRef->GetValue(true));
        $this->DataSource->tckt_subcat->SetValue($this->tckt_subcat->GetValue(true));
        $this->DataSource->tckt_engineer->SetValue($this->tckt_engineer->GetValue(true));
        $this->DataSource->bycontact2->SetValue($this->bycontact2->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @5-5D882E2F
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->tckt_status->Prepare();
        $this->tckt_esc->Prepare();
        $this->tckt_severity->Prepare();
        $this->bygroupid->Prepare();
        $this->state->Prepare();
        $this->tckt_branch->Prepare();
        $this->tckt_related->Prepare();
        $this->tckt_category->Prepare();
        $this->byEngineer->Prepare();
        $this->tckt_equipment->Prepare();
        $this->tckt_toppanid->Prepare();
        $this->tckt_subcat->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->raised_date->SetValue($this->DataSource->raised_date->GetValue());
                $this->lblTicketNumber->SetValue($this->DataSource->lblTicketNumber->GetValue());
                if(!$this->FormSubmitted){
                    $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                    $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                    $this->tckt_esc->SetValue($this->DataSource->tckt_esc->GetValue());
                    $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                    $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                    $this->bygroupid->SetValue($this->DataSource->bygroupid->GetValue());
                    $this->bycontact->SetValue($this->DataSource->bycontact->GetValue());
                    $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
                    $this->closedby->SetValue($this->DataSource->closedby->GetValue());
                    $this->closedadukom->SetValue($this->DataSource->closedadukom->GetValue());
                    $this->state->SetValue($this->DataSource->state->GetValue());
                    $this->tckt_branch->SetValue($this->DataSource->tckt_branch->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->tckt_related->SetValue($this->DataSource->tckt_related->GetValue());
                    $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
                    $this->hid_status->SetValue($this->DataSource->hid_status->GetValue());
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->byadukom->SetValue($this->DataSource->byadukom->GetValue());
                    $this->reportedby->SetValue($this->DataSource->reportedby->GetValue());
                    $this->byEngineer->SetValue($this->DataSource->byEngineer->GetValue());
                    $this->byadukomid->SetValue($this->DataSource->byadukomid->GetValue());
                    $this->customer->SetValue($this->DataSource->customer->GetValue());
                    $this->closedreportedbyid->SetValue($this->DataSource->closedreportedbyid->GetValue());
                    $this->tckt_equipment->SetValue($this->DataSource->tckt_equipment->GetValue());
                    $this->tckt_eqpmtserial->SetValue($this->DataSource->tckt_eqpmtserial->GetValue());
                    $this->tckt_toppanid->SetValue($this->DataSource->tckt_toppanid->GetValue());
                    $this->tckt_subcat->SetValue($this->DataSource->tckt_subcat->GetValue());
                    $this->bycontact2->SetValue($this->DataSource->bycontact2->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tckt_refnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_esc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_severity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->raised_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bygroupid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bycontact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_c_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedadukom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedreportedbyname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tckt_c_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_related->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblTicketNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->linkStatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_category->Errors->ToString());
            $Error = ComposeStrings($Error, $this->hid_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byadukom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reportedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byEngineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byadukomid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->helpdeskName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedreportedbyid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_equipment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_eqpmtserial->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_toppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblNoteRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_subcat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bycontact2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->tckt_refnumber->Show();
        $this->tckt_status->Show();
        $this->tckt_r_date->Show();
        $this->DatePicker_tckt_r_date->Show();
        $this->tckt_esc->Show();
        $this->tckt_description->Show();
        $this->tckt_severity->Show();
        $this->raised_date->Show();
        $this->bygroupid->Show();
        $this->bycontact->Show();
        $this->tckt_c_date->Show();
        $this->closedby->Show();
        $this->closedadukom->Show();
        $this->closedreportedbyname->Show();
        $this->DatePicker_tckt_c_date->Show();
        $this->state->Show();
        $this->tckt_branch->Show();
        $this->datemodified->Show();
        $this->tckt_related->Show();
        $this->lblTicketNumber->Show();
        $this->EditStatus->Show();
        $this->tckt_category->Show();
        $this->hid_status->Show();
        $this->id->Show();
        $this->byadukom->Show();
        $this->reportedby->Show();
        $this->byEngineer->Show();
        $this->byadukomid->Show();
        $this->customer->Show();
        $this->helpdeskName->Show();
        $this->closedreportedbyid->Show();
        $this->tckt_equipment->Show();
        $this->tckt_eqpmtserial->Show();
        $this->tckt_toppanid->Show();
        $this->lblNoteRef->Show();
        $this->tckt_subcat->Show();
        $this->tckt_engineer->Show();
        $this->bycontact2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_ticket Class @5-FCB6E20C

class clssmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @5-6569B5AD

//DataSource Variables @5-44FF9BD7
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_r_date;
    var $tckt_esc;
    var $tckt_description;
    var $tckt_severity;
    var $raised_date;
    var $bygroupid;
    var $bycontact;
    var $tckt_c_date;
    var $closedby;
    var $closedadukom;
    var $closedreportedbyname;
    var $state;
    var $tckt_branch;
    var $datemodified;
    var $tckt_related;
    var $lblTicketNumber;
    var $linkStatus;
    var $tckt_category;
    var $hid_status;
    var $id;
    var $byadukom;
    var $reportedby;
    var $byEngineer;
    var $byadukomid;
    var $customer;
    var $helpdeskName;
    var $closedreportedbyid;
    var $tckt_equipment;
    var $tckt_eqpmtserial;
    var $tckt_toppanid;
    var $lblNoteRef;
    var $tckt_subcat;
    var $tckt_engineer;
    var $bycontact2;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-8856FFE2
    function clssmart_ticketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_esc = new clsField("tckt_esc", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->raised_date = new clsField("raised_date", ccsDate, $this->DateFormat);
        
        $this->bygroupid = new clsField("bygroupid", ccsText, "");
        
        $this->bycontact = new clsField("bycontact", ccsText, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->closedby = new clsField("closedby", ccsText, "");
        
        $this->closedadukom = new clsField("closedadukom", ccsText, "");
        
        $this->closedreportedbyname = new clsField("closedreportedbyname", ccsText, "");
        
        $this->state = new clsField("state", ccsText, "");
        
        $this->tckt_branch = new clsField("tckt_branch", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->tckt_related = new clsField("tckt_related", ccsText, "");
        
        $this->lblTicketNumber = new clsField("lblTicketNumber", ccsText, "");
        
        $this->linkStatus = new clsField("linkStatus", ccsText, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->hid_status = new clsField("hid_status", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->byadukom = new clsField("byadukom", ccsText, "");
        
        $this->reportedby = new clsField("reportedby", ccsText, "");
        
        $this->byEngineer = new clsField("byEngineer", ccsText, "");
        
        $this->byadukomid = new clsField("byadukomid", ccsText, "");
        
        $this->customer = new clsField("customer", ccsText, "");
        
        $this->helpdeskName = new clsField("helpdeskName", ccsText, "");
        
        $this->closedreportedbyid = new clsField("closedreportedbyid", ccsText, "");
        
        $this->tckt_equipment = new clsField("tckt_equipment", ccsText, "");
        
        $this->tckt_eqpmtserial = new clsField("tckt_eqpmtserial", ccsText, "");
        
        $this->tckt_toppanid = new clsField("tckt_toppanid", ccsText, "");
        
        $this->lblNoteRef = new clsField("lblNoteRef", ccsText, "");
        
        $this->tckt_subcat = new clsField("tckt_subcat", ccsText, "");
        
        $this->tckt_engineer = new clsField("tckt_engineer", ccsText, "");
        
        $this->bycontact2 = new clsField("bycontact2", ccsText, "");
        

        $this->InsertFields["tckt_refnumber"] = array("Name" => "tckt_refnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_date"] = array("Name" => "tckt_r_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_escalate"] = array("Name" => "tckt_escalate", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_description"] = array("Name" => "tckt_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_severity"] = array("Name" => "tckt_severity", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_byusertype"] = array("Name" => "tckt_r_byusertype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_customercontact"] = array("Name" => "tckt_r_customercontact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_c_date"] = array("Name" => "tckt_c_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_c_byuser"] = array("Name" => "tckt_c_byuser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_c_adukomid"] = array("Name" => "tckt_c_adukomid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_state"] = array("Name" => "tckt_state", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_site"] = array("Name" => "tckt_site", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_tagrelated"] = array("Name" => "tckt_tagrelated", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_category"] = array("Name" => "tckt_category", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_status"] = array("Name" => "tckt_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_adukomn"] = array("Name" => "tckt_adukomn", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_helpdesk"] = array("Name" => "tckt_r_helpdesk", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_engineer"] = array("Name" => "tckt_r_engineer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_adukomid"] = array("Name" => "tckt_r_adukomid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_customer"] = array("Name" => "tckt_r_customer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_c_helpdesk"] = array("Name" => "tckt_c_helpdesk", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_equipment"] = array("Name" => "tckt_equipment", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_eqpmtserial"] = array("Name" => "tckt_eqpmtserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_toppanid"] = array("Name" => "tckt_toppanid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_subcategory"] = array("Name" => "tckt_subcategory", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tckt_r_customercontact2"] = array("Name" => "tckt_r_customercontact2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_refnumber"] = array("Name" => "tckt_refnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_date"] = array("Name" => "tckt_r_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_escalate"] = array("Name" => "tckt_escalate", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_description"] = array("Name" => "tckt_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_severity"] = array("Name" => "tckt_severity", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_byusertype"] = array("Name" => "tckt_r_byusertype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_customercontact"] = array("Name" => "tckt_r_customercontact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_date"] = array("Name" => "tckt_c_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_byuser"] = array("Name" => "tckt_c_byuser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_adukomid"] = array("Name" => "tckt_c_adukomid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_state"] = array("Name" => "tckt_state", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_site"] = array("Name" => "tckt_site", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_tagrelated"] = array("Name" => "tckt_tagrelated", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_category"] = array("Name" => "tckt_category", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_status"] = array("Name" => "tckt_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_adukomn"] = array("Name" => "tckt_adukomn", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_helpdesk"] = array("Name" => "tckt_r_helpdesk", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_engineer"] = array("Name" => "tckt_r_engineer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_adukomid"] = array("Name" => "tckt_r_adukomid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_customer"] = array("Name" => "tckt_r_customer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_helpdesk"] = array("Name" => "tckt_c_helpdesk", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_equipment"] = array("Name" => "tckt_equipment", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_eqpmtserial"] = array("Name" => "tckt_eqpmtserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_toppanid"] = array("Name" => "tckt_toppanid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_subcategory"] = array("Name" => "tckt_subcategory", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_r_customercontact2"] = array("Name" => "tckt_r_customercontact2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @5-35B33087
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-3B622B64
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-A01A92D1
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_esc->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->raised_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->bygroupid->SetDBValue($this->f("tckt_r_byusertype"));
        $this->bycontact->SetDBValue($this->f("tckt_r_customercontact"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->closedby->SetDBValue($this->f("tckt_c_byuser"));
        $this->closedadukom->SetDBValue($this->f("tckt_c_adukomid"));
        $this->state->SetDBValue($this->f("tckt_state"));
        $this->tckt_branch->SetDBValue($this->f("tckt_site"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->tckt_related->SetDBValue($this->f("tckt_tagrelated"));
        $this->lblTicketNumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->hid_status->SetDBValue($this->f("tckt_status"));
        $this->id->SetDBValue(trim($this->f("id")));
        $this->byadukom->SetDBValue($this->f("tckt_adukomn"));
        $this->reportedby->SetDBValue($this->f("tckt_r_helpdesk"));
        $this->byEngineer->SetDBValue($this->f("tckt_r_engineer"));
        $this->byadukomid->SetDBValue($this->f("tckt_r_adukomid"));
        $this->customer->SetDBValue($this->f("tckt_r_customer"));
        $this->closedreportedbyid->SetDBValue($this->f("tckt_c_helpdesk"));
        $this->tckt_equipment->SetDBValue($this->f("tckt_equipment"));
        $this->tckt_eqpmtserial->SetDBValue($this->f("tckt_eqpmtserial"));
        $this->tckt_toppanid->SetDBValue($this->f("tckt_toppanid"));
        $this->tckt_subcat->SetDBValue($this->f("tckt_subcategory"));
        $this->bycontact2->SetDBValue($this->f("tckt_r_customercontact2"));
    }
//End SetValues Method

//Insert Method @5-56A89CD0
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["tckt_refnumber"]["Value"] = $this->tckt_refnumber->GetDBValue(true);
        $this->InsertFields["tckt_r_date"]["Value"] = $this->tckt_r_date->GetDBValue(true);
        $this->InsertFields["tckt_escalate"]["Value"] = $this->tckt_esc->GetDBValue(true);
        $this->InsertFields["tckt_description"]["Value"] = $this->tckt_description->GetDBValue(true);
        $this->InsertFields["tckt_severity"]["Value"] = $this->tckt_severity->GetDBValue(true);
        $this->InsertFields["tckt_r_byusertype"]["Value"] = $this->bygroupid->GetDBValue(true);
        $this->InsertFields["tckt_r_customercontact"]["Value"] = $this->bycontact->GetDBValue(true);
        $this->InsertFields["tckt_c_date"]["Value"] = $this->tckt_c_date->GetDBValue(true);
        $this->InsertFields["tckt_c_byuser"]["Value"] = $this->closedby->GetDBValue(true);
        $this->InsertFields["tckt_c_adukomid"]["Value"] = $this->closedadukom->GetDBValue(true);
        $this->InsertFields["tckt_state"]["Value"] = $this->state->GetDBValue(true);
        $this->InsertFields["tckt_site"]["Value"] = $this->tckt_branch->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["tckt_tagrelated"]["Value"] = $this->tckt_related->GetDBValue(true);
        $this->InsertFields["tckt_category"]["Value"] = $this->tckt_category->GetDBValue(true);
        $this->InsertFields["tckt_status"]["Value"] = $this->hid_status->GetDBValue(true);
        $this->InsertFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->InsertFields["tckt_adukomn"]["Value"] = $this->byadukom->GetDBValue(true);
        $this->InsertFields["tckt_r_helpdesk"]["Value"] = $this->reportedby->GetDBValue(true);
        $this->InsertFields["tckt_r_engineer"]["Value"] = $this->byEngineer->GetDBValue(true);
        $this->InsertFields["tckt_r_adukomid"]["Value"] = $this->byadukomid->GetDBValue(true);
        $this->InsertFields["tckt_r_customer"]["Value"] = $this->customer->GetDBValue(true);
        $this->InsertFields["tckt_c_helpdesk"]["Value"] = $this->closedreportedbyid->GetDBValue(true);
        $this->InsertFields["tckt_equipment"]["Value"] = $this->tckt_equipment->GetDBValue(true);
        $this->InsertFields["tckt_eqpmtserial"]["Value"] = $this->tckt_eqpmtserial->GetDBValue(true);
        $this->InsertFields["tckt_toppanid"]["Value"] = $this->tckt_toppanid->GetDBValue(true);
        $this->InsertFields["tckt_subcategory"]["Value"] = $this->tckt_subcat->GetDBValue(true);
        $this->InsertFields["tckt_r_customercontact2"]["Value"] = $this->bycontact2->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_ticket", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-32E7B7C1
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["tckt_refnumber"]["Value"] = $this->tckt_refnumber->GetDBValue(true);
        $this->UpdateFields["tckt_r_date"]["Value"] = $this->tckt_r_date->GetDBValue(true);
        $this->UpdateFields["tckt_escalate"]["Value"] = $this->tckt_esc->GetDBValue(true);
        $this->UpdateFields["tckt_description"]["Value"] = $this->tckt_description->GetDBValue(true);
        $this->UpdateFields["tckt_severity"]["Value"] = $this->tckt_severity->GetDBValue(true);
        $this->UpdateFields["tckt_r_byusertype"]["Value"] = $this->bygroupid->GetDBValue(true);
        $this->UpdateFields["tckt_r_customercontact"]["Value"] = $this->bycontact->GetDBValue(true);
        $this->UpdateFields["tckt_c_date"]["Value"] = $this->tckt_c_date->GetDBValue(true);
        $this->UpdateFields["tckt_c_byuser"]["Value"] = $this->closedby->GetDBValue(true);
        $this->UpdateFields["tckt_c_adukomid"]["Value"] = $this->closedadukom->GetDBValue(true);
        $this->UpdateFields["tckt_state"]["Value"] = $this->state->GetDBValue(true);
        $this->UpdateFields["tckt_site"]["Value"] = $this->tckt_branch->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["tckt_tagrelated"]["Value"] = $this->tckt_related->GetDBValue(true);
        $this->UpdateFields["tckt_category"]["Value"] = $this->tckt_category->GetDBValue(true);
        $this->UpdateFields["tckt_status"]["Value"] = $this->hid_status->GetDBValue(true);
        $this->UpdateFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->UpdateFields["tckt_adukomn"]["Value"] = $this->byadukom->GetDBValue(true);
        $this->UpdateFields["tckt_r_helpdesk"]["Value"] = $this->reportedby->GetDBValue(true);
        $this->UpdateFields["tckt_r_engineer"]["Value"] = $this->byEngineer->GetDBValue(true);
        $this->UpdateFields["tckt_r_adukomid"]["Value"] = $this->byadukomid->GetDBValue(true);
        $this->UpdateFields["tckt_r_customer"]["Value"] = $this->customer->GetDBValue(true);
        $this->UpdateFields["tckt_c_helpdesk"]["Value"] = $this->closedreportedbyid->GetDBValue(true);
        $this->UpdateFields["tckt_equipment"]["Value"] = $this->tckt_equipment->GetDBValue(true);
        $this->UpdateFields["tckt_eqpmtserial"]["Value"] = $this->tckt_eqpmtserial->GetDBValue(true);
        $this->UpdateFields["tckt_toppanid"]["Value"] = $this->tckt_toppanid->GetDBValue(true);
        $this->UpdateFields["tckt_subcategory"]["Value"] = $this->tckt_subcat->GetDBValue(true);
        $this->UpdateFields["tckt_r_customercontact2"]["Value"] = $this->bycontact2->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_ticket", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End smart_ticketDataSource Class @5-FCB6E20C

class clsGridGResNote { //GResNote class @158-86129332

//Variables @158-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @158-793E9D03
    function clsGridGResNote($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GResNote";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GResNote";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGResNoteDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->rsltn_date = & new clsControl(ccsLink, "rsltn_date", "rsltn_date", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_date", ccsGet, NULL), $this);
        $this->rsltn_date->Page = "ticketdetails.php";
        $this->rsltn_type = & new clsControl(ccsLabel, "rsltn_type", "rsltn_type", ccsText, "", CCGetRequestParam("rsltn_type", ccsGet, NULL), $this);
        $this->rsltn_id = & new clsControl(ccsHidden, "rsltn_id", "rsltn_id", ccsText, "", CCGetRequestParam("rsltn_id", ccsGet, NULL), $this);
        $this->ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("id", "FormFilter", "Panel1", "new", "rid", "ccsForm"));
        $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "tcktid", CCGetFromGet("id", NULL));
        $this->ImageLink2->Page = "cmactivity.php";
        $this->lblTicketNumberResNote = & new clsControl(ccsLabel, "lblTicketNumberResNote", "lblTicketNumberResNote", ccsText, "", CCGetRequestParam("lblTicketNumberResNote", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @158-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @158-1551B483
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["rsltn_date"] = $this->rsltn_date->Visible;
            $this->ControlsVisible["rsltn_type"] = $this->rsltn_type->Visible;
            $this->ControlsVisible["rsltn_id"] = $this->rsltn_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
                $this->rsltn_date->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
                $this->rsltn_date->Parameters = CCAddParam($this->rsltn_date->Parameters, "rid", $this->DataSource->f("id"));
                $this->rsltn_date->Parameters = CCAddParam($this->rsltn_date->Parameters, "id", CCGetFromGet("id", NULL));
                $this->rsltn_type->SetValue($this->DataSource->rsltn_type->GetValue());
                $this->rsltn_id->SetValue($this->DataSource->rsltn_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->rsltn_date->Show();
                $this->rsltn_type->Show();
                $this->rsltn_id->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->ImageLink2->Show();
        $this->lblTicketNumberResNote->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @158-C99E3414
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GResNote Class @158-FCB6E20C

class clsGResNoteDataSource extends clsDBSMART {  //GResNoteDataSource Class @158-CE76CF79

//DataSource Variables @158-249EB7AB
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $rsltn_date;
    var $rsltn_type;
    var $rsltn_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @158-6A269EDF
    function clsGResNoteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GResNote";
        $this->Initialize();
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        
        $this->rsltn_id = new clsField("rsltn_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @158-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @158-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @158-1FF328B0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_resolutionnote";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_resolutionnote {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @158-0974C042
    function SetValues()
    {
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
        $this->rsltn_id->SetDBValue($this->f("id"));
    }
//End SetValues Method

} //End GResNoteDataSource Class @158-FCB6E20C

class clsRecordRResNote { //RResNote Class @95-5027327E

//Variables @95-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @95-F7668D35
    function clsRecordRResNote($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RResNote/Error";
        $this->DataSource = new clsRResNoteDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RResNote";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->rsltn_date = & new clsControl(ccsTextBox, "rsltn_date", "Date", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_date", $Method, NULL), $this);
            $this->rsltn_date->Required = true;
            $this->DatePicker_rsltn_date = & new clsDatePicker("DatePicker_rsltn_date", "RResNote", "rsltn_date", $this);
            $this->engName = & new clsControl(ccsTextBox, "engName", "Engineer Name", ccsInteger, "", CCGetRequestParam("engName", $Method, NULL), $this);
            $this->rsltn_actiontaken = & new clsControl(ccsTextArea, "rsltn_actiontaken", "Action taken", ccsMemo, "", CCGetRequestParam("rsltn_actiontaken", $Method, NULL), $this);
            $this->rsltn_actiontaken->Required = true;
            $this->rsltn_actionmethod = & new clsControl(ccsRadioButton, "rsltn_actionmethod", "Action method", ccsText, "", CCGetRequestParam("rsltn_actionmethod", $Method, NULL), $this);
            $this->rsltn_actionmethod->DSType = dsListOfValues;
            $this->rsltn_actionmethod->Values = array(array("1", "Phone Call"), array("2", "Visit Site"), array("3", "Remote"), array("4", "Others"));
            $this->rsltn_actionmethod->HTML = true;
            $this->rsltn_actionmethod->Required = true;
            $this->rsltn_planning = & new clsControl(ccsTextArea, "rsltn_planning", "Rsltn Planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", $Method, NULL), $this);
            $this->rsltn_remark = & new clsControl(ccsTextArea, "rsltn_remark", "Rsltn Remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", $Method, NULL), $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->rsltn_byuser = & new clsControl(ccsHidden, "rsltn_byuser", "By Engineer", ccsInteger, "", CCGetRequestParam("rsltn_byuser", $Method, NULL), $this);
            $this->rsltn_type = & new clsControl(ccsHidden, "rsltn_type", "rsltn_type", ccsText, "", CCGetRequestParam("rsltn_type", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->rsltn_date->Value) && !strlen($this->rsltn_date->Value) && $this->rsltn_date->Value !== false)
                    $this->rsltn_date->SetValue(time());
                if(!is_array($this->rsltn_type->Value) && !strlen($this->rsltn_type->Value) && $this->rsltn_type->Value !== false)
                    $this->rsltn_type->SetText(SN);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @95-6750067F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
        $this->DataSource->Parameters["expr281"] = SN;
    }
//End Initialize Method

//Validate Method @95-6898B251
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->rsltn_date->Validate() && $Validation);
        $Validation = ($this->engName->Validate() && $Validation);
        $Validation = ($this->rsltn_actiontaken->Validate() && $Validation);
        $Validation = ($this->rsltn_actionmethod->Validate() && $Validation);
        $Validation = ($this->rsltn_planning->Validate() && $Validation);
        $Validation = ($this->rsltn_remark->Validate() && $Validation);
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->rsltn_byuser->Validate() && $Validation);
        $Validation = ($this->rsltn_type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->rsltn_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->engName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_actiontaken->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_actionmethod->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_planning->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @95-D0C8D2B7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_rsltn_date->Errors->Count());
        $errors = ($errors || $this->engName->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->rsltn_actionmethod->Errors->Count());
        $errors = ($errors || $this->rsltn_planning->Errors->Count());
        $errors = ($errors || $this->rsltn_remark->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_type->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @95-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @95-B40B657B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "rid"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @95-9D7AD0D4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->engName->SetValue($this->engName->GetValue(true));
        $this->DataSource->rsltn_actiontaken->SetValue($this->rsltn_actiontaken->GetValue(true));
        $this->DataSource->rsltn_actionmethod->SetValue($this->rsltn_actionmethod->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rsltn_byuser->SetValue($this->rsltn_byuser->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @95-BD80A681
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->engName->SetValue($this->engName->GetValue(true));
        $this->DataSource->rsltn_actiontaken->SetValue($this->rsltn_actiontaken->GetValue(true));
        $this->DataSource->rsltn_actionmethod->SetValue($this->rsltn_actionmethod->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rsltn_byuser->SetValue($this->rsltn_byuser->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @95-5A1F87DF
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->rsltn_actionmethod->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
                    $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
                    $this->rsltn_actionmethod->SetValue($this->DataSource->rsltn_actionmethod->GetValue());
                    $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                    $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
                    $this->rsltn_type->SetValue($this->DataSource->rsltn_type->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->rsltn_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rsltn_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->engName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_actiontaken->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_actionmethod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->rsltn_date->Show();
        $this->DatePicker_rsltn_date->Show();
        $this->engName->Show();
        $this->rsltn_actiontaken->Show();
        $this->rsltn_actionmethod->Show();
        $this->rsltn_planning->Show();
        $this->rsltn_remark->Show();
        $this->ticket_id->Show();
        $this->rsltn_byuser->Show();
        $this->rsltn_type->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RResNote Class @95-FCB6E20C

class clsRResNoteDataSource extends clsDBSMART {  //RResNoteDataSource Class @95-82172127

//DataSource Variables @95-0C339352
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $rsltn_date;
    var $engName;
    var $rsltn_actiontaken;
    var $rsltn_actionmethod;
    var $rsltn_planning;
    var $rsltn_remark;
    var $ticket_id;
    var $rsltn_byuser;
    var $rsltn_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @95-2BBD1F8E
    function clsRResNoteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RResNote/Error";
        $this->Initialize();
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->engName = new clsField("engName", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_actionmethod = new clsField("rsltn_actionmethod", ccsText, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        

        $this->InsertFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @95-A82C359A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->AddParameter("2", "expr281", ccsText, "", "", $this->Parameters["expr281"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "rsltn_type", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @95-7105B5E9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_resolutionnote {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @95-DACFEA07
    function SetValues()
    {
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_actionmethod->SetDBValue($this->f("rsltn_actionmethod"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
    }
//End SetValues Method

//Insert Method @95-F5A1BEC2
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->InsertFields["rsltn_actiontaken"]["Value"] = $this->rsltn_actiontaken->GetDBValue(true);
        $this->InsertFields["rsltn_actionmethod"]["Value"] = $this->rsltn_actionmethod->GetDBValue(true);
        $this->InsertFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->InsertFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["rsltn_byuser"]["Value"] = $this->rsltn_byuser->GetDBValue(true);
        $this->InsertFields["rsltn_type"]["Value"] = $this->rsltn_type->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_resolutionnote", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @95-B3E4FF1D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->UpdateFields["rsltn_actiontaken"]["Value"] = $this->rsltn_actiontaken->GetDBValue(true);
        $this->UpdateFields["rsltn_actionmethod"]["Value"] = $this->rsltn_actionmethod->GetDBValue(true);
        $this->UpdateFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->UpdateFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["rsltn_byuser"]["Value"] = $this->rsltn_byuser->GetDBValue(true);
        $this->UpdateFields["rsltn_type"]["Value"] = $this->rsltn_type->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_resolutionnote", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End RResNoteDataSource Class @95-FCB6E20C

class clsRecordsmart_task { //smart_task Class @90-BFD8BE96

//Variables @90-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @90-5FAC3F22
    function clsRecordsmart_task($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_task/Error";
        $this->DataSource = new clssmart_taskDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_task";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->task_newstatus = & new clsControl(ccsListBox, "task_newstatus", "Task Newstatus", ccsInteger, "", CCGetRequestParam("task_newstatus", $Method, NULL), $this);
            $this->task_newstatus->DSType = dsTable;
            $this->task_newstatus->DataSource = new clsDBSMART();
            $this->task_newstatus->ds = & $this->task_newstatus->DataSource;
            $this->task_newstatus->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->task_newstatus->DataSource->Order = "ref_rank";
            list($this->task_newstatus->BoundColumn, $this->task_newstatus->TextColumn, $this->task_newstatus->DBFormat) = array("ref_value", "ref_description", "");
            $this->task_newstatus->DataSource->Order = "ref_rank";
            $this->task_newstatus->Required = true;
            $this->task_personincharge = & new clsControl(ccsListBox, "task_personincharge", "Task Personincharge", ccsText, "", CCGetRequestParam("task_personincharge", $Method, NULL), $this);
            $this->task_personincharge->DSType = dsTable;
            $this->task_personincharge->DataSource = new clsDBSMART();
            $this->task_personincharge->ds = & $this->task_personincharge->DataSource;
            $this->task_personincharge->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->task_personincharge->BoundColumn, $this->task_personincharge->TextColumn, $this->task_personincharge->DBFormat) = array("id", "usr_fullname", "");
            $this->task_personincharge->DataSource->Parameters["expr15"] = 3;
            $this->task_personincharge->DataSource->Parameters["expr16"] = 5;
            $this->task_personincharge->DataSource->wp = new clsSQLParameters();
            $this->task_personincharge->DataSource->wp->AddParameter("1", "expr15", ccsInteger, "", "", $this->task_personincharge->DataSource->Parameters["expr15"], "", false);
            $this->task_personincharge->DataSource->wp->AddParameter("2", "expr16", ccsInteger, "", "", $this->task_personincharge->DataSource->Parameters["expr16"], "", false);
            $this->task_personincharge->DataSource->wp->Criterion[1] = $this->task_personincharge->DataSource->wp->Operation(opEqual, "usr_group", $this->task_personincharge->DataSource->wp->GetDBValue("1"), $this->task_personincharge->DataSource->ToSQL($this->task_personincharge->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->task_personincharge->DataSource->wp->Criterion[2] = $this->task_personincharge->DataSource->wp->Operation(opEqual, "usr_group", $this->task_personincharge->DataSource->wp->GetDBValue("2"), $this->task_personincharge->DataSource->ToSQL($this->task_personincharge->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->task_personincharge->DataSource->Where = $this->task_personincharge->DataSource->wp->opOR(
                 false, 
                 $this->task_personincharge->DataSource->wp->Criterion[1], 
                 $this->task_personincharge->DataSource->wp->Criterion[2]);

            $this->task_secpersonincharge = & new clsControl(ccsListBox, "task_secpersonincharge", "Task Secpersonincharge", ccsText, "", CCGetRequestParam("task_secpersonincharge", $Method, NULL), $this);
            $this->task_secpersonincharge->DSType = dsTable;
            $this->task_secpersonincharge->DataSource = new clsDBSMART();
            $this->task_secpersonincharge->ds = & $this->task_secpersonincharge->DataSource;
            $this->task_secpersonincharge->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->task_secpersonincharge->BoundColumn, $this->task_secpersonincharge->TextColumn, $this->task_secpersonincharge->DBFormat) = array("id", "usr_fullname", "");
            $this->task_secpersonincharge->DataSource->Parameters["expr101"] = 3;
            $this->task_secpersonincharge->DataSource->wp = new clsSQLParameters();
            $this->task_secpersonincharge->DataSource->wp->AddParameter("1", "expr101", ccsInteger, "", "", $this->task_secpersonincharge->DataSource->Parameters["expr101"], "", false);
            $this->task_secpersonincharge->DataSource->wp->Criterion[1] = $this->task_secpersonincharge->DataSource->wp->Operation(opEqual, "usr_group", $this->task_secpersonincharge->DataSource->wp->GetDBValue("1"), $this->task_secpersonincharge->DataSource->ToSQL($this->task_secpersonincharge->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->task_secpersonincharge->DataSource->Where = 
                 $this->task_secpersonincharge->DataSource->wp->Criterion[1];
            $this->task_adukomid = & new clsControl(ccsTextBox, "task_adukomid", "Task Adukomid", ccsInteger, "", CCGetRequestParam("task_adukomid", $Method, NULL), $this);
            $this->currentstatus = & new clsControl(ccsTextBox, "currentstatus", "currentstatus", ccsText, "", CCGetRequestParam("currentstatus", $Method, NULL), $this);
            $this->task_currentstatus = & new clsControl(ccsHidden, "task_currentstatus", "Task Currentstatus", ccsInteger, "", CCGetRequestParam("task_currentstatus", $Method, NULL), $this);
            $this->Reason = & new clsControl(ccsTextArea, "Reason", "Reason", ccsText, "", CCGetRequestParam("Reason", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
			$this->tckt_closeddate = & new clsControl(ccsHidden, "tckt_closeddate", "tckt_closeddate", ccsText, "", CCGetRequestParam("tckt_closeddate", $Method, NULL), $this);
			$this->closedby = & new clsControl(ccsHidden, "closedby", "closedby", ccsText, "", CCGetRequestParam("closedby", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @90-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @90-BDFF6893
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->task_newstatus->Validate() && $Validation);
        $Validation = ($this->task_personincharge->Validate() && $Validation);
        $Validation = ($this->task_secpersonincharge->Validate() && $Validation);
        $Validation = ($this->task_adukomid->Validate() && $Validation);
        $Validation = ($this->currentstatus->Validate() && $Validation);
        $Validation = ($this->task_currentstatus->Validate() && $Validation);
        $Validation = ($this->Reason->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->tckt_closeddate->Validate() && $Validation);
        $Validation = ($this->closedby->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_newstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_personincharge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_secpersonincharge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_adukomid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->currentstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_currentstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Reason->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_closeddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedby->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @90-F464BE99
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->task_newstatus->Errors->Count());
        $errors = ($errors || $this->task_personincharge->Errors->Count());
        $errors = ($errors || $this->task_secpersonincharge->Errors->Count());
        $errors = ($errors || $this->task_adukomid->Errors->Count());
        $errors = ($errors || $this->currentstatus->Errors->Count());
        $errors = ($errors || $this->task_currentstatus->Errors->Count());
        $errors = ($errors || $this->Reason->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->tckt_closeddate->Errors->Count());
        $errors = ($errors || $this->closedby->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @90-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @90-CB9DB1A8
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Insert" : "Button_Cancel";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @90-63A56C04
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->task_newstatus->SetValue($this->task_newstatus->GetValue(true));
        $this->DataSource->task_adukomid->SetValue($this->task_adukomid->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->tckt_closeddate->SetValue($this->tckt_closeddate->GetValue(true));
        $this->DataSource->closedby->SetValue($this->closedby->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @90-53690B10
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->task_newstatus->Prepare();
        $this->task_personincharge->Prepare();
        $this->task_secpersonincharge->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->task_newstatus->SetValue($this->DataSource->task_newstatus->GetValue());
                    $this->task_personincharge->SetValue($this->DataSource->task_personincharge->GetValue());
                    $this->task_secpersonincharge->SetValue($this->DataSource->task_secpersonincharge->GetValue());
                    $this->task_adukomid->SetValue($this->DataSource->task_adukomid->GetValue());
                    $this->task_currentstatus->SetValue($this->DataSource->task_currentstatus->GetValue());
                    $this->Reason->SetValue($this->DataSource->Reason->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->closedby->SetValue($this->DataSource->closedby->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_newstatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_personincharge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_secpersonincharge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_adukomid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->currentstatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_currentstatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Reason->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_closeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $this->ticket_id->Show();
        $this->task_newstatus->Show();
        $this->task_personincharge->Show();
        $this->task_secpersonincharge->Show();
        $this->task_adukomid->Show();
        $this->currentstatus->Show();
        $this->task_currentstatus->Show();
        $this->Reason->Show();
        $this->datemodified->Show();
        $this->tckt_closeddate->Show();
        $this->closedby->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_task Class @90-FCB6E20C

class clssmart_taskDataSource extends clsDBSMART {  //smart_taskDataSource Class @90-EE694EE6

//DataSource Variables @90-72036C04
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $UpdateFields = array();

    // Datasource fields
    var $ticket_id;
    var $task_newstatus;
    var $task_personincharge;
    var $task_secpersonincharge;
    var $task_adukomid;
    var $currentstatus;
    var $task_currentstatus;
    var $Reason;
    var $datemodified;
    var $tckt_closeddate;
    var $closedby;
//End DataSource Variables

//DataSourceClass_Initialize Event @90-BF942DBF
    function clssmart_taskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_task/Error";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->task_newstatus = new clsField("task_newstatus", ccsInteger, "");
        
        $this->task_personincharge = new clsField("task_personincharge", ccsText, "");
        
        $this->task_secpersonincharge = new clsField("task_secpersonincharge", ccsText, "");
        
        $this->task_adukomid = new clsField("task_adukomid", ccsInteger, "");
        
        $this->currentstatus = new clsField("currentstatus", ccsText, "");
        
        $this->task_currentstatus = new clsField("task_currentstatus", ccsInteger, "");
        
        $this->Reason = new clsField("Reason", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        
        $this->tckt_closeddate = new clsField("tckt_closeddate", ccsText, "");
        
        $this->closedby = new clsField("closedby", ccsText, "");
        

        $this->UpdateFields["tckt_status"] = array("Name" => "tckt_status", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_adukomid"] = array("Name" => "tckt_c_adukomid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_date"] = array("Name" => "tckt_c_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tckt_c_helpdesk"] = array("Name" => "tckt_c_helpdesk", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @90-35B33087
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @90-F20E3239
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tckt_status, id, tckt_c_helpdesk, tckt_c_date, tckt_c_adukomid, tckt_c_byuser, datemodified \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @90-CA8E56D3
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->task_newstatus->SetDBValue(trim($this->f("task_status")));
        $this->task_personincharge->SetDBValue($this->f("task_currenteng"));
        $this->task_secpersonincharge->SetDBValue($this->f("task_updatedeng"));
        $this->task_adukomid->SetDBValue(trim($this->f("task_adukomid")));
        $this->task_currentstatus->SetDBValue(trim($this->f("tckt_status")));
        $this->Reason->SetDBValue($this->f("task_notes"));
        $this->datemodified->SetDBValue($this->f("datemodified"));
        $this->closedby->SetDBValue($this->f("tckt_c_helpdesk"));
    }
//End SetValues Method

//Update Method @90-6EBBE17E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["tckt_status"] = new clsSQLParameter("ctrltask_newstatus", ccsInteger, "", "", $this->task_newstatus->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["tckt_c_adukomid"] = new clsSQLParameter("ctrltask_adukomid", ccsText, "", "", $this->task_adukomid->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["datemodified"] = new clsSQLParameter("ctrldatemodified", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->datemodified->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["tckt_c_date"] = new clsSQLParameter("ctrltckt_closeddate", ccsText, "", "", $this->tckt_closeddate->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["tckt_c_helpdesk"] = new clsSQLParameter("ctrlclosedby", ccsInteger, "", "", $this->closedby->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlticket_id", ccsInteger, "", "", $this->ticket_id->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["tckt_status"]->GetValue()) and !strlen($this->cp["tckt_status"]->GetText()) and !is_bool($this->cp["tckt_status"]->GetValue())) 
            $this->cp["tckt_status"]->SetValue($this->task_newstatus->GetValue(true));
        if (!is_null($this->cp["tckt_c_adukomid"]->GetValue()) and !strlen($this->cp["tckt_c_adukomid"]->GetText()) and !is_bool($this->cp["tckt_c_adukomid"]->GetValue())) 
            $this->cp["tckt_c_adukomid"]->SetValue($this->task_adukomid->GetValue(true));
        if (!is_null($this->cp["datemodified"]->GetValue()) and !strlen($this->cp["datemodified"]->GetText()) and !is_bool($this->cp["datemodified"]->GetValue())) 
            $this->cp["datemodified"]->SetValue($this->datemodified->GetValue(true));
        if (!is_null($this->cp["tckt_c_date"]->GetValue()) and !strlen($this->cp["tckt_c_date"]->GetText()) and !is_bool($this->cp["tckt_c_date"]->GetValue())) 
            $this->cp["tckt_c_date"]->SetValue($this->tckt_closeddate->GetValue(true));
        if (!is_null($this->cp["tckt_c_helpdesk"]->GetValue()) and !strlen($this->cp["tckt_c_helpdesk"]->GetText()) and !is_bool($this->cp["tckt_c_helpdesk"]->GetValue())) 
            $this->cp["tckt_c_helpdesk"]->SetValue($this->closedby->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["tckt_status"]["Value"] = $this->cp["tckt_status"]->GetDBValue(true);
        $this->UpdateFields["tckt_c_adukomid"]["Value"] = $this->cp["tckt_c_adukomid"]->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->cp["datemodified"]->GetDBValue(true);
        $this->UpdateFields["tckt_c_date"]["Value"] = $this->cp["tckt_c_date"]->GetDBValue(true);
        $this->UpdateFields["tckt_c_helpdesk"]["Value"] = $this->cp["tckt_c_helpdesk"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_ticket", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End smart_taskDataSource Class @90-FCB6E20C







//Initialize Page @1-9E44FA09
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "ticketdetails.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-B86AF7A7
CCSecurityRedirect("1;5", "index.php");
//End Authenticate User

//Include events file @1-AB62F106
include_once("./ticketdetails_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-49ADDB2C
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$Panel1 = & new clsPanel("Panel1", $MainPage);
$smart_ticket = & new clsRecordsmart_ticket("", $MainPage);
$GResNote = & new clsGridGResNote("", $MainPage);
$RResNote = & new clsRecordRResNote("", $MainPage);
$Panel2 = & new clsPanel("Panel2", $MainPage);
$smart_task = & new clsRecordsmart_task("", $MainPage);
$ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("new", "id", "tcktid", "ccsForm"));
$ImageLink1->Page = "ticketlist.php";
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->Panel1 = & $Panel1;
$MainPage->smart_ticket = & $smart_ticket;
$MainPage->GResNote = & $GResNote;
$MainPage->RResNote = & $RResNote;
$MainPage->Panel2 = & $Panel2;
$MainPage->smart_task = & $smart_task;
$MainPage->ImageLink1 = & $ImageLink1;
$Panel1->AddComponent("smart_ticket", $smart_ticket);
$Panel1->AddComponent("GResNote", $GResNote);
$Panel1->AddComponent("RResNote", $RResNote);
$Panel2->AddComponent("smart_task", $smart_task);
$smart_ticket->Initialize();
$GResNote->Initialize();
$RResNote->Initialize();
$smart_task->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-F35C4500
$header->Operations();
$footer->Operations();
$smart_ticket->Operation();
$RResNote->Operation();
$smart_task->Operation();
//End Execute Components

//Go to destination page @1-F8510F78
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_ticket);
    unset($GResNote);
    unset($RResNote);
    unset($smart_task);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4DC8E843
$header->Show();
$footer->Show();
$Panel1->Show();
$Panel2->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8D5DCCBF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_ticket);
unset($GResNote);
unset($RResNote);
unset($smart_task);
unset($Tpl);
//End Unload Page


?>
