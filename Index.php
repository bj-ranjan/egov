<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Parliament Election 2014, Main Menu(NIC ,Nalbari)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
session_start();
//require_once './class/class.Frame.php';
require_once './class/class.userlog.php';
require_once './class/class.Pwd.php';
require_once './class/utility.class.php';

$objUtility=new Utility();


$objUl=new Userlog();
$objPwd=new Pwd();
$objPwd->setUid("root");
$change=false;

$_SESSION['RefreshCount']=0;

//if($objPwd->EditRecord())
//{
//if($objPwd->getFirst_login()=="Y")    
//$change=true;    //First Time Set Password is required
//}
//else 
//{
//$change=true;    
//}  

$totvalue=$objPwd->rowCount("1=1")+$objUl->rowCount("1=1");

if($totvalue==0) //Both PWD and Userlog is Blank
$change=true;
else
$change=false;    


if($change==false) //Password Exist
{
if (isset($_SERVER['REMOTE_ADDR']))
$ip= $_SERVER['REMOTE_ADDR'];
else
$ip="-";
$sql="update userlog set Active='N'";
$sql=$sql." where Client_ip='".$ip."'";
//$objUtility->saveTextLog("UserLog",$sql);
$objUl->ExecuteQuery($sql);

$sql="delete from userlog where log_date<'".date('Y-m-d')."'";
$objUl->ExecuteQuery($sql);

$sql="delete from UPDATE_HISTORY where entry_date<'".date('Y-m-d')."'";
$objUl->ExecuteQuery($sql);


$objUl->setUid("unknown");
$objUl->setActive("F");
$objUl->setLog_time_in(date('H:i:s'));
$_SESSION['sid']=$objUl->maxSession_id();
$objUl->setSession_id($_SESSION['sid']);
if($objUl->SaveRecord()) 
{
//$objUtility->saveTextLog("UserLog","Start Session ID-".$_SESSION['sid']);
//$objUtility->saveTextLog("UserLog","Loged at ".date('H:i:s')." From ".$ip);
//header('Location:indexpage.php?tag=0');
header('Location:LoginFrame.php');
}
else
echo "Unable to Create Session ID";    
}//if($change==false)
else
header('Location:./class/ChangeFirstPwd.php');
//echo $objUl->returnSql;
//$objUtility->CreateLogFile("UserLog", $objUl->returnSql, 1, "Y");
?>    
   
</body>
</html>
