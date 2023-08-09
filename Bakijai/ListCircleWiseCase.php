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

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate()
{
var b=myform.Circle.selectedIndex;
if (b>0)
{
myform.action="ListCircleWiseCase.php?tag=2";
myform.submit();
}
else
alert('Invalid Selection');
}

</script>
<body>


       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';
require_once './class/class.Circle.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
//require_once './class/class.bakijai_old.php';

//$objBakiOld=new Bakijai_old();

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
$paid=0;
$bal1=0;
$_SESSION['mdate']=date('d/m/Y');

if (!isset($_SESSION['day']))
{
$_SESSION['day']="-";
$_SESSION['mdate']=date('d/m/Y');
}

if ($_tag==2)
$_SESSION['day']=$_POST['Circle'] ; 
if (isset($_POST['mdate']))
$_SESSION['mdate']=$_POST['mdate'];
else
$_SESSION['mdate']= date('d/m/Y');   
?>
<form name="myform" method="post"> 
    <font color="blue" size="2" face="arial">  
    <p align="center">
List Case Detail for 
<?php 
$objCircle=new Circle();
$objCircle->setCondString(" Cir_code>0 order by Circle" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name=Circle style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(5)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($_SESSION['day']==$row[$ind]['Cir_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];
}
} //for loop
?>
</select>
<input type="button" value="List" onclick="validate()">
<input type="button" value="Menu" onclick="home()">
    </p> 
    <hr>
</form>      

 <?php


if ($_tag==2)
{
if (isset($_POST['Circle']))
$days=$_POST['Circle'];
else
$days="-";


$_SESSION['day']=$days;  

//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bakijai_main();
$objBp=new Baki_payment();
//$str="disposed='N' and court_case='N' and Circle='".$_SESSION['day']."' order by case_id";
$str=" Circle=".$_SESSION['day']." order by Bank,Branch,Case_no";

$objBm->setCondString($str);
$row=$objBm->getAllRecord();
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="100%" colspan="8" align="center"><font face="arial" size="2" color="red">Circle Wise Case Status </td></tr>
<tr><td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">SlNo</td> 
<td width="6%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case Id</td> 
<td width="15%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case No</td> 

<td width="12%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Name of Defaulter</td>    
<td width="8%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Amount</td> 
<td width="7%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Paid</td>
<td width="7%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Balance</td>    
<td width="12%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Remark</td></tr>    

<?php
for($ii=0;$ii<count($row);$ii++)
{
   // echo $sessio
 $mydate=$objUtility->to_mysqldate($_SESSION['mdate']);
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
</td>
<td align=center><font face="arial" size="2">
<?php
$caseno=$row[$ii]['Bank']."/".$row[$ii]['Branch']."/".$row[$ii]['Case_no'];
if (strlen($row[$ii]['Fin_yr'])>0)
$caseno=$caseno."/<br>".$row[$ii]['Fin_yr'];    
echo $caseno;
?>
</td>

<td align=left><font face="arial" size="2">
<?php
$tvalue="<b>".$row[$ii]['Full_name']."</b><br>";
$tvalue=$tvalue."C/o ".$row[$ii]['Father']."<br>";
$tvalue=$tvalue.$row[$ii]['Village'];
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$amt1=$row[$ii]['Amount'];
$gross=$gross+$row[$ii]['Amount'];
$tvalue=$objUtil->convert2standard($row[$ii]['Amount']);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$tvalue=$objBp->LastPaidBeforeDate($caseid,$mydate);
//echo $objBp->returnSql;
$amt2=$amt1-$tvalue;
$paid=$paid+$tvalue;
$tvalue=$objUtil->convert2standard($tvalue);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php

$tvalue=$amt2;
$bal=$bal+$tvalue;
$tvalue=$objUtil->convert2standard($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
if ($row[$ii]['Disposed']=="N" && $row[$ii]['Court_case']=="N")
echo "Running";

if ($row[$ii]['Disposed']=="Y")
{    
echo "Disposed " ;  
if ($row[$ii]['Payment_mode']=="OTS")
echo " by OTS " ;
echo " on ".$objUtility->to_date($row[$ii]['Disposed_date']);    
echo "<br>";
}
if ($row[$ii]['Court_case']=="Y")
echo "Court Case" ;  
?>
</td>
</tr>
<?php
} //for loop
$gross=$objUtil->convert2standard($gross);
$bal=$objUtil->convert2standard($bal);
$paid=$objUtil->convert2standard($paid);
?>
<tr><td colspan="4" align="right">TOTAL</td>
<td align="right"><?php echo $gross;?></td>
<td align="right"><?php echo $paid;?></td>
<td align="right"><?php echo $bal;?></td><td>&nbsp;</td>
</tr>
<?php
//echo $ii;
} //$tag==2
?>
</table>

</body>
</html>
