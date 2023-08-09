<body>
<?php
session_start();
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
require_once './class/utility.class.php';
require_once './class/class.update_history.php';
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
$objUpdate_history=new Update_history();
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
$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->setPrintFooter(false);
$tblfdata="";
$objUpdate_history=new Update_history();
$cond="1=1";
$totrec=$objUpdate_history->rowCount($cond);
$objUtility=new Utility();
$cspan=6;
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
<td align="center" width="$cwidth[2]">Rsl</td>
<td align="center" width="$cwidth[3]">Detail</td>
<td align="center" width="$cwidth[4]">User_code</td>
<td align="center" width="$cwidth[5]">Entry_date</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">1</td>
<td align="center" width="$cwidth[1]"><I>1</I></td>
<td align="center" width="$cwidth[2]"><I>2</I></td>
<td align="center" width="$cwidth[3]"><I>3</I></td>
<td align="center" width="$cwidth[4]"><I>4</I></td>
<td align="center" width="$cwidth[5]"><I>5</I></td>
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
$objUpdate_history->setCondString($cond);
$row=$objUpdate_history->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$slno++;
$rowcount++;
$colvalue[0]=$row[$ii]['Case_id'];
$colvalue[1]=$row[$ii]['Rsl'];
$colvalue[2]=$row[$ii]['Detail'];
$colvalue[3]=$row[$ii]['User_code'];
$colvalue[4]=$objUtility->to_date($row[$ii]['Entry_date']);
$tbldata=<<<EOD
<tr>
<td align="center" width="$cwidth[0]">$slno</td>
<td align="center" height="$rheight" width="$cwidth[1]">$colvalue[0]</td>
<td align="center" height="$rheight" width="$cwidth[2]">$colvalue[1]</td>
<td align="center" height="$rheight" width="$cwidth[3]">$colvalue[2]</td>
<td align="center" height="$rheight" width="$cwidth[4]">$colvalue[3]</td>
<td align="center" height="$rheight" width="$cwidth[5]">$colvalue[4]</td>
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
if (is_numeric($row[$ii]['Rsl']))
$tot2=$tot2+$row[$ii]['Rsl'];
if (is_numeric($row[$ii]['Detail']))
$tot3=$tot3+$row[$ii]['Detail'];
if (is_numeric($row[$ii]['User_code']))
$tot4=$tot4+$row[$ii]['User_code'];
if (is_numeric($row[$ii]['Entry_date']))
$tot5=$tot5+$row[$ii]['Entry_date'];
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
