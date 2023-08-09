<html >
<head>
</head>
<body>
<fieldset name=frame style="width:100%;border-COLOR:none;height:500;" align=center>
<script language=javascript>
function home()
{
window.location="dakentry.php";
}
</script>


<?php
require_once '../class/class.PWD.php';

$pd=new Pwd();

session_start();
$_SESSION['YR'] = $_POST['yr'];
$searchyr=$_SESSION['YR'];

$_SESSION['MN'] = $_POST['mnth'];
$searchmn=$_SESSION['MN'];
$i=1;

if ($searchmn==1)
	{ 
	   $mntapr="January";
	}
elseif ($searchmn==2)
	{
	  $mntapr="February";
	}
elseif ($searchmn==3)
	{
	  $mntapr="March";
	}
elseif ($searchmn==4)
	{
	  $mntapr="April";
	}
elseif ($searchmn==5)
	{
	  $mntapr="May";
	}
elseif ($searchmn==6)
	{
	  $mntapr="June";
	}
elseif ($searchmn==7)
	{
	  $mntapr="July";
	}
elseif ($searchmn==8)
	{
	  $mntapr="August";
	}
elseif ($searchmn==9)
	{
	  $mntapr="September";
	}
elseif ($searchmn==10)
	{
	  $mntapr="October";
	}
elseif ($searchmn==11)
	{
	  $mntapr="November";
	}
elseif ($searchmn==12)
	{
	  $mntapr="December";
	}
?>

<table align=center width=100%>
<TD ALIGN=CENTER VALIGN=BOTTOM><FONT COLOR=BLUE SIZE=6 FACE="MONOTYPE CORSIVA">Dak for the Month (<?php echo $mntapr; ?> - <?php echo $searchyr; ?> ) </TD></tr>
</TABLE>
<?php
$output ='';
echo '<table align=cnter width=100% border="1">'; 
echo  '<td>SL.No.</td><td>Dak ID</td><td>Subject </td><td>Received From </td><td>Letter No. </td><td>Letter Date </td><td>Letter Format </td><td>Marked  Branch </td><td>Priority </td>';
if (isset($_post['search'])){
   $kkk= $_post['search'];
}
$query = mysql_query("SELECT * FROM dak_entry WHERE year(ltr_dt)=$searchyr  and month(ltr_dt)=$searchmn ") or die("could not search");
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
<table><tr><td align="left">
<input type=button value="Return to Main Page"  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:white;color:red;width:200px">
</td></tr></table>
</body>
</html>