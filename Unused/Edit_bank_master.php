<html>
<head>
<title>Edit Form forbank_master</title>
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
require_once './class/class.bank_master.php';
require_once './class/utility.class.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBank_master=new Bank_master();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_bank_master.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center>";
echo "Bank_name";
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
$sql=$sql."Bank_name".$_POST['cond1']."'".$_POST['mval1']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_bank_master.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Bank_name
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Btype
</td>
</tr>
<?php
$rowcount=0;
$objBank_master->setCondString($sql);
$row=$objBank_master->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Bank_name="Bank_name".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Bank_name;?>" size=30    value="<?php echo $row[$ii]['Bank_name'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Bank_name;?>  value="<?php echo $row[$ii]['Bank_name'];?>">
</td>
<?php  $Btype="Btype".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Btype;?>" size=25    value="<?php echo $row[$ii]['Btype'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Btype;?>  value="<?php echo $row[$ii]['Btype'];?>">
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
$sql="update bank_master set ";
$updcount=0;
$oldBtype="Old_Btype".$ind;
$Btype="Btype".$ind;

$Btype=$_POST[$Btype];
$oldBtype=$_POST[$oldBtype];

if ($objUtility->validate($Btype))
{
if ($oldBtype!=$Btype)
{
$sql=$sql."Btype='".$Btype."',";
$updcount++;
}
}
$oldBank_name="Old_Bank_name".$ind;
$Bank_name=$_POST[$oldBank_name];
$sql=$sql."Bank_name='".$Bank_name."'";
$sql=$sql." where ";
$oldBank_name="Old_Bank_name".$ind;
$oldBank_name=$_POST[$oldBank_name];
$sql=$sql."Bank_name='".$oldBank_name."'";
if ($updcount>0)
{
$res=$objBank_master->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("bank_master",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_bank_master.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
