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
require_once './class/class.legal_heir.php';

$mpdf=true;
//$mpdf=false;

$rheight=35;

$objSen=new Sentence();
if (isset($_GET['yr']))
$Pet_yr=$_GET['yr'];
else
$Pet_yr=0;


if (isset($_SESSION['username']))
$username=$_SESSION['username'];
else 
$username="";


if (isset($_GET['pno']))
$Pet_no=$_GET['pno'];
else
$Pet_no=0;

if (isset($_GET['idate']))
$dt=$_GET['idate'];
else
$dt=date('d/m/Y');


$objUtility=new Utility();
$objPetition_master=new Petition_master();
//$PageFormat="FANFOLD15X12";  //Large Page 15x12
$PageFormat="LEGAL";  //8.5x14
//$PageFormat="A4";  //8.5x11

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
$BO="";
$letterno="";
$dated="";
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
$letterno=$objPetition_master->getCo_letter();

$dated=$objPetition_master->getCo_letter_dt();
 
$caste=$objPetition_master->getCaste();
$subcaste=$objPetition_master->getSubcaste();

if($objPetition_master->getPet_type()!="LH")
header( 'Location: Mainmenu.php?tag=0'); 

$BO=$objPetition_master->getBo_name();
if(strlen($BO)>0)
$BO="(".$BO.")";

$sign=$objPetition_master->getSignedBy("LH");

$memono=$objPetition_master->getRejected_reason();

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
GOVERNMENT OF ASSAM
<BR>
OFFICE OF THE DEPUTY COMMISSIONER:::::::::::::::NALBARI
<BR>
(Administration Branch)
<BR>
03624-220496(O),220469/220371(F)<BR>
Email: dc-nalbari@nic.in
<br><br><br>
CERTIFICATE OF NEXT OF KIN 
</td>
</tr>
<tr><td colspan="4">$blank</td></tr>
</table>
EOD;
//$dt=date('d/m/Y');
$tblhead=<<<EOD
<table align="center"  cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;" width="85%" align="center">
<tr>
<td width="10%">&nbsp;</td>
<td align="left" width="30%">$memono</td>
<td align="center" width="30%">Petition Id-$Pet_no/$Pet_yr</td>
<td align="right" width="30%">Issue Date:$dt</td>
</tr>
<tr><td colspan="4">$blank</td></tr>
<tr>
<td width="10%">&nbsp;</td>
<td  width="100%" colspan="3">
<div align="justify" style="line-height:2">
This is to certify that the Next of Kin of <b>$fname</b> 
of  Village/Town <b>$village</b>  under  Mauza <b> $mouza</b>
of <b>$circle</b> Revenue Circle,Police Station <b>$ps</b>  in the
District of $dist are as follows(As per Circle Officer's report vide no $letterno dated $dated) . 
</div>
</td>
</tr>
</table>
EOD;
//Body
$tblbody=<<<EOD
<table cellpadding="4" cellspacing="0" bordercolor="#000000" border="1"  style="vertical-align:middle;" width="100%" align="center">
<tr>
<td align="center" width="10%">Sl No.</td>
<td align="center" width="40%">Name of NOK</td>
<td align="center" width="30%">Relation with deceased</td>
<td align="center" width="20%">Age</td>
</tr>
EOD;
$tblbottom=<<<EOD
</table>
EOD;

$objLegal_heir=new Legal_heir();
$slno=0;
$tblfdata="";
$cond="Pet_yr=".$Pet_yr." and Pet_no=".$Pet_no." order by Slno";
$objLegal_heir->setCondString($cond);
$row=$objLegal_heir->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$slno++;
$colvalue[1]=$row[$ii]['Nok'];
$colvalue[2]=Rel($row[$ii]['Relation']);
$colvalue[3]=$row[$ii]['Age'];
$tbldata=<<<EOD
<tr>
<td align="center" width="$cwidth[0]">$slno</td>
<td align="left" height="$rheight">$colvalue[1]</td>
<td align="center" height="$rheight">$colvalue[2]</td>
<td align="center" height="$rheight">$colvalue[3]</td>
</tr>
EOD;
$tblfdata=$tblfdata.$tbldata;
}

$head=<<<EOD
<table cellpadding="4" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;" width="90%" align="center">
<tr>
<td align="center" width="10%">&nbsp;</td>
<td align="left" width="90%">
EOD;

$tblbody=$head.$tblbody.$tblfdata.$tblbottom."</td></tr></table>";

//body


$tblfdata=$title.$tblhead;


if($mpdf==true)
{
$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
$pdf->writeHTML($tblfdata, true, false, false, false, '');
$pdf->writeHTML($tblbody, true, false, false, false, '');
}
else
echo $tblfdata.$tblbody;


$Sign=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;">
<tr>
<td  align="left" width="50%">&nbsp;</td>
<td  align="center" width="50%"><br><BR><BR><b>$BO</b><br>$sign</td>
</tr>
</table>
EOD;

$tblfoot=<<<EOD
<br>
<p align="center">
<br><br><br><br>
<br>
Processed by $username on URL $ip
</p>
EOD;

if($mpdf==true)
{
$pdf->writeHTML($Sign, true, false, false, false, '');
$pdf->SetFont('helvetica', '', 8);
//$pdf->writeHTML($tblfoot, true, false, false, false, '');
}
else
{
echo $Sign;
echo $tblfoot;
}

if($mpdf==true)
{
ob_end_clean();
$pdf->Output('Temp.pdf', 'I');
}

function Rel($Relation)
{
$trow=explode(" ",$Relation);
if(isset($trow[0]))
return($trow[0]);
else
return($Relation);
}

?>
