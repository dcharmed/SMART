<?php
//Include Common Files @1-5013ACBF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "printrptpm.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//smart_eqtoppan_smart_prev1 ReportGroup class @2-06F7720A
class clsReportGroupsmart_eqtoppan_smart_prev1 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $state, $stateDup, $_stateAttributes;
    var $Report_Row_Number, $_Report_Row_NumberAttributes;
    var $eqtop_toppan, $_eqtop_toppanAttributes;
    var $prvt_date, $_prvt_dateAttributes;
    var $prvt_byuser, $_prvt_byuserAttributes;
    var $prvt_byuser2, $_prvt_byuser2Attributes;
    var $prvt_report, $_prvt_reportAttributes;
    var $branch, $_branchAttributes;
    var $branchcode, $_branchcodeAttributes;
    var $Report_CurrentDateTime, $_Report_CurrentDateTimeAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $stateTotalIndex;

    function clsReportGroupsmart_eqtoppan_smart_prev1(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->state = $this->Parent->state->Value;
        $this->eqtop_toppan = $this->Parent->eqtop_toppan->Value;
        $this->prvt_date = $this->Parent->prvt_date->Value;
        $this->prvt_byuser = $this->Parent->prvt_byuser->Value;
        $this->prvt_byuser2 = $this->Parent->prvt_byuser2->Value;
        $this->prvt_report = $this->Parent->prvt_report->Value;
        $this->branch = $this->Parent->branch->Value;
        $this->branchcode = $this->Parent->branchcode->Value;
        if ($PrevGroup) {
            $this->stateDup =  CCCompareValues($this->state, $PrevGroup->state, $this->Parent->state->DataType) == 0;
        }
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->_stateAttributes = $this->Parent->state->Attributes->GetAsArray();
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_eqtop_toppanAttributes = $this->Parent->eqtop_toppan->Attributes->GetAsArray();
        $this->_prvt_dateAttributes = $this->Parent->prvt_date->Attributes->GetAsArray();
        $this->_prvt_byuserAttributes = $this->Parent->prvt_byuser->Attributes->GetAsArray();
        $this->_prvt_byuser2Attributes = $this->Parent->prvt_byuser2->Attributes->GetAsArray();
        $this->_prvt_reportAttributes = $this->Parent->prvt_report->Attributes->GetAsArray();
        $this->_branchAttributes = $this->Parent->branch->Attributes->GetAsArray();
        $this->_branchcodeAttributes = $this->Parent->branchcode->Attributes->GetAsArray();
        $this->_Report_CurrentDateTimeAttributes = $this->Parent->Report_CurrentDateTime->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_Row_Number = $this->Report_Row_Number;
        $Header->_Report_Row_NumberAttributes = $this->_Report_Row_NumberAttributes;
        $this->state = $Header->state;
        $Header->_stateAttributes = $this->_stateAttributes;
        $this->Parent->state->Value = $Header->state;
        $this->Parent->state->Attributes->RestoreFromArray($Header->_stateAttributes);
        $this->eqtop_toppan = $Header->eqtop_toppan;
        $Header->_eqtop_toppanAttributes = $this->_eqtop_toppanAttributes;
        $this->Parent->eqtop_toppan->Value = $Header->eqtop_toppan;
        $this->Parent->eqtop_toppan->Attributes->RestoreFromArray($Header->_eqtop_toppanAttributes);
        $this->prvt_date = $Header->prvt_date;
        $Header->_prvt_dateAttributes = $this->_prvt_dateAttributes;
        $this->Parent->prvt_date->Value = $Header->prvt_date;
        $this->Parent->prvt_date->Attributes->RestoreFromArray($Header->_prvt_dateAttributes);
        $this->prvt_byuser = $Header->prvt_byuser;
        $Header->_prvt_byuserAttributes = $this->_prvt_byuserAttributes;
        $this->Parent->prvt_byuser->Value = $Header->prvt_byuser;
        $this->Parent->prvt_byuser->Attributes->RestoreFromArray($Header->_prvt_byuserAttributes);
        $this->prvt_byuser2 = $Header->prvt_byuser2;
        $Header->_prvt_byuser2Attributes = $this->_prvt_byuser2Attributes;
        $this->Parent->prvt_byuser2->Value = $Header->prvt_byuser2;
        $this->Parent->prvt_byuser2->Attributes->RestoreFromArray($Header->_prvt_byuser2Attributes);
        $this->prvt_report = $Header->prvt_report;
        $Header->_prvt_reportAttributes = $this->_prvt_reportAttributes;
        $this->Parent->prvt_report->Value = $Header->prvt_report;
        $this->Parent->prvt_report->Attributes->RestoreFromArray($Header->_prvt_reportAttributes);
        $this->branch = $Header->branch;
        $Header->_branchAttributes = $this->_branchAttributes;
        $this->Parent->branch->Value = $Header->branch;
        $this->Parent->branch->Attributes->RestoreFromArray($Header->_branchAttributes);
        $this->branchcode = $Header->branchcode;
        $Header->_branchcodeAttributes = $this->_branchcodeAttributes;
        $this->Parent->branchcode->Value = $Header->branchcode;
        $this->Parent->branchcode->Attributes->RestoreFromArray($Header->_branchcodeAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
    }
}
//End smart_eqtoppan_smart_prev1 ReportGroup class

//smart_eqtoppan_smart_prev1 GroupsCollection class @2-45A11683
class clsGroupsCollectionsmart_eqtoppan_smart_prev1 {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $mstateCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionsmart_eqtoppan_smart_prev1(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mstateCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupsmart_eqtoppan_smart_prev1($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->stateTotalIndex = $this->mstateCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->state->Value = $this->Parent->state->initialValue;
        $this->Parent->Report_Row_Number->Value = $this->Parent->Report_Row_Number->initialValue;
        $this->Parent->eqtop_toppan->Value = $this->Parent->eqtop_toppan->initialValue;
        $this->Parent->prvt_date->Value = $this->Parent->prvt_date->initialValue;
        $this->Parent->prvt_byuser->Value = $this->Parent->prvt_byuser->initialValue;
        $this->Parent->prvt_byuser2->Value = $this->Parent->prvt_byuser2->initialValue;
        $this->Parent->prvt_report->Value = $this->Parent->prvt_report->initialValue;
        $this->Parent->branch->Value = $this->Parent->branch->initialValue;
        $this->Parent->branchcode->Value = $this->Parent->branchcode->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
        if ($groupName == "state") {
            $Groupstate = & $this->InitGroup(true);
            $this->Parent->state_Header->CCSEventResult = CCGetEvent($this->Parent->state_Header->CCSEvents, "OnInitialize", $this->Parent->state_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->state_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->state_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->state_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->state_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->state_Header->Height;
                $Groupstate->SetTotalControls("GetNextValue");
            $this->Parent->state_Header->CCSEventResult = CCGetEvent($this->Parent->state_Header->CCSEvents, "OnCalculate", $this->Parent->state_Header);
            $Groupstate->SetControls();
            $Groupstate->Mode = 1;
            $Groupstate->GroupType = "state";
            $this->mstateCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupstate;
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
        $Groupstate = & $this->InitGroup(true);
        $this->Parent->state_Footer->CCSEventResult = CCGetEvent($this->Parent->state_Footer->CCSEvents, "OnInitialize", $this->Parent->state_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->state_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->state_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->state_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupstate->SetTotalControls("GetPrevValue");
        $Groupstate->SyncWithHeader($this->Groups[$this->mstateCurrentHeaderIndex]);
        if ($this->Parent->state_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->state_Footer->Height;
        $this->Parent->state_Footer->CCSEventResult = CCGetEvent($this->Parent->state_Footer->CCSEvents, "OnCalculate", $this->Parent->state_Footer);
        $Groupstate->SetControls();
        $this->RestoreValues();
        $Groupstate->Mode = 2;
        $Groupstate->GroupType ="state";
        $this->Groups[] = & $Groupstate;
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End smart_eqtoppan_smart_prev1 GroupsCollection class

class clsReportsmart_eqtoppan_smart_prev1 { //smart_eqtoppan_smart_prev1 Class @2-164E9565

//smart_eqtoppan_smart_prev1 Variables @2-C5CAD270

    var $ComponentType = "Report";
    var $PageSize;
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $CCSEvents = array();
    var $CCSEventResult;
    var $RelativePath = "";
    var $ViewMode = "Web";
    var $TemplateBlock;
    var $PageNumber;
    var $RowNumber;
    var $TotalRows;
    var $TotalPages;
    var $ControlsVisible = array();
    var $IsEmpty;
    var $Attributes;
    var $DetailBlock, $Detail;
    var $Report_FooterBlock, $Report_Footer;
    var $Report_HeaderBlock, $Report_Header;
    var $Page_FooterBlock, $Page_Footer;
    var $Page_HeaderBlock, $Page_Header;
    var $state_HeaderBlock, $state_Header;
    var $state_FooterBlock, $state_Footer;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $state_HeaderControls, $state_FooterControls;
//End smart_eqtoppan_smart_prev1 Variables

//Class_Initialize Event @2-CDF7011E
    function clsReportsmart_eqtoppan_smart_prev1($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_eqtoppan_smart_prev1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->state_Footer = new clsSection($this);
        $this->state_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clssmart_eqtoppan_smart_prev1DataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 100;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->state = & new clsControl(ccsLabel, "state", "state", ccsText, "", CCGetRequestParam("state", ccsGet, NULL), $this);
        $this->Report_Row_Number = & new clsControl(ccsReportLabel, "Report_Row_Number", "Report_Row_Number", ccsInteger, "", 0, $this);
        $this->Report_Row_Number->TotalFunction = "Count";
        $this->Report_Row_Number->IsEmptySource = true;
        $this->eqtop_toppan = & new clsControl(ccsReportLabel, "eqtop_toppan", "eqtop_toppan", ccsText, "", "", $this);
        $this->prvt_date = & new clsControl(ccsReportLabel, "prvt_date", "prvt_date", ccsText, "", "", $this);
        $this->prvt_byuser = & new clsControl(ccsReportLabel, "prvt_byuser", "prvt_byuser", ccsText, "", "", $this);
        $this->prvt_byuser2 = & new clsControl(ccsReportLabel, "prvt_byuser2", "prvt_byuser2", ccsText, "", "", $this);
        $this->prvt_report = & new clsControl(ccsReportLabel, "prvt_report", "prvt_report", ccsText, "", "", $this);
        $this->prvt_report->HTML = true;
        $this->prvt_report->IsEmptySource = true;
        $this->branch = & new clsControl(ccsReportLabel, "branch", "branch", ccsText, "", "", $this);
        $this->branch->HTML = true;
        $this->branchcode = & new clsControl(ccsHidden, "branchcode", "branchcode", ccsText, "", CCGetRequestParam("branchcode", ccsGet, NULL), $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->Report_CurrentDateTime = & new clsControl(ccsReportLabel, "Report_CurrentDateTime", "Report_CurrentDateTime", ccsText, array('ShortDate', ' ', 'ShortTime'), "", $this);
    }
//End Class_Initialize Event

//Initialize Method @2-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @2-962C6CBA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->eqtop_toppan->Errors->Count());
        $errors = ($errors || $this->prvt_date->Errors->Count());
        $errors = ($errors || $this->prvt_byuser->Errors->Count());
        $errors = ($errors || $this->prvt_byuser2->Errors->Count());
        $errors = ($errors || $this->prvt_report->Errors->Count());
        $errors = ($errors || $this->branch->Errors->Count());
        $errors = ($errors || $this->branchcode->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDateTime->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-A98BDB8C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->eqtop_toppan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_byuser2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prvt_report->Errors->ToString());
        $errors = ComposeStrings($errors, $this->branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->branchcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDateTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-F7EE8F0F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $stateKey = "";
        $Groups = new clsGroupsCollectionsmart_eqtoppan_smart_prev1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->state->SetValue($this->DataSource->state->GetValue());
            $this->eqtop_toppan->SetValue($this->DataSource->eqtop_toppan->GetValue());
            $this->prvt_date->SetValue($this->DataSource->prvt_date->GetValue());
            $this->prvt_byuser->SetValue($this->DataSource->prvt_byuser->GetValue());
            $this->prvt_byuser2->SetValue($this->DataSource->prvt_byuser2->GetValue());
            $this->branch->SetValue($this->DataSource->branch->GetValue());
            $this->branchcode->SetValue($this->DataSource->branchcode->GetValue());
            $this->Report_Row_Number->SetValue(1);
            $this->prvt_report->SetValue("");
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $stateKey != $this->DataSource->f("ref_type")) {
                $Groups->OpenGroup("state");
            }
            $Groups->AddItem();
            $stateKey = $this->DataSource->f("ref_type");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $stateKey != $this->DataSource->f("ref_type")) {
                $Groups->CloseGroup("state");
            }
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["state"] = $this->state->Visible;
            $this->ControlsVisible["Report_Row_Number"] = $this->Report_Row_Number->Visible;
            $this->ControlsVisible["eqtop_toppan"] = $this->eqtop_toppan->Visible;
            $this->ControlsVisible["prvt_date"] = $this->prvt_date->Visible;
            $this->ControlsVisible["prvt_byuser"] = $this->prvt_byuser->Visible;
            $this->ControlsVisible["prvt_byuser2"] = $this->prvt_byuser2->Visible;
            $this->ControlsVisible["prvt_report"] = $this->prvt_report->Visible;
            $this->ControlsVisible["branch"] = $this->branch->Visible;
            $this->ControlsVisible["branchcode"] = $this->branchcode->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->state->Visible = $this->ControlsVisible["state"] && !$items[$i]->stateDup;
                        $this->state->SetValue($items[$i]->state);
                        $this->state->Attributes->RestoreFromArray($items[$i]->_stateAttributes);
                        $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                        $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                        $this->eqtop_toppan->SetValue($items[$i]->eqtop_toppan);
                        $this->eqtop_toppan->Attributes->RestoreFromArray($items[$i]->_eqtop_toppanAttributes);
                        $this->prvt_date->SetValue($items[$i]->prvt_date);
                        $this->prvt_date->Attributes->RestoreFromArray($items[$i]->_prvt_dateAttributes);
                        $this->prvt_byuser->SetValue($items[$i]->prvt_byuser);
                        $this->prvt_byuser->Attributes->RestoreFromArray($items[$i]->_prvt_byuserAttributes);
                        $this->prvt_byuser2->SetValue($items[$i]->prvt_byuser2);
                        $this->prvt_byuser2->Attributes->RestoreFromArray($items[$i]->_prvt_byuser2Attributes);
                        $this->prvt_report->SetValue($items[$i]->prvt_report);
                        $this->prvt_report->Attributes->RestoreFromArray($items[$i]->_prvt_reportAttributes);
                        $this->branch->SetValue($items[$i]->branch);
                        $this->branch->Attributes->RestoreFromArray($items[$i]->_branchAttributes);
                        $this->branchcode->SetValue($items[$i]->branchcode);
                        $this->branchcode->Attributes->RestoreFromArray($items[$i]->_branchcodeAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->state->Show();
                        $this->Report_Row_Number->Show();
                        $this->eqtop_toppan->Show();
                        $this->prvt_date->Show();
                        $this->prvt_byuser->Show();
                        $this->prvt_byuser2->Show();
                        $this->prvt_report->Show();
                        $this->branch->Show();
                        $this->branchcode->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Report_CurrentDateTime->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDateTime->Format));
                            $this->Report_CurrentDateTime->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateTimeAttributes);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Report_CurrentDateTime->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "state":
                        if ($items[$i]->Mode == 1) {
                            $this->state_Header->CCSEventResult = CCGetEvent($this->state_Header->CCSEvents, "BeforeShow", $this->state_Header);
                            if ($this->state_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section state_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section state_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->state_Footer->CCSEventResult = CCGetEvent($this->state_Footer->CCSEvents, "BeforeShow", $this->state_Footer);
                            if ($this->state_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section state_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section state_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End smart_eqtoppan_smart_prev1 Class @2-FCB6E20C

class clssmart_eqtoppan_smart_prev1DataSource extends clsDBSMART {  //smart_eqtoppan_smart_prev1DataSource Class @2-5BC17885

//DataSource Variables @2-95BC0E02
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $state;
    var $eqtop_toppan;
    var $prvt_date;
    var $prvt_byuser;
    var $prvt_byuser2;
    var $branch;
    var $branchcode;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0388D402
    function clssmart_eqtoppan_smart_prev1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report smart_eqtoppan_smart_prev1";
        $this->Initialize();
        $this->state = new clsField("state", ccsText, "");
        
        $this->eqtop_toppan = new clsField("eqtop_toppan", ccsText, "");
        
        $this->prvt_date = new clsField("prvt_date", ccsText, "");
        
        $this->prvt_byuser = new clsField("prvt_byuser", ccsText, "");
        
        $this->prvt_byuser2 = new clsField("prvt_byuser2", ccsText, "");
        
        $this->branch = new clsField("branch", ccsText, "");
        
        $this->branchcode = new clsField("branchcode", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-5A0D3044
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "eqtop_branch, eqtop_toppan";
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

//Open Method @2-DB54792F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT smart_eqtoppan.*, ref_type \n\n" .
        "FROM smart_eqtoppan INNER JOIN smart_referencecode ON\n\n" .
        "smart_eqtoppan.eqtop_branch = smart_referencecode.ref_value {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "smart_referencecode.ref_type asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CF4DD299
    function SetValues()
    {
        $this->state->SetDBValue($this->f("ref_type"));
        $this->eqtop_toppan->SetDBValue($this->f("eqtop_toppan"));
        $this->prvt_date->SetDBValue($this->f("prvt_date"));
        $this->prvt_byuser->SetDBValue($this->f("prvt_byuser"));
        $this->prvt_byuser2->SetDBValue($this->f("prvt_byuser2"));
        $this->branch->SetDBValue($this->f("eqtop_branch"));
        $this->branchcode->SetDBValue($this->f("eqtop_branch"));
    }
//End SetValues Method

} //End smart_eqtoppan_smart_prev1DataSource Class @2-FCB6E20C

//Initialize Page @1-1F242123
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
$TemplateFileName = "printrptpm.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-25F385FC
include_once("./printrptpm_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-81497A86
$DBSMART = new clsDBSMART();
$MainPage->Connections["SMART"] = & $DBSMART;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$smart_eqtoppan_smart_prev1 = & new clsReportsmart_eqtoppan_smart_prev1("", $MainPage);
$PanHeadPage = & new clsPanel("PanHeadPage", $MainPage);
$lblMonth = & new clsControl(ccsLabel, "lblMonth", "lblMonth", ccsText, "", CCGetRequestParam("lblMonth", ccsGet, NULL), $MainPage);
$lblYear = & new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", ccsGet, NULL), $MainPage);
$MainPage->smart_eqtoppan_smart_prev1 = & $smart_eqtoppan_smart_prev1;
$MainPage->PanHeadPage = & $PanHeadPage;
$MainPage->lblMonth = & $lblMonth;
$MainPage->lblYear = & $lblYear;
$PanHeadPage->AddComponent("lblMonth", $lblMonth);
$PanHeadPage->AddComponent("lblYear", $lblYear);
$smart_eqtoppan_smart_prev1->Initialize();

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

//Go to destination page @1-37A94D87
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBSMART->close();
    header("Location: " . $Redirect);
    unset($smart_eqtoppan_smart_prev1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CA3F1321
$smart_eqtoppan_smart_prev1->Show();
$PanHeadPage->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9ACB8E84
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBSMART->close();
unset($smart_eqtoppan_smart_prev1);
unset($Tpl);
//End Unload Page


?>
