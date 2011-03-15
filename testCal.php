<?php
//Include Common Files @1-8F352457
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "testCal.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsEditableGridsmart_calendar { //smart_calendar Class @5-473927DE

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

//Class_Initialize Event @5-64F4AD10
    function clsEditableGridsmart_calendar($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid smart_calendar/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "smart_calendar";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clssmart_calendarDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 3;
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
        $this->cal_userid = & new clsControl(ccsTextBox, "cal_userid", "Cal Userid", ccsInteger, "", NULL, $this);
        $this->cal_userid->Required = true;
        $this->cal_type = & new clsControl(ccsTextBox, "cal_type", "Cal Type", ccsText, "", NULL, $this);
        $this->cal_type->Required = true;
        $this->cal_description = & new clsControl(ccsTextArea, "cal_description", "Cal Description", ccsMemo, "", NULL, $this);
        $this->cal_description->Required = true;
        $this->cal_datefrom = & new clsControl(ccsTextBox, "cal_datefrom", "Cal Datefrom", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->DatePicker_cal_datefrom = & new clsDatePicker("DatePicker_cal_datefrom", "smart_calendar", "cal_datefrom", $this);
        $this->cal_dateto = & new clsControl(ccsTextBox, "cal_dateto", "Cal Dateto", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->DatePicker_cal_dateto = & new clsDatePicker("DatePicker_cal_dateto", "smart_calendar", "cal_dateto", $this);
        $this->datemodified = & new clsControl(ccsTextBox, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->DatePicker_datemodified = & new clsDatePicker("DatePicker_datemodified", "smart_calendar", "datemodified", $this);
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
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

//GetFormParameters Method @5-8A24D17B
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["cal_userid"][$RowNumber] = CCGetFromPost("cal_userid_" . $RowNumber, NULL);
            $this->FormParameters["cal_type"][$RowNumber] = CCGetFromPost("cal_type_" . $RowNumber, NULL);
            $this->FormParameters["cal_description"][$RowNumber] = CCGetFromPost("cal_description_" . $RowNumber, NULL);
            $this->FormParameters["cal_datefrom"][$RowNumber] = CCGetFromPost("cal_datefrom_" . $RowNumber, NULL);
            $this->FormParameters["cal_dateto"][$RowNumber] = CCGetFromPost("cal_dateto_" . $RowNumber, NULL);
            $this->FormParameters["datemodified"][$RowNumber] = CCGetFromPost("datemodified_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @5-8C4EB8B5
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cal_userid->SetText($this->FormParameters["cal_userid"][$this->RowNumber], $this->RowNumber);
            $this->cal_type->SetText($this->FormParameters["cal_type"][$this->RowNumber], $this->RowNumber);
            $this->cal_description->SetText($this->FormParameters["cal_description"][$this->RowNumber], $this->RowNumber);
            $this->cal_datefrom->SetText($this->FormParameters["cal_datefrom"][$this->RowNumber], $this->RowNumber);
            $this->cal_dateto->SetText($this->FormParameters["cal_dateto"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @5-614A51E2
    function ValidateRow()
    {
        global $CCSLocales;
        $this->cal_userid->Validate();
        $this->cal_type->Validate();
        $this->cal_description->Validate();
        $this->cal_datefrom->Validate();
        $this->cal_dateto->Validate();
        $this->datemodified->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->cal_userid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_datefrom->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_dateto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->cal_userid->Errors->Clear();
        $this->cal_type->Errors->Clear();
        $this->cal_description->Errors->Clear();
        $this->cal_datefrom->Errors->Clear();
        $this->cal_dateto->Errors->Clear();
        $this->datemodified->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @5-74BF3E43
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["cal_userid"][$this->RowNumber]) && count($this->FormParameters["cal_userid"][$this->RowNumber])) || strlen($this->FormParameters["cal_userid"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cal_type"][$this->RowNumber]) && count($this->FormParameters["cal_type"][$this->RowNumber])) || strlen($this->FormParameters["cal_type"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cal_description"][$this->RowNumber]) && count($this->FormParameters["cal_description"][$this->RowNumber])) || strlen($this->FormParameters["cal_description"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cal_datefrom"][$this->RowNumber]) && count($this->FormParameters["cal_datefrom"][$this->RowNumber])) || strlen($this->FormParameters["cal_datefrom"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cal_dateto"][$this->RowNumber]) && count($this->FormParameters["cal_dateto"][$this->RowNumber])) || strlen($this->FormParameters["cal_dateto"][$this->RowNumber]));
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

//UpdateGrid Method @5-CB3AD202
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cal_userid->SetText($this->FormParameters["cal_userid"][$this->RowNumber], $this->RowNumber);
            $this->cal_type->SetText($this->FormParameters["cal_type"][$this->RowNumber], $this->RowNumber);
            $this->cal_description->SetText($this->FormParameters["cal_description"][$this->RowNumber], $this->RowNumber);
            $this->cal_datefrom->SetText($this->FormParameters["cal_datefrom"][$this->RowNumber], $this->RowNumber);
            $this->cal_dateto->SetText($this->FormParameters["cal_dateto"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @5-E7F6E95E
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->cal_userid->SetValue($this->cal_userid->GetValue(true));
        $this->DataSource->cal_type->SetValue($this->cal_type->GetValue(true));
        $this->DataSource->cal_description->SetValue($this->cal_description->GetValue(true));
        $this->DataSource->cal_datefrom->SetValue($this->cal_datefrom->GetValue(true));
        $this->DataSource->cal_dateto->SetValue($this->cal_dateto->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
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

//UpdateRow Method @5-5E62817A
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->cal_userid->SetValue($this->cal_userid->GetValue(true));
        $this->DataSource->cal_type->SetValue($this->cal_type->GetValue(true));
        $this->DataSource->cal_description->SetValue($this->cal_description->GetValue(true));
        $this->DataSource->cal_datefrom->SetValue($this->cal_datefrom->GetValue(true));
        $this->DataSource->cal_dateto->SetValue($this->cal_dateto->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
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

//Show Method @5-A42CA2BE
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
        $this->ControlsVisible["cal_userid"] = $this->cal_userid->Visible;
        $this->ControlsVisible["cal_type"] = $this->cal_type->Visible;
        $this->ControlsVisible["cal_description"] = $this->cal_description->Visible;
        $this->ControlsVisible["cal_datefrom"] = $this->cal_datefrom->Visible;
        $this->ControlsVisible["DatePicker_cal_datefrom"] = $this->DatePicker_cal_datefrom->Visible;
        $this->ControlsVisible["cal_dateto"] = $this->cal_dateto->Visible;
        $this->ControlsVisible["DatePicker_cal_dateto"] = $this->DatePicker_cal_dateto->Visible;
        $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
        $this->ControlsVisible["DatePicker_datemodified"] = $this->DatePicker_datemodified->Visible;
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
                    $this->cal_userid->SetValue($this->DataSource->cal_userid->GetValue());
                    $this->cal_type->SetValue($this->DataSource->cal_type->GetValue());
                    $this->cal_description->SetValue($this->DataSource->cal_description->GetValue());
                    $this->cal_datefrom->SetValue($this->DataSource->cal_datefrom->GetValue());
                    $this->cal_dateto->SetValue($this->DataSource->cal_dateto->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->id->SetText("");
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->cal_userid->SetText($this->FormParameters["cal_userid"][$this->RowNumber], $this->RowNumber);
                    $this->cal_type->SetText($this->FormParameters["cal_type"][$this->RowNumber], $this->RowNumber);
                    $this->cal_description->SetText($this->FormParameters["cal_description"][$this->RowNumber], $this->RowNumber);
                    $this->cal_datefrom->SetText($this->FormParameters["cal_datefrom"][$this->RowNumber], $this->RowNumber);
                    $this->cal_dateto->SetText($this->FormParameters["cal_dateto"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->id->SetText("");
                    $this->cal_userid->SetText("");
                    $this->cal_type->SetText("");
                    $this->cal_description->SetText("");
                    $this->cal_datefrom->SetText("");
                    $this->cal_dateto->SetText("");
                    $this->datemodified->SetText("");
                } else {
                    $this->id->SetText("");
                    $this->cal_userid->SetText($this->FormParameters["cal_userid"][$this->RowNumber], $this->RowNumber);
                    $this->cal_type->SetText($this->FormParameters["cal_type"][$this->RowNumber], $this->RowNumber);
                    $this->cal_description->SetText($this->FormParameters["cal_description"][$this->RowNumber], $this->RowNumber);
                    $this->cal_datefrom->SetText($this->FormParameters["cal_datefrom"][$this->RowNumber], $this->RowNumber);
                    $this->cal_dateto->SetText($this->FormParameters["cal_dateto"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show($this->RowNumber);
                $this->cal_userid->Show($this->RowNumber);
                $this->cal_type->Show($this->RowNumber);
                $this->cal_description->Show($this->RowNumber);
                $this->cal_datefrom->Show($this->RowNumber);
                $this->DatePicker_cal_datefrom->Show($this->RowNumber);
                $this->cal_dateto->Show($this->RowNumber);
                $this->DatePicker_cal_dateto->Show($this->RowNumber);
                $this->datemodified->Show($this->RowNumber);
                $this->DatePicker_datemodified->Show($this->RowNumber);
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

} //End smart_calendar Class @5-FCB6E20C

class clssmart_calendarDataSource extends clsDBSMART {  //smart_calendarDataSource Class @5-2432BA35

//DataSource Variables @5-285E9802
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
    var $cal_userid;
    var $cal_type;
    var $cal_description;
    var $cal_datefrom;
    var $cal_dateto;
    var $datemodified;
    var $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-7378625B
    function clssmart_calendarDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid smart_calendar/Error";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->cal_userid = new clsField("cal_userid", ccsInteger, "");
        
        $this->cal_type = new clsField("cal_type", ccsText, "");
        
        $this->cal_description = new clsField("cal_description", ccsMemo, "");
        
        $this->cal_datefrom = new clsField("cal_datefrom", ccsDate, $this->DateFormat);
        
        $this->cal_dateto = new clsField("cal_dateto", ccsDate, $this->DateFormat);
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["cal_userid"] = array("Name" => "cal_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_type"] = array("Name" => "cal_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_description"] = array("Name" => "cal_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_datefrom"] = array("Name" => "cal_datefrom", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["cal_dateto"] = array("Name" => "cal_dateto", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_userid"] = array("Name" => "cal_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_type"] = array("Name" => "cal_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_description"] = array("Name" => "cal_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_datefrom"] = array("Name" => "cal_datefrom", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["cal_dateto"] = array("Name" => "cal_dateto", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
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

//Open Method @5-B241103C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_calendar";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_calendar {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-37712B12
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->id->SetDBValue(trim($this->f("id")));
        $this->cal_userid->SetDBValue(trim($this->f("cal_userid")));
        $this->cal_type->SetDBValue($this->f("cal_type"));
        $this->cal_description->SetDBValue($this->f("cal_description"));
        $this->cal_datefrom->SetDBValue(trim($this->f("cal_datefrom")));
        $this->cal_dateto->SetDBValue(trim($this->f("cal_dateto")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

//Insert Method @5-276BE3EC
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["cal_userid"]["Value"] = $this->cal_userid->GetDBValue(true);
        $this->InsertFields["cal_type"]["Value"] = $this->cal_type->GetDBValue(true);
        $this->InsertFields["cal_description"]["Value"] = $this->cal_description->GetDBValue(true);
        $this->InsertFields["cal_datefrom"]["Value"] = $this->cal_datefrom->GetDBValue(true);
        $this->InsertFields["cal_dateto"]["Value"] = $this->cal_dateto->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_calendar", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-2796036A
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["cal_userid"]["Value"] = $this->cal_userid->GetDBValue(true);
        $this->UpdateFields["cal_type"]["Value"] = $this->cal_type->GetDBValue(true);
        $this->UpdateFields["cal_description"]["Value"] = $this->cal_description->GetDBValue(true);
        $this->UpdateFields["cal_datefrom"]["Value"] = $this->cal_datefrom->GetDBValue(true);
        $this->UpdateFields["cal_dateto"]["Value"] = $this->cal_dateto->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_calendar", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @5-08A38EB4
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_calendar";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End smart_calendarDataSource Class @5-FCB6E20C

//Initialize Page @1-FE672D20
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
$TemplateFileName = "testCal.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DB953960
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_calendar = & new clsEditableGridsmart_calendar("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_calendar = & $smart_calendar;
$smart_calendar->Initialize();

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

//Execute Components @1-FF1B867A
$header->Operations();
$footer->Operations();
$smart_calendar->Operation();
//End Execute Components

//Go to destination page @1-1C2FE73F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_calendar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-12A3C64C
$header->Show();
$footer->Show();
$smart_calendar->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C697E136
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_calendar);
unset($Tpl);
//End Unload Page


?>
