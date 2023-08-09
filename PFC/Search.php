<html>
<head>
<title>Search Petition Status</title>
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
var i=myform.Pet_no.value;
var mylength=parseInt(i.length);
if(isNumber(i)==true)
{
myform.Save1.disabled=false;
myform.Save2.disabled=true;
}    
}

function direct2()
{
var i=myform.nPet_no.value;
var mylength=parseInt(i.length);
if(isNumber(i)==true && parseInt(i)>0)
{
myform.Save2.disabled=false;
myform.Save1.disabled=true;
}    
}



function setMe()
{
myform.Pet_yr.focus();
}

function redirect(i)
{
}

function validate(mtag)
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
var b=myform.Pet_yr.value ;// Primary Key
var b_length=parseInt(b.length);
if (mtag==1)
var e=myform.Pet_no.value ;// Primary Key
else
var e=myform.nPet_no.value ; 
   
if ( notNull(b) && validateString(b) && b_length<=4 && (isNumber(e)==true))
{
myform.action="Search.php?tag=2&mtag="+mtag;
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
require_once './class/class.petition_type.php';
require_once '../class/class.PWD.php';
require_once 'header.php';
$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: index.php');

$objPetition_master=new Petition_master();

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
$pkarray=array();


if (isset($_SESSION['mvalue']))
$mvalue=$_SESSION['mvalue'];
else
{
$mvalue[0]=date('Y');//Pet_yr
$mvalue[1]=""; 
$mvalue[2]=""; 
}


if ($_tag==0) //Initial Page Loading
{
$mvalue[0]=date('Y');//Pet_yr
$mvalue[1]="";//Pet_no
$mvalue[2]="";
}//tag=0[Initial Loading]


if ($_tag==2)//Post Back 
{
    
if (isset($_GET['mtag']))  
$mtag=$_GET['mtag'];

if(!is_numeric($mtag))
$mtag=1;
if ($mtag>2)
$mtag=1;

//echo $mtag;

if (isset($_POST['Pet_yr']))
$pkarray[0]=$_POST['Pet_yr'];
else
$pkarray[0]=0;


if ($mtag==1) //old Petition No
{
if (isset($_POST['Pet_no']))
$pkarray[1]=$_POST['Pet_no'];
else
$pkarray[1]=0;
$pno=$pkarray[1]."/".$pkarray[0];
}
else //New ARTPS No hnce retrive old value
{
$xid="NLB/REV/01/".$_POST['nPet_no']."/".$_POST['Pet_yr'];
//echo $xid."<br>";
$pno=$xid;
if ($objPetition_master->EditXohari($xid))
{
$pkarray[1]=$objPetition_master->getPet_no();
}
else
header( 'Location: Search.php?tag=0');    
}
//echo $objPetition_master->returnSql."<br>";
//echo $pkarray[0]."/".$pkarray[1];
//echo "petno=".$pkarray[1]."<br>";
$objPetition_master->setPet_yr($pkarray[0]);
$objPetition_master->setPet_no($pkarray[1]);

$mvalue[0]=$pkarray[0];//Pet_yr
$mvalue[1]=$pkarray[1];
$mvalue[2]=$_POST['nPet_no'];
$_SESSION['mvalue']=$mvalue;
}//$_tag==2 
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<form name=myform action=insert_petition_master.php  method=POST >
<tr><td colspan=3 align=Center bgcolor=#ccffcc><font face=arial size=3>SEARCH STATUS OF PETITION</font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial>Enter Year</font></td><td align=left bgcolor=white colspan="2">
<input type=text size=4 name="Pet_yr" id="Pet_yr" value="<?php echo $mvalue[0]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 18px" maxlength=4 onfocus="ChangeColor('Pet_yr',1)"  onblur="ChangeColor('Pet_yr',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial>Enter Petition No</font></td><td align=left bgcolor=white>
<input type=text size=12 name="Pet_no" id="Pet_no" value="<?php echo $mvalue[1]; ?>"  style="font-family: Arial;background-color:#66CC99;color:black; font-size: 18px" onfocus="ChangeColor('Pet_no',1)"  onblur="ChangeColor('Pet_no',2)" onchange=direct1()>
</td>
<td align=left bgcolor=white>
<input type=button value=Search  name=Save1 onclick=validate(1)  style="font-family:arial; font-size: 14px;font-weight:bold ; background-color:#66CC99;color:blue;width:100px" disabled>
</td>
</tr>
<tr><td align="center" colspan="2">
<font color=red size=2 face=arial>OR
    </td><td>&nbsp;</td></tr>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial> Enter New ARTPS No(Numeric Part)</font></td><td align=left bgcolor=white>
<input type=text size=8 name="nPet_no" id="nPet_no" value="<?php echo $mvalue[2]; ?>"  style="font-family: Arial;background-color:white;color:black; font-size: 18px" onfocus="ChangeColor('nPet_no',1)"  onblur="ChangeColor('nPet_no',2)" onchange=direct2()>
</td>
<td align=left bgcolor=white>
<input type=button value=Search  name=Save2 onclick=validate(2)  style="font-family:arial; font-size: 14px;font-weight:bold ; background-color:#66CC99;color:blue;width:100px" disabled>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr><td align=right bgcolor=white>

</td><td align=left bgcolor=white>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="font-family:arial; font-size: 14px ; background-color:orange;color:blue;width:100px">
</td></tr>

</table>
</form>
<hr>
<?php
if($_tag==2)
{    
if ($objPetition_master->EditRecord()) //i.e Data Available
{ 
$objPt=new Petition_type();
$objPt->setCode($objPetition_master->getPet_type());
if($objPt->EditRecord())
$cert=$objPt->getAbvr();
else
$cert="";    
$by="";
$eby=" By  ".$objPetition_master->getEntered_by();

if ($objPetition_master->getAst()=="Y")
$by=" By ".$objPetition_master->getProcessed_by();

if ($objPetition_master->getBo()=="Y")
$by=$by." and BO [".$objPetition_master->getBo_name()."]";

if ($objPetition_master->getStatus()=="Issued")
$status="Issued on ".$objUtility->to_date ($objPetition_master->getIssue_date());    
else
$status=$objPetition_master->getStatus();    
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<tr><td colspan=2 align=Center bgcolor=#6699CC><font face=arial size=3>RESULT OF SEARCH <b><?php echo $pno;?></b></font></td></tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Name of Applicant</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPetition_master->getApplicant();?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Certificate Type</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $cert;?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Entered on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objUtility->to_date($objPetition_master->getPet_date()).$eby;?></font></td>
</tr> 
<tr>
<td width="30%" align=right><font face=arial size=2>Processed on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objUtility->to_date($objPetition_master->getProcess_date()).$by;?></font></td>
</tr>    
<tr>
<td width="30%" align=right><font face=arial size=2>Certificate Status</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $status;?></font></td>
</tr> 
    
<?php    
} 
else //data not available for edit
{
echo "<p align=center>Petition No Not Available</p>";
} //EditRecord()
} //tag==2      
?>     
       
</body>
</html>
