<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once '../bakijai/class/class.village.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objPetition_master=new Petition_master();
$Err="<font face=arial size=1 color=blue>";


//Start Validation //Pet_yr

if (isset($_POST['Petyr'])) //If HTML Field is Availbale
{
$_Pet_yr=$_POST['Petyr'];
$mvalue[0]=$_Pet_yr;
if ($objUtility->SimpleValidate($_Pet_yr,4)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Pet_yr)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-1";
}

if (strlen($_Pet_yr)==0)
$myTag++;
}
else
{
$myTag++;
echo "Pet_yr Error<br>";
}
}
else //Post Data Not Available
$_Pet_yr="NULL";


//Start Validation //Pet_no

if (isset($_POST['Petno'])) //If HTML Field is Availbale
{
$_Pet_no=$_POST['Petno'];
$mvalue[1]=$_Pet_no;
if (!is_numeric($_Pet_no))
{
$myTag++;
echo "Pet_no Error<br>";
}
}
else //Post Data Not Available
$_Pet_no="NULL";


//Start Validation //Applicant

if (isset($_POST['Applicant'])) //If HTML Field is Availbale
{
$_Applicant=$_POST['Applicant'];
$mvalue[2]=$_Applicant;
if ($objUtility->SimpleValidate($_Applicant,70)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Applicant)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-3";
}

if (strlen($_Applicant)==0)
$myTag++;
}
else
{
$myTag++;
echo "Applicant Error<br>";
}
}
else //Post Data Not Available
$_Applicant="NULL";


//Start Validation //Pet_type

if (isset($_POST['Pet_type'])) //If HTML Field is Availbale
{
$_Pet_type=$_POST['Pet_type'];
$mvalue[3]=$_Pet_type;
if ($objUtility->SimpleValidate($_Pet_type,2)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Pet_type)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-4";
}

if (strlen($_Pet_type)==0)
$myTag++;
}
else
{
$myTag++;
echo "Pet_type Error<br>";
}
}
else //Post Data Not Available
$_Pet_type="NULL";


//Start Validation //Father

if (isset($_POST['Father'])) //If HTML Field is Availbale
{
$_Father=$_POST['Father'];
$mvalue[4]=$_Father;
if ($objUtility->SimpleValidate($_Father,60)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Father)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-5";
}

if (strlen($_Father)==0)
{
$_Father="NULL";
}
}
else
{
$myTag++;
echo "Father Error<br>";
}
}
else //Post Data Not Available
$_Father="NULL";


//Start Validation //Mother

if (isset($_POST['Mother'])) //If HTML Field is Availbale
{
$_Mother=$_POST['Mother'];
$mvalue[5]=$_Mother;
if ($objUtility->SimpleValidate($_Mother,50)==true)
{
//Unicode Shouldnot Exist
if ($objUtility->isUnicodeCharExist($_Mother)==true)
{
$myTag++;
$Err=$Err." Expect NonUnicode in Field-6";
}

if (strlen($_Mother)==0)
{
$_Mother="NULL";
}
}
else
{
$myTag++;
echo "Mother Error<br>";
}
}
else //Post Data Not Available
$_Mother="NULL";


//Start Validation //Ps_code

if (isset($_POST['Ps_code'])) //If HTML Field is Availbale
{
$_Ps_code=$_POST['Ps_code'];
$mvalue[6]=$_Ps_code;
if (is_numeric($_Ps_code)==false)
{
$_Ps_code="NULL";
}
}
else //Post Data Not Available
$_Ps_code="NULL";


//Start Validation //Circle_code

if (isset($_POST['Circle_code'])) //If HTML Field is Availbale
{
$_Circle_code=$_POST['Circle_code'];
$mvalue[7]=$_Circle_code;
if (is_numeric($_Circle_code)==false)
{
$_Circle_code="NULL";
}
}
else //Post Data Not Available
$_Circle_code="NULL";


//Start Validation //Mauza_code

if (isset($_POST['Mauza_code'])) //If HTML Field is Availbale
{
$_Mauza_code=$_POST['Mauza_code'];
$mvalue[8]=$_Mauza_code;
if (is_numeric($_Mauza_code)==false)
{
$_Mauza_code="NULL";
}
}
else //Post Data Not Available
$_Mauza_code="NULL";


//Start Validation //Vill_code

if (isset($_POST['Vill_code'])) //If HTML Field is Availbale
{
$_Vill_code=$_POST['Vill_code'];
$mvalue[9]=$_Vill_code;
if (is_numeric($_Vill_code)==false)
{
$_Vill_code="NULL";
}
}
else //Post Data Not Available
$_Vill_code="NULL";


if (isset($_POST['Relation'])) //If HTML Field is Availbale
{
$_Rel=$_POST['Relation'];
$mvalue[11]=$_Rel;
}
else
{
$_Rel=" Son of";    
$mvalue[11]="";
}

if (isset($_POST['Subcaste']))
$mvalue[12]=$_POST['Subcaste'];
else
$mvalue[12]="";    

$mmode="";
if ($myTag>0) //Validation Fails
{
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
$mmode="Validation Error";
}

if ($myTag==0) //Validation OK
{
$objPetition_master->setPet_yr($_Pet_yr);
$objPetition_master->setPet_no($_Pet_no);
$objPetition_master->setApplicant($_Applicant);
$objPetition_master->setPet_type($_Pet_type);
$objPetition_master->setFather($_Father);
$objPetition_master->setMother($_Mother);
$objPetition_master->setPs_code($_Ps_code);
$objPetition_master->setCircle_code($_Circle_code);
$objPetition_master->setMauza_code($_Mauza_code);
$objPetition_master->setVill_code($_Vill_code);
$objPetition_master->setRelation($_Rel);
if($_Pet_type=="CT")
$objPetition_master->setSubcaste ($mvalue[12]);    

$objV=new Village();
$objV->setVill_code($_Vill_code);
if($objV->EditRecord())
$objPetition_master->setVillage ($objV->getVill_name ());   

$result=$objPetition_master->UpdateRecord();
$col=$objPetition_master->colUpdated;
if ($col>0)
$mmode=$col." Column Updated";
else
$mmode="Nothing to Update";
$sql=$objPetition_master->returnSql;
$_SESSION['msg']=$mmode;
if (!$result)
{
$_SESSION['msg']="SQL Error(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
$mmode="SQL Commit Error(Check Error Log File)";
}
else
{
//Clear the Required Field back to Entry Form
//$mvalue[0]="";//Pet_yr
$mvalue[1]="";//Pet_no
$mvalue[2]="";//Applicant
$mvalue[3]="0";//Pet_type
$mvalue[4]="";//Father
$mvalue[5]="";//Mother
$mvalue[6]="0";//Ps_code
$mvalue[7]="0";//Circle_code
$mvalue[8]="0";//Mauza_code
$mvalue[9]="0";//Vill_code
$mvalue[11]="";
//Succesfully update hence make an entry in sql log
if ($col>0)
$objUtility->CreateLogFile("Petition_master", $sql, 2, "M");

//$objUtility->saveSqlLog("Petition_master",$sql);

$objUtility->Backup2Access("", $sql);
$_SESSION['update']=0;
} //$result
} //$mytag==0 
$_SESSION['mvalue']=$mvalue; //Load Array for return to Form

//header( 'Location: Form_petition_master.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Editpetition.php?tag=1");
?>
</body>
</html>
