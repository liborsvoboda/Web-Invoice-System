<?
include ("./"."dbconnect.php");
$data10 = mysql_query("select icon,mime_type from menu where id='".base64_decode(@$_GET["id"])."'");
Header ("Content-type: mysql_result($data10,0,1)");
print mysql_result($data10,0,0).".jpg";
?>
