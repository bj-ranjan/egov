<?php
session_start();
require_once 'class/class.old_obc_st.php';

$objUtility=new Old_obc_st();

$Param1=isset($_POST['Param1'])?$_POST['Param1']:'ST';

$yr=isset($_POST['Param2'])?$_POST['Param2']:date('Y');

$List=array();
if($Param1=="ST")
{
$List[0][0]="Borokachari";
$List[0][1]=$List[0][0];
$List[1][0]="Rabha";
$List[1][1]=$List[1][0];
$List[2][0]="Kachari";
$List[2][1]=$List[2][0];
}

if($Param1=="MOBC")
{
$List[0][0]="Maria";
$List[0][1]=$List[0][0];
}

if($Param1=="OBC")
{
$List=$objUtility->PopulateValueList("select detail from subcaste order by detail");
}

$ExtraHeader['Max']=$objUtility->maxCert_no($Param1, $yr);

$objUtility->Return_JSON_Object_For_SelectBox($List, 0, 1,$ExtraHeader);
//$objUtility->Return_JSON_Object_For_SelectBox($List, $SelecVal, $Default, $ExtraHeader);
?>
