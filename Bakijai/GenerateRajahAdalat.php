<html>
<title>Rajah Adalat</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>

<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
require_once './class/class.bakijai_casedate.php';
require_once '../class/utility.php';

require_once '../class/class.converter.php';

$objConv=new Converter();

$objCD=new Bakijai_casedate();
$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objUtil=new myutility();
$objPolst=new Police_station();

$objCir=new Circle();
$objMouza=new Mouza();
$objVill=new Village();
if (isset($_GET['id']))
$id=$_GET['id'];
else
$id=0;

if (!is_numeric($id))
$id=0;
$bank="";
$_SESSION['caseid']=$id;

$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);
if ($objBakijai_main->EditRecord())
{
$caseno= $objBakijai_main->getCase_no()."/".$objBakijai_main->getFin_yr();
$bank=$objBakijai_main->getBank().",".$objBakijai_main->getBranch();
$objCD->setCase_id($id);
$mday=$objCD->maxDay($id)-1;
$objCD->setDay($mday);

if($objCD->EditRecord())
{    
$nextdate=$objUtility->to_date($objCD->getNext_date());
$ntype=$objCD->getNotice_type();
}
else
$nextdate=""; 
$amt=$objUtil->convert2standard($objBakijai_main->getAmount());
$amtrs=$objUtil->letter($objBakijai_main->getAmount());
}
else
{
$nextdate="";
$caseno="";
$amt="0.0";
$amtrs="";
}
 
?>
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=Center ><font face=arial size=৪>
<a href=notice.php style='text-decoration: none'>
অসম চৰকাৰ<br>
জিলা দণ্ডাধীশৰ আদালত:::::::::::::নলবাৰী
            </a>
            </font></td></tr>
<tr>
<td align=left valign="center" width="30%"><font face=arial size=3>
    আই দি নম্বৰ -<?php echo $objUtility->toUniNumber($id);?>
</td>
<td align=right valign="top" width="70%"><font face=arial size=3>
গোচৰ নং-&nbsp;&nbsp;<u><?php echo $bank."/".$objUtility->toUniNumber($caseno);?></u><br>
</td>
</TR>
<tr>
<td align=center colspan="2">
    <b><u>    
<font face=arial size=4>
<a href=notice.php style='text-decoration: none'>
জাননী</a>
</font>
</u>
</b>
</td></tr>
    
<tr><td colspan=2 align=left><font face=arial size=3>
প্রতি ,<br><br>
<u>১ম পক্ষ</u>
<br>
<?php 
echo "<b>".$objConv->HandleRef_Rakar($objBakijai_main->getFull_name_ass(),1)."</b><br>";
echo "পিতা/স্বামী  -".$objBakijai_main->getFather_ass()."<br>";
$cd=$objBakijai_main->getVill_code();
$objVill->setVill_code($cd);
if ($objVill->EditRecord())
echo "গাওঁ - ".$objVill->getVill_name_ass() ."<br>";
$objMouza->setMouza_code($objBakijai_main->getMouza());
if ($objMouza->EditRecord())
echo "মৌজা - ".$objMouza->getMouza_name_ass ()."<br>";
$objPolst->setCode($objBakijai_main->getPolst_code());
if ($objPolst->EditRecord())
$ps= $objPolst->getName_ass(); 
else
$ps="";
echo "থানা -".$ps.",   জিলা-নলবাৰী<br><br>";
//echo "মুঠ টকা -<b>".$objUtility->toUniNumber($objUtil->convert2standard($objBakijai_main->getAmount()));
?>
বনাম-<br><br>
<u>২য় পক্ষ</u>
<br><b>
<?php echo $bank;?></b><br>
</td></tr>  
<tr><td colspan=2 align=left></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
যিহেতু ওপৰোক্ত মোকর্দমাটো প্রস্তাবিত.......<?php echo $nextdate;?>.......ইং তাৰিখত জিলা উপায়ুক্তৰ
কার্য্যলয় নলবাৰীত হবলগীয়া লোক আদালতত বিচাৰৰ বাবে উপস্থাপন কৰা হৈছে, সেয়েহে উক্ত দিনা দিনৰ 
১০.০০ বজাত উপস্থিত হৈ নির্দ্দিষ্ট আদালতত গোচৰৰ তদবিব লৈ আশু নিষ্পত্তিৰ কাৰণে আপোনাক এই জাননী দিয়া হল
<font size=2 face=arial>|</font>
<br>
    
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><font face="arial" size="3">
ভবদীয়<br><br><br>
    অতিৰিক্ত জিলা দণ্ডাধীশ<br>নলবাৰী</td>
</tr>
</table>
    <br><hr><br>
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=Center ><font face=arial size=৪>
অসম চৰকাৰ<br>
জিলা দণ্ডাধীশৰ আদালত:::::::::::::নলবাৰী
            
            </font></td></tr>
<tr>
<td align=left valign="center" width="30%"><font face=arial size=3>
    আই দি নম্বৰ -<?php echo $objUtility->toUniNumber($id);?>
</td>
<td align=right valign="top" width="70%"><font face=arial size=3>
গোচৰ নং-&nbsp;&nbsp;<u><?php echo $bank."/".$objUtility->toUniNumber($caseno);?></u><br>
</td>
</TR>
<tr>
<td align=center colspan="2">
    <b><u>    
<font face=arial size=4>
জাননী
</font>
</u>
</b>
</td></tr>
    
<tr><td colspan=2 align=left><font face=arial size=3>
প্রতি ,<br><br>
<u>১ম পক্ষ</u>
<br>
<?php 
echo "<b>".$objConv->HandleRef_Rakar($objBakijai_main->getFull_name_ass(),1)."</b><br>";
echo "পিতা/স্বামী  -".$objBakijai_main->getFather_ass()."<br>";
$cd=$objBakijai_main->getVill_code();
$objVill->setVill_code($cd);
if ($objVill->EditRecord())
echo "গাওঁ - ".$objVill->getVill_name_ass() ."<br>";
$objMouza->setMouza_code($objBakijai_main->getMouza());
if ($objMouza->EditRecord())
echo "মৌজা - ".$objMouza->getMouza_name_ass ()."<br>";
$objPolst->setCode($objBakijai_main->getPolst_code());
if ($objPolst->EditRecord())
$ps= $objPolst->getName_ass(); 
else
$ps="";
echo "থানা -".$ps.",   জিলা-নলবাৰী<br><br>";
//echo "মুঠ টকা -<b>".$objUtility->toUniNumber($objUtil->convert2standard($objBakijai_main->getAmount()));
?>
বনাম-<br><br>
<u>২য় পক্ষ</u>
<br><b>
<?php echo $bank;?></b><br>
</td></tr>  
<tr><td colspan=2 align=left></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
যিহেতু ওপৰোক্ত মোকর্দমাটো প্রস্তাবিত........<?php echo $nextdate;?>......ইং তাৰিখত জিলা উপায়ুক্তৰ
কার্য্যলয় নলবাৰীত হবলগীয়া লোক আদালতত বিচাৰৰ বাবে উপস্থাপন কৰা হৈছে, সেয়েহে উক্ত দিনা দিনৰ 
১০.০০ বজাত উপস্থিত হৈ নির্দ্দিষ্ট আদালতত গোচৰৰ তদবিব লৈ আশু নিষ্পত্তিৰ কাৰণে আপোনাক এই জাননী দিয়া হল
<font size=2 face=arial>|</font>
<br>
    
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><font face="arial" size="3">
ভবদীয়<br><br><br>
    অতিৰিক্ত জিলা দণ্ডাধীশ<br>নলবাৰী</td>
</tr>
</table>



<hr><font face="arial" size="2">
<?php
echo "http://".$objUtility->ServerIP.",   Printed on ".date('d/m/Y');
?>    
</body>
</html>
