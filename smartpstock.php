<?php
//Include Common Files @1-E92F0E38
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartpstock.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsGridGStock { //GStock class @5-0D4DEAA2

//Variables @5-AC1EDBB9

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

//Class_Initialize Event @5-E5761C7C
    function clsGridGStock($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GStock";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GStock";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGStockDataSource($this);
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

        $this->pstock_date = & new clsControl(ccsLabel, "pstock_date", "pstock_date", ccsDate, array("GeneralDate"), CCGetRequestParam("pstock_date", ccsGet, NULL), $this);
        $this->pstock_preqformno = & new clsControl(ccsLabel, "pstock_preqformno", "pstock_preqformno", ccsText, "", CCGetRequestParam("pstock_preqformno", ccsGet, NULL), $this);
        $this->pstock_in = & new clsControl(ccsLabel, "pstock_in", "pstock_in", ccsText, "", CCGetRequestParam("pstock_in", ccsGet, NULL), $this);
        $this->pstock_out = & new clsControl(ccsLabel, "pstock_out", "pstock_out", ccsInteger, "", CCGetRequestParam("pstock_out", ccsGet, NULL), $this);
        $this->pstock_balance = & new clsControl(ccsLabel, "pstock_balance", "pstock_balance", ccsInteger, "", CCGetRequestParam("pstock_balance", ccsGet, NULL), $this);
        $this->pstock_remarks = & new clsControl(ccsLabel, "pstock_remarks", "pstock_remarks", ccsMemo, "", CCGetRequestParam("pstock_remarks", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblPart = & new clsControl(ccsLabel, "lblPart", "lblPart", ccsText, "", CCGetRequestParam("lblPart", ccsGet, NULL), $this);
        $this->stock_item = & new clsControl(ccsLabel, "stock_item", "stock_item", ccsText, "", CCGetRequestParam("stock_item", ccsGet, NULL), $this);
        $this->stock_code = & new clsControl(ccsLabel, "stock_code", "stock_code", ccsText, "", CCGetRequestParam("stock_code", ccsGet, NULL), $this);
        $this->stock_number = & new clsControl(ccsLabel, "stock_number", "stock_number", ccsText, "", CCGetRequestParam("stock_number", ccsGet, NULL), $this);
        $this->BtnUpdStock = & new clsControl(ccsImageLink, "BtnUpdStock", "BtnUpdStock", ccsText, "", CCGetRequestParam("BtnUpdStock", ccsGet, NULL), $this);
        $this->BtnUpdStock->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->BtnUpdStock->Page = "smartpstock.php";
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-132E0C85
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_pstock_itemcode"] = CCGetFromGet("s_pstock_itemcode", NULL);
        $this->DataSource->Parameters["urls_pstock_itemname"] = CCGetFromGet("s_pstock_itemname", NULL);

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
            $this->ControlsVisible["pstock_date"] = $this->pstock_date->Visible;
            $this->ControlsVisible["pstock_preqformno"] = $this->pstock_preqformno->Visible;
            $this->ControlsVisible["pstock_in"] = $this->pstock_in->Visible;
            $this->ControlsVisible["pstock_out"] = $this->pstock_out->Visible;
            $this->ControlsVisible["pstock_balance"] = $this->pstock_balance->Visible;
            $this->ControlsVisible["pstock_remarks"] = $this->pstock_remarks->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->pstock_date->SetValue($this->DataSource->pstock_date->GetValue());
                $this->pstock_preqformno->SetValue($this->DataSource->pstock_preqformno->GetValue());
                $this->pstock_in->SetValue($this->DataSource->pstock_in->GetValue());
                $this->pstock_out->SetValue($this->DataSource->pstock_out->GetValue());
                $this->pstock_balance->SetValue($this->DataSource->pstock_balance->GetValue());
                $this->pstock_remarks->SetValue($this->DataSource->pstock_remarks->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->pstock_date->Show();
                $this->pstock_preqformno->Show();
                $this->pstock_in->Show();
                $this->pstock_out->Show();
                $this->pstock_balance->Show();
                $this->pstock_remarks->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->lblPart->Show();
        $this->stock_item->Show();
        $this->stock_code->Show();
        $this->stock_number->Show();
        $this->BtnUpdStock->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-A1995973
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->pstock_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_preqformno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_in->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_out->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_balance->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pstock_remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GStock Class @5-FCB6E20C

class clsGStockDataSource extends clsDBSMART {  //GStockDataSource Class @5-DE4DE052

//DataSource Variables @5-F25EAED5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $pstock_date;
    var $pstock_preqformno;
    var $pstock_in;
    var $pstock_out;
    var $pstock_balance;
    var $pstock_remarks;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-4D0B0BA0
    function clsGStockDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GStock";
        $this->Initialize();
        $this->pstock_date = new clsField("pstock_date", ccsDate, $this->DateFormat);
        
        $this->pstock_preqformno = new clsField("pstock_preqformno", ccsText, "");
        
        $this->pstock_in = new clsField("pstock_in", ccsText, "");
        
        $this->pstock_out = new clsField("pstock_out", ccsInteger, "");
        
        $this->pstock_balance = new clsField("pstock_balance", ccsInteger, "");
        
        $this->pstock_remarks = new clsField("pstock_remarks", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-38940476
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "pstock_date";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @5-31AACFC3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_pstock_itemcode", ccsText, "", "", $this->Parameters["urls_pstock_itemcode"], "", false);
        $this->wp->AddParameter("2", "urls_pstock_itemname", ccsText, "", "", $this->Parameters["urls_pstock_itemname"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "pstock_itemcode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "pstock_itemname", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-03E8648D
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

//SetValues Method @5-2CCA8665
    function SetValues()
    {
        $this->pstock_date->SetDBValue(trim($this->f("pstock_date")));
        $this->pstock_preqformno->SetDBValue($this->f("pstock_preqformno"));
        $this->pstock_in->SetDBValue($this->f("pstock_number"));
        $this->pstock_out->SetDBValue(trim($this->f("pstock_checking")));
        $this->pstock_balance->SetDBValue(trim($this->f("pstock_balance")));
        $this->pstock_remarks->SetDBValue($this->f("pstock_remarks"));
    }
//End SetValues Method

} //End GStockDataSource Class @5-FCB6E20C

class clsRecordSStock { //SStock Class @6-CA95539E

//Variables @6-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @6-27D3498E
    function clsRecordSStock($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SStock/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SStock";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->qryc = & new clsControl(ccsTextBox, "qryc", "qryc", ccsText, "", CCGetRequestParam("qryc", $Method, NULL), $this);
            $this->qryn = & new clsControl(ccsTextBox, "qryn", "qryn", ccsText, "", CCGetRequestParam("qryn", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @6-2CD5FDCC
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->qryc->Validate() && $Validation);
        $Validation = ($this->qryn->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->qryc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->qryn->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-725F3EEC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->qryc->Errors->Count());
        $errors = ($errors || $this->qryn->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @6-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @6-ACB5E024
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "smartpstock.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "smartpstock.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-BC33147F
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->qryc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qryn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->qryc->Show();
        $this->qryn->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SStock Class @6-FCB6E20C

class clsRecordRStock { //RStock Class @31-6CE2582A

//Variables @31-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @31-C4BEBF55
    function clsRecordRStock($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RStock/Error";
        $this->DataSource = new clsRStockDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RStock";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->pstock_itemname = & new clsControl(ccsTextBox, "pstock_itemname", "Item Name", ccsText, "", CCGetRequestParam("pstock_itemname", $Method, NULL), $this);
            $this->pstock_itemname->Required = true;
            $this->pstock_itemcode = & new clsControl(ccsTextBox, "pstock_itemcode", "Item Code", ccsText, "", CCGetRequestParam("pstock_itemcode", $Method, NULL), $this);
            $this->pstock_itemcode->Required = true;
            $this->pstock_number = & new clsControl(ccsTextBox, "pstock_number", "Stock Number", ccsText, "", CCGetRequestParam("pstock_number", $Method, NULL), $this);
            $this->pstock_number->Required = true;
            $this->pstock_date = & new clsControl(ccsTextBox, "pstock_date", "Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("pstock_date", $Method, NULL), $this);
            $this->pstock_date->Required = true;
            $this->DatePicker_pstock_date = & new clsDatePicker("DatePicker_pstock_date", "RStock", "pstock_date", $this);
            $this->pstock_preqformno = & new clsControl(ccsTextBox, "pstock_preqformno", "Form No.", ccsText, "", CCGetRequestParam("pstock_preqformno", $Method, NULL), $this);
            $this->pstock_preqformno->Required = true;
            $this->pstock_checking = & new clsControl(ccsRadioButton, "pstock_checking", "Stock Checking", ccsInteger, "", CCGetRequestParam("pstock_checking", $Method, NULL), $this);
            $this->pstock_checking->DSType = dsListOfValues;
            $this->pstock_checking->Values = array(array("1", "In"), array("2", "Out"), array("3", "Stock Updates"));
            $this->pstock_checking->HTML = true;
            $this->pstock_checking->Required = true;
            $this->pstock_balance = & new clsControl(ccsTextBox, "pstock_balance", "Balance", ccsInteger, "", CCGetRequestParam("pstock_balance", $Method, NULL), $this);
            $this->pstock_balance->Required = true;
            $this->pstock_remarks = & new clsControl(ccsTextArea, "pstock_remarks", "Remarks", ccsMemo, "", CCGetRequestParam("pstock_remarks", $Method, NULL), $this);
            $this->pstock_qty = & new clsControl(ccsTextBox, "pstock_qty", "Quantity Stock", ccsText, "", CCGetRequestParam("pstock_qty", $Method, NULL), $this);
            $this->pstock_qty->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @31-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @31-7942A286
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->pstock_itemname->Validate() && $Validation);
        $Validation = ($this->pstock_itemcode->Validate() && $Validation);
        $Validation = ($this->pstock_number->Validate() && $Validation);
        $Validation = ($this->pstock_date->Validate() && $Validation);
        $Validation = ($this->pstock_preqformno->Validate() && $Validation);
        $Validation = ($this->pstock_checking->Validate() && $Validation);
        $Validation = ($this->pstock_balance->Validate() && $Validation);
        $Validation = ($this->pstock_remarks->Validate() && $Validation);
        $Validation = ($this->pstock_qty->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->pstock_itemname->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_itemcode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_number->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_preqformno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_checking->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_balance->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_remarks->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pstock_qty->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @31-1703A887
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->pstock_itemname->Errors->Count());
        $errors = ($errors || $this->pstock_itemcode->Errors->Count());
        $errors = ($errors || $this->pstock_number->Errors->Count());
        $errors = ($errors || $this->pstock_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_pstock_date->Errors->Count());
        $errors = ($errors || $this->pstock_preqformno->Errors->Count());
        $errors = ($errors || $this->pstock_checking->Errors->Count());
        $errors = ($errors || $this->pstock_balance->Errors->Count());
        $errors = ($errors || $this->pstock_remarks->Errors->Count());
        $errors = ($errors || $this->pstock_qty->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @31-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @31-DEFDCF33
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @31-4B2C7A93
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->pstock_itemname->SetValue($this->pstock_itemname->GetValue(true));
        $this->DataSource->pstock_itemcode->SetValue($this->pstock_itemcode->GetValue(true));
        $this->DataSource->pstock_number->SetValue($this->pstock_number->GetValue(true));
        $this->DataSource->pstock_date->SetValue($this->pstock_date->GetValue(true));
        $this->DataSource->pstock_preqformno->SetValue($this->pstock_preqformno->GetValue(true));
        $this->DataSource->pstock_checking->SetValue($this->pstock_checking->GetValue(true));
        $this->DataSource->pstock_balance->SetValue($this->pstock_balance->GetValue(true));
        $this->DataSource->pstock_remarks->SetValue($this->pstock_remarks->GetValue(true));
        $this->DataSource->pstock_qty->SetValue($this->pstock_qty->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @31-0B8C6616
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->pstock_checking->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->pstock_itemname->SetValue($this->DataSource->pstock_itemname->GetValue());
                    $this->pstock_itemcode->SetValue($this->DataSource->pstock_itemcode->GetValue());
                    $this->pstock_number->SetValue($this->DataSource->pstock_number->GetValue());
                    $this->pstock_date->SetValue($this->DataSource->pstock_date->GetValue());
                    $this->pstock_preqformno->SetValue($this->DataSource->pstock_preqformno->GetValue());
                    $this->pstock_checking->SetValue($this->DataSource->pstock_checking->GetValue());
                    $this->pstock_balance->SetValue($this->DataSource->pstock_balance->GetValue());
                    $this->pstock_remarks->SetValue($this->DataSource->pstock_remarks->GetValue());
                    $this->pstock_qty->SetValue($this->DataSource->pstock_qty->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->pstock_itemname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_itemcode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_number->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_pstock_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_preqformno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_checking->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_balance->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_remarks->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pstock_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $this->pstock_itemname->Show();
        $this->pstock_itemcode->Show();
        $this->pstock_number->Show();
        $this->pstock_date->Show();
        $this->DatePicker_pstock_date->Show();
        $this->pstock_preqformno->Show();
        $this->pstock_checking->Show();
        $this->pstock_balance->Show();
        $this->pstock_remarks->Show();
        $this->pstock_qty->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RStock Class @31-FCB6E20C

class clsRStockDataSource extends clsDBSMART {  //RStockDataSource Class @31-4D70EC1F

//DataSource Variables @31-523CC1BF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();

    // Datasource fields
    var $pstock_itemname;
    var $pstock_itemcode;
    var $pstock_number;
    var $pstock_date;
    var $pstock_preqformno;
    var $pstock_checking;
    var $pstock_balance;
    var $pstock_remarks;
    var $pstock_qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @31-0C9BF0EE
    function clsRStockDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RStock/Error";
        $this->Initialize();
        $this->pstock_itemname = new clsField("pstock_itemname", ccsText, "");
        
        $this->pstock_itemcode = new clsField("pstock_itemcode", ccsText, "");
        
        $this->pstock_number = new clsField("pstock_number", ccsText, "");
        
        $this->pstock_date = new clsField("pstock_date", ccsDate, $this->DateFormat);
        
        $this->pstock_preqformno = new clsField("pstock_preqformno", ccsText, "");
        
        $this->pstock_checking = new clsField("pstock_checking", ccsInteger, "");
        
        $this->pstock_balance = new clsField("pstock_balance", ccsInteger, "");
        
        $this->pstock_remarks = new clsField("pstock_remarks", ccsMemo, "");
        
        $this->pstock_qty = new clsField("pstock_qty", ccsText, "");
        

        $this->InsertFields["pstock_itemname"] = array("Name" => "pstock_itemname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_itemcode"] = array("Name" => "pstock_itemcode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_number"] = array("Name" => "pstock_number", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_date"] = array("Name" => "pstock_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_preqformno"] = array("Name" => "pstock_preqformno", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_checking"] = array("Name" => "pstock_checking", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_balance"] = array("Name" => "pstock_balance", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_remarks"] = array("Name" => "pstock_remarks", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["pstock_qty"] = array("Name" => "pstock_qty", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @31-35B33087
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @31-FE2419DF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsstock {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @31-A46403DF
    function SetValues()
    {
        $this->pstock_itemname->SetDBValue($this->f("pstock_itemname"));
        $this->pstock_itemcode->SetDBValue($this->f("pstock_itemcode"));
        $this->pstock_number->SetDBValue($this->f("pstock_number"));
        $this->pstock_date->SetDBValue(trim($this->f("pstock_date")));
        $this->pstock_preqformno->SetDBValue($this->f("pstock_preqformno"));
        $this->pstock_checking->SetDBValue(trim($this->f("pstock_checking")));
        $this->pstock_balance->SetDBValue(trim($this->f("pstock_balance")));
        $this->pstock_remarks->SetDBValue($this->f("pstock_remarks"));
        $this->pstock_qty->SetDBValue($this->f("pstock_qty"));
    }
//End SetValues Method

//Insert Method @31-1DF432BE
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["pstock_itemname"]["Value"] = $this->pstock_itemname->GetDBValue(true);
        $this->InsertFields["pstock_itemcode"]["Value"] = $this->pstock_itemcode->GetDBValue(true);
        $this->InsertFields["pstock_number"]["Value"] = $this->pstock_number->GetDBValue(true);
        $this->InsertFields["pstock_date"]["Value"] = $this->pstock_date->GetDBValue(true);
        $this->InsertFields["pstock_preqformno"]["Value"] = $this->pstock_preqformno->GetDBValue(true);
        $this->InsertFields["pstock_checking"]["Value"] = $this->pstock_checking->GetDBValue(true);
        $this->InsertFields["pstock_balance"]["Value"] = $this->pstock_balance->GetDBValue(true);
        $this->InsertFields["pstock_remarks"]["Value"] = $this->pstock_remarks->GetDBValue(true);
        $this->InsertFields["pstock_qty"]["Value"] = $this->pstock_qty->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_partsstock", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End RStockDataSource Class @31-FCB6E20C

//Initialize Page @1-F5FBC45B
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
$TemplateFileName = "smartpstock.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8715BD87
include_once("./smartpstock_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4017AD7B
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$GStock = & new clsGridGStock("", $MainPage);
$SStock = & new clsRecordSStock("", $MainPage);
$RStock = & new clsRecordRStock("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GStock = & $GStock;
$MainPage->SStock = & $SStock;
$MainPage->RStock = & $RStock;
$GStock->Initialize();
$RStock->Initialize();

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

//Execute Components @1-CF0E5306
$header->Operations();
$footer->Operations();
$SStock->Operation();
$RStock->Operation();
//End Execute Components

//Go to destination page @1-CD123EC2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GStock);
    unset($SStock);
    unset($RStock);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-81DA2BEA
$header->Show();
$footer->Show();
$GStock->Show();
$SStock->Show();
$RStock->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-55635875
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GStock);
unset($SStock);
unset($RStock);
unset($Tpl);
//End Unload Page


?>
