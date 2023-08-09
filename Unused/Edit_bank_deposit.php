<html>
<head>
<title>Edit Form forbank_deposit</title>
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
require_once './class/class.bank_deposit.php';
require_once './class/utility.class.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBank_deposit=new Bank_deposit();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_bank_deposit.php?tag=1  method=POST >";
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
echo "Installment";
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
$sql=$sql."Installment".$_POST['cond2']."'".$_POST['mval2']."' and ";
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_bank_deposit.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_id
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Installment
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Amount
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Deposit_date
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Collection_book_no
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Collection_rcpt_no
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Bank_rcpt_no
</td>
</tr>
<?php
$rowcount=0;
$objBank_deposit->setCondString($sql);
$row=$objBank_deposit->getAllRecord();
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
<?php  $Installment="Installment".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Installment;?>" size=5    value="<?php echo $row[$ii]['Installment'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Installment;?>  value="<?php echo $row[$ii]['Installment'];?>">
</td>
<?php  $Amount="Amount".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Amount;?>" size=5    value="<?php echo $row[$ii]['Amount'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Amount;?>  value="<?php echo $row[$ii]['Amount'];?>">
</td>
<?php  $Deposit_date="Deposit_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Deposit_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Deposit_date']);?>">
<input type=hidden name=Old_<?php echo $Deposit_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Deposit_date']);?>">
</td>
<?php  $Collection_book_no="Collection_book_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Collection_book_no;?>" size=10    value="<?php echo $row[$ii]['Collection_book_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Collection_book_no;?>  value="<?php echo $row[$ii]['Collection_book_no'];?>">
</td>
<?php  $Collection_rcpt_no="Collection_rcpt_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Collection_rcpt_no;?>" size=10    value="<?php echo $row[$ii]['Collection_rcpt_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Collection_rcpt_no;?>  value="<?php echo $row[$ii]['Collection_rcpt_no'];?>">
</td>
<?php  $Bank_rcpt_no="Bank_rcpt_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Bank_rcpt_no;?>" size=10    value="<?php echo $row[$ii]['Bank_rcpt_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Bank_rcpt_no;?>  value="<?php echo $row[$ii]['Bank_rcpt_no'];?>">
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
$sql="update bank_deposit set ";
$updcount=0;
$oldAmount="Old_Amount".$ind;
$Amount="Amount".$ind;

$Amount=$_POST[$Amount];
$oldAmount=$_POST[$oldAmount];

if ($objUtility->validate($Amount))
{
if ($oldAmount!=$Amount)
{
$sql=$sql."Amount='".$Amount."',";
$updcount++;
}
}
$oldDeposit_date="Old_Deposit_date".$ind;
$Deposit_date="Deposit_date".$ind;

$Deposit_date=$objUtility->to_mysqldate($_POST[$Deposit_date]);
$oldDeposit_date=$objUtility->to_mysqldate($_POST[$oldDeposit_date]);

if ($objUtility->validate($Deposit_date))
{
if ($oldDeposit_date!=$Deposit_date)
{
$sql=$sql."Deposit_date='".$Deposit_date."',";
$updcount++;
}
}
$oldCollection_book_no="Old_Collection_book_no".$ind;
$Collection_book_no="Collection_book_no".$ind;

$Collection_book_no=$_POST[$Collection_book_no];
$oldCollection_book_no=$_POST[$oldCollection_book_no];

if ($objUtility->validate($Collection_book_no))
{
if ($oldCollection_book_no!=$Collection_book_no)
{
$sql=$sql."Collection_book_no='".$Collection_book_no."',";
$updcount++;
}
}
$oldCollection_rcpt_no="Old_Collection_rcpt_no".$ind;
$Collection_rcpt_no="Collection_rcpt_no".$ind;

$Collection_rcpt_no=$_POST[$Collection_rcpt_no];
$oldCollection_rcpt_no=$_POST[$oldCollection_rcpt_no];

if ($objUtility->validate($Collection_rcpt_no))
{
if ($oldCollection_rcpt_no!=$Collection_rcpt_no)
{
$sql=$sql."Collection_rcpt_no='".$Collection_rcpt_no."',";
$updcount++;
}
}
$oldBank_rcpt_no="Old_Bank_rcpt_no".$ind;
$Bank_rcpt_no="Bank_rcpt_no".$ind;

$Bank_rcpt_no=$_POST[$Bank_rcpt_no];
$oldBank_rcpt_no=$_POST[$oldBank_rcpt_no];

if ($objUtility->validate($Bank_rcpt_no))
{
if ($oldBank_rcpt_no!=$Bank_rcpt_no)
{
$sql=$sql."Bank_rcpt_no='".$Bank_rcpt_no."',";
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
$oldInstallment="Old_Installment".$ind;
$oldInstallment=$_POST[$oldInstallment];
$sql=$sql."Installment='".$oldInstallment."'";
if ($updcount>0)
{
$res=$objBank_deposit->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("bank_deposit",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_bank_deposit.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
