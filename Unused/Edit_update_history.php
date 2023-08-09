<html>
<head>
<title>Edit Form forupdate_history</title>
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
require_once './class/class.update_history.php';
require_once './class/utility.class.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objUpdate_history=new Update_history();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_update_history.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Case_id";
echo "<select name=cond1>";
echo "<option  value=".chr(34).$condition[1].chr(34).">=";
echo "<option  value=".chr(34).$condition[2].chr(34)."><";
echo "<option  value=".chr(34).$condition[3].chr(34).">>";
echo "</select>";
echo "<input type=text size=9 name=mval1>";
echo "</td>";
echo "<td align=center>";
echo "Rsl";
echo "<select name=cond2>";
echo "<option  value=".chr(34).$condition[1].chr(34).">=";
echo "<option  value=".chr(34).$condition[2].chr(34)."><";
echo "<option  value=".chr(34).$condition[3].chr(34).">>";
echo "</select>";
echo "<input type=text size=9 name=mval2>";
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
$sql=$sql."Case_id".$_POST['cond1']."'".$_POST['mval1']."' and ";
if (strlen($_POST['mval2'])>0)
$sql=$sql."Rsl".$_POST['cond2']."'".$_POST['mval2']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_update_history.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_id
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Rsl
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Detail
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
User_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Entry_date
</td>
</tr>
<?php
$rowcount=0;
$objUpdate_history->setCondString($sql);
$row=$objUpdate_history->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Case_id="Case_id".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Case_id;?>" size=5    value="<?php echo $row[$ii]['Case_id'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Case_id;?>  value="<?php echo $row[$ii]['Case_id'];?>">
</td>
<?php  $Rsl="Rsl".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Rsl;?>" size=5    value="<?php echo $row[$ii]['Rsl'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Rsl;?>  value="<?php echo $row[$ii]['Rsl'];?>">
</td>
<?php  $Detail="Detail".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Detail;?>" size=30    value="<?php echo $row[$ii]['Detail'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Detail;?>  value="<?php echo $row[$ii]['Detail'];?>">
</td>
<?php  $User_code="User_code".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $User_code;?>" size=30    value="<?php echo $row[$ii]['User_code'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $User_code;?>  value="<?php echo $row[$ii]['User_code'];?>">
</td>
<?php  $Entry_date="Entry_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Entry_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Entry_date']);?>">
<input type=hidden name=Old_<?php echo $Entry_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Entry_date']);?>">
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
$sql="update update_history set ";
$updcount=0;
$oldDetail="Old_Detail".$ind;
$Detail="Detail".$ind;

$Detail=$_POST[$Detail];
$oldDetail=$_POST[$oldDetail];

if ($objUtility->validate($Detail))
{
if ($oldDetail!=$Detail)
{
$sql=$sql."Detail='".$Detail."',";
$updcount++;
}
}
$oldUser_code="Old_User_code".$ind;
$User_code="User_code".$ind;

$User_code=$_POST[$User_code];
$oldUser_code=$_POST[$oldUser_code];

if ($objUtility->validate($User_code))
{
if ($oldUser_code!=$User_code)
{
$sql=$sql."User_code='".$User_code."',";
$updcount++;
}
}
$oldEntry_date="Old_Entry_date".$ind;
$Entry_date="Entry_date".$ind;

$Entry_date=$objUtility->to_mysqldate($_POST[$Entry_date]);
$oldEntry_date=$objUtility->to_mysqldate($_POST[$oldEntry_date]);

if ($objUtility->validate($Entry_date))
{
if ($oldEntry_date!=$Entry_date)
{
$sql=$sql."Entry_date='".$Entry_date."',";
$updcount++;
}
}
$oldCase_id="Old_Case_id".$ind;
$Case_id=$_POST[$oldCase_id];
$sql=$sql."Case_id='".$Case_id."'";
$sql=$sql." where ";
$oldCase_id="Old_Case_id".$ind;
$oldCase_id=$_POST[$oldCase_id];
$sql=$sql."Case_id='".$oldCase_id."'";
$sql=$sql." and ";
$oldRsl="Old_Rsl".$ind;
$oldRsl=$_POST[$oldRsl];
$sql=$sql."Rsl='".$oldRsl."'";
if ($updcount>0)
{
$res=$objUpdate_history->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("update_history",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_update_history.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
