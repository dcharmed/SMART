<?php
//BindEvents Method @1-629866E2
function BindEvents()
{
    global $RDelTicket;
    global $GTickets;
    global $RRefGenerator;
    global $GRefGenerator;
    global $CCSEvents;
    $RDelTicket->Button_Cancel->CCSEvents["OnClick"] = "RDelTicket_Button_Cancel_OnClick";
    $RDelTicket->CCSEvents["BeforeShow"] = "RDelTicket_BeforeShow";
    $RDelTicket->CCSEvents["AfterDelete"] = "RDelTicket_AfterDelete";
    $RDelTicket->ds->CCSEvents["AfterExecuteDelete"] = "RDelTicket_ds_AfterExecuteDelete";
    $GTickets->smart_ticket_TotalRecords->CCSEvents["BeforeShow"] = "GTickets_smart_ticket_TotalRecords_BeforeShow";
    $GTickets->CCSEvents["BeforeShowRow"] = "GTickets_BeforeShowRow";
    $GTickets->CCSEvents["BeforeShow"] = "GTickets_BeforeShow";
    $RRefGenerator->CCSEvents["BeforeShow"] = "RRefGenerator_BeforeShow";
    $RRefGenerator->ds->CCSEvents["BeforeBuildSelect"] = "RRefGenerator_ds_BeforeBuildSelect";
    $GRefGenerator->CCSEvents["BeforeShowRow"] = "GRefGenerator_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//RDelTicket_Button_Cancel_OnClick @8-1B746520
function RDelTicket_Button_Cancel_OnClick(& $sender)
{
    $RDelTicket_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RDelTicket, $Redirect; //Compatibility
//End RDelTicket_Button_Cancel_OnClick

//Custom Code @64-2A29BDB7
// -------------------------
    $Redirect = "index.php";
// -------------------------
//End Custom Code

//Close RDelTicket_Button_Cancel_OnClick @8-A1945699
    return $RDelTicket_Button_Cancel_OnClick;
}
//End Close RDelTicket_Button_Cancel_OnClick

//RDelTicket_BeforeShow @5-5A49130A
function RDelTicket_BeforeShow(& $sender)
{
    $RDelTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RDelTicket, $SDelTicket; //Compatibility
//End RDelTicket_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
    $SDelTicket->d_tckt->SetValue("");
	if(($SDelTicket->d_tckt->GetValue()!=null) && ($RDelTicket->tckt_refnumber->GetValue()!= CCGetParam("d_tckt"))) {
		$SDelTicket->Errors->addError("Sorry, Ticket is not found");
		$RDelTicket->Visible = false;
	} elseif(CCGetParam("tq")==1) {
    	$SDelTicket->Errors->addError("Record successfully deleted!");
	} else {
		$RDelTicket->Visible = true;
		$RDelTicket->tckt_status->SetValue(GetCodeDescription("tcktstatus",$RDelTicket->tckt_status->GetValue()));
		$RDelTicket->tckt_site->SetValue(GetCodeDescription($RDelTicket->tckt_state->GetValue(),$RDelTicket->tckt_site->GetValue()));
		$RDelTicket->tckt_state->SetValue(GetCodeDescription("state",$RDelTicket->tckt_state->GetValue()));
		$RDelTicket->tckt_subcategory->SetValue(GetCodeDescription($RDelTicket->tckt_category->GetValue(),$RDelTicket->tckt_subcategory->GetValue()));
		$RDelTicket->tckt_category->SetValue(GetCodeDescription("probcat",$RDelTicket->tckt_category->GetValue()));
		
	}
// -------------------------
//End Custom Code

//Close RDelTicket_BeforeShow @5-FF7703BE
    return $RDelTicket_BeforeShow;
}
//End Close RDelTicket_BeforeShow

//RDelTicket_AfterDelete @5-289EBF55
function RDelTicket_AfterDelete(& $sender)
{
    $RDelTicket_AfterDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RDelTicket, $SDelTicket, $Redirect; //Compatibility
//End RDelTicket_AfterDelete

//Custom Code @24-2A29BDB7
// -------------------------
	$Redirect = "AdmTicMngmt.php?tq=1";
    $SDelTicket->Errors->addError("Record successfully deleted!");
// -------------------------
//End Custom Code

//Close RDelTicket_AfterDelete @5-0686B4B9
    return $RDelTicket_AfterDelete;
}
//End Close RDelTicket_AfterDelete

//RDelTicket_ds_AfterExecuteDelete @5-E8159B5D
function RDelTicket_ds_AfterExecuteDelete(& $sender)
{
    $RDelTicket_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RDelTicket, $SDelTicket; //Compatibility
//End RDelTicket_ds_AfterExecuteDelete

//Custom Code @25-2A29BDB7
// -------------------------
    $SDelTicket->d_tckt->SetValue("");
    $SDelTicket->Errors->addError("Record successfully deleted!");
// -------------------------
//End Custom Code

//Close RDelTicket_ds_AfterExecuteDelete @5-F2A6D23A
    return $RDelTicket_ds_AfterExecuteDelete;
}
//End Close RDelTicket_ds_AfterExecuteDelete

//GTickets_smart_ticket_TotalRecords_BeforeShow @27-542BE5FC
function GTickets_smart_ticket_TotalRecords_BeforeShow(& $sender)
{
    $GTickets_smart_ticket_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTickets; //Compatibility
//End GTickets_smart_ticket_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GTickets_smart_ticket_TotalRecords_BeforeShow @27-EA2F9534
    return $GTickets_smart_ticket_TotalRecords_BeforeShow;
}
//End Close GTickets_smart_ticket_TotalRecords_BeforeShow

//GTickets_BeforeShowRow @26-4BB6F761
function GTickets_BeforeShowRow(& $sender)
{
    $GTickets_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTickets, $DBSMART,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GTickets_BeforeShowRow

//Set Row Style @53-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @54-2A29BDB7
// -------------------------
	$dateStart = $GTickets->tckt_date->GetValue();
    $GTickets->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	$GTickets->tckt_severity->SetValue(GetCodeDescription("tcktseverity", $GTickets->tckt_severity->GetValue()));
	
	if($GTickets->tckt_status->GetValue()<7) {
		$age = CountingPeriod(time(), $dateStart[0]);
		$GTickets->tckt_age->SetValue("<font color=red><b>".$age."</b></font>");
	} else {
		$dateEnd = $GTickets->tckt_c_date->GetValue();
		$age = CountingPeriod($dateEnd[0], $dateStart[0]);
		$GTickets->tckt_age->SetValue($age);
	}

	$checkEng = CCDLookUp("max(task_updatedeng)","smart_task","ticket_id=".$GTickets->id->GetValue(), $DBSMART);
	if($checkEng > 0) {
		$latestEng = $checkEng;
	} else {
		$latestEng = CCDLookUp("task_currenteng","smart_task","ticket_id=".$GTickets->id->GetValue(), $DBSMART);
		
	}
	
	$GTickets->tcktEng->SetValue(CCDLookUp("usr_username","smart_user","id=".$latestEng,$DBSMART));
	$GTickets->tckt_status->SetValue("<b>".GetCodeDescription("tcktstatus", $GTickets->tckt_status->GetValue())."</b>");
	switch(CCGetSession("GroupID")) {
		case 1: 
		case 5:
			$GTickets->tckt_refnumber->SetLink("../ticketdetails.php?id=".$GTickets->id->GetValue());
		break;
		default: 
			$GTickets->tckt_refnumber->SetLink("../vticketdetails.php?id=".$GTickets->id->GetValue());
		break;
	}
// -------------------------
//End Custom Code

//Close GTickets_BeforeShowRow @26-3564B12C
    return $GTickets_BeforeShowRow;
}
//End Close GTickets_BeforeShowRow

//GTickets_BeforeShow @26-4CC99AF9
function GTickets_BeforeShow(& $sender)
{
    $GTickets_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTickets,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GTickets_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
    if($GTickets->PageNumber != null){
		$PageFirstRecordNo = ($GTickets->PageSize * ($GTickets->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GTickets->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GTickets->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GTickets_BeforeShow @26-CD82958C
    return $GTickets_BeforeShow;
}
//End Close GTickets_BeforeShow

//RRefGenerator_BeforeShow @65-5D78A97C
function RRefGenerator_BeforeShow(& $sender)
{
    $RRefGenerator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RRefGenerator; //Compatibility
//End RRefGenerator_BeforeShow

//Custom Code @79-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close RRefGenerator_BeforeShow @65-2904D29A
    return $RRefGenerator_BeforeShow;
}
//End Close RRefGenerator_BeforeShow

//RRefGenerator_ds_BeforeBuildSelect @65-86A76E0A
function RRefGenerator_ds_BeforeBuildSelect(& $sender)
{
    $RRefGenerator_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RRefGenerator; //Compatibility
//End RRefGenerator_ds_BeforeBuildSelect

//Custom Code @80-2A29BDB7
// -------------------------
    //$RRefGenerator->DataSource->Where .= "
// -------------------------
//End Custom Code

//Close RRefGenerator_ds_BeforeBuildSelect @65-EDA584BB
    return $RRefGenerator_ds_BeforeBuildSelect;
}
//End Close RRefGenerator_ds_BeforeBuildSelect

//GRefGenerator_BeforeShowRow @83-FE29F061
function GRefGenerator_BeforeShowRow(& $sender)
{
    $GRefGenerator_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GRefGenerator; //Compatibility
//End GRefGenerator_BeforeShowRow

//Set Row Style @84-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close GRefGenerator_BeforeShowRow @83-248DA72D
    return $GRefGenerator_BeforeShowRow;
}
//End Close GRefGenerator_BeforeShowRow

//Page_AfterInitialize @1-CD58173A
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmTicMngmt, $GTickets, $SDelTicket, $RDelTicket, $RRefGenerator, $GRefGenerator; //Compatibility
//End Page_AfterInitialize

//Custom Code @23-2A29BDB7
// -------------------------
	$RDelTicket->Visible = false;
	$SDelTicket->Visible = false;
	$GTickets->Visible = false;
	$RRefGenerator->Visible = false;
	$GRefGenerator->Visible = false;
    if(CCGetParam("del")!=null) {
		$SDelTicket->Visible = true;
	} elseif(CCGetParam("d_tckt") != null) {
		$SDelTicket->Visible = true;
		$RDelTicket->Visible = true;
	} elseif(CCGetParam("refgen")!=null && CCGetParam("id")==null) {
		$GRefGenerator->Visible = true;
		$RRefGenerator->Visible = true;
	} elseif((CCGetParam("refgen")!=null && CCGetParam("id")!=null) || (CCGetParam("refgen")!=null && CCGetParam("new")==1)) {
		$GRefGenerator->Visible = true;
		$RRefGenerator->Visible = true;
	} else {
		$GTickets->Visible = true;
	}	
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
