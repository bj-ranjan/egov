<html>
<title></title>
</head>
<script language=javascript>
<!--

</script>
<body>

       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';

require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();
$gross=0;
$bal=0;

if (isset($_POST['Case_id']))
$id=$_POST['Case_id'];
else
$id=0;
  

//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bakijai_main();
$objBm->setCase_id($id);
$mode="";
if ($objBm->EditRecord())
{
$mstr="Case No-".$objBm->getBank().",".$objBm->getBranch()."(";
$mstr=$mstr.$objBm->getCase_no()."/".$objBm->getFin_yr().")";
$amount=$objBm->getAmount();
$date2=substr($objBm->getStart_date(),0,10);
$mode=$objBm->getPayment_mode(); 
$ddate=$objBm->getDisposed_date(); 
}
$objBp=new Baki_payment();
$objBp->setCase_id($id);

?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>        
<tr><td colspan="7" align="center"><font face="arial" size="3" color="red">
<?php echo $mstr."    Date.".$objUtility->to_date($date2);?></td></tr>
<tr><td align="center" colspan="7" bgcolor="#99FFCC"><font face="arial" size="2">INTEREST CALCULATION SHEET</font></td></tr> 
    <tr><td align="center" width="10%" bgcolor="#99FFCC"><font face="arial" size="2">SlNo</td>
 <td align="center" width="20%" bgcolor="#99FFCC"><font face="arial" size="2">Pay Date</td>   
 <td align="center" width="20%" bgcolor="#99FFCC"><font face="arial" size="2">Amount Due</td> 
 <td align="center" width="20%" bgcolor="#99FFCC"><font face="arial" size="2">Amount Paid</td> 
 <td align="center" width="20%" bgcolor="#99FFCC"><font face="arial" size="2">Interest Upto date<br>6.25%PA</td> 
 <td align="center" width="10%" bgcolor="#99FFCC"><font face="arial" size="2">Period(Days)</td> 
 
 </tr> 
     
<?php  
$paid=0;
$total=0;
$str=" Paid_today>0 and case_id=".$id."  order by Pay_date";
$objBp->setCondString($str);
$row=$objBp->getAllRecord();


//if($mode=="OTS")
//{
//$nodays=$objUtility->dateDiff($ddate, $date2);    
//$interest=round(($amount*6.25*$nodays)/36500);
//}


if(count($row)==0)
{
$d2=$objUtility->to_date($date2);
$d3=$objUtility->to_date($ddate);
$nodays=$objUtility->dateDiff($ddate, $date2);   
//echo $nodays; 
$interest=round(($amount*6.25*$nodays)/36500);
echo "<p align=center>Interest from ".$d2." to ".$d3." for an Amount Rs.".$amount." is=Rs.<b>".$interest."</b></p>";
}
for($ii=0;$ii<count($row);$ii++)
{
$due=$amount-$paid;    
$date1=substr($row[$ii]['Pay_date'],0,10);

$nodays=$objUtility->dateDiff($date1, $date2);
//$rem= $date2." to ".$date1." ".$nodays;
$rem=$nodays;
$paid=$paid+$row[$ii]['Paid_today'];
$interest=round(($due*6.25*$nodays)/36500);
$date2=$date1;
$total=$total+$interest;
?>      
 <tr>
 <td align="center" ><font face="arial" size="2"><?php echo $ii+1?></td>
 <td align="center" ><font face="arial" size="2"><?php echo $objUtility->to_date($row[$ii]['Pay_date']);?></td>  
 <td align="right"><font face="arial" size="2"><?php echo $objUtil->convert2standard($due);?></td>          
 <td align="right"><font face="arial" size="2"><?php echo $objUtil->convert2standard($row[$ii]['Paid_today']);?></td>          
 <td align="right"><font face="arial" size="2"><?php echo $objUtil->convert2standard($interest);?></td>          
  <td align="center"><font face="arial" size="2"><?php echo $rem;?></td> 
 </tr>
 
<?php }?>      
<tr><td colspan="4" align="right"><font face="arial" size="3" > 
Total Interest Payable</td>    <td align="right"><b>
        <?php echo $objUtil->convert2standard($total);?>
    </td><td>&nbsp;</td></tr> 
<tr><td colspan="7" align="center"><font face="arial" size="3" > 
In words (<b><?php echo $objUtil->letter($total);?> </b></td> </tr>
        </table>        

</table>
</body>
</html>
