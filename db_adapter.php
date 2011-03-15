<?php

//DB Adapter Class @0-1C790F05
class DB_Adapter
{
    var $DateFormat;
    var $BooleanFormat;
    var $LastSQL;
    var $Errors;

    var $RecordsCount;
    var $RecordNumber;
    var $PageSize;
    var $AbsolutePage;

    var $SQL = "";
    var $Where = "";
    var $Order = "";

    var $Parameters;
    var $wp;

    var $NextRecord = array();

    var $Provider;

    var $Link_ID;
    var $Query_ID;
    var $DBHost;

    var $DBPort;
    var $DBDatabase;
    var $DBUser;
    var $DBPassword;
    var $Persistent;

    var $Auto_Free;
    var $Debug;

    var $Record;
    var $Row;

    var $Errno;
    var $Error;

    var $DateLeftDelimiter = "'";
    var $DateRightDelimiter = "'";

    function Initialize() {
        $this->LastSQL = "";
        $this->RecordsCount = 0;
        $this->RecordNumber = 0;
        $this->AbsolutePage = 0;
        $this->PageSize = 0;
    }

    function SetProvider($Configuration = array()) {
        $DBLib = "DB_" . $Configuration["DBLib"];
        $DBLibFile = RelativePath . "/" . strtolower($DBLib) . ".php";
        include_once($DBLibFile);
        $this->Provider = new $DBLib;

        $this->Link_ID = & $this->Provider->Link_ID;
        $this->Query_ID = & $this->Provider->Query_ID;
        $this->Record = & $this->Provider->Record;
        $this->DBDatabase = & $this->Provider->DBDatabase;
        $this->DBHost = & $this->Provider->DBHost;
        $this->DBPort = & $this->Provider->DBPort;
        $this->DBUser = & $this->Provider->DBUser;
        $this->DBPassword = & $this->Provider->DBPassword;
        $this->Persistent = & $this->Provider->Persistent;
        $this->Uppercase = & $this->Provider->Uppercase;
        $this->Provider->Errors = new clsErrors();
        $this->Errors = & $this->Provider->Errors;

        if (isset($Configuration["DBLib"]))
            $this->DB = $Configuration["DBLib"];
        if (isset($Configuration["Type"]))
            $this->Type = $Configuration["Type"];
        if (isset($Configuration["Database"]))
            $this->DBDatabase = $Configuration["Database"];
        if (isset($Configuration["Host"]))
            $this->DBHost = $Configuration["Host"];
        if (isset($Configuration["Port"]))
            $this->DBPort = $Configuration["Port"];
        if (isset($Configuration["User"]))
            $this->DBUser = $Configuration["User"];
        if (isset($Configuration["Password"]))
            $this->DBPassword = $Configuration["Password"];
        if (isset($Configuration["UseODBCCursor"]))
            $this->UseODBCCursor = $Configuration["UseODBCCursor"];
        if (isset($Configuration["Options"]))
            $this->Options = $Configuration["Options"];
        if (isset($Configuration["Encoding"]))
            $this->Provider->Encoding = $Configuration["Encoding"];
        if (isset($Configuration["Persistent"]))
            $this->Persistent = $Configuration["Persistent"];
        if (isset($Configuration["DateFormat"]))
            $this->DateFormat = $Configuration["DateFormat"];
        if (isset($Configuration["BooleanFormat"]))
            $this->BooleanFormat = $Configuration["BooleanFormat"];
        if (isset($Configuration["Uppercase"]))
            $this->Uppercase = $Configuration["Uppercase"];
    }

    function MoveToPage($Page) {
        global $CCSLocales;
        if($this->RecordNumber == 0 && $this->PageSize != 0 && $Page != 0 && $Page != 1)
            if( !$this->seek(($Page-1) * $this->PageSize)) {
                $this->Errors->addError($CCSLocales->GetText('CCS_CannotSeek'));
                $this->RecordNumber = $this->Row;
            } else {
                $this->RecordNumber = ($Page-1) * $this->PageSize;
            }
    }

    function PageCount() {
        return $this->PageSize && $this->RecordsCount != "CCS not counted" ? ceil($this->RecordsCount / $this->PageSize) : 1;
    }

    function query($SQL) {
        $this->LastSQL = $SQL;
        $this->NextRecord = array();
        return $this->Provider->query($SQL);
    }

    function execute($Procedure, $RS = 0) {
        $this->Provider->execute($Procedure, $RS);
    }

    function has_next_record() {
        if (method_exists($this->Provider, "has_next_row")) 
            return $this->Provider->has_next_row();
        if (count($this->NextRecord)) 
            return true;
        $Record = $this->Record;
        $result = $this->Provider->next_record();
        if ($result)
            $this->NextRecord = $this->Record;
        $this->Record = $Record;
        return $result;
    }

    function next_record() {
        if (method_exists($this->Provider, "has_next_row"))
            return $this->Provider->next_record();
        if (count($this->NextRecord)){
            $this->Record = $this->NextRecord;
            $this->NextRecord = array();
            return true;
        }
        return $this->Provider->next_record();
    }

    function seek($Num) {
        return $this->Provider->seek($Num);
    }

    function f($Field) {
        return $this->Provider->f($Field);
    }

    function close() {
        return $this->Provider->close();
    }

    function num_rows() {
        return $this->Provider->num_rows();
    }

    function esc($Text) {
        if (method_exists($this->Provider, "esc"))
            return $this->Provider->esc($Text);
        return addslashes($Text);
    }

    function affected_rows() {
        return $this->Provider->affected_rows();
    }

    function num_fields() {
        return $this->Provider->num_fields();
    }

    function nf() {
        return $this->num_rows();
    }

    function np() {
        return $this->num_rows();
    }

    function p($Name) {
        $this->Provider->p($Name);
    }

    function nextid($seq_name) {
        return $this->Provider->nextid($seq_name);
    }
    function ToSQL($Value, $ValueType, $List = false) {
        $RealValue = $Value;
        if (is_array($Value) && $List) {
            $Values = array();
            foreach ($Value as $Val) 
                $Values[] = $this->ToSQL($Val, $ValueType);
            return $Values;
        } elseif (is_array($Value) && !$List) {
            $Value = count($Value) ? $Value[0] : null;
        }
        if (($ValueType == ccsDate && is_array($RealValue)) || strlen($Value) || ($ValueType == ccsBoolean && is_bool($Value)))
        {
            if($ValueType == ccsInteger || $ValueType == ccsFloat)
            {
                return doubleval(str_replace(",", ".", $Value));
            }
            else if($ValueType == ccsDate)
            {
                if (is_array($RealValue)) {
                    $Value = CCFormatDate($RealValue, $this->DateFormat);
                }
                return $this->DateLeftDelimiter . $this->esc($Value) . $this->DateRightDelimiter;
            }
            else if($ValueType == ccsBoolean)
            {
                if(is_bool($Value))
                    $Value = CCFormatBoolean($Value, $this->BooleanFormat);
                else if(is_numeric($Value))
                    $Value = intval($Value);
                else if(strtoupper($Value) == "TRUE" || strtoupper($Value) == "FALSE")
                    $Value = strtoupper($Value);
                else
                    $Value = "'" . $this->esc($Value) . "'";
                return $Value;
            }
            else
            {
                return "'" . $this->esc($Value) . "'";
            }
        }
        else
        {
            return "NULL";
        }
    }

    function SQLValue($Value, $ValueType)
    {
        if ($ValueType == ccsDate && is_array($Value)) {
            $Value = CCFormatDate($Value, $this->DateFormat);
        }
        if (is_array($Value))
            $Value = count($Value) ? $Value[0] : "";
        if(!strlen($Value))
        {
            return "";
        }
        else
        {
            if($ValueType == ccsInteger || $ValueType == ccsFloat)
            {
                return doubleval(str_replace(",", ".", $Value));
            }
            else if($ValueType == ccsBoolean)
            {
                if(is_bool($Value))
                    $Value = CCFormatBoolean($Value, $this->BooleanFormat);
                else if(is_numeric($Value))
                    $Value = intval($Value);
                else if(strtoupper($Value) == "TRUE" || strtoupper($Value) == "FALSE")
                    $Value = strtoupper($Value);
                else
                    $Value = $this->esc($Value);
                return $Value;
            }
            else
            {
                return $this->esc($Value);
            }
        }
    }

    function bind($Par1, $Par2, $Par3, $Par4 = null, $Par5 = null) {
        if (is_null($Par4)) {
            return $this->Provider->bind($Par1, $Par2, $Par3);
        }
        if (is_null($Par5)) {
            return $this->Provider->bind($Par1, $Par2, $Par3, $Par4);
        }
        return $this->Provider->bind($Par1, $Par2, $Par3, $Par4, $Par5);
    }

    function __call($Method, $Params) {
        return call_user_func_array(array($this->Provider, $Method), $Params);
    }

    function link_id() {
        return $this->Provider->Link_ID;
    }

    function query_id() {
        return $this->Provider->Query_ID;
    }
}
//End DB Adapter Class


?>
