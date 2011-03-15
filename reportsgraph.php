<?php
//Include Common Files @1-5A80968A
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsreportsgraph { //reportsgraph class @1-38C03BD4

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

//Class_Initialize Event @1-CB10F649
    function clsreportsgraph($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportsgraph.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportsgraph.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-32FD4740
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
    }
//End Class_Terminate Event

//BindEvents Method @1-D2737049
    function BindEvents()
    {
        $this->CCSEvents["AfterInitialize"] = "reportsgraph_AfterInitialize";
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

//Initialize Method @1-BDD1DE84
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEvents["BeforeInitialize"] = "reportsgraph_BeforeInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBSMART = new clsDBSMART();
        $this->Connections["SMART"] = & $this->DBSMART;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->pangraphbranch = & new clsPanel("pangraphbranch", $this);
        $this->ChartBranch = & new clsFlashChart("ChartBranch", $this);
        $this->ChartBranch->CallbackParameter = "reportsgraphpangraphbranchChartBranch";
        $this->ChartBranch->Title = "Graph of Tickets According To Branch By Year {year}";
        $this->ChartBranch->Width = 950;
        $this->ChartBranch->Height = 550;
        $this->pangraphprob = & new clsPanel("pangraphprob", $this);
        $this->ChartProb = & new clsFlashChart("ChartProb", $this);
        $this->ChartProb->CallbackParameter = "reportsgraphpangraphprobChartProb";
        $this->ChartProb->Title = "Graph of Tickets According To Problem Categories By Year";
        $this->ChartProb->Width = 900;
        $this->ChartProb->Height = 600;
        $this->pangraphmethod = & new clsPanel("pangraphmethod", $this);
        $this->ChartMethod = & new clsFlashChart("ChartMethod", $this);
        $this->ChartMethod->CallbackParameter = "reportsgraphpangraphmethodChartMethod";
        $this->ChartMethod->Title = "Graph of Tickets According to Resolution Method By Year";
        $this->ChartMethod->Width = 900;
        $this->ChartMethod->Height = 600;
        $this->pangraphbranch->AddComponent("ChartBranch", $this->ChartBranch);
        $this->pangraphprob->AddComponent("ChartProb", $this->ChartProb);
        $this->pangraphmethod->AddComponent("ChartMethod", $this->ChartMethod);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-8772002A
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
        $this->pangraphbranch->Show();
        $this->pangraphprob->Show();
        $this->pangraphmethod->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportsgraph Class @1-FCB6E20C

//Include Event File @1-0571FE65
include_once(RelativePath . "/reportsgraph_events.php");
//End Include Event File


?>
