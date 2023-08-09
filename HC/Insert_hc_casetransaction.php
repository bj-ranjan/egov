<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_casetransaction.php';
require_once './class/class.hc_casemaster.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objHc_casetransaction=new Hc_casetransaction();
$Err="<font face=arial size=1 color=blue>";
$objHm=new Hc_casemaster();
//Start Validation //Case_id

if (isset($_POST['Case_id'])) //If HTML Field is Availbale
{
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;
}
else //Post Data Not Available
$a_Case_id="NULL";


//Start Validation //Rsl

//if (isset($_POST['Rsl'])) //If HTML Field is Availbale
//{
//$b_Rsl=$_POST['Rsl'];
//$mvalue[1]=$b_Rsl;
//if (!is_numeric($b_Rsl))
//$myTag++;
//}
//else //Post Data Not Available
$b_Rsl=$objHc_casetransaction->maxRsl($a_Case_id);


//Start Validation //Submit_date

if (isset($_POST['Submit_date'])) //If HTML Field is Availbale
{
$c_Submit_date=$_POST['Submit_date'];
$mvalue[2]=$c_Submit_date;
if ($objUtility->isdate($c_Submit_date)==false)
$myTag++;
else
$c_Submit_date=$objUtility->to_mysqldate($c_Submit_date);
}
else //Post Data Not Available
$c_Submit_date="NULL";


//Start Validation //Signed_by

if (isset($_POST['Signed_by'])) //If HTML Field is Availbale
{
$d_Signed_by=$_POST['Signed_by'];
$mvalue[3]=$d_Signed_by;
if ($objUtility->validate($d_Signed_by,30)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($d_Signed_by)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-4";
}

if (strlen($d_Signed_by)==0)
$myTag++;
}
else
$myTag++;
}
else //Post Data Not Available
$d_Signed_by="NULL";

//Start Validation //Nextdue_date

if (isset($_POST['Closed']))
$g_Closed="Y";
else
$g_Closed="N";  

if (isset($_POST['Nextdue_date'])) //If HTML Field is Availbale
{
$e_Nextdue_date=$_POST['Nextdue_date'];
$mvalue[4]=$e_Nextdue_date;
if ($objUtility->isdate($e_Nextdue_date)==false && $g_Closed=="N" )
$myTag++;
else
$e_Nextdue_date=$objUtility->to_mysqldate($e_Nextdue_date);
}
else //Post Data Not Available
$e_Nextdue_date="NULL";


if (isset($_POST['Present_status'])) //If HTML Field is Availbale
$f_Present_status=$_POST['Present_status'];
else
$f_Present_status="NULL";    

 

$mmode="";
if ($myTag==0)
{
$objHc_casetransaction->setCase_id($a_Case_id);
$objHc_casetransaction->setRsl($b_Rsl);
$objHc_casetransaction->setSubmit_date($c_Submit_date);
$objHc_casetransaction->setSigned_by($d_Signed_by);
if($g_Closed=="N")
$objHc_casetransaction->setNextdue_date($e_Nextdue_date);
$objHc_casetransaction->setPresent_status($f_Present_status);
$result=$objHc_casetransaction->SaveRecord();
$mmode="Data Entered Successfully";
$sql=$objHc_casetransaction->returnSql;
$col=1;
if (!$result)
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
}
else
{
$objHm->setSerial($a_Case_id);
$objHm->setPresent_status($f_Present_status);
if($g_Closed=="N")
$objHm->setDue_dateparawise($e_Nextdue_date);
if($g_Closed=="Y")
$objHm->setClosed("Y");    
$objHm->UpdateRecord();    
//Clear the Required Field back to Entry Form
// Call MaxCase_id() Function Here if available in class or required and Load in $mvalue[0]
//$mvalue[0]="";//Case_id
// Call MaxRsl() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Rsl
// Call MaxSubmit_date() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Submit_date
// Call MaxSigned_by() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Signed_by
// Call MaxNextdue_date() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//Nextdue_date
// Call MaxEntry_date() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Entry_date
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->saveSqlLog("Hc_casetransaction",$sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$sql;
}
header( 'Location: Form_hc_casetransaction.php?tag=1');

?>
<a href=Form_hc_casetransaction.php?tag=1>Back</a>
</body>
</html>
