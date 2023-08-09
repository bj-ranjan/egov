<html>
<head>
<title>Edit Form forpolice_station</title>
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
require_once './class/class.police_station.php';
require_once './class/utility.class.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objPolice_station=new Police_station();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_police_station.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Code";
echo "<select name=cond1>";
echo "<option  value=".chr(34).$condition[1].chr(34).">=";
echo "<option  value=".chr(34).$condition[2].chr(34)."><";
echo "<option  value=".chr(34).$condition[3].chr(34).">>";
echo "</select>";
echo "<input type=text size=9 name=mval1>";
echo "</td>";
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
$sql="";if (strlen($_POST['mval1'])>0)
$sql=$sql."Code".$_POST['cond1']."'".$_POST['mval1']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_police_station.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Name
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Name_ass
</td>
</tr>
<?php
$rowcount=0;
$objPolice_station->setCondString($sql);
$row=$objPolice_station->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Code="Code".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Code;?>" size=5    value="<?php echo $row[$ii]['Code'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Code;?>  value="<?php echo $row[$ii]['Code'];?>">
</td>
<?php  $Name="Name".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Name;?>" size=30    value="<?php echo $row[$ii]['Name'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Name;?>  value="<?php echo $row[$ii]['Name'];?>">
</td>
<?php  $Name_ass="Name_ass".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Name_ass;?>" size=30    value="<?php echo $row[$ii]['Name_ass'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px">
<input type=hidden name=Old_<?php echo $Name_ass;?>  value="<?php echo $row[$ii]['Name_ass'];?>">
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
$sql="update police_station set ";
$updcount=0;
$oldName="Old_Name".$ind;
$Name="Name".$ind;

$Name=$_POST[$Name];
$oldName=$_POST[$oldName];

if ($objUtility->validate($Name))
{
if ($oldName!=$Name)
{
$sql=$sql."Name='".$Name."',";
$updcount++;
}
}
$oldName_ass="Old_Name_ass".$ind;
$Name_ass="Name_ass".$ind;

$Name_ass=$_POST[$Name_ass];
$oldName_ass=$_POST[$oldName_ass];

if ($objUtility->validate($Name_ass))
{
if ($oldName_ass!=$Name_ass)
{
$sql=$sql."Name_ass='".$Name_ass."',";
$updcount++;
}
}
$oldCode="Old_Code".$ind;
$Code=$_POST[$oldCode];
$sql=$sql."Code='".$Code."'";
$sql=$sql." where ";
$oldCode="Old_Code".$ind;
$oldCode=$_POST[$oldCode];
$sql=$sql."Code='".$oldCode."'";
if ($updcount>0)
{
$res=$objPolice_station->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("police_station",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_police_station.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
