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

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><center>
<form name=test><table border="0" cellpadding="0" cellspacing="0" style=width:518px;>
<tr id=tablesearch>
<td style=text-align:center><?echo dictionary("invoice_note_templates_view",$_SESSION['language']);?></td></tr>

<?
$data1=mysql_query("select * from invoice_templates") or Die(MySQL_Error());
$cykl=0;while(mysql_result($data1,$cykl,0)):

echo"<tr id=tabledata>";
echo"<td width=518px nowrap=nowrap><textarea rows=3 id=note".$cykl." ondblclick=selected_form(this) style=width:100%;overflow:auto; onmouseover=this.select() wrap=off readonly=yes>".mysql_result($data1,$cykl,1)."</textarea></td>";
$cykl++;endwhile;

?>


</table></form>





</center></body></html>

  <script type="text/javascript">
 function selected_form(resw){

window.opener.document.getElementById('<?echo @$_GET["unit"];?>').value = resw.value;
window.close();
}
</script>

