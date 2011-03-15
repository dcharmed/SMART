<?php

class clsGridrightbarTcktSummary { //TcktSummary class @2-671EC9BA

//Variables @2-AC1EDBB9

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

//Class_Initialize Event @2-3318FA3B
    function clsGridrightbarTcktSummary($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "TcktSummary";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid TcktSummary";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsrightbarTcktSummaryDataSource($this);
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

        $this->ref_description = & new clsControl(ccsLink, "ref_description", "ref_description", ccsText, "", CCGetRequestParam("ref_description", ccsGet, NULL), $this);
        $this->ref_description->Page = $this->RelativePath . "ticketlist.php";
        $this->tcktcritical = & new clsControl(ccsLink, "tcktcritical", "tcktcritical", ccsInteger, "", CCGetRequestParam("tcktcritical", ccsGet, NULL), $this);
        $this->tcktcritical->HTML = true;
        $this->tcktcritical->Page = $this->RelativePath . "ticketlist.php";
        $this->status = & new clsControl(ccsHidden, "status", "status", ccsText, "", CCGetRequestParam("status", ccsGet, NULL), $this);
        $this->tcktmajor = & new clsControl(ccsLink, "tcktmajor", "tcktmajor", ccsInteger, "", CCGetRequestParam("tcktmajor", ccsGet, NULL), $this);
        $this->tcktmajor->HTML = true;
        $this->tcktmajor->Page = $this->RelativePath . "ticketlist.php";
        $this->tcktminor = & new clsControl(ccsLink, "tcktminor", "tcktminor", ccsInteger, "", CCGetRequestParam("tcktminor", ccsGet, NULL), $this);
        $this->tcktminor->HTML = true;
        $this->tcktminor->Page = $this->RelativePath . "ticketlist.php";
        $this->tcktinfo = & new clsControl(ccsLink, "tcktinfo", "tcktinfo", ccsInteger, "", CCGetRequestParam("tcktinfo", ccsGet, NULL), $this);
        $this->tcktinfo->HTML = true;
        $this->tcktinfo->Page = $this->RelativePath . "ticketlist.php";
        $this->tckttotal = & new clsControl(ccsLink, "tckttotal", "tckttotal", ccsInteger, "", CCGetRequestParam("tckttotal", ccsGet, NULL), $this);
        $this->tckttotal->HTML = true;
        $this->tckttotal->Page = $this->RelativePath . "ticketlist.php";
        $this->totcritical = & new clsControl(ccsLabel, "totcritical", "totcritical", ccsInteger, "", CCGetRequestParam("totcritical", ccsGet, NULL), $this);
        $this->totmajor = & new clsControl(ccsLabel, "totmajor", "totmajor", ccsInteger, "", CCGetRequestParam("totmajor", ccsGet, NULL), $this);
        $this->totminor = & new clsControl(ccsLabel, "totminor", "totminor", ccsInteger, "", CCGetRequestParam("totminor", ccsGet, NULL), $this);
        $this->totinfo = & new clsControl(ccsLabel, "totinfo", "totinfo", ccsInteger, "", CCGetRequestParam("totinfo", ccsGet, NULL), $this);
        $this->Gtotal = & new clsControl(ccsLabel, "Gtotal", "Gtotal", ccsInteger, "", CCGetRequestParam("Gtotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-C2DA3364
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr7"] = tcktstatus;
        $this->DataSource->Parameters["expr8"] = 3;

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
            $this->ControlsVisible["ref_description"] = $this->ref_description->Visible;
            $this->ControlsVisible["tcktcritical"] = $this->tcktcritical->Visible;
            $this->ControlsVisible["status"] = $this->status->Visible;
            $this->ControlsVisible["tcktmajor"] = $this->tcktmajor->Visible;
            $this->ControlsVisible["tcktminor"] = $this->tcktminor->Visible;
            $this->ControlsVisible["tcktinfo"] = $this->tcktinfo->Visible;
            $this->ControlsVisible["tckttotal"] = $this->tckttotal->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ref_description->SetValue($this->DataSource->ref_description->GetValue());
                $this->ref_description->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ref_description->Parameters = CCAddParam($this->ref_description->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->tcktcritical->SetValue($this->DataSource->tcktcritical->GetValue());
                $this->tcktcritical->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tcktcritical->Parameters = CCAddParam($this->tcktcritical->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->tcktcritical->Parameters = CCAddParam($this->tcktcritical->Parameters, "s_svr", 1);
                $this->status->SetValue($this->DataSource->status->GetValue());
                $this->tcktmajor->SetValue($this->DataSource->tcktmajor->GetValue());
                $this->tcktmajor->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tcktmajor->Parameters = CCAddParam($this->tcktmajor->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->tcktmajor->Parameters = CCAddParam($this->tcktmajor->Parameters, "s_svr", 2);
                $this->tcktminor->SetValue($this->DataSource->tcktminor->GetValue());
                $this->tcktminor->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tcktminor->Parameters = CCAddParam($this->tcktminor->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->tcktminor->Parameters = CCAddParam($this->tcktminor->Parameters, "s_svr", 3);
                $this->tcktinfo->SetValue($this->DataSource->tcktinfo->GetValue());
                $this->tcktinfo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tcktinfo->Parameters = CCAddParam($this->tcktinfo->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->tcktinfo->Parameters = CCAddParam($this->tcktinfo->Parameters, "s_svr", 4);
                $this->tckttotal->SetValue($this->DataSource->tckttotal->GetValue());
                $this->tckttotal->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tckttotal->Parameters = CCAddParam($this->tckttotal->Parameters, "s_status", $this->DataSource->f("ref_value"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ref_description->Show();
                $this->tcktcritical->Show();
                $this->status->Show();
                $this->tcktmajor->Show();
                $this->tcktminor->Show();
                $this->tcktinfo->Show();
                $this->tckttotal->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->totcritical->Show();
        $this->totmajor->Show();
        $this->totminor->Show();
        $this->totinfo->Show();
        $this->Gtotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B857235D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ref_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktcritical->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktmajor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktminor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tcktinfo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckttotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End TcktSummary Class @2-FCB6E20C

class clsrightbarTcktSummaryDataSource extends clsDBSMART {  //TcktSummaryDataSource Class @2-67669E83

//DataSource Variables @2-8B915F47
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ref_description;
    var $tcktcritical;
    var $status;
    var $tcktmajor;
    var $tcktminor;
    var $tcktinfo;
    var $tckttotal;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-568403E4
    function clsrightbarTcktSummaryDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid TcktSummary";
        $this->Initialize();
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->tcktcritical = new clsField("tcktcritical", ccsInteger, "");
        
        $this->status = new clsField("status", ccsText, "");
        
        $this->tcktmajor = new clsField("tcktmajor", ccsInteger, "");
        
        $this->tcktminor = new clsField("tcktminor", ccsInteger, "");
        
        $this->tcktinfo = new clsField("tcktinfo", ccsInteger, "");
        
        $this->tckttotal = new clsField("tckttotal", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-45BA9677
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr7", ccsText, "", "", $this->Parameters["expr7"], "", false);
        $this->wp->AddParameter("2", "expr8", ccsText, "", "", $this->Parameters["expr8"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ref_type", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opNotEqual, "ref_value", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-AF3D62D9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_referencecode";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-ED9EEECB
    function SetValues()
    {
        $this->ref_description->SetDBValue($this->f("ref_description"));
        $this->tcktcritical->SetDBValue(trim($this->f("ref_value")));
        $this->status->SetDBValue($this->f("ref_value"));
        $this->tcktmajor->SetDBValue(trim($this->f("ref_value")));
        $this->tcktminor->SetDBValue(trim($this->f("ref_value")));
        $this->tcktinfo->SetDBValue(trim($this->f("ref_value")));
        $this->tckttotal->SetDBValue(trim($this->f("ref_value")));
    }
//End SetValues Method

} //End TcktSummaryDataSource Class @2-FCB6E20C

class clsGridrightbarGTask { //GTask class @9-5C0025E4

//Variables @9-AC1EDBB9

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

//Class_Initialize Event @9-DE30D217
    function clsGridrightbarGTask($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GTask";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GTask";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsrightbarGTaskDataSource($this);
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

        $this->ticket_id = & new clsControl(ccsLink, "ticket_id", "ticket_id", ccsInteger, "", CCGetRequestParam("ticket_id", ccsGet, NULL), $this);
        $this->ticket_id->Page = $this->RelativePath . "taskactivity.php";
        $this->task_date = & new clsControl(ccsLabel, "task_date", "task_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("task_date", ccsGet, NULL), $this);
        $this->task_site = & new clsControl(ccsLabel, "task_site", "task_site", ccsText, "", CCGetRequestParam("task_site", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @9-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @9-FEFC6E2C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr11"] = 1;
        $this->DataSource->Parameters["sesUserID"] = CCGetSession("UserID", NULL);

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
            $this->ControlsVisible["task_date"] = $this->task_date->Visible;
            $this->ControlsVisible["task_site"] = $this->task_site->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                $this->ticket_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ticket_id->Parameters = CCAddParam($this->ticket_id->Parameters, "tcktid", $this->DataSource->f("ticket_id"));
                $this->ticket_id->Parameters = CCAddParam($this->ticket_id->Parameters, "det", 1);
                $this->task_date->SetValue($this->DataSource->task_date->GetValue());
                $this->task_site->SetValue($this->DataSource->task_site->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ticket_id->Show();
                $this->task_date->Show();
                $this->task_site->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @9-8106F3C8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ticket_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->task_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GTask Class @9-FCB6E20C

class clsrightbarGTaskDataSource extends clsDBSMART {  //GTaskDataSource Class @9-9F6F04C6

//DataSource Variables @9-2CD23E66
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ticket_id;
    var $task_date;
    var $task_site;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-AE5AF17B
    function clsrightbarGTaskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GTask";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->task_date = new clsField("task_date", ccsDate, $this->DateFormat);
        
        $this->task_site = new clsField("task_site", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @9-7EC656FF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr11", ccsText, "", "", $this->Parameters["expr11"], "", false);
        $this->wp->AddParameter("2", "sesUserID", ccsInteger, "", "", $this->Parameters["sesUserID"], "", false);
        $this->wp->AddParameter("3", "sesUserID", ccsInteger, "", "", $this->Parameters["sesUserID"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opLessThan, "smart_task.task_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "smart_task.task_currenteng", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "smart_task.task_updatedeng", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),true);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opOR(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]));
    }
//End Prepare Method

//Open Method @9-3D9260BE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_task INNER JOIN smart_ticket ON\n\n" .
        "smart_task.ticket_id = smart_ticket.id";
        $this->SQL = "SELECT smart_task.*, tckt_site \n\n" .
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

//SetValues Method @9-182503C3
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->task_date->SetDBValue(trim($this->f("task_date")));
        $this->task_site->SetDBValue($this->f("tckt_site"));
    }
//End SetValues Method

} //End GTaskDataSource Class @9-FCB6E20C

class clsrightbar { //rightbar class @1-B08BFBF4

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

//Class_Initialize Event @1-ABB874EE
    function clsrightbar($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "rightbar.php";
        $this->Redirect = "";
        $this->TemplateFileName = "rightbar.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-CEA68ABC
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->TcktSummary);
        unset($this->GTask);
    }
//End Class_Terminate Event

//BindEvents Method @1-AD775928
    function BindEvents()
    {
        $this->TcktSummary->CCSEvents["BeforeShowRow"] = "rightbar_TcktSummary_BeforeShowRow";
        $this->GTask->CCSEvents["BeforeShowRow"] = "rightbar_GTask_BeforeShowRow";
        $this->GTask->CCSEvents["BeforeShow"] = "rightbar_GTask_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-D07ACFC3
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
        $this->TcktSummary = & new clsGridrightbarTcktSummary($this->RelativePath, $this);
        $this->GTask = & new clsGridrightbarGTask($this->RelativePath, $this);
        $this->TcktSummary->Initialize();
        $this->GTask->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-0788EADE
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
        $this->TcktSummary->Show();
        $this->GTask->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End rightbar Class @1-FCB6E20C

//Include Event File @1-3DB21CE8
include_once(RelativePath . "/rightbar_events.php");
//End Include Event File


?>
