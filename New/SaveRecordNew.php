<?php

date_default_timezone_set("Asia/kolkata");
session_start();
require_once 'class/class.table.php';

$objTable = new Table();

//if ($_SERVER['REQUEST_METHOD'] == 'POST' || 1 == 1) {


    //$uid = isset($_GET['uid']) ? $_GET['uid'] : 'root';
    //$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : 'aaaa';

    $table = isset($_GET['table']) ? $_GET['table'] : 'student';

    $columnname = isset($_GET['columnnames']) ? $_GET['columnnames'] : 'name,age,pscode ';

    $FieldIndex = explode(",", $columnname);

    $col = count($FieldIndex);


    $maxlength = isset($_GET['maxlength']) ? $_GET['maxlength'] : '30,0,0,0 ';

    $Max = explode(",", $maxlength);

    $data = isset($_GET['datavalues']) ? $_GET['datavalues'] : 'Jayanta Deka;45;6;'; //separated by Semicolon

    $Value = explode(";", $data);

    $datatype = isset($_GET['datatypes']) ? $_GET['datatypes'] : 'varchar,int,int,int ';

    $dr = explode(",", $datatype);

    for ($i = 0; $i < count($dr); $i++) {
        $DataType[$i] = strtoupper($dr[$i]);
        if ($DataType[$i] == "DATE") {
            $objU = new Utility(1);
            $dval = $Value[$i];
            if ($objU->ismysqldate($dval) == false) {
                $dval = $objU->to_mysqldate($dval);
                $Value[$i] = $dval;
            }
        }//==DATE
    }


    //SET PARAM
    $erCount = 0;
    $mcol = 0;
    for ($i = 0; $i < $col; $i++) {
        $max=isset($Max[$i])?$Max[$i]:'0';
        $datatype=isset($DataType[$i])?$DataType[$i]:'int';
        $objTable->CommonSet($i, $FieldIndex[$i], $Value[$i], $datatype, $max);
    }
    $savestr = $objTable->genSaveString($erCount, $mcol);

    $validerror = $objTable->ValidationErrorList;


    //Generate Prepare Statement
    $sql = "insert into " . $table . "(" . $columnname . ") values";
    $para = "(";
    for ($i = 0; $i < $col; $i++) {
        if ($i > 0)
            $para.=",";
        $para.="?";
    }
    $para.=")";

    $sql.=$para;

    //Hash Password

    $msg1 = "";
    $msg2 = "";

    //$dbpwd = $objTable->FetchColumn("pwd", "pwd", "uid=?", $Param = array($uid), "");
    //$hashpwd =hash("sha512",$pwd);
    $dbpwd = $hashpwd = "xxxx";


    $ok = "No";
    if ($hashpwd === $dbpwd) {    //password matched
        if ($erCount == 0 && $mcol > 0) {
            if ($objTable->ExecuteQuery($sql, $Value, $DataType, false)) {
                $msg1 = "Success fully Saved";
                //$msg2=$savestr;
                $ok = "Yes";
            } else {
                $error = $objTable->StatementError();
                $error = $objTable->Sanitize_AlphaNumericSpace($error);
                $msg1 = "Transaction failed. ";
                $msg2 = $error;
            }
        } else {
            $msg1 = "Validation Error ";
            $msg2 = $validerror;
        }
    } else {
        $msg1 = "Authentication Fails";
        $msg2 = " ";
    }


    $json= "{" . chr(34) . "Result" . chr(34) . ":{";
   $json.= chr(34) . "GenericMessage" . chr(34) . ":" . chr(34) . $msg1 . chr(34) . ","; // "}}";
     $json.= chr(34) . "ErrorMessage" . chr(34) . ":" . chr(34) . $msg2 . chr(34) . ","; // "}}";

    $json.= chr(34) . "Status" . chr(34) . ":" . chr(34) . $ok . chr(34) . "}}";
//}
    
    
    echo "jsonCallbackSave([".$json."]);";

