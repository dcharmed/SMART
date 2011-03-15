<?php
//BindEvents Method @1-C1DAB189
function BindEvents()
{
    global $GEquipment;
    global $SToppan;
    global $CCSEvents;
    $GEquipment->ds->CCSEvents["BeforeBuildUpdate"] = "GEquipment_ds_BeforeBuildUpdate";
    $GEquipment->ds->CCSEvents["BeforeBuildInsert"] = "GEquipment_ds_BeforeBuildInsert";
    $GEquipment->CCSEvents["BeforeShow"] = "GEquipment_BeforeShow";
    $GEquipment->CCSEvents["BeforeShowRow"] = "GEquipment_BeforeShowRow";
    $SToppan->s_branch->CCSEvents["BeforeShow"] = "SToppan_s_branch_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GEquipment_ds_BeforeBuildUpdate @5-1AB66C02
function GEquipment_ds_BeforeBuildUpdate(& $sender)
{
    $GEquipment_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_BeforeBuildUpdate

//Custom Code @21-2A29BDB7
// -------------------------
    $GEquipment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GEquipment_ds_BeforeBuildUpdate @5-CCF3A5A5
    return $GEquipment_ds_BeforeBuildUpdate;
}
//End Close GEquipment_ds_BeforeBuildUpdate

//GEquipment_ds_BeforeBuildInsert @5-930220AE
function GEquipment_ds_BeforeBuildInsert(& $sender)
{
    $GEquipment_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment; //Compatibility
//End GEquipment_ds_BeforeBuildInsert

//Custom Code @22-2A29BDB7
// -------------------------
    $GEquipment->ds->datemodified->SetValue(date("Y-m-d H:m:s"));
// -------------------------
//End Custom Code

//Close GEquipment_ds_BeforeBuildInsert @5-03DA642A
    return $GEquipment_ds_BeforeBuildInsert;
}
//End Close GEquipment_ds_BeforeBuildInsert

//GEquipment_BeforeShow @5-287B41AC
function GEquipment_BeforeShow(& $sender)
{
    $GEquipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GEquipment_BeforeShow

//Custom Code @23-2A29BDB7
// -------------------------
    if($GEquipment->PageNumber != null){
		$PageFirstRecordNo = ($GEquipment->PageSize * ($GEquipment->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GEquipment->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GEquipment->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GEquipment_BeforeShow @5-587ACBE4
    return $GEquipment_BeforeShow;
}
//End Close GEquipment_BeforeShow

//GEquipment_BeforeShowRow @5-9F51852D
function GEquipment_BeforeShowRow(& $sender)
{
    $GEquipment_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipment,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GEquipment_BeforeShowRow

//Custom Code @24-2A29BDB7
// -------------------------
    $GEquipment->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GEquipment_BeforeShowRow @5-E4FE21D5
    return $GEquipment_BeforeShowRow;
}
//End Close GEquipment_BeforeShowRow

//SToppan_s_branch_BeforeShow @28-598795E3
function SToppan_s_branch_BeforeShow(& $sender)
{
    $SToppan_s_branch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SToppan; //Compatibility
//End SToppan_s_branch_BeforeShow

//Close SToppan_s_branch_BeforeShow @28-AD4EFE5C
    return $SToppan_s_branch_BeforeShow;
}
//End Close SToppan_s_branch_BeforeShow

//Page_AfterInitialize @1-084FF258
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmEqMngmt, $GToppan, $SToppan, $GEquipment; //Compatibility
//End Page_AfterInitialize

//Custom Code @48-2A29BDB7
// -------------------------
    $GToppan->Visible = false;
	$SToppan->Visible = false;
	if((CCGetParam("type")!=null && CCGetParam("s_code")=='toppan') || CCGetParam("s_code")=='toppan') {
		$GEquipment->Visible = false;
		$SToppan->Visible = true;
	} elseif(CCGetParam("type")!=null && CCGetParam("s_branch")!=null) {
		$GEquipment->Visible = false;
		$SToppan->Visible = true;
		$GToppan->Visible = true;
	} elseif(CCGetParam("type")=='eq' || CCGetParam("type")=='deleq') {
		$GEquipment->Visible = true;
	}	
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-872BD87F
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmEqMngmt; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
