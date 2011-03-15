<?php
// //Events @1-F81417CB

//reportscat_GStatProbCat_JanTic_BeforeShow @20-764D976F
function reportscat_GStatProbCat_JanTic_BeforeShow(& $sender)
{
    $reportscat_GStatProbCat_JanTic_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportscat; //Compatibility
//End reportscat_GStatProbCat_JanTic_BeforeShow

//Custom Code @42-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close reportscat_GStatProbCat_JanTic_BeforeShow @20-452AD933
    return $reportscat_GStatProbCat_JanTic_BeforeShow;
}
//End Close reportscat_GStatProbCat_JanTic_BeforeShow

//reportscat_GStatProbCat_BeforeShowRow @9-3EC6187E
function reportscat_GStatProbCat_BeforeShowRow(& $sender)
{
    $reportscat_GStatProbCat_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportscat, $GStatProbCat,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportscat_GStatProbCat_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    $reportscat->GStatProbCat->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();
	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_category='".$reportscat->GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$reportscat->GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketDec 
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
	if($JanTickt > 0) $reportscat->GStatProbCat->JanTic->SetValue($JanTickt);
	else $reportscat->GStatProbCat->JanTic->SetValue("-");

	if($FebTickt > 0) $reportscat->GStatProbCat->FebTic->SetValue($FebTickt);
	else $reportscat->GStatProbCat->FebTic->SetValue("-");

	if($MacTickt > 0) $reportscat->GStatProbCat->MacTic->SetValue($MacTickt);
	else $reportscat->GStatProbCat->MacTic->SetValue("-");

	if($AprTickt > 0) $reportscat->GStatProbCat->AprTic->SetValue($AprTickt);
	else $reportscat->GStatProbCat->AprTic->SetValue("-");

	if($MeiTickt > 0) $reportscat->GStatProbCat->MeiTic->SetValue($MeiTickt);
	else $reportscat->GStatProbCat->MeiTic->SetValue("-");

	if($JuneTickt > 0) $reportscat->GStatProbCat->JuneTic->SetValue($JuneTickt);
	else $reportscat->GStatProbCat->JuneTic->SetValue("-");

	if($JulyTickt > 0) $reportscat->GStatProbCat->JulTic->SetValue($JulyTickt);
	else $reportscat->GStatProbCat->JulTic->SetValue("-");

	if($AugTickt > 0) $reportscat->GStatProbCat->Augtic->SetValue($AugTickt);
	else $reportscat->GStatProbCat->Augtic->SetValue("-");

	if($SeptTickt > 0) $reportscat->GStatProbCat->SeptTic->SetValue($SeptTickt);
	else $reportscat->GStatProbCat->SeptTic->SetValue("-");

	if($OctTickt > 0) $reportscat->GStatProbCat->OctTic->SetValue($OctTickt);
	else $reportscat->GStatProbCat->OctTic->SetValue("-");

	if($NovTic > 0) $reportscat->GStatProbCat->NovTic->SetValue($NovTickt);
	else $reportscat->GStatProbCat->NovTic->SetValue("-");

	if($DecTickt > 0) $reportscat->GStatProbCat->DecTic->SetValue($DecTickt);
	else $reportscat->GStatProbCat->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$reportscat->GStatProbCat->TotalTic->SetValue($TotalRow);

	$GTotal = $reportscat->GStatProbCat->TotalTic->GetValue() + $reportscat->GStatProbCat->GTotal->GetValue();
	$reportscat->GStatProbCat->GTotal->SetValue($GTotal);

	$GJanTic = $reportscat->GStatProbCat->JanTic->GetValue() + $reportscat->GStatProbCat->TotalJan->GetValue();
	$reportscat->GStatProbCat->TotalJan->SetValue($GJanTic);

	$GFebTic = $reportscat->GStatProbCat->FebTic->GetValue() + $reportscat->GStatProbCat->TotalFeb->GetValue();
	$reportscat->GStatProbCat->TotalFeb->SetValue($GFebTic);

	$GMacTic = $reportscat->GStatProbCat->MacTic->GetValue() + $reportscat->GStatProbCat->TotalMac->GetValue();
	$reportscat->GStatProbCat->TotalMac->SetValue($GMacTic);

	$GAprTic = $reportscat->GStatProbCat->AprTic->GetValue() + $reportscat->GStatProbCat->TotalApr->GetValue();
	$reportscat->GStatProbCat->TotalApr->SetValue($GAprTic);

	$GMeiTic = $reportscat->GStatProbCat->MeiTic->GetValue() + $reportscat->GStatProbCat->TotalMei->GetValue();
	$reportscat->GStatProbCat->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $reportscat->GStatProbCat->JuneTic->GetValue() + $reportscat->GStatProbCat->TotalJune->GetValue();
	$reportscat->GStatProbCat->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $reportscat->GStatProbCat->JulTic->GetValue() + $reportscat->GStatProbCat->TotalJuly->GetValue();
	$reportscat->GStatProbCat->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $reportscat->GStatProbCat->Augtic->GetValue() + $reportscat->GStatProbCat->TotalAug->GetValue();
	$reportscat->GStatProbCat->TotalAug->SetValue($GAugTic);

	$GSeptTic = $reportscat->GStatProbCat->SeptTic->GetValue() + $reportscat->GStatProbCat->TotalSept->GetValue();
	$reportscat->GStatProbCat->TotalSept->SetValue($GSeptTic);

	$GOctTic = $reportscat->GStatProbCat->OctTic->GetValue() + $reportscat->GStatProbCat->TotalOct->GetValue();
	$reportscat->GStatProbCat->TotalOct->SetValue($GOctTic);

	$GNovTic = $reportscat->GStatProbCat->NovTic->GetValue() + $reportscat->GStatProbCat->TotalNov->GetValue();
	$reportscat->GStatProbCat->TotalNov->SetValue($GNovTic);

	$GDecTic = $reportscat->GStatProbCat->DecTic->GetValue() + $reportscat->GStatProbCat->TotalDec->GetValue();
	$reportscat->GStatProbCat->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close reportscat_GStatProbCat_BeforeShowRow @9-B4C1D21A
    return $reportscat_GStatProbCat_BeforeShowRow;
}
//End Close reportscat_GStatProbCat_BeforeShowRow

//reportscat_GStatProbCat_BeforeShow @9-85D72A0A
function reportscat_GStatProbCat_BeforeShow(& $sender)
{
    $reportscat_GStatProbCat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportscat, $GStatProbCat, $BilRekod, $PageFirstRecordNo; //Compatibility
//End reportscat_GStatProbCat_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
    if($reportscat->GStatProbCat->PageNumber != null){
		$PageFirstRecordNo = ($reportscat->GStatProbCat->PageSize * ($reportscat->GStatProbCat->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportscat->GStatProbCat->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportscat->GStatProbCat->lblNumber->SetValue($BilRekod);
	$reportscat->GStatProbCat->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close reportscat_GStatProbCat_BeforeShow @9-22FF5A0F
    return $reportscat_GStatProbCat_BeforeShow;
}
//End Close reportscat_GStatProbCat_BeforeShow
?>
