<html>
<head>
<title>Entry Form for update_history</title>
</head>
<script language=javascript>
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Rsl.value=mvalue;

var a=myform.Case_id.value ;//Primary Key
var b=myform.Rsl.value ;//Primary Key
if ( isNaN(a)==false && a!="" && isNaN(b)==false && b!="")
{
myform.action="Form_update_history.php?tag=2&ptype=0";
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
myform.action="Form_update_history.php?tag=2&ptype=1&mtype="+i;
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
var b=myform.Rsl.value ;// Primary Key
var c=myform.Detail.value ;
var c_length=parseInt(c.length);
var d=myform.User_code.value ;
var d_length=parseInt(d.length);
var e=myform.Entry_date.value ;
if ( isNumber(a)==true   && isNumber(b)==true   && 1==1 && validateString(c) && c_length<=150 && 1==1 && validateString(d) && d_length<=30 && 1==1 && 1==1 &&  isdate(e,0))
{
myform.action="Insert_update_history.php";
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

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once './class/utility.class.php';
require_once './class/class.update_history.php';

$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: index.php');

$objUpdate_history=new Update_history();

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

$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[5]=0;
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="0";//Rsl
$mvalue[2]="";//Detail
$mvalue[3]="";//User_code
$mvalue[4]="";//Entry_date
$mvalue[5]=0;
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
$mvalue[0]="0";
$mvalue[1]="0";
$mvalue[2]="";//Detail
$mvalue[3]="";//User_code
$mvalue[4]="";//Entry_date
$mvalue[5]=0;//last Select Box for Editing
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

if (isset($_POST['Rsl']))
$mvalue[1]=$_POST['Rsl'];
else
$mvalue[1]=0;

if (isset($_POST['Detail']))
$mvalue[2]=$_POST['Detail'];
else
$mvalue[2]=0;

if (isset($_POST['User_code']))
$mvalue[3]=$_POST['User_code'];
else
$mvalue[3]=0;

if (isset($_POST['Entry_date']))
$mvalue[4]=$_POST['Entry_date'];
else
$mvalue[4]=0;

if (isset($_POST['Editme']))
$mvalue[5]=$_POST['Editme'];
else
$mvalue[5]=0;

} //ptype=1

if (isset($_POST['Case_id']))
$pkarray[0]=$_POST['Case_id'];
else
$pkarray[0]=0;
$objUpdate_history->setCase_id($pkarray[0]);
if (isset($_POST['Rsl']))
$pkarray[1]=$_POST['Rsl'];
else
$pkarray[1]=0;
$objUpdate_history->setRsl($pkarray[1]);
if ($objUpdate_history->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objUpdate_history->getCase_id();
$mvalue[1]=$objUpdate_history->getRsl();
$mvalue[2]=$objUpdate_history->getDetail();
$mvalue[3]=$objUpdate_history->getUser_code();
$mvalue[4]=$objUtility->to_date($objUpdate_history->getEntry_date());
$mvalue[5]=0;//last Select Box for Editing
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
$mvalue[5]=0;//last Select Box for Editing
}//ptype=0
} //EditRecord()
} //tag==2


//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_update_history.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Entry/Edit Form for Update_history<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Case_id</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Case_id" id="Case_id" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Rsl</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Rsl" id="Rsl" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Rsl',1)"  onblur="ChangeColor('Rsl',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Detail</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Detail" id="Detail" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=150 onfocus="ChangeColor('Detail',1)"  onblur="ChangeColor('Detail',2)">
</td>
</tr>
<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>User_code</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=30 name="User_code" id="User_code" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=30 onfocus="ChangeColor('User_code',1)"  onblur="ChangeColor('User_code',2)">
</td>
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Entry_date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Entry_date" id="Entry_date" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Entry_date',1)"  onblur="ChangeColor('Entry_date',2)">
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
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Case_id')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td></tr>
<tr><td align=right>
<?php 
$objUpdate_history->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objUpdate_history->getRow();
?>
<select name=Editme style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:200px" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Rsl'])
{
?>
<option selected value="<?php echo $row[$ind]['Rsl'];?>"><?php echo $row[$ind]['Detail'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Rsl'];?>"><?php echo $row[$ind]['Detail'];
}
} //for loop
?>
</select>
</td><td align=left>
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" disabled>
</tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Case_id");

if($mtype==1)//Postback from Case_id
echo $objUtility->focus("Rsl");

if($mtype==2)//Postback from Rsl
echo $objUtility->focus("Detail");

if($mtype==3)//Postback from Detail
echo $objUtility->focus("User_code");

if($mtype==4)//Postback from User_code
echo $objUtility->focus("Entry_date");

if($mtype==5)//Postback from Entry_date
echo $objUtility->focus("Case_id");

?>
</body>
</html>
