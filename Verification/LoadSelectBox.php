<?php
//Start FORMBODY
session_start();
require_once './class/class.verification.php';
require_once '../class/utility.class.php';

$objU=new Utility();
$roll=$objU->VerifyRoll();

if(isset($_POST['Cir']))
$circode=$_POST['Cir'];
else
$circode=0;

$objV=new Verification();

$cond="vill_code>0 and cir_code=".$circode." order by vill_name"; //Change the condition for where clause accordingly

$sql="Select Vill_name from village where ".$cond;
$function=" onchange=loadme()";
$objV->DefaultOptDetail="Click Here to See Village List";
$objV->genSelectBox("Vill_code", $sql, "", 200, "#FFFF66","black",10, $function);
?>


