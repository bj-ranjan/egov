<body>
<?php
require_once '../class/class.config.php';
class Finalreport
{
private $Fdate;
private $User;
private $Entry_date;

//extra Old Variable to store Pre update Data
private $Old_Fdate;
private $Old_User;
private $Old_Entry_date;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Finalreport()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from finalreport";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
$this->Entry_date=date('Y-m-d');
if (isset($_SESSION['uid']))
$this->User=$_SESSION['uid'];
else
$this->User="-";   
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from finalreport where ".$condition;
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
$sql="select Fdate,User from finalreport where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Fdate']=$row['Fdate'];//Primary Key-1
$tRow[$i]['User']=$row['User'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getFdate()
{
return($this->Fdate);
}

public function setFdate($str)
{
$this->Fdate=$str;
}

public function getUser()
{
return($this->User);
}

public function setUser($str)
{
$this->User=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Fdate,User,Entry_date from finalreport where Fdate='".$this->Fdate."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['User'])>0)
$this->Old_User=$row['User'];
else
$this->Old_User="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Fdate,User,Entry_date from finalreport where Fdate='".$this->Fdate."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->User=$row['User'];
$this->Entry_date=$row['Entry_date'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from finalreport where Fdate='".$this->Fdate."'";
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
$sql="update finalreport set ";
if ($this->Old_User!=$this->User &&  strlen($this->User)>0)
{
if ($this->User=="NULL")
$sql=$sql."User=NULL";
else
$sql=$sql."User='".$this->User."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."User=".$this->User.", ";
}

if ($this->Old_Entry_date!=$this->Entry_date &&  strlen($this->Entry_date)>0)
{
if ($this->Entry_date=="NULL")
$sql=$sql."Entry_date=NULL";
else
$sql=$sql."Entry_date='".$this->Entry_date."'";
$i++;
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
}
else
$sql=$sql."Entry_date=Entry_date";


$cond="  where Fdate='".$this->Fdate."'";
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
$sql1="insert into finalreport(";
$sql=" values (";
$mcol=0;
if (strlen($this->Fdate)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Fdate";
if ($this->Fdate=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Fdate."'";
$this->updateList=$this->updateList."Fdate=".$this->Fdate.", ";
}

if (strlen($this->User)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."User";
if ($this->User=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->User."'";
$this->updateList=$this->updateList."User=".$this->User.", ";
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
$sql="select Fdate,User,Entry_date from finalreport where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Fdate']=$row['Fdate'];
$tRows[$i]['User']=$row['User'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Fdate,User,Entry_date from finalreport order by Fdate desc LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Fdate']=$row['Fdate'];
$tRows[$i]['User']=$row['User'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function getFinalDate()
{
$sql="select max(fdate) from finalreport";
$i=0;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return(substr($row[0],0,10));
else
return("");

} //End getAllRecord

}//End Class
?>
