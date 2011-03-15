<?php

//DB MySQL Class @0-A08AAECD
/*
 * Database Management for PHP
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *        Modified by Vitaliy Radchuk (vitaliy.radchuk@yessoftware.com)
 *
 * db_mysql.php
 *
 */ 

class DB_MySQL {
  
  /* public: connection parameters */
  var $DBHost     = "";
  var $DBPort     = "";
  var $DBDatabase = "";
  var $DBUser     = "";
  var $DBPassword = "";
  var $Persistent = false;

  /* public: configuration parameters */
  var $Auto_Free     = 1;     ## Set to 1 for automatic mysql_free_result()
  var $Debug         = 0;     ## Set to 1 for debugging messages.
  var $Seq_Table     = "db_sequence";

  /* public: result array and current row number */
  var $Record   = array();
  var $Row;

  /* public: current error number and error text */
  var $Errno    = 0;
  var $Error    = "";

  /* public: this is an api revision, not a CVS revision. */
  var $type     = "mysql";
  var $revision = "1.2";

  /* private: link and query handles */
  var $Link_ID  = 0;
  var $Query_ID = 0;
  var $Connected = false;

  var $Encoding = "";
  
  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  /* public: some trivial reporting */
  function link_id() {
    return $this->Link_ID;
  }

  function query_id() {
    return $this->Query_ID;
  }

  function try_connect($DBHost = "", $DBPort = "", $DBUser = "", $DBPassword = "") {
    $this->Query_ID  = 0;
    /* Handle defaults */
    if ("" == $DBHost)       $DBHost     = $this->DBHost;
    if ("" == $DBPort)       $DBPort     = $this->DBPort;
    if ("" == $DBUser)       $DBUser     = $this->DBUser;
    if ("" == $DBPassword)   $DBPassword = $this->DBPassword;
      
    if($DBPort != "") $DBHost .= ":" . $DBPort;

    if($this->Persistent)
      $this->Link_ID = @mysql_pconnect($DBHost, $DBUser, $DBPassword);
    else
      $this->Link_ID = @mysql_connect($DBHost, $DBUser, $DBPassword);
    
    $this->Connected = $this->Link_ID ? true : false;
    return $this->Connected;
  }

  /* public: connection management */
  function connect($DBDatabase = "", $DBHost = "", $DBPort = "", $DBUser = "", $DBPassword = "") {
    /* Handle defaults */
    if ("" == $DBDatabase)   $DBDatabase = $this->DBDatabase;
    if ("" == $DBPort)       $DBPort     = $this->DBPort;
    if ("" == $DBHost)       $DBHost     = $this->DBHost;
    if ("" == $DBUser)       $DBUser     = $this->DBUser;
    if ("" == $DBPassword)   $DBPassword = $this->DBPassword;
      
    if($DBPort != "") $DBHost .= ":" . $DBPort;

    /* establish connection, select database */
    if (!$this->Connected) {
      $this->Query_ID  = 0;    
      if($this->Persistent)
        $this->Link_ID=@mysql_pconnect($DBHost, $DBUser, $DBPassword);
      else
        $this->Link_ID=@mysql_connect($DBHost, $DBUser, $DBPassword);

      if (!$this->Link_ID) {
        $this->halt("cannot connect to Database " . mysql_error());
        return 0;
      }

      if (!@mysql_select_db($DBDatabase,$this->Link_ID)) {
        $this->halt("cannot use database " . mysql_error());
        return 0;
      }
      $server_info = @mysql_get_server_info($this->Link_ID);
      preg_match("/\d+\.\d+(\.\d+)?/", $server_info, $matches);
      $version_str = $matches[0];
      $version = explode(".", $version_str);
      if ($version[0] >= 4) {
        if (($version[0] > 4 || $version[1] >= 1) && is_array($this->Encoding) && $this->Encoding[1])
          @mysql_query("SET NAMES '" . $this->Encoding[1] . "'", $this->Link_ID);
        elseif (is_array($this->Encoding) && $this->Encoding[0])
          @mysql_query("SET NAMES '" . $this->Encoding[0] . "'", $this->Link_ID);
      }
      $this->Connected = true;
    }
    
    return $this->Link_ID;
  }



  /* public: discard the query result */
  function free_result() {
    if (is_resource($this->Query_ID)) {
      @mysql_free_result($this->Query_ID);
    }
    $this->Query_ID = 0;
  }

  /* public: perform a query */
  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    if (!$this->connect()) {
      return 0; /* we already complained in connect() about that. */
    };

    # New query, discard previous result.
    if ($this->Query_ID) {
      $this->free_result();
    }

    if ($this->Debug)
      printf("Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
    $this->Row   = 0;
    $this->Errno = mysql_errno();
    $this->Error = mysql_error();
    if (!$this->Query_ID) {
      $this->Errors->addError("Database Error: " . mysql_error());
    }

    # Will return nada if it fails. That's fine.
    return $this->Query_ID;
  }

  /* public: walk result set */
  function next_record() {
    if (!$this->Query_ID) 
      return 0;

    $this->Record = @mysql_fetch_array($this->Query_ID);
    $this->Row   += 1;
    $this->Errno  = mysql_errno();
    $this->Error  = mysql_error();

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      $this->free_result();
    }
    return $stat;
  }

  /* public: position in result set */
  function seek($pos = 0) {
    $status = @mysql_data_seek($this->Query_ID, $pos);
    if ($status) {
      $this->Row = $pos;
    } else {
      $this->Errors->addError("Database error: seek($pos) failed -  result has ".$this->num_rows()." rows");

      /* half assed attempt to save the day, 
       * but do not consider this documented or even
       * desireable behaviour.
       */
      @mysql_data_seek($this->Query_ID, $this->num_rows());
      $this->Row = $this->num_rows();
    }
    return true;
  }

  /* public: table locking */
  function lock($table, $mode="write") {
    $this->connect();
    
    $query="lock tables ";
    if (is_array($table)) {
      while (list($key,$value)=each($table)) {
        if ($key=="read" && $key!=0) {
          $query.="$value read, ";
        } else {
          $query.="$value $mode, ";
        }
      }
      $query=substr($query,0,-2);
    } else {
      $query.="$table $mode";
    }
    $res = @mysql_query($query, $this->Link_ID);
    if (!$res) {
      $this->Errors->addError("Database error: Cannot lock tables - " . mysql_error());
      return 0;
    }
    return $res;
  }
  
  function unlock() {
    $this->connect();

    $res = @mysql_query("unlock tables");
    if (!$res) {
      $this->Errors->addError("Database error: cannot unlock tables - " . mysql_error());
      return 0;
    }
    return $res;
  }


  /* public: evaluate the result (size, width) */
  function affected_rows() {
    return @mysql_affected_rows($this->Link_ID);
  }

  function num_rows() {
    return @mysql_num_rows($this->Query_ID);
  }

  function num_fields() {
    return @mysql_num_fields($this->Query_ID);
  }

  /* public: shorthand notation */
  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record && array_key_exists($Name, $this->Record) ? $this->Record[$Name] : "";
  }

  function p($Name) {
    print $this->Record[$Name];
  }

  /* public: sequence numbers */
  function nextid($seq_name) {
    $this->connect();
    
    if ($this->lock($this->Seq_Table)) {
      /* get sequence number (locked) and increment */
      $q  = sprintf("select nextid from %s where seq_name = '%s' LIMIT 1",
                $this->Seq_Table,
                $seq_name);
      $id  = @mysql_query($q, $this->Link_ID);
      $res = @mysql_fetch_array($id);
      
      /* No current value, make one */
      if (!is_array($res)) {
        $currentid = 0;
        $q = sprintf("insert into %s values('%s', %s)",
                 $this->Seq_Table,
                 $seq_name,
                 $currentid);
        $id = @mysql_query($q, $this->Link_ID);
      } else {
        $currentid = $res["nextid"];
      }
      $nextid = $currentid + 1;
      $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
               $this->Seq_Table,
               $nextid,
               $seq_name);
      $id = @mysql_query($q, $this->Link_ID);
      $this->unlock();
    } else {
      $this->Errors->addError("Database Error: " . mysql_error());
      return 0;
    }
    return $nextid;
  }

  /* public: return table metadata */
  function metadata($table='',$full=false) {
    $count = 0;
    $id    = 0;
    $res   = array();

    /*
     * Due to compatibility problems with Table we changed the behavior
     * of metadata();
     * depending on $full, metadata returns the following values:
     *
     * - full is false (default):
     * $result[]:
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *
     * - full is true
     * $result[]:
     *   ["num_fields"] number of metadata records
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *   ["meta"][field name]  index of field named "field name"
     *   The last one is used, if you have a field name, but no index.
     *   Test:  if (isset($result['meta']['myfield'])) { ...
     */

    // if no $table specified, assume that we are working with a query
    // result
    if ($table) {
      $this->connect();
      $id = @mysql_list_fields($this->DBDatabase, $table);
      if (!$id) {
        $this->Errors->addError("Metadata query failed: " . mysql_error());
        return 0;
      }
    } else {
      $id = $this->Query_ID; 
      if (!$id){
        $this->Errors->addError("Metadata query failed: No query specified.");
        return 0;
      }
    }
 
    $count = @mysql_num_fields($id);

    // made this IF due to performance (one if is faster than $count if's)
    if (!$full) {
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
      }
    } else { // full
      $res["num_fields"]= $count;
    
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
        $res["meta"][$res[$i]["name"]] = $i;
      }
    }
    
    // free the result only if we were called on a table
    if ($table && is_resource($id)) {
      @mysql_free_result($id);
    }
    return $res;
  }

  function close()
  {
    if ($this->Query_ID) {
      $this->free_result();
    }
    /*
    For better perfomance, now php(by docs) must close connection when script finished
    if ($this->Connected && !$this->Persistent) {
      mysql_close($this->Link_ID);
      $this->Connected = false;
    }
    */
  }  

  /* private: error handling */
  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>MySQL Error</b><br>\n");
    die("Session halted.");
  }

  function table_names() {
    $this->query("SHOW TABLES");
    $i=0;
    while ($info=mysql_fetch_row($this->Query_ID))
     {
      $return[$i]["table_name"]= $info[0];
      $return[$i]["tablespace_name"]=$this->DBDatabase;
      $return[$i]["database"]=$this->DBDatabase;
      $i++;
     }
   return $return;
  }
    
  function esc($value) {
    if ($this->Connected) {
      return mysql_real_escape_string($value, $this->Link_ID);
    } elseif (function_exists("mysql_escape_string")) {
      return mysql_escape_string($value);
    } else {
      return addslashes($value);
    }    
  }
}

//End DB MySQL Class


?>
