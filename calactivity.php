<?php
//Include Common Files @1-3BF2447B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "calactivity.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/CalendarNavigator.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation



class clsRecordRActivityDetails { //RActivityDetails Class @23-11BC81C4

//Variables @23-D6FF3E86

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

//Class_Initialize Event @23-EB8709D8
    function clsRecordRActivityDetails($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RActivityDetails/Error";
        $this->DataSource = new clsRActivityDetailsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RActivityDetails";
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
            $this->cal_userid = & new clsControl(ccsListBox, "cal_userid", "Cal Userid", ccsInteger, "", CCGetRequestParam("cal_userid", $Method, NULL), $this);
            $this->cal_userid->DSType = dsTable;
            $this->cal_userid->DataSource = new clsDBSMART();
            $this->cal_userid->ds = & $this->cal_userid->DataSource;
            $this->cal_userid->DataSource->SQL = "SELECT id, usr_fullname, usr_username \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->cal_userid->BoundColumn, $this->cal_userid->TextColumn, $this->cal_userid->DBFormat) = array("id", "usr_username", "");
            $this->cal_userid->DataSource->Parameters["expr69"] = 0;
            $this->cal_userid->DataSource->wp = new clsSQLParameters();
            $this->cal_userid->DataSource->wp->AddParameter("1", "expr69", ccsInteger, "", "", $this->cal_userid->DataSource->Parameters["expr69"], "", false);
            $this->cal_userid->DataSource->wp->Criterion[1] = $this->cal_userid->DataSource->wp->Operation(opEqual, "usr_flag", $this->cal_userid->DataSource->wp->GetDBValue("1"), $this->cal_userid->DataSource->ToSQL($this->cal_userid->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->cal_userid->DataSource->Where = 
                 $this->cal_userid->DataSource->wp->Criterion[1];
            $this->cal_userid->Required = true;
            $this->cal_type = & new clsControl(ccsRadioButton, "cal_type", "Cal Type", ccsText, "", CCGetRequestParam("cal_type", $Method, NULL), $this);
            $this->cal_type->DSType = dsTable;
            $this->cal_type->DataSource = new clsDBSMART();
            $this->cal_type->ds = & $this->cal_type->DataSource;
            $this->cal_type->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->cal_type->DataSource->Order = "ref_rank";
            list($this->cal_type->BoundColumn, $this->cal_type->TextColumn, $this->cal_type->DBFormat) = array("ref_value", "ref_description", "");
            $this->cal_type->DataSource->Parameters["expr39"] = evnttype;
            $this->cal_type->DataSource->wp = new clsSQLParameters();
            $this->cal_type->DataSource->wp->AddParameter("1", "expr39", ccsText, "", "", $this->cal_type->DataSource->Parameters["expr39"], "", false);
            $this->cal_type->DataSource->wp->Criterion[1] = $this->cal_type->DataSource->wp->Operation(opEqual, "ref_type", $this->cal_type->DataSource->wp->GetDBValue("1"), $this->cal_type->DataSource->ToSQL($this->cal_type->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->cal_type->DataSource->Where = 
                 $this->cal_type->DataSource->wp->Criterion[1];
            $this->cal_type->DataSource->Order = "ref_rank";
            $this->cal_type->HTML = true;
            $this->cal_type->Required = true;
            $this->cal_description = & new clsControl(ccsTextArea, "cal_description", "Cal Description", ccsMemo, "", CCGetRequestParam("cal_description", $Method, NULL), $this);
            $this->cal_description->Required = true;
            $this->cal_datefrom = & new clsControl(ccsTextBox, "cal_datefrom", "Cal Datefrom", ccsDate, $DefaultDateFormat, CCGetRequestParam("cal_datefrom", $Method, NULL), $this);
            $this->DatePicker_cal_datefrom = & new clsDatePicker("DatePicker_cal_datefrom", "RActivityDetails", "cal_datefrom", $this);
            $this->cal_dateto = & new clsControl(ccsTextBox, "cal_dateto", "Cal Dateto", ccsDate, $DefaultDateFormat, CCGetRequestParam("cal_dateto", $Method, NULL), $this);
            $this->DatePicker_cal_dateto = & new clsDatePicker("DatePicker_cal_dateto", "RActivityDetails", "cal_dateto", $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @23-B21F8ED9
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlcid"] = CCGetFromGet("cid", NULL);
    }
//End Initialize Method

//Validate Method @23-EFCD061E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->cal_userid->Validate() && $Validation);
        $Validation = ($this->cal_type->Validate() && $Validation);
        $Validation = ($this->cal_description->Validate() && $Validation);
        $Validation = ($this->cal_datefrom->Validate() && $Validation);
        $Validation = ($this->cal_dateto->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->cal_userid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cal_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cal_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cal_datefrom->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cal_dateto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-ED647271
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->cal_userid->Errors->Count());
        $errors = ($errors || $this->cal_type->Errors->Count());
        $errors = ($errors || $this->cal_description->Errors->Count());
        $errors = ($errors || $this->cal_datefrom->Errors->Count());
        $errors = ($errors || $this->DatePicker_cal_datefrom->Errors->Count());
        $errors = ($errors || $this->cal_dateto->Errors->Count());
        $errors = ($errors || $this->DatePicker_cal_dateto->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @23-ED598703
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

//Operation Method @23-1907A909
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "new", "cid"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "new"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "cid"));
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

//InsertRow Method @23-ACE7EFCD
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->cal_userid->SetValue($this->cal_userid->GetValue(true));
        $this->DataSource->cal_type->SetValue($this->cal_type->GetValue(true));
        $this->DataSource->cal_description->SetValue($this->cal_description->GetValue(true));
        $this->DataSource->cal_datefrom->SetValue($this->cal_datefrom->GetValue(true));
        $this->DataSource->cal_dateto->SetValue($this->cal_dateto->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-7E26EA49
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->cal_userid->SetValue($this->cal_userid->GetValue(true));
        $this->DataSource->cal_type->SetValue($this->cal_type->GetValue(true));
        $this->DataSource->cal_description->SetValue($this->cal_description->GetValue(true));
        $this->DataSource->cal_datefrom->SetValue($this->cal_datefrom->GetValue(true));
        $this->DataSource->cal_dateto->SetValue($this->cal_dateto->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-9E9A08FE
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

        $this->cal_userid->Prepare();
        $this->cal_type->Prepare();

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
                    $this->cal_userid->SetValue($this->DataSource->cal_userid->GetValue());
                    $this->cal_type->SetValue($this->DataSource->cal_type->GetValue());
                    $this->cal_description->SetValue($this->DataSource->cal_description->GetValue());
                    $this->cal_datefrom->SetValue($this->DataSource->cal_datefrom->GetValue());
                    $this->cal_dateto->SetValue($this->DataSource->cal_dateto->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->cal_userid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cal_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cal_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cal_datefrom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_cal_datefrom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cal_dateto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_cal_dateto->Errors->ToString());
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
        $this->cal_userid->Show();
        $this->cal_type->Show();
        $this->cal_description->Show();
        $this->cal_datefrom->Show();
        $this->DatePicker_cal_datefrom->Show();
        $this->cal_dateto->Show();
        $this->DatePicker_cal_dateto->Show();
        $this->datemodified->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RActivityDetails Class @23-FCB6E20C

class clsRActivityDetailsDataSource extends clsDBSMART {  //RActivityDetailsDataSource Class @23-E335A026

//DataSource Variables @23-72AE63E3
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
    var $cal_userid;
    var $cal_type;
    var $cal_description;
    var $cal_datefrom;
    var $cal_dateto;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-077F1669
    function clsRActivityDetailsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RActivityDetails/Error";
        $this->Initialize();
        $this->cal_userid = new clsField("cal_userid", ccsInteger, "");
        
        $this->cal_type = new clsField("cal_type", ccsText, "");
        
        $this->cal_description = new clsField("cal_description", ccsMemo, "");
        
        $this->cal_datefrom = new clsField("cal_datefrom", ccsDate, $this->DateFormat);
        
        $this->cal_dateto = new clsField("cal_dateto", ccsDate, $this->DateFormat);
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        

        $this->InsertFields["cal_userid"] = array("Name" => "cal_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_type"] = array("Name" => "cal_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_description"] = array("Name" => "cal_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_datefrom"] = array("Name" => "cal_datefrom", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_dateto"] = array("Name" => "cal_dateto", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_userid"] = array("Name" => "cal_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_type"] = array("Name" => "cal_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_description"] = array("Name" => "cal_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_datefrom"] = array("Name" => "cal_datefrom", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_dateto"] = array("Name" => "cal_dateto", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-F9BF7C31
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlcid", ccsInteger, "", "", $this->Parameters["urlcid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-3B5B0C79
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_calendar {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-61C9DF1F
    function SetValues()
    {
        $this->cal_userid->SetDBValue(trim($this->f("cal_userid")));
        $this->cal_type->SetDBValue($this->f("cal_type"));
        $this->cal_description->SetDBValue($this->f("cal_description"));
        $this->cal_datefrom->SetDBValue(trim($this->f("cal_datefrom")));
        $this->cal_dateto->SetDBValue(trim($this->f("cal_dateto")));
        $this->datemodified->SetDBValue($this->f("datemodified"));
    }
//End SetValues Method

//Insert Method @23-276BE3EC
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["cal_userid"]["Value"] = $this->cal_userid->GetDBValue(true);
        $this->InsertFields["cal_type"]["Value"] = $this->cal_type->GetDBValue(true);
        $this->InsertFields["cal_description"]["Value"] = $this->cal_description->GetDBValue(true);
        $this->InsertFields["cal_datefrom"]["Value"] = $this->cal_datefrom->GetDBValue(true);
        $this->InsertFields["cal_dateto"]["Value"] = $this->cal_dateto->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_calendar", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-B01BFCC4
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["cal_userid"]["Value"] = $this->cal_userid->GetDBValue(true);
        $this->UpdateFields["cal_type"]["Value"] = $this->cal_type->GetDBValue(true);
        $this->UpdateFields["cal_description"]["Value"] = $this->cal_description->GetDBValue(true);
        $this->UpdateFields["cal_datefrom"]["Value"] = $this->cal_datefrom->GetDBValue(true);
        $this->UpdateFields["cal_dateto"]["Value"] = $this->cal_dateto->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_calendar", $this->UpdateFields, $this);
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

//Delete Method @23-8E35AEC5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_calendar";
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

} //End RActivityDetailsDataSource Class @23-FCB6E20C

//smart_calendar clsEvent @47-1EB56106
class clsEventsmart_calendar {
    var $_Time;
    var $EventDescription;
    var $_EventDescriptionPage;
    var $_EventDescriptionParameters;

}
//End smart_calendar clsEvent

class clsCalendarsmart_calendar { //smart_calendar Class @47-3EE06387

//smart_calendar Variables @47-E61C7B8A

    var $ComponentType = "Calendar";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $DataSource;
    var $ds;
    var $Type;
    //Calendar variables
    var $CurrentDate;
    var $CurrentProcessingDate;
    var $NextProcessingDate;
    var $PrevProcessingDate;
    var $CalendarStyles = array();
    var $CurrentStyle;
    var $FirstWeekDay;
    var $Now;
    var $IsCurrentMonth;
    var $MonthsInRow;
    var $CCSEvents = array();
    var $CCSEventResult;
    var $Parent;
    var $StartDate;
    var $EndDate;
    var $MonthsCount;
    var $FirstProcessingDate;
    var $LastProcessingDate;
    var $Attributes;
//End smart_calendar Variables

//smart_calendar Class_Initialize Event @47-6A32B5A5
    function clsCalendarsmart_calendar($RelativePath, & $Parent) {
        global $CCSLocales;
        global $DefaultDateFormat;
        global $FileName;
        global $Redirect;
        $this->ComponentName = "smart_calendar";
        $this->Type = "Quarter";
        $this->Visible = True;
        $this->RelativePath = $RelativePath;
        $this->Parent = & $Parent;
        $this->Errors = new clsErrors();
        $CCSForm = CCGetFromGet("ccsForm", "");
        if ($CCSForm == $this->ComponentName) {
            $Redirect = FileName . "?" .  CCGetQueryString("All", array("ccsForm"));
            $this->Visible = false;
            return;
        }
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_calendarDataSource($this);
        $this->ds = & $this->DataSource;
        $this->FirstWeekDay = $CCSLocales->GetFormatInfo("FirstWeekDay");
        $this->MonthsInRow = 3;
        $this->MonthsCount = 3;


        $this->Navigator = & new clsCalendarNavigator($this->ComponentName, "Navigator", $this->Type, 10, $this);
        $this->DayOfWeek = & new clsControl(ccsLabel, "DayOfWeek", "DayOfWeek", ccsDate, array("ddd"), CCGetRequestParam("DayOfWeek", ccsGet, NULL), $this);
        $this->MonthDate = & new clsControl(ccsLabel, "MonthDate", "MonthDate", ccsDate, array("mmmm", ", ", "yyyy"), CCGetRequestParam("MonthDate", ccsGet, NULL), $this);
        $this->DayNumber = & new clsControl(ccsLabel, "DayNumber", "DayNumber", ccsDate, array("d"), CCGetRequestParam("DayNumber", ccsGet, NULL), $this);
        $this->EventDescription = & new clsControl(ccsLink, "EventDescription", "EventDescription", ccsText, "", CCGetRequestParam("EventDescription", ccsGet, NULL), $this);
        $this->EventDescription->Page = "calactivity.php";
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "calactivity.php";
        $this->Now = CCGetDateArray();
        $this->CalendarStyles["WeekdayName"] = "class=\"CalendarWeekdayName\"";
        $this->CalendarStyles["WeekendName"] = "class=\"CalendarWeekendName\"";
        $this->CalendarStyles["Day"] = "class=\"CalendarDay\"";
        $this->CalendarStyles["Weekend"] = "class=\"CalendarWeekend\"";
        $this->CalendarStyles["Today"] = "class=\"CalendarToday\"";
        $this->CalendarStyles["WeekendToday"] = "class=\"CalendarWeekendToday\"";
        $this->CalendarStyles["OtherMonthDay"] = "class=\"CalendarOtherMonthDay\"";
        $this->CalendarStyles["OtherMonthToday"] = "class=\"CalendarOtherMonthToday\"";
        $this->CalendarStyles["OtherMonthWeekend"] = "class=\"CalendarOtherMonthWeekend\"";
        $this->CalendarStyles["OtherMonthWeekendToday"] = "class=\"CalendarOtherMonthWeekendToday\"";
    }
//End smart_calendar Class_Initialize Event

//Initialize Method @47-24A58114
    function Initialize()
    {
        if(!$this->Visible) return;
        $this->DataSource->SetOrder("", "");
        $this->CurrentDate = $this->Now;
        if ($FullDate = CCGetFromGet($this->ComponentName . "Date", "")) {
            @list($year,$month) = split("-", $FullDate, 2);
        } else {
            $year = CCGetFromGet($this->ComponentName . "Year", "");
            $month = CCGetFromGet($this->ComponentName . "Month", "");
        }
        if (is_numeric($year) &&  $year >=101 && $year <=9999)
            $this->CurrentDate[ccsYear] = $year;
        if (is_numeric($month) &&  $month >=1 && $month <=12)
            $this->CurrentDate[ccsMonth] = $month;
        $this->CurrentDate[ccsDay] = 1;
        $this->CalculateCalendarPeriod();
    }
//End Initialize Method

//Show Method @47-DE424A1D
    function Show () {
        global $Tpl;
        global $CCSLocales;
        global $DefaultDateFormat;
        if(!$this->Visible) return;

        $this->CalculateCalendarPeriod();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->DataSource->Prepare();
        $this->DataSource->Open();

        while ($this->DataSource->next_record()) {
            $DateField = CCParseDate($this->DataSource->f("cal_datefrom"), $this->DataSource->DateFormat);
            if (!is_array($DateField)) continue;
            if (CCCompareValues($DateField, $this->StartDate, ccsDate) >= 0 && CCCompareValues($DateField, $this->EndDate , ccsDate) <= 0) {
                $this->DataSource->SetValues();
                $Event = new clsEventsmart_calendar();
                $Event->_Time = $DateField;
                $this->EventDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->EventDescription->Parameters = CCAddParam($this->EventDescription->Parameters, "cid", $this->DataSource->f("id"));
                $Event->EventDescription = $this->DataSource->EventDescription->GetValue();
                $Event->_EventDescriptionPage = $this->EventDescription->Page;
                $Event->_EventDescriptionParameters = $this->EventDescription->Parameters;
                $Event->Attributes = $this->Attributes->GetAsArray();
                $datestr = CCFormatDate($DateField, array("yyyy","mm","dd"));
                if(!isset($this->Events[$datestr])) $this->Events[$datestr] = array();
                $this->Events[$datestr][] = $Event;
            }
        }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;
        $this->Attributes->Show();

        $CalendarBlock = "Calendar " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
        $this->Errors->AddErrors($this->DataSource->Errors);
        if($this->Errors->Count()) {
            $Tpl->replaceblock("", $this->Errors->ToString());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $month = 0;
            $this->CurrentProcessingDate = $this->FirstProcessingDate;
            $this->NextProcessingDate = CCDateAdd($this->CurrentProcessingDate, "1month");
            $this->PrevProcessingDate = CCDateAdd($this->CurrentProcessingDate, "-1month");
            $Tpl->block_path = $ParentPath . "/" . $CalendarBlock . "/Month";
            $Weeks = $this->CalculateWeeksInCurrentRow($this->CurrentProcessingDate, $this->LastProcessingDate);
            while ($this->MonthsCount > $month++) {
                $this->ShowMonth($Weeks);
                if(($this->MonthsCount != $month) && ($month % $this->MonthsInRow == 0)) {
                    $this->Attributes->Show();
                    $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
                    $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
                    $Tpl->ParseTo("MonthsRowSeparator", true, "Month");
                    $Tpl->block_path = $ParentPath . "/" . $CalendarBlock . "/Month";
                    $Weeks = $this->CalculateWeeksInCurrentRow($this->NextProcessingDate, $this->LastProcessingDate);
                }
                $Tpl->SetBlockVar("Week", "");
                $Tpl->SetBlockVar("Week/Day", "");
                $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1month"));
            }
            $this->CurrentProcessingDate = $this->FirstProcessingDate;
            $this->PrevProcessingDate = CCDateAdd($this->CurrentProcessingDate, "-3month");
            $this->NextProcessingDate = CCDateAdd($this->CurrentProcessingDate, "+3month");
            $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
            $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
            $this->Navigator->CurrentDate = $this->CurrentDate;
            $this->Navigator->PrevProcessingDate = $this->PrevProcessingDate;
            $this->Navigator->NextProcessingDate = $this->NextProcessingDate;
            $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "new", 1);
            $this->Navigator->Show();
            $this->ImageLink1->Show();
            $Tpl->Parse();
        }
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

//smart_calendar ShowMonth Method @47-79A92CA3
    function ShowMonth ($Weeks) {
        global $Tpl;
        global $CCSLocales;
        global $DefaultDateFormat;
        $ParentPath = $Tpl->block_path;
        $OldCurrentProcessingDate = $this->CurrentProcessingDate;
        $OldNextProcessingDate = $this->NextProcessingDate;
        $OldPrevProcessingDate = $this->PrevProcessingDate;
        $FirstMonthDate = CCParseDate(CCFormatDate($this->CurrentProcessingDate, array("yyyy", "-", "mm","-01 00:00:00")), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $LastMonthDate = CCDateAdd($FirstMonthDate, "+1month -1second");
        $Days = (CCFormatDate($FirstMonthDate, array("w")) - $this->FirstWeekDay + 6) % 7;
        $FirstShowedDate = CCDateAdd($FirstMonthDate, "-" . $Days . "day");
        $Days = $Weeks * 7;
        $this->CurrentProcessingDate =  $FirstShowedDate;
        $this->PrevProcessingDate =  CCDateAdd($FirstShowedDate, "-1day");
        $this->NextProcessingDate =  CCDateAdd($FirstShowedDate, "+1day");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowMonth", $this);
        $this->Attributes->Show();
        $ShowedDays = 0;
        $WeekDay = CCFormatDate($this->CurrentProcessingDate, array("w"));
        while($ShowedDays < $Days) {
            if ($ShowedDays && $ShowedDays % 7 == 0){
                $Tpl->block_path = $ParentPath . "/WeekSeparator";
                $this->Attributes->Show();
                $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
                $Tpl->block_path = $ParentPath;
                $Tpl->ParseTo("WeekSeparator", true, "Week");
            }
            if ($ShowedDays % 7 == 0) {
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowWeek", $this);
                $this->Attributes->Show();
            }
            $this->IsCurrentMonth = $this->CurrentProcessingDate[ccsMonth] == $OldCurrentProcessingDate[ccsMonth];
            $this->SetCurrentStyle("Day", $WeekDay);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowDay", $this);
            $this->Attributes->Show();
            if ($this->IsCurrentMonth) {
                $datestr = CCFormatDate($this->CurrentProcessingDate, array("yyyy","mm","dd"));
                $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
                $Tpl->SetBlockVar("", "");
                if (isset($this->Events[$datestr])) {
                    uasort($this->Events[$datestr], array($this, "CompareEventTime"));
                    foreach ($this->Events[$datestr] as $key=>$event) {
                        $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
                        $this->Attributes->AddFromArray($this->Events[$datestr][$key]->Attributes);
                        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowEvent", $this);
                        $this->EventDescription->Page = $event->_EventDescriptionPage;
                        $this->EventDescription->Parameters = $event->_EventDescriptionParameters;
                        $this->EventDescription->SetValue($event->EventDescription);
                        $this->EventDescription->Show();
                        $this->Attributes->Show();
                        $Tpl->Parse("", true);
                    }
                } else {
                }
                $Tpl->block_path = $ParentPath . "/Week/Day";
                $this->DayNumber->SetValue($this->CurrentProcessingDate);
                $this->DayNumber->Show();
                $this->Attributes->Show();
                $Tpl->SetVar("Style", $this->CurrentStyle);
                $Tpl->Parse("", true);
            } else {
                $Tpl->block_path = $ParentPath . "/Week/EmptyDay";
                $this->Attributes->Show();
                $Tpl->block_path = $ParentPath . "/Week";
                $Tpl->SetVar("Style", $this->CurrentStyle);
                $Tpl->ParseTo("EmptyDay", true, "Day");
            }
            $ShowedDays++;
            if ($ShowedDays and $ShowedDays % 7 == 0) {
                $Tpl->block_path = $ParentPath . "/Week";
                $this->Attributes->Show();
                $Tpl->Parse("", true);
                $Tpl->SetBlockVar("Day", "");
            }
            $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1day"));
            $WeekDay = $WeekDay == 7 ? 1 : $WeekDay + 1;
        }
        $Tpl->block_path = $ParentPath . "/WeekDays";
        $Tpl->SetBlockVar("","");
        $WeekDay = CCFormatDate($this->CurrentProcessingDate, array("w"));
        $ShowedDays = 0;
        $this->CurrentProcessingDate =  $FirstShowedDate;
        $this->PrevProcessingDate =  CCDateAdd($FirstShowedDate, "-1day");
        $this->NextProcessingDate =  CCDateAdd($FirstShowedDate, "+1day");
        while($ShowedDays < 7) {
            $this->Attributes->Show();
            $this->DayOfWeek->SetValue($this->CurrentProcessingDate);
            $this->DayOfWeek->Show();
            $this->SetCurrentStyle("WeekDay", $WeekDay);
            $Tpl->SetVar("Style", $this->CurrentStyle);
            $Tpl->Parse("", true);
            $WeekDay = $WeekDay == 7 ? 1 : $WeekDay + 1;
            $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1day"));
            $ShowedDays++;
        }
        $Tpl->block_path = $ParentPath;
        $this->CurrentProcessingDate = $OldCurrentProcessingDate;
        $this->NextProcessingDate = $OldNextProcessingDate;
        $this->PrevProcessingDate = $OldPrevProcessingDate;
        $this->MonthDate->SetValue($this->CurrentProcessingDate);
        $this->MonthDate->Show();
        $Tpl->Parse("", true);
        $Tpl->block_path = $ParentPath;
    }
//End smart_calendar ShowMonth Method

//smart_calendar ProcessNextDate Method @47-67D24A68
    function ProcessNextDate($NewDate) {
        $this->PrevProcessingDate = $this->CurrentProcessingDate;
        $this->CurrentProcessingDate = $this->NextProcessingDate;
        $this->NextProcessingDate = $NewDate;
    }
//End smart_calendar ProcessNextDate Method

//smart_calendar CalculateCalendarPeriod Method @47-7CC4B21F
    function CalculateCalendarPeriod() {
        $Quarter = CCFormatDate($this->CurrentDate, array('q'));
        $this->FirstProcessingDate = CCParseDate(CCFormatDate($this->CurrentDate, array("yyyy","-", ($Quarter - 1) * 3 + 1,"-01 00:00:00")), array("yyyy", "-", "m", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $Days = (CCFormatDate($this->FirstProcessingDate, array("w")) - $this->FirstWeekDay + 6) % 7;
        $this->StartDate = CCDateAdd($this->FirstProcessingDate, "-" . $Days . "day");
        $this->LastProcessingDate = CCDateAdd($this->FirstProcessingDate, "3month -1second");
        $Days = ($this->FirstWeekDay - CCFormatDate($this->LastProcessingDate, array("w")) + 7) % 7;
        $this->EndDate = CCDateAdd($this->LastProcessingDate, $Days . "day");
        $LastRowStartMonth = CCDateAdd($this->FirstProcessingDate, "+" . ($this->MonthsCount - $this->MonthsInRow) . "months");
        $Weeks = $this->CalculateWeeksInCurrentRow($LastRowStartMonth, $this->LastProcessingDate);
        $LastMonthStart = CCDateAdd($this->FirstProcessingDate, "+" . ($this->MonthsCount - 1) . "months");
        $Days = (CCFormatDate($LastMonthStart, array("w")) - $this->FirstWeekDay + 6) % 7;
        $LastMonthStart = CCDateAdd($LastMonthStart, "-" . $Days . "day");
        $this->EndDate = CCDateAdd($LastMonthStart, $Weeks . "week -1second");
    }
//End smart_calendar CalculateCalendarPeriod Method

//smart_calendar SetCurrentStyle Method @47-1162C70C
    function SetCurrentStyle ($scope, $weekday="") {
        $Result="";
        switch ($scope) {
            case "WeekDay":
                if ($weekday == 1 || $weekday == 7)
                    $Result = "WeekendName";
                else
                    $Result = "WeekdayName";
                break;
            case "Day":
                $IsWeekend = $weekday == 1 || $weekday == 7;
                if (!$this->IsCurrentMonth) {
                    $Result = "OtherMonth" . ($IsWeekend ? "Weekend" : "Day");
                } else {
                    $IsCurrentDay = $this->CurrentProcessingDate[ccsYear] == $this->Now[ccsYear] &&
                        $this->CurrentProcessingDate[ccsMonth] == $this->Now[ccsMonth] &&
                        $this->CurrentProcessingDate[ccsDay] == $this->Now[ccsDay];
                    if($IsCurrentDay)
                        $Result = "Today";
                    if($IsWeekend) 
                        $Result = "Weekend" . $Result;
                    elseif (!$Result) 
                        $Result = "Day";
                }
                break;
        }
        $this->CurrentStyle = isset($this->CalendarStyles[$Result]) ? $this->CalendarStyles[$Result] : "";
    }
//End smart_calendar SetCurrentStyle Method

//smart_calendar CompareEventTime Method @47-7AF1414A
    function CompareEventTime($val1, $val2) {
        $time1 = is_a($val1, "clsEventsmart_calendar") && is_array($val1->_Time) ? $val1->_Time[ccsHour] * 3600 + $val1->_Time[ccsMinute] * 60 + $val1->_Time[ccsSecond] : 0;
        $time2 = is_a($val2, "clsEventsmart_calendar") && is_array($val2->_Time) ? $val2->_Time[ccsHour] * 3600 + $val2->_Time[ccsMinute] * 60 + $val2->_Time[ccsSecond] : 0;
        if ($time1 == $time2)
            return 0;
        return $time1 > $time2 ? 1 : -1;
    }
//End smart_calendar CompareEventTime Method

//smart_calendar CalculateWeeksInCurrentRow @47-8D4D491A
    function CalculateWeeksInCurrentRow($CurrentMonth, $LastProcessingDate ) {
        $Month = 1;
        $CurrentMonth = CCParseDate(CCFormatDate($CurrentMonth, array("yyyy", "-", "mm","-01 00:00:00")), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $MaxWeeks = 0;
        while ($Month <= $this->MonthsInRow && CCCompareValues($CurrentMonth, $LastProcessingDate, ccsDate) <= 0) {
            $FirstMonthDate = $CurrentMonth;
            $LastMonthDate = CCDateAdd($FirstMonthDate, "+1month -1second");
            $Days = (CCFormatDate($FirstMonthDate, array("w")) - $this->FirstWeekDay + 6) % 7;
            $FirstShowedDate = CCDateAdd($FirstMonthDate, "-" . $Days . "day");
            $Days += $LastMonthDate[ccsDay];
            $Days += ($this->FirstWeekDay  - CCFormatDate($LastMonthDate, array("w")) + 7) % 7;
            $Weeks = $Days / 7;
            $MaxWeeks = max($MaxWeeks, $Weeks);
            $CurrentMonth = CCDateAdd($CurrentMonth, "1month");
            $Month++;
        }
        return $MaxWeeks;
    }
//End smart_calendar CalculateWeeksInCurrentRow

} //End smart_calendar Class @47-FCB6E20C

class clssmart_calendarDataSource extends clsDBSMART {  //smart_calendarDataSource Class @47-2432BA35

//DataSource Variables @47-88491B03
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $EventDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @47-171DC508
    function clssmart_calendarDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "";
        $this->Initialize();
        $this->EventDescription = new clsField("EventDescription", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @47-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @47-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @47-A69B7DFE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_calendar {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @47-13B6E0FA
    function SetValues()
    {
        $this->EventDescription->SetDBValue($this->f("cal_description"));
    }
//End SetValues Method

} //End smart_calendarDataSource Class @47-FCB6E20C

//Initialize Page @1-068B7025
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
$TemplateFileName = "calactivity.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3873BC45
include_once("./calactivity_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F07101CE
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$RActivityDetails = & new clsRecordRActivityDetails("", $MainPage);
$smart_calendar = & new clsCalendarsmart_calendar("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->RActivityDetails = & $RActivityDetails;
$MainPage->smart_calendar = & $smart_calendar;
$RActivityDetails->Initialize();
$smart_calendar->Initialize();

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

//Execute Components @1-CE1E5AEB
$header->Operations();
$footer->Operations();
$RActivityDetails->Operation();
//End Execute Components

//Go to destination page @1-8A5956B2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($RActivityDetails);
    unset($smart_calendar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BE786334
$header->Show();
$footer->Show();
$RActivityDetails->Show();
$smart_calendar->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D5F47C65
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($RActivityDetails);
unset($smart_calendar);
unset($Tpl);
//End Unload Page


?>
