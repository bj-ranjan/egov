<?php
session_start();
require_once '../class/class.config.php';
require_once '../class/utility.class.php';
//require_once './class/class.petition_master.php';

$objU=new Utility();
//$objPetition_master=new Petition_master();


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

$date1=$yy."-".$mm."-"."01";

$date2=$yy."-".$mm."-".$objU->mDays[$mm];


//$cond="Pet_type<>'ER' and Pet_type<>'JB'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   


$xml=<<<PROLOG
<?xml version="1.0" encoding="iso-8859-1"?>
PROLOG;
 //Initialise XML variable
$xml="";
//if($type=="J")
$xml=$xml."<RESULT>";

$xml=$xml."<JB>";
$cond="Pet_type='JB' and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml.Sum("Fees", $cond); 
$xml=$xml."</JB>";

$xml=$xml."<ER>";
$cond="Pet_type='ER' and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml.Sum("Fees", $cond);
$xml=$xml."</ER>";

$xml=$xml."<OTHER>";
$cond="Pet_type<>'ER' and Pet_type<>'JB'  and Issue_date>='".$date1."' and Issue_date<='".$date2."'" ;   
$xml=$xml.Sum("Fees", $cond);
$xml=$xml."</OTHER>";

$xml=$xml."</RESULT>";

//header("Content-Type:text/xml");

echo $xml;
//$objU->saveSqlLog("XML",$xml);

function Sum($fld,$cond)
{
$objC=new Config();
if(strlen($cond)<3)
$cond=true;
$sql="select sum(".$fld.") from Petition_Master where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}
?>
