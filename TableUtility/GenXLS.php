

<body>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require_once '../class/class.config.php';
require_once '../class/utility.class.php';
require_once '../class/class.Dbmanager.php';
$objUtility=new Utility();

$objc=new Config();

$objC=new Dbmanager();

//Start Verify
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: ../Mainmenu.php?unauth=1');

if(isset($_POST['sql']))
$mstr=$_POST['sql'];
else
$mstr="";

//echo "Posted string".$mstr1."<br>";

$mstr=trim($mstr);

$j=strtoupper(ltrim($mstr));
$res=false;

if ($objC->inStr($j,"SELECT ")==0)
$FirstSelect=true;
else
$FirstSelect=false;

$align=array();
if ($FirstSelect==true)
{
$sql=$j;
if($objC->ExecuteQuery($sql))
{    
$headlist=$objC->RetriveField($sql);
$objC->genExcelFileBySql($headlist, $align, $sql,"../log/Temp");
}
}
?>
<a href="../log/Temp.Xls" target="_blank">Download XLS File</a>
</body>


