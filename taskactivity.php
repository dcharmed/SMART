<?php
//Include Common Files @1-B723162E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "taskactivity.php");
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

class clsGridGSmartTicket { //GSmartTicket class @77-D5A51536

//Variables @77-0AC27327

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
    var $Sorter_tckt_helpdesk;
    var $Sorter_tckt_eng;
//End Variables

//Class_Initialize Event @77-BBABC414
    function clsGridGSmartTicket($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSmartTicket";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSmartTicket";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSmartTicketDataSource($this);
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
        $this->SorterName = CCGetParam("GSmartTicketOrder", "");
        $this->SorterDirection = CCGetParam("GSmartTicketDir", "");

        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->tckt_refnumber = & new clsControl(ccsLink, "tckt_refnumber", "tckt_refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", ccsGet, NULL), $this);
        $this->tckt_refnumber->Page = "taskactivity.php";
        $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "tckt_status", ccsInteger, "", CCGetRequestParam("tckt_status", ccsGet, NULL), $this);
        $this->tckt_status->HTML = true;
        $this->tckt_date = & new clsControl(ccsLabel, "tckt_date", "tckt_date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_date", ccsGet, NULL), $this);
        $this->tckt_branch = & new clsControl(ccsLabel, "tckt_branch", "tckt_branch", ccsText, "", CCGetRequestParam("tckt_branch", ccsGet, NULL), $this);
        $this->tckt_helpdesk = & new clsControl(ccsLabel, "tckt_helpdesk", "tckt_helpdesk", ccsText, "", CCGetRequestParam("tckt_helpdesk", ccsGet, NULL), $this);
        $this->tckt_description = & new clsControl(ccsLabel, "tckt_description", "tckt_description", ccsMemo, "", CCGetRequestParam("tckt_description", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->tckt_state = & new clsControl(ccsHidden, "tckt_state", "tckt_state", ccsText, "", CCGetRequestParam("tckt_state", ccsGet, NULL), $this);
        $this->tckt_age = & new clsControl(ccsLabel, "tckt_age", "tckt_age", ccsInteger, "", CCGetRequestParam("tckt_age", ccsGet, NULL), $this);
        $this->tckt_age->HTML = true;
        $this->tcktEng = & new clsControl(ccsLabel, "tcktEng", "tcktEng", ccsText, "", CCGetRequestParam("tcktEng", ccsGet, NULL), $this);
        $this->tckt_closeddate = & new clsControl(ccsHidden, "tckt_closeddate", "tckt_closeddate", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_closeddate", ccsGet, NULL), $this);
        $this->Sorter_tckt_refnumber = & new clsSorter($this->ComponentName, "Sorter_tckt_refnumber", $FileName, $this);
        $this->Sorter_tckt_status = & new clsSorter($this->ComponentName, "Sorter_tckt_status", $FileName, $this);
        $this->Sorter_tckt_date = & new clsSorter($this->ComponentName, "Sorter_tckt_date", $FileName, $this);
        $this->Sorter_tckt_branch = & new clsSorter($this->ComponentName, "Sorter_tckt_branch", $FileName, $this);
        $this->Sorter_tckt_helpdesk = & new clsSorter($this->ComponentName, "Sorter_tckt_helpdesk", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Sorter_tckt_eng = & new clsSorter($this->ComponentName, "Sorter_tckt_eng", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @77-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @77-9DF38FE7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr128"] = 7;
        $this->DataSource->Parameters["expr121"] = 1;
        $this->DataSource->Parameters["expr150"] = 1;

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
            $this->ControlsVisible["tckt_helpdesk"] = $this->tckt_helpdesk->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["tckt_state"] = $this->tckt_state->Visible;
            $this->ControlsVisible["tckt_age"] = $this->tckt_age->Visible;
            $this->ControlsVisible["tcktEng"] = $this->tcktEng->Visible;
            $this->ControlsVisible["tckt_closeddate"] = $this->tckt_closeddate->Visible;
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
                $this->tckt_refnumber->Parameters = CCAddParam($this->tckt_refnumber->Parameters, "tcktid", $this->DataSource->f("ticket_id"));
                $this->tckt_refnumber->Parameters = CCAddParam($this->tckt_refnumber->Parameters, "det", 1);
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_date->SetValue($this->DataSource->tckt_date->GetValue());
                $this->tckt_branch->SetValue($this->DataSource->tckt_branch->GetValue());
                $this->tckt_helpdesk->SetValue($this->DataSource->tckt_helpdesk->GetValue());
                $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->tcktEng->SetValue($this->DataSource->tcktEng->GetValue());
                $this->tckt_closeddate->SetValue($this->DataSource->tckt_closeddate->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->tckt_refnumber->Show();
                $this->tckt_status->Show();
                $this->tckt_date->Show();
                $this->tckt_branch->Show();
                $this->tckt_helpdesk->Show();
                $this->tckt_description->Show();
                $this->lblNumber->Show();
                $this->tckt_state->Show();
                $this->tckt_age->Show();
                $this->tcktEng->Show();
                $this->tckt_closeddate->Show();
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
        $this->Sorter_tckt_refnumber->Show();
        $this->Sorter_tckt_status->Show();
        $this->Sorter_tckt_date->Show();
        $this->Sorter_tckt_branch->Show();
        $this->Sorter_tckt_helpdesk->Show();
        $this->Navigator->Show();
        $this->Sorter_tckt_eng->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @77-AA834BD2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_helpdesk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktEng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_closeddate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSmartTicket Class @77-FCB6E20C

class clsGSmartTicketDataSource extends clsDBSMART {  //GSmartTicketDataSource Class @77-CAB5DA07

//DataSource Variables @77-1B81EF55
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
    var $tckt_helpdesk;
    var $tckt_description;
    var $tckt_state;
    var $tcktEng;
    var $tckt_closeddate;
//End DataSource Variables

//DataSourceClass_Initialize Event @77-31722C5C
    function clsGSmartTicketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSmartTicket";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_date = new clsField("tckt_date", ccsDate, $this->DateFormat);
        
        $this->tckt_branch = new clsField("tckt_branch", ccsText, "");
        
        $this->tckt_helpdesk = new clsField("tckt_helpdesk", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->tcktEng = new clsField("tcktEng", ccsText, "");
        
        $this->tckt_closeddate = new clsField("tckt_closeddate", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @77-BC11DF1D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "smart_ticket.tckt_r_date";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tckt_refnumber" => array("tckt_refnumber", ""), 
            "Sorter_tckt_status" => array("tckt_status", ""), 
            "Sorter_tckt_date" => array("tckt_date", ""), 
            "Sorter_tckt_branch" => array("tckt_branch", ""), 
            "Sorter_tckt_helpdesk" => array("tckt_r_helpdesk", ""), 
            "Sorter_tckt_eng" => array("tckt_status", "")));
    }
//End SetOrder Method

//Prepare Method @77-9478566C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr128", ccsInteger, "", "", $this->Parameters["expr128"], "", false);
        $this->wp->AddParameter("2", "expr121", ccsInteger, "", "", $this->Parameters["expr121"], "", false);
        $this->wp->AddParameter("3", "expr150", ccsInteger, "", "", $this->Parameters["expr150"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opLessThan, "smart_ticket.tckt_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opLessThan, "smart_task.task_status", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opGreaterThan, "smart_task.task_status", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opOR(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]));
    }
//End Prepare Method

//Open Method @77-ECBE2117
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_ticket RIGHT JOIN smart_task ON\n\n" .
        "smart_ticket.id = smart_task.ticket_id {SQL_Where}\n\n" .
        "GROUP BY ticket_id {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @77-44B5E8DB
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_branch->SetDBValue($this->f("tckt_site"));
        $this->tckt_helpdesk->SetDBValue($this->f("tckt_r_helpdesk"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->tcktEng->SetDBValue($this->f("task_currenteng"));
        $this->tckt_closeddate->SetDBValue(trim($this->f("tckt_c_date")));
    }
//End SetValues Method

} //End GSmartTicketDataSource Class @77-FCB6E20C

class clsGridGSmartTask { //GSmartTask class @5-A897335F

//Variables @5-E6E779CB

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
    var $Sorter_ticket_id;
    var $Sorter_id;
    var $Sorter_task_status;
    var $Sorter_task_currenteng;
    var $Sorter_task_updatedeng;
//End Variables

//Class_Initialize Event @5-5501F817
    function clsGridGSmartTask($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSmartTask";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSmartTask";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSmartTaskDataSource($this);
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
        $this->SorterName = CCGetParam("GSmartTaskOrder", "");
        $this->SorterDirection = CCGetParam("GSmartTaskDir", "");

        $this->ticket_id = & new clsControl(ccsLabel, "ticket_id", "ticket_id", ccsText, "", CCGetRequestParam("ticket_id", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->task_status = & new clsControl(ccsLabel, "task_status", "task_status", ccsText, "", CCGetRequestParam("task_status", ccsGet, NULL), $this);
        $this->task_currenteng = & new clsControl(ccsLabel, "task_currenteng", "task_currenteng", ccsInteger, "", CCGetRequestParam("task_currenteng", ccsGet, NULL), $this);
        $this->task_updatedeng = & new clsControl(ccsLabel, "task_updatedeng", "task_updatedeng", ccsInteger, "", CCGetRequestParam("task_updatedeng", ccsGet, NULL), $this);
        $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "tckt_severity", ccsText, "", CCGetRequestParam("tckt_severity", ccsGet, NULL), $this);
        $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "tckt_site", ccsText, "", CCGetRequestParam("tckt_site", ccsGet, NULL), $this);
        $this->lblView = & new clsControl(ccsImageLink, "lblView", "lblView", ccsText, "", CCGetRequestParam("lblView", ccsGet, NULL), $this);
        $this->lblView->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lblView->Page = "taskactivity.php";
        $this->tckt_state = & new clsControl(ccsHidden, "tckt_state", "tckt_state", ccsText, "", CCGetRequestParam("tckt_state", ccsGet, NULL), $this);
        $this->task_id = & new clsControl(ccsHidden, "task_id", "task_id", ccsText, "", CCGetRequestParam("task_id", ccsGet, NULL), $this);
        $this->task_remark = & new clsControl(ccsLabel, "task_remark", "task_remark", ccsText, "", CCGetRequestParam("task_remark", ccsGet, NULL), $this);
        $this->task_remark->HTML = true;
        $this->Sorter_ticket_id = & new clsSorter($this->ComponentName, "Sorter_ticket_id", $FileName, $this);
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_task_status = & new clsSorter($this->ComponentName, "Sorter_task_status", $FileName, $this);
        $this->Sorter_task_currenteng = & new clsSorter($this->ComponentName, "Sorter_task_currenteng", $FileName, $this);
        $this->Sorter_task_updatedeng = & new clsSorter($this->ComponentName, "Sorter_task_updatedeng", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblTicket = & new clsControl(ccsLabel, "lblTicket", "lblTicket", ccsText, "", CCGetRequestParam("lblTicket", ccsGet, NULL), $this);
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

//Show Method @5-6922F4A4
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
            $this->ControlsVisible["ticket_id"] = $this->ticket_id->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["task_status"] = $this->task_status->Visible;
            $this->ControlsVisible["task_currenteng"] = $this->task_currenteng->Visible;
            $this->ControlsVisible["task_updatedeng"] = $this->task_updatedeng->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["lblView"] = $this->lblView->Visible;
            $this->ControlsVisible["tckt_state"] = $this->tckt_state->Visible;
            $this->ControlsVisible["task_id"] = $this->task_id->Visible;
            $this->ControlsVisible["task_remark"] = $this->task_remark->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                $this->task_status->SetValue($this->DataSource->task_status->GetValue());
                $this->task_currenteng->SetValue($this->DataSource->task_currenteng->GetValue());
                $this->task_updatedeng->SetValue($this->DataSource->task_updatedeng->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->lblView->SetValue($this->DataSource->lblView->GetValue());
                $this->tckt_state->SetValue($this->DataSource->tckt_state->GetValue());
                $this->task_id->SetValue($this->DataSource->task_id->GetValue());
                $this->task_remark->SetValue($this->DataSource->task_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ticket_id->Show();
                $this->lblNumber->Show();
                $this->task_status->Show();
                $this->task_currenteng->Show();
                $this->task_updatedeng->Show();
                $this->tckt_severity->Show();
                $this->tckt_site->Show();
                $this->lblView->Show();
                $this->tckt_state->Show();
                $this->task_id->Show();
                $this->task_remark->Show();
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
        $this->lblTicket->SetValue($this->DataSource->lblTicket->GetValue());
        $this->Sorter_ticket_id->Show();
        $this->Sorter_id->Show();
        $this->Sorter_task_status->Show();
        $this->Sorter_task_currenteng->Show();
        $this->Sorter_task_updatedeng->Show();
        $this->Navigator->Show();
        $this->lblTicket->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-30FF2350
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ticket_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_currenteng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_updatedeng->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblView->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSmartTask Class @5-FCB6E20C

class clsGSmartTaskDataSource extends clsDBSMART {  //GSmartTaskDataSource Class @5-4C2C0F46

//DataSource Variables @5-85FE70D8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ticket_id;
    var $task_status;
    var $task_currenteng;
    var $task_updatedeng;
    var $tckt_severity;
    var $tckt_site;
    var $lblView;
    var $tckt_state;
    var $lblTicket;
    var $task_id;
    var $task_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-BBEF4CB9
    function clsGSmartTaskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSmartTask";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsText, "");
        
        $this->task_status = new clsField("task_status", ccsText, "");
        
        $this->task_currenteng = new clsField("task_currenteng", ccsInteger, "");
        
        $this->task_updatedeng = new clsField("task_updatedeng", ccsInteger, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->lblView = new clsField("lblView", ccsText, "");
        
        $this->tckt_state = new clsField("tckt_state", ccsText, "");
        
        $this->lblTicket = new clsField("lblTicket", ccsText, "");
        
        $this->task_id = new clsField("task_id", ccsText, "");
        
        $this->task_remark = new clsField("task_remark", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-386B09F7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ticket_id" => array("ticket_id", ""), 
            "Sorter_id" => array("id", ""), 
            "Sorter_task_status" => array("task_status", ""), 
            "Sorter_task_currenteng" => array("task_currenteng", ""), 
            "Sorter_task_updatedeng" => array("task_updatedeng", "")));
    }
//End SetOrder Method

//Prepare Method @5-B233C364
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltcktid", ccsInteger, "", "", $this->Parameters["urltcktid"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_task.ticket_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-DFD25C11
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_task INNER JOIN smart_ticket ON\n\n" .
        "smart_task.ticket_id = smart_ticket.id";
        $this->SQL = "SELECT smart_task.id AS smart_task_id, ticket_id, task_current, task_update, task_currenteng, task_updatedeng, task_notes, task_date,\n\n" .
        "smart_task.datemodified AS smart_task_datemodified, tckt_refnumber, tckt_site, tckt_severity, tckt_state, task_status \n\n" .
        "FROM smart_task INNER JOIN smart_ticket ON\n\n" .
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

//SetValues Method @5-8236891C
    function SetValues()
    {
        $this->ticket_id->SetDBValue($this->f("tckt_refnumber"));
        $this->task_status->SetDBValue($this->f("task_status"));
        $this->task_currenteng->SetDBValue(trim($this->f("task_currenteng")));
        $this->task_updatedeng->SetDBValue(trim($this->f("task_updatedeng")));
        $this->tckt_severity->SetDBValue($this->f("tckt_severity"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->lblView->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_state->SetDBValue($this->f("tckt_state"));
        $this->lblTicket->SetDBValue($this->f("tckt_refnumber"));
        $this->task_id->SetDBValue($this->f("smart_task_id"));
        $this->task_remark->SetDBValue($this->f("task_notes"));
    }
//End SetValues Method

} //End GSmartTaskDataSource Class @5-FCB6E20C

class clsRecordRSmartTask { //RSmartTask Class @36-558A761D

//Variables @36-D6FF3E86

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

//Class_Initialize Event @36-B4179510
    function clsRecordRSmartTask($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSmartTask/Error";
        $this->DataSource = new clsRSmartTaskDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSmartTask";
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
            $this->task_current = & new clsControl(ccsTextBox, "task_current", "Task Current", ccsInteger, "", CCGetRequestParam("task_current", $Method, NULL), $this);
            $this->task_notes = & new clsControl(ccsTextArea, "task_notes", "Task Notes", ccsMemo, "", CCGetRequestParam("task_notes", $Method, NULL), $this);
            $this->task_date = & new clsControl(ccsTextBox, "task_date", "Task Date", ccsDate, array("GeneralDate"), CCGetRequestParam("task_date", $Method, NULL), $this);
            $this->DatePicker_task_date = & new clsDatePicker("DatePicker_task_date", "RSmartTask", "task_date", $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->taskStatus = & new clsControl(ccsRadioButton, "taskStatus", "taskStatus", ccsText, "", CCGetRequestParam("taskStatus", $Method, NULL), $this);
            $this->taskStatus->DSType = dsTable;
            $this->taskStatus->DataSource = new clsDBSMART();
            $this->taskStatus->ds = & $this->taskStatus->DataSource;
            $this->taskStatus->DataSource->SQL = "SELECT ref_value, ref_description \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->taskStatus->BoundColumn, $this->taskStatus->TextColumn, $this->taskStatus->DBFormat) = array("ref_value", "ref_description", "");
            $this->taskStatus->DataSource->Parameters["expr53"] = taskstatus;
            $this->taskStatus->DataSource->Parameters["expr186"] = 0;
            $this->taskStatus->DataSource->wp = new clsSQLParameters();
            $this->taskStatus->DataSource->wp->AddParameter("1", "expr53", ccsText, "", "", $this->taskStatus->DataSource->Parameters["expr53"], "", false);
            $this->taskStatus->DataSource->wp->AddParameter("2", "expr186", ccsText, "", "", $this->taskStatus->DataSource->Parameters["expr186"], "", false);
            $this->taskStatus->DataSource->wp->Criterion[1] = $this->taskStatus->DataSource->wp->Operation(opEqual, "ref_type", $this->taskStatus->DataSource->wp->GetDBValue("1"), $this->taskStatus->DataSource->ToSQL($this->taskStatus->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->taskStatus->DataSource->wp->Criterion[2] = $this->taskStatus->DataSource->wp->Operation(opNotEqual, "ref_value", $this->taskStatus->DataSource->wp->GetDBValue("2"), $this->taskStatus->DataSource->ToSQL($this->taskStatus->DataSource->wp->GetDBValue("2"), ccsText),false);
            $this->taskStatus->DataSource->Where = $this->taskStatus->DataSource->wp->opAND(
                 false, 
                 $this->taskStatus->DataSource->wp->Criterion[1], 
                 $this->taskStatus->DataSource->wp->Criterion[2]);
            $this->taskStatus->HTML = true;
            $this->taskStatus->Required = true;
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, array("GeneralDate"), CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->ticketRef = & new clsControl(ccsTextBox, "ticketRef", "ticketRef", ccsText, "", CCGetRequestParam("ticketRef", $Method, NULL), $this);
            $this->task_neweng = & new clsControl(ccsTextBox, "task_neweng", "task_neweng", ccsText, "", CCGetRequestParam("task_neweng", $Method, NULL), $this);
            $this->task_currenteng = & new clsControl(ccsTextBox, "task_currenteng", "task_currenteng", ccsText, "", CCGetRequestParam("task_currenteng", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->task_date->Value) && !strlen($this->task_date->Value) && $this->task_date->Value !== false)
                    $this->task_date->SetValue(time());
                if(!is_array($this->datemodified->Value) && !strlen($this->datemodified->Value) && $this->datemodified->Value !== false)
                    $this->datemodified->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @36-6F53F6D6
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltid"] = CCGetFromGet("tid", NULL);
    }
//End Initialize Method

//Validate Method @36-0984CD29
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->task_current->Validate() && $Validation);
        $Validation = ($this->task_notes->Validate() && $Validation);
        $Validation = ($this->task_date->Validate() && $Validation);
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->taskStatus->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->ticketRef->Validate() && $Validation);
        $Validation = ($this->task_neweng->Validate() && $Validation);
        $Validation = ($this->task_currenteng->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->task_current->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_notes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->taskStatus->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticketRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_neweng->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_currenteng->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @36-041D811A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->task_current->Errors->Count());
        $errors = ($errors || $this->task_notes->Errors->Count());
        $errors = ($errors || $this->task_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_task_date->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->taskStatus->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->ticketRef->Errors->Count());
        $errors = ($errors || $this->task_neweng->Errors->Count());
        $errors = ($errors || $this->task_currenteng->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @36-ED598703
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

//Operation Method @36-D5616C34
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "tid"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "det", "tid"));
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

//InsertRow Method @36-29710655
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->task_current->SetValue($this->task_current->GetValue(true));
        $this->DataSource->task_notes->SetValue($this->task_notes->GetValue(true));
        $this->DataSource->task_date->SetValue($this->task_date->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->taskStatus->SetValue($this->taskStatus->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->ticketRef->SetValue($this->ticketRef->GetValue(true));
        $this->DataSource->task_neweng->SetValue($this->task_neweng->GetValue(true));
        $this->DataSource->task_currenteng->SetValue($this->task_currenteng->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @36-E1330D72
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->task_current->SetValue($this->task_current->GetValue(true));
        $this->DataSource->task_notes->SetValue($this->task_notes->GetValue(true));
        $this->DataSource->task_date->SetValue($this->task_date->GetValue(true));
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->taskStatus->SetValue($this->taskStatus->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->ticketRef->SetValue($this->ticketRef->GetValue(true));
        $this->DataSource->task_neweng->SetValue($this->task_neweng->GetValue(true));
        $this->DataSource->task_currenteng->SetValue($this->task_currenteng->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @36-D5C5D95A
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

        $this->taskStatus->Prepare();

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
                    $this->task_current->SetValue($this->DataSource->task_current->GetValue());
                    $this->task_notes->SetValue($this->DataSource->task_notes->GetValue());
                    $this->task_date->SetValue($this->DataSource->task_date->GetValue());
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->taskStatus->SetValue($this->DataSource->taskStatus->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->task_neweng->SetValue($this->DataSource->task_neweng->GetValue());
                    $this->task_currenteng->SetValue($this->DataSource->task_currenteng->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->task_current->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_notes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_task_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->taskStatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_neweng->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_currenteng->Errors->ToString());
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
        $this->task_current->Show();
        $this->task_notes->Show();
        $this->task_date->Show();
        $this->DatePicker_task_date->Show();
        $this->ticket_id->Show();
        $this->taskStatus->Show();
        $this->datemodified->Show();
        $this->ticketRef->Show();
        $this->task_neweng->Show();
        $this->task_currenteng->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSmartTask Class @36-FCB6E20C

class clsRSmartTaskDataSource extends clsDBSMART {  //RSmartTaskDataSource Class @36-2FA6FC82

//DataSource Variables @36-20AC854C
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
    var $task_current;
    var $task_notes;
    var $task_date;
    var $ticket_id;
    var $taskStatus;
    var $datemodified;
    var $ticketRef;
    var $task_neweng;
    var $task_currenteng;
//End DataSource Variables

//DataSourceClass_Initialize Event @36-4907B960
    function clsRSmartTaskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSmartTask/Error";
        $this->Initialize();
        $this->task_current = new clsField("task_current", ccsInteger, "");
        
        $this->task_notes = new clsField("task_notes", ccsMemo, "");
        
        $this->task_date = new clsField("task_date", ccsDate, $this->DateFormat);
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->taskStatus = new clsField("taskStatus", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->ticketRef = new clsField("ticketRef", ccsText, "");
        
        $this->task_neweng = new clsField("task_neweng", ccsText, "");
        
        $this->task_currenteng = new clsField("task_currenteng", ccsText, "");
        

        $this->InsertFields["task_update"] = array("Name" => "task_update", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_notes"] = array("Name" => "task_notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["task_date"] = array("Name" => "task_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["task_status"] = array("Name" => "task_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["task_updatedeng"] = array("Name" => "task_updatedeng", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["task_currenteng"] = array("Name" => "task_currenteng", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_update"] = array("Name" => "task_update", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_notes"] = array("Name" => "task_notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_date"] = array("Name" => "task_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_status"] = array("Name" => "task_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_updatedeng"] = array("Name" => "task_updatedeng", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["task_currenteng"] = array("Name" => "task_currenteng", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @36-510A1766
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltid", ccsInteger, "", "", $this->Parameters["urltid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @36-9AC22D9E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_task {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @36-8E1DB5FC
    function SetValues()
    {
        $this->task_current->SetDBValue(trim($this->f("task_update")));
        $this->task_notes->SetDBValue($this->f("task_notes"));
        $this->task_date->SetDBValue(trim($this->f("task_date")));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->taskStatus->SetDBValue($this->f("task_status"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->task_neweng->SetDBValue($this->f("task_updatedeng"));
        $this->task_currenteng->SetDBValue($this->f("task_currenteng"));
    }
//End SetValues Method

//Insert Method @36-4562CC09
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["task_update"]["Value"] = $this->task_current->GetDBValue(true);
        $this->InsertFields["task_notes"]["Value"] = $this->task_notes->GetDBValue(true);
        $this->InsertFields["task_date"]["Value"] = $this->task_date->GetDBValue(true);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["task_status"]["Value"] = $this->taskStatus->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["task_updatedeng"]["Value"] = $this->task_neweng->GetDBValue(true);
        $this->InsertFields["task_currenteng"]["Value"] = $this->task_currenteng->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_task", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @36-E118AAA2
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["task_update"]["Value"] = $this->task_current->GetDBValue(true);
        $this->UpdateFields["task_notes"]["Value"] = $this->task_notes->GetDBValue(true);
        $this->UpdateFields["task_date"]["Value"] = $this->task_date->GetDBValue(true);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["task_status"]["Value"] = $this->taskStatus->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["task_updatedeng"]["Value"] = $this->task_neweng->GetDBValue(true);
        $this->UpdateFields["task_currenteng"]["Value"] = $this->task_currenteng->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_task", $this->UpdateFields, $this);
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

} //End RSmartTaskDataSource Class @36-FCB6E20C

class clsRecordSummaryTicket { //SummaryTicket Class @130-3C2E248E

//Variables @130-D6FF3E86

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

//Class_Initialize Event @130-70ABBC81
    function clsRecordSummaryTicket($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SummaryTicket/Error";
        $this->DataSource = new clsSummaryTicketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SummaryTicket";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->tckt_refnumber = & new clsControl(ccsLabel, "tckt_refnumber", "Tckt Refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", $Method, NULL), $this);
            $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "Tckt Status", ccsInteger, "", CCGetRequestParam("tckt_status", $Method, NULL), $this);
            $this->tckt_status->HTML = true;
            $this->tckt_escalate = & new clsControl(ccsLabel, "tckt_escalate", "Tckt Escalate", ccsText, "", CCGetRequestParam("tckt_escalate", $Method, NULL), $this);
            $this->tckt_r_date = & new clsControl(ccsLabel, "tckt_r_date", "Tckt R Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_r_date", $Method, NULL), $this);
            $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "Tckt Severity", ccsInteger, "", CCGetRequestParam("tckt_severity", $Method, NULL), $this);
            $this->tckt_severity->HTML = true;
            $this->tckt_category = & new clsControl(ccsLabel, "tckt_category", "Tckt Category", ccsText, "", CCGetRequestParam("tckt_category", $Method, NULL), $this);
            $this->tckt_subcategory = & new clsControl(ccsLabel, "tckt_subcategory", "Tckt Subcategory", ccsText, "", CCGetRequestParam("tckt_subcategory", $Method, NULL), $this);
            $this->tckt_tagrelated = & new clsControl(ccsLabel, "tckt_tagrelated", "Tckt Tagrelated", ccsText, "", CCGetRequestParam("tckt_tagrelated", $Method, NULL), $this);
            $this->tckt_description = & new clsControl(ccsLabel, "tckt_description", "Tckt Description", ccsMemo, "", CCGetRequestParam("tckt_description", $Method, NULL), $this);
            $this->tckt_description->HTML = true;
            $this->tckt_r_customer = & new clsControl(ccsLabel, "tckt_r_customer", "Tckt R Customer", ccsText, "", CCGetRequestParam("tckt_r_customer", $Method, NULL), $this);
            $this->tckt_r_customercontact = & new clsControl(ccsLabel, "tckt_r_customercontact", "Tckt R Customercontact", ccsText, "", CCGetRequestParam("tckt_r_customercontact", $Method, NULL), $this);
            $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "Tckt Site", ccsText, "", CCGetRequestParam("tckt_site", $Method, NULL), $this);
            $this->tckt_toppanid = & new clsControl(ccsLabel, "tckt_toppanid", "Tckt Toppanid", ccsText, "", CCGetRequestParam("tckt_toppanid", $Method, NULL), $this);
            $this->tckt_r_customercontact1 = & new clsControl(ccsLabel, "tckt_r_customercontact1", "Tckt R Customercontact", ccsText, "", CCGetRequestParam("tckt_r_customercontact1", $Method, NULL), $this);
            $this->tckt_serialnumber = & new clsControl(ccsLabel, "tckt_serialnumber", "tckt_serialnumber", ccsText, "", CCGetRequestParam("tckt_serialnumber", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @130-2C19692C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltcktid"] = CCGetFromGet("tcktid", NULL);
    }
//End Initialize Method

//Validate Method @130-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @130-770A9872
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_escalate->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->tckt_subcategory->Errors->Count());
        $errors = ($errors || $this->tckt_tagrelated->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->tckt_r_customer->Errors->Count());
        $errors = ($errors || $this->tckt_r_customercontact->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_toppanid->Errors->Count());
        $errors = ($errors || $this->tckt_r_customercontact1->Errors->Count());
        $errors = ($errors || $this->tckt_serialnumber->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @130-ED598703
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

//Operation Method @130-0408063E
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
            $this->PressedButton = "Button_Cancel";
            if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = "taskactivity.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "det", "tid", "tcktid"));
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

//Show Method @130-810491A4
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
                $this->tckt_escalate->SetValue($this->DataSource->tckt_escalate->GetValue());
                $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
                $this->tckt_subcategory->SetValue($this->DataSource->tckt_subcategory->GetValue());
                $this->tckt_tagrelated->SetValue($this->DataSource->tckt_tagrelated->GetValue());
                $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                $this->tckt_r_customer->SetValue($this->DataSource->tckt_r_customer->GetValue());
                $this->tckt_r_customercontact->SetValue($this->DataSource->tckt_r_customercontact->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->tckt_toppanid->SetValue($this->DataSource->tckt_toppanid->GetValue());
                $this->tckt_r_customercontact1->SetValue($this->DataSource->tckt_r_customercontact1->GetValue());
                $this->tckt_serialnumber->SetValue($this->DataSource->tckt_serialnumber->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tckt_refnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_escalate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_severity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_category->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_subcategory->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_tagrelated->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_customer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_customercontact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_toppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_r_customercontact1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tckt_serialnumber->Errors->ToString());
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

        $this->Button_Cancel->Show();
        $this->tckt_refnumber->Show();
        $this->tckt_status->Show();
        $this->tckt_escalate->Show();
        $this->tckt_r_date->Show();
        $this->tckt_severity->Show();
        $this->tckt_category->Show();
        $this->tckt_subcategory->Show();
        $this->tckt_tagrelated->Show();
        $this->tckt_description->Show();
        $this->tckt_r_customer->Show();
        $this->tckt_r_customercontact->Show();
        $this->tckt_site->Show();
        $this->tckt_toppanid->Show();
        $this->tckt_r_customercontact1->Show();
        $this->tckt_serialnumber->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SummaryTicket Class @130-FCB6E20C

class clsSummaryTicketDataSource extends clsDBSMART {  //SummaryTicketDataSource Class @130-D201C97E

//DataSource Variables @130-2FAAFAE2
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
    var $tckt_escalate;
    var $tckt_r_date;
    var $tckt_severity;
    var $tckt_category;
    var $tckt_subcategory;
    var $tckt_tagrelated;
    var $tckt_description;
    var $tckt_r_customer;
    var $tckt_r_customercontact;
    var $tckt_site;
    var $tckt_toppanid;
    var $tckt_r_customercontact1;
    var $tckt_serialnumber;
//End DataSource Variables

//DataSourceClass_Initialize Event @130-7045F43D
    function clsSummaryTicketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record SummaryTicket/Error";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_escalate = new clsField("tckt_escalate", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->tckt_subcategory = new clsField("tckt_subcategory", ccsText, "");
        
        $this->tckt_tagrelated = new clsField("tckt_tagrelated", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_r_customer = new clsField("tckt_r_customer", ccsText, "");
        
        $this->tckt_r_customercontact = new clsField("tckt_r_customercontact", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_toppanid = new clsField("tckt_toppanid", ccsText, "");
        
        $this->tckt_r_customercontact1 = new clsField("tckt_r_customercontact1", ccsText, "");
        
        $this->tckt_serialnumber = new clsField("tckt_serialnumber", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @130-3C592692
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

//Open Method @130-3B622B64
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

//SetValues Method @130-17F4770A
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_escalate->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->tckt_subcategory->SetDBValue($this->f("tckt_subcategory"));
        $this->tckt_tagrelated->SetDBValue($this->f("tckt_tagrelated"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_r_customer->SetDBValue($this->f("tckt_r_customer"));
        $this->tckt_r_customercontact->SetDBValue($this->f("tckt_r_customercontact"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_toppanid->SetDBValue($this->f("tckt_toppanid"));
        $this->tckt_r_customercontact1->SetDBValue($this->f("tckt_r_customercontact2"));
        $this->tckt_serialnumber->SetDBValue($this->f("tckt_eqpmtserial"));
    }
//End SetValues Method

} //End SummaryTicketDataSource Class @130-FCB6E20C

class clsRecordRSmartTaskView { //RSmartTaskView Class @154-9FEC8C74

//Variables @154-D6FF3E86

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

//Class_Initialize Event @154-02F0E2DB
    function clsRecordRSmartTaskView($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSmartTaskView/Error";
        $this->DataSource = new clsRSmartTaskViewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSmartTaskView";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->task_current = & new clsControl(ccsTextBox, "task_current", "Task Current", ccsInteger, "", CCGetRequestParam("task_current", $Method, NULL), $this);
            $this->task_notes = & new clsControl(ccsTextArea, "task_notes", "Task Notes", ccsMemo, "", CCGetRequestParam("task_notes", $Method, NULL), $this);
            $this->task_date = & new clsControl(ccsLabel, "task_date", "Task Date", ccsDate, array("GeneralDate"), CCGetRequestParam("task_date", $Method, NULL), $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->taskStatus = & new clsControl(ccsLabel, "taskStatus", "taskStatus", ccsText, "", CCGetRequestParam("taskStatus", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, array("GeneralDate"), CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->ticketRef = & new clsControl(ccsTextBox, "ticketRef", "ticketRef", ccsText, "", CCGetRequestParam("ticketRef", $Method, NULL), $this);
            $this->task_neweng = & new clsControl(ccsTextBox, "task_neweng", "task_neweng", ccsText, "", CCGetRequestParam("task_neweng", $Method, NULL), $this);
            $this->task_currenteng = & new clsControl(ccsTextBox, "task_currenteng", "task_currenteng", ccsText, "", CCGetRequestParam("task_currenteng", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->datemodified->Value) && !strlen($this->datemodified->Value) && $this->datemodified->Value !== false)
                    $this->datemodified->SetValue(time());
            }
            if(!is_array($this->task_date->Value) && !strlen($this->task_date->Value) && $this->task_date->Value !== false)
                $this->task_date->SetValue(time());
        }
    }
//End Class_Initialize Event

//Initialize Method @154-6F53F6D6
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltid"] = CCGetFromGet("tid", NULL);
    }
//End Initialize Method

//Validate Method @154-7042F86B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->task_current->Validate() && $Validation);
        $Validation = ($this->task_notes->Validate() && $Validation);
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->ticketRef->Validate() && $Validation);
        $Validation = ($this->task_neweng->Validate() && $Validation);
        $Validation = ($this->task_currenteng->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->task_current->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_notes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticketRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_neweng->Errors->Count() == 0);
        $Validation =  $Validation && ($this->task_currenteng->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @154-307E1B45
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->task_current->Errors->Count());
        $errors = ($errors || $this->task_notes->Errors->Count());
        $errors = ($errors || $this->task_date->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->taskStatus->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->ticketRef->Errors->Count());
        $errors = ($errors || $this->task_neweng->Errors->Count());
        $errors = ($errors || $this->task_currenteng->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @154-ED598703
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

//Operation Method @154-65161BB9
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
            $this->PressedButton = "Button_Cancel";
            if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "tid"));
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

//Show Method @154-7109F1D5
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
                $this->task_date->SetValue($this->DataSource->task_date->GetValue());
                $this->taskStatus->SetValue($this->DataSource->taskStatus->GetValue());
                if(!$this->FormSubmitted){
                    $this->task_current->SetValue($this->DataSource->task_current->GetValue());
                    $this->task_notes->SetValue($this->DataSource->task_notes->GetValue());
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->task_neweng->SetValue($this->DataSource->task_neweng->GetValue());
                    $this->task_currenteng->SetValue($this->DataSource->task_currenteng->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->task_current->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_notes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->taskStatus->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_neweng->Errors->ToString());
            $Error = ComposeStrings($Error, $this->task_currenteng->Errors->ToString());
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

        $this->Button_Cancel->Show();
        $this->task_current->Show();
        $this->task_notes->Show();
        $this->task_date->Show();
        $this->ticket_id->Show();
        $this->taskStatus->Show();
        $this->datemodified->Show();
        $this->ticketRef->Show();
        $this->task_neweng->Show();
        $this->task_currenteng->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSmartTaskView Class @154-FCB6E20C

class clsRSmartTaskViewDataSource extends clsDBSMART {  //RSmartTaskViewDataSource Class @154-F79EF709

//DataSource Variables @154-9E3F43A4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $task_current;
    var $task_notes;
    var $task_date;
    var $ticket_id;
    var $taskStatus;
    var $datemodified;
    var $ticketRef;
    var $task_neweng;
    var $task_currenteng;
//End DataSource Variables

//DataSourceClass_Initialize Event @154-CD4089E3
    function clsRSmartTaskViewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSmartTaskView/Error";
        $this->Initialize();
        $this->task_current = new clsField("task_current", ccsInteger, "");
        
        $this->task_notes = new clsField("task_notes", ccsMemo, "");
        
        $this->task_date = new clsField("task_date", ccsDate, $this->DateFormat);
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->taskStatus = new clsField("taskStatus", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->ticketRef = new clsField("ticketRef", ccsText, "");
        
        $this->task_neweng = new clsField("task_neweng", ccsText, "");
        
        $this->task_currenteng = new clsField("task_currenteng", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @154-510A1766
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltid", ccsInteger, "", "", $this->Parameters["urltid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @154-9AC22D9E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_task {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @154-8E1DB5FC
    function SetValues()
    {
        $this->task_current->SetDBValue(trim($this->f("task_update")));
        $this->task_notes->SetDBValue($this->f("task_notes"));
        $this->task_date->SetDBValue(trim($this->f("task_date")));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->taskStatus->SetDBValue($this->f("task_status"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->task_neweng->SetDBValue($this->f("task_updatedeng"));
        $this->task_currenteng->SetDBValue($this->f("task_currenteng"));
    }
//End SetValues Method

} //End RSmartTaskViewDataSource Class @154-FCB6E20C





//Initialize Page @1-7DB2F07C
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
$TemplateFileName = "taskactivity.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-71F504ED
CCSecurityRedirect("1;2;3;5;4", "");
//End Authenticate User

//Include events file @1-7907D3F5
include_once("./taskactivity_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A6DFE808
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GSmartTicket = & new clsGridGSmartTicket("", $MainPage);
$GSmartTask = & new clsGridGSmartTask("", $MainPage);
$RSmartTask = & new clsRecordRSmartTask("", $MainPage);
$SummaryTicket = & new clsRecordSummaryTicket("", $MainPage);
$RSmartTaskView = & new clsRecordRSmartTaskView("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GSmartTicket = & $GSmartTicket;
$MainPage->GSmartTask = & $GSmartTask;
$MainPage->RSmartTask = & $RSmartTask;
$MainPage->SummaryTicket = & $SummaryTicket;
$MainPage->RSmartTaskView = & $RSmartTaskView;
$GSmartTicket->Initialize();
$GSmartTask->Initialize();
$RSmartTask->Initialize();
$SummaryTicket->Initialize();
$RSmartTaskView->Initialize();

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

//Execute Components @1-C2FDEEC6
$header->Operations();
$footer->Operations();
$RSmartTask->Operation();
$SummaryTicket->Operation();
$RSmartTaskView->Operation();
//End Execute Components

//Go to destination page @1-09EF900D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GSmartTicket);
    unset($GSmartTask);
    unset($RSmartTask);
    unset($SummaryTicket);
    unset($RSmartTaskView);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CAF73721
$header->Show();
$footer->Show();
$GSmartTicket->Show();
$GSmartTask->Show();
$RSmartTask->Show();
$SummaryTicket->Show();
$RSmartTaskView->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-91C4F68C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GSmartTicket);
unset($GSmartTask);
unset($RSmartTask);
unset($SummaryTicket);
unset($RSmartTaskView);
unset($Tpl);
//End Unload Page


?>
