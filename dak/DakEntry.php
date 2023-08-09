<html>
<head>

</head>
<fieldset name=frame style="width:100%;border-COLOR:none;height:500;" align=center>
<script type=text/javascript src="../validation.js"></script>

<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
	
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script src="../jquery-1.10.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
//alert('Document Loaded');
$("#Subject").focus();
$("#disp").hide();
$("#Priority").change(function(event){
if($("#Priority").val()==3)
$("#disp").show();
else
$("#disp").hide();
});


}); //document ready
</script>

<script  type="text/javascript">
<!--
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

function direct()
{
var a=myform.Dak_id.value ;

if ( isNaN(a)==false  && a!="" )
{
myform.action="dakentry.php?tag=2&ptype=0";
myform.submit();
}
else
alert('Invalid Data');

}
function direct1()
{
var i;
i=0;
}

function setMe()
{
myform.dak_id.focus();
}

function redirect()
{
alert('ok');
myform.action="dakentry.php?tag=1";
myform.submit();
}

function viewprint()
{
if(DateValid('Key1',1)==true)
{
url="DailyReport.php?key="+myform.Key1.value;
window.open(url,"_blank");
}
else
alert('Invalid Date');

}





function find() //Search record
{
var ok=false;
if(DateValid('Key1',0) && StringValid('Key2',0,0) && DateValid('Key3',0) && StringValid('Key4',0,0) && StringValid('Key5',0,0) && StringValid('Key6',0,0))
{
myform.action="ListDakDetail.php";
myform.submit();
}
else
{
if(StringValid('Key2',0,0)==false)
{
alert('Invalid Letter No');
document.getElementById('Key2').focus(); 
}
else if(StringValid('Key4',0,0)==false)
{
alert('Invalid Subject');
document.getElementById('Key4').focus(); 
}
else if(StringValid('Key5',0,0)==false)
{
alert('Invalid Letter Source');
document.getElementById('Key5').focus(); 
}
else if(StringValid('Key6',0,0)==false)
{
alert('Invalid Mark Branch');
document.getElementById('Key6').focus(); 
}
}

} //find



function validate()
{
//alert("0");
var a=myform.Dak_id.value ;
var b=myform.Subject.value ;
var c=myform.Recvd_from.value ;
var d=myform.Ltr_no.value ;
var e=myform.Ltr_dt.value ;
var f=myform.Ltr_format.value ;
var f_index=myform.Ltr_format.selectedIndex;
var g=myform.Priority.value ;
var g_index=myform.Priority.selectedIndex;
var h=myform.Mark_branch.value ;
var k=myform.Branch_code.selectedIndex;
//alert("1");
if ( k>0 && isNumber(a)==true && Number(a)>0 && notNull(b) && SimpleValidate(b) && SimpleValidate(c) && SimpleValidate(h) && notNull(c) && notNull(d)  && isdate(e,0)  && f_index>0  && g_index>0  && notNull(h) )
{
//alert(g);
if(g!=3)
{
myform.action="Insert_dak.php";
myform.submit();
}
else
{
var tdate=myform.Target_date.value ;
if(isdate(tdate,1))
{
myform.action="Insert_dak.php";
myform.submit();
}
else
alert('Invalid Target Data');
}//g!=3)

}//if ( isNumber(a)==true 
else
alert('Invalid Data');
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


function home()
  {
window.location="../startmenu.php";
  }

function index(i)
{
if(i>1)    
window.location="../indexpage.php";
else
window.location="../startmenu.php";    
}

function dtsrc()
 {
var n=myform.searchdt.value ;

if(isdate(n))  
{
myform.action="search2.php";
myform.submit();
}
}



function ltrdtsrc()
 {
var n=myform.searchltrdt.value ;

if(isdate(n))  
{
myform.action="search5.php";
myform.submit();
}
}



function nosrc()
 {
var p=myform.searchno.value ;
if (notNull(p))
{
myform.action="search4.php";
myform.submit();
}
else
alert('Please insert Data');
}



function subsrc()
 {
var m=myform.search.value ;
if (notNull(m))
{
myform.action="search1.php";
myform.submit();
}
else
alert('Please insert Data');
}




function mntsrc()
 {
var p_index=myform.yr.selectedIndex ;
var q_index=myform.mnth.selectedIndex ;
if (p_index>0 && q_index>0) 
{
myform.action="search3.php";
myform.submit();
}
else
alert('Please select Year and month');
}
</script>

<body>

<table align=center border=0 BORDERCOLOR=maroon width=100%>
<tr>
<TD align=center><img src="../image/header.jpg"  width="740px" height=90></TD>
</tr>
   	<tr bgcolor=blue>     
	 <td align=center><font face=verdana size=3 color=yellow><b>DAK ENTRY   &   PROCESSING </td>
	</tr>
</table> 

 <?php
 //header('Refresh: 300;url=../IndexPage.php?tag=1');
session_start();
require_once '../class/utility.class.php';
//require_once './class/class.config.php';
require_once './class/class.dak.php';
//require_once './class/class.pwd.php';
require_once '../class/class.branch_section.php';

$pvalue=array();
$objUtility=new Utility();
$objDak=new Dak_entry();



$recvyear=date('Y');

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../indexPage.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 6)==false) //2 for Bakijai Collection
header( 'Location: ../indexPage.php?unauth=1');

$_SESSION['update']=0;

$rem="";

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if($roll==0 || $roll==2)
$dis="";
else 
{    
$dis=" disabled";  
if($_tag==0)
echo $objUtility->alert("Data Entry Restricted") ;   
}

$mvalue=array();
$pkarray=array();
$curntdt=date("d/m/Y");
$cyr=date("Y");
//echo $cyr;

$_SESSION['update']=0;
$lastid="";
if ($_tag==1)//Return from Action Form
{

if(isset($_SESSION['pvalue']))
$pvalue=$_SESSION['pvalue'];
else
{
$pvalue[0]="";
$pvalue[1]="";
$pvalue[2]="";
$pvalue[3]="";
$pvalue[4]="";
$pvalue[5]="";
$pvalue[6]="";
$pvalue[7]="";
$rem="";
}


if(isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[0]=$objDak->maxDak_id();
$mvalue[8]=date('d/m/Y');
$mvalue[12]="-1";
}
else
{
$mvalue[0]=$objDak->maxDak_id();
$edt=$mvalue[0];
$mvalue[1]="";
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]="";
$mvalue[5]="";
$mvalue[6]="";
$mvalue[7]="";
$mvalue[8]=date('d/m/Y');
$mvalue[9]="";
$mvalue[10]="";
$mvalue[12]="-1";
}

if(isset($_SESSION['lastid']))
$lastid="Last Id-".$_SESSION['lastid'];
//echo "lastid=".$lastid;
}


if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$lastid="";
$rem="";
$mvalue[0]=$objDak->maxDak_id();
$edt=$mvalue[0];
//$mvalue[0]="0";
$mvalue[1]="";
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]="";
$mvalue[5]="";
$mvalue[6]="";
$mvalue[7]="";
$mvalue[8]=date('d/m/Y');
$mvalue[9]="";
$mvalue[10]="";
$mvalue[12]="-1";
//set Parameter value
$pvalue[0]="";
$pvalue[1]="";
$pvalue[2]="";
$pvalue[3]="";
$pvalue[4]="";
$pvalue[5]="";
$pvalue[6]="0";
$pvalue[7]="";
}

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
//set Parameter value
$pvalue[0]="";
$pvalue[1]="";
$pvalue[2]="";
$pvalue[3]="";
$pvalue[4]="";
$pvalue[5]="";
$pvalue[6]="";
$pvalue[7]="";
$ptype=$_GET['ptype'];

$pkarray[0]=$_POST['Dak_id'];

if(isset($_POST['Recv_yr']))
$recvyear=$_POST['Recv_yr'];

$objDak->setRecvd_yr($recvyear);
$objDak->setDak_id($pkarray[0]);

if ($objDak->EditRecord())
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objDak->getDak_id();
$mvalue[1]=$objDak->getSubject();
$mvalue[2]=$objDak->getRecvd_from();
$mvalue[3]=$objDak->getLtr_no();
$mvalue[4]=$objUtility->to_date($objDak->getLtr_dt());
//$mvalue[4]=$objDak->getLtr_dt();
$mvalue[5]=$objDak->getLtr_format();
$mvalue[6]=$objDak->getPriority();
$mvalue[7]=$objDak->getMark_branch();
$mvalue[8]=date('d/m/Y');
$mvalue[9]=$objDak->getReply();
$mvalue[10]=$objDak->getTarget_date();
$mvalue[12]=$objDak->getBranch_code();
$rem=$objDak->getRemarks();
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
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]="";
$mvalue[5]=-1;
$mvalue[6]=-1;
$mvalue[7]="";
$mvalue[8]=date('d/m/Y');
$mvalue[9]="";
$mvalue[10]="";
$mvalue[12]="-1";
}
}
} //tag==2

//echo $maxim;
//Form design*********
?>

<tr>
<td colspan=2>
<hr color="#002200">
</td>
</tr>
</table>

<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=80%>
<form name="myform" action= "Insert_dak.php"    method=post>

<?php $i=0; ?>
<tr><td colspan=2 align=center><font color=red size=3 face=arial>&nbsp;</font><b><?php echo $lastid;?></b></td></tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>New Dak ID</font></td><td align=left bgcolor=#FFFFCC>
<input type="text" name="Dak_id" value="<?php  echo  $mvalue[0];?>"  >
Receive Year
<input type="text" name="Recv_yr" value="<?php  echo  $recvyear;?>"  >
</td></tr>

<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Subject</font></td><td align=left bgcolor=#FFFFCC>
<textarea name="Subject" id="Subject" rows=3 cols=50 onfocus="ChangeColor('Subject',1)"  onblur="ChangeColor('Subject',2)">
<?php echo $mvalue[$i]; ?>
</textarea>
</td></tr>

<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Recevied From</font></td><td align=left bgcolor=#FFFFCC>
<input type="text" name="Recvd_from" id="Recvd_from"  onfocus="ChangeColor('Recvd_from',1)"  onblur="ChangeColor('Recvd_from',2)" value="<?php echo $mvalue[$i]; ?>" size="65"></td></tr>

<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Letter No.</font></td>
<td align=left bgcolor=#FFFFCC>
<input type="text" size=40 name="Ltr_no" id="Ltr_no"  onfocus="ChangeColor('Ltr_no',1)"  onblur="ChangeColor('Ltr_no',2)" value="<?php echo $mvalue[$i]; ?>" ></td></tr>

<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Letter date</font></td><td align=left bgcolor=#FFFFCC>
<input type="text" name="Ltr_dt" id="Ltr_dt"  onfocus="ChangeColor('Ltr_dt',1)"  onblur="ChangeColor('Ltr_dt',2)" value="<?php echo $mvalue[4]; ?>" size=7>
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Ltr_dt);" alt="Click Here to Pick Date">
</td></tr>
<?php $i++; //Now i=5?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Letter Format/Type</td>
<td align=left bgcolor=#FFFFCC>
<select name="Ltr_format" >
 <option  value="-" >-Select-</option>
  <option  value="Letter" >Letter</option>
  <option   value="WT" >WT</option>
  <option   value="Fax" >Fax</option>
  <option   value="Draft-Cheque" >Draft-Cheque</option>
  <option   value="Email" >Email</option>
  <option   value="Court" >Court Case</option>
 <option   value="AQ" >Assembly Question</option>
<option selected value="<?php echo $mvalue[$i];?>"><?php echo $mvalue[$i];?>
</select>
</td>
</tr>

<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFFFCC>Action Priority</td>
<td bgcolor=#FFFFCC>
<select name="Priority" id="Priority" >
  <option  value="-" >-Select Priority-</option>
  <option  value="1" >Immidiate</option>
  <option   value="2" >Urgent</option>
  <option   value="3" >Fix Date</option>
   <option   value="4" >Others</option> 
  <option   value="5" >File Only</option> 
  </select>
</tr>
<tr id="disp">
<td align=right bgcolor=#FFFFCC>To be Disposed on</td>
<td bgcolor=#FFFFCC align=left>
<input type="text" name="Target_date" id="Target_date"  value="<?php echo $mvalue[10]; ?>" size=6 >
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Target_date);" alt="Click Here to Pick Date">
</td>
</tr>

<?php $i++; //Now i=7?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Mark To Branch</font></td><td align=left bgcolor=#FFFFCC>
<input type="text" name="Mark_branch"  id="Mark_branch"  onfocus="ChangeColor('Mark_branch',1)"  onblur="ChangeColor('Mark_branch',2)" value="<?php echo $mvalue[$i]; ?>" size="45"></td></tr>
<input type="hidden" name="Entry_date"  value="<?php echo $mvalue[$i]; ?>"  readonly></td></tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Branch</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objBranch_section=new Branch_section();
$objBranch_section->setCondString("1=1 order by Branch_name" ); //Change the condition for where clause accordingly
$row=$objBranch_section->getRow();
?>
<select name=Branch_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:190px" >
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[12]==$row[$ind]['Branch_code'])
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

<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Remarks(If any)</font></td>
<td align=left bgcolor=#FFFFCC>
<input type="text" size=100 name="Remarks" id="Remarks"  onfocus="ChangeColor('Remarks',1)"  onblur="ChangeColor('Remarks',2)" value="<?php echo $rem; ?>" ></td></tr>
</tr>  


  
    
    <?php $i++; //Now i=8?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC>
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ;font-weight:bold; background-color:white;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">

<?php if($roll==0) {?>
<input type=button value=Menu  name=back1 onclick=home()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<?php }
else
{
?>
<input type=button value=Logout  name=back2 onclick=index(<?php echo $roll;?>)  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<?php }?>

</td>
</tr>



<b>
 <table width=110% align=center>
           <tr bgcolor=blue>
          <td align=center colspan=6><font face=verdana size=3 color=yellow><b>SEARCH OF DAK </td>
           </tr>
<tr><td align=center bgcolor=#66CCCC><font size=2 face=arial>Entry Date</td>
<td align=center bgcolor=#66CCCC><font size=2 face=arial>Letter No</td>
<td align=center bgcolor=#66CCCC><font size=2 face=arial>Letter Date</td>
<td align=center bgcolor=#66CCCC><font size=2 face=arial>Subject</td>
<td align=center bgcolor=#66CCCC><font size=2 face=arial>Source</td>
<td align=center bgcolor=#66CCCC><font size=2 face=arial>Marked to</td>
</tr>
<tr>
<td align=center>
<input type=text size=8 name="Key1" id="Key1" value="<?php echo $pvalue[1]; ?>" onfocus="ChangeColor('Key1',1)"  onblur="ChangeColor('Key1',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Key1);" alt="Click Here to Pick Date">
</td>
<td align=center>
<input type=text size=15 name="Key2" id="Key2" value="<?php echo $pvalue[2]; ?>" onfocus="ChangeColor('Key2',1)"  onblur="ChangeColor('Key2',2)">
</td>
<td align=center>
<input type=text size=8 name="Key3" id="Key3" value="<?php echo $pvalue[3]; ?>" onfocus="ChangeColor('Key3',1)"  onblur="ChangeColor('Key3',2)">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Key3);" alt="Click Here to Pick Date">
</td>
<td align=center>
<input type=text size=15 name="Key4" id="Key4" value="<?php echo $pvalue[4]; ?>" onfocus="ChangeColor('Key4',1)"  onblur="ChangeColor('Key4',2)">
</td>
<td align=center>
<input type=text size=10 name="Key5" id="Key5" value="<?php echo $pvalue[5]; ?>" onfocus="ChangeColor('Key5',1)"  onblur="ChangeColor('Key5',2)">
</td>
<td align=center>
<?php
$objBranch_section->setCondString(" Branch_code>0 order by Branch_name" ); //Change the condition for where clause accordingly
$row=$objBranch_section->getRow();
?>
<select name="Key6" id="Key6" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:120px" >
<?php $dval="-1";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($pvalue[6]==$row[$ind]['Branch_code'])
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
</td>
</tr>
<tr>
<td align=center rowspan=2><font face=arial size=2>
<input type=button value=View/Print  name=vp onclick=viewprint()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
</td>
<td align=right colspan=2><font face=arial size=2>
Consider All Condition
</td>
<td align=left>
<input type=checkbox name="All" checked=checked>
</td>
<?php
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:120px";
?>
<td align=left colspan=2 rowspan=2>
<input type=button value="Find Record"  name=Save onclick=find() style="<?php echo $mystyle;?>">
</td>
</tr>
<td align=right ><font face=arial size=2>
Consider Any one Condition
</td>

<td align=left colspan=5>
<input type=checkbox name="Any" >
</td>
</tr>

</table>
 <table width=100%>
           <tr bgcolor=blue>
          <td align=center><font face=verdana size=3 color=yellow><b>Designed  & Developed by National Informatics Centre ,  Nalbari </td>
           </tr>
</table>

</form>
</table>

</body>
</html>