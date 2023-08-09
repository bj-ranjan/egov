<?php
//Start FORMBODY
session_start();
require_once './class/class.crpc_party.php';

if(isset($_POST['Cir']))
$circode=$_POST['Cir'];
else
$circode=0;


$objCrpc_party=new Crpc_party();

$cond="vill_code>0 and cir_code=".$circode." order by vill_name"; 

$query="SELECT VILL_NAME  FROM VILLAGE WHERE ".$cond;
//$objCrpc_party->TdSelectBox(1, $bcol, "Village", $mvalue[11], $query, "170", $function);
$objCrpc_party->genSelectBox("Villname", $query, "", 250, "white", "black", 12, " onchange=load()");

?>

