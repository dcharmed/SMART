<?php
//Include Common Files @1-EED684B1
define("RelativePath", "..");
define("PathToCurrentPage", "/Admin/");
define("FileName", "index.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



//Include Page implementation @18-C518F6CD
include_once(RelativePath . "/Admin/adminheader.php");
//End Include Page implementation

//Include Page implementation @21-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

//Include Page implementation @88-36661A7B
include_once(RelativePath . "/Admin/rightbar.php");
//End Include Page implementation

//DEL      function Show()
//DEL      {
//DEL          global $CCSUseAmp;
//DEL          global $Tpl;
//DEL          global $FileName;
//DEL          global $CCSLocales;
//DEL          $Error = "";
//DEL  
//DEL          if(!$this->Visible)
//DEL              return;
//DEL  
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);
//DEL  
//DEL  
//DEL          $RecordBlock = "Record " . $this->ComponentName;
//DEL          $ParentPath = $Tpl->block_path;
//DEL          $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
//DEL          $this->EditMode = $this->EditMode && $this->ReadAllowed;
//DEL          if($this->EditMode) {
//DEL              if($this->DataSource->Errors->Count()){
//DEL                  $this->Errors->AddErrors($this->DataSource->Errors);
//DEL                  $this->DataSource->Errors->clear();
//DEL              }
//DEL              $this->DataSource->Open();
//DEL              if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
//DEL                  $this->DataSource->SetValues();
//DEL                  $this->linkRefCode2->SetValue($this->DataSource->linkRefCode2->GetValue());
//DEL                  $this->linkRefCode2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
//DEL                  $this->linkRefCode2->Parameters = CCAddParam($this->linkRefCode2->Parameters, "s_code", "state");
//DEL                  $this->linkRefCode1->SetValue($this->DataSource->linkRefCode1->GetValue());
//DEL                  $this->linkRefCode1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
//DEL                  $this->linkRefCode1->Parameters = CCAddParam($this->linkRefCode1->Parameters, "s_code", "probcat");
//DEL              } else {
//DEL                  $this->EditMode = false;
//DEL              }
//DEL          }
//DEL  
//DEL          if($this->FormSubmitted || $this->CheckErrors()) {
//DEL              $Error = "";
//DEL              $Error = ComposeStrings($Error, $this->linkRefCode2->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->linkRefCode1->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->Errors->ToString());
//DEL              $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
//DEL              $Tpl->SetVar("Error", $Error);
//DEL              $Tpl->Parse("Error", false);
//DEL          }
//DEL          $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
//DEL          $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
//DEL          $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
//DEL          $Tpl->SetVar("HTMLFormName", $this->ComponentName);
//DEL          $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
//DEL  
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
//DEL          $this->Attributes->Show();
//DEL          if(!$this->Visible) {
//DEL              $Tpl->block_path = $ParentPath;
//DEL              return;
//DEL          }
//DEL  
//DEL          $this->linkRefCode2->Show();
//DEL          $this->linkRefCode1->Show();
//DEL          $Tpl->parse();
//DEL          $Tpl->block_path = $ParentPath;
//DEL          $this->DataSource->close();
//DEL      }



//Initialize Page @1-B4221438
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
$TemplateFileName = "index.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-75335535
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = & new clsadminheader("", "header", $MainPage);
$header->Initialize();
$footer = & new clsfooter("../", "footer", $MainPage);
$footer->Initialize();
$linkRef1 = & new clsControl(ccsLink, "linkRef1", "linkRef1", ccsText, "", CCGetRequestParam("linkRef1", ccsGet, NULL), $MainPage);
$linkRef1->Page = "AdmRefMngmt.php";
$linkRef2 = & new clsControl(ccsLink, "linkRef2", "linkRef2", ccsText, "", CCGetRequestParam("linkRef2", ccsGet, NULL), $MainPage);
$linkRef2->Page = "AdmRefMngmt.php";
$Image1 = & new clsControl(ccsImage, "Image1", "Image1", ccsText, "", CCGetRequestParam("Image1", ccsGet, NULL), $MainPage);
$linkUsr1 = & new clsControl(ccsLink, "linkUsr1", "linkUsr1", ccsText, "", CCGetRequestParam("linkUsr1", ccsGet, NULL), $MainPage);
$linkUsr1->Page = "AdmUsrMngmt.php";
$linkUsr2 = & new clsControl(ccsLink, "linkUsr2", "linkUsr2", ccsText, "", CCGetRequestParam("linkUsr2", ccsGet, NULL), $MainPage);
$linkUsr2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkUsr2->Page = "AdmUsrMngmt.php";
$linkUsr3 = & new clsControl(ccsLink, "linkUsr3", "linkUsr3", ccsText, "", CCGetRequestParam("linkUsr3", ccsGet, NULL), $MainPage);
$linkUsr3->Page = "AdmUsrMngmt.php";
$Image4 = & new clsControl(ccsImage, "Image4", "Image4", ccsText, "", CCGetRequestParam("Image4", ccsGet, NULL), $MainPage);
$Image5 = & new clsControl(ccsImage, "Image5", "Image5", ccsText, "", CCGetRequestParam("Image5", ccsGet, NULL), $MainPage);
$Image6 = & new clsControl(ccsImage, "Image6", "Image6", ccsText, "", CCGetRequestParam("Image6", ccsGet, NULL), $MainPage);
$linkRef4 = & new clsControl(ccsLink, "linkRef4", "linkRef4", ccsText, "", CCGetRequestParam("linkRef4", ccsGet, NULL), $MainPage);
$linkRef4->Page = "AdmRefMngmt.php";
$Image7 = & new clsControl(ccsImage, "Image7", "Image7", ccsText, "", CCGetRequestParam("Image7", ccsGet, NULL), $MainPage);
$Image8 = & new clsControl(ccsImage, "Image8", "Image8", ccsText, "", CCGetRequestParam("Image8", ccsGet, NULL), $MainPage);
$linkRef5 = & new clsControl(ccsLink, "linkRef5", "linkRef5", ccsText, "", CCGetRequestParam("linkRef5", ccsGet, NULL), $MainPage);
$linkRef5->Page = "AdmRefMngmt.php";
$Image9 = & new clsControl(ccsImage, "Image9", "Image9", ccsText, "", CCGetRequestParam("Image9", ccsGet, NULL), $MainPage);
$Image10 = & new clsControl(ccsImage, "Image10", "Image10", ccsText, "", CCGetRequestParam("Image10", ccsGet, NULL), $MainPage);
$linkRef6 = & new clsControl(ccsLink, "linkRef6", "linkRef6", ccsText, "", CCGetRequestParam("linkRef6", ccsGet, NULL), $MainPage);
$linkRef6->Page = "AdmRefMngmt.php";
$Image11 = & new clsControl(ccsImage, "Image11", "Image11", ccsText, "", CCGetRequestParam("Image11", ccsGet, NULL), $MainPage);
$linkRef7 = & new clsControl(ccsLink, "linkRef7", "linkRef7", ccsText, "", CCGetRequestParam("linkRef7", ccsGet, NULL), $MainPage);
$linkRef7->Page = "AdmRefMngmt.php";
$Image12 = & new clsControl(ccsImage, "Image12", "Image12", ccsText, "", CCGetRequestParam("Image12", ccsGet, NULL), $MainPage);
$linkRef8 = & new clsControl(ccsLink, "linkRef8", "linkRef8", ccsText, "", CCGetRequestParam("linkRef8", ccsGet, NULL), $MainPage);
$linkRef8->Page = "AdmRefMngmt.php";
$Image13 = & new clsControl(ccsImage, "Image13", "Image13", ccsText, "", CCGetRequestParam("Image13", ccsGet, NULL), $MainPage);
$linkRef9 = & new clsControl(ccsLink, "linkRef9", "linkRef9", ccsText, "", CCGetRequestParam("linkRef9", ccsGet, NULL), $MainPage);
$linkRef9->Page = "AdmRefMngmt.php";
$Image14 = & new clsControl(ccsImage, "Image14", "Image14", ccsText, "", CCGetRequestParam("Image14", ccsGet, NULL), $MainPage);
$linkTicket1 = & new clsControl(ccsLink, "linkTicket1", "linkTicket1", ccsText, "", CCGetRequestParam("linkTicket1", ccsGet, NULL), $MainPage);
$linkTicket1->Parameters = CCGetQueryString("QueryString", array("d_tckt", "del", "det", "ccsForm"));
$linkTicket1->Page = "AdmTicMngmt.php";
$Image15 = & new clsControl(ccsImage, "Image15", "Image15", ccsText, "", CCGetRequestParam("Image15", ccsGet, NULL), $MainPage);
$linkTicket3 = & new clsControl(ccsLink, "linkTicket3", "linkTicket3", ccsText, "", CCGetRequestParam("linkTicket3", ccsGet, NULL), $MainPage);
$linkTicket3->Page = "AdmTicMngmt.php";
$rightbar = & new clsrightbar("", "rightbar", $MainPage);
$rightbar->Initialize();
$Image16 = & new clsControl(ccsImage, "Image16", "Image16", ccsText, "", CCGetRequestParam("Image16", ccsGet, NULL), $MainPage);
$linkRef10 = & new clsControl(ccsLink, "linkRef10", "linkRef10", ccsText, "", CCGetRequestParam("linkRef10", ccsGet, NULL), $MainPage);
$linkRef10->Page = "AdmRefMngmt.php";
$Image17 = & new clsControl(ccsImage, "Image17", "Image17", ccsText, "", CCGetRequestParam("Image17", ccsGet, NULL), $MainPage);
$linkPm1 = & new clsControl(ccsLink, "linkPm1", "linkPm1", ccsText, "", CCGetRequestParam("linkPm1", ccsGet, NULL), $MainPage);
$linkPm1->Page = "AdmTicketMngmt.php";
$Image18 = & new clsControl(ccsImage, "Image18", "Image18", ccsText, "", CCGetRequestParam("Image18", ccsGet, NULL), $MainPage);
$linkPm2 = & new clsControl(ccsLink, "linkPm2", "linkPm2", ccsText, "", CCGetRequestParam("linkPm2", ccsGet, NULL), $MainPage);
$linkPm2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkPm2->Page = "AdmTicMngmt.php";
$Image19 = & new clsControl(ccsImage, "Image19", "Image19", ccsText, "", CCGetRequestParam("Image19", ccsGet, NULL), $MainPage);
$linkRfNGenerator1 = & new clsControl(ccsLink, "linkRfNGenerator1", "linkRfNGenerator1", ccsText, "", CCGetRequestParam("linkRfNGenerator1", ccsGet, NULL), $MainPage);
$linkRfNGenerator1->Page = "AdmTicMngmt.php";
$Image20 = & new clsControl(ccsImage, "Image20", "Image20", ccsText, "", CCGetRequestParam("Image20", ccsGet, NULL), $MainPage);
$linkRfNGenerator2 = & new clsControl(ccsLink, "linkRfNGenerator2", "linkRfNGenerator2", ccsText, "", CCGetRequestParam("linkRfNGenerator2", ccsGet, NULL), $MainPage);
$linkRfNGenerator2->Page = "AdmTicMngmt.php";
$Image21 = & new clsControl(ccsImage, "Image21", "Image21", ccsText, "", CCGetRequestParam("Image21", ccsGet, NULL), $MainPage);
$linkEq = & new clsControl(ccsLink, "linkEq", "linkEq", ccsText, "", CCGetRequestParam("linkEq", ccsGet, NULL), $MainPage);
$linkEq->Page = "AdmEqMngmt.php";
$Image22 = & new clsControl(ccsImage, "Image22", "Image22", ccsText, "", CCGetRequestParam("Image22", ccsGet, NULL), $MainPage);
$linkToppan = & new clsControl(ccsLink, "linkToppan", "linkToppan", ccsText, "", CCGetRequestParam("linkToppan", ccsGet, NULL), $MainPage);
$linkToppan->Page = "AdmEqMngmt.php";
$Image23 = & new clsControl(ccsImage, "Image23", "Image23", ccsText, "", CCGetRequestParam("Image23", ccsGet, NULL), $MainPage);
$linkTask1 = & new clsControl(ccsLink, "linkTask1", "linkTask1", ccsText, "", CCGetRequestParam("linkTask1", ccsGet, NULL), $MainPage);
$linkTask1->Page = "AdmTaskMngmt.php";
$Image24 = & new clsControl(ccsImage, "Image24", "Image24", ccsText, "", CCGetRequestParam("Image24", ccsGet, NULL), $MainPage);
$linkTask2 = & new clsControl(ccsLink, "linkTask2", "linkTask2", ccsText, "", CCGetRequestParam("linkTask2", ccsGet, NULL), $MainPage);
$linkTask2->Page = "AdmTaskMngmt.php";
$Image25 = & new clsControl(ccsImage, "Image25", "Image25", ccsText, "", CCGetRequestParam("Image25", ccsGet, NULL), $MainPage);
$linkLog1 = & new clsControl(ccsLink, "linkLog1", "linkLog1", ccsText, "", CCGetRequestParam("linkLog1", ccsGet, NULL), $MainPage);
$linkLog1->Page = "AdmLogMngmt.php";
$Image26 = & new clsControl(ccsImage, "Image26", "Image26", ccsText, "", CCGetRequestParam("Image26", ccsGet, NULL), $MainPage);
$linkLog2 = & new clsControl(ccsLink, "linkLog2", "linkLog2", ccsText, "", CCGetRequestParam("linkLog2", ccsGet, NULL), $MainPage);
$linkLog2->Page = "AdmLogMngmt.php";
$linkEqDel = & new clsControl(ccsLink, "linkEqDel", "linkEqDel", ccsText, "", CCGetRequestParam("linkEqDel", ccsGet, NULL), $MainPage);
$linkEqDel->Page = "AdmEqMngmt.php";
$Image27 = & new clsControl(ccsImage, "Image27", "Image27", ccsText, "", CCGetRequestParam("Image27", ccsGet, NULL), $MainPage);
$linkTicket2 = & new clsControl(ccsLink, "linkTicket2", "linkTicket2", ccsText, "", CCGetRequestParam("linkTicket2", ccsGet, NULL), $MainPage);
$linkTicket2->Page = "AdmTicMngmt.php";
$MainPage->header = & $header;
$MainPage->footer = & $footer;
$MainPage->linkRef1 = & $linkRef1;
$MainPage->linkRef2 = & $linkRef2;
$MainPage->Image1 = & $Image1;
$MainPage->linkUsr1 = & $linkUsr1;
$MainPage->linkUsr2 = & $linkUsr2;
$MainPage->linkUsr3 = & $linkUsr3;
$MainPage->Image4 = & $Image4;
$MainPage->Image5 = & $Image5;
$MainPage->Image6 = & $Image6;
$MainPage->linkRef4 = & $linkRef4;
$MainPage->Image7 = & $Image7;
$MainPage->Image8 = & $Image8;
$MainPage->linkRef5 = & $linkRef5;
$MainPage->Image9 = & $Image9;
$MainPage->Image10 = & $Image10;
$MainPage->linkRef6 = & $linkRef6;
$MainPage->Image11 = & $Image11;
$MainPage->linkRef7 = & $linkRef7;
$MainPage->Image12 = & $Image12;
$MainPage->linkRef8 = & $linkRef8;
$MainPage->Image13 = & $Image13;
$MainPage->linkRef9 = & $linkRef9;
$MainPage->Image14 = & $Image14;
$MainPage->linkTicket1 = & $linkTicket1;
$MainPage->Image15 = & $Image15;
$MainPage->linkTicket3 = & $linkTicket3;
$MainPage->rightbar = & $rightbar;
$MainPage->Image16 = & $Image16;
$MainPage->linkRef10 = & $linkRef10;
$MainPage->Image17 = & $Image17;
$MainPage->linkPm1 = & $linkPm1;
$MainPage->Image18 = & $Image18;
$MainPage->linkPm2 = & $linkPm2;
$MainPage->Image19 = & $Image19;
$MainPage->linkRfNGenerator1 = & $linkRfNGenerator1;
$MainPage->Image20 = & $Image20;
$MainPage->linkRfNGenerator2 = & $linkRfNGenerator2;
$MainPage->Image21 = & $Image21;
$MainPage->linkEq = & $linkEq;
$MainPage->Image22 = & $Image22;
$MainPage->linkToppan = & $linkToppan;
$MainPage->Image23 = & $Image23;
$MainPage->linkTask1 = & $linkTask1;
$MainPage->Image24 = & $Image24;
$MainPage->linkTask2 = & $linkTask2;
$MainPage->Image25 = & $Image25;
$MainPage->linkLog1 = & $linkLog1;
$MainPage->Image26 = & $Image26;
$MainPage->linkLog2 = & $linkLog2;
$MainPage->linkEqDel = & $linkEqDel;
$MainPage->Image27 = & $Image27;
$MainPage->linkTicket2 = & $linkTicket2;
$linkRef1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef1->Parameters = CCAddParam($linkRef1->Parameters, "s_code", probcat);
$linkRef2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef2->Parameters = CCAddParam($linkRef2->Parameters, "s_code", state);
$linkUsr1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkUsr1->Parameters = CCAddParam($linkUsr1->Parameters, "new", 1);
$linkUsr3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkUsr3->Parameters = CCAddParam($linkUsr3->Parameters, "action", cp);
$linkRef4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef4->Parameters = CCAddParam($linkRef4->Parameters, "type", tcktstatus);
$linkRef5->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef5->Parameters = CCAddParam($linkRef5->Parameters, "type", rsltnmethod);
$linkRef6->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef6->Parameters = CCAddParam($linkRef6->Parameters, "type", state);
$linkRef7->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef7->Parameters = CCAddParam($linkRef7->Parameters, "type", tcktseverity);
$linkRef8->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef8->Parameters = CCAddParam($linkRef8->Parameters, "type", taskstatus);
$linkRef9->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef9->Parameters = CCAddParam($linkRef9->Parameters, "type", evnttype);
$linkTicket3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkTicket3->Parameters = CCAddParam($linkTicket3->Parameters, "del", 1);
$linkRef10->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRef10->Parameters = CCAddParam($linkRef10->Parameters, "type", esc);
$linkPm1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkPm1->Parameters = CCAddParam($linkPm1->Parameters, "new", 1);
$linkRfNGenerator1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRfNGenerator1->Parameters = CCAddParam($linkRfNGenerator1->Parameters, "refgen", 1);
$linkRfNGenerator1->Parameters = CCAddParam($linkRfNGenerator1->Parameters, "type", tckt);
$linkRfNGenerator2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkRfNGenerator2->Parameters = CCAddParam($linkRfNGenerator2->Parameters, "refgen", 1);
$linkRfNGenerator2->Parameters = CCAddParam($linkRfNGenerator2->Parameters, "type", pm);
$linkEq->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkEq->Parameters = CCAddParam($linkEq->Parameters, "type", eq);
$linkToppan->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkToppan->Parameters = CCAddParam($linkToppan->Parameters, "s_code", toppan);
$linkTask1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkTask1->Parameters = CCAddParam($linkTask1->Parameters, "type", task);
$linkTask2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkTask2->Parameters = CCAddParam($linkTask2->Parameters, "del", type);
$linkLog1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkLog1->Parameters = CCAddParam($linkLog1->Parameters, "type", log);
$linkLog2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkLog2->Parameters = CCAddParam($linkLog2->Parameters, "type", trend);
$linkEqDel->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkEqDel->Parameters = CCAddParam($linkEqDel->Parameters, "type", deleq);
$linkTicket2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$linkTicket2->Parameters = CCAddParam($linkTicket2->Parameters, "det", 1);

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-237999F8
$header->Operations();
$footer->Operations();
$rightbar->Operations();
//End Execute Components

//Go to destination page @1-B90779C7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $footer->Class_Terminate();
    unset($footer);
    $rightbar->Class_Terminate();
    unset($rightbar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E32AB61B
$header->Show();
$footer->Show();
$rightbar->Show();
$linkRef1->Show();
$linkRef2->Show();
$Image1->Show();
$linkUsr1->Show();
$linkUsr2->Show();
$linkUsr3->Show();
$Image4->Show();
$Image5->Show();
$Image6->Show();
$linkRef4->Show();
$Image7->Show();
$Image8->Show();
$linkRef5->Show();
$Image9->Show();
$Image10->Show();
$linkRef6->Show();
$Image11->Show();
$linkRef7->Show();
$Image12->Show();
$linkRef8->Show();
$Image13->Show();
$linkRef9->Show();
$Image14->Show();
$linkTicket1->Show();
$Image15->Show();
$linkTicket3->Show();
$Image16->Show();
$linkRef10->Show();
$Image17->Show();
$linkPm1->Show();
$Image18->Show();
$linkPm2->Show();
$Image19->Show();
$linkRfNGenerator1->Show();
$Image20->Show();
$linkRfNGenerator2->Show();
$Image21->Show();
$linkEq->Show();
$Image22->Show();
$linkToppan->Show();
$Image23->Show();
$linkTask1->Show();
$Image24->Show();
$linkTask2->Show();
$Image25->Show();
$linkLog1->Show();
$Image26->Show();
$linkLog2->Show();
$linkEqDel->Show();
$Image27->Show();
$linkTicket2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E46ABC56
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$header->Class_Terminate();
unset($header);
$footer->Class_Terminate();
unset($footer);
$rightbar->Class_Terminate();
unset($rightbar);
unset($Tpl);
//End Unload Page


?>
