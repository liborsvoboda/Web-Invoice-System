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
include ("./library/javascript/knihovnajs_iframe_nocalendar.php");
?>

<SCRIPT LANGUAGE="javascript">
 var cDOW=["PO "," ÚT"," ST"," ČT"," PÁ"," SO"," NE"];var cMOY=["Leden","Únor","Březen","Duben","Květen","Červen","Červenec","Srpen","Září","Říjen","Listopad","Prosinec"];var imgPath="";
 function calendar(cTarget,cName,cId) {this.cId=cId;this.cTarget=cTarget;this.cName=cName;this.cDate=new Date();this.cYear=this.cDate.getFullYear();this.cMonth=this.cDate.getMonth();this.cDay=1;show_calendar(this);}
 function show_calendar(cId) {var cData="";cData+="<DIV CLASS=\"calendar\">\n";cData+=" <FIELDSET style=text-align:left>\n";cData+="  <LEGEND>Datum&nbsp;</LEGEND>\n";cData+="  <DIV STYLE=\"position: relative;\">\n";cData+="   <SELECT NAME=\""+cId.cName+".cMonth\" onChange=\"setNMonth(this.options[selectedIndex].value,"+cId.cId+");\">"; for (var idx_month=0;idx_month<12;++idx_month) cData+="   <OPTION VALUE=\""+idx_month+"\">"+cMOY[idx_month]+"\n"; cData+="   </SELECT>\n";
  cData+="   <INPUT TYPE=\"text\" NAME=\""+cId.cName+".cYear\" STYLE=\"width: 34px;\" onChange=\"setNYear("+cId.cId+");\"'> <IMG SRC=\""+imgPath+'picture/'+"inc.png\" STYLE=\"position: absolute; top: 2px;\" onMouseOver=\"this.src='"+imgPath+'picture/'+"inc_over.png';\" onMouseOut=\"this.src='"+imgPath+'picture/'+"inc.png';\" onClick=\"++window.document.getElementById('"+cId.cName+".cYear').value; setNYear("+cId.cId+");\"> <IMG SRC=\""+imgPath+'picture/'+"dec.png\" STYLE=\"position: absolute; top: 11px;\" onMouseOver=\"this.src='"+imgPath+'picture/'+"dec_over.png';\" onMouseOut=\"this.src='"+imgPath+'picture/'+"dec.png';\" onClick=\"--window.document.getElementById('"+cId.cName+".cYear').value; setNYear("+cId.cId+");\">\n";
  cData+="  </DIV>\n"; cData+="  <DIV CLASS=\"calendar_table\">\n";cData+="  <DIV CLASS=\"calendar_row_cDOW\">";for (var idx_day=0;idx_day<7;++idx_day) cData+="<SPAN STYLE=\"width: 20px\">"+cDOW[idx_day]+"</SPAN>";cData+="  </DIV>\n";cData+="  <DIV ID=\""+cId.cName+".cData\">";cData+="  </DIV>\n";cData+=" </FIELDSET>\n";cData+="</DIV>\n";window.document.getElementById(cId.cName).innerHTML=cData;setCalendar(new Date(cId.cYear,cId.cMonth,1),cId)}
 function setCalendar(dt,cId) { cId.cYear=dt.getFullYear(); cId.cMonth=dt.getMonth(); cId.cDay=dt.getDate(); firstDay=dt.getDay();if ((firstDay-2)<-1) firstDay+=7;dayspermonth=getDaysPerMonth(cId); cData=""; for (var row=0;row<6;++row) {cData+="  <DIV>"; for (var col=1;col<8;++col) {nDay=row*7+col-firstDay+1; cData+="<A HREF=\"\" STYLE=\"width: 20px\" onClick=\"if (this.innerHTML!=='') ShowDate('"+nDay+"',"+cId.cId+"); return false;\">";
 if ((nDay>0)&&(nDay<dayspermonth+1)) cData+=nDay;cData+="   ";cData+="</A>";cData+="   ";} cData+="</DIV>\n";}window.document.getElementById(cId.cName+".cData").innerHTML=cData;window.document.getElementById(cId.cName+".cMonth").value=cId.cMonth;window.document.getElementById(cId.cName+".cYear").value=cId.cYear;}
 function getDaysPerMonth(cId){daysArray=new Array(31,28,31,30,31,30,31,31,30,31,30,31);days=daysArray[cId.cMonth];if (cId.cMonth==1){if((cId.cYear%4)==0) {if(((cId.cYear%100)==0) && (cId.cYear%400)!=0)days = 28; else  days = 29;}}return days;}function setNMonth(cMonth,cId){setCalendar(new Date(cId.cYear,cMonth,1),cId);}
 function setNYear(cId){cYear=parseInt(window.document.getElementById(cId.cName+".cYear").value);if (isNaN(cYear)){alert("Rok musí být číslo");return;}setCalendar(new Date(cYear,cId.cMonth,1),cId);}
 function ShowDate(cDay,cId) {cId.cTarget.value=((cDay<10)?"0"+cDay:cDay)+"."+((cId.cMonth<9)?"0"+(cId.cMonth+1):(cId.cMonth+1))+"."+cId.cYear;window.document.getElementById(cId.cName).innerHTML="";maturitydateno();}
</SCRIPT><STYLE TYPE="text/css"><!-- .calendar {width: 160px;background: #B7DCF2;color: #000000;font-family: "Arial CE",Arial;font-size: 12px;} .calendar a {text-decoration: none;background: #B7DCF2;color: #000000;} .calendar a:hover {Xbackground: #0054E3;Xcolor: #FFFFFF;} .calendar input {font-family: "Arial CE",Arial;font-size: 12px;} .calendar select {font-family: "Arial CE",Arial;font-size: 12px;} .calendar_table {background: #B7DCF2;color: #000000;border: 1px solid #ACA899;text-align: center;} .calendar_row_cDOW {background: #7A96DF;color: #FFFFFF;} .calendar_day_of_month {background: #0054E3;color: #FFFFFF;cursor: pointer;}--></STYLE>

<SCRIPT LANGUAGE="javascript">
 var cDOW=["PO "," ÚT"," ST"," ČT"," PÁ"," SO"," NE"];var cMOY=["Leden","Únor","Březen","Duben","Květen","Červen","Červenec","Srpen","Září","Říjen","Listopad","Prosinec"];var imgPath="";
 function calendaro(cTarget,cName,cId) {this.cId=cId;this.cTarget=cTarget;this.cName=cName;this.cDate=new Date();this.cYear=this.cDate.getFullYear();this.cMonth=this.cDate.getMonth();this.cDay=1;show_calendaro(this);}
 function show_calendaro(cId) {var cData="";cData+="<DIV CLASS=\"calendaro\">\n";cData+=" <FIELDSET style=text-align:left>\n";cData+="  <LEGEND>Datum&nbsp;</LEGEND>\n";cData+="  <DIV STYLE=\"position: relative;\">\n";cData+="   <SELECT NAME=\""+cId.cName+".cMonth\" onChange=\"setNMonth(this.options[selectedIndex].value,"+cId.cId+");\">"; for (var idx_month=0;idx_month<12;++idx_month) cData+="   <OPTION VALUE=\""+idx_month+"\">"+cMOY[idx_month]+"\n"; cData+="   </SELECT>\n";
  cData+="   <INPUT TYPE=\"text\" NAME=\""+cId.cName+".cYear\" STYLE=\"width: 34px;\" onChange=\"setNYear("+cId.cId+");\"'> <IMG SRC=\""+imgPath+'picture/'+"inc.png\" STYLE=\"position: absolute; top: 2px;\" onMouseOver=\"this.src='"+imgPath+'picture/'+"inc_over.png';\" onMouseOut=\"this.src='"+imgPath+'picture/'+"inc.png';\" onClick=\"++window.document.getElementById('"+cId.cName+".cYear').value; setNYear("+cId.cId+");\"> <IMG SRC=\""+imgPath+'picture/'+"dec.png\" STYLE=\"position: absolute; top: 11px;\" onMouseOver=\"this.src='"+imgPath+'picture/'+"dec_over.png';\" onMouseOut=\"this.src='"+imgPath+'picture/'+"dec.png';\" onClick=\"--window.document.getElementById('"+cId.cName+".cYear').value; setNYear("+cId.cId+");\">\n";
  cData+="  </DIV>\n"; cData+="  <DIV CLASS=\"calendaro_table\">\n";cData+="  <DIV CLASS=\"calendaro_row_cDOW\">";for (var idx_day=0;idx_day<7;++idx_day) cData+="<SPAN STYLE=\"width: 20px\">"+cDOW[idx_day]+"</SPAN>";cData+="  </DIV>\n";cData+="  <DIV ID=\""+cId.cName+".cData\">";cData+="  </DIV>\n";cData+=" </FIELDSET>\n";cData+="</DIV>\n";window.document.getElementById(cId.cName).innerHTML=cData;setcalendaro(new Date(cId.cYear,cId.cMonth,1),cId)}
 function setcalendaro(dt,cId) { cId.cYear=dt.getFullYear(); cId.cMonth=dt.getMonth(); cId.cDay=dt.getDate(); firstDay=dt.getDay();if ((firstDay-2)<-1) firstDay+=7;dayspermonth=getDaysPerMonth(cId); cData=""; for (var row=0;row<6;++row) {cData+="  <DIV>"; for (var col=1;col<8;++col) {nDay=row*7+col-firstDay+1; cData+="<A HREF=\"\" STYLE=\"width: 20px\" onClick=\"if (this.innerHTML!=='') ShowDateo('"+nDay+"',"+cId.cId+"); return false;\">";
 if ((nDay>0)&&(nDay<dayspermonth+1)) cData+=nDay;cData+="   ";cData+="</A>";cData+="   ";} cData+="</DIV>\n";}window.document.getElementById(cId.cName+".cData").innerHTML=cData;window.document.getElementById(cId.cName+".cMonth").value=cId.cMonth;window.document.getElementById(cId.cName+".cYear").value=cId.cYear;}
 function getDaysPerMonth(cId){daysArray=new Array(31,28,31,30,31,30,31,31,30,31,30,31);days=daysArray[cId.cMonth];if (cId.cMonth==1){if((cId.cYear%4)==0) {if(((cId.cYear%100)==0) && (cId.cYear%400)!=0)days = 28; else  days = 29;}}return days;}function setNMonth(cMonth,cId){setcalendaro(new Date(cId.cYear,cMonth,1),cId);}
 function setNYear(cId){cYear=parseInt(window.document.getElementById(cId.cName+".cYear").value);if (isNaN(cYear)){alert("Rok musí být číslo");return;}setcalendaro(new Date(cYear,cId.cMonth,1),cId);}
 function ShowDateo(cDay,cId) {cId.cTarget.value=((cDay<10)?"0"+cDay:cDay)+"."+((cId.cMonth<9)?"0"+(cId.cMonth+1):(cId.cMonth+1))+"."+cId.cYear;window.document.getElementById(cId.cName).innerHTML="";}
</SCRIPT><STYLE TYPE="text/css"><!-- .calendaro {width: 160px;background: #B7DCF2;color: #000000;font-family: "Arial CE",Arial;font-size: 12px;} .calendaro a {text-decoration: none;background: #B7DCF2;color: #000000;} .calendaro a:hover {Xbackground: #0054E3;Xcolor: #FFFFFF;} .calendaro input {font-family: "Arial CE",Arial;font-size: 12px;} .calendaro select {font-family: "Arial CE",Arial;font-size: 12px;} .calendaro_table {background: #B7DCF2;color: #000000;border: 1px solid #ACA899;text-align: center;} .calendaro_row_cDOW {background: #7A96DF;color: #FFFFFF;} .calendaro_day_of_month {background: #0054E3;color: #FFFFFF;cursor: pointer;}--></STYLE>

</head>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><center>
<form name=form method=post enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc><td><?echo dictionary("listing_of_invoices",$_SESSION['language']);?></td>
<td nowrap="nowrap" style=text-align:right><?echo dictionary("invoice_no",$_SESSION['language']);?><input name="value1" type="text" value="<?echo @$_REQUEST["value1"];?>" style=text-align:right;width:110px readonly=yes></td>
</tr>

<?
$data1=mysql_query("select * from invoices_header where invoice_no='".securesql(@$_REQUEST["value1"])."' ") or Die(MySQL_Error());
$data2=mysql_query("select * from invoices_items where invoice_id='".mysql_result($data1,0,0)."' ") or Die(MySQL_Error());
?>

<tr id=tablesearch>
<td nowrap="nowrap" width=350px><?echo dictionary("supplier",$_SESSION['language']);?><br />
<textarea name="value2" rows=9 style=width:350px wrap="off" disabled><?if (@$_POST["count"]) {echo @$_POST["value2"];} else {echo mysql_result($data1,0,2);}?></textarea></td>
<td nowrap="nowrap" style=text-align:right;vertical-align:top; width=350px>


<?echo dictionary("search_by",$_SESSION['language']);?><select size="1" name="search_by" onchange=inv_search_byf(this) style=vertical-align:top; autocomplete="off">
  <option value="invoice_no" <?if (@$_POST["search_by"]=="invoice_no") {echo"selected=selected";}?> ><?echo dictionary("invoice_no",$_SESSION['language']);?></option>
  <option value="customer" <?if (@$_POST["search_by"]=="customer") {echo"selected=selected";}?> ><?echo dictionary("customer",$_SESSION['language']);?></option>
  <option value="issue_date" <?if (@$_POST["search_by"]=="issue_date") {echo"selected=selected";}?> ><?echo dictionary("issue_date",$_SESSION['language']);?></option>
  <option value="maturity_date" <?if (@$_POST["search_by"]=="maturity_date") {echo"selected=selected";}?> ><?echo dictionary("maturity_date",$_SESSION['language']);?></option>
</select>
<input name="search" type="text" value="" id=search autocomplete="off" onkeyup="inv_search(selected_filter+'<!>'+search.value);" onclick="inv_search(selected_filter+'<!>'+search.value);" style=width:100px;text-align:center;vertical-align:top;>
<div id="inv_search" style=position:absolute></div>


<br />
<textarea name="value3" rows=9 style=width:350px wrap="off" disabled><?if (@$_POST["count"]) {echo @$_POST["value3"];} else {echo mysql_result($data1,0,3);}?></textarea></td>
</tr>


<tr id=tabledata>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("issue_date",$_SESSION['language']);?></span>
<input type="text" onclick=maturitydateno()  id=issue_date name="value4" value="<?if (@$_POST["count"]) {echo @$_POST["value4"];} else {echo datecs(mysql_result($data1,0,4));}?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendar(form.value4,'span_value4','cpokus');" style=width:50px; disabled >
<div style=position:relative;top:0px;left:-135px; ><div style=position:absolute><SPAN ID="span_value4"></div>
</div></td>

<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("payment_method",$_SESSION['language']);?></span>
<select size="1" name="value5" style=width:130px disabled>
<?$temp=mysql_query("select * from payment_method") or Die(MySQL_Error());
$cykl=0;while(mysql_result($temp,$cykl,0)):
	echo"<option";if ((!@$_POST["count"] && mysql_result($data1,0,5)==dictionary(mysql_result($temp,$cykl,1),$_SESSION['language'])) or (@$_POST["count"] && @$_POST["value5"]==dictionary(mysql_result($temp,$cykl,1),$_SESSION['language']))){echo " selected ";}echo">".dictionary(mysql_result($temp,$cykl,1),$_SESSION['language'])."</option>";
$cykl++;endwhile;
?></select></td>
</tr>

<tr id=tabledata>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("taxation_date",$_SESSION['language']);?></span>
<input type="text" name="value6" value="<?if (@$_POST["count"]) {echo @$_POST["value6"];} else {echo datecs(mysql_result($data1,0,6));}?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendar(form.value6,'span_value6','cpokus');" style=width:50px; disabled >
<div style=position:relative;top:0px;left:-135px; ><div style=position:absolute><SPAN ID="span_value6"></div>
</div></td>

<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("maturity",$_SESSION['language']);?>:</span>
<select size="1" id=maturity name="value7" style=width:130px onchange=maturitydateno() disabled >
<?$temp=mysql_query("select * from maturity") or Die(MySQL_Error());
$cykl=0;while(mysql_result($temp,$cykl,0)):
	echo"<option value='".mysql_result($temp,$cykl,1)."'"; if ((!@$_POST["count"] && mysql_result($data1,0,7)==mysql_result($temp,$cykl,1)) or (@$_POST["count"] && @$_POST["value7"]==mysql_result($temp,$cykl,1))){echo" selected ";}echo">".mysql_result($temp,$cykl,1)."</option>";
$cykl++;endwhile;
?></select></td>
</tr>


<tr id=tabledata>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("maturity_date",$_SESSION['language']);?></span>
<input type="text" id=maturitydate name="value8" value="<?if (@$_POST["count"]) {echo @$_POST["value8"];} else {echo datecs(mysql_result($data1,0,8));}?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendaro(form.value8,'span_value8','cpokus');" style=width:50px; disabled >
<div style=position:relative;top:0px;left:-135px; ><div style=position:absolute><SPAN ID="span_value8"></div>
</div></td>

<td nowrap="nowrap" width=350px <?if (mysql_result($data1,0,13)=="S" && @$_REQUEST["value1"]){echo " bgcolor=#FBA2A4 style=color:red ";}?> >
<? if (mysql_result($data1,0,13)=="S" && @$_REQUEST["value1"]){echo "<big>".dictionary("canceled",$_SESSION['language'])."</big>";} ?>
</td>
</tr>

<tr id=tabledata>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("order",$_SESSION['language']);?></span>
<input type="text" name="value10" value="<?echo mysql_result($data1,0,16);?>" style=width:135px;text-align:center; disabled=disabled >
</td>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("service_no",$_SESSION['language']);?></span>
<input type="text" name="value12" value="<?echo mysql_result($data1,0,17);?>" style=width:130px;text-align:center; disabled=disabled >
</td>
</tr>
 

<tr id=tablesearch>
<td nowrap="nowrap" colspan=2 ><?echo dictionary("invoice_items",$_SESSION['language']);?><br />
<table style=width:100% border="0" cellpadding="0" cellspacing="0">
<?
if (!@$_POST["count"]) {@$_POST["countval"]=mysql_num_rows($data2);}
$repeat=0; while($repeat<@$_POST["countval"]):?>
<tr>
<td width=74% rowspan=3><textarea name="dvalue<?echo $repeat;?>a" rows=3 style=width:100%;overflow:auto; wrap="off" disabled><?if (!@$_POST["count"]) {echo mysql_result($data2,$repeat,2);}else{echo @$_POST["dvalue".$repeat."a"];}?></textarea></td>
<td width=11% style=text-align:right><?echo dictionary("count",$_SESSION['language'])."/".dictionary("price",$_SESSION['language']).":";?></td>
<td width=15%><input name="dvalue<?echo $repeat;?>b" type="text" value="<?if (!@$_POST["count"]) {echo mysql_result($data2,$repeat,3);}else{echo @$_POST["dvalue".$repeat."b"];}?>" style=width:50%;text-align:center; disabled><input name="dvalue<?echo $repeat;?>e" type="text" value="<?if (!@$_POST["count"]) {echo mysql_result($data2,$repeat,4);}else{echo @$_POST["dvalue".$repeat."e"];}?>" style=width:50%;text-align:center; disabled></td>
</tr>

<tr>
<td width=11% style=text-align:right><?echo dictionary("unit",$_SESSION['language']);?></td>
<td width=15% style=text-align:right><select size="1" name="dvalue<?echo $repeat;?>c" style=width:100% disabled>
<?$temp=mysql_query("select * from units") or Die(MySQL_Error());
$cykl=0;while(mysql_result($temp,$cykl,0)):
	echo"<option";if ((!@$_POST["count"] && mysql_result($data2,$repeat,5)==mysql_result($temp,$cykl,1)) or (@$_POST["count"] && @$_POST["dvalue".$repeat."c"]==mysql_result($temp,$cykl,1)) ){echo" selected ";}echo">".mysql_result($temp,$cykl,1)."</option>";
$cykl++;endwhile;
?></select></td>
</tr>
<tr>
<td width=11% style=text-align:right><?echo dictionary("dph",$_SESSION['language']);?>:</td>
<td width=15% style=text-align:right><select size="1" name="dvalue<?echo $repeat;?>d" style=width:100% disabled>
<?$temp=mysql_query("select * from dph_values") or Die(MySQL_Error());
$cykl=1;while($cykl<11):
if(mysql_result($temp,0,$cykl)<>""){echo"<option value='".mysql_result($temp,0,$cykl)."' ";if ((!@$_POST["count"] && mysql_result($data2,$repeat,6)==mysql_result($temp,0,$cykl)) or (@$_POST["count"] && @$_POST["dvalue".$repeat."d"]==mysql_result($temp,0,$cykl)) ){echo" selected ";}echo">".mysql_result($temp,0,$cykl)."%"."</option>";}
$cykl++;endwhile;
?></select></td>
</tr>

<?$repeat++;endwhile;?>

<tr><td>
</td>

<td style=text-align:right><b><?echo dictionary("total",$_SESSION['language']);?></b></td>
<td style=text-align:right><input id='value11' name=value11 type=text value='' readonly=yes style=text-align:center;font-weight:bold;background:#C1F4DF;width:55%; disabled><select size=1 name='value9' style=text-align:center;font-weight:bold;background:#C1F4DF;width:45%; disabled >
<?$temp1=mysql_query("select * from currency") or Die(MySQL_Error());
$cykl1=0;while(mysql_result($temp1,$cykl1,0)):
	echo"<option";if (mysql_result($data1,0,14)==mysql_result($temp1,$cykl1,1)){echo" selected ";}echo">".mysql_result($temp1,$cykl1,1)."</option>";
$cykl1++;endwhile;?></select></td>

</tr>

</table>

</td></tr>


<tr id=tablesubmit>
<?$id=mysql_result(mysql_query("select id from invoices_header where invoice_no='".securesql(@$_REQUEST["value1"])."' "),0,0);
$cashid=mysql_result(mysql_query("select id from cash_header where invoice_no='".securesql(@$_REQUEST["value1"])."'"),0,0);
$creditid=mysql_result(mysql_query("select id from credit_header where invoice_no='".securesql(@$_REQUEST["value1"])."' "),0,0);
?>
<td style=text-align:left><input <?if (!@$_REQUEST["value1"]){echo "disabled";}?> type="button" name=tlacitko value="<?echo dictionary("print",$_SESSION['language']);?>" onclick="window.open('./outputs/invoice.php?id=<?echo sifra($id);?>&lang=<?echo sifra($_SESSION['language']);?>');" >
<?if (@$_REQUEST["value1"] and $creditid){?>
<input name="credit_note" type="button" value="<?echo dictionary("credit_note_print",$_SESSION['language']);?>" onclick="window.open('./outputs/credit_note.php?id=<?echo sifra($creditid);?>&lang=<?echo sifra($_SESSION['language']);?>');" ><?}?></td>
<td style=text-align:right><input <?if (!@$_REQUEST["value1"] or !$cashid ){echo "disabled";}?> type="button" name=tlacitko value="<?echo dictionary("print_cash_voucher",$_SESSION['language']);?>" onclick="window.open('./outputs/cash_voucher.php?id=<?echo sifra($cashid);?>&lang=<?echo sifra($_SESSION['language']);?>');" >
<input <?if (!@$_REQUEST["value1"] or !$cashid ){echo "disabled";}?> type="button" name=tlacitko value="<?echo "2x";?>" onclick="window.open('./outputs/2xcash_voucher.php?id=<?echo sifra($cashid);?>&lang=<?echo sifra($_SESSION['language']);?>');" ></td>
</tr>


</table></form>





</center></body></html>



  <script type="text/javascript">
 function inv_search_byf(res){
 selected_filter = res.options[res.selectedIndex].value;
 document.forms["form"].submit();
 }
 var selected_filter=document.getElementById('search_by').options[document.getElementById('search_by').selectedIndex].value;

 function maturitydateno(){
var promenna=new Date();var retezec = document.getElementById('issue_date').value;
var pole = retezec.split(".");var den=pole[0];var mesic=pole[1]-1;var rok=pole[2];
promenna.setDate(den);promenna.setMonth(mesic);promenna.setFullYear(rok);
promenna.setTime(promenna.getTime() + document.getElementById('maturity').options[document.getElementById('maturity').selectedIndex].value *24*60*60*1000);
var d = promenna.getDate();den = (d < 10) ? '0' + d : d;var m = promenna.getMonth() + 1;mesic = (m < 10) ? '0' + m : m;var rok = promenna.getFullYear();

document.getElementById('maturitydate').value=den + "." + mesic +"." + rok;
 }
<?if (!$_POST["value8"]){?>
var promenna=new Date();var retezec = document.getElementById('issue_date').value;
var pole = retezec.split(".");var den=pole[0];var mesic=pole[1]-1;var rok=pole[2];
promenna.setDate(den);promenna.setMonth(mesic);promenna.setFullYear(rok);
promenna.setTime(promenna.getTime() + document.getElementById('maturity').options[document.getElementById('maturity').selectedIndex].value *24*60*60*1000);
var d = promenna.getDate();den = (d < 10) ? '0' + d : d;var m = promenna.getMonth() + 1;mesic = (m < 10) ? '0' + m : m;var rok = promenna.getFullYear();

document.getElementById('maturitydate').value=den + "." + mesic +"." + rok;
<?}?>

  var data=0;
 <?
$load=0;while($load<($repeat)):
echo"document.getElementById('dvalue".$load."b').value=document.getElementById('dvalue".$load."b').value.replace(',', '.');document.getElementById('dvalue".$load."e').value=document.getElementById('dvalue".$load."e').value.replace(',', '.');";
echo"var dph".$load." = document.getElementById('dvalue".$load."d').value.split('%');";
echo "data=data+((document.getElementById('dvalue".$load."b').value * document.getElementById('dvalue".$load."e').value)+((document.getElementById('dvalue".$load."b').value * document.getElementById('dvalue".$load."e').value)*(dph".$load."/100)));";
@$load++;endwhile;
echo"document.getElementById('value11').value=Math.round(parseFloat(data))";
?>



  </script>