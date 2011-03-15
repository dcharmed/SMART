<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s_ticket.php");
include_once(RelativePath . "/Common.php");
$row = 1;
//THIS IS THE DIRECTORY WHERE THE RESPECTIVE CSV FILE DATA WILL BE CALLED BY THE SCRIPT
$dir = "csv";
//THIS IS THE NAME FILE OF THE CSV
$file = "FINAL_tickets.csv"; 
//THIS IS THE TABLE WHERE DATA WILL BE MIGRATED
$mastertable  = "smart_ticket";
//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//BEGIN THE MIGRATION SCRIPT
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
                   
        //QUERY TO SELECT THE CATEGORY ID VALUE TO BE STORED INTO SMART_TICKET TABLE
        if($data[8] !=null) {
            $queryselectcat = "SELECT ref_value FROM smart_referencecode WHERE ref_description LIKE '%$data[8]' AND ref_type='probcat'";
            $dbupd->query( $queryselectcat ) ;
        	$query = $dbupd->next_record() ;
        	if( $query ) $TicketCategory = $dbupd->f( 'ref_value' ) ;
        	else $TicketCategory = '02'; //THIS IS DEFAULT TO SELECT THE CATEGORY AS HARDWARE
            
        }
        else {
            $TicketCategory ="";
        }
        
        //QUERY TO SELECT THE HELPDESK ID VALUE TO BE STORED INTO SMART_TICKET TABLE
        if($data[17] !=null) {
            $queryselecthelpdeskid = "SELECT id FROM smart_user WHERE usr_username LIKE '%$data[17]'";
            $dbupd->query( $queryselecthelpdeskid ) ;
        	$query = $dbupd->next_record() ;
        	if( $query ) $HelpdeskId = $dbupd->f( 'id' ) ;
            else $HelpdeskId = "";
        } else {
            $HelpdeskId = "";
        }
        
        //QUERY TO SELECT THE ENGINEER ID VALUE TO BE STORED INTO SMART_TICKET TABLE
        if($data[19]!=null) {
            $queryselectengid = "SELECT id FROM smart_user WHERE usr_username LIKE '%$data[19]'";
            $dbupd->query( $queryselectengid ) ;
        	$query = $dbupd->next_record() ;
        	if( $query ) $EngineerId = $dbupd->f( 'id' ) ;
            else $EngineerId = "";
        } else {
            $EngineerId = "";
        }
        
        //QUERY TO SELECT THE HELPDESK ID VALUE WHO CLOSED THE TICKET TO BE STORED INTO SMART_TICKET TABLE
        if($data[25]!=null) { //closedhelpdesk
            $queryselecthelpdeskclosedid = "SELECT id FROM smart_user WHERE usr_username LIKE '$data[25]'";
            $dbupd->query( $queryselecthelpdeskclosedid ) ;
        	$query = $dbupd->next_record() ;
        	if( $query ) $ClosedHelpdeskId = $dbupd->f( 'id' ) ;
            else $ClosedHelpdeskId = "";
        } else {
            $ClosedHelpdeskId = "";
        }
        
        
        //query to insert tickets
        $sqlqueryinsertticket = "INSERT INTO ".$mastertable." (id,tckt_refnumber,tckt_state,tckt_site,tckt_status,tckt_engineer,tckt_severity,tckt_toppanid,tckt_eqpmtserial,tckt_category,tckt_subcategory,tckt_tagrelated,tckt_escalate,tckt_description,tckt_r_date,tckt_r_customer,tckt_r_customercontact,tckt_r_customercontact2,tckt_r_helpdesk,tckt_r_byusertype,tckt_r_engineer,tckt_r_adukomid,tckt_adukomn,tckt_c_date,tckt_c_byuser,tckt_c_adukomid,tckt_c_helpdesk,datemodified)
                                    VALUES ('','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$TicketCategory."','".$$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$HelpdeskId."','".$data[18]."','".$EngineerId."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$ClosedHelpdeskId."','".$data[26]."')";
        $dbupd->query( $sqlqueryinsertticket ) ;
        $TicketId = mysql_insert_id();
        
        if($TicketId != null) {
            echo "<pre>";
                echo $sqlqueryinsertticket;
                echo "<br><b>Successfully inserted #".$TicketId." Details for ticket: <b>".$data[0]."</b>";
            echo "</pre>";
        } else {
            echo "<pre>";
                echo $sqlqueryinsertticket;
                echo "<br><font color=red>Something wrong with data Details for ticket: <b>".$data[0]."</b></font>";
                echo "<br><font color=red>Something wrong with data Details for ticket: <b>".mysql_error()."</b></font>";
            echo "</pre>";
        }
    }
    fclose($handle);
}
// END MIGRATION SCRIPT
?>
