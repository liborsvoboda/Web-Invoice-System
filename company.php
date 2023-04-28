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
if (@$_REQUEST["dlogo"]) {mysql_query("update company set logo_picture='',logo_mime='' where id='1'");}
if (@$_REQUEST["dback"]) {mysql_query("update company set background_picture='',background_mime='' where id='1'");}

$rooturl=explode("?",$_SERVER["REQUEST_URI"]);

if (@$_POST["tlacitko"]){
@$docasny = @$_FILES['value14']['tmp_name']; @$mlogo = @$_FILES['value14']['type'];@$logo = implode('', file("$docasny"));
@$docasny = @$_FILES['value15']['tmp_name']; @$mbackground = @$_FILES['value15']['type'];@$background = implode('', file("$docasny"));

if ($mlogo && $mbackground){mysql_query("update company set name='".securesql(@$_POST["value1"])."',street='".securesql(@$_POST["value2"])."',city='".securesql(@$_POST["value3"])."',psc='".securesql(@$_POST["value4"])."',ico='".securesql(@$_POST["value5"])."',dic='".securesql(@$_POST["value6"])."',bank_code='".securesql(@$_POST["value7"])."',account='".securesql(@$_POST["value8"])."',contact_name='".securesql(@$_POST["value9"])."',mobile='".securesql(@$_POST["value10"])."',telephone='".securesql(@$_POST["value11"])."',fax='".securesql(@$_POST["value12"])."',email='".securesql(@$_POST["value13"])."',logo_picture='".mysql_escape_string(@$logo)."',logo_mime='".securesql(@$mlogo)."',background_picture='".mysql_escape_string(@$background)."',background_mime='".securesql(@$mbackground)."',color='".securesql(@$_POST["value16"])."',act_server='".securesql(@$_POST["value17"])."',constant_symbol='".securesql(@$_POST["value18"])."',variable_symbol='".securesql(@$_POST["value19"])."' where id='1' ") or Die(MySQL_Error());}
if ($mlogo && !$mbackground){mysql_query("update company set name='".securesql(@$_POST["value1"])."',street='".securesql(@$_POST["value2"])."',city='".securesql(@$_POST["value3"])."',psc='".securesql(@$_POST["value4"])."',ico='".securesql(@$_POST["value5"])."',dic='".securesql(@$_POST["value6"])."',bank_code='".securesql(@$_POST["value7"])."',account='".securesql(@$_POST["value8"])."',contact_name='".securesql(@$_POST["value9"])."',mobile='".securesql(@$_POST["value10"])."',telephone='".securesql(@$_POST["value11"])."',fax='".securesql(@$_POST["value12"])."',email='".securesql(@$_POST["value13"])."',logo_picture='".mysql_escape_string(@$logo)."',logo_mime='".securesql(@$mlogo)."',color='".securesql(@$_POST["value16"])."',act_server='".securesql(@$_POST["value17"])."',constant_symbol='".securesql(@$_POST["value18"])."',variable_symbol='".securesql(@$_POST["value19"])."' where id='1' ") or Die(MySQL_Error());}
if (!$mlogo && $mbackground){mysql_query("update company set name='".securesql(@$_POST["value1"])."',street='".securesql(@$_POST["value2"])."',city='".securesql(@$_POST["value3"])."',psc='".securesql(@$_POST["value4"])."',ico='".securesql(@$_POST["value5"])."',dic='".securesql(@$_POST["value6"])."',bank_code='".securesql(@$_POST["value7"])."',account='".securesql(@$_POST["value8"])."',contact_name='".securesql(@$_POST["value9"])."',mobile='".securesql(@$_POST["value10"])."',telephone='".securesql(@$_POST["value11"])."',fax='".securesql(@$_POST["value12"])."',email='".securesql(@$_POST["value13"])."',background_picture='".mysql_escape_string(@$background)."',background_mime='".securesql(@$mbackground)."',color='".securesql(@$_POST["value16"])."',act_server='".securesql(@$_POST["value17"])."',constant_symbol='".securesql(@$_POST["value18"])."',variable_symbol='".securesql(@$_POST["value19"])."' where id='1' ") or Die(MySQL_Error());}
if (!$mlogo && !$mbackground){mysql_query("update company set name='".securesql(@$_POST["value1"])."',street='".securesql(@$_POST["value2"])."',city='".securesql(@$_POST["value3"])."',psc='".securesql(@$_POST["value4"])."',ico='".securesql(@$_POST["value5"])."',dic='".securesql(@$_POST["value6"])."',bank_code='".securesql(@$_POST["value7"])."',account='".securesql(@$_POST["value8"])."',contact_name='".securesql(@$_POST["value9"])."',mobile='".securesql(@$_POST["value10"])."',telephone='".securesql(@$_POST["value11"])."',fax='".securesql(@$_POST["value12"])."',email='".securesql(@$_POST["value13"])."',color='".securesql(@$_POST["value16"])."',act_server='".securesql(@$_POST["value17"])."',constant_symbol='".securesql(@$_POST["value18"])."',variable_symbol='".securesql(@$_POST["value19"])."' where id='1' ") or Die(MySQL_Error());}

?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("edit_rec",$_SESSION['language']);?> <font color="#E60F2F"><?echo dictionary("company",$_SESSION['language']);?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?


} // end check and save

?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post action=./company.php enctype="multipart/form-data">

<?$data1=mysql_query("select * from company") or Die(MySQL_Error());?>

<table id=export_excel border=2>
<tr id=tabledesc><td colspan=4><?echo dictionary("company",$_SESSION['language']);?></td></tr>

<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("company_name",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3><input name="value1" type="text" value="<?echo mysql_result($data1,0,1);?>" style=width:100%;text-align:center; autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("street",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3><input name="value2" type="text" value="<?echo mysql_result($data1,0,2);?>" style=width:100%;text-align:cengter; autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("city",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3 align=left><input name="value3" type="text" value="<?echo mysql_result($data1,0,3);?>" style=width:70%;text-align:center; autocomplete=off ><input name="value4" type="text" value="<?echo mysql_result($data1,0,4);?>" style=width:30%;text-align:center; autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("ico",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value5" type="text" value="<?echo mysql_result($data1,0,5);?>" style=width:190px;text-align:center; autocomplete=off></td>
<td nowrap="nowrap"><?echo dictionary("dic",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value6" type="text" value="<?echo mysql_result($data1,0,6);?>" style=width:190px;text-align:center; autocomplete=off></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("bank_account_full",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3 align=left><input name="value7" type="text" value="<?echo mysql_result($data1,0,7);?>" style=width:20%;text-align:center; autocomplete=off><input name="value8" type="text" value="<?echo mysql_result($data1,0,8);?>" style=width:80%;text-align:center; autocomplete=off></td>
</tr>

<tr id=tabledata><td><?echo dictionary("contact_person",$_SESSION['language']);?></td><td nowrap="nowrap"><input name="value9" type="text" value="<?echo mysql_result($data1,0,9);?>" style=width:100%;text-align:center; autocomplete=off></td>
<td align=right><?echo dictionary("mobile_phone",$_SESSION['language']);?></td><td nowrap="nowrap" align=left><input name="value10" type="text" value="<?echo mysql_result($data1,0,10);?>" style=width:100%;text-align:center; autocomplete=off></td>
</tr>

<tr id=tabledata><td><?echo dictionary("contacts",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3>
<input name="value11" type="text" value="<?echo mysql_result($data1,0,11);?>" style=width:33%;text-align:center; autocomplete=off><input name="value12" type="text" value="<?echo mysql_result($data1,0,12);?>" style=width:33%;text-align:center; autocomplete=off><input name="value13" type="text" value="<?echo mysql_result($data1,0,13);?>" style=width:34%;text-align:center; autocomplete=off>
</td>
</tr>
<tr id=tabledata><td><?echo dictionary("const_var_symbol",$_SESSION['language']);?></td>
<td nowrap="nowrap" colspan=3>
<input name="value18" type="text" value="<?echo mysql_result($data1,0,20);?>" style=width:50%;text-align:center; autocomplete=off><input name="value19" type="text" value="<?echo mysql_result($data1,0,21);?>" style=width:50%;text-align:center; autocomplete=off>
</td>
</tr>

<tr id=tabledesc><td colspan=4><?echo dictionary("system_settings",$_SESSION['language']);?></td></tr>

<tr id=tabledata><td><?if (mysql_result(@$data1,0,15)) {?><img src=picture/delete.png width="20" height="20" alt="<?echo dictionary("delete",$_SESSION['language'])." ".dictionary("logo",$_SESSION['language']);?>" align=left border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).dictionary("logo",$_SESSION['language'])." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?dlogo=yes');"><?}?>
<?echo dictionary("logo",$_SESSION['language']);?></td>
<td colspan=3><input type="file" name=value14 value="" style=width:100%></td>
</tr>

<tr id=tabledata><td><?if (mysql_result(@$data1,0,17)) {?><img src=picture/delete.png width="20" height="20" alt="<?echo dictionary("delete",$_SESSION['language'])." ".dictionary("background",$_SESSION['language']);?>" align=left border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).dictionary("background",$_SESSION['language'])." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?dback=yes');"><?}?>
<?echo dictionary("background",$_SESSION['language']);?></td>
<td colspan=2><input type="file" name=value15 value="" style=width:100%></td>
<td align=right><?@$_POST["value16"]=mysql_result(@$data1,0,18);include "./library/php/color.php";?></td>
</tr>

<tr id=tabledata><td><?echo dictionary("act_server",$_SESSION['language']);?></td>
<td colspan=3><input name="value17" type="text" value="<?echo mysql_result($data1,0,19);?>" style=width:100% autocomplete=off></td>
</tr>

<tr id=tablesubmit><td colspan=4>
<input type="submit" name=tlacitko value="<?echo dictionary("btnsavechages",$_SESSION['language']);?>">
</td></tr>

</table></form>





</center></body></html>