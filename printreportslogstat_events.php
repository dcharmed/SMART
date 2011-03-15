<?php
//BindEvents Method @1-6D5CEE94
function BindEvents()
{
    global $GStatLogStatus;
    global $CCSEvents;
    $GStatLogStatus->dateopen->CCSEvents["BeforeShow"] = "GStatLogStatus_dateopen_BeforeShow";
    $GStatLogStatus->CCSEvents["BeforeShowRow"] = "GStatLogStatus_BeforeShowRow";
    $GStatLogStatus->CCSEvents["BeforeShow"] = "GStatLogStatus_BeforeShow";
    $GStatLogStatus->ds->CCSEvents["BeforeBuildSelect"] = "GStatLogStatus_ds_BeforeBuildSelect";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GStatLogStatus_dateopen_BeforeShow @5-3CF1CEAB
function GStatLogStatus_dateopen_BeforeShow(& $sender)
{
    $GStatLogStatus_dateopen_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatLogStatus; //Compatibility
//End GStatLogStatus_dateopen_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close GStatLogStatus_dateopen_BeforeShow @5-DB527A7F
    return $GStatLogStatus_dateopen_BeforeShow;
}
//End Close GStatLogStatus_dateopen_BeforeShow

//GStatLogStatus_BeforeShowRow @2-0E654C60
function GStatLogStatus_BeforeShowRow(& $sender)
{
    $GStatLogStatus_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatLogStatus,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GStatLogStatus_BeforeShowRow

//Custom Code @14-2A29BDB7
// -------------------------
    $GStatLogStatus->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

    $year = CCGetParam("year");
    $db = new clsDBSMART();
	
	$sql1 = "SELECT tckt_r_date FROM smart_ticket where tckt_refnumber='".$GStatLogStatus->refno->GetValue()."'";
	$db->query($sql1);
	$Result1 = $db->next_record();
    if ($Result1) {
		$status1 = $db->f("tckt_r_date");
	}
	
	$sql2 = "SELECT log_date FROM smart_logstatus where log_refno='".$GStatLogStatus->refno->GetValue()."' AND log_status=2";
	$db->query($sql2);
	$Result2 = $db->next_record();
    if ($Result2) {
		$status2 = $db->f("log_date");
	}

	$sql3 = "SELECT log_date FROM smart_logstatus where log_refno='".$GStatLogStatus->refno->GetValue()."' AND log_status=3";
	$db->query($sql3);
	$Result3 = $db->next_record();
    if ($Result3) {
		$status3 = $db->f("log_date");
	}
	
	$sql5 = "SELECT log_date FROM smart_logstatus where log_refno='".$GStatLogStatus->refno->GetValue()."' AND log_status=5";
	$db->query($sql5);
	$Result5 = $db->next_record();
    if ($Result5) {
		$status5 = $db->f("log_date");
	}

	$sql6 = "SELECT log_date FROM smart_logstatus where log_refno='".$GStatLogStatus->refno->GetValue()."' AND log_status=6";
	$db->query($sql6);
	$Result6 = $db->next_record();
    if ($Result6) {
		$status6 = $db->f("log_date");
	}

	$sql7 = "SELECT tckt_c_date FROM smart_ticket where tckt_refnumber='".$GStatLogStatus->refno->GetValue()."'";
	$db->query($sql7);
	$Result7 = $db->next_record();
    if ($Result7) {
		$status7 = $db->f("tckt_c_date");
	}

	if($status1!=null) $GStatLogStatus->dateopen->SetValue(date("d/m/y h:i:s", strtotime($status1)));
	else $GStatLogStatus->dateopen->SetValue("-");

	if($status2!=null) $GStatLogStatus->dateassign->SetValue(date("d/m/y h:i:s", strtotime($status2)));
	else $GStatLogStatus->dateassign->SetValue("-");

	if($status3!=null) $GStatLogStatus->datereassign->SetValue(date("d/m/y h:i:s", strtotime($status3)));
	else $GStatLogStatus->datereassign->SetValue("-");

	if($status5!=null) $GStatLogStatus->datewip->SetValue(date("d/m/y h:i:s", strtotime($status5)));
	else $GStatLogStatus->datewip->SetValue("-");

	if($status6!=null) $GStatLogStatus->dateresolved->SetValue(date("d/m/y h:i:s", strtotime($status6)));
	else $GStatLogStatus->dateresolved->SetValue("-");

	if($status7!=null) $GStatLogStatus->dateclosed->SetValue(date("d/m/y h:i:s", strtotime($status7)));
	else $GStatLogStatus->dateclosed->SetValue("-");

	$GStatLogStatus->tckt_r_helpdesk->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$GStatLogStatus->tckt_r_helpdesk->GetValue(),"usr_username")));
	$GStatLogStatus->tckt_c_helpdesk->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$GStatLogStatus->tckt_c_helpdesk->GetValue(),"usr_username")));

	$sqlEng1 = "SELECT * FROM smart_task where ticket_id='".$GStatLogStatus->ticketid->GetValue()."' AND task_update=2 AND task_status=1";
	$db->query($sqlEng1);
	$ResultEng1 = $db->next_record();
    if ($ResultEng1) {
		$Eng1 = $db->f("task_currenteng");
	}
	$GStatLogStatus->tckt_eng1->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$Eng1,"usr_username")));

	$sqlEng2 = "SELECT * FROM smart_task where ticket_id='".$GStatLogStatus->ticketid->GetValue()."' AND task_update=3 AND task_status=1";
	$db->query($sqlEng2);
	$ResultEng2 = $db->next_record();
    if ($ResultEng2) {
		$Eng2 = $db->f("task_updatedeng");
	}
	$GStatLogStatus->tckt_eng2->SetValue(strtoupper(GetCodeFromSingleTable("smart_user",$Eng2,"usr_username")));

// -------------------------
//End Custom Code

//Close GStatLogStatus_BeforeShowRow @2-2020B63D
    return $GStatLogStatus_BeforeShowRow;
}
//End Close GStatLogStatus_BeforeShowRow

//GStatLogStatus_BeforeShow @2-2CE50D51
function GStatLogStatus_BeforeShow(& $sender)
{
    $GStatLogStatus_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatLogStatus,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GStatLogStatus_BeforeShow

//Custom Code @15-2A29BDB7
// -------------------------
    if($GStatLogStatus->PageNumber != null){
		$PageFirstRecordNo = ($GStatLogStatus->PageSize * ($GStatLogStatus->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GStatLogStatus->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GStatLogStatus->lblNumber->SetValue($BilRekod);
	$GStatLogStatus->lblYear->SetValue(CCGetParam("month")."/".CCGetParam("year"));
// -------------------------
//End Custom Code

//Close GStatLogStatus_BeforeShow @2-04FFC66E
    return $GStatLogStatus_BeforeShow;
}
//End Close GStatLogStatus_BeforeShow

//GStatLogStatus_ds_BeforeBuildSelect @2-9E9EB3BA
function GStatLogStatus_ds_BeforeBuildSelect(& $sender)
{
    $GStatLogStatus_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStatLogStatus; //Compatibility
//End GStatLogStatus_ds_BeforeBuildSelect

//Custom Code @16-2A29BDB7
// -------------------------
    if ($GStatLogStatus->DataSource->Where <> "") {
    $GStatLogStatus->DataSource->Where .= " AND ";
  }

  $GStatLogStatus->DataSource->Where .= "MONTH(tckt_r_date)=".CCGetparam("month")." AND YEAR(tckt_r_date)=".CCGetparam("year");

// -------------------------
//End Custom Code

//Close GStatLogStatus_ds_BeforeBuildSelect @2-0945EB65
    return $GStatLogStatus_ds_BeforeBuildSelect;
}
//End Close GStatLogStatus_ds_BeforeBuildSelect

//Page_AfterInitialize @1-C341CD83
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printreportslogstat; //Compatibility
//End Page_AfterInitialize

//Custom Code @20-2A29BDB7
// -------------------------
    if(CCGetParam("print") == 1) {
		header("Content-type: application/octet-stream");

		# replace excelfile.xls with whatever you want the filename to default to
		header("Content-Disposition: attachment; filename=excelfile.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
