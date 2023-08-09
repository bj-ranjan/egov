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
require_once '../class/utility.php';
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
$mvalue=array();
$mytag=0;
$objUtility=new Utility();

if($mytag==0)
{
//$objPt=new Petition_type();
//$objPt->setCondstring("Running='Y'");
//$row=$objPt->getRow();
}

$row=array();
$row[0]="PRC(Under ARTPS)";
$row[1]="Jamabandi Copy";
$row[2]="Certified Electoral Roll";
$row[3]="Others(Bakijai & Old Caste/Non Creamy Layer)";

$pettype[0]="PR";
$pettype[1]="JB";
$pettype[2]="ER";
$pettype[3]="BK";
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

?>

<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center>
<input type=button value=Back  name=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td>
<td colspan=4 align=Center ><font face=arial size=3>
NALBARI DISTRICT ADMINISTRATION<Br>
COLLECTION REPORT ON PUBLIC FACILITAION CENTER<BR>
    Period- <?php echo $period;?></font></td></tr>
<tr>
<td align=center ><font face=arial size=2>
Slno
</td>    
<td align=center><font face=arial size=2>
Petition Type
</td>
<td align=center><font face=arial size=2>
Total Issued(Nos)
</td>
<td align=center><font face=arial size=2>
Collection(In Rs.)
</td>
</tr>

<?php


//if($mytag>0)
//header('Location:SelectMonth.php?tag=1');
$objM=new myutility();
$objPetition_master=new Petition_master();
$tot=0;
$nos=0;
for($i=0;$i<count($row);$i++)
{
$petname=$row[$i];
$ptype=$pettype[$i];
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
<td align=right><font face=arial color=blue size=2>
<?php
if($i<3)
$cond="  Status='Issued' and Pet_type='".$ptype."' and Issue_date>='".$date1."' and Issue_date<='".$date2."'";
else
$cond="  Status='Issued' and Pet_type in('BK','CT','NC') and Issue_date>='".$date1."' and Issue_date<='".$date2."'";




echo $objPetition_master->rowCount($cond);
$nos=$nos+$objPetition_master->rowCount($cond);
?>
</td>
<td align=right><font face=arial color=blue size=2>
<?php
$opn=$objPetition_master->Sum("fees", $cond);
$tot=$tot+$opn;
echo $objM->convert2standard($opn);
?>
</td>
</tr>
<?php
}//for Loop
?>
<tr>
<td align=right colspan="2"<font face=arial color=blue size=2>
Total
</td>
<td align=right><b><font face=arial color=blue size=2><b>
<?php
echo $nos;
?>
</td>
<td align=right><b><font face=arial color=blue size=2><b>
<?php
$amount=$objM->letter($tot);
echo $objM->convert2standard($tot);
?>
</td>    
</table>
<p align="center">In words Rupees(<?php echo $amount;?></p>    
    <p align="center"><bR><br><Br></p>
<table border=0 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center width="60%">
&nbsp;
</td>
<td align=center width="40%"><font face=arial color=black size=2>
    <b>Addl. Deputy Commissioner<br>Nalbari</b>
</td>
</body>
</html>
