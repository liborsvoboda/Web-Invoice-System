<?
unset($_SESSION["filter"]);
unset($_SESSION["sort"]);
?>


<style type="text/css">
tr.menuon  {background-color:#89A9D8;cursor:pointer;}
tr.menuoff {background-color:#BFC4F9;}

td.smenuon  {background-color:#89A9D8;cursor:pointer;}
td.smenuoff {background-color:#BFC4F9;}

#NEW {color:green;font-weight: bold;font-size: 8px;vertical-align:top;}
#UPDATE {color:#E2A82E;font-weight: bold;font-size: 8px;vertical-align:top;}

</style>

<?$urivalue=explode("?",$_SERVER["REQUEST_URI"]);?>



<table width=100% height=100%><?
include ("./library/php/main_variable.php");
$menu1=mysql_query("select * from menu order by position") or Die(MySQL_Error());
$cykl=0;while(@$cykl<mysql_num_rows($menu1)):

if (@$_REQUEST["mark_".mysql_result($menu1,$cykl,0)]=="minus" or !@$_REQUEST["mark_".mysql_result($menu1,$cykl,0)]) {$mark="plus";$nmark="minus";} else {$mark="minus";$nmark="plus";}



		 // search submenu
		$smenu1=mysql_query("select * from submenu where menu_id='".securesql(mysql_result($menu1,$cykl,0))."' order by position") or Die(MySQL_Error());

//control access

if (StrPos (" " . $_SESSION["prava"], ",".mysql_result($menu1,$cykl,4).",") or !mysql_result($menu1,$cykl,4)){

?><tr height=20px <?if ($urivalue[1]==("option=".sifra(mysql_result($menu1,$cykl,0))."&mark_".mysql_result($menu1,$cykl,0)."=".$nmark) or $urivalue[1]==("option=".sifra(mysql_result($menu1,$cykl,0)))){echo" style=background-color:gold;cursor:pointer; ";} else {echo"style=cursor:pointer onmouseover=\"className='smenuon';\" onmouseout=\"className='smenuoff';\" ";}?>><?

			//write selected ico
			if (mysql_num_rows($smenu1)) {?><td nowrap=\"nowrap\" style="vertical-align: middle" onclick="window.location.href=('?option=<?echo sifra(mysql_result($menu1,$cykl,0));?>&mark_<?echo mysql_result($menu1,$cykl,0);?>=<?echo $mark;?>')" ><img src='./outputs/menuico.php?id=<?echo sifra(mysql_result($menu1,$cykl,0));?>' height=20px border='0' style=vertical-align:middle;><img src='./picture/<?echo $mark;?>.jpg' height=15px border='0' style=vertical-align:middle;></td><td onclick="window.location.href=('?option=<?echo sifra(mysql_result($menu1,$cykl,0));?>&mark_<?echo mysql_result($menu1,$cykl,0);?>=<?echo $nmark;?>')" ><?}
			else {?><td style="vertical-align: middle" onclick="window.location.href=('?option=<?echo sifra(mysql_result($menu1,$cykl,0));?>')" width=30px><img src='./outputs/menuico.php?id=<?echo sifra(mysql_result($menu1,$cykl,0));?>' height=20px border='0' style=vertical-align:middle;></td><td onclick="window.location.href=('?option=<?echo sifra(mysql_result($menu1,$cykl,0));?>')" ><?}

// line menu name
echo " ".dictionary(mysql_result($menu1,$cykl,2),$_SESSION['language']);if ((mysql_result($menu1,$cykl,5)=="NEW" or mysql_result($menu1,$cykl,5)=="UPDATE") and mysql_result($menu1,$cykl,9)>=$dnes){echo " <span id='".mysql_result($menu1,$cykl,5)."'>".mysql_result($menu1,$cykl,5)."</span>";}echo"</td></tr>";


		// line submenu name
		if (mysql_num_rows($smenu1) && $mark=="minus") {			$cykl1=0;while($cykl1<mysql_num_rows($smenu1)):
		         //control access
				if (StrPos (" " . $_SESSION["prava"], ",".mysql_result($smenu1,$cykl1,5).",") or !mysql_result($smenu1,$cykl1,5)){
	                if (mysql_result($smenu1,$cykl1,7)=="SUBITEM"){$loadtype="&select=".sifra(mysql_result($smenu1,$cykl1,6));}
    	            if (mysql_result($smenu1,$cykl1,7)=="IFRAME"){$loadtype="&command=".sifra(mysql_result($smenu1,$cykl1,8));}
        	        if (mysql_result($smenu1,$cykl1,7)=="INCLUDE"){$loadtype="&command=".sifra(mysql_result($smenu1,$cykl1,8));}

                // line submenu name
				echo"<tr height=15px><td style=vertical-align:middle></td><td nowrap=\"nowrap\" ";if ($urivalue[1]==("option=".sifra(mysql_result($menu1,$cykl,0))."&mark_".mysql_result($menu1,$cykl,0)."=".$nmark.$loadtype)){echo" style=background-color:gold;cursor:pointer; ";} else {echo" onmouseover=\"className='smenuon';\" onmouseout=\"className='smenuoff';\"";}
				echo" style=font-size:12px onclick=\"window.location.href=('?option=".sifra(mysql_result($menu1,$cykl,0))."&mark_".mysql_result($menu1,$cykl,0)."=".$nmark.$loadtype."')\" >"." ".dictionary(mysql_result($smenu1,$cykl1,3),$_SESSION['language']); if ((mysql_result($smenu1,$cykl1,4)=="NEW" or mysql_result($smenu1,$cykl1,4)=="UPDATE") and mysql_result($smenu1,$cykl1,9)>=$dnes){echo " <span id='".mysql_result($smenu1,$cykl1,4)."'>".mysql_result($smenu1,$cykl1,4)."</span>";}echo "</td></tr>";
             }
			@$cykl1++;endwhile;
}
}
@$cykl++;endwhile;
?>

<tr><td colspan=2></td></tr></table>