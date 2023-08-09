<html>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';


$objCrpc_main=new Crpc_main();


$sql="SELECT CASE_YR ,CASE_NO  FROM CRPC_MAIN  order by case_yr,case_no";
$row=$objCrpc_main->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$caseyr=$row[$ii][0];
$caseno=$row[$ii][1];

$cond="CASE_YR=".$caseyr." and CASE_NO=".$caseno;
if($objCrpc_main->FetchColumn("crpc_party","case_no",$cond,"NA")=="NA")
echo $caseyr."- ".$caseno."<br>";

}


?>
</html>
