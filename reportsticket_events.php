<?php
// //Events @1-F81417CB

//reportsticket_RTicket_hdrmonth_BeforeShow @112-22641D9A
function reportsticket_RTicket_hdrmonth_BeforeShow(& $sender)
{
    $reportsticket_RTicket_hdrmonth_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_hdrmonth_BeforeShow

//Custom Code @113-2A29BDB7
// -------------------------
    $reportsticket->RTicket->hdrmonth->SetValue(CCGetParam("month")."/".CCGetParam("year"));
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_hdrmonth_BeforeShow @112-4670289C
    return $reportsticket_RTicket_hdrmonth_BeforeShow;
}
//End Close reportsticket_RTicket_hdrmonth_BeforeShow

//reportsticket_RTicket_tckt_site_BeforeShow @50-3C26397F
function reportsticket_RTicket_tckt_site_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_site_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_site_BeforeShow

//Custom Code @58-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_site_BeforeShow @50-9875A21D
    return $reportsticket_RTicket_tckt_site_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_site_BeforeShow

//reportsticket_RTicket_Age_BeforeShow @57-708D8158
function reportsticket_RTicket_Age_BeforeShow(& $sender)
{
    $reportsticket_RTicket_Age_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_Age_BeforeShow

//Custom Code @70-2A29BDB7
// -------------------------
	$state = $reportsticket->RTicket->state->GetValue();
	$dateClosed = $reportsticket->RTicket->tckt_c_date->GetValue();
	$dateCase = $reportsticket->RTicket->tckt_r_date->GetValue();
    $TimeCase = CountingHours($dateClosed[0], $dateCase[0]);
	if($TimeCase > 2 && $state != 'ovs') $reportsticket->RTicket->Age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase <= 2 && $state != 'ovs') $reportsticket->RTicket->Age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase > 48 && $state == 'ovs') $reportsticket->RTicket->Age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase <= 48 && $state == 'ovs') $reportsticket->RTicket->Age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_Age_BeforeShow @57-DCAD291A
    return $reportsticket_RTicket_Age_BeforeShow;
}
//End Close reportsticket_RTicket_Age_BeforeShow

//reportsticket_RTicket_tckt_cat_BeforeShow @102-B4F73597
function reportsticket_RTicket_tckt_cat_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_cat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_cat_BeforeShow

//Custom Code @108-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportsticket->RTicket->tckt_cat->GetValue()."' AND ref_type='probcat'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$CatName = $db->f("ref_description");
	}
	$reportsticket->RTicket->tckt_cat->SetValue($CatName);
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_cat_BeforeShow @102-CB601657
    return $reportsticket_RTicket_tckt_cat_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_cat_BeforeShow

//reportsticket_RTicket_tckt_subcat_BeforeShow @104-49626301
function reportsticket_RTicket_tckt_subcat_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_subcat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_subcat_BeforeShow

//Custom Code @109-2A29BDB7
// -------------------------
    $db = new clsDBSMART();
	
	if($reportsticket->RTicket->tckt_subcat->GetValue()!=null) {
		$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportsticket->RTicket->tckt_subcat->GetValue()."' AND ref_type='".$reportsticket->RTicket->hidecat->GetValue()."'";
		$db->query($sql);
		$Result = $db->next_record();
		if ($Result) {
			$SubCatName = $db->f("ref_description");
		}
		$reportsticket->RTicket->tckt_subcat->SetValue("<em>(".$SubCatName.")</em>");
	}
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_subcat_BeforeShow @104-C42B5366
    return $reportsticket_RTicket_tckt_subcat_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_subcat_BeforeShow

//reportsticket_RTicket_tckt_severity_BeforeShow @51-7EF7ACC4
function reportsticket_RTicket_tckt_severity_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_severity_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_severity_BeforeShow

//Custom Code @60-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportsticket->RTicket->tckt_severity->GetValue()."' AND ref_type='tcktseverity'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$SeverityName = $db->f("ref_description");
	}

	$reportsticket->RTicket->tckt_severity->SetValue($SeverityName);
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_severity_BeforeShow @51-6CDDC1E5
    return $reportsticket_RTicket_tckt_severity_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_severity_BeforeShow

//reportsticket_RTicket_tckt_status_BeforeShow @46-43288B74
function reportsticket_RTicket_tckt_status_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_status_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_status_BeforeShow

//Custom Code @59-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportsticket->RTicket->tckt_status->GetValue()."' AND ref_type='tcktstatus'";
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$StatusName = $db->f("ref_description");
	}

	$reportsticket->RTicket->tckt_status->SetValue($StatusName);
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_status_BeforeShow @46-C8EE2804
    return $reportsticket_RTicket_tckt_status_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_status_BeforeShow

//reportsticket_RTicket_tckt_method_BeforeShow @103-7916BB89
function reportsticket_RTicket_tckt_method_BeforeShow(& $sender)
{
    $reportsticket_RTicket_tckt_method_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_tckt_method_BeforeShow

//Custom Code @111-2A29BDB7
// -------------------------
    $db = new clsDBSMART();

	if($reportsticket->RTicket->tckt_method->GetValue()!=null) {
		$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportsticket->RTicket->tckt_method->GetValue()."' AND ref_type='rsltnmethod'";
		$db->query($sql);
		$Result = $db->next_record();
		if ($Result) {
			$MethodName = $db->f("ref_description");
		}
		$reportsticket->RTicket->tckt_method->SetValue("<em>(".$MethodName.")</em>");
	}
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_tckt_method_BeforeShow @103-0CC80333
    return $reportsticket_RTicket_tckt_method_BeforeShow;
}
//End Close reportsticket_RTicket_tckt_method_BeforeShow

//reportsticket_RTicket_rsltn_byuser_BeforeShow @41-B1FA7D2D
function reportsticket_RTicket_rsltn_byuser_BeforeShow(& $sender)
{
    $reportsticket_RTicket_rsltn_byuser_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket, $DBSMART; //Compatibility
//End reportsticket_RTicket_rsltn_byuser_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
	$db = new clsDBSMART();

	$sql = "SELECT * FROM smart_user WHERE id=".$reportsticket->RTicket->rsltn_byuser->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if ($Result) {
		$EngName = $db->f("usr_username");
	}

	$reportsticket->RTicket->rsltn_byuser->SetValue($EngName);
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_rsltn_byuser_BeforeShow @41-E0DFC59B
    return $reportsticket_RTicket_rsltn_byuser_BeforeShow;
}
//End Close reportsticket_RTicket_rsltn_byuser_BeforeShow

//reportsticket_RTicket_rsltn_date_BeforeShow @45-E6A0EFF5
function reportsticket_RTicket_rsltn_date_BeforeShow(& $sender)
{
    $reportsticket_RTicket_rsltn_date_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_rsltn_date_BeforeShow

//Custom Code @78-2A29BDB7
// -------------------------
    if($reportsticket->RTicket->rsltn_type->GetValue() == 'SN') {
		$reportsticket->RTicket->rsltn_date->Visible = true;
	} else {
		$reportsticket->RTicket->rsltn_date->Visible = false;
	}
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_rsltn_date_BeforeShow @45-9775AF37
    return $reportsticket_RTicket_rsltn_date_BeforeShow;
}
//End Close reportsticket_RTicket_rsltn_date_BeforeShow

//reportsticket_RTicket_rsltn_eta_BeforeShow @42-D50B2E77
function reportsticket_RTicket_rsltn_eta_BeforeShow(& $sender)
{
    $reportsticket_RTicket_rsltn_eta_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_rsltn_eta_BeforeShow

//Custom Code @76-2A29BDB7
// -------------------------
    if($reportsticket->RTicket->rsltn_type->GetValue() == 'SN') {
		$reportsticket->RTicket->rsltn_eta->Visible = false;
	} else {
		$reportsticket->RTicket->rsltn_eta->Visible = true;
	}
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_rsltn_eta_BeforeShow @42-D9A61853
    return $reportsticket_RTicket_rsltn_eta_BeforeShow;
}
//End Close reportsticket_RTicket_rsltn_eta_BeforeShow

//reportsticket_RTicket_Navigator_BeforeShow @38-8886A91D
function reportsticket_RTicket_Navigator_BeforeShow(& $sender)
{
    $reportsticket_RTicket_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_Navigator_BeforeShow

//Hide-Show Component @39-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close reportsticket_RTicket_Navigator_BeforeShow @38-6969029B
    return $reportsticket_RTicket_Navigator_BeforeShow;
}
//End Close reportsticket_RTicket_Navigator_BeforeShow

//reportsticket_RTicket_ds_BeforeBuildSelect @2-AFEB9BA4
function reportsticket_RTicket_ds_BeforeBuildSelect(& $sender)
{
    $reportsticket_RTicket_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_ds_BeforeBuildSelect

//Custom Code @99-2A29BDB7
// -------------------------
	if ($reportsticket->RTicket->ds->Where <> "") {
	    $reportsticket->RTicket->ds->Where .= " AND ";
	}

	$reportsticket->RTicket->ds->Where .= " MONTH(smart_ticket.tckt_r_date)=".CCGetParam("month")." AND YEAR(smart_ticket.tckt_r_date)=".CCGetParam("year");
	   
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_ds_BeforeBuildSelect @2-E958D296
    return $reportsticket_RTicket_ds_BeforeBuildSelect;
}
//End Close reportsticket_RTicket_ds_BeforeBuildSelect

//reportsticket_RTicket_BeforeShow @2-C052E026
function reportsticket_RTicket_BeforeShow(& $sender)
{
    $reportsticket_RTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_BeforeShow

//Custom Code @100-2A29BDB7
// -------------------------
   
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_BeforeShow @2-2A5621D2
    return $reportsticket_RTicket_BeforeShow;
}
//End Close reportsticket_RTicket_BeforeShow

//reportsticket_RTicket_ds_BeforeExecuteSelect @2-C47B2659
function reportsticket_RTicket_ds_BeforeExecuteSelect(& $sender)
{
    $reportsticket_RTicket_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsticket; //Compatibility
//End reportsticket_RTicket_ds_BeforeExecuteSelect

//Custom Code @101-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close reportsticket_RTicket_ds_BeforeExecuteSelect @2-EB668CE7
    return $reportsticket_RTicket_ds_BeforeExecuteSelect;
}
//End Close reportsticket_RTicket_ds_BeforeExecuteSelect


?>
