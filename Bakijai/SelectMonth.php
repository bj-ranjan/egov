<html>
<head>
<title></title>
</head>
<script language=javascript>
<!--
function direct()
{
var i;
i=0;
}

function enu()
{
myform.QReport.disabled=false;    
}

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Yr.focus();
}

function redirect(i)
{
myform.setAttribute("target", "_self");
myform.action="SelectMonth.php?tag=2";
myform.submit();    
}

function validate(mtag)
{

var a=myform.Yr.value ;
var a_length=parseInt(a.length);
var b_index=myform.Month.selectedIndex;
var b=myform.Month.value;
if ( notNull(a) && validateString(a) && a_length==4 && b_index>0 )
{
myform.Save.disabled=true;   
myform.YReport.disabled=true; 
myform.QReport.disabled=true; 
myform.back1.disabled=true;
myform.setAttribute("target", "_blank");
if(mtag==1)
myform.action="MonthlyReportPDF.php?yr="+a+"&mn="+b;
else
myform.action="NewMonthlyReport.php?yr="+a+"&mn="+b;    
//myform.setAttribute("target", "_self");
myform.submit();
}
else
alert('Select Both Year and Month');
}




function validate1()
{

var b_index=myform.Fyear.selectedIndex;
var b=myform.Fyear.value;
if (b_index>0 )
{
myform.Save.disabled=true;   
myform.YReport.disabled=true; 
myform.back1.disabled=true;
myform.QReport.disabled=true;
myform.setAttribute("target", "_blank");
myform.action="YearlyReportPDF.php?yr="+b;
myform.submit();
}
else
alert('Select Financial Year');
}

function validate2()
{

var b_index=myform.Fyear.selectedIndex;
var c_index=myform.Qtr.selectedIndex;
var b=myform.Fyear.value;
var c=myform.Qtr.value;
if (b_index>0 && c_index>0)
{
myform.Save.disabled=true;   
myform.YReport.disabled=true; 
myform.QReport.disabled=true;
myform.back1.disabled=true;
myform.setAttribute("target", "_blank");
myform.action="QtlyReportNewPDF.php?yr="+b+"&m="+c;
myform.submit();
}
else
alert('Select Financial Year');
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



//change the focus to Box(a)
function ChangeFocus(a)
{
document.getElementById(a).focus();
}

//change color on focus to Box(a)
function ChangeColor(el,i)
{
if (i==1) // on focus
document.getElementById(el).style.backgroundColor = '#99CC33';
if (i==2) //on lostfocus
{
document.getElementById(el).style.backgroundColor = 'white';
var temp=document.getElementById(el).value;
trimBlank(temp,el);
}
}//changeColor on Focus

function validateString(str)
{
var str_index=str.indexOf("'");
var str_select=str.indexOf("select");
var str_insert=str.indexOf("insert");
var str_delete=str.indexOf("delete");
var str_dash=str.indexOf("--");
var str_vbscript=str.indexOf("vbscript");
var str_javascript=str.indexOf("javascript");
var str_ampersond=str.indexOf("&");
var str_lessthan=str.indexOf("<");
var str_greaterthan=str.indexOf(">");
var str_semicolon=str.indexOf(";");

if(str_index==-1 && str_select==-1 && str_insert==-1 && str_delete==-1 && str_dash==-1 && str_vbscript==-1 && str_javascript==-1 && str_ampersond==-1 && str_lessthan==-1 && str_greaterthan==-1 && str_semicolon==-1)
return(true);
else
return(false);
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

function checkName(str)
{
//var  str=n.value;
var k=0;
var found=true;
var mylength=str.length;
var newstr="";
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
//Allow Alphabet and Blank
if ( (k>=97 && k<=122)  || (k>=65 && k<=90) || (k==32)  )
{
newstr=newstr+str.substr(i,1);
}
else
{
alert('Invalid Character String ['+str+']');
found=false;
i=mylength+1;
}
}
return(found);
}

function LoadTextBox()
{
var i=myform.Editme.selectedIndex;
if(i>0)
myform.edit1.disabled=false;
else
myform.edit1.disabled=true;
//alert('Write Java Script as per requirement');
}
function trimBlank(str,a)
{

var newstr="";
var prev=0;
for (var i = 0; i < str.length; i++)
{
k=parseInt(str.charCodeAt(i));
if (k==32 && prev==0)
{
newstr=newstr;
}
else
{
newstr=newstr+str.substr(i,1);
}
if (k==32)
prev=0;
else
prev=1;
}
document.getElementById(a).value=newstr;
}//trimBlank


//date comaprison
function CompareDate(dt1,dt2)
{
var ln;
var i;
var j;
var dd1;
var mm1;
var yyyy1;

var dd2;
var mm2;
var yyyy2;
var tag;
var date1;
var date2;

ln=parseInt(dt1.length);
i=dt1.indexOf("/");
dd1=Number(dt1.substr(0,i));
j=dt1.indexOf("/",(i+1));
mm1=Number(dt1.substr((i+1),(j-i-1)));
yyyy1=Number(dt1.substr((j+1),(ln-j-1)));

dd1= dd1+100;
mm1= mm1+100;

date1=yyyy1+"-"+mm1+"-"+dd1;

ln=parseInt(dt2.length);
i=dt2.indexOf("/");
dd2=Number(dt2.substr(0,i));
j=dt2.indexOf("/",(i+1));
mm2=Number(dt2.substr((i+1),(j-i-1)));
yyyy2=Number(dt2.substr((j+1),(ln-j-1)));

dd2= dd2+100;
mm2= mm2+100;

date2=yyyy2+"-"+mm2+"-"+dd2;

if (date1>date2)
return(1);
if (date1==date2) 
return(0);
if (date1<date2)
return(-1);
}

//END JAVA
</script>
<body>
<?php
header('Refresh: 200;url=../IndexPage.php?tag=1');
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once '../class/utility.php';
require_once './class/class.finalreport.php';
require_once 'header.php';

$objFinal=new Finalreport();


$farray=array();
$maxyr=date('Y')+1;
$k=0;
for ($i=2013;$i<$maxyr;$i++)
{
$farray[$k]=$i."-".($i+1);
$k++;
}

$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();

$allowedroll=3; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php');

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;

if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();

if($_tag==0)
{
$mvalue[0]=date('Y');
$mvalue[1]=round(date('m'));
$mvalue[2]="-";
}

if($_tag==1)
{
$mvalue=$_SESSION['mvalue'];
}

$target="";
if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";

$mvalue[0]=date('Y');
$mvalue[1]="0";//Month

$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]
$exist=0;

if ($_tag==2) //PostBack on Month
{
if (isset($_POST['Yr']))
$mvalue[0]=$_POST['Yr'];
else
$mvalue[0]=date('Y');

if (isset($_POST['Month']))
$mvalue[1]=$_POST['Month'];//Month
else 
$mvalue[1]="0";//Month 

$mvalue[2]="-";

if (isset($_POST['Yr']))
$date2=$mvalue[0]."-".$mvalue[1]."-".$objUtility->mDays[$mvalue[1]];
else 
$date2=date('Y-m-d');    
//echo $date2;

$objFinal->setFdate($date2);
if ($objFinal->EditRecord())
$exist=2;
else
{
$date1=date('Y-m-d');
//echo $date1;
//echo "<br>";
//echo $objUtility->dateDiff($date1, "2013-5-28");
if ($objUtility->dateDiff($date1, $date2)>0)
$exist=1;
}
$target="_blank";
}//tag=2[Post Back]
//echo "exist-".$exist;

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""    method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Select Month Year for Bakijai Report<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Year</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=4 name="Yr" id="Yr" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=4 onfocus="ChangeColor('Yr',1)"  onblur="ChangeColor('Yr',2)">
Row Per Page
<input type="text" name="mrows" value="18" size="1">
<input type=checkbox name=mpdf id=mpdf checked=checked>PDF&nbsp;
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Month</font></td><td align=left bgcolor=#FFFFCC>
<font face=arial size=2>    

<select name=Month style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(2)>
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
Signed By
<input type="checkbox" name="sign" checked="checked">
ADC
<input type="checkbox" name="sign1" checked="checked">
DC
&nbsp&nbsp;
<input type="checkbox" name="last" checked="checked">
in Last Page Only

</td>
</tr>
<?php $i++; //Now i=2?>
<tr><td align=right bgcolor=#CC66FF><font color=black size=2 face=arial>
<?php if ($exist==1) {?>        
<input type="checkbox" name="final">
Final Report
<?php }
if ($exist==2)
echo "Report Finalised";    
?>
</td><td align=left bgcolor=#FFFFCC><font face=arial size=2 color=blue>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="Generate Monthly Report"  name=Save onclick=validate(1)  style="font-family:arial; font-size: 14px ; background-color:#CCFFCC;color:blue;width:200px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Yr')" style="font-family:arial; font-size: 14px ; background-color:#FF66FF;color:blue;width:100px">
<input type=button value="New Monthly Report"  name=Save2 onclick=validate(2)  style="font-family:arial; font-size: 14px ; background-color:orange;color:blue;width:200px">
</td></tr>
<tr><td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Financial Year</font></td>
<td align=left bgcolor=#FFFFCC>

<select name=Fyear style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select Year-
<?php 

for($ind=0;$ind<count($farray);$ind++)
{
if ($mvalue[2]==$farray[$ind]) 
{   
?>
<option  selected value="<?php echo $farray[$ind];?>"><?php echo $farray[$ind];?>
<?php
}
else
{    
?>
<option  value="<?php echo $farray[$ind];?>"><?php echo $farray[$ind];?>
<?php
}
} //for loop
?>
</select>
</td>
</tr>
<tr><td align=right bgcolor=#FFFFCC>
&nbsp;</td><td align=left bgcolor=#FFFFCC>
<input type=button value="Generate Yearly Report"  name=YReport onclick=validate1()  style="font-family:arial; font-size: 14px ; background-color:#CCFFCC;color:blue;width:200px">
</td></tr>
<tr><td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Quarter</font></td>
<td align=left bgcolor=#FFFFCC>

<select name=Qtr style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange="enu()">
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select Qtr-
<option  selected value="1">First Quarter
<option  selected value="4">Second Quarter
<option  selected value="7">Third Quarter
<option  selected value="10">Forth Quarter
</select>
</td>
</tr>
<tr><td align=right bgcolor=#FFFFCC>
&nbsp;</td><td align=left bgcolor=#FFFFCC>
<input type=button value="Generate Qtly Report"  name=QReport onclick=validate2()  style="font-family:arial; font-size: 14px ; background-color:#CCFFCC;color:blue;width:200px">
</td></tr>

</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Yr");

?>
</body>
</html>
