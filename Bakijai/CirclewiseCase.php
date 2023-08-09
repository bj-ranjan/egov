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
<table border=1 align=center cellpadding=0 cellspacing=0 style=border-collapse: collapse; width=90%>
<Thead>
<tr><td colspan=10 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bakijai_main</font></td></tr>
<tr>
<td align=center>
Slno
</td>
<td align=center>
Circle/Village
</td>
<td align=center>
Case_id
</td>
<td align=center>
Case_no
</td>
<td align=center>
Full_name
</td>
<td align=center>
Amount Demand
</td>
<td align=center>
Amount Received
</td>
<td align=center>
Balance
</td>
<td align=center>
Notice Served
</td>
<td align=center>
Remarks
</td>
</tr>
</Thead>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_casedate.php';

$objBp=new Baki_payment();
$objCd=new Bakijai_casedate();

$objUtility=new Utility();
$objBakijai_main=new Bakijai_main();
$cond="Disposed='N' order by Village,Bank,Branch";
$objBakijai_main->setCondString($cond);
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center>
<?php
echo $ii+1;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Village'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Case_id'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Bank'].",".$row[$ii]['Branch']." ".$row[$ii]['Case_no']."/".$row[$ii]['Fin_yr'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Amount'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$bal=$objBp->BalanecAmount($row[$ii]['Case_id']);
echo $tvalue-$bal;
?>
</td>
<td align=left>
<?php
echo $bal;
?>
</td>
<td align=center>
<?php
$tvalue=$objCd->rowCount("Case_id=".$row[$ii]['Case_id']);
echo $tvalue;
?>
</td>
<td align=left>
&nbsp;
</td>
</tr>
<?php
}
?>
</table>

</body>
</html>
