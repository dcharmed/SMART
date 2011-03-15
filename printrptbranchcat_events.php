<?php
//BindEvents Method @1-5DC2D9EE
function BindEvents()
{
    global $GReportBranchCat;
    global $CCSEvents;
    $GReportBranchCat->CCSEvents["BeforeShow"] = "GReportBranchCat_BeforeShow";
    $GReportBranchCat->CCSEvents["BeforeShowRow"] = "GReportBranchCat_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GReportBranchCat_BeforeShow @2-8F40C18C
function GReportBranchCat_BeforeShow(& $sender)
{
    $GReportBranchCat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReportBranchCat,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GReportBranchCat_BeforeShow

//Custom Code @21-2A29BDB7
// -------------------------
    if($GReportBranchCat->PageNumber != null){
		$PageFirstRecordNo = ($GReportBranchCat->PageSize * ($GReportBranchCat->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GReportBranchCat->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GReportBranchCat->lblNumber->SetValue($BilRekod);
	$GReportBranchCat->lblYear->SetValue(CCGetParam("year"));
// -------------------------
//End Custom Code

//Close GReportBranchCat_BeforeShow @2-8AB584C8
    return $GReportBranchCat_BeforeShow;
}
//End Close GReportBranchCat_BeforeShow

//GReportBranchCat_BeforeShowRow @2-4C6EE3DD
function GReportBranchCat_BeforeShowRow(& $sender)
{
    $GReportBranchCat_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReportBranchCat,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GReportBranchCat_BeforeShowRow

//Custom Code @22-2A29BDB7
// -------------------------
    $GReportBranchCat->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();
	
	$sql = "SELECT SUM(IF(smart_ticket.tckt_category='01' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketBook, 
			SUM(IF(smart_ticket.tckt_category='02' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketHardware,
			SUM(IF(smart_ticket.tckt_category='03' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketSoftware, 
			SUM(IF(smart_ticket.tckt_category='04' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketNetwork,
			SUM(IF(smart_ticket.tckt_category='05' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketApplication, 
			SUM(IF(smart_ticket.tckt_category='06' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketDongle,
			SUM(IF(smart_ticket.tckt_category='07' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketOffeq, 
			SUM(IF(smart_ticket.tckt_category='08' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketCctv,
			SUM(IF(smart_ticket.tckt_category='09' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketAccdoor, 
			SUM(IF(smart_ticket.tckt_category='10' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketChip,
			SUM(IF(smart_ticket.tckt_category='11' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketIriseq, 
			SUM(IF(smart_ticket.tckt_category='12' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketUser,
			SUM(IF(smart_ticket.tckt_category='13' AND smart_ticket.tckt_site='".$GReportBranchCat->val->GetValue()."',1,0)) AS TicketAdukom 
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
	if($BookTickt > 0) $GReportBranchCat->numbook->SetValue("<b><font color=green size=3>".$BookTickt."</font></b>");
	else $GReportBranchCat->numbook->SetValue("-");
	
	if($HardwareTickt > 0) $GReportBranchCat->numhardware->SetValue("<b><font color=green size=3>".$HardwareTickt."</font></b>");
	else $GReportBranchCat->numhardware->SetValue("-");

	if($SoftwareTickt > 0) $GReportBranchCat->numsoftware->SetValue("<b><font color=green size=3>".$SoftwareTickt."</font></b>");
	else $GReportBranchCat->numsoftware->SetValue("-");

	if($NetworkTickt > 0) $GReportBranchCat->numnetwork->SetValue("<b><font color=green size=3>".$NetworkTickt."</font></b>");
	else $GReportBranchCat->numnetwork->SetValue("-");

	if($ApplicationTickt > 0) $GReportBranchCat->numapplication->SetValue("<b><font color=green size=3>".$ApplicationTickt."</font></b>");
	else $GReportBranchCat->numapplication->SetValue("-");

	if ($DongleTickt > 0) $GReportBranchCat->numdongle->SetValue("<b><font color=green size=3>".$DongleTickt."</font></b>");
	else $GReportBranchCat->numdongle->SetValue("-");
	
	if($OffeqTickt > 0) $GReportBranchCat->numofficeeq->SetValue("<b><font color=green size=3>".$OffeqTickt."</font></b>");
	else $GReportBranchCat->numofficeeq->SetValue("-");

	if($CctvTickt > 0) $GReportBranchCat->numcctv->SetValue("<b><font color=green size=3>".$CctvTickt."</font></b>");
	else $GReportBranchCat->numcctv->SetValue("-");

	if($AccdoorTickt > 0) $GReportBranchCat->numaccdoor->SetValue("<b><font color=green size=3>".$AccdoorTickt."</font></b>");
	else $GReportBranchCat->numaccdoor->SetValue("-");

	if($ChipTickt > 0) $GReportBranchCat->numchip->SetValue("<b><font color=green size=3>".$ChipTickt."</font></b>");
	else $GReportBranchCat->numchip->SetValue("-");

	if($IriseqTickt > 0) $GReportBranchCat->numiriseq->SetValue("<b><font color=green size=3>".$IriseqTickt."</font></b>");
	else $GReportBranchCat->numiriseq->SetValue("-");

	if($UserTickt > 0) $GReportBranchCat->numuser->SetValue("<b><font color=green size=3>".$UserTickt."</font></b>");
	else $GReportBranchCat->numuser->SetValue("-");

	if($AdukomTickt > 0) $GReportBranchCat->numadukom->SetValue("<b><font color=green size=3>".$AdukomTickt."</font></b>");
	else $GReportBranchCat->numadukom->SetValue("-");

	$TotalRow = $BookTickt + $HardwareTickt + $SoftwareTickt +$NetworkTickt + $ApplicationTickt + $DongleTickt + $OffeqTickt + $CctvTickt + $AccdoorTickt + $ChipTickt + $IriseqTickt + $UserTickt + $AdukomTickt;
	$GReportBranchCat->totticket->SetValue($TotalRow);

	$GTotalBook = $BookTickt + $GReportBranchCat->GBookTotal->GetValue();
	$GReportBranchCat->GBookTotal->SetValue($GTotalBook);

	$GTotalSoftware = $SoftwareTickt + $GReportBranchCat->GSoftwareTotal->GetValue();
	$GReportBranchCat->GSoftwareTotal->SetValue($GTotalSoftware);

	$GTotalNetwork = $NetworkTickt + $GReportBranchCat->GNetworkTotal->GetValue();
	$GReportBranchCat->GNetworkTotal->SetValue($GTotalNetwork);

	$GTotalHardware = $HardwareTickt + $GReportBranchCat->GHardwareTotal->GetValue();
	$GReportBranchCat->GHardwareTotal->SetValue($GTotalHardware);

	$GTotalApplication = $ApplicationTickt + $GReportBranchCat->GApplicationTotal->GetValue();
	$GReportBranchCat->GApplicationTotal->SetValue($GTotalApplication);

	$GTotalDongle = $DongleTickt + $GReportBranchCat->GDongleTotal->GetValue();
	$GReportBranchCat->GDongleTotal->SetValue($GTotalDongle);

	$GTotalOffEq = $OffeqTickt + $GReportBranchCat->GOffEqTotal->GetValue();
	$GReportBranchCat->GOffEqTotal->SetValue($GTotalOffEq);

	$GTotalCctv = $CctvTickt + $GReportBranchCat->GCctvTotal->GetValue();
	$GReportBranchCat->GCctvTotal->SetValue($GTotalCctv);

	$GTotalAccDoor = $AccdoorTickt + $GReportBranchCat->GAccDoorTotal->GetValue();
	$GReportBranchCat->GAccDoorTotal->SetValue($GTotalAccDoor);

	$GTotalChip = $ChipTickt + $GReportBranchCat->GChipTotal->GetValue();
	$GReportBranchCat->GChipTotal->SetValue($GTotalChip);

	$GTotalIriseq = $IriseqTickt + $GReportBranchCat->GIrisEqTotal->GetValue();
	$GReportBranchCat->GIrisEqTotal->SetValue($GTotalIriseq);

	$GTotalUser = $UserTickt + $GReportBranchCat->GUserTotal->GetValue();
	$GReportBranchCat->GUserTotal->SetValue($GTotalUser);

	$GTotalAdukom = $AdukomTickt + $GReportBranchCat->GAdukomTotal->GetValue();
	$GReportBranchCat->GAdukomTotal->SetValue($GTotalAdukom);

	$GTotal = $GReportBranchCat->totticket->GetValue() + $GReportBranchCat->GrandTotal->GetValue();
	$GReportBranchCat->GrandTotal->SetValue($GTotal);
// -------------------------
//End Custom Code

//Close GReportBranchCat_BeforeShowRow @2-A9931268
    return $GReportBranchCat_BeforeShowRow;
}
//End Close GReportBranchCat_BeforeShowRow

//Page_AfterInitialize @1-7D0F7BEB
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrptbranchcat; //Compatibility
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
