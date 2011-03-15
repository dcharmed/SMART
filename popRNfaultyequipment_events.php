<?php
//BindEvents Method @1-C6788889
function BindEvents()
{
    global $smart_faultyequipment;
    $smart_faultyequipment->CCSEvents["BeforeShow"] = "smart_faultyequipment_BeforeShow";
}
//End BindEvents Method

//smart_faultyequipment_BeforeShow @5-0BA5AC11
function smart_faultyequipment_BeforeShow(& $sender)
{
    $smart_faultyequipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_faultyequipment; //Compatibility
//End smart_faultyequipment_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------
	$smart_faultyequipment->resolution_id->SetValue(CCGetParam("rid"));
// -------------------------
//End Custom Code

//Close smart_faultyequipment_BeforeShow @5-FB5BBE40
    return $smart_faultyequipment_BeforeShow;
}
//End Close smart_faultyequipment_BeforeShow


?>
