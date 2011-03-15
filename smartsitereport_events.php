<?php
//BindEvents Method @1-063F02C7
function BindEvents()
{
    global $GSiteReport;
    global $SUpdStatus;
    global $Panel2;
    global $RSiteReport;
    global $Panel1;
    global $CCSEvents;
    $GSiteReport->CCSEvents["BeforeShowRow"] = "GSiteReport_BeforeShowRow";
    $GSiteReport->CCSEvents["BeforeShow"] = "GSiteReport_BeforeShow";
    $SUpdStatus->CCSEvents["BeforeShow"] = "SUpdStatus_BeforeShow";
    $SUpdStatus->CCSEvents["AfterUpdate"] = "SUpdStatus_AfterUpdate";
    $SUpdStatus->CCSEvents["AfterInsert"] = "SUpdStatus_AfterInsert";
    $Panel2->CCSEvents["BeforeShow"] = "Panel2_BeforeShow";
    $RSiteReport->Button_Cancel->CCSEvents["OnClick"] = "RSiteReport_Button_Cancel_OnClick";
    $RSiteReport->CCSEvents["AfterInsert"] = "RSiteReport_AfterInsert";
    $RSiteReport->CCSEvents["BeforeShow"] = "RSiteReport_BeforeShow";
    $RSiteReport->CCSEvents["AfterUpdate"] = "RSiteReport_AfterUpdate";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//GSiteReport_BeforeShowRow @5-8C4E3648
function GSiteReport_BeforeShowRow(& $sender)
{
    $GSiteReport_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteReport; //Compatibility
//End GSiteReport_BeforeShowRow

//Set Row Style @19-982C9472
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
    $GSiteReport->sr_status->SetValue(GetCodeDescription("statsrpt",$GSiteReport->sr_status->GetValue()));
	$GSiteReport->sr_type->SetValue(GetCodeDescription("srtype",$GSiteReport->sr_type->GetValue()));
	$GSiteReport->sr_takenby->SetValue(GetCodeFromSingleTable("smart_user",$GSiteReport->sr_takenby->GetValue(),"usr_username"));
// -------------------------
//End Custom Code

//Close GSiteReport_BeforeShowRow @5-A1F99FC9
    return $GSiteReport_BeforeShowRow;
}
//End Close GSiteReport_BeforeShowRow

//GSiteReport_BeforeShow @5-535D0112
function GSiteReport_BeforeShow(& $sender)
{
    $GSiteReport_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GSiteReport; //Compatibility
//End GSiteReport_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close GSiteReport_BeforeShow @5-CF9D49A7
    return $GSiteReport_BeforeShow;
}
//End Close GSiteReport_BeforeShow

//SUpdStatus_BeforeShow @66-B88ECB5A
function SUpdStatus_BeforeShow(& $sender)
{
    $SUpdStatus_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SUpdStatus; //Compatibility
//End SUpdStatus_BeforeShow

//Custom Code @100-2A29BDB7
// -------------------------
    $SUpdStatus->logsrpt_staff->SetValue(CCGetSession("UserLogin"));
	$SUpdStatus->logsrpt_id->SetValue(CCGetFromGet("id"));
	$SUpdStatus->logsrpt_action->SetValue("UPDATE");
// -------------------------
//End Custom Code

//Close SUpdStatus_BeforeShow @66-8BAF60C4
    return $SUpdStatus_BeforeShow;
}
//End Close SUpdStatus_BeforeShow

//SUpdStatus_AfterUpdate @66-F35541D4
function SUpdStatus_AfterUpdate(& $sender)
{
    $SUpdStatus_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SUpdStatus, $DBSMART; //Compatibility
//End SUpdStatus_AfterUpdate

//Custom Code @101-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close SUpdStatus_AfterUpdate @66-2A065289
    return $SUpdStatus_AfterUpdate;
}
//End Close SUpdStatus_AfterUpdate

//SUpdStatus_AfterInsert @66-BD8A5E0F
function SUpdStatus_AfterInsert(& $sender)
{
    $SUpdStatus_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SUpdStatus, $DBSMART; //Compatibility
//End SUpdStatus_AfterInsert

//Custom Code @103-2A29BDB7
// -------------------------
    $dbupd = new clsDBSMART();

	$SrptId  = CCDlookUp("max(id)", "smart_logstatussrpt", "logsrpt_id='".$SUpdStatus->logsrpt_id->GetValue()."'", $DBSMART);
	$sqlupd = "UPDATE smart_sitereport SET sr_status = '".$SUpdStatus->Status->GetValue()."' WHERE id=".mysql_real_escape_string($SUpdStatus->logsrpt_id->GetValue());
	$dbupd->query($sqlupd);
    LogActivity(CCGetSession("UserLogin"),"UPDATE",$SUpdStatus->logsrpt_id->GetValue(),"Successfully Update Site Report Status for ID: ".$SUpdStatus->logsrpt_id->GetValue(),date('Y-m-d H:i:s'),"SITE REPORT");
// -------------------------
//End Custom Code

//Close SUpdStatus_AfterInsert @66-E52F9306
    return $SUpdStatus_AfterInsert;
}
//End Close SUpdStatus_AfterInsert

//Panel2_BeforeShow @72-96696C3D
function Panel2_BeforeShow(& $sender)
{
    $Panel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel2; //Compatibility
//End Panel2_BeforeShow

//Panel2UpdatePanel Page BeforeShow @73-CC9B4012
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel2") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel2\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Panel2_BeforeShow @72-AE7F9FB3
    return $Panel2_BeforeShow;
}
//End Close Panel2_BeforeShow

//RSiteReport_Button_Cancel_OnClick @40-5CB11376
function RSiteReport_Button_Cancel_OnClick(& $sender)
{
    $RSiteReport_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSiteReport, $Redirect; //Compatibility
//End RSiteReport_Button_Cancel_OnClick

//Custom Code @58-2A29BDB7
// -------------------------
    $Redirect = "smartsitereport.php";
// -------------------------
//End Custom Code

//Close RSiteReport_Button_Cancel_OnClick @40-DF9C6397
    return $RSiteReport_Button_Cancel_OnClick;
}
//End Close RSiteReport_Button_Cancel_OnClick

//RSiteReport_AfterInsert @37-1AC77004
function RSiteReport_AfterInsert(& $sender)
{
    $RSiteReport_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSiteReport,$DBSMART; //Compatibility
//End RSiteReport_AfterInsert

//Custom Code @59-2A29BDB7
// -------------------------
	$RSiteReport->Errors->addError("Site Report Details has succesfully inserted!");
    $SrptId  = CCDlookUp("max(id)", "smart_sitereport", "sr_sitecode='".$RSiteReport->sr_sitecode->GetValue()."'", $DBSMART);
	LogActivity(CCGetSession("UserLogin"),"INSERT",$SrptId,"Successfully INSERT Site Report for ID: ".$SrptId,date('Y-m-d H:i:s'),"SITE REPORT");
// -------------------------
//End Custom Code

//Close RSiteReport_AfterInsert @37-37F16C56
    return $RSiteReport_AfterInsert;
}
//End Close RSiteReport_AfterInsert

//RSiteReport_BeforeShow @37-FA3257EA
function RSiteReport_BeforeShow(& $sender)
{
    $RSiteReport_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSiteReport; //Compatibility
//End RSiteReport_BeforeShow

//Custom Code @92-2A29BDB7
// -------------------------
	if(CCGetParam("id")==null){
		$RSiteReport->EditStatus->Visible = false;
		$RSiteReport->sr_status->Visible = false;
		$RSiteReport->sr_takenby->SetValue(CCGetSession("UserID"));
		$RSiteReport->sr_takenbyv->SetValue(GetCodeFromSingleTable("smart_user",CCGetSession("UserID"),"usr_username"));
	} else {
    	$RSiteReport->sr_takenbyv->SetValue(GetCodeFromSingleTable("smart_user",$RSiteReport->sr_takenby->GetValue(),"usr_username"));
	}
// -------------------------
//End Custom Code

//Close RSiteReport_BeforeShow @37-58D5CDE2
    return $RSiteReport_BeforeShow;
}
//End Close RSiteReport_BeforeShow

//RSiteReport_AfterUpdate @37-9ECDEF60
function RSiteReport_AfterUpdate(& $sender)
{
    $RSiteReport_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RSiteReport; //Compatibility
//End RSiteReport_AfterUpdate

//Custom Code @104-2A29BDB7
// -------------------------
	$RSiteReport->Errors->addError("Site Report Details has succesfully updated!");
    LogActivity(CCGetSession("UserLogin"),"UPDATE",CCGetParam("id"),"Successfully Update Site Report for ID: ".CCGetParam("id"),date('Y-m-d H:i:s'),"SITE REPORT");
// -------------------------
//End Custom Code

//Close RSiteReport_AfterUpdate @37-F8D8ADD9
    return $RSiteReport_AfterUpdate;
}
//End Close RSiteReport_AfterUpdate

//Panel1_BeforeShow @114-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @114-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_AfterInitialize @1-B3A61532
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsitereport, $SSiteReport, $RSiteReport, $GSiteReport; //Compatibility
//End Page_AfterInitialize

//Custom Code @61-2A29BDB7
// -------------------------
    if((CCGetParam("view")==null && CCGetParam("id")!=null) || CCGetParam("new")==1) {
		$SSiteReport->Visible = false;
		$GSiteReport->Visible = false;
	} else {
		$RSiteReport->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-FC0D4E04
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsitereport; //Compatibility
//End Page_BeforeInitialize

//Panel2UpdatePanel PageBeforeInitialize @73-5E181320
    if (CCGetFromGet("FormFilter") == "Panel2" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel2UpdatePanel PageBeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @115-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-C8B30330
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsitereport; //Compatibility
//End Page_BeforeShow

//Panel2UpdatePanel Page BeforeShow @73-4589DE7C
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel2") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel2UpdatePanel Page BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-D5ED190C
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsitereport; //Compatibility
//End Page_BeforeOutput

//Panel2UpdatePanel PageBeforeOutput @73-AE056578
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel2") {
        $main_block = $Tpl->getvar("/Panel Panel2");
    }
//End Panel2UpdatePanel PageBeforeOutput

//Panel1UpdatePanel PageBeforeOutput @115-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-74C86FBC
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartsitereport; //Compatibility
//End Page_BeforeUnload

//Panel2UpdatePanel PageBeforeUnload @73-A0E8F191
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel2") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel2UpdatePanel PageBeforeUnload

//Panel1UpdatePanel PageBeforeUnload @115-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
