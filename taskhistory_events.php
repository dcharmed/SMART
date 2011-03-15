<?php
//BindEvents Method @1-C2720943
function BindEvents()
{
    global $GTaskHistory;
    $GTaskHistory->CCSEvents["BeforeShowRow"] = "GTaskHistory_BeforeShowRow";
    $GTaskHistory->CCSEvents["BeforeShow"] = "GTaskHistory_BeforeShow";
}
//End BindEvents Method

//GTaskHistory_BeforeShowRow @5-4D82534D
function GTaskHistory_BeforeShowRow(& $sender)
{
    $GTaskHistory_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTaskHistory,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GTaskHistory_BeforeShowRow

//Set Row Style @30-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @44-2A29BDB7
// -------------------------
    $GTaskHistory->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$GTaskHistory->task_current->SetValue(GetCodeDescription("tcktstatus",$GTaskHistory->task_current->GetValue()));
	$GTaskHistory->task_update->SetValue(GetCodeDescription("tcktstatus",$GTaskHistory->task_update->GetValue()));
	$GTaskHistory->task_currenteng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GTaskHistory->task_currenteng->GetValue(),$DBSMART));
	$GTaskHistory->task_updatedeng->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GTaskHistory->task_updatedeng->GetValue(),$DBSMART));
	switch($GTaskHistory->task_status->GetValue()) {
		case 1:
			$GTaskHistory->task_status->SetValue("Accepted");
			break;
		case 2:
			$GTaskHistory->task_status->SetValue("Declined");
			break;
		default:
			$GTaskHistory->task_status->SetValue("Not Responded");
			break;
	}
// -------------------------
//End Custom Code

//Close GTaskHistory_BeforeShowRow @5-F720388B
    return $GTaskHistory_BeforeShowRow;
}
//End Close GTaskHistory_BeforeShowRow

//GTaskHistory_BeforeShow @5-8BC21E9E
function GTaskHistory_BeforeShow(& $sender)
{
    $GTaskHistory_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GTaskHistory,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GTaskHistory_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
    if($GTaskHistory->PageNumber != null){
		$PageFirstRecordNo = ($GTaskHistory->PageSize * ($GTaskHistory->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GTaskHistory->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GTaskHistory->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GTaskHistory_BeforeShow @5-58AEA3C0
    return $GTaskHistory_BeforeShow;
}
//End Close GTaskHistory_BeforeShow


?>
