<html>
<head>
<title>Edit Form forbakijai_main</title>
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
<p align=center>
<?php
session_start();
require_once './class/class.bakijai_main.php';
require_once '../class/utility.class.php';
require_once './class/class.circle.php';
$objUtility=new Utility();
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

$objBakijai_main=new Bakijai_main();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=EditCase.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Case_id";
echo "<select name=cond1>";
echo "<option  value=".chr(34).$condition[1].chr(34).">=";
echo "<option  value=".chr(34).$condition[2].chr(34)."><";
echo "<option  value=".chr(34).$condition[3].chr(34).">>";
echo "</select>";
echo "<input type=text size=9 name=mval1 readonly>";
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
$sql=$sql." Court_Case='Y'";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=EditCase.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Case_id
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Fin_yr
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Circle
</td>
</tr>
<?php
$rowcount=0;
$objBakijai_main->setCondString($sql);
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Case_id="Case_id".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Case_id;?>" size=5    value="<?php echo $row[$ii]['Case_id'];?>" style="font-family: Arial;background-color:#FFCC99;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Case_id;?>  value="<?php echo $row[$ii]['Case_id'];?>">
</td>
<?php  $Fin_yr="Fin_yr".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Fin_yr;?>" size=30    value="<?php echo $row[$ii]['Fin_yr'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Fin_yr;?>  value="<?php echo $row[$ii]['Fin_yr'];?>">
</td>
<?php  $Circle="Circle".$rowcount; ?>
<td align=center>
<select name="<?php echo $Circle;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objCircle= new Circle();
$row1=$objCircle->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Circle']==$row1[$jj]['Cir_code'])
echo "<option  selected value=".chr(34).$row1[$jj]['Cir_code'].chr(34).">".$row1[$jj]['Circle'];
else
echo "<option  value=".chr(34).$row1[$jj]['Cir_code'].chr(34).">".$row1[$jj]['Circle'];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Circle;?>   value="<?php echo $row[$ii]['Circle'];?>">
</td>
</tr>
<?php
} //while
$_SESSION['rowcount']=$rowcount;
?>
<tr><td align=right bgcolor=#FFFFCC>
</td><td align=left bgcolor=#FFFFCC>
<input type=submit value=Update  name=Save1 
 style="font-family: Arial;background-color:orange;color:black;font-size: 14px;width:150px"><input type=button value=Menu name=back1 id=back2 onclick=home()>
</td></tr>
</table>
<?php
}//$code==1


if ($code==2) //PostBack Submit
{
//echo $_SESSION['rowcount'];
for ($ind=1;$ind<=$_SESSION['rowcount'];$ind++)
{
$sql="update bakijai_main set ";
$updcount=0;
$oldFin_yr="Old_Fin_yr".$ind;
$Fin_yr="Fin_yr".$ind;

$Fin_yr=$_POST[$Fin_yr];
$oldFin_yr=$_POST[$oldFin_yr];

if ($objUtility->validate($Fin_yr))
{
if ($oldFin_yr!=$Fin_yr)
{
$sql=$sql."Fin_yr='".$Fin_yr."',";
$updcount++;
}
}
$oldCircle="Old_Circle".$ind;
$Circle="Circle".$ind;

$Circle=$_POST[$Circle];
$oldCircle=$_POST[$oldCircle];

if ($objUtility->validate($Circle))
{
if ($oldCircle!=$Circle)
{
$sql=$sql."Circle='".$Circle."',";
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
if ($updcount>0)
{
$res=$objBakijai_main->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("bakijai_main",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=EditCase.php?tag=0>Back</a>";
}//code=2
?>
</p>
</form>
</body>
</html>
