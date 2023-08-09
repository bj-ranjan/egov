<?php

//THIS CLASS IS USED TO HOLD COMMON FUNCTION/METHOD RELATING TO PROJECT SPECIFIC

require_once 'class.LinkManager.php';

class BusinessMethod extends LinkManager {

    private $Mpdf_Version = 6;
    public $AllowDashDotForUnicode = 0;
    public $CountCategory = array();  //Counting Category like Supervisor Asst
    public $LacList = array();  //Holds LAC Details
    public $HpcCode = array();  //Holds HPC Detail
    public $HpcList = array();
    public $CategoryList = array();  //Holds Presidng poling etc
    public $ROList = array();        //Holds RO Detail
    private $desc = 0;

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

    public function FetchColumn($table, $fld, $cond, $default) {
        $val = "";
        $table = $this->SchemaDotTable($table);
        $sql = "Select " . $fld . " from " . $table . " where " . $cond;
        $row = $this->FetchRecords($sql);
        if (count($row) > 0)
            $val = $row[0][0];
        else
            $val = $default;
        return($val);
    }

    public function UpdateCaptcha() {
        //if (isset($_SESSION['sid']))
        // $sid = $_SESSION['sid'];
        //else
        $sid = $this->CurrentSessionID();

        $res = $this->ExecuteQuery("update " . $this->SchemaDot() . "userlog set uid='" . $this->GenerateCaptcha() . "' where Session_id=" . $sid);
        if ($res == true)
            return(true);
        else
            return(false);
    }

//Preveously under userlog class


    public function maxSession_id() {
        $cond = "1=1";
        $schema = (strlen($this->Schema()) > 0) ? $this->Schema() . "." : '';

        return($this->Max($this->SchemaDot() . "userlog", "Session_id", $cond) + 1);
    }

    public function LastSession_id($Uid) { //Preveously under userlog class
        $cond = " Log_date='" . date('Y-m-d') . "' and Uid='" . $Uid . "'";
        return($this->Max($this->SchemaDot() . "userlog", "Session_id", $cond));
    }

    public function maxAllowedSession($Uid) {
        $cond = "Uid='" . $Uid . "'";
        $maxsession = $this->FetchColumn($this->SchemaDot() . "pwd", "Allowed_session", $cond, 1);
        return($maxsession);
    }

    public function maxLogin($Uid) {
        $cond = "Uid='" . $Uid . "' and Active='Y' and Log_date='" . date('Y-m-d') . "'";
        $activesession = $this->CountRecords($this->SchemaDot() . "userlog", $cond);
        return($activesession);
    }

    public function SessionActive() {
        $result = false;
        $sid = $this->CurrentSessionID();
        $cond = "session_id=" . $sid;
        //$this->AppendF($this->ApplicationFolder()."/textfile/active.txt" , $cond);

        $active = $this->FetchColumn($this->SchemaDot() . "userlog", "active", $cond, "N");
        if ($active == "Y")
            $result = true;
        else
            $result = false;
//$this->AppendF($this->ApplicationFolder()."/textfile/active.txt" , $active);

        return($result);
    }

//isActive

    public function MakeActive() {
        $uid = $this->CurrentUid();
        $newstr = "delete from " . $this->SchemaDot() . "userlog where uid='unknown' and Client_ip='" . $this->MyClientIP() . "'";
        $this->Execute($newstr);
        $newstr = "update " . $this->SchemaDot() . "userlog set Active='Y' where Uid='" . $uid . "' and Session_id=" . $this->LastSession_id($uid);
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
        $frame = $this->FetchColumn($this->SchemaDot() . "userlog", $fld, $cond, 0);

        if ($frame == 1)
            return(true);
        else
            return(false);
    }

    public function AllFrameExist() {
        $sid = $this->CurrentSessionID();
        $cond = "session_id=" . $sid;
        $result = false;
//$this->alert($this->SchemaDot()." ".$sid);
        $sql = "select Left_frame,Middle_frame,Right_frame from " . $this->SchemaDot() . "userlog where " . $cond;
        $rec = $this->FetchRecords($sql);
        if (count($rec) > 0) {
            if ($rec[0][0] == "1" && $rec[0][1] == "1" && $rec[0][2] == "1")
                $result = true;
        }
        //$this->AppendF($this->ApplicationFolder()."/textfile/active.txt" , $sql);

        return($result);
    }

    //END Copied from USER LOG CLASS

    public function FirstLogin($uid) {
        $cond = " Uid='" . $uid . "'";
        $res = $this->FetchColumn($this->SchemaDot() . "PWD", "First_login", $cond, "X");
        if ($res == "Y")
            return(true);
        else
            return(false);
    }

    //ELECTION RELATED BUSINESS METHOD STARTS


    public function ReAssignArray() {

        $this->CountCategory[0] = " No Category";
        $this->CountCategory[1] = "Counting Supervisor";
        $this->CountCategory[2] = "Counting Assistant";
        $this->CountCategory[3] = "Micro Observer";

        if (isset($_SESSION['CategoryList']))
            $this->CategoryList = $_SESSION['CategoryList'];  //RELOAD SESSION VARIABLE FROMINTER.PHP PAGES

        if (isset($_SESSION['LacList']))
            $this->LacList = $_SESSION['LacList'];

        if (isset($_SESSION['ROList']))
            $this->ROList = $_SESSION['ROList'];

        if (isset($_SESSION['HpcCode']))
            $this->HpcCode = $_SESSION['HpcCode'];

        if (isset($_SESSION['HpcList']))
            $this->HpcList = $_SESSION['HpcList'];

        //echo $this->DeoCode()." ".$this->DeoName()." ".$_SESSION['MyDatabase'];
        if ($this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", 1) > 2) {
            $this->CountCategory[2] = "Counting Assistant(1)";
            $this->CountCategory[3] = "Counting Assistant(2)";
        }
    }

//End Re Assign Array



    public function Randomised($cat) {

        $result = false;
        $this->desc = 0;
        $sql = "select  count(*) from " . $this->SchemaDot() . "poling where selected='Y' and deleted='N' and pollcategory= " . $cat;
        $sel = $this->FetchRecords($sql);
        $totselected = isset($sel[0][0]) ? $sel[0][0] : '0';

        //echo $cat."-".$totselected."<br>";    

        $this->ExecuteQuery("update " . $this->SchemaDot() . "category set selected=" . $totselected . " where Firstrandom='Y' and code=" . $cat);

        if ($cat == 5 || $cat == 10) { //fourth Poling and VVPAT Operator
            $res = $this->FetchColumn("poling_detail", "reserve_percent", "1=1", 0);
            if ($cat == 5)
                $row = $this->FetchRecords("select count(*) from psname where Forthpoling_required=" . $this->BooleanTrue);
            else
                $row = $this->FetchRecords("select count(*) from psname where lac in(select code from lac where Vvpat_used='Y')");

            //echo $this->returnSql;

            $reserve = round(($row[0][0] * $res) / 100);
            if ($reserve == 0)
                $reserve = 1;
            $requirement = $row[0][0] + $reserve;

            //echo $requirement."-".$totselected."<br>";
            if ($totselected >= $requirement)
                $this->ExecuteQuery("update " . $this->SchemaDot() . "category set Firstrandom='Y',selected=" . $totselected . " where  code=" . $cat);
            else
                $this->desc = ($requirement - $totselected);
        }

        $cond = "code=" . $cat;

        $sql = "select  Firstrandom  from " . $this->SchemaDot() . "category where " . $cond;
        $rec = $this->FetchRecords($sql);

        $rand = isset($rec[0][0]) ? $rec[0][0] : 'N';

        if ($rand == "Y" && $totselected > 0)
            $result = true;

        return($result);
    }

//Randomised

    public function FirstLevelCompletedWithoutFourthPolingVVPAT() {

        if ($this->Randomised(1) && $this->Randomised(2) && $this->Randomised(3) && $this->Randomised(4))
            return(true);
        else
            return(false);
    }

    public function FirstLevelCompleted() {

        $stat = 0;
        if ($this->Randomised(1) && $this->Randomised(2) && $this->Randomised(3) && $this->Randomised(4)) {
            $stat++;
            if ($this->ForthPoling(0) == 0) //Forth Poling doesnot Exist in All LAC
                $stat++;
            else {
                // echo "Forth Poling required";
                if ($this->Randomised(5))
                    $stat++;
                else
                // echo "<div align='center'><font color='red' face=arial>!Warning,Fourth Polling is not Selected in First Level,Please do manual selection by editing</font></div>";
                    echo $this->alert("Fourth Polling is not Selected in First Level,Pls do manual selection(Approx. Requirement :" . $this->desc . ")");
            }  //  $this->ForthPoling($Lac)==0
            //check vvpat operator
            if ($this->CountRecords($this->SchemaDot() . "lac", "vvpat_used='Y' and code in(select distinct lac from psname)") > 0) {
                if ($this->Randomised(10))
                    $stat++;
                else
                    echo $this->alert("VVPAT Operator is not Selected in First Level (Approx. Requirement :" . $this->desc . ")");
            } else
                $stat++;
        } //$this->Randomised(1)
        if ($stat == 3)
            return(true);
        else
            return(false);
    }

    public function ForthPoling($Lac) {
        if ($Lac == 0) //For All LAC
            $cond = " forthpoling_required= " . $this->BooleanTrue;
        else
            $cond = " forthpoling_required=" . $this->BooleanTrue . " and Lac=" . $Lac; //For Particular LAC
        return($this->FetchColumn($this->SchemaDot() . "Psname", "count(*)", $cond, "0"));
    }

    public function isPollPerson($id) {
        $cat = $this->FetchColumn($this->SchemaDot() . "poling", "pollcategory", "slno=" . $id, 0);
        if (isset($this->PollCategory[$cat]))
            return(true);
        else
            return(false);
    }

    public function Polling_Duty($cat) {
        if ($cat == 10 || ($cat != 0 && $cat < 6))
            return(true);
        else
            return(false);
    }

    public function EVM_Used() {
        $type = $this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", 1);
        if ($this->FetchColumn($this->SchemaDot() . "electiontype", "evm_used", "code=" . $type, "N") == "Y")
            return(true);
        else
            return(false);
    }

    public function MyConstituency() {
        $val = trim($this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", "1"));
        $const_abvr = $this->FetchColumn($this->SchemaDot() . "electiontype", "abvr", "code=" . $val, "Lac");
        return($const_abvr);
    }

    public function ElectionCode() {
        $val = trim($this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", "1"));
        return($val);
    }

    public function getMPDF_Version() {
        return($this->Mpdf_Version);
    }

    public function ElectionName() {
        $temp = "";
        $yr = substr($this->FetchColumn($this->SchemaDot() . "party_calldate", "polldate", "code=1", date('d/m/Y')), -4);
        $val = trim($this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", "1"));
        $temp = "Parliamenatry Election " . $yr;

        $ename = $this->FetchColumn($this->SchemaDot() . "poling_detail", "election_name", "code=1", "");


        if (strlen($ename) > 2)
            $temp = $ename;


        return($temp);
    }

    public function FinalLock($i) {
        $FldList = array("grpno", "pid");
        $ValueList = array();
        if ($i == 1) { //poling
            $Table = "lock_poling";
            $sql = "select grpno,slno from " . $this->SchemaDot() . "poling where grpno>0  and pollcategory in(1,2,3,4,5,10)";
        }

        if ($i == 2) { //counting
            $Table = $this->SchemaDot() . "lock_counting";
            $sql = "select countgrpno,slno from " . $this->SchemaDot() . "poling where countgrpno>0 and countselected='Y' and countcategory in(1,2,3)";
        }

        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $ValueList[$i][0] = $row[$i][0];
            $ValueList[$i][1] = $row[$i][1];
        }
        $val = $this->ExecuteBatchData($Table, $FldList, $ValueList, 150);

        return($val);
    }

    public function getPsDetail($rcode, $lac) {
        $cond = "Lac=" . $lac . " and RCODE ='" . $rcode . "'";
        $str = "";
        $fldlist = array("PART_NO", "PSNAME", "Address");
        $row = $this->FetchSingleRecord($this->SchemaDot() . "Psname", $fldlist, $cond);
        if (count($row) > 0)
            $str = "PS NO- " . $row['PART_NO'] . "<br>" . $row['PSNAME'];
//$str="PS NO- ".$row['PART_NO']."<br>".$row['PSNAME'].",".$row['Address'];
        else
            $str = "Reserve";
        return($str);
    }

    public function MaxReportDate($lac) {
        $sql = " select distinct Reporting_tag from " . $this->SchemaDot() . "Psname where Lac=" . $lac;
        $row = $this->FetchRecords($sql);
        return(count($row));
    }

    public function AdvancePosting($Lac) {
        if ($Lac == 0) //For All LAC
            $cond = " Reporting_tag=0 ";
        else {
            $cond = "  Lac=" . $Lac; //For Particular LAC    
            $cond.="  and Reporting_tag=0 ";
        }
        $dd = $this->FetchColumn($this->SchemaDot() . "Psname", "count(*)", $cond, "0");

        if ($dd > 0)
            return(true);
        else
            return(false);
    }

    public function All_Lac_Locked() {
        $lacr = $this->FetchRecords("select distinct lac from psname where lac in(select code from lac where code>0)");
            $a = 0;
        for ($i = 0; $i < count($lacr); $i++) {
            if ($this->groupStatus($lacr[$i][0]) >= 4)
                $a++;
        }
        if($a==count($lacr) && $a>0)
            return(true);
        else
            return(false);
    }

    public function groupStatus($Lacno) {
        $condition = "Lac=" . $Lacno;
        $cnt = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);
        if ($cnt == 0)
            $status = 0;    //Not Done
        else
            $status = 1; //Ready 


        $condition = " Prno>0 and Lac=" . $Lacno;
        $cnt = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);
        if ($cnt > 0)
            $status = 2; //Partially Done

        $condition = " Large=" . $this->BooleanFalse . " and Lac=" . $Lacno;

        $Req1 = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);

        $condition = " Prno>0 and Po1no>0 and Po2no>0 and Po3no>0 and Large=" . $this->BooleanFalse . " and Lac=" . $Lacno;
        $Avl1 = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);

//if($this->MyIP()==true)
//echo $this->returnSql."<br>";
        $cond = "Vo_required='Y' and lac=" . $Lacno;
        $reqV = $this->CountRecords($this->SchemaDot() . "polinggroup", $cond);
        $cond = "Vvno>0 and Vo_required='Y' and lac=" . $Lacno;
        $avlV = $this->CountRecords($this->SchemaDot() . "polinggroup", $cond);


        $condition = " Large=" . $this->BooleanTrue . " and Lac=" . $Lacno;
        $Req2 = $this->CountRecords("polinggroup", $condition);

        $condition = " Po4no>0 and Large=" . $this->BooleanTrue . " and Lac=" . $Lacno;
        $Avl2 = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);

        if ($avlV == $reqV && $Req1 == $Avl1 && $Req2 == $Avl2 && ($Avl1 + $Avl2) > 0)
        //if ($Req1 == $Avl1 && $Req2 == $Avl2)
            $status = 3; //Group Completed 

        $condition = " Po4no>0 and Large=" . $this->BooleanTrue . " and Lac=" . $Lacno;
        $Avl2 = $this->CountRecords($this->SchemaDot() . "polinggroup", $condition);

//if($this->MyIP()==true)
        //echo $Lacno."-".$Req1."=".$Avl1." Req2=".$Req2."=".$Avl2."<br>";

        $condition = " mtype=1 and Lac=" . $Lacno;
        $dd = $this->CountRecords($this->SchemaDot() . "Final", $condition);
        if ($dd > 0)
            $status = 4; //Locked  

        $condition = " mtype=2 and Lac=" . $Lacno;
        $cc = $this->CountRecords($this->SchemaDot() . "Final", $condition);
        $cc1 = $this->MaxReportDate($Lacno);

        if ($cc > 0) {
            if ($cc == $cc1)
                $status = 6;
            else
                $status = 5;
        }
        return($status);
    }

//GroupStatus

    public function groupStatusDetail($Lacno) {
        $code = $this->groupStatus($Lacno);

        $res = $this->FetchColumn("groupstatus", "detail", "code=" . $code, "-");
        return($res);
    }

//groupStatusDetail

    public function MicrogroupStatus($Lacno) {
        $condition = "Lac=" . $Lacno;
        $cnt = $this->CountRecords($this->SchemaDot() . "Microps", $condition);
        if ($cnt == 0)
            $status = 0;    //Not Done
        else
            $status = 1; //Ready    


        $condition = " Micro_id>0 and Lac=" . $Lacno;
        $c1 = $this->CountRecords($this->SchemaDot() . "Microgroup", $condition);

        $condition = "  Lac=" . $Lacno;
        $c2 = $this->CountRecords($this->SchemaDot() . "Microgroup", $condition);

        if ($c1 < $c2 && $c1 > 0)
            $status = 2; //Partially Done 
        else {
            if ($c1 > 0 && $c1 >= $c2)
                $status = 3; //Fuly Done 
        }


        $condition = " mtype=5 and Lac=" . $Lacno;
        $dd = $this->CountRecords($this->SchemaDot() . "Final", $condition);
        if ($dd > 0)
            $status = 4;  //LAC wise Locked 

            
//start
        $condition = " mtype=6 and Lac=" . $Lacno;
        $cc = $this->CountRecords($this->SchemaDot() . "Final", $condition);

        if ($this->AdvancePosting($Lacno)) {
            if ($cc == 1)
                $status = 5; //Partial PS Allocation for Advance day
            if ($cc == 2)
                $status = 6;
        }
        else {
            if ($cc == 1)
                $status = 6; //Full Allocation
        }
        return($status);
    }

//Micro Group Status

    public function MicrogroupStatusDetail($Lacno) {

        $code = $this->MicrogroupStatus($Lacno);

        return($this->FetchColumn("groupstatus", "detail", "code=" . $code, ''));
    }

//groupStatusDetail

    public function CommonMicrogroupStatus() {
        $status = 0;
        $sql = "select code from " . $this->SchemaDot() . "lac where code>0 and code in(Select distinct Lac from " . $this->SchemaDot() . "Psname)";

        $row = $this->FetchRecords($sql);

        for ($i = 0; $i < count($row); $i++) {
            $tmp = $this->MicrogroupStatus($row[$i][0]);
            if ($tmp > $status)
                $status = $tmp;
        }
        return($status);
    }

//commonmicrosttus

    public function CommongroupStatus() {
        $status = 0;
        $sql = "select code from " . $this->SchemaDot() . "lac where code>0 and code in(Select distinct Lac from " . $this->SchemaDot() . "Psname)";

        $row = $this->FetchRecords($sql);
        for ($i = 0; $i < count($row); $i++) {
            $tmp = $this->groupStatus($row[$i][0]);
            if ($tmp > $status)
                $status = $tmp;
        }
        return($status);
    }

//commonmicrosttus

    public function CommonCountgroupStatus() {
        $status = 0;

        $sql = "select code from " . $this->SchemaDot() . "lac where code>0 and code in(Select distinct Lac from " . $this->SchemaDot() . "Psname)";

        $row = $this->FetchRecords($sql);

        for ($i = 0; $i < count($row); $i++) {
            $tmp = $this->CountinggroupStatus($row[$i][0]);
            if ($tmp > $status)
                $status = $tmp;
        }
        return($status);
    }

//commonmicrosttus

    public function TrainingGroupExist($phase) {
        $condition = " phaseno=" . $phase;
        $dd = $this->CountRecords($this->SchemaDot() . "Poling_training", $condition);
        if ($dd > 0)
            return(true);
        else
            return(false); //Ready    
    }

    public function CountinggroupStatus($Lacno) {
        $condition = " (Reserve='N' or Reserve='Y')  and Lac=" . $Lacno;
        $dd = $this->CountRecords($this->SchemaDot() . "countinggroup", $condition);
        if ($dd == 0)
            $status = 0;    //Not Done
        else
            $status = 1; //Ready    

        $condition = " Sr>0 and Lac=" . $Lacno;
        $dd = $this->CountRecords($this->SchemaDot() . "countinggroup", $condition);
        if ($dd > 0)
            $status = 2; //Partially Done 



            
//Check if group Completed
        $type = $this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", 1);

        if ($type <= 2) { //Assembly/Parliament
            $condition1 = "Reserve='N' and Lac=" . $Lacno;
            $condition2 = "Reserve='N' and Sr>0 and Ast1>0 and Static_observer>0 and Lac=" . $Lacno;
        } else { //BNTC and Panchayat
            $condition1 = "(Reserve='N' or Reserve='Y') and Lac=" . $Lacno;
            $condition2 = "Sr>0 and Ast1>0 and Ast2>0 and Lac=" . $Lacno;
        }
        $Req1 = $this->CountRecords($this->SchemaDot() . "countinggroup", $condition1);
        $Avl1 = $this->CountRecords($this->SchemaDot() . "countinggroup", $condition2);
//echo $Lacno."=".$Req1."=".$Avl1; 
        if ($Req1 == $Avl1 && $Avl1 > 0)
            $status = 3; //Group Completed 


        $condition = "mtype=7 and Lac=" . $Lacno;
        $dd = $this->CountRecords($this->SchemaDot() . "final", $condition);

        if ($dd > 0)
            $status = 4;  //Locked   

        $condition = "mtype=8 and Lac=" . $Lacno;
        $cc = $this->CountRecords($this->SchemaDot() . "final", $condition);
        if ($cc > 0)
            $status = 6; //Full Allocation

        return($status);
    }

//End 

    public function isSelected4Trainee($Slno, $phase) {
        $cond = "phaseno=" . $phase . " and poling_id=" . $Slno;
        $i = $this->FetchColumn($this->SchemaDot() . "poling_training", "Groupno", $cond, "0");
        if ($i > 0)
            return(true);
        else
            return(false);
    }

//isSelected4Trainee

    public function TrgBatchNumber($Slno, $phase) {
        $cond = " phaseno=" . $phase . " and poling_id=" . $Slno;
        $i = $this->FetchColumn($this->SchemaDot() . "poling_training", "Groupno", $cond, "0");
        return($i);
    }

//TrgBatchNumber

    public function isPresentinTraining($Slno, $phase) {
        $condition = "(Attended1='Y' or Attended2='Y' or Attended3='Y') and phaseno=" . $phase . " and poling_id=" . $Slno;
        $i = $this->CountRecords($this->SchemaDot() . "poling_training", $condition);
        if ($i > 0)
            return(true);
        else
            return(false);
    }

    public function isSelectedinGroup($Slno) {
        $cond = "Selected='Y' and Grpno>0 and Slno=" . $Slno;
        $i = $this->FetchColumn($this->SchemaDot() . "poling", "Grpno", $cond, "0");
        if ($i > 0)
            return(true);
        else
            return(false);
    }

//isSelectedinGroup

    public function RandomisePoling($cond, $tot) {
        
    }

//end Randomise Poling


    public function countDepcatWise($deptype, $cat) {
        $mcond = " and Depcode in(Select Depcode from department where Dep_type in(";
        if ($deptype == "G")
            $mcond = $mcond . "'G',";
        if ($deptype == "B")
            $mcond = $mcond . "'B',";
//B C G H M O P  Dep Type
        if ($deptype == "S")
            $mcond = $mcond . "'C','H','M','P','O',";
        $mcond = $mcond . "'-'))";
        if ($cat > 0)
            $condition = "pollcategory=" . $cat . $mcond;

        if ($cat == 0)
            $condition = "pollcategory in(1,2,3,4,5,7,10)" . $mcond;

        $i = $this->CountRecords($this->SchemaDot() . "poling", $condition);

        return($i);
    }

    public function countDepcatWiseDetail($deptype) {
        $tmp = "";
        $cat = array();
        $cat[1] = "Pr";
        $cat[2] = "Pl";
        $cat[3] = "P2";
        $cat[4] = "P3";
        $cat[5] = "P4";
        $cat[6] = "";
        $cat[7] = "Micro";
        $cat[8] = "";
        $cat[9] = "";
        $cat[10] = "VPAT";

        for ($i = 1; $i < 11; $i++) {
            if ($i != 6)
                $tmp = $tmp . " " . $cat[$i] . ":<b>" . $this->countDepcatWise($deptype, $i) . "</b>";
        }
        return($tmp);
    }

//countdepcatwise

    public function countingAvailable() {

        $cond1 = "Countcategory=1 and countselected='Y' and countgrpno=0 and deleted='N'";
        $cond2 = "Countcategory=2 and countselected='Y' and countgrpno=0 and deleted='N'";
        $cond3 = "Countcategory=3 and countselected='Y' and countgrpno=0 and deleted='N'";

        $a = $this->rowCount($cond1);
        $b = $this->rowCount($cond2);
        $c = $this->rowCount($cond3);


        //echo $a."<br>";

        $trcond = " and Slno in(Select Poling_id from Poling_training where phaseno=4 and (Attended1='Y' or Attended2='Y' or Attended3='Y'))";

        $a1 = $this->CountRecords($this->SchemaDot() . "poling_training", "pcategory=1 and phaseno=4 and (Attended1='Y' or Attended2='Y' or Attended3='Y')");
        $b1 = $this->CountRecords($this->SchemaDot() . "poling_training", "pcategory=2 and phaseno=4 and (Attended1='Y' or Attended2='Y' or Attended3='Y')");
        $c1 = $this->CountRecords($this->SchemaDot() . "poling_training", "pcategory=3 and phaseno=4 and (Attended1='Y' or Attended2='Y' or Attended3='Y')");

        $ext = " and slno in(select poling_id from poling_training where  phaseno=4 and (Attended1='Y' or Attended2='Y' or Attended3='Y'))";


        if ($a1 > 0) {
            $a = $this->CountRecords($this->SchemaDot() . "poling", $cond1 . $ext);
        }
        if ($b1 > 0)
            $b = $this->CountRecords($this->SchemaDot() . "poling", $cond2 . $ext);
        if ($c1 > 0)
            $c = $this->CountRecords($this->SchemaDot() . "poling", $cond3 . $ext);



        $type = $this->FetchColumn($this->SchemaDot() . "party_calldate", "mydate1", "code=1", 1);
        if ($type <= 2)
            $micro = ": Micro Obs-";
        else
            $b = $b + $c;

        $temp = "Super-" . $a . ": Ast-" . ($b);

        if ($c > 0 && $type <= 2)
            $temp = $temp . $micro . $c;

        return($temp);
    }

//countdepcatwise

    public function DutyLAC($grpno) {
        $cond = "Grpno=" . $grpno;
        return($this->FetchColumn($this->SchemaDot() . "polinggroup", "Lac", $cond, "0"));
    }

//end DutyLAC

    public function TrgGroup($grpno) {
        $cond = "Grpno=" . $grpno;
        return($this->FetchColumn($this->SchemaDot() . "polinggroup", "Trggroup", $cond, "0"));
    }

//end DutyLAC

    public function BEEO($slno) {
        $sql = "select BEEO.name from " . $this->SchemaDot() . "Poling," . $this->SchemaDot() . "BEEO where poling.Beeo_code>0 and poling.Beeo_code=BEEO.code and Poling.slno=" . $slno;
        $row = $this->FetchRecords($sql);
        if (count($row) > 0)
            return($row[0][0]);
        else
            return("");
    }

    public function TrainingArray($phase) {
        $query = "select distinct groupno from " . $this->SchemaDot() . "training where phaseno=" . $phase . " order by groupno";
        $tr = $this->FetchRecords($query);
        $objUtility = new Utility();

        $ValueList = array();
        $date1 = date('Y-m-d');
        $j = 0;
        for ($a = 0; $a < count($tr); $a++) {
            $batch = $tr[$a][0];
            $date = $this->FetchColumn($this->SchemaDot() . "training", "trgdate1", "Groupno=" . $batch . " and phaseno=" . $phase . " order by Rsl desc", date('d/m/Y'));
            $date2 = $objUtility->to_mysqldate($date);
            $datepassed = 0;
//echo $batch." ".$date." ".$date2."<br>";
            if ($objUtility->dateDiff($date1, $date2) <= 0) {
                $ValueList[$j][0] = $batch;
                $time = $this->FetchColumn($this->SchemaDot() . "training", "trgtime", "Groupno=" . $batch . " and phaseno=" . $phase, "0");
                $time = "(" . $this->FetchColumn($this->SchemaDot() . "trg_time", "timing", "code=" . $time, "") . ")";
                $ValueList[$j++][1] = "Batch-" . $batch . " " . $date . $time;
            }//Passed
        }
        return( $ValueList);
    }

    public function TrainingArrayExcluding($phase, $Batch = 0) {
        $query = "select distinct groupno from " . $this->SchemaDot() . "training where phaseno=" . $phase . " order by groupno";
        $tr = $this->FetchRecords($query);
        $objUtility = new Utility();

        $ValueList = array();
        $date1 = date('Y-m-d');
        $j = 0;

        for ($a = 0; $a < count($tr); $a++) {
            $batch = $tr[$a][0];
            if ($batch != $Batch) {
                $date = $this->FetchColumn($this->SchemaDot() . "training", "trgdate1", "Groupno=" . $batch . " and phaseno=" . $phase . " order by Rsl desc", date('d/m/Y'));
                $date2 = $objUtility->to_mysqldate($date);
                $datepassed = 0;
//echo $batch." ".$date." ".$date2."<br>";
                if ($objUtility->dateDiff($date1, $date2) <= 0) {
                    $ValueList[$j][0] = $batch;
                    $time = $this->FetchColumn($this->SchemaDot() . "training", "trgtime", "Groupno=" . $batch . " and phaseno=" . $phase, "0");
                    $time = "(" . $this->FetchColumn($this->SchemaDot() . "trg_time", "timing", "code=" . $time, "") . ")";
                    $ValueList[$j++][1] = "Batch-" . $batch . " " . $date . $time;
                }//Passed
            }//$mybatch!=$batch
        }
        return( $ValueList);
    }

    public function ClearHalfDoneRandomisation($lac) {
        $done = false;
        if ($this->groupStatus($lac) < 4) {
            $this->BeginTransaction();
            $done = true;

            $sql = "update poling set selected='Y',grpno=0 where pollcategory in(1,2,3,4,5,10) and grpno in";
            $sql = $sql . " (select grpno from polinggroup where lac=" . $lac . ")";
            if ($this->ExecuteQuery($sql) == false)
                $done = false;

            $sql = "delete from polinggroup where lac=" . $lac;
            if ($this->ExecuteQuery($sql) == false)
                $done = false;

            if ($done == true)
                $this->CommitTransaction();
            else
                $this->RollbackTransaction();
        }
        return($done);
    }

}

//End Class
?>
