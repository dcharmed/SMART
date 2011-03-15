<?php
//Include Common Files @1-B6410772
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsmart_sparepart { //smart_sparepart class @2-2FBF3CBC

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

//Class_Initialize Event @2-42EF5655
    function clsGridsmart_sparepart($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_sparepart";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_sparepart";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_sparepartDataSource($this);
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
        $this->spart_category = & new clsControl(ccsLabel, "spart_category", "spart_category", ccsText, "", CCGetRequestParam("spart_category", ccsGet, NULL), $this);
        $this->spart_status = & new clsControl(ccsLabel, "spart_status", "spart_status", ccsText, "", CCGetRequestParam("spart_status", ccsGet, NULL), $this);
        $this->spart_code = & new clsControl(ccsLabel, "spart_code", "spart_code", ccsText, "", CCGetRequestParam("spart_code", ccsGet, NULL), $this);
        $this->spart_name = & new clsControl(ccsLabel, "spart_name", "spart_name", ccsText, "", CCGetRequestParam("spart_name", ccsGet, NULL), $this);
        $this->spart_number = & new clsControl(ccsLabel, "spart_number", "spart_number", ccsText, "", CCGetRequestParam("spart_number", ccsGet, NULL), $this);
        $this->spart_minlevel = & new clsControl(ccsLabel, "spart_minlevel", "spart_minlevel", ccsInteger, "", CCGetRequestParam("spart_minlevel", ccsGet, NULL), $this);
        $this->spart_reorderlevel = & new clsControl(ccsLabel, "spart_reorderlevel", "spart_reorderlevel", ccsInteger, "", CCGetRequestParam("spart_reorderlevel", ccsGet, NULL), $this);
        $this->spart_maxlevel = & new clsControl(ccsLabel, "spart_maxlevel", "spart_maxlevel", ccsInteger, "", CCGetRequestParam("spart_maxlevel", ccsGet, NULL), $this);
        $this->spart_central = & new clsControl(ccsLabel, "spart_central", "spart_central", ccsInteger, "", CCGetRequestParam("spart_central", ccsGet, NULL), $this);
        $this->spart_regional = & new clsControl(ccsLabel, "spart_regional", "spart_regional", ccsInteger, "", CCGetRequestParam("spart_regional", ccsGet, NULL), $this);
        $this->spart_datelifetime = & new clsControl(ccsLabel, "spart_datelifetime", "spart_datelifetime", ccsDate, $DefaultDateFormat, CCGetRequestParam("spart_datelifetime", ccsGet, NULL), $this);
        $this->spart_datereceived = & new clsControl(ccsLabel, "spart_datereceived", "spart_datereceived", ccsDate, $DefaultDateFormat, CCGetRequestParam("spart_datereceived", ccsGet, NULL), $this);
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

//Show Method @2-E7377D7C
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
            $this->ControlsVisible["spart_category"] = $this->spart_category->Visible;
            $this->ControlsVisible["spart_status"] = $this->spart_status->Visible;
            $this->ControlsVisible["spart_code"] = $this->spart_code->Visible;
            $this->ControlsVisible["spart_name"] = $this->spart_name->Visible;
            $this->ControlsVisible["spart_number"] = $this->spart_number->Visible;
            $this->ControlsVisible["spart_minlevel"] = $this->spart_minlevel->Visible;
            $this->ControlsVisible["spart_reorderlevel"] = $this->spart_reorderlevel->Visible;
            $this->ControlsVisible["spart_maxlevel"] = $this->spart_maxlevel->Visible;
            $this->ControlsVisible["spart_central"] = $this->spart_central->Visible;
            $this->ControlsVisible["spart_regional"] = $this->spart_regional->Visible;
            $this->ControlsVisible["spart_datelifetime"] = $this->spart_datelifetime->Visible;
            $this->ControlsVisible["spart_datereceived"] = $this->spart_datereceived->Visible;
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
                $this->spart_category->SetValue($this->DataSource->spart_category->GetValue());
                $this->spart_status->SetValue($this->DataSource->spart_status->GetValue());
                $this->spart_code->SetValue($this->DataSource->spart_code->GetValue());
                $this->spart_name->SetValue($this->DataSource->spart_name->GetValue());
                $this->spart_number->SetValue($this->DataSource->spart_number->GetValue());
                $this->spart_minlevel->SetValue($this->DataSource->spart_minlevel->GetValue());
                $this->spart_reorderlevel->SetValue($this->DataSource->spart_reorderlevel->GetValue());
                $this->spart_maxlevel->SetValue($this->DataSource->spart_maxlevel->GetValue());
                $this->spart_central->SetValue($this->DataSource->spart_central->GetValue());
                $this->spart_regional->SetValue($this->DataSource->spart_regional->GetValue());
                $this->spart_datelifetime->SetValue($this->DataSource->spart_datelifetime->GetValue());
                $this->spart_datereceived->SetValue($this->DataSource->spart_datereceived->GetValue());
                $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->spart_category->Show();
                $this->spart_status->Show();
                $this->spart_code->Show();
                $this->spart_name->Show();
                $this->spart_number->Show();
                $this->spart_minlevel->Show();
                $this->spart_reorderlevel->Show();
                $this->spart_maxlevel->Show();
                $this->spart_central->Show();
                $this->spart_regional->Show();
                $this->spart_datelifetime->Show();
                $this->spart_datereceived->Show();
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

//GetErrors Method @2-BC23E797
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_minlevel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_reorderlevel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_maxlevel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_central->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_regional->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_datelifetime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->spart_datereceived->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_sparepart Class @2-FCB6E20C

class clssmart_sparepartDataSource extends clsDBSMART {  //smart_sparepartDataSource Class @2-FCDBDDE8

//DataSource Variables @2-1260AB62
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $spart_category;
    var $spart_status;
    var $spart_code;
    var $spart_name;
    var $spart_number;
    var $spart_minlevel;
    var $spart_reorderlevel;
    var $spart_maxlevel;
    var $spart_central;
    var $spart_regional;
    var $spart_datelifetime;
    var $spart_datereceived;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9CEA70BE
    function clssmart_sparepartDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_sparepart";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->spart_category = new clsField("spart_category", ccsText, "");
        
        $this->spart_status = new clsField("spart_status", ccsText, "");
        
        $this->spart_code = new clsField("spart_code", ccsText, "");
        
        $this->spart_name = new clsField("spart_name", ccsText, "");
        
        $this->spart_number = new clsField("spart_number", ccsText, "");
        
        $this->spart_minlevel = new clsField("spart_minlevel", ccsInteger, "");
        
        $this->spart_reorderlevel = new clsField("spart_reorderlevel", ccsInteger, "");
        
        $this->spart_maxlevel = new clsField("spart_maxlevel", ccsInteger, "");
        
        $this->spart_central = new clsField("spart_central", ccsInteger, "");
        
        $this->spart_regional = new clsField("spart_regional", ccsInteger, "");
        
        $this->spart_datelifetime = new clsField("spart_datelifetime", ccsDate, $this->DateFormat);
        
        $this->spart_datereceived = new clsField("spart_datereceived", ccsDate, $this->DateFormat);
        
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

//Prepare Method @2-7435126F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "spart_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-F66EF2DD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_sparepart";
        $this->SQL = "SELECT spart_name \n\n" .
        "FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-622BC49B
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->spart_category->SetDBValue($this->f("spart_category"));
        $this->spart_status->SetDBValue($this->f("spart_status"));
        $this->spart_code->SetDBValue($this->f("spart_code"));
        $this->spart_name->SetDBValue($this->f("spart_name"));
        $this->spart_number->SetDBValue($this->f("spart_number"));
        $this->spart_minlevel->SetDBValue(trim($this->f("spart_minlevel")));
        $this->spart_reorderlevel->SetDBValue(trim($this->f("spart_reorderlevel")));
        $this->spart_maxlevel->SetDBValue(trim($this->f("spart_maxlevel")));
        $this->spart_central->SetDBValue(trim($this->f("spart_central")));
        $this->spart_regional->SetDBValue(trim($this->f("spart_regional")));
        $this->spart_datelifetime->SetDBValue(trim($this->f("spart_datelifetime")));
        $this->spart_datereceived->SetDBValue(trim($this->f("spart_datereceived")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

} //End smart_sparepartDataSource Class @2-FCB6E20C

//Initialize Page @1-9AF073F7
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
$TemplateFileName = "smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DD0A1E11
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_sparepart = & new clsGridsmart_sparepart("", $MainPage);
$MainPage->smart_sparepart = & $smart_sparepart;
$smart_sparepart->Initialize();

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

//Go to destination page @1-DB5A4629
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_sparepart);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D2830425
$smart_sparepart->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-614E0BC1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_sparepart);
unset($Tpl);
//End Unload Page


?>
