<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 12)==false) //12 for Eroll Certificate 
header( 'Location: Mainmenu.php?unauth=1');


$objPetition_master=new Petition_master();
$Err="<font face=arial size=1 color=blue>";


//Start Validation //Pet_yr

if (isset($_POST['Pet_yr'])) //If HTML Field is Availbale
{
$_Pet_yr=trim($_POST['Pet_yr']);
$mvalue[0]=$_Pet_yr;
if ($objUtility->SimpleValidate($_Pet_yr,4)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Pet_yr)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-1";
}

if (strlen($_Pet_yr)==0)
$myTag++;
}
else
{
$myTag++;
echo "Pet_yr Error<br>";
}
}
else //Post Data Not Available
$_Pet_yr="NULL";


//Start Validation //Pet_no

if (isset($_POST['Pet_no'])) //If HTML Field is Availbale
{
$_Pet_no=trim($_POST['Pet_no']);
$mvalue[1]=$_Pet_no;
if (!is_numeric($_Pet_no))
{
$myTag++;
echo "Pet_no Error<br>";
}
}
else //Post Data Not Available
$_Pet_no="NULL";


//Start Validation //Ast



//Start Validation //Rejected_reason

if (isset($_POST['Reason'])) //If HTML Field is Availbale
{
$_Rejected_reason=trim($_POST['Reason']);
$mvalue[6]=$_Rejected_reason;
if ($objUtility->SimpleValidate($_Rejected_reason,100)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Rejected_reason)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($_Rejected_reason)==0)
{
$_Rejected_reason="NULL";
}
}
else
{
$myTag++;
echo "Rejected_reason Error<br>";
}
}
else //Post Data Not Available
$_Rejected_reason="NULL";

$msg="";

$mmode="";
if ($myTag>0) //Validation Fails
{
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
$msg="Validation Error";
}


if ($myTag==0) //Validation OK
{
$objPetition_master->setPet_yr($_Pet_yr);
$objPetition_master->setPet_no($_Pet_no);
$objPetition_master->setAst("Y");
$objPetition_master->setProcess_date(date('Y-m-d'));
if (isset($_SESSION['username']))
$objPetition_master->setProcessed_by($_SESSION['username']);
$objPetition_master->setStatus("Rejected");
$objPetition_master->setRejected_reason($_Rejected_reason);

if ($objPetition_master->UpdateRecord())
{
//Clear the Required Field back to Entry Form
$mvalue[0]="";//Pet_yr
$mvalue[1]="";//Pet_no
$mvalue[2]="";//Ast
$mvalue[3]="";//Process_date
$mvalue[4]="";//Processed_by
$mvalue[5]="";//Status
$mvalue[6]="";//Rejected_reason
$msg="Succesfully Rejected";
}
else
$msg="Failed";
}//mytag=0
$objUtility->CreateLogFile("Petition_master", $objPetition_master->returnSql, 2, "M");

echo $objUtility->AlertNRedirect($msg, "RejectEroll.php?tag=1");
?>
</body>
</html>
