<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.areaofwork.php';
require_once './class/class.branch_section.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objAreaofwork=new Areaofwork();
$Err="<font face=arial size=1 color=blue>";
$a_Branch_code=$_POST['Branch_code'];
$mvalue[0]=$a_Branch_code;
if (!is_numeric($a_Branch_code))
$myTag++;
$b_Area_code=$_POST['Area_code'];
$mvalue[1]=$b_Area_code;
if (!is_numeric($b_Area_code))
$myTag++;
$c_Area_name=$_POST['Area_name'];
$mvalue[2]=$c_Area_name;
if ($objUtility->validate($c_Area_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($c_Area_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-3";
}

if (strlen($c_Area_name)==0)
$myTag++;
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objAreaofwork->setBranch_code($a_Branch_code);
$objAreaofwork->setArea_code($b_Area_code);
$objAreaofwork->setArea_name($c_Area_name);
if ($_SESSION['update']==0)
{
$result=$objAreaofwork->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objAreaofwork->returnSql;
$col=1;
}
else
{
$result=$objAreaofwork->UpdateRecord();
$col=$objAreaofwork->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objAreaofwork->returnSql;
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
// Call MaxBranch_code() Function Here if available in class or required and Load in $mvalue[0]
//$mvalue[0]="0";//Branch_code
// Call MaxArea_code() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Area_code
// Call MaxArea_name() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Area_name
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Areaofwork",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_areaofwork.php?tag=1');
?>
<a href=Form_areaofwork.php?tag=1>Back</a>
</body>
</html>
