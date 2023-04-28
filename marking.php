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
if (@$_REQUEST["del"]) {$rec=mysql_result(mysql_query("select CONCAT(inv_index,' ',value) from invoice_mark where id='".@$_REQUEST["del"]."' "),0,0);mysql_query("delete from invoice_mark where id='".securesql(@$_REQUEST["del"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("delete_rec",$_SESSION['language'])." ".$rec." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}

// new
if (@$_POST["tlacitko"]==dictionary("btnsave",$_SESSION['language']) && @$_POST["value1a"] && @$_POST["value1b"]<>"" && @$_POST["value1c"] && @$_POST["value1d"]){mysql_query("insert into invoice_mark (inv_index,value,start_date,end_date,ins_date,ins_name)VALUES('".securesql(@$_POST["value1a"])."','".securesql(@$_POST["value1b"])."','".securesql(datedb(@$_POST["value1c"]))."','".securesql(datedb(@$_POST["value1d"]))."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."')") or Die(MySQL_Error());	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("save_new",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1a"].@$_POST["value1b"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}
// edit
if (@$_POST["tlacitko"]==dictionary("btnsavechages",$_SESSION['language']) && @$_POST["value1a"] && @$_POST["value1b"]<>"" && @$_POST["value1c"] && @$_POST["value1d"]){	mysql_query("update invoice_mark set inv_index='".securesql(@$_POST["value1a"])."',value='".securesql(@$_POST["value1b"])."',start_date='".securesql(datedb(@$_POST["value1c"]))."',end_date='".securesql(datedb(@$_POST["value1d"]))."',edit_date='".securesql($dnest)."',edit_name='".securesql($_SESSION['loginname'])."' where id='".securesql(@$_POST["value1"])."' ") or Die(MySQL_Error());
	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("edit_rec",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1a"].@$_POST["value1b"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?
}

?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post action=./marking.php enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc>
<td colspan=2><?if (!@$_REQUEST["edit"]){echo dictionary("new_marking_invoice",$_SESSION['language']);} else{echo dictionary("edit_marking_invoice",$_SESSION['language']);}?></td>
<td><?echo dictionary("start_date",$_SESSION['language']);?></td>
<td><?echo dictionary("end_date",$_SESSION['language']);?></td>
</tr>

<?// load for edit
if (@$_REQUEST["edit"]){	$data1=mysql_query("select * from invoice_mark where id='".securesql(@$_REQUEST["edit"])."' ") or Die(MySQL_Error());
	?><input name="value1" type="hidden" value="<?echo mysql_result($data1,0,0);?>" >
<?}?>


<tr id=tabledata>
<td nowrap="nowrap" colspan=2><input name="value1a" type="text" value="<?echo @mysql_result($data1,0,1);?>" size=17 style=text-align:center; autocomplete=off ><input name="value1b" type="text" value="<?if (@$_REQUEST["edit"]){echo @mysql_result($data1,0,2);} else {echo "0";}?>" style=width:60px;text-align:center; autocomplete=off ></td>
<td nowrap="nowrap">
<input type="text" name="value1c" value="<?echo datecs(@mysql_result($data1,0,3));?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendar(form.value1c,'span_value1c','cpokus');" style=width:50px; >
<div style=position:relative;top:0px;left:-68px; ><div style=position:absolute><SPAN ID="span_value1c"></div>
</td>
<td nowrap="nowrap">
<input type="text" name="value1d" value="<?echo datecs(@mysql_result($data1,0,4));?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendar(form.value1d,'span_value1d','cpokus');" style=width:50px; >
<div style=position:relative;top:0px;left:-68px; ><div style=position:absolute><SPAN ID="span_value1d"></div>
</td>
</tr>

<tr id=tablesubmit><td colspan=4><br />
<input type="submit" name=tlacitko value="<?if (!@$_REQUEST["edit"]){echo dictionary("btnsave",$_SESSION['language']);} else {echo dictionary("btnsavechages",$_SESSION['language']);}?>">
</td></tr>

<tr id=tablesearch>
<td colspan=4 style=text-align:center><br /><?echo dictionary("exist_marking_invoice",$_SESSION['language']);?></td></tr>
<tr id=tabledesc>
<td><?echo dictionary("act",$_SESSION['language']);?></td>
<td><?echo dictionary("marking_invoice",$_SESSION['language']);?></td>
<td><?echo dictionary("start_date",$_SESSION['language']);?></td>
<td><?echo dictionary("end_date",$_SESSION['language']);?></td>
</tr>

<?
$data1=mysql_query("select * from invoice_mark order by start_date DESC") or Die(MySQL_Error());
$cykl=0;while(mysql_result($data1,$cykl,0)):

echo"<tr id=tabledata><td nowrap=nowrap>";
?>
<img src=picture/delete.png width="20" alt="<?echo dictionary("delete_rec",$_SESSION['language']);?>" border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("delete_record_note",$_SESSION['language']).mysql_result($data1,$cykl,1).mysql_result($data1,$cykl,2)." ".dictionary("delete",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?del=<?echo mysql_result($data1,$cykl,0);?>');">
<img src=picture/edit.png width="20" alt="<?echo dictionary("edit_rec",$_SESSION['language']);?>" border="0" style="cursor: pointer;" onClick="if(confirm('<?echo dictionary("edit_rec",$_SESSION['language'])." ".mysql_result($data1,$cykl,1).mysql_result($data1,$cykl,2)." ?";?>')) window.location.href('<?echo $rooturl[0];?>?edit=<?echo mysql_result($data1,$cykl,0);?>');">
<?
echo"</td>
<td nowrap=nowrap>".mysql_result($data1,$cykl,1).mysql_result($data1,$cykl,2)."</td>
<td nowrap=nowrap>".datecs(mysql_result($data1,$cykl,3))."</td>
<td nowrap=nowrap>".datecs(mysql_result($data1,$cykl,4))."</td>";
$cykl++;endwhile;

?>


</table></form>





</center></body></html>