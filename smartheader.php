<?php

class clsRecordsmartheadersmart_user { //smart_user Class @12-803DE2F1

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

//Class_Initialize Event @12-C69AC6FC
    function clsRecordsmartheadersmart_user($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_user/Error";
        $this->DataSource = new clssmartheadersmart_userDataSource($this);
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
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("s_state", "GTaskHistoryPage","s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "s_svr", "ccsForm","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
            $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "uid", CCGetSession("UserID", NULL));
            $this->Link1->Page = $this->RelativePath . "myaccount.php";
            $this->usr_fullname = & new clsControl(ccsLabel, "usr_fullname", "Usr Fullname", ccsText, "", CCGetRequestParam("usr_fullname", $Method, NULL), $this);
            $this->usr_group = & new clsControl(ccsLabel, "usr_group", "Usr Group", ccsText, "", CCGetRequestParam("usr_group", $Method, NULL), $this);
            $this->usr_lastlogged = & new clsControl(ccsLabel, "usr_lastlogged", "usr_lastlogged", ccsDate, array("GeneralDate"), CCGetRequestParam("usr_lastlogged", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @12-F708D448
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["sesUserID"] = CCGetSession("UserID", NULL);
        $this->DataSource->Parameters["expr57"] = usrgroup;
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

//Show Method @12-44B25D59
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
        $this->Logout->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "s_svr", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
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

class clssmartheadersmart_userDataSource extends clsDBSMART {  //smart_userDataSource Class @12-C4E322B4

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

//DataSourceClass_Initialize Event @12-29EA69A2
    function clssmartheadersmart_userDataSource(& $Parent)
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

//Prepare Method @12-FDFC7335
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesUserID", ccsInteger, "", "", $this->Parameters["sesUserID"], "", false);
        $this->wp->AddParameter("2", "expr57", ccsText, "", "", $this->Parameters["expr57"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_user.id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "smart_referencecode.ref_type", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
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

//DEL      function clsRecordsmartheadersmart_ticket($RelativePath, & $Parent)
//DEL      {
//DEL  
//DEL          global $FileName;
//DEL          global $CCSLocales;
//DEL          global $DefaultDateFormat;
//DEL          $this->Visible = true;
//DEL          $this->Parent = & $Parent;
//DEL          $this->RelativePath = $RelativePath;
//DEL          $this->Errors = new clsErrors();
//DEL          $this->ErrorBlock = "Record smart_ticket/Error";
//DEL          $this->DataSource = new clssmartheadersmart_ticketDataSource($this);
//DEL          $this->ds = & $this->DataSource;
//DEL          $this->ReadAllowed = true;
//DEL          if($this->Visible)
//DEL          {
//DEL              $this->ComponentName = "smart_ticket";
//DEL              $this->Attributes = new clsAttributes($this->ComponentName . ":");
//DEL              $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
//DEL              if(sizeof($CCSForm) == 1)
//DEL                  $CCSForm[1] = "";
//DEL              list($FormName, $FormMethod) = $CCSForm;
//DEL              $this->EditMode = ($FormMethod == "Edit");
//DEL              $this->FormEnctype = "application/x-www-form-urlencoded";
//DEL              $this->FormSubmitted = ($FormName == $this->ComponentName);
//DEL              $Method = $this->FormSubmitted ? ccsPost : ccsGet;
//DEL              $this->lblInfo = & new clsControl(ccsLink, "lblInfo", "Tckt Status", ccsInteger, "", CCGetRequestParam("lblInfo", $Method, NULL), $this);
//DEL              $this->lblInfo->Page = $this->RelativePath . "ticketlist.php";
//DEL              $this->lblNotClose = & new clsControl(ccsLink, "lblNotClose", "lblNotClose", ccsInteger, "", CCGetRequestParam("lblNotClose", $Method, NULL), $this);
//DEL              $this->lblNotClose->Page = $this->RelativePath . "ticketlist.php";
//DEL              $this->lblCritical = & new clsControl(ccsLink, "lblCritical", "lblCritical", ccsInteger, "", CCGetRequestParam("lblCritical", $Method, NULL), $this);
//DEL              $this->lblCritical->Page = $this->RelativePath . "ticketlist.php";
//DEL              $this->lblMajor = & new clsControl(ccsLink, "lblMajor", "lblMajor", ccsInteger, "", CCGetRequestParam("lblMajor", $Method, NULL), $this);
//DEL              $this->lblMajor->Page = $this->RelativePath . "ticketlist.php";
//DEL              $this->lblMinor = & new clsControl(ccsLink, "lblMinor", "lblMinor", ccsInteger, "", CCGetRequestParam("lblMinor", $Method, NULL), $this);
//DEL              $this->lblMinor->Page = $this->RelativePath . "ticketlist.php";
//DEL              $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
//DEL              $this->Link1->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "s_svr", "smart_ticketPage", "mode", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL              $this->Link1->Page = $this->RelativePath . "ticketlist.php";
//DEL              if(!is_array($this->lblInfo->Value) && !strlen($this->lblInfo->Value) && $this->lblInfo->Value !== false)
//DEL                  $this->lblInfo->SetText(0);
//DEL              if(!is_array($this->lblNotClose->Value) && !strlen($this->lblNotClose->Value) && $this->lblNotClose->Value !== false)
//DEL                  $this->lblNotClose->SetText(0);
//DEL              if(!is_array($this->lblCritical->Value) && !strlen($this->lblCritical->Value) && $this->lblCritical->Value !== false)
//DEL                  $this->lblCritical->SetText(0);
//DEL              if(!is_array($this->lblMajor->Value) && !strlen($this->lblMajor->Value) && $this->lblMajor->Value !== false)
//DEL                  $this->lblMajor->SetText(0);
//DEL              if(!is_array($this->lblMinor->Value) && !strlen($this->lblMinor->Value) && $this->lblMinor->Value !== false)
//DEL                  $this->lblMinor->SetText(0);
//DEL          }
//DEL      }

//DEL      function Show()
//DEL      {
//DEL          global $CCSUseAmp;
//DEL          global $Tpl;
//DEL          global $FileName;
//DEL          global $CCSLocales;
//DEL          $Error = "";
//DEL  
//DEL          if(!$this->Visible)
//DEL              return;
//DEL  
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);
//DEL  
//DEL  
//DEL          $RecordBlock = "Record " . $this->ComponentName;
//DEL          $ParentPath = $Tpl->block_path;
//DEL          $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
//DEL          $this->EditMode = $this->EditMode && $this->ReadAllowed;
//DEL          if($this->EditMode) {
//DEL              if($this->DataSource->Errors->Count()){
//DEL                  $this->Errors->AddErrors($this->DataSource->Errors);
//DEL                  $this->DataSource->Errors->clear();
//DEL              }
//DEL              $this->DataSource->Open();
//DEL              if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
//DEL                  $this->DataSource->SetValues();
//DEL                  $this->lblInfo->SetValue($this->DataSource->lblInfo->GetValue());
//DEL                  $this->lblInfo->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "smart_ticketPage", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL                  $this->lblInfo->Parameters = CCAddParam($this->lblInfo->Parameters, "s_svr", 4);
//DEL                  $this->lblInfo->Parameters = CCAddParam($this->lblInfo->Parameters, "mode", 7);
//DEL                  $this->lblNotClose->SetValue($this->DataSource->lblNotClose->GetValue());
//DEL                  $this->lblNotClose->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "smart_ticketPage", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL                  $this->lblNotClose->Parameters = CCAddParam($this->lblNotClose->Parameters, "mode", 7);
//DEL                  $this->lblCritical->SetValue($this->DataSource->lblCritical->GetValue());
//DEL                  $this->lblCritical->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "smart_ticketPage", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL                  $this->lblCritical->Parameters = CCAddParam($this->lblCritical->Parameters, "s_svr", 1);
//DEL                  $this->lblCritical->Parameters = CCAddParam($this->lblCritical->Parameters, "mode", 7);
//DEL                  $this->lblMajor->SetValue($this->DataSource->lblMajor->GetValue());
//DEL                  $this->lblMajor->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "smart_ticketPage", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL                  $this->lblMajor->Parameters = CCAddParam($this->lblMajor->Parameters, "s_svr", 2);
//DEL                  $this->lblMajor->Parameters = CCAddParam($this->lblMajor->Parameters, "mode", 7);
//DEL                  $this->lblMinor->SetValue($this->DataSource->lblMinor->GetValue());
//DEL                  $this->lblMinor->Parameters = CCGetQueryString("QueryString", array("s_state", "s_branch", "s_ref", "s_sdate", "s_edate", "s_svr", "mode", "new", "view", "edit", "id", "tcktid", "rid", "eqid", "smart_ticketOrder", "smart_ticketDir", "smart_ticketPage", "ccsForm","GTaskHistoryPage","smart_ticketPage","GSmartPreventivePage","month","year","set","opt","type"));
//DEL                  $this->lblMinor->Parameters = CCAddParam($this->lblMinor->Parameters, "s_svr", 3);
//DEL                  $this->lblMinor->Parameters = CCAddParam($this->lblMinor->Parameters, "mode", 7);
//DEL              } else {
//DEL                  $this->EditMode = false;
//DEL              }
//DEL          }
//DEL  
//DEL          if($this->FormSubmitted || $this->CheckErrors()) {
//DEL              $Error = "";
//DEL              $Error = ComposeStrings($Error, $this->lblInfo->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->lblNotClose->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->lblCritical->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->lblMajor->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->lblMinor->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
//DEL              $Tpl->SetVar("Error", $Error);
//DEL              $Tpl->Parse("Error", false);
//DEL          }
//DEL          $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
//DEL          $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
//DEL          $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
//DEL          $Tpl->SetVar("HTMLFormName", $this->ComponentName);
//DEL          $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
//DEL  
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
//DEL          $this->Attributes->Show();
//DEL          if(!$this->Visible) {
//DEL              $Tpl->block_path = $ParentPath;
//DEL              return;
//DEL          }
//DEL  
//DEL          $this->lblInfo->Show();
//DEL          $this->lblNotClose->Show();
//DEL          $this->lblCritical->Show();
//DEL          $this->lblMajor->Show();
//DEL          $this->lblMinor->Show();
//DEL          $this->Link1->Show();
//DEL          $Tpl->parse();
//DEL          $Tpl->block_path = $ParentPath;
//DEL          $this->DataSource->close();
//DEL      }



//Include Page implementation @47-9F5E3B79
include_once(RelativePath . "/smartnavmenu.php");
//End Include Page implementation

class clsRecordsmartheadersmart_ticket { //smart_ticket Class @23-3E2D9CAA

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

//Class_Initialize Event @23-133DD822
    function clsRecordsmartheadersmart_ticket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->DataSource = new clssmartheadersmart_ticketDataSource($this);
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

class clssmartheadersmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @23-FAFCA47F

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

//DataSourceClass_Initialize Event @23-193E484D
    function clssmartheadersmart_ticketDataSource(& $Parent)
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

//Open Method @23-14B5E2BC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT SUM(IF(tckt_status<7,1,0)) AS tcktNotClosed, SUM(IF(tckt_status<7 AND tckt_severity=1,1,0)) AS tcktCritical, SUM(IF(tckt_status<7 AND tckt_severity=2,1,0)) AS tcktMajor,\n\n" .
        "SUM(IF(tckt_status<7 AND tckt_severity=3,1,0)) AS tcktMinor, SUM(IF(tckt_status<7 AND tckt_severity=4,1,0)) AS tcktInfo \n\n" .
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

class clssmartheader { //smartheader class @1-5B3BEAFD

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

//Class_Initialize Event @1-14F67256
    function clssmartheader($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "smartheader.php";
        $this->Redirect = "";
        $this->TemplateFileName = "smartheader.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-768E782F
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->smart_user);
        $this->smartnavmenu->Class_Terminate();
        unset($this->smartnavmenu);
        unset($this->smart_ticket);
    }
//End Class_Terminate Event

//BindEvents Method @1-5E05AD11
    function BindEvents()
    {
        $this->CCSEvents["AfterInitialize"] = "smartheader_AfterInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-06604329
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->smart_user->Operation();
        $this->smartnavmenu->Operations();
        $this->smart_ticket->Operation();
    }
//End Operations Method

//Initialize Method @1-6EED3935
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
        $this->smart_user = & new clsRecordsmartheadersmart_user($this->RelativePath, $this);
        $this->smartnavmenu = & new clssmartnavmenu($this->RelativePath, "smartnavmenu", $this);
        $this->smartnavmenu->Initialize();
        $this->TodayDate = & new clsControl(ccsLabel, "TodayDate", "TodayDate", ccsDate, array("dddd", ", ", "d", " ", "mmmm", " ", "yyyy", " ", "hh", ":", "nn", " ", "AM/PM"), CCGetRequestParam("TodayDate", ccsGet, NULL), $this);
        $this->logo = & new clsControl(ccsImageLink, "logo", "logo", ccsText, "", CCGetRequestParam("logo", ccsGet, NULL), $this);
        $this->logo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->logo->Page = $this->RelativePath . "mainpage.php";
        $this->smart_ticket = & new clsRecordsmartheadersmart_ticket($this->RelativePath, $this);
        if(!is_array($this->TodayDate->Value) && !strlen($this->TodayDate->Value) && $this->TodayDate->Value !== false)
            $this->TodayDate->SetValue(time());
        $this->smart_user->Initialize();
        $this->smart_ticket->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-B97B1127
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->smart_user->Show();
        $this->smartnavmenu->Show();
        $this->smart_ticket->Show();
        $this->TodayDate->Show();
        $this->logo->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End smartheader Class @1-FCB6E20C

//Include Event File @1-FB2E43A0
include_once(RelativePath . "/smartheader_events.php");
//End Include Event File


?>
