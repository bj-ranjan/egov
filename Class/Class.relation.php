<body>
<?php
require_once 'class.config.php';
class Relation
{
private $Rel_name;

//extra Old Variable to store Pre update Data
private $Old_Rel_name;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Relation()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from relation";
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
$sql=" select count(*) from relation where ".$condition;
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
$sql="select Rel_name from relation where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Rel_name']=$row['Rel_name'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getRel_name()
{
return($this->Rel_name);
}

public function setRel_name($str)
{
$this->Rel_name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



public function SaveRecord()
{
$this->updateList="";
$sql1="insert into relation(";
$sql=" values (";
$mcol=0;
if (strlen($this->Rel_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Rel_name";
if ($this->Rel_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Rel_name."'";
$this->updateList=$this->updateList."Rel_name=".$this->Rel_name.", ";
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


public function getAllRecord()
{
$tRows=array();
$sql="select Rel_name from relation where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Rel_name']=$row['Rel_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Rel_name from relation where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Rel_name']=$row['Rel_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
