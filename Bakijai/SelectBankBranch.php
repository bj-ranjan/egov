<html>
<head>
<title>Entry Form for bakijai_main</title>
</head>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
<!--
function direct()
{
var i;
i=0;
}

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Bank.focus();
}

function redirect(i)
{
myform.setAttribute("target","_self");
myform.action="SelectBankBranch.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{

if ( SelectBoxIndex('Bank')>0  && SelectBoxIndex('Branch')>0 )
{
myform.Save.disabled=true;
//myform.setAttribute("target","_self");//Open in Self
myform.setAttribute("target","_blank");//Open in New Window
myform.action="BankWiseList.php";
myform.submit();
}
else
{
if (SelectBoxIndex('Bank')==0)
{
alert('Select Bank');
document.getElementById('Bank').focus();
}
else if (SelectBoxIndex('Branch')==0)
{
alert('Select Branch');
document.getElementById('Branch').focus();
}
else if (NumericValid('Case_id',1)==false)
{
alert('Non Numeric Value in Case_id');
document.getElementById('Case_id').focus();
}
else 
alert('Enter Correct Data');
}
}//End Validate


function validate1()
{

if ( SelectBoxIndex('Bank')>0 )
{

myform.setAttribute("target","_blank");//Open in New Window
myform.action="BankWiseZeroList.php";
myform.submit();
}
else
{
if (SelectBoxIndex('Bank')==0)
{
alert('Select Bank');
document.getElementById('Bank').focus();
}
else if (SelectBoxIndex('Branch')==0)
{
alert('Select Branch');
document.getElementById('Branch').focus();
}
else if (NumericValid('Case_id',1)==false)
{
alert('Non Numeric Value in Case_id');
document.getElementById('Case_id').focus();
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



//Reset Form
function res()
{
window.location="Form_bakijai_main.php?tag=0";
}
//END JAVA
</script>
<script language="JavaScript" src="./datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="./datepicker/htmlDatePicker.css" rel="stylesheet"/>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.bakijai_main.php';
require_once 'header.php';
$objUtility=new Utility();
$dis=" disabled";
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
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
}
else
{
$mvalue[0]="";//Bank
$mvalue[1]="";//Branch
$mvalue[2]="0";//Case_id
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
$mvalue[0]="";//Bank
$mvalue[1]="";//Branch
// Call $objBakijai_main->MaxCase_id() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//Case_id
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

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
if (isset($_POST['Bank']))
$mvalue[0]=$_POST['Bank'];
else
$mvalue[0]=0;

if (isset($_POST['Branch']))
$mvalue[1]=$_POST['Branch'];
else
$mvalue[1]=0;

if($mtype==5)
{
$objBm=new Bakijai_main();
$cond=" Bank='".$mvalue[0]."' and Branch='".$mvalue[1]."' and disposed='N'";
if($objBm->rowCount($cond)>0)
{
$dis=" ";
echo $objUtility->alert($objBm->rowCount($cond)." Cases Running");
}
else
{
$dis=" disabled";
echo $objUtility->alert("No Cases Running");
}
}//$mtype=5

} //ptype=1

} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=50%>
<form name=myform action=insert_bakijai_main.php  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Select Bank and Branch<br></font>
<font face=arial color=red size=2><?php echo  $returnmessage; ?></font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Bank
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:190px";
$objBank_master=new Bank_master();
$objBank_master->setCondString(" Bank_name in(Select distinct Bank from Bakijai_main where disposed='N') order by Bank_name" ); //Change the condition for where clause accordingly
$row=$objBank_master->getRow();
?>
<select name="Bank" id="Bank" style="<?php echo $mystyle;?>" onchange=redirect(4)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Bank_name'];
$mdetail=$mcode;
if ($mvalue[0]==$mcode)
{
?>
<option selected value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
else
{
?>
<option  value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=1?>
<?php //row2?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Branch
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:190px";
$objBankbranch=new Bankbranch();
$objBankbranch->setCondString(" Bank='".$mvalue[0]."' order by Branch" ); //Change the condition for where clause accordingly
$row=$objBankbranch->getRow();
?>
<select name="Branch" id="Branch" style="<?php echo $mystyle;?>" onchange=redirect(5)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Branch'];
$mdetail=$row[$ind]['Branch'];
if ($mvalue[1]==$mcode)
{
?>
<option selected value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
else
{
?>
<option  value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=2?>
<?php //row3?>
<?php $i++; //Now i=3?>
<tr>
<td align=right bgcolor=#FFFFCC>
<?php
$mystyle="font-family: Arial;background-color:grey;color:black;font-size: 14px;width:120px";
?>
<input type=button value="Zero Collection"  name=Save1 onclick=validate1() style="<?php echo $mystyle;?>" >
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=hidden size=8 name=Pdate id=Pdate value="<?php echo $present_date; ?>">
<input type=button value="List Case"  name=Save onclick=validate() style="<?php echo $mystyle;?>" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Bank')" style="<?php echo $mystyle;?>">
</td></tr>
</table>
</form>
<?php
if($mtype==0)
echo $objUtility->focus("Bank");

if($mtype==4)//Postback from Bank
echo $objUtility->focus("Branch");

if($mtype==5)//Postback from Branch
echo $objUtility->focus("Case_id");

if($mtype==6)//Postback from Case_id
echo $objUtility->focus("Bank");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);
?>
</body>
</html>
