<?

function securesql($a){$a=str_replace("  "," ",$a);
$a=mysql_real_escape_string($a);
return $a;
}

function datetcs($a){
if (StrPos (" " . $a, "-") and $a){$d=explode(" ", $a);
	$exploze = explode("-", $d[0]);$a   = $exploze[2].".".$exploze[1].".".$exploze[0];}
	if ($a=="00.00.0000") {$a="";}
return $a;
}

function datecs($a){if (StrPos (" " . $a, "-") and $a){$exploze = explode("-", $a);$a   = $exploze[2].".".$exploze[1].".".$exploze[0];}
return $a;
}

function datedb($a){
if (StrPos (" " . $a, ".") and $a){$exploze = explode(".", $a);$a   = $exploze[2]."-".$exploze[1]."-".$exploze[0];}
return $a;
}

function obdobics($a){
if (StrPos (" " . $a, "-") and $a){$exploze = explode("-", $a);$a   = $exploze[1].".".$exploze[0];}
return $a;
}

function obdobidb($a){
if (StrPos (" " . $a, ".") and $a){$exploze = explode(".", $a);$a   = $exploze[1]."-".$exploze[0];}
return $a;
}

function nactisoubor($a){
include ("./".$a);
}

function sifra($a){
$a=base64_encode($a);
return $a;
}

function desifra($a){
$a=base64_decode($a);
return $a;
}

function dictionary($a,$b){$b=securesql($b);
$a=mysql_result(mysql_query("select $b from dictionary where systemname = '".securesql($a)."' "),0,0);
return $a;
}

function limit($a,$b,$c){
echo "<select size=\"1\" name=\"limit\" onchange=submit(this) width=100% align=right>";
if ($a && !@$_REQUEST["limit"]){echo "<option>".$a."</option>";@$_REQUEST["limit"]=$a;}
if (!$a && !@$_REQUEST["limit"]){echo "<option>".$b."</option>";}
if (@$_REQUEST["limit"]){echo "<option>".@$_REQUEST["limit"]."</option>";}
echo"<option>20</option><option>50</option><option>100</option><option>500</option><option>".$b."</option></select><br />";
}

function removedia($a){$b = Str_Replace(
array('Á','Ä','É','Ë','Ì','Í','Ý','Ó','Ö','Ú','Ù','Ü','Ž','Š','È','Ø','Ï','','Ò','¼','á','ä','é','ë','ì','í','ý','ó','ö','ú','ù','ü','ž','š','è','ø','ï','','ò','¾'),
array('a','a','e','e','e','i','y','o','o','u','u','u','z','s','c','r','d','t','n','l','a','a','e','e','e','i','y','o','o','u','u','u','z','s','c','r','d','t','n','l'),
$a);return $b;
}

function iid(){   // vraceni id vlozeneho zaznamu
$a=mysql_insert_id();return $a;
}


function full_copy( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry;
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}

		$d->close();
	}else {
		copy( $source, $target );
	}
}


?>

