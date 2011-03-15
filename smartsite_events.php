<?php
//BindEvents Method @1-CD125DB2
function BindEvents()
{
    global $GSite;
    global $RSite;
    global $GSiteContact;
    global $CCSEvents;
    $GSite->CCSEvents["BeforeShowRow"] = "GSite_BeforeShowRow";
    $GSite->CCSEvents["BeforeShow"] = "GSite_BeforeShow";
    $RSite->Button_Cancel->CCSEvents["OnClick"] = "RSite_Button_Cancel_OnClick";
    $RSite->CCSEvents["AfterInsert"] = "RSite_AfterInsert";
    $RSite->CCSEvents["AfterUpdate"] = "RSite_AfterUpdate";
    $RSite->CCSEvents["BeforeShow"] = "RSite_BeforeShow";
    $RSite->ds->CCSEvents["BeforeBuildUpdate"] = "RSite_ds_BeforeBuildUpdate";
    $GSiteContact->ds->CCSEvents["BeforeBuildInsert"] = "GSiteContact_ds_BeforeBuildInsert";
    $GSiteContact->CCSEvents["BeforeShow"] = "GSiteContact_BeforeShow";
    $GSiteContact->CCSEvents["BeforeShowRow"] = "GSiteContact_BeforeShowRow";
    $GSiteContact->ds->CCSEvents["AfterExecuteInsert"] = "GSiteContact_ds_AfterExecuteInsert";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GSite_BeforeShowRow @5-B5DDA793
function GSite_BeforeShowRow(& $sender)
{
    $GSite_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSite,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSite_BeforeShowRow

//Set Row Style @16-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @52-2A29BDB7
// -------------------------
    $GSite->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GSite_BeforeShowRow @5-4BC39135
    return $GSite_BeforeShowRow;
}
//End Close GSite_BeforeShowRow

//GSite_BeforeShow @5-8DDD3CEC
function GSite_BeforeShow(& $sender)
{
    $GSite_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSite,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSite_BeforeShow

//Custom Code @51-2A29BDB7
// -------------------------
    if($GSite->PageNumber != null){
		$PageFirstRecordNo = ($GSite->PageSize * ($GSite->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSite->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSite->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSite_BeforeShow @5-1335A363
    return $GSite_BeforeShow;
}
//End Close GSite_BeforeShow

//RSite_Button_Cancel_OnClick @37-744DD2D5
function RSite_Button_Cancel_OnClick(& $sender)
{
    $RSite_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSite, $Redirect; //Compatibility
//End RSite_Button_Cancel_OnClick

//Custom Code @64-2A29BDB7
// -------------------------
    $Redirect = "smartsite.php";
// -------------------------
//End Custom Code

//Close RSite_Button_Cancel_OnClick @37-5ABDD4AB
    return $RSite_Button_Cancel_OnClick;
}
//End Close RSite_Button_Cancel_OnClick

//RSite_AfterInsert @34-7B2266BA
function RSite_AfterInsert(& $sender)
{
    $RSite_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSite, $Redirect, $DBSMART; //Compatibility
//End RSite_AfterInsert

//Custom Code @65-2A29BDB7
// -------------------------
	$siteid = CCDlookUp("max(id)", "smart_site", "site_code='".$RSite->site_code->GetValue()."'", $DBSMART);

    LogActivity(CCGetSession("UserLogin"),"INSERT",$RSite->site_code->GetValue(),"Successfully Insert Site Info for ID: ".$siteid,date('Y-m-d H:i:s'));
	$Redirect = "smartsite.php?sid=".$siteid."&scode=".$RSite->site_code->GetValue()."&view=1";
// -------------------------
//End Custom Code

//Close RSite_AfterInsert @34-80CD893E
    return $RSite_AfterInsert;
}
//End Close RSite_AfterInsert

//RSite_AfterUpdate @34-D66473C4
function RSite_AfterUpdate(& $sender)
{
    $RSite_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSite; //Compatibility
//End RSite_AfterUpdate

//Custom Code @66-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE",$RSite->site_code->GetValue(),"Successfully Update Site Info for ID: ".CCGetParam("sid"),date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close RSite_AfterUpdate @34-4FE448B1
    return $RSite_AfterUpdate;
}
//End Close RSite_AfterUpdate

//RSite_BeforeShow @34-7E9F15BD
function RSite_BeforeShow(& $sender)
{
    $RSite_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSite; //Compatibility
//End RSite_BeforeShow

//Custom Code @109-2A29BDB7
// -------------------------
    if(CCGetParam("sid")!=null && CCGetParam("view")==1) {
		$RSite->lblNotes->SetValue("<font color=red>* You can add the officers details for this Site on the following form below</font><br><br>");
	}
// -------------------------
//End Custom Code

//Close RSite_BeforeShow @34-D96C9E9C
    return $RSite_BeforeShow;
}
//End Close RSite_BeforeShow

//RSite_ds_BeforeBuildUpdate @34-ACDB5E2E
function RSite_ds_BeforeBuildUpdate(& $sender)
{
    $RSite_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSite; //Compatibility
//End RSite_ds_BeforeBuildUpdate

//Custom Code @116-2A29BDB7
// -------------------------
    $RSite->ds->site_code->SetValue(strtoupper($RSite->site_code->GetValue()));
	$RSite->ds->site_name->SetValue(strtoupper($RSite->site_name->GetValue()));
// -------------------------
//End Custom Code

//Close RSite_ds_BeforeBuildUpdate @34-851DBD1A
    return $RSite_ds_BeforeBuildUpdate;
}
//End Close RSite_ds_BeforeBuildUpdate

//GSiteContact_ds_BeforeBuildInsert @73-892E1219
function GSiteContact_ds_BeforeBuildInsert(& $sender)
{
    $GSiteContact_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteContact, $RSite; //Compatibility
//End GSiteContact_ds_BeforeBuildInsert

//Custom Code @107-2A29BDB7
// -------------------------
    $GSiteContact->ds->sc_sitecode->SetValue(CCGetParam("scode"));
	
// -------------------------
//End Custom Code

//Close GSiteContact_ds_BeforeBuildInsert @73-0B71D700
    return $GSiteContact_ds_BeforeBuildInsert;
}
//End Close GSiteContact_ds_BeforeBuildInsert

//GSiteContact_BeforeShow @73-57142CC7
function GSiteContact_BeforeShow(& $sender)
{
    $GSiteContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteContact,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSiteContact_BeforeShow

//Custom Code @113-2A29BDB7
// -------------------------
    if($GSiteContact->PageNumber != null){
		$PageFirstRecordNo = ($GSiteContact->PageSize * ($GSiteContact->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSiteContact->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSiteContact->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSiteContact_BeforeShow @73-C75E24AE
    return $GSiteContact_BeforeShow;
}
//End Close GSiteContact_BeforeShow

//GSiteContact_BeforeShowRow @73-8EBAF0A0
function GSiteContact_BeforeShowRow(& $sender)
{
    $GSiteContact_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteContact,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSiteContact_BeforeShowRow

//Custom Code @114-2A29BDB7
// -------------------------
    $GSiteContact->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GSiteContact_BeforeShowRow @73-7C1622AE
    return $GSiteContact_BeforeShowRow;
}
//End Close GSiteContact_BeforeShowRow

//GSiteContact_ds_AfterExecuteInsert @73-1E93EF5A
function GSiteContact_ds_AfterExecuteInsert(& $sender)
{
    $GSiteContact_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteContact, $DBSMART; //Compatibility
//End GSiteContact_ds_AfterExecuteInsert

//Custom Code @115-2A29BDB7
// -------------------------
	$OfficerId = CCDlookUp("max(id)", "smart_sitecontact", "sc_email='".$GSiteContact->sc_email->GetValue()."'", $DBSMART);
    LogActivity(CCGetSession("UserLogin"),"INSERT",$GSiteContact->sc_name->GetValue(),"Successfully Insert Site Officer for ID: ".$OfficerId,date('Y-m-d H:i:s'));
// -------------------------
//End Custom Code

//Close GSiteContact_ds_AfterExecuteInsert @73-DAA61596
    return $GSiteContact_ds_AfterExecuteInsert;
}
//End Close GSiteContact_ds_AfterExecuteInsert

//Page_AfterInitialize @1-0D9E3FA0
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsite, $SSite, $RSite, $GSite, $GSiteContact; //Compatibility
//End Page_AfterInitialize

//Custom Code @58-2A29BDB7
// -------------------------
    $RSite->Visible = false;
	$GSiteContact->Visible = false;
	if(CCGetParam("sid")!=null && CCGetParam("view")==1) {
		$SSite->Visible = false;
		$GSite->Visible = false;
		$RSite->Visible = true;
		$GSiteContact->Visible = true;
	} elseif(CCGetParam("new")==1 && CCGetParam("sid")==null) {
		$SSite->Visible = false;
		$GSite->Visible = false;
		$RSite->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize
?>
