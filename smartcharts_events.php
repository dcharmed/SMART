<?php

//BindEvents Method @1-A98457F0
function BindEvents()
{
    global $FlashChartStatus;
    global $FCharts;
    global $CCSEvents;
    $FlashChartStatus->CCSEvents["BeforeShow"] = "FlashChartStatus_BeforeShow";
    $FCharts->Button_DoSearch->CCSEvents["OnClick"] = "FCharts_Button_DoSearch_OnClick";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//FlashChartStatus_BeforeShow @5-7A6722EF
function FlashChartStatus_BeforeShow(& $sender)
{
    $FlashChartStatus_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $FlashChartStatus; //Compatibility
//End FlashChartStatus_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close FlashChartStatus_BeforeShow @5-E14795F5
    return $FlashChartStatus_BeforeShow;
}
//End Close FlashChartStatus_BeforeShow

//FCharts_Button_DoSearch_OnClick @23-1307496E
function FCharts_Button_DoSearch_OnClick(& $sender)
{
    $FCharts_Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $FCharts, $Redirect; //Compatibility
//End FCharts_Button_DoSearch_OnClick

//Custom Code @31-2A29BDB7
// -------------------------
    if($FCharts->state->GetValue()!=null && $FCharts->ftype->GetValue()!=null) {
		$Redirect = "smartcharts.php?ftype=".$FCharts->ftype->GetValue()."&state=".$FCharts->state->GetValue();
	} elseif($FCharts->state->GetValue()==null && $FCharts->ftype->GetValue()!=null) {
		$Redirect = "smartcharts.php?ftype=".$FCharts->ftype->GetValue();
	} else {
		$Redirect = "smartcharts.php";
	}
// -------------------------
//End Custom Code

//Close FCharts_Button_DoSearch_OnClick @23-2895560D
    return $FCharts_Button_DoSearch_OnClick;
}
//End Close FCharts_Button_DoSearch_OnClick

//Page_AfterInitialize @1-FEDEF0F5
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartcharts, $FlashChartStatus; //Compatibility
//End Page_AfterInitialize

//Custom Code @28-2A29BDB7
// -------------------------
    $FlashChartStatus->Visible = false;
	switch(CCGetParam("ftype")) {
		case 'tcktstatus':
			$FlashChartStatus->Visible = true;
		break;
		case 'tcktseverity':
			$FlashChartSeverity->Visible = true;
		break;
		case 'probcat':
			$FlashChartCategory->Visible = true;
		break;
		case 'state':
			if(CCGetParam("state")!=null) {
				$FlashChartState->Visible = true;
			}
		break;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-5B5B21B4
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartcharts; //Compatibility
//End Page_BeforeInitialize

//FlashChartStatus Initialization @5-3FD4A315
    if ('smartchartsFlashChartStatus' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "smartchartsFlashChartStatus.xml"));
        $Service->SetFormatter($formatter);
//End FlashChartStatus Initialization

//FlashChartStatus DataSource @5-E0073A6B
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT Count(tckt_refnumber) AS numTicket, tckt_status, ref_description AS status \n" .
"FROM smart_ticket INNER JOIN smart_referencecode ON\n" .
"smart_ticket.tckt_status = smart_referencecode.ref_value {SQL_Where}\n" .
"GROUP BY smart_ticket.tckt_status {SQL_OrderBy}";
        $Service->DataSource->Parameters["expr19"] = tcktstatus;
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "expr19", ccsText, "", "", $Service->DataSource->Parameters["expr19"], "", false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opEqual, "smart_referencecode.ref_type", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End FlashChartStatus DataSource

//FlashChartStatus Execution @5-F5653B3E
        $Service->AddDataSetValue("Title", "Tickets Reports By Status");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End FlashChartStatus Execution

//FlashChartStatus Tail @5-27890EF8
        exit;
    }
//End FlashChartStatus Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
