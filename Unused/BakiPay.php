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
<tr><td colspan=8 align=Center><hr></td></tr>
<tr><td colspan=8 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- baki_payment</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Instalment_no
</td>
<td align=center>
Nextdate
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_tab.php';
$objUtility=new Utility();

$objBaki_payment=new Baki_payment();

$objBakijai_tab=new Bakijai_tab();
$row=$objBakijai_tab->getAllRecord();
$i=0;
for($ii=0;$ii<count($row);$ii++)
{
$objBaki_payment->setCase_id($row[$ii]['Id']);
$inst=$objBaki_payment->maxInstalment_no($row[$ii]['Id'])-1;
$objBaki_payment->setInstalment_no($inst);
$objBaki_payment->setNextdate($row[$ii]['Nextdate']);
if ($objBaki_payment->UpdateRecord())
$i++;
}
echo "updated-".$i;
?>
</table>

</body>
</html>
