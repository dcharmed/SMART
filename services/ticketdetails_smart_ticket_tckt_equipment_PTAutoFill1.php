<?php
//Include Common Files @1-8603B274
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "ticketdetails_smart_ticket_tckt_equipment_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsmart_equipment { //smart_equipment class @2-DE6923ED

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

//Class_Initialize Event @2-E1A88DD1
    function clsGridsmart_equipment($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_equipment";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_equipment";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_equipmentDataSource($this);
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
        $this->eqpmt_code = & new clsControl(ccsLabel, "eqpmt_code", "eqpmt_code", ccsText, "", CCGetRequestParam("eqpmt_code", ccsGet, NULL), $this);
        $this->eqpmt_status = & new clsControl(ccsLabel, "eqpmt_status", "eqpmt_status", ccsText, "", CCGetRequestParam("eqpmt_status", ccsGet, NULL), $this);
        $this->eqpmt_name = & new clsControl(ccsLabel, "eqpmt_name", "eqpmt_name", ccsText, "", CCGetRequestParam("eqpmt_name", ccsGet, NULL), $this);
        $this->eqpmt_serialnumber = & new clsControl(ccsLabel, "eqpmt_serialnumber", "eqpmt_serialnumber", ccsText, "", CCGetRequestParam("eqpmt_serialnumber", ccsGet, NULL), $this);
        $this->eqpmt_datelifetime = & new clsControl(ccsLabel, "eqpmt_datelifetime", "eqpmt_datelifetime", ccsDate, $DefaultDateFormat, CCGetRequestParam("eqpmt_datelifetime", ccsGet, NULL), $this);
        $this->eqpmt_datereceived = & new clsControl(ccsLabel, "eqpmt_datereceived", "eqpmt_datereceived", ccsDate, $DefaultDateFormat, CCGetRequestParam("eqpmt_datereceived", ccsGet, NULL), $this);
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

//Show Method @2-1D4D0BA4
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
            $this->ControlsVisible["eqpmt_code"] = $this->eqpmt_code->Visible;
            $this->ControlsVisible["eqpmt_status"] = $this->eqpmt_status->Visible;
            $this->ControlsVisible["eqpmt_name"] = $this->eqpmt_name->Visible;
            $this->ControlsVisible["eqpmt_serialnumber"] = $this->eqpmt_serialnumber->Visible;
            $this->ControlsVisible["eqpmt_datelifetime"] = $this->eqpmt_datelifetime->Visible;
            $this->ControlsVisible["eqpmt_datereceived"] = $this->eqpmt_datereceived->Visible;
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
                $this->eqpmt_code->SetValue($this->DataSource->eqpmt_code->GetValue());
                $this->eqpmt_status->SetValue($this->DataSource->eqpmt_status->GetValue());
                $this->eqpmt_name->SetValue($this->DataSource->eqpmt_name->GetValue());
                $this->eqpmt_serialnumber->SetValue($this->DataSource->eqpmt_serialnumber->GetValue());
                $this->eqpmt_datelifetime->SetValue($this->DataSource->eqpmt_datelifetime->GetValue());
                $this->eqpmt_datereceived->SetValue($this->DataSource->eqpmt_datereceived->GetValue());
                $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->eqpmt_code->Show();
                $this->eqpmt_status->Show();
                $this->eqpmt_name->Show();
                $this->eqpmt_serialnumber->Show();
                $this->eqpmt_datelifetime->Show();
                $this->eqpmt_datereceived->Show();
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

//GetErrors Method @2-192FF017
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_datelifetime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_datereceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_equipment Class @2-FCB6E20C

class clssmart_equipmentDataSource extends clsDBSMART {  //smart_equipmentDataSource Class @2-070EC136

//DataSource Variables @2-C6E15AF5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $eqpmt_code;
    var $eqpmt_status;
    var $eqpmt_name;
    var $eqpmt_serialnumber;
    var $eqpmt_datelifetime;
    var $eqpmt_datereceived;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4DBEB350
    function clssmart_equipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_equipment";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->eqpmt_code = new clsField("eqpmt_code", ccsText, "");
        
        $this->eqpmt_status = new clsField("eqpmt_status", ccsText, "");
        
        $this->eqpmt_name = new clsField("eqpmt_name", ccsText, "");
        
        $this->eqpmt_serialnumber = new clsField("eqpmt_serialnumber", ccsText, "");
        
        $this->eqpmt_datelifetime = new clsField("eqpmt_datelifetime", ccsDate, $this->DateFormat);
        
        $this->eqpmt_datereceived = new clsField("eqpmt_datereceived", ccsDate, $this->DateFormat);
        
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

//Prepare Method @2-3E12B7D0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "eqpmt_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-7BE181CA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_equipment";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-613A7626
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->eqpmt_code->SetDBValue($this->f("eqpmt_code"));
        $this->eqpmt_status->SetDBValue($this->f("eqpmt_status"));
        $this->eqpmt_name->SetDBValue($this->f("eqpmt_name"));
        $this->eqpmt_serialnumber->SetDBValue($this->f("eqpmt_serialnumber"));
        $this->eqpmt_datelifetime->SetDBValue(trim($this->f("eqpmt_datelifetime")));
        $this->eqpmt_datereceived->SetDBValue(trim($this->f("eqpmt_datereceived")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

} //End smart_equipmentDataSource Class @2-FCB6E20C

//Initialize Page @1-9423A931
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
$TemplateFileName = "ticketdetails_smart_ticket_tckt_equipment_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F96C7793
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_equipment = & new clsGridsmart_equipment("", $MainPage);
$MainPage->smart_equipment = & $smart_equipment;
$smart_equipment->Initialize();

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

//Go to destination page @1-F072A636
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_equipment);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A2ED9D54
$smart_equipment->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D3BA52E7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_equipment);
unset($Tpl);
//End Unload Page


?>
