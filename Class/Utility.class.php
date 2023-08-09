
<?php
require_once 'class.PWD.php';
require_once 'class.CommonParameter.php';
class Utility  extends CommonParameter
{
public $mDays=array();
public $conA;
public $ServerIP;
private $uniconverter=array();

public function Utility()
{
$this->mDays[1] = 31;
$this->mDays[2] = 29;
$this->mDays[3] = 31;
$this->mDays[4] = 30;
$this->mDays[5] = 31;
$this->mDays[6] = 30;
$this->mDays[7] = 31;
$this->mDays[8] = 31;
$this->mDays[9] = 30;
$this->mDays[10] = 31;
$this->mDays[11] = 30;
$this->mDays[12] = 31;

$this->ServerIP="192.168.1.1:8080";

$this->uniconverter['0']="০";
$this->uniconverter['1']="১";
$this->uniconverter['2']="২";
$this->uniconverter['3']="৩";
$this->uniconverter['4']="৪";
$this->uniconverter['5']="৫";
$this->uniconverter['6']="৬";
$this->uniconverter['7']="৭";
$this->uniconverter['8']="৮";
$this->uniconverter['9']="৯";

} //constructor

private function MarkPresent()
{
$uid="-";
if (isset($_SESSION['uid']))
$uid=$_SESSION['uid'];
$objPwd=new Pwd();
$sql="update userlog set Log_time_out='".date('H:i:s')."' where active='Y' and Log_date='".date('Y-m-d')."' and Uid='".$uid."'";
$objPwd->ExecuteQuery($sql);
}


public function VerifyRoll()
{
//Use your Business Logic  to Verify Every page(Use/Password,Ip etc))
$t=0; //default is alwayas true
//$t=-1;
$this->MarkPresent();

if (!isset($_SESSION['roll']))
$_SESSION['roll']=-1;

if (!isset($_SESSION['uid']))
$_SESSION['uid']="-";

if (!isset($_SESSION['pwd']))
$_SESSION['pwd']="-";

$objPwd=new Pwd();
$objPwd->setUid($_SESSION['uid']);
if ($objPwd->EditRecord())
{
if ($objPwd->getPwd()==trim($_SESSION['pwd']))
$t=$objPwd->getRoll();
}
return($t);
}

public function isdate($mdate)
{
$t=true;
$dtarray=explode("/",$mdate);
if (count($dtarray)==3)
{
$dtarray[0]=round($dtarray[0]) ;
$dtarray[1]=round($dtarray[1]) ;
if (($dtarray[2]%4)==0)
$this->mDays[2] = 29;
if(is_numeric($dtarray[2]) && is_numeric($dtarray[1]) && is_numeric($dtarray[0]))
$t=true;
else
$t=false;
if (($dtarray[1]<1) || ($dtarray[1]>12))
$t=false;
if (($dtarray[0]<1)  || ($dtarray[0]>31))
$t=false;
if ($dtarray[1]>0 && $dtarray[1]<13 )
{
if ($dtarray[0]>$this->mDays[$dtarray[1]])
$t=false;
}
}
else
$t=false;
return($t);
}

public function to_mysqldate($mdate)
{
$dt=explode("/",$mdate);
if (isset($dt[0]))
$dd=$dt[0];
else
$dd="01";

if (isset($dt[1]))
$mm=$dt[1];
else
$mm="01";
if (isset($dt[2]))
$yy=$dt[2];
else
$yy="1900";

if($dd<10)
{
$dd+=100;
$dd=substr($dd,-2);
}

if($mm<10)
{
$mm+=100;
$mm=substr($mm,-2);
}

if(strlen($yy)==2)
$yy+=2000;

$dt=$yy."-".$mm."-".$dd;
return($dt);
}

public function to_date($mydate)
{
$dt=array();
$dt="";
if (strlen($mydate)>=10)
{
$mydate=substr($mydate,0,10);
$dt=explode("-",$mydate);
if (isset($dt[2]))
$dd=$dt[2];
else
$dd="01";

if (isset($dt[1]))
$mm=$dt[1];
else
$mm="01";

if (isset($dt[0]))
$yy=$dt[0];
else
$yy="01";

$dt=$dd."/".$mm."/".$yy;
}
return($dt);
}

public function isUnicodeCharExist($mystring)
{
$t=false;
if (strlen($mystring) != strlen(utf8_decode($mystring)))
$t=true;
else
$t=false;
return($t);
}


function inStr($str,$find)
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


public function isUnicode($mystring)
{
$t=true;
$token=array();
$j=0;
$start=0;
$mystring=str_replace(",", "",$mystring);
$mystring=str_replace("-", "",$mystring);
$mystring=str_replace(".", "",$mystring);
$mystring=$mystring." ";
for($i=0;$i<strlen($mystring);$i++)
{
if (substr($mystring,$i,1)==" ")
{
$length=$i-$start;
$token[$j]=substr($mystring,$start,$length);
$start=$i+1;
if (strlen($token[$j]) !=(3* strlen(utf8_decode($token[$j]))))
$t=false;
$j++;
}
}
return($t);
}

//Java Focus Functionafter postback
public function focus($a)
{
$temp="<Script language=javascript>\n";
$temp=$temp."document.getElementById('".$a."').focus();//set Focus on Yr\n";
$temp=$temp."</script>";
return($temp);
}


public function alert($a)
{
$temp="";
if (strlen($a)>0)
{
$temp="<Script language=javascript>\n";
$temp=$temp."alert('".$a."');//Make an alert\n";
$temp=$temp."</script>";
}
return($temp);
}




public function AlertNRedirect($a,$page)
{
$temp="";
$temp="<Script language=javascript>\n";
if (strlen($a)>0)
$temp=$temp."alert('".$a."');//Make an alert\n";
if (strlen($page)>4)
$temp=$temp."document.location.href=".chr(34).$page.chr(34).";//redirect to\n";
$temp=$temp."</script>";
return($temp);
}


public function assign($a,$b)
{
$temp="<Script language=javascript>\n";
$temp=$temp."document.getElementById('".$a."').value=".chr(34).$b.chr(34).";//set Value\n";
$temp=$temp."</script>";
return($temp);
}

public function SelectedIndex($a,$b)
{
$temp="<Script language=javascript>\n";
$temp=$temp."document.getElementById('".$a."').selectedIndex=".$b.";//set Selected Index\n";
$temp=$temp."</script>";
return($temp);
}

public function validate($str,$length)
{
$found=true;

if(!isset($length))
$length=200;

if (strlen($str)>$length)
$found=false;
if (preg_match("/'/",$str))
$found=false;

if (preg_match("/--/",$str))
$found=false;


if (preg_match("/</",$str))
$found=false;


if (preg_match("/>/",$str))
$found=false;

if (preg_match("/;/",$str))
$found=false;

//if (preg_match("/&/",$str))
//$found=false;

$str=strtoupper($str);
if (preg_match("/SELECT /",$str))
$found=false;

if (preg_match("/INSERT /",$str))
$found=false;

if (preg_match("/DELETE /",$str))
$found=false;

if (preg_match("/VBSCRIPT/",$str))
$found=false;

if (preg_match("/JAVASCRIPT/",$str))
$found=false;


return($found);
}


public function SimpleValidate($str,$length)
{
$found=true;
if (strlen($str)>$length)
$found=false;
if (preg_match("/'/",$str))
$found=false;

if (preg_match("/--/",$str))
$found=false;

if (preg_match("/;/",$str))
$found=false;


return($found);
}

public function saveSqlLog($tbl,$line)
{
 $path=$this->ApplicationFolder();
    
$dd=$path."/log/".$tbl."_".date('dmY');
$fname = $dd.".sql";
$ts = fopen($fname, 'a') or die("can't open file");
$line=$line.";\n";
fwrite($ts, $line);
}

public function elapsedTime($t1,$t2)
{
$row=array();
$h1=substr($t1,0,2) ;
$m1=substr($t1,3,2) ;
$s1=substr($t1,6,2) ;
$h2=substr($t2,0,2) ;
$m2=substr($t2,3,2) ;
$s2=substr($t2,6,2) ;
if ($s2<=$s1)
$s=$s1-$s2;
else
{
$s1=$s1+60;
$m1=$m1-1;
$s=$s1-$s2;
}
if ($m2<=$m1)
$m=$m1-$m2;
else
{
$m1=$m1+60;
$h1=$h1-1;
$m=$m1-$m2;
}
if ($h2<=$h1)
$h=$h1-$h2;
else
$h=0;
$row['h']=$h;
$row['m']=$m;
$row['s']=$s;
return($row);
}

public function elapsedTimeMsg($t1,$t2)
{
$row=array();
$mrow=$this->elapsedTime($t1, $t2);
$tt="";
if ($mrow['h']>0)
$tt= $tt.$mrow['h']." Hours";
if ($mrow['m']>0)
$tt= $tt.$mrow['m']." Min";
if ($mrow['s']>0)
$tt= $tt.$mrow['s']." Sec";
return($tt);
}

public function Clock($t1,$t2)
{
$row=array();
$mrow=$this->elapsedTime($t1, $t2);
$tt="";
$tt= $tt.substr((100+$mrow['h']),1,2).":";
$tt= $tt.substr((100+$mrow['m']),1,2).":";
$tt= $tt.substr((100+$mrow['s']),1,2);
return($tt);
}

public function getMonthName($code)
{
 switch ($code)
 {
  case 1:
      return("January");
      break;
  case 2:
      return("February");
      break;
  case 3:
      return("March");
      break;
  case 4:
      return("April");
      break;
  case 5:
      return("May");
      break;
  case 6:
      return("June");
      break;
  case 7:
      return("July");
      break;
  case 8:
      return("August");
      break;
  case 9:
      return("September");
      break;
  case 10:
      return("October");
      break;
  case 11:
      return("November");
      break;
  case 12:
      return("December");
      break;
      
 }
   
}

public function checkArea($myArea,$code)
{
$myrow=array();
$found=false;
if ($myArea=="0") //For Administrator
$found=true;
else
{    
$myrow=explode(",",$myArea);
for ($i=0;$i<count($myrow);$i++)
{
//echo $myrow[$i]."=".$code."<br>";    
if (isset($myrow[$i]))  
{
if($myrow[$i]==$code)  
$found=true;     
}    
//echo $found;
} //for loop
} //myArea==0

return($found);
} 

public function datePlusMinus($date1,$offset)
{
if($offset<0) 
$date=$this->dateMinus($date1, $offset);
else
$date=$this->datePlus($date1, $offset);    
return($date);
}



public function datePlus($date1,$offset)
{
  
$date1=$date1."- " ;
$date="";

if($offset<0)
$offset=0;

$row=explode("-",$date1);

if (isset($row[0]))
$yy1=$row[0];
else
$yy1=0;

if (isset($row[1]))
$mm1=round($row[1]);
else
$mm1=0;

if (isset($row[2]))
$dd1=round($row[2]);
else
$dd1=0;


if($yy1%4==0) //Leap Year
$this->mDays[2]=29;

$dd1=$dd1+$offset;

if($dd1<=$this->mDays[$mm1] && $dd1>0)
$date=$yy1."-".$mm1."-".$dd1;    
else
{
while ($dd1>$this->mDays[$mm1])
{
$dd1=$dd1-$this->mDays[$mm1];
$mm1=$mm1+1;
if($mm1>12)
{
$mm1=1;
$yy1=$yy1+1;
}    
}
$date=$yy1."-".$mm1."-".$dd1; 
}

return($date);
}


public function dateMinus($date1,$offset)
{
  
$date1=$date1."- " ;
$date="";

if($offset<0)
$offset=0-$offset;

$row=explode("-",$date1);

if (isset($row[0]))
$yy1=$row[0];
else
$yy1=0;

if (isset($row[1]))
$mm1=round($row[1]);
else
$mm1=0;

if (isset($row[2]))
$dd1=round($row[2]);
else
$dd1=0;


if($yy1%4==0) //Leap Year
$this->mDays[2]=29;

//echo "dd1offset".($dd1-$offset)."<br>";

$dd=1;
if($dd1-$offset>0)
$date=$yy1."-".$mm1."-".($dd1-$offset);    //

if($dd1-$offset<=0)
{
$mm1=$mm1-1;
if($mm1==0)
{
$mm1=1;
$yy1=$yy1-1;
}
//echo $mm1."-".$yy1."<br>";
$dd1=$this->mDays[$mm1]-($offset-$dd1);
//echo "<br>dd1=".$dd1."<br>";
if($dd1<=$this->mDays[$mm1] && $dd1>0)
$date=$yy1."-".$mm1."-".$dd1;  
else
$dd=$dd1;
} //$dd1-$offset


if ($dd<=0)
{    
$i=0;
while ($dd<=0)
{
$i++;
$mm1=$mm1-1;
if($mm1==0)
{
$yy1=$yy1-1;
$mm1=12;
}
$dd=$dd+$this->mDays[$mm1];
}//while
$date=$yy1."-".$mm1."-".$dd;
} //if $dd1<0

return($date);
}

public function dateDiff($date1,$date2)
{
$date1=$date1."- " ;
$date2=$date2."- ";
$row=explode("-",$date1);
if (isset($row[0]))
$yy1=$row[0];
else
$yy1=0;
if (isset($row[1]))
$mm1=round($row[1]);
else
$mm1=0;
if (isset($row[2]))
$dd1=round($row[2]);
else
$dd1=0;
//echo $yy1.$mm1.$dd1."<br>";

$row=explode("-",$date2);
if (isset($row[0]))
$yy2=$row[0];
else
$yy2=0;
if (isset($row[1]))
$mm2=round($row[1]);
else 
$mm2=0;    
if (isset($row[2]))
$dd2=round($row[2]);
else
$dd2=0;
//echo $yy2.$mm2.$dd2."<br>";

if($dd1<$dd2)
{
$mtag=round($mm2);
$dd1=$dd1+$this->mDays[$mtag];
$mm1=$mm1-1;
}


if($mm1<$mm2)
{
$mm1=$mm1+12;
$yy1=$yy1-1;
}

$tmp=($dd1-$dd2)+30*($mm1-$mm2)+365*($yy1-$yy2);
return($tmp);
}
public function Month($i)
{
$tt="";
switch($i)
{
case 1:$tt="January";
       break;
case 2:$tt="February";
       break;
case 3:$tt="March";
       break;
case 4:$tt="April";
       break;
case 5:$tt="May";
       break;
case 6:$tt="June";
       break;
case 7:$tt="July";
       break;
case 8:$tt="August";
       break;
case 9:$tt="September";
       break;
case 10:$tt="October";
       break;
case 11:$tt="November";
       break;
case 12:$tt="December";
       break;
}
 return($tt);   
}
public function NextDate($mdate,$cday)
{
$dt=explode("/",$mdate);
if (isset($dt[0]))
$dd=$dt[0];
else
$dd="01";
if (isset($dt[1]))
$mm=$dt[1];
else
$mm="01";
if (isset($dt[2]))
$yy=$dt[2];
else 
$yy="1900";    

$m=round($mm);

$d=round($dd);
  
$lastdd=$this->mDays[$m];

//if($yy%4==0 && $m==2) //LeapYear
//$lastdd=$lastdd+1;

///echo "Last day".$lastdd;

//echo "<br>";
//echo $d+$cday;

if(($d+$cday)>$lastdd)
{
$d=$d+$cday-$lastdd;  //day exced to next month 
$m=$m+1;
if ($m>12)
{
$m=1;
$yy=$yy+1;
}
}
else
$d=$d+$cday;

$dt=$d."/".$m."/".$yy;
return($dt);    
}

public function fYear($yr,$mn)
{
if ($mn<4)
$tmp=($yr-1)."-".$yr;
else
$tmp=($yr)."-".($yr+1);
return($tmp);
}


public function toUniNumber($mstr)
{
$temp="";

for ($ind=0;$ind<strlen($mstr);$ind++)  
{
$j=substr($mstr,$ind,1);
if (isset($this->uniconverter[$j]))
$temp=$temp.$this->uniconverter[$j];  
else 
$temp=$temp.$j;    
}    

return($temp);
}
      
public function Backup2Access($Dbname,$Sql)
{
if($this->ExecuteAccessQuery($Dbname, $Sql))
return(true);
else
return(false);    
} //end Backup2Access


public function ExecuteAccessQuery($Dbname,$Sql)
{
//$db=realpath($Dbname);
//$this->saveSqlLog("Access",date('h:i:s A'));
//$this->saveSqlLog("Access",$Sql);
try
{
$this->OpenAccess($Dbname) ;   
$this->conA->Execute($Sql);
//$this->saveSqlLog("Access","Executed ");
$this->CloseAccess();
$res=true;
}
catch(Exception $ex)
{
$res=false;
//$this->saveSqlLog("Access","Failed to Execute");
}
//$this->saveSqlLog("Access","");
return($res);
} //end ExecuteAccess

public function OpenAccess($Dbname)
{
if (isset($_SESSION['backuppath']))
$db=$_SESSION['backuppath'];
else
{
if(substr(strtoupper($Dbname),-4)==".MDB")
$db=realpath($Dbname);
else
$db="";
}
try
{
$this->conA=new COM('ADODB.Connection');
$this->conA->Open("Provider=Microsoft.Jet.OLEDB.4.0;Data Source=$db");
$res=true;
//$this->saveSqlLog("Access","Opened");
}
catch(Exception $ex)
{
$res=false;
//$this->saveSqlLog("Access","Failed to Open");
}
return($res);
} //end Open Access

public function CloseAccess()
{
try
{
$this->conA->Close();
$res=true;
//$this->saveSqlLog("Access","Closed");
}
catch(Exception $ex)
{
$res=false;
//$this->saveSqlLog("Access","Failed to Closed");
}
} //Close Access

public function CreateLogFile($tbl,$line,$level,$type)
{
$dt=date('dmY');  //default is Year Nonth Date

$path=$this->ApplicationFolder();

$dd=$path."/log/".$tbl."_".$dt;

$fname = $dd.".sql";
$ts = fopen($fname, 'a') or die("can't open file");
$line=$line.";\n";
fwrite($ts, $line);

}//CreateLogFile

public function AddMonthOffset($opdate,$term,$offset)
{
   
$yyyy=round(substr($opdate,0,4));
$mm=round(substr($opdate,5,2));
$dd=substr($opdate,8,2);

while($term>11)
{
$yyyy++;
$term-=12;
}

$mm+=$term;
  
if($mm>12)
{
$yyyy++;
$mm-=12;
}   

$dd+=$offset;

if($dd>$this->mDays[$mm])
{
$dd-=$this->mDays[$mm];
$mm++;
if($mm>12)
{
$yyyy++;
$mm=1;
} 
}//$dd>$this->m

$dd+=100;
$mm+=100;

$dd=substr($dd,-2);
$mm=substr($mm,-2);
$mdate=$yyyy."-".$mm."-".$dd;
return($mdate);    
} //AddMonth Offset



public function datePlusMinusWithoutDash($date1,$offset)
{
if($offset<0) 
$date=$this->dateMinus($date1, $offset);
else
$date=$this->datePlus($date1, $offset);  

$row=explode("-",$date);

$yy=$row[0];
$mm=$row[1];
$dd=$row[2];

if($mm<10)
$mm=substr((100+$mm),1,2);
if($dd<10)
$dd=substr((100+$dd),1,2);

$date=$yy.$mm.$dd;
return($date);
}

public function ismysqldate($mdate)
{
$t=true;
$mdate=substr($mdate,0,10);
$dtarray=explode("-",$mdate);
if (count($dtarray)==3)
{
if (substr($dtarray[1],0,1)=="0")
$dtarray[1]=substr($dtarray[1],-1);
if (($dtarray[0]%4)==0) //leapyear
$this->mDays[2] = 29;
if(is_numeric($dtarray[2]) && is_numeric($dtarray[1]) && is_numeric($dtarray[0]))
$t=true;
else
$t=false;
if (($dtarray[1]<1) || ($dtarray[1]>12))
$t=false;
if (($dtarray[2]<1)  || ($dtarray[2]>31))
$t=false;
if ($dtarray[1]>0 && $dtarray[1]<13 )
{
if ($dtarray[2]>$this->mDays[$dtarray[1]])
$t=false;
}
}
else
$t=false;
return($t);
}
 
 //end ismysqldate()
 
public function returnDateType(&$Fld, $AllowNull, &$Err) {
$Tag = -1;
$Err=" Invalid Date";
 if ($AllowNull == true && strlen($Fld) == 0)
  {
  $Fld = "NULL";
  $Tag=0;
  }
else 
 {
  if ($this->isdate($Fld) == true)
  $Tag=1;
  if($this->ismysqldate($Fld)==true)
  $Tag=2;
  }
if ($Tag >= 0)
$Err=""; 
 return($Tag);
}
 
 //end returnDateType() 


public function ValidateNumber(&$Fld, $AllowNull, &$Err) {
        $Tag = 0;
        if($AllowNull==true)
        {
         if(is_numeric($Fld)==false && strlen($Fld)>0)   
         $Tag++;   
        }
        
        if($AllowNull==false)
        {
         if(is_numeric($Fld)==false)   
         $Tag++;   
        }
    if ($AllowNull == true && strlen($Fld) == 0)
            $Fld = "NULL";
    
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

//validateNumber

    public function ValidateText(&$Fld, $Unicode, $StrongValid, $Length, $AllowNull, &$Err) {
          $Tag = 0;
        //if ($AllowNull == true && strlen($Fld) == 0)
            //$Fld = "NULL";
        if ($StrongValid == true) {
            if ($this->validate($Fld, $Length) == false) {
                $Err=" Validation Fails ";
                $Tag++;
            }
        }//$StrongValid==true

        if ($StrongValid == false) {
            if ($this->SimpleValidate($Fld, $Length) == false) {
                $Err=" Validation Fails ";
                $Tag++;
            }
        }//$StrongValid==false


        if ($Unicode == false && $this->isUnicodeCharExist($Fld) == true) {
            $Err=" Unicode Character Exist";
            $Tag++;
        }

        if ($Unicode == true && $this->isUnicode($Fld) == false) {
            $Err=" Non Unicode Exist";
            $Tag++;
        }
        
        if ($AllowNull == false && strlen($Fld) == 0)
        {
            $Err=" Null Value Found";
            $Tag++;
        }
         
        if ($AllowNull == true && strlen($Fld) == 0)
        {
        $Fld="NULL";    
        }
        
            
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

//validateText

    public function ValidateDate(&$Fld, $AllowNull, &$Err) {
        $Tag = 0;
           if ($AllowNull == true && strlen($Fld) == 0)
            $Fld = "NULL";
        else {
            if ($this->isdate($Fld) == false) {
                $Err=" Invalid Date";
                $Tag++;
            }
        }
        if ($Tag > 0)
            return(false);
        else
            return(true);
    }

}//end Utility Class
