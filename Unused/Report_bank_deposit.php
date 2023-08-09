<html>
<title>Entry Form forbank_deposit</title>
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
<tr><td colspan=7 align=Center><hr></td></tr>
<tr><td colspan=7 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bank_deposit</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Installment
</td>
<td align=center>
Amount
</td>
<td align=center>
Deposit_date
</td>
<td align=center>
Collection_book_no
</td>
<td align=center>
Collection_rcpt_no
</td>
<td align=center>
Bank_rcpt_no
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.bank_deposit.php';
$objUtility=new Utility();
$objBank_deposit=new Bank_deposit();
$row=$objBank_deposit->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Case_id'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Installment'];
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
$tvalue=$objUtility->to_date($row[$ii]['Deposit_date']);
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Collection_book_no'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Collection_rcpt_no'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Bank_rcpt_no'];
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
