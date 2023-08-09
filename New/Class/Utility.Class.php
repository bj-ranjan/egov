<?php
//ELECTION
require_once 'class.preparestmt.php';
class Utility extends PrepareStmt {

    //private $mDays = array();  //Assigned in Common Parameter

    public $Uid = "";
    public $tempstr;

    public function Utility($simple = 1) {    //Keep Parameter as '0' for High Security  and prevention of Bypass
        $roll = -1;
        parent::__construct();
       
    }

//constructor

    public function CriticalAllowed() {
        $ok = false;
        if (isset($_SESSION['uid']))
            $uid = $_SESSION['uid'];
        else
            $uid = "-";

        if (isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "NA";

        $cond = "roll=0 and uid=?";;

        $aip = $this->FetchColumn($this->SchemaDot() . "pwd", "allowed_ip", $cond,$param=array($uid), "A");
//echo $uid." ". $ip."  ".$aip;

        if ($ip == $aip || $ip == "127.0.0.1" || $ip == "::1")
            $ok = true;

        return($ok);
    }

//CriticalAllowed

    public function UserPresent() {
        date_default_timezone_set("Asia/kolkata");
        if (isset($_SESSION['sid']))
            $sid = $_SESSION['sid'];
        else
            $sid = 0;

        if (isset($_SESSION['uid']))
            $uid = $_SESSION['uid'];
        else
            $uid = "-";
        $sql = "update " . $this->SchemaDot() . "userlog set Log_time_out='" . date('H:i:s') . "' where Session_id=? and Uid=?";
        $this->ExecuteQuery($sql,$param=array($sid,$uid));
    }

//User present

    public function SimpleVerifyRoll() {
//Use your Business Logic  to Verify Every page(Use/Password,Ip etc))
        $t = -1;

        if (!isset($_SESSION['pwd']))
            $_SESSION['pwd'] = "-";

        $rec = $this->FetchRecords("select pwd,roll from " . $this->SchemaDot() . "pwd where uid=?",$param=array($this->CurrentUid()));
        if (count($rec) > 0) {
            $pwd = $rec[0][0];
            $roll = $rec[0][1];
        }

        $sessionpwd =isset($_SESSION['pwd'])?$_SESSION['pwd']:'';
        
        if (count($rec) > 0 && $this->SessionActive() && $this->AllFrameExist()) {
            $objPass=new Password();
            if($objPass->ValidPassword($sessionpwd, $pwd))
            $t = $roll;
            //$this->WriteF("pwdtest.txt", $sessionpwd."  ".$pwd);
        }
        $this->tempstr = $this->returnSql;
        return($t);
    }

    public function VerifyRoll() {
//Use your Business Logic  to Verify Every page(Use/Password,Ip etc))
        $t = -1;

        if (!isset($_SESSION['pwd']))
            $_SESSION['pwd'] = "-";
        $rec = $this->FetchRecords("select pwd,roll from  " . $this->SchemaDot() . "pwd where uid=?",$param=array($this->CurrentUid()));
        if (count($rec) > 0) {
            $pwd = $rec[0][0];
            $roll = $rec[0][1];
        }

        $sessionpwd =isset($_SESSION['pwd'])?$_SESSION['pwd']:'';
        if (count($rec) > 0 && $this->SessionActive() && $this->AllFrameExist()) {
            
            $objPass=new Password();
            if($objPass->ValidPassword($sessionpwd, $pwd))
            $t = $roll;
            //$this->WriteF("pwdtest.txt", $t ." ".$sessionpwd."   =   ".$pwd);
            $this->UserPresent();
        }

        $this->tempstr = $this->returnSql;
        return($t);
    }

    private function CheckRole() {
//Use your Business Logic  to Verify Every page(Use/Password,Ip etc))
        if (isset($_SESSION['roll']))
            $t = $_SESSION['roll'];
        else
            $t = -1;
        if (isset($_SESSION['uid']))
            $uid = $_SESSION['uid'];
        else
            $uid = "-";

        if ($this->AllFrameExist() && $this->SessionActive())
            $role = $t;
        else
            $role = -1;

        return($role);
    }

    private function verifyDetail() {
        $roll = $this->CheckRole();
        $msg = chr(69) . "rror  " . chr(70) . "ound";
        $page = "login.htm";
        $k = $this->FolderLevel($level);
        $page = $level . $page;
        //$msg.=" ".$page;
        if ($roll == -1)
            $this->OpenWindow($msg, $page, 2);
        return($roll);
    }

    //END DATABASE RELATED METHOD    

    public function isdate($mdate) {
        $t = true;
        $dtarray = explode("/", $mdate);
        if (count($dtarray) == 3) {
            if (substr($dtarray[1], 0, 1) == "0")
                $dtarray[1] = substr($dtarray[1], -1);
            if (($dtarray[2] % 4) == 0)
                $this->mDays[2] = 29;
            if (is_numeric($dtarray[2]) && is_numeric($dtarray[1]) && is_numeric($dtarray[0]))
                $t = true;
            else
                $t = false;
            if (($dtarray[1] < 1) || ($dtarray[1] > 12))
                $t = false;
            if (($dtarray[0] < 1) || ($dtarray[0] > 31))
                $t = false;
            if ($dtarray[1] > 0 && $dtarray[1] < 13) {
                if ($dtarray[0] > $this->mDays[$dtarray[1]])
                    $t = false;
            }
        } else
            $t = false;
        return($t);
    }

    private function mysqldate($mydate) {
        $row = array();

        $row = explode("/", $mydate);

        if (isset($row[2]))
            $yy1 = $row[2];
        else
            $yy1 = 0;

        if (isset($row[1]))
            $mm1 = round($row[1]);
        else
            $mm1 = 0;

        if (isset($row[0]))
            $dd1 = round($row[0]);
        else
            $dd1 = 0;

        if ($mm1 < 10)
            $mm1 = substr((100 + $mm1), -2);

        if ($dd1 < 10)
            $dd1 = substr((100 + $dd1), -2);

        if (strlen($yy1) < 4)
            $yy1+=2000;

        if ($this->BackEndCode == 2)
            $tag = "/";
        else
            $tag = "-";

        if ($yy1 > 0 && $mm1 > 0 && $dd1 > 0)
            $dt = $yy1 . $tag . $mm1 . $tag . $dd1;
        else
            $dt = "";
        return($dt);
    }

    public function to_mysqldate($mydate) {
        return($this->mysqldate($mydate));
    }

    public function Month($i, $short = 0) {
        $tt = "";
        switch ($i) {
            case 1:$tt = "January";
                break;
            case 2:$tt = "February";
                break;
            case 3:$tt = "March";
                break;
            case 4:$tt = "April";
                break;
            case 5:$tt = "May";
                break;
            case 6:$tt = "June";
                break;
            case 7:$tt = "July";
                break;
            case 8:$tt = "August";
                break;
            case 9:$tt = "September";
                break;
            case 10:$tt = "October";
                break;
            case 11:$tt = "November";
                break;
            case 12:$tt = "December";
                break;
        }
        if ($short > 0)
            $tt = substr($tt, 0, 3);
        return($tt);
    }

    public function isUnicodeCharExist($mystring) {
        $t = false;
        if (strlen($mystring) != strlen(utf8_decode($mystring)))
            $t = true;
        else
            $t = false;
        return($t);
    }

    function inStr($str, $find) {
        $temp = strlen($find);
        $mindex = 0;
        $found = -1;
        $lnth = strlen($str) - $temp;
        while (($mindex <= $lnth) && ($found == -1)) {
            if (substr($str, $mindex, $temp) == $find) {
                $found = $mindex;
            }
            $mindex++;
        } //end while
        return($found);
    }

//end function

     public function isUnicode($mystring) {
        $t = false;
        $token = array();
        $j = 0;
        $start = 0;
        
        //echo $mystring;
        
        if($this->AllowDashDotForUnicode ){
        $mystring=str_replace("-","",$mystring);
        $mystring=str_replace(".","",$mystring);
        $mystring=str_replace(",","",$mystring);
        $mystring=str_replace("(","",$mystring);
        $mystring=str_replace(")","",$mystring);
        $mystring=str_replace("/","",$mystring);
        }
        $mystring = trim($mystring);
        $mystring=str_replace(' ','',$mystring);
        
        $L1=strlen($mystring);
        $L2=strlen(utf8_decode($mystring));
           
        //echo $mystring.'   '.$L1.' '.$L2;
                     
                if ($L1==3*$L2)
                {
                    $t = true;
                   // echo 'true';
                }
        return($t);
    }

//Java Focus Functionafter postback

    public function focus($a) {
       echo  "<Script language=javascript>\n";
        echo "document.getElementById('" . htmlentities($a) . "').focus();//set Focus on Rsl\n";
        echo "</script>";
         }

    public function assign($a, $b) {
       
    }

    public function SelectedIndex($a, $b) {
    
    }

    public function statusbar($a) {
        
    }

    public function validate($str, $length) {
        $found = true;

        if (strlen($str) > $length)
            $found = false;

        if (preg_match("/'/", $str))
            $found = false;

        if (preg_match("/--/", $str))
            $found = false;

        if (preg_match("/</", $str))
            $found = false;

        if (preg_match("/>/", $str))
            $found = false;

        if (preg_match("/;/", $str))
            $found = false;


        $str = strtoupper($str);
        $threat = array(0, 0, 0);
        $A = 0;
        $B = 0;
        $culpritarray = array("DROP", "ALTER");
        $row = explode(" ", $str);
        for ($i = 0; $i < count($row); $i++) {
            if (in_array($row[$i], $culpritarray))
                $found = false;
            if ($row[$i] === "SELECT" && $A == 0)
                $threat[0] = 1;
            if ($row[$i] === "INSERT" && $B == 0)
                $threat[1] = 1;
            if ($row[$i] === "DELETE" && $A == 0)
                $threat[2] = 1;

            if ($row[$i] === "FROM") {
                if ($threat[0] === 1)
                    $threat[0] = $threat[0] + 1;
                if ($threat[2] === 1)
                    $threat[2] = $threat[2] + 1;
                $A++;
            }
            if ($row[$i] === "INTO") {
                if ($threat[1] === 1)
                    $threat[1] = $threat[1] + 1;
                $B++;
            }
        }//FOR
        if ($threat[0] === 2 || $threat[1] === 2 || $threat[2] === 2)
            $found = false;

        return($found);
    }

    public function SimpleValidate($str, $length) {
        $found = true;

        if (strlen($str) > $length)
            $found = false;

        if (preg_match("/'/", $str))
            $found = false;

        if (preg_match("/--/", $str))
            $found = false;

        if (preg_match("/;/", $str))
            $found = false;

        if (preg_match("/</", $str))
            $found = false;


        if (preg_match("/>/", $str))
            $found = false;


        return($found);
    }

    public function saveSqlLog($tbl, $line) {
       
    }

    public function saveTextLog($tbl, $line) {
       
    }

    public function dateDiff($d1, $d2) {
        $flag = "";

        // echo $flag." ".$d1." - ". $d2."<br>";

        if ($d1 < $d2) {
            $flag = "-";
            $t = $d1;
            $d1 = $d2;
            $d2 = $t;
        }

        //echo $flag." ".$d1." - ". $d2."<br>";

        $date1 = str_replace("/", "-", $d1);
        $date2 = str_replace("/", "-", $d2);



        $date1 = $date1 . "- ";
        $date2 = $date2 . "- ";
        $row = explode("-", $date1);
        if (isset($row[0]))
            $yy1 = $row[0];
        else
            $yy1 = 0;

        if (isset($row[1]))
            $mm1 = round($row[1]);
        else
            $mm1 = 0;

        if (isset($row[2]))
            $dd1 = round($row[2]);
        else
            $dd1 = 0;
//echo $yy1.$mm1.$dd1."<br>";

        $row = explode("-", $date2);
        if (isset($row[0]))
            $yy2 = $row[0];
        else
            $yy2 = 0;
        if (isset($row[1]))
            $mm2 = round($row[1]);
        else
            $mm2 = 0;
        if (isset($row[2]))
            $dd2 = round($row[2]);
        else
            $dd2 = 0;
//echo $yy2.$mm2.$dd2."<br>";

        if ($yy2 % 4 == 0) //Leap Year
            $this->mDays[2] = 29;

        if ($dd1 < $dd2) {
            $mtag = round($mm2);
            $dd1 = $dd1 + $this->mDays[$mtag];
            $mm1 = $mm1 - 1;
        }

        if ($mm1 < $mm2) {
            $mm1 = $mm1 + 12;
            $yy1 = $yy1 - 1;
        }

        $tmp = ($dd1 - $dd2) + 30 * ($mm1 - $mm2) + 365 * ($yy1 - $yy2);
        return($flag . $tmp);
    }

    public function datePlusMinus($date1, $offset) {

        if ($offset < 0)
            $date = $this->dateMinus($date1, -$offset);
        else
            $date = $this->datePlus($date1, $offset);

        return($date);
    }

    public function datePlus($date1, $offset) {

        if (preg_match('/-/', $date1))
            $mtag = "-";
        else
            $mtag = "/";

        $date1 = $date1 . $mtag;
        $date = "";

        if ($offset < 0)
            $offset = 0;

        $row = explode($mtag, $date1);

        if (isset($row[0]))
            $yy1 = $row[0];
        else
            $yy1 = 0;

        if (isset($row[1]))
            $mm1 = round($row[1]);
        else
            $mm1 = 0;

        if (isset($row[2]))
            $dd1 = round($row[2]);
        else
            $dd1 = 0;


        if ($yy1 % 4 == 0) //Leap Year
            $this->mDays[2] = 29;

        $dd1 = $dd1 + $offset;

        if ($dd1 <= $this->mDays[$mm1] && $dd1 > 0) {
            $Y = $yy1;
            $M = $mm1;
            $D = $dd1;
            //$date = $yy1 . "-" . $mm1 . "-" . $dd1;
        } else {
            while ($dd1 > $this->mDays[$mm1]) {
                $dd1 = $dd1 - $this->mDays[$mm1];
                $mm1 = $mm1 + 1;
                if ($mm1 > 12) {
                    $mm1 = 1;
                    $yy1 = $yy1 + 1;
                }
            }
            $Y = $yy1;
            $M = $mm1;
            $D = $dd1;
        }
        $M = substr(($M + 100), -2);
        $D = substr(($D + 100), -2);
        $date = $Y . $mtag . $M . $mtag . $D;
        return($date);
    }

    public function dateMinus($date1, $offset) {

        if (preg_match('/-/', $date1))
            $mtag = "-";
        else
            $mtag = "/";
        $date1 = $date1 . $mtag;
        $date = "";

        if ($offset < 0)
            $offset = 0 - $offset;

        $row = explode($mtag, $date1);

        if (isset($row[0]))
            $yy1 = $row[0];
        else
            $yy1 = 0;

        if (isset($row[1]))
            $mm1 = round($row[1]);
        else
            $mm1 = 0;

        if (isset($row[2]))
            $dd1 = round($row[2]);
        else
            $dd1 = 0;


        if ($yy1 % 4 == 0) //Leap Year
            $this->mDays[2] = 29;

//echo "dd1offset".($dd1-$offset)."<br>";

        $dd = 1;
        if ($dd1 - $offset > 0) {
            //$date = $yy1 . "-" . $mm1 . "-" . ($dd1 - $offset);    //
            $Y = $yy1;
            $M = $mm1;
            $D = $dd1 - $offset;
        }
        if ($dd1 - $offset <= 0) {
            $mm1 = $mm1 - 1;
            if ($mm1 == 0) {
                $mm1 = 12;
                $yy1 = $yy1 - 1;
            }
            $dd1 = $this->mDays[$mm1] - ($offset - $dd1);

            if ($dd1 <= $this->mDays[$mm1] && $dd1 > 0) {
                //$date = $yy1 . "-" . $mm1 . "-" . $dd1;
                $Y = $yy1;
                $M = $mm1;
                $D = $dd1;
            } else
                $dd = $dd1;
        } //$dd1-$offset


        if ($dd <= 0) {
            $i = 0;
            while ($dd <= 0) {
                $i++;
                $mm1 = $mm1 - 1;
                if ($mm1 == 0) {
                    $yy1 = $yy1 - 1;
                    $mm1 = 12;
                }
                $dd = $dd + $this->mDays[$mm1];
            }//while
            //$date = $yy1 . "-" . $mm1 . "-" . $dd;
            $Y = $yy1;
            $M = $mm1;
            $D = $dd;
        } //if $dd1<0
        //Append 0
        $M = substr(($M + 100), -2);
        $D = substr(($D + 100), -2);
        $date = $Y . $mtag . $M . $mtag . $D;
        return($date);
    }

    function RemoveExtraSpace($str) {
        $newstr = "";
        $prev = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $k = ord(substr($str, $i, 1));
            if ($k == 32 && $prev == 0) {
                $newstr = $newstr;
            } else {
                $newstr = $newstr . substr($str, $i, 1);
            }
            if ($k == 32)
                $prev = 0;
            else
                $prev = 1;
        }
        return($newstr);
    }

//trimBlank

    function RemoveAllSpace($str) {
        $newstr = "";
        $prev = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $k = ord(substr($str, $i, 1));
            if ($k == 32) {
                $newstr = $newstr;
            } else {
                $newstr = $newstr . substr($str, $i, 1);
            }
        }//for
        return($newstr);
    }

//trimBlank
//end ExecuteAccess
//Close Access

    public function ReportMe() {
        $to = "deka.jk@nic.in";
        $subject = "Software News";

        if (isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "NA";
        $Log_time_in = date('d/m/Y H:i:s ');

        if (isset($_SESSION['uid']))
            $uid = $_SESSION['sid'];
        else
            $uid = 0;
        $objL = new Lac();
        $stat = $objL->CommongroupStatus();
        $message = $uid . " Login from IP " . $ip . " on " . $Log_time_in;
        $message = $message . " Common Group Status " . $stat;
        $headers = "nalbari@nic.in";

        $res = mail($to, $subject, $message);
        return($res);
    }

//Reportme

    public function MyIP() {
       
    }

//MYIP
    public function CreateLogFile($tbl, $line, $level, $type) {
        
    }

    public function CreateLogFile1($tbl, $line, $level, $type) {
        $dt = date('Ymd');  //default is Year Nonth Date

        if ($type == "Y")
            $dt = date('Y');

        if ($type == "M")
            $dt = date('Ym');

        if ($level == 0)
            $dd = $dt . $tbl;

        if ($level == 1)
            $dd = "./log/" . $dt . $tbl;
        if ($level > 1) {
            $path = "";
            for ($i = 2; $i <= $level; $i++)
                $path = $path . "../";
            $dd = $path . "log/" . $dt . $tbl;
        }//$level>1


        $fname = $dd . ".sql";
        $ts = fopen($fname, 'a') or die("can't open file");
        $line = $line . ";\n";
        fwrite($ts, $line);
//fclose($fname);
    }

    public function genMonthSelectBox($id, $val, $pix) {
        $mystyle = "font-family: Arial;background-color:white;color:black;font-size: 14px;width:" . $pix . "px";
        echo "<Select name=" . $id . "  id=" . $id . " style=" . chr(34) . $mystyle . chr(34) . ">";
        echo "<br>";
        echo "<option  value=0>Select Month";
        echo "<br>";
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $val)
                echo "<option selected value=" . $i . ">" . $this->Month($i);
            else
                echo "<option  value=" . $i . ">" . $this->Month($i);
            echo "<br>";
        } //for Loop
        echo "</Select>";
    }

//GenMonthSelect

    public function ValidateNumber(&$Fld, $AllowNull, &$Err) {
        $Tag = 0;
        $Fld = trim($Fld);
        //echo   '<br>Field value under validatenumver -'.$Fld.' ';           
        //$Fld=filter_var($Fld, FILTER_SANITIZE_NUMBER_INT);

        if ($AllowNull == true) {
            if (is_numeric($Fld) == false && strlen($Fld) > 0)
                $Tag++;
            // echo 'field value '.$Fld;
            // if (is_numeric($Fld) == false)
            // echo 'not numeric';
            //if( strlen($Fld) > 0)
            //  echo 'strlen '.strlen($Fld);
        }

        if ($AllowNull == false) {
            if (is_numeric($Fld) == false)
                $Tag++;
            //echo 'Second '.$Tag;
        }
        if ($AllowNull == true && strlen($Fld) == 0)
            $Fld = "NULL";

        // echo ' converted as '.$Fld.'<br>';
        // echo 'result '.$Tag.'<br>';
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

//validateNumber

    public function ValidateText(&$Fld, $Unicode, $StrongValid, $Length, $AllowNull, &$Err) {
        $Tag = 0;

        $temp = trim($Fld);
        //echo '<br>'.$temp;
        $temp = str_replace("<br>", "[br]", $temp);
        $temp = str_replace("<BR>", "[br]", $temp);
        //echo $temp.'   ';

        $temp = $this->Sanitize_Special($temp);



        if ($StrongValid === true) {
            if ($this->validate($temp, $Length) == false) {
                $Err = " Validation Fails ";
                $Tag++;
            }
        }//$StrongValid==true
        //else
        if ($StrongValid === false) {
            if ($this->SimpleValidate($temp, $Length) == false) {
                $Err = " Validation Fails ";
                $Tag++;
            }
        }//$StrongValid==false


        if ($Unicode == false && $this->isUnicodeCharExist($Fld) == true) {
            $Err = " Unicode Character Exist";
            $Tag++;
        }

        if ($Unicode == true && $this->isUnicode($Fld) == false) {
            $Err = " Non Unicode Exist";
            $Tag++;
        }

        if ($AllowNull == false && strlen($Fld) == 0) {
            $Err = " Null Value Found";
            $Tag++;
        }

        if ($AllowNull == true && strlen($Fld) == 0) {
            $Fld = "NULL";
        } else
            $Fld = str_replace("[br]", "<br>", $temp);

        // echo "Last ".$Fld."<br>";;
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

//validateText

    public function ValidateDate(&$Fld, $AllowNull, &$Err) {
        $Tag = 0;
        $Fld = trim($Fld);
        if ($AllowNull == true && strlen($Fld) == 0)
            $Fld = "NULL";
        else {
            if ($this->isdate($Fld) == false) {
                $Err = " Invalid Date";
                $Tag++;
            }
        }
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

    public function saveErrorLog() {
       
    }

    public function AddMonthOffset($opdate, $term, $offset) {

        $yyyy = round(substr($opdate, 0, 4));
        $mm = round(substr($opdate, 5, 2));
        $dd = substr($opdate, 8, 2);

        while ($term > 11) {
            $yyyy++;
            $term-=12;
        }

        $mm+=$term;

        if ($mm > 12) {
            $yyyy++;
            $mm-=12;
        }

        $dd+=$offset;

        if ($dd > $this->mDays[$mm]) {
            $dd-=$this->mDays[$mm];
            $mm++;
            if ($mm > 12) {
                $yyyy++;
                $mm = 1;
            }
        }//$dd>$this->m

        $dd+=100;
        $mm+=100;

        $dd = substr($dd, -2);
        $mm = substr($mm, -2);
        $mdate = $yyyy . "-" . $mm . "-" . $dd;
        return($mdate);
    }

//AddMonth Offset

    public function datePlusMinusWithoutDash($date1, $offset) {
        if ($offset < 0)
            $date = $this->dateMinus($date1, $offset);
        else
            $date = $this->datePlus($date1, $offset);

        if (preg_match('/-/', $date))
            $mtag = "-";
        else
            $mtag = "/";

        $row = explode($mtag, $date);

        $yy = $row[0];
        $mm = $row[1];
        $dd = $row[2];

        if ($mm < 10)
            $mm = substr((100 + $mm), 1, 2);
        if ($dd < 10)
            $dd = substr((100 + $dd), 1, 2);

        $date = $yy . $mm . $dd;
        return($date);
    }

//added on 17th July,2015
    public function ismysqldate($mdate) {
        $t = true;
        $mdate = substr($mdate, 0, 10);

        $dtarray = explode("/", $mdate);
        if (count($dtarray) < 3)
            $dtarray = explode("-", $mdate);

        if (count($dtarray) == 3) {
            if (substr($dtarray[1], 0, 1) == "0")
                $dtarray[1] = substr($dtarray[1], -1);
            if (($dtarray[0] % 4) == 0) //leapyear
                $this->mDays[2] = 29;
            if (is_numeric($dtarray[2]) && is_numeric($dtarray[1]) && is_numeric($dtarray[0]))
                $t = true;
            else
                $t = false;
            if (($dtarray[1] < 1) || ($dtarray[1] > 12))
                $t = false;
            if (($dtarray[2] < 1) || ($dtarray[2] > 31))
                $t = false;
            if ($dtarray[1] > 0 && $dtarray[1] < 13) {
                if (isset($this->mDays[$dtarray[1]]) && $dtarray[2] > $this->mDays[$dtarray[1]])
                    $t = false;
            }
        } else
            $t = false;
        return($t);
    }

    //end ismysqldate()

    public function returnDateType(&$Fld, $AllowNull, &$Err) {
        $Tag = -1;
        //$Fld=str_replace("/","-",$Fld);
        $Err = " Invalid Date";
        if ($AllowNull == true && strlen($Fld) == 0) {
            $Fld = "NULL";
            $Tag = 0;
        } else {
            if ($this->isdate($Fld) == true)
                $Tag = 1;
            if ($this->ismysqldate($Fld) == true)
                $Tag = 2;
        }
        if ($Tag >= 0)
            $Err = "";
        return($Tag);
    }

    //end returnDateType() 


    public function RedirectOnCondition($msg, $pagetrue, $pagefalse) {
        $temp = "";
        $res = "";
        echo  "<Script language=javascript>\n";
        if (strlen($msg) > 0)
          echo  "var name=confirm(" . chr(34) . htmlentities($msg) . chr(34) . ")\n";
        $temp = $temp . "if (name == true)\n";
        if (strlen($pagetrue) > 4)
            echo "document.location.href=" . chr(34) . htmlentities($pagetrue) . chr(34) . ";//redirect to true page\n";
        else
            echo  "var x=1;";
       echo  "else\n";
        if (strlen($pagefalse) > 4)
          echo   "document.location.href=" . chr(34) . htmlentities($pagefalse) . chr(34) . ";//redirect to true page\n";
        else
            echo  "var x=2;";
       echo "</script>";

      }

}

//end class
