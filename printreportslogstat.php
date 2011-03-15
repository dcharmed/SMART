<?php
//Include Common Files @1-E9E0F590
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "printreportslogstat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGStatLogStatus { //GStatLogStatus class @2-DACD4613

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

//Class_Initialize Event @2-D1D98C40
    function clsGridGStatLogStatus($RelativePath, & $Parent)
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
        $this->DataSource = new clsGStatLogStatusDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10000;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 10000)
            $this->PageSize = 10000;
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
        $this->lblYear->HTML = true;
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

//Show Method @2-CD794643
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
        $this->lblYear->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-2D828CDE
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

} //End GStatLogStatus Class @2-FCB6E20C

class clsGStatLogStatusDataSource extends clsDBSMART {  //GStatLogStatusDataSource Class @2-26797741

//DataSource Variables @2-4877F4CF
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

//DataSourceClass_Initialize Event @2-FAB72FA7
    function clsGStatLogStatusDataSource(& $Parent)
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

//SetOrder Method @2-0E4FB5E7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_refnumber desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-D41C115B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_ticket";
        $this->SQL = "SELECT tckt_refnumber, tckt_r_date, tckt_r_helpdesk, tckt_site, tckt_c_helpdesk, id \n\n" .
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

//SetValues Method @2-6A59B00B
    function SetValues()
    {
        $this->refno->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_r_helpdesk->SetDBValue($this->f("tckt_r_helpdesk"));
        $this->tckt_c_helpdesk->SetDBValue($this->f("tckt_c_helpdesk"));
        $this->ticketid->SetDBValue($this->f("id"));
    }
//End SetValues Method

} //End GStatLogStatusDataSource Class @2-FCB6E20C

//Initialize Page @1-588E70E1
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
$TemplateFileName = "printreportslogstat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-597FC68E
include_once("./printreportslogstat_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-667CBFAC
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$GStatLogStatus = & new clsGridGStatLogStatus("", $MainPage);
$MainPage->GStatLogStatus = & $GStatLogStatus;
$GStatLogStatus->Initialize();

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

//Go to destination page @1-C634D017
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($GStatLogStatus);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1007096E
$GStatLogStatus->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5320E756
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($GStatLogStatus);
unset($Tpl);
//End Unload Page


?>
