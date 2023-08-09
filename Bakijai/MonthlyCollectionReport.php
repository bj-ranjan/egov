<body>
    <script language=javascript>
<!--

function home()
{
window.location="SelectMonth1.php?tag=1";
}
</script>
<?php
session_start();
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once '../class/utility.class.php';
require_once '../class/utility.php';
require_once './class/class.bank_master.php';
//Rows per Page

if (isset($_GET['yr']))
$yr=$_GET['yr'];
else
$yr=date('Y');

if (isset($_GET['mn']))
$mn=$_GET['mn'];
else
$mn=round(date('m'));


$mvalue=array();
$mvalue[0]=$yr;
$mvalue[1]=$mn;
$mvalue[2]="-";

$_SESSION['mvalue']=$mvalue;


if (isset($_GET['mrows']))
$mrows=$_GET['mrows'];
else
$mrows=20;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=36;

//$mpdf=true;
$mpdf=false;
$objUtility=new Utility();
$objUtil=new myutility();


$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$myear=$objUtil->Month($mn)."/".$yr;


$objBank_master=new Bank_master();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

//$PageOrientation="L";  //Landscap
$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$cwidth[0]="20%";
$cwidth[1]="40%";
$cwidth[2]="40%";



$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->setPrintFooter(false);
$tblfdata="";
$objBank_master=new Bank_master();
$cond="1=1 order by bank_name";
//$cond=" bank_name='AFC' or Bank_name='ASDC'";
$row=$objBank_master->getSelectedRecord($yr, $mn); //get only bank name which is affected in this month
$totrec=count($row);
//echo $totrec;
$objUtility=new Utility();
$cspan=12;

$tblhead=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  width="80%" style="vertical-align:middle;" align="center">
<tr>
<td align="center" ><input type="button" name="back" value="Back" onclick="home()"></td>
<td colspan="2"  height="$rheight"  align="center" width="80%">
Bakijai Collection Report for $myear
</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">SlNo</td>
<td align="center" width="$cwidth[1]">Bank Name</td>
<td align="center" width="$cwidth[2]">Amount Collected during the Month</td>
</tr>
<tr>
<td align="center"><I>1</I></td>
<td align="center"><I>2</I></td>
<td align="center"><I>3</I></td>
</tr>
EOD;
$tblbottom=<<<EOD
</table>
EOD;
$ddosign=<<<EOD
<b>Addl. Deputy Commissioner<br>Nalbari</b>
EOD;
$ddosign1=<<<EOD
<b>Deputy Commissioner<br>Nalbari</b>
EOD;

$msign=<<<EOD
<table border="0" width="60%" align="center">
<tr><td width="100%" align="left">&nbsp;<br><br></td></tr>    
<tr><td width="60%" align="left">
$ddosign</td>
<td width="20%" align="center">
$ddosign1</td> 
<td width="20%" align="left">
&nbsp;</td> </tr>    
</table>
EOD;


$mpage=<<<EOD
<p align="right">Page-</p>
EOD;

$rowcount=0;
$colvalue=array();
//Initialise Total Variable
$grosstot=array();
for($kk=1;$kk<=10;$kk++)
$grosstot[$kk]=0;


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
//$objBank_master->setCondString($cond);
//$row=$objBank_master->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
//for($ii=0;$ii<5;$ii++)
{
$slno++;
$rowcount++;
$colvalue[0]=$row[$ii];
//Opening Case at Begining
$objBank_master->setBank_name($row[$ii]);
$colvalue[1]=$objBank_master->AmountCollected($yr, $mn);
$c1=$objUtil->convert2standard($colvalue[1]);
$tbldata=<<<EOD
<tr>
<td align="center">$slno</td>
<td align="left" height="$rheight">$colvalue[0]</td>
<td align="right" height="$rheight">$c1</td>
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
$tblfdata=$tblhead.$tblfdata.$tblbottom;
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
//sum total variable
$grosstot[1]=$grosstot[1]+$colvalue[1];
} //for loop

$tblfoot=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  width="80%" style="vertical-align:middle;" align="center">
<tr>
<td colspan="2"  align="right" width="60%">Total</td>
EOD;


$grosstot[1]=$objUtil->convert2standard($grosstot[1]);

$Td=<<<EOD
<td align="right" width="40%">$grosstot[1]</td>
EOD;
$tblfoot=$tblfoot.$Td;

$tblfoot=$tblfoot."</tr></table>";


    
if ($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $tblfoot;

?>