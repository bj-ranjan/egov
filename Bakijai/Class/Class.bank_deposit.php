<body>
<?php
require_once '../class/class.config.php';
class Bank_deposit
{
private $Case_id;
private $Installment;
private $Deposit_date;
private $Amount;
private $Collection_book_no;
private $Collection_rcpt_no;
private $Bank_rcpt_no;
private $Rsl;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Installment;
private $Old_Deposit_date;
private $Old_Amount;
private $Old_Collection_book_no;
private $Old_Collection_rcpt_no;
private $Old_Bank_rcpt_no;
private $Old_Rsl;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Bank_deposit()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from bank_deposit";
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
$sql=" select count(*) from bank_deposit where ".$condition;
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
$sql="select Case_id,Installment,Amount from bank_deposit where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Installment']=$row['Installment'];//Primary Key-2
$tRow[$i]['Amount']=$row['Amount'];//Posible Unique Field
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

public function getInstallment()
{
return($this->Installment);
}

public function setInstallment($str)
{
$this->Installment=$str;
}

public function getDeposit_date()
{
return($this->Deposit_date);
}

public function setDeposit_date($str)
{
$this->Deposit_date=$str;
}

public function getAmount()
{
return($this->Amount);
}

public function setAmount($str)
{
$this->Amount=$str;
}

public function getCollection_book_no()
{
return($this->Collection_book_no);
}

public function setCollection_book_no($str)
{
$this->Collection_book_no=$str;
}

public function getCollection_rcpt_no()
{
return($this->Collection_rcpt_no);
}

public function setCollection_rcpt_no($str)
{
$this->Collection_rcpt_no=$str;
}

public function getBank_rcpt_no()
{
return($this->Bank_rcpt_no);
}

public function setBank_rcpt_no($str)
{
$this->Bank_rcpt_no=$str;
}

public function getRsl()
{
return($this->Rsl);
}

public function setRsl($str)
{
$this->Rsl=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,Installment,Deposit_date,Amount,Collection_book_no,Collection_rcpt_no,Bank_rcpt_no,Rsl from bank_deposit where Case_id='".$this->Case_id."' and Installment='".$this->Installment."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Deposit_date'])>0)
$this->Old_Deposit_date=substr($row['Deposit_date'],0,10);
else
$this->Old_Deposit_date="NULL";
if (strlen($row['Amount'])>0)
$this->Old_Amount=$row['Amount'];
else
$this->Old_Amount="NULL";
if (strlen($row['Collection_book_no'])>0)
$this->Old_Collection_book_no=$row['Collection_book_no'];
else
$this->Old_Collection_book_no="NULL";
if (strlen($row['Collection_rcpt_no'])>0)
$this->Old_Collection_rcpt_no=$row['Collection_rcpt_no'];
else
$this->Old_Collection_rcpt_no="NULL";
if (strlen($row['Bank_rcpt_no'])>0)
$this->Old_Bank_rcpt_no=$row['Bank_rcpt_no'];
else
$this->Old_Bank_rcpt_no="NULL";
if (strlen($row['Rsl'])>0)
$this->Old_Rsl=$row['Rsl'];
else
$this->Old_Rsl="NULL";
return(true);
}
else
return(false);
} //end copy variable



public function EditRecord()
{
$sql="select Case_id,Installment,Deposit_date,Amount,Collection_book_no,Collection_rcpt_no,Bank_rcpt_no,Rsl from bank_deposit where Case_id='".$this->Case_id."' and Installment='".$this->Installment."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$this->returnSql=$sql;
if ($row)
{
//$this->Available=true;
$this->Deposit_date=$row['Deposit_date'];
$this->Amount=$row['Amount'];
$this->Collection_book_no=$row['Collection_book_no'];
$this->Collection_rcpt_no=$row['Collection_rcpt_no'];
$this->Bank_rcpt_no=$row['Bank_rcpt_no'];
$this->Rsl=$row['Rsl'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Case_id from bank_deposit where Case_id='".$this->Case_id."' and Installment='".$this->Installment."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$this->returnSql=$sql;
if ($row)
return(true);
else
return(false);
} //end Available


public function DeleteRecord()
{
$sql="delete from bank_deposit where Case_id='".$this->Case_id."' and Installment='".$this->Installment."'";
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
$sql="update bank_deposit set ";
if ($this->Old_Deposit_date!=$this->Deposit_date &&  strlen($this->Deposit_date)>0)
{
if ($this->Deposit_date=="NULL")
$sql=$sql."Deposit_date=NULL";
else
$sql=$sql."Deposit_date='".$this->Deposit_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Deposit_date=".$this->Deposit_date.", ";
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

if ($this->Old_Collection_book_no!=$this->Collection_book_no &&  strlen($this->Collection_book_no)>0)
{
if ($this->Collection_book_no=="NULL")
$sql=$sql."Collection_book_no=NULL";
else
$sql=$sql."Collection_book_no='".$this->Collection_book_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Collection_book_no=".$this->Collection_book_no.", ";
}

if ($this->Old_Collection_rcpt_no!=$this->Collection_rcpt_no &&  strlen($this->Collection_rcpt_no)>0)
{
if ($this->Collection_rcpt_no=="NULL")
$sql=$sql."Collection_rcpt_no=NULL";
else
$sql=$sql."Collection_rcpt_no='".$this->Collection_rcpt_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Collection_rcpt_no=".$this->Collection_rcpt_no.", ";
}

if ($this->Old_Bank_rcpt_no!=$this->Bank_rcpt_no &&  strlen($this->Bank_rcpt_no)>0)
{
if ($this->Bank_rcpt_no=="NULL")
$sql=$sql."Bank_rcpt_no=NULL";
else
$sql=$sql."Bank_rcpt_no='".$this->Bank_rcpt_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bank_rcpt_no=".$this->Bank_rcpt_no.", ";
}

if ($this->Old_Rsl!=$this->Rsl &&  strlen($this->Rsl)>0)
{
if ($this->Rsl=="NULL")
$sql=$sql."Rsl=NULL";
else
$sql=$sql."Rsl='".$this->Rsl."'";
$i++;
$this->updateList=$this->updateList."Rsl=".$this->Rsl.", ";
}
else
$sql=$sql."Rsl=Rsl";


$cond="  where Case_id='".$this->Case_id."' and Installment='".$this->Installment."'";
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
$sql1="insert into bank_deposit(";
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

if (strlen($this->Installment)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Installment";
if ($this->Installment=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Installment."'";
$this->updateList=$this->updateList."Installment=".$this->Installment.", ";
}

if (strlen($this->Deposit_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Deposit_date";
if ($this->Deposit_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Deposit_date."'";
$this->updateList=$this->updateList."Deposit_date=".$this->Deposit_date.", ";
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

if (strlen($this->Collection_book_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Collection_book_no";
if ($this->Collection_book_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Collection_book_no."'";
$this->updateList=$this->updateList."Collection_book_no=".$this->Collection_book_no.", ";
}

if (strlen($this->Collection_rcpt_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Collection_rcpt_no";
if ($this->Collection_rcpt_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Collection_rcpt_no."'";
$this->updateList=$this->updateList."Collection_rcpt_no=".$this->Collection_rcpt_no.", ";
}

if (strlen($this->Bank_rcpt_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bank_rcpt_no";
if ($this->Bank_rcpt_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bank_rcpt_no."'";
$this->updateList=$this->updateList."Bank_rcpt_no=".$this->Bank_rcpt_no.", ";
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
$sql="select max(Case_id) from bank_deposit";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxInstallment($id)
{
$sql="select max(Installment) from bank_deposit where case_id=".$id;
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
$sql="select Case_id,Installment,Deposit_date,Amount,Collection_book_no,Collection_rcpt_no,Bank_rcpt_no,Rsl from bank_deposit where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Installment']=$row['Installment'];
$tRows[$i]['Deposit_date']=$row['Deposit_date'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Collection_book_no']=$row['Collection_book_no'];
$tRows[$i]['Collection_rcpt_no']=$row['Collection_rcpt_no'];
$tRows[$i]['Bank_rcpt_no']=$row['Bank_rcpt_no'];
$tRows[$i]['Rsl']=$row['Rsl'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Installment,Deposit_date,Amount,Collection_book_no,Collection_rcpt_no,Bank_rcpt_no,Rsl from bank_deposit where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Installment']=$row['Installment'];
$tRows[$i]['Deposit_date']=$row['Deposit_date'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Collection_book_no']=$row['Collection_book_no'];
$tRows[$i]['Collection_rcpt_no']=$row['Collection_rcpt_no'];
$tRows[$i]['Bank_rcpt_no']=$row['Bank_rcpt_no'];
$tRows[$i]['Rsl']=$row['Rsl'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function ToalPaid($id)
{
$sql="select sum(amount) from bank_deposit where  case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function LastPayDate($id)
{
$sql="select max(deposit_date) from bank_deposit where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
return(substr($row[0],0,10));
else
return("");
}

}//End Class
?>
