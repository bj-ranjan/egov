<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.mouza.php';
require_once './class/class.circle.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objMouza=new Mouza();
$Err="<font face=arial size=1 color=blue>";
$a_Mouza_code=$_POST['Mouza_code'];
$mvalue[0]=$a_Mouza_code;
if (!is_numeric($a_Mouza_code))
$myTag++;
$b_Mouza_name=$_POST['Mouza_name'];
$mvalue[1]=$b_Mouza_name;
if ($objUtility->validate($b_Mouza_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Mouza_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Mouza_name)==0)
{
$b_Mouza_name="NULL";
}
}
else
$myTag++;
$c_Mouza_name_ass=$_POST['Mouza_name_ass'];
$mvalue[2]=$c_Mouza_name_ass;
if ($objUtility->validate($c_Mouza_name_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($c_Mouza_name_ass)==false)
{
$Err=$Err;
$myTag++;
$Err=$Err." Expect Unicode in Field-3";
}

if (strlen($c_Mouza_name_ass)==0)
{
$c_Mouza_name_ass="NULL";
}
}
else
$myTag++;
$d_Cir_code=$_POST['Cir_code'];
$mvalue[3]=$d_Cir_code;
if (is_numeric($d_Cir_code)==false)
{
$d_Cir_code="NULL";
}


$mmode="";
if ($myTag==0)
{
$objMouza->setMouza_code($a_Mouza_code);
$objMouza->setMouza_name($b_Mouza_name);
$objMouza->setMouza_name_ass($c_Mouza_name_ass);
$objMouza->setCir_code($d_Cir_code);
if ($_SESSION['update']==0)
{
$result=$objMouza->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objMouza->returnSql;
$col=1;
}
else
{
$result=$objMouza->UpdateRecord();
$col=$objMouza->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objMouza->returnSql;
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
// Call MaxMouza_code() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Mouza_code
// Call MaxMouza_name() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Mouza_name
// Call MaxMouza_name_ass() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Mouza_name_ass
// Call MaxCir_code() Function Here if available in class or required and Load in $mvalue[3]
//$mvalue[3]="";//Cir_code
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Mouza", $sql, 2, "M");
     
//$objUtility->saveSqlLog("Mouza",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_mouza.php?tag=1');
?>
<a href=Form_mouza.php?tag=1>Back</a>
</body>
</html>
