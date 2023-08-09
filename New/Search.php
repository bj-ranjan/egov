<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head></head>
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/validation2018.js"></script>
    <script type="text/javascript">
        $(document).ready(function() //Onload event of Form
        {
            //  alert('Document Loaded');
            //$("#aa").click(function() {
            //alert(2);

            // });
        }); //document ready

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


        function mdate(id)
        {

            var d = getVal(id);
            d = d.replace("//", "/");
            d = d.replace("-", "");
            d = d.replace(".", "");
            var ln = d.length;
            if (ln == 2 || ln == 5)
                d = d + "/";
            setVal(id, d);
        }

        function validate()
        {
            DisObj('aa');
            myform.action = "search.php";
            myform.submit();
        }
    </script>

    <body>
        <div align='center'>
            <img src="../image/header.jpg"  width="740px" height=90>
        </div>
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" >
        <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
        <script src="../bootstrap/bootstrap.js"></script>
        <script src="../bootstrap/bootstrap.min.js"></script>	
        <link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>

        <?php
        session_start();
        
         if (isset($_SESSION['roll']))
                $roll = $_SESSION['roll'];
            else
                $roll = 3;
        
        require_once './class/class.dak_status.php';

        $objUtility = new Utility();
        $objDak = new Dak_status();
        $tag = isset($_POST['tag']) ? $_POST['tag'] : 0;
        $letter_no = isset($_POST['letter_no']) ? $_POST['letter_no'] : '';
        $letter_date = isset($_POST['letter_date']) ? $_POST['letter_date'] : '';

        $sdate = $objUtility->dateMinus(date('Y-m-d'), -6);
        $sdate = $objUtility->to_date($sdate);

        $entry_date1 = isset($_POST['entry_date1']) ? $_POST['entry_date1'] : $sdate;
        $entry_date2 = isset($_POST['entry_date2']) ? $_POST['entry_date2'] : date('d/m/Y');
        ?>


        <form name="myform"  method="post"  action="search.php">
            <div class="container">
                <div class="col-sm-12 text-left"> 
                    <div class="panel panel-primary " >

                        <div class="panel-heading">
                            <p align="center"><font face=arial size=4>Search DAK Status</font></p>
                        </div>
                        <div class="panel-body">

                            <div class="form-group col-sm-6">
                                <label>Letter No</label>
                                <input type='text'  class='form-control input' value='<?php echo $letter_no; ?>' name='letter_no'  id='letter_no' placeholder='Type Few Character'  maxlength='25'  />
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Letter Date</label>
                                <input type='text' class='form-control input' value='<?php echo $letter_date; ?>'  name='letter_date'  id='letter_date' placeholder='Letter Date'  maxlength='10'  onkeyup=mdate('letter_date')/>
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Entry Date From</label>
                                <input type='text' class='form-control input' value='<?php echo $entry_date1; ?>' name='entry_date1'  id='entry_date1' placeholder='First Date'   maxlength='10'  onkeyup=mdate('entry_date1') />
                                <span class="text-danger"></span>                
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Entry Date To</label>
                                <input type='text' class='form-control input' value='<?php echo $entry_date2; ?>'  name='entry_date2'  id='entry_date2' placeholder='Last Date'   maxlength='10'  onkeyup=mdate('entry_date2') />
                                <span class="text-danger"></span>                
                            </div>
                            <div class="form-group col-sm-2">
                                <input type='hidden' name='tag' id='tag'  value='1'>
                                <button type="button" class="btn btn-success btn" id='aa' name='aa'  onclick="validate()">Search</button>
                            </div>
                            <?php if($roll==0){ ?>
                            <div class="form-group col-sm-2">
                             
                                <button type="button" class="btn btn-success btn" id='bb' name='bb'  onclick="home(0)">Home</button>
                            </div>
                            <?php } ?>
                        </div></div></div></div> 
        </form>        
        <?php
        if ($tag == 1) {
            //echo "Letter Date ".$letter_date;
            $sql = "SELECT DAK_ID,RECVD_YR, PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT ,ENTRY_DATE,Disposed,dispose_date,notes,BRANCH_CODE,action_taken   FROM DAK_ENTRY WHERE ";
            $cond = "";
            $i = 0;
            if (strlen($letter_no) > 2) {
                if ($i > 0)
                    $cond.=" and ";
                $cond.=" upper(Ltr_no) like '%" . strtoupper($letter_no) . "%' ";
                $i++;
            }

            if (strlen($letter_date) == 10 && $objUtility->isdate($letter_date)) {
                if ($i > 0)
                    $cond.=" and ";
                $cond.=" Ltr_dt ='" . $objUtility->to_mysqldate($letter_date) . "' ";
                $i++;
            }

            if (strlen($entry_date1) == 10 && $objUtility->isdate($entry_date1)) {
                $edate1 = $objUtility->to_mysqldate($entry_date1);
                if ($i > 0)
                    $cond.=" and ";
                if (strlen($entry_date2) == 10 && $objUtility->isdate($entry_date2)) {
                    $edate2 = $objUtility->to_mysqldate($entry_date2);
                    $cond.=" entry_date  between '" . $edate1 . "'  and '" . $edate2 . "' ";
                } else {
                    $cond.=" entry_date ='" . $edate1 . "' ";
                }
                $i++;
            }

            echo "<br>";
            //echo $sql.$cond; 
            echo "<br>";
            if ($i == 0)
                $cond = " 1=2 ";


            $SQL = $sql . $cond . " order by entry_date desc,dak_id";
            $row = $objDak->FetchRecords($SQL);
            $ValueList = array();

            $branch = $objDak->FetchRecordUsingIndexValueBySQL("select branch_code,branch_name from branch_section", 1);


            $pr = array();
            $pr[1] = "Immidiate";
            $pr[2] = "Urgent";
            //$pr[3] = "Fix Date";
            //$pr[4] = "Other";
            //$pr[5] = "File";
            //  $sql = "SELECT DAK_ID,RECVD_YR, PRIORITY,SUBJECT ,RECVD_FROM ,LTR_NO ,LTR_DT ,ENTRY_DATE,Disposed,dispose_date,notes  FROM DAK_ENTRY WHERE ";
            for ($i = 0; $i < count($row); $i++) {
                $ValueList[$i][0] = $row[$i][0] . "/" . $row[$i][1];   // $align=array(2,2,1,1,2,2,1)
                $id = $row[$i][2];

                $ValueList[$i][1] = $row[$i][3];
                if ($row[$i][12] == "Y") { //action taken
                    $yr = $row[$i][1];
                    $did = $row[$i][0];
                    $temp = $objDak->FetchRecords("select note_date,note from dak_status where recvd_yr=" . $yr . " and dak_id=" . $did);
                    $action = isset($temp[0][0]) ? $temp[0][1] . "<br>Date:" . $objUtility->to_date($temp[0][0]) : '';
                    $ValueList[$i][1].="<br><u>Action</u>:" . $action;
                }
                if ($row[$i][8] == "Y") { //disposed jhence write final note
                    $dispose_dt = $objUtility->ismysqldate($row[$i][9]) ? $objUtility->to_date($row[$i][9]) : '';
                    $ValueList[$i][1].="<br><u>Disposed Note:</u>:" . $row[$i][10];
                    $ValueList[$i][1].="<br>Date:" . $dispose_dt;
                }

                $ValueList[$i][2] = $row[$i][4]; //recvd from
                $ValueList[$i][3] = $row[$i][5] . "<br>Date:" . $objUtility->to_date($row[$i][6]);
                $ValueList[$i][4] = ($row[$i][8] == "Y") ? 'Yes' : 'No';
                // $ValueList[$i][4].="<br>".$dispose_dt ;
                //$ValueList[$i][5] = $row[$i][10];
                $ValueList[$i][5] = $objUtility->ismysqldate($row[$i][7]) ? $objUtility->to_date($row[$i][7]) : '';
                $Br = $row[$i][11];
                $Br = isset($branch[$Br]) ? $branch[$Br] : '';
                $ValueList[$i][5].="<br>" . $Br;
                if (isset($pr[$id]))
                    $ValueList[$i][0].="<br>" . $pr[$id];
            }//for loop

            $align = array(2, 1, 1, 1, 2, 2);
            $objDak->TableHeadColor = "#FFCCCC";
            $objDak->TableHeadFont = 3;

            if (count($ValueList) > 0)
                $objDak->genBootStrapDataGridOnValueList($title = 'SEARCH RESULT: (Total ' . $i . ")", $headlist = array('Dak ID', 'Subject', 'Received From', 'Letter No & Date', 'Disposed', 'Entry Date/Branch'), $align, $ValueList, 100, count($ValueList));
            else
                echo "<div align=center><font face=arial size=3 color=red>Record not Found</font></div>";
        }//tag==1
        ?>
    </body>
</html>