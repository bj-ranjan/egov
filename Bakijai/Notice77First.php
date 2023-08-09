<html>
<title></title>
</head>
<script language=javascript>
<!--

function home()
{
window.location="mainmenu.php?tag=1";
}

function notNull(str)
{
var k=0;
var found=false;
var mylength=str.length;
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
if (k!=32)
found=true;
}
return(found);
}

function isNumber(ad)
{
if (isNaN(ad)==false && notNull(ad))
return(true);
else
return(false);
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate()
{
var a=myform.days.value ;// Primary Key

if (isNumber(a)==true)
{
myform.action="Notice77First.php?tag=2";
myform.submit();
}
else
alert('Invalid Days');
}

</script>
<body>


       
<?php

session_start();
require_once '../class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if ($_tag==0)
{
$_SESSION['day']="15";
}

?>
    
<form name="myform" method="post"> 
    <font color="blue" size="2" face="arial">  
    <p align="center">
List Case Where Defaulter Failed to attend by
<input type="text" size="4" name="days" value="<?php echo $_SESSION['day']?>">Days
 
<input type="button" value="List" onclick="validate()">
<input type="button" value="Menu" onclick="home()">
 
    </p> 
    <hr>
</form>      

 <?php


if ($_tag==2)
{
if (isset($_POST['days']))
$days=$_POST['days'];
else
$days=1;
$_SESSION['day']=$days;    
    
$objBm=new Bakijai_main();
$objBp=new Baki_payment();

$row=$objBm->getSelectedRecord($days);
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td width="100%" colspan="7" align="center"><font face="arial" size="2" color="red">Cases Pending unattended More than <?php echo $_SESSION['day']?> days</td></tr>
<tr><td width="5%" bgcolor="#669966"><font face="arial" size="2">SlNo</td> 
<td width="7%" bgcolor="#669966"><font face="arial" size="2">Case Id</td> 
<td width="25%" bgcolor="#669966"><font face="arial" size="2">Name of Defaulter</td>    
<td width="10%" bgcolor="#669966"><font face="arial" size="2">Amount</td> 
<td width="10%" bgcolor="#669966"><font face="arial" size="2">Due Date</td>
<td width="10%" bgcolor="#669966"><font face="arial" size="2">Days Laps</td>
<td width="10%" bgcolor="#669966"><font face="arial" size="2">Balance</td></tr>    

<?php
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$caseid=$row[$ii]['Case_id'];
$tvalue=($row[$ii]['Case_id']);
echo $tvalue;
?>
 
</td><td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Amount'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Duedate'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Lapsday'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Balance'];
echo $tvalue;
?>
</td>
</tr>
<?php
} //for loop
//echo $ii;
} //$tag==2
?>
</table>

</body>
</html>
