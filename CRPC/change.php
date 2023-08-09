<html>
<head>
<title>Entry Form for crpc_main</title>
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
//myform.action="Insert_crpc_main.php";

function enu()
{
//alert('ok');
//alert(SelectBoxIndex('Status'));
if(SelectBoxIndex('Status')>1)
document.getElementById('Dispose_date').disabled=false;
else
document.getElementById('Dispose_date').disabled=true;
}


function direct()
{
var a=document.getElementById('Case_yr').value ;//Primary Key
var b=document.getElementById('Case_no').value ;//Primary Key
if ( isNumber(a) && isNumber(b))
{
myform.action="change.php?tag=2&ptype=0";
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



function validate()
{
var a=myform.Case_yr.value ;// Primary Key
var b=myform.Case_no.value ;// Primary Key
var ok=false;

//if((SelectBoxIndex('Status')>1 && DateValid('Dispose_date',1)) ||(SelectBoxIndex('Status')==1 && DateValid('Dispose_date',0)))
ok=true;

if ( NumericValid('Case_yr',1,'NonNegative')==true   && NumericValid('Case_no',1,'NonNegative')==true   && SelectBoxIndex('Magistrate_code')>0  && StringValid('Status',1,1) && ok==true)
{
document.getElementById('SaveData').value=1;
myform.action="change.php";
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
else if (SelectBoxIndex('Magistrate_code')==0)
{
alert('Select Magistrate_code');
document.getElementById('Magistrate_code').focus();
}
else if (StringValid('Status',1,1)==false)//0-Simple Validation
{
alert('Check Status');
document.getElementById('Status').focus();
}
else if (ok==false)
{
alert('Check  Dispose_date');
document.getElementById('Dispose_date').focus();
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
window.location="change.php?tag=0";
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


//MyAjaxFunction("POST","LoadSelectBoxCrpc_main.php?type=1",data,'TargetId',"HTML");



}); //Document Ready Function
</script>
</head>
<body>
<?php
//Start FORMPHPBODY
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';

//Start Function/Method Guide

//$val=$objCrpc_main->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objCrpc_main->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objCrpc_main->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objCrpc_main->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on

//$objCrpc_main->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//$objCrpc_main->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objCrpc_main->genDataGrid($title,$headlist,$align, $sql,95);
//$objCrpc_main->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);

//$objCrpc_main->DefaultOptDetail = "-Select-"; //Common parameter
//$objCrpc_main->DefaultOptRequired = 1; //Common parameter
//$objCrpc_main->CountRecords($Table, $condition) //DBManager
//$objCrpc_main->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager
//Following function return the code to generate the specific HTML element
//$objCrpc_main->returnCheckBox($id, $val,  $function)  //DBManager
//$objCrpc_main->returnInputBox($id, $val, $size, $maxlength, $function)
//$objCrpc_main->returnButton($id, $val, $pix,$function)
//$objCrpc_main->returnHiddenBox($id, $val)
//$objCrpc_main->returnSelectBox($id, $query, $val, $pix, $function)
//$objCrpc_main->returnDatePicker($Fld, $level)
//$objCrpc_main->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

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
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: mainmenu.php?unauth=1');

$objCrpc_main=new Crpc_main();

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
$sub="";
if ($_tag==0 && $save==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[0]=$objCrpc_main->MaxCase_yr();
//$mvalue[1]=$objCrpc_main->MaxCase_no();
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
//$mvalue[0]=$objCrpc_main->MaxCase_yr();
//$mvalue[1]=$objCrpc_main->MaxCase_no();
}//tag=1 [Return from Action form]
$detail="";
if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Case_yr']))
$objCrpc_main->setCase_yr($_POST['Case_yr']);//Push Primary Key Data to Class
if (isset($_POST['Case_no']))
$objCrpc_main->setCase_no($_POST['Case_no']);//Push Primary Key Data to Class
if ($objCrpc_main->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objCrpc_main->getCase_yr();
$mvalue[1]=$objCrpc_main->getCase_no();
$mvalue[2]=$objCrpc_main->getMagistrate_code();
$mvalue[3]=$objCrpc_main->getStatus();
$mvalue[4]=$objUtility->to_date($objCrpc_main->getDispose_date());
$mvalue[5]=0;//last Select Box for Editing

$cond="case_yr=".$mvalue[0]." and case_no=".$mvalue[1]." and category=1";
$detail=$objCrpc_main->FetchColumn("crpc_party","name",$cond,"");
$detail.="<br> verses <br>";
$cond="case_yr=".$mvalue[0]." and case_no=".$mvalue[1]." and category=2";
$detail.=$objCrpc_main->FetchColumn("crpc_party","name",$cond,"");
$sub=$objCrpc_main->getSubject();
} //ptype=0
if($mvalue[3]=="Running")
$_SESSION['update']=1;
else
$_SESSION['update']=0;
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
<form name=myform action=Form_Crpc_main.php  method=POST >
<table border=0 cellpadding=2 cellspacing=0 align=center style='border-collapse: collapse;' width=90%>
<tr>
<td colspan=2 align=Center bgcolor=<?php echo $HeadColor;?>><font face=arial size=3>
CHANGE CASE STATUS<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
 ?>
<?php //row1?>
<tr>
<?php
$objCrpc_main->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_main->TdText(3, 2,"Case Year", 0, 0, 0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBox(1,$bcol,"Case_yr",$mvalue[0],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_main->genInputBox("Case_yr",$mvalue[0],8,0,$bcol, $fcol, $font,$function,1);
//$objCrpc_main->genCheckBox("Check1", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row2?>
<tr>
<?php
$objCrpc_main->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_main->TdText(3, 2,"Case No", 0, 0, 0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBox(1,$bcol,"Case_no",$mvalue[1],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_main->genInputBox("Case_no",$mvalue[1],8,0,$bcol, $fcol, $font,$function,1);
//$objCrpc_main->genCheckBox("Check2", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row3?>
<tr>
<?php
$objCrpc_main->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_main->TdText(3, 2,"Select Magistrate", 0, 0, 0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
$function="";
$query="Select Slno,Officer_name from officer where exist=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_main->TdSelectBox(1, $bcol,"Magistrate_code",$mvalue[2],$query, 200, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
?>
</tr>
<?php //row4?>
<tr>
<?php
$objCrpc_main->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_main->TdText(3, 2,"Status", 0, 0, 0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
$function=" onchange=enu()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$ValueList=array();
$ValueList[0][0]="Running";
//$ValueList[1][0]="Disposed";
//$ValueList[2][0]="Dropped";
echo "<td>";
$objCrpc_main->genSelectBoxByValueArray("Status", $ValueList, $mvalue[3], 200, $bcol, $fcol, $font, $function);
echo "</td>";

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objCrpc_main->genInputBox("Status",$mvalue[3],20,20,$bcol, $fcol, $font,$function,1);
//$objCrpc_main->genCheckBox("Check11", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

?>
</tr>
<?php //row5?>
<tr>
<?php
$objCrpc_main->bcol=$BodyColor;//Set Back Color Table Cell
//$objCrpc_main->TdText(3, 2,"Dispose Date", 0, 0, 0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
$function=" disabled";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
//$objCrpc_main->TdInputBoxWithDatePicker(1,$bcol,"Dispose_date",$mvalue[4],10,10,$function,2);
$objCrpc_main->genHiddenBox("Dispose_date",$mvalue[4]);
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
<td align=left bgcolor=<?php echo $FootColor;?> colspan=1>
<?php 
$objCrpc_main->genHiddenBox("SaveData",0);
$objCrpc_main->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
if ($_SESSION['update']==1)
$objCrpc_main->genButton("Save", "Update Detail",100 ,"#CCCC66","black", $font," onclick=validate()");
$objCrpc_main->genButton("back1","Menu",90 , "#CCCC66","black", $font," onclick=home()");
$objCrpc_main->genHiddenBox("XML",0);
$objCrpc_main->genButton("res1","Reset",80 , "#CCCCFF","black", $font," onclick=res()");
?>
</td></tr>
<tr><td align=right bgcolor=<?php echo $BottomColor;?> rowspan=2><font color=red size=3 face=arial>
</td>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=1>
<?php 
$function=" onchange=LoadTextBox()";
$query="Select Case_no,Section from Crpc_main where 1=1 ";
//$objCrpc_main->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//$objCrpc_main->genSelectBox("Editme", $query,$mvalue[5],"150", $bcol, $fcol, $font, $function);
?>
</td></tr>
<tr>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=1>
<?php 
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objCrpc_main->genButton("edit1","Edit",80 ,"#CCCCFF","black", $font," onclick=direct()");

?>
</td>
</tr>
</table>
</form>
<?php
//Generate data Grid
echo "Subject :<u>".$sub."</u><br>";
echo "<b>".$detail."</b>";


$title="";
$headlist=array("Case_yr","Case_no","Magistrate_code","Status","Dispose_date");
$align=array(1,1,1,1,1);
$sql="Select Case_yr,Case_no,Magistrate_code,Status,Dispose_date from crpc_main ";
//$objCrpc_main->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Case_yr");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objCrpc_main=new Crpc_main();
// Call $objCrpc_main->MaxCase_yr() Function Here if required and Load in $mvalue[0]
$temp[0]="";//Case_yr
// Call $objCrpc_main->MaxCase_no() Function Here if required and Load in $mvalue[1]
$temp[1]="";//Case_no
$temp[2]="0";//Magistrate_code
$temp[3]="";//Status
$temp[4]="";//Dispose_date
$temp[5]="0";//Entered_by
$temp[6]="";//Reserve 
$temp[7]="";//Reserve
$temp[8]="";//Reserve 
$temp[9]="";//Reserve
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=8;$i++)
{
$temp[$i]="";
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
if(isset($myvalue[7]))
$temp[7]=$myvalue[7];
if(isset($myvalue[8]))
$temp[8]=$myvalue[8];
return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";
$rvalue=array();
//Required for Edit and Insert in same Form
//if ($_SESSION['update']==1)
//{
//if (isset($_POST['Case_no'])) //If Last Pk Field is available
//$_Case_no=$_POST['Case_no'];
//else
//$_Case_no=0;
//}

//if ($_SESSION['update']==0)
//$_Case_no=$objCrpc_main->maxCase_no();

//Push Case_yr
if (isset($_POST['Case_yr'])) //If HTML Field is Availbale
{
$mvalue[0]=trim($_POST['Case_yr']);
$objCrpc_main->setCase_yr($mvalue[0]);
$rvalue[0]=$mvalue[0];
}

//Push Case_no
if (isset($_POST['Case_no'])) //If HTML Field is Availbale
{
$mvalue[1]=trim($_POST['Case_no']);
$objCrpc_main->setCase_no($mvalue[1]);
$rvalue[1]=$mvalue[1];
}

//Push Magistrate_code
if (isset($_POST['Magistrate_code'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Magistrate_code']);
$objCrpc_main->setMagistrate_code($mvalue[2]);
$rvalue[2]=$mvalue[2];
}

//Push Status
if (isset($_POST['Status'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Status']);
$objCrpc_main->setStatus($mvalue[3]);
$rvalue[3]=$mvalue[3];
}

//Push Dispose_date
if (isset($_POST['Dispose_date'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Dispose_date']);
//$objCrpc_main->setDispose_date($mvalue[4]);
$rvalue[4]=$mvalue[4];
}



$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objCrpc_main->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objCrpc_main->UpdateRecord();
if($objCrpc_main->rowCommitted>0)
$mmode="Data Updated Successfully";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objCrpc_main->returnSql;
$objUtility->CreateLogFile("Crpc_main",$sql,2,"D");
$mvalue = InitArray();
//if(isset($rvalue[0]))
//$mvalue[0]=$rvalue[0]; //reinitialise mvalue with prev value
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objCrpc_main->Error();
$Er.=$objCrpc_main->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
if($objCrpc_main->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objCrpc_main->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_crpc_main.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "change.php?tag=1");
}//$save=1
?>
</body>
</html>
