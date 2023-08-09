<html>
<title>List case</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>

<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_casedate.php';

$objBp=new Baki_payment();
$objCd=new Bakijai_casedate();

$objUtility=new Utility();

if (isset($_POST['Bank'])) //If HTML Field is Availbale
{
$_Bank=$_POST['Bank'];
$mvalue[0]=$_Bank;
}
else //Post Data Not Available
$_Bank="0";


//Start Validation //Branch

if (isset($_POST['Branch'])) //If HTML Field is Availbale
{
$_Branch=$_POST['Branch'];
$mvalue[1]=$_Branch;
}
else //Post Data Not Available
$_Branch="0";

$_SESSION['mvalue']=$mvalue;


$objBakijai_main=new Bakijai_main();
$cond="Bank='".$_Bank."' and Branch='".$_Branch."' and Disposed='N' order by Case_id";

$objBakijai_main->setCondString($cond);
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<Thead>
<tr><td colspan=10 align=Center bgcolor=#ccffcc><font face=arial size=3>Running Case Under
<b><?php echo $_Bank;?>,<?php echo $_Branch;?>
</font></td></tr>
<tr>
<td align=center><font face=arial size=2>
Slno
</td>
<td align=center><font face=arial size=2>
Circle/Village
</td>
<td align=center><font face=arial size=2>
Case_id
</td>
<td align=center><font face=arial size=2>
Case_no
</td>
<td align=center><font face=arial size=2>
Full_name
</td>
<td align=center><font face=arial size=2>
Amount Demand
</td>
<td align=center><font face=arial size=2>
Amount Received
</td>
<td align=center><font face=arial size=2>
Balance
</td>
<td align=center><font face=arial size=2>
Notice Served
</td>
<td align=center><font face=arial size=2>
Remarks
</td>
</tr>
</Thead>


<?php
$amt1=0;
$amt2=0;
$amt3=0;
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font face=arial size=2>
<?php
echo $ii+1;
?>
</td>
<td align=left><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Village'];
echo $tvalue;
?>
</td>
<td align=left><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Case_id'];
echo $tvalue;
?>
</td>
<td align=center><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Case_no']."/".$row[$ii]['Fin_yr'];
echo $tvalue;
?>
</td>
<td align=left><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=right><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Amount'];
echo $tvalue;
$amt1=$amt1+$tvalue;
?>
</td>
<td align=right><font face=arial size=2>
<?php
$bal=$objBp->BalanecAmount($row[$ii]['Case_id']);
echo $tvalue-$bal;
$amt2=$amt2+($tvalue-$bal);
?>
</td>
<td align=right><font face=arial size=2>
<?php
echo $bal;
$amt3=$amt3+$bal;
?>
</td>
<td align=center><font face=arial size=2>
<?php
$tvalue=$objCd->rowCount("Case_id=".$row[$ii]['Case_id']);
echo $tvalue;
?>
</td>
<td align=left>
<?php echo $row[$ii]['Remarks'];?>
</td>
</tr>
<?php
}
?>
<tr><td colspan=5 align=right>Total</td>
<td align=right><b><font face=arial size=2>
<?php
echo $amt1;
?>
</td>
<td align=right><b><font face=arial size=2>
<?php
echo $amt2;
?>
</td>
<td align=right><b><font face=arial size=2>
<?php
echo $amt3;
?>
</td>
<td align=center><b>
&nbsp;
</td>
<td align=center><b>
&nbsp;
</td>
</tr>
</table>

</body>
</html>
