<html>
<head>
<title>Reminder</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
<!--
function direct()
{
var a=myform.Cir_code.value ;//Primary Key
if (nonZero(a))
{
myform.action="Listcase.php?tag=2&ptype=0";
myform.submit();
}
}


function setMe()
{
myform.Cir_code.focus();
}

function redirect(i)
{
}


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
function res()
{
window.location="Form_circle.php?tag=0";
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.hc_casemaster.php';
require_once './class/class.hc_department.php';
require_once './class/class.hc_casetransaction.php';
require_once './class/class.hc_branch.php';

$objUtility=new Utility();
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 17)==false) //16 for Bakijai Interest Collection
header( 'Location: Mainmenu.php?unauth=1');


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


if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
// Call $objCircle->MaxCir_code() Function Here if required and Load in $mvalue[0]
$mvalue[0]="7";//Cir_code
$mvalue[2]=0;//last Select Box for Editing
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

if (isset($_POST['Cir_code']))
$mvalue[0]=$_POST['Cir_code'];
else
$mvalue[0]=0;
} //tag==2

//Start of FormDesign
?>

<?php
if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>

<?php
$objHc_casemaster=new Hc_casemaster();
$fromdate=$objUtility->datePlus(date('Y-m-d'),$mvalue[0]);
$cond=" Due_dateparawise<='".$fromdate."' ORDER BY Due_dateparawise";
$objHc_casemaster->setCondString($cond);
$row=$objHc_casemaster->getAllRecord();
//echo "After Plus".$fromdate;
//echo "<br>After Minus".$objUtility->to_date($objUtility->dateMinus(date('Y-m-d'),$mvalue[0]));
//echo "<br>After Plus".$objUtility->to_date($objUtility->datePlus(date('Y-m-d'),$mvalue[0]));

?>
<form name=myform action=insert_circle.php  method=POST >
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<tr>
<td align=center bgcolor="#3399CC">    
<?php 
$mystyle="font-family:arial; font-size: 12px ;font-weight:bold; background-color:yellow;color:black;width:70px";
?>
<input type=button value=Back  name=res1 onclick=home() style="<?php echo $mystyle;?>"
</td>         
<td align=center colspan="5" bgcolor="#3399CC"><font color=black size=2 face=arial>    
<font face=arial size=2><B>PARAWISE COMMENT SUBMISSION DATE IS WITHIN NEXT &nbsp;
<input type=text size=2 name="Cir_code" id="Cir_code" value="<?php echo $mvalue[0]; ?>" onfocus="ChangeColor('Cir_code',1)"  onblur="ChangeColor('Cir_code',2)" onchange=direct()>
DAYS 
</td>        
</tr>       
<tr>
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
 Serial No
</td> 
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
Case No
</td> 
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
Department
</td> 
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
Branch
</td> 
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
Present Status
</td> 
<td align=center bgcolor="#3399CC"><font color=black size=2 face=arial>    
Due Date
</td>
</tr>
<?php
  
for($ii=0;$ii<count($row);$ii++)
{
$duedate=$row[$ii]['Due_dateparawise'];
if ($duedate<date('Y-m-d'))  
$bgcolor="grey";
else
$bgcolor="white"    
?>
<tr>
<td align=center bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=left bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$tvalue=$row[$ii]['Case_no'];
echo $tvalue;
?>
</td>
<td align=left bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$objHc_department=new Hc_department();
$objHc_department->setCode($row[$ii]['Dep_code']);
$objHc_department->editRecord();
$tvalue=$objHc_department->getName();
echo $tvalue;
?>
</td>
<td align=left bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$objHc_branch=new Hc_branch();
$objHc_branch->setCode($row[$ii]['Branch_code']);
$objHc_branch->editRecord();
$tvalue=$objHc_branch->getName();
echo $tvalue;
?>
</td>
<td align=left bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$tvalue=$row[$ii]['Present_status'];
echo $tvalue;
?>
</td>
<td align=center bgcolor="<?php echo $bgcolor;?>"><font color=black size=2 face=arial>
<?php
$tvalue=$objUtility->to_date($duedate);
echo $tvalue;
?>
</td>
</tr>
<?php
}
?>
</table>
</form>
    
</body>
</html>
