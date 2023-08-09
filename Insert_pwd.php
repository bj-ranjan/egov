<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.pwd.php';
require_once './class/class.roll.php';
require_once './class/class.branch_section.php';
require_once './class/class.sentence.php';
require_once './class/class.Areaofwork.php';

$objArea=new Areaofwork();
$objSen=new Sentence();
$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objPwd=new Pwd();
$Err="<font face=arial size=1 color=blue>";
$a_Uid=$_POST['Uid'];
$mvalue[0]=$a_Uid;
if ($objUtility->validate($a_Uid,20)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($a_Uid)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-1";
}

if (strlen($a_Uid)==0)
$myTag++;
}
else
$myTag++;
$b_Pwd=$_POST['Pwd'];
$mvalue[1]=$b_Pwd;
if (1==1)
{
//Check for Unicode if required
//if ($objUtility->isUnicode($b_Pwd)==false)
{
$Err=$Err;
//$myTag++;
//$Err=$Err." Expect Unicode in Field-2";
}

if (strlen($b_Pwd)==0)
$myTag++;
}
else
$myTag++;
$c_Roll=$_POST['Roll'];
$mvalue[2]=$c_Roll;
if (!is_numeric($c_Roll))
$myTag++;
$d_Fullname=$_POST['Fullname'];
$mvalue[3]=$d_Fullname;
if ($objUtility->validate($d_Fullname,30)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($d_Fullname)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-4";
}
$areaStr="";
if (strlen($d_Fullname)==0)
{
$d_Fullname="NULL";
}
}
else
$myTag++;
$e_Branch_code=$_POST['Branch_code'];
$mvalue[4]=$e_Branch_code;
if (!is_numeric($e_Branch_code))
$myTag++;
else
{
$objArea->setCondString("Branch_code=".$mvalue[4]);
$myrow=$objArea->getRow();
$areaStr="";
for ($in=0;$in<count($myrow);$in++)
{
$arr="Area".$myrow[$in]['Area_code'];
if (isset($_POST[$arr])) 
{    
$areaStr=$areaStr.$myrow[$in]['Area_code'];
if($in<count($myrow))
$areaStr=$areaStr.",";   
}
} //for loop
//echo $areaStr;
//echo "<br>";
if (substr($areaStr,-1)==",")
$areaStr=substr($areaStr,0,strlen($areaStr)-1);  

//echo $areaStr;

}//isnumeric branch code

$f_Active=$_POST['Active'];
$mvalue[5]=$f_Active;
if ($objUtility->validate($f_Active,1)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Active)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($f_Active)==0)
{
$f_Active="NULL";
}
}
else
$myTag++;
$g_Firstlogin=$_POST['Firstlogin'];
$mvalue[6]=$g_Firstlogin;
if ($objUtility->validate($g_Firstlogin,1)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($g_Firstlogin)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($g_Firstlogin)==0)
$myTag++;
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objPwd->setUid($a_Uid);
$b_Pwd=$objSen->Encrypt($b_Pwd);
$objPwd->setRoll($c_Roll);
$objPwd->setFullname($d_Fullname);
$objPwd->setBranch_code($e_Branch_code);
$objPwd->setActive($f_Active);
$objPwd->setFirstlogin($g_Firstlogin);
$objPwd->setArea($areaStr);
if ($_SESSION['update']==0)
{
$objPwd->setPwd($b_Pwd);
$result=$objPwd->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objPwd->returnSql;
$col=1;
}
else
{
$result=$objPwd->UpdateRecord();
$col=$objPwd->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objPwd->returnSql;
}
$_SESSION['msg']=$mmode;
if (!$result)
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
}
else
{
//Clear the Required Field back to Entry Form
// Call MaxUid() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Uid
// Call MaxPwd() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Pwd
// Call MaxRoll() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="-1";//Roll
// Call MaxFullname() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Fullname
$mvalue[4]="-1";
$mvalue[5]="Y";
$mvalue[6]="Y";
if (isset($_POST['Editme']))
$mvalue[7]=$_POST['Editme']; 
else
$mvalue[7]=0;    
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Pwd",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_pwd.php?tag=1');
?>
<a href=Form_pwd.php?tag=1>Back</a>
</body>
</html>
