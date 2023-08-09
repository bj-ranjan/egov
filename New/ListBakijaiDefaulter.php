<?php

//header("content-Type:application/json; charset=UTF-8");
//header('Access-Control-Allow-Origin:*');
//header('Content-Type:application/javascript;charset=UTF-8');
//header('Content-Type:application/javascript;charset=UTF-8');

session_start();
require_once 'class/class.adjust.php';

$objTab = new Adjust();
$today = date('Y-m-d');
//$sql = "Select  bm.case_id,  bm.bank, bm.branch, bm.full_name, bm.amount, bp.nextdate,bp.instalment_no from bakijai_main bm inner join baki_payment bp on bm.case_id=bp.case_id and bm.disposed='N' and bp.nextdate<'" . $today . "' order by bm.bank,bm.branch,bm.case_id";


$sql = "Select  case_id,  bank, branch, full_name, amount  from bakijai_main where disposed='N'  order by bank,branch,case_id";
$row = $objTab->FetchRecords($sql);
$List = array();
$previd = 0;
$ind = 0;



for ($i = 0; $i < count($row); $i++) {
$cid=$row[$i][0];;
$sql = "Select  pay_date,nextdate from  baki_payment where case_id=".$cid."  order by nextdate desc limit 1";
$row1 = $objTab->FetchRecords($sql);   
	if(count($row1)>0 &&  $row1[0][1]< $today){
        $List[$ind][0] = $row[$i][0];
        $caseid= $row[$i][0];
        $List[$ind][1] = $row[$i][1];
        $List[$ind][2] = $row[$i][2];
        $List[$ind][3] = $row[$i][3];
        $List[$ind][4] = $row[$i][4];
        $dt = $row1[0][0];
        $List[$ind][5] = $objTab->Sum("baki_payment", "paid_today", "case_id=".$caseid);
        $List[$ind][6] = substr($dt, 8, 2) . "/" . substr($dt, 5, 2) . "/" . substr($dt, 0, 4);
        $ind++;
    }
    
}



$objTab->genDataGridOnValueList("List of Defaulter", $headlist = array("Case ID", "Bank", "Branch", "Name of Defaulter", "Amount of Loan","Amount Received", "Last Paid Date"), $align = array(2, 1, 1, 1, 3, 3,2), $List, 100, count($List));
