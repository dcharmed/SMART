<?php
//BindEvents Method @1-D05BC3C2
function BindEvents()
{
    global $smart_resolutionnote;
    $smart_resolutionnote->CCSEvents["BeforeShowRow"] = "smart_resolutionnote_BeforeShowRow";
}
//End BindEvents Method

//smart_resolutionnote_BeforeShowRow @6-8EBE0194
function smart_resolutionnote_BeforeShowRow(& $sender)
{
    $smart_resolutionnote_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smart_resolutionnote; //Compatibility
//End smart_resolutionnote_BeforeShowRow

//Set Row Style @15-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close smart_resolutionnote_BeforeShowRow @6-A4C9BF19
    return $smart_resolutionnote_BeforeShowRow;
}
//End Close smart_resolutionnote_BeforeShowRow


?>
