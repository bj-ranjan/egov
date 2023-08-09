<?php
require_once '../class/class.config.php';
class Petition_changed
{
private $Pet_yr;
private $Pet_type;
private $Pet_no;
private $Applicant;
private $Father;
private $Mother;

//extra Old Variable to store Pre update Data
private $Old_Pet_yr;
private $Old_Pet_type;
private $Old_Pet_no;
private $Old_Applicant;
private $Old_Father;
private $Old_Mother;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Petition_changed()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from petition_changed";
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
$sql=" select count(*) from petition_changed where ".$condition;
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
$sql="select Pet_yr,Pet_no,Pet_type from petition_changed where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Pet_yr']=$row['Pet_yr'];//Primary Key-1
$tRow[$i]['Pet_no']=$row['Pet_no'];//Primary Key-2
$tRow[$i]['Pet_type']=$row['Pet_type'];//Posible Unique Field
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

public function getPet_type()
{
return($this->Pet_type);
}

public function setPet_type($str)
{
$this->Pet_type=$str;
}

public function getPet_no()
{
return($this->Pet_no);
}

public function setPet_no($str)
{
$this->Pet_no=$str;
}

public function getApplicant()
{
return($this->Applicant);
}

public function setApplicant($str)
{
$this->Applicant=$str;
}

public function getFather()
{
return($this->Father);
}

public function setFather($str)
{
$this->Father=$str;
}

public function getMother()
{
return($this->Mother);
}

public function setMother($str)
{
$this->Mother=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Pet_yr,Pet_type,Pet_no,Applicant,Father,Mother from petition_changed where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Pet_type'])>0)
$this->Old_Pet_type=$row['Pet_type'];
else
$this->Old_Pet_type="NULL";
if (strlen($row['Applicant'])>0)
$this->Old_Applicant=$row['Applicant'];
else
$this->Old_Applicant="NULL";
if (strlen($row['Father'])>0)
$this->Old_Father=$row['Father'];
else
$this->Old_Father="NULL";
if (strlen($row['Mother'])>0)
$this->Old_Mother=$row['Mother'];
else
$this->Old_Mother="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Pet_yr,Pet_type,Pet_no,Applicant,Father,Mother from petition_changed where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Pet_type=$row['Pet_type'];
$this->Applicant=$row['Applicant'];
$this->Father=$row['Father'];
$this->Mother=$row['Mother'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Pet_yr from petition_changed where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
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
$sql="delete from petition_changed where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
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
$sql="update petition_changed set ";
if ($this->Old_Pet_type!=$this->Pet_type &&  strlen($this->Pet_type)>0)
{
if ($this->Pet_type=="NULL")
$sql=$sql."Pet_type=NULL";
else
$sql=$sql."Pet_type='".$this->Pet_type."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pet_type=".$this->Pet_type.", ";
}

if ($this->Old_Applicant!=$this->Applicant &&  strlen($this->Applicant)>0)
{
if ($this->Applicant=="NULL")
$sql=$sql."Applicant=NULL";
else
$sql=$sql."Applicant='".$this->Applicant."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Applicant=".$this->Applicant.", ";
}

if ($this->Old_Father!=$this->Father &&  strlen($this->Father)>0)
{
if ($this->Father=="NULL")
$sql=$sql."Father=NULL";
else
$sql=$sql."Father='".$this->Father."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Father=".$this->Father.", ";
}

if ($this->Old_Mother!=$this->Mother &&  strlen($this->Mother)>0)
{
if ($this->Mother=="NULL")
$sql=$sql."Mother=NULL";
else
$sql=$sql."Mother='".$this->Mother."'";
$i++;
$this->updateList=$this->updateList."Mother=".$this->Mother.", ";
}
else
$sql=$sql."Mother=Mother";


$cond="  where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$this->returnSql=$sql.$cond;
$this->rowCommitted= mysql_affected_rows();
$this->colUpdated=$i;

if (mysql_query($sql.$cond))
return(true);
else
return(false);
}//End Update Record



public function SaveRecord()
{
$this->updateList="";
$sql1="insert into petition_changed(";
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

if (strlen($this->Pet_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_type";
if ($this->Pet_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_type."'";
$this->updateList=$this->updateList."Pet_type=".$this->Pet_type.", ";
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

if (strlen($this->Applicant)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Applicant";
if ($this->Applicant=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Applicant."'";
$this->updateList=$this->updateList."Applicant=".$this->Applicant.", ";
}

if (strlen($this->Father)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Father";
if ($this->Father=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Father."'";
$this->updateList=$this->updateList."Father=".$this->Father.", ";
}

if (strlen($this->Mother)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mother";
if ($this->Mother=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mother."'";
$this->updateList=$this->updateList."Mother=".$this->Mother.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;
$this->rowCommitted= mysql_affected_rows();

if (mysql_query($sqlstring))
{
$this->colUpdated=1;
return(true);
}
else
{
$this->colUpdated=0;
return(false);
}
}//End Save Record


public function maxPet_no()
{
$sql="select max(Pet_no) from petition_changed";
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
$sql="select Pet_yr,Pet_type,Pet_no,Applicant,Father,Mother from petition_changed where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Pet_yr']=$row['Pet_yr'];
$tRows[$i]['Pet_type']=$row['Pet_type'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Applicant']=$row['Applicant'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Mother']=$row['Mother'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Pet_yr,Pet_type,Pet_no,Applicant,Father,Mother from petition_changed where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Pet_yr']=$row['Pet_yr'];
$tRows[$i]['Pet_type']=$row['Pet_type'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Applicant']=$row['Applicant'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Mother']=$row['Mother'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
