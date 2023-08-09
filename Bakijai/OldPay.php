<html>
<head>
<title>Old Payment Entry</title>
</head>
<script language=javascript>
<!--

function direct1()
{
var a=myform.Case_id.value;
if (isNumber(a)==true)
{
myform.action="OldPay.php?tag=2";
myform.submit();
}
else
alert('Invalid Case Id');
}


function setMe()
{
myform.Case_id.focus();
}

function redirect(i)
{
}

function validate()
{

var a=myform.Case_id.value ;// Primary Key

var c=myform.Paid_today.value ;
var d=myform.Pay_date.value ;

if ( isNumber(a)==true   && isNumber(c)==true && isdate(d,1)==true)
{
myform.action="InsertOld.php";
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
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';

$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: Mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 11)==false) //11 for Old Pyment Updation
header( 'Location: Mainmenu.php?unauth=1');


$objBaki_payment=new Baki_payment();

$objBm=new Bakijai_main();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;
$mstr="";
if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();
$mdate="";
if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="";//Paid_today
$mvalue[2]="";//Pay_date
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]

$dis=" disabled";

if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
// Call $objBaki_payment->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]="";//Case_id
// Call $objBaki_payment->MaxInstalment_no() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//amount
$mvalue[2]="";//date

$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
$mtype=1;

if (isset($_POST['Case_id']))
$pkarray[0]=$_POST['Case_id'];
else
$pkarray[0]=0;
$objBaki_payment->setCase_id($pkarray[0]);
$objBaki_payment->setInstalment_no("0");
$objBm->setCase_id($pkarray[0]);

if ($objBm->EditRecord())
{
$mstr="Case Number-<font color=red>".$objBm->getBank().",".$objBm->getBranch()."/".$objBm->getCase_no ()."/".$objBm->getFin_yr ();
$mdate=$objUtility->to_date($objBm->getStart_date());
if ($objBm->getDisposed()=="Y")
{
$dis=" disabled";
echo $objUtility->alert("Case is Disposed");
}
else 
$dis="";    
}

if ($objBaki_payment->EditRecord()) //i.e Data Available
{ 
$mvalue[0]=$objBaki_payment->getCase_id();
$mvalue[1]=$objBaki_payment->getPaid_today();
$mvalue[2]=$objUtility->to_date($objBaki_payment->getPay_date());
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
$mvalue[0]=$pkarray[0];
$mvalue[1]="";
$mvalue[2]=$mdate;
} //EditRecord()



} //tag==2


//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_baki_payment.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Enter Old Transaction Amount<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Case ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Case_id" id="Case_id" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2),direct1()">
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Amount Already Paid(in Rs)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Paid_today" id="Paid_today" value="<?php echo $mvalue[1]; ?>" onfocus="ChangeColor('Paid_today',1)"  onblur="ChangeColor('Paid_today',2)" >
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Pay_date" id="Pay_date" value="<?php echo $mvalue[2]; ?>" onfocus="ChangeColor('Pay_date',1)"  onblur="ChangeColor('Pay_date',2)" readonly>
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php $i++; //Now i=5?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=50 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Yr')" style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">

</td></tr>
<tr><td align=center bgcolor=#FFFFCC colspan="2">
        <font face="arial" size="2" color="blue">
<?php echo $mstr;?>        
    </td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Save");

if($mtype==1)
echo $objUtility->focus("Paid_today");

?>
</body>
</html>
