<html>
<head>
<title>Edit Form for legal_heir</title>
</head>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../validationnew.js"></script>
<script language=javascript>
<!--
function home()
{
window.location="ProcessLH.php?tag=1";
}

function validate()
{
    
//SelectBoxIndex('Relation')
var ok=false;
var str;
var ag;
var pdate=document.getElementById('Pdate').value;
var cdate=document.getElementById('DOD').value;

if(StringValid('Deceased',1,0) && DateValid('DOD',1) && StringValid('Memo',1,0))
{    
if(CompareDate(cdate,pdate)==-1)
ok=true;    
else
alert('Check Date of Death');    
}
else
alert('Enter Name of Deceased Person/Date of Death/Memo No Properly');

var no=Number(document.getElementById('Nos').value);
var valid=false;

if(ok==true)
{
var valid=true;
for(var i=1;i<=no;i++)  
{
str="Nok"+i;
if(StringValid(str,1,1)==false)
valid=false;

str="Relation"+i;
if(SelectBoxIndex(str)==0)
valid=false;  
 
str="Age"+i;
ag=document.getElementById(str).value
if(nonZero(ag)==false || Number(ag)>130)
valid=false; 

str="Dob"+i;
if(DateValid(str,0)==false)
valid=false; 
}//for loop
} //ok==true

if(valid==true)
{
myform.action="UpdateDetailEntryLH.php";
myform.submit();
//alert('Yes');
}
else
alert('Invalid Detail Entry')
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
require_once './class/class.petition_master.php';
require_once './class/class.legal_heir.php';
require_once '../class/utility.class.php';
require_once '../class/class.relation.php';
require_once '../class/class.officer.php';
require_once 'HEADER.php';

$objUtility=new Utility();
if ($objUtility->VerifyRoll()==-1)
header( 'Location: mainmenu.php?unauth=1');

$objLegal_heir=new Legal_heir();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Next Loading aftre postback
{
$rdonly=" ";
if(isset($_POST['Pet_yr']))
$petyr=$_POST['Pet_yr'];
else
$petyr=0;
if(isset($_POST['Pet_no']))
$petno=$_POST['Pet_no'];
else
$petno=0;
if(isset($_POST['Nos']))
$nos=$_POST['Nos'];
else
$nos=0;
$objPm=new Petition_master();
$objPm->setPet_yr($petyr);
$objPm->setPet_no($petno);
if($objPm->EditRecord())
{
$deceased=$objPm->getFather();
$applicant=$objPm->getApplicant();
$pdate=$objUtility->to_date($objPm->getPet_date());
}
else
{
$deceased="";    

}
?>
<p align="center">
    <font face="arial" size="3" color="red">
    DETAIL ENTRY OF LEGAL HEIR(NOK) PETITION
    </font>
</p>    
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform   method=POST >
<tr><td colspan="2" align="center" rowspan="2"><font size=2 face=arial color=blue>
<input type=hidden name=Pet_yr id="Pet_yr"  value="<?php echo $petyr;?>">
<input type=hidden name=Pet_no id="Pet_no"  value="<?php echo $petno;?>">
<input type=hidden name=Nos id="Nos"  value="<?php echo $nos;?>">
<input type=hidden name=Pdate id="Pdate"  value="<?php echo $pdate;?>">

<?php echo "Petition No-<b>".$petno."/".$petyr;?>
</td>
<td  align="right"><font size=2 face=arial color="blue">
Name of Deceased                                     
<td colspan="2" align="left">
<input type=text size="30" name=Deceased id="Deceased"  value="<?php echo $deceased;?>" maxlength="30">
</td>    
</tr>
<tr><td  align="right"><font size=2 face=arial color=blue>
Date of Death
</td>
<td colspan="2" align="left">
<input type=text size="10" name=DOD id="DOD"  value="" maxlength="10">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(DOD);" alt="Click Here to Pick Date">
</td>
</tr>
<tr>
<td align=center bgcolor=#669999 width="10%"><font size=2 face=arial color=black>
Sl No
</td>
<td align=center bgcolor=#669999 width="40%"><font size=2 face=arial color=black>
Name of NOK
</td>
<td align=center bgcolor=#669999 width="20%"><font size=2 face=arial color=black>
Relation
</td>
<td align=center bgcolor=#669999 width="10%"><font size=2 face=arial color=black>
Age
</td>
<td align=center bgcolor=#669999 width="20%"><font size=2 face=arial color=black>
Date of Birth
</td>
</tr>
<?php
$rowcount=0;

for($ii=0;$ii<$nos;$ii++)
{
$rowcount++;
if($ii>0)
$applicant="";    
?>
<tr>
<?php  $Slno="Slno".$rowcount; ?>
<td align=center>
<input type=text size="2" name="<?php echo $Slno;?>" id="<?php echo $Slno;?>" size=5    value="<?php echo $ii+1;?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px" readonly>
</td>
<?php  $Nok="Nok".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Nok;?>" id="<?php echo $Nok;?>" size=40    value="<?php echo $applicant;?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
</td>
<?php  $Relation="Relation".$rowcount; ?>
<td align=center>
<select name="<?php echo $Relation;?>" id="<?php echo $Relation;?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:100px">
    <option value="0"><-Select->
<?php
$objRelation= new Relation();
$row1=$objRelation->getRow();
for($jj=0;$jj<count($row1);$jj++)
{
echo "<option  value=".chr(34).$row1[$jj]['Rel_name'].chr(34).">".$row1[$jj]['Rel_name'];
}
?>
</select>
</td>
<?php  $Age="Age".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Age;?>" id="<?php echo $Age;?>" size=3 maxlength="3"    value="" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
</td>
<?php  $Dob="Dob".$rowcount; ?>
<td align=center>
<input type=text name="<?php echo $Dob;?>" id="<?php echo $Dob;?>" size=10 maxlength="10"  value="">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(<?php echo $Dob;?>);" alt="Click Here to Pick Date">
</td>
</tr>
<?php
} //while
$memo="No.NA.7/".date('Y')."/";
$objOfficer=new Officer();
$objOfficer->setCondString(" exist=true order by Officer_name" ); //Change the condition for where clause accordingly
$row=$objOfficer->getRow();
?>

<tr><td align=right colspan=2>
<font face=arial size=2>Memo No      
</td><td align=left  colspan="3">
<input type=text name="Memo" id="Memo" size=45 maxlength="30"   value="<?php echo $memo;?>" style="font-family: Arial;background-color:white;color:black;font-size: 12px">
</td></tr>
<tr><td align=right colspan=2>
<font face=arial size=2>Select BO Name      
</td><td align=left  colspan="3">
<select name="BO" id="BO">
<?php $dval="";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{?>
<option  value="<?php echo $row[$ind]['Officer_name'];?>"><?php echo $row[$ind]['Officer_name'].",".$row[$ind]['Designation'];?>
<?php
} //for loop
?>
</select>
</select>
</td></tr>


<tr><td align=center bgcolor=#FFFFCC>
<input type=button value=Back name=back1 id=back2 onclick=home() colspan=2>        
</td><td align=center bgcolor=#FFFFCC colspan="3">
<input type=button value="Update Detail"  name=Save1 
 style="font-family: Arial;background-color:orange;color:black;font-size: 14px;width:150px" onclick="validate()">
</td></tr>
</table>
</form>

<?php
}//$code==0


?>
</p>
</body>
</html>
