<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script type="text/javascript" src="../validation.js"></script>
<script language="javascript">
<!--
function direct()
{
var b=myform.Pet_yr.value ;//Primary Key
var d=myform.Pet_no.value ;//Primary Key
if (notNull(b) && nonZero(d))
{
myform.action="Editpetition.php?tag=2&ptype=0";
myform.submit();
}
else
alert('Invalid Year or petition No');
}

function direct1()
{
var i;
i=0;
}

function setMe()
{
myform.Pet_yr.focus();
}

function redirect(i)
{
myform.action="Editpetition.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{
//var j1=myform.rollno.selectedIndex;//Returns Numeric Index from 0
//var j2=myform.box1.checked;//Return true if check box is checked
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";
//StringValid('a',0,0) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(0- Simple Validation, 1- Strong Validation)
var d=myform.Pet_no.value ;// Primary Key
if (StringValid('Relation',1,1) && StringValid('Pet_yr',1,0) && isNumber(d)==true   && StringValid('Applicant',1,0) && SelectBoxIndex('Pet_type')>0  && StringValid('Father',0,0) && StringValid('Mother',0,0) && SelectBoxIndex('Ps_code')>0  && SelectBoxIndex('Circle_code')>0  && SelectBoxIndex('Mauza_code')>0  && SelectBoxIndex('Vill_code')>0)
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.action="UpdatePetition.php";
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
else if (StringValid('Applicant',1,0)==false)//0-Simple Validation
{
alert('Check Applicant');
document.getElementById('Applicant').focus();
}
else if (SelectBoxIndex('Pet_type')==0)
{
alert('Select Pet_type');
document.getElementById('Pet_type').focus();
}
else if (StringValid('Father',0,0)==false)//0-Simple Validation
{
alert('Check Father');
document.getElementById('Father').focus();
}
else if (StringValid('Mother',0,0)==false)//0-Simple Validation
{
alert('Check Mother');
document.getElementById('Mother').focus();
}
else if (SelectBoxIndex('Ps_code')==0)
{
alert('Select Ps_code');
document.getElementById('Ps_code').focus();
}
else if (SelectBoxIndex('Circle_code')==0)
{
alert('Select Circle_code');
document.getElementById('Circle_code').focus();
}
else if (SelectBoxIndex('Mauza_code')==0)
{
alert('Select Mauza_code');
document.getElementById('Mauza_code').focus();
}
else if (SelectBoxIndex('Vill_code')==0)
{
alert('Select Vill_code');
document.getElementById('Vill_code').focus();
}
else 
alert('Enter Correct Data');
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


function LoadTextBox()
{
var i=myform.Editme.selectedIndex;
if(i>0)
myform.edit1.disabled=false;
else
myform.edit1.disabled=true;
//alert('Write Java Script as per requirement');
}

//Reset Form
function resme()
{
window.location="editpetition.php?tag=0";
}
//END JAVA
</script>
<script language="JavaScript" src="./datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="./datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script src="jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');
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

}); //Document Ready Function
</script>
<body>
<?php
//Start FORMBODY
header('Refresh: 180;url=../IndexPage.php?tag=1');
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once '../bakijai/class/class.police_station.php';
require_once '../bakijai/class/class.circle.php';
require_once '../bakijai/class/class.mouza.php';
require_once '../bakijai/class/class.village.php';
require_once '../class/class.dbmanager.php';

$objUtility=new Utility();

$processed=false;
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();

if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 19)==false) //19 for petition Edit
header( 'Location: Mainmenu.php?unauth=1');



$objPetition_master=new Petition_master();

$objDbm=new DBmanager();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

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

$_SESSION['update']=0;//Initialise as Insert Mode
$present_date=date('d/m/Y');
$mvalue=array();
$mvalue[12]="";
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
if (isset($_POST['Pet_yr']))
$mvalue[0]=$_POST['Pet_yr'];
else
$mvalue[0]=0;

if (isset($_POST['Pet_no']))
$mvalue[1]=$_POST['Pet_no'];
else
$mvalue[1]=0;

if (isset($_POST['Applicant']))
$mvalue[2]=$_POST['Applicant'];
else
$mvalue[2]=0;

if (isset($_POST['Pet_type']))
$mvalue[3]=$_POST['Pet_type'];
else
$mvalue[3]=0;

if (isset($_POST['Father']))
$mvalue[4]=$_POST['Father'];
else
$mvalue[4]=0;

if (isset($_POST['Mother']))
$mvalue[5]=$_POST['Mother'];
else
$mvalue[5]=0;

if (isset($_POST['Ps_code']))
$mvalue[6]=$_POST['Ps_code'];
else
$mvalue[6]=0;

if (!is_numeric($mvalue[6]))
$mvalue[6]=-1;
if (isset($_POST['Circle_code']))
$mvalue[7]=$_POST['Circle_code'];
else
$mvalue[7]=0;

if (!is_numeric($mvalue[7]))
$mvalue[7]=-1;
if (isset($_POST['Mauza_code']))
$mvalue[8]=$_POST['Mauza_code'];
else
$mvalue[8]=0;

if (!is_numeric($mvalue[8]))
$mvalue[8]=-1;
if (isset($_POST['Vill_code']))
$mvalue[9]=$_POST['Vill_code'];
else
$mvalue[9]=0;

if (!is_numeric($mvalue[9]))
$mvalue[9]=-1;
if (isset($_POST['Editme']))
$mvalue[10]=$_POST['Editme'];
else
$mvalue[10]=0;

if (isset($_POST['Relation']))
$mvalue[11]=$_POST['Relation'];
else
$mvalue[11]="";

} //ptype=1

if (isset($_POST['Pet_yr']))
$objPetition_master->setPet_yr($_POST['Pet_yr']);//Push Primary Key Data to Class
if (isset($_POST['Pet_no']))
$objPetition_master->setPet_no($_POST['Pet_no']);//Push Primary Key Data to Class
if ($objPetition_master->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objPetition_master->getPet_yr();
$mvalue[1]=$objPetition_master->getPet_no();
$mvalue[2]=$objPetition_master->getApplicant();
$mvalue[3]=$objPetition_master->getPet_type();
$mvalue[4]=$objPetition_master->getFather();
$mvalue[5]=$objPetition_master->getMother();
$mvalue[6]=$objPetition_master->getPs_code();
$mvalue[7]=$objPetition_master->getCircle_code();
$mvalue[8]=$objPetition_master->getMauza_code();
$mvalue[9]=$objPetition_master->getVill_code();
$mvalue[10]=0;//last Select Box for Editing
$mvalue[11]=$objPetition_master->getRelation();
$mvalue[12]=$objPetition_master->getSubcaste();
} //ptype=0
if($objPetition_master->getAst()=="N")
$_SESSION['update']=1;
else
{
$processed=true; 
//Roll-0 or Allowed Area 22  can edit processed petition 
if($objPetition_master->getAst()=="Y" &&  ($roll==0 || $objUtility->checkArea($_SESSION['myArea'], 22)==true))
{
$_SESSION['update']=1;    
}   
else
{
echo $objUtility->alert ("Petition ".$objPetition_master->getStatus ())    ;
$_SESSION['update']=0;
}
}
} 
else //data not available for edit
{
$_SESSION['update']=0;
echo $objUtility->alert ("Petition Not Available");
} //EditRecord()
   
//echo $objPetition_master->returnSql;
} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

if(!isset($mvalue[11]))
$mvalue[11]="";
//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=insert_petition_master.php  method=POST >
<tr>
<td colspan=4 align=Center bgcolor=#66CC66>
<font face=arial size=3>EDIT PETITION DETAIL<br></font>
<font face=arial color=red size=2><?php echo  $returnmessage; ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Year
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=4 name="Pet_yr" id="Pet_yr" value="<?php echo $mvalue[0]; ?>" style="<?php echo $mystyle;?>"  maxlength=4 onfocus="ChangeColor('Pet_yr',1)"  onblur="ChangeColor('Pet_yr',2)" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
<input type=hidden size=4 name="Petyr" id="Petyr" value="<?php echo $mvalue[0]; ?>" >
</td>
<?php $i++; //Now i=1?>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Petition No
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 name="Pet_no" id="Pet_no" value="<?php echo $mvalue[1]; ?>" onfocus="ChangeColor('Pet_no',1)"  onblur="ChangeColor('Pet_no',2)" onchange=direct1()>
<?php 
$mystyle="font-family:arial; font-size: 12px ;font-weight:bold; background-color:yellow;color:black;width:90px";
?>
<input type=hidden size=8 name="Petno" id="Petno" value="<?php echo $mvalue[1]; ?>">

<input type=button value=Edit  name=edit1 id="edit1" onclick=direct() style="<?php echo $mystyle;?>" >
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Applicant Name
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=30 maxlength="40" name="Applicant" id="Applicant" value="<?php echo $mvalue[2]; ?>" style="<?php echo $mystyle;?>"  maxlength=70 onfocus="ChangeColor('Applicant',1)"  onblur="ChangeColor('Applicant',2)">
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=3?>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Petition Type
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:200px";
$objPetition_type=new Petition_type();
if ($processed==false)
$objPetition_type->setCondString("Running='Y'" ); //Change the condition for where clause accordingly
else
$objPetition_type->setCondString("Code='".$mvalue[3]."'");    
//echo "pet_type".$mvalue[3]; 
$row=$objPetition_type->getRow();
//echo $objPetition_type->returnSql;
?>
<select name="Pet_type" id="Pet_type" style="<?php echo $mystyle;?>" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Detail'];
if ($mvalue[3]==$mcode)
$sel=" Selected ";
else 
$sel=" ";    
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=4?>
<?php //row3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
Father/Husband
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=8 maxlength="25" name="Relation" id="Relation" value="<?php echo $mvalue[11]; ?>" style="<?php echo $mystyle;?>"   onfocus="ChangeColor('Relation',1)"  onblur="ChangeColor('Relation',2)">
<input type=text size=24 maxlength="40" name="Father" id="Father" value="<?php echo $mvalue[4]; ?>" style="<?php echo $mystyle;?>"  maxlength=60 onfocus="ChangeColor('Father',1)"  onblur="ChangeColor('Father',2)">
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Mother
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;font-weight:bold;background-color:white;color:black;font-size: 12px";
?>
<input type=text size=30 maxlength="40" name="Mother" id="Mother" value="<?php echo $mvalue[5]; ?>" style="<?php echo $mystyle;?>"  maxlength=50 onfocus="ChangeColor('Mother',1)"  onblur="ChangeColor('Mother',2)">
</td>
</tr>
<?php $i++; //Now i=6?>
<?php //row4?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Police Station
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:160px";
$objPolice_station=new Police_station();
$objPolice_station->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objPolice_station->getRow();
?>
<select name="Ps_code" id="Ps_code" style="<?php echo $mystyle;?>" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Name'];
if ($mvalue[6]==$mcode)
$sel=" Selected ";
else 
$sel=" ";    
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
</td>
<?php $i++; //Now i=7?>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Circle
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:160px";
$objCircle=new Circle();
$objCircle->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name="Circle_code" id="Circle_code" style="<?php echo $mystyle;?>" onchange="redirect(3)" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Cir_code'];
$mdetail=$row[$ind]['Circle'];
if ($mvalue[7]==$mcode)
$sel=" Selected ";
else 
$sel=" ";    
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
</td>
</tr>
<?php $i++; //Now i=8?>
<?php //row5?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Mauza
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:160px";
$objMouza=new Mouza();
$objMouza->setCondString("Cir_code=".$mvalue[7]." order by Mouza_name"); //Change the condition for where clause accordingly
$row=$objMouza->getRow();
?>
<select name="Mauza_code" id="Mauza_code" style="<?php echo $mystyle;?>" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Mouza_code'];
$mdetail=$row[$ind]['Mouza_name'];
if ($mvalue[8]==$mcode)
$sel=" Selected ";
else 
$sel=" ";    
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
</td>
<?php $i++; //Now i=9?>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Village
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:160px";
$objVillage=new Village();
$objVillage->setCondString("Cir_code=".$mvalue[7]." order by Vill_name" ); //Change the condition for where clause accordingly
$row=$objVillage->getRow();
?>
<select name="Vill_code" id="Vill_code" style="<?php echo $mystyle;?>">
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Vill_code'];
$mdetail=$row[$ind]['Vill_name'];
if ($mvalue[9]==$mcode)
$sel=" Selected ";
else 
$sel=" ";    
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
</td>
</tr>
<?php $i++; //Now i=10?>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:red;color:black;width:100px";
?>
<tr>
<td align=center bgcolor=#FFFFCC>
<input type=button value=Menu  name=back1 id=back1 onclick=home()  style="<?php echo $mystyle;?>">
    
<?php
if ($_SESSION['update']==1)
{
$cap="U";
}
else
{
$cap="";
}
?>
</td>
<td align=left bgcolor=#FFFFCC >
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:green;color:black;width:90px";
?>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="Reset"  name=res1 id="res1"  onclick="resme()"  style="<?php echo $mystyle;?>">
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:150px";
?>
    <?php
if($cap=="U")
{
?> 
<input type=button value="Update Detail"  name="Save" id="Save" onclick=validate() style="<?php echo $mystyle;?>">
<?php
}
?>
</td>
<td align="right" bgcolor="#FFFFCC"><font face="arial" size="2">
<?php 
if($mvalue[3]=="CT")    
echo "Sub Caste" ?>
 </td>
<td align="left" bgcolor="#FFFFCC">
<?php
if($mvalue[3]=="CT") //Caste
$objDbm->genSelectBox("Subcaste","Select Detail from subcaste order by detail", $mvalue[12], 150, "white", "black", 12, "");    
?>
</td>
</tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Pet_yr");

if($mtype==2)//Postback from Pet_yr
echo $objUtility->focus("Pet_no");

if($mtype==4)//Postback from Pet_no
echo $objUtility->focus("Applicant");

if($mtype==6)//Postback from Pet_type
echo $objUtility->focus("Father");

if($mtype==12)//Postback from Ps_code
echo $objUtility->focus("Circle_code");

if($mtype==13)//Postback from Circle_code
echo $objUtility->focus("Mauza_code");

if($mtype==14)//Postback from Mauza_code
echo $objUtility->focus("Vill_code");

if($mtype==15)//Postback from Vill_code
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
$temp[3]="";//Pet_type
$temp[4]="";//Father
$temp[5]="";//Mother
$temp[6]="0";//Ps_code
$temp[7]="0";//Circle_code
$temp[8]="0";//Mauza_code
$temp[9]="0";//Vill_code
$temp[10]="0";//Village
$temp[11]="";//Relation
$temp[12]="";
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=12;$i++)
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

?>
</body>
</html>
