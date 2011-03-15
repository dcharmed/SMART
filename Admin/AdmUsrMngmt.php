<?php
//Include Common Files @1-428085BB
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "AdmUsrMngmt.php");
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

class clsGridGUser { //GUser class @5-7E84976C

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

//Class_Initialize Event @5-DB264252
    function clsGridGUser($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GUser";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GUser";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGUserDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->usr_username = & new clsControl(ccsLink, "usr_username", "usr_username", ccsText, "", CCGetRequestParam("usr_username", ccsGet, NULL), $this);
        $this->usr_username->Page = "AdmUsrMngmt.php";
        $this->usr_status = & new clsControl(ccsLabel, "usr_status", "usr_status", ccsInteger, "", CCGetRequestParam("usr_status", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->usr_group = & new clsControl(ccsLabel, "usr_group", "usr_group", ccsInteger, "", CCGetRequestParam("usr_group", ccsGet, NULL), $this);
        $this->usr_email = & new clsControl(ccsLabel, "usr_email", "usr_email", ccsText, "", CCGetRequestParam("usr_email", ccsGet, NULL), $this);
        $this->usr_fullname = & new clsControl(ccsLabel, "usr_fullname", "usr_fullname", ccsText, "", CCGetRequestParam("usr_fullname", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->smart_user_Insert = & new clsControl(ccsImageLink, "smart_user_Insert", "smart_user_Insert", ccsText, "", CCGetRequestParam("smart_user_Insert", ccsGet, NULL), $this);
        $this->smart_user_Insert->Page = "AdmUsrMngmt.php";
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

//Show Method @5-0BC3BC2B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_username"] = CCGetFromGet("s_username", NULL);
        $this->DataSource->Parameters["urls_usergroup"] = CCGetFromGet("s_usergroup", NULL);

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
            $this->ControlsVisible["usr_username"] = $this->usr_username->Visible;
            $this->ControlsVisible["usr_status"] = $this->usr_status->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["usr_group"] = $this->usr_group->Visible;
            $this->ControlsVisible["usr_email"] = $this->usr_email->Visible;
            $this->ControlsVisible["usr_fullname"] = $this->usr_fullname->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->usr_username->SetValue($this->DataSource->usr_username->GetValue());
                $this->usr_username->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->usr_username->Parameters = CCAddParam($this->usr_username->Parameters, "id", $this->DataSource->f("id"));
                $this->usr_status->SetValue($this->DataSource->usr_status->GetValue());
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->usr_group->SetValue($this->DataSource->usr_group->GetValue());
                $this->usr_email->SetValue($this->DataSource->usr_email->GetValue());
                $this->usr_fullname->SetValue($this->DataSource->usr_fullname->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->usr_username->Show();
                $this->usr_status->Show();
                $this->id->Show();
                $this->usr_group->Show();
                $this->usr_email->Show();
                $this->usr_fullname->Show();
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
        $this->smart_user_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->smart_user_Insert->Parameters = CCAddParam($this->smart_user_Insert->Parameters, "new", 1);
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->smart_user_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-D557F476
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->usr_username->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usr_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usr_group->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usr_email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usr_fullname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GUser Class @5-FCB6E20C

class clsGUserDataSource extends clsDBSMART {  //GUserDataSource Class @5-E8513AC4

//DataSource Variables @5-11CEB551
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $usr_username;
    var $usr_status;
    var $id;
    var $usr_group;
    var $usr_email;
    var $usr_fullname;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-3CFA62E9
    function clsGUserDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GUser";
        $this->Initialize();
        $this->usr_username = new clsField("usr_username", ccsText, "");
        
        $this->usr_status = new clsField("usr_status", ccsInteger, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->usr_group = new clsField("usr_group", ccsInteger, "");
        
        $this->usr_email = new clsField("usr_email", ccsText, "");
        
        $this->usr_fullname = new clsField("usr_fullname", ccsText, "");
        

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

//Prepare Method @5-7C664E5D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_username", ccsText, "", "", $this->Parameters["urls_username"], "", false);
        $this->wp->AddParameter("2", "urls_usergroup", ccsInteger, "", "", $this->Parameters["urls_usergroup"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "usr_username", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "usr_group", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-2FBCCD75
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_user";
        $this->SQL = "SELECT id, usr_username, usr_status, usr_group, usr_email, usr_fullname \n\n" .
        "FROM smart_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-38628C58
    function SetValues()
    {
        $this->usr_username->SetDBValue($this->f("usr_username"));
        $this->usr_status->SetDBValue(trim($this->f("usr_status")));
        $this->id->SetDBValue(trim($this->f("id")));
        $this->usr_group->SetDBValue(trim($this->f("usr_group")));
        $this->usr_email->SetDBValue($this->f("usr_email"));
        $this->usr_fullname->SetDBValue($this->f("usr_fullname"));
    }
//End SetValues Method

} //End GUserDataSource Class @5-FCB6E20C

class clsRecordSFUser { //SFUser Class @6-E06DFB8F

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

//Class_Initialize Event @6-AC85EB02
    function clsRecordSFUser($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SFUser/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SFUser";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_username = & new clsControl(ccsTextBox, "s_username", "s_username", ccsText, "", CCGetRequestParam("s_username", $Method, NULL), $this);
            $this->s_usergroup = & new clsControl(ccsListBox, "s_usergroup", "s_usergroup", ccsInteger, "", CCGetRequestParam("s_usergroup", $Method, NULL), $this);
            $this->s_usergroup->DSType = dsTable;
            $this->s_usergroup->DataSource = new clsDBSMART();
            $this->s_usergroup->ds = & $this->s_usergroup->DataSource;
            $this->s_usergroup->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_usergroup->BoundColumn, $this->s_usergroup->TextColumn, $this->s_usergroup->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_usergroup->DataSource->Parameters["expr52"] = usrgroup;
            $this->s_usergroup->DataSource->wp = new clsSQLParameters();
            $this->s_usergroup->DataSource->wp->AddParameter("1", "expr52", ccsText, "", "", $this->s_usergroup->DataSource->Parameters["expr52"], "", false);
            $this->s_usergroup->DataSource->wp->Criterion[1] = $this->s_usergroup->DataSource->wp->Operation(opEqual, "ref_type", $this->s_usergroup->DataSource->wp->GetDBValue("1"), $this->s_usergroup->DataSource->ToSQL($this->s_usergroup->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_usergroup->DataSource->Where = 
                 $this->s_usergroup->DataSource->wp->Criterion[1];
        }
    }
//End Class_Initialize Event

//Validate Method @6-CDDD8D59
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_username->Validate() && $Validation);
        $Validation = ($this->s_usergroup->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_username->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_usergroup->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-BA62931A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_username->Errors->Count());
        $errors = ($errors || $this->s_usergroup->Errors->Count());
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

//Operation Method @6-C07E8A55
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
        $Redirect = "AdmUsrMngmt.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AdmUsrMngmt.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-5190CC97
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

        $this->s_usergroup->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_username->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_usergroup->Errors->ToString());
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
        $this->s_username->Show();
        $this->s_usergroup->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SFUser Class @6-FCB6E20C

class clsRecordRUser { //RUser Class @28-BAC9CCB2

//Variables @28-D6FF3E86

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

//Class_Initialize Event @28-52216CBC
    function clsRecordRUser($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RUser/Error";
        $this->DataSource = new clsRUserDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RUser";
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
            $this->usr_status = & new clsControl(ccsRadioButton, "usr_status", "Account Status", ccsInteger, "", CCGetRequestParam("usr_status", $Method, NULL), $this);
            $this->usr_status->DSType = dsListOfValues;
            $this->usr_status->Values = array(array("0", "Not Active"), array("1", "Active"), array("2", "Blocked"));
            $this->usr_status->HTML = true;
            $this->usr_status->Required = true;
            $this->usr_username = & new clsControl(ccsTextBox, "usr_username", "Username", ccsText, "", CCGetRequestParam("usr_username", $Method, NULL), $this);
            $this->usr_username->Required = true;
            $this->usr_password = & new clsControl(ccsTextBox, "usr_password", "Password", ccsText, "", CCGetRequestParam("usr_password", $Method, NULL), $this);
            $this->usr_group = & new clsControl(ccsListBox, "usr_group", "Group", ccsInteger, "", CCGetRequestParam("usr_group", $Method, NULL), $this);
            $this->usr_group->DSType = dsTable;
            $this->usr_group->DataSource = new clsDBSMART();
            $this->usr_group->ds = & $this->usr_group->DataSource;
            $this->usr_group->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->usr_group->BoundColumn, $this->usr_group->TextColumn, $this->usr_group->DBFormat) = array("ref_value", "ref_description", "");
            $this->usr_group->DataSource->Parameters["expr54"] = usrgroup;
            $this->usr_group->DataSource->wp = new clsSQLParameters();
            $this->usr_group->DataSource->wp->AddParameter("1", "expr54", ccsText, "", "", $this->usr_group->DataSource->Parameters["expr54"], "", false);
            $this->usr_group->DataSource->wp->Criterion[1] = $this->usr_group->DataSource->wp->Operation(opEqual, "ref_type", $this->usr_group->DataSource->wp->GetDBValue("1"), $this->usr_group->DataSource->ToSQL($this->usr_group->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->usr_group->DataSource->Where = 
                 $this->usr_group->DataSource->wp->Criterion[1];
            $this->usr_group->Required = true;
            $this->usr_email = & new clsControl(ccsTextBox, "usr_email", "Email", ccsText, "", CCGetRequestParam("usr_email", $Method, NULL), $this);
            $this->usr_email->Required = true;
            $this->usr_fullname = & new clsControl(ccsTextBox, "usr_fullname", "Fullname", ccsText, "", CCGetRequestParam("usr_fullname", $Method, NULL), $this);
            $this->usr_fullname->Required = true;
            $this->usr_staffid = & new clsControl(ccsTextBox, "usr_staffid", "Staff ID", ccsText, "", CCGetRequestParam("usr_staffid", $Method, NULL), $this);
            $this->usr_post = & new clsControl(ccsListBox, "usr_post", "Post", ccsInteger, "", CCGetRequestParam("usr_post", $Method, NULL), $this);
            $this->usr_post->DSType = dsTable;
            $this->usr_post->DataSource = new clsDBSMART();
            $this->usr_post->ds = & $this->usr_post->DataSource;
            $this->usr_post->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->usr_post->BoundColumn, $this->usr_post->TextColumn, $this->usr_post->DBFormat) = array("ref_value", "ref_description", "");
            $this->usr_post->DataSource->Parameters["expr57"] = usrpost;
            $this->usr_post->DataSource->wp = new clsSQLParameters();
            $this->usr_post->DataSource->wp->AddParameter("1", "expr57", ccsText, "", "", $this->usr_post->DataSource->Parameters["expr57"], "", false);
            $this->usr_post->DataSource->wp->Criterion[1] = $this->usr_post->DataSource->wp->Operation(opEqual, "ref_type", $this->usr_post->DataSource->wp->GetDBValue("1"), $this->usr_post->DataSource->ToSQL($this->usr_post->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->usr_post->DataSource->Where = 
                 $this->usr_post->DataSource->wp->Criterion[1];
            $this->usr_address = & new clsControl(ccsTextArea, "usr_address", "Address", ccsMemo, "", CCGetRequestParam("usr_address", $Method, NULL), $this);
            $this->usr_gender = & new clsControl(ccsRadioButton, "usr_gender", "Gender", ccsText, "", CCGetRequestParam("usr_gender", $Method, NULL), $this);
            $this->usr_gender->DSType = dsListOfValues;
            $this->usr_gender->Values = array(array("M", "Male"), array("F", "Female"));
            $this->usr_gender->HTML = true;
            $this->usr_dateofbirth = & new clsControl(ccsTextBox, "usr_dateofbirth", "Date Of Birth", ccsDate, $DefaultDateFormat, CCGetRequestParam("usr_dateofbirth", $Method, NULL), $this);
            $this->DatePicker_usr_dateofbirth = & new clsDatePicker("DatePicker_usr_dateofbirth", "RUser", "usr_dateofbirth", $this);
            $this->usr_vpassword = & new clsControl(ccsTextBox, "usr_vpassword", "Password Verification", ccsText, "", CCGetRequestParam("usr_vpassword", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsInteger, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->usr_oripassword = & new clsControl(ccsHidden, "usr_oripassword", "usr_oripassword", ccsText, "", CCGetRequestParam("usr_oripassword", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->usr_status->Value) && !strlen($this->usr_status->Value) && $this->usr_status->Value !== false)
                    $this->usr_status->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @28-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @28-FF8BB715
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->usr_email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->usr_email->GetText())) {
            $this->usr_email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email"));
        }
        $Validation = ($this->usr_status->Validate() && $Validation);
        $Validation = ($this->usr_username->Validate() && $Validation);
        $Validation = ($this->usr_password->Validate() && $Validation);
        $Validation = ($this->usr_group->Validate() && $Validation);
        $Validation = ($this->usr_email->Validate() && $Validation);
        $Validation = ($this->usr_fullname->Validate() && $Validation);
        $Validation = ($this->usr_staffid->Validate() && $Validation);
        $Validation = ($this->usr_post->Validate() && $Validation);
        $Validation = ($this->usr_address->Validate() && $Validation);
        $Validation = ($this->usr_gender->Validate() && $Validation);
        $Validation = ($this->usr_dateofbirth->Validate() && $Validation);
        $Validation = ($this->usr_vpassword->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->usr_oripassword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->usr_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_username->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_password->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_group->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_fullname->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_staffid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_post->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_gender->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_dateofbirth->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_vpassword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->usr_oripassword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @28-A7AD5DEE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->usr_status->Errors->Count());
        $errors = ($errors || $this->usr_username->Errors->Count());
        $errors = ($errors || $this->usr_password->Errors->Count());
        $errors = ($errors || $this->usr_group->Errors->Count());
        $errors = ($errors || $this->usr_email->Errors->Count());
        $errors = ($errors || $this->usr_fullname->Errors->Count());
        $errors = ($errors || $this->usr_staffid->Errors->Count());
        $errors = ($errors || $this->usr_post->Errors->Count());
        $errors = ($errors || $this->usr_address->Errors->Count());
        $errors = ($errors || $this->usr_gender->Errors->Count());
        $errors = ($errors || $this->usr_dateofbirth->Errors->Count());
        $errors = ($errors || $this->DatePicker_usr_dateofbirth->Errors->Count());
        $errors = ($errors || $this->usr_vpassword->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->usr_oripassword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @28-ED598703
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

//Operation Method @28-04F9A5AC
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "s_username", "s_usergroup"));
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

//InsertRow Method @28-CB8A5211
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->usr_status->SetValue($this->usr_status->GetValue(true));
        $this->DataSource->usr_username->SetValue($this->usr_username->GetValue(true));
        $this->DataSource->usr_password->SetValue($this->usr_password->GetValue(true));
        $this->DataSource->usr_group->SetValue($this->usr_group->GetValue(true));
        $this->DataSource->usr_email->SetValue($this->usr_email->GetValue(true));
        $this->DataSource->usr_fullname->SetValue($this->usr_fullname->GetValue(true));
        $this->DataSource->usr_staffid->SetValue($this->usr_staffid->GetValue(true));
        $this->DataSource->usr_post->SetValue($this->usr_post->GetValue(true));
        $this->DataSource->usr_address->SetValue($this->usr_address->GetValue(true));
        $this->DataSource->usr_gender->SetValue($this->usr_gender->GetValue(true));
        $this->DataSource->usr_dateofbirth->SetValue($this->usr_dateofbirth->GetValue(true));
        $this->DataSource->usr_vpassword->SetValue($this->usr_vpassword->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->usr_oripassword->SetValue($this->usr_oripassword->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @28-6E494901
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->usr_status->SetValue($this->usr_status->GetValue(true));
        $this->DataSource->usr_username->SetValue($this->usr_username->GetValue(true));
        $this->DataSource->usr_password->SetValue($this->usr_password->GetValue(true));
        $this->DataSource->usr_group->SetValue($this->usr_group->GetValue(true));
        $this->DataSource->usr_email->SetValue($this->usr_email->GetValue(true));
        $this->DataSource->usr_fullname->SetValue($this->usr_fullname->GetValue(true));
        $this->DataSource->usr_staffid->SetValue($this->usr_staffid->GetValue(true));
        $this->DataSource->usr_post->SetValue($this->usr_post->GetValue(true));
        $this->DataSource->usr_address->SetValue($this->usr_address->GetValue(true));
        $this->DataSource->usr_gender->SetValue($this->usr_gender->GetValue(true));
        $this->DataSource->usr_dateofbirth->SetValue($this->usr_dateofbirth->GetValue(true));
        $this->DataSource->usr_vpassword->SetValue($this->usr_vpassword->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->usr_oripassword->SetValue($this->usr_oripassword->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @28-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @28-DD48AFD8
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

        $this->usr_status->Prepare();
        $this->usr_group->Prepare();
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
                if(!$this->FormSubmitted){
                    $this->usr_status->SetValue($this->DataSource->usr_status->GetValue());
                    $this->usr_username->SetValue($this->DataSource->usr_username->GetValue());
                    $this->usr_password->SetValue($this->DataSource->usr_password->GetValue());
                    $this->usr_group->SetValue($this->DataSource->usr_group->GetValue());
                    $this->usr_email->SetValue($this->DataSource->usr_email->GetValue());
                    $this->usr_fullname->SetValue($this->DataSource->usr_fullname->GetValue());
                    $this->usr_staffid->SetValue($this->DataSource->usr_staffid->GetValue());
                    $this->usr_post->SetValue($this->DataSource->usr_post->GetValue());
                    $this->usr_address->SetValue($this->DataSource->usr_address->GetValue());
                    $this->usr_gender->SetValue($this->DataSource->usr_gender->GetValue());
                    $this->usr_dateofbirth->SetValue($this->DataSource->usr_dateofbirth->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->usr_oripassword->SetValue($this->DataSource->usr_oripassword->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->usr_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_username->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_password->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_group->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_fullname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_staffid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_post->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_gender->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_dateofbirth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_usr_dateofbirth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_vpassword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_oripassword->Errors->ToString());
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
        $this->usr_status->Show();
        $this->usr_username->Show();
        $this->usr_password->Show();
        $this->usr_group->Show();
        $this->usr_email->Show();
        $this->usr_fullname->Show();
        $this->usr_staffid->Show();
        $this->usr_post->Show();
        $this->usr_address->Show();
        $this->usr_gender->Show();
        $this->usr_dateofbirth->Show();
        $this->DatePicker_usr_dateofbirth->Show();
        $this->usr_vpassword->Show();
        $this->datemodified->Show();
        $this->usr_oripassword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RUser Class @28-FCB6E20C

class clsRUserDataSource extends clsDBSMART {  //RUserDataSource Class @28-DCA2EA49

//DataSource Variables @28-886A4B05
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
    var $usr_status;
    var $usr_username;
    var $usr_password;
    var $usr_group;
    var $usr_email;
    var $usr_fullname;
    var $usr_staffid;
    var $usr_post;
    var $usr_address;
    var $usr_gender;
    var $usr_dateofbirth;
    var $usr_vpassword;
    var $datemodified;
    var $usr_oripassword;
//End DataSource Variables

//DataSourceClass_Initialize Event @28-51C4A8CB
    function clsRUserDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RUser/Error";
        $this->Initialize();
        $this->usr_status = new clsField("usr_status", ccsInteger, "");
        
        $this->usr_username = new clsField("usr_username", ccsText, "");
        
        $this->usr_password = new clsField("usr_password", ccsText, "");
        
        $this->usr_group = new clsField("usr_group", ccsInteger, "");
        
        $this->usr_email = new clsField("usr_email", ccsText, "");
        
        $this->usr_fullname = new clsField("usr_fullname", ccsText, "");
        
        $this->usr_staffid = new clsField("usr_staffid", ccsText, "");
        
        $this->usr_post = new clsField("usr_post", ccsInteger, "");
        
        $this->usr_address = new clsField("usr_address", ccsMemo, "");
        
        $this->usr_gender = new clsField("usr_gender", ccsText, "");
        
        $this->usr_dateofbirth = new clsField("usr_dateofbirth", ccsDate, $this->DateFormat);
        
        $this->usr_vpassword = new clsField("usr_vpassword", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsInteger, "");
        
        $this->usr_oripassword = new clsField("usr_oripassword", ccsText, "");
        

        $this->InsertFields["usr_status"] = array("Name" => "usr_status", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_username"] = array("Name" => "usr_username", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_password"] = array("Name" => "usr_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_group"] = array("Name" => "usr_group", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_email"] = array("Name" => "usr_email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_fullname"] = array("Name" => "usr_fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_staffid"] = array("Name" => "usr_staffid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_post"] = array("Name" => "usr_post", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_address"] = array("Name" => "usr_address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_gender"] = array("Name" => "usr_gender", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_dateofbirth"] = array("Name" => "usr_dateofbirth", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["usr_password"] = array("Name" => "usr_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_status"] = array("Name" => "usr_status", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_username"] = array("Name" => "usr_username", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_password"] = array("Name" => "usr_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_group"] = array("Name" => "usr_group", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_email"] = array("Name" => "usr_email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_fullname"] = array("Name" => "usr_fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_staffid"] = array("Name" => "usr_staffid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_post"] = array("Name" => "usr_post", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_address"] = array("Name" => "usr_address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_gender"] = array("Name" => "usr_gender", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_dateofbirth"] = array("Name" => "usr_dateofbirth", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["usr_password"] = array("Name" => "usr_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @28-35B33087
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

//Open Method @28-260A0990
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

//SetValues Method @28-5818B25C
    function SetValues()
    {
        $this->usr_status->SetDBValue(trim($this->f("usr_status")));
        $this->usr_username->SetDBValue($this->f("usr_username"));
        $this->usr_password->SetDBValue($this->f("usr_password"));
        $this->usr_group->SetDBValue(trim($this->f("usr_group")));
        $this->usr_email->SetDBValue($this->f("usr_email"));
        $this->usr_fullname->SetDBValue($this->f("usr_fullname"));
        $this->usr_staffid->SetDBValue($this->f("usr_staffid"));
        $this->usr_post->SetDBValue(trim($this->f("usr_post")));
        $this->usr_address->SetDBValue($this->f("usr_address"));
        $this->usr_gender->SetDBValue($this->f("usr_gender"));
        $this->usr_dateofbirth->SetDBValue(trim($this->f("usr_dateofbirth")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->usr_oripassword->SetDBValue($this->f("usr_password"));
    }
//End SetValues Method

//Insert Method @28-5C7C5EAE
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["usr_status"]["Value"] = $this->usr_status->GetDBValue(true);
        $this->InsertFields["usr_username"]["Value"] = $this->usr_username->GetDBValue(true);
        $this->InsertFields["usr_password"]["Value"] = $this->usr_password->GetDBValue(true);
        $this->InsertFields["usr_group"]["Value"] = $this->usr_group->GetDBValue(true);
        $this->InsertFields["usr_email"]["Value"] = $this->usr_email->GetDBValue(true);
        $this->InsertFields["usr_fullname"]["Value"] = $this->usr_fullname->GetDBValue(true);
        $this->InsertFields["usr_staffid"]["Value"] = $this->usr_staffid->GetDBValue(true);
        $this->InsertFields["usr_post"]["Value"] = $this->usr_post->GetDBValue(true);
        $this->InsertFields["usr_address"]["Value"] = $this->usr_address->GetDBValue(true);
        $this->InsertFields["usr_gender"]["Value"] = $this->usr_gender->GetDBValue(true);
        $this->InsertFields["usr_dateofbirth"]["Value"] = $this->usr_dateofbirth->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["usr_password"]["Value"] = $this->usr_oripassword->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_user", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @28-6BADCEEF
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["usr_status"]["Value"] = $this->usr_status->GetDBValue(true);
        $this->UpdateFields["usr_username"]["Value"] = $this->usr_username->GetDBValue(true);
        $this->UpdateFields["usr_password"]["Value"] = $this->usr_password->GetDBValue(true);
        $this->UpdateFields["usr_group"]["Value"] = $this->usr_group->GetDBValue(true);
        $this->UpdateFields["usr_email"]["Value"] = $this->usr_email->GetDBValue(true);
        $this->UpdateFields["usr_fullname"]["Value"] = $this->usr_fullname->GetDBValue(true);
        $this->UpdateFields["usr_staffid"]["Value"] = $this->usr_staffid->GetDBValue(true);
        $this->UpdateFields["usr_post"]["Value"] = $this->usr_post->GetDBValue(true);
        $this->UpdateFields["usr_address"]["Value"] = $this->usr_address->GetDBValue(true);
        $this->UpdateFields["usr_gender"]["Value"] = $this->usr_gender->GetDBValue(true);
        $this->UpdateFields["usr_dateofbirth"]["Value"] = $this->usr_dateofbirth->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["usr_password"]["Value"] = $this->usr_oripassword->GetDBValue(true);
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

//Delete Method @28-297C1B98
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_user";
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

} //End RUserDataSource Class @28-FCB6E20C

//Initialize Page @1-7E0D6266
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
$TemplateFileName = "AdmUsrMngmt.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A90D32EB
include_once("./AdmUsrMngmt_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E9152DCD
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$GUser = & new clsGridGUser("", $MainPage);
$SFUser = & new clsRecordSFUser("", $MainPage);
$RUser = & new clsRecordRUser("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GUser = & $GUser;
$MainPage->SFUser = & $SFUser;
$MainPage->RUser = & $RUser;
$GUser->Initialize();
$RUser->Initialize();

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

//Execute Components @1-02883417
$header->Operations();
$footer->Operations();
$SFUser->Operation();
$RUser->Operation();
//End Execute Components

//Go to destination page @1-B6840735
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GUser);
    unset($SFUser);
    unset($RUser);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2345302F
$header->Show();
$footer->Show();
$GUser->Show();
$SFUser->Show();
$RUser->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ADE07FA8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GUser);
unset($SFUser);
unset($RUser);
unset($Tpl);
//End Unload Page


?>
