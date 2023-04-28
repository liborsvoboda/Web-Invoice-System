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



<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc><td colspan=2><?echo dictionary("company",$_SESSION['language']);?></td></tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("company_name",$_SESSION['language']);?></td>
<td nowrap="nowrap"><input name="value1" type="text" value="<?echo mysql_result($data1,0,1);?>" style=width:100%;text-align:center; ></td>
</tr>

<tr id=tablesubmit><td colspan=2>
<input type="submit" name=tlacitko value="<?echo dictionary("btnsavechages",$_SESSION['language']);?>">
</td></tr>

</table></form>





</center></body></html>