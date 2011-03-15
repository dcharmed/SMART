<?php
//BindEvents Method @1-C0A47854
function BindEvents()
{
    global $smart_ticket;
    global $GResNote;
    global $RResNote;
    global $Panel1;
    global $smart_task;
    global $Panel2;
    global $CCSEvents;
    $smart_ticket->tckt_branch->CCSEvents["BeforeShow"] = "smart_ticket_tckt_branch_BeforeShow";
    $smart_ticket->tckt_related->CCSEvents["BeforeShow"] = "smart_ticket_tckt_related_BeforeShow";
    $smart_ticket->tckt_toppanid->CCSEvents["BeforeShow"] = "smart_ticket_tckt_toppanid_BeforeShow";
    $smart_ticket->tckt_subcat->CCSEvents["BeforeShow"] = "smart_ticket_tckt_subcat_BeforeShow";
    $smart_ticket->CCSEvents["BeforeShow"] = "smart_ticket_BeforeShow";
    $smart_ticket->ds->CCSEvents["AfterExecuteInsert"] = "smart_ticket_ds_AfterExecuteInsert";
    $smart_ticket->CCSEvents["AfterInsert"] = "smart_ticket_AfterInsert";
    $smart_ticket->CCSEvents["AfterUpdate"] = "smart_ticket_AfterUpdate";
    $smart_ticket->ds->CCSEvents["BeforeBuildInsert"] = "smart_ticket_ds_BeforeBuildInsert";
    $smart_ticket->CCSEvents["BeforeInsert"] = "smart_ticket_BeforeInsert";
    $GResNote->CCSEvents["BeforeShowRow"] = "GResNote_BeforeShowRow";
    $GResNote->ds->CCSEvents["BeforeBuildSelect"] = "GResNote_ds_BeforeBuildSelect";
    $GResNote->CCSEvents["BeforeShow"] = "GResNote_BeforeShow";
    $RResNote->Button_Insert->CCSEvents["OnClick"] = "RResNote_Button_Insert_OnClick";
    $RResNote->CCSEvents["BeforeShow"] = "RResNote_BeforeShow";
    $RResNote->CCSEvents["AfterInsert"] = "RResNote_AfterInsert";
    $RResNote->ds->CCSEvents["AfterExecuteInsert"] = "RResNote_ds_AfterExecuteInsert";
    $RResNote->CCSEvents["AfterUpdate"] = "RResNote_AfterUpdate";
    $RResNote->ds->CCSEvents["AfterExecuteUpdate"] = "RResNote_ds_AfterExecuteUpdate";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $smart_task->task_newstatus->ds->CCSEvents["BeforeBuildSelect"] = "smart_task_task_newstatus_ds_BeforeBuildSelect";
    $smart_task->CCSEvents["BeforeShow"] = "smart_task_BeforeShow";
    $smart_task->CCSEvents["AfterInsert"] = "smart_task_AfterInsert";
    $smart_task->CCSEvents["AfterUpdate"] = "smart_task_AfterUpdate";
    $smart_task->ds->CCSEvents["BeforeBuildSelect"] = "smart_task_ds_BeforeBuildSelect";
    $smart_task->ds->CCSEvents["BeforeBuildUpdate"] = "smart_task_ds_BeforeBuildUpdate";
    $smart_task->CCSEvents["BeforeUpdate"] = "smart_task_BeforeUpdate";
    $Panel2->CCSEvents["BeforeShow"] = "Panel2_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//DEL  function smart_ticket_Button_Cancel_OnClick(& $sender)
//DEL  {
//DEL      $smart_ticket_Button_Cancel_OnClick = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $smart_ticket, $Redirect; //Compatibility


//DEL  // -------------------------
//DEL      $Redirect = "ticketlist.php";
//DEL  // -------------------------

//smart_ticket_tckt_branch_BeforeShow @14-7257B49F
function smart_ticket_tckt_branch_BeforeShow(& $sender)
{
    $smart_ticket_tckt_branch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_tckt_branch_BeforeShow

//Close smart_ticket_tckt_branch_BeforeShow @14-D606F034
    return $smart_ticket_tckt_branch_BeforeShow;
}
//End Close smart_ticket_tckt_branch_BeforeShow

//smart_ticket_tckt_related_BeforeShow @78-DC1BD0D9
function smart_ticket_tckt_related_BeforeShow(& $sender)
{
    $smart_ticket_tckt_related_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_tckt_related_BeforeShow

//Close smart_ticket_tckt_related_BeforeShow @78-DEDD40E0
    return $smart_ticket_tckt_related_BeforeShow;
}
//End Close smart_ticket_tckt_related_BeforeShow

//smart_ticket_tckt_toppanid_BeforeShow @373-C7A4836B
function smart_ticket_tckt_toppanid_BeforeShow(& $sender)
{
    $smart_ticket_tckt_toppanid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_tckt_toppanid_BeforeShow

//Close smart_ticket_tckt_toppanid_BeforeShow @373-E250960C
    return $smart_ticket_tckt_toppanid_BeforeShow;
}
//End Close smart_ticket_tckt_toppanid_BeforeShow

//smart_ticket_tckt_subcat_BeforeShow @149-5AF4AA9C
function smart_ticket_tckt_subcat_BeforeShow(& $sender)
{
    $smart_ticket_tckt_subcat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_tckt_subcat_BeforeShow

//Close smart_ticket_tckt_subcat_BeforeShow @149-4D99440F
    return $smart_ticket_tckt_subcat_BeforeShow;
}
//End Close smart_ticket_tckt_subcat_BeforeShow

//smart_ticket_BeforeShow @5-5C5B41F4
function smart_ticket_BeforeShow(& $sender)
{
    $smart_ticket_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket, $DBSMART; //Compatibility
//End smart_ticket_BeforeShow

//Custom Code @113-2A29BDB7	
// -------------------------
    
	if (CCGetParam("id") == null) CCSetSession("tcktid","");
	if(CCGetFromGet("id")==null) {
		$tempIdForRefNumber = GetAutoGenerateTicket(date('Y'));
		$sitecodes = substr($smart_ticket->tckt_branch->GetValue(),0,1);
		$tempRefNumber = date('y').date('m')."-".$tempIdForRefNumber;
		if($smart_ticket->tckt_branch->GetValue()!=null) {
			if(substr($smart_ticket->tckt_branch->GetValue(),0,1) == "X") {
				$tempRefNumber .= "(O)";
			} else {
				$tempRefNumber .= "(L)";
			}
		}
		$smart_ticket->tckt_refnumber->SetValue($tempRefNumber);
		$smart_ticket->lblNoteRef->SetValue("Please notes that the Ref. Number might be changed upon submission.");
	} else {
		CCSetSession("tcktid",CCGetParam("id"));
		$checkEng = CCDLookUp("max(task_updatedeng)","smart_task","ticket_id=".CCGetParam("id"), $DBSMART);
		if($checkEng == 0) {
			$latestEng = CCDLookUp("task_currenteng","smart_task","ticket_id=".CCGetParam("id"), $DBSMART);
		} else {
			$latestEng = $checkEng;
		}
		$smart_ticket->tckt_engineer->SetValue(CCDLookUp("usr_username","smart_user","id=".$latestEng,$DBSMART));
	}
	
	$smart_ticket->tckt_status->SetValue($smart_ticket->hid_status->GetValue());
	$smart_ticket->EditStatus->Visible = $smart_ticket->EditMode;

	if($smart_ticket->bygroupid->GetValue() == 3 || $smart_ticket->bygroupid->GetValue() == 4) {
		$smart_ticket->byEngineer->Visible = true;
	} elseif($smart_ticket->bygroupid->GetValue()==6) {
		$smart_ticket->byadukom->Visible = true;
		$smart_ticket->byadukomid->Visible = true;
	}
	
	if($smart_ticket->bygroupid->GetValue() == null) $smart_ticket->bygroupid->SetValue(CCGetSession("GroupID"));
	if($smart_ticket->reportedby->GetValue() == null) { 
		$smart_ticket->reportedby->SetValue(CCGetSession("UserID"));
		$smart_ticket->helpdeskName->SetValue(CCGetSession("UserLogin"));
	} else {
		$smart_ticket->helpdeskName->SetValue(CCDLookUp("usr_username","smart_user","id=".$smart_ticket->reportedby->GetValue(),$DBSMART));
	}
	if($smart_ticket->tckt_status->GetValue() == 7) {
		$smart_ticket->closedreportedbyname->SetValue(CCDLookUp("usr_username","smart_user","id=".$smart_ticket->closedreportedbyid->GetValue(),$DBSMART));
		$smart_ticket->closedreportedbyid->Visible = true;
		$smart_ticket->closedreportedbyname->Visible = true;
		$smart_ticket->closedby->Visible = true;
		$smart_ticket->tckt_c_date->Visible = true;
		$smart_ticket->DatePicker_tckt_c_date->Visible = true;
		$smart_ticket->closedadukom->Visible = true;
		$smart_ticket->EditStatus->Visible = false;
	} else {
		$smart_ticket->closedreportedbyid->Visible = false;
		$smart_ticket->closedreportedbyname->Visible = false;
		$smart_ticket->closedby->Visible = false;
		$smart_ticket->tckt_c_date->Visible = false;
		$smart_ticket->DatePicker_tckt_c_date->Visible = false;
		$smart_ticket->closedadukom->Visible = false;
	}
// -------------------------
//End Custom Code

//Close smart_ticket_BeforeShow @5-1BC0D7FE
    return $smart_ticket_BeforeShow;
}
//End Close smart_ticket_BeforeShow

//smart_ticket_ds_AfterExecuteInsert @5-DB65D0EF
function smart_ticket_ds_AfterExecuteInsert(& $sender)
{
    $smart_ticket_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket, $Redirect, $FileName, $DBSMART, $idticket; //Compatibility
//End smart_ticket_ds_AfterExecuteInsert

//Custom Code @256-2A29BDB7
// -------------------------
	$yearTicket = substr($smart_ticket->tckt_refnumber->GetValue(), 0, 2);
	$qs = CCGetQueryString("QueryString","");
	$qs = CCRemoveParam($qs, "ccsForm"); //Never want this hanging around!
	$idticket = mysql_insert_id();
	$refnumber = CCDLookUp("tckt_refnumber","smart_ticket","id=".$idticket, $DBSMART);
	LogActivity(CCGetSession("UserLogin"),"ADD","".$refnumber."","Successfully Added New Ticket",date('Y-m-d H:i:s'));
	UpdateAutoGenerateTicket("20".$yearTicket);
	echo "<script>alert('Your ticket: #".$refnumber." has successfully created')</script>";
	die("<script>window.location='ticketdetails.php?id=".$idticket."';</script>");
	
	//$Redirect = $FileName . "?id=" . $id;
// -------------------------
//End Custom Code

//Close smart_ticket_ds_AfterExecuteInsert @5-0A8605D7
    return $smart_ticket_ds_AfterExecuteInsert;
}
//End Close smart_ticket_ds_AfterExecuteInsert

//smart_ticket_AfterInsert @5-E94A986C
function smart_ticket_AfterInsert(& $sender)
{
    $smart_ticket_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_AfterInsert

//Custom Code @333-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close smart_ticket_AfterInsert @5-23B32503
    return $smart_ticket_AfterInsert;
}
//End Close smart_ticket_AfterInsert

//smart_ticket_AfterUpdate @5-98DA888A
function smart_ticket_AfterUpdate(& $sender)
{
    $smart_ticket_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_AfterUpdate

//Custom Code @340-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".$smart_ticket->tckt_refnumber->GetValue()."","Successfully Update Ticket",date('Y-m-d H:i:s'));
	$smart_ticket->Errors->addError("Ticket ".$smart_ticket->tckt_refnumber->GetValue()." is Updated!");
// -------------------------
//End Custom Code

//Close smart_ticket_AfterUpdate @5-EC9AE48C
    return $smart_ticket_AfterUpdate;
}
//End Close smart_ticket_AfterUpdate

//smart_ticket_ds_BeforeBuildInsert @5-3AB89028
function smart_ticket_ds_BeforeBuildInsert(& $sender)
{
    $smart_ticket_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_ds_BeforeBuildInsert

//Custom Code @381-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close smart_ticket_ds_BeforeBuildInsert @5-4B7761E5
    return $smart_ticket_ds_BeforeBuildInsert;
}
//End Close smart_ticket_ds_BeforeBuildInsert

//smart_ticket_BeforeInsert @5-5023E1B8
function smart_ticket_BeforeInsert(& $sender)
{
    $smart_ticket_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_ticket; //Compatibility
//End smart_ticket_BeforeInsert

//Custom Code @382-2A29BDB7
// -------------------------
    $tempIdForRefNumber = GetAutoGenerateTicket(date('Y'));
	$sitecodes = substr($smart_ticket->tckt_branch->GetValue(),0,1);
	$tempRefNumber = date('y').date('m')."-".$tempIdForRefNumber;
	if($smart_ticket->tckt_branch->GetValue()!=null) {
		if($sitecodes == "X") {
			$tempRefNumber .= "(O)";
		} else {
			$tempRefNumber .= "(L)";
		}
	}
	$smart_ticket->tckt_refnumber->SetValue($tempRefNumber);

// -------------------------
//End Custom Code

//Close smart_ticket_BeforeInsert @5-C8055221
    return $smart_ticket_BeforeInsert;
}
//End Close smart_ticket_BeforeInsert


//GResNote_BeforeShowRow @158-62474BB7
function GResNote_BeforeShowRow(& $sender)
{
    $GResNote_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote; //Compatibility
//End GResNote_BeforeShowRow

//Set Row Style @167-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @290-2A29BDB7
// -------------------------
	if($GResNote->rsltn_type->GetValue() == "SN") $GResNote->rsltn_date->SetLink("ticketdetails.php?id=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue());
	elseif($GResNote->rsltn_type->GetValue() == "CM") $GResNote->rsltn_date->SetLink("cmactivity.php?tcktid=".CCGetFromGet("id")."&rid=".$GResNote->rsltn_id->GetValue());
// -------------------------
//End Custom Code

//Close GResNote_BeforeShowRow @158-8AAED1AF
    return $GResNote_BeforeShowRow;
}
//End Close GResNote_BeforeShowRow

//GResNote_ds_BeforeBuildSelect @158-753403E2
function GResNote_ds_BeforeBuildSelect(& $sender)
{
    $GResNote_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote; //Compatibility
//End GResNote_ds_BeforeBuildSelect

//Custom Code @263-2A29BDB7
// -------------------------
    if(CCGetFromGet("id")== null) $GResNote->DataSource->Where .= "ticket_id=0";
	else $GResNote->DataSource->Where .= "ticket_id=".CCGetFromGet("id");

// -------------------------
//End Custom Code

//Close GResNote_ds_BeforeBuildSelect @158-48E34400
    return $GResNote_ds_BeforeBuildSelect;
}
//End Close GResNote_ds_BeforeBuildSelect

//GResNote_BeforeShow @158-8D7DC45F
function GResNote_BeforeShow(& $sender)
{
    $GResNote_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GResNote, $DBSMART; //Compatibility
//End GResNote_BeforeShow

//Custom Code @303-2A29BDB7
// -------------------------
	
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

//Close GResNote_BeforeShow @158-370557A6
    return $GResNote_BeforeShow;
}
//End Close GResNote_BeforeShow

//RResNote_Button_Insert_OnClick @266-79BCCF78
function RResNote_Button_Insert_OnClick(& $sender)
{
    $RResNote_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote, $Redirect; //Compatibility
//End RResNote_Button_Insert_OnClick

//Custom Code @287-2A29BDB7
// -------------------------
    $Redirect = "ticketdetails.php?id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close RResNote_Button_Insert_OnClick @266-5262583B
    return $RResNote_Button_Insert_OnClick;
}
//End Close RResNote_Button_Insert_OnClick

//RResNote_BeforeShow @95-F3E14CBA
function RResNote_BeforeShow(& $sender)
{
    $RResNote_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote, $DBSMART; //Compatibility
//End RResNote_BeforeShow

//Custom Code @284-2A29BDB7
// -------------------------
    if($RResNote->ticket_id->GetValue() == null) $RResNote->ticket_id->SetValue(CCGetFromGet("id"));
	if($RResNote->rsltn_byuser->GetValue()==null) { 
		$RResNote->engName->SetValue(CCGetSession("UserLogin"));
		$RResNote->rsltn_byuser->SetValue(CCGetSession("UserID"));
	} else {
		$RResNote->engName->SetValue(CCDLookUp("usr_username","smart_user","id=".$RResNote->rsltn_byuser->GetValue(),$DBSMART));
	}
// -------------------------
//End Custom Code

//Close RResNote_BeforeShow @95-F1C2C26F
    return $RResNote_BeforeShow;
}
//End Close RResNote_BeforeShow

//RResNote_AfterInsert @95-718CE0E6
function RResNote_AfterInsert(& $sender)
{
    $RResNote_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote; //Compatibility
//End RResNote_AfterInsert

//Custom Code @341-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close RResNote_AfterInsert @95-A45184C4
    return $RResNote_AfterInsert;
}
//End Close RResNote_AfterInsert

//RResNote_ds_AfterExecuteInsert @95-427467F4
function RResNote_ds_AfterExecuteInsert(& $sender)
{
    $RResNote_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote; //Compatibility
//End RResNote_ds_AfterExecuteInsert

//Custom Code @342-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',$RResNote->ticket_id->GetValue(),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD",$refnumber,"Successfully Added New Support Note",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RResNote_ds_AfterExecuteInsert @95-EF7E70C0
    return $RResNote_ds_AfterExecuteInsert;
}
//End Close RResNote_ds_AfterExecuteInsert

//RResNote_AfterUpdate @95-06C89FC0
function RResNote_AfterUpdate(& $sender)
{
    $RResNote_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote; //Compatibility
//End RResNote_AfterUpdate

//Custom Code @343-2A29BDB7
// -------------------------
    $RResNote->Errors->addError("SN HAS SUCCESSFULLY UPDATED");
// -------------------------
//End Custom Code

//Close RResNote_AfterUpdate @95-6B78454B
    return $RResNote_AfterUpdate;
}
//End Close RResNote_AfterUpdate

//RResNote_ds_AfterExecuteUpdate @95-BDE12F33
function RResNote_ds_AfterExecuteUpdate(& $sender)
{
    $RResNote_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RResNote; //Compatibility
//End RResNote_ds_AfterExecuteUpdate

//Custom Code @344-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".GetCodeFromSingleTable('smart_ticket',$RResNote->ticket_id->GetValue(),'tckt_refnumber')."","Successfully Updates Support Note",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RResNote_ds_AfterExecuteUpdate @95-2057B14F
    return $RResNote_ds_AfterExecuteUpdate;
}
//End Close RResNote_ds_AfterExecuteUpdate

//Panel1_BeforeShow @111-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel1 Page BeforeShow @112-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel1 Page BeforeShow

//Close Panel1_BeforeShow @111-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//smart_task_task_newstatus_ds_BeforeBuildSelect @94-F25ED59B
function smart_task_task_newstatus_ds_BeforeBuildSelect(& $sender)
{
    $smart_task_task_newstatus_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task, $DBSMART; //Compatibility
//End smart_task_task_newstatus_ds_BeforeBuildSelect

//Custom Code @231-2A29BDB7
// -------------------------
	$currstatus = CCDLookUp("tckt_status","smart_ticket","id=".CCGetParam("id"),$DBSMART);
    $smart_task->task_newstatus->DataSource->Where = " ref_type='tcktstatus' AND ref_value >=".$currstatus;
// -------------------------
//End Custom Code

//Close smart_task_task_newstatus_ds_BeforeBuildSelect @94-B3546918
    return $smart_task_task_newstatus_ds_BeforeBuildSelect;
}
//End Close smart_task_task_newstatus_ds_BeforeBuildSelect

//smart_task_BeforeShow @90-020263EE
function smart_task_BeforeShow(& $sender)
{
    $smart_task_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task, $DBSMART; //Compatibility
//End smart_task_BeforeShow

//Custom Code @109-2A29BDB7
// -------------------------
    $currstatus = CCDLookUp("tckt_status","smart_ticket","id=".CCGetParam("id"),$DBSMART);
	$smart_task->currentstatus->SetValue(GetCodeDescription("tcktstatus",$currstatus));
	$smart_task->task_currentstatus->SetValue($currstatus);
	$smart_task->ticket_id->SetValue(CCGetFromGet("id"));
	$smart_task->datemodified->SetValue(date('Y-m-d H:i:s'));
	
// -------------------------
//End Custom Code

//Close smart_task_BeforeShow @90-6501638C
    return $smart_task_BeforeShow;
}
//End Close smart_task_BeforeShow

//smart_task_AfterInsert @90-11D10580
function smart_task_AfterInsert(& $sender)
{
    $smart_task_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task; //Compatibility
//End smart_task_AfterInsert

//Custom Code @31-2A29BDB7
// -------------------------
	$tcktStatus = $smart_task->task_newstatus->GetValue();
	$tcktByUser = $smart_task->task_personincharge->GetValue();
	$tcktAdukom = $smart_task->task_adukomid->GetValue();
	$tcktDate = $smart_task->datemodified->GetValue();
	$tcktHelpdesk = $smart_task->closedby->GetValue();

	$arrFieldValue = array($tcktStatus,$tcktByUser,$tcktAdukom,$tcktDate,$tcktHelpdesk);
	SetStatusTicket($arrFieldValue,$smart_task->ticket_id->GetValue());
// -------------------------
//End Custom Code

//Close smart_task_AfterInsert @90-9DC6F4A7
    return $smart_task_AfterInsert;
}
//End Close smart_task_AfterInsert

//smart_task_AfterUpdate @90-5F0E1A5B
function smart_task_AfterUpdate(& $sender)
{
    $smart_task_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task, $DBSMART; //Compatibility
//End smart_task_AfterUpdate

//Custom Code @241-2A29BDB7
// -------------------------
	$ticket_id = mysql_real_escape_string($smart_task->ticket_id->GetValue());
	$task_newstatus = mysql_real_escape_string($smart_task->task_newstatus->GetValue());
	$task_pic = mysql_real_escape_string($smart_task->task_personincharge->GetValue());
	$task_spic = $smart_task->task_secpersonincharge->GetValue();
	$task_adukomid = $smart_task->task_adukomid->GetValue();
	$task_oldstatus = $smart_task->task_currentstatus->GetValue();
	$datemodified = $smart_task->datemodified->GetValue();
	$notes = $smart_task->Reason->GetValue();

	$dbupd = new clsDBSMART() ;
	if($task_newstatus == 2 || $task_newstatus == 3) {
	    $sqlupd = "INSERT INTO smart_task(ticket_id, task_update, task_currenteng, task_updatedeng, task_current, task_notes, datemodified)";
		$sqlupd .= " VALUES ('".$ticket_id."', '".$task_newstatus."', '".$task_pic."', '".$task_spic."', '".$task_oldstatus."', '".$notes."', '".$datemodified."')";
		$dbupd->query($sqlupd);
	} elseif($task_oldstatus == 1 && $task_newstatus == 7) {
		$sqlupd = "INSERT INTO smart_task(ticket_id, task_status, task_update, task_currenteng, task_updatedeng, task_current, task_notes, datemodified)";
		$sqlupd .= " VALUES ('".$ticket_id."', '1', '".$task_newstatus."', '".CCGetSession("UserID")."', '', '".$task_oldstatus."', '".$notes."', '".$datemodified."')";
		$dbupd->query($sqlupd);
	}
	LogActivity(CCGetSession("UserLogin"),"UPDATE","".GetCodeFromSingleTable('smart_ticket',$smart_task->ticket_id->GetValue(),'tckt_refnumber')."","Successfully Updates Status From ".$task_oldstatus." to ".$task_newstatus,date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_task_AfterUpdate @90-52EF3528
    return $smart_task_AfterUpdate;
}
//End Close smart_task_AfterUpdate

//smart_task_ds_BeforeBuildSelect @90-F4D4DEB2
function smart_task_ds_BeforeBuildSelect(& $sender)
{
    $smart_task_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task; //Compatibility
//End smart_task_ds_BeforeBuildSelect

//Custom Code @330-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close smart_task_ds_BeforeBuildSelect @90-5341B0A3
    return $smart_task_ds_BeforeBuildSelect;
}
//End Close smart_task_ds_BeforeBuildSelect

//smart_task_ds_BeforeBuildUpdate @90-7605A825
function smart_task_ds_BeforeBuildUpdate(& $sender)
{
    $smart_task_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task; //Compatibility
//End smart_task_ds_BeforeBuildUpdate

//Custom Code @366-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close smart_task_ds_BeforeBuildUpdate @90-69318881
    return $smart_task_ds_BeforeBuildUpdate;
}
//End Close smart_task_ds_BeforeBuildUpdate

//smart_task_BeforeUpdate @90-F77FFA19
function smart_task_BeforeUpdate(& $sender)
{
    $smart_task_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_task; //Compatibility
//End smart_task_BeforeUpdate

//Custom Code @368-2A29BDB7
// -------------------------
    if($smart_task->task_newstatus->GetValue() == 7 && $smart_task->closedby->GetValue()==null) {
	 
		$smart_task->tckt_closeddate->SetValue(date('Y-m-d H:i:s'));
		$smart_task->closedby->SetValue(CCGetSession("UserID"));
	}
// -------------------------
//End Custom Code

//Close smart_task_BeforeUpdate @90-D629818E
    return $smart_task_BeforeUpdate;
}
//End Close smart_task_BeforeUpdate

//Panel2_BeforeShow @114-96696C3D
function Panel2_BeforeShow(& $sender)
{
    $Panel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel2; //Compatibility
//End Panel2_BeforeShow

//Panel2UpdatePanel Page BeforeShow @115-CC9B4012
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel2") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel2\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Panel2_BeforeShow @114-AE7F9FB3
    return $Panel2_BeforeShow;
}
//End Close Panel2_BeforeShow

//Page_AfterInitialize @1-22644E30
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketdetails, $smart_resolutionnote, $smart_ticket, $Redirect; //Compatibility
//End Page_AfterInitialize

//Custom Code @339-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-3AD277B3
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketdetails; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @379-4DEF2727
    if ('Panel1smart_tickettckt_toppanidPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @379-90D275D0
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_eqtoppan {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @379-5BB2EA68
        $Service->AddDataSourceField('eqtop_serialnumber',ccsText,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @379-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @379-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//Panel1UpdatePanel1 PageBeforeInitialize @112-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel1 PageBeforeInitialize

//Panel2UpdatePanel PageBeforeInitialize @115-5E181320
    if (CCGetFromGet("FormFilter") == "Panel2" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel2UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-CE0CE956
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketdetails; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel1 Page BeforeShow @112-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel1 Page BeforeShow

//Panel2UpdatePanel Page BeforeShow @115-4589DE7C
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel2") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-A7F1CC50
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketdetails; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel1 PageBeforeOutput @112-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel1 PageBeforeOutput

//Panel2UpdatePanel PageBeforeOutput @115-AE056578
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel2") {
        $main_block = $Tpl->getvar("/Panel Panel2");
    }
//End Panel2UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-968A3C46
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ticketdetails; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel1 PageBeforeUnload @112-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel1 PageBeforeUnload

//Panel2UpdatePanel PageBeforeUnload @115-A0E8F191
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel2") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel2UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
