<?php
//Include Common Files @1-D29FBA5B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartprtn.php");
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

class clsGridGRtn { //GRtn class @5-3831EE03

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

//Class_Initialize Event @5-DD1B0805
    function clsGridGRtn($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GRtn";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GRtn";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGRtnDataSource($this);
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

        $this->preq_dateapplied = & new clsControl(ccsLabel, "preq_dateapplied", "preq_dateapplied", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_dateapplied", ccsGet, NULL), $this);
        $this->preq_status = & new clsControl(ccsLabel, "preq_status", "preq_status", ccsText, "", CCGetRequestParam("preq_status", ccsGet, NULL), $this);
        $this->preq_processedby = & new clsControl(ccsLabel, "preq_processedby", "preq_processedby", ccsText, "", CCGetRequestParam("preq_processedby", ccsGet, NULL), $this);
        $this->preq_engineer = & new clsControl(ccsLabel, "preq_engineer", "preq_engineer", ccsText, "", CCGetRequestParam("preq_engineer", ccsGet, NULL), $this);
        $this->preq_formno = & new clsControl(ccsLink, "preq_formno", "preq_formno", ccsText, "", CCGetRequestParam("preq_formno", ccsGet, NULL), $this);
        $this->preq_formno->Page = "smartprtn.php";
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->preq_processeddate = & new clsControl(ccsLabel, "preq_processeddate", "preq_processeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("preq_processeddate", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsText, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblGTitle = & new clsControl(ccsLabel, "lblGTitle", "lblGTitle", ccsText, "", CCGetRequestParam("lblGTitle", ccsGet, NULL), $this);
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

//Show Method @5-4EA28A1B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr36"] = 6;
        $this->DataSource->Parameters["urlfn"] = CCGetFromGet("fn", NULL);

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
            $this->ControlsVisible["preq_status"] = $this->preq_status->Visible;
            $this->ControlsVisible["preq_processedby"] = $this->preq_processedby->Visible;
            $this->ControlsVisible["preq_engineer"] = $this->preq_engineer->Visible;
            $this->ControlsVisible["preq_formno"] = $this->preq_formno->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["preq_processeddate"] = $this->preq_processeddate->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->preq_dateapplied->SetValue($this->DataSource->preq_dateapplied->GetValue());
                $this->preq_status->SetValue($this->DataSource->preq_status->GetValue());
                $this->preq_processedby->SetValue($this->DataSource->preq_processedby->GetValue());
                $this->preq_engineer->SetValue($this->DataSource->preq_engineer->GetValue());
                $this->preq_formno->SetValue($this->DataSource->preq_formno->GetValue());
                $this->preq_formno->Parameters = CCGetQueryString("QueryString", array("fn", "ccsForm"));
                $this->preq_formno->Parameters = CCAddParam($this->preq_formno->Parameters, "rtn", 1);
                $this->preq_formno->Parameters = CCAddParam($this->preq_formno->Parameters, "id", $this->DataSource->f("id"));
                $this->preq_processeddate->SetValue($this->DataSource->preq_processeddate->GetValue());
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->preq_dateapplied->Show();
                $this->preq_status->Show();
                $this->preq_processedby->Show();
                $this->preq_engineer->Show();
                $this->preq_formno->Show();
                $this->lblNumber->Show();
                $this->preq_processeddate->Show();
                $this->id->Show();
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
        $this->lblGTitle->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-01089D08
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->preq_dateapplied->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_processedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_engineer->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_formno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->preq_processeddate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GRtn Class @5-FCB6E20C

class clsGRtnDataSource extends clsDBSMART {  //GRtnDataSource Class @5-B24502B2

//DataSource Variables @5-21D043F5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $preq_dateapplied;
    var $preq_status;
    var $preq_processedby;
    var $preq_engineer;
    var $preq_formno;
    var $preq_processeddate;
    var $id;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-B6928A3C
    function clsGRtnDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GRtn";
        $this->Initialize();
        $this->preq_dateapplied = new clsField("preq_dateapplied", ccsDate, $this->DateFormat);
        
        $this->preq_status = new clsField("preq_status", ccsText, "");
        
        $this->preq_processedby = new clsField("preq_processedby", ccsText, "");
        
        $this->preq_engineer = new clsField("preq_engineer", ccsText, "");
        
        $this->preq_formno = new clsField("preq_formno", ccsText, "");
        
        $this->preq_processeddate = new clsField("preq_processeddate", ccsDate, $this->DateFormat);
        
        $this->id = new clsField("id", ccsText, "");
        

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

//Prepare Method @5-08249A35
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr36", ccsText, "", "", $this->Parameters["expr36"], "", false);
        $this->wp->AddParameter("2", "urlfn", ccsText, "", "", $this->Parameters["urlfn"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "preq_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "preq_formno", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-C7FDBCAA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsrequisition";
        $this->SQL = "SELECT preq_status, preq_formno, preq_dateapplied, preq_engineer, preq_processeddate, preq_processedby, id \n\n" .
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

//SetValues Method @5-AC3BC055
    function SetValues()
    {
        $this->preq_dateapplied->SetDBValue(trim($this->f("preq_dateapplied")));
        $this->preq_status->SetDBValue($this->f("preq_status"));
        $this->preq_processedby->SetDBValue($this->f("preq_processedby"));
        $this->preq_engineer->SetDBValue($this->f("preq_engineer"));
        $this->preq_formno->SetDBValue($this->f("preq_formno"));
        $this->preq_processeddate->SetDBValue(trim($this->f("preq_processeddate")));
        $this->id->SetDBValue($this->f("id"));
    }
//End SetValues Method

} //End GRtnDataSource Class @5-FCB6E20C

class clsRecordSRtn { //SRtn Class @6-2940A14A

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

//Class_Initialize Event @6-46893DB9
    function clsRecordSRtn($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SRtn/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SRtn";
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
        }
    }
//End Class_Initialize Event

//Validate Method @6-15558840
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->fn->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->fn->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-5EFA1354
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->fn->Errors->Count());
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

//Operation Method @6-C8DA5716
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
        $Redirect = "smartprtn.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartprtn.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-73A40480
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->fn->Errors->ToString());
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SRtn Class @6-FCB6E20C

//DEL      function Open()
//DEL      {
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
//DEL          $this->CountSQL = "SELECT COUNT(*)\n\n" .
//DEL          "FROM smart_partsorders";
//DEL          $this->SQL = "SELECT podr_itemcode, podr_itemname, podr_qty, podr_rtnstatus, podr_rtncounter, podr_rtndate, podr_remarks2, podr_site, podr_preqid\n\n" .
//DEL          "FROM smart_partsorders {SQL_Where} {SQL_OrderBy}";
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
//DEL          if ($this->CountSQL) 
//DEL              $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
//DEL          else
//DEL              $this->RecordsCount = "CCS not counted";
//DEL          $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
//DEL      }

class clsEditableGridGCheckList { //GCheckList Class @256-5DADD074

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

//Class_Initialize Event @256-F759D808
    function clsEditableGridGCheckList($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GCheckList/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GCheckList";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGCheckListDataSource($this);
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
        $this->DatePicker_podr_datereceived1 = & new clsDatePicker("DatePicker_podr_datereceived1", "GCheckList", "podr_datereceived", $this);
        $this->NoteGrid = & new clsControl(ccsLabel, "NoteGrid", "NoteGrid", ccsText, "", NULL, $this);
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

//Show Method @256-3640EA6A
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
        $this->NoteGrid->Show();

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

} //End GCheckList Class @256-FCB6E20C

class clsGCheckListDataSource extends clsDBSMART {  //GCheckListDataSource Class @256-6C6DE953

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

//DataSourceClass_Initialize Event @256-F72B5E42
    function clsGCheckListDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GCheckList/Error";
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

} //End GCheckListDataSource Class @256-FCB6E20C

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

//Class_Initialize Event @110-36B7F7D8
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
            $this->lblRtn = & new clsControl(ccsLabel, "lblRtn", "lblRtn", ccsText, "", CCGetRequestParam("lblRtn", $Method, NULL), $this);
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

//Validate Method @110-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @110-667DF1B2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->preq_formno->Errors->Count());
        $errors = ($errors || $this->preq_dateapplied->Errors->Count());
        $errors = ($errors || $this->preq_engineer->Errors->Count());
        $errors = ($errors || $this->preq_partsreceived->Errors->Count());
        $errors = ($errors || $this->preq_status->Errors->Count());
        $errors = ($errors || $this->preq_approval->Errors->Count());
        $errors = ($errors || $this->lblRtn->Errors->Count());
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

//Operation Method @110-17DC9883
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

//UpdateRow Method @110-581E4997
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
        $this->DataSource->lblRtn->SetValue($this->lblRtn->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @110-2330BF63
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
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->preq_formno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_dateapplied->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_partsreceived->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->preq_approval->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblRtn->Errors->ToString());
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

        $this->preq_formno->Show();
        $this->preq_dateapplied->Show();
        $this->preq_engineer->Show();
        $this->preq_partsreceived->Show();
        $this->preq_status->Show();
        $this->preq_approval->Show();
        $this->lblRtn->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RPreqView Class @110-FCB6E20C

class clsRPreqViewDataSource extends clsDBSMART {  //RPreqViewDataSource Class @110-37080DB1

//DataSource Variables @110-321A0D83
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
    var $lblRtn;
//End DataSource Variables

//DataSourceClass_Initialize Event @110-5A84B303
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
        
        $this->lblRtn = new clsField("lblRtn", ccsText, "");
        

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

//SetValues Method @110-2CD346F1
    function SetValues()
    {
        $this->preq_formno->SetDBValue($this->f("preq_formno"));
        $this->preq_dateapplied->SetDBValue(trim($this->f("preq_dateapplied")));
        $this->preq_engineer->SetDBValue($this->f("preq_engineer"));
        $this->preq_partsreceived->SetDBValue($this->f("preq_partsreceived"));
        $this->preq_status->SetDBValue($this->f("preq_status"));
        $this->preq_approval->SetDBValue($this->f("preq_approval"));
        $this->lblRtn->SetDBValue($this->f("preq_status"));
    }
//End SetValues Method

//Update Method @110-FFE06679
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
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

//Initialize Page @1-61E89E09
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
$TemplateFileName = "smartprtn.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C047181C
include_once("./smartprtn_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D5933C1B
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GRtn = & new clsGridGRtn("", $MainPage);
$SRtn = & new clsRecordSRtn("", $MainPage);
$GCheckList = & new clsEditableGridGCheckList("", $MainPage);
$RPreqView = & new clsRecordRPreqView("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GRtn = & $GRtn;
$MainPage->SRtn = & $SRtn;
$MainPage->GCheckList = & $GCheckList;
$MainPage->RPreqView = & $RPreqView;
$GRtn->Initialize();
$GCheckList->Initialize();
$RPreqView->Initialize();

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

//Execute Components @1-850250BA
$header->Operations();
$footer->Operations();
$SRtn->Operation();
$GCheckList->Operation();
$RPreqView->Operation();
//End Execute Components

//Go to destination page @1-651DADDD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GRtn);
    unset($SRtn);
    unset($GCheckList);
    unset($RPreqView);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A7330ABD
$header->Show();
$footer->Show();
$GRtn->Show();
$SRtn->Show();
$GCheckList->Show();
$RPreqView->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F3A3CD9C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GRtn);
unset($SRtn);
unset($GCheckList);
unset($RPreqView);
unset($Tpl);
//End Unload Page


?>
