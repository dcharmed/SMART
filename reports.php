<?php
//Include Common Files @1-597EB544
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "reports.php");
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

class clsRecordOptionReport { //OptionReport Class @5-5E19B7D1

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

//Class_Initialize Event @5-0E217E1F
    function clsRecordOptionReport($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record OptionReport/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "OptionReport";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->opt = & new clsControl(ccsListBox, "opt", "opt", ccsText, "", CCGetRequestParam("opt", $Method, NULL), $this);
            $this->opt->DSType = dsTable;
            $this->opt->DataSource = new clsDBSMART();
            $this->opt->ds = & $this->opt->DataSource;
            $this->opt->DataSource->SQL = "SELECT * \n" .
"FROM smart_reportsopt {SQL_Where} {SQL_OrderBy}";
            list($this->opt->BoundColumn, $this->opt->TextColumn, $this->opt->DBFormat) = array("opt_value", "opt_description", "");
            $this->opt->DataSource->Parameters["expr10"] = type;
            $this->opt->DataSource->wp = new clsSQLParameters();
            $this->opt->DataSource->wp->AddParameter("1", "expr10", ccsText, "", "", $this->opt->DataSource->Parameters["expr10"], "", false);
            $this->opt->DataSource->wp->Criterion[1] = $this->opt->DataSource->wp->Operation(opEqual, "opt_type", $this->opt->DataSource->wp->GetDBValue("1"), $this->opt->DataSource->ToSQL($this->opt->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->opt->DataSource->Where = 
                 $this->opt->DataSource->wp->Criterion[1];
            $this->type = & new clsControl(ccsListBox, "type", "type", ccsText, "", CCGetRequestParam("type", $Method, NULL), $this);
            $this->type->DSType = dsTable;
            $this->type->DataSource = new clsDBSMART();
            $this->type->ds = & $this->type->DataSource;
            $this->type->DataSource->SQL = "SELECT * \n" .
"FROM smart_reportsopt {SQL_Where} {SQL_OrderBy}";
            list($this->type->BoundColumn, $this->type->TextColumn, $this->type->DBFormat) = array("opt_value", "opt_description", "");
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @5-647C52B5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->opt->Validate() && $Validation);
        $Validation = ($this->type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->opt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-B21360BA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->opt->Errors->Count());
        $errors = ($errors || $this->type->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @5-E89CCBA1
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
        $Redirect = "reports.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reports.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @5-9D2F21A7
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

        $this->opt->Prepare();
        $this->type->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->opt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->type->Errors->ToString());
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

        $this->opt->Show();
        $this->type->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End OptionReport Class @5-FCB6E20C

class clsRecordCriteriaRpt { //CriteriaRpt Class @15-6BBA7628

//Variables @15-D6FF3E86

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

//Class_Initialize Event @15-9E5C28CD
    function clsRecordCriteriaRpt($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record CriteriaRpt/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "CriteriaRpt";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s = & new clsControl(ccsListBox, "s", "s", ccsText, "", CCGetRequestParam("s", $Method, NULL), $this);
            $this->s->DSType = dsTable;
            $this->s->DataSource = new clsDBSMART();
            $this->s->ds = & $this->s->DataSource;
            $this->s->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s->BoundColumn, $this->s->TextColumn, $this->s->DBFormat) = array("ref_value", "ref_description", "");
            $this->s->DataSource->Parameters["expr30"] = state;
            $this->s->DataSource->wp = new clsSQLParameters();
            $this->s->DataSource->wp->AddParameter("1", "expr30", ccsText, "", "", $this->s->DataSource->Parameters["expr30"], "", false);
            $this->s->DataSource->wp->Criterion[1] = $this->s->DataSource->wp->Operation(opEqual, "ref_type", $this->s->DataSource->wp->GetDBValue("1"), $this->s->DataSource->ToSQL($this->s->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s->DataSource->Where = 
                 $this->s->DataSource->wp->Criterion[1];
            $this->sv = & new clsControl(ccsListBox, "sv", "sv", ccsText, "", CCGetRequestParam("sv", $Method, NULL), $this);
            $this->sv->DSType = dsTable;
            $this->sv->DataSource = new clsDBSMART();
            $this->sv->ds = & $this->sv->DataSource;
            $this->sv->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->sv->BoundColumn, $this->sv->TextColumn, $this->sv->DBFormat) = array("ref_value", "ref_description", "");
            $this->sv->DataSource->Parameters["expr32"] = severity;
            $this->sv->DataSource->wp = new clsSQLParameters();
            $this->sv->DataSource->wp->AddParameter("1", "expr32", ccsText, "", "", $this->sv->DataSource->Parameters["expr32"], "", false);
            $this->sv->DataSource->wp->Criterion[1] = $this->sv->DataSource->wp->Operation(opEqual, "ref_value", $this->sv->DataSource->wp->GetDBValue("1"), $this->sv->DataSource->ToSQL($this->sv->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->sv->DataSource->Where = 
                 $this->sv->DataSource->wp->Criterion[1];
            $this->cat = & new clsControl(ccsListBox, "cat", "cat", ccsText, "", CCGetRequestParam("cat", $Method, NULL), $this);
            $this->cat->DSType = dsTable;
            $this->cat->DataSource = new clsDBSMART();
            $this->cat->ds = & $this->cat->DataSource;
            $this->cat->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->cat->BoundColumn, $this->cat->TextColumn, $this->cat->DBFormat) = array("ref_value", "ref_description", "");
            $this->cat->DataSource->Parameters["expr36"] = probcat;
            $this->cat->DataSource->wp = new clsSQLParameters();
            $this->cat->DataSource->wp->AddParameter("1", "expr36", ccsText, "", "", $this->cat->DataSource->Parameters["expr36"], "", false);
            $this->cat->DataSource->wp->Criterion[1] = $this->cat->DataSource->wp->Operation(opEqual, "ref_type", $this->cat->DataSource->wp->GetDBValue("1"), $this->cat->DataSource->ToSQL($this->cat->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->cat->DataSource->Where = 
                 $this->cat->DataSource->wp->Criterion[1];
            $this->ad = & new clsControl(ccsTextBox, "ad", "ad", ccsText, "", CCGetRequestParam("ad", $Method, NULL), $this);
            $this->rn = & new clsControl(ccsTextBox, "rn", "rn", ccsText, "", CCGetRequestParam("rn", $Method, NULL), $this);
            $this->b = & new clsControl(ccsListBox, "b", "b", ccsText, "", CCGetRequestParam("b", $Method, NULL), $this);
            $this->b->DSType = dsTable;
            $this->b->DataSource = new clsDBSMART();
            $this->b->ds = & $this->b->DataSource;
            $this->b->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->b->BoundColumn, $this->b->TextColumn, $this->b->DBFormat) = array("ref_value", "ref_description", "");
            $this->esc = & new clsControl(ccsListBox, "esc", "esc", ccsText, "", CCGetRequestParam("esc", $Method, NULL), $this);
            $this->esc->DSType = dsTable;
            $this->esc->DataSource = new clsDBSMART();
            $this->esc->ds = & $this->esc->DataSource;
            $this->esc->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->esc->BoundColumn, $this->esc->TextColumn, $this->esc->DBFormat) = array("ref_value", "ref_description", "");
            $this->esc->DataSource->Parameters["expr34"] = esc;
            $this->esc->DataSource->wp = new clsSQLParameters();
            $this->esc->DataSource->wp->AddParameter("1", "expr34", ccsText, "", "", $this->esc->DataSource->Parameters["expr34"], "", false);
            $this->esc->DataSource->wp->Criterion[1] = $this->esc->DataSource->wp->Operation(opEqual, "ref_type", $this->esc->DataSource->wp->GetDBValue("1"), $this->esc->DataSource->ToSQL($this->esc->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->esc->DataSource->Where = 
                 $this->esc->DataSource->wp->Criterion[1];
            $this->scat = & new clsControl(ccsListBox, "scat", "scat", ccsText, "", CCGetRequestParam("scat", $Method, NULL), $this);
            $this->scat->DSType = dsTable;
            $this->scat->DataSource = new clsDBSMART();
            $this->scat->ds = & $this->scat->DataSource;
            $this->scat->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->scat->BoundColumn, $this->scat->TextColumn, $this->scat->DBFormat) = array("ref_value", "ref_description", "");
            $this->set = & new clsControl(ccsHidden, "set", "set", ccsText, "", CCGetRequestParam("set", $Method, NULL), $this);
            $this->month = & new clsControl(ccsListBox, "month", "month", ccsText, "", CCGetRequestParam("month", $Method, NULL), $this);
            $this->month->DSType = dsListOfValues;
            $this->month->Values = array(array("1", "Jan"), array("2", "Feb"), array("3", "March"), array("4", "April"), array("5", "Mei"), array("6", "June"), array("7", "July"), array("8", "August"), array("9", "September"), array("10", "October"), array("11", "November"), array("12", "December"));
            $this->month->Required = true;
            $this->year = & new clsControl(ccsListBox, "year", "year", ccsText, "", CCGetRequestParam("year", $Method, NULL), $this);
            $this->year->DSType = dsListOfValues;
            $this->year->Values = "";
            $this->year->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->set->Value) && !strlen($this->set->Value) && $this->set->Value !== false)
                    $this->set->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Validate Method @15-2A503586
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s->Validate() && $Validation);
        $Validation = ($this->sv->Validate() && $Validation);
        $Validation = ($this->cat->Validate() && $Validation);
        $Validation = ($this->ad->Validate() && $Validation);
        $Validation = ($this->rn->Validate() && $Validation);
        $Validation = ($this->b->Validate() && $Validation);
        $Validation = ($this->esc->Validate() && $Validation);
        $Validation = ($this->scat->Validate() && $Validation);
        $Validation = ($this->set->Validate() && $Validation);
        $Validation = ($this->month->Validate() && $Validation);
        $Validation = ($this->year->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sv->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rn->Errors->Count() == 0);
        $Validation =  $Validation && ($this->b->Errors->Count() == 0);
        $Validation =  $Validation && ($this->esc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->scat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->set->Errors->Count() == 0);
        $Validation =  $Validation && ($this->month->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @15-5CEA81A7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s->Errors->Count());
        $errors = ($errors || $this->sv->Errors->Count());
        $errors = ($errors || $this->cat->Errors->Count());
        $errors = ($errors || $this->ad->Errors->Count());
        $errors = ($errors || $this->rn->Errors->Count());
        $errors = ($errors || $this->b->Errors->Count());
        $errors = ($errors || $this->esc->Errors->Count());
        $errors = ($errors || $this->scat->Errors->Count());
        $errors = ($errors || $this->set->Errors->Count());
        $errors = ($errors || $this->month->Errors->Count());
        $errors = ($errors || $this->year->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @15-ED598703
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

//Operation Method @15-F33B339C
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
        $Redirect = "reports.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reports.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s", "sv", "cat", "ad", "rn", "b", "esc", "scat", "set", "month", "year", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @15-6BC2F592
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

        $this->s->Prepare();
        $this->sv->Prepare();
        $this->cat->Prepare();
        $this->b->Prepare();
        $this->esc->Prepare();
        $this->scat->Prepare();
        $this->month->Prepare();
        $this->year->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sv->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->b->Errors->ToString());
            $Error = ComposeStrings($Error, $this->esc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->scat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->set->Errors->ToString());
            $Error = ComposeStrings($Error, $this->month->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year->Errors->ToString());
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
        $this->s->Show();
        $this->sv->Show();
        $this->cat->Show();
        $this->ad->Show();
        $this->rn->Show();
        $this->b->Show();
        $this->esc->Show();
        $this->scat->Show();
        $this->set->Show();
        $this->month->Show();
        $this->year->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End CriteriaRpt Class @15-FCB6E20C

//Include Page implementation @44-4FCFD173
include_once(RelativePath . "/rptticketrn.php");
//End Include Page implementation



//Include Page implementation @55-92A768E8
include_once(RelativePath . "/reportspm.php");
//End Include Page implementation

class clsRecordCriteriaStat2 { //CriteriaStat2 Class @57-DD026AD6

//Variables @57-D6FF3E86

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

//Class_Initialize Event @57-59988DA6
    function clsRecordCriteriaStat2($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record CriteriaStat2/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "CriteriaStat2";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->set = & new clsControl(ccsHidden, "set", "set", ccsText, "", CCGetRequestParam("set", $Method, NULL), $this);
            $this->year = & new clsControl(ccsListBox, "year", "year", ccsText, "", CCGetRequestParam("year", $Method, NULL), $this);
            $this->year->DSType = dsTable;
            $this->year->DataSource = new clsDBSMART();
            $this->year->ds = & $this->year->DataSource;
            $this->year->DataSource->SQL = "SELECT * \n" .
"FROM  {SQL_Where} {SQL_OrderBy}";
            list($this->year->BoundColumn, $this->year->TextColumn, $this->year->DBFormat) = array("", "", "");
            $this->month = & new clsControl(ccsListBox, "month", "month", ccsText, "", CCGetRequestParam("month", $Method, NULL), $this);
            $this->month->DSType = dsListOfValues;
            $this->month->Values = array(array("1", "Jan"), array("2", "Feb"), array("3", "March"), array("4", "April"), array("5", "Mei"), array("6", "June"), array("7", "July"), array("8", "August"), array("9", "September"), array("10", "October"), array("11", "November"), array("12", "December"));
            $this->lblNote = & new clsControl(ccsLabel, "lblNote", "lblNote", ccsText, "", CCGetRequestParam("lblNote", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->set->Value) && !strlen($this->set->Value) && $this->set->Value !== false)
                    $this->set->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Validate Method @57-174A8D0A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->set->Validate() && $Validation);
        $Validation = ($this->year->Validate() && $Validation);
        $Validation = ($this->month->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->set->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year->Errors->Count() == 0);
        $Validation =  $Validation && ($this->month->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @57-5C2106B7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->set->Errors->Count());
        $errors = ($errors || $this->year->Errors->Count());
        $errors = ($errors || $this->month->Errors->Count());
        $errors = ($errors || $this->lblNote->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @57-ED598703
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

//Operation Method @57-4903840A
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
        $Redirect = "reports.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reports.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("set", "year", "month", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @57-4DDD5A18
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

        $this->year->Prepare();
        $this->month->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->set->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year->Errors->ToString());
            $Error = ComposeStrings($Error, $this->month->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblNote->Errors->ToString());
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
        $this->set->Show();
        $this->year->Show();
        $this->month->Show();
        $this->lblNote->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End CriteriaStat2 Class @57-FCB6E20C

//Include Page implementation @67-FA5B7B3E
include_once(RelativePath . "/reportscat.php");
//End Include Page implementation

//Include Page implementation @80-6AC4998C
include_once(RelativePath . "/reportsresnote.php");
//End Include Page implementation

//Include Page implementation @71-462EBFB5
include_once(RelativePath . "/reportsbranch.php");
//End Include Page implementation

//Include Page implementation @74-C90DA02B
include_once(RelativePath . "/reportsticket.php");
//End Include Page implementation

//Include Page implementation @85-AD1AD5C3
include_once(RelativePath . "/reportsbranchcat.php");
//End Include Page implementation

//Include Page implementation @87-1EC6859D
include_once(RelativePath . "/reportslogstat.php");
//End Include Page implementation

//Include Page implementation @89-8FFCCCC2
include_once(RelativePath . "/reportsla.php");
//End Include Page implementation

//Include Page implementation @91-42B796BD
include_once(RelativePath . "/reportsgraph.php");
//End Include Page implementation

//Include Page implementation @93-F1049DBA
include_once(RelativePath . "/reportsrsltnnote.php");
//End Include Page implementation

//Include Page implementation @95-AE065539
include_once(RelativePath . "/reportrtn.php");
//End Include Page implementation

//Initialize Page @1-D26BA54D
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
$TemplateFileName = "reports.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8E1080E8
include_once("./reports_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2FBBB2C7
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$OptionReport = & new clsRecordOptionReport("", $MainPage);
$CriteriaRpt = & new clsRecordCriteriaRpt("", $MainPage);
$Panrptticketrn = & new clsPanel("Panrptticketrn", $MainPage);
$rptticketrn = & new clsrptticketrn("", "rptticketrn", $MainPage);
$rptticketrn->Initialize();
$Panstatpm = & new clsPanel("Panstatpm", $MainPage);
$reportspm = & new clsreportspm("", "reportspm", $MainPage);
$reportspm->Initialize();
$CriteriaStat2 = & new clsRecordCriteriaStat2("", $MainPage);
$Panstatcat = & new clsPanel("Panstatcat", $MainPage);
$reportscat = & new clsreportscat("", "reportscat", $MainPage);
$reportscat->Initialize();
$Panresnote = & new clsPanel("Panresnote", $MainPage);
$reportsresnote = & new clsreportsresnote("", "reportsresnote", $MainPage);
$reportsresnote->Initialize();
$Panbranch = & new clsPanel("Panbranch", $MainPage);
$reportsbranch = & new clsreportsbranch("", "reportsbranch", $MainPage);
$reportsbranch->Initialize();
$PanTicket = & new clsPanel("PanTicket", $MainPage);
$reportsticket = & new clsreportsticket("", "reportsticket", $MainPage);
$reportsticket->Initialize();
$Panbranchcat = & new clsPanel("Panbranchcat", $MainPage);
$reportsbranchcat = & new clsreportsbranchcat("", "reportsbranchcat", $MainPage);
$reportsbranchcat->Initialize();
$pantcktlogstat = & new clsPanel("pantcktlogstat", $MainPage);
$reportslogstat = & new clsreportslogstat("", "reportslogstat", $MainPage);
$reportslogstat->Initialize();
$pansla = & new clsPanel("pansla", $MainPage);
$reportsla = & new clsreportsla("", "reportsla", $MainPage);
$reportsla->Initialize();
$pangraf = & new clsPanel("pangraf", $MainPage);
$reportsgraph = & new clsreportsgraph("", "reportsgraph", $MainPage);
$reportsgraph->Initialize();
$panrsltnnote = & new clsPanel("panrsltnnote", $MainPage);
$reportsrsltnnote = & new clsreportsrsltnnote("", "reportsrsltnnote", $MainPage);
$reportsrsltnnote->Initialize();
$panrtnlist = & new clsPanel("panrtnlist", $MainPage);
$reportrtn = & new clsreportrtn("", "reportrtn", $MainPage);
$reportrtn->Initialize();
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->OptionReport = & $OptionReport;
$MainPage->CriteriaRpt = & $CriteriaRpt;
$MainPage->Panrptticketrn = & $Panrptticketrn;
$MainPage->rptticketrn = & $rptticketrn;
$MainPage->Panstatpm = & $Panstatpm;
$MainPage->reportspm = & $reportspm;
$MainPage->CriteriaStat2 = & $CriteriaStat2;
$MainPage->Panstatcat = & $Panstatcat;
$MainPage->reportscat = & $reportscat;
$MainPage->Panresnote = & $Panresnote;
$MainPage->reportsresnote = & $reportsresnote;
$MainPage->Panbranch = & $Panbranch;
$MainPage->reportsbranch = & $reportsbranch;
$MainPage->PanTicket = & $PanTicket;
$MainPage->reportsticket = & $reportsticket;
$MainPage->Panbranchcat = & $Panbranchcat;
$MainPage->reportsbranchcat = & $reportsbranchcat;
$MainPage->pantcktlogstat = & $pantcktlogstat;
$MainPage->reportslogstat = & $reportslogstat;
$MainPage->pansla = & $pansla;
$MainPage->reportsla = & $reportsla;
$MainPage->pangraf = & $pangraf;
$MainPage->reportsgraph = & $reportsgraph;
$MainPage->panrsltnnote = & $panrsltnnote;
$MainPage->reportsrsltnnote = & $reportsrsltnnote;
$MainPage->panrtnlist = & $panrtnlist;
$MainPage->reportrtn = & $reportrtn;
$Panrptticketrn->AddComponent("rptticketrn", $rptticketrn);
$Panstatpm->AddComponent("reportspm", $reportspm);
$Panstatcat->AddComponent("reportscat", $reportscat);
$Panresnote->AddComponent("reportsresnote", $reportsresnote);
$Panbranch->AddComponent("reportsbranch", $reportsbranch);
$PanTicket->AddComponent("reportsticket", $reportsticket);
$Panbranchcat->AddComponent("reportsbranchcat", $reportsbranchcat);
$pantcktlogstat->AddComponent("reportslogstat", $reportslogstat);
$pansla->AddComponent("reportsla", $reportsla);
$pangraf->AddComponent("reportsgraph", $reportsgraph);
$panrsltnnote->AddComponent("reportsrsltnnote", $reportsrsltnnote);
$panrtnlist->AddComponent("reportrtn", $reportrtn);

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

//Execute Components @1-C6567B79
$header->Operations();
$footer->Operations();
$OptionReport->Operation();
$CriteriaRpt->Operation();
$rptticketrn->Operations();
$reportspm->Operations();
$CriteriaStat2->Operation();
$reportscat->Operations();
$reportsresnote->Operations();
$reportsbranch->Operations();
$reportsticket->Operations();
$reportsbranchcat->Operations();
$reportslogstat->Operations();
$reportsla->Operations();
$reportsgraph->Operations();
$reportsrsltnnote->Operations();
$reportrtn->Operations();
//End Execute Components

//Go to destination page @1-E5B38D9A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($OptionReport);
    unset($CriteriaRpt);
    $rptticketrn->Class_Terminate();
    unset($rptticketrn);
    $reportspm->Class_Terminate();
    unset($reportspm);
    unset($CriteriaStat2);
    $reportscat->Class_Terminate();
    unset($reportscat);
    $reportsresnote->Class_Terminate();
    unset($reportsresnote);
    $reportsbranch->Class_Terminate();
    unset($reportsbranch);
    $reportsticket->Class_Terminate();
    unset($reportsticket);
    $reportsbranchcat->Class_Terminate();
    unset($reportsbranchcat);
    $reportslogstat->Class_Terminate();
    unset($reportslogstat);
    $reportsla->Class_Terminate();
    unset($reportsla);
    $reportsgraph->Class_Terminate();
    unset($reportsgraph);
    $reportsrsltnnote->Class_Terminate();
    unset($reportsrsltnnote);
    $reportrtn->Class_Terminate();
    unset($reportrtn);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A4AA3A62
$header->Show();
$footer->Show();
$OptionReport->Show();
$CriteriaRpt->Show();
$CriteriaStat2->Show();
$Panrptticketrn->Show();
$Panstatpm->Show();
$Panstatcat->Show();
$Panresnote->Show();
$Panbranch->Show();
$PanTicket->Show();
$Panbranchcat->Show();
$pantcktlogstat->Show();
$pansla->Show();
$pangraf->Show();
$panrsltnnote->Show();
$panrtnlist->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F0EB0D71
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($OptionReport);
unset($CriteriaRpt);
$rptticketrn->Class_Terminate();
unset($rptticketrn);
$reportspm->Class_Terminate();
unset($reportspm);
unset($CriteriaStat2);
$reportscat->Class_Terminate();
unset($reportscat);
$reportsresnote->Class_Terminate();
unset($reportsresnote);
$reportsbranch->Class_Terminate();
unset($reportsbranch);
$reportsticket->Class_Terminate();
unset($reportsticket);
$reportsbranchcat->Class_Terminate();
unset($reportsbranchcat);
$reportslogstat->Class_Terminate();
unset($reportslogstat);
$reportsla->Class_Terminate();
unset($reportsla);
$reportsgraph->Class_Terminate();
unset($reportsgraph);
$reportsrsltnnote->Class_Terminate();
unset($reportsrsltnnote);
$reportrtn->Class_Terminate();
unset($reportrtn);
unset($Tpl);
//End Unload Page


?>
