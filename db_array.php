<?php

//DB Array Class @0-BC4DE8A3
/*
 * Database Management for PHP
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 * Derived from db_mssql.php
 *
 * db_array.php
 */ 

class DB_Array {
  var $DBDatabase = "";
  var $DBUser     = "";
  var $DBPassword = "";
  var $Persistent = false;
  var $Uppercase  = false;
  var $Options    = array();
  var $Encoding   = "";

  var $Binds = array();

  var $Link_ID  = 0;
  var $Query_ID = 0;
  var $Record   = array();
  var $Row      = 0;
  
  var $Errno    = 0;
  var $Error    = "";

  var $Auto_Free = 1;     ## set this to 1 to automatically free results
  var $Debug     = 0;     ## Set to 1 for debugging messages.
  var $Connected = false;
  
  var $Stored_Query = 0;
  var $Child_Field  = "children";
  var $Parents      = array();
    
  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  function try_connect() 
  {
    return true;
  }

  function connect() {}

  function free_result() {
    $this->Query_ID = null;
  }

  function query($Query) 
  {
    if (is_array($Query)) {
      $this->Query_ID = $Query;
      $this->Stored_Query = $Query;
    } else if (is_string($Query) && strpos($Query, "SELECT COUNT(*)") === 0) {
      $this->Query_ID = array(array($this->num_rows()));
    } else {
      $this->Query_ID = $this->Stored_Query;
    }
    return $this->Query_ID;
  }
  
  function next_record() {
    $this->Record = current($this->Query_ID);
    $this->seek(1);
    return $this->Record;
  }
  
  function seek($pos) {
    for ($i = 0; $i < $pos; $i++) {
      $Result = next($this->Query_ID);
      if ($Result === false) return false; 
    }
    return true;
  }

  function affected_rows() {
    return false;
  }
    
  function num_rows($Arr = null) {
    if (is_null($Arr)) {
      $Arr = $this->Query_ID;
    }
    $Count = count($Arr);
    for($i = 0; $i < count($Arr); $i++) {
      if (isset($Arr[$i][$this->Child_Field])) {
        $Count += $this->num_rows($Arr[$i][$this->Child_Field]);
      }
    }  
    return $Count;
  }
  
  function num_fields() {
    return count($this->Query_ID[0]);
  }

  function nf() {
    return $this->num_rows();
  }
  
  function np() {
    print $this->num_rows();
  }
  
  function f($Name) {
    if($this->Uppercase) $Name = strtoupper($Name);
    return $this->Record && array_key_exists($Name, $this->Record) ? $this->Record[$Name] : "";
  }
  
  function p($Field_Name) {
    print $this->f($Field_Name);
  }

  function close()
  {
    if ($this->Query_ID) {
      $this->free_result();
    }
    if ($this->Connected && !$this->Persistent) {
      $this->Link_ID = null;
      $this->Connected = false;
    }
  }  

  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>Array Error</b><br>\n");
    die("Session halted.");
  }

}

//End DB Array Class


?>
