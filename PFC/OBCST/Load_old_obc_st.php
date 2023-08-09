<?php
session_start();

$bcol="white";
$fcol="black";
$font="12";

//IF SERVLET IS CALLED AS 'MSGTEXT' OR 'MSGHTML' INSTEAD OF TEXT OR HTML
//Separate Alert Messsage Part and HTML/TEXT part of ResponseText with &(Ampersond)
//which will result an alert Java Message as well as Populate DivId Object

require_once '../class/class.old_obc_st.php';
require_once '../class/utility.class.php';

$objUtility=new Utility();
if(isset($_GET['mtype']))
$Load_Box_Name=$_GET['mtype'];
else
$Load_Box_Name=0;


if(isset($_GET['mval']))
$mval=$_GET['mval'];
else
$mval=-1;

//Get Post variable
if(isset($_POST['Param1']))
$Param1=$_POST['Param1'];
else
$Param1=0;

if(isset($_POST['Param2']))
$Param2=$_POST['Param2'];
else
$Param2=0;

if(isset($_POST['Param3']))
$Param3=$_POST['Param3'];
else
$Param3=0;

$objOld_obc_st=new Old_obc_st();
if($Load_Box_Name=="Editme")
{
$function="onchange=LoadTextBox()";
$query="Select Cert_no,Type from Old_obc_st where 1=1 limit 10";
$objOld_obc_st->genSelectBox("Editme", $query,$mval,"160", $bcol, $fcol, $font, $function);
}//Get type=Editme

