<html>
<head>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
//include("header.php");
?>
<script type="text/javascript" src="../validation.js"></script>
<script type="text/javascript">
<!--


function loaddetail()
{
var data="code="+document.getElementById('By_magistrate').value;
var a=0;
if(document.getElementById('run').checked==true)
a=1;
if(document.getElementById('dis').checked==true)
a=2;
if(document.getElementById('all').checked==true)
a=3;

data=data+"&no="+a;

if(SelectBoxIndex('By_magistrate')>0)
MyAjaxFunction("POST","Display.php",data,'detail',"HTML");

}

function chk(i)
{
if(i==1)
{
if(document.getElementById('run').checked==true)
{
document.getElementById('dis').checked=false;
document.getElementById('all').checked=false;
}
} //i=1

if(i==2)
{
if(document.getElementById('dis').checked==true)
{
document.getElementById('run').checked=false;
document.getElementById('all').checked=false;
}
} //i=2

if(i==3)
{
if(document.getElementById('all').checked==true)
{
document.getElementById('run').checked=false;
document.getElementById('dis').checked=false;
}
} //i=2
}



function home()
{
window.location="crpcmenu.php?tag=1";
}

//END JAVA
</script>


</head>
<body>
<?php
//Start FORMPHPBODY
require_once '../class/utility.class.php';
require_once './class/class.crpc_proceeding.php';


//$objCrpc_proceeding->returnInputBox($id, $val, $size, $maxlength, $function)
//$objCrpc_proceeding->returnButton($id, $val, $pix,$function)
//$objCrpc_proceeding->returnHiddenBox($id, $val)
//$objCrpc_proceeding->returnSelectBox($id, $query, $val, $pix, $function)
//$objCrpc_proceeding->returnDatePicker($Fld, $level)
//$objCrpc_proceeding->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

//End Function/Method Guide

//Set Select Box Property
$bcol="white";
$fcol="black";
$font="14";

//Set Table Color
$HeadColor="#CCCC99";
$BodyColor=$bcol;
$FootColor="#CCCC99";
//$BottomColor="WHITE";
$BottomColor=$bcol;



$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//header( 'Location: mainmenu.php?unauth=1');

$objCrpc_proceeding=new Crpc_proceeding();
//Start of FormDesign
?>
<form name=myform action=Form_Crpc_proceeding.php  method=POST >
<table border=0 cellpadding=2 cellspacing=0 align=center style='border-collapse: collapse;' width=90%>
<tr>
<td colspan=2 align=Center bgcolor=<?php echo $HeadColor;?>><font face=arial size=3>
Display Case Details<br></font><font face=arial color=red size=1>
</font></td>
</tr>
<tr>
<?php
$objCrpc_proceeding->bcol=$BodyColor;//Set Back Color Table Cell
$objCrpc_proceeding->TdText(3, 2,"Select Magistrate", 0, 0, 0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box

$query="Select Slno,Officer_name from officer where Slno in(select distinct magistrate_code from crpc_main)";
//genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objCrpc_proceeding->TdSelectBox(1, $bcol,"By_magistrate",0,$query, 250, "");
?>
</tr>
<tr><td colspan=2 align=center>
<input type=checkbox name=run id=run checked=checked onclick=chk(1)>
Running
<input type=checkbox name=dis id=dis onclick=chk(2)>
Disposed
<input type=checkbox name=all id=all onclick=chk(3)>
All
</td></tr>
<tr>
<td bgcolor=<?php echo $FootColor;?>>&nbsp;</td>
<td align=left bgcolor=<?php echo $FootColor;?> colspan=1>
<?php 
$objCrpc_proceeding->genHiddenBox("SaveData",0);
$objCrpc_proceeding->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);

$objCrpc_proceeding->genButton("Save", "Display",150 ,"#CCCC66","black", 10," onclick=loaddetail()");
$objCrpc_proceeding->genButton("back1","Menu",90 , "#CCCC66","black", 10," onclick=home()");
$objCrpc_proceeding->genHiddenBox("XML",0);
?>
</td></tr>
</table>
</form>
<?php
?>
<div align=center id=detail>

</div>
</body>
</html>
