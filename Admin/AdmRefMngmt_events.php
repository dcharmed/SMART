<?php
//BindEvents Method @1-7787E6D4
function BindEvents()
{
    global $GReferenceCode;
    global $RReferenceCode;
    global $OptReferenceCode;
    global $CCSEvents;
    $GReferenceCode->CCSEvents["BeforeShowRow"] = "GReferenceCode_BeforeShowRow";
    $GReferenceCode->CCSEvents["BeforeShow"] = "GReferenceCode_BeforeShow";
    $RReferenceCode->CCSEvents["BeforeShow"] = "RReferenceCode_BeforeShow";
    $OptReferenceCode->Button_DoSearch->CCSEvents["OnClick"] = "OptReferenceCode_Button_DoSearch_OnClick";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GReferenceCode_BeforeShowRow @2-14561E8D
function GReferenceCode_BeforeShowRow(& $sender)
{
    $GReferenceCode_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReferenceCode,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
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

//Custom Code @39-2A29BDB7
// -------------------------
	$GReferenceCode->linkSubCat->Visible = false;
    $GReferenceCode->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	$countdata = GetCountedData("smart_referencecode","ref_type",$GReferenceCode->ref_value->GetValue());
	if($countdata > 0 && strlen(CCGetParam("type")) < 4) $GReferenceCode->linkSubCat->Visible = true;
	$GReferenceCode->linkSubCat->SetLink("AdmRefMngmt.php?s_code=".CCGetParam("s_code")."&type=".$GReferenceCode->ref_value->GetValue());
// -------------------------
//End Custom Code

//Close GReferenceCode_BeforeShowRow @2-14073C80
    return $GReferenceCode_BeforeShowRow;
}
//End Close GReferenceCode_BeforeShowRow

//GReferenceCode_BeforeShow @2-9AA38F50
function GReferenceCode_BeforeShow(& $sender)
{
    $GReferenceCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GReferenceCode,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GReferenceCode_BeforeShow

//Custom Code @38-2A29BDB7
// -------------------------
    if($GReferenceCode->PageNumber != null){
		$PageFirstRecordNo = ($GReferenceCode->PageSize * ($GReferenceCode->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GReferenceCode->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GReferenceCode->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GReferenceCode_BeforeShow @2-B78AEE0F
    return $GReferenceCode_BeforeShow;
}
//End Close GReferenceCode_BeforeShow

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

//OptReferenceCode_Button_DoSearch_OnClick @41-94357344
function OptReferenceCode_Button_DoSearch_OnClick(& $sender)
{
    $OptReferenceCode_Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $OptReferenceCode,$Redirect; //Compatibility
//End OptReferenceCode_Button_DoSearch_OnClick

//Custom Code @47-2A29BDB7
// -------------------------
    $Redirect = "AdmRefMngmt.php?s_code=".CCGetParam("s_code")."&type=".$OptReferenceCode->type->GetValue();
// -------------------------
//End Custom Code

//Close OptReferenceCode_Button_DoSearch_OnClick @41-EFC5E48B
    return $OptReferenceCode_Button_DoSearch_OnClick;
}
//End Close OptReferenceCode_Button_DoSearch_OnClick

//Page_AfterInitialize @1-3609501F
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmRefMngmt, $OptReferenceCode, $GReferenceCode,$RReferenceCode; //Compatibility
//End Page_AfterInitialize

//Custom Code @46-2A29BDB7
// -------------------------
	if(CCGetParam("s_code")!=null) $OptReferenceCode->Visible = true;
	else $OptReferenceCode->Visible = false;
    $GReferenceCode->Visible = false;
	$RReferenceCode->Visible = false;
	if(CCGetParam("type") != null) {
		$GReferenceCode->Visible = true;
		$RReferenceCode->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
