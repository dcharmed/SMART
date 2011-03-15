<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s_logactivity.php");
include_once(RelativePath . "/Common.php");
$row = 1;
//THIS IS THE DIRECTORY WHERE THE RESPECTIVE CSV FILE DATA WILL BE CALLED BY THE SCRIPT
$dir = "test_csv";
//THIS IS THE NAME FILE OF THE CSV
$file = "testlog.csv";
//THIS IS THE TABLE WHERE DATA WILL BE MIGRATED
$mastertable  = "smart_logactivity";
//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//BEGIN THE MIGRATION SCRIPT
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        
        //QUERY TO INSERT TASK OF ENGINEER TO TASK TABLE
        $sqlquerylog = "INSERT INTO ".$mastertable." (id,log_userid,log_action,log_ticket,log_description,log_date)
                            VALUES
                            ('','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."')";
        $dbupd->query( $sqlquerylog ) ;
        $LogId = mysql_insert_id();
            
        
        if($LogId != null) {
            echo "<pre>";
                echo "<bR>Successfully inserted LOG#".$TaskId." for ticket: ".$data[0]."</b>";
            echo "</pre>";
        } else {
            echo "<pre>";
                echo $sqlquerytask;
                echo "<br><font color=red>Something wrong with log for ticket: <b>".$data[0]."</b></font>";
            echo "</pre>";
        }
    }
    fclose($handle);
}
//END THE MIGRATION SCRIPT
?>