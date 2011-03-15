<?php
//Include Common Files @1-882F8F7E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "mainpage.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

// Select all the rows in the markers table
$DB = new clsDBSMART();
$querydata = "SELECT count(tckt_refnumber) AS NoOfTicket,site_code,site_name,site_address,site_lat,site_long,site_type
                FROM smart_ticket LEFT JOIN smart_site ON smart_site.site_code=smart_ticket.tckt_site 
                WHERE smart_ticket.tckt_status!=7 GROUP BY smart_ticket.tckt_site";
$Result = $DB->query($querydata);
/* = $DB->next_record();
if (!$Result) {
  die('Invalid query: ' . mysql_error());
}
*/
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
  echo 'ticket="' . $row['NoOfTicket'] . '" ';
  echo 'scode="' . $row['site_code'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
?>