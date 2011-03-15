<?php
//Include Common Files @1-F39D0B82
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartdp.php");
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

class clsRecordRCriteria { //RCriteria Class @5-DF5EF1B9

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

//Class_Initialize Event @5-DE7FC538
    function clsRecordRCriteria($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RCriteria/Error";
        $this->DataSource = new clsRCriteriaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RCriteria";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->prod = & new clsControl(ccsTextBox, "prod", "Dp Production", ccsInteger, "", CCGetRequestParam("prod", $Method, NULL), $this);
            $this->prod->Required = true;
            $this->mth = & new clsControl(ccsListBox, "mth", "Dp Date", ccsText, "", CCGetRequestParam("mth", $Method, NULL), $this);
            $this->mth->DSType = dsListOfValues;
            $this->mth->Values = array(array("1", "Jan"), array("2", "Feb"), array("3", "March"));
            $this->year = & new clsControl(ccsListBox, "year", "Dp Date", ccsText, "", CCGetRequestParam("year", $Method, NULL), $this);
            $this->site = & new clsControl(ccsListBox, "site", "Dp Site", ccsText, "", CCGetRequestParam("site", $Method, NULL), $this);
            $this->site->DSType = dsTable;
            $this->site->DataSource = new clsDBSMART();
            $this->site->ds = & $this->site->DataSource;
            $this->site->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where} {SQL_OrderBy}";
            list($this->site->BoundColumn, $this->site->TextColumn, $this->site->DBFormat) = array("site_code", "site_code", "");
            $this->BtnGenerate = & new clsButton("BtnGenerate", $Method, $this);
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

//Validate Method @5-23F180C7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->prod->Validate() && $Validation);
        $Validation = ($this->mth->Validate() && $Validation);
        $Validation = ($this->year->Validate() && $Validation);
        $Validation = ($this->site->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->prod->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mth->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-F5CBDC3D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->prod->Errors->Count());
        $errors = ($errors || $this->mth->Errors->Count());
        $errors = ($errors || $this->year->Errors->Count());
        $errors = ($errors || $this->site->Errors->Count());
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

//Operation Method @5-5A89DB9B
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
            $this->PressedButton = "BtnGenerate";
            if($this->BtnGenerate->Pressed) {
                $this->PressedButton = "BtnGenerate";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "BtnGenerate") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("BtnGenerate", "BtnGenerate_x", "BtnGenerate_y")), CCGetQueryString("QueryString", array("prod", "mth", "year", "site", "ccsForm")));
                if(!CCGetEvent($this->BtnGenerate->CCSEvents, "OnClick", $this->BtnGenerate)) {
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

//Show Method @5-430A8469
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

        $this->mth->Prepare();
        $this->year->Prepare();
        $this->site->Prepare();

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
                    $this->prod->SetValue($this->DataSource->prod->GetValue());
                    $this->mth->SetValue($this->DataSource->mth->GetValue());
                    $this->year->SetValue($this->DataSource->year->GetValue());
                    $this->site->SetValue($this->DataSource->site->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->prod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site->Errors->ToString());
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

        $this->prod->Show();
        $this->mth->Show();
        $this->year->Show();
        $this->site->Show();
        $this->BtnGenerate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RCriteria Class @5-FCB6E20C

class clsRCriteriaDataSource extends clsDBSMART {  //RCriteriaDataSource Class @5-883A8AD7

//DataSource Variables @5-F4A0C97B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $prod;
    var $mth;
    var $year;
    var $site;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-AFC54F78
    function clsRCriteriaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RCriteria/Error";
        $this->Initialize();
        $this->prod = new clsField("prod", ccsInteger, "");
        
        $this->mth = new clsField("mth", ccsText, "");
        
        $this->year = new clsField("year", ccsText, "");
        
        $this->site = new clsField("site", ccsText, "");
        

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

//Open Method @5-4240C582
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_damagedpassport {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-A4338AEB
    function SetValues()
    {
        $this->prod->SetDBValue(trim($this->f("dp_production")));
        $this->mth->SetDBValue($this->f("dp_date"));
        $this->year->SetDBValue($this->f("dp_date"));
        $this->site->SetDBValue($this->f("dp_site"));
    }
//End SetValues Method

} //End RCriteriaDataSource Class @5-FCB6E20C

class clsRecordVCriteria { //VCriteria Class @13-D6B551C3

//Variables @13-D6FF3E86

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

//Class_Initialize Event @13-E60BF069
    function clsRecordVCriteria($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record VCriteria/Error";
        $this->DataSource = new clsVCriteriaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "VCriteria";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->v_prod = & new clsControl(ccsLabel, "v_prod", "Dp Production", ccsInteger, "", CCGetRequestParam("v_prod", $Method, NULL), $this);
            $this->v_site = & new clsControl(ccsLabel, "v_site", "Dp Site", ccsText, "", CCGetRequestParam("v_site", $Method, NULL), $this);
            $this->v_date = & new clsControl(ccsLabel, "v_date", "Dp Date", ccsText, "", CCGetRequestParam("v_date", $Method, NULL), $this);
            $this->v_date->HTML = true;
            $this->lblUser = & new clsControl(ccsLabel, "lblUser", "lblUser", ccsText, "", CCGetRequestParam("lblUser", $Method, NULL), $this);
            $this->lblDate = & new clsControl(ccsLabel, "lblDate", "lblDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("lblDate", $Method, NULL), $this);
            if(!is_array($this->lblDate->Value) && !strlen($this->lblDate->Value) && $this->lblDate->Value !== false)
                $this->lblDate->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @13-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @13-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @13-3B6FCD5C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->v_prod->Errors->Count());
        $errors = ($errors || $this->v_site->Errors->Count());
        $errors = ($errors || $this->v_date->Errors->Count());
        $errors = ($errors || $this->lblUser->Errors->Count());
        $errors = ($errors || $this->lblDate->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @13-ED598703
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

//Operation Method @13-17DC9883
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

//Show Method @13-93678382
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
                $this->v_prod->SetValue($this->DataSource->v_prod->GetValue());
                $this->v_site->SetValue($this->DataSource->v_site->GetValue());
                $this->v_date->SetValue($this->DataSource->v_date->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->v_prod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->v_site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->v_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblUser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDate->Errors->ToString());
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

        $this->v_prod->Show();
        $this->v_site->Show();
        $this->v_date->Show();
        $this->lblUser->Show();
        $this->lblDate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End VCriteria Class @13-FCB6E20C

class clsVCriteriaDataSource extends clsDBSMART {  //VCriteriaDataSource Class @13-E669DC68

//DataSource Variables @13-51C071A6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $v_prod;
    var $v_site;
    var $v_date;
    var $lblUser;
    var $lblDate;
//End DataSource Variables

//DataSourceClass_Initialize Event @13-7D1535B5
    function clsVCriteriaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record VCriteria/Error";
        $this->Initialize();
        $this->v_prod = new clsField("v_prod", ccsInteger, "");
        
        $this->v_site = new clsField("v_site", ccsText, "");
        
        $this->v_date = new clsField("v_date", ccsText, "");
        
        $this->lblUser = new clsField("lblUser", ccsText, "");
        
        $this->lblDate = new clsField("lblDate", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @13-35B33087
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

//Open Method @13-4240C582
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_damagedpassport {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @13-ED9EF2E5
    function SetValues()
    {
        $this->v_prod->SetDBValue(trim($this->f("dp_production")));
        $this->v_site->SetDBValue($this->f("dp_site"));
        $this->v_date->SetDBValue($this->f("dp_date"));
    }
//End SetValues Method

} //End VCriteriaDataSource Class @13-FCB6E20C

class clsEditableGridGDamPassport { //GDamPassport Class @18-A9AC2794

//Variables @18-F667987F

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

//Class_Initialize Event @18-972D0C7E
    function clsEditableGridGDamPassport($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GDamPassport/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GDamPassport";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGDamPassportDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
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
        $this->dp_reportedby = & new clsControl(ccsListBox, "dp_reportedby", "Reported By", ccsText, "", NULL, $this);
        $this->dp_reportedby->DSType = dsTable;
        $this->dp_reportedby->DataSource = new clsDBSMART();
        $this->dp_reportedby->ds = & $this->dp_reportedby->DataSource;
        $this->dp_reportedby->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
        list($this->dp_reportedby->BoundColumn, $this->dp_reportedby->TextColumn, $this->dp_reportedby->DBFormat) = array("usr_username", "usr_fullname", "");
        $this->dp_reportedby->DataSource->Parameters["expr35"] = 3;
        $this->dp_reportedby->DataSource->wp = new clsSQLParameters();
        $this->dp_reportedby->DataSource->wp->AddParameter("1", "expr35", ccsInteger, "", "", $this->dp_reportedby->DataSource->Parameters["expr35"], "", false);
        $this->dp_reportedby->DataSource->wp->Criterion[1] = $this->dp_reportedby->DataSource->wp->Operation(opEqual, "usr_group", $this->dp_reportedby->DataSource->wp->GetDBValue("1"), $this->dp_reportedby->DataSource->ToSQL($this->dp_reportedby->DataSource->wp->GetDBValue("1"), ccsInteger),false);
        $this->dp_reportedby->DataSource->Where = 
             $this->dp_reportedby->DataSource->wp->Criterion[1];
        $this->dp_reportedby->Required = true;
        $this->dp_category = & new clsControl(ccsListBox, "dp_category", "Category", ccsText, "", NULL, $this);
        $this->dp_category->DSType = dsTable;
        $this->dp_category->DataSource = new clsDBSMART();
        $this->dp_category->ds = & $this->dp_category->DataSource;
        $this->dp_category->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
        list($this->dp_category->BoundColumn, $this->dp_category->TextColumn, $this->dp_category->DBFormat) = array("ref_value", "ref_description", "");
        $this->dp_category->DataSource->Parameters["expr66"] = dpcat;
        $this->dp_category->DataSource->wp = new clsSQLParameters();
        $this->dp_category->DataSource->wp->AddParameter("1", "expr66", ccsText, "", "", $this->dp_category->DataSource->Parameters["expr66"], "", false);
        $this->dp_category->DataSource->wp->Criterion[1] = $this->dp_category->DataSource->wp->Operation(opEqual, "ref_type", $this->dp_category->DataSource->wp->GetDBValue("1"), $this->dp_category->DataSource->ToSQL($this->dp_category->DataSource->wp->GetDBValue("1"), ccsText),false);
        $this->dp_category->DataSource->Where = 
             $this->dp_category->DataSource->wp->Criterion[1];
        $this->dp_subcategory = & new clsControl(ccsListBox, "dp_subcategory", "Sub Category", ccsText, "", NULL, $this);
        $this->dp_subcategory->DSType = dsTable;
        $this->dp_subcategory->DataSource = new clsDBSMART();
        $this->dp_subcategory->ds = & $this->dp_subcategory->DataSource;
        $this->dp_subcategory->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
        list($this->dp_subcategory->BoundColumn, $this->dp_subcategory->TextColumn, $this->dp_subcategory->DBFormat) = array("ref_value", "ref_description", "");
        $this->dp_quantity = & new clsControl(ccsTextBox, "dp_quantity", "Quantity", ccsInteger, "", NULL, $this);
        $this->dp_quantity->Required = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->dp_production = & new clsControl(ccsHidden, "dp_production", "Dp Production", ccsInteger, "", NULL, $this);
        $this->dp_site = & new clsControl(ccsHidden, "dp_site", "Dp Site", ccsText, "", NULL, $this);
        $this->dp_date = & new clsControl(ccsHidden, "dp_date", "Dp Date", ccsText, "", NULL, $this);
        $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @18-7C7D3E85
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["sessite"] = CCGetSession("site", NULL);
        $this->DataSource->Parameters["sesmonth"] = CCGetSession("month", NULL);
        $this->DataSource->Parameters["sesyear"] = CCGetSession("year", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @18-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @18-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @18-58DEA7FC
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["dp_reportedby"][$RowNumber] = CCGetFromPost("dp_reportedby_" . $RowNumber, NULL);
            $this->FormParameters["dp_category"][$RowNumber] = CCGetFromPost("dp_category_" . $RowNumber, NULL);
            $this->FormParameters["dp_subcategory"][$RowNumber] = CCGetFromPost("dp_subcategory_" . $RowNumber, NULL);
            $this->FormParameters["dp_quantity"][$RowNumber] = CCGetFromPost("dp_quantity_" . $RowNumber, NULL);
            $this->FormParameters["dp_production"][$RowNumber] = CCGetFromPost("dp_production_" . $RowNumber, NULL);
            $this->FormParameters["dp_site"][$RowNumber] = CCGetFromPost("dp_site_" . $RowNumber, NULL);
            $this->FormParameters["dp_date"][$RowNumber] = CCGetFromPost("dp_date_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @18-1BE7A199
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->dp_reportedby->SetText($this->FormParameters["dp_reportedby"][$this->RowNumber], $this->RowNumber);
            $this->dp_category->SetText($this->FormParameters["dp_category"][$this->RowNumber], $this->RowNumber);
            $this->dp_subcategory->SetText($this->FormParameters["dp_subcategory"][$this->RowNumber], $this->RowNumber);
            $this->dp_quantity->SetText($this->FormParameters["dp_quantity"][$this->RowNumber], $this->RowNumber);
            $this->dp_production->SetText($this->FormParameters["dp_production"][$this->RowNumber], $this->RowNumber);
            $this->dp_site->SetText($this->FormParameters["dp_site"][$this->RowNumber], $this->RowNumber);
            $this->dp_date->SetText($this->FormParameters["dp_date"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @18-ED32B601
    function ValidateRow()
    {
        global $CCSLocales;
        $this->dp_reportedby->Validate();
        $this->dp_category->Validate();
        $this->dp_subcategory->Validate();
        $this->dp_quantity->Validate();
        $this->dp_production->Validate();
        $this->dp_site->Validate();
        $this->dp_date->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->dp_reportedby->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_subcategory->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_quantity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_production->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dp_date->Errors->ToString());
        $this->dp_reportedby->Errors->Clear();
        $this->dp_category->Errors->Clear();
        $this->dp_subcategory->Errors->Clear();
        $this->dp_quantity->Errors->Clear();
        $this->dp_production->Errors->Clear();
        $this->dp_site->Errors->Clear();
        $this->dp_date->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @18-99E0D88D
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["dp_reportedby"][$this->RowNumber]) && count($this->FormParameters["dp_reportedby"][$this->RowNumber])) || strlen($this->FormParameters["dp_reportedby"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_category"][$this->RowNumber]) && count($this->FormParameters["dp_category"][$this->RowNumber])) || strlen($this->FormParameters["dp_category"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_subcategory"][$this->RowNumber]) && count($this->FormParameters["dp_subcategory"][$this->RowNumber])) || strlen($this->FormParameters["dp_subcategory"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_quantity"][$this->RowNumber]) && count($this->FormParameters["dp_quantity"][$this->RowNumber])) || strlen($this->FormParameters["dp_quantity"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_production"][$this->RowNumber]) && count($this->FormParameters["dp_production"][$this->RowNumber])) || strlen($this->FormParameters["dp_production"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_site"][$this->RowNumber]) && count($this->FormParameters["dp_site"][$this->RowNumber])) || strlen($this->FormParameters["dp_site"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dp_date"][$this->RowNumber]) && count($this->FormParameters["dp_date"][$this->RowNumber])) || strlen($this->FormParameters["dp_date"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @18-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @18-555AE694
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
        } else if($this->Button_Cancel->Pressed) {
            $this->PressedButton = "Button_Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @18-04B298A6
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->dp_reportedby->SetText($this->FormParameters["dp_reportedby"][$this->RowNumber], $this->RowNumber);
            $this->dp_category->SetText($this->FormParameters["dp_category"][$this->RowNumber], $this->RowNumber);
            $this->dp_subcategory->SetText($this->FormParameters["dp_subcategory"][$this->RowNumber], $this->RowNumber);
            $this->dp_quantity->SetText($this->FormParameters["dp_quantity"][$this->RowNumber], $this->RowNumber);
            $this->dp_production->SetText($this->FormParameters["dp_production"][$this->RowNumber], $this->RowNumber);
            $this->dp_site->SetText($this->FormParameters["dp_site"][$this->RowNumber], $this->RowNumber);
            $this->dp_date->SetText($this->FormParameters["dp_date"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @18-4E211656
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->dp_reportedby->SetValue($this->dp_reportedby->GetValue(true));
        $this->DataSource->dp_category->SetValue($this->dp_category->GetValue(true));
        $this->DataSource->dp_subcategory->SetValue($this->dp_subcategory->GetValue(true));
        $this->DataSource->dp_quantity->SetValue($this->dp_quantity->GetValue(true));
        $this->DataSource->dp_production->SetValue($this->dp_production->GetValue(true));
        $this->DataSource->dp_site->SetValue($this->dp_site->GetValue(true));
        $this->DataSource->dp_date->SetValue($this->dp_date->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @18-B40B78EE
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->dp_reportedby->SetValue($this->dp_reportedby->GetValue(true));
        $this->DataSource->dp_category->SetValue($this->dp_category->GetValue(true));
        $this->DataSource->dp_subcategory->SetValue($this->dp_subcategory->GetValue(true));
        $this->DataSource->dp_quantity->SetValue($this->dp_quantity->GetValue(true));
        $this->DataSource->dp_production->SetValue($this->dp_production->GetValue(true));
        $this->DataSource->dp_site->SetValue($this->dp_site->GetValue(true));
        $this->DataSource->dp_date->SetValue($this->dp_date->GetValue(true));
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

//FormScript Method @18-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @18-0EEA5586
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

//GetFormState Method @18-692238C5
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

//Show Method @18-DAF5C295
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->dp_reportedby->Prepare();
        $this->dp_category->Prepare();
        $this->dp_subcategory->Prepare();

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
        $this->ControlsVisible["dp_reportedby"] = $this->dp_reportedby->Visible;
        $this->ControlsVisible["dp_category"] = $this->dp_category->Visible;
        $this->ControlsVisible["dp_subcategory"] = $this->dp_subcategory->Visible;
        $this->ControlsVisible["dp_quantity"] = $this->dp_quantity->Visible;
        $this->ControlsVisible["dp_production"] = $this->dp_production->Visible;
        $this->ControlsVisible["dp_site"] = $this->dp_site->Visible;
        $this->ControlsVisible["dp_date"] = $this->dp_date->Visible;
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
                    $this->dp_reportedby->SetValue($this->DataSource->dp_reportedby->GetValue());
                    $this->dp_category->SetValue($this->DataSource->dp_category->GetValue());
                    $this->dp_subcategory->SetValue($this->DataSource->dp_subcategory->GetValue());
                    $this->dp_quantity->SetValue($this->DataSource->dp_quantity->GetValue());
                    $this->dp_production->SetValue($this->DataSource->dp_production->GetValue());
                    $this->dp_site->SetValue($this->DataSource->dp_site->GetValue());
                    $this->dp_date->SetValue($this->DataSource->dp_date->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->dp_reportedby->SetText($this->FormParameters["dp_reportedby"][$this->RowNumber], $this->RowNumber);
                    $this->dp_category->SetText($this->FormParameters["dp_category"][$this->RowNumber], $this->RowNumber);
                    $this->dp_subcategory->SetText($this->FormParameters["dp_subcategory"][$this->RowNumber], $this->RowNumber);
                    $this->dp_quantity->SetText($this->FormParameters["dp_quantity"][$this->RowNumber], $this->RowNumber);
                    $this->dp_production->SetText($this->FormParameters["dp_production"][$this->RowNumber], $this->RowNumber);
                    $this->dp_site->SetText($this->FormParameters["dp_site"][$this->RowNumber], $this->RowNumber);
                    $this->dp_date->SetText($this->FormParameters["dp_date"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->lblNumber->SetText("");
                    $this->dp_reportedby->SetText("");
                    $this->dp_category->SetText("");
                    $this->dp_subcategory->SetText("");
                    $this->dp_quantity->SetText("");
                    $this->dp_production->SetText("");
                    $this->dp_site->SetText("");
                    $this->dp_date->SetText("");
                } else {
                    $this->lblNumber->SetText("");
                    $this->dp_reportedby->SetText($this->FormParameters["dp_reportedby"][$this->RowNumber], $this->RowNumber);
                    $this->dp_category->SetText($this->FormParameters["dp_category"][$this->RowNumber], $this->RowNumber);
                    $this->dp_subcategory->SetText($this->FormParameters["dp_subcategory"][$this->RowNumber], $this->RowNumber);
                    $this->dp_quantity->SetText($this->FormParameters["dp_quantity"][$this->RowNumber], $this->RowNumber);
                    $this->dp_production->SetText($this->FormParameters["dp_production"][$this->RowNumber], $this->RowNumber);
                    $this->dp_site->SetText($this->FormParameters["dp_site"][$this->RowNumber], $this->RowNumber);
                    $this->dp_date->SetText($this->FormParameters["dp_date"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show($this->RowNumber);
                $this->dp_reportedby->Show($this->RowNumber);
                $this->dp_category->Show($this->RowNumber);
                $this->dp_subcategory->Show($this->RowNumber);
                $this->dp_quantity->Show($this->RowNumber);
                $this->dp_production->Show($this->RowNumber);
                $this->dp_site->Show($this->RowNumber);
                $this->dp_date->Show($this->RowNumber);
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
        $this->Button_Submit->Show();
        $this->Button_Cancel->Show();

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

} //End GDamPassport Class @18-FCB6E20C

class clsGDamPassportDataSource extends clsDBSMART {  //GDamPassportDataSource Class @18-334BA7C1

//DataSource Variables @18-96FCAED0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $lblNumber;
    var $dp_reportedby;
    var $dp_category;
    var $dp_subcategory;
    var $dp_quantity;
    var $dp_production;
    var $dp_site;
    var $dp_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @18-7B84B163
    function clsGDamPassportDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GDamPassport/Error";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->dp_reportedby = new clsField("dp_reportedby", ccsText, "");
        
        $this->dp_category = new clsField("dp_category", ccsText, "");
        
        $this->dp_subcategory = new clsField("dp_subcategory", ccsText, "");
        
        $this->dp_quantity = new clsField("dp_quantity", ccsInteger, "");
        
        $this->dp_production = new clsField("dp_production", ccsInteger, "");
        
        $this->dp_site = new clsField("dp_site", ccsText, "");
        
        $this->dp_date = new clsField("dp_date", ccsText, "");
        

        $this->InsertFields["dp_reportedby"] = array("Name" => "dp_reportedby", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["dp_category"] = array("Name" => "dp_category", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["dp_subcategory"] = array("Name" => "dp_subcategory", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["dp_quantity"] = array("Name" => "dp_quantity", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["dp_production"] = array("Name" => "dp_production", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["dp_site"] = array("Name" => "dp_site", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["dp_date"] = array("Name" => "dp_date", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["dp_reportedby"] = array("Name" => "dp_reportedby", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["dp_category"] = array("Name" => "dp_category", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["dp_subcategory"] = array("Name" => "dp_subcategory", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["dp_quantity"] = array("Name" => "dp_quantity", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["dp_production"] = array("Name" => "dp_production", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["dp_site"] = array("Name" => "dp_site", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["dp_date"] = array("Name" => "dp_date", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @18-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @18-451F88C3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sessite", ccsText, "", "", $this->Parameters["sessite"], "", false);
        $this->wp->AddParameter("2", "sesmonth", ccsText, "", "", $this->Parameters["sesmonth"], "", false);
        $this->wp->AddParameter("3", "sesyear", ccsText, "", "", $this->Parameters["sesyear"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @18-52B4C101
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM smart_damagedpassport\n" .
        "WHERE dp_site = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'\n" .
        "AND MONTH(dp_date) = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'\n" .
        "AND YEAR(dp_date) = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'";
        $this->SQL = "SELECT * \n" .
        "FROM smart_damagedpassport\n" .
        "WHERE dp_site = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'\n" .
        "AND MONTH(dp_date) = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'\n" .
        "AND YEAR(dp_date) = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @18-03FF45D8
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->dp_reportedby->SetDBValue($this->f("dp_reportedby"));
        $this->dp_category->SetDBValue($this->f("dp_category"));
        $this->dp_subcategory->SetDBValue($this->f("dp_subcategory"));
        $this->dp_quantity->SetDBValue(trim($this->f("dp_quantity")));
        $this->dp_production->SetDBValue(trim($this->f("dp_production")));
        $this->dp_site->SetDBValue($this->f("dp_site"));
        $this->dp_date->SetDBValue($this->f("dp_date"));
    }
//End SetValues Method

//Insert Method @18-8CE1C55A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["dp_reportedby"] = new clsSQLParameter("ctrldp_reportedby", ccsText, "", "", $this->dp_reportedby->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_category"] = new clsSQLParameter("ctrldp_category", ccsText, "", "", $this->dp_category->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_subcategory"] = new clsSQLParameter("ctrldp_subcategory", ccsText, "", "", $this->dp_subcategory->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_quantity"] = new clsSQLParameter("ctrldp_quantity", ccsInteger, "", "", $this->dp_quantity->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_production"] = new clsSQLParameter("ctrldp_production", ccsInteger, "", "", $this->dp_production->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_site"] = new clsSQLParameter("ctrldp_site", ccsText, "", "", $this->dp_site->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_date"] = new clsSQLParameter("ctrldp_date", ccsText, "", "", $this->dp_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["dp_reportedby"]->GetValue()) and !strlen($this->cp["dp_reportedby"]->GetText()) and !is_bool($this->cp["dp_reportedby"]->GetValue())) 
            $this->cp["dp_reportedby"]->SetValue($this->dp_reportedby->GetValue(true));
        if (!is_null($this->cp["dp_category"]->GetValue()) and !strlen($this->cp["dp_category"]->GetText()) and !is_bool($this->cp["dp_category"]->GetValue())) 
            $this->cp["dp_category"]->SetValue($this->dp_category->GetValue(true));
        if (!is_null($this->cp["dp_subcategory"]->GetValue()) and !strlen($this->cp["dp_subcategory"]->GetText()) and !is_bool($this->cp["dp_subcategory"]->GetValue())) 
            $this->cp["dp_subcategory"]->SetValue($this->dp_subcategory->GetValue(true));
        if (!is_null($this->cp["dp_quantity"]->GetValue()) and !strlen($this->cp["dp_quantity"]->GetText()) and !is_bool($this->cp["dp_quantity"]->GetValue())) 
            $this->cp["dp_quantity"]->SetValue($this->dp_quantity->GetValue(true));
        if (!is_null($this->cp["dp_production"]->GetValue()) and !strlen($this->cp["dp_production"]->GetText()) and !is_bool($this->cp["dp_production"]->GetValue())) 
            $this->cp["dp_production"]->SetValue($this->dp_production->GetValue(true));
        if (!is_null($this->cp["dp_site"]->GetValue()) and !strlen($this->cp["dp_site"]->GetText()) and !is_bool($this->cp["dp_site"]->GetValue())) 
            $this->cp["dp_site"]->SetValue($this->dp_site->GetValue(true));
        if (!is_null($this->cp["dp_date"]->GetValue()) and !strlen($this->cp["dp_date"]->GetText()) and !is_bool($this->cp["dp_date"]->GetValue())) 
            $this->cp["dp_date"]->SetValue($this->dp_date->GetValue(true));
        $this->InsertFields["dp_reportedby"]["Value"] = $this->cp["dp_reportedby"]->GetDBValue(true);
        $this->InsertFields["dp_category"]["Value"] = $this->cp["dp_category"]->GetDBValue(true);
        $this->InsertFields["dp_subcategory"]["Value"] = $this->cp["dp_subcategory"]->GetDBValue(true);
        $this->InsertFields["dp_quantity"]["Value"] = $this->cp["dp_quantity"]->GetDBValue(true);
        $this->InsertFields["dp_production"]["Value"] = $this->cp["dp_production"]->GetDBValue(true);
        $this->InsertFields["dp_site"]["Value"] = $this->cp["dp_site"]->GetDBValue(true);
        $this->InsertFields["dp_date"]["Value"] = $this->cp["dp_date"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_damagedpassport", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @18-92DF58D1
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["dp_reportedby"] = new clsSQLParameter("ctrldp_reportedby", ccsText, "", "", $this->dp_reportedby->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_category"] = new clsSQLParameter("ctrldp_category", ccsText, "", "", $this->dp_category->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_subcategory"] = new clsSQLParameter("ctrldp_subcategory", ccsText, "", "", $this->dp_subcategory->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_quantity"] = new clsSQLParameter("ctrldp_quantity", ccsInteger, "", "", $this->dp_quantity->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_production"] = new clsSQLParameter("ctrldp_production", ccsInteger, "", "", $this->dp_production->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_site"] = new clsSQLParameter("ctrldp_site", ccsText, "", "", $this->dp_site->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["dp_date"] = new clsSQLParameter("ctrldp_date", ccsText, "", "", $this->dp_date->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsid", ccsInteger, "", "", $this->CachedColumns["id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["dp_reportedby"]->GetValue()) and !strlen($this->cp["dp_reportedby"]->GetText()) and !is_bool($this->cp["dp_reportedby"]->GetValue())) 
            $this->cp["dp_reportedby"]->SetValue($this->dp_reportedby->GetValue(true));
        if (!is_null($this->cp["dp_category"]->GetValue()) and !strlen($this->cp["dp_category"]->GetText()) and !is_bool($this->cp["dp_category"]->GetValue())) 
            $this->cp["dp_category"]->SetValue($this->dp_category->GetValue(true));
        if (!is_null($this->cp["dp_subcategory"]->GetValue()) and !strlen($this->cp["dp_subcategory"]->GetText()) and !is_bool($this->cp["dp_subcategory"]->GetValue())) 
            $this->cp["dp_subcategory"]->SetValue($this->dp_subcategory->GetValue(true));
        if (!is_null($this->cp["dp_quantity"]->GetValue()) and !strlen($this->cp["dp_quantity"]->GetText()) and !is_bool($this->cp["dp_quantity"]->GetValue())) 
            $this->cp["dp_quantity"]->SetValue($this->dp_quantity->GetValue(true));
        if (!is_null($this->cp["dp_production"]->GetValue()) and !strlen($this->cp["dp_production"]->GetText()) and !is_bool($this->cp["dp_production"]->GetValue())) 
            $this->cp["dp_production"]->SetValue($this->dp_production->GetValue(true));
        if (!is_null($this->cp["dp_site"]->GetValue()) and !strlen($this->cp["dp_site"]->GetText()) and !is_bool($this->cp["dp_site"]->GetValue())) 
            $this->cp["dp_site"]->SetValue($this->dp_site->GetValue(true));
        if (!is_null($this->cp["dp_date"]->GetValue()) and !strlen($this->cp["dp_date"]->GetText()) and !is_bool($this->cp["dp_date"]->GetValue())) 
            $this->cp["dp_date"]->SetValue($this->dp_date->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["dp_reportedby"]["Value"] = $this->cp["dp_reportedby"]->GetDBValue(true);
        $this->UpdateFields["dp_category"]["Value"] = $this->cp["dp_category"]->GetDBValue(true);
        $this->UpdateFields["dp_subcategory"]["Value"] = $this->cp["dp_subcategory"]->GetDBValue(true);
        $this->UpdateFields["dp_quantity"]["Value"] = $this->cp["dp_quantity"]->GetDBValue(true);
        $this->UpdateFields["dp_production"]["Value"] = $this->cp["dp_production"]->GetDBValue(true);
        $this->UpdateFields["dp_site"]["Value"] = $this->cp["dp_site"]->GetDBValue(true);
        $this->UpdateFields["dp_date"]["Value"] = $this->cp["dp_date"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_damagedpassport", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End GDamPassportDataSource Class @18-FCB6E20C

//Initialize Page @1-CBFB23CD
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
$TemplateFileName = "smartdp.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C5D71E8A
include_once("./smartdp_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-77812F30
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$RCriteria = & new clsRecordRCriteria("", $MainPage);
$VCriteria = & new clsRecordVCriteria("", $MainPage);
$GDamPassport = & new clsEditableGridGDamPassport("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->RCriteria = & $RCriteria;
$MainPage->VCriteria = & $VCriteria;
$MainPage->GDamPassport = & $GDamPassport;
$RCriteria->Initialize();
$VCriteria->Initialize();
$GDamPassport->Initialize();

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

//Execute Components @1-1E732FD8
$header->Operations();
$footer->Operations();
$RCriteria->Operation();
$VCriteria->Operation();
$GDamPassport->Operation();
//End Execute Components

//Go to destination page @1-7180CA1F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($RCriteria);
    unset($VCriteria);
    unset($GDamPassport);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B8A6F391
$header->Show();
$footer->Show();
$RCriteria->Show();
$VCriteria->Show();
$GDamPassport->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CED5DF2D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($RCriteria);
unset($VCriteria);
unset($GDamPassport);
unset($Tpl);
//End Unload Page


?>
