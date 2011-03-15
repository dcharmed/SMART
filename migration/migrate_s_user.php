<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s_user.php");
include_once(RelativePath . "/Common.php");
$row = 1;
$dir = "test_csv";
$file = "testuser.csv";
$mastertable  = "smart_user";

//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//TOP OPEN THE MASTER CSV FILE
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        
        //query to insert new user
        $sqlquery = "INSERT INTO ".$mastertable." (id,usr_status,usr_username,usr_password,usr_group,usr_email,usr_fullname,usr_staffid,usr_availability,usr_post,usr_address,usr_gender,usr_dateofbirth,usr_lastlogged,datemodified)
                    VALUES ('','','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."',
                    '".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."')";
        $dbupd->query( $sqlquery ) ;
        $successInsertedID = mysql_insert_id();
        
        if($successInsertedID != null) {
            echo "<pre>";
                echo "record #".$successInsertedID." : Success inserted user:".$data[2];
            echo "</pre>";
        } else {
            echo "something wrong with data for user:".$data[2];
            die();
        }
        
    }
    fclose($handle);
}
?>