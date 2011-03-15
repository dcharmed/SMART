<?php
//smart_ticket_smart_resolu ReportGroup class @2-23F2B4C3
class clsReportGroupreportsrsltnnotesmart_ticket_smart_resolu {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $Report_TotalRecords, $_Report_TotalRecordsAttributes;
    var $tckt_refnumber, $tckt_refnumberDup, $_tckt_refnumberAttributes;
    var $Report_Row_Number, $_Report_Row_NumberAttributes;
    var $rsltn_type, $_rsltn_typeAttributes;
    var $rsltn_date, $_rsltn_dateAttributes;
    var $rsltn_byuser, $_rsltn_byuserAttributes;
    var $rsltn_actiontaken, $_rsltn_actiontakenAttributes;
    var $ticket_id, $_ticket_idAttributes;
    var $tckt_engineer, $_tckt_engineerAttributes;
    var $tckt_r_date, $_tckt_r_dateAttributes;
    var $tckt_site, $_tckt_siteAttributes;
    var $tckt_description, $_tckt_descriptionAttributes;
    var $tckt_c_date, $_tckt_c_dateAttributes;
    var $tckt_c_method, $_tckt_c_methodAttributes;
    var $Report_CurrentDateTime, $_Report_CurrentDateTimeAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $tckt_refnumberTotalIndex;

    function clsReportGroupreportsrsltnnotesmart_ticket_smart_resolu(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->tckt_refnumber = $this->Parent->tckt_refnumber->Value;
        $this->rsltn_type = $this->Parent->rsltn_type->Value;
        $this->rsltn_date = $this->Parent->rsltn_date->Value;
        $this->rsltn_byuser = $this->Parent->rsltn_byuser->Value;
        $this->rsltn_actiontaken = $this->Parent->rsltn_actiontaken->Value;
        $this->ticket_id = $this->Parent->ticket_id->Value;
        $this->tckt_engineer = $this->Parent->tckt_engineer->Value;
        $this->tckt_r_date = $this->Parent->tckt_r_date->Value;
        $this->tckt_site = $this->Parent->tckt_site->Value;
        $this->tckt_description = $this->Parent->tckt_description->Value;
        $this->tckt_c_date = $this->Parent->tckt_c_date->Value;
        $this->tckt_c_method = $this->Parent->tckt_c_method->Value;
        if ($PrevGroup) {
            $this->tckt_refnumberDup =  CCCompareValues($this->tckt_refnumber, $PrevGroup->tckt_refnumber, $this->Parent->tckt_refnumber->DataType) == 0;
        }
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetTotalValue($mode);
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->_Report_TotalRecordsAttributes = $this->Parent->Report_TotalRecords->Attributes->GetAsArray();
        $this->_tckt_refnumberAttributes = $this->Parent->tckt_refnumber->Attributes->GetAsArray();
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_rsltn_typeAttributes = $this->Parent->rsltn_type->Attributes->GetAsArray();
        $this->_rsltn_dateAttributes = $this->Parent->rsltn_date->Attributes->GetAsArray();
        $this->_rsltn_byuserAttributes = $this->Parent->rsltn_byuser->Attributes->GetAsArray();
        $this->_rsltn_actiontakenAttributes = $this->Parent->rsltn_actiontaken->Attributes->GetAsArray();
        $this->_ticket_idAttributes = $this->Parent->ticket_id->Attributes->GetAsArray();
        $this->_tckt_engineerAttributes = $this->Parent->tckt_engineer->Attributes->GetAsArray();
        $this->_tckt_r_dateAttributes = $this->Parent->tckt_r_date->Attributes->GetAsArray();
        $this->_tckt_siteAttributes = $this->Parent->tckt_site->Attributes->GetAsArray();
        $this->_tckt_descriptionAttributes = $this->Parent->tckt_description->Attributes->GetAsArray();
        $this->_tckt_c_dateAttributes = $this->Parent->tckt_c_date->Attributes->GetAsArray();
        $this->_tckt_c_methodAttributes = $this->Parent->tckt_c_method->Attributes->GetAsArray();
        $this->_Report_CurrentDateTimeAttributes = $this->Parent->Report_CurrentDateTime->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_TotalRecords = $this->Report_TotalRecords;
        $Header->_Report_TotalRecordsAttributes = $this->_Report_TotalRecordsAttributes;
        $Header->Report_Row_Number = $this->Report_Row_Number;
        $Header->_Report_Row_NumberAttributes = $this->_Report_Row_NumberAttributes;
        $this->tckt_refnumber = $Header->tckt_refnumber;
        $Header->_tckt_refnumberAttributes = $this->_tckt_refnumberAttributes;
        $this->Parent->tckt_refnumber->Value = $Header->tckt_refnumber;
        $this->Parent->tckt_refnumber->Attributes->RestoreFromArray($Header->_tckt_refnumberAttributes);
        $this->rsltn_type = $Header->rsltn_type;
        $Header->_rsltn_typeAttributes = $this->_rsltn_typeAttributes;
        $this->Parent->rsltn_type->Value = $Header->rsltn_type;
        $this->Parent->rsltn_type->Attributes->RestoreFromArray($Header->_rsltn_typeAttributes);
        $this->rsltn_date = $Header->rsltn_date;
        $Header->_rsltn_dateAttributes = $this->_rsltn_dateAttributes;
        $this->Parent->rsltn_date->Value = $Header->rsltn_date;
        $this->Parent->rsltn_date->Attributes->RestoreFromArray($Header->_rsltn_dateAttributes);
        $this->rsltn_byuser = $Header->rsltn_byuser;
        $Header->_rsltn_byuserAttributes = $this->_rsltn_byuserAttributes;
        $this->Parent->rsltn_byuser->Value = $Header->rsltn_byuser;
        $this->Parent->rsltn_byuser->Attributes->RestoreFromArray($Header->_rsltn_byuserAttributes);
        $this->rsltn_actiontaken = $Header->rsltn_actiontaken;
        $Header->_rsltn_actiontakenAttributes = $this->_rsltn_actiontakenAttributes;
        $this->Parent->rsltn_actiontaken->Value = $Header->rsltn_actiontaken;
        $this->Parent->rsltn_actiontaken->Attributes->RestoreFromArray($Header->_rsltn_actiontakenAttributes);
        $this->ticket_id = $Header->ticket_id;
        $Header->_ticket_idAttributes = $this->_ticket_idAttributes;
        $this->Parent->ticket_id->Value = $Header->ticket_id;
        $this->Parent->ticket_id->Attributes->RestoreFromArray($Header->_ticket_idAttributes);
        $this->tckt_engineer = $Header->tckt_engineer;
        $Header->_tckt_engineerAttributes = $this->_tckt_engineerAttributes;
        $this->Parent->tckt_engineer->Value = $Header->tckt_engineer;
        $this->Parent->tckt_engineer->Attributes->RestoreFromArray($Header->_tckt_engineerAttributes);
        $this->tckt_r_date = $Header->tckt_r_date;
        $Header->_tckt_r_dateAttributes = $this->_tckt_r_dateAttributes;
        $this->Parent->tckt_r_date->Value = $Header->tckt_r_date;
        $this->Parent->tckt_r_date->Attributes->RestoreFromArray($Header->_tckt_r_dateAttributes);
        $this->tckt_site = $Header->tckt_site;
        $Header->_tckt_siteAttributes = $this->_tckt_siteAttributes;
        $this->Parent->tckt_site->Value = $Header->tckt_site;
        $this->Parent->tckt_site->Attributes->RestoreFromArray($Header->_tckt_siteAttributes);
        $this->tckt_description = $Header->tckt_description;
        $Header->_tckt_descriptionAttributes = $this->_tckt_descriptionAttributes;
        $this->Parent->tckt_description->Value = $Header->tckt_description;
        $this->Parent->tckt_description->Attributes->RestoreFromArray($Header->_tckt_descriptionAttributes);
        $this->tckt_c_date = $Header->tckt_c_date;
        $Header->_tckt_c_dateAttributes = $this->_tckt_c_dateAttributes;
        $this->Parent->tckt_c_date->Value = $Header->tckt_c_date;
        $this->Parent->tckt_c_date->Attributes->RestoreFromArray($Header->_tckt_c_dateAttributes);
        $this->tckt_c_method = $Header->tckt_c_method;
        $Header->_tckt_c_methodAttributes = $this->_tckt_c_methodAttributes;
        $this->Parent->tckt_c_method->Value = $Header->tckt_c_method;
        $this->Parent->tckt_c_method->Attributes->RestoreFromArray($Header->_tckt_c_methodAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetValue();
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
    }
}
//End smart_ticket_smart_resolu ReportGroup class

//smart_ticket_smart_resolu GroupsCollection class @2-59E71509
class clsGroupsCollectionreportsrsltnnotesmart_ticket_smart_resolu {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $mtckt_refnumberCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionreportsrsltnnotesmart_ticket_smart_resolu(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mtckt_refnumberCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupreportsrsltnnotesmart_ticket_smart_resolu($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->tckt_refnumberTotalIndex = $this->mtckt_refnumberCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Report_TotalRecords->Value = $this->Parent->Report_TotalRecords->initialValue;
        $this->Parent->tckt_refnumber->Value = $this->Parent->tckt_refnumber->initialValue;
        $this->Parent->Report_Row_Number->Value = $this->Parent->Report_Row_Number->initialValue;
        $this->Parent->rsltn_type->Value = $this->Parent->rsltn_type->initialValue;
        $this->Parent->rsltn_date->Value = $this->Parent->rsltn_date->initialValue;
        $this->Parent->rsltn_byuser->Value = $this->Parent->rsltn_byuser->initialValue;
        $this->Parent->rsltn_actiontaken->Value = $this->Parent->rsltn_actiontaken->initialValue;
        $this->Parent->ticket_id->Value = $this->Parent->ticket_id->initialValue;
        $this->Parent->tckt_engineer->Value = $this->Parent->tckt_engineer->initialValue;
        $this->Parent->tckt_r_date->Value = $this->Parent->tckt_r_date->initialValue;
        $this->Parent->tckt_site->Value = $this->Parent->tckt_site->initialValue;
        $this->Parent->tckt_description->Value = $this->Parent->tckt_description->initialValue;
        $this->Parent->tckt_c_date->Value = $this->Parent->tckt_c_date->initialValue;
        $this->Parent->tckt_c_method->Value = $this->Parent->tckt_c_method->initialValue;
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
        if ($groupName == "tckt_refnumber") {
            $Grouptckt_refnumber = & $this->InitGroup(true);
            $this->Parent->tckt_refnumber_Header->CCSEventResult = CCGetEvent($this->Parent->tckt_refnumber_Header->CCSEvents, "OnInitialize", $this->Parent->tckt_refnumber_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->tckt_refnumber_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->tckt_refnumber_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->tckt_refnumber_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->tckt_refnumber_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->tckt_refnumber_Header->Height;
                $Grouptckt_refnumber->SetTotalControls("GetNextValue");
            $this->Parent->tckt_refnumber_Header->CCSEventResult = CCGetEvent($this->Parent->tckt_refnumber_Header->CCSEvents, "OnCalculate", $this->Parent->tckt_refnumber_Header);
            $Grouptckt_refnumber->SetControls();
            $Grouptckt_refnumber->Mode = 1;
            $Grouptckt_refnumber->GroupType = "tckt_refnumber";
            $this->mtckt_refnumberCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Grouptckt_refnumber;
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
        $Grouptckt_refnumber = & $this->InitGroup(true);
        $this->Parent->tckt_refnumber_Footer->CCSEventResult = CCGetEvent($this->Parent->tckt_refnumber_Footer->CCSEvents, "OnInitialize", $this->Parent->tckt_refnumber_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->tckt_refnumber_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->tckt_refnumber_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->tckt_refnumber_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Grouptckt_refnumber->SetTotalControls("GetPrevValue");
        $Grouptckt_refnumber->SyncWithHeader($this->Groups[$this->mtckt_refnumberCurrentHeaderIndex]);
        if ($this->Parent->tckt_refnumber_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->tckt_refnumber_Footer->Height;
        $this->Parent->tckt_refnumber_Footer->CCSEventResult = CCGetEvent($this->Parent->tckt_refnumber_Footer->CCSEvents, "OnCalculate", $this->Parent->tckt_refnumber_Footer);
        $Grouptckt_refnumber->SetControls();
        $this->RestoreValues();
        $Grouptckt_refnumber->Mode = 2;
        $Grouptckt_refnumber->GroupType ="tckt_refnumber";
        $this->Groups[] = & $Grouptckt_refnumber;
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
//End smart_ticket_smart_resolu GroupsCollection class

class clsReportreportsrsltnnotesmart_ticket_smart_resolu { //smart_ticket_smart_resolu Class @2-2E1BEA5E

//smart_ticket_smart_resolu Variables @2-385AF6A4

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
    var $tckt_refnumber_HeaderBlock, $tckt_refnumber_Header;
    var $tckt_refnumber_FooterBlock, $tckt_refnumber_Footer;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $tckt_refnumber_HeaderControls, $tckt_refnumber_FooterControls;
//End smart_ticket_smart_resolu Variables

//Class_Initialize Event @2-60B6C106
    function clsReportreportsrsltnnotesmart_ticket_smart_resolu($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "smart_ticket_smart_resolu";
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
        $this->tckt_refnumber_Footer = new clsSection($this);
        $this->tckt_refnumber_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsreportsrsltnnotesmart_ticket_smart_resoluDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 50;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 50;
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

        $this->Report_TotalRecords = & new clsControl(ccsReportLabel, "Report_TotalRecords", "Report_TotalRecords", ccsText, "", 0, $this);
        $this->Report_TotalRecords->TotalFunction = "Count";
        $this->Report_TotalRecords->IsEmptySource = true;
        $this->tckt_refnumber = & new clsControl(ccsReportLabel, "tckt_refnumber", "tckt_refnumber", ccsText, "", "", $this);
        $this->Report_Row_Number = & new clsControl(ccsReportLabel, "Report_Row_Number", "Report_Row_Number", ccsInteger, "", 0, $this);
        $this->Report_Row_Number->TotalFunction = "Count";
        $this->Report_Row_Number->IsEmptySource = true;
        $this->rsltn_type = & new clsControl(ccsReportLabel, "rsltn_type", "rsltn_type", ccsText, "", "", $this);
        $this->rsltn_date = & new clsControl(ccsReportLabel, "rsltn_date", "rsltn_date", ccsDate, $DefaultDateFormat, "", $this);
        $this->rsltn_byuser = & new clsControl(ccsReportLabel, "rsltn_byuser", "rsltn_byuser", ccsInteger, "", "", $this);
        $this->rsltn_actiontaken = & new clsControl(ccsReportLabel, "rsltn_actiontaken", "rsltn_actiontaken", ccsMemo, "", "", $this);
        $this->ticket_id = & new clsControl(ccsReportLabel, "ticket_id", "ticket_id", ccsInteger, "", "", $this);
        $this->tckt_engineer = & new clsControl(ccsReportLabel, "tckt_engineer", "tckt_engineer", ccsText, "", "", $this);
        $this->tckt_r_date = & new clsControl(ccsReportLabel, "tckt_r_date", "tckt_r_date", ccsDate, $DefaultDateFormat, "", $this);
        $this->tckt_site = & new clsControl(ccsReportLabel, "tckt_site", "tckt_site", ccsText, "", "", $this);
        $this->tckt_description = & new clsControl(ccsReportLabel, "tckt_description", "tckt_description", ccsMemo, "", "", $this);
        $this->tckt_c_date = & new clsControl(ccsReportLabel, "tckt_c_date", "tckt_c_date", ccsDate, $DefaultDateFormat, "", $this);
        $this->tckt_c_method = & new clsControl(ccsReportLabel, "tckt_c_method", "tckt_c_method", ccsText, "", "", $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->PageBreak = & new clsPanel("PageBreak", $this);
        $this->Report_CurrentDateTime = & new clsControl(ccsReportLabel, "Report_CurrentDateTime", "Report_CurrentDateTime", ccsText, array('ShortDate', ' ', 'ShortTime'), "", $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//CheckErrors Method @2-1742DF9D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Report_TotalRecords->Errors->Count());
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->rsltn_type->Errors->Count());
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->ticket_id->Errors->Count());
        $errors = ($errors || $this->tckt_engineer->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->tckt_c_date->Errors->Count());
        $errors = ($errors || $this->tckt_c_method->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDateTime->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-5D8B76B2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Report_TotalRecords->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_actiontaken->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ticket_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_engineer->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_method->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDateTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-3776B266
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $tckt_refnumberKey = "";
        $Groups = new clsGroupsCollectionreportsrsltnnotesmart_ticket_smart_resolu($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
            $this->rsltn_type->SetValue($this->DataSource->rsltn_type->GetValue());
            $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
            $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
            $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
            $this->ticket_id->SetValue($this->DataSource->ticket_id->GetValue());
            $this->tckt_engineer->SetValue($this->DataSource->tckt_engineer->GetValue());
            $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
            $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
            $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
            $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
            $this->tckt_c_method->SetValue($this->DataSource->tckt_c_method->GetValue());
            $this->Report_TotalRecords->SetValue(1);
            $this->Report_Row_Number->SetValue(1);
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $tckt_refnumberKey != $this->DataSource->f("tckt_refnumber")) {
                $Groups->OpenGroup("tckt_refnumber");
            }
            $Groups->AddItem();
            $tckt_refnumberKey = $this->DataSource->f("tckt_refnumber");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $tckt_refnumberKey != $this->DataSource->f("tckt_refnumber")) {
                $Groups->CloseGroup("tckt_refnumber");
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
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["Report_Row_Number"] = $this->Report_Row_Number->Visible;
            $this->ControlsVisible["rsltn_type"] = $this->rsltn_type->Visible;
            $this->ControlsVisible["rsltn_date"] = $this->rsltn_date->Visible;
            $this->ControlsVisible["rsltn_byuser"] = $this->rsltn_byuser->Visible;
            $this->ControlsVisible["rsltn_actiontaken"] = $this->rsltn_actiontaken->Visible;
            $this->ControlsVisible["ticket_id"] = $this->ticket_id->Visible;
            $this->ControlsVisible["tckt_engineer"] = $this->tckt_engineer->Visible;
            $this->ControlsVisible["tckt_r_date"] = $this->tckt_r_date->Visible;
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["tckt_c_date"] = $this->tckt_c_date->Visible;
            $this->ControlsVisible["tckt_c_method"] = $this->tckt_c_method->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->tckt_refnumber->Visible = $this->ControlsVisible["tckt_refnumber"] && !$items[$i]->tckt_refnumberDup;
                        $this->tckt_refnumber->SetValue($items[$i]->tckt_refnumber);
                        $this->tckt_refnumber->Attributes->RestoreFromArray($items[$i]->_tckt_refnumberAttributes);
                        $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                        $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                        $this->rsltn_type->SetValue($items[$i]->rsltn_type);
                        $this->rsltn_type->Attributes->RestoreFromArray($items[$i]->_rsltn_typeAttributes);
                        $this->rsltn_date->SetValue($items[$i]->rsltn_date);
                        $this->rsltn_date->Attributes->RestoreFromArray($items[$i]->_rsltn_dateAttributes);
                        $this->rsltn_byuser->SetValue($items[$i]->rsltn_byuser);
                        $this->rsltn_byuser->Attributes->RestoreFromArray($items[$i]->_rsltn_byuserAttributes);
                        $this->rsltn_actiontaken->SetValue($items[$i]->rsltn_actiontaken);
                        $this->rsltn_actiontaken->Attributes->RestoreFromArray($items[$i]->_rsltn_actiontakenAttributes);
                        $this->ticket_id->SetValue($items[$i]->ticket_id);
                        $this->ticket_id->Attributes->RestoreFromArray($items[$i]->_ticket_idAttributes);
                        $this->tckt_engineer->SetValue($items[$i]->tckt_engineer);
                        $this->tckt_engineer->Attributes->RestoreFromArray($items[$i]->_tckt_engineerAttributes);
                        $this->tckt_r_date->SetValue($items[$i]->tckt_r_date);
                        $this->tckt_r_date->Attributes->RestoreFromArray($items[$i]->_tckt_r_dateAttributes);
                        $this->tckt_site->SetValue($items[$i]->tckt_site);
                        $this->tckt_site->Attributes->RestoreFromArray($items[$i]->_tckt_siteAttributes);
                        $this->tckt_description->SetValue($items[$i]->tckt_description);
                        $this->tckt_description->Attributes->RestoreFromArray($items[$i]->_tckt_descriptionAttributes);
                        $this->tckt_c_date->SetValue($items[$i]->tckt_c_date);
                        $this->tckt_c_date->Attributes->RestoreFromArray($items[$i]->_tckt_c_dateAttributes);
                        $this->tckt_c_method->SetValue($items[$i]->tckt_c_method);
                        $this->tckt_c_method->Attributes->RestoreFromArray($items[$i]->_tckt_c_methodAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->tckt_refnumber->Show();
                        $this->Report_Row_Number->Show();
                        $this->rsltn_type->Show();
                        $this->rsltn_date->Show();
                        $this->rsltn_byuser->Show();
                        $this->rsltn_actiontaken->Show();
                        $this->ticket_id->Show();
                        $this->tckt_engineer->Show();
                        $this->tckt_r_date->Show();
                        $this->tckt_site->Show();
                        $this->tckt_description->Show();
                        $this->tckt_c_date->Show();
                        $this->tckt_c_method->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_TotalRecords->SetValue($items[$i]->Report_TotalRecords);
                            $this->Report_TotalRecords->Attributes->RestoreFromArray($items[$i]->_Report_TotalRecordsAttributes);
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $this->Report_TotalRecords->Show();
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
                            $this->PageBreak->Visible = (($i < count($items) - 1) && ($this->ViewMode == "Print"));
                            $this->Report_CurrentDateTime->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDateTime->Format));
                            $this->Report_CurrentDateTime->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateTimeAttributes);
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->PageBreak->Show();
                                $this->Report_CurrentDateTime->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "tckt_refnumber":
                        if ($items[$i]->Mode == 1) {
                            $this->tckt_refnumber_Header->CCSEventResult = CCGetEvent($this->tckt_refnumber_Header->CCSEvents, "BeforeShow", $this->tckt_refnumber_Header);
                            if ($this->tckt_refnumber_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section tckt_refnumber_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section tckt_refnumber_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->tckt_refnumber_Footer->CCSEventResult = CCGetEvent($this->tckt_refnumber_Footer->CCSEvents, "BeforeShow", $this->tckt_refnumber_Footer);
                            if ($this->tckt_refnumber_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section tckt_refnumber_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section tckt_refnumber_Footer", true, "Section Detail");
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

} //End smart_ticket_smart_resolu Class @2-FCB6E20C

class clsreportsrsltnnotesmart_ticket_smart_resoluDataSource extends clsDBSMART {  //smart_ticket_smart_resoluDataSource Class @2-A0C66CCB

//DataSource Variables @2-FCA412F8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $tckt_refnumber;
    var $rsltn_type;
    var $rsltn_date;
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $ticket_id;
    var $tckt_engineer;
    var $tckt_r_date;
    var $tckt_site;
    var $tckt_description;
    var $tckt_c_date;
    var $tckt_c_method;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-70C1C228
    function clsreportsrsltnnotesmart_ticket_smart_resoluDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report smart_ticket_smart_resolu";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->ticket_id = new clsField("ticket_id", ccsInteger, "");
        
        $this->tckt_engineer = new clsField("tckt_engineer", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->tckt_c_method = new clsField("tckt_c_method", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-1FE551FE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ticket_id, rsltn_date";
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

//Open Method @2-6C14AEE9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ticket_id,\n" .
        "tckt_refnumber, \n" .
        "tckt_site, \n" .
        "tckt_description, \n" .
        "tckt_engineer, \n" .
        "tckt_r_date, \n" .
        "tckt_c_date, \n" .
        "left(timediff(tckt_c_date,tckt_r_date),locate(':',timediff(tckt_c_date,tckt_r_date))-1) as TCKT_AGE,\n" .
        "tckt_c_method, \n" .
        "rsltn_type, \n" .
        "rsltn_date, \n" .
        "rsltn_byuser, \n" .
        "rsltn_actiontaken \n" .
        "\n" .
        "FROM \n" .
        "smart_ticket LEFT JOIN smart_resolutionnote on \n" .
        "smart_ticket.id = smart_resolutionnote.ticket_id\n" .
        "\n" .
        "WHERE smart_resolutionnote.ticket_id < ALL (SELECT smart_resolutionnote.ticket_id \n" .
        "FROM smart_resolutionnote\n" .
        "WHERE\n" .
        "rsltn_actiontaken like '%ghost%' OR\n" .
        "rsltn_actiontaken like '%restore%') {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "smart_ticket.tckt_refnumber asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B954BF54
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->ticket_id->SetDBValue(trim($this->f("ticket_id")));
        $this->tckt_engineer->SetDBValue($this->f("tckt_engineer"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->tckt_c_method->SetDBValue($this->f("tckt_c_method"));
    }
//End SetValues Method

} //End smart_ticket_smart_resoluDataSource Class @2-FCB6E20C

class clsRecordreportsrsltnnotesmart_resolutionnote_smar { //smart_resolutionnote_smar Class @8-E610DE74

//Variables @8-D6FF3E86

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

//Class_Initialize Event @8-166D19BA
    function clsRecordreportsrsltnnotesmart_resolutionnote_smar($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record smart_resolutionnote_smar/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "smart_resolutionnote_smar";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_tckt_r_date = & new clsControl(ccsTextBox, "s_tckt_r_date", "s_tckt_r_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_tckt_r_date", $Method, NULL), $this);
            $this->DatePicker_s_tckt_r_date = & new clsDatePicker("DatePicker_s_tckt_r_date", "smart_resolutionnote_smar", "s_tckt_r_date", $this);
            $this->s_tckt_state = & new clsControl(ccsListBox, "s_tckt_state", "s_tckt_state", ccsText, "", CCGetRequestParam("s_tckt_state", $Method, NULL), $this);
            $this->s_tckt_site = & new clsControl(ccsListBox, "s_tckt_site", "s_tckt_site", ccsText, "", CCGetRequestParam("s_tckt_site", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @8-6CDFDF8B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_tckt_r_date->Validate() && $Validation);
        $Validation = ($this->s_tckt_state->Validate() && $Validation);
        $Validation = ($this->s_tckt_site->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_tckt_r_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tckt_state->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tckt_site->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @8-3D8795A5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_tckt_r_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_tckt_r_date->Errors->Count());
        $errors = ($errors || $this->s_tckt_state->Errors->Count());
        $errors = ($errors || $this->s_tckt_site->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @8-ED598703
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

//Operation Method @8-8C2B2EC9
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "reportsrsltnnote.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reportsrsltnnote.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @8-A40A3F16
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

        $this->s_tckt_state->Prepare();
        $this->s_tckt_site->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_tckt_r_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tckt_state->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tckt_site->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_tckt_r_date->Show();
        $this->DatePicker_s_tckt_r_date->Show();
        $this->s_tckt_state->Show();
        $this->s_tckt_site->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End smart_resolutionnote_smar Class @8-FCB6E20C

class clsreportsrsltnnote { //reportsrsltnnote class @1-6BBB103E

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

//Class_Initialize Event @1-F71417D9
    function clsreportsrsltnnote($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportsrsltnnote.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportsrsltnnote.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-4C1DEAB4
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->smart_ticket_smart_resolu);
        unset($this->smart_resolutionnote_smar);
    }
//End Class_Terminate Event

//BindEvents Method @1-79779817
    function BindEvents()
    {
        $this->smart_ticket_smart_resolu->Navigator->CCSEvents["BeforeShow"] = "reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-1000BA0C
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->smart_resolutionnote_smar->Operation();
    }
//End Operations Method

//Initialize Method @1-8C09659D
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
        $this->smart_ticket_smart_resolu = & new clsReportreportsrsltnnotesmart_ticket_smart_resolu($this->RelativePath, $this);
        $this->smart_resolutionnote_smar = & new clsRecordreportsrsltnnotesmart_resolutionnote_smar($this->RelativePath, $this);
        $this->smart_ticket_smart_resolu->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-645F414F
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
        $this->smart_ticket_smart_resolu->Show();
        $this->smart_resolutionnote_smar->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportsrsltnnote Class @1-FCB6E20C

//Include Event File @1-F2B1A398
include_once(RelativePath . "/reportsrsltnnote_events.php");
//End Include Event File


?>
