<?php
//Include Common Files @1-34F79AF1
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartworkshop.php");
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

class clsGridGEquipmentList { //GEquipmentList class @5-34A8DAC8

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

//Class_Initialize Event @5-A47806F6
    function clsGridGEquipmentList($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GEquipmentList";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GEquipmentList";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGEquipmentListDataSource($this);
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

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->wkshp_serial = & new clsControl(ccsLabel, "wkshp_serial", "wkshp_serial", ccsText, "", CCGetRequestParam("wkshp_serial", ccsGet, NULL), $this);
        $this->wkshp_date = & new clsControl(ccsLabel, "wkshp_date", "wkshp_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_date", ccsGet, NULL), $this);
        $this->wkshp_donumber = & new clsControl(ccsLabel, "wkshp_donumber", "wkshp_donumber", ccsText, "", CCGetRequestParam("wkshp_donumber", ccsGet, NULL), $this);
        $this->wkshp_equipment = & new clsControl(ccsLabel, "wkshp_equipment", "wkshp_equipment", ccsText, "", CCGetRequestParam("wkshp_equipment", ccsGet, NULL), $this);
        $this->wkshp_mtn_serialnumber = & new clsControl(ccsLabel, "wkshp_mtn_serialnumber", "wkshp_mtn_serialnumber", ccsText, "", CCGetRequestParam("wkshp_mtn_serialnumber", ccsGet, NULL), $this);
        $this->wkshp_loan_serialnumber = & new clsControl(ccsLabel, "wkshp_loan_serialnumber", "wkshp_loan_serialnumber", ccsText, "", CCGetRequestParam("wkshp_loan_serialnumber", ccsGet, NULL), $this);
        $this->wkshp_requestedby = & new clsControl(ccsLabel, "wkshp_requestedby", "wkshp_requestedby", ccsText, "", CCGetRequestParam("wkshp_requestedby", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "smartworkshop.php";
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

//Show Method @5-83BF3EE7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_wkshp_serial"] = CCGetFromGet("s_wkshp_serial", NULL);
        $this->DataSource->Parameters["urls_wkshp_equipment"] = CCGetFromGet("s_wkshp_equipment", NULL);
        $this->DataSource->Parameters["urls_wkshp_date"] = CCGetFromGet("s_wkshp_date", NULL);
        $this->DataSource->Parameters["urls_wkshp_benchmarkdate"] = CCGetFromGet("s_wkshp_benchmarkdate", NULL);

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
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["wkshp_serial"] = $this->wkshp_serial->Visible;
            $this->ControlsVisible["wkshp_date"] = $this->wkshp_date->Visible;
            $this->ControlsVisible["wkshp_donumber"] = $this->wkshp_donumber->Visible;
            $this->ControlsVisible["wkshp_equipment"] = $this->wkshp_equipment->Visible;
            $this->ControlsVisible["wkshp_mtn_serialnumber"] = $this->wkshp_mtn_serialnumber->Visible;
            $this->ControlsVisible["wkshp_loan_serialnumber"] = $this->wkshp_loan_serialnumber->Visible;
            $this->ControlsVisible["wkshp_requestedby"] = $this->wkshp_requestedby->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->wkshp_serial->SetValue($this->DataSource->wkshp_serial->GetValue());
                $this->wkshp_date->SetValue($this->DataSource->wkshp_date->GetValue());
                $this->wkshp_donumber->SetValue($this->DataSource->wkshp_donumber->GetValue());
                $this->wkshp_equipment->SetValue($this->DataSource->wkshp_equipment->GetValue());
                $this->wkshp_mtn_serialnumber->SetValue($this->DataSource->wkshp_mtn_serialnumber->GetValue());
                $this->wkshp_loan_serialnumber->SetValue($this->DataSource->wkshp_loan_serialnumber->GetValue());
                $this->wkshp_requestedby->SetValue($this->DataSource->wkshp_requestedby->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->wkshp_serial->Show();
                $this->wkshp_date->Show();
                $this->wkshp_donumber->Show();
                $this->wkshp_equipment->Show();
                $this->wkshp_mtn_serialnumber->Show();
                $this->wkshp_loan_serialnumber->Show();
                $this->wkshp_requestedby->Show();
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
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "new", 1);
        $this->Navigator->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-CB329025
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_serial->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_donumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_equipment->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_mtn_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_loan_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_requestedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GEquipmentList Class @5-FCB6E20C

class clsGEquipmentListDataSource extends clsDBSMART {  //GEquipmentListDataSource Class @5-101264A5

//DataSource Variables @5-EE31D2AA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lblNumber;
    var $wkshp_serial;
    var $wkshp_date;
    var $wkshp_donumber;
    var $wkshp_equipment;
    var $wkshp_mtn_serialnumber;
    var $wkshp_loan_serialnumber;
    var $wkshp_requestedby;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-7BE2D21C
    function clsGEquipmentListDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GEquipmentList";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->wkshp_serial = new clsField("wkshp_serial", ccsText, "");
        
        $this->wkshp_date = new clsField("wkshp_date", ccsDate, $this->DateFormat);
        
        $this->wkshp_donumber = new clsField("wkshp_donumber", ccsText, "");
        
        $this->wkshp_equipment = new clsField("wkshp_equipment", ccsText, "");
        
        $this->wkshp_mtn_serialnumber = new clsField("wkshp_mtn_serialnumber", ccsText, "");
        
        $this->wkshp_loan_serialnumber = new clsField("wkshp_loan_serialnumber", ccsText, "");
        
        $this->wkshp_requestedby = new clsField("wkshp_requestedby", ccsText, "");
        

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

//Prepare Method @5-79E2DCEF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_wkshp_serial", ccsText, "", "", $this->Parameters["urls_wkshp_serial"], "", false);
        $this->wp->AddParameter("2", "urls_wkshp_equipment", ccsText, "", "", $this->Parameters["urls_wkshp_equipment"], "", false);
        $this->wp->AddParameter("3", "urls_wkshp_date", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_wkshp_date"], "", false);
        $this->wp->AddParameter("4", "urls_wkshp_benchmarkdate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_wkshp_benchmarkdate"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "wkshp_serial", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "wkshp_equipment", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "wkshp_date", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "wkshp_benchmarkdate", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
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

//Open Method @5-BCC832CF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_workshop";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_workshop {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-39988D5C
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->wkshp_serial->SetDBValue($this->f("wkshp_serial"));
        $this->wkshp_date->SetDBValue(trim($this->f("wkshp_date")));
        $this->wkshp_donumber->SetDBValue($this->f("wkshp_donumber"));
        $this->wkshp_equipment->SetDBValue($this->f("wkshp_equipment"));
        $this->wkshp_mtn_serialnumber->SetDBValue($this->f("wkshp_mtn_serialnumber"));
        $this->wkshp_loan_serialnumber->SetDBValue($this->f("wkshp_loan_serialnumber"));
        $this->wkshp_requestedby->SetDBValue($this->f("wkshp_requestedby"));
    }
//End SetValues Method

} //End GEquipmentListDataSource Class @5-FCB6E20C

class clsRecordSEquipment { //SEquipment Class @6-080E2FF9

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

//Class_Initialize Event @6-6CC63832
    function clsRecordSEquipment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SEquipment/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SEquipment";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_wkshp_serial = & new clsControl(ccsTextBox, "s_wkshp_serial", "s_wkshp_serial", ccsText, "", CCGetRequestParam("s_wkshp_serial", $Method, NULL), $this);
            $this->s_wkshp_date = & new clsControl(ccsTextBox, "s_wkshp_date", "s_wkshp_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_wkshp_date", $Method, NULL), $this);
            $this->DatePicker_s_wkshp_date = & new clsDatePicker("DatePicker_s_wkshp_date", "SEquipment", "s_wkshp_date", $this);
            $this->s_wkshp_equipment = & new clsControl(ccsListBox, "s_wkshp_equipment", "s_wkshp_equipment", ccsText, "", CCGetRequestParam("s_wkshp_equipment", $Method, NULL), $this);
            $this->s_wkshp_equipment->DSType = dsTable;
            $this->s_wkshp_equipment->DataSource = new clsDBSMART();
            $this->s_wkshp_equipment->ds = & $this->s_wkshp_equipment->DataSource;
            $this->s_wkshp_equipment->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->s_wkshp_equipment->BoundColumn, $this->s_wkshp_equipment->TextColumn, $this->s_wkshp_equipment->DBFormat) = array("eqpmt_code", "eqpmt_name", "");
            $this->s_wkshp_benchmarkdate = & new clsControl(ccsTextBox, "s_wkshp_benchmarkdate", "s_wkshp_benchmarkdate", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_wkshp_benchmarkdate", $Method, NULL), $this);
            $this->DatePicker_s_wkshp_benchmarkdate = & new clsDatePicker("DatePicker_s_wkshp_benchmarkdate", "SEquipment", "s_wkshp_benchmarkdate", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @6-03FF3EED
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_wkshp_serial->Validate() && $Validation);
        $Validation = ($this->s_wkshp_date->Validate() && $Validation);
        $Validation = ($this->s_wkshp_equipment->Validate() && $Validation);
        $Validation = ($this->s_wkshp_benchmarkdate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_wkshp_serial->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_wkshp_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_wkshp_equipment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_wkshp_benchmarkdate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-99097116
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_wkshp_serial->Errors->Count());
        $errors = ($errors || $this->s_wkshp_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_wkshp_date->Errors->Count());
        $errors = ($errors || $this->s_wkshp_equipment->Errors->Count());
        $errors = ($errors || $this->s_wkshp_benchmarkdate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_wkshp_benchmarkdate->Errors->Count());
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

//Operation Method @6-FB0C428B
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
        $Redirect = "smartworkshop.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartworkshop.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-E1261F03
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

        $this->s_wkshp_equipment->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_wkshp_serial->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_wkshp_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_wkshp_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_wkshp_equipment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_wkshp_benchmarkdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_wkshp_benchmarkdate->Errors->ToString());
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
        $this->s_wkshp_serial->Show();
        $this->s_wkshp_date->Show();
        $this->DatePicker_s_wkshp_date->Show();
        $this->s_wkshp_equipment->Show();
        $this->s_wkshp_benchmarkdate->Show();
        $this->DatePicker_s_wkshp_benchmarkdate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SEquipment Class @6-FCB6E20C

class clsRecordREquipmentForm { //REquipmentForm Class @30-BA9D63BA

//Variables @30-D6FF3E86

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

//Class_Initialize Event @30-B56F3FFC
    function clsRecordREquipmentForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record REquipmentForm/Error";
        $this->DataSource = new clsREquipmentFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "REquipmentForm";
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
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->wkshp_serial = & new clsControl(ccsTextBox, "wkshp_serial", "Wkshp Serial", ccsText, "", CCGetRequestParam("wkshp_serial", $Method, NULL), $this);
            $this->wkshp_date = & new clsControl(ccsTextBox, "wkshp_date", "Wkshp Date", ccsDate, array("GeneralDate"), CCGetRequestParam("wkshp_date", $Method, NULL), $this);
            $this->wkshp_date->Required = true;
            $this->DatePicker_wkshp_date = & new clsDatePicker("DatePicker_wkshp_date", "REquipmentForm", "wkshp_date", $this);
            $this->wkshp_benchmarkdate = & new clsControl(ccsTextBox, "wkshp_benchmarkdate", "Wkshp Benchmarkdate", ccsDate, array("GeneralDate"), CCGetRequestParam("wkshp_benchmarkdate", $Method, NULL), $this);
            $this->wkshp_benchmarkdate->Required = true;
            $this->DatePicker_wkshp_benchmarkdate = & new clsDatePicker("DatePicker_wkshp_benchmarkdate", "REquipmentForm", "wkshp_benchmarkdate", $this);
            $this->wkshp_equipment = & new clsControl(ccsListBox, "wkshp_equipment", "Wkshp Equipment", ccsText, "", CCGetRequestParam("wkshp_equipment", $Method, NULL), $this);
            $this->wkshp_equipment->DSType = dsTable;
            $this->wkshp_equipment->DataSource = new clsDBSMART();
            $this->wkshp_equipment->ds = & $this->wkshp_equipment->DataSource;
            $this->wkshp_equipment->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->wkshp_equipment->BoundColumn, $this->wkshp_equipment->TextColumn, $this->wkshp_equipment->DBFormat) = array("eqpmt_code", "eqpmt_name", "");
            $this->wkshp_equipment->Required = true;
            $this->wkshp_eq_origin = & new clsControl(ccsListBox, "wkshp_eq_origin", "Wkshp Eq Origin", ccsText, "", CCGetRequestParam("wkshp_eq_origin", $Method, NULL), $this);
            $this->wkshp_eq_origin->DSType = dsTable;
            $this->wkshp_eq_origin->DataSource = new clsDBSMART();
            $this->wkshp_eq_origin->ds = & $this->wkshp_eq_origin->DataSource;
            $this->wkshp_eq_origin->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where} {SQL_OrderBy}";
            $this->wkshp_eq_origin->DataSource->Order = "site_code";
            list($this->wkshp_eq_origin->BoundColumn, $this->wkshp_eq_origin->TextColumn, $this->wkshp_eq_origin->DBFormat) = array("site_code", "site_code", "");
            $this->wkshp_eq_origin->DataSource->Order = "site_code";
            $this->wkshp_eq_origin->Required = true;
            $this->wkshp_mtn_serialnumber = & new clsControl(ccsTextBox, "wkshp_mtn_serialnumber", "Wkshp Mtn Serialnumber", ccsText, "", CCGetRequestParam("wkshp_mtn_serialnumber", $Method, NULL), $this);
            $this->wkshp_loan_serialnumber = & new clsControl(ccsTextBox, "wkshp_loan_serialnumber", "Wkshp Loan Serialnumber", ccsText, "", CCGetRequestParam("wkshp_loan_serialnumber", $Method, NULL), $this);
            $this->wkshp_eq_location = & new clsControl(ccsListBox, "wkshp_eq_location", "Wkshp Eq Location", ccsText, "", CCGetRequestParam("wkshp_eq_location", $Method, NULL), $this);
            $this->wkshp_eq_location->DSType = dsTable;
            $this->wkshp_eq_location->DataSource = new clsDBSMART();
            $this->wkshp_eq_location->ds = & $this->wkshp_eq_location->DataSource;
            $this->wkshp_eq_location->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where} {SQL_OrderBy}";
            $this->wkshp_eq_location->DataSource->Order = "site_code";
            list($this->wkshp_eq_location->BoundColumn, $this->wkshp_eq_location->TextColumn, $this->wkshp_eq_location->DBFormat) = array("site_code", "site_name", "");
            $this->wkshp_eq_location->DataSource->Order = "site_code";
            $this->wkshp_eq_deliverymethod = & new clsControl(ccsRadioButton, "wkshp_eq_deliverymethod", "Wkshp Eq Deliverymethod", ccsText, "", CCGetRequestParam("wkshp_eq_deliverymethod", $Method, NULL), $this);
            $this->wkshp_eq_deliverymethod->DSType = dsListOfValues;
            $this->wkshp_eq_deliverymethod->Values = array(array("1", "BY HAND"), array("2", "BY COURIER"));
            $this->wkshp_eq_deliverymethod->HTML = true;
            $this->wkshp_remark = & new clsControl(ccsTextArea, "wkshp_remark", "Wkshp Remark", ccsMemo, "", CCGetRequestParam("wkshp_remark", $Method, NULL), $this);
            $this->wkshp_request = & new clsControl(ccsRadioButton, "wkshp_request", "Wkshp Request", ccsText, "", CCGetRequestParam("wkshp_request", $Method, NULL), $this);
            $this->wkshp_request->DSType = dsListOfValues;
            $this->wkshp_request->Values = array(array("1", "IN"), array("2", "OUT"));
            $this->wkshp_request->HTML = true;
            $this->wkshp_request->Required = true;
            $this->wkshp_donumber = & new clsControl(ccsTextBox, "wkshp_donumber", "Wkshp Donumber", ccsText, "", CCGetRequestParam("wkshp_donumber", $Method, NULL), $this);
            $this->TextBox1 = & new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->wkshp_deliveredcourier = & new clsControl(ccsListBox, "wkshp_deliveredcourier", "wkshp_deliveredcourier", ccsText, "", CCGetRequestParam("wkshp_deliveredcourier", $Method, NULL), $this);
            $this->wkshp_requestedby = & new clsControl(ccsListBox, "wkshp_requestedby", "Wkshp Requestedby", ccsText, "", CCGetRequestParam("wkshp_requestedby", $Method, NULL), $this);
            $this->wkshp_requestedby->DSType = dsTable;
            $this->wkshp_requestedby->DataSource = new clsDBSMART();
            $this->wkshp_requestedby->ds = & $this->wkshp_requestedby->DataSource;
            $this->wkshp_requestedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->wkshp_requestedby->BoundColumn, $this->wkshp_requestedby->TextColumn, $this->wkshp_requestedby->DBFormat) = array("id", "usr_username", "");
            $this->wkshp_requesteddate = & new clsControl(ccsTextBox, "wkshp_requesteddate", "Wkshp Requesteddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_requesteddate", $Method, NULL), $this);
            $this->DatePicker_wkshp_requesteddate = & new clsDatePicker("DatePicker_wkshp_requesteddate", "REquipmentForm", "wkshp_requesteddate", $this);
            $this->wkshp_receivedby = & new clsControl(ccsListBox, "wkshp_receivedby", "Wkshp Receivedby", ccsInteger, "", CCGetRequestParam("wkshp_receivedby", $Method, NULL), $this);
            $this->wkshp_receivedby->DSType = dsTable;
            $this->wkshp_receivedby->DataSource = new clsDBSMART();
            $this->wkshp_receivedby->ds = & $this->wkshp_receivedby->DataSource;
            $this->wkshp_receivedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->wkshp_receivedby->BoundColumn, $this->wkshp_receivedby->TextColumn, $this->wkshp_receivedby->DBFormat) = array("id", "usr_username", "");
            $this->wkshp_receiveddate = & new clsControl(ccsTextBox, "wkshp_receiveddate", "Wkshp Receiveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_receiveddate", $Method, NULL), $this);
            $this->DatePicker_wkshp_receiveddate = & new clsDatePicker("DatePicker_wkshp_receiveddate", "REquipmentForm", "wkshp_receiveddate", $this);
            $this->wkshp_authorizedby = & new clsControl(ccsListBox, "wkshp_authorizedby", "Wkshp Authorizedby", ccsInteger, "", CCGetRequestParam("wkshp_authorizedby", $Method, NULL), $this);
            $this->wkshp_authorizedby->DSType = dsTable;
            $this->wkshp_authorizedby->DataSource = new clsDBSMART();
            $this->wkshp_authorizedby->ds = & $this->wkshp_authorizedby->DataSource;
            $this->wkshp_authorizedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->wkshp_authorizedby->BoundColumn, $this->wkshp_authorizedby->TextColumn, $this->wkshp_authorizedby->DBFormat) = array("id", "usr_username", "");
            $this->wkshp_authorizeddate = & new clsControl(ccsTextBox, "wkshp_authorizeddate", "Wkshp Authorizeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_authorizeddate", $Method, NULL), $this);
            $this->DatePicker_wkshp_authorizeddate = & new clsDatePicker("DatePicker_wkshp_authorizeddate", "REquipmentForm", "wkshp_authorizeddate", $this);
            $this->wkshp_deliveredby = & new clsControl(ccsListBox, "wkshp_deliveredby", "Wkshp Deliveredby", ccsInteger, "", CCGetRequestParam("wkshp_deliveredby", $Method, NULL), $this);
            $this->wkshp_deliveredby->DSType = dsTable;
            $this->wkshp_deliveredby->DataSource = new clsDBSMART();
            $this->wkshp_deliveredby->ds = & $this->wkshp_deliveredby->DataSource;
            $this->wkshp_deliveredby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->wkshp_deliveredby->BoundColumn, $this->wkshp_deliveredby->TextColumn, $this->wkshp_deliveredby->DBFormat) = array("id", "usr_username", "");
            $this->wkshp_delivereddate = & new clsControl(ccsTextBox, "wkshp_delivereddate", "Wkshp Delivereddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_delivereddate", $Method, NULL), $this);
            $this->DatePicker_wkshp_delivereddate = & new clsDatePicker("DatePicker_wkshp_delivereddate", "REquipmentForm", "wkshp_delivereddate", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->wkshp_date->Value) && !strlen($this->wkshp_date->Value) && $this->wkshp_date->Value !== false)
                    $this->wkshp_date->SetValue(time());
                if(!is_array($this->wkshp_benchmarkdate->Value) && !strlen($this->wkshp_benchmarkdate->Value) && $this->wkshp_benchmarkdate->Value !== false)
                    $this->wkshp_benchmarkdate->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @30-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @30-758FD1E3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->wkshp_serial->Validate() && $Validation);
        $Validation = ($this->wkshp_date->Validate() && $Validation);
        $Validation = ($this->wkshp_benchmarkdate->Validate() && $Validation);
        $Validation = ($this->wkshp_equipment->Validate() && $Validation);
        $Validation = ($this->wkshp_eq_origin->Validate() && $Validation);
        $Validation = ($this->wkshp_mtn_serialnumber->Validate() && $Validation);
        $Validation = ($this->wkshp_loan_serialnumber->Validate() && $Validation);
        $Validation = ($this->wkshp_eq_location->Validate() && $Validation);
        $Validation = ($this->wkshp_eq_deliverymethod->Validate() && $Validation);
        $Validation = ($this->wkshp_remark->Validate() && $Validation);
        $Validation = ($this->wkshp_request->Validate() && $Validation);
        $Validation = ($this->wkshp_donumber->Validate() && $Validation);
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $Validation = ($this->wkshp_deliveredcourier->Validate() && $Validation);
        $Validation = ($this->wkshp_requestedby->Validate() && $Validation);
        $Validation = ($this->wkshp_requesteddate->Validate() && $Validation);
        $Validation = ($this->wkshp_receivedby->Validate() && $Validation);
        $Validation = ($this->wkshp_receiveddate->Validate() && $Validation);
        $Validation = ($this->wkshp_authorizedby->Validate() && $Validation);
        $Validation = ($this->wkshp_authorizeddate->Validate() && $Validation);
        $Validation = ($this->wkshp_deliveredby->Validate() && $Validation);
        $Validation = ($this->wkshp_delivereddate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->wkshp_serial->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_benchmarkdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_equipment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_eq_origin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_mtn_serialnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_loan_serialnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_eq_location->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_eq_deliverymethod->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_request->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_donumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_deliveredcourier->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_requestedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_requesteddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_receivedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_receiveddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_authorizedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_authorizeddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_deliveredby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wkshp_delivereddate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @30-9EF43CBA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->wkshp_serial->Errors->Count());
        $errors = ($errors || $this->wkshp_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_date->Errors->Count());
        $errors = ($errors || $this->wkshp_benchmarkdate->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_benchmarkdate->Errors->Count());
        $errors = ($errors || $this->wkshp_equipment->Errors->Count());
        $errors = ($errors || $this->wkshp_eq_origin->Errors->Count());
        $errors = ($errors || $this->wkshp_mtn_serialnumber->Errors->Count());
        $errors = ($errors || $this->wkshp_loan_serialnumber->Errors->Count());
        $errors = ($errors || $this->wkshp_eq_location->Errors->Count());
        $errors = ($errors || $this->wkshp_eq_deliverymethod->Errors->Count());
        $errors = ($errors || $this->wkshp_remark->Errors->Count());
        $errors = ($errors || $this->wkshp_request->Errors->Count());
        $errors = ($errors || $this->wkshp_donumber->Errors->Count());
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->wkshp_deliveredcourier->Errors->Count());
        $errors = ($errors || $this->wkshp_requestedby->Errors->Count());
        $errors = ($errors || $this->wkshp_requesteddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_requesteddate->Errors->Count());
        $errors = ($errors || $this->wkshp_receivedby->Errors->Count());
        $errors = ($errors || $this->wkshp_receiveddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_receiveddate->Errors->Count());
        $errors = ($errors || $this->wkshp_authorizedby->Errors->Count());
        $errors = ($errors || $this->wkshp_authorizeddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_authorizeddate->Errors->Count());
        $errors = ($errors || $this->wkshp_deliveredby->Errors->Count());
        $errors = ($errors || $this->wkshp_delivereddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_wkshp_delivereddate->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @30-ED598703
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

//Operation Method @30-288F0419
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
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
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

//InsertRow Method @30-A1B8302D
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->wkshp_serial->SetValue($this->wkshp_serial->GetValue(true));
        $this->DataSource->wkshp_date->SetValue($this->wkshp_date->GetValue(true));
        $this->DataSource->wkshp_benchmarkdate->SetValue($this->wkshp_benchmarkdate->GetValue(true));
        $this->DataSource->wkshp_equipment->SetValue($this->wkshp_equipment->GetValue(true));
        $this->DataSource->wkshp_eq_origin->SetValue($this->wkshp_eq_origin->GetValue(true));
        $this->DataSource->wkshp_mtn_serialnumber->SetValue($this->wkshp_mtn_serialnumber->GetValue(true));
        $this->DataSource->wkshp_loan_serialnumber->SetValue($this->wkshp_loan_serialnumber->GetValue(true));
        $this->DataSource->wkshp_eq_location->SetValue($this->wkshp_eq_location->GetValue(true));
        $this->DataSource->wkshp_eq_deliverymethod->SetValue($this->wkshp_eq_deliverymethod->GetValue(true));
        $this->DataSource->wkshp_remark->SetValue($this->wkshp_remark->GetValue(true));
        $this->DataSource->wkshp_request->SetValue($this->wkshp_request->GetValue(true));
        $this->DataSource->wkshp_donumber->SetValue($this->wkshp_donumber->GetValue(true));
        $this->DataSource->TextBox1->SetValue($this->TextBox1->GetValue(true));
        $this->DataSource->wkshp_deliveredcourier->SetValue($this->wkshp_deliveredcourier->GetValue(true));
        $this->DataSource->wkshp_requestedby->SetValue($this->wkshp_requestedby->GetValue(true));
        $this->DataSource->wkshp_requesteddate->SetValue($this->wkshp_requesteddate->GetValue(true));
        $this->DataSource->wkshp_receivedby->SetValue($this->wkshp_receivedby->GetValue(true));
        $this->DataSource->wkshp_receiveddate->SetValue($this->wkshp_receiveddate->GetValue(true));
        $this->DataSource->wkshp_authorizedby->SetValue($this->wkshp_authorizedby->GetValue(true));
        $this->DataSource->wkshp_authorizeddate->SetValue($this->wkshp_authorizeddate->GetValue(true));
        $this->DataSource->wkshp_deliveredby->SetValue($this->wkshp_deliveredby->GetValue(true));
        $this->DataSource->wkshp_delivereddate->SetValue($this->wkshp_delivereddate->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @30-E5C3E395
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->wkshp_serial->SetValue($this->wkshp_serial->GetValue(true));
        $this->DataSource->wkshp_date->SetValue($this->wkshp_date->GetValue(true));
        $this->DataSource->wkshp_benchmarkdate->SetValue($this->wkshp_benchmarkdate->GetValue(true));
        $this->DataSource->wkshp_equipment->SetValue($this->wkshp_equipment->GetValue(true));
        $this->DataSource->wkshp_eq_origin->SetValue($this->wkshp_eq_origin->GetValue(true));
        $this->DataSource->wkshp_mtn_serialnumber->SetValue($this->wkshp_mtn_serialnumber->GetValue(true));
        $this->DataSource->wkshp_loan_serialnumber->SetValue($this->wkshp_loan_serialnumber->GetValue(true));
        $this->DataSource->wkshp_eq_location->SetValue($this->wkshp_eq_location->GetValue(true));
        $this->DataSource->wkshp_eq_deliverymethod->SetValue($this->wkshp_eq_deliverymethod->GetValue(true));
        $this->DataSource->wkshp_remark->SetValue($this->wkshp_remark->GetValue(true));
        $this->DataSource->wkshp_request->SetValue($this->wkshp_request->GetValue(true));
        $this->DataSource->wkshp_donumber->SetValue($this->wkshp_donumber->GetValue(true));
        $this->DataSource->TextBox1->SetValue($this->TextBox1->GetValue(true));
        $this->DataSource->wkshp_deliveredcourier->SetValue($this->wkshp_deliveredcourier->GetValue(true));
        $this->DataSource->wkshp_requestedby->SetValue($this->wkshp_requestedby->GetValue(true));
        $this->DataSource->wkshp_requesteddate->SetValue($this->wkshp_requesteddate->GetValue(true));
        $this->DataSource->wkshp_receivedby->SetValue($this->wkshp_receivedby->GetValue(true));
        $this->DataSource->wkshp_receiveddate->SetValue($this->wkshp_receiveddate->GetValue(true));
        $this->DataSource->wkshp_authorizedby->SetValue($this->wkshp_authorizedby->GetValue(true));
        $this->DataSource->wkshp_authorizeddate->SetValue($this->wkshp_authorizeddate->GetValue(true));
        $this->DataSource->wkshp_deliveredby->SetValue($this->wkshp_deliveredby->GetValue(true));
        $this->DataSource->wkshp_delivereddate->SetValue($this->wkshp_delivereddate->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @30-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @30-26D03DC9
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

        $this->wkshp_equipment->Prepare();
        $this->wkshp_eq_origin->Prepare();
        $this->wkshp_eq_location->Prepare();
        $this->wkshp_eq_deliverymethod->Prepare();
        $this->wkshp_request->Prepare();
        $this->wkshp_deliveredcourier->Prepare();
        $this->wkshp_requestedby->Prepare();
        $this->wkshp_receivedby->Prepare();
        $this->wkshp_authorizedby->Prepare();
        $this->wkshp_deliveredby->Prepare();

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
                    $this->wkshp_serial->SetValue($this->DataSource->wkshp_serial->GetValue());
                    $this->wkshp_date->SetValue($this->DataSource->wkshp_date->GetValue());
                    $this->wkshp_benchmarkdate->SetValue($this->DataSource->wkshp_benchmarkdate->GetValue());
                    $this->wkshp_equipment->SetValue($this->DataSource->wkshp_equipment->GetValue());
                    $this->wkshp_eq_origin->SetValue($this->DataSource->wkshp_eq_origin->GetValue());
                    $this->wkshp_mtn_serialnumber->SetValue($this->DataSource->wkshp_mtn_serialnumber->GetValue());
                    $this->wkshp_loan_serialnumber->SetValue($this->DataSource->wkshp_loan_serialnumber->GetValue());
                    $this->wkshp_eq_location->SetValue($this->DataSource->wkshp_eq_location->GetValue());
                    $this->wkshp_eq_deliverymethod->SetValue($this->DataSource->wkshp_eq_deliverymethod->GetValue());
                    $this->wkshp_remark->SetValue($this->DataSource->wkshp_remark->GetValue());
                    $this->wkshp_request->SetValue($this->DataSource->wkshp_request->GetValue());
                    $this->wkshp_donumber->SetValue($this->DataSource->wkshp_donumber->GetValue());
                    $this->wkshp_deliveredcourier->SetValue($this->DataSource->wkshp_deliveredcourier->GetValue());
                    $this->wkshp_requestedby->SetValue($this->DataSource->wkshp_requestedby->GetValue());
                    $this->wkshp_requesteddate->SetValue($this->DataSource->wkshp_requesteddate->GetValue());
                    $this->wkshp_receivedby->SetValue($this->DataSource->wkshp_receivedby->GetValue());
                    $this->wkshp_receiveddate->SetValue($this->DataSource->wkshp_receiveddate->GetValue());
                    $this->wkshp_authorizedby->SetValue($this->DataSource->wkshp_authorizedby->GetValue());
                    $this->wkshp_authorizeddate->SetValue($this->DataSource->wkshp_authorizeddate->GetValue());
                    $this->wkshp_deliveredby->SetValue($this->DataSource->wkshp_deliveredby->GetValue());
                    $this->wkshp_delivereddate->SetValue($this->DataSource->wkshp_delivereddate->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->wkshp_serial->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_benchmarkdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_benchmarkdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_equipment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_eq_origin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_mtn_serialnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_loan_serialnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_eq_location->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_eq_deliverymethod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_request->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_donumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_deliveredcourier->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_requestedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_requesteddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_requesteddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_receivedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_authorizedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_authorizeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_authorizeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_deliveredby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wkshp_delivereddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_wkshp_delivereddate->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->wkshp_serial->Show();
        $this->wkshp_date->Show();
        $this->DatePicker_wkshp_date->Show();
        $this->wkshp_benchmarkdate->Show();
        $this->DatePicker_wkshp_benchmarkdate->Show();
        $this->wkshp_equipment->Show();
        $this->wkshp_eq_origin->Show();
        $this->wkshp_mtn_serialnumber->Show();
        $this->wkshp_loan_serialnumber->Show();
        $this->wkshp_eq_location->Show();
        $this->wkshp_eq_deliverymethod->Show();
        $this->wkshp_remark->Show();
        $this->wkshp_request->Show();
        $this->wkshp_donumber->Show();
        $this->TextBox1->Show();
        $this->wkshp_deliveredcourier->Show();
        $this->wkshp_requestedby->Show();
        $this->wkshp_requesteddate->Show();
        $this->DatePicker_wkshp_requesteddate->Show();
        $this->wkshp_receivedby->Show();
        $this->wkshp_receiveddate->Show();
        $this->DatePicker_wkshp_receiveddate->Show();
        $this->wkshp_authorizedby->Show();
        $this->wkshp_authorizeddate->Show();
        $this->DatePicker_wkshp_authorizeddate->Show();
        $this->wkshp_deliveredby->Show();
        $this->wkshp_delivereddate->Show();
        $this->DatePicker_wkshp_delivereddate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End REquipmentForm Class @30-FCB6E20C

class clsREquipmentFormDataSource extends clsDBSMART {  //REquipmentFormDataSource Class @30-C19AA972

//DataSource Variables @30-D38452C8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $wkshp_serial;
    var $wkshp_date;
    var $wkshp_benchmarkdate;
    var $wkshp_equipment;
    var $wkshp_eq_origin;
    var $wkshp_mtn_serialnumber;
    var $wkshp_loan_serialnumber;
    var $wkshp_eq_location;
    var $wkshp_eq_deliverymethod;
    var $wkshp_remark;
    var $wkshp_request;
    var $wkshp_donumber;
    var $TextBox1;
    var $wkshp_deliveredcourier;
    var $wkshp_requestedby;
    var $wkshp_requesteddate;
    var $wkshp_receivedby;
    var $wkshp_receiveddate;
    var $wkshp_authorizedby;
    var $wkshp_authorizeddate;
    var $wkshp_deliveredby;
    var $wkshp_delivereddate;
//End DataSource Variables

//DataSourceClass_Initialize Event @30-E0FF413F
    function clsREquipmentFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record REquipmentForm/Error";
        $this->Initialize();
        $this->wkshp_serial = new clsField("wkshp_serial", ccsText, "");
        
        $this->wkshp_date = new clsField("wkshp_date", ccsDate, $this->DateFormat);
        
        $this->wkshp_benchmarkdate = new clsField("wkshp_benchmarkdate", ccsDate, $this->DateFormat);
        
        $this->wkshp_equipment = new clsField("wkshp_equipment", ccsText, "");
        
        $this->wkshp_eq_origin = new clsField("wkshp_eq_origin", ccsText, "");
        
        $this->wkshp_mtn_serialnumber = new clsField("wkshp_mtn_serialnumber", ccsText, "");
        
        $this->wkshp_loan_serialnumber = new clsField("wkshp_loan_serialnumber", ccsText, "");
        
        $this->wkshp_eq_location = new clsField("wkshp_eq_location", ccsText, "");
        
        $this->wkshp_eq_deliverymethod = new clsField("wkshp_eq_deliverymethod", ccsText, "");
        
        $this->wkshp_remark = new clsField("wkshp_remark", ccsMemo, "");
        
        $this->wkshp_request = new clsField("wkshp_request", ccsText, "");
        
        $this->wkshp_donumber = new clsField("wkshp_donumber", ccsText, "");
        
        $this->TextBox1 = new clsField("TextBox1", ccsText, "");
        
        $this->wkshp_deliveredcourier = new clsField("wkshp_deliveredcourier", ccsText, "");
        
        $this->wkshp_requestedby = new clsField("wkshp_requestedby", ccsText, "");
        
        $this->wkshp_requesteddate = new clsField("wkshp_requesteddate", ccsDate, $this->DateFormat);
        
        $this->wkshp_receivedby = new clsField("wkshp_receivedby", ccsInteger, "");
        
        $this->wkshp_receiveddate = new clsField("wkshp_receiveddate", ccsDate, $this->DateFormat);
        
        $this->wkshp_authorizedby = new clsField("wkshp_authorizedby", ccsInteger, "");
        
        $this->wkshp_authorizeddate = new clsField("wkshp_authorizeddate", ccsDate, $this->DateFormat);
        
        $this->wkshp_deliveredby = new clsField("wkshp_deliveredby", ccsInteger, "");
        
        $this->wkshp_delivereddate = new clsField("wkshp_delivereddate", ccsDate, $this->DateFormat);
        

        $this->InsertFields["wkshp_serial"] = array("Name" => "wkshp_serial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_date"] = array("Name" => "wkshp_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_benchmarkdate"] = array("Name" => "wkshp_benchmarkdate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_equipment"] = array("Name" => "wkshp_equipment", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_eq_origin"] = array("Name" => "wkshp_eq_origin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_mtn_serialnumber"] = array("Name" => "wkshp_mtn_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_loan_serialnumber"] = array("Name" => "wkshp_loan_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_eq_location"] = array("Name" => "wkshp_eq_location", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_eq_deliverymethod"] = array("Name" => "wkshp_eq_deliverymethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_remark"] = array("Name" => "wkshp_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_request"] = array("Name" => "wkshp_request", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_donumber"] = array("Name" => "wkshp_donumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_deliveredcourier"] = array("Name" => "wkshp_deliveredcourier", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_requestedby"] = array("Name" => "wkshp_requestedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_requesteddate"] = array("Name" => "wkshp_requesteddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_receivedby"] = array("Name" => "wkshp_receivedby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_receiveddate"] = array("Name" => "wkshp_receiveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_authorizedby"] = array("Name" => "wkshp_authorizedby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_authorizeddate"] = array("Name" => "wkshp_authorizeddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_deliveredby"] = array("Name" => "wkshp_deliveredby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["wkshp_delivereddate"] = array("Name" => "wkshp_delivereddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_serial"] = array("Name" => "wkshp_serial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_date"] = array("Name" => "wkshp_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_benchmarkdate"] = array("Name" => "wkshp_benchmarkdate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_equipment"] = array("Name" => "wkshp_equipment", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_eq_origin"] = array("Name" => "wkshp_eq_origin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_mtn_serialnumber"] = array("Name" => "wkshp_mtn_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_loan_serialnumber"] = array("Name" => "wkshp_loan_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_eq_location"] = array("Name" => "wkshp_eq_location", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_eq_deliverymethod"] = array("Name" => "wkshp_eq_deliverymethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_remark"] = array("Name" => "wkshp_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_request"] = array("Name" => "wkshp_request", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_donumber"] = array("Name" => "wkshp_donumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_deliveredcourier"] = array("Name" => "wkshp_deliveredcourier", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_requestedby"] = array("Name" => "wkshp_requestedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_requesteddate"] = array("Name" => "wkshp_requesteddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_receivedby"] = array("Name" => "wkshp_receivedby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_receiveddate"] = array("Name" => "wkshp_receiveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_authorizedby"] = array("Name" => "wkshp_authorizedby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_authorizeddate"] = array("Name" => "wkshp_authorizeddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_deliveredby"] = array("Name" => "wkshp_deliveredby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["wkshp_delivereddate"] = array("Name" => "wkshp_delivereddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @30-35B33087
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

//Open Method @30-22E8261A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_workshop {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @30-D2F02FD2
    function SetValues()
    {
        $this->wkshp_serial->SetDBValue($this->f("wkshp_serial"));
        $this->wkshp_date->SetDBValue(trim($this->f("wkshp_date")));
        $this->wkshp_benchmarkdate->SetDBValue(trim($this->f("wkshp_benchmarkdate")));
        $this->wkshp_equipment->SetDBValue($this->f("wkshp_equipment"));
        $this->wkshp_eq_origin->SetDBValue($this->f("wkshp_eq_origin"));
        $this->wkshp_mtn_serialnumber->SetDBValue($this->f("wkshp_mtn_serialnumber"));
        $this->wkshp_loan_serialnumber->SetDBValue($this->f("wkshp_loan_serialnumber"));
        $this->wkshp_eq_location->SetDBValue($this->f("wkshp_eq_location"));
        $this->wkshp_eq_deliverymethod->SetDBValue($this->f("wkshp_eq_deliverymethod"));
        $this->wkshp_remark->SetDBValue($this->f("wkshp_remark"));
        $this->wkshp_request->SetDBValue($this->f("wkshp_request"));
        $this->wkshp_donumber->SetDBValue($this->f("wkshp_donumber"));
        $this->wkshp_deliveredcourier->SetDBValue($this->f("wkshp_deliveredcourier"));
        $this->wkshp_requestedby->SetDBValue($this->f("wkshp_requestedby"));
        $this->wkshp_requesteddate->SetDBValue(trim($this->f("wkshp_requesteddate")));
        $this->wkshp_receivedby->SetDBValue(trim($this->f("wkshp_receivedby")));
        $this->wkshp_receiveddate->SetDBValue(trim($this->f("wkshp_receiveddate")));
        $this->wkshp_authorizedby->SetDBValue(trim($this->f("wkshp_authorizedby")));
        $this->wkshp_authorizeddate->SetDBValue(trim($this->f("wkshp_authorizeddate")));
        $this->wkshp_deliveredby->SetDBValue(trim($this->f("wkshp_deliveredby")));
        $this->wkshp_delivereddate->SetDBValue(trim($this->f("wkshp_delivereddate")));
    }
//End SetValues Method

//Insert Method @30-60A6571C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["wkshp_serial"]["Value"] = $this->wkshp_serial->GetDBValue(true);
        $this->InsertFields["wkshp_date"]["Value"] = $this->wkshp_date->GetDBValue(true);
        $this->InsertFields["wkshp_benchmarkdate"]["Value"] = $this->wkshp_benchmarkdate->GetDBValue(true);
        $this->InsertFields["wkshp_equipment"]["Value"] = $this->wkshp_equipment->GetDBValue(true);
        $this->InsertFields["wkshp_eq_origin"]["Value"] = $this->wkshp_eq_origin->GetDBValue(true);
        $this->InsertFields["wkshp_mtn_serialnumber"]["Value"] = $this->wkshp_mtn_serialnumber->GetDBValue(true);
        $this->InsertFields["wkshp_loan_serialnumber"]["Value"] = $this->wkshp_loan_serialnumber->GetDBValue(true);
        $this->InsertFields["wkshp_eq_location"]["Value"] = $this->wkshp_eq_location->GetDBValue(true);
        $this->InsertFields["wkshp_eq_deliverymethod"]["Value"] = $this->wkshp_eq_deliverymethod->GetDBValue(true);
        $this->InsertFields["wkshp_remark"]["Value"] = $this->wkshp_remark->GetDBValue(true);
        $this->InsertFields["wkshp_request"]["Value"] = $this->wkshp_request->GetDBValue(true);
        $this->InsertFields["wkshp_donumber"]["Value"] = $this->wkshp_donumber->GetDBValue(true);
        $this->InsertFields["wkshp_deliveredcourier"]["Value"] = $this->wkshp_deliveredcourier->GetDBValue(true);
        $this->InsertFields["wkshp_requestedby"]["Value"] = $this->wkshp_requestedby->GetDBValue(true);
        $this->InsertFields["wkshp_requesteddate"]["Value"] = $this->wkshp_requesteddate->GetDBValue(true);
        $this->InsertFields["wkshp_receivedby"]["Value"] = $this->wkshp_receivedby->GetDBValue(true);
        $this->InsertFields["wkshp_receiveddate"]["Value"] = $this->wkshp_receiveddate->GetDBValue(true);
        $this->InsertFields["wkshp_authorizedby"]["Value"] = $this->wkshp_authorizedby->GetDBValue(true);
        $this->InsertFields["wkshp_authorizeddate"]["Value"] = $this->wkshp_authorizeddate->GetDBValue(true);
        $this->InsertFields["wkshp_deliveredby"]["Value"] = $this->wkshp_deliveredby->GetDBValue(true);
        $this->InsertFields["wkshp_delivereddate"]["Value"] = $this->wkshp_delivereddate->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_workshop", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @30-69990520
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["wkshp_serial"]["Value"] = $this->wkshp_serial->GetDBValue(true);
        $this->UpdateFields["wkshp_date"]["Value"] = $this->wkshp_date->GetDBValue(true);
        $this->UpdateFields["wkshp_benchmarkdate"]["Value"] = $this->wkshp_benchmarkdate->GetDBValue(true);
        $this->UpdateFields["wkshp_equipment"]["Value"] = $this->wkshp_equipment->GetDBValue(true);
        $this->UpdateFields["wkshp_eq_origin"]["Value"] = $this->wkshp_eq_origin->GetDBValue(true);
        $this->UpdateFields["wkshp_mtn_serialnumber"]["Value"] = $this->wkshp_mtn_serialnumber->GetDBValue(true);
        $this->UpdateFields["wkshp_loan_serialnumber"]["Value"] = $this->wkshp_loan_serialnumber->GetDBValue(true);
        $this->UpdateFields["wkshp_eq_location"]["Value"] = $this->wkshp_eq_location->GetDBValue(true);
        $this->UpdateFields["wkshp_eq_deliverymethod"]["Value"] = $this->wkshp_eq_deliverymethod->GetDBValue(true);
        $this->UpdateFields["wkshp_remark"]["Value"] = $this->wkshp_remark->GetDBValue(true);
        $this->UpdateFields["wkshp_request"]["Value"] = $this->wkshp_request->GetDBValue(true);
        $this->UpdateFields["wkshp_donumber"]["Value"] = $this->wkshp_donumber->GetDBValue(true);
        $this->UpdateFields["wkshp_deliveredcourier"]["Value"] = $this->wkshp_deliveredcourier->GetDBValue(true);
        $this->UpdateFields["wkshp_requestedby"]["Value"] = $this->wkshp_requestedby->GetDBValue(true);
        $this->UpdateFields["wkshp_requesteddate"]["Value"] = $this->wkshp_requesteddate->GetDBValue(true);
        $this->UpdateFields["wkshp_receivedby"]["Value"] = $this->wkshp_receivedby->GetDBValue(true);
        $this->UpdateFields["wkshp_receiveddate"]["Value"] = $this->wkshp_receiveddate->GetDBValue(true);
        $this->UpdateFields["wkshp_authorizedby"]["Value"] = $this->wkshp_authorizedby->GetDBValue(true);
        $this->UpdateFields["wkshp_authorizeddate"]["Value"] = $this->wkshp_authorizeddate->GetDBValue(true);
        $this->UpdateFields["wkshp_deliveredby"]["Value"] = $this->wkshp_deliveredby->GetDBValue(true);
        $this->UpdateFields["wkshp_delivereddate"]["Value"] = $this->wkshp_delivereddate->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_workshop", $this->UpdateFields, $this);
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

//Delete Method @30-F01B329C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_workshop";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End REquipmentFormDataSource Class @30-FCB6E20C

class clsGridGEquipmentRelated { //GEquipmentRelated class @70-E70FE6CA

//Variables @70-AC1EDBB9

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

//Class_Initialize Event @70-A5ED2215
    function clsGridGEquipmentRelated($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GEquipmentRelated";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GEquipmentRelated";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGEquipmentRelatedDataSource($this);
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

        $this->wkshp_request = & new clsControl(ccsLabel, "wkshp_request", "wkshp_request", ccsText, "", CCGetRequestParam("wkshp_request", ccsGet, NULL), $this);
        $this->wkshp_date = & new clsControl(ccsLabel, "wkshp_date", "wkshp_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_date", ccsGet, NULL), $this);
        $this->wkshp_benchmarkdate = & new clsControl(ccsLabel, "wkshp_benchmarkdate", "wkshp_benchmarkdate", ccsDate, $DefaultDateFormat, CCGetRequestParam("wkshp_benchmarkdate", ccsGet, NULL), $this);
        $this->wkshp_donumber = & new clsControl(ccsLabel, "wkshp_donumber", "wkshp_donumber", ccsText, "", CCGetRequestParam("wkshp_donumber", ccsGet, NULL), $this);
        $this->wkshp_eq_origin = & new clsControl(ccsLabel, "wkshp_eq_origin", "wkshp_eq_origin", ccsText, "", CCGetRequestParam("wkshp_eq_origin", ccsGet, NULL), $this);
        $this->wkshp_mtn_serialnumber = & new clsControl(ccsLabel, "wkshp_mtn_serialnumber", "wkshp_mtn_serialnumber", ccsText, "", CCGetRequestParam("wkshp_mtn_serialnumber", ccsGet, NULL), $this);
        $this->wkshp_loan_serialnumber = & new clsControl(ccsLabel, "wkshp_loan_serialnumber", "wkshp_loan_serialnumber", ccsText, "", CCGetRequestParam("wkshp_loan_serialnumber", ccsGet, NULL), $this);
        $this->wkshp_eq_location = & new clsControl(ccsLabel, "wkshp_eq_location", "wkshp_eq_location", ccsText, "", CCGetRequestParam("wkshp_eq_location", ccsGet, NULL), $this);
        $this->wkshp_remark = & new clsControl(ccsLabel, "wkshp_remark", "wkshp_remark", ccsMemo, "", CCGetRequestParam("wkshp_remark", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @70-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @70-0DE533BC
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlmtn"] = CCGetFromGet("mtn", NULL);
        $this->DataSource->Parameters["urlloan"] = CCGetFromGet("loan", NULL);

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
            $this->ControlsVisible["wkshp_request"] = $this->wkshp_request->Visible;
            $this->ControlsVisible["wkshp_date"] = $this->wkshp_date->Visible;
            $this->ControlsVisible["wkshp_benchmarkdate"] = $this->wkshp_benchmarkdate->Visible;
            $this->ControlsVisible["wkshp_donumber"] = $this->wkshp_donumber->Visible;
            $this->ControlsVisible["wkshp_eq_origin"] = $this->wkshp_eq_origin->Visible;
            $this->ControlsVisible["wkshp_mtn_serialnumber"] = $this->wkshp_mtn_serialnumber->Visible;
            $this->ControlsVisible["wkshp_loan_serialnumber"] = $this->wkshp_loan_serialnumber->Visible;
            $this->ControlsVisible["wkshp_eq_location"] = $this->wkshp_eq_location->Visible;
            $this->ControlsVisible["wkshp_remark"] = $this->wkshp_remark->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->wkshp_request->SetValue($this->DataSource->wkshp_request->GetValue());
                $this->wkshp_date->SetValue($this->DataSource->wkshp_date->GetValue());
                $this->wkshp_benchmarkdate->SetValue($this->DataSource->wkshp_benchmarkdate->GetValue());
                $this->wkshp_donumber->SetValue($this->DataSource->wkshp_donumber->GetValue());
                $this->wkshp_eq_origin->SetValue($this->DataSource->wkshp_eq_origin->GetValue());
                $this->wkshp_mtn_serialnumber->SetValue($this->DataSource->wkshp_mtn_serialnumber->GetValue());
                $this->wkshp_loan_serialnumber->SetValue($this->DataSource->wkshp_loan_serialnumber->GetValue());
                $this->wkshp_eq_location->SetValue($this->DataSource->wkshp_eq_location->GetValue());
                $this->wkshp_remark->SetValue($this->DataSource->wkshp_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->wkshp_request->Show();
                $this->wkshp_date->Show();
                $this->wkshp_benchmarkdate->Show();
                $this->wkshp_donumber->Show();
                $this->wkshp_eq_origin->Show();
                $this->wkshp_mtn_serialnumber->Show();
                $this->wkshp_loan_serialnumber->Show();
                $this->wkshp_eq_location->Show();
                $this->wkshp_remark->Show();
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

//GetErrors Method @70-F72D4A40
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->wkshp_request->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_benchmarkdate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_donumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_eq_origin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_mtn_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_loan_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_eq_location->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wkshp_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GEquipmentRelated Class @70-FCB6E20C

class clsGEquipmentRelatedDataSource extends clsDBSMART {  //GEquipmentRelatedDataSource Class @70-42F7C11D

//DataSource Variables @70-96C006C2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $wkshp_request;
    var $wkshp_date;
    var $wkshp_benchmarkdate;
    var $wkshp_donumber;
    var $wkshp_eq_origin;
    var $wkshp_mtn_serialnumber;
    var $wkshp_loan_serialnumber;
    var $wkshp_eq_location;
    var $wkshp_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @70-FF50F8A1
    function clsGEquipmentRelatedDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GEquipmentRelated";
        $this->Initialize();
        $this->wkshp_request = new clsField("wkshp_request", ccsText, "");
        
        $this->wkshp_date = new clsField("wkshp_date", ccsDate, $this->DateFormat);
        
        $this->wkshp_benchmarkdate = new clsField("wkshp_benchmarkdate", ccsDate, $this->DateFormat);
        
        $this->wkshp_donumber = new clsField("wkshp_donumber", ccsText, "");
        
        $this->wkshp_eq_origin = new clsField("wkshp_eq_origin", ccsText, "");
        
        $this->wkshp_mtn_serialnumber = new clsField("wkshp_mtn_serialnumber", ccsText, "");
        
        $this->wkshp_loan_serialnumber = new clsField("wkshp_loan_serialnumber", ccsText, "");
        
        $this->wkshp_eq_location = new clsField("wkshp_eq_location", ccsText, "");
        
        $this->wkshp_remark = new clsField("wkshp_remark", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @70-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @70-CA81CFAA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlmtn", ccsText, "", "", $this->Parameters["urlmtn"], "", false);
        $this->wp->AddParameter("2", "urlloan", ccsText, "", "", $this->Parameters["urlloan"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "wkshp_mtn_serialnumber", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "wkshp_loan_serialnumber", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @70-BCC832CF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_workshop";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_workshop {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @70-F4BD6FAF
    function SetValues()
    {
        $this->wkshp_request->SetDBValue($this->f("wkshp_request"));
        $this->wkshp_date->SetDBValue(trim($this->f("wkshp_date")));
        $this->wkshp_benchmarkdate->SetDBValue(trim($this->f("wkshp_benchmarkdate")));
        $this->wkshp_donumber->SetDBValue($this->f("wkshp_donumber"));
        $this->wkshp_eq_origin->SetDBValue($this->f("wkshp_eq_origin"));
        $this->wkshp_mtn_serialnumber->SetDBValue($this->f("wkshp_mtn_serialnumber"));
        $this->wkshp_loan_serialnumber->SetDBValue($this->f("wkshp_loan_serialnumber"));
        $this->wkshp_eq_location->SetDBValue($this->f("wkshp_eq_location"));
        $this->wkshp_remark->SetDBValue($this->f("wkshp_remark"));
    }
//End SetValues Method

} //End GEquipmentRelatedDataSource Class @70-FCB6E20C

//Initialize Page @1-5D369574
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
$TemplateFileName = "smartworkshop.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D7A8E9CB
include_once("./smartworkshop_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-139339F0
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GEquipmentList = & new clsGridGEquipmentList("", $MainPage);
$SEquipment = & new clsRecordSEquipment("", $MainPage);
$REquipmentForm = & new clsRecordREquipmentForm("", $MainPage);
$GEquipmentRelated = & new clsGridGEquipmentRelated("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GEquipmentList = & $GEquipmentList;
$MainPage->SEquipment = & $SEquipment;
$MainPage->REquipmentForm = & $REquipmentForm;
$MainPage->GEquipmentRelated = & $GEquipmentRelated;
$GEquipmentList->Initialize();
$REquipmentForm->Initialize();
$GEquipmentRelated->Initialize();

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

//Execute Components @1-7FB5E034
$header->Operations();
$footer->Operations();
$SEquipment->Operation();
$REquipmentForm->Operation();
//End Execute Components

//Go to destination page @1-B2BB5B90
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GEquipmentList);
    unset($SEquipment);
    unset($REquipmentForm);
    unset($GEquipmentRelated);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E6339125
$header->Show();
$footer->Show();
$GEquipmentList->Show();
$SEquipment->Show();
$REquipmentForm->Show();
$GEquipmentRelated->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9A3DED53
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GEquipmentList);
unset($SEquipment);
unset($REquipmentForm);
unset($GEquipmentRelated);
unset($Tpl);
//End Unload Page


?>
