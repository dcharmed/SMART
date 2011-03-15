<?php
//BindEvents Method @1-D1C29EF5
function BindEvents()
{
    global $GEquipment;
    global $Panel1;
    global $RPreventive;
    global $GMeasurement;
    global $Panel2;
    global $GSmartReplacement;
    global $RSmartReplacement;
    global $Panel3;
    global $smart_attachment;
    global $CCSEvents;
    $GEquipment->ds->CCSEvents["BeforeBuildInsert"] = "GEquipment_ds_BeforeBuildInsert";
    $GEquipment->ds->CCSEvents["AfterExecuteInsert"] = "GEquipment_ds_AfterExecuteInsert";
    $GEquipment->ds->CCSEvents["AfterExecuteUpdate"] = "GEquipment_ds_AfterExecuteUpdate";
    $GEquipment->CCSEvents["BeforeShow"] = "GEquipment_BeforeShow";
    $GEquipment->CCSEvents["BeforeShowRow"] = "GEquipment_BeforeShowRow";
    $GEquipment->CCSEvents["AfterSubmit"] = "GEquipment_AfterSubmit";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $RPreventive->Button_Insert->CCSEvents["OnClick"] = "RPreventive_Button_Insert_OnClick";
    $RPreventive->Button_Cancel->CCSEvents["OnClick"] = "RPreventive_Button_Cancel_OnClick";
    $RPreventive->prvt_toppanid->CCSEvents["BeforeShow"] = "RPreventive_prvt_toppanid_BeforeShow";
    $RPreventive->site->CCSEvents["BeforeShow"] = "RPreventive_site_BeforeShow";
    $RPreventive->CCSEvents["BeforeShow"] = "RPreventive_BeforeShow";
    $RPreventive->CCSEvents["AfterInsert"] = "RPreventive_AfterInsert";
    $RPreventive->CCSEvents["AfterUpdate"] = "RPreventive_AfterUpdate";
    $RPreventive->ds->CCSEvents["AfterExecuteInsert"] = "RPreventive_ds_AfterExecuteInsert";
    $RPreventive->ds->CCSEvents["AfterExecuteUpdate"] = "RPreventive_ds_AfterExecuteUpdate";
    $RPreventive->CCSEvents["OnValidate"] = "RPreventive_OnValidate";
    $GMeasurement->ds->CCSEvents["BeforeBuildInsert"] = "GMeasurement_ds_BeforeBuildInsert";
    $GMeasurement->ds->CCSEvents["AfterExecuteInsert"] = "GMeasurement_ds_AfterExecuteInsert";
    $GMeasurement->ds->CCSEvents["AfterExecuteUpdate"] = "GMeasurement_ds_AfterExecuteUpdate";
    $GMeasurement->CCSEvents["BeforeShow"] = "GMeasurement_BeforeShow";
    $GMeasurement->CCSEvents["BeforeShowRow"] = "GMeasurement_BeforeShowRow";
    $GMeasurement->CCSEvents["AfterSubmit"] = "GMeasurement_AfterSubmit";
    $Panel2->CCSEvents["BeforeShow"] = "Panel2_BeforeShow";
    $GSmartReplacement->CCSEvents["BeforeShow"] = "GSmartReplacement_BeforeShow";
    $GSmartReplacement->CCSEvents["BeforeShowRow"] = "GSmartReplacement_BeforeShowRow";
    $RSmartReplacement->Button_Cancel->CCSEvents["OnClick"] = "RSmartReplacement_Button_Cancel_OnClick";
    $RSmartReplacement->ds->CCSEvents["BeforeBuildInsert"] = "RSmartReplacement_ds_BeforeBuildInsert";
    $RSmartReplacement->ds->CCSEvents["BeforeBuildUpdate"] = "RSmartReplacement_ds_BeforeBuildUpdate";
    $RSmartReplacement->CCSEvents["BeforeShow"] = "RSmartReplacement_BeforeShow";
    $RSmartReplacement->ds->CCSEvents["AfterExecuteInsert"] = "RSmartReplacement_ds_AfterExecuteInsert";
    $RSmartReplacement->ds->CCSEvents["AfterExecuteUpdate"] = "RSmartReplacement_ds_AfterExecuteUpdate";
    $Panel3->CCSEvents["BeforeShow"] = "Panel3_BeforeShow";
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

//GEquipment_ds_BeforeBuildInsert @287-930220AE
function GEquipment_ds_BeforeBuildInsert(& $sender)
{
    $GEquipment_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_BeforeBuildInsert

//Custom Code @322-2A29BDB7
// -------------------------
    $GEquipment->ds->resolution_id->SetValue(CCGetParam("rf"));
	$GEquipment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GEquipment_ds_BeforeBuildInsert @287-03DA642A
    return $GEquipment_ds_BeforeBuildInsert;
}
//End Close GEquipment_ds_BeforeBuildInsert

//GEquipment_ds_AfterExecuteInsert @287-CCA2AD0E
function GEquipment_ds_AfterExecuteInsert(& $sender)
{
    $GEquipment_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_AfterExecuteInsert

//Custom Code @327-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rf")."","Successfully Added Equipment Details for the PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GEquipment_ds_AfterExecuteInsert @287-011577F3
    return $GEquipment_ds_AfterExecuteInsert;
}
//End Close GEquipment_ds_AfterExecuteInsert

//GEquipment_ds_AfterExecuteUpdate @287-B6DA98D1
function GEquipment_ds_AfterExecuteUpdate(& $sender)
{
    $GEquipment_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_AfterExecuteUpdate

//Custom Code @331-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rf")."","Successfully Update Equipment Details for the PM",date('Y-m-d H:i:s'));
	
// -------------------------
//End Custom Code

//Close GEquipment_ds_AfterExecuteUpdate @287-CE3CB67C
    return $GEquipment_ds_AfterExecuteUpdate;
}
//End Close GEquipment_ds_AfterExecuteUpdate

//GEquipment_BeforeShow @287-287B41AC
function GEquipment_BeforeShow(& $sender)
{
    $GEquipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GEquipment_BeforeShow

//Custom Code @332-2A29BDB7
// -------------------------
    if(CCGetFromGet("pmid")== null) $GEquipment->Button_Submit->Visible = false;

	if($GEquipment->PageNumber != null){
		$PageFirstRecordNo = ($GEquipment->PageSize * ($GEquipment->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GEquipment->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GEquipment->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GEquipment_BeforeShow @287-587ACBE4
    return $GEquipment_BeforeShow;
}
//End Close GEquipment_BeforeShow

//GEquipment_BeforeShowRow @287-9F51852D
function GEquipment_BeforeShowRow(& $sender)
{
    $GEquipment_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GEquipment_BeforeShowRow

//Custom Code @340-2A29BDB7
// -------------------------
    $GEquipment->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GEquipment_BeforeShowRow @287-E4FE21D5
    return $GEquipment_BeforeShowRow;
}
//End Close GEquipment_BeforeShowRow

//GEquipment_AfterSubmit @287-16D0CE17
function GEquipment_AfterSubmit(& $sender)
{
    $GEquipment_AfterSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_AfterSubmit

//Custom Code @342-2A29BDB7
// -------------------------
    $GEquipment->Errors->addError("Details updated!");
// -------------------------
//End Custom Code

//Close GEquipment_AfterSubmit @287-29D2C9D3
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

//RPreventive_Button_Insert_OnClick @39-5B35F7D9
function RPreventive_Button_Insert_OnClick(& $sender)
{
    $RPreventive_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive; //Compatibility
//End RPreventive_Button_Insert_OnClick

//Custom Code @40-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close RPreventive_Button_Insert_OnClick @39-B2917CC8
    return $RPreventive_Button_Insert_OnClick;
}
//End Close RPreventive_Button_Insert_OnClick

//RPreventive_Button_Cancel_OnClick @42-49426C1E
function RPreventive_Button_Cancel_OnClick(& $sender)
{
    $RPreventive_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive, $Redirect; //Compatibility
//End RPreventive_Button_Cancel_OnClick

//Custom Code @177-2A29BDB7
// -------------------------
    $Redirect = "pmlist.php";
// -------------------------
//End Custom Code

//Close RPreventive_Button_Cancel_OnClick @42-0FB2B76E
    return $RPreventive_Button_Cancel_OnClick;
}
//End Close RPreventive_Button_Cancel_OnClick

//RPreventive_prvt_toppanid_BeforeShow @58-0CF9B0E8
function RPreventive_prvt_toppanid_BeforeShow(& $sender)
{
    $RPreventive_prvt_toppanid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive; //Compatibility
//End RPreventive_prvt_toppanid_BeforeShow

//Close RPreventive_prvt_toppanid_BeforeShow @58-EA84C2AD
    return $RPreventive_prvt_toppanid_BeforeShow;
}
//End Close RPreventive_prvt_toppanid_BeforeShow

//RPreventive_site_BeforeShow @345-E263BA10
function RPreventive_site_BeforeShow(& $sender)
{
    $RPreventive_site_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive; //Compatibility
//End RPreventive_site_BeforeShow

//Close RPreventive_site_BeforeShow @345-EC4B14D5
    return $RPreventive_site_BeforeShow;
}
//End Close RPreventive_site_BeforeShow

//RPreventive_BeforeShow @12-2EFA2033
function RPreventive_BeforeShow(& $sender)
{
    $RPreventive_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive, $DBSMART; //Compatibility
//End RPreventive_BeforeShow

//Custom Code @67-2A29BDB7
// -------------------------
	$TempRefId = GetAutoGeneratePM(date("Y"));
	$RPreventive->datemodified->SetValue(date("Y-m-d H:m:s"));

	if(CCGetFromGet("pmid")==null) {
		$RPreventive->prvt_byuser->SetValue(CCGetSession("UserID"));
		$RPreventive->prvt_refnumber->SetValue("PM".$TempRefId."-");
		CCSetSession("RefNumber","");
	} else {
		$RefNumber = CCDlookUp("prvt_refnumber", "smart_preventive", "id='".CCGetParam("pmid")."'", $DBSMART);
		CCSetSession("RefNumber",$RefNumber);
	}
// -------------------------
//End Custom Code

//Close RPreventive_BeforeShow @12-4FDA012A
    return $RPreventive_BeforeShow;
}
//End Close RPreventive_BeforeShow

//RPreventive_AfterInsert @12-85E7129C
function RPreventive_AfterInsert(& $sender)
{
    $RPreventive_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive, $DBSMART, $Redirect; //Compatibility
//End RPreventive_AfterInsert

//Custom Code @68-2A29BDB7
// -------------------------
	$DBSmart = new clsDBSMART();
	$pmid = CCDlookUp("max(id)", "smart_preventive", "prvt_servicennumber=".$RPreventive->prvt_servicennumber->GetValue(), $DBSMART);
	$RefPm = CCDlookUp("prvt_refnumber", "smart_preventive", "id='".$pmid."'", $DBSmart);
	
	$ListEq = array("E-01","E2000","CCD","PF1","PF2");
	foreach($ListEq as $i => $value) {
		$QueryEqToInsert = "INSERT INTO smart_faultyequipment (id,resolution_id,equipment_id)
							VALUES ('','".$RefPm."','".$value."')";
		$DBSmart->query( $QueryEqToInsert ) ;
	}

	$ListMsre = array("E-41","E-42","E-43","E-44");
	foreach($ListMsre as $i => $value) {
		$QueryMsreToInsert = "INSERT INTO smart_measurement  (id,resolution_id,msre_item)
								VALUES ('','".$RefPm."','".$value."')";
		$DBSmart->query( $QueryMsreToInsert ) ;
	}
	
	$RefDesc = 'PM @'.$RPreventive->prvt_refnumber->GetValue();
	$DateEta = CCDLookUp("prvt_eta","smart_preventive","id='".$pmid."'",$DBSMART);
	$DatePm = date("Y-m-d",strtotime($DateEta));
	$QueryToUpdateCalendar = "INSERT INTO smart_calendar  (cal_userid,cal_type,cal_description,cal_datefrom)
							VALUES (".$RPreventive->prvt_byuser->GetValue().",'1','".$RefDesc."','".$DatePm."')";
	$DBSmart->query( $QueryToUpdateCalendar );

    $Redirect = "pmactivity.php?pmid=".$pmid."&rf=".$RefPm;
// -------------------------
//End Custom Code

//Close RPreventive_AfterInsert @12-A2592918
    return $RPreventive_AfterInsert;
}
//End Close RPreventive_AfterInsert

//RPreventive_AfterUpdate @12-01ED8DF8
function RPreventive_AfterUpdate(& $sender)
{
    $RPreventive_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive, $DBSMART; //Compatibility
//End RPreventive_AfterUpdate

//Custom Code @227-2A29BDB7
// -------------------------

	$DBSmart = new clsDBSMART();
	$pmid = CCGetParam("pmid");
	$RefPm = CCDlookUp("prvt_refnumber", "smart_preventive", "id='".$pmid."'", $DBSmart);
	
	//TO RE-CHECK THE VALUES IN THE EQUIPMENT & MEASUREMENT TABLE
	$EqIdExist = CCDlookUp("max(id)", "smart_faultyequipment", "resolution_id='".$RefPm."'", $DBSmart);
	$MsreIdExist = CCDlookUp("max(id)", "smart_measurement", "resolution_id='".$RefPm."'", $DBSmart);
	
	if($EqIdExist == null) {
		$ListEq = array("E-01","E2000","CCD","PF1","PF2");
		foreach($ListEq as $i => $value) {
			$QueryEqToInsert = "INSERT INTO smart_faultyequipment (id,resolution_id,equipment_id)
								VALUES ('','".$RefPm."','".$value."')";
			$DBSmart->query( $QueryEqToInsert ) ;
		}
	}

	if($MsreIdExist == null) {
		$ListMsre = array("E-41","E-42","E-43","E-44");
		foreach($ListMsre as $i => $value) {
			$QueryMsreToInsert = "INSERT INTO smart_measurement  (id,resolution_id,msre_item)
									VALUES ('','".$RefPm."','".$value."')";
			$DBSmart->query( $QueryMsreToInsert ) ;
		}
	}

    $RPreventive->Errors->addError("PM Details are updated!");


// -------------------------
//End Custom Code

//Close RPreventive_AfterUpdate @12-6D70E897
    return $RPreventive_AfterUpdate;
}
//End Close RPreventive_AfterUpdate

//RPreventive_ds_AfterExecuteInsert @12-EAA47A40
function RPreventive_ds_AfterExecuteInsert(& $sender)
{
    $RPreventive_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive,$DBSMART; //Compatibility
//End RPreventive_ds_AfterExecuteInsert

//Custom Code @231-2A29BDB7
// -------------------------
	BroadcastEmail('newpm','technical@target.net.my',$RPreventive->prvt_byuser->GetValue(),'PM Report',$RPreventive->prvt_refnumber->GetValue(),date("Y-m-d H:m:s"));
    LogActivity(CCGetSession("UserLogin"),"ADD","".$RPreventive->prvt_refnumber->GetValue()."","Successfully Added New PM",date('Y-m-d H:i:s'));
	//$pmid = CCDlookUp("id", "smart_preventive", "prvt_refnumber='".$RPreventive->prvt_refnumber->GetValue()."'", $DBSMART);
	//echo "<script>alert('Your PM: #".$RPreventive->prvt_refnumber->GetValue()." has successfully created')</script>";
	//die("<script>window.location='pmactivity.php?pmid=".$pmid."&rf=".$RPreventive->prvt_refnumber->GetValue()."';</script>");
// -------------------------
//End Custom Code

//Close RPreventive_ds_AfterExecuteInsert @12-0F8D5433
    return $RPreventive_ds_AfterExecuteInsert;
}
//End Close RPreventive_ds_AfterExecuteInsert

//RPreventive_ds_AfterExecuteUpdate @12-D179DD51
function RPreventive_ds_AfterExecuteUpdate(& $sender)
{
    $RPreventive_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive; //Compatibility
//End RPreventive_ds_AfterExecuteUpdate

//Custom Code @232-2A29BDB7
// -------------------------
    //BroadcastEmail('newpm','technical@target.net.my',$RPreventive->prvt_byuser->GetValue(),'Update PM','"'.$RPreventive->prvt_refnumber->GetValue().'"',date("Y-m-d H:m:s"));
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".$RPreventive->prvt_refnumber->GetValue()."","Successfully Update PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RPreventive_ds_AfterExecuteUpdate @12-C0A495BC
    return $RPreventive_ds_AfterExecuteUpdate;
}
//End Close RPreventive_ds_AfterExecuteUpdate

//RPreventive_OnValidate @12-F37C1D28
function RPreventive_OnValidate(& $sender)
{
    $RPreventive_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreventive; //Compatibility
//End RPreventive_OnValidate

//Custom Code @352-2A29BDB7
// -------------------------
    if (substr($RPreventive->prvt_refnumber->GetValue(), 5, 13)==null) {  // bcd
		$RPreventive->Errors->addError("Please check your reference number format!");
	}
// -------------------------
//End Custom Code

//Close RPreventive_OnValidate @12-702165A3
    return $RPreventive_OnValidate;
}
//End Close RPreventive_OnValidate

//GMeasurement_ds_BeforeBuildInsert @298-8E96DF0A
function GMeasurement_ds_BeforeBuildInsert(& $sender)
{
    $GMeasurement_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_BeforeBuildInsert

//Custom Code @321-2A29BDB7
// -------------------------
    $GMeasurement->ds->resolution_id->SetValue(CCGetParam("rf"));
	$GMeasurement->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_BeforeBuildInsert @298-490840C5
    return $GMeasurement_ds_BeforeBuildInsert;
}
//End Close GMeasurement_ds_BeforeBuildInsert

//GMeasurement_ds_AfterExecuteInsert @298-CC20CCDE
function GMeasurement_ds_AfterExecuteInsert(& $sender)
{
    $GMeasurement_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_AfterExecuteInsert

//Custom Code @326-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rf")."","Successfully Added Measurement Details for the PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_AfterExecuteInsert @298-31EA5A3E
    return $GMeasurement_ds_AfterExecuteInsert;
}
//End Close GMeasurement_ds_AfterExecuteInsert

//GMeasurement_ds_AfterExecuteUpdate @298-C7FA56C2
function GMeasurement_ds_AfterExecuteUpdate(& $sender)
{
    $GMeasurement_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_ds_AfterExecuteUpdate

//Custom Code @328-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rf")."","Successfully Update Equipment Details for the PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GMeasurement_ds_AfterExecuteUpdate @298-FEC39BB1
    return $GMeasurement_ds_AfterExecuteUpdate;
}
//End Close GMeasurement_ds_AfterExecuteUpdate

//GMeasurement_BeforeShow @298-CB10738D
function GMeasurement_BeforeShow(& $sender)
{
    $GMeasurement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GMeasurement_BeforeShow

//Custom Code @333-2A29BDB7
// -------------------------
    if(CCGetFromGet("pmid")== null) $GMeasurement->Button_Submit->Visible = false;

	if($GMeasurement->PageNumber != null){
		$PageFirstRecordNo = ($GMeasurement->PageSize * ($GMeasurement->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GMeasurement->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GMeasurement->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GMeasurement_BeforeShow @298-7C38E0E8
    return $GMeasurement_BeforeShow;
}
//End Close GMeasurement_BeforeShow

//GMeasurement_BeforeShowRow @298-4F296FAB
function GMeasurement_BeforeShowRow(& $sender)
{
    $GMeasurement_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GMeasurement_BeforeShowRow

//Custom Code @341-2A29BDB7
// -------------------------
    $GMeasurement->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GMeasurement_BeforeShowRow @298-03460540
    return $GMeasurement_BeforeShowRow;
}
//End Close GMeasurement_BeforeShowRow

//GMeasurement_AfterSubmit @298-1CD7D43C
function GMeasurement_AfterSubmit(& $sender)
{
    $GMeasurement_AfterSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GMeasurement; //Compatibility
//End GMeasurement_AfterSubmit

//Custom Code @343-2A29BDB7
// -------------------------
    $GMeasurement->Errors->addError("Details updated!");
// -------------------------
//End Custom Code

//Close GMeasurement_AfterSubmit @298-2040C7D3
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

//Custom Code @201-2A29BDB7
// -------------------------
    if(CCGetFromGet("pmid")== null) $GSmartReplacement->btnNewRec->Visible = false;
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

//Custom Code @209-2A29BDB7
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

//Custom Code @315-2A29BDB7
// -------------------------
    $Redirect = "pmactivity.php?pmid=".CCGetParam("pmid")."&rf=".CCGetParam("rf");
// -------------------------
//End Custom Code

//Close RSmartReplacement_Button_Cancel_OnClick @133-9A6F7BE0
    return $RSmartReplacement_Button_Cancel_OnClick;
}
//End Close RSmartReplacement_Button_Cancel_OnClick

//RSmartReplacement_ds_BeforeBuildInsert @130-CD6CD822
function RSmartReplacement_ds_BeforeBuildInsert(& $sender)
{
    $RSmartReplacement_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_BeforeBuildInsert

//Custom Code @312-2A29BDB7
// -------------------------
    if($RSmartReplacement->itemtype->GetValue() == 'sp') {
		$RSmartReplacement->ds->rplc_equipment->SetValue($RSmartReplacement->rplc_sparepart->GetValue());
	} elseif($RSmartReplacement->itemtype->GetValue() == 'eq') {
		$RSmartReplacement->ds->rplc_sparepart->SetValue($RSmartReplacement->rplc_equipment->GetValue());
	}   
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

//Custom Code @313-2A29BDB7
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

//RSmartReplacement_BeforeShow @130-6766E243
function RSmartReplacement_BeforeShow(& $sender)
{
    $RSmartReplacement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_BeforeShow


//Custom Code @314-2A29BDB7
// -------------------------
    $RSmartReplacement->resolution_id->SetValue(CCGetParam("rf"));
	$RSmartReplacement->datemodified->SetValue(date("Y-m-d H:m:s"));
	
	if($RSmartReplacement->itemtype->GetValue() == 'sp') {
		$RSmartReplacement->rplc_sparepart->Visible = true;
		$RSmartReplacement->rplc_equipment->Visible = false;
	} elseif($RSmartReplacement->itemtype->GetValue() == 'eq') {
		$RSmartReplacement->rplc_equipment->Visible = true;
		$RSmartReplacement->rplc_sparepart->Visible = false;
	} else {
		
	}

// -------------------------
//End Custom Code

//Close RSmartReplacement_BeforeShow @130-76D47E1C
    return $RSmartReplacement_BeforeShow;
}
//End Close RSmartReplacement_BeforeShow

//RSmartReplacement_ds_AfterExecuteInsert @130-036B4FB7
function RSmartReplacement_ds_AfterExecuteInsert(& $sender)
{
    $RSmartReplacement_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSmartReplacement; //Compatibility
//End RSmartReplacement_ds_AfterExecuteInsert

//Custom Code @324-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rf")."","Successfully Added Replacement Details for the PM",date('Y-m-d H:i:s'));
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

//Custom Code @325-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rf")."","Successfully Update Replacement Details for the PM",date('Y-m-d H:i:s'));
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

//smart_attachment_BeforeShowRow @179-23873C43
function smart_attachment_BeforeShowRow(& $sender)
{
    $smart_attachment_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment, $BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End smart_attachment_BeforeShowRow

//Custom Code @195-2A29BDB7
// -------------------------
	$smart_attachment->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	
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

//Close smart_attachment_BeforeShowRow @179-850369B4
    return $smart_attachment_BeforeShowRow;
}
//End Close smart_attachment_BeforeShowRow

//smart_attachment_ds_BeforeBuildInsert @179-86BF335B
function smart_attachment_ds_BeforeBuildInsert(& $sender)
{
    $smart_attachment_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_BeforeBuildInsert

//Custom Code @196-2A29BDB7
// -------------------------
    $smart_attachment->ds->attch_byuser->SetValue(CCGetSession("UserLogin"));
	$smart_attachment->ds->storeuser->SetValue(CCGetSession("UserID"));
	$smart_attachment->ds->resolution_id->SetValue(CCGetParam("rf"));
	$smart_attachment->ds->attch_date->SetValue(date("Y-m-d H:m:s"));
	$smart_attachment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_BeforeBuildInsert @179-FE2EAFF0
    return $smart_attachment_ds_BeforeBuildInsert;
}
//End Close smart_attachment_ds_BeforeBuildInsert

//smart_attachment_BeforeShow @179-571BB07F
function smart_attachment_BeforeShow(& $sender)
{
    $smart_attachment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment, $BilRekod, $PageFirstRecordNo; //Compatibility
//End smart_attachment_BeforeShow

//Custom Code @202-2A29BDB7
// -------------------------
    if(CCGetFromGet("pmid")== null) $smart_attachment->Button_Submit->Visible = false;
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

//Close smart_attachment_BeforeShow @179-493A9196
    return $smart_attachment_BeforeShow;
}
//End Close smart_attachment_BeforeShow

//smart_attachment_ds_AfterExecuteInsert @179-009FB4FA
function smart_attachment_ds_AfterExecuteInsert(& $sender)
{
    $smart_attachment_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_AfterExecuteInsert

//Custom Code @329-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"ADD","".CCGetParam("rf")."","Successfully Added Attachment Details for the PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_AfterExecuteInsert @179-67EEB8F2
    return $smart_attachment_ds_AfterExecuteInsert;
}
//End Close smart_attachment_ds_AfterExecuteInsert

//smart_attachment_ds_AfterExecuteUpdate @179-8472107B
function smart_attachment_ds_AfterExecuteUpdate(& $sender)
{
    $smart_attachment_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_attachment; //Compatibility
//End smart_attachment_ds_AfterExecuteUpdate

//Custom Code @330-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","".CCGetParam("rf")."","Successfully Update Attachment Details for the PM",date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close smart_attachment_ds_AfterExecuteUpdate @179-A8C7797D
    return $smart_attachment_ds_AfterExecuteUpdate;
}
//End Close smart_attachment_ds_AfterExecuteUpdate

//Page_AfterInitialize @1-ACB28C79
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pmactivity, $GEquipment, $GMeasurement, $RSmartReplacement, $RAttachment; //Compatibility
//End Page_AfterInitialize

//Custom Code @71-2A29BDB7
// -------------------------
	$RSmartMeasurement->Visible = false;
	$RSmartReplacement->Visible = false;
	$RAttachment->Visible = false;

	if (CCGetParam("rplcid")!=null || CCGetParam("rplc")==1) $RSmartReplacement->Visible = true;
	elseif (CCGetParam("attid")!=null || CCGetParam("att")==1) $RAttachment->Visible = true;
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-7BD310DE
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pmactivity; //Compatibility
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

//Page_BeforeShow @1-D5B80C64
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pmactivity; //Compatibility
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

//Page_BeforeOutput @1-6253B609
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pmactivity; //Compatibility
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

//Page_BeforeUnload @1-6770866F
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pmactivity; //Compatibility
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
