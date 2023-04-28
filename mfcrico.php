<?php
if (isset($_GET['ico'])) {

include ("./config/dbconnect.php");
include ("./library/php/knihovna.php");
include ("./library/php/main_variable.php");

$xmlDoc = new DOMDocument();
$xmlDoc->load("http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_std.cgi?ico=".$_GET['ico']);

$part= $xmlDoc->documentElement;
$xmlDoc->saveXML();

$xpath = new DOMXPath($xmlDoc);
?>

document.getElementById('value1').value = '<?echo $xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Obchodni_firma)");?>';
document.getElementById('value2').value = '<?echo $xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Identifikace/are:Adresa_ARES/dtt:Nazev_ulice)")." ".$xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Identifikace/are:Adresa_ARES/dtt:Cislo_domovni)")."/".$xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Identifikace/are:Adresa_ARES/dtt:Cislo_orientacni)");?>';
document.getElementById('value3').value = '<?echo $xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Identifikace/are:Adresa_ARES/dtt:Nazev_obce)");?>';
document.getElementById('value4').value = '<?echo $xpath->evaluate("string(/are:Ares_odpovedi/are:Odpoved/are:Zaznam/are:Identifikace/are:Adresa_ARES/dtt:PSC)");?>';

<?}



?>
