<?php
//BindEvents Method @1-046DE46B
function BindEvents()
{
    global $GPreq;
    global $RPreq;
    global $GPreqOrders;
    global $RPreqSignAprv;
    global $RPreqView;
    global $PanProcessCheck;
    global $RPreqSignPrcs;
    global $RPreqSignRtn;
    global $RPreqSignView;
    global $GPreqOrdersRtn;
    global $GPartsOrdersView;
    global $CCSEvents;
    $GPreq->CCSEvents["BeforeShowRow"] = "GPreq_BeforeShowRow";
    $GPreq->CCSEvents["BeforeShow"] = "GPreq_BeforeShow";
    $RPreq->Button_Cancel->CCSEvents["OnClick"] = "RPreq_Button_Cancel_OnClick";
    $RPreq->CCSEvents["AfterInsert"] = "RPreq_AfterInsert";
    $GPreqOrders->podr_itemcode->CCSEvents["BeforeShow"] = "GPreqOrders_podr_itemcode_BeforeShow";
    $GPreqOrders->Cancel->CCSEvents["OnClick"] = "GPreqOrders_Cancel_OnClick";
    $GPreqOrders->Button_Submit1->CCSEvents["OnClick"] = "GPreqOrders_Button_Submit1_OnClick";
    $GPreqOrders->ds->CCSEvents["BeforeBuildInsert"] = "GPreqOrders_ds_BeforeBuildInsert";
    $GPreqOrders->CCSEvents["BeforeShow"] = "GPreqOrders_BeforeShow";
    $GPreqOrders->CCSEvents["BeforeShowRow"] = "GPreqOrders_BeforeShowRow";
    $RPreqSignAprv->Button_Cancel->CCSEvents["OnClick"] = "RPreqSignAprv_Button_Cancel_OnClick";
    $RPreqSignAprv->CCSEvents["BeforeShow"] = "RPreqSignAprv_BeforeShow";
    $RPreqSignAprv->CCSEvents["AfterUpdate"] = "RPreqSignAprv_AfterUpdate";
    $RPreqView->Button_Update->CCSEvents["OnClick"] = "RPreqView_Button_Update_OnClick";
    $RPreqView->CCSEvents["BeforeShow"] = "RPreqView_BeforeShow";
    $PanProcessCheck->CCSEvents["BeforeShow"] = "PanProcessCheck_BeforeShow";
    $RPreqSignPrcs->Button_Cancel->CCSEvents["OnClick"] = "RPreqSignPrcs_Button_Cancel_OnClick";
    $RPreqSignPrcs->CCSEvents["BeforeShow"] = "RPreqSignPrcs_BeforeShow";
    $RPreqSignPrcs->CCSEvents["AfterUpdate"] = "RPreqSignPrcs_AfterUpdate";
    $RPreqSignRtn->Button_Cancel->CCSEvents["OnClick"] = "RPreqSignRtn_Button_Cancel_OnClick";
    $RPreqSignView->BtnProcess->CCSEvents["OnClick"] = "RPreqSignView_BtnProcess_OnClick";
    $RPreqSignView->BtnApproval->CCSEvents["OnClick"] = "RPreqSignView_BtnApproval_OnClick";
    $RPreqSignView->Button_Cancel->CCSEvents["OnClick"] = "RPreqSignView_Button_Cancel_OnClick";
    $RPreqSignView->CCSEvents["BeforeShow"] = "RPreqSignView_BeforeShow";
    $GPreqOrdersRtn->podr_itemcode->CCSEvents["BeforeShow"] = "GPreqOrdersRtn_podr_itemcode_BeforeShow";
    $GPreqOrdersRtn->Cancel->CCSEvents["OnClick"] = "GPreqOrdersRtn_Cancel_OnClick";
    $GPreqOrdersRtn->ds->CCSEvents["BeforeBuildInsert"] = "GPreqOrdersRtn_ds_BeforeBuildInsert";
    $GPreqOrdersRtn->CCSEvents["BeforeShow"] = "GPreqOrdersRtn_BeforeShow";
    $GPreqOrdersRtn->CCSEvents["BeforeShowRow"] = "GPreqOrdersRtn_BeforeShowRow";
    $GPartsOrdersView->CCSEvents["BeforeShowRow"] = "GPartsOrdersView_BeforeShowRow";
    $GPartsOrdersView->CCSEvents["BeforeShow"] = "GPartsOrdersView_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GPreq_BeforeShowRow @5-57969EB5
function GPreq_BeforeShowRow(& $sender)
{
    $GPreq_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreq,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreq_BeforeShowRow

//Set Row Style @17-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @245-2A29BDB7
// -------------------------
    $GPreq->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$GPreq->preq_status->SetValue(GetCodeDescription("statpreq",$GPreq->preq_status->GetValue()));
// -------------------------
//End Custom Code

//Close GPreq_BeforeShowRow @5-F8772892
    return $GPreq_BeforeShowRow;
}
//End Close GPreq_BeforeShowRow

//GPreq_BeforeShow @5-8EC4AB3F
function GPreq_BeforeShow(& $sender)
{
    $GPreq_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreq,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreq_BeforeShow

//Custom Code @244-2A29BDB7
// -------------------------
    if($GPreq->PageNumber != null){
		$PageFirstRecordNo = ($GPreq->PageSize * ($GPreq->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GPreq->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GPreq->lblNumber->SetValue($BilRekod);

// -------------------------
//End Custom Code

//Close GPreq_BeforeShow @5-7ED41A14
    return $GPreq_BeforeShow;
}
//End Close GPreq_BeforeShow

//RPreq_Button_Cancel_OnClick @47-E6C7F390
function RPreq_Button_Cancel_OnClick(& $sender)
{
    $RPreq_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreq, $Redirect; //Compatibility
//End RPreq_Button_Cancel_OnClick

//Custom Code @125-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close RPreq_Button_Cancel_OnClick @47-99E413EA
    return $RPreq_Button_Cancel_OnClick;
}
//End Close RPreq_Button_Cancel_OnClick

//RPreq_AfterInsert @44-7E53550B
function RPreq_AfterInsert(& $sender)
{
    $RPreq_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreq, $DBSMART, $Redirect; //Compatibility
//End RPreq_AfterInsert

//Custom Code @109-2A29BDB7
// -------------------------
    $IdPreq = CCDlookUp("max(id)", "smart_partsrequisition", "preq_formno='".$RPreq->preq_formno->GetValue()."'",$DBSMART);
	
	LogActivity(CCGetSession("UserLogin"),"ADD",$IdPreq,"Submit New Requisition Form",date('Y-m-d H:i:s'),"SPARE PARTS");
	$Redirect = "smartpreq.php?view=1&id=".$IdPreq;
// -------------------------
//End Custom Code

//Close RPreq_AfterInsert @44-4EC18C18
    return $RPreq_AfterInsert;
}
//End Close RPreq_AfterInsert

//GPreqOrders_podr_itemcode_BeforeShow @72-EC20FF52
function GPreqOrders_podr_itemcode_BeforeShow(& $sender)
{
    $GPreqOrders_podr_itemcode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders; //Compatibility
//End GPreqOrders_podr_itemcode_BeforeShow

//PTAutocomplete1 BeforeShow @151-93F2FD21
    $Component->Attributes->SetValue('id', 'GPreqOrderspodr_itemcode');
//End PTAutocomplete1 BeforeShow

//Close GPreqOrders_podr_itemcode_BeforeShow @72-450371F1
    return $GPreqOrders_podr_itemcode_BeforeShow;
}
//End Close GPreqOrders_podr_itemcode_BeforeShow

//GPreqOrders_Cancel_OnClick @81-FBB06E5D
function GPreqOrders_Cancel_OnClick(& $sender)
{
    $GPreqOrders_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders, $Redirect; //Compatibility
//End GPreqOrders_Cancel_OnClick

//Custom Code @317-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close GPreqOrders_Cancel_OnClick @81-B4CEB52F
    return $GPreqOrders_Cancel_OnClick;
}
//End Close GPreqOrders_Cancel_OnClick

//GPreqOrders_Button_Submit1_OnClick @147-80F20DF8
function GPreqOrders_Button_Submit1_OnClick(& $sender)
{
    $GPreqOrders_Button_Submit1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders, $Redirect, $DBSMART; //Compatibility
//End GPreqOrders_Button_Submit1_OnClick

//Custom Code @155-2A29BDB7
// -------------------------
    $DBQry = new clsDBSMART();
	$QryUpdateStatus = "UPDATE smart_partsrequisition SET preq_status=2 WHERE id=".CCGetParam("id");
	$DBQry->query($QryUpdateStatus);
	
	LogActivity(CCGetSession("UserLogin"),"UPDATE",CCGetParam("id"),"Submit Requisition Form for Approval",date('Y-m-d H:i:s'),"SPARE PARTS");
	$Redirect = "smartpreq.php?view=1&id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close GPreqOrders_Button_Submit1_OnClick @147-CA8E7FA1
    return $GPreqOrders_Button_Submit1_OnClick;
}
//End Close GPreqOrders_Button_Submit1_OnClick

//GPreqOrders_ds_BeforeBuildInsert @68-4FF077A2
function GPreqOrders_ds_BeforeBuildInsert(& $sender)
{
    $GPreqOrders_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders; //Compatibility
//End GPreqOrders_ds_BeforeBuildInsert

//Custom Code @149-2A29BDB7
// -------------------------
    $GPreqOrders->ds->podr_preqid->SetValue(CCGetParam("id"));
// -------------------------
//End Custom Code

//Close GPreqOrders_ds_BeforeBuildInsert @68-DD58E21B
    return $GPreqOrders_ds_BeforeBuildInsert;
}
//End Close GPreqOrders_ds_BeforeBuildInsert

//GPreqOrders_BeforeShow @68-5CEA1B6F
function GPreqOrders_BeforeShow(& $sender)
{
    $GPreqOrders_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders,$DBSMART,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreqOrders_BeforeShow

//Custom Code @156-2A29BDB7
// -------------------------
	$StatusPreqId = CCDlookUp("preq_status", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);
	$OrderExist = CCDlookUp("Count(*)", "smart_partsorders", "podr_preqid='".CCGetParam("id")."'",$DBSMART);

	if($StatusPreqId<=1 && $OrderExist<1) {
		$GPreqOrders->Button_Submit1->Visible = FALSE;
	} elseif($StatusPreqId>1 && $OrderExist>0) {
		$GPreqOrders->Button_Submit->Visible = FALSE;
		$GPreqOrders->Cancel->Visible = FALSE;
		$GPreqOrders->Button_Submit1->Visible = FALSE;
	}

	if($GPreqOrders->PageNumber != null){
		$PageFirstRecordNo = ($GPreqOrders->PageSize * ($GPreqOrders->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GPreqOrders->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GPreqOrders->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GPreqOrders_BeforeShow @68-F4623382
    return $GPreqOrders_BeforeShow;
}
//End Close GPreqOrders_BeforeShow

//GPreqOrders_BeforeShowRow @68-8FB4C952
function GPreqOrders_BeforeShowRow(& $sender)
{
    $GPreqOrders_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrders,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreqOrders_BeforeShowRow

//Custom Code @247-2A29BDB7
// -------------------------
    $GPreqOrders->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GPreqOrders_BeforeShowRow @68-67AD6508
    return $GPreqOrders_BeforeShowRow;
}
//End Close GPreqOrders_BeforeShowRow


//RPreqSignAprv_Button_Cancel_OnClick @85-545EF86E
function RPreqSignAprv_Button_Cancel_OnClick(& $sender)
{
    $RPreqSignAprv_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignAprv, $Redirect; //Compatibility
//End RPreqSignAprv_Button_Cancel_OnClick

//Custom Code @126-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close RPreqSignAprv_Button_Cancel_OnClick @85-26E1CD8A
    return $RPreqSignAprv_Button_Cancel_OnClick;
}
//End Close RPreqSignAprv_Button_Cancel_OnClick

//RPreqSignAprv_BeforeShow @82-47DF2D24
function RPreqSignAprv_BeforeShow(& $sender)
{
    $RPreqSignAprv_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignAprv; //Compatibility
//End RPreqSignAprv_BeforeShow

//Custom Code @204-2A29BDB7
// -------------------------
	$RPreqSignAprv->status->SetValue("3");
// -------------------------
//End Custom Code

//Close RPreqSignAprv_BeforeShow @82-0484AC15
    return $RPreqSignAprv_BeforeShow;
}
//End Close RPreqSignAprv_BeforeShow

//RPreqSignAprv_AfterUpdate @82-83FD6B34
function RPreqSignAprv_AfterUpdate(& $sender)
{
    $RPreqSignAprv_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignAprv, $Redirect; //Compatibility
//End RPreqSignAprv_AfterUpdate

//Custom Code @207-2A29BDB7
// -------------------------
	$stataprv = GetCodeDescription("stataprv",$RPreqSignAprv->preq_status->GetValue());
    LogActivity(CCGetSession("UserLogin"),"UPDATE",CCGetParam("id"),"Update Status of Approval to -> ".$stataprv." for Requisition Form",date('Y-m-d H:i:s'),"SPARE PARTS");

	$Redirect = "smartpreq.php?view=1&id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close RPreqSignAprv_AfterUpdate @82-DB5D9B07
    return $RPreqSignAprv_AfterUpdate;
}
//End Close RPreqSignAprv_AfterUpdate

//RPreqView_Button_Update_OnClick @253-6FF6DE2C
function RPreqView_Button_Update_OnClick(& $sender)
{
    $RPreqView_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqView, $Redirect; //Compatibility
//End RPreqView_Button_Update_OnClick

//Custom Code @254-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php?rtn=1&id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close RPreqView_Button_Update_OnClick @253-7EB19F05
    return $RPreqView_Button_Update_OnClick;
}
//End Close RPreqView_Button_Update_OnClick

//RPreqView_BeforeShow @110-04DEB0AA
function RPreqView_BeforeShow(& $sender)
{
    $RPreqView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqView; //Compatibility
//End RPreqView_BeforeShow

//Custom Code @205-2A29BDB7
// -------------------------
	if($RPreqView->preq_status->GetValue() == 4) {
		$RPreqView->status->Visible = true;
		$RPreqView->Button_Update->Visible = true;
	} else {
		$RPreqView->status->Visible = false;
		$RPreqView->Button_Update->Visible = false;
	}
	
	if($RPreqView->lblRtn->GetValue() == 6) {
		$RPreqView->lblRtn->SetValue("Yes");
		$RPreqView->linkRtn->Visible = true;
	} else {
		$RPreqView->lblRtn->SetValue("");
		$RPreqView->linkRtn->Visible = false;
	}
    $RPreqView->preq_status->SetValue(GetCodeDescription("statpreq",$RPreqView->preq_status->GetValue()));
	
	if($RPreqView->preq_approval->GetValue()!=null) {
		$RPreqView->preq_approval->SetValue("<b>( ".GetCodeDescription("stataprv",$RPreqView->preq_approval->GetValue())." )");
	}
// -------------------------
//End Custom Code

//Close RPreqView_BeforeShow @110-0AB869AB
    return $RPreqView_BeforeShow;
}
//End Close RPreqView_BeforeShow

//PanProcessCheck_BeforeShow @133-B3225133
function PanProcessCheck_BeforeShow(& $sender)
{
    $PanProcessCheck_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $PanProcessCheck,$DBSMART,$lblRequest,$lblApproval,$lblInProcess,$lblReturned,$lblReleased,$lblCancelled,$lblFinished; //Compatibility
//End PanProcessCheck_BeforeShow

//Custom Code @136-2A29BDB7
// -------------------------
	$StatusPreqId = CCDlookUp("preq_status", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);
	$StatusAprv = CCDlookUp("preq_approval", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);

    if($StatusPreqId<=1 && $StatusAprv==NULL){
		$lblRequest->SetValue("<b><font color=red>REQUEST</font></b>");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==2 && $StatusAprv==NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("<b><font color=red>FOR APPROVAL</font></b>");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==2 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("<b><font color=red>FOR APPROVAL</font></b>");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==3 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("<b><font color=red>IN PROCESS</font></b>");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==4 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("<b><font color=red>RELEASED</font></b>");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==5 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("<b><font color=red>CANCELLED</font></b>");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==6 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("<b><font color=red>TO BE RETURNED</font></b>");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	} elseif($StatusPreqId==7 && $StatusAprv!=NULL){
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("<b><font color=red>FINISH</font></b>");
	} else {
		$lblRequest->SetValue("REQUEST");
		$lblApproval->SetValue("FOR APPROVAL");
		$lblInProcess->SetValue("IN PROCESS");
		$lblReturned->SetValue("TO BE RETURNED");
		$lblReleased->SetValue("RELEASED");
		$lblCancelled->SetValue("CANCELLED");
		$lblFinished->SetValue("FINISH");
	}
// -------------------------
//End Custom Code

//Close PanProcessCheck_BeforeShow @133-02714018
    return $PanProcessCheck_BeforeShow;
}
//End Close PanProcessCheck_BeforeShow

//RPreqSignPrcs_Button_Cancel_OnClick @163-2D4AF99C
function RPreqSignPrcs_Button_Cancel_OnClick(& $sender)
{
    $RPreqSignPrcs_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignPrcs; //Compatibility
//End RPreqSignPrcs_Button_Cancel_OnClick

//Custom Code @164-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close RPreqSignPrcs_Button_Cancel_OnClick @163-F26AF0DF
    return $RPreqSignPrcs_Button_Cancel_OnClick;
}
//End Close RPreqSignPrcs_Button_Cancel_OnClick

//RPreqSignPrcs_BeforeShow @160-48F5F376
function RPreqSignPrcs_BeforeShow(& $sender)
{
    $RPreqSignPrcs_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignPrcs; //Compatibility
//End RPreqSignPrcs_BeforeShow

//Custom Code @237-2A29BDB7
// -------------------------
   $RPreqSignPrcs->preq_approval->SetValue(GetCodeDescription("stataprv",$RPreqSignPrcs->preq_approval->GetValue()));
// -------------------------
//End Custom Code

//Close RPreqSignPrcs_BeforeShow @160-6AE9F182
    return $RPreqSignPrcs_BeforeShow;
}
//End Close RPreqSignPrcs_BeforeShow

//RPreqSignPrcs_AfterUpdate @160-F8B17A79
function RPreqSignPrcs_AfterUpdate(& $sender)
{
    $RPreqSignPrcs_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignPrcs, $Redirect; //Compatibility
//End RPreqSignPrcs_AfterUpdate

//Custom Code @240-2A29BDB7
// -------------------------
	$DBQry = new clsDBSMART();
	$QryUpdateStatus = "UPDATE smart_partsrequisition SET preq_status=".$RPreqSignPrcs->preq_status->GetValue()." WHERE id=".CCGetParam("id");
	$DBQry->query($QryUpdateStatus);

    $Redirect = "smartpreq.php?view=1&id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close RPreqSignPrcs_AfterUpdate @160-B558F0BD
    return $RPreqSignPrcs_AfterUpdate;
}
//End Close RPreqSignPrcs_AfterUpdate

//RPreqSignRtn_Button_Cancel_OnClick @184-2B55F92F
function RPreqSignRtn_Button_Cancel_OnClick(& $sender)
{
    $RPreqSignRtn_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignRtn; //Compatibility
//End RPreqSignRtn_Button_Cancel_OnClick

//Custom Code @185-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close RPreqSignRtn_Button_Cancel_OnClick @184-510CDE44
    return $RPreqSignRtn_Button_Cancel_OnClick;
}
//End Close RPreqSignRtn_Button_Cancel_OnClick

//RPreqSignView_BtnProcess_OnClick @209-73E5F2A6
function RPreqSignView_BtnProcess_OnClick(& $sender)
{
    $RPreqSignView_BtnProcess_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignView, $DBSMART, $Redirect; //Compatibility
//End RPreqSignView_BtnProcess_OnClick

//Custom Code @230-2A29BDB7
// -------------------------
    $StatusPreqId = CCDlookUp("preq_status", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);
	$StatusAprv = CCDlookUp("preq_approval", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);

	if($StatusPreqId==2 && $StatusAprv==NULL) {
		$Redirect = "smartpreq.php?aprv=1&id=".CCGetParam("id");
	} elseif($StatusPreqId==3 && $StatusAprv!=NULL) {
		$Redirect = "smartpreq.php?prcs=1&st=".$StatusPreqId."&id=".CCGetParam("id");
	} else {
		$Redirect = "#";
	}
// -------------------------
//End Custom Code

//Close RPreqSignView_BtnProcess_OnClick @209-99C1FCE6
    return $RPreqSignView_BtnProcess_OnClick;
}
//End Close RPreqSignView_BtnProcess_OnClick

//RPreqSignView_BtnApproval_OnClick @210-9BE229B4
function RPreqSignView_BtnApproval_OnClick(& $sender)
{
    $RPreqSignView_BtnApproval_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignView, $Redirect; //Compatibility
//End RPreqSignView_BtnApproval_OnClick

//Custom Code @231-2A29BDB7
// -------------------------
	$Redirect = "smartpreq.php?aprv=1&id=".CCGetParam("id");
// -------------------------
//End Custom Code

//Close RPreqSignView_BtnApproval_OnClick @210-57987A42
    return $RPreqSignView_BtnApproval_OnClick;
}
//End Close RPreqSignView_BtnApproval_OnClick

//RPreqSignView_Button_Cancel_OnClick @211-7FD669F5
function RPreqSignView_Button_Cancel_OnClick(& $sender)
{
    $RPreqSignView_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignView, $Redirect; //Compatibility
//End RPreqSignView_Button_Cancel_OnClick

//Custom Code @212-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php";
// -------------------------
//End Custom Code

//Close RPreqSignView_Button_Cancel_OnClick @211-1CD739C7
    return $RPreqSignView_Button_Cancel_OnClick;
}
//End Close RPreqSignView_Button_Cancel_OnClick

//RPreqSignView_BeforeShow @208-87B41AE0
function RPreqSignView_BeforeShow(& $sender)
{
    $RPreqSignView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RPreqSignView, $DBSMART; //Compatibility
//End RPreqSignView_BeforeShow

//Custom Code @229-2A29BDB7
// -------------------------
	$StatusPreqId = CCDlookUp("preq_status", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);
	$StatusAprv = CCDlookUp("preq_approval", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);

	if(($StatusPreqId==1 && $StatusAprv==NULL) || ($StatusPreqId==2 && $StatusAprv!=NULL) || ($StatusPreqId==3 && $StatusAprv!=NULL)) {
		if(CCGetSession("GroupID")==7) {
			$RPreqSignView->BtnApproval->Visible = false;
		} else {
			$RPreqSignView->BtnProcess->Visible = false;
			$RPreqSignView->BtnApproval->Visible = false;
		}
	} elseif($StatusPreqId==2 && $StatusAprv==NULL) {
		if(CCGetSession("GroupID")==5 || CCGetSession("GroupID")==7) {
			$RPreqSignView->BtnProcess->Visible = false;
		} else {
			$RPreqSignView->BtnApproval->Visible = false;
			$RPreqSignView->BtnProcess->Visible = false;
		}
	} else {
		$RPreqSignView->BtnProcess->Visible = false;
		$RPreqSignView->BtnApproval->Visible = false;
	}

	$StatPrcs = $RPreqSignView->preq_process->GetValue();

    $RPreqSignView->preq_status->SetValue(GetCodeDescription("stataprv",$RPreqSignView->preq_status->GetValue()));
	if($StatPrcs == 4) {
		$RPreqSignView->preq_process->SetValue("Released");
	} elseif($StatPrcs == 5) {
		$RPreqSignView->preq_process->SetValue("Cancelled");
	}
// -------------------------
//End Custom Code

//Close RPreqSignView_BeforeShow @208-4A770840
    return $RPreqSignView_BeforeShow;
}
//End Close RPreqSignView_BeforeShow


//GPreqOrdersRtn_podr_itemcode_BeforeShow @258-34F0C50E
function GPreqOrdersRtn_podr_itemcode_BeforeShow(& $sender)
{
    $GPreqOrdersRtn_podr_itemcode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrdersRtn; //Compatibility
//End GPreqOrdersRtn_podr_itemcode_BeforeShow

//PTAutocomplete2 BeforeShow @261-19EE8B53
    $Component->Attributes->SetValue('id', 'GPreqOrdersRtnpodr_itemcode');
//End PTAutocomplete2 BeforeShow

//Close GPreqOrdersRtn_podr_itemcode_BeforeShow @258-939D642C
    return $GPreqOrdersRtn_podr_itemcode_BeforeShow;
}
//End Close GPreqOrdersRtn_podr_itemcode_BeforeShow

//GPreqOrdersRtn_Cancel_OnClick @271-33D58630
function GPreqOrdersRtn_Cancel_OnClick(& $sender)
{
    $GPreqOrdersRtn_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrdersRtn, $Redirect; //Compatibility
//End GPreqOrdersRtn_Cancel_OnClick

//Custom Code @316-2A29BDB7
// -------------------------
    $Redirect = "smartpreq.php?id=".CCGetParam("id")."&view=1";
// -------------------------
//End Custom Code

//Close GPreqOrdersRtn_Cancel_OnClick @271-193AC818
    return $GPreqOrdersRtn_Cancel_OnClick;
}
//End Close GPreqOrdersRtn_Cancel_OnClick

//GPreqOrdersRtn_ds_BeforeBuildInsert @256-D008CD99
function GPreqOrdersRtn_ds_BeforeBuildInsert(& $sender)
{
    $GPreqOrdersRtn_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrdersRtn; //Compatibility
//End GPreqOrdersRtn_ds_BeforeBuildInsert

//Custom Code @276-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close GPreqOrdersRtn_ds_BeforeBuildInsert @256-1DC1BEB3
    return $GPreqOrdersRtn_ds_BeforeBuildInsert;
}
//End Close GPreqOrdersRtn_ds_BeforeBuildInsert

//GPreqOrdersRtn_BeforeShow @256-ACDF4F5F
function GPreqOrdersRtn_BeforeShow(& $sender)
{
    $GPreqOrdersRtn_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrdersRtn,$DBSMART,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreqOrdersRtn_BeforeShow

//Custom Code @277-2A29BDB7
// -------------------------
	if($GPreqOrdersRtn->PageNumber != null){
		$PageFirstRecordNo = ($GPreqOrdersRtn->PageSize * ($GPreqOrdersRtn->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GPreqOrdersRtn->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GPreqOrdersRtn->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GPreqOrdersRtn_BeforeShow @256-53A89869
    return $GPreqOrdersRtn_BeforeShow;
}
//End Close GPreqOrdersRtn_BeforeShow

//GPreqOrdersRtn_BeforeShowRow @256-9ABA4B8F
function GPreqOrdersRtn_BeforeShowRow(& $sender)
{
    $GPreqOrdersRtn_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPreqOrdersRtn,$DBSMART,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPreqOrdersRtn_BeforeShowRow

//Custom Code @278-2A29BDB7
// -------------------------
    $GPreqOrdersRtn->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GPreqOrdersRtn_BeforeShowRow @256-F4581462
    return $GPreqOrdersRtn_BeforeShowRow;
}
//End Close GPreqOrdersRtn_BeforeShowRow

//GPartsOrdersView_BeforeShowRow @289-426C63C3
function GPartsOrdersView_BeforeShowRow(& $sender)
{
    $GPartsOrdersView_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPartsOrdersView,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPartsOrdersView_BeforeShowRow

//Custom Code @312-2A29BDB7
// -------------------------
    $GPartsOrdersView->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GPartsOrdersView_BeforeShowRow @289-BB28AA3B
    return $GPartsOrdersView_BeforeShowRow;
}
//End Close GPartsOrdersView_BeforeShowRow

//GPartsOrdersView_BeforeShow @289-25D3F47D
function GPartsOrdersView_BeforeShow(& $sender)
{
    $GPartsOrdersView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GPartsOrdersView,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GPartsOrdersView_BeforeShow

//Custom Code @313-2A29BDB7
// -------------------------
    if($GPartsOrdersView->PageNumber != null){
		$PageFirstRecordNo = ($GPartsOrdersView->PageSize * ($GPartsOrdersView->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GPartsOrdersView->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GPartsOrdersView->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GPartsOrdersView_BeforeShow @289-2AF948C6
    return $GPartsOrdersView_BeforeShow;
}
//End Close GPartsOrdersView_BeforeShow

//Page_AfterInitialize @1-BE2A8607
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartpreq,$DBSMART,$SPreq, $GPreq, $RPreq, $RPreqView, $GPreqOrders, $RPreqSignAprv, $RPreqSignPrcs, $RPreqSignRtn, $RPreqSignView,$PanProcessCheck,$GPreqOrdersRtn, $GPartsOrdersView; //Compatibility
//End Page_AfterInitialize

//Custom Code @124-2A29BDB7
// -------------------------
	$StatusPreqId = CCDlookUp("preq_status", "smart_partsrequisition", "id='".CCGetParam("id")."'",$DBSMART);

    if(CCGetParam("prcs")==null && CCGetParam("view")==1 && CCGetParam("id")!=null && CCGetParam("st")==null && CCGetParam("new")==null && CCGetParam("aprv")==null) {
		if($StatusPreqId<=1) {
	 		$SPreq->Visible = false;
			$GPreq->Visible = false;
			$RPreq->Visible = false;
			$RPreqSignAprv->Visible = false;
			$RPreqSignPrcs->Visible = false;
			$RPreqSignRtn->Visible = false;
			$RPreqSignView->Visible = false;
			$GPreqOrdersRtn->Visible = false;
			$GPartsOrdersView->Visible = false;
		} elseif($StatusPreqId>1 && $StatusPreqId<4) {
			$SPreq->Visible = false;
			$GPreq->Visible = false;
			$RPreq->Visible = false;
			$RPreqSignAprv->Visible = false;
			$RPreqSignPrcs->Visible = false;
			$RPreqSignRtn->Visible = false;
			$GPreqOrdersRtn->Visible = false;
			$GPartsOrdersView->Visible = false;
		} elseif($StatusPreqId>3 && $StatusPreqId<8) {
			$SPreq->Visible = false;
			$GPreq->Visible = false;
			$RPreq->Visible = false;
			$RPreqSignAprv->Visible = false;
			$RPreqSignPrcs->Visible = false;
			$RPreqSignRtn->Visible = false;
			$GPreqOrders->Visible = false;
			$GPreqOrdersRtn->Visible = false;
		}
	} elseif(CCGetParam("rtn")==null && CCGetParam("prcs")==null && CCGetParam("view")==null && CCGetParam("id")==null && CCGetParam("st")==null && CCGetParam("new")==1 && CCGetParam("aprv")==null) {
 		$SPreq->Visible = false;
		$GPreq->Visible = false;
		$RPreqView->Visible = false;
		$RPreqSignAprv->Visible = false;
		$RPreqSignPrcs->Visible = false;
		$RPreqSignRtn->Visible = false;
		$RPreqSignView->Visible = false;
		$GPreqOrders->Visible = false;
		$GPreqOrdersRtn->Visible = false;
		$GPartsOrdersView->Visible = false;
	} elseif(CCGetParam("rtn")==null && CCGetParam("prcs")==null && CCGetParam("aprv")==1 && CCGetParam("id")!=null && CCGetParam("st")==null && CCGetParam("new")==null && CCGetParam("view")==null) {
 		$SPreq->Visible = false;
		$GPreq->Visible = false;
		$RPreq->Visible = false;
		$RPreqSignPrcs->Visible = false;
		$RPreqSignRtn->Visible = false;
		$RPreqSignView->Visible = false;
		$GPreqOrdersRtn->Visible = false;
		$GPartsOrdersView->Visible = false;
	} elseif(CCGetParam("rtn")==null && CCGetParam("prcs")==1 && CCGetParam("aprv")==null && CCGetParam("id")!=null && CCGetParam("st")!=null && CCGetParam("new")==null && CCGetParam("view")==null) {
 		$SPreq->Visible = false;
		$GPreq->Visible = false;
		$RPreq->Visible = false;
		$RPreqSignAprv->Visible = false;
		$RPreqSignRtn->Visible = false;
		$RPreqSignView->Visible = false;
		$GPreqOrdersRtn->Visible = false;
		$GPreqOrders->Visible = false;
	} elseif(CCGetParam("rtn")!=null && CCGetParam("prcs")==null && CCGetParam("aprv")==null && CCGetParam("id")!=null && CCGetParam("st")==null && CCGetParam("new")==null && CCGetParam("view")==null) {
 		$SPreq->Visible = false;
		$GPreq->Visible = false;
		$RPreq->Visible = false;
		$GPreqOrders->Visible = false;
		$GPartsOrdersView->Visible = false;
		$RPreqSignAprv->Visible = false;
		$RPreqSignPrcs->Visible = false;
		$RPreqSignRtn->Visible = false;
		$RPreqSignView->Visible = false;
	} else {
		$RPreq->Visible = false;
		$RPreqView->Visible = false;
		$RPreqSignAprv->Visible = false;
		$RPreqSignPrcs->Visible = false;
		$RPreqSignRtn->Visible = false;
		$RPreqSignView->Visible = false;
		$GPreqOrders->Visible = false;
		$GPartsOrdersView->Visible = false;
		$PanProcessCheck->Visible = false;
		$GPreqOrdersRtn->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-BF9E5EDB
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartpreq; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @153-CC01E524
    if ('GPreqOrderspodr_itemcodePTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @153-C028DF02
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @153-2BFC472B
        $Service->AddDataSourceField('spart_name',ccsText,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @153-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @153-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//PTAutocomplete1 Initialization @151-AF797363
    global $Charset;
    if ('GPreqOrderspodr_itemcodePTAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new ListFormatter());
//End PTAutocomplete1 Initialization

//PTAutocomplete1 DataSource @151-45B4AB5D
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["postpodr_itemcode"] = CCGetFromPost("podr_itemcode", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "postpodr_itemcode", ccsText, "", "", $Service->DataSource->Parameters["postpodr_itemcode"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "spart_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutocomplete1 DataSource

//PTAutocomplete1 Charset @151-4F7C968C
        $Service->AddHttpHeader("Content-type", "text/html; charset=" . $Charset);
//End PTAutocomplete1 Charset

//PTAutocomplete1 DataFields @151-147FD2A3
        $Service->AddDataSourceField('spart_code');
//End PTAutocomplete1 DataFields

//PTAutocomplete1 Execution @151-D749E478
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End PTAutocomplete1 Execution

//PTAutocomplete1 Tail @151-27890EF8
        exit;
    }
//End PTAutocomplete1 Tail

//PTAutoFill2 Initialization @259-647BDA00
    if ('GPreqOrdersRtnpodr_itemcodePTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @259-C028DF02
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @259-2BFC472B
        $Service->AddDataSourceField('spart_name',ccsText,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @259-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @259-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//PTAutocomplete2 Initialization @261-728BFCB1
    global $Charset;
    if ('GPreqOrdersRtnpodr_itemcodePTAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new ListFormatter());
//End PTAutocomplete2 Initialization

//PTAutocomplete2 DataSource @261-45B4AB5D
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["postpodr_itemcode"] = CCGetFromPost("podr_itemcode", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "postpodr_itemcode", ccsText, "", "", $Service->DataSource->Parameters["postpodr_itemcode"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "spart_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutocomplete2 DataSource

//PTAutocomplete2 Charset @261-4F7C968C
        $Service->AddHttpHeader("Content-type", "text/html; charset=" . $Charset);
//End PTAutocomplete2 Charset

//PTAutocomplete2 DataFields @261-147FD2A3
        $Service->AddDataSourceField('spart_code');
//End PTAutocomplete2 DataFields

//PTAutocomplete2 Execution @261-D749E478
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End PTAutocomplete2 Execution

//PTAutocomplete2 Tail @261-27890EF8
        exit;
    }
//End PTAutocomplete2 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize
?>
