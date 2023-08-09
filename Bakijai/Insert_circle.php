<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.circle.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objCircle=new Circle();
$Err="<font face=arial size=1 color=blue>";
$a_Cir_code=$_POST['Cir_code'];
$mvalue[0]=$a_Cir_code;
if (!is_numeric($a_Cir_code))
$myTag++;
$b_Circle=$_POST['Circle'];
$mvalue[1]=$b_Circle;
if ($objUtility->validate($b_Circle)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Circle)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Circle)==0)
{
$b_Circle="NULL";
}
}
else
$myTag++;
$c_Circle_ass=$_POST['Circle_ass'];
$mvalue[2]=$c_Circle_ass;
if ($objUtility->validate($c_Circle_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($c_Circle_ass)==false)
{
$Err=$Err;
$myTag++;
$Err=$Err." Expect Unicode in Field-3";
}

if (strlen($c_Circle_ass)==0)
{
$c_Circle_ass="NULL";
}
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objCircle->setCir_code($a_Cir_code);
$objCircle->setCircle($b_Circle);
$objCircle->setCircle_ass($c_Circle_ass);
if ($_SESSION['update']==0)
{
$result=$objCircle->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objCircle->returnSql;
$col=1;
}
else
{
$result=$objCircle->UpdateRecord();
$col=$objCircle->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objCircle->returnSql;
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
// Call MaxCir_code() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Cir_code
// Call MaxCircle() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Circle
// Call MaxCircle_ass() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Circle_ass
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Circle", $sql, 2, "M");
     
//$objUtility->saveSqlLog("Circle",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_circle.php?tag=1');
?>
<a href=Form_circle.php?tag=1>Back</a>
</body>
</html>
