<body>
<?//php include("connection.php"); ?>
<?php
session_start();

require_once './class/class.pwd.php';
require_once './class/class.sentence.php';
require_once './class/class.userlogin.php';
require_once './class/utility.class.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();


$objU=new Utility();
$objC=new Sentence();

$ObjUL=new Userlogin();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_GET['page']))
$lastpage=$_GET['page'];
else
$lastpage="index.php";


if ($_tag==0)
{
$a_Uid=$_POST['Uid'];
$b_Pwd=$_POST['Pwd'];
//echo $a_Uid." ".$b_Pwd."<br>s";
$b_Pwd=$objC->Encrypt($b_Pwd);
$mvalue[0]=$a_Uid;
$mvalue[1]=$b_Pwd;
$_SESSION['mvalue']=$mvalue;
}
else
{
$a_Uid=$_SESSION['uid'];
$b_Pwd=$_SESSION['pwd'];  
}   



$objPwd=new Pwd();

$objPwd->setUid($a_Uid);
$objPwd->EditRecord();

//echo $a_Uid." ".$b_Pwd;

if ($b_Pwd==$objPwd->getPwd())
{
$_SESSION['roll']=$objPwd->getRoll();
$_SESSION['uid']=$a_Uid;
$_SESSION['pwd']=$b_Pwd;
$_SESSION['username']=$objPwd->getFullname();
$_SESSION['branch']=$objPwd->getBranch_code();
$_SESSION['myArea']=$objPwd->getArea();
//echo "success";
//if ($_tag==0)
$ObjUL->setUid($a_Uid);
$ObjUL->SaveRecord();
$line=$ObjUL->returnSql;
$objU->saveSqlLog("UserLog", $line);
if ($objPwd->getFirstlogin()=="Y")
header( 'Location: ChangePWD.php?tag=0');

if ($objPwd->getFirstlogin()=="N")
{   
if ($_SESSION['branch']==0) //All Branch
header( 'Location: inter.php?tag=0');

if($_SESSION['roll']==3 || $_SESSION['roll']==1) //general Operator
header( 'Location: ./DAK/EditDak.php?tag=0');    

if($_SESSION['roll']==2)
{
if ($_SESSION['branch']==1) //Bakijai
header( 'Location: ./Bakijai/MainMenu.php?tag=0');

if ($_SESSION['branch']==3) //Personnel DAK
header( 'Location: ./DAK/DakEntry.php?tag=0');

if ($_SESSION['branch']==4) //PFC
header( 'Location: ./PFC/MainMenu.php?tag=0');

if ($_SESSION['branch']==6) //PA
header( 'Location: ./HC/MainMenu.php?tag=0');
}

}
} //end password Match
else //password doesnot match
{
$_SESSION['returnmsg']="Invalid User or Password" ;   
//$_SESSION['msg']="Failed to Login";
header( 'Location: index.php?tag=1');
echo "fail";
}
?>
    <a href="index.php">back</a>
</body>
</html>
