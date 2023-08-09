<html>
<head>
<title>Entry Form for petition_master</title>
</head>
<script type="text/javascript" src="../validationnew.js"></script>
<script language="javascript">
<!--

function validate()
{
    
if(checkName('Pname') && notNull(document.getElementById('Pname').value))
{
document.getElementById('DivSum').innerHTML="Please Wait, Loading....";    
var data="Pname="+document.getElementById('Pname').value;
MyAjaxFunction("POST","LoadPetitioner.php",data,"DivSum","HTML");
}
else
alert('Enter Name');
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

require_once 'header.php';


//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<tr>
<td colspan=2 align=Center bgcolor=#66CC66>
<font face=arial size=3>Search Petition</font>
</td>
</tr>
<?php $i=0; ?>
<?php //row1?>
<tr>
<td align=right bgcolor=#FFFFCC>
<font color=black size=2 face=arial>
Enter Petitioner Name(At least 3 character)
</font>
</td>
<td align=left bgcolor=#FFFFCC>
<?php 
$mystyle="font-family: Arial;background-color:white;color:black;font-size: 12px;width:100px";
?>
<input type="text" size="8" maxlength="7" name="Pname" id="Pname" style="<?php echo $mystyle;?>" >
<font color=red size=3 face=arial>*</font>
<?php 
$mystyle="font-family:arial; font-size: 12px ;font-weight:bold; background-color:orange;color:black;width:100px";
?>
<input type=button value="Search"  name=Save onclick=validate() style="<?php echo $mystyle;?>">
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Pet_yr')" style="<?php echo $mystyle;?>">
</td></tr>
</table>
</form>
       <hr>
    <div id="DivSum">
    </div>
</body>
</html>
