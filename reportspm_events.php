<?php
// //Events @1-F81417CB

//reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow @21-9665F429
function reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow

//Custom Code @45-2A29BDB7
// -------------------------
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$reportspm->smart_eqtoppan_smart_prev1->state->GetValue()."' AND ref_type='state'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$statename = $db->f("ref_description");
	}

	$reportspm->smart_eqtoppan_smart_prev1->state->SetValue(strtoupper($statename));
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow @21-777308DD
    return $reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_state_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow @25-40571D46
function reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow

//Custom Code @34-2A29BDB7
// -------------------------
    $year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$reportspm->smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$reportspm->smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$week = $db->f("prvt_servicedate");
	}
	
	$reportspm->smart_eqtoppan_smart_prev1->prvt_date->SetValue(strtoupper($week));
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow @25-2F840CCC
    return $reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_prvt_date_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow @26-210CD13E
function reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
	$year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$reportspm->smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$reportspm->smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$eng1 = $db->f("prvt_byuser");
	}
	
	$sql = "SELECT * FROM smart_user WHERE id=".$eng1;
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$engname1 = $db->f("usr_username");
	}

	$reportspm->smart_eqtoppan_smart_prev1->prvt_byuser->SetValue(strtoupper($engname1));
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow @26-5848B74E
    return $reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow @27-C2540506
function reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
    $year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$reportspm->smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$reportspm->smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$eng2 = $db->f("prvt_byuser2");
	}
	
	$sql = "SELECT * FROM smart_user WHERE id=".$eng2;
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$engname2 = $db->f("usr_username");
	}

	$reportspm->smart_eqtoppan_smart_prev1->prvt_byuser2->SetValue(strtoupper($engname2));
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow @27-DA094513
    return $reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow @28-FF91B0F2
function reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow

//Custom Code @35-2A29BDB7
// -------------------------
    if($reportspm->smart_eqtoppan_smart_prev1->prvt_date->GetValue() != null) $reportspm->smart_eqtoppan_smart_prev1->prvt_report->SetValue("<b>OK</b>"); 
	else $reportspm->smart_eqtoppan_smart_prev1->prvt_report->SetValue("");
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow @28-EB5A736F
    return $reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_prvt_report_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow @23-30E73CF1
function reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow

//Custom Code @30-2A29BDB7
// -------------------------	
	$reportspm->smart_eqtoppan_smart_prev1->branch->SetValue(strtoupper($reportspm->smart_eqtoppan_smart_prev1->branchcode->GetValue()));
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow @23-BCAEFAC3
    return $reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_branch_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow @37-9EBE0176
function reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow

//Custom Code @38-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow @37-FAF7BA8C
    return $reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_branchcode_BeforeShow

//reportspm_smart_eqtoppan_smart_prev1_BeforeShow @2-19CC21A7
function reportspm_smart_eqtoppan_smart_prev1_BeforeShow(& $sender)
{
    $reportspm_smart_eqtoppan_smart_prev1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportspm; //Compatibility
//End reportspm_smart_eqtoppan_smart_prev1_BeforeShow

//Custom Code @29-2A29BDB7
// -------------------------
   
//	echo "aaa".$state = CCDLookUp("ref_type","smart_referencecode","ref_value='".$reportspm->smart_eqtoppan_smart_prev1->eqtop_branch->GetValue()."'", $DBSMART);
// -------------------------
//End Custom Code

//Set Row Style @31-D16E0BF3
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("Row", $Style);
    }
//End Set Row Style

//Close reportspm_smart_eqtoppan_smart_prev1_BeforeShow @2-F26DB292
    return $reportspm_smart_eqtoppan_smart_prev1_BeforeShow;
}
//End Close reportspm_smart_eqtoppan_smart_prev1_BeforeShow

//DEL  // -------------------------
//DEL      //$reportspm->PanHeader->lblMonth->SetValue("month");
//DEL  	//$reportspm->PanHeader->lblYear->SetValue("year");
//DEL  // -------------------------



?>
