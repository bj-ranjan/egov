<html>
<title>Entry Form formouza</title>
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
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- mouza</font></td></tr>
<tr>
<td align=center>
Mouza_code
</td>
<td align=center>
Mouza_name
</td>
<td align=center>
Mouza_name_ass
</td>
<td align=center>
Cir_code
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.mouza.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
$objMouza=new Mouza();
$row=$objMouza->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Mouza_code'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Mouza_name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Mouza_name_ass'];
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
</tr>
<?php
}
?>
</table>

<a href=mainmenu.php?tag=1>Menu</a>
</body>
</html>
