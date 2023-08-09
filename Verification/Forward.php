<html>
<head>
<title>Forwarding of Letter</title>
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
var a=document.getElementById('Old').value; 
var url="ForwardLetter.php?id="+a+"&noback=1";
if(SelectBoxIndex('Old')>0)
window.open(url,'_blank');    
}


function redirect(i)
{
myform.setAttribute("target","_self");
myform.action="Forward.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{
var ok=0;
var obj;
var i=document.getElementById('Tot').value;
for(var j=1;j<=i;j++)
{
obj="Id"+j;
if(document.getElementById(obj).checked==true)
ok++;
}



if (SelectBoxIndex('Verification_type')>0 && StringValid('Letter_no',1,1) && DateValid('Letter_date',1) && ok>0)
{
    
var name = confirm("You have Selected "+ok+" Person")
if(name==true){
document.getElementById('SaveData').value=1;
document.getElementById('Save').disabled=true;
myform.setAttribute("target","_self")
myform.action="Forward.php";
myform.submit();}
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
Generate Forwarding Letter to Concern CO/SP<br></font><font face=arial color=red size=1>
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
$function="onchange=redirect(15)";
$query="Select Cir_code,Circle from circle where 1=1";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->TdSelectBox(1, $bcol,"Circle",$mvalue[2],$query, 160, $function);
//genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
echo "</tr>"; }

$query="(upper(Pol_status)='ENTERED') and verification_type=".$mvalue[1];
if($mvalue[1]>1)
{
$label="Circle Name";
$query.=" and Circle=".$mvalue[2];
}
$query.=" order by ID Desc";

$ValueList=array();
$row=$objVerification->getAllRecord($query);
$a=0;
$label="Police Station";

//echo $objVerification->returnSql;

//echo "Value-".count($row);

for($i=0;$i<count($row);$i++)
{
//if($objUtility->dateDiff(date('Y-m-d'),$row[$i]['Start_date'])<15)
if(1==1)
{
$id="Id".($a+1);    
$ValueList[$a][0]=$row[$i]['Id'];
$ValueList[$a][1]="<b>".$row[$i]['Name']."</b>";
$ValueList[$a][2]=$row[$i]['Reln']."- ".$row[$i]['Rel_name']."<br>Vill-".$row[$i]['Village'];
if($mvalue[1]==1)
{
$cond="Code='".$row[$i]['Pol_stn']."'";
$tvalue=$objVerification->FetchColumn("police_station","Name", $cond,"");
}
else
{
$cond="Cir_code='".$row[$i]['Circle']."'";
$tvalue=$objVerification->FetchColumn("Circle","Circle", $cond,"");
}
$ValueList[$a][3]=$tvalue;
$ValueList[$a][4]=$row[$i]['Letter_no'];
$ValueList[$a][4].="<br>Dated ".$objUtility->to_date($row[$i]['Letter_date']);

//$ValueList[$a++][5]=$objVerification->returnGeneralCheckBox($id, 0, "");
$ValueList[$a++][5]="<input type=checkbox id=".$id." name=".$id." value=".$row[$i]['Id'].">";

}//if startdate
}//for

//echo "ValueList-".count($ValueList);

echo $objVerification->genHiddenBox("Tot", $a);

$headlist=array("ID","Name","Address",$label,"Origin Letter No & Date","Select");
$align=array(2,1,1,2,1);
echo "<tr><td colspan=2>";
if(count($ValueList)>0)
$objVerification->genDataGridOnValueList("",$headlist, $align, $ValueList, 90,count($ValueList));
else
echo "&nbsp;";
echo "</td></tr><tr>";

$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Dipatch Letter No", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objVerification->TdInputBox(1,$bcol,"Letter_no","",40,100,$function,0);
echo "</tr><tr>";
$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Letter Date", 0, 0, 0);
$objVerification->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
$objVerification->TdInputBoxWithDatePicker(1,$bcol,"Letter_date",date('d/m/Y'),10,10,$function,2);
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
$objVerification->genHiddenBox("SaveData",0);
$objVerification->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objVerification->genButton("Save", "Generate Letter",140 ,"#66CCCC","black", $font," onclick=validate()");
$objVerification->genButton("back1","Menu",100 , "#66CCCC","black", $font," onclick=home()");
$objVerification->genHiddenBox("XML",0);

echo "</td></tr><tr>";

$objVerification->bcol=$BodyColor;//Set Back Color Table Cell
$objVerification->TdText(3, 2,"Select Old Letter No", 0, 0, 0);
$query="select Id, id_verify from verification_letter where final='N' and type=".$mvalue[1]." order by id desc";
echo "<td>";
$objVerification->genSelectBox("Old", $query, 0, 260, $bcol, $fcol, $font, "");
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

//$temp[0]=0; //Sometimes this type assignment may be required

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
if (isset($_POST['Tot'])) //If HTML Field is Availbale
$tot=$_POST['Tot'];
else
$tot=0;    

$myid="";
$b=0;
for($i=1;$i<=$tot;$i++)
{
$id="Id".$i;
if(isset($_POST[$id]))
{
if($b>0)
$myid.=",";
$myid.=$_POST[$id];
$b++;
}    
}

$objVL->setId_verify($myid);

$maxid=$objVL->maxId();
$objVL->setId($maxid);

if (isset($_POST['Letter_no'])) //If HTML Field is Availbale
{
$mvalue[2]=trim($_POST['Letter_no']);
$objVL->setLetter_no($mvalue[2]);
$rvalue[2]=$mvalue[2];
}

//Push Letter_date
if (isset($_POST['Letter_date'])) //If HTML Field is Availbale
{
$mvalue[3]=trim($_POST['Letter_date']);
$objVL->setLetter_date($mvalue[3]);
}

//Push Verification_type
if (isset($_POST['Verification_type'])) //If HTML Field is Availbale
{
$type=$_POST['Verification_type'];
$objVL->setType($type);
}

//Push Circle
if (isset($_POST['Circle'])) //If HTML Field is Availbale
{
$circle=trim($_POST['Circle']);
$circle=$objVL->FetchColumn("circle", "circle", "cir_code=".$circle, "");
}

if($type==1)// police
{
$objVL->setSent_to("Superintendent of Police<br>Nalbari");    
}
else
{
$objVL->setSent_to("Circle Officer<br>".$circle." Revenue Circle");        
}

$objVL->setFinal("N");

$Er="";
$returnmsg="";

$result=$objVL->SaveRecord();
$mmode="Generated Reports";
if ($result)
{
$sql=$objVL->returnSql;
$objUtility->CreateLogFile("Verification_letter",$sql,2,"D");
$mvalue = InitArray();

$mysql="update verification set Pol_status='Pending',Letter_no_sent=".$maxid." where id in(".$myid.")";
$objVL->ExecuteQuery($mysql);
$objUtility->CreateLogFile("Verification",$mysql,2,"D");

$_SESSION['update']=0;
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
$_SESSION['msg'] = $returnmsg;
//header( 'Location: Form_verification.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
if ($result)
echo $objUtility->AlertNRedirect($msg, "ForwardLetter.php?id=".$maxid);
else
echo $objUtility->AlertNRedirect($msg, "Forward.php?tag=1");

}//$save=1
?>
</body>
</html>
