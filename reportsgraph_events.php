<?php
// //Events @1-F81417CB

//reportsgraph_AfterInitialize @1-97830CAF
function reportsgraph_AfterInitialize(& $sender)
{
    $reportsgraph_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsgraph, $pangraphbranch, $pangraphprob, $pangraphmethod; //Compatibility
//End reportsgraph_AfterInitialize

//Custom Code @58-2A29BDB7
// -------------------------
    switch(CCGetParam("type")) {
		case 'branch':
			$reportsgraph->pangraphbranch->Visible = true;
			$reportsgraph->pangraphprob->Visible = false;
			$reportsgraph->pangraphmethod->Visible = false;
		break;
		case 'probcat':
			$reportsgraph->pangraphbranch->Visible = false;
			$reportsgraph->pangraphprob->Visible = true;
			$reportsgraph->pangraphmethod->Visible = false;
		break;
		case 'resnote':
			$reportsgraph->pangraphbranch->Visible = false;
			$reportsgraph->pangraphprob->Visible = false;
			$reportsgraph->pangraphmethod->Visible = true;
		break;
	}
// -------------------------
//End Custom Code

//Close reportsgraph_AfterInitialize @1-35B5C2B3
    return $reportsgraph_AfterInitialize;
}
//End Close reportsgraph_AfterInitialize

//DEL  function reportsgraph_pangraphbranch_BeforeShow(& $sender)
//DEL  {
//DEL      $reportsgraph_pangraphbranch_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $reportsgraph, $ChartBranch; //Compatibility


//DEL  // -------------------------
//DEL      
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      
//DEL  // -------------------------

//reportsgraph_BeforeInitialize @1-81D6FA2D
function reportsgraph_BeforeInitialize(& $sender)
{
    $reportsgraph_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportsgraph; //Compatibility
//End reportsgraph_BeforeInitialize

//ChartBranch Initialization @3-1BE4B102
    if ('reportsgraphpangraphbranchChartBranch' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "reportsgraphpangraphbranchChartBranch.xml"));
        $Service->SetFormatter($formatter);
//End ChartBranch Initialization

//ChartBranch DataSource @3-12A11544
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlyear"] = CCGetFromGet("year", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlyear", ccsText, "", "", $Service->DataSource->Parameters["urlyear"], 2010, false);
        $Service->DataSource->SQL = "SELECT count(tckt_refnumber) AS ticketsum, tckt_site AS branch \n" .
        "FROM smart_ticket\n" .
        "WHERE YEAR(tckt_r_date) = '" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsText) . "'\n" .
        "GROUP BY tckt_site ";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 100;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End ChartBranch DataSource

//ChartBranch Execution @3-7EE09EB3
        $Service->AddDataSetValue("Title", "Graph of Tickets According To Branch By Year {year}");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End ChartBranch Execution

//ChartBranch Tail @3-27890EF8
        exit;
    }
//End ChartBranch Tail

//ChartProb Initialization @41-45DACC7C
    if ('reportsgraphpangraphprobChartProb' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "reportsgraphpangraphprobChartProb.xml"));
        $Service->SetFormatter($formatter);
//End ChartProb Initialization

//ChartProb DataSource @41-C792D5B6
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlyear"] = CCGetFromGet("year", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlyear", ccsText, "", "", $Service->DataSource->Parameters["urlyear"], "", false);
        $Service->DataSource->SQL = "SELECT COUNT(tckt_refnumber) AS ticketnum, ref_description AS probcat \n" .
        "FROM smart_ticket LEFT JOIN smart_referencecode ON\n" .
        "smart_ticket.tckt_category = smart_referencecode.ref_value\n" .
        "WHERE smart_referencecode.ref_type = 'probcat'\n" .
        "AND YEAR(smart_ticket.tckt_r_date) = '" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsText) . "'\n" .
        "GROUP BY tckt_category ";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 90;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End ChartProb DataSource

//ChartProb Execution @41-4CA59892
        $Service->AddDataSetValue("Title", "Graph of Tickets According To Problem Categories By Year");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End ChartProb Execution

//ChartProb Tail @41-27890EF8
        exit;
    }
//End ChartProb Tail

//ChartMethod Initialization @60-E93C1E59
    if ('reportsgraphpangraphmethodChartMethod' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "reportsgraphpangraphmethodChartMethod.xml"));
        $Service->SetFormatter($formatter);
//End ChartMethod Initialization

//ChartMethod DataSource @60-21036B9D
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlyear"] = CCGetFromGet("year", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlyear", ccsText, "", "", $Service->DataSource->Parameters["urlyear"], "", false);
        $Service->DataSource->SQL = "SELECT COUNT(tckt_refnumber) AS ticketnum, ref_description AS method \n" .
        "FROM smart_ticket LEFT JOIN smart_referencecode ON\n" .
        "smart_ticket.tckt_c_method = smart_referencecode.ref_value\n" .
        "WHERE smart_referencecode.ref_type = 'rsltnmethod'\n" .
        "AND YEAR(smart_ticket.tckt_r_date) = '" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsText) . "'\n" .
        "GROUP BY tckt_c_method {SQL_OrderBy}";
        $Service->DataSource->Order = "smart_referencecode.ref_rank ASC";
        $Service->DataSource->PageSize = 90;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End ChartMethod DataSource

//ChartMethod Execution @60-5FEBA942
        $Service->AddDataSetValue("Title", "Graph of Tickets According to Resolution Method By Year");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End ChartMethod Execution

//ChartMethod Tail @60-27890EF8
        exit;
    }
//End ChartMethod Tail

//Close reportsgraph_BeforeInitialize @1-FF328515
    return $reportsgraph_BeforeInitialize;
}
//End Close reportsgraph_BeforeInitialize


?>
