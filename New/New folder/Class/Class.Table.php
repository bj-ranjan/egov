<?php

//require_once 'class.config.php';
require_once 'utility.class.php';
require_once 'class.PrepareStmt.php';


class Table extends PrepareStmt {

    private $verify = 0; //  Use 1 for Testing the Form
    private $Var = array();
    private $OldVar = array();
    private $DataType = array();
    private $IsNull = array();
    private $IsUtf = array();
    private $MaxLength = array();
    private $DataSet = array();
    private $StrongValid = array(); //strong validation
    private $SingleQuote = array(); // allow single quote
    private $Pattern = array(); // Regular Expression
//Required for Prepare Statement
    private $MyFieldList = array();
    private $MyValueList = array();
    private $MyCondition = "";
    private $MyParam = array();
    private $MyDataType = array();
//Required for Prepare Statement
//In order to add more field, append the field name in the array $fieldList
//and Create get and set method for the field.

    private $fieldList = array();
    
//"T1","T2","T3","T4","T5";
    private $Schema = '';
    private $Table ;
    private $condString;
    public $colUpdated;
    public $updateList;
    public $ValidationErrorList;

public function _construct($i){ //for PHP6
    //public function Pwd($Connect = true) {
          parent::__construct();
        $this->colUpdated = 0;
        $this->updateList = "";
        $this->ValidationErrorList = "";
        
        //Example of Regular Expression
//$patern="/[A-Z]{3}[0-9]{7}/"; // First 3 Charactr as A to Z and rest 7 char from 0 to 9
//$patern="/[a-Z]{3}[0-9]{7}/"; // First 3 Charactr as(a to Z) and rest 7 char from 0 to 9
//$patern="/^a[a-zA-Z]{0,3}/";//Starting with a followed by 0 or 3 alphabet
//$patern="/a$/";//Ending with a 
//$patern="/^[1-9]{1}[0-9]{0,4}+[(]{1}+[1-9]{1}[0-9]{0,4}+[a-zA-Z]{0,4}+[)]$/";  //Eg. 32(5), 32(7Kha)
    }

    
//End constructor

    public function WriteF($fname, $data) {
            $data.="\n";
            $ts = fopen($fname, 'w') or die("can't open file");
            fwrite($ts, $data);
        } 
        
        
    public function AppendF($fname, $data) {
           
            $data.="\n";
            $ts = fopen($fname, 'a') or die("can't open file");
            fwrite($ts, $data);
       
    }

    
    
    public function CheckPassword($pwd,$dbpwd,$salt="nxx")
    {
         $hashpwd =hash("sha512",$pwd);
     if($hashpwd==$dbpwd)
         return(true);
     else
         return(false);
    }
    
    
    public function rowCount($condition) {
        return($this->CountRecords($this->Table, $condition));
        
            }

//rowCount

    public function CommonGet($FieldIndex) {
        if (isset($this->Var[$FieldIndex]))
            return($this->Var[$FieldIndex]);
    }

    public function CommonSet($index,$FieldIndex, $Value, $DataType, $Max) {
        $this->fieldList[$index]=$FieldIndex;
    
        
        $this->Var[$FieldIndex] = $Value;
        $this->DataSet[$FieldIndex] = 1;
        $this->DataType[$FieldIndex] = $DataType;
        $this->MaxLength[$FieldIndex] = $Max;
        $this->SingleQuote[$FieldIndex] = 0; //1- for Allow Single Quote
        $this->StrongValid[$FieldIndex] = 1; //1- for strong Valiadtion
         }

   

    public function genSaveString(&$erCount, &$mcol) {
        $cnt = 0;
        $this->updateList = "";
        $sql1 = "insert into " . $this->Table . "(";
        $sql = " values (";
        for ($index = 0; $index < count($this->fieldList); $index++) {
            $fIndex = $this->fieldList[$index];
            $Dtype = "VARCHAR";
            $Set = 0;
            $single = 0; //single quote disallow
            $strong = 0;
            $pattern = "";

            if (isset($this->DataSet[$fIndex]))
                $Set = $this->DataSet[$fIndex];

            if (isset($this->DataType[$fIndex]))
                $Dtype = $this->DataType[$fIndex];

            if (isset($this->SingleQuote[$fIndex]))
                $single = $this->SingleQuote[$fIndex];

            if (isset($this->StrongValid[$fIndex]))
                $strong = $this->StrongValid[$fIndex];

            if (isset($this->Pattern[$fIndex]))
                $pattern = $this->Pattern[$fIndex];

            if ($Set == 1) {
                if ($this->ValidateField($this->Var[$fIndex], $fIndex, $Dtype, $strong, $pattern, $single)) {
                    $this->MyFieldList[$cnt] = $fIndex;
                    $this->MyValueList[$cnt] = $this->Var[$fIndex];
                    $this->MyDataType[$cnt++] = $Dtype;
                    $mcol++;
                    if ($mcol > 1) {
                        $sql1.=",";
                        $sql.=",";
                    } //mcol>1
                    $sql1.=$fIndex;
                    if ($Dtype == "BIT")
                        $sql.=$this->Var[$fIndex];
                    else {
                        if ($this->Var[$fIndex] == "NULL")
                            $sql.="NULL";
                        else {
                            if (preg_match("/INT/", $Dtype))
                                $sql.=$this->Var[$fIndex];
                            else
                                $sql.="'" . $this->Var[$fIndex] . "'";
                        } //not null
                    }//BIT
                    $this->updateList.=$fIndex . "=" . $this->Var[$fIndex] . ",";
                } //validation success
                else {
                    $erCount++;
                    if (strlen($this->Var[$fIndex]) > 0)
                        $this->ValidationErrorList.=$fIndex . "=" . $this->Var[$fIndex] . " ";
                    else
                        $this->ValidationErrorList.=$fIndex . "=(Null Value Found) ";
                }
            } //$set==1
        } //End For Loop

        $sql1.=")";
        $sql.=")";
        $sqlstring = $sql1 . $sql;
        $this->returnSql = $sqlstring;

        return($sqlstring);
    }

//End SaveString

    private function ValidateField(&$Fld, $FldIndex, $Dtype, $Strong, $Patern, $AllowQuote) {
        
            $AllowNull = false;
            
        if (preg_match("/INT/", $Dtype) || preg_match("/BIT/", $Dtype))
            $int = true;
        else
            $int = false;

        if ($Fld == "NULL" && $int == false)
            $Fld = "";
        if (($Fld == "NULL" || strlen($Fld) == 0 ) && $int == true && $AllowNull == false)
            $Fld = "0";

        $newfld = $Fld;
        if ($AllowQuote) {
            $newfld = str_replace("'", "!", $Fld);
        }
        $objUtility = new Utility(1);
        $res = true;
        $StrongValidation = false;
        if ($Strong)
            $StrongValidation = true;
        if (isset($this->IsUtf[$FldIndex]))
            $Unicode = $this->IsUtf[$FldIndex];
        else
            $Unicode = false;
        if (isset($this->MaxLength[$FldIndex]))
            $maxLen = $this->MaxLength[$FldIndex];
        else
            $maxLen = 0;
        if (preg_match("/CHAR/", $Dtype)) {
            if ($objUtility->ValidateText($newfld, $Unicode, $StrongValidation, $maxLen, $AllowNull, $Err) == false)
                $res = false;
            $newfld = str_replace("!", "''", $newfld);
            $Fld = $newfld;
        }
        if (preg_match("/INT/", $Dtype)) {
            if ($objUtility->ValidateNumber($Fld, $AllowNull, $Err) == false)
                $res = false;
            else {
                if ($AllowNull == 1 && strlen($Fld) == 0)
                    $Fld = "NULL";
            }
        }
        if (preg_match("/DATE/", $Dtype)) {
            $datetype = $objUtility->returnDateType($Fld, $AllowNull, $Err);
            if ($datetype == -1)//Invalid date type
                $res = false;
            else {
                if ($datetype == 0)
                    $Fld = "NULL";
                if ($datetype == 1)//DD/MM/YYYY
                    $Fld = $objUtility->to_mysqldate($Fld);
                if ($datetype == 2)//YYYY-MM-DD
                    $Fld = $Fld;
            }
        }

        if (strlen($Patern) > 1 && strlen($Fld) > 0) {
            if (preg_match($Patern, $Fld))
                $res = true;
            else
                $res = false;
        }

        if (preg_match("/ISCII/", $Dtype))
            $res = true;

        return($res);
    }

//ValidateField
//New Method required for Prepared statements
//Just Save
}

//End Class
?>
