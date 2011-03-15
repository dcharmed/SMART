<?php
//BindEvents Method @1-B93B4E5A
function BindEvents()
{
    global $GEquipment;
    global $Panel1;
    global $smart_resolution;
    global $GMeasurement;
    global $Panel2;
    global $GSmartReplacement;
    global $RSmartReplacement;
    global $Panel3;
    global $Panel5;
    global $smart_attachment;
    global $CCSEvents;
    $GEquipment->ds->CCSEvents["BeforeBuildInsert"] = "GEquipment_ds_BeforeBuildInsert";
    $GEquipment->ds->CCSEvents["AfterExecuteInsert"] = "GEquipment_ds_AfterExecuteInsert";
    $GEquipment->ds->CCSEvents["AfterExecuteUpdate"] = "GEquipment_ds_AfterExecuteUpdate";
    $GEquipment->CCSEvents["BeforeShow"] = "GEquipment_BeforeShow";
    $GEquipment->CCSEvents["AfterSubmit"] = "GEquipment_AfterSubmit";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $smart_resolution->Button_Insert->CCSEvents["OnClick"] = "smart_resolution_Button_Insert_OnClick";
    $smart_resolution->CCSEvents["BeforeShow"] = "smart_resolution_BeforeShow";
    $smart_resolution->CCSEvents["AfterInsert"] = "smart_resolution_AfterInsert";
    $smart_resolution->CCSEvents["AfterUpdate"] = "smart_resolution_AfterUpdate";
    $smart_resolution->ds->CCSEvents["AfterExecuteInsert"] = "smart_resolution_ds_AfterExecuteInsert";
    $smart_resolution->ds->CCSEvents["AfterExecuteUpdate"] = "smart_resolution_ds_AfterExecuteUpdate";
    $GMeasurement->ds->CCSEvents["BeforeBuildInsert"] = "GMeasurement_ds_BeforeBuildInsert";
    $GMeasurement->ds->CCSEvents["AfterExecuteInsert"] = "GMeasurement_ds_AfterExecuteInsert";
    $GMeasurement->ds->CCSEvents["AfterExecuteUpdate"] = "GMeasurement_ds_AfterExecuteUpdate";
    $GMeasurement->CCSEvents["BeforeShow"] = "GMeasurement_BeforeShow";
    $GMeasurement->CCSEvents["AfterSubmit"] = "GMeasurement_AfterSubmit";
    $Panel2->CCSEvents["BeforeShow"] = "Panel2_BeforeShow";
    $GSmartReplacement->CCSEvents["BeforeShow"] = "GSmartReplacement_BeforeShow";
    $GSmartReplacement->CCSEvents["BeforeShowRow"] = "GSmartReplacement_BeforeShowRow";
    $RSmartReplacement->Button_Cancel->CCSEvents["OnClick"] = "RSmartReplacement_Button_Cancel_OnClick";
    $RSmartReplacement->CCSEvents["BeforeShow"] = "RSmartReplacement_BeforeShow";
    $RSmartReplacement->ds->CCSEvents["BeforeBuildInsert"] = "RSmartReplacement_ds_BeforeBuildInsert";
    $RSmartReplacement->ds->CCSEvents["BeforeBuildUpdate"] = "RSmartReplacement_ds_BeforeBuildUpdate";
    $RSmartReplacement->ds->CCSEvents["AfterExecuteInsert"] = "RSmartReplacement_ds_AfterExecuteInsert";
    $RSmartReplacement->ds->CCSEvents["AfterExecuteUpdate"] = "RSmartReplacement_ds_AfterExecuteUpdate";
    $Panel3->CCSEvents["BeforeShow"] = "Panel3_BeforeShow";
    $Panel5->CCSEvents["BeforeShow"] = "Panel5_BeforeShow";
    $smart_attachment->CCSEvents["BeforeShowRow"] = "smart_attachment_BeforeShowRow";
    $smart_attachment->ds->CCSEvents["BeforeBuildInsert"] = "smart_attachment_ds_BeforeBuildInsert";
    $smart_attachment->CCSEvents["BeforeShow"] = "smart_attachment_BeforeShow";
    $smart_attachment->ds->CCSEvents["AfterExecuteInsert"] = "smart_attachment_ds_AfterExecuteInsert";
    $smart_attachment->ds->CCSEvents["AfterExecuteUpdate"] = "smart_attachment_ds_AfterExecuteUpdate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//GEquipment_ds_BeforeBuildInsert @221-930220AE
function GEquipment_ds_BeforeBuildInsert(& $sender)
{
    $GEquipment_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_BeforeBuildInsert

//Custom Code @229-2A29BDB7
// -------------------------
    $GEquipment->ds->resolution_id->SetValue(CCGetParam("rid"));
	$GEquipment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GEquipment_ds_BeforeBuildInsert @221-03DA642A
    return $GEquipment_ds_BeforeBuildInsert;
}
//End Close GEquipment_ds_BeforeBuildInsert

//GEquipment_ds_AfterExecuteInsert @221-CCA2AD0E
function GEquipment_ds_AfterExecuteInsert(& $sender)
{
    $GEquipment_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_AfterExecuteInsert

//Custom Code @230-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rid")."","Successfully Added Equipment Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GEquipment_ds_AfterExecuteInsert @221-011577F3
    return $GEquipment_ds_AfterExecuteInsert;
}
//End Close GEquipment_ds_AfterExecuteInsert

//GEquipment_ds_AfterExecuteUpdate @221-B6DA98D1
function GEquipment_ds_AfterExecuteUpdate(& $sender)
{
    $GEquipment_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_AfterExecuteUpdate

//Custom Code @231-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rid")."","Successfully Update Equipment Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GEquipment_ds_AfterExecuteUpdate @221-CE3CB67C
    return $GEquipment_ds_AfterExecuteUpdate;
}
//End Close GEquipment_ds_AfterExecuteUpdate

//GEquipment_BeforeShow @221-287B41AC
function GEquipment_BeforeShow(& $sender)
{
    $GEquipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_BeforeShow

//Custom Code @257-2A29BDB7
// -------------------------
    if(CCGetFromGet("rid")== null) $GEquipment->Button_Submit->Visible = false;
// -------------------------
//End Custom Code

//Close GEquipment_BeforeShow @221-587ACBE4
    return $GEquipment_BeforeShow;
}
//End Close GEquipment_BeforeShow

//GEquipment_AfterSubmit @221-16D0CE17
function GEquipment_AfterSubmit(& $sender)
{
    $GEquipment_AfterSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_AfterSubmit

//Custom Code @265-2A29BDB7
// -------------------------
    $GEquipment->Errors->addError("Details Updated!");
// -------------------------
//End Custom Code

//Close GEquipment_AfterSubmit @221-29D2C9D3
    return $GEquipment_AfterSubmit;
}
//End Close GEquipment_AfterSubmit

//Panel1_BeforeShow @5-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @6-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @5-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//smart_resolution_Button_Insert_OnClick @39-3B15FDCE
function smart_resolution_Button_Insert_OnClick(& $sender)
{
    $smart_resolution_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution; //Compatibility
//End smart_resolution_Button_Insert_OnClick

//Custom Code @40-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close smart_resolution_Button_Insert_OnClick @39-B2C9C6D8
    return $smart_resolution_Button_Insert_OnClick;
}
//End Close smart_resolution_Button_Insert_OnClick

//smart_resolution_BeforeShow @12-B0BC5238
function smart_resolution_BeforeShow(& $sender)
{
    $smart_resolution_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution, $DBSMART; //Compatibility
//End smart_resolution_BeforeShow

//Custom Code @67-2A29BDB7
// -------------------------
	$db = new clsDBSMART();
	$smart_resolution->ticket_id->SetValue(CCGetParam("tcktid"));
	$sql = "SELECT tckt_refnumber, tckt_toppanid, tckt_tagrelated, tckt_site, tckt_state, tckt_r_customer, tckt_r_customercontact, tckt_r_customercontact2, tckt_r_date, tckt_subcategory from smart_ticket where id=".CCGetParam("tcktid");
	$db->query($sql);
	
    $Result = $db->next_record();
    if ($Result) {
		$ticketnumber = $db->f("tckt_refnumber");
		$ticketstate = $db->f("tckt_state");
		$tickettoppan = $db->f("tckt_toppanid");
        $ticketsite = $db->f("tckt_site");
        $ticketdate = $db->f("tckt_r_date");
		$tickettagref = $db->f("tckt_subcategory");
		$tickettag = $db->f("tckt_tagrelated");
		$ticketcustomer = $db->f("tckt_r_customer");
		$ticketcustomercontact = $db->f("tckt_r_customercontact");
		$ticketcustomercontact2 = $db->f("tckt_r_customercontact2");
    }
	$smart_resolution->site->SetValue(GetCodeDescription($ticketstate,$ticketsite));
	$smart_resolution->ticketNumber->SetValue($ticketnumber);
	$smart_resolution->ticketRelated->SetValue(GetCodeDescription($tickettagref,$tickettag));
	$smart_resolution->ticketToppanid->SetValue($tickettoppan);
	$smart_resolution->rsltn_customer->SetValue($ticketcustomer);
	$smart_resolution->rsltn_contact->SetValue($ticketcustomercontact);
	$smart_resolution->rsltn_contact2->SetValue($ticketcustomercontact2);
	$smart_resolution->datemodified->SetValue(date("Y-m-d H:m:s"));
	
// -------------------------
//End Custom Code

//Close smart_resolution_BeforeShow @12-B2413B13
    return $smart_resolution_BeforeShow;
}
//End Close smart_resolution_BeforeShow

//smart_resolution_AfterInsert @12-BB50AA9D
function smart_resolution_AfterInsert(& $sender)
{
    $smart_resolution_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution, $DBSMART, $Redirect; //Compatibility
//End smart_resolution_AfterInsert

//Custom Code @68-2A29BDB7
// -------------------------
	$DBSmart = new clsDBSMART();
	$rid = CCDlookUp("max(id)", "smart_resolutionnote", "ticket_id=".$smart_resolution->ticket_id->GetValue(), $DBSmart);
	$ticketref = CCDlookUp("tckt_refnumber", "smart_ticket", "id=".$smart_resolution->ticket_id->GetValue(), $DBSmart);
	
	$ListEq = array("E-01","E2000","CCD","PF1","PF2");
	foreach($ListEq as $i => $value) {
	$QueryEqToInsert = "INSERT INTO smart_faultyequipment (id,resolution_id,equipment_id)
						VALUES ('','".$rid."','".$value."')";
	$DBSmart->query( $QueryEqToInsert ) ;
	}

	$ListMsre = array("E-41","E-42","E-43","E-44");
	foreach($ListMsre as $i => $value) {
	$QueryMsreToInsert = "INSERT INTO smart_measurement  (id,resolution_id,msre_item)
							VALUES ('','".$rid."','".$value."')";
	$DBSmart->query( $QueryMsreToInsert ) ;
	}
	
	echo "<script>alert('CM for : #".$ticketref." has successfully created')</script>";
    die("<script>window.location='cmactivity.php?tcktid=".CCGetParam("tcktid")."&rid=".$rid."';</script>");
	//$Redirect = "cmactivity.php?tcktid=".CCGetParam("tcktid")."&rid=".$rid;
	//$smart_resolution->Errors->addError("CM for ".$ticketref." is updated");
// -------------------------
//End Custom Code

//Close smart_resolution_AfterInsert @12-FDA13A2A
    return $smart_resolution_AfterInsert;
}
//End Close smart_resolution_AfterInsert

//smart_resolution_AfterUpdate @12-60D16246
function smart_resolution_AfterUpdate(& $sender)
{
    $smart_resolution_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution; //Compatibility
//End smart_resolution_AfterUpdate

//Custom Code @213-2A29BDB7
// -------------------------
	$DBSmart = new clsDBSMART();
	$tcktid = CCGetParam("tcktid");
	$rid = CCGetParam("rid");

	//TO RE-CHECK THE VALUES IN TABLE EQUIPMENT & MEASURMENT
	$EqId = CCDlookUp("max(id)", "smart_faultyequipment", "resolution_id=".$rid, $DBSmart);
	$MsreId = CCDlookUp("max(id)", "smart_measurement", "resolution_id=".$rid, $DBSmart);

	if($tcktid != null && $EqId == null) {
		$ListEq = array("E-01","E2000","CCD","PF1","PF2");
		foreach($ListEq as $i => $value) {
		$QueryEqToInsert = "INSERT INTO smart_faultyequipment (id,resolution_id,equipment_id)
							VALUES ('','".$rid."','".$value."')";
		$DBSmart->query( $QueryEqToInsert ) ;
		}
	}

	if($tcktid != null && $MsreId == null) {
		$ListMsre = array("E-41","E-42","E-43","E-44");
		foreach($ListMsre as $i => $value) {
		$QueryMsreToInsert = "INSERT INTO smart_measurement  (id,resolution_id,msre_item)
								VALUES ('','".$rid."','".$value."')";
		$DBSmart->query( $QueryMsreToInsert ) ;
		}
	}
    $smart_resolution->Errors->addError("CM for ".$smart_resolution->ticketNumber->GetValue()." is updated");
// -------------------------
//End Custom Code

//Close smart_resolution_AfterUpdate @12-3288FBA5
    return $smart_resolution_AfterUpdate;
}
//End Close smart_resolution_AfterUpdate

//smart_resolution_ds_AfterExecuteInsert @12-55092B12
function smart_resolution_ds_AfterExecuteInsert(& $sender)
{
    $smart_resolution_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution; //Compatibility
//End smart_resolution_ds_AfterExecuteInsert

//Custom Code @218-2A29BDB7
// -------------------------
    $refnumber = GetCodeFromSingleTable('smart_ticket',$smart_resolution->ticket_id->GetValue(),'tckt_refnumber');
    BroadcastEmail('newcm','technical@target.net.my',$smart_resolution->rsltn_engineer->GetValue(),'CM Report',$refnumber,date("Y-m-d H:m:s"));
    LogActivity(CCGetSession("UserLogin"),"ADD","".$refnumber."","Successfully Add CM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_resolution_ds_AfterExecuteInsert @12-0FD5EE23
    return $smart_resolution_ds_AfterExecuteInsert;
}
//End Close smart_resolution_ds_AfterExecuteInsert

//smart_resolution_ds_AfterExecuteUpdate @12-D1E48F93
function smart_resolution_ds_AfterExecuteUpdate(& $sender)
{
    $smart_resolution_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolution; //Compatibility
//End smart_resolution_ds_AfterExecuteUpdate

//Custom Code @219-2A29BDB7
// -------------------------
    $refnumber = GetCodeFromSingleTable('smart_ticket',$smart_resolution->ticket_id->GetValue(),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".$refnumber."","Successfully Update CM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_resolution_ds_AfterExecuteUpdate @12-C0FC2FAC
    return $smart_resolution_ds_AfterExecuteUpdate;
}
//End Close smart_resolution_ds_AfterExecuteUpdate

//GMeasurement_ds_BeforeBuildInsert @235-8E96DF0A
function GMeasurement_ds_BeforeBuildInsert(& $sender)
{
    $GMeasurement_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_BeforeBuildInsert

//Custom Code @247-2A29BDB7
// -------------------------
    $GMeasurement->ds->resolution_id->SetValue(CCGetParam("rid"));
	$GMeasurement->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_BeforeBuildInsert @235-490840C5
    return $GMeasurement_ds_BeforeBuildInsert;
}
//End Close GMeasurement_ds_BeforeBuildInsert

//GMeasurement_ds_AfterExecuteInsert @235-CC20CCDE
function GMeasurement_ds_AfterExecuteInsert(& $sender)
{
    $GMeasurement_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_AfterExecuteInsert

//Custom Code @248-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rid")."","Successfully Added Measurement Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_AfterExecuteInsert @235-31EA5A3E
    return $GMeasurement_ds_AfterExecuteInsert;
}
//End Close GMeasurement_ds_AfterExecuteInsert

//GMeasurement_ds_AfterExecuteUpdate @235-C7FA56C2
function GMeasurement_ds_AfterExecuteUpdate(& $sender)
{
    $GMeasurement_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_AfterExecuteUpdate

//Custom Code @249-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rid")."","Successfully Update Equipment Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_AfterExecuteUpdate @235-FEC39BB1
    return $GMeasurement_ds_AfterExecuteUpdate;
}
//End Close GMeasurement_ds_AfterExecuteUpdate

//GMeasurement_BeforeShow @235-CB10738D
function GMeasurement_BeforeShow(& $sender)
{
    $GMeasurement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_BeforeShow

//Custom Code @258-2A29BDB7
// -------------------------
    if(CCGetFromGet("rid")== null) $GMeasurement->Button_Submit->Visible = false;
// -------------------------
//End Custom Code

//Close GMeasurement_BeforeShow @235-7C38E0E8
    return $GMeasurement_BeforeShow;
}
//End Close GMeasurement_BeforeShow

//GMeasurement_AfterSubmit @235-1CD7D43C
function GMeasurement_AfterSubmit(& $sender)
{
    $GMeasurement_AfterSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_AfterSubmit

//Custom Code @266-2A29BDB7
// -------------------------
    $GMeasurement->Errors->addError("Details Updated!");
// -------------------------
//End Custom Code

//Close GMeasurement_AfterSubmit @235-2040C7D3
    return $GMeasurement_AfterSubmit;
}
//End Close GMeasurement_AfterSubmit

//Panel2_BeforeShow @84-96696C3D
function Panel2_BeforeShow(& $sender)
{
    $Panel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel2; //Compatibility
//End Panel2_BeforeShow

//Panel2UpdatePanel Page BeforeShow @85-CC9B4012
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel2") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel2\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Panel2_BeforeShow @84-AE7F9FB3
    return $Panel2_BeforeShow;
}
//End Close Panel2_BeforeShow

//GSmartReplacement_BeforeShow @99-9BC85101
function GSmartReplacement_BeforeShow(& $sender)
{
    $GSmartReplacement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartReplacement,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSmartReplacement_BeforeShow

//Custom Code @198-2A29BDB7
// -------------------------
	if(CCGetFromGet("rid")== null) $GSmartReplacement->btnNewRec->Visible = false;
	else $GSmartReplacement->btnNewRec->Visible = true;
    if($GSmartReplacement->PageNumber != null){
		$PageFirstRecordNo = ($GSmartReplacement->PageSize * ($GSmartReplacement->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSmartReplacement->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSmartReplacement->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSmartReplacement_BeforeShow @99-CBDB2D36
    return $GSmartReplacement_BeforeShow;
}
//End Close GSmartReplacement_BeforeShow

//GSmartReplacement_BeforeShowRow @99-07BE6C29
function GSmartReplacement_BeforeShowRow(& $sender)
{
    $GSmartReplacement_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartReplacement,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GSmartReplacement_BeforeShowRow

//Custom Code @202-2A29BDB7
// -------------------------
    $GSmartReplacement->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	if($GSmartReplacement->rplc_type->GetValue() == 'sp') {
		$item = CCDlookUp("spart_name", "smart_sparepart", "id=".$GSmartReplacement->equipment_id->GetValue(), $DBSMART);
	} elseif($GSmartReplacement->rplc_type->GetValue() == 'eq') {
		$item = CCDlookUp("eqpmt_name", "smart_equipment", "id=".$GSmartReplacement->equipment_id->GetValue(), $DBSMART);
	}
	$GSmartReplacement->equipment_id->SetValue($item);
// -------------------------
//End Custom Code

//Close GSmartReplacement_BeforeShowRow @99-C306070C
    return $GSmartReplacement_BeforeShowRow;
}
//End Close GSmartReplacement_BeforeShowRow

//RSmartReplacement_Button_Cancel_OnClick @133-406BD74E
function RSmartReplacement_Button_Cancel_OnClick(& $sender)
{
    $RSmartReplacement_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement, $Redirect; //Compatibility
//End RSmartReplacement_Button_Cancel_OnClick

//Custom Code @161-2A29BDB7
// -------------------------
    $Redirect = "cmactivity.php?tcktid=".CCGetParam("tcktid")."&rid=".CCGetParam("rid");
// -------------------------
//End Custom Code

//Close RSmartReplacement_Button_Cancel_OnClick @133-9A6F7BE0
    return $RSmartReplacement_Button_Cancel_OnClick;
}
//End Close RSmartReplacement_Button_Cancel_OnClick

//RSmartReplacement_BeforeShow @130-6766E243
function RSmartReplacement_BeforeShow(& $sender)
{
    $RSmartReplacement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_BeforeShow

//Custom Code @145-2A29BDB7
// -------------------------
    $RSmartReplacement->resolution_id->SetValue(CCGetParam("rid"));
	$RSmartReplacement->datemodified->SetValue(date("Y-m-d H:m:s"));
	$RSmartReplacement->itemtype->GetValue();
	if($RSmartReplacement->itemtype->GetValue() == 'sp') {
		$RSmartReplacement->rplc_sparepart->Visible = true;
	} elseif($RSmartReplacement->itemtype->GetValue() == 'eq') {
		$RSmartReplacement->rplc_equipment->Visible = true;
	} else {
		//
	}
// -------------------------
//End Custom Code

//Close RSmartReplacement_BeforeShow @130-76D47E1C
    return $RSmartReplacement_BeforeShow;
}
//End Close RSmartReplacement_BeforeShow

//RSmartReplacement_ds_BeforeBuildInsert @130-CD6CD822
function RSmartReplacement_ds_BeforeBuildInsert(& $sender)
{
    $RSmartReplacement_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_BeforeBuildInsert

//Custom Code @211-2A29BDB7
// -------------------------
    if($RSmartReplacement->itemtype->GetValue() == 'sp') {
		$RSmartReplacement->ds->rplc_equipment->SetValue($RSmartReplacement->rplc_sparepart->GetValue());
	} elseif($RSmartReplacement->itemtype->GetValue() == 'eq') {
		$RSmartReplacement->ds->rplc_sparepart->SetValue($RSmartReplacement->rplc_equipment->GetValue());
	} 
	$RSmartReplacement->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close RSmartReplacement_ds_BeforeBuildInsert @130-22F79AEA
    return $RSmartReplacement_ds_BeforeBuildInsert;
}
//End Close RSmartReplacement_ds_BeforeBuildInsert

//RSmartReplacement_ds_BeforeBuildUpdate @130-57578630
function RSmartReplacement_ds_BeforeBuildUpdate(& $sender)
{
    $RSmartReplacement_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_BeforeBuildUpdate

//Custom Code @212-2A29BDB7
// -------------------------
    if($RSmartReplacement->itemtype->GetValue() == 'sp') {
		$RSmartReplacement->ds->rplc_equipment->SetValue($RSmartReplacement->rplc_sparepart->GetValue());
	} elseif($RSmartReplacement->itemtype->GetValue() == 'eq') {
		$RSmartReplacement->ds->rplc_sparepart->SetValue($RSmartReplacement->rplc_equipment->GetValue());
	} 
// -------------------------
//End Custom Code

//Close RSmartReplacement_ds_BeforeBuildUpdate @130-EDDE5B65
    return $RSmartReplacement_ds_BeforeBuildUpdate;
}
//End Close RSmartReplacement_ds_BeforeBuildUpdate

//RSmartReplacement_ds_AfterExecuteInsert @130-036B4FB7
function RSmartReplacement_ds_AfterExecuteInsert(& $sender)
{
    $RSmartReplacement_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_AfterExecuteInsert

//Custom Code @253-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rid")."","Successfully Added Replacement Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RSmartReplacement_ds_AfterExecuteInsert @130-9A5098BD
    return $RSmartReplacement_ds_AfterExecuteInsert;
}
//End Close RSmartReplacement_ds_AfterExecuteInsert

//RSmartReplacement_ds_AfterExecuteUpdate @130-77B065AB
function RSmartReplacement_ds_AfterExecuteUpdate(& $sender)
{
    $RSmartReplacement_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_AfterExecuteUpdate

//Custom Code @254-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rid")."","Successfully Update Replacement Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RSmartReplacement_ds_AfterExecuteUpdate @130-55795932
    return $RSmartReplacement_ds_AfterExecuteUpdate;
}
//End Close RSmartReplacement_ds_AfterExecuteUpdate

//Panel3_BeforeShow @86-34D6D0C7
function Panel3_BeforeShow(& $sender)
{
    $Panel3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel3; //Compatibility
//End Panel3_BeforeShow

//Panel3UpdatePanel Page BeforeShow @87-0DE34365
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel3") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel3\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel3UpdatePanel Page BeforeShow

//Close Panel3_BeforeShow @86-33707EC5
    return $Panel3_BeforeShow;
}
//End Close Panel3_BeforeShow

//Panel5_BeforeShow @110-4DB55659
function Panel5_BeforeShow(& $sender)
{
    $Panel5_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel5, $ImageLink1; //Compatibility
//End Panel5_BeforeShow

//Custom Code @170-2A29BDB7
// -------------------------
    if(CCGetSession("GroupID") == 5 || CCGetSession("GroupID") == 1) {
		$ImageLink1->SetLink("ticketdetails.php?id=".CCGetParam("tcktid"));
	} else {
		$ImageLink1->SetLink("vticketdetails.php?id=".CCGetParam("tcktid"));
	}
// -------------------------
//End Custom Code

//Close Panel5_BeforeShow @110-CBB23573
    return $Panel5_BeforeShow;
}
//End Close Panel5_BeforeShow

//smart_attachment_BeforeShowRow @171-23873C43
function smart_attachment_BeforeShowRow(& $sender)
{
    $smart_attachment_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End smart_attachment_BeforeShowRow

//Custom Code @185-2A29BDB7
// -------------------------
	$smart_attachment->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$DBSMART = new clsDBSMART();
	if($smart_attachment->id->GetValue() != null) {
    	$name = CCDlookUp("usr_username", "smart_user", "id='".$smart_attachment->storeuser->GetValue()."'", $DBSMART);
		$smart_attachment->att_link->SetLink("attachments/".$smart_attachment->att_link->GetValue());
	} else {
		$name = CCDlookUp("usr_username", "smart_user", "id='".CCGetSession("UserID")."'", $DBSMART);
		$smart_attachment->att_link->SetLink("#");
	}
	$smart_attachment->attch_byuser->SetValue($name);	
// -------------------------
//End Custom Code

//Close smart_attachment_BeforeShowRow @171-850369B4
    return $smart_attachment_BeforeShowRow;
}
//End Close smart_attachment_BeforeShowRow

//smart_attachment_ds_BeforeBuildInsert @171-86BF335B
function smart_attachment_ds_BeforeBuildInsert(& $sender)
{
    $smart_attachment_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_BeforeBuildInsert

//Custom Code @186-2A29BDB7
// -------------------------
	$smart_attachment->ds->storeuser->SetValue(CCGetSession("UserID"));
	$smart_attachment->ds->resolution_id->SetValue(CCGetParam("rid"));
	$smart_attachment->ds->attch_date->SetValue(date("Y-m-d h:m:s"));
	$smart_attachment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_BeforeBuildInsert @171-FE2EAFF0
    return $smart_attachment_ds_BeforeBuildInsert;
}
//End Close smart_attachment_ds_BeforeBuildInsert

//smart_attachment_BeforeShow @171-571BB07F
function smart_attachment_BeforeShow(& $sender)
{
    $smart_attachment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End smart_attachment_BeforeShow

//Custom Code @199-2A29BDB7
// -------------------------
	if(CCGetFromGet("rid")== null) $smart_attachment->Button_Submit->Visible = false;
	else $smart_attachment->Button_Submit->Visible = true;
    if($smart_attachment->PageNumber != null){
		$PageFirstRecordNo = ($smart_attachment->PageSize * ($smart_attachment->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($smart_attachment->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$smart_attachment->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close smart_attachment_BeforeShow @171-493A9196
    return $smart_attachment_BeforeShow;
}
//End Close smart_attachment_BeforeShow

//smart_attachment_ds_AfterExecuteInsert @171-009FB4FA
function smart_attachment_ds_AfterExecuteInsert(& $sender)
{
    $smart_attachment_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_AfterExecuteInsert

//Custom Code @255-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rid")."","Successfully Added Attachment Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_AfterExecuteInsert @171-67EEB8F2
    return $smart_attachment_ds_AfterExecuteInsert;
}
//End Close smart_attachment_ds_AfterExecuteInsert

//smart_attachment_ds_AfterExecuteUpdate @171-8472107B
function smart_attachment_ds_AfterExecuteUpdate(& $sender)
{
    $smart_attachment_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_AfterExecuteUpdate

//Custom Code @256-2A29BDB7
// -------------------------
	$refnumber = GetCodeFromSingleTable('smart_ticket',CCGetParam("tcktid"),'tckt_refnumber');
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rid")."","Successfully Added Attachment Details for the CM (Ticket#:".$refnumber.")",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_AfterExecuteUpdate @171-A8C7797D
    return $smart_attachment_ds_AfterExecuteUpdate;
}
//End Close smart_attachment_ds_AfterExecuteUpdate

//Page_AfterInitialize @1-ACB28C79
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmactivity, $RSmartReplacement; //Compatibility
//End Page_AfterInitialize

//Custom Code @71-2A29BDB7
// -------------------------
	$RSmartReplacement->Visible = false;

	if (CCGetParam("rplcid")!=null || CCGetParam("rplc")==1) $RSmartReplacement->Visible = true;
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-23D6A65E
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmactivity; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @6-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Panel2UpdatePanel PageBeforeInitialize @85-5E181320
    if (CCGetFromGet("FormFilter") == "Panel2" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel2UpdatePanel PageBeforeInitialize

//Panel3UpdatePanel PageBeforeInitialize @87-B16DEABC
    if (CCGetFromGet("FormFilter") == "Panel3" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel3UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-8DBDBAE4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmactivity; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @6-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Panel2UpdatePanel Page BeforeShow @85-4589DE7C
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel2") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel2UpdatePanel Page BeforeShow

//Panel3UpdatePanel Page BeforeShow @87-BAEB6C08
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel3") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel3UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-3A560089
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmactivity; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @6-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Panel2UpdatePanel PageBeforeOutput @85-AE056578
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel2") {
        $main_block = $Tpl->getvar("/Panel Panel2");
    }
//End Panel2UpdatePanel PageBeforeOutput

//Panel3UpdatePanel PageBeforeOutput @87-ECACD75B
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel3") {
        $main_block = $Tpl->getvar("/Panel Panel3");
    }
//End Panel3UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-3F7530EF
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmactivity; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @6-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Panel2UpdatePanel PageBeforeUnload @85-A0E8F191
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel2") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel2UpdatePanel PageBeforeUnload

//Panel3UpdatePanel PageBeforeUnload @87-F8A60A8C
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel3") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel3UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
