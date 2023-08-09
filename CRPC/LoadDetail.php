<html>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';

$objU=new Utility();

$yr=$_POST['yr'];
$no=$_POST['no'];

$objCrpc_main=new Crpc_main();
$objCrpc_main->setCase_yr($yr);
$objCrpc_main->setCase_no($no);

echo "<font face=arial size=2 color=red>";
if($objCrpc_main->EditRecord())
echo "Subject:-".$objCrpc_main->getSubject();
echo "</font>";
$Title="Party Detail";

$headList=array("Name","Father","Remarks");
$align=array(1,1,2,2,2);
$valueList=array();
$objUtility=new Utility();

$sql="select name,father,category from crpc_party where case_yr=".$yr." and case_no=".$no." order by category,rsl";
$row=$objCrpc_main->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$row[$ii][0];
$valueList[$ii][0]=$tvalue;
$tvalue=$row[$ii][1];
$valueList[$ii][1]=$tvalue;
if($row[$ii][2]==1)
$valueList[$ii][2]="First Party";
else
$valueList[$ii][2]="Opposite Party";
}

$objCrpc_main->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));

//Last Proceeding

$Title="Last Proceeding Detaila";

$headList=array("Date","Order","By Magistrate");
$align=array(2,1,2);
$valueList=array();
$objUtility=new Utility();

$sql="SELECT PROC_DATE ,ORDER_DETAIL ,BY_MAGISTRATE FROM CRPC_PROCEEDING where case_yr=".$yr." and case_no=".$no." order by rsl";
$row=$objCrpc_main->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$objU->to_date($row[$ii][0]);
$valueList[$ii][0]=$tvalue;
$tvalue=$row[$ii][1];
$valueList[$ii][1]="<div align=justify><i>".$tvalue."<i></div>";
$off=$objCrpc_main->FetchColumn("officer","Officer_name","slno=".$row[$ii][2],"");
$valueList[$ii][2]=$off;
}

$objCrpc_main->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));


?>
</html>
