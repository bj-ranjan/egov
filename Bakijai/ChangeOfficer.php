<html>
<head>
<title>Change Certificate Officer</title>
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
require_once '../class/utility.class.php';
require_once './class/class.bank_master.php';
require_once '../class/class.officer.php';
require_once 'header.php';


$objUtility=new Utility();
$allowedroll=2;
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 15)==false) //15 for Case Particulars Modification 
header( 'Location: Mainmenu.php?unauth=1');


$objBakijai_main=new Bakijai_main();

if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
?>    
<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=50%>
<form name=startform action=ChangeOfficer.php?tag=1  method=POST >
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Bank</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objO=new Bank_master();
$row=$objO->getRow();
?>
<select name=Bank style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px">
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
?>
<option  value="<?php echo $row[$ind]['Bank_name'];?>"><?php echo $row[$ind]['Bank_name'];?>
<?php
} //for loop
?>
</select>
<input type="submit" value="Proceed">
<input type=button value=Menu name=back1 id=back2 onclick=home()>
</td>
</tr>   


</table>
</form>
<?php       
} //$code=0


if ($code==1) //Next Loading aftre postback
{
 if (isset($_POST['Bank']))
 {
 if ($_POST['Bank']=="0") 
 header( 'Location: ChangeOfficer.php?tag=0');
 else
 $sql=" disposed='N' and court_case='N' and bank='".$_POST['Bank']."' order by case_id";
 }
 else
 header( 'Location: ChangeOfficer.php?tag=0');    

?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=ChangeOfficer.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case ID
</td>    
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Case Number
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Name of Defaulter
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Present Officer
</td>
<td align=center bgcolor=#CCFFCC><font size=3 face=arial color=blue>
Click to Change
</td>
</tr>
<?php
$rowcount=0;
$objBakijai_main->setCondString($sql);
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
$casenumber=$row[$ii]['Bank'].",".$row[$ii]['Branch']."/".$row[$ii]['Case_no']."/".$row[$ii]['Fin_yr']
?>
<tr>
<?php  $Case_id="Case_id".$rowcount; ?>
<td align=center>
<input type=hidden name="<?php echo $Case_id;?>" size=5    value="<?php echo $row[$ii]['Case_id'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<font face="arial" size="2">
<?php echo $row[$ii]['Case_id'];?>  
</td>
<td align=left>
<font face="arial" size="2">
<?php echo $casenumber;?>    
</td>
<td align=left>
<font face="arial" size="2">
<?php echo $row[$ii]['Full_name'];?>   
</td>
<td align=center>
<font face="arial" size="2">
<?php  $Off="Off".$rowcount; ?>
<input type=hidden name="<?php echo $Off;?>" size=5    value="<?php echo $row[$ii]['Certificate_officer'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" readonly>
<?php echo $row[$ii]['Certificate_officer'];?>   
</td>
<?php  $Sel="Sel".$rowcount; ?>
<td align=center>
<input type=checkbox name="<?php echo $Sel;?>"  style="font-family: Arial;background-color:white;color:black;font-size: 18px" >
</td>
</tr>
<?php
} //while
$_SESSION['rowcount']=$rowcount;
?>
<tr><td colspan="2" align="right" bgcolor="#99FF99"><font face="arial" size="2">  Select New Officer</td>
<?php 
$objO=new Officer();
$objO->setCondString(" exist=true order by Officer_name" ); //Change the condition for where clause accordingly
$row=$objO->getRow();
?>
<td colspan="3" align="left" bgcolor="#99FF99">    
<select name=Officer style="font-family: Arial;background-color:white;color:black;font-weight:bold; font-size: 14px;width:250px">
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
?>
<option  value="<?php echo $row[$ind]['Officer_name'];?>"><?php echo $row[$ind]['Officer_name'];?>
<?php
} //for loop
?>
</select>
<input type="hidden" name="Rcount" value="<?php echo $ii;?>"   
    
</td></tr>
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
if (isset($_POST['Rcount']))
$rcount= $_POST['Rcount'];
else 
$rount=0;    
    
$updcount=0;   
if (isset($_POST['Officer']))
$Officer=$_POST['Officer'];
else 
$Officer="0";    

for ($ind=1;$ind<=$rcount;$ind++)
{
$Case_id="Case_id".$ind;

if (isset($_POST[$Case_id]))
$Case_id= $_POST[$Case_id];
else
$Case_id=0;

$Off="Off".$ind;

if (isset($_POST[$Off]))
$Off= $_POST[$Off];
else
$Off="0";


$Sel="Sel".$ind;
if (isset($_POST[$Sel]))
{
if($Off!=$Officer && $Officer!="0")
{
$objBakijai_main->setCase_id($Case_id);  
$objBakijai_main->setCertificate_officer($Officer);
if ($objBakijai_main->UpdateRecord())
$updcount++;
//echo $objBakijai_main->returnSql."<br>";
}
}
}//for loop
$str="Updated Certificate Officer for ".$updcount." Case";
if ($updcount>0)
echo $objUtility->alert ($str);
echo "<A href=ChangeOfficer.php?tag=0>Back</a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<A href=mainmenu.php?tag=1>Home</a>";
}//code=2
?>
</form>
</body>
</html>
