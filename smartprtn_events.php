<?php
//BindEvents Method @1-CBE662DE
function BindEvents()
{
    global $GRtn;
    global $GCheckList;
    global $RPreqView;
    global $CCSEvents;
    $GRtn->CCSEvents["BeforeShowRow"] = "GRtn_BeforeShowRow";
    $GRtn->CCSEvents["BeforeShow"] = "GRtn_BeforeShow";
    $GCheckList->podr_itemcode->CCSEvents["BeforeShow"] = "GCheckList_podr_itemcode_BeforeShow";
    $GCheckList->Cancel->CCSEvents["OnClick"] = "GCheckList_Cancel_OnClick";
    $GCheckList->ds->CCSEvents["BeforeBuildInsert"] = "GCheckList_ds_BeforeBuildInsert";
    $GCheckList->CCSEvents["BeforeShow"] = "GCheckList_BeforeShow";
    $GCheckList->CCSEvents["BeforeShowRow"] = "GCheckList_BeforeShowRow";
    $GCheckList->ds->CCSEvents["AfterExecuteUpdate"] = "GCheckList_ds_AfterExecuteUpdate";
    $RPreqView->CCSEvents["BeforeShow"] = "RPreqView_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//GRtn_BeforeShowRow @5-D5371C37
function GRtn_BeforeShowRow(& $sender)
{
    $GRtn_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GRtn,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility
//End GRtn_BeforeShowRow

//Set Row Style @11-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @26-2A29BDB7
// -------------------------
    $GRtn->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;

	$GRtn->preq_status->SetValue(GetCodeDescription("statpreq",$GRtn->preq_status->GetValue()));
// -------------------------
//End Custom Code

//Close GRtn_BeforeShowRow @5-072D0C00
    return $GRtn_BeforeShowRow;
}
//End Close GRtn_BeforeShowRow

//GRtn_BeforeShow @5-AF9416D4
function GRtn_BeforeShow(& $sender)
{
    $GRtn_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GRtn,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GRtn_BeforeShow

//Custom Code @27-2A29BDB7
// -------------------------
    if($GRtn->PageNumber != null){
		$PageFirstRecordNo = ($GRtn->PageSize * ($GRtn->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GRtn->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GRtn->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GRtn_BeforeShow @5-BEF6EA31
    return $GRtn_BeforeShow;
}
//End Close GRtn_BeforeShow

//DEL  function GCheckList_Cancel_OnClick(& $sender)
//DEL  {
//DEL      $GCheckList_Cancel_OnClick = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $GCheckList, $Redirect, $DBSMART; //Compatibility


//DEL  // -------------------------
//DEL  	$Redirect = "smartprtn.php";
//DEL  // -------------------------

//DEL  function GCheckList_BeforeShow(& $sender)
//DEL  {
//DEL      $GCheckList_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $GCheckList,$BilRekod, $PageFirstRecordNo; //Compatibility


//DEL  // -------------------------
//DEL      if($GCheckList->PageNumber != null){
//DEL  		$PageFirstRecordNo = ($GCheckList->PageSize * ($GCheckList->PageNumber - 1)) + 1;
//DEL  	} else {
//DEL  		$PageFirstRecordNo = ($GCheckList->PageSize * 0) + 1;
//DEL  	}
//DEL  	$BilRekod = $PageFirstRecordNo;
//DEL  	$GCheckList->lblNumber->SetValue($BilRekod);
//DEL  // -------------------------

//DEL  function GCheckList_BeforeShowRow(& $sender)
//DEL  {
//DEL      $GCheckList_BeforeShowRow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $GCheckList,$BilRekod, $PageFirstRecordNo, $DBSMART; //Compatibility


//DEL  // -------------------------
//DEL      $GCheckList->lblNumber->SetValue($BilRekod.".");
//DEL  	$BilRekod = $BilRekod + 1;
//DEL  
//DEL  	$Engineer = CCDLookUp("preq_engineer","smart_partsrequisition","id=".CCGetParam("id"),$DBSMART);
//DEL  	$FormNo = CCDLookUp("preq_formno","smart_partsrequisition","id=".CCGetParam("id"),$DBSMART);
//DEL  
//DEL  	$GCheckList->engineer->SetValue($Engineer);
//DEL  	$GCheckList->formno->SetValue($FormNo);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      $GCheckList->Errors->addError("Record sucessfully updated!");
//DEL  // -------------------------

//GCheckList_podr_itemcode_BeforeShow @258-34FF0D0C
function GCheckList_podr_itemcode_BeforeShow(& $sender)
{
    $GCheckList_podr_itemcode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList; //Compatibility
//End GCheckList_podr_itemcode_BeforeShow

//PTAutocomplete1 BeforeShow @79-D4595906
    $Component->Attributes->SetValue('id', 'GCheckListpodr_itemcode');
//End PTAutocomplete1 BeforeShow

//Close GCheckList_podr_itemcode_BeforeShow @258-CC14F73A
    return $GCheckList_podr_itemcode_BeforeShow;
}
//End Close GCheckList_podr_itemcode_BeforeShow

//GCheckList_Cancel_OnClick @271-1F369F0E
function GCheckList_Cancel_OnClick(& $sender)
{
    $GCheckList_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList, $Redirect; //Compatibility
//End GCheckList_Cancel_OnClick

//Custom Code @88-2A29BDB7
// -------------------------
    $Redirect = "smartprtn.php";
// -------------------------
//End Custom Code

//Close GCheckList_Cancel_OnClick @271-E6A3AF0F
    return $GCheckList_Cancel_OnClick;
}
//End Close GCheckList_Cancel_OnClick

//GCheckList_ds_BeforeBuildInsert @256-24908FB5
function GCheckList_ds_BeforeBuildInsert(& $sender)
{
    $GCheckList_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList; //Compatibility
//End GCheckList_ds_BeforeBuildInsert

//Custom Code @276-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close GCheckList_ds_BeforeBuildInsert @256-56D0BD0E
    return $GCheckList_ds_BeforeBuildInsert;
}
//End Close GCheckList_ds_BeforeBuildInsert

//GCheckList_BeforeShow @256-BF3A4C54
function GCheckList_BeforeShow(& $sender)
{
    $GCheckList_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GCheckList_BeforeShow

//Custom Code @277-2A29BDB7
// -------------------------
	if($GCheckList->PageNumber != null){
		$PageFirstRecordNo = ($GCheckList->PageSize * ($GCheckList->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GCheckList->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GCheckList->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GCheckList_BeforeShow @256-23AB5175
    return $GCheckList_BeforeShow;
}
//End Close GCheckList_BeforeShow

//GCheckList_BeforeShowRow @256-457148E0
function GCheckList_BeforeShowRow(& $sender)
{
    $GCheckList_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GCheckList_BeforeShowRow

//Custom Code @278-2A29BDB7
// -------------------------
    $GCheckList->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GCheckList_BeforeShowRow @256-625573BB
    return $GCheckList_BeforeShowRow;
}
//End Close GCheckList_BeforeShowRow

//GCheckList_ds_AfterExecuteUpdate @256-BA4FECF0
function GCheckList_ds_AfterExecuteUpdate(& $sender)
{
    $GCheckList_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GCheckList; //Compatibility
//End GCheckList_ds_AfterExecuteUpdate

//Custom Code @286-2A29BDB7
// -------------------------
    $GCheckList->NoteGrid->SetText("Record has been updated!");
// -------------------------
//End Custom Code

//Close GCheckList_ds_AfterExecuteUpdate @256-F26A5874
    return $GCheckList_ds_AfterExecuteUpdate;
}
//End Close GCheckList_ds_AfterExecuteUpdate

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

//Page_AfterInitialize @1-AE08C656
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartprtn, $SRtn, $GRtn, $GCheckList, $RPreqView; //Compatibility
//End Page_AfterInitialize

//Custom Code @41-2A29BDB7
// -------------------------
     if(CCGetParam("rtn")!=null && CCGetParam("id")!=null) {
		$SRtn->Visible = false;
		$GRtn->Visible = false;
	 } else {
		$GCheckList->Visible = false;
		$RPreqView->Visible = false;
	 }
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-AFBC1E8A
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartprtn; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @77-DFEFC2C1
    if ('GCheckListpodr_itemcodePTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @77-C028DF02
        $Service->DataSource = new clsDBSMART();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM smart_sparepart {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @77-FBA79FDF
        $Service->AddDataSourceField('spart_name',ccs,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @77-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @77-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//PTAutocomplete1 Initialization @79-815011A0
    global $Charset;
    if ('GCheckListpodr_itemcodePTAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new ListFormatter());
//End PTAutocomplete1 Initialization

//PTAutocomplete1 DataSource @79-45B4AB5D
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

//PTAutocomplete1 Charset @79-4F7C968C
        $Service->AddHttpHeader("Content-type", "text/html; charset=" . $Charset);
//End PTAutocomplete1 Charset

//PTAutocomplete1 DataFields @79-147FD2A3
        $Service->AddDataSourceField('spart_code');
//End PTAutocomplete1 DataFields

//PTAutocomplete1 Execution @79-D749E478
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End PTAutocomplete1 Execution

//PTAutocomplete1 Tail @79-27890EF8
        exit;
    }
//End PTAutocomplete1 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//DEL  // -------------------------
//DEL      $year = date("Y");  
//DEL  	for ($i=0; $i<=10; $i++) {  
//DEL  		$SRtn->year->Values[$i] = array($year,$year);  
//DEL  		$year -=1; 
//DEL  	}
//DEL  // -------------------------

?>
