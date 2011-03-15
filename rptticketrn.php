<?php
//RepTickets ReportGroup class @2-676880FF
class clsReportGrouprptticketrnRepTickets {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $Report_TotalRecords, $_Report_TotalRecordsAttributes;
    var $tckt_refnumber, $_tckt_refnumberAttributes;
    var $Report_Row_Number, $_Report_Row_NumberAttributes;
    var $rsltn_byuser, $_rsltn_byuserAttributes;
    var $rsltn_actiontaken, $_rsltn_actiontakenAttributes;
    var $rsltn_date, $_rsltn_dateAttributes;
    var $tckt_status, $_tckt_statusAttributes;
    var $tckt_escalate, $_tckt_escalateAttributes;
    var $tckt_r_date, $_tckt_r_dateAttributes;
    var $tckt_site, $_tckt_siteAttributes;
    var $tckt_severity, $_tckt_severityAttributes;
    var $tckt_adukomn, $_tckt_adukomnAttributes;
    var $tckt_category, $_tckt_categoryAttributes;
    var $tckt_description, $_tckt_descriptionAttributes;
    var $tckt_c_date, $_tckt_c_dateAttributes;
    var $rsltn_eta, $_rsltn_etaAttributes;
    var $rsltn_etd, $_rsltn_etdAttributes;
    var $Report_CurrentDateTime, $_Report_CurrentDateTimeAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $tckt_refnumberTotalIndex;

    function clsReportGrouprptticketrnRepTickets(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->tckt_refnumber = $this->Parent->tckt_refnumber->Value;
        $this->rsltn_byuser = $this->Parent->rsltn_byuser->Value;
        $this->rsltn_actiontaken = $this->Parent->rsltn_actiontaken->Value;
        $this->rsltn_date = $this->Parent->rsltn_date->Value;
        $this->tckt_status = $this->Parent->tckt_status->Value;
        $this->tckt_escalate = $this->Parent->tckt_escalate->Value;
        $this->tckt_r_date = $this->Parent->tckt_r_date->Value;
        $this->tckt_site = $this->Parent->tckt_site->Value;
        $this->tckt_severity = $this->Parent->tckt_severity->Value;
        $this->tckt_adukomn = $this->Parent->tckt_adukomn->Value;
        $this->tckt_category = $this->Parent->tckt_category->Value;
        $this->tckt_description = $this->Parent->tckt_description->Value;
        $this->tckt_c_date = $this->Parent->tckt_c_date->Value;
        $this->rsltn_eta = $this->Parent->rsltn_eta->Value;
        $this->rsltn_etd = $this->Parent->rsltn_etd->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetTotalValue($mode);
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->_Report_TotalRecordsAttributes = $this->Parent->Report_TotalRecords->Attributes->GetAsArray();
        $this->_tckt_refnumberAttributes = $this->Parent->tckt_refnumber->Attributes->GetAsArray();
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_rsltn_byuserAttributes = $this->Parent->rsltn_byuser->Attributes->GetAsArray();
        $this->_rsltn_actiontakenAttributes = $this->Parent->rsltn_actiontaken->Attributes->GetAsArray();
        $this->_rsltn_dateAttributes = $this->Parent->rsltn_date->Attributes->GetAsArray();
        $this->_tckt_statusAttributes = $this->Parent->tckt_status->Attributes->GetAsArray();
        $this->_tckt_escalateAttributes = $this->Parent->tckt_escalate->Attributes->GetAsArray();
        $this->_tckt_r_dateAttributes = $this->Parent->tckt_r_date->Attributes->GetAsArray();
        $this->_tckt_siteAttributes = $this->Parent->tckt_site->Attributes->GetAsArray();
        $this->_tckt_severityAttributes = $this->Parent->tckt_severity->Attributes->GetAsArray();
        $this->_tckt_adukomnAttributes = $this->Parent->tckt_adukomn->Attributes->GetAsArray();
        $this->_tckt_categoryAttributes = $this->Parent->tckt_category->Attributes->GetAsArray();
        $this->_tckt_descriptionAttributes = $this->Parent->tckt_description->Attributes->GetAsArray();
        $this->_tckt_c_dateAttributes = $this->Parent->tckt_c_date->Attributes->GetAsArray();
        $this->_rsltn_etaAttributes = $this->Parent->rsltn_eta->Attributes->GetAsArray();
        $this->_rsltn_etdAttributes = $this->Parent->rsltn_etd->Attributes->GetAsArray();
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
        $this->rsltn_byuser = $Header->rsltn_byuser;
        $Header->_rsltn_byuserAttributes = $this->_rsltn_byuserAttributes;
        $this->Parent->rsltn_byuser->Value = $Header->rsltn_byuser;
        $this->Parent->rsltn_byuser->Attributes->RestoreFromArray($Header->_rsltn_byuserAttributes);
        $this->rsltn_actiontaken = $Header->rsltn_actiontaken;
        $Header->_rsltn_actiontakenAttributes = $this->_rsltn_actiontakenAttributes;
        $this->Parent->rsltn_actiontaken->Value = $Header->rsltn_actiontaken;
        $this->Parent->rsltn_actiontaken->Attributes->RestoreFromArray($Header->_rsltn_actiontakenAttributes);
        $this->rsltn_date = $Header->rsltn_date;
        $Header->_rsltn_dateAttributes = $this->_rsltn_dateAttributes;
        $this->Parent->rsltn_date->Value = $Header->rsltn_date;
        $this->Parent->rsltn_date->Attributes->RestoreFromArray($Header->_rsltn_dateAttributes);
        $this->tckt_status = $Header->tckt_status;
        $Header->_tckt_statusAttributes = $this->_tckt_statusAttributes;
        $this->Parent->tckt_status->Value = $Header->tckt_status;
        $this->Parent->tckt_status->Attributes->RestoreFromArray($Header->_tckt_statusAttributes);
        $this->tckt_escalate = $Header->tckt_escalate;
        $Header->_tckt_escalateAttributes = $this->_tckt_escalateAttributes;
        $this->Parent->tckt_escalate->Value = $Header->tckt_escalate;
        $this->Parent->tckt_escalate->Attributes->RestoreFromArray($Header->_tckt_escalateAttributes);
        $this->tckt_r_date = $Header->tckt_r_date;
        $Header->_tckt_r_dateAttributes = $this->_tckt_r_dateAttributes;
        $this->Parent->tckt_r_date->Value = $Header->tckt_r_date;
        $this->Parent->tckt_r_date->Attributes->RestoreFromArray($Header->_tckt_r_dateAttributes);
        $this->tckt_site = $Header->tckt_site;
        $Header->_tckt_siteAttributes = $this->_tckt_siteAttributes;
        $this->Parent->tckt_site->Value = $Header->tckt_site;
        $this->Parent->tckt_site->Attributes->RestoreFromArray($Header->_tckt_siteAttributes);
        $this->tckt_severity = $Header->tckt_severity;
        $Header->_tckt_severityAttributes = $this->_tckt_severityAttributes;
        $this->Parent->tckt_severity->Value = $Header->tckt_severity;
        $this->Parent->tckt_severity->Attributes->RestoreFromArray($Header->_tckt_severityAttributes);
        $this->tckt_adukomn = $Header->tckt_adukomn;
        $Header->_tckt_adukomnAttributes = $this->_tckt_adukomnAttributes;
        $this->Parent->tckt_adukomn->Value = $Header->tckt_adukomn;
        $this->Parent->tckt_adukomn->Attributes->RestoreFromArray($Header->_tckt_adukomnAttributes);
        $this->tckt_category = $Header->tckt_category;
        $Header->_tckt_categoryAttributes = $this->_tckt_categoryAttributes;
        $this->Parent->tckt_category->Value = $Header->tckt_category;
        $this->Parent->tckt_category->Attributes->RestoreFromArray($Header->_tckt_categoryAttributes);
        $this->tckt_description = $Header->tckt_description;
        $Header->_tckt_descriptionAttributes = $this->_tckt_descriptionAttributes;
        $this->Parent->tckt_description->Value = $Header->tckt_description;
        $this->Parent->tckt_description->Attributes->RestoreFromArray($Header->_tckt_descriptionAttributes);
        $this->tckt_c_date = $Header->tckt_c_date;
        $Header->_tckt_c_dateAttributes = $this->_tckt_c_dateAttributes;
        $this->Parent->tckt_c_date->Value = $Header->tckt_c_date;
        $this->Parent->tckt_c_date->Attributes->RestoreFromArray($Header->_tckt_c_dateAttributes);
        $this->rsltn_eta = $Header->rsltn_eta;
        $Header->_rsltn_etaAttributes = $this->_rsltn_etaAttributes;
        $this->Parent->rsltn_eta->Value = $Header->rsltn_eta;
        $this->Parent->rsltn_eta->Attributes->RestoreFromArray($Header->_rsltn_etaAttributes);
        $this->rsltn_etd = $Header->rsltn_etd;
        $Header->_rsltn_etdAttributes = $this->_rsltn_etdAttributes;
        $this->Parent->rsltn_etd->Value = $Header->rsltn_etd;
        $this->Parent->rsltn_etd->Attributes->RestoreFromArray($Header->_rsltn_etdAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetValue();
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
    }
}
//End RepTickets ReportGroup class

//RepTickets GroupsCollection class @2-A712EA57
class clsGroupsCollectionrptticketrnRepTickets {
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

    function clsGroupsCollectionrptticketrnRepTickets(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mtckt_refnumberCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGrouprptticketrnRepTickets($this->Parent);
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
        $this->Parent->rsltn_byuser->Value = $this->Parent->rsltn_byuser->initialValue;
        $this->Parent->rsltn_actiontaken->Value = $this->Parent->rsltn_actiontaken->initialValue;
        $this->Parent->rsltn_date->Value = $this->Parent->rsltn_date->initialValue;
        $this->Parent->tckt_status->Value = $this->Parent->tckt_status->initialValue;
        $this->Parent->tckt_escalate->Value = $this->Parent->tckt_escalate->initialValue;
        $this->Parent->tckt_r_date->Value = $this->Parent->tckt_r_date->initialValue;
        $this->Parent->tckt_site->Value = $this->Parent->tckt_site->initialValue;
        $this->Parent->tckt_severity->Value = $this->Parent->tckt_severity->initialValue;
        $this->Parent->tckt_adukomn->Value = $this->Parent->tckt_adukomn->initialValue;
        $this->Parent->tckt_category->Value = $this->Parent->tckt_category->initialValue;
        $this->Parent->tckt_description->Value = $this->Parent->tckt_description->initialValue;
        $this->Parent->tckt_c_date->Value = $this->Parent->tckt_c_date->initialValue;
        $this->Parent->rsltn_eta->Value = $this->Parent->rsltn_eta->initialValue;
        $this->Parent->rsltn_etd->Value = $this->Parent->rsltn_etd->initialValue;
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
//End RepTickets GroupsCollection class

class clsReportrptticketrnRepTickets { //RepTickets Class @2-14E4BCA7

//RepTickets Variables @2-385AF6A4

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
//End RepTickets Variables

//Class_Initialize Event @2-71E23D76
    function clsReportrptticketrnRepTickets($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "RepTickets";
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
        $this->tckt_refnumber_Footer = new clsSection($this);
        $this->tckt_refnumber_Header = new clsSection($this);
        $this->tckt_refnumber_Header->Height = 2;
        $MaxSectionSize = max($MaxSectionSize, $this->tckt_refnumber_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsrptticketrnRepTicketsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
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
        $this->rsltn_byuser = & new clsControl(ccsReportLabel, "rsltn_byuser", "rsltn_byuser", ccsInteger, "", "", $this);
        $this->rsltn_actiontaken = & new clsControl(ccsReportLabel, "rsltn_actiontaken", "rsltn_actiontaken", ccsMemo, "", "", $this);
        $this->rsltn_date = & new clsControl(ccsReportLabel, "rsltn_date", "rsltn_date", ccsDate, array("GeneralDate"), "", $this);
        $this->tckt_status = & new clsControl(ccsReportLabel, "tckt_status", "tckt_status", ccsInteger, "", "", $this);
        $this->tckt_escalate = & new clsControl(ccsReportLabel, "tckt_escalate", "tckt_escalate", ccsText, "", "", $this);
        $this->tckt_r_date = & new clsControl(ccsReportLabel, "tckt_r_date", "tckt_r_date", ccsDate, array("GeneralDate"), "", $this);
        $this->tckt_site = & new clsControl(ccsReportLabel, "tckt_site", "tckt_site", ccsText, "", "", $this);
        $this->tckt_severity = & new clsControl(ccsReportLabel, "tckt_severity", "tckt_severity", ccsInteger, "", "", $this);
        $this->tckt_adukomn = & new clsControl(ccsReportLabel, "tckt_adukomn", "tckt_adukomn", ccsText, "", "", $this);
        $this->tckt_category = & new clsControl(ccsReportLabel, "tckt_category", "tckt_category", ccsText, "", "", $this);
        $this->tckt_description = & new clsControl(ccsReportLabel, "tckt_description", "tckt_description", ccsMemo, "", "", $this);
        $this->tckt_c_date = & new clsControl(ccsReportLabel, "tckt_c_date", "tckt_c_date", ccsDate, array("GeneralDate"), "", $this);
        $this->rsltn_eta = & new clsControl(ccsReportLabel, "rsltn_eta", "rsltn_eta", ccsText, "", "", $this);
        $this->rsltn_etd = & new clsControl(ccsReportLabel, "rsltn_etd", "rsltn_etd", ccsText, "", "", $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
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

//CheckErrors Method @2-E2848DA3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Report_TotalRecords->Errors->Count());
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_escalate->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->tckt_adukomn->Errors->Count());
        $errors = ($errors || $this->tckt_category->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->tckt_c_date->Errors->Count());
        $errors = ($errors || $this->rsltn_eta->Errors->Count());
        $errors = ($errors || $this->rsltn_etd->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDateTime->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-5969C97F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Report_TotalRecords->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_actiontaken->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_escalate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_adukomn->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_eta->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_etd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDateTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-21225D40
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls"] = CCGetFromGet("s", NULL);
        $this->DataSource->Parameters["urlb"] = CCGetFromGet("b", NULL);
        $this->DataSource->Parameters["urlsv"] = CCGetFromGet("sv", NULL);
        $this->DataSource->Parameters["urlesc"] = CCGetFromGet("esc", NULL);
        $this->DataSource->Parameters["urlcat"] = CCGetFromGet("cat", NULL);
        $this->DataSource->Parameters["urlscat"] = CCGetFromGet("scat", NULL);
        $this->DataSource->Parameters["urldtfr"] = CCGetFromGet("dtfr", NULL);
        $this->DataSource->Parameters["urldtto"] = CCGetFromGet("dtto", NULL);
        $this->DataSource->Parameters["urlad"] = CCGetFromGet("ad", NULL);
        $this->DataSource->Parameters["urlrn"] = CCGetFromGet("rn", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $tckt_refnumberKey = "";
        $Groups = new clsGroupsCollectionrptticketrnRepTickets($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
            $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
            $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
            $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
            $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
            $this->tckt_escalate->SetValue($this->DataSource->tckt_escalate->GetValue());
            $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
            $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
            $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
            $this->tckt_adukomn->SetValue($this->DataSource->tckt_adukomn->GetValue());
            $this->tckt_category->SetValue($this->DataSource->tckt_category->GetValue());
            $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
            $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
            $this->rsltn_eta->SetValue($this->DataSource->rsltn_eta->GetValue());
            $this->rsltn_etd->SetValue($this->DataSource->rsltn_etd->GetValue());
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
            $this->ControlsVisible["rsltn_byuser"] = $this->rsltn_byuser->Visible;
            $this->ControlsVisible["rsltn_actiontaken"] = $this->rsltn_actiontaken->Visible;
            $this->ControlsVisible["rsltn_date"] = $this->rsltn_date->Visible;
            $this->ControlsVisible["tckt_status"] = $this->tckt_status->Visible;
            $this->ControlsVisible["tckt_escalate"] = $this->tckt_escalate->Visible;
            $this->ControlsVisible["tckt_r_date"] = $this->tckt_r_date->Visible;
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
            $this->ControlsVisible["tckt_adukomn"] = $this->tckt_adukomn->Visible;
            $this->ControlsVisible["tckt_category"] = $this->tckt_category->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["tckt_c_date"] = $this->tckt_c_date->Visible;
            $this->ControlsVisible["rsltn_eta"] = $this->rsltn_eta->Visible;
            $this->ControlsVisible["rsltn_etd"] = $this->rsltn_etd->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                        $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                        $this->rsltn_byuser->SetValue($items[$i]->rsltn_byuser);
                        $this->rsltn_byuser->Attributes->RestoreFromArray($items[$i]->_rsltn_byuserAttributes);
                        $this->rsltn_actiontaken->SetValue($items[$i]->rsltn_actiontaken);
                        $this->rsltn_actiontaken->Attributes->RestoreFromArray($items[$i]->_rsltn_actiontakenAttributes);
                        $this->rsltn_date->SetValue($items[$i]->rsltn_date);
                        $this->rsltn_date->Attributes->RestoreFromArray($items[$i]->_rsltn_dateAttributes);
                        $this->tckt_status->SetValue($items[$i]->tckt_status);
                        $this->tckt_status->Attributes->RestoreFromArray($items[$i]->_tckt_statusAttributes);
                        $this->tckt_escalate->SetValue($items[$i]->tckt_escalate);
                        $this->tckt_escalate->Attributes->RestoreFromArray($items[$i]->_tckt_escalateAttributes);
                        $this->tckt_r_date->SetValue($items[$i]->tckt_r_date);
                        $this->tckt_r_date->Attributes->RestoreFromArray($items[$i]->_tckt_r_dateAttributes);
                        $this->tckt_site->SetValue($items[$i]->tckt_site);
                        $this->tckt_site->Attributes->RestoreFromArray($items[$i]->_tckt_siteAttributes);
                        $this->tckt_severity->SetValue($items[$i]->tckt_severity);
                        $this->tckt_severity->Attributes->RestoreFromArray($items[$i]->_tckt_severityAttributes);
                        $this->tckt_adukomn->SetValue($items[$i]->tckt_adukomn);
                        $this->tckt_adukomn->Attributes->RestoreFromArray($items[$i]->_tckt_adukomnAttributes);
                        $this->tckt_category->SetValue($items[$i]->tckt_category);
                        $this->tckt_category->Attributes->RestoreFromArray($items[$i]->_tckt_categoryAttributes);
                        $this->tckt_description->SetValue($items[$i]->tckt_description);
                        $this->tckt_description->Attributes->RestoreFromArray($items[$i]->_tckt_descriptionAttributes);
                        $this->tckt_c_date->SetValue($items[$i]->tckt_c_date);
                        $this->tckt_c_date->Attributes->RestoreFromArray($items[$i]->_tckt_c_dateAttributes);
                        $this->rsltn_eta->SetValue($items[$i]->rsltn_eta);
                        $this->rsltn_eta->Attributes->RestoreFromArray($items[$i]->_rsltn_etaAttributes);
                        $this->rsltn_etd->SetValue($items[$i]->rsltn_etd);
                        $this->rsltn_etd->Attributes->RestoreFromArray($items[$i]->_rsltn_etdAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Report_Row_Number->Show();
                        $this->rsltn_byuser->Show();
                        $this->rsltn_actiontaken->Show();
                        $this->rsltn_date->Show();
                        $this->tckt_status->Show();
                        $this->tckt_escalate->Show();
                        $this->tckt_r_date->Show();
                        $this->tckt_site->Show();
                        $this->tckt_severity->Show();
                        $this->tckt_adukomn->Show();
                        $this->tckt_category->Show();
                        $this->tckt_description->Show();
                        $this->tckt_c_date->Show();
                        $this->rsltn_eta->Show();
                        $this->rsltn_etd->Show();
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
                            $this->Report_CurrentDateTime->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDateTime->Format));
                            $this->Report_CurrentDateTime->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateTimeAttributes);
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
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
                            $this->tckt_refnumber->SetValue($items[$i]->tckt_refnumber);
                            $this->tckt_refnumber->Attributes->RestoreFromArray($items[$i]->_tckt_refnumberAttributes);
                            $this->tckt_refnumber_Header->CCSEventResult = CCGetEvent($this->tckt_refnumber_Header->CCSEvents, "BeforeShow", $this->tckt_refnumber_Header);
                            if ($this->tckt_refnumber_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section tckt_refnumber_Header";
                                $this->Attributes->Show();
                                $this->tckt_refnumber->Show();
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

} //End RepTickets Class @2-FCB6E20C

class clsrptticketrnRepTicketsDataSource extends clsDBSMART {  //RepTicketsDataSource Class @2-315C567A

//DataSource Variables @2-CA0D4629
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $tckt_refnumber;
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $rsltn_date;
    var $tckt_status;
    var $tckt_escalate;
    var $tckt_r_date;
    var $tckt_site;
    var $tckt_severity;
    var $tckt_adukomn;
    var $tckt_category;
    var $tckt_description;
    var $tckt_c_date;
    var $rsltn_eta;
    var $rsltn_etd;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-68FB283A
    function clsrptticketrnRepTicketsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report RepTickets";
        $this->Initialize();
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsInteger, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->tckt_status = new clsField("tckt_status", ccsInteger, "");
        
        $this->tckt_escalate = new clsField("tckt_escalate", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsInteger, "");
        
        $this->tckt_adukomn = new clsField("tckt_adukomn", ccsText, "");
        
        $this->tckt_category = new clsField("tckt_category", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsMemo, "");
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_eta = new clsField("rsltn_eta", ccsText, "");
        
        $this->rsltn_etd = new clsField("rsltn_etd", ccsText, "");
        

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

//Prepare Method @2-9C290C9A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls", ccsText, "", "", $this->Parameters["urls"], "", false);
        $this->wp->AddParameter("2", "urlb", ccsText, "", "", $this->Parameters["urlb"], "", false);
        $this->wp->AddParameter("3", "urlsv", ccsInteger, "", "", $this->Parameters["urlsv"], "", false);
        $this->wp->AddParameter("4", "urlesc", ccsText, "", "", $this->Parameters["urlesc"], "", false);
        $this->wp->AddParameter("5", "urlcat", ccsText, "", "", $this->Parameters["urlcat"], "", false);
        $this->wp->AddParameter("6", "urlscat", ccsText, "", "", $this->Parameters["urlscat"], "", false);
        $this->wp->AddParameter("7", "urldtfr", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urldtfr"], "", false);
        $this->wp->AddParameter("8", "urldtto", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urldtto"], "", false);
        $this->wp->AddParameter("9", "urlad", ccsText, "", "", $this->Parameters["urlad"], "", false);
        $this->wp->AddParameter("10", "urlrn", ccsText, "", "", $this->Parameters["urlrn"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_ticket.tckt_state", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "smart_ticket.tckt_site", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "smart_ticket.tckt_severity", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "smart_ticket.tckt_escalate", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "smart_ticket.tckt_category", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "smart_ticket.tckt_subcategory", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opGreaterThanOrEqual, "smart_ticket.tckt_r_date", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsDate),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opLessThanOrEqual, "smart_ticket.tckt_r_date", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsDate),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "smart_ticket.tckt_adukomn", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsText),false);
        $this->wp->Criterion[10] = $this->wp->Operation(opEqual, "smart_ticket.tckt_refnumber", $this->wp->GetDBValue("10"), $this->ToSQL($this->wp->GetDBValue("10"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]), 
             $this->wp->Criterion[10]);
    }
//End Prepare Method

//Open Method @2-C7FD3CCA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tckt_refnumber, tckt_status, tckt_escalate, tckt_r_date, tckt_site, tckt_severity, tckt_adukomn, tckt_category, tckt_description,\n\n" .
        "tckt_c_date, rsltn_date, rsltn_byuser, rsltn_actiontaken, rsltn_eta, rsltn_etd \n\n" .
        "FROM smart_ticket INNER JOIN smart_resolutionnote ON\n\n" .
        "smart_ticket.id = smart_resolutionnote.ticket_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "smart_ticket.tckt_refnumber asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A21833FB
    function SetValues()
    {
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->rsltn_byuser->SetDBValue(trim($this->f("rsltn_byuser")));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->tckt_status->SetDBValue(trim($this->f("tckt_status")));
        $this->tckt_escalate->SetDBValue($this->f("tckt_escalate"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_severity->SetDBValue(trim($this->f("tckt_severity")));
        $this->tckt_adukomn->SetDBValue($this->f("tckt_adukomn"));
        $this->tckt_category->SetDBValue($this->f("tckt_category"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->rsltn_eta->SetDBValue($this->f("rsltn_eta"));
        $this->rsltn_etd->SetDBValue($this->f("rsltn_etd"));
    }
//End SetValues Method

} //End RepTicketsDataSource Class @2-FCB6E20C

class clsrptticketrn { //rptticketrn class @1-925514FF

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

//Class_Initialize Event @1-0D4CCD97
    function clsrptticketrn($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "rptticketrn.php";
        $this->Redirect = "";
        $this->TemplateFileName = "rptticketrn.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-DEBBFA58
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->RepTickets);
    }
//End Class_Terminate Event

//BindEvents Method @1-DBF614FC
    function BindEvents()
    {
        $this->RepTickets->Navigator->CCSEvents["BeforeShow"] = "rptticketrn_RepTickets_Navigator_BeforeShow";
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

//Initialize Method @1-18D3DA36
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
        $this->RepTickets = & new clsReportrptticketrnRepTickets($this->RelativePath, $this);
        $this->RepTickets->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-D3254B95
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
        $this->RepTickets->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End rptticketrn Class @1-FCB6E20C

//Include Event File @1-B0C653B4
include_once(RelativePath . "/rptticketrn_events.php");
//End Include Event File


?>
