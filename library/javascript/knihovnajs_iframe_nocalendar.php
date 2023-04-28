<!--// 3 ochrany proti navratu zpet, zmacknuti F5 jako reload, a zakaz praveho tlacitka mysi//-->
<SCRIPT LANGUAGE="JavaScript">
javascript:window.history.forward(0);
</SCRIPT>

<script language="JavaScript">
if (document.all){
document.onkeydown = function (){    var key_f5 = 116; // 116 = F5
if (key_f5==event.keyCode){
event.keyCode = 27;return false;
}}}
</script>

<script language ="javascript">
function Disable() {
if (event.button == 2)
{
alert("Akce je Zakázána!! / Action denied!!")
}}
document.onmousedown=Disable;
</script>


 <!--// skrolovani zpet na misto stranky odkud byl vyvolan reload jeste musi byt nastaven v body  onunload="window.name=document.body.scrollTop"//-->
<script type="text/JavaScript">
function doScroll(){
  if (window.name) window.scrollTo(0, 10000);
}
</script>


<SCRIPT style="text/javascript">
window.onload=function(){
	doScroll();
}




function filter(a,b,c){
window.open('./filter.php?'+a+'&'+b+'&'+c,'','width=220,height=220,resizable=yes');
}

function msfilter(a,b,c){
window.open('./msfilter.php?'+a+'&'+b+'&'+c,'','width=220,height=220,resizable=yes');
}




function TableToExcel(){
var tabdata="<table><tr>";
  sourcetab   = document.getElementById('export_excel'); // id of actual table on your page
  for(j = 0 ; j < sourcetab.rows.length ; j++) {
 if (sourcetab.rows[j].style.display ==''){
	   tabdata=tabdata+sourcetab.rows[j].innerHTML;
	    tabdata=tabdata+"</tr><tr>";}

  }tabdata=tabdata+"</tr></table>";
  	 with(document){
	  ir=createElement('iframe');
	  ir.id='ifr';ir.location='about.blank';ir.style.display='none';body.appendChild(ir);
		with(getElementById('ifr').contentWindow.document){
	      	   open("txt/html","replace");write(tabdata);close();execCommand('SaveAs',false,'Export_xls');}
	 body.removeChild(ir);}
}



function custsearch(custname) {
//document.getElementById('custsearch').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './customcheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function custinvsearch(custname) {
//document.getElementById('custinvsearch').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './custominvcheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function inv_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './invoicecheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function inv_storno_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './invoicestornocheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function cash_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './cashcheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function cash_storno_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './cashstornocheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function credit_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './creditcheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

function credit_storno_search(custname) {
//document.getElementById('inv_search').innerHTML="Please wait...";

script = document.createElement('script');
script.src = './creditstornocheck.php?custname=' + custname;
document.getElementsByTagName('head')[0].appendChild(script);
}

</SCRIPT>