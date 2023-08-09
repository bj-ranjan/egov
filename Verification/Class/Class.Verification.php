<?php
//require_once 'class.config.php';
require_once '../class/utility.class.php';
require_once '../class/class.DBManager.php';
class Verification extends DBManager
{
private $Var=array();
private $OldVar=array();
private $DataType=array();
private $IsNull=array();
private $IsUtf=array();
private $MaxLength=array();
private $DataSet=array();

private $StrongValid=array(); //strong validation
private $SingleQuote=array(); // allow single quote
private $Pattern=array(); // Regular Expression



//In order to add more field, append the field name in the array $fieldList
//and Create get and set method for the field.

private $fieldList=array("Id","District","Verification_type","Letter_no","Letter_date","Sender","Department","Address","Pin","Letter_no_sent","Start_date","Name","Reln","Rel_name","Circle","Pol_stn","Village","Pol_status","Pol_letter_no","Pol_letter_date","Pol_report","Report_type","Dc_status","Issue_no","Issue_date","Caste","Dis");
//"Sender","T2","T3","T4","T5";
private $Table="verification";

private $condString;
public $colUpdated;
public $updateList;
public $ValidationErrorList;

//public function _construct($i) //for PHP6
public function Verification()
{
parent::__construct();
$this->colUpdated=0;
$this->updateList="";
$this->ValidationErrorList="";
$this->condString="1=1";
$this->GlobalDataType['Letter_date']="Date";
$this->GlobalDataType['Start_date']="Date";
$this->GlobalDataType['Pol_letter_date']="Date";
$this->GlobalDataType['Issue_date']="Date";
//Change Fld Index as NVARCHAR if SQL Server and Unicode is to be Handled
//$this->GlobalDataType['fldindex']="NVARCHAR";

//Example of Regular Expression
//$patern="/[A-Z]{3}[0-9]{7}/"; // First 3 Charactr as A to Z and rest 7 char from 0 to 9
//$patern="/[a-Z]{3}[0-9]{7}/"; // First 3 Charactr as(a to Z) and rest 7 char from 0 to 9
//$patern="/^a/";//Starting with a
//$patern="/a$/";//Ending with a 

}//End constructor


public function rowCount($condition)
{
return($this->CountRecords("verification", $condition));
} //rowCount



public function CommonGet($FieldIndex)
{
if(isset($this->Var[$FieldIndex]))
return($this->Var[$FieldIndex]);
}


public function CommonSet($FieldIndex,$Value,$DataType,$Null,$Max)
{
$this->Var[$FieldIndex]=$Value;
$this->DataSet[$FieldIndex]=1;
$this->DataType[$FieldIndex]=$DataType;
$this->IsNull[$FieldIndex]=$Null;
$this->MaxLength[$FieldIndex]=$Max;
}

public function getId()
{
if(isset($this->Var['Id']))
return($this->Var['Id']);
else
return("");
}

public function setId($str)
{

$this->Var['Id']=$str;
$this->DataSet['Id']=1;
$this->DataType['Id']="BIGINT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Id']=0;
$this->IsUtf['Id']=0;

$this->Pattern['Id']="";//Use Regular Expression


}

public function getDistrict()
{
if(isset($this->Var['District']))
return($this->Var['District']);
else
return("");
}

public function setDistrict($str)
{

$this->Var['District']=$str;
$this->DataSet['District']=1;
$this->DataType['District']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['District']=1;
$this->IsUtf['District']=0;
$this->MaxLength['District']=20;
$this->SingleQuote['District']=0;//1- for Allow Single Quote
$this->StrongValid['District']=0;//1- for strong Valiadtion

$this->Pattern['District']="";//Use Regular Expression


}

public function getVerification_type()
{
if(isset($this->Var['Verification_type']))
return($this->Var['Verification_type']);
else
return("");
}

public function setVerification_type($str)
{

$this->Var['Verification_type']=$str;
$this->DataSet['Verification_type']=1;
$this->DataType['Verification_type']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Verification_type']=0;
$this->IsUtf['Verification_type']=0;

$this->Pattern['Verification_type']="";//Use Regular Expression


}

public function getLetter_no()
{
if(isset($this->Var['Letter_no']))
return($this->Var['Letter_no']);
else
return("");
}

public function setLetter_no($str)
{

$this->Var['Letter_no']=$str;
$this->DataSet['Letter_no']=1;
$this->DataType['Letter_no']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Letter_no']=1;
$this->IsUtf['Letter_no']=0;
$this->MaxLength['Letter_no']=100;
$this->SingleQuote['Letter_no']=1;//1- for Allow Single Quote
$this->StrongValid['Letter_no']=0;//1- for strong Valiadtion

$this->Pattern['Letter_no']="";//Use Regular Expression


}

public function getLetter_date()
{
if(isset($this->Var['Letter_date']))
return($this->Var['Letter_date']);
else
return("");
}

public function setLetter_date($str)
{
$objU=new Utility();
if($objU->isdate($str))
$str=$objU->to_mysqldate($str);

$this->Var['Letter_date']=$str;
$this->DataSet['Letter_date']=1;
$this->DataType['Letter_date']="DATE";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Letter_date']=1;
$this->IsUtf['Letter_date']=0;

$this->Pattern['Letter_date']="";//Use Regular Expression


}

public function getDepartment()
{
if(isset($this->Var['Department']))
return($this->Var['Department']);
else
return("");
}

public function setDepartment($str)
{

$this->Var['Department']=$str;
$this->DataSet['Department']=1;
$this->DataType['Department']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Department']=1;
$this->IsUtf['Department']=0;
$this->MaxLength['Department']=300;
$this->SingleQuote['Department']=1;//1- for Allow Single Quote
$this->StrongValid['Department']=0;//1- for strong Valiadtion

$this->Pattern['Department']="";//Use Regular Expression


}

public function getAddress()
{
if(isset($this->Var['Address']))
return($this->Var['Address']);
else
return("");
}

public function setAddress($str)
{

$this->Var['Address']=$str;
$this->DataSet['Address']=1;
$this->DataType['Address']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Address']=1;
$this->IsUtf['Address']=0;
$this->MaxLength['Address']=100;
$this->SingleQuote['Address']=0;//1- for Allow Single Quote
$this->StrongValid['Address']=0;//1- for strong Valiadtion

$this->Pattern['Address']="";//Use Regular Expression


}

public function getPin()
{
if(isset($this->Var['Pin']))
return($this->Var['Pin']);
else
return("");
}

public function setPin($str)
{

$this->Var['Pin']=$str;
$this->DataSet['Pin']=1;
$this->DataType['Pin']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pin']=0;
$this->IsUtf['Pin']=0;
$this->MaxLength['Pin']=6;
$this->SingleQuote['Pin']=0;//1- for Allow Single Quote
$this->StrongValid['Pin']=0;//1- for strong Valiadtion

$this->Pattern['Pin']="";//Use Regular Expression


}

public function getLetter_no_sent()
{
if(isset($this->Var['Letter_no_sent']))
return($this->Var['Letter_no_sent']);
else
return("");
}

public function setLetter_no_sent($str)
{

$this->Var['Letter_no_sent']=$str;
$this->DataSet['Letter_no_sent']=1;
$this->DataType['Letter_no_sent']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Letter_no_sent']=1;
$this->IsUtf['Letter_no_sent']=0;
$this->MaxLength['Letter_no_sent']=120;
$this->SingleQuote['Letter_no_sent']=0;//1- for Allow Single Quote
$this->StrongValid['Letter_no_sent']=0;//1- for strong Valiadtion

$this->Pattern['Letter_no_sent']="";//Use Regular Expression


}

public function getStart_date()
{
if(isset($this->Var['Start_date']))
return($this->Var['Start_date']);
else
return("");
}

public function setStart_date($str)
{
$objU=new Utility();
if($objU->isdate($str))
$str=$objU->to_mysqldate($str);

$this->Var['Start_date']=$str;
$this->DataSet['Start_date']=1;
$this->DataType['Start_date']="DATE";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Start_date']=0;
$this->IsUtf['Start_date']=0;

$this->Pattern['Start_date']="";//Use Regular Expression


}

public function getName()
{
if(isset($this->Var['Name']))
return($this->Var['Name']);
else
return("");
}

public function setName($str)
{

$this->Var['Name']=$str;
$this->DataSet['Name']=1;
$this->DataType['Name']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Name']=0;
$this->IsUtf['Name']=0;
$this->MaxLength['Name']=50;
$this->SingleQuote['Name']=0;//1- for Allow Single Quote
$this->StrongValid['Name']=0;//1- for strong Valiadtion

$this->Pattern['Name']="";//Use Regular Expression


}

public function getReln()
{
if(isset($this->Var['Reln']))
return($this->Var['Reln']);
else
return("");
}

public function setReln($str)
{

$this->Var['Reln']=$str;
$this->DataSet['Reln']=1;
$this->DataType['Reln']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Reln']=1;
$this->IsUtf['Reln']=0;
$this->MaxLength['Reln']=20;
$this->SingleQuote['Reln']=0;//1- for Allow Single Quote
$this->StrongValid['Reln']=0;//1- for strong Valiadtion

$this->Pattern['Reln']="";//Use Regular Expression


}

public function getRel_name()
{
if(isset($this->Var['Rel_name']))
return($this->Var['Rel_name']);
else
return("");
}

public function setRel_name($str)
{

$this->Var['Rel_name']=$str;
$this->DataSet['Rel_name']=1;
$this->DataType['Rel_name']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Rel_name']=0;
$this->IsUtf['Rel_name']=0;
$this->MaxLength['Rel_name']=40;
$this->SingleQuote['Rel_name']=0;//1- for Allow Single Quote
$this->StrongValid['Rel_name']=0;//1- for strong Valiadtion

$this->Pattern['Rel_name']="";//Use Regular Expression


}

public function getCir_name()
{
if(isset($this->Var['Cir_name']))
return($this->Var['Cir_name']);
else
return("");
}

public function setCir_name($str)
{

$this->Var['Cir_name']=$str;
$this->DataSet['Cir_name']=1;
$this->DataType['Cir_name']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Cir_name']=1;
$this->IsUtf['Cir_name']=0;
$this->MaxLength['Cir_name']=30;
$this->SingleQuote['Cir_name']=0;//1- for Allow Single Quote
$this->StrongValid['Cir_name']=0;//1- for strong Valiadtion

$this->Pattern['Cir_name']="";//Use Regular Expression


}

public function getCircle()
{
if(isset($this->Var['Circle']))
return($this->Var['Circle']);
else
return("");
}

public function setCircle($str)
{

$this->Var['Circle']=$str;
$this->DataSet['Circle']=1;
$this->DataType['Circle']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Circle']=0;
$this->IsUtf['Circle']=0;

$this->Pattern['Circle']="";//Use Regular Expression


}

public function getPs()
{
if(isset($this->Var['Ps']))
return($this->Var['Ps']);
else
return("");
}

public function setPs($str)
{

$this->Var['Ps']=$str;
$this->DataSet['Ps']=1;
$this->DataType['Ps']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Ps']=1;
$this->IsUtf['Ps']=0;
$this->MaxLength['Ps']=30;
$this->SingleQuote['Ps']=0;//1- for Allow Single Quote
$this->StrongValid['Ps']=0;//1- for strong Valiadtion

$this->Pattern['Ps']="";//Use Regular Expression


}

public function getPol_stn()
{
if(isset($this->Var['Pol_stn']))
return($this->Var['Pol_stn']);
else
return("");
}

public function setPol_stn($str)
{

$this->Var['Pol_stn']=$str;
$this->DataSet['Pol_stn']=1;
$this->DataType['Pol_stn']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pol_stn']=0;
$this->IsUtf['Pol_stn']=0;

$this->Pattern['Pol_stn']="";//Use Regular Expression


}

public function getVillage()
{
if(isset($this->Var['Village']))
return($this->Var['Village']);
else
return("");
}

public function setVillage($str)
{

$this->Var['Village']=$str;
$this->DataSet['Village']=1;
$this->DataType['Village']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Village']=1;
$this->IsUtf['Village']=0;
$this->MaxLength['Village']=100;
$this->SingleQuote['Village']=0;//1- for Allow Single Quote
$this->StrongValid['Village']=0;//1- for strong Valiadtion

$this->Pattern['Village']="";//Use Regular Expression


}

public function getPol_status()
{
if(isset($this->Var['Pol_status']))
return($this->Var['Pol_status']);
else
return("");
}

public function setPol_status($str)
{

$this->Var['Pol_status']=$str;
$this->DataSet['Pol_status']=1;
$this->DataType['Pol_status']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pol_status']=0;
$this->IsUtf['Pol_status']=0;
$this->MaxLength['Pol_status']=10;
$this->SingleQuote['Pol_status']=0;//1- for Allow Single Quote
$this->StrongValid['Pol_status']=0;//1- for strong Valiadtion

$this->Pattern['Pol_status']="";//Use Regular Expression


}

public function getPol_letter_no()
{
if(isset($this->Var['Pol_letter_no']))
return($this->Var['Pol_letter_no']);
else
return("");
}

public function setPol_letter_no($str)
{

$this->Var['Pol_letter_no']=$str;
$this->DataSet['Pol_letter_no']=1;
$this->DataType['Pol_letter_no']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pol_letter_no']=1;
$this->IsUtf['Pol_letter_no']=0;
$this->MaxLength['Pol_letter_no']=90;
$this->SingleQuote['Pol_letter_no']=0;//1- for Allow Single Quote
$this->StrongValid['Pol_letter_no']=0;//1- for strong Valiadtion

$this->Pattern['Pol_letter_no']="";//Use Regular Expression


}

public function getPol_letter_date()
{
if(isset($this->Var['Pol_letter_date']))
return($this->Var['Pol_letter_date']);
else
return("");
}

public function setPol_letter_date($str)
{
$objU=new Utility();
if($objU->isdate($str))
$str=$objU->to_mysqldate($str);

$this->Var['Pol_letter_date']=$str;
$this->DataSet['Pol_letter_date']=1;
$this->DataType['Pol_letter_date']="DATE";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pol_letter_date']=1;
$this->IsUtf['Pol_letter_date']=0;

$this->Pattern['Pol_letter_date']="";//Use Regular Expression


}

public function getPol_report()
{
if(isset($this->Var['Pol_report']))
return($this->Var['Pol_report']);
else
return("");
}

public function setPol_report($str)
{

$this->Var['Pol_report']=$str;
$this->DataSet['Pol_report']=1;
$this->DataType['Pol_report']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Pol_report']=1;
$this->IsUtf['Pol_report']=0;
$this->MaxLength['Pol_report']=50;
$this->SingleQuote['Pol_report']=0;//1- for Allow Single Quote
$this->StrongValid['Pol_report']=0;//1- for strong Valiadtion

$this->Pattern['Pol_report']="";//Use Regular Expression


}

public function getReport_type()
{
if(isset($this->Var['Report_type']))
return($this->Var['Report_type']);
else
return("");
}

public function setReport_type($str)
{

$this->Var['Report_type']=$str;
$this->DataSet['Report_type']=1;
$this->DataType['Report_type']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Report_type']=1;
$this->IsUtf['Report_type']=0;
$this->MaxLength['Report_type']=50;
$this->SingleQuote['Report_type']=0;//1- for Allow Single Quote
$this->StrongValid['Report_type']=0;//1- for strong Valiadtion

$this->Pattern['Report_type']="";//Use Regular Expression


}

public function getDc_status()
{
if(isset($this->Var['Dc_status']))
return($this->Var['Dc_status']);
else
return("");
}

public function setDc_status($str)
{

$this->Var['Dc_status']=$str;
$this->DataSet['Dc_status']=1;
$this->DataType['Dc_status']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Dc_status']=0;
$this->IsUtf['Dc_status']=0;
$this->MaxLength['Dc_status']=10;
$this->SingleQuote['Dc_status']=0;//1- for Allow Single Quote
$this->StrongValid['Dc_status']=0;//1- for strong Valiadtion

$this->Pattern['Dc_status']="";//Use Regular Expression


}

public function getIssue_no()
{
if(isset($this->Var['Issue_no']))
return($this->Var['Issue_no']);
else
return("");
}

public function setIssue_no($str)
{

$this->Var['Issue_no']=$str;
$this->DataSet['Issue_no']=1;
$this->DataType['Issue_no']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Issue_no']=1;
$this->IsUtf['Issue_no']=0;
$this->MaxLength['Issue_no']=100;
$this->SingleQuote['Issue_no']=0;//1- for Allow Single Quote
$this->StrongValid['Issue_no']=0;//1- for strong Valiadtion

$this->Pattern['Issue_no']="";//Use Regular Expression


}

public function getIssue_date()
{
if(isset($this->Var['Issue_date']))
return($this->Var['Issue_date']);
else
return("");
}

public function setIssue_date($str)
{
$objU=new Utility();
if($objU->isdate($str))
$str=$objU->to_mysqldate($str);

$this->Var['Issue_date']=$str;
$this->DataSet['Issue_date']=1;
$this->DataType['Issue_date']="DATE";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Issue_date']=1;
$this->IsUtf['Issue_date']=0;

$this->Pattern['Issue_date']="";//Use Regular Expression


}

public function getCaste()
{
if(isset($this->Var['Caste']))
return($this->Var['Caste']);
else
return("");
}

public function setCaste($str)
{

$this->Var['Caste']=$str;
$this->DataSet['Caste']=1;
$this->DataType['Caste']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Caste']=1;
$this->IsUtf['Caste']=0;
$this->MaxLength['Caste']=10;
$this->SingleQuote['Caste']=0;//1- for Allow Single Quote
$this->StrongValid['Caste']=0;//1- for strong Valiadtion

$this->Pattern['Caste']="";//Use Regular Expression


}




//Extra Reserve Field
public function getSender()
{
if(isset($this->Var['Sender']))
return($this->Var['Sender']);
else
return("");
}


public function setSender($str)
{
$this->Var['Sender']=$str;
$this->DataSet['Sender']=1;
$this->DataType['Sender']="VARCHAR";
$this->IsNull['Sender']=1;
$this->IsUtf['Sender']=0;
$this->MaxLength['Sender']=120;
}

public function getT2()
{
if(isset($this->Var['T2']))
return($this->Var['T2']);
else
return("");
}


public function setT2($str)
{
$this->Var['T2']=$str;
$this->DataSet['T2']=1;
$this->DataType['T2']="VARCHAR";
$this->IsNull['T2']=1;
$this->IsUtf['T2']=0;
$this->MaxLength['T2']=100;
}

public function getT3()
{
if(isset($this->Var['T3']))
return($this->Var['T3']);
else
return("");
}


public function setT3($str)
{
$this->Var['T3']=$str;
$this->DataSet['T3']=1;
$this->DataType['T3']="VARCHAR";
$this->IsNull['T3']=1;
$this->IsUtf['T3']=0;
$this->MaxLength['T3']=100;
}

public function getT4()
{
if(isset($this->Var['T4']))
return($this->Var['T4']);
else
return("");
}


public function setT4($str)
{
$this->Var['T4']=$str;
$this->DataSet['T4']=1;
$this->DataType['T4']="VARCHAR";
$this->IsNull['T4']=1;
$this->IsUtf['T4']=0;
$this->MaxLength['T4']=100;
}

public function getT5()
{
if(isset($this->Var['T5']))
return($this->Var['T5']);
else
return("");
}


public function setT5($str)
{
$this->Var['T5']=$str;
$this->DataSet['T5']=1;
$this->DataType['T5']="VARCHAR";
$this->IsNull['T5']=1;
$this->IsUtf['T5']=0;
$this->MaxLength['T5']=100;
}



public function setCondString($str)
{
$this->condString=$str;
}



private function generateCondition()
{
$cond=" 1=1  ";
if (isset($this->Var['Id']))
$cond.=" and Id='".$this->Var['Id']."'";
else
$cond.=" and false";
return($cond);
}//Generate Condition String


private function copyVariable()
{
$cond=$this->generateCondition();
$row=$this->FetchSingleRecord($this->Table,$this->fieldList,$cond);
if (count($row)>0)
{
for($index=0;$index<count($this->fieldList);$index++)
{
$mIndex=$this->fieldList[$index];
$fIndex="Old_".$mIndex;
$this->OldVar[$fIndex]=$row[$mIndex] ;
}//for loop
return(true);
}
else
return(false);
} //end copy variable


public function EditOnCondition($cond)
{
$row=array();
$row=$this->FetchSingleRecord($this->Table,$this->fieldList,$cond);
if (count($row)>0)
{
for($index=0;$index<count($this->fieldList);$index++)
{
$fIndex=$this->fieldList[$index];
$this->Var[$fIndex]=$row[$fIndex] ;
$this->DataSet[$fIndex]=1;
}//for loop
return(true);
}
else
return(false);
} //end Edit Record on Condition



public function EditRecord()
{
$cond=$this->generateCondition();
return($this->EditOnCondition($cond));
} //end EditRecord


public function Available()
{
$cond=$this->generateCondition();

$row=$this->FetchSingleRecord($this->Table,$this->fieldList,$cond);
if (count($row)>0)
return(true);
else
return(false);
} //end Available




public function maxId()
{
$cond="1=1";
return($this->Max($this->Table, "Id", $cond)+1);
}//Max





public function getAllRecord($cond)
{
$tRows=array();
$tRows=$this->FetchMultipleRecords($this->Table,$this->fieldList,$cond);
return($tRows);
} //End getAllRecord


public function UpdateRecord()
{
$this->copyVariable();
$mError=0;
$res=false;
$UpdateString=$this->genUpdateString($mError,$i);
if($mError==0 && $i>0)
{
if ($this->ExecuteQuery($UpdateString))
$res=true;
}
return($res);
}//End UpdateRecord


private function DataChanged($ind)
{
$data1="";
$data2="";
$objU=new Utility();
$dtype="";
if(isset($this->DataType[$ind]))
$dtype=strtoupper($this->DataType[$ind]);
if(isset($this->Var[$ind]))
$data1=$this->Var[$ind];
if(preg_match("/DATE/",$dtype))
{
if($objU->ismysqldate($data1))
$data1=$objU->to_date($data1);
}
$oind="Old_".$ind;
if(isset($this->OldVar[$oind]))
$data2=$this->OldVar[$oind];
if($data1=="NULL")
$data1="";
if(preg_match("/DATE/",$dtype))
{
if(strlen($data2)>0)
$data2=$objU->to_date($data2);
}
if($data1!=$data2)
return(true);
else
return(false);
}//DataChanged


public function genUpdateString(&$mError,&$i)
{
$i=0;
$colupd=0;
$this->updateList="";
$sql="update ".$this->Table." set ";
for($index=0;$index<count($this->fieldList);$index++)
{
$fIndex=$this->fieldList[$index];
$Dtype="VARCHAR";
$Set=0;
$single=0; //single quote disallow
$strong=0;
$pattern="";

if(isset($this->DataSet[$fIndex]))
$Set=$this->DataSet[$fIndex];

if(isset($this->DataType[$fIndex]))
$Dtype=$this->DataType[$fIndex];

if(isset($this->SingleQuote[$fIndex]))
$single=$this->SingleQuote[$fIndex]; 

if(isset($this->StrongValid[$fIndex]))
$strong= $this->StrongValid[$fIndex];

if(isset($this->Pattern[$fIndex]))
$pattern= $this->Pattern[$fIndex];

if($Set==1 && $this->DataChanged($fIndex) )
{
$colupd++;
if($this->ValidateField($this->Var[$fIndex],$fIndex, $Dtype, $strong,$pattern,$single))
{
$i++;
if ($i>1)
$sql.=",";
if($Dtype=="BIT")
$sql.=$fIndex."=".$this->Var[$fIndex];
else
{
if ($this->Var[$fIndex]=="NULL")
$sql.=$fIndex."=NULL";
else
{
if(preg_match("/INT/",$Dtype))
$sql.=$fIndex."=".$this->Var[$fIndex];
else
$sql.=$fIndex."="."'".$this->Var[$fIndex]."'";
} //not null
}//BIT
$this->updateList.=$fIndex."=".$this->Var[$fIndex].",";
} //validatuion success
else 
{
$mError++;
$this->ValidationErrorList.=$fIndex."=".$this->Var[$fIndex].",";
}
} //$set==1
} //End For Loop
$cond=" where ".$this->generateCondition();
$this->returnSql=$sql.$cond;
$this->colUpdated=$colupd;

return($sql.$cond);
}//End UpdateString


public function SaveRecord()
{
$erCount=0;
$mcol=0;
$res=false;
$sqlstring=$this->genSaveString($erCount,$mcol);
if($erCount==0 && $mcol>0)//Validation Success
{
if ($this->ExecuteQuery($sqlstring))
{
$this->colUpdated=$mcol;
$res=true;
}
}//$erCount==0
$this->colUpdated=$mcol;//Validation Fails
return($res);
}//End Save Record


public function genSaveString(&$erCount,&$mcol)
{
$this->updateList="";
$sql1="insert into ".$this->Table."(";
$sql=" values (";
for($index=0;$index<count($this->fieldList);$index++)
{
$fIndex=$this->fieldList[$index];
$Dtype="VARCHAR";
$Set=0;
$single=0; //single quote disallow
$strong=0;
$pattern="";

if(isset($this->DataSet[$fIndex]))
$Set=$this->DataSet[$fIndex];

if(isset($this->DataType[$fIndex]))
$Dtype=$this->DataType[$fIndex];

if(isset($this->SingleQuote[$fIndex]))
$single=$this->SingleQuote[$fIndex]; 

if(isset($this->StrongValid[$fIndex]))
$strong= $this->StrongValid[$fIndex];

if(isset($this->Pattern[$fIndex]))
$pattern= $this->Pattern[$fIndex];

if($Set==1)
{
if($this->ValidateField($this->Var[$fIndex],$fIndex, $Dtype, $strong, $pattern, $single))
{
$mcol++;
if ($mcol>1)
{
$sql1.=",";
$sql.=",";
} //mcol>1
$sql1.=$fIndex;
if($Dtype=="BIT")
$sql.=$this->Var[$fIndex];
else
{
if ($this->Var[$fIndex]=="NULL")
$sql.="NULL";
else
{
if(preg_match("/INT/",$Dtype))
$sql.=$this->Var[$fIndex];
else
$sql.="'".$this->Var[$fIndex]."'";
} //not null
}//BIT
$this->updateList.=$fIndex."=".$this->Var[$fIndex].",";
} //validation success
else
{
$erCount++;
$this->ValidationErrorList.=$fIndex."=".$this->Var[$fIndex].",";
}
} //$set==1
} //End For Loop

$sql1.=")";
$sql.=")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;

return($sqlstring);
}//End SaveString

private function ValidateField(&$Fld,$FldIndex,$Dtype,$Strong,$Patern,$AllowQuote)
{
if(preg_match("/INT/",$Dtype) || preg_match("/BIT/",$Dtype))
$int=true;
else
$int=false;

if($Fld=="NULL" && $int==false)
$Fld="";
if($Fld=="NULL" && $int==true)
$Fld="0";

$newfld=$Fld; 
if($AllowQuote) 
{
$newfld=str_replace("'","x",$Fld);
$temp=str_replace("'","''",$Fld); //Remove Single Character
$Fld=$temp;
}
$objUtility=new Utility();
$res=true;
$StrongValidation=false;
if($Strong)
$StrongValidation=true;
if(isset($this->IsNull[$FldIndex]))
$AllowNull=$this->IsNull[$FldIndex];
else
$AllowNull=true;
if(isset($this->IsUtf[$FldIndex]))
$Unicode=$this->IsUtf[$FldIndex];
else
$Unicode=false;
if(isset($this->MaxLength[$FldIndex]))
$maxLen=$this->MaxLength[$FldIndex];
else
$maxLen=0;
if(preg_match("/CHAR/",$Dtype))
{
if($objUtility->ValidateText($newfld,$Unicode,$StrongValidation,$maxLen,$AllowNull, $Err)==false)
$res=false;
}
if(preg_match("/INT/",$Dtype))
{
if($objUtility->ValidateNumber($Fld, $AllowNull, $Err)==false)
$res=false;
else
{
if($AllowNull==1 && strlen($Fld)==0)
$Fld="NULL";
}
}
if(preg_match("/DATE/",$Dtype))
{
$datetype=$objUtility->returnDateType($Fld, $AllowNull, $Err);
if($datetype==-1)//Invalid date type
$res=false;
else
{
if($datetype==0)
$Fld="NULL";
if($datetype==1)//DD/MM/YYYY
$Fld=$objUtility->to_mysqldate($Fld);
if($datetype==2)//YYYY-MM-DD
$Fld=$Fld;
}
}

if(strlen($Patern)>1 && strlen($Fld)>0)
{
if(preg_match($Patern,$Fld))
$res=true;
else
$res=false;
}

if(preg_match("/ISCII/",$Dtype))
$res=true;

return($res);
}//ValidateField
}//End Class
?>
