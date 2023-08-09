<html>
<title></title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>


<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.village.php';
$objUtility=new Utility();
$objBakijai_main=new Bakijai_main();
$row=$objBakijai_main->getAllRecord();
echo count($row);
$objVillage=new Village();
for($ii=0;$ii<count($row);$ii++)
{

$id=$row[$ii]['Case_id'];
$tvalue=$row[$ii]['Village'];

$objVillage->setCondString(" Vill_name='".$tvalue."'");
$row2=$objVillage->getTopRecord(1);

if (isset($row2[0]['Vill_code']))
{
$vcode=$row2[0]['Vill_code'];
$sql="update bakijai_main set vill_code=".$vcode." where case_id=".$id;
$objVillage->ExecuteQuery($sql);
//echo $sql;
}
else
echo $id.".".$tvalue."<br>";
}
?>


<a href=mainmenu.php?tag=1>Menu</a>
</body>
</html>
