<?
include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");

//session_set_cookie_params(21600);
session_set_cookie_params(strtotime('tomorrow') - time() );
session_start();
session_register("loginname");
session_register("prava");
session_register("language");

?>
<html>
<head>
<title>Sales System</title>
<link rel="icon" href="http://localhost/InfSystem/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://localhost/InfSystem/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


</head>
<body><?echo"<center>".dictionary("please_wait",$_SESSION['language'])."<br />".dictionary("backup_app",$_SESSION['language'])."<br /><img src=./picture/loading1.gif border=0></center>";?>
</body></html>

<script type="text/javascript">
function closew(){
     var ie7 = (document.all && !window.opera && window.XMLHttpRequest) ? true : false;
     if (ie7)
           {
           window.open('','_parent','');
           window.close();
           }     else   {
           this.focus();
           self.opener = this;
           self.close();
           }}

setTimeout(closew,5000);
</script>

<?
$temp=mysql_query("select * from backup where id='1' ") or Die(MySQL_Error());

$bck_db=mysql_result($temp,0,1);
$bck_usr="-u ".mysql_result($temp,0,2);
if (mysql_result($temp,0,3)<>""){$bck_pw="-p ".mysql_result($temp,0,3)." ";} else {$bck_pw="";}

$command = "mysqldump --opt ".$bck_usr." ".$bck_pw." ".$bck_db." > ./backup/Act_backup.sql";
system($command);
full_copy (mysql_result($temp,0,4) , mysql_result($temp,0,5)."/Backup_InfSystem_".date("Y-m-d"));
?>

