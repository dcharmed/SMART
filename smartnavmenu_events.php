<?php
// //Events @1-F81417CB

//smartnavmenu_AfterInitialize @1-179AF317
function smartnavmenu_AfterInitialize(& $sender)
{
    $smartnavmenu_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartnavmenu; //Compatibility
//End smartnavmenu_AfterInitialize

//Custom Code @29-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close smartnavmenu_AfterInitialize @1-73EE485D
    return $smartnavmenu_AfterInitialize;
}
//End Close smartnavmenu_AfterInitialize

?>
