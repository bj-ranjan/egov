<html>
<title>Entry Form forcircle</title>
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
<tr><td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- circle</font></td></tr>
<tr>
<td align=center>
Cir_code
</td>
<td align=center>
Circle
</td>
<td align=center>
Circle_ass
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
$objCircle=new Circle();
$row=$objCircle->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Cir_code'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Circle'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Circle_ass'];
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
