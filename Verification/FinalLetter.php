
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.verification.php';


$objVL=new Verification();
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
//$myid=$objVL->FetchColumn("verification_letter", "Id_verify", "id=".$id, "0");


$subject="<tr><td align=left width=7%>Sub:</td><td slign=left><b>Verification of Character and antecedents</b></td></tr>";



$sign="Addl. District Magistrate<br>Nalbari";

$cond="ID =".$id;
//$sql="SELECT LETTER_NO ,LETTER_DATE ,DEPARTMENT ,ADDRESS ,PIN,issue_no,issue_date FROM VERIFICATION WHERE ";
//$sql.=$cond;
$row=$objVL->getAllRecord($cond);

$receiver="<tr><td align=left width=7%>&nbsp;</td><td align=left colspan=3>";

$reference="<tr><td align=left width=7%>Ref::</td><td align=left colspan=3>";
if(count($row)>0)
{
if(strlen($row[0]['Sender'])>1)
$receiver.=$row[0]['Sender']."<br>";
$receiver.=$row[0]['Department']."<br>".$row[0]['Address'];
if(strlen($row[0]['Pin'])==6)
$receiver.="<br>Pin-".$row[0]['Pin'];  
$reference.="Your Letter No.".$row[0]['Letter_no'];
$date=$objU->to_date($row[0]['Letter_date']);
$reference.=" dated ".$date;
}
$receiver.="</td></tr>";
$reference.="</td></tr>";

if($row[0]['Pol_stn']>0)
{
$cond="code=".$row[0]['Pol_stn'];
$ps=$objVL->FetchColumn("police_station", "name", $cond, "");
}
else
$ps=$row[0]['Ps'];   

echo "<table border=0 align=center width=90%>";
echo "<tr><td align=center  colspan=4 >";
if($noback==0)
echo "<a href=final.php>";
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
echo "<table>";
echo "<table border=0 align=center width=90%>";
echo "<tr><td align=left  colspan=4 >&nbsp;</td></tr>";
echo ("<tr><td align=left  colspan=2 >Letter No&nbsp".$row[0]['Issue_no']."</td>");
echo ("<td align=right  colspan=2 >Date:&nbsp".$objU->to_date($row[0]['Issue_date'])."</td>");
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td align=left  colspan=4 >To,</td></tr>";
echo $receiver;
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo $reference;
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo $subject;
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td align=left  colspan=4 >Sir,</td></tr>";
echo "<tr><td align=left  colspan=4 >";
?>
<div align=justify style='line-height: 2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
With reference to your above cited letter, I have the honour to say that the verification of character and
antecedents etc. in respect of 
<b>
<?php 
echo $row[0]['Name']."</b>&nbsp;".strtolower($row[0]['Reln'])." <b>".$row[0]['Rel_name']."</b> of Village <b>".$row[0]['Village']; 
echo "</b> under Police Station <b>".$ps;
?></b>&nbsp;
in the District of Nalbari,Assam(India)  
has been done by the Deputy Superintendent of Police ,
Special Branch,Assam, Kahilipara Guwahati and 
it is found that there is <b><u>
<?php echo $row[0]['Report_type'];?></u></b>
against him /her either politically or criminally 
which would render him/her unsuitable for employment in 
Government service/quasi government organisation.
</div>

<?php
echo "</tr>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td colspan=4 align=left>The verification roll is returned herewith</td>";
echo "</tr>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";
echo "<tr><td align=left  colspan=4 >&nbsp;<br></td></tr>";

echo "<tr><td colspan=4 align=left><u>Enclosure: As stated above</u></td>";
echo "</tr>";

 
echo "</table>" ;


echo "<table border=0 align=center width=90%>";
echo "<tr><td align=center width=60% >&nbsp;</td><td align=center  width=30% >Your's faithfully<br></td></tr>";
echo "<tr><td align=left   height=40><br></td></tr>";
echo ("<tr><td align=center   width=60%>&nbsp;</td>");
echo ("<td align=center   width=40%><br>".$sign."</td><tr>");
echo "</table>" ;


?>
