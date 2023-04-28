<?

include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");

//logout
	if (@$_REQUEST["logout"]){session_start();session_unset();session_destroy();$root=explode("?",$_SERVER["HTTP_REFERER"]);?><script>window.location.assign('<?echo @$root[0];?>');</script><?}
//login
	if (@$_REQUEST["login"]){$results=mysql_query("select * from login where loginname='".mysql_real_escape_string($_POST['loginname'])."' and loginpass='".mysql_real_escape_string(MD5($_POST['loginpassw']))."' ");
	if (mysql_num_rows($results)) {session_destroy();session_set_cookie_params(21600);session_start();session_register("loginname");session_register("prava");
	$_SESSION['loginname']=securesql($_POST['loginname']);$_SESSION['prava']=mysql_result($results,0,3);session_register("language");$_SESSION['language']=mysql_result($results,0,7);if (!$_SESSION['language']){$_SESSION['language']=$def_language;}mysql_query ("update login set lastlogin = '$dnest' where loginname = '".mysql_real_escape_string($_POST['loginname'])."' ") or Die(MySQL_Error());}}

//session_set_cookie_params(21600);
session_set_cookie_params(strtotime('tomorrow') - time() );
session_start();
session_register("loginname");
session_register("prava");
session_register("language");if (!$_SESSION['language']){$_SESSION['language']=$def_language;}
?>
<html>
<head>
<title>Sales System</title>
<link rel="icon" href="http://localhost/InfSystem/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://localhost/InfSystem/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<link rel="stylesheet" type="text/css" href="./css/default.css" />
<?
include ("./library/javascript/knihovnajs.php");
?>


</head>

<body onunload="window.name=document.body.scrollTop" style=overflow-x:hidden;overflow-y:hidden;margin:0px;>
<table id=maintable border=1>


<!--//header//-->
<tr><td colspan=2 id=header><div style=position:relative;width:100%;height:100%;overflow-x:hidden;background:white;><img src="<?if (@mysql_result(mysql_query("select logo_mime from company where id='1'"),0,0)) { echo "./logo.php";} else {echo "./picture/logo.jpg";}?>"  height="80px" alt="" border="0"></div></td></tr>



<!--////menu//-->
<tr><td id=menu><div id=menu><? nactisoubor("./menu.php"); ?></div></td>



<!--//// body//-->
<td id=body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?>><div id=body <?if (@mysql_result(mysql_query("select background_mime from company where id='1'"),0,0)) { echo "background=./pozadi.php";} else {echo "bgcolor='".@mysql_result(mysql_query("select color from company where id='1'"),0,0)."'";}?>>

<?    // nacitani body include,iframe menu
if (@$_REQUEST["option"] && !@$_REQUEST["command"]) { //include	if (mysql_result(mysql_query("select type from menu where id='".securesql(desifra(@$_REQUEST["option"]))."'"),0,0)=="include") {		nactisoubor(mysql_result(mysql_query("select command from menu where id='".securesql(desifra(@$_REQUEST["option"]))."'"),0,0))."?select=".@$_REQUEST["select"];
	} else  // iframe
		{   // viewer			if (@$viewer=="ie") {echo "<iframe type=text/html src='".mysql_result(mysql_query("select command from menu where id='".securesql(desifra(@$_REQUEST["option"]))."'"),0,0)."?select=".@$_REQUEST["select"]."' style=align:center;width:100%;height:100%;z-index:50; align=middle frameborder=0 scrolling=auto noresize=noresize></iframe>";}
			else {echo"<object type=text/html data='".mysql_result(mysql_query("select command from menu where id='".securesql(desifra(@$_REQUEST["option"]))."'"),0,0)."?select=".@$_REQUEST["select"]."' style=align:center;width:100%;height:100%;z-index:50; align=middle frameborder=0 ></object>";}
		}
}
        // nacitani subbody include,iframe menu
if (@$_REQUEST["option"] && @$_REQUEST["command"]) { //include
	if (mysql_result(mysql_query("select type from submenu where menu_id='".securesql(desifra(@$_REQUEST["option"]))."'"),0,0)=="INCLUDE") {
		nactisoubor(securesql(desifra(@$_REQUEST["command"])));
	} else  // iframe
		{   // viewer
			if (@$viewer=="ie") {echo "<iframe type=text/html src='".securesql(desifra(@$_REQUEST["command"]))."' style=align:center;width:100%;height:100%;z-index:50; align=middle frameborder=0 scrolling=auto noresize=noresize></iframe>";}
			else {echo"<object type=text/html data='".securesql(desifra(@$_REQUEST["command"]))."' style=align:center;width:100%;height:100%;z-index:50; align=middle frameborder=0 ></object>";}
		}
}?>

</div></td></tr>





<!--//// footer//-->
<tr><td colspan=2 id=footer><div id=footer>
<?if ($_SESSION['loginname']) {?><input type=button value=<?echo dictionary("backup",$_SESSION['language']);?> style=height:20px;font-size:10px; onclick=window.open('./backup_action.php','','width=300,height=150'); ><?}?>
</div></td></tr>

</table>

<!--//login menu//-->
<div id=logintbl ><form action="<?echo $_SERVER['REQUEST_URI'];?>" method=post>
<?if ($_SESSION['loginname']) {?><br /><?echo dictionary("desclogon",$_SESSION['language']);?>: <font face="Arial"  style=font-size:12px; color=blue><b><?echo $_SESSION['loginname'];?></b></font>
<br /><input name=logout type="submit" style=font-size:12px; value="<?echo dictionary("logout",$_SESSION['language']);?>"></a>
<?} else {?><table width=100% margin=0px padding=0px cellpadding=0px cellspacing=0px style=font-size:12px; ><tr><td colspan=2 align=center><?echo dictionary("syslogin",$_SESSION['language']);?></td></tr>
<tr><td align=right><?echo dictionary("sysname",$_SESSION['language']);?>: </td><td width=100%><input name="loginname" type="text" value="" style=width:100%;height:18px></td></tr>
<tr><td align=right><?echo dictionary("syspassw",$_SESSION['language']);?>: </td><td width=100%><input name="loginpassw" type="password" value="" style=width:100%;height:18px></td></tr>
<tr><td colspan=2 align=right><input name=login type="submit" style=font-size:12px; value='<?echo dictionary("btnlogon",$_SESSION['language']);?>'></td><td></td></tr>
</table>
<?}?>
</form></div>
<!--//end login//-->

</body></html>