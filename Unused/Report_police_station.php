<html>
<title>Entry Form forpolice_station</title>
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
<tr><td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- police_station</font></td></tr>
<tr>
<td align=center>
Code
</td>
<td align=center>
Name
</td>
<td align=center>
Name_ass
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.police_station.php';
$objUtility=new Utility();
$objPolice_station=new Police_station();
$row=$objPolice_station->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Code'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Name_ass'];
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
