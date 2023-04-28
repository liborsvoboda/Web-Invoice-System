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
$rooturl=explode("/customer_edit.php",$_SERVER["REQUEST_URI"]);

// check and save
if (@$_POST["value0"] && @$_POST["value1"] && @$_POST["value2"] && @$_POST["value3"] && @$_POST["value4"] && @$_POST["tlacitko"]){

mysql_query(" update customers set name='".securesql(@$_POST["value1"])."',street='".securesql(@$_POST["value2"])."',city='".securesql(@$_POST["value3"])."',psc='".securesql(@$_POST["value4"])."',ico='".securesql(@$_POST["value5"])."',dic='".securesql(@$_POST["value6"])."',account='".securesql(@$_POST["value7"])."',edit_date='".securesql($dnest)."',ins_name='".securesql($_SESSION['loginname'])."',phone='".securesql(@$_POST["value9"])."',note='".securesql(@$_POST["value10"])."' where id='".securesql(@$_POST["value0"])."'") or Die(MySQL_Error());
?><table width=100%><tr><td width=100% bgcolor="#1CBDFB"><center><b><?echo dictionary("edit_rec",$_SESSION['language']);?> <font color="#E60F2F"><?echo @$_POST["value1"];?></font> <?echo dictionary("runsuccess",$_SESSION['language']);?></b></center></td></tr></table><?

if (@$_POST["value8"]){$_SESSION['customer']=$_POST["value1"]."\n".$_POST["value2"]."\n".$_POST["value4"]."; ".$_POST["value3"]."\n\n".dictionary("ico",$_SESSION['language']).": ".$_POST["value5"]."\n".dictionary("dic",$_SESSION['language']).": ".$_POST["value6"];?>
	<script type="text/javascript">
	window.parent.location ='<?echo $rooturl[0];?>?option=NA==&mark_4=plus&command=Li9pbnZvaWNlX25ldy5waHA=';
	</script><?}

	unset($_POST["value0"]);unset($_POST["value1"]);unset($_POST["value2"]);unset($_POST["value3"]);unset($_POST["value4"]);unset($_POST["value5"]);unset($_POST["value6"]);unset($_POST["value7"]);unset($_POST["value8"]);unset($_POST["value9"]);unset($_POST["value10"]);
}
// end check and save
?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop" style=overflow-y:auto;overflow-x:auto; ><center>
<form name=form method=post enctype="multipart/form-data">

<table id=export_excel border=2 >
<tr id=tabledesc>
<td nowrap="nowrap" colspan=2><?echo dictionary("edit_customer",$_SESSION['language']);?></td>
</tr>

<tr id=tablesearch>
<td nowrap="nowrap"><?echo dictionary("search_by",$_SESSION['language']);?></td>
<td nowrap="nowrap"><select size="1" name="search_by" onchange=search_byf(this) autocomplete="off">
 <option value="name" <?if (@$_POST["search_by"]=="name") {echo"selected=selected";}?> ><?echo dictionary("cust_name",$_SESSION['language']);?></option>
  <option value="ico" <?if (@$_POST["search_by"]=="ico") {echo"selected=selected";}?> ><?echo dictionary("ico",$_SESSION['language']);?></option>
  <option value="dic" <?if (@$_POST["search_by"]=="dic") {echo"selected=selected";}?> ><?echo dictionary("dic",$_SESSION['language']);?></option>
</select>


<br /><input name="search" type="text" value="" id=search autocomplete="off" onkeyup="custsearch(selected_filter+'<!>'+search.value);" onclick="custsearch(selected_filter+'<!>'+search.value);" style=width:300px;text-align:center;>
<div id="custsearch" style=position:absolute></div>
</td>
</tr>


<?if (@$_POST["value1"]){$data=mysql_query("select * from customers where name='".securesql(@$_POST["value1"])."' ") or Die(MySQL_Error());
@$_POST['value2']=mysql_result($data,0,4);
@$_POST['value3']=mysql_result($data,0,5);
@$_POST['value4']=mysql_result($data,0,6);
@$_POST['value5']=mysql_result($data,0,2);
@$_POST['value6']=mysql_result($data,0,3);
@$_POST['value7']=mysql_result($data,0,7);
@$_POST['value9']=mysql_result($data,0,14);
@$_POST['value10']=mysql_result($data,0,15);
?><input name="value0" type="hidden" value="<?echo mysql_result($data,0,0);?>"><?
// bgcolor check
if (@$_POST["value1"]){
	if (!@$_POST["value1"]){$warning1="background-color:#FF4A4A;";}
	if (!@$_POST["value2"]){$warning2="background-color:#FF4A4A;";}
	if (!@$_POST["value3"]){$warning3="background-color:#FF4A4A;";}
	if (!@$_POST["value4"]){$warning4="background-color:#FF4A4A;";}
}
}?>

<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("cust_name",$_SESSION['language']);?></td>
<td nowrap="nowrap"><input name="value1" id="value1" type="text" value="<?echo @$_POST['value1'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?>  style=width:300px;text-align:center;<?echo $warning1;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("street",$_SESSION['language']);?></td>
<td nowrap="nowrap"><input name="value2" type="text" value="<?echo @$_POST['value2'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:300px;text-align:center;<?echo $warning2;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("city",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value3" type="text" value="<?echo @$_POST['value3'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:190px;text-align:center;<?echo $warning3;?> autocomplete="off" > <input name="value4" type="text" value="<?echo @$_POST['value4'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:106px;text-align:center;<?echo $warning4;?> autocomplete="off" ></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("ico",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value5" type="text" value="<?echo @$_POST['value5'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:190px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("dic",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value6" type="text" value="<?echo @$_POST['value6'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:190px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" align=left><?echo dictionary("bank_account",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value7" type="text" value="<?echo @$_POST['value7'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:300px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap"><?echo dictionary("mobile_phone",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><input name="value9" type="text" value="<?echo @$_POST['value9'];?>" <?if (!@$_POST['value1']){echo "readonly=yes";}?> style=width:300px;text-align:center; autocomplete="off"></td>
</tr>
<tr id=tabledata>
<td nowrap="nowrap" style=vertical-align:top><?echo dictionary("note",$_SESSION['language']);?></td>
<td nowrap="nowrap" align=left><textarea name="value10" rows=5 wrap="off" style=width:300px;overflow:auto; <?if (!@$_POST['value1']){echo "readonly=yes";}?> ><?echo @$_POST['value10'];?></textarea></td>
</tr>
<tr id=tablesubmit><td colspan=2>
<table style=width:100% border=0><tr id=tablesubmit>
<td align=left><?echo dictionary("invoice_create",$_SESSION['language']);?><input name="value8" type="checkbox" <?if ($_POST["value8"]){echo "checked";}?> <?if (!@$_POST['value1']){echo "disabled=disabled";}?> ></td>
<td align=right><input <?if (!@$_POST["value1"]){echo "disabled";}?> type="submit" name=tlacitko value="<?echo dictionary("btnsavechages",$_SESSION['language']);?>"></td>
</tr></table>
</td></tr>



<?
$data2=mysql_query("select * from invoices_header where customer like '%".securesql(@$_POST["value1"])."%' order by issue_date desc") or Die(MySQL_Error());
$data3=mysql_query("select * from cash_header where customer like '%".securesql(@$_POST["value1"])."%' and invoice_no='' order by issue_date desc") or Die(MySQL_Error());
if (@$_POST["value1"] and (mysql_num_rows($data2)+mysql_num_rows($data3))){?><tr id=tabledata><td colspan=2 width=350px><table style=width:100% border="0" cellpadding="0" cellspacing="0"><tr><?
$cykl1="start";@$cykl=0;while($cykl<(mysql_num_rows($data2)+mysql_num_rows($data3)) or ($cykl/4)<>round(($cykl/4),0)):


if (($cykl/4)==round(($cykl/4),0) && $cykl>0){echo"</tr><tr>";}

echo"<td width=104px><img";
	if (mysql_result(@$data2,@$cykl,1)){echo" style=cursor:pointer onclick=\"window.location.assign('./invoice_view.php?value1=".mysql_result(@$data2,@$cykl,1)."');\" ";}
		if (!mysql_result(@$data2,@$cykl,1) && $cykl1=="start"){$cykl1=0;}
	if (!mysql_result(@$data2,@$cykl,1) && mysql_result(@$data3,@$cykl1,1)){echo" style=cursor:pointer onclick=\"window.location.assign('./overview_of_income.php?value1=".mysql_result(@$data3,@$cykl1,1)."');\" ";}

	if (mysql_result(@$data2,@$cykl,1)){echo" src=./doc_zalozka.php?name=".sifra(mysql_result(@$data2,@$cykl,1))."  border=0>";}
	if (!mysql_result(@$data2,@$cykl,1) && mysql_result(@$data3,@$cykl1,1)){echo" src=./cash_zalozka.php?name=".sifra(mysql_result(@$data3,@$cykl1,1))."  border=0>";}
echo"</td>";

if (!mysql_result(@$data2,@$cykl,1)){$cykl1++;}
$cykl++;endwhile;?></tr></table></td></tr><?}?>



</form>





</center></body></html>



  <script type="text/javascript">
 function search_byf(res){
 selected_filter = res.options[res.selectedIndex].value;
 if (document.getElementById('value0')){document.getElementById('value0').disabled = true;}
 document.getElementById('value1').disabled = true;document.getElementById('value2').disabled = true;document.getElementById('value3').disabled = true;document.getElementById('value4').disabled = true;document.getElementById('value5').disabled = true;document.getElementById('value6').disabled = true;document.getElementById('value7').disabled = true;
 document.forms["form"].submit();

 }
 var selected_filter=document.getElementById('search_by').options[document.getElementById('search_by').selectedIndex].value;


  </script>


