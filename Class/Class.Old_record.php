<?php
//require_once 'class.config.php';
require_once 'utility.class.php';
require_once 'class.DBManager.php';
//require_once 'class.PrepareStmt.php';
class Old_record extends DBManager
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


//Required for Prepare Statement
private $MyFieldList=array();
private $MyValueList=array();
private $MyCondition="";
private $MyParam=array();
private $MyDataType=array();
//Required for Prepare Statement




//In order to add more field, append the field name in the array $fieldList
//and Create get and set method for the field.

private $fieldList=array("Id","Cert_type","Cert_no","Issue_date","Name_of_certholder","Fathers_name","Village");
//"T1","T2","T3","T4","T5";
private $Table="old_record";

private $condString;
public $colUpdated;
public $updateList;
public $ValidationErrorList;

//public function _construct($i) //for PHP6
public function Old_record()
{
//parent::__construct();
$this->connect();
$this->colUpdated=0;
$this->updateList="";
$this->ValidationErrorList="";
$this->condString="1=1";
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
return($this->CountRecords("old_record", $condition));
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

public function getCert_type()
{
if(isset($this->Var['Cert_type']))
return($this->Var['Cert_type']);
else
return("");
}

public function setCert_type($str)
{

$this->Var['Cert_type']=$str;
$this->DataSet['Cert_type']=1;
$this->DataType['Cert_type']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Cert_type']=0;
$this->IsUtf['Cert_type']=0;
$this->MaxLength['Cert_type']=30;
$this->SingleQuote['Cert_type']=0;//1- for Allow Single Quote
$this->StrongValid['Cert_type']=0;//1- for strong Valiadtion

$this->Pattern['Cert_type']="";//Use Regular Expression


}

public function getCert_no()
{
if(isset($this->Var['Cert_no']))
return($this->Var['Cert_no']);
else
return("");
}

public function setCert_no($str)
{

$this->Var['Cert_no']=$str;
$this->DataSet['Cert_no']=1;
$this->DataType['Cert_no']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Cert_no']=0;
$this->IsUtf['Cert_no']=0;
$this->MaxLength['Cert_no']=80;
$this->SingleQuote['Cert_no']=0;//1- for Allow Single Quote
$this->StrongValid['Cert_no']=0;//1- for strong Valiadtion

$this->Pattern['Cert_no']="";//Use Regular Expression


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
$this->IsNull['Issue_date']=0;
$this->IsUtf['Issue_date']=0;

$this->Pattern['Issue_date']="";//Use Regular Expression


}

public function getName_of_certholder()
{
if(isset($this->Var['Name_of_certholder']))
return($this->Var['Name_of_certholder']);
else
return("");
}

public function setName_of_certholder($str)
{

$this->Var['Name_of_certholder']=$str;
$this->DataSet['Name_of_certholder']=1;
$this->DataType['Name_of_certholder']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Name_of_certholder']=0;
$this->IsUtf['Name_of_certholder']=0;
$this->MaxLength['Name_of_certholder']=40;
$this->SingleQuote['Name_of_certholder']=0;//1- for Allow Single Quote
$this->StrongValid['Name_of_certholder']=0;//1- for strong Valiadtion

$this->Pattern['Name_of_certholder']="";//Use Regular Expression


}

public function getFathers_name()
{
if(isset($this->Var['Fathers_name']))
return($this->Var['Fathers_name']);
else
return("");
}

public function setFathers_name($str)
{

$this->Var['Fathers_name']=$str;
$this->DataSet['Fathers_name']=1;
$this->DataType['Fathers_name']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Fathers_name']=1;
$this->IsUtf['Fathers_name']=0;
$this->MaxLength['Fathers_name']=40;
$this->SingleQuote['Fathers_name']=0;//1- for Allow Single Quote
$this->StrongValid['Fathers_name']=0;//1- for strong Valiadtion

$this->Pattern['Fathers_name']="";//Use Regular Expression


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
$this->IsNull['Village']=0;
$this->IsUtf['Village']=0;
$this->MaxLength['Village']=80;
$this->SingleQuote['Village']=0;//1- for Allow Single Quote
$this->StrongValid['Village']=0;//1- for strong Valiadtion

$this->Pattern['Village']="";//Use Regular Expression


}




//Extra Reserve Field
public function getT1()
{
if(isset($this->Var['T1']))
return($this->Var['T1']);
else
return("");
}


public function setT1($str)
{
$this->Var['T1']=$str;
$this->DataSet['T1']=1;
$this->DataType['T1']="VARCHAR";
$this->IsNull['T1']=1;
$this->IsUtf['T1']=0;
$this->MaxLength['T1']=100;
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
$cnt=0;
$cond=" 1=1  ";
$this->MyCondition=" 1=1  ";
if (isset($this->Var['Id']))
{
$cond.=" and Id='".$this->Var['Id']."'";
$this->MyCondition.=" and Id=?";
$this->MyParam[$cnt++]=$this->Var['Id'];
}
else
$cond.=" and 1=2 ";
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
$cnt=0;
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
$this->MyFieldList[$cnt]= $fIndex;
$this->MyValueList[$cnt]=$this->Var[$fIndex];
$this->MyDataType[$cnt++]=$Dtype;
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
$cnt=0;
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
$this->MyFieldList[$cnt]= $fIndex;
$this->MyValueList[$cnt]=$this->Var[$fIndex];
$this->MyDataType[$cnt++]=$Dtype;
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
if(isset($this->IsNull[$FldIndex]))
$AllowNull=$this->IsNull[$FldIndex];
else
$AllowNull=true;
if(preg_match("/INT/",$Dtype) || preg_match("/BIT/",$Dtype))
$int=true;
else
$int=false;

if($Fld=="NULL" && $int==false)
$Fld="";
if(($Fld=="NULL" || strlen($Fld)==0 ) && $int==true && $AllowNull==false)
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

//New Method required for Prepared statements


public function newSave()
{
$erCount=0;
$mcol=0;
$res=false;
$code=$this->BackEndCode; 
$objPs=new PrepareStmt($code); 
$sql=$this->genSaveString($erCount, $mcol);
$res=$objPs->CommonSave($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyDataType);
return($res);
}//newSave



public function newUpdate()
{
$this->copyVariable();  
$erCount=0;
$mcol=0;
$res=false;
$code=$this->BackEndCode; 
$objPs=new PrepareStmt($code); 
$sql=$this->genUpdateString($erCount, $mcol)." where ".$this->generateCondition();
$res=$objPs->CommonUpdate($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyCondition, $this->MyParam, $this->MyDataType);
return($res);
}//newUpdate




public function JustSave() { //Without Validation
        $cnt = 0;
        $res = false;
        $code = $this->BackEndCode;

        for ($index = 0; $index < count($this->fieldList); $index++) {
            $fIndex = $this->fieldList[$index];
            $Dtype = "VARCHAR";
            $Set = 0;
            if (isset($this->DataSet[$fIndex]))
                $Set = $this->DataSet[$fIndex];
           if (isset($this->DataType[$fIndex]))
                $Dtype = $this->DataType[$fIndex];
            if ($Set == 1) {
                $this->MyFieldList[$cnt] = $fIndex;
                $this->MyValueList[$cnt] = $this->Var[$fIndex];
                $this->MyDataType[$cnt] = $Dtype;
                $cnt++;
            }
        } //End For Loop

        $objPs = new PrepareStmt($code);
        $res = $objPs->CommonSave($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyDataType);
        return($res);
    }

//Just Save
}//End Class
?>
