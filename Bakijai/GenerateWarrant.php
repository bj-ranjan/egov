<html>
<title>Warrant Notice</title>
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
if (isset($_SESSION['caseid']))
$id=$_SESSION['caseid'];
else
$id=0;
if(isset($_SESSION['ntype']))
$ntype=$_SESSION['ntype'];
else
$ntype=3;    
$interest=0;
if($ntype==4)
$nbl="জামিন বিহীন";
else
$nbl="";    
$refund=0;
$bank="";
$mact="";
if (!is_numeric($id))
$id=0;
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);
if ($objBakijai_main->EditRecord())
{
if($objBakijai_main->getBank()=="MACT" )   
$mact=$objBakijai_main->getReq_letter_no(); //REQ_LETTER_NO 
$gross=$objBakijai_main->getAmount();    
$caseno= $objBakijai_main->getCase_no()."/".$objBakijai_main->getFin_yr();
$bank=$objBakijai_main->getBank().",".$objBakijai_main->getBranch();

$objCD->setCase_id($id);
$mday=$objCD->maxDay($id)-1;
$objCD->setDay($mday);

if($objCD->EditRecord())
{    
$nextdate=$objUtility->to_date($objCD->getNext_date());
$ntype=$objCD->getNotice_type();
$asondate=substr($objCD->getEntry_date(),0,10);
$interest=$objBakijai_main->InterestDue($id, $asondate);
$refund=$objBakijai_main->PaidUptoDate($id, $asondate);
//$gross=($gross-$refund)+$interest;
$gross=($gross-$refund);
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
$nextdate=$objUtility->toUniNumber($nextdate);
$interest=$objUtil->convert2standard($interest);
$gross=$objUtil->convert2standard($gross);
$refund=$objUtil->convert2standard($refund);
//if ($ntype>2)
//header('Location:Warrant.php') ;   
?>
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr><td colspan=2 align=Center ><font face=arial size=3>
অসম চৰকাৰ  
<BR>
নলবাৰী জিলাৰ উপায়ুক্তৰ কার্যলয়:::::::::::::::   নলবাৰী
<BR>
(বাকীজাই শাখা)
<br><br><b><u><?php echo $nbl;?> গ্রেপ্তাৰী পৰোৱানা </b></u>  
            </font></td></tr>
<tr>
<td align=left valign="center" width="30%"><font face=arial size=3>
    আই দি নম্বৰ -<?php echo $objUtility->toUniNumber($id);?>
</td>
<td align=right valign="top" width="70%"><font face=arial size=3>
গোচৰ নং-&nbsp;&nbsp;<u><?php echo $bank."/".$objUtility->toUniNumber($caseno);?></u><br><?php echo $mact;?><br>
</td>
</TR>
<tr><td colspan=2 align=left><font face=arial size=3>
প্রতি ,<br><br>
আৰক্ষী বিষয়া.....
<?php 
$objPolst->setCode($objBakijai_main->getPolst_code());
if ($objPolst->EditRecord())
$ps= $objPolst->getName_ass(); 
else
$ps="";
echo $ps." আৰক্ষী চকী <br>";

$sdate=$objUtility->to_date($objBakijai_main->getStart_date());

$name=$objConv->HandleRef_Rakar($objBakijai_main->getFull_name_ass(),1);
$fname=$objConv->HandleRef_Rakar($objBakijai_main->getFather_ass(),1);
$cd=$objBakijai_main->getVill_code();
$objVill->setVill_code($cd);
if ($objVill->EditRecord())
$vill=$objVill->getVill_name_ass() ;
$objMouza->setMouza_code($objBakijai_main->getMouza());
if ($objMouza->EditRecord())
$mouza=$objMouza->getMouza_name_ass ();
//$amt=$objBakijai_main->getAmount();
//$amt=$objUtil->convert2standard($amt);
$amt=$objUtility->toUniNumber($amt);

$interest=$objUtility->toUniNumber($interest);
$gross=$objUtility->toUniNumber($gross);
$refund=$objUtility->toUniNumber($refund);
?>
</td></tr>  
<tr><td colspan=2 align=left><br></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
যিহেতু  ১৯১৩ চনৰ বেঙ্গাল পাব্লিক ডিমান্দ ৰিকোভাৰী  আইনৰ ২৯ নং ধাৰাৰ বিধান মতে  শ্রী <b><?php echo $name;?></b>
 পিতা <b><?php echo $fname;?></b>
গাওঁ <b><?php echo $vill;?></b>  মৌজা <b><?php echo $mouza;?></b>
থানা <b><?php echo $ps;?></b> ৰ বিৰুদ্ধে তলত দিয়া পাবলগীয়া টকা আদায়ৰ
বাবে  <b><?php echo $objUtility->toUniNumber($sdate);?></b> ইং তাৰিখে বাকীজাই গোচৰ তৰা হৈছে |
<br><br>
মুল টকাৰ বাবদ- <b><?php echo $amt;?></b>
<br>পৰিশোধ - <b><?php echo $refund;?></b>
<br>সুদৰ বাবদ- <b><?php //echo $interest;?></b>
<br>মিৰনৰ বাবদ-
<br>হুকুম জাৰীৰ বাবদ-
<br>সর্বমুঠ-.....<b><?php echo $gross;
?></b>
<br><br>
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;আৰু যিহেতু পাওনাদাৰে পাবলগীয়া টকা বাকীদাৰে আদায় দিয়া নাই | গতিকে আপোনাক ইয়াৰ দ্বাৰা
আদেশ দিয়া হল যে, যদিহে ওপৰোক্ত বাকীদাৰে আদায় দিবলগীয়া হুকুম জাৰীৰ খৰচ সহ মুঠ.
<b><?php echo $gross;?></b>
টকা আদায়ৰ নিমিত্তে তেওঁক তৎকালে  গ্রেপ্তাৰ কৰি আনি আদালতৰ ওচৰত হাজিৰ কৰাবহি  |
<br><br>
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;আপোনাক পুনৰ আদেশ দিয়া হল যে, এই গ্রেপ্তাৰী পৰোৱানাৰ কাম কোন দিনা কিভাবে জাৰী কৰিলে
বা জাৰী কৰিব নোৱাৰিলে তাৰ সঠিক প্রতিবেদন সহ অহা...<b><?php echo $nextdate;?></b>.. ইং তাৰিখৰ ভিতৰত পোৱাকৈ
মোৰ আদালতত  প্রেৰণ কৰিব |  

<br><Br>
 আজি ...........................ইং. ..তাৰিখে আদালতৰ চিল মোহৰ মাৰী দিয়া হল |
  <br><br<Br>
     
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    চার্টিফিকেট বিষয়া  <br>নলবাৰী</td>
</tr>
</table>
    <hr><font face="arial" size="2">
<?php
echo "http://".$objUtility->ServerIP.",   Printed on ".date('d/m/Y');
?>
</body>
</html>
