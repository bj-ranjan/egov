<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
require_once './class/class.baki_payment.php';
require_once './class/class.update_history.php';

$objHis=new Update_history();


$objCaseD=new Baki_payment();

$objV=new Village();

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBakijai_main=new Bakijai_main();
$Err="<font face=arial size=1 color=blue>";
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
$b_Start_date=$_POST['Start_date'];
$mvalue[1]=$b_Start_date;
if ($objUtility->isdate($b_Start_date)==false)
$myTag++;
else
$b_Start_date=$objUtility->to_mysqldate($b_Start_date);

$c_Case_no=$_POST['Case_no'];
$mvalue[2]=$c_Case_no;
if ($objUtility->validate($c_Case_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($c_Case_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-3";
}

if (strlen($c_Case_no)==0)
$myTag++;
}
else
$myTag++;

//$d_Fin_yr=$_POST['Fin_yr'];
$yr=substr($b_Start_date,0,4);
$mn=substr($b_Start_date,5,2);
$d_Fin_yr=$objUtility->fYear($yr, $mn);

$mvalue[3]=$d_Fin_yr;
if ($objUtility->validate($d_Fin_yr)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($d_Fin_yr)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-4";
}

if (strlen($d_Fin_yr)==0)
{
$d_Fin_yr="NULL";
}
}
else
$myTag++;
$e_Bank=$_POST['Bank'];
$mvalue[4]=$e_Bank;
if ($objUtility->validate($e_Bank)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($e_Bank)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($e_Bank)==0)
$myTag++;
}
else
$myTag++;
$f_Branch=$_POST['Branch'];
$mvalue[5]=$f_Branch;
if ($objUtility->validate($f_Branch)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Branch)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($f_Branch)==0)
$myTag++;
}
else
$myTag++;
$g_Full_name=$_POST['Full_name'];
$mvalue[6]=$g_Full_name;
if ($objUtility->validate($g_Full_name)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($g_Full_name)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($g_Full_name)==0)
$myTag++;
}
else
$myTag++;
$h_Full_name_ass=$_POST['Full_name_ass'];
$mvalue[7]=$h_Full_name_ass;
if ($objUtility->validate($h_Full_name_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($h_Full_name_ass)==false)
{
$myTag++;
$Err=$Err." Expect Unicode in Field-8";
}

if (strlen($h_Full_name_ass)==0)
{
$h_Full_name_ass="NULL";
}
}
else
$myTag++;
$i_Father=$_POST['Father'];
$mvalue[8]=$i_Father;
if ($objUtility->validate($i_Father)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($i_Father)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-9";
}

if (strlen($i_Father)==0)
$myTag++;
}
else
$myTag++;
$j_Father_ass=$_POST['Father_ass'];
$mvalue[9]=$j_Father_ass;
if ($objUtility->validate($j_Father_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($j_Father_ass)==false)
{
$myTag++;
$Err=$Err." Expect Unicode in Field-10";
}

if (strlen($j_Father_ass)==0)
{
$j_Father_ass="NULL";
}
}
else
$myTag++;
$l_Polst_code=$_POST['Polst_code'];
$mvalue[10]=$l_Polst_code;
if (!is_numeric($l_Polst_code))
$myTag++;
$m_Circle=$_POST['Circle'];
$mvalue[11]=$m_Circle;
if (!is_numeric($m_Circle))
$myTag++;
$n_Mouza=$_POST['Mouza'];
$mvalue[12]=$n_Mouza;
if (!is_numeric($n_Mouza))
$myTag++;
$o_Vill_code=$_POST['Vill_code'];
$mvalue[13]=$o_Vill_code;
if (!is_numeric($o_Vill_code))
$myTag++;
$q_Amount=$_POST['Amount'];
$mvalue[14]=$q_Amount;
if (!is_numeric($q_Amount))
$myTag++;
$r_Balance=$_POST['Balance'];
//$r_Balance=$q_Amount;
$mvalue[15]=$r_Balance;
if (is_numeric($r_Balance)==false)
{
$r_Balance="NULL";
}
$z_Req_letter_no=$_POST['Req_letter_no'];
$mvalue[16]=$z_Req_letter_no;
if ($objUtility->validate($z_Req_letter_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($z_Req_letter_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-17";
}

if (strlen($z_Req_letter_no)==0)
{
$z_Req_letter_no="NULL";
}
}
else
$myTag++;
$aa_Req_letter_date=$_POST['Req_letter_date'];
$mvalue[17]=$aa_Req_letter_date;
if ($objUtility->isdate($aa_Req_letter_date)==false)
{
if (strlen($aa_Req_letter_date)==0)
{
$aa_Req_letter_date="NULL";
}
else
$myTag++;
}
else
$aa_Req_letter_date=$objUtility->to_mysqldate($aa_Req_letter_date);

$nextdate=$_POST['Nextdate'];
$ndate=$nextdate;
$mvalue[3]=$nextdate;
if ($objUtility->isdate($nextdate)==true)
$nextdate=$objUtility->to_mysqldate($nextdate);



$mmode="";
$_SESSION['mymsg']="";
$_SESSION['oldId']=$a_Case_id;

if ($myTag==0)
{
$objBakijai_main->setCase_id($a_Case_id);
$objBakijai_main->setStart_date($b_Start_date);
$objBakijai_main->setCase_no($c_Case_no);
$objBakijai_main->setFin_yr($d_Fin_yr);
$objBakijai_main->setBank($e_Bank);
$objBakijai_main->setBranch($f_Branch);
$objBakijai_main->setFull_name($g_Full_name);
$objBakijai_main->setFull_name_ass($h_Full_name_ass);
$objBakijai_main->setFather($i_Father);
$objBakijai_main->setFather_ass($j_Father_ass);
$objBakijai_main->setPolst_code($l_Polst_code);
$objBakijai_main->setCircle($m_Circle);
$objBakijai_main->setMouza($n_Mouza);
$objBakijai_main->setVill_code($o_Vill_code);

if(isset($_POST['Remarks']))
{
$objBakijai_main->setRemarks($_POST['Remarks'])    ;
}

$objV->setVill_code($o_Vill_code);
if ($objV->EditRecord())
$objBakijai_main->setVillage($objV->getVill_name());
$objBakijai_main->setAmount($q_Amount);
//$objBakijai_main->setBalance($r_Balance);
$objBakijai_main->setReq_letter_no($z_Req_letter_no);
$objBakijai_main->setReq_letter_date($aa_Req_letter_date);
//set update history
$objHis->setCase_id($a_Case_id);
$objHis->setRsl($objHis->maxRsl($a_Case_id));

if ($_SESSION['update']==0)
{
$result=$objBakijai_main->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objBakijai_main->returnSql;
$col=1;
$objHis->setDetail($objBakijai_main->updateList." Next Date-".$nextdate); //update history
}
else
{
$result=$objBakijai_main->UpdateRecord();
$objHis->setDetail($objBakijai_main->updateList." Next Date-".$nextdate); //update history
$col=$objBakijai_main->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objBakijai_main->returnSql;
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
//Update next date in CaseDate Table
$objCaseD->setCase_id($a_Case_id);
$objCaseD->setInstalment_no("0");
$objCaseD->setPay_date($b_Start_date);
if ($objCaseD->EditRecord()==false)
{ 
$objCaseD->setNextdate($nextdate);    
$objCaseD->setPaid_today($r_Balance);
$objCaseD->setRsl($objCaseD->maxRSl());
$objCaseD->SaveRecord();
}
else
{    
$objCaseD->setNextdate($nextdate);
$objCaseD->setPaid_today($r_Balance);
$objCaseD->UpdateRecord();  
}

//Clear the Required Field back to Entry Form
// Call MaxCase_id() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Case_id
// Call MaxStart_date() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Start_date
// Call MaxCase_no() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Case_no
// Call MaxFin_yr() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Fin_yr
// Call MaxBank() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//Bank
// Call MaxBranch() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Branch
// Call MaxFull_name() Function Here if available in class or required and Load in $mvalue[6]
$mvalue[6]="";//Full_name
// Call MaxFull_name_ass() Function Here if available in class or required and Load in $mvalue[7]
$mvalue[7]="";//Full_name_ass
// Call MaxFather() Function Here if available in class or required and Load in $mvalue[8]
$mvalue[8]="";//Father
// Call MaxFather_ass() Function Here if available in class or required and Load in $mvalue[9]
$mvalue[9]="";//Father_ass
// Call MaxPolst_code() Function Here if available in class or required and Load in $mvalue[10]
$mvalue[10]="-1";//Polst_code
// Call MaxCircle() Function Here if available in class or required and Load in $mvalue[11]
$mvalue[11]="-1";//Circle
// Call MaxMouza() Function Here if available in class or required and Load in $mvalue[12]
$mvalue[12]="-1";//Mouza
// Call MaxVill_code() Function Here if available in class or required and Load in $mvalue[13]
$mvalue[13]="-1";//Vill_code
// Call MaxAmount() Function Here if available in class or required and Load in $mvalue[14]
$mvalue[14]="";//Amount
// Call MaxBalance() Function Here if available in class or required and Load in $mvalue[15]
$mvalue[15]="";//Balance
// Call MaxReq_letter_no() Function Here if available in class or required and Load in $mvalue[16]
$mvalue[16]="";//Req_letter_no
// Call MaxReq_letter_date() Function Here if available in class or required and Load in $mvalue[17]
$mvalue[17]="";//Req_letter_date
$mvalue[19]="";//Req_letter_date
//Succesfully update hence make an entry in sql log
if ($col>0)
{    
$objUtility->CreateLogFile("Bakijai_Main", $sql, 2, "M");
//$objUtility->saveSqlLog("Bakijai_main",$sql);
$objUtility->Backup2Access("", $sql);
if ($_SESSION['update']==0)
$_SESSION['mymsg']="Case Registered,ID is ".$_SESSION['oldId']." Click on Generate Notice Link"; 
else
$_SESSION['mymsg']="Updated ";    
}
else
$_SESSION['mymsg']="";

$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
$objHis->SaveRecord(); //save a history
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}

if($objCaseD->colUpdated>0)
{    
//$objUtility->saveSqlLog("Baki_Payment",$objCaseD->returnSql);
$objUtility->CreateLogFile("Baki_Payment", $objCaseD->returnSql, 2, "M");
 

}
echo $objBakijai_main->updateList;

header( 'Location: Form_bakijai_main.php?tag=1&mtype=100');

?>
<a href=Form_bakijai_main.php?tag=1>Back</a>
</body>
</html>
