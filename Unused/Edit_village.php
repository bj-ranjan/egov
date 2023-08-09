<html>
<head>
<title>Edit Form forvillage</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<BODY>
<script language=javascript>
<!--
</script>
<body onload=setMe()>
<?php
session_start();
require_once './class/class.village.php';
require_once './class/utility.class.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objVillage=new Village();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_village.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "<input type=submit value=GO >";
echo "<input type=button value=Menu name=back1 id=back2 onclick=home()>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
} //$code=0
if ($code==1) //Next Loading aftre postback
{
$sql="";$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_village.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Vill_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Vill_name
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Cir_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Vill_name_ass
</td>
</tr>
<?php
$rowcount=0;
$objVillage->setCondString($sql);
$row=$objVillage->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Vill_code="Vill_code".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Vill_code;?>" size=5    value="<?php echo $row[$ii]['Vill_code'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Vill_code;?>  value="<?php echo $row[$ii]['Vill_code'];?>">
</td>
<?php  $Vill_name="Vill_name".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Vill_name;?>" size=30    value="<?php echo $row[$ii]['Vill_name'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Vill_name;?>  value="<?php echo $row[$ii]['Vill_name'];?>">
</td>
<?php  $Cir_code="Cir_code".$rowcount; ?>
<td align=center>
<select name="<?php echo $Cir_code;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objCircle= new Circle();
$row1=$objCircle->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Cir_code']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Cir_code;?>   value="<?php echo $row[$ii]['Cir_code'];?>">
</td>
<?php  $Vill_name_ass="Vill_name_ass".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Vill_name_ass;?>" size=30    value="<?php echo $row[$ii]['Vill_name_ass'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px">
<input type=hidden name=Old_<?php echo $Vill_name_ass;?>  value="<?php echo $row[$ii]['Vill_name_ass'];?>">
</td>
</tr>
<?php
} //while
$_SESSION['rowcount']=$rowcount;
?>
<tr><td align=right bgcolor=#FFFFCC>
</td><td align=left bgcolor=#FFFFCC>
<input type=submit value=Update  name=Save1>
<input type=button value=Menu name=back1 id=back2 onclick=home()>
</td></tr>
</table>
<?php
}//$code==1
if ($code==2) //PostBack Submit
{
//echo $_SESSION['rowcount'];
for ($ind=1;$ind<=$_SESSION['rowcount'];$ind++)
{
$sql="update village set ";
$updcount=0;
$oldVill_code="Old_Vill_code".$ind;
$Vill_code="Vill_code".$ind;

$Vill_code=$_POST[$Vill_code];
$oldVill_code=$_POST[$oldVill_code];

if ($objUtility->validate($Vill_code))
{
if ($oldVill_code!=$Vill_code)
{
$sql=$sql."Vill_code='".$Vill_code."',";
$updcount++;
}
}
$oldVill_name="Old_Vill_name".$ind;
$Vill_name="Vill_name".$ind;

$Vill_name=$_POST[$Vill_name];
$oldVill_name=$_POST[$oldVill_name];

if ($objUtility->validate($Vill_name))
{
if ($oldVill_name!=$Vill_name)
{
$sql=$sql."Vill_name='".$Vill_name."',";
$updcount++;
}
}
$oldCir_code="Old_Cir_code".$ind;
$Cir_code="Cir_code".$ind;

$Cir_code=$_POST[$Cir_code];
$oldCir_code=$_POST[$oldCir_code];

if ($objUtility->validate($Cir_code))
{
if ($oldCir_code!=$Cir_code)
{
$sql=$sql."Cir_code='".$Cir_code."',";
$updcount++;
}
}
$oldVill_name_ass="Old_Vill_name_ass".$ind;
$Vill_name_ass="Vill_name_ass".$ind;

$Vill_name_ass=$_POST[$Vill_name_ass];
$oldVill_name_ass=$_POST[$oldVill_name_ass];

if ($objUtility->validate($Vill_name_ass))
{
if ($oldVill_name_ass!=$Vill_name_ass)
{
$sql=$sql."Vill_name_ass='".$Vill_name_ass."',";
$updcount++;
}
}
if ($updcount>0)
{
$res=$objVillage->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("village",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_village.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
