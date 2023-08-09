<html>
<head>
<title>Entry Form for hc_casetransaction</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
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
myform.action="Form_hc_casetransaction.php?tag=2&ptype=0";
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
myform.action="Form_hc_casetransaction.php?tag=2&ptype=1&mtype="+i;
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
var a_index=myform.Case_id.selectedIndex;
var b=myform.Rsl.value ;// Primary Key
var c=myform.Submit_date.value ;
var d=myform.Signed_by.value ;
var d_length=parseInt(d.length);
var e=myform.Nextdue_date.value ;
var f=myform.Present_status.value;
var pdate=myform.Pdate.value;
var cl=myform.Closed.checked;
var dateok=true;
var last=myform.Last.value;
if (cl==true)
dateok=isdate(e,0);
else
{
if(isdate(e,1)&& CompareDate(e,pdate)==1)    
dateok=true;
else
dateok=false;    
}    
//alert(b);

var lastok=(isdate(c,1) && CompareDate(c,last)==1 && CompareDate(c,pdate)==-1);
//alert(CompareDate(c,last));
if ( a_index>0  && isNumber(b)==true   && notNull(c)  && notNull(d) && validateString(d) && d_length<=30 && lastok==true && dateok==true && validateString(f))
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.action="Insert_hc_casetransaction.php";
myform.submit();
}
else
{
if (SelectBoxIndex('Case_id')==0)
alert('Select Case_id');
else if (lastok==false)
alert('Check Submit date');
else if (StringValid('Signed_by',1)==false)
alert('Check Signed_by');
else if (dateok==false)
alert('Check  Next due date');
else if (StringValid('Present_status',0)==false)
alert('Check Present Status');
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
window.location="Form_hc_casetransaction.php?tag=0";
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_casetransaction.php';
require_once './class/class.hc_casemaster.php';

$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 17)==false) //16 for Bakijai Interest Collection
header( 'Location: Mainmenu.php?unauth=1');


$objHc_casetransaction=new Hc_casetransaction();

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
$mvalue[6]=0;
//$mvalue[0]="0";
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="0";//Rsl
$mvalue[2]="";//Submit_date
$mvalue[3]="";//Signed_by
$mvalue[4]="";//Nextdue_date
$mvalue[5]="";//Entry_date
$mvalue[6]=0;
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
// Call $objHc_casetransaction->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]="0";//Case_id
// Call $objHc_casetransaction->MaxRsl() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Rsl
$mvalue[2]="";//Submit_date
$mvalue[3]="";//Signed_by
$mvalue[4]="";//Nextdue_date
$mvalue[5]="";//Entry_date
$mvalue[6]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
//Post Back on Select Box Change,Hence reserve the value

// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Case_id']))
$mvalue[0]=$_POST['Case_id'];
else
$mvalue[0]=0;

$objHc_casetransaction->setCase_id($mvalue[0]);
$maxRsl=$objHc_casetransaction->maxRsl($mvalue[0])-1;
$objHc_casetransaction->setRsl($maxRsl);

if ($objHc_casetransaction->EditRecord()) //i.e Data Available
{ 
$mvalue[1]=$objHc_casetransaction->getRsl();
$mvalue[2]=$objUtility->to_date($objHc_casetransaction->getSubmit_date());
$mvalue[3]=$objHc_casetransaction->getSigned_by();
$mvalue[4]=$objUtility->to_date($objHc_casetransaction->getNextdue_date());
$mvalue[5]=$objUtility->to_date($objHc_casetransaction->getEntry_date());
$mvalue[6]=0;//last Select Box for Editing
$_SESSION['update']=1;
} 
else //data not available for edit
$_SESSION['update']=0;
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_hc_casetransaction.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>UPDATE PARAWISE COMMENT SUBMISSION DETAIL<br></font>
<font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Case_id
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:300px";
$objHc_casemaster=new Hc_casemaster();
$objHc_casemaster->setCondString("Closed='N'" ); //Change the condition for where clause accordingly
$row=$objHc_casemaster->getRow();
?>
<select name=Case_id style="<?php echo $mystyle;?>" onchange=redirect(1)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Serial'];
$mdetail=$row[$ind]['Case_no'];
if ($mvalue[0]==$mcode)
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
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=center bgcolor=#FFFFCC colspan="2">
<font color=blue size=3 face=arial>
Para Wise Comment to be submitted on-
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=hidden size=8 name="Rsl" id="Rsl" value="<?php echo $mvalue[1]; ?>">
<?php echo $mvalue[4]; ?>
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Submition Date
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=10 name="Submit_date" id="Submit_date" value="" onfocus="ChangeColor('Submit_date',1)"  onblur="ChangeColor('Submit_date',2)">
<font color=red size=3 face=arial>*</font>
<font size=1 face=arial color=blue>
Last Submitted on <?php echo $mvalue[2];?>
</font>
<input type="hidden" name="Last" value="<?php echo $mvalue[2];?>">
</td>
</tr>
<?php $i++; //Now i=3?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Signed_by
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=50 name="Signed_by" id="Signed_by" value="" style="<?php echo $mystyle;?>"  maxlength=50 onfocus="ChangeColor('Signed_by',1)"  onblur="ChangeColor('Signed_by',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Next Due Date of Submission
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=10 name="Nextdue_date" id="Nextdue_date" value="" onfocus="ChangeColor('Nextdue_date',1)"  onblur="ChangeColor('Nextdue_date',2)">
<font color=red size=3 face=arial>*</font>
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Present Status of Case
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=50 name="Present_status" id="Present_status" value="" onfocus="ChangeColor('Present_status',1)"  onblur="ChangeColor('Present_status',2)" maxlength="100">
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Case Closed
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type="checkbox" name="Closed" value="1">
</td>
</tr>

<?php $i++; //Now i=5?>
<?php //row6?>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
{
//echo"<font size=2 face=arial color=#CC3333>Update Mode";
$cap="Update Data";
}
else
{
//echo"<font size=2 face=arial color=#6666FF>Insert Mode";
$cap="Save Data";
}
?>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=hidden size=10 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="<?php echo $cap;?>"  name=Save onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td></tr>

</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Case_id");

if($mtype==1)//Postback from Case_id
echo $objUtility->focus("Rsl");

if($mtype==2)//Postback from Rsl
echo $objUtility->focus("Submit_date");

if($mtype==3)//Postback from Submit_date
echo $objUtility->focus("Signed_by");

if($mtype==4)//Postback from Signed_by
echo $objUtility->focus("Nextdue_date");

if($mtype==5)//Postback from Nextdue_date
echo $objUtility->focus("Entry_date");

if($mtype==6)//Postback from Entry_date
echo $objUtility->focus("Case_id");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=6 align=Center bgcolor=#ccffcc><font face=arial size=4>Last Para Wise Comment Details</font></td></tr>
<tr>
<td align=center bgcolor="#669999"><font color=black size=2 face=arial>
Serial
</td>
<td align=center bgcolor="#669999"><font color=black size=2 face=arial>
Submit Date
</td>
<td align=center bgcolor="#669999"><font color=black size=2 face=arial>
Signed By
</td>
<td align=center bgcolor="#669999"><font color=black size=2 face=arial>
Present Status
</td>
<td align=center bgcolor="#669999"><font color=black size=2 face=arial>
Next Due Date
</td>
</tr>
</Thead>
<?php
$objHc_casetransaction->setCondString("Case_id=".$mvalue[0]." order by Rsl");
$row=$objHc_casetransaction->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font color=black size=2 face=arial>
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=center><font color=black size=2 face=arial>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Submit_date']);
echo $tvalue;
?>
</td>
<td align=left><font color=black size=2 face=arial>
<?php
$tvalue=$row[$ii]['Signed_by'];
echo $tvalue;
?>
</td>
<td align=left><font color=black size=2 face=arial>&nbsp;
<?php
$tvalue=$row[$ii]['Present_status'];
echo $tvalue;
?>
</td>
<td align=left><font color=black size=2 face=arial>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Nextdue_date']);
echo $tvalue;
?>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>
