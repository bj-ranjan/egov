<html>
<head>
<title>Edit Form forbakijai_casedate</title>
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
require_once './class/class.bakijai_casedate.php';
require_once './class/utility.class.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBakijai_casedate=new Bakijai_casedate();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_bakijai_casedate.php?tag=1  method=POST >";
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
echo "Day";
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
$sql=$sql."Day".$_POST['cond2']."'".$_POST['mval2']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_bakijai_casedate.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_id
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Day
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Next_date
</td>
</tr>
<?php
$rowcount=0;
$objBakijai_casedate->setCondString($sql);
$row=$objBakijai_casedate->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Case_id="Case_id".$rowcount; ?>
<td align=center>
<?php
$objBakijai_main= new Bakijai_main();
$row1=$objBakijai_main->getRow();
$unique="";
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Case_id']==$row1[$jj][0])
$unique=$row1[$jj][1];
}
?>
<input type=text size=16 name="<?php echo $Case_id;?>"  value="<?php echo $unique;?>" readonly>
<input type=hidden name=Old_<?php echo $Case_id;?>  value="<?php echo $row[$ii]['Case_id'];?>">
</td>
<?php  $Day="Day".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Day;?>" size=5    value="<?php echo $row[$ii]['Day'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Day;?>  value="<?php echo $row[$ii]['Day'];?>">
</td>
<?php  $Next_date="Next_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Next_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Next_date']);?>">
<input type=hidden name=Old_<?php echo $Next_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Next_date']);?>">
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
$sql="update bakijai_casedate set ";
$updcount=0;
$oldNext_date="Old_Next_date".$ind;
$Next_date="Next_date".$ind;

$Next_date=$objUtility->to_mysqldate($_POST[$Next_date]);
$oldNext_date=$objUtility->to_mysqldate($_POST[$oldNext_date]);

if ($objUtility->validate($Next_date))
{
if ($oldNext_date!=$Next_date)
{
$sql=$sql."Next_date='".$Next_date."',";
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
$oldDay="Old_Day".$ind;
$oldDay=$_POST[$oldDay];
$sql=$sql."Day='".$oldDay."'";
if ($updcount>0)
{
$res=$objBakijai_casedate->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("bakijai_casedate",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_bakijai_casedate.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
