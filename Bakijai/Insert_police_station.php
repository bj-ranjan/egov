<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.police_station.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objPolice_station=new Police_station();
$Err="<font face=arial size=1 color=blue>";
$a_Code=$_POST['Code'];
$mvalue[0]=$a_Code;
if (!is_numeric($a_Code))
$myTag++;
$b_Name=$_POST['Name'];
$mvalue[1]=$b_Name;
if ($objUtility->validate($b_Name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Name)==0)
{
$b_Name="NULL";
}
}
else
$myTag++;
$c_Name_ass=$_POST['Name_ass'];
$mvalue[2]=$c_Name_ass;
if ($objUtility->validate($c_Name_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($c_Name_ass)==false)
{
$Err=$Err;
$myTag++;
$Err=$Err." Expect Unicode in Field-3";
}

if (strlen($c_Name_ass)==0)
{
$c_Name_ass="NULL";
}
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objPolice_station->setCode($a_Code);
$objPolice_station->setName($b_Name);
$objPolice_station->setName_ass($c_Name_ass);
if ($_SESSION['update']==0)
{
$result=$objPolice_station->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objPolice_station->returnSql;
$col=1;
}
else
{
$result=$objPolice_station->UpdateRecord();
$col=$objPolice_station->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objPolice_station->returnSql;
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
// Call MaxCode() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Code
// Call MaxName() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Name
// Call MaxName_ass() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Name_ass
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Police_station", $sql, 2, "M");
     
//$objUtility->saveSqlLog("Police_station",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_police_station.php?tag=1');
?>
<a href=Form_police_station.php?tag=1>Back</a>
</body>
</html>
