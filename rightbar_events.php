<?php
// //Events @1-F81417CB

//rightbar_TcktSummary_BeforeShowRow @2-34BE78C7
function rightbar_TcktSummary_BeforeShowRow(& $sender)
{
    $rightbar_TcktSummary_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $rightbar, $TcktSummary, $DBSMART; //Compatibility
//End rightbar_TcktSummary_BeforeShowRow

//Custom Code @5-2A29BDB7
// -------------------------
	$DBSMART = new clsDBSMART();
	/*$countValReAssign = CCDLookUp("count(*) AS value", "smart_ticket","tckt_status=3", $DBSMART);
	$countVal = CCDLookUp("count(*) AS value", "smart_ticket","tckt_status=".$rightbar->TcktSummary->ref_value->GetValue(), $DBSMART);	
    if($rightbar->TcktSummary->ref_value->GetValue() == 2) $rightbar->TcktSummary->ref_value->SetValue("<b>".($countVal + $countValReAssign)."</b>");
	else $rightbar->TcktSummary->ref_value->SetValue("<b>".$countVal."</b>");*/


	$year = date("Y");
    $db = new clsDBSMART();

	$sql = "SELECT SUM(IF(smart_ticket.tckt_severity=1 AND smart_ticket.tckt_status='".$rightbar->TcktSummary->status->GetValue()."',1,0)) AS TicketCritical, 
			SUM(IF(smart_ticket.tckt_severity=2 AND smart_ticket.tckt_status='".$rightbar->TcktSummary->status->GetValue()."',1,0)) AS TicketMajor,
			SUM(IF(smart_ticket.tckt_severity=3 AND smart_ticket.tckt_status='".$rightbar->TcktSummary->status->GetValue()."',1,0)) AS TicketMinor, 
			SUM(IF(smart_ticket.tckt_severity=4 AND smart_ticket.tckt_status='".$rightbar->TcktSummary->status->GetValue()."',1,0)) AS TicketInfo
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".$year;
	
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$CriticalTckt = $db->f("TicketCritical");
		$MajorTickt = $db->f("TicketMajor");
		$MinorTickt = $db->f("TicketMinor");
		$InfoTickt = $db->f("TicketInfo");
	}

	if($CriticalTckt > 0) $rightbar->TcktSummary->tcktcritical->SetValue("<b>".$CriticalTckt."</b>");
	else $rightbar->TcktSummary->tcktcritical->SetValue("-");
	
	if($MajorTickt > 0) $rightbar->TcktSummary->tcktmajor->SetValue("<b>".$MajorTickt."</b>");
	else $rightbar->TcktSummary->tcktmajor->SetValue("-");

	if($MinorTickt > 0) $rightbar->TcktSummary->tcktminor->SetValue("<b>".$MinorTickt."</font></b>");
	else $rightbar->TcktSummary->tcktminor->SetValue("-");

	if($InfoTickt > 0) $rightbar->TcktSummary->tcktinfo->SetValue("<b>".$InfoTickt."</b>");
	else $rightbar->TcktSummary->tcktinfo->SetValue("-");
	
	$TotalRow = $CriticalTckt + $MajorTickt + $MinorTickt + $InfoTickt;
	$rightbar->TcktSummary->tckttotal->SetValue($TotalRow);
	
	$GTotal = $rightbar->TcktSummary->tckttotal->GetValue() + $rightbar->TcktSummary->Gtotal->GetValue();
	$rightbar->TcktSummary->Gtotal->SetValue($GTotal);

	$GTotCritical = $CriticalTckt + $rightbar->TcktSummary->totcritical->GetValue();
	$rightbar->TcktSummary->totcritical->SetValue($GTotCritical);

	$GTotMajor = $MajorTickt + $rightbar->TcktSummary->totmajor->GetValue();
	$rightbar->TcktSummary->totmajor->SetValue($GTotMajor);

	$GTotMinor = $MinorTickt + $rightbar->TcktSummary->totminor->GetValue();
	$rightbar->TcktSummary->totminor->SetValue($GTotMinor);
	
	$GTotInfo = $InfoTickt + $rightbar->TcktSummary->totinfo->GetValue();
	$rightbar->TcktSummary->totinfo->SetValue($GTotInfo);
// -------------------------
//End Custom Code

//Close rightbar_TcktSummary_BeforeShowRow @2-7171607A
    return $rightbar_TcktSummary_BeforeShowRow;
}
//End Close rightbar_TcktSummary_BeforeShowRow

//rightbar_GTask_BeforeShowRow @9-CCDF4E67
function rightbar_GTask_BeforeShowRow(& $sender)
{
    $rightbar_GTask_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $rightbar, $GTask, $DBSMART; //Compatibility
//End rightbar_GTask_BeforeShowRow

//Custom Code @17-2A29BDB7
// -------------------------
	$refnumber = CCDLookUp("tckt_refnumber", "smart_ticket","id=".$rightbar->GTask->ticket_id->GetValue(), $DBSMART);
    /*switch(CCGetSession("GroupID")) {
		case 3:
		case 4:
			$rightbar->GTask->ticket_id->SetLink("vticketdetails.php?id=".$rightbar->GTask->ticket_id->GetValue());
		break;
		case 5:
			$rightbar->GTask->ticket_id->SetLink("ticketdetails.php?id=".$rightbar->GTask->ticket_id->GetValue());
		break;
	}*/
	$rightbar->GTask->ticket_id->SetValue($refnumber);
// -------------------------
//End Custom Code

//Close rightbar_GTask_BeforeShowRow @9-BF858593
    return $rightbar_GTask_BeforeShowRow;
}
//End Close rightbar_GTask_BeforeShowRow

//rightbar_GTask_BeforeShow @9-69D77F3B
function rightbar_GTask_BeforeShow(& $sender)
{
    $rightbar_GTask_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $rightbar; //Compatibility
//End rightbar_GTask_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    //echo $rightbar->GTask->DataSource->SQL;
	//echo $rightbar->GTask->DataSource->Where;
// -------------------------
//End Custom Code

//Close rightbar_GTask_BeforeShow @9-B6AEECE4
    return $rightbar_GTask_BeforeShow;
}
//End Close rightbar_GTask_BeforeShow
?>
