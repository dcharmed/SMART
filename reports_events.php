<?php
//BindEvents Method @1-A4FBCE5D
function BindEvents()
{
    global $OptionReport;
    global $CriteriaRpt;
    global $CriteriaStat2;
    global $CCSEvents;
    $OptionReport->type->CCSEvents["BeforeShow"] = "OptionReport_type_BeforeShow";
    $CriteriaRpt->Button_DoSearch->CCSEvents["OnClick"] = "CriteriaRpt_Button_DoSearch_OnClick";
    $CriteriaRpt->b->CCSEvents["BeforeShow"] = "CriteriaRpt_b_BeforeShow";
    $CriteriaRpt->scat->CCSEvents["BeforeShow"] = "CriteriaRpt_scat_BeforeShow";
    $CriteriaRpt->year->CCSEvents["BeforeShow"] = "CriteriaRpt_year_BeforeShow";
    $CriteriaStat2->year->CCSEvents["BeforeShow"] = "CriteriaStat2_year_BeforeShow";
    $CriteriaStat2->CCSEvents["BeforeShow"] = "CriteriaStat2_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//OptionReport_type_BeforeShow @8-13457745
function OptionReport_type_BeforeShow(& $sender)
{
    $OptionReport_type_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $OptionReport; //Compatibility
//End OptionReport_type_BeforeShow

//Close OptionReport_type_BeforeShow @8-EA29DD8A
    return $OptionReport_type_BeforeShow;
}
//End Close OptionReport_type_BeforeShow

//CriteriaRpt_Button_DoSearch_OnClick @16-5FF2398D
function CriteriaRpt_Button_DoSearch_OnClick(& $sender)
{
    $CriteriaRpt_Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaRpt; //Compatibility
//End CriteriaRpt_Button_DoSearch_OnClick

//Custom Code @41-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close CriteriaRpt_Button_DoSearch_OnClick @16-62412B81
    return $CriteriaRpt_Button_DoSearch_OnClick;
}
//End Close CriteriaRpt_Button_DoSearch_OnClick

//CriteriaRpt_b_BeforeShow @18-EB48A3A5
function CriteriaRpt_b_BeforeShow(& $sender)
{
    $CriteriaRpt_b_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaRpt; //Compatibility
//End CriteriaRpt_b_BeforeShow

//Close CriteriaRpt_b_BeforeShow @18-68CE85D8
    return $CriteriaRpt_b_BeforeShow;
}
//End Close CriteriaRpt_b_BeforeShow

//CriteriaRpt_scat_BeforeShow @22-F3EF1CCB
function CriteriaRpt_scat_BeforeShow(& $sender)
{
    $CriteriaRpt_scat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaRpt; //Compatibility
//End CriteriaRpt_scat_BeforeShow

//Close CriteriaRpt_scat_BeforeShow @22-539B9411
    return $CriteriaRpt_scat_BeforeShow;
}
//End Close CriteriaRpt_scat_BeforeShow

//CriteriaRpt_year_BeforeShow @76-260A231F
function CriteriaRpt_year_BeforeShow(& $sender)
{
    $CriteriaRpt_year_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaRpt; //Compatibility
//End CriteriaRpt_year_BeforeShow

//Custom Code @77-2A29BDB7
// -------------------------
    $year = date("Y");  
	for ($i=0; $i<=10; $i++)  
	{  
	$CriteriaRpt->year->Values[$i] = array($year,$year);  
	$year -=1;  
	}
// -------------------------
//End Custom Code

//Close CriteriaRpt_year_BeforeShow @76-CAE4691A
    return $CriteriaRpt_year_BeforeShow;
}
//End Close CriteriaRpt_year_BeforeShow

//CriteriaStat2_year_BeforeShow @78-0D5B7A64
function CriteriaStat2_year_BeforeShow(& $sender)
{
    $CriteriaStat2_year_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaStat2; //Compatibility
//End CriteriaStat2_year_BeforeShow

//Custom Code @79-2A29BDB7
// -------------------------
    $year = date("Y");  
	for ($i=0; $i<=10; $i++) {  
		$CriteriaStat2->year->Values[$i] = array($year,$year);  
		$year -=1; 
	}
// -------------------------
//End Custom Code

//Close CriteriaStat2_year_BeforeShow @78-EB2BC4F8
    return $CriteriaStat2_year_BeforeShow;
}
//End Close CriteriaStat2_year_BeforeShow

//CriteriaStat2_BeforeShow @57-1AA6F5F1
function CriteriaStat2_BeforeShow(& $sender)
{
    $CriteriaStat2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CriteriaStat2; //Compatibility
//End CriteriaStat2_BeforeShow

//Custom Code @83-2A29BDB7
// -------------------------
    if(CCGetParam("type")=="pm") {
		$CriteriaStat2->month->Visible = true;
		$CriteriaStat2->lblNote->SetValue("Please select both Month & Year to generate this PM Statistic");
	} elseif(CCGetParam("type")=="tcktlogstat") {
		$CriteriaStat2->month->Visible = true;
		$CriteriaStat2->lblNote->SetValue("Please select both Month & Year to generate this the Statistic");
	} elseif(CCGetParam("type")=="rtsla" || CCGetParam("type")=="restimesla") {
		$CriteriaStat2->month->Visible = true;
		$CriteriaStat2->lblNote->SetValue("Please select both Month & Year to generate this the Statistic");
	} elseif(CCGetParam("type")=="rtn") {
		$CriteriaStat2->month->Visible = true;
		$CriteriaStat2->lblNote->SetValue("Please select both Month & Year to generate this the Report");
	} else {
		$CriteriaStat2->month->Visible = false;
		$CriteriaStat2->lblNote->SetValue("");
	}
// -------------------------
//End Custom Code

//Close CriteriaStat2_BeforeShow @57-19D0A483
    return $CriteriaStat2_BeforeShow;
}
//End Close CriteriaStat2_BeforeShow

//Page_AfterInitialize @1-5F6C4D48
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reports, $OptionReport, $CriteriaRpt, $CriteriaStat, $CriteriaStat2, $Panrptticketrn, $Panstatpm, $Panstatcat, $Panresnote, $Panbranch, $PanTicket, $Panbranchcat, $pantcktlogstat, $pansla, $pangraf, $panrsltnnote, $panrtnlist; //Compatibility
//End Page_AfterInitialize

//Custom Code @42-2A29BDB7
// -------------------------
	switch(CCGetParam("opt")) {
		case 'rpt':
			if(CCGetParam("type")=="rtn"){
				$CriteriaRpt->Visible = false;
				$CriteriaStat->Visible = true;
			} else {
				$CriteriaRpt->Visible = true;
				$CriteriaStat2->Visible = false;
			}
			$CriteriaStat->Visible = false;
			$Panstatpm->Visible = false;
			$Panstatcat->Visible = false;
			$Panbranch->Visible = false;
			$PanTicket->Visible = false;
			$Panrptticketrn->Visible = false;
			$Panresnote->Visible = false;
			$Panbranchcat->Visible = false;
			$pantcktlogstat->Visible = false;
			$pansla->Visible = false;
			$pangraf->Visible = false;
			$panrsltnnote->Visible = false;
			$panrtnlist->Visible = false;
			if(CCGetParam("set")==1 && CCGetParam("type")=="ticketrn") {
				$Panrptticketrn->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="tckt" && CCGetParam("ccsForm")==null) {
				$PanTicket->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="rsltnnote") {
				$panrsltnnote->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="rtn") {
				$panrtnlist->Visible = true;
			} 
		break;
		case 'stat':
			$CriteriaStat2->Visible = true;
			$Panstatpm->Visible = false;
			$CriteriaRpt->Visible = false;
			$CriteriaStat->Visible = false;
			$Panrptticketrn->Visible = false;
			$Panstatcat->Visible = false;
			$Panresnote->Visible = false;
			$Panbranch->Visible = false;
			$PanTicket->Visible = false;
			$Panbranchcat->Visible = false;
			$pantcktlogstat->Visible = false;
			$pansla->Visible = false;
			$pangraf->Visible = false;
			$panrtnlist->Visible = false;
			if(CCGetParam("set")==1 && CCGetParam("type")=="pm") {
				$Panstatpm->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="prob") {
				$Panstatcat->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="branch") {
				$Panbranch->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="resnote") {
				$Panresnote->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="branchcat") {
				$Panbranchcat->Visible = true;
			} elseif(CCGetParam("set")==1 && CCGetParam("type")=="tcktlogstat") {
				$pantcktlogstat->Visible = true;
			} elseif(CCGetParam("set")==1 && (CCGetParam("type")=="sla" || CCGetParam("type")=="rtsla")) {
				$pansla->Visible = true;
			}
		break;
		case 'grf':
			$CriteriaRpt->Visible = false;
			$CriteriaStat->Visible = false;
			$CriteriaStat2->Visible = true;
			$Panrptticketrn->Visible = false;
			$Panstatpm->Visible = false;
			$Panstatcat->Visible = false;
			$Panresnote->Visible = false;
			$Panbranch->Visible = false;
			$PanTicket->Visible = false;
			$Panbranchcat->Visible = false;
			$pantcktlogstat->Visible = false;
			$pansla->Visible = false;
			$pangraf->Visible = false;
			$panrtnlist->Visible = false;
			if(CCGetParam("set")==1 && CCGetParam("year")!=null) {
				$pangraf->Visible = true;
			}
		break;
		case 'resnote':
			$CriteriaStat2->Visible = true;
			$Panstatpm->Visible = false;
			$CriteriaRpt->Visible = false;
			$CriteriaStat->Visible = false;
			$Panrptticketrn->Visible = false;
			$Panstatcat->Visible = false;
			$Panresnote->Visible = false;
			$Panbranch->Visible = false;
			$PanTicket->Visible = false;
			$Panbranchcat->Visible = false;
			$pantcktlogstat->Visible = false;
			$pansla->Visible = false;
			$pangraf->Visible = false;
			$panrtnlist->Visible = false;
			if(CCGetParam("set")==1 && CCGetParam("type")=="resnote") {
				$Panresnote->Visible = true;
			} 
		break;
		default :
			$CriteriaRpt->Visible = false;
			$CriteriaStat->Visible = false;
			$CriteriaStat2->Visible = false;
			$Panrptticketrn->Visible = false;
			$Panstatpm->Visible = false;
			$Panstatcat->Visible = false;
			$Panresnote->Visible = false;
			$Panbranch->Visible = false;
			$PanTicket->Visible = false;
			$Panbranchcat->Visible = false;
			$pantcktlogstat->Visible = false;
			$pansla->Visible = false;
			$pangraf->Visible = false;
			$panrsltnnote->Visible = false;
			$panrtnlist->Visible = false;
		break;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-46C1ED9E
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reports; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
