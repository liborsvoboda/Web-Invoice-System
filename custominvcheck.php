<?php
if (isset($_GET['custname'])) {

include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");

//session_set_cookie_params(21600);
session_set_cookie_params(strtotime('tomorrow') - time() );
session_start();
session_register("loginname");
session_register("prava");
session_register("language");

 $part=explode("<!>",$_GET['custname']);
$check = mysql_query("SELECT name,street,city,psc,ico,dic,".securesql($part[0])." FROM customers WHERE ".securesql($part[0])." like '".securesql($part[1])."%' ");

if ((mysql_num_rows($check)+2)<11){$numero=(mysql_num_rows($check)+2);} else {$numero=10;}

if (mysql_num_rows($check) > 0) {$checkcolor="#66cc66";
$status ="<div id=selectcustomer style=position:relative;left:-354px;top:23px;border:3px;border-style:solid;border-color:grey;background:grey; ><select size=".$numero." name=selected_customer style=width:345px;background:grey; ondblclick=document.getElementById(\"selectcustomer\").style.display=\"none\"; onclick=final_customer(this); ><option disabled=disabled></option>";

@$cykl=0;while(mysql_result($check,$cykl,0)):
	$status.="<option value=\'".mysql_result($check,$cykl,0)."\\n".mysql_result($check,$cykl,1)."\\n".mysql_result($check,$cykl,3)."; ".mysql_result($check,$cykl,2)."\\n\\n".dictionary("ico",$_SESSION['language']).": ".mysql_result($check,$cykl,4)."\\n".dictionary("dic",$_SESSION['language']).": ".mysql_result($check,$cykl,5)."\'>".mysql_result($check,$cykl,6)."</option>";
@$cykl++;endwhile;$status.="<option disabled=disabled></option></select></div>";

}
else {$checkcolor="#FFB0B0";}

if ($_GET['custname'] == "") {$checkcolor="#FFB0B0";}
?>
function final_customer(resu){	document.getElementById('value3').value = resu.options[resu.selectedIndex].value;
}

document.getElementById('search').style.backgroundColor = '<? echo $checkcolor; ?>';
document.getElementById('custinvsearch').innerHTML = '<? echo @$status; ?>';
<?

}
?>

