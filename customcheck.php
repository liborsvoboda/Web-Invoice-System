<?php
if (isset($_GET['custname'])) {

include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");
 $part=explode("<!>",$_GET['custname']);
$check = mysql_query("SELECT name,".securesql($part[0])." FROM customers WHERE ".securesql($part[0])." like '".securesql($part[1])."%' ");

if ((mysql_num_rows($check)+2)<12){$numero=(mysql_num_rows($check)+2);} else {$numero=11;}

if (mysql_num_rows($check) > 0) {$checkcolor="#66cc66";
$status ="<div style=position:relative;left:-304px;top:23px;border:3px;border-style:solid;border-color:grey;background:grey; ><select size=".$numero." name=selected_customer style=width:295px;background:grey; ondblclick=final_customer(this);document.forms[\"form\"].submit(); onclick=final_customer(this); ><option disabled=disabled></option>";

@$cykl=0;while(mysql_result($check,$cykl,0)):
	$status.="<option value=\'".mysql_result($check,$cykl,0)."\'>".mysql_result($check,$cykl,1)."</option>";
@$cykl++;endwhile;$status.="<option disabled=disabled></option></select></div>";

if (mysql_num_rows($check) == 1){?>document.getElementById('value1').value = '<?echo mysql_result($check,0,0);?>';document.forms["form"].submit();<?}
}
else {$checkcolor="#FFB0B0";}

if ($_GET['custname'] == "") {$checkcolor="#FFB0B0";}
?>
function final_customer(resu){	document.getElementById('value1').value = resu.options[resu.selectedIndex].value;
}

document.getElementById('search').style.backgroundColor = '<? echo $checkcolor; ?>';
document.getElementById('custsearch').innerHTML = '<? echo @$status; ?>';
<?

}
?>

