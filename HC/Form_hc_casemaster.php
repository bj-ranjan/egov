<html>
<head>
<title>Entry Form for hc_casemaster</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Serial.value=mvalue;

var a=myform.Serial.value ;//Primary Key
if ( isNaN(a)==false && a!="")
{
myform.action="Form_hc_casemaster.php?tag=2&ptype=0";
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
myform.Serial.focus();
}

function redirect(i)
{
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
var a=myform.Serial.value ;// Primary Key
var b=myform.Case_no.value ;
var b_length=parseInt(b.length);
var c=myform.Dep_code.value ;
var c_index=myform.Dep_code.selectedIndex;
var d=myform.Branch_code.value ;
var d_index=myform.Branch_code.selectedIndex;
var e=myform.Brief_history.value ;
var e_length=parseInt(e.length);
var f=myform.Present_status.value ;
var f_length=parseInt(f.length);
var g=myform.File_no.value ;
var g_length=parseInt(g.length);
var h=myform.Due_dateparawise.value ;
var j=myform.Last_date.value ;
var k=myform.Signed_by.value ;
var k_length=parseInt(k.length);
var pdate=myform.Pdate.value;
if ( isNumber(a)==true   && notNull(b) && validateString(b) && b_length<=50 && c_index>0  && d_index>0  && notNull(e) && validateString(e) && e_length<=500 && notNull(f) && validateString(f) && f_length<=200 && validateString(g) && g_length<=100 && notNull(h) && isdate(h,1)  &&  isdate(j,0) && validateString(k) && k_length<=30)
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.action="Insert_hc_casemaster.php";
myform.submit();
}
else
{
if (NumericValid('Serial',1)==false)
alert('Non Numeric Value in Serial');
else if (StringValid('Case_no',1)==false)
alert('Check Case_no');
else if (SelectBoxIndex('Dep_code')==0)
alert('Select Dep_code');
else if (SelectBoxIndex('Branch_code')==0)
alert('Select Branch');
else if (StringValid('Brief_history',1)==false)
alert('Check Brief_history');
else if (StringValid('Present_status',1)==false)
alert('Check Present Status');
else if (StringValid('File_no',0)==false)
alert('Check File_no');
else if (isdate(h,1)==false) //less than
alert('Check Due Date');
else if (DateValid('Last_date',0)==false)
alert('Check Last Submission Date');
else if (StringValid('Signed_by',0)==false)
alert('Check Signed_by');
else 
alert('Enter Correct Data');
}
}//End Validate




function home()
{
window.location="mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
document.getElementById(a).focus();
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

//Reset Form
function res()
{
window.location="Form_hc_casemaster.php?tag=0";
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_casemaster.php';
require_once './class/class.hc_department.php';
require_once './class/class.hc_casetransaction.php';
require_once './class/class.hc_branch.php';

$objT=new Hc_casetransaction();

$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 17)==false) //16 for Bakijai Interest Collection
header( 'Location: Mainmenu.php?unauth=1');



$objHc_casemaster=new Hc_casemaster();

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
$mvalue[10]=0;
$mvalue[0]=$objHc_casemaster->MaxSerial();
}
else
{
$mvalue[0]=$objHc_casemaster->MaxSerial();
$mvalue[1]="";//Case_no
$mvalue[2]="0";//Dep_code
$mvalue[3]="0";//Branch_code
$mvalue[4]="";//Brief_history
$mvalue[5]="";//Present_status
$mvalue[6]="";//File_no
$mvalue[7]="";//Due_dateparawise
$mvalue[8]="";//Last_date
$mvalue[9]="";//Signed_by
$mvalue[10]=0;
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
// Call $objHc_casemaster->MaxSerial() Function Here if required and Load in $mvalue[0]
$mvalue[0]=$objHc_casemaster->MaxSerial();//Serial
$mvalue[1]="";//Case_no
// Call $objHc_casemaster->MaxDep_code() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//Dep_code
// Call $objHc_casemaster->MaxBranch_code() Function Here if required and Load in $mvalue[3]
$mvalue[3]="0";//Branch_code
$mvalue[4]="";//Brief_history
$mvalue[5]="";//Present_status
$mvalue[6]="";//File_no
$mvalue[7]="";//Due_dateparawise
$mvalue[8]="";//Last_date
$mvalue[9]="";//Signed_by
$mvalue[10]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Serial']))
$pkarray[0]=$_POST['Serial'];
else
$pkarray[0]=0;
$objHc_casemaster->setSerial($pkarray[0]);
if ($objHc_casemaster->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objHc_casemaster->getSerial();
$mvalue[1]=$objHc_casemaster->getCase_no();
$mvalue[2]=$objHc_casemaster->getDep_code();
$mvalue[3]=$objHc_casemaster->getBranch_code();
$mvalue[4]=$objHc_casemaster->getBrief_history();
$mvalue[5]=$objHc_casemaster->getPresent_status();
$mvalue[6]=$objHc_casemaster->getFile_no();
$mvalue[7]=$objUtility->to_date($objHc_casemaster->getDue_dateparawise());
$mvalue[8]=$objUtility->to_date($objHc_casemaster->getLast_date());
$mvalue[9]=$objHc_casemaster->getSigned_by();
$mvalue[10]=0;//last Select Box for Editing
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
if ($ptype==0)
{
$mvalue[0]=$pkarray[0];
$mvalue[1]="";
$mvalue[2]=-1;
$mvalue[3]=-1;
$mvalue[4]="";
$mvalue[5]="";
$mvalue[6]="";
$mvalue[7]="";
$mvalue[8]="";
$mvalue[9]="";
$mvalue[10]=0;//last Select Box for Editing
}//ptype=0
} //EditRecord()
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_hc_casemaster.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>NEW CASE ENTRY FORM<br></font>
<font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Serial
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 name="Serial" id="Serial" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Serial',1)"  onblur="ChangeColor('Serial',2)" onchange=direct1() readonly>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Case No.
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=50 name="Case_no" id="Case_no" value="<?php echo $mvalue[1]; ?>" style="<?php echo $mystyle;?>"  maxlength=50 onfocus="ChangeColor('Case_no',1)"  onblur="ChangeColor('Case_no',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Department
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:200px";
$objHc_department=new Hc_department();
$objHc_department->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objHc_department->getRow();
?>
<select name=Dep_code style="<?php echo $mystyle;?>" onchange=redirect(3)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Name'];
if ($mvalue[2]==$mcode)
{
?>
<option selected value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
else
{
?>
<option  value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=3?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Branch
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:200px";
$objHc_branch=new Hc_branch();
$objHc_branch->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objHc_branch->getRow();
?>
<select name=Branch_code style="<?php echo $mystyle;?>" onchange=redirect(4)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Name'];
if ($mvalue[3]==$mcode)
{
?>
<option selected value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
else
{
?>
<option  value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Brief History
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<textarea name="Brief_history" rows="4" cols="80" id="Brief_history"  style="<?php echo $mystyle;?>"  maxlength=500 onfocus="ChangeColor('Brief_history',1)"  onblur="ChangeColor('Brief_history',2)">
<?php echo $mvalue[4]; ?>
</textarea>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=5?>
<?php //row6?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Present Status
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=78 name="Present_status" id="Present_status" value="<?php echo $mvalue[5]; ?>" style="<?php echo $mystyle;?>"  maxlength=200 onfocus="ChangeColor('Present_status',1)"  onblur="ChangeColor('Present_status',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=6?>
<?php //row7?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
File No
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=50 name="File_no" id="File_no" value="<?php echo $mvalue[6]; ?>" style="<?php echo $mystyle;?>"  maxlength=100 onfocus="ChangeColor('File_no',1)"  onblur="ChangeColor('File_no',2)">
</td>
</tr>
<?php $i++; //Now i=7?>
<?php //row8?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
When Para Wise Comment to be sent
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=10 name="Due_dateparawise" id="Due_dateparawise" value="<?php echo $mvalue[7]; ?>" onfocus="ChangeColor('Due_dateparawise',1)"  onblur="ChangeColor('Due_dateparawise',2)">
<font color=red size=3 face=arial>*</font>
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php $i++; //Now i=8?>
<?php //row9?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Last Para Wise Date
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=10 name="Last_date" id="Last_date" value="<?php echo $mvalue[8]; ?>" onfocus="ChangeColor('Last_date',1)"  onblur="ChangeColor('Last_date',2)">
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php $i++; //Now i=9?>
<?php //row10?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Para Wise Comment Signed By
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=50 name="Signed_by" id="Signed_by" value="<?php echo $mvalue[9]; ?>" style="<?php echo $mystyle;?>"  maxlength=50 onfocus="ChangeColor('Signed_by',1)"  onblur="ChangeColor('Signed_by',2)">
</td>
</tr>
<?php $i++; //Now i=10?>
<tr>
<td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
{
echo"<font size=2 face=arial color=#CC3333>Update Mode";
$cap="Update Data";
}
else
{
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
$cap="Save Data";
}
?>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=hidden size=30 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="<?php echo $cap;?>"  name=Save onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td></tr>
<tr><td align=right bgcolor=#99CCCC rowspan=2><font color=red size=3 face=arial>
</td>
<td align=left bgcolor=#99CCCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:white;color:black;width:300px";
$objHc_casemaster->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objHc_casemaster->getRow();
?>
<select name=Editme style="<?php echo $mystyle;?>" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Serial'];
$mdetail=$row[$ind]['Case_no'];
$cnt=$objT->rowCount("Case_id=".$mcode);
if ($cnt==1)
{
if ($mvalue[10]==$mcode)
{
?>
<option selected value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
else
{
?>
<option  value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //if mvalue
}//$cnt==1
} //for loop
?>
</select>
</td></tr>
<tr>
<td align=left bgcolor=#99CCCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:yellow;color:black;width:150px";
?>
<input type=button value=Edit  name=edit1 onclick=direct() style="<?php echo $mystyle;?>" disabled>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:green;color:black;width:150px";
?>
<input type=button value=Reset  name=res1 onclick=res() style="<?php echo $mystyle;?>"
</td>
</tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Case_no");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>
</body>
</html>
