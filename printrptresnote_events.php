<?php
//BindEvents Method @1-57D8A54B
function BindEvents()
{
    global $GTicketMethodByYear;
    global $CCSEvents;
    $GTicketMethodByYear->CCSEvents["BeforeShowRow"] = "GTicketMethodByYear_BeforeShowRow";
    $GTicketMethodByYear->ds->CCSEvents["BeforeBuildSelect"] = "GTicketMethodByYear_ds_BeforeBuildSelect";
    $GTicketMethodByYear->CCSEvents["BeforeShow"] = "GTicketMethodByYear_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GTicketMethodByYear_BeforeShowRow @2-72CB792E
function GTicketMethodByYear_BeforeShowRow(& $sender)
{
    $GTicketMethodByYear_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTicketMethodByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GTicketMethodByYear_BeforeShowRow

//Custom Code @21-2A29BDB7
// -------------------------
	$GTicketMethodByYear->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
    $year = CCGetParam("year");
    $db = new clsDBSMART();

	
	$sql = "SELECT SUM(IF(MONTH(smart_ticket.tckt_r_date)=1 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=2 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=3 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=4 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=5 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=6 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=7 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=8 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=9 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=10 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=11 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_ticket.tckt_r_date)=12 AND smart_ticket.tckt_c_method=".$GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketDec 
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
	
	if($JanTickt > 0) $GTicketMethodByYear->JanTic->SetValue($JanTickt);
	else $GTicketMethodByYear->JanTic->SetValue("-");

	if($FebTickt > 0) $GTicketMethodByYear->FebTic->SetValue($FebTickt);
	else $GTicketMethodByYear->FebTic->SetValue("-");

	if($MacTickt > 0) $GTicketMethodByYear->MacTic->SetValue($MacTickt);
	else $GTicketMethodByYear->MacTic->SetValue("-");

	if($AprTickt > 0) $GTicketMethodByYear->AprTic->SetValue($AprTickt);
	else $GTicketMethodByYear->AprTic->SetValue("-");

	if($MeiTickt > 0) $GTicketMethodByYear->MeiTic->SetValue($MeiTickt);
	else $GTicketMethodByYear->MeiTic->SetValue("-");

	if($JuneTickt > 0) $GTicketMethodByYear->JuneTic->SetValue($JuneTickt);
	else $GTicketMethodByYear->JuneTic->SetValue("-");

	if($JulyTickt > 0) $GTicketMethodByYear->JulyTic->SetValue($JulyTickt);
	else $GTicketMethodByYear->JulyTic->SetValue("-");

	if($AugTickt > 0) $GTicketMethodByYear->AugTic->SetValue($AugTickt);
	else $GTicketMethodByYear->AugTic->SetValue("-");

	if($SeptTickt > 0) $GTicketMethodByYear->SeptTic->SetValue($SeptTickt);
	else $GTicketMethodByYear->SeptTic->SetValue("-");

	if($OctTickt > 0) $GTicketMethodByYear->OctTic->SetValue($OctTickt);
	else $GTicketMethodByYear->OctTic->SetValue("-");

	if($NovTic > 0) $GTicketMethodByYear->NovTic->SetValue($NovTickt);
	else $GTicketMethodByYear->NovTic->SetValue("-");

	if($DecTickt > 0) $GTicketMethodByYear->DecTic->SetValue($DecTickt);
	else $GTicketMethodByYear->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$GTicketMethodByYear->TicMonth->SetValue($TotalRow);
	$GTotal = $GTicketMethodByYear->TicMonth->GetValue() + $GTicketMethodByYear->GrandTotal->GetValue();
	$GTicketMethodByYear->GrandTotal->SetValue($GTotal);

	$GJanTic = $GTicketMethodByYear->JanTic->GetValue() + $GTicketMethodByYear->TotalJan->GetValue();
	$GTicketMethodByYear->TotalJan->SetValue($GJanTic);

	$GFebTic = $GTicketMethodByYear->FebTic->GetValue() + $GTicketMethodByYear->TotalFeb->GetValue();
	$GTicketMethodByYear->TotalFeb->SetValue($GFebTic);

	$GMacTic = $GTicketMethodByYear->MacTic->GetValue() + $GTicketMethodByYear->TotalMac->GetValue();
	$GTicketMethodByYear->TotalMac->SetValue($GMacTic);

	$GAprTic = $GTicketMethodByYear->AprTic->GetValue() + $GTicketMethodByYear->TotalApr->GetValue();
	$GTicketMethodByYear->TotalApr->SetValue($GAprTic);

	$GMeiTic = $GTicketMethodByYear->MeiTic->GetValue() + $GTicketMethodByYear->TotalMei->GetValue();
	$GTicketMethodByYear->TotalMei->SetValue($GMeiTic);

	$GJuneTic = $GTicketMethodByYear->JuneTic->GetValue() + $GTicketMethodByYear->TotalJune->GetValue();
	$GTicketMethodByYear->TotalJune->SetValue($GJuneTic);

	$GJulyTic = $GTicketMethodByYear->JulyTic->GetValue() + $GTicketMethodByYear->TotalJuly->GetValue();
	$GTicketMethodByYear->TotalJuly->SetValue($GJulyTic);

	$GAugTic = $GTicketMethodByYear->AugTic->GetValue() + $GTicketMethodByYear->AugTic->GetValue();
	$GTicketMethodByYear->TotalAug->SetValue($GAugTic);

	$GSeptTic = $GTicketMethodByYear->SeptTic->GetValue() + $GTicketMethodByYear->TotalSept->GetValue();
	$GTicketMethodByYear->TotalSept->SetValue($GSeptTic);

	$GOctTic = $GTicketMethodByYear->OctTic->GetValue() + $GTicketMethodByYear->TotalOct->GetValue();
	$GTicketMethodByYear->TotalOct->SetValue($GOctTic);

	$GNovTic = $GTicketMethodByYear->NovTic->GetValue() + $GTicketMethodByYear->TotalNov->GetValue();
	$GTicketMethodByYear->TotalNov->SetValue($GNovTic);

	$GDecTic = $GTicketMethodByYear->DecTic->GetValue() + $GTicketMethodByYear->TotalDec->GetValue();
	$GTicketMethodByYear->TotalDec->SetValue($GDecTic);
// -------------------------
//End Custom Code

//Close GTicketMethodByYear_BeforeShowRow @2-8B37CB4E
    return $GTicketMethodByYear_BeforeShowRow;
}
//End Close GTicketMethodByYear_BeforeShowRow

//GTicketMethodByYear_ds_BeforeBuildSelect @2-BBBEBABF
function GTicketMethodByYear_ds_BeforeBuildSelect(& $sender)
{
    $GTicketMethodByYear_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTicketMethodByYear; //Compatibility
//End GTicketMethodByYear_ds_BeforeBuildSelect

//Custom Code @22-2A29BDB7
// -------------------------
    //$GTicketMethodByYear->DataSource->Where .= " AND rsltn_actionmethod=".$GTicketMethodByYear->ds->ref_value->GetValue();
	
// -------------------------
//End Custom Code

//Close GTicketMethodByYear_ds_BeforeBuildSelect @2-2BD3EA5A
    return $GTicketMethodByYear_ds_BeforeBuildSelect;
}
//End Close GTicketMethodByYear_ds_BeforeBuildSelect

//GTicketMethodByYear_BeforeShow @2-2A76458F
function GTicketMethodByYear_BeforeShow(& $sender)
{
    $GTicketMethodByYear_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTicketMethodByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End GTicketMethodByYear_BeforeShow

//Custom Code @23-2A29BDB7
// -------------------------
	if($GTicketMethodByYear->PageNumber != null){
		$PageFirstRecordNo = ($GTicketMethodByYear->PageSize * ($GTicketMethodByYear->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GTicketMethodByYear->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GTicketMethodByYear->lblNumber->SetValue($BilRekod);
	$GTicketMethodByYear->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close GTicketMethodByYear_BeforeShow @2-9E72A24F
    return $GTicketMethodByYear_BeforeShow;
}
//End Close GTicketMethodByYear_BeforeShow

//Page_AfterInitialize @1-B4CE5EE4
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrptresnote; //Compatibility
//End Page_AfterInitialize

//Custom Code @28-2A29BDB7
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
