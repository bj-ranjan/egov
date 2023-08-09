<html>
<head>
<title>Edit Form forbankbranch</title>
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
require_once './class/class.bankbranch.php';
require_once './class/utility.class.php';
require_once './class/class.bank_master.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBankbranch=new Bankbranch();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_bankbranch.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Bank";
echo "<select name=cond1>";
echo "<option  value=".chr(34).$condition[1].chr(34).">=";
echo "<option  value=".chr(34).$condition[2].chr(34)."><";
echo "<option  value=".chr(34).$condition[3].chr(34).">>";
echo "</select>";
echo "<input type=text size=9 name=mval1>";
echo "</td>";
echo "<td align=center>";
echo "Branch";
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
$sql=$sql."Bank".$_POST['cond1']."'".$_POST['mval1']."' and ";
if (strlen($_POST['mval2'])>0)
$sql=$sql."Branch".$_POST['cond2']."'".$_POST['mval2']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_bankbranch.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Rsl
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Bank
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Branch
</td>
</tr>
<?php
$rowcount=0;
$objBankbranch->setCondString($sql);
$row=$objBankbranch->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Rsl="Rsl".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Rsl;?>" size=5    value="<?php echo $row[$ii]['Rsl'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Rsl;?>  value="<?php echo $row[$ii]['Rsl'];?>">
</td>
<?php  $Bank="Bank".$rowcount; ?>
<td align=center>
<?php
$objBank_master= new Bank_master();
$row1=$objBank_master->getRow();
$unique="";
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Bank']==$row1[$jj][0])
$unique=$row1[$jj][1];
}
?>
<input type=text size=16 name="<?php echo $Bank;?>"  value="<?php echo $unique;?>" readonly>
<input type=hidden name=Old_<?php echo $Bank;?>  value="<?php echo $row[$ii]['Bank'];?>">
</td>
<?php  $Branch="Branch".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Branch;?>" size=30    value="<?php echo $row[$ii]['Branch'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Branch;?>  value="<?php echo $row[$ii]['Branch'];?>">
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
$sql="update bankbranch set ";
$updcount=0;
$oldRsl="Old_Rsl".$ind;
$Rsl="Rsl".$ind;

$Rsl=$_POST[$Rsl];
$oldRsl=$_POST[$oldRsl];

if ($objUtility->validate($Rsl))
{
if ($oldRsl!=$Rsl)
{
$sql=$sql."Rsl='".$Rsl."',";
$updcount++;
}
}
$oldBank="Old_Bank".$ind;
$Bank=$_POST[$oldBank];
$sql=$sql."Bank='".$Bank."'";
$sql=$sql." where ";
$oldBank="Old_Bank".$ind;
$oldBank=$_POST[$oldBank];
$sql=$sql."Bank='".$oldBank."'";
$sql=$sql." and ";
$oldBranch="Old_Branch".$ind;
$oldBranch=$_POST[$oldBranch];
$sql=$sql."Branch='".$oldBranch."'";
if ($updcount>0)
{
$res=$objBankbranch->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("bankbranch",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_bankbranch.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
