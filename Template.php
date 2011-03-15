<?php

//Template class @0-88E1F12D

define("ccsParseAccumulate", true);
define("ccsParseOverwrite", false);

class clsTemplate
{
  var $globals        = array();  // initial data:files and blocks
  var $blocks         = array();  // resulted data and variables
  var $block_keys     = array();  // associate array (short key, full key)
  var $parse_array    = array();  // array ready for parsing
  var $position       = 0;        // position in parse string
  var $length         = 0;        // length of parse string 
  var $block_path     = "";

  var  $delimiter      = "";       // delimit blocks, tags, and html's - 27
  var  $tag_sign       = "";       // tag sign - 15
  var  $begin_block    = "";       // begin block sign - 16
  var  $end_block      = "";       // end block sign - 17

  var $external_encoding = "";
  var $out_encoding = "";
  var $internal_encoding = "";

    var $getname_cache = array();

  function clsTemplate($external_encoding = "", $out_encoding = "", $internal_encoding = "")
  {
    $this->delimiter      = chr(27);   
    $this->tag_sign       = chr(15);  
    $this->begin_block    = chr(16);  
    $this->end_block      = chr(17);  
    $this->external_encoding = $external_encoding;
    $this->out_encoding = $out_encoding;
  }

  function LoadTemplate($filename, $block_name, $encoding = "", $meta = "")
  {
    $file_content = "";

    if ($encoding == "")
      $encoding = $this->out_encoding;
    $file_path = TemplatePath . $filename;
    if (file_exists($file_path))
    {
      $fh=fopen($file_path, "rb");
      if (filesize($file_path))
        $file_content = fread($fh, filesize($file_path));
      fclose($fh);
      $this->LoadTemplateFromStr($file_content, $block_name, $encoding, $meta);
    }
  }
      
  function LoadTemplateFromStr($file_content, $block_name, $encoding = "", $meta = "") {
    global $CCSLocales;
    global $FileEncoding;
    global $CCProjectStyle;
    global $ContentType;
    if ($encoding == "")
      $encoding = $this->out_encoding;
    
    if ($meta == "remove") {
      $file_content =  preg_replace("/<\\s*meta\\s+http-equiv\\s*=\\s*['\"]?content-type['\"]?\\s+content\\s*=\\s*['\"]?[^;]+?;\\s*charset=[-a-z0-9]+['\"]?[^>]*>/i", "", $file_content);
      $file_content =  preg_replace("/<\\s*meta\\s+content\\s*=\\s*['\"]?[^;]+?;\\s*charset=[-a-z0-9]+['\"]?\\s+http-equiv\\s*=\\s*['\"]?content-type['\"]?[^>]*>/i", "", $file_content);
    } else if ($meta == "replace") {
      $file_content =  preg_replace('/(<\s*meta\s+http-equiv\s*=\s*[\'"]?content-type[\'"]?\s+content\s*=\s*[\'"]?)([^;]+?)(;\s*charset=)([-a-z0-9]+)([\'"]?[^>]*>)/i', '\1' . $ContentType . '\3' . $CCSLocales->GetFormatInfo("Encoding") . '\5', $file_content);
      $file_content =  preg_replace('/(<\s*meta\s+content\s*=\s*[\'"]?)([^;]+?)(;\s*charset=)([-a-z0-9]+)([\'"]?\s+http-equiv\s*=\s*[\'"]?content-type[\'"]?[^>]*>)/i', '\1' . $ContentType . '\3' . $CCSLocales->GetFormatInfo("Encoding") . '\5', $file_content);
    }
    $file_content = preg_replace("/\\{CCS_Style\\}/is", CCToURL($CCProjectStyle), $file_content);

    global $PathToRoot;
    $Path = $PathToRoot == "./" ? "" : $PathToRoot;
    $file_content = preg_replace("/\\{CCS_PathToRoot\\}/is", $Path, $file_content);

    $delimiter = $this->delimiter;
    $tag_sign = $this->tag_sign;
    $begin_block = $this->begin_block;
    $end_block = $this->end_block;
    
    // preparing file content for parsing
    $file_content = preg_replace("/<!\-\-\s+BEGIN\s+([\w\s]*\w+)\s+\-\->/s",  $delimiter . $begin_block . $delimiter . "\\1" . $delimiter, $file_content);
    $file_content = preg_replace("/<!\-\-\s+END\s+([\w\s]*\w+)\s+\-\->/s",  $delimiter . $end_block . $delimiter . "\\1" . $delimiter, $file_content);
    $file_content = preg_replace("/\\{res:\s*(\w+)\\}/ise", "\$CCSLocales->GetText('\\1')", $file_content);
    $file_content = preg_replace("/\\{([a-z_]\w*(:\w+)?)\\}/is", $delimiter . $tag_sign . $delimiter . "\\1" . $delimiter, $file_content);
    $this->parse_array = explode($delimiter, $file_content);
    $this->position = 0;
    $this->length = sizeof($this->parse_array);

    // begin parse
    $block_names[0] = $this->block_path . "/" . $block_name;
    $this->set_block($block_names, false);   
  }

  function set_block($block_names, $is_subblock = true)
  {
    $block_level = sizeof($block_names);
    $block_name = join("/", $block_names);
    if(!strlen($block_name) || substr($block_name,0,1) != "/") 
      $block_name = "/" . $block_name;
    $block_array  = array();
    $block_number = 0; // begin from first block and go on
    $block_array[0] = 0;

    $tag_sign = $this->tag_sign;
    $begin_block = $this->begin_block;
    $end_block = $this->end_block;

    while ($this->position < $this->length) 
    {
      $element_array = $this->parse_array[$this->position];
      if($element_array == $tag_sign)
      {
        $block_number++;
        $block_array[$block_number] = $this->parse_array[$this->position + 1];
        $this->position += 2;
      }
      else if($element_array == $begin_block)
      {
        $block_number++; // increase block number by one
        $block_array[$block_number] = $block_name . "/" . $this->parse_array[$this->position + 1];
        $this->position += 2;
        $block_names[$block_level] = $this->parse_array[$this->position - 1];
        $this->set_block($block_names, true);
      }
      else if($element_array == $end_block && $is_subblock)
      {
        if($this->parse_array[$this->position + 1] == $block_names[$block_level - 1])
        {
          $block_array[0] = $block_number;
          $this->position += 2;
          $this->blocks[$block_name] = $block_array;
          $this->set_keys($block_names);
          return;
        }
        else
        {
          echo "Error in block: $block_name";
          exit;
        }
      }
      else
      {
        $block_number++;
        $block_array[$block_number] = $block_name . "#" . $block_number;
        $this->globals[$block_name . "#" . $block_number] = $element_array;
        $this->position++;
      }
    }
    $block_array[0] = $block_number;
    $this->blocks[$block_name] = $block_array;
    $this->set_keys($block_names);
  }

  function set_keys($block_names)
  {
    $full_block_name = "/" . join("/", $block_names);
    $key = "";
    for($i = sizeof($block_names) - 1; $i >= 0; $i--)
    {
      $key = "/" . $block_names[$i] . $key;
      if(!isset($this->block_keys[$key]))
        $this->block_keys[$key] = $full_block_name;
    }
  }

  function blockexists($block_name)
  {
    $block_name = $this->getname($block_name, true);
    return isset($this->blocks[$block_name]);
  }

  function setvar($key, $value)
  {
    $this->globals[$key] = $value;
  }

  function setblockvar($key, $value)
  {
    $key = $this->getname($key, true);
    $this->globals[$key] = $value;
  }

  function replaceblock($key, $value)
  {
    $key = $this->getname($key, true);
    $this->globals[$key] = $value;
    $this->blocks[$key] = "";
  }

  function getvar($key = "")
  {
    $key = $this->getname($key, false);
    $value = $this->globals[$key];
    return $value;
  }

  function parse($block_name = "", $accumulate = true)
  {
    $this->globalparse($block_name, $accumulate, "");
  }

  function parsesafe($block_name = "", $accumulate = true)
  {
    if($this->blockexists($block_name))
      $this->globalparse($block_name, $accumulate, "");
  }

  function rparse($block_name = "", $accumulate = true)
  {
    $this->globalparse($block_name, $accumulate, "", false, true);
  }

  function parseto($block_name, $accumulate, $parse_to)
  {
    $this->globalparse($block_name, $accumulate, $parse_to);
  }

  function globalparse($block_name, $accumulate = true, $parse_to = "", $output = false, $reverse = false)
  {
    $block_name = $this->getname($block_name, true);

    if($parse_to == "") $parse_to = $block_name;
    else $parse_to = $this->getname($parse_to, true);
    $block_value = "";

    if(isset($this->blocks[$block_name]) && is_array($this->blocks[$block_name]))
    {
      $block_array = $this->blocks[$block_name];
      $globals = $this->globals;
      $array_size = $block_array[0];
      for($i = 1; $i <= $array_size; $i++)
        $block_value .= isset($globals[$block_array[$i]]) ? $globals[$block_array[$i]] : "";
      $left_value = $reverse ? $block_value : "";
      $right_value = $reverse ? "" : $block_value;
      $this->globals[$parse_to] = ($accumulate && isset($this->globals[$parse_to])) ? $left_value . $this->globals[$parse_to] . $right_value : $block_value;
    }
    if($output) {
       $value = isset($this->globals[$block_name]) ? $this->globals[$block_name] : "";
       echo $value;
    }
  }

  function getname($array_key, $is_block)
  {
    $is_block = $is_block ? 1 : 0;
    if (array_key_exists($this->block_path, $this->getname_cache)) {
      if(array_key_exists($array_key, $this->getname_cache[$this->block_path][$is_block])) {
        return $this->getname_cache[$this->block_path][$is_block][$array_key];
      }
    } else {
      $this->getname_cache[$this->block_path] = array(0 => array(), 1 => array());
    }
    $orig_key = $array_key;

    if(strlen($array_key) && substr($array_key, 0, 1) != "/")
      $array_key = "/" . $array_key;

    $searching_array = ($is_block) ? $this->blocks : $this->globals;

    if(strlen($this->block_path))
    {
      if(substr($this->block_path, 0, 1) != "/")
        $this->block_path = "/" . $this->block_path;
      if(substr($this->block_path, strlen($this->block_path) - 1, 1) == "/")
        $this->block_path = substr($this->block_path, 1, strlen($this->block_path) - 1);

      $array_key = strlen($array_key) ? $this->block_path . $array_key : $this->block_path;
    }

    if($is_block && isset($this->block_keys[$array_key]))
    {
      $array_key = $this->block_keys[$array_key];
    }
    else if(!isset($searching_array[$array_key]))
    {
      $finded = 0;
      reset($searching_array);
      while (list($key,) = each($searching_array)) 
      {
        $key_len = strlen($key);
        $array_key_len = strlen($array_key);
        if($key_len >= $array_key_len && substr($key, $key_len - $array_key_len, $array_key_len) == $array_key) 
        {
          $array_key = $key;
          $finded = 1;
          break;
        }
      }
      if (!$finded) $array_key = "";
    }
    $this->getname_cache[$this->block_path][$is_block][$orig_key] = $array_key;
    return $array_key;
  }

  function pparse($block_name, $accumulate = true)
  {
    $this->globalparse($block_name, $accumulate, "", true);
  }

  function print_block($block_name)
  {
    $block_name = $this->getname($block_name, true);
    reset($this->blocks[$block_name]);
    echo "<table border=\"1\">";
    while(list($key, $value) = each($this->blocks[$block_name])) 
    {
      $block_value = isset($this->globals[$value]) ? $this->globals[$value] : "";
      echo "<tr><th valign=top>$value</th><td>" . nl2br(htmlspecialchars($block_value)) . "</td></tr>";
    }
    echo "</table>";
  }

  function print_globals()
  {
    reset($this->globals);
    echo "<table border=\"1\">";
    while(list($key, $value) = each($this->globals)) 
      echo "<tr><th valign=top>$key</th><td>" . nl2br(htmlspecialchars($value)) . "</td></tr>";
    echo "</table>";
  }

}

/*//*/


//End Template class


?>
