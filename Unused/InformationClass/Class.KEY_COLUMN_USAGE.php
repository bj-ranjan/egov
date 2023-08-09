<body>
<?php
require_once 'class.config.php';
class Key_column_usage
{
private $Constraint_catalog;
private $Constraint_schema;
private $Constraint_name;
private $Table_catalog;
private $Table_schema;
private $Table_name;
private $Column_name;
private $Ordinal_position;
private $Position_in_unique_constraint;
private $Referenced_table_schema;
private $Referenced_table_name;
private $Referenced_column_name;

//extra Old Variable to store Pre update Data
private $Old_Constraint_catalog;
private $Old_Constraint_schema;
private $Old_Constraint_name;
private $Old_Table_catalog;
private $Old_Table_schema;
private $Old_Table_name;
private $Old_Column_name;
private $Old_Ordinal_position;
private $Old_Position_in_unique_constraint;
private $Old_Referenced_table_schema;
private $Old_Referenced_table_name;
private $Old_Referenced_column_name;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Ordinal_position="0";
//public function _construct($i) //for PHP6
public function Key_column_usage()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from KEY_COLUMN_USAGE";
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
$sql=" select count(*) from KEY_COLUMN_USAGE where ".$condition;
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
$sql="select ,Constraint_catalog from KEY_COLUMN_USAGE where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Constraint_catalog']=$row['Constraint_catalog'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getConstraint_catalog()
{
return($this->Constraint_catalog);
}

public function setConstraint_catalog($str)
{
$this->Constraint_catalog=$str;
}

public function getConstraint_schema()
{
return($this->Constraint_schema);
}

public function setConstraint_schema($str)
{
$this->Constraint_schema=$str;
}

public function getConstraint_name()
{
return($this->Constraint_name);
}

public function setConstraint_name($str)
{
$this->Constraint_name=$str;
}

public function getTable_catalog()
{
return($this->Table_catalog);
}

public function setTable_catalog($str)
{
$this->Table_catalog=$str;
}

public function getTable_schema()
{
return($this->Table_schema);
}

public function setTable_schema($str)
{
$this->Table_schema=$str;
}

public function getTable_name()
{
return($this->Table_name);
}

public function setTable_name($str)
{
$this->Table_name=$str;
}

public function getColumn_name()
{
return($this->Column_name);
}

public function setColumn_name($str)
{
$this->Column_name=$str;
}

public function getOrdinal_position()
{
return($this->Ordinal_position);
}

public function setOrdinal_position($str)
{
$this->Ordinal_position=$str;
}

public function getPosition_in_unique_constraint()
{
return($this->Position_in_unique_constraint);
}

public function setPosition_in_unique_constraint($str)
{
$this->Position_in_unique_constraint=$str;
}

public function getReferenced_table_schema()
{
return($this->Referenced_table_schema);
}

public function setReferenced_table_schema($str)
{
$this->Referenced_table_schema=$str;
}

public function getReferenced_table_name()
{
return($this->Referenced_table_name);
}

public function setReferenced_table_name($str)
{
$this->Referenced_table_name=$str;
}

public function getReferenced_column_name()
{
return($this->Referenced_column_name);
}

public function setReferenced_column_name($str)
{
$this->Referenced_column_name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}





public function SaveRecord()
{
$this->updateList="";
$sql1="insert into KEY_COLUMN_USAGE(";
$sql=" values (";
$mcol=0;
if (strlen($this->Constraint_catalog)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Constraint_catalog";
if ($this->Constraint_catalog=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Constraint_catalog."'";
$this->updateList=$this->updateList."Constraint_catalog=".$this->Constraint_catalog.", ";
}

if (strlen($this->Constraint_schema)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Constraint_schema";
if ($this->Constraint_schema=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Constraint_schema."'";
$this->updateList=$this->updateList."Constraint_schema=".$this->Constraint_schema.", ";
}

if (strlen($this->Constraint_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Constraint_name";
if ($this->Constraint_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Constraint_name."'";
$this->updateList=$this->updateList."Constraint_name=".$this->Constraint_name.", ";
}

if (strlen($this->Table_catalog)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_catalog";
if ($this->Table_catalog=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_catalog."'";
$this->updateList=$this->updateList."Table_catalog=".$this->Table_catalog.", ";
}

if (strlen($this->Table_schema)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_schema";
if ($this->Table_schema=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_schema."'";
$this->updateList=$this->updateList."Table_schema=".$this->Table_schema.", ";
}

if (strlen($this->Table_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_name";
if ($this->Table_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_name."'";
$this->updateList=$this->updateList."Table_name=".$this->Table_name.", ";
}

if (strlen($this->Column_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Column_name";
if ($this->Column_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Column_name."'";
$this->updateList=$this->updateList."Column_name=".$this->Column_name.", ";
}

if (strlen($this->Ordinal_position)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ordinal_position";
if ($this->Ordinal_position=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ordinal_position."'";
$this->updateList=$this->updateList."Ordinal_position=".$this->Ordinal_position.", ";
}

if (strlen($this->Position_in_unique_constraint)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Position_in_unique_constraint";
if ($this->Position_in_unique_constraint=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Position_in_unique_constraint."'";
$this->updateList=$this->updateList."Position_in_unique_constraint=".$this->Position_in_unique_constraint.", ";
}

if (strlen($this->Referenced_table_schema)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Referenced_table_schema";
if ($this->Referenced_table_schema=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Referenced_table_schema."'";
$this->updateList=$this->updateList."Referenced_table_schema=".$this->Referenced_table_schema.", ";
}

if (strlen($this->Referenced_table_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Referenced_table_name";
if ($this->Referenced_table_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Referenced_table_name."'";
$this->updateList=$this->updateList."Referenced_table_name=".$this->Referenced_table_name.", ";
}

if (strlen($this->Referenced_column_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Referenced_column_name";
if ($this->Referenced_column_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Referenced_column_name."'";
$this->updateList=$this->updateList."Referenced_column_name=".$this->Referenced_column_name.", ";
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
$sql="select Constraint_catalog,Constraint_schema,Constraint_name,Table_catalog,Table_schema,Table_name,Column_name,Ordinal_position,Position_in_unique_constraint,Referenced_table_schema,Referenced_table_name,Referenced_column_name from KEY_COLUMN_USAGE where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Constraint_catalog']=$row['Constraint_catalog'];
$tRows[$i]['Constraint_schema']=$row['Constraint_schema'];
$tRows[$i]['Constraint_name']=$row['Constraint_name'];
$tRows[$i]['Table_catalog']=$row['Table_catalog'];
$tRows[$i]['Table_schema']=$row['Table_schema'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Column_name']=$row['Column_name'];
$tRows[$i]['Ordinal_position']=$row['Ordinal_position'];
$tRows[$i]['Position_in_unique_constraint']=$row['Position_in_unique_constraint'];
$tRows[$i]['Referenced_table_schema']=$row['Referenced_table_schema'];
$tRows[$i]['Referenced_table_name']=$row['Referenced_table_name'];
$tRows[$i]['Referenced_column_name']=$row['Referenced_column_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Constraint_catalog,Constraint_schema,Constraint_name,Table_catalog,Table_schema,Table_name,Column_name,Ordinal_position,Position_in_unique_constraint,Referenced_table_schema,Referenced_table_name,Referenced_column_name from KEY_COLUMN_USAGE where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Constraint_catalog']=$row['Constraint_catalog'];
$tRows[$i]['Constraint_schema']=$row['Constraint_schema'];
$tRows[$i]['Constraint_name']=$row['Constraint_name'];
$tRows[$i]['Table_catalog']=$row['Table_catalog'];
$tRows[$i]['Table_schema']=$row['Table_schema'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Column_name']=$row['Column_name'];
$tRows[$i]['Ordinal_position']=$row['Ordinal_position'];
$tRows[$i]['Position_in_unique_constraint']=$row['Position_in_unique_constraint'];
$tRows[$i]['Referenced_table_schema']=$row['Referenced_table_schema'];
$tRows[$i]['Referenced_table_name']=$row['Referenced_table_name'];
$tRows[$i]['Referenced_column_name']=$row['Referenced_column_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
