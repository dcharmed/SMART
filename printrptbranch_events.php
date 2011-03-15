<?php
//BindEvents Method @1-7635A8CD
function BindEvents()
{
    global $GReportBranchByYear;
    global $CCSEvents;
    $GReportBranchByYear->CCSEvents["BeforeShowRow"] = "GReportBranchByYear_BeforeShowRow";
    $GReportBranchByYear->ds->CCSEvents["BeforeBuildSelect"] = "GReportBranchByYear_ds_BeforeBuildSelect";
    $GReportBranchByYear->CCSEvents["BeforeShow"] = "GReportBranchByYear_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GReportBranchByYear_BeforeShowRow @2-C45A7C45
function GReportBranchByYear_BeforeShowRow(& $sender)
{
    $GReportBranchByYear_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReportBranchByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GReportBranchByYear_BeforeShowRow

//Custom Code @20-2A29BDB7
// -------------------------
	$GReportBranchByYear->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();

	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_site='".$GReportBranchByYear->ref_value->GetValue()."',1,0)) AS TicketDec 
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
	if($JanTickt > 0) $GReportBranchByYear->JanTic->SetValue($JanTickt);
	else $GReportBranchByYear->JanTic->SetValue("-");
	
	if($FebTickt > 0) $GReportBranchByYear->FebTic->SetValue($FebTickt);
	else $GReportBranchByYear->FebTic->SetValue("-");

	if($MacTickt > 0) $GReportBranchByYear->MacTic->SetValue($MacTickt);
	else $GReportBranchByYear->MacTic->SetValue("-");

	if($AprTickt > 0) $GReportBranchByYear->AprTic->SetValue($AprTickt);
	else $GReportBranchByYear->AprTic->SetValue("-");

	if($MeiTickt > 0) $GReportBranchByYear->MeiTic->SetValue($MeiTickt);
	else $GReportBranchByYear->MeiTic->SetValue("-");

	if ($JuneTickt > 0) $GReportBranchByYear->JuneTic->SetValue($JuneTickt);
	else $GReportBranchByYear->JuneTic->SetValue("-");
	
	if($JulyTickt > 0) $GReportBranchByYear->JulyTic->SetValue($JulyTickt);
	else $GReportBranchByYear->JulyTic->SetValue("-");

	if($AugTickt > 0) $GReportBranchByYear->AugTic->SetValue($AugTickt);
	else $GReportBranchByYear->AugTic->SetValue("-");

	if($SeptTickt > 0) $GReportBranchByYear->SeptTic->SetValue($SeptTickt);
	else $GReportBranchByYear->SeptTic->SetValue("-");

	if($OctTickt > 0) $GReportBranchByYear->OctTic->SetValue($OctTickt);
	else $GReportBranchByYear->OctTic->SetValue("-");

	if($NovTickt > 0) $GReportBranchByYear->NovTic->SetValue($NovTickt);
	else $GReportBranchByYear->NovTic->SetValue("-");

	if($DecTickt > 0) $GReportBranchByYear->DecTic->SetValue($DecTickt);
	else $GReportBranchByYear->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$GReportBranchByYear->TicMonth->SetValue($TotalRow);
	$GTotal = $GReportBranchByYear->TicMonth->GetValue() + $GReportBranchByYear->GrandTotal->GetValue();
	$GReportBranchByYear->GrandTotal->SetValue($GTotal);

	$GJanTic = $GReportBranchByYear->JanTic->GetValue() + $GReportBranchByYear->TotalJan->GetValue();
	$GReportBranchByYear->TotalJan->SetValue($GJanTic);

	$GFebTic = $GReportBranchByYear->FebTic->GetValue() + $GReportBranchByYear->TotalFeb->GetValue();
	$GReportBranchByYear->TotalFeb->SetValue($GFebTic);

	$GMacTic = $GReportBranchByYear->MacTic->GetValue() + $GReportBranchByYear->TotalMac->GetValue();
	$GReportBranchByYear->TotalMac->SetValue($GMacTic);

	$GAprTic = $GReportBranchByYear->AprTic->GetValue() + $GReportBranchByYear->TotalApr->GetValue();
	$GReportBranchByYear->TotalApr->SetValue($GAprTic);

	$GMeiTic = $GReportBranchByYear->MeiTic->GetValue() + $GReportBranchByYear->TotalMei->GetValue();
	$GReportBranchByYear->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $GReportBranchByYear->JuneTic->GetValue() + $GReportBranchByYear->TotalJune->GetValue();
	$GReportBranchByYear->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $GReportBranchByYear->JulyTic->GetValue() + $GReportBranchByYear->TotalJuly->GetValue();
	$GReportBranchByYear->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $GReportBranchByYear->AugTic->GetValue() + $GReportBranchByYear->TotalAug->GetValue();
	$GReportBranchByYear->TotalAug->SetValue($GAugTic);

	$GSeptTic = $GReportBranchByYear->SeptTic->GetValue() + $GReportBranchByYear->TotalSept->GetValue();
	$GReportBranchByYear->TotalSept->SetValue($GSeptTic);

	$GOctTic = $GReportBranchByYear->OctTic->GetValue() + $GReportBranchByYear->TotalOct->GetValue();
	$GReportBranchByYear->TotalOct->SetValue($GOctTic);

	$GNovTic = $GReportBranchByYear->NovTic->GetValue() + $GReportBranchByYear->TotalNov->GetValue();
	$GReportBranchByYear->TotalNov->SetValue($GNovTic);

	$GDecTic = $GReportBranchByYear->DecTic->GetValue() + $GReportBranchByYear->TotalDec->GetValue();
	$GReportBranchByYear->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close GReportBranchByYear_BeforeShowRow @2-FFEB0E6C
    return $GReportBranchByYear_BeforeShowRow;
}
//End Close GReportBranchByYear_BeforeShowRow

//GReportBranchByYear_ds_BeforeBuildSelect @2-62789426
function GReportBranchByYear_ds_BeforeBuildSelect(& $sender)
{
    $GReportBranchByYear_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReportBranchByYear; //Compatibility
//End GReportBranchByYear_ds_BeforeBuildSelect

//Custom Code @21-2A29BDB7
// -------------------------
    //$reportsresnote->GTicketMethodByYear->DataSource->Where .= " AND rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ds->ref_value->GetValue();
	
// -------------------------
//End Custom Code

//Close GReportBranchByYear_ds_BeforeBuildSelect @2-9A8CE87B
    return $GReportBranchByYear_ds_BeforeBuildSelect;
}
//End Close GReportBranchByYear_ds_BeforeBuildSelect

//GReportBranchByYear_BeforeShow @2-ABC00A8A
function GReportBranchByYear_BeforeShow(& $sender)
{
    $GReportBranchByYear_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReportBranchByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GReportBranchByYear_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
	if($GReportBranchByYear->PageNumber != null){
		$PageFirstRecordNo = ($GReportBranchByYear->PageSize * ($GReportBranchByYear->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GReportBranchByYear->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GReportBranchByYear->lblNumber->SetValue($BilRekod);
	$GReportBranchByYear->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close GReportBranchByYear_BeforeShow @2-78D83DBE
    return $GReportBranchByYear_BeforeShow;
}
//End Close GReportBranchByYear_BeforeShow

//Page_AfterInitialize @1-F47BDDA6
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrptbranch; //Compatibility
//End Page_AfterInitialize

//Custom Code @29-2A29BDB7
// -------------------------
    if(CCGetParam("print") == 1) {
			header("Content-type: application/octet-stream");
 
			# replace excelfile.xls with whatever you want the filename to default to
			header("Content-Disposition: attachment; filename=excelfile.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
