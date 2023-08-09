<html>
<head>
<title></title>
</head>
<body>
    <?php
	session_start();
require_once '../class/utility.class.php';
    $_SESSION['redirect']=false;


if (isset($_SESSION['myArea']))
$Area=$_SESSION['myArea'];
else
$Area=0;

$_SESSION['prev']=0;

$objU=new Utility();

$roll=$objU->VerifyRoll();

if($roll>0)
{
for($i=25;$i<=27;$i++)
{
if($objU->checkArea($Area,$i)==true)
echo $objU->AlertNRedirect("","../Verification/VerMenu.php");
}
}
    ?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=60%>
<tr><td colspan=1 align=Center bgcolor=#ccffcc><font face=arial size=4>C.R.P.C. Case Main Menu</font></td></tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_Crpc_main.php?tag=0  style='text-decoration: none'>Entry of Case</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_Crpc_party.php?tag=0  style='text-decoration: none'>Enter Party Detail</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_Crpc_proceeding.php?tag=0  style='text-decoration: none'>Record Proceeding</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Change.php?tag=0  style='text-decoration: none'>Transfer Case</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=delete.php?tag=0  style='text-decoration: none'>Remove Case from Database</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=SelectCase.php?tag=0  style='text-decoration: none'>Display Case Register</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=SelectMonth.php?tag=0  style='text-decoration: none'>Monthly Report</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=logout.php?tag=0  style='text-decoration: none'>Logout</a>
</td>
</tr>
</table>
</form>
</body>
</html>
