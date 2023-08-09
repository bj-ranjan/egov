<?php

include_once 'Class.BusinessMethod.php';

class DBManager extends BusinessMethod {

    
    
    public function CriticalIP() {
        $ok = false;
        if (isset($_SESSION['uid']))
            $uid = $_SESSION['uid'];
        else
            $uid = "-";

        if (isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "NA";

        $cond = "roll=0 and uid='" . $uid . "'";

        $aip = $this->FetchColumn("pwd", "allowed_ip", $cond, "A");


        if ($ip == $aip || $ip == "127.0.0.1")
            $ok = true;

        return($ok);
    }
    
    
    public function Min($Tbl, $Fld, $cond="1=1") {
        $sql = "select min(" . $Fld . ") from " . ($Tbl);
        if (strlen($cond) < 3)
            $cond = true;
        $sql = $sql . " where " . $cond;
        $this->returnSql = $sql;
        $resultRow = $this->FetchRecords($sql);
        if (count($resultRow) > 0) {
            if (strlen($resultRow[0][0]) > 0)
                return($resultRow[0][0]);
            else
                return("0");
        } else
            return("0");
    }

    public function ConnectDatabase($dbname) {
        $this->ConnectDB($dbname);
    }

    public function FetchColumnByComaSeparated($sql) {
        $temp = "";
        $row = $this->FetchSingleColumnRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            if ($i > 0)
                $temp.=",";
            $temp.=$row[$i];
        }
        return($temp);
    }

    public function FetchRecordUsingIndexValue($table, $fld1, $fld2, $cond="1=1") {
        $temp = array();
        if ($fld2 == $fld1)
            $fld2 = $fld1 . " as mvalue";
        $sql = "select " . $fld1 . "," . $fld2 . " from " . $table . " where " . $cond;
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $code = $row[$i][0];
            $temp[$code] = $row[$i][1];
        }
        return($temp);
    }

       
//generate Captcha

      public function Max($Tbl, $Fld, $cond="1=1") {
        $sql = "select max(" . $Fld . ") from " . ($Tbl);
        if (strlen($cond) < 3)
            $cond = true;
        $sql = $sql . " where " . $cond;
        $this->returnSql = $sql;
        $resultRow = $this->FetchRecords($sql);
        if (count($resultRow) > 0) {
            if (strlen($resultRow[0][0]) > 0)
                return($resultRow[0][0]);
            else
                return("0");
        } else
            return("0");
    }

    public function Sum($tbl, $fld, $cond="1=1") {
        if (strlen($cond) < 3)
            $cond = true;
        $sql = "select sum(" . $fld . ") from " . $tbl . " where " . $cond;
        $this->returnSql = $sql;

        $resultRow = $this->FetchRecords($sql);
        if (count($resultRow) > 0) {
            if (strlen($resultRow[0][0]) > 0)
                return($resultRow[0][0]);
            else
                return("0");
        } else
            return(0);
    }

    public function CountRecords($Table, $condition="1=1") {
        $sql = " select count(*) from " . $Table . " where " . $condition;
        $this->returnSql = $sql;
        $resultRow = $this->FetchRecords($sql);
        if (count($resultRow) > 0)
            return($resultRow[0][0]);
        else
            return(0);
    }

    private function genSqlQuery($table, $fldlist, $cond) {
        $sql = "Select ";
        $col = "Col";
        for ($k = 0; $k < count($fldlist); $k++) {
            $mydatatype = "";
            $col.=$k;
            if (isset($this->GlobalDataType[$fldlist[$k]]))
                $mydatatype = $this->GlobalDataType[$fldlist[$k]];
            if ($this->BackEndCode == "2" && $mydatatype == "Date")
                $fldlist[$k] = "convert(varchar," . $fldlist[$k] . ",111)";
            if ($this->BackEndCode == "2" && $mydatatype == "NVARCHAR")
                $fldlist[$k] = "convert(varchar(max),convert(varbinary(max)," . $fldlist[$k] . ")) as " . $col;
            $sql = $sql . $fldlist[$k];
            if ($k < (count($fldlist) - 1))
                $sql = $sql . ",";
        }
        $sql = $sql . " from " . $table;
        if (strlen($cond) > 0)
            $sql = $sql . " where " . $cond;
        $sql = $this->filterLimit($sql);
        $this->returnSql = $sql;
        return($sql);
    }

    public function FetchSingleRecord($table, $fldlist, $cond) {
        $tRows = array();
        $sql = $this->genSqlQuery($table, $fldlist, $cond);
        $this->returnSql = $sql;


        $resultRow = $this->FetchRecords($sql);  //Get Two Diemnsional Data Row
        if (count($resultRow) > 0) {
            for ($k = 0; $k < count($fldlist); $k++) {
                $mydatatype = "";
                if (isset($this->GlobalDataType[$fldlist[$k]]))
                    $mydatatype = $this->GlobalDataType[$fldlist[$k]];
                if ($this->BackEndCode == "2" && $mydatatype == "NVARCHAR")
                    $tRows[$fldlist[$k]] = $this->UniConv($resultRow[0][$k]);
                else
                    $tRows[$fldlist[$k]] = $resultRow[0][$k];
            }
        }//count(result)>0
        return($tRows);
    }

//End FetchSingleRecord


    public function FetchMultipleRecords($table, $fldlist, $cond) {
        $tRows = array();
        $sql = $this->genSqlQuery($table, $fldlist, $cond);
        $this->returnSql = $sql;
        $resultRow = $this->FetchRecords($sql);  //Get Two Diemnsional Data Row

        for ($i = 0; $i < count($resultRow); $i++) {
            for ($k = 0; $k < count($fldlist); $k++) {
                $mydatatype = "";
                if (isset($this->GlobalDataType[$fldlist[$k]]))
                    $mydatatype = $this->GlobalDataType[$fldlist[$k]];
                if ($this->BackEndCode == "2" && $mydatatype == "NVARCHAR")
                    $tRows[$i][$fldlist[$k]] = $this->UniConv($resultRow[$i][$k]);
                else
                    $tRows[$i][$fldlist[$k]] = $resultRow[$i][$k];
            } //for Loop $k
        } //for Loop $i
        return($tRows);
    }

    public function ExecuteBatchData($Table, $FldList, $ValueList, $Packet,$showerror=false) {
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

        $ex = 0;
        $rowcount = 0;
        $Cstr = "";
        $commonValStr = "";
        $recordcount = 0;

        for ($i = 0; $i < count($ValueList); $i++) {
            $valStr = "(";
            $recordcount++;
            for ($j = 0; $j < $numCol; $j++) {
                if (isset($this->Quotation[$j]))
                    $quote = $this->Quotation[$j];
                else
                    $quote = "Y";
                //if ($ValueList[$i][$j] == "1" || $ValueList[$i][$j] == "0")  //Probably Bit Field 
                if ($quote == "Y" && $ValueList[$i][$j] != "NULL")
                    $valStr.="'" . $ValueList[$i][$j] . "'";
                else
                    $valStr.=$ValueList[$i][$j];

                if ($j < ($numCol - 1))
                    $valStr.=",";
                else
                    $valStr.=")";
            }//$j
            if ($rowcount == $Packet) { //packet size reached
                $sql = $MainStr . $commonValStr;
                if($showerror==false)
                $res=$this->Try2Execute ($sql);
                else
                $res=$this->ExecuteQuery ($sql);
                if ($res)
                    $ex+=$this->rowCommitted;
                $rowcount = 0;
                $commonValStr = "";
//echo $sql."<br>";
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
            if($showerror==false)
                $res=$this->Try2Execute ($sql);
                else
                $res=$this->ExecuteQuery ($sql);
                if ($res)
               $ex+=$this->rowCommitted;
        }
        $this->returnSql = $sql;
        return($ex);
    }

//Save Batch Data
    public function genDataGrid($title, $headlist, $align, $sql, $width) {
        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');
        $row = $this->FetchRecords($sql);
        $cnt = count($row);
        $numcol = $this->colFetched;
        if ($cnt > 0) {

            echo "<table align=" . chr(34) . "center" . chr(34) . " class=" . chr(34) . "myTable myTable-rounded" . chr(34) . "  width=" . $width . "%>";
            echo "<thead><tr><td align=center colspan=" . ($numcol + 1) . "><font face=arial color=black size=" . $this->TableTitleFont . ">" . $title . "</td></tr>";
            echo "<tr>";
            echo "<th><font face=arial color=black size=" . $this->TableHeadFont . ">SlNo</th>";
            for ($i = 0; $i < count($headlist); $i++) {
                echo "<th><font face=arial color=black size=" . $this->TableHeadFont . ">" . $headlist[$i] . "</th>";
                //echo "<th>".$headlist[$i]."</th>";
            }
            echo "</tr></Thead>";
//End Header
        }//cnt>0
        for ($ind = 0; $ind < count($row); $ind++) {
            $sl = ($ind + 1);
            if ($ind == 0)
                echo "<tbody>";
            echo "<tr>";
            echo "<td align=center ><font face=arial color=black size=" . $this->TableBodyFont . ">" . $sl . "</td>";

            for ($i = 0; $i < $numcol; $i++) {
                $fld = $row[$ind][$i];
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = $tAlign[$align[$i]];
                    else
                        $malign = "left";
                } else
                    $malign = "left";
                $this->validMySqlDate($fld);
                echo "<td align=" . $malign . " ><font face=arial color=black size=" . $this->TableBodyFont . ">" . $fld . "</td>";
            }
            echo "</tr>";
        }//end Row browse
        echo "</tbody>";
        echo "</table>";
    }

    public function genExcelFileBySql($headlist, $align, $sql, $fname) {
        $dname = $fname . ".xls";
        //$dname = $fname . ".csv";
        $fname = $fname . ".htm";

        $ts = fopen($fname, 'w') or die("can't open file");

        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');
        $row = $this->FetchRecords($sql);
        $cnt = count($row);
        $numcol = $this->colFetched;
        $fc = 1;
        for ($ii = 0; $ii < $numcol; $ii++) {
            if (!isset($headlist[$ii])) {
                $headlist[$ii] = "Field" . $fc;
                $fc++;
            }
        }


        if ($cnt > 0) {
            fwrite($ts, "<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>");
            fwrite($ts, "\n");
            fwrite($ts, "<tr>");
            fwrite($ts, "<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>");
            fwrite($ts, "\n");
            for ($i = 0; $i < $numcol; $i++) {
                fwrite($ts, "<td align=center bgcolor=#CCCC99><font face=arial size=2>" . $headlist[$i] . "</td>");
                fwrite($ts, "\n");
            }
            fwrite($ts, "</tr>");
            fwrite($ts, "\n");
//End Header
        }//cnt>0
        for ($ind = 0; $ind < count($row); $ind++) {
            $sl = ($ind + 1);
            fwrite($ts, "<tr>");
            fwrite($ts, "<td align=center ><font face=arial size=2>" . $sl . "</td>");

            for ($i = 0; $i < $numcol; $i++) {
                $fld = $row[$ind][$i];
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = $tAlign[$align[$i]];
                    else
                        $malign = "left";
                } else
                    $malign = "left";

                $this->validMySqlDate($fld);
                fwrite($ts, "<td align=" . $malign . " ><font face=arial size=2>" . $fld . "</td>");
            }
            fwrite($ts, "</tr>");
        }//end Row browse
        fwrite($ts, "</table>");

//Copy HTM file to excell

        copy($fname, $dname);
    }

//genExcelFileBySql

    public function RestoreData($filename, &$success, &$fail) {
        $fp = fopen($filename, "r") or die("Couldn't open $filename");
        $str = "";
        while (!feof($fp)) {
            $line = fgets($fp, 1024);
            $str = $str . $line;
        }

        $myrow = array();
        $myrow = explode(";", $str);   //Segrigate the String into SQL Statement on Semicolon

        $Length = count($myrow);
        $success = 0;
        $fail = 0;
        for ($i = 0; $i < count($myrow) - 1; $i++) {
            if ($this->Try2Execute($myrow[$i]))
                $success++;
            else
                $fail++;
        }
    }

//End Restore Data

    public function genExcelFileByValueList($headlist, $align, $ValueList, $fname) {
        $dname = $fname . ".xls";
        $fname = $fname . ".htm";

        $ts = fopen($fname, 'w') or die("can't open file");

        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');
        $cnt = count($ValueList);
        $numcol = count($headlist);

        if ($cnt > 0) {
            fwrite($ts, "<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>");
            fwrite($ts, "\n");
            fwrite($ts, "<tr>");
            fwrite($ts, "<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>");
            fwrite($ts, "\n");
            for ($i = 0; $i < count($headlist); $i++) {
                fwrite($ts, "<td align=center bgcolor=#CCCC99><font face=arial size=2>" . $headlist[$i] . "</td>");
                fwrite($ts, "\n");
            }
            fwrite($ts, "</tr>");
            fwrite($ts, "\n");
//End Header
        }//cnt>0
        for ($ind = 0; $ind < count($ValueList); $ind++) {
            $sl = ($ind + 1);
            fwrite($ts, "<tr>");
            fwrite($ts, "<td align=center ><font face=arial size=2>" . $sl . "</td>");

            for ($i = 0; $i < $numcol; $i++) {
                if (isset($ValueList[$ind][$i]))
                    $fld = $ValueList[$ind][$i];
                else
                    $fld = "&nbsp;";

                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = $tAlign[$align[$i]];
                    else
                        $malign = "left";
                } else
                    $malign = "left";

                fwrite($ts, "<td align=" . $malign . " ><font face=arial size=2>" . $fld . "</td>");
            }
            fwrite($ts, "</tr>");
        }//end Row browse
        fwrite($ts, "</table>");

//Copy HTM file to excell
        copy($fname, $dname);
    }

//genExcelFileBySql
//EXTRA UTILITY FUNCTION

    public function RetriveField($sql) {
        $tr = array();
        $sql = strtoupper($sql);
        if ($this->ExecuteQuery($sql)) {
            $totcol = $this->colFetched;
            $ind = $this->inStr($sql, "FROM");
            $tsql = substr($sql, 0, $ind - 1);
            $frow = explode(",", $tsql);
            for ($i = 0; $i < count($frow); $i++) {
                $tr[$i] = $this->processBlank($frow[$i]);
            }//for
        }//if
        return($tr);
    }

    public function genSelectBox($id, $query, $val="", $pix="160", $bcol="white", $fcol="black", $font=12, $function="") {
        $property = array("id" => $id, "val" => $val, "width" => $pix, "function" => $function, "bcol" => $bcol, "fcol" => $fcol, "font" => $font);

        $ValueList = $this->PopulateValueList($query);
        echo $this->newSelectBox($property, $ValueList);
    }

    public function TdSelectBox($align, $bcol, $id, $val, $query, $pix, $function) {
        echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        $this->genSelectBox($id, $query, $val, $pix, $this->bcol, $this->fcol, $this->font, $function);
        echo "</td>";
    }

    public function FetchSingleColumnRecords($sql) {

        $row = $this->FetchRecords($sql);
        $mrow = array();
        for ($i = 0; $i < count($row); $i++) {
            $mrow[$i] = $row[$i][0];
        }

        return($mrow);
    }

//FetchSingleColumnRecords
//NEW METHOD ADDED ON 9-JANUARY,2015
//genInputBox

public function TdCheckBox($align, $bcol, $id, $val, $function) {
        echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        $this->genCheckBox($id, $val, $this->bcol, $this->fcol, $this->font, $function, 0);
        echo "</td>";
    }

    public function returnSelectBox($id, $query, $val, $pix, $function) {
        $property = array("id" => $id, "val" => $val, "width" => $pix, "function" => $function);

        $valuelist = $this->PopulateValueList($query);

        $ret = $this->newSelectBox($property, $valuelist);
        return($ret);
    }

    public function returnSelectBoxByValueList($id, $valuelist, $val, $pix, $function) {
        $property = array("id" => $id, "val" => $val, "width" => $pix, "function" => $function);
        $ret = $this->newSelectBox($property, $valuelist);
        return($ret);
    }

    public function FetchData_IN_JSON_Format($header, $sql) { //This Return Value is basicaly used in ng-repeat in angular JS
        $row = $this->FetchRecords($sql);
        $numcol = $this->colFetched;


        echo "{" . chr(34) . "records" . chr(34) . ":[";

        for ($i = 0; $i < count($row); $i++) {
            if ($i > 0)
                echo ",";
            echo "{";
            for ($j = 0; $j < $numcol; $j++) {
                $data = $row[$i][$j];
                $pat = $this->returnPattern("YMD");
                if (preg_match($pat, $data))
                    $data = $this->to_date($data);
                if (isset($header[$j]))
                    $head = $header[$j];
                else
                    $head = "Field" . ($j + 1);
                if ($j > 0)
                    echo ",";
                echo chr(34) . $head . chr(34) . ":" . chr(34) . $data . chr(34);
            }//inner for j
            echo "}";
        }// outer for i
        echo "]}";
    }

//end JSON Formast

    public function FetchData_IN_JSON_Object($header, $sql) { //This Return Value as Object is to be Parsed using JSON.parse()
        $row = $this->FetchRecords($sql);
        $numcol = $this->colFetched;

        $Found = count($row);

        echo "{";

        for ($i = 0; $i < count($row); $i++) {
            if ($i > 0)
                echo ",";
            echo chr(34) . $i . chr(34) . ":";
            echo "{";
            for ($j = 0; $j < $numcol; $j++) {
                $data = $row[$i][$j];
                $pat = $this->returnPattern("YMD");
                if (preg_match($pat, $data))
                    $data = $this->to_date($data);
                if (isset($header[$j]))
                    $head = $header[$j];
                else
                    $head = "Field" . ($j + 1);
                if ($j > 0)
                    echo ",";
                echo chr(34) . $head . chr(34) . ":" . chr(34) . $data . chr(34);
            }//inner for j
            echo "," . chr(34) . "Found" . chr(34) . ":" . chr(34) . $Found . chr(34);
            //AlertMessage
            echo "," . chr(34) . "AlertMessage" . chr(34) . ":" . chr(34) . $this->Alert_Message_Through_JSON . chr(34);
            echo "}";
        }// outer for i
        echo "}";
        return($Found);
    }

//end JSON Object

    public function PopulateValueList($query) {
        $tr = array();
        $row = $this->FetchRecords($query);
        $col = $this->colFetched;
        for ($i = 0; $i < count($row); $i++) {
            $str = "";
            $tr[$i][0] = $row[$i][0];
            if ($col == 1)
                $tr[$i][1] = $row[$i][0];
            else {
                for ($j = 1; $j < $col; $j++) {
                    $tr[$i][$j] = $row[$i][$j];
                }
            }
        }//for $i
        return($tr);
    }

    public function PopulateValueListAll($query) {
        $tr = array();
        $row = $this->FetchRecords($query);
        $col = $this->colFetched;
        for ($i = 0; $i < count($row); $i++) {

            for ($j = 0; $j < $col; $j++) {
                $tr[$i][$j] = $row[$i][$j];
            }
        }

        return($tr);
    }

    
    
    public function TableBusy($table="X") {
        $a=$this->FolderLevel($Level);
        $busy = false;

        $ip = $this->MyClientIP();
        $slno=$this->FetchColumn("lockque", "slno", "ip='".$ip."' and Table_name='".$table."'", 500);
       //echo  $this->returnSql." ".$slno."<br>";
        
        $rec=$this->FetchColumn("lockque", "slno","Table_name='".$table."' and lock_status='Y' and slno<". $slno,0);
        
     $str= $ip." ".$this->returnSql." ".$rec."<br>";
     //$this->AppendF("TT.txt", $str)  ;
   
        if($rec>0)
        $busy=true;    
        return($busy);
    }

    public function LockTable($table="X") {
        $ip=$this->MyClientIP();
    
        $sql="delete from lockque  where ip='".$ip."' and Table_name='".$table."'";
        $this->Execute($sql);
        $sql="insert into lockque (ip,locktime,lock_status,Table_name) values('".$ip."','".date('H:i:s')."','Y','".$table."')";
         $this->Execute($sql);
        //$this->AppendF("TT.txt", "Locked-".$ip." ".$sql.date('H:i:s'));
      }

    
    public function UnlockTable($a = 0,$table="X") {
            $ip = $this->MyClientIP();
            
            $cond="";
            if($table!="X")
            $cond=" and Table_name='".$table."'";
            
            if($a==1)
            $sql="delete from lockque  where ip='".$ip."'".$cond;
            else
            $sql="update lockque set lock_status='N', unlocktime='".date('H:i:s')."'  where ip='".$ip."' ".$cond;
           
            $this->Execute($sql);
            $this->returnSql=$sql;
             //$this->AppendF("TT.txt", "UnLocked-".$ip." ".$sql.date('H:i:s'));
     }


}

//END CLASS
