<body>
<?php
session_start();
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once '../class/utility.class.php';
require_once 'class/class.dak.php';

//Rows per Page
if (isset($_GET['mrows']))
$mrows=$_GET['mrows'];
else
$mrows=10;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=20;

$rheight=50;

if (isset($_GET['mpdf']))
$mpdf=true;
else
$mpdf=false;


$mpdf=true;
//$mpdf=false;

$objUtility=new Utility();
$objDak_entry=new Dak_entry();


if (isset($_GET['key']))
$key=$_GET['key'];
else
$key=date('d/m/Y');

$date=$key;
$key=$objUtility->to_mysqldate($key);


//$PageFormat="PAYBILL";  //Large Page 14.76 X 19.11 INCH
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//$PageFormat="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

$PageOrientation="L";  //Landscap
//$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$cwidth[0]="5%";
$cwidth[1]="9%";
$cwidth[2]="25%";
$cwidth[3]="22%";
$cwidth[4]="16%";
$cwidth[5]="10%";
$cwidth[6]="13%";


$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 10);
$pdf->setPrintFooter(false);
$tblfdata="";
$objDak_entry=new Dak_entry();
$cond="entry_date='".$key."' order by dak_id";
$totrec=$objDak_entry->rowCount($cond);
$objUtility=new Utility();
$cspan=10;
//Sample Parograph
$Para=<<<EOD
<div align="justify" style="line-height:2">
&nbsp;&nbsp;This is a sample justified Para.
</div>
EOD;

$title=<<<EOD
&nbsp;
EOD;
$tblhead=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan=$cspan  align="center">
<br>Daily Report of Dak Received as on <b>$date</b>
</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">SlNo</td>
<td align="center" width="$cwidth[1]">Dak ID</td>
<td align="center" width="$cwidth[2]">Subject</td>
<td align="center" width="$cwidth[3]">Received From</td>
<td align="center" width="$cwidth[4]">Letter No & Date</td>
<td align="center" width="$cwidth[5]">Branch</td>
<td align="center" width="$cwidth[6]">Remarks</td>
</tr>
EOD;

$datastring=$title.$tblhead;

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
//Seting Page group
//$pgroup=array();
$tot=$totrec;
$slno=0;
$pagecount=0;
$lastpage="";
$i=1;
$objDak_entry->setCondString($cond);
$row=$objDak_entry->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
//echo "total:".count($row);
//for($ii=0;$ii<30;$ii++)
{
$slno++;
$rowcount++;
$colvalue[0]=$row[$ii]['Dak_id']."/".$row[$ii]['Recvd_yr'];
$colvalue[1]=$row[$ii]['Subject'];
$colvalue[2]=$row[$ii]['Recvd_from'];
$colvalue[3]=$row[$ii]['Ltr_no']."<br>Date: ".$objUtility->to_date($row[$ii]['Ltr_dt']);
$branch=$row[$ii]['Branch_code'];
$branchname=$objDak_entry->getBranchName($branch);
$colvalue[4]=$branchname;  //$row[$ii]['Mark_branch'];
$colvalue[5]=$row[$ii]['Remarks'];
$tbldata=<<<EOD
<tr>
<td align="center" width="$cwidth[0]">$slno</td>
<td align="center" height="$rheight" width="$cwidth[1]"><b>$colvalue[0]</b></td>
<td align="left" height="$rheight" width="$cwidth[2]">$colvalue[1]</td>
<td align="left" height="$rheight" width="$cwidth[3]">$colvalue[2]</td>
<td align="left" height="$rheight" width="$cwidth[4]">$colvalue[3]</td>
<td align="center" height="$rheight" width="$cwidth[5]">$colvalue[4]</td>
<td align="left" height="$rheight" width="$cwidth[6]">$colvalue[5]</td>
</tr>
EOD;
$tblfdata=$tblfdata.$tbldata;
$datastring=$datastring.$tbldata;
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
$tblfdata=$tblfdata;
if($mpdf==true)
{
$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
if ($i==2)//For First Page
$pdf->writeHTML($title, true, false, false, false, '');
$pdf->writeHTML($tblfdata, true, false, false, false, '');
}
//else
//echo $tblfdata;
$tblfdata="";
$rowcount=0;
} //if rowcount

} //for loop

$cspan=1;
$tblfoot=<<<EOD
-
EOD;

$tblfoot=$tblfoot.$lastpage;
$datastring=$datastring.$tblbottom.$tblfoot;
if($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $datastring;

?>
