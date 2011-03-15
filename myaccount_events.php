<?php
//BindEvents Method @1-F677E9D2
function BindEvents()
{
    global $smart_user;
    $smart_user->CCSEvents["BeforeShow"] = "smart_user_BeforeShow";
    $smart_user->CCSEvents["AfterUpdate"] = "smart_user_AfterUpdate";
    $smart_user->CCSEvents["BeforeUpdate"] = "smart_user_BeforeUpdate";
    $smart_user->CCSEvents["OnValidate"] = "smart_user_OnValidate";
    $smart_user->ds->CCSEvents["BeforeBuildUpdate"] = "smart_user_ds_BeforeBuildUpdate";
}
//End BindEvents Method

//smart_user_BeforeShow @5-84BB255C
function smart_user_BeforeShow(& $sender)
{
    $smart_user_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_user; //Compatibility
//End smart_user_BeforeShow

//Custom Code @28-2A29BDB7
// -------------------------
    $smart_user->datemodified->SetValue(date("Y-m-d H:i:s"));
	$smart_user->usr_group->SetValue(GetCodeDescription("usrgroup",$smart_user->usr_group->GetValue()));
// -------------------------
//End Custom Code

//Close smart_user_BeforeShow @5-2D5C3BA3
    return $smart_user_BeforeShow;
}
//End Close smart_user_BeforeShow

//smart_user_AfterUpdate @5-70E1BC22
function smart_user_AfterUpdate(& $sender)
{
    $smart_user_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_user; //Compatibility
//End smart_user_AfterUpdate

//Custom Code @30-2A29BDB7
// -------------------------
    LogActivity(CCGetSession("UserLogin"),"UPDATE","","Successfully Updated Account Profile",date('Y-m-d H:i:s'));
	$smart_user->Errors->addError("Profile has updated!");
// -------------------------
//End Custom Code

//Close smart_user_AfterUpdate @5-F9765529
    return $smart_user_AfterUpdate;
}
//End Close smart_user_AfterUpdate

//smart_user_BeforeUpdate @5-DC5BF03A
function smart_user_BeforeUpdate(& $sender)
{
    $smart_user_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_user; //Compatibility
//End smart_user_BeforeUpdate

//Custom Code @35-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close smart_user_BeforeUpdate @5-A1852878
    return $smart_user_BeforeUpdate;
}
//End Close smart_user_BeforeUpdate

//smart_user_OnValidate @5-15FC95EA
function smart_user_OnValidate(& $sender)
{
    $smart_user_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_user; //Compatibility
//End smart_user_OnValidate

//Custom Code @36-2A29BDB7
// -------------------------
    $password = $smart_user->usr_password->GetValue();
	$vpassword = $smart_user->usr_vpassword->GetValue();
	if ($password != $vpassword) {
		$smart_user->Errors->addError("Please verify your password correctly!");
	}
// -------------------------
//End Custom Code

//Close smart_user_OnValidate @5-12A75F2A
    return $smart_user_OnValidate;
}
//End Close smart_user_OnValidate

//smart_user_ds_BeforeBuildUpdate @5-653003AA
function smart_user_ds_BeforeBuildUpdate(& $sender)
{
    $smart_user_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_user; //Compatibility
//End smart_user_ds_BeforeBuildUpdate

//Custom Code @37-2A29BDB7
// -------------------------
    if($smart_user->usr_password->GetValue() == null && $smart_user->usr_vpassword->GetValue() == null) {
		$smart_user->ds->usr_password->SetValue($smart_user->ds->Password->GetValue);
	} else {
		if($smart_user->usr_password->GetValue() == $smart_user->usr_vpassword->GetValue()) {
			$smart_user->ds->Password->SetValue($smart_user->ds->usr_password->GetValue());
		} else {
			$smart_user->ds->usr_password->SetValue($smart_user->ds->Password->GetValue());
		}
	}
// -------------------------
//End Custom Code

//Close smart_user_ds_BeforeBuildUpdate @5-A72AEEBB
    return $smart_user_ds_BeforeBuildUpdate;
}
//End Close smart_user_ds_BeforeBuildUpdate


?>
