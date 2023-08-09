<body>
<?php
require_once '../class/class.config.php';
class Mouza
{
private $Mouza_code;
private $Mouza_name;
private $Mouza_name_ass;
private $Cir_code;

//extra Old Variable to store Pre update Data
private $Old_Mouza_code;
private $Old_Mouza_name;
private $Old_Mouza_name_ass;
private $Old_Cir_code;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Mouza()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from mouza";
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
$sql=" select count(*) from mouza where ".$condition;
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
$sql="select Mouza_code,Mouza_name from mouza where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Mouza_code']=$row['Mouza_code'];//Primary Key-1
$tRow[$i]['Mouza_name']=$row['Mouza_name'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getMouza_code()
{
return($this->Mouza_code);
}

public function setMouza_code($str)
{
$this->Mouza_code=$str;
}

public function getMouza_name()
{
return($this->Mouza_name);
}

public function setMouza_name($str)
{
$this->Mouza_name=$str;
}

public function getMouza_name_ass()
{
return($this->Mouza_name_ass);
}

public function setMouza_name_ass($str)
{
$this->Mouza_name_ass=$str;
}

public function getCir_code()
{
return($this->Cir_code);
}

public function setCir_code($str)
{
$this->Cir_code=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Mouza_code,Mouza_name,Mouza_name_ass,Cir_code from mouza where Mouza_code='".$this->Mouza_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Mouza_name'])>0)
$this->Old_Mouza_name=$row['Mouza_name'];
else
$this->Old_Mouza_name="NULL";
if (strlen($row['Mouza_name_ass'])>0)
$this->Old_Mouza_name_ass=$row['Mouza_name_ass'];
else
$this->Old_Mouza_name_ass="NULL";
if (strlen($row['Cir_code'])>0)
$this->Old_Cir_code=$row['Cir_code'];
else
$this->Old_Cir_code="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Mouza_code,Mouza_name,Mouza_name_ass,Cir_code from mouza where Mouza_code='".$this->Mouza_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Mouza_name=$row['Mouza_name'];
$this->Mouza_name_ass=$row['Mouza_name_ass'];
$this->Cir_code=$row['Cir_code'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from mouza where Mouza_code='".$this->Mouza_code."'";
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
$sql="update mouza set ";
if ($this->Old_Mouza_name!=$this->Mouza_name &&  strlen($this->Mouza_name)>0)
{
if ($this->Mouza_name=="NULL")
$sql=$sql."Mouza_name=NULL";
else
$sql=$sql."Mouza_name='".$this->Mouza_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mouza_name=".$this->Mouza_name.", ";
}

if ($this->Old_Mouza_name_ass!=$this->Mouza_name_ass &&  strlen($this->Mouza_name_ass)>0)
{
if ($this->Mouza_name_ass=="NULL")
$sql=$sql."Mouza_name_ass=NULL";
else
$sql=$sql."Mouza_name_ass='".$this->Mouza_name_ass."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mouza_name_ass=".$this->Mouza_name_ass.", ";
}

if ($this->Old_Cir_code!=$this->Cir_code &&  strlen($this->Cir_code)>0)
{
if ($this->Cir_code=="NULL")
$sql=$sql."Cir_code=NULL";
else
$sql=$sql."Cir_code='".$this->Cir_code."'";
$i++;
$this->updateList=$this->updateList."Cir_code=".$this->Cir_code.", ";
}
else
$sql=$sql."Cir_code=Cir_code";


$cond="  where Mouza_code='".$this->Mouza_code."'";
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
$sql1="insert into mouza(";
$sql=" values (";
$mcol=0;
if (strlen($this->Mouza_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mouza_code";
if ($this->Mouza_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mouza_code."'";
$this->updateList=$this->updateList."Mouza_code=".$this->Mouza_code.", ";
}

if (strlen($this->Mouza_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mouza_name";
if ($this->Mouza_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mouza_name."'";
$this->updateList=$this->updateList."Mouza_name=".$this->Mouza_name.", ";
}

if (strlen($this->Mouza_name_ass)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mouza_name_ass";
if ($this->Mouza_name_ass=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mouza_name_ass."'";
$this->updateList=$this->updateList."Mouza_name_ass=".$this->Mouza_name_ass.", ";
}

if (strlen($this->Cir_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Cir_code";
if ($this->Cir_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Cir_code."'";
$this->updateList=$this->updateList."Cir_code=".$this->Cir_code.", ";
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


public function maxMouza_code()
{
$sql="select max(Mouza_code) from mouza";
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
$sql="select Mouza_code,Mouza_name,Mouza_name_ass,Cir_code from mouza where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Mouza_code']=$row['Mouza_code'];
$tRows[$i]['Mouza_name']=$row['Mouza_name'];
$tRows[$i]['Mouza_name_ass']=$row['Mouza_name_ass'];
$tRows[$i]['Cir_code']=$row['Cir_code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Mouza_code,Mouza_name,Mouza_name_ass,Cir_code from mouza where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Mouza_code']=$row['Mouza_code'];
$tRows[$i]['Mouza_name']=$row['Mouza_name'];
$tRows[$i]['Mouza_name_ass']=$row['Mouza_name_ass'];
$tRows[$i]['Cir_code']=$row['Cir_code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
