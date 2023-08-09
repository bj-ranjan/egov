<html>
<head>
<title></title>
</head>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
$objUtility=new Utility();
 $roll=$objUtility->VerifyRoll();
//echo "session-".$_SESSION['roll']."<br>";
//echo $roll;
if ($roll==-1 || ($_SESSION['branch']!=6 && $_SESSION['branch']>0)) //Not bakijai
{
$_SESSION['returnmsg']="You are not authosied for Case Management" ; 
header( 'Location: ../index.php?tag=1');    
}
?>
<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=40%>
<tr><td colspan=1 align=Center bgcolor=#ccffcc><font face=arial size=4>Main Menu</font></td></tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_hc_department.php?tag=0  style='text-decoration: none'>Entry/Edit Department</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_hc_branch.php?tag=0  style='text-decoration: none'>Entry/Edit Branch</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_hc_casemaster.php?tag=0  style='text-decoration: none'>Entry/Edit Case</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_hc_casetransaction.php?tag=0  style='text-decoration: none'>Update ParaWise Submission Detail</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=ListCase.php?tag=0  style='text-decoration: none'>List Cases due for Parawise Submission</a>
</td>
</tr>
</table>
</form>
</body>
</html>
