<?php
// //Events @1-F81417CB

//reportsresnote_GTicketMethodByYear_BeforeShowRow @55-28E2A7CD
function reportsresnote_GTicketMethodByYear_BeforeShowRow(& $sender)
{
    $reportsresnote_GTicketMethodByYear_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsresnote,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsresnote_GTicketMethodByYear_BeforeShowRow

//Custom Code @73-2A29BDB7
// -------------------------
	$reportsresnote->GTicketMethodByYear->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
    $year = CCGetParam("year");
    $db = new clsDBSMART();

	//THIS IS PREVIOUS SQL BEFORE MOVE THE RSLTN FIELD TO THE TICKET TABLE
	/*$sql = "SELECT SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=1 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=2 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=3 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=4 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=5 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=6 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=7 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=8 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=9 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=10 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=11 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=12 AND smart_resolutionnote.rsltn_actionmethod=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketDec 
			FROM smart_resolutionnote 
			WHERE YEAR(smart_resolutionnote.rsltn_date) = ".$year;*/
	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_c_method=".$reportsresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketDec 
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
	
	if($JanTickt > 0) $reportsresnote->GTicketMethodByYear->JanTic->SetValue($JanTickt);
	else $reportsresnote->GTicketMethodByYear->JanTic->SetValue("-");

	if($FebTickt > 0) $reportsresnote->GTicketMethodByYear->FebTic->SetValue($FebTickt);
	else $reportsresnote->GTicketMethodByYear->FebTic->SetValue("-");

	if($MacTickt > 0) $reportsresnote->GTicketMethodByYear->MacTic->SetValue($MacTickt);
	else $reportsresnote->GTicketMethodByYear->MacTic->SetValue("-");

	if($AprTickt > 0) $reportsresnote->GTicketMethodByYear->AprTic->SetValue($AprTickt);
	else $reportsresnote->GTicketMethodByYear->AprTic->SetValue("-");

	if($MeiTickt > 0) $reportsresnote->GTicketMethodByYear->MeiTic->SetValue($MeiTickt);
	else $reportsresnote->GTicketMethodByYear->MeiTic->SetValue("-");

	if($JuneTickt > 0) $reportsresnote->GTicketMethodByYear->JuneTic->SetValue($JuneTickt);
	else $reportsresnote->GTicketMethodByYear->JuneTic->SetValue("-");

	if($JulyTickt > 0) $reportsresnote->GTicketMethodByYear->JulyTic->SetValue($JulyTickt);
	else $reportsresnote->GTicketMethodByYear->JulyTic->SetValue("-");

	if($AugTickt > 0) $reportsresnote->GTicketMethodByYear->AugTic->SetValue($AugTickt);
	else $reportsresnote->GTicketMethodByYear->AugTic->SetValue("-");

	if($SeptTickt > 0) $reportsresnote->GTicketMethodByYear->SeptTic->SetValue($SeptTickt);
	else $reportsresnote->GTicketMethodByYear->SeptTic->SetValue("-");

	if($OctTickt > 0) $reportsresnote->GTicketMethodByYear->OctTic->SetValue($OctTickt);
	else $reportsresnote->GTicketMethodByYear->OctTic->SetValue("-");

	if($NovTic > 0) $reportsresnote->GTicketMethodByYear->NovTic->SetValue($NovTickt);
	else $reportsresnote->GTicketMethodByYear->NovTic->SetValue("-");

	if($DecTickt > 0) $reportsresnote->GTicketMethodByYear->DecTic->SetValue($DecTickt);
	else $reportsresnote->GTicketMethodByYear->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$reportsresnote->GTicketMethodByYear->TicMonth->SetValue($TotalRow);

	$GTotal = $reportsresnote->GTicketMethodByYear->TicMonth->GetValue() + $reportsresnote->GTicketMethodByYear->GrandTotal->GetValue();
	$reportsresnote->GTicketMethodByYear->GrandTotal->SetValue($GTotal);

	$GJanTic = $reportsresnote->GTicketMethodByYear->JanTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalJan->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalJan->SetValue($GJanTic);

	$GFebTic = $reportsresnote->GTicketMethodByYear->FebTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalFeb->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalFeb->SetValue($GFebTic);

	$GMacTic = $reportsresnote->GTicketMethodByYear->MacTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalMac->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalMac->SetValue($GMacTic);

	$GAprTic = $reportsresnote->GTicketMethodByYear->AprTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalApr->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalApr->SetValue($GAprTic);

	$GMeiTic = $reportsresnote->GTicketMethodByYear->MeiTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalMei->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $reportsresnote->GTicketMethodByYear->JuneTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalJune->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $reportsresnote->GTicketMethodByYear->JulyTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalJuly->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $reportsresnote->GTicketMethodByYear->AugTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalAug->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalAug->SetValue($GAugTic);

	$GSeptTic = $reportsresnote->GTicketMethodByYear->SeptTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalSept->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalSept->SetValue($GSeptTic);

	$GOctTic = $reportsresnote->GTicketMethodByYear->OctTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalOct->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalOct->SetValue($GOctTic);

	$GNovTic = $reportsresnote->GTicketMethodByYear->NovTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalNov->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalNov->SetValue($GNovTic);

	$GDecTic = $reportsresnote->GTicketMethodByYear->DecTic->GetValue() + $reportsresnote->GTicketMethodByYear->TotalDec->GetValue();
	$reportsresnote->GTicketMethodByYear->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close reportsresnote_GTicketMethodByYear_BeforeShowRow @55-B1710084
    return $reportsresnote_GTicketMethodByYear_BeforeShowRow;
}
//End Close reportsresnote_GTicketMethodByYear_BeforeShowRow

//reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect @55-CFB68ECF
function reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect(& $sender)
{
    $reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsresnote; //Compatibility
//End reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect

//Custom Code @74-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect @55-70B471C4
    return $reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect;
}
//End Close reportsresnote_GTicketMethodByYear_ds_BeforeBuildSelect

//reportsresnote_GTicketMethodByYear_BeforeShow @55-B7FB3714
function reportsresnote_GTicketMethodByYear_BeforeShow(& $sender)
{
    $reportsresnote_GTicketMethodByYear_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsresnote,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsresnote_GTicketMethodByYear_BeforeShow

//Custom Code @75-2A29BDB7
// -------------------------
	if($reportsresnote->GTicketMethodByYear->PageNumber != null){
		$PageFirstRecordNo = ($reportsresnote->GTicketMethodByYear->PageSize * ($reportsresnote->GTicketMethodByYear->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportsresnote->GTicketMethodByYear->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportsresnote->GTicketMethodByYear->lblNumber->SetValue($BilRekod);
	$reportsresnote->GTicketMethodByYear->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close reportsresnote_GTicketMethodByYear_BeforeShow @55-323C0FB8
    return $reportsresnote_GTicketMethodByYear_BeforeShow;
}
//End Close reportsresnote_GTicketMethodByYear_BeforeShow

//reportsresnote_AfterInitialize @1-972038C6
function reportsresnote_AfterInitialize(& $sender)
{
    $reportsresnote_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsresnote, $ByMonth, $GTicketMethodByYear; //Compatibility
//End reportsresnote_AfterInitialize

//Custom Code @54-2A29BDB7
// -------------------------
    if(CCGetParam("month")==null && CCGetParam("year")!=null) {
		$reportsresnote->GTicketMethodByYear->Visible = true;
		$reportsresnote->ByMonth->Visible = false;
		$reportsresnote->Report_Print->Visible = false;
		$reportsresnote->Report_Print1->Visible = true;
	} elseif(CCGetParam("month")!=null && CCGetParam("year")!=null) {
		$reportsresnote->GTicketMethodByYear->Visible = false;
		$reportsresnote->ByMonth->Visible = true;
		$reportsresnote->Report_Print1->Visible = false;
		$reportsresnote->Report_Print->Visible = true;
	}
// -------------------------
//End Custom Code

//Close reportsresnote_AfterInitialize @1-CD5D97FB
    return $reportsresnote_AfterInitialize;
}
//End Close reportsresnote_AfterInitialize


?>
