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
$data1=mysql_query("select * from cash_header where id='".securesql($id)."' ");
$data2=mysql_query("select * from cash_items where cash_id='".securesql($id)."' ");

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
$pdf->Cell(100,6,mysql_result($data,0,1),0,0,'L');$pdf->Cell(91,6,dictionary("revenue_cash_voucher",$lang).": ".mysql_result($data1,0,1),0,0,'R');
$pdf->Ln(5);

$pdf->SetFont('tahoma','',8);
$pdf->Cell(96,4,dictionary("supplier",$lang),'LRT',0,'L');$pdf->Cell(95,4,dictionary("customer",$lang),'LRT',0,'L');
$pdf->Ln();

$pdf->SetFont('tahomabd','',10);

$temp=explode("\n",mysql_result($data1,0,3));
$temp1=explode("\n",mysql_result($data1,0,4));
$cykl=0;while($temp[$cykl] or $temp1[$cykl]):

$pdf->Cell(96,4,str_replace("\r","",$temp[$cykl]),'LR',0,'L');
$pdf->Cell(95,4,str_replace("\r","",$temp1[$cykl]),'LR',0,'L');
$pdf->Ln();

@$cykl++;endwhile;

$pdf->Cell(191,6,"",'LTR',0,'L');$pdf->Ln(6);

$pdf->SetFont('tahoma','',10);
$pdf->Cell(165,6,dictionary("issue_date",$lang),'LR',0,'L');
$pdf->SetFont('tahomabd','',10);$pdf->Cell(26,6,datecs(mysql_result($data1,0,5)),'LBRT',0,'C');
$pdf->Cell(95,6,"",'LR',0,'L');
$pdf->Ln();


$pdf->SetFont('tahoma','',10);
$pdf->Cell(104,6,"",'LTR',0,'L');$pdf->Cell(87,6,dictionary("signature",$lang),'LTR',0,'C');$pdf->Ln(6);
if (mysql_result($data1,0,12)=="S"){$status=dictionary("canceled",$lang);}else{$status="";}
$pdf->SetFont('tahomabd','',20);
$pdf->Cell(104,6,"",'LR',0,'L');$pdf->Cell(87,6,"",'LR',0,'L');$pdf->Ln(6);
$pdf->Cell(104,6,$status,'LR',0,'C');$pdf->Cell(87,6,"",'LR',0,'L');$pdf->Ln(6);
$pdf->Cell(104,6,"",'LR',0,'L');$pdf->Cell(87,6,"",'LR',0,'L');$pdf->Ln(6);

$pdf->SetFont('tahomabd','',10);
$pdf->Cell(26,6,dictionary("dph",$lang),'LBRT',0,'L');
$pdf->Cell(26,6,dictionary("no_vat",$lang)." ".mysql_result($data1,0,7),'LBRT',0,'C');
$pdf->Cell(26,6,dictionary("dph",$lang)." ".mysql_result($data1,0,7),'LBRT',0,'C');
$pdf->Cell(26,6,dictionary("total",$lang)." ".mysql_result($data1,0,7),'LBRT',0,'C');
$pdf->Cell(87,6,"",'R',0,'C');
$pdf->Ln(6);


$cykl=0;while ($cykl<mysql_num_rows($data2)):

$value1=$value1+mysql_result($data2,$cykl,4);$value2=$value2+mysql_result($data2,$cykl,5);$value3=$value3+mysql_result($data2,$cykl,6);
$pdf->SetFont('tahoma','',10);
$pdf->Cell(26,6,mysql_result($data2,$cykl,3)."%",'LBRT',0,'L');
$pdf->Cell(26,6,number_format(mysql_result($data2,$cykl,4), 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format(mysql_result($data2,$cykl,5), 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format(mysql_result($data2,$cykl,6), 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(87,6,"",'R',0,'C');
$pdf->Ln(6);

@$cykl++;endwhile;

$pdf->SetFont('tahomabd','',10);
$pdf->Cell(26,6,dictionary("total",$lang),'LBRT',0,'L');
$pdf->Cell(26,6,number_format($value1, 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format($value2, 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(26,6,number_format($value3, 2, ',', ' '),'LBRT',0,'C');
$pdf->Cell(25,6,"",'B',0,'C');$pdf->SetFont('tahomabd','',12);$pdf->Cell(30,6,dictionary("total_price",$lang).":",'LBT',0,'L');$pdf->Cell(32,6,round(mysql_result($data1,0,6),0)." ".mysql_result($data1,0,7),'BRT',0,'R');


$pdf->Output();
