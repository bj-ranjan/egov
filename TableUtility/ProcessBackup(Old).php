<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
session_start();
//include("header.php");
?>
<script type=text/javascript language=javascript>
    function back()
    {
        //alert('ok');
        window.location="../mainmenu.php?tag=0";
        //myform.action="viewrecord.php?tag=0";
        //myform.submit();
    }

</script>

<body>
    <?php

    function send_message($id, $message, $progress) {
        $d = array('message' => $message, 'progress' => $progress);
        echo "id: $id" . PHP_EOL;
        echo "data: " . json_encode($d) . PHP_EOL;
        echo PHP_EOL;
        ob_flush();
        flush();
    }

    
    
    require_once '../class/class.pwd.php';
    require_once '../class/class.columns.php';
    require_once '../class/utility.class.php';
    require_once '../class/class.sentence.php';

    $objUtility = new Utility();
//Start Verify
    //$allowedroll = 2; //Change according to Business Logic
    //$roll = $objUtility->VerifyRoll();
    //if (($roll == -1) || ($roll > $allowedroll))
    //header('Location: ../Mainmenu.php?unauth=1');


    send_message(1, "start", 0);
    
    if (isset($_SESSION['Database']))
        $Database = $_SESSION['Database'];
    else
        $Database = "";

    $objCol = new Columns();

    $fkstr = "-- FOREIGN KEY\n\n";
    $objSen = new Sentence();
//$objUtility=new Utility();
//start

    if (isset($_POST['Single']))
        $single = 1;
    else
        $single = 0;

    $myDataType = array();

    $colArr = array();

    $t2 = date('H:i:s');

    $keyrow = array();
    if (isset($_POST['trow']))
        $trow = $_POST['trow'];
    else
        $trow = 0;

    $fname = "../database/Backup" . date('Ymd') . ".sql";
    $orgfname = $fname;


    if (isset($_POST['Packet']))
        $packet = $_POST['Packet'];
    else
        $packet = 200;

    $_SESSION['pac'] = $packet;

//FIRST OPEN THE FILE IN write mode

    $ts = fopen($fname, 'w') or die("can't open file");
    $mline = "-- DATABASE NAME: " . strtoupper($Database) . "\n\n";
    fwrite($ts, $mline);
    savesql($fname, "-- Date:-" . date('d/m/Y') . " Time:-" . date('h:i:s a'));
    savesql($fname, "\n");

//Next Open in Update Mode
    $ts = fopen($fname, 'a') or die("can't open file");


//Create Table
//echo $trow;

    
    send_message(1, "start", 5);
    $objCol->setTable_schema("egov");
    //$objCol->ConnectDB("information_schema");

    $trow = $objCol->getTableList();  //Retrive All Table

//$trow[1]="Poling";
    $TotalTable = count($trow);
    
     send_message(1, "start".$TotalTable, 15);
    
    
    $eventmsg = "";
    //for ($i = 0; $i < count($trow); $i++) {
 for ($i = 0; $i < 2; $i++) {

        $Tabname = strtolower($trow[$i]);
        $eventmsg = "Exporting <b>" . strtoupper($Tabname) . "</b> (Table-" . ($i + 1) . "/" . $TotalTable . ")";
        send_message(($i + 1), $eventmsg, 0);

            $colstr = "-- (";
//if($single==0)
//$firststr="INSERT INTO ".$Tabname." values" ;  
//else
            $firststr = "Insert Into " . $Tabname . "(";

            $selectstr = "select ";
            savesql($fname, "\n");
            savesql($fname, "-- \n");
            savesql($fname, "-- Structure for Table [" . strtoupper($Tabname) . "]\n");
            savesql($fname, "-- \n\n");
            $sqlstr = "CREATE TABLE IF NOT EXISTS " . $Tabname . "(\n";

            $colrow = $objCol->getColumnArray($Tabname);

            //echo "<br>".$Tabname." ".count($colrow)."<br>";

            $index = 0;
            for ($colind = 0; $colind < count($colrow); $colind++) {
//if($single==1)
//{
                $firststr = $firststr . $colrow[$colind]['Column_name'];
                if ($colind < count($colrow) - 1)
                    $firststr = $firststr . ",";
//}//For Single Query Line
                //Character_maximum_length
                $colArr[$index] = $colrow[$colind]['Column_name'];
                $index++;
                $colstr = $colstr . $colrow[$colind]['Column_name'];
                $selectstr = $selectstr . $colrow[$colind]['Column_name'];
                $sqlstr = $sqlstr . $colrow[$colind]['Column_name'] . " " . $colrow[$colind]['Data_type'];

                if (preg_match('/CHAR/', strtoupper($colrow[$colind]['Data_type'])))
                    $sqlstr = $sqlstr . "(" . $colrow[$colind]['Character_maximum_length'] . ")";


                if (strtoupper($colrow[$colind]['Data_type']) == "DECIMAL")
                    $sqlstr = $sqlstr . "(" . $colrow[$colind]['Numeric_precision'] . "," . $colrow[$colind]['Numeric_scale'] . ")";

//Character_set_name

                if (preg_match('/UTF/', strtoupper($colrow[$colind]['Character_set_name'])))
                    $sqlstr = $sqlstr . "  CHARACTER SET utf8 COLLATE utf8_unicode_ci ";

//Column_default Is_nullable
                if (strlen($colrow[$colind]['Column_default']) > 0)
                    $sqlstr = $sqlstr . "  DEFAULT '" . $colrow[$colind]['Column_default'] . "' ";

                if (strtoupper($colrow[$colind]['Is_nullable']) == "NO")
                    $sqlstr = $sqlstr . "  NOT NULL ";

                if (strlen($colrow[$colind]['Column_comment']) > 0)
                    $sqlstr = $sqlstr . "  COMMENT '" . $colrow[$colind]['Column_comment'] . "'";
//COMMENT 'Name in Unicode'

                if ($index < count($colrow)) {
                    $sqlstr = $sqlstr . ",\n";
                    $colstr = $colstr . ",";
                    $selectstr = $selectstr . ",";
                } else { //check for Primary Key
                    $colstr = $colstr . ")\n";
//$colstr=$colstr.") VALUES\n";
//echo $colind." ".count($keyrow);
//$selectstr=$selectstr." from ".$objCol->ble_schema().".".$Tabname;
                    $selectstr = $selectstr . " from " . $Tabname;

//echo $objCol->returnSql;
//echo "<br>".$Tabname." ".count($keyrow)."<br>";

                    $keyrow = $objCol->KeyList($Tabname);
                    if (count($keyrow) > 0) {
                        $sqlstr = $sqlstr . ",\n PRIMARY KEY (";
                        for ($keyind = 0; $keyind < count($keyrow); $keyind++) {
//echo $keyind.".".$keyrow[$keyind]." " ;   
                            $sqlstr = $sqlstr . $keyrow[$keyind];
                            if ($keyind < count($keyrow) - 1)
                                $sqlstr = $sqlstr . ",";
                        } //for loop key index
                        $sqlstr = $sqlstr . ")";
//echo $sqlstr."<br>";
                    } //if count(key)>0
//Find Unique Key
                    $Ur = $objCol->getConstarintList($Tabname, "UNIQUE");
                    if (count($Ur) > 0) {
                        for ($k = 0; $k < count($Ur); $k++) {
                            $flist = $objCol->getConstarintColumnList($Tabname, $Ur[$k]);
                            $flist = $objCol->ArrangeFiledList($flist);
                            $sqlstr.=",\nUnique key  " . $Ur[$k] . " (" . $flist . ")";
                        }//for Loop
                    }//if  

                    $sqlstr = $sqlstr . "\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;\n";
                }
            } //for loop for column array
//savesql($fname,$sqlstr); 
            fwrite($ts, $sqlstr);
//savesql($fname,"\n\n"); 
            fwrite($ts, "\n\n");


//if($single==1)
            $firststr = $firststr . ") values\n";

//Dump  Data
                fwrite($ts, "\n");
//savesql($fname,"-- \n");
                fwrite($ts, "-- \n");
//savesql($fname,"-- Dumping Data for Table [".strtoupper($Tabname)."]\n"); 
                fwrite($ts, "-- Dumping Data for Table [" . strtoupper($Tabname) . "]\n");
                fwrite($ts, "-- \n");

//if($single==0)
//{
//savesql($fname,"-- \n\n");
//savesql($fname,$colstr);
//fwrite($ts, "-- \n");
//fwrite($ts, $colstr);
//}
//savesql($fname,"\n");
                fwrite($ts, "\n");
//sql for Actual Data
//echo $selectstr;
//05062013


                $objUtility = new Utility();
//$result=$objCol->ExecuteQuery($selectstr);

                $j1 = $objCol->TotalRecords($Tabname);
                $j2 = 0;
                $j3 = 0;

                for ($k = 0; $k < $index; $k++)
                    $myDataType[$k] = strtoupper($objCol->DataType($Tabname, $colArr[$k]));


                $objCol->ConnectDB($Database); //Conenct to Actual Database
                if ($objCol->mysqli == false)
                    $result = mysql_query($selectstr);

                if ($objCol->mysqli == true)
                    $result = mysqli_query($objCol->con, $selectstr);

                $mainString = "";

                $mdatastr = $firststr; //Insert Command


                if (isset($_POST['Esc']))
                    $Esc = 1;
                else
                    $Esc = 0;


//FOLLOWING TWO LINE CODE GREATELY HELP TO REDUCE BAKUP TIME 
                if ($objCol->mysqli == false)
                    $ftype = 1;
                if ($objCol->mysqli == true) //mysqli
                    $ftype = 2;

                for ($k = 0; $k < $index; $k++)
//$myDataType[$k]=strtoupper($objCol->DataType($Tabname, $colArr[$k]));
                    $rowcount = 0;
                $maindatastr = "";
                $pac = 0;

                while ($datarow = FetchArray($result, $ftype)) {
                    $j2++; //Over ALL Record Count
                    $datastr = "(";
                    for ($k = 0; $k < $index; $k++) {   //Column Browse
                        $mdtype = $myDataType[$k];
                        if (preg_match('/CHAR/', $mdtype) == true) { //Remove Escape Character
                            $tempD = $datarow[$colArr[$k]];
                            $tempD1 = str_replace("'", "''", $tempD); //Remove Single Character
                            $tempD2 = str_replace(";", " ", $tempD1); //Remove Semi Colon
                            $tempD3 = str_replace("\\", "/", $tempD2); //Remove Double Slash to Front Slash
                            $ColData = str_replace("--", " ", $tempD3); //Remove Semi Colon
//echo $ColData;
                        }
                        else
                            $ColData = $datarow[$colArr[$k]];

                        if (strlen($ColData) > 0) {
                            if (substr($mdtype, -4) != "BLOB" && substr($mdtype, -6) != "BINARY") { //Image data is skipewd as NULL
                                $mdtype = substr($mdtype, -3);
                                if ($mdtype == "BIT" || $mdtype == "INT") {
                                    $datastr = $datastr . $ColData;
                                }
                                else
                                    $datastr = $datastr . "'" . $ColData . "'";
                            }
                            else
                                $datastr = $datastr . "NULL";
                        }
                        else
                            $datastr = $datastr . "NULL";

                        if ($k == ($index - 1)) //Last Column Reached ,Hence USe Bracket
                            $datastr = $datastr . ")";
                        else
                            $datastr = $datastr . ",";
                    } //for loop for column

                    if ($rowcount == $packet) { //packet size reached
                        fwrite($ts, $mdatastr); //Insert Statement 
                        fwrite($ts, $maindatastr);
                        fwrite($ts, "\n");
                        $rowcount = 0;
                        $maindatastr = "";
                    }//$rowcount==$packet
                    $maindatastr = $maindatastr . $datastr;
                    $rowcount++;

                    if ($rowcount < $packet && $j2 < $j1)
                        $maindatastr = $maindatastr . ",\n";
                    else
                        $maindatastr = $maindatastr . ";\n";

                    send_message($j2, $eventmsg, round(($j2 / $j1) * 100));
                }//while 
//Handle remaining Row
                if (strlen($maindatastr) > 0) {
                    fwrite($ts, $mdatastr); //Insert Statement    
                    fwrite($ts, $maindatastr);
                    fwrite($ts, "\n");
                }
                //completed one table  
                send_message("RESETBAR", $Tabname . " Completed ", 100);
   //completed Data Dumping
//Foreign Key
            $objCol->setTable_schema($Database);
            $objCol->ConnectDB("information_schema");
            $frow = $objCol->getConstarintName($Tabname);
//echo count($frow);
            if (count($frow) > 0) {
                $fkstr = $fkstr . "\n-- \n-- Foreign Key for Table [" . strtoupper($Tabname) . "]\n--\n\n";
//savesql($fname,"\n");
//savesql($fname,"-- \n");
//savesql($fname,"-- Foreign Key for Table ".$Tabname."\n");   
//savesql($fname,"-- \n\n");
                for ($find = 0; $find < count($frow); $find++) {
                    $constraint = $frow[$find];
                    $tr = $objCol->getRefColumnList($Tabname, $constraint);
                    $PLIST = $objCol->pkList;
                    $FLIST = $objCol->fkList;
                    $fkstr = $fkstr . "ALTER TABLE " . $Tabname . " ADD CONSTRAINT " . $constraint;
//savesql($fname,"ALTER TABLE ".$Tabname. " ADD CONSTRAINT ");
//savesql($fname,$constraint);
                    $fkstr = $fkstr . " FOREIGN KEY " . $PLIST . " REFERENCES " . $objCol->getRefTable($Tabname, $constraint) . $FLIST . ";\n";
//savesql($fname," FOREIGN KEY ".$PLIST." REFERENCES ".$objCol->getRefTable($Tabname, $constraint).$FLIST);
//savesql($fname,";\n");
                } //for loop for foreign key constraint
            }//count(frow()>0)
            } //for loop for table array
//
//Write Foreign Key String together at the end
    fwrite($ts, $fkstr);
    $t1 = date('H:i:s');
    $a = "Completed " . $TotalTable . " Tables in " . $objUtility->elapsedTimeMsg($t1, $t2);
    echo $objUtility->alert($a);

    $a.="<br><a href=" . $orgfname . ">Download File</a>";
    send_message('CLOSE', $a);
//send an event message

    //Delete Preveous Backup   
    $dd = date('Y-m-d');

    for ($ii = 3; $ii < 30; $ii++) { //Reserve these files
        $offset = -$ii;
        $fname = "Backup" . $objUtility->datePlusMinusWithoutDash($dd, $offset);
        $Fname = "../Database/" . $fname . ".sql";
//echo $Fname."<br>";
        if (file_exists($Fname)) {
            unlink($Fname);
//echo $fname."<br><br>";
        }
    }//for loop 

    $myname = "c:/" . $Database . ".sql";
    copy($orgfname, $myname);

    foreach (glob('../log/*.*') as $filename) { //Clear Log File
//echo $filename." ";    
        if (file_exists($filename))
            unlink($filename);
    } //for 
//else
//echo "not set";    
//function starts here
    function FetchArray($result, $type) {
        if ($type == "1")
            return(mysql_fetch_array($result));
        if ($type == "2")
            return(mysqli_fetch_array($result, MYSQLI_BOTH));
    }

    function savesql($fname, $mline) {
        $ts = fopen($fname, 'a') or die("can't open file");
        fwrite($ts, $mline);
//fclose($fname);
//return(filesize($fname)); //file size in bytes
    }

    function writesql($fname, $mline) {
        $ts = fopen($fname, 'w') or die("can't open file");
        fwrite($ts, $mline);
//fclose($fname);
//echo file_size($fname);
    }
    ?>
    <p align="center">    
        Backup File is Stored under Database Folder and in Hard Drive C:
        <br>
        <input type=button id=but1 value=Back onclick=back()>
    </p>
</body>
</html> 


