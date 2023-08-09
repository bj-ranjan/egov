<body>
<?php
session_start();
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
require_once './class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
//Rows per Page
if (isset($_GET['mrows']))
$mrows=$_GET['mrows'];
else
$mrows=15;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=48;

$mpdf=true;
//$mpdf=false;
$objUtility=new Utility();
$objBakijai_main=new Bakijai_main();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//$PageFormat="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

$PageOrientation="L";  //Landscap
$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$cwidth[0]="5%";
$cwidth[1]="10%";
$cwidth[2]="10%";
$cwidth[3]="10%";
$cwidth[4]="10%";
$cwidth[5]="10%";
$cwidth[6]="10%";
$cwidth[7]="10%";
$cwidth[8]="10%";
$cwidth[9]="10%";
$cwidth[10]="10%";
$cwidth[11]="10%";
$cwidth[12]="10%";
$cwidth[13]="10%";
$cwidth[14]="10%";
$cwidth[15]="10%";
$cwidth[16]="10%";
$cwidth[17]="10%";
$cwidth[18]="10%";
$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->setPrintFooter(false);
$tblfdata="";
$objBakijai_main=new Bakijai_main();
$cond="1=1";
$totrec=$objBakijai_main->rowCount($cond);
$objUtility=new Utility();
$cspan=19;
$title=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan=$cspan  height="$rheight"  align="center">
Title Name
</td>
</tr>
</table>
EOD;
$tblhead=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan=$cspan  align="center">
<br>Test Page
</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">SlNo</td>
<td align="center" width="$cwidth[1]">Case_id</td>
<td align="center" width="$cwidth[2]">Start_date</td>
<td align="center" width="$cwidth[3]">Case_no</td>
<td align="center" width="$cwidth[4]">Fin_yr</td>
<td align="center" width="$cwidth[5]">Bank</td>
<td align="center" width="$cwidth[6]">Branch</td>
<td align="center" width="$cwidth[7]">Full_name</td>
<td align="center" width="$cwidth[8]">Full_name_ass</td>
<td align="center" width="$cwidth[9]">Father</td>
<td align="center" width="$cwidth[10]">Father_ass</td>
<td align="center" width="$cwidth[11]">Polst_code</td>
<td align="center" width="$cwidth[12]">Circle</td>
<td align="center" width="$cwidth[13]">Mouza</td>
<td align="center" width="$cwidth[14]">Vill_code</td>
<td align="center" width="$cwidth[15]">Amount</td>
<td align="center" width="$cwidth[16]">Balance</td>
<td align="center" width="$cwidth[17]">Req_letter_no</td>
<td align="center" width="$cwidth[18]">Req_letter_date</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">1</td>
<td align="center" width="$cwidth[1]"><I>1</I></td>
<td align="center" width="$cwidth[2]"><I>2</I></td>
<td align="center" width="$cwidth[3]"><I>3</I></td>
<td align="center" width="$cwidth[4]"><I>4</I></td>
<td align="center" width="$cwidth[5]"><I>5</I></td>
<td align="center" width="$cwidth[6]"><I>6</I></td>
<td align="center" width="$cwidth[7]"><I>7</I></td>
<td align="center" width="$cwidth[8]"><I>8</I></td>
<td align="center" width="$cwidth[9]"><I>9</I></td>
<td align="center" width="$cwidth[10]"><I>10</I></td>
<td align="center" width="$cwidth[11]"><I>11</I></td>
<td align="center" width="$cwidth[12]"><I>12</I></td>
<td align="center" width="$cwidth[13]"><I>13</I></td>
<td align="center" width="$cwidth[14]"><I>14</I></td>
<td align="center" width="$cwidth[15]"><I>15</I></td>
<td align="center" width="$cwidth[16]"><I>16</I></td>
<td align="center" width="$cwidth[17]"><I>17</I></td>
<td align="center" width="$cwidth[18]"><I>18</I></td>
</tr>
EOD;
$tblbottom=<<<EOD
</table>
EOD;
$ddosign=<<<EOD
<p align="center">
<b>Signature of DDO</b>
</p>
EOD;
$rowcount=0;
$colvalue=array();
//Initialise Total Variable
$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;
$tot5=0;
$tot6=0;
$tot7=0;
$tot8=0;
$tot9=0;
$tot10=0;
$tot11=0;
$tot12=0;
$tot13=0;
$tot14=0;
$tot15=0;
$tot16=0;
$tot17=0;
$tot18=0;
//Seting Page group
$pgroup=array();
$tot=$totrec;
$i=1;
while ($tot>$mrows)
{
$pgroup[$i]=$mrows;
$tot=$tot-$mrows;
$i++;
}
$pgroup[$i]=$tot;
$slno=0;
$pagecount=0;
$lastpage="";
$i=1;
$objBakijai_main->setCondString($cond);
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$slno++;
$rowcount++;
$colvalue[0]=$row[$ii]['Case_id'];
$colvalue[1]=$objUtility->to_date($row[$ii]['Start_date']);
$colvalue[2]=$row[$ii]['Case_no'];
$colvalue[3]=$row[$ii]['Fin_yr'];
$objBank_master=new Bank_master();
$objBank_master->setBank_name($row[$ii]['Bank']);
$objBank_master->EditRecord();
$tvalue=$objBank_master->getBtype();
$colvalue[4]=$tvalue;
$objBankbranch=new Bankbranch();
$objBankbranch->setBank($row[$ii]['Branch']);
$objBankbranch->EditRecord();
$tvalue=$objBankbranch->getBranch();
$colvalue[5]=$tvalue;
$colvalue[6]=$row[$ii]['Full_name'];
$colvalue[7]=$row[$ii]['Full_name_ass'];
$colvalue[8]=$row[$ii]['Father'];
$colvalue[9]=$row[$ii]['Father_ass'];
$objPolice_station=new Police_station();
$objPolice_station->setCode($row[$ii]['Polst_code']);
$objPolice_station->EditRecord();
$tvalue=$objPolice_station->getName();
$colvalue[10]=$tvalue;
$objCircle=new Circle();
$objCircle->setCir_code($row[$ii]['Circle']);
$objCircle->EditRecord();
$tvalue=$objCircle->getCircle();
$colvalue[11]=$tvalue;
$objMouza=new Mouza();
$objMouza->setMouza_code($row[$ii]['Mouza']);
$objMouza->EditRecord();
$tvalue=$objMouza->getMouza_name();
$colvalue[12]=$tvalue;
$objVillage=new Village();
$objVillage->setVill_code($row[$ii]['Vill_code']);
$objVillage->EditRecord();
$tvalue=$objVillage->getVill_name();
$colvalue[13]=$tvalue;
$colvalue[14]=$row[$ii]['Amount'];
$colvalue[15]=$row[$ii]['Balance'];
$colvalue[16]=$row[$ii]['Req_letter_no'];
$colvalue[17]=$objUtility->to_date($row[$ii]['Req_letter_date']);
$tbldata=<<<EOD
<tr>
<td align="center" width="$cwidth[0]">$slno</td>
<td align="center" height="$rheight" width="$cwidth[1]">$colvalue[0]</td>
<td align="center" height="$rheight" width="$cwidth[2]">$colvalue[1]</td>
<td align="center" height="$rheight" width="$cwidth[3]">$colvalue[2]</td>
<td align="center" height="$rheight" width="$cwidth[4]">$colvalue[3]</td>
<td align="center" height="$rheight" width="$cwidth[5]">$colvalue[4]</td>
<td align="center" height="$rheight" width="$cwidth[6]">$colvalue[5]</td>
<td align="center" height="$rheight" width="$cwidth[7]">$colvalue[6]</td>
<td align="center" height="$rheight" width="$cwidth[8]">$colvalue[7]</td>
<td align="center" height="$rheight" width="$cwidth[9]">$colvalue[8]</td>
<td align="center" height="$rheight" width="$cwidth[10]">$colvalue[9]</td>
<td align="center" height="$rheight" width="$cwidth[11]">$colvalue[10]</td>
<td align="center" height="$rheight" width="$cwidth[12]">$colvalue[11]</td>
<td align="center" height="$rheight" width="$cwidth[13]">$colvalue[12]</td>
<td align="center" height="$rheight" width="$cwidth[14]">$colvalue[13]</td>
<td align="center" height="$rheight" width="$cwidth[15]">$colvalue[14]</td>
<td align="center" height="$rheight" width="$cwidth[16]">$colvalue[15]</td>
<td align="center" height="$rheight" width="$cwidth[17]">$colvalue[16]</td>
<td align="center" height="$rheight" width="$cwidth[18]">$colvalue[17]</td>
</tr>
EOD;
$tblfdata=$tblfdata.$tbldata;
if ($rowcount>=$pgroup[$i])
{
$i++;
$pagecount++;
$mpage=<<<EOD
<p align="right">Page-$pagecount</p>
EOD;
$mpage=$mpage;
if ($slno==$totrec)
{
$lastpage=$mpage;  //store last page number in a variable so that it can be used after last rows
$mpage="&nbsp;";
}
$tblfdata=$tblhead.$tblfdata.$tblbottom.$mpage ;
if ($slno<$totrec)
$tblfdata=$tblfdata.$ddosign;
if($mpdf==true)
{
$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
if ($i==2)//For First Page
$pdf->writeHTML($title, true, false, false, false, '');
$pdf->writeHTML($tblfdata, true, false, false, false, '');
}
else
echo $tblfdata;
$tblfdata="";
$rowcount=0;
} //if rowcount
if (is_numeric($row[$ii]['Case_id']))
$tot1=$tot1+$row[$ii]['Case_id'];
if (is_numeric($row[$ii]['Start_date']))
$tot2=$tot2+$row[$ii]['Start_date'];
if (is_numeric($row[$ii]['Case_no']))
$tot3=$tot3+$row[$ii]['Case_no'];
if (is_numeric($row[$ii]['Fin_yr']))
$tot4=$tot4+$row[$ii]['Fin_yr'];
if (is_numeric($row[$ii]['Bank']))
$tot5=$tot5+$row[$ii]['Bank'];
if (is_numeric($row[$ii]['Branch']))
$tot6=$tot6+$row[$ii]['Branch'];
if (is_numeric($row[$ii]['Full_name']))
$tot7=$tot7+$row[$ii]['Full_name'];
if (is_numeric($row[$ii]['Full_name_ass']))
$tot8=$tot8+$row[$ii]['Full_name_ass'];
if (is_numeric($row[$ii]['Father']))
$tot9=$tot9+$row[$ii]['Father'];
if (is_numeric($row[$ii]['Father_ass']))
$tot10=$tot10+$row[$ii]['Father_ass'];
if (is_numeric($row[$ii]['Polst_code']))
$tot11=$tot11+$row[$ii]['Polst_code'];
if (is_numeric($row[$ii]['Circle']))
$tot12=$tot12+$row[$ii]['Circle'];
if (is_numeric($row[$ii]['Mouza']))
$tot13=$tot13+$row[$ii]['Mouza'];
if (is_numeric($row[$ii]['Vill_code']))
$tot14=$tot14+$row[$ii]['Vill_code'];
if (is_numeric($row[$ii]['Amount']))
$tot15=$tot15+$row[$ii]['Amount'];
if (is_numeric($row[$ii]['Balance']))
$tot16=$tot16+$row[$ii]['Balance'];
if (is_numeric($row[$ii]['Req_letter_no']))
$tot17=$tot17+$row[$ii]['Req_letter_no'];
if (is_numeric($row[$ii]['Req_letter_date']))
$tot18=$tot18+$row[$ii]['Req_letter_date'];
} //for loop
$cspan=1;
$tblfoot=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan=$cspan  align="right" width="$cwidth[0]">Total</td>
<td align="center" width="$cwidth[1]">$tot1</td>
<td align="center" width="$cwidth[2]">$tot2</td>
<td align="center" width="$cwidth[3]">$tot3</td>
<td align="center" width="$cwidth[4]">$tot4</td>
<td align="center" width="$cwidth[5]">$tot5</td>
<td align="center" width="$cwidth[6]">$tot6</td>
<td align="center" width="$cwidth[7]">$tot7</td>
<td align="center" width="$cwidth[8]">$tot8</td>
<td align="center" width="$cwidth[9]">$tot9</td>
<td align="center" width="$cwidth[10]">$tot10</td>
<td align="center" width="$cwidth[11]">$tot11</td>
<td align="center" width="$cwidth[12]">$tot12</td>
<td align="center" width="$cwidth[13]">$tot13</td>
<td align="center" width="$cwidth[14]">$tot14</td>
<td align="center" width="$cwidth[15]">$tot15</td>
<td align="center" width="$cwidth[16]">$tot16</td>
<td align="center" width="$cwidth[17]">$tot17</td>
<td align="center" width="$cwidth[18]">$tot18</td>
</tr>
</table>
EOD;
$tblfoot=$tblfoot.$lastpage;
if($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $tblfoot;

?>
