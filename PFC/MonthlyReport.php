<html>
<title>Weekly reportr</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="SelectMonth.php?tag=1";
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

if($mytag==0)
{
$objPt=new Petition_type();
$objPt->setCondstring("Running='Y'");
$row=$objPt->getRow();
}

if (isset($_POST['Yr'])) //If HTML Field is Availbale
{
$mvalue[0]=$_POST['Yr'];
}
else
$mytag++;

if (isset($_POST['Month'])) //If HTML Field is Availbale
{
$mvalue[1]=$_POST['Month'];
}
else
$mytag++;

$_SESSION['mvalue']=$mvalue;

$period=$objUtility->Month($mvalue[1])."/".$mvalue[0];

$mystyle="font-family:arial; font-size: 10px ;font-weight:bold; background-color:yellow;color:black;width:50px";

$date1=$mvalue[0]."-".$mvalue[1]."-01";
$date2=$mvalue[0]."-".$mvalue[1]."-".$objUtility->mDays[$mvalue[1]];


$mm=$mvalue[1];
$yy=$mvalue[0];

?>

<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center>
<input type=button value=Back  name=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td>
<td colspan=8 align=Center ><font face=arial size=3>
NALBARI DISTRICT ADMINISTRATION<Br>
REPORT ON PUBLIC FACILITAION CENTER<BR>
    Period- <?php echo $period;?></font></td></tr>
<tr>
<td align=center><font face=arial size=2>
Slno
</td>    
<td align=center><font face=arial size=2>
Petition Type
</td>
<td align=center><font face=arial size=2>
No of Petition Pending at the begining of Month
</td>
<td align=center><font face=arial size=2>
No of Petition Received During the Month
</td>
<td align=center><font face=arial size=2>
Total Petition to be disposed
</td>
<td align=center><font face=arial size=2>
No of Petition disposed During the Month
</td>
<td align=center><font face=arial size=2>
 No of Petition Pending at the end of month
</td>
<td align=center><font face=arial size=2>
Percentage of Disposal during the Month
</td>
</tr>

<?php


//if($mytag>0)
//header('Location:SelectMonth.php?tag=1');

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
<td align=center><font face=arial color=blue size=2>
<?php
echo $i+1;
?>
</td>    
<td align=left><font face=arial color=blue size=2>
<?php
echo $petname;
?>
</td>
<td align=center><font face=arial color=blue size=2>
<?php
//month(Pet_date)=12 and year(Pet_date)=2013 
//$cond="  Ast='N' and Pet_type='".$ptype."' and month(Pet_date)=".$mm." and year(Pet_date)=".$yy;
$cond="  Ast='N' and Pet_type='".$ptype."' and Pet_date<'".$date1."'";
$opn=$objPetition_master->rowCount($cond);
//echo $objPetition_master->returnSql;
//echo $opn."<br>";
//$cond="  Ast='Y' and status<>'Disposed' and Pet_type='".$ptype."' and Pet_date<'".$date1."' and month(Process_date)=".$mm." and year(Process_date)=".$yy;
$cond="  Ast='Y' and status<>'Disposed' and Pet_type='".$ptype."' and Pet_date<'".$date1."' and Process_date >='".$date1."'";

$opn=$opn+$objPetition_master->rowCount($cond);
//echo $objPetition_master->returnSql;
//echo $objPetition_master->rowCount($cond)."<br>";
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
//echo $objPetition_master->returnSql."<br>";
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
if(($rec+$opn>0))
{
$perc=number_format(($proc/($rec+$opn)*100),2);
echo $perc;
}
else
echo "0.00"    
?>
%</td>
</tr>
<?php
}//for Loop
?>
</table>
    <p allign="center"><bR><br><Br></p>
<table border=0 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center width="60%">
&nbsp;
</td>
<td align=center width="40%"><font face=arial color=black size=2>
Addl. Deputy Commissioner<br>Nalbari
</td>
</body>
</html>
