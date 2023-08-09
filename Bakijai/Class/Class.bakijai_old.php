<body>
<?php
require_once '../class/class.config.php';
class Bakijai_old
{
private $Id;
private $Bank;
private $Branch;
private $Amount;
private $Paid;
private $Balance;
private $Interest;
private $Interest_collected;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Bank;
private $Old_Branch;
private $Old_Amount;
private $Old_Paid;
private $Old_Balance;
private $Old_Interest;
private $Old_Interest_collected;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Interest_collected="No";
//public function _construct($i) //for PHP6
public function Bakijai_old()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from bakijai_old";
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
$sql=" select count(*) from bakijai_old where ".$condition;
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
$sql="select Id,Bank from bakijai_old where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Id']=$row['Id'];//Primary Key-1
$tRow[$i]['Bank']=$row['Bank'];//Posible Unique Field
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

public function getBank()
{
return($this->Bank);
}

public function setBank($str)
{
$this->Bank=$str;
}

public function getBranch()
{
return($this->Branch);
}

public function setBranch($str)
{
$this->Branch=$str;
}

public function getAmount()
{
return($this->Amount);
}

public function setAmount($str)
{
$this->Amount=$str;
}

public function getPaid()
{
return($this->Paid);
}

public function setPaid($str)
{
$this->Paid=$str;
}

public function getBalance()
{
return($this->Balance);
}

public function setBalance($str)
{
$this->Balance=$str;
}

public function getInterest()
{
return($this->Interest);
}

public function setInterest($str)
{
$this->Interest=$str;
}

public function getInterest_collected()
{
return($this->Interest_collected);
}

public function setInterest_collected($str)
{
$this->Interest_collected=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Bank,Branch,Amount,Paid,Balance,Interest,Interest_collected from bakijai_old where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Bank'])>0)
$this->Old_Bank=$row['Bank'];
else
$this->Old_Bank="NULL";
if (strlen($row['Branch'])>0)
$this->Old_Branch=$row['Branch'];
else
$this->Old_Branch="NULL";
if (strlen($row['Amount'])>0)
$this->Old_Amount=$row['Amount'];
else
$this->Old_Amount="NULL";
if (strlen($row['Paid'])>0)
$this->Old_Paid=$row['Paid'];
else
$this->Old_Paid="NULL";
if (strlen($row['Balance'])>0)
$this->Old_Balance=$row['Balance'];
else
$this->Old_Balance="NULL";
if (strlen($row['Interest'])>0)
$this->Old_Interest=$row['Interest'];
else
$this->Old_Interest="NULL";
if (strlen($row['Interest_collected'])>0)
$this->Old_Interest_collected=$row['Interest_collected'];
else
$this->Old_Interest_collected="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Bank,Branch,Amount,Paid,Balance,Interest,Interest_collected from bakijai_old where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Bank=$row['Bank'];
$this->Branch=$row['Branch'];
$this->Amount=$row['Amount'];
$this->Paid=$row['Paid'];
$this->Balance=$row['Balance'];
$this->Interest=$row['Interest'];
$this->Interest_collected=$row['Interest_collected'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from bakijai_old where Id='".$this->Id."'";
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
$sql="update bakijai_old set ";
if ($this->Old_Bank!=$this->Bank &&  strlen($this->Bank)>0)
{
if ($this->Bank=="NULL")
$sql=$sql."Bank=NULL";
else
$sql=$sql."Bank='".$this->Bank."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bank=".$this->Bank.", ";
}

if ($this->Old_Branch!=$this->Branch &&  strlen($this->Branch)>0)
{
if ($this->Branch=="NULL")
$sql=$sql."Branch=NULL";
else
$sql=$sql."Branch='".$this->Branch."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Branch=".$this->Branch.", ";
}

if ($this->Old_Amount!=$this->Amount &&  strlen($this->Amount)>0)
{
if ($this->Amount=="NULL")
$sql=$sql."Amount=NULL";
else
$sql=$sql."Amount='".$this->Amount."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Amount=".$this->Amount.", ";
}

if ($this->Old_Paid!=$this->Paid &&  strlen($this->Paid)>0)
{
if ($this->Paid=="NULL")
$sql=$sql."Paid=NULL";
else
$sql=$sql."Paid='".$this->Paid."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Paid=".$this->Paid.", ";
}

if ($this->Old_Balance!=$this->Balance &&  strlen($this->Balance)>0)
{
if ($this->Balance=="NULL")
$sql=$sql."Balance=NULL";
else
$sql=$sql."Balance='".$this->Balance."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Balance=".$this->Balance.", ";
}

if ($this->Old_Interest!=$this->Interest &&  strlen($this->Interest)>0)
{
if ($this->Interest=="NULL")
$sql=$sql."Interest=NULL";
else
$sql=$sql."Interest='".$this->Interest."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Interest=".$this->Interest.", ";
}

if ($this->Old_Interest_collected!=$this->Interest_collected &&  strlen($this->Interest_collected)>0)
{
if ($this->Interest_collected=="NULL")
$sql=$sql."Interest_collected=NULL";
else
$sql=$sql."Interest_collected='".$this->Interest_collected."'";
$i++;
$this->updateList=$this->updateList."Interest_collected=".$this->Interest_collected.", ";
}
else
$sql=$sql."Interest_collected=Interest_collected";


$cond="  where Id='".$this->Id."'";
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
$sql1="insert into bakijai_old(";
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

if (strlen($this->Bank)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bank";
if ($this->Bank=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bank."'";
$this->updateList=$this->updateList."Bank=".$this->Bank.", ";
}

if (strlen($this->Branch)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch";
if ($this->Branch=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch."'";
$this->updateList=$this->updateList."Branch=".$this->Branch.", ";
}

if (strlen($this->Amount)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Amount";
if ($this->Amount=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Amount."'";
$this->updateList=$this->updateList."Amount=".$this->Amount.", ";
}

if (strlen($this->Paid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Paid";
if ($this->Paid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Paid."'";
$this->updateList=$this->updateList."Paid=".$this->Paid.", ";
}

if (strlen($this->Balance)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Balance";
if ($this->Balance=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Balance."'";
$this->updateList=$this->updateList."Balance=".$this->Balance.", ";
}

if (strlen($this->Interest)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Interest";
if ($this->Interest=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Interest."'";
$this->updateList=$this->updateList."Interest=".$this->Interest.", ";
}

if (strlen($this->Interest_collected)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Interest_collected";
if ($this->Interest_collected=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Interest_collected."'";
$this->updateList=$this->updateList."Interest_collected=".$this->Interest_collected.", ";
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


public function maxId()
{
$sql="select max(Id) from bakijai_old";
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
$sql="select Id,Bank,Branch,Amount,Paid,Balance,Interest,Interest_collected from bakijai_old where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Paid']=$row['Paid'];
$tRows[$i]['Balance']=$row['Balance'];
$tRows[$i]['Interest']=$row['Interest'];
$tRows[$i]['Interest_collected']=$row['Interest_collected'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Bank,Branch,Amount,Paid,Balance,Interest,Interest_collected from bakijai_old where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Paid']=$row['Paid'];
$tRows[$i]['Balance']=$row['Balance'];
$tRows[$i]['Interest']=$row['Interest'];
$tRows[$i]['Interest_collected']=$row['Interest_collected'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
