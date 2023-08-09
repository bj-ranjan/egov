<body>
<?php
session_start();
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once '../class/utility.class.php';
require_once '../class/utility.php';
require_once './class/class.bank_master.php';
require_once './class/class.finalreport.php';
//Rows per Page

$objFinal=new Finalreport();

if (isset($_GET['yr']))
$yr=$_GET['yr'];
else
$yr=date('Y');

if (isset($_GET['mn']))
$mn=$_GET['mn'];
else
$mn=round(date('m'));

//if($yr<2013)
//header('Location:SelectMonth.php');
//else
//{
//if($yr=="2013" && $mn<4)   
//header('Location:SelectMonth.php');    
//}


if (isset($_POST['mrows']))
$mrows=$_POST['mrows'];
else
$mrows=18;

if(!is_numeric($mrows))
$mrows=18;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=20;

//$mpdf=true;
//$mpdf=false;

if (isset($_POST['mpdf']))
$mpdf=true;
else
$mpdf=false;


$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();

$myear=$objUtil->Month($mn)."/".$yr;

$myear1=$mn."/".$yr;


$objBank_master=new Bank_master();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

$PageOrientation="L";  //Landscap
//$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$mwidth=array();
$cwidth[0]="5%";
$cwidth[1]="12%";
$cwidth[2]="6%";
$cwidth[3]="13%";
$cwidth[4]="5%";
$cwidth[5]="7%";
$cwidth[6]="7%";
$cwidth[7]="8%";
$cwidth[8]="8%";
$cwidth[9]="7%";
$cwidth[10]="13%";
$cwidth[11]="6%";
$cwidth[12]="3%";


$mwidth[1]="5%";
$mwidth[2]="8%";
$mwidth[3]="5%";
$mwidth[4]="7%";
$mwidth[5]="7%";
$mwidth[6]="8%";
$mwidth[7]="8%";
$mwidth[8]="7%";
$mwidth[9]="5%";
$mwidth[10]="8%";


$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 9);
$pdf->setPrintFooter(false);
$tblfdata="";
$objBank_master=new Bank_master();
$cond="1=1 order by bank_name";
//$cond=" bank_name='AFC' or Bank_name='ASDC'";
$row=$objBank_master->getSelectedRecord($yr, $mn); //get only bank name which is affected in this month
$totrec=count($row);
//echo $totrec;
$objUtility=new Utility();
$ip=$objUtility->ServerIP;
$cspan=15;
$mydate="Generated on ".date('d/m/Y H:i:s A')." from Client ".$_SERVER['REMOTE_ADDR'];

$tblhead=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  width="100%" style="vertical-align:middle;">
<tr>
<td colspan="$cspan"  height="$rheight"  align="center">
Consolidated Statement of Bakijai Collection<br>
(Periof $myear to $myear)

</td>
</tr>
<tr>
<td align="center" rowspan="2" width="$cwidth[0]" >SlNo</td>
<td align="center" rowspan="2" width="$cwidth[1]">Name of Establishment</td>
<td align="center" rowspan="2" width="$cwidth[2]">Month & Year</td>
<td align="center" colspan="2" width="$cwidth[3]">Opening Balance</td>
<td align="center" rowspan="2" width="$cwidth[4]">New Case</td>
<td align="center" rowspan="2" width="$cwidth[5]">Amount of New Case</td>
<td align="center" rowspan="2" width="$cwidth[6]">Total No of Case<br>(3+5)</td>
<td align="center" rowspan="2" width="$cwidth[7]">Total Amount<br>(4+6)</td>
<td align="center" rowspan="2" width="$cwidth[8]">No of disposed case during the Month</td>
<td align="center" rowspan="2" width="$cwidth[9]">Total collection during the Month</td>
<td align="center" colspan="2" width="$cwidth[10]">Closing Balance</td>
<td align="center" rowspan="2" width="$cwidth[11]">(%)Rate of collection during the month</td>
<td align="center" rowspan="2" width="$cwidth[12]">Remarks</td>
</tr>
<tr>
<td align="center" width="5%">No of Case Instituted</td>
<td align="center" width="8%">Amount Involved</td>
<td align="center" width="5%">No of disposed case(7-9</td>
<td align="center" width="8%">Total outstanding Amount to be realized(8-10)</td>
</tr>

<tr>
<td align="center"><I>&nbsp;</I></td>
<td align="center"><I>1</I></td>
<td align="center"><I>2</I></td>
<td align="center"><I>3</I></td>
<td align="center"><I>4</I></td>
<td align="center"><I>5</I></td>
<td align="center"><I>6</I></td>
<td align="center"><I>7</I></td>
<td align="center"><I>8</I></td>
<td align="center"><I>9</I></td>
<td align="center"><I>10</I></td>
<td align="center"><I>11</I></td>
<td align="center"><I>12</I></td>
<td align="center"><I>13</I></td>
<td align="center"><I>14</I></td>
</tr>
EOD;
$tblbottom=<<<EOD
</table>
EOD;
if (isset($_POST['sign']))
{    
$ddosign=<<<EOD
<b>Certificate Officer<br>Nalbari</b>
EOD;
}
else
$ddosign="&nbsp;";
if (isset($_POST['sign1']))
{ 
$ddosign1=<<<EOD
<b>Deputy Commissioner<br>Nalbari</b>
EOD;
}
else
$ddosign1="&nbsp;";  

$msign=<<<EOD
<table border="0" width="100%" align="center">
<tr><td width="100%" align="left">&nbsp;<br><br></td></tr>    
<tr><td width="60%" align="left">
$ddosign</td>
<td width="35%" align="center">
$ddosign1</td> 
<td width="5%" align="left">
&nbsp;</td></tr> 
<tr><td width="100%">&nbsp;</td></tr>
<tr><td width="100%" align="left">http://$ip/egov/bakijai/MonthlyReport.pdf &nbsp;&nbsp;&nbsp; $mydate</td></tr>
</table>
EOD;


$mpage=<<<EOD
<p align="right">Page-</p>
EOD;

$rowcount=0;
$colvalue=array();
$mcolvalue=array();
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
$colvalue[1]=$objBank_master->OpeningCase($yr, $mn);
$mcolvalue[1]=$colvalue[1];
$colvalue[2]=$objBank_master->Balance($yr, $mn);
$mcolvalue[2]=$colvalue[2];
$c2=$objUtil->convert2Simplestandard($colvalue[2]);
$colvalue[3]=$objBank_master->Disposed($yr, $mn);
$colvalue[8]=$objBank_master->OtsBalance($yr, $mn); //amount involved
$c8=$objUtil->convert2Simplestandard($colvalue[8]);

$colvalue[4]=$objBank_master->AmountCollected($yr, $mn)+$colvalue[8];
$collected=$objUtil->convert2Simplestandard($colvalue[4]);
$mcolvalue[8]=$colvalue[4];
//new case in current Month
$colvalue[5]=$objBank_master->NewCase($yr, $mn);
$mcolvalue[3]=$colvalue[5];
$colvalue[6]=$objBank_master->AmountForNewCase($yr, $mn);
$mcolvalue[4]=$colvalue[6];
$mcolvalue[5]=$mcolvalue[1]+$mcolvalue[3];
$mcolvalue[6]=$mcolvalue[2]+$mcolvalue[4];


$c6=$objUtil->convert2Simplestandard($colvalue[6]);
$colvalue[7]=$objBank_master->DropedByOTS($yr, $mn); //droped

$colvalue[9]=$colvalue[1]+$colvalue[5]-($colvalue[3]+$colvalue[7]);
$colvalue[10]=$colvalue[2]-$colvalue[4]+($colvalue[6]-$colvalue[8]);
$c10=$objUtil->convert2Simplestandard($colvalue[10]);


$totalcase=$colvalue[1]+$colvalue[5];
$tamt=$objUtil->convert2Simplestandard($colvalue[2]+$colvalue[6]);
$disposed=$colvalue[3]+$colvalue[7];
$mcolvalue[7]=$disposed;
$undisposed=$totalcase-$disposed;
$mcolvalue[9]=$undisposed;
$mcolvalue[10]=$colvalue[2]+$colvalue[6]-$colvalue[4];
$outstanding=$objUtil->convert2Simplestandard($mcolvalue[10]);

$perc=($colvalue[4]/($colvalue[2]+$colvalue[6]))*100;

$perc=number_format($perc,3)."%";

$tbldata=<<<EOD
<tr>
<td align="center">$slno</td>
<td align="left" height="$rheight">$colvalue[0]</td>
<td align="center" height="$rheight">$myear1</td>    
<td align="center" height="$rheight">$colvalue[1]</td>
<td align="right" height="$rheight">$c2</td>
<td align="center" height="$rheight">$colvalue[5]</td>
<td align="right" height="$rheight">$c6</td>
<td align="center" height="$rheight">$totalcase</td>
<td align="right" height="$rheight">$tamt</td>
<td align="center" height="$rheight">$disposed</td>  
<td align="right" height="$rheight">$collected</td>
<td align="center" height="$rheight">$undisposed</td>  
<td align="right" height="$rheight">$outstanding</td>
<td align="center" height="$rheight">$perc</td>
<td align="right" height="$rheight">&nbsp;</td>
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
{
if (isset($_POST['last']))    
$tblfdata=$tblfdata; 
else
$tblfdata=$tblfdata.$msign; //(If Signature on every page isrequired)
}
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
for($kk=1;$kk<=10;$kk++)
$grosstot[$kk]=$grosstot[$kk]+$mcolvalue[$kk];
} //for loop

$tblfoot=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan="3"  align="right" width="23%">Total</td>
EOD;

for($kk=1;$kk<=10;$kk++)
{
$k=$kk+1;
if($kk%2==0)
{    
$grosstot[$kk]=$objUtil->convert2Simplestandard($grosstot[$kk]);
$al="right";
}
else
$al="center";

$Td=<<<EOD
<td align="$al" width="$mwidth[$kk]">$grosstot[$kk]</td>
EOD;
$tblfoot=$tblfoot.$Td;
}

$tblfoot=$tblfoot."<td colspan=".chr(34)."2".chr(34)." width=".chr(34)."10%".chr(34).">&nbsp;</td></tr></table>".$msign;


    
if ($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $tblfoot;

//lock report
if (isset($_POST['final']))
{
$date2=$yr."-".$mn."-".$objUtility->mDays[$mn];
$date1=date('Y-m-d');
if ($objUtility->dateDiff($date1, $date2)>0)
{
$objFinal->setFdate($date2);
$objFinal->SaveRecord();
}        
}
?>