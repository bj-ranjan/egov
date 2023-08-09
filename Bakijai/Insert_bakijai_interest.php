<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_interest.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBakijai_interest=new Bakijai_interest();
$Err="<font face=arial size=1 color=blue>";
if (isset($_POST['Case_id'])) //If HTML Field is Availbale
{
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
}
else //Post Data Not Available
$a_Case_id="NULL";
if (isset($_POST['Interest_payable'])) //If HTML Field is Availbale
{
$b_Interest_payable=$_POST['Interest_payable'];
$mvalue[1]=$b_Interest_payable;
if (is_numeric($b_Interest_payable)==false)
{
$b_Interest_payable="NULL";
}
}
else //Post Data Not Available
$b_Interest_payable="NULL";
if (isset($_POST['Pay_date'])) //If HTML Field is Availbale
{
$c_Pay_date=$_POST['Pay_date'];
$mvalue[2]=$c_Pay_date;
if ($objUtility->isdate($c_Pay_date)==false)
{
if (strlen($c_Pay_date)==0)
{
$c_Pay_date="NULL";
}
else
$myTag++;
}
else
$c_Pay_date=$objUtility->to_mysqldate($c_Pay_date);
}
else //Post Data Not Available
$c_Pay_date="NULL";


if (isset($_POST['Receipt_no'])) //If HTML Field is Availbale
$d_Receipt_no=$_POST['Receipt_no'];
else
$d_Receipt_no="NULL";



$mmode="";
if ($myTag==0)
{
$objBakijai_interest->setCase_id($a_Case_id);
$objBakijai_interest->setInterest_payable($b_Interest_payable);
$objBakijai_interest->setPay_date($c_Pay_date);
$objBakijai_interest->setReceipt_no($d_Receipt_no);

if ($_SESSION['update']==0)
{
$result=$objBakijai_interest->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBakijai_interest->returnSql;
$col=1;
}
else
{
$result=$objBakijai_interest->UpdateRecord();
$col=$objBakijai_interest->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBakijai_interest->returnSql;
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
$mvalue[0]="0";
// Call MaxInterest_payable() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Interest_payable
// Call MaxPay_date() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Pay_date
// Call MaxEntry_date() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Entry_date
// Call MaxUser_code() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//User_code
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Bakijai_Interest", $sql, 2, "M");
    
//$objUtility->saveSqlLog("Bakijai_interest",$sql);
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
header( 'Location: Form_baki_interest.php?tag=1');
?>
<a href=Form_baki_interest.php?tag=1>Back</a>
</body>
</html>
