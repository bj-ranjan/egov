<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.update_history.php';

$objHis=new Update_history();

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBaki_payment=new Baki_payment();
$Err="<font face=arial size=1 color=blue>";
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
$b_Instalment_no="0";
$mvalue[1]=$b_Instalment_no;
if (!is_numeric($b_Instalment_no))
$myTag++;
$c_Paid_today=$_POST['Paid_today'];
$mvalue[2]=$c_Paid_today;
if (is_numeric($c_Paid_today)==false)
{
$c_Paid_today="NULL";
}
$d_Pay_date=$_POST['Pay_date'];
$mvalue[3]=$d_Pay_date;
if ($objUtility->isdate($d_Pay_date)==false)
{
if (strlen($d_Pay_date)==0)
{
$d_Pay_date="NULL";
}
else
$myTag++;
}
else
$d_Pay_date=$objUtility->to_mysqldate($d_Pay_date);


$mmode="";
if ($myTag==0)
{
$objBaki_payment->setCase_id($a_Case_id);
$objBaki_payment->setInstalment_no($b_Instalment_no);
$objBaki_payment->setPaid_today($c_Paid_today);
$objBaki_payment->setPay_date($d_Pay_date);

if ($_SESSION['update']==0)
{
$result=$objBaki_payment->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBaki_payment->returnSql;
$col=1;
$objHis->setDetail("Rs.".$c_Paid_today." as Old Amount Paid");
}
else
{
$result=$objBaki_payment->UpdateRecord();
$col=$objBaki_payment->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBaki_payment->returnSql;
$objHis->setDetail("Rs.".$c_Paid_today." (Old Amount Updated");
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
if ($col>0)
{
$objHis->setCase_id($a_Case_id);
$objHis->setRsl($objHis->maxRsl($a_Case_id));
$objHis->SaveRecord();
}
//Clear the Required Field back to Entry Form
// Call MaxCase_id() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Case_id
// Call MaxInstalment_no() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Instalment_no
$mvalue[2]="";
// Call MaxPay_date() Function Here if available in class or required and Load in $mvalue[3]

//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Baki_payment",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: OldPay.php?tag=1');
?>

</body>
</html>
