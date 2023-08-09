<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once '../bakijai/class/class.circle.php';
require_once '../bakijai/class/class.police_station.php';
require_once '../bakijai/class/class.mouza.php';
require_once '../bakijai/class/class.village.php';
require_once '../class/class.sentence.php';
require_once '../xohari/class/Class.service_request.php';
require_once '../xohari/class/Class.Officer.php';



$objSen=new Sentence();
$objPt=new Petition_type();


$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objPetition_master=new Petition_master();

$objVill=new Village();




if(isset($_POST['Phone']))
$phone=$_POST['Phone'];
else
$phone=""; 

if (isset($_POST['Challanamt']))
$Challanamt=$_POST['Challanamt'];
else
$Challanamt="0";

if (isset($_POST['Challanno']))
$Challanno=$_POST['Challanno'];
else
$Challanno="";


$_SESSION['Recpno1']="";
$_SESSION['Recpno2']="";
$_SESSION['Applicant']="";
$_SESSION['certtype']="";
$Err="<font face=arial size=1 color=blue>";

$b_Pet_type=$_POST['Pet_type'];
$mvalue[0]=$b_Pet_type;

if ($objUtility->validate($b_Pet_type)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($b_Pet_type)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-1";
}

if (strlen($b_Pet_type)==0)
$myTag++;
}
else
$myTag++;

$c_Pet_yr=date('Y');


$d_Pet_date=date('Y-m-d'); //System Date


$e_Pet_no=$objPetition_master->maxPet_no($c_Pet_yr);

$mvalue[3]=$e_Pet_no;

$_SESSION['Pet_no']=$e_Pet_no;
$f_Applicant=$_POST['Applicant'];
$mvalue[4]=$f_Applicant;
if ($objUtility->validate($f_Applicant)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($f_Applicant)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($f_Applicant)==0)
$myTag++;
}
else
$myTag++;
$g_Relation=$_POST['Relation'];

$mvalue[5]=$g_Relation;


$h_Father=$_POST['Father'];
$mvalue[6]=$h_Father;
if ($objUtility->validate($h_Father)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($h_Father)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-7";
}

if (strlen($h_Father)==0)
{
$h_Father="NULL";
}
}
else
$myTag++;

if (isset($_POST['Mother']))
{
$i_Mother=$_POST['Mother'];
$mvalue[7]=$i_Mother;
if ($objUtility->validate($i_Mother)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($i_Mother)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-8";
}

if (strlen($i_Mother)==0)
{
$i_Mother="NULL";
}
}
else
$myTag++;
}
else
$i_Mother="NULL";    


$l_Circle_code=$_POST['Circle_code'];
$mvalue[8]=$l_Circle_code;

$m_Ps_code=$_POST['Ps_code'];
$mvalue[9]=$m_Ps_code;

$n_Mauza_code=$_POST['Mauzacode'];
$mvalue[10]=$n_Mauza_code;


$o_Vill_code=$_POST['Villcode'];
$mvalue[11]=$o_Vill_code;

if (isset($_POST['Ward']))
{
$q_Ward=$_POST['Ward'];
$mvalue[12]=$q_Ward;

if ($objUtility->validate($q_Ward)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($q_Ward)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-13";
}

if (strlen($q_Ward)==0)
{
$q_Ward="NULL";
}
}
else
$myTag++;
}
else
$q_Ward="NULL";
//echo $_POST['Co_letter'];
if (isset($_POST['Co_letter']))
{   
$r_Co_letter=$_POST['Co_letter'];
$mvalue[13]=$r_Co_letter;
if ($objUtility->validate($r_Co_letter)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($r_Co_letter)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-14";
}

if (strlen($r_Co_letter)==0)
{
$r_Co_letter="NULL";
}
}
else
$myTag++;
}
else
$r_Co_letter="NULL";


if (isset($_POST['Co_letter_dt']))
{
$s_Co_letter_dt=$_POST['Co_letter_dt'];
$mvalue[14]=$s_Co_letter_dt;
if ($objUtility->validate($s_Co_letter_dt)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($s_Co_letter_dt)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-15";
}

if (strlen($s_Co_letter_dt)==0)
{
$s_Co_letter_dt="NULL";
}
}
else
$myTag++;
}
else
$s_Co_letter_dt="NULL";

if (isset($_POST['Bpl']))
$t_Bpl="Y";
else
$t_Bpl="N";  

$mvalue[15]=$t_Bpl;


$ad_Exp_dt=$_POST['Exp_dt'];
$mvalue[17]=$ad_Exp_dt;
if ($objUtility->isdate($ad_Exp_dt)==false)
{
if (strlen($ad_Exp_dt)==0)
{
$ad_Exp_dt="NULL";
}
else
$myTag++;
}
else
$ad_Exp_dt=$objUtility->to_mysqldate($ad_Exp_dt);

if (isset($_POST['Sex']))
{
$ai_Sex=$_POST['Sex'];
$mvalue[18]=$ai_Sex;
}
else
$ai_Sex="NULL";

if (isset($_POST['Dob']))
{
$aj_Dob=$_POST['Dob'];
$mvalue[19]=$aj_Dob;
if ($objUtility->isdate($aj_Dob)==false)
{
if (strlen($aj_Dob)==0)
{
$aj_Dob="NULL";
}
else
$myTag++;
}
else
$aj_Dob=$objUtility->to_mysqldate($aj_Dob);
}
else
$aj_Dob="NULL";    


if (isset($_POST['Patta_no']))
{
$al_Patta_no=$_POST['Patta_no'];
$mvalue[21]=$al_Patta_no;
if ($objUtility->validate($al_Patta_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($al_Patta_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-22";
}

if (strlen($al_Patta_no)==0)
{
$al_Patta_no="NULL";
}
}
else
$myTag++;
}
else
$al_Patta_no="NULL";

if (isset($_POST['Lac_no']))
{    
$ao_Lac_no=$_POST['Lac_no'];
$mvalue[24]=$ao_Lac_no;
}
else
{
$ao_Lac_no="0";
$mvalue[24]=$ao_Lac_no;    
}    


if (isset($_POST['Part_no']))
{ 
$ap_Part_no=$_POST['Part_no'];
$mvalue[25]=$ap_Part_no;
if ($objUtility->validate($ap_Part_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($ap_Part_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-26";
}

if (strlen($ap_Part_no)==0)
{
$ap_Part_no="NULL";
}
}
else
$myTag++;
}
else
$ap_Part_no="NULL";    

if (isset($_POST['House_no']))
{ 
$aq_House_no=$_POST['House_no'];
$mvalue[26]=$aq_House_no;
if ($objUtility->validate($aq_House_no)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($aq_House_no)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-27";
}

if (strlen($aq_House_no)==0)
{
$aq_House_no="NULL";
}
}
else
$myTag++;
}
else
$aq_House_no="NULL";    

$col=0;
$mmode="";
if ($myTag==0)
{
$f_Applicant=$objSen->SentenceCase($f_Applicant);
$_SESSION['Applicant']=$f_Applicant;
if($h_Father!="NULL")
$h_Father=$objSen->SentenceCase($h_Father);
if($i_Mother!="NULL")
$i_Mother=$objSen->SentenceCase($i_Mother);

$objPetition_master->setId($objPetition_master->maxID());
$objPetition_master->setPet_type($b_Pet_type);
$objPetition_master->setPet_yr($c_Pet_yr);
$objPetition_master->setPet_date($d_Pet_date);
$objPetition_master->setPet_no($e_Pet_no);
$objPetition_master->setApplicant($f_Applicant);
$objPetition_master->setRelation($g_Relation);
$objPetition_master->setFather($h_Father);
$objPetition_master->setMother($i_Mother);
$objPetition_master->setCircle_code($l_Circle_code);
$objPetition_master->setPs_code($m_Ps_code);
$objPetition_master->setMauza_code($n_Mauza_code);
$objPetition_master->setVill_code($o_Vill_code);
$objPetition_master->setPhone($phone);
if($b_Pet_type=="BK"){
$objPetition_master->setFees(20);
}

if (!isset($_POST['Village'])) //Village Available in Select Box
{    
$objVill->setVill_code($o_Vill_code);
if ($objVill->EditRecord())
{
$vill=$objVill->getVill_name();
$objPetition_master->setVillage ($vill);
}
}
else  //'Village from Tetxt box'
{   
$vill=$_POST['Village'];    
$objPetition_master->setVillage ($vill);
}


$objPetition_master->setWard($q_Ward);
$objPetition_master->setCo_letter($r_Co_letter);
$objPetition_master->setCo_letter_dt($s_Co_letter_dt);
$objPetition_master->setBpl($t_Bpl);
$objPetition_master->setExp_dt($ad_Exp_dt);
$objPetition_master->setSex($ai_Sex);
$objPetition_master->setDob($aj_Dob);
$objPetition_master->setPatta_no($al_Patta_no);
$objPetition_master->setLac_no($ao_Lac_no);
$objPetition_master->setPart_no($ap_Part_no);
$objPetition_master->setHouse_no($aq_House_no);

$objPetition_master->setChallan_no($Challanno);
$objPetition_master->setChallan_amount($Challanamt);

echo $Challanno." ".$Challanamt."<br>";

if (isset($_POST['Patta_type']))
$objPetition_master->setPatta_type ($_POST['Patta_type']);
 
if (isset($_SESSION['username']))
$objPetition_master->setEntered_by ($_SESSION['username']);

if ($_SESSION['update']==0)
{
$result=$objPetition_master->SaveRecord();
$mmode="Petition Registered Successfully No.".$b_Pet_type."/".$e_Pet_no."/".$c_Pet_yr;
$_SESSION['Recpno1']=$b_Pet_type."/".$e_Pet_no."/".$c_Pet_yr;
$sql=$objPetition_master->returnSql;
echo $sql;
}

$_SESSION['msg']=$mmode;

if (!$result)
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
}
else
{
$col=1;    
//Add an Entry in Lohg   
$objUtility->CreateLogFile("Petition_master", $sql, 2, "M");

$objUtility->Backup2Access("", $sql);
    
$objPt->setCode($mvalue[0]);
echo "<br>mvalue0=".$mvalue[0];
if( $objPt->EditRecord())
{
$scode=$objPt->getXohari_serviceid();
$_SESSION['certtype']=$objPt->getDetail();
}
else
$scode=0;
echo "<br>ssql=".$objPt->returnSql;
echo "<br>servicecode=".$scode;
//XOHARI UPDATE'
if ($scode>0)  //ARTPS Entry Required
{
$objReq=new Service_request(); //Object for Xohari
$objO=new Officer();    //Object for Xohari
$col=0; //Reinitialise $col'
$yr=date('Y');
$objO->EditOfficerDetail($scode);
echo $objO->returnSql;
$objReq->setService_id($scode);
$objReq->setId($objReq->maxId($yr));
$objReq->setRequest_id($objReq->maxRequestId($yr));
$_SESSION['Recpno2']=$objReq->maxRequestId($yr);
$objReq->setOfficer_id($objO->getId());  //default
$objReq->setOffice_id($objO->getOffice_id());
$objReq->setApplicant_name($f_Applicant);
$objReq->setDelivery_date($ad_Exp_dt);
$objReq->setApplicant_address("Vill-".$vill);
$objReq->setApplicant_phone_no($phone);
$objReq->setRecieve_date(date('Y-m-d'));
$objReq->setRejected("0");
$objReq->setApplicant_phone_no($phone);

if ($objReq->SaveRecord())
{
//Create a object of Petition Master
$objPm=new Petition_master(); //set a link for Xorari ID in Petition Master Table
$objPm->setXohari_requestid($_SESSION['Recpno2']);   
$objPm->setPet_no($e_Pet_no);
$objPm->setPet_yr($c_Pet_yr);    
$sql=$objReq->returnSql;
//Add an Entry in Log   
$objUtility->saveSqlLog("Service_Request",$sql);
$col++;
$objPm->UpdateRecord(); //updated a link to xohari
$sql=$objPm->returnSql;
//$objUtility->saveSqlLog("Petition_master",$sql);
echo "updatelinjk".$sql."<br>";
}
else //failed to save the petition in xohari ,So delete from petition master also
{
//Create a object of Petition Master
$objPm=new Petition_master(); //set a link for Xorari ID in Petition Master Table
$objPm->setXohari_requestid($_SESSION['Recpno2']);   
$objPm->setPet_no($e_Pet_no);
$objPm->setPet_yr($c_Pet_yr);    
$sql=$objReq->returnSql;    
$objPm->DeleteRecord();   
$_SESSION['msg']="Couldnot Update in Xohari Database, Hence Deleted from Petition Master Also";
}
} //$service code>0
echo "<br>".$sql."<br>";
//Clear the Required Field back to Entry Form
// Call MaxPet_type() Function Here if available in class or required and Load in $mvalue[0]
$mvalue[0]="";//Pet_type
// Call MaxPet_yr() Function Here if available in class or required and Load in $mvalue[1]
$mvalue[1]="";//Pet_yr
// Call MaxPet_date() Function Here if available in class or required and Load in $mvalue[2]
$mvalue[2]="";//Pet_date
// Call MaxPet_no() Function Here if available in class or required and Load in $mvalue[3]
$mvalue[3]="";//Pet_no
// Call MaxApplicant() Function Here if available in class or required and Load in $mvalue[4]
$mvalue[4]="";//Applicant
// Call MaxRelation() Function Here if available in class or required and Load in $mvalue[5]
$mvalue[5]="";//Relation
// Call MaxFather() Function Here if available in class or required and Load in $mvalue[6]
$mvalue[6]="";//Father
// Call MaxMother() Function Here if available in class or required and Load in $mvalue[7]
$mvalue[7]="";//Mother
// Call MaxCircle_code() Function Here if available in class or required and Load in $mvalue[8]
$mvalue[8]="0";//Circle_code
// Call MaxPs_code() Function Here if available in class or required and Load in $mvalue[9]
$mvalue[9]="0";//Ps_code
// Call MaxMauza_code() Function Here if available in class or required and Load in $mvalue[10]
$mvalue[10]="0";//Mauza_code
// Call MaxVill_code() Function Here if available in class or required and Load in $mvalue[11]
$mvalue[11]="0";//Vill_code
// Call MaxWard() Function Here if available in class or required and Load in $mvalue[12]
$mvalue[12]="";//Ward
// Call MaxCo_letter() Function Here if available in class or required and Load in $mvalue[13]
$mvalue[13]="";//Co_letter
// Call MaxCo_letter_dt() Function Here if available in class or required and Load in $mvalue[14]
$mvalue[14]="";//Co_letter_dt
// Call MaxBpl() Function Here if available in class or required and Load in $mvalue[15]
$mvalue[15]="";//Bpl
// Call MaxIntroduced_by() Function Here if available in class or required and Load in $mvalue[16]
$mvalue[16]="";//Introduced_by
// Call MaxExp_dt() Function Here if available in class or required and Load in $mvalue[17]
$mvalue[17]="";//Exp_dt
// Call MaxSex() Function Here if available in class or required and Load in $mvalue[18]
$mvalue[18]="";//Sex
// Call MaxDob() Function Here if available in class or required and Load in $mvalue[19]
$mvalue[19]="";//Dob
// Call MaxPeriod() Function Here if available in class or required and Load in $mvalue[20]
$mvalue[20]="";//Period
// Call MaxPatta_no() Function Here if available in class or required and Load in $mvalue[21]
$mvalue[21]="";//Patta_no
// Call MaxCaste() Function Here if available in class or required and Load in $mvalue[22]
$mvalue[22]="";//Caste
// Call MaxSubcaste() Function Here if available in class or required and Load in $mvalue[23]
$mvalue[23]="";//Subcaste
// Call MaxLac_no() Function Here if available in class or required and Load in $mvalue[24]
$mvalue[24]="0";//Lac_no
// Call MaxPart_no() Function Here if available in class or required and Load in $mvalue[25]
$mvalue[25]="";//Part_no
// Call MaxHouse_no() Function Here if available in class or required and Load in $mvalue[26]
$mvalue[26]="";//House_no
// Call MaxCountersignature() Function Here if available in class or required and Load in $mvalue[27]
$mvalue[27]="";//Countersignature
//Succesfully update hence make an entry in sql log
if ($col>0)
{    
//$objUtility->saveSqlLog("Petition_master",$sql);
}
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
}

echo "<br>LastCol value-".$col;

if ($col==1) //Both Entry Success
header( 'Location: Result.php');
else
header( 'Location: Pet_Entry.php?tag=1');    

//$_SESSION['Recpno2']
?>
<a href=Pet_Entry.php?tag=1>Back</a>
</body>
</html>
