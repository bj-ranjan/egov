<body>
<?php
require_once 'class.config.php';
class Tables
{
private $Table_catalog;
private $Table_schema;
private $Table_name;
private $Table_type;
private $Engine;
private $Version;
private $Row_format;
private $Table_rows;
private $Avg_row_length;
private $Data_length;
private $Max_data_length;
private $Index_length;
private $Data_free;
private $Auto_increment;
private $Create_time;
private $Update_time;
private $Check_time;
private $Table_collation;
private $Checksum;
private $Create_options;
private $Table_comment;

//extra Old Variable to store Pre update Data
private $Old_Table_catalog;
private $Old_Table_schema;
private $Old_Table_name;
private $Old_Table_type;
private $Old_Engine;
private $Old_Version;
private $Old_Row_format;
private $Old_Table_rows;
private $Old_Avg_row_length;
private $Old_Data_length;
private $Old_Max_data_length;
private $Old_Index_length;
private $Old_Data_free;
private $Old_Auto_increment;
private $Old_Create_time;
private $Old_Update_time;
private $Old_Check_time;
private $Old_Table_collation;
private $Old_Checksum;
private $Old_Create_options;
private $Old_Table_comment;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Tables()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from TABLES";
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
$sql=" select count(*) from TABLES where ".$condition;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
} //rowCount



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

public function getTable_type()
{
return($this->Table_type);
}

public function setTable_type($str)
{
$this->Table_type=$str;
}

public function getEngine()
{
return($this->Engine);
}

public function setEngine($str)
{
$this->Engine=$str;
}

public function getVersion()
{
return($this->Version);
}

public function setVersion($str)
{
$this->Version=$str;
}

public function getRow_format()
{
return($this->Row_format);
}

public function setRow_format($str)
{
$this->Row_format=$str;
}

public function getTable_rows()
{
return($this->Table_rows);
}

public function setTable_rows($str)
{
$this->Table_rows=$str;
}

public function getAvg_row_length()
{
return($this->Avg_row_length);
}

public function setAvg_row_length($str)
{
$this->Avg_row_length=$str;
}

public function getData_length()
{
return($this->Data_length);
}

public function setData_length($str)
{
$this->Data_length=$str;
}

public function getMax_data_length()
{
return($this->Max_data_length);
}

public function setMax_data_length($str)
{
$this->Max_data_length=$str;
}

public function getIndex_length()
{
return($this->Index_length);
}

public function setIndex_length($str)
{
$this->Index_length=$str;
}

public function getData_free()
{
return($this->Data_free);
}

public function setData_free($str)
{
$this->Data_free=$str;
}

public function getAuto_increment()
{
return($this->Auto_increment);
}

public function setAuto_increment($str)
{
$this->Auto_increment=$str;
}

public function getCreate_time()
{
return($this->Create_time);
}

public function setCreate_time($str)
{
$this->Create_time=$str;
}

public function getUpdate_time()
{
return($this->Update_time);
}

public function setUpdate_time($str)
{
$this->Update_time=$str;
}

public function getCheck_time()
{
return($this->Check_time);
}

public function setCheck_time($str)
{
$this->Check_time=$str;
}

public function getTable_collation()
{
return($this->Table_collation);
}

public function setTable_collation($str)
{
$this->Table_collation=$str;
}

public function getChecksum()
{
return($this->Checksum);
}

public function setChecksum($str)
{
$this->Checksum=$str;
}

public function getCreate_options()
{
return($this->Create_options);
}

public function setCreate_options($str)
{
$this->Create_options=$str;
}

public function getTable_comment()
{
return($this->Table_comment);
}

public function setTable_comment($str)
{
$this->Table_comment=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}





public function SaveRecord()
{
$this->updateList="";
$sql1="insert into TABLES(";
$sql=" values (";
$mcol=0;
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

if (strlen($this->Table_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_type";
if ($this->Table_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_type."'";
$this->updateList=$this->updateList."Table_type=".$this->Table_type.", ";
}

if (strlen($this->Engine)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Engine";
if ($this->Engine=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Engine."'";
$this->updateList=$this->updateList."Engine=".$this->Engine.", ";
}

if (strlen($this->Version)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Version";
if ($this->Version=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Version."'";
$this->updateList=$this->updateList."Version=".$this->Version.", ";
}

if (strlen($this->Row_format)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Row_format";
if ($this->Row_format=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Row_format."'";
$this->updateList=$this->updateList."Row_format=".$this->Row_format.", ";
}

if (strlen($this->Table_rows)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_rows";
if ($this->Table_rows=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_rows."'";
$this->updateList=$this->updateList."Table_rows=".$this->Table_rows.", ";
}

if (strlen($this->Avg_row_length)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Avg_row_length";
if ($this->Avg_row_length=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Avg_row_length."'";
$this->updateList=$this->updateList."Avg_row_length=".$this->Avg_row_length.", ";
}

if (strlen($this->Data_length)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Data_length";
if ($this->Data_length=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Data_length."'";
$this->updateList=$this->updateList."Data_length=".$this->Data_length.", ";
}

if (strlen($this->Max_data_length)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Max_data_length";
if ($this->Max_data_length=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Max_data_length."'";
$this->updateList=$this->updateList."Max_data_length=".$this->Max_data_length.", ";
}

if (strlen($this->Index_length)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Index_length";
if ($this->Index_length=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Index_length."'";
$this->updateList=$this->updateList."Index_length=".$this->Index_length.", ";
}

if (strlen($this->Data_free)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Data_free";
if ($this->Data_free=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Data_free."'";
$this->updateList=$this->updateList."Data_free=".$this->Data_free.", ";
}

if (strlen($this->Auto_increment)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Auto_increment";
if ($this->Auto_increment=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Auto_increment."'";
$this->updateList=$this->updateList."Auto_increment=".$this->Auto_increment.", ";
}

if (strlen($this->Create_time)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Create_time";
if ($this->Create_time=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Create_time."'";
$this->updateList=$this->updateList."Create_time=".$this->Create_time.", ";
}

if (strlen($this->Update_time)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Update_time";
if ($this->Update_time=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Update_time."'";
$this->updateList=$this->updateList."Update_time=".$this->Update_time.", ";
}

if (strlen($this->Check_time)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Check_time";
if ($this->Check_time=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Check_time."'";
$this->updateList=$this->updateList."Check_time=".$this->Check_time.", ";
}

if (strlen($this->Table_collation)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_collation";
if ($this->Table_collation=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_collation."'";
$this->updateList=$this->updateList."Table_collation=".$this->Table_collation.", ";
}

if (strlen($this->Checksum)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Checksum";
if ($this->Checksum=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Checksum."'";
$this->updateList=$this->updateList."Checksum=".$this->Checksum.", ";
}

if (strlen($this->Create_options)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Create_options";
if ($this->Create_options=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Create_options."'";
$this->updateList=$this->updateList."Create_options=".$this->Create_options.", ";
}

if (strlen($this->Table_comment)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Table_comment";
if ($this->Table_comment=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Table_comment."'";
$this->updateList=$this->updateList."Table_comment=".$this->Table_comment.", ";
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
$sql="select Table_catalog,Table_schema,Table_name,Table_type,Engine,Version,Row_format,Table_rows,Avg_row_length,Data_length,Max_data_length,Index_length,Data_free,Auto_increment,Create_time,Update_time,Check_time,Table_collation,Checksum,Create_options,Table_comment from TABLES where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Table_catalog']=$row['Table_catalog'];
$tRows[$i]['Table_schema']=$row['Table_schema'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Table_type']=$row['Table_type'];
$tRows[$i]['Engine']=$row['Engine'];
$tRows[$i]['Version']=$row['Version'];
$tRows[$i]['Row_format']=$row['Row_format'];
$tRows[$i]['Table_rows']=$row['Table_rows'];
$tRows[$i]['Avg_row_length']=$row['Avg_row_length'];
$tRows[$i]['Data_length']=$row['Data_length'];
$tRows[$i]['Max_data_length']=$row['Max_data_length'];
$tRows[$i]['Index_length']=$row['Index_length'];
$tRows[$i]['Data_free']=$row['Data_free'];
$tRows[$i]['Auto_increment']=$row['Auto_increment'];
$tRows[$i]['Create_time']=$row['Create_time'];
$tRows[$i]['Update_time']=$row['Update_time'];
$tRows[$i]['Check_time']=$row['Check_time'];
$tRows[$i]['Table_collation']=$row['Table_collation'];
$tRows[$i]['Checksum']=$row['Checksum'];
$tRows[$i]['Create_options']=$row['Create_options'];
$tRows[$i]['Table_comment']=$row['Table_comment'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Table_catalog,Table_schema,Table_name,Table_type,Engine,Version,Row_format,Table_rows,Avg_row_length,Data_length,Max_data_length,Index_length,Data_free,Auto_increment,Create_time,Update_time,Check_time,Table_collation,Checksum,Create_options,Table_comment from TABLES where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Table_catalog']=$row['Table_catalog'];
$tRows[$i]['Table_schema']=$row['Table_schema'];
$tRows[$i]['Table_name']=$row['Table_name'];
$tRows[$i]['Table_type']=$row['Table_type'];
$tRows[$i]['Engine']=$row['Engine'];
$tRows[$i]['Version']=$row['Version'];
$tRows[$i]['Row_format']=$row['Row_format'];
$tRows[$i]['Table_rows']=$row['Table_rows'];
$tRows[$i]['Avg_row_length']=$row['Avg_row_length'];
$tRows[$i]['Data_length']=$row['Data_length'];
$tRows[$i]['Max_data_length']=$row['Max_data_length'];
$tRows[$i]['Index_length']=$row['Index_length'];
$tRows[$i]['Data_free']=$row['Data_free'];
$tRows[$i]['Auto_increment']=$row['Auto_increment'];
$tRows[$i]['Create_time']=$row['Create_time'];
$tRows[$i]['Update_time']=$row['Update_time'];
$tRows[$i]['Check_time']=$row['Check_time'];
$tRows[$i]['Table_collation']=$row['Table_collation'];
$tRows[$i]['Checksum']=$row['Checksum'];
$tRows[$i]['Create_options']=$row['Create_options'];
$tRows[$i]['Table_comment']=$row['Table_comment'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
