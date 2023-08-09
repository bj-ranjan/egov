<?php

//http://css3gen.com/button-generator/   Button Generator

class CommonParameter {

    //Bit handling
    private $idletime = 1000;
    public $AutoBackupInterval = 21600; //6 Hours 60X60x6
    public $multiple = false;
    public $Alert_Message_Through_JSON = "";
    public $DefaultMark = "Double";
    public $returnTD;
    public $ServerRootFolder = "WWW"; //or HTDOCS in case of XAMPP
    public $IsciiExist = true;
    public $TDHeight = 0;
    public $RowHeight = 30;
    public $GlobalDataType = array();
    public $GlobalPattern = array();
    public $False = "false";
    public $True = "true";
    public $BooleanTrue = "1"; //boolean field
    public $BooleanFalse = "0"; //boolean field
    public $PollCategory = array(1 => "Pr", 2 => "P1", 3 => "P2", 4 => "P3", 5 => "P4", 10 => "Vo");
    public $SelectBoxSize = 0;
    public $bcol = "white";
    public $fcol = "black";
    public $font = 14;
    public $DefaultOpt = "0";
    public $DefaultOptDetail = "-Select-";
    public $DefaultOptRequired = 1;
    public $TableTitleFont = 2;
    public $TableHeadFont = 2;
    public $TableBodyFont = 2;
    public $TableHeadColor = "#CCCC99";
    public $TableAutoSerialColumnRequired = 1; //add a serial column on datagrid output
    public $TableBoarder = 1;
    public $rowCommitted;
    public $returnSql;
    public $Available;
    public $colFetched;
    public $mAlign = array("", "left", "center", "right", "justify");
    public $Quotation = array(); //If Quotatiom mark is to be appended in dynamic SQL for varchar/number/bit etc
    public $BackEndDetail = array("My SQL", "Postgre SQL", "SQL Server");
    public $BackEndCode;
    public $pkList;
    public $fkList;
    public $PdfOutput = true;
    public $HideObject = false; //if true ,Hides some classes on logout and show on login
    private $Table_schema;
    private $IP = "10.177.92.2"; //Generally Developers Machine IP for Critical Operation
    private $TdRadius = array("top-left" => 0, "top-right" => 0, "bottom-left" => 0, "bottom-right" => 0);
    private $BorderWidth = array("left" => 0, "right" => 0, "bottom" => 0, "top" => 0);
    private $TDBackGround = "";
    private $HtmlComment="";
    private $PlaceHolderText="";
    public $mDays=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
    
    
      
    public function CurrentSessionID()
    {
        if (isset($_SESSION['sid']))
            $id=$_SESSION['sid'];
        else
            $id="0";
        
        if(!is_numeric($id))
        $id="0";
        
        return($id);
    }
    
    public function CurrentRoll() {
//Use your Business Logic  to Verify Every page(Use/Password,Ip etc))
        if (isset($_SESSION['roll']))
            $t = $_SESSION['roll'];
        else
            $t = -1;

         if(!is_numeric($t))
         $t = -1;
        
        return($t);
    }

    public function CurrentUid()
    {
        if (isset($_SESSION['uid']))
            $id=$_SESSION['uid'];
        else
            $id='-';
        if(strlen($id)==0)
        $id='-';
        
        return($id);
    }
    
    
    public function BackUpDue() {
        $path = $this->ApplicationFolder();
        $fname = $path . "/LastBackup.txt";
        $date = $this->ReadF($fname);
        $date2 = substr($date, 0, 10);
        if ($date2 == date('d-m-Y'))
            $due = false;
        else
            $due = true;
        $time = "";
        if ($due == false) { //check time
            $time = substr($date, -8);
            $elapsed = $this->elapsedTimeInSecond(date('H:i:s'), $time);
            if ($elapsed > $this->AutoBackupInterval)
                $due = true;
        }
        return($due);
    }

//backupdue

    public function BackupBusy() {
        $a=$this->FolderLevel($Level);
        $busy = false;

        $ip = $this->MyClientIP();
        //$this->AppendF($Level."TT.txt", $ip.date('H:i:s'));
        $file=$Level."backupprocess.txt";
         if(file_exists($file))       
         {
         $aip=trim($this->ReadF( $file));    
         //$this->AppendF($Level."TT.txt", $aip."-".$ip );
         if($aip!=$ip && $aip!="X")
          $busy=true;    
         }
         return($busy);
    }

    
    public function LockBackup() {
        $a=$this->FolderLevel($Level);
        $ip=$this->MyClientIP();
        $file=$Level."backupprocess.txt";
         if(file_exists($file))       
         {
         $aip=trim($this->ReadF( $file));    
         if($aip=="X")
         $this->WriteF ($file, $ip);
         }
        else
          $this->WriteF ($file, $ip);   
           
    }

    public function UnlockBackup($a=0) {
                $ip = $this->MyClientIP();
                $a=$this->FolderLevel($Level);
                $file=$Level."backupprocess.txt";
         if(file_exists($file))       
         {
         $aip=trim($this->ReadF( $file));    
         if($aip==$ip)
         $this->WriteF ($file, "X");
         }
                
     }
    
    
    public function SaveQueryAsTextFile($sql) {
        if ($this->BackEndCode <= 1)
            $sql = $sql . ";";
        else
            $sql = $sql . "\nGO";
        $file = $this->ApplicationFolder() . "/log/" . date('dmY') . "query.sql";
        if ($this->inStr(strtolower($sql), "userlog") == -1 && $this->inStr(strtolower($sql), "pwd") == -1)
            $this->AppendF($file, $sql);
    }

    //savequeryastextfikle
public function setHtmlComment($str="")
{
    $this->HtmlComment=$str;
}

public function setPlaceHolder($str="")
{
    $this->PlaceHolderText=$str;
}


public function getHtmlComment()
{
    return($this->HtmlComment);
}


    public function TimeOut(&$time) {
        date_default_timezone_set("Asia/kolkata");
        $t1 = date('H:i:s');
        if (isset($_SESSION['LatestTime']))
            $t2 = $_SESSION['LatestTime'];
        else
            $t2 = date('H:i:s');


        $time = $this->elapsedTimeInSecond($t1, $t2);

        //echo $t1."-".$t2."=".$time;

        if ($time > $this->idletime)
            return(true);
        else
            return(false);
    }

    
    

    public function ImageData($dtype) {
        $imgdata = strtoupper($dtype);
        $aaa = 0;
        if (preg_match('/BLOB/', $imgdata))
            $aaa++;
        if (preg_match('/BINARY/', $imgdata))
            $aaa++;
        if (preg_match('/BYTEA/', $imgdata))
            $aaa++;
        if (preg_match('/IMAGE/', $imgdata))
            $aaa++;
        return($aaa);
    }

    public function BackGroundClass($background) {
        $this->TDBackGround = $background;
    }

    public function DivClass($id, $align, $class) {
        $mal = $this->mAlign[$align];
        echo "<div id=" . chr(34) . $id . chr(34) . "  align=" . chr(34) . $mal . chr(34) . " class=" . chr(34) . $class . chr(34) . ">";
    }

    public function DivStart($id, $align) {
        $mal = $this->mAlign[$align];
        echo "<div id=" . chr(34) . $id . chr(34) . "  align=" . chr(34) . $mal . chr(34) . ">";
    }

    public function DivEnd() {
        echo "</div>";
    }

    public function BoarderRadius($topL, $topR, $botR, $botL) {
        $this->TdRadius['top-left'] = $topL;
        $this->TdRadius['top-right'] = $topR;
        $this->TdRadius['bottom-right'] = $botR;
        $this->TdRadius['bottom-left'] = $botL;
    }

    public function BoarderWidth($left, $right, $top, $bottom) {
        $this->BorderWidth['left'] = $left;
        $this->BorderWidth['right'] = $right;
        $this->BorderWidth['top'] = $top;
        $this->BorderWidth['bottom'] = $bottom;
    }

    public function MyClientIP() {
        $ip = "127.0.0.1";
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $rip = explode(".", $ip);
            $ip = "";
            $a = 0;
            for ($i = 0; $i < 4; $i++) {
                if ($a > 0)
                    $ip.=".";
                if (isset($rip[$i])) {
                    if (is_numeric($rip[$i])) {
                        $ip.=$rip[$i];
                        $a++;
                    }
                }
            }
        }
        if (strlen($ip) == 0)
            $ip = "127.0.0.1";
        return($ip);
    }

    public function IFPost($postvar, &$value) {
        if (isset($_POST[$postvar])) {
            $value = $_POST[$postvar];
            return(true);
        } else
            return(false);
    }

    public function ReturnPost($postvar, $value1, $value2) {
        if (isset($_POST[$postvar]))
            return($value1);
        else
            return($value2);
    }

    public function IFGet($getvar, &$value) {
        if (isset($_GET[$getvar])) {
            $value = $_GET[$getvar];
            return(true);
        } else
            return(false);
    }

    public function ReturnGet($getvar, $value1, $value2) {
        if (isset($_GET[$getvar]))
            return($value1);
        else
            return($value2);
    }

    public function getDEO() {
        if (isset($_SESSION['Deo']))
            return($_SESSION['Deo']);
        else
            return("1");
    }

    public function RemoveBlankSpace($str) {
        $temp = "";
        $str = trim($str);
        $row = explode(" ", $str);
        for ($i = 0; $i < count($row); $i++)
            $temp.=trim($row[$i]);
        $temp = trim($temp);
        return($temp);
    }

    public function FolderLevel(&$Level) {
        $dir = "";
        $Level = "";
        $path = strtoupper($this->CurrentDir());
        $row = explode("/", $path);
        $a = 0;
        $started = false;
        for ($i = 0; $i < count($row); $i++) {
            if ($row[$i] == "WWW" || $row[$i] == "HTDOCS")
                $started = true;
            else {
                if ($started)
                    $a++;
            }
        }//for loop
        for ($i = 1; $i < $a; $i++)
            $Level.="../";
        return($a);
    }

    public function ApplicationFolder() {
        $dir = "";
        $path = strtoupper($this->CurrentDir());
        //HTDOCS or WWW
        if (preg_match('/WWW/', $path))
            $this->ServerRootFolder = "WWW";
        if (preg_match('/HTDOCS/', $path))
            $this->ServerRootFolder = "HTDOCS";

        $row = explode("/", $path);
        for ($i = 0; $i < count($row); $i++) {
            if ($row[$i] == $this->ServerRootFolder) {
                if (isset($row[$i + 1]))
                    $dir = $row[$i + 1];
            }
        }
        $dir = $this->RootDir() . "/" . $dir;
        return($dir);
    }

    

    public function RootDir() {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $mpath = str_replace("\\", "/", $path);  //Replace Back Slash with Front Slash
        if (substr($mpath, -1) == "/")
            $mpath = substr($mpath, 0, strlen($mpath) - 1);
        return($mpath);
    }

    public function CurrentDir() {
        $path = getcwd();
        $fpath = "";
        $mpath = str_replace("\\", "/", $path);  //Replace Back Slash with Front Slash
        if (substr($mpath, -1) == "/")
            $mpath = substr($mpath, 0, strlen($mpath) - 1);
        return($mpath);
    }

    public function setTable_schema($Database) {
        $this->Table_schema = $Database;
    }

    public function getTable_schema() {
        return($this->Table_schema);
    }

    public function CreateLogFile($tbl, $line, $level, $type) {
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

    public function validMySqlDate(&$fld) {
        $dt = $fld;
        $yr = substr($fld, 0, 4);
        $slash = substr($fld, 4, 1);
        $date = "";
//echo $fld." ".$yr." ".$slash."<br>";
        if (is_numeric($yr) && ($slash == "/" || $slash == "-" || $slash == "."))
            $date = $this->to_date($dt);

        if (strlen($date) == 10) {
            $fld = $date;
            return(true);
        } else
            return(false);
    }

    public function to_date($mydate) {
        $dt = array();
        $dt = "";
        if (strlen($mydate) >= 10) {
            $md = substr($mydate, 0, 10);
            if ($this->inStr($md, "-") > 0)
                $dt = explode("-", $md);

            if ($this->inStr($md, "/") > 0)
                $dt = explode("/", $md);

            if ($this->inStr($md, ".") > 0)
                $dt = explode(".", $md);

            if (isset($dt[2]) && isset($dt[1]) && isset($dt[0])) {
                $dt = $dt[2] . "/" . $dt[1] . "/" . $dt[0];
            } else
                $dt = $mydate;
        }
        return($dt);
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
//HTML BOX
    public function genDataGridNew($title, $headlist, $align, $ValueList, $width, $records, $type = 0) {
        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');

        $cnt = count($ValueList);
        $numcol = count($headlist);
        //$this->TableBoarder=1;
        if ($this->TableAutoSerialColumnRequired == 1)
            $tag = 1;
        else
            $tag = 0;

        if ($type == 0) {
            $classname1 = "background11";
            $classname2 = "background12";
            $headcol = "#999999";
        } else {
            $classname1 = "background" . $type;
            $classname2 = "background" . $type;
        }
        $headcol = "#3399FF";

        $title = "<div align=center class=myShadow>" . $title . "</div>";

        if (strlen($title) > 0)
            $this->TextHeader($title, $width, 2, "white", "black", $this->TableHeadFont);

        if ($cnt > 0) {
            //if ($type <= 1)
            echo "<table border=0  cellspacing='1' align=" . chr(34) . "center" . chr(34) . "  width=" . $width . "%>";
            //else
            //echo "<table border=0 cellpadding=2 cellspacing=1  align=" . chr(34) . "center" . chr(34) . "  width=" . $width . "%>";

            echo "<Thead><tr>";
            if ($this->TableAutoSerialColumnRequired == 1) {
                echo "<td align=center style='border-radius:10px 0 0 0;' bgcolor=" . $headcol . "><font face=arial size=2 color='white'><b>SlNo</b></td>";
            }
            for ($i = 0; $i < count($headlist); $i++) {
                $style = "";
                if ($i == 0 && $this->TableAutoSerialColumnRequired == 0)
                    $style = " style='border-radius:10px 0 0 0;' ";
                if ($i == (count($headlist) - 1))
                    $style = " style='border-radius:0 10px 0 0;' ";

                echo "<td " . $style . " bgcolor=" . $headcol . " align=center><font face=arial size=2 color='white'><b>" . $headlist[$i] . "</b></td>";
            }
            echo "</tr></Thead>";
//end header
        }//cnt>0


        $mstyle = " style='border-radius:3px 3px 3px 3px;' ";

        for ($ind = 0; $ind < count($ValueList); $ind++) {
//$tcol=$this->checkList($ind,$ValueList,$numcol);

            $sl = ($ind + 1);
            if ($ind == 0)
                echo "<tbody>";
            if ($this->IsEven($ind))
                $classname = $classname1;
            else
                $classname = $classname2;
            echo "<tr class=" . chr(34) . $classname . chr(34) . ">";

            if ($this->TableAutoSerialColumnRequired == 1) {
                if ($ind <= ($records - 1))
                    echo "<td height='22' align='center' " . $mstyle . ">" . $sl . "</td>";
                else
                    echo "<td height='22' align='center' " . $mstyle . ">&nbsp;</td>";
            }

            for ($i = 0; $i < $numcol; $i++) {
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = $tAlign[$align[$i]];
                    else
                        $malign = "left";
                } else
                    $malign = "left";

                if (isset($ValueList[$ind][$i]))
                    $fld = $ValueList[$ind][$i];
                else
                    $fld = "&nbsp;";
                echo "<td align=" . $malign . $mstyle . " >" . $fld . "</td>";
            }
            echo "</tr>";
        }//end Row browse
        echo "</tbody>";
        echo "</table>";
    }

    public function genDataGridOnValueList($title, $headlist, $align, $ValueList, $width, $records) {
        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');

        $cnt = count($ValueList);
        $numcol = count($headlist);
        //$this->TableBoarder=1;
        if ($this->TableAutoSerialColumnRequired == 1)
            $tag = 1;
        else
            $tag = 0;
        if ($cnt > 0) {
            echo "<table border=" . $this->TableBoarder . " align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=" . $width . "%>";
            if (strlen($title) > 0) {
                echo "<tr><td align=center  colspan=" . ($numcol + $tag) . "><font face=arial size=" . $this->TableTitleFont . ">" . $title . "</td></tr>";
            }
            echo "<tr>";

            if ($this->TableAutoSerialColumnRequired == 1)
                echo "<td align=center bgcolor=" . chr(34) . $this->TableHeadColor . chr(34) . "><font face=arial size=" . $this->TableHeadFont . ">SlNo</td>";

            for ($i = 0; $i < count($headlist); $i++) {
                echo "<td align=center bgcolor=" . chr(34) . $this->TableHeadColor . chr(34) . "><font face=arial size=" . $this->TableHeadFont . ">" . $headlist[$i] . "</td>";
            }
            echo "</tr></Thead>";
//end header
        }//cnt>0
        for ($ind = 0; $ind < count($ValueList); $ind++) {
//$tcol=$this->checkList($ind,$ValueList,$numcol);

            $sl = ($ind + 1);
            echo "<tr>";

            if ($this->TableAutoSerialColumnRequired == 1) {
                if ($ind <= ($records - 1))
                    echo "<td align=center ><font face=arial size=" . $this->TableBodyFont . ">" . $sl . "</td>";
                else
                    echo "<td align=center ><font face=arial size=2>&nbsp;</td>";
            }

            for ($i = 0; $i < $numcol; $i++) {
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = $tAlign[$align[$i]];
                    else
                        $malign = "left";
                } else
                    $malign = "left";

                if (isset($ValueList[$ind][$i]))
                    $fld = $ValueList[$ind][$i];
                else
                    $fld = "&nbsp;";
                echo "<td align=" . $malign . " ><font face=arial size=" . $this->TableBodyFont . ">" . $fld . "</td>";
            }
            echo "</tr>";
        }//end Row browse
        echo "</table>";
    }

//genDataGrid


    public function genDatePicker($Fld, $level) {
        $path="";
        if ($level == 1)
            $path = "./datepicker/images/calendar.png";
        if ($level == 2)
            $path = "../datepicker/images/calendar.png";
        if ($level == 3)
            $path = "../../datepicker/images/calendar.png";
        ?>
        <img src=<?php echo $path; ?> width=25 height=25 onClick="GetDate(<?php echo $Fld; ?>);" alt="Click Here to Pick Date">
        <?php
    }

//genDatePicker

    public function CheckBox($id, $val, $bcol, $fcol, $font, $function, $mandatory) {
        //DATABASE INDEPENDANT
        if ($val == true)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;padding: 4px 4px 4px 4px;border-radius: 5px 5 px 5px 5px;";
        echo "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        if ($mandatory)
            echo "<font color=red size=3 face=arial><b>*</b></font>";
    }

//genCheckbox

    public function genInputBox($id, $val = "", $size = 10, $maxlength = 10, $bcol = "white", $fcol = "black", $font = 12, $function = "", $mandatory = 0) {
        $property = array("id" => $id, "val" => $val, "size" => $size, "maxlength" => $maxlength, "bcol" => $bcol, "fcol" => $fcol, "font" => $font, "function" => $function, "mandatory" => $mandatory);
        echo $this->newInputBox($property);
    }

//genInputBox
    public function genCSSButton($id, $val, $width, $colortag, $font, $type, $function) {
        $bclass = array("button-pink", "button-green", "button-grey", "button-red", "button-new", "button-green-blue", "button-mix", "button-blue-green", "button-light-green");
        if ($type < 0 || $type > 8)
            $type = 0;
        if ($width > 0 && ($width < 60 || $width > 120))
            $width = 90;

        if ($colortag < 0 || $colortag > 4)
            $colortag = 0;

        if (($type == 1 || $type == 2) && $colortag != 0)
            $colortag = 3;
        if ($type == 3 && $colortag != 0)
            $colortag = 1;



        if ($font != 8 && $font != 10 && $font !== 12 && $font !== 14 && $font !== 16 && $font !== 18 && $font !== 20)
            $font = 12;

        if ($type <= 3)
            $classname = $bclass[$type] . "  button-col" . $colortag . " button-font" . $font;
        else
            $classname = $bclass[$type] . " button-font" . $font;

        if ($width > 0)
            $classname.= " button-width" . $width;

//echo $classname."<br>";
        echo "<input type=button class=" . chr(34) . $classname . chr(34) . " value=" . chr(34) . $val . chr(34) . " name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " " . $function . ">";
        echo "&nbsp;&nbsp;";
    }

    public function genButton($id, $val, $pix, $bcol, $fcol, $font, $function) {
        if ($fcol == "black")
            $fcol = "back";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-weight:bold;font-size:" . $font . "px;width:" . $pix . "px;padding: 4px 4px 4px 4px;border-radius: 8px;";
        $mystyle.="text-shadow: 0px -1px 0px rgba(30, 30, 30, 0.8);";


        //$mystyle = "font-family: arial;font-weight:bold;font-size:" . $font . "px;background-color:" . $bcol . ";color:" . $fcol.";width:" . $pix . "px;padding: 4px 4px 4px 4px;border-radius: 8px;";
        echo "<input type=button value=" . chr(34) . $val . chr(34) . " name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . "  style=" . chr(34) . $mystyle . chr(34) . " " . $function . ">";
        echo "&nbsp;&nbsp;";
    }

//genButton

    public function genTextArea($id, $val, $row, $col, $bcol, $fcol, $font, $function="", $mandatory=0) {
//$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
       $place="";
        if(strlen($this->PlaceHolderText)>0)
        $place=" placeholder=".chr(34). $this->PlaceHolderText.chr(34)." ";   
        
        if(strlen($bcol)==0)
        $bcol=$this->bcol;
        
        if(strlen($fcol)==0)
        $fcol=$this->fcol;
        
        if(strlen($font)==0 || $font<6)
        $font=$this->font;
        
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;padding: 4px 4px 4px 4px;border-radius: 4px;";
        echo "<textarea  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " rows=" . $row . " cols=" . $col . " style=" . chr(34) . $mystyle . chr(34) . " onfocus=" . chr(34) . "ChangeColor('$id',1)" . chr(34) . "  onblur=" . chr(34) . "ChangeColor('$id',2)" . chr(34) . " " .$place." ". $function . ">";
        echo $val;
        echo "</textarea>";
        if ($mandatory)
            echo "<font color=red size=3 face=arial><b>*</b></font>";
    }

//g

    public function genHiddenBox($id, $val) {
        echo "<input type=hidden value=" . chr(34) . $val . chr(34) . "  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . ">";
    }

    public function TdInputBoxWithDatePicker($align, $bcol, $id, $val, $size, $maxlength, $function, $level) {
        $class = "";
        if (strlen($this->TDBackGround) > 1)
            $class = " class=" . chr(34) . $this->TDBackGround . chr(34);

        if (strlen($bcol) > 2)
            echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        else
            echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . $class . $bcol . ">";


        $this->genInputBox($id, $val, $size, $maxlength, $this->bcol, $this->fcol, $this->font, $function, 0);
        $this->genDatePicker($id, $level);
        echo "<font face=arial size=1>dd/mm/yyyy</font>";
        echo "</td>";
    }

//Tdtext

    public function ReturnTDStart($property) {
        $span = "";

        $id = "";
        $class = "";

        if (strlen($this->TDBackGround) > 1)
            $class = " class=" . chr(34) . $this->TDBackGround . chr(34);


        if (isset($property['id'])) {
            $id = " id=" . chr(34) . $property['id'] . chr(34);
        }

        if (isset($property['colspan'])) {
            if ($property['colspan'] > 0)
                $span = " colspan=" . chr(34) . $property['colspan'] . chr(34);
        }

        if (isset($property['rowspan'])) {
            if ($property['rowspan'] > 0)
                $span.=" rowspan=" . chr(34) . $property['rowspan'] . chr(34);
        }

        $wdt = "";
        if (isset($property['width'])) {
            if ($property['width'] > 0)
                $wdt = " width=" . chr(34) . $property['width'] . "%" . chr(34);
        }

        $align = "";
        if (isset($property['align'])) {
            //echo "CLass generated";
            $a = $property['align'];
            //echo $a."<br>";
            $a = $this->mAlign[$a];
            //echo $a."<br>";
            $align = " align=" . chr(34) . $a . chr(34);
            //echo $align."<br>";
        }



        $valign = " valign=" . chr(34) . "center" . chr(34);
        if (isset($property['valign'])) {
            if ($property['valign'] == 1)
                $valign = "top";
            if ($property['valign'] == 2)
                $valign = "bottom";
            $valign = " valign=" . chr(34) . $valign . chr(34);
        }

        $bgcolor = "";
        if (isset($property['bcol']) && strlen($property['bcol']) > 2) {
            $bgcolor = " bgcolor=" . chr(34) . $property['bcol'] . chr(34);
        }


        $style = "";
        $counter = 0;
        if ($this->TdRadius['top-right'] > 0 || $this->TdRadius['top-left'] > 0 || $this->TdRadius['bottom-right'] > 0 || $this->TdRadius['bottom-left'] > 0) {
            $style.= " style='border-radius:" . $this->TdRadius['top-left'] . "px ";
            $style.=$this->TdRadius['top-right'] . "px ";
            $style.=$this->TdRadius['bottom-right'] . "px ";
            $style.=$this->TdRadius['bottom-left'] . "px'";
            $counter++;
        }
        //border width
        //$this->BorderWidth['left']
        //style="border-left-style: solid; border-left-width: 1
        if ($this->BorderWidth['right'] > 0 && $this->BorderWidth['left'] > 0 && $this->BorderWidth['top'] > 0 && $this->BorderWidth['bottom'] > 0) {
            if ($counter > 0)
                $style.=";";
            else
                $style = " style=";
            $style.= " 'border-style: solid;border-width:1'";
        }//all border
        else {
            $d = 0;
            foreach ($this->BorderWidth as $ind => $val) {
                if ($val > 0) {
                    $d++;
                    if ($counter > 0)
                        $style.=";";
                    else
                        $style = " style=";
                    if ($d == 1) //for first 
                        $style.="'";
                    $style.= "border-" . $ind . "-style: solid;border-" . $ind . "-width:" . $val;
                    $counter++;
                }
            }
            if ($d > 0)
                $style.="'";
        }

        $height = "";
        if ($this->TDHeight > 0)
            $height = " height=" . chr(34) . $this->TDHeight . chr(34);

        $str = "<td " . $class . $id . $align . $valign . $bgcolor . $span . $wdt . $height . $style . ">";
        return($str);
    }

    public function ReturnTDText($property) {
        if (isset($property['text']))
            $text = trim($property['text']);
        else
            $text = "";


        $align = "";
        if (isset($property['align'])) {
            if ($align == 4) //Justified
                $text = "<div align=" . chr(34) . "justify" . chr(34) . ">" . $text . "</div>";
        }

        if (isset($property['font']) || isset($property['fcol'])) {
            $font = "<font face=" . chr(34) . "arial" . chr(34);
            if (isset($property['font']) && $property['font'] > 0)
                $font.=" size=" . chr(34) . $property['font'] . chr(34);
            if (isset($property['fcol']))
                $font.=" color=" . chr(34) . $property['fcol'] . chr(34);
            $font.=">";
            $text = $font . $text . "</font>";
        }

        $str = $this->ReturnTDStart($property);
        $str.=$text.="</td>";
        return($str);
    }

    public function returnTD($align, $font, $text, $width, $rspan, $cspan) {
        $property = array("align" => $align, "font" => $font, "text" => $text, "width" => $width, "rowspan" => $rspan, "colspan" => $cspan, "bcol" => $this->bcol, "fcol" => $this->fcol);
        return($this->ReturnTDText($property));
    }

    public function TdText($align, $font, $text, $width, $rspan, $cspan) {
        $property = array("align" => $align, "font" => $font, "text" => $text, "width" => $width, "rowspan" => $rspan, "colspan" => $cspan, "bcol" => $this->bcol, "fcol" => $this->fcol);
        echo $this->ReturnTDText($property);
    }

    public function TableStart($property) {
        $str = "<table ";
        if (isset($property['border']))
            $str = $str . " border=" . chr(34) . $property['border'] . chr(34);
        else
            $str = $str . " border=" . chr(34) . "1" . chr(34);

        if (isset($property['align'])) {
            $a = $property['align'];
            $a = $this->mAlign[$a];
            $str = $str . " align=" . chr(34) . $a . chr(34);
        }

        if (isset($property['width'])) {
            $a = $property['width'] . "%";
            $str = $str . " width=" . chr(34) . $a . chr(34);
        } else
            $str = $str . " width=" . chr(34) . "100%" . chr(34);


        if (isset($property['padding'])) {
            $a = $property['padding'];
            $str = $str . " cellpadding=" . chr(34) . $a . chr(34);
        }

        if (isset($property['spacing'])) {
            $a = $property['spacing'];
            $str = $str . " cellspacing=" . chr(34) . $a . chr(34);
        }
        $str.=" style='boarder-collapse:collapse'>";
        return($str);
    }

    public function TdButton($align, $bcol, $id, $val, $pix, $function) {
        echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        $this->genButton($id, $val, $pix, $this->bcol, $this->fcol, $this->font, $function);
        echo "</td>";
    }

    public function TdTextArea($align, $bcol, $id, $val, $row, $col, $function, $mandatory) {
        echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol . ">";
        $this->genTextArea($id, $val, $row, $col, $this->bcol, $this->fcol, $this->font, $function, $mandatory);
        echo "</td>";
    }

//Tdtext

    public function TdInputBox($align, $bcol, $id, $val, $size, $maxlength, $function, $mandatory) {

        $class = "";

        if (strlen($this->TDBackGround) > 1)
            $class = " class=" . chr(34) . $this->TDBackGround . chr(34);


        if (strlen($bcol) > 2)
            echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . " bgcolor=" . $bcol;
        else
            echo "<td align=" . chr(34) . $this->mAlign[$align] . chr(34) . $class;

        $style = "";
        if ($this->TdRadius['top-right'] > 0 || $this->TdRadius['top-left'] > 0 || $this->TdRadius['bottom-right'] > 0 || $this->TdRadius['bottom-left'] > 0) {
            $style.= " style='border-radius:" . $this->TdRadius['top-left'] . "px ";
            $style.=$this->TdRadius['top-right'] . "px ";
            $style.=$this->TdRadius['bottom-right'] . "px ";
            $style.=$this->TdRadius['bottom-left'] . "px'";
        }
        echo $style . ">";
        $this->genInputBox($id, $val, $size, $maxlength, $this->bcol, $this->fcol, $this->font, $function, $mandatory);
        echo "&nbsp;";
        echo $this->getHtmlComment();
        echo "</td>";
    }

    public function genSelectBoxByValueArray($id, $ValueList = array(), $val = 0, $pix = 150, $bcol = "white", $fcol = "black", $font = 12, $function = "") {

        $property = array("id" => $id, "val" => $val, "width" => $pix, "function" => $function, "bcol" => $bcol, "fcol" => $fcol, "font" => $font);
        echo $this->newSelectBox($property, $ValueList);
    }

//GenSelectBoxByValuarray

    private function processBlank($aa) {
        $aa = trim($aa);
        $row = explode(" ", $aa);
        $n = count($row) - 1;
        if (isset($row[$n]))
            return($row[$n]);
        else
            return("");
    }

    public function TotLines($filename) {
        $fp = fopen($filename, "r") or die("Couldn't open $filename");
        $str = "";
        while (!feof($fp)) {
            $line = fgets($fp, 1024);
            $str = $str . $line;
        }
        $myrow = array();
        $myrow = explode(";", $str);   //Segrigate the String into SQL Statement on Semicolon
        $Length = count($myrow);
        return($Length - 1);
    }

    public function ArrangeFiledList($row) {
        $tt = "";
        for ($i = 0; $i < count($row); $i++) {
            $tt = $tt . $row[$i];
            if ($i < (count($row) - 1))
                $tt = $tt . ",";
        }
        return($tt);
    }

    public function DisplayMobile(&$mob) {
        $res = false;
        if (strlen($mob) == 10 && is_numeric($mob)) {
            $mob = substr($mob, 0, 5) . "-" . substr($mob, 5, 5);
            $res = true;
        }
        return($res);
    }

    //HTML UTILITY

    public function AlertNRedirect($a, $page) {
        $temp = "";
        $temp = "<Script language=javascript>\n";
        $a = str_replace("'", "", $a);
        if (strlen($a) > 0)
            $temp = $temp . "alert('" . $a . "');//Make an alert\n";
        if (strlen($page) > 0)
            $temp = $temp . "document.location.href=" . chr(34) . $page . chr(34) . ";//Redirect\n";
        $temp = $temp . "</script>";
        echo $temp;
        return("");
    }

    public function alert($a) {
        $temp = "";
        $a = str_replace("'", "", $a);
        if (strlen($a) > 0) {
            $temp = "<Script language=javascript>\n";
            $temp = $temp . "alert('" . $a . "');//Make an alert\n";
            $temp = $temp . "</script>";
        }
        echo $temp;
        return("");
    }

    public function OpenWindow($a, $page, $type) {
        if ($type == "0")
            $type = "_self";
        if ($type == "1")
            $type = "_blank";
        if ($type == "2")
            $type = "_top";

        $temp = "";
        $temp = "<Script language=javascript>\n";
        $a = str_replace("'", "", $a);
        if (strlen($a) > 0)
            $temp = $temp . "alert('" . $a . "');//Make an alert\n";
        if (strlen($page) > 0)
            $temp = $temp . "window.open(" . chr(34) . $page . chr(34) . "," . chr(34) . $type . chr(34) . ");//Redirect\n";
        $temp = $temp . "</script>";
        echo $temp;
        return("");
    }  
    
   
    public function Delay($second) {
        $t2 = date('H:i:s');
        $elapsed = 0;
        while ($elapsed < $second) {
        $t1=date('H:i:s');
        $elapsed=$this->elapsedTimeInSecond($t1, $t2);
        }
    }

    public function elapsedTime($t1, $t2) {
        $row = array();
        $h1 = substr($t1, 0, 2);
        $m1 = substr($t1, 3, 2);
        $s1 = substr($t1, 6, 2);

        $h2 = substr($t2, 0, 2);
        $m2 = substr($t2, 3, 2);
        $s2 = substr($t2, 6, 2);

        if ($s2 <= $s1)
            $s = $s1 - $s2;
        else {
            $s1 = $s1 + 60;
            $m1 = $m1 - 1;
            $s = $s1 - $s2;
        }

        if ($m2 <= $m1)
            $m = $m1 - $m2;
        else {
            $m1 = $m1 + 60;
            $h1 = $h1 - 1;
            $m = $m1 - $m2;
        }

        if ($h2 <= $h1)
            $h = $h1 - $h2;
        else
            $h = 0;
        $row['h'] = $h;
        $row['m'] = $m;
        $row['s'] = $s;
        return($row);
    }

//
    public function elapsedTimeMsg($t1, $t2) {
        $row = array();
        $mrow = $this->elapsedTime($t1, $t2);
        $tt = " ";
        if ($mrow['h'] > 0)
            $tt = $tt . $mrow['h'] . " Hours ";
        if ($mrow['m'] > 0)
            $tt = $tt . $mrow['m'] . " Min ";

        if ($mrow['s'] > 0)
            $tt = $tt . $mrow['s'] . " Sec";
        else
            $tt = $tt . "Less than 1 Sec";

        $tt = $tt . "";

        return($tt);
    }

    public function elapsedTimeInSecond($t1, $t2) {

        $h1 = substr($t1, 0, 2);
        $m1 = substr($t1, 3, 2);
        $s1 = substr($t1, 6, 2);

        $h2 = substr($t2, 0, 2);
        $m2 = substr($t2, 3, 2);
        $s2 = substr($t2, 6, 2);

        if ($s2 <= $s1)
            $s = $s1 - $s2;
        else {
            $s1 = $s1 + 60;
            $m1 = $m1 - 1;
            $s = $s1 - $s2;
        }

        if ($m2 <= $m1)
            $m = $m1 - $m2;
        else {
            $m1 = $m1 + 60;
            $h1 = $h1 - 1;
            $m = $m1 - $m2;
        }

        if ($h2 <= $h1)
            $h = $h1 - $h2;
        else
            $h = 0;

        return($h * 60 * 60 + $m * 60 + $s);
    }

   
    
    public function Clock($t1, $t2) {
        $row = array();
        $mrow = $this->elapsedTime($t1, $t2);
        $tt = " ";

        $tt = $tt . substr((100 + $mrow['h']), 1, 2) . ":";

        $tt = $tt . substr((100 + $mrow['m']), 1, 2) . ":";

        $tt = $tt . substr((100 + $mrow['s']), 1, 2);

        $tt = $tt . "";

        return($tt);
    }

    
    public function MyIP() {
        if (isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "";
        if ($ip == $this->IP)
            return(true);
        else
            return(false);
    }

    public function ReturnEOD_OnValueList($title, $headlist, $align, $ValueList, $width, $cwidth, $records, $AutoSerialRequired) {
        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');

        $cnt = count($ValueList);
        $numcol = count($headlist);
        $datastr = "";

        if ($AutoSerialRequired == 1)
            $tag = 1;
        else
            $tag = 0;

        if (isset($cwidth[0]))
            $mwidth = chr(34) . $cwidth[0] . "%" . chr(34);
        else
            $mwidth = chr(34) . round(100 / ($numcol + $tag)) . "%" . chr(34);



        if ($cnt > 0) {
            $datastr.="<table border=" . chr(34) . "1" . chr(34) . " cellpadding=" . chr(34) . "2" . chr(34) . " align=" . chr(34) . "center" . chr(34) . "   width=" . chr(34) . $width . "%" . chr(34) . "  style='border-collapse: collapse;'>";
            if (strlen($title) > 0) {
                $datastr.="<tr><td align=" . chr(34) . "center" . chr(34) . " colspan=" . chr(34) . ($numcol + $tag) . chr(34) . ">" . $title . "</td></tr>";
            }
            $datastr.="<tr>";

            if ($AutoSerialRequired == 1)
                $datastr.="<td align=" . chr(34) . "center" . chr(34) . " width=" . $mwidth . ">SlNo</td>";

            for ($i = 0; $i < count($headlist); $i++) {
                $ind = $tag + $i;
                if (isset($cwidth[$ind]))
                    $width = $cwidth[$ind];
                else
                    $width = $mwidth;

                $width = chr(34) . $width . "%" . chr(34);



                $datastr.="<td align=" . chr(34) . "center" . chr(34) . " width=" . $width . ">" . $headlist[$i] . "</td>";
            }
            $datastr.="</tr>";
//end header
        }//cnt>0

        $height = chr(34) . $this->RowHeight . chr(34);

        for ($ind = 0; $ind < count($ValueList); $ind++) {
//$tcol=$this->checkList($ind,$ValueList,$numcol);

            $sl = ($ind + 1);
            $datastr.="<tr>";

            if ($AutoSerialRequired == 1) {
                if ($ind <= ($records - 1))
                    $datastr.="<td align=" . chr(34) . "center" . chr(34) . " height=" . $height . ">" . $sl . "</td>";
                else
                    $datastr.="<td align=" . chr(34) . "center" . chr(34) . " height=" . $height . ">&nbsp;</td>";
            }

            for ($i = 0; $i < $numcol; $i++) {
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = chr(34) . $tAlign[$align[$i]] . chr(34);
                    else
                        $malign = chr(34) . "left" . chr(34);
                } else
                    $malign = chr(34) . "left" . chr(34);

                if (isset($ValueList[$ind][$i]))
                    $fld = $ValueList[$ind][$i];
                else
                    $fld = "&nbsp;";
                $datastr.="<td align=" . $malign ;
                
                $datastr.=$this->returnBoarderStyle();
                
                $datastr.= " >" . $fld . "</td>";
            }
            $datastr.="</tr>";
        }//end Row browse
        $datastr.="</table>";
        return($datastr);
    }

    public function returnPattern($pat) {
        $PAT = array();
        $pat=strtoupper($pat);
//. is escaped as \.  and slash(/) is escaped as \/
//  ^ is used to say that staring with  and $ - ending with
        $PAT['EMAIL'] = "/^[a-zA-Z0-9._-]+@([a-zA-Z0-9-]+[\.]){1,3}[a-zA-Z]{2,4}$/";
        $PAT['MOBILE'] = "/^[0-9]{10}$/";
        $PAT['MOBILENEW'] = "/^[7-9]{1}[0-9]{9}$/";
        $PAT['NAME'] = "/^([a-zA-Z]+[\.]{0,1}[ ]{0,1}){1,}$/";
        $PAT['YMD'] = "/^[0-9]{4}[-\/][0-3]{1}[0-9]{1}[-\/][0-3]{1}[0-9]{1}$/";
        $PAT['PAN'] = "/^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/"; //Use Regular Expression
        $PAT['EPIC'] = "/^[a-zA-Z]{3}[0-9]{7}$/"; //Use Regular Expression
        $PAT['ADHAR'] = "/^[1-9]{1}[0-9]{11}$/";
        
        if (isset($PAT[$pat]))
            return($PAT[$pat]);
        else
            return("");
    }

    public function HeaderBar($str, $width, $font) {
        echo "<br>";
        //$this->TextHeader($str, $width, 2, "#3366FF", "white", $font);
        $this->TextHeader($str, $width, 2, "#3399FF", "white", $font);
        echo "</br>";
    }

    public function HeaderBarCustom($str, $width, $height, $font, $fcol, $backgroundindex) {
        echo "<table align=center  border=0  width=" . $width . "%>";
        echo "<tr>";
        $this->fcol = $fcol;
        $this->bcol = "";
        $bck = "background" . $backgroundindex;
        $this->BackGroundClass($bck);
        $this->BoarderRadius(10, 10, 0, 0);
        $this->TDHeight = $height;
        $this->TdText(2, $font, $str, $width, 0, 0);
        echo "</tr></table>";
        $this->BackGroundClass("");
        $this->BoarderRadius(0, 0, 0, 0);
        $this->fcol = "black";

        //echo "height".$this->TDHeight;
    }

    public function FooterBar($str, $width, $font) {
        echo "<br>";
        $this->TextFooter($str, $width, 2, "#3366FF", "white", $font);
        echo "</br>";
    }

    public function TextHeader($msg, $width, $align, $bcol, $fcol, $font) {
        echo "<table  border=0 align=center style='border-collapse: collapse;' width=" . $width . "%>";
        echo "<tr><td align=" . chr(34) . $this->mAlign[$align] . chr(34) . "   style='border-radius: 10px 10px 0 0;padding: 5px;' bgcolor=" . chr(34) . $bcol . chr(34) . ">";
        echo "<font face=arial size=" . $font . " color=" . $fcol . "><b>" . $msg . "</b></font>";
        echo "</td></tr></table>";
    }

    public function ButtonHeader($msg, $font, $fun) {
        $fun = chr(34) . " " . chr(34) . $fun;
        echo "<div align=center>";
        //echo "<input type=button class=" . chr(34) . "button-new button-font" . $font . chr(34) . " value=" . chr(34) . $msg . chr(34) . $fun . ">";
        //button-mix button-font12
        $msg = "    " . $msg . "    ";
        echo "<input type=button class=" . chr(34) . "button-mix button-font" . $font . chr(34) . " value=" . chr(34) . $msg . chr(34) . $fun . ">";
        echo "</div>";
    }

    public function TextFooter($msg, $width, $align, $bcol, $fcol, $font) {
        echo "<table  border=0 align=center style='border-collapse: collapse;' width=" . $width . "%>";
        echo "<tr><td align=" . chr(34) . $this->mAlign[$align] . chr(34) . "   style='border-radius: 0 0 10px 10px ;padding: 5px;' bgcolor=" . chr(34) . $bcol . chr(34) . ">";
        echo "<font face=arial size=" . $font . " color=" . $fcol . "><b>" . $msg . "</b></font>";
        echo "</td></tr></table>";
    }

    public function IsEven($num) {
        $a = round($num / 2);
//echo "a=".$a."<br>";
        $b = round($a * 2);
        if ($b == $num)
            return(true);
        else
            return(false);
    }

//NEW HTML BOX
    public function newInputBox($property) {
        ///$id, $val, $size, $maxlength, $bcol, $fcol, $font, $function, $mandatory
        $id = "Id" . rand(100, 200);
        if (isset($property['id']))
            $id = $property['id'];

        $text = "text";
        $mand = "";
        if (isset($property['mandatory']) && $property['mandatory'] == 2) {
            $text = "password";
            //$mand = "<font color=red size=3 face=arial><b>*</b></font>";
        }

        $place="";
        if(strlen($this->PlaceHolderText)>0)
        $place=" placeholder=".chr(34). $this->PlaceHolderText.chr(34)." ";   
        
        
                
        $bcol = $this->bcol;
        if (isset($property['bcol']))
        {
        if(strlen($property['bcol'])>1)
            $bcol = $property['bcol'];
        }
        
        $val = "";
        if (isset($property['val']))
            $val = $property['val'];


        $fcol = $this->fcol;
        if (isset($property['fcol']))
        {
         if(strlen($property['fcol'])>1)
            $fcol = $property['fcol'];
        }
        
        $font = $this->font;
               if (isset($property['font']))
               {
            if($property['font']>=6)       
            $font = $property['font'];
            else
            $font =10;
        }
        
        $size = "5";
        if (isset($property['size']))
        {
       if($property['size']>0)
            $size = $property['size'];
               }
               
        $maxlength = "";
        if (isset($property['maxlength']) && $property['maxlength'] > 0) {
            $len = $property['maxlength'];
            if ($len <= 0)
                $len = 10;
            $maxlength = " maxlength=" . $len;
        }

        $function = "";
        if (isset($property['function']))
            $function = $property['function'];

        if ($text == "password") {
            //if(strlen($function)>0)
            //$function.=";";
            //$function.="onpaste=".chr(34)."return false".chr(34);
            $xx = 0;
        }

        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;padding: 4px 4px 4px 4px;border-radius: 4px;";

        if ($this->DefaultMark == "Double") //double quote
            $str = "<input type=" . $text . " value=" . chr(34) . $val . chr(34) . "  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " size=" . $size . $maxlength . " style=" . chr(34) . $mystyle . chr(34) . " onfocus=" . chr(34) . "ChangeColor('$id',1)" . chr(34) . "  onblur=" . chr(34) . "ChangeColor('$id',2)" . chr(34) . " " .$place." ". $function . ">";
        else
            $str = "<input type=" . $text . " value='" . $val . "'  name='" . $id . "'  id='" . $id . "' size=" . $size . $maxlength . " style='" . $mystyle . "'" .$place." ". $function . ">";

        //$str = "<input type=" . $text . " value=" . chr(34) . $val . chr(34) . "  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " size=" . $size . $maxlength . " style=" . chr(34) . $mystyle . chr(34) . " onfocus=" . chr(34) . "ChangeColor('$id',1)" . chr(34) . "  onblur=" . chr(34) . "ChangeColor('$id',2)" . chr(34) . " " . $function . ">";

        $str.=$mand;
        return($str);
    }

    public function ReturnEOD($align, $ValueList, $column, $width, $cwidth, $border,$CustomAlign=array()) {
        $tAlign = array(1 => 'Left', 2 => 'center', 3 => 'right');

        $cnt = count($ValueList);
        $numcol = $column;
//style="border:1px solid black;"
        $normalwidth = round(100 / $column);
        if ($cnt > 0) {
            $datastr.="<table border=" . chr(34) . $border . chr(34) . " cellpadding=" . chr(34) . "2" . chr(34) . " align=" . chr(34) . "center" . chr(34) . "   width=" . chr(34) . $width . "%" . chr(34) ."   style='border-collapse: collapse;'>";
         
        }//cnt>0

        $height = chr(34) . $this->RowHeight . chr(34);

        for ($ind = 0; $ind < count($ValueList); $ind++) {
//$tcol=$this->checkList($ind,$ValueList,$numcol);

            $datastr.="<tr>";

            for ($i = 0; $i < $numcol; $i++) {
                if (isset($cwidth[$i]))
                    $width = $cwidth[$i];
                else
                    $width = $normalwidth;
                $mwidth = " width=" . chr(34) . $width . "%" . chr(34);
                if (isset($align[$i])) {
                    if (isset($tAlign[$align[$i]]))
                        $malign = chr(34) . $tAlign[$align[$i]] . chr(34);
                    else
                        $malign = chr(34) . "left" . chr(34);
                } else
                    $malign = chr(34) . "left" . chr(34);

                if(isset($CustomAlign[$ind][$i]))
                {
                $xx=$CustomAlign[$ind][$i];    
                $malign = chr(34) . $tAlign[$xx] . chr(34);    
                }
                
                if (isset($ValueList[$ind][$i]))
                    $fld = $ValueList[$ind][$i];
                else
                    $fld = "&nbsp;";
                $datastr.="<td align=" . $malign . $mwidth ;
                
                $datastr.=$this->returnBoarderStyle();
                
                      
                
                //style='border-right:1px solid black';
                
               $datastr.= " >" . $fld."</td>";
                }
            $datastr.="</tr>";
        }//end Row browse
        $datastr.="</table>";
        return($datastr);
    }

    public function newSelectBox($property, $ValueList) {
        ///$id, $val, $size, $maxlength, $bcol, $fcol, $font, $function, $mandatory
//echo "select box size ".$this->SelectBoxSize;
        $size = "";
        if ($this->SelectBoxSize > 0)
            $size = " size=" . $this->SelectBoxSize;
        else if (isset($property['size'])) {
            $size = " size=" . $property['size'];
        }

        $multiple = "";
        if ($this->multiple == true) {
            if ($this->DefaultMark == "Double")
                $multiple = " multiple=" . chr(34) . "multiple" . chr(34);
            else
                $multiple = " multiple='multiple'";
        }


        $id = "Id" . rand(100, 200);
        if (isset($property['id']))
            $id = $property['id'];


        $bcol = $this->bcol;
        
        if (isset($property['bcol']))
        {
        if(strlen($property['bcol'])>1)
            $bcol = $property['bcol'];
        }
        
        
        
        $val = "";
        if (isset($property['val']))
            $val = $property['val'];


        $fcol = $this->fcol;
        
        if (isset($property['fcol']))
        {
        if(strlen($property['fcol'])>1)
            $fcol = $property['fcol'];
        }
        
        
        $font = $this->font;
        if (isset($property['font']))
        {
          if($property['font']>6)
            $font = $property['font'];
        }
        $function = "";
        if (isset($property['function']))
            $function = $property['function'];

        $width = "";
        if (isset($property['width']))
        {
       if($property['width']>0)
            $width = "width:" . $property['width'] . "px";
        }
        
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;" . $width . ";padding: 4px 4px 4px 4px;border-radius: 6px;";

        if ($this->DefaultMark == "Double") {
            $str = "<select name=" . $id . "  id=" . $id . $size . " style=" . chr(34) . $mystyle . chr(34) . " " . $multiple . $function . ">";
            $quote = chr(34);
        } else {
            $str = "<select name=" . $id . "  id=" . $id . $size . " style='" . $mystyle . "' " . $multiple . $function . ">";
            $quote = "'";
        }

//echo "select name=" . $id . "  id=" . $id . $size . " style=" . chr(34) . $mystyle . chr(34) . " " . $function;

        if ($this->DefaultOptRequired == 1)
            $str = $str . "<option  value=" . $quote . $this->DefaultOpt . $quote . ">" . $this->DefaultOptDetail;
        // $str = $str . "<option  value=" . chr(34) . $this->DefaultOpt . chr(34) . ">" . $this->DefaultOptDetail;

        for ($i = 0; $i < count($ValueList); $i++) {
            $mcode = $ValueList[$i][0];
            if (isset($ValueList[$i][1]))
                $mdetail = $ValueList[$i][1];
            else
                $mdetail = $mcode;
            if ($mcode == $val)
                $str = $str . "<option selected value=" . $quote . $mcode . $quote . ">" . $mdetail;
            else
                $str = $str . "<option  value=" . $quote . $mcode . $quote . ">" . $mdetail;
        } //for Loop
        $str = $str . "</Select>";

        return($str);
    }

    public function returnRadio($id, $val, $function) {
        $str = "<input type=radio name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . "  value=" . chr(34) . $val . chr(34) . " " . $function . ">";
        return($str);
    }

    public function CheckBoxWithValue($id, $val, $check, $function) {
        if ($check == true)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $this->bcol . ";color:" . $this->fcol . ";font-size:" . $this->font . "px;padding: 4px 4px 4px 4px;border-radius: 5px 5 px 5px 5px;";
        echo "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " value=" . chr(34) . $val . chr(34) . "   style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
    }

    public function genFileBox($id, $size) {
        return("<input name=" . chr(34) . $id . chr(34) . " id=" . chr(34) . $id . chr(34) . "  type=" . chr(34) . "file" . chr(34) . " size=" . $size . "/>");
    }

    public function TimePlus($time, $offset) {
        $ar1 = explode(":", $time);
        $ar2 = explode(":", $offset);

        $rmin = 0;
        if (($ar1[2] + $ar2[2]) >= 60) { //second cross 60 
            $sec = ($ar1[2] + $ar2[2]) % 60;
            $rmin = ($ar1[2] + $ar2[2] - $sec) / 60;
        } else
            $sec = $ar1[2] + $ar2[2];


        $rhr = 0;
//echo "rmin-".$rmin."<br>";
        if (($ar1[1] + $ar2[1] + $rmin) >= 60) { //minute cross 60 
            $min = ($ar1[1] + $ar2[1] + $rmin) % 60;
//echo "minute".$min."<br>";
            $rhr = ($ar1[1] + $ar2[1] + $rmin - $min) / 60;
        } else
            $min = $ar1[1] + $ar2[1] + $rmin;

        $hr = $ar1[0] + $ar2[0] + $rhr;

        $hr = substr((100 + $hr), -2);
        $min = substr((100 + $min), -2);
        $sec = substr((100 + $sec), -2);
        $time = $hr . ":" . $min . ":" . $sec;
        return($time);
    }

//TimePlus

    public function TimeMinus($time, $offset) {
        $ar1 = explode(":", $time);
        $ar2 = explode(":", $offset);

        $rmin = 0;
        if (($ar1[2] - $ar2[2]) < 0) { //second downs 0 
            $rmin = -1;  // minute dhar lowa hall     
            $sec = 60 + ($ar1[2] - $ar2[2]);  // hence add 60 second   
        } else
            $sec = $ar1[2] - $ar2[2];


        $rhr = 0;

        if ((($ar1[1] - $ar2[1]) + $rmin) < 0) { //minute downs zero 
            $rhr = -1;
            $min = 60 + $rmin + ($ar1[1] - $ar2[1]);
        } else
            $min = $ar1[1] - $ar2[1] + $rmin;

        $hr = $ar1[0] - $ar2[0] + $rhr;

        $hr = substr((100 + $hr), -2);
        $min = substr((100 + $min), -2);
        $sec = substr((100 + $sec), -2);
        $time = $hr . ":" . $min . ":" . $sec;
        return($time);
    }

    public function SeparateString($string, $length) {
        $temp = "";
        $j = 0;
        $start = 0;
        for ($i = $start; $i < strlen($string);) {
            $substr = substr($string, $i, 10);
            if (strlen($substr) == 10 && is_numeric($substr)) {
                if ($j > 0)
                    $temp = $temp . ",";
                $temp = $temp . "'" . $substr . "'";
                $j++;
            }
            $i = $i + 10;
        }//for loop
        return($temp);
    }

    public function Hour($id, $val) {
        $List = array();
        for ($i = 0; $i < 23; $i++) {
            $tag = "";
            if ($i < 9)
                $tag = "0";
            $List[$i][0] = $tag . ($i + 1);
        }
        $this->DefaultOptRequired = 0;
        $property = array("id" => $id, "width" => 60, "val" => $val);
        $str = $this->newSelectBox($property, $List);

        return($str);
    }

    public function Minute($id, $val) {
        $this->DefaultOptRequired = 0;
        $List = array();
        for ($i = 0; $i <= 59; $i++) {
            $tag = "";
            if ($i < 10)
                $tag = "0";
            $List[$i][0] = $tag . ($i);
        }

        $property = array("id" => $id, "width" => 60, "val" => $val);
        $str = $this->newSelectBox($property, $List);

        return($str);
    }

    public function Second($id, $val) {
        $this->DefaultOptRequired = 0;
        $List = array();
        for ($i = 0; $i <= 59; $i++) {
            $tag = "";
            if ($i < 10)
                $tag = "0";
            $List[$i][0] = $tag . ($i);
        }

        $property = array("id" => $id, "width" => 60, "val" => $val);
        $str = $this->newSelectBox($property, $List);

        return($str);
    }

    public function RetriveTableNames($sql, &$TAB, &$REFTAB) {

        $sql = strtoupper($sql);
        $ind1 = $this->inStr($sql, "TABLE");
        $ind2 = $this->inStr($sql, "ADD");
        $TAB = trim(substr($sql, 12, ($ind2 - ($ind1 + 6))));

        $ind1 = $this->inStr(strtoupper($sql), "REFERENCES");

        $lngth = strlen($sql) - ($ind1 + 10);

        $sql1 = substr($sql, $ind1, $lngth);

        $ind2 = $this->inStr($sql1, "(");

        $REFTAB = substr($sql1, 10, ($ind2 - 10));
    }

    public function TableNameSelectStatement($sql) {
        $ind1 = $this->inStr(strtoupper($sql), "FROM");
        $temp = substr($sql, $ind1 + 5, strlen($sql) - ($ind1 + 5));

        $ind2 = $this->inStr(strtoupper($temp), "WHERE");
        if ($ind2 > 0)
            $TABLE = trim(substr($temp, 0, $ind2));
        else
            $TABLE = trim($temp);
        return($TABLE);
    }

    public function GenerateScript($Table, $FldList, $ValueList, $fname, $Packet) {
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

        //$fname="./sql/".$Table.date('dmY').".sql";
        $this->WriteF($fname, "-- " . $Table);


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
                $this->AppendF($fname, $sql);
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
            $this->AppendF($fname, $sql);
        }
        //$this->returnSql = $sql;
        return(1);
    }

    public function WriteF($fname, $data) {
        $data.="\n";
        $ts = fopen($fname, 'w') or die("can't open file");
        fwrite($ts, $data);
    }

    public function AppendF($fname, $data) {
        $data.="\n";
        $ts = fopen($fname, 'a') or die("can't open file");
        fwrite($ts, $data);
    }

    public function ReadF($fname) {
        $line = " File doesnot not exist";
        if (file_exists($fname)) {
            $fp = fopen($fname, "r") or die("Couldn't open $fname");
            if (!feof($fp))
                $line = trim(fgets($fp, 1024));
            else
                $line = "";
        }
        return($line);
    }

    public function FetchFileAsArray($filename) {
        $temp = array();
        $i = 0;
        if (file_exists($filename)) {
            $fp = fopen($filename, "r") or die("Couldn't open $filename");
            $i = 0;
            while (!feof($fp)) {
                $line = fgets($fp, 1024);
                $line = trim($line);
                $temp[$i] = $line;
                $i++;
            }//while
        }//if
        return($temp);
    }

    public function returnCheckBox($id, $val, $function) {
        //DATABASE INDEPENDANT
        $bcol = $this->bcol;
        $fcol = $this->fcol;
        $font = $this->font;
        if ($val == true)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;";
        if ($this->DefaultMark == "Double")
            $ret = "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        else
            $ret = "<input type=checkbox  name='" . $id . "'  id='" . $id . "' style='" . $mystyle . "' " . $checked . " " . $function . ">";

        return($ret);
    }

    public function returnInputBox($id, $val, $size, $maxlength, $function) {
        $property = array("id" => $id, "val" => $val, "size" => $size, "maxlength" => $maxlength, "function" => $function);
        $ret = $this->newInputBox($property);
        return($ret);
    }

    public function returnButton($id, $val, $pix, $function) {

        $bcol = $this->bcol;
        $fcol = $this->fcol;
        $font = $this->font;
        if ($fcol == "black")
            $fcol = "back";

        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-weight:bold;font-size:" . $font . "px;width:" . $pix . "px;padding: 4px 4px 4px 4px;border-radius: 6px;";
        if ($this->DefaultMark == "Double")
            $ret = "<input type=Button value=" . chr(34) . $val . chr(34) . " name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . "  style=" . chr(34) . $mystyle . chr(34) . " " . $function . ">";
        else
            $ret = "<input type=Button value='" . $val . "' name='" . $id . "'  id='" . $id . "'  style='" . $mystyle . "' " . $function . ">";

        return($ret);
    }

    public function returnHiddenBox($id, $val) {
        if ($this->DefaultMark == "Double")
            $ret = "<input type=hidden value=" . chr(34) . $val . chr(34) . "  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . ">";
        else
            $ret = "<input type=hidden value='" . $val . "'  name='" . $id . "'  id='" . $id . "'>";

        return($ret);
    }

    public function returnDatePicker($Fld, $level) {
        if ($level == 1)
            $path = "./datepicker/images/calendar.png";
        if ($level == 2)
            $path = "../datepicker/images/calendar.png";
        if ($level == 3)
            $path = "../../datepicker/images/calendar.png";
        $fun = " onClick=GetDate(" . $Fld . ")";
        $ret = "<img src=" . $path . " width=25 height=25 " . $fun . ">";
        return($ret);
    }

    public function returnGeneralCheckBox($id, $val, $function) {
        //DATABASE INDEPENDANT
        $bcol = $this->bcol;
        $fcol = $this->fcol;
        $font = $this->font;
        if ($val == 1)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;";
        $ret = "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        return($ret);
    }

    public function FetchData_IN_JSON_Object_By_ValueList($header, $List) { //This Return Value as Object is to be Parsed using JSON.parse()
        $numcol = count($header);
        $Found = 1;

        $ValueList = $List;
        //$this->AlertNRedirect("Entered ".count($ValueList), "");
        $ip=$this->MyClientIP();
        
        
        //$this->WriteF($ip."Json.htm", "{");


        echo "{";

        for ($i = 0; $i < $Found; $i++) {
            if ($i > 0) {
                echo ",";
                //$this->AppendF($ip."Json.htm", ",");
            }
            echo chr(34) . $i . chr(34) . ":";
            //$this->AppendF($ip."Json.htm", chr(34) . $i . chr(34) . ":");
            echo "{";
            //$this->AppendF($ip."Json.htm", "{");
            for ($j = 0; $j < $numcol; $j++) {
                $data = $ValueList[$i][$j];
                if (isset($header[$j]))
                    $head = $header[$j];
                else
                    $head = "Field" . ($j + 1);
                if ($j > 0) {
                    echo ",";
                    //$this->AppendF($ip."Json.htm", ",");
                }
                echo chr(34) . $head . chr(34) . ":" . chr(34) . $data . chr(34);
                //$this->AppendF($ip."Json.htm", chr(34) . $head . chr(34) . ":" . chr(34) . $data . chr(34));
            }//inner for j
            echo "," . chr(34) . "Found" . chr(34) . ":" . chr(34) . $Found . chr(34);
            //$this->AppendF($ip."Json.htm", "," . chr(34) . "Found" . chr(34) . ":" . chr(34) . $Found . chr(34));
            echo "," . chr(34) . "AlertMessage" . chr(34) . ":" . chr(34) . $this->Alert_Message_Through_JSON . chr(34);
            //$this->AppendF($ip."Json.htm", "," . chr(34) . "AlertMessage" . chr(34) . ":" . chr(34) . $this->Alert_Message_Through_JSON . chr(34));
            echo "}";
            //$this->AppendF($ip."Json.htm", "}");
        }// outer for i
        echo "}";
        //$this->AppendF($ip."Json.htm", "}");
        return(true);
    }

    public function RunBatchFile($path) {
        $path = str_replace("/", "\\", $path);
        exec($path);
    }

    public function ValueArray2JSONArray($File, $Head, $List, $mode) {
        if ($mode == "W")
            $this->WriteF($File, "");
        else
            $this->AppendF($File, "");

//echo count($List);
//echo $List[0][0];

        $A = count($List) - 1;
        $B = count($Head) - 1;
        for ($i = 0; $i < count($List); $i++) {

            $this->AppendF($File, "{");
            for ($j = 0; $j < count($Head); $j++) {
                $data = chr(34) . $Head[$j] . chr(34) . ":" . $List[$i][$j];
                if ($j < $B)
                    $this->AppendF($File, $data . ",");
                else
                    $this->AppendF($File, $data);
            }//for $j loop 

            if ($i < $A)
                $this->AppendF($File, "},");
            else
                $this->AppendF($File, "}");
        } //for $i loop
    }

//function end

    public function GenerateCSV($File, $Head, $List) {

        $data = "";
        for ($j = 0; $j < count($Head); $j++) {
            if ($j > 0)
                $data.=",";
            $head = str_replace(",", " ", $Head[$j]);
            $data.=$head;
        }

        $this->WriteF($File, $data);


        $A = count($List) - 1;

        for ($i = 0; $i < count($List); $i++) {
            $data = "";
            for ($j = 0; $j < count($Head); $j++) {
                if ($j > 0)
                    $data.=",";
                $list = str_replace(",", ".", $List[$i][$j]);
                $data.=$list;
            }//for $j loop 
            $this->AppendF($File, $data);
        } //for $i loop
    }

    
  private function returnBoarderStyle()
  {
      $found=0; 
      if ($this->BorderWidth['right'] > 0 && $this->BorderWidth['left'] > 0 && $this->BorderWidth['top'] > 0 && $this->BorderWidth['bottom'] > 0) {
            $style = " style=";
            $style.= " 'border-style: solid;border-width:1'";
            $found=1;
        }//all border
        else {
            $d = 0;
            foreach ($this->BorderWidth as $ind => $val) {
                if ($val > 0) {
                    $d++;
                    $found++;
                    if ($d == 1) //for first 
                    $style=" style='";
                    
                    $style.= "border-" . $ind . "-style: solid;border-" . $ind . "-width:" . $val.";";
                   
                    
                }
            }
            if ($d > 0)
                $style.="'";
        }
        if($found>0)
            return($style);
        else
            return("");
  }
  
  
  public function Round($val,$offset)
  {
  $temp=round($val,$offset) ;
  $ln=strlen($temp);
  if(substr($temp,$ln-2,1)==".")
  $temp=$temp."0";
  if($this->inStr($temp, ".")==-1)
  $temp=$temp.".00";      
return($temp);  
  }
    
//function end
}

//End Class
?>



