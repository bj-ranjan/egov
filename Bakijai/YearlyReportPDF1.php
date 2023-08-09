<body>
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
$yr="-";

$month=array();
$month[1]=4;
$month[2]=5;
$month[3]=6;
$month[4]=7;
$month[5]=8;
$month[6]=9;
$month[7]=10;
$month[8]=11;
$month[9]=12;
$month[10]=1;
$month[11]=2;
$month[12]=3;

$mydate="Generated on ".date('d/m/Y');

$year=array();
$year[1]=substr($yr,0,4);
$year[2]=substr($yr,0,4);
$year[3]=substr($yr,0,4);
$year[4]=substr($yr,0,4);
$year[5]=substr($yr,0,4);
$year[6]=substr($yr,0,4);
$year[7]=substr($yr,0,4);
$year[8]=substr($yr,0,4);
$year[9]=substr($yr,0,4);
$year[10]=substr($yr,-4);
$year[11]=substr($yr,-4);
$year[12]=substr($yr,-4);




if (isset($_GET['mrows']))
$mrows=$_GET['mrows'];
else
$mrows=12;

// Rows Height
if (isset($_GET['rheight']))
$rheight=$_GET['rheight'];
else
$rheight=24;

if (isset($_POST['mpdf']))
$mpdf=true;
else
$mpdf=false;

$objUtility=new Utility();
$objUtil=new myutility();
$ip=$objUtility->ServerIP;

//$myear=$objUtil->Month($mn)."/".$yr;


$objBank_master=new Bank_master();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

$PageOrientation="L";  //Landscap
//$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$cwidth[0]="5%";
$cwidth[1]="15%";
$cwidth[2]="7%";
$cwidth[3]="11%";
$cwidth[4]="5%";
$cwidth[5]="10%";
$cwidth[6]="5%";
$cwidth[7]="9%";
$cwidth[8]="8%";
$cwidth[9]="9%";
$cwidth[10]="5%";
$cwidth[11]="11%";


$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 10);
$pdf->setPrintFooter(false);
$tblfdata="";

//$cond=" bank_name='AFC' or Bank_name='ASDC'";
//$row=$objBank_master->getSelectedRecord($yr, $mn); //get only bank name which is affected in this month
$totrec=12;
//echo $totrec;
$objUtility=new Utility();
$cspan=12;

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');


$tblhead=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  width="100%" style="vertical-align:middle;">
<tr>
<td colspan="$cspan"  height="$rheight"  align="center">
Bakijai Collection Report for Financial Year $yr
</td>
</tr>
<tr>
<td align="center" width="$cwidth[0]">SlNo</td>
<td align="center" width="$cwidth[1]">Month/Year</td>
<td align="center" width="$cwidth[2]">Case at the Beginning of the Month</td>
<td align="center" width="$cwidth[3]">Demand Involved</td>
<td align="center" width="$cwidth[4]">Case disposed dutring the Month</td>
<td align="center" width="$cwidth[5]">Amount realised during the Month</td>
<td align="center" width="$cwidth[6]">Case instituted during the Month</td>
<td align="center" width="$cwidth[7]">Amount Involved</td>
<td align="center" width="$cwidth[8]">Case dropped during the Month(By OTS etc)</td>
<td align="center" width="$cwidth[9]">Amount involved</td>
<td align="center" width="$cwidth[10]">Case Pending at end of Month</td>
<td align="center" width="$cwidth[11]">Amount involved<br>(4-5+10)</td>
</tr>
<tr>
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
</tr>
EOD;
$tblbottom=<<<EOD
</table>
EOD;

if (isset($_POST['sign']))
{    
$ddosign=<<<EOD
<b>Addl. Deputy Commissioner<br>Nalbari</b>
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
<td width="20%" align="center">
$ddosign1</td> 
<td width="20%" align="left">
&nbsp;</td> </tr>    
<tr><td width="100%">&nbsp;</td></tr>
<tr><td width="100%">&nbsp;</td></tr>
<tr><td width="100%">&nbsp;</td></tr>
<tr><td width="100%" align="left">http://$ip/egov/bakijai/MonthlyReport.pdf &nbsp;&nbsp;&nbsp; $mydate</td></tr>

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
for($ii=1;$ii<13;$ii++)
//for($ii=0;$ii<5;$ii++)
{
$yr=$year[$ii];
$mn=$month[$ii];
$slno++;
$rowcount++;
$colvalue[0]=$objUtil->Month($month[$ii])."/".$year[$ii];
//Opening Case at Begining
$objBank_master->setBank_name("");
$colvalue[1]=$objBank_master->OpeningCase($yr, $mn);
$colvalue[2]=$objBank_master->Balance($yr, $mn);
$c2=$objUtil->convert2standard($colvalue[2]);
$colvalue[3]=$objBank_master->Disposed($yr, $mn);
$colvalue[4]=$objBank_master->AmountCollected($yr, $mn);
$c4=$objUtil->convert2standard($colvalue[4]);
//new case in current Month
$colvalue[5]=$objBank_master->NewCase($yr, $mn);
$colvalue[6]=$objBank_master->AmountForNewCase($yr, $mn);
$c6=$objUtil->convert2standard($colvalue[6]);
$colvalue[7]=$objBank_master->DropedByOTS($yr, $mn); //droped
$colvalue[8]=$objBank_master->OtsBalance($yr, $mn); //amount involved
$c8=$objUtil->convert2standard($colvalue[8]);
$colvalue[9]=$colvalue[1]+$colvalue[5]-($colvalue[3]+$colvalue[7]);
$colvalue[10]=$colvalue[2]-$colvalue[4]+($colvalue[6]-$colvalue[8]);
$c10=$objUtil->convert2standard($colvalue[10]);
$tbldata=<<<EOD
<tr>
<td align="center">$slno</td>
<td align="left" height="$rheight">$colvalue[0]</td>
<td align="center" height="$rheight">$colvalue[1]</td>
<td align="right" height="$rheight">$c2</td>
<td align="center" height="$rheight">$colvalue[3]</td>
<td align="right" height="$rheight">$c4</td>
<td align="center" height="$rheight">$colvalue[5]</td>
<td align="right" height="$rheight">$c6</td>
<td align="center" height="$rheight">$colvalue[7]</td>
<td align="right" height="$rheight">$c8</td>
<td align="center" height="$rheight">$colvalue[9]</td>
<td align="right" height="$rheight">$c10</td>
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
for($kk=1;$kk<=10;$kk++)
$grosstot[$kk]=$grosstot[$kk]+$colvalue[$kk];
} //for loop

$tblfoot=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;">
<tr>
<td colspan="2"  align="right" width="20%">Total</td>
EOD;


for($kk=1;$kk<=10;$kk++)
{
$k=$kk+1;

if ($kk>2 && $kk<9)
$mmm=0;
else 
$grosstot[$kk]="-"; 
    
if($kk==4 || $kk==8 || $kk==6)
{    
$grosstot[$kk]=$objUtil->convert2standard($grosstot[$kk]);
$al="right";
}
else
$al="center";
$Td=<<<EOD
<td align="$al" width="$cwidth[$k]">$grosstot[$kk]</td>
EOD;
$tblfoot=$tblfoot.$Td;
}

$tblfoot=$tblfoot."</tr></table>".$msign;


    
if ($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $tblfoot;

?>