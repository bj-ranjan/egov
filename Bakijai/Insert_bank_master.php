<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bank_master.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBank_master=new Bank_master();
$Err="<font face=arial size=1 color=blue>";
$a_Bank_name=$_POST['Bank_name'];
$mvalue[0]=$a_Bank_name;
if ($objUtility->validate($a_Bank_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($a_Bank_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-1";
}

if (strlen($a_Bank_name)==0)
$myTag++;
}
else
$myTag++;
$b_Btype=$_POST['Btype'];
$mvalue[1]=$b_Btype;
if ($objUtility->validate($b_Btype)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Btype)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Btype)==0)
{
$b_Btype="NULL";
}
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objBank_master->setBank_name($a_Bank_name);
$objBank_master->setBtype($b_Btype);
if ($_SESSION['update']==0)
{
$result=$objBank_master->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBank_master->returnSql;
$col=1;
}
else
{
$result=$objBank_master->UpdateRecord();
$col=$objBank_master->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBank_master->returnSql;
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
// Call MaxBank_name() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Bank_name
$mvalue[1]="Financial";
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Bank_master", $sql, 2, "M");
   

$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_bank_master.php?tag=1');
?>
<a href=Form_bank_master.php?tag=1>Back</a>
</body>
</html>
