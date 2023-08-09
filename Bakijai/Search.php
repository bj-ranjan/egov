<html>
<head>
<title>Search Case ID</title>
</head>
<script language=javascript>
<!--

function redirect(i)
{
var f=myform.Full_name.value ;
var f_length=parseInt(f.length);

if ( notNull(f) && validateString(f) && f_length<=50)
{
myform.action="Search.php?tag=2&ptype=1&mtype=1";
myform.submit();
}
else
alert('Enter Search Text');    
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
require_once '../class/utility.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_casedate.php';
require_once './class/class.noticetype.php';
$objCD=new Bakijai_casedate();

$objBp=new Baki_payment();
$objUtil=new myutility();
$objUtility=new Utility();
$allowedroll=3; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: index.php');

$objBakijai_main=new Bakijai_main();

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

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="";//Full_name
$mvalue[1]="0";//Case_id
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
$mvalue[0]="";//Full_name
// Call $objBakijai_main->MaxCase_id() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Case_id
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
if (isset($_POST['Full_name']))
$mvalue[0]=$_POST['Full_name'];
else
$mvalue[0]=0;

if (isset($_POST['Case_id']))
$mvalue[1]=$_POST['Case_id'];
else
$mvalue[1]=0;

} //ptype=1

if (isset($_POST['Case_id']))
$pkarray[0]=$_POST['Case_id'];
else
$pkarray[0]=0;
$objBakijai_main->setCase_id($pkarray[0]);
if ($objBakijai_main->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objBakijai_main->getFull_name();
$mvalue[1]=$objBakijai_main->getCase_id();
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
}//ptype=0
} //EditRecord()
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_bakijai_main.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Search Case ID<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Type few character for Name(At least 3)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=35 name="Full_name" id="Full_name" value="<?php echo $mvalue[0]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Full_name',1)"  onblur="ChangeColor('Full_name',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>

<?php $i++; //Now i=2?>
<tr><td align=right bgcolor=#FFFFCC>

</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value=Search  name=Save onclick=redirect(1)  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Full_name')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td></tr>
<tr><td colspan="2">
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr>
      
 <td width="100%" colspan="8" align="center"><font face="arial" size="3" color="red">Result of Seasrch</td>
            </tr>
<tr><td width="5%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">SlNo</td> 
<td width="8%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case ID</td>
<td width="22%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Name of Person</td> 
<td width="25%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Case No</td> 
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Amount of Loan</td>    
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Balance Amount</td> 
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Last Pay Date</td>
<td width="10%" bgcolor="#CCFFFF" align="center"><font face="arial" size="2">Status</td>
</tr>
<?php
$objB=new Bakijai_main();
if (strlen($mvalue[0])>2)
$str=" full_name like '%".$mvalue[0]."%' order by disposed , full_name";
else
$str="1=2";
$objB->setCondString($str);
$row=$objB->getAllRecord();
//echo $objB->returnSql;

//echo count($row);
for($ii=0;$ii<count($row);$ii++)
{
$caseid=$row[$ii]['Case_id'];
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=center><font face="arial" color="blue" size="2">
<?php
echo $caseid;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Full_name'];
echo "<b>".$tvalue."</b><br>C/o-";
echo $row[$ii]['Father']."<br>Vill-";
echo $row[$ii]['Village'];
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Bank'].",".$row[$ii]['Branch'];
$caseno=$row[$ii]['Case_no'];
if (strlen($row[$ii]['Fin_yr'])>0)
$caseno=$caseno."/".$row[$ii]['Fin_yr'];    
echo $tvalue."/".$caseno;
?>
</td>
<td align=right><font face="arial" size="2">
<?php

$amt1=$row[$ii]['Amount'];
$tvalue=$objUtil->convert2standard($amt1);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objBp->BalanecAmount($caseid);
$tvalue=$objUtil->convert2standard($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objBp->LastPayDate($caseid);
$tvalue=$objUtility->to_date($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$rem="";
$objCD->setCondString(" Action_taken='N' and Case_id=".$caseid." order by Day desc");
$crow=$objCD->getTopRecord(1);
if (count($crow)>0)
{
$objNt=new Noticetype();
$objNt->setCode($crow[0]['Notice_type']);
if ($objNt->EditRecord())
$rem="<br><b><font size=1>".$objNt->getNoticedetail()." Issued";
else
$rem="";
}

if ($row[$ii]['Disposed']=="Y")
$tvalue="Disposed on ".$objUtility->to_date ($row[$ii]['Disposed_date']);
else
$tvalue="Running";
echo $tvalue.$rem;
?>
</td>
</tr>
<?php
} //for loop
?>
</table>        
        
</td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Full_name");

if($mtype==6)//Postback from Full_name
echo $objUtility->focus("Case_id");

if($mtype==8)//Postback from Case_id
echo $objUtility->focus("Full_name");

?>
</body>
</html>
