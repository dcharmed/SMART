<?php
//BindEvents Method @1-34322125
function BindEvents()
{
    global $Button_DoSearch;
    $Button_DoSearch->CCSEvents["OnClick"] = "Button_DoSearch_OnClick";
}
//End BindEvents Method

//Button_DoSearch_OnClick @22-6939D79D
function Button_DoSearch_OnClick(& $sender)
{
    $Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Button_DoSearch; //Compatibility
//End Button_DoSearch_OnClick

//Custom Code @23-2A29BDB7
// -------------------------
    $Redirect = "AdmRefMngmt.php?s_code=".CCGetParam("s_code")."&type=".$OptReferenceCode->type->GetValue();
// -------------------------
//End Custom Code

//Close Button_DoSearch_OnClick @22-F4EB52A8
    return $Button_DoSearch_OnClick;
}
//End Close Button_DoSearch_OnClick


?>
