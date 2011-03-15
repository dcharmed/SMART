<?php
//Include Common Files @1-04F5581F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ticketlistsum.php");
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

class clsGridsmart_ticket { //smart_ticket class @5-3145E1AF

//Variables @5-7E615A81

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
    var $Sorter_tckt_refnumber;
    var $Sorter_tckt_status;
    var $Sorter_tckt_date;
    var $Sorter_tckt_branch;
    var $Sorter_tckt_severity;
    var $Sorter_tckt_adukomn;
    var $Sorter_tckt_toppanid;
    var $Sorter_tckt_esc;
    var $Sorter_Eng;
//End Variables

//Class_Initialize Event @5-F01A0874
    function clsGridsmart_ticket($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_ticket";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_ticket";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_ticketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("smart_ticketOrder", "");
        $this->SorterDirection = CCGetParam("smart_ticketDir", "");

        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->tckt_refnumber = & new clsControl(ccsLink, "tckt_refnumber", "tckt_refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", ccsGet, NULL), $this);
        $this->tckt_refnumber->Page = "ticketdetails.php";
        $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "tckt_status", ccsInteger, "", CCGetRequestParam("tckt_status", ccsGet, NULL), $this);
        $this->tckt_status->HTML = true;
        $this->tckt_date = & new clsControl(ccsLabel, "tckt_date", "tckt_date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_date", ccsGet, NULL), $this);
        $this->tckt_branch = & new clsControl(ccsLabel, "tckt_branch", "tckt_branch", ccsText, "", CCGetRequestParam("tckt_branch", ccsGet, NULL), $this);
        $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "tckt_severity", ccsInteger, "", CCGetRequestParam("tckt_severity", ccsGet, NULL), $this);
        $this->tckt_adukomn = & new clsControl(ccsLabel, "tckt_adukomn", "tckt_adukomn", ccsText, "", CCGetRequestParam("tckt_adukomn", ccsGet, NULL), $this);
        $this->tckt_toppanid = & new clsControl(ccsLabel, "tckt_toppanid", "tckt_toppanid", ccsText, "", CCGetRequestParam("tckt_toppanid", ccsGet, NULL), $this);
        $this->tckt_esc = & new clsControl(ccsLabel, "tckt_esc", "tckt_esc", ccsText, "", CCGetRequestParam("tckt_esc", ccsGet, NULL), $this);
        $this->tckt_description = & new clsControl(ccsLabel, "tckt_description", "tckt_description", ccsMemo, "", CCGetRequestParam("tckt_description", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->tckt_state = & new clsControl(ccsHidden, "tckt_state", "tckt_state", ccsText, "", CCGetRequestParam("tckt_state", ccsGet, NULL), $this);
        $this->tckt_age = & new clsControl(ccsLabel, "tckt_age", "tckt_age", ccsInteger, "", CCGetRequestParam("tckt_age", ccsGet, NULL), $this);
        $this->tckt_age->HTML = true;
        $this->tcktEng = & new clsControl(ccsLabel, "tcktEng", "tcktEng", ccsText, "", CCGetRequestParam("tcktEng", ccsGet, NULL), $this);
        $this->tckt_c_date = & new clsControl(ccsHidden, "tckt_c_date", "tckt_c_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_c_date", ccsGet, NULL), $this);
        $this->tckt_spart = & new clsControl(ccsLabel, "tckt_spart", "tckt_spart", ccsText, "", CCGetRequestParam("tckt_spart", ccsGet, NULL), $this);
        $this->tckt_equipment = & new clsControl(ccsLabel, "tckt_equipment", "tckt_equipment", ccsText, "", CCGetRequestParam("tckt_equipment", ccsGet, NULL), $this);
        $this->tckt_followup = & new clsControl(ccsLabel, "tckt_followup", "tckt_followup", ccsText, "", CCGetRequestParam("tckt_followup", ccsGet, NULL), $this);
        $this->smart_ticket_TotalRecords = & new clsControl(ccsLabel, "smart_ticket_TotalRecords", "smart_ticket_TotalRecords", ccsText, "", CCGetRequestParam("smart_ticket_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_tckt_refnumber = & new clsSorter($this->ComponentName, "Sorter_tckt_refnumber", $FileName, $this);
        $this->Sorter_tckt_status = & new clsSorter($this->ComponentName, "Sorter_tckt_status", $FileName, $this);
        $this->Sorter_tckt_date = & new clsSorter($this->ComponentName, "Sorter_tckt_date", $FileName, $this);
        $this->Sorter_tckt_branch = & new clsSorter($this->ComponentName, "Sorter_tckt_branch", $FileName, $this);
        $this->Sorter_tckt_severity = & new clsSorter($this->ComponentName, "Sorter_tckt_severity", $FileName, $this);
        $this->Sorter_tckt_adukomn = & new clsSorter($this->ComponentName, "Sorter_tckt_adukomn", $FileName, $this);
        $this->Sorter_tckt_toppanid = & new clsSorter($this->ComponentName, "Sorter_tckt_toppanid", $FileName, $this);
        $this->Sorter_tckt_esc = & new clsSorter($this->ComponentName, "Sorter_tckt_esc", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Sorter_Eng = & new clsSorter($this->ComponentName, "Sorter_Eng", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-FC203869
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_branch"] = CCGetFromGet("s_branch", NULL);
        $this->DataSource->Parameters["urls_ref"] = CCGetFromGet("s_ref", NULL);
        $this->DataSource->Parameters["urlmode"] = CCGetFromGet("mode", NULL);
        $this->DataSource->Parameters["urls_svr"] = CCGetFromGet("s_svr", NULL);
        $this->DataSource->Parameters["urls_status"] = CCGetFromGet("s_status", NULL);
        $this->DataSource->Parameters["urls_esc"] = CCGetFromGet("s_esc", NULL);
        $this->DataSource->Parameters["urls_cat"] = CCGetFromGet("s_cat", NULL);
        $this->DataSource->Parameters["urls_scat"] = CCGetFromGet("s_scat", NULL);
        $this->DataSource->Parameters["urls_state"] = CCGetFromGet("s_state", NULL);
        $this->DataSource->Parameters["urls_ad"] = CCGetFromGet("s_ad", NULL);

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
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["tckt_status"] = $this->tckt_status->Visible;
            $this->ControlsVisible["tckt_date"] = $this->tckt_date->Visible;
            $this->ControlsVisible["tckt_branch"] = $this->tckt_branch->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
            $this->ControlsVisible["tckt_adukomn"] = $this->tckt_adukomn->Visible;
            $this->ControlsVisible["tckt_toppanid"] = $this->tckt_toppanid->Visible;
            $this->ControlsVisible["tckt_esc"] = $this->tckt_esc->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["tckt_state"] = $this->tckt_state->Visible;
            $this->ControlsVisible["tckt_age"] = $this->tckt_age->Visible;
            $this->ControlsVisible["tcktEng"] = $this->tcktEng->Visible;
            $this->ControlsVisible["tckt_c_date"] = $this->tckt_c_date->Visible;
            $this->ControlsVisible["tckt_spart"] = $this->tckt_spart->Visible;
            $this->ControlsVisible["tckt_equipment"] = $this->tckt_equipment->Visible;
            $this->ControlsVisible["tckt_followup"] = $this->tckt_followup->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                $this->tckt_refnumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tckt_refnumber->Parameters = CCAddParam($this->tckt_refnumber->Parameters, "id", $this->DataSource->f("id"));
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_date->SetValue($this->DataSource->tckt_date->GetValue());
                $this->tckt_branch->SetValue($this->DataSource->tckt_branch->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->tckt_adukomn->SetValue($this->DataSource->tckt_adukomn->GetValue());
                $this->tckt_toppanid->SetValue($this->DataSource->tckt_toppanid->GetValue());
                $this->tckt_esc->SetValue($this->DataSource->tckt_esc->GetValue());
                $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->tcktEng->SetValue($this->DataSource->tcktEng->GetValue());
                $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
                $this->tckt_followup->SetValue($this->DataSource->tckt_followup->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->tckt_refnumber->Show();
                $this->tckt_status->Show();
                $this->tckt_date->Show();
                $this->tckt_branch->Show();
                $this->tckt_severity->Show();
                $this->tckt_adukomn->Show();
                $this->tckt_toppanid->Show();
                $this->tckt_esc->Show();
                $this->tckt_description->Show();
                $this->lblNumber->Show();
                $this->tckt_state->Show();
                $this->tckt_age->Show();
                $this->tcktEng->Show();
                $this->tckt_c_date->Show();
                $this->tckt_spart->Show();
                $this->tckt_equipment->Show();
                $this->tckt_followup->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->smart_ticket_TotalRecords->Show();
        $this->Sorter_tckt_refnumber->Show();
        $this->Sorter_tckt_status->Show();
        $this->Sorter_tckt_date->Show();
        $this->Sorter_tckt_branch->Show();
        $this->Sorter_tckt_severity->Show();
        $this->Sorter_tckt_adukomn->Show();
        $this->Sorter_tckt_toppanid->Show();
        $this->Sorter_tckt_esc->Show();
        $this->Navigator->Show();
        $this->Sorter_Eng->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-F768992E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_adukomn->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_toppanid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_esc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktEng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_spart->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_equipment->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_followup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_ticket Class @5-FCB6E20C

class clssmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @5-6569B5AD

//DataSource Variables @5-2984D9E2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_date;
    var $tckt_branch;
    var $tckt_severity;
    var $tckt_adukomn;
    var $tckt_toppanid;
    var $tckt_esc;
    var $tckt_description;
    var $tckt_state;
    var $tcktEng;
    var $tckt_c_date;
    var $tckt_followup;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-8B2B6FA0
    function clssmart_ticketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_ticket";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_date = new clsField("tckt_date", ccsDate, $this->DateFormat);
        
        $this->tckt_branch = new clsField("tckt_branch", ccsText, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->tckt_adukomn = new clsField("tckt_adukomn", ccsText, "");
        
        $this->tckt_toppanid = new clsField("tckt_toppanid", ccsText, "");
        
        $this->tckt_esc = new clsField("tckt_esc", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->tcktEng = new clsField("tcktEng", ccsText, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->tckt_followup = new clsField("tckt_followup", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-17FA0BC0
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_r_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tckt_refnumber" => array("tckt_refnumber", ""), 
            "Sorter_tckt_status" => array("tckt_status", ""), 
            "Sorter_tckt_date" => array("tckt_r_date", ""), 
            "Sorter_tckt_branch" => array("tckt_site", ""), 
            "Sorter_tckt_severity" => array("tckt_severity", ""), 
            "Sorter_tckt_adukomn" => array("tckt_adukomn", ""), 
            "Sorter_tckt_toppanid" => array("tckt_toppanid", ""), 
            "Sorter_tckt_esc" => array("tckt_escalate", ""), 
            "Sorter_Eng" => array("tckt_engineer", "")));
    }
//End SetOrder Method

//Prepare Method @5-BF066889
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_branch", ccsText, "", "", $this->Parameters["urls_branch"], "", false);
        $this->wp->AddParameter("2", "urls_ref", ccsText, "", "", $this->Parameters["urls_ref"], "", false);
        $this->wp->AddParameter("3", "urlmode", ccsInteger, "", "", $this->Parameters["urlmode"], "", false);
        $this->wp->AddParameter("4", "urls_svr", ccsInteger, "", "", $this->Parameters["urls_svr"], "", false);
        $this->wp->AddParameter("5", "urls_status", ccsInteger, "", "", $this->Parameters["urls_status"], "", false);
        $this->wp->AddParameter("6", "urls_esc", ccsText, "", "", $this->Parameters["urls_esc"], "", false);
        $this->wp->AddParameter("7", "urls_cat", ccsText, "", "", $this->Parameters["urls_cat"], "", false);
        $this->wp->AddParameter("8", "urls_scat", ccsText, "", "", $this->Parameters["urls_scat"], "", false);
        $this->wp->AddParameter("9", "urls_state", ccsText, "", "", $this->Parameters["urls_state"], "", false);
        $this->wp->AddParameter("10", "urls_ad", ccsText, "", "", $this->Parameters["urls_ad"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tckt_site", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tckt_refnumber", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opLessThan, "tckt_status", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "tckt_severity", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "tckt_status", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "tckt_escalate", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "tckt_category", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opEqual, "tckt_subcategory", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "tckt_state", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsText),false);
        $this->wp->Criterion[10] = $this->wp->Operation(opEqual, "tckt_adukomn", $this->wp->GetDBValue("10"), $this->ToSQL($this->wp->GetDBValue("10"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]), 
             $this->wp->Criterion[10]);
    }
//End Prepare Method

//Open Method @5-C5FDE95E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_ticket";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-14D09B5C
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_branch->SetDBValue($this->f("tckt_site"));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->tckt_adukomn->SetDBValue($this->f("tckt_adukomn"));
        $this->tckt_toppanid->SetDBValue($this->f("tckt_toppanid"));
        $this->tckt_esc->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->tcktEng->SetDBValue($this->f("tckt_engineer"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->tckt_followup->SetDBValue($this->f("tckt_followup"));
    }
//End SetValues Method

} //End smart_ticketDataSource Class @5-FCB6E20C

class clsRecordsmart_ticketSearch { //smart_ticketSearch Class @6-7B9D8492

//Variables @6-D6FF3E86

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

//Class_Initialize Event @6-406694F6
    function clsRecordsmart_ticketSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_ticketSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_ticketSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_ref = & new clsControl(ccsTextBox, "s_ref", "s_ref", ccsText, "", CCGetRequestParam("s_ref", $Method, NULL), $this);
            $this->s_sdate = & new clsControl(ccsTextBox, "s_sdate", "s_sdate", ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("s_sdate", $Method, NULL), $this);
            $this->DatePicker_s_sdate = & new clsDatePicker("DatePicker_s_sdate", "smart_ticketSearch", "s_sdate", $this);
            $this->s_edate = & new clsControl(ccsTextBox, "s_edate", "s_edate", ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("s_edate", $Method, NULL), $this);
            $this->DatePicker_s_edate = & new clsDatePicker("DatePicker_s_edate", "smart_ticketSearch", "s_edate", $this);
            $this->Button_Reset = & new clsButton("Button_Reset", $Method, $this);
            $this->s_svr = & new clsControl(ccsListBox, "s_svr", "s_svr", ccsText, "", CCGetRequestParam("s_svr", $Method, NULL), $this);
            $this->s_svr->DSType = dsTable;
            $this->s_svr->DataSource = new clsDBSMART();
            $this->s_svr->ds = & $this->s_svr->DataSource;
            $this->s_svr->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_svr->BoundColumn, $this->s_svr->TextColumn, $this->s_svr->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_svr->DataSource->Parameters["expr74"] = tcktseverity;
            $this->s_svr->DataSource->wp = new clsSQLParameters();
            $this->s_svr->DataSource->wp->AddParameter("1", "expr74", ccsText, "", "", $this->s_svr->DataSource->Parameters["expr74"], "", false);
            $this->s_svr->DataSource->wp->Criterion[1] = $this->s_svr->DataSource->wp->Operation(opEqual, "ref_type", $this->s_svr->DataSource->wp->GetDBValue("1"), $this->s_svr->DataSource->ToSQL($this->s_svr->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_svr->DataSource->Where = 
                 $this->s_svr->DataSource->wp->Criterion[1];
            $this->s_cat = & new clsControl(ccsListBox, "s_cat", "s_cat", ccsText, "", CCGetRequestParam("s_cat", $Method, NULL), $this);
            $this->s_cat->DSType = dsTable;
            $this->s_cat->DataSource = new clsDBSMART();
            $this->s_cat->ds = & $this->s_cat->DataSource;
            $this->s_cat->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_cat->BoundColumn, $this->s_cat->TextColumn, $this->s_cat->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_cat->DataSource->Parameters["expr89"] = probcat;
            $this->s_cat->DataSource->wp = new clsSQLParameters();
            $this->s_cat->DataSource->wp->AddParameter("1", "expr89", ccsText, "", "", $this->s_cat->DataSource->Parameters["expr89"], "", false);
            $this->s_cat->DataSource->wp->Criterion[1] = $this->s_cat->DataSource->wp->Operation(opEqual, "ref_type", $this->s_cat->DataSource->wp->GetDBValue("1"), $this->s_cat->DataSource->ToSQL($this->s_cat->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_cat->DataSource->Where = 
                 $this->s_cat->DataSource->wp->Criterion[1];
            $this->s_scat = & new clsControl(ccsListBox, "s_scat", "s_scat", ccsText, "", CCGetRequestParam("s_scat", $Method, NULL), $this);
            $this->s_scat->DSType = dsTable;
            $this->s_scat->DataSource = new clsDBSMART();
            $this->s_scat->ds = & $this->s_scat->DataSource;
            $this->s_scat->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_scat->BoundColumn, $this->s_scat->TextColumn, $this->s_scat->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_esc = & new clsControl(ccsListBox, "s_esc", "s_esc", ccsText, "", CCGetRequestParam("s_esc", $Method, NULL), $this);
            $this->s_esc->DSType = dsTable;
            $this->s_esc->DataSource = new clsDBSMART();
            $this->s_esc->ds = & $this->s_esc->DataSource;
            $this->s_esc->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_esc->BoundColumn, $this->s_esc->TextColumn, $this->s_esc->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_esc->DataSource->Parameters["expr92"] = esc;
            $this->s_esc->DataSource->wp = new clsSQLParameters();
            $this->s_esc->DataSource->wp->AddParameter("1", "expr92", ccsText, "", "", $this->s_esc->DataSource->Parameters["expr92"], "", false);
            $this->s_esc->DataSource->wp->Criterion[1] = $this->s_esc->DataSource->wp->Operation(opEqual, "ref_type", $this->s_esc->DataSource->wp->GetDBValue("1"), $this->s_esc->DataSource->ToSQL($this->s_esc->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_esc->DataSource->Where = 
                 $this->s_esc->DataSource->wp->Criterion[1];
            $this->s_ad = & new clsControl(ccsTextBox, "s_ad", "s_ad", ccsText, "", CCGetRequestParam("s_ad", $Method, NULL), $this);
            $this->type = & new clsControl(ccsListBox, "type", "type", ccsText, "", CCGetRequestParam("type", $Method, NULL), $this);
            $this->type->DSType = dsListOfValues;
            $this->type->Values = array(array("1", "Current"), array("2", "Monthly"), array("3", "Yearly"));
        }
    }
//End Class_Initialize Event

//Validate Method @6-C0A4BA1D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_ref->Validate() && $Validation);
        $Validation = ($this->s_sdate->Validate() && $Validation);
        $Validation = ($this->s_edate->Validate() && $Validation);
        $Validation = ($this->s_svr->Validate() && $Validation);
        $Validation = ($this->s_cat->Validate() && $Validation);
        $Validation = ($this->s_scat->Validate() && $Validation);
        $Validation = ($this->s_esc->Validate() && $Validation);
        $Validation = ($this->s_ad->Validate() && $Validation);
        $Validation = ($this->type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_ref->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_sdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_edate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_svr->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_cat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_scat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_esc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-7BFBDECA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ref->Errors->Count());
        $errors = ($errors || $this->s_sdate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_sdate->Errors->Count());
        $errors = ($errors || $this->s_edate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_edate->Errors->Count());
        $errors = ($errors || $this->s_svr->Errors->Count());
        $errors = ($errors || $this->s_cat->Errors->Count());
        $errors = ($errors || $this->s_scat->Errors->Count());
        $errors = ($errors || $this->s_esc->Errors->Count());
        $errors = ($errors || $this->s_ad->Errors->Count());
        $errors = ($errors || $this->type->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @6-ED598703
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

//Operation Method @6-1DD2B21D
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            } else if($this->Button_Reset->Pressed) {
                $this->PressedButton = "Button_Reset";
            }
        }
        $Redirect = "ticketlistsum.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ticketlistsum.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button_Reset", "Button_Reset_x", "Button_Reset_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Reset") {
                $Redirect = "ticketlistsum.php";
                if(!CCGetEvent($this->Button_Reset->CCSEvents, "OnClick", $this->Button_Reset)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-E4820250
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

        $this->s_svr->Prepare();
        $this->s_cat->Prepare();
        $this->s_scat->Prepare();
        $this->s_esc->Prepare();
        $this->type->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_ref->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_sdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_sdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_edate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_edate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_svr->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_cat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_scat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_esc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_ref->Show();
        $this->s_sdate->Show();
        $this->DatePicker_s_sdate->Show();
        $this->s_edate->Show();
        $this->DatePicker_s_edate->Show();
        $this->Button_Reset->Show();
        $this->s_svr->Show();
        $this->s_cat->Show();
        $this->s_scat->Show();
        $this->s_esc->Show();
        $this->s_ad->Show();
        $this->type->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End smart_ticketSearch Class @6-FCB6E20C

//Initialize Page @1-62005B07
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
$TemplateFileName = "ticketlistsum.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-58870C3A
CCSecurityRedirect("1;2;3;5;4", "index.php");
//End Authenticate User

//Include events file @1-6AF18271
include_once("./ticketlistsum_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FC6E1DB6
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_ticket = & new clsGridsmart_ticket("", $MainPage);
$smart_ticketSearch = & new clsRecordsmart_ticketSearch("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_ticket = & $smart_ticket;
$MainPage->smart_ticketSearch = & $smart_ticketSearch;
$smart_ticket->Initialize();

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

//Execute Components @1-57F4E2B4
$header->Operations();
$footer->Operations();
$smart_ticketSearch->Operation();
//End Execute Components

//Go to destination page @1-79347FFD
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
    unset($smart_ticketSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0BE77E06
$header->Show();
$footer->Show();
$smart_ticket->Show();
$smart_ticketSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CFE58383
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_ticket);
unset($smart_ticketSearch);
unset($Tpl);
//End Unload Page


?>
