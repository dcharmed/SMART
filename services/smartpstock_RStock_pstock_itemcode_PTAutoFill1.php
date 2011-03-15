<?php
//Include Common Files @1-97355583
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "smartpstock_RStock_pstock_itemcode_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsmart_partsstock { //smart_partsstock class @2-0EC31708

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

//Class_Initialize Event @2-44D70389
    function clsGridsmart_partsstock($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_partsstock";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_partsstock";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_partsstockDataSource($this);
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
        $this->pstock_itemname = & new clsControl(ccsLabel, "pstock_itemname", "pstock_itemname", ccsText, "", CCGetRequestParam("pstock_itemname", ccsGet, NULL), $this);
        $this->pstock_itemcode = & new clsControl(ccsLabel, "pstock_itemcode", "pstock_itemcode", ccsText, "", CCGetRequestParam("pstock_itemcode", ccsGet, NULL), $this);
        $this->pstock_number = & new clsControl(ccsLabel, "pstock_number", "pstock_number", ccsText, "", CCGetRequestParam("pstock_number", ccsGet, NULL), $this);
        $this->pstock_date = & new clsControl(ccsLabel, "pstock_date", "pstock_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("pstock_date", ccsGet, NULL), $this);
        $this->pstock_preqformno = & new clsControl(ccsLabel, "pstock_preqformno", "pstock_preqformno", ccsText, "", CCGetRequestParam("pstock_preqformno", ccsGet, NULL), $this);
        $this->pstock_checking = & new clsControl(ccsLabel, "pstock_checking", "pstock_checking", ccsInteger, "", CCGetRequestParam("pstock_checking", ccsGet, NULL), $this);
        $this->pstock_qty = & new clsControl(ccsLabel, "pstock_qty", "pstock_qty", ccsInteger, "", CCGetRequestParam("pstock_qty", ccsGet, NULL), $this);
        $this->pstock_balance = & new clsControl(ccsLabel, "pstock_balance", "pstock_balance", ccsInteger, "", CCGetRequestParam("pstock_balance", ccsGet, NULL), $this);
        $this->pstock_remarks = & new clsControl(ccsLabel, "pstock_remarks", "pstock_remarks", ccsMemo, "", CCGetRequestParam("pstock_remarks", ccsGet, NULL), $this);
        $this->datemodified = & new clsControl(ccsLabel, "datemodified", "datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", ccsGet, NULL), $this);
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

//Show Method @2-6B189D1F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);

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
            $this->ControlsVisible["pstock_itemname"] = $this->pstock_itemname->Visible;
            $this->ControlsVisible["pstock_itemcode"] = $this->pstock_itemcode->Visible;
            $this->ControlsVisible["pstock_number"] = $this->pstock_number->Visible;
            $this->ControlsVisible["pstock_date"] = $this->pstock_date->Visible;
            $this->ControlsVisible["pstock_preqformno"] = $this->pstock_preqformno->Visible;
            $this->ControlsVisible["pstock_checking"] = $this->pstock_checking->Visible;
            $this->ControlsVisible["pstock_qty"] = $this->pstock_qty->Visible;
            $this->ControlsVisible["pstock_balance"] = $this->pstock_balance->Visible;
            $this->ControlsVisible["pstock_remarks"] = $this->pstock_remarks->Visible;
            $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
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
                $this->pstock_itemname->SetValue($this->DataSource->pstock_itemname->GetValue());
                $this->pstock_itemcode->SetValue($this->DataSource->pstock_itemcode->GetValue());
                $this->pstock_number->SetValue($this->DataSource->pstock_number->GetValue());
                $this->pstock_date->SetValue($this->DataSource->pstock_date->GetValue());
                $this->pstock_preqformno->SetValue($this->DataSource->pstock_preqformno->GetValue());
                $this->pstock_checking->SetValue($this->DataSource->pstock_checking->GetValue());
                $this->pstock_qty->SetValue($this->DataSource->pstock_qty->GetValue());
                $this->pstock_balance->SetValue($this->DataSource->pstock_balance->GetValue());
                $this->pstock_remarks->SetValue($this->DataSource->pstock_remarks->GetValue());
                $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->pstock_itemname->Show();
                $this->pstock_itemcode->Show();
                $this->pstock_number->Show();
                $this->pstock_date->Show();
                $this->pstock_preqformno->Show();
                $this->pstock_checking->Show();
                $this->pstock_qty->Show();
                $this->pstock_balance->Show();
                $this->pstock_remarks->Show();
                $this->datemodified->Show();
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

//GetErrors Method @2-AFE8A4B7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_itemname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_itemcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_preqformno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_checking->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_balance->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_partsstock Class @2-FCB6E20C

class clssmart_partsstockDataSource extends clsDBSMART {  //smart_partsstockDataSource Class @2-73473C81

//DataSource Variables @2-789E8B81
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $pstock_itemname;
    var $pstock_itemcode;
    var $pstock_number;
    var $pstock_date;
    var $pstock_preqformno;
    var $pstock_checking;
    var $pstock_qty;
    var $pstock_balance;
    var $pstock_remarks;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A6C88BEE
    function clssmart_partsstockDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_partsstock";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->pstock_itemname = new clsField("pstock_itemname", ccsText, "");
        
        $this->pstock_itemcode = new clsField("pstock_itemcode", ccsText, "");
        
        $this->pstock_number = new clsField("pstock_number", ccsText, "");
        
        $this->pstock_date = new clsField("pstock_date", ccsDate, $this->DateFormat);
        
        $this->pstock_preqformno = new clsField("pstock_preqformno", ccsText, "");
        
        $this->pstock_checking = new clsField("pstock_checking", ccsInteger, "");
        
        $this->pstock_qty = new clsField("pstock_qty", ccsInteger, "");
        
        $this->pstock_balance = new clsField("pstock_balance", ccsInteger, "");
        
        $this->pstock_remarks = new clsField("pstock_remarks", ccsMemo, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        

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

//Prepare Method @2-EF3617DD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsInteger, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-03E8648D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsstock";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsstock {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-763732E9
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->pstock_itemname->SetDBValue($this->f("pstock_itemname"));
        $this->pstock_itemcode->SetDBValue($this->f("pstock_itemcode"));
        $this->pstock_number->SetDBValue($this->f("pstock_number"));
        $this->pstock_date->SetDBValue(trim($this->f("pstock_date")));
        $this->pstock_preqformno->SetDBValue($this->f("pstock_preqformno"));
        $this->pstock_checking->SetDBValue(trim($this->f("pstock_checking")));
        $this->pstock_qty->SetDBValue(trim($this->f("pstock_qty")));
        $this->pstock_balance->SetDBValue(trim($this->f("pstock_balance")));
        $this->pstock_remarks->SetDBValue($this->f("pstock_remarks"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

} //End smart_partsstockDataSource Class @2-FCB6E20C

//Initialize Page @1-B204588C
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
$TemplateFileName = "smartpstock_RStock_pstock_itemcode_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9EEA7897
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_partsstock = & new clsGridsmart_partsstock("", $MainPage);
$MainPage->smart_partsstock = & $smart_partsstock;
$smart_partsstock->Initialize();

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

//Go to destination page @1-5A90E6B0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_partsstock);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FE1BEFFE
$smart_partsstock->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FD74FB63
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_partsstock);
unset($Tpl);
//End Unload Page


?>
