<?php

class clsGridreportscatGStatProbCat { //GStatProbCat class @9-EF002D9E

//Variables @9-AC1EDBB9

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

//Class_Initialize Event @9-F1255FFB
    function clsGridreportscatGStatProbCat($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GStatProbCat";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GStatProbCat";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsreportscatGStatProbCatDataSource($this);
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

        $this->lblNumber = & new clsControl(ccsLabel, "lblNumber", "lblNumber", ccsInteger, "", CCGetRequestParam("lblNumber", ccsGet, NULL), $this);
        $this->TotalTic = & new clsControl(ccsLabel, "TotalTic", "TotalTic", ccsInteger, "", CCGetRequestParam("TotalTic", ccsGet, NULL), $this);
        $this->TotalTic->HTML = true;
        $this->catval = & new clsControl(ccsHidden, "catval", "catval", ccsText, "", CCGetRequestParam("catval", ccsGet, NULL), $this);
        $this->ref_description = & new clsControl(ccsLabel, "ref_description", "ref_description", ccsText, "", CCGetRequestParam("ref_description", ccsGet, NULL), $this);
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
        $this->JulTic = & new clsControl(ccsLabel, "JulTic", "JulTic", ccsInteger, "", CCGetRequestParam("JulTic", ccsGet, NULL), $this);
        $this->JulTic->HTML = true;
        $this->Augtic = & new clsControl(ccsLabel, "Augtic", "Augtic", ccsInteger, "", CCGetRequestParam("Augtic", ccsGet, NULL), $this);
        $this->Augtic->HTML = true;
        $this->SeptTic = & new clsControl(ccsLabel, "SeptTic", "SeptTic", ccsInteger, "", CCGetRequestParam("SeptTic", ccsGet, NULL), $this);
        $this->SeptTic->HTML = true;
        $this->OctTic = & new clsControl(ccsLabel, "OctTic", "OctTic", ccsInteger, "", CCGetRequestParam("OctTic", ccsGet, NULL), $this);
        $this->OctTic->HTML = true;
        $this->NovTic = & new clsControl(ccsLabel, "NovTic", "NovTic", ccsInteger, "", CCGetRequestParam("NovTic", ccsGet, NULL), $this);
        $this->NovTic->HTML = true;
        $this->DecTic = & new clsControl(ccsLabel, "DecTic", "DecTic", ccsInteger, "", CCGetRequestParam("DecTic", ccsGet, NULL), $this);
        $this->DecTic->HTML = true;
        $this->SubCat = & new clsControl(ccsLabel, "SubCat", "SubCat", ccsText, "", CCGetRequestParam("SubCat", ccsGet, NULL), $this);
        $this->subcatval = & new clsControl(ccsHidden, "subcatval", "subcatval", ccsText, "", CCGetRequestParam("subcatval", ccsGet, NULL), $this);
        $this->GTotal = & new clsControl(ccsLabel, "GTotal", "GTotal", ccsInteger, "", CCGetRequestParam("GTotal", ccsGet, NULL), $this);
        $this->lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $this);
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

//Initialize Method @9-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @9-E46D3635
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr11"] = probcat;

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
            $this->ControlsVisible["TotalTic"] = $this->TotalTic->Visible;
            $this->ControlsVisible["catval"] = $this->catval->Visible;
            $this->ControlsVisible["ref_description"] = $this->ref_description->Visible;
            $this->ControlsVisible["JanTic"] = $this->JanTic->Visible;
            $this->ControlsVisible["FebTic"] = $this->FebTic->Visible;
            $this->ControlsVisible["MacTic"] = $this->MacTic->Visible;
            $this->ControlsVisible["AprTic"] = $this->AprTic->Visible;
            $this->ControlsVisible["MeiTic"] = $this->MeiTic->Visible;
            $this->ControlsVisible["JuneTic"] = $this->JuneTic->Visible;
            $this->ControlsVisible["JulTic"] = $this->JulTic->Visible;
            $this->ControlsVisible["Augtic"] = $this->Augtic->Visible;
            $this->ControlsVisible["SeptTic"] = $this->SeptTic->Visible;
            $this->ControlsVisible["OctTic"] = $this->OctTic->Visible;
            $this->ControlsVisible["NovTic"] = $this->NovTic->Visible;
            $this->ControlsVisible["DecTic"] = $this->DecTic->Visible;
            $this->ControlsVisible["SubCat"] = $this->SubCat->Visible;
            $this->ControlsVisible["subcatval"] = $this->subcatval->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->catval->SetValue($this->DataSource->catval->GetValue());
                $this->ref_description->SetValue($this->DataSource->ref_description->GetValue());
                $this->SubCat->SetValue($this->DataSource->SubCat->GetValue());
                $this->subcatval->SetValue($this->DataSource->subcatval->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lblNumber->Show();
                $this->TotalTic->Show();
                $this->catval->Show();
                $this->ref_description->Show();
                $this->JanTic->Show();
                $this->FebTic->Show();
                $this->MacTic->Show();
                $this->AprTic->Show();
                $this->MeiTic->Show();
                $this->JuneTic->Show();
                $this->JulTic->Show();
                $this->Augtic->Show();
                $this->SeptTic->Show();
                $this->OctTic->Show();
                $this->NovTic->Show();
                $this->DecTic->Show();
                $this->SubCat->Show();
                $this->subcatval->Show();
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
        $this->GTotal->Show();
        $this->lblYear->Show();
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

//GetErrors Method @9-6DCD1A0B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lblNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->catval->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ref_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JanTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FebTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MacTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AprTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MeiTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JuneTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->JulTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Augtic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SeptTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->OctTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NovTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DecTic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SubCat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->subcatval->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GStatProbCat Class @9-FCB6E20C

class clsreportscatGStatProbCatDataSource extends clsDBSMART {  //GStatProbCatDataSource Class @9-34B85DE5

//DataSource Variables @9-6B031041
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $catval;
    var $ref_description;
    var $SubCat;
    var $subcatval;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-54F3F577
    function clsreportscatGStatProbCatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GStatProbCat";
        $this->Initialize();
        $this->catval = new clsField("catval", ccsText, "");
        
        $this->ref_description = new clsField("ref_description", ccsText, "");
        
        $this->SubCat = new clsField("SubCat", ccsText, "");
        
        $this->subcatval = new clsField("subcatval", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @9-D157749A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr11", ccsText, "", "", $this->Parameters["expr11"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_referencecode.ref_type", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @9-F790E7E4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM smart_referencecode INNER JOIN smart_referencecode smart_referencecode1 ON\n\n" .
        "smart_referencecode.ref_value = smart_referencecode1.ref_type";
        $this->SQL = "SELECT smart_referencecode.ref_value AS catvalue, smart_referencecode.ref_description AS cat, smart_referencecode1.ref_description AS subcat,\n\n" .
        "smart_referencecode1.ref_value AS subcatvalue \n\n" .
        "FROM smart_referencecode INNER JOIN smart_referencecode smart_referencecode1 ON\n\n" .
        "smart_referencecode.ref_value = smart_referencecode1.ref_type {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @9-A5C60F5F
    function SetValues()
    {
        $this->catval->SetDBValue($this->f("catvalue"));
        $this->ref_description->SetDBValue($this->f("cat"));
        $this->SubCat->SetDBValue($this->f("subcat"));
        $this->subcatval->SetDBValue($this->f("subcatvalue"));
    }
//End SetValues Method

} //End GStatProbCatDataSource Class @9-FCB6E20C

class clsreportscat { //reportscat class @1-1AD17932

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

//Class_Initialize Event @1-ABD2712B
    function clsreportscat($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportscat.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportscat.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-A327CC24
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->GStatProbCat);
    }
//End Class_Terminate Event

//BindEvents Method @1-AEA87BEF
    function BindEvents()
    {
        $this->GStatProbCat->JanTic->CCSEvents["BeforeShow"] = "reportscat_GStatProbCat_JanTic_BeforeShow";
        $this->GStatProbCat->CCSEvents["BeforeShowRow"] = "reportscat_GStatProbCat_BeforeShowRow";
        $this->GStatProbCat->CCSEvents["BeforeShow"] = "reportscat_GStatProbCat_BeforeShow";
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

//Initialize Method @1-54778A9F
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
        $this->GStatProbCat = & new clsGridreportscatGStatProbCat($this->RelativePath, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = $this->RelativePath . "printrptcat.php";
        $this->GStatProbCat->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "year", CCGetFromGet("year", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "set", CCGetFromGet("set", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "print", 1);
    }
//End Initialize Method

//Show Method @1-ECD8F968
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
        $this->GStatProbCat->Show();
        $this->ImageLink1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportscat Class @1-FCB6E20C

//Include Event File @1-23B74AFD
include_once(RelativePath . "/reportscat_events.php");
//End Include Event File


?>
