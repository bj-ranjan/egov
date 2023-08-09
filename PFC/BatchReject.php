<html>
<head>
<title>Whole Sale Reject</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}

function back()
{
window.location="BatchReject.php?tag=0";
}
function validate(i)
{
myform.action="BatchReject.php?tag="+i;
myform.submit();
}


</script>
<BODY>
<script language=javascript>
<!--
</script>
<body onload=setMe()>
<p align=center>
<?php
header('Refresh: 600;url=../IndexPage.php?tag=1');
session_start();
require_once './class/class.petition_master.php';
require_once '../class/utility.class.php';
require_once '../class/class.dbmanager.php';
require_once 'header.php';
//require_once './class/class.petition_type.php';
//require_once './class/class.circle.php';
//require_once './class/class.police_station.php';
//require_once './class/class.mouza.php';
//require_once './class/class.petition_status.php';

$objUtility=new Utility();
$bcol="white";
$fcol="black";
$font="12";

$objDbm=new DBManager();
$roll=$objUtility->VerifyRoll();
$allowedroll=2;
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../indexPage.php');

if ($objUtility->checkArea($_SESSION['myArea'], 23)==false) //19 for petition Edit
header( 'Location: Mainmenu.php?unauth=1');



$objPm=new Petition_master();

if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=0;
if ($code==0) //Initial Loading
{
echo "<table border=0 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; ALIGN=CENTER width=80%>";
echo "<form name=startform action=BatchReject.php?tag=1  method=POST >";
echo "<tr>";
if($roll==0)
$query="SELECT CODE ,DETAIL  FROM PETITION_TYPE WHERE RUNNING = 'Y'";
else
$query="SELECT CODE ,DETAIL  FROM PETITION_TYPE WHERE CODE in('JB','ER') and RUNNING = 'Y'";
    
$objDbm->TdText(3, 2, "Select Petition Type", 0, 0, 0);
$objDbm->TdSelectBox(1, $bcol, "Pet_type", 0, $query, 250, "");
echo "<td align=left>";
echo "<input type=submit value=GO >";
echo "<input type=button value=Menu name=back1 id=back2 onclick=home()>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
} //$code=0
if ($code==1) //Next Loading aftre postback
{
$pt=$_POST['Pet_type'];
$sql="SELECT PET_YR ,PET_NO,APPLICANT,PET_DATE,STATUS FROM PETITION_MASTER WHERE status='Pending' and AST='N' and PET_TYPE = '".$pt."' and PET_DATE<='".date('Y-m-d')."' order by PET_NO";
?>
<table border=1 cellpadding=0 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<form name=myform action=BatchReject.php?tag=2  method=POST >
<tr>
<?php
$objDbm->bcol="yellow";
$objDbm->TdText(2, 2, "Sl No", 0, 0, 0);
$objDbm->TdText(2, 2, "Petition No", 0, 0, 0);
$objDbm->TdText(2, 2, "Applicant Name", 0, 0, 0);
$objDbm->TdText(2, 2, "Date", 0, 0, 0);
$objDbm->TdText(2, 2, "Status", 0, 0, 0);
$objDbm->TdText(2, 2, "Click", 0, 0, 0);
$objDbm->bcol="white";
?>
</tr>

<?php
$rowcount=0;
$row=$objDbm->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
?>
<tr>
<?php
$objDbm->TdText(2, 2, $rowcount, 0, 0, 0);
$objDbm->TdText(2, 2, $row[$ii][1]."/".$row[$ii][0], 0, 0, 0);
$id="Pet_yr".$rowcount;
$objDbm->genHiddenBox($id, $row[$ii][0]);
$id="Pet_no".$rowcount;
$objDbm->genHiddenBox($id, $row[$ii][1]);
$objDbm->TdText(1, 2, $row[$ii][2], 0, 0, 0);
$date1=$objUtility->to_date($row[$ii][3]);
$objDbm->TdText(1, 2, $date1, 0, 0, 0);
$objDbm->TdText(2, 2, $row[$ii][4], 0, 0, 0);
$id="Sel".$rowcount;
$objDbm->TdCheckBox(2, $bcol, $id, false, "");
?>
</tr>
<?php
} //while
$objDbm->genHiddenBox("Tot", $rowcount);
?>
<tr>
<?php
$objDbm->TdText(2, 2, "", 0, 2, 0);
$objDbm->bcol="orange";
$objDbm->TdButton(2, "white", "Save", "Reject Selected", 120, " onclick=validate(2)");
$objDbm->bcol="grey";
$objDbm->TdButton(2, "white", "Back1", "Back", 80, " onclick=back()");

$objDbm->bcol="red";
if($roll==0)
$objDbm->TdButton(2, "white", "Delete1", "Delete", 80, " onclick=validate(3)");

?>
</tr>
</table>
<?php
}//$code==1


if ($code==2) //PostBack Submit to Reject
{
if(isset($_SESSION['username'])) 
    $uid=$_SESSION['username'];
else
   $uid="";    
//echo $_SESSION['rowcount'];
$counter=0;
for ($ind=1;$ind<=$_POST['Tot'];$ind++)
{
$sel="Sel".$ind;
$yr="Pet_yr".$ind;
$no="Pet_no".$ind;
if(isset($_POST[$sel]))
{
 $objPm->setPet_yr($_POST[$yr]);
 $objPm->setPet_no($_POST[$no]);
 $objPm->setStatus("Rejected");
 $objPm->setAst("Y");
 $objPm->setProcess_date(date('Y-m-d'));
 $objPm->setRejected_reason("Inadequate Data");
 $objPm->setProcessed_by($uid);
 if($objPm->UpdateRecord())
 {
     $counter++;
 $objUtility->CreateLogFile("Petition_master", $objPm->returnSql, 2, "M");    
 }
}//if

}
echo $objUtility->AlertNRedirect("Rejected ".$counter." Petition","BatchReject.php?tag=0");    
       
}//code=2


if ($code==3) //PostBack Submit to Delete
{
 
//echo $_SESSION['rowcount'];
$counter=0;
for ($ind=1;$ind<=$_POST['Tot'];$ind++)
{
$sel="Sel".$ind;
$yr="Pet_yr".$ind;
$no="Pet_no".$ind;
if(isset($_POST[$sel]))
{
$sql="delete from petition_master where status='Pending' and ast='N' and Pet_yr='".$_POST[$yr]."' and Pet_no=".$_POST[$no]; 
 if($objPm->ExecuteQuery($sql))
     $counter++;
}//if

}
echo $objUtility->AlertNRedirect("Deleted ".$counter." Petition","BatchReject.php?tag=0");    
       
}//code=2


?>
</p>
</form>
</body>
</html>
