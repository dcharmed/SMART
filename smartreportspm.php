<?php
//Include Common Files @1-CB42AF32
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "smartreportspm.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-B084B3BB
include_once(RelativePath . "/smartheader.php");
//End Include Page implementation

//Include Page implementation @4-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

//Include Page implementation @5-92A768E8
include_once(RelativePath . "/reportspm.php");
//End Include Page implementation

//Initialize Page @1-9401C5CD
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "smartreportspm.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DFA6DECB
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clssmartheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$reportspm = & new clsreportspm("", "reportspm", $MainPage);
$reportspm->Initialize();
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->reportspm = & $reportspm;

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-275E03E7
$header->Operations();
$footer->Operations();
$reportspm->Operations();
//End Execute Components

//Go to destination page @1-DBC94DF1
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    $reportspm->Class_Terminate();
    unset($reportspm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B9456B82
$header->Show();
$footer->Show();
$reportspm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CB5C1F44
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
$reportspm->Class_Terminate();
unset($reportspm);
unset($Tpl);
//End Unload Page


?>
