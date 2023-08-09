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
require_once './class/class.circle.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.baki_payment.php';

$objBp=new Baki_payment();

$objUtility=new Utility();

$objC=new Circle();

$objBakijai_main=new Bakijai_main();
$cond=" Court_case='Y' order by Case_id";

$objBakijai_main->setCondString($cond);
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<Thead>
<tr><td colspan=9 align=Center bgcolor=#ccffcc><font face=arial size=3>
<a href=editcase.php?tag=0>High Court Case</a>
</font></td></tr>
<tr>
<td align=center><font face=arial size=2>
Slno
</td>
<td align=center><font face=arial size=2>
Circle
</td>
<td align=center><font face=arial size=2>
Village
</td>
<td align=center><font face=arial size=2>
Case ID
</td>
<td align=center><font face=arial size=2>
Case_No
</td>
<td align=center><font face=arial size=2>
Name of Defaulter
</td>
<td align=center><font face=arial size=2>
Amount Demand
</td>
<td align=center><font face=arial size=2>
Balance
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
$objC->setCir_code($row[$ii]['Circle']);
if($row[$ii]['Circle']>0 && $objC->EditRecord())
echo $objC->getCircle();
else
echo "&nbsp;";
?>
</td>
<td align=left><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Village'];
echo $tvalue;
?>
</td>
<td align=center><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Case_id'];
echo $tvalue;
?>
</td>
<td align=center><font face=arial size=2>
<?php
$tvalue=$row[$ii]['Bank']."(".$row[$ii]['Branch'].")".$row[$ii]['Case_no']."/".$row[$ii]['Fin_yr'];
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
?>
</td>
<td align=right><font face=arial size=2>
<?php
$bal=$objBp->BalanecAmount($row[$ii]['Case_id']);
echo $bal;
?>
</td>
<td align=center><font face=arial size=2>
<?php
if($row[$ii]['Disposed']=="Y")
echo "Disposed<br>";
echo $row[$ii]['Remarks'];
?>
</td>
</tr>
<?php
}
?>
</table>

</body>
</html>
