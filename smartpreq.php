<?php
//Include Common Files @1-EBB117CC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartpreq.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsGridGPreq { //GPreq class @5-25F52CBA

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

//Class_Initialize Event @5-E7125F42
    function clsGridGPreq($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GPreq";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GPreq";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGPreqDataSource($this);
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

        $this->preq_dateapplied = & new clsControl(ccsLink, "preq_dateapplied", "preq_dateapplied", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_dateapplied", ccsGet, NULL), $this);
        $this->preq_dateapplied->Page = "smartpreq.php";
        $this->preq_formno = & new clsControl(ccsLabel, "preq_formno", "preq_formno", ccsText, "", CCGetRequestParam("preq_formno", ccsGet, NULL), $this);
        $this->preq_engineer = & new clsControl(ccsLabel, "preq_engineer", "preq_engineer", ccsText, "", CCGetRequestParam("preq_engineer", ccsGet, NULL), $this);
        $this->preq_approvedby = & new clsControl(ccsLabel, "preq_approvedby", "preq_approvedby", ccsText, "", CCGetRequestParam("preq_approvedby", ccsGet, NULL), $this);
        $this->preq_approveddate = & new clsControl(ccsLabel, "preq_approveddate", "preq_approveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_approveddate", ccsGet, NULL), $this);
        $this->preq_processedby = & new clsControl(ccsLabel, "preq_processedby", "preq_processedby", ccsText, "", CCGetRequestParam("preq_processedby", ccsGet, NULL), $this);
        $this->preq_processeddate = & new clsControl(ccsLabel, "preq_processeddate", "preq_processeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_processeddate", ccsGet, NULL), $this);
        $this->preq_takenby = & new clsControl(ccsLabel, "preq_takenby", "preq_takenby", ccsText, "", CCGetRequestParam("preq_takenby", ccsGet, NULL), $this);
        $this->preq_takendate = & new clsControl(ccsLabel, "preq_takendate", "preq_takendate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_takendate", ccsGet, NULL), $this);
        $this->preq_partsreceived = & new clsControl(ccsLabel, "preq_partsreceived", "preq_partsreceived", ccsText, "", CCGetRequestParam("preq_partsreceived", ccsGet, NULL), $this);
        $this->preq_receivedby = & new clsControl(ccsLabel, "preq_receivedby", "preq_receivedby", ccsText, "", CCGetRequestParam("preq_receivedby", ccsGet, NULL), $this);
        $this->preq_receiveddate = & new clsControl(ccsLabel, "preq_receiveddate", "preq_receiveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_receiveddate", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->preq_status = & new clsControl(ccsLabel, "preq_status", "preq_status", ccsText, "", CCGetRequestParam("preq_status", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->btnNew = & new clsControl(ccsImageLink, "btnNew", "btnNew", ccsText, "", CCGetRequestParam("btnNew", ccsGet, NULL), $this);
        $this->btnNew->Page = "smartpreq.php";
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

//Show Method @5-8574E66F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlfn"] = CCGetFromGet("fn", NULL);
        $this->DataSource->Parameters["urlda"] = CCGetFromGet("da", NULL);
        $this->DataSource->Parameters["urleng"] = CCGetFromGet("eng", NULL);

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
            $this->ControlsVisible["preq_dateapplied"] = $this->preq_dateapplied->Visible;
            $this->ControlsVisible["preq_formno"] = $this->preq_formno->Visible;
            $this->ControlsVisible["preq_engineer"] = $this->preq_engineer->Visible;
            $this->ControlsVisible["preq_approvedby"] = $this->preq_approvedby->Visible;
            $this->ControlsVisible["preq_approveddate"] = $this->preq_approveddate->Visible;
            $this->ControlsVisible["preq_processedby"] = $this->preq_processedby->Visible;
            $this->ControlsVisible["preq_processeddate"] = $this->preq_processeddate->Visible;
            $this->ControlsVisible["preq_takenby"] = $this->preq_takenby->Visible;
            $this->ControlsVisible["preq_takendate"] = $this->preq_takendate->Visible;
            $this->ControlsVisible["preq_partsreceived"] = $this->preq_partsreceived->Visible;
            $this->ControlsVisible["preq_receivedby"] = $this->preq_receivedby->Visible;
            $this->ControlsVisible["preq_receiveddate"] = $this->preq_receiveddate->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["preq_status"] = $this->preq_status->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->preq_dateapplied->SetValue($this->DataSource->preq_dateapplied->GetValue());
                $this->preq_dateapplied->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->preq_dateapplied->Parameters = CCAddParam($this->preq_dateapplied->Parameters, "id", $this->DataSource->f("id"));
                $this->preq_dateapplied->Parameters = CCAddParam($this->preq_dateapplied->Parameters, "view", 1);
                $this->preq_formno->SetValue($this->DataSource->preq_formno->GetValue());
                $this->preq_engineer->SetValue($this->DataSource->preq_engineer->GetValue());
                $this->preq_approvedby->SetValue($this->DataSource->preq_approvedby->GetValue());
                $this->preq_approveddate->SetValue($this->DataSource->preq_approveddate->GetValue());
                $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                $this->preq_takenby->SetValue($this->DataSource->preq_takenby->GetValue());
                $this->preq_takendate->SetValue($this->DataSource->preq_takendate->GetValue());
                $this->preq_partsreceived->SetValue($this->DataSource->preq_partsreceived->GetValue());
                $this->preq_receivedby->SetValue($this->DataSource->preq_receivedby->GetValue());
                $this->preq_receiveddate->SetValue($this->DataSource->preq_receiveddate->GetValue());
                $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->preq_dateapplied->Show();
                $this->preq_formno->Show();
                $this->preq_engineer->Show();
                $this->preq_approvedby->Show();
                $this->preq_approveddate->Show();
                $this->preq_processedby->Show();
                $this->preq_processeddate->Show();
                $this->preq_takenby->Show();
                $this->preq_takendate->Show();
                $this->preq_partsreceived->Show();
                $this->preq_receivedby->Show();
                $this->preq_receiveddate->Show();
                $this->lblNumber->Show();
                $this->preq_status->Show();
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
        $this->btnNew->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->btnNew->Parameters = CCAddParam($this->btnNew->Parameters, "new", 1);
        $this->Navigator->Show();
        $this->btnNew->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-4FC01A8F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->preq_dateapplied->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_formno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_engineer->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_approvedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_approveddate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_processedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_processeddate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_takenby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_takendate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_partsreceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_receivedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_receiveddate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GPreq Class @5-FCB6E20C

class clsGPreqDataSource extends clsDBSMART {  //GPreqDataSource Class @5-C3EEA6F9

//DataSource Variables @5-766C3168
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $preq_dateapplied;
    var $preq_formno;
    var $preq_engineer;
    var $preq_approvedby;
    var $preq_approveddate;
    var $preq_processedby;
    var $preq_processeddate;
    var $preq_takenby;
    var $preq_takendate;
    var $preq_partsreceived;
    var $preq_receivedby;
    var $preq_receiveddate;
    var $preq_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-F5121888
    function clsGPreqDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GPreq";
        $this->Initialize();
        $this->preq_dateapplied = new clsField("preq_dateapplied", ccsDate, $this->DateFormat);
        
        $this->preq_formno = new clsField("preq_formno", ccsText, "");
        
        $this->preq_engineer = new clsField("preq_engineer", ccsText, "");
        
        $this->preq_approvedby = new clsField("preq_approvedby", ccsText, "");
        
        $this->preq_approveddate = new clsField("preq_approveddate", ccsDate, $this->DateFormat);
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->preq_takenby = new clsField("preq_takenby", ccsText, "");
        
        $this->preq_takendate = new clsField("preq_takendate", ccsDate, $this->DateFormat);
        
        $this->preq_partsreceived = new clsField("preq_partsreceived", ccsText, "");
        
        $this->preq_receivedby = new clsField("preq_receivedby", ccsText, "");
        
        $this->preq_receiveddate = new clsField("preq_receiveddate", ccsDate, $this->DateFormat);
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        

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

//Prepare Method @5-4E51FB5D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlfn", ccsText, "", "", $this->Parameters["urlfn"], "", false);
        $this->wp->AddParameter("2", "urlda", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urlda"], "", false);
        $this->wp->AddParameter("3", "urleng", ccsText, "", "", $this->Parameters["urleng"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "preq_formno", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "preq_dateapplied", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "preq_engineer", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @5-BA294A01
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsrequisition";
        $this->SQL = "SELECT id, preq_dateapplied, preq_formno, preq_engineer, preq_approvedby, preq_approveddate, preq_processedby, preq_processeddate,\n\n" .
        "preq_takenby, preq_takendate, preq_partsreceived, preq_receivedby, preq_receiveddate, preq_status \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-211EFDF4
    function SetValues()
    {
        $this->preq_dateapplied->SetDBValue(trim($this->f("preq_dateapplied")));
        $this->preq_formno->SetDBValue($this->f("preq_formno"));
        $this->preq_engineer->SetDBValue($this->f("preq_engineer"));
        $this->preq_approvedby->SetDBValue($this->f("preq_approvedby"));
        $this->preq_approveddate->SetDBValue(trim($this->f("preq_approveddate")));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->preq_takenby->SetDBValue($this->f("preq_takenby"));
        $this->preq_takendate->SetDBValue(trim($this->f("preq_takendate")));
        $this->preq_partsreceived->SetDBValue($this->f("preq_partsreceived"));
        $this->preq_receivedby->SetDBValue($this->f("preq_receivedby"));
        $this->preq_receiveddate->SetDBValue(trim($this->f("preq_receiveddate")));
        $this->preq_status->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

} //End GPreqDataSource Class @5-FCB6E20C

class clsRecordSPreq { //SPreq Class @6-2AE4A4C1

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

//Class_Initialize Event @6-B107C83D
    function clsRecordSPreq($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SPreq/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SPreq";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->fn = & new clsControl(ccsTextBox, "fn", "fn", ccsText, "", CCGetRequestParam("fn", $Method, NULL), $this);
            $this->da = & new clsControl(ccsTextBox, "da", "da", ccsDate, $DefaultDateFormat, CCGetRequestParam("da", $Method, NULL), $this);
            $this->DatePicker_da = & new clsDatePicker("DatePicker_da", "SPreq", "da", $this);
            $this->eng = & new clsControl(ccsListBox, "eng", "eng", ccsText, "", CCGetRequestParam("eng", $Method, NULL), $this);
            $this->eng->DSType = dsTable;
            $this->eng->DataSource = new clsDBSMART();
            $this->eng->ds = & $this->eng->DataSource;
            $this->eng->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->eng->BoundColumn, $this->eng->TextColumn, $this->eng->DBFormat) = array("usr_username", "usr_fullname", "");
        }
    }
//End Class_Initialize Event

//Validate Method @6-00BDAA0C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->fn->Validate() && $Validation);
        $Validation = ($this->da->Validate() && $Validation);
        $Validation = ($this->eng->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->fn->Errors->Count() == 0);
        $Validation =  $Validation && ($this->da->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eng->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-83DAB138
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->fn->Errors->Count());
        $errors = ($errors || $this->da->Errors->Count());
        $errors = ($errors || $this->DatePicker_da->Errors->Count());
        $errors = ($errors || $this->eng->Errors->Count());
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

//Operation Method @6-EB9FDB82
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
        $Redirect = "smartpreq.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartpreq.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-1A2FA4C0
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

        $this->eng->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->fn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->da->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_da->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eng->Errors->ToString());
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
        $this->fn->Show();
        $this->da->Show();
        $this->DatePicker_da->Show();
        $this->eng->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SPreq Class @6-FCB6E20C

class clsRecordRPreq { //RPreq Class @44-E1B87764

//Variables @44-D6FF3E86

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

//Class_Initialize Event @44-C80526CD
    function clsRecordRPreq($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreq/Error";
        $this->DataSource = new clsRPreqDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreq";
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
            $this->preq_formno = & new clsControl(ccsTextBox, "preq_formno", "Form No.", ccsText, "", CCGetRequestParam("preq_formno", $Method, NULL), $this);
            $this->preq_formno->Required = true;
            $this->preq_dateapplied = & new clsControl(ccsTextBox, "preq_dateapplied", "Date Applied", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_dateapplied", $Method, NULL), $this);
            $this->preq_dateapplied->Required = true;
            $this->DatePicker_preq_dateapplied = & new clsDatePicker("DatePicker_preq_dateapplied", "RPreq", "preq_dateapplied", $this);
            $this->preq_engineer = & new clsControl(ccsListBox, "preq_engineer", "Engineer", ccsText, "", CCGetRequestParam("preq_engineer", $Method, NULL), $this);
            $this->preq_engineer->DSType = dsTable;
            $this->preq_engineer->DataSource = new clsDBSMART();
            $this->preq_engineer->ds = & $this->preq_engineer->DataSource;
            $this->preq_engineer->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->preq_engineer->BoundColumn, $this->preq_engineer->TextColumn, $this->preq_engineer->DBFormat) = array("usr_username", "usr_fullname", "");
            $this->preq_engineer->DataSource->Parameters["expr107"] = 3;
            $this->preq_engineer->DataSource->Parameters["expr108"] = 0;
            $this->preq_engineer->DataSource->wp = new clsSQLParameters();
            $this->preq_engineer->DataSource->wp->AddParameter("1", "expr107", ccsInteger, "", "", $this->preq_engineer->DataSource->Parameters["expr107"], "", false);
            $this->preq_engineer->DataSource->wp->AddParameter("2", "expr108", ccsInteger, "", "", $this->preq_engineer->DataSource->Parameters["expr108"], "", false);
            $this->preq_engineer->DataSource->wp->Criterion[1] = $this->preq_engineer->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_engineer->DataSource->wp->GetDBValue("1"), $this->preq_engineer->DataSource->ToSQL($this->preq_engineer->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->preq_engineer->DataSource->wp->Criterion[2] = $this->preq_engineer->DataSource->wp->Operation(opEqual, "usr_flag", $this->preq_engineer->DataSource->wp->GetDBValue("2"), $this->preq_engineer->DataSource->ToSQL($this->preq_engineer->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->preq_engineer->DataSource->Where = $this->preq_engineer->DataSource->wp->opAND(
                 false, 
                 $this->preq_engineer->DataSource->wp->Criterion[1], 
                 $this->preq_engineer->DataSource->wp->Criterion[2]);
            $this->preq_engineer->Required = true;
            $this->preq_status = & new clsControl(ccsHidden, "preq_status", "preq_status", ccsText, "", CCGetRequestParam("preq_status", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->preq_status->Value) && !strlen($this->preq_status->Value) && $this->preq_status->Value !== false)
                    $this->preq_status->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @44-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @44-B1B1C808
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->preq_formno->SetValue($this->preq_formno->GetValue());
        if(CCDLookUp("COUNT(*)", "smart_partsrequisition", "preq_formno=" . $this->DataSource->ToSQL($this->DataSource->preq_formno->GetDBValue(), $this->DataSource->preq_formno->DataType) . $Where, $this->DataSource) > 0)
            $this->preq_formno->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Form No."));
        $Validation = ($this->preq_formno->Validate() && $Validation);
        $Validation = ($this->preq_dateapplied->Validate() && $Validation);
        $Validation = ($this->preq_engineer->Validate() && $Validation);
        $Validation = ($this->preq_status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->preq_formno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_dateapplied->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_engineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @44-F9162082
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_formno->Errors->Count());
        $errors = ($errors || $this->preq_dateapplied->Errors->Count());
        $errors = ($errors || $this->DatePicker_preq_dateapplied->Errors->Count());
        $errors = ($errors || $this->preq_engineer->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @44-ED598703
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

//Operation Method @44-BC36B9B9
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
            $this->PressedButton = "Button_Insert";
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
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
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

//InsertRow Method @44-2373F9CC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->preq_formno->SetValue($this->preq_formno->GetValue(true));
        $this->DataSource->preq_dateapplied->SetValue($this->preq_dateapplied->GetValue(true));
        $this->DataSource->preq_engineer->SetValue($this->preq_engineer->GetValue(true));
        $this->DataSource->preq_status->SetValue($this->preq_status->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @44-51823492
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

        $this->preq_engineer->Prepare();

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
                    $this->preq_formno->SetValue($this->DataSource->preq_formno->GetValue());
                    $this->preq_dateapplied->SetValue($this->DataSource->preq_dateapplied->GetValue());
                    $this->preq_engineer->SetValue($this->DataSource->preq_engineer->GetValue());
                    $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_formno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_dateapplied->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_preq_dateapplied->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
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
        $this->preq_formno->Show();
        $this->preq_dateapplied->Show();
        $this->DatePicker_preq_dateapplied->Show();
        $this->preq_engineer->Show();
        $this->preq_status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreq Class @44-FCB6E20C

class clsRPreqDataSource extends clsDBSMART {  //RPreqDataSource Class @44-F71D7674

//DataSource Variables @44-7C98796F
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
    var $preq_formno;
    var $preq_dateapplied;
    var $preq_engineer;
    var $preq_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @44-0D6ECAA8
    function clsRPreqDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreq/Error";
        $this->Initialize();
        $this->preq_formno = new clsField("preq_formno", ccsText, "");
        
        $this->preq_dateapplied = new clsField("preq_dateapplied", ccsDate, $this->DateFormat);
        
        $this->preq_engineer = new clsField("preq_engineer", ccsText, "");
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        

        $this->InsertFields["preq_formno"] = array("Name" => "preq_formno", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["preq_dateapplied"] = array("Name" => "preq_dateapplied", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["preq_engineer"] = array("Name" => "preq_engineer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["preq_status"] = array("Name" => "preq_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @44-35B33087
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

//Open Method @44-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @44-E28B9466
    function SetValues()
    {
        $this->preq_formno->SetDBValue($this->f("preq_formno"));
        $this->preq_dateapplied->SetDBValue(trim($this->f("preq_dateapplied")));
        $this->preq_engineer->SetDBValue($this->f("preq_engineer"));
        $this->preq_status->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

//Insert Method @44-32FC99B2
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["preq_formno"]["Value"] = $this->preq_formno->GetDBValue(true);
        $this->InsertFields["preq_dateapplied"]["Value"] = $this->preq_dateapplied->GetDBValue(true);
        $this->InsertFields["preq_engineer"]["Value"] = $this->preq_engineer->GetDBValue(true);
        $this->InsertFields["preq_status"]["Value"] = $this->preq_status->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_partsrequisition", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End RPreqDataSource Class @44-FCB6E20C

class clsEditableGridGPreqOrders { //GPreqOrders Class @68-3FD29B6B

//Variables @68-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @68-E31E2D2C
    function clsEditableGridGPreqOrders($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GPreqOrders/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GPreqOrders";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGPreqOrdersDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "Id", ccsInteger, "", NULL, $this);
        $this->podr_itemcode = & new clsControl(ccsTextBox, "podr_itemcode", "Podr Itemcode", ccsText, "", NULL, $this);
        $this->podr_itemcode->Required = true;
        $this->podr_itemname = & new clsControl(ccsTextBox, "podr_itemname", "Podr Itemname", ccsText, "", NULL, $this);
        $this->podr_itemname->Required = true;
        $this->podr_qty = & new clsControl(ccsTextBox, "podr_qty", "Podr Qty", ccsInteger, "", NULL, $this);
        $this->podr_qty->Required = true;
        $this->podr_site = & new clsControl(ccsListBox, "podr_site", "Podr Site", ccsText, "", NULL, $this);
        $this->podr_site->DSType = dsTable;
        $this->podr_site->DataSource = new clsDBSMART();
        $this->podr_site->ds = & $this->podr_site->DataSource;
        $this->podr_site->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where} {SQL_OrderBy}";
        $this->podr_site->DataSource->Order = "site_code";
        list($this->podr_site->BoundColumn, $this->podr_site->TextColumn, $this->podr_site->DBFormat) = array("site_code", "site_code", "");
        $this->podr_site->DataSource->Order = "site_code";
        $this->podr_site->Required = true;
        $this->podr_toppan = & new clsControl(ccsTextBox, "podr_toppan", "Podr Toppan", ccsText, "", NULL, $this);
        $this->podr_toppan->Required = true;
        $this->podr_remarks = & new clsControl(ccsTextArea, "podr_remarks", "Podr Remarks", ccsMemo, "", NULL, $this);
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->podr_preqid = & new clsControl(ccsHidden, "podr_preqid", "Podr Preqid", ccsInteger, "", NULL, $this);
        $this->Button_Submit1 = & new clsButton("Button_Submit1", $Method, $this);
        $this->lblQty = & new clsControl(ccsLabel, "lblQty", "lblQty", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @68-48BE527E
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @68-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @68-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @68-8B9A9B70
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["podr_itemcode"][$RowNumber] = CCGetFromPost("podr_itemcode_" . $RowNumber, NULL);
            $this->FormParameters["podr_itemname"][$RowNumber] = CCGetFromPost("podr_itemname_" . $RowNumber, NULL);
            $this->FormParameters["podr_qty"][$RowNumber] = CCGetFromPost("podr_qty_" . $RowNumber, NULL);
            $this->FormParameters["podr_site"][$RowNumber] = CCGetFromPost("podr_site_" . $RowNumber, NULL);
            $this->FormParameters["podr_toppan"][$RowNumber] = CCGetFromPost("podr_toppan_" . $RowNumber, NULL);
            $this->FormParameters["podr_remarks"][$RowNumber] = CCGetFromPost("podr_remarks_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["podr_preqid"][$RowNumber] = CCGetFromPost("podr_preqid_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @68-91EB023E
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->podr_itemcode->SetText($this->FormParameters["podr_itemcode"][$this->RowNumber], $this->RowNumber);
            $this->podr_itemname->SetText($this->FormParameters["podr_itemname"][$this->RowNumber], $this->RowNumber);
            $this->podr_qty->SetText($this->FormParameters["podr_qty"][$this->RowNumber], $this->RowNumber);
            $this->podr_site->SetText($this->FormParameters["podr_site"][$this->RowNumber], $this->RowNumber);
            $this->podr_toppan->SetText($this->FormParameters["podr_toppan"][$this->RowNumber], $this->RowNumber);
            $this->podr_remarks->SetText($this->FormParameters["podr_remarks"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @68-A70ECD61
    function ValidateRow()
    {
        global $CCSLocales;
        $this->podr_itemcode->Validate();
        $this->podr_itemname->Validate();
        $this->podr_qty->Validate();
        $this->podr_site->Validate();
        $this->podr_toppan->Validate();
        $this->podr_remarks->Validate();
        $this->CheckBox_Delete->Validate();
        $this->podr_preqid->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->podr_itemcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_itemname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_toppan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_preqid->Errors->ToString());
        $this->podr_itemcode->Errors->Clear();
        $this->podr_itemname->Errors->Clear();
        $this->podr_qty->Errors->Clear();
        $this->podr_site->Errors->Clear();
        $this->podr_toppan->Errors->Clear();
        $this->podr_remarks->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->podr_preqid->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @68-97A058D0
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["podr_itemcode"][$this->RowNumber]) && count($this->FormParameters["podr_itemcode"][$this->RowNumber])) || strlen($this->FormParameters["podr_itemcode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_itemname"][$this->RowNumber]) && count($this->FormParameters["podr_itemname"][$this->RowNumber])) || strlen($this->FormParameters["podr_itemname"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_qty"][$this->RowNumber]) && count($this->FormParameters["podr_qty"][$this->RowNumber])) || strlen($this->FormParameters["podr_qty"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_site"][$this->RowNumber]) && count($this->FormParameters["podr_site"][$this->RowNumber])) || strlen($this->FormParameters["podr_site"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_toppan"][$this->RowNumber]) && count($this->FormParameters["podr_toppan"][$this->RowNumber])) || strlen($this->FormParameters["podr_toppan"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_remarks"][$this->RowNumber]) && count($this->FormParameters["podr_remarks"][$this->RowNumber])) || strlen($this->FormParameters["podr_remarks"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_preqid"][$this->RowNumber]) && count($this->FormParameters["podr_preqid"][$this->RowNumber])) || strlen($this->FormParameters["podr_preqid"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @68-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @68-130D8271
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        } else if($this->Button_Submit1->Pressed) {
            $this->PressedButton = "Button_Submit1";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Submit1") {
            if(!CCGetEvent($this->Button_Submit1->CCSEvents, "OnClick", $this->Button_Submit1) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @68-E9A1B43E
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->podr_itemcode->SetText($this->FormParameters["podr_itemcode"][$this->RowNumber], $this->RowNumber);
            $this->podr_itemname->SetText($this->FormParameters["podr_itemname"][$this->RowNumber], $this->RowNumber);
            $this->podr_qty->SetText($this->FormParameters["podr_qty"][$this->RowNumber], $this->RowNumber);
            $this->podr_site->SetText($this->FormParameters["podr_site"][$this->RowNumber], $this->RowNumber);
            $this->podr_toppan->SetText($this->FormParameters["podr_toppan"][$this->RowNumber], $this->RowNumber);
            $this->podr_remarks->SetText($this->FormParameters["podr_remarks"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @68-DC5AEB6E
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->podr_itemcode->SetValue($this->podr_itemcode->GetValue(true));
        $this->DataSource->podr_itemname->SetValue($this->podr_itemname->GetValue(true));
        $this->DataSource->podr_qty->SetValue($this->podr_qty->GetValue(true));
        $this->DataSource->podr_site->SetValue($this->podr_site->GetValue(true));
        $this->DataSource->podr_toppan->SetValue($this->podr_toppan->GetValue(true));
        $this->DataSource->podr_remarks->SetValue($this->podr_remarks->GetValue(true));
        $this->DataSource->podr_preqid->SetValue($this->podr_preqid->GetValue(true));
        $this->DataSource->lblQty->SetValue($this->lblQty->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @68-EE25A2B4
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->podr_itemcode->SetValue($this->podr_itemcode->GetValue(true));
        $this->DataSource->podr_itemname->SetValue($this->podr_itemname->GetValue(true));
        $this->DataSource->podr_qty->SetValue($this->podr_qty->GetValue(true));
        $this->DataSource->podr_site->SetValue($this->podr_site->GetValue(true));
        $this->DataSource->podr_toppan->SetValue($this->podr_toppan->GetValue(true));
        $this->DataSource->podr_remarks->SetValue($this->podr_remarks->GetValue(true));
        $this->DataSource->podr_preqid->SetValue($this->podr_preqid->GetValue(true));
        $this->DataSource->lblQty->SetValue($this->lblQty->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @68-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @68-2E4E9FBA
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var GPreqOrdersElements;\n";
        $script .= "var GPreqOrdersEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "podr_itemcodeID = 0;\n";
        $script .= "var " . $this->ComponentName . "podr_itemnameID = 1;\n";
        $script .= "var " . $this->ComponentName . "podr_qtyID = 2;\n";
        $script .= "var " . $this->ComponentName . "podr_siteID = 3;\n";
        $script .= "var " . $this->ComponentName . "podr_toppanID = 4;\n";
        $script .= "var " . $this->ComponentName . "podr_remarksID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "var " . $this->ComponentName . "podr_preqidID = 7;\n";
        $script .= "\nfunction initGPreqOrdersElements() {\n";
        $script .= "\tvar ED = document.forms[\"GPreqOrders\"];\n";
        $script .= "\tGPreqOrdersElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.podr_itemcode_" . $i . ", " . "ED.podr_itemname_" . $i . ", " . "ED.podr_qty_" . $i . ", " . "ED.podr_site_" . $i . ", " . "ED.podr_toppan_" . $i . ", " . "ED.podr_remarks_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.podr_preqid_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @68-0EEA5586
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @68-692238C5
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @68-6B3F8EAE
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->podr_site->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $this->Button_Submit1->Visible = $this->Button_Submit1->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
        $this->ControlsVisible["podr_itemcode"] = $this->podr_itemcode->Visible;
        $this->ControlsVisible["podr_itemname"] = $this->podr_itemname->Visible;
        $this->ControlsVisible["podr_qty"] = $this->podr_qty->Visible;
        $this->ControlsVisible["podr_site"] = $this->podr_site->Visible;
        $this->ControlsVisible["podr_toppan"] = $this->podr_toppan->Visible;
        $this->ControlsVisible["podr_remarks"] = $this->podr_remarks->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["podr_preqid"] = $this->podr_preqid->Visible;
        $this->ControlsVisible["lblQty"] = $this->lblQty->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->lblQty->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->podr_itemcode->SetValue($this->DataSource->podr_itemcode->GetValue());
                    $this->podr_itemname->SetValue($this->DataSource->podr_itemname->GetValue());
                    $this->podr_qty->SetValue($this->DataSource->podr_qty->GetValue());
                    $this->podr_site->SetValue($this->DataSource->podr_site->GetValue());
                    $this->podr_toppan->SetValue($this->DataSource->podr_toppan->GetValue());
                    $this->podr_remarks->SetValue($this->DataSource->podr_remarks->GetValue());
                    $this->podr_preqid->SetValue($this->DataSource->podr_preqid->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->lblQty->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->podr_itemcode->SetText($this->FormParameters["podr_itemcode"][$this->RowNumber], $this->RowNumber);
                    $this->podr_itemname->SetText($this->FormParameters["podr_itemname"][$this->RowNumber], $this->RowNumber);
                    $this->podr_qty->SetText($this->FormParameters["podr_qty"][$this->RowNumber], $this->RowNumber);
                    $this->podr_site->SetText($this->FormParameters["podr_site"][$this->RowNumber], $this->RowNumber);
                    $this->podr_toppan->SetText($this->FormParameters["podr_toppan"][$this->RowNumber], $this->RowNumber);
                    $this->podr_remarks->SetText($this->FormParameters["podr_remarks"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->lblNumber->SetText("");
                    $this->podr_itemcode->SetText("");
                    $this->podr_itemname->SetText("");
                    $this->podr_qty->SetText("");
                    $this->podr_site->SetText("");
                    $this->podr_toppan->SetText("");
                    $this->podr_remarks->SetText("");
                    $this->podr_preqid->SetText("");
                    $this->lblQty->SetText("");
                } else {
                    $this->lblNumber->SetText("");
                    $this->lblQty->SetText("");
                    $this->podr_itemcode->SetText($this->FormParameters["podr_itemcode"][$this->RowNumber], $this->RowNumber);
                    $this->podr_itemname->SetText($this->FormParameters["podr_itemname"][$this->RowNumber], $this->RowNumber);
                    $this->podr_qty->SetText($this->FormParameters["podr_qty"][$this->RowNumber], $this->RowNumber);
                    $this->podr_site->SetText($this->FormParameters["podr_site"][$this->RowNumber], $this->RowNumber);
                    $this->podr_toppan->SetText($this->FormParameters["podr_toppan"][$this->RowNumber], $this->RowNumber);
                    $this->podr_remarks->SetText($this->FormParameters["podr_remarks"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show($this->RowNumber);
                $this->podr_itemcode->Show($this->RowNumber);
                $this->podr_itemname->Show($this->RowNumber);
                $this->podr_qty->Show($this->RowNumber);
                $this->podr_site->Show($this->RowNumber);
                $this->podr_toppan->Show($this->RowNumber);
                $this->podr_remarks->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                $this->podr_preqid->Show($this->RowNumber);
                $this->lblQty->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["id"] == $this->CachedColumns["id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Button_Submit1->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End GPreqOrders Class @68-FCB6E20C

class clsGPreqOrdersDataSource extends clsDBSMART {  //GPreqOrdersDataSource Class @68-B73DE59A

//DataSource Variables @68-650DB4C7
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $lblNumber;
    var $podr_itemcode;
    var $podr_itemname;
    var $podr_qty;
    var $podr_site;
    var $podr_toppan;
    var $podr_remarks;
    var $CheckBox_Delete;
    var $podr_preqid;
    var $lblQty;
//End DataSource Variables

//DataSourceClass_Initialize Event @68-5A3F0697
    function clsGPreqOrdersDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GPreqOrders/Error";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->podr_itemcode = new clsField("podr_itemcode", ccsText, "");
        
        $this->podr_itemname = new clsField("podr_itemname", ccsText, "");
        
        $this->podr_qty = new clsField("podr_qty", ccsInteger, "");
        
        $this->podr_site = new clsField("podr_site", ccsText, "");
        
        $this->podr_toppan = new clsField("podr_toppan", ccsText, "");
        
        $this->podr_remarks = new clsField("podr_remarks", ccsMemo, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->podr_preqid = new clsField("podr_preqid", ccsInteger, "");
        
        $this->lblQty = new clsField("lblQty", ccsText, "");
        

        $this->InsertFields["podr_itemcode"] = array("Name" => "podr_itemcode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_itemname"] = array("Name" => "podr_itemname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_qty"] = array("Name" => "podr_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_site"] = array("Name" => "podr_site", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_toppan"] = array("Name" => "podr_toppan", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_remarks"] = array("Name" => "podr_remarks", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["podr_preqid"] = array("Name" => "podr_preqid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_itemcode"] = array("Name" => "podr_itemcode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_itemname"] = array("Name" => "podr_itemname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_qty"] = array("Name" => "podr_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_site"] = array("Name" => "podr_site", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_toppan"] = array("Name" => "podr_toppan", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_remarks"] = array("Name" => "podr_remarks", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_preqid"] = array("Name" => "podr_preqid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @68-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @68-D784D2FC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "podr_preqid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @68-C3432C23
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsorders";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsorders {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @68-E782FD59
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->podr_itemcode->SetDBValue($this->f("podr_itemcode"));
        $this->podr_itemname->SetDBValue($this->f("podr_itemname"));
        $this->podr_qty->SetDBValue(trim($this->f("podr_qty")));
        $this->podr_site->SetDBValue($this->f("podr_site"));
        $this->podr_toppan->SetDBValue($this->f("podr_toppan"));
        $this->podr_remarks->SetDBValue($this->f("podr_remarks"));
        $this->podr_preqid->SetDBValue(trim($this->f("podr_preqid")));
    }
//End SetValues Method

//Insert Method @68-963E869B
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["podr_itemcode"]["Value"] = $this->podr_itemcode->GetDBValue(true);
        $this->InsertFields["podr_itemname"]["Value"] = $this->podr_itemname->GetDBValue(true);
        $this->InsertFields["podr_qty"]["Value"] = $this->podr_qty->GetDBValue(true);
        $this->InsertFields["podr_site"]["Value"] = $this->podr_site->GetDBValue(true);
        $this->InsertFields["podr_toppan"]["Value"] = $this->podr_toppan->GetDBValue(true);
        $this->InsertFields["podr_remarks"]["Value"] = $this->podr_remarks->GetDBValue(true);
        $this->InsertFields["podr_preqid"]["Value"] = $this->podr_preqid->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_partsorders", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @68-45BA8306
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["podr_itemcode"]["Value"] = $this->podr_itemcode->GetDBValue(true);
        $this->UpdateFields["podr_itemname"]["Value"] = $this->podr_itemname->GetDBValue(true);
        $this->UpdateFields["podr_qty"]["Value"] = $this->podr_qty->GetDBValue(true);
        $this->UpdateFields["podr_site"]["Value"] = $this->podr_site->GetDBValue(true);
        $this->UpdateFields["podr_toppan"]["Value"] = $this->podr_toppan->GetDBValue(true);
        $this->UpdateFields["podr_remarks"]["Value"] = $this->podr_remarks->GetDBValue(true);
        $this->UpdateFields["podr_preqid"]["Value"] = $this->podr_preqid->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsorders", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @68-EB0DE670
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_partsorders";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End GPreqOrdersDataSource Class @68-FCB6E20C

class clsRecordRPreqSignAprv { //RPreqSignAprv Class @82-96687C0F

//Variables @82-D6FF3E86

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

//Class_Initialize Event @82-B73F0EDB
    function clsRecordRPreqSignAprv($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreqSignAprv/Error";
        $this->DataSource = new clsRPreqSignAprvDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreqSignAprv";
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
            $this->preq_approvedby = & new clsControl(ccsListBox, "preq_approvedby", "Approved By", ccsText, "", CCGetRequestParam("preq_approvedby", $Method, NULL), $this);
            $this->preq_approvedby->DSType = dsTable;
            $this->preq_approvedby->DataSource = new clsDBSMART();
            $this->preq_approvedby->ds = & $this->preq_approvedby->DataSource;
            $this->preq_approvedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->preq_approvedby->BoundColumn, $this->preq_approvedby->TextColumn, $this->preq_approvedby->DBFormat) = array("usr_username", "usr_fullname", "");
            $this->preq_approvedby->DataSource->Parameters["expr159"] = 5;
            $this->preq_approvedby->DataSource->Parameters["expr302"] = 7;
            $this->preq_approvedby->DataSource->wp = new clsSQLParameters();
            $this->preq_approvedby->DataSource->wp->AddParameter("1", "expr159", ccsInteger, "", "", $this->preq_approvedby->DataSource->Parameters["expr159"], "", false);
            $this->preq_approvedby->DataSource->wp->AddParameter("2", "expr302", ccsInteger, "", "", $this->preq_approvedby->DataSource->Parameters["expr302"], "", false);
            $this->preq_approvedby->DataSource->wp->Criterion[1] = $this->preq_approvedby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_approvedby->DataSource->wp->GetDBValue("1"), $this->preq_approvedby->DataSource->ToSQL($this->preq_approvedby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->preq_approvedby->DataSource->wp->Criterion[2] = $this->preq_approvedby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_approvedby->DataSource->wp->GetDBValue("2"), $this->preq_approvedby->DataSource->ToSQL($this->preq_approvedby->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->preq_approvedby->DataSource->Where = $this->preq_approvedby->DataSource->wp->opOR(
                 false, 
                 $this->preq_approvedby->DataSource->wp->Criterion[1], 
                 $this->preq_approvedby->DataSource->wp->Criterion[2]);
            $this->preq_approvedby->Required = true;
            $this->preq_approveddate = & new clsControl(ccsTextBox, "preq_approveddate", "Approved Date", ccsDate, array("GeneralDate"), CCGetRequestParam("preq_approveddate", $Method, NULL), $this);
            $this->preq_approveddate->Required = true;
            $this->DatePicker_preq_approveddate = & new clsDatePicker("DatePicker_preq_approveddate", "RPreqSignAprv", "preq_approveddate", $this);
            $this->preq_receivedby = & new clsControl(ccsListBox, "preq_receivedby", "Preq Receivedby", ccsText, "", CCGetRequestParam("preq_receivedby", $Method, NULL), $this);
            $this->preq_receiveddate = & new clsControl(ccsTextBox, "preq_receiveddate", "Preq Receiveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_receiveddate", $Method, NULL), $this);
            $this->preq_processedby = & new clsControl(ccsListBox, "preq_processedby", "Preq Processedby", ccsText, "", CCGetRequestParam("preq_processedby", $Method, NULL), $this);
            $this->preq_processeddate = & new clsControl(ccsTextBox, "preq_processeddate", "Preq Processeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_processeddate", $Method, NULL), $this);
            $this->preq_takenby = & new clsControl(ccsListBox, "preq_takenby", "Preq Takenby", ccsText, "", CCGetRequestParam("preq_takenby", $Method, NULL), $this);
            $this->preq_takendate = & new clsControl(ccsTextBox, "preq_takendate", "Preq Takendate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_takendate", $Method, NULL), $this);
            $this->preq_status = & new clsControl(ccsRadioButton, "preq_status", "Status Approval", ccsText, "", CCGetRequestParam("preq_status", $Method, NULL), $this);
            $this->preq_status->DSType = dsTable;
            $this->preq_status->DataSource = new clsDBSMART();
            $this->preq_status->ds = & $this->preq_status->DataSource;
            $this->preq_status->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->preq_status->BoundColumn, $this->preq_status->TextColumn, $this->preq_status->DBFormat) = array("ref_value", "ref_description", "");
            $this->preq_status->DataSource->Parameters["expr203"] = stataprv;
            $this->preq_status->DataSource->wp = new clsSQLParameters();
            $this->preq_status->DataSource->wp->AddParameter("1", "expr203", ccsText, "", "", $this->preq_status->DataSource->Parameters["expr203"], "", false);
            $this->preq_status->DataSource->wp->Criterion[1] = $this->preq_status->DataSource->wp->Operation(opEqual, "ref_type", $this->preq_status->DataSource->wp->GetDBValue("1"), $this->preq_status->DataSource->ToSQL($this->preq_status->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->preq_status->DataSource->Where = 
                 $this->preq_status->DataSource->wp->Criterion[1];
            $this->preq_status->HTML = true;
            $this->preq_status->Required = true;
            $this->preq_process = & new clsControl(ccsListBox, "preq_process", "preq_process", ccsText, "", CCGetRequestParam("preq_process", $Method, NULL), $this);
            $this->preq_process->DSType = dsTable;
            $this->preq_process->DataSource = new clsDBSMART();
            $this->preq_process->ds = & $this->preq_process->DataSource;
            $this->preq_process->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->preq_process->BoundColumn, $this->preq_process->TextColumn, $this->preq_process->DBFormat) = array("ref_value", "ref_description", "");
            $this->preq_process->DataSource->Parameters["expr249"] = stataprv;
            $this->preq_process->DataSource->wp = new clsSQLParameters();
            $this->preq_process->DataSource->wp->AddParameter("1", "expr249", ccsText, "", "", $this->preq_process->DataSource->Parameters["expr249"], "", false);
            $this->preq_process->DataSource->wp->Criterion[1] = $this->preq_process->DataSource->wp->Operation(opEqual, "ref_type", $this->preq_process->DataSource->wp->GetDBValue("1"), $this->preq_process->DataSource->ToSQL($this->preq_process->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->preq_process->DataSource->Where = 
                 $this->preq_process->DataSource->wp->Criterion[1];
            $this->preq_process->HTML = true;
            $this->status = & new clsControl(ccsHidden, "status", "status", ccsText, "", CCGetRequestParam("status", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->preq_approveddate->Value) && !strlen($this->preq_approveddate->Value) && $this->preq_approveddate->Value !== false)
                    $this->preq_approveddate->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @82-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @82-A79FFA2E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->preq_approvedby->Validate() && $Validation);
        $Validation = ($this->preq_approveddate->Validate() && $Validation);
        $Validation = ($this->preq_receivedby->Validate() && $Validation);
        $Validation = ($this->preq_receiveddate->Validate() && $Validation);
        $Validation = ($this->preq_processedby->Validate() && $Validation);
        $Validation = ($this->preq_processeddate->Validate() && $Validation);
        $Validation = ($this->preq_takenby->Validate() && $Validation);
        $Validation = ($this->preq_takendate->Validate() && $Validation);
        $Validation = ($this->preq_status->Validate() && $Validation);
        $Validation = ($this->preq_process->Validate() && $Validation);
        $Validation = ($this->status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->preq_approvedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_approveddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_receivedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_receiveddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_processedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_processeddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_takenby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_takendate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_process->Errors->Count() == 0);
        $Validation =  $Validation && ($this->status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @82-049EF8E0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_approvedby->Errors->Count());
        $errors = ($errors || $this->preq_approveddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_preq_approveddate->Errors->Count());
        $errors = ($errors || $this->preq_receivedby->Errors->Count());
        $errors = ($errors || $this->preq_receiveddate->Errors->Count());
        $errors = ($errors || $this->preq_processedby->Errors->Count());
        $errors = ($errors || $this->preq_processeddate->Errors->Count());
        $errors = ($errors || $this->preq_takenby->Errors->Count());
        $errors = ($errors || $this->preq_takendate->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->preq_process->Errors->Count());
        $errors = ($errors || $this->status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @82-ED598703
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

//Operation Method @82-2A6C7C54
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
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
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

//UpdateRow Method @82-F8D62FA9
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->preq_approvedby->SetValue($this->preq_approvedby->GetValue(true));
        $this->DataSource->preq_approveddate->SetValue($this->preq_approveddate->GetValue(true));
        $this->DataSource->preq_receivedby->SetValue($this->preq_receivedby->GetValue(true));
        $this->DataSource->preq_receiveddate->SetValue($this->preq_receiveddate->GetValue(true));
        $this->DataSource->preq_processedby->SetValue($this->preq_processedby->GetValue(true));
        $this->DataSource->preq_processeddate->SetValue($this->preq_processeddate->GetValue(true));
        $this->DataSource->preq_takenby->SetValue($this->preq_takenby->GetValue(true));
        $this->DataSource->preq_takendate->SetValue($this->preq_takendate->GetValue(true));
        $this->DataSource->preq_status->SetValue($this->preq_status->GetValue(true));
        $this->DataSource->preq_process->SetValue($this->preq_process->GetValue(true));
        $this->DataSource->status->SetValue($this->status->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @82-59C9ED6E
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

        $this->preq_approvedby->Prepare();
        $this->preq_receivedby->Prepare();
        $this->preq_processedby->Prepare();
        $this->preq_takenby->Prepare();
        $this->preq_status->Prepare();
        $this->preq_process->Prepare();

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
                    $this->preq_approvedby->SetValue($this->DataSource->preq_approvedby->GetValue());
                    $this->preq_approveddate->SetValue($this->DataSource->preq_approveddate->GetValue());
                    $this->preq_receivedby->SetValue($this->DataSource->preq_receivedby->GetValue());
                    $this->preq_receiveddate->SetValue($this->DataSource->preq_receiveddate->GetValue());
                    $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                    $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                    $this->preq_takenby->SetValue($this->DataSource->preq_takenby->GetValue());
                    $this->preq_takendate->SetValue($this->DataSource->preq_takendate->GetValue());
                    $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                    $this->preq_process->SetValue($this->DataSource->preq_process->GetValue());
                    $this->status->SetValue($this->DataSource->status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_approvedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_preq_approveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receivedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takenby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takendate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_process->Errors->ToString());
            $Error = ComposeStrings($Error, $this->status->Errors->ToString());
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
        $this->preq_approvedby->Show();
        $this->preq_approveddate->Show();
        $this->DatePicker_preq_approveddate->Show();
        $this->preq_receivedby->Show();
        $this->preq_receiveddate->Show();
        $this->preq_processedby->Show();
        $this->preq_processeddate->Show();
        $this->preq_takenby->Show();
        $this->preq_takendate->Show();
        $this->preq_status->Show();
        $this->preq_process->Show();
        $this->status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqSignAprv Class @82-FCB6E20C

class clsRPreqSignAprvDataSource extends clsDBSMART {  //RPreqSignAprvDataSource Class @82-71B59F4D

//DataSource Variables @82-5199FD48
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
    var $preq_approvedby;
    var $preq_approveddate;
    var $preq_receivedby;
    var $preq_receiveddate;
    var $preq_processedby;
    var $preq_processeddate;
    var $preq_takenby;
    var $preq_takendate;
    var $preq_status;
    var $preq_process;
    var $status;
//End DataSource Variables

//DataSourceClass_Initialize Event @82-09D6EFD6
    function clsRPreqSignAprvDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreqSignAprv/Error";
        $this->Initialize();
        $this->preq_approvedby = new clsField("preq_approvedby", ccsText, "");
        
        $this->preq_approveddate = new clsField("preq_approveddate", ccsDate, $this->DateFormat);
        
        $this->preq_receivedby = new clsField("preq_receivedby", ccsText, "");
        
        $this->preq_receiveddate = new clsField("preq_receiveddate", ccsDate, $this->DateFormat);
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->preq_takenby = new clsField("preq_takenby", ccsText, "");
        
        $this->preq_takendate = new clsField("preq_takendate", ccsDate, $this->DateFormat);
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        
        $this->preq_process = new clsField("preq_process", ccsText, "");
        
        $this->status = new clsField("status", ccsText, "");
        

        $this->UpdateFields["preq_approvedby"] = array("Name" => "preq_approvedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_approveddate"] = array("Name" => "preq_approveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_receivedby"] = array("Name" => "preq_receivedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_receiveddate"] = array("Name" => "preq_receiveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_processedby"] = array("Name" => "preq_processedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_processeddate"] = array("Name" => "preq_processeddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_takenby"] = array("Name" => "preq_takenby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_takendate"] = array("Name" => "preq_takendate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_approval"] = array("Name" => "preq_approval", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_process"] = array("Name" => "preq_process", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_status"] = array("Name" => "preq_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @82-35B33087
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

//Open Method @82-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @82-F3751C44
    function SetValues()
    {
        $this->preq_approvedby->SetDBValue($this->f("preq_approvedby"));
        $this->preq_approveddate->SetDBValue(trim($this->f("preq_approveddate")));
        $this->preq_receivedby->SetDBValue($this->f("preq_receivedby"));
        $this->preq_receiveddate->SetDBValue(trim($this->f("preq_receiveddate")));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->preq_takenby->SetDBValue($this->f("preq_takenby"));
        $this->preq_takendate->SetDBValue(trim($this->f("preq_takendate")));
        $this->preq_status->SetDBValue($this->f("preq_approval"));
        $this->preq_process->SetDBValue($this->f("preq_process"));
        $this->status->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

//Update Method @82-6F4A5110
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["preq_approvedby"]["Value"] = $this->preq_approvedby->GetDBValue(true);
        $this->UpdateFields["preq_approveddate"]["Value"] = $this->preq_approveddate->GetDBValue(true);
        $this->UpdateFields["preq_receivedby"]["Value"] = $this->preq_receivedby->GetDBValue(true);
        $this->UpdateFields["preq_receiveddate"]["Value"] = $this->preq_receiveddate->GetDBValue(true);
        $this->UpdateFields["preq_processedby"]["Value"] = $this->preq_processedby->GetDBValue(true);
        $this->UpdateFields["preq_processeddate"]["Value"] = $this->preq_processeddate->GetDBValue(true);
        $this->UpdateFields["preq_takenby"]["Value"] = $this->preq_takenby->GetDBValue(true);
        $this->UpdateFields["preq_takendate"]["Value"] = $this->preq_takendate->GetDBValue(true);
        $this->UpdateFields["preq_approval"]["Value"] = $this->preq_status->GetDBValue(true);
        $this->UpdateFields["preq_process"]["Value"] = $this->preq_process->GetDBValue(true);
        $this->UpdateFields["preq_status"]["Value"] = $this->status->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsrequisition", $this->UpdateFields, $this);
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

} //End RPreqSignAprvDataSource Class @82-FCB6E20C

class clsRecordRPreqView { //RPreqView Class @110-A9652AB1

//Variables @110-D6FF3E86

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

//Class_Initialize Event @110-27BE9D95
    function clsRecordRPreqView($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreqView/Error";
        $this->DataSource = new clsRPreqViewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreqView";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->preq_formno = & new clsControl(ccsLabel, "preq_formno", "Preq Formno", ccsText, "", CCGetRequestParam("preq_formno", $Method, NULL), $this);
            $this->preq_dateapplied = & new clsControl(ccsLabel, "preq_dateapplied", "Preq Dateapplied", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_dateapplied", $Method, NULL), $this);
            $this->preq_engineer = & new clsControl(ccsLabel, "preq_engineer", "Preq Engineer", ccsText, "", CCGetRequestParam("preq_engineer", $Method, NULL), $this);
            $this->preq_partsreceived = & new clsControl(ccsLabel, "preq_partsreceived", "Preq Partsreceived", ccsText, "", CCGetRequestParam("preq_partsreceived", $Method, NULL), $this);
            $this->preq_status = & new clsControl(ccsLabel, "preq_status", "preq_status", ccsText, "", CCGetRequestParam("preq_status", $Method, NULL), $this);
            $this->preq_approval = & new clsControl(ccsLabel, "preq_approval", "preq_approval", ccsText, "", CCGetRequestParam("preq_approval", $Method, NULL), $this);
            $this->preq_approval->HTML = true;
            $this->status = & new clsControl(ccsCheckBox, "status", "status", ccsText, "", CCGetRequestParam("status", $Method, NULL), $this);
            $this->status->CheckedValue = $this->status->GetParsedValue(6);
            $this->status->UncheckedValue = false;
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->lblRtn = & new clsControl(ccsLabel, "lblRtn", "lblRtn", ccsText, "", CCGetRequestParam("lblRtn", $Method, NULL), $this);
            $this->linkRtn = & new clsControl(ccsLink, "linkRtn", "linkRtn", ccsText, "", CCGetRequestParam("linkRtn", $Method, NULL), $this);
            $this->linkRtn->Page = "smartpreq.php";
        }
    }
//End Class_Initialize Event

//Initialize Method @110-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @110-F338CE1A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @110-0EB214C2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_formno->Errors->Count());
        $errors = ($errors || $this->preq_dateapplied->Errors->Count());
        $errors = ($errors || $this->preq_engineer->Errors->Count());
        $errors = ($errors || $this->preq_partsreceived->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->preq_approval->Errors->Count());
        $errors = ($errors || $this->status->Errors->Count());
        $errors = ($errors || $this->lblRtn->Errors->Count());
        $errors = ($errors || $this->linkRtn->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @110-ED598703
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

//Operation Method @110-C3D55415
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "view"));
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

//UpdateRow Method @110-5B96948A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->preq_formno->SetValue($this->preq_formno->GetValue(true));
        $this->DataSource->preq_dateapplied->SetValue($this->preq_dateapplied->GetValue(true));
        $this->DataSource->preq_engineer->SetValue($this->preq_engineer->GetValue(true));
        $this->DataSource->preq_partsreceived->SetValue($this->preq_partsreceived->GetValue(true));
        $this->DataSource->preq_status->SetValue($this->preq_status->GetValue(true));
        $this->DataSource->preq_approval->SetValue($this->preq_approval->GetValue(true));
        $this->DataSource->status->SetValue($this->status->GetValue(true));
        $this->DataSource->lblRtn->SetValue($this->lblRtn->GetValue(true));
        $this->DataSource->linkRtn->SetValue($this->linkRtn->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @110-6A43FED2
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
                $this->preq_formno->SetValue($this->DataSource->preq_formno->GetValue());
                $this->preq_dateapplied->SetValue($this->DataSource->preq_dateapplied->GetValue());
                $this->preq_engineer->SetValue($this->DataSource->preq_engineer->GetValue());
                $this->preq_partsreceived->SetValue($this->DataSource->preq_partsreceived->GetValue());
                $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                $this->preq_approval->SetValue($this->DataSource->preq_approval->GetValue());
                $this->lblRtn->SetValue($this->DataSource->lblRtn->GetValue());
                if(!$this->FormSubmitted){
                    $this->status->SetValue($this->DataSource->status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        $this->linkRtn->Parameters = CCGetQueryString("QueryString", array("view", "ccsForm"));
        $this->linkRtn->Parameters = CCAddParam($this->linkRtn->Parameters, "rtn", 1);
        $this->linkRtn->Parameters = CCAddParam($this->linkRtn->Parameters, "id", $this->DataSource->f("id"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_formno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_dateapplied->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_partsreceived->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approval->Errors->ToString());
            $Error = ComposeStrings($Error, $this->status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblRtn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->linkRtn->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->preq_formno->Show();
        $this->preq_dateapplied->Show();
        $this->preq_engineer->Show();
        $this->preq_partsreceived->Show();
        $this->preq_status->Show();
        $this->preq_approval->Show();
        $this->status->Show();
        $this->Button_Update->Show();
        $this->lblRtn->Show();
        $this->linkRtn->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqView Class @110-FCB6E20C

class clsRPreqViewDataSource extends clsDBSMART {  //RPreqViewDataSource Class @110-37080DB1

//DataSource Variables @110-EDEB721C
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
    var $preq_formno;
    var $preq_dateapplied;
    var $preq_engineer;
    var $preq_partsreceived;
    var $preq_status;
    var $preq_approval;
    var $status;
    var $lblRtn;
    var $linkRtn;
//End DataSource Variables

//DataSourceClass_Initialize Event @110-3931E8B1
    function clsRPreqViewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreqView/Error";
        $this->Initialize();
        $this->preq_formno = new clsField("preq_formno", ccsText, "");
        
        $this->preq_dateapplied = new clsField("preq_dateapplied", ccsDate, $this->DateFormat);
        
        $this->preq_engineer = new clsField("preq_engineer", ccsText, "");
        
        $this->preq_partsreceived = new clsField("preq_partsreceived", ccsText, "");
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        
        $this->preq_approval = new clsField("preq_approval", ccsText, "");
        
        $this->status = new clsField("status", ccsText, "");
        
        $this->lblRtn = new clsField("lblRtn", ccsText, "");
        
        $this->linkRtn = new clsField("linkRtn", ccsText, "");
        

        $this->UpdateFields["preq_status"] = array("Name" => "preq_status", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @110-35B33087
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

//Open Method @110-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @110-D6F482E4
    function SetValues()
    {
        $this->preq_formno->SetDBValue($this->f("preq_formno"));
        $this->preq_dateapplied->SetDBValue(trim($this->f("preq_dateapplied")));
        $this->preq_engineer->SetDBValue($this->f("preq_engineer"));
        $this->preq_partsreceived->SetDBValue($this->f("preq_partsreceived"));
        $this->preq_status->SetDBValue($this->f("preq_status"));
        $this->preq_approval->SetDBValue($this->f("preq_approval"));
        $this->status->SetDBValue($this->f("preq_status"));
        $this->lblRtn->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

//Update Method @110-9AB3E7F8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["preq_status"]["Value"] = $this->status->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsrequisition", $this->UpdateFields, $this);
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

} //End RPreqViewDataSource Class @110-FCB6E20C

class clsRecordRPreqSignPrcs { //RPreqSignPrcs Class @160-017237B4

//Variables @160-D6FF3E86

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

//Class_Initialize Event @160-342F98E5
    function clsRecordRPreqSignPrcs($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreqSignPrcs/Error";
        $this->DataSource = new clsRPreqSignPrcsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreqSignPrcs";
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
            $this->preq_approvedby = & new clsControl(ccsLabel, "preq_approvedby", "Preq Approvedby", ccsText, "", CCGetRequestParam("preq_approvedby", $Method, NULL), $this);
            $this->preq_approveddate = & new clsControl(ccsLabel, "preq_approveddate", "Preq Approveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_approveddate", $Method, NULL), $this);
            $this->preq_receivedby = & new clsControl(ccsListBox, "preq_receivedby", "Preq Receivedby", ccsText, "", CCGetRequestParam("preq_receivedby", $Method, NULL), $this);
            $this->preq_receiveddate = & new clsControl(ccsTextBox, "preq_receiveddate", "Preq Receiveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_receiveddate", $Method, NULL), $this);
            $this->preq_processedby = & new clsControl(ccsListBox, "preq_processedby", "Processed By", ccsText, "", CCGetRequestParam("preq_processedby", $Method, NULL), $this);
            $this->preq_processedby->DSType = dsTable;
            $this->preq_processedby->DataSource = new clsDBSMART();
            $this->preq_processedby->ds = & $this->preq_processedby->DataSource;
            $this->preq_processedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->preq_processedby->BoundColumn, $this->preq_processedby->TextColumn, $this->preq_processedby->DBFormat) = array("usr_username", "usr_fullname", "");
            $this->preq_processedby->DataSource->Parameters["expr304"] = 7;
            $this->preq_processedby->DataSource->wp = new clsSQLParameters();
            $this->preq_processedby->DataSource->wp->AddParameter("1", "expr304", ccsInteger, "", "", $this->preq_processedby->DataSource->Parameters["expr304"], "", false);
            $this->preq_processedby->DataSource->wp->Criterion[1] = $this->preq_processedby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_processedby->DataSource->wp->GetDBValue("1"), $this->preq_processedby->DataSource->ToSQL($this->preq_processedby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->preq_processedby->DataSource->Where = 
                 $this->preq_processedby->DataSource->wp->Criterion[1];
            $this->preq_processedby->Required = true;
            $this->preq_processeddate = & new clsControl(ccsTextBox, "preq_processeddate", "Processed Date", ccsDate, array("GeneralDate"), CCGetRequestParam("preq_processeddate", $Method, NULL), $this);
            $this->preq_processeddate->Required = true;
            $this->DatePicker_preq_processeddate = & new clsDatePicker("DatePicker_preq_processeddate", "RPreqSignPrcs", "preq_processeddate", $this);
            $this->preq_takenby = & new clsControl(ccsListBox, "preq_takenby", "Taken By", ccsText, "", CCGetRequestParam("preq_takenby", $Method, NULL), $this);
            $this->preq_takenby->DSType = dsTable;
            $this->preq_takenby->DataSource = new clsDBSMART();
            $this->preq_takenby->ds = & $this->preq_takenby->DataSource;
            $this->preq_takenby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->preq_takenby->BoundColumn, $this->preq_takenby->TextColumn, $this->preq_takenby->DBFormat) = array("usr_username", "usr_fullname", "");
            $this->preq_takenby->DataSource->Parameters["expr306"] = 3;
            $this->preq_takenby->DataSource->wp = new clsSQLParameters();
            $this->preq_takenby->DataSource->wp->AddParameter("1", "expr306", ccsInteger, "", "", $this->preq_takenby->DataSource->Parameters["expr306"], "", false);
            $this->preq_takenby->DataSource->wp->Criterion[1] = $this->preq_takenby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_takenby->DataSource->wp->GetDBValue("1"), $this->preq_takenby->DataSource->ToSQL($this->preq_takenby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->preq_takenby->DataSource->Where = 
                 $this->preq_takenby->DataSource->wp->Criterion[1];
            $this->preq_takenby->Required = true;
            $this->preq_takendate = & new clsControl(ccsTextBox, "preq_takendate", "Taken Date", ccsDate, array("GeneralDate"), CCGetRequestParam("preq_takendate", $Method, NULL), $this);
            $this->preq_takendate->Required = true;
            $this->DatePicker_preq_takendate = & new clsDatePicker("DatePicker_preq_takendate", "RPreqSignPrcs", "preq_takendate", $this);
            $this->preq_approval = & new clsControl(ccsLabel, "preq_approval", "preq_approval", ccsText, "", CCGetRequestParam("preq_approval", $Method, NULL), $this);
            $this->preq_reason = & new clsControl(ccsTextArea, "preq_reason", "preq_reason", ccsText, "", CCGetRequestParam("preq_reason", $Method, NULL), $this);
            $this->preq_status = & new clsControl(ccsListBox, "preq_status", "Status", ccsText, "", CCGetRequestParam("preq_status", $Method, NULL), $this);
            $this->preq_status->DSType = dsListOfValues;
            $this->preq_status->Values = array(array("4", "Released"), array("5", "Cancelled"));
            $this->preq_status->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->preq_processeddate->Value) && !strlen($this->preq_processeddate->Value) && $this->preq_processeddate->Value !== false)
                    $this->preq_processeddate->SetValue(time());
                if(!is_array($this->preq_takendate->Value) && !strlen($this->preq_takendate->Value) && $this->preq_takendate->Value !== false)
                    $this->preq_takendate->SetValue(time());
            }
            if(!is_array($this->preq_approveddate->Value) && !strlen($this->preq_approveddate->Value) && $this->preq_approveddate->Value !== false)
                $this->preq_approveddate->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @160-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @160-A59FDDDF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->preq_receivedby->Validate() && $Validation);
        $Validation = ($this->preq_receiveddate->Validate() && $Validation);
        $Validation = ($this->preq_processedby->Validate() && $Validation);
        $Validation = ($this->preq_processeddate->Validate() && $Validation);
        $Validation = ($this->preq_takenby->Validate() && $Validation);
        $Validation = ($this->preq_takendate->Validate() && $Validation);
        $Validation = ($this->preq_reason->Validate() && $Validation);
        $Validation = ($this->preq_status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->preq_receivedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_receiveddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_processedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_processeddate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_takenby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_takendate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_reason->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @160-FBFCE0DA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_approvedby->Errors->Count());
        $errors = ($errors || $this->preq_approveddate->Errors->Count());
        $errors = ($errors || $this->preq_receivedby->Errors->Count());
        $errors = ($errors || $this->preq_receiveddate->Errors->Count());
        $errors = ($errors || $this->preq_processedby->Errors->Count());
        $errors = ($errors || $this->preq_processeddate->Errors->Count());
        $errors = ($errors || $this->DatePicker_preq_processeddate->Errors->Count());
        $errors = ($errors || $this->preq_takenby->Errors->Count());
        $errors = ($errors || $this->preq_takendate->Errors->Count());
        $errors = ($errors || $this->DatePicker_preq_takendate->Errors->Count());
        $errors = ($errors || $this->preq_approval->Errors->Count());
        $errors = ($errors || $this->preq_reason->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @160-ED598703
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

//Operation Method @160-2A6C7C54
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
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
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

//UpdateRow Method @160-A5BC79B8
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->preq_approvedby->SetValue($this->preq_approvedby->GetValue(true));
        $this->DataSource->preq_approveddate->SetValue($this->preq_approveddate->GetValue(true));
        $this->DataSource->preq_receivedby->SetValue($this->preq_receivedby->GetValue(true));
        $this->DataSource->preq_receiveddate->SetValue($this->preq_receiveddate->GetValue(true));
        $this->DataSource->preq_processedby->SetValue($this->preq_processedby->GetValue(true));
        $this->DataSource->preq_processeddate->SetValue($this->preq_processeddate->GetValue(true));
        $this->DataSource->preq_takenby->SetValue($this->preq_takenby->GetValue(true));
        $this->DataSource->preq_takendate->SetValue($this->preq_takendate->GetValue(true));
        $this->DataSource->preq_approval->SetValue($this->preq_approval->GetValue(true));
        $this->DataSource->preq_reason->SetValue($this->preq_reason->GetValue(true));
        $this->DataSource->preq_status->SetValue($this->preq_status->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @160-0A1CE166
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

        $this->preq_receivedby->Prepare();
        $this->preq_processedby->Prepare();
        $this->preq_takenby->Prepare();
        $this->preq_status->Prepare();

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
                $this->preq_approvedby->SetValue($this->DataSource->preq_approvedby->GetValue());
                $this->preq_approveddate->SetValue($this->DataSource->preq_approveddate->GetValue());
                $this->preq_approval->SetValue($this->DataSource->preq_approval->GetValue());
                if(!$this->FormSubmitted){
                    $this->preq_receivedby->SetValue($this->DataSource->preq_receivedby->GetValue());
                    $this->preq_receiveddate->SetValue($this->DataSource->preq_receiveddate->GetValue());
                    $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                    $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                    $this->preq_takenby->SetValue($this->DataSource->preq_takenby->GetValue());
                    $this->preq_takendate->SetValue($this->DataSource->preq_takendate->GetValue());
                    $this->preq_reason->SetValue($this->DataSource->preq_reason->GetValue());
                    $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_approvedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receivedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_preq_processeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takenby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takendate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_preq_takendate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approval->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_reason->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
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
        $this->preq_approvedby->Show();
        $this->preq_approveddate->Show();
        $this->preq_receivedby->Show();
        $this->preq_receiveddate->Show();
        $this->preq_processedby->Show();
        $this->preq_processeddate->Show();
        $this->DatePicker_preq_processeddate->Show();
        $this->preq_takenby->Show();
        $this->preq_takendate->Show();
        $this->DatePicker_preq_takendate->Show();
        $this->preq_approval->Show();
        $this->preq_reason->Show();
        $this->preq_status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqSignPrcs Class @160-FCB6E20C

class clsRPreqSignPrcsDataSource extends clsDBSMART {  //RPreqSignPrcsDataSource Class @160-F81C4153

//DataSource Variables @160-3B887AED
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
    var $preq_approvedby;
    var $preq_approveddate;
    var $preq_receivedby;
    var $preq_receiveddate;
    var $preq_processedby;
    var $preq_processeddate;
    var $preq_takenby;
    var $preq_takendate;
    var $preq_approval;
    var $preq_reason;
    var $preq_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @160-45F092CB
    function clsRPreqSignPrcsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreqSignPrcs/Error";
        $this->Initialize();
        $this->preq_approvedby = new clsField("preq_approvedby", ccsText, "");
        
        $this->preq_approveddate = new clsField("preq_approveddate", ccsDate, $this->DateFormat);
        
        $this->preq_receivedby = new clsField("preq_receivedby", ccsText, "");
        
        $this->preq_receiveddate = new clsField("preq_receiveddate", ccsDate, $this->DateFormat);
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->preq_takenby = new clsField("preq_takenby", ccsText, "");
        
        $this->preq_takendate = new clsField("preq_takendate", ccsDate, $this->DateFormat);
        
        $this->preq_approval = new clsField("preq_approval", ccsText, "");
        
        $this->preq_reason = new clsField("preq_reason", ccsText, "");
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        

        $this->UpdateFields["preq_receivedby"] = array("Name" => "preq_receivedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_receiveddate"] = array("Name" => "preq_receiveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_processedby"] = array("Name" => "preq_processedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_processeddate"] = array("Name" => "preq_processeddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_takenby"] = array("Name" => "preq_takenby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_takendate"] = array("Name" => "preq_takendate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_reason"] = array("Name" => "preq_reason", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_process"] = array("Name" => "preq_process", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @160-35B33087
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

//Open Method @160-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @160-7B124FA1
    function SetValues()
    {
        $this->preq_approvedby->SetDBValue($this->f("preq_approvedby"));
        $this->preq_approveddate->SetDBValue(trim($this->f("preq_approveddate")));
        $this->preq_receivedby->SetDBValue($this->f("preq_receivedby"));
        $this->preq_receiveddate->SetDBValue(trim($this->f("preq_receiveddate")));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->preq_takenby->SetDBValue($this->f("preq_takenby"));
        $this->preq_takendate->SetDBValue(trim($this->f("preq_takendate")));
        $this->preq_approval->SetDBValue($this->f("preq_approval"));
        $this->preq_reason->SetDBValue($this->f("preq_reason"));
        $this->preq_status->SetDBValue($this->f("preq_process"));
    }
//End SetValues Method

//Update Method @160-40C9B5DE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["preq_receivedby"]["Value"] = $this->preq_receivedby->GetDBValue(true);
        $this->UpdateFields["preq_receiveddate"]["Value"] = $this->preq_receiveddate->GetDBValue(true);
        $this->UpdateFields["preq_processedby"]["Value"] = $this->preq_processedby->GetDBValue(true);
        $this->UpdateFields["preq_processeddate"]["Value"] = $this->preq_processeddate->GetDBValue(true);
        $this->UpdateFields["preq_takenby"]["Value"] = $this->preq_takenby->GetDBValue(true);
        $this->UpdateFields["preq_takendate"]["Value"] = $this->preq_takendate->GetDBValue(true);
        $this->UpdateFields["preq_reason"]["Value"] = $this->preq_reason->GetDBValue(true);
        $this->UpdateFields["preq_process"]["Value"] = $this->preq_status->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsrequisition", $this->UpdateFields, $this);
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

} //End RPreqSignPrcsDataSource Class @160-FCB6E20C

class clsRecordRPreqSignRtn { //RPreqSignRtn Class @181-B3DD805A

//Variables @181-D6FF3E86

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

//Class_Initialize Event @181-460FF4A4
    function clsRecordRPreqSignRtn($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreqSignRtn/Error";
        $this->DataSource = new clsRPreqSignRtnDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreqSignRtn";
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
            $this->preq_approvedby = & new clsControl(ccsLabel, "preq_approvedby", "Preq Approvedby", ccsText, "", CCGetRequestParam("preq_approvedby", $Method, NULL), $this);
            $this->preq_approveddate = & new clsControl(ccsLabel, "preq_approveddate", "Preq Approveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_approveddate", $Method, NULL), $this);
            $this->preq_receivedby = & new clsControl(ccsListBox, "preq_receivedby", "Received By", ccsText, "", CCGetRequestParam("preq_receivedby", $Method, NULL), $this);
            $this->preq_receivedby->DSType = dsTable;
            $this->preq_receivedby->DataSource = new clsDBSMART();
            $this->preq_receivedby->ds = & $this->preq_receivedby->DataSource;
            $this->preq_receivedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->preq_receivedby->BoundColumn, $this->preq_receivedby->TextColumn, $this->preq_receivedby->DBFormat) = array("usr_username", "usr_fullname", "");
            $this->preq_receivedby->DataSource->Parameters["expr308"] = 5;
            $this->preq_receivedby->DataSource->Parameters["expr309"] = 7;
            $this->preq_receivedby->DataSource->wp = new clsSQLParameters();
            $this->preq_receivedby->DataSource->wp->AddParameter("1", "expr308", ccsInteger, "", "", $this->preq_receivedby->DataSource->Parameters["expr308"], "", false);
            $this->preq_receivedby->DataSource->wp->AddParameter("2", "expr309", ccsInteger, "", "", $this->preq_receivedby->DataSource->Parameters["expr309"], "", false);
            $this->preq_receivedby->DataSource->wp->Criterion[1] = $this->preq_receivedby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_receivedby->DataSource->wp->GetDBValue("1"), $this->preq_receivedby->DataSource->ToSQL($this->preq_receivedby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->preq_receivedby->DataSource->wp->Criterion[2] = $this->preq_receivedby->DataSource->wp->Operation(opEqual, "usr_group", $this->preq_receivedby->DataSource->wp->GetDBValue("2"), $this->preq_receivedby->DataSource->ToSQL($this->preq_receivedby->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->preq_receivedby->DataSource->Where = $this->preq_receivedby->DataSource->wp->opOR(
                 false, 
                 $this->preq_receivedby->DataSource->wp->Criterion[1], 
                 $this->preq_receivedby->DataSource->wp->Criterion[2]);
            $this->preq_receivedby->Required = true;
            $this->preq_receiveddate = & new clsControl(ccsTextBox, "preq_receiveddate", "Received Date", ccsDate, array("GeneralDate"), CCGetRequestParam("preq_receiveddate", $Method, NULL), $this);
            $this->preq_receiveddate->Required = true;
            $this->preq_processedby = & new clsControl(ccsLabel, "preq_processedby", "Preq Processedby", ccsText, "", CCGetRequestParam("preq_processedby", $Method, NULL), $this);
            $this->preq_processeddate = & new clsControl(ccsLabel, "preq_processeddate", "Preq Processeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_processeddate", $Method, NULL), $this);
            $this->preq_takenby = & new clsControl(ccsLabel, "preq_takenby", "Preq Takenby", ccsText, "", CCGetRequestParam("preq_takenby", $Method, NULL), $this);
            $this->preq_takendate = & new clsControl(ccsLabel, "preq_takendate", "Preq Takendate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_takendate", $Method, NULL), $this);
            $this->preq_approval = & new clsControl(ccsLabel, "preq_approval", "preq_approval", ccsText, "", CCGetRequestParam("preq_approval", $Method, NULL), $this);
            $this->ListBox1 = & new clsControl(ccsLabel, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->DatePicker_preq_receiveddate = & new clsDatePicker("DatePicker_preq_receiveddate", "RPreqSignRtn", "preq_receiveddate", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->preq_receiveddate->Value) && !strlen($this->preq_receiveddate->Value) && $this->preq_receiveddate->Value !== false)
                    $this->preq_receiveddate->SetValue(time());
            }
            if(!is_array($this->preq_approveddate->Value) && !strlen($this->preq_approveddate->Value) && $this->preq_approveddate->Value !== false)
                $this->preq_approveddate->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @181-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @181-D6EB557D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->preq_receivedby->Validate() && $Validation);
        $Validation = ($this->preq_receiveddate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->preq_receivedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->preq_receiveddate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @181-37A468DE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_approvedby->Errors->Count());
        $errors = ($errors || $this->preq_approveddate->Errors->Count());
        $errors = ($errors || $this->preq_receivedby->Errors->Count());
        $errors = ($errors || $this->preq_receiveddate->Errors->Count());
        $errors = ($errors || $this->preq_processedby->Errors->Count());
        $errors = ($errors || $this->preq_processeddate->Errors->Count());
        $errors = ($errors || $this->preq_takenby->Errors->Count());
        $errors = ($errors || $this->preq_takendate->Errors->Count());
        $errors = ($errors || $this->preq_approval->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->DatePicker_preq_receiveddate->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @181-ED598703
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

//Operation Method @181-2A6C7C54
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
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
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

//UpdateRow Method @181-C4FFEDED
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->preq_approvedby->SetValue($this->preq_approvedby->GetValue(true));
        $this->DataSource->preq_approveddate->SetValue($this->preq_approveddate->GetValue(true));
        $this->DataSource->preq_receivedby->SetValue($this->preq_receivedby->GetValue(true));
        $this->DataSource->preq_receiveddate->SetValue($this->preq_receiveddate->GetValue(true));
        $this->DataSource->preq_processedby->SetValue($this->preq_processedby->GetValue(true));
        $this->DataSource->preq_processeddate->SetValue($this->preq_processeddate->GetValue(true));
        $this->DataSource->preq_takenby->SetValue($this->preq_takenby->GetValue(true));
        $this->DataSource->preq_takendate->SetValue($this->preq_takendate->GetValue(true));
        $this->DataSource->preq_approval->SetValue($this->preq_approval->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @181-F19EB306
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

        $this->preq_receivedby->Prepare();

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
                $this->preq_approvedby->SetValue($this->DataSource->preq_approvedby->GetValue());
                $this->preq_approveddate->SetValue($this->DataSource->preq_approveddate->GetValue());
                $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                $this->preq_takenby->SetValue($this->DataSource->preq_takenby->GetValue());
                $this->preq_takendate->SetValue($this->DataSource->preq_takendate->GetValue());
                $this->preq_approval->SetValue($this->DataSource->preq_approval->GetValue());
                $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                if(!$this->FormSubmitted){
                    $this->preq_receivedby->SetValue($this->DataSource->preq_receivedby->GetValue());
                    $this->preq_receiveddate->SetValue($this->DataSource->preq_receiveddate->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_approvedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receivedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takenby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takendate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approval->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_preq_receiveddate->Errors->ToString());
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
        $this->preq_approvedby->Show();
        $this->preq_approveddate->Show();
        $this->preq_receivedby->Show();
        $this->preq_receiveddate->Show();
        $this->preq_processedby->Show();
        $this->preq_processeddate->Show();
        $this->preq_takenby->Show();
        $this->preq_takendate->Show();
        $this->preq_approval->Show();
        $this->ListBox1->Show();
        $this->DatePicker_preq_receiveddate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqSignRtn Class @181-FCB6E20C

class clsRPreqSignRtnDataSource extends clsDBSMART {  //RPreqSignRtnDataSource Class @181-BC884A31

//DataSource Variables @181-D33FEC2C
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
    var $preq_approvedby;
    var $preq_approveddate;
    var $preq_receivedby;
    var $preq_receiveddate;
    var $preq_processedby;
    var $preq_processeddate;
    var $preq_takenby;
    var $preq_takendate;
    var $preq_approval;
    var $ListBox1;
//End DataSource Variables

//DataSourceClass_Initialize Event @181-A6C943C1
    function clsRPreqSignRtnDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreqSignRtn/Error";
        $this->Initialize();
        $this->preq_approvedby = new clsField("preq_approvedby", ccsText, "");
        
        $this->preq_approveddate = new clsField("preq_approveddate", ccsDate, $this->DateFormat);
        
        $this->preq_receivedby = new clsField("preq_receivedby", ccsText, "");
        
        $this->preq_receiveddate = new clsField("preq_receiveddate", ccsDate, $this->DateFormat);
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->preq_takenby = new clsField("preq_takenby", ccsText, "");
        
        $this->preq_takendate = new clsField("preq_takendate", ccsDate, $this->DateFormat);
        
        $this->preq_approval = new clsField("preq_approval", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        

        $this->UpdateFields["preq_receivedby"] = array("Name" => "preq_receivedby", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["preq_receiveddate"] = array("Name" => "preq_receiveddate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @181-35B33087
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

//Open Method @181-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @181-098260BB
    function SetValues()
    {
        $this->preq_approvedby->SetDBValue($this->f("preq_approvedby"));
        $this->preq_approveddate->SetDBValue(trim($this->f("preq_approveddate")));
        $this->preq_receivedby->SetDBValue($this->f("preq_receivedby"));
        $this->preq_receiveddate->SetDBValue(trim($this->f("preq_receiveddate")));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->preq_takenby->SetDBValue($this->f("preq_takenby"));
        $this->preq_takendate->SetDBValue(trim($this->f("preq_takendate")));
        $this->preq_approval->SetDBValue($this->f("preq_approval"));
        $this->ListBox1->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

//Update Method @181-25CEE010
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["preq_receivedby"]["Value"] = $this->preq_receivedby->GetDBValue(true);
        $this->UpdateFields["preq_receiveddate"]["Value"] = $this->preq_receiveddate->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsrequisition", $this->UpdateFields, $this);
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

} //End RPreqSignRtnDataSource Class @181-FCB6E20C

class clsRecordRPreqSignView { //RPreqSignView Class @208-69CBAB3C

//Variables @208-D6FF3E86

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

//Class_Initialize Event @208-7D8933E5
    function clsRecordRPreqSignView($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RPreqSignView/Error";
        $this->DataSource = new clsRPreqSignViewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RPreqSignView";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->BtnProcess = & new clsButton("BtnProcess", $Method, $this);
            $this->BtnApproval = & new clsButton("BtnApproval", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->preq_approvedby = & new clsControl(ccsLabel, "preq_approvedby", "Preq Approvedby", ccsText, "", CCGetRequestParam("preq_approvedby", $Method, NULL), $this);
            $this->preq_approveddate = & new clsControl(ccsLabel, "preq_approveddate", "Preq Approveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_approveddate", $Method, NULL), $this);
            $this->preq_receivedby = & new clsControl(ccsLabel, "preq_receivedby", "Preq Receivedby", ccsText, "", CCGetRequestParam("preq_receivedby", $Method, NULL), $this);
            $this->preq_receiveddate = & new clsControl(ccsLabel, "preq_receiveddate", "Preq Receiveddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_receiveddate", $Method, NULL), $this);
            $this->preq_processedby = & new clsControl(ccsLabel, "preq_processedby", "Preq Processedby", ccsText, "", CCGetRequestParam("preq_processedby", $Method, NULL), $this);
            $this->preq_processeddate = & new clsControl(ccsLabel, "preq_processeddate", "Preq Processeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_processeddate", $Method, NULL), $this);
            $this->preq_takenby = & new clsControl(ccsLabel, "preq_takenby", "Preq Takenby", ccsText, "", CCGetRequestParam("preq_takenby", $Method, NULL), $this);
            $this->preq_takendate = & new clsControl(ccsLabel, "preq_takendate", "Preq Takendate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_takendate", $Method, NULL), $this);
            $this->preq_status = & new clsControl(ccsLabel, "preq_status", "preq_status", ccsText, "", CCGetRequestParam("preq_status", $Method, NULL), $this);
            $this->preq_process = & new clsControl(ccsLabel, "preq_process", "preq_process", ccsText, "", CCGetRequestParam("preq_process", $Method, NULL), $this);
            $this->preq_reason = & new clsControl(ccsLabel, "preq_reason", "preq_reason", ccsText, "", CCGetRequestParam("preq_reason", $Method, NULL), $this);
            $this->preq_reason->HTML = true;
            if(!is_array($this->preq_approveddate->Value) && !strlen($this->preq_approveddate->Value) && $this->preq_approveddate->Value !== false)
                $this->preq_approveddate->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @208-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @208-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @208-E2BE01C1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_approvedby->Errors->Count());
        $errors = ($errors || $this->preq_approveddate->Errors->Count());
        $errors = ($errors || $this->preq_receivedby->Errors->Count());
        $errors = ($errors || $this->preq_receiveddate->Errors->Count());
        $errors = ($errors || $this->preq_processedby->Errors->Count());
        $errors = ($errors || $this->preq_processeddate->Errors->Count());
        $errors = ($errors || $this->preq_takenby->Errors->Count());
        $errors = ($errors || $this->preq_takendate->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->preq_process->Errors->Count());
        $errors = ($errors || $this->preq_reason->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @208-ED598703
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

//Operation Method @208-CE898C3C
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
            $this->PressedButton = "BtnProcess";
            if($this->BtnProcess->Pressed) {
                $this->PressedButton = "BtnProcess";
            } else if($this->BtnApproval->Pressed) {
                $this->PressedButton = "BtnApproval";
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
            if($this->PressedButton == "BtnProcess") {
                if(!CCGetEvent($this->BtnProcess->CCSEvents, "OnClick", $this->BtnProcess)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "BtnApproval") {
                if(!CCGetEvent($this->BtnApproval->CCSEvents, "OnClick", $this->BtnApproval)) {
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

//Show Method @208-03FDB0EC
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
                $this->preq_approvedby->SetValue($this->DataSource->preq_approvedby->GetValue());
                $this->preq_approveddate->SetValue($this->DataSource->preq_approveddate->GetValue());
                $this->preq_receivedby->SetValue($this->DataSource->preq_receivedby->GetValue());
                $this->preq_receiveddate->SetValue($this->DataSource->preq_receiveddate->GetValue());
                $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                $this->preq_takenby->SetValue($this->DataSource->preq_takenby->GetValue());
                $this->preq_takendate->SetValue($this->DataSource->preq_takendate->GetValue());
                $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                $this->preq_process->SetValue($this->DataSource->preq_process->GetValue());
                $this->preq_reason->SetValue($this->DataSource->preq_reason->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_approvedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receivedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_receiveddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_processeddate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takenby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_takendate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_process->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_reason->Errors->ToString());
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

        $this->BtnProcess->Show();
        $this->BtnApproval->Show();
        $this->Button_Cancel->Show();
        $this->preq_approvedby->Show();
        $this->preq_approveddate->Show();
        $this->preq_receivedby->Show();
        $this->preq_receiveddate->Show();
        $this->preq_processedby->Show();
        $this->preq_processeddate->Show();
        $this->preq_takenby->Show();
        $this->preq_takendate->Show();
        $this->preq_status->Show();
        $this->preq_process->Show();
        $this->preq_reason->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqSignView Class @208-FCB6E20C

class clsRPreqSignViewDataSource extends clsDBSMART {  //RPreqSignViewDataSource Class @208-E5168C66

//DataSource Variables @208-45FD4E03
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $preq_approvedby;
    var $preq_approveddate;
    var $preq_receivedby;
    var $preq_receiveddate;
    var $preq_processedby;
    var $preq_processeddate;
    var $preq_takenby;
    var $preq_takendate;
    var $preq_status;
    var $preq_process;
    var $preq_reason;
//End DataSource Variables

//DataSourceClass_Initialize Event @208-70B2943C
    function clsRPreqSignViewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RPreqSignView/Error";
        $this->Initialize();
        $this->preq_approvedby = new clsField("preq_approvedby", ccsText, "");
        
        $this->preq_approveddate = new clsField("preq_approveddate", ccsDate, $this->DateFormat);
        
        $this->preq_receivedby = new clsField("preq_receivedby", ccsText, "");
        
        $this->preq_receiveddate = new clsField("preq_receiveddate", ccsDate, $this->DateFormat);
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->preq_takenby = new clsField("preq_takenby", ccsText, "");
        
        $this->preq_takendate = new clsField("preq_takendate", ccsDate, $this->DateFormat);
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        
        $this->preq_process = new clsField("preq_process", ccsText, "");
        
        $this->preq_reason = new clsField("preq_reason", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @208-35B33087
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

//Open Method @208-47B294FB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsrequisition {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @208-25B27C2E
    function SetValues()
    {
        $this->preq_approvedby->SetDBValue($this->f("preq_approvedby"));
        $this->preq_approveddate->SetDBValue(trim($this->f("preq_approveddate")));
        $this->preq_receivedby->SetDBValue($this->f("preq_receivedby"));
        $this->preq_receiveddate->SetDBValue(trim($this->f("preq_receiveddate")));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->preq_takenby->SetDBValue($this->f("preq_takenby"));
        $this->preq_takendate->SetDBValue(trim($this->f("preq_takendate")));
        $this->preq_status->SetDBValue($this->f("preq_approval"));
        $this->preq_process->SetDBValue($this->f("preq_process"));
        $this->preq_reason->SetDBValue($this->f("preq_reason"));
    }
//End SetValues Method

} //End RPreqSignViewDataSource Class @208-FCB6E20C

class clsEditableGridGPreqOrdersRtn { //GPreqOrdersRtn Class @256-F3C0D360

//Variables @256-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @256-42E88A21
    function clsEditableGridGPreqOrdersRtn($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GPreqOrdersRtn/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GPreqOrdersRtn";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGPreqOrdersRtnDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "Id", ccsInteger, "", NULL, $this);
        $this->podr_itemcode = & new clsControl(ccsLabel, "podr_itemcode", "Podr Itemcode", ccsText, "", NULL, $this);
        $this->podr_itemname = & new clsControl(ccsLabel, "podr_itemname", "Podr Itemname", ccsText, "", NULL, $this);
        $this->podr_qty = & new clsControl(ccsLabel, "podr_qty", "Podr Qty", ccsInteger, "", NULL, $this);
        $this->podr_site = & new clsControl(ccsLabel, "podr_site", "Podr Site", ccsText, "", NULL, $this);
        $this->podr_toppan = & new clsControl(ccsLabel, "podr_toppan", "Podr Toppan", ccsText, "", NULL, $this);
        $this->podr_remarks = & new clsControl(ccsLabel, "podr_remarks", "Podr Remarks", ccsMemo, "", NULL, $this);
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->podr_preqid = & new clsControl(ccsHidden, "podr_preqid", "Podr Preqid", ccsInteger, "", NULL, $this);
        $this->podr_datereceived = & new clsControl(ccsTextBox, "podr_datereceived", "podr_datereceived", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->podr_qtyreceived = & new clsControl(ccsTextBox, "podr_qtyreceived", "podr_qtyreceived", ccsText, "", NULL, $this);
        $this->podr_remarks2 = & new clsControl(ccsTextBox, "podr_remarks2", "podr_remarks2", ccsText, "", NULL, $this);
        $this->DatePicker_podr_datereceived1 = & new clsDatePicker("DatePicker_podr_datereceived1", "GPreqOrdersRtn", "podr_datereceived", $this);
    }
//End Class_Initialize Event

//Initialize Method @256-48BE527E
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @256-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @256-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @256-B6F442C4
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["podr_preqid"][$RowNumber] = CCGetFromPost("podr_preqid_" . $RowNumber, NULL);
            $this->FormParameters["podr_datereceived"][$RowNumber] = CCGetFromPost("podr_datereceived_" . $RowNumber, NULL);
            $this->FormParameters["podr_qtyreceived"][$RowNumber] = CCGetFromPost("podr_qtyreceived_" . $RowNumber, NULL);
            $this->FormParameters["podr_remarks2"][$RowNumber] = CCGetFromPost("podr_remarks2_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @256-8E42DF8F
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
            $this->podr_datereceived->SetText($this->FormParameters["podr_datereceived"][$this->RowNumber], $this->RowNumber);
            $this->podr_qtyreceived->SetText($this->FormParameters["podr_qtyreceived"][$this->RowNumber], $this->RowNumber);
            $this->podr_remarks2->SetText($this->FormParameters["podr_remarks2"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @256-2904013A
    function ValidateRow()
    {
        global $CCSLocales;
        $this->podr_preqid->Validate();
        $this->podr_datereceived->Validate();
        $this->podr_qtyreceived->Validate();
        $this->podr_remarks2->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->podr_preqid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_datereceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_qtyreceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_remarks2->Errors->ToString());
        $this->podr_preqid->Errors->Clear();
        $this->podr_datereceived->Errors->Clear();
        $this->podr_qtyreceived->Errors->Clear();
        $this->podr_remarks2->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @256-FC44BE6C
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["podr_preqid"][$this->RowNumber]) && count($this->FormParameters["podr_preqid"][$this->RowNumber])) || strlen($this->FormParameters["podr_preqid"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_datereceived"][$this->RowNumber]) && count($this->FormParameters["podr_datereceived"][$this->RowNumber])) || strlen($this->FormParameters["podr_datereceived"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_qtyreceived"][$this->RowNumber]) && count($this->FormParameters["podr_qtyreceived"][$this->RowNumber])) || strlen($this->FormParameters["podr_qtyreceived"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["podr_remarks2"][$this->RowNumber]) && count($this->FormParameters["podr_remarks2"][$this->RowNumber])) || strlen($this->FormParameters["podr_remarks2"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @256-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @256-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @256-25917EEC
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
            $this->podr_datereceived->SetText($this->FormParameters["podr_datereceived"][$this->RowNumber], $this->RowNumber);
            $this->podr_qtyreceived->SetText($this->FormParameters["podr_qtyreceived"][$this->RowNumber], $this->RowNumber);
            $this->podr_remarks2->SetText($this->FormParameters["podr_remarks2"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//UpdateRow Method @256-C7CC9FD1
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->podr_itemcode->SetValue($this->podr_itemcode->GetValue(true));
        $this->DataSource->podr_itemname->SetValue($this->podr_itemname->GetValue(true));
        $this->DataSource->podr_qty->SetValue($this->podr_qty->GetValue(true));
        $this->DataSource->podr_site->SetValue($this->podr_site->GetValue(true));
        $this->DataSource->podr_toppan->SetValue($this->podr_toppan->GetValue(true));
        $this->DataSource->podr_remarks->SetValue($this->podr_remarks->GetValue(true));
        $this->DataSource->podr_preqid->SetValue($this->podr_preqid->GetValue(true));
        $this->DataSource->podr_datereceived->SetValue($this->podr_datereceived->GetValue(true));
        $this->DataSource->podr_qtyreceived->SetValue($this->podr_qtyreceived->GetValue(true));
        $this->DataSource->podr_remarks2->SetValue($this->podr_remarks2->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @256-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @256-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @256-0EEA5586
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @256-692238C5
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @256-061998C4
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
        $this->ControlsVisible["podr_itemcode"] = $this->podr_itemcode->Visible;
        $this->ControlsVisible["podr_itemname"] = $this->podr_itemname->Visible;
        $this->ControlsVisible["podr_qty"] = $this->podr_qty->Visible;
        $this->ControlsVisible["podr_site"] = $this->podr_site->Visible;
        $this->ControlsVisible["podr_toppan"] = $this->podr_toppan->Visible;
        $this->ControlsVisible["podr_remarks"] = $this->podr_remarks->Visible;
        $this->ControlsVisible["podr_preqid"] = $this->podr_preqid->Visible;
        $this->ControlsVisible["podr_datereceived"] = $this->podr_datereceived->Visible;
        $this->ControlsVisible["podr_qtyreceived"] = $this->podr_qtyreceived->Visible;
        $this->ControlsVisible["podr_remarks2"] = $this->podr_remarks2->Visible;
        $this->ControlsVisible["DatePicker_podr_datereceived1"] = $this->DatePicker_podr_datereceived1->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->podr_itemcode->SetValue($this->DataSource->podr_itemcode->GetValue());
                    $this->podr_itemname->SetValue($this->DataSource->podr_itemname->GetValue());
                    $this->podr_qty->SetValue($this->DataSource->podr_qty->GetValue());
                    $this->podr_site->SetValue($this->DataSource->podr_site->GetValue());
                    $this->podr_toppan->SetValue($this->DataSource->podr_toppan->GetValue());
                    $this->podr_remarks->SetValue($this->DataSource->podr_remarks->GetValue());
                    $this->podr_preqid->SetValue($this->DataSource->podr_preqid->GetValue());
                    $this->podr_datereceived->SetValue($this->DataSource->podr_datereceived->GetValue());
                    $this->podr_qtyreceived->SetValue($this->DataSource->podr_qtyreceived->GetValue());
                    $this->podr_remarks2->SetValue($this->DataSource->podr_remarks2->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->podr_itemcode->SetText("");
                    $this->podr_itemname->SetText("");
                    $this->podr_qty->SetText("");
                    $this->podr_site->SetText("");
                    $this->podr_toppan->SetText("");
                    $this->podr_remarks->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->podr_itemcode->SetValue($this->DataSource->podr_itemcode->GetValue());
                    $this->podr_itemname->SetValue($this->DataSource->podr_itemname->GetValue());
                    $this->podr_qty->SetValue($this->DataSource->podr_qty->GetValue());
                    $this->podr_site->SetValue($this->DataSource->podr_site->GetValue());
                    $this->podr_toppan->SetValue($this->DataSource->podr_toppan->GetValue());
                    $this->podr_remarks->SetValue($this->DataSource->podr_remarks->GetValue());
                    $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
                    $this->podr_datereceived->SetText($this->FormParameters["podr_datereceived"][$this->RowNumber], $this->RowNumber);
                    $this->podr_qtyreceived->SetText($this->FormParameters["podr_qtyreceived"][$this->RowNumber], $this->RowNumber);
                    $this->podr_remarks2->SetText($this->FormParameters["podr_remarks2"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->lblNumber->SetText("");
                    $this->podr_itemcode->SetText("");
                    $this->podr_itemname->SetText("");
                    $this->podr_qty->SetText("");
                    $this->podr_site->SetText("");
                    $this->podr_toppan->SetText("");
                    $this->podr_remarks->SetText("");
                    $this->podr_preqid->SetText("");
                    $this->podr_datereceived->SetText("");
                    $this->podr_qtyreceived->SetText("");
                    $this->podr_remarks2->SetText("");
                } else {
                    $this->lblNumber->SetText("");
                    $this->podr_itemcode->SetText("");
                    $this->podr_itemname->SetText("");
                    $this->podr_qty->SetText("");
                    $this->podr_site->SetText("");
                    $this->podr_toppan->SetText("");
                    $this->podr_remarks->SetText("");
                    $this->podr_preqid->SetText($this->FormParameters["podr_preqid"][$this->RowNumber], $this->RowNumber);
                    $this->podr_datereceived->SetText($this->FormParameters["podr_datereceived"][$this->RowNumber], $this->RowNumber);
                    $this->podr_qtyreceived->SetText($this->FormParameters["podr_qtyreceived"][$this->RowNumber], $this->RowNumber);
                    $this->podr_remarks2->SetText($this->FormParameters["podr_remarks2"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show($this->RowNumber);
                $this->podr_itemcode->Show($this->RowNumber);
                $this->podr_itemname->Show($this->RowNumber);
                $this->podr_qty->Show($this->RowNumber);
                $this->podr_site->Show($this->RowNumber);
                $this->podr_toppan->Show($this->RowNumber);
                $this->podr_remarks->Show($this->RowNumber);
                $this->podr_preqid->Show($this->RowNumber);
                $this->podr_datereceived->Show($this->RowNumber);
                $this->podr_qtyreceived->Show($this->RowNumber);
                $this->podr_remarks2->Show($this->RowNumber);
                $this->DatePicker_podr_datereceived1->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["id"] == $this->CachedColumns["id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End GPreqOrdersRtn Class @256-FCB6E20C

class clsGPreqOrdersRtnDataSource extends clsDBSMART {  //GPreqOrdersRtnDataSource Class @256-6DF264EC

//DataSource Variables @256-74173025
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $UpdateFields = array();

    // Datasource fields
    var $lblNumber;
    var $podr_itemcode;
    var $podr_itemname;
    var $podr_qty;
    var $podr_site;
    var $podr_toppan;
    var $podr_remarks;
    var $podr_preqid;
    var $podr_datereceived;
    var $podr_qtyreceived;
    var $podr_remarks2;
//End DataSource Variables

//DataSourceClass_Initialize Event @256-9EF169C6
    function clsGPreqOrdersRtnDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GPreqOrdersRtn/Error";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->podr_itemcode = new clsField("podr_itemcode", ccsText, "");
        
        $this->podr_itemname = new clsField("podr_itemname", ccsText, "");
        
        $this->podr_qty = new clsField("podr_qty", ccsInteger, "");
        
        $this->podr_site = new clsField("podr_site", ccsText, "");
        
        $this->podr_toppan = new clsField("podr_toppan", ccsText, "");
        
        $this->podr_remarks = new clsField("podr_remarks", ccsMemo, "");
        
        $this->podr_preqid = new clsField("podr_preqid", ccsInteger, "");
        
        $this->podr_datereceived = new clsField("podr_datereceived", ccsDate, $this->DateFormat);
        
        $this->podr_qtyreceived = new clsField("podr_qtyreceived", ccsText, "");
        
        $this->podr_remarks2 = new clsField("podr_remarks2", ccsText, "");
        

        $this->UpdateFields["podr_preqid"] = array("Name" => "podr_preqid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_datereceived"] = array("Name" => "podr_datereceived", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_qtyreceived"] = array("Name" => "podr_qtyreceived", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["podr_remarks2"] = array("Name" => "podr_remarks2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @256-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @256-D784D2FC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "podr_preqid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @256-C3432C23
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsorders";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsorders {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @256-7D25762E
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->podr_itemcode->SetDBValue($this->f("podr_itemcode"));
        $this->podr_itemname->SetDBValue($this->f("podr_itemname"));
        $this->podr_qty->SetDBValue(trim($this->f("podr_qty")));
        $this->podr_site->SetDBValue($this->f("podr_site"));
        $this->podr_toppan->SetDBValue($this->f("podr_toppan"));
        $this->podr_remarks->SetDBValue($this->f("podr_remarks"));
        $this->podr_preqid->SetDBValue(trim($this->f("podr_preqid")));
        $this->podr_datereceived->SetDBValue(trim($this->f("podr_datereceived")));
        $this->podr_qtyreceived->SetDBValue($this->f("podr_qtyreceived"));
        $this->podr_remarks2->SetDBValue($this->f("podr_remarks2"));
    }
//End SetValues Method

//Update Method @256-D534D082
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["podr_preqid"]["Value"] = $this->podr_preqid->GetDBValue(true);
        $this->UpdateFields["podr_datereceived"]["Value"] = $this->podr_datereceived->GetDBValue(true);
        $this->UpdateFields["podr_qtyreceived"]["Value"] = $this->podr_qtyreceived->GetDBValue(true);
        $this->UpdateFields["podr_remarks2"]["Value"] = $this->podr_remarks2->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_partsorders", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @256-EB0DE670
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_partsorders";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End GPreqOrdersRtnDataSource Class @256-FCB6E20C

class clsGridGPartsOrdersView { //GPartsOrdersView class @289-63778C1F

//Variables @289-AC1EDBB9

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

//Class_Initialize Event @289-51B659F6
    function clsGridGPartsOrdersView($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GPartsOrdersView";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GPartsOrdersView";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGPartsOrdersViewDataSource($this);
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
        $this->podr_itemcode = & new clsControl(ccsLabel, "podr_itemcode", "podr_itemcode", ccsText, "", CCGetRequestParam("podr_itemcode", ccsGet, NULL), $this);
        $this->podr_itemname = & new clsControl(ccsLabel, "podr_itemname", "podr_itemname", ccsText, "", CCGetRequestParam("podr_itemname", ccsGet, NULL), $this);
        $this->podr_qty = & new clsControl(ccsLabel, "podr_qty", "podr_qty", ccsInteger, "", CCGetRequestParam("podr_qty", ccsGet, NULL), $this);
        $this->podr_site = & new clsControl(ccsLabel, "podr_site", "podr_site", ccsText, "", CCGetRequestParam("podr_site", ccsGet, NULL), $this);
        $this->podr_toppan = & new clsControl(ccsLabel, "podr_toppan", "podr_toppan", ccsText, "", CCGetRequestParam("podr_toppan", ccsGet, NULL), $this);
        $this->podr_remarks = & new clsControl(ccsLabel, "podr_remarks", "podr_remarks", ccsMemo, "", CCGetRequestParam("podr_remarks", ccsGet, NULL), $this);
        $this->podr_datereceived = & new clsControl(ccsLabel, "podr_datereceived", "podr_datereceived", ccsDate, $DefaultDateFormat, CCGetRequestParam("podr_datereceived", ccsGet, NULL), $this);
        $this->podr_qtyreceived = & new clsControl(ccsLabel, "podr_qtyreceived", "podr_qtyreceived", ccsInteger, "", CCGetRequestParam("podr_qtyreceived", ccsGet, NULL), $this);
        $this->podr_remarks2 = & new clsControl(ccsLabel, "podr_remarks2", "podr_remarks2", ccsMemo, "", CCGetRequestParam("podr_remarks2", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @289-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @289-F9AF3C3C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);

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
            $this->ControlsVisible["podr_itemcode"] = $this->podr_itemcode->Visible;
            $this->ControlsVisible["podr_itemname"] = $this->podr_itemname->Visible;
            $this->ControlsVisible["podr_qty"] = $this->podr_qty->Visible;
            $this->ControlsVisible["podr_site"] = $this->podr_site->Visible;
            $this->ControlsVisible["podr_toppan"] = $this->podr_toppan->Visible;
            $this->ControlsVisible["podr_remarks"] = $this->podr_remarks->Visible;
            $this->ControlsVisible["podr_datereceived"] = $this->podr_datereceived->Visible;
            $this->ControlsVisible["podr_qtyreceived"] = $this->podr_qtyreceived->Visible;
            $this->ControlsVisible["podr_remarks2"] = $this->podr_remarks2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->podr_itemcode->SetValue($this->DataSource->podr_itemcode->GetValue());
                $this->podr_itemname->SetValue($this->DataSource->podr_itemname->GetValue());
                $this->podr_qty->SetValue($this->DataSource->podr_qty->GetValue());
                $this->podr_site->SetValue($this->DataSource->podr_site->GetValue());
                $this->podr_toppan->SetValue($this->DataSource->podr_toppan->GetValue());
                $this->podr_remarks->SetValue($this->DataSource->podr_remarks->GetValue());
                $this->podr_datereceived->SetValue($this->DataSource->podr_datereceived->GetValue());
                $this->podr_qtyreceived->SetValue($this->DataSource->podr_qtyreceived->GetValue());
                $this->podr_remarks2->SetValue($this->DataSource->podr_remarks2->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->podr_itemcode->Show();
                $this->podr_itemname->Show();
                $this->podr_qty->Show();
                $this->podr_site->Show();
                $this->podr_toppan->Show();
                $this->podr_remarks->Show();
                $this->podr_datereceived->Show();
                $this->podr_qtyreceived->Show();
                $this->podr_remarks2->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @289-0B0F9C47
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_itemcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_itemname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_toppan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_datereceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_qtyreceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_remarks2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GPartsOrdersView Class @289-FCB6E20C

class clsGPartsOrdersViewDataSource extends clsDBSMART {  //GPartsOrdersViewDataSource Class @289-FC85539A

//DataSource Variables @289-08AF55AF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lblNumber;
    var $podr_itemcode;
    var $podr_itemname;
    var $podr_qty;
    var $podr_site;
    var $podr_toppan;
    var $podr_remarks;
    var $podr_datereceived;
    var $podr_qtyreceived;
    var $podr_remarks2;
//End DataSource Variables

//DataSourceClass_Initialize Event @289-4F2A5448
    function clsGPartsOrdersViewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GPartsOrdersView";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->podr_itemcode = new clsField("podr_itemcode", ccsText, "");
        
        $this->podr_itemname = new clsField("podr_itemname", ccsText, "");
        
        $this->podr_qty = new clsField("podr_qty", ccsInteger, "");
        
        $this->podr_site = new clsField("podr_site", ccsText, "");
        
        $this->podr_toppan = new clsField("podr_toppan", ccsText, "");
        
        $this->podr_remarks = new clsField("podr_remarks", ccsMemo, "");
        
        $this->podr_datereceived = new clsField("podr_datereceived", ccsDate, $this->DateFormat);
        
        $this->podr_qtyreceived = new clsField("podr_qtyreceived", ccsInteger, "");
        
        $this->podr_remarks2 = new clsField("podr_remarks2", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @289-FBDC9F98
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "podr_itemcode";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @289-3F1DFC36
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "podr_preqid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @289-C3432C23
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsorders";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsorders {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @289-FCEF93C8
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->podr_itemcode->SetDBValue($this->f("podr_itemcode"));
        $this->podr_itemname->SetDBValue($this->f("podr_itemname"));
        $this->podr_qty->SetDBValue(trim($this->f("podr_qty")));
        $this->podr_site->SetDBValue($this->f("podr_site"));
        $this->podr_toppan->SetDBValue($this->f("podr_toppan"));
        $this->podr_remarks->SetDBValue($this->f("podr_remarks"));
        $this->podr_datereceived->SetDBValue(trim($this->f("podr_datereceived")));
        $this->podr_qtyreceived->SetDBValue(trim($this->f("podr_qtyreceived")));
        $this->podr_remarks2->SetDBValue($this->f("podr_remarks2"));
    }
//End SetValues Method

} //End GPartsOrdersViewDataSource Class @289-FCB6E20C

//Initialize Page @1-01365FA5
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
$TemplateFileName = "smartpreq.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-98E2EBC1
include_once("./smartpreq_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C81ADF53
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GPreq = & new clsGridGPreq("", $MainPage);
$SPreq = & new clsRecordSPreq("", $MainPage);
$RPreq = & new clsRecordRPreq("", $MainPage);
$GPreqOrders = & new clsEditableGridGPreqOrders("", $MainPage);
$RPreqSignAprv = & new clsRecordRPreqSignAprv("", $MainPage);
$RPreqView = & new clsRecordRPreqView("", $MainPage);
$PanProcessCheck = & new clsPanel("PanProcessCheck", $MainPage);
$lblRequest = & new clsControl(ccsLabel, "lblRequest", "lblRequest", ccsText, "", CCGetRequestParam("lblRequest", ccsGet, NULL), $MainPage);
$lblRequest->HTML = true;
$lblApproval = & new clsControl(ccsLabel, "lblApproval", "lblApproval", ccsText, "", CCGetRequestParam("lblApproval", ccsGet, NULL), $MainPage);
$lblApproval->HTML = true;
$lblInProcess = & new clsControl(ccsLabel, "lblInProcess", "lblInProcess", ccsText, "", CCGetRequestParam("lblInProcess", ccsGet, NULL), $MainPage);
$lblInProcess->HTML = true;
$lblReturned = & new clsControl(ccsLabel, "lblReturned", "lblReturned", ccsText, "", CCGetRequestParam("lblReturned", ccsGet, NULL), $MainPage);
$lblReturned->HTML = true;
$lblFinished = & new clsControl(ccsLabel, "lblFinished", "lblFinished", ccsText, "", CCGetRequestParam("lblFinished", ccsGet, NULL), $MainPage);
$lblFinished->HTML = true;
$lblReleased = & new clsControl(ccsLabel, "lblReleased", "lblReleased", ccsText, "", CCGetRequestParam("lblReleased", ccsGet, NULL), $MainPage);
$lblReleased->HTML = true;
$lblCancelled = & new clsControl(ccsLabel, "lblCancelled", "lblCancelled", ccsText, "", CCGetRequestParam("lblCancelled", ccsGet, NULL), $MainPage);
$lblCancelled->HTML = true;
$RPreqSignPrcs = & new clsRecordRPreqSignPrcs("", $MainPage);
$RPreqSignRtn = & new clsRecordRPreqSignRtn("", $MainPage);
$RPreqSignView = & new clsRecordRPreqSignView("", $MainPage);
$GPreqOrdersRtn = & new clsEditableGridGPreqOrdersRtn("", $MainPage);
$GPartsOrdersView = & new clsGridGPartsOrdersView("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GPreq = & $GPreq;
$MainPage->SPreq = & $SPreq;
$MainPage->RPreq = & $RPreq;
$MainPage->GPreqOrders = & $GPreqOrders;
$MainPage->RPreqSignAprv = & $RPreqSignAprv;
$MainPage->RPreqView = & $RPreqView;
$MainPage->PanProcessCheck = & $PanProcessCheck;
$MainPage->lblRequest = & $lblRequest;
$MainPage->lblApproval = & $lblApproval;
$MainPage->lblInProcess = & $lblInProcess;
$MainPage->lblReturned = & $lblReturned;
$MainPage->lblFinished = & $lblFinished;
$MainPage->lblReleased = & $lblReleased;
$MainPage->lblCancelled = & $lblCancelled;
$MainPage->RPreqSignPrcs = & $RPreqSignPrcs;
$MainPage->RPreqSignRtn = & $RPreqSignRtn;
$MainPage->RPreqSignView = & $RPreqSignView;
$MainPage->GPreqOrdersRtn = & $GPreqOrdersRtn;
$MainPage->GPartsOrdersView = & $GPartsOrdersView;
$PanProcessCheck->AddComponent("lblRequest", $lblRequest);
$PanProcessCheck->AddComponent("lblApproval", $lblApproval);
$PanProcessCheck->AddComponent("lblInProcess", $lblInProcess);
$PanProcessCheck->AddComponent("lblReturned", $lblReturned);
$PanProcessCheck->AddComponent("lblFinished", $lblFinished);
$PanProcessCheck->AddComponent("lblReleased", $lblReleased);
$PanProcessCheck->AddComponent("lblCancelled", $lblCancelled);
$GPreq->Initialize();
$RPreq->Initialize();
$GPreqOrders->Initialize();
$RPreqSignAprv->Initialize();
$RPreqView->Initialize();
$RPreqSignPrcs->Initialize();
$RPreqSignRtn->Initialize();
$RPreqSignView->Initialize();
$GPreqOrdersRtn->Initialize();
$GPartsOrdersView->Initialize();

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

//Execute Components @1-27EFD6C4
$header->Operations();
$footer->Operations();
$SPreq->Operation();
$RPreq->Operation();
$GPreqOrders->Operation();
$RPreqSignAprv->Operation();
$RPreqView->Operation();
$RPreqSignPrcs->Operation();
$RPreqSignRtn->Operation();
$RPreqSignView->Operation();
$GPreqOrdersRtn->Operation();
//End Execute Components

//Go to destination page @1-D0DEC639
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GPreq);
    unset($SPreq);
    unset($RPreq);
    unset($GPreqOrders);
    unset($RPreqSignAprv);
    unset($RPreqView);
    unset($RPreqSignPrcs);
    unset($RPreqSignRtn);
    unset($RPreqSignView);
    unset($GPreqOrdersRtn);
    unset($GPartsOrdersView);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6FE5B35F
$header->Show();
$footer->Show();
$GPreq->Show();
$SPreq->Show();
$RPreq->Show();
$GPreqOrders->Show();
$RPreqSignAprv->Show();
$RPreqView->Show();
$RPreqSignPrcs->Show();
$RPreqSignRtn->Show();
$RPreqSignView->Show();
$GPreqOrdersRtn->Show();
$GPartsOrdersView->Show();
$PanProcessCheck->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B6492236
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GPreq);
unset($SPreq);
unset($RPreq);
unset($GPreqOrders);
unset($RPreqSignAprv);
unset($RPreqView);
unset($RPreqSignPrcs);
unset($RPreqSignRtn);
unset($RPreqSignView);
unset($GPreqOrdersRtn);
unset($GPartsOrdersView);
unset($Tpl);
//End Unload Page


?>
