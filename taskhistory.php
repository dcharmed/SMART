<?php
//Include Common Files @1-09380D31
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "taskhistory.php");
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

class clsGridGTaskHistory { //GTaskHistory class @5-C0E17FA1

//Variables @5-F562C301

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
    var $Sorter_id;
    var $Sorter_tckt_refnumber;
    var $Sorter_tckt_r_date;
    var $Sorter_task_current;
    var $Sorter_task_update;
    var $Sorter_task_currenteng;
    var $Sorter_task_updatedeng;
    var $Sorter_task_status;
    var $Sorter_task_date;
//End Variables

//Class_Initialize Event @5-BFEAA18F
    function clsGridGTaskHistory($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GTaskHistory";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GTaskHistory";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGTaskHistoryDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("GTaskHistoryOrder", "");
        $this->SorterDirection = CCGetParam("GTaskHistoryDir", "");

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->tckt_refnumber = & new clsControl(ccsLabel, "tckt_refnumber", "tckt_refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", ccsGet, NULL), $this);
        $this->tckt_r_date = & new clsControl(ccsLabel, "tckt_r_date", "tckt_r_date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_r_date", ccsGet, NULL), $this);
        $this->task_current = & new clsControl(ccsLabel, "task_current", "task_current", ccsInteger, "", CCGetRequestParam("task_current", ccsGet, NULL), $this);
        $this->task_update = & new clsControl(ccsLabel, "task_update", "task_update", ccsText, "", CCGetRequestParam("task_update", ccsGet, NULL), $this);
        $this->task_currenteng = & new clsControl(ccsLabel, "task_currenteng", "task_currenteng", ccsInteger, "", CCGetRequestParam("task_currenteng", ccsGet, NULL), $this);
        $this->task_updatedeng = & new clsControl(ccsLabel, "task_updatedeng", "task_updatedeng", ccsInteger, "", CCGetRequestParam("task_updatedeng", ccsGet, NULL), $this);
        $this->task_status = & new clsControl(ccsLabel, "task_status", "task_status", ccsText, "", CCGetRequestParam("task_status", ccsGet, NULL), $this);
        $this->task_notes = & new clsControl(ccsLabel, "task_notes", "task_notes", ccsMemo, "", CCGetRequestParam("task_notes", ccsGet, NULL), $this);
        $this->task_notes->HTML = true;
        $this->task_date = & new clsControl(ccsLabel, "task_date", "task_date", ccsDate, array("GeneralDate"), CCGetRequestParam("task_date", ccsGet, NULL), $this);
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_tckt_refnumber = & new clsSorter($this->ComponentName, "Sorter_tckt_refnumber", $FileName, $this);
        $this->Sorter_tckt_r_date = & new clsSorter($this->ComponentName, "Sorter_tckt_r_date", $FileName, $this);
        $this->Sorter_task_current = & new clsSorter($this->ComponentName, "Sorter_task_current", $FileName, $this);
        $this->Sorter_task_update = & new clsSorter($this->ComponentName, "Sorter_task_update", $FileName, $this);
        $this->Sorter_task_currenteng = & new clsSorter($this->ComponentName, "Sorter_task_currenteng", $FileName, $this);
        $this->Sorter_task_updatedeng = & new clsSorter($this->ComponentName, "Sorter_task_updatedeng", $FileName, $this);
        $this->Sorter_task_status = & new clsSorter($this->ComponentName, "Sorter_task_status", $FileName, $this);
        $this->Sorter_task_date = & new clsSorter($this->ComponentName, "Sorter_task_date", $FileName, $this);
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

//Show Method @5-7975CF37
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_tckt"] = CCGetFromGet("s_tckt", NULL);
        $this->DataSource->Parameters["urls_eg"] = CCGetFromGet("s_eg", NULL);
        $this->DataSource->Parameters["urls_ts"] = CCGetFromGet("s_ts", NULL);

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
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["tckt_r_date"] = $this->tckt_r_date->Visible;
            $this->ControlsVisible["task_current"] = $this->task_current->Visible;
            $this->ControlsVisible["task_update"] = $this->task_update->Visible;
            $this->ControlsVisible["task_currenteng"] = $this->task_currenteng->Visible;
            $this->ControlsVisible["task_updatedeng"] = $this->task_updatedeng->Visible;
            $this->ControlsVisible["task_status"] = $this->task_status->Visible;
            $this->ControlsVisible["task_notes"] = $this->task_notes->Visible;
            $this->ControlsVisible["task_date"] = $this->task_date->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                $this->task_current->SetValue($this->DataSource->task_current->GetValue());
                $this->task_update->SetValue($this->DataSource->task_update->GetValue());
                $this->task_currenteng->SetValue($this->DataSource->task_currenteng->GetValue());
                $this->task_updatedeng->SetValue($this->DataSource->task_updatedeng->GetValue());
                $this->task_status->SetValue($this->DataSource->task_status->GetValue());
                $this->task_notes->SetValue($this->DataSource->task_notes->GetValue());
                $this->task_date->SetValue($this->DataSource->task_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->tckt_refnumber->Show();
                $this->tckt_r_date->Show();
                $this->task_current->Show();
                $this->task_update->Show();
                $this->task_currenteng->Show();
                $this->task_updatedeng->Show();
                $this->task_status->Show();
                $this->task_notes->Show();
                $this->task_date->Show();
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
        $this->Sorter_id->Show();
        $this->Sorter_tckt_refnumber->Show();
        $this->Sorter_tckt_r_date->Show();
        $this->Sorter_task_current->Show();
        $this->Sorter_task_update->Show();
        $this->Sorter_task_currenteng->Show();
        $this->Sorter_task_updatedeng->Show();
        $this->Sorter_task_status->Show();
        $this->Sorter_task_date->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-5ADFA5CA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_current->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_currenteng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_updatedeng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_notes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GTaskHistory Class @5-FCB6E20C

class clsGTaskHistoryDataSource extends clsDBSMART {  //GTaskHistoryDataSource Class @5-049683B9

//DataSource Variables @5-BEF088B0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lblNumber;
    var $tckt_refnumber;
    var $tckt_r_date;
    var $task_current;
    var $task_update;
    var $task_currenteng;
    var $task_updatedeng;
    var $task_status;
    var $task_notes;
    var $task_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-B5251597
    function clsGTaskHistoryDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GTaskHistory";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->task_current = new clsField("task_current", ccsInteger, "");
        
        $this->task_update = new clsField("task_update", ccsText, "");
        
        $this->task_currenteng = new clsField("task_currenteng", ccsInteger, "");
        
        $this->task_updatedeng = new clsField("task_updatedeng", ccsInteger, "");
        
        $this->task_status = new clsField("task_status", ccsText, "");
        
        $this->task_notes = new clsField("task_notes", ccsMemo, "");
        
        $this->task_date = new clsField("task_date", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-8B0A0927
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "task_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("smart_task.id", ""), 
            "Sorter_tckt_refnumber" => array("tckt_refnumber", ""), 
            "Sorter_tckt_r_date" => array("tckt_r_date", ""), 
            "Sorter_task_current" => array("task_current", ""), 
            "Sorter_task_update" => array("task_update", ""), 
            "Sorter_task_currenteng" => array("task_currenteng", ""), 
            "Sorter_task_updatedeng" => array("task_updatedeng", ""), 
            "Sorter_task_status" => array("task_status", ""), 
            "Sorter_task_date" => array("task_date", "")));
    }
//End SetOrder Method

//Prepare Method @5-DE5C8DD1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_tckt", ccsText, "", "", $this->Parameters["urls_tckt"], "", false);
        $this->wp->AddParameter("2", "urls_eg", ccsInteger, "", "", $this->Parameters["urls_eg"], "", false);
        $this->wp->AddParameter("3", "urls_eg", ccsInteger, "", "", $this->Parameters["urls_eg"], "", false);
        $this->wp->AddParameter("4", "urls_ts", ccsText, "", "", $this->Parameters["urls_ts"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "smart_ticket.tckt_refnumber", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "smart_task.task_currenteng", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "smart_task.task_updatedeng", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "smart_task.task_status", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opOR(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3])), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @5-6D538731
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_task LEFT JOIN smart_ticket ON\n\n" .
        "smart_task.ticket_id = smart_ticket.id";
        $this->SQL = "SELECT smart_task.*, tckt_refnumber, tckt_status, tckt_r_date \n\n" .
        "FROM smart_task LEFT JOIN smart_ticket ON\n\n" .
        "smart_task.ticket_id = smart_ticket.id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-69EC34CE
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->task_current->SetDBValue(trim($this->f("task_current")));
        $this->task_update->SetDBValue($this->f("task_update"));
        $this->task_currenteng->SetDBValue(trim($this->f("task_currenteng")));
        $this->task_updatedeng->SetDBValue(trim($this->f("task_updatedeng")));
        $this->task_status->SetDBValue($this->f("task_status"));
        $this->task_notes->SetDBValue($this->f("task_notes"));
        $this->task_date->SetDBValue(trim($this->f("task_date")));
    }
//End SetValues Method

} //End GTaskHistoryDataSource Class @5-FCB6E20C

class clsRecordSTaskHistory { //STaskHistory Class @13-D98EC3A1

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

//Class_Initialize Event @13-972E73EC
    function clsRecordSTaskHistory($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record STaskHistory/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "STaskHistory";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_eg = & new clsControl(ccsListBox, "s_eg", "s_eg", ccsInteger, "", CCGetRequestParam("s_eg", $Method, NULL), $this);
            $this->s_eg->DSType = dsTable;
            $this->s_eg->DataSource = new clsDBSMART();
            $this->s_eg->ds = & $this->s_eg->DataSource;
            $this->s_eg->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            $this->s_eg->DataSource->Order = "usr_fullname";
            list($this->s_eg->BoundColumn, $this->s_eg->TextColumn, $this->s_eg->DBFormat) = array("id", "usr_fullname", "");
            $this->s_eg->DataSource->Order = "usr_fullname";
            $this->s_tckt = & new clsControl(ccsTextBox, "s_tckt", "s_tckt", ccsInteger, "", CCGetRequestParam("s_tckt", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_ts = & new clsControl(ccsListBox, "s_ts", "s_ts", ccsText, "", CCGetRequestParam("s_ts", $Method, NULL), $this);
            $this->s_ts->DSType = dsTable;
            $this->s_ts->DataSource = new clsDBSMART();
            $this->s_ts->ds = & $this->s_ts->DataSource;
            $this->s_ts->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->s_ts->DataSource->Order = "ref_rank";
            list($this->s_ts->BoundColumn, $this->s_ts->TextColumn, $this->s_ts->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_ts->DataSource->Parameters["expr48"] = taskstatus;
            $this->s_ts->DataSource->wp = new clsSQLParameters();
            $this->s_ts->DataSource->wp->AddParameter("1", "expr48", ccsText, "", "", $this->s_ts->DataSource->Parameters["expr48"], "", false);
            $this->s_ts->DataSource->wp->Criterion[1] = $this->s_ts->DataSource->wp->Operation(opEqual, "ref_type", $this->s_ts->DataSource->wp->GetDBValue("1"), $this->s_ts->DataSource->ToSQL($this->s_ts->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_ts->DataSource->Where = 
                 $this->s_ts->DataSource->wp->Criterion[1];
            $this->s_ts->DataSource->Order = "ref_rank";
        }
    }
//End Class_Initialize Event

//Validate Method @13-0EE00387
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_eg->Validate() && $Validation);
        $Validation = ($this->s_tckt->Validate() && $Validation);
        $Validation = ($this->s_ts->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_eg->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tckt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ts->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @13-C4FCDAAD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_eg->Errors->Count());
        $errors = ($errors || $this->s_tckt->Errors->Count());
        $errors = ($errors || $this->s_ts->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @13-031E4041
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
        $Redirect = "taskhistory.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "taskhistory.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @13-44E3F656
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

        $this->s_eg->Prepare();
        $this->s_ts->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_eg->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tckt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ts->Errors->ToString());
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

        $this->s_eg->Show();
        $this->s_tckt->Show();
        $this->Button_DoSearch->Show();
        $this->s_ts->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End STaskHistory Class @13-FCB6E20C

//Initialize Page @1-F9025E55
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
$TemplateFileName = "taskhistory.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D90866CB
include_once("./taskhistory_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AD9F505E
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GTaskHistory = & new clsGridGTaskHistory("", $MainPage);
$STaskHistory = & new clsRecordSTaskHistory("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GTaskHistory = & $GTaskHistory;
$MainPage->STaskHistory = & $STaskHistory;
$GTaskHistory->Initialize();

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

//Execute Components @1-DD4898AF
$header->Operations();
$footer->Operations();
$STaskHistory->Operation();
//End Execute Components

//Go to destination page @1-BB9CA7BC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GTaskHistory);
    unset($STaskHistory);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B17469DA
$header->Show();
$footer->Show();
$GTaskHistory->Show();
$STaskHistory->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A6D9C0E2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GTaskHistory);
unset($STaskHistory);
unset($Tpl);
//End Unload Page


?>
