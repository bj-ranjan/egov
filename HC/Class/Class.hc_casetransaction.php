<body>
<?php
require_once '../class/class.config.php';
class Hc_casetransaction
{
private $Case_id;
private $Rsl;
private $Submit_date;
private $Signed_by;
private $Nextdue_date;
private $Entry_date;
private $Present_status ;
private $T3;
private $T4;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Rsl;
private $Old_Submit_date;
private $Old_Signed_by;
private $Old_Nextdue_date;
private $Old_Entry_date;
private $Old_Present_status ;
private $Old_T3;
private $Old_T4;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Hc_casetransaction()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from hc_casetransaction";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
$this->Entry_date=date('Y-m-d');
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from hc_casetransaction where ".$condition;
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
$sql="select Case_id,Rsl,Signed_by from hc_casetransaction where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Rsl']=$row['Rsl'];//Primary Key-2
$tRow[$i]['Signed_by']=$row['Signed_by'];//Posible Unique Field
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

public function getRsl()
{
return($this->Rsl);
}

public function setRsl($str)
{
$this->Rsl=$str;
}

public function getSubmit_date()
{
return($this->Submit_date);
}

public function setSubmit_date($str)
{
$this->Submit_date=$str;
}

public function getSigned_by()
{
return($this->Signed_by);
}

public function setSigned_by($str)
{
$this->Signed_by=$str;
}

public function getNextdue_date()
{
return($this->Nextdue_date);
}

public function setNextdue_date($str)
{
$this->Nextdue_date=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}

public function getPresent_status ()
{
return($this->Present_status );
}

public function setPresent_status ($str)
{
$this->Present_status =$str;
}

public function getT3()
{
return($this->T3);
}

public function setT3($str)
{
$this->T3=$str;
}

public function getT4()
{
return($this->T4);
}

public function setT4($str)
{
$this->T4=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ,T3,T4 from hc_casetransaction where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Submit_date'])>0)
$this->Old_Submit_date=substr($row['Submit_date'],0,10);
else
$this->Old_Submit_date="NULL";
if (strlen($row['Signed_by'])>0)
$this->Old_Signed_by=$row['Signed_by'];
else
$this->Old_Signed_by="NULL";
if (strlen($row['Nextdue_date'])>0)
$this->Old_Nextdue_date=substr($row['Nextdue_date'],0,10);
else
$this->Old_Nextdue_date="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
if (strlen($row['Present_status'])>0)
$this->Old_Present_status =$row['Present_status'];
else
$this->Old_Present_status ="NULL";
if (strlen($row['T3'])>0)
$this->Old_T3=$row['T3'];
else
$this->Old_T3="NULL";
if (strlen($row['T4'])>0)
$this->Old_T4=$row['T4'];
else
$this->Old_T4="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ,T3,T4 from hc_casetransaction where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Submit_date=$row['Submit_date'];
$this->Signed_by=$row['Signed_by'];
$this->Nextdue_date=$row['Nextdue_date'];
$this->Entry_date=$row['Entry_date'];
$this->Present_status =$row['Present_status'];
$this->T3=$row['T3'];
$this->T4=$row['T4'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Case_id from hc_casetransaction where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
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
$sql="delete from hc_casetransaction where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
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
$sql="update hc_casetransaction set ";
if ($this->Old_Submit_date!=$this->Submit_date &&  strlen($this->Submit_date)>0)
{
if ($this->Submit_date=="NULL")
$sql=$sql."Submit_date=NULL";
else
$sql=$sql."Submit_date='".$this->Submit_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Submit_date=".$this->Submit_date.", ";
}

if ($this->Old_Signed_by!=$this->Signed_by &&  strlen($this->Signed_by)>0)
{
if ($this->Signed_by=="NULL")
$sql=$sql."Signed_by=NULL";
else
$sql=$sql."Signed_by='".$this->Signed_by."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Signed_by=".$this->Signed_by.", ";
}

if ($this->Old_Nextdue_date!=$this->Nextdue_date &&  strlen($this->Nextdue_date)>0)
{
if ($this->Nextdue_date=="NULL")
$sql=$sql."Nextdue_date=NULL";
else
$sql=$sql."Nextdue_date='".$this->Nextdue_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Nextdue_date=".$this->Nextdue_date.", ";
}

if ($this->Old_Entry_date!=$this->Entry_date &&  strlen($this->Entry_date)>0)
{
if ($this->Entry_date=="NULL")
$sql=$sql."Entry_date=NULL";
else
$sql=$sql."Entry_date='".$this->Entry_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
}

if ($this->Old_Present_status !=$this->Present_status  &&  strlen($this->Present_status )>0)
{
if ($this->Present_status =="NULL")
$sql=$sql."Present_status =NULL";
else
$sql=$sql."Present_status ='".$this->Present_status ."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Present_status =".$this->Present_status .", ";
}

if ($this->Old_T3!=$this->T3 &&  strlen($this->T3)>0)
{
if ($this->T3=="NULL")
$sql=$sql."T3=NULL";
else
$sql=$sql."T3='".$this->T3."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."T3=".$this->T3.", ";
}

if ($this->Old_T4!=$this->T4 &&  strlen($this->T4)>0)
{
if ($this->T4=="NULL")
$sql=$sql."T4=NULL";
else
$sql=$sql."T4='".$this->T4."'";
$i++;
$this->updateList=$this->updateList."T4=".$this->T4.", ";
}
else
$sql=$sql."T4=T4";


$cond="  where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
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
$sql1="insert into hc_casetransaction(";
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

if (strlen($this->Rsl)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Rsl";
if ($this->Rsl=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Rsl."'";
$this->updateList=$this->updateList."Rsl=".$this->Rsl.", ";
}

if (strlen($this->Submit_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Submit_date";
if ($this->Submit_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Submit_date."'";
$this->updateList=$this->updateList."Submit_date=".$this->Submit_date.", ";
}

if (strlen($this->Signed_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Signed_by";
if ($this->Signed_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Signed_by."'";
$this->updateList=$this->updateList."Signed_by=".$this->Signed_by.", ";
}

if (strlen($this->Nextdue_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Nextdue_date";
if ($this->Nextdue_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Nextdue_date."'";
$this->updateList=$this->updateList."Nextdue_date=".$this->Nextdue_date.", ";
}

if (strlen($this->Entry_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Entry_date";
if ($this->Entry_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Entry_date."'";
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
}

if (strlen($this->Present_status )>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Present_status ";
if ($this->Present_status =="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Present_status ."'";
$this->updateList=$this->updateList."Present_status =".$this->Present_status .", ";
}

if (strlen($this->T3)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."T3";
if ($this->T3=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->T3."'";
$this->updateList=$this->updateList."T3=".$this->T3.", ";
}

if (strlen($this->T4)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."T4";
if ($this->T4=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->T4."'";
$this->updateList=$this->updateList."T4=".$this->T4.", ";
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
$sql="select max(Case_id) from hc_casetransaction";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxRsl($id)
{
$sql="select max(Rsl) from hc_casetransaction where Case_id=".$id;
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
$sql="select Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ,T3,T4 from hc_casetransaction where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Submit_date']=$row['Submit_date'];
$tRows[$i]['Signed_by']=$row['Signed_by'];
$tRows[$i]['Nextdue_date']=$row['Nextdue_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Present_status']=$row['Present_status'];
$tRows[$i]['T3']=$row['T3'];
$tRows[$i]['T4']=$row['T4'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ,T3,T4 from hc_casetransaction where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Submit_date']=$row['Submit_date'];
$tRows[$i]['Signed_by']=$row['Signed_by'];
$tRows[$i]['Nextdue_date']=$row['Nextdue_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Present_status']=$row['Present_status'];
$tRows[$i]['T3']=$row['T3'];
$tRows[$i]['T4']=$row['T4'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
