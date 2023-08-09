<html>
<title></title>
</head>
<script language=javascript>
<!--

function home()
{
window.location="SelectMonth1.php?tag=1";
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
var a=myform.mdate.value ;// Primary Key
var b=myform.Bank.selectedIndex;
if (b>0 && isdate(a,1))
{
myform.action="ListBankWiseCase.php?tag=2";
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

if (isset($_POST['Yr']))
$yr=$_POST['Yr'];
else
$yr=date('Y') ;
if (isset($_POST['Month']))
$mn=$_POST['Month'];
else
$mn=date('m');

$mn=round($mn);

if (isset($_POST['Bank']))
$bank=$_POST['Bank'];
else 
$bank="-";  
$mvalue=array();
$mvalue[0]=$yr;
$mvalue[1]=$mn;
$mvalue[2]=$bank;

$_SESSION['mvalue']=$mvalue;


$sdate=$yr."-".$mn."-01";
$ldate=$yr."-".$mn."-".$objUtility->mDays[$mn];
$mnth=$objUtil->Month($mn)."/".$yr;

//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bank_master();
$objB=new Bakijai_main();
$row=$objBm->MonthlyCollection($bank, $yr, $mn);
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align="center" colspan="2"><input type="button" name="back" value="Back" onclick="home()"></td>
        
        <td width="100%" colspan="6" align="center"><font face="arial" size="2" color="blue">Collection details of Cases under <b> <font face="arial" size="2" color="red"><?php echo $bank?></b> <font face="arial" size="2" color="blue">for the Month of <b> <font face="arial" size="2" color="red"><?php echo $mnth?></b></td>
            </tr>
<tr><td width="8%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">SlNo</td> 
    <td width="10%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Receipt Date</td>
<td width="12%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Receipt No</td> 
<td width="10%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Case ID</td> 
<td width="25%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Name of Defaulter & Case No</td>    
<td width="13%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Amount of Loan</td> 
<td width="12%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Amount Received</td>
<td width="10%" bgcolor="#CCCC99" align="center"><font face="arial" size="2">Payment Mode</td>
</tr>    

<?php
for($ii=0;$ii<count($row);$ii++)
{
$caseid=$row[$ii]['Case_id'];
$objB->setCase_id($caseid); 
$objB->EditRecord();
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
$tvalue=$objUtility->to_date($row[$ii]['Pay_date']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Receipt_no'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php

$tvalue=($row[$ii]['Case_id']);
echo $tvalue;
?>
 
</td><td align=left><font face="arial" size="2">
<?php
$tvalue=$objB->getFull_name();
echo $tvalue."<br><b>";
echo $objB->getCase_no()."/".$objB->getFin_yr();
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$amt1=$objB->getAmount();
$tvalue=$objUtil->convert2standard($amt1);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$gross=$gross+$row[$ii]['Paid_today'];
$tvalue=$objUtil->convert2standard($row[$ii]['Paid_today']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Payment_mode'];
echo $tvalue;
if($objB->getDisposed()=='Y')
    echo "(Case Disposed)"
?>
</td>
</tr>
<?php
} //for loop
?>
<tr><td colspan="6" align="right">Total</td>
<td align="right"><?php
echo $objUtil->convert2standard($gross);
?></td><td>&nbsp;</td></tr>
<tr><td colspan="8" align="center">In words Rupees(
<?php
echo $objUtil->letter($gross);
?></td></tr>
</table>

</body>
</html>
