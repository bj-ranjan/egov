<html>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';

$objU=new Utility();

$code=$_POST['code'];
$no=$_POST['no'];

if($no==1)
$cond=" status='Running' ";

if($no==2)
$cond=" (status='Dropped'  or status='Disposed')";

if($no==3)
$cond=" 1=1 ";

$objCrpc_main=new Crpc_main();

$name=$objCrpc_main->FetchColumn("officer","officer_name","slno=".$code,"");


$Title="Case Register under ".$name;

$headList=array("Case ID/No","Case Date","Section","Subject","Remarks");
$align=array(1,1,2,1,2);
$valueList=array();
$objUtility=new Utility();

$sql="SELECT CASE_YR ,CASE_NO ,CASE_DATE ,SECTION ,SUBJECT ,OLD_CASENO ,STATUS ,DISPOSE_DATE FROM CRPC_MAIN WHERE  MAGISTRATE_CODE =".$code." and ".$cond." order by case_yr,case_no";
$row=$objCrpc_main->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$row[$ii][1]."/".$row[$ii][0]."<br>".$row[$ii][5];
$valueList[$ii][0]=$tvalue;
$tvalue=$objUtility->to_date($row[$ii][2]);
$valueList[$ii][1]=$tvalue;

$valueList[$ii][2]=$row[$ii][3];

$valueList[$ii][3]="<div align=justify>".$row[$ii][4]."</div>";

$valueList[$ii][4]=$row[$ii][6];

if($row[$ii][6]=="Disposed")
{
$valueList[$ii][4]="Disposed on <br>";
$valueList[$ii][4].=$objUtility->to_date($row[$ii][7]);
}
}

$objCrpc_main->genDataGridOnValueList($Title,$headList, $align, $valueList, 95,count($valueList));


?>
</html>
