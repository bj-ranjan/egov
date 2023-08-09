<?php

//THIS CLASS IS USED TO HOLD COMMON FUNCTION/METHOD RELATING TO PROJECT SPECIFIC

require_once 'class.LinkManager.php';

class BusinessMethod extends LinkManager {

private $Mpdf_Version=6;
public $AllowDashDotForUnicode=0;
    
	
    
    public function FetchColumn($table, $fld, $cond, $default) {
        $val = "";
        $sql = "Select " . $fld . " from " . $table . " where " . $cond;
        $row = $this->FetchRecords($sql);
        if (count($row) > 0)
            $val = $row[0][0];
        else
            $val = $default;
        return($val);
    }

    
public function GenerateCaptcha() {
        $cArr = array(49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 68, 69, 70, 71, 72, 74, 75, 76, 77, 78, 80, 81, 82, 84, 85, 89, 97, 98, 100, 101, 102, 103, 104, 107, 109, 110, 112, 113, 114, 116, 117, 121);

        $a = rand(9, 26); //CAP
        $b = rand(27, 42); //Small
        $c = rand(0, 8); // number

        $e = rand(9, 26); //CAP
        $f = rand(27, 42); //Small

        $captcha = chr($cArr[$a]) . chr($cArr[$b]) . chr($cArr[$c]) . chr($cArr[$e]) . chr($cArr[$f]);

        return($captcha);
    }

    public function UpdateCaptcha() {
        //if (isset($_SESSION['sid']))
           // $sid = $_SESSION['sid'];
        //else
            $sid = $this->CurrentSessionID ();

        $this->ExecuteQuery("update userlog set uid='" . $this->GenerateCaptcha() . "' where Session_id=" . $sid);
    }

//Preveously under userlog class
public function FetchRecordUsingIndexValueBySQL($sql) {
        $temp=array();
        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $code = $row[$i][0];
            $temp[$code] = $row[$i][1];
        }
        return($temp);
    }
       
    public function maxSession_id() {
        $cond = "1=1";
        return($this->Max("userlog", "Session_id", $cond) + 1);
    }

    public function LastSession_id($Uid) { //Preveously under userlog class
        $cond = " Log_date='" . date('Y-m-d') . "' and Uid='" . $Uid . "'";
        return($this->Max("userlog", "Session_id", $cond));
    }

    public function maxAllowedSession($Uid) {
        $cond = "Uid='" . $Uid . "'";
        $maxsession = $this->FetchColumn("pwd", "Allowed_session", $cond, 1);
        return($maxsession);
    }

    public function maxLogin($Uid) {
        $cond = "Uid='" . $Uid . "' and Active='Y' and Log_date='" . date('Y-m-d') . "'";
        $activesession = $this->CountRecords("userlog", $cond);
        return($activesession);
    }

    public function SessionActive() {
        $result = false;
        $sid = $this->CurrentSessionID();
        $cond = "session_id=" . $sid;

        $active = $this->FetchColumn("userlog", "active", $cond, "N");
        if ($active == "Y")
            $result = true;
        else
            $result = false;

        return($result);
    }

//isActive

    public function MakeActive() {
        $uid = $this->CurrentUid();

        $newstr = "delete from userlog where uid='unknown' and Client_ip='" . $this->MyClientIP() . "'";
        $this->Execute($newstr);
        $newstr = "update userlog set Active='Y' where Uid='" . $uid . "' and Session_id=" . $this->LastSession_id($uid);
        if ($this->Execute($newstr))
            $_SESSION['sid'] = $this->LastSession_id($uid);
        $this->returnSql = $newstr;
    }

    public function FrameExist($frameno) {
        $frame = 0;

        switch ($frameno) {
            case 'L': $fld = "left_frame";
                break;
            case 'R': $fld = "right_frame";
                break;
            case 'R': $fld = "middle_frame";
                break;
        }

        $sid = $this->CurrentSessionID();
        $cond = "session_id=" . $sid;
        $frame = $this->FetchColumn("userlog", $fld, $cond, 0);

        if ($frame == 1)
            return(true);
        else
            return(false);
    }

    public function AllFrameExist() {
        $sid = $this->CurrentSessionID();
        $cond = "session_id=" . $sid;
        $result = false;
        $sql = "select Left_frame,Middle_frame,Right_frame from userlog where " . $cond;
        $rec = $this->FetchRecords($sql);
        if (count($rec) > 0) {
            if ($rec[0][0] == "1" && $rec[0][1] == "1" && $rec[0][2] == "1")
                $result = true;
        }
        return($result);
    }

    //END Copied from USER LOG CLASS

    public function FirstLogin($uid) {
        $cond = " Uid='" . $uid . "'";
        $res = $this->FetchColumn("PWD", "First_login", $cond, "X");
        if ($res == "Y")
            return(true);
        else
            return(false);
    }

    
    
    
   public function  getMPDF_Version()
  {
      return($this->Mpdf_Version);
  }

//WRITE BUSINES METHOD BELOW

   
}

//End Class
?>
