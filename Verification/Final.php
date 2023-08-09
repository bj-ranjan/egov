<html>
<head>
<title>Final  Letter</title>
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


function setMe()
{
myform.Id.focus();
}

function reprint()
{
var a=document.getElementById('Old_issue').value; 
var url="FinalLetter.php?id="+a+"&noback=1";
if(SelectBoxIndex('Old_issue')>0)
window.open(url,'_blank');    
}


function redirect(i)
{
myform.setAttribute("target","_self");
myform.action="Final.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{

if (SelectBoxIndex('Verification_type')>0 && StringValid('Letter_no',1,1) && DateValid('Letter_date',1) && SelectBoxIndex('Old')>0 )
{
document.getElementById('SaveData').value=1;
document.getElementById('Save').disabled=true;
myform.setAttribute("target","_self")
myform.action="Final.php";
myform.submit();
}
else
alert('Invalid Selection');
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
require_once './class/class.verification_letter.php';

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
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: mainmenu.php?unauth=1');

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
$ptype=1;

//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Id']))
$mvalue[0]=$_POST['Id'];
else
$mvalue[0]=0;

if (isset($_POST['Verification_type']))
$mvalue[1]=$_POST['Verification_type'];
else
$mvalue[1]=0;

if (isset($_POST['Circle']))
$mvalue[2]=$_POST['Circle'];
else
$mvalue[2]=0;

if (isset($_POST['Old']))
$mvalue[3]=$_POST['Old'];
else
$mvalue[3]=0;

if (!is_numeric($mvalue[2]))
$mvalue[2]=-1;
} //ptype=1

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
<td colspan=2 align=Center bgcolor=<?php echo $HeadColor;?> height=30><font face=arial size=3>
Generate Final Letter to Concern Department<br></font><font face=arial color=red size=1>
<div id="DivMsg"><?php echo  $returnmessage; ?></div></font></td>
</tr>
<?php $i=0;
 ?>
<?php //row1?>
<?php //row2?>
<tr>
<?php
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select Type", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=redirect(1)";

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

echo "</tr>";

if($mvalue[1]>1) {
echo "<tr>";
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Circle", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function="onchange=redirect(1)";
$query="Select Cir_code,Circle from circle where 1=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->TdSelectBox(1, $bcol,"Circle",$mvalue[2],$query, 160, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
echo "</tr>"; }

$query="(Pol_status='Entered') and verification_type=".$mvalue[1];
if($mvalue[1]>1)
{
$label="Circle Name";
$query.=" and Circle=".$mvalue[2];
}
$query.=" order by ID Desc";

echo $objVerification->genHiddenBox("Tot", $a);


$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select CO/SP Letter No", 0, 0, 0);
$query="select Id,POL_LETTER_NO,Name  from verification where POL_LETTER_NO is not NULL and POL_STATUS='Disposed' and DC_status='Pending' and verification_type=".$mvalue[1]." order by POL_LETTER_DATE  desc";
$ValueList=array();
$row=$objVerification->FetchRecords($query);
for($i=0;$i<count($row);$i++)
{
$ValueList[$i][0]=$row[$i][0];
$ValueList[$i][1]=$row[$i][1]." [".$row[$i][2]."]";
}

//echo $query;
echo "<td>";
//$objVerification->genSelectBox("Old", $query, $mvalue[3], 260, $bcol, $fcol, $font, " onchange=redirect(2)");

$objVerification->genSelectBoxByValueArray("Old", $ValueList, $mvalue[3], 300, $bcol, $fcol, $font, "");

echo "&nbsp;";
//$objVerification->genButton("Save1", "View/Print",100 ,"yellow","black", 10," onclick=reprint()");
$name=$objVerification->FetchColumn("verification", "name", "id=".$mvalue[3], "");
echo $name;
echo "</td></tr>";

$cond="id=".$mvalue[3];
$no=$objVerification->FetchColumn("verification", "issue_no", $cond, "");
$date=$objVerification->FetchColumn("verification", "issue_date", $cond, "");
if($objUtility->ismysqldate($date))
$date=$objUtility->to_date($date);

$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Issue Letter No", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Letter_no",$no,40,100,$function,0);
echo "</tr><tr>";
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Letter Date", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
$objVerification->TdInputBoxWithDatePicker(1,$bcol,"Letter_date",$date,10,10,$function,2);
echo "</tr><tr>";
?>
<td align=right bgcolor=<?php echo $FootColor;?>>
</td>
<td align=left bgcolor=<?php echo $FootColor;?> colspan=1>
<?php 
$objVerification->genHiddenBox("SaveData",0);
$objVerification->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->genButton("Save", "Generate Letter",140 ,"#66CCCC","black", $font," onclick=validate()");
$objVerification->genButton("back1","Menu",100 , "#66CCCC","black", $font," onclick=home()");
$objVerification->genHiddenBox("XML",0);

echo "</td></tr><tr>";

$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select Old Issue", 0, 0, 0);
$query="select Id,Issue_no,Name from verification where Issue_no is not null and dc_status='Disposed' and verification_type=".$mvalue[1]." order by issue_date desc";
//$objVerification->genSelectBox("Old_issue", $query, 0, 260, $bcol, $fcol, $font, "");
$ValueList=array();
$row=$objVerification->FetchRecords($query);
for($i=0;$i<count($row);$i++)
{
$ValueList[$i][0]=$row[$i][0];
$ValueList[$i][1]=$row[$i][1]." [".$row[$i][2]."]";
}
echo "<td>";
$objVerification->genSelectBoxByValueArray("Old_issue", $ValueList, "", 300, $bcol, $fcol, $font, "");

echo "&nbsp;";
$objVerification->genButton("Save1", "View/Print",100 ,"yellow","black", 10," onclick=reprint()");
echo "</td></tr>";
?>
    
    
    
</table>
</td></tr></table>
</form>
<?php
//Generate data Grid

$title="";
$headlist=array("Id","Verification_type","Circle");
$align=array(1,1,1);
$sql="Select Id,Verification_type,Circle from verification ";
//$objVerification->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Id");

if($mtype==1)//Postback from Id
echo $objUtility->focus("Verification_type");

if($mtype==15)//Postback from Circle
echo $objUtility->focus("Id");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objVerification=new Verification();
// Call $objVerification->MaxId() Function Here if required and Load in $mvalue[0]
$temp[0]="0";//Id
$temp[1]="1";//Verification_type
$temp[2]="0";//Circle
$temp[3]=0;
$temp[4]="";//Reserve 
$temp[5]="";//Reserve
$temp[6]="";//Reserve 
$temp[7]="";//Reserve
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
$temp[1]=0;
$temp[3]=0;
//$temp[0]=0; //Sometimes this type assignment may be required
$temp[1]="1";
for($i=0;$i<=8;$i++)
{
if(isset($myvalue[$i]))
$temp[$i]=$myvalue[$i];
}

return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
   $objVL=new Verification_letter(); 
    $myTag=0;
        $Err="Error List-";
$rvalue=array();

//Push Id

$mvalue[1]=$_POST['Verification_type'];

if (isset($_POST['Old'])) //If HTML Field is Availbale
$old=$_POST['Old'];
else
$old=0;    

$cond="id=".$old;
//$myid=$objVL->FetchColumn("verification_letter", "Id_verify", $cond, "0");

$sql="update verification set dc_status='Disposed',";
if (isset($_POST['Letter_no'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Letter_no']);
$rvalue[2]=$mvalue[2];
$sql.="issue_no='".$mvalue[2]."',";
}

//Push Letter_date
if (isset($_POST['Letter_date'])) //If HTML Field is Availbale
{
$mvalue[3]=$objUtility->to_mysqldate(trim($_POST['Letter_date']));
$sql.="issue_date='".$mvalue[3]."'";
}

$sql.=" where id=".$old;

$mmode="";
$result=$objVL->ExecuteQuery($sql);

//echo $sql;
//$result=false;
if ($result)
{
$mmode="Generated Reports";    
$mvalue = InitArray();
$_SESSION['update']=0;
$objUtility->CreateLogFile("Verification",$sql,2,"D");
}
else //Fails
{
$Er= $objVerification->Error();
$Er.=$objVerification->ValidationErrorList;
$returnmsg=$Er;
//$objUtility->saveErrorLog("Error",$Er);
if($objVL->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objVerification->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $mmode;
//header( 'Location: Form_verification.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;

if ($result)
echo $objUtility->AlertNRedirect($msg, "FinalLetter.php?id=".$old);
else
echo $objUtility->AlertNRedirect($msg, "Final.php?tag=1");
}//$save=1
?>
</body>
</html>
