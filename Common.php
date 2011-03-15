<?php

//Include Files @0-ED610940
include(RelativePath . "/Classes.php");
include(RelativePath . "/db_adapter.php");
//End Include Files

//Connection Settings @0-D6F630C9
$CCConnectionSettings = array (
    "SMART" => array(
        "Type" => "MySQL",
        "DBLib" => "MySQL",
        "Database" => "smart_dbsmart",
        "Host" => "localhost",
        "Port" => "",
        "User" => "smart_smart",
        "Password" => "suen1982",
        "Persistent" => false,
        "DateFormat" => array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"),
        "BooleanFormat" => array("true", "false", ""),

        "Uppercase" => false
    )
);
//End Connection Settings

//Initialize Common Variables @0-BE6A5F3B
$PHPVersion = explode(".",  phpversion());
if (($PHPVersion[0] < 4) || ($PHPVersion[0] == 4  && $PHPVersion[1] < 1)) {
    echo "Sorry. This program requires PHP 4.1 and above to run. You may upgrade your php at <a href='http://www.php.net/downloads.php'>http://www.php.net/downloads.php</a>";
    exit;
}
if (session_id() == "")
    session_start();
header('Pragma: ');
header('Cache-control: ');
header('Expires: ');
define("TemplatePath", RelativePath);
define("ServerURL", ((isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? "https://" : "http://" ). preg_replace("/:\d+$/", "", $_SERVER["HTTP_HOST"] ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"]) . ($_SERVER["SERVER_PORT"] != 80 ? ":" . $_SERVER["SERVER_PORT"] : "") . substr($_SERVER["PHP_SELF"], 0, strlen($_SERVER["PHP_SELF"]) - strlen(PathToCurrentPage . FileName)) . "/");
define("SecureURL", "");

$FileEncoding = "CP1252";
$CCSIsXHTML = false;
$CCSUseAmp = true;
$CipherBox = array();
$CipherKey = array();
$CCSLocales = new clsLocales(RelativePath);
$CCSLocales->AddLocale("en", Array("en", "US", array("Yes", "No", ""), 2, ".", ",", array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"), array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"), array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"), array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"), array("S", "M", "T", "W", "T", "F", "S"), array("dd", "/", "mm", "/", "yy"), array("dd", "/", "mm", "/", "yy"), array("h", ":", "nn", " ", "tt"), array("h", ":", "nn", ":", "ss", " ", "tt"), "AM", "PM", 0, false, "", "windows-1252", "CP1252"));
$CCSLocales->DefaultLocale = strtolower("en");
$CCSLocales->Init();
$Charset = "";

if ($PHPLocale = $CCSLocales->GetFormatInfo("PHPLocale"))
    setlocale(LC_ALL, $PHPLocale);
CCConvertDataArrays();
$CCProjectStyle = "smartStyleTurqoise";
CCSelectProjectStyle();
//for compatibility
$ShortWeekdays = $CCSLocales->GetFormatInfo("WeekdayShortNames");
$Weekdays = $CCSLocales->GetFormatInfo("WeekdayNames");
$ShortMonths =  $CCSLocales->GetFormatInfo("MonthShortNames");
$Months = $CCSLocales->GetFormatInfo("MonthNames");

define("ccsInteger", 1);
define("ccsFloat", 2);
define("ccsSingle", ccsFloat); //alias
define("ccsText", 3);
define("ccsDate", 4);
define("ccsBoolean", 5);
define("ccsMemo", 6);

define("ccsGet", 1);
define("ccsPost", 2);

define("ccsTimestamp", 0);
define("ccsYear", 1);
define("ccsMonth", 2);
define("ccsDay", 3);
define("ccsHour", 4);
define("ccsMinute", 5);
define("ccsSecond", 6);
define("ccsMilliSecond", 7);
define("ccsAmPm", 8);
define("ccsShortMonth", 9);
define("ccsFullMonth", 10);
define("ccsWeek", 11);
define("ccsGMT", 12);
define("ccsAppropriateYear", 13);
define("CCS_ENCRYPTION_KEY_FOR_COOKIE", '196E4038BrRiEp66');
define("CCS_EXPIRATION_DATE", 30 * 24 * 3600);
define("CCS_SLIDING_EXPIRATION", false);

$DefaultDateFormat = array("LongDate");

$MainPage = new clsMainPage();
//End Initialize Common Variables

//SMART Connection Class @-6B1E1624
class clsDBSMART extends DB_Adapter
{
    function clsDBSMART()
    {
        $this->Initialize();
    }

    function Initialize()
    {
        global $CCConnectionSettings;
        $this->SetProvider($CCConnectionSettings["SMART"]);
        parent::Initialize();
        $this->DateLeftDelimiter = "'";
        $this->DateRightDelimiter = "'";
    }

    function OptimizeSQL($SQL)
    {
        $PageSize = (int) $this->PageSize;
        if (!$PageSize) return $SQL;
        $Page = $this->AbsolutePage ? (int) $this->AbsolutePage : 1;
        if (strcmp($this->RecordsCount, "CCS not counted")) 
            $SQL .= (" LIMIT " . (($Page - 1) * $PageSize) . "," . $PageSize);
        else
            $SQL .= (" LIMIT " . (($Page - 1) * $PageSize) . "," . ($PageSize + 1));
        return $SQL;
    }

}
//End SMART Connection Class

//Initialize Cookie Check @0-56800F96
CCCheckAutoLoginCookies();
//End Initialize Cookie Check

//CCToHTML @0-93F44B0D
function CCToHTML($Value)
{
  return htmlspecialchars($Value);
}
//End CCToHTML

//CCToURL @0-88FAFE26
function CCToURL($Value)
{
  return urlencode($Value);
}
//End CCToURL

//CCGetEvent @0-7AE506F3
function CCGetEvent($events, $event_name, & $sender)
{
  $result = true;
  $function_name = (is_array($events) && isset($events[$event_name])) ? $events[$event_name] : "";
  if($function_name && function_exists($function_name))
    $result = call_user_func_array($function_name, array(& $sender));
  return $result;  
}
//End CCGetEvent

//CCGetParentContainer @0-0CD41DEB
function & CCGetParentContainer(& $object)
{
  $i = & $object;
  while ($i && !($i->ComponentType == "Page" || $i->ComponentType == "IncludablePage" || $i->ComponentType == "Directory" || $i->ComponentType == "Path" || $i->ComponentType == "EditableGrid" || $i->ComponentType == "Grid" || $i->ComponentType == "Record" || $i->ComponentType == "Report" || $i->ComponentType == "Calendar"))
    $i = & $i->Parent;
  return $i;
}
//End CCGetParentContainer

//CCGetParentPage @0-AD47469D
function & CCGetParentPage(& $object)
{
  $i = & $object;
  while ($i && !($i->ComponentType == "Page" || $i->ComponentType == "IncludablePage"))
    $i = & $i->Parent;
  return $i;
}
//End CCGetParentPage

//CCGetValueHTML @0-B8903145
function CCGetValueHTML(&$db, $fieldname)
{
  return CCToHTML($db->f($fieldname));
}
//End CCGetValueHTML

//CCGetValue @0-36EF6396
function CCGetValue(&$db, $fieldname)
{
  return $db->f($fieldname);
}
//End CCGetValue

//CCGetSession @0-A9848448
function CCGetSession($parameter_name, $default_value = "")
{
    return isset($_SESSION[$parameter_name]) ? $_SESSION[$parameter_name] : $default_value;
}
//End CCGetSession

//CCSetSession @0-7889A59E
function CCSetSession($param_name, $param_value)
{
    $_SESSION[$param_name] = $param_value;
}
//End CCSetSession

//CCGetCookie @0-6B04B9B5
function CCGetCookie($parameter_name)
{
    return isset($_COOKIE[$parameter_name]) ? $_COOKIE[$parameter_name] : "";
}
//End CCGetCookie

//CCSetCookie @0-0148E673
function CCSetCookie($parameter_name, $param_value, $expired = -1)
{
  if ($expired == -1)
    $expired = time() + 3600 * 24 * 366;
  elseif ($expired && $expired < time())
    $expired = time() + $expired;
  setcookie ($parameter_name, $param_value, $expired);  
}
//End CCSetCookie

//CCStrip @0-E1370054
function CCStrip($value)
{
  if(get_magic_quotes_gpc() != 0)
  {
    if(is_array($value))  
      foreach($value as $key=>$val)
        $value[$key] = stripslashes($val);
    else
      $value = stripslashes($value);
  }
  return $value;
}
//End CCStrip

//CCGetParam @0-3BB7E2D4
function CCGetParam($parameter_name, $default_value = "")
{
    $parameter_value = "";
    if(isset($_POST[$parameter_name]))
        $parameter_value = CCStrip($_POST[$parameter_name]);
    else if(isset($_GET[$parameter_name]))
        $parameter_value = CCStrip($_GET[$parameter_name]);
    else
        $parameter_value = $default_value;
    return $parameter_value;
}
//End CCGetParam

//CCGetParamStartsWith @0-4BE76C1A
function CCGetParamStartsWith($prefix)
{
    $parameter_name = "";
    foreach($_POST as $key => $value) {
        if(preg_match ("/^" . $prefix . "_\d+$/i", $key)) {
            $parameter_name = $key;
            break;
        }
    }
    if($parameter_name === "") {
        foreach($_GET as $key => $value) {
            if(preg_match ("/^" . $prefix . "_\d+$/i", $key)) {
                $parameter_name = $key;
                break;
            }
        }
    }
    return $parameter_name;
}
//End CCGetParamStartsWith

//CCGetFromPost @0-393586D2
function CCGetFromPost($parameter_name, $default_value = "")
{
    return isset($_POST[$parameter_name]) ? CCStrip($_POST[$parameter_name]) : $default_value;
}
//End CCGetFromPost

//CCGetFromGet @0-90CF1921
function CCGetFromGet($parameter_name, $default_value = "")
{
    return isset($_GET[$parameter_name]) ? CCStrip($_GET[$parameter_name]) : $default_value;
}
//End CCGetFromGet

//CCToSQL @0-422F5B92
function CCToSQL($Value, $ValueType)
{
  if(!strlen($Value))
  {
    return "NULL";
  }
  else
  {
    if($ValueType == ccsInteger || $ValueType == ccsFloat)
    {
      return doubleval(str_replace(",", ".", $Value));
    }
    else
    {
      return "'" . str_replace("'", "''", $Value) . "'";
    }
  }
}
//End CCToSQL

//CCDLookUp @0-AD41DC8E
function CCDLookUp($field_name, $table_name, $where_condition, &$db)
{
  $sql = "SELECT " . $field_name . ($table_name ? " FROM " . $table_name : "") . ($where_condition ? " WHERE " . $where_condition : "");
  //echo "<bR>".$sql."<br>";
  return CCGetDBValue($sql, $db);
}
//End CCDLookUp

//CCGetDBValue @0-6DCF4DC4
function CCGetDBValue($sql, &$db)
{
  $db->query($sql);
  $dbvalue = $db->next_record() ? $db->f(0) : "";
  return $dbvalue;  
}
//End CCGetDBValue

//CCGetListValues @0-74F64ABA
function CCGetListValues(&$db, $sql, $where = "", $order_by = "", $bound_column = "", $text_column = "", $dbformat = "", $datatype = "", $errorclass = "", $fieldname = "", $DSType = dsSQL)
{
    $errors = new clsErrors();
    $values = "";
    if(!strlen($bound_column))
        $bound_column = 0;
    if(!strlen($text_column))
        $text_column = 1;
    if ($DSType == dsProcedure && $db->DB == "MSSQL" && count($db->Binds)) 
        $db->execute($sql);
    else
        $db->query(CCBuildSQL($sql, $where, $order_by));
    if ($db->next_record())
    {
        do
        {
            $bound_column_value = $db->f($bound_column);
            if($bound_column_value === false) {$bound_column_value = "";}
            list($bound_column_value, $errors) = CCParseValue($bound_column_value, $dbformat, $datatype, $errors, $fieldname);
            $values[] = array($bound_column_value, $db->f($text_column));
        } while ($db->next_record());
    }
    if (is_string($errorclass)) {
        return $values;
    } else {
        $errorclass->AddErrors($errors);
        return array($values, $errorclass);
    }
}

//End CCGetListValues

//CCParseValue @0-DCA2A586
  function CCParseValue($ParsingValue, $Format, $DataType, $ErrorClass, $FieldName, $isDBFormat = false)
  {
    global $CCSLocales;
    $errors = new clsErrors();
    $varResult = "";
    if(CCCheckValue($ParsingValue, $DataType))
      $varResult = $ParsingValue;
    else if(strlen($ParsingValue))
    {
      switch ($DataType)
      {
        case ccsDate:
          $DateValidation = true;
          if (CCValidateDateMask($ParsingValue, $Format)) {
            $varResult = CCParseDate($ParsingValue, $Format);
            if(!CCValidateDate($varResult)) {
              $DateValidation = false;
              $varResult = "";
            }
          } else {
            $DateValidation = false;
          }
          if(!$DateValidation && $ErrorClass->Count() == 0) {
            if (is_array($Format)) {
              $FormatString = join("", $Format);
            } else {
              $FormatString = $Format;
            }
            $errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($FieldName, $FormatString)));
          }
          break;
        case ccsBoolean:
          if (CCValidateBoolean($ParsingValue, $Format)) {
            $varResult = CCParseBoolean($ParsingValue, $Format);
          } else if($ErrorClass->Count() == 0) {
            if (is_array($Format)) {
              $FormatString = CCGetBooleanFormat($Format);
            } else {
              $FormatString = $Format;
            }
            $errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($FieldName, $FormatString)));
          }
          break;
        case ccsInteger:
          if (CCValidateNumber($ParsingValue, $Format, $isDBFormat))
            $varResult = CCParseInteger($ParsingValue, $Format, $isDBFormat);
          else if($ErrorClass->Count() == 0)
            $errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($FieldName, $Format)));
          break;
        case ccsFloat:
          if (CCValidateNumber($ParsingValue, $Format, $isDBFormat))
            $varResult = CCParseFloat($ParsingValue, $Format, $isDBFormat);
          else if($ErrorClass->Count() == 0)
            $errors->addError($CCSLocales->GetText('CCS_IncorrectFormat', array($FieldName, $Format)));
          break;
        case ccsText:
        case ccsMemo:
          $varResult = strval($ParsingValue);
          break;
      }
    }
  if (is_string($ErrorClass)) {
    return $varResult;
  } else {
    $ErrorClass->AddErrors($errors);
    return array($varResult, $ErrorClass);
  }
}

//End CCParseValue

//CCFormatValue @0-A384E38C
  function CCFormatValue($Value, $Format, $DataType, $isDBFormat = false)
  {
    switch($DataType)
    {
      case ccsDate:
        $Value = CCFormatDate($Value, $Format);
        break;
      case ccsBoolean:
        $Value = CCFormatBoolean($Value, $Format);
        break;
      case ccsInteger:
      case ccsFloat:
      case ccsSingle:
        $Value = CCFormatNumber($Value, $Format, $DataType, $isDBFormat);
        break;
      case ccsText:
      case ccsMemo:
        $Value = strval($Value);
        break;
    }
    return $Value;
  }

//End CCFormatValue

//CCBuildSQL @0-9C1D4901
function CCBuildSQL($sql, $where = "", $order_by = "")
{
    if (!$sql) return "";
    if(strlen($where)) $where = " WHERE " . $where;
    if(strlen($order_by)) $order_by = " ORDER BY " . $order_by;
    if(stristr($sql,"{SQL_Where}") || stristr($sql,"{SQL_OrderBy}")) {
        $sql = str_replace("{SQL_Where}", $where, $sql);
        $sql = str_replace("{SQL_OrderBy}", $order_by, $sql);
        return $sql;
    }
    $sql .= $where . $order_by;
    return $sql;
}

//End CCBuildSQL

//CCBuildInsert @0-6433D327
function CCBuildInsert($table, & $Fields, & $Connection)
{
    $fields = array();
    $values = array();
    foreach ($Fields as $Field) {
        if (!isset($Field["OmitIfEmpty"]) || !$Field["OmitIfEmpty"] || !is_null($Field["Value"])) {
            $fields[] = $Field["Name"];
            if ($Field["DataType"] == ccsMemo && ($Connection->DB == "Oracle" || $Connection->DB == "OracleOCI")) {
                $values[] = ":" . $Field["Name"];
                $Connection->Bind($Field["Name"], $Field["Value"], -1);
            }else{
                $values[] = $Connection->ToSQL($Field["Value"], $Field["DataType"]);
            }
        }
    }
  return count($fields) ? "INSERT INTO " . $table . " (" . implode(", ", $fields) . ") VALUES(" . implode(", ", $values) . ")" : "";

}

//End CCBuildInsert

//CCBuildUpdate @0-E2594C39
function CCBuildUpdate($table, & $Fields, & $Connection)
{
    $pairs = array();
    foreach ($Fields as $Field) {
        if (!isset($Field["OmitIfEmpty"]) || !$Field["OmitIfEmpty"] || !is_null($Field["Value"])) {
            if ($Field["DataType"] == ccsMemo && ($Connection->DB == "Oracle" || $Connection->DB == "OracleOCI")) {
                $value = ":" . $Field["Name"];
                $Connection->Bind($Field["Name"], $Field["Value"], -1);
            }else{
                $value = $Connection->ToSQL($Field["Value"], $Field["DataType"]);
            }
            $pairs[] = $Field["Name"] . " = " . $value;
        }
    }
  return count($pairs) ? "UPDATE " . $table . " SET " . implode(", ", $pairs) : "";

}

//End CCBuildUpdate

//CCGetRequestParam @0-AC78F6A0
function CCGetRequestParam($ParameterName, $Method, $DefaultValue = "")
{
    $ParameterValue = $DefaultValue;
    if($Method == ccsGet && isset($_GET[$ParameterName]))
        $ParameterValue = CCStrip($_GET[$ParameterName]);
    else if($Method == ccsPost && isset($_POST[$ParameterName]))
        $ParameterValue = CCStrip($_POST[$ParameterName]);
    return $ParameterValue;
}
//End CCGetRequestParam

//CCGetQueryString @0-CDA71B06
function CCGetQueryString($CollectionName, $RemoveParameters)
{
    $querystring = "";
    $postdata = "";
    if($CollectionName == "Form")
        $querystring = CCCollectionToString($_POST, $RemoveParameters);
    else if($CollectionName == "QueryString")
        $querystring = CCCollectionToString($_GET, $RemoveParameters);
    else if($CollectionName == "All")
    {
        $querystring = CCCollectionToString($_GET, $RemoveParameters);
        $postdata = CCCollectionToString($_POST, $RemoveParameters);
        if(strlen($postdata) > 0 && strlen($querystring) > 0)
            $querystring .= "&" . $postdata;
        else
            $querystring .= $postdata;
    }
    else
        die("1050: Common Functions. CCGetQueryString Function. " .
            "The CollectionName contains an illegal value.");
    return $querystring;
}
//End CCGetQueryString

//CCCollectionToString @0-F45EFAFC
function CCCollectionToString($ParametersCollection, $RemoveParameters)
{
  $Result = ""; 
  if(is_array($ParametersCollection))
  {
    reset($ParametersCollection);
    foreach($ParametersCollection as $ItemName => $ItemValues)
    {
      $Remove = false;
      if(is_array($RemoveParameters))
      {
        foreach($RemoveParameters as $key => $val)
        {
          if($val == $ItemName)
          {
            $Remove = true;
            break;
          }
        }
      }
      if(!$Remove)
      {
        if(is_array($ItemValues))
          for($J = 0; $J < sizeof($ItemValues); $J++)
            $Result .= "&" . urlencode(CCStrip($ItemName)) . "[]=" . urlencode(CCStrip($ItemValues[$J]));
        else
           $Result .= "&" . urlencode(CCStrip($ItemName)) . "=" . urlencode(CCStrip($ItemValues));
      }
    }
  }

  if(strlen($Result) > 0)
    $Result = substr($Result, 1);
  return $Result;
}
//End CCCollectionToString

//CCMergeQueryStrings @0-5BB2EE59
function CCMergeQueryStrings($LeftQueryString, $RightQueryString = "")
{
  $QueryString = $LeftQueryString; 
  if($QueryString === "")
    $QueryString = $RightQueryString;
  else if($RightQueryString !== "")
    $QueryString .= '&' . $RightQueryString;
  
  return $QueryString;
}
//End CCMergeQueryStrings

//CCAddParam @0-5D96DB6B
function CCAddParam($querystring, $ParameterName, $ParameterValue)
{
    $queryStr = null; $paramStr = null;
    if (strpos($querystring, '?') !== false)
        list($queryStr, $paramStr) = explode('?', $querystring);
    else if (strpos($querystring, '=') !== false)
        $paramStr = $querystring;
    else
        $queryStr = $querystring;
    $paramStr = $paramStr ? '&' . $paramStr : '';
    $paramStr = preg_replace ('/&' . $ParameterName . '(\[\])?=[^&]*/', '', $paramStr);
    if(is_array($ParameterValue)) {
        foreach($ParameterValue as $key => $val) {
            $paramStr .= "&" . urlencode($ParameterName) . "[]=" . urlencode($val);
        }
    } else {
        $paramStr .= "&" . urlencode($ParameterName) . "=" . urlencode($ParameterValue);
    }
    $paramStr = ltrim($paramStr, '&');
    return $queryStr ? $queryStr . '?' . $paramStr : $paramStr;
}
//End CCAddParam

//CCRemoveParam @0-E44DBAB9
function CCRemoveParam($querystring, $ParameterName)
{
    if (strpos($querystring, '?') !== false)
        list($queryStr, $paramStr) = explode('?', $querystring);
    else if (strpos($querystring, '=') !== false)
        $paramStr = $querystring;
    else
        $queryStr = $querystring;
    $paramStr = $paramStr ? '&' . $paramStr : '';
    $paramStr = preg_replace ('/&' . $ParameterName . '(\[\])?=[^&]*/', '', $paramStr);
    $paramStr = ltrim($paramStr, '&');
    return $queryStr ? $queryStr . '?' . $paramStr : $paramStr;
}
//End CCRemoveParam

//CCGetOrder @0-27B4AC18
function CCGetOrder($DefaultSorting, $SorterName, $SorterDirection, $MapArray)
{
  if(is_array($MapArray) && isset($MapArray[$SorterName]))
    if(strtoupper($SorterDirection) == "DESC")
      $OrderValue = ($MapArray[$SorterName][1] != "") ? $MapArray[$SorterName][1] : $MapArray[$SorterName][0] . " DESC";
    else
      $OrderValue = $MapArray[$SorterName][0];
  else
    $OrderValue = $DefaultSorting;

  return $OrderValue;
}
//End CCGetOrder

//CCGetDateArray @0-D83CC64E
function CCGetDateArray($timestamp = "")
{
  $DateArray = array(0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
  if(!strlen($timestamp) && !is_int($timestamp)) {
    $timestamp = time();
  }

  $DateArray[ccsTimestamp] = $timestamp;
  $DateArray[ccsYear] = date("Y", $timestamp);
  $DateArray[ccsMonth] = date("n", $timestamp);
  $DateArray[ccsDay] = date("j", $timestamp);
  $DateArray[ccsHour] = date("G", $timestamp);
  $DateArray[ccsMinute] = date("i", $timestamp);
  $DateArray[ccsSecond] = date("s", $timestamp);

  return $DateArray;
}
//End CCGetDateArray

//CCFormatDate @0-5FD7EA36
function CCFormatDate($DateToFormat, $FormatMask)
{

  global $CCSLocales;

  if(!is_array($DateToFormat) && strlen($DateToFormat))
    $DateToFormat = CCGetDateArray($DateToFormat);

  if(is_array($FormatMask) && is_array($DateToFormat))
  {
    $WeekdayNames = $CCSLocales->GetFormatInfo("WeekdayNames");
    $WeekdayShortNames = $CCSLocales->GetFormatInfo("WeekdayShortNames");
    $WeekdayNarrowNames = $CCSLocales->GetFormatInfo("WeekdayNarrowNames");
    $MonthNames = $CCSLocales->GetFormatInfo("MonthNames");
    $MonthShortNames = $CCSLocales->GetFormatInfo("MonthShortNames");

    $FormattedDate = "";
    for($i = 0; $i < sizeof($FormatMask); $i++)
    {
      switch ($FormatMask[$i])
      {
        case "GeneralDate": 
          $FormattedDate .= CCFormatDate($DateToFormat, $CCSLocales->GetFormatInfo("GeneralDate"));
          break;
        case "LongDate": 
          $FormattedDate .= CCFormatDate($DateToFormat, $CCSLocales->GetFormatInfo("LongDate"));
          break;
        case "ShortDate": 
          $FormattedDate .= CCFormatDate($DateToFormat, $CCSLocales->GetFormatInfo("ShortDate"));
          break;
        case "LongTime":
          $FormattedDate .= CCFormatDate($DateToFormat, $CCSLocales->GetFormatInfo("LongTime"));
          break;
        case "ShortTime":
          $FormattedDate .= CCFormatDate($DateToFormat, $CCSLocales->GetFormatInfo("ShortTime"));
          break;
        case "d":
          $FormattedDate .= $DateToFormat[ccsDay];
          break;
        case "dd":
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsDay]);
          break;
        case "ddd": 
          $FormattedDate .= $WeekdayShortNames[CCDayOfWeek($DateToFormat) - 1];
          break;
        case "dddd": 
          $FormattedDate .= $WeekdayNames[CCDayOfWeek($DateToFormat) - 1];
          break;
        case "wi": 
          $FormattedDate .= $WeekdayNarrowNames[CCDayOfWeek($DateToFormat) - 1];
          break;
        case "w": 
          $FormattedDate .= CCDayOfWeek($DateToFormat);
          break;
        case "ww": 
          $FormattedDate .= ceil((7 + date("z", $DateToFormat[ccsTimestamp]) - date("w", $DateToFormat[ccsTimestamp])) / 7);
          break;
        case "m":
          $FormattedDate .= $DateToFormat[ccsMonth];
          break;
        case "mm":
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsMonth]);
          break;
        case "mmm": 
          $FormattedDate .= $MonthShortNames[$DateToFormat[ccsMonth] - 1];
          break;
        case "mmmm":
          $FormattedDate .= $MonthNames[$DateToFormat[ccsMonth] - 1];
          break;
        case "q":
          $FormattedDate .= ceil($DateToFormat[ccsMonth] / 3);
          break;
        case "y":
          $FormattedDate .= CCDayOfYear($DateToFormat);
          break;
        case "yy": 
          $FormattedDate .= substr($DateToFormat[ccsYear], 2);
          break;
        case "yyyy": 
          $FormattedDate .= sprintf("%04d", $DateToFormat[ccsYear]);
          break;
        case "h":
          $FormattedDate .= ($DateToFormat[ccsHour] % 12 == 0 ) ? 12 : $DateToFormat[ccsHour] % 12;
          break;
        case "hh":
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsHour] % 12 == 0 ? 12 : $DateToFormat[ccsHour] % 12);
          break;
        case "H":
          $FormattedDate .= $DateToFormat[ccsHour];
          break;
        case "HH":
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsHour]);
          break;
        case "n": 
          $FormattedDate .= $DateToFormat[ccsMinute];
          break;
        case "nn": 
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsMinute]);
          break;
        case "s":
          $FormattedDate .= $DateToFormat[ccsSecond];
          break;
        case "ss":
          $FormattedDate .= sprintf("%02d", $DateToFormat[ccsSecond]);
          break;
        case "S": 
          $FormattedDate .= $DateToFormat[ccsMilliSecond] + 0;
          break;
        case "AM/PM":
        case "A/P":
          $FormattedDate .=  $DateToFormat[ccsHour] < 12 ? "AM" : "PM";
          break;
        case "am/pm":
        case "a/p":
          $FormattedDate .=  $DateToFormat[ccsHour] < 12 ? "am" : "pm";
          break;
        case "tt":
          $FormattedDate .=  $DateToFormat[ccsHour] < 12 ? $CCSLocales->GetFormatInfo("AMDesignator") : $CCSLocales->GetFormatInfo("PMDesignator");
          break;
        case "GMT":
          if (strlen($DateToFormat[ccsGMT])) 
            $GMT = intval($DateToFormat[ccsGMT]); 
          else
            $GMT = intval(date("Z", $DateToFormat[ccsTimestamp]) / (60 * 60));
          $GMT = sprintf("%02d", $GMT);
          $GMT = $GMT > 0 ? "+" . $GMT : $GMT;
          $FormattedDate .= $GMT;
          break;
        default:
          $FormattedDate .= $FormatMask[$i];
          break;
      }
    }
  }
  else
  {
    $FormattedDate = "";
  }
  return $FormattedDate;
}
//End CCFormatDate

//CCValidateDate @0-1DFF5582
function CCValidateDate($ValidatingDate)
{
  $IsValid = true;
  if(is_array($ValidatingDate)) 
    if (count($ValidatingDate) != 14)
      $IsValid = false;
    elseif ($ValidatingDate[ccsMonth] != 0 && 
      $ValidatingDate[ccsDay] != 0 && 
      $ValidatingDate[ccsYear] != 0) 
      $IsValid = checkdate($ValidatingDate[ccsMonth], $ValidatingDate[ccsDay], $ValidatingDate[ccsYear]);

  return $IsValid;
}
//End CCValidateDate

//CCValidateDateMask @0-6A1F5673
function CCValidateDateMask($ValidatingDate, $FormatMask)
{
  $IsValid = true;
  if(is_array($FormatMask) && strlen($ValidatingDate))
  {
    $RegExp = CCGetDateRegExp($FormatMask);
    $IsValid = preg_match($RegExp[0], $ValidatingDate, $matches);
  }

  return $IsValid;
}
//End CCValidateDateMask

//CCParseDate @0-5F189BA0
function CCParseDate($ParsingDate, $FormatMask)
{
  global $CCSLocales;
  if(is_array($FormatMask) && strlen($ParsingDate))
  {
    $DateArray = array(0, "1", "", "1", "", "", "", "", "", "", "", "", "", "");
    $RegExp = CCGetDateRegExp($FormatMask);
    $IsValid = preg_match($RegExp[0], $ParsingDate, $matches);
    for($i = 1; $i < sizeof($matches); $i++)
      $DateArray[$RegExp[$i]] = $matches[$i];

    if(!$DateArray[ccsMonth] && ($DateArray[ccsFullMonth] || $DateArray[ccsShortMonth]))
    {
      if($DateArray[ccsFullMonth])
        $DateArray[ccsMonth] = CCGetIndex($CCSLocales->GetFormatInfo("MonthNames"), $DateArray[ccsFullMonth], true) + 1;
      else if($DateArray[ccsShortMonth])
        $DateArray[ccsMonth] = CCGetIndex($CCSLocales->GetFormatInfo("MonthShortNames"), $DateArray[ccsShortMonth], true) + 1;
    } else {
      $DateArray[ccsMonth] = intval($DateArray[ccsMonth]);
    }

    if (!$DateArray[ccsMonth])
      $DateArray[ccsMonth] = 1;

    if(intval($DateArray[ccsDay]) == 0) { 
      $DateArray[ccsDay] = 1; 
    } else {
      $DateArray[ccsDay] = intval($DateArray[ccsDay]); 
    }

    if ($DateArray[ccsAmPm])
      if (strtoupper(substr($DateArray[ccsAmPm], 0, 1)) == "A" || $DateArray[ccsAmPm] == $CCSLocales->GetFormatInfo("AMDesignator"))
        $DateArray[ccsHour] = $DateArray[ccsHour] == 12 ? 0 : $DateArray[ccsHour];
      elseif ($DateArray[ccsHour] < 12)
        $DateArray[ccsHour] += 12;

    if(strlen($DateArray[ccsYear]) == 2)
      if($DateArray[ccsYear] < 70)
        $DateArray[ccsYear] = "20" . $DateArray[ccsYear];
      else
        $DateArray[ccsYear] = "19" . $DateArray[ccsYear];
      
    if($DateArray[ccsYear] < 1971 && $DateArray[ccsYear] > 0)
      $DateArray[ccsAppropriateYear] = $DateArray[ccsYear] + intval((2000 - $DateArray[ccsYear]) / 28) * 28;
    else if($DateArray[ccsYear] > 2030)
      $DateArray[ccsAppropriateYear] = $DateArray[ccsYear] - intval(($DateArray[ccsYear] - 2000) / 28) * 28;
    else      
      $DateArray[ccsAppropriateYear] = $DateArray[ccsYear];

    $DateArray[ccsHour] = intval($DateArray[ccsHour]);
    $DateArray[ccsMinute] = intval($DateArray[ccsMinute]);
    $DateArray[ccsSecond] = intval($DateArray[ccsSecond]);

    $DateArray[ccsTimestamp] = @mktime ($DateArray[ccsHour], $DateArray[ccsMinute], $DateArray[ccsSecond], $DateArray[ccsMonth], $DateArray[ccsDay], $DateArray[ccsAppropriateYear]);
    if(!CCValidateDate($DateArray)) $ParsingDate = "";
    else $ParsingDate = $DateArray;
    
  }

  return $ParsingDate;
}
//End CCParseDate

//CCGetDateRegExp @0-F17A33B6
function CCGetDateRegExp($FormatMask)
{
  global $CCSLocales;
  $RegExp = false;
  if(is_array($FormatMask))
  {
    $masks = array(
      "d" => array("(\d{1,2})", ccsDay), 
      "dd" => array("(\d{2})", ccsDay), 
      "ddd" => array("(" . join("|", $CCSLocales->GetFormatInfo("WeekdayShortNames")) . ")", ccsWeek), 
      "dddd" => array("(" . join("|", $CCSLocales->GetFormatInfo("WeekdayNames")) . ")", ccsWeek), 
      "w" => array("\d"), "ww" => array("\d{1,2}"),
      "m" => array("(\d{1,2})", ccsMonth), "mm" => array("(\d{2})", ccsMonth), 
      "mmm" => array("(" . join("|", $CCSLocales->GetFormatInfo("MonthShortNames")) . ")", ccsShortMonth), 
      "mmmm" => array("(" . join("|", $CCSLocales->GetFormatInfo("MonthNames")) . ")", ccsFullMonth),
      "y" => array("\d{1,3}"), "yy" => array("(\d{2})", ccsYear), 
      "yyyy" => array("(\d{4})", ccsYear), "q" => array("\d"),
      "h" => array("(\d{1,2})", ccsHour), "hh" => array("(\d{2})", ccsHour), 
      "H" => array("(\d{1,2})", ccsHour), "HH" => array("(\d{2})", ccsHour),
      "n" => array("(\d{1,2})", ccsMinute), "nn" => array("(\d{2})", ccsMinute), 
      "s" => array("(\d{1,2})", ccsSecond), "ss" => array("(\d{2})", ccsSecond), 
      "AM/PM" => array("(AM|PM)", ccsAmPm), "am/pm" => array("(am|pm)", ccsAmPm), 
      "A/P" => array("(A|P)", ccsAmPm), "a/p" => array("(a|p)", ccsAmPm),
      "a/p" => array("(a|p)", ccsAmPm),
      "tt" => array("(" . $CCSLocales->GetFormatInfo("AMDesignator") . "|" . $CCSLocales->GetFormatInfo("PMDesignator") . ")", ccsAmPm), 
      "GMT" => array("([\+\-]\d{1,2})", ccsGMT), 
      "S" => array("(\d{1,6})", ccsMilliSecond)
    );
    $RegExp[0] = "";
    $RegExpIndex = 1;
    $is_date = false; $is_datetime = false;
    for($i = 0; $i < sizeof($FormatMask); $i++)
    {
      if ($FormatMask[$i] == "GeneralDate") 
      {
        $reg = CCGetDateRegExp($CCSLocales->GetFormatInfo("GeneralDate"));
        $RegExp[0] .= substr($reg[0], 2, strlen($reg[0]) - 5);
        $is_datetime = true;
        for ($j=1; $j < sizeof($reg); $j++) {
          $RegExp[$RegExpIndex++] = $reg[$j];
        }
      }
      else if ($FormatMask[$i] == "LongDate" || $FormatMask[$i] == "ShortDate") 
      {
        $reg = CCGetDateRegExp($CCSLocales->GetFormatInfo($FormatMask[$i]));
        $RegExp[0] .= substr($reg[0], 2, strlen($reg[0]) - 5);
        $is_date = true;
        for ($j=1; $j < sizeof($reg); $j++) {
          $RegExp[$RegExpIndex++] = $reg[$j];
        }
      }
      else if ($FormatMask[$i] == "LongTime" || $FormatMask[$i] == "ShortTime") 
      {
        $reg = CCGetDateRegExp($CCSLocales->GetFormatInfo($FormatMask[$i]));
        $RegExp[0] .= substr($reg[0], 2, strlen($reg[0]) - 5);
        for ($j=1; $j < sizeof($reg); $j++) {
          $RegExp[$RegExpIndex++] = $reg[$j];
        }
      }
      else if(isset($masks[$FormatMask[$i]]))
      {
        $MaskArray = $masks[$FormatMask[$i]];
        if($i == 0 && ($MaskArray[1] == ccsYear || $MaskArray[1] == ccsMonth 
          || $MaskArray[1] == ccsFullMonth || $MaskArray[1] == ccsWeek || $MaskArray[1] == ccsDay))
          $is_date = true;
        else if($is_date && !$is_datetime && $MaskArray[1] == ccsHour)
          $is_datetime = true;
        $RegExp[0] .= $MaskArray[0];
        if($is_datetime) $RegExp[0] .= "?";
        for($j = 1; $j < sizeof($MaskArray); $j++)
          $RegExp[$RegExpIndex++] = $MaskArray[$j];
      }
      else
      {
        if($is_date && !$is_datetime && $i < sizeof($FormatMask) && $masks[$FormatMask[$i + 1]][1] == ccsHour)
          $is_datetime = true;
        $RegExp[0] .= CCAddEscape($FormatMask[$i]);
        if($is_datetime) $RegExp[0] .= "?";
      }
    }
    $RegExp[0] = str_replace(" ", "\s*", $RegExp[0]);
    $RegExp[0] = "/^" . $RegExp[0] . "$/i";
  }

  return $RegExp;
}
//End CCGetDateRegExp

//CCAddEscape @0-06D50C27
function CCAddEscape($FormatMask)
{
  $meta_characters = array("\\", "^", "\$", ".", "[", "|", "(", ")", "?", "*", "+", "{", "-", "]", "/");
  for($i = 0; $i < sizeof($meta_characters); $i++)
    $FormatMask = str_replace($meta_characters[$i], "\\" . $meta_characters[$i], $FormatMask);
  return $FormatMask;
}
//End CCAddEscape

//CCGetIndex @0-8DB8E12C
function CCGetIndex($ArrayValues, $Value, $IgnoreCase = true)
{
  $index = false;
  for($i = 0; $i < sizeof($ArrayValues); $i++)
  {
    if(($IgnoreCase && strtoupper($ArrayValues[$i]) == strtoupper($Value)) || ($ArrayValues[$i] == $Value))
    {
      $index = $i;
      break;
    }
  }
  return $index;
}
//End CCGetIndex

//CCFormatNumber @0-ECA37772
function CCFormatNumber($NumberToFormat, $FormatArray, $DataType = ccsFloat, $isDBFormat = false)
{
  global $CCSLocales;
  global $CCSIsXHTML;
  $Result = "";
  if(is_array($FormatArray) && strlen($NumberToFormat))
  {
    $IsExtendedFormat = $FormatArray[0];
    $IsNegative = ($NumberToFormat < 0);
    $NumberToFormat = abs($NumberToFormat);
    $NumberToFormat *= $FormatArray[7];
  
    if($IsExtendedFormat) // Extended format
    {
      $DecimalSeparator        = !is_null($FormatArray[2]) ? $FormatArray[2] : ".";
      $PeriodSeparator         = !is_null($FormatArray[3]) ? $FormatArray[3] : ",";

      $ObligatoryBeforeDecimal = 0;
      $DigitsBeforeDecimal = 0;
      $BeforeDecimal = $FormatArray[5];
      $AfterDecimal = !is_null($FormatArray[6]) ? $FormatArray[6] : ($DataType != ccsInteger ? 100 : 0);
      if(is_array($BeforeDecimal)) {
        for($i = 0; $i < sizeof($BeforeDecimal); $i++) {
          if($BeforeDecimal[$i] == "0") {
            $ObligatoryBeforeDecimal++;
            $DigitsBeforeDecimal++;
          } else if($BeforeDecimal[$i] == "#") 
            $DigitsBeforeDecimal++;
        }
      }
      $ObligatoryAfterDecimal = 0;
      $DigitsAfterDecimal = 0;
      if(is_array($AfterDecimal)) {
        for($i = 0; $i < sizeof($AfterDecimal); $i++) {
          if($AfterDecimal[$i] == "0") {
            $ObligatoryAfterDecimal++;
            $DigitsAfterDecimal++;
          } else if($AfterDecimal[$i] == "#")
            $DigitsAfterDecimal++;
        }
      }
  
      $NumberToFormat = number_format($NumberToFormat, $DigitsAfterDecimal, ".", "");
      $NumberParts = explode(".", $NumberToFormat);

      $LeftPart = $NumberParts[0];
      if($LeftPart == "0") $LeftPart = "";
      $RightPart = isset($NumberParts[1]) ? $NumberParts[1] : "";
      $j = strlen($LeftPart);
    
      if(is_array($BeforeDecimal))
      {
        $RankNumber = 0;
        $i = sizeof($BeforeDecimal);
        while ($i > 0 || $j > 0)
        {
          if(($i > 0 && ($BeforeDecimal[$i - 1] == "#" || $BeforeDecimal[$i - 1] == "0")) || ($j > 0 && $i < 1)) {
            $RankNumber++;
            $CurrentSeparator = ($RankNumber % 3 == 1 && $RankNumber > 3 && $j > 0) ? $PeriodSeparator : "";
            if($ObligatoryBeforeDecimal > 0 && $j < 1)
              $Result = "0" . $CurrentSeparator . $Result;
            else if($j > 0)
              $Result = $LeftPart[$j - 1] . $CurrentSeparator . $Result;
            $j--;
            $ObligatoryBeforeDecimal--;
            $DigitsBeforeDecimal--;
            if($DigitsBeforeDecimal == 0 && $j > 0)
              for(;$j > 0; $j--)
              {
                $RankNumber++;
                $CurrentSeparator = ($RankNumber % 3 == 1 && $RankNumber > 3 && $j > 0) ? $PeriodSeparator : "";
                $Result = $LeftPart[$j - 1] . $CurrentSeparator . $Result;
              }
          }
          else if ($i > 0) {
            $BeforeDecimal[$i - 1] = str_replace("##", "#", $BeforeDecimal[$i - 1]);
            $BeforeDecimal[$i - 1] = str_replace("00", "0", $BeforeDecimal[$i - 1]);
            $Result = $BeforeDecimal[$i - 1] . $Result;
          }
          $i--;
        }
      }

      // Left part after decimal
      $RightResult = "";
      $IsRightNumber = false;
      if(is_array($AfterDecimal))
      {
        $IsZero = true;
        for($i = sizeof($AfterDecimal); $i > 0; $i--) {
          if($AfterDecimal[$i - 1] == "#" || $AfterDecimal[$i - 1] == "0") {
            if($DigitsAfterDecimal > $ObligatoryAfterDecimal) {
              if($RightPart[$DigitsAfterDecimal - 1] != "0") 
                $IsZero = false;
              if(!$IsZero)
              {
                $RightResult = $RightPart[$DigitsAfterDecimal - 1] . $RightResult;
                $IsRightNumber = true;
              }
            } else {
              $RightResult = $RightPart[$DigitsAfterDecimal - 1] . $RightResult;
              $IsRightNumber = true;
            }
            $DigitsAfterDecimal--;
          } else {
            $AfterDecimal[$i - 1] = str_replace("##", "#", $AfterDecimal[$i - 1]);
            $AfterDecimal[$i - 1] = str_replace("00", "0", $AfterDecimal[$i - 1]);
            $RightResult = $AfterDecimal[$i - 1] . $RightResult;
          }
        }
      }
    
      if($IsRightNumber)
        $Result .= $DecimalSeparator ;

      $Result .= $RightResult;

      if(!$FormatArray[4] && $IsNegative && $Result)
        $Result = "-" . $Result;
    }
    else // Simple format
    {
      $DecimalSeparator = !is_null($FormatArray[2]) ? $FormatArray[2] : ".";
      $PeriodSeparator = !is_null($FormatArray[3]) ? $FormatArray[3] : ",";
      $AfterDecimal = !is_null($FormatArray[1]) ? $FormatArray[1] : ($DataType != ccsInteger ? 100 : 0);

      $Result = number_format($NumberToFormat, $AfterDecimal, '.', ',');
      $Result = str_replace(".", '---', $Result);
      $Result = str_replace(",", '+++', $Result);
      $Result = str_replace("---", $DecimalSeparator, $Result);
      $Result = str_replace("+++", $PeriodSeparator, $Result);
      $Result = $FormatArray[5] . $Result . $FormatArray[6];
      if(!$FormatArray[4] && $IsNegative)
        $Result = "-" . $Result;
     
    }

    if(!$FormatArray[8])
      $Result = CCToHTML($Result);

  }
  else
    $Result = $NumberToFormat;

  if(is_array($FormatArray) && strlen($FormatArray[9])) {
    if($CCSIsXHTML) {
      $Result = "<span style=\"color: " . $FormatArray[9] . "\">" . $Result . "</span>";
    } else {
    $Result = "<FONT COLOR=\"" . $FormatArray[9] . "\">" . $Result . "</FONT>";
    }
  }

  return $Result;
}
//End CCFormatNumber

//CCValidateNumber @0-C3F4C267
function CCValidateNumber($NumberValue, $FormatArray, $isDBFormat = false)
{
  $is_valid = true;
  if(strlen($NumberValue))
  {
    $NumberValue = CCCleanNumber($NumberValue, $FormatArray, $isDBFormat);
    $is_valid = is_numeric($NumberValue);
  }
  return $is_valid;
}

//End CCValidateNumber

//CCParseNumber @0-3F28B3F3
function CCParseNumber($NumberValue, $FormatArray, $DataType, $isDBFormat = false)
{
  $NumberValue = CCCleanNumber($NumberValue, $FormatArray, $isDBFormat);
  if(is_array($FormatArray) && strlen($NumberValue))
  {

    if($FormatArray[4]) // Contains parenthesis
      $NumberValue = - abs(doubleval($NumberValue));

    $NumberValue /= $FormatArray[7];
  }

  if(strlen($NumberValue))
  {
    if($DataType == ccsFloat)
      $NumberValue = doubleval($NumberValue);
    else
      $NumberValue = round($NumberValue, 0);
  }

  return $NumberValue;
}
//End CCParseNumber

//CCCleanNumber @0-AFA6FB0D
function CCCleanNumber($NumberValue, $FormatArray, $isDBFormat = false)
{
  if(is_array($FormatArray))
  {
    $IsExtendedFormat = $FormatArray[0];

    if($IsExtendedFormat) // Extended format
    {
      $BeforeDecimal = $FormatArray[5];
      $AfterDecimal = $FormatArray[6];
    
      if(is_array($BeforeDecimal))
      {
        for($i = sizeof($BeforeDecimal); $i > 0; $i--) {
          if($BeforeDecimal[$i - 1] != "#" && $BeforeDecimal[$i - 1] != "0") 
          {
            $search = $BeforeDecimal[$i - 1];
            $search = ($search == "##" || $search == "00") ? $search[0] : $search;
            $NumberValue = str_replace($search, "", $NumberValue);
          }
        }
      }

      if(is_array($AfterDecimal))
      {
        for($i = sizeof($AfterDecimal); $i > 0; $i--) {
          if($AfterDecimal[$i - 1] != "#" && $AfterDecimal[$i - 1] != "0") 
          {
            $search = $AfterDecimal[$i - 1];
            $search = ($search == "##" || $search == "00") ? $search[0] : $search;
            $NumberValue = str_replace($search, "", $NumberValue);
          }
        }
      }
    }
    else // Simple format
    {
      if(strlen($FormatArray[5]))
        $NumberValue = str_replace($FormatArray[5], "", $NumberValue);
      if(strlen($FormatArray[6]))
        $NumberValue = str_replace($FormatArray[6], "", $NumberValue);
    }
    $DecimalSeparator = !is_null($FormatArray[2]) ? $FormatArray[2] : ".";
    $PeriodSeparator = !is_null($FormatArray[3]) ? $FormatArray[3] : ",";

    $NumberValue = str_replace($PeriodSeparator, "", $NumberValue); // Period separator
    $NumberValue = str_replace($DecimalSeparator, ".", $NumberValue); // Decimal separator

    if(strlen($FormatArray[9]))
    {
      if($CCSIsXHTML) {
        $NumberValue = str_replace("<span style=\"color: " . $FormatArray[9] . "\">", "", $NumberValue);
        $NumberValue = str_replace("</span>", "", $NumberValue);
      } else {
      $NumberValue = str_replace("<FONT COLOR=\"" . $FormatArray[9] . "\">", "", $NumberValue);
      $NumberValue = str_replace("</FONT>", "", $NumberValue);
    }
    }
    return $NumberValue;
  }
  $NumberValue = str_replace(",", ".", $NumberValue);
  $NumberValue = preg_replace("/^(-?)(\\.\\d+)$/", "\${1}0\${2}", $NumberValue);

  return $NumberValue;
}
//End CCCleanNumber

//CCParseInteger @0-08035527
function CCParseInteger($NumberValue, $FormatArray, $isDBFormat = false)
{
  return CCParseNumber($NumberValue, $FormatArray, ccsInteger, $isDBFormat);
}
//End CCParseInteger

//CCParseFloat @0-89DDFF62
function CCParseFloat($NumberValue, $FormatArray, $isDBFormat = false)
{
  return CCParseNumber($NumberValue, $FormatArray, ccsFloat, $isDBFormat);
}
//End CCParseFloat

//CCValidateBoolean @0-DFB0ECFA
function CCValidateBoolean($BooleanValue, $Format)
{
  return $BooleanValue == ""
     || strtolower($BooleanValue) == "true"
     || strtolower($BooleanValue) == "false"
     || strval($BooleanValue) == "0"
     || strval($BooleanValue) == "1"
     || (is_array($Format) 
        && (strtolower($BooleanValue) == strtolower($Format[0])
            || strtolower($BooleanValue) == strtolower($Format[1])
            || strtolower($BooleanValue) == strtolower($Format[2]))); 
}
//End CCValidateBoolean

//CCFormatBoolean @0-5B3F5CF9
function CCFormatBoolean($BooleanValue, $Format)
{
  $Result = $BooleanValue;

  if(is_array($Format)) {
    if($BooleanValue == 1)
      $Result = $Format[0];
    else if(strval($BooleanValue) == "0" || $BooleanValue === false)
      $Result = $Format[1];
    else
      $Result = $Format[2];
  }

  return $Result;
}
//End CCFormatBoolean

//CCParseBoolean @0-1DA49599
function CCParseBoolean($Value, $Format)
{
  if (is_array($Format)) {
    if (strtolower(strval($Value)) == strtolower(strval($Format[0])))
      return true;
    if (strtolower(strval($Value)) == strtolower(strval($Format[1])))
      return false;
    if (strtolower(strval($Value)) == strtolower(strval($Format[2])))
      return "";
  }
  if (strval($Value) == "0" || strtolower(strval($Value)) == "false")
    return false;
  if (strval($Value) == "1" || strtolower(strval($Value)) == "true")
    return true;
  return "";
}
//End CCParseBoolean

//CCGetBooleanFormat @0-B9D3DA0C
function CCGetBooleanFormat($Format)
{
  $FormatString = "";
  if(is_array($Format))
  {
    for($i = 0; $i < sizeof($Format); $i++) {
      if(strlen($Format[$i])) {
        if(strlen($FormatString)) $FormatString .= ";";
        $FormatString .= $Format[$i];
      }
    }
  }
  return $FormatString;
}
//End CCGetBooleanFormat

//CCCompareValues @0-8D9B429E
function CCCompareValues($Value1,$Value2,$DataType = ccsText, $Format = "")
{
  switch ($DataType) {
    case ccsInteger:
    case ccsFloat:
      if(strcmp(trim($Value1),"") == 0 || strcmp(trim($Value2),"") == 0)
        return strcmp($Value1, $Value2);
      else if($Value1 > $Value2)
        return 1;
      else if($Value1 < $Value2)
        return -1;
      else
        return 0;
  
    case ccsText:
    case ccsMemo:
      return strcmp($Value1,$Value2);

    case ccsBoolean:
      if (is_bool($Value1))
        $val1=$Value1;
      else if (strlen($Value1)!= 0 && CCValidateBoolean($Value1,$Format))
        $val1=CCParseBoolean($Value1,$Format);
      else 
        return 1;

      if (is_bool($Value2))
        $val2=$Value2;
      else if (strlen($Value2)!= 0 && CCValidateBoolean($Value2,$Format))
        $val2=CCParseBoolean($Value2,$Format);
      else 
        return 1;

      return $val1 xor $val2;
  
    case ccsDate:
      if (is_array($Value1) && is_array($Value2)) {
        $compare = array(ccsYear, ccsMonth, ccsDay, ccsHour, ccsMinute, ccsSecond);
        foreach ($compare as $ind => $val) {
          if ($Value1[$val] < $Value2[$val])
            return -1;
          elseif ($Value1[$val] > $Value2[$val])          
            return 1;
        }
        return 0;
      } else if(is_array($Value1)) {
        $FormattedValue = CCFormatValue($Value1, $Format, $DataType);
        return CCCompareValues($FormattedValue, $Value2);
      } else if(is_array($Value2)) {
        $FormattedValue = CCFormatValue($Value2, $Format, $DataType);
        return CCCompareValues($Value1,$FormattedValue);
      } else {
        return CCCompareValues($Value1,$Value2);
      }
    
  }
}
//End CCCompareValues

//CCDateAdd @0-FD3E5738
function CCDateAdd($date, $value) {
  if (CCValidateDate($date)) {
    $FormatArray = array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss");
    $value = strtolower($value);
    preg_match_all("/([-+]?)(\\d+)\\s*(year(s?)|month(s?)|day(s?)|hour(s?)|minute(s?)|second(s?)|week(s?)|[ymdwhns])/", $value, $pieces);
    for($i=0; $i<count($pieces[0]); $i++) {
      $rel = $pieces[1][$i] == "-" ? -$pieces[2][$i] : $pieces[2][$i];
      $BackMonth = false;
      switch($pieces[3][$i]) {
        case "years":
        case "year":
        case "y": 
          $date[ccsYear] += $rel;
          $BackMonth = true;
          break;
        case "months":
        case "month":
        case "m":
          $date[ccsMonth] += $rel;
          $BackMonth = true;
          break;
        case "weeks":
        case "week":
        case "w":
          $date[ccsDay] += $rel * 7;
          break;
        case "days":
        case "day":
        case "d":
          $date[ccsDay] += $rel;
          break;
        case "hours":
        case "hour":
        case "h":
          $date[ccsHour] += $rel;
          break;
        case "minutes":
        case "minute":
        case "min":
        case "n":
          $date[ccsMinute] += $rel;
          break;
        case "seconds":
        case "second":
        case "sec":
        case "s":
          $date[ccsSecond] += $rel;
          break;
      }
      if ($date[ccsSecond] >= 60) {
        $date[ccsMinute] += floor($date[ccsSecond] / 60);
        $date[ccsSecond] = $date[ccsSecond] % 60;
      } elseif ($date[ccsSecond] < 0) {
        $date[ccsMinute] += floor($date[ccsSecond] / 60);
        $date[ccsSecond] = (($date[ccsSecond]) % 60 + 60) % 60;
      }
      if ($date[ccsMinute] >= 60) {
        $date[ccsHour] += floor($date[ccsMinute] / 60);
        $date[ccsMinute] = $date[ccsMinute] % 60;
      } elseif ($date[ccsMinute] < 0) {
        $date[ccsHour] += floor($date[ccsMinute] / 60);
        $date[ccsMinute] = ($date[ccsMinute] % 60 + 60) % 60;
      }
      if ($date[ccsHour] >= 24) {
        $date[ccsDay] += floor($date[ccsHour] / 24);
        $date[ccsHour] = $date[ccsHour] % 24;
      } elseif ($date[ccsHour] < 0) {
        $date[ccsDay] += floor($date[ccsHour] / 24);
        $date[ccsHour] = ($date[ccsHour] % 24 + 24) % 24;
      }
      if ($date[ccsMonth] > 12) {
        $date[ccsYear] += floor(($date[ccsMonth] - 1) / 12);
        $date[ccsMonth] = ($date[ccsMonth] - 1) % 12 + 1;
      } elseif ($date[ccsMonth] < 1) {
        $date[ccsYear] += floor(($date[ccsMonth] - 1) / 12);
        $date[ccsMonth] = (($date[ccsMonth] - 1) % 12 + 12) % 12 + 1;
      }
      $days = CCDaysInMonth($date[ccsYear], $date[ccsMonth]);
      if($BackMonth && $date[ccsDay] > $days) {
  $date[ccsDay] = $days;
      } else {
        while ($date[ccsDay] > $days) {
          $date[ccsMonth] += 1;
          if ($date[ccsMonth] > 12) {
            $date[ccsYear] += 1;
            $date[ccsMonth] = 1;
          }
          $date[ccsDay] = $date[ccsDay] - $days;
          $days = CCDaysInMonth($date[ccsYear], $date[ccsMonth]);
        }
      }
      if($BackMonth && $date[ccsDay] < 1) {
        $date[ccsDay] = 1;
      } else {
        $tmpDate = "";
        while ($date[ccsDay] < 1) {
          if ($tmpDate == "")
            $tmpDate = CCParseDate(CCFormatDate($date, array("yyyy","-","mm","-01")), array("yyyy","-","mm","-","dd"));
          $tmpDate = CCDateAdd($tmpDate, "-1month");
          $days = CCDaysInMonth($tmpDate[ccsYear], $tmpDate[ccsMonth]);
          $date[ccsMonth] -= 1;
          if ($date[ccsMonth] == 0) {
            $date[ccsYear] -= 1;
            $date[ccsMonth] = 12;
          }
          $date[ccsDay] = $date[ccsDay] + $days;
        }
      }
    }
    $date[ccsTimestamp] = @mktime ($date[ccsHour], $date[ccsMinute], $date[ccsSecond], $date[ccsMonth], $date[ccsDay], $date[ccsYear]);
    return $date;
  }
  return false;
}
//End CCDateAdd

//CCDaysInMonth @0-4DFC9A98
function CCDaysInMonth($year, $month) {
  switch ($month) {
    case 4:
    case 6:
    case 9:
    case 11:
      return 30;
    case 2:
       if ($year % 4)
         return 28;
       elseif ($year % 100)
         return 29;
       elseif ($year % 400)
         return 28;
       else return 29;
    default:
      return 31;
  }

}
//End CCDaysInMonth

//CCDayOfWeek @0-479679B3
function CCDayOfWeek($date) {
  //return 1 - Sun, 2 - Mon, 3 - Tue ...
  $year = $date[ccsYear];
  $month = $date[ccsMonth];
  $day = $date[ccsDay];
  $century = $year - ( $year % 100 );
  $base = array( 3, 2, 0, 5 );
  $base = $base[(($century - 1500) / 100 + 16) % 4];
  $twelves = intval(($year - $century )/12);
  $rem = ($year - $century) % 12;
  $fours = intval($rem / 4);
  $doomsday = $base + ($twelves + $rem + $fours) % 7;
  $doomsday = $doomsday % 7;

  $base = array( 0, 0, 7, 4, 9, 6, 11, 8, 5, 10, 7, 12 );
  if (CCDaysInMonth($year, 2) == 29) {
    $base[0] = 32;
    $base[1] = 29;
  } else {
    $base[0] = 31;
    $base[1] = 28;
  }
  $on = $day - $base[$month - 1];
  $on = $on % 7;
  return ($doomsday + $on + 7) % 7 + 1;
}
//End CCDayOfWeek

//CCDayOfYear @0-D35E28C6
function CCDayOfYear($date) {
  $days = 0;
  for ($month = 1; $month < $date[ccsMonth]; $month++)
    $days += CCDaysInMonth($date[ccsYear], $month);
  return $days + $date[ccsDay];
}
//End CCDayOfYear

//CCConvertEncoding @0-5177A761
function CCConvertEncoding($text, $from, $to)
{
    return $text;
}
//End CCConvertEncoding

//CCConvertEncodingArray @0-1A109043
function CCConvertEncodingArray($array, $from="", $to="")
{
    if (strlen($from) && strlen($to) && strcasecmp($from, $to)) {
        foreach ($array as $key => $value)
            $array[$key] = is_array($value) ? CCConvertEncodingArray($value, $from, $to) : CCConvertEncoding($value, $from, $to);
    }
    return $array;
}
//End CCConvertEncodingArray

//CCConvertDataArrays @0-67F649CD
function CCConvertDataArrays($from="", $to="")
{
    global $FileEncoding;
    global $TemplateEncoding;
    if ($from == "")
        $from = $TemplateEncoding;
    if ($to == "")
        $to = $FileEncoding;
    if (strlen($from) && strlen($to) && strcmp($from, $to)) {
        $_POST = CCConvertEncodingArray($_POST, $from, $to);
        $_GET = CCConvertEncodingArray($_GET, $from, $to);
    }
}
//End CCConvertDataArrays

//CCGetOriginalFileName @0-16048768
function CCGetOriginalFileName($value)
{
    return preg_match("/^\d{14,}\./", $value) ? substr($value, strpos($value, ".") + 1) : $value;
}
//End CCGetOriginalFileName

//ComposeStrings @0-84AD8866
function ComposeStrings($str1, $str2, $delimiter = null)
{
    global $CCSIsXHTML;
    if(is_null($delimiter)) {
        $delimiter = $CCSIsXHTML ? "<br />" : "<br>";
    }
    return $str1 . (strlen($str1) && strlen($str2) ? $delimiter : "") . $str2;
}
//End ComposeStrings

//CCSelectProjectStyle @0-F430A08A
function CCSelectProjectStyle() {
    global $CCProjectStyle;
    $QueryStyle = CCGetFromGet("style");
    if ($QueryStyle) {
        CCSetProjectStyle($QueryStyle);
        CCSetSession("style", $CCProjectStyle);
        return;;
      
    }
    if (CCSetProjectStyle(CCGetSession("style")))
        return;
}
//End CCSelectProjectStyle

//CCSetProjectStyle @0-E7A8832F
function CCSetProjectStyle($NewStyle) {
    global $CCProjectStyle;
    $NewStyle = trim($NewStyle);
    if ($NewStyle && file_exists(RelativePath . "/Styles/" . $NewStyle . "/Style.css")) {
        $CCProjectStyle = $NewStyle;
        return true;
    }
    return false;
}
//End CCSetProjectStyle

//CCStrLen @0-3660E806
function CCStrLen($str, $encoding = false) {
    return strlen($str);
}
//End CCStrLen

//CCSubStr @0-552E6589
function CCSubStr($str, $offset, $length = null, $encoding = false) {
    return is_null($length) ? substr($str, $offset) : substr($str, $offset, $length);
}
//End CCSubStr

//CCStrPos @0-BA504839
function CCStrPos($haystack, $needle, $offset = "", $encoding = false) {
    return strpos($haystack, $needle, $offset);
}
//End CCStrPos

//CCCheckSSL @0-A8E1366D
function CCCheckSSL()
{
    $HTTPS = isset($_SERVER["HTTPS"]) ? strtolower($_SERVER["HTTPS"]) : "";
    if($HTTPS != "on")
    {
        echo "SSL connection error. This page can be accessed only via secured connection.";
        exit;
    }
}
//End CCCheckSSL

//GenerateCaptchaCode @0-BCA1E0E9
function GenerateCaptchaCode($letters, $sesVariableName, $width, $height, $length, $rot, $br, $w1, $w2, $noise) {
    $restricted = "|cp|cb|ck|c6|c9|rn|rm|mm|co|do|cl|db|qp|qb|dp|";
    $res = new clsQuadraticPaths();
    $t = ""; $code = ""; $r = "";
    for ($i = 0; $i < $length; $i++) {
        $r = intval((count($letters)) * (mt_rand(0, 99)/100));
        while (strpos("|" . substr($code, -strlen($code), 1) . $letters[$r][0] . "|", $restricted) !== false) {
            $r = intval((count($letters)) * (mt_rand(0, 99)/100));
        }
        $code = $code . $letters[$r][0];
        $t = new clsQuadraticPaths();
        $t->LoadFromArray($letters[$r]);
        $t->Wave(2 * $w2 * (mt_rand(0, 99)/100) - $w2);
        $t->Rotate(2 * $rot * (mt_rand(0, 99)/100) - $rot);
        $t->Normalize(0, 100);
        if (($t->MaxX - $t->MinX) > 100) {
            $t->Normalize(100, 100);
        }
        $t->Addition(($i - 1) * $t->MaxY, 0);
        $res->AddPaths($t);
    }
    $res->Rotate(90);
    $res->Wave(2 * $w1 * (mt_rand(0, 99)/100) - $w1);
    $res->Rotate(-90);
    $res->Broke($br, $br);
    $res->Normalize($width - 12, $height - 12);
    $res->Addition(6, 6);
    $res->Mix();
    $res->Noises($noise);
    CCSetSession($sesVariableName, $code);
    return $res->ToString();
}
//End GenerateCaptchaCode

//file_get_contents @0-4991CB3D
if (!function_exists('file_get_contents')) {
    function file_get_contents($filename, $incpath = false, $resource_context = null)
    {
        if (false === $fh = fopen($filename, 'rb', $incpath)) {
            trigger_error('file_get_contents() failed to open stream: No such file or directory', E_USER_WARNING);
            return false;
        }
        clearstatcache();
        if ($fsize = @filesize($filename)) {
            $data = fread($fh, $fsize);
        } else {
            $data = '';
            while (!feof($fh)) {
                $data .= fread($fh, 8192);
            }
        }
        fclose($fh);
        return $data;
    }
}
//End file_get_contents

//CCSecurityRedirect @0-96302D42
function CCSecurityRedirect($GroupsAccess, $URL)
{
    global $_SERVER;
    $ReturnPage = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";
    if(!strlen($ReturnPage)) {
        $ReturnPage = isset($_SERVER["SCRIPT_NAME"]) ? $_SERVER["SCRIPT_NAME"] : "";
        $QueryString = CCGetQueryString("QueryString", "");
        if($QueryString !== "")
            $ReturnPage .= "?" . $QueryString;
    }
    $ErrorType = CCSecurityAccessCheck($GroupsAccess);
    if($ErrorType != "success")
    {
        if(!strlen($URL))
            $Link = ServerURL . "index.php";
        else
            $Link = $URL;
        header("Location: " . $Link . "?ret_link=" . urlencode($ReturnPage) . "&type=" . $ErrorType);
        exit;
    }
}
//End CCSecurityRedirect

//CCSecurityAccessCheck @0-7B496647
function CCSecurityAccessCheck($GroupsAccess)
{
    $ErrorType = "success";
    if(!strlen(CCGetUserID()))
    {
        $ErrorType = "notLogged";
    }
    else
    {
        $GroupID = CCGetGroupID();
        if(!strlen($GroupID))
        {
            $ErrorType = "groupIDNotSet";
        }
        else
        {
            if(!CCUserInGroups($GroupID, $GroupsAccess))
                $ErrorType = "illegalGroup";
        }
    }
    return $ErrorType;
}
//End CCSecurityAccessCheck

//CCGetUserID @0-6FAFFFAE
function CCGetUserID()
{
    return CCGetSession("UserID");
}
//End CCGetUserID

//CCGetGroupID @0-89F10997
function CCGetGroupID()
{
    return CCGetSession("GroupID");
}
//End CCGetGroupID

//CCGetUserLogin @0-ACD25564
function CCGetUserLogin()
{
    return CCGetSession("UserLogin");
}
//End CCGetUserLogin

//CCGetUserPassword @0-D67B1DE1
function CCGetUserPassword()
{
    return "";
}
//End CCGetUserPassword

//CCUserInGroups @0-9F7F30EA
function CCUserInGroups($GroupID, $GroupsAccess)
{
    $Result = "";
    if(strlen($GroupsAccess))
    {
        $Result = (strpos(";" . $GroupsAccess . ";", ";" . $GroupID . ";") !== false);
    }
    else
    {
        $Result = true;
    }
    return $Result;
}
//End CCUserInGroups

//CCCipherInit @0-034764F6
function CCCipherInit($key) {
    global $CipherBox, $CipherKey;
    $temp = '';
    $idx1 = 0;
    $idx2 = 0;
    $keyLength = strlen($key);
    for ($idx1 = 0; $idx1 < 256; $idx1++) {
        $CipherBox[$idx1] = $idx1;
        $CipherKey[$idx1] = ord($key[$idx1 % $keyLength]);
    }
    for ($idx1 = 0; $idx1 < 256; $idx1++) {
        $idx2 = ($idx2 + $CipherBox[$idx1] + $CipherKey[$idx1]) % 256;
        $temp = $CipherBox[$idx1];
        $CipherBox[$idx1] = $CipherBox[$idx2];
        $CipherBox[$idx2] = $temp;
    }
}
//End CCCipherInit

//CCEncryptString @0-1D38A95F
function CCEncryptString($inputStr, $key) {
    return strtoupper(CCBytesToHex(CCCipherEnDeCrypt($inputStr, $key)));
}
//End CCEncryptString

//CCDecryptString @0-548844D9
function CCDecryptString($inputStr, $key) {
    return CCBytesToString(CCCipherEnDeCrypt(CCHexToBytes($inputStr), $key));
}
//End CCDecryptString

//CCCipherEnDeCrypt @0-D1CE45DA
function CCCipherEnDeCrypt($inputStr, $key) {
    global $CipherBox;
    $result = array();
    $i = 0;
    $j = 0;
    CCCipherInit($key);
    for ($a = 0; $a < strlen($inputStr); $a++) {
        $i = ($i + 1) % 256;
        $j = ($j + $CipherBox[$i]) % 256;
        $temp = $CipherBox[$i];
        $CipherBox[$i] = $CipherBox[$j];
        $CipherBox[$j] = $temp;
        $k = $CipherBox[(($CipherBox[$i] + $CipherBox[$j]) % 256)];
        $crypted = ord($inputStr[$a]) ^ $k;
        $result[$a] = $crypted;
    }
    return $result;
}
//End CCCipherEnDeCrypt

//CCBytesToString @0-48925391
function CCBytesToString($bytesArray) {
    $result = '';
    foreach ($bytesArray as $byte) {
        $result .= chr($byte);
    }
    return $result;
}
//End CCBytesToString

//CCBytesToHex @0-AC21C0B4
function CCBytesToHex($bytesArray) {
    $result = '';
    foreach ($bytesArray as $byte) {
        $tmp = dechex($byte);
        $result .= str_repeat("0", 2 - strlen($tmp)) . $tmp;
    }
    return $result;
}
//End CCBytesToHex

//CCHexToBytes @0-DE5FE7C5
function CCHexToBytes($hexstr) {
    $result = '';
    $num = 0;
    for ($i = 0; $i < strlen($hexstr); $i += 2) {
        $num = hexdec(substr($hexstr, $i, 1)) * 16;
        $num += hexdec(substr($hexstr, $i + 1, 1));
        $result .= chr($num);
    }
    return $result;
}
//End CCHexToBytes

//CCSetALCookie @0-7AA34A3D
function CCSetALCookie($login, $password) {
    $login    = CCEncryptString($login, CCS_ENCRYPTION_KEY_FOR_COOKIE);
    $password = CCEncryptString($password, CCS_ENCRYPTION_KEY_FOR_COOKIE);
    $result   = CCEncryptString($login . ":" . $password . ":" . (time() + CCS_EXPIRATION_DATE), CCS_ENCRYPTION_KEY_FOR_COOKIE);
    CCSetCookie("SMARTLogin", $result, time() + CCS_EXPIRATION_DATE);
}
//End CCSetALCookie

//CCRefreshALCookie @0-1A39C124
function CCRefreshALCookie($expirationDate) {
    if (CCS_SLIDING_EXPIRATION) {
        if (($expirationDate - (CCS_EXPIRATION_DATE / 2)) > time()) {
            list($login, $password, $expDate) = CCParseALCookie("SMARTLogin");
            CCSetALCookie($login, $password);
        }
    }
}
//End CCRefreshALCookie

//CCParseALCookie @0-F7A41E5E
function CCParseALCookie($cookieName) {
    $cookieValue = CCGetCookie($cookieName);
    $decryptedCookieValue = (strlen($cookieValue)) ?  CCDecryptString($cookieValue, CCS_ENCRYPTION_KEY_FOR_COOKIE) : "";
    $pos = strpos($decryptedCookieValue, ':');
    $parts = array();
    if ($pos) {
        $parts = explode(":", $decryptedCookieValue);
        $parts[0] = CCDecryptString($parts[0], CCS_ENCRYPTION_KEY_FOR_COOKIE);
        $parts[1] = CCDecryptString($parts[1], CCS_ENCRYPTION_KEY_FOR_COOKIE);
    }
    return $parts;
}
//End CCParseALCookie

//CCCheckAutoLoginCookies @0-A51D006E
function CCCheckAutoLoginCookies() {
    if (!CCGetUserLogin()) {
        $parts = CCParseALCookie("SMARTLogin");
        if (isset($parts) && (count($parts) > 2)) {
            list($login, $password, $expirationDate) = $parts;
            if ($expirationDate > time()) {
                CCLoginUser($login, $password);
                if (CCGetUserLogin()) {
                    CCRefreshALCookie($expirationDate);
                    if (strlen(CCGetFromGet("ccsForm"))) {
                        header("Location: " . $_SERVER["PHP_SELF"] . "?" . CCGetQueryString("QueryString", "ccsForm"));
                        exit();
                    }
                }
            }
        }
    }
    if (!CCGetUserLogin()) {
        CCSetCookie("SMARTLogin", "");
    }
}
//End CCCheckAutoLoginCookies

//CCLoginUser @0-C18303BF
function CCLoginUser($login, $password)
{
    CCLogoutUser();
    $db = new clsDBSMART();
    $SQL = "SELECT id, usr_group, usr_password FROM smart_user WHERE usr_username=" . $db->ToSQL($login, ccsText) . " AND usr_password=" . $db->ToSQL($password, ccsText);
    $db->query($SQL);
	//print($SQL);
    $Result = $db->next_record();
    if ($Result) {
        CCSetSession("UserID", $db->f("id"));
        CCSetSession("UserLogin", $login);
        CCSetSession("GroupID", $db->f("usr_group"));
    }
    return $Result;
}
//End CCLoginUser

//CCLogoutUser @0-55C59DC5
function CCLogoutUser()
{
    CCSetSession("UserID", "");
    CCSetSession("UserLogin", "");
    CCSetSession("GroupID", "");
}
//End CCLogoutUser

// GetCodeDescription
function GetCodeDescription( $CT=null, $CV ) {
	//--- db instance ---
	$DBRefCode = new clsDBSMART() ;

	//--- Reference Code SELECT Query ---
	$SQLRefCode = "SELECT * FROM smart_referencecode WHERE ref_type = '" . mysql_real_escape_string($CT) . "' AND ref_value = '" . mysql_real_escape_string($CV) . "' " ;
	//echo $SQLRefCode;
	//--- execute the query ---
	
	$DBRefCode->query( $SQLRefCode ) ;

	//--- save/monitor recordset pointer ---
	$RSRefCode = $DBRefCode->next_record() ;

	if( $RSRefCode )	//--- record exist ---
		$ReturnValue = $DBRefCode->f( "ref_description" ) ;
	else			//--- not found ---
		$ReturnValue = "" ;
	
	//--- just return what is available ---	
	return $ReturnValue;
}
//END GetCodeDescription

// GetCodeFromSingleTable
function GetCodeFromSingleTable($table,$id,$returnField) {
	$DBRefCode = new clsDBSMART() ;
	$SQLRefCode = "SELECT * FROM ".$table." WHERE id = ".mysql_real_escape_string($id);
	//--- execute the query ---
	
	$DBRefCode->query( $SQLRefCode ) ;
	$RSRefCode = $DBRefCode->next_record() ;

	if( $RSRefCode )	//--- record exist ---
		$ReturnValue = $DBRefCode->f( $returnField ) ;
	else			//--- not found ---
		$ReturnValue = "" ;
	
	//--- just return what is available ---
	
	return $ReturnValue;
}
//END GetCodeFromSingleTable

// GetDataRefToField
function GetDataRefToField($table,$field,$value,$returnField) {
	$DBRefCode = new clsDBSMART() ;
	$SQLRefCode = "SELECT * FROM ".$table." WHERE ".$field." = '".mysql_real_escape_string($value)."'";
	//--- execute the query ---
	//print($SQLRefCode);
	$DBRefCode->query( $SQLRefCode ) ;
	$RSRefCode = $DBRefCode->next_record() ;

	if( $RSRefCode )	//--- record exist ---
		$ReturnValue = $DBRefCode->f( $returnField ) ;
	else			//--- not found ---
		$ReturnValue = "" ;
	
	//--- just return what is available ---
	
	return $ReturnValue;
}
//END GetDataRefToField

// LimitCharacter
function LimitCharacter($stringToDisplay) {
	$position=50; // Define how many character you want to display.

	$croppedString = substr($stringToDisplay, 0, $position)."..."; 

	return $croppedString;
}
//END LimitCharacter

// GetRecentRecordId
function GetRecentRecordId($tableName) {

	$DBRefCode = new clsDBSMART() ;
	$SQLRefCode = "SELECT id FROM ".mysql_real_escape_string($tableName). " ORDER BY id DESC";

	$DBRefCode->query( $SQLRefCode ) ;
	$RSRefCode = $DBRefCode->next_record() ;

	if( $RSRefCode )	//--- record exist ---
		$ReturnValue = $DBRefCode->f( "id" ) ;
	else			//--- not found ---
		$ReturnValue = "" ;
	
	//--- just return what is available ---
	
	return $ReturnValue;
}
//END GetRecentRecordId

//BEGIN GET VALUE OF MONTH
function GetNameOfMonth($month) {
	switch($month) {
		case 1:
			$monthName = "January";
			break;
		case 2:
			$monthName = "February";
			break;
		case 3:
			$monthName = "March";
			break;
		case 4:
			$monthName = "April";
			break;
		case 5:
			$monthName = "Mei";
			break;
		case 6:
			$monthName = "June";
			break;
		case 7:
			$monthName = "July";
			break;
		case 8:
			$monthName = "August";
			break;
		case 9:
			$monthName = "September";
			break;
		case 10:
			$monthName = "October";
			break;
		case 11:
			$monthName = "November";
			break;
		case 12:
			$monthName = "December";
			break;
	}
	return $monthName;
}
//END GET VALUE OF MONTH

//BEGIN GET SERIES NUMBER
function GetAutoGenerateTicket($currYear,$currMonth) {
	$DBSMART = new clsDBSMART() ;

	$RecentIdNumber = CCDLookUp("currentticket", "smart_ticketgenerator","YEAR(period)=".$currYear." AND MONTH(period)='".$currMonth."' AND type='tckt'",$DBSMART) ;
	if(strlen($RecentIdNumber)==1) {
		$NoSemasa = "0".$RecentIdNumber;	
	} else {
		$NoSemasa = $RecentIdNumber;
	}
	return $NoSemasa ;
}
//END SERIES NUMBER

//BEGIN UPDATE SERIES NUMBER
function UpdateAutoGenerateTicket($currYear,$currMonth) {
	$dbupd = new clsDBSMART() ;
	$sqlupd = "UPDATE smart_ticketgenerator SET currentticket = currentticket + 1 WHERE YEAR(period)=".$currYear." AND MONTH(period)='".$currMonth."' AND type='tckt'" ;
	$dbupd->query( $sqlupd ) ;
}
//END UPDATE SERIES NUMBER

//BEGIN GET SERIES NUMBER FOR PM
function GetAutoGeneratePM($currYear) {
	$DBSMART = new clsDBSMART();

	$MonthNow = date("n");
	$LatestMonthModified = CCDLookUp("MONTH(period)", "smart_ticketgenerator","YEAR(period)=".$currYear." AND type='pm'",$DBSMART) ;
	if($MonthNow > $LatestMonthModified) {
		UpdateAutoGeneratePM($currYear);
	}
	$RecentIdNumber = CCDLookUp("currentticket", "smart_ticketgenerator","YEAR(period)=".$currYear." AND type='pm'",$DBSMART) ;
	if(strlen($RecentIdNumber)==1) {
		$NoSemasa = "0".$RecentIdNumber;	
	} else {
		$NoSemasa = $RecentIdNumber;
	}
	return $NoSemasa ;
}
//END SERIES NUMBER

//BEGIN UPDATE SERIES NUMBER FOR PM
function UpdateAutoGeneratePM($currYear) {
	$UpdPeriod = $currYear."-".date("m")."-01";
	$dbupd = new clsDBSMART() ;
	$sqlupd = "UPDATE smart_ticketgenerator SET period='".$UpdPeriod."', currentticket = currentticket + 1 WHERE YEAR(period)='".$currYear."' AND type='pm'" ;
	$dbupd->query( $sqlupd ) ;
}
//END UPDATE SERIES NUMBER

//BEGIN UPDATE STATUS PROJECT
function SetStatusTicket($valField, $whereId) {
	global $DBSMART;
	list($tcktStatus,$tcktByUser,$tcktAdukom,$tcktDate,$tcktHelpdesk) = $valField;

	$dbupd = new clsDBSMART() ;
	$sqlupd = "UPDATE smart_ticket SET tckt_status = '".mysql_real_escape_string($tcktStatus)."',tckt_c_byuser = '".mysql_real_escape_string($tcktByUser)."',tckt_c_helpdesk = '".mysql_real_escape_string($tcktHelpdesk)."', tckt_c_adukomid = '".mysql_real_escape_string($tcktAdukom)."', tckt_c_date = '".mysql_real_escape_string($tcktDate)."' WHERE id=".mysql_real_escape_string($whereId);
	$dbupd->query($sqlupd);
}
//END UPDATE STATUS PROJECT

//BEGIN UPDATE STATUS PROJECT
function SetLoggedTime($userID) {
	global $DBSMART;

	$dbupd = new clsDBSMART() ;
	$sqlupd = "UPDATE smart_user SET usr_lastlogged = '".mysql_real_escape_string(date ("Y-m-d H:m:s"))."' WHERE id=".mysql_real_escape_string($userID);
	$dbupd->query($sqlupd);

}
//END UPDATE STATUS PROJECT

//BEGIN DELETE DETAILS PROJECT
function DeleteDataFromTable($tableName,$whereField,$whereId) {
	global $DBSMART;

	$dbupd = new clsDBSMART() ;
	$sqlupd = "DELETE FROM ".$tableName." WHERE ".$whereField."=".mysql_real_escape_string($whereId);
	$dbupd->query($sqlupd) ;

	//print("SQL=>".$sqlupd);
	//die();
}
//END DELETE DETAILS PROJECT

//BEGIN RECORD LOG ACTIVITY
function LogActivity($UserId,$Action,$Ticket=null,$Activity,$Datetime,$Module=null) {
	global $DBSMART;
    
	$dblog = new clsDBSMART() ;
	$sqllog = "INSERT INTO smart_logactivity (id,log_userid,log_action,log_ticket,log_description,log_date,log_module) VALUES ('','".$UserId."','".$Action."','".$Ticket."','".$Activity."','".$Datetime."','".$Module."')";
	//print("SQL=>".$sqllog);
	//die();
	$dblog->query($sqllog) ;
}
//END RECORD LOG ACTIVITY

//BEGIN CountingPeriod
function CountingPeriod($dateEnd=null,$dateStart=null) {
		//$starttime=strtotime($dateStart[1].'-'.$dateStart[2].'-'.$dateStart[3]); //standard this is just today's date / the start time can change to =strtotime($endtime);
		//if($dateEnd == null) $endtime=time(); //$endtime can be any format as well as it can be converted to secs
		//else $endtime = strtotime($dateEnd[1].'-'.$dateEnd[2].'-'.$dateEnd[3]);
		
		$timediff = $dateEnd-$dateStart;
		$days=intval($timediff/86400);
		$remain=$timediff%86400;
		$hours=intval($remain/3600);
		$remain=$remain%3600;
		$mins=intval($remain/60);
		$secs=$remain%60;
		 
		// this is just an output that tells the difrence
		$timediff = $days."d ".$hours."h"; //".$mins."(m)"; //$hours.'hr'.$mins.'min'.$secs.'s';
		return $timediff;
	}
//END CountingPeriod

//BEGIN CountingPeriod
function CountingHours($dateEnd=null,$dateStart=null) {		
		$timediff = $dateEnd-$dateStart;
		$days=intval($timediff/86400);
		$remain=$timediff%86400;
		$hours=intval($remain/3600);
		$remain=$remain%3600;
		$mins=intval($remain/60);
		$secs=$remain%60;
		
		if($days > 0) $TimeCalculated = $days*24;
		else $TimeCalculated = 0;
		// this is just an output that tells the time different
		$TimeAdditional = $hours;//.'hr'.$mins.'min'.$secs.'s';
		$timediff = $TimeCalculated + $TimeAdditional;
		return $timediff;
	}
//END CountingPeriod

// BEGIN GetDataCountedForStatistic
function GetCountedData($tableName,$group,$whereCondValue) {

	$DBRefCode = new clsDBSMART() ;
	$SQLRefCode = "SELECT count(*) FROM ".$tableName. " WHERE ".$group."=".mysql_real_escape_string($whereCondValue)." GROUP BY ".$group." DESC";

	$DBRefCode->query( $SQLRefCode ) ;
	$RSRefCode = $DBRefCode->next_record() ;

	if( $RSRefCode )
		$ReturnValue = $DBRefCode->f( "count(*)" ) ;
	else
		$ReturnValue = "" ;
	return $ReturnValue;
}
// END GetDataCountedForStatistic

// BroadcastEmail
function BroadcastEmail($typenotify,$to,$from=null,$title,$content=null,$dateemel=null) {
	$DBSMART = new clsDBSMART() ;
	switch($typenotify) {
		case 'newacc' :
			$subject = 'SMART-:'.$title;
			$message = "<html><head><title>SMART</title></head>";
			$message .= "<body>";
			$message .= "<h3>Welcome</h3>";
			$message .= "Hi there,";
			$message .= "<br>You're now registered as a member of SMART! We're glad to have you. Please make yourself comfortable.";
			$message .= "<br><u>YOUR ACCOUNT DETAILS AS BELOW:-</u><br><br>";
			$message .= "<strong>".$content."</strong>";
			$message .= "<p>Please login to the system via this link <a href='http://smart.target.net.my' target='_blank'>http://smart.target.net.my</a> for more details</p>";
			$message .= "<br>Thank you</br>";
			$message .= "<hr><br>";
			$message .= "<em>For more details adawiyah@gmail.com<br>03 - 0000000</em>";

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//Additional headers
			$headers .= 'From: SMART ADMIN <adawiyah@gmail.com>' . "\r\n";
			$headers .= 'Cc: adawiyah@gmail.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			
			//SMTP HOST : 10.22.156.39 port 25
			ini_set('sendmail_from', $from);
			mail($to,$subject,$message,$headers);
		break;
		case 'newpm' : //START -- suen 140910: Detailed info in e-mail notification
			$EngineerUsername = CCDlookUp("usr_username", "smart_user", "id=".$from, $DBSMART);
			$Engineer = CCDlookUp("usr_fullname", "smart_user", "id=".$from, $DBSMART);
			$Eng2_id = CCDlookUp("prvt_byuser2","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			$Engineer2 = CCDlookUp("usr_fullname", "smart_user", "id=".$Eng2_id, $DBSMART);
			
			$PmID = CCDlookUp("max(id)", "smart_preventive", "prvt_refnumber='".$content."'", $DBSMART);
			
			$site = CCDlookUp("prvt_site","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			$cust_name = CCDlookUp("prvt_customer","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			$cust_contact = CCDlookUp("prvt_customercontact","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);	
			
			$eta = CCDlookUp("prvt_eta","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			$etd = CCDlookUp("prvt_etd","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			
			$inspection = CCDlookUp("prvt_inspection","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);	
			$action_taken = CCDlookUp("prvt_actiontaken","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);	
			$action_plan = CCDlookUp("prvt_planning","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
			$remarks = CCDlookUp("prvt_remark","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);
		
			//$e2000 = CCDlookUp("flty_serialnumber","smart_faultyequipment","resolution_id='".$content."' AND equipment_id='E2000'",$DBSMART);
			//$e2000_counter = CCDlookUp("prvt_counter","smart_preventive","prvt_refnumber='".$content."'",$DBSMART);	
			
			$subject = $title.' #: '.$content.' by '.$EngineerUsername;
			$message = "<html><head><title>SMART</title></head>";
			$message .= "<body>";
			$message .= "<h3>Sallam & Good Day!</h3>";
			$message .= "<p>A new PM Report has been created on ".date("D d/m/y H:i",strtotime($dateemel))." hours.<br></p>";
			$message .= "<p><b><u>DETAILS</u></b><br>";
			$message .= "PM # : ".$content."<br>";
			$message .= "ENGID #1: ".$Engineer."<br>";
			$message .= "ENGID #2: ".$Engineer2."<br>";
			$message .= "SITE : ".$site."<br>"; 
			$message .= "ETA : ".date("D d/m/y H:i",strtotime($eta))." hours<br>";
			$message .= "ETD : ".date("D d/m/y H:i",strtotime($etd))." hours<br>";
			$message .= "CUSTOMER : ".$cust_name." (".$cust_contact.")<br><br>";


			$message .= "INSPECTION : ".$inspection."<br>";
			$message .= "ACTION TAKEN : <b>".$action_taken."</b><br>";
			$message .= "NEXT ACTION PLAN : ".$action_plan."<br>";
			$message .= "REMARK(S) : ".$remarks."<br><br>";


			//$message .= "E2000 S/N : ".$e2000." (".$e2000_counter.")<br></p>";
			// $message .= "REPLACEMENT(S) : <b>".$action_taken."</b><br>";


			$message .= "<p>Kindly login to SMART via  <a href='http://smart.target.net.my/SMART/index.php' target='_blank'>http://smart.target.net.my/SMART/index.php</a> 
							and copy the link below & paste it to your browser for the details. <br>
							<b><em>http://smart.target.net.my/SMART/cmactivity.php?pmid=".$PmID."&rf=".$content."</em></b> </p>";
			$message .= "<hr>";
			$message .= "<em>This is an automatic notification from SMART. Please do not reply to this email.</em><br>";
			$message .= "<em>Should you have any enquiry, please contact us via software@target.net.my</em><br>";
			$message .= "<em>Thank you.</em></br>";
			$message .= "</body></html>";
			
			//END -- suen 140910: Detailed info in e-mail notification
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//Additional headers
			$headers .= 'From: SMART Admin <smart@target.net.my>' . "\r\n";
			$headers .= 'Cc: adawiyah@gmail.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			//echo $message;
			//die();
			//SMTP HOST : 10.22.156.39 port 25
			ini_set('sendmail_from', 'smart@target.net.my');
			mail($to,$subject,$message,$headers);
		break;
		case 'newcm' :
			$Engineer = CCDlookUp("usr_fullname", "smart_user", "id=".$from, $DBSMART);
			$EngineerUsername = CCDlookUp("usr_username", "smart_user", "id=".$from, $DBSMART);
			$TicketID = CCDlookUp("id", "smart_ticket", "tckt_refnumber='".$content."'", $DBSMART);
			$CmID = CCDlookUp("max(id)", "smart_resolutionnote", "ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);

			$branch = CCDlookUp("tckt_site","smart_ticket","tckt_refnumber='".$content."'",$DBSMART);		
			$r_date = CCDlookUp("tckt_r_date","smart_ticket","tckt_refnumber='".$content."'",$DBSMART);	
			$c_date = CCDlookUp("tckt_c_date","smart_ticket","tckt_refnumber='".$content."'",$DBSMART);	
			$desc = CCDlookUp("tckt_description","smart_ticket","tckt_refnumber='".$content."'",$DBSMART);	
			
			$eta = CCDlookUp("rsltn_eta","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
			$etd = CCDlookUp("rsltn_etd","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
			$inspection = CCDlookUp("rsltn_inspection","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
			$action_taken = CCDlookUp("rsltn_actiontaken","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
			$action_plan = CCDlookUp("rsltn_planning","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
			$remarks = CCDlookUp("rsltn_remark","smart_resolutionnote","ticket_id=".$TicketID." AND rsltn_byuser=".$from." AND rsltn_type='CM'", $DBSMART);	
		
			$subject = $title.' Ticket #: '.$content.' @ '.$branch.' by '.$EngineerUsername;
			$message = "<html><head><title>SMART</title></head>";
			$message .= "<body>";
			$message .= "<h3>Sallam & Good Day!</h3>";
			$message .= "<p>A new CM Report has been created on ".date("D d/m/y H:i",strtotime($dateemel)).".<br></p>";
			$message .= "<p><b><u>DETAILS</u></b><br>";
			$message .= "TICKET # : ".$content."<br>";
			$message .= "ENGID : ".$Engineer."<br>";
			$message .= "SITE : ".$branch."<br>"; 
			$message .= "OPENED : ".date("D d/m/y H:i",strtotime($r_date))." hours<br>";
			
			//suen140910 : Display not closed ticket date as "Not Closed"
			if ($c_date==null)
				$message .= "CLOSED : Not Closed <i>(Helpdesk to take action)</i> <br>";
			else
				$message .= "CLOSED : ".date("D d/m/y H:i",strtotime($c_date))." hours<br>";	
			
			$message .= "PROBLEM DESCRIPTION : <b>".$desc."</b><br><br>";


			$message .= "ETA : ".date("D d/m/y H:i",strtotime($eta))."<br>";
			$message .= "ETD : ".date("D d/m/y H:i",strtotime($etd))."<br>";
			$message .= "INSPECTION : ".$inspection."<br>";
			$message .= "ACTION TAKEN : <b>".$action_taken."</b><br>";
			$message .= "NEXT ACTION PLAN : ".$action_plan."<br>";
			$message .= "REMARK(S) : ".$remarks."<br><br></p>";
			$message .= "<p>Kindly login to SMART via  <a href='http://smart.target.net.my/SMART/index.php' target='_blank'>http://smart.target.net.my/SMART/index.php</a> 
							and copy the link below & paste it to your browser for the details. <br>
							<b><em>http://smart.target.net.my/SMART/cmactivity.php?tcktid=".$TicketID."&rid=".$CmID."</em></b> </p>";
			$message .= "<hr>";
			$message .= "<em>This is an automatic notification from SMART. Please do not reply to this email.</em><br>";
			$message .= "<em>Should you have any enquiry, please contact us via software@target.net.my</em><br>";
			$message .= "<em>Thank you.</em></br>";
			$message .= "</body></html>";
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//Additional headers
			$headers .= 'From: SMART Admin <smart@target.net.my>' . "\r\n";
			$headers .= 'Cc: adawiyah@gmail.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			//echo $message;
			//die();
			//SMTP HOST : 10.22.156.39 port 25
			ini_set('sendmail_from', 'smart@target.net.my');
			mail($to,$subject,$message,$headers);
		break;
		case 'aprvapp' :
			$namaprojek = GetCodeFromSingleTable("tbl_perolehan",$content,"NamaProjek");
			$statusid = GetCodeFromSingleTable("tbl_perolehan",$content,"StatusSemasa");
			$statusprojek = GetCodeDescription("stat",$statusid);
			$from = "adminaaibe@kettha.gov.my"; 
			$subject = 'TEST :SMART- :'.$title;
			$message = "<html><head><title>SMART</title></head>";
			$message .= "<body>";
			$message .= "<h3>Selamat Sejahtera</h3>";
			$message .= "THIS IS TESTING EMAIL! PLEASE IGNORE THIS EMAIL ONCE YOU HAVE RECEIVED IT. THANKS.";
			$message .= "<br>Permohonan perolehan anda telah diproses pada <b>".date("d-m-Y",strtotime($dateemel))."</b>";
			$message .= "<p>Perolehan <b>".$namaprojek."</b> berstatus : <b>".$statusprojek."</b>. <br>Untuk keterangan lanjut / semakan maklumat lengkap sila ke laman web ; 
						 <a href='http://smart.target.net.my' target='_blank'>http://smart.target.net.my</a>
						  dengan menggunakan ID Pengguna dan Katalaluan anda.</p>";
			$message .= "<br>Sekian, terima kasih</br>";
			$message .= "<hr><br>";
			$message .= "<em>Untuk keterangan lanjut sila hubungi adawiyah@gmail.com<br>03 - 00000000</em>";

			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//Additional headers
			$headers .= 'From: SMART ADMIN <adawiyah@gmail.com>' . "\r\n";
			$headers .= 'Cc: adawiyah@gmail.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			

			//print("To : ".$to." <br>Subjek : ".$subject."<br>Mesej : ".$message."<br>Headers :".$headers."<bR>");
			//print("<br>".$typenotify."<br>".$to."<br>".$from."<br>".$title."<br>".$content."<br>".date("d-m-Y",$dateemel[0])."<br>");
			//SMTP HOST : 10.22.156.39 port 25
			ini_set('sendmail_from', $from);
			mail($to,$subject,$message,$headers);
		break;
	}
}
//END BroadcastEmail

//START LogStatusChange
function LogStatusChange($UserId,$Status,$Refno,$DateLog) {
	global $DBSMART;
    
	$dblogstatus = new clsDBSMART() ;
	$sqllogstatus = "INSERT INTO smart_logstatus (id,log_refno,log_status,log_userid,log_date) VALUES";
	$sqllogstatus .= "('','".$Refno."','".$Status."','".$UserId."','".$DateLog."')";
	$dblogstatus->query($sqllogstatus) ;
}
//END LogStatusChange

//START MAP PARSEXML
function parseToXML($htmlStr) { 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
}
//END MAP PARSEXML
?>