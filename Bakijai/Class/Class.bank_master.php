<body>
<?php
require_once '../class/class.config.php';
require_once '../class/utility.class.php';
require_once '../class/class.dbmanager.php';
require_once 'class.baki_payment.php';
class Bank_master
{
private $Bank_name;
private $Btype;

//extra Old Variable to store Pre update Data
private $Old_Bank_name;
private $Old_Btype;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Btype="Financial";
//public function _construct($i) //for PHP6
public function Bank_master()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from bank_master";
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
$sql=" select count(*) from bank_master where ".$condition;
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
$sql="select Bank_name,Btype from bank_master where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Bank_name']=$row['Bank_name'];//Primary Key-1
$tRow[$i]['Btype']=$row['Btype'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getBank_name()
{
return($this->Bank_name);
}

public function setBank_name($str)
{
$this->Bank_name=$str;
}

public function getBtype()
{
return($this->Btype);
}

public function setBtype($str)
{
$this->Btype=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Bank_name,Btype from bank_master where Bank_name='".$this->Bank_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Btype'])>0)
$this->Old_Btype=$row['Btype'];
else
$this->Old_Btype="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Bank_name,Btype from bank_master where Bank_name='".$this->Bank_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Btype=$row['Btype'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from bank_master where Bank_name='".$this->Bank_name."'";
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
$sql="update bank_master set ";
if ($this->Old_Btype!=$this->Btype &&  strlen($this->Btype)>0)
{
if ($this->Btype=="NULL")
$sql=$sql."Btype=NULL";
else
$sql=$sql."Btype='".$this->Btype."'";
$i++;
$this->updateList=$this->updateList."Btype=".$this->Btype.", ";
}
else
$sql=$sql."Btype=Btype";


$cond="  where Bank_name='".$this->Bank_name."'";
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
$sql1="insert into bank_master(";
$sql=" values (";
$mcol=0;
if (strlen($this->Bank_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bank_name";
if ($this->Bank_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bank_name."'";
$this->updateList=$this->updateList."Bank_name=".$this->Bank_name.", ";
}

if (strlen($this->Btype)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Btype";
if ($this->Btype=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Btype."'";
$this->updateList=$this->updateList."Btype=".$this->Btype.", ";
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


public function getAllRecord()
{
$tRows=array();
$sql="select Bank_name,Btype from bank_master where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Bank_name']=$row['Bank_name'];
$tRows[$i]['Btype']=$row['Btype'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Bank_name,Btype from bank_master where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Bank_name']=$row['Bank_name'];
$tRows[$i]['Btype']=$row['Btype'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function OpeningCase($yr,$mn)
{
$tot=0;
$tot1=0;
$sdate=$yr."-".$mn."-"."01";
$objDbm=new Dbmanager();
//if($yr==2014 && $mn>5)
//$cond=" and case_id<>2766";
//else
$cond=" and 1=1";


if(strlen($this->Bank_name)>0) 
{
//$objDbm=new Dbmanager();
$mcond="Bank='".$this->Bank_name."' and yr='".$yr."' and mn=".$mn;
$sql="select count(*) from bakijai_main  where bank='".$this->Bank_name."' and disposed='N'  and start_date<'".$sdate."'".$cond;
$sql1="select count(*) from bakijai_main where disposed='Y' and disposed_date>='".$sdate."' and bank='".$this->Bank_name."'".$cond;
}
else
{
//$objDbm=new Dbmanager();
//$mcond="Bank='".$this->Bank_name."' and yr='".$yr."' and mn=".$mn;
$mcond=" yr='".$yr."' and mn=".$mn;
$sql="select count(*) from bakijai_main  where  disposed='N' and start_date<'".$sdate."'".$cond;
$sql1="select count(*) from bakijai_main where disposed='Y' and disposed_date>='".$sdate."'".$cond;
}
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
$tot=$row[0];
else
$tot=0;
$result=mysql_query($sql1);
$row=mysql_fetch_array($result);
if ($row)
$tot1=$row[0];
else
$tot1=0;
//echo $sql."<br>";
//echo $sql1."<br>";
//echo $tot;
//echo "-";
//echo $tot1;
$tot=$tot+$tot1;
//if($yr>=2013)
//$tot--;    
$nn=$objDbm->Sum("adjust", "Opcase", $mcond);
$tot+=$nn;
return($tot);
} //End Opening Case

public function NewCase($yr,$mn)
{
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();

//if($yr==2014 && $mn==5)
//$cond=" and case_id<>2766";
//else
$cond=" and 1=1";

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;
if(strlen($this->Bank_name)>0) 
{
$sql="select count(*) from bakijai_main  where bank='".$this->Bank_name."'   and start_date<='".$ldate."' and start_date>='".$sdate."'".$cond;
}
//$sql="select count(*) from bakijai_main  where bank='".$this->Bank_name."' and disposed='N'  and start_date<='".$ldate."' and start_date>='".$sdate."'";
else
{
$sql="select count(*) from bakijai_main  where   start_date<='".$ldate."' and start_date>='".$sdate."'".$cond;
//$sql="select count(*) from bakijai_main  where  disposed='N'  and start_date<='".$ldate."' and start_date>='".$sdate."'";
}

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
$res=($row[0]);
else
$res=0;


return($res);
} //End newcase

public function AmountForNewCase($yr,$mn)
{
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;
if(strlen($this->Bank_name)>0) 
$sql="select sum(amount) from bakijai_main  where bank='".$this->Bank_name."' and  start_date<='".$ldate."' and start_date>='".$sdate."'";
else
$sql="select sum(amount) from bakijai_main  where   start_date<='".$ldate."' and start_date>='".$sdate."'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return("0");
} //End newcase


public function Disposed($yr,$mn)
{
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;
if(strlen($this->Bank_name)>0) 
$sql="select count(*) from bakijai_main  where bank='".$this->Bank_name."' and disposed='Y' and payment_mode<>'OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";
else
$sql="select count(*) from bakijai_main  where disposed='Y' and payment_mode<>'OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
return($row[0]);
else
return("0");
} //End newcase

public function DropedByOTS($yr,$mn)
{
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;
if(strlen($this->Bank_name)>0) 
$sql="select count(*) from bakijai_main  where bank='".$this->Bank_name."' and disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";
else 
$sql="select count(*) from bakijai_main  where  disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
return($row[0]);
else
return("0");
} //End newcase


public function Balance($yr,$mn)
{
$objBp=new Baki_payment();
$sdate=$yr."-".$mn."-"."01";
//if($yr==2014 && $mn>4)
//$cond=" and case_id<>2766";
//else
$cond=" and 1=1";
$objDbm=new Dbmanager();
if(strlen($this->Bank_name)>0) 
{    
//$objDbm=new Dbmanager();
$mcond="Bank='".$this->Bank_name."' and yr='".$yr."' and mn=".$mn;
//$mcond=" yr='".$yr."' and mn=".$mn;
//$sql="select case_id from bakijai_main  where bank='".$this->Bank_name."' and disposed='N'  and start_date<'".$sdate."'";
//$sql1="select case_id from bakijai_main where disposed='Y' and disposed_date>='".$sdate."' and bank='".$this->Bank_name."'";
//$sql1="select case_id from bakijai_main where disposed='Y' and disposed_date>='".$sdate."' and bank='".$this->Bank_name."'";
$Msql="select case_id from bakijai_main  where bank='".$this->Bank_name."'  and start_date<'".$sdate."'".$cond;
$Msql1="select case_id from bakijai_main where disposed='Y' and disposed_date<'".$sdate."' and bank='".$this->Bank_name."'".$cond;
}
else 
{  
$mcond=" yr='".$yr."' and mn=".$mn;  
$Msql="select case_id from bakijai_main  where  start_date<'".$sdate."'".$cond;
$Msql1="select case_id from bakijai_main where disposed='Y' and disposed_date<'".$sdate."'".$cond;
}
//echo $sql;
$amt=0;
$result=mysql_query($Msql);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$objBp->LastBalanceBeforeDate($id, $yr, $mn); 
//if($this->Bank_name=="AFC")
//echo $id."-".$bal."<br>";
$amt=$amt+$bal;   
}//while

//Disposed after
$result=mysql_query($Msql1);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$objBp->LastBalanceBeforeDate($id, $yr, $mn); 
//if($this->Bank_name=="AFC")
//echo $id."-".$bal."<br>";
$amt=$amt-$bal;   
}//while

//$result=mysql_query($sql1);
//OTS due from the case for period befor date
//$bal=0;

$bal=$objDbm->Sum("adjust", "amt", $mcond);
//$bal=0;
//while ($row=mysql_fetch_array($result))
//{
//$id=$row[0];
//$bal=$bal+$this->Otsdue($id);
//}//while
return($amt+$bal);
} //End Opening Case



public function Balance_OLD($yr,$mn)
{
$objBp=new Baki_payment();
$sdate=$yr."-".$mn."-"."01";
if(strlen($this->Bank_name)>0) 
{    
$sql="select case_id from bakijai_main  where bank='".$this->Bank_name."' and disposed='N'  and start_date<'".$sdate."'";
$sql1="select case_id,payment_mode from bakijai_main where disposed='Y' and disposed_date>='".$sdate."' and bank='".$this->Bank_name."'";
$sql2="select case_id from bakijai_main where disposed='Y' and payment_mode='OTS' and disposed_date<'".$sdate."' and bank='".$this->Bank_name."' and disposed_date>='2013-04-01'";
$sql3="select case_id from bakijai_main where disposed='Y' and payment_mode='OTS' and disposed_date>='".$sdate."' and bank='".$this->Bank_name."'";



}
else 
{    
$sql="select case_id from bakijai_main  where disposed='N'  and start_date<'".$sdate."'";
$sql1="select case_id,payment_mode from bakijai_main where disposed='Y' and disposed_date>='".$sdate."'";
$sql2="select case_id from bakijai_main where disposed='Y' and payment_mode='OTS' and disposed_date<'".$sdate."' and disposed_date>='2013-04-01'";
$sql3="select case_id from bakijai_main where disposed='Y' and payment_mode='OTS' and disposed_date>='".$sdate."'";
}
//echo $sql;
$amt=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$objBp->LastBalanceBeforeDate($id, $yr, $mn); 
//if($this->Bank_name=="AFC")
//echo $id."-".$bal."<br>";
$amt=$amt+$bal;   
}//while
//handle disposed case
$result=mysql_query($sql1);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$objBp->LastPaidFromDate ($id, $sdate); 
$amt=$amt+$bal;   
}//while
//handle OTS disposed case upto previous month
$result=mysql_query($sql2);
//echo $yr."-".$mn.":Rs.".$amt." ";
$mn=$mn-1;
if ($mn==0)
{
$mn=12;
$yr=$yr-1;
}  
$bal=0;
//OTS due from the case for period befor date
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$bal+$this->Otsdue($id);
}//while

//OTS due from the case after period befor date
$result=mysql_query($sql3);
$bal1=0;
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal1=$bal1+$this->Otsdue($id);
}//while

return($amt+$bal1-$bal);


} //End Opening Case


public function OtsDue($id)
{
$objBp=new Baki_payment();

$objU=new Utility();


$sql="select amount from bakijai_main  where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$amt=$row[0]-$objBp->ToalPaid($id);
}
//
return($amt);
} //OTS Balance





public function OtsBalance($yr,$mn)
{
$objBp=new Baki_payment();
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;

//
if(strlen($this->Bank_name)>0) 
$sql="select case_id,amount from bakijai_main  where bank='".$this->Bank_name."' and disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";
else
$sql="select case_id,amount from bakijai_main  where  disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";

$amt=0;
$paid=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$amt=$amt+$row[1];
$paid=$paid+$objBp->LastPaidBeforeDate($id, $ldate);
}
//
if(strlen($this->Bank_name)>0) 
$sql="select sum(amount) from bakijai_main  where bank='".$this->Bank_name."' and disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";
else
$sql="select sum(amount) from bakijai_main  where  disposed='Y' and payment_mode='OTS'  and disposed_date<='".$ldate."' and disposed_date>='".$sdate."'";
  
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0]>0))
$amt=$row[0];
else
$amt=0;

return($amt-$paid);
} //OTS Balance



public function AmountCollected($yr,$mn)
{
$fdate=$yr."-".$mn."-"."01";
$objU=new Utility();

$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;    
if(strlen($this->Bank_name)>0)    
$sql="select case_id from bakijai_main  where bank='".$this->Bank_name."'";
else
$sql="select case_id from bakijai_main  ";

//echo $sql;
$amt=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$id=$row[0];
$bal=$this->CollectedPerID($id, $fdate, $ldate);
$amt=$amt+$bal;   
}//while
return($amt);
} //End Opening Case


public function CollectedPerID($id,$fdate,$ldate)
{

$sql="select sum(paid_today) from baki_payment where payment_mode<>'OTS' and case_id=".$id." and pay_date<='".$ldate."' and pay_date>='".$fdate."'";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//echo " ".$row[0]."<br>";
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}


public function getSelectedRecord($yr,$mn)
{
$tRows=array();
$sql="select Bank_name from bank_master order by bank_name";
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$this->setBank_name($row['Bank_name']);
$temp=$this->OpeningCase($yr, $mn) +$this->NewCase($yr, $mn) + $this->AmountCollected($yr, $mn)+ $this->Disposed($yr, $mn);
//echo $row['Bank_name'].$temp."  ";    
if ($temp>0)
{
$tRows[$i]=$row['Bank_name'];
$i++;
//echo $row['Bank_name']."<br>";
}
//else
//echo "No<br>";
} //End While
return($tRows);
} //End getAllRecord


public function MonthlyCollection($bank,$yr,$mn)
{
$tRows=array();
$objBp=new Baki_payment();
$sdate=$yr."-".$mn."-"."01";
$objU=new Utility();
$mn=round($mn);
$dd=$objU->mDays[$mn];
$ldate=$yr."-".$mn."-".$dd;

$sql="select Case_Id,Pay_date,Paid_today,Payment_mode,Receipt_no from baki_payment  where payment_mode<>'OTS' and pay_date<='".$ldate."' and pay_date>='".$sdate."'";
$sql=$sql." and Case_id in(select Case_id from bakijai_main where bank='".$bank."') order by Pay_date,Case_Id";
$i=0;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_Id'];
$tRows[$i]['Pay_date']=$row['Pay_date'];
$tRows[$i]['Paid_today']=$row['Paid_today'];
$tRows[$i]['Payment_mode']=$row['Payment_mode'];
$tRows[$i]['Receipt_no']=$row['Receipt_no'];
$i++;
}
$this->returnSql=$sql;
return($tRows);
} //Monthly Collection



}//End Class
?>
