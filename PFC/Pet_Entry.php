<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>

<script type=text/javascript src="../Validation.js"></script>
<script src="../jquery-1.10.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');
//if(document.getElementById('Vill_code').selectedIndex==1)
//$("#Village").show();
//else
//$("#Village").hide();    

var b=$("#Pet_type").val();
if (b=="PR" || b=="CT" || b=="NC" || b=="DM")
{  
//alert('ARTPS') ;   
$("#Mother").show();
$("#M").show(); 
}
else
{
$("#Mother").hide();
$("#M").hide(); 
}

//alert(document.getElementById('Circle_code').value);
//MyAjaxFunction("POST","LoadSelectBox.php?type=V","Cir=0",'Vill');

$("#Circle_code").change(function(event){
var data="Cir="+document.getElementById('Circle_code').value;
//alert(data);
MyAjaxFunction("POST","LoadSelectBox.php?type=M",data,'Mouza',"HTML");
MyAjaxFunction("POST","LoadSelectBox.php?type=V",data,'Vill',"HTML");
});//$("#Circe_code)

}); //document ready
</script>



<script language=javascript>
<!--
function LoadVillCode()
{
document.getElementById('Villcode').value=document.getElementById('Vill_code').value;
}

function LoadMouzaCode()
{
document.getElementById('Mauzacode').value=document.getElementById('Mauza_code').value;
}

function home()
{
window.location="Mainmenu.php";
}

function tt()
{
//alert(document.getElementById('Circle_code').selectedIndex);    
}

function reload(el)
{
var i=myform.Vill_code.selectedIndex;
if (i==1)
{
myform.Village.disabled=false;
document.getElementById(el).style.backgroundColor = '#99CC33';
}
else
{    
myform.Village.disabled=true;
myform.Village.value="";
document.getElementById(el).style.backgroundColor = 'white';
}
}


function setMe()
{
myform.Pet_type.focus();
}

function redirect(i)
{
myform.action="Pet_Entry.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}


function validate()
{

//var n_index=parseInt(myform.Mauzacode.value);
//alert(n_index);
//var n_index=parseInt(myform.Villcode.value);
//alert(n_index);

var b=myform.Pet_type.value ;
var ad=myform.Exp_dt.value ;
var pd=myform.Pdate.value;

var f=myform.Applicant.value ;

//var v_index=myform.Vill_code.selectedIndex;
var v_index=myform.Villcode.value;

var temp=true;
//alert('ok');
if(checkName('Applicant')==false)
{    
myform.Applicant.focus();
b="x";
}
//alert('checkname');


var ph=myform.Phone.value;
if (validateString(ph)==false)
{
alert('Invalid Character at Phone')
b="x";
myform.Phone.focus();
}
// alert('ok2');

var ap_length=parseInt(ph.length); 
if (ap_length>11) 
{
alert('Phone Length Exceeds limit')
b="x";
myform.Phone.focus();     
}
 
 
//if(v_index==1)
//{
//var vill=myform.Village.value;    
//if(notNull(vill)==false || validateString(vill)==false)
//temp=false;    
//}

if (temp==false)
alert('Invalid Village');
else
{    
if (CompareDate(ad,pd)==-1)
alert('Invalid Delivery Date')
else
{    
if (b=="PR" || b=="CT" || b=="NC" || b=="DM") //Under ARTPS
{
if(b=="CT" || b=="NC") //Challan no required for Caste and Creamy
{
var camt=myform.Challanamt.value;
var cno=myform.Challanno.value;
if (isNumber(camt) && parseInt(camt)>0 && notNull(cno) && validateString(cno))
validatePR();
else
alert('Check Challan No & Amount');
}   //Challanamt
else
validatePR();    
}


if (b=="ER") //Electoral ROll
validateER();

if (b=="JB") //Jamabandi
validateJB();

if (b=="BK")  //Bakijai
validateBK();


if (b=="LH") //Legal Heir //Under ARTPS
validateBK();

} //comparedate
} //temp
}



function validatePR()
{
 
var ptype=myform.Pet_type.value;
var b=myform.Pet_type.selectedIndex ;
var f=myform.Applicant.value ;
var f_length=parseInt(f.length);
var g=myform.Relation.selectedIndex ;
var h=myform.Father.value ;
var h_length=parseInt(h.length);
var i=myform.Mother.value ;
var i_length=parseInt(i.length);

var l_index=myform.Circle_code.selectedIndex;
var m_index=myform.Ps_code.selectedIndex;

var n_index=parseInt(myform.Mauzacode.value);
var o_index=parseInt(myform.Villcode.value);

var q=myform.Ward.value ;
var q_length=parseInt(q.length);
var r=myform.Co_letter.value ;
var r_length=parseInt(r.length);

var s=myform.Co_letter_dt.value ;

var ad=myform.Exp_dt.value ;

var ai=myform.Sex.selectedIndex ;

var aj=myform.Dob.value ;

if (ptype=="PR")
{
if (isdate(aj,1)==false)
{
b=0;    
alert('Invalid Date of Birth')
}   
}

if (b>0 && notNull(f) && validateString(f) && f_length<=70  && g>0 && notNull(h) && validateString(h) && h_length<=60 && notNull(i) && validateString(i) && i_length<=50 && l_index>0  && m_index>0  && n_index>0  && o_index>0  &&  validateString(q) && q_length<=50 &&  validateString(r) && r_length<=50 &&  isdate(s,0) &&  isdate(ad,1) &&  ai>0)
{
myform.Save.disabled=true;
myform.action="Insert_pet_entry.php";
myform.submit();
}
else
alert('Invalid Data');
}

function validateER()
{
var b=myform.Pet_type.selectedIndex ;
var f=myform.Applicant.value ;
var f_length=parseInt(f.length);
var g=myform.Relation.selectedIndex ;
var h=myform.Father.value ;
var h_length=parseInt(h.length);

//alert('ok1');
var l_index=myform.Circle_code.selectedIndex;
var m_index=myform.Ps_code.selectedIndex;
var n_index=parseInt(myform.Mauzacode.value);
var o_index=parseInt(myform.Villcode.value);
//alert('ok2a');
var ad=myform.Exp_dt.value ;
//alert('ok2');

//var al=myform.Patta_no.value ;
//var al_length=parseInt(al.length);

var ao=myform.Lac_no.selectedIndex ;
var ap=myform.Part_no.value ;
var ap_length=parseInt(ap.length);
var aq=myform.House_no.value ;
var aq_length=parseInt(aq.length);
//alert('ok3');

if (notNull(ap) && validateString(aq) && b>0 && notNull(f) && validateString(f) && f_length<=70  && g>0 && notNull(h) && validateString(h) && h_length<=60 &&  l_index>0  && m_index>0  && n_index>0  && o_index>0  &&   isdate(ad,1) &&  ao>0 )
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.Save.disabled=true;
myform.action="Insert_pet_entry.php";
myform.submit();
}
else
alert('Invalid Data');
}


function validateJB()
{
var b=myform.Pet_type.selectedIndex ;
var f=myform.Applicant.value ;
var f_length=parseInt(f.length);
var g=myform.Relation.selectedIndex ;
var h=myform.Father.value ;
var h_length=parseInt(h.length);

var l_index=myform.Circle_code.selectedIndex;
var m_index=myform.Ps_code.selectedIndex;

var n_index=parseInt(myform.Mauzacode.value);
var o_index=parseInt(myform.Villcode.value);

var ad=myform.Exp_dt.value ;
var al=myform.Patta_no.value ;
var al_length=parseInt(al.length);
var pt=myform.Patta_type.selectedIndex;

if (pt>0 && notNull(al) && b>0 && notNull(f) && validateString(f) && f_length<=70  && g>0 && notNull(h) && validateString(h) && h_length<=60 && l_index>0  && m_index>0  && n_index>0  && o_index>0  &&   isdate(ad,1))
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.Save.disabled=true;
myform.action="Insert_pet_entry.php";
myform.submit();
}
else
alert('Invalid Data');
}

function validateBK()
{
var b=myform.Pet_type.selectedIndex ;
var f=myform.Applicant.value ;
var f_length=parseInt(f.length);
var g=myform.Relation.selectedIndex ;
var h=myform.Father.value ;
var h_length=parseInt(h.length);

var l_index=myform.Circle_code.selectedIndex;
var m_index=myform.Ps_code.selectedIndex;
//alert(m_index);
var n_index=parseInt(myform.Mauzacode.value);
//alert(n_index);
var o_index=parseInt(myform.Villcode.value);
//alert(o_index);
var ad=myform.Exp_dt.value ;

if (b>0 && notNull(f) && validateString(f) && f_length<=70  && g>0 && notNull(h) && validateString(h) && h_length<=60 && l_index>0  && m_index>0  && n_index>0  && o_index>0  &&   isdate(ad,1))
{
//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
myform.Save.disabled=true;
myform.action="Insert_pet_entry.php";
myform.submit();
}
else
alert('Invalid Data');
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


function loadsex()
{
var i=document.getElementById('Relation').selectedIndex;
if (i==0)
document.getElementById('Sex').selectedIndex=0;
if (i==1 || i==3)
document.getElementById('Sex').selectedIndex=1; 
if (i==2)
document.getElementById('Sex').selectedIndex=2;
}

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
header('Refresh: 240;url=../IndexPage.php?tag=1');
session_start();
require_once '../class/utility.class.php';
require_once '../bakijai/class/class.circle.php';
require_once '../bakijai/class/class.police_station.php';
require_once '../bakijai/class/class.mouza.php';
require_once '../bakijai/class/class.village.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once '../class/class.relation.php';
require_once '../class/class.lac.php';
require_once '../class/class.sex.php';
require_once 'header.php';

$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 7)==false) //7 for petition entry
header( 'Location: Mainmenu.php?unauth=1');

$certgroup=0;

$objPetition_master=new Petition_master();
$objPetition_type=new Petition_type();
$dis=" disabled";
$pettype="";
$mdis=" ";
$phone="";
$Challanno="";
$Challanamt="";

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

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();

if (isset($_SESSION['username']))
$username="Assistant Name-".$_SESSION['username'];
else 
$username="";

if ($_tag==1)//Return from Action Form
{
echo $objUtility->alert($_SESSION['msg']);   
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="";//Pet_type
$mvalue[1]="";//Pet_yr
$mvalue[2]="";//Pet_date
$mvalue[3]="0";//Pet_no
$mvalue[4]="";//Applicant
$mvalue[5]="";//Relation
$mvalue[6]="";//Father
$mvalue[7]="";//Mother
$mvalue[8]="0";//Circle_code
$mvalue[9]="0";//Ps_code
$mvalue[10]="0";//Mauza_code
$mvalue[11]="0";//Vill_code
$mvalue[12]="";//Ward
$mvalue[13]="";//Co_letter
$mvalue[14]="";//Co_letter_dt
$mvalue[15]="";//Bpl
$mvalue[16]="";//Introduced_by
$mvalue[17]="";//Exp_dt
$mvalue[18]="";//Sex
$mvalue[19]="";//Dob
$mvalue[20]="";//Period
$mvalue[21]="";//Patta_no
$mvalue[22]="";//Caste
$mvalue[23]="";//Subcaste
$mvalue[24]="0";//Lac_no
$mvalue[25]="";//Part_no
$mvalue[26]="";//House_no
$mvalue[27]="";//Countersignature
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]

if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue[0]="";//Pet_type
$mvalue[1]=date('Y');//Pet_yr
$mvalue[2]=date('d/m/Y');//Pet_date
// Call  Function Here if required and Load in $mvalue[3]
$mvalue[3]=$objPetition_master->MaxPet_no($mvalue[1]);//Pet_no
$mvalue[4]="";//Applicant
$mvalue[5]="";//Relation
$mvalue[6]="";//Father
$mvalue[7]="";//Mother
// Call $objPetition_master->MaxCircle_code() Function Here if required and Load in $mvalue[8]
$mvalue[8]="0";//Circle_code
// Call $objPetition_master->MaxPs_code() Function Here if required and Load in $mvalue[9]
$mvalue[9]="0";//Ps_code
// Call $objPetition_master->MaxMauza_code() Function Here if required and Load in $mvalue[10]
$mvalue[10]="0";//Mauza_code
// Call $objPetition_master->MaxVill_code() Function Here if required and Load in $mvalue[11]
$mvalue[11]="0";//Vill_code
$mvalue[12]="";//Ward
$mvalue[13]="";//Co_letter
$mvalue[14]="";//Co_letter_dt
$mvalue[15]="";//Bpl
$mvalue[16]="";//Introduced_by
$mvalue[17]="";//Exp_dt
$mvalue[18]="";//Sex
$mvalue[19]="";//Dob
$mvalue[20]="";//Period
$mvalue[21]="";//Patta_no
$mvalue[22]="";//Caste
$mvalue[23]="";//Subcaste
// Call $objPetition_master->MaxLac_no() Function Here if required and Load in $mvalue[24]
$mvalue[24]="0";//Lac_no
$mvalue[25]="";//Part_no
$mvalue[26]="";//House_no
$mvalue[27]="";//Countersignature
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

if($ptype>1 || !is_numeric($ptype))
$ptype=1;    
//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
   
if (isset($_POST['Pet_type']))
$mvalue[0]=$_POST['Pet_type'];
else
$mvalue[0]=0;

$objPetition_type->setCode($mvalue[0]);
if ($objPetition_type->EditRecord())
{
$pettype="  <b>".$objPetition_type->getDetail()."</b>";
$dis="";
}
else
{
$pettype="";
$dis=" disabled";
}
if ($mvalue[0]=="PR" || $mvalue[0]=="DM" || $mvalue[0]=="CT" || $mvalue[0]=="NC")
{
    $certgroup="PR";
    $mdis=" ";
}
else 
{
$certgroup=$mvalue[0];   
 $mdis=" disabled";
}
//echo "1st".$pettype;
$mvalue[1]=date('Y');//Pet_yr
$mvalue[2]=date('d/m/Y');//Pet_date
// Call  Function Here if required and Load in $mvalue[3]
$mvalue[3]=$objPetition_master->MaxPet_no($mvalue[1]);//Pet_no


if (isset($_POST['Applicant']))
$mvalue[4]=$_POST['Applicant'];
else
$mvalue[4]="";

if (isset($_POST['Relation']))
$mvalue[5]=$_POST['Relation'];
else
$mvalue[5]=0;

if (isset($_POST['Father']))
$mvalue[6]=$_POST['Father'];
else
$mvalue[6]="";

if (isset($_POST['Mother']))
$mvalue[7]=$_POST['Mother'];
else
$mvalue[7]="-";

if (isset($_POST['Circle_code']))
$mvalue[8]=$_POST['Circle_code'];
else
$mvalue[8]=0;

if (!is_numeric($mvalue[8]))
$mvalue[8]=-1;
if (isset($_POST['Ps_code']))
$mvalue[9]=$_POST['Ps_code'];
else
$mvalue[9]=0;

if (!is_numeric($mvalue[9]))
$mvalue[9]=-1;
if (isset($_POST['Mauza_code']))
$mvalue[10]=$_POST['Mauza_code'];
else
$mvalue[10]=0;

if (!is_numeric($mvalue[10]))
$mvalue[10]=-1;
if (isset($_POST['Vill_code']))
$mvalue[11]=$_POST['Vill_code'];
else
$mvalue[11]=0;

if (!is_numeric($mvalue[11]))
$mvalue[11]=-1;
if (isset($_POST['Ward']))
$mvalue[12]=$_POST['Ward'];
else
$mvalue[12]="";

if (isset($_POST['Co_letter']))
$mvalue[13]=$_POST['Co_letter'];
else
$mvalue[13]="";

if (isset($_POST['Co_letter_dt']))
$mvalue[14]=$_POST['Co_letter_dt'];
else
$mvalue[14]="";

if (isset($_POST['Bpl']))
$mvalue[15]=$_POST['Bpl'];
else
$mvalue[15]=0;



$mvalue[17]=$objUtility->NextDate(date('d/m/Y'), 15);//Exp_dt


if (isset($_POST['Sex']))
$mvalue[18]=$_POST['Sex'];
else
$mvalue[18]=0;

if (isset($_POST['Dob']))
$mvalue[19]=$_POST['Dob'];
else
$mvalue[19]="";

if (isset($_POST['Period']))
$mvalue[20]=$_POST['Period'];
else
$mvalue[20]="";

if (isset($_POST['Patta_no']))
$mvalue[21]=$_POST['Patta_no'];
else
$mvalue[21]="";


if (isset($_POST['Lac_no']))
$mvalue[24]=$_POST['Lac_no'];
else
$mvalue[24]="";

if (isset($_POST['Part_no']))
$mvalue[25]=$_POST['Part_no'];
else
$mvalue[25]="";

if (isset($_POST['House_no']))
$mvalue[26]=$_POST['House_no'];
else
$mvalue[26]="";

if (isset($_POST['Phone']))
$phone=$_POST['Phone'];
else
$phone="";

//Challanamt
if (isset($_POST['Challanamt']))
$Challanamt=$_POST['Challanamt'];
else
$Challanamt="";

if (isset($_POST['Challanno']))
$Challanno=$_POST['Challanno'];
else
$Challanno="";

} //ptype=1

//Unnecessary Block

} //tag==2


if($roll==0 || $roll==2)
$dis="";
else 
{    
$dis=" disabled";  
if($_tag==0)
echo $objUtility->alert("Data Entry Restricted") ;   
}
//echo "2nd".$pettype;
//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=""  method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>Enter New Petition for<b><font color=#CC9900><?php echo $pettype;?></b><br></font><font face=arial color=blue size=2><b><?php echo $username;?></b></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=white width="23%"><font color=black size=2 face=arial>Petition Type</font></td><td align=left bgcolor=white width="27%">
<select name="Pet_type" id="Pet_type" style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:225px"  onchange="redirect(1)">
<option value="0">Select Petition Type
<?php 
$objPetition_type->setCondString("running='Y'" ); //Change the condition for where clause accordingly
$row=$objPetition_type->getRow();
?>
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Detail'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Detail'];
}
} //for loop
?>
</select>       
  
</td>
<?php $i++; //Now i=1?>
<td align=left bgcolor=white colspan="2" width="50%"><font color=black size=2 face=arial>
<input type=hidden size=4 name="Pet_yr" id="Pet_yr" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=4 onfocus="ChangeColor('Pet_yr',1)"  onblur="ChangeColor('Pet_yr',2)" onchange=direct1()>
<?php $i++; //Now i=2?>
<input type=hidden size=10 name="Pet_date" id="Pet_date" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Pet_date',1)"  onblur="ChangeColor('Pet_date',2)" disabled>
Date:<b><?php 
echo $mvalue[2];
$i++; //Now i=3?></b>
<input type=hidden size=4 name="Pet_no" id="Pet_no" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Pet_no',1)"  onblur="ChangeColor('Pet_no',2)" onchange=direct1() disabled>
<font color=black size=2 face=arial>
    &nbsp;Petition No:<b><?php 
echo $mvalue[3]."/".$mvalue[1];?>
</td>
</tr>
<?php 
$i++; //Now i=4?>
<tr>
<td align=right bgcolor=white width="23%"><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Name of Applicant</font></td><td align=left bgcolor=white width="23%">
<input type=text size=30 name="Applicant" id="Applicant" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold" maxlength=70 onfocus="ChangeColor('Applicant',1)"  onblur="ChangeColor('Applicant',2)">
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=white width="23%"><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Relation Type</font></td><td align=left bgcolor=white width="27%">
<select name="Relation" id="Relation" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange="loadsex()">
<?php 
$objRel=new Relation();
$objRel->setCondString(" Artps=0" ); //Change the condition for where clause accordingly
$row=$objRel->getRow();
?>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Rel_name'])
{
?>
<option selected value="<?php echo $row[$ind]['Rel_name'];?>"><?php echo $row[$ind]['Rel_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Rel_name'];?>"><?php echo $row[$ind]['Rel_name'];
}
} //for loop
?>    
</select>  <font color=red size=3 face=arial>*</font>  
</td>
</tr>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial><font face=arial color=red size=4><b>*</b></font>Father/Husband</font></td><td align=left bgcolor=white>
<input type=text size=35 name="Father" id="Father" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=60 onfocus="ChangeColor('Father',1)"  onblur="ChangeColor('Father',2)">
</td>
<?php $i++; //Now i=7?>
<td align=right bgcolor=white><font color=black size=2 face=arial>
    <div id="M"><font face=arial size="2"><b>*</b>Mother's Name</font></div></td>
<td align=left bgcolor=white>
<input type=text size=35 name="Mother" id="Mother" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Mother',1)"  onblur="ChangeColor('Mother',2)" <?php echo $mdis;?>>
</td>
</td>
</tr>
<?php $i++; //Now i=8?>
<tr>
<?php $i++; //Now i=9?>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Select Police Station</font></td><td align=left bgcolor=white>
<?php 
$objPolice_station=new Police_station();
$objPolice_station->setCondString(" code>0 order by name" ); //Change the condition for where clause accordingly
$row=$objPolice_station->getRow();
?>
<select name=Ps_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[9]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];
}
} //for loop
?>
</select>
</td>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Select Circle</font></td><td align=left bgcolor=white>
<?php 
$objCircle=new Circle();
$objCircle->setCondString(" cir_code>0 order by circle" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name=Circle_code id="Circle_code" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange="tt()">
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[8]==$row[$ind]['Cir_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];
}
} //for loop
?>
</select>
</td>

</tr>
<?php $i++; //Now i=10?>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial><font face=arial color=red size=4><b>*</b></font>Select Mouza</font></td><td align=left bgcolor=white>
<div id="Mouza">
<select name=Mauza_code id="Mauza_code">
<option value="0">Select
</select>        
</div> 
<input type="hidden" name=Mauzacode id="Mauzacode" value="0" readonly >

</td>
<?php $i++; //Now i=11?>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Select Village</font></td><td align=left bgcolor=white>
<div id="Vill">
<select name=Vill_code id="Vill_code">
<option value="0">Select
</select>    
</div> 
<input type="hidden" name="Villcode" id="Villcode" value="0" readonly >
   
<input type="hidden" name="Village" id="Village" size="20" disabled>   

</td>
</tr>
<?php if ($certgroup=="PR") { //$i++; //Now i=12?>
<tr>
<td align=right bgcolor=white><font color=black size=2 face=arial>Ward</font></td><td align=left bgcolor=white>
<input type=text size=20 name="Ward" id="Ward" value="<?php echo $mvalue[12]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Ward',1)"  onblur="ChangeColor('Ward',2)">
</td>
<td bgcolor=white colspan="2">&nbsp;</td></tr>
<?php 
//echo "group".$certgroup;COLETTER
?>

<?php if ($mvalue[0]=="CT" || $mvalue[0]=="NC")
{?>    
<tr>
<?php //$i++; //Now i=15?>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Chalan No</font></td><td align=left bgcolor=white>
<input type=text size="20" name="Challanno" id="Challanno" value="<?php echo $Challanno; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=20 onfocus="ChangeColor('Challanno',1)"  onblur="ChangeColor('Challanno',2)">
</td>
<?php //$i++; //Now i=16?>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Challan Amount
<?php //$i++; //Now i=17?>
</td><td bgcolor="white">
<input type=text size="10" name="Challanamt" id="Challanamt" value="<?php echo $Challanamt; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=2 onfocus="ChangeColor('Challanamt',1)"  onblur="ChangeColor('Challanamt',2)">
</td>
</tr>
<?php 
}else{
?>
<input type=hidden name="Challanamt" value="0">
<input type=hidden name="Challanno" value="/">
<?php
} // Challan only for SC and Non Creamy//$i++; //Now i=18?>
<tr>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Sex</font></td><td align=left bgcolor=white>
<?php 
$objSex=new Sex();
$row=$objSex->getRow();
?>
<select name=Sex style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:100px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[18]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Detail'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Detail'];
}
} //for loop
?>
</select>
 
</td>

<td align=right bgcolor=white>
<?php //$i++; //Now i=19 
if ($mvalue[0]=="PR"){?>    
<font face=arial color=red size=4><b>*</b> 
<?php } ?>
<font color=black size=2 face=arial>Date of Birth</font></td><td align=left bgcolor=white>
<input type=text size=8 MAXLENGTH="10" name="Dob" id="Dob" value="<?php echo $mvalue[19]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" onfocus="ChangeColor('Dob',1)"  onblur="ChangeColor('Dob',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Dob);" alt="Click Here to Pick Date">

</td>
</tr>
<?php 
}
//$i=19;
//$i++; //Now i=20?>

<?php 
//echo "group-".$certgroup;
if ($certgroup=="JB"){?>
<tr>
<td align=right bgcolor=white ><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Patta Number</font></td><td align=left bgcolor=white>
<input type=hidden size=4 name="Period" id="Period" value="<?php echo $mvalue[20]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Period',1)"  onblur="ChangeColor('Period',2)">
<?php //$i++; //Now i=21?>
<input type=text size=10 name="Patta_no" id="Patta_no" value="<?php echo $mvalue[21]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Patta_no',1)"  onblur="ChangeColor('Patta_no',2)">
<?php //$i++; //Now i=22?>
<?php //$i++; //Now i=23?>
</td>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font face="arial" size="2">Patta Type</td>
<td align="left" bgcolor=white>
<select name="Patta_type" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:150px">
<option  value="-">-Select-
<option  value="Kheraj">Kheraj Myadi 
<option  value="Nispi Kheraj">Nispi Kheraj   
</select>    
</td>
<?php } 
if ($certgroup=="ER") {
    
//$i++; //Now i=24?>
<tr><td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Select LAC</font></td><td align=left bgcolor=white>
<?php 
$objLac=new Lac();
$objLac->setCondString(" code>0");
$row=$objLac->getRow();
?>
<select name=Lac_no style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:170px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[24]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];
}
} //for loop
?>
</select>
</td><td align=right colspan="2" bgcolor=white>&nbsp;</td>
<?php }?>
</tr>

<?php if ($certgroup=="ER") {//$i++; //Now i=25?>
<tr>
<td align=right bgcolor=white><font face=arial color=red size=4><b>*</b></font><font color=black size=2 face=arial>Part Number</font></td><td align=left bgcolor=white>
<input type=text size=10 name="Part_no" id="Part_no" value="<?php echo $mvalue[25]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Part_no',1)"  onblur="ChangeColor('Part_no',2)">
</td>
<?php //$i++; //Now i=26?>
<td align=right bgcolor=white><font color=black size=2 face=arial>House Number</font></td><td align=left bgcolor=white>
<input type=text size=10 name="House_no" id="House_no" value="<?php echo $mvalue[26]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('House_no',1)"  onblur="ChangeColor('House_no',2)">
<?php //$i++; //Now i=27?>
</td>
</tr>
<?php }//$i++; //Now i=28?>
<tr>
<td align="right" bgcolor=white>
<font color=black size=2 face=arial>Phone No</td>
<td align="left" bgcolor=white>
 <?php  // echo $phone;?>
<input type=text size=20 name="Phone" id="Phone"  style="font-family: Arial;background-color:white;color:black; font-size: 12px"  onfocus="ChangeColor('Phone',1)"  onblur="ChangeColor('Phone',2)" value="<?php echo $phone; ?>" maxlength="11">

<td align="right" bgcolor=white><font face=arial color=red size=4><b>*</b></font>
<font color=black size=2 face=arial>Delivery Date</font></td>
<td align="left" bgcolor=white>
<input type=text size=8 MAXLENGTH="10" name="Exp_dt" id="Exp_dt"  style="font-family: Arial;background-color:white;color:black; font-size: 12px" value="<?php echo $mvalue[17]; ?>" onfocus="ChangeColor('Exp_dt',1)"  onblur="ChangeColor('Exp_dt',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Exp_dt);" alt="Click Here to Pick Date">
</td></tr>
<?php if ($certgroup=="PR" || $mvalue[0]=="LH") {//$i++; //Now i=25?>
<tr>
<?php //$i++; //Now i=13?>
<td align=right bgcolor=white><font color=black size=2 face=arial>CO Letter No</font></td><td align=left bgcolor=white>
 <input type=text size=30 name="Co_letter" id="Co_letter" value="<?php echo $mvalue[13]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Co_letter',1)"  onblur="ChangeColor('Co_letter',2)">
</td>
<?php //$i++; //Now i=14?>
<td align=right bgcolor=white><font color=black size=2 face=arial>Letter Date</font></td><td align=left bgcolor=white>
<input type=text size=8 name="Co_letter_dt" id="Co_letter_dt" value="<?php echo $mvalue[14]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Co_letter_dt',1)"  onblur="ChangeColor('Co_letter_dt',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Co_letter_dt);" alt="Click Here to Pick Date">

</td>
</tr>
<?php }?>

<tr><td align=right bgcolor=white>
</td><td align=left bgcolor=white>
<input type=hidden size=20 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="Save Petition"  name=Save id="Save" onclick=validate()  style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:#99CC99;color:blue;width:100px"  <?php echo $dis; ?>>

<input type=button value=Menu  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<td align="center" colspan="2" bgcolor=white><b>
    <font face="arial" size="2" color="#9966FF">Developed by National Informatics Center,Nalbari, Assam </b>   
    
</td></tr>
</table>
</form>
       
<?php
if($mtype==0)
echo $objUtility->focus("Pet_type");

if($mtype==1)//Postback from Pet_type
echo $objUtility->focus("Applicant");

if($mtype==3)//Postback from Pet_yr
echo $objUtility->focus("Pet_date");

if($mtype==4)//Postback from Pet_date
echo $objUtility->focus("Pet_no");

if($mtype==5)//Postback from Pet_no
echo $objUtility->focus("Applicant");

if($mtype==6)//Postback from Applicant
echo $objUtility->focus("Relation");

if($mtype==7)//Postback from Relation
echo $objUtility->focus("Father");

if($mtype==8)//Postback from Father
echo $objUtility->focus("Mother");

if($mtype==9)//Postback from Mother
echo $objUtility->focus("Circle_code");

//if($mtype==12)//Postback from Circle_code
//echo $objUtility->focus("Ps_code");

if($mtype==12)//Postback from Circle_code
echo $objUtility->focus("Mauza_code");

if($mtype==14)//Postback from Mauza_code
echo $objUtility->focus("Vill_code");

if($mtype==15)//Postback from Vill_code
echo $objUtility->focus("Ward");

if($mtype==17)//Postback from Ward
echo $objUtility->focus("Co_letter");

if($mtype==18)//Postback from Co_letter
echo $objUtility->focus("Co_letter_dt");

if($mtype==19)//Postback from Co_letter_dt
echo $objUtility->focus("Bpl");

if($mtype==20)//Postback from Bpl
echo $objUtility->focus("Introduced_by");

if($mtype==21)//Postback from Introduced_by
echo $objUtility->focus("Exp_dt");

if($mtype==30)//Postback from Exp_dt
echo $objUtility->focus("Sex");

if($mtype==35)//Postback from Sex
echo $objUtility->focus("Dob");

if($mtype==36)//Postback from Dob
echo $objUtility->focus("Period");

if($mtype==37)//Postback from Period
echo $objUtility->focus("Patta_no");

if($mtype==38)//Postback from Patta_no
echo $objUtility->focus("Caste");

if($mtype==39)//Postback from Caste
echo $objUtility->focus("Subcaste");

if($mtype==40)//Postback from Subcaste
echo $objUtility->focus("Lac_no");

if($mtype==41)//Postback from Lac_no
echo $objUtility->focus("Part_no");

if($mtype==42)//Postback from Part_no
echo $objUtility->focus("House_no");

if($mtype==43)//Postback from House_no
echo $objUtility->focus("Countersignature");

if($mtype==45)//Postback from Countersignature
echo $objUtility->focus("Pet_type");

?>
</body>
</html>
