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
window.location="vermenu.php?tag=1";
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

$Title="Register for Character and Antecedant";
$headList=array("Id","Name & Address","Receipt Detail","Sent to SP","Receipt from DGP","Issue Detail");
$align=array(2,1,1,1,1,1,2,2,2,2,2,2);
$valueList=array();
$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();

$objVerification=new Verification();
$cond="verification_type=1 order by id ";
$row=$objVerification->getAllRecord($cond);
for($ii=0;$ii<count($row);$ii++)
{
$tvalue=$row[$ii]['Id'];
$valueList[$ii][0]=$tvalue;
$tvalue=$row[$ii]['Name']."<br>".strtolower($row[$ii]['Reln'])." ".$row[$ii]['Rel_name'];
$tvalue.="<br>Village-".$row[$ii]['Village'];
$valueList[$ii][1]=$tvalue;

$tvalue=$row[$ii]['Department']."<br>Letter No-".$row[$ii]['Letter_no'];
$tvalue.=" dated ".$objUtility->to_date($row[$ii]['Letter_date']);
$valueList[$ii][2]=$tvalue;

$tvalue=$row[$ii]['Letter_no_sent'];
echo "tvalue-".$tvalue;
if(strlen($tvalue)==0)
$tvalue="0";
echo "tvalue-".$tvalue."<br>";

$tvalue=$objVerification->FetchColumn("verification_letter", "letter_no", "id=".$tvalue, "0");
$dt=$objVerification->FetchColumn("verification_letter", "letter_date", "id=".$tvalue, $row[$ii]['Start_date']);
$dt=$objUtility->to_date($dt);
if($tvalue==0)
$tvalue="";
$valueList[$ii][3]=$tvalue." dated ".$dt;


if($row[$ii]['Pol_status']=="Disposed")
{
$tvalue=$row[$ii]['Pol_letter_no'];
$valueList[$ii][4]=$tvalue;
$tvalue=$objUtility->to_date($row[$ii]['Pol_letter_date']);
$valueList[$ii][4].=" dated ".$tvalue;
$tvalue=$row[$ii]['Report_type'];
$valueList[$ii][4].="<br>".$tvalue;
}
else
$valueList[$ii][4]=$row[$ii]['Pol_status'];

if($row[$ii]['Dc_status']=="Disposed")
{
$tvalue=$row[$ii]['Issue_no'];
$valueList[$ii][5]=$tvalue;
$tvalue=$objUtility->to_date($row[$ii]['Issue_date']);
$valueList[$ii][5].=" dated ".$tvalue;
}
else
$valueList[$ii][5]=$row[$ii]['Dc_status'];
}

$objVerification->genDataGridOnValueList($Title,$headList, $align, $valueList, 100,count($valueList));

?>
<a href=mainmenu.php?tag=1>Menu</a>
</body>
</html>
