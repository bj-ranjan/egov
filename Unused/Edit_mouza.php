<html>
<head>
<title>Edit Form formouza</title>
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
require_once './class/class.mouza.php';
require_once './class/utility.class.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objMouza=new Mouza();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_mouza.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Mouza_code";
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
$sql=$sql."Mouza_code".$_POST['cond1']."'".$_POST['mval1']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_mouza.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Mouza_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Mouza_name
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Mouza_name_ass
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Cir_code
</td>
</tr>
<?php
$rowcount=0;
$objMouza->setCondString($sql);
$row=$objMouza->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Mouza_code="Mouza_code".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Mouza_code;?>" size=5    value="<?php echo $row[$ii]['Mouza_code'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Mouza_code;?>  value="<?php echo $row[$ii]['Mouza_code'];?>">
</td>
<?php  $Mouza_name="Mouza_name".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Mouza_name;?>" size=30    value="<?php echo $row[$ii]['Mouza_name'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Mouza_name;?>  value="<?php echo $row[$ii]['Mouza_name'];?>">
</td>
<?php  $Mouza_name_ass="Mouza_name_ass".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Mouza_name_ass;?>" size=30    value="<?php echo $row[$ii]['Mouza_name_ass'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px">
<input type=hidden name=Old_<?php echo $Mouza_name_ass;?>  value="<?php echo $row[$ii]['Mouza_name_ass'];?>">
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
$sql="update mouza set ";
$updcount=0;
$oldMouza_name="Old_Mouza_name".$ind;
$Mouza_name="Mouza_name".$ind;

$Mouza_name=$_POST[$Mouza_name];
$oldMouza_name=$_POST[$oldMouza_name];

if ($objUtility->validate($Mouza_name))
{
if ($oldMouza_name!=$Mouza_name)
{
$sql=$sql."Mouza_name='".$Mouza_name."',";
$updcount++;
}
}
$oldMouza_name_ass="Old_Mouza_name_ass".$ind;
$Mouza_name_ass="Mouza_name_ass".$ind;

$Mouza_name_ass=$_POST[$Mouza_name_ass];
$oldMouza_name_ass=$_POST[$oldMouza_name_ass];

if ($objUtility->validate($Mouza_name_ass))
{
if ($oldMouza_name_ass!=$Mouza_name_ass)
{
$sql=$sql."Mouza_name_ass='".$Mouza_name_ass."',";
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
$oldMouza_code="Old_Mouza_code".$ind;
$Mouza_code=$_POST[$oldMouza_code];
$sql=$sql."Mouza_code='".$Mouza_code."'";
$sql=$sql." where ";
$oldMouza_code="Old_Mouza_code".$ind;
$oldMouza_code=$_POST[$oldMouza_code];
$sql=$sql."Mouza_code='".$oldMouza_code."'";
if ($updcount>0)
{
$res=$objMouza->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("mouza",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_mouza.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
