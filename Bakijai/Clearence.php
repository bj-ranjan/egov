<html>
<title></title>
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
require_once '../class/class.sentence.php';
require_once './class/class.baki_payment.php';
require_once '../class/utility.php';

$objCD=new Baki_payment();
$objUtility=new Utility();



$objUtil=new myutility();

$objPolst=new Police_station();
$objCir=new Circle();
$objMouza=new Mouza();

if (isset($_POST['Id']))
$id=$_POST['Id'];
else
$id=0;

$date=isset($_POST['Ddate'])?$_POST['Ddate']:date('d/m/Y');

$ldate=isset($_POST['Ldate'])?$_POST['Ldate']:date('d/m/Y');

$objPs=new Police_station();

$objSen=new Sentence();


if (!is_numeric($id))
$id=0;
$objBakijai_main=new Bakijai_main();
$objBakijai_main->setCase_id($id);
if ($objBakijai_main->EditRecord())
{
$name=$objSen->SentenceCase($objBakijai_main->getFull_name());
$fname=$objSen->SentenceCase($objBakijai_main->getFather());
$village=$objSen->SentenceCase($objBakijai_main->getVillage() );

$objPs->setCode($objBakijai_main->getPolst_code());
$objPs->EditRecord();
$police=$objPs->getName();
$caseno=$objBakijai_main->getBank()."(".$objBakijai_main->getBranch().")/".$objBakijai_main->getCase_no()."/".$objBakijai_main->getFin_yr()."(ID-".$objBakijai_main->getCase_id().")";
if($objBakijai_main->getDisposed()=="N")
echo $objUtility->AlertNRedirect ("Case is not yet Disposed", "LokaAdalat.php.php");
}
else
{
$police='';
$caseno='';
$name='';
$fname='';
$village='';
}
?>
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
       <tr><td colspan=2 align=Center ><image src="../image/ashoka.jpg" width="80" height="80"></td></tr>
<tr><td colspan=2 align=Center ><font face=arial size=3>
GOVT. OF ASSAM<BR>
OFFICE OF THE DEPUTY COMMISSIONER:::::::::::::NALBARI<BR>
(BAKIJAI BRANCH)<br>
Phone: 03624-220496(O)/220218(R)- 220469/220371(F)<BR>
Email: dc-nalbari@nic.in
<BR>
    
            </font></td></tr>
<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
No.NBJ/1/2019/
</td>
<td align=right valign="top" width="40%"><font face=arial size=3>
Date:<?php echo $ldate;?>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; .
</td>
</TR>
<tr><td colspan=2 align=center><font face=arial size=3>
        <U>TO WHOM IT MAY CONCERN</U>
</td></tr>  
<tr><td colspan=2 align=left>&nbsp<br></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
This is to certify that the Bakijai Case No <b><?php echo $caseno ?></b> has been settled in <b>National Loka Adalat
    held on <?php echo $date ?></b> in presence of conciliator, against <b><?php echo $name ?></b>
    son of/wife of  <b><?php echo $fname ?></b>  of village  <b><?php echo $village ?>,</b>
    Police Station- <b><?php echo $police ?></b>,  Dist-<b><?php echo $objBakijai_main->getDistrict() ?></b>,Assam .
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    Addl. Deputy Commissioner<br>(Presiding Officer)<br>Nalbari</td>
</tr>
</table>
    <p align="center"><br><br></p>
    
    
<table border=0 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=90%>
       <tr><td colspan=2 align=Center ><image src="../image/ashoka.jpg" width="80" height="80"></td></tr>
<tr><td colspan=2 align=Center ><font face=arial size=3>
GOVT. OF ASSAM<BR>
OFFICE OF THE DEPUTY COMMISSIONER:::::::::::::NALBARI<BR>
(BAKIJAI BRANCH)<br>
Phone: 03624-220496(O)/220218(R)- 220469/220371(F)<BR>
Email: dc-nalbari@nic.in
<BR>
    
            </font></td></tr>
<tr>
<td align=left valign="center" width="60%"><font face=arial size=3>
No.NBJ/1/2019/
</td>
<td align=right valign="top" width="40%"><font face=arial size=3>
Date: <?php echo $ldate;?>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; .
</td>
</TR>
<tr><td colspan=2 align=center><font face=arial size=3>
        <U>TO WHOM IT MAY CONCERN</U>
</td></tr>  
<tr><td colspan=2 align=left>&nbsp<br></td></tr>
<tr><td colspan="2"><font face="arial" size="3"><div align="justify" style="line-height:2">
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
This is to certify that the Bakijai Case No <b><?php echo $caseno ?></b> has been settled in <b>National Loka Adalat
    held on <?php echo $date ?></b> in presence of conciliator, against <b><?php echo $name ?></b>
    son of/wife of  <b><?php echo $fname ?></b>  of  village  <b><?php echo $village ?>,</b>
    Police Station- <b><?php echo $police ?></b>,  Dist-<b><?php echo $objBakijai_main->getDistrict() ?></b>,Assam .
        </div>    
</td></tr>
<tr><td></td>
<td align="center">
    <p align="center"><br><br><font face="arial" size="3"><b>
    Addl. Deputy Commissioner<br>(Presiding Officer)<br>Nalbari</td>
</tr>
</table>
    
    
    
</body>
</html>
