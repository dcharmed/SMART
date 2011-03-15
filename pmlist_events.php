<?php
//BindEvents Method @1-B24223A7
function BindEvents()
{
    global $GSmartPreventive;
    $GSmartPreventive->GSmartPreventive_TotalRecords->CCSEvents["BeforeShow"] = "GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow";
    $GSmartPreventive->CCSEvents["BeforeShowRow"] = "GSmartPreventive_BeforeShowRow";
    $GSmartPreventive->CCSEvents["BeforeShow"] = "GSmartPreventive_BeforeShow";
}
//End BindEvents Method

//GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow @12-29689638
function GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow(& $sender)
{
    $GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartPreventive; //Compatibility
//End GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow @12-ABA0A801
    return $GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow;
}
//End Close GSmartPreventive_GSmartPreventive_TotalRecords_BeforeShow

//GSmartPreventive_BeforeShowRow @5-264C877F
function GSmartPreventive_BeforeShowRow(& $sender)
{
    $GSmartPreventive_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartPreventive,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GSmartPreventive_BeforeShowRow

//Set Row Style @27-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @50-2A29BDB7
// -------------------------
	//$dateStart = $GSmartPreventive->tckt_date->GetValue();
    $GSmartPreventive->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
	
	$GSmartPreventive->prvt_branch->SetValue(GetCodeDescription($GSmartPreventive->prvt_state->GetValue(),$GSmartPreventive->prvt_branch->GetValue()));
	$GSmartPreventive->tcktEng1->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GSmartPreventive->tcktEng1->GetValue(),$DBSMART));
	$GSmartPreventive->tcktEng2->SetValue(CCDLookUp("usr_fullname","smart_user","id=".$GSmartPreventive->tcktEng2->GetValue(),$DBSMART));

// -------------------------
//End Custom Code

//Close GSmartPreventive_BeforeShowRow @5-BC373E85
    return $GSmartPreventive_BeforeShowRow;
}
//End Close GSmartPreventive_BeforeShowRow

//GSmartPreventive_BeforeShow @5-8E4A09C4
function GSmartPreventive_BeforeShow(& $sender)
{
    $GSmartPreventive_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSmartPreventive,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GSmartPreventive_BeforeShow

//Custom Code @49-2A29BDB7
// -------------------------
    if($GSmartPreventive->PageNumber != null){
		$PageFirstRecordNo = ($GSmartPreventive->PageSize * ($GSmartPreventive->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GSmartPreventive->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GSmartPreventive->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GSmartPreventive_BeforeShow @5-82CDABB2
    return $GSmartPreventive_BeforeShow;
}
//End Close GSmartPreventive_BeforeShow


?>
