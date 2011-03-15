<?php
//BindEvents Method @1-4C5B09DC
function BindEvents()
{
    global $RepTickets;
    $RepTickets->Navigator->CCSEvents["BeforeShow"] = "RepTickets_Navigator_BeforeShow";
}
//End BindEvents Method

//RepTickets_Navigator_BeforeShow @35-2339B1D2
function RepTickets_Navigator_BeforeShow(& $sender)
{
    $RepTickets_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RepTickets; //Compatibility
//End RepTickets_Navigator_BeforeShow

//Hide-Show Component @54-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close RepTickets_Navigator_BeforeShow @35-DB161DCB
    return $RepTickets_Navigator_BeforeShow;
}
//End Close RepTickets_Navigator_BeforeShow
?>
