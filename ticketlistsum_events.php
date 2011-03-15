<?php
//BindEvents Method @1-7F800E66
function BindEvents()
{
    global $smart_ticket;
    global $smart_ticketSearch;
    global $CCSEvents;
    $smart_ticket->smart_ticket_TotalRecords->CCSEvents["BeforeShow"] = "smart_ticket_smart_ticket_TotalRecords_BeforeShow";
    $smart_ticket->CCSEvents["BeforeShowRow"] = "smart_ticket_BeforeShowRow";
    $smart_ticket->CCSEvents["BeforeShow"] = "smart_ticket_BeforeShow";
    $smart_ticket->ds->CCSEvents["BeforeBuildSelect"] = "smart_ticket_ds_BeforeBuildSelect";
    $smart_ticketSearch->s_scat->CCSEvents["BeforeShow"] = "smart_ticketSearch_s_scat_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//smart_ticket_smart_ticket_TotalRecords_BeforeShow @12-5EEA9364
function smart_ticket_smart_ticket_TotalRecords_BeforeShow(& $sender)
{
    $smart_ticket_smart_ticket_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_smart_ticket_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close smart_ticket_smart_ticket_TotalRecords_BeforeShow @12-287206C9
    return $smart_ticket_smart_ticket_TotalRecords_BeforeShow;
}
//End Close smart_ticket_smart_ticket_TotalRecords_BeforeShow

//smart_ticket_BeforeShowRow @5-1631B8A7
function smart_ticket_BeforeShowRow(& $sender)
{
    $smart_ticket_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End smart_ticket_BeforeShowRow

//Set Row Style @27-982C9472
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
	$db = new clsDBSMART();
    $smart_ticket->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	$smart_ticket->tckt_severity->SetValue(GetCodeDescription("tcktseverity", $smart_ticket->tckt_severity->GetValue()));
	
	//TO CUSTOMIZE AGE DISPLAY
	$state = $smart_ticket->tckt_state->GetValue();
	$dateCase = $smart_ticket->tckt_date->GetValue();
	
	if($smart_ticket->tckt_status->GetValue()<7) {
		$dateClosed = time();//strtotime(date("Y-m-d h:m:s"));
		$TimeCase = CountingHours($dateClosed, $dateCase[0]);
	} else {
		$dateClosed = $smart_ticket->tckt_c_date->GetValue();
		$TimeCase = CountingHours($dateClosed[0], $dateCase[0]);
	}
	
	if($TimeCase > 2 && $state != 'ovs') $smart_ticket->tckt_age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase < 2 && $state != 'ovs') $smart_ticket->tckt_age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase > 48 && $state == 'ovs') $smart_ticket->tckt_age->SetValue("<font color=red><b>".$TimeCase." Hrs</b></font>");
	elseif($TimeCase < 48 && $state == 'ovs') $smart_ticket->tckt_age->SetValue("<font color=green><b>".$TimeCase." Hrs</b></font>");

	$idTask = CCDLookUp("max(id)","smart_task","ticket_id=".$smart_ticket->id->GetValue(), $DBSMART);
	$checkEng = CCDLookUp("task_updatedeng","smart_task","id=".$idTask, $DBSMART);
	if($checkEng > 0) {
		$latestEng = $checkEng;
	} else {
		$latestEng = CCDLookUp("task_currenteng","smart_task","id=".$idTask, $DBSMART);
	}
	
	//CHECKING CM DETAILS
	//$resid = CCDLookUp("id","smart_resolutionnote","ticket_id=".$,$DBSMART);
	$sqlAddInfo = "SELECT smart_resolutionnote.ticket_id, SUM(IF(rplc_type='sp',1,0)) AS countedspart,SUM(IF(rplc_type='eq',1,0)) AS  countedeq
				   from smart_replacement INNER JOIN smart_resolutionnote 
				   ON smart_resolutionnote.id=smart_replacement.resolution_id 
				   AND smart_resolutionnote.ticket_id=".$smart_ticket->id->GetValue(). " GROUP BY smart_replacement.resolution_id";
	
	$db->query($sqlAddInfo);
	$record = array();
	$ResultAddInfo = $db->next_record();
	if ($ResultAddInfo) {
		$spartdet = $db->f("countedspart");
		$eqdet = $db->f("countedeq");
	}
	
	if($spartdet > 0) {
		$smart_ticket->tckt_spart->SetValue("YES");
	} else {
		$smart_ticket->tckt_spart->SetValue("NO");
	}
	
	if($eqdet > 0) {
		$smart_ticket->tckt_equipment->SetValue("YES");
	} else {
		$smart_ticket->tckt_equipment->SetValue("NO");
	}

	$smart_ticket->tcktEng->SetValue(CCDLookUp("usr_username","smart_user","id=".$latestEng,$DBSMART));
	$smart_ticket->tckt_status->SetValue("<b>".GetCodeDescription("tcktstatus", $smart_ticket->tckt_status->GetValue())."</b>");
	switch(CCGetSession("GroupID")) {
		case 1: 
		case 5:
			$smart_ticket->tckt_refnumber->SetLink("ticketdetails.php?id=".$smart_ticket->id->GetValue());
		break;
		default: 
			$smart_ticket->tckt_refnumber->SetLink("vticketdetails.php?id=".$smart_ticket->id->GetValue());
		break;
	}
	switch($smart_ticket->tckt_followup->GetValue()) {
		case 1:
			$smart_ticket->tckt_followup->SetValue("YES");
			break;
		default:
			$smart_ticket->tckt_followup->SetValue("NO");
			break;
	}
// -------------------------
//End Custom Code

//Close smart_ticket_BeforeShowRow @5-388C00FF
    return $smart_ticket_BeforeShowRow;
}
//End Close smart_ticket_BeforeShowRow

//smart_ticket_BeforeShow @5-5C5B41F4
function smart_ticket_BeforeShow(& $sender)
{
    $smart_ticket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket,$BilRekod, $PageFirstRecordNo; //Compatibility
//End smart_ticket_BeforeShow

//Custom Code @49-2A29BDB7
// -------------------------
    if($smart_ticket->PageNumber != null){
		$PageFirstRecordNo = ($smart_ticket->PageSize * ($smart_ticket->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($smart_ticket->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$smart_ticket->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close smart_ticket_BeforeShow @5-1BC0D7FE
    return $smart_ticket_BeforeShow;
}
//End Close smart_ticket_BeforeShow

//smart_ticket_ds_BeforeBuildSelect @5-7ED532B2
function smart_ticket_ds_BeforeBuildSelect(& $sender)
{
    $smart_ticket_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_ds_BeforeBuildSelect

//Custom Code @103-2A29BDB7
// -------------------------
	if(CCGetParam("s_sdate")!=null && CCGetParam("s_edate")!=null) {
		
		if ($smart_ticket->DataSource->Where <> "") {
		$smart_ticket->DataSource->Where .= " AND ";
		}

		$smart_ticket->DataSource->Where .= "tckt_r_date>= '".CCGetParam("s_sdate")." 00:00:00' AND tckt_r_date<='".CCGetParam("s_edate")." 59:59:59'";
	}

// -------------------------
//End Custom Code

//Close smart_ticket_ds_BeforeBuildSelect @5-BE2E9848
    return $smart_ticket_ds_BeforeBuildSelect;
}
//End Close smart_ticket_ds_BeforeBuildSelect

//smart_ticketSearch_s_scat_BeforeShow @86-0D3C68C8
function smart_ticketSearch_s_scat_BeforeShow(& $sender)
{
    $smart_ticketSearch_s_scat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticketSearch; //Compatibility
//End smart_ticketSearch_s_scat_BeforeShow

//Close smart_ticketSearch_s_scat_BeforeShow @86-E9B7A395
    return $smart_ticketSearch_s_scat_BeforeShow;
}
//End Close smart_ticketSearch_s_scat_BeforeShow

//Page_AfterInitialize @1-8B164014
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketlistsum; //Compatibility
//End Page_AfterInitialize

//Custom Code @62-2A29BDB7
// -------------------------
	CCSetSession("tcktid","");
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-93A07997
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketlistsum; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
