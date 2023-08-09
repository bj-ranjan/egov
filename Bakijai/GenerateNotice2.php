<html>
<title>Form-2(Notice to Debtor)</title>
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
require_once './class/class.baki_payment.php';
require_once '../class/utility.php';

$objCD=new Baki_payment();
$objUtility=new Utility();

$objUtil=new myutility();

$objPolst=new Police_station();
$objCir=new Circle();
$objMouza=new Mouza();

if (isset($_GET['id']))
$id=$_GET['id'];
else
$id=0;

if (!is_numeric($id))
$id=0;
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);
if ($objBakijai_main->EditRecord())
{
$caseno=$objBakijai_main->getBank()."(".$objBakijai_main->getBranch().")/". $objBakijai_main->getCase_no()."/".$objBakijai_main->getFin_yr();
$objCD->setCase_id($id);
$objCD->setInstalment_no("0");
if($objCD->EditRecord())
$nextdate=$objUtility->to_date ($objCD->getNextdate());
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
<tr><td colspan=2 align=left ><font face=arial size=3>
Assam Schedule XXVII(Part 1), Form No. 55
            </font></td></tr>
<tr><td colspan=2 align=Center ><font face=arial size=3<BR>
ORDER SHEET
<BR><BR>
(See Rule 129 of the Records manual, 1911)
             </font></td></tr>
<tr><td colspan=2 align=left ><font face=arial size=3>
Order Sheet, dated from ...............................................  to ...................................... <br> <br>
District: Nalbari....... No.. <?php echo $caseno ;?> of .........  <br> <br>
Nature of the Case..  Bank/Housing/MACT/Loan ........... <br>
</td></tr>
</table>

<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
<tr>
<td align=center valign="center" width="20%"><font face=arial size=3>Serial Number and date of order</td>
<td align=center valign="center" width="60%"><font face=arial size=3>Order and Signature of Officer</td>
<td align=center valign="center" width="20%"><font face=arial size=3>Note of action taken on order</td>
</tr>
<tr>
<td align=center valign="top" width="20%" height=500><font face=arial size=3><?php echo date('d/m/Y');?></td>
<td align=center valign="top" width="60%"><font face=arial size=3>
<div align="justify" style="line-height:1.5">
<?php echo $objBakijai_main->getBank().", ".$objBakijai_main->getBranch() ?> 

 <?php echo $objBakijai_main->getReq_letter_date();?>     <?php echo $objBakijai_main->getReq_letter_no()?> 
</div>
</td>
<td align=center valign="top" width="20%"><font face=arial size=3>&nbsp;</td>
</tr>

</table>




<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
(Name of Certificate Debtor)
</td>
<td align=right valign="top" width="40%"><font face=arial size=3>
Case No-<u><?php echo $caseno;?></u><br><br>
Trial Date Fixed-<b><?php echo $nextdate;?></b><br>
</td>
</TR>
<tr><td colspan=2 align=left><font face=arial size=3>
To,<br>
<?php 
echo $objBakijai_main->getFull_name()."<br>";
echo "C/o ".$objBakijai_main->getFather()."<br>";
echo "Vill- ".$objBakijai_main->getVillage()."<br>";
$objPolst->setCode($objBakijai_main->getPolst_code());
if ($objPolst->EditRecord())
echo "PS- ".$objPolst->getName()."<br>";
?>
</td></tr>  
<tr><td colspan=2 align=left><br></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
You are hereby informed that a certificate against you for Rs.
<b><?php echo $amt;?></b> &nbsp;due from you on account of
................................., has this day been filed in my office, under
 section 46 of the Bengal Public Demand Recovery Act, 1913. If you
  deny your liability to pay the said sum of Rs.<b><?php echo $amt;?></b>
   you may within thirty days, from the service of this notice,
    file in my office a petition denying liability, in whole
    or, in part. If within the said thirty days, you failed to file
     such a petition ,or if you fail to showcause ,or do not show sufficient
     cause, why such Act, unless on pay Rs.<b><?php echo $amt;?></b> 
     (Rupees&nbsp;&nbsp;<b><?php echo $amtrs;?></b>..on account of the demand
      and Rs ..................... on account of costs of realization)
      in to my office until the said amount is so paid you are hereby prohibited from
      alienating your immovable property, or any part of it, sale,gift, mortgage
       or otherwise. If you in the meantime conceal, remove or dispose
       of any part of your movable property, the Certificate will be executed
      immediately.
      <br>  <br>
   &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;    
 A copy of the Certificate above mentioned is here to annexed. You may
  remit the amount by money order, quoting the number and year of the
  Certificate.
  <br>  <br>
  Dated this............................... day of ..............................
  <br><br<Br>
     
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    Certificate Officer<br>Nalbari</td>
</tr>
</table>

</body>
</html>
