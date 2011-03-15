<?php
//Include Common Files @1-5B170557
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "AdmLogMngmt.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-C518F6CD
include_once(RelativePath . "/Admin/adminheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsGridGLog { //GLog class @5-49463977

//Variables @5-7790D2DA

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
    var $Sorter_log_userid;
    var $Sorter_log_action;
    var $Sorter_log_ticket;
    var $Sorter_log_date;
//End Variables

//Class_Initialize Event @5-E6EE30EF
    function clsGridGLog($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GLog";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GLog";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGLogDataSource($this);
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
        $this->SorterName = CCGetParam("GLogOrder", "");
        $this->SorterDirection = CCGetParam("GLogDir", "");

        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->log_userid = & new clsControl(ccsLabel, "log_userid", "log_userid", ccsText, "", CCGetRequestParam("log_userid", ccsGet, NULL), $this);
        $this->log_action = & new clsControl(ccsLabel, "log_action", "log_action", ccsText, "", CCGetRequestParam("log_action", ccsGet, NULL), $this);
        $this->log_ticket = & new clsControl(ccsLabel, "log_ticket", "log_ticket", ccsText, "", CCGetRequestParam("log_ticket", ccsGet, NULL), $this);
        $this->log_description = & new clsControl(ccsLabel, "log_description", "log_description", ccsMemo, "", CCGetRequestParam("log_description", ccsGet, NULL), $this);
        $this->log_date = & new clsControl(ccsLabel, "log_date", "log_date", ccsDate, array("GeneralDate"), CCGetRequestParam("log_date", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "AdmLogMngmt.php";
        $this->ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "AdmLogMngmt.php";
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->smart_logactivity_Insert = & new clsControl(ccsLink, "smart_logactivity_Insert", "smart_logactivity_Insert", ccsText, "", CCGetRequestParam("smart_logactivity_Insert", ccsGet, NULL), $this);
        $this->smart_logactivity_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->smart_logactivity_Insert->Page = "AdmLogMngmt.php";
        $this->Sorter_log_userid = & new clsSorter($this->ComponentName, "Sorter_log_userid", $FileName, $this);
        $this->Sorter_log_action = & new clsSorter($this->ComponentName, "Sorter_log_action", $FileName, $this);
        $this->Sorter_log_ticket = & new clsSorter($this->ComponentName, "Sorter_log_ticket", $FileName, $this);
        $this->Sorter_log_date = & new clsSorter($this->ComponentName, "Sorter_log_date", $FileName, $this);
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

//Show Method @5-14D70856
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_log_userid"] = CCGetFromGet("s_log_userid", NULL);
        $this->DataSource->Parameters["urls_log_action"] = CCGetFromGet("s_log_action", NULL);
        $this->DataSource->Parameters["urls_log_ticket"] = CCGetFromGet("s_log_ticket", NULL);

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
            $this->ControlsVisible["log_userid"] = $this->log_userid->Visible;
            $this->ControlsVisible["log_action"] = $this->log_action->Visible;
            $this->ControlsVisible["log_ticket"] = $this->log_ticket->Visible;
            $this->ControlsVisible["log_description"] = $this->log_description->Visible;
            $this->ControlsVisible["log_date"] = $this->log_date->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->log_userid->SetValue($this->DataSource->log_userid->GetValue());
                $this->log_action->SetValue($this->DataSource->log_action->GetValue());
                $this->log_ticket->SetValue($this->DataSource->log_ticket->GetValue());
                $this->log_description->SetValue($this->DataSource->log_description->GetValue());
                $this->log_date->SetValue($this->DataSource->log_date->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "type", det);
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "id", $this->DataSource->f("id"));
                $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "type", del);
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "id", $this->DataSource->f("id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->log_userid->Show();
                $this->log_action->Show();
                $this->log_ticket->Show();
                $this->log_description->Show();
                $this->log_date->Show();
                $this->ImageLink1->Show();
                $this->ImageLink2->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->smart_logactivity_Insert->Show();
        $this->Sorter_log_userid->Show();
        $this->Sorter_log_action->Show();
        $this->Sorter_log_ticket->Show();
        $this->Sorter_log_date->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-5E8D9097
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_userid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_action->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_ticket->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GLog Class @5-FCB6E20C

class clsGLogDataSource extends clsDBSMART {  //GLogDataSource Class @5-CCB4A051

//DataSource Variables @5-36B35ABC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $log_userid;
    var $log_action;
    var $log_ticket;
    var $log_description;
    var $log_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-81F7245B
    function clsGLogDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GLog";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->log_userid = new clsField("log_userid", ccsText, "");
        
        $this->log_action = new clsField("log_action", ccsText, "");
        
        $this->log_ticket = new clsField("log_ticket", ccsText, "");
        
        $this->log_description = new clsField("log_description", ccsMemo, "");
        
        $this->log_date = new clsField("log_date", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-7A0D74AD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "log_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_log_userid" => array("log_userid", ""), 
            "Sorter_log_action" => array("log_action", ""), 
            "Sorter_log_ticket" => array("log_ticket", ""), 
            "Sorter_log_date" => array("log_date", "")));
    }
//End SetOrder Method

//Prepare Method @5-151057DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_log_userid", ccsText, "", "", $this->Parameters["urls_log_userid"], "", false);
        $this->wp->AddParameter("2", "urls_log_action", ccsText, "", "", $this->Parameters["urls_log_action"], "", false);
        $this->wp->AddParameter("3", "urls_log_ticket", ccsText, "", "", $this->Parameters["urls_log_ticket"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "log_userid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "log_action", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "log_ticket", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @5-6612A56F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_logactivity";
        $this->SQL = "SELECT id, log_userid, log_action, log_ticket, log_description, log_date \n\n" .
        "FROM smart_logactivity {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-25EC0F64
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->log_userid->SetDBValue($this->f("log_userid"));
        $this->log_action->SetDBValue($this->f("log_action"));
        $this->log_ticket->SetDBValue($this->f("log_ticket"));
        $this->log_description->SetDBValue($this->f("log_description"));
        $this->log_date->SetDBValue(trim($this->f("log_date")));
    }
//End SetValues Method

} //End GLogDataSource Class @5-FCB6E20C

class clsRecordSLog { //SLog Class @6-5837763E

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

//Class_Initialize Event @6-FB25215F
    function clsRecordSLog($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SLog/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SLog";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_log_userid = & new clsControl(ccsListBox, "s_log_userid", "s_log_userid", ccsText, "", CCGetRequestParam("s_log_userid", $Method, NULL), $this);
            $this->s_log_userid->DSType = dsTable;
            $this->s_log_userid->DataSource = new clsDBSMART();
            $this->s_log_userid->ds = & $this->s_log_userid->DataSource;
            $this->s_log_userid->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->s_log_userid->BoundColumn, $this->s_log_userid->TextColumn, $this->s_log_userid->DBFormat) = array("usr_username", "usr_username", "");
            $this->s_log_action = & new clsControl(ccsCheckBoxList, "s_log_action", "s_log_action", ccsText, "", CCGetRequestParam("s_log_action", $Method, NULL), $this);
            $this->s_log_action->Multiple = true;
            $this->s_log_action->DSType = dsListOfValues;
            $this->s_log_action->Values = array(array("LOGIN", "LOGIN"), array("LOG OUT", "LOG OUT"), array("ADD", "ADD"), array("UPDATE", "UPDATE"), array("DELETE", "DELETE"), array("PRINT", "PRINT"), array("VIEW", "VIEW"), array("ACCEPT", "ACCEPT"), array("REJECT", "REJECT"), array("SUSPICIOUS", "SUSPICIOUS"));
            $this->s_log_action->HTML = true;
            $this->s_log_ticket = & new clsControl(ccsTextBox, "s_log_ticket", "s_log_ticket", ccsText, "", CCGetRequestParam("s_log_ticket", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @6-9FEB6B4B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_log_userid->Validate() && $Validation);
        $Validation = ($this->s_log_action->Validate() && $Validation);
        $Validation = ($this->s_log_ticket->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_log_userid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_log_action->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_log_ticket->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-42F2B92E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_log_userid->Errors->Count());
        $errors = ($errors || $this->s_log_action->Errors->Count());
        $errors = ($errors || $this->s_log_ticket->Errors->Count());
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

//Operation Method @6-EA691E1E
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
        $Redirect = "AdmLogMngmt.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AdmLogMngmt.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-4141140B
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

        $this->s_log_userid->Prepare();
        $this->s_log_action->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_log_userid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_log_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_log_ticket->Errors->ToString());
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
        $this->s_log_userid->Show();
        $this->s_log_action->Show();
        $this->s_log_ticket->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SLog Class @6-FCB6E20C

class clsRecordRLog { //RLog Class @35-65575F8E

//Variables @35-D6FF3E86

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

//Class_Initialize Event @35-2B914762
    function clsRecordRLog($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RLog/Error";
        $this->DataSource = new clsRLogDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RLog";
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
            $this->log_userid = & new clsControl(ccsListBox, "log_userid", "Log Userid", ccsText, "", CCGetRequestParam("log_userid", $Method, NULL), $this);
            $this->log_userid->DSType = dsTable;
            $this->log_userid->DataSource = new clsDBSMART();
            $this->log_userid->ds = & $this->log_userid->DataSource;
            $this->log_userid->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->log_userid->BoundColumn, $this->log_userid->TextColumn, $this->log_userid->DBFormat) = array("usr_username", "usr_username", "");
            $this->log_userid->Required = true;
            $this->log_action = & new clsControl(ccsListBox, "log_action", "Log Action", ccsText, "", CCGetRequestParam("log_action", $Method, NULL), $this);
            $this->log_action->DSType = dsListOfValues;
            $this->log_action->Values = array(array("LOGIN", "LOGIN"), array("LOG OUT", "LOG OUT"), array("ADD", "ADD"), array("UPDATE", "UPDATE"), array("DELETE", "DELETE"), array("PRINT", "PRINT"), array("VIEW", "VIEW"), array("ACCEPT", "ACCEPT"), array("REJECT", "REJECT"), array("SUSPICIOUS", "SUSPICIOUS"));
            $this->log_action->Required = true;
            $this->log_ticket = & new clsControl(ccsTextBox, "log_ticket", "Log Ticket", ccsText, "", CCGetRequestParam("log_ticket", $Method, NULL), $this);
            $this->log_description = & new clsControl(ccsTextArea, "log_description", "Log Description", ccsMemo, "", CCGetRequestParam("log_description", $Method, NULL), $this);
            $this->log_description->Required = true;
            $this->log_date = & new clsControl(ccsTextBox, "log_date", "Log Date", ccsDate, array("GeneralDate"), CCGetRequestParam("log_date", $Method, NULL), $this);
            $this->DatePicker_log_date = & new clsDatePicker("DatePicker_log_date", "RLog", "log_date", $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->log_date->Value) && !strlen($this->log_date->Value) && $this->log_date->Value !== false)
                    $this->log_date->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @35-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @35-DF07EAA5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->log_userid->Validate() && $Validation);
        $Validation = ($this->log_action->Validate() && $Validation);
        $Validation = ($this->log_ticket->Validate() && $Validation);
        $Validation = ($this->log_description->Validate() && $Validation);
        $Validation = ($this->log_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->log_userid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_action->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_ticket->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @35-C1FE2BF7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->log_userid->Errors->Count());
        $errors = ($errors || $this->log_action->Errors->Count());
        $errors = ($errors || $this->log_ticket->Errors->Count());
        $errors = ($errors || $this->log_description->Errors->Count());
        $errors = ($errors || $this->log_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_log_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @35-ED598703
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

//Operation Method @35-0BCA9704
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
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @35-77178916
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->log_userid->SetValue($this->log_userid->GetValue(true));
        $this->DataSource->log_action->SetValue($this->log_action->GetValue(true));
        $this->DataSource->log_ticket->SetValue($this->log_ticket->GetValue(true));
        $this->DataSource->log_description->SetValue($this->log_description->GetValue(true));
        $this->DataSource->log_date->SetValue($this->log_date->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @35-A9018D57
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->log_userid->SetValue($this->log_userid->GetValue(true));
        $this->DataSource->log_action->SetValue($this->log_action->GetValue(true));
        $this->DataSource->log_ticket->SetValue($this->log_ticket->GetValue(true));
        $this->DataSource->log_description->SetValue($this->log_description->GetValue(true));
        $this->DataSource->log_date->SetValue($this->log_date->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @35-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @35-26FF9DC8
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

        $this->log_userid->Prepare();
        $this->log_action->Prepare();

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
                    $this->log_userid->SetValue($this->DataSource->log_userid->GetValue());
                    $this->log_action->SetValue($this->DataSource->log_action->GetValue());
                    $this->log_ticket->SetValue($this->DataSource->log_ticket->GetValue());
                    $this->log_description->SetValue($this->DataSource->log_description->GetValue());
                    $this->log_date->SetValue($this->DataSource->log_date->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->log_userid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_ticket->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_log_date->Errors->ToString());
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
        $this->Button_Cancel->Show();
        $this->log_userid->Show();
        $this->log_action->Show();
        $this->log_ticket->Show();
        $this->log_description->Show();
        $this->log_date->Show();
        $this->DatePicker_log_date->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RLog Class @35-FCB6E20C

class clsRLogDataSource extends clsDBSMART {  //RLogDataSource Class @35-51BDD138

//DataSource Variables @35-1A0C61F4
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
    var $log_userid;
    var $log_action;
    var $log_ticket;
    var $log_description;
    var $log_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @35-B0E08799
    function clsRLogDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RLog/Error";
        $this->Initialize();
        $this->log_userid = new clsField("log_userid", ccsText, "");
        
        $this->log_action = new clsField("log_action", ccsText, "");
        
        $this->log_ticket = new clsField("log_ticket", ccsText, "");
        
        $this->log_description = new clsField("log_description", ccsMemo, "");
        
        $this->log_date = new clsField("log_date", ccsDate, $this->DateFormat);
        

        $this->InsertFields["log_userid"] = array("Name" => "log_userid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["log_action"] = array("Name" => "log_action", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["log_ticket"] = array("Name" => "log_ticket", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["log_description"] = array("Name" => "log_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["log_date"] = array("Name" => "log_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_userid"] = array("Name" => "log_userid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_action"] = array("Name" => "log_action", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_ticket"] = array("Name" => "log_ticket", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_description"] = array("Name" => "log_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_date"] = array("Name" => "log_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @35-35B33087
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

//Open Method @35-B0B4D2C0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_logactivity {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @35-DA0D5EFC
    function SetValues()
    {
        $this->log_userid->SetDBValue($this->f("log_userid"));
        $this->log_action->SetDBValue($this->f("log_action"));
        $this->log_ticket->SetDBValue($this->f("log_ticket"));
        $this->log_description->SetDBValue($this->f("log_description"));
        $this->log_date->SetDBValue(trim($this->f("log_date")));
    }
//End SetValues Method

//Insert Method @35-F0AD1FBF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["log_userid"]["Value"] = $this->log_userid->GetDBValue(true);
        $this->InsertFields["log_action"]["Value"] = $this->log_action->GetDBValue(true);
        $this->InsertFields["log_ticket"]["Value"] = $this->log_ticket->GetDBValue(true);
        $this->InsertFields["log_description"]["Value"] = $this->log_description->GetDBValue(true);
        $this->InsertFields["log_date"]["Value"] = $this->log_date->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_logactivity", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @35-1C517426
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["log_userid"]["Value"] = $this->log_userid->GetDBValue(true);
        $this->UpdateFields["log_action"]["Value"] = $this->log_action->GetDBValue(true);
        $this->UpdateFields["log_ticket"]["Value"] = $this->log_ticket->GetDBValue(true);
        $this->UpdateFields["log_description"]["Value"] = $this->log_description->GetDBValue(true);
        $this->UpdateFields["log_date"]["Value"] = $this->log_date->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_logactivity", $this->UpdateFields, $this);
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

//Delete Method @35-5158F5D5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_logactivity";
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

} //End RLogDataSource Class @35-FCB6E20C

//Initialize Page @1-1B54BF81
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
$TemplateFileName = "AdmLogMngmt.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-19325E71
include_once("./AdmLogMngmt_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-935EBFF8
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$GLog = & new clsGridGLog("", $MainPage);
$SLog = & new clsRecordSLog("", $MainPage);
$RLog = & new clsRecordRLog("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GLog = & $GLog;
$MainPage->SLog = & $SLog;
$MainPage->RLog = & $RLog;
$GLog->Initialize();
$RLog->Initialize();

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

//Execute Components @1-97905B5D
$header->Operations();
$footer->Operations();
$SLog->Operation();
$RLog->Operation();
//End Execute Components

//Go to destination page @1-A3D7C619
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GLog);
    unset($SLog);
    unset($RLog);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A6A3330C
$header->Show();
$footer->Show();
$GLog->Show();
$SLog->Show();
$RLog->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2F7B5C38
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GLog);
unset($SLog);
unset($RLog);
unset($Tpl);
//End Unload Page


?>
