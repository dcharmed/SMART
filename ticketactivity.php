<?php
//Include Common Files @1-61D76E09
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ticketactivity.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

//Include Page implementation @5-C9E6688B
include_once(RelativePath . "/resolutionnotes.php");
//End Include Page implementation

class clsGridsmart_resolutionnote { //smart_resolutionnote class @6-CD32FF06

//Variables @6-AC1EDBB9

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

//Class_Initialize Event @6-0816C3A1
    function clsGridsmart_resolutionnote($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_resolutionnote";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_resolutionnote";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_resolutionnoteDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->rsltn_status = & new clsControl(ccsLabel, "rsltn_status", "rsltn_status", ccsInteger, "", CCGetRequestParam("rsltn_status", ccsGet, NULL), $this);
        $this->rsltn_date = & new clsControl(ccsLabel, "rsltn_date", "rsltn_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("rsltn_date", ccsGet, NULL), $this);
        $this->rsltn_byuser = & new clsControl(ccsLabel, "rsltn_byuser", "rsltn_byuser", ccsInteger, "", CCGetRequestParam("rsltn_byuser", ccsGet, NULL), $this);
        $this->rsltn_actiontaken = & new clsControl(ccsLabel, "rsltn_actiontaken", "rsltn_actiontaken", ccsMemo, "", CCGetRequestParam("rsltn_actiontaken", ccsGet, NULL), $this);
        $this->rsltn_actionmethod = & new clsControl(ccsLabel, "rsltn_actionmethod", "rsltn_actionmethod", ccsText, "", CCGetRequestParam("rsltn_actionmethod", ccsGet, NULL), $this);
        $this->rsltn_planning = & new clsControl(ccsLabel, "rsltn_planning", "rsltn_planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", ccsGet, NULL), $this);
        $this->rsltn_remark = & new clsControl(ccsLabel, "rsltn_remark", "rsltn_remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @6-E6F30E1E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urltcktid"] = CCGetFromGet("tcktid", NULL);

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
            $this->ControlsVisible["rsltn_status"] = $this->rsltn_status->Visible;
            $this->ControlsVisible["rsltn_date"] = $this->rsltn_date->Visible;
            $this->ControlsVisible["rsltn_byuser"] = $this->rsltn_byuser->Visible;
            $this->ControlsVisible["rsltn_actiontaken"] = $this->rsltn_actiontaken->Visible;
            $this->ControlsVisible["rsltn_actionmethod"] = $this->rsltn_actionmethod->Visible;
            $this->ControlsVisible["rsltn_planning"] = $this->rsltn_planning->Visible;
            $this->ControlsVisible["rsltn_remark"] = $this->rsltn_remark->Visible;
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
                $this->rsltn_status->SetValue($this->DataSource->rsltn_status->GetValue());
                $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
                $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
                $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
                $this->rsltn_actionmethod->SetValue($this->DataSource->rsltn_actionmethod->GetValue());
                $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->rsltn_status->Show();
                $this->rsltn_date->Show();
                $this->rsltn_byuser->Show();
                $this->rsltn_actiontaken->Show();
                $this->rsltn_actionmethod->Show();
                $this->rsltn_planning->Show();
                $this->rsltn_remark->Show();
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
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-1F4FA05E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->rsltn_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_actiontaken->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_actionmethod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_planning->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_resolutionnote Class @6-FCB6E20C

class clssmart_resolutionnoteDataSource extends clsDBSMART {  //smart_resolutionnoteDataSource Class @6-8A18DBD3

//DataSource Variables @6-0FF94BFB
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $rsltn_status;
    var $rsltn_date;
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $rsltn_actionmethod;
    var $rsltn_planning;
    var $rsltn_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-FCF8F600
    function clssmart_resolutionnoteDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_resolutionnote";
        $this->Initialize();
        $this->rsltn_status = new clsField("rsltn_status", ccsInteger, "");
        
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_actionmethod = new clsField("rsltn_actionmethod", ccsText, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @6-D832EC3F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltcktid", ccsInteger, "", "", $this->Parameters["urltcktid"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ticket_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @6-1FF328B0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_resolutionnote";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_resolutionnote {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-5BDD5A32
    function SetValues()
    {
        $this->rsltn_status->SetDBValue(trim($this->f("rsltn_status")));
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_actionmethod->SetDBValue($this->f("rsltn_actionmethod"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
    }
//End SetValues Method

} //End smart_resolutionnoteDataSource Class @6-FCB6E20C

class clsRecordsmart_ticket { //smart_ticket Class @16-5C9491E3

//Variables @16-D6FF3E86

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

//Class_Initialize Event @16-CB62E1B9
    function clsRecordsmart_ticket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->DataSource = new clssmart_ticketDataSource($this);
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
            $this->tckt_refnumber = & new clsControl(ccsLabel, "tckt_refnumber", "Tckt Refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", $Method, NULL), $this);
            $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "Tckt Status", ccsInteger, "", CCGetRequestParam("tckt_status", $Method, NULL), $this);
            $this->tckt_date = & new clsControl(ccsLabel, "tckt_date", "Tckt Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_date", $Method, NULL), $this);
            $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "Tckt Severity", ccsInteger, "", CCGetRequestParam("tckt_severity", $Method, NULL), $this);
            $this->tckt_tagrelated = & new clsControl(ccsLabel, "tckt_tagrelated", "Tckt Tagrelated", ccsText, "", CCGetRequestParam("tckt_tagrelated", $Method, NULL), $this);
            $this->tckt_state = & new clsControl(ccsLabel, "tckt_state", "Tckt State", ccsText, "", CCGetRequestParam("tckt_state", $Method, NULL), $this);
            $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "Tckt Site", ccsText, "", CCGetRequestParam("tckt_site", $Method, NULL), $this);
            $this->tckt_category = & new clsControl(ccsLabel, "tckt_category", "Tckt Category", ccsText, "", CCGetRequestParam("tckt_category", $Method, NULL), $this);
            $this->tckt_subcategory = & new clsControl(ccsLabel, "tckt_subcategory", "Tckt Subcategory", ccsText, "", CCGetRequestParam("tckt_subcategory", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @16-2C19692C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltcktid"] = CCGetFromGet("tcktid", NULL);
    }
//End Initialize Method

//Validate Method @16-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @16-33D546C5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_date->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->tckt_tagrelated->Errors->Count());
        $errors = ($errors || $this->tckt_state->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->tckt_subcategory->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @16-ED598703
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

//Operation Method @16-17DC9883
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

//Show Method @16-E342C9E2
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
                $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_date->SetValue($this->DataSource->tckt_date->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->tckt_tagrelated->SetValue($this->DataSource->tckt_tagrelated->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
                $this->tckt_subcategory->SetValue($this->DataSource->tckt_subcategory->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tckt_refnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_severity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_tagrelated->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_category->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_subcategory->Errors->ToString());
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

        $this->tckt_refnumber->Show();
        $this->tckt_status->Show();
        $this->tckt_date->Show();
        $this->tckt_severity->Show();
        $this->tckt_tagrelated->Show();
        $this->tckt_state->Show();
        $this->tckt_site->Show();
        $this->tckt_category->Show();
        $this->tckt_subcategory->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_ticket Class @16-FCB6E20C

class clssmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @16-6569B5AD

//DataSource Variables @16-42843605
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_date;
    var $tckt_severity;
    var $tckt_tagrelated;
    var $tckt_state;
    var $tckt_site;
    var $tckt_category;
    var $tckt_subcategory;
//End DataSource Variables

//DataSourceClass_Initialize Event @16-BC99BE3D
    function clssmart_ticketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_ticket/Error";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_date = new clsField("tckt_date", ccsDate, $this->DateFormat);
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->tckt_tagrelated = new clsField("tckt_tagrelated", ccsText, "");
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->tckt_subcategory = new clsField("tckt_subcategory", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @16-3C592692
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltcktid", ccsInteger, "", "", $this->Parameters["urltcktid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @16-3B622B64
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @16-94FE93C6
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_date->SetDBValue(trim($this->f("tckt_date")));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->tckt_tagrelated->SetDBValue($this->f("tckt_tagrelated"));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->tckt_subcategory->SetDBValue($this->f("tckt_subcategory"));
    }
//End SetValues Method

} //End smart_ticketDataSource Class @16-FCB6E20C

//Initialize Page @1-2B778C02
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
$TemplateFileName = "ticketactivity.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2E7FC8C3
include_once("./ticketactivity_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C35EB810
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$resolutionnotes = & new clsresolutionnotes("", "resolutionnotes", $MainPage);
$resolutionnotes->Initialize();
$smart_resolutionnote = & new clsGridsmart_resolutionnote("", $MainPage);
$smart_ticket = & new clsRecordsmart_ticket("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->resolutionnotes = & $resolutionnotes;
$MainPage->smart_resolutionnote = & $smart_resolutionnote;
$MainPage->smart_ticket = & $smart_ticket;
$smart_resolutionnote->Initialize();
$smart_ticket->Initialize();

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

//Execute Components @1-43F1FF57
$header->Operations();
$footer->Operations();
$resolutionnotes->Operations();
$smart_ticket->Operation();
//End Execute Components

//Go to destination page @1-7063B9C2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    $resolutionnotes->Class_Terminate();
    unset($resolutionnotes);
    unset($smart_resolutionnote);
    unset($smart_ticket);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-99BBB96D
$header->Show();
$footer->Show();
$resolutionnotes->Show();
$smart_resolutionnote->Show();
$smart_ticket->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CB65B6B8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
$resolutionnotes->Class_Terminate();
unset($resolutionnotes);
unset($smart_resolutionnote);
unset($smart_ticket);
unset($Tpl);
//End Unload Page


?>
