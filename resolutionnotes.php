<?php

class clsRecordresolutionnotessmart_resolution { //smart_resolution Class @12-7E20508F

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

//Class_Initialize Event @12-28B9B036
    function clsRecordresolutionnotessmart_resolution($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_resolution/Error";
        $this->DataSource = new clsresolutionnotessmart_resolutionDataSource($this);
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
            $this->rsltn_date = & new clsControl(ccsTextBox, "rsltn_date", "Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("rsltn_date", $Method, NULL), $this);
            $this->rsltn_date->Required = true;
            $this->DatePicker_rslt_date = & new clsDatePicker("DatePicker_rslt_date", "smart_resolution", "rsltn_date", $this);
            $this->rsltn_engineer = & new clsControl(ccsListBox, "rsltn_engineer", "Rslt Engineer", ccsInteger, "", CCGetRequestParam("rsltn_engineer", $Method, NULL), $this);
            $this->rsltn_engineer->DSType = dsTable;
            $this->rsltn_engineer->DataSource = new clsDBSMART();
            $this->rsltn_engineer->ds = & $this->rsltn_engineer->DataSource;
            $this->rsltn_engineer->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->rsltn_engineer->BoundColumn, $this->rsltn_engineer->TextColumn, $this->rsltn_engineer->DBFormat) = array("id", "usr_fullname", "");
            $this->rsltn_engineer->DataSource->Parameters["expr20"] = 3;
            $this->rsltn_engineer->DataSource->wp = new clsSQLParameters();
            $this->rsltn_engineer->DataSource->wp->AddParameter("1", "expr20", ccsInteger, "", "", $this->rsltn_engineer->DataSource->Parameters["expr20"], "", false);
            $this->rsltn_engineer->DataSource->wp->Criterion[1] = $this->rsltn_engineer->DataSource->wp->Operation(opEqual, "usr_group", $this->rsltn_engineer->DataSource->wp->GetDBValue("1"), $this->rsltn_engineer->DataSource->ToSQL($this->rsltn_engineer->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->rsltn_engineer->DataSource->Where = 
                 $this->rsltn_engineer->DataSource->wp->Criterion[1];
            $this->rsltn_servicedate = & new clsControl(ccsTextBox, "rsltn_servicedate", "Service Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("rsltn_servicedate", $Method, NULL), $this);
            $this->rsltn_servicedate->Required = true;
            $this->DatePicker_rslt_servicedate = & new clsDatePicker("DatePicker_rslt_servicedate", "smart_resolution", "rsltn_servicedate", $this);
            $this->rsltn_serviceno = & new clsControl(ccsTextBox, "rsltn_serviceno", "Service No.", ccsText, "", CCGetRequestParam("rsltn_serviceno", $Method, NULL), $this);
            $this->rsltn_serviceno->Required = true;
            $this->rsltn_eta = & new clsControl(ccsTextBox, "rsltn_eta", "ETA", ccsDate, $DefaultDateFormat, CCGetRequestParam("rsltn_eta", $Method, NULL), $this);
            $this->DatePicker_rslt_eta = & new clsDatePicker("DatePicker_rslt_eta", "smart_resolution", "rsltn_eta", $this);
            $this->rsltn_etd = & new clsControl(ccsTextBox, "rsltn_etd", "ETD", ccsDate, $DefaultDateFormat, CCGetRequestParam("rsltn_etd", $Method, NULL), $this);
            $this->DatePicker_rslt_etd = & new clsDatePicker("DatePicker_rslt_etd", "smart_resolution", "rsltn_etd", $this);
            $this->ticketNumber = & new clsControl(ccsLabel, "ticketNumber", "ticketNumber", ccsText, "", CCGetRequestParam("ticketNumber", $Method, NULL), $this);
            $this->site = & new clsControl(ccsLabel, "site", "site", ccsText, "", CCGetRequestParam("site", $Method, NULL), $this);
            $this->ticketToppanid = & new clsControl(ccsTextBox, "ticketToppanid", "Toppan ID", ccsText, "", CCGetRequestParam("ticketToppanid", $Method, NULL), $this);
            $this->ticketRelated = & new clsControl(ccsTextBox, "ticketRelated", "Tag Related", ccsText, "", CCGetRequestParam("ticketRelated", $Method, NULL), $this);
            $this->rsltn_inspection = & new clsControl(ccsTextArea, "rsltn_inspection", "Inspection", ccsMemo, "", CCGetRequestParam("rsltn_inspection", $Method, NULL), $this);
            $this->rsltn_inspection->Required = true;
            $this->rsltn_action = & new clsControl(ccsTextArea, "rsltn_action", "Action", ccsMemo, "", CCGetRequestParam("rsltn_action", $Method, NULL), $this);
            $this->rsltn_action->Required = true;
            $this->rsltn_method = & new clsControl(ccsRadioButton, "rsltn_method", "Rslt Method", ccsText, "", CCGetRequestParam("rsltn_method", $Method, NULL), $this);
            $this->rsltn_method->DSType = dsListOfValues;
            $this->rsltn_method->Values = array(array("1", "Phone Call"), array("2", "Visit Site"), array("3", "Remote"));
            $this->rsltn_method->HTML = true;
            $this->rsltn_planning = & new clsControl(ccsTextArea, "rsltn_planning", "Rslt Planning", ccsMemo, "", CCGetRequestParam("rsltn_planning", $Method, NULL), $this);
            $this->rsltn_remark = & new clsControl(ccsTextArea, "rsltn_remark", "Rslt Remark", ccsMemo, "", CCGetRequestParam("rsltn_remark", $Method, NULL), $this);
            $this->rsltnId = & new clsControl(ccsLabel, "rsltnId", "rsltnId", ccsText, "", CCGetRequestParam("rsltnId", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsTextBox, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->datemodified->Value) && !strlen($this->datemodified->Value) && $this->datemodified->Value !== false)
                    $this->datemodified->SetValue(time());
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

//Validate Method @12-21F4B548
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
        $Validation = ($this->rsltn_method->Validate() && $Validation);
        $Validation = ($this->rsltn_planning->Validate() && $Validation);
        $Validation = ($this->rsltn_remark->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
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
        $Validation =  $Validation && ($this->rsltn_method->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_planning->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rsltn_remark->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @12-52D374D5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_date->Errors->Count());
        $errors = ($errors || $this->rsltn_engineer->Errors->Count());
        $errors = ($errors || $this->rsltn_servicedate->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_servicedate->Errors->Count());
        $errors = ($errors || $this->rsltn_serviceno->Errors->Count());
        $errors = ($errors || $this->rsltn_eta->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_eta->Errors->Count());
        $errors = ($errors || $this->rsltn_etd->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_etd->Errors->Count());
        $errors = ($errors || $this->ticketNumber->Errors->Count());
        $errors = ($errors || $this->site->Errors->Count());
        $errors = ($errors || $this->ticketToppanid->Errors->Count());
        $errors = ($errors || $this->ticketRelated->Errors->Count());
        $errors = ($errors || $this->rsltn_inspection->Errors->Count());
        $errors = ($errors || $this->rsltn_action->Errors->Count());
        $errors = ($errors || $this->rsltn_method->Errors->Count());
        $errors = ($errors || $this->rsltn_planning->Errors->Count());
        $errors = ($errors || $this->rsltn_remark->Errors->Count());
        $errors = ($errors || $this->rsltnId->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
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

//InsertRow Method @12-F453BB10
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
        $this->DataSource->rsltn_method->SetValue($this->rsltn_method->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->rsltnId->SetValue($this->rsltnId->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @12-AB4936EF
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
        $this->DataSource->rsltn_method->SetValue($this->rsltn_method->GetValue(true));
        $this->DataSource->rsltn_planning->SetValue($this->rsltn_planning->GetValue(true));
        $this->DataSource->rsltn_remark->SetValue($this->rsltn_remark->GetValue(true));
        $this->DataSource->rsltnId->SetValue($this->rsltnId->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @12-256CF024
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
        $this->rsltn_method->Prepare();

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
                    $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
                    $this->rsltn_engineer->SetValue($this->DataSource->rsltn_engineer->GetValue());
                    $this->rsltn_servicedate->SetValue($this->DataSource->rsltn_servicedate->GetValue());
                    $this->rsltn_serviceno->SetValue($this->DataSource->rsltn_serviceno->GetValue());
                    $this->rsltn_eta->SetValue($this->DataSource->rsltn_eta->GetValue());
                    $this->rsltn_etd->SetValue($this->DataSource->rsltn_etd->GetValue());
                    $this->rsltn_inspection->SetValue($this->DataSource->rsltn_inspection->GetValue());
                    $this->rsltn_action->SetValue($this->DataSource->rsltn_action->GetValue());
                    $this->rsltn_method->SetValue($this->DataSource->rsltn_method->GetValue());
                    $this->rsltn_planning->SetValue($this->DataSource->rsltn_planning->GetValue());
                    $this->rsltn_remark->SetValue($this->DataSource->rsltn_remark->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
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
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_serviceno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_eta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_eta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_etd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_etd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketToppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketRelated->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_inspection->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_method->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltn_remark->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rsltnId->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
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
        $this->DatePicker_rslt_date->Show();
        $this->rsltn_engineer->Show();
        $this->rsltn_servicedate->Show();
        $this->DatePicker_rslt_servicedate->Show();
        $this->rsltn_serviceno->Show();
        $this->rsltn_eta->Show();
        $this->DatePicker_rslt_eta->Show();
        $this->rsltn_etd->Show();
        $this->DatePicker_rslt_etd->Show();
        $this->ticketNumber->Show();
        $this->site->Show();
        $this->ticketToppanid->Show();
        $this->ticketRelated->Show();
        $this->rsltn_inspection->Show();
        $this->rsltn_action->Show();
        $this->rsltn_method->Show();
        $this->rsltn_planning->Show();
        $this->rsltn_remark->Show();
        $this->rsltnId->Show();
        $this->datemodified->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_resolution Class @12-FCB6E20C

class clsresolutionnotessmart_resolutionDataSource extends clsDBSMART {  //smart_resolutionDataSource Class @12-577E5328

//DataSource Variables @12-7B320B83
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
    var $rsltn_method;
    var $rsltn_planning;
    var $rsltn_remark;
    var $rsltnId;
    var $datemodified;
//End DataSource Variables

//DataSourceClass_Initialize Event @12-5E8A028E
    function clsresolutionnotessmart_resolutionDataSource(& $Parent)
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
        
        $this->rsltn_method = new clsField("rsltn_method", ccsText, "");
        
        $this->rsltn_planning = new clsField("rsltn_planning", ccsMemo, "");
        
        $this->rsltn_remark = new clsField("rsltn_remark", ccsMemo, "");
        
        $this->rsltnId = new clsField("rsltnId", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        

        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_servicedate"] = array("Name" => "rsltn_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_servicennumber"] = array("Name" => "rsltn_servicennumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_eta"] = array("Name" => "rsltn_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_etd"] = array("Name" => "rsltn_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_inspection"] = array("Name" => "rsltn_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_date"] = array("Name" => "rsltn_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_byuser"] = array("Name" => "rsltn_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_servicedate"] = array("Name" => "rsltn_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_servicennumber"] = array("Name" => "rsltn_servicennumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_eta"] = array("Name" => "rsltn_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_etd"] = array("Name" => "rsltn_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_inspection"] = array("Name" => "rsltn_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actiontaken"] = array("Name" => "rsltn_actiontaken", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_actionmethod"] = array("Name" => "rsltn_actionmethod", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_planning"] = array("Name" => "rsltn_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rsltn_remark"] = array("Name" => "rsltn_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
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

//SetValues Method @12-AC777F79
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_engineer->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_servicedate->SetDBValue(trim($this->f("rsltn_servicedate")));
        $this->rsltn_serviceno->SetDBValue($this->f("rsltn_servicennumber"));
        $this->rsltn_eta->SetDBValue(trim($this->f("rsltn_eta")));
        $this->rsltn_etd->SetDBValue(trim($this->f("rsltn_etd")));
        $this->rsltn_inspection->SetDBValue($this->f("rsltn_inspection"));
        $this->rsltn_action->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_method->SetDBValue($this->f("rsltn_actionmethod"));
        $this->rsltn_planning->SetDBValue($this->f("rsltn_planning"));
        $this->rsltn_remark->SetDBValue($this->f("rsltn_remark"));
        $this->rsltnId->SetDBValue($this->f("id"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
    }
//End SetValues Method

//Insert Method @12-ED5D8215
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->InsertFields["rsltn_byuser"]["Value"] = $this->rsltn_engineer->GetDBValue(true);
        $this->InsertFields["rsltn_servicedate"]["Value"] = $this->rsltn_servicedate->GetDBValue(true);
        $this->InsertFields["rsltn_servicennumber"]["Value"] = $this->rsltn_serviceno->GetDBValue(true);
        $this->InsertFields["rsltn_eta"]["Value"] = $this->rsltn_eta->GetDBValue(true);
        $this->InsertFields["rsltn_etd"]["Value"] = $this->rsltn_etd->GetDBValue(true);
        $this->InsertFields["rsltn_inspection"]["Value"] = $this->rsltn_inspection->GetDBValue(true);
        $this->InsertFields["rsltn_actiontaken"]["Value"] = $this->rsltn_action->GetDBValue(true);
        $this->InsertFields["rsltn_actionmethod"]["Value"] = $this->rsltn_method->GetDBValue(true);
        $this->InsertFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->InsertFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_resolutionnote", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @12-C7CFD400
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["rsltn_date"]["Value"] = $this->rsltn_date->GetDBValue(true);
        $this->UpdateFields["rsltn_byuser"]["Value"] = $this->rsltn_engineer->GetDBValue(true);
        $this->UpdateFields["rsltn_servicedate"]["Value"] = $this->rsltn_servicedate->GetDBValue(true);
        $this->UpdateFields["rsltn_servicennumber"]["Value"] = $this->rsltn_serviceno->GetDBValue(true);
        $this->UpdateFields["rsltn_eta"]["Value"] = $this->rsltn_eta->GetDBValue(true);
        $this->UpdateFields["rsltn_etd"]["Value"] = $this->rsltn_etd->GetDBValue(true);
        $this->UpdateFields["rsltn_inspection"]["Value"] = $this->rsltn_inspection->GetDBValue(true);
        $this->UpdateFields["rsltn_actiontaken"]["Value"] = $this->rsltn_action->GetDBValue(true);
        $this->UpdateFields["rsltn_actionmethod"]["Value"] = $this->rsltn_method->GetDBValue(true);
        $this->UpdateFields["rsltn_planning"]["Value"] = $this->rsltn_planning->GetDBValue(true);
        $this->UpdateFields["rsltn_remark"]["Value"] = $this->rsltn_remark->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
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

class clsGridresolutionnotessmart_equipment { //smart_equipment class @41-441EA45B

//Variables @41-AC1EDBB9

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

//Class_Initialize Event @41-CA7C1C9F
    function clsGridresolutionnotessmart_equipment($RelativePath, & $Parent)
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
        $this->DataSource = new clsresolutionnotessmart_equipmentDataSource($this);
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

        $this->eqmt_type = & new clsControl(ccsLabel, "eqmt_type", "eqmt_type", ccsInteger, "", CCGetRequestParam("eqmt_type", ccsGet, NULL), $this);
        $this->eqmt_serialno = & new clsControl(ccsLink, "eqmt_serialno", "eqmt_serialno", ccsText, "", CCGetRequestParam("eqmt_serialno", ccsGet, NULL), $this);
        $this->eqmt_serialno->Page = $this->RelativePath . "ticketactivity.php";
        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->btnNewRec = & new clsControl(ccsImageLink, "btnNewRec", "btnNewRec", ccsText, "", CCGetRequestParam("btnNewRec", ccsGet, NULL), $this);
        $this->btnNewRec->Page = "javascript:OpenFormEq();";
        $this->querystring = & new clsControl(ccsHidden, "querystring", "querystring", ccsText, "", CCGetRequestParam("querystring", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @41-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @41-C67ADFEA
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
            $this->ControlsVisible["eqmt_type"] = $this->eqmt_type->Visible;
            $this->ControlsVisible["eqmt_serialno"] = $this->eqmt_serialno->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
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
                $this->eqmt_type->SetValue($this->DataSource->eqmt_type->GetValue());
                $this->eqmt_serialno->SetValue($this->DataSource->eqmt_serialno->GetValue());
                $this->eqmt_serialno->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->eqmt_serialno->Parameters = CCAddParam($this->eqmt_serialno->Parameters, "tcktid", CCGetFromGet("tcktid", NULL));
                $this->eqmt_serialno->Parameters = CCAddParam($this->eqmt_serialno->Parameters, "rid", CCGetFromGet("rid", NULL));
                $this->eqmt_serialno->Parameters = CCAddParam($this->eqmt_serialno->Parameters, "eqid", $this->DataSource->f("equipment_id"));
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->eqmt_type->Show();
                $this->eqmt_serialno->Show();
                $this->id->Show();
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
        $this->btnNewRec->Show();
        $this->querystring->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @41-A8A0AC14
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->eqmt_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqmt_serialno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_equipment Class @41-FCB6E20C

class clsresolutionnotessmart_equipmentDataSource extends clsDBSMART {  //smart_equipmentDataSource Class @41-1BE04F4A

//DataSource Variables @41-66F4B6C9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $eqmt_type;
    var $eqmt_serialno;
    var $id;
//End DataSource Variables

//DataSourceClass_Initialize Event @41-800EF5DF
    function clsresolutionnotessmart_equipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_equipment";
        $this->Initialize();
        $this->eqmt_type = new clsField("eqmt_type", ccsInteger, "");
        
        $this->eqmt_serialno = new clsField("eqmt_serialno", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @41-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @41-EEC6E747
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @41-3D546EF6
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

//SetValues Method @41-8DE664C4
    function SetValues()
    {
        $this->eqmt_type->SetDBValue(trim($this->f("equipment_id")));
        $this->eqmt_serialno->SetDBValue($this->f("flty_serialnumber"));
        $this->id->SetDBValue(trim($this->f("id")));
    }
//End SetValues Method

} //End smart_equipmentDataSource Class @41-FCB6E20C

class clsRecordresolutionnotessmart_faultyequipment { //smart_faultyequipment Class @137-74FC5B13

//Variables @137-D6FF3E86

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

//Class_Initialize Event @137-C4AAA21F
    function clsRecordresolutionnotessmart_faultyequipment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_faultyequipment/Error";
        $this->DataSource = new clsresolutionnotessmart_faultyequipmentDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_faultyequipment";
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
            $this->flty_date = & new clsControl(ccsTextBox, "flty_date", "Flty Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("flty_date", $Method, NULL), $this);
            $this->DatePicker_flty_date = & new clsDatePicker("DatePicker_flty_date", "smart_faultyequipment", "flty_date", $this);
            $this->flty_byuser = & new clsControl(ccsListBox, "flty_byuser", "Flty Byuser", ccsInteger, "", CCGetRequestParam("flty_byuser", $Method, NULL), $this);
            $this->flty_byuser->DSType = dsTable;
            $this->flty_byuser->DataSource = new clsDBSMART();
            $this->flty_byuser->ds = & $this->flty_byuser->DataSource;
            $this->flty_byuser->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->flty_byuser->BoundColumn, $this->flty_byuser->TextColumn, $this->flty_byuser->DBFormat) = array("id", "usr_fullname", "");
            $this->flty_byuser->DataSource->Parameters["expr145"] = 4;
            $this->flty_byuser->DataSource->wp = new clsSQLParameters();
            $this->flty_byuser->DataSource->wp->AddParameter("1", "expr145", ccsInteger, "", "", $this->flty_byuser->DataSource->Parameters["expr145"], "", false);
            $this->flty_byuser->DataSource->wp->Criterion[1] = $this->flty_byuser->DataSource->wp->Operation(opLessThanOrEqual, "usr_group", $this->flty_byuser->DataSource->wp->GetDBValue("1"), $this->flty_byuser->DataSource->ToSQL($this->flty_byuser->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->flty_byuser->DataSource->Where = 
                 $this->flty_byuser->DataSource->wp->Criterion[1];
            $this->resolution_id = & new clsControl(ccsHidden, "resolution_id", "Resolution Id", ccsInteger, "", CCGetRequestParam("resolution_id", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsHidden, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->eqpmt_serialnumber = & new clsControl(ccsTextBox, "eqpmt_serialnumber", "eqpmt_serialnumber", ccsText, "", CCGetRequestParam("eqpmt_serialnumber", $Method, NULL), $this);
            $this->eqpmt_name = & new clsControl(ccsListBox, "eqpmt_name", "eqpmt_name", ccsText, "", CCGetRequestParam("eqpmt_name", $Method, NULL), $this);
            $this->eqpmt_name->DSType = dsTable;
            $this->eqpmt_name->DataSource = new clsDBSMART();
            $this->eqpmt_name->ds = & $this->eqpmt_name->DataSource;
            $this->eqpmt_name->DataSource->SQL = "SELECT * \n" .
"FROM smart_equipment {SQL_Where} {SQL_OrderBy}";
            list($this->eqpmt_name->BoundColumn, $this->eqpmt_name->TextColumn, $this->eqpmt_name->DBFormat) = array("id", "eqpmt_name", "");
        }
    }
//End Class_Initialize Event

//Initialize Method @137-CE188E9B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlrid"] = CCGetFromGet("rid", NULL);
        $this->DataSource->Parameters["urlqpid"] = CCGetFromGet("qpid", NULL);
    }
//End Initialize Method

//Validate Method @137-E3AC11A5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->flty_date->Validate() && $Validation);
        $Validation = ($this->flty_byuser->Validate() && $Validation);
        $Validation = ($this->resolution_id->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->eqpmt_serialnumber->Validate() && $Validation);
        $Validation = ($this->eqpmt_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->flty_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->flty_byuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resolution_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eqpmt_serialnumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eqpmt_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @137-67F816A5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->flty_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_flty_date->Errors->Count());
        $errors = ($errors || $this->flty_byuser->Errors->Count());
        $errors = ($errors || $this->resolution_id->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->eqpmt_serialnumber->Errors->Count());
        $errors = ($errors || $this->eqpmt_name->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @137-ED598703
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

//Operation Method @137-0BF2B389
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

//InsertRow Method @137-82BB1325
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->flty_date->SetValue($this->flty_date->GetValue(true));
        $this->DataSource->flty_byuser->SetValue($this->flty_byuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->eqpmt_serialnumber->SetValue($this->eqpmt_serialnumber->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @137-410AED9B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->flty_date->SetValue($this->flty_date->GetValue(true));
        $this->DataSource->flty_byuser->SetValue($this->flty_byuser->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->eqpmt_serialnumber->SetValue($this->eqpmt_serialnumber->GetValue(true));
        $this->DataSource->eqpmt_name->SetValue($this->eqpmt_name->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @137-951A90D4
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

        $this->flty_byuser->Prepare();
        $this->eqpmt_name->Prepare();

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
                    $this->flty_date->SetValue($this->DataSource->flty_date->GetValue());
                    $this->flty_byuser->SetValue($this->DataSource->flty_byuser->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->eqpmt_serialnumber->SetValue($this->DataSource->eqpmt_serialnumber->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->flty_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_flty_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->flty_byuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resolution_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eqpmt_serialnumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eqpmt_name->Errors->ToString());
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
        $this->flty_date->Show();
        $this->DatePicker_flty_date->Show();
        $this->flty_byuser->Show();
        $this->resolution_id->Show();
        $this->datemodified->Show();
        $this->eqpmt_serialnumber->Show();
        $this->eqpmt_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_faultyequipment Class @137-FCB6E20C

class clsresolutionnotessmart_faultyequipmentDataSource extends clsDBSMART {  //smart_faultyequipmentDataSource Class @137-618832CB

//DataSource Variables @137-AE5E78D3
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
    var $flty_date;
    var $flty_byuser;
    var $resolution_id;
    var $datemodified;
    var $eqpmt_serialnumber;
    var $eqpmt_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @137-6A2550F0
    function clsresolutionnotessmart_faultyequipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_faultyequipment/Error";
        $this->Initialize();
        $this->flty_date = new clsField("flty_date", ccsDate, $this->DateFormat);
        
        $this->flty_byuser = new clsField("flty_byuser", ccsInteger, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->eqpmt_serialnumber = new clsField("eqpmt_serialnumber", ccsText, "");
        
        $this->eqpmt_name = new clsField("eqpmt_name", ccsText, "");
        

        $this->InsertFields["flty_date"] = array("Name" => "flty_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["flty_byuser"] = array("Name" => "flty_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_date"] = array("Name" => "flty_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_byuser"] = array("Name" => "flty_byuser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["flty_serialnumber"] = array("Name" => "flty_serialnumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @137-9D874FDF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->AddParameter("2", "urlqpid", ccsInteger, "", "", $this->Parameters["urlqpid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @137-3CFEAF84
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_faultyequipment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @137-AEF0C57A
    function SetValues()
    {
        $this->flty_date->SetDBValue(trim($this->f("flty_date")));
        $this->flty_byuser->SetDBValue(trim($this->f("flty_byuser")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->eqpmt_serialnumber->SetDBValue($this->f("flty_serialnumber"));
    }
//End SetValues Method

//Insert Method @137-F126C3C3
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["flty_date"]["Value"] = $this->flty_date->GetDBValue(true);
        $this->InsertFields["flty_byuser"]["Value"] = $this->flty_byuser->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["flty_serialnumber"]["Value"] = $this->eqpmt_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_faultyequipment", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @137-FFE8130D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["flty_date"]["Value"] = $this->flty_date->GetDBValue(true);
        $this->UpdateFields["flty_byuser"]["Value"] = $this->flty_byuser->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["flty_serialnumber"]["Value"] = $this->eqpmt_serialnumber->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_faultyequipment", $this->UpdateFields, $this);
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

} //End smart_faultyequipmentDataSource Class @137-FCB6E20C



class clsGridresolutionnotessmart_measurement { //smart_measurement class @45-26BF40F1

//Variables @45-AC1EDBB9

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

//Class_Initialize Event @45-4268D501
    function clsGridresolutionnotessmart_measurement($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_measurement";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_measurement";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsresolutionnotessmart_measurementDataSource($this);
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
        $this->msre_item = & new clsControl(ccsLabel, "msre_item", "msre_item", ccsText, "", CCGetRequestParam("msre_item", ccsGet, NULL), $this);
        $this->msre_before = & new clsControl(ccsLabel, "msre_before", "msre_before", ccsSingle, "", CCGetRequestParam("msre_before", ccsGet, NULL), $this);
        $this->msre_after = & new clsControl(ccsLabel, "msre_after", "msre_after", ccsSingle, "", CCGetRequestParam("msre_after", ccsGet, NULL), $this);
        $this->msre_remark = & new clsControl(ccsLabel, "msre_remark", "msre_remark", ccsMemo, "", CCGetRequestParam("msre_remark", ccsGet, NULL), $this);
        $this->btnNewRec = & new clsControl(ccsImageLink, "btnNewRec", "btnNewRec", ccsText, "", CCGetRequestParam("btnNewRec", ccsGet, NULL), $this);
        $this->btnNewRec->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->btnNewRec->Page = "#";
    }
//End Class_Initialize Event

//Initialize Method @45-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @45-643E79C8
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
            $this->ControlsVisible["msre_item"] = $this->msre_item->Visible;
            $this->ControlsVisible["msre_before"] = $this->msre_before->Visible;
            $this->ControlsVisible["msre_after"] = $this->msre_after->Visible;
            $this->ControlsVisible["msre_remark"] = $this->msre_remark->Visible;
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
                $this->msre_item->SetValue($this->DataSource->msre_item->GetValue());
                $this->msre_before->SetValue($this->DataSource->msre_before->GetValue());
                $this->msre_after->SetValue($this->DataSource->msre_after->GetValue());
                $this->msre_remark->SetValue($this->DataSource->msre_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->msre_item->Show();
                $this->msre_before->Show();
                $this->msre_after->Show();
                $this->msre_remark->Show();
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
        $this->btnNewRec->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @45-790EF7DA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_item->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_before->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_after->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_measurement Class @45-FCB6E20C

class clsresolutionnotessmart_measurementDataSource extends clsDBSMART {  //smart_measurementDataSource Class @45-CDA8700C

//DataSource Variables @45-6EF57830
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lblNumber;
    var $msre_item;
    var $msre_before;
    var $msre_after;
    var $msre_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @45-32B719BB
    function clsresolutionnotessmart_measurementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_measurement";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->msre_item = new clsField("msre_item", ccsText, "");
        
        $this->msre_before = new clsField("msre_before", ccsSingle, "");
        
        $this->msre_after = new clsField("msre_after", ccsSingle, "");
        
        $this->msre_remark = new clsField("msre_remark", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @45-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @45-EEC6E747
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @45-41EF7335
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

//SetValues Method @45-8568194E
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->msre_item->SetDBValue($this->f("msre_item"));
        $this->msre_before->SetDBValue(trim($this->f("msre_before")));
        $this->msre_after->SetDBValue(trim($this->f("msre_after")));
        $this->msre_remark->SetDBValue($this->f("msre_remark"));
    }
//End SetValues Method

} //End smart_measurementDataSource Class @45-FCB6E20C

class clsGridresolutionnotessmart_replacement { //smart_replacement class @51-DA7EFDA1

//Variables @51-AC1EDBB9

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

//Class_Initialize Event @51-E5CF3567
    function clsGridresolutionnotessmart_replacement($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_replacement";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_replacement";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsresolutionnotessmart_replacementDataSource($this);
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
        $this->equipment_id = & new clsControl(ccsLabel, "equipment_id", "equipment_id", ccsInteger, "", CCGetRequestParam("equipment_id", ccsGet, NULL), $this);
        $this->equipment_serialno = & new clsControl(ccsLabel, "equipment_serialno", "equipment_serialno", ccsInteger, "", CCGetRequestParam("equipment_serialno", ccsGet, NULL), $this);
        $this->rplc_serialnumber = & new clsControl(ccsLabel, "rplc_serialnumber", "rplc_serialnumber", ccsText, "", CCGetRequestParam("rplc_serialnumber", ccsGet, NULL), $this);
        $this->rplc_remark = & new clsControl(ccsLabel, "rplc_remark", "rplc_remark", ccsMemo, "", CCGetRequestParam("rplc_remark", ccsGet, NULL), $this);
        $this->rplc_method = & new clsControl(ccsLabel, "rplc_method", "rplc_method", ccsText, "", CCGetRequestParam("rplc_method", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->btnNewRec = & new clsControl(ccsImageLink, "btnNewRec", "btnNewRec", ccsText, "", CCGetRequestParam("btnNewRec", ccsGet, NULL), $this);
        $this->btnNewRec->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->btnNewRec->Page = "#";
    }
//End Class_Initialize Event

//Initialize Method @51-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @51-34DFFA14
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
            $this->ControlsVisible["rplc_remark"] = $this->rplc_remark->Visible;
            $this->ControlsVisible["rplc_method"] = $this->rplc_method->Visible;
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
                $this->rplc_serialnumber->SetValue($this->DataSource->rplc_serialnumber->GetValue());
                $this->rplc_remark->SetValue($this->DataSource->rplc_remark->GetValue());
                $this->rplc_method->SetValue($this->DataSource->rplc_method->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->equipment_id->Show();
                $this->equipment_serialno->Show();
                $this->rplc_serialnumber->Show();
                $this->rplc_remark->Show();
                $this->rplc_method->Show();
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
        $this->btnNewRec->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @51-54FC408D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipment_serialno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_serialnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplc_method->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_replacement Class @51-FCB6E20C

class clsresolutionnotessmart_replacementDataSource extends clsDBSMART {  //smart_replacementDataSource Class @51-3CC2584A

//DataSource Variables @51-DF3F4733
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
    var $rplc_serialnumber;
    var $rplc_remark;
    var $rplc_method;
//End DataSource Variables

//DataSourceClass_Initialize Event @51-6BB5FBBB
    function clsresolutionnotessmart_replacementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_replacement";
        $this->Initialize();
        $this->lblNumber = new clsField("lblNumber", ccsInteger, "");
        
        $this->equipment_id = new clsField("equipment_id", ccsInteger, "");
        
        $this->rplc_serialnumber = new clsField("rplc_serialnumber", ccsText, "");
        
        $this->rplc_remark = new clsField("rplc_remark", ccsMemo, "");
        
        $this->rplc_method = new clsField("rplc_method", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @51-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @51-EEC6E747
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlrid", ccsInteger, "", "", $this->Parameters["urlrid"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resolution_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @51-CDB46B33
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

//SetValues Method @51-64C7F899
    function SetValues()
    {
        $this->lblNumber->SetDBValue(trim($this->f("id")));
        $this->equipment_id->SetDBValue(trim($this->f("faultyequipment_id")));
        $this->rplc_serialnumber->SetDBValue($this->f("rplc_serialnumber"));
        $this->rplc_remark->SetDBValue($this->f("rplc_remark"));
        $this->rplc_method->SetDBValue($this->f("rplc_method"));
    }
//End SetValues Method

} //End smart_replacementDataSource Class @51-FCB6E20C



class clsresolutionnotes { //resolutionnotes class @1-EF7F1DA8

//Variables @1-9721D5A2
    var $ComponentType = "IncludablePage";
    var $Connections = array();
    var $FileName = "";
    var $Redirect = "";
    var $Tpl = "";
    var $TemplateFileName = "";
    var $BlockToParse = "";
    var $ComponentName = "";
    var $Attributes = "";

    // Events;
    var $CCSEvents = "";
    var $CCSEventResult = "";
    var $RelativePath;
    var $Visible;
    var $Parent;
//End Variables

//Class_Initialize Event @1-683BB738
    function clsresolutionnotes($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "resolutionnotes.php";
        $this->Redirect = "";
        $this->TemplateFileName = "resolutionnotes.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-9E0D8EFA
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->smart_resolution);
        unset($this->smart_equipment);
        unset($this->smart_faultyequipment);
        unset($this->smart_measurement);
        unset($this->smart_replacement);
    }
//End Class_Terminate Event

//BindEvents Method @1-D3F72B79
    function BindEvents()
    {
        $this->smart_resolution->Button_Insert->CCSEvents["OnClick"] = "resolutionnotes_smart_resolution_Button_Insert_OnClick";
        $this->smart_resolution->CCSEvents["BeforeShow"] = "resolutionnotes_smart_resolution_BeforeShow";
        $this->smart_resolution->CCSEvents["AfterInsert"] = "resolutionnotes_smart_resolution_AfterInsert";
        $this->TabCMActivity->CCSEvents["BeforeShow"] = "resolutionnotes_TabCMActivity_BeforeShow";
        $this->smart_equipment->CCSEvents["BeforeShow"] = "resolutionnotes_smart_equipment_BeforeShow";
        $this->smart_faultyequipment->CCSEvents["BeforeShow"] = "resolutionnotes_smart_faultyequipment_BeforeShow";
        $this->Panel2->CCSEvents["BeforeShow"] = "resolutionnotes_Panel2_BeforeShow";
        $this->TabEquipment->CCSEvents["BeforeShow"] = "resolutionnotes_TabEquipment_BeforeShow";
        $this->TabSparePart->CCSEvents["BeforeShow"] = "resolutionnotes_TabSparePart_BeforeShow";
        $this->TabReplacement->CCSEvents["BeforeShow"] = "resolutionnotes_TabReplacement_BeforeShow";
        $this->Panel1->CCSEvents["BeforeShow"] = "resolutionnotes_Panel1_BeforeShow";
        $this->CCSEvents["AfterInitialize"] = "resolutionnotes_AfterInitialize";
        $this->CCSEvents["BeforeShow"] = "resolutionnotes_BeforeShow";
        $this->CCSEvents["BeforeOutput"] = "resolutionnotes_BeforeOutput";
        $this->CCSEvents["BeforeUnload"] = "resolutionnotes_BeforeUnload";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-0DD4A863
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->smart_resolution->Operation();
        $this->smart_faultyequipment->Operation();
    }
//End Operations Method

//Initialize Method @1-D5854840
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEvents["BeforeInitialize"] = "resolutionnotes_BeforeInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBSMART = new clsDBSMART();
        $this->Connections["SMART"] = & $this->DBSMART;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->Panel1 = & new clsPanel("Panel1", $this);
        $this->TabCMActivity = & new clsPanel("TabCMActivity", $this);
        $this->smart_resolution = & new clsRecordresolutionnotessmart_resolution($this->RelativePath, $this);
        $this->TabEquipment = & new clsPanel("TabEquipment", $this);
        $this->Panel2 = & new clsPanel("Panel2", $this);
        $this->smart_equipment = & new clsGridresolutionnotessmart_equipment($this->RelativePath, $this);
        $this->smart_faultyequipment = & new clsRecordresolutionnotessmart_faultyequipment($this->RelativePath, $this);
        $this->TabSparePart = & new clsPanel("TabSparePart", $this);
        $this->smart_measurement = & new clsGridresolutionnotessmart_measurement($this->RelativePath, $this);
        $this->TabReplacement = & new clsPanel("TabReplacement", $this);
        $this->smart_replacement = & new clsGridresolutionnotessmart_replacement($this->RelativePath, $this);
        $this->Panel1->AddComponent("TabCMActivity", $this->TabCMActivity);
        $this->Panel1->AddComponent("TabEquipment", $this->TabEquipment);
        $this->Panel1->AddComponent("TabSparePart", $this->TabSparePart);
        $this->Panel1->AddComponent("TabReplacement", $this->TabReplacement);
        $this->TabCMActivity->AddComponent("smart_resolution", $this->smart_resolution);
        $this->TabEquipment->AddComponent("Panel2", $this->Panel2);
        $this->Panel2->AddComponent("smart_equipment", $this->smart_equipment);
        $this->Panel2->AddComponent("smart_faultyequipment", $this->smart_faultyequipment);
        $this->TabSparePart->AddComponent("smart_measurement", $this->smart_measurement);
        $this->TabReplacement->AddComponent("smart_replacement", $this->smart_replacement);
        $this->smart_resolution->Initialize();
        $this->smart_equipment->Initialize();
        $this->smart_faultyequipment->Initialize();
        $this->smart_measurement->Initialize();
        $this->smart_replacement->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-4DF75150
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->Panel1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End resolutionnotes Class @1-FCB6E20C

//Include Event File @1-DE71C125
include_once(RelativePath . "/resolutionnotes_events.php");
//End Include Event File


?>
