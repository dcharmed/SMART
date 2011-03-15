<?php

//CalendarNavigator Class @0-7111A2AE


class clsCalendarNavigator {


  var $ComponentType = "CalendarNavigator";
  var $CalendarNavigatorName;
  var $TargetName;
  var $CalendarType;
  var $Visible;
  var $CCSEvents;
  var $CCSEventResult;
  var $Parent;
  var $YearsRange;
  var $CurrentProcessingDate;
  var $NextProcessingDate;
  var $PrevProcessingDate;

  var $CurrentDate;

  var $Attributes;


  function clsCalendarNavigator($ComponentName, $CalendarNavigatorName, $CalendarType, $YearsRange = 10, & $Parent){
    $this->TargetName = $ComponentName;
    $this->CalendarNavigatorName = $CalendarNavigatorName;
    $this->CalendarType = $CalendarType;
    $this->YearsRange = $YearsRange;
    $this->Visible = true;
    $this->CCSEvents = array();
    $this->Parent = & $Parent;
    $this->Attributes = new clsAttributes($this->CalendarNavigatorName . ":");
  }

  function CreateURL($QueryString) {
    global $CCSUseAmp;
    global $FileName;
    $datestr = CCFormatDate($this->CurrentProcessingDate, array("yyyy","-", "mm"));
    $Return = $FileName . "?" . CCAddParam($QueryString, $this->TargetName . "Date", $datestr);
    if ($CCSUseAmp) {
      $Return = str_replace("&", "&amp;", $Return);
    }
    return $Return;
  }


  function ShowBlock($QueryString, $name="", $to = "", $accumulate = true) {
    global $Tpl;
    $Tpl->SetVar("URL", $this->CreateURL($QueryString));
    $Tpl->SetVar("CalendarName", $this->TargetName);
    $Tpl->SetVar("Year", CCFormatDate($this->CurrentProcessingDate, array("yyyy")));
    if (strpos($name, "CalendarNavigator")  !== false || strpos($name, "Month")  !== false || strpos($name, "Quarter")  !== false) {
      $Tpl->SetVar("Quarter", CCFormatDate($this->CurrentProcessingDate, array("q")));
      $Tpl->SetVar("Month", CCFormatDate($this->CurrentProcessingDate, array("m")));
      $Tpl->SetVar("MonthFullName", CCFormatDate($this->CurrentProcessingDate, array("mmmm")));
      $Tpl->SetVar("MonthShortName", CCFormatDate($this->CurrentProcessingDate, array("mmm")));
    }
    if ($to) 
      $Tpl->ParseTo($name, $accumulate, $to);
    else
     $Tpl->Parse($name, $accumulate); 
  }

  function Show() {
    global $CCSUseAmp;
    global $Tpl;
    global $FileName;

    $this->EventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);

    if(!$this->Visible) { return; }

    $RemoveFromUrl = array(
      $this->TargetName . "Year",
      $this->TargetName . "Month",
      $this->TargetName . "Date",
      );
    $QueryString = CCGetQueryString("QueryString", $RemoveFromUrl);

    $ParentPath = $Tpl->block_path;
    $CalendarNavigatorBlock = "CalendarNavigator " . $this->CalendarNavigatorName;
    $Tpl->block_path = $ParentPath . "/" . $CalendarNavigatorBlock;
    $Tpl->SetBlockVar("", "");
    $Tpl->SetBlockVar("Years", "");
    $Tpl->SetBlockVar("Months", "");
    $Tpl->SetBlockVar("Quarters", "");
    $this->Attributes->Show();
    $Blocks = array("Months", "Quarters", "Years");
    foreach ($Blocks as $Block) {
      if ($Tpl->BlockExists($Block)) {
        if ($Block == "Years") {
          $this->CurrentProcessingDate = CCDateAdd($this->CurrentDate, "-" . $this->YearsRange . "years");
          $LastDate = CCDateAdd($this->CurrentDate, "+" . $this->YearsRange . "years");
          $add = "1year";
          $name = "Year";
        } elseif ($Block == "Quarters" && $this->CalendarType == "Quarter") {
          $this->CurrentProcessingDate = CCParseDate(CCFormatDate($this->CurrentDate, array("yyyy","-01-01 00:00:00")), array("yyyy","-","mm","-","dd"," ","HH",":","nn",":","ss"));
          $LastDate = CCDateAdd($this->CurrentProcessingDate, "+1year -1sec");
          $add = "3month";
          $name = "Quarter";
        } elseif ($this->CalendarType != 12) {
          $this->CurrentProcessingDate = CCParseDate(CCFormatDate($this->CurrentDate, array("yyyy","-01-01 00:00:00")), array("yyyy","-","mm","-","dd"," ","HH",":","nn",":","ss"));
          $LastDate = CCDateAdd($this->CurrentProcessingDate, "+1year -1sec");
          $add="1month";
          $name = "Month";
        } else {
	  continue;
	}

        while (CCCompareValues($this->CurrentProcessingDate, $LastDate, ccsDate) <= 0) {
          $NextDate = CCDateAdd($this->CurrentProcessingDate, $add);
          if (($Block == "Years" && $this->CurrentProcessingDate[ccsYear] ==  $this->CurrentDate[ccsYear]) || 
             ($Block == "Months" && $this->CurrentProcessingDate[ccsMonth] ==  $this->CurrentDate[ccsMonth]) ||
             ($Block == "Quarters" && ceil($this->CurrentProcessingDate[ccsMonth] / 3 + 0.1) ==  ceil($this->CurrentDate[ccsMonth] / 3))) {
            $this->ShowBlock($QueryString, $Block . "/Current_" . $name, $Block . "/Regular_" . $name);
          } else {
            $this->ShowBlock($QueryString, $Block . "/Regular_" . $name);
          }
          $this->CurrentProcessingDate = $NextDate;
        }
        $this->ShowBlock($QueryString, $Block);
      }
    }
    if ($Tpl->BlockExists("Prev_Year")) {
      $this->CurrentProcessingDate = CCDateAdd($this->CurrentDate, "-1year");
      $this->ShowBlock($QueryString, "Prev_Year", "", false);
    }
    if ($Tpl->BlockExists("Next_Year")) {
      $this->CurrentProcessingDate = CCDateAdd($this->CurrentDate, "+1year");
      $this->ShowBlock($QueryString, "Next_Year", "", false);
    }
    if ($this->CalendarType != 12) {

      if ($Tpl->BlockExists("Prev")){
        $this->CurrentProcessingDate = $this->PrevProcessingDate;
        $this->ShowBlock($QueryString, "Prev", "", false);
      }
      if ($Tpl->BlockExists("Next")){
        $this->CurrentProcessingDate = $this->NextProcessingDate;
        $this->ShowBlock($QueryString, "Next", "", false);
      }
    }

    $Tpl->block_path = $ParentPath;
    $ActionStr = $FileName . "?" . CCAddParam($QueryString, "ccsForm", $this->TargetName);
    if ($CCSUseAmp) {
      $ActionStr = str_replace('&', '&amp;', $ActionStr);
    }
    $Tpl->SetVar("Action", $ActionStr);
    $Tpl->SetVar("CalendarName", $this->TargetName);
    $this->CurrentProcessingDate = $this->CurrentDate;
    $this->ShowBlock($QueryString, $CalendarNavigatorBlock, "", false);
  } 
}
//End CalendarNavigator Class


?>
