<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head></head>



    <body>
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" >
        <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
        <script src="../bootstrap/bootstrap.js"></script>
        <script src="../bootstrap/bootstrap.min.js"></script>	

        <?php
        session_start();


        require_once './class/class.dak_status.php';

        $objUtility = new Utility();
        $objDak = new Dak_status();


        $type = isset($_GET['type'])?$_GET['type']:'0';
        $branch = isset($_GET['branch'])?$_GET['branch']:'0';
        $entry_date1 = isset($_GET['entry_date1']) ? $_GET['entry_date1'] : date('d/m/Y');
        $entry_date2 = isset($_GET['entry_date2']) ? $_GET['entry_date2'] : date('d/m/Y');

        $dt1 = $objUtility->to_mysqldate($entry_date1);
        $dt2 = $objUtility->to_mysqldate($entry_date2);


        $sql = "SELECT DAK_ID,RECVD_YR, PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT ,ENTRY_DATE,Disposed,dispose_date,notes,BRANCH_CODE,action_taken   FROM DAK_ENTRY WHERE ";
        $cond=" 1=2 ";
        if ($type == 1) {
        $cond = "branch_code=".$branch." and  entry_date between '" . $dt1 . "' and '" . $dt2 . "' order by entry_date,dak_id";
        }
        if ($type == 2) {
        $cond = "branch_code=".$branch." and action_taken='Y'  and  entry_date between '" . $dt1 . "' and '" . $dt2 . "' order by entry_date,dak_id";
        }
        if ($type == 3) {
        $cond = "branch_code=".$branch." and disposed='Y'   and  entry_date between '" . $dt1 . "' and '" . $dt2 . "' order by entry_date,dak_id";
        }

        $SQL= $sql." ".$cond;

        $row = $objDak->FetchRecords($SQL);
        $ValueList = array();

        $xbr = $objDak->FetchRecords("select branch_name from branch_section where branch_code=".$branch);

        $branchname=isset( $xbr[0][0])?$xbr[0][0]:'';
        
        $pr = array();
        $pr[1] = "Immidiate";
        $pr[2] = "Urgent";
               for ($i = 0; $i < count($row); $i++) {
        $ValueList[$i][0] = $row[$i][0] . "/" . $row[$i][1];   // $align=array(2,2,1,1,2,2,1)
        $id = $row[$i][2];

        $ValueList[$i][1] = $row[$i][3];
        if ($row[$i][12] == "Y") { //action taken
        $yr = $row[$i][1];
        $did = $row[$i][0];
        $temp = $objDak->FetchRecords("select note_date,note from dak_status where recvd_yr=" . $yr . " and dak_id=" . $did);
        $dd=isset($temp[0][1])?$temp[0][1]:'';
        $dd=trim($dd);
        $dd=Sanitize_AllSpecial($dd,200);
        //echo  $row[$i][0]."  ".$dd."<bR>";
        $action = isset($temp[0][0]) ? $dd . "<br>Date:" . $objUtility->to_date($temp[0][0]) : '';
        $ValueList[$i][1].="<br><u>Action</u>:" . $action;
        }
        if ($row[$i][8] == "Y") { //disposed jhence write final note
        $dispose_dt = $objUtility->ismysqldate($row[$i][9]) ? $objUtility->to_date($row[$i][9]) : '';
        $ValueList[$i][1].="<br><u>Disposed Note:</u>:" . $row[$i][10];
        $ValueList[$i][1].="<br>Date:" . $dispose_dt;
        }

        $ValueList[$i][2] = $row[$i][4]; //recvd from
        $ValueList[$i][3] = $row[$i][5] . "<br>Date:" . $objUtility->to_date($row[$i][6]);
        $ValueList[$i][4] = $objUtility->ismysqldate($row[$i][7]) ? $objUtility->to_date($row[$i][7]) : '';
       
        if (isset($pr[$id]))
        $ValueList[$i][0].="<br>" . $pr[$id];
        }//for loop

        $align = array(2, 1, 1, 1, 2, 2);
        $objDak->TableHeadColor = "#CC99FF";
        $objDak->TableHeadFont = 2;
$objDak->TableTitleFont=3;
        if (count($ValueList) > 0)
        $objDak->genBootStrapDataGridOnValueList($title ="Branch Name:<b>".$branchname.'</b> (Total ' . $i . ")", $headlist = array('Dak ID', 'Subject', 'Received From', 'Letter No & Date', 'Entry Date'), $align, $ValueList, 100, count($ValueList));
        else
        echo "<div align=center><font face=arial size=3 color=red>Record not Found</font></div>";
   
        
   function Sanitize_AllSpecial($temp, $size = 100) {
        $temp = substr($temp, 0, $size);
        $temp = str_replace("alert", "", $temp);
        $temp = str_replace("<br>", "[br]", $temp);
        $temp = str_replace("<", "", $temp);
        $temp = str_replace(">", "", $temp);
        $temp = str_replace(";", "", $temp);
        $temp = str_replace("#", "", $temp);
        $temp = str_replace("$", "", $temp);
        $temp = str_replace("?", "", $temp);
        $temp = str_replace("&", "", $temp);
        $temp = str_replace("\\", "", $temp);
        $temp = str_replace("^", "", $temp);
         $temp = str_replace("%", "", $temp);
        return($temp);
    }
        ?>
    </body>
</html>