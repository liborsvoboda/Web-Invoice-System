<?
@$name=base64_decode(@$_GET["name"]);


//if (false === var_dump( function_exists('imageantialias'))) echo 'error1';
//if (false === var_dump( function_exists('imagecreatetruecolor'))) echo 'error2';

if (@$_GET["sel"]=="on") {$maxy =23;} else {$maxy =22;}
  $obrazek = imagecreatetruecolor(71,$maxy);
  $seda = imagecolorallocate($obrazek,250,250,250);
  $tmaveseda = imagecolorallocate($obrazek,108,108,108);
  $supertmaveseda = imagecolorallocate($obrazek,50,50,50);
   $cerna = imagecolorallocate($obrazek,0,0,0);
   $pcerna = imagecolorallocate($obrazek,1,1,1);
  $zelena = imagecolorallocate($obrazek,69,231,70);
  $cervena = imagecolorallocate($obrazek,255,0,0);

if (@$_GET["sel"]=="on") {$tbarva=$pcerna;} else {$tbarva=$supertmaveseda;}
if (@$_GET["sel"]=="on") {$barva=$seda;} else {$barva=$tmaveseda;}
if (@$_GET["sel"]=="on") {$barva1=$tmaveseda;} else {$barva1=$supertmaveseda;}


imagecolortransparent ($obrazek ,$cerna ); // zpruhledneni cerne

//ram
imagefilledrectangle($obrazek,0,0,70,11,$barva1);
imagefilledrectangle($obrazek,8,11,70,$maxy,$barva1);
// vypln
imagefilledrectangle($obrazek,2,2,69,11,$barva);
imagefilledrectangle($obrazek,10,2,64,19,$barva);



imagesetthickness ($obrazek, 2);

// ram oblouku
   imagefilledarc($obrazek, 11, 11, 22, 22, 90, 180, $barva1, IMG_ARC_PIE);
   imagefilledarc($obrazek, 62, 11, 22, 22, 0, 90, $barva1, IMG_ARC_PIE);
// vypln oblouku
   imagefilledarc($obrazek, 13, 8, 22, 22, 90, 180, $barva, IMG_ARC_PIE);
   imagefilledarc($obrazek, 58, 8, 22, 22, 0, 90, $barva, IMG_ARC_PIE);


	imagestring ($obrazek, 2, 4, 1, iconv("utf-8", "windows-1250", $name), $tbarva);



  header('Content-Type: image/png');
  imagepng($obrazek);
  imagedestroy($obrazek);
  ?>

