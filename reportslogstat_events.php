<?php
// //Events @1-F81417CB

//reportslogstat_GStatLogStatus_dateopen_BeforeShow @20-18E6963D
function reportslogstat_GStatLogStatus_dateopen_BeforeShow(& $sender)
{
    $reportslogstat_GStatLogStatus_dateopen_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportslogstat; //Compatibility
//End reportslogstat_GStatLogStatus_dateopen_BeforeShow

//Custom Code @42-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close reportslogstat_GStatLogStatus_dateopen_BeforeShow @20-B13B25F3
    return $reportslogstat_GStatLogStatus_dateopen_BeforeShow;
}
//End Close reportslogstat_GStatLogStatus_dateopen_BeforeShow

//reportslogstat_GStatLogStatus_BeforeShowRow @9-8CE16E8B
function reportslogstat_GStatLogStatus_BeforeShowRow(& $sender)
{
    $reportslogstat_GStatLogStatus_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportslogstat,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End reportslogstat_GStatLogStatus_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    $reportslogstat->GStatLogStatus->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();
	
	$sql1 = "SELECT tckt_r_date FROM smart_ticket where tckt_refnumber='".$reportslogstat->GStatLogStatus->refno->GetValue()."'";
	$db->query($sql1);
	$Result1 = $db->next_record();
    if ($Result1) {
		$status1 = $db->f("tckt_r_date");
	}
	
	$sql2 = "SELECT log_date FROM smart_logstatus where log_refno='".$reportslogstat->GStatLogStatus->refno->GetValue()."' AND log_status=2";
	$db->query($sql2);
	$Result2 = $db->next_record();
    if ($Result2) {
		$status2 = $db->f("log_date");
	}

	$sql3 = "SELECT log_date FROM smart_logstatus where log_refno='".$reportslogstat->GStatLogStatus->refno->GetValue()."' AND log_status=3";
	$db->query($sql3);
	$Result3 = $db->next_record();
    if ($Result3) {
		$status3 = $db->f("log_date");
	}
	
	$sql5 = "SELECT log_date FROM smart_logstatus where log_refno='".$reportslogstat->GStatLogStatus->refno->GetValue()."' AND log_status=5";
	$db->query($sql5);
	$Result5 = $db->next_record();
    if ($Result5) {
		$status5 = $db->f("log_date");
	}

	$sql6 = "SELECT log_date FROM smart_logstatus where log_refno='".$reportslogstat->GStatLogStatus->refno->GetValue()."' AND log_status=6";
	$db->query($sql6);
	$Result6 = $db->next_record();
    if ($Result6) {
		$status6 = $db->f("log_date");
	}

	$sql7 = "SELECT tckt_c_date FROM smart_ticket where tckt_refnumber='".$reportslogstat->GStatLogStatus->refno->GetValue()."'";
	$db->query($sql7);
	$Result7 = $db->next_record();
    if ($Result7) {
		$status7 = $db->f("tckt_c_date");
	}

	if($status1!=null) $reportslogstat->GStatLogStatus->dateopen->SetValue(date("d/m/y h:i:s", strtotime($status1)));
	else $reportslogstat->GStatLogStatus->dateopen->SetValue("-");

	if($status2!=null) $reportslogstat->GStatLogStatus->dateassign->SetValue(date("d/m/y h:i:s", strtotime($status2)));
	else $reportslogstat->GStatLogStatus->dateassign->SetValue("-");

	if($status3!=null) $reportslogstat->GStatLogStatus->datereassign->SetValue(date("d/m/y h:i:s", strtotime($status3)));
	else $reportslogstat->GStatLogStatus->datereassign->SetValue("-");

	if($status5!=null) $reportslogstat->GStatLogStatus->datewip->SetValue(date("d/m/y h:i:s", strtotime($status5)));
	else $reportslogstat->GStatLogStatus->datewip->SetValue("-");

	if($status6!=null) $reportslogstat->GStatLogStatus->dateresolved->SetValue(date("d/m/y h:i:s", strtotime($status6)));
	else $reportslogstat->GStatLogStatus->dateresolved->SetValue("-");

	if($status7!=null) $reportslogstat->GStatLogStatus->dateclosed->SetValue(date("d/m/y h:i:s", strtotime($status7)));
	else $reportslogstat->GStatLogStatus->dateclosed->SetValue("-");

	$reportslogstat->GStatLogStatus->tckt_r_helpdesk->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$reportslogstat->GStatLogStatus->tckt_r_helpdesk->GetValue(),"usr_username")));
	$reportslogstat->GStatLogStatus->tckt_c_helpdesk->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$reportslogstat->GStatLogStatus->tckt_c_helpdesk->GetValue(),"usr_username")));

	$sqlEng1 = "SELECT * FROM smart_task where ticket_id='".$reportslogstat->GStatLogStatus->ticketid->GetValue()."' AND task_update=2 AND task_status=1";
	$db->query($sqlEng1);
	$ResultEng1 = $db->next_record();
    if ($ResultEng1) {
		$Eng1 = $db->f("task_currenteng");
	}
	$reportslogstat->GStatLogStatus->tckt_eng1->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$Eng1,"usr_username")));

	$sqlEng2 = "SELECT * FROM smart_task where ticket_id='".$reportslogstat->GStatLogStatus->ticketid->GetValue()."' AND task_update=3 AND task_status=1";
	$db->query($sqlEng2);
	$ResultEng2 = $db->next_record();
    if ($ResultEng2) {
		$Eng2 = $db->f("task_updatedeng");
	}
	$reportslogstat->GStatLogStatus->tckt_eng2->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$Eng2,"usr_username")));

// -------------------------
//End Custom Code

//Close reportslogstat_GStatLogStatus_BeforeShowRow @9-FD2A1A73
    return $reportslogstat_GStatLogStatus_BeforeShowRow;
}
//End Close reportslogstat_GStatLogStatus_BeforeShowRow

//reportslogstat_GStatLogStatus_BeforeShow @9-748926DF
function reportslogstat_GStatLogStatus_BeforeShow(& $sender)
{
    $reportslogstat_GStatLogStatus_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportslogstat,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End reportslogstat_GStatLogStatus_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
    if($reportslogstat->GStatLogStatus->PageNumber != null){
		$PageFirstRecordNo = ($reportslogstat->GStatLogStatus->PageSize * ($reportslogstat->GStatLogStatus->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportslogstat->GStatLogStatus->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportslogstat->GStatLogStatus->lblNumber->SetValue($BilRekod);
	$reportslogstat->GStatLogStatus->lblYear->SetValue(CCGetParam("year"));
	$reportslogstat->GStatLogStatus->lblMonth->SetValue(CCGetParam("month"));
// -------------------------
//End Custom Code

//Close reportslogstat_GStatLogStatus_BeforeShow @9-FA7BDE9E
    return $reportslogstat_GStatLogStatus_BeforeShow;
}
//End Close reportslogstat_GStatLogStatus_BeforeShow

//reportslogstat_GStatLogStatus_ds_BeforeBuildSelect @9-D4B1D6F8
function reportslogstat_GStatLogStatus_ds_BeforeBuildSelect(& $sender)
{
    $reportslogstat_GStatLogStatus_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportslogstat; //Compatibility
//End reportslogstat_GStatLogStatus_ds_BeforeBuildSelect

//Custom Code @51-2A29BDB7
// -------------------------
    if ($reportslogstat->GStatLogStatus->DataSource->Where <> "") {
    $reportslogstat->GStatLogStatus->DataSource->Where .= " AND ";
  }

  $reportslogstat->GStatLogStatus->DataSource->Where .= "MONTH(tckt_r_date)=".CCGetparam("month")." AND YEAR(tckt_r_date)=".CCGetparam("year");

// -------------------------
//End Custom Code

//Close reportslogstat_GStatLogStatus_ds_BeforeBuildSelect @9-ED214D31
    return $reportslogstat_GStatLogStatus_ds_BeforeBuildSelect;
}
//End Close reportslogstat_GStatLogStatus_ds_BeforeBuildSelect
?>
