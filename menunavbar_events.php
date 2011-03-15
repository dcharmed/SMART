<?php
// //Events @1-F81417CB

//menunavbar_AfterInitialize @1-1BBB2503
function menunavbar_AfterInitialize(& $sender)
{
    $menunavbar_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menunavbar, $MenuAdmin, $MenuHelpdesk; //Compatibility
//End menunavbar_AfterInitialize

//Custom Code @11-2A29BDB7
// -------------------------
	$menunavbar->MenuHelpdesk->Visible = false;
	$menunavbar->MenuAdmin->Visible = false;
	switch(CCGetSession("GroupID")) {
		case 1:
			$menunavbar->MenuAdmin->Visible = true;
		break;
		default:
			echo "bongok";
			$menunavbar->MenuHelpdesk->Visible = true;
		break;
	}
// -------------------------
//End Custom Code

//Close menunavbar_AfterInitialize @1-A9D28ECA
    return $menunavbar_AfterInitialize;
}
//End Close menunavbar_AfterInitialize
?>
