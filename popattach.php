<?php
//Include Common Files @1-BC4F1E90
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "popattach.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsRecordRAttachment { //RAttachment Class @5-AFD419B8

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

//Class_Initialize Event @5-4A9A8E56
    function clsRecordRAttachment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RAttachment/Error";
        $this->DataSource = new clsRAttachmentDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RAttachment";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->attch_byuser = & new clsControl(ccsHidden, "attch_byuser", "Attch Byuser", ccsInteger, "", CCGetRequestParam("attch_byuser", $Method, NULL), $this);
            $this->attch_name = & new clsControl(ccsTextBox, "attch_name", "Title", ccsText, "", CCGetRequestParam("attch_name", $Method, NULL), $this);
            $this->attch_name->Required = true;
            $this->attch_date = & new clsControl(ccsTextBox, "attch_date", "Attch Date", ccsDate, array("GeneralDate"), CCGetRequestParam("attch_date", $Method, NULL), $this);
            $this->attch_date->Required = true;
            $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsInteger, "", CCGetRequestParam("resolution_id", $Method, NULL), $this);
            $this->byuser_toshow = & new clsControl(ccsTextBox, "byuser_toshow", "byuser_toshow", ccsText, "", CCGetRequestParam("byuser_toshow", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, array("GeneralDate"), CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->DatePicker_attch_date1 = & new clsDatePicker("DatePicker_attch_date1", "RAttachment", "attch_date", $this);
            $this->FileUpload1 = & new clsFileUpload("FileUpload1", "Attachments", "temp/", "attachments/", "*.pdf;*.jpg;*.gif", "", 2097152, $this);
            $this->FileUpload1->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->attch_date->Value) && !strlen($this->attch_date->Value) && $this->attch_date->Value !== false)
                    $this->attch_date->SetValue(time());
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

//Validate Method @5-6EAEF345
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->attch_byuser->Validate() && $Validation);
        $Validation = ($this->attch_name->Validate() && $Validation);
        $Validation = ($this->attch_date->Validate() && $Validation);
        $Validation = ($this->resolution_id->Validate() && $Validation);
        $Validation = ($this->byuser_toshow->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->attch_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->attch_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->attch_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resolution_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->byuser_toshow->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-BF86C660
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->attch_byuser->Errors->Count());
        $errors = ($errors || $this->attch_name->Errors->Count());
        $errors = ($errors || $this->attch_date->Errors->Count());
        $errors = ($errors || $this->resolution_id->Errors->Count());
        $errors = ($errors || $this->byuser_toshow->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->DatePicker_attch_date1->Errors->Count());
        $errors = ($errors || $this->FileUpload1->Errors->Count());
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

//Operation Method @5-12FBDA5B
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

        $this->FileUpload1->Upload();

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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "att"));
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

//InsertRow Method @5-847C1641
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->attch_byuser->SetValue($this->attch_byuser->GetValue(true));
        $this->DataSource->attch_name->SetValue($this->attch_name->GetValue(true));
        $this->DataSource->attch_date->SetValue($this->attch_date->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->byuser_toshow->SetValue($this->byuser_toshow->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @5-633C29B4
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->attch_byuser->SetValue($this->attch_byuser->GetValue(true));
        $this->DataSource->attch_name->SetValue($this->attch_name->GetValue(true));
        $this->DataSource->attch_date->SetValue($this->attch_date->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->byuser_toshow->SetValue($this->byuser_toshow->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @5-2B077D44
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @5-6E507792
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
                    $this->attch_byuser->SetValue($this->DataSource->attch_byuser->GetValue());
                    $this->attch_name->SetValue($this->DataSource->attch_name->GetValue());
                    $this->attch_date->SetValue($this->DataSource->attch_date->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->FileUpload1->SetValue($this->DataSource->FileUpload1->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->attch_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->attch_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->attch_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resolution_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->byuser_toshow->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_attch_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload1->Errors->ToString());
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
        $this->attch_byuser->Show();
        $this->attch_name->Show();
        $this->attch_date->Show();
        $this->resolution_id->Show();
        $this->byuser_toshow->Show();
        $this->datemodified->Show();
        $this->DatePicker_attch_date1->Show();
        $this->FileUpload1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RAttachment Class @5-FCB6E20C

class clsRAttachmentDataSource extends clsDBSMART {  //RAttachmentDataSource Class @5-3B18268F

//DataSource Variables @5-D1E6A1DD
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
    var $attch_byuser;
    var $attch_name;
    var $attch_date;
    var $resolution_id;
    var $byuser_toshow;
    var $datemodified;
    var $FileUpload1;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-589CFF86
    function clsRAttachmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RAttachment/Error";
        $this->Initialize();
        $this->attch_byuser = new clsField("attch_byuser", ccsInteger, "");
        
        $this->attch_name = new clsField("attch_name", ccsText, "");
        
        $this->attch_date = new clsField("attch_date", ccsDate, $this->DateFormat);
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->byuser_toshow = new clsField("byuser_toshow", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        

        $this->InsertFields["attch_byuser"] = array("Name" => "attch_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_name"] = array("Name" => "attch_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_date"] = array("Name" => "attch_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_sourcefile"] = array("Name" => "attch_sourcefile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_byuser"] = array("Name" => "attch_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_name"] = array("Name" => "attch_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_date"] = array("Name" => "attch_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_sourcefile"] = array("Name" => "attch_sourcefile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @5-CEDD0EEC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_attachment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-069C0686
    function SetValues()
    {
        $this->attch_byuser->SetDBValue(trim($this->f("attch_byuser")));
        $this->attch_name->SetDBValue($this->f("attch_name"));
        $this->attch_date->SetDBValue(trim($this->f("attch_date")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->FileUpload1->SetDBValue($this->f("attch_sourcefile"));
    }
//End SetValues Method

//Insert Method @5-E1914E11
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["attch_byuser"]["Value"] = $this->attch_byuser->GetDBValue(true);
        $this->InsertFields["attch_name"]["Value"] = $this->attch_name->GetDBValue(true);
        $this->InsertFields["attch_date"]["Value"] = $this->attch_date->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["attch_sourcefile"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_attachment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-8075729B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["attch_byuser"]["Value"] = $this->attch_byuser->GetDBValue(true);
        $this->UpdateFields["attch_name"]["Value"] = $this->attch_name->GetDBValue(true);
        $this->UpdateFields["attch_date"]["Value"] = $this->attch_date->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["attch_sourcefile"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_attachment", $this->UpdateFields, $this);
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

//Delete Method @5-E0623529
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_attachment";
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

} //End RAttachmentDataSource Class @5-FCB6E20C

//Initialize Page @1-3957F083
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
$TemplateFileName = "popattach.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-75E498DA
include_once("./popattach_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C89E0E5B
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$RAttachment = & new clsRecordRAttachment("", $MainPage);
$MainPage->footer = & $footer;
$MainPage->RAttachment = & $RAttachment;
$RAttachment->Initialize();

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

//Execute Components @1-87F7349B
$footer->Operations();
$RAttachment->Operation();
//End Execute Components

//Go to destination page @1-5C110055
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $footer->Class_Terminate();
    unset($footer);
    unset($RAttachment);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BEDD578A
$footer->Show();
$RAttachment->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-60C3EA70
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$footer->Class_Terminate();
unset($footer);
unset($RAttachment);
unset($Tpl);
//End Unload Page


?>
