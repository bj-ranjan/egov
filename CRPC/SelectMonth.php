<html>
<head>
<title></title>
</head>
<script type="text/javascript" src="../validation.js"></script>

<script language=javascript>
<!--
function home()
{
window.location="crpcmenu.php";
}

function enu()
{
myform.Save.disabled=false; 
}


function validate()
{
var a=myform.Yr.value ;
var a_length=parseInt(a.length);
var b_index=myform.mm.selectedIndex;

if (a!="" && a_length==4 && b_index>0 )
{
myform.Save.disabled=true; 
myform.setAttribute("target","_blank")
if(document.getElementById('pdf').checked==false)
myform.action="MonthlyReport.php";
else
myform.action="MonthlyReportPdf.php";
myform.submit();
}
else
alert('Invalid Selection');
}

</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once '../class/utility.php';
$objUtility=new Utility();
$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();
if(isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;    

if($_tag==0)
{
$mvalue[0]=date('Y');
$mvalue[1]=round(date('m'))-1;
$mvalue[2]="-";
}
if($_tag==1)
{
$mvalue=$_SESSION['mvalue'];
}

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action="MonthlyReport.php"  method="POST" >
<tr><td colspan=2 align=Center bgcolor=#ccffcc><font face=arial size=3>Monthly Report of PFC<br></font><font face=arial color=red size=2></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Enter Year</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=4 name="Yr" id="Yr" value="<?php echo $mvalue[0]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=4 onfocus="ChangeColor('Yr',1)"  onblur="ChangeColor('Yr',2)">
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=1?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Month</font></td><td align=left bgcolor=#FFFFCC>

<select name=mm id="mm" style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=enu()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=1;$ind<13;$ind++)
{
if ($mvalue[1]==$ind) 
{   
?>
<option  selected value="<?php echo $ind;?>"><?php echo $objUtil->Month($ind);?>
<?php
}
else
{    
?>
<option  value="<?php echo $ind;?>"><?php echo $objUtil->Month($ind);?>
<?php
}
} //for loop
?>
</select>
</td>
</tr>
</td></tr>
<tr><td align=right bgcolor=#FFFFCC>
<input type=checkbox name=pdf id=pdf checked=checked>PDF
</td><td align=left bgcolor=#FFFFCC>
<input type=button value="Monthly Report"  name=Save onclick=validate()  style="font-family:arial; font-size: 14px ; background-color:#CCFF66;color:blue;width:200px">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Yr')" style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">
</td></tr>
</table>
</form>

</body>
</html>
