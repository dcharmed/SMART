<?php
// //Events @1-F81417CB

//rightbar_TcktSummary_BeforeShowRow @2-34BE78C7
function rightbar_TcktSummary_BeforeShowRow(& $sender)
{
    $rightbar_TcktSummary_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $rightbar, $TcktSummary; //Compatibility
//End rightbar_TcktSummary_BeforeShowRow

//Custom Code @5-2A29BDB7
// -------------------------
	$DBSMART = new clsDBSMART();
	$countVal = CCDLookUp("count(*) AS value", "smart_ticket","tckt_status=".$rightbar->TcktSummary->ref_value->GetValue(), $DBSMART);	
    $rightbar->TcktSummary->ref_value->SetValue("<b>".$countVal."</b>");
// -------------------------
//End Custom Code

//Close rightbar_TcktSummary_BeforeShowRow @2-7171607A
    return $rightbar_TcktSummary_BeforeShowRow;
}
//End Close rightbar_TcktSummary_BeforeShowRow
?>
