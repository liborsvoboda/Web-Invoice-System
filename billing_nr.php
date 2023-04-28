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
// check and save
if (@$_POST["tlacitko"]){@$_POST["value1"]=str_replace(" ","",@$_POST["value1"]);@$_POST["value2"]=str_replace(" ","",@$_POST["value2"]);@$_POST["value3"]=str_replace(" ","",@$_POST["value3"]);@$_POST["value4"]=str_replace(" ","",@$_POST["value4"]);@$_POST["value5"]=str_replace(" ","",@$_POST["value5"]);
@$_POST["value6"]=str_replace(" ","",@$_POST["value6"]);@$_POST["value7"]=str_replace(" ","",@$_POST["value7"]);@$_POST["value8"]=str_replace(" ","",@$_POST["value8"]);@$_POST["value9"]=str_replace(" ","",@$_POST["value9"]);@$_POST["value10"]=str_replace(" ","",@$_POST["value10"]);
mysql_query("update dph_values set dph1='".securesql(@$_POST["value1"])."',dph2='".securesql(@$_POST["value2"])."',dph3='".securesql(@$_POST["value3"])."',dph4='".securesql(@$_POST["value4"])."',dph5='".securesql(@$_POST["value5"])."',dph6='".securesql(@$_POST["value6"])."',dph7='".securesql(@$_POST["value7"])."',dph8='".securesql(@$_POST["value8"])."',dph9='".securesql(@$_POST["value9"])."',dph10='".securesql(@$_POST["value10"])."',VAT_default='".securesql(@$_POST["default"])."' where id='1' ") or Die(MySQL_Error());
?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("edit_rec",$_SESSION['language']);?> <font color="#E60F2F"><?echo dictionary("dph_setting",$_SESSION['language']);?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?


} // end check and save

$data1=mysql_query("select * from dph_values") or Die(MySQL_Error());?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc><td colspan=2 width=300px><?echo dictionary("dph_setting",$_SESSION['language']);?></td></tr>
<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 1</td>
<td nowrap="nowrap" width=150px><input name="value1" type="text" value="<?if (mysql_result($data1,0,1)<>""){echo mysql_result($data1,0,1);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="1" <?if  (mysql_result($data1,0,11)=="1" or !mysql_result($data1,0,11)){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 2</td>
<td nowrap="nowrap" width=150px><input name="value2" type="text" value="<?if (mysql_result($data1,0,2)<>""){echo mysql_result($data1,0,2);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="2" <?if  (mysql_result($data1,0,11)=="2"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 3</td>
<td nowrap="nowrap" width=150px><input name="value3" type="text" value="<?if (mysql_result($data1,0,3)<>""){echo mysql_result($data1,0,3);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="3" <?if  (mysql_result($data1,0,11)=="3"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 4</td>
<td nowrap="nowrap" width=150px><input name="value4" type="text" value="<?if (mysql_result($data1,0,4)<>""){echo mysql_result($data1,0,4);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="4" <?if  (mysql_result($data1,0,11)=="4"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 5</td>
<td nowrap="nowrap" width=150px><input name="value5" type="text" value="<?if (mysql_result($data1,0,5)<>""){echo mysql_result($data1,0,5);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="5" <?if  (mysql_result($data1,0,11)=="5"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 6</td>
<td nowrap="nowrap" width=150px><input name="value6" type="text" value="<?if (mysql_result($data1,0,6)<>""){echo mysql_result($data1,0,6);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="6" <?if  (mysql_result($data1,0,11)=="6"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 7</td>
<td nowrap="nowrap" width=150px><input name="value7" type="text" value="<?if (mysql_result($data1,0,7)<>""){echo mysql_result($data1,0,7);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="7" <?if  (mysql_result($data1,0,11)=="7"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 8</td>
<td nowrap="nowrap" width=150px><input name="value8" type="text" value="<?if (mysql_result($data1,0,8)<>""){echo mysql_result($data1,0,8);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="8" <?if  (mysql_result($data1,0,11)=="8"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 9</td>
<td nowrap="nowrap" width=150px><input name="value9" type="text" value="<?if (mysql_result($data1,0,9)<>""){echo mysql_result($data1,0,9);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="9" <?if  (mysql_result($data1,0,11)=="9"){echo " checked ";}?> ></td></tr>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("dph",$_SESSION['language']);?> 10</td>
<td nowrap="nowrap" width=150px><input name="value10" type="text" value="<?if (mysql_result($data1,0,10)<>""){echo mysql_result($data1,0,10);}?>" style=width:86%;text-align:center; autocomplete=off ><input name="default" type="radio" value="10" <?if  (mysql_result($data1,0,11)=="10"){echo " checked ";}?> ></td></tr>

<tr id=tablesubmit><td colspan=2>
<input type="submit" name=tlacitko value="<?echo dictionary("btnsavechages",$_SESSION['language']);?>">
</td></tr>

</table></form>





</center></body></html>