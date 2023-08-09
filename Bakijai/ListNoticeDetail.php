<html>
<title></title>
</head>
<script language=javascript>
<!--

function home()
{
window.location="mainmenu.php?tag=1";
}

function go(i)
{
 //alert(i);
window.open("ListNoticedCase.php?code="+i,"_blank");
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
myform.action="ListNoticeDetail.php?tag="+i;
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
require_once './class/class.bakijai_casedate.php';
require_once './class/class.noticetype.php';

$objUtility=new Utility();
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objCD=new Bakijai_casedate();
$objNT=new Noticetype();


$objUtil=new myutility();


?>
<form name="myform" method="post" > 
<font color="blue" size="3" face="arial">  
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=80%>
<tr><td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">SlNo</td> 
<td width="35%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">Notice Detail</td> 
<td width="15%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">Valid</td> 
<td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">Expired</td> 
<td width="10%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">Total</td>     
<td width="20%" bgcolor="#CCFF66" align="center"><font face="arial" size="3">Click for Detail</td>     
    </tr>
<?php
$row=$objNT->getRow();
for($i=0;$i<count($row);$i++)
{
?>
<td align=center><font face="arial" size="3">
<?php
$tvalue=$i+1;
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="3">
<input type="hidden" name="code" value="<?php echo $row[$i]['Code'];?>">    
<?php
$tvalue=($row[$i]['Noticedetail']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="3">
<?php
$cond=" Notice_type=".$row[$i]['Code']." and (action_taken='N' and next_date>='".date('Y-m-d')."')";
$tval1= $objCD->rowCount($cond);
echo $tval1;
?>
</td>  
<td align=center><font face="arial" size="3">
<?php
$cond=" Notice_type=".$row[$i]['Code']." and (action_taken='Y' or next_date<'".date('Y-m-d')."')";
$tval2= $objCD->rowCount($cond);
echo $tval2;
?>
</td>
<td align=center><font face="arial" size="3">
<?php
echo $tval1+$tval2;
?>
</td>
<td align="center">
<input type="button" style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:#FFFF99;color:blue;width:80px" value="Detail" name="det" onclick="go(<?php echo $row[$i]['Code'];?>)">    
</td>
</tr>
<?php
}//for loop
?>
<tr><td colspan="5"><input type="button" style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:red;color:blue;width:80px" value="Menu" name="back" onclick="home()"></td>
</body>
</html>
