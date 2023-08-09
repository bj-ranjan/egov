<html>
<title>Entry Form forbakijai_casedate</title>
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
<tr><td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bakijai_casedate</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Day
</td>
<td align=center>
Next_date
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.bakijai_casedate.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
$objBakijai_casedate=new Bakijai_casedate();
$row=$objBakijai_casedate->getAllRecord();
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
$tvalue=$row[$ii]['Day'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Next_date']);
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
