<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s.php");
include_once(RelativePath . "/Common.php");
$row = 1;
$dir = "csv_01";
$file = "toppserial.csv";
$mastertable  = "smart_eqtoppan";

//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//TOP OPEN THE MASTER CSV FILE
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        
        //query to insert equipment toppan serialnumber
        $sqlquery = "INSERT INTO ".$mastertable." (id,eqtop_eqcode,eqtop_branch,eqtop_toppan,eqtop_serialnumber)
                    VALUES ('','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')";
        $dbupd->query( $sqlquery ) ;
        $successInsertedID = mysql_insert_id();
        
        if($successInsertedID != null) {
            echo "<pre>";
                echo "record #".$successInsertedID." : Success inserted serial number:".$data[3];
            echo "</pre>";
        } else {
            echo "something wrong with data for serial number:".$data[3];
            die();
        }
        
    }
    fclose($handle);
}
?>