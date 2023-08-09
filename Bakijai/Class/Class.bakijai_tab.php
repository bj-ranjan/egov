<body>
<?php
require_once '../class/class.config.php';
class Bakijai_tab
{
private $Id;
private $F_name;
private $Disposed;
private $Court_case;
private $Next_dt;
private $Next_mn;
private $Next_yr;
private $Nextdate;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_F_name;
private $Old_Disposed;
private $Old_Court_case;
private $Old_Next_dt;
private $Old_Next_mn;
private $Old_Next_yr;
private $Old_Nextdate;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Disposed="No";
private $Def_Court_case="No";
//public function _construct($i) //for PHP6
public function Bakijai_tab()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from bakijai_tab";
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
$sql=" select count(*) from bakijai_tab where ".$condition;
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
$sql="select ,F_name from bakijai_tab where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['F_name']=$row['F_name'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getId()
{
return($this->Id);
}

public function setId($str)
{
$this->Id=$str;
}

public function getF_name()
{
return($this->F_name);
}

public function setF_name($str)
{
$this->F_name=$str;
}

public function getDisposed()
{
return($this->Disposed);
}

public function setDisposed($str)
{
$this->Disposed=$str;
}

public function getCourt_case()
{
return($this->Court_case);
}

public function setCourt_case($str)
{
$this->Court_case=$str;
}

public function getNext_dt()
{
return($this->Next_dt);
}

public function setNext_dt($str)
{
$this->Next_dt=$str;
}

public function getNext_mn()
{
return($this->Next_mn);
}

public function setNext_mn($str)
{
$this->Next_mn=$str;
}

public function getNext_yr()
{
return($this->Next_yr);
}

public function setNext_yr($str)
{
$this->Next_yr=$str;
}

public function getNextdate()
{
return($this->Nextdate);
}

public function setNextdate($str)
{
$this->Nextdate=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}





public function SaveRecord()
{
$this->updateList="";
$sql1="insert into bakijai_tab(";
$sql=" values (";
$mcol=0;
if (strlen($this->Id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Id";
if ($this->Id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Id."'";
$this->updateList=$this->updateList."Id=".$this->Id.", ";
}

if (strlen($this->F_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."F_name";
if ($this->F_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->F_name."'";
$this->updateList=$this->updateList."F_name=".$this->F_name.", ";
}

if (strlen($this->Disposed)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Disposed";
if ($this->Disposed=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Disposed."'";
$this->updateList=$this->updateList."Disposed=".$this->Disposed.", ";
}

if (strlen($this->Court_case)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Court_case";
if ($this->Court_case=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Court_case."'";
$this->updateList=$this->updateList."Court_case=".$this->Court_case.", ";
}

if (strlen($this->Next_dt)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Next_dt";
if ($this->Next_dt=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Next_dt."'";
$this->updateList=$this->updateList."Next_dt=".$this->Next_dt.", ";
}

if (strlen($this->Next_mn)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Next_mn";
if ($this->Next_mn=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Next_mn."'";
$this->updateList=$this->updateList."Next_mn=".$this->Next_mn.", ";
}

if (strlen($this->Next_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Next_yr";
if ($this->Next_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Next_yr."'";
$this->updateList=$this->updateList."Next_yr=".$this->Next_yr.", ";
}

if (strlen($this->Nextdate)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Nextdate";
if ($this->Nextdate=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Nextdate."'";
$this->updateList=$this->updateList."Nextdate=".$this->Nextdate.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;
$this->rowCommitted= mysql_affected_rows();

if (mysql_query($sqlstring))
return(true);
else
return(false);
}//End Save Record


public function getAllRecord()
{
$tRows=array();
$sql="select Id,F_name,Disposed,Court_case,Next_dt,Next_mn,Next_yr,Nextdate from bakijai_tab where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['F_name']=$row['F_name'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Court_case']=$row['Court_case'];
$tRows[$i]['Next_dt']=$row['Next_dt'];
$tRows[$i]['Next_mn']=$row['Next_mn'];
$tRows[$i]['Next_yr']=$row['Next_yr'];
$tRows[$i]['Nextdate']=$row['Nextdate'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,F_name,Disposed,Court_case,Next_dt,Next_mn,Next_yr,Nextdate from bakijai_tab where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['F_name']=$row['F_name'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Court_case']=$row['Court_case'];
$tRows[$i]['Next_dt']=$row['Next_dt'];
$tRows[$i]['Next_mn']=$row['Next_mn'];
$tRows[$i]['Next_yr']=$row['Next_yr'];
$tRows[$i]['Nextdate']=$row['Nextdate'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
