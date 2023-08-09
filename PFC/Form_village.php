<html>
<head>
<title>Entry Form for village</title>
</head>
<script language=javascript>
<!--
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



function isdate(dt,tag)
{
//var dt=myform.Est_On.value;
var ln=parseInt(dt.length);
var dd;
var mm;
var yyyy;
var leapday;
var tt=true;
var i=dt.indexOf("/");
dd=dt.substr(0,i);
var j=dt.indexOf("/",(i+1));
mm=dt.substr((i+1),(j-i-1));
yyyy=dt.substr((j+1),(ln-j-1));
if(isNaN(yyyy)==false)
{
var t=parseInt(yyyy%4);
if(t==0)
leapday=29;
else
leapday=28;
}
if((tag==0) && ln==0)  //for null field No check
tt=true;
else
{
if (isNaN(dd)==false && isNaN(mm)==false && isNaN(yyyy)==false)
{
dd=Number(dd);
mm=Number(mm);
yyyy=Number(yyyy);
if( (mm>0) && (mm<13) && (dd>0) && (dd<32))
{
if((mm==4)||(mm==6)||(mm==9)||(mm==11)) //30st day
{
if (dd>30)
{
alert('Invalid Date '+dt+'(DD Part out of range)');
tt=false;
}
} // mm==4
if (mm==2)
{
if (dd>leapday)
{
alert('Invalid Date '+dt+'(DD Part)');
tt=false;
}
} //mm==2
}
else //mm>0 && dd>0
{
alert('Invalid Date '+dt+'(Month out of range)');
tt=false;
}
}
else  // Non numeric figure appears
{
alert('Invalid date '+dt);
tt=false;
}
}// not null
return(tt);
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
document.getElementById(a).focus();
}

//change color on focus to Box(a)
function ChangeColor(el,i)
{
if (i==1) // on focus
document.getElementById(el).style.backgroundColor = '#99CC33';
if (i==2) //on lostfocus
{
document.getElementById(el).style.backgroundColor = 'white';
var temp=document.getElementById(el).value;
trimBlank(temp,el);
}
}//changeColor on Focus

function validateString(str)
{
var str_index=str.indexOf("'");
var str_select=str.indexOf("select");
var str_insert=str.indexOf("insert");
var str_delete=str.indexOf("delete");
var str_dash=str.indexOf("--");
var str_vbscript=str.indexOf("vbscript");
var str_javascript=str.indexOf("javascript");
var str_ampersond=str.indexOf("&");
var str_lessthan=str.indexOf("<");
var str_greaterthan=str.indexOf(">");
var str_semicolon=str.indexOf(";");

if(str_index==-1 && str_select==-1 && str_insert==-1 && str_delete==-1 && str_dash==-1 && str_vbscript==-1 && str_javascript==-1 && str_ampersond==-1 && str_lessthan==-1 && str_greaterthan==-1 && str_semicolon==-1)
return(true);
else
return(false);
} 

function notNull(str)
{
var k=0;
var found=false;
var mylength=str.length;
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
if (k!=32)
found=true;
}
return(found);
}

function isNumber(ad)
{
if (isNaN(ad)==false && notNull(ad))
return(true);
else
return(false);
}

function checkName(str)
{
//var  str=n.value;
var k=0;
var found=true;
var mylength=str.length;
var newstr="";
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
//Allow Alphabet and Blank
if ( (k>=97 && k<=122)  || (k>=65 && k<=90) || (k==32)  )
{
newstr=newstr+str.substr(i,1);
}
else
{
alert('Invalid Character String ['+str+']');
found=false;
i=mylength+1;
}
}
return(found);
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
function trimBlank(str,a)
{

var newstr="";
var prev=0;
for (var i = 0; i < str.length; i++)
{
k=parseInt(str.charCodeAt(i));
if (k==32 && prev==0)
{
newstr=newstr;
}
else
{
newstr=newstr+str.substr(i,1);
}
if (k==32)
prev=0;
else
prev=1;
}
document.getElementById(a).value=newstr;
}//trimBlank

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
header('Refresh: 180;url=../IndexPage.php?tag=1');
session_start();
require_once '../class/utility.class.php';
require_once '../bakijai/class/class.village.php';
require_once '../bakijai/class/class.circle.php';

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
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Vill Code</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=8 name="Vill_code" id="Vill_code" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Vill_code',1)"  onblur="ChangeColor('Vill_code',2)" onchange=direct1() readonly>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Type Village Name</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Village" id="Village" value="<?php echo $village; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold" maxlength=60 onchange="redirect(101)" <?php echo $disV;?>>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#CC66FF><font color=black size=2 face=arial>Village Name</font></td><td align=left bgcolor=#CC66FF>
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
<td align=right bgcolor=#CC66FF><font color=black size=2 face=arial>Vill_name_ass</font></td><td align=left bgcolor=#CC66FF>
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
