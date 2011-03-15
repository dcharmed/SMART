<?php
//BindEvents Method @1-71468130
function BindEvents()
{
    global $GSmartTicket;
    global $GSmartTask;
    global $RSmartTask;
    global $SummaryTicket;
    global $RSmartTaskView;
    global $CCSEvents;
    $GSmartTicket->CCSEvents["BeforeShowRow"] = "GSmartTicket_BeforeShowRow";
    $GSmartTicket->CCSEvents["BeforeShow"] = "GSmartTicket_BeforeShow";
    $GSmartTask->CCSEvents["BeforeShowRow"] = "GSmartTask_BeforeShowRow";
    $GSmartTask->CCSEvents["BeforeShow"] = "GSmartTask_BeforeShow";
    $RSmartTask->Button_Update->CCSEvents["OnClick"] = "RSmartTask_Button_Update_OnClick";
    $RSmartTask->CCSEvents["BeforeShow"] = "RSmartTask_BeforeShow";
    $RSmartTask->CCSEvents["AfterUpdate"] = "RSmartTask_AfterUpdate";
    $SummaryTicket->CCSEvents["BeforeShow"] = "SummaryTicket_BeforeShow";
    $RSmartTaskView->CCSEvents["BeforeShow"] = "RSmartTaskView_BeforeShow";
    $RSmartTaskView->CCSEvents["AfterUpdate"] = "RSmartTaskView_AfterUpdate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GSmartTicket_BeforeShowRow @77-BFCEBFB0
function GSmartTicket_BeforeShowRow(& $sender)
{
    $GSmartTicket_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartTicket,$BilRekod, $PageFirstRecordNo,$DBSMART; //Compatibility
//End GSmartTicket_BeforeShowRow

//Set Row Style @102-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @50-2A29BDB7
// -------------------------
    $GSmartTicket->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$dateStart = $GSmartTicket->tckt_date->GetValue();
	if($GSmartTicket->tckt_status->GetValue()<7) {
		$age = CountingPeriod(time(), $dateStart[0]);
		$GSmartTicket->tckt_age->SetValue("<font color=red><b>".$age."</b></font>");
	} else {
		$dateEnd = $GSmartTicket->tckt_closeddate->GetValue();
		$age = CountingPeriod($dateEnd[0], $dateStart[0]);
		$GSmartTicket->tckt_age->SetValue($age);
	}
	
	$GSmartTicket->tcktEng->SetValue(CCDLookUp("usr_username", "smart_user","id=".$GSmartTicket->tcktEng->GetValue(),$DBSMART));
	$GSmartTicket->tckt_helpdesk->SetValue(CCDLookUp("usr_username", "smart_user","id=".$GSmartTicket->tckt_helpdesk->GetValue(),$DBSMART));
	$GSmartTicket->tckt_status->SetValue("<b>".GetCodeDescription("tcktstatus", $GSmartTicket->tckt_status->GetValue())."</b>");
// -------------------------
//End Custom Code

//Close GSmartTicket_BeforeShowRow @77-D1A16C06
    return $GSmartTicket_BeforeShowRow;
}
//End Close GSmartTicket_BeforeShowRow

//GSmartTicket_BeforeShow @77-640970D9
function GSmartTicket_BeforeShow(& $sender)
{
    $GSmartTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartTicket,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSmartTicket_BeforeShow

//Custom Code @103-2A29BDB7
// -------------------------
    if($GSmartTicket->PageNumber != null){
		$PageFirstRecordNo = ($GSmartTicket->PageSize * ($GSmartTicket->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSmartTicket->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSmartTicket->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSmartTicket_BeforeShow @77-8394A60B
    return $GSmartTicket_BeforeShow;
}
//End Close GSmartTicket_BeforeShow

//GSmartTask_BeforeShowRow @5-0DBC2B05
function GSmartTask_BeforeShowRow(& $sender)
{
    $GSmartTask_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartTask, $DBSMART,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSmartTask_BeforeShowRow

//Set Row Style @16-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @73-2A29BDB7
// -------------------------
	$GSmartTask->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	if($GSmartTask->task_status->GetValue() < 1) {
		$GSmartTask->lblView->Visible = true;
		if($GSmartTask->task_updatedeng->GetValue()== null) {
			$GSmartTask->lblView->SetLink("taskactivity.php?det=1&tcktid=".CCGetParam("tcktid")."&tid=".$GSmartTask->task_id->GetValue()."&uid=".$GSmartTask->task_currenteng->GetValue());
		} else {
			$GSmartTask->lblView->SetLink("taskactivity.php?det=1&tcktid=".CCGetParam("tcktid")."&tid=".$GSmartTask->task_id->GetValue()."&uid=".$GSmartTask->task_updatedeng->GetValue());
		}
	} else {
		$GSmartTask->lblView->Visible = false;
	}
	$GSmartTask->tckt_severity->SetValue(GetCodeDescription('tcktseverity',$GSmartTask->tckt_severity->GetValue()));
	$GSmartTask->task_currenteng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GSmartTask->task_currenteng->GetValue(),$DBSMART));
	$GSmartTask->task_updatedeng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GSmartTask->task_updatedeng->GetValue(),$DBSMART));
	switch($GSmartTask->task_status->GetValue()) {
		case 1:
			$GSmartTask->task_status->SetValue("ACCEPTED");
		break;
		case 2: 
			$GSmartTask->task_status->SetValue("NOT ACCEPTED");
		break;
		default:
			$GSmartTask->task_status->SetValue("NO RESPOND BY ENGINEER");
		break;
	}
// -------------------------
//End Custom Code

//Close GSmartTask_BeforeShowRow @5-CE7C77C7
    return $GSmartTask_BeforeShowRow;
}
//End Close GSmartTask_BeforeShowRow

//GSmartTask_BeforeShow @5-440F535A
function GSmartTask_BeforeShow(& $sender)
{
    $GSmartTask_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartTask,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSmartTask_BeforeShow

//Custom Code @115-2A29BDB7
// -------------------------
    if($GSmartTask->PageNumber != null){
		$PageFirstRecordNo = ($GSmartTask->PageSize * ($GSmartTask->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSmartTask->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSmartTask->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSmartTask_BeforeShow @5-E79AF55C
    return $GSmartTask_BeforeShow;
}
//End Close GSmartTask_BeforeShow

//RSmartTask_Button_Update_OnClick @38-35494509
function RSmartTask_Button_Update_OnClick(& $sender)
{
    $RSmartTask_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTask; //Compatibility
//End RSmartTask_Button_Update_OnClick

//Custom Code @149-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close RSmartTask_Button_Update_OnClick @38-22311355
    return $RSmartTask_Button_Update_OnClick;
}
//End Close RSmartTask_Button_Update_OnClick

//RSmartTask_BeforeShow @36-EC035818
function RSmartTask_BeforeShow(& $sender)
{
    $RSmartTask_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTask, $DBSMART; //Compatibility
//End RSmartTask_BeforeShow

//Custom Code @58-2A29BDB7
// -------------------------
    $curreng = CCDLookUp("max(task_currenteng)","smart_task","ticket_id=".$RSmartTask->ticket_id->GetValue(),$DBSMART);
	$tcktRef = CCDLookUp("tckt_refnumber","smart_ticket","id=".$RSmartTask->ticket_id->GetValue(),$DBSMART);
	$RSmartTask->task_currenteng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$RSmartTask->task_currenteng->GetValue(),$DBSMART));
	$RSmartTask->task_neweng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$RSmartTask->task_neweng->GetValue(),$DBSMART));
	$RSmartTask->ticketRef->SetValue($tcktRef);
	
	$RSmartTask->datemodified->SetValue(date('Y-m-d H:i:s'));
	$RSmartTask->task_current->SetValue(GetCodeDescription("tcktstatus",$RSmartTask->task_current->GetValue()));
// -------------------------
//End Custom Code

//Close RSmartTask_BeforeShow @36-7DC73857
    return $RSmartTask_BeforeShow;
}
//End Close RSmartTask_BeforeShow

//RSmartTask_AfterUpdate @36-418256CD
function RSmartTask_AfterUpdate(& $sender)
{
    $RSmartTask_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTask, $DBSMART; //Compatibility
//End RSmartTask_AfterUpdate

//Custom Code @61-2A29BDB7
// -------------------------
    $dbupd = new clsDBSMART() ;
	if($RSmartTask->taskStatus->GetValue() == 1) {
	    $sqlupd = "UPDATE smart_ticket SET tckt_status = 5 WHERE id=".$RSmartTask->ticket_id->GetValue();
		$dbupd->query($sqlupd);
	} else {
		$sqlupd = "UPDATE smart_ticket SET tckt_status = 2 WHERE id=".$RSmartTask->ticket_id->GetValue();
		$dbupd->query($sqlupd);
	}
// -------------------------
//End Custom Code

//Close RSmartTask_AfterUpdate @36-43F6F82F
    return $RSmartTask_AfterUpdate;
}
//End Close RSmartTask_AfterUpdate

//SummaryTicket_BeforeShow @130-D2F81836
function SummaryTicket_BeforeShow(& $sender)
{
    $SummaryTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SummaryTicket; //Compatibility
//End SummaryTicket_BeforeShow

//Custom Code @148-2A29BDB7
// -------------------------
	$SummaryTicket->tckt_tagrelated->SetValue(GetCodeDescription($SummaryTicket->tckt_subcategory->GetValue(),$SummaryTicket->tckt_tagrelated->GetValue()));
	$SummaryTicket->tckt_subcategory->SetValue(GetCodeDescription($SummaryTicket->tckt_category->GetValue(),$SummaryTicket->tckt_subcategory->GetValue()));
    $SummaryTicket->tckt_category->SetValue(GetCodeDescription("probcat",$SummaryTicket->tckt_category->GetValue()));
	$SummaryTicket->tckt_severity->SetValue(GetCodeDescription("tcktseverity",$SummaryTicket->tckt_severity->GetValue()));
	$SummaryTicket->tckt_status->SetValue(GetCodeDescription("tcktstatus",$SummaryTicket->tckt_status->GetValue()));
// -------------------------
//End Custom Code

//Close SummaryTicket_BeforeShow @130-DFB5CC6E
    return $SummaryTicket_BeforeShow;
}
//End Close SummaryTicket_BeforeShow

//RSmartTaskView_BeforeShow @154-6D906FDF
function RSmartTaskView_BeforeShow(& $sender)
{
    $RSmartTaskView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTaskView, $DBSMART; //Compatibility
//End RSmartTaskView_BeforeShow

//Custom Code @173-2A29BDB7
// -------------------------
    $curreng = CCDLookUp("max(task_currenteng)","smart_task","ticket_id=".$RSmartTaskView->ticket_id->GetValue(),$DBSMART);
	$tcktRef = CCDLookUp("tckt_refnumber","smart_ticket","id=".$RSmartTaskView->ticket_id->GetValue(),$DBSMART);
	$RSmartTaskView->task_currenteng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$RSmartTaskView->task_currenteng->GetValue(),$DBSMART));
	$RSmartTaskView->task_neweng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$RSmartTaskView->task_neweng->GetValue(),$DBSMART));
	$RSmartTaskView->ticketRef->SetValue($tcktRef);
	
	$RSmartTaskView->datemodified->SetValue(date('Y-m-d H:i:s'));
	$RSmartTaskView->task_current->SetValue(GetCodeDescription("tcktstatus",$RSmartTaskView->task_current->GetValue()));

	switch($RSmartTaskView->taskStatus->GetValue()) {
		case 1:
			$RSmartTaskView->taskStatus->SetValue("ACCEPTED");
		break;
		case 2: 
			$RSmartTaskView->taskStatus->SetValue("NOT ACCEPTED");
		break;
		default:
			$RSmartTaskView->taskStatus->SetValue("NO RESPOND BY ENGINEER");
		break;
	}	
	
// -------------------------
//End Custom Code

//Close RSmartTaskView_BeforeShow @154-A248A15F
    return $RSmartTaskView_BeforeShow;
}
//End Close RSmartTaskView_BeforeShow

//RSmartTaskView_AfterUpdate @154-8A5FD65C
function RSmartTaskView_AfterUpdate(& $sender)
{
    $RSmartTaskView_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTaskView; //Compatibility
//End RSmartTaskView_AfterUpdate

//Custom Code @174-2A29BDB7
// -------------------------
    $dbupd = new clsDBSMART() ;
	if($RSmartTask->taskStatus->GetValue() == 1) {
	    $sqlupd = "UPDATE smart_ticket SET tckt_status = 5 WHERE id=".$RSmartTask->ticket_id->GetValue();
		$dbupd->query($sqlupd);
	} else {
		$sqlupd = "UPDATE smart_ticket SET tckt_status = 2 WHERE id=".$RSmartTask->ticket_id->GetValue();
		$dbupd->query($sqlupd);
	}
// -------------------------
//End Custom Code

//Close RSmartTaskView_AfterUpdate @154-4DF2FF84
    return $RSmartTaskView_AfterUpdate;
}
//End Close RSmartTaskView_AfterUpdate

//Page_AfterInitialize @1-C8409C24
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $taskactivity, $GSmartTicket, $GSmartTask, $RSmartTask, $RSmartTaskView, $SummaryTicket; //Compatibility
//End Page_AfterInitialize

//Custom Code @110-2A29BDB7
// -------------------------
    $GSmartTask->Visible = false;
	$RSmartTask->Visible = false;
	$RSmartTaskView->Visible = false;
	$SummaryTicket->Visible = false;
	if(CCGetParam("tcktid")!=null && CCGetParam("tid")==null) {
		$GSmartTicket->Visible = false;
		$GSmartTask->Visible = true;
		$SummaryTicket->Visible = true;
	} elseif(CCGetParam("tcktid")!=null && CCGetParam("tid")!=null && CCGetParam("uid")!=null) {
		if(CCGetSession("UserID")==CCGetParam("uid") || CCGetSession("GroupID")==5) {
			$RSmartTask->Visible = true;
			$GSmartTicket->Visible = false;
			$GSmartTask->Visible = true;
		} else {
			$RSmartTask->Visible = false;
			$GSmartTicket->Visible = false;
			$RSmartTaskView->Visible = true;
			$GSmartTask->Visible = true;
		}
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
