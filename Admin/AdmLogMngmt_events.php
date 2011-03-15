<?php
//BindEvents Method @1-A9B2E5CF
function BindEvents()
{
    global $GLog;
    global $RLog;
    global $CCSEvents;
    $GLog->CCSEvents["BeforeShowRow"] = "GLog_BeforeShowRow";
    $GLog->CCSEvents["BeforeShow"] = "GLog_BeforeShow";
    $RLog->Button_Cancel->CCSEvents["OnClick"] = "RLog_Button_Cancel_OnClick";
    $RLog->CCSEvents["AfterDelete"] = "RLog_AfterDelete";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GLog_BeforeShowRow @5-EB0F0921
function GLog_BeforeShowRow(& $sender)
{
    $GLog_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GLog,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GLog_BeforeShowRow

//Set Row Style @21-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @57-2A29BDB7
// -------------------------
    $GLog->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GLog_BeforeShowRow @5-32D08A37
    return $GLog_BeforeShowRow;
}
//End Close GLog_BeforeShowRow

//GLog_BeforeShow @5-262ED46F
function GLog_BeforeShow(& $sender)
{
    $GLog_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GLog,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GLog_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
    if($GLog->PageNumber != null){
		$PageFirstRecordNo = ($GLog->PageSize * ($GLog->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GLog->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GLog->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GLog_BeforeShow @5-4C93E4F5
    return $GLog_BeforeShow;
}
//End Close GLog_BeforeShow

//RLog_Button_Cancel_OnClick @38-7A4DCC32
function RLog_Button_Cancel_OnClick(& $sender)
{
    $RLog_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RLog, $Redirect; //Compatibility
//End RLog_Button_Cancel_OnClick

//Custom Code @58-2A29BDB7
// -------------------------
    $Redirect = "AdmLogMngmt.php";
// -------------------------
//End Custom Code

//Close RLog_Button_Cancel_OnClick @38-A25D0720
    return $RLog_Button_Cancel_OnClick;
}
//End Close RLog_Button_Cancel_OnClick

//RLog_AfterDelete @35-63FB1567
function RLog_AfterDelete(& $sender)
{
    $RLog_AfterDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RLog, $Redirect; //Compatibility
//End RLog_AfterDelete

//Custom Code @61-2A29BDB7
// -------------------------
    $Redirect = "AdmLogMngmt.php";
// -------------------------
//End Custom Code

//Close RLog_AfterDelete @35-2D62F5B9
    return $RLog_AfterDelete;
}
//End Close RLog_AfterDelete

//Page_AfterInitialize @1-D155B5C3
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AdmLogMngmt, $SLog, $RLog, $GLog; //Compatibility
//End Page_AfterInitialize

//Custom Code @54-2A29BDB7
// -------------------------
    if(CCGetParam("id")!=null && CCGetParam("type")==null) {
		$SLog->Visible = false;
		$GLog->Visible = false;
		$RLog->Visible = true;
	} elseif(CCGetParam("id")!=null && CCGetParam("type")=='del') {
		$SLog->Visible = false;
		$GLog->Visible = false;
		$RLog->Visible = true;
	} else {
		$SLog->Visible = true;
		$GLog->Visible = true;
		$RLog->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
