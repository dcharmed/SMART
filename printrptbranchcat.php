<?php
//Include Common Files @1-E9610892
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "printrptbranchcat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGReportBranchCat { //GReportBranchCat class @2-21946046

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

//Class_Initialize Event @2-A2AA23EB
    function clsGridGReportBranchCat($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GReportBranchCat";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GReportBranchCat";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGReportBranchCatDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 200;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 200)
            $this->PageSize = 200;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->totticket = & new clsControl(ccsLabel, "totticket", "totticket", ccsInteger, "", CCGetRequestParam("totticket", ccsGet, NULL), $this);
        $this->val = & new clsControl(ccsLabel, "val", "val", ccsText, "", CCGetRequestParam("val", ccsGet, NULL), $this);
        $this->val->HTML = true;
        $this->numbook = & new clsControl(ccsLabel, "numbook", "numbook", ccsInteger, "", CCGetRequestParam("numbook", ccsGet, NULL), $this);
        $this->numbook->HTML = true;
        $this->numhardware = & new clsControl(ccsLabel, "numhardware", "numhardware", ccsInteger, "", CCGetRequestParam("numhardware", ccsGet, NULL), $this);
        $this->numhardware->HTML = true;
        $this->numsoftware = & new clsControl(ccsLabel, "numsoftware", "numsoftware", ccsInteger, "", CCGetRequestParam("numsoftware", ccsGet, NULL), $this);
        $this->numsoftware->HTML = true;
        $this->numnetwork = & new clsControl(ccsLabel, "numnetwork", "numnetwork", ccsInteger, "", CCGetRequestParam("numnetwork", ccsGet, NULL), $this);
        $this->numnetwork->HTML = true;
        $this->numapplication = & new clsControl(ccsLabel, "numapplication", "numapplication", ccsInteger, "", CCGetRequestParam("numapplication", ccsGet, NULL), $this);
        $this->numapplication->HTML = true;
        $this->numdongle = & new clsControl(ccsLabel, "numdongle", "numdongle", ccsInteger, "", CCGetRequestParam("numdongle", ccsGet, NULL), $this);
        $this->numdongle->HTML = true;
        $this->numofficeeq = & new clsControl(ccsLabel, "numofficeeq", "numofficeeq", ccsInteger, "", CCGetRequestParam("numofficeeq", ccsGet, NULL), $this);
        $this->numofficeeq->HTML = true;
        $this->numcctv = & new clsControl(ccsLabel, "numcctv", "numcctv", ccsInteger, "", CCGetRequestParam("numcctv", ccsGet, NULL), $this);
        $this->numcctv->HTML = true;
        $this->numaccdoor = & new clsControl(ccsLabel, "numaccdoor", "numaccdoor", ccsInteger, "", CCGetRequestParam("numaccdoor", ccsGet, NULL), $this);
        $this->numaccdoor->HTML = true;
        $this->numchip = & new clsControl(ccsLabel, "numchip", "numchip", ccsInteger, "", CCGetRequestParam("numchip", ccsGet, NULL), $this);
        $this->numchip->HTML = true;
        $this->numiriseq = & new clsControl(ccsLabel, "numiriseq", "numiriseq", ccsInteger, "", CCGetRequestParam("numiriseq", ccsGet, NULL), $this);
        $this->numiriseq->HTML = true;
        $this->numuser = & new clsControl(ccsLabel, "numuser", "numuser", ccsInteger, "", CCGetRequestParam("numuser", ccsGet, NULL), $this);
        $this->numuser->HTML = true;
        $this->numadukom = & new clsControl(ccsLabel, "numadukom", "numadukom", ccsInteger, "", CCGetRequestParam("numadukom", ccsGet, NULL), $this);
        $this->numadukom->HTML = true;
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
        $this->GrandTotal = & new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsInteger, "", CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
        $this->GrandTotal->HTML = true;
        $this->GBookTotal = & new clsControl(ccsLabel, "GBookTotal", "GBookTotal", ccsInteger, "", CCGetRequestParam("GBookTotal", ccsGet, NULL), $this);
        $this->GHardwareTotal = & new clsControl(ccsLabel, "GHardwareTotal", "GHardwareTotal", ccsInteger, "", CCGetRequestParam("GHardwareTotal", ccsGet, NULL), $this);
        $this->GSoftwareTotal = & new clsControl(ccsLabel, "GSoftwareTotal", "GSoftwareTotal", ccsInteger, "", CCGetRequestParam("GSoftwareTotal", ccsGet, NULL), $this);
        $this->GNetworkTotal = & new clsControl(ccsLabel, "GNetworkTotal", "GNetworkTotal", ccsInteger, "", CCGetRequestParam("GNetworkTotal", ccsGet, NULL), $this);
        $this->GApplicationTotal = & new clsControl(ccsLabel, "GApplicationTotal", "GApplicationTotal", ccsInteger, "", CCGetRequestParam("GApplicationTotal", ccsGet, NULL), $this);
        $this->GDongleTotal = & new clsControl(ccsLabel, "GDongleTotal", "GDongleTotal", ccsInteger, "", CCGetRequestParam("GDongleTotal", ccsGet, NULL), $this);
        $this->GOffEqTotal = & new clsControl(ccsLabel, "GOffEqTotal", "GOffEqTotal", ccsInteger, "", CCGetRequestParam("GOffEqTotal", ccsGet, NULL), $this);
        $this->GCctvTotal = & new clsControl(ccsLabel, "GCctvTotal", "GCctvTotal", ccsInteger, "", CCGetRequestParam("GCctvTotal", ccsGet, NULL), $this);
        $this->GAccDoorTotal = & new clsControl(ccsLabel, "GAccDoorTotal", "GAccDoorTotal", ccsInteger, "", CCGetRequestParam("GAccDoorTotal", ccsGet, NULL), $this);
        $this->GChipTotal = & new clsControl(ccsLabel, "GChipTotal", "GChipTotal", ccsInteger, "", CCGetRequestParam("GChipTotal", ccsGet, NULL), $this);
        $this->GIrisEqTotal = & new clsControl(ccsLabel, "GIrisEqTotal", "GIrisEqTotal", ccsInteger, "", CCGetRequestParam("GIrisEqTotal", ccsGet, NULL), $this);
        $this->GUserTotal = & new clsControl(ccsLabel, "GUserTotal", "GUserTotal", ccsInteger, "", CCGetRequestParam("GUserTotal", ccsGet, NULL), $this);
        $this->GAdukomTotal = & new clsControl(ccsLabel, "GAdukomTotal", "GAdukomTotal", ccsInteger, "", CCGetRequestParam("GAdukomTotal", ccsGet, NULL), $this);
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

//Show Method @2-9D7B3C91
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
            $this->ControlsVisible["totticket"] = $this->totticket->Visible;
            $this->ControlsVisible["val"] = $this->val->Visible;
            $this->ControlsVisible["numbook"] = $this->numbook->Visible;
            $this->ControlsVisible["numhardware"] = $this->numhardware->Visible;
            $this->ControlsVisible["numsoftware"] = $this->numsoftware->Visible;
            $this->ControlsVisible["numnetwork"] = $this->numnetwork->Visible;
            $this->ControlsVisible["numapplication"] = $this->numapplication->Visible;
            $this->ControlsVisible["numdongle"] = $this->numdongle->Visible;
            $this->ControlsVisible["numofficeeq"] = $this->numofficeeq->Visible;
            $this->ControlsVisible["numcctv"] = $this->numcctv->Visible;
            $this->ControlsVisible["numaccdoor"] = $this->numaccdoor->Visible;
            $this->ControlsVisible["numchip"] = $this->numchip->Visible;
            $this->ControlsVisible["numiriseq"] = $this->numiriseq->Visible;
            $this->ControlsVisible["numuser"] = $this->numuser->Visible;
            $this->ControlsVisible["numadukom"] = $this->numadukom->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->val->SetValue($this->DataSource->val->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->totticket->Show();
                $this->val->Show();
                $this->numbook->Show();
                $this->numhardware->Show();
                $this->numsoftware->Show();
                $this->numnetwork->Show();
                $this->numapplication->Show();
                $this->numdongle->Show();
                $this->numofficeeq->Show();
                $this->numcctv->Show();
                $this->numaccdoor->Show();
                $this->numchip->Show();
                $this->numiriseq->Show();
                $this->numuser->Show();
                $this->numadukom->Show();
                $this->lblNumber->Show();
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
        $this->GBookTotal->Show();
        $this->GHardwareTotal->Show();
        $this->GSoftwareTotal->Show();
        $this->GNetworkTotal->Show();
        $this->GApplicationTotal->Show();
        $this->GDongleTotal->Show();
        $this->GOffEqTotal->Show();
        $this->GCctvTotal->Show();
        $this->GAccDoorTotal->Show();
        $this->GChipTotal->Show();
        $this->GIrisEqTotal->Show();
        $this->GUserTotal->Show();
        $this->GAdukomTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-94D95446
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->totticket->Errors->ToString());
        $errors = ComposeStrings($errors, $this->val->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numbook->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numhardware->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numsoftware->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numnetwork->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numapplication->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numdongle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numofficeeq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numcctv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numaccdoor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numchip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numiriseq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numadukom->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GReportBranchCat Class @2-FCB6E20C

class clsGReportBranchCatDataSource extends clsDBSMART {  //GReportBranchCatDataSource Class @2-A6085E99

//DataSource Variables @2-74C44F28
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $val;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6D4D05AF
    function clsGReportBranchCatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GReportBranchCat";
        $this->Initialize();
        $this->val = new clsField("val", ccsText, "");
        

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

//Open Method @2-475D96F2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT eqtop_branch, ref_value, ref_description \n\n" .
        "FROM smart_referencecode INNER JOIN smart_eqtoppan ON\n\n" .
        "smart_referencecode.ref_value = smart_eqtoppan.eqtop_branch {SQL_Where}\n\n" .
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

//SetValues Method @2-DFC61FED
    function SetValues()
    {
        $this->val->SetDBValue($this->f("ref_value"));
    }
//End SetValues Method

} //End GReportBranchCatDataSource Class @2-FCB6E20C

//Initialize Page @1-90986E65
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
$TemplateFileName = "printrptbranchcat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-0677502D
include_once("./printrptbranchcat_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-60ED3BA0
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$GReportBranchCat = & new clsGridGReportBranchCat("", $MainPage);
$MainPage->GReportBranchCat = & $GReportBranchCat;
$GReportBranchCat->Initialize();

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

//Go to destination page @1-58F31EA7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($GReportBranchCat);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B1E5408C
$GReportBranchCat->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-051E9EF9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($GReportBranchCat);
unset($Tpl);
//End Unload Page


?>
