<?php
// //Events @1-F81417CB

//smartheader_AfterInitialize @1-2D5C4B99
function smartheader_AfterInitialize(& $sender)
{
    $smartheader_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartheader, $smart_ticket; //Compatibility
//End smartheader_AfterInitialize

//Logout @5-1812E729
    if(strlen(CCGetParam("Logout", ""))) 
    {
        CCLogoutUser();
        CCSetCookie("SMARTLogin", "");
        global $Redirect;
        $Redirect = "index.php";
    }
//End Logout

//Custom Code @55-2A29BDB7
// -------------------------
    $smartheader->smart_ticket->Visible = false;
// -------------------------
//End Custom Code


//Close smartheader_AfterInitialize @1-1EB48CF0
    return $smartheader_AfterInitialize;
}
//End Close smartheader_AfterInitialize
?>
