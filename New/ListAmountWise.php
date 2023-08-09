<?php
session_start();
require_once 'class/class.adjust.php';

$objTab = new Adjust();
$today = date('Y-m-d');
$amt1=isset($_POST['amount1'])?$_POST['amount1']:'';
$amt2=isset($_POST['amount2'])?$_POST['amount2']:'';

?>
<body>
<link href="./class/table.css" rel="stylesheet"/>
<table border=1 width='100%' align='center' cellpadding=3>
<form name='myform' method=post action='ListAmountWise.php'>
<?php
echo "<tr><td>Enter Amount1</td><td>";
$objTab->genInputBox("amount1",$amt1,10,0,'', '', 12,'',0);
echo "</td>";
echo "<td>Enter Amount2</td><td>";
$objTab->genInputBox("amount2",$amt2,10,0,'', '', 12,'',0);
echo "</td>";
echo "<td>";
$objTab->genCSSButton("id1","Show",90 ,2,12,2," onclick=submit()");
echo "</td></tr>";
?>
</form>
</table>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && (!is_numeric($amt1) || !is_numeric($amt2)))
{
echo "Invalid Amount";
exit;
}


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
echo "<hr>";
exit;
}

$sql = "Select  case_id,  bank, branch, full_name, amount,reason  from bakijai_main where disposed='N' and amount between ".$amt1." and ".$amt2."  order by amount ";
$row = $objTab->FetchRecords($sql);
$List = array();
$previd = 0;
$ind = 0;


for ($i = 0; $i < count($row); $i++) {
$cid=$row[$i][0];;
$sql = "Select  pay_date,nextdate from  baki_payment where case_id=".$cid."  order by nextdate desc limit 1";
$row1 = $objTab->FetchRecords($sql);   
	//if(count($row1)>0 &&  $row1[0][1]>= $today){
        $List[$ind][0] = $row[$i][0];
        $caseid= $row[$i][0];
        $List[$ind][1] = $row[$i][1];
        $List[$ind][2] = $row[$i][2];
        $List[$ind][3] = $row[$i][3];
        $List[$ind][4] = $row[$i][4];
        $dt = $row1[0][0];
        $List[$ind][5] = $objTab->Sum("baki_payment", "paid_today", "case_id=".$caseid);
        $List[$ind][6] = $List[$ind][4]-$List[$ind][5];
        $List[$ind][7] = substr($dt, 8, 2) . "/" . substr($dt, 5, 2) . "/" . substr($dt, 0, 4);
	//$List[$ind][7] =$row[$i][5];
        $ind++;
   // }
    
}


$objTab->genDataGridOnValueList("List of Defaulter between Rs.".$amt1." and Rs.".$amt2."[Total Case:".count($List)."]", $headlist = array("Case ID", "Bank", "Branch", "Name of Defaulter", "Amount of Loan","Amount Received","Balance", "Last Paid Date"), $align = array(2, 1, 1, 1, 3, 3,3,2), $List, 100, count($List));
?>
</body>