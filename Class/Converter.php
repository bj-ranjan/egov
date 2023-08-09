<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require_once 'class.converter.php';
require_once 'class.iss.php';


if (isset($_POST['Param']))
    $Param = $_POST['Param'];
else
    $Param = "";

$Select="0";
if(isset($_GET['Pos']))  //Position of Cursor
$Select=$_GET['Pos'];

$Extra="0";                       
if(isset($_GET['Extra']))  //If more than one unicode character in single stroke
$Extra=$_GET['Extra'];


if (isset($_GET['tag']))
    $tag = $_GET['tag'];
else
    $tag = "S";

$objC = new Converter();
if ($tag == "A") { //Assamese
    $ass = $objC->English2Unicode($Param);
    $ass = $objC->HandleRef_Rakar($ass, 0);
    echo $ass;
}
if ($tag == "E") //Filter Special character in English
    echo $objC->filterEnglish($Param);

if ($tag == "S") { //convert in self box
    echo trim($objC->Map($Param));
    if($Select>0)
       echo "#".($Select+$Extra);
}

if ($tag == "UE") { //convert Unicode to English
    $objIss=new iss();
   echo $objIss->UniToEnglish($Param);
}

?>