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

<? // new cash voucher
if (@$_POST["tlacitko"] && @$_POST["value3"]<>dictionary("customer",$_SESSION['language']) && (@$_POST["value1b"] or @$_POST["value2b"] or @$_POST["value3b"] or @$_POST["value4b"] or @$_POST["value5b"] or @$_POST["value6b"] or @$_POST["value7b"] or @$_POST["value8b"] or @$_POST["value9b"] or @$_POST["value10b"])){ // new invoice header
	mysql_query("insert into cash_header (cash_no,supplier,customer,issue_date,total_price,currency,ins_date,ins_name)VALUES('".securesql(@$_POST["value1"])."','".securesql(@$_POST["value2"])."','".securesql(@$_POST["value3"])."','".securesql(datedb(@$_POST["value4"]))."','".securesql(@$_POST["value5"])."','".securesql(@$_POST["value6"])."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."') ") or Die(MySQL_Error());    $id=iid();

// upd cash no
$temp=mysql_query("select value from cash_mark where start_date <='".$dnes."' and end_date>='".$dnes."' ") or Die(MySQL_Error());
$numr=mysql_result($temp,0,0)+1;$numlen=strlen($numr);$add="";$origlen=strlen(mysql_result($temp,0,0));
while($origlen>$numlen):$add.="0";$origlen--;endwhile;
mysql_query("update cash_mark set value='".$add.$numr."' where start_date <='".$dnes."' and end_date>='".$dnes."' ") or Die(MySQL_Error());

        // new cash items
		$cykl=1;while($cykl<11):

			if (@$_POST["value".$cykl."b"]){
			    @$_POST["value".$cykl."a"]=str_replace("%","",@$_POST["value".$cykl."a"]);
			    @$_POST["value".$cykl."b"]=str_replace(" ","",@$_POST["value".$cykl."b"]);
			    mysql_query("insert into cash_items (cash_id,dph,price,dph_price,price_with_dph,ins_date,ins_name)VALUES('".$id."','".securesql(@$_POST["value".$cykl."a"])."','".securesql(@$_POST["value".$cykl."b"])."','".securesql(@$_POST["value".$cykl."c"])."','".securesql(@$_POST["value".$cykl."d"])."','".securesql($dnest)."','".securesql($_SESSION['loginname'])."')") or Die(MySQL_Error());}

   unset($_POST["value".$cykl."a"]);unset($_POST["value".$cykl."b"]);
   unset($_POST["value".$cykl."c"]);unset($_POST["value".$cykl."d"]);

		$cykl++;endwhile;
   unset($_POST["value1"]);unset($_POST["value2"]);unset($_POST["value3"]);unset($_POST["value4"]);
   unset($_POST["value5"]);unset($_POST["value6"]);

if (@$_POST["tlacitko"]==dictionary("btnsave_print",$_SESSION['language'])){?><script type="text/javascript">window.open('./outputs/<?if (@$_POST["2x"]){echo "2x";}?>cash_voucher.php?id=<?echo sifra($id);?>&lang=<?echo sifra($_SESSION['language']);?>');</script> <?}
}

?>

<body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?> onunload="window.name=document.body.scrollTop"><center>
<form name=form method=post enctype="multipart/form-data">

<table id=export_excel border=2>
<tr id=tabledesc><td><?echo dictionary("new_cash_reception",$_SESSION['language']);?></td>
<td nowrap="nowrap" style=text-align:right><?echo dictionary("cash_reception_no",$_SESSION['language']);?><input name="value1" type="text" value="<?$temp=mysql_query("select cash_index,value from cash_mark where start_date <='".$dnes."' and end_date>='".$dnes."' ");echo mysql_result($temp,0,0);$numr=mysql_result($temp,0,1)+1;$numlen=strlen($numr);$add="";$origlen=strlen(mysql_result($temp,0,1));while($origlen>$numlen):$add.="0";$origlen--;endwhile;echo $add.$numr;?>" style=text-align:right;width:110px readonly=yes></td>
</tr>
<tr id=tablesearch>
<td nowrap="nowrap" width=350px><?echo dictionary("supplier",$_SESSION['language']);?><br />
<textarea name="value2" rows=9 style=width:350px wrap="off">
<?$data1=mysql_query("select * from company") or Die(MySQL_Error());
echo mysql_result($data1,0,1)."\n".mysql_result($data1,0,2)."\n".mysql_result($data1,0,4)."; ".mysql_result($data1,0,3)."\n"."\n";
echo dictionary("ico",$_SESSION['language']).": ".mysql_result($data1,0,5)." ; ".dictionary("dic",$_SESSION['language']).": ".mysql_result($data1,0,6)."\n\n";
echo dictionary("mobile_phone",$_SESSION['language']).": ".mysql_result($data1,0,10)."\n";
echo dictionary("mail",$_SESSION['language'])." ".mysql_result($data1,0,13);?>
</textarea></td>
<td nowrap="nowrap" style=text-align:right;vertical-align:top; width=350px>


<?echo dictionary("search_by",$_SESSION['language']);?><select size="1" name="search_by" onchange=search_byf(this) style=vertical-align:top; autocomplete="off">
 <option value="name" <?if (@$_POST["search_by"]=="name") {echo"selected=selected";}?> ><?echo dictionary("cust_name",$_SESSION['language']);?></option>
  <option value="ico" <?if (@$_POST["search_by"]=="ico") {echo"selected=selected";}?> ><?echo dictionary("ico",$_SESSION['language']);?></option>
  <option value="dic" <?if (@$_POST["search_by"]=="dic") {echo"selected=selected";}?> ><?echo dictionary("dic",$_SESSION['language']);?></option>
</select>
<input name="search" type="text" value="" id=search autocomplete="off" onkeyup="custinvsearch(selected_filter+'<!>'+search.value);" onclick="custinvsearch(selected_filter+'<!>'+search.value);" style=width:100px;text-align:center;vertical-align:top;>
<div id="custinvsearch" style=position:absolute></div>


<br />
<textarea name="value3" rows=9 style=width:350px;<?if (@$_POST["value3"]==dictionary("customer",$_SESSION['language'])) { echo "background:#FC7275;";}?> wrap="off"  ><?if (!$_SESSION['customer']){if (!@$_POST["value3"]){echo dictionary("customer",$_SESSION['language']);} else {echo @$_POST["value3"];}} else {echo $_SESSION['customer'];$_SESSION['customer']="";}?></textarea></td>
</tr>

<tr id=tabledata>
<td nowrap="nowrap" width=350px style=text-align:right><span style=width:210px;text-align:left><?echo dictionary("issue_date",$_SESSION['language']);?></span>
<input type="text" id=maturitydate name="value4" value="<?echo date("d.m.Y");?>" readonly=yes style=width:80px;height:23px;text-align:center; >
<INPUT TYPE="button" VALUE="Datum" onClick="cpokus=new calendaro(form.value4,'span_value4','cpokus');" style=width:50px; >
<div style=position:relative;top:0px;left:-135px; ><div style=position:absolute><SPAN ID="span_value4"></div>
</div></td>

<td nowrap="nowrap" width=350px></td>

</tr>


<tr id=tablesearch>
<td nowrap="nowrap" colspan=2 >
<table style=width:100% border="1" cellpadding="0" cellspacing="0">




<tr>
<td width=25% style=text-align:center><b><?echo dictionary("dph",$_SESSION['language']);?></b></td>
<td width=25% style=text-align:center><b><?echo dictionary("price",$_SESSION['language'])." ".dictionary("no_vat",$_SESSION['language']);?></b></td>
<td width=25% style=text-align:center><b><?echo dictionary("dph",$_SESSION['language']);?></b></td>
<td width=25% style=text-align:center><b><?echo dictionary("total",$_SESSION['language']);?></b></td>
</tr>

<?
$temp= mysql_query("select * from dph_values") or Die(MySQL_Error());
$total_price="";
$cykl=1;while($cykl<11):

	if (mysql_result($temp,0,$cykl)<>""){

		echo "<tr>
		<td width=25% style=text-align:center><input id='value".$cykl."a' name='value".$cykl."a' type=text value='".mysql_result($temp,0,$cykl)."%' readonly=yes style=text-align:center;width:100%; ></td>
		<td width=25% style=text-align:center><input id='value".$cykl."b' name='value".$cykl."b' type=text value='".@$_POST["value".$cykl."b"]."' style=text-align:center;background:#D0F5CB;width:100%; onkeyup=\"calculate('".$cykl."<!>'+this.value);\" autocomplete=off ></td>
		<td width=25% style=text-align:center><input id='value".$cykl."c' name='value".$cykl."c' type=text value='".@$_POST["value".$cykl."c"]."' readonly=yes style=text-align:center;background:#EED56C;width:100%;></td>
		<td width=25% style=text-align:center><input id='value".$cykl."d' name='value".$cykl."d' type=text value='";if(@$_POST["value".$cykl."d"]){echo @$_POST["value".$cykl."d"];}else{echo "0";}echo"' readonly=yes style=text-align:center;background:#EED56C;width:100%; ></td>
		</tr>";
if (!$total_price){$total_price="parseFloat(document.getElementById('value".$cykl."d').value)";}else{$total_price.="+parseFloat(document.getElementById('value".$cykl."d').value)";}
}

$cykl++;endwhile;?>

<tr>
<td colspan=3 style=text-align:left><b><?echo dictionary("total_price",$_SESSION['language']);?></b></td>
<td width=21% style=text-align:right><input id='value5' name='value5' type=text value='<?echo @$_POST["value5"];?>' readonly=yes style=text-align:center;font-weight:bold;background:#C1F4DF;width:70%;><select size=1 name='value6' style=width:30%>";
<?$temp1=mysql_query("select * from currency") or Die(MySQL_Error());
$cykl1=0;while(mysql_result($temp1,$cykl1,0)):
	echo"<option";if ((!@$_POST["value6"] && mysql_result($temp1,$cykl1,3)=="on") or @$_POST["value6"]==mysql_result($temp1,$cykl1,1)){echo" selected ";}echo">".mysql_result($temp1,$cykl1,1)."</option>";
$cykl1++;endwhile;?></select></td>
</tr>

</table>

</td></tr>


<tr id=tablesubmit>
<td style=text-align:left>2x<input name="2x" type="checkbox" checked> <input type="submit" name=tlacitko value="<?echo dictionary("btnsave_print",$_SESSION['language']);?>"></td>
<td style=text-align:right><input type="submit" name=tlacitko value="<?echo dictionary("btnsave",$_SESSION['language']);?>"></td>
</tr>

</table></form>





</center></body></html>



  <script type="text/javascript">
 function search_byf(res){
 selected_filter = res.options[res.selectedIndex].value;
 document.forms["form"].submit();
 }
 var selected_filter=document.getElementById('search_by').options[document.getElementById('search_by').selectedIndex].value;

 function calculate(data){
 var radek = data.split("<!>");
 var hodnota=radek[1].replace(",", ".");	 var datadph =document.getElementById('value'+radek[0]+'a').value
	 var dph = datadph.split("%");
 document.getElementById('value'+radek[0]+'c').value=Math.round((hodnota*(dph[0]/100))*100)/100; document.getElementById('value'+radek[0]+'d').value=Math.round((parseFloat(hodnota)+(hodnota*(dph[0]/100)))*100)/100;
 document.getElementById('value5').value=Math.round(parseFloat(<?echo $total_price;?>));
 }

</script>