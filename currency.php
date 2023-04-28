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
if (@$_REQUEST["del"]) {$rec=mysql_result(mysql_query("select name from currency where id='".@$_REQUEST["del"]."' "),0,0);mysql_query("delete from currency where id='".securesql(@$_REQUEST["del"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("delete_rec",$_SESSION['language'])." ".$rec." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}

// new
if (@$_POST["tlacitko"]==dictionary("btnsave",$_SESSION['language']) && @$_POST["value1a"]){	@$_POST["value1a"]=str_replace("  "," ",@$_POST["value1a"]);@$_POST["value1b"]=str_replace(" ","",@$_POST["value1b"]);
	mysql_query("insert into currency (name,rate,ins_date,ins_name)VALUES('".securesql(@$_POST["value1a"])."','".securesql(@$_POST["value1b"])."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."')") or Die(MySQL_Error());	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("save_new",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1a"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}

// default value
if (@$_REQUEST["def_val"]) {mysql_query("update currency set default_value='off' ");mysql_query("update currency set default_value='on' where id='".securesql(@$_REQUEST["def_val"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("settings",$_SESSION['language'])." ".mysql_result(mysql_query("select name from currency where id='".securesql(@$_REQUEST["def_val"])."' "),0,0)." ".dictionary("as_default",$_SESSION['language'])." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}


?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post action=./currency.php enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc>
<td colspan=4><?echo dictionary("add_currency",$_SESSION['language']);?></td>
</tr>



<tr id=tabledata>
<td nowrap="nowrap" colspan=2><input name="value1a" type="text" value="<?echo @mysql_result($data1,0,1);?>"  style=text-align:center;width:100px; autocomplete=off ></td>
<td nowrap="nowrap" colspan=2><input name="value1b" type="text" value="<?echo @mysql_result($data1,0,2);?>"  style=text-align:center;width:80px; autocomplete=off ></td>
</tr>

<tr id=tablesubmit><td colspan=4><br />
<input type="submit" name=tlacitko value="<?echo dictionary("btnsave",$_SESSION['language']);?>">
</td></tr>

<tr id=tablesearch>
<td colspan=4 style=text-align:center><br /><?echo dictionary("currency_view",$_SESSION['language']);?></td></tr>
<tr id=tabledesc>
<td><?echo dictionary("act",$_SESSION['language']);?></td>
<td><?echo dictionary("currency",$_SESSION['language']);?></td>
<td colspan=2><?echo dictionary("rate",$_SESSION['language']);?></td>
</tr>

<?
$data1=mysql_query("select * from currency") or Die(MySQL_Error());
$cykl=0;while(mysql_result($data1,$cykl,0)):

echo"<tr id=tabledata><td nowrap=nowrap>";
?>
<img src=picture/delete.png width="20" alt="<?echo dictionary("delete_rec",$_SESSION['language']);?>" border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).mysql_result($data1,$cykl,1)." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?del=<?echo mysql_result($data1,$cykl,0);?>');">
<?
echo"</td>
<td nowrap=nowrap>".mysql_result($data1,$cykl,1)."</td><td nowrap=nowrap>".mysql_result($data1,$cykl,2)."</td><td><input type=radio value=on ";if (mysql_result($data1,$cykl,3)=="on"){echo" checked ";}

?> title='<?echo dictionary("default_set",$_SESSION['language']);?>' ondblclick="if(confirm('<?echo dictionary("settings",$_SESSION['language'])." ".mysql_result($data1,$cykl,1)." ".dictionary("as_default",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?def_val=<?echo mysql_result($data1,$cykl,0);?>');"<?

echo"></td>";
$cykl++;endwhile;

?>


</table></form>





</center></body></html>