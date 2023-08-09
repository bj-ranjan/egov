<html>
<title>Display userlog</title>
<HEAD>
 
</HEAD>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>
<?php
header('Refresh: 3;url=ListActiveUser.php');
session_start();
require_once './class/class.userlog.php';
require_once './class/class.dbmanager.php';
require_once './class/utility.class.php';

$Title="Active User List";
$headList=array("Uid","Date","Login Time","Login Upto","IP","Stop Delay","Cut");
$align=array(2,2,2,2,2,2);
$valueList=array();
$objUtility=new Utility();
$objUserlog=new Userlog();
$objDbm=new Dbmanager();
$cond="Uid<>'root' and Active='Y' and Log_date='".date('Y-m-d')."'";
$row=$objUserlog->getAllRecord($cond);
$t1=date('H:i:s');
//echo $t1;
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$row[$ii]['Uid'];
$url="<a href=Stop.php?uid=".$tvalue.">Stop</a>";
$valueList[$ii][0]=$tvalue;
$tvalue=$objUtility->to_date($row[$ii]['Log_date']);
$valueList[$ii][1]=$tvalue;
$tvalue=$row[$ii]['Log_time_in'];
$valueList[$ii][2]=$tvalue;
$tvalue=$row[$ii]['Log_time_out'];
$valueList[$ii][3]=$tvalue;
$t2=$tvalue;
$tvalue=$row[$ii]['Client_ip'];
$valueList[$ii][4]=$tvalue;
$valueList[$ii][5]=$objUtility->elapsedTimeMsg($t1, $t2);  //$objUserlog->elapsedTimeinSec($t1,$t2);
$valueList[$ii][6]=$url;
}

$objDbm->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));

?>
<a href=startmenu.php?tag=1>Menu</a>
</body>
</html>
