
      
<?php

session_start();
//require_once '../class/utility.php';
require_once '../class/utility.class.php';
//require_once '../class/class.sentence.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';

//$objSen=new Sentence();
$objUtility=new Utility();
$roll=$objUtility->VerifyRoll();
if(isset($_POST['date']))
$date=$_POST['date'];
else
$date=date('d/m/Y');


$objPt=new Petition_master();
$objPtype=new Petition_type();
//echo $_SESSION['mdate'];
$date1=$objUtility->to_mysqldate($date);
$objPt->setCondString("Pet_date='".$date1."' order by Pet_type,Pet_no");
$row=$objPt->getAllRecord();
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="100%" colspan="6" align="center"><font face="arial" size="2" color="BLACK">DETAIL LIST OF PETITION RECEIVED ON <?php echo $date;?></td></tr>
<tr><td width="5%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition Type</td>  
<td width="20%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition No</td>  
<td width="23%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Name of Applicant</td>    
<td width="22%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Address</td>    
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Present Status</td> 
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
<td align=center><font face="arial" size="2">
<?php
$objPtype->setCode($row[$ii]['Pet_type']);
if ($objPtype->EditRecord())
$tvalue=$objPtype->getAbvr ();
else
$tvalue="&nbsp;";
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
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
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Applicant'];
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue="C/o ".$row[$ii]['Father']."<br> Vill-".$row[$ii]['Village'];
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
</td></tr>    
<?php
}
?>
</table>

</body>
</html>
