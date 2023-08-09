<html>
<head>
<title>Process Non Creamy Certificate</title>
</head>
<script language=javascript>
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Pet_no.value=mvalue;

var b=myform.Pet_yr.value ;//Primary Key
var e=myform.Pet_no.value ;//Primary Key
if ( b!="" && isNaN(e)==false && e!="")
{
myform.action="Form_petition_master.php?tag=2&ptype=0";
myform.submit();
}
}

function direct1()
{
var i;
i=0;
}

function enu()
{
var i=myform.Accept.checked;

if (i==true)
{
myform.Ast_report.disabled=false;
myform.Subcaste.disabled=false;
//myform.Caste.visible=false;
myform.Save.disabled=false;
myform.Rej.disabled=true;
myform.Rejected_reason.disabled=true;
myform.Save.value="Accept Petition"
}   
else
{
myform.Ast_report.disabled=true;
myform.Subcaste.disabled=true;
//myform.Caste.visible=true;
myform.Save.disabled=true;
myform.Rej.disabled=false;
myform.Rejected_reason.disabled=false;  
}
}


function setMe()
{
myform.Pet_yr.focus();
}

function redirect(i)
{
}


function validate()
{
var i=myform.Accept.checked;

if (i==true)
{
var a=myform.Ast_report.value ;
var a_length=parseInt(a.length);
var b=myform.Caste.selectedIndex;
var c=myform.Subcaste.selectedIndex;
var d=myform.Income.value;

if ( notNull(a) && validateString(a) && a_length<200 && b>0 && c>0 && Number(d)>0)
{
myform.action="ProcessNC.php?tag=2";
myform.submit();    
}
else
alert('Insufficient Data');
}
else //rejected Application
{
var a=myform.Rejected_reason.value;
var a_length=parseInt(a.length);  
if ( notNull(a) && validateString(a) && a_length<100 )
{
var name = confirm("Reject Petition?")
if (name == true)
{
myform.action="ProcessNC.php?tag=2";
myform.submit();       
}
}
else
alert('Insufficient Data(Enter Rejection Reason');
} //i==true

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
} //End date validation


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
}//End date Comparison



function home()
{
window.location="mainmenu.php?tag=1";
}

function back()
{
window.location="PetitionList.php?tag=0";
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

function enuName()
{
document.getElementById('Applicant').disabled=false;
document.getElementById('Father').disabled=false;
document.getElementById('Mother').disabled=false;
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once './class/class.subcaste.php';
require_once '../xohari/class/Class.service_request.php';
require_once '../xohari/class/Class.service_enclosure.php';

$PetitionRejected=false;
$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 8)==false) //8 for Process Certificate like PRC/caste and Non Creamy
header( 'Location: Mainmenu.php?unauth=1');

$objPetition_master=new Petition_master();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;

if ($_tag==2)
require_once 'header.php';

if (isset($_GET['yr']))
$Pet_yr=$_GET['yr'];
else
$Pet_yr=0;

if (isset($_SESSION['username']))
$username="Assistant Name-".$_SESSION['username'];
else 
$username="";


if (isset($_GET['pno']))
$Pet_no=$_GET['pno'];
else
$Pet_no=0;

if (!is_numeric($Pet_yr))
$Pet_yr=0;

if (!is_numeric($Pet_no))
$Pet_no=0;


$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();


if ($_tag==0) //Initial Page Loading hence Edit Row
{
$objPetition_master->setPet_yr($Pet_yr);
$objPetition_master->setPet_no($Pet_no);

if ($objPetition_master->EditRecord()) //i.e Data Available
{ 
$mvalue[2]=strtoupper($objPetition_master->getApplicant());
$mvalue[3]=strtoupper($objPetition_master->getFather());
$mvalue[4]=strtoupper($objPetition_master->getMother());
$mvalue[5]=strtoupper($objPetition_master->getVillage());
$mvalue[6]=$objPetition_master->getAst_report();
$mvalue[7]=$objPetition_master->getRejected_reason();
$mvalue[8]=$objPetition_master->getCaste();
$mvalue[9]=$objPetition_master->getSubcaste();
$mvalue[10]=0;//last Select Box for Editing
$xid=$objPetition_master->getXohari_requestid();

$objPt=new Petition_type();
$objPt->setCode($objPetition_master->getPet_type());
if ($objPt->EditRecord())
$serviceId=$objPt->getXohari_serviceid ();
else
$serviceId=0;


if (strlen($xid)>2)
$_SESSION['msg']="Petition No:".$xid;
else
$_SESSION['msg']="Petition No:".$Pet_no."/".$Pet_yr;


if ($objPetition_master->getAst()=="Y" || $objPetition_master->getStatus()!="Pending" || $objPetition_master->getPet_type()!="NC")
header( 'Location: PetitionList.php?tag=0');  
} //EditRecord()    
else 
header( 'Location: PetitionList.php?tag=0');     
}//tag=0[Initial Loading]



if ($_tag==2)//Post Back on Submit Button Update Petition Table
{

//New Line 07-11-2013
if(isset($_POST['Applicant']))
$Applicant=$_POST['Applicant'];
else
$Applicant="";
if(isset($_POST['Father']))
$Father=$_POST['Father'];
else
$Father="";
if(isset($_POST['Mother']))
$Mother=$_POST['Mother'];
else
$Mother="";
//End New Line


if (isset($_POST['Pet_no']))
$Pet_no=$_POST['Pet_no'];
else
$Pet_no=0;

if (isset($_POST['Pet_yr']))
$Pet_yr=$_POST['Pet_yr'];
else
$Pet_yr=0;

if($Pet_no==0 || $Pet_yr==0)
header( 'Location: PetitionList.php?tag=0'); 

if (isset($_SESSION['username']))
$user=$_SESSION['username'];
else
$user="";   
//echo $Pet_no."/".$Pet_yr;    
$objPetition_master->setPet_yr($Pet_yr);
$objPetition_master->setPet_no($Pet_no);

if ($objPetition_master->EditRecord())
{
if($objPetition_master->getPet_type()!="NC")
header( 'Location: PetitionList.php?tag=0');

$xid=$objPetition_master->getXohari_requestid();
if (strlen($xid)>3)
$pno=$xid;
else
$pno=$Pet_no."/".$Pet_yr;   
}
else
header( 'Location: PetitionList.php?tag=0'); 
    
    //$pno=$Pet_no."/".$Pet_yr;
    
$objPetition_master->setAst("Y") ;
$objPetition_master->setProcessed_by($user);
$objPetition_master->setProcess_date(date('Y-m-d'));

$myTag=0;
$Err="";
//Capture PostBack Field
if (isset($_POST['Ast_report'])) //If HTML Field is Availbale
{
$Ast_report=$_POST['Ast_report'];
if ($objUtility->validate($Ast_report,150)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($Ast_report)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Assistant Report";
}

if (strlen($Ast_report)==0)
{
$Ast_report="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$Ast_report="NULL";

if (isset($_POST['Rejected_reason'])) //If HTML Field is Availbale
{
$Rejected_reason=$_POST['Rejected_reason'];
if ($objUtility->validate($Rejected_reason,150)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($Rejected_reason)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Rejected Reason";
}

if (strlen($Rejected_reason)==0)
{
$Rejected_reason="NULL";
}
}
else
$myTag++;
}
else //Post Data Not Available
$Rejected_reason="NULL";

if (isset($_POST['Caste'])) //If HTML Field is Availbale
$Caste=$_POST['Caste'];
else //Post Data Not Available
$Caste="NULL";

if (isset($_POST['Subcaste'])) //If HTML Field is Availbale
$Subcaste=$_POST['Subcaste'];
else //Post Data Not Available
$Subcaste="NULL";

if (isset($_POST['Income'])) //If HTML Field is Availbale
$Income=$_POST['Income'];
else //Post Data Not Available
$Income="NULL";




//construct Enclosure String
$str="";
if (isset($_POST['TotEncl']))
{
for ($i=1;$i<=$_POST['TotEncl'];$i++) 
{
$Encl="Enclosure".($i);  
if (isset($_POST[$Encl]))
{    
$str=$str.$_POST[$Encl]; 
$str=$str.",";
}
}//for loop
}//if isset(Encl)
//End enclosure
$str=substr($str,0,strlen($str)-1);
//echo $str;

if (isset($_POST['Accept'])) //Petition Accepted
{
$PetitionRejected=false;    
$objPetition_master->setStatus("Processed"); 
$objPetition_master->setAst_report($Ast_report);
$objPetition_master->setSubcaste($Subcaste);
$objPetition_master->setCaste($Caste);
$objPetition_master->setIncome($Income);
$objPetition_master->setEnclosure($str);
}
else //Petition Rejected
{
$PetitionRejected=true;    
$objPetition_master->setRejected_reason($Rejected_reason);
$objPetition_master->setStatus("Rejected");    
}
//End Capture
if ($myTag==0)
{    
if ($objPetition_master->UpdateRecord()) //Success
{
$line=$objPetition_master->returnSql;
//$objUtility->saveSqlLog("Petition_master", $line);
$objUtility->CreateLogFile("Petition_master", $line, 2, "M");

$objUtility->Backup2Access("", $line);
$plink="NCL.php?tag=0";
$plink=$plink."&yr=".$Pet_yr."&pno=".$Pet_no;    

//New Line 7-11-2013
$objPetition_master->RecordOrigin($Pet_yr,$Pet_no,$Applicant,$Father,$Mother);
?>
    
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=50%>
<form name=myform action=""  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Successfully Processed <br>Petition No <b><?php echo $pno;?></b> for Non Creamy Certificate<b></font></td></tr>
<tr><td align=Center>
<?php 
if ($PetitionRejected==false)
{
?>
<font size=3 face=arial color=blue><A HREF="<?php echo $plink;?>" target="_blank">Print Certificate</font></a>
<?php
}
else{
echo "<font size=3 face=arial color=red>Petition Rejected </font>"   ;
}
?>
    </td>        
<td align=Center>
<font size=3 face=arial color=blue><A HREF="PetitionList.php">Back to Selection</font></a>
</td></tr>
</table>    
<?php
}
else 
{
echo "<p align=center><font size=4 face=arial color=blue>Failed to Update Retry<br></font>";
echo "<font size=4 face=arial color=blue><A HREF=".$plink.">Back</font></a></p>";
} 
//echo $objPetition_master->returnSql;
} //$mytag==0
else
{
echo $objUtility->alert($Err);
$plink="ProcessPRC.php?tag=0";
$plink=$plink."&yr=".$Pet_yr."&pno=".$Pet_no;
echo "<p align=center><font size=4 face=arial color=blue><A HREF=".$plink.">Back</font></a></p>";
}
} //tag==2


$i=0;
//Start of FormDesign
if ($_tag==0)
{    
?>
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=""  method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>PROCESS NON CREAMY LAYER CERTIFICATE<br><b><font color="#CC66FF"><?php echo  $_SESSION['msg'] ?></b></font>
<input type=hidden size=10 name=Pet_no value="<?php echo $Pet_no ?>">
<input type=hidden size=10 name=Pet_yr value="<?php echo $Pet_yr ?>">
</td></tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC width="20%"><font color=black size=2 face=arial>Applicant Name</font></td><td align=left bgcolor=#FFFFCC width="30%">
<input type=text size=30 name="Applicant" id="Applicant" value="<?php echo $mvalue[2]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 12px" maxlength=70 onfocus="ChangeColor('Applicant',1)"  onblur="ChangeColor('Applicant',2)" disabled>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=3?>
<td align=right bgcolor=#FFFFCC width="20%"><font color=black size=2 face=arial>Father's Name</font></td><td align=left bgcolor=#FFFFCC width="30%">
<input type=text size=30 name="Father" id="Father" value="<?php echo $mvalue[3]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 12px" maxlength=60 onfocus="ChangeColor('Father',1)"  onblur="ChangeColor('Father',2)" disabled>
</td>
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Mother's Name</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=30 name="Mother" id="Mother" value="<?php echo $mvalue[4]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 12px" maxlength=50 onfocus="ChangeColor('Mother',1)"  onblur="ChangeColor('Mother',2)" disabled>
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Village/Town</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=30 name="Village" id="Village" value="<?php echo $mvalue[5]; ?>" style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 12px" maxlength=50 onfocus="ChangeColor('Village',1)"  onblur="ChangeColor('Village',2)" disabled>
</td>
</tr>
<tr><td colspan=4 align=Center bgcolor=#ccffcc>
<input type=button value="Edit Detail"  name=ed1 onclick=enuName()  style="font-family:arial; font-size: 10px ;font-weight:bold; background-color:white;color:black;width:80px" >
</td></tr>

</table>
<br>  
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr>
<td  align=Center bgcolor=#ccffcc>  
<input type="checkbox" name="Accept" onclick="enu()">Accept
</td>    
<td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=2><b>ASSISTANT PART FOR DATA ENTRY</font><font color="blue" size="2">&nbsp;&nbsp;<?php echo $username;?></td></tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Caste</font></td><td align=left bgcolor=#FFFFCC>
<select name="Caste" id="Caste" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold;width:160px">
 <option value=""><-Select->
<option value="SC">SC
<option value="ST">ST
<option value="OBC">OBC  
<option value="MOBC">MOBC      
</select>    
</td>
<?php $i++; //Now i=9?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Sub Caste</font></td><td align=left bgcolor=#FFFFCC>
<select name=Subcaste>
<option value=""><-Select->
<?php
$objSc=new Subcaste();
$objSc->setCondString(" 1=1 order by detail");
$row=$objSc->getRow();
for($i=0;$i<count($row);$i++)
{
$val=$row[$i]['Detail'];
?>
<option value="<?php echo $val;?>"><?php echo $val;?>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Yearly Income</font></td><td align=left bgcolor=#FFFFCC>
<input type="text" size="8" name="Income" id="Income" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold;">
 </td>
<td colspan="2" bgcolor=#FFFFCC> &nbsp;</td></tr>

<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Assistant Report<br>(Max 200 Character)</font></td><td align=left bgcolor=#FFFFCC>
<textarea  name="Ast_report" id="Ast_report" rows="5" cols="40"  style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=200 onfocus="ChangeColor('Ast_report',1)"  onblur="ChangeColor('Ast_report',2)" disabled>
</textarea>

</td>
<?php $i++; //Now i=7?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Rejection Reason<br>(Max 100 Character)</font></td><td align=left bgcolor=#FFFFCC>
<textarea name=Rejected_reason rows=5 cols=30 style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=100 onfocus="ChangeColor('Rejected_reason',1)"  onblur="ChangeColor('Rejected_reason',2)">
</textarea>
</td>
</tr>

<?php $i++; //Now i=8?>

<?php $i++; //Now i=10?>
<tr><td align=right bgcolor=#FFFFCC>

</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=10 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="Submit Data"  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:#669966;color:blue;width:120px" disabled>
<input type=button value=Back  name=back1 onclick=back() onfocus="ChangeFocus('Pet_yr')" style="font-family:arial; font-size: 14px ; background-color:#FF9933;color:blue;width:100px">
</td><td align=left bgcolor=#FFFFCC >&nbsp;</td>
<td align=left bgcolor=#FFFFCC >
 <input type=button value="Reject Petition"  name=Rej onclick=validate()  style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:#669966;color:blue;width:120px" >
 <input type=button value=Menu  name=back2 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">

</td>    
</tr>
</table>
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<tr><td align=center bgcolor=#FFFFCC colspan="2">
<font color=black size=2 face=arial><b>Select List of Enclosure submitted with Application
</td></tr>

<?php
$objEnc=new Service_enclosure();
$objEnc->setCondString(" Service_id=".$serviceId);
$row=$objEnc->getRow();
for($i=0;$i<count($row);$i++)
{
$Encl="Enclosure".($i+1);   
?>
<tr><td align="center" width="10%" bgcolor=#CCFFFF>    
   
<input type="checkbox" name="<?php echo $Encl;?>" value="<?php echo $row[$i]['Id'];?>">
</td>
<td align=left bgcolor=#CCFFFF width="90%" valign="top">
<font face="arial" size="2"> 
    <?php   
echo $row[$i]['Name']."&nbsp;&nbsp;<br>";
?>
</td></tr>      
<?php
}
?>    
<input type="hidden" name="TotEncl"  value="<?php echo $i;?>">
</table>
</form>
<?php
}//$_tag==0
?>
</body>
</html>
