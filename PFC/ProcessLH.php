<html>
<head>
<title>Legal Heir</title>
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
myform.Pet_yr.focus();
}

function redirect(i)
{
myform.action="ProcessLH.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";

var a_index=myform.Pet_yr.selectedIndex;
var b_index=myform.Pet_no.selectedIndex;
var d=myform.Nos.value;

//alert(isNumber(d));

if (a_index>0  && b_index>0  && isNumber(d))
{
if (parseInt(d)>0)
{
myform.action="DetailEntryLH.php?tag=0";
myform.submit();
}
else
{
alert('Enter No of NOK') ;   
myform.Nos.focus();
}
}
else
alert('Invalid Data');
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


//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once '../class/class.officer.php';
require_once './class/class.petition_type.php';
require_once 'header.php';

$objUtility=new Utility();

$Fees=0;
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 14)==false) //14 for Process Legal Heir
header( 'Location: Mainmenu.php?unauth=1');


$objPm=new Petition_master();
$offname="";
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>3)
$_tag=0;

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
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="";//Pet_yr
$mvalue[1]="0";//Pet_no
$mvalue[2]="0";//O_code
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
$mvalue[0]="";//Pet_yr
// Call $objPm->MaxPet_no() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Pet_no
// Call $objPm->MaxO_code() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//O_code
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
if (isset($_POST['Pet_yr']))
$mvalue[0]=$_POST['Pet_yr'];
else
$mvalue[0]=0;

if (isset($_POST['Pet_no']))
$mvalue[1]=$_POST['Pet_no'];
else
$mvalue[1]=0;

if (!is_numeric($mvalue[1]))
$mvalue[1]=-1;
if (isset($_POST['O_code']))
$mvalue[2]=$_POST['O_code'];
else
$mvalue[2]=0;

if (!is_numeric($mvalue[2]))
$mvalue[2]=-1;
} //ptype=1

//FEES
$Fees=0;
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<tr><td colspan=2 align=Center bgcolor=#6699CC><font face=arial size=3>PROCESS LEGAL HEIR PETITION<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Year</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$row=$objPm->getYearList();
?>
<select name=Pet_yr style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px" onchange=redirect(1)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[0]==$row[$ind])
{
?>
<option selected value="<?php echo $row[$ind];?>"><?php echo $row[$ind];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind];?>"><?php echo $row[$ind];
}
} //for loop
?>
</select>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Petition No</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objPm->setCondString(" Ast='N' and pet_type='LH'  and Pet_yr='".$mvalue[0]."' order by Pet_no desc" ); //Change the condition for where clause accordingly
$row=$objPm->getRow();
?>
<select name=Pet_no style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:200px" onchange=redirect(2)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$PETNUMBER=$row[$ind]['Xid'];
if (strlen($PETNUMBER)<2)
$PETNUMBER=$row[$ind]['Pet_no'];    
if ($mvalue[1]==$row[$ind]['Pet_no'])
{
?>
<option selected value="<?php echo $row[$ind]['Pet_no'];?>"><?php echo $PETNUMBER;?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Pet_no'];?>"><?php echo $PETNUMBER;
}
} //for loop
?>
</select>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php //Dwetail table>?>
<tr><td colspan="2" bgcolor="#CCFFFF">
<?php
if($_tag==2 && $mtype==2) //Postback on Petition No
{
if (isset($_POST['Pet_yr']))
$pkarray[0]=$_POST['Pet_yr'];
else
$pkarray[0]=0;

if (isset($_POST['Pet_no']))
$pkarray[1]=$_POST['Pet_no'];
else
$pkarray[1]=0;

$objPm->setPet_yr($pkarray[0]);
$objPm->setPet_no($pkarray[1]);

$mvalue[0]=$pkarray[0];//Pet_yr
$mvalue[1]=$pkarray[1];
//$mvalue[2]=$_POST['O_code'];
//$_SESSION['mvalue']=$mvalue;
if ($objPm->EditRecord()) //i.e Data Available
{
$_SESSION['Applicant']=$objPm->getApplicant();    
$objPt=new Petition_type();
$objPt->setCode($objPm->getPet_type());
if($objPt->EditRecord())
{
$cert=$objPt->getAbvr();
$Fees=$objPt->getFees();
if ($Fees==0) //Set by Processor Assistant like Jambandi
$Fees=$objPm->getFees ();
}
else
$cert="";    
$by="";
$eby=" By  ".$objPm->getEntered_by();

if ($objPm->getAst()=="Y")
$by=" By ".$objPm->getProcessed_by();

//if ($objPm->getBo()=="Y")
//$by=$by." and BO [".$objPm->getBo_name()."]";

if ($objPm->getStatus()=="Issued")
$status="Issued on ".$objUtility->to_date ($objPm->getIssue_date());    
else
$status=$objPm->getStatus();  

if ($objPm->getBo()=="Y")
$offname=$objPm->getBo_name();
else
$offname="";    
?>
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<tr><td colspan=2 align=Center bgcolor=#CCFF99><font face=arial size=2>DETAIL OF PETITION </font></td></tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Name of Applicant</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPm->getApplicant();?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Certificate Type</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $cert;?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Forwarded on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objUtility->to_date($objPm->getPet_date()).$eby;?></font></td>
</tr> 
<tr>
<td width="30%" align=right><font face=arial size=2>Village</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPm->getVillage() ;?></font></td>
</tr>    
</table>    
  
<?php
}//EDITRECORD
}//$_tag==2 && mtype==2
        
?>      
</td></tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter No of NOK</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=6 name="Nos" id="Nos" value="0" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold" maxlength=70 onfocus="ChangeColor('Nos',1)"  onblur="ChangeColor('Nos',2)">

</td></tr>    
<?php $i++; //Now i=3?>
<tr><td align=right bgcolor=#FFFFCC>

</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="Detail Entry"  name=Save onclick=validate()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#CC66FF;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">
</td></tr>
</table>
</form>
<?php
//POSTBACK


if($mtype==100)//Postback from Pet_no
echo $objUtility->alert("Updated Jama Fees");
    
    
?>
</body>
</html>
