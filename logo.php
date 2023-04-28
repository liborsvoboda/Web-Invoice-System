<?
include "./config/dbconnect.php";
@$sql = mysql_query("select logo_picture,logo_mime from company where id='1'");
Header ("Content-type: ".mysql_result($sql,0,1));
print mysql_result($sql,0,0);
?>
