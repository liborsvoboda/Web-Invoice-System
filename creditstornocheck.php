<?php
if (isset($_GET['custname'])) {

include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");
$part=explode("<!>",$_GET['custname']);
if ($part[0]<>"customer"){$check = mysql_query("SELECT credit_no,".securesql($part[0])." FROM credit_header WHERE ".securesql($part[0])." like '".securesql($part[1])."%' order by ".securesql($part[0])." DESC");}
else                     {$check = mysql_query("SELECT credit_no,".securesql($part[0])." FROM credit_header WHERE ".securesql($part[0])." like '%".securesql($part[1])."%' ");}

if ((mysql_num_rows($check)+2)<13){$numero=(mysql_num_rows($check)+2);} else {$numero=10;}

if (mysql_num_rows($check) > 0) {$checkcolor="#66cc66";
$status ="<div style=position:relative;left:-354px;top:23px;border:3px;border-style:solid;border-color:grey;background:grey; ><select size=".$numero." name=selected_customer style=width:345px;background:grey; ondblclick=final_customer(this);document.forms[\"form\"].submit(); onclick=final_customer(this); ><option disabled=disabled></option>";

@$cykl=0;while(mysql_result($check,$cykl,0)<>""):
	$status.="<option value=\'".mysql_result($check,$cykl,0)."\'>";if (StrPos (" ".mysql_result($check,$cykl,1),"\n")){$radky=explode("\n",mysql_result($check,$cykl,1));$status.=str_replace("\r","",$radky[0]);} else{$status.=mysql_result($check,$cykl,1);}$status.="</option>";
@$cykl++;endwhile;$status.="<option disabled=disabled></option></select></div>";

if (mysql_num_rows($check) == 1){?>document.getElementById('value10').value ='';document.getElementById('value1').value = '<?echo mysql_result($check,0,0);?>';document.forms["form"].submit();<?}
}
else {$checkcolor="#FFB0B0";}

if ($_GET['custname'] == "") {$checkcolor="#FFB0B0";}
?>
function final_customer(resu){	document.getElementById('value1').value = resu.options[resu.selectedIndex].value;
document.getElementById('value10').value ='';
}

document.getElementById('search').style.backgroundColor = '<? echo $checkcolor; ?>';
document.getElementById('credit_search').innerHTML = '<? echo @$status; ?>';
<?

}
?>

