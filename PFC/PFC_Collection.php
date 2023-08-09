<html>
<head>
<title>Entry Form for pfc_collection</title>
</head>
<script type="text/javascript" src="../validationnew.js"></script>
<script language="javascript">
<!--
function setMe()
{
myform.Cal_yr.focus();
}
function direct()
{
var data="yy="+document.getElementById('Cal_yr').value;  
MyAjaxFunction("POST","Load_YearlyCollection.php",data,'Result',"HTML");
}


function LoadFees()
{
var data="yy="+document.getElementById('Cal_yr').value;
data=data+"&mm="+document.getElementById('Cal_month').value;
//Load XML sring in a hidden Box 'XML''
MyAjaxFunction("POST","LoadFees.php",data,'XML',"TEXT");
//MyAjaxFunction("POST","LoadFees.php",data,'Result',"HTML");
alert('Collection Detail will be Loaded');
var xmlString1=document.getElementById('XML').value;
//alert(xmlString1);
var xmlString=filter(xmlString1);
//alert(xmlString);
ParseXmlString(xmlString,"JB",0,"Jama_fee");
ParseXmlString(xmlString,"ER",0,"Er_fee");
ParseXmlString(xmlString,"OTHER",0,"Other_fee");
document.getElementById('Total').value=Number(document.getElementById('Jama_fee').value)+Number(document.getElementById('Er_fee').value)+Number(document.getElementById('Other_fee').value);
}


function filter(str)
{
var mylength=parseInt(str.length);    
var ni=str.indexOf("<",0);// search from 3 
var mystr=str.substr(ni,(mylength-ni));// 0 to length 3
return(mystr);
}


function Add()
{
document.getElementById('Total').value=Number(document.getElementById('Jama_fee').value)+Number(document.getElementById('Er_fee').value)+Number(document.getElementById('Other_fee').value);
}

function validate()
{
var b=myform.Cal_yr.value ;// Primary Key
var f=myform.Jama_fee.value ;
var g=myform.Er_fee.value ;
var h=myform.Other_fee.value ;
var i=myform.Total.value ;
var pdate=myform.Pdate.value;
var fdate="31/"+document.getElementById('Cal_month').value+"/"+document.getElementById('Cal_yr').value;

var tday=document.getElementById('Collection_date').value;

if ( isNumber(b)==true   && SelectBoxIndex('Cal_month')>0  && DateValid('Collection_date',1) && isNumber(f)==true   && isNumber(g)==true   && isNumber(h)==true   && isNumber(i)==true )
{
if(CompareDate(tday,fdate)==-1 || CompareDate(tday,pdate)==1)
alert('Invalid Deposit Date')   
else
{    
myform.action="Insert_pfc_collection.php";
myform.submit();
} //CompareDate
} //isNumber(b)
else
{
if (NumericValid('Cal_yr',1)==false)
{
alert('Non Numeric Value in Cal_yr');
document.getElementById('Cal_yr').focus();
}
else if (SelectBoxIndex('Cal_month')==0)
{
alert('Select Cal_month');
document.getElementById('Cal_month').focus();
}
else if (DateValid('Collection_date',1)==false)
{
alert('Check Date Collection_date');
document.getElementById('Collection_date').focus();
}
else if (NumericValid('Jama_fee',1)==false)
{
alert('Non Numeric Value in Jama_fee');
document.getElementById('Jama_fee').focus();
}
else if (NumericValid('Er_fee',1)==false)
{
alert('Non Numeric Value in Er_fee');
document.getElementById('Er_fee').focus();
}
else if (NumericValid('Other_fee',1)==false)
{
alert('Non Numeric Value in Other_fee');
document.getElementById('Other_fee').focus();
}
else if (NumericValid('Total',1)==false)
{
alert('Non Numeric Value in Total');
document.getElementById('Total').focus();
}
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



//Reset Form
function res()
{
window.location="Form_pfc_collection.php?tag=0";
}
//END JAVA
</script>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script src="../jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');

var data="yy="+document.getElementById('Cal_yr').value;  
MyAjaxFunction("POST","Load_YearlyCollection.php",data,'Result',"HTML");


//$("#id").blur(function(event){
//$("#Row1").show();
//$("#Row2").hide();
//$("#Female").animate({height:"-=5px"});
//$("#Female").animate({fontSize:"-=2px"});
//});

//Remove Select Box item Single
//$("#SelectBoxId option[value='11']").remove();

//Remove Select Box item Loop
//for(var i=7;i<=12;i++)
//$("#SelectBoxId option[value='"+i+"']").remove();

//Append Select Box item Single
//$("#SelectBoxId").append('<option value="9">September</option>');
//Append Select Box item Group
//var mid="#SelectBoxId";
//for(var i=1;i<=j;i++)
//{
//var opt="<option value="+i+">"+mname[i]+"</option>";
//$(mid).append(opt);
//}//for loop
//Unload Event through JQuery
$.ajaxSetup ({
cache: false
});
$(window).unload(function() {
//$.ajax({
//url:   'logout.php',async : false
//});
//return false;
}); //unload


//MyAjaxFunction("POST","LoadSelectBoxPfc_collection.php?type=1",data,'TargetId',"HTML");

}); //Document Ready Function
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.pfc_collection.php';
require_once '../class/class.monthname.php';

$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 21)==false) //21 for  Creamy
header( 'Location: Mainmenu.php?unauth=1');



$objPfc_collection=new Pfc_collection();

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

if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[0]=$objPfc_collection->MaxCal_yr();
//$mvalue[1]=$objPfc_collection->MaxCal_month();
}//tag=0[Initial Loading]

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue=InitArray();
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
//$mvalue[0]=$objPfc_collection->MaxCal_yr();
//$mvalue[1]=$objPfc_collection->MaxCal_month();
}//tag=1 [Return from Action form]


if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_pfc_collection.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Update Monthly Collection from Facilitation Counter</font>
<font face=arial color=red size=2><div id="DivMsg"><?php echo  $returnmessage; ?></div></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Collection  Year
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Cal_yr" id="Cal_yr" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Cal_yr',1)"  onblur="ChangeColor('Cal_yr',2)" onchange=direct()>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgCal_yr"></div>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Collection  Month
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:160px";
$objMonthname=new Monthname();
$objMonthname->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objMonthname->getRow();
?>
<select name="Cal_month" id="Cal_month" style="<?php echo $mystyle;?>" onchange=LoadFees()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Monthcode'];
$mdetail=$row[$ind]['Montheng'];
if ($mvalue[1]==$mcode)
$sel=" Selected ";
else
$sel=" ";
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
<input type=hidden size=1  name="Cal_monthValue"  id="Cal_monthValue" value="<?php echo $mvalue[1]; ?>" >
<div id="MsgCal_month"></div>
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Deposit Date(To Cashier)
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=10 name="Collection_date" id="Collection_date" value="<?php echo $mvalue[2]; ?>" style="<?php echo $mystyle;?>"  maxlength=10 onfocus="ChangeColor('Collection_date',1)"  onblur="ChangeColor('Collection_date',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Collection_date);" alt="Click Here to Pick Date">
<font color=red size=4 face=arial><b>*</b></font>
<font size=1 face=arial color=blue>DD/MM/YYYY</font>
<div id="MsgCollection_date"></div>
</td>
</tr>
<?php $i++; //Now i=3?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Jamabandi Collection
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Jama_fee" id="Jama_fee" value="<?php echo $mvalue[3]; ?>" onfocus="ChangeColor('Jama_fee',1)"  onblur="ChangeColor('Jama_fee',2)" readonly>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgJama_fee"></div>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Eroll Collection
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Er_fee" id="Er_fee" value="<?php echo $mvalue[4]; ?>" onfocus="ChangeColor('Er_fee',1)"  onblur="ChangeColor('Er_fee',2)" readonly>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgEr_fee"></div>
</td>
</tr>
<?php $i++; //Now i=5?>
<?php //row6?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Other Collection(PRC,Bakijai)
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Other_fee" id="Other_fee" value="<?php echo $mvalue[5]; ?>" onfocus="ChangeColor('Other_fee',1)"  onblur="ChangeColor('Other_fee',2)" readonly>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgOther_fee"></div>
</td>
</tr>
<?php $i++; //Now i=6?>
<?php //row7?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Total Colection for the Period
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Total" id="Total" value="<?php echo $mvalue[6]; ?>" onfocus="ChangeColor('Total',1);Add()"  onblur="ChangeColor('Total',2)" readonly>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgTotal"></div>
<input type="hidden" name="XML" id="XML" size="70" >
</td>
</tr>
<?php $i++; //Now i=7?>
<tr>
<td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
{
echo"<font size=1 face=arial color=#CC3333>Updation Mode";
$cap="Update Data";
}
else
{
echo"<font size=1 face=arial color=#6666FF>New Entry Mode";
$cap="Save Data";
}
?>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="<?php echo $cap;?>"  name="Save" id="Save" onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 id=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td></tr>
</table>
</form>
<div align="center" id="Result">
           
</div>
<?php
if($mtype==0)
echo $objUtility->focus("Cal_yr");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
// Call $objPfc_collection->MaxCal_yr() Function Here if required and Load in $mvalue[0]
if(date('m')==1)
$temp[0]=date('Y')-1;//Cal_yr
else
$temp[0]=date('Y');//Cal_yr

// Call $objPfc_collection->MaxCal_month() Function Here if required and Load in $mvalue[1]
$temp[1]="0";//Cal_month
$temp[2]="";//Collection_date
$temp[3]="0";//Jama_fee
$temp[4]="0";//Er_fee
$temp[5]="0";//Other_fee
$temp[6]="0";//Total
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=7;$i++)
{
$temp[$i]="0";
}

if(isset($myvalue[0]))
$temp[0]=$myvalue[0];

if(isset($myvalue[1]))
$temp[1]=$myvalue[1];

if(isset($myvalue[2]))
$temp[2]=$myvalue[2];

if(isset($myvalue[3]))
$temp[3]=$myvalue[3];

if(isset($myvalue[4]))
$temp[4]=$myvalue[4];

if(isset($myvalue[5]))
$temp[5]=$myvalue[5];

if(isset($myvalue[6]))
$temp[6]=$myvalue[6];

return($temp);
}//VerifyArray

?>
</body>
</html>
