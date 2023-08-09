<?php
require_once '../class/class.config.php';
class Legal_heir
{
private $Pet_yr;
private $Pet_no;
private $Slno;
private $Nok;
private $Relation;
private $Age;
private $Dob;

//extra Old Variable to store Pre update Data
private $Old_Pet_yr;
private $Old_Pet_no;
private $Old_Slno;
private $Old_Nok;
private $Old_Relation;
private $Old_Age;
private $Old_Dob;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Legal_heir()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from legal_heir";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from legal_heir where ".$condition;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
} //rowCount

public function getRow()
{
$i=0;
$tRow=array();
$sql="select Pet_yr,Pet_no,Nok from legal_heir where ".$this->condString;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Pet_yr']=$row['Pet_yr'];//Primary Key-1
$tRow[$i]['Pet_no']=$row['Pet_no'];//Primary Key-2
$tRow[$i]['Nok']=$row['Nok'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getPet_yr()
{
return($this->Pet_yr);
}

public function setPet_yr($str)
{
$this->Pet_yr=$str;
}

public function getPet_no()
{
return($this->Pet_no);
}

public function setPet_no($str)
{
$this->Pet_no=$str;
}

public function getSlno()
{
return($this->Slno);
}

public function setSlno($str)
{
$this->Slno=$str;
}

public function getNok()
{
return($this->Nok);
}

public function setNok($str)
{
$this->Nok=$str;
}

public function getRelation()
{
return($this->Relation);
}

public function setRelation($str)
{
$this->Relation=$str;
}

public function getAge()
{
return($this->Age);
}

public function setAge($str)
{
$this->Age=$str;
}

public function getDob()
{
return($this->Dob);
}

public function setDob($str)
{
$this->Dob=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Pet_yr,Pet_no,Slno,Nok,Relation,Age,Dob from legal_heir where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Slno'])>0)
$this->Old_Slno=$row['Slno'];
else
$this->Old_Slno="NULL";
if (strlen($row['Nok'])>0)
$this->Old_Nok=$row['Nok'];
else
$this->Old_Nok="NULL";
if (strlen($row['Relation'])>0)
$this->Old_Relation=$row['Relation'];
else
$this->Old_Relation="NULL";
if (strlen($row['Age'])>0)
$this->Old_Age=$row['Age'];
else
$this->Old_Age="NULL";
if (strlen($row['Dob'])>0)
$this->Old_Dob=substr($row['Dob'],0,10);
else
$this->Old_Dob="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Pet_yr,Pet_no,Slno,Nok,Relation,Age,Dob from legal_heir where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Slno=$row['Slno'];
$this->Nok=$row['Nok'];
$this->Relation=$row['Relation'];
$this->Age=$row['Age'];
$this->Dob=$row['Dob'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Pet_yr from legal_heir where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
return(true);
else
return(false);
} //end Available


public function DeleteRecord()
{
$sql="delete from legal_heir where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
$this->returnSql=$sql;
return($result);
} //end deleterecord


public function UpdateRecord()
{
$i=$this->copyVariable();
$i=0;
$this->updateList="";
$sql="update legal_heir set ";
if ($this->Old_Slno!=$this->Slno &&  strlen($this->Slno)>0)
{
if ($this->Slno=="NULL")
$sql=$sql."Slno=NULL";
else
$sql=$sql."Slno='".$this->Slno."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Slno=".$this->Slno.", ";
}

if ($this->Old_Nok!=$this->Nok &&  strlen($this->Nok)>0)
{
if ($this->Nok=="NULL")
$sql=$sql."Nok=NULL";
else
$sql=$sql."Nok='".$this->Nok."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Nok=".$this->Nok.", ";
}

if ($this->Old_Relation!=$this->Relation &&  strlen($this->Relation)>0)
{
if ($this->Relation=="NULL")
$sql=$sql."Relation=NULL";
else
$sql=$sql."Relation='".$this->Relation."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Relation=".$this->Relation.", ";
}

if ($this->Old_Age!=$this->Age &&  strlen($this->Age)>0)
{
if ($this->Age=="NULL")
$sql=$sql."Age=NULL";
else
$sql=$sql."Age='".$this->Age."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Age=".$this->Age.", ";
}

if ($this->Old_Dob!=$this->Dob &&  strlen($this->Dob)>0)
{
if ($this->Dob=="NULL")
$sql=$sql."Dob=NULL";
else
$sql=$sql."Dob='".$this->Dob."'";
$i++;
$this->updateList=$this->updateList."Dob=".$this->Dob.", ";
}
else
$sql=$sql."Dob=Dob";


$cond="  where Pet_yr='".$this->Pet_yr."' and Pet_no=".$this->Pet_no." and Slno=".$this->Slno;
$this->returnSql=$sql.$cond;
$this->colUpdated=$i;

if (mysql_query($sql.$cond))
{
$this->rowCommitted= mysql_affected_rows();
return(true);
}
else
return(false);
}//End Update Record



public function SaveRecord()
{
$this->updateList="";
$sql1="insert into legal_heir(";
$sql=" values (";
$mcol=0;
if (strlen($this->Pet_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_yr";
if ($this->Pet_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_yr."'";
$this->updateList=$this->updateList."Pet_yr=".$this->Pet_yr.", ";
}

if (strlen($this->Pet_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_no";
if ($this->Pet_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_no."'";
$this->updateList=$this->updateList."Pet_no=".$this->Pet_no.", ";
}

if (strlen($this->Slno)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Slno";
if ($this->Slno=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Slno."'";
$this->updateList=$this->updateList."Slno=".$this->Slno.", ";
}

if (strlen($this->Nok)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Nok";
if ($this->Nok=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Nok."'";
$this->updateList=$this->updateList."Nok=".$this->Nok.", ";
}

if (strlen($this->Relation)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Relation";
if ($this->Relation=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Relation."'";
$this->updateList=$this->updateList."Relation=".$this->Relation.", ";
}

if (strlen($this->Age)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Age";
if ($this->Age=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Age."'";
$this->updateList=$this->updateList."Age=".$this->Age.", ";
}

if (strlen($this->Dob)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Dob";
if ($this->Dob=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Dob."'";
$this->updateList=$this->updateList."Dob=".$this->Dob.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;

if (mysql_query($sqlstring))
{
$this->rowCommitted= mysql_affected_rows();
$this->colUpdated=$mcol;
return(true);
}
else
{
$this->colUpdated=0;
return(false);
}
}//End Save Record


public function maxPet_yr()
{
$sql="select max(Pet_yr) from legal_heir";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxPet_no()
{
$sql="select max(Pet_no) from legal_heir";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function getAllRecord()
{
$tRows=array();
$sql="select Pet_yr,Pet_no,Slno,Nok,Relation,Age,Dob from legal_heir where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Pet_yr']=$row['Pet_yr'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Slno']=$row['Slno'];
$tRows[$i]['Nok']=$row['Nok'];
$tRows[$i]['Relation']=$row['Relation'];
$tRows[$i]['Age']=$row['Age'];
$tRows[$i]['Dob']=$row['Dob'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Pet_yr,Pet_no,Slno,Nok,Relation,Age,Dob from legal_heir where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Pet_yr']=$row['Pet_yr'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Slno']=$row['Slno'];
$tRows[$i]['Nok']=$row['Nok'];
$tRows[$i]['Relation']=$row['Relation'];
$tRows[$i]['Age']=$row['Age'];
$tRows[$i]['Dob']=$row['Dob'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord

public function Max($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select max(".$fld.") from legal_heir where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function Sum($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select sum(".$fld.") from legal_heir where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

}//End Class
?>
