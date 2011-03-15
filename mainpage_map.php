<?php
//Include Common Files @1-882F8F7E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "mainpage.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

//Include Page implementation @3-16AC7A9A
include_once(RelativePath . "/rightbar.php");
//End Include Page implementation



class clsGridsmart_ticket { //smart_ticket class @10-3145E1AF

//Variables @10-61902B41

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
    var $Sorter_tckt_adukom;
    var $Sorter_tckt_r_date;
    var $Sorter_tckt_r_helpdesk;
    var $Sorter_tckt_site;
//End Variables

//Class_Initialize Event @10-3D83E6B9
    function clsGridsmart_ticket($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_ticket";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_ticket";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_ticketDataSource($this);
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
        $this->SorterName = CCGetParam("smart_ticketOrder", "");
        $this->SorterDirection = CCGetParam("smart_ticketDir", "");

        $this->tckt_refnumber = & new clsControl(ccsLink, "tckt_refnumber", "tckt_refnumber", ccsText, "", CCGetRequestParam("tckt_refnumber", ccsGet, NULL), $this);
        $this->tckt_refnumber->HTML = true;
        $this->tckt_refnumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->tckt_refnumber->Page = "";
        $this->tckt_status = & new clsControl(ccsLabel, "tckt_status", "tckt_status", ccsText, "", CCGetRequestParam("tckt_status", ccsGet, NULL), $this);
        $this->tckt_r_date = & new clsControl(ccsLabel, "tckt_r_date", "tckt_r_date", ccsDate, array("GeneralDate"), CCGetRequestParam("tckt_r_date", ccsGet, NULL), $this);
        $this->tckt_r_helpdesk = & new clsControl(ccsLabel, "tckt_r_helpdesk", "tckt_r_helpdesk", ccsInteger, "", CCGetRequestParam("tckt_r_helpdesk", ccsGet, NULL), $this);
        $this->tckt_description = & new clsControl(ccsLabel, "tckt_description", "tckt_description", ccsText, "", CCGetRequestParam("tckt_description", ccsGet, NULL), $this);
        $this->tckt_description->HTML = true;
        $this->tckt_site = & new clsControl(ccsLabel, "tckt_site", "tckt_site", ccsText, "", CCGetRequestParam("tckt_site", ccsGet, NULL), $this);
        $this->tckt_age = & new clsControl(ccsLabel, "tckt_age", "tckt_age", ccsInteger, "", CCGetRequestParam("tckt_age", ccsGet, NULL), $this);
        $this->tckt_age->HTML = true;
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->tckt_severity = & new clsControl(ccsLabel, "tckt_severity", "tckt_severity", ccsText, "", CCGetRequestParam("tckt_severity", ccsGet, NULL), $this);
        $this->Sorter_tckt_refnumber = & new clsSorter($this->ComponentName, "Sorter_tckt_refnumber", $FileName, $this);
        $this->Sorter_tckt_adukom = & new clsSorter($this->ComponentName, "Sorter_tckt_adukom", $FileName, $this);
        $this->Sorter_tckt_r_date = & new clsSorter($this->ComponentName, "Sorter_tckt_r_date", $FileName, $this);
        $this->Sorter_tckt_r_helpdesk = & new clsSorter($this->ComponentName, "Sorter_tckt_r_helpdesk", $FileName, $this);
        $this->Sorter_tckt_site = & new clsSorter($this->ComponentName, "Sorter_tckt_site", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @10-97818DC0
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr12"] = 1;

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
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["tckt_status"] = $this->tckt_status->Visible;
            $this->ControlsVisible["tckt_r_date"] = $this->tckt_r_date->Visible;
            $this->ControlsVisible["tckt_r_helpdesk"] = $this->tckt_r_helpdesk->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["tckt_age"] = $this->tckt_age->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
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
                $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
                $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
                $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
                $this->tckt_r_helpdesk->SetValue($this->DataSource->tckt_r_helpdesk->GetValue());
                $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
                $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->tckt_refnumber->Show();
                $this->tckt_status->Show();
                $this->tckt_r_date->Show();
                $this->tckt_r_helpdesk->Show();
                $this->tckt_description->Show();
                $this->tckt_site->Show();
                $this->tckt_age->Show();
                $this->lblNumber->Show();
                $this->id->Show();
                $this->tckt_severity->Show();
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
        $this->Sorter_tckt_adukom->Show();
        $this->Sorter_tckt_r_date->Show();
        $this->Sorter_tckt_r_helpdesk->Show();
        $this->Sorter_tckt_site->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @10-C1EA91F2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_helpdesk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_ticket Class @10-FCB6E20C

class clssmart_ticketDataSource extends clsDBSMART {  //smart_ticketDataSource Class @10-6569B5AD

//DataSource Variables @10-75BB94B0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $tckt_refnumber;
    var $tckt_status;
    var $tckt_r_date;
    var $tckt_r_helpdesk;
    var $tckt_description;
    var $tckt_site;
    var $id;
    var $tckt_severity;
//End DataSource Variables

//DataSourceClass_Initialize Event @10-57CCBFC9
    function clssmart_ticketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_ticket";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_r_helpdesk = new clsField("tckt_r_helpdesk", ccsInteger, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsText, "");
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @10-1903FBB6
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_refnumber desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tckt_refnumber" => array("tckt_refnumber", ""), 
            "Sorter_tckt_adukom" => array("tckt_adukomn", ""), 
            "Sorter_tckt_r_date" => array("tckt_r_date", ""), 
            "Sorter_tckt_r_helpdesk" => array("tckt_r_helpdesk", ""), 
            "Sorter_tckt_site" => array("tckt_site", "")));
    }
//End SetOrder Method

//Prepare Method @10-83018C94
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr12", ccsInteger, "", "", $this->Parameters["expr12"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opLessThanOrEqual, "tckt_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @10-C5FDE95E
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

//SetValues Method @10-BAB85E0B
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_status->SetDBValue($this->f("tckt_status"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_r_helpdesk->SetDBValue(trim($this->f("tckt_r_helpdesk")));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->id->SetDBValue(trim($this->f("id")));
        $this->tckt_severity->SetDBValue($this->f("tckt_severity"));
    }
//End SetValues Method

} //End smart_ticketDataSource Class @10-FCB6E20C

//Include Page implementation @36-431FA8D9
include_once(RelativePath . "/smartmap.php");
//End Include Page implementation

//Include Page implementation @37-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Initialize Page @1-34989132
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
$TemplateFileName = "mainpage.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-71D0BC34
include_once("./mainpage_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-645CCCD0
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$rightbar = & new clsrightbar("", "rightbar", $MainPage);
$rightbar->Initialize();
$smart_ticket = & new clsGridsmart_ticket("", $MainPage);
$smartmap = & new clssmartmap("", "smartmap", $MainPage);
$smartmap->Initialize();
$smartheader = & new clssmartheader("", "smartheader", $MainPage);
$smartheader->Initialize();
$MainPage->footer = & $footer;
$MainPage->rightbar = & $rightbar;
$MainPage->smart_ticket = & $smart_ticket;
$MainPage->smartmap = & $smartmap;
$MainPage->smartheader = & $smartheader;
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

//Execute Components @1-A46662E3
$footer->Operations();
$rightbar->Operations();
$smartmap->Operations();
$smartheader->Operations();
//End Execute Components

//Go to destination page @1-D1D97849
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $footer->Class_Terminate();
    unset($footer);
    $rightbar->Class_Terminate();
    unset($rightbar);
    unset($smart_ticket);
    $smartmap->Class_Terminate();
    unset($smartmap);
    $smartheader->Class_Terminate();
    unset($smartheader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D0402B1C
$footer->Show();
$rightbar->Show();
$smart_ticket->Show();
$smartmap->Show();
$smartheader->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-220118C2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$footer->Class_Terminate();
unset($footer);
$rightbar->Class_Terminate();
unset($rightbar);
unset($smart_ticket);
$smartmap->Class_Terminate();
unset($smartmap);
$smartheader->Class_Terminate();
unset($smartheader);
unset($Tpl);
//End Unload Page


?>
