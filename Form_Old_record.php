<html>
<head>
<title>Entry Form for old_record</title>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/kolkata");
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
//myform.action="Insert_old_record.php";



function EditThroughJSON()
{
var data=ConstructDataString();
var Box=['Id','Cert_type','Cert_no','Issue_date','Name_of_certholder','Fathers_name','Village'];
var bType=[0,0,0,0,0,0,0];//0-value 1-SelectedIndex 2-checked
JSONParsedString("ServerRequest/Json_old_record.php" ,data,Box,0,bType);
}



function direct()
{
var mvalue=document.getElementById('Editme').value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
document.getElementById('Id').value=mvalue;

var a=document.getElementById('Id').value ;//Primary Key
if ( isNumber(a))
{
myform.action="Form_old_record.php?tag=2&ptype=0";
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
var a=myform.Id.value ;// Primary Key
if ( NumericValid('Id',1,'NonNegative')==true   && StringValid('Cert_type',1,1) && StringValid('Cert_no',1,1) && DateValid('Issue_date',1) && StringValid('Name_of_certholder',1,1) && StringValid('Fathers_name',0,1) && StringValid('Village',1,1) &&  1==1)
{
document.getElementById('SaveData').value=1;
document.getElementById('Save').disabled=true;
document.getElementById('back1').disabled=true;
myform.action="Form_Old_record.php";
myform.submit();
}
else
{
if (NumericValid('Id',1,'NonNegative')==false)
{
alert('Non Numeric Value in Id');
document.getElementById('Id').focus();
}
else if (StringValid('Cert_type',1,1)==false)//0-Simple Validation
{
alert('Check Cert_type');
document.getElementById('Cert_type').focus();
}
else if (StringValid('Cert_no',1,1)==false)//0-Simple Validation
{
alert('Check Cert_no');
document.getElementById('Cert_no').focus();
}
else if (DateValid('Issue_date',1)==false)
{
alert('Check Date Issue_date');
document.getElementById('Issue_date').focus();
}
else if (StringValid('Name_of_certholder',1,1)==false)//0-Simple Validation
{
alert('Check Name_of_certholder');
document.getElementById('Name_of_certholder').focus();
}
else if (StringValid('Fathers_name',0,1)==false)//0-Simple Validation
{
alert('Check Fathers_name');
document.getElementById('Fathers_name').focus();
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
document.getElementById('Save').disabled=true;
document.getElementById('back1').disabled=true;
window.location="mainmenu.php?tag=1";
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
window.location="Form_old_record.php?tag=0";
}

function ConstructDataString()
{
var data="Utype=1";

//In Case of Check Box Use Following
//if(document.getElementById('CheckBoxId').checked==true)
//data=data+"&CheckBoxId=1";

var iBoxId="";///Change input Box ID Accordingly
//data=data+"&Param1="+document.getElementById(iBoxId).value;
iBoxId="";///Change input Box ID Accordingly
//data=data+"&Param2="+document.getElementById(iBoxId).value;
iBoxId="";///Change input Box ID Accordingly
//data=data+"&Param3="+document.getElementById(iBoxId).value;

data=data+"&Id="+document.getElementById('Id').value;

return(data);
}
//END JAVA
</script>
<script language="JavaScript" src="./datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="./datepicker/htmlDatePicker.css" rel="stylesheet"/>
<link href="./class/table.css" rel="stylesheet"/>
<script src="jquery-1.10.2.min.js"></script>
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


//MyAjaxFunction("POST","LoadSelectBoxOld_record.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>

<link href="./class/FaceBox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="./class/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
$('a[rel*=facebox]').facebox({
loadingImage : 'image/loading.gif',
closeImage   : 'image/closelabel.png'
})
})
</script>


</head>
<body>
<?php
//Start FORMPHPBODY
require_once './class/utility.class.php';
require_once './class/class.old_record.php';
//require_once './class/class.sentence.php';

//Start Function/Method Guide

//$val=$objOld_record->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objOld_record->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objOld_record->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objOld_record->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on


//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objOld_record->genDataGrid($title,$headlist,$align, $sql,95);
//$objOld_record->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);

//$objOld_record->DefaultOptDetail = "-Select-"; //Common parameter
//$objOld_record->DefaultOptRequired = 1; //Common parameter
//$objOld_record->CountRecords($Table, $condition) //DBManager
//$objOld_record->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager
//Following function return the code to generate the specific HTML element

//$objOld_record->returnCheckBox($id, $val,  $function)  //DBManager

//$objOld_record->returnInputBox($id, $val, $size, $maxlength, $function)

//$objOld_record->returnButton($id, $val, $pix,$function)

//$objOld_record->returnHiddenBox($id, $val)

//$objOld_record->returnSelectBox($id, $query, $val, $pix, $function)

//$objOld_record->returnDatePicker($Fld, $level)

//$objOld_record->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)
//$objOld_record->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//CheckBox($id, $val, $bcol, $fcol, $font, $function, $mandatory)

//$objOld_record->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//TdText($align, $font, $text, $width, $rspan, $cspan)

//genInputBox($id, $val, $size, $maxlength, $bcol, $fcol, $font, $function, $mandatory);
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function)
//CSS Button
//Type-0(pink),1(green),2(grey),3(red); $colortag-0(black)
//genCSSButton($id, $val,$width,$colortag,$font,$type,$function)

//TextHeader($msg,$width,$align,$bcol,$fcol,$font)

//End Function/Method Guide

//Set Select Box Property
$bcol="white";
$fcol="black";
$font="14";

//Set Table Color
$HeadColor="#EEE8D6";
$BodyColor=$bcol;
$FootColor="#CCCC99";
//$BottomColor="WHITE";
$BottomColor=$FootColor;



//SAMPLE HREF LINK FOR POPUP WINDOW
//echo "<a href=".chr(34)."PopupForm.php".chr(34)." rel='facebox'>Popup Window</a>";




$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
//$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//echo $objUtility->AlertNRedirect("","mainmenu.php?tag=1")
//header( 'Location: mainmenu.php?unauth=1');

$objOld_record=new Old_record();

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
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[0]=$objOld_record->MaxId();
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
//$mvalue[0]=$objOld_record->MaxId();
}//tag=1 [Return from Action form]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Id']))
$objOld_record->setId($_POST['Id']);//Push Primary Key Data to Class
if ($objOld_record->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objOld_record->getId();
$mvalue[1]=$objOld_record->getCert_type();
$mvalue[2]=$objOld_record->getCert_no();
$mvalue[3]=$objUtility->to_date($objOld_record->getIssue_date());
$mvalue[4]=$objOld_record->getName_of_certholder();
$mvalue[5]=$objOld_record->getFathers_name();
$mvalue[6]=$objOld_record->getVillage();
$mvalue[7]=0;//last Select Box for Editing
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
//Header Line
$objOld_record->TextHeader("Entry/Edit Form for Old_record",95,2,$HeadColor,$fcol,3);

echo "<div align=center id=".chr(34)."DivMsg".chr(34)."><font face=arial size=2 color=red>".$returnmessage."</font></div>";

echo "<form name=myform action=Form_Old_record.php method=post>";
echo "<table class=".chr(34)."myTable myTable-rounded".chr(34)." align=".chr(34)."center".Chr(34)."  width=95%>";
$i=0;
//ROW-1
echo "<thead>";
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Id", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Id",$mvalue[0],8,0," readonly ",1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Id",$mvalue[0],8,0,$bcol, $fcol, $font,$function,1);
//$objOld_record->genCheckBox("Check1", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
echo "</thead>";
//ROW-2
echo "<tbody>";
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Cert_type", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Cert_type",$mvalue[1],30,30,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Cert_type",$mvalue[1],30,30,$bcol, $fcol, $font,$function,1);
//$objOld_record->genCheckBox("Check2", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-3
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Cert_no", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Cert_no",$mvalue[2],50,80,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Cert_no",$mvalue[2],50,80,$bcol, $fcol, $font,$function,1);
//$objOld_record->genCheckBox("Check3", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-4
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Issue_date", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBoxWithDatePicker(1,$bcol,"Issue_date",$mvalue[3],10,10,$function,1);
echo "</tr>";
//ROW-5
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Name_of_certholder", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Name_of_certholder",$mvalue[4],40,40,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Name_of_certholder",$mvalue[4],40,40,$bcol, $fcol, $font,$function,1);
//$objOld_record->genCheckBox("Check5", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-6
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Fathers_name", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Fathers_name",$mvalue[5],40,40,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Fathers_name",$mvalue[5],40,40,$bcol, $fcol, $font,$function,0);
//$objOld_record->genCheckBox("Check6", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-7
echo "<tr>";
$objOld_record->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_record->TdText(3, 2,"Village", 0, 0, 0);
$objOld_record->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_record->TdInputBox(1,$bcol,"Village",$mvalue[6],30,30,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_record->genInputBox("Village",$mvalue[6],30,30,$bcol, $fcol, $font,$function,1);
//$objOld_record->genCheckBox("Check7", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
echo "<tr>";
echo "<td align=right bgcolor=".$FootColor.">";
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
echo "</td>";
echo "<td align=left colspan=1 bgcolor=".$FootColor.">";
$objOld_record->genHiddenBox("SaveData",0);
$objOld_record->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objOld_record->genButton("Save", $cap,100 ,"#CCFF66","black", $font," onclick=validate()");
$objOld_record->genCSSButton("Save", $cap,100 ,0,12,0," onclick=validate()");
//$objOld_record->genButton("back1","Menu",100 , "#FFFF66","black", $font," onclick=home()");
$objOld_record->genCSSButton("back1","Menu",100 ,2,12,2," onclick=home()");
$objOld_record->genHiddenBox("XML",0);
echo "</td></tr>";
echo "<tr><td align=right bgcolor=".$BodyColor."><font color=red size=2 face=arial>";
echo "</td>";
echo "<td colspan=1 align=left bgcolor=".$BodyColor.">";
$function=" onchange=LoadTextBox()";
$query="Select Id,Name_of_certholder from Old_record order by Id desc limit 20 ";
//$objOld_record->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objOld_record->genSelectBox("Editme", $query,$mvalue[7],"150", $bcol, $fcol, $font, $function);
echo "</td></tr><tr>";
echo "<td  align=left bgcolor=".$BottomColor.">";
echo "<td colspan=1 align=left bgcolor=".$BottomColor.">";
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objOld_record->genButton("edit1","Edit",100 ,"#CCFFFF","black", $font," onclick=direct()");
$objOld_record->genButton("res1","Reset",100 , "#CCFFFF","black", $font," onclick=res()");
echo "</td></tr>";
echo "</tbody></table></form>";
//Generate data Grid

$title="";
$headlist=array("Id","Cert_type","Cert_no","Issue_date","Name_of_certholder","Village");
$align=array(1,1,1,1,1,1,1);
$sql="Select Id,Cert_type,Cert_no,Issue_date,Name_of_certholder,Village from old_record order by Id desc";
$objOld_record->genDataGrid($title, $headlist, $align, $sql,80);

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
$objOld_record=new Old_record();
// Call $objOld_record->MaxId() Function Here if required and Load in $mvalue[0]
$temp[0]=$objOld_record->MaxId() ;
$temp[1]="";//Cert_type
$temp[2]="";//Cert_no
$temp[3]="";//Issue_date
$temp[4]="";//Name_of_certholder
$temp[5]="";//Fathers_name
$temp[6]="";//Village
$temp[7]="0";//
$temp[8]="";//Reserve 
$temp[9]="";//Reserve
$temp[10]="";//Reserve 
$temp[11]="";//Reserve
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


//$temp[0]=0; //Sometimes this type assignment may be required

for($i=0;$i<=12;$i++)
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
$_Id=$objOld_record->maxId();

//Push Id
$mvalue[0]=$_Id;

$objOld_record->setId($mvalue[0]);
$rvalue[0]=$mvalue[0];

//Push Cert_type
$mvalue[1]="";
if (isset($_POST['Cert_type'])) //If HTML Field is POST Availbale
$mvalue[1]=trim($_POST['Cert_type']);
else { 
if (isset($_GET['Cert_type'])) //If HTML Field is GET Availbale
$mvalue[1]=trim($_GET['Cert_type']);
}

$objOld_record->setCert_type($mvalue[1]);
$rvalue[1]=$mvalue[1];

//Push Cert_no
$mvalue[2]="";
if (isset($_POST['Cert_no'])) //If HTML Field is POST Availbale
$mvalue[2]=trim($_POST['Cert_no']);
else { 
if (isset($_GET['Cert_no'])) //If HTML Field is GET Availbale
$mvalue[2]=trim($_GET['Cert_no']);
}

$objOld_record->setCert_no($mvalue[2]);
$rvalue[2]=$mvalue[2];

//Push Issue_date
$mvalue[3]="";
if (isset($_POST['Issue_date'])) //If HTML Field is POST Availbale
$mvalue[3]=trim($_POST['Issue_date']);
else { 
if (isset($_GET['Issue_date'])) //If HTML Field is GET Availbale
$mvalue[3]=trim($_GET['Issue_date']);
}

$objOld_record->setIssue_date($mvalue[3]);
$rvalue[3]=$mvalue[3];

//Push Name_of_certholder
$mvalue[4]="";
if (isset($_POST['Name_of_certholder'])) //If HTML Field is POST Availbale
$mvalue[4]=trim($_POST['Name_of_certholder']);
else { 
if (isset($_GET['Name_of_certholder'])) //If HTML Field is GET Availbale
$mvalue[4]=trim($_GET['Name_of_certholder']);
}

$objOld_record->setName_of_certholder($mvalue[4]);
$rvalue[4]=$mvalue[4];

//Push Fathers_name
$mvalue[5]="";
if (isset($_POST['Fathers_name'])) //If HTML Field is POST Availbale
$mvalue[5]=trim($_POST['Fathers_name']);
else { 
if (isset($_GET['Fathers_name'])) //If HTML Field is GET Availbale
$mvalue[5]=trim($_GET['Fathers_name']);
}

$objOld_record->setFathers_name($mvalue[5]);
$rvalue[5]=$mvalue[5];

//Push Village
$mvalue[6]="";
if (isset($_POST['Village'])) //If HTML Field is POST Availbale
$mvalue[6]=trim($_POST['Village']);
else { 
if (isset($_GET['Village'])) //If HTML Field is GET Availbale
$mvalue[6]=trim($_GET['Village']);
}

$objOld_record->setVillage($mvalue[6]);
$rvalue[6]=$mvalue[6];



$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objOld_record->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objOld_record->UpdateRecord();
if($objOld_record->rowCommitted>0)
$mmode="Data Updated Successfully";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objOld_record->returnSql;
$objUtility->CreateLogFile("Old_record",$sql,1,"D");
$mvalue = InitArray();
//if(isset($rvalue[0]))
//$mvalue[0]=$rvalue[0]; //reinitialise mvalue with prev value
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objOld_record->Error();
$Er.=$objOld_record->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
if($objOld_record->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objOld_record->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_old_record.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Form_Old_record.php?tag=1");
}//$save=1
?>
</body>
</html>
