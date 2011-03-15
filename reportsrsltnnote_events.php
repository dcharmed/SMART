<?php
// //Events @1-F81417CB

//reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow @26-93E274F4
function reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow(& $sender)
{
    $reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsrsltnnote; //Compatibility
//End reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow

//Hide-Show Component @27-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow @26-DB80B534
    return $reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow;
}
//End Close reportsrsltnnote_smart_ticket_smart_resolu_Navigator_BeforeShow


?>
