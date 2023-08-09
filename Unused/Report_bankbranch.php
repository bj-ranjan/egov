<html>
<title>Entry Form forbankbranch</title>
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
<tr><td colspan=3 align=Center><hr></td></tr>
<tr><td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bankbranch</font></td></tr>
<tr>
<td align=center>
Rsl
</td>
<td align=center>
Bank
</td>
<td align=center>
Branch
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.bankbranch.php';
require_once './class/class.bank_master.php';
$objUtility=new Utility();
$objBankbranch=new Bankbranch();
$row=$objBankbranch->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Rsl'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objBank_master=new Bank_master();
$objBank_master->setBank_name($row[$ii]['Bank']);
$objBank_master->editRecord();
$tvalue=$objBank_master->getBtype();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Branch'];
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
