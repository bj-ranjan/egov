
<body>

<?php
session_start();
header('Refresh: 1;url=Inter.php');
date_default_timezone_set("Asia/kolkata");

require_once './class/class.copy.php';

//header( 'Location: Mainmenu.php?tag=0');

$objCp=new CopyF();

//$objCp->AllFrameExist()
//echo $objCp->Left." ".$objCp->Middle." ".$objCp->Right."<br>";


if(isset($_SESSION['sec']))
$tmp=$_SESSION['sec']+1;
else
$tmp=0;

if($objCp->AllFrameExist())
header( 'Location: Startmenu.php?tag=0');
else
{
$_SESSION['sec']=$tmp;

//echo $objCp->Left." ".$objCp->Middle." ".$objCp->Right."<br>";
?>
<p align=center>
<span style="background-color: #66CCCC">
<font face=arial size=3 color=black>
<b>
LOADING MENU....... PLEASE WAIT <b><font color=red><?php echo $tmp;?></font>
</span>
<br>
(If not loaded within 10 Second then Close window and Restart)
</p>

</font>

<?php
}
?>
   

</html>