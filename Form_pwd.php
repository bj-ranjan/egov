<html>
<head>
<title>Password Creation</title>
</head>
<script type=text/javascript src=validation.js></script>
<script language=javascript>
<!--
function direct()
{
var mvalue=myform.Editme.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Uid.value=mvalue;

var a=myform.Uid.value ;//Primary Key
if ( a!="")
{
myform.action="Form_pwd.php?tag=2&ptype=0";
myform.submit();
}
}

function resme()
{
   if(SelectBoxIndex('Editme')>0)
   {
    myform.action="Form_pwd.php?tag=3";
    myform.submit();   
   }
   else
       alert('Select User');
}


function direct1()
{
var i;
i=0;
}

function setMe()
{
myform.Uid.focus();
}

function redirect(i)
{
myform.action="Form_pwd.php?tag=2&ptype=1&mtype=1";
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
var a=myform.Uid.value ;// Primary Key
var a_length=parseInt(a.length);
var b=myform.Pwd.value ;
var b_length=parseInt(b.length);
var c=myform.Roll.value ;
var c_index=myform.Roll.selectedIndex;
var d=myform.Fullname.value ;
var d_length=parseInt(d.length);
var e=myform.Branch_code.value ;
var e_index=myform.Branch_code.selectedIndex;
var f=myform.Active.value ;
var f_length=parseInt(f.length);
var g=myform.Firstlogin.value ;
var g_length=parseInt(g.length);
if ( notNull(a) && validateString(a) && a_length<=20 && notNull(b)  && b_length<=20 && c_index>0  && 1==1 && validateString(d) && d_length<=50 && e_index>0  && (f=="Y" || f=="N") && (g=="Y" || g=="N") )
{
myform.action="Insert_pwd.php";
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

function home()
{
window.location="startmenu.php?tag=1";
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


//date comaprison
function CompareDate(dt1,dt2)
{
var ln;
var i;
var j;
var dd1;
var mm1;
var yyyy1;

var dd2;
var mm2;
var yyyy2;
var tag;
var date1;
var date2;

ln=parseInt(dt1.length);
i=dt1.indexOf("/");
dd1=Number(dt1.substr(0,i));
j=dt1.indexOf("/",(i+1));
mm1=Number(dt1.substr((i+1),(j-i-1)));
yyyy1=Number(dt1.substr((j+1),(ln-j-1)));

dd1= dd1+100;
mm1= mm1+100;

date1=yyyy1+"-"+mm1+"-"+dd1;

ln=parseInt(dt2.length);
i=dt2.indexOf("/");
dd2=Number(dt2.substr(0,i));
j=dt2.indexOf("/",(i+1));
mm2=Number(dt2.substr((i+1),(j-i-1)));
yyyy2=Number(dt2.substr((j+1),(ln-j-1)));

dd2= dd2+100;
mm2= mm2+100;

date2=yyyy2+"-"+mm2+"-"+dd2;

if (date1>date2)
return(1);
if (date1==date2) 
return(0);
if (date1<date2)
return(-1);
}

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once './class/utility.class.php';
require_once './class/class.pwd.php';
require_once './class/class.roll.php';
require_once './class/class.branch_section.php';
require_once './class/class.sentence.php';
require_once './class/class.Areaofwork.php';

$objSen=new Sentence();

$objArea=new Areaofwork();
$check="";
//$td="04";
//echo $td;
//echo "-";
//echo round($td);

$objUtility=new Utility();
//$date1=date('Y-m-d');
//$date2="2012-03-31";
//echo $objUtility->dateDiff($date1, $date2);

$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: Indexpage.php?tag=1');

$objPwd=new Pwd();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

echo $_tag;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>3)
$_tag=0;

$read="";

if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[7]="0";
}
else
{
$mvalue[0]="";//Uid
$mvalue[1]="";//Pwd
$mvalue[2]="-1";//Roll
$mvalue[3]="";//Fullname
$mvalue[4]="-1";//Branch_code
$mvalue[5]="";//Active
$mvalue[6]="";//Firstlogin
//$mvalue[7]="0";
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]

$areaStr="0";
if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue[0]="";//Uid
$mvalue[1]="";//Pwd
// Call $objPwd->MaxRoll() Function Here if required and Load in $mvalue[2]
$mvalue[2]="-1";//Roll
$mvalue[3]="";//Fullname
$mvalue[4]="-1";
$mvalue[5]="Y";
$mvalue[6]="Y";
$mvalue[7]="-1";//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
if ($ptype==1)  //Post back  
{
$mvalue[0]=$_POST['Uid'];
$mvalue[1]=$_POST['Pwd'];
$mvalue[2]=$_POST['Roll'];
$mvalue[3]=$_POST['Fullname'];//Fullname
$mvalue[4]=$_POST['Branch_code'];
$mvalue[5]=$_POST['Active'];
$mvalue[6]=$_POST['Firstlogin'];    
}    
    
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

if (isset($_POST['Editme']))
$mvalue[7]=$_POST['Editme']; 
else
$mvalue[7]=0; 

if (isset($_POST['Uid']))
$pkarray[0]=$_POST['Uid'];
else
$pkarray[0]=0;
$objPwd->setUid($pkarray[0]);
if ($objPwd->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objPwd->getUid();
$mvalue[1]=$objPwd->getPwd();
//$mvalue[1]=$objSen->Decrypt($mvalue[1]);
$mvalue[2]=$objPwd->getRoll();
$mvalue[3]=$objPwd->getFullname();
$mvalue[4]=$objPwd->getBranch_code();
$mvalue[5]=$objPwd->getActive();
$mvalue[6]=$objPwd->getFirstlogin();
$areaStr=$objPwd->getArea();
//$mvalue[7]="-1";//last Select Box for Editing
$read=" readonly";
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
$mvalue[4]="0";
$mvalue[5]="Y";
$mvalue[6]="Y";
$mvalue[7]="-1";//last Select Box for Editing
}//ptype=0
} //EditRecord()
//Load Area of Work
} //tag==2
if ($_SESSION['update']==1)
$read=" readonly";
else 
$read=" ";    
//Start of FormDesign

//echo $_tag;
if ($_tag==3)//Post Back 
{
//echo "Entered";
$mvalue[0]=$_POST['Uid'];
$mvalue[1]=$_POST['Pwd'];
$mvalue[2]=$_POST['Roll'];
$mvalue[3]=$_POST['Fullname'];//Fullname
$mvalue[4]=$_POST['Branch_code'];
$mvalue[5]=$_POST['Active'];
$mvalue[6]=$_POST['Firstlogin'];    

if (isset($_POST['Editme']))
$mvalue[7]=$_POST['Editme']; 
else
$mvalue[7]=0; 

$uid=$mvalue[7];
$pwd=$objSen->Encrypt("1234");
$sql="update pwd set pwd='".$pwd."' where uid='".$uid."'";
if($objPwd->ExecuteQuery($sql))
    echo $objUtility->alert ('Password reset as 1234');
//echo $sql;
//exit;
} //tag==2

?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=insert_pwd.php  method=POST >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Use Management Form<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>User ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=20 name="Uid" id="Uid" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=20 onfocus="ChangeColor('Uid',1)"  onblur="ChangeColor('Uid',2);RemoveSpace('Uid')" onchange=direct1()>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Password</font></td><td align=left bgcolor=#FFFFCC>
<input type=password size=20 name="Pwd" id="Pwd" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=20 onfocus="ChangeColor('Pwd',1)"  onblur="ChangeColor('Pwd',2)" <?php echo $read;?>>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Roll</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objRoll=new Roll();
$objRoll->setCondString("Roll>".$roll); //Change the condition for where clause accordingly
$row=$objRoll->getRow();
?>
<select name=Roll style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(3)>
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Roll'])
{
?>
<option selected value="<?php echo $row[$ind]['Roll'];?>"><?php echo $row[$ind]['Description'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Roll'];?>"><?php echo $row[$ind]['Description'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Name of User</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Fullname" id="Fullname" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Fullname',1)"  onblur="ChangeColor('Fullname',2)">
</td>
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Branch</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objBranch_section=new Branch_section();
$objBranch_section->setCondString("1=1" ); //Change the condition for where clause accordingly
$row=$objBranch_section->getRow();
?>
<select name=Branch_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(1)>
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Branch_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Branch_code'];?>"><?php echo $row[$ind]['Branch_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Branch_code'];?>"><?php echo $row[$ind]['Branch_name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=5?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Is Active User</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=1 name="Active" id="Active" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=1 onfocus="ChangeColor('Active',1)"  onblur="ChangeColor('Active',2)">
<?php $i++; //Now i=6?>
<font color=black size=2 face=arial>Is First Login</font>
<input type=text size=1 name="Firstlogin" id="Firstlogin" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=1 onfocus="ChangeColor('Firstlogin',1)"  onblur="ChangeColor('Firstlogin',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<tr><td colspan="2" align="center" bgcolor="#CC9966"><font color=blue size=2 face=arial>
<?php
//$objArea->setBranch_code($mvalue[4]);
$objArea->setCondString("Branch_code=".$mvalue[4]);
$myrow=$objArea->getRow();
for ($in=0;$in<count($myrow);$in++)
{
if ($objPwd->checkArea($areaStr,$myrow[$in]['Area_code']))
$check=" checked=check";
else
$check="";    
?>    
<input type="checkbox" name="Area<?php echo $myrow[$in]['Area_code'];?>"  <?php echo $check?>>
<?php echo $myrow[$in]['Area_name']."  "?>
<?php
}
?>
 </td></tr>
<?php $i++; //Now i=7?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=1 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Uid')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td></tr>
<tr><td align=right>
<?php 
$objPwd->setCondString("Roll>".$roll." order by Fullname" ); //Change the condition for where clause accordingly
$row=$objPwd->getRow();
//echo $mvalue[$i];
?>
<select name='Editme' id='Editme' style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:200px" onchange=LoadTextBox()>
<?php $dval="0";?>
<option selected value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Uid'])
{
?>
<option selected value="<?php echo $row[$ind]['Uid'];?>"><?php echo $row[$ind]['Fullname'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Uid'];?>"><?php echo $row[$ind]['Fullname'];
}
} //for loop
?>
</select>
</td><td align=left>
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" disabled>
<input type=button value='Reset Pssword as  1234' name=res1 onclick=resme()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" >

</tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Uid");

?>
</body>
</html>
