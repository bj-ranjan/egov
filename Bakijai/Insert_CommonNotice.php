<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_casedate.php';
require_once './class/class.noticetype.php';
require_once './class/class.update_history.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.village.php';

$objHis=new Update_history();
$objBm=new Bakijai_main();
$objV=new Village();

$_SESSION['noticetype']=0;
$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objBakijai_casedate=new Bakijai_casedate();
$Err="<font face=arial size=1 color=blue>";
$a_Case_id=$_POST['Case_id'];
$mvalue[0]=$a_Case_id;
if (!is_numeric($a_Case_id))
$myTag++;

$b_Day=$_POST['Day'];
$mvalue[1]=$b_Day;

$nextdate=$_POST['Nextdate'];

$_SESSION['oldid']=0;
$mmode="";
$_SESSION['alert']="";

$objBakijai_casedate=new Bakijai_casedate();
$objBakijai_casedate->setCase_id($a_Case_id);
$objBakijai_casedate->setDay($b_Day);
$objBakijai_casedate->setNotice_type(5);

$i_Next_date=$objUtility->to_mysqldate($nextdate);

$objBakijai_casedate->setNext_date($i_Next_date);
$objBakijai_casedate->SaveRecord();

//Update Defaulter particulars in Bakijai_main table
//if (isset($_POST['detail'])) //update detail box is checked
if(1==1)
{    
$objBm->setCase_id($a_Case_id);


$h_Full_name_ass=$_POST['Full_name_ass'];

if ($objUtility->validate($h_Full_name_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($h_Full_name_ass)==false)
$Err=$Err." Expect Unicode in Field-8";
else
$objBm->setFull_name_ass($h_Full_name_ass);    
}

$j_Father_ass=$_POST['Father_ass'];
if ($objUtility->validate($j_Father_ass)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($j_Father_ass)==false)
$Err=$Err." Expect Unicode in Field-10";
else
$objBm->setFather_ass($j_Father_ass);      
}

$l_Polst_code=$_POST['Polst_code'];
if($l_Polst_code>0)
$objBm->setPolst_code($l_Polst_code);

$m_Circle=$_POST['Circle'];
if($m_Circle>0)
$objBm->setCircle($m_Circle);


$n_Mouza=$_POST['Mouza'];
if($n_Mouza>0)
$objBm->setMouza($n_Mouza);


$o_Vill_code=$_POST['Vill_code'];
if($o_Vill_code>0)
{    
$objBm->setVill_code($o_Vill_code);
$objV->setVill_code($o_Vill_code);
if ($objV->EditRecord())
$objBm->setVillage ($objV->getVill_name ());
}

if ($objBm->UpdateRecord())
$_SESSION['oldid']=$a_Case_id;    
}
$_SESSION['mvalue']=$mvalue;
header( 'Location: CommonNotice.php?tag=1');
?>
<a href=Notice.php?tag=1>Back</a>
</body>
</html>
