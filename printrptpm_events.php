<?php
//BindEvents Method @1-A24376C5
function BindEvents()
{
    global $smart_eqtoppan_smart_prev1;
    global $CCSEvents;
    $smart_eqtoppan_smart_prev1->state->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_state_BeforeShow";
    $smart_eqtoppan_smart_prev1->prvt_date->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_prvt_date_BeforeShow";
    $smart_eqtoppan_smart_prev1->prvt_byuser->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow";
    $smart_eqtoppan_smart_prev1->prvt_byuser2->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow";
    $smart_eqtoppan_smart_prev1->prvt_report->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_prvt_report_BeforeShow";
    $smart_eqtoppan_smart_prev1->branch->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_branch_BeforeShow";
    $smart_eqtoppan_smart_prev1->branchcode->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_branchcode_BeforeShow";
    $smart_eqtoppan_smart_prev1->CCSEvents["BeforeShow"] = "smart_eqtoppan_smart_prev1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//smart_eqtoppan_smart_prev1_state_BeforeShow @7-B3B6D287
function smart_eqtoppan_smart_prev1_state_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_state_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_state_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_referencecode WHERE ref_value='".$smart_eqtoppan_smart_prev1->state->GetValue()."' AND ref_type='state'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$statename = $db->f("ref_description");
	}

	$smart_eqtoppan_smart_prev1->state->SetValue(strtoupper($statename));
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_state_BeforeShow @7-32D381AE
    return $smart_eqtoppan_smart_prev1_state_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_state_BeforeShow

//smart_eqtoppan_smart_prev1_prvt_date_BeforeShow @11-570BC95A
function smart_eqtoppan_smart_prev1_prvt_date_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_prvt_date_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_prvt_date_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
    $year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
	$db->query($sql);
	$Result = $db->next_record();
    if ($Result) {
		$week = $db->f("prvt_servicedate");
	}
	
	$smart_eqtoppan_smart_prev1->prvt_date->SetValue(strtoupper($week));
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_prvt_date_BeforeShow @11-105B2A47
    return $smart_eqtoppan_smart_prev1_prvt_date_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_prvt_date_BeforeShow

//smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow @13-BF3EE283
function smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
	$year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
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

	$smart_eqtoppan_smart_prev1->prvt_byuser->SetValue(strtoupper($engname1));
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow @13-52324CEC
    return $smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_prvt_byuser_BeforeShow

//smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow @15-1B8B01C8
function smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow

//Custom Code @16-2A29BDB7
// -------------------------
    $year = CCGetParam("year");
	$month = CCGetParam("month");
    $db = new clsDBSMART();
	
	$sql = "SELECT * FROM smart_preventive WHERE YEAR(prvt_servicedate)='".$year."' AND MONTH(prvt_servicedate)='".$month."' AND prvt_toppanid='".$smart_eqtoppan_smart_prev1->eqtop_toppan->GetValue()."' AND prvt_site='".$smart_eqtoppan_smart_prev1->branchcode->GetValue()."'";
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

	$smart_eqtoppan_smart_prev1->prvt_byuser2->SetValue(strtoupper($engname2));
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow @15-E2DBFD2C
    return $smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_prvt_byuser2_BeforeShow

//smart_eqtoppan_smart_prev1_prvt_report_BeforeShow @17-53384619
function smart_eqtoppan_smart_prev1_prvt_report_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_prvt_report_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_prvt_report_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    if($smart_eqtoppan_smart_prev1->prvt_date->GetValue() != null) $smart_eqtoppan_smart_prev1->prvt_report->SetValue("<b>OK</b>"); 
	else $smart_eqtoppan_smart_prev1->prvt_report->SetValue("");
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_prvt_report_BeforeShow @17-E12088CD
    return $smart_eqtoppan_smart_prev1_prvt_report_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_prvt_report_BeforeShow

//smart_eqtoppan_smart_prev1_branch_BeforeShow @19-A382D1BF
function smart_eqtoppan_smart_prev1_branch_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_branch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_branch_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------	
	$smart_eqtoppan_smart_prev1->branch->SetValue(strtoupper($smart_eqtoppan_smart_prev1->branchcode->GetValue()));
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_branch_BeforeShow @19-75E77ACC
    return $smart_eqtoppan_smart_prev1_branch_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_branch_BeforeShow

//smart_eqtoppan_smart_prev1_branchcode_BeforeShow @21-9B0D6F84
function smart_eqtoppan_smart_prev1_branchcode_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_branchcode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_branchcode_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close smart_eqtoppan_smart_prev1_branchcode_BeforeShow @21-80A23F02
    return $smart_eqtoppan_smart_prev1_branchcode_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_branchcode_BeforeShow

//smart_eqtoppan_smart_prev1_BeforeShow @2-30718C57
function smart_eqtoppan_smart_prev1_BeforeShow(& $sender)
{
    $smart_eqtoppan_smart_prev1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_eqtoppan_smart_prev1; //Compatibility
//End smart_eqtoppan_smart_prev1_BeforeShow

//Custom Code @28-2A29BDB7
// -------------------------
   
//	echo "aaa".$state = CCDLookUp("ref_type","smart_referencecode","ref_value='".$smart_eqtoppan_smart_prev1->eqtop_branch->GetValue()."'", $DBSMART);
// -------------------------
//End Custom Code

//Set Row Style @29-D16E0BF3
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("Row", $Style);
    }
//End Set Row Style

//Close smart_eqtoppan_smart_prev1_BeforeShow @2-0824F08C
    return $smart_eqtoppan_smart_prev1_BeforeShow;
}
//End Close smart_eqtoppan_smart_prev1_BeforeShow

//Page_AfterInitialize @1-DDD3807A
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $printrptpm, $smart_eqtoppan_smart_prev1, $PanHeadPage; //Compatibility
//End Page_AfterInitialize

//Custom Code @38-2A29BDB7
// -------------------------
	//$PanHeadPage->lblMonth->SetValue(CCGetparam("month"));
	//$PanHeadPage->lblYear->SetValue(CCGetparam("year"));
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
