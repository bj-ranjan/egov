<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script type="text/javascript" src="../validation.js"></script>
<script language="javascript">
<!--
function LoadXML()
{
var data=ConstructDataString();
clear();
MyAjaxFunction("POST","XML_petition_master.php?id=0",data,'DivButton',"HTML");
MyAjaxFunction("POST","XML_petition_master.php?id=1",data,'XML',"TEXT");
alert('Loading');
var xmlString=document.getElementById('XML').value;
//alert(xmlString);
var TagId = "";//Set XML TagName
var iBoxId = "";//Set ID of Input Box Where Parsed data will be loaded
var nodeId = 0;//Id of Node value i.e row number of returned XML
ParseXmlString(xmlString,"APPLICANT",nodeId,'Applicant');
ParseXmlString(xmlString,"FATHER",nodeId,'Father');
ParseXmlString(xmlString,"LAC_NO",nodeId,'Lac_no');
ParseXmlString(xmlString,"PART_NO",nodeId,'Part_no');
ParseXmlString(xmlString,"RES",nodeId,'Res');
//Thus Continue to Load Other Input Box
}//LoadXML

function clear()
{
document.getElementById('Applicant').value="";
document.getElementById('Father').value="";
document.getElementById('Lac_no').value="";
document.getElementById('Part_no').value="";
document.getElementById('Res').value="N";
}


function setMe()
{
myform.Pet_yr.focus();
}




function validate()
{

//StringValid('a',0,0) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(0- Simple Validation, 1- Strong Validation)
var e=myform.Pet_no.value ;// Primary Key

if (StringValid('Pet_yr',1,0) && isNumber(e)==true   &&  StringValid('Reason',1,0))
{
myform.action="RejectErPetition.php";
myform.submit();
}
else
{
if (StringValid('Pet_yr',1,0)==false)//0-Simple Validation
{
alert('Check Pet_yr');
document.getElementById('Pet_yr').focus();
}
else if (NumericValid('Pet_no',1)==false)
{
alert('Non Numeric Value in Pet_no');
document.getElementById('Pet_no').focus();
}
else if (StringValid('Reason',1,0)==false)//0-Simple Validation
{
alert('Enter Reason for Rejection');
document.getElementById('Reason').focus();
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

function ConstructDataString()
{
var data="Utype=1";

data=data+"&Pet_yr="+document.getElementById('Pet_yr').value;
data=data+"&Pet_no="+document.getElementById('Pet_no').value;
return(data);
}

//END JAVA
</script>
<script language="JavaScript" src="./datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="./datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script src="../jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');
$("#Rrow").hide();


$("#Pet_no").blur(function(event){
if(document.getElementById('Res').value=="Y")
$("#Rrow").show();
else
$("#Rrow").hide();
});

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


//MyAjaxFunction("POST","LoadSelectBoxPetition_master.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>
<body>
<?php
//Start FORMPHPBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once 'header.php';
$objUtility=new Utility();

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 12)==false) //12 for Eroll Certificate 
header( 'Location: Mainmenu.php?unauth=1');


$objPetition_master=new Petition_master();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_SESSION['myArea']))
$Area=$_SESSION['myArea'];
else
$Area=0;


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
//$mvalue[1]=$objPetition_master->MaxPet_no();
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
//$mvalue[1]=$objPetition_master->MaxPet_no();
}//tag=1 [Return from Action form]


if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);
$dis=" disabled";
//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action="" method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Reject Petition for E-Roll<br></font>
<font face=arial color=red size=2><div id="DivMsg"><?php echo  $returnmessage; ?></div></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Petition Year
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=4 name="Pet_yr" id="Pet_yr" value="<?php echo $mvalue[0]; ?>" style="<?php echo $mystyle;?>"  maxlength=4 onfocus="ChangeColor('Pet_yr',1)"  onblur="ChangeColor('Pet_yr',2)" onchange=LoadXML()>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgPet_yr"></div>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Petition No
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Pet_no" id="Pet_no" value="<?php echo $mvalue[1]; ?>" onfocus="ChangeColor('Pet_no',1)"  onblur="ChangeColor('Pet_no',2)" onchange=LoadXML()>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgPet_no"></div>
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Applicant Name
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=50 name="Applicant" id="Applicant" value="<?php echo $mvalue[2]; ?>" style="<?php echo $mystyle;?>"  maxlength=70 onfocus="ChangeColor('Applicant',1)"  onblur="ChangeColor('Applicant',2)" <?php echo $dis;?>>
<font color=red size=4 face=arial><b>*</b></font>
<div id="MsgApplicant"></div>
</td>
</tr>
<?php $i++; //Now i=3?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Gurdian's Name
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=50 name="Father" id="Father" value="<?php echo $mvalue[3]; ?>" style="<?php echo $mystyle;?>"  maxlength=60 onfocus="ChangeColor('Father',1)"  onblur="ChangeColor('Father',2)" <?php echo $dis;?>>
<div id="MsgFather"></div>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
LAC No
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<input type=text size=8 name="Lac_no" id="Lac_no" value="<?php echo $mvalue[4]; ?>" onfocus="ChangeColor('Lac_no',1)"  onblur="ChangeColor('Lac_no',2)" <?php echo $dis;?>>
Part Number&nbsp;
<input type=text size=10 name="Part_no" id="Part_no" value="<?php echo $mvalue[5]; ?>" style="<?php echo $mystyle;?>"  maxlength=10 onfocus="ChangeColor('Part_no',1)"  onblur="ChangeColor('Part_no',2)" <?php echo $dis;?>>
<input type=text size=1 name="Res" id="Res" value="N" disabled>
</td>
</tr>
<?php $i++; //Now i=5?>
<?php //row6?>

<tr id="Rrow">
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Rejection Reason
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 14px";
?>
<textarea rows=2 cols=60 name="Reason" id="Reason"  style="<?php echo $mystyle;?>"   onfocus="ChangeColor('Reason',1)"  onblur="ChangeColor('Reason',2)">
</textarea>
</td>
</tr>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFFFCC>
<input type=button value=Menu  name=back1 id=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td>
<td align=left bgcolor=#FFFFCC valign=top>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<div id="divButton">
</div>
<input type=hidden size=10 name=XML id="XML">
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

//This function will Initialise Array
function InitArray()
{
$temp=array();
$temp[0]=date('Y');//Pet_yr
// Call $objPetition_master->MaxPet_no() Function Here if required and Load in $mvalue[1]
$temp[1]="0";//Pet_no
$temp[2]="";//Applicant
$temp[3]="";//Father
$temp[4]="0";//Lac_no
$temp[5]="";//Part_no
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=6;$i++)
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

return($temp);
}//VerifyArray

?>
</body>
</html>
