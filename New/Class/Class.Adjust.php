<?php
//require_once 'class.config.php';
require_once 'utility.class.php';
require_once 'class.DBManager.php';
require_once 'class.PrepareStmt.php';
class Adjust extends DBManager
{
private $verify=0; //  Use 1 for Testing the Form
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

private $fieldList=array("Yr","Mn","Bank","Opcase","Amt");
//"T1","T2","T3","T4","T5";
private $Schema='';
private $Table="adjust";

private $condString;
public $colUpdated;
public $updateList;
public $ValidationErrorList;

//public function _construct($i) //for PHP6
public function Adjust($Connect=true)
{
if($Connect)
parent::__construct();
$this->colUpdated=0;
$this->updateList="";
$this->ValidationErrorList="";

$this->Schema=isset($_SESSION['Schema'])?$_SESSION['Schema']:'';
if(strlen($this->Schema)>0)
$this->Table=$this->Schema.".".$this->Table;

$this->condString="1=1";
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
return($this->CountRecords($this->Table, $condition));
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
$this->SingleQuote[$FieldIndex]=0;//1- for Allow Single Quote
$this->StrongValid[$FieldIndex]=1;//1- for strong Valiadtion
}

public function getYr()
{
$getdata=isset($this->Var['Yr'])?$this->Var['Yr']:'';
return($getdata);
}

public function setYr($str)
{
$this->Var['Yr']=$str;
$this->DataSet['Yr']=1;
$this->DataType['Yr']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Yr']=0;
$this->IsUtf['Yr']=0;
$this->MaxLength['Yr']=4;
$this->SingleQuote['Yr']=0;//1- for Allow Single Quote
$this->StrongValid['Yr']=1;//1- for strong Valiadtion
$this->Pattern['Yr']="";//Use Regular Expression
}

public function getMn()
{
$getdata=isset($this->Var['Mn'])?$this->Var['Mn']:'';
return($getdata);
}

public function setMn($str)
{
$str=filter_var($str, FILTER_SANITIZE_NUMBER_INT);
$this->Var['Mn']=$str;
$this->DataSet['Mn']=1;
$this->DataType['Mn']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Mn']=0;
$this->IsUtf['Mn']=0;
$this->Pattern['Mn']="";//Use Regular Expression
}

public function getBank()
{
$getdata=isset($this->Var['Bank'])?$this->Var['Bank']:'';
return($getdata);
}

public function setBank($str)
{
$this->Var['Bank']=$str;
$this->DataSet['Bank']=1;
$this->DataType['Bank']="VARCHAR";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Bank']=0;
$this->IsUtf['Bank']=0;
$this->MaxLength['Bank']=50;
$this->SingleQuote['Bank']=0;//1- for Allow Single Quote
$this->StrongValid['Bank']=1;//1- for strong Valiadtion
$this->Pattern['Bank']="";//Use Regular Expression
}

public function getOpcase()
{
$getdata=isset($this->Var['Opcase'])?$this->Var['Opcase']:'';
return($getdata);
}

public function setOpcase($str)
{
$str=filter_var($str, FILTER_SANITIZE_NUMBER_INT);
$this->Var['Opcase']=$str;
$this->DataSet['Opcase']=1;
$this->DataType['Opcase']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Opcase']=1;
$this->IsUtf['Opcase']=0;
$this->Pattern['Opcase']="";//Use Regular Expression
}

public function getAmt()
{
$getdata=isset($this->Var['Amt'])?$this->Var['Amt']:'';
return($getdata);
}

public function setAmt($str)
{
$str=filter_var($str, FILTER_SANITIZE_NUMBER_INT);
$this->Var['Amt']=$str;
$this->DataSet['Amt']=1;
$this->DataType['Amt']="INT";//Set DataType as 'ISCII' if no validation is required
$this->IsNull['Amt']=1;
$this->IsUtf['Amt']=0;
$this->Pattern['Amt']="";//Use Regular Expression
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
if (isset($this->Var['Yr']))
{
$cond.=" and Yr='".$this->Var['Yr']."'";
$this->MyCondition.=" and Yr=?";
$this->MyParam[$cnt++]=$this->Var['Yr'];
}
else
$cond.=" and 1=2 ";
if (isset($this->Var['Mn']))
{
$cond.=" and Mn='".$this->Var['Mn']."'";
$this->MyCondition.=" and Mn=?";
$this->MyParam[$cnt++]=$this->Var['Mn'];
}
else
$cond.=" and 1=2 ";
if (isset($this->Var['Bank']))
{
$cond.=" and Bank='".$this->Var['Bank']."'";
$this->MyCondition.=" and Bank=?";
$this->MyParam[$cnt++]=$this->Var['Bank'];
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



public function EditThroughPrepareCondition() {
        $cond = $this->generateCondition();
        $sql = $this->genSqlQuery($this->Table, $this->fieldList, $this->MyCondition);
       $objPs = new PrepareStmt($this->BackEndCode);
      $row = $objPs->FetchRecords($sql, $this->MyParam);
      if (count($row) > 0) {
          for ($index = 0; $index < count($this->fieldList); $index++) {
              $fIndex = $this->fieldList[$index];
              $this->Var[$fIndex] = $row[0][$index];
             $this->DataSet[$fIndex] = 1;
          }//for loop
          return(true);
      } else
         return(false);
  }


public function EditRecord($type = 0)
{
$cond=$this->generateCondition();
if ($type == 0)
return($this->EditOnCondition($cond));
else
return($this->EditThroughPrepareCondition());
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




public function maxMn()
{
$cond="1=1";
$time=0;
$t2=date('H:i:s');
while($this->TableBusy($this->Table) && $time<7)
{
$t1=date('H:i:s');
$time=$this->elapsedTimeInSecond($t1, $t2);
}

return($this->Max($this->Table, "Mn", $cond)+1);
}//Max



private function getThroughPrepareCondition($cond,$param) {
        $mRows = array();
        $sql = $this->genSqlQuery($this->Table, $this->fieldList, $cond);
        $objPs = new PrepareStmt($this->BackEndCode);
        $row = $objPs->FetchRecords($sql, $param);
       for($i=0;$i<count($row);$i++)
        {
            for ($index = 0; $index < count($this->fieldList); $index++) {
                $fIndex = $this->fieldList[$index];
                $mRows[$i][$fIndex]=$row[$i][$index];
                   }//for loop
            } 
            return($mRows);
    }


public function getAllRecord($cond,$param=array(),$type=0)
{
$tRows=array();
if ($type==0)
$tRows=$this->FetchMultipleRecords($this->Table,$this->fieldList,$cond);
else
$tRows=$this->getThroughPrepareCondition($cond,$param);
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
if(strlen($this->Var[$fIndex])>0)
$this->ValidationErrorList.=$fIndex."=".$this->Var[$fIndex]." ";
else
$this->ValidationErrorList.=$fIndex."=(Null Value Found) ";
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
$newfld=str_replace("'","!",$Fld);
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
$newfld=str_replace("!","''",$newfld);
$Fld=$newfld;
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
$this->returnSql=$this->genSaveString($erCount, $mcol);
if($erCount==0)
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
$this->returnSql=$this->genUpdateString($erCount, $mcol);
if($erCount==0)
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
