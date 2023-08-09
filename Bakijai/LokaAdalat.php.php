<html>
<head>
<title></title>
</head>
<script language=javascript>
<!--
function prin()
{
myform.setAttribute("target","_blank");
myform.action="Clearence.php"
myform.submit();
}
</script>
<BODY>
<script language=javascript>
<!--
</script>
<body onload=setMe()>
<p align=center>
<?php
session_start();
include_once 'BakiMenuHead.html';
require_once './class/class.bakijai_main.php';
require_once '../class/utility.class.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

$objBakijai_main=new Bakijai_main();

echo "<table border=0 cellpadding=2 cellspacing=2 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=myform   method=POST >";
echo "<tr>";
echo "<td align=center>";
echo "Enter Case ID</td><td>";
echo "<input type=text size=9 name='Id' id='Id' >";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center>";
echo "Enter Dispose Date</td><td>";
echo "<input type=text size=10 name='Ddate' id='Ddate'  value=".date('d/m/Y').">";
echo "</td></tr> ";
echo "<tr>";
echo "<td align=center>";
echo "Enter Letter Date</td><td>";
echo "<input type=text size=10 name='Ldate' id='Ldate'  value=".date('d/m/Y').">";
echo "</td></tr> ";
echo "<tr><td></td>";

echo "<td align=left>";
echo "<input type=button value='GO' onclick='prin()' >";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";

?>
