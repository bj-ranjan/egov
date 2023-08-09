<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.branch_section.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBranch_section=new Branch_section();
$Err="<font face=arial size=1 color=blue>";
$a_Branch_code=$_POST['Branch_code'];
$mvalue[0]=$a_Branch_code;
if (!is_numeric($a_Branch_code))
$myTag++;
$b_Branch_name=$_POST['Branch_name'];
$mvalue[1]=$b_Branch_name;
if ($objUtility->validate($b_Branch_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Branch_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Branch_name)==0)
$myTag++;
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objBranch_section->setBranch_code($a_Branch_code);
$objBranch_section->setBranch_name($b_Branch_name);
if ($_SESSION['update']==0)
{
$result=$objBranch_section->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBranch_section->returnSql;
$col=1;
}
else
{
$result=$objBranch_section->UpdateRecord();
$col=$objBranch_section->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBranch_section->returnSql;
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
$mvalue[0]="";//Branch_code
// Call MaxBranch_name() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Branch_name
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Branch_section",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_branch_section.php?tag=1');
?>
<a href=Form_branch_section.php?tag=1>Back</a>
</body>
</html>
