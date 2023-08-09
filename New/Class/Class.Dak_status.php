<?php
//require_once 'class.config.php';
require_once 'utility.class.php';
require_once 'class.DBManager.php';
//require_once 'class.PrepareStmt.php';
class Dak_status extends DBManager
{
private $verify=1; //  Use 1 for Testing the Form 0,2 and 3 for verificatiob 
 private $MinVal = array();
 private $MaxVal = array();
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

private $fieldList=array("Recvd_yr","Dak_id","Rsl","Note_date","Note");
//"T1","T2","T3","T4","T5";
private $Table="dak_status";

private $condString;
public $colUpdated;
public $updateList;
public $ValidationErrorList;

//public function _construct($i) //for PHP6
public function Dak_status($Connect=true)
{
if($Connect)
parent::__construct();
$this->colUpdated=0;
$this->updateList="";
$this->ValidationErrorList="";
$this->condString="1=1";
//$this->GlobalDataType['Note_date']="Date";
//Change Fld Index as NVARCHAR if SQL Server and Unicode is to be Handled
//$this->GlobalDataType['fldindex']="NVARCHAR";

//Example of Regular Expression
//$patern="/[A-Z]{3}[0-9]{7}/"; // First 3 Charactr as A to Z and rest 7 char from 0 to 9
//$patern="/[a-Z]{3}[0-9]{7}/"; // First 3 Charactr as(a to Z) and rest 7 char from 0 to 9
//$patern="/^a[a-zA-Z]{0,3}/";//Starting with a followed by 0 or 3 alphabet
//$patern="/a$/";//Ending with a 
//$patern="/^[1-9]{1}[0-9]{0,4}+[(]{1}+[1-9]{1}[0-9]{0,4}+[a-zA-Z]{0,4}+[)]$/";  //Eg. 32(5), 32(7Kha)

}//End constructor


public function rowCount($condition)
{
return($this->CountRecords("dak_status", $condition));
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

public function getRecvd_yr()
{
$getdata=isset($this->Var['Recvd_yr'])?$this->Var['Recvd_yr']:'';
return($getdata);
}

public function setRecvd_yr($str)
{
$this->Var['Recvd_yr']=$str;
$this->DataSet['Recvd_yr']=1;
$this->DataType['Recvd_yr']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Recvd_yr']=0;
$this->IsUtf['Recvd_yr']=0;
$this->Pattern['Recvd_yr']="";//Use Regular Expression
}

public function getDak_id()
{
$getdata=isset($this->Var['Dak_id'])?$this->Var['Dak_id']:'';
return($getdata);
}

public function setDak_id($str)
{
$this->Var['Dak_id']=$str;
$this->DataSet['Dak_id']=1;
$this->DataType['Dak_id']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Dak_id']=0;
$this->IsUtf['Dak_id']=0;
$this->Pattern['Dak_id']="";//Use Regular Expression
}

public function getRsl()
{
$getdata=isset($this->Var['Rsl'])?$this->Var['Rsl']:'';
return($getdata);
}

public function setRsl($str)
{
$this->Var['Rsl']=$str;
$this->DataSet['Rsl']=1;
$this->DataType['Rsl']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Rsl']=0;
$this->IsUtf['Rsl']=0;
$this->Pattern['Rsl']="";//Use Regular Expression
}

public function getNote_date()
{
$getdata=isset($this->Var['Note_date'])?$this->Var['Note_date']:'';
return($getdata);
}

public function setNote_date($str)
{
$objU=new Utility($this->verify);
if($objU->isdate($str))
$str=$objU->to_mysqldate($str);
$this->Var['Note_date']=$str;
$this->DataSet['Note_date']=1;
$this->DataType['Note_date']="DATE";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Note_date']=1;
$this->IsUtf['Note_date']=0;
$this->Pattern['Note_date']="";//Use Regular Expression
}

public function getNote()
{
$getdata=isset($this->Var['Note'])?$this->Var['Note']:'';
return($getdata);
}

public function setNote($str)
{
$this->Var['Note']=$str;
$this->DataSet['Note']=1;
$this->DataType['Note']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Note']=1;
$this->IsUtf['Note']=0;
$this->MaxLength['Note']=200;
$this->SingleQuote['Note']=0;//1- for Allow Single Quote
$this->StrongValid['Note']=0;//1- for strong Valiadtion
$this->Pattern['Note']="";//Use Regular Expression
}




//Extra Reserve Field

public function setCondString($str)
{
$this->condString=$str;
}



private function generateCondition()
{
$cnt=0;
$cond=" 1=1  ";
$this->MyCondition=" 1=1  ";
if (isset($this->Var['Recvd_yr']))
{
$cond.=" and Recvd_yr='".$this->Var['Recvd_yr']."'";
$this->MyCondition.=" and Recvd_yr=?";
$this->MyParam[$cnt++]=$this->Var['Recvd_yr'];
}
else
$cond.=" and 1=2 ";
if (isset($this->Var['Dak_id']))
{
$cond.=" and Dak_id='".$this->Var['Dak_id']."'";
$this->MyCondition.=" and Dak_id=?";
$this->MyParam[$cnt++]=$this->Var['Dak_id'];
}
else
$cond.=" and 1=2 ";
if (isset($this->Var['Rsl']))
{
$cond.=" and Rsl='".$this->Var['Rsl']."'";
$this->MyCondition.=" and Rsl=?";
$this->MyParam[$cnt++]=$this->Var['Rsl'];
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




public function maxRecvd_yr()
{
$cond="1=1";
$time=0;
$t2=date('H:i:s');
while($this->TableBusy($this->Table) && $time<7)
{
$t1=date('H:i:s');
$time=$this->elapsedTimeInSecond($t1, $t2);
}

return($this->Max($this->Table, "Recvd_yr", $cond)+1);
}//Max


public function maxDak_id()
{
$cond="1=1";
$time=0;
$t2=date('H:i:s');
while($this->TableBusy($this->Table) && $time<7)
{
$t1=date('H:i:s');
$time=$this->elapsedTimeInSecond($t1, $t2);
}

return($this->Max($this->Table, "Dak_id", $cond)+1);
}//Max


public function maxRsl($yr,$dak_id)
{
$cond="recvd_yr=".$yr." and dak_id=".$dak_id;
$time=0;
$t2=date('H:i:s');
while($this->TableBusy($this->Table) && $time<7)
{
$t1=date('H:i:s');
$time=$this->elapsedTimeInSecond($t1, $t2);
}
return($this->Max($this->Table, "Rsl", $cond)+1);
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
$res=$this->newUpdate();
return($res);
}//End UpdateRecord


private function DataChanged($ind)
{
$data1="";
$data2="";
$objU=new Utility($this->verify);
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
$code=$this->BackEndCode; 
$this->returnSql=$this->genSaveString($erCount, $mcol);
if($erCount == 0 && $mcol > 0)    
$res = $this->Execute ($this->returnSql);
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
$objUtility=new Utility($this->verify);
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
$min = isset($this->MinVal[$FldIndex]) ? $this->MinVal[$FldIndex] : 0;
$max = isset($this->MaxVal[$FldIndex]) ? $this->MaxVal[$FldIndex] : 987650;
if ($objUtility->ValidateNumber($Fld, $AllowNull, $Err, $min, $max) == false)
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
$this->returnSql=$this->genSaveString($erCount, $mcol);
if($erCount == 0 && $mcol > 0)
$res=$this->CommonSave($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyDataType);
return($res);
}//newSave



public function newUpdate()
{
$this->copyVariable();  
$erCount=0;
$mcol=0;
$res=false;
$code=$this->BackEndCode; 
$this->returnSql=$this->genUpdateString($erCount, $mcol);
$this->colUpdated = $mcol;
if ($erCount == 0 && $mcol > 0)
$res=$this->CommonUpdate($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyCondition, $this->MyParam, $this->MyDataType);
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

        $res = $this->CommonSave($this->Table, $this->MyFieldList, $this->MyValueList, $this->MyDataType);
        return($res);
    }

//Just Save
}//End Class
?>
