<body>
<?php
require_once 'class.config.php';
class Referential_constraints
{
private $Constraint_catalog;
private $Constraint_schema;
private $Constraint_name;
private $Unique_constraint_catalog;
private $Unique_constraint_schema;
private $Unique_constraint_name;
private $Match_option;
private $Update_rule;
private $Delete_rule;
private $Table_name;
private $Referenced_table_name;

//extra Old Variable to store Pre update Data
private $Old_Constraint_catalog;
private $Old_Constraint_schema;
private $Old_Constraint_name;
private $Old_Unique_constraint_catalog;
private $Old_Unique_constraint_schema;
private $Old_Unique_constraint_name;
private $Old_Match_option;
private $Old_Update_rule;
private $Old_Delete_rule;
private $Old_Table_name;
private $Old_Referenced_table_name;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Referential_constraints()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from REFERENTIAL_CONSTRAINTS";
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
$sql=" select count(*) from REFERENTIAL_CONSTRAINTS where ".$condition;
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
$sql="select ,Constraint_catalog from REFERENTIAL_CONSTRAINTS where ".$this->condString;
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

public function getUnique_constraint_catalog()
{
return($this->Unique_constraint_catalog);
}

public function setUnique_constraint_catalog($str)
{
$this->Unique_constraint_catalog=$str;
}

public function getUnique_constraint_schema()
{
return($this->Unique_constraint_schema);
}

public function setUnique_constraint_schema($str)
{
$this->Unique_constraint_schema=$str;
}

public function getUnique_constraint_name()
{
return($this->Unique_constraint_name);
}

public function setUnique_constraint_name($str)
{
$this->Unique_constraint_name=$str;
}

public function getMatch_option()
{
return($this->Match_option);
}

public function setMatch_option($str)
{
$this->Match_option=$str;
}

public function getUpdate_rule()
{
return($this->Update_rule);
}

public function setUpdate_rule($str)
{
$this->Update_rule=$str;
}

public function getDelete_rule()
{
return($this->Delete_rule);
}

public function setDelete_rule($str)
{
$this->Delete_rule=$str;
}

public function getTable_name()
{
return($this->Table_name);
}

public function setTable_name($str)
{
$this->Table_name=$str;
}

public function getReferenced_table_name()
{
return($this->Referenced_table_name);
}

public function setReferenced_table_name($str)
{
$this->Referenced_table_name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}





public function SaveRecord()
{
$this->updateList="";
$sql1="insert into REFERENTIAL_CONSTRAINTS(";
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

if (strlen($this->Unique_constraint_catalog)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Unique_constraint_catalog";
if ($this->Unique_constraint_catalog=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Unique_constraint_catalog."'";
$this->updateList=$this->updateList."Unique_constraint_catalog=".$this->Unique_constraint_catalog.", ";
}

if (strlen($this->Unique_constraint_schema)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Unique_constraint_schema";
if ($this->Unique_constraint_schema=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Unique_constraint_schema."'";
$this->updateList=$this->updateList."Unique_constraint_schema=".$this->Unique_constraint_schema.", ";
}

if (strlen($this->Unique_constraint_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Unique_constraint_name";
if ($this->Unique_constraint_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Unique_constraint_name."'";
$this->updateList=$this->updateList."Unique_constraint_name=".$this->Unique_constraint_name.", ";
}

if (strlen($this->Match_option)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Match_option";
if ($this->Match_option=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Match_option."'";
$this->updateList=$this->updateList."Match_option=".$this->Match_option.", ";
}

if (strlen($this->Update_rule)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Update_rule";
if ($this->Update_rule=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Update_rule."'";
$this->updateList=$this->updateList."Update_rule=".$this->Update_rule.", ";
}

if (strlen($this->Delete_rule)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Delete_rule";
if ($this->Delete_rule=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Delete_rule."'";
$this->updateList=$this->updateList."Delete_rule=".$this->Delete_rule.", ";
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
$sql="select Constraint_catalog,Constraint_schema,Constraint_name,Unique_constraint_catalog,Unique_constraint_schema,Unique_constraint_name,Match_option,Update_rule,Delete_rule,Table_name,Referenced_table_name from REFERENTIAL_CONSTRAINTS where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Constraint_catalog']=$row['Constraint_catalog'];
$tRows[$i]['Constraint_schema']=$row['Constraint_schema'];
$tRows[$i]['Constraint_name']=$row['Constraint_name'];
$tRows[$i]['Unique_constraint_catalog']=$row['Unique_constraint_catalog'];
$tRows[$i]['Unique_constraint_schema']=$row['Unique_constraint_schema'];
$tRows[$i]['Unique_constraint_name']=$row['Unique_constraint_name'];
$tRows[$i]['Match_option']=$row['Match_option'];
$tRows[$i]['Update_rule']=$row['Update_rule'];
$tRows[$i]['Delete_rule']=$row['Delete_rule'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Referenced_table_name']=$row['Referenced_table_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Constraint_catalog,Constraint_schema,Constraint_name,Unique_constraint_catalog,Unique_constraint_schema,Unique_constraint_name,Match_option,Update_rule,Delete_rule,Table_name,Referenced_table_name from REFERENTIAL_CONSTRAINTS where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Constraint_catalog']=$row['Constraint_catalog'];
$tRows[$i]['Constraint_schema']=$row['Constraint_schema'];
$tRows[$i]['Constraint_name']=$row['Constraint_name'];
$tRows[$i]['Unique_constraint_catalog']=$row['Unique_constraint_catalog'];
$tRows[$i]['Unique_constraint_schema']=$row['Unique_constraint_schema'];
$tRows[$i]['Unique_constraint_name']=$row['Unique_constraint_name'];
$tRows[$i]['Match_option']=$row['Match_option'];
$tRows[$i]['Update_rule']=$row['Update_rule'];
$tRows[$i]['Delete_rule']=$row['Delete_rule'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Referenced_table_name']=$row['Referenced_table_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
