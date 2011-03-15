<?php
//Include Common Files @1-1D635787
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "testtemplate.php");
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

class clsGridsmart_customer { //smart_customer class @5-62674B20

//Variables @5-1E4FDFB1

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
    var $Sorter_id;
    var $Sorter_ticket_id;
    var $Sorter_resolution_id;
    var $Sorter_cust_fullname;
    var $Sorter_cust_phone;
//End Variables

//Class_Initialize Event @5-EBE51118
    function clsGridsmart_customer($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_customer";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_customer";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssmart_customerDataSource($this);
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
        $this->SorterName = CCGetParam("smart_customerOrder", "");
        $this->SorterDirection = CCGetParam("smart_customerDir", "");

        $this->id = & new clsControl(ccsLink, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->id->Page = "testtemplate.php";
        $this->ticket_id = & new clsControl(ccsLabel, "ticket_id", "ticket_id", ccsInteger, "", CCGetRequestParam("ticket_id", ccsGet, NULL), $this);
        $this->resolution_id = & new clsControl(ccsLabel, "resolution_id", "resolution_id", ccsInteger, "", CCGetRequestParam("resolution_id", ccsGet, NULL), $this);
        $this->cust_fullname = & new clsControl(ccsLabel, "cust_fullname", "cust_fullname", ccsText, "", CCGetRequestParam("cust_fullname", ccsGet, NULL), $this);
        $this->cust_phone = & new clsControl(ccsLabel, "cust_phone", "cust_phone", ccsText, "", CCGetRequestParam("cust_phone", ccsGet, NULL), $this);
        $this->smart_customer_Insert = & new clsControl(ccsLink, "smart_customer_Insert", "smart_customer_Insert", ccsText, "", CCGetRequestParam("smart_customer_Insert", ccsGet, NULL), $this);
        $this->smart_customer_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->smart_customer_Insert->Page = "testtemplate.php";
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_ticket_id = & new clsSorter($this->ComponentName, "Sorter_ticket_id", $FileName, $this);
        $this->Sorter_resolution_id = & new clsSorter($this->ComponentName, "Sorter_resolution_id", $FileName, $this);
        $this->Sorter_cust_fullname = & new clsSorter($this->ComponentName, "Sorter_cust_fullname", $FileName, $this);
        $this->Sorter_cust_phone = & new clsSorter($this->ComponentName, "Sorter_cust_phone", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @5-518E7E3C
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
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["ticket_id"] = $this->ticket_id->Visible;
            $this->ControlsVisible["resolution_id"] = $this->resolution_id->Visible;
            $this->ControlsVisible["cust_fullname"] = $this->cust_fullname->Visible;
            $this->ControlsVisible["cust_phone"] = $this->cust_phone->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id->Parameters = CCAddParam($this->id->Parameters, "id", $this->DataSource->f("id"));
                $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                $this->cust_fullname->SetValue($this->DataSource->cust_fullname->GetValue());
                $this->cust_phone->SetValue($this->DataSource->cust_phone->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->ticket_id->Show();
                $this->resolution_id->Show();
                $this->cust_fullname->Show();
                $this->cust_phone->Show();
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
        $this->smart_customer_Insert->Show();
        $this->Sorter_id->Show();
        $this->Sorter_ticket_id->Show();
        $this->Sorter_resolution_id->Show();
        $this->Sorter_cust_fullname->Show();
        $this->Sorter_cust_phone->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-EB93FE53
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ticket_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resolution_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cust_fullname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cust_phone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_customer Class @5-FCB6E20C

class clssmart_customerDataSource extends clsDBSMART {  //smart_customerDataSource Class @5-50B0389E

//DataSource Variables @5-549F28B8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $ticket_id;
    var $resolution_id;
    var $cust_fullname;
    var $cust_phone;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-B0408FE0
    function clssmart_customerDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_customer";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->cust_fullname = new clsField("cust_fullname", ccsText, "");
        
        $this->cust_phone = new clsField("cust_phone", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-128A958F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("id", ""), 
            "Sorter_ticket_id" => array("ticket_id", ""), 
            "Sorter_resolution_id" => array("resolution_id", ""), 
            "Sorter_cust_fullname" => array("cust_fullname", ""), 
            "Sorter_cust_phone" => array("cust_phone", "")));
    }
//End SetOrder Method

//Prepare Method @5-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @5-0D5733E1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_customer";
        $this->SQL = "SELECT id, ticket_id, resolution_id, cust_fullname, cust_phone \n\n" .
        "FROM smart_customer {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-310B31AA
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->cust_fullname->SetDBValue($this->f("cust_fullname"));
        $this->cust_phone->SetDBValue($this->f("cust_phone"));
    }
//End SetValues Method

} //End smart_customerDataSource Class @5-FCB6E20C

class clsRecordsmart_customer1 { //smart_customer1 Class @24-83244848

//Variables @24-D6FF3E86

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

//Class_Initialize Event @24-D485DBDE
    function clsRecordsmart_customer1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_customer1/Error";
        $this->DataSource = new clssmart_customer1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_customer1";
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
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->ticket_id = & new clsControl(ccsTextBox, "ticket_id", "Ticket Id", ccsInteger, "", CCGetRequestParam("ticket_id", $Method, NULL), $this);
            $this->ticket_id->Required = true;
            $this->resolution_id = & new clsControl(ccsTextBox, "resolution_id", "Resolution Id", ccsInteger, "", CCGetRequestParam("resolution_id", $Method, NULL), $this);
            $this->resolution_id->Required = true;
            $this->cust_fullname = & new clsControl(ccsTextBox, "cust_fullname", "Cust Fullname", ccsText, "", CCGetRequestParam("cust_fullname", $Method, NULL), $this);
            $this->cust_fullname->Required = true;
            $this->cust_phone = & new clsControl(ccsTextBox, "cust_phone", "Cust Phone", ccsText, "", CCGetRequestParam("cust_phone", $Method, NULL), $this);
            $this->cust_phone->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @24-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @24-AC63FF15
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->resolution_id->Validate() && $Validation);
        $Validation = ($this->cust_fullname->Validate() && $Validation);
        $Validation = ($this->cust_phone->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resolution_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cust_fullname->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cust_phone->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-26C1B5DA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->resolution_id->Errors->Count());
        $errors = ($errors || $this->cust_fullname->Errors->Count());
        $errors = ($errors || $this->cust_phone->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @24-ED598703
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

//Operation Method @24-B908BA44
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
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @24-1E92BB1B
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->cust_fullname->SetValue($this->cust_fullname->GetValue(true));
        $this->DataSource->cust_phone->SetValue($this->cust_phone->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-C5C911B1
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->resolution_id->SetValue($this->resolution_id->GetValue(true));
        $this->DataSource->cust_fullname->SetValue($this->cust_fullname->GetValue(true));
        $this->DataSource->cust_phone->SetValue($this->cust_phone->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @24-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @24-2A4C085D
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                    $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                    $this->cust_fullname->SetValue($this->DataSource->cust_fullname->GetValue());
                    $this->cust_phone->SetValue($this->DataSource->cust_phone->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resolution_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cust_fullname->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cust_phone->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->ticket_id->Show();
        $this->resolution_id->Show();
        $this->cust_fullname->Show();
        $this->cust_phone->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_customer1 Class @24-FCB6E20C

class clssmart_customer1DataSource extends clsDBSMART {  //smart_customer1DataSource Class @24-E527451D

//DataSource Variables @24-9216F605
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $ticket_id;
    var $resolution_id;
    var $cust_fullname;
    var $cust_phone;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-39519BD3
    function clssmart_customer1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_customer1/Error";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->cust_fullname = new clsField("cust_fullname", ccsText, "");
        
        $this->cust_phone = new clsField("cust_phone", ccsText, "");
        

        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["cust_fullname"] = array("Name" => "cust_fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cust_phone"] = array("Name" => "cust_phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["resolution_id"] = array("Name" => "resolution_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cust_fullname"] = array("Name" => "cust_fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cust_phone"] = array("Name" => "cust_phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-35B33087
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

//Open Method @24-9C6C09A4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_customer {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-18991C27
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->cust_fullname->SetDBValue($this->f("cust_fullname"));
        $this->cust_phone->SetDBValue($this->f("cust_phone"));
    }
//End SetValues Method

//Insert Method @24-A3D38035
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->InsertFields["cust_fullname"]["Value"] = $this->cust_fullname->GetDBValue(true);
        $this->InsertFields["cust_phone"]["Value"] = $this->cust_phone->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_customer", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-E723A13C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["resolution_id"]["Value"] = $this->resolution_id->GetDBValue(true);
        $this->UpdateFields["cust_fullname"]["Value"] = $this->cust_fullname->GetDBValue(true);
        $this->UpdateFields["cust_phone"]["Value"] = $this->cust_phone->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_customer", $this->UpdateFields, $this);
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

//Delete Method @24-901ECC3E
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM smart_customer";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End smart_customer1DataSource Class @24-FCB6E20C

//Initialize Page @1-4EEF54F8
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
$TemplateFileName = "testtemplate.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-962BFB0D
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_customer = & new clsGridsmart_customer("", $MainPage);
$smart_customer1 = & new clsRecordsmart_customer1("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_customer = & $smart_customer;
$MainPage->smart_customer1 = & $smart_customer1;
$smart_customer->Initialize();
$smart_customer1->Initialize();

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

//Execute Components @1-73EE54BA
$header->Operations();
$footer->Operations();
$smart_customer1->Operation();
//End Execute Components

//Go to destination page @1-420B7AA8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_customer);
    unset($smart_customer1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2BF6EBF9
$header->Show();
$footer->Show();
$smart_customer->Show();
$smart_customer1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8D5FEC5C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_customer);
unset($smart_customer1);
unset($Tpl);
//End Unload Page


?>
