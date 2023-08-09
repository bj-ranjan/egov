<html>
<title>Entry Form forvillage</title>
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
<tr><td colspan=4 align=Center><hr></td></tr>
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- village</font></td></tr>
<tr>
<td align=center>
Vill_code
</td>
<td align=center>
Vill_name
</td>
<td align=center>
Cir_code
</td>
<td align=center>
Vill_name_ass
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.village.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
$objVillage=new Village();
$row=$objVillage->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Vill_code'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Vill_name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objCircle=new Circle();
$objCircle->setCir_code($row[$ii]['Cir_code']);
$objCircle->editRecord();
$tvalue=$objCircle->getCircle();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Vill_name_ass'];
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
