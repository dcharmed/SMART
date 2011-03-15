<?php
//Include Common Files @1-EF0B0960
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartnote.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

class clsGridsmart_equipment { //smart_equipment class @31-DE6923ED

//Variables @31-AC1EDBB9

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

//Class_Initialize Event @31-D7F13DCC
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
        $this->eqmt_serialno = & new clsControl(ccsLabel, "eqmt_serialno", "eqmt_serialno", ccsText, "", CCGetRequestParam("eqmt_serialno", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @31-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @31-D573A747
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @31-A8A0AC14
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

} //End smart_equipment Class @31-FCB6E20C

class clssmart_equipmentDataSource extends clsDBSMART {  //smart_equipmentDataSource Class @31-070EC136

//DataSource Variables @31-66F4B6C9
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

//DataSourceClass_Initialize Event @31-AF8D5FF4
    function clssmart_equipmentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_equipment";
        $this->Initialize();
        $this->eqmt_type = new clsField("eqmt_type", ccsInteger, "");
        
        $this->eqmt_serialno = new clsField("eqmt_serialno", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @31-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @31-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @31-7BE181CA
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

//SetValues Method @31-846F1B7D
    function SetValues()
    {
        $this->eqmt_type->SetDBValue(trim($this->f("eqmt_type")));
        $this->eqmt_serialno->SetDBValue($this->f("eqmt_serialno"));
        $this->id->SetDBValue(trim($this->f("id")));
    }
//End SetValues Method

} //End smart_equipmentDataSource Class @31-FCB6E20C

class clsGridsmart_measurement { //smart_measurement class @35-E7FCC53B

//Variables @35-AC1EDBB9

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

//Class_Initialize Event @35-81164531
    function clsGridsmart_measurement($RelativePath, & $Parent)
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
        $this->DataSource = new clssmart_measurementDataSource($this);
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

        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->msre_item = & new clsControl(ccsLabel, "msre_item", "msre_item", ccsText, "", CCGetRequestParam("msre_item", ccsGet, NULL), $this);
        $this->msre_before = & new clsControl(ccsLabel, "msre_before", "msre_before", ccsSingle, "", CCGetRequestParam("msre_before", ccsGet, NULL), $this);
        $this->msre_after = & new clsControl(ccsLabel, "msre_after", "msre_after", ccsSingle, "", CCGetRequestParam("msre_after", ccsGet, NULL), $this);
        $this->msre_remark = & new clsControl(ccsLabel, "msre_remark", "msre_remark", ccsMemo, "", CCGetRequestParam("msre_remark", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @35-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @35-BE666AED
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
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->msre_item->SetValue($this->DataSource->msre_item->GetValue());
                $this->msre_before->SetValue($this->DataSource->msre_before->GetValue());
                $this->msre_after->SetValue($this->DataSource->msre_after->GetValue());
                $this->msre_remark->SetValue($this->DataSource->msre_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @35-2263F6E3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_item->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_before->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_after->Errors->ToString());
        $errors = ComposeStrings($errors, $this->msre_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_measurement Class @35-FCB6E20C

class clssmart_measurementDataSource extends clsDBSMART {  //smart_measurementDataSource Class @35-4422F43F

//DataSource Variables @35-2BD497E4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $msre_item;
    var $msre_before;
    var $msre_after;
    var $msre_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @35-A918C2C2
    function clssmart_measurementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_measurement";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->msre_item = new clsField("msre_item", ccsText, "");
        
        $this->msre_before = new clsField("msre_before", ccsSingle, "");
        
        $this->msre_after = new clsField("msre_after", ccsSingle, "");
        
        $this->msre_remark = new clsField("msre_remark", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @35-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @35-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @35-41EF7335
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

//SetValues Method @35-95EC5DE4
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->msre_item->SetDBValue($this->f("msre_item"));
        $this->msre_before->SetDBValue(trim($this->f("msre_before")));
        $this->msre_after->SetDBValue(trim($this->f("msre_after")));
        $this->msre_remark->SetDBValue($this->f("msre_remark"));
    }
//End SetValues Method

} //End smart_measurementDataSource Class @35-FCB6E20C

class clsGridsmart_replacement { //smart_replacement class @41-1B3D786B

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

//Class_Initialize Event @41-2A5E5200
    function clsGridsmart_replacement($RelativePath, & $Parent)
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
        $this->DataSource = new clssmart_replacementDataSource($this);
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

        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->resolution_id = & new clsControl(ccsLabel, "resolution_id", "resolution_id", ccsInteger, "", CCGetRequestParam("resolution_id", ccsGet, NULL), $this);
        $this->equipment_id = & new clsControl(ccsLabel, "equipment_id", "equipment_id", ccsInteger, "", CCGetRequestParam("equipment_id", ccsGet, NULL), $this);
        $this->ticket_id = & new clsControl(ccsLabel, "ticket_id", "ticket_id", ccsInteger, "", CCGetRequestParam("ticket_id", ccsGet, NULL), $this);
        $this->rplmt_serialno = & new clsControl(ccsLabel, "rplmt_serialno", "rplmt_serialno", ccsText, "", CCGetRequestParam("rplmt_serialno", ccsGet, NULL), $this);
        $this->rplmt_remark = & new clsControl(ccsLabel, "rplmt_remark", "rplmt_remark", ccsMemo, "", CCGetRequestParam("rplmt_remark", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @41-E27CE819
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
            $this->ControlsVisible["resolution_id"] = $this->resolution_id->Visible;
            $this->ControlsVisible["equipment_id"] = $this->equipment_id->Visible;
            $this->ControlsVisible["ticket_id"] = $this->ticket_id->Visible;
            $this->ControlsVisible["rplmt_serialno"] = $this->rplmt_serialno->Visible;
            $this->ControlsVisible["rplmt_remark"] = $this->rplmt_remark->Visible;
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
                $this->resolution_id->SetValue($this->DataSource->resolution_id->GetValue());
                $this->equipment_id->SetValue($this->DataSource->equipment_id->GetValue());
                $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
                $this->rplmt_serialno->SetValue($this->DataSource->rplmt_serialno->GetValue());
                $this->rplmt_remark->SetValue($this->DataSource->rplmt_remark->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->resolution_id->Show();
                $this->equipment_id->Show();
                $this->ticket_id->Show();
                $this->rplmt_serialno->Show();
                $this->rplmt_remark->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @41-07132F38
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resolution_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ticket_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplmt_serialno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rplmt_remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_replacement Class @41-FCB6E20C

class clssmart_replacementDataSource extends clsDBSMART {  //smart_replacementDataSource Class @41-B548DC79

//DataSource Variables @41-3D0A785D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $resolution_id;
    var $equipment_id;
    var $ticket_id;
    var $rplmt_serialno;
    var $rplmt_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @41-9513116C
    function clssmart_replacementDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_replacement";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->resolution_id = new clsField("resolution_id", ccsInteger, "");
        
        $this->equipment_id = new clsField("equipment_id", ccsInteger, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->rplmt_serialno = new clsField("rplmt_serialno", ccsText, "");
        
        $this->rplmt_remark = new clsField("rplmt_remark", ccsMemo, "");
        

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

//Prepare Method @41-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @41-CDB46B33
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

//SetValues Method @41-873A690F
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->resolution_id->SetDBValue(trim($this->f("resolution_id")));
        $this->equipment_id->SetDBValue(trim($this->f("equipment_id")));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rplmt_serialno->SetDBValue($this->f("rplmt_serialno"));
        $this->rplmt_remark->SetDBValue($this->f("rplmt_remark"));
    }
//End SetValues Method

} //End smart_replacementDataSource Class @41-FCB6E20C

class clsRecordsmart_resolution { //smart_resolution Class @49-51340C24

//Variables @49-D6FF3E86

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

//Class_Initialize Event @49-057DE310
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
            $this->rslt_date = & new clsControl(ccsTextBox, "rslt_date", "Rslt Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("rslt_date", $Method, NULL), $this);
            $this->rslt_date->Required = true;
            $this->DatePicker_rslt_date = & new clsDatePicker("DatePicker_rslt_date", "smart_resolution", "rslt_date", $this);
            $this->rslt_engineer = & new clsControl(ccsListBox, "rslt_engineer", "Rslt Engineer", ccsInteger, "", CCGetRequestParam("rslt_engineer", $Method, NULL), $this);
            $this->rslt_engineer->DSType = dsTable;
            $this->rslt_engineer->DataSource = new clsDBSMART();
            $this->rslt_engineer->ds = & $this->rslt_engineer->DataSource;
            $this->rslt_engineer->DataSource->SQL = "SELECT * \n" .
"FROM smart_user {SQL_Where} {SQL_OrderBy}";
            list($this->rslt_engineer->BoundColumn, $this->rslt_engineer->TextColumn, $this->rslt_engineer->DBFormat) = array("id", "usr_fullname", "");
            $this->rslt_engineer->DataSource->Parameters["expr79"] = 3;
            $this->rslt_engineer->DataSource->wp = new clsSQLParameters();
            $this->rslt_engineer->DataSource->wp->AddParameter("1", "expr79", ccsInteger, "", "", $this->rslt_engineer->DataSource->Parameters["expr79"], "", false);
            $this->rslt_engineer->DataSource->wp->Criterion[1] = $this->rslt_engineer->DataSource->wp->Operation(opEqual, "usr_group", $this->rslt_engineer->DataSource->wp->GetDBValue("1"), $this->rslt_engineer->DataSource->ToSQL($this->rslt_engineer->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->rslt_engineer->DataSource->Where = 
                 $this->rslt_engineer->DataSource->wp->Criterion[1];
            $this->rslt_servicedate = & new clsControl(ccsTextBox, "rslt_servicedate", "Rslt Servicedate", ccsDate, $DefaultDateFormat, CCGetRequestParam("rslt_servicedate", $Method, NULL), $this);
            $this->DatePicker_rslt_servicedate = & new clsDatePicker("DatePicker_rslt_servicedate", "smart_resolution", "rslt_servicedate", $this);
            $this->rslt_serviceno = & new clsControl(ccsTextBox, "rslt_serviceno", "Rslt Serviceno", ccsText, "", CCGetRequestParam("rslt_serviceno", $Method, NULL), $this);
            $this->datemodified = & new clsControl(ccsTextBox, "datemodified", "Datemodified", ccsDate, $DefaultDateFormat, CCGetRequestParam("datemodified", $Method, NULL), $this);
            $this->DatePicker_datemodified = & new clsDatePicker("DatePicker_datemodified", "smart_resolution", "datemodified", $this);
            $this->rslt_eta = & new clsControl(ccsTextBox, "rslt_eta", "Rslt Eta", ccsDate, $DefaultDateFormat, CCGetRequestParam("rslt_eta", $Method, NULL), $this);
            $this->DatePicker_rslt_eta = & new clsDatePicker("DatePicker_rslt_eta", "smart_resolution", "rslt_eta", $this);
            $this->rslt_etd = & new clsControl(ccsTextBox, "rslt_etd", "Rslt Etd", ccsDate, $DefaultDateFormat, CCGetRequestParam("rslt_etd", $Method, NULL), $this);
            $this->DatePicker_rslt_etd = & new clsDatePicker("DatePicker_rslt_etd", "smart_resolution", "rslt_etd", $this);
            $this->ticketNumber = & new clsControl(ccsLabel, "ticketNumber", "ticketNumber", ccsText, "", CCGetRequestParam("ticketNumber", $Method, NULL), $this);
            $this->site = & new clsControl(ccsLabel, "site", "site", ccsText, "", CCGetRequestParam("site", $Method, NULL), $this);
            $this->rslt_toppanid = & new clsControl(ccsTextBox, "rslt_toppanid", "Rslt Toppanid", ccsText, "", CCGetRequestParam("rslt_toppanid", $Method, NULL), $this);
            $this->rslt_related = & new clsControl(ccsTextBox, "rslt_related", "Rslt Related", ccsText, "", CCGetRequestParam("rslt_related", $Method, NULL), $this);
            $this->rslt_inspection = & new clsControl(ccsTextArea, "rslt_inspection", "Rslt Inspection", ccsMemo, "", CCGetRequestParam("rslt_inspection", $Method, NULL), $this);
            $this->rslt_inspection->Required = true;
            $this->rslt_action = & new clsControl(ccsTextArea, "rslt_action", "Rslt Action", ccsMemo, "", CCGetRequestParam("rslt_action", $Method, NULL), $this);
            $this->rslt_action->Required = true;
            $this->rslt_method = & new clsControl(ccsRadioButton, "rslt_method", "Rslt Method", ccsText, "", CCGetRequestParam("rslt_method", $Method, NULL), $this);
            $this->rslt_method->DSType = dsListOfValues;
            $this->rslt_method->Values = array(array("1", "Phone Call"), array("2", "Visit Site"), array("3", "Remote"));
            $this->rslt_method->HTML = true;
            $this->rslt_planning = & new clsControl(ccsTextArea, "rslt_planning", "Rslt Planning", ccsMemo, "", CCGetRequestParam("rslt_planning", $Method, NULL), $this);
            $this->rslt_remark = & new clsControl(ccsTextArea, "rslt_remark", "Rslt Remark", ccsMemo, "", CCGetRequestParam("rslt_remark", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @49-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @49-BB6EC4BC
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ticket_id->Validate() && $Validation);
        $Validation = ($this->rslt_date->Validate() && $Validation);
        $Validation = ($this->rslt_engineer->Validate() && $Validation);
        $Validation = ($this->rslt_servicedate->Validate() && $Validation);
        $Validation = ($this->rslt_serviceno->Validate() && $Validation);
        $Validation = ($this->datemodified->Validate() && $Validation);
        $Validation = ($this->rslt_eta->Validate() && $Validation);
        $Validation = ($this->rslt_etd->Validate() && $Validation);
        $Validation = ($this->rslt_toppanid->Validate() && $Validation);
        $Validation = ($this->rslt_related->Validate() && $Validation);
        $Validation = ($this->rslt_inspection->Validate() && $Validation);
        $Validation = ($this->rslt_action->Validate() && $Validation);
        $Validation = ($this->rslt_method->Validate() && $Validation);
        $Validation = ($this->rslt_planning->Validate() && $Validation);
        $Validation = ($this->rslt_remark->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ticket_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_engineer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_servicedate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_serviceno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datemodified->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_eta->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_etd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_toppanid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_related->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_inspection->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_action->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_method->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_planning->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rslt_remark->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @49-657E1F9E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->rslt_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_date->Errors->Count());
        $errors = ($errors || $this->rslt_engineer->Errors->Count());
        $errors = ($errors || $this->rslt_servicedate->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_servicedate->Errors->Count());
        $errors = ($errors || $this->rslt_serviceno->Errors->Count());
        $errors = ($errors || $this->datemodified->Errors->Count());
        $errors = ($errors || $this->DatePicker_datemodified->Errors->Count());
        $errors = ($errors || $this->rslt_eta->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_eta->Errors->Count());
        $errors = ($errors || $this->rslt_etd->Errors->Count());
        $errors = ($errors || $this->DatePicker_rslt_etd->Errors->Count());
        $errors = ($errors || $this->ticketNumber->Errors->Count());
        $errors = ($errors || $this->site->Errors->Count());
        $errors = ($errors || $this->rslt_toppanid->Errors->Count());
        $errors = ($errors || $this->rslt_related->Errors->Count());
        $errors = ($errors || $this->rslt_inspection->Errors->Count());
        $errors = ($errors || $this->rslt_action->Errors->Count());
        $errors = ($errors || $this->rslt_method->Errors->Count());
        $errors = ($errors || $this->rslt_planning->Errors->Count());
        $errors = ($errors || $this->rslt_remark->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @49-ED598703
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

//Operation Method @49-0BF2B389
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

//InsertRow Method @49-C0093126
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rslt_date->SetValue($this->rslt_date->GetValue(true));
        $this->DataSource->rslt_engineer->SetValue($this->rslt_engineer->GetValue(true));
        $this->DataSource->rslt_servicedate->SetValue($this->rslt_servicedate->GetValue(true));
        $this->DataSource->rslt_serviceno->SetValue($this->rslt_serviceno->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rslt_eta->SetValue($this->rslt_eta->GetValue(true));
        $this->DataSource->rslt_etd->SetValue($this->rslt_etd->GetValue(true));
        $this->DataSource->ticketNumber->SetValue($this->ticketNumber->GetValue(true));
        $this->DataSource->site->SetValue($this->site->GetValue(true));
        $this->DataSource->rslt_toppanid->SetValue($this->rslt_toppanid->GetValue(true));
        $this->DataSource->rslt_related->SetValue($this->rslt_related->GetValue(true));
        $this->DataSource->rslt_inspection->SetValue($this->rslt_inspection->GetValue(true));
        $this->DataSource->rslt_action->SetValue($this->rslt_action->GetValue(true));
        $this->DataSource->rslt_method->SetValue($this->rslt_method->GetValue(true));
        $this->DataSource->rslt_planning->SetValue($this->rslt_planning->GetValue(true));
        $this->DataSource->rslt_remark->SetValue($this->rslt_remark->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @49-A9DCD948
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ticket_id->SetValue($this->ticket_id->GetValue(true));
        $this->DataSource->rslt_date->SetValue($this->rslt_date->GetValue(true));
        $this->DataSource->rslt_engineer->SetValue($this->rslt_engineer->GetValue(true));
        $this->DataSource->rslt_servicedate->SetValue($this->rslt_servicedate->GetValue(true));
        $this->DataSource->rslt_serviceno->SetValue($this->rslt_serviceno->GetValue(true));
        $this->DataSource->datemodified->SetValue($this->datemodified->GetValue(true));
        $this->DataSource->rslt_eta->SetValue($this->rslt_eta->GetValue(true));
        $this->DataSource->rslt_etd->SetValue($this->rslt_etd->GetValue(true));
        $this->DataSource->ticketNumber->SetValue($this->ticketNumber->GetValue(true));
        $this->DataSource->site->SetValue($this->site->GetValue(true));
        $this->DataSource->rslt_toppanid->SetValue($this->rslt_toppanid->GetValue(true));
        $this->DataSource->rslt_related->SetValue($this->rslt_related->GetValue(true));
        $this->DataSource->rslt_inspection->SetValue($this->rslt_inspection->GetValue(true));
        $this->DataSource->rslt_action->SetValue($this->rslt_action->GetValue(true));
        $this->DataSource->rslt_method->SetValue($this->rslt_method->GetValue(true));
        $this->DataSource->rslt_planning->SetValue($this->rslt_planning->GetValue(true));
        $this->DataSource->rslt_remark->SetValue($this->rslt_remark->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @49-FA0A5A59
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

        $this->rslt_engineer->Prepare();
        $this->rslt_method->Prepare();

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
                    $this->rslt_date->SetValue($this->DataSource->rslt_date->GetValue());
                    $this->rslt_engineer->SetValue($this->DataSource->rslt_engineer->GetValue());
                    $this->rslt_servicedate->SetValue($this->DataSource->rslt_servicedate->GetValue());
                    $this->rslt_serviceno->SetValue($this->DataSource->rslt_serviceno->GetValue());
                    $this->datemodified->SetValue($this->DataSource->datemodified->GetValue());
                    $this->rslt_eta->SetValue($this->DataSource->rslt_eta->GetValue());
                    $this->rslt_etd->SetValue($this->DataSource->rslt_etd->GetValue());
                    $this->rslt_toppanid->SetValue($this->DataSource->rslt_toppanid->GetValue());
                    $this->rslt_related->SetValue($this->DataSource->rslt_related->GetValue());
                    $this->rslt_inspection->SetValue($this->DataSource->rslt_inspection->GetValue());
                    $this->rslt_action->SetValue($this->DataSource->rslt_action->GetValue());
                    $this->rslt_method->SetValue($this->DataSource->rslt_method->GetValue());
                    $this->rslt_planning->SetValue($this->DataSource->rslt_planning->GetValue());
                    $this->rslt_remark->SetValue($this->DataSource->rslt_remark->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ticket_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_engineer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_servicedate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_serviceno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_datemodified->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_eta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_eta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_etd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_rslt_etd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ticketNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_toppanid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_related->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_inspection->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_action->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_method->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_planning->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rslt_remark->Errors->ToString());
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
        $this->rslt_date->Show();
        $this->DatePicker_rslt_date->Show();
        $this->rslt_engineer->Show();
        $this->rslt_servicedate->Show();
        $this->DatePicker_rslt_servicedate->Show();
        $this->rslt_serviceno->Show();
        $this->datemodified->Show();
        $this->DatePicker_datemodified->Show();
        $this->rslt_eta->Show();
        $this->DatePicker_rslt_eta->Show();
        $this->rslt_etd->Show();
        $this->DatePicker_rslt_etd->Show();
        $this->ticketNumber->Show();
        $this->site->Show();
        $this->rslt_toppanid->Show();
        $this->rslt_related->Show();
        $this->rslt_inspection->Show();
        $this->rslt_action->Show();
        $this->rslt_method->Show();
        $this->rslt_planning->Show();
        $this->rslt_remark->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End smart_resolution Class @49-FCB6E20C

class clssmart_resolutionDataSource extends clsDBSMART {  //smart_resolutionDataSource Class @49-0ED180B1

//DataSource Variables @49-86B74797
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
    var $rslt_date;
    var $rslt_engineer;
    var $rslt_servicedate;
    var $rslt_serviceno;
    var $datemodified;
    var $rslt_eta;
    var $rslt_etd;
    var $ticketNumber;
    var $site;
    var $rslt_toppanid;
    var $rslt_related;
    var $rslt_inspection;
    var $rslt_action;
    var $rslt_method;
    var $rslt_planning;
    var $rslt_remark;
//End DataSource Variables

//DataSourceClass_Initialize Event @49-5631BF20
    function clssmart_resolutionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record smart_resolution/Error";
        $this->Initialize();
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->rslt_date = new clsField("rslt_date", ccsDate, $this->DateFormat);
        
        $this->rslt_engineer = new clsField("rslt_engineer", ccsInteger, "");
        
        $this->rslt_servicedate = new clsField("rslt_servicedate", ccsDate, $this->DateFormat);
        
        $this->rslt_serviceno = new clsField("rslt_serviceno", ccsText, "");
        
        $this->datemodified = new clsField("datemodified", ccsDate, $this->DateFormat);
        
        $this->rslt_eta = new clsField("rslt_eta", ccsDate, $this->DateFormat);
        
        $this->rslt_etd = new clsField("rslt_etd", ccsDate, $this->DateFormat);
        
        $this->ticketNumber = new clsField("ticketNumber", ccsText, "");
        
        $this->site = new clsField("site", ccsText, "");
        
        $this->rslt_toppanid = new clsField("rslt_toppanid", ccsText, "");
        
        $this->rslt_related = new clsField("rslt_related", ccsText, "");
        
        $this->rslt_inspection = new clsField("rslt_inspection", ccsMemo, "");
        
        $this->rslt_action = new clsField("rslt_action", ccsMemo, "");
        
        $this->rslt_method = new clsField("rslt_method", ccsText, "");
        
        $this->rslt_planning = new clsField("rslt_planning", ccsMemo, "");
        
        $this->rslt_remark = new clsField("rslt_remark", ccsMemo, "");
        

        $this->InsertFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_date"] = array("Name" => "rslt_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_engineer"] = array("Name" => "rslt_engineer", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_servicedate"] = array("Name" => "rslt_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_serviceno"] = array("Name" => "rslt_serviceno", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_eta"] = array("Name" => "rslt_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_etd"] = array("Name" => "rslt_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_toppanid"] = array("Name" => "rslt_toppanid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_related"] = array("Name" => "rslt_related", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_inspection"] = array("Name" => "rslt_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_action"] = array("Name" => "rslt_action", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_method"] = array("Name" => "rslt_method", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_planning"] = array("Name" => "rslt_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["rslt_remark"] = array("Name" => "rslt_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["ticket_id"] = array("Name" => "ticket_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_date"] = array("Name" => "rslt_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_engineer"] = array("Name" => "rslt_engineer", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_servicedate"] = array("Name" => "rslt_servicedate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_serviceno"] = array("Name" => "rslt_serviceno", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["datemodified"] = array("Name" => "datemodified", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_eta"] = array("Name" => "rslt_eta", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_etd"] = array("Name" => "rslt_etd", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_toppanid"] = array("Name" => "rslt_toppanid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_related"] = array("Name" => "rslt_related", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_inspection"] = array("Name" => "rslt_inspection", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_action"] = array("Name" => "rslt_action", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_method"] = array("Name" => "rslt_method", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_planning"] = array("Name" => "rslt_planning", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["rslt_remark"] = array("Name" => "rslt_remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @49-35B33087
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

//Open Method @49-844CE4A8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_resolution {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @49-6AF16AE7
    function SetValues()
    {
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->rslt_date->SetDBValue(trim($this->f("rslt_date")));
        $this->rslt_engineer->SetDBValue(trim($this->f("rslt_engineer")));
        $this->rslt_servicedate->SetDBValue(trim($this->f("rslt_servicedate")));
        $this->rslt_serviceno->SetDBValue($this->f("rslt_serviceno"));
        $this->datemodified->SetDBValue(trim($this->f("datemodified")));
        $this->rslt_eta->SetDBValue(trim($this->f("rslt_eta")));
        $this->rslt_etd->SetDBValue(trim($this->f("rslt_etd")));
        $this->rslt_toppanid->SetDBValue($this->f("rslt_toppanid"));
        $this->rslt_related->SetDBValue($this->f("rslt_related"));
        $this->rslt_inspection->SetDBValue($this->f("rslt_inspection"));
        $this->rslt_action->SetDBValue($this->f("rslt_action"));
        $this->rslt_method->SetDBValue($this->f("rslt_method"));
        $this->rslt_planning->SetDBValue($this->f("rslt_planning"));
        $this->rslt_remark->SetDBValue($this->f("rslt_remark"));
    }
//End SetValues Method

//Insert Method @49-C04CA82E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->InsertFields["rslt_date"]["Value"] = $this->rslt_date->GetDBValue(true);
        $this->InsertFields["rslt_engineer"]["Value"] = $this->rslt_engineer->GetDBValue(true);
        $this->InsertFields["rslt_servicedate"]["Value"] = $this->rslt_servicedate->GetDBValue(true);
        $this->InsertFields["rslt_serviceno"]["Value"] = $this->rslt_serviceno->GetDBValue(true);
        $this->InsertFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->InsertFields["rslt_eta"]["Value"] = $this->rslt_eta->GetDBValue(true);
        $this->InsertFields["rslt_etd"]["Value"] = $this->rslt_etd->GetDBValue(true);
        $this->InsertFields["rslt_toppanid"]["Value"] = $this->rslt_toppanid->GetDBValue(true);
        $this->InsertFields["rslt_related"]["Value"] = $this->rslt_related->GetDBValue(true);
        $this->InsertFields["rslt_inspection"]["Value"] = $this->rslt_inspection->GetDBValue(true);
        $this->InsertFields["rslt_action"]["Value"] = $this->rslt_action->GetDBValue(true);
        $this->InsertFields["rslt_method"]["Value"] = $this->rslt_method->GetDBValue(true);
        $this->InsertFields["rslt_planning"]["Value"] = $this->rslt_planning->GetDBValue(true);
        $this->InsertFields["rslt_remark"]["Value"] = $this->rslt_remark->GetDBValue(true);
        $this->SQL = CCBuildInsert("smart_resolution", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @49-62222258
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ticket_id"]["Value"] = $this->ticket_id->GetDBValue(true);
        $this->UpdateFields["rslt_date"]["Value"] = $this->rslt_date->GetDBValue(true);
        $this->UpdateFields["rslt_engineer"]["Value"] = $this->rslt_engineer->GetDBValue(true);
        $this->UpdateFields["rslt_servicedate"]["Value"] = $this->rslt_servicedate->GetDBValue(true);
        $this->UpdateFields["rslt_serviceno"]["Value"] = $this->rslt_serviceno->GetDBValue(true);
        $this->UpdateFields["datemodified"]["Value"] = $this->datemodified->GetDBValue(true);
        $this->UpdateFields["rslt_eta"]["Value"] = $this->rslt_eta->GetDBValue(true);
        $this->UpdateFields["rslt_etd"]["Value"] = $this->rslt_etd->GetDBValue(true);
        $this->UpdateFields["rslt_toppanid"]["Value"] = $this->rslt_toppanid->GetDBValue(true);
        $this->UpdateFields["rslt_related"]["Value"] = $this->rslt_related->GetDBValue(true);
        $this->UpdateFields["rslt_inspection"]["Value"] = $this->rslt_inspection->GetDBValue(true);
        $this->UpdateFields["rslt_action"]["Value"] = $this->rslt_action->GetDBValue(true);
        $this->UpdateFields["rslt_method"]["Value"] = $this->rslt_method->GetDBValue(true);
        $this->UpdateFields["rslt_planning"]["Value"] = $this->rslt_planning->GetDBValue(true);
        $this->UpdateFields["rslt_remark"]["Value"] = $this->rslt_remark->GetDBValue(true);
        $this->SQL = CCBuildUpdate("smart_resolution", $this->UpdateFields, $this);
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

} //End smart_resolutionDataSource Class @49-FCB6E20C

//Initialize Page @1-589C03C8
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
$TemplateFileName = "smartnote.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6BEAA0C8
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$smart_equipment = & new clsGridsmart_equipment("", $MainPage);
$smart_measurement = & new clsGridsmart_measurement("", $MainPage);
$smart_replacement = & new clsGridsmart_replacement("", $MainPage);
$smart_resolution = & new clsRecordsmart_resolution("", $MainPage);
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->smart_equipment = & $smart_equipment;
$MainPage->smart_measurement = & $smart_measurement;
$MainPage->smart_replacement = & $smart_replacement;
$MainPage->smart_resolution = & $smart_resolution;
$smart_equipment->Initialize();
$smart_measurement->Initialize();
$smart_replacement->Initialize();
$smart_resolution->Initialize();

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

//Execute Components @1-CD7718D6
$header->Operations();
$footer->Operations();
$smart_resolution->Operation();
//End Execute Components

//Go to destination page @1-319CB0A5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    unset($smart_equipment);
    unset($smart_measurement);
    unset($smart_replacement);
    unset($smart_resolution);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4E5424D4
$header->Show();
$footer->Show();
$smart_equipment->Show();
$smart_measurement->Show();
$smart_replacement->Show();
$smart_resolution->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FB94F7D6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
unset($smart_equipment);
unset($smart_measurement);
unset($smart_replacement);
unset($smart_resolution);
unset($Tpl);
//End Unload Page


?>
