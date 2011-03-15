<?php
class clsGridreportrtnsmart_partsorders { //smart_partsorders class @2-E58534A4

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

//Class_Initialize Event @2-BFBAD35F
    function clsGridreportrtnsmart_partsorders($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_partsorders";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid smart_partsorders";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsreportrtnsmart_partsordersDataSource($this);
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

        $this->engineer = & new clsControl(ccsLabel, "engineer", "engineer", ccsText, "", CCGetRequestParam("engineer", ccsGet, NULL), $this);
        $this->formno = & new clsControl(ccsLabel, "formno", "formno", ccsText, "", CCGetRequestParam("formno", ccsGet, NULL), $this);
        $this->podr_itemcode = & new clsControl(ccsLabel, "podr_itemcode", "podr_itemcode", ccsText, "", CCGetRequestParam("podr_itemcode", ccsGet, NULL), $this);
        $this->podr_itemname = & new clsControl(ccsLabel, "podr_itemname", "podr_itemname", ccsText, "", CCGetRequestParam("podr_itemname", ccsGet, NULL), $this);
        $this->podr_qty = & new clsControl(ccsLabel, "podr_qty", "podr_qty", ccsInteger, "", CCGetRequestParam("podr_qty", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsText, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->podr_remarks2 = & new clsControl(ccsLabel, "podr_remarks2", "podr_remarks2", ccsMemo, "", CCGetRequestParam("podr_remarks2", ccsGet, NULL), $this);
        $this->podr_rtndate = & new clsControl(ccsLabel, "podr_rtndate", "podr_rtndate", ccsDate, $DefaultDateFormat, CCGetRequestParam("podr_rtndate", ccsGet, NULL), $this);
        $this->podr_rtnstatus = & new clsControl(ccsLabel, "podr_rtnstatus", "podr_rtnstatus", ccsText, "", CCGetRequestParam("podr_rtnstatus", ccsGet, NULL), $this);
        $this->podr_rtncounter = & new clsControl(ccsLabel, "podr_rtncounter", "podr_rtncounter", ccsText, "", CCGetRequestParam("podr_rtncounter", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-0654F304
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
            $this->ControlsVisible["engineer"] = $this->engineer->Visible;
            $this->ControlsVisible["formno"] = $this->formno->Visible;
            $this->ControlsVisible["podr_itemcode"] = $this->podr_itemcode->Visible;
            $this->ControlsVisible["podr_itemname"] = $this->podr_itemname->Visible;
            $this->ControlsVisible["podr_qty"] = $this->podr_qty->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["podr_remarks2"] = $this->podr_remarks2->Visible;
            $this->ControlsVisible["podr_rtndate"] = $this->podr_rtndate->Visible;
            $this->ControlsVisible["podr_rtnstatus"] = $this->podr_rtnstatus->Visible;
            $this->ControlsVisible["podr_rtncounter"] = $this->podr_rtncounter->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->engineer->SetValue($this->DataSource->engineer->GetValue());
                $this->formno->SetValue($this->DataSource->formno->GetValue());
                $this->podr_itemcode->SetValue($this->DataSource->podr_itemcode->GetValue());
                $this->podr_itemname->SetValue($this->DataSource->podr_itemname->GetValue());
                $this->podr_qty->SetValue($this->DataSource->podr_qty->GetValue());
                $this->lblNumber->SetValue($this->DataSource->lblNumber->GetValue());
                $this->podr_remarks2->SetValue($this->DataSource->podr_remarks2->GetValue());
                $this->podr_rtndate->SetValue($this->DataSource->podr_rtndate->GetValue());
                $this->podr_rtnstatus->SetValue($this->DataSource->podr_rtnstatus->GetValue());
                $this->podr_rtncounter->SetValue($this->DataSource->podr_rtncounter->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->engineer->Show();
                $this->formno->Show();
                $this->podr_itemcode->Show();
                $this->podr_itemname->Show();
                $this->podr_qty->Show();
                $this->lblNumber->Show();
                $this->podr_remarks2->Show();
                $this->podr_rtndate->Show();
                $this->podr_rtnstatus->Show();
                $this->podr_rtncounter->Show();
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

//GetErrors Method @2-D9186173
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->engineer->Errors->ToString());
        $errors = ComposeStrings($errors, $this->formno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_itemcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_itemname->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_remarks2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_rtndate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_rtnstatus->Errors->ToString());
        $errors = ComposeStrings($errors, $this->podr_rtncounter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End smart_partsorders Class @2-FCB6E20C

class clsreportrtnsmart_partsordersDataSource extends clsDBSMART {  //smart_partsordersDataSource Class @2-DC26A792

//DataSource Variables @2-E7B663BD
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $engineer;
    var $formno;
    var $podr_itemcode;
    var $podr_itemname;
    var $podr_qty;
    var $lblNumber;
    var $podr_remarks2;
    var $podr_rtndate;
    var $podr_rtnstatus;
    var $podr_rtncounter;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CB02379E
    function clsreportrtnsmart_partsordersDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid smart_partsorders";
        $this->Initialize();
        $this->engineer = new clsField("engineer", ccsText, "");
        
        $this->formno = new clsField("formno", ccsText, "");
        
        $this->podr_itemcode = new clsField("podr_itemcode", ccsText, "");
        
        $this->podr_itemname = new clsField("podr_itemname", ccsText, "");
        
        $this->podr_qty = new clsField("podr_qty", ccsInteger, "");
        
        $this->lblNumber = new clsField("lblNumber", ccsText, "");
        
        $this->podr_remarks2 = new clsField("podr_remarks2", ccsMemo, "");
        
        $this->podr_rtndate = new clsField("podr_rtndate", ccsDate, $this->DateFormat);
        
        $this->podr_rtnstatus = new clsField("podr_rtnstatus", ccsText, "");
        
        $this->podr_rtncounter = new clsField("podr_rtncounter", ccsText, "");
        

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

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-C3432C23
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_partsorders";
        $this->SQL = "SELECT * \n\n" .
        "FROM smart_partsorders {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D4B3B14C
    function SetValues()
    {
        $this->engineer->SetDBValue($this->f("engineer"));
        $this->formno->SetDBValue($this->f("formno"));
        $this->podr_itemcode->SetDBValue($this->f("podr_itemcode"));
        $this->podr_itemname->SetDBValue($this->f("podr_itemname"));
        $this->podr_qty->SetDBValue(trim($this->f("podr_qty")));
        $this->lblNumber->SetDBValue($this->f("podr_site"));
        $this->podr_remarks2->SetDBValue($this->f("podr_remarks2"));
        $this->podr_rtndate->SetDBValue(trim($this->f("podr_rtndate")));
        $this->podr_rtnstatus->SetDBValue($this->f("podr_rtnstatus"));
        $this->podr_rtncounter->SetDBValue($this->f("podr_rtncounter"));
    }
//End SetValues Method

} //End smart_partsordersDataSource Class @2-FCB6E20C

class clsreportrtn { //reportrtn class @1-B235EC87

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

//Class_Initialize Event @1-C157C23F
    function clsreportrtn($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportrtn.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportrtn.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-4FFFC478
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->smart_partsorders);
    }
//End Class_Terminate Event

//BindEvents Method @1-20766AEE
    function BindEvents()
    {
        $this->smart_partsorders->CCSEvents["BeforeShowRow"] = "reportrtn_smart_partsorders_BeforeShowRow";
        $this->smart_partsorders->CCSEvents["BeforeShow"] = "reportrtn_smart_partsorders_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-053E90A4
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBSMART = new clsDBSMART();
        $this->Connections["SMART"] = & $this->DBSMART;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->smart_partsorders = & new clsGridreportrtnsmart_partsorders($this->RelativePath, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = $this->RelativePath . "printrptcat.php";
        $this->smart_partsorders->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "year", CCGetFromGet("year", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "set", CCGetFromGet("set", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "print", 1);
    }
//End Initialize Method

//Show Method @1-72904662
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
        $this->smart_partsorders->Show();
        $this->ImageLink1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportrtn Class @1-FCB6E20C

//Include Event File @1-5F5A83BA
include_once(RelativePath . "/reportrtn_events.php");
//End Include Event File


?>
