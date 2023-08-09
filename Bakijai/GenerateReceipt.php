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
//require_once './class/class.bank_master.php';
//require_once './class/class.bankbranch.php';
//require_once './class/class.police_station.php';
//require_once './class/class.circle.php';
//require_once './class/class.mouza.php';
//require_once './class/class.village.php';
require_once './class/class.baki_payment.php';
require_once '../class/utility.php';

$objCD=new Baki_payment();
$objUtility=new Utility();

$objUtil=new myutility();


if (isset($_GET['id']))
$id=$_GET['id'];
else
$id=0;


if (!is_numeric($id))
$id=0;
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);

$lastinst=$objCD->LastInstalment_no($id)+1;

if ($objBakijai_main->EditRecord())
{
$caseno= $objBakijai_main->getCase_no();
$objCD->setCase_id($id);
$objCD->setInstalment_no($lastinst);


if($objCD->EditRecord())
{    
$nextdate=$objUtility->to_date ($objCD->getNextdate());
$paidtoday=$objCD->getPaid_today();
$paydate=$objUtility->to_date ($objCD->getPay_date());
$bal=$objCD->BalanecAmount($id);
$recpno=$objCD->getReceipt_no();
$totalpaid=$objUtil->convert2standard($objCD->ToalPaid($id));
}
$amt=$objUtil->convert2standard($objBakijai_main->getAmount());
$amtrs=$objUtil->letter($objBakijai_main->getAmount());
$bal=$objUtil->convert2standard($bal);
$paidtoday=$objUtil->convert2standard($paidtoday);

if ($objBakijai_main->getDisposed()=="Y")
{
$status="Disposed";
$nextdate="";
}
else
$status="Running";
}
else
{
$nextdate="";
$caseno="";
$amt="0.0";
$amtrs="";
}
?>
<table border=0 align=center cellpadding=5 cellspacing=0 style=border-collapse: collapse; width=70%>
<tr><td colspan=2 align=Center ><font face=arial size=2>
GOVT OF ASSAM<BR>
OFFICE OF THE DEPUTY COMMISSIONER :::::::::NALBARI<BR>
(BAKIJAI BRANCH)
<BR>
    
            </font></td></tr>
<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
Receipt No-<b><?php echo $recpno;?>
</td>
<td align=right valign="top" width="40%"><font face=arial size=3>
Receipt Date <b><?php echo $paydate;?></b>
</td>
</TR>
<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
Case ID-
</td>
<td align=left valign="top" width="40%"><font face=arial size=3>
<b><?php echo $id;?>
</td>
</TR>
<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
Case No-
</td>
<td align=left valign="top" width="40%"><font face=arial size=3>
<b><?php echo $caseno;?>
</td>
</tr>


<tr><td align=left valign="top"><font face=arial size=3>
Name of Defaulter
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
    
    <?php 
echo $objBakijai_main->getFull_name()."<br>";
echo "C/o ".$objBakijai_main->getFather()."<br>";
echo "Vill- ".$objBakijai_main->getVillage()."<br>";
?>
</td></tr>  
<tr><td align=left valign="top"><font face=arial size=3>
Defaulting Amount
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $amt;?>
</td>
</tr>    
<tr><td align=left valign="top"><font face=arial size=3>
Amount Paid today
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $paidtoday;?>
</td>
</tr>  
<tr><td align=left valign="top"><font face=arial size=3>
Total Amount Paid 
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $totalpaid;?>
</td>
</tr>  
<tr><td align=left valign="top"><font face=arial size=3>
Balance to be paid
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $bal;?>
</td>
</tr> 
<tr><td align=left valign="top"><font face=arial size=3>
Next Date
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $nextdate;?>
</td>
</tr>
<tr><td align=left valign="top"><font face=arial size=3>
Case Status
    </td>
<td align=left valign="top" width="40%"><font face=arial size=3>    
<b><?php echo $status;?>
</td>
</tr>
<tr><td colspan="2"><br><br></td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    Bakijai Assistant<br>DC Office,Nalbari</td>
</tr>
</table>

</body>
</html>
