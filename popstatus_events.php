<?php
//BindEvents Method @1-D2A10DD0
function BindEvents()
{
    global $smart_task;
    $smart_task->CCSEvents["BeforeShow"] = "smart_task_BeforeShow";
    $smart_task->CCSEvents["AfterInsert"] = "smart_task_AfterInsert";
}
//End BindEvents Method

//smart_task_BeforeShow @5-020263EE
function smart_task_BeforeShow(& $sender)
{
    $smart_task_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task,$DBSMART; //Compatibility
//End smart_task_BeforeShow

//Custom Code @29-2A29BDB7
// -------------------------
    $currstatus = CCDLookUp("tckt_status","smart_ticket","id=".CCGetParam("tcktid"),$DBSMART);
	$smart_task->currentstatus->SetValue(GetCodeDescription("tcktstatus",$currstatus));
	$smart_task->task_currentstatus->SetValue($currstatus);
	$smart_task->ticket_id->SetValue(CCGetParam("tcktid"));
// -------------------------
//End Custom Code

//Close smart_task_BeforeShow @5-6501638C
    return $smart_task_BeforeShow;
}
//End Close smart_task_BeforeShow

//smart_task_AfterInsert @5-11D10580
function smart_task_AfterInsert(& $sender)
{
    $smart_task_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task; //Compatibility
//End smart_task_AfterInsert

//Custom Code @31-2A29BDB7
// -------------------------
    SetStatusTicket("tckt_status",$smart_task->task_newstatus->GetValue(),$smart_task->ticket_id->GetValue());
// -------------------------
//End Custom Code

//Close smart_task_AfterInsert @5-9DC6F4A7
    return $smart_task_AfterInsert;
}
//End Close smart_task_AfterInsert


?>
