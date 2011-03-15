<?php
//BindEvents Method @1-39036E68
function BindEvents()
{
    global $smart_ticket;
    $smart_ticket->CCSEvents["BeforeShowRow"] = "smart_ticket_BeforeShowRow";
    $smart_ticket->CCSEvents["BeforeShow"] = "smart_ticket_BeforeShow";
}
//End BindEvents Method

//smart_ticket_BeforeShowRow @10-1631B8A7
function smart_ticket_BeforeShowRow(& $sender)
{
    $smart_ticket_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End smart_ticket_BeforeShowRow

//Set Row Style @21-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @33-2A29BDB7
// -------------------------
    $smart_ticket->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	$dateStart = $smart_ticket->tckt_r_date->GetValue();
	$age = CountingPeriod(time(), $dateStart[0]);
	$smart_ticket->tckt_age->SetValue("<b>".$age."</b>");	
	$smart_ticket->tckt_r_helpdesk->SetValue(CCDLookUp("usr_username","smart_user","id=".$smart_ticket->tckt_r_helpdesk->GetValue(),$DBSMART));
	switch(CCGetSession("GroupID")) {
		case 1: 
		case 5:
			$smart_ticket->tckt_refnumber->SetLink("ticketdetails.php?id=".$smart_ticket->id->GetValue());
		break;
		default: 
			$smart_ticket->tckt_refnumber->SetLink("vticketdetails.php?id=".$smart_ticket->id->GetValue());
		break;
	}
	$smart_ticket->tckt_status->SetValue(GetCodeDescription("tcktstatus", $smart_ticket->tckt_status->GetValue()));
	$smart_ticket->tckt_severity->SetValue(GetCodeDescription("tcktseverity", $smart_ticket->tckt_severity->GetValue()));
// -------------------------
//End Custom Code

//Close smart_ticket_BeforeShowRow @10-388C00FF
    return $smart_ticket_BeforeShowRow;
}
//End Close smart_ticket_BeforeShowRow

//smart_ticket_BeforeShow @10-5C5B41F4
function smart_ticket_BeforeShow(& $sender)
{
    $smart_ticket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket,$BilRekod, $PageFirstRecordNo; //Compatibility
//End smart_ticket_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
    if($smart_ticket->PageNumber != null){
		$PageFirstRecordNo = ($smart_ticket->PageSize * ($smart_ticket->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($smart_ticket->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$smart_ticket->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close smart_ticket_BeforeShow @10-1BC0D7FE
    return $smart_ticket_BeforeShow;
}
//End Close smart_ticket_BeforeShow


?>
