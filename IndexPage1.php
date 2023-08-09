<html>
<head>
<title>User Login Form</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language=javascript>
<!--

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Uid.focus();
}

function redirect()
{
}

function validate()
{
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
var a=myform.Uid.value ;
var a_length=parseInt(a.length);
var b=myform.Pwd.value ;
var b_length=parseInt(b.length);
if ( notNull(a) && ValidateString(a) && a_length<=20 && notNull(b) && SimpleValidate(b) && b_length<=30)
{
myform.action="verify.php";
myform.submit();
}
else
alert('Invalid Data');
}


function home()
{
window.location="mainmenu.php?tag=1";
}


</script>
<body onload=setMe() >
<?php
session_start();

//require_once './class/class.columns.php';
//$objCol=new Columns();

$_SESSION['backuppath']=realpath("Egov.mdb");


require_once './class/utility.php';
//require_once './class/class.pwd.php';
require_once './class/class.checktable.php';
//divert to Flash Form
//header( 'Location: FlashGp.php');
require_once './class/class.Frame.php';
$objF=new Frame();
$objF->copyFooter();

$objUtility=new myutility();

if (isset($_SESSION['uid']))
unset($_SESSION['uid']) ;

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if(!is_numeric($_tag) || $_tag>2)
$_tag=0;

$dis="";
if($_tag==2)
{
//session_unset;
if(isset($_SESSION['msg']))
echo $objUtility->alert($_SESSION['msg']) ;
if(isset($_SESSION['mvalue']))  
unset($_SESSION['mvalue']) ;  
}

if($_tag==1)
{

if (isset($_SESSION['uid']))
unset($_SESSION['uid']) ;
$_SESSION['t2']=date('H:i:s');
if(isset($_SESSION['mvalue']))  
unset($_SESSION['mvalue']) ;   
}
//$_SESSION['msg']="Failed to Login";
//header( 'Location: index.php?tag=2');

if (isset($_GET['msg']))
$msg=$_GET['msg'];
else
$msg="";


//$objPwd=new Pwd();


if ($_tag==0)
{
$mvalue[0]="";
$mvalue[1]="";
$_SESSION['msg']="";
}
else
{
if(isset($_SESSION['mvalue']))    
$mvalue=$_SESSION['mvalue'];
else
{
$mvalue[0]="";
$mvalue[1]="";
$_SESSION['msg']="";    
}    
}

//Start of Form Design
//if(isset($_SESSION['returnmsg']))
//{
//if (strlen($_SESSION['returnmsg'])>0)
//echo $objUtil->alert($_SESSION['returnmsg']);
//}


if(isset($_SESSION['msg']))
$msg= $_SESSION['msg'];   
?>
<table border="0" CELLPADDING="0" width="100%" align="center" >
<tr>
<td align="center" colspan="3" width="100%">
<image src="./image/header.jpg" width="735" height="70">                
</td>
</tr>    
<tr>
<td align="center" colspan="3" width="100%">
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=50%>
<form name=myform action=verify.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#996699 VALIGN="CENTER"><font face="arial narrow" size=4><b>USER LOGIN FORM<br></font><font face=arial color=red size=2></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#6699FF><font color=black size=2 face=arial><B>Enter User ID</font></td><td align=left bgcolor=#6699FF>
<input type=text size=12 name=Uid value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 14px" maxlength=20  onblur=RemoveSpace('Uid')>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#6699FF><font color=black size=2 face=arial><B>Enter Password</font></td><td align=left bgcolor=#6699FF>
<input type=password size=12 name=Pwd value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 14px" maxlength=30>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr><td align=right bgcolor=#6699FF>
</td><td align=left bgcolor=#6699FF>
<input type=button value=Login  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:#FF9999;color:black;width:80px" <?php echo $dis;?>>
</td></tr>
</table>
</TD></TR>
</TABLE>    
</form>
<?php
if(date('dm')=="0101")
{
?>
<marquee style="font-family: Arial; text-decoration: blink; font-weight: bold" bgcolor="#00FF00"> Happy New Year <?php echo date('Y');?></marquee></p>
<?php
}
?>
</body>
</html>
