<?php
//Include Common Files @1-BF704821
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "pmlist.php");
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

class clsGridGSmartPreventive { //GSmartPreventive class @5-D9010EF1

//Variables @5-242ED193

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
    var $Sorter_tckt_date;
    var $Sorter_tckt_branch;
    var $Sorter_tckt_etd;
    var $Sorter_tckt_toppanid;
    var $Sorter_tckt_eta;
//End Variables

//Class_Initialize Event @5-F47D7808
    function clsGridGSmartPreventive($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSmartPreventive";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSmartPreventive";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSmartPreventiveDataSource($this);
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
        $this->SorterName = CCGetParam("GSmartPreventiveOrder", "");
        $this->SorterDirection = CCGetParam("GSmartPreventiveDir", "");

        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->prvt_date = & new clsControl(ccsLink, "prvt_date", "prvt_date", ccsDate, array("GeneralDate"), CCGetRequestParam("prvt_date", ccsGet, NULL), $this);
        $this->prvt_date->Page = "pmactivity.php";
        $this->prvt_branch = & new clsControl(ccsLabel, "prvt_branch", "prvt_branch", ccsText, "", CCGetRequestParam("prvt_branch", ccsGet, NULL), $this);
        $this->prvt_etd = & new clsControl(ccsLabel, "prvt_etd", "prvt_etd", ccsDate, array("GeneralDate"), CCGetRequestParam("prvt_etd", ccsGet, NULL), $this);
        $this->prvt_toppanid = & new clsControl(ccsLabel, "prvt_toppanid", "prvt_toppanid", ccsText, "", CCGetRequestParam("prvt_toppanid", ccsGet, NULL), $this);
        $this->prvt_eta = & new clsControl(ccsLabel, "prvt_eta", "prvt_eta", ccsDate, array("GeneralDate"), CCGetRequestParam("prvt_eta", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->prvt_state = & new clsControl(ccsHidden, "prvt_state", "prvt_state", ccsText, "", CCGetRequestParam("prvt_state", ccsGet, NULL), $this);
        $this->tcktEng2 = & new clsControl(ccsLabel, "tcktEng2", "tcktEng2", ccsText, "", CCGetRequestParam("tcktEng2", ccsGet, NULL), $this);
        $this->tcktEng1 = & new clsControl(ccsLabel, "tcktEng1", "tcktEng1", ccsText, "", CCGetRequestParam("tcktEng1", ccsGet, NULL), $this);
        $this->refnumber = & new clsControl(ccsLabel, "refnumber", "refnumber", ccsText, "", CCGetRequestParam("refnumber", ccsGet, NULL), $this);
        $this->GSmartPreventive_TotalRecords = & new clsControl(ccsLabel, "GSmartPreventive_TotalRecords", "GSmartPreventive_TotalRecords", ccsText, "", CCGetRequestParam("GSmartPreventive_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_tckt_date = & new clsSorter($this->ComponentName, "Sorter_tckt_date", $FileName, $this);
        $this->Sorter_tckt_branch = & new clsSorter($this->ComponentName, "Sorter_tckt_branch", $FileName, $this);
        $this->Sorter_tckt_etd = & new clsSorter($this->ComponentName, "Sorter_tckt_etd", $FileName, $this);
        $this->Sorter_tckt_toppanid = & new clsSorter($this->ComponentName, "Sorter_tckt_toppanid", $FileName, $this);
        $this->Sorter_tckt_eta = & new clsSorter($this->ComponentName, "Sorter_tckt_eta", $FileName, $this);
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

//Show Method @5-F3F20D25
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_sdate"] = CCGetFromGet("s_sdate", NULL);
        $this->DataSource->Parameters["urls_edate"] = CCGetFromGet("s_edate", NULL);

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
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["prvt_date"] = $this->prvt_date->Visible;
            $this->ControlsVisible["prvt_branch"] = $this->prvt_branch->Visible;
            $this->ControlsVisible["prvt_etd"] = $this->prvt_etd->Visible;
            $this->ControlsVisible["prvt_toppanid"] = $this->prvt_toppanid->Visible;
            $this->ControlsVisible["prvt_eta"] = $this->prvt_eta->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["prvt_state"] = $this->prvt_state->Visible;
            $this->ControlsVisible["tcktEng2"] = $this->tcktEng2->Visible;
            $this->ControlsVisible["tcktEng1"] = $this->tcktEng1->Visible;
            $this->ControlsVisible["refnumber"] = $this->refnumber->Visible;
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
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->prvt_date->SetValue($this->DataSource->prvt_date->GetValue());
                $this->prvt_date->Parameters = CCGetQueryString("QueryString", array("GSmartPreventivePage", "ccsForm"));
                $this->prvt_date->Parameters = CCAddParam($this->prvt_date->Parameters, "pmid", $this->DataSource->f("id"));
                $this->prvt_date->Parameters = CCAddParam($this->prvt_date->Parameters, "rf", $this->DataSource->f("prvt_refnumber"));
                $this->prvt_branch->SetValue($this->DataSource->prvt_branch->GetValue());
                $this->prvt_etd->SetValue($this->DataSource->prvt_etd->GetValue());
                $this->prvt_toppanid->SetValue($this->DataSource->prvt_toppanid->GetValue());
                $this->prvt_eta->SetValue($this->DataSource->prvt_eta->GetValue());
                $this->prvt_state->SetValue($this->DataSource->prvt_state->GetValue());
                $this->tcktEng2->SetValue($this->DataSource->tcktEng2->GetValue());
                $this->tcktEng1->SetValue($this->DataSource->tcktEng1->GetValue());
                $this->refnumber->SetValue($this->DataSource->refnumber->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->prvt_date->Show();
                $this->prvt_branch->Show();
                $this->prvt_etd->Show();
                $this->prvt_toppanid->Show();
                $this->prvt_eta->Show();
                $this->lblNumber->Show();
                $this->prvt_state->Show();
                $this->tcktEng2->Show();
                $this->tcktEng1->Show();
                $this->refnumber->Show();
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
        $this->GSmartPreventive_TotalRecords->Show();
        $this->Sorter_tckt_date->Show();
        $this->Sorter_tckt_branch->Show();
        $this->Sorter_tckt_etd->Show();
        $this->Sorter_tckt_toppanid->Show();
        $this->Sorter_tckt_eta->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-66107B2C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_etd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_toppanid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_eta->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktEng2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktEng1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSmartPreventive Class @5-FCB6E20C

class clsGSmartPreventiveDataSource extends clsDBSMART {  //GSmartPreventiveDataSource Class @5-BA50EC1A

//DataSource Variables @5-9F16C97E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $prvt_date;
    var $prvt_branch;
    var $prvt_etd;
    var $prvt_toppanid;
    var $prvt_eta;
    var $prvt_state;
    var $tcktEng2;
    var $tcktEng1;
    var $refnumber;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-5E03F8ED
    function clsGSmartPreventiveDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSmartPreventive";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->prvt_date = new clsField("prvt_date", ccsDate, $this->DateFormat);
        
        $this->prvt_branch = new clsField("prvt_branch", ccsText, "");
        
        $this->prvt_etd = new clsField("prvt_etd", ccsDate, $this->DateFormat);
        
        $this->prvt_toppanid = new clsField("prvt_toppanid", ccsText, "");
        
        $this->prvt_eta = new clsField("prvt_eta", ccsDate, $this->DateFormat);
        
        $this->prvt_state = new clsField("prvt_state", ccsText, "");
        
        $this->tcktEng2 = new clsField("tcktEng2", ccsText, "");
        
        $this->tcktEng1 = new clsField("tcktEng1", ccsText, "");
        
        $this->refnumber = new clsField("refnumber", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-ECC84339
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "prvt_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tckt_date" => array("prvt_date", ""), 
            "Sorter_tckt_branch" => array("tckt_branch", ""), 
            "Sorter_tckt_etd" => array("prvt_etd", ""), 
            "Sorter_tckt_toppanid" => array("tckt_toppanid", ""), 
            "Sorter_tckt_eta" => array("prvt_eta", "")));
    }
//End SetOrder Method

//Prepare Method @5-DC46224C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_sdate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_sdate"], "", false);
        $this->wp->AddParameter("2", "urls_edate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_edate"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opGreaterThanOrEqual, "prvt_date", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsDate),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opLessThanOrEqual, "prvt_date", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-67601655
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_preventive";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_preventive {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-DA2EDE34
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->prvt_date->SetDBValue(trim($this->f("prvt_date")));
        $this->prvt_branch->SetDBValue($this->f("prvt_site"));
        $this->prvt_etd->SetDBValue(trim($this->f("prvt_etd")));
        $this->prvt_toppanid->SetDBValue($this->f("prvt_toppanid"));
        $this->prvt_eta->SetDBValue(trim($this->f("prvt_eta")));
        $this->prvt_state->SetDBValue($this->f("prvt_state"));
        $this->tcktEng2->SetDBValue($this->f("prvt_byuser2"));
        $this->tcktEng1->SetDBValue($this->f("prvt_byuser"));
        $this->refnumber->SetDBValue($this->f("prvt_refnumber"));
    }
//End SetValues Method

} //End GSmartPreventiveDataSource Class @5-FCB6E20C

class clsRecordSearch { //Search Class @6-39E8735D

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

//Class_Initialize Event @6-1F936524
    function clsRecordSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_sdate = & new clsControl(ccsTextBox, "s_sdate", "s_sdate", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_sdate", $Method, NULL), $this);
            $this->DatePicker_s_sdate = & new clsDatePicker("DatePicker_s_sdate", "Search", "s_sdate", $this);
            $this->s_edate = & new clsControl(ccsTextBox, "s_edate", "s_edate", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_edate", $Method, NULL), $this);
            $this->DatePicker_s_edate = & new clsDatePicker("DatePicker_s_edate", "Search", "s_edate", $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @6-3524042A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_sdate->Validate() && $Validation);
        $Validation = ($this->s_edate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_sdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_edate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-29D0D0B3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_sdate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_sdate->Errors->Count());
        $errors = ($errors || $this->s_edate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_edate->Errors->Count());
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

//Operation Method @6-6BC97A6A
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
        $Redirect = "pmlist.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "pmlist.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-BD6200B4
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_sdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_sdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_edate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_edate->Errors->ToString());
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

        $this->s_sdate->Show();
        $this->DatePicker_s_sdate->Show();
        $this->s_edate->Show();
        $this->DatePicker_s_edate->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @6-FCB6E20C

//Initialize Page @1-5619D415
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
$TemplateFileName = "pmlist.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CA4CDCA7
include_once("./pmlist_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-316C1C26
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GSmartPreventive = & new clsGridGSmartPreventive("", $MainPage);
$Search = & new clsRecordSearch("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GSmartPreventive = & $GSmartPreventive;
$MainPage->Search = & $Search;
$GSmartPreventive->Initialize();

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

//Execute Components @1-AC33E2F9
$header->Operations();
$footer->Operations();
$Search->Operation();
//End Execute Components

//Go to destination page @1-08FBCEBE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GSmartPreventive);
    unset($Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6CC81865
$header->Show();
$footer->Show();
$GSmartPreventive->Show();
$Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6B076C28
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GSmartPreventive);
unset($Search);
unset($Tpl);
//End Unload Page


?>
