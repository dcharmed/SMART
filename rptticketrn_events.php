<?php
// //Events @1-F81417CB

//rptticketrn_RepTickets_Navigator_BeforeShow @29-79FCC6B9
function rptticketrn_RepTickets_Navigator_BeforeShow(& $sender)
{
    $rptticketrn_RepTickets_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $rptticketrn; //Compatibility
//End rptticketrn_RepTickets_Navigator_BeforeShow

//Hide-Show Component @30-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close rptticketrn_RepTickets_Navigator_BeforeShow @29-86A84DB3
    return $rptticketrn_RepTickets_Navigator_BeforeShow;
}
//End Close rptticketrn_RepTickets_Navigator_BeforeShow


?>
