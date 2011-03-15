<?php
// //Events @1-F81417CB

//reportsla_SlaSummary_BeforeShowRow @10-66D0CB74
function reportsla_SlaSummary_BeforeShowRow(& $sender)
{
    $reportsla_SlaSummary_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsla; //Compatibility
//End reportsla_SlaSummary_BeforeShowRow

//Custom Code @28-2A29BDB7
// -------------------------
	$dbslasite = new clsDBSMART();
	
	$sqltotallessla = "SELECT SUM(IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AS TotalCentral,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AS TotalPin,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0)) AS TotalApkh,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0)) AS TotalQlim,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0)) AS TotalOthers
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year");
	
	$dbslasite->query($sqltotallessla);
	$ResultTotalsla = $dbslasite->next_record();
    if ($ResultTotalsla) {
		$TotalCentral = $dbslasite->f("TotalCentral");
		$TotalPin = $dbslasite->f("TotalPin");
		$TotalApkh = $dbslasite->f("TotalApkh");
		$TotalQlim = $dbslasite->f("TotalQlim");
		$TotalOthers = $dbslasite->f("TotalOthers");
		
	}
	
	//QUERY TO CALCULATE THE SLA

	$year = CCGetParam("year");
	$month = CCGetParam("month");
    $dbslaless = new clsDBSMART();
	$dbslaover = new clsDBSMART();
	$dbsolutionless = new clsDBSMART();
	$dbsolutionover = new clsDBSMART();
	$dbclosedless = new clsDBSMART();
	$dbclosedover = new clsDBSMART();

	//CODE TO COUNT TOTAL OF RESPOND
	$sqllessla = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessOthersSla
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year")." AND smart_logstatus.log_status=5 AND smart_ticket.tckt_refnumber=smart_logstatus.log_refno";
	
	$dbslaless->query($sqllessla);
	$Resultlesssla = $dbslaless->next_record();
    if ($Resultlesssla) {
		$lessCentralSla = $dbslaless->f("lessCentralSla");
		$lessXpinSla = $dbslaless->f("lessXpinSla");
		$lessApkhSla = $dbslaless->f("lessApkhSla");
		$lessQlimSla = $dbslaless->f("lessQlimSla");
		$lessOthersSla = $dbslaless->f("lessOthersSla");
		
	}

	$sqloversla = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overOthersSla
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year")." AND smart_logstatus.log_status=5 AND smart_ticket.tckt_refnumber=smart_logstatus.log_refno";
	
	$dbslaover->query($sqloversla);
	$Resultoversla = $dbslaover->next_record();
    if ($Resultoversla) {
		$overCentralSla = $dbslaover->f("overCentralSla");
		$overXpinSla = $dbslaover->f("overXpinSla");
		$overApkhSla = $dbslaover->f("overApkhSla");
		$overQlimSla = $dbslaover->f("overQlimSla");
		$overOthersSla = $dbslaover->f("overOthersSla");
		
	}
	
	//TO COUNT TOTAL OF SOLUTION
	$sqllesssolution = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessOthersSla
			FROM smart_ticket, smart_logstatus
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year")." AND smart_logstatus.log_status=6 AND smart_ticket.tckt_refnumber=smart_logstatus.log_refno";
	
	$dbsolutionless->query($sqllesssolution);
	$Resultlesssolution = $dbsolutionless->next_record();
    if ($Resultlesssolution) {
		$lessCentralSolution = $dbsolutionless->f("lessCentralSla");
		$lessXpinSolution = $dbsolutionless->f("lessXpinSla");
		$lessApkhSolution = $dbsolutionless->f("lessApkhSla");
		$lessQlimSolution = $dbsolutionless->f("lessQlimSla");
		$lessOthersSolution = $dbsolutionless->f("lessOthersSla");
		
	}

	$sqloversolution = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_logstatus.log_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overOthersSla
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year")." AND smart_logstatus.log_status=6 AND smart_ticket.tckt_refnumber=smart_logstatus.log_refno";
	
	$dbsolutionover->query($sqloversolution);
	$Resultoversolution = $dbsolutionover->next_record();
    if ($Resultoversla) {
		$overCentralSolution = $dbsolutionover->f("overCentralSla");
		$overXpinSolution = $dbsolutionover->f("overXpinSla");
		$overApkhSolution = $dbsolutionover->f("overApkhSla");
		$overQlimSolution = $dbsolutionover->f("overQlimSla");
		$overOthersSolution = $dbsolutionover->f("overOthersSla");
		
	}

	//TO COUNT TOTAL OF CLOSURE
	$sqllessclosed = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) <=1,1,0)) AS lessOthersSla
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year");
	
	$dbclosedless->query($sqllessclosed);
	$Resultlessclosed = $dbclosedless->next_record();
    if ($Resultlessclosed) {
		$lessCentralClosed = $dbclosedless->f("lessCentralSla");
		$lessXpinClosed = $dbclosedless->f("lessXpinSla");
		$lessApkhClosed = $dbclosedless->f("lessApkhSla");
		$lessQlimClosed = $dbclosedless->f("lessQlimSla");
		$lessOthersClosed = $dbclosedless->f("lessOthersSla");
		
	}

	$sqloverclosed = "SELECT SUM((IF(substr(smart_ticket.tckt_site,1,1)='W',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='N',1,0) OR IF(substr(smart_ticket.tckt_site,1,1)='B',1,0)) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overCentralSla,
			SUM((IF(substr(smart_ticket.tckt_site,1,1)='C',1,0) OR IF(smart_ticket.tckt_site='DPIN',1,0) OR IF(smart_ticket.tckt_site='TPIN',1,0)) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overXpinSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='APKH',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overApkhSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,4)='QLIM',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overQlimSla,
			SUM(IF(substr(smart_ticket.tckt_site,1,1)!='W',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='N',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='C',1,0) AND IF(substr(smart_ticket.tckt_site,1,1)!='B',1,0) AND IF(smart_ticket.tckt_site!='DPIN',1,0) AND IF(smart_ticket.tckt_site!='TPIN',1,0) AND IF(smart_ticket.tckt_site!='APKH',1,0) AND IF(smart_ticket.tckt_site!='QLIM',1,0) AND IF(To_days(smart_ticket.tckt_c_date) - To_days(smart_ticket.tckt_r_date) > 1,1,0)) AS overOthersSla
			FROM smart_ticket 
			WHERE YEAR(smart_ticket.tckt_r_date) = ".CCGetParam("year");
	
	$dbclosedover->query($sqloverclosed);
	$Resultoverclosed = $dbclosedover->next_record();
    if ($Resultoverclosed) {
		$overCentralClosed = $dbclosedover->f("overCentralSla");
		$overXpinClosed = $dbclosedover->f("overXpinSla");
		$overApkhClosed = $dbclosedover->f("overApkhSla");
		$overQlimClosed = $dbclosedover->f("overQlimSla");
		$overOthersClosed = $dbclosedover->f("overOthersSla");
		
	}

	switch($reportsla->SlaSummary->site->GetValue()) {
		case 'central':
			$reportsla->SlaSummary->totalticket->SetValue($TotalCentral);
			$reportsla->SlaSummary->lesssla->SetValue($lessCentralSla);
			$reportsla->SlaSummary->oversla->SetValue($overCentralSla);
			$reportsla->SlaSummary->lessrsvl->SetValue($lessCentralSolution);
			$reportsla->SlaSummary->overrsvl->SetValue($overCentralSolution);
			$reportsla->SlaSummary->lesscls->SetValue($lessCentralClosed);
			$reportsla->SlaSummary->overcls->SetValue($overCentralClosed);
		break;
		case 'pin':
			$reportsla->SlaSummary->totalticket->SetValue($TotalPin);
			$reportsla->SlaSummary->lesssla->SetValue($lessXpinSla);
			$reportsla->SlaSummary->oversla->SetValue($overXpinSla);
			$reportsla->SlaSummary->lessrsvl->SetValue($lessXpinSolution);
			$reportsla->SlaSummary->overrsvl->SetValue($overXpinSolution);
			$reportsla->SlaSummary->lesscls->SetValue($lessXpinClosed);
			$reportsla->SlaSummary->overcls->SetValue($overXpinClosed);
		break;
		case 'apkh':
			$reportsla->SlaSummary->totalticket->SetValue($TotalApkh);
			$reportsla->SlaSummary->lesssla->SetValue($lessApkhSla);
			$reportsla->SlaSummary->oversla->SetValue($overApkhSla);
			$reportsla->SlaSummary->lessrsvl->SetValue($lessApkhSolution);
			$reportsla->SlaSummary->overrsvl->SetValue($overApkhSolution);
			$reportsla->SlaSummary->lesscls->SetValue($lessApkhClosed);
			$reportsla->SlaSummary->overcls->SetValue($overApkhClosed);
		break;
		case 'qlim':
			$reportsla->SlaSummary->totalticket->SetValue($TotalQlim);
			$reportsla->SlaSummary->lesssla->SetValue($lessQlimSla);
			$reportsla->SlaSummary->oversla->SetValue($overQlimSla);
			$reportsla->SlaSummary->lessrsvl->SetValue($lessQlimSolution);
			$reportsla->SlaSummary->overrsvl->SetValue($overQlimSolution);
			$reportsla->SlaSummary->lesscls->SetValue($lessQlimClosed);
			$reportsla->SlaSummary->overcls->SetValue($overQlimClosed);
		break;
		case 'others':
			$reportsla->SlaSummary->totalticket->SetValue($TotalOthers);
			$reportsla->SlaSummary->lesssla->SetValue($lessOthersSla);
			$reportsla->SlaSummary->oversla->SetValue($overOthersSla);
			$reportsla->SlaSummary->lessrsvl->SetValue($lessOthersSolution);
			$reportsla->SlaSummary->overrsvl->SetValue($overOthersSolution);
			$reportsla->SlaSummary->lesscls->SetValue($lessOthersClosed);
			$reportsla->SlaSummary->overcls->SetValue($overOthersClosed);
		break;
	}

	$totalles = $reportsla->SlaSummary->lesssla->GetValue() + $reportsla->SlaSummary->totlesssla->GetValue();
	$reportsla->SlaSummary->totlesssla->SetValue($totalles);
	$totalover = $reportsla->SlaSummary->oversla->GetValue() + $reportsla->SlaSummary->totoversla->GetValue();
	$reportsla->SlaSummary->totoversla->SetValue($totalover);

	$totallesrsvl = $reportsla->SlaSummary->lessrsvl->GetValue() + $reportsla->SlaSummary->totlessrsvl->GetValue();
	$reportsla->SlaSummary->totlessrsvl->SetValue($totallesrsvl);
	$totaloversvl = $reportsla->SlaSummary->overrsvl->GetValue() + $reportsla->SlaSummary->totoverrsvl->GetValue();
	$reportsla->SlaSummary->totoverrsvl->SetValue($totaloversvl);

	$totallescls = $reportsla->SlaSummary->lesscls->GetValue() + $reportsla->SlaSummary->totlesscls->GetValue();
	$reportsla->SlaSummary->totlesscls->SetValue($totallescls);
	$totalovercls = $reportsla->SlaSummary->overcls->GetValue() + $reportsla->SlaSummary->totovercls->GetValue();
	$reportsla->SlaSummary->totovercls->SetValue($totalovercls);

	$gtotalticket = $reportsla->SlaSummary->totalticket->GetValue() + $reportsla->SlaSummary->GTicketTotal->GetValue();
	$reportsla->SlaSummary->GTicketTotal->SetValue($gtotalticket);

	$reportsla->SlaSummary->site->SetValue(strtoupper($reportsla->SlaSummary->site->GetValue()));
	//echo "</pre>";
// -------------------------
//End Custom Code

//Close reportsla_SlaSummary_BeforeShowRow @10-7109B87B
    return $reportsla_SlaSummary_BeforeShowRow;
}
//End Close reportsla_SlaSummary_BeforeShowRow

//reportsla_AfterInitialize @1-E149BDC1
function reportsla_AfterInitialize(& $sender)
{
    $reportsla_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsla, $SlaSummary; //Compatibility
//End reportsla_AfterInitialize

//Custom Code @26-2A29BDB7
// -------------------------
	$reportsla->SlaSummary->Visible = false;
	$reportsla->RespondTimeSla->Visible = false;
    switch(CCGetParam("type")) {
		case 'sla':
			$reportsla->SlaSummary->Visible = true;
			break;
	}
// -------------------------
//End Custom Code

//Close reportsla_AfterInitialize @1-C4839E28
    return $reportsla_AfterInitialize;
}
//End Close reportsla_AfterInitialize


?>
