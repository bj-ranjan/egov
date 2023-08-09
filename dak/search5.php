<html >
<head>
</head>
<body>
<fieldset name=frame style="width:100%;border-COLOR:none;height:500;" align=center>

<table align=center width=100%>
<TD ALIGN=CENTER VALIGN=BOTTOM><FONT COLOR=pink SIZE=6 FACE="MONOTYPE CORSIVA">Dak(Search result by Letter Date)</TD></tr>
</TABLE>

<script language=javascript>
function home()
{
window.location="dakentry.php";
}
</script>

<?php
session_start();
//require_once './class/class.conn.php';
require_once '../class/utility.class.php';
require_once '../class/class.PWD.php';

$pd=new Pwd();
$_SESSION['searchDT'] = $_POST['searchltrdt'];
$dtarray=array();
//$dtarray=explode("-", $_SESSION['searchDT']);
$dtarray=explode("/", $_SESSION['searchDT']);
$e_Ltr_dt=$dtarray[2]."-".$dtarray[1]."-".$dtarray[0];
$i=1;

//echo $e_Ltr_dt;
?>


<?php
$output ='';
echo '<table align=center  border="1">'; 
//echo  '<td>Subject </td><td>Received From </td><td>Letter No. </td><td>Letter Date </td><td>Letter Format </td><td>Marked  Branch </td><td>Priority </td><td>Entry date </td>';

echo  '<tr bgcolor=silver>';
echo  '<td><font face=verdana size=4 color=black>SL No. </td>
<td><font face=verdana size=4 color=black>DAK ID </td>
<td><font face=verdana size=4 color=black>Subject </td>
<td><font face=verdana size=4 color=black> Received From</td>
<td><font face=verdana size=4 color=black>Letter No. </td>
<td><font face=verdana size=4 color=black>Letter Date </td>
<td><font face=verdana size=4 color=black>Letter Format </td>
<td><font face=verdana size=4 color=black>Marked  Branch </td>
<td><font face=verdana size=4 color=black>Priority </td>';

echo '</tr>';

if (isset($_post['search'])){
   $kkk= $_post['search'];
}
//$query = mysql_query("SELECT * FROM dak_entry WHERE ltr_dt  LIKE '$e_Ltr_dt%' " ) or die("could not search");
$query = mysql_query("SELECT * FROM dak_entry WHERE ltr_dt='$e_Ltr_dt'  ") or die("could not search");
//echo "SELECT * FROM dak_entry WHERE entry_date='$e_Ltr_dt'";
$count = mysql_num_rows($query);


if($count == 0){
    $output = 'There was no search results !';
}else{
    while($row = mysql_fetch_array($query)){	

$dtvar1=$row['ltr_dt'];
$dtarray=array();
$dtarray=explode("-", $dtvar1);
$e_Ltr_dt=$dtarray[2]."/".$dtarray[1]."/".$dtarray[0];

$dtvarE=$row['entry_date'];
$dtarrayE=array();
$dtarrayE=explode("-", $dtvarE);
$Entry_dt=$dtarrayE[2]."/".$dtarrayE[1]."/".$dtarrayE[0];

      	$sbjct = $row['subject'];
	$rcvd = $row['recvd_from'];
	$ltrno = $row['ltr_no'];
	$ltrdt= $e_Ltr_dt;
       	$ltrfrmt = $row['ltr_format'];
	$mrkbrn = $row['mark_branch'];
	$prty = $row['priority'];
	$entrdt= $row['dak_id'];
        //$output .='<div> '.$fname.'</div>';
{
 echo '<tr>';
$slno=$i++;
 { 
	echo  '<td>'   . $slno.   '</td>' ;
	echo  '<td>'   . $entrdt.   '</td>' ;
	echo  '<td>'   . $sbjct.   '</td>' ;
	echo  '<td>'   . $rcvd.   '</td>' ;
	echo  '<td>'   . $ltrno.   '</td>' ;
	echo  '<td>'   . $ltrdt.   '</td>' ;
	echo  '<td>'   . $ltrfrmt.   '</td>' ;
	echo  '<td>'   . $mrkbrn.   '</td>' ;
	echo  '<td>'   . $prty.   '</td>' ;
	
}
 echo '</tr>';
}
    }
}

?>

<?//php print("$output");?>
<table><tr>
<td align="left">
<input type=button value="Return to Main Page"  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:white;color:red;width:200px">
</td></tr></table>
</body>
</html>