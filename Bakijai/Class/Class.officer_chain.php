<body>
<?php
require_once '../class/class.config.php';
class Officer_chain
{
private $Case_id;
private $From_date;
private $To_date;
private $Officer_code;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_From_date;
private $Old_To_date;
private $Old_Officer_code;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Officer_chain()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from officer_chain";
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
$sql=" select count(*) from officer_chain where ".$condition;
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
$sql="select Case_id,Officer_code,Case_id from officer_chain where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Officer_code']=$row['Officer_code'];//Primary Key-2
$tRow[$i]['Case_id']=$row['Case_id'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getCase_id()
{
return($this->Case_id);
}

public function setCase_id($str)
{
$this->Case_id=$str;
}

public function getFrom_date()
{
return($this->From_date);
}

public function setFrom_date($str)
{
$this->From_date=$str;
}

public function getTo_date()
{
return($this->To_date);
}

public function setTo_date($str)
{
$this->To_date=$str;
}

public function getOfficer_code()
{
return($this->Officer_code);
}

public function setOfficer_code($str)
{
$this->Officer_code=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,From_date,To_date,Officer_code from officer_chain where Case_id='".$this->Case_id."' and Officer_code='".$this->Officer_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['From_date'])>0)
$this->Old_From_date=substr($row['From_date'],0,10);
else
$this->Old_From_date="NULL";
if (strlen($row['To_date'])>0)
$this->Old_To_date=substr($row['To_date'],0,10);
else
$this->Old_To_date="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Case_id,From_date,To_date,Officer_code from officer_chain where Case_id='".$this->Case_id."' and Officer_code='".$this->Officer_code."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->From_date=$row['From_date'];
$this->To_date=$row['To_date'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Case_id from officer_chain where Case_id='".$this->Case_id."' and Officer_code='".$this->Officer_code."'";
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
$sql="delete from officer_chain where Case_id='".$this->Case_id."' and Officer_code='".$this->Officer_code."'";
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
$sql="update officer_chain set ";
if ($this->Old_From_date!=$this->From_date &&  strlen($this->From_date)>0)
{
if ($this->From_date=="NULL")
$sql=$sql."From_date=NULL";
else
$sql=$sql."From_date='".$this->From_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."From_date=".$this->From_date.", ";
}

if ($this->Old_To_date!=$this->To_date &&  strlen($this->To_date)>0)
{
if ($this->To_date=="NULL")
$sql=$sql."To_date=NULL";
else
$sql=$sql."To_date='".$this->To_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."To_date=".$this->To_date.", ";
}


$cond="  where Case_id='".$this->Case_id."' and Officer_code='".$this->Officer_code."'";
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
$sql1="insert into officer_chain(";
$sql=" values (";
$mcol=0;
if (strlen($this->Case_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Case_id";
if ($this->Case_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Case_id."'";
$this->updateList=$this->updateList."Case_id=".$this->Case_id.", ";
}

if (strlen($this->From_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."From_date";
if ($this->From_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->From_date."'";
$this->updateList=$this->updateList."From_date=".$this->From_date.", ";
}

if (strlen($this->To_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."To_date";
if ($this->To_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->To_date."'";
$this->updateList=$this->updateList."To_date=".$this->To_date.", ";
}

if (strlen($this->Officer_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Officer_code";
if ($this->Officer_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Officer_code."'";
$this->updateList=$this->updateList."Officer_code=".$this->Officer_code.", ";
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


public function maxCase_id()
{
$sql="select max(Case_id) from officer_chain";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxOfficer_code()
{
$sql="select max(Officer_code) from officer_chain";
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
$sql="select Case_id,From_date,To_date,Officer_code from officer_chain where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['From_date']=$row['From_date'];
$tRows[$i]['To_date']=$row['To_date'];
$tRows[$i]['Officer_code']=$row['Officer_code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,From_date,To_date,Officer_code from officer_chain where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['From_date']=$row['From_date'];
$tRows[$i]['To_date']=$row['To_date'];
$tRows[$i]['Officer_code']=$row['Officer_code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
