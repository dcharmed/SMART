<?php
//Include Common Files @1-89994800
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "popstatus.php");
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

class clsRecordsmart_task { //smart_task Class @5-BFD8BE96

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

//Class_Initialize Event @5-453139F2
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
        $this->InsertAllowed = true;
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
            $this->task_newstatus = & new clsControl(ccsListBox, "task_newstatus", "Task Newstatus", ccsText, "", CCGetRequestParam("task_newstatus", $Method, NULL), $this);
            $this->task_newstatus->DSType = dsTable;
            $this->task_newstatus->DataSource = new clsDBSMART();
            $this->task_newstatus->ds = & $this->task_newstatus->DataSource;
            $this->task_newstatus->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->task_newstatus->DataSource->Order = "ref_rank";
            list($this->task_newstatus->BoundColumn, $this->task_newstatus->TextColumn, $this->task_newstatus->DBFormat) = array("ref_value", "ref_description", "");
            $this->task_newstatus->DataSource->Parameters["expr20"] = tcktstatus;
            $this->task_newstatus->DataSource->wp = new clsSQLParameters();
            $this->task_newstatus->DataSource->wp->AddParameter("1", "expr20", ccsText, "", "", $this->task_newstatus->DataSource->Parameters["expr20"], "", false);
            $this->task_newstatus->DataSource->wp->Criterion[1] = $this->task_newstatus->DataSource->wp->Operation(opEqual, "ref_type", $this->task_newstatus->DataSource->wp->GetDBValue("1"), $this->task_newstatus->DataSource->ToSQL($this->task_newstatus->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->task_newstatus->DataSource->Where = 
                 $this->task_newstatus->DataSource->wp->Criterion[1];
            $this->task_newstatus->DataSource->Order = "ref_rank";
            $this->task_newstatus->Required = true;
            $this->task_personincharge = & new clsControl(ccsListBox, "task_personincharge", "Task Personincharge", ccsInteger, "", CCGetRequestParam("task_personincharge", $Method, NULL), $this);
            $this->task_personincharge->DSType = dsTable;
            $this->task_personincharge->DataSource = new clsDBSMART();
            $this->task_personincharge->ds = & $this->task_personincharge->DataSource;
            $this->task_personincharge->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->task_personincharge->BoundColumn, $this->task_personincharge->TextColumn, $this->task_personincharge->DBFormat) = array("id", "usr_fullname", "");
            $this->task_personincharge->DataSource->Parameters["expr22"] = 3;
            $this->task_personincharge->DataSource->wp = new clsSQLParameters();
            $this->task_personincharge->DataSource->wp->AddParameter("1", "expr22", ccsInteger, "", "", $this->task_personincharge->DataSource->Parameters["expr22"], "", false);
            $this->task_personincharge->DataSource->wp->Criterion[1] = $this->task_personincharge->DataSource->wp->Operation(opEqual, "usr_group", $this->task_personincharge->DataSource->wp->GetDBValue("1"), $this->task_personincharge->DataSource->ToSQL($this->task_personincharge->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->task_personincharge->DataSource->Where = 
                 $this->task_personincharge->DataSource->wp->Criterion[1];
            $this->task_secpersonincharge = & new clsControl(ccsListBox, "task_secpersonincharge", "Task Secpersonincharge", ccsInteger, "", CCGetRequestParam("task_secpersonincharge", $Method, NULL), $this);
            $this->task_secpersonincharge->DSType = dsTable;
            $this->task_secpersonincharge->DataSource = new clsDBSMART();
            $this->task_secpersonincharge->ds = & $this->task_secpersonincharge->DataSource;
            $this->task_secpersonincharge->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->task_secpersonincharge->BoundColumn, $this->task_secpersonincharge->TextColumn, $this->task_secpersonincharge->DBFormat) = array("id", "usr_fullname", "");
            $this->task_secpersonincharge->DataSource->Parameters["expr24"] = 3;
            $this->task_secpersonincharge->DataSource->wp = new clsSQLParameters();
            $this->task_secpersonincharge->DataSource->wp->AddParameter("1", "expr24", ccsInteger, "", "", $this->task_secpersonincharge->DataSource->Parameters["expr24"], "", false);
            $this->task_secpersonincharge->DataSource->wp->Criterion[1] = $this->task_secpersonincharge->DataSource->wp->Operation(opEqual, "usr_group", $this->task_secpersonincharge->DataSource->wp->GetDBValue("1"), $this->task_secpersonincharge->DataSource->ToSQL($this->task_secpersonincharge->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->task_secpersonincharge->DataSource->Where = 
                 $this->task_secpersonincharge->DataSource->wp->Criterion[1];
            $this->task_adukomid = & new clsControl(ccsTextBox, "task_adukomid", "Task Adukomid", ccsInteger, "", CCGetRequestParam("task_adukomid", $Method, NULL), $this);
            $this->currentstatus = & new clsControl(ccsTextBox, "currentstatus", "currentstatus", ccsText, "", CCGetRequestParam("currentstatus", $Method, NULL), $this);
            $this->task_currentstatus = & new clsControl(ccsHidden, "task_currentstatus", "Task Currentstatus", ccsInteger, "", CCGetRequestParam("task_currentstatus", $Method, NULL), $this);
            $this->Reason = & new clsControl(ccsTextArea, "Reason", "Reason", ccsText, "", CCGetRequestParam("Reason", $Method, NULL), $this);
            $this->closedby = & new clsControl(ccsListBox, "closedby", "Task Personincharge", ccsInteger, "", CCGetRequestParam("closedby", $Method, NULL), $this);
            $this->closedby->DSType = dsTable;
            $this->closedby->DataSource = new clsDBSMART();
            $this->closedby->ds = & $this->closedby->DataSource;
            $this->closedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->closedby->BoundColumn, $this->closedby->TextColumn, $this->closedby->DBFormat) = array("id", "usr_fullname", "");
            $this->closedby->DataSource->Parameters["expr27"] = 3;
            $this->closedby->DataSource->wp = new clsSQLParameters();
            $this->closedby->DataSource->wp->AddParameter("1", "expr27", ccsInteger, "", "", $this->closedby->DataSource->Parameters["expr27"], "", false);
            $this->closedby->DataSource->wp->Criterion[1] = $this->closedby->DataSource->wp->Operation(opEqual, "usr_group", $this->closedby->DataSource->wp->GetDBValue("1"), $this->closedby->DataSource->ToSQL($this->closedby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->closedby->DataSource->Where = 
                 $this->closedby->DataSource->wp->Criterion[1];
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->datemodified->Value) && !strlen($this->datemodified->Value) && $this->datemodified->Value !== false)
                    $this->datemodified->SetValue(time());
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

//Validate Method @5-A4C73EAC
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
        $Validation = ($this->closedby->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_newstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_personincharge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_secpersonincharge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_adukomid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->currentstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_currentstatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Reason->Errors->Count() == 0);
        $Validation =  $Validation && ($this->closedby->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-BFDCE2C8
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
        $errors = ($errors || $this->closedby->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
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

//Operation Method @5-DEFDCF33
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
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @5-DDB5C7CB
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->task_newstatus->SetValue($this->task_newstatus->GetValue(true));
        $this->DataSource->task_personincharge->SetValue($this->task_personincharge->GetValue(true));
        $this->DataSource->task_secpersonincharge->SetValue($this->task_secpersonincharge->GetValue(true));
        $this->DataSource->task_adukomid->SetValue($this->task_adukomid->GetValue(true));
        $this->DataSource->currentstatus->SetValue($this->currentstatus->GetValue(true));
        $this->DataSource->task_currentstatus->SetValue($this->task_currentstatus->GetValue(true));
        $this->DataSource->Reason->SetValue($this->Reason->GetValue(true));
        $this->DataSource->closedby->SetValue($this->closedby->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @5-6959FEEA
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
        $this->closedby->Prepare();

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
                    $this->closedby->SetValue($this->DataSource->closedby->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
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
            $Error = ComposeStrings($Error, $this->closedby->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
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
        $this->ticket_id->Show();
        $this->task_newstatus->Show();
        $this->task_personincharge->Show();
        $this->task_secpersonincharge->Show();
        $this->task_adukomid->Show();
        $this->currentstatus->Show();
        $this->task_currentstatus->Show();
        $this->Reason->Show();
        $this->closedby->Show();
        $this->datemodified->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_task Class @5-FCB6E20C

class clssmart_taskDataSource extends clsDBSMART {  //smart_taskDataSource Class @5-EE694EE6

//DataSource Variables @5-DCAFBD61
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
    var $ticket_id;
    var $task_newstatus;
    var $task_personincharge;
    var $task_secpersonincharge;
    var $task_adukomid;
    var $currentstatus;
    var $task_currentstatus;
    var $Reason;
    var $closedby;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-22C4F94A
    function clssmart_taskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_task/Error";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->task_newstatus = new clsField("task_newstatus", ccsText, "");
        
        $this->task_personincharge = new clsField("task_personincharge", ccsInteger, "");
        
        $this->task_secpersonincharge = new clsField("task_secpersonincharge", ccsInteger, "");
        
        $this->task_adukomid = new clsField("task_adukomid", ccsInteger, "");
        
        $this->currentstatus = new clsField("currentstatus", ccsText, "");
        
        $this->task_currentstatus = new clsField("task_currentstatus", ccsInteger, "");
        
        $this->Reason = new clsField("Reason", ccsText, "");
        
        $this->closedby = new clsField("closedby", ccsInteger, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        

        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_newstatus"] = array("Name" => "task_newstatus", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["task_personincharge"] = array("Name" => "task_personincharge", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_secpersonincharge"] = array("Name" => "task_secpersonincharge", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_adukomid"] = array("Name" => "task_adukomid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_currentstatus"] = array("Name" => "task_currentstatus", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_secpersoninchargenote"] = array("Name" => "task_secpersoninchargenote", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["task_closedby"] = array("Name" => "task_closedby", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
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

//Open Method @5-9AC22D9E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_task {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-D141C245
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->task_newstatus->SetDBValue($this->f("task_newstatus"));
        $this->task_personincharge->SetDBValue(trim($this->f("task_personincharge")));
        $this->task_secpersonincharge->SetDBValue(trim($this->f("task_secpersonincharge")));
        $this->task_adukomid->SetDBValue(trim($this->f("task_adukomid")));
        $this->task_currentstatus->SetDBValue(trim($this->f("task_currentstatus")));
        $this->Reason->SetDBValue($this->f("task_secpersoninchargenote"));
        $this->closedby->SetDBValue(trim($this->f("task_closedby")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

//Insert Method @5-E1A64B03
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["task_newstatus"]["Value"] = $this->task_newstatus->GetDBValue(true);
        $this->InsertFields["task_personincharge"]["Value"] = $this->task_personincharge->GetDBValue(true);
        $this->InsertFields["task_secpersonincharge"]["Value"] = $this->task_secpersonincharge->GetDBValue(true);
        $this->InsertFields["task_adukomid"]["Value"] = $this->task_adukomid->GetDBValue(true);
        $this->InsertFields["task_currentstatus"]["Value"] = $this->task_currentstatus->GetDBValue(true);
        $this->InsertFields["task_secpersoninchargenote"]["Value"] = $this->Reason->GetDBValue(true);
        $this->InsertFields["task_closedby"]["Value"] = $this->closedby->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_task", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End smart_taskDataSource Class @5-FCB6E20C

//Initialize Page @1-63535F61
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
$TemplateFileName = "popstatus.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-596A63B6
include_once("./popstatus_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5F1572B8
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_task = & new clsRecordsmart_task("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_task = & $smart_task;
$smart_task->Initialize();

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

//Execute Components @1-438FC614
$header->Operations();
$footer->Operations();
$smart_task->Operation();
//End Execute Components

//Go to destination page @1-B650AC89
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_task);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-381FA197
$header->Show();
$footer->Show();
$smart_task->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B0F077E3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_task);
unset($Tpl);
//End Unload Page


?>
