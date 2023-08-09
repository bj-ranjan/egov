<?php
//Start FORMBODY
session_start();
require_once '../bakijai/class/class.mouza.php';
require_once '../bakijai/class/class.village.php';

if(isset($_POST['Cir']))
$circode=$_POST['Cir'];
else
$circode=0;

if(isset($_GET['type']))
$type=$_GET['type'];
else 
$type="";    

if($type=="M")
{
$objMouza=new Mouza();
$objMouza->setCondString(" Mouza_code>0 and cir_code=".$circode." order by Mouza_name"); //Change the condition for where clause accordingly
$row=$objMouza->getRow();
?>
<select name=Mauza_code id="Mauza_code" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange="LoadMouzaCode()">
<?php $dval="0";?>
<option selected value="<?php echo $dval ;?>">-Select-
    
<?php 
for($ind=0;$ind<count($row);$ind++)
{?>
<option  value="<?php echo $row[$ind]['Mouza_code'];?>"><?php echo $row[$ind]['Mouza_name'];?>
<?php
} //for loop
?>
</select>
<?php 
}//type=M

if($type=="V")
{
$objVillage=new Village();
$objVillage->setCondString("vill_code>0 and cir_code=".$circode." order by vill_name"); //Change the condition for where clause accordingly
$row=$objVillage->getRow();
?>
<select name=Vill_code id="Vill_code" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange="LoadVillCode()">
<?php $dval="-1";?>
<option selected value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
?>
<option  value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name'];?>
<?php
} //for loop
?>
</select>
<?php
} //type=V
?>

