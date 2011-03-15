<?php







class clsGridstatresnoteGTicketMethodByYear { //GTicketMethodByYear class @71-8570531B

//Variables @71-AC1EDBB9

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

//Class_Initialize Event @71-9210E566
    function clsGridstatresnoteGTicketMethodByYear($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GTicketMethodByYear";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GTicketMethodByYear";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsstatresnoteGTicketMethodByYearDataSource($this);
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

        $this->ref_description = & new clsControl(ccsLabel, "ref_description", "ref_description", ccsText, "", CCGetRequestParam("ref_description", ccsGet, NULL), $this);
        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->TicMonth = & new clsControl(ccsLabel, "TicMonth", "TicMonth", ccsInteger, "", CCGetRequestParam("TicMonth", ccsGet, NULL), $this);
        $this->JanTic = & new clsControl(ccsLabel, "JanTic", "JanTic", ccsInteger, "", CCGetRequestParam("JanTic", ccsGet, NULL), $this);
        $this->FebTic = & new clsControl(ccsLabel, "FebTic", "FebTic", ccsInteger, "", CCGetRequestParam("FebTic", ccsGet, NULL), $this);
        $this->MacTic = & new clsControl(ccsLabel, "MacTic", "MacTic", ccsInteger, "", CCGetRequestParam("MacTic", ccsGet, NULL), $this);
        $this->AprTic = & new clsControl(ccsLabel, "AprTic", "AprTic", ccsInteger, "", CCGetRequestParam("AprTic", ccsGet, NULL), $this);
        $this->MeiTic = & new clsControl(ccsLabel, "MeiTic", "MeiTic", ccsInteger, "", CCGetRequestParam("MeiTic", ccsGet, NULL), $this);
        $this->JuneTic = & new clsControl(ccsLabel, "JuneTic", "JuneTic", ccsInteger, "", CCGetRequestParam("JuneTic", ccsGet, NULL), $this);
        $this->JulyTic = & new clsControl(ccsLabel, "JulyTic", "JulyTic", ccsInteger, "", CCGetRequestParam("JulyTic", ccsGet, NULL), $this);
        $this->AugTic = & new clsControl(ccsLabel, "AugTic", "AugTic", ccsInteger, "", CCGetRequestParam("AugTic", ccsGet, NULL), $this);
        $this->SeptTic = & new clsControl(ccsLabel, "SeptTic", "SeptTic", ccsInteger, "", CCGetRequestParam("SeptTic", ccsGet, NULL), $this);
        $this->OctTic = & new clsControl(ccsLabel, "OctTic", "OctTic", ccsInteger, "", CCGetRequestParam("OctTic", ccsGet, NULL), $this);
        $this->NovTic = & new clsControl(ccsLabel, "NovTic", "NovTic", ccsInteger, "", CCGetRequestParam("NovTic", ccsGet, NULL), $this);
        $this->DecTic = & new clsControl(ccsLabel, "DecTic", "DecTic", ccsInteger, "", CCGetRequestParam("DecTic", ccsGet, NULL), $this);
        $this->ref_value = & new clsControl(ccsHidden, "ref_value", "ref_value", ccsText, "", CCGetRequestParam("ref_value", ccsGet, NULL), $this);
        $this->GrandTotal = & new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsInteger, "", CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @71-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @71-592F1128
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr73"] = actmethod;

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
            $this->ControlsVisible["ref_description"] = $this->ref_description->Visible;
            $this->ControlsVisible["lblNumber"] = $this->lblNumber->Visible;
            $this->ControlsVisible["TicMonth"] = $this->TicMonth->Visible;
            $this->ControlsVisible["JanTic"] = $this->JanTic->Visible;
            $this->ControlsVisible["FebTic"] = $this->FebTic->Visible;
            $this->ControlsVisible["MacTic"] = $this->MacTic->Visible;
            $this->ControlsVisible["AprTic"] = $this->AprTic->Visible;
            $this->ControlsVisible["MeiTic"] = $this->MeiTic->Visible;
            $this->ControlsVisible["JuneTic"] = $this->JuneTic->Visible;
            $this->ControlsVisible["JulyTic"] = $this->JulyTic->Visible;
            $this->ControlsVisible["AugTic"] = $this->AugTic->Visible;
            $this->ControlsVisible["SeptTic"] = $this->SeptTic->Visible;
            $this->ControlsVisible["OctTic"] = $this->OctTic->Visible;
            $this->ControlsVisible["NovTic"] = $this->NovTic->Visible;
            $this->ControlsVisible["DecTic"] = $this->DecTic->Visible;
            $this->ControlsVisible["ref_value"] = $this->ref_value->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ref_description->SetValue($this->DataSource->ref_description->GetValue());
                $this->JanTic->SetValue($this->DataSource->JanTic->GetValue());
                $this->FebTic->SetValue($this->DataSource->FebTic->GetValue());
                $this->MacTic->SetValue($this->DataSource->MacTic->GetValue());
                $this->AprTic->SetValue($this->DataSource->AprTic->GetValue());
                $this->MeiTic->SetValue($this->DataSource->MeiTic->GetValue());
                $this->JuneTic->SetValue($this->DataSource->JuneTic->GetValue());
                $this->JulyTic->SetValue($this->DataSource->JulyTic->GetValue());
                $this->AugTic->SetValue($this->DataSource->AugTic->GetValue());
                $this->SeptTic->SetValue($this->DataSource->SeptTic->GetValue());
                $this->OctTic->SetValue($this->DataSource->OctTic->GetValue());
                $this->NovTic->SetValue($this->DataSource->NovTic->GetValue());
                $this->DecTic->SetValue($this->DataSource->DecTic->GetValue());
                $this->ref_value->SetValue($this->DataSource->ref_value->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ref_description->Show();
                $this->lblNumber->Show();
                $this->TicMonth->Show();
                $this->JanTic->Show();
                $this->FebTic->Show();
                $this->MacTic->Show();
                $this->AprTic->Show();
                $this->MeiTic->Show();
                $this->JuneTic->Show();
                $this->JulyTic->Show();
                $this->AugTic->Show();
                $this->SeptTic->Show();
                $this->OctTic->Show();
                $this->NovTic->Show();
                $this->DecTic->Show();
                $this->ref_value->Show();
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
        $this->GrandTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @71-4004DB7B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ref_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TicMonth->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JanTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FebTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MacTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AprTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MeiTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JuneTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JulyTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AugTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SeptTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->OctTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NovTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DecTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ref_value->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GTicketMethodByYear Class @71-FCB6E20C

class clsstatresnoteGTicketMethodByYearDataSource extends clsDBSMART {  //GTicketMethodByYearDataSource Class @71-748B9B58

//DataSource Variables @71-18AA3DCA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ref_description;
    var $JanTic;
    var $FebTic;
    var $MacTic;
    var $AprTic;
    var $MeiTic;
    var $JuneTic;
    var $JulyTic;
    var $AugTic;
    var $SeptTic;
    var $OctTic;
    var $NovTic;
    var $DecTic;
    var $ref_value;
//End DataSource Variables

//DataSourceClass_Initialize Event @71-26085B47
    function clsstatresnoteGTicketMethodByYearDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GTicketMethodByYear";
        $this->Initialize();
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->JanTic = new clsField("JanTic", ccsInteger, "");
        
        $this->FebTic = new clsField("FebTic", ccsInteger, "");
        
        $this->MacTic = new clsField("MacTic", ccsInteger, "");
        
        $this->AprTic = new clsField("AprTic", ccsInteger, "");
        
        $this->MeiTic = new clsField("MeiTic", ccsInteger, "");
        
        $this->JuneTic = new clsField("JuneTic", ccsInteger, "");
        
        $this->JulyTic = new clsField("JulyTic", ccsInteger, "");
        
        $this->AugTic = new clsField("AugTic", ccsInteger, "");
        
        $this->SeptTic = new clsField("SeptTic", ccsInteger, "");
        
        $this->OctTic = new clsField("OctTic", ccsInteger, "");
        
        $this->NovTic = new clsField("NovTic", ccsInteger, "");
        
        $this->DecTic = new clsField("DecTic", ccsInteger, "");
        
        $this->ref_value = new clsField("ref_value", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @71-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @71-2AB4DB32
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr73", ccsText, "", "", $this->Parameters["expr73"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ref_type", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @71-276E6AEC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_referencecode";
        $this->SQL = "SELECT ref_description, ref_value \n\n" .
        "FROM smart_referencecode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @71-CB9BEB3D
    function SetValues()
    {
        $this->ref_description->SetDBValue($this->f("ref_description"));
        $this->JanTic->SetDBValue(trim($this->f("TicketJan")));
        $this->FebTic->SetDBValue(trim($this->f("TicketFeb")));
        $this->MacTic->SetDBValue(trim($this->f("TicketMac")));
        $this->AprTic->SetDBValue(trim($this->f("TicketApr")));
        $this->MeiTic->SetDBValue(trim($this->f("TicketMei")));
        $this->JuneTic->SetDBValue(trim($this->f("TicketJune")));
        $this->JulyTic->SetDBValue(trim($this->f("TicketJuly")));
        $this->AugTic->SetDBValue(trim($this->f("TicketAug")));
        $this->SeptTic->SetDBValue(trim($this->f("TicketSept")));
        $this->OctTic->SetDBValue(trim($this->f("TicketOct")));
        $this->NovTic->SetDBValue(trim($this->f("TicketNov")));
        $this->DecTic->SetDBValue(trim($this->f("TicketDec")));
        $this->ref_value->SetDBValue($this->f("ref_value"));
    }
//End SetValues Method

} //End GTicketMethodByYearDataSource Class @71-FCB6E20C

class clsstatresnote { //statresnote class @1-C29BBDF9

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

//Class_Initialize Event @1-2BDA6535
    function clsstatresnote($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "statresnote.php";
        $this->Redirect = "";
        $this->TemplateFileName = "statresnote.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-D320790C
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->GTicketMethodByYear);
    }
//End Class_Terminate Event

//BindEvents Method @1-1631C14D
    function BindEvents()
    {
        $this->Report_Print1->CCSEvents["BeforeShow"] = "statresnote_Report_Print1_BeforeShow";
        $this->GTicketMethodByYear->CCSEvents["BeforeShowRow"] = "statresnote_GTicketMethodByYear_BeforeShowRow";
        $this->GTicketMethodByYear->ds->CCSEvents["BeforeBuildSelect"] = "statresnote_GTicketMethodByYear_ds_BeforeBuildSelect";
        $this->GTicketMethodByYear->CCSEvents["BeforeShow"] = "statresnote_GTicketMethodByYear_BeforeShow";
        $this->CCSEvents["AfterInitialize"] = "statresnote_AfterInitialize";
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

//Initialize Method @1-9A6F98AE
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
        $this->Report_Print1 = & new clsControl(ccsLink, "Report_Print1", "Report_Print1", ccsText, "", CCGetRequestParam("Report_Print1", ccsGet, NULL), $this);
        $this->Report_Print1->Page = $this->RelativePath . "statresnote.php";
        $this->GTicketMethodByYear = & new clsGridstatresnoteGTicketMethodByYear($this->RelativePath, $this);
        $this->GTicketMethodByYear->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->Report_Print1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Report_Print1->Parameters = CCAddParam($this->Report_Print1->Parameters, "ViewMode", "Print");
    }
//End Initialize Method

//Show Method @1-D676FE89
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
        $this->GTicketMethodByYear->Show();
        $this->Report_Print1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End statresnote Class @1-FCB6E20C

//Include Event File @1-BFB783DE
include_once(RelativePath . "/statresnote_events.php");
//End Include Event File


?>
