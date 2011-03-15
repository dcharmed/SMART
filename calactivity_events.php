<?php
//BindEvents Method @1-89420881
function BindEvents()
{
    global $RActivityDetails;
    global $CCSEvents;
    $RActivityDetails->Button_Cancel->CCSEvents["OnClick"] = "RActivityDetails_Button_Cancel_OnClick";
    $RActivityDetails->CCSEvents["BeforeShow"] = "RActivityDetails_BeforeShow";
    $RActivityDetails->CCSEvents["AfterUpdate"] = "RActivityDetails_AfterUpdate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//RActivityDetails_Button_Cancel_OnClick @28-50B19C82
function RActivityDetails_Button_Cancel_OnClick(& $sender)
{
    $RActivityDetails_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RActivityDetails, $Redirect; //Compatibility
//End RActivityDetails_Button_Cancel_OnClick

//Custom Code @68-2A29BDB7
// -------------------------
    $Redirect = "calactivity.php";
// -------------------------
//End Custom Code

//Close RActivityDetails_Button_Cancel_OnClick @28-9CCF8E7A
    return $RActivityDetails_Button_Cancel_OnClick;
}
//End Close RActivityDetails_Button_Cancel_OnClick

//RActivityDetails_BeforeShow @23-B51EEC65
function RActivityDetails_BeforeShow(& $sender)
{
    $RActivityDetails_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RActivityDetails; //Compatibility
//End RActivityDetails_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
    $RActivityDetails->datemodified->SetValue(date('Y-m-d H:i:s'));
	//$RActivityDetails->cal_userid->SetValue(CCGetSession("UserID"));
// -------------------------
//End Custom Code

//Close RActivityDetails_BeforeShow @23-6DE10A91
    return $RActivityDetails_BeforeShow;
}
//End Close RActivityDetails_BeforeShow

//RActivityDetails_AfterUpdate @23-FF7A85DA
function RActivityDetails_AfterUpdate(& $sender)
{
    $RActivityDetails_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RActivityDetails; //Compatibility
//End RActivityDetails_AfterUpdate

//Custom Code @67-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close RActivityDetails_AfterUpdate @23-31E1B998
    return $RActivityDetails_AfterUpdate;
}
//End Close RActivityDetails_AfterUpdate

//Page_AfterInitialize @1-247BE421
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $calactivity, $RActivityDetails, $smart_calendar; //Compatibility
//End Page_AfterInitialize

//Custom Code @64-2A29BDB7
// -------------------------
	$RActivityDetails->Visible = false;
    if(CCGetParam("new")==1 || CCGetParam("cid")!=null) {
		$RActivityDetails->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize
?>
