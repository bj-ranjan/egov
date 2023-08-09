<html>
    <head>
        <title>Status Updation</title>
    </head>
    <script type="text/javascript" src="../validation.js"></script>
    <script language=javascript>
        <!--
        function home(i)
        {
            var conf = confirm('Back to Home');
            if (conf == false)
            {
                exit;
            }
            if (i <= 1)
                window.location = "../startMenu.php?tag=1";
            else
                window.location = "../indexPage.php?tag=1";
        }

        function back2home()
        {

            window.location = "Editdak.php?tag=0";
        }

        function proceed()
        {
            i = document.getElementById('Branch').value;
            if (i > 0)
                window.location = "ListDakStatus.php?br=" + i;
            else
                alert('Select Branch');
        }

        function validate(i, tag)
        {
            var edate;
            var ddate;
            var e;
            var d;
            var c;
            var f;
            var ok = true;
            var today = document.getElementById('Today').value;

            e = "Entry_date" + i;
            d = "Dispose_date" + i
            c = "Notes" + i;
            f = document.getElementById(c).value;
            edate = document.getElementById(e).value;
            //alert(f);
            ddate = document.getElementById(d).value;
            //alert(ddate);
            //alert(edate+' '+ddate);
            if (isdate(ddate, 1) == true && StringValid(c, 1, 1) == true && f != '')
            {
                if (CompareDate(ddate, edate) == -1 || CompareDate(ddate, today) == 1)
                {
                    ok = false;
                }
            }//isdate(ddate)==tr   
            else
                ok = false;



            if (ok == true)
            {
                //alert('ok')
                myform.action = "Editdak.php?tag=" + tag + "&line=" + i;
                myform.submit();
            }
            else {
                if (StringValid(c, 1, 1) == false || f == '') {
                    alert('Check Notes ');
                    document.getElementById(c).focus();
                }
                else {
                    alert('Check Date  ' + ddate);
                    document.getElementById(d).focus();
                }
            }
        }
    </script>

    <script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" >
    <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/bootstrap.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>	
    <link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
    <script src="../jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() //Onload event of Form
        {
            //alert('Document Loaded');

        }); //document ready
    </script>


    <BODY>

        <script language=javascript>
        <!--
        </script>
    <body onload=setMe()>
        <p align=center>
            <?php
            session_start();
            require_once './class/class.dak_status.php';
            //require_once '../class/utility.class.php';

            $objUtility = new Utility();
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');
            ?>
        <div align='center'>
            <img src="../image/header.jpg"  width="740px" height=90>
        </div>
        <?PHP
        $objDak_entry = new Dak_status();
        if (isset($_GET['tag']))
            $code = $_GET['tag'];
        else
            $code = 0;


        if (isset($_SESSION['roll']))
            $roll = $_SESSION['roll'];
        else
            $roll = 3;

        $edate = '2019-10-31';

        if ($code == 0) { //Initial Loading  from Login Page           
            $brcode = isset($_SESSION['branch']) ? $_SESSION['branch'] : '0';

            if ($brcode == 0) {
                echo $objUtility->AlertNRedirect('', 'ManageDak.php');
            }
            $cond = "branch_code=" . $brcode;
            $rr = $objDak_entry->FetchRecords("select branch_name from branch_section where " . $cond);
            $bname = strtoupper(isset($rr[0][0]) ? $rr[0][0] : '-');

            $_SESSION['Branch'] = $brcode;
            $r = $objDak_entry->FetchRecordUsingIndexValueBySQL("select action_taken,count(*) from dak_entry where  entry_date>'" . $edate . "' and disposed='N' and branch_code=" . $brcode . "  group by action_taken", 1);
            // echo "select action_taken,count(*) from dak_entry where entry_date>'".$edate."' and disposed='N' and branch_code=".$brcode." and Priority in(1,2,3,4)  group by action_taken";
            echo "<h1>Branch Name:" . $bname . "</h1>";
            echo "<table class='table table-striped'>";
            if (isset($r['N'])) {
                $link = "<a href='EditDak.php?tag=1'><h2>Pending Case for Action Taken Report(" . $r['N'] . " Nos)</h2></a>";
                echo "<tr><td>" . $link . "</td></tr>";
            }
            if (isset($r['Y'])) {
                $link = "<a href='EditDak.php?tag=3'><h2>Pending Case for Final Disposal (" . $r['Y'] . " Nos)</h2></a>";
                echo "<tr><td>" . $link . "</td></tr>";
            }
            echo "<tr><td>";
            ?>
            <button type="button" class="btn btn-danger btn-lg"  name="x"  id="x" onclick="home(3)">Logout</button>     

            <?php
            echo "</td></tr>";
            echo "</table>";
        }//$code==10



        if ($code == 1) { //Next Loading aftre postback
            $bname = "";
            $sql = "SELECT DAK_ID ,PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT  ,ENTRY_DATE,RECVD_YR  FROM DAK_ENTRY WHERE entry_date>'" . $edate . "' and ";
            // $year=isset($_POST['Yr'])?$_POST['Yr']:(isset($_GET['Yr'])?$_GET['Yr']:date('Y'));
            // if (strlen($year) > 0)
            //    $sql = $sql . " Recvd_yr='" . $year . "' and ";


            $branch = isset($_SESSION['Branch']) ? $_SESSION['Branch'] : '0';

            $sql = $sql . "Branch_code=" . $branch . " and ";
            $sql = $sql . " Disposed='N' and action_taken='N' and Priority in(1,2,3,4) order by entry_date,Dak_id";


            $cond = "branch_code=" . $branch;
            $rr = $objDak_entry->FetchRecords("select branch_name from branch_section where " . $cond);
            $bname = strtoupper(isset($rr[0][0]) ? $rr[0][0] : '-');


            echo "<div align=center><h1>";
            echo "Branch Name:" . $bname;
            echo "</h1></div>";

            $row = $objDak_entry->FetchRecords($sql);
            ?>
            <table class='table table-striped'>
                <form name=myform action=""  method=POST >
                    <tr>
                        <td align=center  colspan="5" bgcolor="blue"><font size=2 face=arial color=white>
                            <b>UPDATION OF INITIAL ACTION(Total:<?php echo count($row); ?>)</b>
                        </td>
                        <td align=center  colspan="2" bgcolor="blue">
                            <button type="button" class="btn btn-warning btn-sm"  name="bk"  id="bk" onclick="back2home()">Back</button>     

                        </td>
                    </tr>
                    <tr>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Dak ID</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Subject</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b> Letter No & Date</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>   Received Date/Action Date</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Action Taken Notes</b>
                            <input type=hidden name=Branch_code  value="<?php echo $branch; ?>">
                            <input type=hidden size=6 name=Today id=Today  value="<?php echo date('d/m/Y'); ?>">
                        </td>
                    </tr>
    <?php
    $rowcount = 0;


    for ($ii = 0; $ii < count($row); $ii++) {
        $rowcount++;
        ?>
                        <tr>
                        <?php $Dak_id = "Dak_id" . $rowcount; ?>
                            <td align=center><font face="arial" size="2">
                            <?php
                            $objDak_entry->genHiddenBox($Dak_id, $row[$ii][0]);

                            $Recvd_yr = "Recvd_yr" . $rowcount;
                            $objDak_entry->genHiddenBox($Recvd_yr, $row[$ii][7]);


                            echo "<b>" . $row[$ii][0] . "/" . $row[$ii][7] . "</b><br>";
                            switch ($row[$ii][1]) {
                                case 1:echo "Immidiate";
                                    break;
                                case 2:echo "Urgent";
                                    break;
                                //case 3:echo "Fix Date";
                                //break;
                                // case 4:echo "Other";
                                // break;
                                // case 5:echo "File";
                                // break;
                                default:
                                //DAK_ID ,PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT  ,ENTRY_DATE
                            }//end switch
                            ?>
                            </td>
                                <?php $Subject = "Subject" . $rowcount; ?>
                            <td align=left><font face="arial" size="2"><div align=justify>
                            <?php echo $row[$ii][2]; ?>
                                </div></td>
                            <td align=left><font face="arial" size="2">
                                    <?php
                                    echo $row[$ii][4] . " dtd ";
                                    echo $objUtility->to_date($row[$ii][5]);
                                    ?>
                            </td>
                                <?php $Dispose_date = "Dispose_date" . $rowcount; ?>
                            <td align=left><font color='grey' size='2'>
                            <?php
                            $Edate = $objUtility->to_date($row[$ii][6]);
                            echo $Edate;
                            ?></font><br>
                                <input type=text size="7" maxlength="10" name="<?php echo $Dispose_date; ?>"  id="<?php echo $Dispose_date; ?>" size=12  value="">
                                <img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(<?php echo $Dispose_date; ?>);" alt="Click Here to Pick Date"><br>
                                </font>
                            </td>
                            <td align=center>
        <?php
//echo $objUtility->to_date($row[$ii]['Target_date']);
//echo "<br>";
        ?>
                                <?php $Notes = "Notes" . $rowcount; ?>
                                <textarea rows=3 cols=60 name="<?php echo $Notes; ?>"  id="<?php echo $Notes; ?>"  placeholder="Write notes of Maximum 150 character(Avoid Single Quote and Semi Colon) "></textarea>

        <?php $Entry_date = "Entry_date" . $rowcount;
        ?>
                                <input type=hidden name="<?php echo $Entry_date; ?>" id="<?php echo $Entry_date; ?>" size=10  value="<?php echo $Edate; ?>">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm"  name="Save<?php echo $rowcount; ?>"  id="Save<?php echo $rowcount; ?>" onclick="validate(<?php echo $rowcount; ?>, 2)">Update Action</button>     

                            </td>
                        </tr>
        <?php
    } //for loop
    $_SESSION['rowcount'] = $rowcount;
    ?>                                  



            </table>
    <?php
}//$code==1


if ($code == 2) { //PostBack Submit  Action Taken
//echo $_SESSION['rowcount'];
    $ind = isset($_GET['line']) ? $_GET['line'] : 1;
    //echo "ind" . $ind;\\
    $Recvd_yr = "Recvd_yr" . $ind;

    $Yr = isset($_POST[$Recvd_yr]) ? $_POST[$Recvd_yr] : date('Y');

    $upd = 0;
    //for ($ind = 1; $ind <= $_SESSION['rowcount']; $ind++) {
    if (isset($_SERVER['REMOTE_ADDR']))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "";

    if (isset($_SESSION['uid']))
        $uid = " " . $_SESSION['uid'];
    else
        $uid = "";

    $sql = "update dak_entry set action_taken='Y'";

    $Dak_id = "Dak_id" . $ind;
    $Dak_id = $_POST[$Dak_id];

    $sql.= " where Dak_id=" . $Dak_id . " and Recvd_yr='" . $Yr . "'";




    $Dispose_date = "Dispose_date" . $ind;
    $note_date = isset($_POST[$Dispose_date]) ? $_POST[$Dispose_date] : '/';


    $Notes = "Notes" . $ind;
    $text = isset($_POST[$Notes]) ? $_POST[$Notes] : '';
    $text=trim($text);
    $status = 0;
    // $objDak_entry->BeginTransaction();
    if ($objDak_entry->Execute($sql))
        $status++;
    $objDak_entry->setRecvd_yr($Yr);
    $objDak_entry->setDak_id($Dak_id);
    $str = $objDak_entry->maxRsl($Yr, $Dak_id);
    $objDak_entry->setRsl($str);
    $objDak_entry->setNote($text);
    $objDak_entry->setNote_date($note_date);
    if ($status == 1 && $objDak_entry->SaveRecord())
        $status++;

    if ($status == 2) {
        //$objDak_entry->CommitTransaction();
        $msg = "Succesfully Updated";
    } else {
        //$objDak_entry->RollbackTransaction();
        $sql = "update dak_entry set action_taken='N'";
        $sql.= " where Dak_id=" . $Dak_id . " and Recvd_yr='" . $Yr . "'";
        $objDak_entry->ExecuteQuery($sql);
        $msg = "Action Failed";
    }

    $page = "EditDak.php?tag=1&Yr=" . $Yr;
    //echo $page;
    echo $objUtility->AlertNRedirect($msg, $page);
    echo "<a href='" . $page . "'>Back</a>";
}//code=2



if ($code == 3) { //Next Loading aftre postback for disposal
    $bname = "";
    $sql = "SELECT DAK_ID ,PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT  ,ENTRY_DATE,RECVD_YR  FROM DAK_ENTRY WHERE entry_date>'" . $edate . "' and ";
    // $year=isset($_POST['Yr'])?$_POST['Yr']:(isset($_GET['Yr'])?$_GET['Yr']:date('Y'));
    // if (strlen($year) > 0)
    //    $sql = $sql . " Recvd_yr='" . $year . "' and ";


    $branch = isset($_SESSION['Branch']) ? $_SESSION['Branch'] : '0';

    $sql = $sql . "Branch_code=" . $branch . " and ";
    $sql = $sql . " Disposed='N' and action_taken='Y'  order by entry_date,Dak_id";


    $cond = "branch_code=" . $branch;
    $rr = $objDak_entry->FetchRecords("select branch_name from branch_section where " . $cond);
    $bname = strtoupper(isset($rr[0][0]) ? $rr[0][0] : '-');


    echo "<div align=center><h1>";
    echo "Branch Name:" . $bname;
    echo "</h1></div>";

    $row = $objDak_entry->FetchRecords($sql);
    ?>
            <table class='table table-striped'>
                <form name=myform action=""  method=POST >
                    <tr>
                        <td align=center  colspan="5" bgcolor="red"><font size=2 face=arial color=white>
                            <b>UPDATE DISPOSAL STATUS(Total:<?php echo count($row); ?>)</b>
                        </td>
                        <td align=center  colspan="2" bgcolor="red">
                            <button type="button" class="btn btn-dark btn-sm"  name="bk"  id="bk" onclick="back2home()">Back</button>     

                        </td>
                    </tr>
                    <tr>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Dak ID</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Subject</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b> Letter No & Date</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Received Date/Dispose Date</b>
                        </td>
                        <td align=center ><font size=2 face=arial color=black>
                            <b>Final Note</b>
                            <input type=hidden name=Branch_code  value="<?php echo $branch; ?>">
                            <input type=hidden size=6 name=Today id=Today  value="<?php echo date('d/m/Y'); ?>">
                        </td>
                    </tr>
    <?php
    $rowcount = 0;


    for ($ii = 0; $ii < count($row); $ii++) {
        $rowcount++;
        ?>
                        <tr>
                        <?php $Dak_id = "Dak_id" . $rowcount; ?>
                            <td align=center><font face="arial" size="2">
                            <?php
                            $objDak_entry->genHiddenBox($Dak_id, $row[$ii][0]);

                            $Recvd_yr = "Recvd_yr" . $rowcount;
                            $objDak_entry->genHiddenBox($Recvd_yr, $row[$ii][7]);


                            echo "<b>" . $row[$ii][0] . "/" . $row[$ii][7] . "</b><br>";
                            switch ($row[$ii][1]) {
                                case 1:echo "Immidiate";
                                    break;
                                case 2:echo "Urgent";
                                    break;
                                //case 3:echo "Fix Date";
                                //break;
                                // case 4:echo "Other";
                                // break;
                                // case 5:echo "File";
                                // break;
                                default:
                                //DAK_ID ,PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT  ,ENTRY_DATE
                            }//end switch
                            ?>
                            </td>
                                <?php $Subject = "Subject" . $rowcount; ?>
                            <td align=left><font face="arial" size="2"><div align=justify>
                            <?php echo $row[$ii][2]; ?>
                                </div></td>
                            <td align=left><font face="arial" size="2">
                                    <?php
                                    echo $row[$ii][4] . " dtd ";
                                    echo $objUtility->to_date($row[$ii][5]);
                                    ?>
                            </td>
                                <?php $Dispose_date = "Dispose_date" . $rowcount; ?>
                            <td align=left><font color='grey' size='2'>
                            <?php
                            $Edate = $objUtility->to_date($row[$ii][6]);
                            echo $Edate;
                            ?></font><br>
                                <input type=text size="7" maxlength="10" name="<?php echo $Dispose_date; ?>"  id="<?php echo $Dispose_date; ?>" size=12  value="">
                                <img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(<?php echo $Dispose_date; ?>);" alt="Click Here to Pick Date"><br>
                                </font>
                            </td>
                            <td align=center>
        <?php
//echo $objUtility->to_date($row[$ii]['Target_date']);
//echo "<br>";
        ?>
                                <?php $Notes = "Notes" . $rowcount; ?>
                                <textarea rows=2 cols=60 name="<?php echo $Notes; ?>"  id="<?php echo $Notes; ?>"  placeholder="Write notes of Maximum 150 character(Avoid Single Quote and Semi Colon) "></textarea>

        <?php $Entry_date = "Entry_date" . $rowcount;
        ?>
                                <input type=hidden name="<?php echo $Entry_date; ?>" id="<?php echo $Entry_date; ?>" size=10  value="<?php echo $Edate; ?>">
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"  name="Save<?php echo $rowcount; ?>"  id="Save<?php echo $rowcount; ?>" onclick="validate(<?php echo $rowcount; ?>, 4)">Final Dispose</button>     

                            </td>
                        </tr>
        <?php
    } //for loop
    $_SESSION['rowcount'] = $rowcount;
    ?>                                  

            </table>
                    <?php
                }//$code==3


                if ($code == 4) { //PostBack Submit  Final Dispose
//echo $_SESSION['rowcount'];
                    $ind = isset($_GET['line']) ? $_GET['line'] : 1;
                    //echo "ind" . $ind;\\
                    $Recvd_yr = "Recvd_yr" . $ind;

                    $Yr = isset($_POST[$Recvd_yr]) ? $_POST[$Recvd_yr] : date('Y');

                    $upd = 0;
                    //for ($ind = 1; $ind <= $_SESSION['rowcount']; $ind++) {
                    if (isset($_SERVER['REMOTE_ADDR']))
                        $ip = $_SERVER['REMOTE_ADDR'];
                    else
                        $ip = "";

                    if (isset($_SESSION['uid']))
                        $uid = " " . $_SESSION['uid'];
                    else
                        $uid = "";


                    $Dak_id = "Dak_id" . $ind;
                    $Dak_id = $_POST[$Dak_id];



                    $Dispose_date = "Dispose_date" . $ind;
                    $note_date = isset($_POST[$Dispose_date]) ? $_POST[$Dispose_date] : '/';

                    $note_date = $objUtility->to_mysqldate($note_date);
                    $Notes = "Notes" . $ind;
                    $text = isset($_POST[$Notes]) ? $_POST[$Notes] : '';
                    $text=trim($text);
                    $sql = "update dak_entry set disposed='Y',dispose_date='" . $note_date . "',notes='" . $text . "' ";
                    $sql.= " where Dak_id=" . $Dak_id . " and Recvd_yr='" . $Yr . "'";

                    if ($objDak_entry->Execute($sql))
                        $msg = "Succesfully Disposed";
                    else
                        $msg = "Action Failed";


                    $page = "EditDak.php?tag=3";
                    //echo $page;
                    echo $objUtility->AlertNRedirect($msg, $page);
                    echo "<a href=EditDak.php?tag=3>Back</a>";
                }//code=2
                ?>
    </p>
</form>
</body>
</html>
