<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.update_history.php';
require_once './class/class.bakijai_casedate.php';
require_once './class/class.finalreport.php';

$objF=new Finalreport();

$dt=$objF->getFinalDate();

$objCD=new Bakijai_casedate();
$objHis=new Update_history();

$_SESSION['oldId']=0;
$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBaki_payment=new Baki_payment();

$objBm=new Bakijai_main();
$Err="<font face=arial size=1 color=blue>";
$a_Case_id=$_POST['Case_id'];


$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
$b_Instalment_no=$_POST['Instalment_no'];
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


$diff=$objUtility->dateDiff($dt, $d_Pay_date);
if($diff>=0)
{
$myTag++;
$Err.="Pay Date is freezed" ;   
}

echo $dt."-".$d_Pay_date."=".$diff."<br>";

$e_Payment_mode=$_POST['Payment_mode'];
$mvalue[4]=$e_Payment_mode;
if ($objUtility->validate($e_Payment_mode,20)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($e_Payment_mode)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($e_Payment_mode)==0)
{
$e_Payment_mode="NULL";
}
}
else
$myTag++;
if (isset($_POST['Receipt_no']))
{
$f_Receipt_no=$_POST['Receipt_no'];
$mvalue[5]=$f_Receipt_no;
}
else
{
$f_Receipt_no="-";
$mvalue[5]=$f_Receipt_no;   
}
    
if ($objUtility->validate($f_Receipt_no,50)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Receipt_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($f_Receipt_no)==0)
{
$f_Receipt_no="NULL";
}
}
else
$myTag++;
$h_Nextdate=$_POST['Nextdate'];
$mvalue[6]=$h_Nextdate;
if ($objUtility->isdate($h_Nextdate)==false )
{
if (strlen($h_Nextdate)==0)
{
$h_Nextdate="NULL";
}
else
$myTag++;
}
else
$h_Nextdate=$objUtility->to_mysqldate($h_Nextdate);

$sql2="";
$mmode="";
if ($myTag==0)
{
$objBaki_payment->setCase_id($a_Case_id);
$objBaki_payment->setInstalment_no($b_Instalment_no);
$sql2="update baki_payment set nextdate=NULL where case_id=".$a_Case_id." and Instalment_no=".$b_Instalment_no;
$objBaki_payment->setPay_date($d_Pay_date);
$objBaki_payment->setPayment_mode($e_Payment_mode);
//$yr=substr($d_Pay_date,0,4);
//$mn=substr($d_Pay_date,5,2);
//$f_Receipt_no=$objBaki_payment->maxRsl()."/".$objUtility->fYear($yr, $mn);
if ($_SESSION['update']==0)
{
$fyear=$objBaki_payment->fYear($d_Pay_date);
$objBaki_payment->setFyear($fyear);  
$Rsl=$objBaki_payment->maxRsl($fyear);
$objBaki_payment->setRsl($Rsl); 
//if (strtoupper($e_Payment_mode)=="CASH")
//$f_Receipt_no=$Rsl."/".$fyear;
}

if ($e_Payment_mode=="OTS")
{
if($c_Paid_today>0) //Add an extrat entry
{
 $objBp=new Baki_payment();  
 $objBp->setCase_id($a_Case_id);
 $objBp->setPayment_mode("Cash");   
 $objBp->setInstalment_no($b_Instalment_no+1);   
 $objBp->setRsl($Rsl+1); 
 $objBp->setPay_date($d_Pay_date);
 $objBp->setFyear($fyear); 
 $objBp->setPaid_today($c_Paid_today);
 $objBp->SaveRecord();
 $sql=$objBp->returnSql;
 $objUtility->saveSqlLog("Baki_payment",$sql);
} //$c_Paid_today
    
$c_Paid_today=0;
$h_Nextdate="NULL";
} //$e_Payment_mode=="OTS"

$objBaki_payment->setPaid_today($c_Paid_today);
$objBaki_payment->setNextdate($h_Nextdate);
$objBaki_payment->setReceipt_no($f_Receipt_no);

if ($_SESSION['update']==0)
{
$result=$objBaki_payment->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBaki_payment->returnSql;
$col=1;
$objUtility->Backup2Access("", $sql);
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
$objUtility->Backup2Access("", $sql);

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
//$mvalue[0]="0";//Case_id
// Call MaxInstalment_no() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Instalment_no
$mvalue[2]="0";
// Call MaxPay_date() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Pay_date
$mvalue[4]="NA";
// Call MaxReceipt_no() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Receipt_no
// Call MaxNextdate() Function Here if available in class or required and Load in $mvalue[6]
$mvalue[6]="";//Nextdate
//Succesfully update hence make an entry in sql log
$_SESSION['oldId']=$a_Case_id;
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
if ($col>0)
{    
//$objUtility->saveSqlLog("Baki_payment",$sql);
$objUtility->CreateLogFile("Baki_payment", $sql, 2, "M");
$objHis->setCase_id($a_Case_id);
$objHis->setRsl($objHis->maxRsl($a_Case_id));
$objHis->setDetail($objBaki_payment->updateList);
$objHis->SaveRecord();
}
//check if case is to be disposed
$objBm->setCase_id($a_Case_id);
//echo $objBaki_payment->BalanecAmount($a_Case_id);

if ($objBaki_payment->BalanecAmount($a_Case_id)==0 || ($e_Payment_mode=="OTS") )
{
$objBm->setDisposed("Y");
$objBm->setDisposed_date($d_Pay_date);
$objBm->setPayment_mode($e_Payment_mode);
$objBm->UpdateRecord();
$sql=$objBm->returnSql;
$objUtility->CreateLogFile("Bakijai_main", $sql, 2, "M");
//make an entry in hoistory table
$objHis->setCase_id($a_Case_id);
$objHis->setRsl($objHis->maxRsl($a_Case_id));
$objHis->setDetail("Disposed on ".$d_Pay_date);
$objHis->SaveRecord();
echo $objHis->returnSql;
$objBm->ExecuteQuery($sql2);
}    
else
{
$objBm->setDisposed("N");
$objBm->setDisposed_date("NULL"); 
$objBm->UpdateRecord();
}
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}

//update Old Amount as Installment 0
$objBm->setCase_id($a_Case_id);
if ($objBm->EditRecord())
$olddate=$objBm->getStart_date ();
else
$olddate="-";

$objBp=new Baki_payment();
$Oldamt=$_POST['Oldamt'];
$objBp->setCase_id($a_Case_id);    
$objBp->setInstalment_no("0");
if($objBp->EditRecord()) 
{
$objBp->setPaid_today($Oldamt);
$objBp->setPayment_mode("Cash");
$objBp->setPay_date($olddate); 
if ($Oldamt>0)
$objBp->UpdateRecord();
}
else
{
$objBp->setPaid_today($Oldamt);
$objBp->setPayment_mode("Cash");
$objBp->setPay_date($olddate);
if ($Oldamt>0)
$objBp->SaveRecord();
}
if ($Oldamt>0)
$objUtility->saveSqlLog("Baki_payment",$objBp->returnSql);

if ($col>0)
{
if (isset($_POST['CloseN'])) 
{
$objCD->setCase_id($a_Case_id);   
$objCD->setDay($_POST['Day']);
$objCD->setAppeared("Y");
$objCD->setAction_taken("Y");
$objCD->setAppeared_date($d_Pay_date);
$str="Amount Rs.".$c_Paid_today." paid on ".$d_Pay_date;
if (strlen($_POST['Rem'])>0)
$objCD->setNote_of_action($_POST['Rem']);
else
$objCD->setNote_of_action ($str);
$objCD->UpdateRecord();
}    //isset(closeN)
} //$col>0


header( 'Location: Form_baki_payment.php?tag=1');
?>
<a href=Form_baki_payment.php?tag=1>Back</a>
</body>
</html>
