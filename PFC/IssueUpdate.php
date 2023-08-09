<html>
<head>
<title>Update Issue</title>
</head>
<script language=javascript>
<!--
function direct()
{
var i;
i=0;
}

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Code.focus();
}

function redirect(i)
{
}


function back()
{
window.location="Issue.php?tag=1";
}
function home()
{
window.location="Mainmenu.php?tag=1";
}


//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
//require_once '../xohari/class/Class.request_status.php';

require_once './class/class.petition_master.php';
require_once '../class/Class.officer.php';
require_once '../class/utility.class.php';
$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 9)==false) //9 for issue Certificate ALL
header( 'Location: Mainmenu.php?unauth=1');



if (!isset($_SESSION['Applicant']))
$_SESSION['Applicant']="Applicant";
else
$_SESSION['Applicant']="";    

if (isset($_SESSION['username']))
$username=$_SESSION['username'];
else 
$username="";

$mvalue=array();
if (isset($_POST['Pet_yr']))
$a=$_POST['Pet_yr'];
else
$a=0;
$mvalue[0]=$a;

if (isset($_POST['Pet_no']))
$b=$_POST['Pet_no'];
else
$b=0;
$mvalue[1]=$b;

if (isset($_POST['O_code']))
$ocode=$_POST['O_code'];
else
$ocode=0;
$mvalue[2]=$ocode;

if (isset($_POST['Fees']))
$fees=$_POST['Fees'];
else
$fees=0;

$_SESSION['mvalue']=$mvalue;

$objPm=new Petition_master();
$objPm->setPet_yr($a);
$objPm->setPet_no($b);
$objPm->setFees($fees);
$objO=new Officer();
$objO->setSlno($ocode);

if ($objO->EditRecord())
$objPm->setBo_name($objO->getOfficer_name());

$objPm->setStatus("Issued");
$objPm->setIssue_date(date('Y-m-d'));
$objPm->setIssued_by($username);

if ($objPm->UpdateRecord()) //Success in Petition MAster
{   
$sql1=$objPm->returnSql;    
if ($objPm->EditRecord())
$xid=$objPm->getXohari_requestid(); 
else
$xid="";

//$objR=new Request_status();
//$objR->setRequest_id($xid);
//$objR->setStatus_id("4"); //4 for issued/Delivered
//if ($objR->Available()==false && strlen($xid)>2)
//{
//$objR->setDate(date('Y-m-d'));
//$objR->setUpdated_by("admin");
//$objR->setId($objR->maxId());
//$objR->setRemark("Updated through PFC Counter by ".$username);
//if ($objR->SaveRecord())
//{
//$line=$objR->returnSql;
//$objUtility->saveSqlLog("Service_request", $line);
//}
//} //$objR->Available
//$objUtility->saveSqlLog("Petition_master", $sql1);
$objUtility->CreateLogFile("Petition_master", $sql1, 2, "M");

$objUtility->Backup2Access("", $sql1);
}//$objPm->UpdateRecord
else
header('Location:Issue.php?tag=0');
//Start of FormDesign
?>
<table border=1 cellpadding=4 cellspacing=0 align=center style=border-collapse: collapse; width=80%>
<form name=myform action=""  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font color="#9900FF" size="4">&nbsp;&nbsp;
<b>Successfully Issued Petition </b></td</tr>
<tr>
<td align=right bgcolor=#FFFFCC >
<input type=button value="Issue Another"  name=back1 onclick=back()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#FF9966;color:black;width:180px">
</td><td  bgcolor=#FFFFCC align="left">
<input type=button value="Back to Menu"  name=back1 onclick=home()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:red;color:black;width:180px">
</td></tr>
</table>
</form>
</body>
</html>
