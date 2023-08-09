  
<?php

//session_start();
//require_once '../class/utility.php';
require_once '../class/utility.class.php';
//require_once '../class/class.pwd.php';
require_once './class/class.pfc_collection.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
//require_once 'header.php';
$objUtility=new Utility();
if(isset($_POST['yy']))
$yy=$_POST['yy'];
else
$yy="0";    


$objPt=new Petition_master();

$objPC=new Pfc_collection();


$cond="Pet_yr='".$yy."'";
$dt=$objPt->Max("Pet_date", $cond);

//echo $dt;

$tr=explode("-",$dt);
if(isset($tr[1]))
$m=$tr[1];
else
$m=0;   

$m=round($m);

//echo "<br>";
//echo $m;
?>
   
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="100%" colspan="7" align="center"><font face="arial" size="2" color="blue"><b>COLLECTION DETAIL FOR <?php echo $yy;?></b></td>
</tr>
<tr><td width="5%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Period</td>  
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Jama Collection</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Eroll Collection</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Other </td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Total Collection</td> 
<td width="20%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Deposit Date & ID</td>
</tr>    
   
<?php
$ind=0;
for($ii=$m;$ii>0;$ii--)
{
$tot=0;   
$ind++;
$date1=$yy."-".$ii."-"."01";
$date2=$yy."-".$ii."-".$objUtility->mDays[$ii];
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ind;
echo $tvalue;
//$objPt->getExp_dt()
?>
</td>
<td align=center><font face="arial" size="2">
<?php
echo $objUtility->Month($ii)."/".$yy
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$cond="Pet_type='JB'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$tvalue=$objPt->Sum("fees", $cond);
$tot=$tot+$tvalue;
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$cond="Pet_type='ER'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$tvalue=$objPt->Sum("fees", $cond);
$tot=$tot+$tvalue;
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$cond="Pet_type<>'ER' and Pet_type<>'JB'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$tvalue=$objPt->Sum("fees", $cond);
$tot=$tot+$tvalue;
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
echo $tot;
?>
</td>
<td align=center><font face="arial" size="2">&nbsp;
<?php
$objPC->setCal_yr($yy);
$objPC->setCal_month($ii);
if($objPC->EditRecord()==false)
echo "";
else
{
$rem="ID-<b>".$objPC->getSl_no()."/".$objPC->getCal_yr();
$rem=$rem." Date:".$objUtility->to_date($objPC->getCollection_date());    

echo $rem;
}
?>
</td>

</tr>
<?php
} //for loop
?>
</table>

