<?php
// //Events @1-F81417CB

//resolutionnotes_smart_resolution_Button_Insert_OnClick @13-1076E830
function resolutionnotes_smart_resolution_Button_Insert_OnClick(& $sender)
{
    $resolutionnotes_smart_resolution_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_smart_resolution_Button_Insert_OnClick

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close resolutionnotes_smart_resolution_Button_Insert_OnClick @13-1BE8CBB2
    return $resolutionnotes_smart_resolution_Button_Insert_OnClick;
}
//End Close resolutionnotes_smart_resolution_Button_Insert_OnClick

//resolutionnotes_smart_resolution_BeforeShow @12-17773B13
function resolutionnotes_smart_resolution_BeforeShow(& $sender)
{
    $resolutionnotes_smart_resolution_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes, $smart_resolution, $DBSMART; //Compatibility
//End resolutionnotes_smart_resolution_BeforeShow

//Custom Code @67-2A29BDB7
// -------------------------
	$db = new clsDBSMART();
	$resolutionnotes->smart_resolution->ticket_id->SetValue(CCGetParam("tcktid"));
	$sql = "SELECT tckt_refnumber, tckt_toppanid, tckt_tagrelated, tckt_site, tckt_state, tckt_date, tckt_subcategory from smart_ticket where id=".CCGetParam("tcktid");
	$db->query($sql);
    $Result = $db->next_record();
    if ($Result) {
		$ticketnumber = $db->f("tckt_refnumber");
		$ticketstate = $db->f("tckt_state");
		$tickettoppan = $db->f("tckt_toppanid");
        $ticketsite = $db->f("tckt_site");
        $ticketdate = $db->f("tckt_date");
		$tickettagref = $db->f("tckt_subcategory");
		$tickettag = $db->f("tckt_tagrelated");
    }
	$resolutionnotes->smart_resolution->site->SetValue(GetCodeDescription($ticketstate,$ticketsite));
	$resolutionnotes->smart_resolution->ticketNumber->SetValue($ticketnumber);
	$resolutionnotes->smart_resolution->ticketRelated->SetValue(GetCodeDescription($tickettagref,$tickettag));
	$resolutionnotes->smart_resolution->ticketToppanid->SetValue($tickettoppan);
// -------------------------
//End Custom Code

//Close resolutionnotes_smart_resolution_BeforeShow @12-6337A789
    return $resolutionnotes_smart_resolution_BeforeShow;
}
//End Close resolutionnotes_smart_resolution_BeforeShow

//resolutionnotes_smart_resolution_AfterInsert @12-52BDB6D3
function resolutionnotes_smart_resolution_AfterInsert(& $sender)
{
    $resolutionnotes_smart_resolution_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes, $Redirect; //Compatibility
//End resolutionnotes_smart_resolution_AfterInsert

//Custom Code @69-2A29BDB7
// -------------------------
	$DBSmart = new clsDBSMART();
	$rid = CCDlookUp("max(id)", "smart_resolutionnote", "ticket_id=".$resolutionnotes->smart_resolution->ticket_id->GetValue(), $DBSmart);

    $Redirect = "ticketactivity.php?tcktid=".CCGetParam("tcktid")."&rid=".$rid;
// -------------------------
//End Custom Code

//Close resolutionnotes_smart_resolution_AfterInsert @12-EDAA36EC
    return $resolutionnotes_smart_resolution_AfterInsert;
}
//End Close resolutionnotes_smart_resolution_AfterInsert

//resolutionnotes_TabCMActivity_BeforeShow @4-B6C2C9A3
function resolutionnotes_TabCMActivity_BeforeShow(& $sender)
{
    $resolutionnotes_TabCMActivity_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_TabCMActivity_BeforeShow

//resolutionnotesPanel1TabCMActivityYahooTabbedTab BeforeShow @5-658C6CB2
    $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1TabCMActivity\">";
    $Component->BlockSuffix = "</div>";
//End resolutionnotesPanel1TabCMActivityYahooTabbedTab BeforeShow

//Close resolutionnotes_TabCMActivity_BeforeShow @4-69D2191B
    return $resolutionnotes_TabCMActivity_BeforeShow;
}
//End Close resolutionnotes_TabCMActivity_BeforeShow

//resolutionnotes_smart_equipment_BeforeShow @41-99A4F000
function resolutionnotes_smart_equipment_BeforeShow(& $sender)
{
    $resolutionnotes_smart_equipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_smart_equipment_BeforeShow

//Custom Code @133-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close resolutionnotes_smart_equipment_BeforeShow @41-265D0A47
    return $resolutionnotes_smart_equipment_BeforeShow;
}
//End Close resolutionnotes_smart_equipment_BeforeShow

//resolutionnotes_smart_faultyequipment_BeforeShow @137-EF99230E
function resolutionnotes_smart_faultyequipment_BeforeShow(& $sender)
{
    $resolutionnotes_smart_faultyequipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_smart_faultyequipment_BeforeShow

//Custom Code @151-2A29BDB7
// -------------------------
	$resolutionnotes->smart_faultyequipment->resolution_id->SetValue(CCGetParam("rid"));
// -------------------------
//End Custom Code

//Close resolutionnotes_smart_faultyequipment_BeforeShow @137-5F243F51
    return $resolutionnotes_smart_faultyequipment_BeforeShow;
}
//End Close resolutionnotes_smart_faultyequipment_BeforeShow

//resolutionnotes_Panel2_BeforeShow @131-564DE175
function resolutionnotes_Panel2_BeforeShow(& $sender)
{
    $resolutionnotes_Panel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_Panel2_BeforeShow

//resolutionnotesPanel1TabEquipmentPanel2UpdatePanel Page BeforeShow @132-A1612ACF
    global $CCSFormFilter;
    if ($CCSFormFilter == "resolutionnotesPanel1TabEquipmentPanel2") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1TabEquipmentPanel2\">";
        $Component->BlockSuffix = "</div>";
    }
//End resolutionnotesPanel1TabEquipmentPanel2UpdatePanel Page BeforeShow

//Close resolutionnotes_Panel2_BeforeShow @131-74A6322B
    return $resolutionnotes_Panel2_BeforeShow;
}
//End Close resolutionnotes_Panel2_BeforeShow

//DEL  // -------------------------
//DEL      $resolutionnotes->smart_equipment->querystring->SetValue("tcktid=".CCGetParam("tcktid")."&rid=".CCGetParam("rid"));
//DEL  // -------------------------

//resolutionnotes_TabEquipment_BeforeShow @6-261204B8
function resolutionnotes_TabEquipment_BeforeShow(& $sender)
{
    $resolutionnotes_TabEquipment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_TabEquipment_BeforeShow

//resolutionnotesPanel1TabEquipmentYahooTabbedTab BeforeShow @7-43BE1B13
    $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1TabEquipment\">";
    $Component->BlockSuffix = "</div>";
//End resolutionnotesPanel1TabEquipmentYahooTabbedTab BeforeShow

//Close resolutionnotes_TabEquipment_BeforeShow @6-C370A17B
    return $resolutionnotes_TabEquipment_BeforeShow;
}
//End Close resolutionnotes_TabEquipment_BeforeShow

//resolutionnotes_TabSparePart_BeforeShow @8-20400A42
function resolutionnotes_TabSparePart_BeforeShow(& $sender)
{
    $resolutionnotes_TabSparePart_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_TabSparePart_BeforeShow

//resolutionnotesPanel1TabSparePartYahooTabbedTab BeforeShow @9-467AD10B
    $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1TabSparePart\">";
    $Component->BlockSuffix = "</div>";
//End resolutionnotesPanel1TabSparePartYahooTabbedTab BeforeShow

//Close resolutionnotes_TabSparePart_BeforeShow @8-A4819D38
    return $resolutionnotes_TabSparePart_BeforeShow;
}
//End Close resolutionnotes_TabSparePart_BeforeShow

//resolutionnotes_TabReplacement_BeforeShow @10-D6165E43
function resolutionnotes_TabReplacement_BeforeShow(& $sender)
{
    $resolutionnotes_TabReplacement_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_TabReplacement_BeforeShow

//resolutionnotesPanel1TabReplacementYahooTabbedTab BeforeShow @11-EFD5BA81
    $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1TabReplacement\">";
    $Component->BlockSuffix = "</div>";
//End resolutionnotesPanel1TabReplacementYahooTabbedTab BeforeShow

//Close resolutionnotes_TabReplacement_BeforeShow @10-685D59E8
    return $resolutionnotes_TabReplacement_BeforeShow;
}
//End Close resolutionnotes_TabReplacement_BeforeShow

//resolutionnotes_Panel1_BeforeShow @2-D05CDCBD
function resolutionnotes_Panel1_BeforeShow(& $sender)
{
    $resolutionnotes_Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_Panel1_BeforeShow

//resolutionnotesPanel1YahooTabbedView BeforeShow @3-83F4DD1B
    $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1\">";
    $Component->BlockSuffix = "</div>";
//End resolutionnotesPanel1YahooTabbedView BeforeShow

//resolutionnotesPanel1UpdatePanel1 Page BeforeShow @94-D3D54965
    global $CCSFormFilter;
    if ($CCSFormFilter == "resolutionnotesPanel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"resolutionnotesPanel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End resolutionnotesPanel1UpdatePanel1 Page BeforeShow

//Close resolutionnotes_Panel1_BeforeShow @2-08C717F0
    return $resolutionnotes_Panel1_BeforeShow;
}
//End Close resolutionnotes_Panel1_BeforeShow

//resolutionnotes_BeforeInitialize @1-42FBB963
function resolutionnotes_BeforeInitialize(& $sender)
{
    $resolutionnotes_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_BeforeInitialize

//resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeInitialize @132-BFD6BAC5
    if (CCGetFromGet("FormFilter") == "resolutionnotesPanel1TabEquipmentPanel2" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeInitialize

//resolutionnotesPanel1UpdatePanel1 PageBeforeInitialize @94-5F2A0CA0
    if (CCGetFromGet("FormFilter") == "resolutionnotesPanel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End resolutionnotesPanel1UpdatePanel1 PageBeforeInitialize

//Close resolutionnotes_BeforeInitialize @1-12A33430
    return $resolutionnotes_BeforeInitialize;
}
//End Close resolutionnotes_BeforeInitialize

//resolutionnotes_AfterInitialize @1-3B3A6F74
function resolutionnotes_AfterInitialize(& $sender)
{
    $resolutionnotes_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_AfterInitialize

//Close resolutionnotes_AfterInitialize @1-1C87C733
    return $resolutionnotes_AfterInitialize;
}
//End Close resolutionnotes_AfterInitialize

//resolutionnotes_BeforeShow @1-3CEC4200
function resolutionnotes_BeforeShow(& $sender)
{
    $resolutionnotes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_BeforeShow

//resolutionnotesPanel1TabEquipmentPanel2UpdatePanel Page BeforeShow @132-A330824C
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "resolutionnotesPanel1TabEquipmentPanel2") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End resolutionnotesPanel1TabEquipmentPanel2UpdatePanel Page BeforeShow

//resolutionnotesPanel1UpdatePanel1 Page BeforeShow @94-D67D9D6B
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "resolutionnotesPanel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End resolutionnotesPanel1UpdatePanel1 Page BeforeShow

//Close resolutionnotes_BeforeShow @1-C2EF23B7
    return $resolutionnotes_BeforeShow;
}
//End Close resolutionnotes_BeforeShow

//resolutionnotes_BeforeOutput @1-25B9C0E0
function resolutionnotes_BeforeOutput(& $sender)
{
    $resolutionnotes_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_BeforeOutput

//resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeOutput @132-1B423C54
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "resolutionnotesPanel1TabEquipmentPanel2") {
        $main_block = $Tpl->getvar("/resolutionnotes/Panel Panel1/Panel TabEquipment/Panel Panel2");
    }
//End resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeOutput

//resolutionnotesPanel1UpdatePanel1 PageBeforeOutput @94-BE943E76
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "resolutionnotesPanel1") {
        $main_block = $Tpl->getvar("/resolutionnotes/Panel Panel1");
    }
//End resolutionnotesPanel1UpdatePanel1 PageBeforeOutput

//Close resolutionnotes_BeforeOutput @1-D80A9807
    return $resolutionnotes_BeforeOutput;
}
//End Close resolutionnotes_BeforeOutput

//resolutionnotes_BeforeUnload @1-FEE5CE65
function resolutionnotes_BeforeUnload(& $sender)
{
    $resolutionnotes_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resolutionnotes; //Compatibility
//End resolutionnotes_BeforeUnload

//resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeUnload @132-2064FEEE
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "resolutionnotesPanel1TabEquipmentPanel2") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End resolutionnotesPanel1TabEquipmentPanel2UpdatePanel PageBeforeUnload

//resolutionnotesPanel1UpdatePanel1 PageBeforeUnload @94-B52063B6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "resolutionnotesPanel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End resolutionnotesPanel1UpdatePanel1 PageBeforeUnload

//Close resolutionnotes_BeforeUnload @1-9EC09ECD
    return $resolutionnotes_BeforeUnload;
}
//End Close resolutionnotes_BeforeUnload


?>
