<html>
<head>
<title>Entry Form for verification</title>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
//include("header.php");
?>
<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript">
<!--

//var j1=myform.rollno.selectedIndex;//Returns Numeric Index from 0
//var j2=myform.box1.checked;//Return true if check box is checked
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";
//StringValid('a',0,0) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(0- Simple Validation(With Single Quote Allow),1- No Quote, 2- Strong Validation)
//NumericValid('a',0,type) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(type: 'Positive'(>0), 'Negative'(<0), 'NonNegative'(>=0), 'Zero'(=0),'Any'(any Number)'

//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
//myform.action="Insert_verification.php";

function load_village()
{
var data="Cir="+document.getElementById('Circle').value;
MyAjaxFunction("POST","LoadSelectBox.php?type=V",data,'vill',"HTML");
}

function loadme()
{
document.getElementById('Village').value=document.getElementById('Vill_code').value;
}

function arrange()
{
RemoveAllSpace('Pin');
}
function direct()
{
var mvalue=document.getElementById('Editme').value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
document.getElementById('Id').value=mvalue;

var a=document.getElementById('Id').value ;//Primary Key
if ( isNumber(a))
{
myform.action="Form_verification.php?tag=2&ptype=0";
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
myform.Id.focus();
}



function validate()
{

var pinvalid=StringValid('Pin',1,1);
//var a=document.getElementById('Pin').value;

if (SelectBoxIndex('Verification_type')>0   && StringValid('Letter_no',1,1) && DateValid('Letter_date',1) && StringValid('Department',1,0) && StringValid('Address',0,1) && pinvalid==true && DateValid('Start_date',1) && StringValid('Name',1,1) && SelectBoxIndex('Reln')>0  && StringValid('Rel_name',1,1) && SelectBoxIndex('Circle')>0  && SelectBoxIndex('Pol_stn')>0  && StringValid('Village',1,1) )
{
document.getElementById('SaveData').value=1;
document.getElementById('Save').disabled=true;
myform.action="Form_Verification.php";
myform.submit();
}
else
{
if (SelectBoxIndex('Verification_type')==0)
{
alert('Non Numeric Value in Verification_type');
document.getElementById('Verification_type').focus();
}
else if (StringValid('Letter_no',1,1)==false)//0-Simple Validation
{
alert('Check Letter_no');
document.getElementById('Letter_no').focus();
}
else if (DateValid('Letter_date',1)==false)
{
alert('Check Date Letter_date');
document.getElementById('Letter_date').focus();
}
else if (StringValid('Department',1,0)==false)//0-Simple Validation
{
alert('Check Department');
document.getElementById('Department').focus();
}
else if (StringValid('Address',0,1)==false)//0-Simple Validation
{
alert('Check Address');
document.getElementById('Address').focus();
}
else if (pinvalid=false)//0-Simple Validation
{
alert('Check Pin');
document.getElementById('Pin').focus();
}
else if (DateValid('Start_date',1)==false)
{
alert('Check Date Start_date');
document.getElementById('Start_date').focus();
}
else if (StringValid('Name',1,1)==false)//0-Simple Validation
{
alert('Check Name');
document.getElementById('Name').focus();
}
else if (SelectBoxIndex('Reln')==0)
{
alert('Select Reln');
document.getElementById('Reln').focus();
}
else if (StringValid('Rel_name',1,1)==false)//0-Simple Validation
{
alert('Check Rel_name');
document.getElementById('Rel_name').focus();
}
else if (SelectBoxIndex('Circle')==0)
{
alert('Select Circle');
document.getElementById('Circle').focus();
}
else if (SelectBoxIndex('Pol_stn')==0)
{
alert('Select Pol_stn');
document.getElementById('Pol_stn').focus();
}
else if (StringValid('Village',1,1)==false)//0-Simple Validation
{
alert('Check Village');
document.getElementById('Village').focus();
}
else 
alert('Enter Correct Data');
}
}//End Validate




function home()
{
window.location="vermenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
//document.getElementById(a).focus();
}


function LoadTextBox()
{
var i=document.getElementById('Editme').selectedIndex;
if(i>0)
document.getElementById('edit1').disabled=false;
else
document.getElementById('edit1').disabled=true;
//alert('Write Java Script as per requirement');
}

//Reset Form
function res()
{
window.location="Form_verification.php?tag=0";
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
//var data="Acc_no="+$("#Acc_no").val();
//MyAjaxFunction("POST","Requestfile.php",data,'DivArea','HTML');
$("#Id").change(function(event){
$("#DivMsg").hide();
});

//var mname = [" ","January","February","March","April","May","June","July","August","September","October","November","December"];
//$("#ChekBoxId").prop('checked', true); //Set heckbox Property
$("#Save").click(function(event){
//alert('You Clicked me');
});

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


//MyAjaxFunction("POST","LoadSelectBoxVerification.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>
</head>
<body>
<?php
//Start FORMPHPBODY
require_once '../class/utility.class.php';
require_once './class/class.verification.php';
require_once '../class/class.sentence.php';
//Start Function/Method Guide

//$val=$objVerification->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objVerification->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objVerification->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objVerification->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on

//$objVerification->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//$objVerification->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objVerification->genDataGrid($title,$headlist,$align, $sql,95);
//$objVerification->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);

//$objVerification->DefaultOptDetail = "-Select-"; //Common parameter
//$objVerification->DefaultOptRequired = 1; //Common parameter
//$objVerification->CountRecords($Table, $condition) //DBManager
//$objVerification->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager
//Following function return the code to generate the specific HTML element
//$objVerification->returnCheckBox($id, $val,  $function)  //DBManager
//$objVerification->returnInputBox($id, $val, $size, $maxlength, $function)
//$objVerification->returnButton($id, $val, $pix,$function)
//$objVerification->returnHiddenBox($id, $val)
//$objVerification->returnSelectBox($id, $query, $val, $pix, $function)
//$objVerification->returnDatePicker($Fld, $level)
//$objVerification->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

//End Function/Method Guide

//Set Select Box Property
$bcol="white";
$fcol="black";
$font="14";

//Set Table Color
$HeadColor="#CCCC99";
$BodyColor=$bcol;
$FootColor="#CCCC99";
//$BottomColor="WHITE";
$BottomColor=$FootColor;



$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../startmenu.php?unauth=1');

$objVerification=new Verification();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_SESSION['myArea']))
$Area=$_SESSION['myArea'];
else
$Area=0;


if ($objUtility->checkArea($Area,25)==true || $objUtility->checkArea($Area,26)==true || $objUtility->checkArea($Area,27)==true) //e.g 25-26 verification of character/caste and prc
$a=0;
else
header( 'Location: vermenu.php?unauth=1');


if($objUtility->checkArea($Area,25)==true)
$areacode=25;
if($objUtility->checkArea($Area,26)==true)
$areacode=26;
if($objUtility->checkArea($Area,27)==true)
$areacode=27;
if($roll==0)
$areacode=0;

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

if (isset($_POST['SaveData'])) //If Post data is to be Saved
$save = $_POST['SaveData'];
else
$save = 0;

$present_date=date('d/m/Y');
$mvalue=array();

if ($_tag==0 && $save==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[0]=$objVerification->MaxId();
}//tag=0[Initial Loading]

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
else
$mvalue=InitArray();
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
//$mvalue[0]=$objVerification->MaxId();
}//tag=1 [Return from Action form]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Id']))
$objVerification->setId($_POST['Id']);//Push Primary Key Data to Class
if ($objVerification->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objVerification->getId();
$mvalue[1]=$objVerification->getVerification_type();
$mvalue[2]=$objVerification->getLetter_no();
$mvalue[3]=$objUtility->to_date($objVerification->getLetter_date());
$mvalue[4]=$objVerification->getDepartment();
$mvalue[5]=$objVerification->getAddress();
$mvalue[6]=$objVerification->getPin();
$mvalue[7]=$objUtility->to_date($objVerification->getStart_date());
$mvalue[8]=$objVerification->getName();
$mvalue[9]=$objVerification->getReln();
$mvalue[10]=$objVerification->getRel_name();
$mvalue[11]=$objVerification->getCircle();
$mvalue[12]=$objVerification->getPol_stn();
$mvalue[13]=$objVerification->getVillage();
$mvalue[14]=0;//last Select Box for Editing
$mvalue[15]=$objVerification->getSender();
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
} //EditRecord()
} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
?>
<form name=myform action=Form_Verification.php  method=POST >
<table border=1 cellpadding=0 cellspacing=0 align=center style='border-collapse: collapse;' width=90%>
<tr><td align=center>
<table border=0 cellpadding=2 cellspacing=0 align=center style='border-collapse: collapse;' width=100%>
<tr>
<td colspan=4 align=Center bgcolor=<?php echo $HeadColor;?> height=30><font face=arial size=3>
Entry/Edit Form for Verification of Character/Caste/PRC<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
 ?>
<?php //row1?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"ID", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Id",$mvalue[0],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Id",$mvalue[0],8,0,$bcol, $fcol, $font,$function,1);
//$objVerification->genCheckBox("Check1", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Type", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$ValueList=array();
$a=0;
if($areacode==25 || $areacode==0)
{
$ValueList[$a][0]=1;
$ValueList[$a++][1]="Character Verification";
}

if($areacode==26 || $areacode==0)
{
$ValueList[$a][0]=2;
$ValueList[$a++][1]="Caste Verification";
}

if($areacode==27 || $areacode==0)
{
$ValueList[$a][0]=3;
$ValueList[$a++][1]="PRC Verification";
}
echo "<td>";
$objVerification->genSelectBoxByValueArray("Verification_type", $ValueList, $mvalue[1], 200, $bcol, $fcol, $font, $function);
echo "</td>";

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Verification_type",$mvalue[1],8,0,$bcol, $fcol, $font,$function,1);
//$objVerification->genCheckBox("Check3", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php
$objVerification->bcol="#99FF99";//Set Back Color Table Cell
$objVerification->TdText(2, 2,"Letter Source Detail", 0, 0, 4);
?>
<?php //row2?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Letter No", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Letter_no",$mvalue[2],50,100,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Letter_no",$mvalue[2],50,100,$bcol, $fcol, $font,$function,0);
//$objVerification->genCheckBox("Check4", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Letter Date", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBoxWithDatePicker(1,$bcol,"Letter_date",$mvalue[3],10,10,$function,2);
?>
</tr>
<?php //row3?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Department", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function="";
$row=4;
$col=50;
$objVerification->TdTextArea(1,$bcol,"Department",$mvalue[4],$row,$col,$function,0);
?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Address", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Address",$mvalue[5],30,100,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Address",$mvalue[5],30,100,$bcol, $fcol, $font,$function,0);
//$objVerification->genCheckBox("Check7", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row4?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Designation of Sender", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Sender",$mvalue[15],50,100,$function,1);


$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"PIN", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=arrange()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Pin",$mvalue[6],6,6,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Pin",$mvalue[6],6,6,$bcol, $fcol, $font,$function,1);
//$objVerification->genCheckBox("Check8", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
<?php
//$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
//$objVerification->TdText(3, 2,"Issue Date", 0, 0, 0);
//$objVerification->bcol="white";//Set Back Color for Html Box
//$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
//$objVerification->TdInputBoxWithDatePicker(1,$bcol,"Start_date",$mvalue[7],10,10,$function,2);
$objVerification->genHiddenBox("Start_date",$mvalue[7]);
?>
</tr>
<?php
$objVerification->bcol="#99FF99";//Set Back Color Table Cell
$objVerification->TdText(2, 2,"Candidates Detail", 0, 0, 4);
?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Candidate Name", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Name",$mvalue[8],50,50,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Name",$mvalue[8],50,50,$bcol, $fcol, $font,$function,1);
//$objVerification->genCheckBox("Check10", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Relation", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function="onchange=redirect(11)";
$query="Select Rel_name,Rel_name from relation where artps=0";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->TdSelectBox(1, $bcol,"Reln",$mvalue[9],$query, 160, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
?>
</tr>
<?php //row6?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Father's Name", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Rel_name",$mvalue[10],40,40,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Rel_name",$mvalue[10],40,40,$bcol, $fcol, $font,$function,1);
//$objVerification->genCheckBox("Check12", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select Circle", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function="onchange=load_village()";
$query="Select Cir_code,Circle from circle where 1=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->TdSelectBox(1, $bcol,"Circle",$mvalue[11],$query, 160, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
?>
</tr>
<?php //row7?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select PS", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function="onchange=redirect(16)";
$query="Select Code,Name from police_station where 1=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->TdSelectBox(1, $bcol,"Pol_stn",$mvalue[12],$query, 160, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
?>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Village", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Village",$mvalue[13],30,100,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objVerification->genInputBox("Village",$mvalue[13],50,100,$bcol, $fcol, $font,$function,0);
//$objVerification->genCheckBox("Check17", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<tr>
<td align=right bgcolor=<?php echo $FootColor;?>>
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
<td align=left bgcolor=<?php echo $FootColor;?> colspan=3>
<?php 
$objVerification->genHiddenBox("SaveData",0);
$objVerification->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->genButton("Save", $cap,100 ,"#339966","black", $font," onclick=validate()");
$objVerification->genButton("back1","Menu",100 , "#339966","black", $font," onclick=home()");
$objVerification->genHiddenBox("XML",0);
?>
</td></tr>
<tr><td align=right bgcolor=<?php echo $BodyColor;?>><font color=red size=2 face=arial>
</td>
<td align=left bgcolor=<?php echo $BodyColor;?> colspan=2>
<?php 
$function=" onchange=LoadTextBox()";

$dcond=" and 1=1";
$areacode=$areacode-24;
if($areacode>0)
$dcond=" and Verification_type=".$areacode;

$query="Select Id,Name,Village,start_date from Verification where (Pol_status='Pending' or Pol_status='Entered')".$dcond."  order by Name";

//echo $query;
$ValueList=array();
$row=$objVerification->FetchRecords($query);
$a=0;
for($i=0;$i<count($row);$i++)
{
//echo $row[$i][1]."=".$objUtility->dateDiff(date('Y-m-d'),$row[$i][3])."<br>";
if($objUtility->dateDiff(date('Y-m-d'),$row[$i][3])<15)
{
$ValueList[$a][0]=$row[$i][0];
$ValueList[$a++][1]=$row[$i][1]." Vill-".$row[$i][2];
}
}
$objVerification->genSelectBoxByValueArray("Editme", $ValueList, $mvalue[14], 250, $bcol, $fcol, $font, $function);
?>
</td>
<td><div id=vill>Village List</div></td>
</tr>
<tr>
<td align=left bgcolor=<?php echo $BottomColor;?>></td>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=3>
<?php 
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->genButton("edit1","Edit",100 ,"#669966","black", $font," onclick=direct()");
$objVerification->genButton("res1","Reset",100 , "#669966","black", $font," onclick=res()");
?>
</td>
</tr>
</table>
</td></tr></table>
</form>
<?php
//Generate data Grid

$title="";
$headlist=array("Id","Verification_type","Letter_no","Letter_date","Department","Address","Pin","Start_date","Name","Reln","Rel_name","Circle","Pol_stn","Village");
$align=array(1,1,1,1,1,1,1,1,1,1,1,1,1,1);
$sql="Select Id,Verification_type,Letter_no,Letter_date,Department,Address,Pin,Start_date,Name,Reln,Rel_name,Circle,Pol_stn,Village from verification ";
//$objVerification->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Id");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
$objVerification=new Verification();
// Call $objVerification->MaxId() Function Here if required and Load in $mvalue[0]
$temp[0]=$objVerification->MaxId();//Id
$temp[1]="1";//Verification_type
$temp[2]="";//Letter_no
$temp[3]="";//Letter_date
$temp[4]="";//Department
$temp[5]="";//Address
$temp[6]="";//Pin
$temp[7]=date('d/m/Y');//Start_date
$temp[8]="";//Name
$temp[9]="";//Reln
$temp[10]="";//Rel_name
$temp[11]="0";//Circle
$temp[12]="0";//Pol_stn
$temp[13]="";//Village
$temp[14]="0";//Pol_status
$temp[15]="";//sender
$temp[16]="";//Reserve
$temp[17]="";//Reserve 
$temp[18]="";//Reserve
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=19;$i++)
{
$temp[$i]="";
}
$temp[0]=0;
$temp[1]=1;

//$temp[0]=0; //Sometimes this type assignment may be required

for($i=0;$i<=19;$i++)
{
if(isset($myvalue[$i]))
$temp[$i]=$myvalue[$i];
}

return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";
$rvalue=array();
//Required for Edit and Insert in same Form
if ($_SESSION['update']==1)
{
if (isset($_POST['Id'])) //If Last Pk Field is available
$_Id=$_POST['Id'];
else
$_Id=0;
}

if ($_SESSION['update']==0)
$_Id=$objVerification->maxId();

$objVerification->setId($_Id);// Primary Key
$rvalue[0]=$_Id;


//Push Id
if (isset($_POST['Id'])) //If HTML Field is Availbale
{
//$mvalue[0]=trim($_POST['Id']);
//$objVerification->setId($mvalue[0]);// Primary Key
//$rvalue[0]=$mvalue[0];
}

//Push Verification_type
if (isset($_POST['Verification_type'])) //If HTML Field is Availbale
{
$mvalue[1]=trim($_POST['Verification_type']);
$objVerification->setVerification_type($mvalue[1]);
$rvalue[1]=$mvalue[1];
}

//Push Letter_no
if (isset($_POST['Letter_no'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Letter_no']);
$objVerification->setLetter_no($mvalue[2]);
$rvalue[2]=$mvalue[2];
}

//Push Letter_date
if (isset($_POST['Letter_date'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Letter_date']);
$objVerification->setLetter_date($mvalue[3]);
$rvalue[3]=$mvalue[3];
}

//Push Department
if (isset($_POST['Department'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Department']);
$objVerification->setDepartment($mvalue[4]);
$rvalue[4]=$mvalue[4];
}

//Push Address
if (isset($_POST['Address'])) //If HTML Field is Availbale
{
$mvalue[5]=trim($_POST['Address']);
$objVerification->setAddress($mvalue[5]);
$rvalue[5]=$mvalue[5];
}

//Push Pin
if (isset($_POST['Pin'])) //If HTML Field is Availbale
{
$mvalue[6]=trim($_POST['Pin']);
$objVerification->setPin($mvalue[6]);
$rvalue[6]=$mvalue[6];
}

//Push Start_date
if (isset($_POST['Start_date'])) //If HTML Field is Availbale
{
$mvalue[7]=trim($_POST['Start_date']);
$objVerification->setStart_date($mvalue[7]);
$rvalue[7]=$mvalue[7];
}

$objS=new Sentence();
//Push Name
if (isset($_POST['Name'])) //If HTML Field is Availbale
{
$mvalue[8]=trim($objS->SentenceCase($_POST['Name']));
$objVerification->setName($mvalue[8]);
$rvalue[8]=$mvalue[8];
}

//Push Reln
if (isset($_POST['Reln'])) //If HTML Field is Availbale
{
$mvalue[9]=trim($_POST['Reln']);
$objVerification->setReln($mvalue[9]);
$rvalue[9]=$mvalue[9];
}

//Push Rel_name
if (isset($_POST['Rel_name'])) //If HTML Field is Availbale
{
$mvalue[10]=trim($objS->SentenceCase($_POST['Rel_name']));
$objVerification->setRel_name($mvalue[10]);
$rvalue[10]=$mvalue[10];
}

//Push Circle
if (isset($_POST['Circle'])) //If HTML Field is Availbale
{
$mvalue[11]=trim($_POST['Circle']);
$objVerification->setCircle($mvalue[11]);
$rvalue[11]=$mvalue[11];
}

//Push Pol_stn
if (isset($_POST['Pol_stn'])) //If HTML Field is Availbale
{
$mvalue[12]=trim($_POST['Pol_stn']);
$objVerification->setPol_stn($mvalue[12]);
$rvalue[12]=$mvalue[12];
}

//Push Village
if (isset($_POST['Village'])) //If HTML Field is Availbale
{
$mvalue[13]=trim($_POST['Village']);
$objVerification->setVillage($mvalue[13]);
$rvalue[13]=$mvalue[13];
}

if (isset($_POST['Sender'])) //If HTML Field is Availbale
{
$mvalue[15]=trim($_POST['Sender']);
$objVerification->setSender($mvalue[15]);
$rvalue[15]=$mvalue[15];
}

$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objVerification->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objVerification->UpdateRecord();
if($objVerification->rowCommitted>0)
$mmode="Data Updated Successfully(Not Down ID-".$_Id.")";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objVerification->returnSql;
$objUtility->CreateLogFile("Verification",$sql,2,"D");
$mvalue = InitArray();

if(isset($rvalue[3]))
$mvalue[3]=$rvalue[3]; //reinitialise mvalue with prev value

if(isset($rvalue[4]))
$mvalue[4]=$rvalue[4]; //reinitialise mvalue with prev value

if(isset($rvalue[5]))
$mvalue[5]=$rvalue[5]; //reinitialise mvalue with prev value

if(isset($rvalue[6]))
$mvalue[6]=$rvalue[6]; //reinitialise mvalue with prev value

if(isset($rvalue[15]))
$mvalue[15]=$rvalue[15];

$_SESSION['update']=0;
}
else //Fails
{
$Er= $objVerification->Error();
$Er.=$objVerification->ValidationErrorList;
$returnmsg=$Er;
//$objUtility->saveErrorLog("Error",$Er);
if($objVerification->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objVerification->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_verification.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Form_Verification.php?tag=1");
}//$save=1
?>
</body>
</html>
