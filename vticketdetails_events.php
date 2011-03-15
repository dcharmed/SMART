<?php
//BindEvents Method @1-025DF565
function BindEvents()
{
    global $RSmartTicket;
    global $smart_resolutionnote;
    global $resnoteview;
    global $GResNote;
    global $CCSEvents;
    $RSmartTicket->tckt_branch->CCSEvents["BeforeShow"] = "RSmartTicket_tckt_branch_BeforeShow";
    $RSmartTicket->tckt_related->CCSEvents["BeforeShow"] = "RSmartTicket_tckt_related_BeforeShow";
    $RSmartTicket->tckt_subcat->CCSEvents["BeforeShow"] = "RSmartTicket_tckt_subcat_BeforeShow";
    $RSmartTicket->CCSEvents["BeforeShow"] = "RSmartTicket_BeforeShow";
    $smart_resolutionnote->CCSEvents["BeforeShow"] = "smart_resolutionnote_BeforeShow";
    $smart_resolutionnote->CCSEvents["AfterUpdate"] = "smart_resolutionnote_AfterUpdate";
    $smart_resolutionnote->ds->CCSEvents["AfterExecuteUpdate"] = "smart_resolutionnote_ds_AfterExecuteUpdate";
    $smart_resolutionnote->ds->CCSEvents["AfterExecuteInsert"] = "smart_resolutionnote_ds_AfterExecuteInsert";
    $resnoteview->CCSEvents["BeforeShow"] = "resnoteview_BeforeShow";
    $GResNote->CCSEvents["BeforeShowRow"] = "GResNote_BeforeShowRow";
    $GResNote->ds->CCSEvents["BeforeBuildSelect"] = "GResNote_ds_BeforeBuildSelect";
    $GResNote->CCSEvents["BeforeShow"] = "GResNote_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method


//RSmartTicket_tckt_branch_BeforeShow @51-316D2E76
function RSmartTicket_tckt_branch_BeforeShow(& $sender)
{
    $RSmartTicket_tckt_branch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTicket; //Compatibility
//End RSmartTicket_tckt_branch_BeforeShow

//Close RSmartTicket_tckt_branch_BeforeShow @51-78A93F0A
    return $RSmartTicket_tckt_branch_BeforeShow;
}
//End Close RSmartTicket_tckt_branch_BeforeShow

//RSmartTicket_tckt_related_BeforeShow @55-34214E91
function RSmartTicket_tckt_related_BeforeShow(& $sender)
{
    $RSmartTicket_tckt_related_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTicket; //Compatibility
//End RSmartTicket_tckt_related_BeforeShow

//Close RSmartTicket_tckt_related_BeforeShow @55-1F12F284
    return $RSmartTicket_tckt_related_BeforeShow;
}
//End Close RSmartTicket_tckt_related_BeforeShow

//RSmartTicket_tckt_subcat_BeforeShow @64-19CE3075
function RSmartTicket_tckt_subcat_BeforeShow(& $sender)
{
    $RSmartTicket_tckt_subcat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTicket; //Compatibility
//End RSmartTicket_tckt_subcat_BeforeShow

//Close RSmartTicket_tckt_subcat_BeforeShow @64-E3368B31
    return $RSmartTicket_tckt_subcat_BeforeShow;
}
//End Close RSmartTicket_tckt_subcat_BeforeShow

//RSmartTicket_BeforeShow @5-E23CDA53
function RSmartTicket_BeforeShow(& $sender)
{
    $RSmartTicket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartTicket, $DBSMART; //Compatibility
//End RSmartTicket_BeforeShow

//Custom Code @70-2A29BDB7
// -------------------------
	if($RSmartTicket->byusergroup->GetValue() == 3 || $RSmartTicket->byusergroup->GetValue() == 4) {
		$RSmartTicket->byEngineer->Visible = true;
	} elseif($RSmartTicket->byusergroup->GetValue()==6) {
		$RSmartTicket->byadukom->Visible = true;
		$RSmartTicket->byadukomid->Visible = true;
	}
	$RSmartTicket->tckt_status->SetValue(GetCodeDescription("tcktstatus",$RSmartTicket->tckt_status->GetValue()));
	$RSmartTicket->tckt_method->SetValue(GetCodeDescription("rsltnmethod",$RSmartTicket->tckt_method->GetValue()));
	$RSmartTicket->helpdesk->SetValue(CCDLookUp("usr_username","smart_user","id=".$RSmartTicket->helpdesk->GetValue(),$DBSMART));
	$RSmartTicket->byusergroup->SetValue(GetCodeDescription("usrgroup",$RSmartTicket->byusergroup->GetValue()));
	$RSmartTicket->byEngineer->SetValue(CCDLookUp("usr_username","smart_user","id=".$RSmartTicket->byEngineer->GetValue(),$DBSMART));
	$RSmartTicket->closedreportedby->SetValue(CCDLookUp("usr_username","smart_user","id=".$RSmartTicket->closedreportedby->GetValue(),$DBSMART));

	$checkEng = CCDLookUp("max(task_updatedeng)","smart_task","ticket_id=".CCGetParam("id"), $DBSMART);
	if($checkEng == 0) {
		$latestEng = CCDLookUp("task_currenteng","smart_task","ticket_id=".CCGetParam("id"), $DBSMART);
	} else {
		$latestEng = $checkEng;
	}
	$RSmartTicket->tckt_engineer->SetValue(CCDLookUp("usr_username","smart_user","id=".$latestEng,$DBSMART));
// -------------------------
//End Custom Code

//Close RSmartTicket_BeforeShow @5-85B55B90
    return $RSmartTicket_BeforeShow;
}
//End Close RSmartTicket_BeforeShow

//smart_resolutionnote_BeforeShow @95-EDD9A9FC
function smart_resolutionnote_BeforeShow(& $sender)
{
    $smart_resolutionnote_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolutionnote, $DBSMART; //Compatibility
//End smart_resolutionnote_BeforeShow

//Custom Code @138-2A29BDB7
// -------------------------
    if($smart_resolutionnote->ticket_id->GetValue() == null) { 
		$smart_resolutionnote->ticket_id->SetValue(CCGetFromGet("id"));
		$smart_resolutionnote->engName->SetValue(CCGetSession("UserLogin"));
		$smart_resolutionnote->rsltn_byuser->SetValue(CCGetSession("UserID"));
	} else {
		$name = CCDLookUp("usr_fullname","smart_user","id=".$smart_resolutionnote->rsltn_byuser->GetValue(),$DBSMART);
		$smart_resolutionnote->engName->SetValue($name);
	}
// -------------------------
//End Custom Code

//Close smart_resolutionnote_BeforeShow @95-244C011B
    return $smart_resolutionnote_BeforeShow;
}
//End Close smart_resolutionnote_BeforeShow

//smart_resolutionnote_AfterUpdate @95-E4328FF0
function smart_resolutionnote_AfterUpdate(& $sender)
{
    $smart_resolutionnote_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolutionnote; //Compatibility
//End smart_resolutionnote_AfterUpdate

//Custom Code @165-2A29BDB7
// -------------------------
    $smart_resolutionnote->Errors->addError("SN HAS SUCCESSFULLY UPDATED");
// -------------------------
//End Custom Code

//Close smart_resolutionnote_AfterUpdate @95-3CC57EAD
    return $smart_resolutionnote_AfterUpdate;
}
//End Close smart_resolutionnote_AfterUpdate

//smart_resolutionnote_ds_AfterExecuteUpdate @95-F52B5D92
function smart_resolutionnote_ds_AfterExecuteUpdate(& $sender)
{
    $smart_resolutionnote_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolutionnote; //Compatibility
//End smart_resolutionnote_ds_AfterExecuteUpdate

//Custom Code @167-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".GetCodeFromSingleTable('smart_ticket',$smart_resolutionnote->ticket_id->GetValue(),'tckt_refnumber')."","Successfully Updates Support Note",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_resolutionnote_ds_AfterExecuteUpdate @95-1D4E8639
    return $smart_resolutionnote_ds_AfterExecuteUpdate;
}
//End Close smart_resolutionnote_ds_AfterExecuteUpdate

//smart_resolutionnote_ds_AfterExecuteInsert @95-45BF572F
function smart_resolutionnote_ds_AfterExecuteInsert(& $sender)
{
    $smart_resolutionnote_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolutionnote; //Compatibility
//End smart_resolutionnote_ds_AfterExecuteInsert

//Custom Code @168-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',$smart_resolutionnote->ticket_id->GetValue(),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD","".$refnumber."","Successfully Added New SN",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_resolutionnote_ds_AfterExecuteInsert @95-D26747B6
    return $smart_resolutionnote_ds_AfterExecuteInsert;
}
//End Close smart_resolutionnote_ds_AfterExecuteInsert

//DEL  function GResNote_BeforeShowRow(& $sender)
//DEL  {
//DEL      $GResNote_BeforeShowRow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $GResNote,$DBSMART; //Compatibility

//DEL  // -------------------------
//DEL  	if($GResNote->rsltn_type->GetValue() == "SN") $GResNote->rsltn_date->SetLink("vticketdetails.php?id=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue()."&uid=".CCDLookUp("rsltn_byuser","smart_resolutionnote","id=".$GResNote->rsltn_id->GetValue(), $DBSMART));
//DEL  	elseif($GResNote->rsltn_type->GetValue() == "CM") $GResNote->rsltn_date->SetLink("cmactivity.php?tcktid=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue());
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      if(CCGetFromGet("id")== null) $GResNote->DataSource->Where .= "ticket_id=0";
//DEL  	else $GResNote->DataSource->Where .= "ticket_id=".CCGetFromGet("id");
//DEL  
//DEL  // -------------------------

//DEL  function GResNote_BeforeShow(& $sender)
//DEL  {
//DEL      $GResNote_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $GResNote, $DBSMART; //Compatibility


//DEL  // -------------------------
//DEL  	
//DEL      if(CCGetFromGet("id")==null) {
//DEL  		$GResNote->ImageLink2->SetLink("#");
//DEL  		//$GResNote->ImageLink1->SetLink("#");
//DEL  	} else {
//DEL  		$GResNote->ImageLink2->SetLink("cmactivity.php?tcktid=".CCGetFromGet("id"));
//DEL  		$GResNote->lblTicketNumberResNote->SetValue(CCDLookUp("tckt_refnumber","smart_ticket","id=".CCGetFromGet("id"),$DBSMART));
//DEL  	}	
//DEL  // -------------------------

//resnoteview_BeforeShow @146-737BA559
function resnoteview_BeforeShow(& $sender)
{
    $resnoteview_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resnoteview, $DBSMART; //Compatibility
//End resnoteview_BeforeShow

//Custom Code @160-2A29BDB7
// -------------------------
    $name = CCDLookUp("usr_fullname","smart_user","id=".$resnoteview->rsltn_byuser->GetValue(),$DBSMART);
	$resnoteview->engName->SetValue($name);
	switch($resnoteview->rsltn_actionmethod->GetValue()) {
		case 1:
			$resnoteview->rsltn_actionmethod->SetValue("Call");
		break;
		case 2:
			$resnoteview->rsltn_actionmethod->SetValue("Visit Site");
		break;
		case 3:
			$resnoteview->rsltn_actionmethod->SetValue("Phone Call");
		break;
		default:
			$resnoteview->rsltn_actionmethod->SetValue("Others");
		break;
	}
	
// -------------------------
//End Custom Code

//Close resnoteview_BeforeShow @146-4782C24B
    return $resnoteview_BeforeShow;
}
//End Close resnoteview_BeforeShow

//GResNote_BeforeShowRow @177-62474BB7
function GResNote_BeforeShowRow(& $sender)
{
    $GResNote_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GResNote_BeforeShowRow

//Set Row Style @191-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @192-2A29BDB7
// -------------------------
	$GResNote->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	if($GResNote->rsltn_type->GetValue() == "SN") $GResNote->rsltn_date->SetLink("ticketdetails.php?id=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue());
	elseif($GResNote->rsltn_type->GetValue() == "CM") $GResNote->rsltn_date->SetLink("cmactivity.php?tcktid=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue());

	$GResNote->rsltn_eng->SetValue(CCDLookUp("usr_username","smart_user","id=".$GResNote->rsltn_eng->GetValue(),$DBSMART));
// -------------------------
//End Custom Code

//Close GResNote_BeforeShowRow @177-8AAED1AF
    return $GResNote_BeforeShowRow;
}
//End Close GResNote_BeforeShowRow

//GResNote_ds_BeforeBuildSelect @177-753403E2
function GResNote_ds_BeforeBuildSelect(& $sender)
{
    $GResNote_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote; //Compatibility
//End GResNote_ds_BeforeBuildSelect

//Custom Code @193-2A29BDB7
// -------------------------
    if(CCGetFromGet("id")== null) $GResNote->DataSource->Where .= "ticket_id=0";
	else $GResNote->DataSource->Where .= "ticket_id=".CCGetFromGet("id");

// -------------------------
//End Custom Code

//Close GResNote_ds_BeforeBuildSelect @177-48E34400
    return $GResNote_ds_BeforeBuildSelect;
}
//End Close GResNote_ds_BeforeBuildSelect

//GResNote_BeforeShow @177-8D7DC45F
function GResNote_BeforeShow(& $sender)
{
    $GResNote_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GResNote_BeforeShow

//Custom Code @194-2A29BDB7
// -------------------------
	if($GResNote->PageNumber != null){
		$PageFirstRecordNo = ($GResNote->PageSize * ($GResNote->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GResNote->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GResNote->lblNumber->SetValue($BilRekod);

    if(CCGetFromGet("id")==null) {
		$GResNote->ImageLink2->SetLink("#");
		//$GResNote->ImageLink1->SetLink("#");
	} else {
		//$GResNote->ImageLink1->SetLink("ticketdetails.php?newrs=1&id".CCGetFromGet("id"));
		$GResNote->ImageLink2->SetLink("cmactivity.php?tcktid=".CCGetFromGet("id"));
		$GResNote->lblTicketNumberResNote->SetValue(CCDLookUp("tckt_refnumber","smart_ticket","id=".CCGetFromGet("id"),$DBSMART));
	}	
// -------------------------
//End Custom Code

//Close GResNote_BeforeShow @177-370557A6
    return $GResNote_BeforeShow;
}
//End Close GResNote_BeforeShow

//Page_AfterInitialize @1-75E2B674
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $vticketdetails, $smart_resolutionnote, $resnoteview, $GResNote; //Compatibility
//End Page_AfterInitialize

//Custom Code @164-2A29BDB7
// -------------------------
	
	$resnoteview->Visible = false;
    if(CCGetParam("rid") !=null && CCGetParam("id")!=null && CCGetParam("uid")!=null) {
		if(CCGetParam("uid")!= CCGetSession("UserID")) {
			$smart_resolutionnote->Visible = false;
			$resnoteview->Visible = true;
		} 
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-014BD2D7
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $vticketdetails; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
