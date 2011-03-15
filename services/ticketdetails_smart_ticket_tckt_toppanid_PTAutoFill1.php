<?php
//Include Common Files @1-A0A15F53
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "ticketdetails_smart_ticket_tckt_toppanid_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsmart_eqtoppan { //smart_eqtoppan class @2-983C8A16

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

//Class_Initialize Event @2-0736FE40
    function clsGridsmart_eqtoppan($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_eqtoppan";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_eqtoppan";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_eqtoppanDataSource($this);
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

        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->eqtop_eqcode = & new clsControl(ccsLabel, "eqtop_eqcode", "eqtop_eqcode", ccsText, "", CCGetRequestParam("eqtop_eqcode", ccsGet, NULL), $this);
        $this->eqtop_branch = & new clsControl(ccsLabel, "eqtop_branch", "eqtop_branch", ccsText, "", CCGetRequestParam("eqtop_branch", ccsGet, NULL), $this);
        $this->eqtop_toppan = & new clsControl(ccsLabel, "eqtop_toppan", "eqtop_toppan", ccsText, "", CCGetRequestParam("eqtop_toppan", ccsGet, NULL), $this);
        $this->eqtop_serialnumber = & new clsControl(ccsLabel, "eqtop_serialnumber", "eqtop_serialnumber", ccsText, "", CCGetRequestParam("eqtop_serialnumber", ccsGet, NULL), $this);
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

//Show Method @2-7C9B4231
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);
        $this->DataSource->Parameters["urlqcode"] = CCGetFromGet("qcode", NULL);
        $this->DataSource->Parameters["urlbranch"] = CCGetFromGet("branch", NULL);

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
            $this->ControlsVisible["eqtop_eqcode"] = $this->eqtop_eqcode->Visible;
            $this->ControlsVisible["eqtop_branch"] = $this->eqtop_branch->Visible;
            $this->ControlsVisible["eqtop_toppan"] = $this->eqtop_toppan->Visible;
            $this->ControlsVisible["eqtop_serialnumber"] = $this->eqtop_serialnumber->Visible;
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
                $this->eqtop_eqcode->SetValue($this->DataSource->eqtop_eqcode->GetValue());
                $this->eqtop_branch->SetValue($this->DataSource->eqtop_branch->GetValue());
                $this->eqtop_toppan->SetValue($this->DataSource->eqtop_toppan->GetValue());
                $this->eqtop_serialnumber->SetValue($this->DataSource->eqtop_serialnumber->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->eqtop_eqcode->Show();
                $this->eqtop_branch->Show();
                $this->eqtop_toppan->Show();
                $this->eqtop_serialnumber->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-45EEB5B5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_eqcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_toppan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_eqtoppan Class @2-FCB6E20C

class clssmart_eqtoppanDataSource extends clsDBSMART {  //smart_eqtoppanDataSource Class @2-6444764F

//DataSource Variables @2-77B3A04E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $eqtop_eqcode;
    var $eqtop_branch;
    var $eqtop_toppan;
    var $eqtop_serialnumber;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-84CF0A84
    function clssmart_eqtoppanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_eqtoppan";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->eqtop_eqcode = new clsField("eqtop_eqcode", ccsText, "");
        
        $this->eqtop_branch = new clsField("eqtop_branch", ccsText, "");
        
        $this->eqtop_toppan = new clsField("eqtop_toppan", ccsText, "");
        
        $this->eqtop_serialnumber = new clsField("eqtop_serialnumber", ccsText, "");
        

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

//Prepare Method @2-DDA6038E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->AddParameter("2", "urlqcode", ccsText, "", "", $this->Parameters["urlqcode"], "", false);
        $this->wp->AddParameter("3", "urlbranch", ccsText, "", "", $this->Parameters["urlbranch"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "eqtop_toppan", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "eqtop_eqcode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "eqtop_branch", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-FF91FC8C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_eqtoppan";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_eqtoppan {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F0721738
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->eqtop_eqcode->SetDBValue($this->f("eqtop_eqcode"));
        $this->eqtop_branch->SetDBValue($this->f("eqtop_branch"));
        $this->eqtop_toppan->SetDBValue($this->f("eqtop_toppan"));
        $this->eqtop_serialnumber->SetDBValue($this->f("eqtop_serialnumber"));
    }
//End SetValues Method

} //End smart_eqtoppanDataSource Class @2-FCB6E20C

//Initialize Page @1-929250AF
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
$TemplateFileName = "ticketdetails_smart_ticket_tckt_toppanid_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D3435E8D
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_eqtoppan = & new clsGridsmart_eqtoppan("", $MainPage);
$MainPage->smart_eqtoppan = & $smart_eqtoppan;
$smart_eqtoppan->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-00E1AF07
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_eqtoppan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BC448B7E
$smart_eqtoppan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C9A3AEE5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_eqtoppan);
unset($Tpl);
//End Unload Page


?>
