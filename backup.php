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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="./css/default.css" />

<?
include ("./library/javascript/knihovnajs_iframe.php");
?>
</head>

<?

// update
if (@$_POST["tlacitko"]==dictionary("btnsave",$_SESSION['language'])){
	mysql_query("update backup set db_name='".securesql(@$_POST["value1"])."',db_user='".securesql(@$_POST["value2"])."',db_password='".securesql(@$_POST["value3"])."',source_folder='".securesql(@$_POST["value4"])."',target_folder='".securesql(@$_POST["value5"])."',ins_date='".securesql($dnest)."',ins_name='".securesql($_SESSION['loginname'])."' where id='1' ") or Die(MySQL_Error());	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("settings",$_SESSION['language'])." ".dictionary("backup",$_SESSION['language'])." ".dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}


?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post action=./backup.php enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc>
<td colspan=3><?echo dictionary("settings",$_SESSION['language'])." ".dictionary("backup",$_SESSION['language']);?></td>
</tr>

<?
$data1=mysql_query("select * from backup") or Die(MySQL_Error());
?>

<tr id=tabledata><td><?echo dictionary("db_name",$_SESSION['language']);?></td>
<td nowrap="nowrap" ><input name="value1" type="text" value="<?echo @mysql_result($data1,0,1);?>"  style=text-align:center;width:300px; autocomplete=off ></td></tr>

<tr id=tabledata><td><?echo dictionary("db_user",$_SESSION['language']);?></td>
<td nowrap="nowrap" ><input name="value2" type="text" value="<?echo @mysql_result($data1,0,2);?>"  style=text-align:center;width:300px; autocomplete=off ></td></tr>

<tr id=tabledata><td><?echo dictionary("db_password",$_SESSION['language']);?></td>
<td nowrap="nowrap" ><input name="value3" type="text" value="<?echo @mysql_result($data1,0,3);?>"  style=text-align:center;width:300px; autocomplete=off ></td></tr>

<tr id=tabledata><td><?echo dictionary("source_folder",$_SESSION['language']);?></td>
<td nowrap="nowrap" ><input name="value4" type="text" value="<?echo @mysql_result($data1,0,4);?>"  style=text-align:center;width:300px; autocomplete=off ></td></tr>

<tr id=tabledata><td><?echo dictionary("target_folder",$_SESSION['language']);?></td>
<td nowrap="nowrap" ><input name="value5" type="text" value="<?echo @mysql_result($data1,0,5);?>"  style=text-align:center;width:300px; autocomplete=off ></td></tr>


<tr id=tablesubmit><td colspan=3><br />
<input type="submit" name=tlacitko value="<?echo dictionary("btnsave",$_SESSION['language']);?>">
</td></tr>




</table></form>





</center></body></html>