<html>
<head>
<title>Edit Form fornotice</title>
<script type="text/javascript" src="validation.js"></script>
<script language="javascript">
<!--

function validate()
{
myform.action="Edit_notice.php?tag=2";
myform.submit();
}

function home()
{
window.location="mainmenu.php?tag=1";
}
</script>

</head>
<body>
<p align=center>
<?php
session_start();
require_once 'class.notice.php';
require_once 'utility.class.php';

$objUtility=new Utility();
$bcol="white";
$fcol="black";
$font="12";
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

$objNotice=new Notice();
if (isset($_GET['tag']))
$code=$_GET['tag'];
else
$code=1;


if ($code==1) //Next Loading aftre postback
{
$rdonly=" ";
$sql=" 1=1 order by slno desc";
?>
<form name=myform action=Edit_notice.php?tag=2  method=POST >
<?php
$headlist=array("Link Description","Active","New Link");
$align=array(1,2,2);
$ValueList=array();
$rowcount=0;
$row=$objNotice->getAllRecord($sql);
for($ii=0;$ii<count($row);$ii++)
{
$rowcount++;
 $Slno="Slno".$rowcount;
$oldval=$row[$ii]['Slno'];
$val=$oldval;

$ValueList[$ii][0]=$objNotice->returnHiddenBox("Old_".$Slno,$oldval);
$function="";
$ValueList[$ii][0].=$objNotice->returnHiddenBox($Slno,$val).$row[$ii]['Link_description'];
 $Active="Active".$rowcount;
$oldval=$row[$ii]['Active'];
$val=$oldval;

$ValueList[$ii][1]=$objNotice->returnHiddenBox("Old_".$Active,$oldval);
$function="";
//$ValueList[$ii][1].=$objNotice->returnInputBox($Active,$val,10,1,$function);
if($val=="Y")
$function=" checked=checked"   ; 
$ValueList[$ii][1].=$objNotice->returnCheckBox($Active, 0, $function);

 $Isnew="Isnew".$rowcount;
$oldval=$row[$ii]['Isnew'];
$val=$oldval;

$ValueList[$ii][2]=$objNotice->returnHiddenBox("Old_".$Isnew,$oldval);
$function="";
//$ValueList[$ii][2].=$objNotice->returnInputBox($Isnew,$val,10,1,$function);

if($val=="Y")
$function=" checked=checked"   ; 
$ValueList[$ii][2].=$objNotice->returnCheckBox($Isnew, 0, $function);


} //while
$ValueList[$ii][0]="&nbsp;";
$ValueList[$ii][1]="&nbsp;";
$function=" onclick=validate() ";
$objNotice->bcol="yellow";
$objNotice->font="10";
$cap="Save All";
$ValueList[$ii][2]=$objNotice->returnButton("Save",$cap,100,$function);
$title="BATCH UPDATE";
$rcount=count($ValueList)-1;
$objNotice->genDataGridOnValueList($title,$headlist, $align, $ValueList,90,$rcount);
$_SESSION['rowcount']=$rowcount;
}//$code==1


if ($code==2) //PostBack Submit
{
//echo $_SESSION['rowcount'];
for ($ind=1;$ind<=$_SESSION['rowcount'];$ind++)
{
$sql="update notice set ";
$updcount=0;
$oldSlno="Old_Slno".$ind;
$Slno="Slno".$ind;

if (isset($_POST[$Slno]))
{
$Slno=$_POST[$Slno];
$oldSlno=$_POST[$oldSlno];

if (is_numeric($Slno))
{
if ($oldSlno!=$Slno)
{
if ($updcount>0)
$sql=$sql.",";
$sql=$sql."Slno='".$Slno."'";
$updcount++;
}
}
}//isset[Slno]

$oldActive="Old_Active".$ind;
$Active="Active".$ind;

if (isset($_POST[$Active]))
{
$Active=$_POST[$Active];
$oldActive=$_POST[$oldActive];

if ($objUtility->SimpleValidate($Active,1))
{
if ($oldActive!=$Active)
{
if ($updcount>0)
$sql=$sql.",";
$sql=$sql."Active='".$Active."'";
$updcount++;
}
}
}//isset[Active]

$oldIsnew="Old_Isnew".$ind;
$Isnew="Isnew".$ind;

if (isset($_POST[$Isnew]))
{
$Isnew=$_POST[$Isnew];
$oldIsnew=$_POST[$oldIsnew];

if ($objUtility->SimpleValidate($Isnew,1))
{
if ($oldIsnew!=$Isnew)
{
if ($updcount>0)
$sql=$sql.",";
$sql=$sql."Isnew='".$Isnew."'";
$updcount++;
}
}
}//isset[Isnew]

$oldSlno="Old_Slno".$ind;
if (isset($_POST[$oldSlno]))
{
$sql=$sql." where ";
$oldSlno=$_POST[$oldSlno];
$sql=$sql."Slno='".$oldSlno."'";
}
if ($updcount>0)
{
$res=$objNotice->ExecuteQuery($sql);
echo $sql;
if ($res) //Save as SQL Log
{
$objUtility->saveSqlLog("notice",$sql);
echo "&nbsp;<font color=blue size=2 face=arial>Success</font><br>";
}
else
{
echo "&nbsp;<font color=red size=2 face=arial>Fail<br></font>";
}
} //$updcount>0
}//for loop
echo "<A href=Edit_notice.php?tag=0>Back</a>";
}//code=2
?>
</p>
</form>
</body>
</html>
