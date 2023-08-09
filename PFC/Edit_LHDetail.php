<html>
<head>
<title>Edit Form forlegal_heir</title>
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
require_once './class/class.legal_heir.php';
require_once '../class/utility.class.php';
require_once '../class/class.relation.php';
require_once '../class/class.officer.php';
require_once './class/class.Petition_master.php';

$objUtility=new Utility();
require_once 'header.php';

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 14)==false) //14 for Process Legal Heir
header( 'Location: Mainmenu.php?unauth=1');

$objPm=new Petition_master();
$objLegal_heir=new Legal_heir();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=70%>";
echo "<form name=startform action=Edit_LHDetail.php?tag=1  method=POST >";
echo "<tr>";
$condition=array(1=>'=',2=>'<',3=>'>',4=>'<>');
echo "<td align=center><font face=arial size=2>";
echo "Enter Petition Year";
echo "<input type=text size=4 name=mval1 value=".date('Y').">";
echo "</td>";
echo "<td align=center><font face=arial size=2>";
echo "Enter Petition No";
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
$rdonly=" ";
//$rdonly=" readonly ";
$sql="";if (strlen($_POST['mval1'])>0)
$sql=$sql."Pet_yr='".$_POST['mval1']."' and ";
if (strlen($_POST['mval2'])>0)
$sql=$sql."Pet_no=".$_POST['mval2']." and ";

$sql=$sql." 1=1";

$objPm->setPet_yr($_POST['mval1']);
$objPm->setPet_no($_POST['mval2']);
if($objPm->EditRecord())
{
$Father=$objPm->getFather();
$boname=$objPm->getBo_name();
}
else
{
$Father="";
$boname="";
}
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=Edit_LHDetail.php?tag=2  method=POST >
<tr>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Petition No
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Slno
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Name of NOK
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Age
</td>
<td align=center bgcolor=#669999><font size=2 face=arial color=black>
Relation
</td>
</tr>
<tr><td align=right colspan=3>
<font face=arial size=2>Name of Deceased      
</td><td align=center colspan=2>
<input type=text name=Deceased id=Deceased value="<?php echo $Father;?>" size=25 maxlength=30>
</td>
</tr>
<?php
$rowcount=0;
$objLegal_heir->setCondString($sql);
$row=$objLegal_heir->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php  $Pet_yr="Pet_yr".$rowcount; ?>
<td align=center>
<font face=arial size=1 color=blue>
<?php  echo $row[$ii]['Pet_no']."/".$row[$ii]['Pet_yr'] ; ?>
<input type=hidden name="<?php echo $Pet_yr;?>" size=5    value="<?php echo $row[$ii]['Pet_yr'];?>" style="font-family: Arial;background-color:#FFCC99;color:black;font-size: 18px " <?php echo $rdonly;?>>
<input type=hidden name=Old_<?php echo $Pet_yr;?>  value="<?php echo $row[$ii]['Pet_yr'];?>">
</td>
<td align=center>
<?php  $Pet_no="Pet_no".$rowcount; ?>

<input type=hidden name="<?php echo $Pet_no;?>" size=5    value="<?php echo $row[$ii]['Pet_no'];?>" style="font-family: Arial;background-color:#FFCC99;color:black;font-size: 18px " <?php echo $rdonly;?>>
<input type=hidden name=Old_<?php echo $Pet_no;?>  value="<?php echo $row[$ii]['Pet_no'];?>">
<?php  $Slno="Slno".$rowcount; ?>
<input type=text name="<?php echo $Slno;?>" size=3    value="<?php echo $row[$ii]['Slno'];?>" style="font-family: Arial;background-color:#FFCC99;color:black;font-size: 12px " <?php echo $rdonly;?>>
<input type=hidden name=Old_<?php echo $Slno;?>  value="<?php echo $row[$ii]['Slno'];?>">
</td>
<?php  $Nok="Nok".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Nok;?>" size=30    value="<?php echo $row[$ii]['Nok'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Nok;?>  value="<?php echo $row[$ii]['Nok'];?>">
</td>
<?php  $Age="Age".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Age;?>" size=5    value="<?php echo $row[$ii]['Age'];?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
<input type=hidden name=Old_<?php echo $Age;?>  value="<?php echo $row[$ii]['Age'];?>">
</td>
<?php  $Relation="Relation".$rowcount; ?>
<td align=center>
<select name="<?php echo $Relation;?>" style="font-family: Arial;background-color:white;color:black;font-size: 14px;width:150px">
<?php
$objRelation= new Relation();
$row1=$objRelation->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
if ($row[$ii]['Relation']==$row1[$jj]['Rel_name'])
echo "<option  selected value=".chr(34).$row1[$jj]['Rel_name'].chr(34).">".$row1[$jj]['Rel_name'];
else
echo "<option  value=".chr(34).$row1[$jj]['Rel_name'].chr(34).">".$row1[$jj]['Rel_name'];
}
?>
</select>
<input type=hidden name=Old_<?php echo $Relation;?>   value="<?php echo $row[$ii]['Relation'];?>">
</td>
</tr>
<?php
} //while
$_SESSION['rowcount']=$rowcount;

$objOfficer=new Officer();
$objOfficer->setCondString(" exist=true order by Officer_name" ); //Change the condition for where clause accordingly
$row=$objOfficer->getRow();

?>
<tr><td align=right colspan=2>
<font face=arial size=2>Select BO     
</td><td align=center colspan=2>
<select name="BO" id="BO">
<?php $dval="";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{?>
<option  value="<?php echo $row[$ind]['Officer_name'];?>"><?php echo $row[$ind]['Officer_name'];?>
<?php
} //for loop
?>
</select>
</td><td align=center>
<font face=arial size=1 color=red><?php echo $boname;?>
</td></tr>
<tr><td align=center bgcolor=#FFFFCC>
<input type=button value=Menu name=back1 id=back2 onclick=home()>
</td><td align=center bgcolor=#FFFFCC colspan=4>
<input type=submit value=Update  name=Save1 
 style="font-family: Arial;background-color:orange;color:black;font-size: 14px;width:150px">

</td></tr>
</table>
<?php
}//$code==1


if ($code==2) //PostBack Submit
{
//echo $_SESSION['rowcount'];
for ($ind=1;$ind<=$_SESSION['rowcount'];$ind++)
{
$sql="update legal_heir set ";
$updcount=0;
$oldPet_yr="Old_Pet_yr".$ind;
$Pet_yr="Pet_yr".$ind;

$Pet_yr=$_POST[$Pet_yr];
$oldPet_yr=$_POST[$oldPet_yr];

if (is_numeric($Pet_yr))
{
if ($oldPet_yr!=$Pet_yr)
{
$sql=$sql."Pet_yr='".$Pet_yr."',";
$updcount++;
}
}
$oldPet_no="Old_Pet_no".$ind;
$Pet_no="Pet_no".$ind;

$Pet_no=$_POST[$Pet_no];
$oldPet_no=$_POST[$oldPet_no];

if (is_numeric($Pet_no))
{
if ($oldPet_no!=$Pet_no)
{
$sql=$sql."Pet_no='".$Pet_no."',";
$updcount++;
}
}
$oldSlno="Old_Slno".$ind;
$Slno="Slno".$ind;

$Slno=$_POST[$Slno];
$oldSlno=$_POST[$oldSlno];

if (is_numeric($Slno))
{
if ($oldSlno!=$Slno)
{
$sql=$sql."Slno='".$Slno."',";
$updcount++;
}
}
$oldNok="Old_Nok".$ind;
$Nok="Nok".$ind;

$Nok=$_POST[$Nok];
$oldNok=$_POST[$oldNok];

if ($objUtility->SimpleValidate($Nok,60))
{
if ($oldNok!=$Nok)
{
$sql=$sql."Nok='".$Nok."',";
$updcount++;
}
}
$oldAge="Old_Age".$ind;
$Age="Age".$ind;

$Age=$_POST[$Age];
$oldAge=$_POST[$oldAge];

if (is_numeric($Age))
{
if ($oldAge!=$Age)
{
$sql=$sql."Age='".$Age."',";
$updcount++;
}
}
$oldRelation="Old_Relation".$ind;
$Relation="Relation".$ind;

$Relation=$_POST[$Relation];
$oldRelation=$_POST[$oldRelation];

if ($objUtility->SimpleValidate($Relation,20))
{
if ($oldRelation!=$Relation)
{
$sql=$sql."Relation='".$Relation."',";
$updcount++;
}
}
$sql=$sql."Pet_yr=Pet_yr";
$sql=$sql." where ";
$oldPet_yr="Old_Pet_yr".$ind;
$oldPet_yr=$_POST[$oldPet_yr];
$sql=$sql."Pet_yr='".$oldPet_yr."'";
$sql=$sql." and ";
$oldPet_no="Old_Pet_no".$ind;
$oldPet_no=$_POST[$oldPet_no];
$sql=$sql."Pet_no=".$oldPet_no;
$sql=$sql." and ";
$oldSlno="Old_Slno".$ind;
$oldSlno=$_POST[$oldSlno];
$sql=$sql."Slno=".$oldSlno;
if ($updcount>0)
{
$res=$objLegal_heir->ExecuteQuery($sql);
//echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("legal_heir",$sql);
$objUtility->Backup2Access("", $sql);
//echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
echo $objUtility->AlertNRedirect("Updated ".$updcount." Record","Mainmenu.php");
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_LHDetail.php?tag=0>Back</a>";
$bo=$_POST['BO'];
$Deceased=$_POST['Deceased'];
$newsql="update Petition_master set Ward=Ward";

if (strlen($bo)>1)
$newsql=$newsql.",Bo_name='".$bo."'";

if ($objUtility->validate($Deceased,30)==true)
$newsql=$newsql.",Father='".$Deceased."'";

$newsql=$newsql." where Pet_yr='".$_POST['Pet_yr1']."' and Pet_no=".$_POST['Pet_no1'];

$objLegal_heir->ExecuteQuery($newsql);
$objUtility->Backup2Access("", $newsql);
}//code=2
?>
</p>
</form>
</body>
</html>
