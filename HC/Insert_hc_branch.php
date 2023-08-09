<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_branch.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objHc_branch=new Hc_branch();
$Err="<font face=arial size=1 color=blue>";

//Start Validation //Code

if (isset($_POST['Code'])) //If HTML Field is Availbale
{
$a_Code=$_POST['Code'];
$mvalue[0]=$a_Code;
if (!is_numeric($a_Code))
$myTag++;
}
else //Post Data Not Available
$a_Code="NULL";


//Start Validation //Name

if (isset($_POST['Name'])) //If HTML Field is Availbale
{
$b_Name=$_POST['Name'];
$mvalue[1]=$b_Name;
if ($objUtility->validate($b_Name,30)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Name)==0)
$myTag++;
}
else
$myTag++;
}
else //Post Data Not Available
$b_Name="NULL";



$mmode="";
if ($myTag==0)
{
$objHc_branch->setCode($a_Code);
$objHc_branch->setName($b_Name);
if ($_SESSION['update']==0)
{
$result=$objHc_branch->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objHc_branch->returnSql;
$col=1;
}
else
{
$result=$objHc_branch->UpdateRecord();
$col=$objHc_branch->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objHc_branch->returnSql;
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
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Hc_branch",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_hc_branch.php?tag=1');
?>
<a href=Form_hc_branch.php?tag=1>Back</a>
</body>
</html>
