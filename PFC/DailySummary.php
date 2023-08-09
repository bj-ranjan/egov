
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_type.php';
$objUtility=new Utility();
$roll=$objUtility->VerifyRoll();
$objPt=new Petition_type();
$row=array();

if(isset($_POST['date']))
$date=$objUtility->to_mysqldate($_POST['date']);
else
$date=date('Y-m-d');

$row=$objPt->ReceivedSummary($date);
echo "<b><u>Received</u></b>:<br>";
for($i=0;$i<count($row);$i++)
echo $row[$i]['Pet_type']."(<font color=red>".$row[$i]['Total']."</font>) ";
echo "<br><br>";
$row=$objPt->ProcessedSummary($date);
echo "<b><u>Processed</u></b>:<br>";
for($i=0;$i<count($row);$i++)
echo $row[$i]['Pet_type']."(<font color=red>".$row[$i]['Total']."</font>) ";
echo "<br><br>";
$row=$objPt->IssueSummary($date);
echo "<b><u>Issued</u></b>:<br>";
for($i=0;$i<count($row);$i++)
echo $row[$i]['Pet_type']."(<font color=red>".$row[$i]['Total']."</font>) ";
echo "<br><br>";
$row=$objPt->PendingSummary($date);
echo "<b><u>Pending</u></b>:<br>";
for($i=0;$i<count($row);$i++)
echo $row[$i]['Pet_type']."(<font color=red>".$row[$i]['Total']."</font>) ";
echo "<br><br>";

?>
