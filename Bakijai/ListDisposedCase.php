<html>
<title></title>
</head>
<script language=javascript>
<!--

function home()
{
window.location="Mainmenu.php?tag=1";
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

function validate()
{
var a=myform.Month.selectedIndex ;// Primary Key
var b=myform.Yr.value;
var b_length=parseInt(b.length);
if (isNumber(b) && b_length==4 && a>0)
{
myform.action="ListDisposedCase.php?tag=1";
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
require_once './class/class.bank_master.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
//require_once './class/class.bakijai_old.php';

//$objBakiOld=new Bakijai_old();

$objUtility=new Utility();


$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;


$objUtil=new myutility();
$gross=0;
$bal=0;
$paid=0;
$bal1=0;


$mvalue=array();


if($_tag==0)
{
$mvalue[0]=date('Y');
$mvalue[1]=round(date('m'));
}


if($_tag==1)
{
if (isset($_POST['Yr']))    
$mvalue[0]=$_POST['Yr'];    
else
$mvalue[0]=date('Y');

if (isset($_POST['Month']))    
$mvalue[1]=$_POST['Month'];    
else
$mvalue[1]=round(date('m'));
//$mvalue=$_SESSION['mvalue'];
}



$mnth=$objUtil->Month($mvalue[1])."/".$mvalue[0];

//echo $objBm->returnSql;
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Year</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=4 name="Yr" id="Yr" value="<?php echo $mvalue[0]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=4 onfocus="ChangeColor('Yr',1)"  onblur="ChangeColor('Yr',2)">
<font color=red size=3 face=arial></font>
</td>
<?php $i++; //Now i=1?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Month</font></td>
<td align=left bgcolor=#FFFFCC>
<select name=Month style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:100px" onchange=redirect(2)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=1;$ind<13;$ind++)
{
if ($mvalue[1]==$ind) 
{   
?>
<option  selected value="<?php echo $ind;?>"><?php echo $objUtil->Month($ind);?>
<?php
}
else
{    
?>
<option  value="<?php echo $ind;?>"><?php echo $objUtil->Month($ind);?>
<?php
}
} //for loop
?>
</select>
</td><td align=""left>    
<input type=button value="List"  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:#CCFF66;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Yr')" style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">
</td>
</tr>
</table>    
    
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr>
      
 <td width="100%" colspan="8" align="center"><font face="arial" size="3" color="red">List of Disposed Cases  in  <?php echo $mnth?></td>
            </tr>
<tr><td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">SlNo</td> 
<td width="25%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Bank</td>
<td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Id</td> 
<td width="15%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case No</td> 
<td width="20%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Name of Defaulter</td>    
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Amount</td> 
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Disposed Date</td>
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Mode</td>
</tr>    

<?php
$date1=$mvalue[0]."-".$mvalue[1]."-01";
$date2=$mvalue[0]."-".$mvalue[1]."-".$objUtility->mDays[$mvalue[1]];

$objB=new Bakijai_main();
$str=" disposed='Y' and disposed_date>='".$date1."' and disposed_date<='".$date2."' order by bank,case_id";
$objB->setCondString($str);
$row=$objB->getAllRecord();
//echo $objB->returnSql;

//echo count($row);
for($ii=0;$ii<count($row);$ii++)
{
$caseid=$row[$ii]['Case_id'];
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Bank'].",".$row[$ii]['Branch'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
echo $caseid;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$caseno=$row[$ii]['Case_no'];
if (strlen($row[$ii]['Fin_yr'])>0)
$caseno=$caseno."/".$row[$ii]['Fin_yr'];    
echo $caseno;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$amt1=$row[$ii]['Amount'];
$tvalue=$objUtil->convert2standard($amt1);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Disposed_date']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=($row[$ii]['Payment_mode']);
echo $tvalue;
?>
</td>
</tr>
<?php
} //for loop
?>

</table>

</body>
</html>
