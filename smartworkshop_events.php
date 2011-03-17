<?php
//BindEvents Method @1-AD6DEA6F
function BindEvents()
{
    global $GEquipmentList;
    global $REquipmentForm;
    global $CCSEvents;
    $GEquipmentList->CCSEvents["BeforeShowRow"] = "GEquipmentList_BeforeShowRow";
    $REquipmentForm->CCSEvents["AfterInsert"] = "REquipmentForm_AfterInsert";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GEquipmentList_BeforeShowRow @5-9507971E
function GEquipmentList_BeforeShowRow(& $sender)
{
    $GEquipmentList_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GEquipmentList; //Compatibility
//End GEquipmentList_BeforeShowRow

//Set Row Style @18-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close GEquipmentList_BeforeShowRow @5-4386FF52
    return $GEquipmentList_BeforeShowRow;
}
//End Close GEquipmentList_BeforeShowRow

//REquipmentForm_AfterInsert @30-7A6900CF
function REquipmentForm_AfterInsert(& $sender)
{
    $REquipmentForm_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $REquipmentForm, $Redirect; //Compatibility
//End REquipmentForm_AfterInsert

//Custom Code @85-2A29BDB7
// -------------------------
    
	$Redirect = "";
// -------------------------
//End Custom Code

//Close REquipmentForm_AfterInsert @30-C9035F39
    return $REquipmentForm_AfterInsert;
}
//End Close REquipmentForm_AfterInsert

//Page_AfterInitialize @1-4F5C03AF
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartworkshop, $SEquipment, $GEquipmentList, $REquipmentForm, $GEquipmentRelated; //Compatibility
//End Page_AfterInitialize

//Custom Code @86-2A29BDB7
// -------------------------
    
	if(CCGetParam("new")==1 || (CCGetParam("view")==1 && CCGetParam("eid")!=null)) {
		$SEquipment->Visible = false;
		$GEquipmentList->Visible = false;
	} else {
		$REquipmentForm->Visible = false;
		$GEquipmentRelated->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize
?>
