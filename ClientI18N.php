<?php
        
//Client @0-0C6F9A9D
define("RelativePath", ".");
define("PathToCurrentPage", "");
define("FileName", "");
include(RelativePath . "/Common.php");
$ClientFileEncoding = "UTF-8";
$AllowedFiles = array(
    "/^DatePicker\\.js$/" => "content-type: text/javascript; charset=$ClientFileEncoding",
    "/^Functions\\.js$/" => "content-type: text/javascript; charset=$ClientFileEncoding",
    "/^[\\w\\/]+_events\\.js$/" => "content-type: text/javascript; charset=$ClientFileEncoding"
);
$file = CCGetFromGet("file");
foreach ($AllowedFiles as $FileMask => $FileType) {
    if (preg_match($FileMask, $file)) {
        $file_content = "";
        $file_path = RelativePath . "/" . $file;
        if (file_exists($file_path)) {
            $fh = fopen($file_path, "rb");
            if (filesize($file_path))
                $file_content = fread($fh, filesize($file_path));
            fclose($fh);
            $file_content = preg_replace("/\\{res:\s*(\w+)\\}/ise", "CCConvertEncoding(\$CCSLocales->GetText('\\1'), \$FileEncoding, \$ClientFileEncoding)", $file_content);
        }
            header($FileType);
        echo $file_content;
        exit;
    }
}
//End Client


?>
