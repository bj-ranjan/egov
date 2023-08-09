<html>
<title>Monthly CRPC Report</title>
<HEAD>
  <STYLE type=text/css>
    @media screen{
       thead{display:table-header-group}
       }
   @media print{
       thead{display:table-header-group}
      body{margin-top:0.5 cm;margin-left:1.5 cm;margin-right:1 cm;margin-bottom:1}
      tfoot{display:none}
   }
 </STYLE>
</HEAD>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>
<?PHP
$month=array("January","February","March","April","May","June","July","August","September","October","November","December");
if(isset($_POST['mm']))
$m=$_POST['mm'];
else
$m=round(date('m'));


$mm=substr((100+$m),-2);

if(isset($_POST['yr']))
$yr=$_POST['yr'];
else
$yr=date('Y');
?>
<div align=center>
<font face="arial" size="2" color="black"><b>
REPORT ON CRPC CASES FOR THE MONTH OF <?php echo strtoupper($month[$m-1])."/".$yr;?></b>
</div>
<table border=1 width=100% align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse;>
<tr>
<td align=center rowspan=2><font face=arial size=2>Slno</td>
<td align=center rowspan=2><font face=arial size=2>Name of Magistrate</td>
<td align=center rowspan=2><font face=arial size=2>Total Pending Cases</td>
<td align=center colspan=2><font face=arial size=2>Pending for less than 3 months</td>
<td align=center colspan=2><font face=arial size=2>Pending for more than 3 months but less than 6 months</td>
<td align=center colspan=2><font face=arial size=2>Pending for more than 6 months but less than 1 year</td>
<td align=center colspan=2><font face=arial size=2>Pending for more than 1 year but less than 2 years</td>
<td align=center colspan=2><font face=arial size=2>Pending for more than 2 years</td>
<td align=center colspan=2><font face=arial size=2>Disposed during the year</td>
</tr>
<tr>
<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

<td align=center><font face=arial size=2>Section 145</td>
<td align=center><font face=arial size=2>Other Section</td>

</tr>

<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.crpc_main.php';
?>

<?php
//$Para=<<<EOD
//<div align="justify" style="line-height:2">
//&nbsp;&nbsp;This is a sample justified Para.
//</div>
//EOD;

$objUtility=new Utility();
$objCrpc_main=new Crpc_main();



//echo $mm." ".$m;

$fastdate=$yr."-01-01";
$lastdate=$yr."-".$mm."-".$objUtility->mDays[$m];

$Tot=Array();
for($a=0;$a<13;$a++)
$Tot[$a]=0;

$sql="select Magistrate_code,count(*) from crpc_main where (status='Running' and Case_date<='".$lastdate."') or (status<>'Running' and Dispose_date>'".$lastdate."') group by Magistrate_code  having count(*)>0 order by rsl";
$row=$objCrpc_main->FetchRecords($sql);
$i=0;
for($ii=0;$ii<count($row);$ii++)
{
$exist=$objCrpc_main->FetchColumn("Officer","exist","slno=".$row[$ii][0],0);
if($exist)
{
$i++;
$Tot[0]+=$row[$ii][1];
?>
<tr>
<td align=center><font face=arial size=2><?php echo $i;?></td>
<td align=left><font face=arial size=2>
<?php 
$name=$objCrpc_main->FetchColumn("Officer","Officer_name","slno=".$row[$ii][0],"");
echo $name;
?>
</td>
<td align=center><font face=arial size=2><?php echo $row[$ii][1];?></td>

<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"145",0,90,$lastdate) ;?></td>
<?php $Tot[1]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"105",0,90,$lastdate) ;?></td>
<?php $Tot[2]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"145",90,180,$lastdate) ;?></td>
<?php $Tot[3]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"105",90,180,$lastdate) ;?></td>
<?php $Tot[4]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"145",180,365,$lastdate) ;?></td>
<?php $Tot[5]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"105",180,365,$lastdate) ;?></td>
<?php $Tot[6]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"145",365,730,$lastdate) ;?></td>
<?php $Tot[7]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"105",365,730,$lastdate) ;?></td>
<?php $Tot[8]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"145",730,36500,$lastdate) ;?></td>
<?php $Tot[9]+=$t;?>
<td align=center><font face=arial size=2><?php echo $t=Calculate($row[$ii][0],"105",730,36500,$lastdate) ;?></td>
<?php $Tot[10]+=$t;?>
<?php
$condition="magistrate_code=".$row[$ii][0]." and section='145' and status<>'Running' and dispose_date between '".$fastdate."' and '".$lastdate."'";
$t1=$objCrpc_main->CountRecords("crpc_main",$condition);
$Tot[11]+=$t1;
$condition="magistrate_code=".$row[$ii][0]." and section<>'145' and status<>'Running' and dispose_date between '".$fastdate."' and '".$lastdate."'";
$t2=$objCrpc_main->CountRecords("crpc_main",$condition);
$Tot[12]+=$t2;
?>
<td align=center><font face=arial size=2><?php echo $t1;?></td>
<td align=center><font face=arial size=2><?php echo $t2;?></td>
</tr>
<?php
}
}
?>
<tr><td align=right colspan=2><font face=arial size=2><b>Total</b></td>
<?php
for($a=0;$a<13;$a++)
{
?>
<td align=center><font face=arial size=2><b><?php echo $Tot[$a];?></b></td>
<?php } ?>
</tr>
</table>

<?php
//function block
function Calculate($mcode,$section,$days1,$days2,$lastdate)
{
require_once './class/class.crpc_main.php';
require_once '../class/utility.class.php';
$objC=new Crpc_main();
$objU=new Utility();

if($section==145)
$cond=" and section='145'";
else
$cond=" and section<>'145'";

$count=0;
$sql="select case_date from crpc_main where ((status='Running' and Case_date<='".$lastdate."') or (status<>'Running' and Dispose_date>'".$lastdate."')) and Magistrate_code=".$mcode.$cond;

//echo "Magistrate-".$mcode."<br>";

$mrow=$objC->FetchRecords($sql);
for($i=0;$i<count($mrow);$i++)
{
$dt=$mrow[$i][0];
$diff=$objU->dateDiff($lastdate,$dt);
if($diff>=$days1 && $diff<$days2)
$count++;

//echo $lastdate."-".$dt."=".$diff."(Tot=".$count.")<br>";


}
return($count);
}


?>
<p align=center>
<BR><BR>
<table border=0 width=30% align=right cellpadding=2 cellspacing=0 style=border-collapse: collapse;>
<tr>
<td align=center>Deputy Commissioner<br>Nalbari</td>
</tr>
</table>
</p>
</body>
</html>
