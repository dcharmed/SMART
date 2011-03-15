<?php
//Include Common Files @1-0647B928
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartsite.php");
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

class clsGridGSite { //GSite class @5-D60798E6

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

//Class_Initialize Event @5-4107C31B
    function clsGridGSite($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSite";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSite";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSiteDataSource($this);
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

        $this->site_name = & new clsControl(ccsLink, "site_name", "site_name", ccsText, "", CCGetRequestParam("site_name", ccsGet, NULL), $this);
        $this->site_name->Page = "smartsite.php";
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->site_code = & new clsControl(ccsLabel, "site_code", "site_code", ccsText, "", CCGetRequestParam("site_code", ccsGet, NULL), $this);
        $this->site_state = & new clsControl(ccsLabel, "site_state", "site_state", ccsText, "", CCGetRequestParam("site_state", ccsGet, NULL), $this);
        $this->site_region = & new clsControl(ccsLabel, "site_region", "site_region", ccsText, "", CCGetRequestParam("site_region", ccsGet, NULL), $this);
        $this->site_offnumber = & new clsControl(ccsLabel, "site_offnumber", "site_offnumber", ccsText, "", CCGetRequestParam("site_offnumber", ccsGet, NULL), $this);
        $this->site_faxnumber = & new clsControl(ccsLabel, "site_faxnumber", "site_faxnumber", ccsText, "", CCGetRequestParam("site_faxnumber", ccsGet, NULL), $this);
        $this->site_offhours = & new clsControl(ccsLabel, "site_offhours", "site_offhours", ccsText, "", CCGetRequestParam("site_offhours", ccsGet, NULL), $this);
        $this->smart_site_Insert = & new clsControl(ccsLink, "smart_site_Insert", "smart_site_Insert", ccsText, "", CCGetRequestParam("smart_site_Insert", ccsGet, NULL), $this);
        $this->smart_site_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->smart_site_Insert->Page = "smartsite.php";
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

//Show Method @5-BD6BD6BA
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_state"] = CCGetFromGet("s_state", NULL);
        $this->DataSource->Parameters["urls_name"] = CCGetFromGet("s_name", NULL);
        $this->DataSource->Parameters["urls_code"] = CCGetFromGet("s_code", NULL);

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
            $this->ControlsVisible["site_name"] = $this->site_name->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["site_code"] = $this->site_code->Visible;
            $this->ControlsVisible["site_state"] = $this->site_state->Visible;
            $this->ControlsVisible["site_region"] = $this->site_region->Visible;
            $this->ControlsVisible["site_offnumber"] = $this->site_offnumber->Visible;
            $this->ControlsVisible["site_faxnumber"] = $this->site_faxnumber->Visible;
            $this->ControlsVisible["site_offhours"] = $this->site_offhours->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->site_name->SetValue($this->DataSource->site_name->GetValue());
                $this->site_name->Parameters = CCGetQueryString("QueryString", array("s_state", "s_name", "s_code", "ccsForm"));
                $this->site_name->Parameters = CCAddParam($this->site_name->Parameters, "sid", $this->DataSource->f("id"));
                $this->site_name->Parameters = CCAddParam($this->site_name->Parameters, "view", 1);
                $this->site_name->Parameters = CCAddParam($this->site_name->Parameters, "scode", $this->DataSource->f("site_code"));
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->site_code->SetValue($this->DataSource->site_code->GetValue());
                $this->site_state->SetValue($this->DataSource->site_state->GetValue());
                $this->site_region->SetValue($this->DataSource->site_region->GetValue());
                $this->site_offnumber->SetValue($this->DataSource->site_offnumber->GetValue());
                $this->site_faxnumber->SetValue($this->DataSource->site_faxnumber->GetValue());
                $this->site_offhours->SetValue($this->DataSource->site_offhours->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->site_name->Show();
                $this->lblNumber->Show();
                $this->site_code->Show();
                $this->site_state->Show();
                $this->site_region->Show();
                $this->site_offnumber->Show();
                $this->site_faxnumber->Show();
                $this->site_offhours->Show();
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
        $this->smart_site_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-A454064F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->site_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_offnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_faxnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->site_offhours->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSite Class @5-FCB6E20C

class clsGSiteDataSource extends clsDBSMART {  //GSiteDataSource Class @5-1DB26C73

//DataSource Variables @5-23046DAE
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $site_name;
    var $lblNumber;
    var $site_code;
    var $site_state;
    var $site_region;
    var $site_offnumber;
    var $site_faxnumber;
    var $site_offhours;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-25F6A314
    function clsGSiteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSite";
        $this->Initialize();
        $this->site_name = new clsField("site_name", ccsText, "");
        
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->site_code = new clsField("site_code", ccsText, "");
        
        $this->site_state = new clsField("site_state", ccsText, "");
        
        $this->site_region = new clsField("site_region", ccsText, "");
        
        $this->site_offnumber = new clsField("site_offnumber", ccsText, "");
        
        $this->site_faxnumber = new clsField("site_faxnumber", ccsText, "");
        
        $this->site_offhours = new clsField("site_offhours", ccsText, "");
        

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

//Prepare Method @5-B0716FF1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_state", ccsText, "", "", $this->Parameters["urls_state"], "", false);
        $this->wp->AddParameter("2", "urls_name", ccsText, "", "", $this->Parameters["urls_name"], "", false);
        $this->wp->AddParameter("3", "urls_code", ccsText, "", "", $this->Parameters["urls_code"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "site_state", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "site_name", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "site_code", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @5-738E9208
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_site";
        $this->SQL = "SELECT id, site_name, site_code, site_state, site_region, site_offnumber, site_faxnumber, site_offhours \n\n" .
        "FROM smart_site {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-16743410
    function SetValues()
    {
        $this->site_name->SetDBValue($this->f("site_name"));
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->site_code->SetDBValue($this->f("site_code"));
        $this->site_state->SetDBValue($this->f("site_state"));
        $this->site_region->SetDBValue($this->f("site_region"));
        $this->site_offnumber->SetDBValue($this->f("site_offnumber"));
        $this->site_faxnumber->SetDBValue($this->f("site_faxnumber"));
        $this->site_offhours->SetDBValue($this->f("site_offhours"));
    }
//End SetValues Method

} //End GSiteDataSource Class @5-FCB6E20C

class clsRecordSSite { //SSite Class @6-D916109D

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

//Class_Initialize Event @6-42F22213
    function clsRecordSSite($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SSite/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SSite";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_state = & new clsControl(ccsListBox, "s_state", "s_state", ccsText, "", CCGetRequestParam("s_state", $Method, NULL), $this);
            $this->s_state->DSType = dsTable;
            $this->s_state->DataSource = new clsDBSMART();
            $this->s_state->ds = & $this->s_state->DataSource;
            $this->s_state->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where}\n" .
"GROUP BY site_state {SQL_OrderBy}";
            list($this->s_state->BoundColumn, $this->s_state->TextColumn, $this->s_state->DBFormat) = array("site_state", "site_state", "");
            $this->s_name = & new clsControl(ccsTextBox, "s_name", "s_name", ccsText, "", CCGetRequestParam("s_name", $Method, NULL), $this);
            $this->s_code = & new clsControl(ccsTextBox, "s_code", "s_code", ccsText, "", CCGetRequestParam("s_code", $Method, NULL), $this);
            $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", $Method, NULL), $this);
            $this->ImageLink1->Page = "smartsite.php";
        }
    }
//End Class_Initialize Event

//Validate Method @6-E2270A54
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_state->Validate() && $Validation);
        $Validation = ($this->s_name->Validate() && $Validation);
        $Validation = ($this->s_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_state->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-4A32B610
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_state->Errors->Count());
        $errors = ($errors || $this->s_name->Errors->Count());
        $errors = ($errors || $this->s_code->Errors->Count());
        $errors = ($errors || $this->ImageLink1->Errors->Count());
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

//Operation Method @6-1B2E9E03
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
        $Redirect = "smartsite.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartsite.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-43B51E88
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

        $this->s_state->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "new", 1);

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ImageLink1->Errors->ToString());
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
        $this->s_state->Show();
        $this->s_name->Show();
        $this->s_code->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SSite Class @6-FCB6E20C

class clsRecordRSite { //RSite Class @34-124AC338

//Variables @34-D6FF3E86

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

//Class_Initialize Event @34-C58DEFB1
    function clsRecordRSite($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSite/Error";
        $this->DataSource = new clsRSiteDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSite";
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
            $this->site_code = & new clsControl(ccsTextBox, "site_code", "Site Code", ccsText, "", CCGetRequestParam("site_code", $Method, NULL), $this);
            $this->site_code->Required = true;
            $this->site_name = & new clsControl(ccsTextBox, "site_name", "Site Name", ccsText, "", CCGetRequestParam("site_name", $Method, NULL), $this);
            $this->site_name->Required = true;
            $this->site_lat = & new clsControl(ccsTextBox, "site_lat", "Site Lat", ccsText, "", CCGetRequestParam("site_lat", $Method, NULL), $this);
            $this->site_offnumber = & new clsControl(ccsTextBox, "site_offnumber", "Site Offnumber", ccsInteger, "", CCGetRequestParam("site_offnumber", $Method, NULL), $this);
            $this->site_long = & new clsControl(ccsTextBox, "site_long", "Site Long", ccsText, "", CCGetRequestParam("site_long", $Method, NULL), $this);
            $this->site_state = & new clsControl(ccsListBox, "site_state", "Site State", ccsText, "", CCGetRequestParam("site_state", $Method, NULL), $this);
            $this->site_state->DSType = dsTable;
            $this->site_state->DataSource = new clsDBSMART();
            $this->site_state->ds = & $this->site_state->DataSource;
            $this->site_state->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where}\n" .
"GROUP BY site_state {SQL_OrderBy}";
            list($this->site_state->BoundColumn, $this->site_state->TextColumn, $this->site_state->DBFormat) = array("site_state", "site_state", "");
            $this->site_state->Required = true;
            $this->site_region = & new clsControl(ccsListBox, "site_region", "Site Region", ccsText, "", CCGetRequestParam("site_region", $Method, NULL), $this);
            $this->site_region->DSType = dsTable;
            $this->site_region->DataSource = new clsDBSMART();
            $this->site_region->ds = & $this->site_region->DataSource;
            $this->site_region->DataSource->SQL = "SELECT * \n" .
"FROM smart_site {SQL_Where}\n" .
"GROUP BY site_region {SQL_OrderBy}";
            list($this->site_region->BoundColumn, $this->site_region->TextColumn, $this->site_region->DBFormat) = array("site_region", "site_region", "");
            $this->site_region->Required = true;
            $this->site_faxnumber = & new clsControl(ccsTextBox, "site_faxnumber", "Site Faxnumber", ccsInteger, "", CCGetRequestParam("site_faxnumber", $Method, NULL), $this);
            $this->site_address = & new clsControl(ccsTextArea, "site_address", "Site Address", ccsMemo, "", CCGetRequestParam("site_address", $Method, NULL), $this);
            $this->site_address->Required = true;
            $this->site_sla = & new clsControl(ccsTextBox, "site_sla", "Site Sla", ccsText, "", CCGetRequestParam("site_sla", $Method, NULL), $this);
            $this->site_offhours = & new clsControl(ccsTextBox, "site_offhours", "Site Offhours", ccsText, "", CCGetRequestParam("site_offhours", $Method, NULL), $this);
            $this->lblNotes = & new clsControl(ccsLabel, "lblNotes", "lblNotes", ccsText, "", CCGetRequestParam("lblNotes", $Method, NULL), $this);
            $this->lblNotes->HTML = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @34-A35E0DCC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlsid"] = CCGetFromGet("sid", NULL);
    }
//End Initialize Method

//Validate Method @34-13BF20AA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->site_code->Validate() && $Validation);
        $Validation = ($this->site_name->Validate() && $Validation);
        $Validation = ($this->site_lat->Validate() && $Validation);
        $Validation = ($this->site_offnumber->Validate() && $Validation);
        $Validation = ($this->site_long->Validate() && $Validation);
        $Validation = ($this->site_state->Validate() && $Validation);
        $Validation = ($this->site_region->Validate() && $Validation);
        $Validation = ($this->site_faxnumber->Validate() && $Validation);
        $Validation = ($this->site_address->Validate() && $Validation);
        $Validation = ($this->site_sla->Validate() && $Validation);
        $Validation = ($this->site_offhours->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->site_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_lat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_offnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_long->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_state->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_faxnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_sla->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_offhours->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @34-5E281FCD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->site_code->Errors->Count());
        $errors = ($errors || $this->site_name->Errors->Count());
        $errors = ($errors || $this->site_lat->Errors->Count());
        $errors = ($errors || $this->site_offnumber->Errors->Count());
        $errors = ($errors || $this->site_long->Errors->Count());
        $errors = ($errors || $this->site_state->Errors->Count());
        $errors = ($errors || $this->site_region->Errors->Count());
        $errors = ($errors || $this->site_faxnumber->Errors->Count());
        $errors = ($errors || $this->site_address->Errors->Count());
        $errors = ($errors || $this->site_sla->Errors->Count());
        $errors = ($errors || $this->site_offhours->Errors->Count());
        $errors = ($errors || $this->lblNotes->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @34-ED598703
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

//Operation Method @34-0BF2B389
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

//InsertRow Method @34-C62E057F
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->site_code->SetValue($this->site_code->GetValue(true));
        $this->DataSource->site_name->SetValue($this->site_name->GetValue(true));
        $this->DataSource->site_lat->SetValue($this->site_lat->GetValue(true));
        $this->DataSource->site_offnumber->SetValue($this->site_offnumber->GetValue(true));
        $this->DataSource->site_long->SetValue($this->site_long->GetValue(true));
        $this->DataSource->site_state->SetValue($this->site_state->GetValue(true));
        $this->DataSource->site_region->SetValue($this->site_region->GetValue(true));
        $this->DataSource->site_faxnumber->SetValue($this->site_faxnumber->GetValue(true));
        $this->DataSource->site_address->SetValue($this->site_address->GetValue(true));
        $this->DataSource->site_sla->SetValue($this->site_sla->GetValue(true));
        $this->DataSource->site_offhours->SetValue($this->site_offhours->GetValue(true));
        $this->DataSource->lblNotes->SetValue($this->lblNotes->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @34-52E65D57
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->site_code->SetValue($this->site_code->GetValue(true));
        $this->DataSource->site_name->SetValue($this->site_name->GetValue(true));
        $this->DataSource->site_lat->SetValue($this->site_lat->GetValue(true));
        $this->DataSource->site_offnumber->SetValue($this->site_offnumber->GetValue(true));
        $this->DataSource->site_long->SetValue($this->site_long->GetValue(true));
        $this->DataSource->site_state->SetValue($this->site_state->GetValue(true));
        $this->DataSource->site_region->SetValue($this->site_region->GetValue(true));
        $this->DataSource->site_faxnumber->SetValue($this->site_faxnumber->GetValue(true));
        $this->DataSource->site_address->SetValue($this->site_address->GetValue(true));
        $this->DataSource->site_sla->SetValue($this->site_sla->GetValue(true));
        $this->DataSource->site_offhours->SetValue($this->site_offhours->GetValue(true));
        $this->DataSource->lblNotes->SetValue($this->lblNotes->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @34-3F8D35BB
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

        $this->site_state->Prepare();
        $this->site_region->Prepare();

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
                    $this->site_code->SetValue($this->DataSource->site_code->GetValue());
                    $this->site_name->SetValue($this->DataSource->site_name->GetValue());
                    $this->site_lat->SetValue($this->DataSource->site_lat->GetValue());
                    $this->site_offnumber->SetValue($this->DataSource->site_offnumber->GetValue());
                    $this->site_long->SetValue($this->DataSource->site_long->GetValue());
                    $this->site_state->SetValue($this->DataSource->site_state->GetValue());
                    $this->site_region->SetValue($this->DataSource->site_region->GetValue());
                    $this->site_faxnumber->SetValue($this->DataSource->site_faxnumber->GetValue());
                    $this->site_address->SetValue($this->DataSource->site_address->GetValue());
                    $this->site_sla->SetValue($this->DataSource->site_sla->GetValue());
                    $this->site_offhours->SetValue($this->DataSource->site_offhours->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->site_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_lat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_offnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_long->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_faxnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_sla->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_offhours->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblNotes->Errors->ToString());
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
        $this->site_code->Show();
        $this->site_name->Show();
        $this->site_lat->Show();
        $this->site_offnumber->Show();
        $this->site_long->Show();
        $this->site_state->Show();
        $this->site_region->Show();
        $this->site_faxnumber->Show();
        $this->site_address->Show();
        $this->site_sla->Show();
        $this->site_offhours->Show();
        $this->lblNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSite Class @34-FCB6E20C

class clsRSiteDataSource extends clsDBSMART {  //RSiteDataSource Class @34-2941BCFE

//DataSource Variables @34-C03EB44C
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
    var $site_code;
    var $site_name;
    var $site_lat;
    var $site_offnumber;
    var $site_long;
    var $site_state;
    var $site_region;
    var $site_faxnumber;
    var $site_address;
    var $site_sla;
    var $site_offhours;
    var $lblNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @34-6C555A67
    function clsRSiteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSite/Error";
        $this->Initialize();
        $this->site_code = new clsField("site_code", ccsText, "");
        
        $this->site_name = new clsField("site_name", ccsText, "");
        
        $this->site_lat = new clsField("site_lat", ccsText, "");
        
        $this->site_offnumber = new clsField("site_offnumber", ccsInteger, "");
        
        $this->site_long = new clsField("site_long", ccsText, "");
        
        $this->site_state = new clsField("site_state", ccsText, "");
        
        $this->site_region = new clsField("site_region", ccsText, "");
        
        $this->site_faxnumber = new clsField("site_faxnumber", ccsInteger, "");
        
        $this->site_address = new clsField("site_address", ccsMemo, "");
        
        $this->site_sla = new clsField("site_sla", ccsText, "");
        
        $this->site_offhours = new clsField("site_offhours", ccsText, "");
        
        $this->lblNotes = new clsField("lblNotes", ccsText, "");
        

        $this->InsertFields["site_code"] = array("Name" => "site_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_name"] = array("Name" => "site_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_lat"] = array("Name" => "site_lat", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_offnumber"] = array("Name" => "site_offnumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["site_long"] = array("Name" => "site_long", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_state"] = array("Name" => "site_state", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_region"] = array("Name" => "site_region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_faxnumber"] = array("Name" => "site_faxnumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["site_address"] = array("Name" => "site_address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["site_sla"] = array("Name" => "site_sla", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["site_offhours"] = array("Name" => "site_offhours", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_code"] = array("Name" => "site_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_name"] = array("Name" => "site_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_lat"] = array("Name" => "site_lat", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_offnumber"] = array("Name" => "site_offnumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_long"] = array("Name" => "site_long", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_state"] = array("Name" => "site_state", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_region"] = array("Name" => "site_region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_faxnumber"] = array("Name" => "site_faxnumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_address"] = array("Name" => "site_address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_sla"] = array("Name" => "site_sla", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_offhours"] = array("Name" => "site_offhours", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @34-BCB67732
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlsid", ccsInteger, "", "", $this->Parameters["urlsid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @34-9EA5868C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_site {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @34-547A4EEC
    function SetValues()
    {
        $this->site_code->SetDBValue($this->f("site_code"));
        $this->site_name->SetDBValue($this->f("site_name"));
        $this->site_lat->SetDBValue($this->f("site_lat"));
        $this->site_offnumber->SetDBValue(trim($this->f("site_offnumber")));
        $this->site_long->SetDBValue($this->f("site_long"));
        $this->site_state->SetDBValue($this->f("site_state"));
        $this->site_region->SetDBValue($this->f("site_region"));
        $this->site_faxnumber->SetDBValue(trim($this->f("site_faxnumber")));
        $this->site_address->SetDBValue($this->f("site_address"));
        $this->site_sla->SetDBValue($this->f("site_sla"));
        $this->site_offhours->SetDBValue($this->f("site_offhours"));
    }
//End SetValues Method

//Insert Method @34-AE527A4E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["site_code"]["Value"] = $this->site_code->GetDBValue(true);
        $this->InsertFields["site_name"]["Value"] = $this->site_name->GetDBValue(true);
        $this->InsertFields["site_lat"]["Value"] = $this->site_lat->GetDBValue(true);
        $this->InsertFields["site_offnumber"]["Value"] = $this->site_offnumber->GetDBValue(true);
        $this->InsertFields["site_long"]["Value"] = $this->site_long->GetDBValue(true);
        $this->InsertFields["site_state"]["Value"] = $this->site_state->GetDBValue(true);
        $this->InsertFields["site_region"]["Value"] = $this->site_region->GetDBValue(true);
        $this->InsertFields["site_faxnumber"]["Value"] = $this->site_faxnumber->GetDBValue(true);
        $this->InsertFields["site_address"]["Value"] = $this->site_address->GetDBValue(true);
        $this->InsertFields["site_sla"]["Value"] = $this->site_sla->GetDBValue(true);
        $this->InsertFields["site_offhours"]["Value"] = $this->site_offhours->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_site", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @34-53FA39C0
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["site_code"]["Value"] = $this->site_code->GetDBValue(true);
        $this->UpdateFields["site_name"]["Value"] = $this->site_name->GetDBValue(true);
        $this->UpdateFields["site_lat"]["Value"] = $this->site_lat->GetDBValue(true);
        $this->UpdateFields["site_offnumber"]["Value"] = $this->site_offnumber->GetDBValue(true);
        $this->UpdateFields["site_long"]["Value"] = $this->site_long->GetDBValue(true);
        $this->UpdateFields["site_state"]["Value"] = $this->site_state->GetDBValue(true);
        $this->UpdateFields["site_region"]["Value"] = $this->site_region->GetDBValue(true);
        $this->UpdateFields["site_faxnumber"]["Value"] = $this->site_faxnumber->GetDBValue(true);
        $this->UpdateFields["site_address"]["Value"] = $this->site_address->GetDBValue(true);
        $this->UpdateFields["site_sla"]["Value"] = $this->site_sla->GetDBValue(true);
        $this->UpdateFields["site_offhours"]["Value"] = $this->site_offhours->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_site", $this->UpdateFields, $this);
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

} //End RSiteDataSource Class @34-FCB6E20C

class clsEditableGridGSiteContact { //GSiteContact Class @73-782C777D

//Variables @73-409B32B9

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $StoredValues;
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

//Class_Initialize Event @73-F9A55993
    function clsEditableGridGSiteContact($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GSiteContact/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GSiteContact";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGSiteContactDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
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
        $this->DeleteAllowed = true;
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
        $this->sc_name = & new clsControl(ccsTextBox, "sc_name", "Name", ccsText, "", NULL, $this);
        $this->sc_name->Required = true;
        $this->sc_position = & new clsControl(ccsListBox, "sc_position", "Position", ccsText, "", NULL, $this);
        $this->sc_department = & new clsControl(ccsListBox, "sc_department", "Department", ccsText, "", NULL, $this);
        $this->sc_department->DSType = dsTable;
        $this->sc_department->DataSource = new clsDBSMART();
        $this->sc_department->ds = & $this->sc_department->DataSource;
        $this->sc_department->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
        list($this->sc_department->BoundColumn, $this->sc_department->TextColumn, $this->sc_department->DBFormat) = array("ref_value", "ref_description", "");
        $this->sc_department->DataSource->Parameters["expr111"] = sitedept;
        $this->sc_department->DataSource->wp = new clsSQLParameters();
        $this->sc_department->DataSource->wp->AddParameter("1", "expr111", ccsText, "", "", $this->sc_department->DataSource->Parameters["expr111"], "", false);
        $this->sc_department->DataSource->wp->Criterion[1] = $this->sc_department->DataSource->wp->Operation(opEqual, "ref_type", $this->sc_department->DataSource->wp->GetDBValue("1"), $this->sc_department->DataSource->ToSQL($this->sc_department->DataSource->wp->GetDBValue("1"), ccsText),false);
        $this->sc_department->DataSource->Where = 
             $this->sc_department->DataSource->wp->Criterion[1];
        $this->sc_department->Required = true;
        $this->sc_mobile = & new clsControl(ccsTextBox, "sc_mobile", "Mobile", ccsText, "", NULL, $this);
        $this->sc_email = & new clsControl(ccsTextBox, "sc_email", "Email", ccsText, "", NULL, $this);
        $this->sc_email->Required = true;
        $this->sc_facebook = & new clsControl(ccsTextBox, "sc_facebook", "Sc Facebook", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->sc_sitecode = & new clsControl(ccsHidden, "sc_sitecode", "Sitecode", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @73-07E5A960
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlscode"] = CCGetFromGet("scode", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @73-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @73-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @73-C4878430
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["sc_name"][$RowNumber] = CCGetFromPost("sc_name_" . $RowNumber, NULL);
            $this->FormParameters["sc_position"][$RowNumber] = CCGetFromPost("sc_position_" . $RowNumber, NULL);
            $this->FormParameters["sc_department"][$RowNumber] = CCGetFromPost("sc_department_" . $RowNumber, NULL);
            $this->FormParameters["sc_mobile"][$RowNumber] = CCGetFromPost("sc_mobile_" . $RowNumber, NULL);
            $this->FormParameters["sc_email"][$RowNumber] = CCGetFromPost("sc_email_" . $RowNumber, NULL);
            $this->FormParameters["sc_facebook"][$RowNumber] = CCGetFromPost("sc_facebook_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["sc_sitecode"][$RowNumber] = CCGetFromPost("sc_sitecode_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @73-31A6EACC
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $this->StoredValues = array();

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->sc_name->SetText($this->FormParameters["sc_name"][$this->RowNumber], $this->RowNumber);
            $this->sc_position->SetText($this->FormParameters["sc_position"][$this->RowNumber], $this->RowNumber);
            $this->sc_department->SetText($this->FormParameters["sc_department"][$this->RowNumber], $this->RowNumber);
            $this->sc_mobile->SetText($this->FormParameters["sc_mobile"][$this->RowNumber], $this->RowNumber);
            $this->sc_email->SetText($this->FormParameters["sc_email"][$this->RowNumber], $this->RowNumber);
            $this->sc_facebook->SetText($this->FormParameters["sc_facebook"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->sc_sitecode->SetText($this->FormParameters["sc_sitecode"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @73-58B612FA
    function ValidateRow()
    {
        global $CCSLocales;
        if(strlen($this->CachedColumns["id"][$this->RowNumber])) 
            $Where = " AND id <> " . $this->DataSource->ToSQL($this->CachedColumns["id"][$this->RowNumber], ccsInteger); 
        else
            $Where = "";
        if (!isset($this->StoredValues["sc_email"])) $this->StoredValues["sc_email"] = array();
        $this->DataSource->sc_email->SetValue($this->sc_email->GetValue());
        if(CCDLookUp("COUNT(*)", "smart_sitecontact", "sc_email=" . $this->DataSource->ToSQL($this->DataSource->sc_email->GetDBValue(), $this->DataSource->sc_email->DataType) . $Where, $this->DataSource) > 0)
            $this->sc_email->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Email"));
        else if (in_array($this->sc_email->GetValue(), $this->StoredValues["sc_email"]))
            $this->sc_email->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Email"));
        $this->StoredValues["sc_email"][] = $this->sc_email->GetValue();
        if(strlen($this->sc_email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->sc_email->GetText())) {
            $this->sc_email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email"));
        }
        $this->sc_name->Validate();
        $this->sc_position->Validate();
        $this->sc_department->Validate();
        $this->sc_mobile->Validate();
        $this->sc_email->Validate();
        $this->sc_facebook->Validate();
        $this->CheckBox_Delete->Validate();
        $this->sc_sitecode->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->sc_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_position->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_department->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_mobile->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_facebook->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sc_sitecode->Errors->ToString());
        $this->sc_name->Errors->Clear();
        $this->sc_position->Errors->Clear();
        $this->sc_department->Errors->Clear();
        $this->sc_mobile->Errors->Clear();
        $this->sc_email->Errors->Clear();
        $this->sc_facebook->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->sc_sitecode->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @73-766474F3
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["sc_name"][$this->RowNumber]) && count($this->FormParameters["sc_name"][$this->RowNumber])) || strlen($this->FormParameters["sc_name"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_position"][$this->RowNumber]) && count($this->FormParameters["sc_position"][$this->RowNumber])) || strlen($this->FormParameters["sc_position"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_department"][$this->RowNumber]) && count($this->FormParameters["sc_department"][$this->RowNumber])) || strlen($this->FormParameters["sc_department"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_mobile"][$this->RowNumber]) && count($this->FormParameters["sc_mobile"][$this->RowNumber])) || strlen($this->FormParameters["sc_mobile"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_email"][$this->RowNumber]) && count($this->FormParameters["sc_email"][$this->RowNumber])) || strlen($this->FormParameters["sc_email"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_facebook"][$this->RowNumber]) && count($this->FormParameters["sc_facebook"][$this->RowNumber])) || strlen($this->FormParameters["sc_facebook"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sc_sitecode"][$this->RowNumber]) && count($this->FormParameters["sc_sitecode"][$this->RowNumber])) || strlen($this->FormParameters["sc_sitecode"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @73-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @73-909F269B
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
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @73-5D24CE17
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->sc_name->SetText($this->FormParameters["sc_name"][$this->RowNumber], $this->RowNumber);
            $this->sc_position->SetText($this->FormParameters["sc_position"][$this->RowNumber], $this->RowNumber);
            $this->sc_department->SetText($this->FormParameters["sc_department"][$this->RowNumber], $this->RowNumber);
            $this->sc_mobile->SetText($this->FormParameters["sc_mobile"][$this->RowNumber], $this->RowNumber);
            $this->sc_email->SetText($this->FormParameters["sc_email"][$this->RowNumber], $this->RowNumber);
            $this->sc_facebook->SetText($this->FormParameters["sc_facebook"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->sc_sitecode->SetText($this->FormParameters["sc_sitecode"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
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

//InsertRow Method @73-672A0D47
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->sc_sitecode->SetValue($this->sc_sitecode->GetValue(true));
        $this->DataSource->sc_name->SetValue($this->sc_name->GetValue(true));
        $this->DataSource->sc_position->SetValue($this->sc_position->GetValue(true));
        $this->DataSource->sc_department->SetValue($this->sc_department->GetValue(true));
        $this->DataSource->sc_mobile->SetValue($this->sc_mobile->GetValue(true));
        $this->DataSource->sc_email->SetValue($this->sc_email->GetValue(true));
        $this->DataSource->sc_facebook->SetValue($this->sc_facebook->GetValue(true));
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

//UpdateRow Method @73-AFCEAE4F
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->sc_sitecode->SetValue($this->sc_sitecode->GetValue(true));
        $this->DataSource->sc_name->SetValue($this->sc_name->GetValue(true));
        $this->DataSource->sc_position->SetValue($this->sc_position->GetValue(true));
        $this->DataSource->sc_department->SetValue($this->sc_department->GetValue(true));
        $this->DataSource->sc_mobile->SetValue($this->sc_mobile->GetValue(true));
        $this->DataSource->sc_email->SetValue($this->sc_email->GetValue(true));
        $this->DataSource->sc_facebook->SetValue($this->sc_facebook->GetValue(true));
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

//DeleteRow Method @73-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @73-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @73-0EEA5586
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

//GetFormState Method @73-692238C5
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

//Show Method @73-DD192FEB
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->sc_position->Prepare();
        $this->sc_department->Prepare();

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
        $this->ControlsVisible["sc_name"] = $this->sc_name->Visible;
        $this->ControlsVisible["sc_position"] = $this->sc_position->Visible;
        $this->ControlsVisible["sc_department"] = $this->sc_department->Visible;
        $this->ControlsVisible["sc_mobile"] = $this->sc_mobile->Visible;
        $this->ControlsVisible["sc_email"] = $this->sc_email->Visible;
        $this->ControlsVisible["sc_facebook"] = $this->sc_facebook->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["sc_sitecode"] = $this->sc_sitecode->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->sc_name->SetValue($this->DataSource->sc_name->GetValue());
                    $this->sc_position->SetValue($this->DataSource->sc_position->GetValue());
                    $this->sc_department->SetValue($this->DataSource->sc_department->GetValue());
                    $this->sc_mobile->SetValue($this->DataSource->sc_mobile->GetValue());
                    $this->sc_email->SetValue($this->DataSource->sc_email->GetValue());
                    $this->sc_facebook->SetValue($this->DataSource->sc_facebook->GetValue());
                    $this->sc_sitecode->SetValue($this->DataSource->sc_sitecode->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->sc_name->SetText($this->FormParameters["sc_name"][$this->RowNumber], $this->RowNumber);
                    $this->sc_position->SetText($this->FormParameters["sc_position"][$this->RowNumber], $this->RowNumber);
                    $this->sc_department->SetText($this->FormParameters["sc_department"][$this->RowNumber], $this->RowNumber);
                    $this->sc_mobile->SetText($this->FormParameters["sc_mobile"][$this->RowNumber], $this->RowNumber);
                    $this->sc_email->SetText($this->FormParameters["sc_email"][$this->RowNumber], $this->RowNumber);
                    $this->sc_facebook->SetText($this->FormParameters["sc_facebook"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->sc_sitecode->SetText($this->FormParameters["sc_sitecode"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->lblNumber->SetText("");
                    $this->sc_name->SetText("");
                    $this->sc_position->SetText("");
                    $this->sc_department->SetText("");
                    $this->sc_mobile->SetText("");
                    $this->sc_email->SetText("");
                    $this->sc_facebook->SetText("");
                    $this->sc_sitecode->SetText("");
                } else {
                    $this->lblNumber->SetText("");
                    $this->sc_name->SetText($this->FormParameters["sc_name"][$this->RowNumber], $this->RowNumber);
                    $this->sc_position->SetText($this->FormParameters["sc_position"][$this->RowNumber], $this->RowNumber);
                    $this->sc_department->SetText($this->FormParameters["sc_department"][$this->RowNumber], $this->RowNumber);
                    $this->sc_mobile->SetText($this->FormParameters["sc_mobile"][$this->RowNumber], $this->RowNumber);
                    $this->sc_email->SetText($this->FormParameters["sc_email"][$this->RowNumber], $this->RowNumber);
                    $this->sc_facebook->SetText($this->FormParameters["sc_facebook"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->sc_sitecode->SetText($this->FormParameters["sc_sitecode"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show($this->RowNumber);
                $this->sc_name->Show($this->RowNumber);
                $this->sc_position->Show($this->RowNumber);
                $this->sc_department->Show($this->RowNumber);
                $this->sc_mobile->Show($this->RowNumber);
                $this->sc_email->Show($this->RowNumber);
                $this->sc_facebook->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                $this->sc_sitecode->Show($this->RowNumber);
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

} //End GSiteContact Class @73-FCB6E20C

class clsGSiteContactDataSource extends clsDBSMART {  //GSiteContactDataSource Class @73-49B0DFF3

//DataSource Variables @73-874D738A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $lblNumber;
    var $sc_name;
    var $sc_position;
    var $sc_department;
    var $sc_mobile;
    var $sc_email;
    var $sc_facebook;
    var $CheckBox_Delete;
    var $sc_sitecode;
//End DataSource Variables

//DataSourceClass_Initialize Event @73-7A0A414C
    function clsGSiteContactDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GSiteContact/Error";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->sc_name = new clsField("sc_name", ccsText, "");
        
        $this->sc_position = new clsField("sc_position", ccsText, "");
        
        $this->sc_department = new clsField("sc_department", ccsText, "");
        
        $this->sc_mobile = new clsField("sc_mobile", ccsText, "");
        
        $this->sc_email = new clsField("sc_email", ccsText, "");
        
        $this->sc_facebook = new clsField("sc_facebook", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->sc_sitecode = new clsField("sc_sitecode", ccsText, "");
        

        $this->InsertFields["sc_sitecode"] = array("Name" => "sc_sitecode", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_name"] = array("Name" => "sc_name", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_position"] = array("Name" => "sc_position", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_department"] = array("Name" => "sc_department", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_mobile"] = array("Name" => "sc_mobile", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_email"] = array("Name" => "sc_email", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["sc_facebook"] = array("Name" => "sc_facebook", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_sitecode"] = array("Name" => "sc_sitecode", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_name"] = array("Name" => "sc_name", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_position"] = array("Name" => "sc_position", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_department"] = array("Name" => "sc_department", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_mobile"] = array("Name" => "sc_mobile", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_email"] = array("Name" => "sc_email", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["sc_facebook"] = array("Name" => "sc_facebook", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @73-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @73-82B7B30A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlscode", ccsText, "", "", $this->Parameters["urlscode"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "sc_sitecode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @73-C4028719
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_sitecontact";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_sitecontact {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @73-57CE19C9
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->sc_name->SetDBValue($this->f("sc_name"));
        $this->sc_position->SetDBValue($this->f("sc_position"));
        $this->sc_department->SetDBValue($this->f("sc_department"));
        $this->sc_mobile->SetDBValue($this->f("sc_mobile"));
        $this->sc_email->SetDBValue($this->f("sc_email"));
        $this->sc_facebook->SetDBValue($this->f("sc_facebook"));
        $this->sc_sitecode->SetDBValue($this->f("sc_sitecode"));
    }
//End SetValues Method

//Insert Method @73-73DC5142
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["sc_sitecode"] = new clsSQLParameter("ctrlsc_sitecode", ccsText, "", "", $this->sc_sitecode->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_name"] = new clsSQLParameter("ctrlsc_name", ccsText, "", "", $this->sc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_position"] = new clsSQLParameter("ctrlsc_position", ccsText, "", "", $this->sc_position->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_department"] = new clsSQLParameter("ctrlsc_department", ccsText, "", "", $this->sc_department->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_mobile"] = new clsSQLParameter("ctrlsc_mobile", ccsText, "", "", $this->sc_mobile->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_email"] = new clsSQLParameter("ctrlsc_email", ccsText, "", "", $this->sc_email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_facebook"] = new clsSQLParameter("ctrlsc_facebook", ccsText, "", "", $this->sc_facebook->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["sc_sitecode"]->GetValue()) and !strlen($this->cp["sc_sitecode"]->GetText()) and !is_bool($this->cp["sc_sitecode"]->GetValue())) 
            $this->cp["sc_sitecode"]->SetValue($this->sc_sitecode->GetValue(true));
        if (!is_null($this->cp["sc_name"]->GetValue()) and !strlen($this->cp["sc_name"]->GetText()) and !is_bool($this->cp["sc_name"]->GetValue())) 
            $this->cp["sc_name"]->SetValue($this->sc_name->GetValue(true));
        if (!is_null($this->cp["sc_position"]->GetValue()) and !strlen($this->cp["sc_position"]->GetText()) and !is_bool($this->cp["sc_position"]->GetValue())) 
            $this->cp["sc_position"]->SetValue($this->sc_position->GetValue(true));
        if (!is_null($this->cp["sc_department"]->GetValue()) and !strlen($this->cp["sc_department"]->GetText()) and !is_bool($this->cp["sc_department"]->GetValue())) 
            $this->cp["sc_department"]->SetValue($this->sc_department->GetValue(true));
        if (!is_null($this->cp["sc_mobile"]->GetValue()) and !strlen($this->cp["sc_mobile"]->GetText()) and !is_bool($this->cp["sc_mobile"]->GetValue())) 
            $this->cp["sc_mobile"]->SetValue($this->sc_mobile->GetValue(true));
        if (!is_null($this->cp["sc_email"]->GetValue()) and !strlen($this->cp["sc_email"]->GetText()) and !is_bool($this->cp["sc_email"]->GetValue())) 
            $this->cp["sc_email"]->SetValue($this->sc_email->GetValue(true));
        if (!is_null($this->cp["sc_facebook"]->GetValue()) and !strlen($this->cp["sc_facebook"]->GetText()) and !is_bool($this->cp["sc_facebook"]->GetValue())) 
            $this->cp["sc_facebook"]->SetValue($this->sc_facebook->GetValue(true));
        $this->InsertFields["sc_sitecode"]["Value"] = $this->cp["sc_sitecode"]->GetDBValue(true);
        $this->InsertFields["sc_name"]["Value"] = $this->cp["sc_name"]->GetDBValue(true);
        $this->InsertFields["sc_position"]["Value"] = $this->cp["sc_position"]->GetDBValue(true);
        $this->InsertFields["sc_department"]["Value"] = $this->cp["sc_department"]->GetDBValue(true);
        $this->InsertFields["sc_mobile"]["Value"] = $this->cp["sc_mobile"]->GetDBValue(true);
        $this->InsertFields["sc_email"]["Value"] = $this->cp["sc_email"]->GetDBValue(true);
        $this->InsertFields["sc_facebook"]["Value"] = $this->cp["sc_facebook"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_sitecontact", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @73-7DD539AD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["sc_sitecode"] = new clsSQLParameter("ctrlsc_sitecode", ccsText, "", "", $this->sc_sitecode->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_name"] = new clsSQLParameter("ctrlsc_name", ccsText, "", "", $this->sc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_position"] = new clsSQLParameter("ctrlsc_position", ccsText, "", "", $this->sc_position->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_department"] = new clsSQLParameter("ctrlsc_department", ccsText, "", "", $this->sc_department->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_mobile"] = new clsSQLParameter("ctrlsc_mobile", ccsText, "", "", $this->sc_mobile->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_email"] = new clsSQLParameter("ctrlsc_email", ccsText, "", "", $this->sc_email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["sc_facebook"] = new clsSQLParameter("ctrlsc_facebook", ccsText, "", "", $this->sc_facebook->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsid", ccsInteger, "", "", $this->CachedColumns["id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["sc_sitecode"]->GetValue()) and !strlen($this->cp["sc_sitecode"]->GetText()) and !is_bool($this->cp["sc_sitecode"]->GetValue())) 
            $this->cp["sc_sitecode"]->SetValue($this->sc_sitecode->GetValue(true));
        if (!is_null($this->cp["sc_name"]->GetValue()) and !strlen($this->cp["sc_name"]->GetText()) and !is_bool($this->cp["sc_name"]->GetValue())) 
            $this->cp["sc_name"]->SetValue($this->sc_name->GetValue(true));
        if (!is_null($this->cp["sc_position"]->GetValue()) and !strlen($this->cp["sc_position"]->GetText()) and !is_bool($this->cp["sc_position"]->GetValue())) 
            $this->cp["sc_position"]->SetValue($this->sc_position->GetValue(true));
        if (!is_null($this->cp["sc_department"]->GetValue()) and !strlen($this->cp["sc_department"]->GetText()) and !is_bool($this->cp["sc_department"]->GetValue())) 
            $this->cp["sc_department"]->SetValue($this->sc_department->GetValue(true));
        if (!is_null($this->cp["sc_mobile"]->GetValue()) and !strlen($this->cp["sc_mobile"]->GetText()) and !is_bool($this->cp["sc_mobile"]->GetValue())) 
            $this->cp["sc_mobile"]->SetValue($this->sc_mobile->GetValue(true));
        if (!is_null($this->cp["sc_email"]->GetValue()) and !strlen($this->cp["sc_email"]->GetText()) and !is_bool($this->cp["sc_email"]->GetValue())) 
            $this->cp["sc_email"]->SetValue($this->sc_email->GetValue(true));
        if (!is_null($this->cp["sc_facebook"]->GetValue()) and !strlen($this->cp["sc_facebook"]->GetText()) and !is_bool($this->cp["sc_facebook"]->GetValue())) 
            $this->cp["sc_facebook"]->SetValue($this->sc_facebook->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["sc_sitecode"]["Value"] = $this->cp["sc_sitecode"]->GetDBValue(true);
        $this->UpdateFields["sc_name"]["Value"] = $this->cp["sc_name"]->GetDBValue(true);
        $this->UpdateFields["sc_position"]["Value"] = $this->cp["sc_position"]->GetDBValue(true);
        $this->UpdateFields["sc_department"]["Value"] = $this->cp["sc_department"]->GetDBValue(true);
        $this->UpdateFields["sc_mobile"]["Value"] = $this->cp["sc_mobile"]->GetDBValue(true);
        $this->UpdateFields["sc_email"]["Value"] = $this->cp["sc_email"]->GetDBValue(true);
        $this->UpdateFields["sc_facebook"]["Value"] = $this->cp["sc_facebook"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_sitecontact", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @73-FE3252DE
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsid", ccsInteger, "", "", $this->CachedColumns["id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM smart_sitecontact";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End GSiteContactDataSource Class @73-FCB6E20C

//Initialize Page @1-ED58AE0D
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
$TemplateFileName = "smartsite.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-56EEEEE7
include_once("./smartsite_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-90E06107
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GSite = & new clsGridGSite("", $MainPage);
$SSite = & new clsRecordSSite("", $MainPage);
$RSite = & new clsRecordRSite("", $MainPage);
$GSiteContact = & new clsEditableGridGSiteContact("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GSite = & $GSite;
$MainPage->SSite = & $SSite;
$MainPage->RSite = & $RSite;
$MainPage->GSiteContact = & $GSiteContact;
$GSite->Initialize();
$RSite->Initialize();
$GSiteContact->Initialize();

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

//Execute Components @1-6D31D5BE
$header->Operations();
$footer->Operations();
$SSite->Operation();
$RSite->Operation();
$GSiteContact->Operation();
//End Execute Components

//Go to destination page @1-84D152C2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GSite);
    unset($SSite);
    unset($RSite);
    unset($GSiteContact);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-70AB5B04
$header->Show();
$footer->Show();
$GSite->Show();
$SSite->Show();
$RSite->Show();
$GSiteContact->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5936EE82
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GSite);
unset($SSite);
unset($RSite);
unset($GSiteContact);
unset($Tpl);
//End Unload Page


?>
