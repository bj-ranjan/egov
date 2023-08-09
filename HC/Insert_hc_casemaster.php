<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_casemaster.php';
require_once './class/class.hc_department.php';
require_once './class/class.hc_branch.php';
require_once './class/class.hc_casetransaction.php';

$objTrans=new Hc_casetransaction();


$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objHc_casemaster=new Hc_casemaster();
$Err="<font face=arial size=1 color=blue>";

//Start Validation //Serial

if (isset($_POST['Serial'])) //If HTML Field is Availbale
{
$a_Serial=$_POST['Serial'];
$mvalue[0]=$a_Serial;
if (!is_numeric($a_Serial))
$myTag++;
}
else //Post Data Not Available
$a_Serial="NULL";

if ($_SESSION['update']==0)
$a_Serial=$objHc_casemaster->maxSerial ();

//Start Validation //Case_no

if (isset($_POST['Case_no'])) //If HTML Field is Availbale
{
$b_Case_no=$_POST['Case_no'];
$mvalue[1]=$b_Case_no;
if ($objUtility->validate($b_Case_no,50)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Case_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-2";
}

if (strlen($b_Case_no)==0)
$myTag++;
}
else
$myTag++;
}
else //Post Data Not Available
$b_Case_no="NULL";


//Start Validation //Dep_code

if (isset($_POST['Dep_code'])) //If HTML Field is Availbale
{
$c_Dep_code=$_POST['Dep_code'];
$mvalue[2]=$c_Dep_code;
if (!is_numeric($c_Dep_code))
$myTag++;
}
else //Post Data Not Available
$c_Dep_code="NULL";


//Start Validation //Branch_code

if (isset($_POST['Branch_code'])) //If HTML Field is Availbale
{
$d_Branch_code=$_POST['Branch_code'];
$mvalue[3]=$d_Branch_code;
if (!is_numeric($d_Branch_code))
$myTag++;
}
else //Post Data Not Available
$d_Branch_code="NULL";


//Start Validation //Brief_history

if (isset($_POST['Brief_history'])) //If HTML Field is Availbale
{
$e_Brief_history=$_POST['Brief_history'];
$mvalue[4]=$e_Brief_history;
if ($objUtility->validate($e_Brief_history,500)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($e_Brief_history)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($e_Brief_history)==0)
$myTag++;
}
else
$myTag++;
}
else //Post Data Not Available
$e_Brief_history="NULL";


//Start Validation //Present_status

if (isset($_POST['Present_status'])) //If HTML Field is Availbale
{
$f_Present_status=$_POST['Present_status'];
$mvalue[5]=$f_Present_status;
if ($objUtility->validate($f_Present_status,200)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Present_status)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($f_Present_status)==0)
$myTag++;
}
else
$myTag++;
}
else //Post Data Not Available
$f_Present_status="NULL";


//Start Validation //File_no

if (isset($_POST['File_no'])) //If HTML Field is Availbale
{
$g_File_no=$_POST['File_no'];
$mvalue[6]=$g_File_no;
if ($objUtility->validate($g_File_no,100)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($g_File_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($g_File_no)==0)
{
$g_File_no="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$g_File_no="NULL";


//Start Validation //Due_dateparawise

if (isset($_POST['Due_dateparawise'])) //If HTML Field is Availbale
{
$h_Due_dateparawise=$_POST['Due_dateparawise'];
$mvalue[7]=$h_Due_dateparawise;
if ($objUtility->isdate($h_Due_dateparawise)==false)
$myTag++;
else
$h_Due_dateparawise=$objUtility->to_mysqldate($h_Due_dateparawise);
}
else //Post Data Not Available
$h_Due_dateparawise="NULL";


//Start Validation //Last_date

if (isset($_POST['Last_date'])) //If HTML Field is Availbale
{
$j_Last_date=$_POST['Last_date'];
$mvalue[8]=$j_Last_date;
if ($objUtility->isdate($j_Last_date)==false)
{
if (strlen($j_Last_date)==0)
{
$j_Last_date="NULL";
}
else
$myTag++;
}
else
$j_Last_date=$objUtility->to_mysqldate($j_Last_date);
}
else //Post Data Not Available
$j_Last_date="NULL";


//Start Validation //Signed_by

if (isset($_POST['Signed_by'])) //If HTML Field is Availbale
{
$k_Signed_by=$_POST['Signed_by'];
$mvalue[9]=$k_Signed_by;
if ($objUtility->validate($k_Signed_by,30)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($k_Signed_by)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-10";
}

if (strlen($k_Signed_by)==0)
{
$k_Signed_by="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$k_Signed_by="NULL";



$mmode="";
if ($myTag==0)
{
$objHc_casemaster->setSerial($a_Serial);
$objHc_casemaster->setCase_no($b_Case_no);
$objHc_casemaster->setDep_code($c_Dep_code);
$objHc_casemaster->setBranch_code($d_Branch_code);
$objHc_casemaster->setBrief_history($e_Brief_history);
$objHc_casemaster->setPresent_status($f_Present_status);
$objHc_casemaster->setFile_no($g_File_no);
$objHc_casemaster->setDue_dateparawise($h_Due_dateparawise);
$objHc_casemaster->setLast_date($j_Last_date);
$objHc_casemaster->setSigned_by($k_Signed_by);
if ($_SESSION['update']==0)
{
$result=$objHc_casemaster->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objHc_casemaster->returnSql;
$col=1;
}
else
{
$result=$objHc_casemaster->UpdateRecord();
$col=$objHc_casemaster->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objHc_casemaster->returnSql;
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
 //   'Update Transaction Table'

$objTrans->setCase_id($mvalue[0]);
$objTrans->setSubmit_date($j_Last_date);
$objTrans->setNextdue_date($h_Due_dateparawise);
$objTrans->setSigned_by($k_Signed_by) ;
$objTrans->setPresent_status($f_Present_status);

if ($_SESSION['update']==0)
{
$objTrans->setRsl($objTrans->maxRsl($mvalue[0]));
$objTrans->SaveRecord();    
}
else
{
$objTrans->setRsl("1");
$objTrans->UpdateRecord();    
}
//Clear the Required Field back to Entry Form
// Call MaxSerial() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Serial
// Call MaxCase_no() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Case_no
// Call MaxDep_code() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Dep_code
// Call MaxBranch_code() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Branch_code
// Call MaxBrief_history() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//Brief_history
// Call MaxPresent_status() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Present_status
// Call MaxFile_no() Function Here if available in class or required and Load in $mvalue[6]
$mvalue[6]="";//File_no
// Call MaxDue_dateparawise() Function Here if available in class or required and Load in $mvalue[7]
$mvalue[7]="";//Due_dateparawise
// Call MaxLast_date() Function Here if available in class or required and Load in $mvalue[8]
$mvalue[8]="";//Last_date
// Call MaxSigned_by() Function Here if available in class or required and Load in $mvalue[9]
$mvalue[9]="";//Signed_by
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Hc_casemaster",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}
header( 'Location: Form_hc_casemaster.php?tag=1');
?>
<a href=Form_hc_casemaster.php?tag=1>Back</a>
</body>
</html>
