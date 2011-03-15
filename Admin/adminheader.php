<?php

class clsRecordadminheadersmart_user { //smart_user Class @12-EB17EF82

//Variables @12-D6FF3E86

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

//Class_Initialize Event @12-08F4A14C
    function clsRecordadminheadersmart_user($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_user/Error";
        $this->DataSource = new clsadminheadersmart_userDataSource($this);
        $this->ds = & $this->DataSource;
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
            $this->Logout = & new clsControl(ccsLink, "Logout", "Logout", ccsText, "", CCGetRequestParam("Logout", $Method, NULL), $this);
            $this->Logout->Page = $this->RelativePath . "index.php";
            $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "tcktid", "tid", "ccsForm"));
            $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "uid", CCGetSession("UserID", NULL));
            $this->Link1->Page = $this->RelativePath . "myaccount.php";
            $this->usr_fullname = & new clsControl(ccsLabel, "usr_fullname", "Usr Fullname", ccsText, "", CCGetRequestParam("usr_fullname", $Method, NULL), $this);
            $this->usr_group = & new clsControl(ccsLabel, "usr_group", "Usr Group", ccsText, "", CCGetRequestParam("usr_group", $Method, NULL), $this);
            $this->usr_lastlogged = & new clsControl(ccsLabel, "usr_lastlogged", "usr_lastlogged", ccsDate, array("GeneralDate"), CCGetRequestParam("usr_lastlogged", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @12-D3026D7D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["sesUserID"] = CCGetSession("UserID", NULL);
    }
//End Initialize Method

//Validate Method @12-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @12-662BD801
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Logout->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->usr_fullname->Errors->Count());
        $errors = ($errors || $this->usr_group->Errors->Count());
        $errors = ($errors || $this->usr_lastlogged->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @12-ED598703
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

//Operation Method @12-17DC9883
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

//Show Method @12-A69AAB49
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
                $this->usr_fullname->SetValue($this->DataSource->usr_fullname->GetValue());
                $this->usr_group->SetValue($this->DataSource->usr_group->GetValue());
                $this->usr_lastlogged->SetValue($this->DataSource->usr_lastlogged->GetValue());
            } else {
                $this->EditMode = false;
            }
        }
        $this->Logout->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "tid", "ccsForm"));
        $this->Logout->Parameters = CCAddParam($this->Logout->Parameters, "Logout", "True");

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Logout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_fullname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_group->Errors->ToString());
            $Error = ComposeStrings($Error, $this->usr_lastlogged->Errors->ToString());
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

        $this->Logout->Show();
        $this->Link1->Show();
        $this->usr_fullname->Show();
        $this->usr_group->Show();
        $this->usr_lastlogged->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_user Class @12-FCB6E20C

class clsadminheadersmart_userDataSource extends clsDBSMART {  //smart_userDataSource Class @12-F1B32E07

//DataSource Variables @12-A57D7330
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $Logout;
    var $Link1;
    var $usr_fullname;
    var $usr_group;
    var $usr_lastlogged;
//End DataSource Variables

//DataSourceClass_Initialize Event @12-39E9B71C
    function clsadminheadersmart_userDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_user/Error";
        $this->Initialize();
        $this->Logout = new clsField("Logout", ccsText, "");
        
        $this->Link1 = new clsField("Link1", ccsText, "");
        
        $this->usr_fullname = new clsField("usr_fullname", ccsText, "");
        
        $this->usr_group = new clsField("usr_group", ccsText, "");
        
        $this->usr_lastlogged = new clsField("usr_lastlogged", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @12-094CA36F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesUserID", ccsInteger, "", "", $this->Parameters["sesUserID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_user.id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @12-DE8F78D3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT smart_user.*, ref_description \n\n" .
        "FROM smart_user LEFT JOIN smart_referencecode ON\n\n" .
        "smart_user.usr_group = smart_referencecode.ref_value {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @12-2BA97760
    function SetValues()
    {
        $this->usr_fullname->SetDBValue($this->f("usr_fullname"));
        $this->usr_group->SetDBValue($this->f("ref_description"));
        $this->usr_lastlogged->SetDBValue(trim($this->f("usr_lastlogged")));
    }
//End SetValues Method

} //End smart_userDataSource Class @12-FCB6E20C

class clsRecordadminheadersmart_ticket { //smart_ticket Class @23-448EA108

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

//Class_Initialize Event @23-07CE702D
    function clsRecordadminheadersmart_ticket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->DataSource = new clsadminheadersmart_ticketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_ticket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->lblInfo = & new clsControl(ccsLink, "lblInfo", "Tckt Status", ccsInteger, "", CCGetRequestParam("lblInfo", $Method, NULL), $this);
            $this->lblInfo->Page = $this->RelativePath . "ticketlist.php";
            $this->lblNotClose = & new clsControl(ccsLink, "lblNotClose", "lblNotClose", ccsInteger, "", CCGetRequestParam("lblNotClose", $Method, NULL), $this);
            $this->lblNotClose->Page = $this->RelativePath . "ticketlist.php";
            $this->lblCritical = & new clsControl(ccsLink, "lblCritical", "lblCritical", ccsInteger, "", CCGetRequestParam("lblCritical", $Method, NULL), $this);
            $this->lblCritical->Page = $this->RelativePath . "ticketlist.php";
            $this->lblMajor = & new clsControl(ccsLink, "lblMajor", "lblMajor", ccsInteger, "", CCGetRequestParam("lblMajor", $Method, NULL), $this);
            $this->lblMajor->Page = $this->RelativePath . "ticketlist.php";
            $this->lblMinor = & new clsControl(ccsLink, "lblMinor", "lblMinor", ccsInteger, "", CCGetRequestParam("lblMinor", $Method, NULL), $this);
            $this->lblMinor->Page = $this->RelativePath . "ticketlist.php";
            $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("s_svr", "s_sdate", "s_edate", "ccsForm"));
            $this->Link1->Page = $this->RelativePath . "ticketlist.php";
            if(!is_array($this->lblInfo->Value) && !strlen($this->lblInfo->Value) && $this->lblInfo->Value !== false)
                $this->lblInfo->SetText(0);
            if(!is_array($this->lblNotClose->Value) && !strlen($this->lblNotClose->Value) && $this->lblNotClose->Value !== false)
                $this->lblNotClose->SetText(0);
            if(!is_array($this->lblCritical->Value) && !strlen($this->lblCritical->Value) && $this->lblCritical->Value !== false)
                $this->lblCritical->SetText(0);
            if(!is_array($this->lblMajor->Value) && !strlen($this->lblMajor->Value) && $this->lblMajor->Value !== false)
                $this->lblMajor->SetText(0);
            if(!is_array($this->lblMinor->Value) && !strlen($this->lblMinor->Value) && $this->lblMinor->Value !== false)
                $this->lblMinor->SetText(0);
        }
    }
//End Class_Initialize Event

//Initialize Method @23-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @23-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-6EB61EC5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->lblInfo->Errors->Count());
        $errors = ($errors || $this->lblNotClose->Errors->Count());
        $errors = ($errors || $this->lblCritical->Errors->Count());
        $errors = ($errors || $this->lblMajor->Errors->Count());
        $errors = ($errors || $this->lblMinor->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
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

//Operation Method @23-E33CFFF8
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @23-437D9020
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
                $this->lblInfo->SetValue($this->DataSource->lblInfo->GetValue());
                $this->lblInfo->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "ccsForm"));
                $this->lblInfo->Parameters = CCAddParam($this->lblInfo->Parameters, "s_svr", 4);
                $this->lblNotClose->SetValue($this->DataSource->lblNotClose->GetValue());
                $this->lblNotClose->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "ccsForm"));
                $this->lblNotClose->Parameters = CCAddParam($this->lblNotClose->Parameters, "mode", 7);
                $this->lblCritical->SetValue($this->DataSource->lblCritical->GetValue());
                $this->lblCritical->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "ccsForm"));
                $this->lblCritical->Parameters = CCAddParam($this->lblCritical->Parameters, "s_svr", 1);
                $this->lblMajor->SetValue($this->DataSource->lblMajor->GetValue());
                $this->lblMajor->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "ccsForm"));
                $this->lblMajor->Parameters = CCAddParam($this->lblMajor->Parameters, "s_svr", 2);
                $this->lblMinor->SetValue($this->DataSource->lblMinor->GetValue());
                $this->lblMinor->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "ccsForm"));
                $this->lblMinor->Parameters = CCAddParam($this->lblMinor->Parameters, "s_svr", 3);
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->lblInfo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblNotClose->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblCritical->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblMajor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblMinor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
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

        $this->lblInfo->Show();
        $this->lblNotClose->Show();
        $this->lblCritical->Show();
        $this->lblMajor->Show();
        $this->lblMinor->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_ticket Class @23-FCB6E20C

class clsadminheadersmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @23-3CA2207F

//DataSource Variables @23-B5C793B2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $lblInfo;
    var $lblNotClose;
    var $lblCritical;
    var $lblMajor;
    var $lblMinor;
    var $Link1;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-7283D468
    function clsadminheadersmart_ticketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->Initialize();
        $this->lblInfo = new clsField("lblInfo", ccsInteger, "");
        
        $this->lblNotClose = new clsField("lblNotClose", ccsInteger, "");
        
        $this->lblCritical = new clsField("lblCritical", ccsInteger, "");
        
        $this->lblMajor = new clsField("lblMajor", ccsInteger, "");
        
        $this->lblMinor = new clsField("lblMinor", ccsInteger, "");
        
        $this->Link1 = new clsField("Link1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @23-E26C3F59
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT SUM(IF(tckt_status<7,1,0)) AS tcktNotClosed, SUM(IF(tckt_severity=1,1,0)) AS tcktCritical, SUM(IF(tckt_severity=2,1,0)) AS tcktMajor,\n\n" .
        "SUM(IF(tckt_severity=3,1,0)) AS tcktMinor, SUM(IF(tckt_severity=4,1,0)) AS tcktInfo \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-D9050423
    function SetValues()
    {
        $this->lblInfo->SetDBValue(trim($this->f("tcktInfo")));
        $this->lblNotClose->SetDBValue(trim($this->f("tcktNotClosed")));
        $this->lblCritical->SetDBValue(trim($this->f("tcktCritical")));
        $this->lblMajor->SetDBValue(trim($this->f("tcktMajor")));
        $this->lblMinor->SetDBValue(trim($this->f("tcktMinor")));
    }
//End SetValues Method

} //End smart_ticketDataSource Class @23-FCB6E20C

//Include Page implementation @50-2FAB7177
include_once(RelativePath . "/Admin/menunav.php");
//End Include Page implementation

class clsadminheader { //adminheader class @1-1987B6DA

//Variables @1-9721D5A2
    var $ComponentType = "IncludablePage";
    var $Connections = array();
    var $FileName = "";
    var $Redirect = "";
    var $Tpl = "";
    var $TemplateFileName = "";
    var $BlockToParse = "";
    var $ComponentName = "";
    var $Attributes = "";

    // Events;
    var $CCSEvents = "";
    var $CCSEventResult = "";
    var $RelativePath;
    var $Visible;
    var $Parent;
//End Variables

//Class_Initialize Event @1-807A26F0
    function clsadminheader($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "adminheader.php";
        $this->Redirect = "";
        $this->TemplateFileName = "adminheader.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-D8C230FB
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->smart_user);
        unset($this->smart_ticket);
        $this->menunavbar->Class_Terminate();
        unset($this->menunavbar);
    }
//End Class_Terminate Event

//BindEvents Method @1-5AE2FFAB
    function BindEvents()
    {
        $this->CCSEvents["AfterInitialize"] = "adminheader_AfterInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-85DE0363
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->smart_user->Operation();
        $this->smart_ticket->Operation();
        $this->menunavbar->Operations();
    }
//End Operations Method

//Initialize Method @1-E48B0151
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBSMART = new clsDBSMART();
        $this->Connections["SMART"] = & $this->DBSMART;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->smart_user = & new clsRecordadminheadersmart_user($this->RelativePath, $this);
        $this->smart_ticket = & new clsRecordadminheadersmart_ticket($this->RelativePath, $this);
        $this->PanelMenuHelpdesk = & new clsPanel("PanelMenuHelpdesk", $this);
        $this->menunavbar = & new clsmenunav($this->RelativePath, "menunavbar", $this);
        $this->menunavbar->Initialize();
        $this->PanelMenuHelpdesk->AddComponent("menunavbar", $this->menunavbar);
        $this->smart_user->Initialize();
        $this->smart_ticket->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-02DAE32B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/Admin/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->smart_user->Show();
        $this->smart_ticket->Show();
        $this->PanelMenuHelpdesk->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End adminheader Class @1-FCB6E20C

//Include Event File @1-6314A7D1
include_once(RelativePath . "/Admin/adminheader_events.php");
//End Include Event File


?>
