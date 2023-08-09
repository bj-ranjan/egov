<html>
<head>
<title>Entry Form for crpc_proceeding</title>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
//include("header.php");
?>
<script type="text/javascript" src="../validation.js"></script>
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
//myform.action="Insert_crpc_proceeding.php";


function enu()
{
if(SelectBoxIndex('Action_taken')>1)
{
document.getElementById('Dispose_date').disabled=false;
document.getElementById('Next_date').disabled=true;
}
else
{
document.getElementById('Dispose_date').disabled=true;
document.getElementById('Next_date').disabled=false;
}
}


function setMe()
{
myform.Case_yr.focus();
}

function redirect(i)
{
myform.action="Form_crpc_proceeding.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function loaddetail()
{
var data="yr="+document.getElementById('Case_yr').value;
data=data+"&no="+document.getElementById('Case_no').value;
if(SelectBoxIndex('Case_no')>0)
MyAjaxFunction("POST","LoadDetail.php",data,'detail',"HTML");

}


function validate()
{
var a=myform.Case_yr.value ;// Primary Key
var b=myform.Case_no.value ;// Primary Key

var ok=false;

if(SelectBoxIndex('Action_taken')>1 && DateValid('Dispose_date',1))
ok=true;

if(SelectBoxIndex('Action_taken')==1 && DateValid('Next_date',1) && CompareDateById('Next_date','Proc_date')==1)
ok=true;


if ( SelectBoxIndex('Case_yr')>0   && SelectBoxIndex('Case_no')>0  && DateValid('Proc_date',1) && StringValid('Order_detail',1,1) && SelectBoxIndex('Action_taken')>0 && SelectBoxIndex('By_magistrate')>0 && ok==true )
{
document.getElementById('SaveData').value=1;
myform.action="Form_Crpc_proceeding.php";
myform.submit();
}
else
{
if (NumericValid('Case_yr',1,'NonNegative')==false)
{
alert('Non Numeric Value in Case_yr');
document.getElementById('Case_yr').focus();
}
else if (NumericValid('Case_no',1,'NonNegative')==false)
{
alert('Non Numeric Value in Case_no');
document.getElementById('Case_no').focus();
}
else if (DateValid('Proc_date',1)==false)
{
alert('Check Date Proc_date');
document.getElementById('Proc_date').focus();
}
else if(StringValid('Order_detail',1,1)==false)
{
alert('Check Order Detail');
document.getElementById('Order Detail').focus();
}
else if (SelectBoxIndex('Action_taken')==0)//0-Simple Validation
{
alert('Check Action_taken');
document.getElementById('Action_taken').focus();
}
else if(ok==false)
alert('Check Date Sequence');
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



//Reset Form
function res()
{
window.location="Form_crpc_proceeding.php?tag=0";
}
//END JAVA
</script>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script src="../jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
var data="yr="+document.getElementById('Case_yr').value;
data=data+"&no="+document.getElementById('Case_no').value;
if(SelectBoxIndex('Case_no')>0)
MyAjaxFunction("POST","LoadDetail.php",data,'detail',"HTML");

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


//MyAjaxFunction("POST","LoadSelectBoxCrpc_proceeding.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>
</head>
<body>
<?php
//Start FORMPHPBODY
require_once '../class/utility.class.php';
require_once './class/class.crpc_proceeding.php';



//Start Function/Method Guide

//$val=$objCrpc_proceeding->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objCrpc_proceeding->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objCrpc_proceeding->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objCrpc_proceeding->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on

//$objCrpc_proceeding->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//$objCrpc_proceeding->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objCrpc_proceeding->genDataGrid($title,$headlist,$align, $sql,95);
//$objCrpc_proceeding->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);

//$objCrpc_proceeding->DefaultOptDetail = "-Select-"; //Common parameter
//$objCrpc_proceeding->DefaultOptRequired = 1; //Common parameter
//$objCrpc_proceeding->CountRecords($Table, $condition) //DBManager
//$objCrpc_proceeding->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager
//Following function return the code to generate the specific HTML element
//$objCrpc_proceeding->returnCheckBox($id, $val,  $function)  //DBManager
//$objCrpc_proceeding->returnInputBox($id, $val, $size, $maxlength, $function)
//$objCrpc_proceeding->returnButton($id, $val, $pix,$function)
//$objCrpc_proceeding->returnHiddenBox($id, $val)
//$objCrpc_proceeding->returnSelectBox($id, $query, $val, $pix, $function)
//$objCrpc_proceeding->returnDatePicker($Fld, $level)
//$objCrpc_proceeding->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

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
$BottomColor=$bcol;



$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

$objCrpc_proceeding=new Crpc_proceeding();


if ($objUtility->checkArea($_SESSION['myArea'], 24)==false) //24 for Case management
header( 'Location: crpcmenu.php?unauth=1');



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
//$mvalue[0]=$objCrpc_proceeding->MaxCase_yr();
//$mvalue[1]=$objCrpc_proceeding->MaxCase_no();
//$mvalue[2]=$objCrpc_proceeding->MaxRsl();
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
//$mvalue[0]=$objCrpc_proceeding->MaxCase_yr();
//$mvalue[1]=$objCrpc_proceeding->MaxCase_no();
//$mvalue[2]=$objCrpc_proceeding->MaxRsl();
}//tag=1 [Return from Action form]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=1;

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

if (isset($_POST['Rsl']))
$mvalue[2]=$_POST['Rsl'];
else
$mvalue[2]=0;

if (isset($_POST['Proc_date']))
$mvalue[3]=$_POST['Proc_date'];
else
$mvalue[3]=0;

if (isset($_POST['Order_detail']))
$mvalue[4]=$_POST['Order_detail'];
else
$mvalue[4]=0;

if (isset($_POST['Action_taken']))
$mvalue[5]=$_POST['Action_taken'];
else
$mvalue[5]=0;

if (isset($_POST['Next_date']))
$mvalue[6]=$_POST['Next_date'];
else
$mvalue[6]=0;

if (isset($_POST['By_magistrate']))
$mvalue[7]=$_POST['By_magistrate'];
else
$mvalue[7]=0;

if (!is_numeric($mvalue[7]))
$mvalue[7]=-1;
} //ptype=1

} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
?>
<form name=myform action=Form_Crpc_proceeding.php  method=POST >
<table border=0 cellpadding=2 cellspacing=0 align=center style='border-collapse: collapse;' width=90%>
<tr>
<td colspan=2 align=Center bgcolor=<?php echo $HeadColor;?>><font face=arial size=3>
Proceeding Updation<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
 ?>
<?php //row1?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Case Year", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function=" onchange=redirect(1)";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_proceeding->TdInputBox(1,$bcol,"Case_yr",$mvalue[0],8,0,$function,1);
$query="select distinct case_yr from crpc_main where status='Running' order by case_yr";
$objCrpc_proceeding->TdSelectBox(1, $bcol,"Case_yr",$mvalue[0],$query, 100, $function);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_proceeding->genInputBox("Case_yr",$mvalue[0],8,0,$bcol, $fcol, $font,$function,1);
//$objCrpc_proceeding->genCheckBox("Check1", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row2?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Case ID/No", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function=" onchange=loaddetail()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_proceeding->TdInputBox(1,$bcol,"Case_no",$mvalue[1],8,0,$function,1);

$query="select distinct case_no,old_caseno from crpc_main where status='Running' and case_yr=".$mvalue[0]." order by case_yr";

//$objCrpc_proceeding->TdSelectBox(1, $bcol,"Case_no",$mvalue[1],$query, 100, $function);
$ValueList=array();
$row=$objCrpc_proceeding->FetchRecords($query);
for($i=0;$i<count($row);$i++)
{
$ValueList[$i][0]=$row[$i][0];
$ValueList[$i][1]=$row[$i][0]."&nbsp;[".$row[$i][1]."]";
}
echo "<td>";
$objCrpc_proceeding->genSelectBoxByValueArray("Case_no", $ValueList, $mvalue[1], 200, $bcol, $fcol, $font, $function);
echo "</td>";

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_proceeding->genInputBox("Case_no",$mvalue[1],8,0,$bcol, $fcol, $font,$function,1);
//$objCrpc_proceeding->genCheckBox("Check2", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row3?>
<?php //row4?>

<tr><td colspan=2 align=left>
<div id="detail"></div>
</td></tr>
<?php //row5?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"New Order Detail", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function="";
$row=5;
$col=60;
$objCrpc_proceeding->TdTextArea(1,$bcol,"Order_detail",$mvalue[4],$row,$col,$function,0);
?>
</tr>
<?php //row6?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Proceeding Date", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBoxWithDatePicker(1,$bcol,"Proc_date",$mvalue[3],10,10,$function,2);
?>
</tr>

<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Action Taken", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_proceeding->TdInputBox(1,$bcol,"Action_taken",$mvalue[5],20,20,$function,0);

$function=" onchange=enu()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$ValueList=array();
$ValueList[0][0]="Running";
$ValueList[1][0]="Disposed";
$ValueList[2][0]="Dropped";
echo "<td>";
$objCrpc_proceeding->genSelectBoxByValueArray("Action_taken", $ValueList, $mvalue[5], 150, $bcol, $fcol, $font, $function);
echo "</td>";
//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_proceeding->genInputBox("Action_taken",$mvalue[5],20,20,$bcol, $fcol, $font,$function,0);
//$objCrpc_proceeding->genCheckBox("Check6", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>
?>
</tr>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Dispose Date", 0, 0, 0);
$function=" disabled";
$objCrpc_proceeding->TdInputBoxWithDatePicker(1,$bcol,"Dispose_date","",10,10,$function,2);
?>
</tr>

<?php //row7?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Next Date", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBoxWithDatePicker(1,$bcol,"Next_date",$mvalue[6],10,10,$function,2);
?>
</tr>
<?php //row8?>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Name of Magistrate", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
$function="onchange=redirect(8)";
$query="Select Slno,Officer_name from officer where exist=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_proceeding->TdSelectBox(1, $bcol,"By_magistrate",$mvalue[7],$query, 250, "");
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
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
$cap="Save Proceeding";
}
?>
</td>
<td align=left bgcolor=<?php echo $FootColor;?> colspan=1>
<?php 
$objCrpc_proceeding->genHiddenBox("SaveData",0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_proceeding->genButton("Save", $cap,150 ,"#CCCC66","black", $font," onclick=validate()");
$objCrpc_proceeding->genButton("back1","Menu",90 , "#CCCC66","black", $font," onclick=home()");
$objCrpc_proceeding->genHiddenBox("XML",0);
?>
</td></tr>
</table>
</form>
<?php
//Generate data Grid

$title="";
$headlist=array("Case_yr","Case_no","Rsl","Proc_date","Order_detail","Action_taken","Next_date","By_magistrate");
$align=array(1,1,1,1,1,1,1,1);
$sql="Select Case_yr,Case_no,Rsl,Proc_date,Order_detail,Action_taken,Next_date,By_magistrate from crpc_proceeding ";
//$objCrpc_proceeding->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Case_yr");

if($mtype==1)//Postback from Case_yr
echo $objUtility->focus("Case_no");

if($mtype==2)//Postback from Case_no
echo $objUtility->focus("Rsl");

if($mtype==3)//Postback from Rsl
echo $objUtility->focus("Proc_date");

if($mtype==8)//Postback from By_magistrate
echo $objUtility->focus("Case_yr");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objCrpc_proceeding=new Crpc_proceeding();
// Call $objCrpc_proceeding->MaxCase_yr() Function Here if required and Load in $mvalue[0]
$temp[0]="0";//Case_yr
// Call $objCrpc_proceeding->MaxCase_no() Function Here if required and Load in $mvalue[1]
$temp[1]="";//Case_no
// Call $objCrpc_proceeding->MaxRsl() Function Here if required and Load in $mvalue[2]
$temp[2]="";//Rsl
$temp[3]="";//Proc_date
$temp[4]="";//Order_detail
$temp[5]="";//Action_taken
$temp[6]="";//Next_date
$temp[7]="";//By_magistrate
$temp[9]="";//Reserve 
$temp[10]="";//Reserve
$temp[11]="";//Reserve 
$temp[12]="";//Reserve
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=11;$i++)
{
$temp[$i]="";
}
$temp[0]=0;

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

if(isset($myvalue[9]))
$temp[9]=$myvalue[9];
if(isset($myvalue[10]))
$temp[10]=$myvalue[10];
if(isset($myvalue[11]))
$temp[11]=$myvalue[11];
return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";
$rvalue=array();

//Push Case_yr
if (isset($_POST['Case_yr'])) //If HTML Field is Availbale
{
$mvalue[0]=trim($_POST['Case_yr']);
$objCrpc_proceeding->setCase_yr($mvalue[0]);
$rvalue[0]=$mvalue[0];
}

//Push Case_no
if (isset($_POST['Case_no'])) //If HTML Field is Availbale
{
$mvalue[1]=trim($_POST['Case_no']);
$objCrpc_proceeding->setCase_no($mvalue[1]);
$rvalue[1]=$mvalue[1];
}

//Push Rsl

$mvalue[2]=$objCrpc_proceeding->MaxRsl($mvalue[0],$mvalue[1]);
$objCrpc_proceeding->setRsl($mvalue[2]);
$rvalue[2]=$mvalue[2];

//Push Proc_date
if (isset($_POST['Proc_date'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Proc_date']);
$objCrpc_proceeding->setProc_date($mvalue[3]);
$rvalue[3]=$mvalue[3];
}

//Push Order_detail
if (isset($_POST['Order_detail'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Order_detail']);
$objCrpc_proceeding->setOrder_detail($mvalue[4]);
$rvalue[4]=$mvalue[4];
}

//Push Action_taken
if (isset($_POST['Action_taken'])) //If HTML Field is Availbale
{
$mvalue[5]=trim($_POST['Action_taken']);
$objCrpc_proceeding->setAction_taken($mvalue[5]);
$rvalue[5]=$mvalue[5];
}

//Push Next_date
if (isset($_POST['Next_date'])) //If HTML Field is Availbale
{
$mvalue[6]=trim($_POST['Next_date']);
$objCrpc_proceeding->setNext_date($mvalue[6]);
$rvalue[6]=$mvalue[6];
}

//Push By_magistrate
if (isset($_POST['By_magistrate'])) //If HTML Field is Availbale
{
$mvalue[7]=trim($_POST['By_magistrate']);
$objCrpc_proceeding->setBy_magistrate($mvalue[7]);
$rvalue[7]=$mvalue[7];
}


$Er="";
$returnmsg="";

$result=$objCrpc_proceeding->SaveRecord();
$mmode="Updated Successfully";
if ($result)
{
$sql=$objCrpc_proceeding->returnSql;
if($mvalue[5]=="Disposed" || $mvalue[5]=="Dropped")
{
$dt=$_POST['Dispose_date'];
$dt=$objUtility->to_mysqldate($dt);
$msql="update crpc_main set status='".$mvalue[5]."', Dispose_date='".$dt."' where case_yr=".$mvalue[0]." and case_no=".$mvalue[1];

$objCrpc_proceeding->ExecuteQuery($msql);
$objUtility->CreateLogFile("Crpc_proceeding",$msql,2,"D");
}//Disposed" || $mvalue[5]=="Drop

$objUtility->CreateLogFile("Crpc_proceeding",$sql,2,"D");

$mvalue = InitArray();
if(isset($rvalue[0]))
$mvalue[0]=$rvalue[0]; //reinitialise mvalue with prev value
if(isset($rvalue[1]))
$mvalue[1]=$rvalue[1]; //reinitialise mvalue with prev value
$_SESSION['update']=0;
} //$result
else //Fails
{
$Er= $objCrpc_proceeding->Error();
$Er.=$objCrpc_proceeding->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
if($objCrpc_proceeding->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objCrpc_proceeding->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_crpc_proceeding.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Form_Crpc_proceeding.php?tag=1");
}//$save=1
?>
</body>
</html>
