<?php
//BindEvents Method @1-33AD46D2
function BindEvents()
{
    global $GUser;
    global $RUser;
    global $CCSEvents;
    $GUser->CCSEvents["BeforeShowRow"] = "GUser_BeforeShowRow";
    $GUser->CCSEvents["BeforeShow"] = "GUser_BeforeShow";
    $RUser->Button_Cancel->CCSEvents["OnClick"] = "RUser_Button_Cancel_OnClick";
    $RUser->CCSEvents["OnValidate"] = "RUser_OnValidate";
    $RUser->ds->CCSEvents["BeforeBuildUpdate"] = "RUser_ds_BeforeBuildUpdate";
    $RUser->ds->CCSEvents["BeforeBuildInsert"] = "RUser_ds_BeforeBuildInsert";
    $RUser->CCSEvents["AfterInsert"] = "RUser_AfterInsert";
    $RUser->CCSEvents["AfterUpdate"] = "RUser_AfterUpdate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GUser_BeforeShowRow @5-4FE0D2ED
function GUser_BeforeShowRow(& $sender)
{
    $GUser_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GUser,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GUser_BeforeShowRow

//Set Row Style @14-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @49-2A29BDB7
// -------------------------
    $GUser->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	$GUser->usr_group->SetValue(GetCodeDescription("usrgroup",$GUser->usr_group->GetValue()));
	$GUser->usr_status->SetValue(GetCodeDescription("usraccstatus",$GUser->usr_status->GetValue()));
// -------------------------
//End Custom Code

//Close GUser_BeforeShowRow @5-57852351
    return $GUser_BeforeShowRow;
}
//End Close GUser_BeforeShowRow

//GUser_BeforeShow @5-15F0DBE2
function GUser_BeforeShow(& $sender)
{
    $GUser_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GUser,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GUser_BeforeShow

//Custom Code @48-2A29BDB7
// -------------------------
    if($GUser->PageNumber != null){
		$PageFirstRecordNo = ($GUser->PageSize * ($GUser->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GUser->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GUser->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GUser_BeforeShow @5-587342D2
    return $GUser_BeforeShow;
}
//End Close GUser_BeforeShow

//RUser_Button_Cancel_OnClick @33-F86D7C1C
function RUser_Button_Cancel_OnClick(& $sender)
{
    $RUser_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser, $Redirect; //Compatibility
//End RUser_Button_Cancel_OnClick

//Custom Code @66-2A29BDB7
// -------------------------
    $Redirect = "AdmUsrMngmt.php";
// -------------------------
//End Custom Code

//Close RUser_Button_Cancel_OnClick @33-C5E7B791
    return $RUser_Button_Cancel_OnClick;
}
//End Close RUser_Button_Cancel_OnClick

//RUser_OnValidate @28-03CF2FFB
function RUser_OnValidate(& $sender)
{
    $RUser_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser; //Compatibility
//End RUser_OnValidate

//Custom Code @60-2A29BDB7
// -------------------------
    $password = $RUser->usr_password->GetValue();
	$vpassword = $RUser->usr_vpassword->GetValue();
	if ($password != $vpassword) {
		$RUser->Errors->addError("Please verify your password correctly!");
	}
// -------------------------
//End Custom Code

//Close RUser_OnValidate @28-ADD11BA4
    return $RUser_OnValidate;
}
//End Close RUser_OnValidate

//RUser_ds_BeforeBuildUpdate @28-5F2D31CB
function RUser_ds_BeforeBuildUpdate(& $sender)
{
    $RUser_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser; //Compatibility
//End RUser_ds_BeforeBuildUpdate

//Custom Code @62-2A29BDB7
// -------------------------
    if($RUser->usr_password->GetValue() == null && $RUser->usr_vpassword->GetValue() == null) {
		$RUser->ds->usr_password->SetValue($RUser->ds->usr_oripassword->GetValue);
	} else {
		if($RUser->usr_password->GetValue() == $RUser->usr_vpassword->GetValue()) {
			$RUser->ds->usr_oripassword->SetValue($RUser->ds->usr_password->GetValue());
		} else {
			$RUser->ds->usr_password->SetValue($RUser->ds->usr_oripassword->GetValue());
		}
	}
// -------------------------
//End Custom Code

//Close RUser_ds_BeforeBuildUpdate @28-609A225C
    return $RUser_ds_BeforeBuildUpdate;
}
//End Close RUser_ds_BeforeBuildUpdate

//RUser_ds_BeforeBuildInsert @28-4D76AA9F
function RUser_ds_BeforeBuildInsert(& $sender)
{
    $RUser_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser; //Compatibility
//End RUser_ds_BeforeBuildInsert

//Custom Code @63-2A29BDB7
// -------------------------
    if($RUser->ds->usr_password->GetValue() == null && $RUser->ds->usr_vpassword->GetValue() == null) {
		$RUser->Errors->addError("Please provide password for this account");
	} else {
		if($RUser->ds->usr_password->GetValue() == $RUser->ds->usr_vpassword->GetValue()) {
			$RUser->ds->usr_oripassword->SetValue($RUser->ds->usr_password->GetValue());
		} 
	}
// -------------------------
//End Custom Code

//Close RUser_ds_BeforeBuildInsert @28-AFB3E3D3
    return $RUser_ds_BeforeBuildInsert;
}
//End Close RUser_ds_BeforeBuildInsert

//RUser_AfterInsert @28-07FE9591
function RUser_AfterInsert(& $sender)
{
    $RUser_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser; //Compatibility
//End RUser_AfterInsert

//Custom Code @65-2A29BDB7
// -------------------------
    $RUser->Errors->addError("New Account has been created");
// -------------------------
//End Custom Code

//Close RUser_AfterInsert @28-3CE04CC5
    return $RUser_AfterInsert;
}
//End Close RUser_AfterInsert

//RUser_AfterUpdate @28-AAB880EF
function RUser_AfterUpdate(& $sender)
{
    $RUser_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RUser; //Compatibility
//End RUser_AfterUpdate

//Custom Code @67-2A29BDB7
// -------------------------
    $RUser->Errors->addError("Details Updated!");
// -------------------------
//End Custom Code

//Close RUser_AfterUpdate @28-F3C98D4A
    return $RUser_AfterUpdate;
}
//End Close RUser_AfterUpdate

//Page_AfterInitialize @1-1EFF4A1F
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmUsrMngmt, $SFUser, $GUser, $RUser; //Compatibility
//End Page_AfterInitialize

//Custom Code @50-2A29BDB7
// -------------------------
    $SFUser->Visible = false;
	$GUser->Visible = false;
	$RUser->Visible = false;
	if(CCGetParam("new") == 1 || CCGetParam("id")!=null) {
		$RUser->Visible = true;
	} elseif(CCGetParam("action") == 'cp') {
		//
	} else {
		$SFUser->Visible = true;
		$GUser->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
