<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bankbranch.php';
require_once './class/class.bank_master.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBankbranch=new Bankbranch();
$Err="<font face=arial size=1 color=blue>";
$a_Rsl=$_POST['Rsl'];
$mvalue[0]=$a_Rsl;
if (is_numeric($a_Rsl)==false)
{
$a_Rsl="NULL";
}
$b_Bank=$_POST['Bank'];
$mvalue[1]=$b_Bank;
if ($objUtility->validate($b_Bank)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Bank)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Bank)==0)
$myTag++;
}
else
$myTag++;
$c_Branch=$_POST['Branch'];
$mvalue[2]=$c_Branch;
if ($objUtility->validate($c_Branch)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($c_Branch)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-3";
}

if (strlen($c_Branch)==0)
$myTag++;
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objBankbranch->setRsl($a_Rsl);
$objBankbranch->setBank($b_Bank);
$objBankbranch->setBranch($c_Branch);
if ($_SESSION['update']==0)
{
$result=$objBankbranch->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBankbranch->returnSql;
$col=1;
}
else
{
$result=$objBankbranch->UpdateRecord();
$col=$objBankbranch->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBankbranch->returnSql;
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
// Call MaxRsl() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Rsl
// Call MaxBank() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Bank
// Call MaxBranch() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Branch
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Bankbranch", $sql, 2, "M");
    
//$objUtility->saveSqlLog("Bankbranch",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_bankbranch.php?tag=1');
?>
<a href=Form_bankbranch.php?tag=1>Back</a>
</body>
</html>
