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

<?// check and save
$rooturl=explode("?",$_SERVER["REQUEST_URI"]);

// delete user
if (@$_REQUEST["del"]) {mysql_query("delete from login where loginname='".securesql(@$_REQUEST["del"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("delete_rec",$_SESSION['language'])." ".@$_REQUEST["del"]." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}


if (@$_POST["tlacitko"] && @$_POST["value1"] && @$_POST["value2"]){$control=mysql_query("select id from login where loginname='".securesql(@$_REQUEST["search"])."' ") or Die(MySQL_Error());

	$count=mysql_result(mysql_query("SELECT COUNT(*) FROM menu"),0,0)+mysql_result(mysql_query("SELECT COUNT(*) FROM submenu"),0,0);
	$rights=",";$cykl=0;while($cykl<$count):if (@$_POST["right".$cykl]){$rights.=@$_POST["right".$cykl].",";}$cykl++;endwhile;

// update
if (mysql_num_rows($control)){	// without psw
	if (@$_POST["value2"]==dictionary("unchanged",$_SESSION['language'])){mysql_query("update login set loginname='".securesql(@$_POST["value1"])."',rights='".securesql($rights)."',name='".securesql(@$_POST["value3"])."',surname='".securesql(@$_POST["value4"])."',language='".securesql(@$_POST["value5"])."' where id='".mysql_result($control,0,0)."' ") or Die(MySQL_Error());}
	// with psw
	if (@$_POST["value2"]<>dictionary("unchanged",$_SESSION['language'])){mysql_query("update login set loginname='".securesql(@$_POST["value1"])."',loginpass=MD5('".securesql(@$_POST["value2"])."'),rights='".securesql($rights)."',name='".securesql(@$_POST["value3"])."',surname='".securesql(@$_POST["value4"])."',language='".securesql(@$_POST["value5"])."' where id='".mysql_result($control,0,0)."' ") or Die(MySQL_Error());}
	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("edit_rec",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}
  // new
  else {mysql_query("insert into login (loginname,loginpass,rights,name,surname,language)VALUES('".securesql(@$_POST["value1"])."',MD5('".securesql(@$_POST["value2"])."'),'".securesql($rights)."','".securesql(@$_POST["value3"])."','".securesql(@$_POST["value4"])."','".securesql(@$_POST["value5"])."') ") or Die(MySQL_Error());
  	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("save_new",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
  }

}

// end check and save
?>


<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><center>
<form method=post action=./administration.php enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc><td colspan=2 width=350px><?echo dictionary("administration",$_SESSION['language']);?></td></tr>
<tr id=tablesearch>
<td nowrap="nowrap" width=150px><?echo dictionary("selection",$_SESSION['language']);?><?if (@$_REQUEST["search"]<>dictionary("new_user",$_SESSION['language']) && @$_REQUEST["search"]) {?><div style=position:absolute;><div style=position:relative;left:90px;top:0x;><img src=picture/delete.png width="20" alt="<?echo dictionary("delete_rec",$_SESSION['language']);?>" border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).$_REQUEST["search"]." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?del=<?echo $_REQUEST["search"];?>');"></div></div><?}?></td>
<td nowrap="nowrap" width=200px><select name="search" onchange=submit(this) style=width:100%;text-align:center; >
<?$temp=mysql_query("select loginname from login order by loginname") or Die(MySQL_Error());
@$cykl=0;while(mysql_result($temp,$cykl,0)):

if (@$cykl==0){echo"<option"; if (@$_REQUEST["search"]){echo " disabled ";}echo"></option>";}
if (@$cykl==0){echo"<option"; if (@$_REQUEST["search"]==dictionary("new_user",$_SESSION['language'])){echo " selected ";}echo">".dictionary("new_user",$_SESSION['language'])."</option>";}

echo "<option"; if (@$_REQUEST["search"]==mysql_result($temp,$cykl,0)){echo " selected ";}echo">".mysql_result($temp,$cykl,0)."</option>";
@$cykl++;endwhile;

?></select>

</td>
</tr>

<?
if (@$_REQUEST["search"]<>dictionary("new_user",$_SESSION['language']) && @$_REQUEST["search"]){$data1=mysql_query("select * from login where loginname='".securesql(@$_REQUEST["search"])."' ") or Die(MySQL_Error());}
?>

<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("username",$_SESSION['language']);?></td>
<td nowrap="nowrap" width=200px><input name="value1" type="text" value="<?echo mysql_result($data1,0,1);?>" style=width:100%;text-align:center; <?if (!@$_REQUEST["search"]){echo" disabled ";}?> autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("syspassw",$_SESSION['language']);?></td>
<td nowrap="nowrap" width=200px><input name="value2" type="text" value="<?if (@$_REQUEST["search"]<>dictionary("new_user",$_SESSION['language']) && @$_REQUEST["search"]){echo dictionary("unchanged",$_SESSION['language']);}?>" style=width:100%;text-align:center; <?if (!@$_REQUEST["search"]){echo" disabled ";}?> autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("sysname",$_SESSION['language']);?></td>
<td nowrap="nowrap" width=200px><input name="value3" type="text" value="<?echo mysql_result($data1,0,5);?>" style=width:100%;text-align:center; <?if (!@$_REQUEST["search"]){echo" disabled ";}?> autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("surname",$_SESSION['language']);?></td>
<td nowrap="nowrap" width=200px><input name="value4" type="text" value="<?echo mysql_result($data1,0,6);?>" style=width:100%;text-align:center; <?if (!@$_REQUEST["search"]){echo" disabled ";}?> autocomplete=off ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" width=150px><?echo dictionary("language",$_SESSION['language']);?></td>
<td nowrap="nowrap" width=200px><select name="value5" style=width:100%;text-align:center; <?if (!@$_REQUEST["search"]){echo" disabled ";}?> >
<?$temp=mysql_query("SHOW COLUMNS FROM dictionary") or Die(MySQL_Error());

@$cykl=2;while(mysql_result($temp,($cykl+1),0)):
echo "<option ";if (@$_REQUEST["search"]<>dictionary("new_user",$_SESSION['language']) && @$_REQUEST["search"] && mysql_result($data1,0,7)==mysql_result($temp,$cykl,0)){echo " selected ";}echo">".mysql_result($temp,$cykl,0)."</option>";
@$cykl++;endwhile;

?></select>
</td>
</tr>

<tr id=tabledesc><td colspan=2 width=350px><?echo dictionary("rights",$_SESSION['language']);?></td></tr>

<tr id=tabledata><td colspan=2 width=350px><table style=width:100% border="0" cellpadding="0" cellspacing="0"><tr>
<?

$data2=mysql_query("select * from menu order by position") or Die(MySQL_Error());
$circle=1;@$cykl=0;while($cykl<mysql_num_rows($data2) or ($cykl/5)<>round(($cykl/5),0)):

if (($cykl/5)==round(($cykl/5),0) && $cykl>0){echo"</tr><tr>";}


if (@$_GET["sel"]==mysql_result(@$data2,@$cykl,0) && @$_GET["sel"]){$click="&sel=on";} else {$click="";}
if ($click=="" && $cykl==0 & @$_GET["sel"]==""){@$_GET["sel"]=mysql_result(@$data2,@$cykl,0);$click="&sel=on";}

echo"<td><img";
if (mysql_result(@$data2,@$cykl,0)){echo" style=cursor:pointer onclick=\"window.location.assign('./administration.php?sel=".mysql_result(@$data2,@$cykl,0)."&search=".@$_REQUEST["search"]."')\" ";}
echo" src=./adm_zalozka.php?name=".sifra(dictionary(mysql_result(@$data2,@$cykl,2),$_SESSION['language'])).$click."  border=0>";

if(mysql_result(@$data2,@$cykl,4)){
echo"<div style=position:absolute;><div style=position:relative;left:-11px;top:6px;>
<input name=right".($circle++)." style=width:10px; type=checkbox value='".mysql_result(@$data2,@$cykl,4)."' ";if (StrPos (" " . mysql_result($data1,0,3), ",".mysql_result(@$data2,@$cykl,4).",")){echo " checked ";}if (!@$_REQUEST["search"]){echo" disabled ";}echo">
</div></div>";}

echo"</td>";

$cykl++;endwhile;?></tr></table></td></tr>

<?

$data3=mysql_query("select * from submenu where menu_id='".securesql(@$_GET["sel"])."'order by position") or Die(MySQL_Error());
$cykl1=0;while(mysql_result(@$data3,@$cykl1,0)):
    if (!mysql_result(@$data3,@$cykl1,5)){echo "<tr id=tabledata><td nowrap=nowrap>".dictionary(mysql_result(@$data3,@$cykl1,3),$_SESSION['language'])."</td></tr>";}
    if (mysql_result(@$data3,@$cykl1,5)){echo "<tr id=tablesearch><td nowrap=nowrap>".dictionary(mysql_result(@$data3,@$cykl1,3),$_SESSION['language'])."</td><td nowrap=nowrap width=200px><input name=right".($circle++)." type=checkbox value='".mysql_result(@$data3,@$cykl1,5)."' ";if (StrPos (" " . mysql_result($data1,0,3), ",".mysql_result(@$data3,@$cykl1,5).",")){echo " checked ";}if (!@$_REQUEST["search"]){echo" disabled ";}echo"></td></tr>";}
	@$cykl1++;endwhile;


$otherrights=mysql_query("select * from submenu where menu_id<>'".securesql(@$_GET["sel"])."'order by position") or Die(MySQL_Error());
$cykl=0;while(@$cykl<mysql_num_rows($otherrights)):
echo "<input name=right".($circle++)." type=hidden value='";if (StrPos (" " . mysql_result($data1,0,3), ",".mysql_result(@$otherrights,@$cykl,5).",")) {echo mysql_result(@$otherrights,@$cykl,5);}echo"'>";
@$cykl++;endwhile;

?>

<?if (@$_REQUEST["search"]){?><tr id=tablesubmit><td colspan=2>
<input type="submit" name=tlacitko value="<?if (@$_REQUEST["search"]<>dictionary("new_user",$_SESSION['language']) && @$_REQUEST["search"]){echo dictionary("btnsavechages",$_SESSION['language']);} else {echo dictionary("btnsave",$_SESSION['language']);}?>">
</td></tr><?}?>

</table></form>





</center></body></html>