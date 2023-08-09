  
<?php

//session_start();
//require_once '../class/utility.php';
require_once '../class/utility.class.php';
//require_once '../class/class.pwd.php';
//require_once '../class/class.sentence.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
//require_once 'header.php';
$objUtility=new Utility();
if(isset($_POST['Pname']))
$ptype=$_POST['Pname'];
else
$ptype="-";    

$objPt=new Petition_master();
$objPtype=new Petition_type();

$objPt->setCondString("Applicant like '%".$ptype."%' order by Pet_date desc,Pet_type,Applicant");
$row=$objPt->getAllRecord();
//echo $objBm->returnSql;

?>
   
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="68%" colspan="7" align="center"><font face="arial" size="2" color="blue"><b>SEARCH RESULT</b></td>
</tr>
    
<tr><td width="5%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="12%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition Type</td>  
<td width="24%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Name of Applicant</td> 
<td width="22%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Address</td>
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition No</td> 
<td width="10%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Date</td> 
<td width="12%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Status</td> 
</tr>    
   
<?php
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
//$objPt->getExp_dt()
?>
</td>
<td align=center><font face="arial" size="1">
<?php
$objPtype->setCode($row[$ii]['Pet_type']);
if ($objPtype->EditRecord())
$pettype=strtoupper($objPtype->getAbvr());
else
$pettype="&nbsp;";
echo $pettype;
?>
</td>
<td align=left><font face="arial" size="2"><b>
<?php
$tvalue=($row[$ii]['Applicant']);
echo strtoupper($tvalue);
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue="C/o ".$row[$ii]['Father']."<br> Vill-".$row[$ii]['Village'];
echo $tvalue;
?>
</td>

<td align=center><font face="arial" size="2"><B>
<?php
if(strlen($row[$ii]['Xohari_requestid'])>3)
$tvalue=($row[$ii]['Xohari_requestid']);
else
{
//$tvalue=($row[$ii]['Pet_type']);
$tvalue="";
$tvalue=$tvalue."".($row[$ii]['Pet_no']."/".$row[$ii]['Pet_yr']);   
}
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Pet_date'];
$tvalue=$objUtility->to_date($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Status'];
$date1="";
if($tvalue=="Pending")
{    
$date1=$row[$ii]['Pet_date'];   
//echo "Pending";
}
if($tvalue=="Processed" || $tvalue=="Rejected" )
$date1=$row[$ii]['Process_date']; 
if($tvalue=="Issued")
$date1=$row[$ii]['Process_date']; 
echo $tvalue. " on ".$objUtility->to_date($date1);
?>
</td>
</tr>
<?php
} //for loop
?>
</table>

