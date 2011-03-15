<?php
// //Events @1-F81417CB

//reportrtn_smart_partsorders_BeforeShowRow @2-825CC52D
function reportrtn_smart_partsorders_BeforeShowRow(& $sender)
{
    $reportrtn_smart_partsorders_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportrtn,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End reportrtn_smart_partsorders_BeforeShowRow

//Custom Code @18-2A29BDB7
// -------------------------
    $reportrtn->smart_partsorders->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$Engineer = CCDLookUp("preq_engineer","smart_partsrequisition","id=".CCGetParam("id"),$DBSMART);
	$FormNo = CCDLookUp("preq_formno","smart_partsrequisition","id=".CCGetParam("id"),$DBSMART);

	$reportrtn->smart_partsorders->engineer->SetValue($Engineer);
	$reportrtn->smart_partsorders->formno->SetValue($FormNo);
// -------------------------
//End Custom Code

//Close reportrtn_smart_partsorders_BeforeShowRow @2-9B063968
    return $reportrtn_smart_partsorders_BeforeShowRow;
}
//End Close reportrtn_smart_partsorders_BeforeShowRow

//reportrtn_smart_partsorders_BeforeShow @2-E90FE3B2
function reportrtn_smart_partsorders_BeforeShow(& $sender)
{
    $reportrtn_smart_partsorders_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportrtn,$BilRekod, $PageFirstRecordNo; //Compatibility
//End reportrtn_smart_partsorders_BeforeShow

//Custom Code @19-2A29BDB7
// -------------------------
    if($reportrtn->smart_partsorders->PageNumber != null){
		$PageFirstRecordNo = ($reportrtn->smart_partsorders->PageSize * ($reportrtn->smart_partsorders->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($reportrtn->smart_partsorders->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$reportrtn->smart_partsorders->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close reportrtn_smart_partsorders_BeforeShow @2-0705B39F
    return $reportrtn_smart_partsorders_BeforeShow;
}
//End Close reportrtn_smart_partsorders_BeforeShow


?>
