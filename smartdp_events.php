<?php
//BindEvents Method @1-998347E3
function BindEvents()
{
    global $RCriteria;
    global $VCriteria;
    global $GDamPassport;
    global $CCSEvents;
    $RCriteria->year->CCSEvents["BeforeShow"] = "RCriteria_year_BeforeShow";
    $RCriteria->BtnGenerate->CCSEvents["OnClick"] = "RCriteria_BtnGenerate_OnClick";
    $VCriteria->CCSEvents["BeforeShow"] = "VCriteria_BeforeShow";
    $GDamPassport->dp_subcategory->CCSEvents["BeforeShow"] = "GDamPassport_dp_subcategory_BeforeShow";
    $GDamPassport->Button_Cancel->CCSEvents["OnClick"] = "GDamPassport_Button_Cancel_OnClick";
    $GDamPassport->ds->CCSEvents["BeforeBuildInsert"] = "GDamPassport_ds_BeforeBuildInsert";
    $GDamPassport->CCSEvents["BeforeShow"] = "GDamPassport_BeforeShow";
    $GDamPassport->CCSEvents["BeforeShowRow"] = "GDamPassport_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//RCriteria_year_BeforeShow @12-EB0B6ECD
function RCriteria_year_BeforeShow(& $sender)
{
    $RCriteria_year_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RCriteria; //Compatibility
//End RCriteria_year_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
    $year = date("Y");  
	for ($i=0; $i<=10; $i++) {  
		$RCriteria->year->Values[$i] = array($year,$year);  
		$year -=1; 
	}
// -------------------------
//End Custom Code

//Close RCriteria_year_BeforeShow @12-9107F383
    return $RCriteria_year_BeforeShow;
}
//End Close RCriteria_year_BeforeShow

//RCriteria_BtnGenerate_OnClick @6-4910D3E7
function RCriteria_BtnGenerate_OnClick(& $sender)
{
    $RCriteria_BtnGenerate_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RCriteria, $Redirect; //Compatibility
//End RCriteria_BtnGenerate_OnClick

//Custom Code @11-2A29BDB7
// -------------------------
	CCSetSession("prod",$RCriteria->prod->GetValue());
	CCSetSession("month",$RCriteria->mth->GetValue());
	CCSetSession("year",$RCriteria->year->GetValue());
	CCSetSession("site",$RCriteria->site->GetValue());

    $Redirect = "smartdp.php?gen=1";

// -------------------------
//End Custom Code

//Close RCriteria_BtnGenerate_OnClick @6-3452DE79
    return $RCriteria_BtnGenerate_OnClick;
}
//End Close RCriteria_BtnGenerate_OnClick

//VCriteria_BeforeShow @13-C399C5A9
function VCriteria_BeforeShow(& $sender)
{
    $VCriteria_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $VCriteria; //Compatibility
//End VCriteria_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
    $VCriteria->v_prod->SetValue(CCGetSession("prod"));
	$VCriteria->v_site->SetValue(CCGetSession("site"));
	$VCriteria->v_date->SetValue(CCGetSession("month") ."/".CCGetSession("year"));
	$VCriteria->lblUser->SetValue(CCGetSession("UserLogin"));
// -------------------------
//End Custom Code

//Close VCriteria_BeforeShow @13-6FC1203A
    return $VCriteria_BeforeShow;
}
//End Close VCriteria_BeforeShow

//GDamPassport_dp_subcategory_BeforeShow @27-C8312FDF
function GDamPassport_dp_subcategory_BeforeShow(& $sender)
{
    $GDamPassport_dp_subcategory_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GDamPassport; //Compatibility
//End GDamPassport_dp_subcategory_BeforeShow

//Close GDamPassport_dp_subcategory_BeforeShow @27-0E36C74D
    return $GDamPassport_dp_subcategory_BeforeShow;
}
//End Close GDamPassport_dp_subcategory_BeforeShow

//GDamPassport_Button_Cancel_OnClick @74-7A210ADB
function GDamPassport_Button_Cancel_OnClick(& $sender)
{
    $GDamPassport_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GDamPassport, $Redirect; //Compatibility
//End GDamPassport_Button_Cancel_OnClick

//Custom Code @75-2A29BDB7
// -------------------------
    $Redirect = "smartdp.php";
// -------------------------
//End Custom Code

//Close GDamPassport_Button_Cancel_OnClick @74-C74AFC8D
    return $GDamPassport_Button_Cancel_OnClick;
}
//End Close GDamPassport_Button_Cancel_OnClick

//GDamPassport_ds_BeforeBuildInsert @18-3DDCE2BD
function GDamPassport_ds_BeforeBuildInsert(& $sender)
{
    $GDamPassport_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GDamPassport; //Compatibility
//End GDamPassport_ds_BeforeBuildInsert

//Custom Code @36-2A29BDB7
// -------------------------
	$datelog = CCGetSession("year")."-".((CCGetSession("month")<10) ? "0":"").CCGetSession("month")."-01";
	
    $GDamPassport->ds->dp_production->SetValue(CCGetSession("prod"));
	$GDamPassport->ds->dp_site->SetValue(CCGetSession("site"));
	$GDamPassport->ds->dp_date->SetValue($datelog);
// -------------------------
//End Custom Code

//Close GDamPassport_ds_BeforeBuildInsert @18-6F6BF510
    return $GDamPassport_ds_BeforeBuildInsert;
}
//End Close GDamPassport_ds_BeforeBuildInsert

//GDamPassport_BeforeShow @18-071583E8
function GDamPassport_BeforeShow(& $sender)
{
    $GDamPassport_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GDamPassport,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GDamPassport_BeforeShow

//Custom Code @70-2A29BDB7
// -------------------------
    if($GDamPassport->PageNumber != null){
		$PageFirstRecordNo = ($GDamPassport->PageSize * ($GDamPassport->PageNumber - 1)) + 1;
	} else {
		$PageFirstRecordNo = ($GDamPassport->PageSize * 0) + 1;
	}
	$BilRekod = $PageFirstRecordNo;
	$GDamPassport->lblNumber->SetValue($BilRekod);
// -------------------------
//End Custom Code

//Close GDamPassport_BeforeShow @18-8FA59C88
    return $GDamPassport_BeforeShow;
}
//End Close GDamPassport_BeforeShow

//GDamPassport_BeforeShowRow @18-9BC72A69
function GDamPassport_BeforeShowRow(& $sender)
{
    $GDamPassport_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GDamPassport,$BilRekod, $PageFirstRecordNo; //Compatibility
//End GDamPassport_BeforeShowRow

//Custom Code @71-2A29BDB7
// -------------------------
    $GDamPassport->lblNumber->SetValue($BilRekod.".");
	$BilRekod = $BilRekod + 1;
// -------------------------
//End Custom Code

//Close GDamPassport_BeforeShowRow @18-46A51790
    return $GDamPassport_BeforeShowRow;
}
//End Close GDamPassport_BeforeShowRow

//Page_AfterInitialize @1-1F10B1E9
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartdp, $RCriteria, $VCriteria, $GDamPassport; //Compatibility
//End Page_AfterInitialize

//Custom Code @31-2A29BDB7
// -------------------------
    $VCriteria->Visible = false;
	$GDamPassport->Visible = false;

	if(CCGetParam("gen")==1) {
		$RCriteria->Visible = false;
		$VCriteria->Visible = true;
		$GDamPassport->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-06BD113F
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartdp; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize
?>
