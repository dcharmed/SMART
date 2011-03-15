<?php
//BindEvents Method @1-9A06C01E
function BindEvents()
{
    global $RAttachment;
    $RAttachment->Button_Cancel->CCSEvents["OnClick"] = "RAttachment_Button_Cancel_OnClick";
    $RAttachment->CCSEvents["BeforeShow"] = "RAttachment_BeforeShow";
}
//End BindEvents Method

//RAttachment_Button_Cancel_OnClick @10-5C6B1CDF
function RAttachment_Button_Cancel_OnClick(& $sender)
{
    $RAttachment_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RAttachment; //Compatibility
//End RAttachment_Button_Cancel_OnClick

//Custom Code @11-2A29BDB7
// -------------------------
    $Redirect = "pmactivity.php?pmid=".CCGetParam("pmid");
// -------------------------
//End Custom Code

//Close RAttachment_Button_Cancel_OnClick @10-3CA1C352
    return $RAttachment_Button_Cancel_OnClick;
}
//End Close RAttachment_Button_Cancel_OnClick

//RAttachment_BeforeShow @5-B1D5AEF6
function RAttachment_BeforeShow(& $sender)
{
    $RAttachment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RAttachment; //Compatibility
//End RAttachment_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------
    $RAttachment->attch_byuser->SetValue(CCGetSession("UserID"));
	$RAttachment->byuser_toshow->SetValue(CCDlookUp("usr_username", "smart_user", "id=".CCGetSession("UserID"), $DBSMART));
	$RAttachment->resolution_id->SetValue(CCGetParam("pmid"));
// -------------------------
//End Custom Code

//Close RAttachment_BeforeShow @5-40A55CDA
    return $RAttachment_BeforeShow;
}
//End Close RAttachment_BeforeShow


?>
