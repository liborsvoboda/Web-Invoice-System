<?
include "./config/dbconnect.php";
@$sql = mysql_query("select background_picture,background_mime from company where id='1'");
Header ("Content-type: ".mysql_result($sql,0,1));
print mysql_result($sql,0,0);
?>
