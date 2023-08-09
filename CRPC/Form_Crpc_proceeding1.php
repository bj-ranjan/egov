<html>
<head>
<title>Entry Form for crpc_proceeding</title>
</head>
<?php
//include("header.php");
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
//myform.action="Insert_crpc_proceeding.php";


function setMe()
{
myform.Case_yr.focus();
}



function validate()
{
var b=myform.Case_no.value ;// Primary Key
var c=myform.Rsl.value ;// Primary Key
var g=myform.By_magistrate.value ;
if ( StringValid('Case_yr',1,1) && NumericValid('Case_no',1,'Positive')==true   && NumericValid('Rsl',1,'Positive')==true   && DateValid('Proc_date',1) && StringValid('Order_detail',1,1) && StringValid('Action_taken',0,1) && NumericValid('By_magistrate',1,'NonNegative')==true   && DateValid('Next_date',0) &&  1==1)
{
document.getElementById('SaveData').value=1;
myform.action="Form_Crpc_proceeding.php";
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
else if (NumericValid('Rsl',1,'Positive')==false)
{
alert('Non Numeric Value in Rsl');
document.getElementById('Rsl').focus();
}
else if (DateValid('Proc_date',1)==false)
{
alert('Check Date Proc_date');
document.getElementById('Proc_date').focus();
}
else if (StringValid('Order_detail',1,1)==false)//0-Simple Validation
{
alert('Check Order_detail');
document.getElementById('Order_detail').focus();
}
else if (StringValid('Action_taken',0,1)==false)//0-Simple Validation
{
alert('Check Action_taken');
document.getElementById('Action_taken').focus();
}
else if (NumericValid('By_magistrate',1,'NonNegative')==false)
{
alert('Non Numeric Value in By_magistrate');
document.getElementById('By_magistrate').focus();
}
else if (DateValid('Next_date',0)==false)
{
alert('Check Date Next_date');
document.getElementById('Next_date').focus();
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
<body>
<?php
//Start FORMPHPBODY
session_start();
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
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: mainmenu.php?unauth=1');

$objCrpc_proceeding=new Crpc_proceeding();

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

if ($_tag>1)
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
//$mvalue[1]=$objCrpc_proceeding->MaxCase_no();
//$mvalue[2]=$objCrpc_proceeding->MaxRsl();
}//tag=1 [Return from Action form]


if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=Form_Crpc_proceeding.php  method=POST >
<tr>
<td colspan=4 align=Center bgcolor=<?php echo $HeadColor;?>><font face=arial size=3>
Entry Form for Crpc_proceeding<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
$objCrpc_proceeding->bcol=$BodyColor;//Set Body Color for all row
 ?>
<?php //row1?>
<tr>
<?php
$objCrpc_proceeding->TdText(3, 2,"Case_yr", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBox(1,$bcol,"Case_yr",$mvalue[0],4,4,$function,1);
?>
<?php
$objCrpc_proceeding->TdText(3, 2,"Case_no", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBox(1,$bcol,"Case_no",$mvalue[1],8,0,$function,1);
?>
</tr>
<?php //row2?>
<tr>
<?php
$objCrpc_proceeding->TdText(3, 2,"Rsl", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBox(1,$bcol,"Rsl",$mvalue[2],8,0,$function,1);
?>
<?php
$objCrpc_proceeding->TdText(3, 2,"Proc_date", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBoxWithDatePicker(1,$bcol,"Proc_date",$mvalue[3],10,10,$function,2);
?>
</tr>
<?php //row3?>
<tr>
<?php
$objCrpc_proceeding->TdText(3, 2,"Order_detail", 0, 0, 0);
$function="";
$row=3;
$col=30;
$objCrpc_proceeding->TdTextArea(1,$bcol,"Order_detail",$mvalue[4],$row,$col,$function,1);
?>
<?php
$objCrpc_proceeding->TdText(3, 2,"Action_taken", 0, 0, 0);
$function="";
$row=3;
$col=30;
$objCrpc_proceeding->TdTextArea(1,$bcol,"Action_taken",$mvalue[5],$row,$col,$function,0);
?>
</tr>
<?php //row4?>
<tr>
<?php
$objCrpc_proceeding->TdText(3, 2,"By_magistrate", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBox(1,$bcol,"By_magistrate",$mvalue[6],8,0,$function,1);
?>
<?php
$objCrpc_proceeding->TdText(3, 2,"Next_date", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_proceeding->TdInputBoxWithDatePicker(1,$bcol,"Next_date",$mvalue[7],10,10,$function,2);
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
$objCrpc_proceeding->genHiddenBox("SaveData",0);
$objCrpc_proceeding->genHiddenBox("Pdate",$present_date);
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_proceeding->genButton("Save", $cap,100 ,"#CCCC66","black", $font," onclick=validate()");
$objCrpc_proceeding->genButton("back1","Menu",90 , "#FFCC66","black", $font," onclick=home()");
$objCrpc_proceeding->genHiddenBox("XML",0);
?>
</td></tr>
</table>
</form>
<?php
//Generate data Grid

$title="";
$headlist=array("Case_yr","Case_no","Rsl","Proc_date","Order_detail","Action_taken","By_magistrate","Next_date");
$align=array(1,1,1,1,1,1,1,1);
$sql="Select Case_yr,Case_no,Rsl,Proc_date,Order_detail,Action_taken,By_magistrate,Next_date from crpc_proceeding limit 20";
$objCrpc_proceeding->genDataGrid($title, $headlist, $align, $sql,80);

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
//$objCrpc_proceeding=new Crpc_proceeding();
$temp[0]="";//Case_yr
// Call $objCrpc_proceeding->MaxCase_no() Function Here if required and Load in $mvalue[1]
$temp[1]="0";//Case_no
// Call $objCrpc_proceeding->MaxRsl() Function Here if required and Load in $mvalue[2]
$temp[2]="0";//Rsl
$temp[3]="";//Proc_date
$temp[4]="";//Order_detail
$temp[5]="";//Action_taken
$temp[6]="0";//By_magistrate
$temp[7]="";//Next_date
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
$objCrpc_proceeding->setCase_yr($mvalue[0]);// Primary Key
}

//Push Case_no
if (isset($_POST['Case_no'])) //If HTML Field is Availbale
{
$mvalue[1]=trim($_POST['Case_no']);
$objCrpc_proceeding->setCase_no($mvalue[1]);// Primary Key
}

//Push Rsl
if (isset($_POST['Rsl'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Rsl']);
$objCrpc_proceeding->setRsl($mvalue[2]);// Primary Key
}

//Push Proc_date
if (isset($_POST['Proc_date'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Proc_date']);
$objCrpc_proceeding->setProc_date($mvalue[3]);
}

//Push Order_detail
if (isset($_POST['Order_detail'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Order_detail']);
$objCrpc_proceeding->setOrder_detail($mvalue[4]);
}

//Push Action_taken
if (isset($_POST['Action_taken'])) //If HTML Field is Availbale
{
$mvalue[5]=trim($_POST['Action_taken']);
$objCrpc_proceeding->setAction_taken($mvalue[5]);
}

//Push By_magistrate
if (isset($_POST['By_magistrate'])) //If HTML Field is Availbale
{
$mvalue[6]=trim($_POST['By_magistrate']);
$objCrpc_proceeding->setBy_magistrate($mvalue[6]);
}

//Push Next_date
if (isset($_POST['Next_date'])) //If HTML Field is Availbale
{
$mvalue[7]=trim($_POST['Next_date']);
$objCrpc_proceeding->setNext_date($mvalue[7]);
}



$Er="";
$returnmsg="";

$result=$objCrpc_proceeding->SaveRecord();
$mmode="Data Entered Successfully";
if ($result)
{
$sql=$objCrpc_proceeding->returnSql;
$objUtility->CreateLogFile("Crpc_proceeding",$sql,1,"D");
$mvalue = InitArray();
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objCrpc_proceeding->Error();
$Er.=$objCrpc_proceeding->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
$mmode="Transaction Fails,Contact Administrator";
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
