<?php
// //Events @1-F81417CB

//statresnote_Report_Print1_BeforeShow @25-08B6F344
function statresnote_Report_Print1_BeforeShow(& $sender)
{
    $statresnote_Report_Print1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $statresnote; //Compatibility
//End statresnote_Report_Print1_BeforeShow

//Hide-Show Component @27-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close statresnote_Report_Print1_BeforeShow @25-CA01B51F
    return $statresnote_Report_Print1_BeforeShow;
}
//End Close statresnote_Report_Print1_BeforeShow

//statresnote_GTicketMethodByYear_BeforeShowRow @71-D681CA04
function statresnote_GTicketMethodByYear_BeforeShowRow(& $sender)
{
    $statresnote_GTicketMethodByYear_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $statresnote,$GTicketMethodByYear,$BilRekod, $PageFirstRecordNo; //Compatibility
//End statresnote_GTicketMethodByYear_BeforeShowRow

//Custom Code @98-2A29BDB7
// -------------------------
	$statresnote->GTicketMethodByYear->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
    $year = CCGetParam("year");
    $db = new clsDBSMART();

	
	$sql = "SELECT SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=1 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJan, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=2 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketFeb,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=3 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMac, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=4 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketApr,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=5 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketMei, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=6 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJune,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=7 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketJuly, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=8 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketAug,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=9 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketSept, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=10 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketOct,
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=11 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketNov, 
			SUM(IF(MONTH(smart_resolutionnote.rsltn_date)=12 AND smart_resolutionnote.rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ref_value->GetValue().",1,0)) AS TicketDec 
			FROM smart_resolutionnote 
			WHERE YEAR(smart_resolutionnote.rsltn_date) = ".$year;
	
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
	
	if($JanTickt > 0) $statresnote->GTicketMethodByYear->JanTic->SetValue($JanTickt);
	else $statresnote->GTicketMethodByYear->JanTic->SetValue("-");

	if($FebTickt > 0) $statresnote->GTicketMethodByYear->FebTic->SetValue($FebTickt);
	else $statresnote->GTicketMethodByYear->FebTic->SetValue("-");

	if($MacTickt > 0) $statresnote->GTicketMethodByYear->MacTic->SetValue($MacTickt);
	else $statresnote->GTicketMethodByYear->MacTic->SetValue("-");

	if($AprTickt > 0) $statresnote->GTicketMethodByYear->AprTic->SetValue($AprTickt);
	else $statresnote->GTicketMethodByYear->AprTic->SetValue("-");

	if($MeiTickt > 0) $statresnote->GTicketMethodByYear->MeiTic->SetValue($MeiTickt);
	else $statresnote->GTicketMethodByYear->MeiTic->SetValue("-");

	if($JuneTickt > 0) $statresnote->GTicketMethodByYear->JuneTic->SetValue($JuneTickt);
	else $statresnote->GTicketMethodByYear->JuneTic->SetValue("-");

	if($JulyTickt > 0) $statresnote->GTicketMethodByYear->JulyTic->SetValue($JulyTickt);
	else $statresnote->GTicketMethodByYear->JulyTic->SetValue("-");

	if($AugTickt > 0) $statresnote->GTicketMethodByYear->AugTic->SetValue($AugTickt);
	else $statresnote->GTicketMethodByYear->AugTic->SetValue("-");

	if($SeptTickt > 0) $statresnote->GTicketMethodByYear->SeptTic->SetValue($SeptTickt);
	else $statresnote->GTicketMethodByYear->SeptTic->SetValue("-");

	if($OctTickt > 0) $statresnote->GTicketMethodByYear->OctTic->SetValue($OctTickt);
	else $statresnote->GTicketMethodByYear->OctTic->SetValue("-");

	if($NovTic > 0) $statresnote->GTicketMethodByYear->NovTic->SetValue($NovTickt);
	else $statresnote->GTicketMethodByYear->NovTic->SetValue("-");

	if($DecTickt > 0) $statresnote->GTicketMethodByYear->DecTic->SetValue($DecTickt);
	else $statresnote->GTicketMethodByYear->DecTic->SetValue("-");

	$TotalRow = $JanTickt + $FebTickt + $MacTickt +$AprTickt + $MeiTickt + $JuneTickt + $JulyTickt + $AugTickt + $SeptTickt + $OctTickt + $NovTickt + $DecTickt;
	$statresnote->GTicketMethodByYear->TicMonth->SetValue($TotalRow);
	$GTotal = $statresnote->GTicketMethodByYear->TicMonth->GetValue() + $statresnote->GTicketMethodByYear->GrandTotal->GetValue();
	$statresnote->GTicketMethodByYear->GrandTotal->SetValue($GTotal);
// -------------------------
//End Custom Code

//Close statresnote_GTicketMethodByYear_BeforeShowRow @71-B6F45E70
    return $statresnote_GTicketMethodByYear_BeforeShowRow;
}
//End Close statresnote_GTicketMethodByYear_BeforeShowRow

//statresnote_GTicketMethodByYear_ds_BeforeBuildSelect @71-184CACFD
function statresnote_GTicketMethodByYear_ds_BeforeBuildSelect(& $sender)
{
    $statresnote_GTicketMethodByYear_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $statresnote; //Compatibility
//End statresnote_GTicketMethodByYear_ds_BeforeBuildSelect

//Custom Code @110-2A29BDB7
// -------------------------
    //$statresnote->GTicketMethodByYear->DataSource->Where .= " AND rsltn_actionmethod=".$statresnote->GTicketMethodByYear->ds->ref_value->GetValue();
	
// -------------------------
//End Custom Code

//Close statresnote_GTicketMethodByYear_ds_BeforeBuildSelect @71-32D001D2
    return $statresnote_GTicketMethodByYear_ds_BeforeBuildSelect;
}
//End Close statresnote_GTicketMethodByYear_ds_BeforeBuildSelect

//statresnote_GTicketMethodByYear_BeforeShow @71-CEB6282A
function statresnote_GTicketMethodByYear_BeforeShow(& $sender)
{
    $statresnote_GTicketMethodByYear_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $statresnote, $GTicketMethodByYear, $BilRekod, $PageFirstRecordNo; //Compatibility
//End statresnote_GTicketMethodByYear_BeforeShow

//Custom Code @112-2A29BDB7
// -------------------------
	if($statresnote->GTicketMethodByYear->PageNumber != null){
		$PageFirstRecordNo = ($statresnote->GTicketMethodByYear->PageSize * ($statresnote->GTicketMethodByYear->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($statresnote->GTicketMethodByYear->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$statresnote->GTicketMethodByYear->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close statresnote_GTicketMethodByYear_BeforeShow @71-091DF10E
    return $statresnote_GTicketMethodByYear_BeforeShow;
}
//End Close statresnote_GTicketMethodByYear_BeforeShow

//statresnote_AfterInitialize @1-8F28B489
function statresnote_AfterInitialize(& $sender)
{
    $statresnote_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $statresnote; //Compatibility
//End statresnote_AfterInitialize

//Custom Code @54-2A29BDB7
// -------------------------
    if(CCGetParam("month")==null && CCGetParam("year")!=null) {
		$statresnote->GTicketMethodByYear->Visible = true;
		$statresnote->Report_Print1->Visible = true;
	} 
// -------------------------
//End Custom Code

//Close statresnote_AfterInitialize @1-D5C979C5
    return $statresnote_AfterInitialize;
}
//End Close statresnote_AfterInitialize
?>
