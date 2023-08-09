<html>
<head>
<title>Entry Form for crpc_main</title>
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
//myform.action="Insert_crpc_main.php";


function direct()
{
var mvalue=document.getElementById('Editme').value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
document.getElementById('Case_no').value=mvalue;

var a=document.getElementById('Case_yr').value ;//Primary Key
var b=document.getElementById('Case_no').value ;//Primary Key
if ( SimpleValidate(a,1) && isNumber(b))
{
myform.action="Form_crpc_main.php?tag=2&ptype=0";
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
myform.action="Form_crpc_main.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}


function validate()
{
var ok=true;    
var msg="";
if(CompareDateById('Case_date','Pdate')==1 || CompareDateById('Case_date','startdate')==-1 )
{
ok=false   
msg="Invalid case date";
}

if(CompareDateById('Next_date','Pdate')==-1)
{
ok=false   
msg="Invalid Next date";
}

var b=myform.Case_no.value ;// Primary Key
if (ok && StringValid('Case_yr',1,1) && NumericValid('Case_no',1,'Positive')==true   && DateValid('Case_date',1) && StringValid('Section',1,1) && StringValid('Subject',1,1) && SelectBoxIndex('Magistrate_code')>0 && DateValid('Next_date',1) && StringValid('Old_caseno',0,1) && SelectBoxIndex('Police_station')>0)
{
document.getElementById('SaveData').value=1;
myform.action="Form_Crpc_main.php";
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
else if (DateValid('Case_date',1)==false)
{
alert('Check Date Case_date');
document.getElementById('Case_date').focus();
}
else if (StringValid('Section',1,1)==false)//0-Simple Validation
{
alert('Check Section');
document.getElementById('Section').focus();
}
else if (StringValid('Subject',1,1)==false)//0-Simple Validation
{
alert('Check Subject');
document.getElementById('Subject').focus();
}
else if (SelectBoxIndex('Magistrate_code')==0)//0-Simple Validation
{
alert('Check Magistrate_code');
document.getElementById('Magistrate_code').focus();
}
else if (DateValid('Next_date',1)==false)
{
alert('Check Date Next_date');
document.getElementById('Next_date').focus();
}
else if (StringValid('Old_caseno',0,1)==false)//0-Simple Validation
{
alert('Check Old_caseno');
document.getElementById('Old_caseno').focus();
}
else if (SelectBoxIndex('Police_station')==0)//0-Simple Validation
{
alert('Check Police_station');
document.getElementById('Police_station').focus();
}
else if(ok==false)
alert(msg);    
else 
alert('Invalid Data');
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
window.location="Form_crpc_main.php?tag=0";
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
<body>
<?php
//Start FORMPHPBODY
session_start();
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
header( 'Location: crpcmenu.php?unauth=1');

$objCrpc_main=new Crpc_main();

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
//$mvalue[1]=$objCrpc_main->MaxCase_no();
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


$mvalue[1]=$objCrpc_main->MaxCase_no($mvalue[0]);


if (isset($_POST['Case_date']))
$mvalue[2]=$_POST['Case_date'];
else
$mvalue[2]=0;

if (isset($_POST['Section']))
$mvalue[3]=$_POST['Section'];
else
$mvalue[3]=0;

if (isset($_POST['Subject']))
$mvalue[4]=$_POST['Subject'];
else
$mvalue[4]=0;

if (isset($_POST['Magistrate_code']))
$mvalue[5]=$_POST['Magistrate_code'];
else
$mvalue[5]=0;

if (isset($_POST['Next_date']))
$mvalue[6]=$_POST['Next_date'];
else
$mvalue[6]=0;

if (isset($_POST['Old_caseno']))
$mvalue[7]=$_POST['Old_caseno'];
else
$mvalue[7]=0;

if (isset($_POST['Police_station']))
$mvalue[8]=$_POST['Police_station'];
else
$mvalue[8]=0;

if (isset($_POST['Editme']))
$mvalue[9]=$_POST['Editme'];
else
$mvalue[9]=0;

} //ptype=1

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
$mvalue[2]=$objUtility->to_date($objCrpc_main->getCase_date());
$mvalue[3]=$objCrpc_main->getSection();
$mvalue[4]=$objCrpc_main->getSubject();
$mvalue[5]=$objCrpc_main->getMagistrate_code();
$mvalue[6]=$objUtility->to_date($objCrpc_main->getNext_date());
$mvalue[7]=$objCrpc_main->getOld_caseno();
$mvalue[8]=$objCrpc_main->getPolice_station();
$mvalue[9]=0;//last Select Box for Editing
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

if(!is_numeric($mvalue[1]))
    $mvalue[1]=-1;
//Start of FormDesign
?>
<table border=0 cellpadding=4 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=Form_Crpc_main.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=<?php echo $HeadColor;?> height=30><font face=arial size=3>
C.R.P.C New Case Registration<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
$objCrpc_main->bcol=$BodyColor;//Set Body Color for all row
 ?>
<?php //row1?>
<tr>
<?php
$objCrpc_main->TdText(3, 2,"Case Year", 0, 0, 0);
$function="onchange=redirect(1)";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBox(1,$bcol,"Case_yr",$mvalue[0],4,4,$function,1);
?>
</tr><tr>
<?php
$objCrpc_main->TdText(3, 2,"Case ID", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)

$objCrpc_main->TdInputBox(1,$bcol,"Case_no",$mvalue[1],8,0,$function." readonly",1);
?>
</tr>
<?php //row2?>
<tr>
<?php
$objCrpc_main->TdText(3, 2,"Case Date", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBoxWithDatePicker(1,$bcol,"Case_date",$mvalue[2],10,10,$function,2);
?>
</tr><tr>
<?php
$objCrpc_main->TdText(3, 2,"Under Section", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBox(1,$bcol,"Section",$mvalue[3],30,30,$function,1);
?>
</tr>
<?php //row3?>
<tr>
<?php
$objCrpc_main->TdText(3, 2,"Subject", 0, 0, 0);
$function="";
$row=5;
$col=60;
$objCrpc_main->TdTextArea(1,$bcol,"Subject",$mvalue[4],$row,$col,$function,1);
?>
</tr><tr>
<?php
$objCrpc_main->TdText(3, 2,"Select Magistrate", 0, 0, 0);
$function="";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$query="SELECT SLNO ,OFFICER_NAME FROM OFFICER where exist=1 and OFFICER_NAME like '%ACS'  ORDER BY OFFICER_NAME ASC";
//$objCrpc_main->genSelectBox("Magistrate_code", $query,$mvalue[5] , "220", $bcol, $fcol, $font, "");
$objCrpc_main->TdSelectBox(1, $bcol, "Magistrate_code", $mvalue[5], $query, "220", $function)
?>
</tr>

<?php //row4?>
<tr>
<?php
$objCrpc_main->TdText(3, 2,"Next Date", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBoxWithDatePicker(1,$bcol,"Next_date",$mvalue[6],10,10,$function,2);
?>
</tr><tr>
<?php
$objCrpc_main->TdText(3, 2,"Old Case No", 0, 0, 0);
$function="onchange=direct1()";
//TdInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
$objCrpc_main->TdInputBox(1,$bcol,"Old_caseno",$mvalue[7],30,30,$function,0);
?>
</tr>
<?php //row5?>
<tr>
<?php
$objCrpc_main->TdText(3, 2,"Select Police Station", 0, 0, 0);
$function="";
$query="SELECT CODE ,NAME FROM POLICE_STATION where code>0 order by name";
$objCrpc_main->TdSelectBox(1, $bcol, "Police_station", $mvalue[8], $query, "170", $function)
?>
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
$objCrpc_main->genHiddenBox("SaveData",0);
$objCrpc_main->genHiddenBox("Pdate",$present_date);
$sdate="01/01/".$mvalue[0];
$objCrpc_main->genHiddenBox("startdate",$sdate);

//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_main->genButton("Save", $cap,100 ,"#99FFCC","black", $font," onclick=validate()");
$objCrpc_main->genButton("back1","Menu",90 , "#99FFCC","black", $font," onclick=home()");
$objCrpc_main->genHiddenBox("XML",0);
?>
</td></tr>
<tr><td align=right bgcolor=<?php echo $BottomColor;?> rowspan=2><font color=red size=3 face=arial>
</td>
<td align=left bgcolor=<?php echo $BottomColor;?> colspan=3>
<?php 
$function=" onchange=LoadTextBox()";
$query="Select Case_no,Case_yr,old_caseno from Crpc_main where status='Running' and Case_yr='".$mvalue[0]."' order by case_no";
$ValueList=array();
$row=$objCrpc_main->FetchRecords($query);
for($i=0;$i<count($row);$i++)
{
$ValueList[$i][0]=$row[$i][0];
$ValueList[$i][1]=$row[$i][0]."/".$row[$i][1]."(".$row[$i][2].")";
}


$objCrpc_main->genSelectBoxByValueArray("Editme", $ValueList, $mvalue[9], 200, $bcol, $fcol, $font, $function);

$objCrpc_main->genButton("edit1","Edit",80 ,"#CCCCFF","black", $font," onclick=direct()");
?>
</td></tr>

</table>
</form>
<?php
//Generate data Grid

$title="";
$headlist=array("Case_yr","Case_no","Case_date","Section","Subject","Magistrate_code","Next_date","Old_caseno","Police_station");
$align=array(1,1,1,1,1,1,1,1,1);
$sql="Select Case_yr,Case_no,Case_date,Section,Subject,Magistrate_code,Next_date,Old_caseno,Police_station from crpc_main limit 20";
//$objCrpc_main->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Case_yr");

if($mtype==1)//Postback from Case_yr
echo $objUtility->focus("Case_no");

if($mtype==2)//Postback from Case_no
echo $objUtility->focus("Case_date");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
$objCrpc_main=new Crpc_main();
$temp[0]=date('Y');//Case_yr
 // Function Here if required and Load in $mvalue[1]
$temp[1]=$objCrpc_main->MaxCase_no($temp[0]);//Case_no
$temp[2]=date('d/m/Y');//Case_date
$temp[3]="";//Section
$temp[4]="";//Subject
$temp[5]="";//Magistrate_code
$temp[6]="";//Next_date
$temp[7]="";//Old_caseno
$temp[8]="";//Police_station
$temp[9]="0";//Status
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=9;$i++)
{
$temp[$i]="";
}
$temp[0]=0;
$temp[1]=0;
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
return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";
//Required for Edit and Insert in same Form
if ($_SESSION['update']==1)
{
if (isset($_POST['Case_no'])) //If Last Pk Field is available
$mvalue[1]=$_POST['Case_no'];
else
$mvalue[1]=0;
}



//Push Case_yr
$mvalue[0]=0;
if (isset($_POST['Case_yr'])) //If HTML Field is Availbale
{
$mvalue[0]=trim($_POST['Case_yr']);
$objCrpc_main->setCase_yr($mvalue[0]);// Primary Key
}

if ($_SESSION['update']==0)
$mvalue[1]=$objCrpc_main->maxCase_no($mvalue[0]);

$caseyr=$mvalue[0];
$caseno=$mvalue[1];

$tmp=$caseno;

//Push Case_no

$objCrpc_main->setCase_no($mvalue[1]);// Primary Key

//Push Case_date
if (isset($_POST['Case_date'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Case_date']);
$objCrpc_main->setCase_date($mvalue[2]);
}

//Push Section
if (isset($_POST['Section'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Section']);
$objCrpc_main->setSection($mvalue[3]);
}

//Push Subject
if (isset($_POST['Subject'])) //If HTML Field is Availbale
{
$mvalue[4]=trim($_POST['Subject']);
$objCrpc_main->setSubject($mvalue[4]);
}

//Push Magistrate_code
if (isset($_POST['Magistrate_code'])) //If HTML Field is Availbale
{
$mvalue[5]=trim($_POST['Magistrate_code']);
$objCrpc_main->setMagistrate_code($mvalue[5]);
}

//Push Next_date
if (isset($_POST['Next_date'])) //If HTML Field is Availbale
{
$mvalue[6]=trim($_POST['Next_date']);
$objCrpc_main->setNext_date($mvalue[6]);
}

//Push Old_caseno
if (isset($_POST['Old_caseno'])) //If HTML Field is Availbale
{
$mvalue[7]=trim($_POST['Old_caseno']);
$objCrpc_main->setOld_caseno($mvalue[7]);
}

//Push Police_station
if (isset($_POST['Police_station'])) //If HTML Field is Availbale
{
$mvalue[8]=trim($_POST['Police_station']);
$objCrpc_main->setPolice_station($mvalue[8]);
}
if ($_SESSION['update']==0)
$objCrpc_main->setStatus("Running");


$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objCrpc_main->SaveRecord();
$mmode="Case Entered Successfully ID is ".$tmp."/".$mvalue[0];
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
$objUtility->CreateLogFile("Crpc_Main",$sql,2,"D");
$mvalue = InitArray();
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objCrpc_main->Error();
$Er.=$objCrpc_main->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
$mmode="Transaction Fails,Contact Administrator";
//echo $objCrpc_main->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_crpc_main.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
$_SESSION['redirect']=false;
if ($_SESSION['update']==0)
{
$_SESSION['redirect']=true;

$msg="Case Entered Successfully ID is ".$tmp."/".$mvalue[0];
$msg.=". Proceed to Enter Party Details";
echo $objUtility->AlertNRedirect($msg, "Form_Crpc_party.php?tag=0&yr=".$caseyr."&no=".$caseno);
}
else
echo $objUtility->AlertNRedirect($msg, "Form_Crpc_main.php?tag=1");
}//$save=1
?>
</body>
</html>
