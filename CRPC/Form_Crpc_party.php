<html>
<head>
<title>Entry Form for crpc_party</title>
</head>
<?php
include("header.php");
?>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
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
//myform.action="Insert_crpc_party.php";
function load()
{
    
}
function direct()
{
var mvalue=document.getElementById('Editme').value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
document.getElementById('Rsl').value=mvalue;

var a=document.getElementById('Case_yr').value ;//Primary Key
var b=document.getElementById('Case_no').value ;//Primary Key
var c=document.getElementById('Category').value ;//Primary Key
var d=document.getElementById('Rsl').value ;//Primary Key
if ( SimpleValidate(a,1) && isNumber(b) && isNumber(c) && isNumber(d))
{
myform.action="Form_crpc_party.php?tag=2&ptype=0";
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
myform.Case_yr.focus();
}

function redirect(i)
{
myform.action="Form_crpc_party.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}


function validate()
{
var b=myform.Case_no.value ;// Primary Key
var c=myform.Category.value ;// Primary Key
var d=myform.Rsl.value ;// Primary Key
var g=myform.Age.value ;
//document.getElementById('Village').value=document.getElementById('Villname').value;

if ( StringValid('Case_yr',1,1) && NumericValid('Case_no',1,'Positive')==true   && NumericValid('Category',1,'Positive')==true    && StringValid('Name',1,1) && StringValid('Reln',1,1) && NumericValid('Age',1,'NonNegative')==true   && StringValid('Sex',1,1) && StringValid('Father',1,1) && StringValid('Circle',0,1) && StringValid('Police_station',0,1) && StringValid('Village',1,1))
{
document.getElementById('SaveData').value=1;
myform.action="Form_Crpc_party.php";
myform.submit();
}
else
{
if (StringValid('Case_yr',1,1)==false)//0-Simple Validation
{
alert('Check Case_yr');
document.getElementById('Case_yr').focus();
}
else if (NumericValid('Case_no',1,'Positive')==false)
{
alert('Non Numeric Value in Case_no');
document.getElementById('Case_no').focus();
}
else if (NumericValid('Category',1,'Positive')==false)
{
alert('Non Numeric Value in Category');
document.getElementById('Category').focus();
}
else if (StringValid('Name',1,1)==false)//0-Simple Validation
{
alert('Check Name');
document.getElementById('Name').focus();
}
else if (StringValid('Reln',1,1)==false)//0-Simple Validation
{
alert('Check Reln');
document.getElementById('Reln').focus();
}
else if (NumericValid('Age',1,'NonNegative')==false)
{
alert('Non Numeric Value in Age');
document.getElementById('Age').focus();
}
else if (StringValid('Sex',1,1)==false)//0-Simple Validation
{
alert('Check Sex');
document.getElementById('Sex').focus();
}
else if (StringValid('Father',1,1)==false)//0-Simple Validation
{
alert('Check Father');
document.getElementById('Father').focus();
}
else if (StringValid('Circle',0,1)==false)//0-Simple Validation
{
alert('Check Circle');
document.getElementById('Circle').focus();
}
else if (StringValid('Police_station',0,1)==false)//0-Simple Validation
{
alert('Check Police_station');
document.getElementById('Police_station').focus();
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
window.location="crpcmenu.php?tag=1";
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
window.location="Form_crpc_party.php?tag=0";
}
//END JAVA
</script>
<script src="../jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');
//var data="Acc_no="+$("#Acc_no").val();
//MyAjaxFunction("POST","Requestfile.php",data,'DivArea','HTML');
$("#Case_yr").change(function(event){
$("#DivMsg").hide();
});

//var mname = [" ","January","February","March","April","May","June","July","August","September","October","November","December"];
//$("#ChekBoxId").prop('checked', true); //Set heckbox Property
$("#Save").click(function(event){
//alert('You Clicked me');
});

$("#Circle").change(function(event){
//var data="Cir="+document.getElementById('Circle').value;
//alert(data);
//MyAjaxFunction("POST","LoadVillage.php",data,'VILL',"HTML");
});//$("#Circe_code)



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


//MyAjaxFunction("POST","LoadSelectBoxCrpc_party.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>
<body>
<?php
//Start FORMPHPBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_party.php';

//Start Function/Method Guide
//$val=$objCrpc_party->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objCrpc_party->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objCrpc_party->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objCrpc_party->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on

//$objCrpc_party->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//$objCrpc_party->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objCrpc_party->genDataGrid($title,$headlist,$align, $sql,95);
//$objCrpc_party->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);


//End Function/Method Guide

//Set Select Box Property
$bcol="white";
$fcol="black";
$font="14";

//Set Table Color
$HeadColor="#CCCC99";
$BodyColor="WHITE";
$FootColor="#CCCC99";
$BottomColor="WHITE";


$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

$objCrpc_party=new Crpc_party();


if ($objUtility->checkArea($_SESSION['myArea'], 24)==false) //24 for Case management
header( 'Location: crpcmenu.php?unauth=1');


if(isset($_SESSION['redirect']))
$redirect=$_SESSION['redirect'];
else
$redirect=false;    


if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_SESSION['myArea']))
$Area=$_SESSION['myArea'];
else
$Area=0;

//if ($objUtility->checkArea($_SESSION['myArea'], 12)==false) //e.g 12 for Eroll Certificate
//header( 'Location: Mainmenu.php?unauth=1');

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
if(isset($_GET['yr']))
$caseyr=$_GET['yr'];
else
$caseyr="-";    
if(isset($_GET['no']))
$caseno=$_GET['no'];
else
$caseno="0";
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;

if($redirect)
{
$mvalue[0]=$caseyr;
$mvalue[1]=$caseno;
}
//$mvalue[1]=$objCrpc_party->MaxCase_no();
//$mvalue[2]=$objCrpc_party->MaxCategory();
//$mvalue[3]=$objCrpc_party->MaxRsl();
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
//$mvalue[1]=$objCrpc_party->MaxCase_no();
//$mvalue[2]=$objCrpc_party->MaxCategory();
//$mvalue[3]=$objCrpc_party->MaxRsl();
}//tag=1 [Return from Action form]

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
if (isset($_POST['Case_yr']))
$mvalue[0]=$_POST['Case_yr'];
else
$mvalue[0]=0;

if (isset($_POST['Case_no']))
$mvalue[1]=$_POST['Case_no'];
else
$mvalue[1]=0;

if (isset($_POST['Category']))
$mvalue[2]=$_POST['Category'];
else
$mvalue[2]=0;

if (isset($_POST['Rsl']))
$mvalue[3]=$_POST['Rsl'];
else
$mvalue[3]=0;

if (isset($_POST['Name']))
$mvalue[4]=$_POST['Name'];
else
$mvalue[4]=0;

if (isset($_POST['Reln']))
$mvalue[5]=$_POST['Reln'];
else
$mvalue[5]=0;

if (isset($_POST['Age']))
$mvalue[6]=$_POST['Age'];
else
$mvalue[6]=0;

if (isset($_POST['Sex']))
$mvalue[7]=$_POST['Sex'];
else
$mvalue[7]=0;

if (isset($_POST['Father']))
$mvalue[8]=$_POST['Father'];
else
$mvalue[8]=0;

if (isset($_POST['Circle']))
$mvalue[9]=$_POST['Circle'];
else
$mvalue[9]=0;

if (isset($_POST['Police_station']))
$mvalue[10]=$_POST['Police_station'];
else
$mvalue[10]=0;

if (isset($_POST['Village']))
$mvalue[11]=$_POST['Village'];
else
$mvalue[11]=0;

if (isset($_POST['Editme']))
$mvalue[12]=$_POST['Editme'];
else
$mvalue[12]=0;

} //ptype=1

if (isset($_POST['Case_yr']))
$objCrpc_party->setCase_yr($_POST['Case_yr']);//Push Primary Key Data to Class
if (isset($_POST['Case_no']))
$objCrpc_party->setCase_no($_POST['Case_no']);//Push Primary Key Data to Class
if (isset($_POST['Category']))
$objCrpc_party->setCategory($_POST['Category']);//Push Primary Key Data to Class
if (isset($_POST['Rsl']))
$objCrpc_party->setRsl($_POST['Rsl']);//Push Primary Key Data to Class
if ($objCrpc_party->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objCrpc_party->getCase_yr();
$mvalue[1]=$objCrpc_party->getCase_no();
$mvalue[2]=$objCrpc_party->getCategory();
$mvalue[3]=$objCrpc_party->getRsl();
$mvalue[4]=$objCrpc_party->getName();
$mvalue[5]=$objCrpc_party->getReln();
$mvalue[6]=$objCrpc_party->getAge();
$mvalue[7]=$objCrpc_party->getSex();
$mvalue[8]=$objCrpc_party->getFather();
$mvalue[9]=$objCrpc_party->getCircle();
$mvalue[10]=$objCrpc_party->getPolice_station();
$mvalue[11]=$objCrpc_party->getVillage();
$mvalue[12]=0;//last Select Box for Editing
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
if(!is_numeric($mvalue[9]))
$mvalue[9]=-1;  
//Start of FormDesign
//$objCrpc_party->DefaultOption="";
?>
<table border=0 cellpadding=6 cellspacing=2 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=Form_Crpc_party.php  method=POST >
<tr>
<td colspan=4 align=Center bgcolor=<?php echo $HeadColor;?>><font face=arial size=3>
Enter Detail of Party<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
$objCrpc_party->bcol=$BodyColor;//Set Body Color for all row
 ?>
<?php //row1?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Case Year", 0, 0, 0);
if($redirect==true)
$function=" readonly ";
else
$function="onchange=redirect(1)";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_party->TdInputBox(1,$bcol,"Case_yr",$mvalue[0],4,4,$function,1);
?>
<?php
$objCrpc_party->TdText(3, 2,"Case No", 0, 0, 0);
if($redirect==true)
{
$function="";
$query="Select Case_no from Crpc_main where status='Running' and case_yr='".$mvalue[0]."' and  case_no=".$mvalue[1];
}
else
{
$function=" onchange=redirect(2)";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$query="Select Case_no from Crpc_main where status='Running' and case_yr='".$mvalue[0]."' order by case_no";
}
//$objCrpc_main->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//$objCrpc_party->genSelectBox("Case_no", $query,$mvalue[1],"150", $bcol, $fcol, $font, $function);
$objCrpc_party->TdSelectBox(1, $bcol,"Case_no", $mvalue[1], $query, 150, $function)
?>
</tr>
<?php //row2?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Category", 0, 0, 0);
$ValueList=array();
$ValueList[0][0]=1;
$ValueList[0][1]="First Party";
$ValueList[1][0]=2;
$ValueList[1][1]="Second Party";

echo "<td align=left>";
$function=" ";
$objCrpc_party->genSelectBoxByValueArray("Category", $ValueList, $mvalue[2], 150, $bcol, $fcol, 12, $function);
//echo "RSL-".$mvalue[3];
echo "</td>";
?>
<?php
//$objCrpc_party->TdText(3, 2,"Serial No", 0, 0, 0);
$function=" readonly";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_party->TdInputBox(1,$bcol,"Rsl",$mvalue[3],8,0,$function,1);
$objCrpc_party->genHiddenBox("Rsl", $mvalue[3])
?>
</tr>
<?php //row3?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Name of Person", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_party->TdInputBox(1,$bcol,"Name",$mvalue[4],50,70,$function,1);
?>
<?php
$objCrpc_party->TdText(3, 2,"Relation", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_party->TdInputBox(1,$bcol,"Reln",$mvalue[5],15,15,$function,1);

$query="select rel_name from relation where artps=0";
//$objCrpc_party->genSelectBox("Sex", $query, $mvalue[7], 100, $bcol, $fcol, $font, $function);
$objCrpc_party->TdSelectBox(1, $bcol, "Reln", $mvalue[5], $query, 120, $function)

?>
</tr>
<?php //row4?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Age", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_party->TdInputBox(1,$bcol,"Age",$mvalue[6],8,0,$function,1);
?>
<?php
$objCrpc_party->TdText(3, 2,"Sex", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_party->TdInputBox(1,$bcol,"Sex",$mvalue[7],1,1,$function,1);
$query="select * from sex";
//$objCrpc_party->genSelectBox("Sex", $query, $mvalue[7], 100, $bcol, $fcol, $font, $function);
$objCrpc_party->TdSelectBox(1, $bcol, "Sex", $mvalue[7], $query, 100, $function)
?>
</tr>
<?php //row5?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Father", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_party->TdInputBox(1,$bcol,"Father",$mvalue[8],40,40,$function,1);
?>
<?php
$objCrpc_party->TdText(3, 2,"Circle", 0, 0, 0);
$function=" ";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$query="SELECT cir_code ,circle FROM circle where cir_code>0 order by circle";
$objCrpc_party->TdSelectBox(1, $bcol, "Circle", $mvalue[9], $query, "170", $function);

?>
</tr>
<?php //row6?>
<tr>
<?php
$objCrpc_party->TdText(3, 2,"Police Station", 0, 0, 0);
$function="";
$query="SELECT CODE ,NAME FROM POLICE_STATION where code>0 order by name";
$objCrpc_party->TdSelectBox(1, $bcol, "Police_station", $mvalue[10], $query, "170", $function);
$objCrpc_party->TdText(3, 2,"Enter Village", 0, 0, 0);
$function="";

$objCrpc_party->TdInputBox(1,$bcol,"Village","",40,40,"",0);
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
$objCrpc_party->genHiddenBox("SaveData",0);
$objCrpc_party->genHiddenBox("Pdate",$present_date);
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_party->genButton("Save", $cap,100 ,"#6666FF","black", $font," onclick=validate()");
$objCrpc_party->genButton("back1","Menu",90 , "#6666FF","black", $font," onclick=home()");
$objCrpc_party->genHiddenBox("XML",0);
?>
</td></tr>
<tr><td align=right bgcolor=<?php echo $BottomColor;?> rowspan=2><font color=red size=3 face=arial>
</td>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=3>
<?php 
$function=" onchange=LoadTextBox()";
$query="Select Rsl,Name from Crpc_party where Case_yr='".$mvalue[0]."' and case_no=".$mvalue[1]."  order by Name";
//$objCrpc_party->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//$objCrpc_party->genSelectBox("Editme", $query,$mvalue[12],"300", $bcol, $fcol, $font, $function);
?>
</td></tr>
<tr>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=3>
<?php 
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objCrpc_party->genButton("edit1","Edit",80 ,"#CCCCFF","black", $font," onclick=direct()");
//$objCrpc_party->genButton("res1","Reset",80 , "#CCCCFF","black", $font," onclick=res()");
?>
</td>
</tr>
</table>
</form>
<?php
//Generate data Grid

$title="First Party";
$headlist=array("Name","Father","Village","Age","Sex");
$align=array(1,1,1,2,2);
$sql="Select Name,Father,Village,Age,Sex from Crpc_party where category=1 and Case_yr='".$mvalue[0]."' and case_no=".$mvalue[1]." order by Name";
$objCrpc_party->genDataGrid($title, $headlist, $align, $sql,80);
echo "<br>";
$title="Second Party";
$sql="Select Name,Father,Village,Age,Sex from Crpc_party where category=2 and Case_yr='".$mvalue[0]."' and case_no=".$mvalue[1]." order by Name";
$objCrpc_party->genDataGrid($title, $headlist, $align, $sql,80);


if($mtype==0)
echo $objUtility->focus("Case_yr");

if($mtype==1)//Postback from Case_yr
echo $objUtility->focus("Case_no");

if($mtype==2)//Postback from Case_no
echo $objUtility->focus("Category");

if($mtype==4)//Postback from Category
echo $objUtility->focus("Village");

if($mtype==3)//Postback from Rsl
echo $objUtility->focus("Name");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objCrpc_party=new Crpc_party();
$temp[0]=date('Y');//Case_yr
// Call $objCrpc_party->MaxCase_no() Function Here if required and Load in $mvalue[1]
$temp[1]="0";//Case_no
// Call $objCrpc_party->MaxCategory() Function Here if required and Load in $mvalue[2]
$temp[2]="0";//Category
// Call $objCrpc_party->MaxRsl() Function Here if required and Load in $mvalue[3]
$temp[3]="0";//Rsl
$temp[4]="";//Name
$temp[5]="";//Reln
$temp[6]="0";//Age
$temp[7]="";//Sex
$temp[8]="";//Father
$temp[9]="-1";//Circle
$temp[10]="";//Police_station
$temp[11]="";//Village
$temp[12]="0";//
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=12;$i++)
{
$temp[$i]="";
}
$temp[0]=0;
$temp[1]=0;
$temp[2]=0;

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

if(isset($myvalue[7]))
$temp[7]=$myvalue[7];

if(isset($myvalue[8]))
$temp[8]=$myvalue[8];

if(isset($myvalue[9]))
$temp[9]=$myvalue[9];

if(isset($myvalue[10]))
$temp[10]=$myvalue[10];

if(isset($myvalue[11]))
$temp[11]=$myvalue[11];

if(isset($myvalue[12]))
$temp[12]=$myvalue[12];
return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";

//Push Case_yr
if (isset($_POST['Case_yr'])) //If HTML Field is Availbale
{
$mvalue[0]=trim($_POST['Case_yr']);
$objCrpc_party->setCase_yr($mvalue[0]);// Primary Key
}

//Push Case_no
if (isset($_POST['Case_no'])) //If HTML Field is Availbale
{
$mvalue[1]=trim($_POST['Case_no']);
$objCrpc_party->setCase_no($mvalue[1]);// Primary Key
}
$caseyr=$mvalue[0];
$caseno=$mvalue[1];
//Push Category
if (isset($_POST['Category'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Category']);
$objCrpc_party->setCategory($mvalue[2]);// Primary Key
}


//Required for Edit and Insert in same Form
if ($_SESSION['update']==1)
{
//if (isset($_POST['Rsl'])) //If Last Pk Field is available
$mvalue[3]=$_POST['Rsl'];
//else
//$_Rsl=0;
}

if ($_SESSION['update']==0)
$mvalue[3]=$objCrpc_party->maxRsl ($mvalue[0], $mvalue[1], $mvalue[2]);


$objCrpc_party->setRsl($mvalue[3]);// Primary Key

//Push Name
if (isset($_POST['Name'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Name']);
$objCrpc_party->setName($mvalue[4]);
}

//Push Reln
if (isset($_POST['Reln'])) //If HTML Field is Availbale
{
$mvalue[5]=trim($_POST['Reln']);
$objCrpc_party->setReln($mvalue[5]);
}

//Push Age
if (isset($_POST['Age'])) //If HTML Field is Availbale
{
$mvalue[6]=trim($_POST['Age']);
$objCrpc_party->setAge($mvalue[6]);
}

//Push Sex
if (isset($_POST['Sex'])) //If HTML Field is Availbale
{
$mvalue[7]=trim($_POST['Sex']);
$objCrpc_party->setSex($mvalue[7]);
}

//Push Father
if (isset($_POST['Father'])) //If HTML Field is Availbale
{
$mvalue[8]=trim($_POST['Father']);
$objCrpc_party->setFather($mvalue[8]);
}

//Push Circle
if (isset($_POST['Circle'])) //If HTML Field is Availbale
{
$mvalue[9]=trim($_POST['Circle']);
$objCrpc_party->setCircle($mvalue[9]);
}

//Push Police_station
if (isset($_POST['Police_station'])) //If HTML Field is Availbale
{
$mvalue[10]=trim($_POST['Police_station']);
$objCrpc_party->setPolice_station($mvalue[10]);
}

//Push Village
if (isset($_POST['Village'])) //If HTML Field is Availbale
{
$mvalue[11]=trim($_POST['Village']);
$objCrpc_party->setVillage($mvalue[11]);
}



$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objCrpc_party->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objCrpc_party->UpdateRecord();
if($objCrpc_party->rowCommitted>0)
$mmode="Data Updated Successfully";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objCrpc_party->returnSql;
$objUtility->CreateLogFile("Crpc_Party",$sql,2,"D");
$mvalue = InitArray();
$mvalue[0]=$caseyr;
$mvalue[1]=$caseno;
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objCrpc_party->Error();
$Er.=$objCrpc_party->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
$mmode="Transaction Fails,Contact Administrator";
//echo $objCrpc_party->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_crpc_party.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Form_Crpc_party.php?tag=1");
}//$save=1
?>
</body>
</html>
