<html>
<head>
<title>Bakijai Interest Collection</title>
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
var i=myform.Payment_mode.value;
if (i=="OTS")
myform.Receipt_no.disabled=false;
//else
//myform.Receipt_no.disabled=true;    
}


function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Case_id.focus();
}

function redirect(i)
{
var a=myform.Case_id.value ;    
if (isNumber(a))
{ 
myform.setAttribute("target", "_self"); 
myform.action="Form_baki_interest.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}
else
    {
alert('Invalid Case ID');
myform.Save.disabled=true;
myform.intr.disabled=true;
myform.Case_id.focus();
}
}

function interest()
{
myform.setAttribute("target", "_blank");
myform.action="ViewInterestDetail.php";
myform.submit();
}



function validate()
{
//var j1=myform.rollno.selectedIndex;//Returns Numeric Index from 0
//var j2=myform.box1.checked;//Return true if check box is checked
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";
var a=myform.Case_id.value ;// Primary Key
var c=myform.Interest_payable.value ;
var d=myform.Pay_date.value ;
var f=myform.Receipt_no.value ;

var pdate=myform.Pdate.value;

if (isNumber(a)==true  && isNumber(c)==true && (Number(c)>0)  && isdate(d,1) &&  validateString(f))
{
if (CompareDate(d,pdate)==1) 
alert('Invalid Pay Date')   
else 
{
myform.setAttribute("target", "_self");     
myform.action="Insert_bakijai_interest.php";
myform.submit();
}
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
require_once '../class/utility.php';
require_once './class/class.finalreport.php';
require_once './class/class.bakijai_interest.php';
require_once 'header.php';
$objFinal=new Finalreport();
$paymargindate=$objFinal->getFinalDate();
if (strlen($paymargindate)==0)
$paymargindate="1800-01-01";
    
$objUtil=new myutility();

$dis1=" disabled";
$objBm=new Bakijai_main();

$objUtility=new Utility();
$dis="disabled";
$name="";
$ddate="";
$balance=0;
$paid=0;
$lastpaydate="";
$amount=0;
$lastinst=0;
$nextdate="";
$last_date="01/01/1900";
$balance=0;
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 16)==false) //16 for Bakijai Interest Collection
header( 'Location: Mainmenu.php?unauth=1');



$objBaki_payment=new Baki_payment();

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


$_SESSION['Bank']="";
if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="0";//Instalment_no
$mvalue[2]="";//Paid_today
$mvalue[3]="";//Pay_date
$mvalue[4]="Cash";//Payment_mode
$mvalue[5]="";//Receipt_no
$mvalue[6]="";//Nextdate
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";

if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]
$totinst=0;
if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$_SESSION['oldId']=0;
// Call $objBaki_payment->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]="0";//Case_id
// Call $objBaki_payment->MaxInstalment_no() Function Here if required and Load in $mvalue[1]

$mvalue[1]="";//Instalment_no

$mvalue[2]="0";
$mvalue[3]="";//Pay_date
$mvalue[4]="cash";
$mvalue[5]="-";//Receipt_no
$mvalue[6]="";//Nextdate
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['Bank']="";
$_SESSION['oldId']=0;    
$_SESSION['msg']="";

if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=1;

if ($ptype>1)
$ptype=1;

//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Case_id']))
$mvalue[0]=$_POST['Case_id'];
else
$mvalue[0]=0;


if (isset($_POST['Pay_date']))
$mvalue[1]=$_POST['Pay_date'];
else
$mvalue[1]=0;


if (isset($_POST['Interest_payable']))
$mvalue[2]=$_POST['Interest_payable'];
else
$mvalue[2]=0;

if (isset($_POST['Receipt_no']))
$mvalue[3]=$_POST['Receipt_no'];
else
$mvalue[3]=0;


//find if already entered

$objBm->setCase_id($mvalue[0]);
$mtag=0;

if ($objBm->EditRecord())
{
$_SESSION['Bank']=$objBm->getBank().",".$objBm->getBranch()."(".$objBm->getCase_no()."/".$objBm->getFin_yr().")";
$amount=$objBm->getAmount();
$name=$objBm->getFull_name();

if ($objBm->getDisposed()=='N')
{    
$str="This case is Still Running ";
echo $objUtility->alert ($str) ; 
$mtag++;
}
$ddate=$objUtility->to_date($objBm->getDisposed_date());
}//if $objBm->Editrecord
else
{
$str="This id is not Available";
echo $objUtility->alert ($str) ; 
$mtag=2;
$ddate="";
$name="";
$amount="";
}    

if ($mtag==0)
{
$dis="";
$dis1= " disabled";   
}
else
{
$dis=" disabled";
$dis1= " ";  
}
$objBInt=new Bakijai_interest();
$objBInt->setCase_id($mvalue[0]);

if ($objBInt->EditRecord()) //already entered for today
{   
$ldate=$objUtility->to_date($objBInt->getEntry_date());
$mvalue[1]=$objUtility->to_date($objBInt->getPay_date());
$mvalue[2]=$objBInt->getInterest_payable();
$mvalue[3]=$objBInt->getReceipt_no();
if ($ldate==date('d/m/Y'))
{
$_SESSION['update']=1; 
$str="You have Already Entered Rs.".$mvalue[2]." as Interest(You may just update data)";
echo $objUtility->alert($str);
}
if ($ldate!=date('d/m/Y'))
{
$dis=" disabled" ;
$str="Already Entered in Past days, You Cannot Modify";
echo $objUtility->alert($str);
}
}
else //find data for previous installment
{
$_SESSION['update']=0;
$mvalue[1]="";
$mvalue[2]="";
$mvalue[3]="";
} //editrecord
} //ptype=1
} //tag==2

//Start of FormDesign
?>
   
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=""  method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>Interest Computation and Updation<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Case ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Case_id" id="Case_id" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2);redirect(1)" onchange=redirect(1)>
<font color=red size=4 face=arial><b>*</b></font>
</td>
<?php $i++; //Now i=1?>
<td align=left colspan="2" rowspan="7" bgcolor=#FFFFCC valign="top"><font color=black size=2 face=arial>
Case No-<b><?php echo $_SESSION['Bank'];?></b><br>
Name-<b><?php echo $name;?></b><br>  
Amount of Loan-<b><?php echo $amount;?></b><br> 
Disposed on-<b><?php echo $ddate;?></b><br>     
</td>
&nbsp;
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Interest Due(in Rs)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Interest_payable" id="Paid_today" value="<?php echo $mvalue[2]; ?>" onfocus="ChangeColor('Paid_today',1)"  onblur="ChangeColor('Paid_today',2)">
&nbsp;
</td>
</tr>
<tr>
<?php $i++; //Now i=3?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Pay Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Pay_date" id="Pay_date" value="<?php echo $mvalue[1]; ?>" onfocus="ChangeColor('Pay_date',1)"  onblur="ChangeColor('Pay_date',2)">
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<tr>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Receipt No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=35 name="Receipt_no" id="Receipt_no" value="<?php echo $mvalue[3]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Receipt_no',1)"  onblur="ChangeColor('Receipt_no',2)" >
</td>    
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=center colspan="2" bgcolor=#FFFFCC><font color=black size=2 face=arial></font></td><td align=left bgcolor=#FFFFCC >
</td></tr>
<tr>
<td align=left bgcolor=#FFFFCC colspan="2">
<input type=hidden size=10 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=hidden size=10 name=Ldate id=Ldate value="<?php echo $last_date; ?>">
<input type=hidden size=10 name=Balance id=Balance value="<?php echo $balance; ?>">
<input type=button value="Calculate Interest"  name=intr1 onclick="interest()"  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#99FFCC;color:blue;width:150px" <?php echo $dis1;?>>

<input type=button value="Compute Interest"  name=intr onclick="interest()"  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#99FFCC;color:blue;width:150px" <?php echo $dis;?>>
<input type=button value=Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:#FFCC33;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Case_id')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td>
</tr>
<tr><td colspan="2" align="center"><font size="2" face="arial" color="blue">
 
        Developed by National Informatics Center,
        Nalbari , Assam
    </td></tr>
      
  
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Case_id");

if($mtype==1)//Postback from Case_id
echo $objUtility->focus("Interest_payable");

if($mtype==2)//Postback from Instalment_no
echo $objUtility->focus("Paid_today");

if($mtype==3)//Postback from Paid_today
echo $objUtility->focus("Pay_date");

if($mtype==4)//Postback from Pay_date
echo $objUtility->focus("Payment_mode");

if($mtype==5)//Postback from Payment_mode
echo $objUtility->focus("Receipt_no");

if($mtype==6)//Postback from Receipt_no
echo $objUtility->focus("Nextdate");

if($mtype==8)//Postback from Nextdate
echo $objUtility->focus("Case_id");

?>
</body>
</html>
