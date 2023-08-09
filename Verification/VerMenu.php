<html>
<head>
<title></title>
</head>
<body>
    <?php
	session_start();
    $_SESSION['redirect']=false;

$_SESSION['prev']=0;

    ?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=60%>
<tr><td colspan=1 align=Center bgcolor=#ccffcc><font face=arial size=4>VERIFICATION OF CHARACTER/CASTE/PRC</font></td></tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Form_VERIFICATION.php?tag=0  style='text-decoration: none'>Entry of New Record</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Forward.php?tag=0  style='text-decoration: none'>Generate Forwarding to SP/CO</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Receipt.php?tag=0  style='text-decoration: none'>Update SP/Co Report</a>
</td>
</tr>
<tr>
<td align=center bgcolor=#FFFFCC>
<a href=Final.php?tag=0  style='text-decoration: none'>Final Report</a>
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
