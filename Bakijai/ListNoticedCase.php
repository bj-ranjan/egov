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
window.location="ListNoticeDetail.php";
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
require_once './class/class.bakijai_casedate.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
//require_once './class/class.bakijai_old.php';
require_once './class/class.noticetype.php';
//$objBakiOld=new Bakijai_old();
$objNT=new Noticetype();
$objUtility=new Utility();
if (isset($_GET['code']))
$code=$_GET['code'];
else
$code=0;

if (!is_numeric($code))
$code=0;


$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();

$objCD=new Bakijai_casedate();  

$objNT->setCode($code);
if ($objNT->EditRecord())
$nt=$objNT->getNoticedetail ();
else 
$nt="";
//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bakijai_main();
$objBp=new Baki_payment();
//$str="disposed='N' and court_case='N' and bank='".$_SESSION['day']."' order by case_id";
$str=" Notice_type=".$code." order by Next_date desc";
$objCD->setCondString($str);
$row=$objCD->getAllRecord();
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="80%" colspan="8" align="center"><font face="arial" size="3" color="blue">Detail List of Person to whom <b><font color=red><?php echo $nt;?></font><font color="blue"></b> is issued</td>
        </tr>
<tr><td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">SlNo</td> 
<td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case ID</td> 
<td width="25%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case No</td> 
<td width="25%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Name of Defaulter</td>    
<td width="7%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Amount</td> 
<td width="8%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Paid</td>
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Balance</td>    
<td width="15%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Remark</td></tr>    

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
$objBm->setCase_id($caseid);
$objBm->EditRecord();
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$caseno=$objBm->getBank().",".$objBm->getBranch()."/".$objBm->getCase_no();
if ($objBm->getFin_yr()>0)
$caseno=$caseno."/".$objBm->getFin_yr();    
echo $caseno;
echo " Dated ";
echo $objUtility->to_date($objBm->getStart_date());
?>
</td>

<td align=left><font face="arial" size="2"><b>
<?php
$tvalue=$objBm->getFull_name();
echo $tvalue."<br></b>C/o-";
$tvalue=$objBm->getFather();
echo $tvalue."<br>Village-";
$tvalue=$objBm->getVillage();
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$amt1=$objBm->getAmount();
$tvalue=$objUtil->convert2standard($amt1);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$tvalue=$objBp->LastPaid($caseid);
$tvalue=$objUtil->convert2standard($tvalue);
echo $tvalue;
?>
</td>
<td align=right><font face="arial" size="2">
<?php
$tvalue=$objBp->LastBalanecAmount($caseid);
$tvalue=$objUtil->convert2standard($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
echo " Called on ".$objUtility->to_date($row[$ii]['Next_date']);    
echo "<br>";
?>
</td>
</tr>
<?php
} //for loop
?>
</table>

</body>
</html>
