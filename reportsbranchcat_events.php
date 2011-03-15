<?php
// //Events @1-F81417CB

//reportsbranchcat_GReportBranchCat_BeforeShow @51-051919BE
function reportsbranchcat_GReportBranchCat_BeforeShow(& $sender)
{
    $reportsbranchcat_GReportBranchCat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranchcat, $GReportBranchCat, $BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsbranchcat_GReportBranchCat_BeforeShow

//Custom Code @78-2A29BDB7
// -------------------------
    if($reportsbranchcat->GReportBranchCat->PageNumber != null){
		$PageFirstRecordNo = ($reportsbranchcat->GReportBranchCat->PageSize * ($reportsbranchcat->GReportBranchCat->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportsbranchcat->GReportBranchCat->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportsbranchcat->GReportBranchCat->lblNumber->SetValue($BilRekod);
	$reportsbranchcat->GReportBranchCat->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close reportsbranchcat_GReportBranchCat_BeforeShow @51-77D78F4F
    return $reportsbranchcat_GReportBranchCat_BeforeShow;
}
//End Close reportsbranchcat_GReportBranchCat_BeforeShow

//reportsbranchcat_GReportBranchCat_BeforeShowRow @51-B968F161
function reportsbranchcat_GReportBranchCat_BeforeShowRow(& $sender)
{
    $reportsbranchcat_GReportBranchCat_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranchcat,$GReportBranchCat,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportsbranchcat_GReportBranchCat_BeforeShowRow

//Custom Code @79-2A29BDB7
// -------------------------
    $reportsbranchcat->GReportBranchCat->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();

	
	$sql = "SELECT SUM(IF(smart_ticket.tckt_category='01' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketBook, 
			SUM(IF(smart_ticket.tckt_category='02' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketHardware,
			SUM(IF(smart_ticket.tckt_category='03' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketSoftware, 
			SUM(IF(smart_ticket.tckt_category='04' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketNetwork,
			SUM(IF(smart_ticket.tckt_category='05' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketApplication, 
			SUM(IF(smart_ticket.tckt_category='06' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketDongle,
			SUM(IF(smart_ticket.tckt_category='07' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketOffeq, 
			SUM(IF(smart_ticket.tckt_category='08' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketCctv,
			SUM(IF(smart_ticket.tckt_category='09' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketAccdoor, 
			SUM(IF(smart_ticket.tckt_category='10' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketChip,
			SUM(IF(smart_ticket.tckt_category='11' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketIriseq, 
			SUM(IF(smart_ticket.tckt_category='12' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketUser,
			SUM(IF(smart_ticket.tckt_category='13' AND smart_ticket.tckt_site='".$reportsbranchcat->GReportBranchCat->val->GetValue()."',1,0)) AS TicketAdukom 
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".$year;
	
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$BookTickt = $db->f("TicketBook");
		$HardwareTickt = $db->f("TicketHardware");
		$SoftwareTickt = $db->f("TicketSoftware");
		$NetworkTickt = $db->f("TicketNetwork");
		$ApplicationTickt = $db->f("TicketApplication");
		$DongleTickt = $db->f("TicketDongle");
		$OffeqTickt = $db->f("TicketOffeq");
		$CctvTickt = $db->f("TicketCctv");
		$AccdoorTickt = $db->f("TicketAccdoor");
		$ChipTickt = $db->f("TicketChip");
		$IriseqTickt = $db->f("TicketIriseq");
		$UserTickt = $db->f("TicketUser");
		$AdukomTickt = $db->f("TicketAdukom");
	}
	if($BookTickt > 0) $reportsbranchcat->GReportBranchCat->numbook->SetValue("<b><font color=green size=3>".$BookTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numbook->SetValue("-");
	
	if($HardwareTickt > 0) $reportsbranchcat->GReportBranchCat->numhardware->SetValue("<b><font color=green size=3>".$HardwareTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numhardware->SetValue("-");

	if($SoftwareTickt > 0) $reportsbranchcat->GReportBranchCat->numsoftware->SetValue("<b><font color=green size=3>".$SoftwareTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numsoftware->SetValue("-");

	if($NetworkTickt > 0) $reportsbranchcat->GReportBranchCat->numnetwork->SetValue("<b><font color=green size=3>".$NetworkTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numnetwork->SetValue("-");

	if($ApplicationTickt > 0) $reportsbranchcat->GReportBranchCat->numapplication->SetValue("<b><font color=green size=3>".$ApplicationTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numapplication->SetValue("-");

	if ($DongleTickt > 0) $reportsbranchcat->GReportBranchCat->numdongle->SetValue("<b><font color=green size=3>".$DongleTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numdongle->SetValue("-");
	
	if($OffeqTickt > 0) $reportsbranchcat->GReportBranchCat->numofficeeq->SetValue("<b><font color=green size=3>".$OffeqTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numofficeeq->SetValue("-");

	if($CctvTickt > 0) $reportsbranchcat->GReportBranchCat->numcctv->SetValue("<b><font color=green size=3>".$CctvTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numcctv->SetValue("-");

	if($AccdoorTickt > 0) $reportsbranchcat->GReportBranchCat->numaccdoor->SetValue("<b><font color=green size=3>".$AccdoorTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numaccdoor->SetValue("-");

	if($ChipTickt > 0) $reportsbranchcat->GReportBranchCat->numchip->SetValue("<b><font color=green size=3>".$ChipTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numchip->SetValue("-");

	if($IriseqTickt > 0) $reportsbranchcat->GReportBranchCat->numiriseq->SetValue("<b><font color=green size=3>".$IriseqTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numiriseq->SetValue("-");

	if($UserTickt > 0) $reportsbranchcat->GReportBranchCat->numuser->SetValue("<b><font color=green size=3>".$UserTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numuser->SetValue("-");

	if($AdukomTickt > 0) $reportsbranchcat->GReportBranchCat->numadukom->SetValue("<b><font color=green size=3>".$AdukomTickt."</font></b>");
	else $reportsbranchcat->GReportBranchCat->numadukom->SetValue("-");

	$TotalRow = $BookTickt + $HardwareTickt + $SoftwareTickt +$NetworkTickt + $ApplicationTickt + $DongleTickt + $OffeqTickt + $CctvTickt + $AccdoorTickt + $ChipTickt + $IriseqTickt + $UserTickt + $AdukomTickt;
	$reportsbranchcat->GReportBranchCat->totticket->SetValue($TotalRow);

	$GTotalBook = $BookTickt + $reportsbranchcat->GReportBranchCat->GBookTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GBookTotal->SetValue($GTotalBook);

	$GTotalSoftware = $SoftwareTickt + $reportsbranchcat->GReportBranchCat->GSoftwareTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GSoftwareTotal->SetValue($GTotalSoftware);

	$GTotalNetwork = $NetworkTickt + $reportsbranchcat->GReportBranchCat->GNetworkTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GNetworkTotal->SetValue($GTotalNetwork);

	$GTotalHardware = $HardwareTickt + $reportsbranchcat->GReportBranchCat->GHardwareTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GHardwareTotal->SetValue($GTotalHardware);

	$GTotalApplication = $ApplicationTickt + $reportsbranchcat->GReportBranchCat->GApplicationTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GApplicationTotal->SetValue($GTotalApplication);

	$GTotalDongle = $DongleTickt + $reportsbranchcat->GReportBranchCat->GDongleTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GDongleTotal->SetValue($GTotalDongle);

	$GTotalOffEq = $OffeqTickt + $reportsbranchcat->GReportBranchCat->GOffEqTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GOffEqTotal->SetValue($GTotalOffEq);

	$GTotalCctv = $CctvTickt + $reportsbranchcat->GReportBranchCat->GCctvTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GCctvTotal->SetValue($GTotalCctv);

	$GTotalAccDoor = $AccdoorTickt + $reportsbranchcat->GReportBranchCat->GAccDoorTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GAccDoorTotal->SetValue($GTotalAccDoor);

	$GTotalChip = $ChipTickt + $reportsbranchcat->GReportBranchCat->GChipTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GChipTotal->SetValue($GTotalChip);

	$GTotalIriseq = $IriseqTickt + $reportsbranchcat->GReportBranchCat->GIrisEqTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GIrisEqTotal->SetValue($GTotalIriseq);

	$GTotalUser = $UserTickt + $reportsbranchcat->GReportBranchCat->GUserTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GUserTotal->SetValue($GTotalUser);

	$GTotalAdukom = $AdukomTickt + $reportsbranchcat->GReportBranchCat->GAdukomTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GAdukomTotal->SetValue($GTotalAdukom);

	$GTotal = $reportsbranchcat->GReportBranchCat->totticket->GetValue() + $reportsbranchcat->GReportBranchCat->GrandTotal->GetValue();
	$reportsbranchcat->GReportBranchCat->GrandTotal->SetValue($GTotal);
// -------------------------
//End Custom Code

//Close reportsbranchcat_GReportBranchCat_BeforeShowRow @51-0DA1C62F
    return $reportsbranchcat_GReportBranchCat_BeforeShowRow;
}
//End Close reportsbranchcat_GReportBranchCat_BeforeShowRow

//reportsbranchcat_AfterInitialize @1-513C1A86
function reportsbranchcat_AfterInitialize(& $sender)
{
    $reportsbranchcat_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsbranchcat; //Compatibility
//End reportsbranchcat_AfterInitialize

//Custom Code @50-2A29BDB7
// -------------------------
  
// -------------------------
//End Custom Code

//Close reportsbranchcat_AfterInitialize @1-105D0DEA
    return $reportsbranchcat_AfterInitialize;
}
//End Close reportsbranchcat_AfterInitialize
?>
