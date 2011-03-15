<?php
//BindEvents Method @1-91EC9319
function BindEvents()
{
    global $GStock;
    global $RStock;
    global $CCSEvents;
    $GStock->CCSEvents["BeforeShow"] = "GStock_BeforeShow";
    $GStock->CCSEvents["BeforeShowRow"] = "GStock_BeforeShowRow";
    $RStock->Button_Insert->CCSEvents["OnClick"] = "RStock_Button_Insert_OnClick";
    $RStock->CCSEvents["BeforeShow"] = "RStock_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GStock_BeforeShow @5-3314C20E
function GStock_BeforeShow(& $sender)
{
    $GStock_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStock,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GStock_BeforeShow

//Custom Code @24-2A29BDB7
// -------------------------
    if($GStock->PageNumber != null){
		$PageFirstRecordNo = ($GStock->PageSize * ($GStock->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GStock->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GStock->lblNumber->SetValue($BilRekod);

	$QryName = CCGetParam("qryn");
	$QryCode = CCGetParam("qryc");
	$ItemName = CCDlookUp("spart_name", "smart_sparepart", "spart_code='".$QryCode."' OR spart_name='".$QryName."'",$DBSMART);
	$ItemCode = CCDlookUp("spart_code", "smart_sparepart", "spart_code='".$QryCode."' OR spart_name='".$QryName."'",$DBSMART);
	$ItemNumber = CCDlookUp("spart_number", "smart_sparepart", "spart_code='".$QryCode."' OR spart_name='".$QryName."'",$DBSMART);

	$GStock->stock_item->SetValue($ItemName);
	$GStock->stock_code->SetValue($ItemCode);
	$GStock->stock_number->SetValue($ItemNumber);	

	$GStock->BtnUpdStock->SetLink("smartpstock.php?upd=1&qryn=".CCGetParam("qryn")."&qryc=".CCGetParam("qryc"));
// -------------------------
//End Custom Code

//Close GStock_BeforeShow @5-8D29AB11
    return $GStock_BeforeShow;
}
//End Close GStock_BeforeShow

//GStock_BeforeShowRow @5-065A21A0
function GStock_BeforeShowRow(& $sender)
{
    $GStock_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GStock,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GStock_BeforeShowRow

//Custom Code @25-2A29BDB7
// -------------------------
    $GStock->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GStock_BeforeShowRow @5-C06EFBD2
    return $GStock_BeforeShowRow;
}
//End Close GStock_BeforeShowRow

//RStock_Button_Insert_OnClick @32-C164A25F
function RStock_Button_Insert_OnClick(& $sender)
{
    $RStock_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RStock, $Redirect; //Compatibility
//End RStock_Button_Insert_OnClick

//Custom Code @46-2A29BDB7
// -------------------------
    $Redirect = "smartpstock.php?qryc=".$RStock->pstock_itemcode->GetValue();
// -------------------------
//End Custom Code

//Close RStock_Button_Insert_OnClick @32-2D57C6B7
    return $RStock_Button_Insert_OnClick;
}
//End Close RStock_Button_Insert_OnClick

//RStock_BeforeShow @31-59758F76
function RStock_BeforeShow(& $sender)
{
    $RStock_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RStock, $DBSMART; //Compatibility
//End RStock_BeforeShow

//Custom Code @47-2A29BDB7
// -------------------------
    $RStock->pstock_itemcode->SetValue(CCGetParam("qryc"));

	$IDMaxBalance = CCDLookUp("max(id)","smart_partsstock","pstock_itemcode='".CCGetParam("qryc")."' OR pstock_itemname='".CCGetParam("qryn")."'",$DBSMART);
	echo "adda".$BalanceStock = CCDLookUp("pstock_balance","smart_partsstock","id=".$IDMaxBalance,$DBSMART);

	$RStock->pstock_balance->SetValue($BalanceStock);
// -------------------------
//End Custom Code

//Close RStock_BeforeShow @31-A0E11DA1
    return $RStock_BeforeShow;
}
//End Close RStock_BeforeShow

//Page_AfterInitialize @1-AAB0DE1D
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartpstock, $SStock, $GStock, $RStock; //Compatibility
//End Page_AfterInitialize

//Custom Code @26-2A29BDB7
// -------------------------
    $GStock->Visible = false;
	$RStock->Visible = false;

	if((CCGetParam("qryc")!=null || CCGetParam("qryn")!=null) && CCGetParam("upd")==null) {
		$GStock->Visible = true;
	} elseif(CCGetParam("upd")== 1 && (CCGetParam("qryn")!=null || CCGetParam("qryc")!=null)) {
		$RStock->Visible = true;
		$SStock->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
