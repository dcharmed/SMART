<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s.php");
include_once(RelativePath . "/Common.php");
$row = 1;
$dir = "csv_01";
$file = "tickets.csv";
//$mastertable  = "smart_tickets";
$dbupd = new clsDBSMART();
global $DBSMART;
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        
        //query to insert new user
        /*$sqlquery = "INSERT INTO ".$mastertable." (id,usr_status,usr_username,usr_password,usr_group,usr_email,usr_fullname,usr_staffid,usr_availability,usr_post,usr_address,usr_gender,usr_dateofbirth,usr_lastlogged,datemodified)
                    VALUES ('','','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."',
                    '".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."')";
                   */
                   
        //query to insert tickets
        echo $queryselectidticket = "SELECT id FROM smart_ticket WHERE tckt_refnumber = '$data[1]'";
        $dbupd->query( $queryselectidticket ) ;
        $query = $dbupd->next_record() ;

        if( $query )	//--- record exist ---
            $ticketid = $dbupd->f( 'id' ) ;
        else 
            $ticketid = '';
        
        echo "<br>ID = ".$ticketid;
        echo "<br>";
        
        
        
        if($data[5]!=null) { // engineer
            $queryselectengidtckt = "SELECT id FROM smart_user WHERE usr_username LIKE '%$data[5]'";
            $dbupd->query( $queryselectengidtckt ) ;
            
        	$query = $dbupd->next_record() ;

        	if( $query )	//--- record exist ---
        		$sqlqueryselectengidtckt = $dbupd->f( 'id' ) ;
                
            echo "TCKT ID ENG || " .$sqlqueryselectengidtckt;
            echo "<br>";
            $sqlquerytask = "INSERT INTO smart_task (id,ticket_id,task_current,task_update,task_currenteng,task_updatedeng,task_status)
                                VALUES
                                ('','".$ticketid."','".$data[4]."','','".$sqlqueryselectengidtckt."','',1)";
            $dbupd->query( $sqlquerytask ) ;
        }
        
        
        
        echo "<pre>";
            echo $sqlqueryinsertticket;
            echo "<bR><b>".$sqlquerytask."</b>";
        echo "</pre>";
        
    }
    fclose($handle);
}
?>