<?php
//Include Common Files @1-BF8D957D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "vticketdetails.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsRecordRSmartTicket { //RSmartTicket Class @5-115C70B3

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

//Class_Initialize Event @5-FF71769B
    function clsRecordRSmartTicket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSmartTicket/Error";
        $this->DataSource = new clsRSmartTicketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSmartTicket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->tckt_refnumber = & new clsControl(ccsTextBox, "tckt_refnumber", "Tckt Refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", $Method, NULL), $this);
            $this->tckt_r_date = & new clsControl(ccsTextBox, "tckt_r_date", "Tckt Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_r_date", $Method, NULL), $this);
            $this->tckt_r_date->Required = true;
            $this->tckt_toppanid = & new clsControl(ccsTextBox, "tckt_toppanid", "Tckt Toppanid", ccsText, "", CCGetRequestParam("tckt_toppanid", $Method, NULL), $this);
            $this->tckt_esc = & new clsControl(ccsListBox, "tckt_esc", "Tckt Esc", ccsText, "", CCGetRequestParam("tckt_esc", $Method, NULL), $this);
            $this->tckt_eqpmtserial = & new clsControl(ccsTextBox, "tckt_eqpmtserial", "Tckt Eqpmtserial", ccsText, "", CCGetRequestParam("tckt_eqpmtserial", $Method, NULL), $this);
            $this->tckt_description = & new clsControl(ccsTextArea, "tckt_description", "Tckt Description", ccsMemo, "", CCGetRequestParam("tckt_description", $Method, NULL), $this);
            $this->tckt_description->Required = true;
            $this->tckt_severity = & new clsControl(ccsListBox, "tckt_severity", "Tckt Severity", ccsInteger, "", CCGetRequestParam("tckt_severity", $Method, NULL), $this);
            $this->tckt_severity->DSType = dsTable;
            $this->tckt_severity->DataSource = new clsDBSMART();
            $this->tckt_severity->ds = & $this->tckt_severity->DataSource;
            $this->tckt_severity->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_severity->BoundColumn, $this->tckt_severity->TextColumn, $this->tckt_severity->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_severity->DataSource->Parameters["expr21"] = tcktseverity;
            $this->tckt_severity->DataSource->wp = new clsSQLParameters();
            $this->tckt_severity->DataSource->wp->AddParameter("1", "expr21", ccsText, "", "", $this->tckt_severity->DataSource->Parameters["expr21"], "", false);
            $this->tckt_severity->DataSource->wp->Criterion[1] = $this->tckt_severity->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_severity->DataSource->wp->GetDBValue("1"), $this->tckt_severity->DataSource->ToSQL($this->tckt_severity->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_severity->DataSource->Where = 
                 $this->tckt_severity->DataSource->wp->Criterion[1];
            $this->tckt_severity->Required = true;
            $this->raised_date = & new clsControl(ccsLabel, "raised_date", "raised_date", ccsDate, array("GeneralDate"), CCGetRequestParam("raised_date", $Method, NULL), $this);
            $this->helpdesk = & new clsControl(ccsLabel, "helpdesk", "helpdesk", ccsText, "", CCGetRequestParam("helpdesk", $Method, NULL), $this);
            $this->bycontact = & new clsControl(ccsLabel, "bycontact", "bycontact", ccsText, "", CCGetRequestParam("bycontact", $Method, NULL), $this);
            $this->tckt_c_date = & new clsControl(ccsLabel, "tckt_c_date", "Close Date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_c_date", $Method, NULL), $this);
            $this->closedby = & new clsControl(ccsLabel, "closedby", "closedby", ccsText, "", CCGetRequestParam("closedby", $Method, NULL), $this);
            $this->closedadukom = & new clsControl(ccsLabel, "closedadukom", "closedadukom", ccsText, "", CCGetRequestParam("closedadukom", $Method, NULL), $this);
            $this->closedreportedby = & new clsControl(ccsLabel, "closedreportedby", "closedreportedby", ccsText, "", CCGetRequestParam("closedreportedby", $Method, NULL), $this);
            $this->state = & new clsControl(ccsListBox, "state", "state", ccsText, "", CCGetRequestParam("state", $Method, NULL), $this);
            $this->state->DSType = dsTable;
            $this->state->DataSource = new clsDBSMART();
            $this->state->ds = & $this->state->DataSource;
            $this->state->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->state->DataSource->Order = "ref_rank";
            list($this->state->BoundColumn, $this->state->TextColumn, $this->state->DBFormat) = array("ref_value", "ref_description", "");
            $this->state->DataSource->Parameters["expr49"] = state;
            $this->state->DataSource->wp = new clsSQLParameters();
            $this->state->DataSource->wp->AddParameter("1", "expr49", ccsText, "", "", $this->state->DataSource->Parameters["expr49"], "", false);
            $this->state->DataSource->wp->Criterion[1] = $this->state->DataSource->wp->Operation(opEqual, "ref_type", $this->state->DataSource->wp->GetDBValue("1"), $this->state->DataSource->ToSQL($this->state->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->state->DataSource->Where = 
                 $this->state->DataSource->wp->Criterion[1];
            $this->state->DataSource->Order = "ref_rank";
            $this->tckt_branch = & new clsControl(ccsListBox, "tckt_branch", "Tckt Branch", ccsText, "", CCGetRequestParam("tckt_branch", $Method, NULL), $this);
            $this->tckt_branch->DSType = dsTable;
            $this->tckt_branch->DataSource = new clsDBSMART();
            $this->tckt_branch->ds = & $this->tckt_branch->DataSource;
            $this->tckt_branch->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_branch->BoundColumn, $this->tckt_branch->TextColumn, $this->tckt_branch->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_branch->Required = true;
            $this->tckt_related = & new clsControl(ccsListBox, "tckt_related", "tckt_related", ccsText, "", CCGetRequestParam("tckt_related", $Method, NULL), $this);
            $this->tckt_related->DSType = dsTable;
            $this->tckt_related->DataSource = new clsDBSMART();
            $this->tckt_related->ds = & $this->tckt_related->DataSource;
            $this->tckt_related->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->tckt_related->BoundColumn, $this->tckt_related->TextColumn, $this->tckt_related->DBFormat) = array("ref_value", "ref_description", "");
            $this->lblTicketNumber = & new clsControl(ccsLabel, "lblTicketNumber", "lblTicketNumber", ccsText, "", CCGetRequestParam("lblTicketNumber", $Method, NULL), $this);
            $this->tckt_category = & new clsControl(ccsListBox, "tckt_category", "Tckt Category", ccsText, "", CCGetRequestParam("tckt_category", $Method, NULL), $this);
            $this->tckt_category->DSType = dsTable;
            $this->tckt_category->DataSource = new clsDBSMART();
            $this->tckt_category->ds = & $this->tckt_category->DataSource;
            $this->tckt_category->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->tckt_category->DataSource->Order = "ref_rank";
            list($this->tckt_category->BoundColumn, $this->tckt_category->TextColumn, $this->tckt_category->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_category->DataSource->Parameters["expr62"] = probcat;
            $this->tckt_category->DataSource->wp = new clsSQLParameters();
            $this->tckt_category->DataSource->wp->AddParameter("1", "expr62", ccsText, "", "", $this->tckt_category->DataSource->Parameters["expr62"], "", false);
            $this->tckt_category->DataSource->wp->Criterion[1] = $this->tckt_category->DataSource->wp->Operation(opEqual, "ref_type", $this->tckt_category->DataSource->wp->GetDBValue("1"), $this->tckt_category->DataSource->ToSQL($this->tckt_category->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->tckt_category->DataSource->Where = 
                 $this->tckt_category->DataSource->wp->Criterion[1];
            $this->tckt_category->DataSource->Order = "ref_rank";
            $this->tckt_category->Required = true;
            $this->tckt_subcat = & new clsControl(ccsListBox, "tckt_subcat", "tckt_subcat", ccsText, "", CCGetRequestParam("tckt_subcat", $Method, NULL), $this);
            $this->tckt_subcat->DSType = dsTable;
            $this->tckt_subcat->DataSource = new clsDBSMART();
            $this->tckt_subcat->ds = & $this->tckt_subcat->DataSource;
            $this->tckt_subcat->DataSource->SQL = "SELECT ref_value, ref_description, ref_type \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->tckt_subcat->DataSource->Order = "ref_rank";
            list($this->tckt_subcat->BoundColumn, $this->tckt_subcat->TextColumn, $this->tckt_subcat->DBFormat) = array("ref_value", "ref_description", "");
            $this->tckt_subcat->DataSource->Order = "ref_rank";
            $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "tckt_status", ccsText, "", CCGetRequestParam("tckt_status", $Method, NULL), $this);
            $this->byEngineer = & new clsControl(ccsLabel, "byEngineer", "byEngineer", ccsText, "", CCGetRequestParam("byEngineer", $Method, NULL), $this);
            $this->byadukom = & new clsControl(ccsLabel, "byadukom", "Adukom #", ccsText, "", CCGetRequestParam("byadukom", $Method, NULL), $this);
            $this->byadukomid = & new clsControl(ccsLabel, "byadukomid", "Adukom ID", ccsText, "", CCGetRequestParam("byadukomid", $Method, NULL), $this);
            $this->customer = & new clsControl(ccsLabel, "customer", "customer", ccsText, "", CCGetRequestParam("customer", $Method, NULL), $this);
            $this->byusergroup = & new clsControl(ccsLabel, "byusergroup", "byusergroup", ccsText, "", CCGetRequestParam("byusergroup", $Method, NULL), $this);
            $this->bycontact1 = & new clsControl(ccsLabel, "bycontact1", "bycontact1", ccsText, "", CCGetRequestParam("bycontact1", $Method, NULL), $this);
            $this->tckt_engineer = & new clsControl(ccsTextBox, "tckt_engineer", "Engineer", ccsText, "", CCGetRequestParam("tckt_engineer", $Method, NULL), $this);
            $this->tckt_method = & new clsControl(ccsTextBox, "tckt_method", "tckt_method", ccsText, "", CCGetRequestParam("tckt_method", $Method, NULL), $this);
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

//Validate Method @5-435325F0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tckt_refnumber->Validate() && $Validation);
        $Validation = ($this->tckt_r_date->Validate() && $Validation);
        $Validation = ($this->tckt_toppanid->Validate() && $Validation);
        $Validation = ($this->tckt_esc->Validate() && $Validation);
        $Validation = ($this->tckt_eqpmtserial->Validate() && $Validation);
        $Validation = ($this->tckt_description->Validate() && $Validation);
        $Validation = ($this->tckt_severity->Validate() && $Validation);
        $Validation = ($this->state->Validate() && $Validation);
        $Validation = ($this->tckt_branch->Validate() && $Validation);
        $Validation = ($this->tckt_related->Validate() && $Validation);
        $Validation = ($this->tckt_category->Validate() && $Validation);
        $Validation = ($this->tckt_subcat->Validate() && $Validation);
        $Validation = ($this->tckt_engineer->Validate() && $Validation);
        $Validation = ($this->tckt_method->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tckt_refnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_r_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_toppanid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_esc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_eqpmtserial->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_severity->Errors->Count() == 0);
        $Validation =  $Validation && ($this->state->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_related->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_category->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_subcat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_engineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tckt_method->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-12EACB76
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_toppanid->Errors->Count());
        $errors = ($errors || $this->tckt_esc->Errors->Count());
        $errors = ($errors || $this->tckt_eqpmtserial->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->raised_date->Errors->Count());
        $errors = ($errors || $this->helpdesk->Errors->Count());
        $errors = ($errors || $this->bycontact->Errors->Count());
        $errors = ($errors || $this->tckt_c_date->Errors->Count());
        $errors = ($errors || $this->closedby->Errors->Count());
        $errors = ($errors || $this->closedadukom->Errors->Count());
        $errors = ($errors || $this->closedreportedby->Errors->Count());
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->tckt_branch->Errors->Count());
        $errors = ($errors || $this->tckt_related->Errors->Count());
        $errors = ($errors || $this->lblTicketNumber->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->tckt_subcat->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->byEngineer->Errors->Count());
        $errors = ($errors || $this->byadukom->Errors->Count());
        $errors = ($errors || $this->byadukomid->Errors->Count());
        $errors = ($errors || $this->customer->Errors->Count());
        $errors = ($errors || $this->byusergroup->Errors->Count());
        $errors = ($errors || $this->bycontact1->Errors->Count());
        $errors = ($errors || $this->tckt_engineer->Errors->Count());
        $errors = ($errors || $this->tckt_method->Errors->Count());
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

//Operation Method @5-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @5-FA44F8CC
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

        $this->tckt_esc->Prepare();
        $this->tckt_severity->Prepare();
        $this->state->Prepare();
        $this->tckt_branch->Prepare();
        $this->tckt_related->Prepare();
        $this->tckt_category->Prepare();
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
                $this->helpdesk->SetValue($this->DataSource->helpdesk->GetValue());
                $this->bycontact->SetValue($this->DataSource->bycontact->GetValue());
                $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
                $this->closedby->SetValue($this->DataSource->closedby->GetValue());
                $this->closedadukom->SetValue($this->DataSource->closedadukom->GetValue());
                $this->closedreportedby->SetValue($this->DataSource->closedreportedby->GetValue());
                $this->lblTicketNumber->SetValue($this->DataSource->lblTicketNumber->GetValue());
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->byEngineer->SetValue($this->DataSource->byEngineer->GetValue());
                $this->byadukom->SetValue($this->DataSource->byadukom->GetValue());
                $this->byadukomid->SetValue($this->DataSource->byadukomid->GetValue());
                $this->customer->SetValue($this->DataSource->customer->GetValue());
                $this->byusergroup->SetValue($this->DataSource->byusergroup->GetValue());
                $this->bycontact1->SetValue($this->DataSource->bycontact1->GetValue());
                if(!$this->FormSubmitted){
                    $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                    $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                    $this->tckt_toppanid->SetValue($this->DataSource->tckt_toppanid->GetValue());
                    $this->tckt_esc->SetValue($this->DataSource->tckt_esc->GetValue());
                    $this->tckt_eqpmtserial->SetValue($this->DataSource->tckt_eqpmtserial->GetValue());
                    $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                    $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                    $this->state->SetValue($this->DataSource->state->GetValue());
                    $this->tckt_branch->SetValue($this->DataSource->tckt_branch->GetValue());
                    $this->tckt_related->SetValue($this->DataSource->tckt_related->GetValue());
                    $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
                    $this->tckt_subcat->SetValue($this->DataSource->tckt_subcat->GetValue());
                    $this->tckt_method->SetValue($this->DataSource->tckt_method->GetValue());
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
            $Error = ComposeStrings($Error, $this->tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_toppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_esc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_eqpmtserial->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_severity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->raised_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->helpdesk->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bycontact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_c_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedadukom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->closedreportedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_related->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblTicketNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_category->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_subcat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byEngineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byadukom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byadukomid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byusergroup->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bycontact1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_method->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->tckt_refnumber->Show();
        $this->tckt_r_date->Show();
        $this->tckt_toppanid->Show();
        $this->tckt_esc->Show();
        $this->tckt_eqpmtserial->Show();
        $this->tckt_description->Show();
        $this->tckt_severity->Show();
        $this->raised_date->Show();
        $this->helpdesk->Show();
        $this->bycontact->Show();
        $this->tckt_c_date->Show();
        $this->closedby->Show();
        $this->closedadukom->Show();
        $this->closedreportedby->Show();
        $this->state->Show();
        $this->tckt_branch->Show();
        $this->tckt_related->Show();
        $this->lblTicketNumber->Show();
        $this->tckt_category->Show();
        $this->tckt_subcat->Show();
        $this->tckt_status->Show();
        $this->byEngineer->Show();
        $this->byadukom->Show();
        $this->byadukomid->Show();
        $this->customer->Show();
        $this->byusergroup->Show();
        $this->bycontact1->Show();
        $this->tckt_engineer->Show();
        $this->tckt_method->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSmartTicket Class @5-FCB6E20C

class clsRSmartTicketDataSource extends clsDBSMART {  //RSmartTicketDataSource Class @5-41970861

//DataSource Variables @5-1C9E8A82
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $tckt_refnumber;
    var $tckt_r_date;
    var $tckt_toppanid;
    var $tckt_esc;
    var $tckt_eqpmtserial;
    var $tckt_description;
    var $tckt_severity;
    var $raised_date;
    var $helpdesk;
    var $bycontact;
    var $tckt_c_date;
    var $closedby;
    var $closedadukom;
    var $closedreportedby;
    var $state;
    var $tckt_branch;
    var $tckt_related;
    var $lblTicketNumber;
    var $tckt_category;
    var $tckt_subcat;
    var $tckt_status;
    var $byEngineer;
    var $byadukom;
    var $byadukomid;
    var $customer;
    var $byusergroup;
    var $bycontact1;
    var $tckt_engineer;
    var $tckt_method;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-9120FFEC
    function clsRSmartTicketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSmartTicket/Error";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_toppanid = new clsField("tckt_toppanid", ccsText, "");
        
        $this->tckt_esc = new clsField("tckt_esc", ccsText, "");
        
        $this->tckt_eqpmtserial = new clsField("tckt_eqpmtserial", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->raised_date = new clsField("raised_date", ccsDate, $this->DateFormat);
        
        $this->helpdesk = new clsField("helpdesk", ccsText, "");
        
        $this->bycontact = new clsField("bycontact", ccsText, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->closedby = new clsField("closedby", ccsText, "");
        
        $this->closedadukom = new clsField("closedadukom", ccsText, "");
        
        $this->closedreportedby = new clsField("closedreportedby", ccsText, "");
        
        $this->state = new clsField("state", ccsText, "");
        
        $this->tckt_branch = new clsField("tckt_branch", ccsText, "");
        
        $this->tckt_related = new clsField("tckt_related", ccsText, "");
        
        $this->lblTicketNumber = new clsField("lblTicketNumber", ccsText, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->tckt_subcat = new clsField("tckt_subcat", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsText, "");
        
        $this->byEngineer = new clsField("byEngineer", ccsText, "");
        
        $this->byadukom = new clsField("byadukom", ccsText, "");
        
        $this->byadukomid = new clsField("byadukomid", ccsText, "");
        
        $this->customer = new clsField("customer", ccsText, "");
        
        $this->byusergroup = new clsField("byusergroup", ccsText, "");
        
        $this->bycontact1 = new clsField("bycontact1", ccsText, "");
        
        $this->tckt_engineer = new clsField("tckt_engineer", ccsText, "");
        
        $this->tckt_method = new clsField("tckt_method", ccsText, "");
        

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

//SetValues Method @5-88888E37
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_toppanid->SetDBValue($this->f("tckt_toppanid"));
        $this->tckt_esc->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_eqpmtserial->SetDBValue($this->f("tckt_eqpmtserial"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->raised_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->helpdesk->SetDBValue($this->f("tckt_r_helpdesk"));
        $this->bycontact->SetDBValue($this->f("tckt_r_customercontact"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->closedby->SetDBValue($this->f("tckt_c_byuser"));
        $this->closedadukom->SetDBValue($this->f("tckt_c_adukomid"));
        $this->closedreportedby->SetDBValue($this->f("tckt_c_helpdesk"));
        $this->state->SetDBValue($this->f("tckt_state"));
        $this->tckt_branch->SetDBValue($this->f("tckt_site"));
        $this->tckt_related->SetDBValue($this->f("tckt_tagrelated"));
        $this->lblTicketNumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->tckt_subcat->SetDBValue($this->f("tckt_subcategory"));
        $this->tckt_status->SetDBValue($this->f("tckt_status"));
        $this->byEngineer->SetDBValue($this->f("tckt_r_engineer"));
        $this->byadukom->SetDBValue($this->f("tckt_adukomn"));
        $this->byadukomid->SetDBValue($this->f("tckt_r_adukomid"));
        $this->customer->SetDBValue($this->f("tckt_r_customer"));
        $this->byusergroup->SetDBValue($this->f("tckt_r_byusertype"));
        $this->bycontact1->SetDBValue($this->f("tckt_r_customercontact2"));
        $this->tckt_method->SetDBValue($this->f("tckt_c_method"));
    }
//End SetValues Method

} //End RSmartTicketDataSource Class @5-FCB6E20C



class clsRecordsmart_resolutionnote { //smart_resolutionnote Class @95-E7A884F9

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

//Class_Initialize Event @95-DCC67895
    function clsRecordsmart_resolutionnote($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_resolutionnote/Error";
        $this->DataSource = new clssmart_resolutionnoteDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_resolutionnote";
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
            $this->DatePicker_rsltn_date = & new clsDatePicker("DatePicker_rsltn_date", "smart_resolutionnote", "rsltn_date", $this);
            $this->rsltn_byuser = & new clsControl(ccsHidden, "rsltn_byuser", "Rsltn Byuser", ccsInteger, "", CCGetRequestParam("rsltn_byuser", $Method, NULL), $this);
            $this->rsltn_actiontaken = & new clsControl(ccsTextArea, "rsltn_actiontaken", "Action Taken", ccsMemo, "", CCGetRequestParam("rsltn_actiontaken", $Method, NULL), $this);
            $this->rsltn_actiontaken->Required = true;
            $this->rsltn_planning = & new clsControl(ccsTextArea, "rsltn_planning", "Rsltn Planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", $Method, NULL), $this);
            $this->rsltn_remark = & new clsControl(ccsTextArea, "rsltn_remark", "Rsltn Remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", $Method, NULL), $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->engName = & new clsControl(ccsTextBox, "engName", "Engineer Name", ccsText, "", CCGetRequestParam("engName", $Method, NULL), $this);
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

//Initialize Method @95-62E10C5A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
        $this->DataSource->Parameters["expr113"] = SN;
    }
//End Initialize Method

//Validate Method @95-710F1421
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->rsltn_date->Validate() && $Validation);
        $Validation = ($this->rsltn_byuser->Validate() && $Validation);
        $Validation = ($this->rsltn_actiontaken->Validate() && $Validation);
        $Validation = ($this->rsltn_planning->Validate() && $Validation);
        $Validation = ($this->rsltn_remark->Validate() && $Validation);
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->engName->Validate() && $Validation);
        $Validation = ($this->rsltn_type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->rsltn_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_actiontaken->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_planning->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->engName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @95-B9777B5E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_rsltn_date->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->rsltn_planning->Errors->Count());
        $errors = ($errors || $this->rsltn_remark->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->engName->Errors->Count());
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

//InsertRow Method @95-8357342E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->rsltn_byuser->SetValue($this->rsltn_byuser->GetValue(true));
        $this->DataSource->rsltn_actiontaken->SetValue($this->rsltn_actiontaken->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->engName->SetValue($this->engName->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @95-498DDF0F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->rsltn_byuser->SetValue($this->rsltn_byuser->GetValue(true));
        $this->DataSource->rsltn_actiontaken->SetValue($this->rsltn_actiontaken->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->engName->SetValue($this->engName->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @95-856F0756
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
                    $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
                    $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
                    $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                    $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->rsltn_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_actiontaken->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->engName->Errors->ToString());
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
        $this->rsltn_byuser->Show();
        $this->rsltn_actiontaken->Show();
        $this->rsltn_planning->Show();
        $this->rsltn_remark->Show();
        $this->ticket_id->Show();
        $this->engName->Show();
        $this->rsltn_type->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_resolutionnote Class @95-FCB6E20C

class clssmart_resolutionnoteDataSource extends clsDBSMART {  //smart_resolutionnoteDataSource Class @95-8A18DBD3

//DataSource Variables @95-6C5375A3
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
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $rsltn_planning;
    var $rsltn_remark;
    var $ticket_id;
    var $engName;
    var $rsltn_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @95-1FDEC062
    function clssmart_resolutionnoteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_resolutionnote/Error";
        $this->Initialize();
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->engName = new clsField("engName", ccsText, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        

        $this->InsertFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @95-0B9C6C54
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->AddParameter("2", "expr113", ccsText, "", "", $this->Parameters["expr113"], "", false);
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

//SetValues Method @95-9FCC1A14
    function SetValues()
    {
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
    }
//End SetValues Method

//Insert Method @95-8487A61F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->InsertFields["rsltn_byuser"]["Value"] = $this->rsltn_byuser->GetDBValue(true);
        $this->InsertFields["rsltn_actiontaken"]["Value"] = $this->rsltn_actiontaken->GetDBValue(true);
        $this->InsertFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->InsertFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["rsltn_type"]["Value"] = $this->rsltn_type->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_resolutionnote", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @95-895703E5
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->UpdateFields["rsltn_byuser"]["Value"] = $this->rsltn_byuser->GetDBValue(true);
        $this->UpdateFields["rsltn_actiontaken"]["Value"] = $this->rsltn_actiontaken->GetDBValue(true);
        $this->UpdateFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->UpdateFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
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

} //End smart_resolutionnoteDataSource Class @95-FCB6E20C



class clsRecordresnoteview { //resnoteview Class @146-2B61EB26

//Variables @146-D6FF3E86

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

//Class_Initialize Event @146-3D509F44
    function clsRecordresnoteview($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record resnoteview/Error";
        $this->DataSource = new clsresnoteviewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "resnoteview";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->rsltn_date = & new clsControl(ccsLabel, "rsltn_date", "Date", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_date", $Method, NULL), $this);
            $this->rsltn_byuser = & new clsControl(ccsHidden, "rsltn_byuser", "Rsltn Byuser", ccsInteger, "", CCGetRequestParam("rsltn_byuser", $Method, NULL), $this);
            $this->rsltn_actiontaken = & new clsControl(ccsLabel, "rsltn_actiontaken", "Action Taken", ccsMemo, "", CCGetRequestParam("rsltn_actiontaken", $Method, NULL), $this);
            $this->rsltn_actiontaken->HTML = true;
            $this->rsltn_planning = & new clsControl(ccsLabel, "rsltn_planning", "Rsltn Planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", $Method, NULL), $this);
            $this->rsltn_planning->HTML = true;
            $this->rsltn_remark = & new clsControl(ccsLabel, "rsltn_remark", "Rsltn Remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", $Method, NULL), $this);
            $this->rsltn_remark->HTML = true;
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->engName = & new clsControl(ccsTextBox, "engName", "Engineer Name", ccsText, "", CCGetRequestParam("engName", $Method, NULL), $this);
            $this->rsltn_type = & new clsControl(ccsHidden, "rsltn_type", "rsltn_type", ccsText, "", CCGetRequestParam("rsltn_type", $Method, NULL), $this);
            if(!is_array($this->rsltn_date->Value) && !strlen($this->rsltn_date->Value) && $this->rsltn_date->Value !== false)
                $this->rsltn_date->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @146-CA2A610D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
        $this->DataSource->Parameters["expr162"] = SN;
    }
//End Initialize Method

//Validate Method @146-FA096946
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->rsltn_byuser->Validate() && $Validation);
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->engName->Validate() && $Validation);
        $Validation = ($this->rsltn_type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->rsltn_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->engName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @146-6FC4F024
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->rsltn_planning->Errors->Count());
        $errors = ($errors || $this->rsltn_remark->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->engName->Errors->Count());
        $errors = ($errors || $this->rsltn_type->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @146-ED598703
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

//Operation Method @146-B0F09A9D
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
            $this->PressedButton = $this->EditMode ? "Button_Cancel" : "Button_Cancel";
            if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "rid"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @146-498DDF0F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->rsltn_byuser->SetValue($this->rsltn_byuser->GetValue(true));
        $this->DataSource->rsltn_actiontaken->SetValue($this->rsltn_actiontaken->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->engName->SetValue($this->engName->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @146-F6EE034C
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
                $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
                $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
                $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                if(!$this->FormSubmitted){
                    $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->rsltn_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_actiontaken->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->engName->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Cancel->Show();
        $this->rsltn_date->Show();
        $this->rsltn_byuser->Show();
        $this->rsltn_actiontaken->Show();
        $this->rsltn_planning->Show();
        $this->rsltn_remark->Show();
        $this->ticket_id->Show();
        $this->engName->Show();
        $this->rsltn_type->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End resnoteview Class @146-FCB6E20C

class clsresnoteviewDataSource extends clsDBSMART {  //resnoteviewDataSource Class @146-1CC9B0BF

//DataSource Variables @146-64F618E6
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
    var $rsltn_date;
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $rsltn_planning;
    var $rsltn_remark;
    var $ticket_id;
    var $engName;
    var $rsltn_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @146-EFE04126
    function clsresnoteviewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record resnoteview/Error";
        $this->Initialize();
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->engName = new clsField("engName", ccsText, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        

        $this->UpdateFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @146-D6A70636
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->AddParameter("2", "expr162", ccsText, "", "", $this->Parameters["expr162"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "rsltn_type", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @146-7105B5E9
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

//SetValues Method @146-9FCC1A14
    function SetValues()
    {
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
    }
//End SetValues Method

//Update Method @146-472A6B98
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["rsltn_byuser"]["Value"] = $this->rsltn_byuser->GetDBValue(true);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
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

} //End resnoteviewDataSource Class @146-FCB6E20C

class clsGridGResNote { //GResNote class @177-86129332

//Variables @177-AC1EDBB9

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

//Class_Initialize Event @177-52C9B80A
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
            $this->PageSize = 50;
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
        $this->rsltn_action = & new clsControl(ccsLabel, "rsltn_action", "rsltn_action", ccsText, "", CCGetRequestParam("rsltn_action", ccsGet, NULL), $this);
        $this->rsltn_action->HTML = true;
        $this->rsltn_planning = & new clsControl(ccsLabel, "rsltn_planning", "rsltn_planning", ccsText, "", CCGetRequestParam("rsltn_planning", ccsGet, NULL), $this);
        $this->rsltn_planning->HTML = true;
        $this->rsltn_eng = & new clsControl(ccsLabel, "rsltn_eng", "rsltn_eng", ccsText, "", CCGetRequestParam("rsltn_eng", ccsGet, NULL), $this);
        $this->rlstn_remark = & new clsControl(ccsLabel, "rlstn_remark", "rlstn_remark", ccsText, "", CCGetRequestParam("rlstn_remark", ccsGet, NULL), $this);
        $this->rlstn_remark->HTML = true;
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("id", "FormFilter", "Panel1", "new", "rid", "ccsForm"));
        $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "tcktid", CCGetFromGet("id", NULL));
        $this->ImageLink2->Page = "cmactivity.php";
        $this->lblTicketNumberResNote = & new clsControl(ccsLabel, "lblTicketNumberResNote", "lblTicketNumberResNote", ccsText, "", CCGetRequestParam("lblTicketNumberResNote", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @177-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @177-C592D55C
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
            $this->ControlsVisible["rsltn_action"] = $this->rsltn_action->Visible;
            $this->ControlsVisible["rsltn_planning"] = $this->rsltn_planning->Visible;
            $this->ControlsVisible["rsltn_eng"] = $this->rsltn_eng->Visible;
            $this->ControlsVisible["rlstn_remark"] = $this->rlstn_remark->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
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
                $this->rsltn_action->SetValue($this->DataSource->rsltn_action->GetValue());
                $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                $this->rsltn_eng->SetValue($this->DataSource->rsltn_eng->GetValue());
                $this->rlstn_remark->SetValue($this->DataSource->rlstn_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->rsltn_date->Show();
                $this->rsltn_type->Show();
                $this->rsltn_id->Show();
                $this->rsltn_action->Show();
                $this->rsltn_planning->Show();
                $this->rsltn_eng->Show();
                $this->rlstn_remark->Show();
                $this->lblNumber->Show();
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

//GetErrors Method @177-EFC84E28
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_action->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_planning->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_eng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rlstn_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GResNote Class @177-FCB6E20C

class clsGResNoteDataSource extends clsDBSMART {  //GResNoteDataSource Class @177-CE76CF79

//DataSource Variables @177-D3B920A2
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
    var $rsltn_action;
    var $rsltn_planning;
    var $rsltn_eng;
    var $rlstn_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @177-21B0D2AA
    function clsGResNoteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GResNote";
        $this->Initialize();
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        
        $this->rsltn_id = new clsField("rsltn_id", ccsText, "");
        
        $this->rsltn_action = new clsField("rsltn_action", ccsText, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsText, "");
        
        $this->rsltn_eng = new clsField("rsltn_eng", ccsText, "");
        
        $this->rlstn_remark = new clsField("rlstn_remark", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @177-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @177-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @177-1FF328B0
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

//SetValues Method @177-1C8B82D5
    function SetValues()
    {
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
        $this->rsltn_id->SetDBValue($this->f("id"));
        $this->rsltn_action->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_eng->SetDBValue($this->f("rsltn_byuser"));
        $this->rlstn_remark->SetDBValue($this->f("rsltn_remark"));
    }
//End SetValues Method

} //End GResNoteDataSource Class @177-FCB6E20C



//Initialize Page @1-D80D2B6E
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
$TemplateFileName = "vticketdetails.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-1E9547E3
CCSecurityRedirect("1;2;3;4", "index.php");
//End Authenticate User

//Include events file @1-3D914204
include_once("./vticketdetails_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DFA00642
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$RSmartTicket = & new clsRecordRSmartTicket("", $MainPage);
$smart_resolutionnote = & new clsRecordsmart_resolutionnote("", $MainPage);
$ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("new", "id", "tcktid", "ccsForm"));
$ImageLink1->Page = "ticketlist.php";
$resnoteview = & new clsRecordresnoteview("", $MainPage);
$GResNote = & new clsGridGResNote("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->RSmartTicket = & $RSmartTicket;
$MainPage->smart_resolutionnote = & $smart_resolutionnote;
$MainPage->ImageLink1 = & $ImageLink1;
$MainPage->resnoteview = & $resnoteview;
$MainPage->GResNote = & $GResNote;
$RSmartTicket->Initialize();
$smart_resolutionnote->Initialize();
$resnoteview->Initialize();
$GResNote->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-E39E1EEA
$header->Operations();
$footer->Operations();
$RSmartTicket->Operation();
$smart_resolutionnote->Operation();
$resnoteview->Operation();
//End Execute Components

//Go to destination page @1-D662F764
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($RSmartTicket);
    unset($smart_resolutionnote);
    unset($resnoteview);
    unset($GResNote);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F1AAE7DD
$header->Show();
$footer->Show();
$RSmartTicket->Show();
$smart_resolutionnote->Show();
$resnoteview->Show();
$GResNote->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9E737671
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($RSmartTicket);
unset($smart_resolutionnote);
unset($resnoteview);
unset($GResNote);
unset($Tpl);
//End Unload Page


?>
