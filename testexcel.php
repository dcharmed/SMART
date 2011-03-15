<?php
 
 
echo "<table cellspacing='4' cellpadding='4' border=1 align=center>";
echo"<tr>";
echo"<td>Day</td>";
echo"<td>Time</td>";
echo"<td>Unit</td>";
echo"<td>Lecturer</td>";
echo"</tr>";
 
echo"</table>";
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
header("Content-type: application/octet-stream");
 
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=excelfile.xls");
header("Pragma: no-cache");
header("Expires: 0");
 
 
?> 
 
 
</p>
</body>
</html>