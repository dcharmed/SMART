<?php
//BindEvents Method @1-227D4400
function BindEvents()
{
    global $GStatProbCat;
    global $CCSEvents;
    $GStatProbCat->JanTic->CCSEvents["BeforeShow"] = "GStatProbCat_JanTic_BeforeShow";
    $GStatProbCat->CCSEvents["BeforeShowRow"] = "GStatProbCat_BeforeShowRow";
    $GStatProbCat->CCSEvents["BeforeShow"] = "GStatProbCat_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GStatProbCat_JanTic_BeforeShow @7-84FAE410
function GStatProbCat_JanTic_BeforeShow(& $sender)
{
    $GStatProbCat_JanTic_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatProbCat; //Compatibility
//End GStatProbCat_JanTic_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close GStatProbCat_JanTic_BeforeShow @7-60E656EB
    return $GStatProbCat_JanTic_BeforeShow;
}
//End Close GStatProbCat_JanTic_BeforeShow

//GStatProbCat_BeforeShowRow @2-8005239C
function GStatProbCat_BeforeShowRow(& $sender)
{
    $GStatProbCat_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatProbCat, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GStatProbCat_BeforeShowRow

//Custom Code @23-2A29BDB7
// -------------------------
    $GStatProbCat->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();
	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_category='".$GStatProbCat->catval->GetValue()."' AND smart_ticket.tckt_subcategory='".$GStatProbCat->subcatval->GetValue()."',1,0)) AS TicketDec 
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
	if($JanTickt > 0) $GStatProbCat->JanTic->SetValue($JanTickt);
	else $GStatProbCat->JanTic->SetValue("-");

	if($FebTickt > 0) $GStatProbCat->FebTic->SetValue($FebTickt);
	else $GStatProbCat->FebTic->SetValue("-");

	if($MacTickt > 0) $GStatProbCat->MacTic->SetValue($MacTickt);
	else $GStatProbCat->MacTic->SetValue("-");

	if($AprTickt > 0) $GStatProbCat->AprTic->SetValue($AprTickt);
	else $GStatProbCat->AprTic->SetValue("-");

	if($MeiTickt > 0) $GStatProbCat->MeiTic->SetValue($MeiTickt);
	else $GStatProbCat->MeiTic->SetValue("-");

	if($JuneTickt > 0) $GStatProbCat->JuneTic->SetValue($JuneTickt);
	else $GStatProbCat->JuneTic->SetValue("-");

	if($JulyTickt > 0) $GStatProbCat->JulTic->SetValue($JulyTickt);
	else $GStatProbCat->JulTic->SetValue("-");

	if($AugTickt > 0) $GStatProbCat->Augtic->SetValue($AugTickt);
	else $GStatProbCat->Augtic->SetValue("-");

	if($SeptTickt > 0) $GStatProbCat->SeptTic->SetValue($SeptTickt);
	else $GStatProbCat->SeptTic->SetValue("-");

	if($OctTickt > 0) $GStatProbCat->OctTic->SetValue($OctTickt);
	else $GStatProbCat->OctTic->SetValue("-");

	if($NovTic > 0) $GStatProbCat->NovTic->SetValue($NovTickt);
	else $GStatProbCat->NovTic->SetValue("-");

	if($DecTickt > 0) $GStatProbCat->DecTic->SetValue($DecTickt);
	else $GStatProbCat->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$GStatProbCat->TotalTic->SetValue($TotalRow);

	$GTotal = $GStatProbCat->TotalTic->GetValue() + $GStatProbCat->GTotal->GetValue();
	$GStatProbCat->GTotal->SetValue($GTotal);

	$GJanTic = $GStatProbCat->JanTic->GetValue() + $GStatProbCat->TotalJan->GetValue();
	$GStatProbCat->TotalJan->SetValue($GJanTic);

	$GFebTic = $GStatProbCat->FebTic->GetValue() + $GStatProbCat->TotalFeb->GetValue();
	$GStatProbCat->TotalFeb->SetValue($GFebTic);

	$GMacTic = $GStatProbCat->MacTic->GetValue() + $GStatProbCat->TotalMac->GetValue();
	$GStatProbCat->TotalMac->SetValue($GMacTic);

	$GAprTic = $GStatProbCat->AprTic->GetValue() + $GStatProbCat->TotalApr->GetValue();
	$GStatProbCat->TotalApr->SetValue($GAprTic);

	$GMeiTic = $GStatProbCat->MeiTic->GetValue() + $GStatProbCat->TotalMei->GetValue();
	$GStatProbCat->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $GStatProbCat->JuneTic->GetValue() + $GStatProbCat->TotalJune->GetValue();
	$GStatProbCat->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $GStatProbCat->JulTic->GetValue() + $GStatProbCat->TotalJuly->GetValue();
	$GStatProbCat->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $GStatProbCat->Augtic->GetValue() + $GStatProbCat->TotalAug->GetValue();
	$GStatProbCat->TotalAug->SetValue($GAugTic);

	$GSeptTic = $GStatProbCat->SeptTic->GetValue() + $GStatProbCat->TotalSept->GetValue();
	$GStatProbCat->TotalSept->SetValue($GSeptTic);

	$GOctTic = $GStatProbCat->OctTic->GetValue() + $GStatProbCat->TotalOct->GetValue();
	$GStatProbCat->TotalOct->SetValue($GOctTic);

	$GNovTic = $GStatProbCat->NovTic->GetValue() + $GStatProbCat->TotalNov->GetValue();
	$GStatProbCat->TotalNov->SetValue($GNovTic);

	$GDecTic = $GStatProbCat->DecTic->GetValue() + $GStatProbCat->TotalDec->GetValue();
	$GStatProbCat->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close GStatProbCat_BeforeShowRow @2-36FA095A
    return $GStatProbCat_BeforeShowRow;
}
//End Close GStatProbCat_BeforeShowRow

//GStatProbCat_BeforeShow @2-1414E6AF
function GStatProbCat_BeforeShow(& $sender)
{
    $GStatProbCat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatProbCat, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GStatProbCat_BeforeShow

//Custom Code @24-2A29BDB7
// -------------------------
    if($GStatProbCat->PageNumber != null){
		$PageFirstRecordNo = ($GStatProbCat->PageSize * ($GStatProbCat->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GStatProbCat->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GStatProbCat->lblNumber->SetValue($BilRekod);
	$GStatProbCat->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close GStatProbCat_BeforeShow @2-67D2BCB1
    return $GStatProbCat_BeforeShow;
}
//End Close GStatProbCat_BeforeShow

//Page_AfterInitialize @1-B7772A78
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrptcat; //Compatibility
//End Page_AfterInitialize

//Custom Code @33-2A29BDB7
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
