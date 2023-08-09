<html>
<title>Search of DAK</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="DakEntry.php?tag=1";
}
</script>
<body>

<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.dak.php';

require_once '../class/class.dbmanager.php';


$objDBM=new DBManager();
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

$cond="";
$i=0;
if(isset($_POST['Any']))
$par=" OR ";
else
$par=" AND ";    

if(isset($_POST['Key1']))
{
if($objUtility->isdate($_POST['Key1']))
{
$cond=$cond." Entry_date='".$objUtility->to_mysqldate($_POST['Key1'])."'";
$cond=$cond.$par;
}
$pvalue[1]=$_POST['Key1'];
$i++;
}

if(isset($_POST['Key2']))
{
if(strlen($_POST['Key2'])>0)
{    
$cond=$cond." Ltr_no like '%".$_POST['Key2']."%'";
$cond=$cond.$par;
}
$pvalue[2]=$_POST['Key2'];
$i++;
}

if(isset($_POST['Key3']))
{
if($objUtility->isdate($_POST['Key3']))
{    
$cond=$cond." Ltr_dt='".$objUtility->to_mysqldate($_POST['Key3'])."'";
$cond=$cond.$par;
}
$pvalue[3]=$_POST['Key3'];
$i++;
}

if(isset($_POST['Key4']))
{
if(strlen($_POST['Key4'])>0)
{      
$cond=$cond." Subject like '%".$_POST['Key4']."%'";
$cond=$cond.$par;
}
$pvalue[4]=$_POST['Key4'];
$i++;
}
if(isset($_POST['Key5']))
{
if(strlen($_POST['Key5'])>0)
{      
$cond=$cond." Recvd_from like '%".$_POST['Key5']."%'";
$cond=$cond.$par;
}
$pvalue[5]=$_POST['Key5'];
$i++;
}


if(isset($_POST['Key6']))
{
if($_POST['Key6']>0)
{      
$cond=$cond." Branch_code=".$_POST['Key6'];
$cond=$cond.$par;
}
$pvalue[6]=$_POST['Key6'];
$i++;
}

if(isset($_POST['Any']))
$cond=$cond." 1=2";
else 
$cond=$cond." 1=1";    

if($i==0)
$cond=" 1=2";
$_SESSION['pvalue']=$pvalue;
//echo $cond;
$objDak_entry->setCondString($cond);
$row=$objDak_entry->getAllRecord();
?><p align="center">
<font face="arial" size="1" color="grey">
<?php echo $cond; ?>
</font>
</p>
<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=110%>
<tr>
        <td align="center" bgcolor=#ccffcc>
 <?php $objDBM->genButton("gg", "Back", 50, "white","orange", 10," onclick=home()"); ?>           
        </td>        
        <td colspan=10 align=Center bgcolor=#ccffcc><font face=arial size=2><a href="dakentry.php?tag=1">Result of Search</a></font></td></tr>
<tr>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Slno
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Dak Id
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Letter No & Date
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Subject
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Letter Source
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Letter Format
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Priority
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Mark To
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Entry Date
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Due Date
</td>
<td align=center bgcolor="#FFFFCC"><font face="arial" size="2">
Disposed
</td>
</tr>
<?php
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Dak_id']."/".$row[$ii]['Recvd_yr'];
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Ltr_no']." dated ".$objUtility->to_date($row[$ii]['Ltr_dt']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2"><div align=justify>
<?php
$tvalue=$row[$ii]['Subject'];
echo $tvalue;
?>
</div></td>
<td align=left><font face="arial" size="2"><div align=justify>
<?php
$tvalue=$row[$ii]['Recvd_from'];
echo $tvalue;
?>
</div></td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Ltr_format'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">&nbsp;
<?php
$tvalue=$row[$ii]['Priority'];
if (is_numeric($tvalue))
{
if(isset($pri[$tvalue]))
echo $pri[$tvalue];
}
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Mark_branch'];
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Entry_date']);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$objUtility->to_date($row[$ii]['Target_date']);
if ($objUtility->isdate($tvalue))
echo $tvalue;
else
echo "&nbsp";
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Disposed'];
echo $tvalue;
?>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>
