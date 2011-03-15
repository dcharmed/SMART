<?php
// //Events @1-F81417CB

//header_AfterInitialize @1-479693A0
function header_AfterInitialize(& $sender)
{
    $header_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_AfterInitialize

//Logout @5-23EE11BD
    if(strlen(CCGetParam("Logout", ""))) 
    {
        CCLogoutUser();
        CCSetCookie("SMARTLogin", "");
        global $Redirect;
        $Redirect = "header.php";
    }
//End Logout

//Close header_AfterInitialize @1-2FE08AE2
    return $header_AfterInitialize;
}
//End Close header_AfterInitialize


?>
