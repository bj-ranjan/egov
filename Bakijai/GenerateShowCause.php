<html>
<title>Form 77</title>
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
$_SESSION['ntype']=$ntype;
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

if ($ntype>2)
header('Location:GenerateWarrant.php') ;   

?>
    
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=Center ><font face=arial size=3>
কিয় গ্রেপ্তাৰী পৰোৱানা জাৰী কৰা নহব তাৰ কাৰণ দর্শোৱা  জাননী 
(<?php echo $objUtility->toUniNumber($ntype);?>)<BR>
(বেঙ্গাল পাব্লিক ডিমান্দ ৰিকোভাৰী আইনৰ ৭৭ নং ধাৰা নিয়ম অনুসৰি )
<BR>
    
            </font></td></tr>
<tr>
<td align=left valign="center" width="30%"><font face=arial size=3>
    আই দি নম্বৰ -<?php echo $objUtility->toUniNumber($id);?>
</td>
<td align=right valign="top" width="70%"><font face=arial size=3>
গোচৰ নং-&nbsp;&nbsp;<u><?php echo $bank."/".$objUtility->toUniNumber($caseno);?></u><br><br>
</td>
</TR>
<tr><td colspan=2 align=left><font face=arial size=3>
প্রতি ,<br><br>
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
?>
</td></tr>  
<tr><td colspan=2 align=left></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
যিহেতু কালেক্টৰ নলবাৰী | চার্টিফিকেট নং.. <?php echo $objUtility->toUniNumber($caseno);?>&nbsp;&nbsp.
মুঠ&nbsp;<?php echo $objUtility->toUniNumber($amt);?>&nbsp;&nbsp;টকাৰ আদায় নিমিত্তে 
আপোনাক গ্রেপ্তাৰ কৰি দেৱানী হাজোতত ৰখাৰ আবেদন পোৱ হৈছে |
গতিকে আপুনি অহা <?php echo $objUtility->toUniNumber($nextdate);?>&nbsp;
ইং তাৰিখে হাজিৰ হৈ কিয় ওপৰত উল্লেখিত চার্টিফিকেটৰ টকা আদায় কাৰ নিমিত্তে আপোনাক 
গ্রেপ্তাৰ কৰি দেৱানী হাজোতত ৰখা নহব তাৰ কাৰণ দর্শাৱ |
<br>
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;অন্যাথায় আইন মতে ব্যৱস্থা লোৱ হব |
  <br><br>  
 আজি ...........................ইং. ..তাৰিখে আদালতৰ চিল মোহৰ মাৰী দিয়া হল |
  <br><br<Br>
     
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    চাৰ্টিফিকেট বিষয়া  <br>নলবাৰী</td>
</tr>
</table>
    <br><hr><br>
<?php //Duplicate Copy?>
    
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=Center ><font face=arial size=3>
কিয় গ্রেপ্তাৰী পৰোৱানা জাৰী কৰা নহব তাৰ কাৰণ দর্শোৱা  জাননী 
<BR>
(বেঙ্গাল পাব্লিক ডিমান্দ ৰিকোভাৰী আইনৰ ৭৭ নং ধাৰা নিয়ম অনুসৰি )
<BR>
    
            </font></td></tr>
<tr>
<td align=left valign="center" width="30%"><font face=arial size=3>
    আই দি নম্বৰ -<?php echo $objUtility->toUniNumber($id);?>
</td>
<td align=right valign="top" width="70%"><font face=arial size=3>
গোচৰ নং-&nbsp;&nbsp;<u><?php echo $bank."/".$objUtility->toUniNumber($caseno);?></u><br><br>
</td>
</TR>
<tr><td colspan=2 align=left><font face=arial size=3>
প্রতি ,<br><br>
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
?>
</td></tr>  
<tr><td colspan=2 align=left></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
যিহেতু কালেক্টৰ নলবাৰী | চার্টিফিকেট নং.. <?php echo $objUtility->toUniNumber($caseno);?>&nbsp;&nbsp.
মুঠ&nbsp;<?php echo $objUtility->toUniNumber($amt);?>&nbsp;&nbsp;টকাৰ আদায় নিমিত্তে 
আপোনাক গ্রেপ্তাৰ কৰি দেৱাবনি হাজোতত ৰখাৰ আবেদন পোৱ হৈছে |
গতিকে আপুনি অহা <?php echo $objUtility->toUniNumber($nextdate);?>&nbsp;
ইং তাৰিখে হাজিৰ হৈ কিয় ওপৰত উল্লেখিত চার্টিফিকেটৰ টকা আদায় কাৰ নিমিত্তে আপোনাক 
গ্রেপ্তাৰ কৰি দেৱনী হাজোতত ৰখা নহব তাৰ কাৰণ দৰ্শাৱ |
<br>
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;অন্যাথায় আইন মতে ব্যৱস্থা লোৱ হব |
  <br><br>  
 আজি ...........................ইং. ..তাৰিখে আদালতৰ চিল মোহৰ মাৰী দিয়া হল |
  <br><br<Br>
     
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    চাৰ্টিফিকেট বিষয়া  <br>নলবাৰী</td>
</tr>
</table>
    
</body>
</html>
