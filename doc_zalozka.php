<?
@$name=base64_decode(@$_GET["name"]);

include ("./config/dbconnect.php");


$name1=mysql_result(mysql_query("select cash_no from cash_header where invoice_no='".mysql_real_escape_string($name)."' "),0,0);
$name2=mysql_result(mysql_query("select credit_no from credit_header where invoice_no='".mysql_real_escape_string($name)."' "),0,0);
$size=3;$xpos=4;
if (!$name1 and !$name2){$size=4;$xpos=10;$name1=mysql_result(mysql_query("select DATE_FORMAT(issue_date,'%d.%m.%Y') from invoices_header where invoice_no='".mysql_real_escape_string($name)."' "),0,0);}

//if (false === var_dump( function_exists('imageantialias'))) echo 'error1';
//if (false === var_dump( function_exists('imagecreatetruecolor'))) echo 'error2';

$maxy =50;
  $obrazek = imagecreatetruecolor(105,$maxy);
  $seda = imagecolorallocate($obrazek,230,230,230);
  $tmaveseda = imagecolorallocate($obrazek,108,108,108);
  $supertmaveseda = imagecolorallocate($obrazek,50,50,50);
   $cerna = imagecolorallocate($obrazek,0,0,0);
   $pcerna = imagecolorallocate($obrazek,1,1,1);
  $zelena = imagecolorallocate($obrazek,71,231,105);
  $cervena = imagecolorallocate($obrazek,255,0,0);

$tbarva=$pcerna;
$barva=$seda;
$barva1=$tmaveseda;


imagecolortransparent ($obrazek ,$cerna ); // zpruhledneni cerne

//ram
imagefilledrectangle($obrazek,0,1,103,50,$barva1);
// vypln
imagefilledrectangle($obrazek,2,3,101,47,$barva);



imagesetthickness ($obrazek, 2);



	imagestring ($obrazek, 3, 4, 4, iconv("utf-8", "windows-1250", $name), $tbarva);
	imagestring ($obrazek, $size, $xpos, 19, iconv("utf-8", "windows-1250", $name1), $tbarva);
	imagestring ($obrazek, $size, $xpos, 34, iconv("utf-8", "windows-1250", $name2), $tbarva);



  header('Content-Type: image/png');
  imagepng($obrazek);
  imagedestroy($obrazek);
  ?>

