<?php
//Include Common Files @1-0F284930
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "printrptcat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGStatProbCat { //GStatProbCat class @2-2BE31358

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

//Class_Initialize Event @2-ED82E04E
    function clsGridGStatProbCat($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GStatProbCat";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GStatProbCat";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGStatProbCatDataSource($this);
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
        $this->TotalTic = & new clsControl(ccsLabel, "TotalTic", "TotalTic", ccsInteger, "", CCGetRequestParam("TotalTic", ccsGet, NULL), $this);
        $this->TotalTic->HTML = true;
        $this->catval = & new clsControl(ccsHidden, "catval", "catval", ccsText, "", CCGetRequestParam("catval", ccsGet, NULL), $this);
        $this->ref_description = & new clsControl(ccsLabel, "ref_description", "ref_description", ccsText, "", CCGetRequestParam("ref_description", ccsGet, NULL), $this);
        $this->JanTic = & new clsControl(ccsLabel, "JanTic", "JanTic", ccsInteger, "", CCGetRequestParam("JanTic", ccsGet, NULL), $this);
        $this->JanTic->HTML = true;
        $this->FebTic = & new clsControl(ccsLabel, "FebTic", "FebTic", ccsInteger, "", CCGetRequestParam("FebTic", ccsGet, NULL), $this);
        $this->FebTic->HTML = true;
        $this->MacTic = & new clsControl(ccsLabel, "MacTic", "MacTic", ccsInteger, "", CCGetRequestParam("MacTic", ccsGet, NULL), $this);
        $this->MacTic->HTML = true;
        $this->AprTic = & new clsControl(ccsLabel, "AprTic", "AprTic", ccsInteger, "", CCGetRequestParam("AprTic", ccsGet, NULL), $this);
        $this->AprTic->HTML = true;
        $this->MeiTic = & new clsControl(ccsLabel, "MeiTic", "MeiTic", ccsInteger, "", CCGetRequestParam("MeiTic", ccsGet, NULL), $this);
        $this->MeiTic->HTML = true;
        $this->JuneTic = & new clsControl(ccsLabel, "JuneTic", "JuneTic", ccsInteger, "", CCGetRequestParam("JuneTic", ccsGet, NULL), $this);
        $this->JuneTic->HTML = true;
        $this->JulTic = & new clsControl(ccsLabel, "JulTic", "JulTic", ccsInteger, "", CCGetRequestParam("JulTic", ccsGet, NULL), $this);
        $this->JulTic->HTML = true;
        $this->Augtic = & new clsControl(ccsLabel, "Augtic", "Augtic", ccsInteger, "", CCGetRequestParam("Augtic", ccsGet, NULL), $this);
        $this->Augtic->HTML = true;
        $this->SeptTic = & new clsControl(ccsLabel, "SeptTic", "SeptTic", ccsInteger, "", CCGetRequestParam("SeptTic", ccsGet, NULL), $this);
        $this->SeptTic->HTML = true;
        $this->OctTic = & new clsControl(ccsLabel, "OctTic", "OctTic", ccsInteger, "", CCGetRequestParam("OctTic", ccsGet, NULL), $this);
        $this->OctTic->HTML = true;
        $this->NovTic = & new clsControl(ccsLabel, "NovTic", "NovTic", ccsInteger, "", CCGetRequestParam("NovTic", ccsGet, NULL), $this);
        $this->NovTic->HTML = true;
        $this->DecTic = & new clsControl(ccsLabel, "DecTic", "DecTic", ccsInteger, "", CCGetRequestParam("DecTic", ccsGet, NULL), $this);
        $this->DecTic->HTML = true;
        $this->SubCat = & new clsControl(ccsLabel, "SubCat", "SubCat", ccsText, "", CCGetRequestParam("SubCat", ccsGet, NULL), $this);
        $this->subcatval = & new clsControl(ccsHidden, "subcatval", "subcatval", ccsText, "", CCGetRequestParam("subcatval", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
        $this->GTotal = & new clsControl(ccsLabel, "GTotal", "GTotal", ccsInteger, "", CCGetRequestParam("GTotal", ccsGet, NULL), $this);
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

//Show Method @2-46CAF25E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr25"] = probcat;

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
            $this->ControlsVisible["TotalTic"] = $this->TotalTic->Visible;
            $this->ControlsVisible["catval"] = $this->catval->Visible;
            $this->ControlsVisible["ref_description"] = $this->ref_description->Visible;
            $this->ControlsVisible["JanTic"] = $this->JanTic->Visible;
            $this->ControlsVisible["FebTic"] = $this->FebTic->Visible;
            $this->ControlsVisible["MacTic"] = $this->MacTic->Visible;
            $this->ControlsVisible["AprTic"] = $this->AprTic->Visible;
            $this->ControlsVisible["MeiTic"] = $this->MeiTic->Visible;
            $this->ControlsVisible["JuneTic"] = $this->JuneTic->Visible;
            $this->ControlsVisible["JulTic"] = $this->JulTic->Visible;
            $this->ControlsVisible["Augtic"] = $this->Augtic->Visible;
            $this->ControlsVisible["SeptTic"] = $this->SeptTic->Visible;
            $this->ControlsVisible["OctTic"] = $this->OctTic->Visible;
            $this->ControlsVisible["NovTic"] = $this->NovTic->Visible;
            $this->ControlsVisible["DecTic"] = $this->DecTic->Visible;
            $this->ControlsVisible["SubCat"] = $this->SubCat->Visible;
            $this->ControlsVisible["subcatval"] = $this->subcatval->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->catval->SetValue($this->DataSource->catval->GetValue());
                $this->ref_description->SetValue($this->DataSource->ref_description->GetValue());
                $this->SubCat->SetValue($this->DataSource->SubCat->GetValue());
                $this->subcatval->SetValue($this->DataSource->subcatval->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->TotalTic->Show();
                $this->catval->Show();
                $this->ref_description->Show();
                $this->JanTic->Show();
                $this->FebTic->Show();
                $this->MacTic->Show();
                $this->AprTic->Show();
                $this->MeiTic->Show();
                $this->JuneTic->Show();
                $this->JulTic->Show();
                $this->Augtic->Show();
                $this->SeptTic->Show();
                $this->OctTic->Show();
                $this->NovTic->Show();
                $this->DecTic->Show();
                $this->SubCat->Show();
                $this->subcatval->Show();
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
        $this->GTotal->Show();
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

//GetErrors Method @2-6DCD1A0B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->catval->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ref_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JanTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FebTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MacTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AprTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MeiTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JuneTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JulTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Augtic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SeptTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->OctTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NovTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DecTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SubCat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->subcatval->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GStatProbCat Class @2-FCB6E20C

class clsGStatProbCatDataSource extends clsDBSMART {  //GStatProbCatDataSource Class @2-CDE4666D

//DataSource Variables @2-6B031041
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $catval;
    var $ref_description;
    var $SubCat;
    var $subcatval;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4ED52411
    function clsGStatProbCatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GStatProbCat";
        $this->Initialize();
        $this->catval = new clsField("catval", ccsText, "");
        
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->SubCat = new clsField("SubCat", ccsText, "");
        
        $this->subcatval = new clsField("subcatval", ccsText, "");
        

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

//Prepare Method @2-1F3AFFA0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr25", ccsText, "", "", $this->Parameters["expr25"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_referencecode.ref_type", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-F790E7E4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_referencecode INNER JOIN smart_referencecode smart_referencecode1 ON\n\n" .
        "smart_referencecode.ref_value = smart_referencecode1.ref_type";
        $this->SQL = "SELECT smart_referencecode.ref_value AS catvalue, smart_referencecode.ref_description AS cat, smart_referencecode1.ref_description AS subcat,\n\n" .
        "smart_referencecode1.ref_value AS subcatvalue \n\n" .
        "FROM smart_referencecode INNER JOIN smart_referencecode smart_referencecode1 ON\n\n" .
        "smart_referencecode.ref_value = smart_referencecode1.ref_type {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A5C60F5F
    function SetValues()
    {
        $this->catval->SetDBValue($this->f("catvalue"));
        $this->ref_description->SetDBValue($this->f("cat"));
        $this->SubCat->SetDBValue($this->f("subcat"));
        $this->subcatval->SetDBValue($this->f("subcatvalue"));
    }
//End SetValues Method

} //End GStatProbCatDataSource Class @2-FCB6E20C

//Initialize Page @1-6809F7C0
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
$TemplateFileName = "printrptcat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-09E02282
include_once("./printrptcat_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AAC58855
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$GStatProbCat = & new clsGridGStatProbCat("", $MainPage);
$MainPage->GStatProbCat = & $GStatProbCat;
$GStatProbCat->Initialize();

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

//Go to destination page @1-D0A00A75
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($GStatProbCat);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-28FB6736
$GStatProbCat->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-04039AEB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($GStatProbCat);
unset($Tpl);
//End Unload Page


?>
