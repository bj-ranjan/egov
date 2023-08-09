<html>
<title>Display verification</title>
<HEAD>
  <STYLE type=text/css>
    @media screen{
       thead{display:table-header-group}
       }
   @media print{
       thead{display:table-header-group}
      body{margin-top:0.5 cm;margin-left:1.5 cm;margin-right:1 cm;margin-bottom:1}
      tfoot{display:none}
   }
 </STYLE>
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
session_start();
require_once '../class/utility.class.php';
require_once './class/class.verification.php';
?>

<?php
//$Para=<<<EOD
//<div align="justify" style="line-height:2">
//&nbsp;&nbsp;This is a sample justified Para.
//</div>
//EOD;

$Title="Report Pending with DC Office after receiving from IGP(SB)/Circle Officer";
$headList=array("ID","Letter No & Date","Department","Candidate Name","Police Station","Receipt on","Pending For(Days)");
$align=array(2,1,1,1,1,2,2,2);
$valueList=array();
$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
$objVerification=new Verification();
$cond="Pol_status='Disposed' and dc_status='Pending'";
$row=$objVerification->getAllRecord($cond);
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$row[$ii]['Id'];
$valueList[$ii][0]=$tvalue;
$tvalue=$row[$ii]['Letter_no'];
$valueList[$ii][1]=$tvalue;
$tvalue=$objUtility->to_date($row[$ii]['Letter_date']);
$valueList[$ii][1].="<br>Dated ".$tvalue;

$tvalue=$row[$ii]['Department']."<br>".$row[$ii]['Address']."<br>Pin-".$row[$ii]['Pin'];
$valueList[$ii][2]=$tvalue;

$tvalue=$row[$ii]['Name']."<br>".strtolower($row[$ii]['Reln'])."- ".$row[$ii]['Rel_name']."<br>Vill-".$row[$ii]['Village'];
$valueList[$ii][3]=$tvalue;
if($row[$ii]['Pol_stn']>0) {
$cond="Code='".$row[$ii]['Pol_stn']."'";
$tvalue=$objVerification->FetchColumn("police_station","Name", $cond,"");
}
else
$tvalue=$row[$ii]['Ps'];

$valueList[$ii][4]=$tvalue;

$tvalue=$objUtility->to_date($row[$ii]['Pol_letter_date']);
$valueList[$ii][5]=$tvalue;

$valueList[$ii][6]=$objUtility->dateDiff(date('Y-m-d'),$row[$ii]['Pol_letter_date']);

}

$objVerification->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));

?>
<a href=vermenu.php?tag=1>Menu</a>
</body>
</html>
