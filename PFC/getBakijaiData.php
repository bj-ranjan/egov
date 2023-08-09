
<?php
session_start();

require_once '../Bakijai/class/class.Bakijai_main.php';


if (isset($_POST['id']))
$id=$_POST['id'];
else
$id=0;

if (isset($_GET['type']))
$type=$_GET['type'];
else
$type=0;

$objBm=new Bakijai_main();
$objBm->setCase_id($id);


if($type==1)
{
if($objBm->EditRecord())
echo  $objBm->getFull_name();  
else
echo "Invalid Case Id";  
}

if($type==2)
{
if($objBm->EditRecord())
{    
if($objBm->getDisposed()=="Y")
{    
?>
<input type=button value="Print Certificate"  name=Pr id="Pr" onclick=PrintC()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#FF99FF;color:blue;width:130px">
<?php
}//getDisposed()=="Y"
else
echo "Case Not Yet Disposed";    
}
else
{
echo "";
}
}//type=2 
?>
