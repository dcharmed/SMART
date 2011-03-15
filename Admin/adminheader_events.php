<?php
// //Events @1-F81417CB

//DEL  function smartheader_smart_user_BeforeShow(& $sender)
//DEL  {
//DEL      $smartheader_smart_user_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $smartheader, $smart_user; //Compatibility


//DEL  // -------------------------
//DEL  	$smart_user->usr_group->SetValue(GetCodeDescription("usrgroup",$smart_user->usr_group->GetValue()));
//DEL  // -------------------------

//adminheader_AfterInitialize @1-AF88959C
function adminheader_AfterInitialize(& $sender)
{
    $adminheader_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $adminheader; //Compatibility
//End adminheader_AfterInitialize

//Logout @5-DBE258E1
    if(strlen(CCGetParam("Logout", ""))) 
    {
        CCLogoutUser();
        CCSetCookie("SMARTLogin", "");
        global $Redirect;
        $Redirect = "../index.php";
    }
//End Logout

//Close adminheader_AfterInitialize @1-18FC123F
    return $adminheader_AfterInitialize;
}
//End Close adminheader_AfterInitialize
?>
