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

        function validate(i)
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
                if (isdate(ddate, 1) == true && f != "")
                {
                    if (CompareDate(ddate, edate) == -1 || CompareDate(ddate, today) == 1)
                    {
                        ok = false;
                    }                    
                }//isdate(ddate)==tr   
                else
                    ok=false;

     

            if (ok == true)
            {
                 alert('ok')
                myform.action = "Editdak.php?tag=2&line="+i;
                myform.submit();
            }
            else {
                if (f == "")
                    alert('Check Notes ');
                else
                    alert('Check Date  ' + ddate);
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
            require_once './class/class.dak.php';
            require_once '../class/utility.class.php';
            require_once '../class/class.branch_section.php';
            $objUtility = new Utility();
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

            $objDak_entry = new Dak_entry();
            if (isset($_GET['tag']))
                $code = $_GET['tag'];
            else
                $code = 0;


            if (isset($_SESSION['roll']))
                $roll = $_SESSION['roll'];
            else
                $roll = 3;



            if ($code == 0) { //Initial Loading
                if (isset($_SESSION['Branch']))
                    $brcode = $_SESSION['Branch'];
                else
                    $brcode = 0;

                if (isset($_SESSION['branch']))
                    $mbranch = $_SESSION['branch'];
                else
                    $mbranch = -1;
                ?>
            <div align='center'>
                <img src="../image/header.jpg"  width="740px" height=90>
            </div>

            <div class="container">
                <div class="col-sm-12 text-left"> 
                    <div class="panel panel-success " >

                        <div class="panel-heading">
                            <p align="center"><font face=arial size=4>UPDATE DISPOSAL STATUS</font></p>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo "<form name=startform action=Editdak.php?tag=1  method=POST >";
                            ?>
                            <?php
                            $condition = array(1 => '=', 2 => '<', 3 => '>', 4 => '<>');
                            ?>
                            <div class="form-group col-sm-12">
                                <label>Year:</label>

                                <input type=text class='form-control input-lg' name=Yr  id=Yr value="<?php echo date('Y'); ?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Select Branch:</label>
                                <select name="Branch" id="Branch" class="form-control input-lg">                   
    <?php
    if ($roll == 0)
        $cond = " 1=1";
    if ($roll == 1)
        $cond = " Branch_code>0";

    if ($roll == 3) {
        if ($mbranch == 0)
            $cond = " Branch_code>0";
        else
            $cond = " Branch_code=" . $mbranch;
    }

    echo $brcode . "<br>" . $cond;

    $objBranch_section = new Branch_section();
    $objBranch_section->setCondString($cond);
    $row1 = $objBranch_section->getRow();
    for ($jj = 0; $jj < count($row1); $jj++) {
        if ($brcode == $row1[$jj]['Branch_code']) {
            ?>
                                            <option selected value="<?php echo $row1[$jj]['Branch_code']; ?>"><?php echo $row1[$jj]['Branch_name']; ?>
                                            <?php
                                        } else {
                                            ?>
                                            <option selected value="<?php echo $row1[$jj]['Branch_code']; ?>"><?php echo $row1[$jj]['Branch_name']; ?>
                                            <?php
                                        }
                                    }
                                    ?>    
                                </select>
                            </div>


                            <div class='btn-group btn-group'>                                           

                                        <?php
                                        if ($roll == 3 || $roll == 0) {
                                            ?>
                                    <div class="form-group col-sm-4">
                                        <button type="button" class="btn btn-primary btn" onclick="submit()">GO</button> 
                                    </div>
        <?php
    }
    ?>

                                <div class="form-group col-sm-4">
                                    <button type="button" class="btn btn-danger btn"  name=backS id=backS onclick="proceed()">View Status</button>     
                                </div> 
                                <div class="form-group col-sm-4">
                                    <button type="button"  class="btn btn-success btn" onclick="home(<?php echo $roll; ?>)">Home</button> 
                                </div>   
                            </div>        
                                <?php
                                echo "</form>";
                                echo "</div></div></div></div>";
                            } //$code=0

                            if ($code == 1) { //Next Loading aftre postback
                                $bname = "";
                                $sql = "";
                                if (strlen($_POST['Yr']) > 0)
                                    $sql = $sql . "Recvd_yr='" . $_POST['Yr'] . "' and ";
                                if (strlen($_POST['Branch']) > 0)
                                    $sql = $sql . "Branch_code=" . $_POST['Branch'] . " and ";
                                $sql = $sql . " Disposed='N' and reply='Yes' and Priority in(1,2,3,4) order by entry_date,Dak_id";
                                $objBranch_section = new Branch_section();
                                $objBranch_section->setBranch_code($_POST['Branch']);
                                if ($objBranch_section->EditRecord())
                                    $bname = strtoupper($objBranch_section->getBranch_name());

                                $_SESSION['Branch'] = $_POST['Branch'];
                                echo "<div align=center><h1>";
                                 echo "Branch Name:". $bname; 
                                 echo "</h1></div>";
                                ?>
                            <table class='table table-striped'>
                                <form name=myform action=""  method=POST >
                                    <tr>
                                        <td align=center  colspan="5" bgcolor="blue"><font size=2 face=arial color=white>
                                            <b>UPDATION OF DAK DISPOSAL</b>
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
                                            <input type=hidden name=Recvd_yr  value="<?php echo $_POST['Yr']; ?>">
                                            <input type=hidden name=Branch_code  value="<?php echo $_POST['Branch']; ?>">
                                            <input type=hidden size=6 name=Today id=Today  value="<?php echo date('d/m/Y'); ?>">
                                        </td>
                                    </tr>
    <?php
    $rowcount = 0;
    $objDak_entry->setCondString($sql);
    $row = $objDak_entry->getAllRecord();
    for ($ii = 0; $ii < count($row); $ii++) {
        $rowcount++;
        ?>
                                        <tr>
        <?php $Dak_id = "Dak_id" . $rowcount; ?>
                                            <td align=center><font face="arial" size="2">
                                                <input type=hidden size="4" name="<?php echo $Dak_id; ?>" size=5    value="<?php echo $row[$ii]['Dak_id']; ?>" style="font-family: Arial;background-color:#FFCC99;color:black;font-size: 18px" readonly>
                                        <?php
                                        echo $row[$ii]['Dak_id'] . "<br>";
                                        switch ($row[$ii]['Priority']) {
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
                                        }//end switch
                                        ?>
                                            </td>
                                                <?php $Subject = "Subject" . $rowcount; ?>
                                            <td align=left><font face="arial" size="2"><div align=justify>
                                                <?php echo $row[$ii]['Subject']; ?>
                                                </div></td>
                                            <td align=left><font face="arial" size="2">
                                                <?php
                                                echo $row[$ii]['Ltr_no'] . " dtd ";
                                                echo $objUtility->to_date($row[$ii]['Ltr_dt']);
                                                ?>
                                            </td>
                                                <?php $Dispose_date = "Dispose_date" . $rowcount; ?>
                                            <td align=left><font color='grey' size='2'>
                                                <?php
                                                    $Edate = $objUtility->to_date($row[$ii]['Entry_date']);
                                                    echo $Edate;
                                                    ?><br>
                                                <input type=text size="7" maxlength="10" name="<?php echo $Dispose_date; ?>"  id="<?php echo $Dispose_date; ?>" size=10  value="">
                                                <img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(<?php echo $Dispose_date; ?>);" alt="Click Here to Pick Date"><br>
                                                    </font>
                                            </td>
                                            <td align=center>
                                                <?php
//echo $objUtility->to_date($row[$ii]['Target_date']);
//echo "<br>";
                                                ?>
        <?php $Notes = "Notes" . $rowcount; ?>
                                                <textarea rows=3 cols=60 name="<?php echo $Notes; ?>"  id="<?php echo $Notes; ?>"  placeholder="Write notes of Maximum 150 character">
</textarea>

                                                <?php $Entry_date = "Entry_date" . $rowcount;
                                                ?>
                                                <input type=hidden name="<?php echo $Entry_date; ?>" id="<?php echo $Entry_date; ?>" size=10  value="<?php echo $Edate; ?>">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"  name="Save<?php echo $rowcount; ?>"  id="Save<?php echo $rowcount; ?>" onclick="validate(<?php echo $rowcount; ?>)">Update Action</button>     
                                      
                                            </td>
                                        </tr>
                                                <?php
                                            } //while
                                            $_SESSION['rowcount'] = $rowcount;
                                            ?>                                  
                                                                                   

                                     
                            </table>
    <?php
}//$code==1


if ($code == 2) { //PostBack Submit
//echo $_SESSION['rowcount'];
    
    
    $line=isset($_GET['line'])?$_GET['line']:1;
    
    if (isset($_POST['Recvd_yr']))
        $Yr = $_POST['Recvd_yr'];
    else
        $Yr = 0;

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

        $sql = "update dak_entry set Disposed='Y'";
        $sql = $sql . ",Updation_date='" . date('Y-m-d') . "'";

        $Dak_id = "Dak_id" . $ind;
        $Dak_id = $_POST[$Dak_id];

        $cond = " where Dak_id=" . $Dak_id . " and Recvd_yr='" . $Yr . "'";


        $Dispose_date = "Dispose_date" . $ind;

        if (isset($_POST[$Dispose_date])) {
            $ddate = $_POST[$Dispose_date];
//echo $ind." ".$ddate." ".$objUtility->to_mysqldate($_POST[$ddate])."<br>";
            if ($objUtility->isdate($ddate)) {
                $ddate = $objUtility->to_mysqldate($ddate);
                $sql = $sql . ",Dispose_date='" . $ddate . "' ";
//echo $objUtility->alert($sql);
            }
        } //isset(disposed date


        $Notes = "Notes" . $ind;

        if (isset($_POST[$Notes])) {
            $text = $_POST[$Notes]; //."<br>".$ip." ".$uid; 
            $sql = $sql . ",notes='" . $text . "'" . $cond;
            if ($objDak_entry->ExecuteQuery($sql))
                $upd++;
        } //isset(disposed date
        
        //ll
        //
        //
        
   // }//for loop
    $a = "Updated " . $upd . " Record";
    $page = "EditDak.php?tag=0";
    if ($upd > 0)
        echo $objUtility->AlertNRedirect($a, $page);
}//code=2
?>
                        </p>
                        </form>
                        </body>
                        </html>
