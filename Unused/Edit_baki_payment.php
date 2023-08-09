<html>
<head>
<title>Edit Form forbaki_payment</title>
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
require_once './class/class.baki_payment.php';
require_once './class/utility.class.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBaki_payment=new Baki_payment();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_baki_payment.php?tag=1  method=POST >";
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
echo "Instalment_no";
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
$sql=$sql."Instalment_no".$_POST['cond2']."'".$_POST['mval2']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_baki_payment.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_id
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Instalment_no
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Paid_today
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Pay_date
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Payment_mode
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Receipt_no
</td>
</tr>
<?php
$rowcount=0;
$objBaki_payment->setCondString($sql);
$row=$objBaki_payment->getAllRecord();
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
<?php  $Instalment_no="Instalment_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Instalment_no;?>" size=5    value="<?php echo $row[$ii]['Instalment_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Instalment_no;?>  value="<?php echo $row[$ii]['Instalment_no'];?>">
</td>
<?php  $Paid_today="Paid_today".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Paid_today;?>" size=5    value="<?php echo $row[$ii]['Paid_today'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Paid_today;?>  value="<?php echo $row[$ii]['Paid_today'];?>">
</td>
<?php  $Pay_date="Pay_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Pay_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Pay_date']);?>">
<input type=hidden name=Old_<?php echo $Pay_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Pay_date']);?>">
</td>
<?php  $Payment_mode="Payment_mode".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Payment_mode;?>" size=30    value="<?php echo $row[$ii]['Payment_mode'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Payment_mode;?>  value="<?php echo $row[$ii]['Payment_mode'];?>">
</td>
<?php  $Receipt_no="Receipt_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Receipt_no;?>" size=30    value="<?php echo $row[$ii]['Receipt_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Receipt_no;?>  value="<?php echo $row[$ii]['Receipt_no'];?>">
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
$sql="update baki_payment set ";
$updcount=0;
$oldPaid_today="Old_Paid_today".$ind;
$Paid_today="Paid_today".$ind;

$Paid_today=$_POST[$Paid_today];
$oldPaid_today=$_POST[$oldPaid_today];

if ($objUtility->validate($Paid_today))
{
if ($oldPaid_today!=$Paid_today)
{
$sql=$sql."Paid_today='".$Paid_today."',";
$updcount++;
}
}
$oldPay_date="Old_Pay_date".$ind;
$Pay_date="Pay_date".$ind;

$Pay_date=$objUtility->to_mysqldate($_POST[$Pay_date]);
$oldPay_date=$objUtility->to_mysqldate($_POST[$oldPay_date]);

if ($objUtility->validate($Pay_date))
{
if ($oldPay_date!=$Pay_date)
{
$sql=$sql."Pay_date='".$Pay_date."',";
$updcount++;
}
}
$oldPayment_mode="Old_Payment_mode".$ind;
$Payment_mode="Payment_mode".$ind;

$Payment_mode=$_POST[$Payment_mode];
$oldPayment_mode=$_POST[$oldPayment_mode];

if ($objUtility->validate($Payment_mode))
{
if ($oldPayment_mode!=$Payment_mode)
{
$sql=$sql."Payment_mode='".$Payment_mode."',";
$updcount++;
}
}
$oldReceipt_no="Old_Receipt_no".$ind;
$Receipt_no="Receipt_no".$ind;

$Receipt_no=$_POST[$Receipt_no];
$oldReceipt_no=$_POST[$oldReceipt_no];

if ($objUtility->validate($Receipt_no))
{
if ($oldReceipt_no!=$Receipt_no)
{
$sql=$sql."Receipt_no='".$Receipt_no."',";
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
$oldInstalment_no="Old_Instalment_no".$ind;
$oldInstalment_no=$_POST[$oldInstalment_no];
$sql=$sql."Instalment_no='".$oldInstalment_no."'";
if ($updcount>0)
{
$res=$objBaki_payment->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("baki_payment",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_baki_payment.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
