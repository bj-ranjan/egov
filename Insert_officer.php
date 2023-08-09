<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.officer.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objOfficer=new Officer();
$Err="<font face=arial size=1 color=blue>";
if (isset($_POST['Slno'])) //If HTML Field is Availbale
{
$a_Slno=$_POST['Slno'];
$mvalue[0]=$a_Slno;
if (!is_numeric($a_Slno))
$myTag++;
}
else //Post Data Not Available
$a_Slno="NULL";
if (isset($_POST['Officer_name'])) //If HTML Field is Availbale
{
$b_Officer_name=$_POST['Officer_name'];
$mvalue[1]=$b_Officer_name;
if ($objUtility->validate($b_Officer_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Officer_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Officer_name)==0)
{
$b_Officer_name="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$b_Officer_name="";

if (isset($_POST['Designation'])) //If HTML Field is Availbale
{
$c_Designation=$_POST['Designation'];
$mvalue[2]=$c_Designation;
if ($objUtility->validate($c_Designation)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($c_Designation)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-3";
}

if (strlen($c_Designation)==0)
{
$c_Designation="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$c_Designation="NULL";
$d_Exist=0;
if (isset($_POST['Exist']))
$d_Exist=1;
$mvalue[3]=$d_Exist;


$mmode="";
if ($myTag==0)
{
$objOfficer->setSlno($a_Slno);
if (strlen($b_Officer_name)>2)
$objOfficer->setOfficer_name($b_Officer_name);
$objOfficer->setDesignation($c_Designation);
$objOfficer->setExist($d_Exist);
if ($_SESSION['update']==0)
{
$result=$objOfficer->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objOfficer->returnSql;
$col=1;
}
else
{
$result=$objOfficer->UpdateRecord();
$col=$objOfficer->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objOfficer->returnSql;
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
// Call MaxSlno() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Slno
// Call MaxOfficer_name() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Officer_name
// Call MaxDesignation() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Designation
// Call MaxExist() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Exist
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Officer",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_officer.php?tag=1');
?>
<a href=Form_officer.php?tag=1>Back</a>
</body>
</html>
