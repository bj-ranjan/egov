<body>
<?php
session_start();
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once './class/class.petition_master.php';
require_once '../class/utility.class.php';

$objU=new Utility();

$psname=array('','Nalbari','Barbhag','Ghagrapar','Belsor','Mukalmua','Tihu','Barama','Bhangnamari','Sialmari');


$mpdf=false;
$mpdf=true;;

$cwidth=array();
$cwidth[0]="10%";
$cwidth[1]="50%";
$cwidth[2]="15%";
$cwidth[3]="25%";

$Pet_yr=date('Y');

$username="";

$Pet_no=isset($_SESSION['Pet_no'])?$_SESSION['Pet_no']:'3';


$objPM=new Petition_master();

$objPM->setPet_yr($Pet_yr);
$objPM->setPet_no($Pet_no);

$objPM->EditRecord();
$dt=date('d/m/Y');

$sign='Signature';

$name =$objPM->getApplicant();

$fname=$objPM->getFather();

$relation=$objPM->getRelation();

if($relation=="Daughter of")
$relation="D/o";
else
$relation="S/o"; 

$dist  =$objPM->getDistrict();

$village=$objPM->getVillage();

$ps  =$objPM->getPs_code();

$ps=isset($psname[$ps])?$psname[$ps]:'';

$phone=$objPM->getPhone();

$issuedate=$objPM->getExp_dt();

$pet_date=$objPM->getPet_date();

$fees=$objPM->getFees();

$issuedate=$objU->to_date($issuedate);
$pet_date=$objU->to_date($pet_date);


$PageFormat="A4";  //8.5x11
$PageOrientation="P"; //Portrait or Landscape
$fontsize=10;

$pdf = new TCPDF($PageOrientation, PDF_UNIT, $PageFormat, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('helvetica', '', $fontsize);
$pdf->setPrintFooter(false);
$tblfdata="";
$cspan=19;
//Sample Parograph
$para=<<<EOD
<div align="justify" style="line-height:1.5">
<hr>
Note:The terms "Ordinarily resides" used here will have the same meaning as in Section 20 of the Representation of the People Act,1950.        
</div>
EOD;

$blank=<<<EOD
<p align="center">&nbsp;<br><br>
</p>    
EOD;

$ddosign1=<<<EOD
<p align="center">
<b>$sign</b>
</p>
EOD;


$ddosign=<<<EOD
<table cellpadding="2" cellspacing="0" bordercolor="#000000" border="0"  style="vertical-align:middle;" width="100%">  
<tr>
<td  align="left" width="50%">
&nbsp;
</td> 
<td  align="left" width="50%">
Signature of the recipient
</td>          
</tr>
</table>
EOD;

$ipath="../image/ashoka.jpg";

$title=<<<EOD
<table  bordercolor="#000000" border="0"  align="center" style="vertical-align:middle;" width="85%">
<tr>
<td width="10%">&nbsp;</td>
<td colspan="3" align="center" width="90%">
<img src="$ipath" width="50" height="60">
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
<BR>
<U><B>ACKNOWLEDGEMENT RECEIPT</B></U>
<BR>
</td>
</tr>
</table>
 
<table  bordercolor="#000000" border="0"  align="center"  width="100%">
<tr><td  align="left" width="60%">Application No: </td><td  align="left" width="40%"><b>$Pet_no/$Pet_yr</b></td></tr>
<tr><td  align="left" width="60%">Name of Applicant:  </td><td  align="left" width="40%"><b>$name</b><br>$relation $fname</td></tr>
<tr><td  align="left" width="60%">Address:</td><td  align="left" width="40%">Village <b>$village</b>, PS <b>$ps</b></td></tr>
<tr><td  align="left" width="60%">Contact No:</td><td  align="left" width="40%"><b>$phone</b></td></tr>
<tr><td  align="left" width="60%">Date of receiving the Application</td><td  align="left" width="40%"><b>$pet_date</b></td></tr>
<tr><td  align="left" width="60%">Proposed Date of Delivery</td><td  align="left" width="40%"><b>$issuedate</b></td></tr>
<tr><td  align="left" width="60%">Name of Service</td><td  align="left" width="40%"><b>Bakijai Clearence Certificate</b></td></tr>
 <tr><td  align="left" width="60%">User Charge</td><td  align="left" width="40%"><b>Rs. $fees/-</b></td></tr>       
</table>
EOD;


$title=$title.$blank.$ddosign;


if($mpdf==true)
{
$pdf->AddPage($PageOrientation,$PageFormat);   //add page at each $mrows
$pdf->writeHTML($title.$blank."<hr>".$blank.$title, true, false, false, false, '');
//$pdf->SetFont('helvetica', '', 9);
//$pdf->writeHTML($para, true, false, false, false, '');
ob_end_clean();
//ob_start();
$pdf->Output('Temp.pdf', 'I');
}
else
echo $title.$tblhead.$ddosign;

?>
