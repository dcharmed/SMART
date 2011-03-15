<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s_task.php");
include_once(RelativePath . "/Common.php");
$row = 1;
//THIS IS THE DIRECTORY WHERE THE RESPECTIVE CSV FILE DATA WILL BE CALLED BY THE SCRIPT
$dir = "csv";
//THIS IS THE NAME FILE OF THE CSV
$file = "FINAL_task.csv";
//THIS IS THE TABLE WHERE DATA WILL BE MIGRATED
$mastertable  = "smart_task";
//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//BEGIN THE MIGRATION SCRIPT
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        
        //QUERY THE ID TICKETS OF THE REFERENCE NUMBER
        echo $queryselectidticket = "SELECT id FROM smart_ticket WHERE tckt_refnumber = '$data[0]'";
        $dbupd->query( $queryselectidticket ) ;
        $query = $dbupd->next_record() ;

        if( $query ) $TicketId = $dbupd->f( 'id' ) ;
        else $TicketId = '';
        
        //QUERY TO SELECT ENG ID
        if($data[3]!=null) { // engineer
            $queryselectengidtckt = "SELECT id FROM smart_user WHERE usr_username LIKE '%$data[3]'";
            $dbupd->query( $queryselectengidtckt ) ;
            $query = $dbupd->next_record() ;
            if( $query ) $EngId = $dbupd->f( 'id' ) ;
            else $EngId = "";
            
            //QUERY TO INSERT TASK OF ENGINEER TO TASK TABLE
            $sqlquerytask = "INSERT INTO ".$mastertable." (id,ticket_id,task_current,task_update,task_currenteng,task_updatedeng,task_status,task_notes,task_date)
                                VALUES
                                ('','".$TicketId."','".$data[1]."','".$data[2]."','".$EngId."','".$data[4]."',1,'".$data[6]."','".$data[7]."')";
            $dbupd->query( $sqlquerytask ) ;
            $TaskId = mysql_insert_id();
            
        }
        if($TaskId != null) {
            echo "<pre>";
                echo "<bR>Successfully inserted task#".$TaskId." of Engineer for ticket: ".$data[0]." : ENG = <b>".$EngId."</b>";
            echo "</pre>";
        } else {
            echo "<pre>";
                echo $sqlquerytask;
                echo "<br><font color=red>Something wrong with data Details for ticket: <b>".$data[0]."</b></font>";
            echo "</pre>";
        }
    }
    fclose($handle);
}
//END THE MIGRATION SCRIPT
?>