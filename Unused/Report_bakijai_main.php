<html>
<title>Entry Form forbakijai_main</title>
</head>
<script language=javascript>
<!--
function home()
{
window.location="mainmenu.php?tag=1";
}
</script>
<body>
<table border=1 align=center cellpadding=0 cellspacing=0 style=border-collapse: collapse; width=90%>
<Thead>
<tr><td colspan=27 align=Center><hr></td></tr>
<tr><td colspan=27 align=Center bgcolor=#ccffcc><font face=arial size=4>List of- bakijai_main</font></td></tr>
<tr>
<td align=center>
Case_id
</td>
<td align=center>
Start_date
</td>
<td align=center>
Case_no
</td>
<td align=center>
Fin_yr
</td>
<td align=center>
Bank
</td>
<td align=center>
Branch
</td>
<td align=center>
Full_name
</td>
<td align=center>
Full_name_ass
</td>
<td align=center>
Father
</td>
<td align=center>
Father_ass
</td>
<td align=center>
Polst_code
</td>
<td align=center>
Circle
</td>
<td align=center>
Mouza
</td>
<td align=center>
Vill_code
</td>
<td align=center>
Amount
</td>
<td align=center>
Balance
</td>
<td align=center>
Req_letter_no
</td>
<td align=center>
Req_letter_date
</td>
</tr>
</Thead>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
$objUtility=new Utility();
$objBakijai_main=new Bakijai_main();
$row=$objBakijai_main->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=left>
<?php
$tvalue=$row[$ii]['Case_id'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Start_date']);
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Case_no'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Fin_yr'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objBank_master=new Bank_master();
$objBank_master->setBank_name($row[$ii]['Bank']);
$objBank_master->editRecord();
$tvalue=$objBank_master->getBtype();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objBankbranch=new Bankbranch();
$objBankbranch->setBank($row[$ii]['Branch']);
$objBankbranch->editRecord();
$tvalue=$objBankbranch->getBranch();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Full_name'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Full_name_ass'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Father'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Father_ass'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objPolice_station=new Police_station();
$objPolice_station->setCode($row[$ii]['Polst_code']);
$objPolice_station->editRecord();
$tvalue=$objPolice_station->getName();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objCircle=new Circle();
$objCircle->setCir_code($row[$ii]['Circle']);
$objCircle->editRecord();
$tvalue=$objCircle->getCircle();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objMouza=new Mouza();
$objMouza->setMouza_code($row[$ii]['Mouza']);
$objMouza->editRecord();
$tvalue=$objMouza->getMouza_name();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$objVillage=new Village();
$objVillage->setVill_code($row[$ii]['Vill_code']);
$objVillage->editRecord();
$tvalue=$objVillage->getVill_name();
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Amount'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Balance'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$row[$ii]['Req_letter_no'];
echo $tvalue;
?>
</td>
<td align=left>
<?php
$tvalue=$objUtility->to_date($row[$ii]['Req_letter_date']);
echo $tvalue;
?>
</td>
</tr>
<?php
}
?>
</table>

<a href=mainmenu.php?tag=1>Menu</a>
</body>
</html>
