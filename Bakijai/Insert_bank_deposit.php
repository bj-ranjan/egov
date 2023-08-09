<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bank_deposit.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBank_deposit=new Bank_deposit();
$Err="<font face=arial size=1 color=blue>";
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
$b_Installment=$_POST['Installment'];
$mvalue[1]=$b_Installment;
if (!is_numeric($b_Installment))
$myTag++;
$c_Deposit_date=$_POST['Deposit_date'];
$mvalue[2]=$c_Deposit_date;
if ($objUtility->isdate($c_Deposit_date)==false)
$myTag++;
else
$c_Deposit_date=$objUtility->to_mysqldate($c_Deposit_date);
$d_Amount=$_POST['Amount'];
$mvalue[3]=$d_Amount;
if (!is_numeric($d_Amount))
$myTag++;
$e_Collection_book_no=$_POST['Collection_book_no'];
$mvalue[4]=$e_Collection_book_no;
if ($objUtility->validate($e_Collection_book_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($e_Collection_book_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($e_Collection_book_no)==0)
{
$e_Collection_book_no="NULL";
}
}
else
$myTag++;
$f_Collection_rcpt_no=$_POST['Collection_rcpt_no'];
$mvalue[5]=$f_Collection_rcpt_no;
if ($objUtility->validate($f_Collection_rcpt_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Collection_rcpt_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($f_Collection_rcpt_no)==0)
{
$f_Collection_rcpt_no="NULL";
}
}
else
$myTag++;
$g_Bank_rcpt_no=$_POST['Bank_rcpt_no'];
$mvalue[6]=$g_Bank_rcpt_no;
if ($objUtility->validate($g_Bank_rcpt_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($g_Bank_rcpt_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($g_Bank_rcpt_no)==0)
{
$g_Bank_rcpt_no="NULL";
}
}
else
$myTag++;


$mmode="";
if ($myTag==0)
{
$objBank_deposit->setCase_id($a_Case_id);
$objBank_deposit->setInstallment($b_Installment);
$objBank_deposit->setDeposit_date($c_Deposit_date);
$objBank_deposit->setAmount($d_Amount);
$objBank_deposit->setCollection_book_no($e_Collection_book_no);
$objBank_deposit->setCollection_rcpt_no($f_Collection_rcpt_no);
$objBank_deposit->setBank_rcpt_no($g_Bank_rcpt_no);
if ($_SESSION['update']==0)
{
$result=$objBank_deposit->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBank_deposit->returnSql;
$col=1;
}
else
{
$result=$objBank_deposit->UpdateRecord();
$col=$objBank_deposit->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBank_deposit->returnSql;
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
// Call MaxCase_id() Function Here if available in class or required and Load in $mvalue[0]
//$mvalue[0]="";//Case_id
// Call MaxInstallment() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Installment
// Call MaxDeposit_date() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Deposit_date
// Call MaxAmount() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Amount
// Call MaxCollection_book_no() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//Collection_book_no
// Call MaxCollection_rcpt_no() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Collection_rcpt_no
// Call MaxBank_rcpt_no() Function Here if available in class or required and Load in $mvalue[6]
$mvalue[6]="";//Bank_rcpt_no
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Bank_deposit", $sql, 2, "M");

   // $objUtility->saveSqlLog("Bank_deposit",$sql);

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
header( 'Location: Form_bank_deposit.php?tag=1');
?>
<a href=Form_bank_deposit.php?tag=1>Back</a>
</body>
</html>
