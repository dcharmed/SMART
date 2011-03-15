<?php
// //Events @1-F81417CB

//menunav_AfterInitialize @1-0B3D779D
function menunav_AfterInitialize(& $sender)
{
    $menunav_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menunav, $MenuAdmin, $MenuHelpdesk; //Compatibility
//End menunav_AfterInitialize

//Custom Code @30-2A29BDB7
// -------------------------
    switch(CCGetSession("GroupID")) {
		case 1 :
		echo "AAAAAAAAAAAAAA";
			$menunav->MenuAdmin->Visible = true;
			$menunav->MenuHelpdesk->Visible = false;
		break;
	}
// -------------------------
//End Custom Code

//Close menunav_AfterInitialize @1-4CD79129
    return $menunav_AfterInitialize;
}
//End Close menunav_AfterInitialize


?>
