<?php

//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-C8C4A124
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportgraph; //Compatibility
//End Page_BeforeShow

//Custom Code @44-2A29BDB7
// -------------------------
    $repo
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeInitialize @1-E3DE90AA
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $reportgraph; //Compatibility
//End Page_BeforeInitialize

//FlashChart1 Initialization @5-7C0C3199
    if ('reportgraphFlashChart1' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "reportgraphFlashChart1.xml"));
        $Service->SetFormatter($formatter);
//End FlashChart1 Initialization

//FlashChart1 DataSource @5-9488D131
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT count(tckt_refnumber) AS ticketnumber, MONTH(tckt_r_date) AS month \n" .
"FROM smart_ticket {SQL_Where}\n" .
"GROUP BY MONTH(tckt_r_date) {SQL_OrderBy}";
        $Service->DataSource->PageSize = 50;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End FlashChart1 DataSource

//FlashChart1 Execution @5-BAB4463E
        $Service->AddDataSetValue("Title", "Graph of Tickets By Year");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End FlashChart1 Execution

//FlashChart1 Tail @5-27890EF8
        exit;
    }
//End FlashChart1 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
