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

function validate(i)
{
var a=myform.days.value ;// Primary Key

if (isdate(a,1)==true)
{
myform.action="ListOlderCase.php?tag="+i;
myform.submit();
}
else
alert('Invalid Date');
}


function isdate(dt,tag)
{
//var dt=myform.Est_On.value;
var ln=parseInt(dt.length);
var dd;
var mm;
var yyyy;
var leapday;
var tt=true;
var i=dt.indexOf("/");
dd=dt.substr(0,i);
var j=dt.indexOf("/",(i+1));
mm=dt.substr((i+1),(j-i-1));
yyyy=dt.substr((j+1),(ln-j-1));
if(isNaN(yyyy)==false)
{
var t=parseInt(yyyy%4);
if(t==0)
leapday=29;
else
leapday=28;
}
if((tag==0) && ln==0)  //for null field No check
tt=true;
else
{
if (isNaN(dd)==false && isNaN(mm)==false && isNaN(yyyy)==false)
{
dd=Number(dd);
mm=Number(mm);
yyyy=Number(yyyy);
if( (mm>0) && (mm<13) && (dd>0) && (dd<32))
{
if((mm==4)||(mm==6)||(mm==9)||(mm==11)) //30st day
{
if (dd>30)
{
alert('Invalid Date '+dt+'(DD Part out of range)');
tt=false;
}
} // mm==4
if (mm==2)
{
if (dd>leapday)
{
alert('Invalid Date '+dt+'(DD Part)');
tt=false;
}
} //mm==2
}
else //mm>0 && dd>0
{
alert('Invalid Date '+dt+'(Month out of range)');
tt=false;
}
}
else  // Non numeric figure appears
{
alert('Invalid date '+dt);
tt=false;
}
}// not null
return(tt);
}
</script>
<body>


       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';

require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();
$gross=0;
$bal=0;

if (!isset($_SESSION['day']))
$_SESSION['day']="01/01".date('/Y');

if (!isset($_SESSION['day1']))
$_SESSION['day1']=date('d/m/Y');


if ($_tag==2 || $_tag==3 )
{
$_SESSION['day']=$_POST['days'] ; 

$_SESSION['day1']=$_POST['days1'] ; 
}
?>
<form name="myform" method="post"> 
    <font color="blue" size="2" face="arial">  
    <p align="center">
List Case Registered within
<input type="text" size="12" name="days" value="<?php echo $_SESSION['day']?>">
and
<input type="text" size="12" name="days1" value="<?php echo $_SESSION['day1']?>">
 
<input type="button" value="List Detail" onclick="validate(2)">

<input type="button" value="Menu" onclick="home()">
 
    </p> 
    <hr>
</form>      

 <?php


if ($_tag==2)
{
if (isset($_POST['days1']))
$days1=$_POST['days1'];
else
$days1=date('d/m/Y');


if (isset($_POST['days']))
$days=$_POST['days'];
else
$days="01/01".date('/Y');


$_SESSION['day']=$days;  
$_SESSION['day1']=$days1; 

//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bakijai_main();
$objBp=new Baki_payment();
$str=" start_date>='".$objUtility->to_mysqldate($days)."'";
$str.=" and start_date<='".$objUtility->to_mysqldate($days1)."' order by bank,start_date";

$objBm->setCondString($str);
$row=$objBm->getAllRecord($days);
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="100%" colspan="7" align="center"><font face="arial" size="3" color="black">Detail of Cases Registered within <?php echo $_SESSION['day']?> to <?php echo $_SESSION['day1']?></td></tr>
<tr><td width="7%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">SlNo</td> 
<td width="13%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Case Id</td> 
<td width="30%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Case Detail</td> 
<td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Registration Date</td>
<td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Amount</td> 
<td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Balance</td>    
<td width="20%" bgcolor="#CCFF66" align="center"><font face="arial" size="2">Status</td></tr>
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
 
</td><td align=left><font face="arial" size="2"><b>
<?php
$tvalue=$row[$ii]['Bank'].",".$row[$ii]['Branch']."/".$row[$ii]['Case_no'];
echo $tvalue."</b><br>";
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Start_date']);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$gross=$gross+$row[$ii]['Amount'];
$tvalue=$objUtil->convert2standard($row[$ii]['Amount']);
echo $tvalue;
?>
</td>

<td align=right><font face="arial" size="2">
<?php
$pbal=$objBp->BalanecAmount($caseid);
$bal=$bal+$pbal;
$tvalue=$objUtil->convert2standard($pbal);

echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
if ($row[$ii]['Disposed']=="N")
echo "Running";
else
{
echo "Disposed through ";
echo  $row[$ii]['Payment_mode'];
echo " on ".$objUtility->to_date($row[$ii]['Disposed_date']);
}
?>
</td>
</tr>
<?php
} //for loop
$gross=$objUtil->convert2standard($gross);
$bal=$objUtil->convert2standard($bal);
?>
<?php
//echo $ii;
} //$tag==2
?>
</table>

</body>
</html>
