<html>
<head>
<title>Acknowledgement </title>
</head>
<script language=javascript>

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../xohari/class/Class.service_request.php';
require_once '../xohari/class/Class.Officer.php';
require_once '../xohari/class/Class.Service.php';
require_once '../xohari/class/Class.Office.php';
require_once '../class/utility.class.php';

$objU=new Utility();
if (!isset($_GET['id']))
header( 'Location: Pet_Entry.php?tag=0');     
else
$id=$_GET['id'];


$objReq=new Service_request(); //Object for Xohari
$objO=new Officer();    //Object for Xohari
$objSer=new Service();

$objReq->setRequest_id($id);
if ($objReq->EditRecord()==false)
header( 'Location: Pet_Entry.php?tag=0'); 

$objSer->setId($objReq->getService_id());
if ($objSer->EditRecord())
$sername=$objSer->getName();  //Service Name
$objO->setId($objReq->getOfficer_id());
if ($objO->EditRecord())
$oname=$objO->getName(); //Officer Name
$objO=new Office(); 
$objO->setId($objReq->getOffice_id());
if ($objO->EditRecord())
$officename=$objO->getName(); //Office Name

//Start of FormDesign
?>
<?php //Boundary table?>    
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr><td align="center">    
<?php //Logo Table table?>
<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=98%>
<tr>
<td align=left  width="20%">
<image src="../image/xohari.jpg" width="60" heoight="80">
</td>
<td align=center  width="60%">
<image src="../image/artps.jpg" width="400" heoight="80">
</td>
<td align=right  width="60%">
<image src="../image/ashoka.jpg" width="60" heoight="80">
</td>
</tr>
</table>
        </td></tr><table>
    <br>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr><td align="center">    
 <?php //Detail Table ?>  
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=98%>
<tr>
<td align=left  width="45%" valign="top">
    <font face="arial" size=2>    
Application No:<b><?php echo $id;?></b>
<br><br>
Name of the Applicant: <?php echo $objReq->getApplicant_name();?>
<br><br>
Address of the Applicant: <?php echo $objReq->getApplicant_address() ;?>
<br><br>
Phone No of the Applicant: <?php echo $objReq->getApplicant_phone_no()  ;?>
<br><br>
Date of Receiving the Application: <?php echo $objU->to_date($objReq->getRecieve_date()) ;?>
<br><br>
Propose Date of Delivery of Services: <?php echo $objU->to_date($objReq->getDelivery_date()) ;?>
<br><br>
</td>
<td align=left  width="55%" valign="top">
    <font face="arial" size=2>      
Name of the Designated Public Servant: <?php echo $oname ;?>
<br><br>
Office: <?php echo $officename ;?>
<br><br>
Name of the Service: <?php echo $sername ;?>
<br><br>
Rejected(Yes/No): No
<br><br>
</td>
</tr>
<tr>
<td align=left  valign="top">
&nbsp;
</td>
<td align=left  valign="top">
    <br><br>
 <font face="arial" size=2>  
 Signature of the Recipient
</td></tr>
</table>
</td></tr><table>
    
    <br><br><hr><br><br>   
<?php 
//Second Block
?>    
    <?php //Boundary table?>    
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr><td align="center">    
<?php //Logo Table table?>
<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=98%>
<tr>
<td align=left  width="20%">
<image src="../image/xohari.jpg" width="60" heoight="80">
</td>
<td align=center  width="60%">
<image src="../image/artps.jpg" width="400" heoight="80">
</td>
<td align=right  width="60%">
<image src="../image/ashoka.jpg" width="60" heoight="80">
</td>
</tr>
</table>
        </td></tr><table>
    <br>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr><td align="center">    
 <?php //Detail Table ?>   
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=98%>
<tr>
<td align=left  width="45%" valign="top">
    <font face="arial" size=2>    
Application No:<b><?php echo $id;?></b>
<br><br>
Name of the Applicant: <?php echo $objReq->getApplicant_name();?>
<br><br>
Address of the Applicant: <?php echo $objReq->getApplicant_address() ;?>
<br><br>
Phone No of the Applicant: <?php echo $objReq->getApplicant_phone_no()  ;?>
<br><br>
Date of Receiving the Application: <?php echo $objU->to_date($objReq->getRecieve_date()) ;?>
<br><br>
Propose Date of Delivery of Services: <?php echo $objU->to_date($objReq->getDelivery_date()) ;?>
<br><br>
</td>
<td align=left  width="55%" valign="top">
    <font face="arial" size=2>      
Name of the Designated Public Servant: <?php echo $oname ;?>
<br><br>
Office: <?php echo $officename ;?>
<br><br>
Name of the Service: <?php echo $sername ;?>
<br><br>
Rejected(Yes/No): No
<br><br>
</td>
</tr>
<tr>
<td align=left  valign="top">
&nbsp;
</td>
<td align=left  valign="top">
    <br><br>
 <font face="arial" size=2>  
 Signature of the Recipient
</td></tr>
</table>
</td></tr><table>
</body>
</html>
