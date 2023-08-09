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


        function proceed()
        {
            if (DateValid('entry_date1', 1) && DateValid('entry_date2', 1))
            {
                document.getElementById('Save').disabled = true;
                document.getElementById('bck').disabled = true;
                startform.action = "ManageDak.php?tag=0";
                startform.submit();
            }
        }

        function newPopup(url, ht, wt, left, top) {
            popupWindow = window.open(
                    url, "popUpWindow", "height=" + ht + ",width=" + wt + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=no")
        }

        function mdate(id)
        {

            var d = document.getElementById(id).value;
            d = d.replace("//", "/");
            d = d.replace("-", "");
            d = d.replace(".", "");
            var ln = d.length;
            if (ln == 2 || ln == 5)
                d = d + "/";
            document.getElementById(id).value = d;
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
          //  alert('Document Loaded');

        }); //document ready

function act()
{
    alert(1);
}
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

            $objUtility = new Utility();

//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

            $objDak_entry = new Dak_status();
            if (isset($_GET['tag']))
                $code = $_GET['tag'];
            else
                $code = 0;


            if (isset($_SESSION['roll']))
                $roll = $_SESSION['roll'];
            else
                $roll = 3;



            if ($code == 0) { //Initial Loading
                if (isset($_SESSION['branch']))
                    $brcode = $_SESSION['branch'];
                else
                    $brcode = 0;

                $edate = '2019-10-31';  //Start from November 1, 2019

                $sdate = "01/" . date('m/Y');
                $entry_date1 = isset($_POST['entry_date1']) ? $_POST['entry_date1'] : $sdate;
                $entry_date2 = isset($_POST['entry_date2']) ? $_POST['entry_date2'] : date('d/m/Y');
                echo "<form name=startform action=ManageDak.php?tag=0  method=POST >";
                ?>
            <div align='center'>
                <img src="../image/header.jpg"  width="740px" height=90>
            </div>

            <div class="container">
                <div class="col-sm-12 text-left"> 
                    <div class="panel panel-success " >

                        <div class="panel-heading">
                            <p align="center"><font face=arial size=4>MONITOR  DAK STATUS</font></p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-sm-6">
                                <label>Entry Date From</label>
                                <!--
                                <img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate('entry_date1')" alt="Click Here to Pick Date"><br>
                                    !-->
                                <input type='text' class='form-control input' value='<?php echo $entry_date1; ?>' name='entry_date1'  id='entry_date1' placeholder='First Date'   maxlength='10'  onkeyup=mdate('entry_date1') />
                                <span class="text-danger"></span>                
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Entry Date To</label>
                                <!--
                                <img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate('entry_date2')" alt="Click Here to Pick Date"><br>
                                !-->
                                <input type='text' class='form-control input' value='<?php echo $entry_date2; ?>'  name='entry_date2'  id='entry_date2' placeholder='Last Date'   maxlength='10'  onkeyup=mdate('entry_date2') />
                                <span class="text-danger"></span>                
                            </div>
                            <div class='btn-group btn-group'>                                           
                                <div class="form-group col-sm-6">
                                    <button type="button" class="btn btn-danger btn"  name='Save' id='Save' onclick="proceed()">Go</button>     
                                </div> 
                                <div class="form-group col-sm-6">
                                    <button type="button"  class="btn btn-success btn" name='bck' id='bck' onclick="home(<?php echo $roll; ?>)">Home</button> 
                                </div>

                            </div>        
                            <?php
                            $dt1 = $objUtility->to_mysqldate($entry_date1);
                            $dt2 = $objUtility->to_mysqldate($entry_date2);


                            $row = $objDak_entry->FetchRecords("select branch_code,branch_name from branch_section where branch_code>0 order by branch_name");
                            $ValueList = array();

                            $sql = "select branch_code,count(*) from dak_entry where entry_date>'" . $edate . "' and entry_date < '" . $dt1 . "' group by branch_code";
                            $ER = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);

                            //echo $sql. count($PR);

                            $sql = "select branch_code,count(*) from dak_entry where entry_date>'" . $edate . "' and entry_date between '" . $dt1 . "' and '" . $dt2 . "' group by branch_code";
                            $PR = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);

                            $sql = "select branch_code,count(*) from dak_entry where action_taken='Y' and entry_date>'" . $edate . "' and entry_date < '" . $dt1 . "' group by branch_code";
                            $AC1 = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);

                            $sql = "select branch_code,count(*) from dak_entry where action_taken='Y' and entry_date>'" . $edate . "' and entry_date between '" . $dt1 . "' and '" . $dt2 . "' group by branch_code";
                            $AC2 = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);

                            $sql = "select branch_code,count(*) from dak_entry where disposed='Y' and entry_date>'" . $edate . "' and entry_date < '" . $dt1 . "' group by branch_code";
                            $D1 = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);

                            $sql = "select branch_code,count(*) from dak_entry where disposed='Y' and entry_date>'" . $edate . "' and entry_date between '" . $dt1 . "' and '" . $dt2 . "' group by branch_code";
                            $D2 = $objDak_entry->FetchRecordUsingIndexValueBySQL($sql);


                            $headlist = array("Branch Name", "Earlier Received", "Received During Period", "Action Taken", "Disposed");



                            echo "</form>";
                            echo "</div></div></div></div>";
                            ?>     
                            <div align="center">
                                <h3>Status of DAK during the Period from <?php echo $entry_date1; ?> to <?php echo $entry_date2; ?></h3>
                            </div>

                            <table class="table table-striped" >
                                <thead>
                                    <tr><td rowspan="2" bgcolor="#FFCCCC">Sl No</td><td rowspan="2" bgcolor="#FFCCCC">Branch Name</td><td colspan="2" bgcolor="#FFCCCC">Received</td><td colspan="2" bgcolor="#FFCCCC">Action Taken</td><td colspan="2" bgcolor="#FFCCCC">Disposed</td></tr>   
                                    <tr><td bgcolor="#CCFFCC">Earlier</td><td bgcolor="#CCFFCC">During Period</td><td bgcolor="#CCFFFF">Earlier</td><td bgcolor="#CCFFFF">During Period</td><td bgcolor="#CCFF99">Earlier</td><td bgcolor="#CCFF99">During Period</td></tr>                    
                                </thead>
                                <?php
                                $tot = array(0, 0, 0, 0, 0, 0, 0);

                                for ($i = 0; $i < count($row); $i++) {
                                    $brcode = $row[$i][0];

                                    $temp = "ListDak.php?branch=" . $brcode . "&entry_date1=" . $entry_date1 . "&entry_date2=" . $entry_date2;

                                    $url1 = $temp . "&type=1";
                                    $url2 = $temp . "&type=2";
                                    $url3 = $temp . "&type=3";

                                    $ValueList[$i][0] = $row[$i][1];
                                    $ValueList[$i][1] = isset($ER[$brcode]) ? $ER[$brcode] : '0';
                                    $v2 = $ValueList[$i][2] = isset($PR[$brcode]) ? $PR[$brcode] : '0';

                                    if ($ValueList[$i][2] > 0) {
                                        $v2 = "<a href='#' onclick=newPopup('" . $url1 . "',650,790,100,80)>" . $ValueList[$i][2] . "</a>";
                                    }

                                    $ValueList[$i][3] = isset($AC1[$brcode]) ? $AC1[$brcode] : '0';
                                    $v4 = $ValueList[$i][4] = isset($AC2[$brcode]) ? $AC2[$brcode] : '0';

                                    if ($ValueList[$i][4] > 0) {
                                        $v4 = "<a href='#' onclick=newPopup('" . $url2 . "',650,790,100,80)>" . $ValueList[$i][4] . "</a>";
                                    }


                                    $ValueList[$i][5] = isset($D1[$brcode]) ? $D1[$brcode] : '0';
                                    $v6 = $ValueList[$i][6] = isset($D2[$brcode]) ? $D2[$brcode] : '0';

                                    if ($ValueList[$i][6] > 0) {
                                        $v6 = "<a href='#' onclick=newPopup('" . $url3 . "',650,790,100,80)>" . $ValueList[$i][6] . "</a>";
                                    }

                                    for ($j = 1; $j <= 6; $j++)
                                        $tot[$j]+=$ValueList[$i][$j];
                                    ?>
                                    <tr><td><?php echo ($i + 1); ?></td><td><?php echo $ValueList[$i][0]; ?></td><td><?php echo $ValueList[$i][1]; ?></td><td><?php echo $v2; ?></td><td><?php echo $ValueList[$i][3]; ?></td><td><?php echo $v4; ?></td><td><?php echo $ValueList[$i][5]; ?></td><td><?php echo $v6; ?></td></tr>                    
                                    <?php
                                } //for loop
                                ?>

                                <tr><td bgcolor="#99CCCC" COLSPAN="2">TOTAL</td>

                                    <td bgcolor="#99CCCC"><b><?php echo $tot[1]; ?></b></td>
                                    <td bgcolor="#99CCCC"><b><?php echo $tot[2]; ?></b></td>
                                    <td bgcolor="#99CCCC"><b><?php echo $tot[3]; ?></b></td>
                                    <td bgcolor="#99CCCC"><b><?php echo $tot[4]; ?></b></td>
                                    <td bgcolor="#99CCCC"><b><?php echo $tot[5]; ?></b></td>
                                    <td bgcolor="#99CCCC"><b><?php echo $tot[6]; ?></b></td>

                                </tr>                    

                            </table>

                            <?php
                            // $objDak_entry->genBootStrapDataGridOnValueList("Status during " . $entry_date1 . " to " . $entry_date2, $headlist, $align = array(1, 1, 1, 1, 1, 1), $ValueList, 0);
                        } //$code=0
                        ?>
                        </form>
                        </body>
                        </html>
