<?
@$dnes=date("Y-m-d");

$id=base64_decode(@$_GET["id"]);
$lang=base64_decode(@$_GET["lang"]);

include ("./"."dbconnect.php");
mysql_query("SET NAMES 'cp1250'");

function dictionary($a,$b){
$a=mysql_result(mysql_query("select $b from dictionary where systemname = '".($a)."' "),0,0);
return $a;
}

function datecs($a){
if (StrPos (" " . $a, "-") and $a){$exploze = explode("-", $a);$a   = $exploze[2].".".$exploze[1].".".$exploze[0];}
return $a;
}

function securesql($a){
$a=str_replace("  "," ",$a);
$a=mysql_real_escape_string($a);
return $a;
}

$data=mysql_query("select * from company where id='1' ");
$data1=mysql_query("select * from invoices_header where id='".securesql($id)."' ");
$data2=mysql_query("select * from invoices_items where invoice_id='".securesql($id)."' ");

define('FPDF_FONTPATH',"fpdf/fnt/");
require("fpdf/fpdf.php");

//$pdf = new FPDF('L','mm','A4');
$pdf = new FPDF('P','mm','A4');

$pdf->Open();
$pdf->AddFont('tahoma','',"tahoma.php");
$pdf->AddFont('tahomabd','',"tahomabd.php");
$pdf->SetMargins(10,5,10,5);
$pdf->AddPage();

// header
$pdf->SetFont('tahomabd','',12);
$pdf->Cell(100,6,mysql_result($data,0,1),0,0,'L');$pdf->Cell(91,6,dictionary("invoice_no",$lang)." ".mysql_result($data1,0,1),0,0,'R');
$pdf->Ln(5);

$pdf->SetFont('tahoma','',8);
$pdf->Cell(96,4,dictionary("supplier",$lang),'LRT',0,'L');$pdf->Cell(95,4,dictionary("customer",$lang),'LRT',0,'L');
$pdf->Ln();

$pdf->SetFont('tahomabd','',10);

$temp=explode("\n",mysql_result($data1,0,2));
$temp1=explode("\n",mysql_result($data1,0,3));
$cykl=0;while($temp[$cykl] or $temp1[$cykl]):

$pdf->Cell(96,4,str_replace("\r","",$temp[$cykl]),'LR',0,'L');
$pdf->Cell(95,4,str_replace("\r","",$temp1[$cykl]),'LR',0,'L');
$pdf->Ln();

@$cykl++;endwhile;

$pdf->Cell(96,4,"",'LR',0,'L');$pdf->Cell(95,4,"",'LR',0,'L');$pdf->Ln();
$pdf->SetFont('tahoma','',10);
$pdf->Cell(30,6,dictionary("bank_account",$lang),'LR',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(50,6,mysql_result($data,0,8),'LBRT',0,'R');$pdf->Cell(16,6,mysql_result($data,0,7),'LBRT',0,'L');
$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("payment_method",$lang),'LT',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,5)." ",'TR',0,'R');
$pdf->Ln();

$pdf->SetFont('tahoma','',10);
$pdf->Cell(70,6,dictionary("issue_date",$lang),'LR',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,4)),'LBRT',0,'C');
$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("variable_symbol",$lang),'L',0,'L');
if (!mysql_result($data,0,21)) {$vars=mysql_result($data1,0,1);}else {$vars=mysql_result($data,0,21);}
$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$vars." ",'R',0,'R');
$pdf->Ln();

$pdf->SetFont('tahoma','',10);
$pdf->Cell(70,6,dictionary("taxation_date",$lang),'LR',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,6)),'LBRT',0,'C');
$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("constant_symbol",$lang),'L',0,'L');

$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data,0,20)." ",'R',0,'R');
$pdf->Ln();

$pdf->SetFont('tahoma','',10);
$pdf->Cell(70,6,dictionary("maturity_date",$lang),'LR',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,8)),'LRT',0,'C');
$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,"",'L',0,'L');
if (mysql_result($data1,0,13)=="S"){$status=dictionary("canceled",$lang);}else{$status="";}
$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$status." ",'R',0,'R');
$pdf->Ln();

$pdf->SetFont('tahoma','',10);
$pdf->Cell(40,6,dictionary("order",$lang),'BLT',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(56,6,datecs(mysql_result($data1,0,16)),'BRT',0,'R');
$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("service_no",$lang),'BLT',0,'L');

$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,17)." ",'BRT',0,'R');
$pdf->Ln();


$pdf->Cell(191,4,"",'LR',0,'L');$pdf->Ln();
$pdf->SetFont('tahomabd','',10);
$pdf->Cell(100,6,dictionary("invoice_items",$lang),'BL',0,'L');
$pdf->Cell(25,6,dictionary("amount",$lang),'B',0,'R');
$pdf->Cell(25,6,dictionary("unit_price",$lang),'B',0,'R');
$pdf->Cell(25,6,dictionary("total",$lang),'B',0,'R');
$pdf->Cell(16,6,dictionary("dph",$lang),'BR',0,'R');
$pdf->Ln();

$total_pages=1;

$pdf->SetFont('tahoma','',10); $sumradku=1;  // max pocet radku je 45
$dph=",";
$total=0;

// body
$cykl=0;while($cykl<mysql_num_rows($data2)):


	$temp2=explode("\n",mysql_result($data2,$cykl,2));

// next page
 $check=1;while($temp2[$check]):@$check++;endwhile;
if (($check+$sumradku)>=31){while($sumradku<32):$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$sumradku++;endwhile;
	$total_pages++;$sumradku=1;
	$pdf->SetFont('tahoma','',10);$pdf->Cell(191,6,dictionary("page",$lang).': '.$pdf->PageNo()." / ".$total_pages,'LBRT',0,'R');
	$pdf->AddPage();
	// header
	$pdf->SetFont('tahomabd','',12);$pdf->Cell(100,6,mysql_result($data,0,1),0,0,'L');$pdf->Cell(91,6,dictionary("invoice_no",$lang)." ".mysql_result($data1,0,1),0,0,'R');$pdf->Ln(5);
	$pdf->SetFont('tahoma','',8);$pdf->Cell(96,6,dictionary("supplier",$lang),'LRT',0,'L');$pdf->Cell(95,6,dictionary("customer",$lang),'LRT',0,'L');$pdf->Ln(6);
	$pdf->SetFont('tahomabd','',10);
	$temp=explode("\n",mysql_result($data1,0,2));$temp1=explode("\n",mysql_result($data1,0,3));
	$cykl1=0;while($temp[$cykl1] or $temp1[$cykl1]):$pdf->Cell(96,4,str_replace("\r","",$temp[$cykl1]),'LR',0,'L');$pdf->Cell(95,4,str_replace("\r","",$temp1[$cykl1]),'LR',0,'L');
	$pdf->Ln(4);@$cykl1++;endwhile;
	$pdf->Cell(96,6,"",'LR',0,'L');$pdf->Cell(95,6,"",'LR',0,'L');$pdf->Ln(6);$pdf->SetFont('tahoma','',10);$pdf->Cell(30,6,dictionary("bank_account",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(50,6,mysql_result($data,0,8),'LBRT',0,'R');$pdf->Cell(16,6,mysql_result($data,0,7),'LBRT',0,'L');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("payment_method",$lang),'LT',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,5)." ",'TR',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("issue_date",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,4)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("variable_symbol",$lang),'L',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$vars." ",'R',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("taxation_date",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,6)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("constant_symbol",$lang),'L',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data,0,20)." ",'R',0,'R');$pdf->Ln(6);
	
    $pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("maturity_date",$lang),'BLR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,8)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,"",'BL',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$status." ",'BR',0,'R');$pdf->Ln(6);
    $pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("order_no",$lang),'BLR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,16)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("service_no",$lang),'BL',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,17),'BR',0,'R');$pdf->Ln(6);
	
    $pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$pdf->SetFont('tahomabd','',10);$pdf->Cell(100,6,dictionary("invoice_items",$lang),'BL',0,'L');$pdf->Cell(25,6,dictionary("amount",$lang),'B',0,'R');$pdf->Cell(25,6,dictionary("unit_price",$lang),'B',0,'R');$pdf->Cell(25,6,dictionary("total",$lang),'B',0,'R');$pdf->Cell(16,6,dictionary("dph",$lang),'BR',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);
}

	$radky=0;while($temp2[$radky]):
	$pdf->Cell(100,6,str_replace("\r","",$temp2[$radky]),'L',0,'L');
if ($radky==0){	$pdf->Cell(25,6,mysql_result($data2,$cykl,3)." ".mysql_result($data2,$cykl,5),'',0,'R');
	$pdf->Cell(25,6,mysql_result($data2,$cykl,4)." ".mysql_result($data1,0,14),'',0,'R');
	$pdf->Cell(25,6,round((mysql_result($data2,$cykl,3)*mysql_result($data2,$cykl,4)),2)." ".mysql_result($data1,0,14),'',0,'R');
	$pdf->Cell(16,6,mysql_result($data2,$cykl,6)."%",'R',0,'R');

	$total=$total+round((mysql_result($data2,$cykl,3)*mysql_result($data2,$cykl,4)),2);
	if (!StrPos (" " . $dph, ",".mysql_result($data2,$cykl,6).",")){$dph.=mysql_result($data2,$cykl,6).",";}
	$sumadph[mysql_result($data2,$cykl,6)]=$sumadph[mysql_result($data2,$cykl,6)]+round((mysql_result($data2,$cykl,3)*mysql_result($data2,$cykl,4)),2);

	} else {$pdf->Cell(91,6,"",'R',0,'C');}
	$pdf->Ln(6);$sumradku++;
	$radky++;endwhile;

$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$sumradku++;


@$cykl++;endwhile;





// vat table
$rozpad=explode(",",$dph);
$check=1;while($rozpad[$check]<>""):@$check++;endwhile;

if (($check+$sumradku+3)>=31){while($sumradku<32):$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$sumradku++;endwhile;
	$total_pages++;$sumradku=1;
	$pdf->SetFont('tahoma','',10);$pdf->Cell(191,6,dictionary("page",$lang).': '.$pdf->PageNo()." / ".$total_pages,'LBRT',0,'R');
	$pdf->AddPage();
	// header
	$pdf->SetFont('tahomabd','',12);$pdf->Cell(100,6,mysql_result($data,0,1),0,0,'L');$pdf->Cell(91,6,dictionary("invoice_no",$lang)." ".mysql_result($data1,0,1),0,0,'R');$pdf->Ln(5);
	$pdf->SetFont('tahoma','',8);$pdf->Cell(96,6,dictionary("supplier",$lang),'LRT',0,'L');$pdf->Cell(95,6,dictionary("customer",$lang),'LRT',0,'L');$pdf->Ln(6);
	$pdf->SetFont('tahomabd','',10);
	$temp=explode("\n",mysql_result($data1,0,2));$temp1=explode("\n",mysql_result($data1,0,3));
	$cykl1=0;while($temp[$cykl1] or $temp1[$cykl1]):$pdf->Cell(96,4,str_replace("\r","",$temp[$cykl1]),'LR',0,'L');$pdf->Cell(95,4,str_replace("\r","",$temp1[$cykl1]),'LR',0,'L');
	$pdf->Ln(4);@$cykl1++;endwhile;
	$pdf->Cell(96,6,"",'LR',0,'L');$pdf->Cell(95,6,"",'LR',0,'L');$pdf->Ln(6);$pdf->SetFont('tahoma','',10);$pdf->Cell(30,6,dictionary("bank_account",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(50,6,mysql_result($data,0,8),'LBRT',0,'R');$pdf->Cell(16,6,mysql_result($data,0,7),'LBRT',0,'L');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("payment_method",$lang),'LT',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,5)." ",'TR',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("issue_date",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,4)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("variable_symbol",$lang),'L',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$vars." ",'R',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("taxation_date",$lang),'LR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,6)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("constant_symbol",$lang),'L',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data,0,20)." ",'R',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("maturity_date",$lang),'BLR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,8)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,"",'BL',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,$status." ",'BR',0,'R');$pdf->Ln(6);
    $pdf->SetFont('tahoma','',10);$pdf->Cell(70,6,dictionary("order_no",$lang),'BLR',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,16)),'LBRT',0,'C');$pdf->SetFont('tahoma','',10);$pdf->Cell(40,6,dictionary("service_no",$lang),'BL',0,'L');$pdf->SetFont('tahomabd','',10);$pdf->Cell(55,6,mysql_result($data1,0,17),'BR',0,'R');$pdf->Ln(6);
	$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$pdf->SetFont('tahomabd','',10);$pdf->Cell(100,6,dictionary("invoice_items",$lang),'BL',0,'L');$pdf->Cell(25,6,dictionary("amount",$lang),'B',0,'R');$pdf->Cell(25,6,dictionary("unit_price",$lang),'B',0,'R');$pdf->Cell(25,6,dictionary("total",$lang),'B',0,'R');$pdf->Cell(16,6,dictionary("dph",$lang),'BR',0,'R');$pdf->Ln(6);
	$pdf->SetFont('tahoma','',10);
}


$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);$sumradku++;
$pdf->SetFont('tahomabd','',10);
$pdf->Cell(26,6,dictionary("dph",$lang),'LBRT',0,'L');
$pdf->Cell(26,6,dictionary("no_vat",$lang)." ".mysql_result($data1,0,14),'LBRT',0,'C');
$pdf->Cell(26,6,dictionary("dph",$lang)." ".mysql_result($data1,0,14),'LBRT',0,'C');
$pdf->Cell(26,6,dictionary("total",$lang)." ".mysql_result($data1,0,14),'LBRT',0,'C');
$pdf->Cell(87,6,"",'R',0,'C');
$pdf->Ln(6);$sumradku++;


$final=0;$cykl=1;while ($rozpad[$cykl]<>""):
$pdf->SetFont('tahoma','',10);
$pdf->Cell(26,6,dictionary("dph",$lang)." ".$rozpad[$cykl]."%",'LBRT',0,'L');
$pdf->Cell(26,6,number_format($sumadph[$rozpad[$cykl]], 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format(round(($sumadph[$rozpad[$cykl]]*($rozpad[$cykl]/100)),2), 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format((round(($sumadph[$rozpad[$cykl]]*($rozpad[$cykl]/100)),2)+$sumadph[$rozpad[$cykl]]), 2, ',', ' '),'LBRT',0,'C');
$final=$final+(round(($sumadph[$rozpad[$cykl]]*($rozpad[$cykl]/100)),2)+$sumadph[$rozpad[$cykl]]);

if ($rozpad[($cykl+1)]==""){$pdf->Cell(25,6,"",'',0,'C');$pdf->SetFont('tahomabd','',12);$pdf->Cell(30,6,dictionary("total_price",$lang).":",'LBT',0,'L');$pdf->Cell(32,6,number_format(round($final,0), 0, ',', ' ')." ".mysql_result($data1,0,14),'BRT',0,'R');}
 else {$pdf->Cell(87,6,"",'R',0,'C');}

$pdf->Ln(6);$sumradku++;
@$cykl++;endwhile;


while($sumradku<31):
$pdf->Cell(191,6,"",'LR',0,'L');$pdf->Ln(6);
$sumradku++;endwhile;

$pdf->SetFont('tahoma','',10);$pdf->Cell(191,6,dictionary("page",$lang).': '.$pdf->PageNo()." / ".$total_pages,'LBRT',0,'R');
$pdf->Output();
