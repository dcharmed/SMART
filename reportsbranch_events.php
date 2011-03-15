<?php
// //Events @1-F81417CB

//reportsbranch_GReportBranchByYear_BeforeShowRow @20-C3816B28
function reportsbranch_GReportBranchByYear_BeforeShowRow(& $sender)
{
    $reportsbranch_GReportBranchByYear_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranch,$GReportBranchByYear,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsbranch_GReportBranchByYear_BeforeShowRow

//Custom Code @38-2A29BDB7
// -------------------------
	$reportsbranch->GReportBranchByYear->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();

	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_site='".$reportsbranch->GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketDec 
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".$year;
	
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$JanTickt = $db->f("TicketJan");
		$FebTickt = $db->f("TicketFeb");
		$MacTickt = $db->f("TicketMac");
		$AprTickt = $db->f("TicketApr");
		$MeiTickt = $db->f("TicketMei");
		$JuneTickt = $db->f("TicketJune");
		$JulyTickt = $db->f("TicketJuly");
		$AugTickt = $db->f("TicketAug");
		$SeptTickt = $db->f("TicketSept");
		$OctTickt = $db->f("TicketOct");
		$NovTickt = $db->f("TicketNov");
		$DecTickt = $db->f("TicketDec");
	}
	if($JanTickt > 0) $reportsbranch->GReportBranchByYear->JanTic->SetValue($JanTickt);
	else $reportsbranch->GReportBranchByYear->JanTic->SetValue("-");
	
	if($FebTickt > 0) $reportsbranch->GReportBranchByYear->FebTic->SetValue($FebTickt);
	else $reportsbranch->GReportBranchByYear->FebTic->SetValue("-");

	if($MacTickt > 0) $reportsbranch->GReportBranchByYear->MacTic->SetValue($MacTickt);
	else $reportsbranch->GReportBranchByYear->MacTic->SetValue("-");

	if($AprTickt > 0) $reportsbranch->GReportBranchByYear->AprTic->SetValue($AprTickt);
	else $reportsbranch->GReportBranchByYear->AprTic->SetValue("-");

	if($MeiTickt > 0) $reportsbranch->GReportBranchByYear->MeiTic->SetValue($MeiTickt);
	else $reportsbranch->GReportBranchByYear->MeiTic->SetValue("-");

	if ($JuneTickt > 0) $reportsbranch->GReportBranchByYear->JuneTic->SetValue($JuneTickt);
	else $reportsbranch->GReportBranchByYear->JuneTic->SetValue("-");
	
	if($JulyTickt > 0) $reportsbranch->GReportBranchByYear->JulyTic->SetValue($JulyTickt);
	else $reportsbranch->GReportBranchByYear->JulyTic->SetValue("-");

	if($AugTickt > 0) $reportsbranch->GReportBranchByYear->AugTic->SetValue($AugTickt);
	else $reportsbranch->GReportBranchByYear->AugTic->SetValue("-");

	if($SeptTickt > 0) $reportsbranch->GReportBranchByYear->SeptTic->SetValue($SeptTickt);
	else $reportsbranch->GReportBranchByYear->SeptTic->SetValue("-");

	if($OctTickt > 0) $reportsbranch->GReportBranchByYear->OctTic->SetValue($OctTickt);
	else $reportsbranch->GReportBranchByYear->OctTic->SetValue("-");

	if($NovTickt > 0) $reportsbranch->GReportBranchByYear->NovTic->SetValue($NovTickt);
	else $reportsbranch->GReportBranchByYear->NovTic->SetValue("-");

	if($DecTickt > 0) $reportsbranch->GReportBranchByYear->DecTic->SetValue($DecTickt);
	else $reportsbranch->GReportBranchByYear->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$reportsbranch->GReportBranchByYear->TicMonth->SetValue($TotalRow);
	$GTotal = $reportsbranch->GReportBranchByYear->TicMonth->GetValue() + $reportsbranch->GReportBranchByYear->GrandTotal->GetValue();
	$reportsbranch->GReportBranchByYear->GrandTotal->SetValue($GTotal);

	$GJanTic = $reportsbranch->GReportBranchByYear->JanTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalJan->GetValue();
	$reportsbranch->GReportBranchByYear->TotalJan->SetValue($GJanTic);

	$GFebTic = $reportsbranch->GReportBranchByYear->FebTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalFeb->GetValue();
	$reportsbranch->GReportBranchByYear->TotalFeb->SetValue($GFebTic);

	$GMacTic = $reportsbranch->GReportBranchByYear->MacTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalMac->GetValue();
	$reportsbranch->GReportBranchByYear->TotalMac->SetValue($GMacTic);

	$GAprTic = $reportsbranch->GReportBranchByYear->AprTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalApr->GetValue();
	$reportsbranch->GReportBranchByYear->TotalApr->SetValue($GAprTic);

	$GMeiTic = $reportsbranch->GReportBranchByYear->MeiTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalMei->GetValue();
	$reportsbranch->GReportBranchByYear->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $reportsbranch->GReportBranchByYear->JuneTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalJune->GetValue();
	$reportsbranch->GReportBranchByYear->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $reportsbranch->GReportBranchByYear->JulyTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalJuly->GetValue();
	$reportsbranch->GReportBranchByYear->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $reportsbranch->GReportBranchByYear->AugTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalAug->GetValue();
	$reportsbranch->GReportBranchByYear->TotalAug->SetValue($GAugTic);

	$GSeptTic = $reportsbranch->GReportBranchByYear->SeptTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalSept->GetValue();
	$reportsbranch->GReportBranchByYear->TotalSept->SetValue($GSeptTic);

	$GOctTic = $reportsbranch->GReportBranchByYear->OctTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalOct->GetValue();
	$reportsbranch->GReportBranchByYear->TotalOct->SetValue($GOctTic);

	$GNovTic = $reportsbranch->GReportBranchByYear->NovTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalNov->GetValue();
	$reportsbranch->GReportBranchByYear->TotalNov->SetValue($GNovTic);

	$GDecTic = $reportsbranch->GReportBranchByYear->DecTic->GetValue() + $reportsbranch->GReportBranchByYear->TotalDec->GetValue();
	$reportsbranch->GReportBranchByYear->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close reportsbranch_GReportBranchByYear_BeforeShowRow @20-55CDFA8E
    return $reportsbranch_GReportBranchByYear_BeforeShowRow;
}
//End Close reportsbranch_GReportBranchByYear_BeforeShowRow

//reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect @20-3DCECE36
function reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect(& $sender)
{
    $reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranch; //Compatibility
//End reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect

//Custom Code @39-2A29BDB7
// -------------------------
    //$reportsbranch->GReportBranchByYear->DataSource->Where .= " AND rsltn_actionmethod=".$reportsbranch->GReportBranchByYear->ds->ref_value->GetValue();
	
// -------------------------
//End Custom Code

//Close reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect @20-ECE7278F
    return $reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect;
}
//End Close reportsbranch_GReportBranchByYear_ds_BeforeBuildSelect

//reportsbranch_GReportBranchByYear_BeforeShow @20-732C45D8
function reportsbranch_GReportBranchByYear_BeforeShow(& $sender)
{
    $reportsbranch_GReportBranchByYear_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranch, $GReportBranchByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsbranch_GReportBranchByYear_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
	if($reportsbranch->GReportBranchByYear->PageNumber != null){
		$PageFirstRecordNo = ($reportsbranch->GReportBranchByYear->PageSize * ($reportsbranch->GReportBranchByYear->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportsbranch->GReportBranchByYear->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportsbranch->GReportBranchByYear->lblNumber->SetValue($BilRekod);
	$reportsbranch->GReportBranchByYear->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close reportsbranch_GReportBranchByYear_BeforeShow @20-30C25060
    return $reportsbranch_GReportBranchByYear_BeforeShow;
}
//End Close reportsbranch_GReportBranchByYear_BeforeShow

//reportsbranch_AfterInitialize @1-449B5844
function reportsbranch_AfterInitialize(& $sender)
{
    $reportsbranch_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranch, $GReportBranch, $GReportBranchByYear; //Compatibility
//End reportsbranch_AfterInitialize

//Custom Code @50-2A29BDB7
// -------------------------
    if(CCGetParam("month")==null && CCGetParam("year")!=null) {
		$reportsbranch->GReportBranchByYear->Visible = true;
		$reportsbranch->GReportBranch->Visible = false;
		if(CCGetParam("print") == 1) {
			header("Content-type: application/octet-stream");
 
			# replace excelfile.xls with whatever you want the filename to default to
			header("Content-Disposition: attachment; filename=excelfile.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
	} elseif(CCGetParam("month")!=null && CCGetParam("year")!=null) {
		$reportsbranch->GReportBranchByYear->Visible = false;
		$reportsbranch->GReportBranch->Visible = true;
		//$reportsbranch->Report_Print1->Visible = false;
		//$reportsbranch->Report_Print->Visible = true;
	}
	
// -------------------------
//End Custom Code

//Close reportsbranch_AfterInitialize @1-128EB445
    return $reportsbranch_AfterInitialize;
}
//End Close reportsbranch_AfterInitialize
?>
