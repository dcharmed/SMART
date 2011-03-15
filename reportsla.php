<?php

class clsGridreportslaSlaSummary { //SlaSummary class @10-34979557

//Variables @10-AC1EDBB9

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

//Class_Initialize Event @10-9686E21A
    function clsGridreportslaSlaSummary($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SlaSummary";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SlaSummary";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsreportslaSlaSummaryDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 300;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 300)
            $this->PageSize = 300;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->site = & new clsControl(ccsLabel, "site", "site", ccsText, "", CCGetRequestParam("site", ccsGet, NULL), $this);
        $this->site->HTML = true;
        $this->totalticket = & new clsControl(ccsLabel, "totalticket", "totalticket", ccsInteger, "", CCGetRequestParam("totalticket", ccsGet, NULL), $this);
        $this->lesssla = & new clsControl(ccsLabel, "lesssla", "lesssla", ccsInteger, "", CCGetRequestParam("lesssla", ccsGet, NULL), $this);
        $this->oversla = & new clsControl(ccsLabel, "oversla", "oversla", ccsInteger, "", CCGetRequestParam("oversla", ccsGet, NULL), $this);
        $this->lessrsvl = & new clsControl(ccsLabel, "lessrsvl", "lessrsvl", ccsText, "", CCGetRequestParam("lessrsvl", ccsGet, NULL), $this);
        $this->overrsvl = & new clsControl(ccsLabel, "overrsvl", "overrsvl", ccsText, "", CCGetRequestParam("overrsvl", ccsGet, NULL), $this);
        $this->lesscls = & new clsControl(ccsLabel, "lesscls", "lesscls", ccsText, "", CCGetRequestParam("lesscls", ccsGet, NULL), $this);
        $this->overcls = & new clsControl(ccsLabel, "overcls", "overcls", ccsText, "", CCGetRequestParam("overcls", ccsGet, NULL), $this);
        $this->totlesssla = & new clsControl(ccsLabel, "totlesssla", "totlesssla", ccsInteger, "", CCGetRequestParam("totlesssla", ccsGet, NULL), $this);
        $this->totoversla = & new clsControl(ccsLabel, "totoversla", "totoversla", ccsInteger, "", CCGetRequestParam("totoversla", ccsGet, NULL), $this);
        $this->lblMonthYear = & new clsControl(ccsLabel, "lblMonthYear", "lblMonthYear", ccsText, "", CCGetRequestParam("lblMonthYear", ccsGet, NULL), $this);
        $this->totlessrsvl = & new clsControl(ccsLabel, "totlessrsvl", "totlessrsvl", ccsText, "", CCGetRequestParam("totlessrsvl", ccsGet, NULL), $this);
        $this->totoverrsvl = & new clsControl(ccsLabel, "totoverrsvl", "totoverrsvl", ccsText, "", CCGetRequestParam("totoverrsvl", ccsGet, NULL), $this);
        $this->totlesscls = & new clsControl(ccsLabel, "totlesscls", "totlesscls", ccsText, "", CCGetRequestParam("totlesscls", ccsGet, NULL), $this);
        $this->totovercls = & new clsControl(ccsLabel, "totovercls", "totovercls", ccsText, "", CCGetRequestParam("totovercls", ccsGet, NULL), $this);
        $this->GTicketTotal = & new clsControl(ccsLabel, "GTicketTotal", "GTicketTotal", ccsInteger, "", CCGetRequestParam("GTicketTotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @10-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @10-7139796D
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
            $this->ControlsVisible["site"] = $this->site->Visible;
            $this->ControlsVisible["totalticket"] = $this->totalticket->Visible;
            $this->ControlsVisible["lesssla"] = $this->lesssla->Visible;
            $this->ControlsVisible["oversla"] = $this->oversla->Visible;
            $this->ControlsVisible["lessrsvl"] = $this->lessrsvl->Visible;
            $this->ControlsVisible["overrsvl"] = $this->overrsvl->Visible;
            $this->ControlsVisible["lesscls"] = $this->lesscls->Visible;
            $this->ControlsVisible["overcls"] = $this->overcls->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->site->SetValue($this->DataSource->site->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->site->Show();
                $this->totalticket->Show();
                $this->lesssla->Show();
                $this->oversla->Show();
                $this->lessrsvl->Show();
                $this->overrsvl->Show();
                $this->lesscls->Show();
                $this->overcls->Show();
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
        $this->totlesssla->Show();
        $this->totoversla->Show();
        $this->lblMonthYear->Show();
        $this->totlessrsvl->Show();
        $this->totoverrsvl->Show();
        $this->totlesscls->Show();
        $this->totovercls->Show();
        $this->GTicketTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @10-1B156B4E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totalticket->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lesssla->Errors->ToString());
        $errors = ComposeStrings($errors, $this->oversla->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lessrsvl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->overrsvl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lesscls->Errors->ToString());
        $errors = ComposeStrings($errors, $this->overcls->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SlaSummary Class @10-FCB6E20C

class clsreportslaSlaSummaryDataSource extends clsDBSMART {  //SlaSummaryDataSource Class @10-1E630C4A

//DataSource Variables @10-6D914F91
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $site;
//End DataSource Variables

//DataSourceClass_Initialize Event @10-23C50B9F
    function clsreportslaSlaSummaryDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SlaSummary";
        $this->Initialize();
        $this->site = new clsField("site", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @10-CA7B9798
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "site_rank";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @10-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @10-D3308613
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_site {SQL_Where}\n\n" .
        "GROUP BY site_sla {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @10-B68FEAA0
    function SetValues()
    {
        $this->site->SetDBValue($this->f("site_sla"));
    }
//End SetValues Method

} //End SlaSummaryDataSource Class @10-FCB6E20C

class clsreportsla { //reportsla class @1-9F2465E5

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

//Class_Initialize Event @1-95CA8874
    function clsreportsla($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportsla.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportsla.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-54E2D881
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->SlaSummary);
    }
//End Class_Terminate Event

//BindEvents Method @1-D182D1A6
    function BindEvents()
    {
        $this->SlaSummary->CCSEvents["BeforeShowRow"] = "reportsla_SlaSummary_BeforeShowRow";
        $this->CCSEvents["AfterInitialize"] = "reportsla_AfterInitialize";
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

//Initialize Method @1-0A588D4F
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
        $this->SlaSummary = & new clsGridreportslaSlaSummary($this->RelativePath, $this);
        $this->SlaSummary->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-125AB7C6
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
        $this->SlaSummary->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportsla Class @1-FCB6E20C

//Include Event File @1-19402AB5
include_once(RelativePath . "/reportsla_events.php");
//End Include Event File


?>
