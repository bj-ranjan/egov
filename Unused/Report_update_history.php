<html>
<title>Entry Form forupdate_history</title>
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
<tr><td colspan=5 align=Center><hr></td></tr>
<tr><td colspan=5 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- update_history</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Rsl
</td>
<td align=center>
Detail
</td>
<td align=center>
User_code
</td>
<td align=center>
Entry_date
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.update_history.php';
$objUtility=new Utility();
$objUpdate_history=new Update_history();
$row=$objUpdate_history->getAllRecord();
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
$tvalue=$row[$ii]['Rsl'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Detail'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['User_code'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Entry_date']);
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
