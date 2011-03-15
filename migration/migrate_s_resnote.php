<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/migration/");
define("FileName", "migrate_s_resnote.php");
include_once(RelativePath . "/Common.php");
$row = 1;
//THIS IS THE DIRECTORY WHERE THE RESPECTIVE CSV FILE DATA WILL BE CALLED BY THE SCRIPT
$dir = "csv";
//THIS IS THE NAME FILE OF THE CSV
$file = "FINAL_resnotes.csv";
//THIS IS THE TABLE WHERE DATA WILL BE MIGRATED
$mastertable  = "smart_resolutionnote";
//DB CONNECTION
$dbupd = new clsDBSMART();
global $DBSMART;

//BEGIN THE MIGRATION SCRIPT
if (($handle = fopen($dir."/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        
        //QUERY THE ID TICKETS OF THE REFERENCE NUMBER
        $queryselectidticket = "SELECT id FROM smart_ticket WHERE tckt_refnumber = '$data[0]'";
        $dbupd->query( $queryselectidticket ) ;
        $queryTicket = $dbupd->next_record() ;

        if( $queryTicket ) $TicketId = $dbupd->f( 'id' ) ;
        else $TicketId = '';
        
        //QUERY TO SELECT THE ENGINEER ID VALUE TO BE STORED INTO SMART_TICKET TABLE
        if($data[4]!=null) {
            $queryselectengid = "SELECT id FROM smart_user WHERE usr_username LIKE '%$data[4]'";
            $dbupd->query( $queryselectengid ) ;
        	$queryEng = $dbupd->next_record() ;
        	if( $queryEng ) $ResnoteByUser = $dbupd->f( 'id' ) ;
            else $ResnoteByUser = "";
        } else {
            $ResnoteByUser = "";
        }
        
        //QUERY TO SELECT ENG ID
        if($data[7]!=null) { // engineer
            $ResType = 'CM';
        } else $ResType = 'SN';
        
        //PROCEED TO INSERT THE RESNOTE ONLY WHEN THE TICKET ID HAS SUCCESSFULLY SELECTED
        
        if($TicketId!=null) {        
            //QUERY TO INSERT TASK OF ENGINEER TO TASK TABLE
            $sqlqueryresnote = "INSERT INTO ".$mastertable." (id,ticket_id,rsltn_type,rsltn_status,rsltn_date,rsltn_byuser,rsltn_servicedate,rsltn_servicennumber,rsltn_eta,rsltn_etd,rsltn_inspection,rsltn_actiontaken,rsltn_actionmethod,rsltn_planning,rsltn_remark)
                                VALUES
                                ('','".$TicketId."','".$ResType."','".$data[2]."','".$data[3]."','".$ResnoteByUser."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."')";
            $dbupd->query( $sqlqueryresnote ) ;
            $ResNoteId = mysql_insert_id();
                
            
            if($ResNoteId != null) {
                echo "<pre>";
                    echo "<bR>Successfully inserted Resnote#".$ResNoteId." for ticket: ".$data[0]."</b>";
                echo "</pre>";
            } else {
                echo "<pre>";
                    echo $sqlqueryresnote;
                    echo "<br><font color=red>Something wrong with data Details for ticket: <b>".$data[0]."</b></font>";
                    echo "<br><font color=red>".mysql_error()."</b></font>";
                echo "</pre>";
            }
        } else {
            echo "<pre>";
                    echo "<br><font color=red>SORRY, NO ID TICKET FOUND IN THE smart_ticket table for the ref_number: <b>".$data[0]."</b></font>";
                echo "</pre>";
        }
    }
    fclose($handle);
}
//END THE MIGRATION SCRIPT
?>