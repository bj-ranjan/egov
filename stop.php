<html>
<title>Display userlog</title>
<HEAD>
 
</HEAD>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>
<?php

session_start();
require_once './class/class.userlog.php';
require_once './class/utility.class.php';

$objU=new Utility();

$uid=$_GET['uid'];
$objUserlog=new Userlog();
if($objU->VerifyRoll()==0)
{
$sql="update userlog set active='N' where active='Y' and  Uid='".$uid."'";
$objUserlog->ExecuteQuery($sql);
}
header('location:listactiveuser.php');
?>

