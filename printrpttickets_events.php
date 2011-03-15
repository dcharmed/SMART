<?php
//BindEvents Method @1-48BAA15E
function BindEvents()
{
    global $RTicket;
    global $CCSEvents;
    $RTicket->hdrmonth->CCSEvents["BeforeShow"] = "RTicket_hdrmonth_BeforeShow";
    $RTicket->tckt_site->CCSEvents["BeforeShow"] = "RTicket_tckt_site_BeforeShow";
    $RTicket->Age->CCSEvents["BeforeShow"] = "RTicket_Age_BeforeShow";
    $RTicket->tckt_cat->CCSEvents["BeforeShow"] = "RTicket_tckt_cat_BeforeShow";
    $RTicket->tckt_subcat->CCSEvents["BeforeShow"] = "RTicket_tckt_subcat_BeforeShow";
    $RTicket->tckt_severity->CCSEvents["BeforeShow"] = "RTicket_tckt_severity_BeforeShow";
    $RTicket->tckt_status->CCSEvents["BeforeShow"] = "RTicket_tckt_status_BeforeShow";
    $RTicket->tckt_method->CCSEvents["BeforeShow"] = "RTicket_tckt_method_BeforeShow";
    $RTicket->rsltn_byuser->CCSEvents["BeforeShow"] = "RTicket_rsltn_byuser_BeforeShow";
    $RTicket->rsltn_date->CCSEvents["BeforeShow"] = "RTicket_rsltn_date_BeforeShow";
    $RTicket->rsltn_eta->CCSEvents["BeforeShow"] = "RTicket_rsltn_eta_BeforeShow";
    $RTicket->ds->CCSEvents["BeforeBuildSelect"] = "RTicket_ds_BeforeBuildSelect";
    $RTicket->CCSEvents["BeforeShow"] = "RTicket_BeforeShow";
    $RTicket->ds->CCSEvents["BeforeExecuteSelect"] = "RTicket_ds_BeforeExecuteSelect";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//RTicket_hdrmonth_BeforeShow @70-9827B3BF
function RTicket_hdrmonth_BeforeShow(& $sender)
{
    $RTicket_hdrmonth_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_hdrmonth_BeforeShow

//Custom Code @71-2A29BDB7
// -------------------------
    $RTicket->hdrmonth->SetValue(CCGetParam("month")."/".CCGetParam("year"));
// -------------------------
//End Custom Code

//Close RTicket_hdrmonth_BeforeShow @70-662614FF
    return $RTicket_hdrmonth_BeforeShow;
}
//End Close RTicket_hdrmonth_BeforeShow

//RTicket_tckt_site_BeforeShow @50-3A750E0E
function RTicket_tckt_site_BeforeShow(& $sender)
{
    $RTicket_tckt_site_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_site_BeforeShow

//Custom Code @58-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close RTicket_tckt_site_BeforeShow @50-4CEEC4C3
    return $RTicket_tckt_site_BeforeShow;
}
//End Close RTicket_tckt_site_BeforeShow

//RTicket_Age_BeforeShow @57-4FFB0AC2
function RTicket_Age_BeforeShow(& $sender)
{
    $RTicket_Age_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_Age_BeforeShow

//Custom Code @72-2A29BDB7
// -------------------------
	$state = $RTicket->state->GetValue();
	$dateClosed = $RTicket->tckt_c_date->GetValue();
	$dateCase = $RTicket->tckt_r_date->GetValue();
    $TimeCase = CountingHours($dateClosed[0], $dateCase[0]);
	if($TimeCase > 2 && $state != 'ovs') $RTicket->Age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase <= 2 && $state != 'ovs') $RTicket->Age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase > 48 && $state == 'ovs') $RTicket->Age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase <= 48 && $state == 'ovs') $RTicket->Age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");
// -------------------------
//End Custom Code

//Close RTicket_Age_BeforeShow @57-F85AD614
    return $RTicket_Age_BeforeShow;
}
//End Close RTicket_Age_BeforeShow

//RTicket_tckt_cat_BeforeShow @75-5CC18522
function RTicket_tckt_cat_BeforeShow(& $sender)
{
    $RTicket_tckt_cat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_cat_BeforeShow

//Custom Code @76-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$RTicket->tckt_cat->GetValue()."' AND ref_type='probcat'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$CatName = $db->f("ref_description");
	}
	$RTicket->tckt_cat->SetValue($CatName);
// -------------------------
//End Custom Code

//Close RTicket_tckt_cat_BeforeShow @75-EB362A34
    return $RTicket_tckt_cat_BeforeShow;
}
//End Close RTicket_tckt_cat_BeforeShow

//RTicket_tckt_subcat_BeforeShow @79-5F5DB174
function RTicket_tckt_subcat_BeforeShow(& $sender)
{
    $RTicket_tckt_subcat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_subcat_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
    $db = new clsDBSMART();
	
	if($RTicket->tckt_subcat->GetValue()!=null) {
		$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$RTicket->tckt_subcat->GetValue()."' AND ref_type='".$RTicket->hidecat->GetValue()."'";
		$db->query($sql);
		$Result = $db->next_record();
		if ($Result) {
			$SubCatName = $db->f("ref_description");
		}
		$RTicket->tckt_subcat->SetValue("<em>(".$SubCatName.")</em>");
	}
// -------------------------
//End Custom Code

//Close RTicket_tckt_subcat_BeforeShow @79-7F41AB01
    return $RTicket_tckt_subcat_BeforeShow;
}
//End Close RTicket_tckt_subcat_BeforeShow

//RTicket_tckt_severity_BeforeShow @51-CF4E15E1
function RTicket_tckt_severity_BeforeShow(& $sender)
{
    $RTicket_tckt_severity_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_severity_BeforeShow

//Custom Code @60-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$RTicket->tckt_severity->GetValue()."' AND ref_type='tcktseverity'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$SeverityName = $db->f("ref_description");
	}

	$RTicket->tckt_severity->SetValue($SeverityName);
// -------------------------
//End Custom Code

//Close RTicket_tckt_severity_BeforeShow @51-F507FDC1
    return $RTicket_tckt_severity_BeforeShow;
}
//End Close RTicket_tckt_severity_BeforeShow

//RTicket_tckt_status_BeforeShow @46-F7FED0DA
function RTicket_tckt_status_BeforeShow(& $sender)
{
    $RTicket_tckt_status_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_status_BeforeShow

//Custom Code @59-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$RTicket->tckt_status->GetValue()."' AND ref_type='tcktstatus'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$StatusName = $db->f("ref_description");
	}

	$RTicket->tckt_status->SetValue($StatusName);
// -------------------------
//End Custom Code

//Close RTicket_tckt_status_BeforeShow @46-7384D063
    return $RTicket_tckt_status_BeforeShow;
}
//End Close RTicket_tckt_status_BeforeShow

//RTicket_tckt_method_BeforeShow @77-547FCE46
function RTicket_tckt_method_BeforeShow(& $sender)
{
    $RTicket_tckt_method_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_tckt_method_BeforeShow

//Custom Code @78-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	if($RTicket->tckt_method->GetValue()!=null) {
		$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$RTicket->tckt_method->GetValue()."' AND ref_type='rsltnmethod'";
		$db->query($sql);
		$Result = $db->next_record();
		if ($Result) {
			$MethodName = $db->f("ref_description");
		}
		$RTicket->tckt_method->SetValue("<em>(".$MethodName.")</em>");
	}
// -------------------------
//End Custom Code

//Close RTicket_tckt_method_BeforeShow @77-B7A2FB54
    return $RTicket_tckt_method_BeforeShow;
}
//End Close RTicket_tckt_method_BeforeShow

//RTicket_rsltn_byuser_BeforeShow @41-F9572CD6
function RTicket_rsltn_byuser_BeforeShow(& $sender)
{
    $RTicket_rsltn_byuser_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_rsltn_byuser_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_user WHERE id=".$RTicket->rsltn_byuser->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$EngName = $db->f("usr_username");
	}

	$RTicket->rsltn_byuser->SetValue($EngName);
// -------------------------
//End Custom Code

//Close RTicket_rsltn_byuser_BeforeShow @41-33B25B98
    return $RTicket_rsltn_byuser_BeforeShow;
}
//End Close RTicket_rsltn_byuser_BeforeShow

//RTicket_rsltn_date_BeforeShow @45-B73B385D
function RTicket_rsltn_date_BeforeShow(& $sender)
{
    $RTicket_rsltn_date_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_rsltn_date_BeforeShow

//Custom Code @82-2A29BDB7
// -------------------------
    if($RTicket->rsltn_type->GetValue() == 'SN') {
		$RTicket->rsltn_date->Visible = true;
	} else {
		$RTicket->rsltn_date->Visible = false;
	}
// -------------------------
//End Custom Code

//Close RTicket_rsltn_date_BeforeShow @45-F6CACB82
    return $RTicket_rsltn_date_BeforeShow;
}
//End Close RTicket_rsltn_date_BeforeShow

//RTicket_rsltn_eta_BeforeShow @42-6A74AC3F
function RTicket_rsltn_eta_BeforeShow(& $sender)
{
    $RTicket_rsltn_eta_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_rsltn_eta_BeforeShow

//Custom Code @83-2A29BDB7
// -------------------------
    if($RTicket->rsltn_type->GetValue() == 'SN') {
		$RTicket->rsltn_eta->Visible = false;
	} else {
		$RTicket->rsltn_eta->Visible = true;
	}
// -------------------------
//End Custom Code

//Close RTicket_rsltn_eta_BeforeShow @42-0D3D7E8D
    return $RTicket_rsltn_eta_BeforeShow;
}
//End Close RTicket_rsltn_eta_BeforeShow

//RTicket_ds_BeforeBuildSelect @2-A8B58104
function RTicket_ds_BeforeBuildSelect(& $sender)
{
    $RTicket_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_ds_BeforeBuildSelect

//Custom Code @86-2A29BDB7
// -------------------------
	if ($RTicket->ds->Where <> "") {
	    $RTicket->ds->Where .= " AND ";
	}

	$RTicket->ds->Where .= " MONTH(smart_ticket.tckt_r_date)=".CCGetParam("month")." AND YEAR(smart_ticket.tckt_r_date)=".CCGetParam("year");
	   
// -------------------------
//End Custom Code

//Close RTicket_ds_BeforeBuildSelect @2-3DC3B448
    return $RTicket_ds_BeforeBuildSelect;
}
//End Close RTicket_ds_BeforeBuildSelect

//RTicket_BeforeShow @2-982F0FD3
function RTicket_BeforeShow(& $sender)
{
    $RTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_BeforeShow

//Custom Code @87-2A29BDB7
// -------------------------
   
// -------------------------
//End Custom Code

//Close RTicket_BeforeShow @2-CF7158C4
    return $RTicket_BeforeShow;
}
//End Close RTicket_BeforeShow

//RTicket_ds_BeforeExecuteSelect @2-CFAF17F5
function RTicket_ds_BeforeExecuteSelect(& $sender)
{
    $RTicket_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RTicket; //Compatibility
//End RTicket_ds_BeforeExecuteSelect

//Custom Code @88-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close RTicket_ds_BeforeExecuteSelect @2-500C7480
    return $RTicket_ds_BeforeExecuteSelect;
}
//End Close RTicket_ds_BeforeExecuteSelect

//Page_AfterInitialize @1-11F86E6C
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrpttickets; //Compatibility
//End Page_AfterInitialize

//Custom Code @69-2A29BDB7
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
