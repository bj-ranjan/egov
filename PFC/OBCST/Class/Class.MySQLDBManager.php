<?php

require_once 'class.config.php';
require_once 'Class.CommonParameter.php';

//insert into mysql/pgsql/sql server
//insert into NewTable (Field1,Field2,Field3) select Field1,Field2,Field3 from  OldTable

//create user 'admin';

//UPDATE `mysql`.`user` SET `Password` = PASSWORD( 'admin' ) WHERE `user`.`Host` = 'localhost' AND `user`.`User` = 'admin';


//GRANT SELECT ON * . * TO admin@localhost 
//GRANT LOCK TABLES ON * . * TO admin@localhost 



class MySqlDBManager extends CommonParameter {

//public function _construct($i) //for PHP6
    public $con;
    public $mysqli;

    public function __construct() {
        $this->mysqli = true; // set true if php 5.5 version or more is used which doesnot allow mysql_query
        //$this->mysqli=false;
        //header("Content-Type: text/html; charset=utf-8");
        date_default_timezone_set("Asia/kolkata");
        $dbname = trim(Config::getDB());
        $this->connect($dbname);
        $this->BackEndCode = "0";
        $this->False = "0";
        $this->True = "1";
        $this->AutoCommit(1);

        $objC = new CommonParameter();

        $time = "";
        if ($objC->TimeOut($time) == false)
            $_SESSION['LatestTime'] = date('H:i:s');

        $this->setTable_schema($dbname);
        $this->CreateBatchFile();
    }

    public function getColumnNames($Table, $Database = null) {
        $tRows = array();
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $sql = "select column_name from information_schema.columns where table_schema='" . $Database . "' and table_name='" . $Table . "' order by Ordinal_position";
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $tRows[$i] = $row[$i][0];
        } //End While
        return($tRows);
    }

    public function getDataTypes($Table, $Database = null) {
        $tRows = array();
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $sql = "select column_name,data_type from information_schema.columns where table_schema='" . $Database . "' and table_name='" . $Table . "' order by Ordinal_position";
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $ind = $row[$i][0];
            $tRows[$ind] = $row[$i][1];
        } //End While
        return($tRows);
    }

    public function getNull($Table, $Database = null) {
        $tRows = array();
        $sql = "select column_name,is_nullable from information_schema.columns where table_schema='" . $Database . "' and table_name='" . $Table . "' order by Ordinal_position";
        if (strlen($this->getTable_schema()) > 0)
            $Database = $this->getTable_schema();
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $ind = $row[$i][0];
            $tRows[$ind] = $row[$i][1];
        } //End While
        // echo $sql."<br>".count($tRows);
        return($tRows);
    }

    

    public function AutoBackup($force) {
        $database = trim(Config::getDB());
        $path = $this->ApplicationFolder();

        $a = $this->FolderLevel($Level);

        $gpath = $Level . "Log/*.*";

        $orgfile = $path . "/database/" . $database . ".sql";   //Databse Folder under Application
        $newfile = substr($path, 0, 2) . "/" . $database . ".sql";  //Database to Application Drive

        $oldfile = $path . "/database/" . $database . "_old.sql";


        $fname = $path . "/LastBackup.txt";
        $date = $this->ReadF($fname);
        //$date=str_replace(":","-",$date);
        $this->WriteF($path . "/database/" . $database . "_old.txt", $database . "_old.sql  Contains Data Upto " . $date);


        if ($force == 1) {
            if (file_exists($fname))
                unlink($fname);
        }

        $this->WriteF("TEST.txt", " force-" . $force . " date " . $date);


        if ($this->BackUpDue() == true) {

            if (file_exists($orgfile)) {
                copy($orgfile, $oldfile);    //copy preveous backup
                unlink($orgfile);
                $this->AppendF("TEST.txt", " force-" . $force . " date " . $date);
            }

            $path = $path . "/database/backup_my.bat";   ////Batchfile for My SQL backup
            //LOCK ALL TABLE BEFORE BACKUOP
            
         $this->AppendF($Level . "TT.txt", "Entered in Backup");           
            $this->LockBackup();
            $bfile = $Level . "Log/" . date('dmY') . "query.sql";
            if (file_exists($bfile)) {
                copy($bfile, $Level . "Log/Query.txt");
                unlink($bfile);
            }

         $this->AppendF($Level . "TT.txt", $this->MyClientIP()." Locked");

            if ($this->BackupBusy() == false)
            {
                //$this->AppendF($Level . "TT.txt", "Runed backup started".date('H:i:s'));
                $this->RunBatchFile($path);
               // $this->AppendF($Level . "TT.txt", "Runed backup ended".date('H:i:s'));
	$this->AppendF($orgfile,"update userlog set active='N' where active='Y';");
	     }
            
          //$this->Delay(7);
            
            $this->AppendF($Level . "TT.txt", "Delayed-".date('H:i:s'));
            
            $this->UnlockBackup();

            
            $this->AppendF($Level . "TT.txt", "unlocked");
            
            $this->AppendF("TEST.txt", $path);

            //echo $gpath."<br>";
            $this->AppendF("TEST.txt", $gpath);
            foreach (glob($gpath) as $filename) {
                $this->AppendF("TEST.txt", $filename);
                if (substr($filename, -17) != date('dmY') . "query.sql" && substr($filename, -9) != "Query.txt") {
                    if (file_exists($filename))
                        unlink($filename);
                }
            } //foeach glob
            copy($orgfile, $newfile);   //copy to Drive
            $this->AppendF("TEST.txt", $orgfile . " to " . $newfile);
            $this->WriteF($fname, date('d-m-YH:i:s'));
        } //due=true
    }

//end function

    private function Version() {
        $version = "";
        if ($this->mysqli == true)
            $ver = @mysqli_get_server_info($this->con);
        else
            $ver = @mysql_get_server_info();
        $version = str_replace("-log", "", $ver);
        $version = trim($version);
        return($version);
    }

    public function ForceLogout() {
        if (isset($_SESSION['sid']))
            $sid = $_SESSION['sid'];
        else
            $sid = 0;
        $sql = "update userlog set Active='N',Log_time_out='" . date('H:i:s') . "' where Active='Y' and  session_id=" . $sid;
        $this->ExecuteQuery($sql);
    }

    private function CreateBatchFile() {
//$version="5.5.8";
        $version = $this->Version();

        $user = trim(Config::getUser());
        $pass = trim(Config::getPWD());
        $database = trim(Config::getDB());

        if (strlen($pass) > 0)
            $pass = "  -p" . $pass . " ";

        $path = $this->ApplicationFolder() . "/database";
        $dumpfile = $path . "/" . $database . ".sql";

        $path = $path . "/backup_my.bat";


//mysqldump -h localhost -u root -p password   ebill > ElectionDatabase1.sql  2>&1  (2>&1 will echo the Error)

        $command = "mysqldump  --opt  -h localhost -u " . $user . $pass . " " . chr(34) . $database . chr(34) . ">" . chr(34) . $dumpfile . chr(34);


        $drive = substr($path, 0, 2);
        if (preg_match('/WAMP/', strtoupper($path)))
            $binpath = $drive . "/wamp/bin/mysql/mysql" . $version . "/bin";
        else
            $binpath = $drive . "/xampp/mysql/bin";

        if (file_exists($path) == false) {
            $this->WriteF($path, "cd/");    //GO to root
            $this->AppendF($path, $drive);   //C: or D:
            $this->AppendF($path, "cd " . $binpath);   // cd d:\wamp\bin\mysql\mysql5.5.8/bin
            $this->AppendF($path, $command);
        }
    }

    public function CloseConnection() {
        if ($this->mysqli == true)
            mysqli_close($this->con);
    }

    public function AutoCommit($val) {
        if ($val == 0)
            @mysqli_autocommit($this->con, FALSE);
        else
            @mysqli_autocommit($this->con, TRUE);
    }

    public function CommitTransaction() {
        mysqli_commit($this->con);
    }

    public function RollbackTransaction() {
        mysqli_rollback($this->con);
    }

    private function connect($dbname) {
        $dbhost = trim(Config::getDBHost());
        $dbuser = trim(Config::getUser());
        $dbpwd = trim(Config::getPWD());
        $_SESSION['dbuser'] = $dbuser;
        $_SESSION['Database'] = $dbname;

        if ($this->mysqli == false) { //MYSQL VERSION
            $this->ConnectMysql($dbhost, $dbuser, $dbpwd, $dbname);
        }

        if ($this->mysqli == true) { //MYSQLI VERSION
            $this->ConnectMysqlI($dbhost, $dbuser, $dbpwd, $dbname);
        }
    }

//End Connect

    public function ConnectDB($db) { //Unused Function
        $this->connect($db);
    }

    private function ConnectMysql($dbhost, $dbuser, $dbpwd, $dbname) {
        if (strlen(trim($dbpwd)) > 0)
            $this->con = mysql_connect($dbhost, $dbuser, $dbpwd);
        else
            $this->con = mysql_connect($dbhost, $dbuser);
        if (!$this->con)
        {
            die('Could not connect to MySQL: ' . mysqli_error($this->con));
         $a=$this->FolderLevel($Level);
         echo   $this->AlertNRedirect("Error in Connection File", $Level."Login.htm");   
        }
        else{
            mysql_select_db($dbname) or die(mysql_error());
        mysql_query("SET NAMES UTF8");
        }
    }

//ConnectMysql

    private function ConnectMysqlI($dbhost, $dbuser, $dbpwd, $dbname) {
        $this->con = @mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
        if (!$this->con)
        {
           $msg="<div align=center><font color=red face=arial size=2>Connect Failed:" . mysqli_connect_error()."</font></div>";
           echo $msg; 
           die();
            $a=$this->FolderLevel($Level);
            $this->AlertNRedirect($msg, $Level."Login.htm");
        }
        else
        mysqli_query($this->con, "SET NAMES UTF8") ;
//$tf=$this->con;
        //$st=mysqli_prepare($link, $query);
//$mysqli=new mysqli($dbhost, $dbuser, $dbpwd,$dbname);
//$stmt=$mysqli->prepare($mysqli, $query);
        //$stmt->bind_param($stmt, $types, $mysqli, $_);
//$stmt->close($stmt);
    }

    public function ExecuteMultipleQuery($query) {  //separate statement using semicolon ;
        if (mysqli_multi_query($this->con, $query))
            return(true);
        else
            return(false);
    }

    public function Execute($sql)
    {
      $result = mysqli_query($this->con, $sql);
      $this->rowCommitted = mysqli_affected_rows($this->con);   
      return($result);
    }
    
    
    public function ExecuteQuery($sql) {

        //Loop Execute until backup is busy
        $this->WriteF("TT.txt", $this->MyClientIP());
        $a=0;
        while ($this->BackupBusy()) {
            $a++;
            $this->AppendF("TT.txt", $a.".".date('H:i:s'));
        }
        //$this->AppendF("tt", date('H:i:s').$sql);
        $error = "<p align=center><font face=arial size=1 color=black>" . strtoupper($sql);
        if ($this->mysqli == true)
            $result = mysqli_query($this->con, $sql);

        if ($this->mysqli == false)
            $result = mysql_query($sql);

        if ($result) {
            if ($this->mysqli == false)
                $this->rowCommitted = mysql_affected_rows();

            if ($this->mysqli == true)
                $this->rowCommitted = mysqli_affected_rows($this->con);
        } else
            echo $error . "<font color=grey size=2>(" . $this->Error() . ")</font></p>";

        $this->returnSql = $sql;
        if ($this->rowCommitted > 0)
            $this->SaveQueryAsTextFile($sql);
        return($result);
    }

    public function Try2Execute($sql) {

        $this->WriteF("TT.txt", $this->MyClientIP());
        $a=0;
        while ($this->BackupBusy()) {
            $a++;
            $this->AppendF("TT.txt", $a.".".date('H:i:s'));
        }

        if ($this->mysqli == false)
            $result = mysql_query($sql);

        if ($this->mysqli == true)
            $result = mysqli_query($this->con, $sql);

        $this->returnSql = $sql;


        if ($result) {
            if ($this->mysqli == false)
                $this->rowCommitted = mysql_affected_rows();

            if ($this->mysqli == true)
                $this->rowCommitted = mysqli_affected_rows($this->con);
            $this->SaveQueryAsTextFile($sql);
        }


        return($result);
    }

    public function returnBoolean($val) {
        if ($val == 1)
            return(true);
        else
            return(false);
    }

    public function UniConv($val) {
        return($val);
    }

    public function Utf2BinaryHex($str) {
        return($str);
    }

    public function getFieldNames($sqlStr) {

        $sResult = $this->ExecuteQuery($sqlStr);
        $arrValue = array();
        if ($sResult) {
            $numColumns = $this->colFetched;

            if ($this->mysqli == false) {
                $numColumns = mysql_num_fields($sResult);

                if ($numColumns > 0) {
                    for ($i = 0; $i < $numColumns; $i++) {
                        $arrValue[$i] = mysql_field_name($sResult, $i);
                    }
                }
            } //$this->mysqli==false

            if ($this->mysqli == true) {
                $numColumns = mysqli_num_fields($sResult);

                $fields = mysqli_fetch_fields($sResult);
                $i = 0;
                foreach ($fields as $fi => $f) {
                    $arrValue[$i++] = $f->name;
                }
            }//$this->mysqli==true
        }

        return ($arrValue);
    }

//getFieldNames





    public function Error() {
        if ($this->mysqli == false)
            return(mysql_error());
        if ($this->mysqli == true)
            return(mysqli_error($this->con));
    }

    public function filterLimit($sql) {
        return($sql);
    }

    public function FetchRecordUsingIndexValue1($table, $fld1, $fld2, $cond) {
//return in $MyList array
//$fld1 as index and $fld2 as value assigned
//eg $MyList[$fld1]=$fld2 ;
//foreach ($MyList as $Index => $Value)
//{
//echo $Index."=".$Value."<br>";  
//}

        $sql = "select " . $fld1 . "," . $fld2 . " from " . $table . " where " . $cond;
        $tRows = array();
        $result = mysqli_query($this->con, $sql);

        if ($result) {
            $numRow = mysqli_num_rows($result);
            $numField = mysqli_num_fields($result);
            $this->colFetched = $numField;
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                $val1 = $row[0];
                $val2 = $row[1];
                $tRows[$val1] = $val2;
            } //End While
        }//if result
        $this->returnSql = $sql;
        return($tRows);
    }

//FetchRecordUsingIndexValue

    public function FetchRecords($sql) {

        $tRows = array();
        if ($this->mysqli == false)
            $tRows = $this->FetchMysqlRow($sql, 1);

        if ($this->mysqli == true)
            $tRows = $this->FetchMysqlRow($sql, 2);
        return($tRows);
    }

//End Fetchrecord

    public function FetchRecordsWithErrorMessage($sql, &$Error) {
        $tRows = array();
        $i = 0;
        $result = @mysqli_query($this->con, $sql);
        if ($result) {
            $numRow = mysqli_num_rows($result);
            $numField = mysqli_num_fields($result);
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                for ($k = 0; $k < $numField; $k++) {
                    $tRows[$i][$k] = $row[$k];
                }
                $i++;
            }//while
        }//if result
        else
            $Error = "Statement Error";
        mysqli_free_result($result);
        return($tRows);
    }

    private function FetchMysqlRow($sql, $type) {
        $i = 0;
        $error = "<p align=center><font face=arial size=1 color=black>" . strtoupper($sql);

        $tRows = array();
        if ($type == 1)
            $result = @mysql_query($sql);
        if ($type == 2)
            $result = @mysqli_query($this->con, $sql);


        if ($result) {
            if ($type == 1) {
                $numRow = mysql_num_rows($result);
                $numField = mysql_num_fields($result);
            }
            if ($type == 2) {
                $numRow = mysqli_num_rows($result);
                $numField = mysqli_num_fields($result);
            }

            $this->colFetched = $numField;

            while ($row = $this->FetchArray($result, $type)) {
                for ($k = 0; $k < $numField; $k++) {
                    $tRows[$i][$k] = $row[$k];
                }
                $i++;
            } //End While
            
         $this->returnSql = $sql;
        if ($type == 1)
            mysql_free_result($result);
        if ($type == 2)
            mysqli_free_result($result);   
        }//if result
        else
        {
            echo $error . "<font color=grey size=2>(" . $this->Error() . "</font>)</p>";
            die();
        }
        
        return($tRows);
    }

    private function FetchArray($result, $type) {
        if ($type == "1")
            return(mysql_fetch_array($result));
        if ($type == "2")
            return(mysqli_fetch_array($result, MYSQLI_BOTH));
    }

//fetch array

    public function FetchRecordinRange($sql, $start, $tot) {
        $tRows = array();
        if ($this->mysqli == false)
            $tRows = $this->FetchRangeA($sql, $start, $tot);

        if ($this->mysqli == true)
            $tRows = $this->FetchRangeB($sql, $start, $tot);

        return($tRows);
    }

//End Fetchrecord in Range

    private function FetchRangeA($sql, $start, $tot) {
        $error = "<p align=center><font face=arial size=1 color=black>" . strtoupper($sql);

        $tRows = array();
        $i = 0;
        $rcount = 0;
        $ind = -1;

        $result = mysql_query($sql);

        if ($result) {
            $numRow = mysql_num_rows($result);
            $numField = mysql_num_fields($result);

            $this->colFetched = $numField;
//echo "start".$start." tot=".$tot."<br>";
            while ($row = mysql_fetch_array($result)) {
                $ind++;
                if ($ind >= $start && $rcount < $tot) {
                    $rcount++;
                    for ($k = 0; $k < $numField; $k++) {
                        $tRows[$i][$k] = $row[$k];
                    }
//echo $i."-".$rcount."-".$tot."<br>";
                    $i++;
                } //if $i>=$start
            } //End While
        }//if result
        else
            echo $error . "<font color=grey size=2>(" . $this->Error() . "</font>)</p>";
        $this->returnSql = $sql;

        mysql_free_result($result);

        return($tRows);
    }

//End Fetch RangeA

    private function FetchRangeB($sql, $start, $tot) {
        $error = "<p align=center><font face=arial size=1 color=black>" . strtoupper($sql);

        $tRows = array();
        $i = 0;
        $rcount = 0;
        $ind = -1;

        $result = mysqli_query($this->con, $sql);

        if ($result) {

            $numRow = mysqli_num_rows($result);
            $numField = mysqli_num_fields($result);


            $this->colFetched = $numField;
//echo "start".$start." tot=".$tot."<br>";
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                $ind++;
                if ($ind >= $start && $rcount < $tot) {
                    $rcount++;
                    for ($k = 0; $k < $numField; $k++) {
                        $tRows[$i][$k] = $row[$k];
                    }
//echo $i."-".$rcount."-".$tot."<br>";
                    $i++;
                } //if $i>=$start
            } //End While
        }//if result
        else
            echo $error . "<font color=grey size=2>(" . $this->Error() . "</font>)</p>";

        $this->returnSql = $sql;

        mysqli_free_result($result);
        return($tRows);
    }

//End Fetch Range
//END MY SQL DEPENDENT CODE 


    public function ReturnTopQuery($sql, $record) {
        $sql = trim($sql);
        $sql.=" limit " . $record;
        return($sql);
    }

    //fetchColumn
    //GenSelectBox


    public function genCheckBox($id, $val, $bcol, $fcol, $font, $function, $mandatory) {
//$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
        if ($val == true)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;padding: 4px 4px 4px 4px;border-radius: 5px;";
        echo "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        if ($mandatory)
            echo "<font color=red size=3 face=arial><b>*</b></font>";
    }

//genCheckbox

    private function checkList($ind, $ValueList, $numcol) {
        $er = 0;
        for ($i = 0; $i < $numcol; $i++) {
            if (!isset($ValueList[$ind][$i]))
                $er++;
        }
        return($er);
    }

//Tdtext

    
//Tdtext

    public function JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond) {
        $sql = "update " . $DstTable . "," . $SrcTable . " set ";

        for ($i = 0; $i < count($SrcFld); $i++) {
            if ($i > 0)
                $sql.=",";
            $sql.=$DstTable . "." . $DstField[$i] . "=" . $SrcTable . "." . $SrcFld[$i];
        }
        $sql.=" where " . $cond;
        return($sql);
    }

//Join Update
    //INFORMATION SCHEMA RELATED METHOD  
    public function getFirstTable() {

        $sql = "SELECT table_name FROM information_schema.tables where table_schema='" . $this->getTable_schema() . "' and table_type='BASE TABLE' order by table_name ";
        $row = $this->FetchRecords($sql);
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
        $sql = "SELECT table_name FROM information_schema.tables where table_schema='" . $this->getTable_schema() . "' and table_type='BASE TABLE' order by table_name ";
        $row = $this->FetchRecords($sql);
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
        $sql = "select column_name,ordinal_position,column_default,is_nullable,data_type,character_maximum_length,numeric_precision,character_set_name,column_comment,numeric_scale from information_schema.columns where table_schema='" . $this->getTable_schema() . "' and table_name='" . $Table . "' order by Ordinal_position";

        $this->returnSql = $sql;
        $i = 0;

        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $tRows[$i]['Column_name'] = $row[$i][0];
            $tRows[$i]['Ordinal_position'] = $row[$i][1];
            ;
            $def = $row[$i][2];
            ;
            $def = str_replace("'", "", $def);
            $tRows[$i]['Column_default'] = $def;

            $tRows[$i]['Is_nullable'] = $row[$i][3];
            $tRows[$i]['Data_type'] = $row[$i][4];
            $tRows[$i]['Character_maximum_length'] = $row[$i][5];
            if ($this->isPrimaryKey($Table, $row[$i][0]))
                $tRows[$i]['Primary'] = "Y";
            else
                $tRows[$i]['Primary'] = "N";
            $tRows[$i]['Numeric_precision'] = $row[$i][6];
            $tRows[$i]['Character_set_name'] = $row[$i][7];
            $tRows[$i]['Column_comment'] = $row[$i][8];
            $tRows[$i]['Numeric_scale'] = $row[$i][9];
        } //End While
        return($tRows);
    }

//End column lis

    public function LoadColumnDetail($Table) {
        $row = array();
        $col = $this->ColumnCount($Table);

        //echo $Table." Total field-".$col;

        $COLUMN_NAME = array();
        if (isset($_SESSION['COLUMN_NAME']))
            $COLUMN_NAME = $_SESSION['COLUMN_NAME'];

        $DATA_TYPE = array();
        if (isset($_SESSION['DATA_TYPE']))
            $DATA_TYPE = $_SESSION['DATA_TYPE'];

        $IS_NULL = array();
        if (isset($_SESSION['IS_NULL']))
            $IS_NULL = $_SESSION['IS_NULL'];

        $P_KEY = array();
        if (isset($_SESSION['P_KEY']))
            $P_KEY = $_SESSION['P_KEY'];

        $DEF_VAL = array();
        if (isset($_SESSION['DEF_VAL']))
            $DEF_VAL = $_SESSION['DEF_VAL'];

        $MAX_LENGTH = array();
        if (isset($_SESSION['MAX_LENGTH']))
            $MAX_LENGTH = $_SESSION['MAX_LENGTH'];

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
    public function TotalRecords($Table) {
        $tab = $this->getTable_schema() . "." . $Table;
        $val = $this->FetchColumn($tab, "count(*)", "1=1", 0);
        return($val);
    }

    public function ColumnCount($Table) {
        $tRows = array();
        $r = 0;
        $sql = "select column_name  from information_schema.columns where Table_schema='" . $this->getTable_schema() . "' and Table_name='" . $Table . "'";
        $row = $this->FetchRecords($sql);

        $r = count($row);

        return($r);
    }

//End EditRecord

    public function isPrimaryKey($table, $col) {
        $cond = "Table_schema='" . $this->getTable_schema() . "' and Table_name='" . $table . "' and Column_name='" . $col . "'";
        $val = $this->FetchColumn("information_schema.columns", "Column_key", $cond, "x");
        if ($val == "PRI")
            return(true);
        else
            return(false);
    }

//isPrimaryKey

    public function DataType($table, $col) {
        $cond = "Table_schema='" . $this->getTable_schema() . "' and Table_name='" . $table . "' and Column_name='" . $col . "'";
        $type = $this->FetchColumn("information_schema.columns", "data_type", $cond, "");
        return($type);
    }

//End EditRecord

    public function isNull($table, $col) {
        $cond = "Table_schema='" . $this->getTable_schema() . "' and Table_name='" . $table . "' and Column_name='" . $col . "'";
        $type = $this->FetchColumn("information_schema.columns", "is_nullable ", $cond, "");
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
        $sql = "select column_name from information_schema.columns where column_key='PRI' and table_schema='" . $this->getTable_schema() . "' and table_name='" . $table . "' order by ordinal_position";
        $mrow = array();
        $i = 0;
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = $row[$i][0];
        }//for loop
        return($mrow);
    }

//KeyList



    public function refTable($table, $column) {

        $cond = " TABLE_SCHEMA = '" . $this->getTable_schema() . "' AND TABLE_NAME = '" . $table . "' and Column_name='" . $column . "'";

        $reftable = $this->FetchColumn("information_schema.key_column_usage", "REFERENCED_TABLE_NAME", $cond, "");
        return($reftable);
    }

    public function getRefTable($table, $constraint) {
        $cond = "  CONSTRAINT_SCHEMA = '" . $this->getTable_schema() . "' and TABLE_NAME ='" . $table . "' and CONSTRAINT_NAME='" . $constraint . "'";
        $tbl = $this->FetchColumn("REFERENTIAL_CONSTRAINTS", "REFERENCED_TABLE_NAME", $cond, "");
        return($tbl);
    }

    public function refColumn($table, $column) {
        $cond = " TABLE_SCHEMA = '" . $this->getTable_schema() . "' AND TABLE_NAME = '" . $table . "' and Column_name='" . $column . "'";

        $refcol = $this->FetchColumn("information_schema.key_column_usage", "REFERENCED_COLUMN_NAME", $cond, "");

        return($refcol);
    }

    public function ColumnNames($Table) {
        $tRows = array();
        $sql = "select column_name from information_schema.columns where table_schema='" . $this->getTable_schema() . "' and table_name='" . $Table . "' order by Ordinal_position";
        $row = $this->FetchRecords($sql);
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

    public function getConstarintList($table, $type) {
//$type= PRIMARY , UNIQUE or FOREIGN    
        $sql = "SELECT CONSTRAINT_NAME FROM TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = '" . $this->getTable_schema() . "' and TABLE_NAME ='" . $table . "' and CONSTRAINT_TYPE like '%" . $type . "%'";
        $i = 0;
        $row = $this->FetchRecords($sql);
        $mrow = array();
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = $row[$i][0];
        }
        return($mrow);
    }

    public function getConstarintColumnList($table, $Constraint) {
        $sql = "SELECT COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '" . $this->getTable_schema() . "' and TABLE_NAME ='" . $table . "' and CONSTRAINT_NAME='" . $Constraint . "' ORDER BY ORDINAL_POSITION";
        $i = 0;

        $row = $this->FetchRecords($sql);
        $mrow = array();
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = strtolower($row[$i][0]);
        }

        return($mrow);
    }

//getConstar

    public function getConstarintName($table) {
        $sql = "SELECT CONSTRAINT_NAME ,REFERENCED_TABLE_NAME FROM REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = '" . $this->getTable_schema() . "' and TABLE_NAME ='" . $table . "'";
        $i = 0;

        $row = $this->FetchRecords($sql);
        $mrow = array();
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = strtolower($row[$i][0]);
        }
        return($mrow);
    }

//end funtion

    public function getRefColumnList($table, $constraint) {
        $tRows = array();
        $this->pkList = "(";
        $this->fkList = "(";
        $sql = "SELECT COLUMN_NAME,REFERENCED_COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE CONSTRAINT_NAME = '" . $constraint . "' and TABLE_SCHEMA = '" . $this->getTable_schema() . "' and TABLE_NAME = '" . $table . "' order by ordinal_position";
        $i = 0;
//$result=mysql_query($sql);
//while ($row=mysql_fetch_array($result))
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            if ($i > 0) {
                $this->pkList = $this->pkList . ",";
                $this->fkList = $this->fkList . ",";
            }
            $tRows[$i]['Column_name'] = strtolower($row[$i][0]);
            $tRows[$i]['RefColumn_name'] = strtolower($row[$i][1]);
            $this->pkList = $this->pkList . strtolower($row[$i][0]);
            $this->fkList = $this->fkList . strtolower($row[$i][1]);
        } //End While
        $this->pkList = $this->pkList . ")";
        $this->fkList = $this->fkList . ")";
        return($tRows);
    }

//End EditRecord
}

//End Class

