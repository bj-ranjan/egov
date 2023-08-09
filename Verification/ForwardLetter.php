
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.verification_letter.php';


$objVL=new Verification_letter();
$objU=new Utility();

$roll=$objU->VerifyRoll();
if(isset($_GET['id']))
$id=$_GET['id'];
else
$id=0;


if(isset($_GET['noback']))
$noback=$_GET['noback'];
else
$noback=0; 

$objVL->setId($id);
$objVL->EditRecord();

$receiver=$objVL->getSent_to();


$myid=$objVL->getId_verify();
$sign="Addl. District Magistrate<br>Nalbari";

echo "<table border=0 align=center width=90%>";
echo "<tr><td align=center  colspan=4 >";
if($noback==0)
echo "<a href=forward.php>";
echo "<image src=../image/ashoka.jpg width=55 height=75 border=0></a>";
echo "</td></tr><tr><td align=center  colspan=4 >";
echo "GOVT OF ASSAM";
echo "</td></tr><tr><td align=center  colspan=4 >";
echo "OFFICE OF THE DISTRICT MAGISTRATE:::::::NALBARI";
echo "</td></tr><tr><td align=center  colspan=4 >";
echo "(MAGISTRACY BRANCH)";
echo "</td></tr><tr><td align=center  colspan=4 >";
echo "Phone-(03624-220496(O)/220218(R)-220469/220371(F)" ;
echo "<br>Email:dc-nalbari@nic.in "; 
echo "</td></tr>";

echo "</table>";
echo "<table border=0 align=center width=100%>";
echo "<tr><td align=left  colspan=4 >&nbsp;</td></tr>";
echo ("<tr><td align=left  colspan=2 >Letter No&nbsp".$objVL->getLetter_no()."</td>");
echo ("<td align=right  colspan=2 >Date:&nbsp".$objU->to_date($objVL->getLetter_date())."</td>");
echo "<tr><td align=left  colspan=4 >To,<br>The&nbsp;".$receiver."</td></tr>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td align=left  colspan=4 >Sub:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Verification of Character and antecedents</b> </td></tr>";
echo "<tr><td align=left  colspan=4 >Sir,</td></tr>";

echo "<tr><td align=left  colspan=4 >";
?>
<div align=justify style='line-height: 1.5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
In enclosing herewith the Character & Verification roll in respect of undermentioned person(s) 
for verification of his/their character and antecedents. I am to request you to kindly arrange for verification of  the 
same and submit report within 7 days from the date of receipt of this letter. 
</div>
<?php
echo "</table>" ;

$valueList=array();
$headlist=array("ID","Name & Address","Circle","Police Station","Letter No & date","Authority by whom it is received");
$align=array(2,1,2,2,1);
$sql="select id,name,reln,rel_name,village,circle,pol_stn,letter_no,letter_date,department from verification where Id in";
$sql.="(".$myid.")";

//echo $sql;
$title="Particulars of Candidate";

$row=$objVL->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
$valueList[$ii][0]=$row[$ii][0];
$tvalue="<b>".$row[$ii][1]."</b><br>".strtolower($row[$ii][2])."- ".$row[$ii][3]."<br>Vill-".$row[$ii][4];
$valueList[$ii][1]=$tvalue;

$cond="Cir_code='".$row[$ii][5]."'";
$tvalue=$objVL->FetchColumn("circle","circle", $cond,"");
$valueList[$ii][2]=$tvalue;

$cond="Code='".$row[$ii][6]."'";
$tvalue=$objVL->FetchColumn("police_station","Name", $cond,"");
$valueList[$ii][3]=$tvalue;

$valueList[$ii][4]=$row[$ii][7];
$tvalue=$objU->to_date($row[$ii][8]);
$valueList[$ii][4].="<br>Dated ".$tvalue;
$valueList[$ii][5]=$row[$ii][9];
}

$objVL->TableHeadColor="grey";
$objVL->genDataGridOnValueList($title, $headlist, $align, $valueList, 100, count($valueList));


echo "<table border=0 align=center width=100%>";
echo "<tr><td align=center>&nbsp;</td><td align=center >Your's faithfully<br></td></tr>";
echo "<tr><td align=center width=50% height=30>&nbsp;</td><td align=center width=40%>&nbsp;<br></td></tr>";
echo ("<tr><td align=center   width=50%>&nbsp;</td>");
echo ("<td align=center   width=40%>".$sign."</td><tr>");
echo ("<td align=right   width=10%>&nbsp;</td></tr>");
echo "</table>" ;


echo "<table border=0 align=center width=100%>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo ("<tr><td align=left  colspan=2 width=70%>Memo No&nbsp".$objVL->getLetter_no()."</td>");
echo ("<td align=right   width=20%>Date:&nbsp".$objU->to_date($objVL->getLetter_date())."</td>");
echo ("<td align=right   width=10%>&nbsp;</td></tr>");
echo ("<tr><td align=left  colspan=4 >Copy to-</td></tr>");

echo ("<tr><td align=left  colspan=4 >1)&nbsp;CA to DC for kind apprisal of DC, Nalbari</td></tr>");



echo "<table border=0 align=center width=100%>";
echo "<tr><td align=center>&nbsp;</td><td align=center >&nbsp;<br></td></tr>";
echo "<tr><td align=center width=50% height=30>&nbsp;</td><td align=center width=40%>&nbsp;<br></td></tr>";
echo ("<tr><td align=center   width=50%>&nbsp;</td>");
echo ("<td align=center   width=40%>".$sign."</td><tr>");
echo ("<td align=right   width=10%>&nbsp;</td></tr>");
echo "</table>" ;


?>
