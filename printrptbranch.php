<?php
//Include Common Files @1-AEA4B02D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "printrptbranch.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGReportBranchByYear { //GReportBranchByYear class @2-4A674637

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

//Class_Initialize Event @2-1A2A4BF2
    function clsGridGReportBranchByYear($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GReportBranchByYear";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GReportBranchByYear";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGReportBranchByYearDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->ref_description = & new clsControl(ccsLabel, "ref_description", "ref_description", ccsText, "", CCGetRequestParam("ref_description", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->TicMonth = & new clsControl(ccsLabel, "TicMonth", "TicMonth", ccsText, "", CCGetRequestParam("TicMonth", ccsGet, NULL), $this);
        $this->TicMonth->HTML = true;
        $this->JanTic = & new clsControl(ccsLabel, "JanTic", "JanTic", ccsText, "", CCGetRequestParam("JanTic", ccsGet, NULL), $this);
        $this->JanTic->HTML = true;
        $this->FebTic = & new clsControl(ccsLabel, "FebTic", "FebTic", ccsText, "", CCGetRequestParam("FebTic", ccsGet, NULL), $this);
        $this->FebTic->HTML = true;
        $this->MacTic = & new clsControl(ccsLabel, "MacTic", "MacTic", ccsText, "", CCGetRequestParam("MacTic", ccsGet, NULL), $this);
        $this->MacTic->HTML = true;
        $this->AprTic = & new clsControl(ccsLabel, "AprTic", "AprTic", ccsText, "", CCGetRequestParam("AprTic", ccsGet, NULL), $this);
        $this->AprTic->HTML = true;
        $this->MeiTic = & new clsControl(ccsLabel, "MeiTic", "MeiTic", ccsText, "", CCGetRequestParam("MeiTic", ccsGet, NULL), $this);
        $this->MeiTic->HTML = true;
        $this->JuneTic = & new clsControl(ccsLabel, "JuneTic", "JuneTic", ccsText, "", CCGetRequestParam("JuneTic", ccsGet, NULL), $this);
        $this->JuneTic->HTML = true;
        $this->JulyTic = & new clsControl(ccsLabel, "JulyTic", "JulyTic", ccsText, "", CCGetRequestParam("JulyTic", ccsGet, NULL), $this);
        $this->JulyTic->HTML = true;
        $this->AugTic = & new clsControl(ccsLabel, "AugTic", "AugTic", ccsText, "", CCGetRequestParam("AugTic", ccsGet, NULL), $this);
        $this->AugTic->HTML = true;
        $this->SeptTic = & new clsControl(ccsLabel, "SeptTic", "SeptTic", ccsText, "", CCGetRequestParam("SeptTic", ccsGet, NULL), $this);
        $this->SeptTic->HTML = true;
        $this->OctTic = & new clsControl(ccsLabel, "OctTic", "OctTic", ccsText, "", CCGetRequestParam("OctTic", ccsGet, NULL), $this);
        $this->OctTic->HTML = true;
        $this->NovTic = & new clsControl(ccsLabel, "NovTic", "NovTic", ccsText, "", CCGetRequestParam("NovTic", ccsGet, NULL), $this);
        $this->NovTic->HTML = true;
        $this->DecTic = & new clsControl(ccsLabel, "DecTic", "DecTic", ccsText, "", CCGetRequestParam("DecTic", ccsGet, NULL), $this);
        $this->DecTic->HTML = true;
        $this->ref_value = & new clsControl(ccsHidden, "ref_value", "ref_value", ccsText, "", CCGetRequestParam("ref_value", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
        $this->GrandTotal = & new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsInteger, "", CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
        $this->GrandTotal->HTML = true;
        $this->TotalJan = & new clsControl(ccsLabel, "TotalJan", "TotalJan", ccsInteger, "", CCGetRequestParam("TotalJan", ccsGet, NULL), $this);
        $this->TotalFeb = & new clsControl(ccsLabel, "TotalFeb", "TotalFeb", ccsInteger, "", CCGetRequestParam("TotalFeb", ccsGet, NULL), $this);
        $this->TotalMac = & new clsControl(ccsLabel, "TotalMac", "TotalMac", ccsInteger, "", CCGetRequestParam("TotalMac", ccsGet, NULL), $this);
        $this->TotalApr = & new clsControl(ccsLabel, "TotalApr", "TotalApr", ccsInteger, "", CCGetRequestParam("TotalApr", ccsGet, NULL), $this);
        $this->TotalMei = & new clsControl(ccsLabel, "TotalMei", "TotalMei", ccsInteger, "", CCGetRequestParam("TotalMei", ccsGet, NULL), $this);
        $this->TotalJune = & new clsControl(ccsLabel, "TotalJune", "TotalJune", ccsInteger, "", CCGetRequestParam("TotalJune", ccsGet, NULL), $this);
        $this->TotalJuly = & new clsControl(ccsLabel, "TotalJuly", "TotalJuly", ccsInteger, "", CCGetRequestParam("TotalJuly", ccsGet, NULL), $this);
        $this->TotalAug = & new clsControl(ccsLabel, "TotalAug", "TotalAug", ccsInteger, "", CCGetRequestParam("TotalAug", ccsGet, NULL), $this);
        $this->TotalSept = & new clsControl(ccsLabel, "TotalSept", "TotalSept", ccsInteger, "", CCGetRequestParam("TotalSept", ccsGet, NULL), $this);
        $this->TotalOct = & new clsControl(ccsLabel, "TotalOct", "TotalOct", ccsInteger, "", CCGetRequestParam("TotalOct", ccsGet, NULL), $this);
        $this->TotalNov = & new clsControl(ccsLabel, "TotalNov", "TotalNov", ccsInteger, "", CCGetRequestParam("TotalNov", ccsGet, NULL), $this);
        $this->TotalDec = & new clsControl(ccsLabel, "TotalDec", "TotalDec", ccsInteger, "", CCGetRequestParam("TotalDec", ccsGet, NULL), $this);
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

//Show Method @2-DBEA9807
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
            $this->ControlsVisible["ref_description"] = $this->ref_description->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["TicMonth"] = $this->TicMonth->Visible;
            $this->ControlsVisible["JanTic"] = $this->JanTic->Visible;
            $this->ControlsVisible["FebTic"] = $this->FebTic->Visible;
            $this->ControlsVisible["MacTic"] = $this->MacTic->Visible;
            $this->ControlsVisible["AprTic"] = $this->AprTic->Visible;
            $this->ControlsVisible["MeiTic"] = $this->MeiTic->Visible;
            $this->ControlsVisible["JuneTic"] = $this->JuneTic->Visible;
            $this->ControlsVisible["JulyTic"] = $this->JulyTic->Visible;
            $this->ControlsVisible["AugTic"] = $this->AugTic->Visible;
            $this->ControlsVisible["SeptTic"] = $this->SeptTic->Visible;
            $this->ControlsVisible["OctTic"] = $this->OctTic->Visible;
            $this->ControlsVisible["NovTic"] = $this->NovTic->Visible;
            $this->ControlsVisible["DecTic"] = $this->DecTic->Visible;
            $this->ControlsVisible["ref_value"] = $this->ref_value->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ref_description->SetValue($this->DataSource->ref_description->GetValue());
                $this->JanTic->SetValue($this->DataSource->JanTic->GetValue());
                $this->FebTic->SetValue($this->DataSource->FebTic->GetValue());
                $this->MacTic->SetValue($this->DataSource->MacTic->GetValue());
                $this->AprTic->SetValue($this->DataSource->AprTic->GetValue());
                $this->MeiTic->SetValue($this->DataSource->MeiTic->GetValue());
                $this->JuneTic->SetValue($this->DataSource->JuneTic->GetValue());
                $this->JulyTic->SetValue($this->DataSource->JulyTic->GetValue());
                $this->AugTic->SetValue($this->DataSource->AugTic->GetValue());
                $this->SeptTic->SetValue($this->DataSource->SeptTic->GetValue());
                $this->OctTic->SetValue($this->DataSource->OctTic->GetValue());
                $this->NovTic->SetValue($this->DataSource->NovTic->GetValue());
                $this->DecTic->SetValue($this->DataSource->DecTic->GetValue());
                $this->ref_value->SetValue($this->DataSource->ref_value->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ref_description->Show();
                $this->lblNumber->Show();
                $this->TicMonth->Show();
                $this->JanTic->Show();
                $this->FebTic->Show();
                $this->MacTic->Show();
                $this->AprTic->Show();
                $this->MeiTic->Show();
                $this->JuneTic->Show();
                $this->JulyTic->Show();
                $this->AugTic->Show();
                $this->SeptTic->Show();
                $this->OctTic->Show();
                $this->NovTic->Show();
                $this->DecTic->Show();
                $this->ref_value->Show();
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
        $this->GrandTotal->Show();
        $this->TotalJan->Show();
        $this->TotalFeb->Show();
        $this->TotalMac->Show();
        $this->TotalApr->Show();
        $this->TotalMei->Show();
        $this->TotalJune->Show();
        $this->TotalJuly->Show();
        $this->TotalAug->Show();
        $this->TotalSept->Show();
        $this->TotalOct->Show();
        $this->TotalNov->Show();
        $this->TotalDec->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4004DB7B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ref_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TicMonth->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JanTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FebTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MacTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AprTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MeiTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JuneTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JulyTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AugTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SeptTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->OctTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NovTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DecTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ref_value->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GReportBranchByYear Class @2-FCB6E20C

class clsGReportBranchByYearDataSource extends clsDBSMART {  //GReportBranchByYearDataSource Class @2-F55C3EB5

//DataSource Variables @2-18AA3DCA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ref_description;
    var $JanTic;
    var $FebTic;
    var $MacTic;
    var $AprTic;
    var $MeiTic;
    var $JuneTic;
    var $JulyTic;
    var $AugTic;
    var $SeptTic;
    var $OctTic;
    var $NovTic;
    var $DecTic;
    var $ref_value;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7624165A
    function clsGReportBranchByYearDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GReportBranchByYear";
        $this->Initialize();
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->JanTic = new clsField("JanTic", ccsText, "");
        
        $this->FebTic = new clsField("FebTic", ccsText, "");
        
        $this->MacTic = new clsField("MacTic", ccsText, "");
        
        $this->AprTic = new clsField("AprTic", ccsText, "");
        
        $this->MeiTic = new clsField("MeiTic", ccsText, "");
        
        $this->JuneTic = new clsField("JuneTic", ccsText, "");
        
        $this->JulyTic = new clsField("JulyTic", ccsText, "");
        
        $this->AugTic = new clsField("AugTic", ccsText, "");
        
        $this->SeptTic = new clsField("SeptTic", ccsText, "");
        
        $this->OctTic = new clsField("OctTic", ccsText, "");
        
        $this->NovTic = new clsField("NovTic", ccsText, "");
        
        $this->DecTic = new clsField("DecTic", ccsText, "");
        
        $this->ref_value = new clsField("ref_value", ccsText, "");
        

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

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-0BF08612
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ref_description, ref_value, eqtop_branch \n\n" .
        "FROM smart_eqtoppan INNER JOIN smart_referencecode ON\n\n" .
        "smart_eqtoppan.eqtop_branch = smart_referencecode.ref_value {SQL_Where}\n\n" .
        "GROUP BY eqtop_branch {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-35C5A96C
    function SetValues()
    {
        $this->ref_description->SetDBValue($this->f("eqtop_branch"));
        $this->JanTic->SetDBValue($this->f("TicketJan"));
        $this->FebTic->SetDBValue($this->f("TicketFeb"));
        $this->MacTic->SetDBValue($this->f("TicketMac"));
        $this->AprTic->SetDBValue($this->f("TicketApr"));
        $this->MeiTic->SetDBValue($this->f("TicketMei"));
        $this->JuneTic->SetDBValue($this->f("TicketJune"));
        $this->JulyTic->SetDBValue($this->f("TicketJuly"));
        $this->AugTic->SetDBValue($this->f("TicketAug"));
        $this->SeptTic->SetDBValue($this->f("TicketSept"));
        $this->OctTic->SetDBValue($this->f("TicketOct"));
        $this->NovTic->SetDBValue($this->f("TicketNov"));
        $this->DecTic->SetDBValue($this->f("TicketDec"));
        $this->ref_value->SetDBValue($this->f("ref_value"));
    }
//End SetValues Method

} //End GReportBranchByYearDataSource Class @2-FCB6E20C

//Initialize Page @1-86DC6E6A
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
$TemplateFileName = "printrptbranch.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-42CF3C75
include_once("./printrptbranch_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C69F8BFE
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$GReportBranchByYear = & new clsGridGReportBranchByYear("", $MainPage);
$MainPage->GReportBranchByYear = & $GReportBranchByYear;
$GReportBranchByYear->Initialize();

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

//Go to destination page @1-55066209
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($GReportBranchByYear);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-055EBCE1
$GReportBranchByYear->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1673E7AB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($GReportBranchByYear);
unset($Tpl);
//End Unload Page


?>
