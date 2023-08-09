<html>
<title>Entry Form forbank_master</title>
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
<tr><td colspan=2 align=Center><hr></td></tr>
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bank_master</font></td></tr>
<tr>
<td align=center>
Bank_name
</td>
<td align=center>
Btype
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.bank_master.php';
$objUtility=new Utility();
$objBank_master=new Bank_master();
$row=$objBank_master->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Bank_name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Btype'];
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
