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

// change settings for print cash voucher
if (@$_REQUEST["set_cash"]) {$currentset=mysql_result(mysql_query("select cash_voucher from payment_method where id='".securesql(@$_REQUEST["set_cash"])."'"),0,0);	if ($currentset=="on"){$currentset="off";}else {$currentset="on";}
	mysql_query("update payment_method set cash_voucher='".$currentset."' where id='".securesql(@$_REQUEST["set_cash"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("change_setting_for",$_SESSION['language'])." ".dictionary(mysql_result(mysql_query("select name from payment_method where id='".securesql(@$_REQUEST["set_cash"])."' "),0,0),$_SESSION['language'])." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}

// default value
if (@$_REQUEST["def_val"]) {mysql_query("update payment_method set default_value='off' ");mysql_query("update payment_method set default_value='on' where id='".securesql(@$_REQUEST["def_val"])."' ");?><script LANGUAGE="JavaScript">alert('<?echo dictionary("settings",$_SESSION['language'])." ".dictionary(mysql_result(mysql_query("select name from payment_method where id='".securesql(@$_REQUEST["def_val"])."' "),0,0),$_SESSION['language'])." ".dictionary("as_default",$_SESSION['language'])." ".dictionary("runsuccess",$_SESSION['language']);?>');</script><?}

?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><p><br /></p><center>
<form method=post action=./payment_method.php enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tablesearch>
<td colspan=3 style=text-align:center><?echo dictionary("payment_methods",$_SESSION['language']);?></td></tr>
<tr id=tabledesc>
<td><?echo str_replace(":","",dictionary("payment_method",$_SESSION['language']));?></td>
<td><?echo dictionary("print_cash_voucher",$_SESSION['language']);?></td>
<td><?echo dictionary("as_default",$_SESSION['language']);?></td>
</tr>

<?
$data1=mysql_query("select * from payment_method") or Die(MySQL_Error());
$cykl=0;while(mysql_result($data1,$cykl,0)):

echo"<tr id=tabledata><td nowrap=nowrap>".dictionary(mysql_result($data1,$cykl,1),$_SESSION['language'])."</td>";


echo"<td><input type=checkbox value=on ";if (mysql_result($data1,$cykl,3)=="on"){echo" checked ";}
?> title='<?echo dictionary("change_setting_for",$_SESSION['language'])." ".dictionary(mysql_result($data1,$cykl,1),$_SESSION['language']);?>' onclick="window.location.href('<?echo $rooturl[0];?>?set_cash=<?echo mysql_result($data1,$cykl,0);?>');"<?echo"></td>

<td><input type=radio value=on ";if (mysql_result($data1,$cykl,2)=="on"){echo" checked ";}
?> title='<?echo dictionary("default_set",$_SESSION['language']);?>' ondblclick="if(confirm('<?echo dictionary("settings",$_SESSION['language'])." ".dictionary(mysql_result($data1,$cykl,1),$_SESSION['language'])." ".dictionary("as_default",$_SESSION['language'])."?";?>')) window.location.href('<?echo $rooturl[0];?>?def_val=<?echo mysql_result($data1,$cykl,0);?>');"<?
echo"></td>";

$cykl++;endwhile;

?>


</table></form>





</center></body></html>