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
session_register("customer");
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
$rooturl=explode("/customer_add.php",$_SERVER["REQUEST_URI"]);

// check and save
if (@$_POST["value1"] && @$_POST["value2"] && @$_POST["value3"] && @$_POST["value4"]){	@$control=mysql_query("select id from customers where name='".securesql(@$_POST["value1"])."' ") or Die(MySQL_Error());

if (!mysql_result($control,0,0)){	mysql_query("insert into customers (name,street,city,psc,ico,dic,account,ins_date,ins_name,phone,note)VALUES('".securesql(@$_POST["value1"])."','".securesql(@$_POST["value2"])."','".securesql(@$_POST["value3"])."','".securesql(@$_POST["value4"])."','".securesql(@$_POST["value5"])."','".securesql(@$_POST["value6"])."','".securesql(@$_POST["value7"])."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."','".securesql(@$_POST["value9"])."','".securesql(@$_POST["value10"])."')") or Die(MySQL_Error());
	?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("save_new",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?

	if (@$_POST["value8"]){$_SESSION['customer']=$_POST["value1"]."\n".$_POST["value2"]."\n".$_POST["value4"]."; ".$_POST["value3"]."\n\n".dictionary("ico",$_SESSION['language']).": ".$_POST["value5"]."\n".dictionary("dic",$_SESSION['language']).": ".$_POST["value6"];?>
	<script type="text/javascript">
	window.parent.location ='<?echo $rooturl[0];?>?option=NA==&mark_4=plus&command=Li9pbnZvaWNlX25ldy5waHA=';
	</script><?}
	unset($_POST["value1"]);unset($_POST["value2"]);unset($_POST["value3"]);unset($_POST["value4"]);unset($_POST["value5"]);unset($_POST["value6"]);unset($_POST["value7"]);unset($_POST["value8"]);unset($_POST["value9"]);unset($_POST["value10"]);
}

else {?><script LANGUAGE="JavaScript">alert('<?echo dictionary("cust_exist",$_SESSION['language'])." ".@$_POST["value1"];?>');</script><?
	 }
}

// bgcolor check
if (@$_POST["value1"] or @$_POST["value2"] or @$_POST["value3"] or @$_POST["value4"]){	if (!@$_POST["value1"]){$warning1="background-color:#FF4A4A;";}
	if (!@$_POST["value2"]){$warning2="background-color:#FF4A4A;";}
	if (!@$_POST["value3"]){$warning3="background-color:#FF4A4A;";}
	if (!@$_POST["value4"]){$warning4="background-color:#FF4A4A;";}
}
// end check and save
?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop" style=overflow-y:auto;overflow-x:auto; ><center>
<form name=form method=post enctype="multipart/form-data">

<table id=export_excel border=2 >
<tr id=tabledesc>
<td nowrap="nowrap" colspan=2><?echo dictionary("new_customer",$_SESSION['language']);?></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("cust_name",$_SESSION['language']);?></td>
<td nowrap="nowrap"><input name="value1" type="text" value="<?echo @$_POST['value1'];?>" style=width:300px;text-align:center;<?echo $warning1;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("street",$_SESSION['language']);?></td>
<td nowrap="nowrap"><input name="value2" type="text" value="<?echo @$_POST['value2'];?>" style=width:300px;text-align:center;<?echo $warning2;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("city",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value3" type="text" value="<?echo @$_POST['value3'];?>" style=width:190px;text-align:center;<?echo $warning3;?> autocomplete="off" > <input name="value4" type="text" value="<?echo @$_POST['value4'];?>" style=width:106px;text-align:center;<?echo $warning4;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("ico",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left height=25px><input name="value5" type="text" value="<?echo @$_POST['value5'];?>" style=width:280px;text-align:center; autocomplete="off"><img src="./picture/search.png" width="22" height="22" onclick="mfcr(value5.value)" alt="<?echo dictionary("mfcr_search",$_SESSION['language']);?>" border="0" style=margin:0px;cursor:pointer;vertical-align:top;></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("dic",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value6" type="text" value="<?echo @$_POST['value6'];?>" style=width:300px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("bank_account",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value7" type="text" value="<?echo @$_POST['value7'];?>" style=width:300px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("mobile_phone",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value9" type="text" value="<?echo @$_POST['value9'];?>" style=width:300px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" style=vertical-align:top><?echo dictionary("note",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><textarea name="value10" rows=5 wrap="off" style=width:300px;overflow:auto; ><?echo @$_POST['value10'];?></textarea></td>
</tr>
<tr id=tablesubmit><td colspan=2>
<table style=width:100% border=0><tr id=tablesubmit>
<td align=left><?echo dictionary("invoice_create",$_SESSION['language']);?><input name="value8" type="checkbox" <?if ($_POST["value8"]){echo "checked";}?> ></td>
<td align=right><input type="submit" name=tlacitko value="<?echo dictionary("btnsave",$_SESSION['language']);?>"></td>
</tr></table>
</td></tr>
</form>





</center></body></html>


