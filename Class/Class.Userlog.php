<?php
//require_once 'class.config.php';
require_once 'class.config.php';
require_once 'class.DBManager.php';
class Userlog  extends DBManager
{
private $Uid;
private $Log_date;
private $Log_time_in;
private $Log_time_out;
private $Client_ip;
private $Session_id;
private $Left_frame;
private $Middle_frame;
private $Right_frame;
private $Active;

private $fieldList=array("Uid","Log_date","Log_time_in","Log_time_out","Client_ip","Session_id","Left_frame","Middle_frame","Right_frame","Active");

//extra Old Variable to store Pre update Data
private $Old_Uid;
private $Old_Log_date;
private $Old_Log_time_in;
private $Old_Log_time_out;
private $Old_Client_ip;
private $Old_Session_id;
private $Old_Left_frame;
private $Old_Middle_frame;
private $Old_Right_frame;
private $Old_Active;

private $condString;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Userlog()
{
$objC=new Config();
$this->colUpdated=0;
$this->updateList="";
$this->condString="1=1";
$this->Log_date=date('Y-m-d');
if (isset($_SERVER['REMOTE_ADDR']))
$this->Client_ip= $_SERVER['REMOTE_ADDR'];  
else
$this->Client_ip="NA";

if(isset($_SESSION['sid']))
$this->Session_id=$_SESSION['sid'];
else
$this->Session_id=0;

//echo "USer-Log Constructor -session-ID-".$this->Session_id."<br>";
}//End constructor



public function rowCount($condition)
{
return($this->CountRecords("userlog", $condition));
} //rowCount


public function getRow($cond)
{
$fldlist=array("Session_id","Uid");
$tRow=array();
$sql="select Session_id,Uid from userlog where ".$cond;
$tRow=$this->FetchMultipleRecords("userlog",$fldlist,$cond);
return($tRow);
}


public function getUid()
{
return($this->Uid);
}

public function setUid($str)
{
$this->Uid=$str;
}

public function getLog_date()
{
return($this->Log_date);
}

public function setLog_date($str)
{
$this->Log_date=$str;
}

public function getLog_time_in()
{
return($this->Log_time_in);
}

public function setLog_time_in($str)
{
$this->Log_time_in=$str;
}

public function getLog_time_out()
{
return($this->Log_time_out);
}

public function setLog_time_out($str)
{
$this->Log_time_out=$str;
}

public function getClient_ip()
{
return($this->Client_ip);
}

public function setClient_ip($str)
{
$this->Client_ip=$str;
}

public function getSession_id()
{
return($this->Session_id);
}

public function setSession_id($str)
{
$this->Session_id=$str;
}

public function getLeft_frame()
{
return($this->Left_frame);
}

public function setLeft_frame($str)
{
$this->Left_frame=$str;
}

public function getMiddle_frame()
{
return($this->Middle_frame);
}

public function setMiddle_frame($str)
{
$this->Middle_frame=$str;
}

public function getRight_frame()
{
return($this->Right_frame);
}

public function setRight_frame($str)
{
$this->Right_frame=$str;
}

public function getActive()
{
return($this->Active);
}

public function setActive($str)
{
$this->Active=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$cond="Session_id=".$this->Session_id;
$row=$this->FetchSingleRecord("userlog",$this->fieldList,$cond);
if (count($row)>0)
{
if (strlen($row['Uid'])>0)
$this->Old_Uid=$row['Uid'];
else
$this->Old_Uid="NULL";
if (strlen($row['Log_date'])>0)
$this->Old_Log_date=substr($row['Log_date'],0,10);
else
$this->Old_Log_date="NULL";
if (strlen($row['Log_time_in'])>0)
$this->Old_Log_time_in=$row['Log_time_in'];
else
$this->Old_Log_time_in="NULL";
if (strlen($row['Log_time_out'])>0)
$this->Old_Log_time_out=$row['Log_time_out'];
else
$this->Old_Log_time_out="NULL";
if (strlen($row['Client_ip'])>0)
$this->Old_Client_ip=$row['Client_ip'];
else
$this->Old_Client_ip="NULL";
if (strlen($row['Left_frame'])>0)
$this->Old_Left_frame=$row['Left_frame'];
else
$this->Old_Left_frame="NULL";
if (strlen($row['Middle_frame'])>0)
$this->Old_Middle_frame=$row['Middle_frame'];
else
$this->Old_Middle_frame="NULL";
if (strlen($row['Right_frame'])>0)
$this->Old_Right_frame=$row['Right_frame'];
else
$this->Old_Right_frame="NULL";
if (strlen($row['Active'])>0)
$this->Old_Active=$row['Active'];
else
$this->Old_Active="NULL";
return(true);
}
else
return(false);
} //end copy variable


public function EditOnCondition($cond)
{
$row=array();
$row=$this->FetchSingleRecord("userlog",$this->fieldList,$cond);
if (count($row)>0)
{
$this->Uid=$row['Uid'];
$this->Log_date=$row['Log_date'];
$this->Log_time_in=$row['Log_time_in'];
$this->Log_time_out=$row['Log_time_out'];
$this->Client_ip=$row['Client_ip'];
$this->Session_id=$row['Session_id'];
$this->Left_frame=$row['Left_frame'];
$this->Middle_frame=$row['Middle_frame'];
$this->Right_frame=$row['Right_frame'];
$this->Active=$row['Active'];
return(true);
}
else
return(false);
} //end EditRecord


public function EditRecord()
{
$cond="Session_id=".$this->Session_id;
$row=$this->FetchSingleRecord("userlog",$this->fieldList,$cond);
if (count($row)>0)
{
$this->Uid=$row['Uid'];
$this->Log_date=$row['Log_date'];
$this->Log_time_in=$row['Log_time_in'];
$this->Log_time_out=$row['Log_time_out'];
$this->Client_ip=$row['Client_ip'];
$this->Left_frame=$row['Left_frame'];
$this->Middle_frame=$row['Middle_frame'];
$this->Right_frame=$row['Right_frame'];
$this->Active=$row['Active'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$cond="Session_id='".$this->Session_id."'";
$row=$this->FetchSingleRecord("userlog",$this->fieldList,$cond);
if (count($row)>0)
return(true);
else
return(false);
} //end Available



public function UpdateRecord()
{
$i=$this->copyVariable();
$i=0;
$this->updateList="";
$sql="update userlog set ";
if ($this->Old_Uid!=$this->Uid &&  strlen($this->Uid)>0)
{
if ($this->Uid=="NULL")
$sql=$sql."Uid=NULL";
else
$sql=$sql."Uid='".$this->Uid."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Uid=".$this->Uid.", ";
}

if ($this->Old_Log_date!=$this->Log_date &&  strlen($this->Log_date)>0)
{
if ($this->Log_date=="NULL")
$sql=$sql."Log_date=NULL";
else
$sql=$sql."Log_date='".$this->Log_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Log_date=".$this->Log_date.", ";
}

if ($this->Old_Log_time_in!=$this->Log_time_in &&  strlen($this->Log_time_in)>0)
{
if ($this->Log_time_in=="NULL")
$sql=$sql."Log_time_in=NULL";
else
$sql=$sql."Log_time_in='".$this->Log_time_in."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Log_time_in=".$this->Log_time_in.", ";
}

if ($this->Old_Log_time_out!=$this->Log_time_out &&  strlen($this->Log_time_out)>0)
{
if ($this->Log_time_out=="NULL")
$sql=$sql."Log_time_out=NULL";
else
$sql=$sql."Log_time_out='".$this->Log_time_out."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Log_time_out=".$this->Log_time_out.", ";
}

//if ($this->Old_Client_ip!=$this->Client_ip &&  strlen($this->Client_ip)>0)/
//{
//if ($this->Client_ip=="NULL")
//$sql=$sql."Client_ip=NULL";
//else
//$sql=$sql."Client_ip='".$this->Client_ip."'";
//$sql=$sql.",";
//$i++;
//$this->updateList=$this->updateList."Client_ip=".$this->Client_ip.", ";
//}


if ($this->Old_Left_frame!=$this->Left_frame &&  strlen($this->Left_frame)>0)
{
//if ($this->Left_frame=="NULL")
//$sql=$sql."Left_frame=NULL";
//else
$sql=$sql."Left_frame='".$this->Left_frame."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Left_frame=".$this->Left_frame.", ";
}

if ($this->Old_Middle_frame!=$this->Middle_frame &&  strlen($this->Middle_frame)>0)
{
//if ($this->Middle_frame=="NULL")
//$sql=$sql."Middle_frame=NULL";
//else
$sql=$sql."Middle_frame='".$this->Middle_frame."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Middle_frame=".$this->Middle_frame.", ";
}

if ($this->Old_Right_frame!=$this->Right_frame &&  strlen($this->Right_frame)>0)
{
//if ($this->Right_frame=="NULL")
//$sql=$sql."Right_frame=NULL";
//else
$sql=$sql."Right_frame='".$this->Right_frame."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Right_frame=".$this->Right_frame.", ";
}

if ($this->Old_Active!=$this->Active &&  strlen($this->Active)>0)
{
if ($this->Active=="NULL")
$sql=$sql."Active=NULL";
else
$sql=$sql."Active='".$this->Active."'";
$i++;
$this->updateList=$this->updateList."Active=".$this->Active.", ";
}
else
$sql=$sql."Active=Active";


$cond="  where Session_id=".$this->Session_id;
$this->returnSql=$sql.$cond;
$this->colUpdated=$i;

if ($this->ExecuteQuery($sql.$cond))
return(true);
else
return(false);
}//End Update Record


public function genUpdateString()
{
$i=0;
$sql="update userlog set ";
if ($this->Uid=="NULL")
$sql=$sql."Uid=NULL";
else
$sql=$sql."Uid='".$this->Uid."'";
$sql=$sql.",";

if ($this->Log_date=="NULL")
$sql=$sql."Log_date=NULL";
else
$sql=$sql."Log_date='".$this->Log_date."'";
$sql=$sql.",";

if ($this->Log_time_in=="NULL")
$sql=$sql."Log_time_in=NULL";
else
$sql=$sql."Log_time_in='".$this->Log_time_in."'";
$sql=$sql.",";

if ($this->Log_time_out=="NULL")
$sql=$sql."Log_time_out=NULL";
else
$sql=$sql."Log_time_out='".$this->Log_time_out."'";
$sql=$sql.",";

if ($this->Client_ip=="NULL")
$sql=$sql."Client_ip=NULL";
else
$sql=$sql."Client_ip='".$this->Client_ip."'";
$sql=$sql.",";

//if ($this->Left_frame=="NULL")
//$sql=$sql."Left_frame=NULL";
//else
$sql=$sql."Left_frame='".$this->Left_frame."'";
$sql=$sql.",";

//if ($this->Middle_frame=="NULL")
//$sql=$sql."Middle_frame=NULL";
//else
$sql=$sql."Middle_frame='".$this->Middle_frame."'";
$sql=$sql.",";

//if ($this->Right_frame=="NULL")
//$sql=$sql."Right_frame=NULL";
//else
$sql=$sql."Right_frame='".$this->Right_frame."'";
$sql=$sql.",";

if ($this->Active=="NULL")
$sql=$sql."Active=NULL";
else
$sql=$sql."Active='".$this->Active."'";


$cond="  where Session_id=".$this->Session_id;
return($sql.$cond);
}//End genUpdateString


public function SaveRecord()
{
$this->updateList="";
$sql1="insert into userlog(";
$sql=" values (";
$mcol=0;
if (strlen($this->Uid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Uid";
if ($this->Uid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Uid."'";
$this->updateList=$this->updateList."Uid=".$this->Uid.", ";
}

if (strlen($this->Log_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_date";
if ($this->Log_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_date."'";
$this->updateList=$this->updateList."Log_date=".$this->Log_date.", ";
}

if (strlen($this->Log_time_in)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_time_in";
if ($this->Log_time_in=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_in."'";
$this->updateList=$this->updateList."Log_time_in=".$this->Log_time_in.", ";
}

if (strlen($this->Log_time_out)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_time_out";
if ($this->Log_time_out=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_out."'";
$this->updateList=$this->updateList."Log_time_out=".$this->Log_time_out.", ";
}

if (strlen($this->Client_ip)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Client_ip";
if ($this->Client_ip=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Client_ip."'";
$this->updateList=$this->updateList."Client_ip=".$this->Client_ip.", ";
}

if (strlen($this->Session_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Session_id";
//if ($this->Session_id=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Session_id."'";
$this->updateList=$this->updateList."Session_id=".$this->Session_id.", ";
}

if (strlen($this->Left_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Left_frame";
//if ($this->Left_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Left_frame."'";
$this->updateList=$this->updateList."Left_frame=".$this->Left_frame.", ";
}

if (strlen($this->Middle_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Middle_frame";
//if ($this->Middle_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Middle_frame."'";
$this->updateList=$this->updateList."Middle_frame=".$this->Middle_frame.", ";
}

if (strlen($this->Right_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Right_frame";
//if ($this->Right_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Right_frame."'";
$this->updateList=$this->updateList."Right_frame=".$this->Right_frame.", ";
}

if (strlen($this->Active)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Active";
if ($this->Active=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Active."'";
$this->updateList=$this->updateList."Active=".$this->Active.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;

if ($this->ExecuteQuery($sqlstring))
{
$this->colUpdated=$mcol;
return(true);
}
else
{
$this->colUpdated=0;
return(false);
}
}//End Save Record


public function genSaveString()
{
$sql1="insert into userlog(";
$sql=" values (";
$mcol=0;
if (strlen($this->Uid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Uid";
if ($this->Uid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Uid."'";
}

if (strlen($this->Log_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_date";
if ($this->Log_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_date."'";
}

if (strlen($this->Log_time_in)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_time_in";
if ($this->Log_time_in=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_in."'";
}

if (strlen($this->Log_time_out)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Log_time_out";
if ($this->Log_time_out=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_out."'";
}

if (strlen($this->Client_ip)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Client_ip";
if ($this->Client_ip=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Client_ip."'";
}

if (strlen($this->Session_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Session_id";
//if ($this->Session_id=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Session_id."'";
}

if (strlen($this->Left_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Left_frame";
//if ($this->Left_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Left_frame."'";
}

if (strlen($this->Middle_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Middle_frame";
//if ($this->Middle_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Middle_frame."'";
}

if (strlen($this->Right_frame)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Right_frame";
//if ($this->Right_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Right_frame."'";
}

if (strlen($this->Active)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Active";
if ($this->Active=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Active."'";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
return($sqlstring);
}//End genSaveString


public function maxSession_id()
{
$cond="1=1";
$val=$this->Max("Userlog", "Session_id", $cond)+1;
//echo "inside userlog".$val."<br>";
return($val);
}//Max




public function genInsertFirstPart()
{
$sql1="insert into userlog(";
$mcol=0;
if (strlen($this->Uid)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Uid";
}

if (strlen($this->Log_date)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Log_date";
}

if (strlen($this->Log_time_in)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Log_time_in";
}

if (strlen($this->Log_time_out)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Log_time_out";
}

if (strlen($this->Client_ip)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Client_ip";
}

if (strlen($this->Session_id)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Session_id";
}

if (strlen($this->Left_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Left_frame";
}

if (strlen($this->Middle_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Middle_frame";
}

if (strlen($this->Right_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Right_frame";
}

if (strlen($this->Active)>0)
{
$mcol++;
if ($mcol>1)
$sql1=$sql1.",";
$sql1=$sql1."Active";
}

$sql1=$sql1.") values";
return($sql1);
}//End First Part


public function genInsertSecondPart()
{
$sql="(";
$mcol=0;
if (strlen($this->Uid)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Uid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Uid."'";
}

if (strlen($this->Log_date)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Log_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_date."'";
}

if (strlen($this->Log_time_in)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Log_time_in=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_in."'";
}

if (strlen($this->Log_time_out)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Log_time_out=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Log_time_out."'";
}

if (strlen($this->Client_ip)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Client_ip=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Client_ip."'";
}

if (strlen($this->Session_id)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
//if ($this->Session_id=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Session_id."'";
}

if (strlen($this->Left_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
//if ($this->Left_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Left_frame."'";
}

if (strlen($this->Middle_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
//if ($this->Middle_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Middle_frame."'";
}

if (strlen($this->Right_frame)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
//if ($this->Right_frame=="NULL")
//$sql=$sql."NULL";
//else
$sql=$sql."'".$this->Right_frame."'";
}

if (strlen($this->Active)>0)
{
$mcol++;
if ($mcol>1)
$sql=$sql.",";
if ($this->Active=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Active."'";
}

$sql=$sql.")";
return($sql);
}//End Second Part



public function getSingleColumn($fld,$cond)
{
return($this->FetchSingleColumn("Userlog",$fld,$cond));
}


public function getAllRecord($cond)
{
$tRows=array();
$tRows=$this->FetchMultipleRecords("userlog",$this->fieldList,$cond);
return($tRows);
} //End getAllRecord

public function elapsedTimeinSec($t1,$t2)
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
//echo "Seconddiff".$s." ";

if ($m2<=$m1)
$m=$m1-$m2;
else
{
$m1=$m1+60;
$h1=$h1-1;
$m=$m1-$m2;
}  
//echo "Minutediff".$m." ";

if ($h2<=$h1)
$h=$h1-$h2;
else 
$h=0;  
//echo "Hourdiff".$h." <br>";
//echo $h.":".$m.":".$s."<br>";
return($h*60*60+$m*60+$s);   
}


public function LastSession_id($Uid)
{
$cond="Log_date='".date('Y-m-d')."' and Uid='".$Uid."'";
$sd=$this->Max("userlog", "Session_id", $cond);
//echo $this->returnSql;
return($sd);
}


public function isActiveUser($Uid,$sec)
{

$sid=$this->LastSession_id($Uid);
$this->setSession_id($sid);
$result=false;
if($this->EditRecord())
{
$t2=$this->getLog_time_out();

$t1=date('H:i:s'); //Present time

//echo "t1".$t1."<br>";
$s=$this->elapsedTimeinSec($t1, $t2);
//echo "Second".$s."<br>";
if($s<$sec)
$result=true; 
}  //$this->Editrec  
//$this->returnSql="id".$sid.":".$t1." -".$t2."=".$s;
return($result);
} //public userstatus


public function isActive($Uid)
{
$sid=$this->LastSession_id($Uid); //For MySQL

//echo "Uid-".$Uid;
//echo "Last Session-ID".$sid;

$this->setSession_id($sid);
$result=false;
if($this->EditRecord())
{
if($this->getActive()=="Y")
$result=true;
else
$result=false;    
}  //$this->Editrec  
//echo $this->returnSql;
return($result);
} //isActive

public function SessionActive()
{
$result=false;    
if($this->EditRecord())
{
if($this->getActive()=="Y")
$result=true;
else
$result=false;    
}  //$this->Editrec  
return($result);
} //isActive

public function MakeActive()
{
if(isset($_SESSION['uid']))
$uid=$_SESSION['uid'];
else
$uid="-";
$newstr="delete from userlog where uid='unknown' and Client_ip='".$this->Client_ip."'";
$this->ExecuteQuery($newstr);
$newstr="update userlog set Active='Y' where Uid='".$uid."' and Session_id=".$this->LastSession_id($uid);
if($this->ExecuteQuery($newstr))
$_SESSION['sid']=$this->LastSession_id($uid);
$this->returnSql=$newstr;
}//end makeactive

}//End Class
?>
