
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
$objUtility=new Utility();

$row=array();
$row[0]="PRC";
$row[1]="Jamabandi";
$row[2]="Eroll";
$row[3]="Bakijai";
$row[4]="Caste";
$row[5]="Non Creamy";
$row[6]="Legal Heir";
$row[7]="Domicile";

$pettype[0]="PR";
$pettype[1]="JB";
$pettype[2]="ER";
$pettype[3]="BK";
$pettype[4]="CT";
$pettype[5]="NC";
$pettype[6]="LH";
$pettype[7]="DM";

$objPm=new Petition_master();

$d1=$objUtility->to_mysqldate($_POST['date1']);
$d2=$objUtility->to_mysqldate($_POST['date2']);

?>
    <table border="1" width="40%" align="center" cellpadding="2">
<tr><td align="center" width="100%" colspan="2" bgcolor="#66CCFF"><font face="arial" size="2">Issue Summary</td>        
 <tr><td align="center" width="80%" bgcolor="#66CCFF"><font face="arial" size="2">Petition Type</td>
  <td align="center" width="20%" bgcolor="#66CCFF"><font face="arial" size="2">Issued</td></tr>
<?php
for($i=0;$i<count($row);$i++)
{
?>
<tr><td align="left" width="80%"><font face="arial" size="2"><?php echo $row[$i];?></td>
  <td align="center"><font face="arial" size="2">
 <?php
$cond="Pet_type='".$pettype[$i]."' and Issue_date>='".$d1."' and Issue_date<='".$d2."'" ;
echo $objPm->rowCount($cond);
?>
  </td></tr>

<?php
}
?>
    </table>