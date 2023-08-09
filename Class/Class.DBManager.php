<?php
require_once 'class.config.php';
require_once 'class.CommonParameter.php';
class DBManager  extends  CommonParameter
{
//public function _construct($i) //for PHP6
public $rowCommitted; 
public $returnSql;
public $Available;

public $bcol;
public $fcol;
public $font;
public $DefaultOpt;
public $DefaultOptDetail;   
public $TableTitleFont;
public $TableHeadFont;
public $TableBodyFont;
public $TableHeadColor;


private $con;
public $colFetched;
public function __construct() {
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/kolkata");
    
    $this->bcol="white";
    $this->fcol="black";
    $this->font=12;
    $this->mAlign[1]="left";
    $this->mAlign[2]="center";
    $this->mAlign[3]="right";
    $this->mAlign[4]="justify";
    $this->DefaultOpt="0";
    $this->DefaultOptDetail="-Select-";
    $this->TableBodyFont=2;
    $this->TableHeadFont=2;
    $this->TableTitleFont=2;
    $this->TableHeadColor="#CCCC99"; //#CCFFFF
    
    $this->connect();
     }

//public function _construct($i) //for PHP6
//End constructor

    public function connect() {
        $dbhost = trim(Config::getDBHost());
        $dbname = trim(Config::getDB());
        $dbuser = trim(Config::getUser());
        $dbpwd = trim(Config::getPWD());
             $_SESSION['dbuser']=$dbuser;
             $_SESSION['databasename']=$dbname;
        if (strlen(trim($dbpwd)) > 0) {
            $this->con = mysql_connect($dbhost, $dbuser, $dbpwd);
        $_SESSION['dbpwd']=$dbpwd;
         
        }
//$con=mysql_connect('localhost','root','pwd');
        else {
            $this->con = mysql_connect($dbhost, $dbuser);
        }
        if (!$this->con) {
            die('Could not connect to MySQL: ' . mysql_error());
        }
        mysql_select_db($dbname) or die(mysql_error());
        mysql_query("SET NAMES UTF8");
    }//End Connect


public function AutoBackup($force) {
        $database = trim(Config::getDB());
                        
        $gpath =  "Log/*.*";

        $orgfile = "database/" . $database . ".sql";   //Databse Folder under Application
        

        $newfile=substr($this->ApplicationFolder(),0,3).$database . ".sql";
        
        
        
        $fname =  "LastBackup.txt";
        $date = $this->ReadF($fname);
      
        
        if ($force == 1) {
            if (file_exists($fname))
                unlink($fname);
        }

          if ($this->BackUpDue() == true) {
            if (file_exists($orgfile)) {
                copy($orgfile, $oldfile);    //copy preveous backup
                unlink($orgfile);
                $this->AppendF("TEST.txt", " force-" . $force . " date " . $date);
            }

            $path = "database/backup_my.bat";   ////Batchfile for My SQL backup
            //LOCK ALL TABLE BEFORE BACKUOP
            
         
            $bfile = "Log/" . date('dmY') . "query.sql";
            if (file_exists($bfile)) {
                copy($bfile, $Level . "Log/Query.txt");
                unlink($bfile);
            }

         //$this->AppendF($Level . "TT.txt", $this->MyClientIP()." Locked");

            
                $this->RunBatchFile($path);
                
            
         $Level="./";
            
              //echo $gpath."<br>";
            $this->AppendF("TEST.txt", $gpath);
            foreach (glob($gpath) as $filename) {
                $this->AppendF("TEST.txt", $filename);
                if (substr($filename, -12) != date('dmY').".sql" ){
                        if (file_exists($filename))
                        unlink($filename);
                }
            } //foeach glob
            copy($orgfile, $newfile);   //copy to Drive
            $this->AppendF("TEST.txt", $orgfile . " to " . $newfile);
            $this->WriteF($fname, date('d-m-YH:i:s'));
        } //due=true
    }



public function ExecuteQuery($sql)
{
$error="<p align=center><font face=arial size=1 color=black>".strtoupper($sql);    

$result=mysql_query($sql);
if($result)
{
$this->rowCommitted= mysql_affected_rows();
//$this->colFetched=  mysql_numfields($result);
}
else 
echo $error."<font color=grey size=2>(".$this->Error().")</font></p>";
    
$this->returnSql=$sql;
if($this->rowCommitted>0)
$this->SaveQueryAsTextFile($sql);
return($result);
}    
  

public function Try2Execute($sql)
{

$result=mysql_query($sql);
if($result)
{
$this->rowCommitted= mysql_affected_rows();
}
else 
$this->rowCommitted=-1;    
$this->returnSql=$sql;

if($this->rowCommitted>0)
$this->SaveQueryAsTextFile($sql);
return($result);
}    




public function FetchRecords($sql)
{
$error="<p align=center><font face=arial size=1 color=black>".strtoupper($sql);    
   
$tRows=array();
$i=0;

$result=mysql_query($sql);
if($result)
{
$numRow=  mysql_num_rows($result);
$numField=mysql_numfields($result);
$this->colFetched=$numField;
while ($row=mysql_fetch_array($result))
{
for($k=0;$k<$numField;$k++)
{
$tRows[$i][$k]=$row[$k];  
}
$i++;
} //End While
}//if result
else
echo $error."<font color=grey size=2>(".$this->Error()."</font>)</p>";

$this->returnSql=$sql;
return($tRows);
} //End Fetchrecord


public function genSelectBox($id,$query,$val,$pix,$bcol,$fcol,$font,$function)
{
$error="<p align=center><font face=arial size=1 color=black>".strtoupper($query);    
    
$i=0;
$ValueList=array();
$result=mysql_query($query);
if($result)
{
while ($row=mysql_fetch_array($result))
{
$ValueList[$i][0]=$row[0];
if(isset($row[1]))
$ValueList[$i][1]=$row[1];
else
$ValueList[$i][1]= $row[0];   
$i++;
} //while Loop
$this->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
}
else
echo $error."<font color=grey size=2>(".$this->Error()."</font>)</p>";

}//GenSelectBox

//END MYSQL DEPENDENT CODE


public function Error()
{
return(mysql_error());
}

public function CountRecords($Table,$condition)
{
$sql=" select count(*) from ".$Table." where ".$condition;
$this->returnSql=$sql;
$resultRow=$this->FetchRecords($sql);
if(count($resultRow)>0)
return($resultRow[0][0]);
else
return(0);
} //rowCount


public function Max($Tbl,$Fld,$cond)
{
$sql="select max(".$Fld.") from ".$Tbl;
if(strlen($cond)<3)
$cond=true;
$sql=$sql." where ".$cond;    
$this->returnSql=$sql;
$resultRow=$this->FetchRecords($sql);
if(count($resultRow)>0)
{
if(strlen($resultRow[0][0])>0)
return($resultRow[0][0]);
else
return("0");
}
else
return(0);
}


public function Sum($tbl,$fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select sum(".$fld.") from ".$tbl." where ".$cond;
$this->returnSql=$sql;

$resultRow=$this->FetchRecords($sql);
if(count($resultRow)>0)
{
if(strlen($resultRow[0][0])>0)
return($resultRow[0][0]);
else
return("0");
}
else
return(0);
}

private function genSqlQuery($table,$fldlist,$cond)
{
$sql="Select ";
for($k=0;$k<count($fldlist);$k++)
{
$sql=$sql.$fldlist[$k];
if($k<(count($fldlist)-1))
$sql=$sql.",";    
}
$sql=$sql." from ".$table;
if(strlen($cond)>0)
$sql=$sql." where ".$cond;    
$this->returnSql=$sql;
return($sql);
}

public function FetchSingleRecord($table,$fldlist,$cond)
{
$tRows=array();
$sql=$this->genSqlQuery($table,$fldlist,$cond);
$this->returnSql=$sql;

$resultRow=$this->FetchRecords($sql);  //Get Two Diemnsional Data Row
if(count($resultRow)>0)
{
for($k=0;$k<count($fldlist);$k++)
{
$tRows[$fldlist[$k]]=$resultRow[0][$k];    
}
}//count(result)>0
return($tRows);
} //End FetchSingleRecord


public function FetchColumn($table,$fld,$cond,$default)
{
$val="";    
$sql="Select ".$fld." from ".$table." where ".$cond;
$row=$this->FetchRecords($sql);
if(count($row)>0)
$val=$row[0][0];
else
$val=$default;    
return($val);
} //End FetchSingleColumn


public function FetchSingleColumn($table,$fld,$cond)
{
return($this->FetchColumn($table, $fld, $cond, ""));
} //End FetchSingleColumn


public function FetchMultipleRecords($table,$fldlist,$cond)
{
$tRows=array();
$sql=$this->genSqlQuery($table,$fldlist,$cond);
$this->returnSql=$sql;
$resultRow=$this->FetchRecords($sql);  //Get Two Diemnsional Data Row

for($i=0;$i<count($resultRow);$i++)
{
for($k=0;$k<count($fldlist);$k++)
{
$tRows[$i][$fldlist[$k]]=$resultRow[$i][$k];    
} //for Loop $k
} //for Loop $i
return($tRows);
} //End getAllRecord


public function ExecuteBatchData($Table,$FldList,$ValueList,$Packet)
{
$numCol=count($FldList);
$numRow=count($ValueList);
$MainStr="Insert into ".$Table."(";
for($i=0;$i<$numCol;$i++)
{
$MainStr.=$FldList[$i];
if($i<($numCol-1))
$MainStr.=",";
else
$MainStr.=") Values";    
}

$ex=0;
$rowcount=0;
$Cstr="";
$commonValStr="";
$recordcount=0;

for($i=0;$i<count($ValueList);$i++)
{
$valStr="(";  
$recordcount++;
for($j=0;$j<$numCol;$j++)   
{
if($ValueList[$i][$j]=="1" || $ValueList[$i][$j]=="0")  //Probably Bit Field 
$valStr.=$ValueList[$i][$j];
else
$valStr.="'".$ValueList[$i][$j]."'";
if($j<($numCol-1))
$valStr.=",";
else
$valStr.=")";    
}//$j
if($rowcount==$Packet) //packet size reached
{
$sql=$MainStr.$commonValStr;    
if($this->ExecuteQuery($sql))
$ex+=$this->rowCommitted;    
$rowcount=0;
$commonValStr="";
//echo $sql."<br>";
}//$rowcount==$packet

$commonValStr.=$valStr;
$rowcount++;
if($rowcount<$Packet && $recordcount<$numRow)
$commonValStr.=",";
else
$commonValStr.=";";
}//$i
//Handle remaining Row
if(strlen($commonValStr)>0)
{
$sql=$MainStr.$commonValStr;    
if($this->ExecuteQuery($sql))
$ex+=$this->rowCommitted;  
}
return($ex);
}//Save Batch Data



public function genSelectBoxByValueArray($id,$ValueList,$val,$pix,$bcol,$fcol,$font,$function)
{
$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
echo "<Select name=".$id."  id=".$id." style=".chr(34).$mystyle.chr(34)." ".$function.">";
echo "<br>";
echo "<option  value=0>-Select-";
echo "<br>";
for($i=0;$i<count($ValueList);$i++)
{
$mcode=$ValueList[$i][0];
if(isset($ValueList[$i][1]))
$mdetail=$ValueList[$i][1];
else
$mdetail=$mcode;    
if($mcode==$val)
echo "<option selected value=".chr(34).$mcode.chr(34).">".$mdetail;
else
echo "<option  value=".chr(34).$mcode.chr(34).">".$mdetail;
echo "<br>";
} //for Loop
echo "</Select>";
}//GenSelectBoxByValuarray


public function genInputBox($id,$val,$size,$maxlength,$bcol,$fcol,$font,$function,$mandatory)
{
//$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
if($mandatory==2)
$text="password";
else
$text="text";
if($maxlength==0)
$maxlength=10;    
$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;";
echo "<input type=".$text." value=".chr(34).$val.chr(34)."  name=".chr(34).$id.chr(34)."  id=".chr(34).$id.chr(34)." size=".$size." maxlength=".$maxlength." style=".chr(34).$mystyle.chr(34)." onfocus=".chr(34)."ChangeColor('$id',1)".chr(34)."  onblur=".chr(34)."ChangeColor('$id',2)".chr(34)." ".$function.">";
if($mandatory)
echo "<font color=red size=3 face=arial><b>*</b></font>";
}//genInputBox


public function genButton($id,$val,$pix,$bcol,$fcol,$font,$function)
{
$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-weight:bold;font-size:".$font."px;width:".$pix."px";
echo "<input type=Button value=".chr(34).$val.chr(34)." name=".chr(34).$id.chr(34)."  id=".chr(34).$id.chr(34)."  style=".chr(34).$mystyle.chr(34)." ".$function.">";
}//genButton

public function genTextArea($id,$val,$row,$col,$bcol,$fcol,$font,$function,$mandatory)
{
//$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;";
echo "<textarea  name=".chr(34).$id.chr(34)."  id=".chr(34).$id.chr(34)." rows=".$row." cols=".$col." style=".chr(34).$mystyle.chr(34)." onfocus=".chr(34)."ChangeColor('$id',1)".chr(34)."  onblur=".chr(34)."ChangeColor('$id',2)".chr(34)." ".$function.">";
echo $val;
echo "</textarea>";
if($mandatory)
echo "<font color=red size=3 face=arial><b>*</b></font>";
}//genTextArea

public function genCheckBox($id,$val,$bcol,$fcol,$font,$function,$mandatory)
{
//$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;width:".$pix."px";
if($val==true)
$checked=" Checked=checked";
else
$checked=" ";
$mystyle="font-family: Arial;background-color:".$bcol.";color:".$fcol.";font-size:".$font."px;";
echo "<input type=checkbox  name=".chr(34).$id.chr(34)."  id=".chr(34).$id.chr(34)." style=".chr(34).$mystyle.chr(34)." ".$checked." ".$function.">";
if($mandatory)
echo "<font color=red size=3 face=arial><b>*</b></font>";
}//genCheckbox

public function genHiddenBox($id,$val)
{
echo "<input type=hidden value=".chr(34).$val.chr(34)."  name=".chr(34).$id.chr(34)."  id=".chr(34).$id.chr(34).">";
}//genInputBox


public function genDataGrid($title,$headlist,$align,$sql,$width)
{
$tAlign=array(1=>'Left',2=>'center',3=>'right');    
$row=$this->FetchRecords($sql);
$cnt=count($row);
$numcol=$this->colFetched;
if($cnt>0)
{
echo "<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=".$width."%>";
echo "<Thead><tr><td align=center colspan=".($numcol+1)."><font face=arial size=3>".$title."</td></tr>";
echo "<tr>";
echo "<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>";    
for($i=0;$i<count($headlist);$i++)
{
echo "<td align=center bgcolor=#CCCC99><font face=arial size=2>".$headlist[$i]."</td>";    
}
echo "</tr></Thead>";
//End Header
}//cnt>0
for($ind=0;$ind<count($row);$ind++)
{
$sl=($ind+1);
echo "<tr>"; 
echo "<td align=center ><font face=arial size=2>".$sl."</td>";    

for($i=0;$i<$numcol;$i++)
{
$fld=$row[$ind][$i];  
if(isset($align[$i]))
{
if(isset($tAlign[$align[$i]]))
$malign=$tAlign[$align[$i]];
else
$malign="left";  
}
else
$malign="left";   
$this->validMySqlDate($fld);
echo "<td align=".$malign." ><font face=arial size=2>".$fld."</td>";    
}
echo "</tr>";
}//end Row browse
echo "</table>";
}//genDataGrid



public function genDataGridOnValueList($title,$headlist,$align,$ValueList,$width,$records)
{
$tAlign=array(1=>'Left',2=>'center',3=>'right');    

$cnt=count($ValueList);
$numcol=count($headlist);
if($cnt>0)
{
echo "<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=".$width."%>";


echo "<Thead><tr><td align=center colspan=".($numcol+1)."><font face=arial size=3>".$title."</td></tr>";
echo "<tr>";
echo "<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>";    
for($i=0;$i<count($headlist);$i++)
{
echo "<td align=center bgcolor=#CCCC99><font face=arial size=2>".$headlist[$i]."</td>";    
}
echo "</tr></Thead>";
//End Header
}//cnt>0
for($ind=0;$ind<count($ValueList);$ind++)
{
//$tcol=$this->checkList($ind,$ValueList,$numcol);
    
$sl=($ind+1);
echo "<tr>"; 

if($ind<=($records-1))
echo "<td align=center ><font face=arial size=2>".$sl."</td>";    
else
echo "<td align=center ><font face=arial size=2>&nbsp;</td>";    
    
for($i=0;$i<$numcol;$i++)
{
if(isset($align[$i]))
{
if(isset($tAlign[$align[$i]]))
$malign=$tAlign[$align[$i]];
else
$malign="left";  
}
else
$malign="left"; 

if(isset($ValueList[$ind][$i]))
$fld=$ValueList[$ind][$i]; 
else
$fld="&nbsp;";    
echo "<td align=".$malign." ><font face=arial size=2>".$fld."</td>";    
}
echo "</tr>";
}//end Row browse
echo "</table>";
}//genDataGrid


private function checkList($ind,$ValueList,$numcol)
{
$er=0;    
 for($i=0;$i<$numcol;$i++)
    {
 if(!isset($ValueList[$ind][$i]))  
 $er++;    
    }  
return($er);    
}


public function validMySqlDate(&$fld)
{
$dt=$fld;
$date=$this->to_date($dt);

if(strlen($date)==10)
{
$fld=$date;   
return(true);
}
else
return(false);    
}

public function to_date($mydate)
{
$dt=array();
$dt="";
if (strlen($mydate)>=10)
{
$md=substr($mydate,0,10);
$dt=explode("-",$md);
if (isset($dt[2]) && isset($dt[1]) && isset($dt[0]))
{
$dt=$dt[2]."/".$dt[1]."/".$dt[0];
}
else
$dt=$mydate;
}
return($dt);
}


public function genExcelFileBySql($headlist,$align,$sql,$fname)
{
$dname=$fname.".xls";
$fname =$fname.".htm";

$ts = fopen($fname, 'w') or die("can't open file");
   
$tAlign=array(1=>'Left',2=>'center',3=>'right');    
$row=$this->FetchRecords($sql);
$cnt=count($row);
$numcol=$this->colFetched;
if($cnt>0)
{
fwrite($ts,"<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>");
fwrite($ts,"\n");
fwrite($ts,"<tr>");
fwrite($ts,"<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>");    
fwrite($ts,"\n");
for($i=0;$i<count($headlist);$i++)
{
fwrite($ts,"<td align=center bgcolor=#CCCC99><font face=arial size=2>".$headlist[$i]."</td>");    
fwrite($ts,"\n");
}
fwrite($ts,"</tr>");
fwrite($ts,"\n");
//End Header
}//cnt>0
for($ind=0;$ind<count($row);$ind++)
{
$sl=($ind+1);
fwrite($ts,"<tr>"); 
fwrite($ts,"<td align=center ><font face=arial size=2>".$sl."</td>");    

for($i=0;$i<$numcol;$i++)
{
$fld=$row[$ind][$i];  
if(isset($align[$i]))
{
if(isset($tAlign[$align[$i]]))
$malign=$tAlign[$align[$i]];
else
$malign="left";  
}
else
$malign="left"; 

$this->validMySqlDate($fld);
fwrite($ts,"<td align=".$malign." ><font face=arial size=2>".$fld."</td>");    
}
fwrite($ts,"</tr>");
}//end Row browse
fwrite($ts,"</table>");

//Copy HTM file to excell

copy($fname, $dname); 
        
}//genExcelFileBySql


public function genExcelFileByValueList($headlist,$align,$ValueList,$fname)
{
$dname=$fname.".xls";
$fname =$fname.".htm";

$ts = fopen($fname, 'w') or die("can't open file");
   
$tAlign=array(1=>'Left',2=>'center',3=>'right');    
$cnt=count($ValueList);
$numcol=count($headlist);
if($cnt>0)
{
fwrite($ts,"<table border=1 align=center cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=100%>");
fwrite($ts,"\n");
fwrite($ts,"<tr>");
fwrite($ts,"<td align=center bgcolor=#CCCC99><font face=arial size=2>SlNo</td>");    
fwrite($ts,"\n");
for($i=0;$i<count($headlist);$i++)
{
fwrite($ts,"<td align=center bgcolor=#CCCC99><font face=arial size=2>".$headlist[$i]."</td>");    
fwrite($ts,"\n");
}
fwrite($ts,"</tr>");
fwrite($ts,"\n");
//End Header
}//cnt>0
for($ind=0;$ind<count($ValueList);$ind++)
{
$sl=($ind+1);
fwrite($ts,"<tr>"); 
fwrite($ts,"<td align=center ><font face=arial size=2>".$sl."</td>");    

for($i=0;$i<$numcol;$i++)
{
if(isset($ValueList[$ind][$i]))    
$fld=$ValueList[$ind][$i];  
else
$fld="&nbsp;";

if(isset($align[$i]))
{
if(isset($tAlign[$align[$i]]))
$malign=$tAlign[$align[$i]];
else
$malign="left";  
}
else
$malign="left"; 

fwrite($ts,"<td align=".$malign." ><font face=arial size=2>".$fld."</td>");    
}
fwrite($ts,"</tr>");
}//end Row browse
fwrite($ts,"</table>");

//Copy HTM file to excell
copy($fname, $dname); 
}//genExcelFileBySql


//EXTRA UTILITY FUNCTION

public function RetriveField($sql)
{
$tr=array();
$sql=strtoupper($sql);    
if($this->ExecuteQuery($sql)) 
{
$totcol=$this->colFetched;
$ind=$this->inStr($sql,"FROM");
$tsql=substr($sql,0,$ind-1);
$frow=explode(",",$tsql);
for($i=0;$i<count($frow);$i++)
{
$tr[$i]=$this->processBlank($frow[$i]);  
}//for
}//if
return($tr);
}

private function processBlank($aa)
{
$aa=trim($aa);    
$row=explode(" ",$aa);   
$n=count($row)-1;
if(isset($row[$n]))
return($row[$n]);
else
return("");    
}


public function inStr($str,$find)
{
$temp=strlen($find);
$mindex=0;
$found=-1;
$lnth=strlen($str)-$temp;
while (($mindex<=$lnth) && ($found==-1))
{
if (substr($str,$mindex,$temp)==$find)
{
$found=$mindex;
}
$mindex++;
} //end while
return($found);
}  //end function

public function RestoreData($filename,&$success,&$fail)
{
$fp = fopen( $filename, "r" ) or die("Couldn't open $filename");
$str="";
while ( ! feof( $fp ) ) 
{
   $line = fgets( $fp, 1024 );
   $str=$str.$line;
}
 
$myrow=array();
$myrow=explode(";",$str);   //Segrigate the String into SQL Statement on Semicolon

$Length=count($myrow);
$success=0;
$fail=0;
for($i=0;$i<count($myrow)-1;$i++)
{
if($this->Try2Execute($myrow[$i]))
$success++;
else
$fail++;
}
} //End Restore Data

public function TotLines($filename)
{
$fp = fopen( $filename, "r" ) or die("Couldn't open $filename");
$str="";
while ( ! feof( $fp ) ) 
{
   $line = fgets( $fp, 1024 );
   $str=$str.$line;
}
$myrow=array();
$myrow=explode(";",$str);   //Segrigate the String into SQL Statement on Semicolon
$Length=count($myrow);
return($Length-1);
}


public function genDatePicker($Fld,$level)
{
if($level==1)
$path="./datepicker/images/calendar.png";
if($level==2)
$path="../datepicker/images/calendar.png";
if($level==3)
$path="../../datepicker/images/calendar.png";
?>
<img src="<?php echo $path;?>" align="absmiddle" width="25" height="25" onClick="GetDate(<?php echo $Fld;?>);" alt="Click Here to Pick Date">
 <?php   
} //genDatePicker

public function TdInputBoxWithDatePicker($align,$bcol,$id,$val,$size,$maxlength,$function,$level)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genInputBox($id, $val, $size, $maxlength,$this->bcol, $this->fcol, $this->font, $function, 0);
$this->genDatePicker($id, $level);
echo "<font face=arial size=1>DD/MM/YYYY</font>";
echo "</td>";
}//Tdtext


public function TdText($align,$font,$text,$width,$rspan,$cspan)
{
$text=trim($text);    
$span="";    
if($cspan>1)
$span=" Colspan=".$cspan;

if($rspan>1)
$span.=" Rowspan=".$rspan;

$wdt="";
if($width>0)
$wdt=" width=".chr(34).$width."%".chr(34);    

if(strlen($text)==0)
$text="&nbsp;";    

if ($align==4) //Justified
$text="<div align=justify>".$text."</div>";
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$this->bcol.$span.$wdt.">" ;
echo "<font face=arial size=".chr(34).$font.chr(34)." color=".chr(34).$this->fcol.chr(34).">";
echo $text."</font></td>";
}//Tdtext


public function TdTextArea($align,$bcol,$id,$val,$row, $col,$function,$mandatory)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genTextArea($id, $val, $row, $col, $this->bcol, $this->fcol, $this->font, $function, $mandatory);
echo "</td>";
}//Tdtext

public function TdInputBox($align,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genInputBox($id, $val, $size, $maxlength,$this->bcol, $this->fcol, $this->font, $function, $mandatory);
echo "</td>";
}//Tdtext

public function TdSelectBox($align,$bcol,$id,$val,$query,$pix,$function)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genSelectBox($id, $query, $val, $pix, $this->bcol, $this->fcol, $this->font,$function);
echo "</td>";
}//Tdtext

public function TdCheckBox($align,$bcol,$id,$val,$function)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genCheckBox($id, $val, $this->bcol, $this->fcol, $this->font, $function,0);
echo "</td>";
}//Tdtext

public function TdButton($align,$bcol,$id,$val,$pix,$function)
{
echo "<td align=".chr(34).$this->mAlign[$align].chr(34)." bgcolor=".$bcol.">" ;
$this->genButton($id, $val, $pix, $this->bcol, $this->fcol, $this->font, $function);
echo "</td>";
}//Tdtext

public function returnGeneralCheckBox($id, $val,  $function) {
        //DATABASE INDEPENDANT
        $bcol=$this->bcol;
        $fcol=$this->fcol;
        $font=$this->font;
      if ($val == 1)
            $checked = " Checked=checked";
        else
            $checked = " ";
        $mystyle = "font-family: Arial;background-color:" . $bcol . ";color:" . $fcol . ";font-size:" . $font . "px;";
        $ret= "<input type=checkbox  name=" . chr(34) . $id . chr(34) . "  id=" . chr(34) . $id . chr(34) . " style=" . chr(34) . $mystyle . chr(34) . " " . $checked . " " . $function . ">";
        return($ret);
        }


}//End Class
?>
