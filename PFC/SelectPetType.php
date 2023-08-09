<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script type="text/javascript" src="../validationnew.js"></script>
<script language="javascript">
<!--

function validate()
{
var d1=document.getElementById('Start_date').value;
var d2=document.getElementById('End_date').value;
if (SelectBoxIndex('Pet_type')>0  && DateValid('Start_date',1) && DateValid('End_date',1))
{
if(CompareDate(d1,d2)!=1)
{
if(document.getElementById('Pet_type').value=="0")
myform.action="WeeklyReportAll.php";
else
myform.action="WeeklyReport.php";
myform.submit();
}
else
alert('Invalid Period');
}
else
{
if (SelectBoxIndex('Pet_type')==0)
{
alert('Select Petition Type');
document.getElementById('Pet_type').focus();
}
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



//Reset Form
function res()
{
window.location="Form_petition_master.php?tag=0";
}
//END JAVA
</script>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_type.php';
require_once 'header.php';

$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: index.php');

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>1)
$_tag=0;

if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$_SESSION['update']=0;//Initialise as Insert Mode
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
$mvalue[2]="";//Pet_type
$mvalue[3]="";//Start_date
$mvalue[4]="";//End_date
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
// Call $objPetition_master->MaxPet_no() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Pet_no
$mvalue[2]="";//Pet_type
$mvalue[3]="";//Start_date
$mvalue[4]="";//End_date
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]


if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=60%>
<form name=myform action=""  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Periodic Report</font>
<font face=arial color=red size=2><?php echo  $returnmessage; ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Petition Type
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:250px";
$objPetition_type=new Petition_type();
$objPetition_type->setCondString("Running='Y'" ); //Change the condition for where clause accordingly
$row=$objPetition_type->getRow();
?>
<select name="Pet_type" id="Pet_type" style="<?php echo $mystyle;?>" onchange=redirect(5)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Detail'];
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
<option value="0">All Petition
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=3?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Date From
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 name="Start_date" maxlength=10 id="Start_date" value="<?php echo $mvalue[3]; ?>" onfocus="ChangeColor('Start_date',1)"  onblur="ChangeColor('Start_date',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Start_date);" alt="Click Here to Pick Date">
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Date To
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 maxlength=10 name="End_date" id="End_date" value="<?php echo $mvalue[4]; ?>" onfocus="ChangeColor('End_date',1)"  onblur="ChangeColor('End_date',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(End_date);" alt="Click Here to Pick Date">
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
</td>
</tr>
<?php $i++; //Now i=5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
{
$cap="Update Data";
}
else
{
$cap="Save Data";
}
?>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=hidden size=10 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="View Report"  name=Save onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="<?php echo $mystyle;?>">
</td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Pet_yr");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>
</body>
</html>
