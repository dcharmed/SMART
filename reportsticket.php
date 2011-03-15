<?php



//RTicket ReportGroup class @2-08C61CEB
class clsReportGroupreportsticketRTicket {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $hdrmonth, $_hdrmonthAttributes;
    var $Report_CurrentDateTime, $_Report_CurrentDateTimeAttributes;
    var $tckt_site, $_tckt_siteAttributes;
    var $tckt_r_date, $_tckt_r_dateAttributes;
    var $Age, $_AgeAttributes;
    var $tckt_c_date, $_tckt_c_dateAttributes;
    var $tckt_engineer, $_tckt_engineerAttributes;
    var $state, $_stateAttributes;
    var $tckt_refnumber, $_tckt_refnumberAttributes;
    var $tckt_cat, $_tckt_catAttributes;
    var $tckt_subcat, $_tckt_subcatAttributes;
    var $tckt_severity, $_tckt_severityAttributes;
    var $hidecat, $_hidecatAttributes;
    var $tckt_r_adukomid, $_tckt_r_adukomidAttributes;
    var $tckt_adukomn, $_tckt_adukomnAttributes;
    var $tckt_status, $_tckt_statusAttributes;
    var $tckt_method, $_tckt_methodAttributes;
    var $tckt_description, $_tckt_descriptionAttributes;
    var $rsltn_byuser, $_rsltn_byuserAttributes;
    var $rsltn_actiontaken, $_rsltn_actiontakenAttributes;
    var $rsltn_date, $_rsltn_dateAttributes;
    var $rsltn_eta, $_rsltn_etaAttributes;
    var $ActionPlan, $_ActionPlanAttributes;
    var $Remark, $_RemarkAttributes;
    var $rsltn_type, $_rsltn_typeAttributes;
    var $SpartOk, $_SpartOkAttributes;
    var $EqOk, $_EqOkAttributes;
    var $Attachment, $_AttachmentAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $tckt_refnumberTotalIndex;

    function clsReportGroupreportsticketRTicket(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->hdrmonth = $this->Parent->hdrmonth->Value;
        $this->tckt_site = $this->Parent->tckt_site->Value;
        $this->tckt_r_date = $this->Parent->tckt_r_date->Value;
        $this->Age = $this->Parent->Age->Value;
        $this->tckt_c_date = $this->Parent->tckt_c_date->Value;
        $this->tckt_engineer = $this->Parent->tckt_engineer->Value;
        $this->state = $this->Parent->state->Value;
        $this->tckt_refnumber = $this->Parent->tckt_refnumber->Value;
        $this->tckt_cat = $this->Parent->tckt_cat->Value;
        $this->tckt_subcat = $this->Parent->tckt_subcat->Value;
        $this->tckt_severity = $this->Parent->tckt_severity->Value;
        $this->hidecat = $this->Parent->hidecat->Value;
        $this->tckt_r_adukomid = $this->Parent->tckt_r_adukomid->Value;
        $this->tckt_adukomn = $this->Parent->tckt_adukomn->Value;
        $this->tckt_status = $this->Parent->tckt_status->Value;
        $this->tckt_method = $this->Parent->tckt_method->Value;
        $this->tckt_description = $this->Parent->tckt_description->Value;
        $this->rsltn_byuser = $this->Parent->rsltn_byuser->Value;
        $this->rsltn_actiontaken = $this->Parent->rsltn_actiontaken->Value;
        $this->rsltn_date = $this->Parent->rsltn_date->Value;
        $this->rsltn_eta = $this->Parent->rsltn_eta->Value;
        $this->ActionPlan = $this->Parent->ActionPlan->Value;
        $this->Remark = $this->Parent->Remark->Value;
        $this->rsltn_type = $this->Parent->rsltn_type->Value;
        $this->SpartOk = $this->Parent->SpartOk->Value;
        $this->EqOk = $this->Parent->EqOk->Value;
        $this->Attachment = $this->Parent->Attachment->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_hdrmonthAttributes = $this->Parent->hdrmonth->Attributes->GetAsArray();
        $this->_Report_CurrentDateTimeAttributes = $this->Parent->Report_CurrentDateTime->Attributes->GetAsArray();
        $this->_tckt_siteAttributes = $this->Parent->tckt_site->Attributes->GetAsArray();
        $this->_tckt_r_dateAttributes = $this->Parent->tckt_r_date->Attributes->GetAsArray();
        $this->_AgeAttributes = $this->Parent->Age->Attributes->GetAsArray();
        $this->_tckt_c_dateAttributes = $this->Parent->tckt_c_date->Attributes->GetAsArray();
        $this->_tckt_engineerAttributes = $this->Parent->tckt_engineer->Attributes->GetAsArray();
        $this->_stateAttributes = $this->Parent->state->Attributes->GetAsArray();
        $this->_tckt_refnumberAttributes = $this->Parent->tckt_refnumber->Attributes->GetAsArray();
        $this->_tckt_catAttributes = $this->Parent->tckt_cat->Attributes->GetAsArray();
        $this->_tckt_subcatAttributes = $this->Parent->tckt_subcat->Attributes->GetAsArray();
        $this->_tckt_severityAttributes = $this->Parent->tckt_severity->Attributes->GetAsArray();
        $this->_hidecatAttributes = $this->Parent->hidecat->Attributes->GetAsArray();
        $this->_tckt_r_adukomidAttributes = $this->Parent->tckt_r_adukomid->Attributes->GetAsArray();
        $this->_tckt_adukomnAttributes = $this->Parent->tckt_adukomn->Attributes->GetAsArray();
        $this->_tckt_statusAttributes = $this->Parent->tckt_status->Attributes->GetAsArray();
        $this->_tckt_methodAttributes = $this->Parent->tckt_method->Attributes->GetAsArray();
        $this->_tckt_descriptionAttributes = $this->Parent->tckt_description->Attributes->GetAsArray();
        $this->_rsltn_byuserAttributes = $this->Parent->rsltn_byuser->Attributes->GetAsArray();
        $this->_rsltn_actiontakenAttributes = $this->Parent->rsltn_actiontaken->Attributes->GetAsArray();
        $this->_rsltn_dateAttributes = $this->Parent->rsltn_date->Attributes->GetAsArray();
        $this->_rsltn_etaAttributes = $this->Parent->rsltn_eta->Attributes->GetAsArray();
        $this->_ActionPlanAttributes = $this->Parent->ActionPlan->Attributes->GetAsArray();
        $this->_RemarkAttributes = $this->Parent->Remark->Attributes->GetAsArray();
        $this->_rsltn_typeAttributes = $this->Parent->rsltn_type->Attributes->GetAsArray();
        $this->_SpartOkAttributes = $this->Parent->SpartOk->Attributes->GetAsArray();
        $this->_EqOkAttributes = $this->Parent->EqOk->Attributes->GetAsArray();
        $this->_AttachmentAttributes = $this->Parent->Attachment->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->hdrmonth = $Header->hdrmonth;
        $Header->_hdrmonthAttributes = $this->_hdrmonthAttributes;
        $this->Parent->hdrmonth->Value = $Header->hdrmonth;
        $this->Parent->hdrmonth->Attributes->RestoreFromArray($Header->_hdrmonthAttributes);
        $this->tckt_site = $Header->tckt_site;
        $Header->_tckt_siteAttributes = $this->_tckt_siteAttributes;
        $this->Parent->tckt_site->Value = $Header->tckt_site;
        $this->Parent->tckt_site->Attributes->RestoreFromArray($Header->_tckt_siteAttributes);
        $this->tckt_r_date = $Header->tckt_r_date;
        $Header->_tckt_r_dateAttributes = $this->_tckt_r_dateAttributes;
        $this->Parent->tckt_r_date->Value = $Header->tckt_r_date;
        $this->Parent->tckt_r_date->Attributes->RestoreFromArray($Header->_tckt_r_dateAttributes);
        $this->Age = $Header->Age;
        $Header->_AgeAttributes = $this->_AgeAttributes;
        $this->Parent->Age->Value = $Header->Age;
        $this->Parent->Age->Attributes->RestoreFromArray($Header->_AgeAttributes);
        $this->tckt_c_date = $Header->tckt_c_date;
        $Header->_tckt_c_dateAttributes = $this->_tckt_c_dateAttributes;
        $this->Parent->tckt_c_date->Value = $Header->tckt_c_date;
        $this->Parent->tckt_c_date->Attributes->RestoreFromArray($Header->_tckt_c_dateAttributes);
        $this->tckt_engineer = $Header->tckt_engineer;
        $Header->_tckt_engineerAttributes = $this->_tckt_engineerAttributes;
        $this->Parent->tckt_engineer->Value = $Header->tckt_engineer;
        $this->Parent->tckt_engineer->Attributes->RestoreFromArray($Header->_tckt_engineerAttributes);
        $this->state = $Header->state;
        $Header->_stateAttributes = $this->_stateAttributes;
        $this->Parent->state->Value = $Header->state;
        $this->Parent->state->Attributes->RestoreFromArray($Header->_stateAttributes);
        $this->tckt_refnumber = $Header->tckt_refnumber;
        $Header->_tckt_refnumberAttributes = $this->_tckt_refnumberAttributes;
        $this->Parent->tckt_refnumber->Value = $Header->tckt_refnumber;
        $this->Parent->tckt_refnumber->Attributes->RestoreFromArray($Header->_tckt_refnumberAttributes);
        $this->tckt_cat = $Header->tckt_cat;
        $Header->_tckt_catAttributes = $this->_tckt_catAttributes;
        $this->Parent->tckt_cat->Value = $Header->tckt_cat;
        $this->Parent->tckt_cat->Attributes->RestoreFromArray($Header->_tckt_catAttributes);
        $this->tckt_subcat = $Header->tckt_subcat;
        $Header->_tckt_subcatAttributes = $this->_tckt_subcatAttributes;
        $this->Parent->tckt_subcat->Value = $Header->tckt_subcat;
        $this->Parent->tckt_subcat->Attributes->RestoreFromArray($Header->_tckt_subcatAttributes);
        $this->tckt_severity = $Header->tckt_severity;
        $Header->_tckt_severityAttributes = $this->_tckt_severityAttributes;
        $this->Parent->tckt_severity->Value = $Header->tckt_severity;
        $this->Parent->tckt_severity->Attributes->RestoreFromArray($Header->_tckt_severityAttributes);
        $this->hidecat = $Header->hidecat;
        $Header->_hidecatAttributes = $this->_hidecatAttributes;
        $this->Parent->hidecat->Value = $Header->hidecat;
        $this->Parent->hidecat->Attributes->RestoreFromArray($Header->_hidecatAttributes);
        $this->tckt_r_adukomid = $Header->tckt_r_adukomid;
        $Header->_tckt_r_adukomidAttributes = $this->_tckt_r_adukomidAttributes;
        $this->Parent->tckt_r_adukomid->Value = $Header->tckt_r_adukomid;
        $this->Parent->tckt_r_adukomid->Attributes->RestoreFromArray($Header->_tckt_r_adukomidAttributes);
        $this->tckt_adukomn = $Header->tckt_adukomn;
        $Header->_tckt_adukomnAttributes = $this->_tckt_adukomnAttributes;
        $this->Parent->tckt_adukomn->Value = $Header->tckt_adukomn;
        $this->Parent->tckt_adukomn->Attributes->RestoreFromArray($Header->_tckt_adukomnAttributes);
        $this->tckt_status = $Header->tckt_status;
        $Header->_tckt_statusAttributes = $this->_tckt_statusAttributes;
        $this->Parent->tckt_status->Value = $Header->tckt_status;
        $this->Parent->tckt_status->Attributes->RestoreFromArray($Header->_tckt_statusAttributes);
        $this->tckt_method = $Header->tckt_method;
        $Header->_tckt_methodAttributes = $this->_tckt_methodAttributes;
        $this->Parent->tckt_method->Value = $Header->tckt_method;
        $this->Parent->tckt_method->Attributes->RestoreFromArray($Header->_tckt_methodAttributes);
        $this->tckt_description = $Header->tckt_description;
        $Header->_tckt_descriptionAttributes = $this->_tckt_descriptionAttributes;
        $this->Parent->tckt_description->Value = $Header->tckt_description;
        $this->Parent->tckt_description->Attributes->RestoreFromArray($Header->_tckt_descriptionAttributes);
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
        $this->rsltn_eta = $Header->rsltn_eta;
        $Header->_rsltn_etaAttributes = $this->_rsltn_etaAttributes;
        $this->Parent->rsltn_eta->Value = $Header->rsltn_eta;
        $this->Parent->rsltn_eta->Attributes->RestoreFromArray($Header->_rsltn_etaAttributes);
        $this->ActionPlan = $Header->ActionPlan;
        $Header->_ActionPlanAttributes = $this->_ActionPlanAttributes;
        $this->Parent->ActionPlan->Value = $Header->ActionPlan;
        $this->Parent->ActionPlan->Attributes->RestoreFromArray($Header->_ActionPlanAttributes);
        $this->Remark = $Header->Remark;
        $Header->_RemarkAttributes = $this->_RemarkAttributes;
        $this->Parent->Remark->Value = $Header->Remark;
        $this->Parent->Remark->Attributes->RestoreFromArray($Header->_RemarkAttributes);
        $this->rsltn_type = $Header->rsltn_type;
        $Header->_rsltn_typeAttributes = $this->_rsltn_typeAttributes;
        $this->Parent->rsltn_type->Value = $Header->rsltn_type;
        $this->Parent->rsltn_type->Attributes->RestoreFromArray($Header->_rsltn_typeAttributes);
        $this->SpartOk = $Header->SpartOk;
        $Header->_SpartOkAttributes = $this->_SpartOkAttributes;
        $this->Parent->SpartOk->Value = $Header->SpartOk;
        $this->Parent->SpartOk->Attributes->RestoreFromArray($Header->_SpartOkAttributes);
        $this->EqOk = $Header->EqOk;
        $Header->_EqOkAttributes = $this->_EqOkAttributes;
        $this->Parent->EqOk->Value = $Header->EqOk;
        $this->Parent->EqOk->Attributes->RestoreFromArray($Header->_EqOkAttributes);
        $this->Attachment = $Header->Attachment;
        $Header->_AttachmentAttributes = $this->_AttachmentAttributes;
        $this->Parent->Attachment->Value = $Header->Attachment;
        $this->Parent->Attachment->Attributes->RestoreFromArray($Header->_AttachmentAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End RTicket ReportGroup class

//RTicket GroupsCollection class @2-9B93A04E
class clsGroupsCollectionreportsticketRTicket {
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

    function clsGroupsCollectionreportsticketRTicket(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mtckt_refnumberCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupreportsticketRTicket($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->tckt_refnumberTotalIndex = $this->mtckt_refnumberCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->hdrmonth->Value = $this->Parent->hdrmonth->initialValue;
        $this->Parent->tckt_site->Value = $this->Parent->tckt_site->initialValue;
        $this->Parent->tckt_r_date->Value = $this->Parent->tckt_r_date->initialValue;
        $this->Parent->Age->Value = $this->Parent->Age->initialValue;
        $this->Parent->tckt_c_date->Value = $this->Parent->tckt_c_date->initialValue;
        $this->Parent->tckt_engineer->Value = $this->Parent->tckt_engineer->initialValue;
        $this->Parent->state->Value = $this->Parent->state->initialValue;
        $this->Parent->tckt_refnumber->Value = $this->Parent->tckt_refnumber->initialValue;
        $this->Parent->tckt_cat->Value = $this->Parent->tckt_cat->initialValue;
        $this->Parent->tckt_subcat->Value = $this->Parent->tckt_subcat->initialValue;
        $this->Parent->tckt_severity->Value = $this->Parent->tckt_severity->initialValue;
        $this->Parent->hidecat->Value = $this->Parent->hidecat->initialValue;
        $this->Parent->tckt_r_adukomid->Value = $this->Parent->tckt_r_adukomid->initialValue;
        $this->Parent->tckt_adukomn->Value = $this->Parent->tckt_adukomn->initialValue;
        $this->Parent->tckt_status->Value = $this->Parent->tckt_status->initialValue;
        $this->Parent->tckt_method->Value = $this->Parent->tckt_method->initialValue;
        $this->Parent->tckt_description->Value = $this->Parent->tckt_description->initialValue;
        $this->Parent->rsltn_byuser->Value = $this->Parent->rsltn_byuser->initialValue;
        $this->Parent->rsltn_actiontaken->Value = $this->Parent->rsltn_actiontaken->initialValue;
        $this->Parent->rsltn_date->Value = $this->Parent->rsltn_date->initialValue;
        $this->Parent->rsltn_eta->Value = $this->Parent->rsltn_eta->initialValue;
        $this->Parent->ActionPlan->Value = $this->Parent->ActionPlan->initialValue;
        $this->Parent->Remark->Value = $this->Parent->Remark->initialValue;
        $this->Parent->rsltn_type->Value = $this->Parent->rsltn_type->initialValue;
        $this->Parent->SpartOk->Value = $this->Parent->SpartOk->initialValue;
        $this->Parent->EqOk->Value = $this->Parent->EqOk->initialValue;
        $this->Parent->Attachment->Value = $this->Parent->Attachment->initialValue;
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
//End RTicket GroupsCollection class

class clsReportreportsticketRTicket { //RTicket Class @2-4354EDAE

//RTicket Variables @2-385AF6A4

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
//End RTicket Variables

//Class_Initialize Event @2-49861BCE
    function clsReportreportsticketRTicket($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "RTicket";
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
        $this->DataSource = new clsreportsticketRTicketDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 100;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
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

        $this->hdrmonth = & new clsControl(ccsReportLabel, "hdrmonth", "hdrmonth", ccsText, "", "", $this);
        $this->hdrmonth->HTML = true;
        $this->hdrmonth->IsEmptySource = true;
        $this->Report_CurrentDateTime = & new clsControl(ccsReportLabel, "Report_CurrentDateTime", "Report_CurrentDateTime", ccsText, array('ShortDate', ' ', 'ShortTime'), "", $this);
        $this->tckt_site = & new clsControl(ccsReportLabel, "tckt_site", "tckt_site", ccsText, "", "", $this);
        $this->tckt_r_date = & new clsControl(ccsReportLabel, "tckt_r_date", "tckt_r_date", ccsDate, array("GeneralDate"), "", $this);
        $this->Age = & new clsControl(ccsReportLabel, "Age", "Age", ccsText, "", "", $this);
        $this->Age->HTML = true;
        $this->Age->IsEmptySource = true;
        $this->tckt_c_date = & new clsControl(ccsHidden, "tckt_c_date", "tckt_c_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("tckt_c_date", ccsGet, NULL), $this);
        $this->tckt_engineer = & new clsControl(ccsReportLabel, "tckt_engineer", "tckt_engineer", ccsText, "", "", $this);
        $this->state = & new clsControl(ccsHidden, "state", "state", ccsText, "", CCGetRequestParam("state", ccsGet, NULL), $this);
        $this->tckt_refnumber = & new clsControl(ccsReportLabel, "tckt_refnumber", "tckt_refnumber", ccsText, "", "", $this);
        $this->tckt_cat = & new clsControl(ccsReportLabel, "tckt_cat", "tckt_cat", ccsText, "", "", $this);
        $this->tckt_subcat = & new clsControl(ccsReportLabel, "tckt_subcat", "tckt_subcat", ccsText, "", "", $this);
        $this->tckt_subcat->HTML = true;
        $this->tckt_severity = & new clsControl(ccsReportLabel, "tckt_severity", "tckt_severity", ccsText, "", "", $this);
        $this->hidecat = & new clsControl(ccsHidden, "hidecat", "hidecat", ccsText, "", CCGetRequestParam("hidecat", ccsGet, NULL), $this);
        $this->tckt_r_adukomid = & new clsControl(ccsReportLabel, "tckt_r_adukomid", "tckt_r_adukomid", ccsText, "", "", $this);
        $this->tckt_adukomn = & new clsControl(ccsReportLabel, "tckt_adukomn", "tckt_adukomn", ccsText, "", "", $this);
        $this->tckt_adukomn->HTML = true;
        $this->tckt_status = & new clsControl(ccsReportLabel, "tckt_status", "tckt_status", ccsText, "", "", $this);
        $this->tckt_method = & new clsControl(ccsReportLabel, "tckt_method", "tckt_method", ccsText, "", "", $this);
        $this->tckt_method->HTML = true;
        $this->tckt_description = & new clsControl(ccsReportLabel, "tckt_description", "tckt_description", ccsText, "", "", $this);
        $this->tckt_description->HTML = true;
        $this->rsltn_byuser = & new clsControl(ccsReportLabel, "rsltn_byuser", "rsltn_byuser", ccsText, "", "", $this);
        $this->rsltn_actiontaken = & new clsControl(ccsReportLabel, "rsltn_actiontaken", "rsltn_actiontaken", ccsMemo, "", "", $this);
        $this->rsltn_date = & new clsControl(ccsReportLabel, "rsltn_date", "rsltn_date", ccsDate, array("GeneralDate"), "", $this);
        $this->rsltn_eta = & new clsControl(ccsReportLabel, "rsltn_eta", "rsltn_eta", ccsDate, array("GeneralDate"), "", $this);
        $this->ActionPlan = & new clsControl(ccsReportLabel, "ActionPlan", "ActionPlan", ccsText, "", "", $this);
        $this->Remark = & new clsControl(ccsReportLabel, "Remark", "Remark", ccsText, "", "", $this);
        $this->rsltn_type = & new clsControl(ccsHidden, "rsltn_type", "rsltn_type", ccsText, "", CCGetRequestParam("rsltn_type", ccsGet, NULL), $this);
        $this->SpartOk = & new clsControl(ccsReportLabel, "SpartOk", "SpartOk", ccsText, "", "", $this);
        $this->SpartOk->IsEmptySource = true;
        $this->EqOk = & new clsControl(ccsReportLabel, "EqOk", "EqOk", ccsText, "", "", $this);
        $this->EqOk->IsEmptySource = true;
        $this->Attachment = & new clsControl(ccsHidden, "Attachment", "Attachment", ccsText, "", CCGetRequestParam("Attachment", ccsGet, NULL), $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->PageBreak = & new clsPanel("PageBreak", $this);
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

//CheckErrors Method @2-1E2AC53C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->hdrmonth->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDateTime->Errors->Count());
        $errors = ($errors || $this->tckt_site->Errors->Count());
        $errors = ($errors || $this->tckt_r_date->Errors->Count());
        $errors = ($errors || $this->Age->Errors->Count());
        $errors = ($errors || $this->tckt_c_date->Errors->Count());
        $errors = ($errors || $this->tckt_engineer->Errors->Count());
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->tckt_refnumber->Errors->Count());
        $errors = ($errors || $this->tckt_cat->Errors->Count());
        $errors = ($errors || $this->tckt_subcat->Errors->Count());
        $errors = ($errors || $this->tckt_severity->Errors->Count());
        $errors = ($errors || $this->hidecat->Errors->Count());
        $errors = ($errors || $this->tckt_r_adukomid->Errors->Count());
        $errors = ($errors || $this->tckt_adukomn->Errors->Count());
        $errors = ($errors || $this->tckt_status->Errors->Count());
        $errors = ($errors || $this->tckt_method->Errors->Count());
        $errors = ($errors || $this->tckt_description->Errors->Count());
        $errors = ($errors || $this->rsltn_byuser->Errors->Count());
        $errors = ($errors || $this->rsltn_actiontaken->Errors->Count());
        $errors = ($errors || $this->rsltn_date->Errors->Count());
        $errors = ($errors || $this->rsltn_eta->Errors->Count());
        $errors = ($errors || $this->ActionPlan->Errors->Count());
        $errors = ($errors || $this->Remark->Errors->Count());
        $errors = ($errors || $this->rsltn_type->Errors->Count());
        $errors = ($errors || $this->SpartOk->Errors->Count());
        $errors = ($errors || $this->EqOk->Errors->Count());
        $errors = ($errors || $this->Attachment->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-2CFDCFA0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->hdrmonth->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDateTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_site->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_c_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_engineer->Errors->ToString());
        $errors = ComposeStrings($errors, $this->state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_refnumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_cat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_subcat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_severity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->hidecat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_r_adukomid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_adukomn->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_method->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tckt_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_byuser->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_actiontaken->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_eta->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ActionPlan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rsltn_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SpartOk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EqOk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Attachment->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-4092B9C8
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls"] = CCGetFromGet("s", NULL);
        $this->DataSource->Parameters["urlsv"] = CCGetFromGet("sv", NULL);
        $this->DataSource->Parameters["urlesc"] = CCGetFromGet("esc", NULL);
        $this->DataSource->Parameters["urlcat"] = CCGetFromGet("cat", NULL);
        $this->DataSource->Parameters["urlscat"] = CCGetFromGet("scat", NULL);
        $this->DataSource->Parameters["urlad"] = CCGetFromGet("ad", NULL);
        $this->DataSource->Parameters["urlrn"] = CCGetFromGet("rn", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $tckt_refnumberKey = "";
        $Groups = new clsGroupsCollectionreportsticketRTicket($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->tckt_site->SetValue($this->DataSource->tckt_site->GetValue());
            $this->tckt_r_date->SetValue($this->DataSource->tckt_r_date->GetValue());
            $this->tckt_c_date->SetValue($this->DataSource->tckt_c_date->GetValue());
            $this->tckt_engineer->SetValue($this->DataSource->tckt_engineer->GetValue());
            $this->state->SetValue($this->DataSource->state->GetValue());
            $this->tckt_refnumber->SetValue($this->DataSource->tckt_refnumber->GetValue());
            $this->tckt_cat->SetValue($this->DataSource->tckt_cat->GetValue());
            $this->tckt_subcat->SetValue($this->DataSource->tckt_subcat->GetValue());
            $this->tckt_severity->SetValue($this->DataSource->tckt_severity->GetValue());
            $this->hidecat->SetValue($this->DataSource->hidecat->GetValue());
            $this->tckt_r_adukomid->SetValue($this->DataSource->tckt_r_adukomid->GetValue());
            $this->tckt_adukomn->SetValue($this->DataSource->tckt_adukomn->GetValue());
            $this->tckt_status->SetValue($this->DataSource->tckt_status->GetValue());
            $this->tckt_method->SetValue($this->DataSource->tckt_method->GetValue());
            $this->tckt_description->SetValue($this->DataSource->tckt_description->GetValue());
            $this->rsltn_byuser->SetValue($this->DataSource->rsltn_byuser->GetValue());
            $this->rsltn_actiontaken->SetValue($this->DataSource->rsltn_actiontaken->GetValue());
            $this->rsltn_date->SetValue($this->DataSource->rsltn_date->GetValue());
            $this->rsltn_eta->SetValue($this->DataSource->rsltn_eta->GetValue());
            $this->ActionPlan->SetValue($this->DataSource->ActionPlan->GetValue());
            $this->Remark->SetValue($this->DataSource->Remark->GetValue());
            $this->rsltn_type->SetValue($this->DataSource->rsltn_type->GetValue());
            $this->hdrmonth->SetValue("");
            $this->Age->SetValue("");
            $this->SpartOk->SetValue("");
            $this->EqOk->SetValue("");
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
            $this->ControlsVisible["tckt_site"] = $this->tckt_site->Visible;
            $this->ControlsVisible["tckt_r_date"] = $this->tckt_r_date->Visible;
            $this->ControlsVisible["Age"] = $this->Age->Visible;
            $this->ControlsVisible["tckt_c_date"] = $this->tckt_c_date->Visible;
            $this->ControlsVisible["tckt_engineer"] = $this->tckt_engineer->Visible;
            $this->ControlsVisible["state"] = $this->state->Visible;
            $this->ControlsVisible["tckt_refnumber"] = $this->tckt_refnumber->Visible;
            $this->ControlsVisible["tckt_cat"] = $this->tckt_cat->Visible;
            $this->ControlsVisible["tckt_subcat"] = $this->tckt_subcat->Visible;
            $this->ControlsVisible["tckt_severity"] = $this->tckt_severity->Visible;
            $this->ControlsVisible["hidecat"] = $this->hidecat->Visible;
            $this->ControlsVisible["tckt_r_adukomid"] = $this->tckt_r_adukomid->Visible;
            $this->ControlsVisible["tckt_adukomn"] = $this->tckt_adukomn->Visible;
            $this->ControlsVisible["tckt_status"] = $this->tckt_status->Visible;
            $this->ControlsVisible["tckt_method"] = $this->tckt_method->Visible;
            $this->ControlsVisible["tckt_description"] = $this->tckt_description->Visible;
            $this->ControlsVisible["rsltn_byuser"] = $this->rsltn_byuser->Visible;
            $this->ControlsVisible["rsltn_actiontaken"] = $this->rsltn_actiontaken->Visible;
            $this->ControlsVisible["rsltn_date"] = $this->rsltn_date->Visible;
            $this->ControlsVisible["rsltn_eta"] = $this->rsltn_eta->Visible;
            $this->ControlsVisible["ActionPlan"] = $this->ActionPlan->Visible;
            $this->ControlsVisible["Remark"] = $this->Remark->Visible;
            $this->ControlsVisible["rsltn_type"] = $this->rsltn_type->Visible;
            $this->ControlsVisible["SpartOk"] = $this->SpartOk->Visible;
            $this->ControlsVisible["EqOk"] = $this->EqOk->Visible;
            $this->ControlsVisible["Attachment"] = $this->Attachment->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->rsltn_byuser->SetValue($items[$i]->rsltn_byuser);
                        $this->rsltn_byuser->Attributes->RestoreFromArray($items[$i]->_rsltn_byuserAttributes);
                        $this->rsltn_actiontaken->SetValue($items[$i]->rsltn_actiontaken);
                        $this->rsltn_actiontaken->Attributes->RestoreFromArray($items[$i]->_rsltn_actiontakenAttributes);
                        $this->rsltn_date->SetValue($items[$i]->rsltn_date);
                        $this->rsltn_date->Attributes->RestoreFromArray($items[$i]->_rsltn_dateAttributes);
                        $this->rsltn_eta->SetValue($items[$i]->rsltn_eta);
                        $this->rsltn_eta->Attributes->RestoreFromArray($items[$i]->_rsltn_etaAttributes);
                        $this->ActionPlan->SetValue($items[$i]->ActionPlan);
                        $this->ActionPlan->Attributes->RestoreFromArray($items[$i]->_ActionPlanAttributes);
                        $this->Remark->SetValue($items[$i]->Remark);
                        $this->Remark->Attributes->RestoreFromArray($items[$i]->_RemarkAttributes);
                        $this->rsltn_type->SetValue($items[$i]->rsltn_type);
                        $this->rsltn_type->Attributes->RestoreFromArray($items[$i]->_rsltn_typeAttributes);
                        $this->SpartOk->SetValue($items[$i]->SpartOk);
                        $this->SpartOk->Attributes->RestoreFromArray($items[$i]->_SpartOkAttributes);
                        $this->EqOk->SetValue($items[$i]->EqOk);
                        $this->EqOk->Attributes->RestoreFromArray($items[$i]->_EqOkAttributes);
                        $this->Attachment->SetValue($items[$i]->Attachment);
                        $this->Attachment->Attributes->RestoreFromArray($items[$i]->_AttachmentAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->rsltn_byuser->Show();
                        $this->rsltn_actiontaken->Show();
                        $this->rsltn_date->Show();
                        $this->rsltn_eta->Show();
                        $this->ActionPlan->Show();
                        $this->Remark->Show();
                        $this->rsltn_type->Show();
                        $this->SpartOk->Show();
                        $this->EqOk->Show();
                        $this->Attachment->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->hdrmonth->SetValue($items[$i]->hdrmonth);
                            $this->hdrmonth->Attributes->RestoreFromArray($items[$i]->_hdrmonthAttributes);
                            $this->Report_CurrentDateTime->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDateTime->Format));
                            $this->Report_CurrentDateTime->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateTimeAttributes);
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $this->hdrmonth->Show();
                                $this->Report_CurrentDateTime->Show();
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
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->PageBreak->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "tckt_refnumber":
                        if ($items[$i]->Mode == 1) {
                            $this->tckt_site->SetValue($items[$i]->tckt_site);
                            $this->tckt_site->Attributes->RestoreFromArray($items[$i]->_tckt_siteAttributes);
                            $this->tckt_r_date->SetValue($items[$i]->tckt_r_date);
                            $this->tckt_r_date->Attributes->RestoreFromArray($items[$i]->_tckt_r_dateAttributes);
                            $this->Age->SetValue($items[$i]->Age);
                            $this->Age->Attributes->RestoreFromArray($items[$i]->_AgeAttributes);
                            $this->tckt_c_date->SetValue($items[$i]->tckt_c_date);
                            $this->tckt_c_date->Attributes->RestoreFromArray($items[$i]->_tckt_c_dateAttributes);
                            $this->tckt_engineer->SetValue($items[$i]->tckt_engineer);
                            $this->tckt_engineer->Attributes->RestoreFromArray($items[$i]->_tckt_engineerAttributes);
                            $this->state->SetValue($items[$i]->state);
                            $this->state->Attributes->RestoreFromArray($items[$i]->_stateAttributes);
                            $this->tckt_refnumber->SetValue($items[$i]->tckt_refnumber);
                            $this->tckt_refnumber->Attributes->RestoreFromArray($items[$i]->_tckt_refnumberAttributes);
                            $this->tckt_cat->SetValue($items[$i]->tckt_cat);
                            $this->tckt_cat->Attributes->RestoreFromArray($items[$i]->_tckt_catAttributes);
                            $this->tckt_subcat->SetValue($items[$i]->tckt_subcat);
                            $this->tckt_subcat->Attributes->RestoreFromArray($items[$i]->_tckt_subcatAttributes);
                            $this->tckt_severity->SetValue($items[$i]->tckt_severity);
                            $this->tckt_severity->Attributes->RestoreFromArray($items[$i]->_tckt_severityAttributes);
                            $this->hidecat->SetValue($items[$i]->hidecat);
                            $this->hidecat->Attributes->RestoreFromArray($items[$i]->_hidecatAttributes);
                            $this->tckt_r_adukomid->SetValue($items[$i]->tckt_r_adukomid);
                            $this->tckt_r_adukomid->Attributes->RestoreFromArray($items[$i]->_tckt_r_adukomidAttributes);
                            $this->tckt_adukomn->SetValue($items[$i]->tckt_adukomn);
                            $this->tckt_adukomn->Attributes->RestoreFromArray($items[$i]->_tckt_adukomnAttributes);
                            $this->tckt_status->SetValue($items[$i]->tckt_status);
                            $this->tckt_status->Attributes->RestoreFromArray($items[$i]->_tckt_statusAttributes);
                            $this->tckt_method->SetValue($items[$i]->tckt_method);
                            $this->tckt_method->Attributes->RestoreFromArray($items[$i]->_tckt_methodAttributes);
                            $this->tckt_description->SetValue($items[$i]->tckt_description);
                            $this->tckt_description->Attributes->RestoreFromArray($items[$i]->_tckt_descriptionAttributes);
                            $this->tckt_refnumber_Header->CCSEventResult = CCGetEvent($this->tckt_refnumber_Header->CCSEvents, "BeforeShow", $this->tckt_refnumber_Header);
                            if ($this->tckt_refnumber_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section tckt_refnumber_Header";
                                $this->Attributes->Show();
                                $this->tckt_site->Show();
                                $this->tckt_r_date->Show();
                                $this->Age->Show();
                                $this->tckt_c_date->Show();
                                $this->tckt_engineer->Show();
                                $this->state->Show();
                                $this->tckt_refnumber->Show();
                                $this->tckt_cat->Show();
                                $this->tckt_subcat->Show();
                                $this->tckt_severity->Show();
                                $this->hidecat->Show();
                                $this->tckt_r_adukomid->Show();
                                $this->tckt_adukomn->Show();
                                $this->tckt_status->Show();
                                $this->tckt_method->Show();
                                $this->tckt_description->Show();
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

} //End RTicket Class @2-FCB6E20C

class clsreportsticketRTicketDataSource extends clsDBSMART {  //RTicketDataSource Class @2-A65049A8

//DataSource Variables @2-5C344A10
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $tckt_site;
    var $tckt_r_date;
    var $tckt_c_date;
    var $tckt_engineer;
    var $state;
    var $tckt_refnumber;
    var $tckt_cat;
    var $tckt_subcat;
    var $tckt_severity;
    var $hidecat;
    var $tckt_r_adukomid;
    var $tckt_adukomn;
    var $tckt_status;
    var $tckt_method;
    var $tckt_description;
    var $rsltn_byuser;
    var $rsltn_actiontaken;
    var $rsltn_date;
    var $rsltn_eta;
    var $ActionPlan;
    var $Remark;
    var $rsltn_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F896DF46
    function clsreportsticketRTicketDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report RTicket";
        $this->Initialize();
        $this->tckt_site = new clsField("tckt_site", ccsText, "");
        
        $this->tckt_r_date = new clsField("tckt_r_date", ccsDate, $this->DateFormat);
        
        $this->tckt_c_date = new clsField("tckt_c_date", ccsDate, $this->DateFormat);
        
        $this->tckt_engineer = new clsField("tckt_engineer", ccsText, "");
        
        $this->state = new clsField("state", ccsText, "");
        
        $this->tckt_refnumber = new clsField("tckt_refnumber", ccsText, "");
        
        $this->tckt_cat = new clsField("tckt_cat", ccsText, "");
        
        $this->tckt_subcat = new clsField("tckt_subcat", ccsText, "");
        
        $this->tckt_severity = new clsField("tckt_severity", ccsText, "");
        
        $this->hidecat = new clsField("hidecat", ccsText, "");
        
        $this->tckt_r_adukomid = new clsField("tckt_r_adukomid", ccsText, "");
        
        $this->tckt_adukomn = new clsField("tckt_adukomn", ccsText, "");
        
        $this->tckt_status = new clsField("tckt_status", ccsText, "");
        
        $this->tckt_method = new clsField("tckt_method", ccsText, "");
        
        $this->tckt_description = new clsField("tckt_description", ccsText, "");
        
        $this->rsltn_byuser = new clsField("rsltn_byuser", ccsText, "");
        
        $this->rsltn_actiontaken = new clsField("rsltn_actiontaken", ccsMemo, "");
        
        $this->rsltn_date = new clsField("rsltn_date", ccsDate, $this->DateFormat);
        
        $this->rsltn_eta = new clsField("rsltn_eta", ccsDate, $this->DateFormat);
        
        $this->ActionPlan = new clsField("ActionPlan", ccsText, "");
        
        $this->Remark = new clsField("Remark", ccsText, "");
        
        $this->rsltn_type = new clsField("rsltn_type", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-81B3AFBC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tckt_r_date";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-8FC76BC8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls", ccsText, "", "", $this->Parameters["urls"], "", false);
        $this->wp->AddParameter("2", "urlsv", ccsInteger, "", "", $this->Parameters["urlsv"], "", false);
        $this->wp->AddParameter("3", "urlesc", ccsText, "", "", $this->Parameters["urlesc"], "", false);
        $this->wp->AddParameter("4", "urlcat", ccsText, "", "", $this->Parameters["urlcat"], "", false);
        $this->wp->AddParameter("5", "urlscat", ccsText, "", "", $this->Parameters["urlscat"], "", false);
        $this->wp->AddParameter("6", "urlad", ccsText, "", "", $this->Parameters["urlad"], "", false);
        $this->wp->AddParameter("7", "urlrn", ccsText, "", "", $this->Parameters["urlrn"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "smart_ticket.tckt_state", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "smart_ticket.tckt_severity", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "smart_ticket.tckt_escalate", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "smart_ticket.tckt_category", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "smart_ticket.tckt_subcategory", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "smart_ticket.tckt_adukomn", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "smart_ticket.tckt_refnumber", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->Where = $this->wp->opAND(
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
             $this->wp->Criterion[7]);
    }
//End Prepare Method

//Open Method @2-D5169B1B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tckt_refnumber, tckt_status, tckt_engineer, tckt_r_date, tckt_site, tckt_severity, tckt_adukomn, tckt_equipment, tckt_c_date,\n\n" .
        "tckt_r_adukomid, rsltn_date, rsltn_byuser, rsltn_eta, rsltn_etd, rsltn_actiontaken, tckt_description, rsltn_planning, rsltn_remark,\n\n" .
        "tckt_state, rsltn_type, tckt_category, tckt_subcategory, tckt_c_method \n\n" .
        "FROM smart_ticket LEFT JOIN smart_resolutionnote ON\n\n" .
        "smart_ticket.id = smart_resolutionnote.ticket_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "smart_ticket.tckt_refnumber asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-66B2C30F
    function SetValues()
    {
        $this->tckt_site->SetDBValue($this->f("tckt_site"));
        $this->tckt_r_date->SetDBValue(trim($this->f("tckt_r_date")));
        $this->tckt_c_date->SetDBValue(trim($this->f("tckt_c_date")));
        $this->tckt_engineer->SetDBValue($this->f("tckt_engineer"));
        $this->state->SetDBValue($this->f("tckt_state"));
        $this->tckt_refnumber->SetDBValue($this->f("tckt_refnumber"));
        $this->tckt_cat->SetDBValue($this->f("tckt_category"));
        $this->tckt_subcat->SetDBValue($this->f("tckt_subcategory"));
        $this->tckt_severity->SetDBValue($this->f("tckt_severity"));
        $this->hidecat->SetDBValue($this->f("tckt_category"));
        $this->tckt_r_adukomid->SetDBValue($this->f("tckt_r_adukomid"));
        $this->tckt_adukomn->SetDBValue($this->f("tckt_adukomn"));
        $this->tckt_status->SetDBValue($this->f("tckt_status"));
        $this->tckt_method->SetDBValue($this->f("tckt_c_method"));
        $this->tckt_description->SetDBValue($this->f("tckt_description"));
        $this->rsltn_byuser->SetDBValue($this->f("rsltn_byuser"));
        $this->rsltn_actiontaken->SetDBValue($this->f("rsltn_actiontaken"));
        $this->rsltn_date->SetDBValue(trim($this->f("rsltn_date")));
        $this->rsltn_eta->SetDBValue(trim($this->f("rsltn_eta")));
        $this->ActionPlan->SetDBValue($this->f("rsltn_planning"));
        $this->Remark->SetDBValue($this->f("rsltn_remark"));
        $this->rsltn_type->SetDBValue($this->f("rsltn_type"));
    }
//End SetValues Method

} //End RTicketDataSource Class @2-FCB6E20C

class clsreportsticket { //reportsticket class @1-D9ECE9A6

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

//Class_Initialize Event @1-A1C101BB
    function clsreportsticket($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "reportsticket.php";
        $this->Redirect = "";
        $this->TemplateFileName = "reportsticket.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-BEB85E08
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->RTicket);
    }
//End Class_Terminate Event

//BindEvents Method @1-55DDD187
    function BindEvents()
    {
        $this->RTicket->hdrmonth->CCSEvents["BeforeShow"] = "reportsticket_RTicket_hdrmonth_BeforeShow";
        $this->RTicket->tckt_site->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_site_BeforeShow";
        $this->RTicket->Age->CCSEvents["BeforeShow"] = "reportsticket_RTicket_Age_BeforeShow";
        $this->RTicket->tckt_cat->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_cat_BeforeShow";
        $this->RTicket->tckt_subcat->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_subcat_BeforeShow";
        $this->RTicket->tckt_severity->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_severity_BeforeShow";
        $this->RTicket->tckt_status->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_status_BeforeShow";
        $this->RTicket->tckt_method->CCSEvents["BeforeShow"] = "reportsticket_RTicket_tckt_method_BeforeShow";
        $this->RTicket->rsltn_byuser->CCSEvents["BeforeShow"] = "reportsticket_RTicket_rsltn_byuser_BeforeShow";
        $this->RTicket->rsltn_date->CCSEvents["BeforeShow"] = "reportsticket_RTicket_rsltn_date_BeforeShow";
        $this->RTicket->rsltn_eta->CCSEvents["BeforeShow"] = "reportsticket_RTicket_rsltn_eta_BeforeShow";
        $this->RTicket->Navigator->CCSEvents["BeforeShow"] = "reportsticket_RTicket_Navigator_BeforeShow";
        $this->RTicket->ds->CCSEvents["BeforeBuildSelect"] = "reportsticket_RTicket_ds_BeforeBuildSelect";
        $this->RTicket->CCSEvents["BeforeShow"] = "reportsticket_RTicket_BeforeShow";
        $this->RTicket->ds->CCSEvents["BeforeExecuteSelect"] = "reportsticket_RTicket_ds_BeforeExecuteSelect";
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

//Initialize Method @1-C40BD45F
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
        $this->RTicket = & new clsReportreportsticketRTicket($this->RelativePath, $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = $this->RelativePath . "printrpttickets.php";
        $this->RTicket->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s", CCGetFromGet("s", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "b", CCGetFromGet("b", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "esc", CCGetFromGet("esc", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "cat", CCGetFromGet("cat", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "scat", CCGetFromGet("scat", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "dtfr", CCGetFromGet("dtfr", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "dtto", CCGetFromGet("dtto", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "ad", CCGetFromGet("ad", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "rn", CCGetFromGet("rn", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "set", CCGetFromGet("set", NULL));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "print", 1);
    }
//End Initialize Method

//Show Method @1-1BE8A11C
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
        $this->RTicket->Show();
        $this->ImageLink1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End reportsticket Class @1-FCB6E20C

//Include Event File @1-3B65785C
include_once(RelativePath . "/reportsticket_events.php");
//End Include Event File


?>
