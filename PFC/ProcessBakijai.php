<html>
<head>
<title>Bakijai Petition</title>
</head>
<script type="text/javascript" src="../validation.js"></script>
<script language=javascript>
<!--
function enu()
{
if(document.getElementById('Nocase').checked==true)
{
document.getElementById('CaseId').value=0;
document.getElementById('CaseId').disabled=true;
document.getElementById('Pr').disabled=false;
}  
}//enu

function Verify()
{
var data="id="+document.getElementById('CaseId').value;
//alert(data);
MyAjaxFunction("POST","getBakijaiData.php?type=1",data,'DivName',"HTML");
MyAjaxFunction("POST","getBakijaiData.php?type=2",data,'MsgBtn',"HTML");
}


function direct()
{
var i;
i=0;
}

function PrintC()
{
var a_index=myform.Pet_yr.selectedIndex;
var b_index=myform.Pet_no.selectedIndex;
if(a_index>0 && b_index>0)    
{
document.getElementById('Pr').disabled=true;
myform.Save.disabled=false;   
myform.setAttribute("target", "_blank");
myform.action="Bakijai.php";
myform.submit();
} //if
else
alert('Select petition No');
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
myform.setAttribute("target", "_self");
myform.action="ProcessBakijai.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";

var a_index=myform.Pet_yr.selectedIndex;
var b_index=myform.Pet_no.selectedIndex;
var c_index=myform.O_code.selectedIndex;

//var d=myform.Fees.value;
//alert(isNumber(d));

if (a_index>0  && b_index>0  && c_index>0 )
{
myform.setAttribute("target", "_self");
myform.action="ProcessBakijai.php?tag=3";
myform.submit();
}
else
alert('Invalid Data');
}

function home()
{
window.location="../BAKIJAI/mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
}

//change color on focus to Box(a)
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
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once '../class/class.officer.php';
require_once './class/class.petition_type.php';
require_once 'header.php';

$objUtility=new Utility();

$Fees=0;
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 3)==false) //3 for Bakijai Certificate 
header( 'Location: ../bakijai/Mainmenu.php?unauth=1');

$dis= " disabled ";
$objPm=new Petition_master();
$offname="";
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>3)
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

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="";//Pet_yr
$mvalue[1]="0";//Pet_no
$mvalue[2]="0";//O_code
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
$mvalue[0]="";//Pet_yr
// Call $objPm->MaxPet_no() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Pet_no
// Call $objPm->MaxO_code() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//O_code
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
if (isset($_POST['Pet_yr']))
$mvalue[0]=$_POST['Pet_yr'];
else
$mvalue[0]=0;

if (isset($_POST['Pet_no']))
$mvalue[1]=$_POST['Pet_no'];
else
$mvalue[1]=0;

if (!is_numeric($mvalue[1]))
$mvalue[1]=-1;
if (isset($_POST['O_code']))
$mvalue[2]=$_POST['O_code'];
else
$mvalue[2]=0;

if (!is_numeric($mvalue[2]))
$mvalue[2]=-1;
} //ptype=1

//FEES
$Fees=0;
} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<tr><td colspan=2 align=Center bgcolor=#6699CC><font face=arial size=3>PROCESS BAKIJAI PETITION<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Year</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$row=$objPm->getYearList();
?>
<select name=Pet_yr style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px" onchange=redirect(1)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[0]==$row[$ind])
{
?>
<option selected value="<?php echo $row[$ind];?>"><?php echo $row[$ind];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind];?>"><?php echo $row[$ind];
}
} //for loop
?>
</select>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Petition No</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objPm->setCondString(" Ast='N' and pet_type='BK' and status='Pending' and Pet_yr='".$mvalue[0]."' order by Pet_no desc" ); //Change the condition for where clause accordingly
$row=$objPm->getRow();
?>
<select name=Pet_no style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:200px" onchange=redirect(2)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$PETNUMBER=$row[$ind]['Xid'];
if (strlen($PETNUMBER)<2)
$PETNUMBER=$row[$ind]['Pet_no'];    
if ($mvalue[1]==$row[$ind]['Pet_no'])
{
?>
<option selected value="<?php echo $row[$ind]['Pet_no'];?>"><?php echo $PETNUMBER;?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Pet_no'];?>"><?php echo $PETNUMBER;
}
} //for loop
?>
</select>
<font color=red size=4 face=arial><b>*</b></font>
</td>
</tr>
<?php //Dwetail table>?>
<tr><td colspan="2" bgcolor="#CCFFFF">
<?php
if($_tag==2 && $mtype==2) //Postback on Petition No
{
if (isset($_POST['Pet_yr']))
$pkarray[0]=$_POST['Pet_yr'];
else
$pkarray[0]=0;

if (isset($_POST['Pet_no']))
$pkarray[1]=$_POST['Pet_no'];
else
$pkarray[1]=0;

$objPm->setPet_yr($pkarray[0]);
$objPm->setPet_no($pkarray[1]);

$mvalue[0]=$pkarray[0];//Pet_yr
$mvalue[1]=$pkarray[1];
//$mvalue[2]=$_POST['O_code'];
//$_SESSION['mvalue']=$mvalue;
if ($objPm->EditRecord()) //i.e Data Available
{
$dis= " ";    
$_SESSION['Applicant']=$objPm->getApplicant();    
$objPt=new Petition_type();
$objPt->setCode($objPm->getPet_type());
if($objPt->EditRecord())
{
$cert=$objPt->getAbvr();
$Fees=$objPt->getFees();
if ($Fees==0) //Set by Processor Assistant like Jambandi
$Fees=$objPm->getFees ();
}
else
$cert="";    
$by="";
$eby=" By  ".$objPm->getEntered_by();

if ($objPm->getAst()=="Y")
$by=" By ".$objPm->getProcessed_by();

//if ($objPm->getBo()=="Y")
//$by=$by." and BO [".$objPm->getBo_name()."]";

if ($objPm->getStatus()=="Issued")
$status="Issued on ".$objUtility->to_date ($objPm->getIssue_date());    
else
$status=$objPm->getStatus();  

if ($objPm->getBo()=="Y")
$offname=$objPm->getBo_name();
else
$offname="";    
?>
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<tr><td colspan=2 align=Center bgcolor=#CCFF99><font face=arial size=2>DETAIL OF PETITION </font></td></tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Name of Applicant</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPm->getApplicant();?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Certificate Type</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $cert;?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Forwarded on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objUtility->to_date($objPm->getPet_date()).$eby;?></font></td>
</tr> 
<tr>
<td width="30%" align=right><font face=arial size=2>Village</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPm->getVillage() ;?></font></td>
</tr>    
 
    </table>    
   
       
<?php
}//EDITRECORD
}//$_tag==2 && mtype==2
        
?>      
</td></tr>
  
<?php $i++; //Now i=2?>


<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Bakijai Case ID</td><td align=left bgcolor=#FFFFCC>
<input type=text size="14" name=CaseId id="CaseId" style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:white;color:black;" onchange="Verify()" >
<input type="checkbox" name="Nocase" id="Nocase" onclick="enu()" <?php echo $dis;?>>
No Bakijai Case
</td></tr>
<tr><td align="right"><font color=black size=2 face=arial>Verify Defaulter Name</td><td align="left"><font color=blue size=2 face=arial><b>

<div id="DivName">
</div>
</td></tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial></td><td align=left bgcolor=#FFFFCC><font color=red size=2 face=arial>
<div id="MsgBtn">
<input type=button value="Print Certificate"  name=Pr id="Pr" onclick=PrintC()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#6699FF;color:blue;width:130px" disabled>
</div>
</td></tr>
<?php $i++; //Now i=3?>

<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Signed by Officer(BO)</font></td><td align=left bgcolor=#FFFFCC>
<?php 
if (strlen($offname)==0)
{
$objOfficer=new Officer();
$objOfficer->setCondString(" exist=true order by Officer_name" ); //Change the condition for where clause accordingly
$row=$objOfficer->getRow();
?>
<select name=O_code style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:200px">
<?php $dval="";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{?>
<option  value="<?php echo $row[$ind]['Slno'];?>"><?php echo $row[$ind]['Officer_name'].",".$row[$ind]['Designation'];?>
<?php
} //for loop
?>
</select>
<?php
}
else //use Textbox
{
?>
<input type=text size=25 name="O_code" id="O_code" value="<?php echo $offname; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px;font-weight:bold" disabled>
<?php
}
?>
</td>
</tr>
<tr><td align=center bgcolor=#FFFFCC>
<input type=button value=Menu  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">
</td><td align=left bgcolor=#FFFFCC>

<input type=button value="Update Data"  name=Save onclick=validate()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#CC66FF;color:blue;width:100px" disabled>

</td></tr>
</table>
</form>
<?php
//POSTBACK

if($_tag==3) //Click on Update button
{
if (isset($_SESSION['username']))
$username=$_SESSION['username'];
else 
$username="";

$mvalue=array();
if (isset($_POST['Pet_yr']))
$a=$_POST['Pet_yr'];
else
$a=0;
$mvalue[0]=$a;

if (isset($_POST['Pet_no']))
$b=$_POST['Pet_no'];
else
$b=0;
$mvalue[1]=$b;

if (isset($_POST['O_code']))
$ocode=$_POST['O_code'];
else
$ocode=0;
$mvalue[2]=$ocode;

if (isset($_POST['Fees']))
$fees=$_POST['Fees'];
else
$fees=0;

if (isset($_POST['CaseId']))
$CaseId=$_POST['CaseId'];
else
$CaseId=0;

if($fees<=0)
header('Location:ProcessBakijai.php?tag=1');

$_SESSION['mvalue']=$mvalue;

$objPm=new Petition_master();
$objPm->setPet_yr($a);
$objPm->setPet_no($b);
//$objPm->setFees($fees);
$objPm->setBakijai_CaseId($CaseId);


$objO=new Officer();
$objO->setSlno($ocode);

if ($objO->EditRecord())
$objPm->setBo_name($objO->getOfficer_name());
$objPm->setAst("Y");
$objPm->setBo("Y");
$objPm->setStatus("Issued");
$objPm->setProcess_date(date('Y-m-d'));
$objPm->setIssue_date(date('Y-m-d'));
$objPm->setProcessed_by($username);

if ($objPm->UpdateRecord()) //Success in Petition MAster
{   
$sql1=$objPm->returnSql;    
//$objUtility->saveSqlLog("Petition_master", $sql1);
$objUtility->CreateLogFile("Petition_master", $sql1, 2, "M");

$objUtility->Backup2Access("", $sql1);
header('Location:ProcessBakijai.php?tag=1&mtype=100');
}//$objPm->UpdateRecord  
}


if($mtype==100)//Postback from Pet_no
echo $objUtility->alert("Updated Certificate details");
    
    
?>
</body>
</html>
