<html>
<head>
<title>Entry Form for hc_branch</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Code.value=mvalue;

var a=myform.Code.value ;//Primary Key
if ( isNaN(a)==false && a!="")
{
myform.action="Form_hc_branch.php?tag=2&ptype=0";
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
myform.Code.focus();
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
var a=myform.Code.value ;// Primary Key
var b=myform.Name.value ;
var b_length=parseInt(b.length);
if ( isNumber(a)==true   && notNull(b) && validateString(b) && b_length<=30)
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.action="Insert_hc_branch.php";
myform.submit();
}
else
{
if (NumericValid('Code',1)==false)
alert('Non Numeric Value in Code');
else if (StringValid('Name',1)==false)
alert('Check Name');
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
window.location="Form_hc_branch.php?tag=0";
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_branch.php';

$objUtility=new Utility();


$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 17)==false) //16 for Bakijai Interest Collection
header( 'Location: Mainmenu.php?unauth=1');


$objHc_branch=new Hc_branch();

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
$mvalue[2]=0;
$mvalue[0]=$objHc_branch->MaxCode();
}
else
{
$mvalue[0]=$objHc_branch->MaxCode();//Code
$mvalue[1]="";//Name
$mvalue[2]=0;
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
// Call $objHc_branch->MaxCode() Function Here if required and Load in $mvalue[0]
$mvalue[0]=$objHc_branch->MaxCode();//Code
$mvalue[1]="";//Name
$mvalue[2]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Code']))
$pkarray[0]=$_POST['Code'];
else
$pkarray[0]=0;
$objHc_branch->setCode($pkarray[0]);
if ($objHc_branch->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objHc_branch->getCode();
$mvalue[1]=$objHc_branch->getName();
$mvalue[2]=0;//last Select Box for Editing
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
$mvalue[2]=0;//last Select Box for Editing
}//ptype=0
} //EditRecord()
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_hc_branch.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Entry/Edit Form for Hc_branch<br></font>
<font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Code
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 name="Code" id="Code" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Code',1)"  onblur="ChangeColor('Code',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Name
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=30 name="Name" id="Name" value="<?php echo $mvalue[1]; ?>" style="<?php echo $mystyle;?>"  maxlength=30 onfocus="ChangeColor('Name',1)"  onblur="ChangeColor('Name',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=2?>
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
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Code')" style="<?php echo $mystyle;?>">
</td></tr>
<tr><td align=right bgcolor=#99CCCC rowspan=2><font color=red size=3 face=arial>
</td>
<td align=left bgcolor=#99CCCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:white;color:black;width:300px";
$objHc_branch->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objHc_branch->getRow();
?>
<select name=Editme style="<?php echo $mystyle;?>" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
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
echo $objUtility->focus("Name");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>
</body>
</html>
