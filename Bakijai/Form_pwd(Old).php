<html>
<head>
<title>Entry Form for pwd</title>
</head>
<script language=javascript>
<!--
function direct()
{
var i;
i=0;
}

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Fullname.focus();
}

function redirect(i)
{
}

function validate()
{
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";
var a=myform.Fullname.value ;
var a_length=parseInt(a.length);
var b=myform.Uid.value ;
var b_length=parseInt(b.length);
var c=myform.Pwd.value ;
var c_length=parseInt(c.length);
var d=myform.Roll.value ;
var d_index=myform.Roll.selectedIndex;
if ( 1==1 && validateString(a) && a_length<=50 && notNull(b) && validateString(b) && b_length<=20 && notNull(c) && validateString(c) && c_length<=20 && d_index>0 )
{
myform.action="Insert_pwd.php";
myform.submit();
}
else
alert('Invalid Data');
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
document.getElementById(el).style.backgroundColor = 'white';
}

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
</script>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once '../class/class.pwd.php';
require_once './class/class.roll.php';
$objUtility=new Utility();
$objPwd=new Pwd();

$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php');


if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue[0]="";//Fullname
$mvalue[1]="";//Uid
$mvalue[2]="";//Pwd
// Call $objPwd->MaxRoll() Function Here if required and Load in $mvalue[3]
$mvalue[3]="-1";//Roll
}
if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
$ptype=$_GET['ptype'];

$pkarray[0]=$_POST['Uid'];
$objPwd->setUid($pkarray[0]);
if ($objPwd->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objPwd->getFullname();
$mvalue[1]=$objPwd->getUid();
$mvalue[2]=$objPwd->getPwd();
$mvalue[3]=$objPwd->getRoll();
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
if ($ptype==0)
{
$mvalue[0]="";
$mvalue[1]=$pkarray[0];
$mvalue[2]="";
$mvalue[3]=-1;
}
}
} //tag==2
//Start of Form Design
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_pwd.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Password Creation Form<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Name of User</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Fullname" id="Fullname" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Fullname',1)"  onblur="ChangeColor('Fullname',2)">
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>User ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=20 name="Uid" id="Uid" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=20 onfocus="ChangeColor('Uid',1)"  onblur="ChangeColor('Uid',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Password</font></td><td align=left bgcolor=#FFFFCC>
<input type=password size=20 name="Pwd" id="Pwd" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=20 onfocus="ChangeColor('Pwd',1)"  onblur="ChangeColor('Pwd',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Roll</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objRoll=new Roll();
$objRoll->setCondString(" roll>0" ); //Change the condition for where clause accordingly
$row=$objRoll->getRow();
?>
<select name=Roll style="font-family: Arial;background-color:white;color:black; font-size: 12px" onchange=redirect(4)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind][0])
echo "<option selected value=".chr(34).$row[$ind][0].chr(34).">".$row[$ind][1];
else
echo "<option  value=".chr(34).$row[$ind][0].chr(34).">".$row[$ind][1];
}
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Fullname')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Fullname");

?>
</body>
</html>
