<?php

require_once 'class.config.php';
require_once 'Class.CommonParameter.php';

class PrepareStmt extends CommonParameter {

    private $error;
//public function _construct($i) //for PHP6
    private $ConnectionObject;
    private $Datatype=1;
    private $start = 0;
    private $tot = 0;

    public function __construct($dbtype = 0) {

        $this->Datatype = $dbtype;

        
      //  echo "preparae ".$this->Datatype;
        $this->BooleanTrue = "'t'";
        $this->BooleanFalse = "'f'";

        if ($this->TimeOut($time) == false)
            $_SESSION['LatestTime'] = $this->Sanitize_Special(date('H:i:s'));

        $this->CreateBatchFile();

        $this->schema = "public";
        if (isset($_SESSION['Schema']) && strlen($_SESSION['Schema']) > 2)
            $this->schema = strtolower($_SESSION['Schema']);

        $db = trim(Config::getDB());
        $this->connect($db);
    }

    private function connect($dbname) {
        $_SESSION['MyDatabase'] = $this->Sanitize_Special($dbname);
        $dbhost = trim(Config::getDBHost());
        $dbuser = trim(Config::getUser());
        $dbpwd = trim(Config::getPWD());

        $db = trim($dbname);

        if ($this->Datatype == 0) {//My SQL
            $this->ConnectionObject = new mysqli($dbhost, $dbuser, $dbpwd, $db);
            $this->ExecuteMySqlQuery("set names utf8", $ValueList = array(), $DataType = array());
        }
        if ($this->Datatype == 1) {//postGre
            $connStr = "host=" . $dbhost . " dbname=" . $db . " user=" . $dbuser;
            if (strlen(trim($dbpwd)) > 0)
                $connStr .= " password=" . $dbpwd;
            $this->ConnectionObject = @pg_connect($connStr);
        }

            //echo "connect ".$this->Datatype;
        
        if ($this->Datatype == 2) {//SQL Server
            $connectionInfo = array();
            $connectionInfo['Database'] = $db;
            $connectionInfo['UID'] = $dbuser;
            $connectionInfo['PWD'] = $dbpwd;
            $this->ConnectionObject = sqlsrv_connect($dbhost, $connectionInfo);
        }
    }

    public function ConnectDB($db) { //Unused Function
        $this->connect($db);
        return(true);
    }

    public function getConnectionObject() {
        return($this->ConnectionObject);
    }

    public function BeginTransaction() {
        if ($this->Datatype == 0)
            @mysqli_autocommit($this->ConnectionObject, FALSE);
        if ($this->Datatype == 1)
            @pg_query("BEGIN") or die("Could not start transaction\n");
    }

    public function AutoCommit($val) {
        if ($this->Datatype == 0) {
            if ($val == 0)
                @mysqli_autocommit($this->ConnectionObject, FALSE);
            else
                @mysqli_autocommit($this->ConnectionObject, TRUE);
        }

        if ($this->Datatype == 1) {
            if ($val == 0)
                @pg_query("BEGIN") or die("Could not start transaction\n");
        }
    }

    public function CommitTransaction() {
        if ($this->Datatype == 0)
            mysqli_commit($this->ConnectionObject);

        if ($this->Datatype == 1)
            @pg_query("COMMIT") or die("Transaction commit failed\n");
    }

    public function RollbackTransaction() {
        if ($this->Datatype == 0)
            mysqli_rollback($this->ConnectionObject);

        if ($this->Datatype == 1)
            @pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
    }

    public function CloseConnection() {
        pg_close($this->ConnectionObject);
    }

//Constructor
//DATABASE INDEPENDENT METHODS
    public function ExecuteQuery($Query, $Param = array(), $DataType = array(), $errorlisten = false) {
        if ($this->Datatype == "0")//mysql
            return($this->ExecuteMySqlQuery($Query, $Param, $DataType, $errorlisten));
        if ($this->Datatype == "1")//pgsql
            return($this->ExecutePGQuery($Query, $Param, $errorlisten));
        if ($this->Datatype == "2")
            return ($this->ExecuteSQLQuery($Query, $Param, $errorlisten));
    }

        
    public function CountRecords($table,$cond="1=1",$Param=array())
    {
        $table = $this->SchemaDotTable($table);
        $a=$this->FetchColumn($table, "count(*)", $cond, $Param,0);
        if(strlen($a)>0)
            return($a);
        else
            return(0);
    }
    
    
    public function FetchColumn($table, $fld, $cond, $Param = array(), $default = "") {
        $val = "";
        
        $table = $this->SchemaDotTable($table);
        
        $stmt = "stmt" . rand(1, 4000);
        $sql = "Select " . $fld . " from " . $table;
        if (strlen($cond) > 2)
            $sql.=" where " . $cond;
        if ($this->Datatype == 0)//mysql
            $row = $this->ReadRecords($sql, $Param, $head);
        if ($this->Datatype == 1) //pg
            $row = $this->ReadPgRecords($sql, $Param, $stmt);
        if ($this->Datatype == 2) //pg
            $row = $this->ReadSQLRecords($sql, $Param);
        if (count($row) > 0)
            $val = $row[0][0];
        else
            $val = $default;
        return($val);
    }

    public function MaxField($table, $fld, $cond, $Param = array(), $defaultstart = 1) {
        
        $table=$this->SchemaDotTable($table);
        $sql = "select  max(" . $fld . ") from " . $table;
        if (strlen($cond) > 1)
            $sql = $sql . " where " . $cond;

        $row = $this->FetchRecords($sql, $Param);
        if (count($row) > 0) {
            if (strlen($row[0][0]) > 0)
                return($row[0][0] );
            else
                return($defaultstart);
        } else
            return($defaultstart);
    }

    public function FetchRecordinRange($sql, $Value, $start, $tot) {
        $this->start = $start;
        $this->tot = $tot;
//echo $start." ".$tot;
        $Heading = array();
        $stmt = "stmt" . rand(5000, 6000);
        if ($this->Datatype == 0)//mysql
            return($this->ReadRecords($sql, $Value, $Heading));
        if ($this->Datatype == 1)//pgsql 
            return($this->ReadPgRecords($sql, $Value, $stmt));
        if ($this->Datatype == 2)//sqlserver
            return($this->ReadSQLRecords($sql, $Value));
    }

    
    public function FetchRecords($sql, $Param=array()) {
        $Heading = array();
        $stmt = "stmt" . rand(1001, 89765).strlen($sql);
        if ($this->Datatype == 0)//mysql
            return($this->ReadRecords($sql, $Param, $Heading));
        if ($this->Datatype == 1)//pgsql 
        {
            //echo "Statement passed".$stmt;
            return($this->ReadPgRecords($sql, $Param, $stmt));
        }
      
        if ($this->Datatype == 2)//sqlserver
            return($this->ReadSQLRecords($sql, $Param));
    }

    public function CommonSave($Table, $FldList, $ValueList, $DataType) {
        $Stmt = "statement" . rand(100, 1000).count($ValueList);
        if ($this->Datatype == 0)//mysql  
            $res = $this->SaveMySqlData($Table, $FldList, $ValueList, $DataType);
        if ($this->Datatype == 1)//pgsql  
            $res = $this->SavePgData($Table, $FldList, $ValueList, $Stmt);
        if ($this->Datatype == 2)//sql server    
            $res = $this->SaveSQLData($Table, $FldList, $ValueList);
        return($res);
    }

//CommonSave

    public function CommonUpdate($Table, $FldList, $ValueList, $Condition, $Param, $DataType) {
        $Stmt = "statement" . rand(100, 1000);
        if ($this->Datatype == 0)//mysql  
            $res = $this->UpdateMySqlData($Table, $FldList, $ValueList, $Condition, $Param, $DataType);
        if ($this->Datatype == 1)//pgsql 
            $res = $this->UpadtePgData($Table, $FldList, $ValueList, $Condition, $Param, $Stmt);
        if ($this->Datatype == 2)//pgsql 
            $res = $this->UpadteSQLData($Table, $FldList, $ValueList, $Condition, $Param);
        return($res);
    }

//CommonUpdate
//END DATABASE INDEPENDANT METHOD
public function FetchSingleColumnRecords($sql,$param=array()) {

        $row = $this->FetchRecords($sql,$param);
        $mrow = array();
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = $row[$i][0];
        }

        return($mrow);
    }
    
    
    public function ReadRecords($sql, $ValueParam, &$Heading) {
//e.g  $sql="select slno,name from mytable where slno<? and name like %?%
//$ValueParam=array(3,'Kanak');
        $objSen = new Sentence();
        $result = array();
        $Heading = array();
        $query = $sql;
        $tot = $this->CountParam($sql);
//echo $sql;
//echo $tot." ".count($ValueParam)."<BR>";
        $Param = $this->AdjustParam($ValueParam, $tot);
//echo count($Param);
        $con = $this->ConnectionObject;
        $stmt = $con->prepare($query);
        if ($stmt) {
            $DataType = array();
            $bind_names[] = $this->GenFirstParam($Param, $DataType);
            for ($i = 0; $i < count($Param); $i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $Param[$i];
                $bind_names[] = &$$bind_name;
            }
            if (count($bind_names) > 1)
                call_user_func_array(array($stmt, 'bind_param'), $bind_names);

            $stmt->execute();
            $meta = $stmt->result_metadata();
            $fields = array();
            $i = 0;
            while ($field = $meta->fetch_field()) {
                $var = $field->name;
                $$var = null;
                $fields[$var] = &$$var;  //Initialise $fields['name']=null;
                $Heading[$i++] = $var;
            }
            call_user_func_array(array($stmt, 'bind_result'), $fields);

            $i = 0;
            $rowcounter = 0;
            while ($stmt->fetch()) {
                $j = 0;
//echo "within class ".$i."<br>";
                if ($this->WithinRange($i) == true) {
                    foreach ($fields as $Field => $Value) { //$k-Field Name as array index and  $v - value assigned to 
                        //New Line Added on 17/05/2018
                        $var = $Value;
                        if (substr($var, 0, 2) === "C#")
                            $var = $objSen->SimpleDecrypt($var, "C");
                        if ($this->IsEncryptedNum($var))
                            $var = $objSen->SimpleDecrypt($var, "N");

                        //end new line
                        $result[$rowcounter][$j] = $var; // $Value;
                        $j++;
                    } //foreach
                    $rowcounter++;
                } //$this->WithinRange($i)
                $i++;
            }//while

            $stmt->close();
        }//stmt
        else {
            echo "<div align=center><font color=red face=arial size=1>Statement Error</font></div>";
        }
         $this->colFetched= count($Heading);
        return($result);
    }

    public function SaveMySqlData($Table, $FldList, $ValueList, $DataType) {
        $result = false;
        $con = $this->ConnectionObject;
        $query = "insert into " . $Table . "(";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
                $binder.=",";
            }
            $query.=$FldList[$i];
            $binder.="?";
        }
        $query.=")values(" . $binder . ")";

        $ValueList = $this->AdjustParam($ValueList, count($FldList));

        $stmt = $con->prepare($query);
        if ($stmt) {
            $bind_names[] = $this->GenFirstParam($ValueList, $DataType);
            for ($i = 0; $i < count($ValueList); $i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $ValueList[$i];
                $bind_names[] = &$$bind_name;
            }
            if (count($bind_names) > 1)
                call_user_func_array(array($stmt, 'bind_param'), $bind_names);
            if ($stmt->execute())
                $result = true;
            else {
                $result = false;
                echo htmlentities($stmt->error);
                $this->error = $stmt->error;
            }
            $stmt->close();
        } //stmt 
        else {
            echo $query . " Statement Error";
//$this->error = $stmt->error;
        }
        return($result);
    }

//SaveData

    public function UpdateMySqlData($Table, $FldList, $ValueList, $Condition, $Param, $DataType) {
        $result = false;
        $con = $this->ConnectionObject;
        $query = "update " . $Table . " set ";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
            }
            $query.=$FldList[$i] . "=?";
        }
        if (strlen($Condition) > 0) //at least one condition given    
            $query.=" where " . $Condition;
        else {
            $query.=" where 1=2"; //consider false condition otherwise complete table will be updated   
        }

//echo $query;

        $tot = $this->CountParam($Condition);
        $Param = $this->AdjustParam($Param, $tot);

        $stmt = $con->prepare($query);
        if ($stmt) {
            $mtype = array();
            $bind_names[] = $this->GenFirstParam($ValueList, $DataType) . $this->GenFirstParam($Param, $mtype);
            for ($i = 0; $i < count($ValueList); $i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $ValueList[$i];
                $bind_names[] = &$$bind_name;
            }
            $k = $i;
            for ($i = 0; $i < count($Param); $i++) {
                $j = $i + $k;
                $bind_name = 'bind' . $j;
                $$bind_name = $Param[$i];
                $bind_names[] = &$$bind_name;
            }

            if (count($bind_names) > 1)
                call_user_func_array(array($stmt, 'bind_param'), $bind_names);
            if ($stmt->execute())
                $result = true;
            else {
                $result = false;
                echo htmlentities($stmt->error); 
                $this->error = $stmt->error;
            }
            $stmt->close();
        } //stmt 
        else {
            echo  " Statement Error";
//$this->error = $stmt->error;
        }
        return($result);
    }

//UpdateData


    private function GenFirstParam($Param, $DataType) {
        $types = '';
        $i = 0;
        foreach ($Param as $param) {
            if (isset($DataType[$i])) {
                if ($DataType[$i] == "INT" || $DataType[$i] == "BIT")
                    $types .= 'i';
                else
                    $types .= 's';
            } else
                $types .= 's';
//echo $i.".".$param." ".$types."<br>";
            $i++;
        }
//echo $types;
        return($types);
    }

//GenFirstParam

    private function CountParam($sql) {
        $cnt = 0;
        for ($i = 0; $i < strlen($sql); $i++) {
            if (substr($sql, $i, 1) == "?" || substr($sql, $i, 1) == "$")
                $cnt++;
        }
        return($cnt);
    }

//countParam

    private function AdjustParam($param, $tot) {
        $temp = array();
        for ($i = 0; $i < $tot; $i++) {
            if (isset($param[$i]))
                $temp[$i] = $param[$i];
            else
                $temp[$i] = "0";
        }
        return($temp);
    }

    private function GenDynamicCondition($ValueParam, &$Param) {
        $cond = " where ";
        $i = 0;
        $Param = array();
        foreach ($ValueParam as $Field => $Value) { //$Field-Field Name as array index and  $Value - value assigned to
            $Param[$i] = $Value;
            if ($i > 0)
                $cond.=" and ";
            $cond.=$Field . "=?";
            $i++;
        }
        if ($i > 0)
            return($cond);
    }

    public function StatementError() {
        return($this->error);
    }

    public function FetchColumnUsingPrepareStmt($table, $fld, $cond, $ValueParam, $default) {
        $val = "";
        $sql = "Select " . $fld . " from " . $table;
        if (strlen($cond) > 2)
            $sql.=" where " . $cond;
        if ($this->Datatype == 0)//mysql
            $row = $this->ReadRecords($sql, $ValueParam, $head);
        if ($this->Datatype == 1) //pg
            $row = $this->ReadPgRecords($sql, $ValueParam, "stmt");
        if ($this->Datatype == 2) //pg
            $row = $this->ReadSQLRecords($sql, $ValueParam);
        if (count($row) > 0)
            $val = $row[0][0];
        else
            $val = $default;
        return($val);
    }

//END MY SQL RELATED   
//START OSTGRE RELATED METHODS
    public function ReadPgRecords($sql, $ValueParam, $stmt) {
        $con = $this->ConnectionObject;
        $temp = array();
        //$objSen = new Sentence();
        $tot = $this->CountParam($sql);
        $ValueParam = $this->AdjustParam($ValueParam, $tot);

        $sql = $this->ReplaceQmark2Dollar($sql, 1);
       // echo "Statement ".$stmt;
        $resultP = @pg_prepare($con, $stmt, $sql);
        if ($resultP == false) {
            //echo "Error ".$sql."<br>";
            //echo "<div align=center><font color=red face=arial size=1>Error" . htmlentities(pg_errormessage($con)).$sql . "</font></div>";
            //echo "ERROR " . pg_errormessage($con);
        //echo  $this->error = pg_errormessage($con);
        } else {
            $result = pg_execute($con, $stmt, $ValueParam);
            $numRow = pg_numrows($result);
             $numField = pg_numfields($result);
            $this->colFetched= $numField;
            $i = 0;
            $rc = 0;
            while ($row = pg_fetch_array($result)) {
                if ($this->WithinRange($i) == true) {
                    for ($j = 0; $j < $numField; $j++) {
                        $var = $row[$j];
                        if (substr($var, 0, 2) === "C#")
                            $var = $objSen->SimpleDecrypt($var, "C");
                        if ($this->IsEncryptedNum($var))
                            $var = $objSen->SimpleDecrypt($var, "N");
                        $temp[$rc][$j] = $var;
                    }//for j
                    $rc++;
                }
                $i++;
            }//while
                    } //else 
        //
        return($temp);
    }

//Readpgrecords
private function FilterNull(&$Field,&$Value,$tag)
{
 $Fld=array();
 $Val=array();
 $a=0;
 $b=0;
 for($i=0;$i<count($Value);$i++)
 {
  if($Value[$i]=="NULL" || strlen($Value[$i])==0 )   //Skip
      $b++;
      else
  {
    $Fld[$a]=$Field[$i];
    $Val[$a]=$Value[$i];
   $a++;
      }
 }//for loop
 $Field=$Fld;
 $Value=$Val;
}
    
    public function SavePgData($Table, $FldList, $ValueList, $Stmt) {
        $res = false;
        $con = $this->ConnectionObject;
        
      $this->FilterNull($FldList, $ValueList,0)  ;
        //ENd Filter NULL Values
                
        $query = "insert into " . $Table . "(";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
                $binder.=",";
            }
            $query.=$FldList[$i];
            $binder.="$" . ($i + 1);
        }
        $query.=")values(" . $binder . ")";

        $ValueList = $this->AdjustParam($ValueList, count($FldList));
        $result = @pg_prepare($con, $Stmt, $query);
        if ($result) {
            $myresult = @pg_execute($con, $Stmt, $ValueList);
            $this->rowCommitted = pg_affected_rows($myresult) ; 
            if ($myresult)
                $res = true;
            else {
                $res = false;
                echo htmlentities(pg_errormessage($con));
                $this->error = pg_errormessage($con);
            }
        } //stmt 
        else {
            echo pg_errormessage($con);
            $this->error = pg_errormessage($con);
        }
        
         //for($i=0;$i<count($FldList);$i++)
        //echo $FldList[$i]."=".$ValueList[$i]."<br>";     
        
        return($res);
    }

//save Pg data

    public function UpadtePgData($Table, $FldList, $ValueList, $Condition, $Param, $Stmt) {
        $res = false;
        $con = $this->ConnectionObject;
        
       $this->FilterNull($FldList, $ValueList,1)  ;

        
        $query = "update " . $Table . " set ";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
            }
            $query.=$FldList[$i] . "=$" . ($i + 1);
        }
        $Condition = $this->ReplaceQmark2Dollar($Condition, ($i + 1));
        if (strlen($Condition) > 1)
            $query.=" where " . $Condition;

        $ValueList = $this->AdjustParam($ValueList, count($FldList));
        //$Param = $this->AdjustParam($Param, count($Condition));

        $FinalParam = $ValueList;
        $tot = count($FinalParam);
        for ($i = 0; $i < count($Param); $i++) {
            $tot = $tot + $i;
            $FinalParam[$tot] = $Param[$i];  //Apend Value and condition parameter 
        }

        $result = @pg_prepare($con, $Stmt, $query);
        if ($result) {
            $myresult = @pg_execute($con, $Stmt, $FinalParam);
            $this->rowCommitted = pg_affected_rows($myresult) ; 
            if ($myresult)
                $res = true;
            else {
                $res = false;
                echo htmlentities(pg_errormessage($con));
                $this->error = pg_errormessage($con);
            }
        } //stmt 
        else {
            echo htmlentities(pg_errormessage($con));
            $this->error = pg_errormessage($con);
        }
        
         //for($i=0;$i<count($FldList);$i++)
         //echo $FldList[$i]."=".$ValueList[$i]."<br>";     
        
        return($res);
    }

//update Pg data

    private function ReplaceQmark2Dollar($sql, $start) {
        $temp = "";
        for ($i = 0; $i < strlen($sql); $i++) {
            if (substr($sql, $i, 1) != "?")
                $temp.=substr($sql, $i, 1);
            else {
                $temp.="$" . $start;
                $start++;
            }
        }//for loop
        return($temp);
    }

//END POSTGRE RELATED METHOD
//START SQL SERVER RELATED METHODS
    public function ReadSQLRecords($sql, $ValueParam) {
        $con = $this->ConnectionObject;
        $temp = array();

        $tot = $this->CountParam($sql);
        $ValueParam = $this->AdjustParam($ValueParam, $tot);

        $result = sqlsrv_query($con, $sql, $ValueParam); //prepare statements

        if ($result == false) {
            echo "<div align=center><font color=red face=arial size=1>Error" . htmlentities($this->SQLError()) . "</font></div>";
            //echo "ERROR " . $this->SQLError();
            $this->error = $this->SQLError();
        } else {
            $numField = sqlsrv_num_fields($result);
            $this->colFetched= $numField;
            $i = 0;
            $rc = 0;
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
                if ($this->WithinRange($i) == true) {
                    for ($j = 0; $j < $numField; $j++) {
                        $temp[$rc][$j] = $row[$j];
                    }//for j
                    $rc++;
                }
                $i++;
            }//while
        } //else result
//sqlsrv_free_stmt($result);
        return($temp);
    }

//ReadpSQL Records 

    public function SaveSQLData($Table, $FldList, $ValueList) {
        $res = false;
        $con = $this->ConnectionObject;
        $query = "insert into " . $Table . "(";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
                $binder.=",";
            }
            $query.=$FldList[$i];
            $binder.="?";
        }
        $query.=")values(" . $binder . ")";

        $ValueList = $this->AdjustParam($ValueList, count($FldList));
        $result = sqlsrv_query($con, $query, $ValueList);
        if ($result) {
            $res = true;
        } else {
            $res = false;
            echo htmlentities($this->SQLError());
            $this->error = $this->SQLError();
        }

        return($res);
    }

//save SQL data

    public function UpadteSQLData($Table, $FldList, $ValueList, $Condition, $Param) {
        $res = false;
        $con = $this->ConnectionObject;
        $query = "update " . $Table . " set ";
        $binder = "";
        for ($i = 0; $i < count($FldList); $i++) {
            if ($i > 0) {
                $query.=",";
            }
            $query.=$FldList[$i] . "=?";
        }
        if (strlen($Condition) > 1)
            $query.=" where " . $Condition;

        $ValueList = $this->AdjustParam($ValueList, count($FldList));
        $Param = $this->AdjustParam($Param, count($Condition));

        $FinalParam = $ValueList;
        $tot = count($FinalParam);
        for ($i = 0; $i < count($Param); $i++) {
            $tot = $tot + $i;
            $FinalParam[$tot] = $Param[$i];  //Apend Value and condition parameter 
        }

        $result = sqlsrv_query($con, $query, $FinalParam);

        if ($result)
            $res = true;
        else {
            $res = false;
            echo htmlentities($this->SQLError());
            $this->error = $this->SQLError();
        }

        return($res);
    }

//update SQL data

    private function SQLError() {
        $error = sqlsrv_errors();
        foreach ($error as $error)
            $err = $error['message'];
        return($err);
    }

    
    private function WithinRange($i) {
        $ok = false;
        if ($this->tot == "0")
            $ok = true;
        if ($this->tot > 0) {
            if ($i >= $this->start && $i < $this->tot)
                $ok = true;
        }
        return($ok);
    }

    private function ExecuteMySqlQuery($Query, $ValueList, $DataType, $errorlisten=false) {
        $result = false;
        $con = $this->ConnectionObject;
        $totparam = $this->CountParam($Query);
        $ValueList = $this->AdjustParam($ValueList, $totparam);

        $stmt = $con->prepare($Query);
        if ($stmt) {
            $bind_names[] = $this->GenFirstParam($ValueList, $DataType);
            for ($i = 0; $i < count($ValueList); $i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $ValueList[$i];
                $bind_names[] = &$$bind_name;
            }
            if (count($bind_names) > 1)
                call_user_func_array(array($stmt, 'bind_param'), $bind_names);
            if ($stmt->execute())
                $result = true;
            else {
                $result = false;
                if ($errorlisten)
                    echo htmlentities($stmt->error);
                $this->error = $stmt->error;
            }
            $stmt->close();
        } //stmt 
        else {
            if ($errorlisten)
                echo $query . " Statement Error";
//$this->error = $stmt->error;
        }
        return($result);
    }

    private function ExecutePGQuery($Query, $ValueList, $errorlisten) {
        $res = false;
        $con = $this->ConnectionObject;
        $Query = $this->ReplaceQmark2Dollar($Query, 1);
        $totparam = $this->CountParam($Query);
        $ValueList = $this->AdjustParam($ValueList, $totparam);
        $stmt = "stmt" . rand(1, 200);
        $result = @pg_prepare($con, $stmt, $Query);
        if ($result) {
            $myresult = @pg_execute($con, $stmt, $ValueList);
             if ($myresult)
            {
                $res = true;
                $this->rowCommitted = pg_affected_rows($myresult) ; 
            }
            else {
                $res = false;
                if ($errorlisten)
                    echo htmlentities(pg_errormessage($con));
                $this->error = pg_errormessage($con);
               // echo pg_errormessage($con);
            }
                }
        return($res);
    }

//PG Query

    private function ExecuteSQLQuery($Query, $ValueList, $errorlisten) {
        $res = false;
        $con = $this->ConnectionObject;
        $totparam = $this->CountParam($Query);
        $ValueList = $this->AdjustParam($ValueList, $totparam);

        $result = sqlsrv_query($con, $Query, $ValueList);
        if ($result) {
            $res = true;
        } else {
            $res = false;
            if ($errorlisten)
                echo htmlentities($this->SQLError());
            $this->error = $this->SQLError();
        }
        return($res);
    }

//SQL Server Query

     public function ExecuteBatchDataComplete($Table, $FldList, $ValueList, $Packet,$DataType=array(), $showerror = false) {
   $rowpassed = count($ValueList);

        $numCol = count($FldList);
        $numRow = count($ValueList);
        $sql = "";
        $MainStr = "Insert into " . $Table . "(";
        for ($i = 0; $i < $numCol; $i++) {
            $MainStr.= $FldList[$i];
            if ($i < ($numCol - 1))
                $MainStr.=",";
            else
                $MainStr.=") Values";
        }

        $Failed = 0;
        $numpacket = 0;
        $ex = 0;
        $rowcount = 0;
        $Cstr = "";
        $commonValStr = "";
        $recordcount = 0;
        $index = 0;
        $Value = array();
        $Type = array();
        $start = 0;
        for ($i = 0; $i < count($ValueList); $i++) {
            $valStr = "(";
            $recordcount++;
            for ($j = 0; $j < $numCol; $j++) {
                if (isset($DataType[$j]))
                    $mtype = strtoupper($DataType[$j]);
                else
                    $mtype = "VARCHAR";
                if ($mtype == "UNICODE") //donot bind rather use as normal string
                    $valStr.="N'" . $ValueList[$i][$j] . "'";
                else
                    $valStr.="?";
                if ($j < ($numCol - 1))
                    $valStr.=",";
                else
                    $valStr.=")";
            }//$j


            if ($rowcount == $Packet) { //packet size reached
                $sql = $MainStr . $commonValStr;
                $this->LoadArray($ValueList, $numCol, $DataType, $start, $rowcount, $Value, $Type);
                $start = $start + $rowcount;
                if ($this->ExecuteQuery($sql, $Value, $Type))
                    $ex+=$Packet;
                   else {
                    $Failed = $Failed + 1;
                    $i = count($ValueList); //End other Transaction Forcefully as it fails
                } 
                
                $numpacket+=$Packet;
                $rowcount = 0;

                $commonValStr = "";
            }//$rowcount==$packet

            $commonValStr.=$valStr;
            $rowcount++;
            if ($rowcount < $Packet && $recordcount < $numRow)
                $commonValStr.=",";
            else
                $commonValStr.=";";
        }//$i
    
//Handle remaining Row
        if (strlen($commonValStr) > 0 && $Failed == 0) {
            $sql = $MainStr . $commonValStr;
            $this->LoadArray($ValueList, $numCol, $DataType, $start, $rowcount, $Value, $Type);
            if ($this->ExecuteQuery($sql, $Value, $Type,true))
                $ex+=($rowpassed - $numpacket);
        }
        //echo $sql;
        return($ex);
     
     }
    
    
    public function ExecuteBatchData($Table, $FldList, $ValueList, $Packet, $DataType=array(), $showerror = false) {

        $rowpassed = count($ValueList);

        $numCol = count($FldList);
        $numRow = count($ValueList);
        $sql = "";
        $MainStr = "Insert into " . $Table . "(";
        for ($i = 0; $i < $numCol; $i++) {
            $MainStr.= $FldList[$i];
            if ($i < ($numCol - 1))
                $MainStr.=",";
            else
                $MainStr.=") Values";
        }

        $numpacket = 0;
        $ex = 0;
        $rowcount = 0;
        $Cstr = "";
        $commonValStr = "";
        $recordcount = 0;
        $index = 0;
        $Value = array();
        $Type = array();
        $start = 0;
        for ($i = 0; $i < count($ValueList); $i++) {
            $valStr = "(";
            $recordcount++;
            for ($j = 0; $j < $numCol; $j++) {
                if (isset($DataType[$j]))
                    $mtype = strtoupper($DataType[$j]);
                else
                    $mtype = "VARCHAR";
                if ($mtype == "UNICODE") //donot bind rather use as normal string
                    $valStr.="N'" . $ValueList[$i][$j] . "'";
                else
                    $valStr.="?";
                if ($j < ($numCol - 1))
                    $valStr.=",";
                else
                    $valStr.=")";
            }//$j


            if ($rowcount == $Packet) { //packet size reached
                $sql = $MainStr . $commonValStr;
                $this->LoadArray($ValueList, $numCol, $DataType, $start, $rowcount, $Value, $Type);
                $start = $start + $rowcount;
                if ($this->ExecuteQuery($sql, $Value, $Type))
                    $ex+=$Packet;

                $numpacket+=$Packet;
                $rowcount = 0;

                $commonValStr = "";
            }//$rowcount==$packet

            $commonValStr.=$valStr;
            $rowcount++;
            if ($rowcount < $Packet && $recordcount < $numRow)
                $commonValStr.=",";
            else
                $commonValStr.=";";
        }//$i
    
//Handle remaining Row
        if (strlen($commonValStr) > 0) {
            $sql = $MainStr . $commonValStr;
            $this->LoadArray($ValueList, $numCol, $DataType, $start, $rowcount, $Value, $Type);
            if ($this->ExecuteQuery($sql, $Value, $Type,true))
                $ex+=($rowpassed - $numpacket);
        }
        //echo $sql;
        return($ex);
    }

//executeBatch

    private function LoadArray($ValueList, $FldCount, $DataType, $start, $tot, &$Value, &$Type) {
        $k = 0;
        for ($i = $start; $i < ($start + $tot); $i++) {
            for ($j = 0; $j < $FldCount; $j++) {
                if (isset($DataType[$j]))
                    $mtype = $DataType[$j];
                else
                    $mtype = "VARCHAR";
                if ($mtype != "UNICODE") {
                    $Value[$k] = $ValueList[$i][$j];
                    $Type[$k] = $mtype;
                    //echo $Value[$k].",";
                    $k++;
                }
            } //$j
        } //$i
    }

    private function IsEncryptedNum($str) {
        $res = false;
        if (strlen($str) > 6) {
            $p1 = substr($str, 0, 3);
            $p2 = substr($str, -3);
            $p = substr($p2, 2, 1) . substr($p2, 1, 1) . substr($p2, 0, 1);
            if ($p1 === $p)
                $res = true;
        }
        return($res);
    }

//CODE RELATING TO PGDBMANAGER
    public function CreateRestoreFile($database) {
        $user = trim(Config::getUser());
        $pass = trim(Config::getPWD());
//$database=trim(Config::getDB());
        $port = Config::getPort();

        $path = $this->ApplicationFolder() . "/Database/Essential";
        $drive = substr($path, 0, 2);
        $backup_path = $path . "/Election_Blank.backup";

        $path = $path . "/restore.bat";

//pg_dump.exe  --host localhost --port ".$port." --username ".$user."   --format custom  --blobs --verbose   ".$database."> e:/applicant.backup 2>&1 
        $command = "pg_restore  --host localhost --port " . $port . " --username " . chr(34) . $user . chr(34) . " --dbname " . chr(34) . $database . chr(34) . " --verbose " . chr(34) . $backup_path . chr(34);
        //pg_restore --host localhost --port 5432 --username "postgres" --dbname "elect_nalbari"  --verbose "E:/xampp/htdocs/PGUTILITY/Log/Database.backup"
//$drive="C:";
//$binpath="C:/Progra~1/PostgreSQL/9.4/bin";

        $binpath = Config::getBinPath();
        $drive = substr($binpath, 0, 2);

//echo $command;
        $this->WriteF($path, "cd/");    //GO to root
        $this->AppendF($path, "REM Change Postgre Installation Path upto bin Directory if required");
        $this->AppendF($path, $drive);   //C: or D:
        $this->AppendF($path, "cd " . $binpath);   // cd d:\wamp\bin\mysql\mysql5.5.8/bin
        $this->AppendF($path, "set PGPASSWORD=" . $pass);
        $this->AppendF($path, $command);

//echo $command;
    }

//end restore    

    private function CreateBatchFile() {
//$version="5.5.8";
//$version=$this->ve
        $deo=$this->DeoCode();
        //if($deo==0)
         //  exit();
        $user = trim(Config::getUser());
        $pass = trim(Config::getPWD());
        $database = trim(Config::getDB());
        $port = Config::getPort();

        $path = $this->ApplicationFolder() . "/Database";
        $drive = substr($path, 0, 2);
        $dumpfile = $path . "/" . $database . ".backup";

        $path = $path . "/backup_post" . $deo . ".bat";

//pg_dump.exe  --host localhost --port ".$port." --username ".$user."   --format custom  --blobs --verbose   ".$database."> e:/applicant.backup 2>&1 
        $command = "pg_dump.exe --host localhost --port " . $port . " --username " . chr(34) . $user . chr(34) . " --format custom  --blobs --verbose " . chr(34) . $database . chr(34) . ">" . chr(34) . $dumpfile . chr(34);

//$drive="C:";
//$binpath="C:/Progra~1/PostgreSQL/9.4/bin";

        $binpath = Config::getBinPath();
        $drive = substr($binpath, 0, 2);

//echo $command;

        if (file_exists($path) == false && $deo>0) {
            $this->WriteF($path, "cd/");    //GO to root
            $this->AppendF($path, "REM Change Postgre Installation Path upto bin Directory if required");
            $this->AppendF($path, $drive);   //C: or D:
            $this->AppendF($path, "cd " . $binpath);   // cd d:\wamp\bin\mysql\mysql5.5.8/bin
            $this->AppendF($path, "set PGPASSWORD=" . $pass);
            $this->AppendF($path, $command);
        }
    }

    public function AutoBackup($force) {
        $database = trim(Config::getDB());
        $path = $this->ApplicationFolder();

        $a = $this->FolderLevel($Level);

        $gpath = $path . "/Log/" . Config::getDB() . "/*.*";

        $orgfile = $path . "/database/" . $database . ".backup";   //Databse Folder under Application

        $newfile = substr($path, 0, 2) . "database/" . $database . ".backup";  //Database to Application Drive

        $newfile_old = substr($path, 0, 2) . "database/" . $database . "_old.backup";

        $drivepath = substr($path, 0, 2) . "database";
        if (file_exists($drivepath) == false)
            mkdir($drivepath);

        $oldfile = $path . "/database/" . $database . "_old.backup";

        $fname = $path . "/TextFile/LastBackup" . $this->DeoCode() . ".txt";

        $date = $this->ReadF($fname);
        //$date=str_replace(":","-",$date);
        //$this->WriteF($path."/database/".$database."_old.txt", $database."_old.backup Contains Data Upto ". $date);


        if ($force == 1) {
            if (file_exists($fname))
                unlink($fname);
        }

        //$this->WriteF("TEST.txt"," force-".$force." date ".$date);


        if ($this->BackUpDue($this->DeoCode()) == true) {
            //$this->LockBackup();     
            $bfile = $Level . "Log/" . Config::getDB() . "/" . date('dmY') . "query.sql";
            if (file_exists($bfile)) {
                copy($bfile, $Level . "Log/" . Config::getDB() . "/Query.txt");
                unlink($bfile);
            }

            if (file_exists($orgfile)) {
                copy($orgfile, $oldfile);    //copy preveous backup
                unlink($orgfile);
                //$this->AppendF("TEST.txt"," force-".$force." date ".$date);
            }

            $path = $path . "/database/backup_post" . $this->DeoCode() . ".bat";  ////Batchfile for My SQL backup

            $this->RunBatchFile($path);
            //$this->AppendF("TEST.txt",$path);

            foreach (glob($gpath) as $filename) {
                if (substr($filename, -17) != date('dmY') . "query.sql" && substr($filename, -9) != "Query.txt") {
                    if (file_exists($filename))
                        unlink($filename);
                }
            } //foeach glob
            //copy in hard drive/databse folder
            copy($newfile, $newfile_old);
            copy($orgfile, $newfile);   //copy to Drive
            //$this->AppendF("TEST.txt",$orgfile." to ".$newfile);
            $this->WriteF($fname, date('d-m-YH:i:s'));
        } //due=true
    }//AutoBAckup

    
    public function returnBoolean($val) {
        if ($val == "t")
            return(true);
        else
            return(false);
    }
    
    
     public function Execute($sql,$Param = array(), $DataType = array()) {
        $sub = Config::getDB();
         $result = $this->ExecuteQuery($sql, $Param, $DataType , $errorlisten = false);
        //$this->CloseConnection();
        return($result);
    }

    public function ExecuteMultipleQuery($query) {  //separate statement using semicolon ;
        $this->ExecuteQuery($query);
    }

    

    public function Try2Execute($sql,$Param = array(), $DataType = array()) {
        $sub = Config::getDB();
        
        $result = $this->ExecuteQuery($sql, $Param , $DataType , $errorlisten = false);
        $this->returnSql = $sql;
        return($result);
        //$this->CloseConnection();
    }

    public function getColumnNames($Table, $Database = null) {
        $tRows = array();
        
        $sql = "select column_name from information_schema.columns where table_schema=? and table_name=? order by Ordinal_position";
        $row = $this->FetchRecords($sql, $Param = array($this->schema, $Table));
        for ($i = 0; $i < count($row); $i++) {
            $tRows[$i] = trim(strtolower($row[$i][0]));
        } //End While
        return($tRows);
    }

    public function getDataTypes($Table, $Database = null) {
        $tRows = array();
        
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $sql = "select column_name,data_type from information_schema.columns where table_schema=?  and table_name=? order by Ordinal_position";
        //echo $sql."<br>";
        $row = $this->FetchRecords($sql, $Param = array($this->schema, $Table));

        //echo count($row);
        for ($i = 0; $i < count($row); $i++) {
            $ind = strtolower($row[$i][0]);
            $tRows[$ind] = $row[$i][1];
        } //End While
        return($tRows);
    }

    public function getNull($Table, $Database = null) {
        $tRows = array();
        
        $sql = "select column_name,is_nullable from information_schema.columns where table_schema=? and table_name=? order by Ordinal_position";
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $row = $this->FetchRecords($sql, $Param = array($this->schema, $Table));

        for ($i = 0; $i < count($row); $i++) {
            $ind = strtolower($row[$i][0]);
            $tRows[$ind] = $row[$i][1];
            //echo $ind." ".$row[$i][1]."  ";
        } //End While
        // echo $sql."<br>".count($tRows);
        return($tRows);
    }

    public function getMaxLength($Table, $Database = null) {
        $tRows = array();
        

        $sql = "select column_name,character_maximum_length from information_schema.columns where table_schema=? and table_name=?  order by Ordinal_position";
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $row = $this->FetchRecords($sql, $Param = array($this->schema, $Table));

        for ($i = 0; $i < count($row); $i++) {
            $ind = strtolower($row[$i][0]);
            $tRows[$ind] = $row[$i][1];
        } //End While
        // echo $sql."<br>".count($tRows);
        return($tRows);
    }

    public function getFieldNames($sqlStr) {

        $sResult = $this->ExecuteQuery($sqlStr);
        $arrValue = array();
        if ($sResult) {
            $numColumns = pg_num_fields($sResult);

            if ($numColumns > 0) {
                for ($i = 0; $i < $numColumns; $i++) {
                    $arrValue[$i] = pg_field_name($sResult, $i);
                }
            }
        }

        return ($arrValue);
    }

    public function Error() {
        if ($this->ConnectionObject)
            return(pg_errormessage($this->ConnectionObject));
    }

    public function filterLimit($sql) {
        return($sql);
    }

    public function FetchRecordUsingIndexValue($table, $fld1, $fld2, $cond) {

        
        $tRows = array();

        $sql = "select " . $fld1 . "," . $fld2 . " from " . $table . " where " . $cond;
        $row = $this->FetchRecords($sql, $Param);

        for ($i = 0; $i < count($tRows); $i++) {
            $val1 = $rows[$i][0];
            $val2 = $rows[$i][1];
            $tRows[$val1] = $val2;
        }


        return($tRows);
    }

//FetchRecordUsingIndexValue
    

    public function FetchRecordsWithErrorMessage($sql, &$Error) {
        return($this->FetchRecords($sql));
    }

    public function ReturnTopQuery($sql, $record) {
        $sql = trim($sql);
        $sql.=" limit " . $record;
        return($this->FetchRecords($sql));
    }

//End Fetchrecord

    public function genCheckBox($id, $val, $bcol, $fcol, $font, $function, $mandatory) {
        $id = $this->Sanitize_Special($id, 20);
         $val = $this->Sanitize_Special($val, 200);
        $bcol = $this->Sanitize_Special($bcol, 10);
        $fcol = $this->Sanitize_Special($fcol, 10);
        $font = $this->Sanitize_Number($font, 2);
         $mandatory = $this->Sanitize_Number($mandatory, 1);
         $function = $this->Sanitize_Special( $function, 30);
        
        // htmlentities($string)
        if ($val == "t" || $val == "1")
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;";
        echo "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        if ($mandatory)
            echo "<font color=red size=3 face=arial><b>*</b></font>";
    }

//genCheckbox

    public function TdCheckBox($align, $bcol, $id, $val, $function) {
         $id = $this->Sanitize_Special($id, 20);
         $val = $this->Sanitize_Special($val, 200);
          $bcol = $this->Sanitize_Special($bcol, 10);
          $align=$this->Sanitize_Number(  $align , 3);
          
           $function = $this->Sanitize_Special( $function, 30);
        echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        $this->genCheckBox($id, htmlentities($val), $this->bcol, $this->fcol, $this->font, $function, 0);
        echo "</td>";
    }

    //genCheckbox


    public function JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond) {
        $sql = "update " . $DstTable . " set ";

        for ($i = 0; $i < count($SrcFld); $i++) {
            if ($i > 0)
                $sql.=",";
            $sql.=$DstField[$i] . "=" . $SrcTable . "." . $SrcFld[$i];
        }
        $sql.=" from " . $SrcTable;
        $sql.=" where " . $cond;
        return($sql);
    }

//Join Update
    //COLUMN RELATED METHOD  
//column class

    
    public function getFirstTable() {
        
        $sql = "SELECT table_name FROM information_schema.tables where table_schema=? and table_type='BASE TABLE' order by table_name ";
        $row = $this->FetchRecords($sql, $param = array($this->schema));
        $index = rand(0, count($row) - 1);
        if (isset($_SESSION['Table']))
            $table = $_SESSION['Table'];
        else {
            if (isset($row[$index][0]))
                $table = $row[$index][0];
        }

        return($table);
    }

    public function getTableList() {
        $i = 0;
        

        $tRow = array();
        $sql = "SELECT table_name FROM information_schema.tables where table_schema=?  and table_type='BASE TABLE' order by table_name ";
        $row = $this->FetchRecords($sql, $param = array($this->schema));
        for ($i = 0; $i < count($row); $i++) {
            $tRow[$i] = strtolower($row[$i][0]);
        }
        return($tRow);
    }

    public function LoadTableinArray() {
        $tr = array();
        $row = $this->getTableList();
        for ($i = 0; $i < count($row); $i++) {
            $tr[$i][0] = $row[$i];
            $tr[$i][1] = strtoupper($row[$i]);
        }
        return($tr);
    }

//loadtable

    public function getColumnArray($Table) {
        $tRows = array();
        

//$sql="select column_name,ordinal_position,column_default,is_nullable,data_type,character_maximum_length,character_octet_length,numeric_precision,numeric_scale,character_set_name,collation_name";//,Column_type,Column_key,Extra,Privileges,Column_comment from COLUMNS where Table_schema='public' and Table_name='".$Table."' order by Ordinal_position";
        $sql = "select column_name,ordinal_position,column_default,is_nullable,data_type,character_maximum_length,character_octet_length,numeric_precision,numeric_scale,character_set_name,collation_name from information_schema.columns where table_schema=?  and table_name=? order by Ordinal_position";

        $this->returnSql = $sql;

        $row = $this->FetchRecords($sql, $param = array($this->schema, $Table));
        for ($i = 0; $i < count($row); $i++) {
            $tRows[$i]['Column_name'] = $row[$i][0];
            $tRows[$i]['Ordinal_position'] = $row[$i][1];

            $def = $row[$i][2];
            $ind = $this->inStr($def, "::");
            $def = substr($def, 0, $ind);
            $def = str_replace("'", "", $def);

            $tRows[$i]['Column_default'] = $def;
            $tRows[$i]['Is_nullable'] = $row[$i][3];
            $tRows[$i]['Data_type'] = $row[$i][4];
            $tRows[$i]['Character_maximum_length'] = $row[$i][5];
            if ($this->isPrimaryKey($Table, $row[$i][0]))
                $tRows[$i]['Primary'] = "Y";
            else
                $tRows[$i]['Primary'] = "N";
            $tRows[$i]['Column_comment'] = $this->ColumnDescprition($Table, $row[$i][0]);
        } //End While
        return($tRows);
    }

//End column lis

    public function LoadColumnDetail($Table) {
        $row = array();
        $col = $this->ColumnCount($Table);

        //echo $col;
        $COLUMN_NAME = array();
        if (isset($_SESSION['COLUMN_NAME']))
            $COLUMN_NAME =$this->Sanitize_Special($_SESSION['COLUMN_NAME']);

        $DATA_TYPE = array();
        if (isset($_SESSION['DATA_TYPE']))
            $DATA_TYPE = $this->Sanitize_Special($_SESSION['DATA_TYPE']);

        $IS_NULL = array();
        if (isset($_SESSION['IS_NULL']))
            $IS_NULL =$this->Sanitize_Special( $_SESSION['IS_NULL']);

        $P_KEY = array();
        if (isset($_SESSION['P_KEY']))
            $P_KEY =$this->Sanitize_Special( $_SESSION['P_KEY']);

        $DEF_VAL = array();
        if (isset($_SESSION['DEF_VAL']))
            $DEF_VAL =$this->Sanitize_Special( $_SESSION['DEF_VAL']);

        $MAX_LENGTH = array();
        if (isset($_SESSION['MAX_LENGTH']))
            $MAX_LENGTH =$this->Sanitize_Special( $_SESSION['MAX_LENGTH']);

        if (!isset($COLUMN_NAME[$Table][0])) {
            $row = $this->getColumnArray($Table);
            for ($i = 0; $i < $col; $i++) {
                $COLUMN_NAME[$Table][$i] = $row[$i]['Column_name'];
                $DATA_TYPE[$Table][$i] = $row[$i]['Data_type'];
                $MAX_LENGTH[$Table][$i] = $row[$i]['Character_maximum_length'];
                $DEF_VAL[$Table][$i] = $row[$i]['Column_default'];
                $IS_NULL[$Table][$i] = $row[$i]['Is_nullable'];
                $P_KEY[$Table][$i] = $row[$i]['Primary'];
            }//for loop
//echo "loaded  from database";
        }//if 
        else {
            for ($i = 0; $i < $col; $i++) {
                $row[$i]['Column_name'] = $COLUMN_NAME[$Table][$i];
                $row[$i]['Data_type'] = $DATA_TYPE[$Table][$i];
                $row[$i]['Character_maximum_length'] = $MAX_LENGTH[$Table][$i];
                $row[$i]['Column_default'] = $DEF_VAL[$Table][$i];
                $row[$i]['Is_nullable'] = $IS_NULL[$Table][$i];
                $row[$i]['Primary'] = $P_KEY[$Table][$i];
            }//for loop
//echo "loaded  from memory";
        } //elseif

        $_SESSION['COLUMN_NAME'] = $COLUMN_NAME;
        $_SESSION['DATA_TYPE'] = $DATA_TYPE;
        $_SESSION['IS_NULL'] = $IS_NULL;
        $_SESSION['P_KEY'] = $P_KEY;
        $_SESSION['DEF_VAL'] = $DEF_VAL;
        $_SESSION['MAX_LENGTH'] = $MAX_LENGTH;

        return($row);
    }

//LoadColumnDetail

    public function ColumnCount($Table) {
        

        $tRows = array();
        $r = 0;
        $sql = "select column_name  from information_schema.columns where Table_schema=? and Table_name=?";
        $row = $this->FetchRecords($sql, $param = array($this->schema, $Table));

        $r = count($row);

        return($r);
    }

//End EditRecord

    public function isPrimaryKey($table, $col) {
        

        $cond = "(select constraint_name from information_schema.table_constraints where constraint_schema=?' and constraint_type='PRIMARY KEY')";
        $sql = "select count(*) from information_schema.key_column_usage where table_schema=? and table_name=? and column_name=?' and constraint_name  in " . $cond;
        $res = false;

        $row = $this->FetchRecords($sql, $param = array($this->schema, $table, $col, $this->schema));

        if (strlen($row[0][0]) > 0) {
            if ($row[0][0] > 0)
                $res = true;
        }
        return($res);
    }

//isPrimaryKey

    public function DataType($table, $col) {
        

        $cond = " table_schema=? and table_name=? and column_name=?";
        $type = $this->FetchColumn("information_schema.columns", "data_type", $cond, $para = array($this->schema, $table, $col), "");

        return($type);
    }

//End EditRecord

    public function isNull($table, $col) {
        

        $cond = " table_schema=? and table_name=? and column_name=?";
        $type = $this->FetchColumn("information_schema.columns", "is_nullable", $cond, $para = array($this->schema, $table, $col), "");
        if ($type == "YES")
            return(true);
        else
            return(false);
    }

    public function CountKey($table) {
        $row = $this->KeyList($table);
        return(count($row));
    }

//countKey

    public function KeyList($table) {
        

        $cond = "(select constraint_name from information_schema.table_constraints where constraint_schema=?  and constraint_type='PRIMARY KEY') order by ordinal_position";
        $sql = "select column_name from information_schema.key_column_usage where table_schema=? and table_name=? and  constraint_name  in " . $cond;
        $mrow = array();
        $i = 0;
        $row = $this->FetchRecords($sql, $param = array($this->schema, $table, $this->schema));

        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = $row[$i][0];
        }//for loop
        return($mrow);
    }

//KeyList

   
//End Fetchrecord

    public function refTable($table, $column) {
        $this->SingleReferenceTable($table, $column, $Tab, $Col);
        return($Tab);
    }

    public function refTableonConstraint($const) {
        

        $cond = " table_schema='public'  and constraint_name=?";
        $reftable = $this->FetchColumn("information_schema.constraint_column_usage", "table_name", $cond, $para = array($const), "");

        return($reftable);
    }

    public function refColumn($table, $column) {
        $this->SingleReferenceTable($table, $column, $Tab, $Col);
        return($Col);
    }

    public function refColumnConstraint($const, $column) {
        

        $cond = " table_schema='public' and constraint_name =? and column_name=?";
        $pos = $this->FetchColumn("information_schema.key_column_usage", "position_in_unique_constraint", $cond,$para = array($const,$column), "");

               
        if (strlen($pos) == 0)
            $pos = 0;
        $cond = " constraint_schema='public' and  constraint_name=?";
        $uniqueconst = $this->FetchColumn("information_schema.referential_constraints", "unique_constraint_name", $cond,$para = array($const), "");

               
        $cond = " table_schema='public' and constraint_name=?  and ordinal_position=?";
        $mcol =  $this->FetchColumn("information_schema.key_column_usage", "column_name", $cond,array($uniqueconst,$pos), "");
        
        //$pos = $this->FetchColumn("information_schema.key_column_usage", "position_in_unique_constraint", $cond,$para = array($const,$column), "");

        return($mcol);
        }

        public function AllRefTableColumn($table, $column, &$RefTable, &$RefColumn)
        {
        

        $LinkList = "";
        $sql = "select constraint_name,position_in_unique_constraint from information_schema.key_column_usage where table_name=? and column_name=? and position_in_unique_constraint>0";
        $row = $this->FetchRecords($sql,$param=array($table,$column));
        for ($i = 0; $i < count($row); $i++) {
            $const = $row[$i][0];
            $RefTable[$i] = $this->refTableonConstraint($const);
            $RefColumn[$i] = $this->refColumnConstraint($const, $column);
            if ($i > 0)
                $LinkList.="<br>";
            $LinkList.=strtoupper($RefTable[$i]) . "->" . $RefColumn[$i];
        }
        return($LinkList);
    }

//

    public function SingleReferenceTable($table, $column, &$Tab, &$Col) {
        

        $Tab = "";
        $Col = "";
        $res = false;
        $table = strtolower($table);
        $column = strtolower($column);
        $aa = $this->AllRefTableColumn($table, $column, $RefTable, $RefColumn);
        for ($i = 0; $i < count($RefTable); $i++) {
            if ($this->CountKey($RefTable[$i]) == 1) {
                $Tab = $RefTable[$i];
                $Col = $RefColumn[$i];
                $res = true;
            }
        }
    }

    public function ColumnNames($Table) {
        

        $tRows = array();
        $Table = strtolower($Table);
        $sql = "select column_name from information_schema.columns where table_schema='public' and table_name=? order by Ordinal_position";
      $row = $this->FetchRecords($sql,$param=array($Table));
        for ($i = 0; $i < count($row); $i++) {
            $tRows[$i] = $row[$i][0];
        } //End While
        return($tRows);
    }

//End EditRecord

    public function TotReference($table, $column) {
        $totkey = 0;
        $tab = $this->refTable($table, $column);
//echo "table".$tab;
        if (strlen($tab) > 0) {
            $totkey = $this->CountKey($tab);
        }
//echo "tot key of ".$tab."-".$totkey;
        return($totkey);
    }

    public function TableDescprition($table) {
                return("");
    }

    public function ColumnDescprition($table, $col) {
        

        if ($this->schema == 'public') {
            $cond = "relname=?";
            $oid = $this->FetchColumn("pg_catalog.pg_class", "oid", $cond,$param=array($table), "");
            $cond = "table_schema=?   and table_name=? and column_name=?";
            $pos = $this->FetchColumn("information_schema.columns", "ordinal_position", $cond,$param=array($this->schema,$table,$col), "0");

            $sql = "select pg_catalog.col_description(?,?)";
            $row =  $this->FetchRecords($sql, $Param=array($oid,$pos));
            if (count($row) > 0)
                return($row[0][0]);
            else
                return("");
        }
    }//Column Description
    
     public function SchemaDot() {
        $schema = (strlen($this->Schema()) > 1) ? $this->Schema() . "." : '';
        return($schema);
    }

    public function SchemaDotTable($Tbl) {
        $a = trim(strtolower($this->SchemaDot()));
        $length = strlen($a);
        $b = strtolower($Tbl);
        if (substr($b, 0, $length) != $a)
            $Tbl = $this->SchemaDot() . $Tbl;
        return($Tbl);
    }

}

//End Class

