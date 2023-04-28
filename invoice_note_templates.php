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

// delete not
if (@$_REQUEST["del"]) {$rec=mysql_result(mysql_query("select name from invoice_templates where id='".@$_REQUEST["del"]."' "),0,0);mysql_query("delete from invoice_templates where id='".securesql(@$_REQUEST["del"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("delete_rec",$_SESSION['language'])." ".$rec." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}

// new note
if (@$_POST["tlacitko"]==dictionary("btnsave",$_SESSION['language']) && @$_POST["value1a"]){	@$_POST["value1a"]=str_replace("  "," ",@$_POST["value1a"]);
	mysql_query("insert into invoice_templates (name,ins_date,ins_name)VALUES('".securesql(@$_POST["value1a"])."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."')") or Die(MySQL_Error());	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("save_new",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1a"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}


?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><center>
<form method=post action=./invoice_note_templates.php enctype="multipart/form-data">

<table id=export_excel border=2 style=width:518px;>
<tr id=tabledesc>
<td colspan=2><?echo dictionary("invoice_note_templates",$_SESSION['language']);?></td>
</tr>

<tr id=tabledata>
<td nowrap="nowrap" colspan=2><textarea name="value1a" rows=4 style=width:100%;overflow:auto wrap=off></textarea></td>
</tr>

<tr id=tablesubmit><td colspan=2><br />
<input type="submit" name=tlacitko value="<?echo dictionary("btnsave",$_SESSION['language']);?>">
</td></tr>

<tr id=tablesearch>
<td colspan=2 style=text-align:center><br /><?echo dictionary("invoice_note_templates_view",$_SESSION['language']);?></td></tr>
<tr id=tabledesc>
<td width=30px colspan=2><?echo dictionary("act",$_SESSION['language']);?></td>
</tr>

<?
$data1=mysql_query("select * from invoice_templates") or Die(MySQL_Error());
$cykl=0;while(mysql_result($data1,$cykl,0)):

echo"<tr id=tabledata><td width=30px nowrap=nowrap>";

$radky=explode("\n",mysql_result($data1,$cykl,1));$write=str_replace("\r","",$radky[0]);
?>
<img src=picture/delete.png width="20" alt="<?echo dictionary("delete_rec",$_SESSION['language']);?>" border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).$write." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?del=<?echo mysql_result($data1,$cykl,0);?>');">
<?
echo"</td><td width=488px nowrap=nowrap><textarea rows=3 style=width:100%;overflow:auto wrap=off disabled >".mysql_result($data1,$cykl,1)."</textarea></td>";
$cykl++;endwhile;

?>


</table></form>





</center></body></html>