<body>
<?php
session_start();
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
require_once './class/utility.class.php';
require_once './class/class.hc_casemaster.php';
require_once './class/class.hc_department.php';
require_once './class/class.hc_branch.php';
//Rows per Page
if (isset($_GET['mrows']))
$mrows=$_GET['mrows'];
else
$mrows=15;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=20;

if (isset($_GET['mpdf']))
$mpdf=true;
else
$mpdf=false;
//$mpdf=true;
//$mpdf=false;
$objUtility=new Utility();
$objHc_casemaster=new Hc_casemaster();
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
$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->setPrintFooter(false);
$tblfdata="";
$objHc_casemaster=new Hc_casemaster();
$cond="1=1";
$totrec=$objHc_casemaster->rowCount($cond);
$objUtility=new Utility();
$cspan=9;
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
<td align="center" width="$cwidth[1]">Serial</td>
<td align="center" width="$cwidth[2]">Case_no</td>
<td align="center" width="$cwidth[3]">Brief_history</td>
<td align="center" width="$cwidth[4]">Present_status</td>
<td align="center" width="$cwidth[5]">File_no</td>
<td align="center" width="$cwidth[6]">Due_dateparawise</td>
<td align="center" width="$cwidth[7]">Dep_code</td>
<td align="center" width="$cwidth[8]">Branch_code</td>
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
//Seting Page group
//$pgroup=array();
$tot=$totrec;
$slno=0;
$pagecount=0;
$lastpage="";
$i=1;
$objHc_casemaster->setCondString($cond);
$row=$objHc_casemaster->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$slno++;
$rowcount++;
$colvalue[0]=$row[$ii]['Serial'];
$colvalue[1]=$row[$ii]['Case_no'];
$colvalue[2]=$row[$ii]['Brief_history'];
$colvalue[3]=$row[$ii]['Present_status'];
$colvalue[4]=$row[$ii]['File_no'];
$colvalue[5]=$objUtility->to_date($row[$ii]['Due_dateparawise']);
$objHc_department=new Hc_department();
$objHc_department->setCode($row[$ii]['Dep_code']);
$objHc_department->EditRecord();
$tvalue=$objHc_department->getName();
$colvalue[6]=$tvalue;
$objHc_branch=new Hc_branch();
$objHc_branch->setCode($row[$ii]['Branch_code']);
$objHc_branch->EditRecord();
$tvalue=$objHc_branch->getName();
$colvalue[7]=$tvalue;
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
</tr>
EOD;
$tblfdata=$tblfdata.$tbldata;
if ($rowcount==$mrows || $slno==$totrec)
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
if (is_numeric($row[$ii]['Serial']))
$tot1=$tot1+$row[$ii]['Serial'];
if (is_numeric($row[$ii]['Case_no']))
$tot2=$tot2+$row[$ii]['Case_no'];
if (is_numeric($row[$ii]['Brief_history']))
$tot3=$tot3+$row[$ii]['Brief_history'];
if (is_numeric($row[$ii]['Present_status']))
$tot4=$tot4+$row[$ii]['Present_status'];
if (is_numeric($row[$ii]['File_no']))
$tot5=$tot5+$row[$ii]['File_no'];
if (is_numeric($row[$ii]['Due_dateparawise']))
$tot6=$tot6+$row[$ii]['Due_dateparawise'];
if (is_numeric($row[$ii]['Dep_code']))
$tot7=$tot7+$row[$ii]['Dep_code'];
if (is_numeric($row[$ii]['Branch_code']))
$tot8=$tot8+$row[$ii]['Branch_code'];
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
