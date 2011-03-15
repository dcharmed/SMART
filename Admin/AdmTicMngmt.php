<?php
//Include Common Files @1-1187C606
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "AdmTicMngmt.php");
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

class clsRecordRDelTicket { //RDelTicket Class @5-0A4D1308

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

//Class_Initialize Event @5-CEF01C57
    function clsRecordRDelTicket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RDelTicket/Error";
        $this->DataSource = new clsRDelTicketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RDelTicket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->tckt_refnumber = & new clsControl(ccsTextBox, "tckt_refnumber", "Tckt Refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", $Method, NULL), $this);
            $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "Tckt Status", ccsInteger, "", CCGetRequestParam("tckt_status", $Method, NULL), $this);
            $this->tckt_r_date = & new clsControl(ccsLabel, "tckt_r_date", "Tckt R Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_r_date", $Method, NULL), $this);
            $this->tckt_state = & new clsControl(ccsLabel, "tckt_state", "Tckt State", ccsText, "", CCGetRequestParam("tckt_state", $Method, NULL), $this);
            $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "Tckt Site", ccsText, "", CCGetRequestParam("tckt_site", $Method, NULL), $this);
            $this->tckt_category = & new clsControl(ccsLabel, "tckt_category", "Tckt Category", ccsText, "", CCGetRequestParam("tckt_category", $Method, NULL), $this);
            $this->tckt_subcategory = & new clsControl(ccsLabel, "tckt_subcategory", "Tckt Subcategory", ccsText, "", CCGetRequestParam("tckt_subcategory", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @5-CD43F911
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urld_tckt"] = CCGetFromGet("d_tckt", NULL);
    }
//End Initialize Method

//Validate Method @5-B2049E96
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tckt_refnumber->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tckt_refnumber->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-F8E5B075
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_state->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->tckt_subcategory->Errors->Count());
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

//Operation Method @5-862CDDAF
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
            $this->PressedButton = $this->EditMode ? "Button_Delete" : "Button_Cancel";
            if($this->Button_Delete->Pressed) {
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

//DeleteRow Method @5-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @5-C43DC151
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
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
                $this->tckt_subcategory->SetValue($this->DataSource->tckt_subcategory->GetValue());
                if(!$this->FormSubmitted){
                    $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tckt_refnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_date->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->tckt_refnumber->Show();
        $this->tckt_status->Show();
        $this->tckt_r_date->Show();
        $this->tckt_state->Show();
        $this->tckt_site->Show();
        $this->tckt_category->Show();
        $this->tckt_subcategory->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RDelTicket Class @5-FCB6E20C

class clsRDelTicketDataSource extends clsDBSMART {  //RDelTicketDataSource Class @5-9A6C18AB

//DataSource Variables @5-CC0166C4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_r_date;
    var $tckt_state;
    var $tckt_site;
    var $tckt_category;
    var $tckt_subcategory;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-6536801B
    function clsRDelTicketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RDelTicket/Error";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->tckt_subcategory = new clsField("tckt_subcategory", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @5-0636168D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urld_tckt", ccsText, "", "", $this->Parameters["urld_tckt"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tckt_refnumber", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-3B622B64
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

//SetValues Method @5-B3D7BFDB
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->tckt_subcategory->SetDBValue($this->f("tckt_subcategory"));
    }
//End SetValues Method

//Delete Method @5-8FA6459C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_ticket";
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

} //End RDelTicketDataSource Class @5-FCB6E20C

class clsRecordSDelTicket { //SDelTicket Class @18-CBC3CCC8

//Variables @18-D6FF3E86

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

//Class_Initialize Event @18-925B02FA
    function clsRecordSDelTicket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SDelTicket/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SDelTicket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->d_tckt = & new clsControl(ccsTextBox, "d_tckt", "d_tckt", ccsText, "", CCGetRequestParam("d_tckt", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @18-E4143646
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->d_tckt->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->d_tckt->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @18-8212677D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->d_tckt->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @18-ED598703
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

//Operation Method @18-89619105
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
        $Redirect = "AdmTicMngmt.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AdmTicMngmt.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @18-F98C37B9
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
            $Error = ComposeStrings($Error, $this->d_tckt->Errors->ToString());
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

        $this->d_tckt->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SDelTicket Class @18-FCB6E20C

class clsGridGTickets { //GTickets class @26-FE0F079D

//Variables @26-027ADC7B

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
    var $Sorter_tckt_refnumber;
    var $Sorter_tckt_status;
    var $Sorter_tckt_date;
    var $Sorter_tckt_branch;
    var $Sorter_tckt_severity;
    var $Sorter_tckt_adukomn;
    var $Sorter_tckt_toppanid;
    var $Sorter_tckt_esc;
//End Variables

//Class_Initialize Event @26-552C406F
    function clsGridGTickets($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GTickets";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GTickets";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGTicketsDataSource($this);
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
        $this->SorterName = CCGetParam("GTicketsOrder", "");
        $this->SorterDirection = CCGetParam("GTicketsDir", "");

        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->tckt_refnumber = & new clsControl(ccsLink, "tckt_refnumber", "tckt_refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", ccsGet, NULL), $this);
        $this->tckt_refnumber->Page = "../ticketdetails.php";
        $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "tckt_status", ccsInteger, "", CCGetRequestParam("tckt_status", ccsGet, NULL), $this);
        $this->tckt_status->HTML = true;
        $this->tckt_date = & new clsControl(ccsLabel, "tckt_date", "tckt_date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_date", ccsGet, NULL), $this);
        $this->tckt_branch = & new clsControl(ccsLabel, "tckt_branch", "tckt_branch", ccsText, "", CCGetRequestParam("tckt_branch", ccsGet, NULL), $this);
        $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "tckt_severity", ccsInteger, "", CCGetRequestParam("tckt_severity", ccsGet, NULL), $this);
        $this->tckt_adukomn = & new clsControl(ccsLabel, "tckt_adukomn", "tckt_adukomn", ccsText, "", CCGetRequestParam("tckt_adukomn", ccsGet, NULL), $this);
        $this->tckt_toppanid = & new clsControl(ccsLabel, "tckt_toppanid", "tckt_toppanid", ccsText, "", CCGetRequestParam("tckt_toppanid", ccsGet, NULL), $this);
        $this->tckt_esc = & new clsControl(ccsLabel, "tckt_esc", "tckt_esc", ccsText, "", CCGetRequestParam("tckt_esc", ccsGet, NULL), $this);
        $this->tckt_description = & new clsControl(ccsLabel, "tckt_description", "tckt_description", ccsMemo, "", CCGetRequestParam("tckt_description", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->tckt_state = & new clsControl(ccsHidden, "tckt_state", "tckt_state", ccsText, "", CCGetRequestParam("tckt_state", ccsGet, NULL), $this);
        $this->tckt_age = & new clsControl(ccsLabel, "tckt_age", "tckt_age", ccsInteger, "", CCGetRequestParam("tckt_age", ccsGet, NULL), $this);
        $this->tckt_age->HTML = true;
        $this->tcktEng = & new clsControl(ccsLabel, "tcktEng", "tcktEng", ccsText, "", CCGetRequestParam("tcktEng", ccsGet, NULL), $this);
        $this->tckt_c_date = & new clsControl(ccsHidden, "tckt_c_date", "tckt_c_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_c_date", ccsGet, NULL), $this);
        $this->smart_ticket_TotalRecords = & new clsControl(ccsLabel, "smart_ticket_TotalRecords", "smart_ticket_TotalRecords", ccsText, "", CCGetRequestParam("smart_ticket_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_tckt_refnumber = & new clsSorter($this->ComponentName, "Sorter_tckt_refnumber", $FileName, $this);
        $this->Sorter_tckt_status = & new clsSorter($this->ComponentName, "Sorter_tckt_status", $FileName, $this);
        $this->Sorter_tckt_date = & new clsSorter($this->ComponentName, "Sorter_tckt_date", $FileName, $this);
        $this->Sorter_tckt_branch = & new clsSorter($this->ComponentName, "Sorter_tckt_branch", $FileName, $this);
        $this->Sorter_tckt_severity = & new clsSorter($this->ComponentName, "Sorter_tckt_severity", $FileName, $this);
        $this->Sorter_tckt_adukomn = & new clsSorter($this->ComponentName, "Sorter_tckt_adukomn", $FileName, $this);
        $this->Sorter_tckt_toppanid = & new clsSorter($this->ComponentName, "Sorter_tckt_toppanid", $FileName, $this);
        $this->Sorter_tckt_esc = & new clsSorter($this->ComponentName, "Sorter_tckt_esc", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @26-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @26-2893789A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_branch"] = CCGetFromGet("s_branch", NULL);
        $this->DataSource->Parameters["urls_ref"] = CCGetFromGet("s_ref", NULL);
        $this->DataSource->Parameters["urls_sdate"] = CCGetFromGet("s_sdate", NULL);
        $this->DataSource->Parameters["urls_edate"] = CCGetFromGet("s_edate", NULL);
        $this->DataSource->Parameters["urlmode"] = CCGetFromGet("mode", NULL);
        $this->DataSource->Parameters["urls_svr"] = CCGetFromGet("s_svr", NULL);
        $this->DataSource->Parameters["urls_status"] = CCGetFromGet("s_status", NULL);

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
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["tckt_status"] = $this->tckt_status->Visible;
            $this->ControlsVisible["tckt_date"] = $this->tckt_date->Visible;
            $this->ControlsVisible["tckt_branch"] = $this->tckt_branch->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
            $this->ControlsVisible["tckt_adukomn"] = $this->tckt_adukomn->Visible;
            $this->ControlsVisible["tckt_toppanid"] = $this->tckt_toppanid->Visible;
            $this->ControlsVisible["tckt_esc"] = $this->tckt_esc->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["tckt_state"] = $this->tckt_state->Visible;
            $this->ControlsVisible["tckt_age"] = $this->tckt_age->Visible;
            $this->ControlsVisible["tcktEng"] = $this->tcktEng->Visible;
            $this->ControlsVisible["tckt_c_date"] = $this->tckt_c_date->Visible;
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
                $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                $this->tckt_refnumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tckt_refnumber->Parameters = CCAddParam($this->tckt_refnumber->Parameters, "id", $this->DataSource->f("id"));
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_date->SetValue($this->DataSource->tckt_date->GetValue());
                $this->tckt_branch->SetValue($this->DataSource->tckt_branch->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->tckt_adukomn->SetValue($this->DataSource->tckt_adukomn->GetValue());
                $this->tckt_toppanid->SetValue($this->DataSource->tckt_toppanid->GetValue());
                $this->tckt_esc->SetValue($this->DataSource->tckt_esc->GetValue());
                $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->tckt_refnumber->Show();
                $this->tckt_status->Show();
                $this->tckt_date->Show();
                $this->tckt_branch->Show();
                $this->tckt_severity->Show();
                $this->tckt_adukomn->Show();
                $this->tckt_toppanid->Show();
                $this->tckt_esc->Show();
                $this->tckt_description->Show();
                $this->lblNumber->Show();
                $this->tckt_state->Show();
                $this->tckt_age->Show();
                $this->tcktEng->Show();
                $this->tckt_c_date->Show();
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
        $this->smart_ticket_TotalRecords->Show();
        $this->Sorter_tckt_refnumber->Show();
        $this->Sorter_tckt_status->Show();
        $this->Sorter_tckt_date->Show();
        $this->Sorter_tckt_branch->Show();
        $this->Sorter_tckt_severity->Show();
        $this->Sorter_tckt_adukomn->Show();
        $this->Sorter_tckt_toppanid->Show();
        $this->Sorter_tckt_esc->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @26-D92B2ECA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_adukomn->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_toppanid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_esc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktEng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GTickets Class @26-FCB6E20C

class clsGTicketsDataSource extends clsDBSMART {  //GTicketsDataSource Class @26-71BB7575

//DataSource Variables @26-29C94D2E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_date;
    var $tckt_branch;
    var $tckt_severity;
    var $tckt_adukomn;
    var $tckt_toppanid;
    var $tckt_esc;
    var $tckt_description;
    var $tckt_state;
    var $tckt_c_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @26-F86C91A5
    function clsGTicketsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GTickets";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_date = new clsField("tckt_date", ccsDate, $this->DateFormat);
        
        $this->tckt_branch = new clsField("tckt_branch", ccsText, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->tckt_adukomn = new clsField("tckt_adukomn", ccsText, "");
        
        $this->tckt_toppanid = new clsField("tckt_toppanid", ccsText, "");
        
        $this->tckt_esc = new clsField("tckt_esc", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @26-190E4811
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_r_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tckt_refnumber" => array("tckt_refnumber", ""), 
            "Sorter_tckt_status" => array("tckt_status", ""), 
            "Sorter_tckt_date" => array("tckt_r_date", ""), 
            "Sorter_tckt_branch" => array("tckt_site", ""), 
            "Sorter_tckt_severity" => array("tckt_severity", ""), 
            "Sorter_tckt_adukomn" => array("tckt_adukomn", ""), 
            "Sorter_tckt_toppanid" => array("tckt_toppanid", ""), 
            "Sorter_tckt_esc" => array("tckt_esc", "")));
    }
//End SetOrder Method

//Prepare Method @26-DF96CD66
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_branch", ccsText, "", "", $this->Parameters["urls_branch"], "", false);
        $this->wp->AddParameter("2", "urls_ref", ccsText, "", "", $this->Parameters["urls_ref"], "", false);
        $this->wp->AddParameter("3", "urls_sdate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_sdate"], "", false);
        $this->wp->AddParameter("4", "urls_edate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_edate"], "", false);
        $this->wp->AddParameter("5", "urlmode", ccsInteger, "", "", $this->Parameters["urlmode"], "", false);
        $this->wp->AddParameter("6", "urls_svr", ccsInteger, "", "", $this->Parameters["urls_svr"], "", false);
        $this->wp->AddParameter("7", "urls_status", ccsInteger, "", "", $this->Parameters["urls_status"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tckt_site", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tckt_refnumber", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opGreaterThanOrEqual, "tckt_r_date", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opLessThanOrEqual, "tckt_r_date", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opLessThan, "tckt_status", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "tckt_severity", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "tckt_status", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]);
    }
//End Prepare Method

//Open Method @26-C5FDE95E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_ticket";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticket {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @26-2F82F31A
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_branch->SetDBValue($this->f("tckt_site"));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->tckt_adukomn->SetDBValue($this->f("tckt_r_adukomid"));
        $this->tckt_toppanid->SetDBValue($this->f("tckt_toppanid"));
        $this->tckt_esc->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
    }
//End SetValues Method

} //End GTicketsDataSource Class @26-FCB6E20C

class clsRecordRRefGenerator { //RRefGenerator Class @65-F8EF77B5

//Variables @65-D6FF3E86

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

//Class_Initialize Event @65-17400725
    function clsRecordRRefGenerator($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RRefGenerator/Error";
        $this->DataSource = new clsRRefGeneratorDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RRefGenerator";
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
            $this->type = & new clsControl(ccsListBox, "type", "Type", ccsText, "", CCGetRequestParam("type", $Method, NULL), $this);
            $this->type->DSType = dsListOfValues;
            $this->type->Values = array(array("tckt", "Ticketing"), array("pm", "PM"));
            $this->period = & new clsControl(ccsTextBox, "period", "Period", ccsDate, $DefaultDateFormat, CCGetRequestParam("period", $Method, NULL), $this);
            $this->currentticket = & new clsControl(ccsTextBox, "currentticket", "Currentticket", ccsText, "", CCGetRequestParam("currentticket", $Method, NULL), $this);
            $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Page = "AdmTicMngmt.php";
            $this->DatePicker_period1 = & new clsDatePicker("DatePicker_period1", "RRefGenerator", "period", $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @65-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @65-F3DA1C40
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->type->Validate() && $Validation);
        $Validation = ($this->period->Validate() && $Validation);
        $Validation = ($this->currentticket->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->currentticket->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @65-1DF0ECF7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->type->Errors->Count());
        $errors = ($errors || $this->period->Errors->Count());
        $errors = ($errors || $this->currentticket->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->DatePicker_period1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @65-ED598703
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

//Operation Method @65-0BF2B389
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

//InsertRow Method @65-980D6F18
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->type->SetValue($this->type->GetValue(true));
        $this->DataSource->period->SetValue($this->period->GetValue(true));
        $this->DataSource->currentticket->SetValue($this->currentticket->GetValue(true));
        $this->DataSource->Link1->SetValue($this->Link1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @65-7ACB4DCB
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->type->SetValue($this->type->GetValue(true));
        $this->DataSource->period->SetValue($this->period->GetValue(true));
        $this->DataSource->currentticket->SetValue($this->currentticket->GetValue(true));
        $this->DataSource->Link1->SetValue($this->Link1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @65-B124B6DD
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

        $this->type->Prepare();

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
                    $this->type->SetValue($this->DataSource->type->GetValue());
                    $this->period->SetValue($this->DataSource->period->GetValue());
                    $this->currentticket->SetValue($this->DataSource->currentticket->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("type", "id", "ccsForm"));
        $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "new", 1);
        $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "refgen", 1);

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->currentticket->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_period1->Errors->ToString());
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
        $this->type->Show();
        $this->period->Show();
        $this->currentticket->Show();
        $this->Link1->Show();
        $this->DatePicker_period1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RRefGenerator Class @65-FCB6E20C

class clsRRefGeneratorDataSource extends clsDBSMART {  //RRefGeneratorDataSource Class @65-6CBAB5AF

//DataSource Variables @65-3ADAE22E
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
    var $type;
    var $period;
    var $currentticket;
    var $Link1;
//End DataSource Variables

//DataSourceClass_Initialize Event @65-38B9F3B3
    function clsRRefGeneratorDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RRefGenerator/Error";
        $this->Initialize();
        $this->type = new clsField("type", ccsText, "");
        
        $this->period = new clsField("period", ccsDate, $this->DateFormat);
        
        $this->currentticket = new clsField("currentticket", ccsText, "");
        
        $this->Link1 = new clsField("Link1", ccsText, "");
        

        $this->InsertFields["type"] = array("Name" => "type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["period"] = array("Name" => "period", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["currentticket"] = array("Name" => "currentticket", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["type"] = array("Name" => "type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["period"] = array("Name" => "period", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["currentticket"] = array("Name" => "currentticket", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @65-35B33087
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

//Open Method @65-C71932CE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticketgenerator {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @65-0E54AA5F
    function SetValues()
    {
        $this->type->SetDBValue($this->f("type"));
        $this->period->SetDBValue(trim($this->f("period")));
        $this->currentticket->SetDBValue($this->f("currentticket"));
    }
//End SetValues Method

//Insert Method @65-F193E8C3
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["type"]["Value"] = $this->type->GetDBValue(true);
        $this->InsertFields["period"]["Value"] = $this->period->GetDBValue(true);
        $this->InsertFields["currentticket"]["Value"] = $this->currentticket->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_ticketgenerator", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @65-784C8AEE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["type"]["Value"] = $this->type->GetDBValue(true);
        $this->UpdateFields["period"]["Value"] = $this->period->GetDBValue(true);
        $this->UpdateFields["currentticket"]["Value"] = $this->currentticket->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_ticketgenerator", $this->UpdateFields, $this);
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

} //End RRefGeneratorDataSource Class @65-FCB6E20C

class clsGridGRefGenerator { //GRefGenerator class @83-65F9F97F

//Variables @83-AC1EDBB9

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

//Class_Initialize Event @83-E3373A4F
    function clsGridGRefGenerator($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GRefGenerator";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GRefGenerator";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGRefGeneratorDataSource($this);
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

        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->type = & new clsControl(ccsLabel, "type", "type", ccsText, "", CCGetRequestParam("type", ccsGet, NULL), $this);
        $this->period = & new clsControl(ccsLink, "period", "period", ccsDate, $DefaultDateFormat, CCGetRequestParam("period", ccsGet, NULL), $this);
        $this->period->Page = "AdmTicMngmt.php";
        $this->currentticket = & new clsControl(ccsLabel, "currentticket", "currentticket", ccsText, "", CCGetRequestParam("currentticket", ccsGet, NULL), $this);
        $this->datemodified = & new clsControl(ccsLabel, "datemodified", "datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @83-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @83-A5E236A7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["type"] = $this->type->Visible;
            $this->ControlsVisible["period"] = $this->period->Visible;
            $this->ControlsVisible["currentticket"] = $this->currentticket->Visible;
            $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->type->SetValue($this->DataSource->type->GetValue());
                $this->period->SetValue($this->DataSource->period->GetValue());
                $this->period->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->period->Parameters = CCAddParam($this->period->Parameters, "refgen", 1);
                $this->period->Parameters = CCAddParam($this->period->Parameters, "id", $this->DataSource->f("id"));
                $this->currentticket->SetValue($this->DataSource->currentticket->GetValue());
                $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->type->Show();
                $this->period->Show();
                $this->currentticket->Show();
                $this->datemodified->Show();
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

//GetErrors Method @83-C891C01B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->period->Errors->ToString());
        $errors = ComposeStrings($errors, $this->currentticket->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GRefGenerator Class @83-FCB6E20C

class clsGRefGeneratorDataSource extends clsDBSMART {  //GRefGeneratorDataSource Class @83-C8E05310

//DataSource Variables @83-3650F692
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $type;
    var $period;
    var $currentticket;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @83-F59513EB
    function clsGRefGeneratorDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GRefGenerator";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->type = new clsField("type", ccsText, "");
        
        $this->period = new clsField("period", ccsDate, $this->DateFormat);
        
        $this->currentticket = new clsField("currentticket", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @83-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @83-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @83-D59E241E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_ticketgenerator";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticketgenerator {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @83-F62EBAD7
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->type->SetDBValue($this->f("type"));
        $this->period->SetDBValue(trim($this->f("period")));
        $this->currentticket->SetDBValue($this->f("currentticket"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

} //End GRefGeneratorDataSource Class @83-FCB6E20C

//Initialize Page @1-BE5703E9
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
$TemplateFileName = "AdmTicMngmt.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B156DCAF
include_once("./AdmTicMngmt_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-969DFE67
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$RDelTicket = & new clsRecordRDelTicket("", $MainPage);
$SDelTicket = & new clsRecordSDelTicket("", $MainPage);
$GTickets = & new clsGridGTickets("", $MainPage);
$RRefGenerator = & new clsRecordRRefGenerator("", $MainPage);
$GRefGenerator = & new clsGridGRefGenerator("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->RDelTicket = & $RDelTicket;
$MainPage->SDelTicket = & $SDelTicket;
$MainPage->GTickets = & $GTickets;
$MainPage->RRefGenerator = & $RRefGenerator;
$MainPage->GRefGenerator = & $GRefGenerator;
$RDelTicket->Initialize();
$GTickets->Initialize();
$RRefGenerator->Initialize();
$GRefGenerator->Initialize();

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

//Execute Components @1-770BF3B4
$header->Operations();
$footer->Operations();
$RDelTicket->Operation();
$SDelTicket->Operation();
$RRefGenerator->Operation();
//End Execute Components

//Go to destination page @1-2C393FAD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($RDelTicket);
    unset($SDelTicket);
    unset($GTickets);
    unset($RRefGenerator);
    unset($GRefGenerator);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DA117483
$header->Show();
$footer->Show();
$RDelTicket->Show();
$SDelTicket->Show();
$GTickets->Show();
$RRefGenerator->Show();
$GRefGenerator->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F0636E74
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($RDelTicket);
unset($SDelTicket);
unset($GTickets);
unset($RRefGenerator);
unset($GRefGenerator);
unset($Tpl);
//End Unload Page


?>
