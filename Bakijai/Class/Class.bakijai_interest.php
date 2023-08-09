<body>
<?php
require_once '../class/class.config.php';
class Bakijai_interest
{
private $Case_id;
private $Interest_payable;
private $Pay_date;
private $Entry_date;
private $User_code;
private $Receipt_no;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Interest_payable;
private $Old_Pay_date;
private $Old_Entry_date;
private $Old_User_code;
private $Old_Receipt_no;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Case_id="0";
//public function _construct($i) //for PHP6
public function Bakijai_interest()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from bakijai_interest";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
if (isset($_SESSION['uid']))
$this->User_code=$_SESSION['uid'];
else
$this->User_code="-";    
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
$sql=" select count(*) from bakijai_interest where ".$condition;
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
$sql="select Case_id,User_code from bakijai_interest where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['User_code']=$row['User_code'];//Posible Unique Field
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

public function getInterest_payable()
{
return($this->Interest_payable);
}

public function setInterest_payable($str)
{
$this->Interest_payable=$str;
}

public function getPay_date()
{
return($this->Pay_date);
}

public function setPay_date($str)
{
$this->Pay_date=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}

public function getUser_code()
{
return($this->User_code);
}

public function setUser_code($str)
{
$this->User_code=$str;
}

public function getReceipt_no()
{
return($this->Receipt_no);
}

public function setReceipt_no($str)
{
$this->Receipt_no=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,Interest_payable,Pay_date,Entry_date,User_code,Receipt_no from bakijai_interest where Case_id='".$this->Case_id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Interest_payable'])>0)
$this->Old_Interest_payable=$row['Interest_payable'];
else
$this->Old_Interest_payable="NULL";
if (strlen($row['Pay_date'])>0)
$this->Old_Pay_date=substr($row['Pay_date'],0,10);
else
$this->Old_Pay_date="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
if (strlen($row['User_code'])>0)
$this->Old_User_code=$row['User_code'];
else
$this->Old_User_code="NULL";
if (strlen($row['Receipt_no'])>0)
$this->Old_Receipt_no=$row['Receipt_no'];
else
$this->Old_Receipt_no="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Case_id,Interest_payable,Pay_date,Entry_date,User_code,Receipt_no from bakijai_interest where Case_id='".$this->Case_id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Interest_payable=$row['Interest_payable'];
$this->Pay_date=$row['Pay_date'];
$this->Entry_date=$row['Entry_date'];
$this->User_code=$row['User_code'];
$this->Receipt_no=$row['Receipt_no'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Case_id from bakijai_interest where Case_id='".$this->Case_id."'";
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
$sql="delete from bakijai_interest where Case_id='".$this->Case_id."'";
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
$sql="update bakijai_interest set ";
if ($this->Old_Interest_payable!=$this->Interest_payable &&  strlen($this->Interest_payable)>0)
{
if ($this->Interest_payable=="NULL")
$sql=$sql."Interest_payable=NULL";
else
$sql=$sql."Interest_payable='".$this->Interest_payable."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Interest_payable=".$this->Interest_payable.", ";
}

if ($this->Old_Pay_date!=$this->Pay_date &&  strlen($this->Pay_date)>0)
{
if ($this->Pay_date=="NULL")
$sql=$sql."Pay_date=NULL";
else
$sql=$sql."Pay_date='".$this->Pay_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pay_date=".$this->Pay_date.", ";
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

if ($this->Old_User_code!=$this->User_code &&  strlen($this->User_code)>0)
{
if ($this->User_code=="NULL")
$sql=$sql."User_code=NULL";
else
$sql=$sql."User_code='".$this->User_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."User_code=".$this->User_code.", ";
}

if ($this->Old_Receipt_no!=$this->Receipt_no &&  strlen($this->Receipt_no)>0)
{
if ($this->Receipt_no=="NULL")
$sql=$sql."Receipt_no=NULL";
else
$sql=$sql."Receipt_no='".$this->Receipt_no."'";
$i++;
$this->updateList=$this->updateList."Receipt_no=".$this->Receipt_no.", ";
}
else
$sql=$sql."Receipt_no=Receipt_no";


$cond="  where Case_id='".$this->Case_id."'";
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
$sql1="insert into bakijai_interest(";
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

if (strlen($this->Interest_payable)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Interest_payable";
if ($this->Interest_payable=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Interest_payable."'";
$this->updateList=$this->updateList."Interest_payable=".$this->Interest_payable.", ";
}

if (strlen($this->Pay_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pay_date";
if ($this->Pay_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pay_date."'";
$this->updateList=$this->updateList."Pay_date=".$this->Pay_date.", ";
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

if (strlen($this->User_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."User_code";
if ($this->User_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->User_code."'";
$this->updateList=$this->updateList."User_code=".$this->User_code.", ";
}

if (strlen($this->Receipt_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Receipt_no";
if ($this->Receipt_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Receipt_no."'";
$this->updateList=$this->updateList."Receipt_no=".$this->Receipt_no.", ";
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
$sql="select max(Case_id) from bakijai_interest";
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
$sql="select Case_id,Interest_payable,Pay_date,Entry_date,User_code,Receipt_no from bakijai_interest where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Interest_payable']=$row['Interest_payable'];
$tRows[$i]['Pay_date']=$row['Pay_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Receipt_no']=$row['Receipt_no'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Interest_payable,Pay_date,Entry_date,User_code,Receipt_no from bakijai_interest where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Interest_payable']=$row['Interest_payable'];
$tRows[$i]['Pay_date']=$row['Pay_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Receipt_no']=$row['Receipt_no'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
