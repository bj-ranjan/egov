<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script type="text/javascript" src="../validationnew.js"></script>
<script language="javascript">
<!--

function validate()
{
    
if(document.getElementById('Pet_type').selectedIndex>0)
{
document.getElementById('DivSum').innerHTML="Please Wait, Loading....";    
var data="Pet_type="+document.getElementById('Pet_type').value;
MyAjaxFunction("POST","LoadPendingPetition.php",data,"DivSum","HTML");
}
else
alert('Select Petition Type');
}//End Validate




function home()
{
window.location="mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
//document.getElementById(a).focus();
}



//Reset Form
function res()
{
window.location="Form_petition_master.php?tag=0";
}
//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_type.php';
require_once 'header.php';

$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: index.php');


//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>List of pending Petition</font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Select Petition Type
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 14px;width:250px";
$objPetition_type=new Petition_type();
$objPetition_type->setCondString("Running='Y'" ); //Change the condition for where clause accordingly
$row=$objPetition_type->getRow();
?>
<select name="Pet_type" id="Pet_type" style="<?php echo $mystyle;?>" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
$mcode=$row[$ind]['Code'];
$mdetail=$row[$ind]['Detail'];
$sel= "";
?>
<option <?php echo $sel;?> value="<?php echo $mcode;?>"><?php echo $mdetail;?>
<?php 
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
<?php 
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=button value="View Report"  name=Save onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="<?php echo $mystyle;?>">
</td></tr>
</table>
</form>
       <hr>
    <div id="DivSum">
    </div>
</body>
</html>
