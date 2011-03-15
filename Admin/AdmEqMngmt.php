<?php
//Include Common Files @1-52A51496
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "AdmEqMngmt.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-C518F6CD
include_once(RelativePath . "/Admin/adminheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsEditableGridGEquipment { //GEquipment Class @5-4383410B

//Variables @5-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @5-1CE0B8AA
    function clsEditableGridGEquipment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GEquipment/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GEquipment";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGEquipmentDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "Id", ccsInteger, "", NULL, $this);
        $this->eqpmt_code = & new clsControl(ccsTextBox, "eqpmt_code", "Eqpmt Code", ccsText, "", NULL, $this);
        $this->eqpmt_code->Required = true;
        $this->eqpmt_status = & new clsControl(ccsListBox, "eqpmt_status", "Eqpmt Status", ccsText, "", NULL, $this);
        $this->eqpmt_status->DSType = dsListOfValues;
        $this->eqpmt_status->Values = array(array("1", "Active"), array("2", "Not Active"));
        $this->eqpmt_name = & new clsControl(ccsTextBox, "eqpmt_name", "Eqpmt Name", ccsText, "", NULL, $this);
        $this->eqpmt_name->Required = true;
        $this->eqpmt_datelifetime = & new clsControl(ccsTextBox, "eqpmt_datelifetime", "Eqpmt Datelifetime", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->DatePicker_eqpmt_datelifetime = & new clsDatePicker("DatePicker_eqpmt_datelifetime", "GEquipment", "eqpmt_datelifetime", $this);
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", NULL, $this);
        $this->ImageLink1->Page = "AdmEqMngmt.php";
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
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

//SetPrimaryKeys Method @5-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @5-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @5-33BCCF91
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["eqpmt_code"][$RowNumber] = CCGetFromPost("eqpmt_code_" . $RowNumber, NULL);
            $this->FormParameters["eqpmt_status"][$RowNumber] = CCGetFromPost("eqpmt_status_" . $RowNumber, NULL);
            $this->FormParameters["eqpmt_name"][$RowNumber] = CCGetFromPost("eqpmt_name_" . $RowNumber, NULL);
            $this->FormParameters["eqpmt_datelifetime"][$RowNumber] = CCGetFromPost("eqpmt_datelifetime_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["datemodified"][$RowNumber] = CCGetFromPost("datemodified_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @5-992DA1D2
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->eqpmt_code->SetText($this->FormParameters["eqpmt_code"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_status->SetText($this->FormParameters["eqpmt_status"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_name->SetText($this->FormParameters["eqpmt_name"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_datelifetime->SetText($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @5-782DE3D4
    function ValidateRow()
    {
        global $CCSLocales;
        $this->eqpmt_code->Validate();
        $this->eqpmt_status->Validate();
        $this->eqpmt_name->Validate();
        $this->eqpmt_datelifetime->Validate();
        $this->CheckBox_Delete->Validate();
        $this->datemodified->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->eqpmt_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqpmt_datelifetime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $this->eqpmt_code->Errors->Clear();
        $this->eqpmt_status->Errors->Clear();
        $this->eqpmt_name->Errors->Clear();
        $this->eqpmt_datelifetime->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->datemodified->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @5-60D7C9B9
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["eqpmt_code"][$this->RowNumber]) && count($this->FormParameters["eqpmt_code"][$this->RowNumber])) || strlen($this->FormParameters["eqpmt_code"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqpmt_status"][$this->RowNumber]) && count($this->FormParameters["eqpmt_status"][$this->RowNumber])) || strlen($this->FormParameters["eqpmt_status"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqpmt_name"][$this->RowNumber]) && count($this->FormParameters["eqpmt_name"][$this->RowNumber])) || strlen($this->FormParameters["eqpmt_name"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber]) && count($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber])) || strlen($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["datemodified"][$this->RowNumber]) && count($this->FormParameters["datemodified"][$this->RowNumber])) || strlen($this->FormParameters["datemodified"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @5-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @5-909F269B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @5-A5FC0140
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->eqpmt_code->SetText($this->FormParameters["eqpmt_code"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_status->SetText($this->FormParameters["eqpmt_status"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_name->SetText($this->FormParameters["eqpmt_name"][$this->RowNumber], $this->RowNumber);
            $this->eqpmt_datelifetime->SetText($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @5-1E3EEC9E
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->eqpmt_code->SetValue($this->eqpmt_code->GetValue(true));
        $this->DataSource->eqpmt_status->SetValue($this->eqpmt_status->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->eqpmt_datelifetime->SetValue($this->eqpmt_datelifetime->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->ImageLink1->SetValue($this->ImageLink1->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @5-FD98633D
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->eqpmt_code->SetValue($this->eqpmt_code->GetValue(true));
        $this->DataSource->eqpmt_status->SetValue($this->eqpmt_status->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->eqpmt_datelifetime->SetValue($this->eqpmt_datelifetime->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->ImageLink1->SetValue($this->ImageLink1->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @5-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @5-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @5-0EEA5586
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @5-692238C5
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @5-142F2C74
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->eqpmt_status->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
        $this->ControlsVisible["eqpmt_code"] = $this->eqpmt_code->Visible;
        $this->ControlsVisible["eqpmt_status"] = $this->eqpmt_status->Visible;
        $this->ControlsVisible["eqpmt_name"] = $this->eqpmt_name->Visible;
        $this->ControlsVisible["eqpmt_datelifetime"] = $this->eqpmt_datelifetime->Visible;
        $this->ControlsVisible["DatePicker_eqpmt_datelifetime"] = $this->DatePicker_eqpmt_datelifetime->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
        $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->ImageLink1->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->eqpmt_code->SetValue($this->DataSource->eqpmt_code->GetValue());
                    $this->eqpmt_status->SetValue($this->DataSource->eqpmt_status->GetValue());
                    $this->eqpmt_name->SetValue($this->DataSource->eqpmt_name->GetValue());
                    $this->eqpmt_datelifetime->SetValue($this->DataSource->eqpmt_datelifetime->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_code", toppan);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "type", $this->DataSource->f("eqpmt_code"));
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->ImageLink1->SetText("");
                    $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                    $this->eqpmt_code->SetText($this->FormParameters["eqpmt_code"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_status->SetText($this->FormParameters["eqpmt_status"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_name->SetText($this->FormParameters["eqpmt_name"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_datelifetime->SetText($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_code", toppan);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "type", $this->DataSource->f("eqpmt_code"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->lblNumber->SetText("");
                    $this->eqpmt_code->SetText("");
                    $this->eqpmt_status->SetText("");
                    $this->eqpmt_name->SetText("");
                    $this->eqpmt_datelifetime->SetText("");
                    $this->datemodified->SetText("");
                    $this->ImageLink1->SetText("");
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_code", toppan);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "type", $this->DataSource->f("eqpmt_code"));
                } else {
                    $this->lblNumber->SetText("");
                    $this->ImageLink1->SetText("");
                    $this->eqpmt_code->SetText($this->FormParameters["eqpmt_code"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_status->SetText($this->FormParameters["eqpmt_status"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_name->SetText($this->FormParameters["eqpmt_name"][$this->RowNumber], $this->RowNumber);
                    $this->eqpmt_datelifetime->SetText($this->FormParameters["eqpmt_datelifetime"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_code", toppan);
                    $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "type", $this->DataSource->f("eqpmt_code"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show($this->RowNumber);
                $this->eqpmt_code->Show($this->RowNumber);
                $this->eqpmt_status->Show($this->RowNumber);
                $this->eqpmt_name->Show($this->RowNumber);
                $this->eqpmt_datelifetime->Show($this->RowNumber);
                $this->DatePicker_eqpmt_datelifetime->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                $this->datemodified->Show($this->RowNumber);
                $this->ImageLink1->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["id"] == $this->CachedColumns["id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End GEquipment Class @5-FCB6E20C

class clsGEquipmentDataSource extends clsDBSMART {  //GEquipmentDataSource Class @5-C92BBA43

//DataSource Variables @5-C558952A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $lblNumber;
    var $eqpmt_code;
    var $eqpmt_status;
    var $eqpmt_name;
    var $eqpmt_datelifetime;
    var $CheckBox_Delete;
    var $datemodified;
    var $ImageLink1;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-EBD7D147
    function clsGEquipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GEquipment/Error";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->eqpmt_code = new clsField("eqpmt_code", ccsText, "");
        
        $this->eqpmt_status = new clsField("eqpmt_status", ccsText, "");
        
        $this->eqpmt_name = new clsField("eqpmt_name", ccsText, "");
        
        $this->eqpmt_datelifetime = new clsField("eqpmt_datelifetime", ccsDate, $this->DateFormat);
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->ImageLink1 = new clsField("ImageLink1", ccsText, "");
        

        $this->InsertFields["eqpmt_code"] = array("Name" => "eqpmt_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqpmt_status"] = array("Name" => "eqpmt_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqpmt_name"] = array("Name" => "eqpmt_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqpmt_datelifetime"] = array("Name" => "eqpmt_datelifetime", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqpmt_code"] = array("Name" => "eqpmt_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqpmt_status"] = array("Name" => "eqpmt_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqpmt_name"] = array("Name" => "eqpmt_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqpmt_datelifetime"] = array("Name" => "eqpmt_datelifetime", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @5-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @5-7BE181CA
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

//SetValues Method @5-426485DD
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->eqpmt_code->SetDBValue($this->f("eqpmt_code"));
        $this->eqpmt_status->SetDBValue($this->f("eqpmt_status"));
        $this->eqpmt_name->SetDBValue($this->f("eqpmt_name"));
        $this->eqpmt_datelifetime->SetDBValue(trim($this->f("eqpmt_datelifetime")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

//Insert Method @5-75E93C85
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["eqpmt_code"]["Value"] = $this->eqpmt_code->GetDBValue(true);
        $this->InsertFields["eqpmt_status"]["Value"] = $this->eqpmt_status->GetDBValue(true);
        $this->InsertFields["eqpmt_name"]["Value"] = $this->eqpmt_name->GetDBValue(true);
        $this->InsertFields["eqpmt_datelifetime"]["Value"] = $this->eqpmt_datelifetime->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_equipment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-BCFD7766
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["eqpmt_code"]["Value"] = $this->eqpmt_code->GetDBValue(true);
        $this->UpdateFields["eqpmt_status"]["Value"] = $this->eqpmt_status->GetDBValue(true);
        $this->UpdateFields["eqpmt_name"]["Value"] = $this->eqpmt_name->GetDBValue(true);
        $this->UpdateFields["eqpmt_datelifetime"]["Value"] = $this->eqpmt_datelifetime->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_equipment", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @5-4DAF6994
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_equipment";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End GEquipmentDataSource Class @5-FCB6E20C

class clsEditableGridGToppan { //GToppan Class @25-AC275C8C

//Variables @25-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @25-98928AED
    function clsEditableGridGToppan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GToppan/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GToppan";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGToppanDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->id = & new clsControl(ccsLabel, "id", "Id", ccsInteger, "", NULL, $this);
        $this->eqtop_eqcode = & new clsControl(ccsTextBox, "eqtop_eqcode", "Eqtop Eqcode", ccsText, "", NULL, $this);
        $this->eqtop_eqcode->Required = true;
        $this->eqtop_branch = & new clsControl(ccsTextBox, "eqtop_branch", "Eqtop Branch", ccsText, "", NULL, $this);
        $this->eqtop_branch->Required = true;
        $this->eqtop_toppan = & new clsControl(ccsTextBox, "eqtop_toppan", "Eqtop Toppan", ccsText, "", NULL, $this);
        $this->eqtop_toppan->Required = true;
        $this->eqtop_serialnumber = & new clsControl(ccsTextBox, "eqtop_serialnumber", "Eqtop Serialnumber", ccsText, "", NULL, $this);
        $this->eqtop_serialnumber->Required = true;
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @25-E16C9707
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_branch"] = CCGetFromGet("s_branch", NULL);
        $this->DataSource->Parameters["urltype"] = CCGetFromGet("type", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @25-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @25-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @25-037CEEDB
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["eqtop_eqcode"][$RowNumber] = CCGetFromPost("eqtop_eqcode_" . $RowNumber, NULL);
            $this->FormParameters["eqtop_branch"][$RowNumber] = CCGetFromPost("eqtop_branch_" . $RowNumber, NULL);
            $this->FormParameters["eqtop_toppan"][$RowNumber] = CCGetFromPost("eqtop_toppan_" . $RowNumber, NULL);
            $this->FormParameters["eqtop_serialnumber"][$RowNumber] = CCGetFromPost("eqtop_serialnumber_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @25-6FBD0361
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->eqtop_eqcode->SetText($this->FormParameters["eqtop_eqcode"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_branch->SetText($this->FormParameters["eqtop_branch"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_toppan->SetText($this->FormParameters["eqtop_toppan"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_serialnumber->SetText($this->FormParameters["eqtop_serialnumber"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @25-C76A062C
    function ValidateRow()
    {
        global $CCSLocales;
        $this->eqtop_eqcode->Validate();
        $this->eqtop_branch->Validate();
        $this->eqtop_toppan->Validate();
        $this->eqtop_serialnumber->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->eqtop_eqcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_toppan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->eqtop_eqcode->Errors->Clear();
        $this->eqtop_branch->Errors->Clear();
        $this->eqtop_toppan->Errors->Clear();
        $this->eqtop_serialnumber->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @25-AC003B38
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["eqtop_eqcode"][$this->RowNumber]) && count($this->FormParameters["eqtop_eqcode"][$this->RowNumber])) || strlen($this->FormParameters["eqtop_eqcode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqtop_branch"][$this->RowNumber]) && count($this->FormParameters["eqtop_branch"][$this->RowNumber])) || strlen($this->FormParameters["eqtop_branch"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqtop_toppan"][$this->RowNumber]) && count($this->FormParameters["eqtop_toppan"][$this->RowNumber])) || strlen($this->FormParameters["eqtop_toppan"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["eqtop_serialnumber"][$this->RowNumber]) && count($this->FormParameters["eqtop_serialnumber"][$this->RowNumber])) || strlen($this->FormParameters["eqtop_serialnumber"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @25-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @25-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @25-ED33BDFA
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->eqtop_eqcode->SetText($this->FormParameters["eqtop_eqcode"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_branch->SetText($this->FormParameters["eqtop_branch"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_toppan->SetText($this->FormParameters["eqtop_toppan"][$this->RowNumber], $this->RowNumber);
            $this->eqtop_serialnumber->SetText($this->FormParameters["eqtop_serialnumber"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @25-4B720D13
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->eqtop_eqcode->SetValue($this->eqtop_eqcode->GetValue(true));
        $this->DataSource->eqtop_branch->SetValue($this->eqtop_branch->GetValue(true));
        $this->DataSource->eqtop_toppan->SetValue($this->eqtop_toppan->GetValue(true));
        $this->DataSource->eqtop_serialnumber->SetValue($this->eqtop_serialnumber->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @25-8678D8D1
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->eqtop_eqcode->SetValue($this->eqtop_eqcode->GetValue(true));
        $this->DataSource->eqtop_branch->SetValue($this->eqtop_branch->GetValue(true));
        $this->DataSource->eqtop_toppan->SetValue($this->eqtop_toppan->GetValue(true));
        $this->DataSource->eqtop_serialnumber->SetValue($this->eqtop_serialnumber->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @25-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @25-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @25-0EEA5586
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @25-692238C5
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @25-EC2463A7
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["id"] = $this->id->Visible;
        $this->ControlsVisible["eqtop_eqcode"] = $this->eqtop_eqcode->Visible;
        $this->ControlsVisible["eqtop_branch"] = $this->eqtop_branch->Visible;
        $this->ControlsVisible["eqtop_toppan"] = $this->eqtop_toppan->Visible;
        $this->ControlsVisible["eqtop_serialnumber"] = $this->eqtop_serialnumber->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->eqtop_eqcode->SetValue($this->DataSource->eqtop_eqcode->GetValue());
                    $this->eqtop_branch->SetValue($this->DataSource->eqtop_branch->GetValue());
                    $this->eqtop_toppan->SetValue($this->DataSource->eqtop_toppan->GetValue());
                    $this->eqtop_serialnumber->SetValue($this->DataSource->eqtop_serialnumber->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->id->SetText("");
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->eqtop_eqcode->SetText($this->FormParameters["eqtop_eqcode"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_branch->SetText($this->FormParameters["eqtop_branch"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_toppan->SetText($this->FormParameters["eqtop_toppan"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_serialnumber->SetText($this->FormParameters["eqtop_serialnumber"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->id->SetText("");
                    $this->eqtop_eqcode->SetText("");
                    $this->eqtop_branch->SetText("");
                    $this->eqtop_toppan->SetText("");
                    $this->eqtop_serialnumber->SetText("");
                } else {
                    $this->id->SetText("");
                    $this->eqtop_eqcode->SetText($this->FormParameters["eqtop_eqcode"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_branch->SetText($this->FormParameters["eqtop_branch"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_toppan->SetText($this->FormParameters["eqtop_toppan"][$this->RowNumber], $this->RowNumber);
                    $this->eqtop_serialnumber->SetText($this->FormParameters["eqtop_serialnumber"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show($this->RowNumber);
                $this->eqtop_eqcode->Show($this->RowNumber);
                $this->eqtop_branch->Show($this->RowNumber);
                $this->eqtop_toppan->Show($this->RowNumber);
                $this->eqtop_serialnumber->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["id"] == $this->CachedColumns["id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
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
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End GToppan Class @25-FCB6E20C

class clsGToppanDataSource extends clsDBSMART {  //GToppanDataSource Class @25-3137E935

//DataSource Variables @25-511E5D40
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $id;
    var $eqtop_eqcode;
    var $eqtop_branch;
    var $eqtop_toppan;
    var $eqtop_serialnumber;
    var $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @25-463EF50A
    function clsGToppanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GToppan/Error";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->eqtop_eqcode = new clsField("eqtop_eqcode", ccsText, "");
        
        $this->eqtop_branch = new clsField("eqtop_branch", ccsText, "");
        
        $this->eqtop_toppan = new clsField("eqtop_toppan", ccsText, "");
        
        $this->eqtop_serialnumber = new clsField("eqtop_serialnumber", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["eqtop_eqcode"] = array("Name" => "eqtop_eqcode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqtop_branch"] = array("Name" => "eqtop_branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqtop_toppan"] = array("Name" => "eqtop_toppan", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["eqtop_serialnumber"] = array("Name" => "eqtop_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqtop_eqcode"] = array("Name" => "eqtop_eqcode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqtop_branch"] = array("Name" => "eqtop_branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqtop_toppan"] = array("Name" => "eqtop_toppan", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["eqtop_serialnumber"] = array("Name" => "eqtop_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @25-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @25-ACA51192
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_branch", ccsText, "", "", $this->Parameters["urls_branch"], "", false);
        $this->wp->AddParameter("2", "urltype", ccsText, "", "", $this->Parameters["urltype"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "eqtop_branch", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "eqtop_eqcode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @25-FF91FC8C
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

//SetValues Method @25-91740B70
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->id->SetDBValue(trim($this->f("id")));
        $this->eqtop_eqcode->SetDBValue($this->f("eqtop_eqcode"));
        $this->eqtop_branch->SetDBValue($this->f("eqtop_branch"));
        $this->eqtop_toppan->SetDBValue($this->f("eqtop_toppan"));
        $this->eqtop_serialnumber->SetDBValue($this->f("eqtop_serialnumber"));
    }
//End SetValues Method

//Insert Method @25-275E3610
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["eqtop_eqcode"]["Value"] = $this->eqtop_eqcode->GetDBValue(true);
        $this->InsertFields["eqtop_branch"]["Value"] = $this->eqtop_branch->GetDBValue(true);
        $this->InsertFields["eqtop_toppan"]["Value"] = $this->eqtop_toppan->GetDBValue(true);
        $this->InsertFields["eqtop_serialnumber"]["Value"] = $this->eqtop_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_eqtoppan", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @25-99DEAA03
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["eqtop_eqcode"]["Value"] = $this->eqtop_eqcode->GetDBValue(true);
        $this->UpdateFields["eqtop_branch"]["Value"] = $this->eqtop_branch->GetDBValue(true);
        $this->UpdateFields["eqtop_toppan"]["Value"] = $this->eqtop_toppan->GetDBValue(true);
        $this->UpdateFields["eqtop_serialnumber"]["Value"] = $this->eqtop_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_eqtoppan", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @25-C37650E5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_eqtoppan";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End GToppanDataSource Class @25-FCB6E20C

class clsRecordSToppan { //SToppan Class @26-34203B1F

//Variables @26-D6FF3E86

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

//Class_Initialize Event @26-831FFBAB
    function clsRecordSToppan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SToppan/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SToppan";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->type = & new clsControl(ccsListBox, "type", "type", ccsText, "", CCGetRequestParam("type", $Method, NULL), $this);
            $this->type->DSType = dsTable;
            $this->type->DataSource = new clsDBSMART();
            $this->type->ds = & $this->type->DataSource;
            $this->type->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->type->BoundColumn, $this->type->TextColumn, $this->type->DBFormat) = array("eqpmt_code", "eqpmt_name", "");
            $this->s_branch = & new clsControl(ccsListBox, "s_branch", "s_branch", ccsText, "", CCGetRequestParam("s_branch", $Method, NULL), $this);
            $this->s_branch->DSType = dsTable;
            $this->s_branch->DataSource = new clsDBSMART();
            $this->s_branch->ds = & $this->s_branch->DataSource;
            $this->s_branch->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            list($this->s_branch->BoundColumn, $this->s_branch->TextColumn, $this->s_branch->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_state = & new clsControl(ccsListBox, "s_state", "s_state", ccsText, "", CCGetRequestParam("s_state", $Method, NULL), $this);
            $this->s_state->DSType = dsTable;
            $this->s_state->DataSource = new clsDBSMART();
            $this->s_state->ds = & $this->s_state->DataSource;
            $this->s_state->DataSource->SQL = "SELECT * \n" .
"FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
            $this->s_state->DataSource->Order = "ref_rank";
            list($this->s_state->BoundColumn, $this->s_state->TextColumn, $this->s_state->DBFormat) = array("ref_value", "ref_description", "");
            $this->s_state->DataSource->Parameters["expr45"] = state;
            $this->s_state->DataSource->wp = new clsSQLParameters();
            $this->s_state->DataSource->wp->AddParameter("1", "expr45", ccsText, "", "", $this->s_state->DataSource->Parameters["expr45"], "", false);
            $this->s_state->DataSource->wp->Criterion[1] = $this->s_state->DataSource->wp->Operation(opEqual, "ref_type", $this->s_state->DataSource->wp->GetDBValue("1"), $this->s_state->DataSource->ToSQL($this->s_state->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_state->DataSource->Where = 
                 $this->s_state->DataSource->wp->Criterion[1];
            $this->s_state->DataSource->Order = "ref_rank";
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @26-D71C4901
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->type->Validate() && $Validation);
        $Validation = ($this->s_branch->Validate() && $Validation);
        $Validation = ($this->s_state->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_state->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @26-62E36FE1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->type->Errors->Count());
        $errors = ($errors || $this->s_branch->Errors->Count());
        $errors = ($errors || $this->s_state->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @26-ED598703
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

//Operation Method @26-F80B3A56
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
        $Redirect = "AdmEqMngmt.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AdmEqMngmt.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @26-9464797E
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

        $this->type->Prepare();
        $this->s_branch->Prepare();
        $this->s_state->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_state->Errors->ToString());
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

        $this->type->Show();
        $this->s_branch->Show();
        $this->s_state->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SToppan Class @26-FCB6E20C

//Initialize Page @1-29625593
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
$TemplateFileName = "AdmEqMngmt.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AFBDDBA7
include_once("./AdmEqMngmt_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6E52F468
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$GEquipment = & new clsEditableGridGEquipment("", $MainPage);
$GToppan = & new clsEditableGridGToppan("", $MainPage);
$SToppan = & new clsRecordSToppan("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->GEquipment = & $GEquipment;
$MainPage->GToppan = & $GToppan;
$MainPage->SToppan = & $SToppan;
$GEquipment->Initialize();
$GToppan->Initialize();

BindEvents();

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

//Execute Components @1-327684ED
$header->Operations();
$footer->Operations();
$GEquipment->Operation();
$GToppan->Operation();
$SToppan->Operation();
//End Execute Components

//Go to destination page @1-9A4B5DE0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($GEquipment);
    unset($GToppan);
    unset($SToppan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-327874F8
$header->Show();
$footer->Show();
$GEquipment->Show();
$GToppan->Show();
$SToppan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0CE04CA5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GEquipment);
unset($GToppan);
unset($SToppan);
unset($Tpl);
//End Unload Page


?>
