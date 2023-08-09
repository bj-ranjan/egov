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
<?php
session_start();
require_once './class/class.bakijai_main.php';
require_once './class/utility.class.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: index.php');

$objBakijai_main=new Bakijai_main();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>";
echo "<form name=startform action=Edit_bakijai_main.php?tag=1  method=POST >";
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
$sql=$sql." 1=1";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_bakijai_main.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_id
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Start_date
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case_no
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Fin_yr
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Bank
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Branch
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Full_name
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Full_name_ass
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Father
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Father_ass
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Polst_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Circle
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Mouza
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Vill_code
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Amount
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Balance
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Req_letter_no
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Req_letter_date
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
<input type=text name="<?php echo $Case_id;?>" size=5    value="<?php echo $row[$ii]['Case_id'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<input type=hidden name=Old_<?php echo $Case_id;?>  value="<?php echo $row[$ii]['Case_id'];?>">
</td>
<?php  $Start_date="Start_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Start_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Start_date']);?>">
<input type=hidden name=Old_<?php echo $Start_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Start_date']);?>">
</td>
<?php  $Case_no="Case_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Case_no;?>" size=30    value="<?php echo $row[$ii]['Case_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Case_no;?>  value="<?php echo $row[$ii]['Case_no'];?>">
</td>
<?php  $Fin_yr="Fin_yr".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Fin_yr;?>" size=30    value="<?php echo $row[$ii]['Fin_yr'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Fin_yr;?>  value="<?php echo $row[$ii]['Fin_yr'];?>">
</td>
<?php  $Bank="Bank".$rowcount; ?>
<td align=center>
<select name="<?php echo $Bank;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objBank_master= new Bank_master();
$row1=$objBank_master->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Bank']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Bank;?>   value="<?php echo $row[$ii]['Bank'];?>">
</td>
<?php  $Branch="Branch".$rowcount; ?>
<td align=center>
<select name="<?php echo $Branch;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objBankbranch= new Bankbranch();
$row1=$objBankbranch->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Branch']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Branch;?>   value="<?php echo $row[$ii]['Branch'];?>">
</td>
<?php  $Full_name="Full_name".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Full_name;?>" size=30    value="<?php echo $row[$ii]['Full_name'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Full_name;?>  value="<?php echo $row[$ii]['Full_name'];?>">
</td>
<?php  $Full_name_ass="Full_name_ass".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Full_name_ass;?>" size=30    value="<?php echo $row[$ii]['Full_name_ass'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px">
<input type=hidden name=Old_<?php echo $Full_name_ass;?>  value="<?php echo $row[$ii]['Full_name_ass'];?>">
</td>
<?php  $Father="Father".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Father;?>" size=30    value="<?php echo $row[$ii]['Father'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Father;?>  value="<?php echo $row[$ii]['Father'];?>">
</td>
<?php  $Father_ass="Father_ass".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Father_ass;?>" size=30    value="<?php echo $row[$ii]['Father_ass'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px">
<input type=hidden name=Old_<?php echo $Father_ass;?>  value="<?php echo $row[$ii]['Father_ass'];?>">
</td>
<?php  $Polst_code="Polst_code".$rowcount; ?>
<td align=center>
<select name="<?php echo $Polst_code;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objPolice_station= new Police_station();
$row1=$objPolice_station->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Polst_code']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Polst_code;?>   value="<?php echo $row[$ii]['Polst_code'];?>">
</td>
<?php  $Circle="Circle".$rowcount; ?>
<td align=center>
<select name="<?php echo $Circle;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objCircle= new Circle();
$row1=$objCircle->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Circle']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Circle;?>   value="<?php echo $row[$ii]['Circle'];?>">
</td>
<?php  $Mouza="Mouza".$rowcount; ?>
<td align=center>
<select name="<?php echo $Mouza;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objMouza= new Mouza();
$row1=$objMouza->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Mouza']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Mouza;?>   value="<?php echo $row[$ii]['Mouza'];?>">
</td>
<?php  $Vill_code="Vill_code".$rowcount; ?>
<td align=center>
<select name="<?php echo $Vill_code;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objVillage= new Village();
$row1=$objVillage->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Vill_code']==$row1[$jj][0])
echo "<option  selected value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
else
echo "<option  value=".chr(34).$row1[$jj][0].chr(34).">".$row1[$jj][1];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Vill_code;?>   value="<?php echo $row[$ii]['Vill_code'];?>">
</td>
<?php  $Amount="Amount".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Amount;?>" size=5    value="<?php echo $row[$ii]['Amount'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Amount;?>  value="<?php echo $row[$ii]['Amount'];?>">
</td>
<?php  $Balance="Balance".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Balance;?>" size=5    value="<?php echo $row[$ii]['Balance'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Balance;?>  value="<?php echo $row[$ii]['Balance'];?>">
</td>
<?php  $Req_letter_no="Req_letter_no".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Req_letter_no;?>" size=30    value="<?php echo $row[$ii]['Req_letter_no'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Req_letter_no;?>  value="<?php echo $row[$ii]['Req_letter_no'];?>">
</td>
<?php  $Req_letter_date="Req_letter_date".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Req_letter_date;?>" size=10  value="<?php echo $objUtility->to_date($row[$ii]['Req_letter_date']);?>">
<input type=hidden name=Old_<?php echo $Req_letter_date;?>  value="<?php echo $objUtility->to_date($row[$ii]['Req_letter_date']);?>">
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
$sql="update bakijai_main set ";
$updcount=0;
$oldStart_date="Old_Start_date".$ind;
$Start_date="Start_date".$ind;

$Start_date=$objUtility->to_mysqldate($_POST[$Start_date]);
$oldStart_date=$objUtility->to_mysqldate($_POST[$oldStart_date]);

if ($objUtility->validate($Start_date))
{
if ($oldStart_date!=$Start_date)
{
$sql=$sql."Start_date='".$Start_date."',";
$updcount++;
}
}
$oldCase_no="Old_Case_no".$ind;
$Case_no="Case_no".$ind;

$Case_no=$_POST[$Case_no];
$oldCase_no=$_POST[$oldCase_no];

if ($objUtility->validate($Case_no))
{
if ($oldCase_no!=$Case_no)
{
$sql=$sql."Case_no='".$Case_no."',";
$updcount++;
}
}
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
$oldBank="Old_Bank".$ind;
$Bank="Bank".$ind;

$Bank=$_POST[$Bank];
$oldBank=$_POST[$oldBank];

if ($objUtility->validate($Bank))
{
if ($oldBank!=$Bank)
{
$sql=$sql."Bank='".$Bank."',";
$updcount++;
}
}
$oldBranch="Old_Branch".$ind;
$Branch="Branch".$ind;

$Branch=$_POST[$Branch];
$oldBranch=$_POST[$oldBranch];

if ($objUtility->validate($Branch))
{
if ($oldBranch!=$Branch)
{
$sql=$sql."Branch='".$Branch."',";
$updcount++;
}
}
$oldFull_name="Old_Full_name".$ind;
$Full_name="Full_name".$ind;

$Full_name=$_POST[$Full_name];
$oldFull_name=$_POST[$oldFull_name];

if ($objUtility->validate($Full_name))
{
if ($oldFull_name!=$Full_name)
{
$sql=$sql."Full_name='".$Full_name."',";
$updcount++;
}
}
$oldFull_name_ass="Old_Full_name_ass".$ind;
$Full_name_ass="Full_name_ass".$ind;

$Full_name_ass=$_POST[$Full_name_ass];
$oldFull_name_ass=$_POST[$oldFull_name_ass];

if ($objUtility->validate($Full_name_ass))
{
if ($oldFull_name_ass!=$Full_name_ass)
{
$sql=$sql."Full_name_ass='".$Full_name_ass."',";
$updcount++;
}
}
$oldFather="Old_Father".$ind;
$Father="Father".$ind;

$Father=$_POST[$Father];
$oldFather=$_POST[$oldFather];

if ($objUtility->validate($Father))
{
if ($oldFather!=$Father)
{
$sql=$sql."Father='".$Father."',";
$updcount++;
}
}
$oldFather_ass="Old_Father_ass".$ind;
$Father_ass="Father_ass".$ind;

$Father_ass=$_POST[$Father_ass];
$oldFather_ass=$_POST[$oldFather_ass];

if ($objUtility->validate($Father_ass))
{
if ($oldFather_ass!=$Father_ass)
{
$sql=$sql."Father_ass='".$Father_ass."',";
$updcount++;
}
}
$oldPolst_code="Old_Polst_code".$ind;
$Polst_code="Polst_code".$ind;

$Polst_code=$_POST[$Polst_code];
$oldPolst_code=$_POST[$oldPolst_code];

if ($objUtility->validate($Polst_code))
{
if ($oldPolst_code!=$Polst_code)
{
$sql=$sql."Polst_code='".$Polst_code."',";
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
$oldMouza="Old_Mouza".$ind;
$Mouza="Mouza".$ind;

$Mouza=$_POST[$Mouza];
$oldMouza=$_POST[$oldMouza];

if ($objUtility->validate($Mouza))
{
if ($oldMouza!=$Mouza)
{
$sql=$sql."Mouza='".$Mouza."',";
$updcount++;
}
}
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
$oldBalance="Old_Balance".$ind;
$Balance="Balance".$ind;

$Balance=$_POST[$Balance];
$oldBalance=$_POST[$oldBalance];

if ($objUtility->validate($Balance))
{
if ($oldBalance!=$Balance)
{
$sql=$sql."Balance='".$Balance."',";
$updcount++;
}
}
$oldReq_letter_no="Old_Req_letter_no".$ind;
$Req_letter_no="Req_letter_no".$ind;

$Req_letter_no=$_POST[$Req_letter_no];
$oldReq_letter_no=$_POST[$oldReq_letter_no];

if ($objUtility->validate($Req_letter_no))
{
if ($oldReq_letter_no!=$Req_letter_no)
{
$sql=$sql."Req_letter_no='".$Req_letter_no."',";
$updcount++;
}
}
$oldReq_letter_date="Old_Req_letter_date".$ind;
$Req_letter_date="Req_letter_date".$ind;

$Req_letter_date=$objUtility->to_mysqldate($_POST[$Req_letter_date]);
$oldReq_letter_date=$objUtility->to_mysqldate($_POST[$oldReq_letter_date]);

if ($objUtility->validate($Req_letter_date))
{
if ($oldReq_letter_date!=$Req_letter_date)
{
$sql=$sql."Req_letter_date='".$Req_letter_date."',";
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
echo "<A href=Edit_bakijai_main.php?tag=0>Back</a>";
}//code=2
?>
</form>
</body>
</html>
