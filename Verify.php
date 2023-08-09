<?//php include("connection.php"); ?>
<?php
session_start();

require_once './class/class.pwd.php';
require_once './class/class.sentence.php';
require_once './class/class.userlog.php';

require_once './class/utility.class.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();

if(isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;    

if (isset($_SERVER['REMOTE_ADDR']))
$ip= $_SERVER['REMOTE_ADDR'];  
else
$ip="NA";

$timein=date('h:i:s A');

$ip=$ip." at ".$timein;

//$objCp=new CopyF();


if(isset($_SESSION['sid']))
echo "Verify Session ID-".$_SESSION['sid'];


$objUtility=new Utility();
$objUl=new Userlog();
$objC=new Sentence();

$_SESSION['msg']="";
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_GET['page']))
$lastpage=$_GET['page'];
else
$lastpage="index.php";
$first="N";
$mytag=0;
$oldPwd="";
if ($_tag==0)
{
if(isset($_POST['Uid']))
$a_Uid=$_POST['Uid'];
else
$a_Uid="x";
if(isset($_POST['Pwd']))
{    
$b_Pwd=$_POST['Pwd'];
$oldPwd=$b_Pwd;
}
else
$b_Pwd="x";

if ($objUtility->validate($a_Uid,20)==false || $objUtility->validate($b_Pwd,20)==false)
{
$mytag++; //Server Validation Fails
$_SESSION['msg']=$_SESSION['msg']." Validation Fails";
}

//if($objUl->isActiveUser($a_Uid,8))
if($objUl->isActive($a_Uid))        
{
$mytag++;    
$_SESSION['msg']=$_SESSION['msg']." User Already Logged in";
//$objUtility->saveSqlLog("mylog", $objUl->returnSql);
$nn=0;    
}

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

//check if User is Already Login
//

$objPwd=new Pwd();
$objPwd->setUid($a_Uid);
//paste here
if($objPwd->EditRecord() && $mytag==0 ) //User Available
{   
if ($b_Pwd==$objPwd->getPwd() && $objPwd->getActive()=='N') //Inactive User
{
$_SESSION['msg']=" User Locked by Administrator";   
$mytag++;  
}


$first=$objPwd->getFirst_login();   

//echo "acrive";
if ($b_Pwd==$objPwd->getPwd() && $objPwd->getActive()=='Y')
{
$_SESSION['username']=$objPwd->getFullname();   
$_SESSION['roll']=$objPwd->getRoll();
$_SESSION['uid']=$a_Uid;
$_SESSION['pwd']=$b_Pwd;

$_SESSION['username']=$objPwd->getFullname();
$_SESSION['branch']=$objPwd->getBranch_code();
$_SESSION['myArea']=$objPwd->getArea();

$objUl->setUid($a_Uid);
$objUl->setActive("Y");
if(isset($_SESSION['New']))
$New=$_SESSION['New'];
else
$New=1;    
if($New==1)
{
$objUl->setLog_time_in(date('H:i:s'));
$objUl->setLog_time_out(date('H:i:s'));
}
if(isset($_SESSION['sid']))
$sid=$_SESSION['sid'];
else
$sid=0;   

$objUl->setSession_id($sid);

echo "SID-".$sid;

if($objUl->UpdateRecord()==false)
{
$mytag++;    
$_SESSION['msg']=$_SESSION['msg']."Please Relogin(Session ID Fails)";
} //$objUl->SaveRecord()==false

//$objUtility->CreateLogFile("UserLog", "Verify".$objUl->returnSql, 1, "Y");

//echo $objUl->returnSql;

//$objUtility->saveSqlLog("Verify",$objUl->returnSql);
$_SESSION['t2']=date('H:i:s');
} //$b_Pwd==$objPwd->getPwd()
else //$b_Pwd==$objPwd->getPwd()
{
if($mytag==0)
{
$mytag++;    
$_SESSION['msg']=" Invalid User or Password";
$objUtility->saveSqlLog ("FailLog", $a_Uid."/".$oldPwd." Invalid Password ".$ip);
}
} //Bpwd==$objPwd->getPwd()
} //editrecord
else 
{
$mytag++;    
$_SESSION['msg']=$_SESSION['msg']." Invalid User"; 
$objUtility->saveSqlLog ("FailLog", $a_Uid."/".$oldPwd.": Invalid User ".$ip);
}
//end here

if($first=="Y")
$_SESSION['firstlogin']="Y";
else
$_SESSION['firstlogin']="N";    
    
if($mytag==0)
{    
if($first=="N")
{
$_SESSION['sec']=0;
$_SESSION['sec']=0;
//header( 'Location: Inter.php?tag=0');
//startnew
if ($_SESSION['roll']==0 || $_SESSION['roll']==1) //All Branch
header( 'Location: startmenu.php?tag=0');
$tt=0;

if($_SESSION['roll']==3) //general Operator
header( 'Location: ./New/EditDak.php?tag=0');
//header( 'Location: ./DAK/EditDak.php?tag=0');    

if($_SESSION['roll']==2)
{
if ($_SESSION['branch']==1) //Bakijai
header( 'Location: ./Bakijai/MainMenu.php?tag=0');

if ($_SESSION['branch']==3) //Personnel DAK
header( 'Location: ./DAK/DakEntry.php?tag=0');

if ($_SESSION['branch']==4) //PFC
header( 'Location: ./PFC/MainMenu.php?tag=0');

if ($_SESSION['branch']==5) //Magistracy
header( 'Location: ./crpc/crpcmenu.php?tag=0');

//if ($_SESSION['branch']==6) //PA
//header( 'Location: ./HC/MainMenu.php?tag=0');
}
}
else
header( 'Location: ChangePwd.php?tag=0');    
}
else
header( 'Location: indexPage.php?tag=2');
?>
<a href="indexpage.php?tag=2">Go</a>

<a href="startmenu.php?tag=2">start</a>
</body>
</html>
