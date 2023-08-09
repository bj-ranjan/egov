<html>
<head>
<title>Entry Form for bank_deposit</title>
</head>
<script language=javascript>
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Installment.value=mvalue;

var a=myform.Case_id.value ;//Primary Key
var b=myform.Installment.value ;//Primary Key
if ( isNaN(a)==false && a!="" && isNaN(b)==false && b!="")
{
myform.action="Form_bank_deposit.php?tag=2&ptype=0&mtype=2";
myform.submit();
}
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
if (isNumber(a)==true)
{
myform.action="Form_bank_deposit.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}
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
var b=myform.Installment.value ;// Primary Key
var c=myform.Deposit_date.value ;
var d=myform.Amount.value ;
var e=myform.Collection_book_no.value ;
var e_length=parseInt(e.length);
var f=myform.Collection_rcpt_no.value ;
var f_length=parseInt(f.length);
var g=myform.Bank_rcpt_no.value ;
var g_length=parseInt(g.length);

var pdate=myform.Pdate.value;
var ldate=myform.ldate.value;
var bal=Number(myform.Due.value);

if ( isNumber(a)==true   && isNumber(b)==true   && notNull(c) &&  isdate(c,1) && isNumber(d)==true   && validateString(e) && e_length<=10 && validateString(f) && f_length<=10 && validateString(g) && g_length<=10)
{
//if (d>bal || d<=0)
//alert('Maximum Amount Available is Rs'+bal) 
//else
//if(CompareDate(c,pdate)==1 || CompareDate(c,ldate)==-1)
//alert('Invalid Deposit Date(Should be between '+ldate+" and "+pdate+")");
//else
//{    
myform.action="Insert_bank_deposit.php";
myform.submit();
//}
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
require_once './class/class.bank_deposit.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.baki_payment.php';
require_once 'header.php';
$objBm=new Bakijai_main();
$objBp=new Baki_payment();

$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: Mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 4)==false) //4 for Bank Deposit
header( 'Location: Mainmenu.php?unauth=1');


$objBank_deposit=new Bank_deposit();

$dis=" disabled";

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
$ldate='01/01/1900';
$mvalue=array();
$pkarray=array();

$caseno="";
$name="";
$col="";
$dep="";
$due=0;
if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[7]=0;
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="0";//Installment
$mvalue[2]="";//Deposit_date
$mvalue[3]="";//Amount
$mvalue[4]="";//Collection_book_no
$mvalue[5]="";//Collection_rcpt_no
$mvalue[6]="";//Bank_rcpt_no
$mvalue[7]=0;
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]

if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
// Call $objBank_deposit->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]="0";//Case_id
// Call $objBank_deposit->MaxInstallment() Function Here if required and Load in $mvalue[1]
$mvalue[1]="";//Installment
$mvalue[2]="";//Deposit_date
$mvalue[3]="";//Amount
$mvalue[4]="";//Collection_book_no
$mvalue[5]="";//Collection_rcpt_no
$mvalue[6]="";//Bank_rcpt_no
$mvalue[7]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Case_id']))
$mvalue[0]=$_POST['Case_id'];
else
$mvalue[0]=0;

//if (isset($_POST['Installment']))
//$mvalue[1]=$_POST['Installment'];
//else
$mvalue[1]=$objBank_deposit->maxInstallment($mvalue[0]);

//if (isset($_POST['Deposit_date']))
//$mvalue[2]=$_POST['Deposit_date'];
//else
$mvalue[2]="";

//if (isset($_POST['Amount']))
//$mvalue[3]=$_POST['Amount'];
//else
$mvalue[3]=0;

//if (isset($_POST['Collection_book_no']))
//$mvalue[4]=$_POST['Collection_book_no'];
//else
$mvalue[4]="";

//if (isset($_POST['Collection_rcpt_no']))
//$mvalue[5]=$_POST['Collection_rcpt_no'];
//else
$mvalue[5]="";

//if (isset($_POST['Bank_rcpt_no']))
//$mvalue[6]=$_POST['Bank_rcpt_no'];
//else
$mvalue[6]="";

//if (isset($_POST['Editme']))
//$mvalue[7]=$_POST['Editme'];
//else
$mvalue[7]=0;

$objBp->setCase_id($mvalue[0]);
$objBp->setInstalment_no("1");
$objBm->setCase_id($mvalue[0]);
if ($objBm->EditRecord())
{    
$caseno=$objBm->getBank().",".$objBm->getBranch()."(".$objBm->getCase_no()."/".$objBm->getFin_yr().")";    
$name=$objBm->getFull_name();
}

if ($objBp->EditRecord())
$ldate=$objBp->getPay_date ();
//echo "first-".$ldate."<br>";
$ldate=$objUtility->to_date($ldate);
//echo "last".$ldate;
$col=$objBp->ToalPaid($mvalue[0]);
$dep=$objBank_deposit->ToalPaid($mvalue[0]);
if ($col>0 && ($col-$dep)>0)
$dis="";
$due=$col-$dep;
} //ptype=1


if (isset($_POST['Case_id']))
$pkarray[0]=$_POST['Case_id'];
else
$pkarray[0]=0;
$objBank_deposit->setCase_id($pkarray[0]);
if (isset($_POST['Installment']))
$pkarray[1]=$_POST['Installment'];
else
$pkarray[1]=0;
$objBank_deposit->setInstallment($pkarray[1]);
if ($objBank_deposit->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objBank_deposit->getCase_id();
$mvalue[1]=$objBank_deposit->getInstallment();
$mvalue[2]=$objUtility->to_date($objBank_deposit->getDeposit_date());
$mvalue[3]=$objBank_deposit->getAmount();
$mvalue[4]=$objBank_deposit->getCollection_book_no();
$mvalue[5]=$objBank_deposit->getCollection_rcpt_no();
$mvalue[6]=$objBank_deposit->getBank_rcpt_no();
$mvalue[7]=0;//last Select Box for Editing

$col=$objBp->ToalPaid($mvalue[0]);
$dep=$objBank_deposit->ToalPaid($mvalue[0]);
$due=$col-$dep+$mvalue[3];
$dis="";
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
if ($ptype==0)
{
$mvalue[0]=$pkarray[0];
$mvalue[1]=$pkarray[1];
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]="";
$mvalue[5]="";
$mvalue[6]="";
$mvalue[7]=0;//last Select Box for Editing
}//ptype=0
} //EditRecord()
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=insert_bank_deposit.php  method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>Updation of Bank Deposit<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Case Id</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Case_id" id="Case_id" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2),redirect(1)" >
<font color=red size=4 face=arial><b>*</b></font>
</td>
<?php $i++; //Now i=1?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Installment No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Installment" id="Installment" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Installment',1)"  onblur="ChangeColor('Installment',2)" onchange=direct1() readonly>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Deposit Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Deposit_date" id="Deposit_date" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Deposit_date',1)"  onblur="ChangeColor('Deposit_date',2)">
<font color=red size=3 face=arial>*</font>
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
<?php $i++; //Now i=3?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Amount(in Rs)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Amount" id="Amount" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Amount',1)"  onblur="ChangeColor('Amount',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Collection Book No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Collection_book_no" id="Collection_book_no" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Collection_book_no',1)"  onblur="ChangeColor('Collection_book_no',2)">
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Collection Receipt No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Collection_rcpt_no" id="Collection_rcpt_no" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Collection_rcpt_no',1)"  onblur="ChangeColor('Collection_rcpt_no',2)">
</td>
</tr>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Bank Receipt No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Bank_rcpt_no" id="Bank_rcpt_no" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Bank_rcpt_no',1)"  onblur="ChangeColor('Bank_rcpt_no',2)">
</td>
<td bgcolor=#FFFFCC colspan="2" align="left">
    <font size=2 face=arial>Amount Due-Rs.<?php echo $col-$dep;?>    
<input type="hidden" size="3"name="Due" value="<?php echo $due;?>">
<input type="hidden" size="4" name="ldate" value="<?php echo $ldate;?>">

</td></tr>
<?php $i++; //Now i=7?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=10 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Case_id')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td><td bgcolor=#FFFFCC colspan="2"></td></tr>
<tr><td align=right>
<?php 
$objBank_deposit->setCondString(" case_id=".$mvalue[0]); //Change the condition for where clause accordingly
$row=$objBank_deposit->getRow();
?>
<select name=Editme style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:200px" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Installment'])
{
?>
<option selected value="<?php echo $row[$ind]['Installment'];?>">Inst-<?php echo $row[$ind]['Installment']."] Rs.".$row[$ind]['Amount'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Installment'];?>">Inst-<?php echo $row[$ind]['Installment']."] Rs.".$row[$ind]['Amount'];
}
} //for loop
?>
</select>
</td><td align=left>
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" disabled>
</tr>
<tr><td colspan="4" align="left">
<font size=2 face=arial color=#CC3333>
Case Number-<b><?php echo $caseno?></b><br>
Name-<b><?php echo $name?></b><br>
Total Collected-<b><?php echo $col?></b>&nbsp;&nbsp;
Total Deposited in Bank-<b><?php echo $dep?></b>&nbsp;&nbsp;
</td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Case_id");


if($mtype==1)//Postback from Installment
echo $objUtility->focus("Deposit_date");

if($mtype==2)//Postback from Deposit_date
echo $objUtility->focus("Amount");

if($mtype==4)//Postback from Amount
echo $objUtility->focus("Collection_book_no");

if($mtype==5)//Postback from Collection_book_no
echo $objUtility->focus("Collection_rcpt_no");

if($mtype==6)//Postback from Collection_rcpt_no
echo $objUtility->focus("Bank_rcpt_no");

if($mtype==7)//Postback from Bank_rcpt_no
echo $objUtility->focus("Case_id");

?>
</body>
</html>
