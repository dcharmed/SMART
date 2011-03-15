<?php
//Include Common Files @1-51CEE8F2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "popRNfaultyequipment.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordsmart_faultyequipment { //smart_faultyequipment Class @5-FBE3764F

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

//Class_Initialize Event @5-61376127
    function clsRecordsmart_faultyequipment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_faultyequipment/Error";
        $this->DataSource = new clssmart_faultyequipmentDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_faultyequipment";
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
            $this->flty_date = & new clsControl(ccsTextBox, "flty_date", "Flty Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("flty_date", $Method, NULL), $this);
            $this->DatePicker_flty_date = & new clsDatePicker("DatePicker_flty_date", "smart_faultyequipment", "flty_date", $this);
            $this->flty_byuser = & new clsControl(ccsListBox, "flty_byuser", "Flty Byuser", ccsInteger, "", CCGetRequestParam("flty_byuser", $Method, NULL), $this);
            $this->flty_byuser->DSType = dsTable;
            $this->flty_byuser->DataSource = new clsDBSMART();
            $this->flty_byuser->ds = & $this->flty_byuser->DataSource;
            $this->flty_byuser->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->flty_byuser->BoundColumn, $this->flty_byuser->TextColumn, $this->flty_byuser->DBFormat) = array("id", "usr_fullname", "");
            $this->flty_byuser->DataSource->Parameters["expr13"] = 4;
            $this->flty_byuser->DataSource->wp = new clsSQLParameters();
            $this->flty_byuser->DataSource->wp->AddParameter("1", "expr13", ccsInteger, "", "", $this->flty_byuser->DataSource->Parameters["expr13"], "", false);
            $this->flty_byuser->DataSource->wp->Criterion[1] = $this->flty_byuser->DataSource->wp->Operation(opLessThanOrEqual, "usr_group", $this->flty_byuser->DataSource->wp->GetDBValue("1"), $this->flty_byuser->DataSource->ToSQL($this->flty_byuser->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->flty_byuser->DataSource->Where = 
                 $this->flty_byuser->DataSource->wp->Criterion[1];
            $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsInteger, "", CCGetRequestParam("resolution_id", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->eqpmt_serialnumber = & new clsControl(ccsTextBox, "eqpmt_serialnumber", "eqpmt_serialnumber", ccsText, "", CCGetRequestParam("eqpmt_serialnumber", $Method, NULL), $this);
            $this->eqpmt_name = & new clsControl(ccsListBox, "eqpmt_name", "eqpmt_name", ccsText, "", CCGetRequestParam("eqpmt_name", $Method, NULL), $this);
            $this->eqpmt_name->DSType = dsTable;
            $this->eqpmt_name->DataSource = new clsDBSMART();
            $this->eqpmt_name->ds = & $this->eqpmt_name->DataSource;
            $this->eqpmt_name->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->eqpmt_name->BoundColumn, $this->eqpmt_name->TextColumn, $this->eqpmt_name->DBFormat) = array("id", "eqpmt_name", "");
        }
    }
//End Class_Initialize Event

//Initialize Method @5-CE188E9B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
        $this->DataSource->Parameters["urlqpid"] = CCGetFromGet("qpid", NULL);
    }
//End Initialize Method

//Validate Method @5-E3AC11A5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->flty_date->Validate() && $Validation);
        $Validation = ($this->flty_byuser->Validate() && $Validation);
        $Validation = ($this->resolution_id->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->eqpmt_serialnumber->Validate() && $Validation);
        $Validation = ($this->eqpmt_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->flty_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->flty_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resolution_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eqpmt_serialnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eqpmt_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-67F816A5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->flty_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_flty_date->Errors->Count());
        $errors = ($errors || $this->flty_byuser->Errors->Count());
        $errors = ($errors || $this->resolution_id->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->eqpmt_serialnumber->Errors->Count());
        $errors = ($errors || $this->eqpmt_name->Errors->Count());
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

//Operation Method @5-0BF2B389
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

//InsertRow Method @5-82BB1325
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->flty_date->SetValue($this->flty_date->GetValue(true));
        $this->DataSource->flty_byuser->SetValue($this->flty_byuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->eqpmt_serialnumber->SetValue($this->eqpmt_serialnumber->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @5-410AED9B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->flty_date->SetValue($this->flty_date->GetValue(true));
        $this->DataSource->flty_byuser->SetValue($this->flty_byuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->eqpmt_serialnumber->SetValue($this->eqpmt_serialnumber->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @5-951A90D4
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

        $this->flty_byuser->Prepare();
        $this->eqpmt_name->Prepare();

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
                    $this->flty_date->SetValue($this->DataSource->flty_date->GetValue());
                    $this->flty_byuser->SetValue($this->DataSource->flty_byuser->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->eqpmt_serialnumber->SetValue($this->DataSource->eqpmt_serialnumber->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->flty_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_flty_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->flty_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resolution_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eqpmt_serialnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eqpmt_name->Errors->ToString());
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
        $this->flty_date->Show();
        $this->DatePicker_flty_date->Show();
        $this->flty_byuser->Show();
        $this->resolution_id->Show();
        $this->datemodified->Show();
        $this->eqpmt_serialnumber->Show();
        $this->eqpmt_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_faultyequipment Class @5-FCB6E20C

class clssmart_faultyequipmentDataSource extends clsDBSMART {  //smart_faultyequipmentDataSource Class @5-30229D9D

//DataSource Variables @5-AE5E78D3
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
    var $flty_date;
    var $flty_byuser;
    var $resolution_id;
    var $datemodified;
    var $eqpmt_serialnumber;
    var $eqpmt_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-547FC3A0
    function clssmart_faultyequipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_faultyequipment/Error";
        $this->Initialize();
        $this->flty_date = new clsField("flty_date", ccsDate, $this->DateFormat);
        
        $this->flty_byuser = new clsField("flty_byuser", ccsInteger, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->eqpmt_serialnumber = new clsField("eqpmt_serialnumber", ccsText, "");
        
        $this->eqpmt_name = new clsField("eqpmt_name", ccsText, "");
        

        $this->InsertFields["flty_date"] = array("Name" => "flty_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["flty_byuser"] = array("Name" => "flty_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_date"] = array("Name" => "flty_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_byuser"] = array("Name" => "flty_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @5-9D874FDF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->AddParameter("2", "urlqpid", ccsInteger, "", "", $this->Parameters["urlqpid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-3CFEAF84
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_faultyequipment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-AEF0C57A
    function SetValues()
    {
        $this->flty_date->SetDBValue(trim($this->f("flty_date")));
        $this->flty_byuser->SetDBValue(trim($this->f("flty_byuser")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->eqpmt_serialnumber->SetDBValue($this->f("flty_serialnumber"));
    }
//End SetValues Method

//Insert Method @5-F126C3C3
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["flty_date"]["Value"] = $this->flty_date->GetDBValue(true);
        $this->InsertFields["flty_byuser"]["Value"] = $this->flty_byuser->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["flty_serialnumber"]["Value"] = $this->eqpmt_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_faultyequipment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-FFE8130D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["flty_date"]["Value"] = $this->flty_date->GetDBValue(true);
        $this->UpdateFields["flty_byuser"]["Value"] = $this->flty_byuser->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["flty_serialnumber"]["Value"] = $this->eqpmt_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_faultyequipment", $this->UpdateFields, $this);
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

} //End smart_faultyequipmentDataSource Class @5-FCB6E20C

//Initialize Page @1-90684CE1
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
$TemplateFileName = "popRNfaultyequipment.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3CF53B23
include_once("./popRNfaultyequipment_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1D6F64D4
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_faultyequipment = & new clsRecordsmart_faultyequipment("", $MainPage);
$MainPage->smart_faultyequipment = & $smart_faultyequipment;
$smart_faultyequipment->Initialize();

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

//Execute Components @1-67709C5B
$smart_faultyequipment->Operation();
//End Execute Components

//Go to destination page @1-335EDD7E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_faultyequipment);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-77EDACC4
$smart_faultyequipment->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-98D51923
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_faultyequipment);
unset($Tpl);
//End Unload Page


?>
