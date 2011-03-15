<?php
//BindEvents Method @1-ADE895F3
function BindEvents()
{
    global $GReferenceCode;
    global $RReferenceCode;
    $GReferenceCode->CCSEvents["BeforeShowRow"] = "GReferenceCode_BeforeShowRow";
    $RReferenceCode->CCSEvents["BeforeShow"] = "RReferenceCode_BeforeShow";
}
//End BindEvents Method

//GReferenceCode_BeforeShowRow @2-14561E8D
function GReferenceCode_BeforeShowRow(& $sender)
{
    $GReferenceCode_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReferenceCode; //Compatibility
//End GReferenceCode_BeforeShowRow

//Set Row Style @5-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close GReferenceCode_BeforeShowRow @2-14073C80
    return $GReferenceCode_BeforeShowRow;
}
//End Close GReferenceCode_BeforeShowRow

//RReferenceCode_BeforeShow @17-09183B64
function RReferenceCode_BeforeShow(& $sender)
{
    $RReferenceCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RReferenceCode; //Compatibility
//End RReferenceCode_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
    if(CCGetParam("new")==1) $RReferenceCode->ref_type->SetValue(CCGetParam("type"));
// -------------------------
//End Custom Code

//Close RReferenceCode_BeforeShow @17-E633355E
    return $RReferenceCode_BeforeShow;
}
//End Close RReferenceCode_BeforeShow


?>
