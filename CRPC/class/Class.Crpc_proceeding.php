<?php
//require_once 'class.config.php';
require_once '../class/utility.class.php';
require_once '../class/class.DBManager.php';
class Crpc_proceeding extends DBManager
{
private $Var=array();
private $OldVar=array();
private $DataType=array();
private $IsNull=array();
private $IsUtf=array();
private $MaxLength=array();
private $DataSet=array();



private $fieldList=array("Case_yr","Case_no","Rsl","Proc_date","Order_detail","Action_taken","By_magistrate","Next_date");
//"T1","T2","T3","T4","T5";
private $Table="Crpc_proceeding";

private $condString;
public $colUpdated;
public $updateList;
public $ValidationErrorList;

//public function _construct($i) //for PHP6
public function Crpc_proceeding()
{
parent::__construct();
parent::connect();
$this->colUpdated=0;
$this->updateList="";
$this->ValidationErrorList="";
$this->condString="1=1";
}//End constructor


public function rowCount($condition)
{
return($this->CountRecords("crpc_proceeding", $condition));
} //rowCount



public function getCase_yr()
{
if(isset($this->Var['Case_yr']))
return($this->Var['Case_yr']);
else
return("");
}

public function setCase_yr($str)
{
$this->Var['Case_yr']=$str;
$this->DataSet['Case_yr']=1;
$this->DataType['Case_yr']="VARCHAR";
$this->IsNull['Case_yr']=0;
$this->IsUtf['Case_yr']=0;
$this->MaxLength['Case_yr']=4;
}

public function getCase_no()
{
if(isset($this->Var['Case_no']))
return($this->Var['Case_no']);
else
return("");
}

public function setCase_no($str)
{
$this->Var['Case_no']=$str;
$this->DataSet['Case_no']=1;
$this->DataType['Case_no']="INT";
$this->IsNull['Case_no']=0;
$this->IsUtf['Case_no']=0;
}

public function getRsl()
{
if(isset($this->Var['Rsl']))
return($this->Var['Rsl']);
else
return("");
}

public function setRsl($str)
{
$this->Var['Rsl']=$str;
$this->DataSet['Rsl']=1;
$this->DataType['Rsl']="INT";
$this->IsNull['Rsl']=0;
$this->IsUtf['Rsl']=0;
}

public function getProc_date()
{
if(isset($this->Var['Proc_date']))
return($this->Var['Proc_date']);
else
return("");
}

public function setProc_date($str)
{
$this->Var['Proc_date']=$str;
$this->DataSet['Proc_date']=1;
$this->DataType['Proc_date']="DATE";
$this->IsNull['Proc_date']=0;
$this->IsUtf['Proc_date']=0;
}

public function getOrder_detail()
{
if(isset($this->Var['Order_detail']))
return($this->Var['Order_detail']);
else
return("");
}

public function setOrder_detail($str)
{
$this->Var['Order_detail']=$str;
$this->DataSet['Order_detail']=1;
$this->DataType['Order_detail']="VARCHAR";
$this->IsNull['Order_detail']=0;
$this->IsUtf['Order_detail']=0;
$this->MaxLength['Order_detail']=1000;
}

public function getAction_taken()
{
if(isset($this->Var['Action_taken']))
return($this->Var['Action_taken']);
else
return("");
}

public function setAction_taken($str)
{
$this->Var['Action_taken']=$str;
$this->DataSet['Action_taken']=1;
$this->DataType['Action_taken']="VARCHAR";
$this->IsNull['Action_taken']=1;
$this->IsUtf['Action_taken']=0;
$this->MaxLength['Action_taken']=200;
}

public function getBy_magistrate()
{
if(isset($this->Var['By_magistrate']))
return($this->Var['By_magistrate']);
else
return("");
}

public function setBy_magistrate($str)
{
$this->Var['By_magistrate']=$str;
$this->DataSet['By_magistrate']=1;
$this->DataType['By_magistrate']="INT";
$this->IsNull['By_magistrate']=0;
$this->IsUtf['By_magistrate']=0;
}

public function getNext_date()
{
if(isset($this->Var['Next_date']))
return($this->Var['Next_date']);
else
return("");
}

public function setNext_date($str)
{
$this->Var['Next_date']=$str;
$this->DataSet['Next_date']=1;
$this->DataType['Next_date']="DATE";
$this->IsNull['Next_date']=1;
$this->IsUtf['Next_date']=0;
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
$cond="true  ";
if (isset($this->Var['Case_yr']))
$cond.=" and Case_yr='".$this->Var['Case_yr']."'";
else
$cond.=" and false";
if (isset($this->Var['Case_no']))
$cond.=" and Case_no='".$this->Var['Case_no']."'";
else
$cond.=" and false";
if (isset($this->Var['Rsl']))
$cond.=" and Rsl='".$this->Var['Rsl']."'";
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




public function maxCase_no()
{
$cond="1=1";
return($this->Max($this->Table, "Case_no", $cond)+1);
}//Max


public function maxRsl($yr,$no)
{
$cond="Case_yr=".$yr." and Case_no=".$no;
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
$mError=0;
$res=false;
$UpdateString=$this->genUpdateString($mError,$i);
if($mError==0 && $i>0)
{
if ($this->ExecuteQuery($UpdateString))
$res=true;
}
return(res);
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
$this->updateList="";
$sql="update crpc_proceeding set ";
for($index=0;$index<count($this->fieldList);$index++)
{
$fIndex=$this->fieldList[$index];
$Dtype="VARCHAR";
$Set=0;
if(isset($this->DataSet[$fIndex]))
$Set=$this->DataSet[$fIndex];
if(isset($this->DataType[$fIndex]))
$Dtype=$this->DataType[$fIndex];

if($Set==1 && $this->DataChanged($fIndex) )
{
if($this->ValidateField($this->Var[$fIndex],$fIndex, $Dtype, false, "", false))
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
$this->colUpdated=$i;

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
$sql1="insert into crpc_proceeding(";
$sql=" values (";
for($index=0;$index<count($this->fieldList);$index++)
{
$fIndex=$this->fieldList[$index];
$Dtype="VARCHAR";
$Set=0;
if(isset($this->DataSet[$fIndex]))
$Set=$this->DataSet[$fIndex];
if(isset($this->DataType[$fIndex]))
$Dtype=$this->DataType[$fIndex];
if($Set==1)
{
if($this->ValidateField($this->Var[$fIndex],$fIndex, $Dtype, false, "", false))
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
if($Fld=="NULL")
$Fld="";
if($AllowQuote) 
{
$temp=str_replace("'","''",$Fld); //Remove Single Character
$Fld=$temp;
}
//Regular Expression
//$patern="/[A-Z]{3}[0-9]{7}/"; // First 3 Charactr as A to Z and rest 7 char from 0 to 9
//$patern="/[a-Z]{3}[0-9]{7}/"; // First 3 Charactr as(a to Z) and rest 7 char from 0 to 9
//$patern="/^a/";//Starting with a
//$patern="/a$/";//Ending with a 
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
if($objUtility->ValidateText($Fld,$Unicode,$StrongValidation,$maxLen,$AllowNull, $Err)==false)
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
if($objUtility->ValidateDate($Fld, $AllowNull, $Err)==false)
$res=false;
else
{
if($objUtility->isdate($Fld))
$Fld=$objUtility->to_mysqldate($Fld);
else
$Fld="NULL";
}
}
if(strlen($Patern>1))
{
if(preg_match($patern,$Fld))
$res=true;
else
$res=false;
}
return($res);
}//ValidateField
}//End Class
?>
