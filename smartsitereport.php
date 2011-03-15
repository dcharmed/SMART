<?php
//Include Common Files @1-D0E9AA0D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartsitereport.php");
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

class clsGridGSiteReport { //GSiteReport class @5-C7000992

//Variables @5-AC1EDBB9

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

//Class_Initialize Event @5-B627095B
    function clsGridGSiteReport($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSiteReport";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSiteReport";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSiteReportDataSource($this);
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

        $this->sr_datereport = & new clsControl(ccsLink, "sr_datereport", "sr_datereport", ccsDate, $DefaultDateFormat, CCGetRequestParam("sr_datereport", ccsGet, NULL), $this);
        $this->sr_datereport->Page = "smartsitereport.php";
        $this->sr_status = & new clsControl(ccsLabel, "sr_status", "sr_status", ccsText, "", CCGetRequestParam("sr_status", ccsGet, NULL), $this);
        $this->sr_reportedby = & new clsControl(ccsLabel, "sr_reportedby", "sr_reportedby", ccsText, "", CCGetRequestParam("sr_reportedby", ccsGet, NULL), $this);
        $this->sr_takenby = & new clsControl(ccsLabel, "sr_takenby", "sr_takenby", ccsText, "", CCGetRequestParam("sr_takenby", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->sr_sitecode = & new clsControl(ccsLabel, "sr_sitecode", "sr_sitecode", ccsText, "", CCGetRequestParam("sr_sitecode", ccsGet, NULL), $this);
        $this->sr_type = & new clsControl(ccsLabel, "sr_type", "sr_type", ccsText, "", CCGetRequestParam("sr_type", ccsGet, NULL), $this);
        $this->sr_report = & new clsControl(ccsLabel, "sr_report", "sr_report", ccsMemo, "", CCGetRequestParam("sr_report", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @5-44C6B614
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_sr_status"] = CCGetFromGet("s_sr_status", NULL);
        $this->DataSource->Parameters["urls_sr_sitecode"] = CCGetFromGet("s_sr_sitecode", NULL);
        $this->DataSource->Parameters["urls_sr_type"] = CCGetFromGet("s_sr_type", NULL);
        $this->DataSource->Parameters["urls_sr_datereport"] = CCGetFromGet("s_sr_datereport", NULL);

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
            $this->ControlsVisible["sr_datereport"] = $this->sr_datereport->Visible;
            $this->ControlsVisible["sr_status"] = $this->sr_status->Visible;
            $this->ControlsVisible["sr_reportedby"] = $this->sr_reportedby->Visible;
            $this->ControlsVisible["sr_takenby"] = $this->sr_takenby->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["sr_sitecode"] = $this->sr_sitecode->Visible;
            $this->ControlsVisible["sr_type"] = $this->sr_type->Visible;
            $this->ControlsVisible["sr_report"] = $this->sr_report->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->sr_datereport->SetValue($this->DataSource->sr_datereport->GetValue());
                $this->sr_datereport->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->sr_datereport->Parameters = CCAddParam($this->sr_datereport->Parameters, "id", $this->DataSource->f("id"));
                $this->sr_status->SetValue($this->DataSource->sr_status->GetValue());
                $this->sr_reportedby->SetValue($this->DataSource->sr_reportedby->GetValue());
                $this->sr_takenby->SetValue($this->DataSource->sr_takenby->GetValue());
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->sr_sitecode->SetValue($this->DataSource->sr_sitecode->GetValue());
                $this->sr_type->SetValue($this->DataSource->sr_type->GetValue());
                $this->sr_report->SetValue($this->DataSource->sr_report->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->sr_datereport->Show();
                $this->sr_status->Show();
                $this->sr_reportedby->Show();
                $this->sr_takenby->Show();
                $this->lblNumber->Show();
                $this->sr_sitecode->Show();
                $this->sr_type->Show();
                $this->sr_report->Show();
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
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-7531E243
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->sr_datereport->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_reportedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_takenby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_sitecode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sr_report->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSiteReport Class @5-FCB6E20C

class clsGSiteReportDataSource extends clsDBSMART {  //GSiteReportDataSource Class @5-6C7212FD

//DataSource Variables @5-A2F141AA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $sr_datereport;
    var $sr_status;
    var $sr_reportedby;
    var $sr_takenby;
    var $lblNumber;
    var $sr_sitecode;
    var $sr_type;
    var $sr_report;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-6A6C366A
    function clsGSiteReportDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSiteReport";
        $this->Initialize();
        $this->sr_datereport = new clsField("sr_datereport", ccsDate, $this->DateFormat);
        
        $this->sr_status = new clsField("sr_status", ccsText, "");
        
        $this->sr_reportedby = new clsField("sr_reportedby", ccsText, "");
        
        $this->sr_takenby = new clsField("sr_takenby", ccsText, "");
        
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->sr_sitecode = new clsField("sr_sitecode", ccsText, "");
        
        $this->sr_type = new clsField("sr_type", ccsText, "");
        
        $this->sr_report = new clsField("sr_report", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @5-D4420E68
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_sr_status", ccsText, "", "", $this->Parameters["urls_sr_status"], "", false);
        $this->wp->AddParameter("2", "urls_sr_sitecode", ccsText, "", "", $this->Parameters["urls_sr_sitecode"], "", false);
        $this->wp->AddParameter("3", "urls_sr_type", ccsText, "", "", $this->Parameters["urls_sr_type"], "", false);
        $this->wp->AddParameter("4", "urls_sr_datereport", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_sr_datereport"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "sr_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "sr_sitecode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "sr_type", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "sr_datereport", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @5-A2E862DD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_sitereport";
        $this->SQL = "SELECT id, sr_datereport, sr_status, sr_reportedby, sr_takenby, sr_sitecode, sr_type, sr_report \n\n" .
        "FROM smart_sitereport {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-604DE49B
    function SetValues()
    {
        $this->sr_datereport->SetDBValue(trim($this->f("sr_datereport")));
        $this->sr_status->SetDBValue($this->f("sr_status"));
        $this->sr_reportedby->SetDBValue($this->f("sr_reportedby"));
        $this->sr_takenby->SetDBValue($this->f("sr_takenby"));
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->sr_sitecode->SetDBValue($this->f("sr_sitecode"));
        $this->sr_type->SetDBValue($this->f("sr_type"));
        $this->sr_report->SetDBValue($this->f("sr_report"));
    }
//End SetValues Method

} //End GSiteReportDataSource Class @5-FCB6E20C

class clsRecordSSiteReport { //SSiteReport Class @6-C48A7804

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

//Class_Initialize Event @6-C656E289
    function clsRecordSSiteReport($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SSiteReport/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SSiteReport";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->stat = & new clsControl(ccsListBox, "stat", "stat", ccsText, "", CCGetRequestParam("stat", $Method, NULL), $this);
            $this->stat->DSType = dsTable;
            $this->stat->DataSource = new clsDBSMART();
            $this->stat->ds = & $this->stat->DataSource;
            $this->stat->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->stat->DataSource->Order = "ref_rank";
            list($this->stat->BoundColumn, $this->stat->TextColumn, $this->stat->DBFormat) = array("ref_value", "ref_description", "");
            $this->stat->DataSource->Parameters["expr90"] = statsrpt;
            $this->stat->DataSource->wp = new clsSQLParameters();
            $this->stat->DataSource->wp->AddParameter("1", "expr90", ccsText, "", "", $this->stat->DataSource->Parameters["expr90"], "", false);
            $this->stat->DataSource->wp->Criterion[1] = $this->stat->DataSource->wp->Operation(opEqual, "ref_type", $this->stat->DataSource->wp->GetDBValue("1"), $this->stat->DataSource->ToSQL($this->stat->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->stat->DataSource->Where = 
                 $this->stat->DataSource->wp->Criterion[1];
            $this->stat->DataSource->Order = "ref_rank";
            $this->code = & new clsControl(ccsListBox, "code", "code", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->df = & new clsControl(ccsTextBox, "df", "df", ccsDate, $DefaultDateFormat, CCGetRequestParam("df", $Method, NULL), $this);
            $this->DatePicker_df = & new clsDatePicker("DatePicker_df", "SSiteReport", "df", $this);
            $this->dt = & new clsControl(ccsTextBox, "dt", "dt", ccsDate, $DefaultDateFormat, CCGetRequestParam("dt", $Method, NULL), $this);
            $this->DatePicker_dt = & new clsDatePicker("DatePicker_dt", "SSiteReport", "dt", $this);
            $this->type = & new clsControl(ccsRadioButton, "type", "type", ccsText, "", CCGetRequestParam("type", $Method, NULL), $this);
            $this->type->DSType = dsTable;
            $this->type->DataSource = new clsDBSMART();
            $this->type->ds = & $this->type->DataSource;
            $this->type->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->type->DataSource->Order = "ref_rank";
            list($this->type->BoundColumn, $this->type->TextColumn, $this->type->DBFormat) = array("ref_value", "ref_description", "");
            $this->type->DataSource->Parameters["expr53"] = srtype;
            $this->type->DataSource->wp = new clsSQLParameters();
            $this->type->DataSource->wp->AddParameter("1", "expr53", ccsText, "", "", $this->type->DataSource->Parameters["expr53"], "", false);
            $this->type->DataSource->wp->Criterion[1] = $this->type->DataSource->wp->Operation(opEqual, "ref_type", $this->type->DataSource->wp->GetDBValue("1"), $this->type->DataSource->ToSQL($this->type->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->type->DataSource->Where = 
                 $this->type->DataSource->wp->Criterion[1];
            $this->type->DataSource->Order = "ref_rank";
            $this->type->HTML = true;
            $this->btnNew = & new clsControl(ccsImageLink, "btnNew", "btnNew", ccsText, "", CCGetRequestParam("btnNew", $Method, NULL), $this);
            $this->btnNew->Page = "smartsitereport.php";
        }
    }
//End Class_Initialize Event

//Validate Method @6-8EF559C3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->stat->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->df->Validate() && $Validation);
        $Validation = ($this->dt->Validate() && $Validation);
        $Validation = ($this->type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->stat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->df->Errors->Count() == 0);
        $Validation =  $Validation && ($this->dt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-73C0E5F2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->stat->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->df->Errors->Count());
        $errors = ($errors || $this->DatePicker_df->Errors->Count());
        $errors = ($errors || $this->dt->Errors->Count());
        $errors = ($errors || $this->DatePicker_dt->Errors->Count());
        $errors = ($errors || $this->type->Errors->Count());
        $errors = ($errors || $this->btnNew->Errors->Count());
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

//Operation Method @6-AAF1E115
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
            }
        }
        $Redirect = "smartsitereport.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartsitereport.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-978F61C9
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

        $this->stat->Prepare();
        $this->code->Prepare();
        $this->type->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }
        $this->btnNew->Parameters = "";
        $this->btnNew->Parameters = CCAddParam($this->btnNew->Parameters, "new", 1);

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->stat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->df->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_df->Errors->ToString());
            $Error = ComposeStrings($Error, $this->dt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_dt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->btnNew->Errors->ToString());
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
        $this->stat->Show();
        $this->code->Show();
        $this->df->Show();
        $this->DatePicker_df->Show();
        $this->dt->Show();
        $this->DatePicker_dt->Show();
        $this->type->Show();
        $this->btnNew->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SSiteReport Class @6-FCB6E20C

class clsRecordSUpdStatus { //SUpdStatus Class @66-6D2F3440

//Variables @66-D6FF3E86

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

//Class_Initialize Event @66-B8799C45
    function clsRecordSUpdStatus($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SUpdStatus/Error";
        $this->DataSource = new clsSUpdStatusDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SUpdStatus";
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
            $this->Status = & new clsControl(ccsListBox, "Status", "Status", ccsText, "", CCGetRequestParam("Status", $Method, NULL), $this);
            $this->Status->DSType = dsTable;
            $this->Status->DataSource = new clsDBSMART();
            $this->Status->ds = & $this->Status->DataSource;
            $this->Status->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->Status->BoundColumn, $this->Status->TextColumn, $this->Status->DBFormat) = array("ref_value", "ref_description", "");
            $this->Status->DataSource->Parameters["expr96"] = statsrpt;
            $this->Status->DataSource->wp = new clsSQLParameters();
            $this->Status->DataSource->wp->AddParameter("1", "expr96", ccsText, "", "", $this->Status->DataSource->Parameters["expr96"], "", false);
            $this->Status->DataSource->wp->Criterion[1] = $this->Status->DataSource->wp->Operation(opEqual, "ref_type", $this->Status->DataSource->wp->GetDBValue("1"), $this->Status->DataSource->ToSQL($this->Status->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->Status->DataSource->Where = 
                 $this->Status->DataSource->wp->Criterion[1];
            $this->Status->Required = true;
            $this->Remark = & new clsControl(ccsTextArea, "Remark", "Remark", ccsText, "", CCGetRequestParam("Remark", $Method, NULL), $this);
            $this->logsrpt_id = & new clsControl(ccsHidden, "logsrpt_id", "logsrpt_id", ccsText, "", CCGetRequestParam("logsrpt_id", $Method, NULL), $this);
            $this->logsrpt_action = & new clsControl(ccsHidden, "logsrpt_action", "logsrpt_action", ccsText, "", CCGetRequestParam("logsrpt_action", $Method, NULL), $this);
            $this->logsrpt_staff = & new clsControl(ccsHidden, "logsrpt_staff", "logsrpt_staff", ccsText, "", CCGetRequestParam("logsrpt_staff", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->logsrpt_action->Value) && !strlen($this->logsrpt_action->Value) && $this->logsrpt_action->Value !== false)
                    $this->logsrpt_action->SetText("UPDATE");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @66-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @66-22AFB8EB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Status->Validate() && $Validation);
        $Validation = ($this->Remark->Validate() && $Validation);
        $Validation = ($this->logsrpt_id->Validate() && $Validation);
        $Validation = ($this->logsrpt_action->Validate() && $Validation);
        $Validation = ($this->logsrpt_staff->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->logsrpt_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->logsrpt_action->Errors->Count() == 0);
        $Validation =  $Validation && ($this->logsrpt_staff->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @66-173F30F8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Status->Errors->Count());
        $errors = ($errors || $this->Remark->Errors->Count());
        $errors = ($errors || $this->logsrpt_id->Errors->Count());
        $errors = ($errors || $this->logsrpt_action->Errors->Count());
        $errors = ($errors || $this->logsrpt_staff->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @66-ED598703
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

//Operation Method @66-37970806
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = "smartsitereport.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "smartsitereport.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @66-D672FF17
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Status->SetValue($this->Status->GetValue(true));
        $this->DataSource->Remark->SetValue($this->Remark->GetValue(true));
        $this->DataSource->logsrpt_id->SetValue($this->logsrpt_id->GetValue(true));
        $this->DataSource->logsrpt_action->SetValue($this->logsrpt_action->GetValue(true));
        $this->DataSource->logsrpt_staff->SetValue($this->logsrpt_staff->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @66-48BA7162
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

        $this->Status->Prepare();

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
                    $this->Status->SetValue($this->DataSource->Status->GetValue());
                    $this->Remark->SetValue($this->DataSource->Remark->GetValue());
                    $this->logsrpt_id->SetValue($this->DataSource->logsrpt_id->GetValue());
                    $this->logsrpt_action->SetValue($this->DataSource->logsrpt_action->GetValue());
                    $this->logsrpt_staff->SetValue($this->DataSource->logsrpt_staff->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->logsrpt_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->logsrpt_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->logsrpt_staff->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $this->Status->Show();
        $this->Remark->Show();
        $this->logsrpt_id->Show();
        $this->logsrpt_action->Show();
        $this->logsrpt_staff->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SUpdStatus Class @66-FCB6E20C

class clsSUpdStatusDataSource extends clsDBSMART {  //SUpdStatusDataSource Class @66-DF2C6E63

//DataSource Variables @66-7C1622BD
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();

    // Datasource fields
    var $Status;
    var $Remark;
    var $logsrpt_id;
    var $logsrpt_action;
    var $logsrpt_staff;
//End DataSource Variables

//DataSourceClass_Initialize Event @66-512EAF4C
    function clsSUpdStatusDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record SUpdStatus/Error";
        $this->Initialize();
        $this->Status = new clsField("Status", ccsText, "");
        
        $this->Remark = new clsField("Remark", ccsText, "");
        
        $this->logsrpt_id = new clsField("logsrpt_id", ccsText, "");
        
        $this->logsrpt_action = new clsField("logsrpt_action", ccsText, "");
        
        $this->logsrpt_staff = new clsField("logsrpt_staff", ccsText, "");
        

        $this->InsertFields["logsrpt_status"] = array("Name" => "logsrpt_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["logsrpt_desc"] = array("Name" => "logsrpt_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["logsrpt_id"] = array("Name" => "logsrpt_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["logsrpt_action"] = array("Name" => "logsrpt_action", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["logsrpt_staff"] = array("Name" => "logsrpt_staff", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @66-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @66-D249ACF1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_logstatussrpt {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @66-DA1E6030
    function SetValues()
    {
        $this->Status->SetDBValue($this->f("logsrpt_status"));
        $this->Remark->SetDBValue($this->f("logsrpt_desc"));
        $this->logsrpt_id->SetDBValue($this->f("logsrpt_id"));
        $this->logsrpt_action->SetDBValue($this->f("logsrpt_action"));
        $this->logsrpt_staff->SetDBValue($this->f("logsrpt_staff"));
    }
//End SetValues Method

//Insert Method @66-6A2EC49E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["logsrpt_status"]["Value"] = $this->Status->GetDBValue(true);
        $this->InsertFields["logsrpt_desc"]["Value"] = $this->Remark->GetDBValue(true);
        $this->InsertFields["logsrpt_id"]["Value"] = $this->logsrpt_id->GetDBValue(true);
        $this->InsertFields["logsrpt_action"]["Value"] = $this->logsrpt_action->GetDBValue(true);
        $this->InsertFields["logsrpt_staff"]["Value"] = $this->logsrpt_staff->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_logstatussrpt", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End SUpdStatusDataSource Class @66-FCB6E20C

class clsRecordRSiteReport { //RSiteReport Class @37-5F2F346B

//Variables @37-D6FF3E86

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

//Class_Initialize Event @37-A065605C
    function clsRecordRSiteReport($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSiteReport/Error";
        $this->DataSource = new clsRSiteReportDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSiteReport";
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
            $this->sr_status = & new clsControl(ccsListBox, "sr_status", "Sr Status", ccsText, "", CCGetRequestParam("sr_status", $Method, NULL), $this);
            $this->sr_status->DSType = dsTable;
            $this->sr_status->DataSource = new clsDBSMART();
            $this->sr_status->ds = & $this->sr_status->DataSource;
            $this->sr_status->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->sr_status->BoundColumn, $this->sr_status->TextColumn, $this->sr_status->DBFormat) = array("ref_value", "ref_description", "");
            $this->sr_status->DataSource->Parameters["expr94"] = statsrpt;
            $this->sr_status->DataSource->wp = new clsSQLParameters();
            $this->sr_status->DataSource->wp->AddParameter("1", "expr94", ccsText, "", "", $this->sr_status->DataSource->Parameters["expr94"], "", false);
            $this->sr_status->DataSource->wp->Criterion[1] = $this->sr_status->DataSource->wp->Operation(opEqual, "ref_type", $this->sr_status->DataSource->wp->GetDBValue("1"), $this->sr_status->DataSource->ToSQL($this->sr_status->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->sr_status->DataSource->Where = 
                 $this->sr_status->DataSource->wp->Criterion[1];
            $this->sr_reportedby = & new clsControl(ccsTextBox, "sr_reportedby", "Reported By", ccsText, "", CCGetRequestParam("sr_reportedby", $Method, NULL), $this);
            $this->sr_takenbyv = & new clsControl(ccsTextBox, "sr_takenbyv", "sr_takenbyv", ccsText, "", CCGetRequestParam("sr_takenbyv", $Method, NULL), $this);
            $this->sr_datereport = & new clsControl(ccsTextBox, "sr_datereport", "Sr Datereport", ccsDate, array("GeneralDate"), CCGetRequestParam("sr_datereport", $Method, NULL), $this);
            $this->DatePicker_sr_datereport = & new clsDatePicker("DatePicker_sr_datereport", "RSiteReport", "sr_datereport", $this);
            $this->sr_sitecode = & new clsControl(ccsListBox, "sr_sitecode", "Site Code", ccsText, "", CCGetRequestParam("sr_sitecode", $Method, NULL), $this);
            $this->sr_sitecode->DSType = dsTable;
            $this->sr_sitecode->DataSource = new clsDBSMART();
            $this->sr_sitecode->ds = & $this->sr_sitecode->DataSource;
            $this->sr_sitecode->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where} {SQL_OrderBy}";
            list($this->sr_sitecode->BoundColumn, $this->sr_sitecode->TextColumn, $this->sr_sitecode->DBFormat) = array("site_code", "site_code", "");
            $this->sr_sitecode->Required = true;
            $this->sr_type = & new clsControl(ccsRadioButton, "sr_type", "Type", ccsText, "", CCGetRequestParam("sr_type", $Method, NULL), $this);
            $this->sr_type->DSType = dsTable;
            $this->sr_type->DataSource = new clsDBSMART();
            $this->sr_type->ds = & $this->sr_type->DataSource;
            $this->sr_type->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->sr_type->DataSource->Order = "ref_rank";
            list($this->sr_type->BoundColumn, $this->sr_type->TextColumn, $this->sr_type->DBFormat) = array("ref_value", "ref_description", "");
            $this->sr_type->DataSource->Parameters["expr55"] = srtype;
            $this->sr_type->DataSource->wp = new clsSQLParameters();
            $this->sr_type->DataSource->wp->AddParameter("1", "expr55", ccsText, "", "", $this->sr_type->DataSource->Parameters["expr55"], "", false);
            $this->sr_type->DataSource->wp->Criterion[1] = $this->sr_type->DataSource->wp->Operation(opEqual, "ref_type", $this->sr_type->DataSource->wp->GetDBValue("1"), $this->sr_type->DataSource->ToSQL($this->sr_type->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->sr_type->DataSource->Where = 
                 $this->sr_type->DataSource->wp->Criterion[1];
            $this->sr_type->DataSource->Order = "ref_rank";
            $this->sr_type->HTML = true;
            $this->sr_type->Required = true;
            $this->sr_report = & new clsControl(ccsTextArea, "sr_report", "Report", ccsMemo, "", CCGetRequestParam("sr_report", $Method, NULL), $this);
            $this->sr_report->Required = true;
            $this->sr_takenby = & new clsControl(ccsHidden, "sr_takenby", "sr_takenby", ccsText, "", CCGetRequestParam("sr_takenby", $Method, NULL), $this);
            $this->EditStatus = & new clsPanel("EditStatus", $this);
            $this->linkStatus = & new clsControl(ccsLink, "linkStatus", "linkStatus", ccsText, "", CCGetRequestParam("linkStatus", $Method, NULL), $this);
            $this->linkStatus->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->linkStatus->Page = "#";
            $this->lblStatus = & new clsControl(ccsLabel, "lblStatus", "lblStatus", ccsText, "", CCGetRequestParam("lblStatus", $Method, NULL), $this);
            $this->EditStatus->AddComponent("linkStatus", $this->linkStatus);
            if(!$this->FormSubmitted) {
                if(!is_array($this->sr_datereport->Value) && !strlen($this->sr_datereport->Value) && $this->sr_datereport->Value !== false)
                    $this->sr_datereport->SetValue(time());
            }
            if(!is_array($this->lblStatus->Value) && !strlen($this->lblStatus->Value) && $this->lblStatus->Value !== false)
                $this->lblStatus->SetText("NEW!");
        }
    }
//End Class_Initialize Event

//Initialize Method @37-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @37-B53D6F8E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->sr_status->Validate() && $Validation);
        $Validation = ($this->sr_reportedby->Validate() && $Validation);
        $Validation = ($this->sr_takenbyv->Validate() && $Validation);
        $Validation = ($this->sr_datereport->Validate() && $Validation);
        $Validation = ($this->sr_sitecode->Validate() && $Validation);
        $Validation = ($this->sr_type->Validate() && $Validation);
        $Validation = ($this->sr_report->Validate() && $Validation);
        $Validation = ($this->sr_takenby->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->sr_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_reportedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_takenbyv->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_datereport->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_sitecode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_report->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sr_takenby->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @37-03A1BB69
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->sr_status->Errors->Count());
        $errors = ($errors || $this->sr_reportedby->Errors->Count());
        $errors = ($errors || $this->sr_takenbyv->Errors->Count());
        $errors = ($errors || $this->sr_datereport->Errors->Count());
        $errors = ($errors || $this->DatePicker_sr_datereport->Errors->Count());
        $errors = ($errors || $this->sr_sitecode->Errors->Count());
        $errors = ($errors || $this->sr_type->Errors->Count());
        $errors = ($errors || $this->sr_report->Errors->Count());
        $errors = ($errors || $this->sr_takenby->Errors->Count());
        $errors = ($errors || $this->linkStatus->Errors->Count());
        $errors = ($errors || $this->lblStatus->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @37-ED598703
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

//Operation Method @37-E70E3E0A
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
            $Redirect = "smartsitereport.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "id", "new", "view"));
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

//InsertRow Method @37-E735D33C
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->sr_status->SetValue($this->sr_status->GetValue(true));
        $this->DataSource->sr_reportedby->SetValue($this->sr_reportedby->GetValue(true));
        $this->DataSource->sr_takenbyv->SetValue($this->sr_takenbyv->GetValue(true));
        $this->DataSource->sr_datereport->SetValue($this->sr_datereport->GetValue(true));
        $this->DataSource->sr_sitecode->SetValue($this->sr_sitecode->GetValue(true));
        $this->DataSource->sr_type->SetValue($this->sr_type->GetValue(true));
        $this->DataSource->sr_report->SetValue($this->sr_report->GetValue(true));
        $this->DataSource->sr_takenby->SetValue($this->sr_takenby->GetValue(true));
        $this->DataSource->linkStatus->SetValue($this->linkStatus->GetValue(true));
        $this->DataSource->lblStatus->SetValue($this->lblStatus->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @37-7EB4D515
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->sr_status->SetValue($this->sr_status->GetValue(true));
        $this->DataSource->sr_reportedby->SetValue($this->sr_reportedby->GetValue(true));
        $this->DataSource->sr_takenbyv->SetValue($this->sr_takenbyv->GetValue(true));
        $this->DataSource->sr_datereport->SetValue($this->sr_datereport->GetValue(true));
        $this->DataSource->sr_sitecode->SetValue($this->sr_sitecode->GetValue(true));
        $this->DataSource->sr_type->SetValue($this->sr_type->GetValue(true));
        $this->DataSource->sr_report->SetValue($this->sr_report->GetValue(true));
        $this->DataSource->sr_takenby->SetValue($this->sr_takenby->GetValue(true));
        $this->DataSource->linkStatus->SetValue($this->linkStatus->GetValue(true));
        $this->DataSource->lblStatus->SetValue($this->lblStatus->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @37-196F4191
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

        $this->sr_status->Prepare();
        $this->sr_sitecode->Prepare();
        $this->sr_type->Prepare();

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
                    $this->sr_status->SetValue($this->DataSource->sr_status->GetValue());
                    $this->sr_reportedby->SetValue($this->DataSource->sr_reportedby->GetValue());
                    $this->sr_datereport->SetValue($this->DataSource->sr_datereport->GetValue());
                    $this->sr_sitecode->SetValue($this->DataSource->sr_sitecode->GetValue());
                    $this->sr_type->SetValue($this->DataSource->sr_type->GetValue());
                    $this->sr_report->SetValue($this->DataSource->sr_report->GetValue());
                    $this->sr_takenby->SetValue($this->DataSource->sr_takenby->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->sr_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_reportedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_takenbyv->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_datereport->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_sr_datereport->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_sitecode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_report->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sr_takenby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->linkStatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblStatus->Errors->ToString());
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
        $this->sr_status->Show();
        $this->sr_reportedby->Show();
        $this->sr_takenbyv->Show();
        $this->sr_datereport->Show();
        $this->DatePicker_sr_datereport->Show();
        $this->sr_sitecode->Show();
        $this->sr_type->Show();
        $this->sr_report->Show();
        $this->sr_takenby->Show();
        $this->EditStatus->Show();
        $this->lblStatus->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSiteReport Class @37-FCB6E20C

class clsRSiteReportDataSource extends clsDBSMART {  //RSiteReportDataSource Class @37-F0189EA7

//DataSource Variables @37-2DFE9467
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
    var $sr_status;
    var $sr_reportedby;
    var $sr_takenbyv;
    var $sr_datereport;
    var $sr_sitecode;
    var $sr_type;
    var $sr_report;
    var $sr_takenby;
    var $linkStatus;
    var $lblStatus;
//End DataSource Variables

//DataSourceClass_Initialize Event @37-1E00B03C
    function clsRSiteReportDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSiteReport/Error";
        $this->Initialize();
        $this->sr_status = new clsField("sr_status", ccsText, "");
        
        $this->sr_reportedby = new clsField("sr_reportedby", ccsText, "");
        
        $this->sr_takenbyv = new clsField("sr_takenbyv", ccsText, "");
        
        $this->sr_datereport = new clsField("sr_datereport", ccsDate, $this->DateFormat);
        
        $this->sr_sitecode = new clsField("sr_sitecode", ccsText, "");
        
        $this->sr_type = new clsField("sr_type", ccsText, "");
        
        $this->sr_report = new clsField("sr_report", ccsMemo, "");
        
        $this->sr_takenby = new clsField("sr_takenby", ccsText, "");
        
        $this->linkStatus = new clsField("linkStatus", ccsText, "");
        
        $this->lblStatus = new clsField("lblStatus", ccsText, "");
        

        $this->InsertFields["sr_status"] = array("Name" => "sr_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_reportedby"] = array("Name" => "sr_reportedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_datereport"] = array("Name" => "sr_datereport", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_sitecode"] = array("Name" => "sr_sitecode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_type"] = array("Name" => "sr_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_report"] = array("Name" => "sr_report", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["sr_takenby"] = array("Name" => "sr_takenby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_status"] = array("Name" => "sr_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_reportedby"] = array("Name" => "sr_reportedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_datereport"] = array("Name" => "sr_datereport", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_sitecode"] = array("Name" => "sr_sitecode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_type"] = array("Name" => "sr_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_report"] = array("Name" => "sr_report", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["sr_takenby"] = array("Name" => "sr_takenby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @37-35B33087
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

//Open Method @37-8C1A99DE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_sitereport {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @37-FF696FD9
    function SetValues()
    {
        $this->sr_status->SetDBValue($this->f("sr_status"));
        $this->sr_reportedby->SetDBValue($this->f("sr_reportedby"));
        $this->sr_datereport->SetDBValue(trim($this->f("sr_datereport")));
        $this->sr_sitecode->SetDBValue($this->f("sr_sitecode"));
        $this->sr_type->SetDBValue($this->f("sr_type"));
        $this->sr_report->SetDBValue($this->f("sr_report"));
        $this->sr_takenby->SetDBValue($this->f("sr_takenby"));
    }
//End SetValues Method

//Insert Method @37-8EC454B1
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["sr_status"]["Value"] = $this->sr_status->GetDBValue(true);
        $this->InsertFields["sr_reportedby"]["Value"] = $this->sr_reportedby->GetDBValue(true);
        $this->InsertFields["sr_datereport"]["Value"] = $this->sr_datereport->GetDBValue(true);
        $this->InsertFields["sr_sitecode"]["Value"] = $this->sr_sitecode->GetDBValue(true);
        $this->InsertFields["sr_type"]["Value"] = $this->sr_type->GetDBValue(true);
        $this->InsertFields["sr_report"]["Value"] = $this->sr_report->GetDBValue(true);
        $this->InsertFields["sr_takenby"]["Value"] = $this->sr_takenby->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_sitereport", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @37-F681699C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["sr_status"]["Value"] = $this->sr_status->GetDBValue(true);
        $this->UpdateFields["sr_reportedby"]["Value"] = $this->sr_reportedby->GetDBValue(true);
        $this->UpdateFields["sr_datereport"]["Value"] = $this->sr_datereport->GetDBValue(true);
        $this->UpdateFields["sr_sitecode"]["Value"] = $this->sr_sitecode->GetDBValue(true);
        $this->UpdateFields["sr_type"]["Value"] = $this->sr_type->GetDBValue(true);
        $this->UpdateFields["sr_report"]["Value"] = $this->sr_report->GetDBValue(true);
        $this->UpdateFields["sr_takenby"]["Value"] = $this->sr_takenby->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_sitereport", $this->UpdateFields, $this);
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

} //End RSiteReportDataSource Class @37-FCB6E20C



//Initialize Page @1-6D86789E
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
$TemplateFileName = "smartsitereport.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F586C048
include_once("./smartsitereport_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C392F821
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GSiteReport = & new clsGridGSiteReport("", $MainPage);
$SSiteReport = & new clsRecordSSiteReport("", $MainPage);
$Panel2 = & new clsPanel("Panel2", $MainPage);
$SUpdStatus = & new clsRecordSUpdStatus("", $MainPage);
$Panel1 = & new clsPanel("Panel1", $MainPage);
$RSiteReport = & new clsRecordRSiteReport("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GSiteReport = & $GSiteReport;
$MainPage->SSiteReport = & $SSiteReport;
$MainPage->Panel2 = & $Panel2;
$MainPage->SUpdStatus = & $SUpdStatus;
$MainPage->Panel1 = & $Panel1;
$MainPage->RSiteReport = & $RSiteReport;
$Panel2->AddComponent("SUpdStatus", $SUpdStatus);
$Panel1->AddComponent("RSiteReport", $RSiteReport);
$GSiteReport->Initialize();
$SUpdStatus->Initialize();
$RSiteReport->Initialize();

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

//Execute Components @1-5DB3C906
$header->Operations();
$footer->Operations();
$SSiteReport->Operation();
$SUpdStatus->Operation();
$RSiteReport->Operation();
//End Execute Components

//Go to destination page @1-900BD349
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GSiteReport);
    unset($SSiteReport);
    unset($SUpdStatus);
    unset($RSiteReport);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-5D8379B0
$header->Show();
$footer->Show();
$GSiteReport->Show();
$SSiteReport->Show();
$Panel2->Show();
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1C9237A6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GSiteReport);
unset($SSiteReport);
unset($SUpdStatus);
unset($RSiteReport);
unset($Tpl);
//End Unload Page


?>
