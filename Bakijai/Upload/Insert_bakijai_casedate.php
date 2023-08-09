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
if (!is_numeric($b_Day))
$myTag++;
$c_Notice_type=$_POST['Notice_type'];
$mvalue[2]=$c_Notice_type;
if (is_numeric($c_Notice_type)==false)
{
$c_Notice_type="NULL";
}
$i_Next_date=$_POST['Nextdate'];
$mvalue[3]=$i_Next_date;
if ($objUtility->isdate($i_Next_date)==false)
$myTag++;
else
$i_Next_date=$objUtility->to_mysqldate($i_Next_date);

$_SESSION['oldid']=0;
$mmode="";
$_SESSION['alert']="";
if ($myTag==0)
{
$objBakijai_casedate->setCase_id($a_Case_id);
$objBakijai_casedate->setDay($b_Day);
$objBakijai_casedate->setNotice_type($c_Notice_type);
$objBakijai_casedate->setNext_date($i_Next_date);
if ($_SESSION['update']==0)
{
$result=$objBakijai_casedate->SaveRecord();
$mmode="Notice Generated Successfully";
$sql=$objBakijai_casedate->returnSql;

$col=1;
$_SESSION['alert']=$mmode;
}
else
{
$result=$objBakijai_casedate->UpdateRecord();
$objUtility->Backup2Access("", $sql);
$col=$objBakijai_casedate->colUpdated;
if ($col>0)
$mmode="Updated Notice";
else
$mmode="Nothing to Update";
$_SESSION['alert']=$mmode;
$sql=$objBakijai_casedate->returnSql;
}
$_SESSION['msg']=$mmode;
if (!$result)
{
$_SESSION['alert']="";
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
}
else
{
$objUtility->Backup2Access("", $objBakijai_casedate->returnSql);
echo $objBakijai_casedate->returnSql;    
//Clear the Required Field back to Entry Form
// Call MaxCase_id() Function Here if available in class or required and Load in $mvalue[0]
//$mvalue[0]="";//Case_id
// Call MaxDay() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Day
// Call MaxNotice_type() Function Here if available in class or required and Load in $mvalue[2]

$_SESSION['noticetype']=$mvalue[2];
$mvalue[2]="";//Notice_type
// Call MaxNext_date() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Next_date
$mvalue[4]="";//Full_name
$mvalue[5]="";//Full_name_ass
$mvalue[6]="";//Father
$mvalue[7]="";//Father_ass
$mvalue[8]="-1";//Polst_code
$mvalue[9]="-1";//Circle
$mvalue[10]="-1";//Mouza
$mvalue[11]="-1";//Vill_code
//Succesfully update hence make an entry in sql log
if ($col>0)
//$objUtility->saveSqlLog("Bakijai_casedate",$sql);
$objUtility->CreateLogFile("Bakijai_Casedate", $sql, 2, "M");

$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
$_SESSION['oldid']=$a_Case_id;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}

//Update Defaulter particulars in Bakijai_main table
if (isset($_POST['detail'])) //update detail box is checked
{    
$objBm->setCase_id($a_Case_id);

$objHis->setCase_id($a_Case_id);
$objHis->setRsl($objHis->maxRsl($a_Case_id));

$g_Full_name=$_POST['Full_name'];
if ($objUtility->validate($g_Full_name,50)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($g_Full_name)==true)
$Err=$Err." Expect NonUnicode in Field-7";
else
$objBm->setFull_name($g_Full_name);
}

$h_Full_name_ass=$_POST['Full_name_ass'];

if ($objUtility->validate($h_Full_name_ass,100)==true)
{
//Check for Unicode if required
if ($objUtility->isUnicode($h_Full_name_ass)==false)
$Err=$Err." Expect Unicode in Field-8";
else
$objBm->setFull_name_ass($h_Full_name_ass);    
}


$i_Father=$_POST['Father'];

if ($objUtility->validate($i_Father,100)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($i_Father)==true)
$Err=$Err." Expect NonUnicode in Field-9";
else
$objBm->setFather($i_Father);      
}

$j_Father_ass=$_POST['Father_ass'];
if ($objUtility->validate($j_Father_ass,100)==true)
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
{
$objHis->setDetail($objBm->updateList."[By Notice Form]");
$objHis->SaveRecord();
}
$sql=$objBm->returnSql;
//$objUtility->saveSqlLog("Bakijai_main", $sql);
$objUtility->CreateLogFile("Bakijai_Main", $sql, 2, "M");

} //detail is checked

echo $objBm->returnSql;
//header( 'Location: Notice.php?tag=1');
//$a=$mmode;
if($c_Notice_type<6)
echo $objUtility->AlertNRedirect("", "Notice.php?tag=1");
if($c_Notice_type==7)
echo $objUtility->AlertNRedirect("", "GenerateRajahAdalat.php?id=".$a_Case_id);
?>
<a href=Notice.php?tag=1>Back</a>
</body>
</html>
