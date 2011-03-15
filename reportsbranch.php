<?php
class clsGridreportsbranchGReportBranchByYear { //GReportBranchByYear class @20-DEF3CAD7

//Variables @20-AC1EDBB9

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

//Class_Initialize Event @20-211D6BF1
    function clsGridreportsbranchGReportBranchByYear($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GReportBranchByYear";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GReportBranchByYear";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsreportsbranchGReportBranchByYearDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
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
        $this->TicMonth->HTML = true;
        $this->JanTic = & new clsControl(ccsLabel, "JanTic", "JanTic", ccsInteger, "", CCGetRequestParam("JanTic", ccsGet, NULL), $this);
        $this->JanTic->HTML = true;
        $this->FebTic = & new clsControl(ccsLabel, "FebTic", "FebTic", ccsInteger, "", CCGetRequestParam("FebTic", ccsGet, NULL), $this);
        $this->FebTic->HTML = true;
        $this->MacTic = & new clsControl(ccsLabel, "MacTic", "MacTic", ccsInteger, "", CCGetRequestParam("MacTic", ccsGet, NULL), $this);
        $this->MacTic->HTML = true;
        $this->AprTic = & new clsControl(ccsLabel, "AprTic", "AprTic", ccsInteger, "", CCGetRequestParam("AprTic", ccsGet, NULL), $this);
        $this->AprTic->HTML = true;
        $this->MeiTic = & new clsControl(ccsLabel, "MeiTic", "MeiTic", ccsInteger, "", CCGetRequestParam("MeiTic", ccsGet, NULL), $this);
        $this->MeiTic->HTML = true;
        $this->JuneTic = & new clsControl(ccsLabel, "JuneTic", "JuneTic", ccsInteger, "", CCGetRequestParam("JuneTic", ccsGet, NULL), $this);
        $this->JuneTic->HTML = true;
        $this->JulyTic = & new clsControl(ccsLabel, "JulyTic", "JulyTic", ccsInteger, "", CCGetRequestParam("JulyTic", ccsGet, NULL), $this);
        $this->JulyTic->HTML = true;
        $this->AugTic = & new clsControl(ccsLabel, "AugTic", "AugTic", ccsInteger, "", CCGetRequestParam("AugTic", ccsGet, NULL), $this);
        $this->AugTic->HTML = true;
        $this->SeptTic = & new clsControl(ccsLabel, "SeptTic", "SeptTic", ccsInteger, "", CCGetRequestParam("SeptTic", ccsGet, NULL), $this);
        $this->SeptTic->HTML = true;
        $this->OctTic = & new clsControl(ccsLabel, "OctTic", "OctTic", ccsInteger, "", CCGetRequestParam("OctTic", ccsGet, NULL), $this);
        $this->OctTic->HTML = true;
        $this->NovTic = & new clsControl(ccsLabel, "NovTic", "NovTic", ccsInteger, "", CCGetRequestParam("NovTic", ccsGet, NULL), $this);
        $this->NovTic->HTML = true;
        $this->DecTic = & new clsControl(ccsLabel, "DecTic", "DecTic", ccsInteger, "", CCGetRequestParam("DecTic", ccsGet, NULL), $this);
        $this->DecTic->HTML = true;
        $this->ref_value = & new clsControl(ccsHidden, "ref_value", "ref_value", ccsText, "", CCGetRequestParam("ref_value", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
        $this->GrandTotal = & new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsInteger, "", CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
        $this->GrandTotal->HTML = true;
        $this->TotalJan = & new clsControl(ccsLabel, "TotalJan", "TotalJan", ccsInteger, "", CCGetRequestParam("TotalJan", ccsGet, NULL), $this);
        $this->TotalFeb = & new clsControl(ccsLabel, "TotalFeb", "TotalFeb", ccsInteger, "", CCGetRequestParam("TotalFeb", ccsGet, NULL), $this);
        $this->TotalMac = & new clsControl(ccsLabel, "TotalMac", "TotalMac", ccsInteger, "", CCGetRequestParam("TotalMac", ccsGet, NULL), $this);
        $this->TotalApr = & new clsControl(ccsLabel, "TotalApr", "TotalApr", ccsInteger, "", CCGetRequestParam("TotalApr", ccsGet, NULL), $this);
        $this->TotalMei = & new clsControl(ccsLabel, "TotalMei", "TotalMei", ccsInteger, "", CCGetRequestParam("TotalMei", ccsGet, NULL), $this);
        $this->TotalJune = & new clsControl(ccsLabel, "TotalJune", "TotalJune", ccsInteger, "", CCGetRequestParam("TotalJune", ccsGet, NULL), $this);
        $this->TotalJuly = & new clsControl(ccsLabel, "TotalJuly", "TotalJuly", ccsInteger, "", CCGetRequestParam("TotalJuly", ccsGet, NULL), $this);
        $this->TotalAug = & new clsControl(ccsLabel, "TotalAug", "TotalAug", ccsInteger, "", CCGetRequestParam("TotalAug", ccsGet, NULL), $this);
        $this->TotalSept = & new clsControl(ccsLabel, "TotalSept", "TotalSept", ccsInteger, "", CCGetRequestParam("TotalSept", ccsGet, NULL), $this);
        $this->TotalOct = & new clsControl(ccsLabel, "TotalOct", "TotalOct", ccsInteger, "", CCGetRequestParam("TotalOct", ccsGet, NULL), $this);
        $this->TotalNov = & new clsControl(ccsLabel, "TotalNov", "TotalNov", ccsInteger, "", CCGetRequestParam("TotalNov", ccsGet, NULL), $this);
        $this->TotalDec = & new clsControl(ccsLabel, "TotalDec", "TotalDec", ccsInteger, "", CCGetRequestParam("TotalDec", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @20-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @20-8B027A6A
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
        $this->lblYear->Show();
        $this->GrandTotal->Show();
        $this->TotalJan->Show();
        $this->TotalFeb->Show();
        $this->TotalMac->Show();
        $this->TotalApr->Show();
        $this->TotalMei->Show();
        $this->TotalJune->Show();
        $this->TotalJuly->Show();
        $this->TotalAug->Show();
        $this->TotalSept->Show();
        $this->TotalOct->Show();
        $this->TotalNov->Show();
        $this->TotalDec->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @20-4004DB7B
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

} //End GReportBranchByYear Class @20-FCB6E20C

class clsreportsbranchGReportBranchByYearDataSource extends clsDBSMART {  //GReportBranchByYearDataSource Class @20-8BF02526

//DataSource Variables @20-4DDEDC74
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ref_description;
    var $ref_value;
//End DataSource Variables

//DataSourceClass_Initialize Event @20-AB6BCC91
    function clsreportsbranchGReportBranchByYearDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GReportBranchByYear";
        $this->Initialize();
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->ref_value = new clsField("ref_value", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @20-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @20-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @20-0BF08612
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ref_description, ref_value, eqtop_branch \n\n" .
        "FROM smart_eqtoppan INNER JOIN smart_referencecode ON\n\n" .
        "smart_eqtoppan.eqtop_branch = smart_referencecode.ref_value {SQL_Where}\n\n" .
        "GROUP BY eqtop_branch {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @20-6AFD554E
    function SetValues()
    {
        $this->ref_description->SetDBValue($this->f("eqtop_branch"));
        $this->ref_value->SetDBValue($this->f("ref_value"));
    }
//End SetValues Method

} //End GReportBranchByYearDataSource Class @20-FCB6E20C

class clsreportsbranch { //reportsbranch class @1-1B1730B7

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

//Class_Initialize Event @1-6C5188E3
    function clsreportsbranch($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportsbranch.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportsbranch.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-7B9059E3
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->GReportBranchByYear);
    }
//End Class_Terminate Event

//BindEvents Method @1-0C70F774
    function BindEvents()
    {
        $this->GReportBranchByYear->CCSEvents["BeforeShowRow"] = "reportsbranch_GReportBranchByYear_BeforeShowRow";
        $this->GReportBranchByYear->ds->CCSEvents["BeforeBuildSelect"] = "reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect";
        $this->GReportBranchByYear->CCSEvents["BeforeShow"] = "reportsbranch_GReportBranchByYear_BeforeShow";
        $this->CCSEvents["AfterInitialize"] = "reportsbranch_AfterInitialize";
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

//Initialize Method @1-A441997A
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
        $this->GReportBranchByYear = & new clsGridreportsbranchGReportBranchByYear($this->RelativePath, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = $this->RelativePath . "printrptbranch.php";
        $this->GReportBranchByYear->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "month", CCGetFromGet("month", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "year", CCGetFromGet("year", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "set", CCGetFromGet("set", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "print", 1);
    }
//End Initialize Method

//Show Method @1-D51B7E94
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
        $this->GReportBranchByYear->Show();
        $this->ImageLink1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportsbranch Class @1-FCB6E20C

//Include Event File @1-454936CA
include_once(RelativePath . "/reportsbranch_events.php");
//End Include Event File


?>
