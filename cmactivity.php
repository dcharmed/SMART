<?php
//Include Common Files @1-3EB3478F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cmactivity.php");
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

class clsEditableGridGEquipment { //GEquipment Class @221-4383410B

//Variables @221-F667987F

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

//Class_Initialize Event @221-DCDDBA75
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
            $this->PageSize = 50;
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

        $this->equipment_id = & new clsControl(ccsListBox, "equipment_id", "Equipment", ccsText, "", NULL, $this);
        $this->equipment_id->DSType = dsTable;
        $this->equipment_id->DataSource = new clsDBSMART();
        $this->equipment_id->ds = & $this->equipment_id->DataSource;
        $this->equipment_id->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
        list($this->equipment_id->BoundColumn, $this->equipment_id->TextColumn, $this->equipment_id->DBFormat) = array("eqpmt_code", "eqpmt_name", "");
        $this->equipment_id->Required = true;
        $this->flty_serialnumber = & new clsControl(ccsTextBox, "flty_serialnumber", "Serial Number", ccsText, "", NULL, $this);
        $this->flty_serialnumber->Required = true;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsText, "", NULL, $this);
        $this->id = & new clsControl(ccsHidden, "id", "Id", ccsInteger, "", NULL, $this);
        $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @221-6AA5FC33
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @221-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @221-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @221-2007276F
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["equipment_id"][$RowNumber] = CCGetFromPost("equipment_id_" . $RowNumber, NULL);
            $this->FormParameters["flty_serialnumber"][$RowNumber] = CCGetFromPost("flty_serialnumber_" . $RowNumber, NULL);
            $this->FormParameters["resolution_id"][$RowNumber] = CCGetFromPost("resolution_id_" . $RowNumber, NULL);
            $this->FormParameters["id"][$RowNumber] = CCGetFromPost("id_" . $RowNumber, NULL);
            $this->FormParameters["datemodified"][$RowNumber] = CCGetFromPost("datemodified_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @221-D520A9F6
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->equipment_id->SetText($this->FormParameters["equipment_id"][$this->RowNumber], $this->RowNumber);
            $this->flty_serialnumber->SetText($this->FormParameters["flty_serialnumber"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
            $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @221-EAA3C745
    function ValidateRow()
    {
        global $CCSLocales;
        $this->equipment_id->Validate();
        $this->flty_serialnumber->Validate();
        $this->resolution_id->Validate();
        $this->id->Validate();
        $this->datemodified->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->equipment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->flty_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resolution_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $this->equipment_id->Errors->Clear();
        $this->flty_serialnumber->Errors->Clear();
        $this->resolution_id->Errors->Clear();
        $this->id->Errors->Clear();
        $this->datemodified->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @221-C415CBDD
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["equipment_id"][$this->RowNumber]) && count($this->FormParameters["equipment_id"][$this->RowNumber])) || strlen($this->FormParameters["equipment_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["flty_serialnumber"][$this->RowNumber]) && count($this->FormParameters["flty_serialnumber"][$this->RowNumber])) || strlen($this->FormParameters["flty_serialnumber"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["resolution_id"][$this->RowNumber]) && count($this->FormParameters["resolution_id"][$this->RowNumber])) || strlen($this->FormParameters["resolution_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["id"][$this->RowNumber]) && count($this->FormParameters["id"][$this->RowNumber])) || strlen($this->FormParameters["id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["datemodified"][$this->RowNumber]) && count($this->FormParameters["datemodified"][$this->RowNumber])) || strlen($this->FormParameters["datemodified"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @221-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @221-6B923CC2
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

//UpdateGrid Method @221-3E267069
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->equipment_id->SetText($this->FormParameters["equipment_id"][$this->RowNumber], $this->RowNumber);
            $this->flty_serialnumber->SetText($this->FormParameters["flty_serialnumber"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
            $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
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

//InsertRow Method @221-1DBEA9CD
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->equipment_id->SetValue($this->equipment_id->GetValue(true));
        $this->DataSource->flty_serialnumber->SetValue($this->flty_serialnumber->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->id->SetValue($this->id->GetValue(true));
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

//UpdateRow Method @221-D0B47C0F
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->equipment_id->SetValue($this->equipment_id->GetValue(true));
        $this->DataSource->flty_serialnumber->SetValue($this->flty_serialnumber->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->id->SetValue($this->id->GetValue(true));
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

//FormScript Method @221-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @221-0EEA5586
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

//GetFormState Method @221-692238C5
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

//Show Method @221-8A9CF190
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->equipment_id->Prepare();

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
        $this->ControlsVisible["equipment_id"] = $this->equipment_id->Visible;
        $this->ControlsVisible["flty_serialnumber"] = $this->flty_serialnumber->Visible;
        $this->ControlsVisible["resolution_id"] = $this->resolution_id->Visible;
        $this->ControlsVisible["id"] = $this->id->Visible;
        $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->equipment_id->SetValue($this->DataSource->equipment_id->GetValue());
                    $this->flty_serialnumber->SetValue($this->DataSource->flty_serialnumber->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->equipment_id->SetText($this->FormParameters["equipment_id"][$this->RowNumber], $this->RowNumber);
                    $this->flty_serialnumber->SetText($this->FormParameters["flty_serialnumber"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->equipment_id->SetText("");
                    $this->flty_serialnumber->SetText("");
                    $this->resolution_id->SetText("");
                    $this->id->SetText("");
                    $this->datemodified->SetText("");
                } else {
                    $this->equipment_id->SetText($this->FormParameters["equipment_id"][$this->RowNumber], $this->RowNumber);
                    $this->flty_serialnumber->SetText($this->FormParameters["flty_serialnumber"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->equipment_id->Show($this->RowNumber);
                $this->flty_serialnumber->Show($this->RowNumber);
                $this->resolution_id->Show($this->RowNumber);
                $this->id->Show($this->RowNumber);
                $this->datemodified->Show($this->RowNumber);
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

} //End GEquipment Class @221-FCB6E20C

class clsGEquipmentDataSource extends clsDBSMART {  //GEquipmentDataSource Class @221-C92BBA43

//DataSource Variables @221-B4077E5D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $equipment_id;
    var $flty_serialnumber;
    var $resolution_id;
    var $id;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @221-351B7C5D
    function clsGEquipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GEquipment/Error";
        $this->Initialize();
        $this->equipment_id = new clsField("equipment_id", ccsText, "");
        
        $this->flty_serialnumber = new clsField("flty_serialnumber", ccsText, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        

        $this->InsertFields["equipment_id"] = array("Name" => "equipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["equipment_id"] = array("Name" => "equipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @221-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @221-919E7AF8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsText, "", "", $this->Parameters["urlrid"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @221-3D546EF6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_faultyequipment";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_faultyequipment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @221-BF01A3C0
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->equipment_id->SetDBValue($this->f("equipment_id"));
        $this->flty_serialnumber->SetDBValue($this->f("flty_serialnumber"));
        $this->resolution_id->SetDBValue($this->f("resolution_id"));
        $this->id->SetDBValue(trim($this->f("id")));
        $this->datemodified->SetDBValue($this->f("datemodified"));
    }
//End SetValues Method

//Insert Method @221-35CCA81E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["equipment_id"]["Value"] = $this->equipment_id->GetDBValue(true);
        $this->InsertFields["flty_serialnumber"]["Value"] = $this->flty_serialnumber->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_faultyequipment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @221-C7E4658F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["equipment_id"]["Value"] = $this->equipment_id->GetDBValue(true);
        $this->UpdateFields["flty_serialnumber"]["Value"] = $this->flty_serialnumber->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_faultyequipment", $this->UpdateFields, $this);
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

} //End GEquipmentDataSource Class @221-FCB6E20C

class clsRecordsmart_resolution { //smart_resolution Class @12-51340C24

//Variables @12-D6FF3E86

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

//Class_Initialize Event @12-30CA31D2
    function clsRecordsmart_resolution($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_resolution/Error";
        $this->DataSource = new clssmart_resolutionDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_resolution";
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
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->ticket_id = & new clsControl(ccsHidden, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->rsltn_date = & new clsControl(ccsTextBox, "rsltn_date", "Date", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_date", $Method, NULL), $this);
            $this->rsltn_engineer = & new clsControl(ccsListBox, "rsltn_engineer", "Engineer", ccsInteger, "", CCGetRequestParam("rsltn_engineer", $Method, NULL), $this);
            $this->rsltn_engineer->DSType = dsTable;
            $this->rsltn_engineer->DataSource = new clsDBSMART();
            $this->rsltn_engineer->ds = & $this->rsltn_engineer->DataSource;
            $this->rsltn_engineer->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->rsltn_engineer->BoundColumn, $this->rsltn_engineer->TextColumn, $this->rsltn_engineer->DBFormat) = array("id", "usr_username", "");
            $this->rsltn_engineer->DataSource->Parameters["expr47"] = 3;
            $this->rsltn_engineer->DataSource->Parameters["expr267"] = 1;
            $this->rsltn_engineer->DataSource->wp = new clsSQLParameters();
            $this->rsltn_engineer->DataSource->wp->AddParameter("1", "expr47", ccsInteger, "", "", $this->rsltn_engineer->DataSource->Parameters["expr47"], "", false);
            $this->rsltn_engineer->DataSource->wp->AddParameter("2", "expr267", ccsInteger, "", "", $this->rsltn_engineer->DataSource->Parameters["expr267"], "", false);
            $this->rsltn_engineer->DataSource->wp->Criterion[1] = $this->rsltn_engineer->DataSource->wp->Operation(opEqual, "usr_group", $this->rsltn_engineer->DataSource->wp->GetDBValue("1"), $this->rsltn_engineer->DataSource->ToSQL($this->rsltn_engineer->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->rsltn_engineer->DataSource->wp->Criterion[2] = $this->rsltn_engineer->DataSource->wp->Operation(opEqual, "usr_status", $this->rsltn_engineer->DataSource->wp->GetDBValue("2"), $this->rsltn_engineer->DataSource->ToSQL($this->rsltn_engineer->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->rsltn_engineer->DataSource->Where = $this->rsltn_engineer->DataSource->wp->opAND(
                 false, 
                 $this->rsltn_engineer->DataSource->wp->Criterion[1], 
                 $this->rsltn_engineer->DataSource->wp->Criterion[2]);
            $this->rsltn_engineer->Required = true;
            $this->rsltn_servicedate = & new clsControl(ccsTextBox, "rsltn_servicedate", "Service Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("rsltn_servicedate", $Method, NULL), $this);
            $this->rsltn_servicedate->Required = true;
            $this->DatePicker_rslt_servicedate = & new clsDatePicker("DatePicker_rslt_servicedate", "smart_resolution", "rsltn_servicedate", $this);
            $this->rsltn_serviceno = & new clsControl(ccsTextBox, "rsltn_serviceno", "Service No.", ccsText, "", CCGetRequestParam("rsltn_serviceno", $Method, NULL), $this);
            $this->rsltn_serviceno->Required = true;
            $this->rsltn_eta = & new clsControl(ccsTextBox, "rsltn_eta", "ETA", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_eta", $Method, NULL), $this);
            $this->rsltn_etd = & new clsControl(ccsTextBox, "rsltn_etd", "ETD", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_etd", $Method, NULL), $this);
            $this->ticketNumber = & new clsControl(ccsLabel, "ticketNumber", "ticketNumber", ccsText, "", CCGetRequestParam("ticketNumber", $Method, NULL), $this);
            $this->site = & new clsControl(ccsLabel, "site", "site", ccsText, "", CCGetRequestParam("site", $Method, NULL), $this);
            $this->ticketToppanid = & new clsControl(ccsTextBox, "ticketToppanid", "Toppan ID", ccsText, "", CCGetRequestParam("ticketToppanid", $Method, NULL), $this);
            $this->ticketRelated = & new clsControl(ccsTextBox, "ticketRelated", "Tag Related", ccsText, "", CCGetRequestParam("ticketRelated", $Method, NULL), $this);
            $this->rsltn_inspection = & new clsControl(ccsTextArea, "rsltn_inspection", "Inspection", ccsMemo, "", CCGetRequestParam("rsltn_inspection", $Method, NULL), $this);
            $this->rsltn_inspection->Required = true;
            $this->rsltn_action = & new clsControl(ccsTextArea, "rsltn_action", "Action", ccsMemo, "", CCGetRequestParam("rsltn_action", $Method, NULL), $this);
            $this->rsltn_action->Required = true;
            $this->rsltn_planning = & new clsControl(ccsTextArea, "rsltn_planning", "Rslt Planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", $Method, NULL), $this);
            $this->rsltn_remark = & new clsControl(ccsTextArea, "rsltn_remark", "Rslt Remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", $Method, NULL), $this);
            $this->rsltnId = & new clsControl(ccsLabel, "rsltnId", "rsltnId", ccsText, "", CCGetRequestParam("rsltnId", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->rsltn_datetosave = & new clsControl(ccsHidden, "rsltn_datetosave", "rsltn_datetosave", ccsDate, array("GeneralDate"), CCGetRequestParam("rsltn_datetosave", $Method, NULL), $this);
            $this->rsltn_customer = & new clsControl(ccsTextBox, "rsltn_customer", "rsltn_customer", ccsText, "", CCGetRequestParam("rsltn_customer", $Method, NULL), $this);
            $this->rsltn_actionmethod = & new clsControl(ccsHidden, "rsltn_actionmethod", "Method", ccsText, "", CCGetRequestParam("rsltn_actionmethod", $Method, NULL), $this);
            $this->rsltn_actionmethod->HTML = true;
            $this->rsltn_type = & new clsControl(ccsHidden, "rsltn_type", "rsltn_type", ccsText, "", CCGetRequestParam("rsltn_type", $Method, NULL), $this);
            $this->rsltn_contact = & new clsControl(ccsTextBox, "rsltn_contact", "rsltn_contact", ccsText, "", CCGetRequestParam("rsltn_contact", $Method, NULL), $this);
            $this->rsltn_contact2 = & new clsControl(ccsTextBox, "rsltn_contact2", "rsltn_contact2", ccsText, "", CCGetRequestParam("rsltn_contact2", $Method, NULL), $this);
            $this->rsltn_counter = & new clsControl(ccsTextBox, "rsltn_counter", "rsltn_counter", ccsText, "", CCGetRequestParam("rsltn_counter", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->rsltn_date->Value) && !strlen($this->rsltn_date->Value) && $this->rsltn_date->Value !== false)
                    $this->rsltn_date->SetValue(time());
                if(!is_array($this->rsltn_datetosave->Value) && !strlen($this->rsltn_datetosave->Value) && $this->rsltn_datetosave->Value !== false)
                    $this->rsltn_datetosave->SetValue(time());
                if(!is_array($this->rsltn_actionmethod->Value) && !strlen($this->rsltn_actionmethod->Value) && $this->rsltn_actionmethod->Value !== false)
                    $this->rsltn_actionmethod->SetText(3);
                if(!is_array($this->rsltn_type->Value) && !strlen($this->rsltn_type->Value) && $this->rsltn_type->Value !== false)
                    $this->rsltn_type->SetText(CM);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @12-C9214409
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
    }
//End Initialize Method

//Validate Method @12-B61F16C9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->rsltn_date->Validate() && $Validation);
        $Validation = ($this->rsltn_engineer->Validate() && $Validation);
        $Validation = ($this->rsltn_servicedate->Validate() && $Validation);
        $Validation = ($this->rsltn_serviceno->Validate() && $Validation);
        $Validation = ($this->rsltn_eta->Validate() && $Validation);
        $Validation = ($this->rsltn_etd->Validate() && $Validation);
        $Validation = ($this->ticketToppanid->Validate() && $Validation);
        $Validation = ($this->ticketRelated->Validate() && $Validation);
        $Validation = ($this->rsltn_inspection->Validate() && $Validation);
        $Validation = ($this->rsltn_action->Validate() && $Validation);
        $Validation = ($this->rsltn_planning->Validate() && $Validation);
        $Validation = ($this->rsltn_remark->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->rsltn_datetosave->Validate() && $Validation);
        $Validation = ($this->rsltn_customer->Validate() && $Validation);
        $Validation = ($this->rsltn_actionmethod->Validate() && $Validation);
        $Validation = ($this->rsltn_type->Validate() && $Validation);
        $Validation = ($this->rsltn_contact->Validate() && $Validation);
        $Validation = ($this->rsltn_contact2->Validate() && $Validation);
        $Validation = ($this->rsltn_counter->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_engineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_servicedate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_serviceno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_eta->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_etd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticketToppanid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ticketRelated->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_inspection->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_action->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_planning->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_datetosave->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_customer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_actionmethod->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_contact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_contact2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_counter->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @12-849B349D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->rsltn_engineer->Errors->Count());
        $errors = ($errors || $this->rsltn_servicedate->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_servicedate->Errors->Count());
        $errors = ($errors || $this->rsltn_serviceno->Errors->Count());
        $errors = ($errors || $this->rsltn_eta->Errors->Count());
        $errors = ($errors || $this->rsltn_etd->Errors->Count());
        $errors = ($errors || $this->ticketNumber->Errors->Count());
        $errors = ($errors || $this->site->Errors->Count());
        $errors = ($errors || $this->ticketToppanid->Errors->Count());
        $errors = ($errors || $this->ticketRelated->Errors->Count());
        $errors = ($errors || $this->rsltn_inspection->Errors->Count());
        $errors = ($errors || $this->rsltn_action->Errors->Count());
        $errors = ($errors || $this->rsltn_planning->Errors->Count());
        $errors = ($errors || $this->rsltn_remark->Errors->Count());
        $errors = ($errors || $this->rsltnId->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->rsltn_datetosave->Errors->Count());
        $errors = ($errors || $this->rsltn_customer->Errors->Count());
        $errors = ($errors || $this->rsltn_actionmethod->Errors->Count());
        $errors = ($errors || $this->rsltn_type->Errors->Count());
        $errors = ($errors || $this->rsltn_contact->Errors->Count());
        $errors = ($errors || $this->rsltn_contact2->Errors->Count());
        $errors = ($errors || $this->rsltn_counter->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @12-ED598703
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

//Operation Method @12-0BF2B389
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
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
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @12-617EF978
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->rsltn_engineer->SetValue($this->rsltn_engineer->GetValue(true));
        $this->DataSource->rsltn_servicedate->SetValue($this->rsltn_servicedate->GetValue(true));
        $this->DataSource->rsltn_serviceno->SetValue($this->rsltn_serviceno->GetValue(true));
        $this->DataSource->rsltn_eta->SetValue($this->rsltn_eta->GetValue(true));
        $this->DataSource->rsltn_etd->SetValue($this->rsltn_etd->GetValue(true));
        $this->DataSource->ticketNumber->SetValue($this->ticketNumber->GetValue(true));
        $this->DataSource->site->SetValue($this->site->GetValue(true));
        $this->DataSource->ticketToppanid->SetValue($this->ticketToppanid->GetValue(true));
        $this->DataSource->ticketRelated->SetValue($this->ticketRelated->GetValue(true));
        $this->DataSource->rsltn_inspection->SetValue($this->rsltn_inspection->GetValue(true));
        $this->DataSource->rsltn_action->SetValue($this->rsltn_action->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->rsltnId->SetValue($this->rsltnId->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rsltn_datetosave->SetValue($this->rsltn_datetosave->GetValue(true));
        $this->DataSource->rsltn_customer->SetValue($this->rsltn_customer->GetValue(true));
        $this->DataSource->rsltn_actionmethod->SetValue($this->rsltn_actionmethod->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->rsltn_contact->SetValue($this->rsltn_contact->GetValue(true));
        $this->DataSource->rsltn_contact2->SetValue($this->rsltn_contact2->GetValue(true));
        $this->DataSource->rsltn_counter->SetValue($this->rsltn_counter->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @12-6AB61B7E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rsltn_date->SetValue($this->rsltn_date->GetValue(true));
        $this->DataSource->rsltn_engineer->SetValue($this->rsltn_engineer->GetValue(true));
        $this->DataSource->rsltn_servicedate->SetValue($this->rsltn_servicedate->GetValue(true));
        $this->DataSource->rsltn_serviceno->SetValue($this->rsltn_serviceno->GetValue(true));
        $this->DataSource->rsltn_eta->SetValue($this->rsltn_eta->GetValue(true));
        $this->DataSource->rsltn_etd->SetValue($this->rsltn_etd->GetValue(true));
        $this->DataSource->ticketNumber->SetValue($this->ticketNumber->GetValue(true));
        $this->DataSource->site->SetValue($this->site->GetValue(true));
        $this->DataSource->ticketToppanid->SetValue($this->ticketToppanid->GetValue(true));
        $this->DataSource->ticketRelated->SetValue($this->ticketRelated->GetValue(true));
        $this->DataSource->rsltn_inspection->SetValue($this->rsltn_inspection->GetValue(true));
        $this->DataSource->rsltn_action->SetValue($this->rsltn_action->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->rsltnId->SetValue($this->rsltnId->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rsltn_datetosave->SetValue($this->rsltn_datetosave->GetValue(true));
        $this->DataSource->rsltn_customer->SetValue($this->rsltn_customer->GetValue(true));
        $this->DataSource->rsltn_actionmethod->SetValue($this->rsltn_actionmethod->GetValue(true));
        $this->DataSource->rsltn_type->SetValue($this->rsltn_type->GetValue(true));
        $this->DataSource->rsltn_contact->SetValue($this->rsltn_contact->GetValue(true));
        $this->DataSource->rsltn_contact2->SetValue($this->rsltn_contact2->GetValue(true));
        $this->DataSource->rsltn_counter->SetValue($this->rsltn_counter->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @12-071AC90A
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

        $this->rsltn_engineer->Prepare();

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
                $this->rsltnId->SetValue($this->DataSource->rsltnId->GetValue());
                if(!$this->FormSubmitted){
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->rsltn_engineer->SetValue($this->DataSource->rsltn_engineer->GetValue());
                    $this->rsltn_servicedate->SetValue($this->DataSource->rsltn_servicedate->GetValue());
                    $this->rsltn_serviceno->SetValue($this->DataSource->rsltn_serviceno->GetValue());
                    $this->rsltn_eta->SetValue($this->DataSource->rsltn_eta->GetValue());
                    $this->rsltn_etd->SetValue($this->DataSource->rsltn_etd->GetValue());
                    $this->rsltn_inspection->SetValue($this->DataSource->rsltn_inspection->GetValue());
                    $this->rsltn_action->SetValue($this->DataSource->rsltn_action->GetValue());
                    $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                    $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->rsltn_datetosave->SetValue($this->DataSource->rsltn_datetosave->GetValue());
                    $this->rsltn_actionmethod->SetValue($this->DataSource->rsltn_actionmethod->GetValue());
                    $this->rsltn_type->SetValue($this->DataSource->rsltn_type->GetValue());
                    $this->rsltn_counter->SetValue($this->DataSource->rsltn_counter->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_serviceno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_eta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_etd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketToppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketRelated->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_inspection->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltnId->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_datetosave->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_customer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_actionmethod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_contact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_contact2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_counter->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->ticket_id->Show();
        $this->rsltn_date->Show();
        $this->rsltn_engineer->Show();
        $this->rsltn_servicedate->Show();
        $this->DatePicker_rslt_servicedate->Show();
        $this->rsltn_serviceno->Show();
        $this->rsltn_eta->Show();
        $this->rsltn_etd->Show();
        $this->ticketNumber->Show();
        $this->site->Show();
        $this->ticketToppanid->Show();
        $this->ticketRelated->Show();
        $this->rsltn_inspection->Show();
        $this->rsltn_action->Show();
        $this->rsltn_planning->Show();
        $this->rsltn_remark->Show();
        $this->rsltnId->Show();
        $this->datemodified->Show();
        $this->rsltn_datetosave->Show();
        $this->rsltn_customer->Show();
        $this->rsltn_actionmethod->Show();
        $this->rsltn_type->Show();
        $this->rsltn_contact->Show();
        $this->rsltn_contact2->Show();
        $this->rsltn_counter->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_resolution Class @12-FCB6E20C

class clssmart_resolutionDataSource extends clsDBSMART {  //smart_resolutionDataSource Class @12-0ED180B1

//DataSource Variables @12-058AB174
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $ticket_id;
    var $rsltn_date;
    var $rsltn_engineer;
    var $rsltn_servicedate;
    var $rsltn_serviceno;
    var $rsltn_eta;
    var $rsltn_etd;
    var $ticketNumber;
    var $site;
    var $ticketToppanid;
    var $ticketRelated;
    var $rsltn_inspection;
    var $rsltn_action;
    var $rsltn_planning;
    var $rsltn_remark;
    var $rsltnId;
    var $datemodified;
    var $rsltn_datetosave;
    var $rsltn_customer;
    var $rsltn_actionmethod;
    var $rsltn_type;
    var $rsltn_contact;
    var $rsltn_contact2;
    var $rsltn_counter;
//End DataSource Variables

//DataSourceClass_Initialize Event @12-C4559328
    function clssmart_resolutionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_resolution/Error";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_engineer = new clsField("rsltn_engineer", ccsInteger, "");
        
        $this->rsltn_servicedate = new clsField("rsltn_servicedate", ccsDate, $this->DateFormat);
        
        $this->rsltn_serviceno = new clsField("rsltn_serviceno", ccsText, "");
        
        $this->rsltn_eta = new clsField("rsltn_eta", ccsDate, $this->DateFormat);
        
        $this->rsltn_etd = new clsField("rsltn_etd", ccsDate, $this->DateFormat);
        
        $this->ticketNumber = new clsField("ticketNumber", ccsText, "");
        
        $this->site = new clsField("site", ccsText, "");
        
        $this->ticketToppanid = new clsField("ticketToppanid", ccsText, "");
        
        $this->ticketRelated = new clsField("ticketRelated", ccsText, "");
        
        $this->rsltn_inspection = new clsField("rsltn_inspection", ccsMemo, "");
        
        $this->rsltn_action = new clsField("rsltn_action", ccsMemo, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        
        $this->rsltnId = new clsField("rsltnId", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        
        $this->rsltn_datetosave = new clsField("rsltn_datetosave", ccsDate, $this->DateFormat);
        
        $this->rsltn_customer = new clsField("rsltn_customer", ccsText, "");
        
        $this->rsltn_actionmethod = new clsField("rsltn_actionmethod", ccsText, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        
        $this->rsltn_contact = new clsField("rsltn_contact", ccsText, "");
        
        $this->rsltn_contact2 = new clsField("rsltn_contact2", ccsText, "");
        
        $this->rsltn_counter = new clsField("rsltn_counter", ccsText, "");
        

        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_servicedate"] = array("Name" => "rsltn_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_servicennumber"] = array("Name" => "rsltn_servicennumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_eta"] = array("Name" => "rsltn_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_etd"] = array("Name" => "rsltn_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_inspection"] = array("Name" => "rsltn_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_counter"] = array("Name" => "rsltn_counter", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_servicedate"] = array("Name" => "rsltn_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_servicennumber"] = array("Name" => "rsltn_servicennumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_eta"] = array("Name" => "rsltn_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_etd"] = array("Name" => "rsltn_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_inspection"] = array("Name" => "rsltn_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_type"] = array("Name" => "rsltn_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_counter"] = array("Name" => "rsltn_counter", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @12-9E3FD72E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @12-7105B5E9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_resolutionnote {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @12-DA22F09C
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rsltn_engineer->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_servicedate->SetDBValue(trim($this->f("rsltn_servicedate")));
        $this->rsltn_serviceno->SetDBValue($this->f("rsltn_servicennumber"));
        $this->rsltn_eta->SetDBValue(trim($this->f("rsltn_eta")));
        $this->rsltn_etd->SetDBValue(trim($this->f("rsltn_etd")));
        $this->rsltn_inspection->SetDBValue($this->f("rsltn_inspection"));
        $this->rsltn_action->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
        $this->rsltnId->SetDBValue($this->f("id"));
        $this->datemodified->SetDBValue($this->f("datemodified"));
        $this->rsltn_datetosave->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_actionmethod->SetDBValue($this->f("rsltn_actionmethod"));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
        $this->rsltn_counter->SetDBValue($this->f("rsltn_counter"));
    }
//End SetValues Method

//Insert Method @12-DAAA42F5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["rsltn_byuser"]["Value"] = $this->rsltn_engineer->GetDBValue(true);
        $this->InsertFields["rsltn_servicedate"]["Value"] = $this->rsltn_servicedate->GetDBValue(true);
        $this->InsertFields["rsltn_servicennumber"]["Value"] = $this->rsltn_serviceno->GetDBValue(true);
        $this->InsertFields["rsltn_eta"]["Value"] = $this->rsltn_eta->GetDBValue(true);
        $this->InsertFields["rsltn_etd"]["Value"] = $this->rsltn_etd->GetDBValue(true);
        $this->InsertFields["rsltn_inspection"]["Value"] = $this->rsltn_inspection->GetDBValue(true);
        $this->InsertFields["rsltn_actiontaken"]["Value"] = $this->rsltn_action->GetDBValue(true);
        $this->InsertFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->InsertFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["rsltn_date"]["Value"] = $this->rsltn_datetosave->GetDBValue(true);
        $this->InsertFields["rsltn_actionmethod"]["Value"] = $this->rsltn_actionmethod->GetDBValue(true);
        $this->InsertFields["rsltn_type"]["Value"] = $this->rsltn_type->GetDBValue(true);
        $this->InsertFields["rsltn_counter"]["Value"] = $this->rsltn_counter->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_resolutionnote", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @12-64D5A837
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["rsltn_byuser"]["Value"] = $this->rsltn_engineer->GetDBValue(true);
        $this->UpdateFields["rsltn_servicedate"]["Value"] = $this->rsltn_servicedate->GetDBValue(true);
        $this->UpdateFields["rsltn_servicennumber"]["Value"] = $this->rsltn_serviceno->GetDBValue(true);
        $this->UpdateFields["rsltn_eta"]["Value"] = $this->rsltn_eta->GetDBValue(true);
        $this->UpdateFields["rsltn_etd"]["Value"] = $this->rsltn_etd->GetDBValue(true);
        $this->UpdateFields["rsltn_inspection"]["Value"] = $this->rsltn_inspection->GetDBValue(true);
        $this->UpdateFields["rsltn_actiontaken"]["Value"] = $this->rsltn_action->GetDBValue(true);
        $this->UpdateFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->UpdateFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["rsltn_date"]["Value"] = $this->rsltn_datetosave->GetDBValue(true);
        $this->UpdateFields["rsltn_actionmethod"]["Value"] = $this->rsltn_actionmethod->GetDBValue(true);
        $this->UpdateFields["rsltn_type"]["Value"] = $this->rsltn_type->GetDBValue(true);
        $this->UpdateFields["rsltn_counter"]["Value"] = $this->rsltn_counter->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_resolutionnote", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End smart_resolutionDataSource Class @12-FCB6E20C

class clsEditableGridGMeasurement { //GMeasurement Class @235-4C640CCF

//Variables @235-F667987F

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

//Class_Initialize Event @235-B172DC2B
    function clsEditableGridGMeasurement($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid GMeasurement/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "GMeasurement";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clsGMeasurementDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
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
        $this->msre_item = & new clsControl(ccsListBox, "msre_item", "Item", ccsText, "", NULL, $this);
        $this->msre_item->DSType = dsTable;
        $this->msre_item->DataSource = new clsDBSMART();
        $this->msre_item->ds = & $this->msre_item->DataSource;
        $this->msre_item->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        list($this->msre_item->BoundColumn, $this->msre_item->TextColumn, $this->msre_item->DBFormat) = array("spart_code", "spart_name", "");
        $this->msre_item->DataSource->Parameters["expr238"] = S;
        $this->msre_item->DataSource->wp = new clsSQLParameters();
        $this->msre_item->DataSource->wp->AddParameter("1", "expr238", ccsText, "", "", $this->msre_item->DataSource->Parameters["expr238"], "", false);
        $this->msre_item->DataSource->wp->Criterion[1] = $this->msre_item->DataSource->wp->Operation(opEqual, "spart_category", $this->msre_item->DataSource->wp->GetDBValue("1"), $this->msre_item->DataSource->ToSQL($this->msre_item->DataSource->wp->GetDBValue("1"), ccsText),false);
        $this->msre_item->DataSource->Where = 
             $this->msre_item->DataSource->wp->Criterion[1];
        $this->msre_item->Required = true;
        $this->msre_before = & new clsControl(ccsTextBox, "msre_before", "Msre Before", ccsSingle, "", NULL, $this);
        $this->msre_before->Required = true;
        $this->msre_after = & new clsControl(ccsTextBox, "msre_after", "Msre After", ccsSingle, "", NULL, $this);
        $this->msre_after->Required = true;
        $this->msre_remark = & new clsControl(ccsTextBox, "msre_remark", "Msre Remark", ccsText, "", NULL, $this);
        $this->msre_remark->Required = true;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsText, "", NULL, $this);
        $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @235-6AA5FC33
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @235-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @235-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @235-F9377717
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["msre_item"][$RowNumber] = CCGetFromPost("msre_item_" . $RowNumber, NULL);
            $this->FormParameters["msre_before"][$RowNumber] = CCGetFromPost("msre_before_" . $RowNumber, NULL);
            $this->FormParameters["msre_after"][$RowNumber] = CCGetFromPost("msre_after_" . $RowNumber, NULL);
            $this->FormParameters["msre_remark"][$RowNumber] = CCGetFromPost("msre_remark_" . $RowNumber, NULL);
            $this->FormParameters["resolution_id"][$RowNumber] = CCGetFromPost("resolution_id_" . $RowNumber, NULL);
            $this->FormParameters["datemodified"][$RowNumber] = CCGetFromPost("datemodified_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @235-36542027
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->msre_item->SetText($this->FormParameters["msre_item"][$this->RowNumber], $this->RowNumber);
            $this->msre_before->SetText($this->FormParameters["msre_before"][$this->RowNumber], $this->RowNumber);
            $this->msre_after->SetText($this->FormParameters["msre_after"][$this->RowNumber], $this->RowNumber);
            $this->msre_remark->SetText($this->FormParameters["msre_remark"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @235-49EBE1E4
    function ValidateRow()
    {
        global $CCSLocales;
        $this->msre_item->Validate();
        $this->msre_before->Validate();
        $this->msre_after->Validate();
        $this->msre_remark->Validate();
        $this->resolution_id->Validate();
        $this->datemodified->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->msre_item->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_before->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_after->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resolution_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $this->msre_item->Errors->Clear();
        $this->msre_before->Errors->Clear();
        $this->msre_after->Errors->Clear();
        $this->msre_remark->Errors->Clear();
        $this->resolution_id->Errors->Clear();
        $this->datemodified->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @235-43FD97A1
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["msre_item"][$this->RowNumber]) && count($this->FormParameters["msre_item"][$this->RowNumber])) || strlen($this->FormParameters["msre_item"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["msre_before"][$this->RowNumber]) && count($this->FormParameters["msre_before"][$this->RowNumber])) || strlen($this->FormParameters["msre_before"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["msre_after"][$this->RowNumber]) && count($this->FormParameters["msre_after"][$this->RowNumber])) || strlen($this->FormParameters["msre_after"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["msre_remark"][$this->RowNumber]) && count($this->FormParameters["msre_remark"][$this->RowNumber])) || strlen($this->FormParameters["msre_remark"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["resolution_id"][$this->RowNumber]) && count($this->FormParameters["resolution_id"][$this->RowNumber])) || strlen($this->FormParameters["resolution_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["datemodified"][$this->RowNumber]) && count($this->FormParameters["datemodified"][$this->RowNumber])) || strlen($this->FormParameters["datemodified"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @235-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @235-6B923CC2
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

//UpdateGrid Method @235-CE153705
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->msre_item->SetText($this->FormParameters["msre_item"][$this->RowNumber], $this->RowNumber);
            $this->msre_before->SetText($this->FormParameters["msre_before"][$this->RowNumber], $this->RowNumber);
            $this->msre_after->SetText($this->FormParameters["msre_after"][$this->RowNumber], $this->RowNumber);
            $this->msre_remark->SetText($this->FormParameters["msre_remark"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
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

//InsertRow Method @235-376FE556
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->msre_item->SetValue($this->msre_item->GetValue(true));
        $this->DataSource->msre_before->SetValue($this->msre_before->GetValue(true));
        $this->DataSource->msre_after->SetValue($this->msre_after->GetValue(true));
        $this->DataSource->msre_remark->SetValue($this->msre_remark->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
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

//UpdateRow Method @235-A143624C
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->msre_item->SetValue($this->msre_item->GetValue(true));
        $this->DataSource->msre_before->SetValue($this->msre_before->GetValue(true));
        $this->DataSource->msre_after->SetValue($this->msre_after->GetValue(true));
        $this->DataSource->msre_remark->SetValue($this->msre_remark->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
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

//FormScript Method @235-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @235-0EEA5586
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

//GetFormState Method @235-692238C5
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

//Show Method @235-5F3DD660
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->msre_item->Prepare();

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
        $this->ControlsVisible["msre_item"] = $this->msre_item->Visible;
        $this->ControlsVisible["msre_before"] = $this->msre_before->Visible;
        $this->ControlsVisible["msre_after"] = $this->msre_after->Visible;
        $this->ControlsVisible["msre_remark"] = $this->msre_remark->Visible;
        $this->ControlsVisible["resolution_id"] = $this->resolution_id->Visible;
        $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["id"][$this->RowNumber] = $this->DataSource->CachedColumns["id"];
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->msre_item->SetValue($this->DataSource->msre_item->GetValue());
                    $this->msre_before->SetValue($this->DataSource->msre_before->GetValue());
                    $this->msre_after->SetValue($this->DataSource->msre_after->GetValue());
                    $this->msre_remark->SetValue($this->DataSource->msre_remark->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->id->SetText("");
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->msre_item->SetText($this->FormParameters["msre_item"][$this->RowNumber], $this->RowNumber);
                    $this->msre_before->SetText($this->FormParameters["msre_before"][$this->RowNumber], $this->RowNumber);
                    $this->msre_after->SetText($this->FormParameters["msre_after"][$this->RowNumber], $this->RowNumber);
                    $this->msre_remark->SetText($this->FormParameters["msre_remark"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->id->SetText("");
                    $this->msre_item->SetText("");
                    $this->msre_before->SetText("");
                    $this->msre_after->SetText("");
                    $this->msre_remark->SetText("");
                    $this->resolution_id->SetText("");
                    $this->datemodified->SetText("");
                } else {
                    $this->id->SetText("");
                    $this->msre_item->SetText($this->FormParameters["msre_item"][$this->RowNumber], $this->RowNumber);
                    $this->msre_before->SetText($this->FormParameters["msre_before"][$this->RowNumber], $this->RowNumber);
                    $this->msre_after->SetText($this->FormParameters["msre_after"][$this->RowNumber], $this->RowNumber);
                    $this->msre_remark->SetText($this->FormParameters["msre_remark"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show($this->RowNumber);
                $this->msre_item->Show($this->RowNumber);
                $this->msre_before->Show($this->RowNumber);
                $this->msre_after->Show($this->RowNumber);
                $this->msre_remark->Show($this->RowNumber);
                $this->resolution_id->Show($this->RowNumber);
                $this->datemodified->Show($this->RowNumber);
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

} //End GMeasurement Class @235-FCB6E20C

class clsGMeasurementDataSource extends clsDBSMART {  //GMeasurementDataSource Class @235-D1BD1F1D

//DataSource Variables @235-FE740255
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $id;
    var $msre_item;
    var $msre_before;
    var $msre_after;
    var $msre_remark;
    var $resolution_id;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @235-C38681ED
    function clsGMeasurementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid GMeasurement/Error";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->msre_item = new clsField("msre_item", ccsText, "");
        
        $this->msre_before = new clsField("msre_before", ccsSingle, "");
        
        $this->msre_after = new clsField("msre_after", ccsSingle, "");
        
        $this->msre_remark = new clsField("msre_remark", ccsText, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        

        $this->InsertFields["msre_item"] = array("Name" => "msre_item", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["msre_before"] = array("Name" => "msre_before", "Value" => "", "DataType" => ccsSingle, "OmitIfEmpty" => 1);
        $this->InsertFields["msre_after"] = array("Name" => "msre_after", "Value" => "", "DataType" => ccsSingle, "OmitIfEmpty" => 1);
        $this->InsertFields["msre_remark"] = array("Name" => "msre_remark", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["msre_item"] = array("Name" => "msre_item", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["msre_before"] = array("Name" => "msre_before", "Value" => "", "DataType" => ccsSingle, "OmitIfEmpty" => 1);
        $this->UpdateFields["msre_after"] = array("Name" => "msre_after", "Value" => "", "DataType" => ccsSingle, "OmitIfEmpty" => 1);
        $this->UpdateFields["msre_remark"] = array("Name" => "msre_remark", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @235-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @235-919E7AF8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsText, "", "", $this->Parameters["urlrid"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @235-41EF7335
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_measurement";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_measurement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @235-38FE030E
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->id->SetDBValue(trim($this->f("id")));
        $this->msre_item->SetDBValue($this->f("msre_item"));
        $this->msre_before->SetDBValue(trim($this->f("msre_before")));
        $this->msre_after->SetDBValue(trim($this->f("msre_after")));
        $this->msre_remark->SetDBValue($this->f("msre_remark"));
        $this->resolution_id->SetDBValue($this->f("resolution_id"));
        $this->datemodified->SetDBValue($this->f("datemodified"));
    }
//End SetValues Method

//Insert Method @235-7A7C5DE0
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["msre_item"]["Value"] = $this->msre_item->GetDBValue(true);
        $this->InsertFields["msre_before"]["Value"] = $this->msre_before->GetDBValue(true);
        $this->InsertFields["msre_after"]["Value"] = $this->msre_after->GetDBValue(true);
        $this->InsertFields["msre_remark"]["Value"] = $this->msre_remark->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_measurement", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @235-C4906DA4
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["msre_item"]["Value"] = $this->msre_item->GetDBValue(true);
        $this->UpdateFields["msre_before"]["Value"] = $this->msre_before->GetDBValue(true);
        $this->UpdateFields["msre_after"]["Value"] = $this->msre_after->GetDBValue(true);
        $this->UpdateFields["msre_remark"]["Value"] = $this->msre_remark->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_measurement", $this->UpdateFields, $this);
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

} //End GMeasurementDataSource Class @235-FCB6E20C



class clsGridGSmartReplacement { //GSmartReplacement class @99-5DDF5AB2

//Variables @99-AC1EDBB9

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

//Class_Initialize Event @99-BA910916
    function clsGridGSmartReplacement($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GSmartReplacement";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GSmartReplacement";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGSmartReplacementDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->equipment_id = & new clsControl(ccsLink, "equipment_id", "equipment_id", ccsText, "", CCGetRequestParam("equipment_id", ccsGet, NULL), $this);
        $this->equipment_id->Page = "cmactivity.php";
        $this->equipment_serialno = & new clsControl(ccsLabel, "equipment_serialno", "equipment_serialno", ccsText, "", CCGetRequestParam("equipment_serialno", ccsGet, NULL), $this);
        $this->rplc_serialnumber = & new clsControl(ccsLabel, "rplc_serialnumber", "rplc_serialnumber", ccsText, "", CCGetRequestParam("rplc_serialnumber", ccsGet, NULL), $this);
        $this->rplc_type = & new clsControl(ccsHidden, "rplc_type", "rplc_type", ccsText, "", CCGetRequestParam("rplc_type", ccsGet, NULL), $this);
        $this->rplc_remark = & new clsControl(ccsLabel, "rplc_remark", "rplc_remark", ccsText, "", CCGetRequestParam("rplc_remark", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->btnNewRec = & new clsControl(ccsImageLink, "btnNewRec", "btnNewRec", ccsText, "", CCGetRequestParam("btnNewRec", ccsGet, NULL), $this);
        $this->btnNewRec->Page = "cmactivity.php";
    }
//End Class_Initialize Event

//Initialize Method @99-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @99-2D83FA79
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);

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
            $this->ControlsVisible["equipment_id"] = $this->equipment_id->Visible;
            $this->ControlsVisible["equipment_serialno"] = $this->equipment_serialno->Visible;
            $this->ControlsVisible["rplc_serialnumber"] = $this->rplc_serialnumber->Visible;
            $this->ControlsVisible["rplc_type"] = $this->rplc_type->Visible;
            $this->ControlsVisible["rplc_remark"] = $this->rplc_remark->Visible;
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
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->equipment_id->SetValue($this->DataSource->equipment_id->GetValue());
                $this->equipment_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->equipment_id->Parameters = CCAddParam($this->equipment_id->Parameters, "rplc", 1);
                $this->equipment_id->Parameters = CCAddParam($this->equipment_id->Parameters, "rplcid", $this->DataSource->f("id"));
                $this->equipment_serialno->SetValue($this->DataSource->equipment_serialno->GetValue());
                $this->rplc_serialnumber->SetValue($this->DataSource->rplc_serialnumber->GetValue());
                $this->rplc_type->SetValue($this->DataSource->rplc_type->GetValue());
                $this->rplc_remark->SetValue($this->DataSource->rplc_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->equipment_id->Show();
                $this->equipment_serialno->Show();
                $this->rplc_serialnumber->Show();
                $this->rplc_type->Show();
                $this->rplc_remark->Show();
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
        $this->btnNewRec->Parameters = CCGetQueryString("QueryString", array("rplcid", "ccsForm"));
        $this->btnNewRec->Parameters = CCAddParam($this->btnNewRec->Parameters, "tcktid", CCGetFromGet("tcktid", NULL));
        $this->btnNewRec->Parameters = CCAddParam($this->btnNewRec->Parameters, "rid", CCGetFromGet("rid", NULL));
        $this->btnNewRec->Parameters = CCAddParam($this->btnNewRec->Parameters, "rplc", 1);
        $this->Navigator->Show();
        $this->btnNewRec->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @99-0E6A06A4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipment_serialno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GSmartReplacement Class @99-FCB6E20C

class clsGSmartReplacementDataSource extends clsDBSMART {  //GSmartReplacementDataSource Class @99-4196D069

//DataSource Variables @99-23588E70
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lblNumber;
    var $equipment_id;
    var $equipment_serialno;
    var $rplc_serialnumber;
    var $rplc_type;
    var $rplc_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @99-9B2105ED
    function clsGSmartReplacementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GSmartReplacement";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->equipment_id = new clsField("equipment_id", ccsText, "");
        
        $this->equipment_serialno = new clsField("equipment_serialno", ccsText, "");
        
        $this->rplc_serialnumber = new clsField("rplc_serialnumber", ccsText, "");
        
        $this->rplc_type = new clsField("rplc_type", ccsText, "");
        
        $this->rplc_remark = new clsField("rplc_remark", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @99-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @99-DB31FD64
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsText, "", "", $this->Parameters["urlrid"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @99-CDB46B33
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_replacement";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_replacement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @99-33199AF0
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->equipment_id->SetDBValue($this->f("faultyequipment_id"));
        $this->equipment_serialno->SetDBValue($this->f("rplc_currserial"));
        $this->rplc_serialnumber->SetDBValue($this->f("rplc_rplcserial"));
        $this->rplc_type->SetDBValue($this->f("rplc_type"));
        $this->rplc_remark->SetDBValue($this->f("rplc_remark"));
    }
//End SetValues Method

} //End GSmartReplacementDataSource Class @99-FCB6E20C

class clsRecordRSmartReplacement { //RSmartReplacement Class @130-3DA23874

//Variables @130-D6FF3E86

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

//Class_Initialize Event @130-11AD32F8
    function clsRecordRSmartReplacement($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record RSmartReplacement/Error";
        $this->DataSource = new clsRSmartReplacementDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "RSmartReplacement";
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
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->rplc_serialnumber = & new clsControl(ccsTextBox, "rplc_serialnumber", "Current Serial", ccsText, "", CCGetRequestParam("rplc_serialnumber", $Method, NULL), $this);
            $this->rplc_serialnumber->Required = true;
            $this->rplc_remark = & new clsControl(ccsTextArea, "rplc_remark", "Rplc Remark", ccsMemo, "", CCGetRequestParam("rplc_remark", $Method, NULL), $this);
            $this->rplc_remark->Required = true;
            $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsInteger, "", CCGetRequestParam("resolution_id", $Method, NULL), $this);
            $this->resolution_id->Required = true;
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsText, "", CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->rplc_equipment = & new clsControl(ccsListBox, "rplc_equipment", "rplc_equipment", ccsText, "", CCGetRequestParam("rplc_equipment", $Method, NULL), $this);
            $this->rplc_equipment->DSType = dsTable;
            $this->rplc_equipment->DataSource = new clsDBSMART();
            $this->rplc_equipment->ds = & $this->rplc_equipment->DataSource;
            $this->rplc_equipment->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->rplc_equipment->BoundColumn, $this->rplc_equipment->TextColumn, $this->rplc_equipment->DBFormat) = array("id", "eqpmt_name", "");
            $this->rplc_sparepart = & new clsControl(ccsListBox, "rplc_sparepart", "rplc_sparepart", ccsText, "", CCGetRequestParam("rplc_sparepart", $Method, NULL), $this);
            $this->rplc_sparepart->DSType = dsTable;
            $this->rplc_sparepart->DataSource = new clsDBSMART();
            $this->rplc_sparepart->ds = & $this->rplc_sparepart->DataSource;
            $this->rplc_sparepart->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
            list($this->rplc_sparepart->BoundColumn, $this->rplc_sparepart->TextColumn, $this->rplc_sparepart->DBFormat) = array("id", "spart_name", "");
            $this->itemtype = & new clsControl(ccsRadioButton, "itemtype", "Faultyequipment Id", ccsText, "", CCGetRequestParam("itemtype", $Method, NULL), $this);
            $this->itemtype->DSType = dsListOfValues;
            $this->itemtype->Values = array(array("eq", "Equipment"), array("sp", "Spare Part"));
            $this->itemtype->HTML = true;
            $this->itemtype->Required = true;
            $this->rplc_rplcserial = & new clsControl(ccsTextBox, "rplc_rplcserial", "Replacement Serial No.", ccsText, "", CCGetRequestParam("rplc_rplcserial", $Method, NULL), $this);
            $this->rplc_rplcserial->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @130-A24DCFC8
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrplcid"] = CCGetFromGet("rplcid", NULL);
    }
//End Initialize Method

//Validate Method @130-E6259DFE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->rplc_serialnumber->Validate() && $Validation);
        $Validation = ($this->rplc_remark->Validate() && $Validation);
        $Validation = ($this->resolution_id->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->rplc_equipment->Validate() && $Validation);
        $Validation = ($this->rplc_sparepart->Validate() && $Validation);
        $Validation = ($this->itemtype->Validate() && $Validation);
        $Validation = ($this->rplc_rplcserial->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->rplc_serialnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rplc_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resolution_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rplc_equipment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rplc_sparepart->Errors->Count() == 0);
        $Validation =  $Validation && ($this->itemtype->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rplc_rplcserial->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @130-43C38F1D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->rplc_serialnumber->Errors->Count());
        $errors = ($errors || $this->rplc_remark->Errors->Count());
        $errors = ($errors || $this->resolution_id->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->rplc_equipment->Errors->Count());
        $errors = ($errors || $this->rplc_sparepart->Errors->Count());
        $errors = ($errors || $this->itemtype->Errors->Count());
        $errors = ($errors || $this->rplc_rplcserial->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @130-ED598703
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

//Operation Method @130-0BF2B389
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
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
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @130-571F9F67
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->rplc_serialnumber->SetValue($this->rplc_serialnumber->GetValue(true));
        $this->DataSource->rplc_remark->SetValue($this->rplc_remark->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rplc_equipment->SetValue($this->rplc_equipment->GetValue(true));
        $this->DataSource->rplc_sparepart->SetValue($this->rplc_sparepart->GetValue(true));
        $this->DataSource->itemtype->SetValue($this->itemtype->GetValue(true));
        $this->DataSource->rplc_rplcserial->SetValue($this->rplc_rplcserial->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @130-97511C94
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->rplc_serialnumber->SetValue($this->rplc_serialnumber->GetValue(true));
        $this->DataSource->rplc_remark->SetValue($this->rplc_remark->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rplc_equipment->SetValue($this->rplc_equipment->GetValue(true));
        $this->DataSource->rplc_sparepart->SetValue($this->rplc_sparepart->GetValue(true));
        $this->DataSource->itemtype->SetValue($this->itemtype->GetValue(true));
        $this->DataSource->rplc_rplcserial->SetValue($this->rplc_rplcserial->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @130-8D31DAD4
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

        $this->rplc_equipment->Prepare();
        $this->rplc_sparepart->Prepare();
        $this->itemtype->Prepare();

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
                    $this->rplc_serialnumber->SetValue($this->DataSource->rplc_serialnumber->GetValue());
                    $this->rplc_remark->SetValue($this->DataSource->rplc_remark->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->rplc_equipment->SetValue($this->DataSource->rplc_equipment->GetValue());
                    $this->rplc_sparepart->SetValue($this->DataSource->rplc_sparepart->GetValue());
                    $this->itemtype->SetValue($this->DataSource->itemtype->GetValue());
                    $this->rplc_rplcserial->SetValue($this->DataSource->rplc_rplcserial->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->rplc_serialnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rplc_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resolution_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rplc_equipment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rplc_sparepart->Errors->ToString());
            $Error = ComposeStrings($Error, $this->itemtype->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rplc_rplcserial->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->rplc_serialnumber->Show();
        $this->rplc_remark->Show();
        $this->resolution_id->Show();
        $this->datemodified->Show();
        $this->rplc_equipment->Show();
        $this->rplc_sparepart->Show();
        $this->itemtype->Show();
        $this->rplc_rplcserial->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End RSmartReplacement Class @130-FCB6E20C

class clsRSmartReplacementDataSource extends clsDBSMART {  //RSmartReplacementDataSource Class @130-3807F098

//DataSource Variables @130-0D4B8172
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $rplc_serialnumber;
    var $rplc_remark;
    var $resolution_id;
    var $datemodified;
    var $rplc_equipment;
    var $rplc_sparepart;
    var $itemtype;
    var $rplc_rplcserial;
//End DataSource Variables

//DataSourceClass_Initialize Event @130-706F0C53
    function clsRSmartReplacementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record RSmartReplacement/Error";
        $this->Initialize();
        $this->rplc_serialnumber = new clsField("rplc_serialnumber", ccsText, "");
        
        $this->rplc_remark = new clsField("rplc_remark", ccsMemo, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        
        $this->rplc_equipment = new clsField("rplc_equipment", ccsText, "");
        
        $this->rplc_sparepart = new clsField("rplc_sparepart", ccsText, "");
        
        $this->itemtype = new clsField("itemtype", ccsText, "");
        
        $this->rplc_rplcserial = new clsField("rplc_rplcserial", ccsText, "");
        

        $this->InsertFields["rplc_currserial"] = array("Name" => "rplc_currserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rplc_remark"] = array("Name" => "rplc_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["faultyequipment_id"] = array("Name" => "faultyequipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["faultyequipment_id"] = array("Name" => "faultyequipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rplc_type"] = array("Name" => "rplc_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rplc_rplcserial"] = array("Name" => "rplc_rplcserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rplc_currserial"] = array("Name" => "rplc_currserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rplc_remark"] = array("Name" => "rplc_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["faultyequipment_id"] = array("Name" => "faultyequipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["faultyequipment_id"] = array("Name" => "faultyequipment_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rplc_type"] = array("Name" => "rplc_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rplc_rplcserial"] = array("Name" => "rplc_rplcserial", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @130-317A688E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrplcid", ccsInteger, "", "", $this->Parameters["urlrplcid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @130-541DD839
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_replacement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @130-838B1E77
    function SetValues()
    {
        $this->rplc_serialnumber->SetDBValue($this->f("rplc_currserial"));
        $this->rplc_remark->SetDBValue($this->f("rplc_remark"));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->datemodified->SetDBValue($this->f("datemodified"));
        $this->rplc_equipment->SetDBValue($this->f("faultyequipment_id"));
        $this->rplc_sparepart->SetDBValue($this->f("faultyequipment_id"));
        $this->itemtype->SetDBValue($this->f("rplc_type"));
        $this->rplc_rplcserial->SetDBValue($this->f("rplc_rplcserial"));
    }
//End SetValues Method

//Insert Method @130-94240573
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["rplc_currserial"]["Value"] = $this->rplc_serialnumber->GetDBValue(true);
        $this->InsertFields["rplc_remark"]["Value"] = $this->rplc_remark->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["faultyequipment_id"]["Value"] = $this->rplc_equipment->GetDBValue(true);
        $this->InsertFields["faultyequipment_id"]["Value"] = $this->rplc_sparepart->GetDBValue(true);
        $this->InsertFields["rplc_type"]["Value"] = $this->itemtype->GetDBValue(true);
        $this->InsertFields["rplc_rplcserial"]["Value"] = $this->rplc_rplcserial->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_replacement", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @130-8E72D688
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["rplc_currserial"]["Value"] = $this->rplc_serialnumber->GetDBValue(true);
        $this->UpdateFields["rplc_remark"]["Value"] = $this->rplc_remark->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["faultyequipment_id"]["Value"] = $this->rplc_equipment->GetDBValue(true);
        $this->UpdateFields["faultyequipment_id"]["Value"] = $this->rplc_sparepart->GetDBValue(true);
        $this->UpdateFields["rplc_type"]["Value"] = $this->itemtype->GetDBValue(true);
        $this->UpdateFields["rplc_rplcserial"]["Value"] = $this->rplc_rplcserial->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_replacement", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End RSmartReplacementDataSource Class @130-FCB6E20C

class clsEditableGridsmart_attachment { //smart_attachment Class @171-79934383

//Variables @171-F667987F

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

//Class_Initialize Event @171-8A8105AF
    function clsEditableGridsmart_attachment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid smart_attachment/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "smart_attachment";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["id"][0] = "id";
        $this->DataSource = new clssmart_attachmentDataSource($this);
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

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "multipart/form-data";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->id = & new clsControl(ccsHidden, "id", "Id", ccsInteger, "", NULL, $this);
        $this->attch_byuser = & new clsControl(ccsTextBox, "attch_byuser", "Attch Byuser", ccsText, "", NULL, $this);
        $this->attch_name = & new clsControl(ccsTextBox, "attch_name", "Title", ccsText, "", NULL, $this);
        $this->attch_name->Required = true;
        $this->attch_date = & new clsControl(ccsHidden, "attch_date", "Date", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel = & new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->FileUpload = & new clsFileUpload("FileUpload", "Attachment", "temp/", "attachments/", "*.pdf;*.png;*.jpg;*.gif", "", 2097152, $this);
        $this->FileUpload->Required = true;
        $this->storeuser = & new clsControl(ccsHidden, "storeuser", "storeuser", ccsText, "", NULL, $this);
        $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsInteger, "", NULL, $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", NULL, $this);
        $this->att_link = & new clsControl(ccsLink, "att_link", "att_link", ccsText, "", NULL, $this);
        $this->att_link->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lblDate = & new clsControl(ccsLabel, "lblDate", "lblDate", ccsDate, array("GeneralDate"), NULL, $this);
        $this->datemodified = & new clsControl(ccsHidden, "datemodified", "datemodified", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
        $this->ControlsErrors["FileUpload"] = array();
    }
//End Class_Initialize Event

//Initialize Method @171-6AA5FC33
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @171-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @171-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @171-F74F46BF
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["id"][$RowNumber] = CCGetFromPost("id_" . $RowNumber, NULL);
            $this->FormParameters["attch_byuser"][$RowNumber] = CCGetFromPost("attch_byuser_" . $RowNumber, NULL);
            $this->FormParameters["attch_name"][$RowNumber] = CCGetFromPost("attch_name_" . $RowNumber, NULL);
            $this->FormParameters["attch_date"][$RowNumber] = CCGetFromPost("attch_date_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["storeuser"][$RowNumber] = CCGetFromPost("storeuser_" . $RowNumber, NULL);
            $this->FormParameters["resolution_id"][$RowNumber] = CCGetFromPost("resolution_id_" . $RowNumber, NULL);
            $this->FormParameters["datemodified"][$RowNumber] = CCGetFromPost("datemodified_" . $RowNumber, NULL);
            $this->FileUpload->Upload($RowNumber);
            $this->FormParameters["FileUpload"][$RowNumber] = $this->FileUpload->GetValue();
            $this->ControlsErrors["FileUpload"][$RowNumber] = $this->FileUpload->Errors;
            $this->FileUpload->Errors->Clear();
        }
    }
//End GetFormParameters Method

//Validate Method @171-1C0319AC
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        $this->ControlsErrors["FileUpload"][0] = new clsErrors();
        $this->ControlsErrors["FileUpload"][0]->AddErrors($this->FileUpload->Errors);
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->FileUpload->Errors->Clear();
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
            $this->attch_byuser->SetText($this->FormParameters["attch_byuser"][$this->RowNumber], $this->RowNumber);
            $this->attch_name->SetText($this->FormParameters["attch_name"][$this->RowNumber], $this->RowNumber);
            $this->attch_date->SetText($this->FormParameters["attch_date"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->FileUpload->SetText($this->FormParameters["FileUpload"][$this->RowNumber], $this->RowNumber);
            $this->storeuser->SetText($this->FormParameters["storeuser"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
            $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
            $this->ControlsErrors["FileUpload"][$this->RowNumber] = new clsErrors();
            $this->ControlsErrors["FileUpload"][$this->RowNumber]->AddErrors($this->FileUpload->Errors);
        }
        $this->FileUpload->Errors->Clear();
        $this->FileUpload->Errors->AddErrors($this->ControlsErrors["FileUpload"][0]);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @171-9B96F1B2
    function ValidateRow()
    {
        global $CCSLocales;
        $this->id->Validate();
        $this->attch_byuser->Validate();
        $this->attch_name->Validate();
        $this->attch_date->Validate();
        $this->CheckBox_Delete->Validate();
        $this->FileUpload->Validate();
        $this->storeuser->Validate();
        $this->resolution_id->Validate();
        $this->datemodified->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->attch_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->attch_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->attch_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FileUpload->Errors->ToString());
        $errors = ComposeStrings($errors, $this->storeuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resolution_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->datemodified->Errors->ToString());
        $this->id->Errors->Clear();
        $this->attch_byuser->Errors->Clear();
        $this->attch_name->Errors->Clear();
        $this->attch_date->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->FileUpload->Errors->Clear();
        $this->storeuser->Errors->Clear();
        $this->resolution_id->Errors->Clear();
        $this->datemodified->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @171-75C30D36
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["id"][$this->RowNumber]) && count($this->FormParameters["id"][$this->RowNumber])) || strlen($this->FormParameters["id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["attch_byuser"][$this->RowNumber]) && count($this->FormParameters["attch_byuser"][$this->RowNumber])) || strlen($this->FormParameters["attch_byuser"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["attch_name"][$this->RowNumber]) && count($this->FormParameters["attch_name"][$this->RowNumber])) || strlen($this->FormParameters["attch_name"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["attch_date"][$this->RowNumber]) && count($this->FormParameters["attch_date"][$this->RowNumber])) || strlen($this->FormParameters["attch_date"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["FileUpload"][$this->RowNumber]) && count($this->FormParameters["FileUpload"][$this->RowNumber])) || strlen($this->FormParameters["FileUpload"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["storeuser"][$this->RowNumber]) && count($this->FormParameters["storeuser"][$this->RowNumber])) || strlen($this->FormParameters["storeuser"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["resolution_id"][$this->RowNumber]) && count($this->FormParameters["resolution_id"][$this->RowNumber])) || strlen($this->FormParameters["resolution_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["datemodified"][$this->RowNumber]) && count($this->FormParameters["datemodified"][$this->RowNumber])) || strlen($this->FormParameters["datemodified"][$this->RowNumber]));
        $filed = ($filed || $this->FileUpload->Errors->Count());
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @171-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @171-6B923CC2
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

//UpdateGrid Method @171-6B3C4574
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["id"] = $this->CachedColumns["id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
            $this->attch_byuser->SetText($this->FormParameters["attch_byuser"][$this->RowNumber], $this->RowNumber);
            $this->attch_name->SetText($this->FormParameters["attch_name"][$this->RowNumber], $this->RowNumber);
            $this->attch_date->SetText($this->FormParameters["attch_date"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->FileUpload->SetText($this->FormParameters["FileUpload"][$this->RowNumber], $this->RowNumber);
            $this->storeuser->SetText($this->FormParameters["storeuser"][$this->RowNumber], $this->RowNumber);
            $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @171-E31E0835
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->attch_byuser->SetValue($this->attch_byuser->GetValue(true));
        $this->DataSource->attch_name->SetValue($this->attch_name->GetValue(true));
        $this->DataSource->attch_date->SetValue($this->attch_date->GetValue(true));
        $this->DataSource->FileUpload->SetValue($this->FileUpload->GetValue(true));
        $this->DataSource->storeuser->SetValue($this->storeuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->att_link->SetValue($this->att_link->GetValue(true));
        $this->DataSource->lblDate->SetValue($this->lblDate->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload->Move();
            $errors = ComposeStrings($errors, $this->FileUpload->Errors->ToString());
            $this->FileUpload->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @171-06631274
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id->SetValue($this->id->GetValue(true));
        $this->DataSource->attch_byuser->SetValue($this->attch_byuser->GetValue(true));
        $this->DataSource->attch_name->SetValue($this->attch_name->GetValue(true));
        $this->DataSource->attch_date->SetValue($this->attch_date->GetValue(true));
        $this->DataSource->FileUpload->SetValue($this->FileUpload->GetValue(true));
        $this->DataSource->storeuser->SetValue($this->storeuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->lblNumber->SetValue($this->lblNumber->GetValue(true));
        $this->DataSource->att_link->SetValue($this->att_link->GetValue(true));
        $this->DataSource->lblDate->SetValue($this->lblDate->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload->Move();
            $errors = ComposeStrings($errors, $this->FileUpload->Errors->ToString());
            $this->FileUpload->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @171-32FE2A9F
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload->Delete();
            $errors = ComposeStrings($errors, $this->FileUpload->Errors->ToString());
            $this->FileUpload->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @171-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @171-0EEA5586
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

//GetFormState Method @171-692238C5
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

//Show Method @171-6B9FBFFA
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
        $this->ControlsVisible["attch_byuser"] = $this->attch_byuser->Visible;
        $this->ControlsVisible["attch_name"] = $this->attch_name->Visible;
        $this->ControlsVisible["attch_date"] = $this->attch_date->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["FileUpload"] = $this->FileUpload->Visible;
        $this->ControlsVisible["storeuser"] = $this->storeuser->Visible;
        $this->ControlsVisible["resolution_id"] = $this->resolution_id->Visible;
        $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
        $this->ControlsVisible["att_link"] = $this->att_link->Visible;
        $this->ControlsVisible["lblDate"] = $this->lblDate->Visible;
        $this->ControlsVisible["datemodified"] = $this->datemodified->Visible;
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
                    $this->attch_byuser->SetText("");
                    $this->CheckBox_Delete->SetValue("");
                    $this->lblNumber->SetText("");
                    $this->id->SetValue($this->DataSource->id->GetValue());
                    $this->attch_name->SetValue($this->DataSource->attch_name->GetValue());
                    $this->attch_date->SetValue($this->DataSource->attch_date->GetValue());
                    $this->FileUpload->SetValue($this->DataSource->FileUpload->GetValue());
                    $this->storeuser->SetValue($this->DataSource->storeuser->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->att_link->SetValue($this->DataSource->att_link->GetValue());
                    $this->att_link->Page = $this->DataSource->f("attch_sourcefile");
                    $this->lblDate->SetValue($this->DataSource->lblDate->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lblNumber->SetText("");
                    $this->att_link->SetText("");
                    $this->lblDate->SetText("");
                    $this->att_link->SetValue($this->DataSource->att_link->GetValue());
                    $this->att_link->Page = $this->DataSource->f("attch_sourcefile");
                    $this->lblDate->SetValue($this->DataSource->lblDate->GetValue());
                    $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
                    $this->attch_byuser->SetText($this->FormParameters["attch_byuser"][$this->RowNumber], $this->RowNumber);
                    $this->attch_name->SetText($this->FormParameters["attch_name"][$this->RowNumber], $this->RowNumber);
                    $this->attch_date->SetText($this->FormParameters["attch_date"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload->SetText($this->FormParameters["FileUpload"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload"][$this->RowNumber]))
                        $this->FileUpload->Errors->AddErrors($this->ControlsErrors["FileUpload"][$this->RowNumber]);
                    $this->storeuser->SetText($this->FormParameters["storeuser"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["id"][$this->RowNumber] = "";
                    $this->id->SetText("");
                    $this->attch_byuser->SetText("");
                    $this->attch_name->SetText("");
                    $this->attch_date->SetText("");
                    $this->FileUpload->SetText("");
                    $this->storeuser->SetText("");
                    $this->resolution_id->SetText("");
                    $this->lblNumber->SetText("");
                    $this->att_link->SetText("");
                    $this->lblDate->SetText("");
                    $this->datemodified->SetText("");
                    $this->FileUpload->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload"][$this->RowNumber]))
                        $this->FileUpload->Errors->AddErrors($this->ControlsErrors["FileUpload"][$this->RowNumber]);
                } else {
                    $this->lblNumber->SetText("");
                    $this->att_link->SetText("");
                    $this->lblDate->SetText("");
                    $this->id->SetText($this->FormParameters["id"][$this->RowNumber], $this->RowNumber);
                    $this->attch_byuser->SetText($this->FormParameters["attch_byuser"][$this->RowNumber], $this->RowNumber);
                    $this->attch_name->SetText($this->FormParameters["attch_name"][$this->RowNumber], $this->RowNumber);
                    $this->attch_date->SetText($this->FormParameters["attch_date"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload->SetText($this->FormParameters["FileUpload"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload"][$this->RowNumber]))
                        $this->FileUpload->Errors->AddErrors($this->ControlsErrors["FileUpload"][$this->RowNumber]);
                    $this->storeuser->SetText($this->FormParameters["storeuser"][$this->RowNumber], $this->RowNumber);
                    $this->resolution_id->SetText($this->FormParameters["resolution_id"][$this->RowNumber], $this->RowNumber);
                    $this->datemodified->SetText($this->FormParameters["datemodified"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show($this->RowNumber);
                $this->attch_byuser->Show($this->RowNumber);
                $this->attch_name->Show($this->RowNumber);
                $this->attch_date->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                $this->FileUpload->Show($this->RowNumber);
                $this->storeuser->Show($this->RowNumber);
                $this->resolution_id->Show($this->RowNumber);
                $this->lblNumber->Show($this->RowNumber);
                $this->att_link->Show($this->RowNumber);
                $this->lblDate->Show($this->RowNumber);
                $this->datemodified->Show($this->RowNumber);
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

} //End smart_attachment Class @171-FCB6E20C

class clssmart_attachmentDataSource extends clsDBSMART {  //smart_attachmentDataSource Class @171-87D30A1D

//DataSource Variables @171-5C4AA3A6
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
    var $attch_byuser;
    var $attch_name;
    var $attch_date;
    var $CheckBox_Delete;
    var $FileUpload;
    var $storeuser;
    var $resolution_id;
    var $lblNumber;
    var $att_link;
    var $lblDate;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @171-38B09F65
    function clssmart_attachmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid smart_attachment/Error";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->attch_byuser = new clsField("attch_byuser", ccsText, "");
        
        $this->attch_name = new clsField("attch_name", ccsText, "");
        
        $this->attch_date = new clsField("attch_date", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->FileUpload = new clsField("FileUpload", ccsText, "");
        
        $this->storeuser = new clsField("storeuser", ccsText, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->att_link = new clsField("att_link", ccsText, "");
        
        $this->lblDate = new clsField("lblDate", ccsDate, $this->DateFormat);
        
        $this->datemodified = new clsField("datemodified", ccsText, "");
        

        $this->InsertFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_name"] = array("Name" => "attch_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_date"] = array("Name" => "attch_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_sourcefile"] = array("Name" => "attch_sourcefile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["attch_byuser"] = array("Name" => "attch_byuser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id"] = array("Name" => "id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_name"] = array("Name" => "attch_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_date"] = array("Name" => "attch_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_sourcefile"] = array("Name" => "attch_sourcefile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["attch_byuser"] = array("Name" => "attch_byuser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @171-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @171-919E7AF8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsText, "", "", $this->Parameters["urlrid"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @171-BBCFFF8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_attachment";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_attachment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @171-A0699102
    function SetValues()
    {
        $this->CachedColumns["id"] = $this->f("id");
        $this->id->SetDBValue(trim($this->f("id")));
        $this->attch_name->SetDBValue($this->f("attch_name"));
        $this->attch_date->SetDBValue($this->f("attch_date"));
        $this->FileUpload->SetDBValue($this->f("attch_sourcefile"));
        $this->storeuser->SetDBValue($this->f("attch_byuser"));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->att_link->SetDBValue($this->f("attch_sourcefile"));
        $this->lblDate->SetDBValue(trim($this->f("attch_date")));
        $this->datemodified->SetDBValue($this->f("datemodified"));
    }
//End SetValues Method

//Insert Method @171-8B3702D9
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->InsertFields["attch_name"]["Value"] = $this->attch_name->GetDBValue(true);
        $this->InsertFields["attch_date"]["Value"] = $this->attch_date->GetDBValue(true);
        $this->InsertFields["attch_sourcefile"]["Value"] = $this->FileUpload->GetDBValue(true);
        $this->InsertFields["attch_byuser"]["Value"] = $this->storeuser->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_attachment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @171-EAB200E8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->UpdateFields["id"]["Value"] = $this->id->GetDBValue(true);
        $this->UpdateFields["attch_name"]["Value"] = $this->attch_name->GetDBValue(true);
        $this->UpdateFields["attch_date"]["Value"] = $this->attch_date->GetDBValue(true);
        $this->UpdateFields["attch_sourcefile"]["Value"] = $this->FileUpload->GetDBValue(true);
        $this->UpdateFields["attch_byuser"]["Value"] = $this->storeuser->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_attachment", $this->UpdateFields, $this);
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

//Delete Method @171-EBF36B1F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "id=" . $this->ToSQL($this->CachedColumns["id"], ccsInteger);
        $this->SQL = "DELETE FROM smart_attachment";
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

} //End smart_attachmentDataSource Class @171-FCB6E20C



//Initialize Page @1-95E94645
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
$TemplateFileName = "cmactivity.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-71F504ED
CCSecurityRedirect("1;2;3;5;4", "");
//End Authenticate User

//Include events file @1-CC6F3619
include_once("./cmactivity_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-791381C9
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$Panel1 = & new clsPanel("Panel1", $MainPage);
$GEquipment = & new clsEditableGridGEquipment("", $MainPage);
$smart_resolution = & new clsRecordsmart_resolution("", $MainPage);
$id1 = & new clsControl(ccsLabel, "id1", "id1", ccsInteger, "", CCGetRequestParam("id1", ccsGet, NULL), $MainPage);
$Panel2 = & new clsPanel("Panel2", $MainPage);
$GMeasurement = & new clsEditableGridGMeasurement("", $MainPage);
$Panel3 = & new clsPanel("Panel3", $MainPage);
$GSmartReplacement = & new clsGridGSmartReplacement("", $MainPage);
$RSmartReplacement = & new clsRecordRSmartReplacement("", $MainPage);
$Panel5 = & new clsPanel("Panel5", $MainPage);
$ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("tcktid", "rid", "nl", "new", "eqid", "ccsForm"));
$ImageLink1->Parameters = CCAddParam($ImageLink1->Parameters, "id", CCGetFromGet("tcktid", NULL));
$ImageLink1->Page = "ticketdetails.php";
$ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $MainPage);
$ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink2->Parameters = CCAddParam($ImageLink2->Parameters, "tcktid", CCGetFromGet("tcktid", NULL));
$ImageLink2->Parameters = CCAddParam($ImageLink2->Parameters, "rid", CCGetFromGet("rid", NULL));
$ImageLink2->Page = "cmactivityprint.php";
$smart_attachment = & new clsEditableGridsmart_attachment("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->Panel1 = & $Panel1;
$MainPage->GEquipment = & $GEquipment;
$MainPage->smart_resolution = & $smart_resolution;
$MainPage->id1 = & $id1;
$MainPage->Panel2 = & $Panel2;
$MainPage->GMeasurement = & $GMeasurement;
$MainPage->Panel3 = & $Panel3;
$MainPage->GSmartReplacement = & $GSmartReplacement;
$MainPage->RSmartReplacement = & $RSmartReplacement;
$MainPage->Panel5 = & $Panel5;
$MainPage->ImageLink1 = & $ImageLink1;
$MainPage->ImageLink2 = & $ImageLink2;
$MainPage->smart_attachment = & $smart_attachment;
$Panel1->AddComponent("GEquipment", $GEquipment);
$Panel2->AddComponent("GMeasurement", $GMeasurement);
$Panel3->AddComponent("GSmartReplacement", $GSmartReplacement);
$Panel3->AddComponent("RSmartReplacement", $RSmartReplacement);
$Panel5->AddComponent("ImageLink1", $ImageLink1);
$Panel5->AddComponent("ImageLink2", $ImageLink2);
$GEquipment->Initialize();
$smart_resolution->Initialize();
$GMeasurement->Initialize();
$GSmartReplacement->Initialize();
$RSmartReplacement->Initialize();
$smart_attachment->Initialize();

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

//Execute Components @1-B1772860
$header->Operations();
$footer->Operations();
$GEquipment->Operation();
$smart_resolution->Operation();
$GMeasurement->Operation();
$RSmartReplacement->Operation();
$smart_attachment->Operation();
//End Execute Components

//Go to destination page @1-F5C5E9BA
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
    unset($smart_resolution);
    unset($GMeasurement);
    unset($GSmartReplacement);
    unset($RSmartReplacement);
    unset($smart_attachment);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B83E94E0
$header->Show();
$footer->Show();
$smart_resolution->Show();
$smart_attachment->Show();
$Panel1->Show();
$id1->Show();
$Panel2->Show();
$Panel3->Show();
$Panel5->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-79F50BEB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($GEquipment);
unset($smart_resolution);
unset($GMeasurement);
unset($GSmartReplacement);
unset($RSmartReplacement);
unset($smart_attachment);
unset($Tpl);
//End Unload Page


?>
