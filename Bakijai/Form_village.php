<html>
<head>
<title>Entry Form for village</title>
</head>
<script type=text/javascript src="../validation.js"></script>


<script language=javascript>
<!--

function trans(Eng,Ass)
{
var data="Param="+document.getElementById(Eng).value;
MyAjaxFunction("POST","../class/Converter.php?tag=A",data,Ass,"TEXT");
}

function transE(Eng,EngN)
{
var data="Param="+document.getElementById(Eng).value;
MyAjaxFunction("POST","../class/Converter.php?tag=E",data,EngN,"TEXT");
}

function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Vill_code.value=mvalue;

var a=myform.Vill_code.value ;//Primary Key
if ( isNaN(a)==false && a!="")
{
myform.action="Form_village.php?tag=2&ptype=0";
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
myform.Vill_code.focus();
}

function redirect(i)
{
myform.action="Form_village.php?tag=2&ptype=1&mtype="+i;
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
var a=myform.Vill_code.value ;// Primary Key
var b=myform.Vill_name.value ;
var b_length=parseInt(b.length);
var c=myform.Cir_code.value ;
var c_index=myform.Cir_code.selectedIndex;
var d=myform.Vill_name_ass.value ;
var d_length=parseInt(d.length);
if ( isNumber(a)==true   && 1==1 && validateString(b) && b_length<=60 && c_index>0  && 1==1 && validateString(d) && d_length<=100)
{
myform.action="Insert_village.php";
myform.submit();
}
else
alert('Invalid Data');
}


function home(i)
{
if(i==0)
window.location="mainmenu.php?tag=1";
else
window.location="../startmenu.php?tag=1";
}

function home1()
{
window.location="../pfc/mainmenu.php?tag=1";
}


//change the focus to Box(a)
function ChangeFocus(a)
{
//document.getElementById(a).focus();
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
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.village.php';
require_once './class/class.circle.php';

require_once '../class/class.converter.php';
require_once '../class/class.sentence.php';
require_once 'header.php';
$objConv=new Converter();
$objSen=new Sentence();

$village="";
$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php');

$objVillage=new Village();


if ($roll>0)
$disV=" readonly ";
else
$disV=" ";    


echo "dis-".$disV;

$check=" ";
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

$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[4]=0;
$mvalue[0]=$objVillage->MaxVill_code();
}
else
{
$mvalue[0]="0";//Vill_code
$mvalue[1]="";//Vill_name
$mvalue[2]="0";//Cir_code
$mvalue[3]="";//Vill_name_ass
$mvalue[4]=0;
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
// Call $objVillage->MaxVill_code() Function Here if required and Load in $mvalue[0]
$mvalue[0]=$objVillage->MaxVill_code();//Vill_code
$mvalue[1]="";//Vill_name
// Call $objVillage->MaxCir_code() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//Cir_code
$mvalue[3]="";//Vill_name_ass
$mvalue[4]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

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
if (isset($_POST['Vill_code']))
$mvalue[0]=$_POST['Vill_code'];
else
$mvalue[0]=0;

if (isset($_POST['Vill_name']))
$mvalue[1]=$_POST['Vill_name'];
else
$mvalue[1]=0;

if (isset($_POST['Cir_code']))
$mvalue[2]=$_POST['Cir_code'];
else
$mvalue[2]=0;

if (!is_numeric($mvalue[2]))
$mvalue[2]=-1;
if (isset($_POST['Vill_name_ass']))
$mvalue[3]=$_POST['Vill_name_ass'];
else
$mvalue[3]=0;

if (isset($_POST['Editme']))
$mvalue[4]=$_POST['Editme'];
else
$mvalue[4]=0;

if (isset($_POST['Village']))
$village=$_POST['Village'];
else
$village="";    

if($mtype==101)
{
$mvalue[3]=$objConv->English2Unicode($village);
$mvalue[1]=$objConv->filterEnglish($village);
$mvalue[1]=$objSen->SentenceCase($mvalue[1]);
}

if (isset($_POST['Revenue_village']))
$check=" checked=check";
else
$check="";  

} //ptype=1

if (isset($_POST['Vill_code']))
$pkarray[0]=$_POST['Vill_code'];
else
$pkarray[0]=0;
$objVillage->setVill_code($pkarray[0]);
if ($objVillage->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objVillage->getVill_code();
$mvalue[1]=$objVillage->getVill_name();
$mvalue[2]=$objVillage->getCir_code();
$mvalue[3]=$objVillage->getVill_name_ass();
$mvalue[4]=0;//last Select Box for Editing
$village=$mvalue[1];
if ($objVillage->getRevenue_Village()==true)
$check=" checked=check";
else
$check="";    
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
if ($ptype==0)
{
$mvalue[0]=$pkarray[0];
$mvalue[1]="";
$mvalue[2]=-1;
$mvalue[3]="";
$mvalue[4]=0;//last Select Box for Editing
}//ptype=0
} //EditRecord()
} //tag==2

if(isset($_SESSION['prev']))
$prev=$_SESSION['prev'];
else
$prev=0;

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_village.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Entry/Edit Form for Village<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Code</font></td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=8 name="Vill_code" id="Vill_code" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Vill_code',1)"  onblur="ChangeColor('Vill_code',2)" onchange=direct1() readonly>
<?php echo $mvalue[$i]; ?>
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Type here in Assamese Like English</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Village" id="Village" value="<?php echo $village; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold" maxlength=60  onblur="transE('Village','Vill_name')"  onkeyup="trans('Village','Vill_name_ass')"   <?php echo $disV;?>>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#CC66FF><font color=black size=2 face=arial>Village Name(English)</font></td><td align=left bgcolor=#CC66FF>
<input type=text size=50 name="Vill_name" id="Vill_name" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=60 onfocus="ChangeColor('Vill_name',1)"  onblur="ChangeColor('Vill_name',2)" >
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Circle</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objCircle=new Circle();
$objCircle->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name=Cir_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(3)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Cir_code'])
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
<input type="checkbox" name="Revenue_village" <?php echo $check;?>>Revenue Village   
</td>
</tr>
<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#CC66FF><font color=black size=2 face=arial>Village Name(Ass)</font></td><td align=left bgcolor=#CC66FF>
<input type=text size=50 name="Vill_name_ass" id="Vill_name_ass" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" maxlength=100 onfocus="ChangeColor('Vill_name_ass',1)"  onblur="ChangeColor('Vill_name_ass',2)" <?php echo $disV;?>>
</td>
</tr>
<?php $i++; //Now i=4?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<?php if ($_SESSION['branch']==1 || $_SESSION['branch']==0){ // Bakijai?>
<input type=button value=Menu  name=back1 onclick=home(<?php echo $prev;?>) onfocus="ChangeFocus('Vill_code')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<?php }?>
<?php if ($_SESSION['branch']==4){ //Admisistration(PFC)?>
<input type=button value=Menu  name=back1 onclick=home1() onfocus="ChangeFocus('Vill_code')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<?php }?>
</td></tr>
<tr><td align=right>
<?php 
$objVillage->setCondString(" cir_code=".$mvalue[2]." order by vill_name"); //Change the condition for where clause accordingly
$row=$objVillage->getRow();
?>
<select name=Editme style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:220px" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Vill_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name']."[".$row[$ind]['Vill_name_ass']."]";?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name']."[".$row[$ind]['Vill_name_ass']."]";
}
} //for loop
?>
</select>
</td><td align=left>
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" disabled>
</tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Vill_code");

if($mtype==1)//Postback from Vill_code
echo $objUtility->focus("Vill_name");

if($mtype==2)//Postback from Vill_name
echo $objUtility->focus("Cir_code");

if($mtype==3)//Postback from Cir_code
echo $objUtility->focus("Vill_name_ass");

if($mtype==4)//Postback from Vill_name_ass
echo $objUtility->focus("Vill_code");

if($mtype==101)
echo $objUtility->focus("Cir_code");    
?>
</body>
</html>
