<?php

class clsGridreportslogstatGStatLogStatus { //GStatLogStatus class @9-8AFC1FB9

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

//Class_Initialize Event @9-367CFD04
    function clsGridreportslogstatGStatLogStatus($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GStatLogStatus";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GStatLogStatus";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsreportslogstatGStatLogStatusDataSource($this);
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

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->refno = & new clsControl(ccsLabel, "refno", "refno", ccsText, "", CCGetRequestParam("refno", ccsGet, NULL), $this);
        $this->dateopen = & new clsControl(ccsLabel, "dateopen", "dateopen", ccsText, "", CCGetRequestParam("dateopen", ccsGet, NULL), $this);
        $this->dateopen->HTML = true;
        $this->dateassign = & new clsControl(ccsLabel, "dateassign", "dateassign", ccsText, "", CCGetRequestParam("dateassign", ccsGet, NULL), $this);
        $this->dateassign->HTML = true;
        $this->datereassign = & new clsControl(ccsLabel, "datereassign", "datereassign", ccsText, "", CCGetRequestParam("datereassign", ccsGet, NULL), $this);
        $this->datereassign->HTML = true;
        $this->datewip = & new clsControl(ccsLabel, "datewip", "datewip", ccsText, "", CCGetRequestParam("datewip", ccsGet, NULL), $this);
        $this->datewip->HTML = true;
        $this->dateresolved = & new clsControl(ccsLabel, "dateresolved", "dateresolved", ccsText, "", CCGetRequestParam("dateresolved", ccsGet, NULL), $this);
        $this->dateresolved->HTML = true;
        $this->dateclosed = & new clsControl(ccsLabel, "dateclosed", "dateclosed", ccsText, "", CCGetRequestParam("dateclosed", ccsGet, NULL), $this);
        $this->dateclosed->HTML = true;
        $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "tckt_site", ccsText, "", CCGetRequestParam("tckt_site", ccsGet, NULL), $this);
        $this->tckt_r_helpdesk = & new clsControl(ccsLabel, "tckt_r_helpdesk", "tckt_r_helpdesk", ccsText, "", CCGetRequestParam("tckt_r_helpdesk", ccsGet, NULL), $this);
        $this->tckt_r_helpdesk->HTML = true;
        $this->tckt_eng1 = & new clsControl(ccsLabel, "tckt_eng1", "tckt_eng1", ccsText, "", CCGetRequestParam("tckt_eng1", ccsGet, NULL), $this);
        $this->tckt_eng1->HTML = true;
        $this->tckt_eng2 = & new clsControl(ccsLabel, "tckt_eng2", "tckt_eng2", ccsText, "", CCGetRequestParam("tckt_eng2", ccsGet, NULL), $this);
        $this->tckt_eng2->HTML = true;
        $this->tckt_c_helpdesk = & new clsControl(ccsLabel, "tckt_c_helpdesk", "tckt_c_helpdesk", ccsText, "", CCGetRequestParam("tckt_c_helpdesk", ccsGet, NULL), $this);
        $this->tckt_c_helpdesk->HTML = true;
        $this->ticketid = & new clsControl(ccsHidden, "ticketid", "ticketid", ccsText, "", CCGetRequestParam("ticketid", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
        $this->Navigator1 = & new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblMonth = & new clsControl(ccsLabel, "lblMonth", "lblMonth", ccsText, "", CCGetRequestParam("lblMonth", ccsGet, NULL), $this);
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

//Show Method @9-54591C18
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
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["refno"] = $this->refno->Visible;
            $this->ControlsVisible["dateopen"] = $this->dateopen->Visible;
            $this->ControlsVisible["dateassign"] = $this->dateassign->Visible;
            $this->ControlsVisible["datereassign"] = $this->datereassign->Visible;
            $this->ControlsVisible["datewip"] = $this->datewip->Visible;
            $this->ControlsVisible["dateresolved"] = $this->dateresolved->Visible;
            $this->ControlsVisible["dateclosed"] = $this->dateclosed->Visible;
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["tckt_r_helpdesk"] = $this->tckt_r_helpdesk->Visible;
            $this->ControlsVisible["tckt_eng1"] = $this->tckt_eng1->Visible;
            $this->ControlsVisible["tckt_eng2"] = $this->tckt_eng2->Visible;
            $this->ControlsVisible["tckt_c_helpdesk"] = $this->tckt_c_helpdesk->Visible;
            $this->ControlsVisible["ticketid"] = $this->ticketid->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->refno->SetValue($this->DataSource->refno->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->tckt_r_helpdesk->SetValue($this->DataSource->tckt_r_helpdesk->GetValue());
                $this->tckt_c_helpdesk->SetValue($this->DataSource->tckt_c_helpdesk->GetValue());
                $this->ticketid->SetValue($this->DataSource->ticketid->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->refno->Show();
                $this->dateopen->Show();
                $this->dateassign->Show();
                $this->datereassign->Show();
                $this->datewip->Show();
                $this->dateresolved->Show();
                $this->dateclosed->Show();
                $this->tckt_site->Show();
                $this->tckt_r_helpdesk->Show();
                $this->tckt_eng1->Show();
                $this->tckt_eng2->Show();
                $this->tckt_c_helpdesk->Show();
                $this->ticketid->Show();
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
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator1->TotalPages <= 1) {
            $this->Navigator1->Visible = false;
        }
        $this->lblYear->Show();
        $this->Navigator1->Show();
        $this->lblMonth->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @9-2D828CDE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->refno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dateopen->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dateassign->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datereassign->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datewip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dateresolved->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dateclosed->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_helpdesk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_eng1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_eng2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_helpdesk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ticketid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GStatLogStatus Class @9-FCB6E20C

class clsreportslogstatGStatLogStatusDataSource extends clsDBSMART {  //GStatLogStatusDataSource Class @9-F2C69EBC

//DataSource Variables @9-4877F4CF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $refno;
    var $tckt_site;
    var $tckt_r_helpdesk;
    var $tckt_c_helpdesk;
    var $ticketid;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-F847EDC0
    function clsreportslogstatGStatLogStatusDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GStatLogStatus";
        $this->Initialize();
        $this->refno = new clsField("refno", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_r_helpdesk = new clsField("tckt_r_helpdesk", ccsText, "");
        
        $this->tckt_c_helpdesk = new clsField("tckt_c_helpdesk", ccsText, "");
        
        $this->ticketid = new clsField("ticketid", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-0E4FB5E7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_refnumber desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @9-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @9-5EF81E4E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_ticket";
        $this->SQL = "SELECT tckt_refnumber, tckt_r_date, tckt_site, tckt_r_helpdesk, tckt_c_helpdesk, id \n\n" .
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

//SetValues Method @9-6A59B00B
    function SetValues()
    {
        $this->refno->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_r_helpdesk->SetDBValue($this->f("tckt_r_helpdesk"));
        $this->tckt_c_helpdesk->SetDBValue($this->f("tckt_c_helpdesk"));
        $this->ticketid->SetDBValue($this->f("id"));
    }
//End SetValues Method

} //End GStatLogStatusDataSource Class @9-FCB6E20C

class clsreportslogstat { //reportslogstat class @1-58E66152

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

//Class_Initialize Event @1-12A7FF03
    function clsreportslogstat($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportslogstat.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportslogstat.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-31F60F98
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->GStatLogStatus);
    }
//End Class_Terminate Event

//BindEvents Method @1-174672F6
    function BindEvents()
    {
        $this->GStatLogStatus->dateopen->CCSEvents["BeforeShow"] = "reportslogstat_GStatLogStatus_dateopen_BeforeShow";
        $this->GStatLogStatus->CCSEvents["BeforeShowRow"] = "reportslogstat_GStatLogStatus_BeforeShowRow";
        $this->GStatLogStatus->CCSEvents["BeforeShow"] = "reportslogstat_GStatLogStatus_BeforeShow";
        $this->GStatLogStatus->ds->CCSEvents["BeforeBuildSelect"] = "reportslogstat_GStatLogStatus_ds_BeforeBuildSelect";
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

//Initialize Method @1-D613CD60
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
        $this->GStatLogStatus = & new clsGridreportslogstatGStatLogStatus($this->RelativePath, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = $this->RelativePath . "printreportslogstat.php";
        $this->GStatLogStatus->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "year", CCGetFromGet("year", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "set", CCGetFromGet("set", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "print", 1);
    }
//End Initialize Method

//Show Method @1-E3007346
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
        $this->GStatLogStatus->Show();
        $this->ImageLink1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportslogstat Class @1-FCB6E20C

//Include Event File @1-0AE7CEA9
include_once(RelativePath . "/reportslogstat_events.php");
//End Include Event File


?>
