<html>
<head>
<title>Issue Common Notice </title>
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
else
myform.Receipt_no.disabled=true;    
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
if (i==1)
{
myform.action="InterestNotice.php?tag=2&ptype=0&mtype="+i;
myform.submit();
}

if(i==101 || i==102 || i==2) //postback on textbox
{    
myform.action="InterestNotice.php?tag=2&ptype=1&mtype="+i;    
myform.submit();
}

if (i==3)
{
var ind=myform.Vill_code.selectedIndex;
if (ind==1)
{    
myform.action="InterestNotice.php?tag=2&ptype=1&mtype="+i;    
myform.submit();
} //ind=1 for New village
}
}
else
{
alert('Invalid Case ID');
myform.Save.disabled=true;
myform.Case_id.focus();
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
//var b=myform.Day.value ;// Primary Key
//var e=myform.Notice_type.selectedIndex ;
//var h=myform.Nextdate.value ;
//var pdate=myform.Pdate.value;
//var ldate=myform.Ldate.value;

    
if ( isNumber(a)==true )//  && isNumber(b)==true && e>0 && isdate(h,1))
{
myform.action="Insert_IntNotice.php";
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
require_once './class/class.bakijai_main.php';
require_once '../class/utility.php';
require_once './class/class.bakijai_casedate.php';
require_once './class/class.noticetype.php';
require_once './class/class.baki_payment.php';

require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
require_once '../class/class.converter.php';
require_once '../class/class.sentence.php';

$objConv=new Converter();
$objSen=new Sentence();

$objUtil=new myutility();

$objBaki_payment=new Baki_payment();
$objBm=new Bakijai_main();

$objUtility=new Utility();

$fullname="";
$father="";

$dis="disabled";
$name="";
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
header( 'Location: mainmenu.php');


//if ($objUtility->checkArea($_SESSION['myArea'], 10)==false) //10 for Issue Notice
//header( 'Location: Mainmenu.php?unauth=1');


$objBakijai_casedate=new Bakijai_casedate();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;
$selected="";
if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
$_SESSION['vname']="";
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[1]="0";//Day
$mvalue[2]="";//Paid_today
$mvalue[3]="";//Pay_date
$mvalue[4]="";//Full_name
$mvalue[5]="";//Full_name_ass
$mvalue[6]="";//Father
$mvalue[7]="";//Father_ass
$mvalue[8]="-1";//Polst_code
$mvalue[9]="-1";//Circle
$mvalue[10]="-1";//Mouza
$mvalue[11]="-1";//Vill_code

}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="0";//Day
$mvalue[2]="";//Paid_today
$mvalue[3]="";//Pay_date
$mvalue[4]="";//Full_name
$mvalue[5]="";//Full_name_ass
$mvalue[6]="";//Father
$mvalue[7]="";//Father_ass
$mvalue[8]="-1";//Polst_code
$mvalue[9]="-1";//Circle
$mvalue[10]="-1";//Mouza
$mvalue[11]="-1";//Vill_code
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";

if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]
$nextdate="";
if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$_SESSION['oldid']=0;
$_SESSION['noticetype']=0;
$_SESSION['vname']="";
// Call $objBakijai_casedate->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]="";//Case_id
// Call $objBakijai_casedate->MaxDay() Function Here if required and Load in $mvalue[1]

$mvalue[1]="";//Day

$mvalue[2]="0";
$mvalue[3]="";//Pay_date
$mvalue[4]="";//Full_name
$mvalue[5]="";//Full_name_ass
$mvalue[6]="";//Father
$mvalue[7]="";//Father_ass
$mvalue[8]="-1";//Polst_code
$mvalue[9]="-1";//Circle
$mvalue[10]="-1";//Mouza
$mvalue[11]="-1";//Vill_code
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]
$casedetail="";
if ($_tag==2)//Post Back 
{
$_SESSION['oldid']=0;   
$_SESSION['noticetype']=0;
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

//Post Back on Select Box Change,Hence reserve the value
//if ($ptype==1)
//{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Case_id']))
$mvalue[0]=$_POST['Case_id'];
else
$mvalue[0]=0;


$tot=$objBakijai_casedate->rowCount("Case_id=".$mvalue[0]);
if($tot>0)
echo $objUtility->alert ("Already Issued Notice-".$tot);

if (isset($_POST['Notice_type']))
$mvalue[2]=$_POST['Notice_type'];
else
$mvalue[2]="";

if (isset($_POST['Nextdate']))
$mvalue[3]=$_POST['Nextdate'];
else
$mvalue[3]=0;

if (isset($_POST['Full_name']))
$mvalue[4]=$_POST['Full_name'];
else
$mvalue[4]="";

if (isset($_POST['Full_name_ass']))
$mvalue[5]=$_POST['Full_name_ass'];
else
$mvalue[5]="";

if (isset($_POST['Father']))
$mvalue[6]=$_POST['Father'];
else
$mvalue[6]="";

if (isset($_POST['Father_ass']))
$mvalue[7]=$_POST['Father_ass'];
else
$mvalue[7]="";

if (isset($_POST['Polst_code']))
$mvalue[8]=$_POST['Polst_code'];
else
$mvalue[8]=0;

if (isset($_POST['Circle']))
$mvalue[9]=$_POST['Circle'];
else
$mvalue[9]=0;


if (isset($_POST['Mouza']))
$mvalue[10]=$_POST['Mouza'];
else
$mvalue[10]=0;


if (isset($_POST['Vill_code']))
$mvalue[11]=$_POST['Vill_code'];
else
$mvalue[11]=-1;
 
if ($mvalue[11]==0)
$selected=" selected";
else
$selected="";

if ($ptype==1) //on postback from textbox
{
if (isset($_POST['Fathername']))
$father=$_POST['Fathername'];
else
$father="";

if (isset($_POST['Fullname']))
$fullname=$_POST['Fullname'];
else
$fullname="";

if ($mtype==101) //Convert Full name
{
$mvalue[5]=$objConv->English2Unicode($fullname);
//$tmp=$objConv->filterEnglish($fullname);
//$mvalue[4]=$objSen->SentenceCase($tmp);
}

if ($mtype==102) //Convert Father name
{
$mvalue[7]=$objConv->English2Unicode($father);
//$tmp=$objConv->filterEnglish($father);
//$mvalue[6]=$objSen->SentenceCase($tmp);
}
   
}


//find if already entered
$mdate=$objUtility->to_mysqldate($_POST['Pdate']);
$objBakijai_casedate->setCase_id($mvalue[0]);
$objBaki_payment->setCase_id($mvalue[0]);
//echo $balance;
$objBm->setCase_id($mvalue[0]);
$mtag=0;

if ($objBm->EditRecord())
{
$casedetail=$objBm->getBank().",".$objBm->getBranch()."/";
$casedetail=$casedetail.$objBm->getCase_no()."/".$objBm->getFin_yr();
   
$amount=$objBm->getAmount();
$name=$objBm->getFull_name();
if ($ptype==0) //Trigeer only onchange event from caseid box
{    
if ($objBm->getDisposed()=='N')
{    
$str="This case is not yet disposed";
echo $objUtility->alert ($str) ; 
$mtag++;
}

if ($objBm->getCourt_case()=='Y')
{    
$str="This is Running in Court";
echo $objUtility->alert ($str) ; 
$mtag++;
}
}//ptype==0


if($ptype==0) //edit
{
$mvalue[4]=$objBm->getFull_name();//Full_name
$mvalue[5]=$objBm->getFull_name_ass();//Full_name_ass
$mvalue[6]=$objBm->getFather();//Father
$mvalue[7]=$objBm->getFather_ass();//Father_ass
$mvalue[8]=$objBm->getPolst_code();//Polst_code
$mvalue[9]=$objBm->getCircle();//Circle
$mvalue[10]=$objBm->getMouza();//Mouza
$mvalue[11]=$objBm->getVill_code();//Vill_code
$_SESSION['vname']=$objBm->getVillage();
}//ptype==0
}//if $objBm->Editrecord
else
{
$str="This ID is not Available";
echo $objUtility->alert($str); 
$mtag++;
}

if ($mtag==0)
$dis="";
else
$dis=" disabled";

//$last_date=$objUtility->to_date($objBaki_payment->LastPayDate($mvalue[0]));
$lastinst=$objBakijai_casedate->LastDay($mvalue[0]);
$mvalue[1]=$lastinst+1;

$objBakijai_casedate->setDay($mvalue[1]);

if ($objBakijai_casedate->EditRecord()) //already entered for today
{   
$_SESSION['update']=1; 
$mvalue[2]=$objBakijai_casedate->getNotice_type();
$mvalue[3]=$objUtility->to_date($objBakijai_casedate->getNext_date());
//alerta an message for already paid
if ($ptype==0)
{
$str="You have Already Issued Notice for ".$mvalue[3]."(You may just update data)";
echo $objUtility->alert($str);
}

}
else //find data for previous installment
{
$_SESSION['update']=0;
//$mvalue[2]="";
//$mvalue[3]="";
} //editrecord
$paid=$objBaki_payment->LastPaid($mvalue[0]);
$balance=$objBaki_payment->LastBalanecAmount($mvalue[0]);
$casedetail=$casedetail." Balance <b>Rs.".$objUtil->convert2standard($balance);
$nextdate=$objBaki_payment->NextCallDate($mvalue[0]); 
$date1=date('Y-m-d');
//echo $objUtility->dateDiff($date1,$nextdate)."<br>";
//echo $nextdate;
if (strlen($nextdate)<8)
$nextdate="NA";    
else
{    
if ($ptype==0 && $objUtility->dateDiff($nextdate,$date1)>0)
{
$str="Cannot issue Notice as Due date is far ahead";
echo $objUtility->alert($str);
$dis=" disabled";
}
} //strlen(nextdate<8
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform   method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>Generate and Update Notice<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Case ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Case_id" id="Case_id" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2),redirect(1)" >
<font color=red size=4 face=arial><b>*</b></font>
</td>
<?php $i++; //Now i=1?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Current Notice No.</font></td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=8 name="Day" id="Day" value="<?php echo $mvalue[1];?>" onfocus="ChangeFocus('Paid_today')"  onblur="ChangeColor('Day',2)" readonly>
<font color=black size=2 face=arial><b>
<?php echo $mvalue[1];?>    
    
</b></font>
</td>
</tr>
<?php $i++; //Now i=2
$objN=new Noticetype();
$objN->setCondString("Code=6");
$row=$objN->getRow();
?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Notice Type</font></td><td align=left bgcolor=#FFFFCC>
<select name=Notice_type style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Code'])
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Noticedetail'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Noticedetail'];
}
} //for loop
?>
</select>
     
</td>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Last Due Date</font></td><td align=left bgcolor=#FFFFCC>
<?php echo $objUtility->to_date($nextdate) ;?>
</td>
</tr>
<?php $i++; 
//echo $i.".".$mvalue[$i]
//Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Next Calling Date</font></td><td align=left bgcolor=#FFFFCC colspan="3">
<input type=text size=10 name="Nextdate" id="Nextdate" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Nextdate',1)"  onblur="ChangeColor('Nextdate',2)" disabled>
<font size=1 face=arial color=blue></font>
<font size=2 face=arial color=red>
<?php echo $casedetail;?>
</td>
</tr>
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
<input type=hidden size=10 name=Ldate id=Ldate value="<?php echo $last_date; ?>">
<input type=hidden size=10 name=Balance id=Balance value="<?php echo $balance; ?>">

<input type=button value=Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Case_id')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td>
<td align=center bgcolor=#FFFFCC colspan="2" >
    <font face="arial" size="2" color="blue">
 <?PHP
if ($_SESSION['oldid']>0) 
{
?>
<a href="GenerateInterestNotice.php?id=<?php echo $_SESSION['oldid'];?>"   target=_blank>Generate Show Cause Notice for Case ID-<?php echo $_SESSION['oldid'];?></a>
<?PHP } 
?>   
  
</td></tr>
</tr>
<tr><td align="center" colspan="4" bgcolor="#CCCC99">
        <input type=checkbox name="detail" id="detail" style="font-family: Arial;background-color:green;color:black; font-size: 12px"  checked="check">
<font face="arial" size="3" color="black">
Update Following Particulars if necessary
&nbsp;&nbsp;<font face="arial" size="2" color="black">
<a href="../Keyboard.htm" target="blank">Assamese Key Layout</a>
</td></tr>
<tr><td colspan="4" align="center">
<table border="1" width="100%">
<?php 
$i=3;
$i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Type Name</font></td><td align=left bgcolor=#FFFFCC colspan="3">
<input type=text size=40 name="Fullname" id="Fullname" value="<?php echo $fullname; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=50 onfocus="ChangeColor('Fullname',1)"  onblur="ChangeColor('Fullname',2)" onchange="redirect(101)">
<font color=green size=2 face=arial>
This Text will be converted to Unicode and Proper English
</font>
</td>
</tr>
<tr>
<td align=right bgcolor=#FFCCCC><font color=black size=2 face=arial>Full_name</font></td><td align=left bgcolor=#FFCCCC>
<input type=text size=40 name="Full_name" id="Full_name" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Full_name',1)"  onblur="ChangeColor('Full_name',2)" disabled>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFCCCC><font color=black size=2 face=arial>Full Name(Ass)</font></td><td align=left bgcolor=#FFCCCC>
<input type=text size=25 name="Full_name_ass" id="Full_name_ass" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" maxlength=100 onfocus="ChangeColor('Full_name_ass',1)"  onblur="ChangeColor('Full_name_ass',2)" >
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Type Name</font></td><td align=left bgcolor=#FFFFCC colspan="3">
<input type=text size=40 name="Fathername" id="Fathername" value="<?php echo $father; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=50 onfocus="ChangeColor('Fathername',1)"  onblur="ChangeColor('Fathername',2)" onchange="redirect(102)">
<font color=green size=2 face=arial>
This Text will be converted to Unicode and Proper English
</font>
</td>
</tr>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFCCCC><font color=black size=2 face=arial>Father</font></td><td align=left bgcolor=#FFCCCC>
<input type=text size=40 name="Father" id="Father" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50   onblur="ChangeColor('Father',2)" disabled>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=7?>
<td align=right bgcolor=#FFCCCC><font color=black size=2 face=arial>Father(Ass)</font></td><td align=left bgcolor=#FFCCCC>
<input type=text size=25 name="Father_ass" id="Father_ass" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" maxlength=100  onblur="ChangeColor('Father_ass',2)" >
</td>
</tr>
<?php $i++; //Now i=8?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Police Station</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objPolice_station=new Police_station();
$objPolice_station->setCondString(" code>0" ); //Change the condition for where clause accordingly
$row=$objPolice_station->getRow();
?>
<select name=Polst_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=9?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Circle</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objCircle=new Circle();
$objCircle->setCondString("Cir_code>0" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name=Circle style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(2)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Cir_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=10?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Mouza</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objMouza=new Mouza();
$objMouza->setCondString("mouza_code>0 and Cir_code=".$mvalue[9]); //Change the condition for where clause accordingly
$row=$objMouza->getRow();
?>
<select name=Mouza style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<option Selected value="0">Not Available
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Mouza_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Mouza_code'];?>"><?php echo $row[$ind]['Mouza_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Mouza_code'];?>"><?php echo $row[$ind]['Mouza_name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //echo $i.".".$mvalue[$i];//Now i=11?>
<td align=left colspan="2" bgcolor=#FFFFCC><font color=black size=2 face=arial>Village</font>
<?php 
$objVillage=new Village();
$objVillage->setCondString("Cir_code=".$mvalue[9]." order by vill_name" ); //Change the condition for where clause accordingly
$row=$objVillage->getRow();
?>
<select name=Vill_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:200px" >
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[11]==$row[$ind]['Vill_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name']."[".$row[$ind]['Vill_name_ass']."]";?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name']."[".$row[$ind]['Vill_name_ass']."]";
}
} //for loop
?>
</select>
<font color=blue size=1 face=arial>
<?php echo $_SESSION['vname'];?>
</font>
</td>
</tr>            
            
            
        </table>
        
        
        
    </td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Day");

if($mtype==1)//Postback from Case_id
echo $objUtility->focus("Day");

if($mtype==2)//Postback from Day
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

if (isset($_SESION['alert']))
{
if (strlen($_SESION['alert'])>0)
echo $objUtility->alert($_SESION['alert']);
}    
   
if ($mtype==101)
echo $objUtility->focus("Fathername");    

if ($mtype==102)
echo $objUtility->focus("Polst_code");

?>
</body>
</html>
