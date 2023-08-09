<body>
<?php
session_start();
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once '../class/utility.class.php';
require_once '../class/class.sentence.php';
require_once './class/class.petition_master.php';
require_once '../Bakijai/class/class.Mouza.php';
require_once '../Bakijai/class/class.Circle.php';
require_once '../Bakijai/class/class.Police_station.php';
require_once '../xohari/class/Class.request_status.php';


$objSen=new Sentence();
if (isset($_POST['Pet_yr']))
$Pet_yr=$_POST['Pet_yr'];
else
$Pet_yr=0;


if (isset($_SESSION['username']))
$username=$_SESSION['username'];
else 
$username="";


if (isset($_POST['Pet_no']))
$Pet_no=$_POST['Pet_no'];
else
$Pet_no=0;


$mpdf=true;
//$mpdf=false;
$objUtility=new Utility();
$objPetition_master=new Petition_master();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
//$PageFormat="LEGAL";  //8.5x14
$PageFormat="A4";  //8.5x11

//$PageOrientation="L";  //Landscap
$PageOrientation="P";  //Portrait

//$util=new myutility();
$cwidth=array();
$cwidth[0]="10%";
$cwidth[1]="50%";
$cwidth[2]="15%";
$cwidth[3]="25%";


$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
//$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->setPrintFooter(false);
$tblfdata="";
$objPetition_master=new Petition_master();

$objUtility=new Utility();

$objPetition_master->setPet_yr($Pet_yr);
$objPetition_master->setPet_no($Pet_no);

if ($objPetition_master->EditRecord()) //i.e Data Available
{ 
$xid=$objPetition_master->getXohari_requestid();
$name=$objSen->SentenceCase($objPetition_master->getApplicant());
$fname=$objSen->SentenceCase($objPetition_master->getFather());
$mname=$objSen->SentenceCase($objPetition_master->getMother());
$dist=$objPetition_master->getDistrict();
$relation=$objPetition_master->getRelation();
$village=$objSen->SentenceCase($objPetition_master->getVillage());
$prdate=$objPetition_master->getProcess_date();
$prdate=$objUtility->to_date($prdate);

$caste=$objPetition_master->getCaste();
$subcaste=$objPetition_master->getSubcaste();

if($objPetition_master->getPet_type()!="BK")
header( 'Location: PetitionList.php?tag=0'); 


$objC=new Circle();
$objC->setCir_code($objPetition_master->getCircle_code());
if ($objC->EditRecord() && $objPetition_master->getCircle_code()>0)
$circle=$objSen->SentenceCase($objC->getCircle());
else
$circle=$objPetition_master->getCircle();


$objM=new Mouza();
$objM->setMouza_code($objPetition_master->getMauza_code());
if ($objM->EditRecord() && $objPetition_master->getMauza_code()>0)
$mouza=$objSen->SentenceCase($objM->getMouza_name());
else
$mouza=$objPetition_master->getMauza ();

$objP=new Police_station();
$objP->setCode($objPetition_master->getPS_code());
if ($objP->EditRecord() && $objPetition_master->getPS_code()>0)
$ps=$objP->getName();
else
$ps=$objPetition_master->getPS();
}
else
header( 'Location: PetitionList.php?tag=0'); 


//update Xohari Request-status table
$objR=new Request_status();
$objR->setRequest_id($xid);
$objR->setStatus_id("1"); //1 for Processing
if ($objR->Available()==false && strlen($xid)>2)
{
$objR->setDate(date('Y-m-d'));
$objR->setUpdated_by("admin");
$objR->setId($objR->maxId());
$objR->setRemark("Updated through PFC Counter by ".$username);
if ($objR->SaveRecord())
{
$line=$objR->returnSql;
$objUtility->saveSqlLog("Service_request", $line);
}
}
$ip=$objUtility->ServerIP;
$ip="http://".$ip."/egov/pfc/Bakijai.php?yr=".$Pet_yr."&pno=".$Pet_no."  Process Date:".$prdate;


$blank=<<<EOD
<p align="center">&nbsp;
</p>    
EOD;

$ddosign=<<<EOD
<p align="center">
<b>Certificate Officer<br>Nalbari</b>
</p>
EOD;


$title=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  align="center" style="vertical-align:middle;" width="85%">
<tr>
<td width="10%">&nbsp;</td>
<td colspan="3" align="center" width="90%">
<img src="../Image/Ashoka1.gif" width="80" height="100">
</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td colspan="3" align="center">
GOVT. OF ASSAM
<BR>
OFFICE OF THE DEPUTY COMMISSIONER::::::::::::::::::::::NALBARI
<BR>
(Administration Branch)
<BR><BR>
CERTIFICATE OF BAKIJAI CLEARANCE 
</td>
</tr>
<tr><td colspan="4">$blank</td></tr>
</table>
EOD;
$dt=date('d/m/Y');
$tblhead=<<<EOD
<table align="center"  cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;" width="85%">
<tr>
<td width="10%">&nbsp;</td>
<td align="left" width="$cwidth[1]">No. NBJ-6/<b>$Pet_yr/$Pet_no</b></td>
<td align="center" width="$cwidth[2]">&nbsp;</td>
<td align="right" width="$cwidth[3]">Date:$dt</td>
</tr>
<tr><td colspan="4">$blank</td></tr>
<tr>
<td width="10%">&nbsp;</td>
<td  width="90%" colspan="3">
<div align="justify" style="line-height:2">
This is to certify that 
Sri/Smti <b>$name</b> $relation <b>$fname</b>
resident of  Village <b>$village</b>  under  Mauza <b> $mouza</b>
of <b>$circle</b> Circle under <b>$ps</b> Police Station in the
District of $dist is not a Bakijai defaulter . 
<br>
<br>
</div>
</td>
</tr>
<tr>
<td width="60%" colspan="2">$blank$blank</td>
<td width="40%" colspan="2">&nbsp;</td>
</tr>
<tr><td colspan="4">$blank</td></tr>
<tr>
<td width="60%" colspan="2">&nbsp;</td>
<td width="40%" colspan="2">$ddosign</td>
</tr>
<tr><td colspan="2" align="center" width="100%">
<hr>
</td></tr>
<tr><td colspan="2" align="center" width="100%"><br><br>
(This certificate is valid only for six months from the date of issue of the certificate.In the event of any case registered during this period,the validity will expire on the date of registration of the case.) 
</td></tr>
</table>

EOD;


$tblfdata=$title.$tblhead;
if($mpdf==true)
{
$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
$pdf->writeHTML($tblfdata, true, false, false, false, '');
}
else
echo $tblfdata;


$tblfoot=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;">
<tr>
<td  align="left" width="100%">
$blank$blank$blank$blank$blank$blank$blank$blank
</td>
</tr>
<tr>
<td  align="left" width="100%"><hr>Processed by $username on URL $ip</td>
</tr>
</table>
EOD;

$pdf->SetFont('helvetica', '', 8);
if($mpdf==true)
{
$pdf->writeHTML($tblfoot, true, false, false, false, '');
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $tblfoot;


?>
