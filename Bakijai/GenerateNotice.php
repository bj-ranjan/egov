<html>
<title>Common Notice</title>
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
require_once './class/class.baki_payment.php';
require_once '../class/utility.php';
require_once '../class/class.converter.php';

$objConv=new Converter();


$objCD=new Baki_payment();
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
$mact="";
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);
if ($objBakijai_main->EditRecord())
{
if($objBakijai_main->getBank()=="MACT" )   
$mact="(".$objBakijai_main->getReq_letter_no().")"; //REQ_LETTER_NO 
$caseno=$objBakijai_main->getBank()."(".$objBakijai_main->getBranch().")/".  $objBakijai_main->getCase_no()."/".$objBakijai_main->getFin_yr();
$bank=$objBakijai_main->getBank().",".$objBakijai_main->getBranch();
$objCD->setCase_id($id);

if($objCD->EditRecord())
{    
$nextdate=$objUtility->to_date($objCD->getNextdate());
}
else
$nextdate=""; 
}
else
{
$nextdate="";
$caseno="";
$amt="0.0";
$amtrs="";
}
 

$fdate=$objBakijai_main->getReq_letter_date();
$fdate=$objUtility->to_date($fdate);
?>
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=left ><font face=arial size=3>
Assam Schedule XXVII(Part 1), Form No. 55
            </font></td></tr>
<tr><td colspan=2 align=Center ><font face=arial size=3<BR>
<b><u>ORDER SHEET</u></b>
<BR><BR>
(See Rule 129 of the Records manual, 1911)
             </font></td></tr>
<tr><td colspan=2 align=left ><font face=arial size=3>
Order Sheet, dated from ...............................................  to ...................................... <br> <br>
District: Nalbari....... No.. <?php echo $caseno ;?><?php echo $mact;?> .. .........  <br> <br>
Nature of the Case..  Bank/Housing/MACT/...............................Loan  <br>
</td></tr>
</table>
<p align=center>&nbsp;</p> 
<table border=1 align=center cellpadding=3 cellspacing=1 style=border-collapse: collapse; width=90%>
<tr>
<td align=center valign="center" width="20%"><font face=arial size=3>Serial Number and date of order</td>
<td align=center valign="center" width="60%"><font face=arial size=3>Order and Signature of Officer</td>
<td align=center valign="center" width="20%"><font face=arial size=3>Note of action taken on order</td>
</tr>
<tr>
<td align=center valign="top" width="20%" height=500><font face=arial size=3><br><br><br><?php echo date('d/m/Y');?></td>
<td align=center valign="top" width="60%"><font face=arial size=3>
<div align="justify" style="line-height:2">
<?php echo $objBakijai_main->getBank().", ".$objBakijai_main->getBranch() ?> 
বিভাগৰ পৰা অহা &nbsp;

 <?php echo $fdate;?>  তাৰিখৰ   <?php echo $objBakijai_main->getReq_letter_no();?> 
নং চিঠি চোৱা হল । ১৯১৩ চনৰ বেঙ্গল পাব্লিক ডিমান্দ ৰিকোভাৰী আইনৰ ৪ আৰু ৬ ধাৰা ভিত্তিত বাকীজাই  মোকর্দমা  ৰুজু কৰা হওক ।
 গোচৰ পঞ্জীয়ন কৰি বাকীদাৰৰ ওপৰত নোটিশ আৰু দাবীৰ প্রমান  পত্র   প্রেৰণ কৰা হওঁক । 
<br><br><br>
প্রতিবেদন পেষ কৰা হওঁক ।  <br> তাঃ <?php echo $nextdate;?>
</div>
<br><br><br>
<div align="center" style="line-height:1.5">
চার্টিফিকেট বিষয়া <br> নলবাৰী
</div>
</td>
<td align=center valign="top" width="20%"><font face=arial size=3>&nbsp;</td>
</tr>

</table>


</body>
</html>
