<?php
//Include Common Files @1-BABA9472
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "myaccount.php");
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

class clsRecordsmart_user { //smart_user Class @5-FB037EE8

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

//Class_Initialize Event @5-7794185D
    function clsRecordsmart_user($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_user/Error";
        $this->DataSource = new clssmart_userDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_user";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->usr_username = & new clsControl(ccsLabel, "usr_username", "Usr Username", ccsText, "", CCGetRequestParam("usr_username", $Method, NULL), $this);
            $this->usr_username->HTML = true;
            $this->usr_vpassword = & new clsControl(ccsTextBox, "usr_vpassword", "Verify Password", ccsText, "", CCGetRequestParam("usr_vpassword", $Method, NULL), $this);
            $this->usr_group = & new clsControl(ccsLabel, "usr_group", "Usr Group", ccsInteger, "", CCGetRequestParam("usr_group", $Method, NULL), $this);
            $this->usr_email = & new clsControl(ccsTextBox, "usr_email", "Usr Email", ccsText, "", CCGetRequestParam("usr_email", $Method, NULL), $this);
            $this->usr_email->Required = true;
            $this->usr_fullname = & new clsControl(ccsTextBox, "usr_fullname", "Usr Fullname", ccsText, "", CCGetRequestParam("usr_fullname", $Method, NULL), $this);
            $this->usr_fullname->Required = true;
            $this->usr_staffid = & new clsControl(ccsTextBox, "usr_staffid", "Usr Staffid", ccsText, "", CCGetRequestParam("usr_staffid", $Method, NULL), $this);
            $this->usr_staffid->Required = true;
            $this->usr_post = & new clsControl(ccsListBox, "usr_post", "Usr Post", ccsText, "", CCGetRequestParam("usr_post", $Method, NULL), $this);
            $this->usr_post->DSType = dsTable;
            $this->usr_post->DataSource = new clsDBSMART();
            $this->usr_post->ds = & $this->usr_post->DataSource;
            $this->usr_post->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->usr_post->BoundColumn, $this->usr_post->TextColumn, $this->usr_post->DBFormat) = array("ref_value", "ref_description", "");
            $this->usr_post->DataSource->Parameters["expr34"] = userpost;
            $this->usr_post->DataSource->wp = new clsSQLParameters();
            $this->usr_post->DataSource->wp->AddParameter("1", "expr34", ccsText, "", "", $this->usr_post->DataSource->Parameters["expr34"], "", false);
            $this->usr_post->DataSource->wp->Criterion[1] = $this->usr_post->DataSource->wp->Operation(opEqual, "ref_type", $this->usr_post->DataSource->wp->GetDBValue("1"), $this->usr_post->DataSource->ToSQL($this->usr_post->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->usr_post->DataSource->Where = 
                 $this->usr_post->DataSource->wp->Criterion[1];
            $this->usr_address = & new clsControl(ccsTextArea, "usr_address", "Usr Address", ccsMemo, "", CCGetRequestParam("usr_address", $Method, NULL), $this);
            $this->usr_gender = & new clsControl(ccsRadioButton, "usr_gender", "Usr Gender", ccsText, "", CCGetRequestParam("usr_gender", $Method, NULL), $this);
            $this->usr_gender->DSType = dsListOfValues;
            $this->usr_gender->Values = array(array("M", "Male"), array("F", "Female"));
            $this->usr_gender->HTML = true;
            $this->usr_password = & new clsControl(ccsTextBox, "usr_password", "Password", ccsText, "", CCGetRequestParam("usr_password", $Method, NULL), $this);
            $this->Password = & new clsControl(ccsHidden, "Password", "Password", ccsText, "", CCGetRequestParam("Password", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "datemodified", ccsText, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->usr_dateofbirth = & new clsControl(ccsTextBox, "usr_dateofbirth", "Date Of Birth", ccsDate, array("ShortDate"), CCGetRequestParam("usr_dateofbirth", $Method, NULL), $this);
            $this->DatePicker_usr_dateofbirth = & new clsDatePicker("DatePicker_usr_dateofbirth", "smart_user", "usr_dateofbirth", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->usr_dateofbirth->Value) && !strlen($this->usr_dateofbirth->Value) && $this->usr_dateofbirth->Value !== false)
                    $this->usr_dateofbirth->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @5-052CBF13
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urluid"] = CCGetFromGet("uid", NULL);
    }
//End Initialize Method

//Validate Method @5-554970FB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->usr_email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->usr_email->GetText())) {
            $this->usr_email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Usr Email"));
        }
        $Validation = ($this->usr_vpassword->Validate() && $Validation);
        $Validation = ($this->usr_email->Validate() && $Validation);
        $Validation = ($this->usr_fullname->Validate() && $Validation);
        $Validation = ($this->usr_staffid->Validate() && $Validation);
        $Validation = ($this->usr_post->Validate() && $Validation);
        $Validation = ($this->usr_address->Validate() && $Validation);
        $Validation = ($this->usr_gender->Validate() && $Validation);
        $Validation = ($this->usr_password->Validate() && $Validation);
        $Validation = ($this->Password->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->usr_dateofbirth->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->usr_vpassword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_fullname->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_staffid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_post->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_gender->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_password->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Password->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_dateofbirth->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-578AE1C9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->usr_username->Errors->Count());
        $errors = ($errors || $this->usr_vpassword->Errors->Count());
        $errors = ($errors || $this->usr_group->Errors->Count());
        $errors = ($errors || $this->usr_email->Errors->Count());
        $errors = ($errors || $this->usr_fullname->Errors->Count());
        $errors = ($errors || $this->usr_staffid->Errors->Count());
        $errors = ($errors || $this->usr_post->Errors->Count());
        $errors = ($errors || $this->usr_address->Errors->Count());
        $errors = ($errors || $this->usr_gender->Errors->Count());
        $errors = ($errors || $this->usr_password->Errors->Count());
        $errors = ($errors || $this->Password->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->usr_dateofbirth->Errors->Count());
        $errors = ($errors || $this->DatePicker_usr_dateofbirth->Errors->Count());
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

//Operation Method @5-5B06BA55
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Cancel";
            if($this->Button_Update->Pressed) {
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
            if($this->PressedButton == "Button_Update") {
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

//UpdateRow Method @5-90371A78
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->usr_username->SetValue($this->usr_username->GetValue(true));
        $this->DataSource->usr_vpassword->SetValue($this->usr_vpassword->GetValue(true));
        $this->DataSource->usr_group->SetValue($this->usr_group->GetValue(true));
        $this->DataSource->usr_email->SetValue($this->usr_email->GetValue(true));
        $this->DataSource->usr_fullname->SetValue($this->usr_fullname->GetValue(true));
        $this->DataSource->usr_staffid->SetValue($this->usr_staffid->GetValue(true));
        $this->DataSource->usr_post->SetValue($this->usr_post->GetValue(true));
        $this->DataSource->usr_address->SetValue($this->usr_address->GetValue(true));
        $this->DataSource->usr_gender->SetValue($this->usr_gender->GetValue(true));
        $this->DataSource->usr_password->SetValue($this->usr_password->GetValue(true));
        $this->DataSource->Password->SetValue($this->Password->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->usr_dateofbirth->SetValue($this->usr_dateofbirth->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @5-172DF00F
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

        $this->usr_post->Prepare();
        $this->usr_gender->Prepare();

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
                $this->usr_username->SetValue($this->DataSource->usr_username->GetValue());
                $this->usr_group->SetValue($this->DataSource->usr_group->GetValue());
                if(!$this->FormSubmitted){
                    $this->usr_email->SetValue($this->DataSource->usr_email->GetValue());
                    $this->usr_fullname->SetValue($this->DataSource->usr_fullname->GetValue());
                    $this->usr_staffid->SetValue($this->DataSource->usr_staffid->GetValue());
                    $this->usr_post->SetValue($this->DataSource->usr_post->GetValue());
                    $this->usr_address->SetValue($this->DataSource->usr_address->GetValue());
                    $this->usr_gender->SetValue($this->DataSource->usr_gender->GetValue());
                    $this->Password->SetValue($this->DataSource->Password->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->usr_dateofbirth->SetValue($this->DataSource->usr_dateofbirth->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->usr_username->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_vpassword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_group->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_fullname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_staffid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_post->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_gender->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_password->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Password->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_dateofbirth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_usr_dateofbirth->Errors->ToString());
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

        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->usr_username->Show();
        $this->usr_vpassword->Show();
        $this->usr_group->Show();
        $this->usr_email->Show();
        $this->usr_fullname->Show();
        $this->usr_staffid->Show();
        $this->usr_post->Show();
        $this->usr_address->Show();
        $this->usr_gender->Show();
        $this->usr_password->Show();
        $this->Password->Show();
        $this->datemodified->Show();
        $this->usr_dateofbirth->Show();
        $this->DatePicker_usr_dateofbirth->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_user Class @5-FCB6E20C

class clssmart_userDataSource extends clsDBSMART {  //smart_userDataSource Class @5-5EBFF04F

//DataSource Variables @5-AC1B605F
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
    var $usr_username;
    var $usr_vpassword;
    var $usr_group;
    var $usr_email;
    var $usr_fullname;
    var $usr_staffid;
    var $usr_post;
    var $usr_address;
    var $usr_gender;
    var $usr_password;
    var $Password;
    var $datemodified;
    var $usr_dateofbirth;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-632F35E3
    function clssmart_userDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_user/Error";
        $this->Initialize();
        $this->usr_username = new clsField("usr_username", ccsText, "");
        
        $this->usr_vpassword = new clsField("usr_vpassword", ccsText, "");
        
        $this->usr_group = new clsField("usr_group", ccsInteger, "");
        
        $this->usr_email = new clsField("usr_email", ccsText, "");
        
        $this->usr_fullname = new clsField("usr_fullname", ccsText, "");
        
        $this->usr_staffid = new clsField("usr_staffid", ccsText, "");
        
        $this->usr_post = new clsField("usr_post", ccsText, "");
        
        $this->usr_address = new clsField("usr_address", ccsMemo, "");
        
        $this->usr_gender = new clsField("usr_gender", ccsText, "");
        
        $this->usr_password = new clsField("usr_password", ccsText, "");
        
        $this->Password = new clsField("Password", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        
        $this->usr_dateofbirth = new clsField("usr_dateofbirth", ccsDate, $this->DateFormat);
        

        $this->UpdateFields["usr_email"] = array("Name" => "usr_email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_fullname"] = array("Name" => "usr_fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_staffid"] = array("Name" => "usr_staffid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_post"] = array("Name" => "usr_post", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_address"] = array("Name" => "usr_address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_gender"] = array("Name" => "usr_gender", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_password"] = array("Name" => "usr_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_dateofbirth"] = array("Name" => "usr_dateofbirth", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @5-7383B77A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urluid", ccsInteger, "", "", $this->Parameters["urluid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-260A0990
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-77641ED2
    function SetValues()
    {
        $this->usr_username->SetDBValue($this->f("usr_username"));
        $this->usr_group->SetDBValue(trim($this->f("usr_group")));
        $this->usr_email->SetDBValue($this->f("usr_email"));
        $this->usr_fullname->SetDBValue($this->f("usr_fullname"));
        $this->usr_staffid->SetDBValue($this->f("usr_staffid"));
        $this->usr_post->SetDBValue($this->f("usr_post"));
        $this->usr_address->SetDBValue($this->f("usr_address"));
        $this->usr_gender->SetDBValue($this->f("usr_gender"));
        $this->Password->SetDBValue($this->f("usr_password"));
        $this->datemodified->SetDBValue($this->f("datemodified"));
        $this->usr_dateofbirth->SetDBValue(trim($this->f("usr_dateofbirth")));
    }
//End SetValues Method

//Update Method @5-52278CC1
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["usr_email"]["Value"] = $this->usr_email->GetDBValue(true);
        $this->UpdateFields["usr_fullname"]["Value"] = $this->usr_fullname->GetDBValue(true);
        $this->UpdateFields["usr_staffid"]["Value"] = $this->usr_staffid->GetDBValue(true);
        $this->UpdateFields["usr_post"]["Value"] = $this->usr_post->GetDBValue(true);
        $this->UpdateFields["usr_address"]["Value"] = $this->usr_address->GetDBValue(true);
        $this->UpdateFields["usr_gender"]["Value"] = $this->usr_gender->GetDBValue(true);
        $this->UpdateFields["usr_password"]["Value"] = $this->Password->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["usr_dateofbirth"]["Value"] = $this->usr_dateofbirth->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_user", $this->UpdateFields, $this);
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

} //End smart_userDataSource Class @5-FCB6E20C

//Initialize Page @1-13786C23
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
$TemplateFileName = "myaccount.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CC7AB4BF
include_once("./myaccount_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-EDB96DC5
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_user = & new clsRecordsmart_user("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_user = & $smart_user;
$smart_user->Initialize();

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

//Execute Components @1-E816A615
$header->Operations();
$footer->Operations();
$smart_user->Operation();
//End Execute Components

//Go to destination page @1-F15B14CE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_user);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1E729F7F
$header->Show();
$footer->Show();
$smart_user->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1B6917E2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_user);
unset($Tpl);
//End Unload Page


?>
