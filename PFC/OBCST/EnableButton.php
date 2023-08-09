<?php
session_start();

require_once './class/class.old_obc_st.php';

$objOld_obc_st=new Old_obc_st();
$type=isset($_POST['rType'])?$_POST['rType']:"Both";
$yr=isset($_POST['rYear'])?$_POST['rYear']:date('Y');
$no1=isset($_POST['No1'])?$_POST['No1']:0;
$no2=isset($_POST['No2'])?$_POST['No2']:0;


$no1=is_numeric($no1)?$no1:'0';
$no2=is_numeric($no2)?$no2:'0';


if($type=="Both")
$type="'ST','OBC'";
else
$type="'".$type."'";    

$cond="Type in (".$type.")  and cert_yr=".$yr." and cert_no between ".$no1." and ".$no2." order by cert_no";

$val=$objOld_obc_st->CountRecords("old_obc_st", $cond);

echo $val;
  
?>


