<html>
<title>Weekly reportr</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="SelectPetType.php?tag=1";
}
</script>
<body>

<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
$mvalue=array();
$mytag=0;
$objUtility=new Utility();
if (isset($_POST['Pet_type'])) //If HTML Field is Availbale
{
$mvalue[2]=$_POST['Pet_type'];
$ptype=$mvalue[2];
}
else
$mytag++;

if($mytag==0)
{
$objPt=new Petition_type();
$objPt->setCondstring("Running='Y'");
$row=$objPt->getRow();
}

if (isset($_POST['Start_date'])) //If HTML Field is Availbale
{
$mvalue[3]=$_POST['Start_date'];
$date1=$objUtility->to_mysqldate($mvalue[3]);
}
else
$mytag++;

if (isset($_POST['End_date'])) //If HTML Field is Availbale
{
$mvalue[4]=$_POST['End_date'];
$date2=$objUtility->to_mysqldate($mvalue[4]);
}
else
$mytag++;
$_SESSION['mvalue']=$mvalue;

$period="From ".$mvalue[3]." to ".$mvalue[4];

$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:yellow;color:black;width:100px";
?>

<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center>
<input type=button value=Back  name=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td>
<td colspan=6 align=Center bgcolor=#ccffcc><font face=arial size=3>Periodic Report<br><font face=arial size=2>Period <?php echo $period;?></font></td></tr>
<tr>
<td align=center><font face=arial size=2>
Petition Type
</td>
<td align=center><font face=arial size=2>
Opening Petition
</td>
<td align=center><font face=arial size=2>
Received During the period
</td>
<td align=center><font face=arial size=2>
Total
</td>
<td align=center><font face=arial size=2>
Dealt with<br>(Processed)
</td>
<td align=center><font face=arial size=2>
Pending<br>(Total)
</td>
<td align=center><font face=arial size=2>
Pending<br>(Received within Period)
</td>
</tr>

<?php


if($mytag>0)
header('Location:Selectpettype.php?tag=1');

$objPetition_master=new Petition_master();

for($i=0;$i<count($row);$i++)
{
$ptype=$row[$i]['Code'];
$objPt->setCode($ptype);
if($objPt->EditRecord())
$petname=$objPt->getDetail();
else
$petname="";
?>
<tr>
<td align=left><font face=arial color=blue size=2>
<?php
echo $petname;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
$cond="  Ast='N' and Pet_type='".$ptype."' and Pet_date<'".$date1."'";
$opn=$objPetition_master->rowCount($cond);
//$cond="  Ast='Y' and Pet_type='".$ptype."' and Process_date>='".$date1."' and Pet_date<'".$date1."' and Status in('Processed','Rejected','Issued')";
$cond="  Ast='Y' and status<>'Disposed' and Pet_type='".$ptype."' and Pet_date<'".$date1."' and Process_date >='".$date1."'";

$opn=$opn+$objPetition_master->rowCount($cond);
echo $opn;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
$cond=" Pet_type='".$ptype."' and Pet_date>='".$date1."' and Pet_date<='".$date2."'";
$rec=$objPetition_master->rowCount($cond);
echo $rec;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
echo $rec+$opn;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
$cond=" Ast='Y' and Pet_type='".$ptype."' and Process_date>='".$date1."' and Process_date<='".$date2."' and Status in('Processed','Rejected','Issued')";
$proc=$objPetition_master->rowCount($cond);
echo $proc;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
echo $rec+$opn-$proc;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
$cond=" Ast='N' and Pet_type='".$ptype."' and Pet_date>='".$date1."' and Pet_date<='".$date2."'";
echo $objPetition_master->rowCount($cond);
?>
</td>
</tr>
<?php
}//for Loop
?>
</table>

</body>
</html>
