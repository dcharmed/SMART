<?php
// //Events @1-F81417CB

//smartgenmapxml_AfterInitialize @1-3B4A0193
function smartgenmapxml_AfterInitialize(& $sender)
{
    $smartgenmapxml_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartgenmapxml; //Compatibility
//End smartgenmapxml_AfterInitialize

//Custom Code @2-2A29BDB7
// ------------------------- 

// -------------------------
//End Custom Code

//Close smartgenmapxml_AfterInitialize @1-51AE18D0
    return $smartgenmapxml_AfterInitialize;
}
//End Close smartgenmapxml_AfterInitialize

//smartgenmapxml_BeforeShow @1-1F6FEAA8
function smartgenmapxml_BeforeShow(& $sender)
{
    $smartgenmapxml_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartgenmapxml; //Compatibility
//End smartgenmapxml_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close smartgenmapxml_BeforeShow @1-3FD3A031
    return $smartgenmapxml_BeforeShow;
}
//End Close smartgenmapxml_BeforeShow

//smartgenmapxml_BeforeInitialize @1-A41266EF
function smartgenmapxml_BeforeInitialize(& $sender)
{
    $smartgenmapxml_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartgenmapxml; //Compatibility
//End smartgenmapxml_BeforeInitialize

//Custom Code @4-2A29BDB7
// -------------------------
      
// -------------------------
//End Custom Code

//Close smartgenmapxml_BeforeInitialize @1-2BEDAE2D
    return $smartgenmapxml_BeforeInitialize;
}
//End Close smartgenmapxml_BeforeInitialize

//smartgenmapxml_BeforeOutput @1-3FC8AF9E
function smartgenmapxml_BeforeOutput(& $sender)
{
    $smartgenmapxml_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $smartgenmapxml; //Compatibility
//End smartgenmapxml_BeforeOutput

//Custom Code @5-2A29BDB7
// -------------------------
     // Select all the rows in the markers table
$DB = new clsDBSMART();
$querydata = "SELECT * FROM smart_site WHERE 1";
$Result = $DB->query($querydata);
 //= $DB->next_record();
if (!$Result) {
  die('Invalid query: ' . mysql_error());
} 

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($Result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['site_name']) . '" ';
  echo 'address="' . parseToXML($row['site_address']) . '" ';
  echo 'lat="' . $row['site_lat'] . '" ';
  echo 'lng="' . $row['site_long'] . '" ';
  echo 'type="' . $row['site_type'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
// -------------------------
//End Custom Code

//Close smartgenmapxml_BeforeOutput @1-C162886C
    return $smartgenmapxml_BeforeOutput;
}
//End Close smartgenmapxml_BeforeOutput


?>
