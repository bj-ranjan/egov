<html>
<title>Entry Form forbaki_payment</title>
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
<tr><td colspan=6 align=Center><hr></td></tr>
<tr><td colspan=6 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- baki_payment</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Instalment_no
</td>
<td align=center>
Paid_today
</td>
<td align=center>
Pay_date
</td>
<td align=center>
Payment_mode
</td>
<td align=center>
Receipt_no
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
$objBaki_payment=new Baki_payment();
$row=$objBaki_payment->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($row[$ii]['Case_id']);
$objBakijai_main->editRecord();
$tvalue=$objBakijai_main->getCase_no();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Instalment_no'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Paid_today'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Pay_date']);
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Payment_mode'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Receipt_no'];
echo $tvalue;
?>
</td>
</tr>
<?php
}
?>
</table>

<a href=mainmenu.php?tag=1>Menu</a>
</body>
</html>
