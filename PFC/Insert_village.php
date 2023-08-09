<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once '../bakijai/class/class.village.php';
require_once '../bakijai/class/class.circle.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objVillage=new Village();
$Err="<font face=arial size=1 color=blue>";
$a_Vill_code=$_POST['Vill_code'];
$mvalue[0]=$a_Vill_code;
if (!is_numeric($a_Vill_code))
$myTag++;
$b_Vill_name=$_POST['Vill_name'];
$mvalue[1]=$b_Vill_name;
if ($objUtility->validate($b_Vill_name,50)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Vill_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Vill_name)==0)
{
$b_Vill_name="NULL";
}
}
else
$myTag++;
$c_Cir_code=$_POST['Cir_code'];
$mvalue[2]=$c_Cir_code;
if (is_numeric($c_Cir_code)==false)
{
$c_Cir_code="NULL";
}
$d_Vill_name_ass=$_POST['Vill_name_ass'];
$mvalue[3]=$d_Vill_name_ass;
if ($objUtility->validate($d_Vill_name_ass,70)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($d_Vill_name_ass)==false)
{
$myTag++;
$Err=$Err." Expect Unicode in Field-4";
}

if (strlen($d_Vill_name_ass)==0)
{
$d_Vill_name_ass="NULL";
}
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$msql="update petition_master set village='".$b_Vill_name."' where Vill_code=".$a_Vill_code;
$objVillage->ExecuteQuery($msql);

$objVillage->setVill_code($a_Vill_code);
$objVillage->setVill_name($b_Vill_name);
$objVillage->setCir_code($c_Cir_code);
$objVillage->setVill_name_ass($d_Vill_name_ass);

if (isset($_POST['Revenue_village']))
{
$objVillage->setRevenue_Village(1);
echo "set 1";
}
else
{
$objVillage->setRevenue_Village(0); 
echo "set 0";
}
if ($_SESSION['update']==0)
{
$result=$objVillage->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objVillage->returnSql;
$col=1;
}
else
{
$result=$objVillage->UpdateRecord();
$col=$objVillage->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objVillage->returnSql;
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
// Call MaxVill_code() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Vill_code
// Call MaxVill_name() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Vill_name
// Call MaxCir_code() Function Here if available in class or required and Load in $mvalue[2]
//$mvalue[2]="0";//Cir_code
// Call MaxVill_name_ass() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Vill_name_ass
//Succesfully update hence make an entry in sql log
echo $sql;
if ($col>0)
$objUtility->saveSqlLog("Village",$sql);
$objUtility->Backup2Access("", $sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_village.php?tag=1');
?>
<a href=Form_village.php?tag=1>Back</a>
</body>
</html>
