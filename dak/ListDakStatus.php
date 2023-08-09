<html>
<title>Search of DAK</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="editdak.php?tag=0";
}
</script>
<body>


<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.dak.php';
require_once '../class/class.Branch_section.php';

$objBranch_section= new Branch_section();


$objUtility=new Utility();
$objDak_entry=new Dak_entry();
unset($_SESSION['mvalue']);
$pri=array();
$pri[0]="";
$pri[1]="Immidiate";
$pri[2]="Urgent";
$pri[3]="Fixed";
$pri[4]="Other";
$pri[5]="Filed";

$pvalue=array();
$pvalue[0]="";
$pvalue[1]="";
$pvalue[2]="";
$pvalue[3]="";
$pvalue[4]="";
$pvalue[5]="";
$pvalue[6]="";
$pvalue[7]="";

//$objDak_entry->getColor($targetDate, $disposeDate, $dispose)


$cond="";
$i=0;
if(isset($_GET['br']))
$br=$_GET['br'];
else
$br=-1;    


$cond=" Reply='Yes' and Priority<>5 and Branch_code=".$br." order by Target_date desc";
$bname="";

$_SESSION['Branch']=$br;

$objBranch_section->setBranch_code($br);
if($objBranch_section->EditRecord())
$bname=$objBranch_section->getBranch_name();

//echo $cond;
$objDak_entry->setCondString($cond);
$row=$objDak_entry->getAllRecord();
//echo $objDak_entry->returnSql;
?>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=110%>
<tr>
<td align=center colspan=2><input type=button value=Back id=lll onclick=home()></td>
<td colspan=7 align=Center ><font face=arial size=4><a href="EditDak.php?tag=0">Status of DAK Disposal under <?php echo $bname;?></a></font></td></tr>
<tr>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Sl No
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Dak Id
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Letter No & Date
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Subject
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Receive From
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Priority
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Target Date
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Dispose Date
</td>
<td align=center bgcolor="white"><font face="arial" size="2"><b>
Disposed
</td>
</tr>


<?php
for($ii=0;$ii<count($row);$ii++)
{
$bgcol=$objDak_entry->getColor($row[$ii]['Target_date'],$row[$ii]['Dispose_date'],$row[$ii]['Disposed']);

?>

<tr>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=left bgcolor=<?php echo $bgcol;?>><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Dak_id']."/".$row[$ii]['Recvd_yr'];
echo $tvalue;
?>
</td>
<td align=left bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Ltr_no']." dated ".$objUtility->to_date($row[$ii]['Ltr_dt']);
echo $tvalue;
?>
</td>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<div align="justify">
<?php
$tvalue=$row[$ii]['Subject'];
echo $tvalue;
?>
</div></td>
<td align=left bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Recvd_from'];
echo $tvalue;
?>
</td>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">&nbsp;
<?php
$tvalue=$row[$ii]['Priority'];
if (is_numeric($tvalue))
{
if(isset($pri[$tvalue]))
echo $pri[$tvalue];
}
?>
</td>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Target_date']);
if ($objUtility->isdate($tvalue))
echo $tvalue;
else
echo "&nbsp";
?>
</td>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Dispose_date']);
if ($objUtility->isdate($tvalue))
echo $tvalue;
else
echo "&nbsp";
?>
</td>
<td align=center bgcolor="<?php echo $bgcol;?>"><font face="arial" size="2">
<?php
if ($row[$ii]['Dispose']=="N")
echo "No";
else
echo "Yes";
?>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>
