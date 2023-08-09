  
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
if(isset($_POST['Ptype']))
$ptype=$_POST['Ptype'];
else
$ptype="-";    

$objPt=new Petition_master();
$objPtype=new Petition_type();

$objPt->setCondString("status='Pending' and pet_type='".$ptype."' and AST='N' order by pet_date desc,pet_no");
$row=$objPt->getAllRecord();
//echo $objBm->returnSql;

$objPtype->setCode($ptype);
if ($objPtype->EditRecord())
$pettype=strtoupper($objPtype->getDetail());
else
$pettype="&nbsp;";

?>
   
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="68%" colspan="5" align="center"><font face="arial" size="2" color="blue"><b>PENDING PETITION LIST FOR <font face="arial" COLOR="RED"><?php echo $pettype;?></b></td>
 <td align="center" width="25%" COLSPAN="2">
 <select id="Ptype" onchange="reload()">
<option value="0">-Select-
<option value="PR">PRC
<option value="CT">Caste
<option value="NC">Non Creamy
<option value="DM">Domicile
 </select>
 </td>
        <td align="center" width="7%">
 <input type=button value=Menu  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:red;color:black;width:80px">
           
        </td>
    </tr>
    
<tr><td width="5%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="12%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition Type</td>  
<td width="24%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Name of Applicant</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition No</td> 
<td width="10%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Date</td> 
<td width="9%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Pending For(Days)</td> 
<td width="18%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Forwarded by</td>
<td width="7%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Process</td>
</tr>    
   
<?php
for($ii=0;$ii<count($row);$ii++)
{
if($row[$ii]['Pet_type']=="PR" || $row[$ii]['Pet_type']=="DM")
$plink="ProcessPRC.php?tag=0";
if($row[$ii]['Pet_type']=="CT")
$plink="ProcessCaste.php?tag=0";
if($row[$ii]['Pet_type']=="NC")
$plink="ProcessNC.php?tag=0";
$plink=$plink."&yr=".$row[$ii]['Pet_yr']."&pno=".$row[$ii]['Pet_no'];
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
$objPtype->setCode($ptype);
if ($objPtype->EditRecord())
$pettype=strtoupper($objPtype->getAbvr());
else
$pettype="&nbsp;";
echo $pettype;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=($row[$ii]['Applicant']);
echo strtoupper($tvalue);
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
$date1=date('Y-m-d');
$date2=substr($row[$ii]['Pet_date'],0,10);
$tvalue=$objUtility->dateDiff($date1, $date2);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">&nbsp;
<?php
$objP=new Pwd();
$tvalue=$row[$ii]['Entered_by'];
$objP->setUid($tvalue);
if($objP->EditRecord())
echo $objP->getFullname();
else
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<a href="<?php echo $plink;?>">Click</td>
</tr></a>
<?php
} //for loop
?>
</table>

