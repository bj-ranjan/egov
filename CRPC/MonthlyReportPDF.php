<?PHP
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');

$PageFormat="A4";  //8.5x11
$PageOrientation="L";  //Landscap

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

if(isset($_POST['mm']))
$m=$_POST['mm'];
else
$m=round(date('m'));

$rheight=28;


$mm=substr((100+$m),-2);

if(isset($_POST['Yr']))
$yr=$_POST['Yr'];
else
$yr=date('Y');

$monthy= strtoupper($month[$m-1])."/".$yr;

$title=<<<EOD
<div align="center">
<b>
REPORT ON CRPC CASES FOR THE MONTH OF  $monthy
</b>
</div>
<br>
EOD;

$header=<<<EOD
<table border="1" width="100%" align="center">
<tr>
<td align="center" width="5%" rowspan="2">Slno</td>
<td align="center" width="25%" rowspan="2">Name of Magistrate</td>
<td align="center" width="10%" rowspan="2">Total Pending Cases</td>
<td align="center" width="10%" colspan="2">Pending for less than 3 months</td>
<td align="center" width="10%" colspan=2>Pending for more than 3 months but less than 6 months</td>
<td align="center" width="10%" colspan=2>Pending for more than 6 months but less than 1 year</td>
<td align="center" width="10%" colspan=2>Pending for more than 1 year but less than 2 years</td>
<td align="center" width="10%" colspan=2>Pending for more than 2 years</td>
<td align="center" width="10%" colspan=2>Disposed during the year</td>
</tr>
<tr>
<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>

<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>

<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>

<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>

<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>

<td align="center" width="5%">Section 145</td>
<td align="center" width="5%">Other Section</td>
</tr>
EOD;

$ddo=<<<EOD
<p align="center">&nbsp;<br></p>
<table border="0" width="100%" align="center">
<tr><td width="70%">&nbsp;</td>
<td align="center" width="30%">Deputy Commissioner<br>Nalbari</td>
</tr>
</table>
EOD;



$objUtility=new Utility();
$objCrpc_main=new Crpc_main();



//echo $mm." ".$m;

$fastdate=$yr."-01-01";
$lastdate=$yr."-".$mm."-".$objUtility->mDays[$m];

$Tot=Array();
for($a=0;$a<13;$a++)
$Tot[$a]=0;


$sql="select Magistrate_code,count(*) from crpc_main where (status='Running' and Case_date<='".$lastdate."') or (status<>'Running' and Dispose_date>'".$lastdate."') group by Magistrate_code  having count(*)>0 order by rsl";
$row=$objCrpc_main->FetchRecords($sql);
$i=0;

$tblrow="";
$crow="";

for($ii=0;$ii<count($row);$ii++)
{
$exist=$objCrpc_main->FetchColumn("Officer","exist","slno=".$row[$ii][0],0);
if($exist)
{
$i++;
$Tot[0]+=$row[$ii][1];
$name=$objCrpc_main->FetchColumn("Officer","Officer_name","slno=".$row[$ii][0],"");
$opcase=$row[$ii][1];

$t1=Calculate($row[$ii][0],"145",0,90,$lastdate);
$Tot[1]+=$t1;
$t2=Calculate($row[$ii][0],"105",0,90,$lastdate);
$Tot[2]+=$t2;
$t3=Calculate($row[$ii][0],"145",90,180,$lastdate);
$Tot[3]+=$t3;
$t4=Calculate($row[$ii][0],"105",90,180,$lastdate);
$Tot[4]+=$t4;
$t5=Calculate($row[$ii][0],"145",180,365,$lastdate);
$Tot[5]+=$t5;
$t6=Calculate($row[$ii][0],"105",180,365,$lastdate);
$Tot[6]+=$t6;
$t7=Calculate($row[$ii][0],"145",365,730,$lastdate);
$Tot[7]+=$t7;
$t8=Calculate($row[$ii][0],"105",365,730,$lastdate);
$Tot[8]+=$t8;
$t9=Calculate($row[$ii][0],"145",730,36500,$lastdate);
$Tot[9]+=$t9;
$t10=Calculate($row[$ii][0],"105",730,36500,$lastdate);
$Tot[10]+=$t10;

$condition="magistrate_code=".$row[$ii][0]." and section='145' and status<>'Running' and dispose_date between '".$fastdate."' and '".$lastdate."'";
$t11=$objCrpc_main->CountRecords("crpc_main",$condition);
$Tot[11]+=$t11;
$condition="magistrate_code=".$row[$ii][0]." and section<>'145' and status<>'Running' and dispose_date between '".$fastdate."' and '".$lastdate."'";
$t12=$objCrpc_main->CountRecords("crpc_main",$condition);
$Tot[12]+=$t12;



$crow=<<<EOD
<tr>
<td align="center" height="$rheight">$i</td>
<td align="left" height="$rheight">&nbsp;$name</td>
<td align="center" height="$rheight">$opcase</td>
<td align="center" height="$rheight">$t1</td>
<td align="center" height="$rheight">$t2</td>
<td align="center" height="$rheight">$t3</td>
<td align="center" height="$rheight">$t4</td>
<td align="center" height="$rheight">$t5</td>
<td align="center" height="$rheight">$t6</td>
<td align="center" height="$rheight">$t7</td>
<td align="center" height="$rheight">$t8</td>
<td align="center" height="$rheight">$t9</td>
<td align="center">$t10</td>
<td align="center">$t11</td>
<td align="center">$t12</td>
</tr>
EOD;

$header.=$crow;
} //if
} //for

$footer=<<<EOD
<tr><td align="right" colspan="2" height="$rheight" ><b>Total</b></td>
EOD;


for($a=0;$a<13;$a++)
{
$tmp=<<<EOD
<td align=center><b>$Tot[$a]</b></td>
EOD;
$footer.=$tmp;
} 
$footer.="</tr></table>";

$header.=$footer;

$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('helvetica', '', 11);
$pdf->setPrintFooter(false);

$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
$pdf->writeHTML($title.$header.$ddo, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');




//function block
function Calculate($mcode,$section,$days1,$days2,$lastdate)
{
require_once './class/class.crpc_main.php';
require_once '../class/utility.class.php';
$objC=new Crpc_main();
$objU=new Utility();

if($section==145)
$cond=" and section='145'";
else
$cond=" and section<>'145'";

$count=0;
$sql="select case_date from crpc_main where ((status='Running' and Case_date<='".$lastdate."') or (status<>'Running' and Dispose_date>'".$lastdate."')) and Magistrate_code=".$mcode.$cond;

//echo "Magistrate-".$mcode."<br>";

$mrow=$objC->FetchRecords($sql);
for($i=0;$i<count($mrow);$i++)
{
$dt=$mrow[$i][0];
$diff=$objU->dateDiff($lastdate,$dt);
if($diff>=$days1 && $diff<$days2)
$count++;
//echo $lastdate."-".$dt."=".$diff."(Tot=".$count.")<br>";
}
return($count);
}


?>

