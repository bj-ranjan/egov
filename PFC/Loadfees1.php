<?php
//session_start();
//require_once '../class/class.config.php';
//require_once '../class/utility.class.php';
//require_once './class/class.petition_master.php';

//$objU=new Utility();
//$objPetition_master=new Petition_master();
//$objC=new Config();

if (isset($_GET['type']))
$type=$_GET['type'];
else
$type=0;

if (isset($_POST['yy']))
$yy=$_POST['yy'];
else
$yy=2013;

if (isset($_POST['mm']))
$mm=$_POST['mm'];
else
$mm=12;

//$date1=$yy."-".$mm."-"."01";

//$date2=$yy."-".$mm."-".$objU->mDays[$mm];


$xml="";
//if($type=="J")
$xml=$xml."<RESULT>";

$xml=$xml."<JB>";
//$cond="Pet_type='JB' and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml."12a"; 
$xml=$xml."</JB>";

$xml=$xml."<ER>";
//$cond="Pet_type='ER' and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml."12eR"; 
$xml=$xml."</ER>";

$xml=$xml."<OTHER>";
//$cond="Pet_type<>'ER' and Pet_type<>'JB'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml."12OT"; 
$xml=$xml."</OTHER>";

$xml=$xml."</RESULT>";

header("Content-Type:text/xml");

echo $xml;
//$objU->saveSqlLog("XML",$xml);


?>
