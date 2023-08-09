<body>
<?php
require_once 'class.xconfig.php';
class User
{
private $Id;
private $Username;
private $Officer_id;
private $Password;
private $Password1;
private $Password2;
private $Password3;
private $Office_id;
private $Ip;
private $User_type;
private $Fullname;
private $Designation;
private $Ass_officer_id;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Username;
private $Old_Officer_id;
private $Old_Password;
private $Old_Password1;
private $Old_Password2;
private $Old_Password3;
private $Old_Office_id;
private $Old_Ip;
private $Old_User_type;
private $Old_Fullname;
private $Old_Designation;
private $Old_Ass_officer_id;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function User()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from user";
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
$sql=" select count(*) from user where ".$condition;
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
$sql="select Id,Username,Username from user where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Id']=$row['Id'];//Primary Key-1
$tRow[$i]['Username']=$row['Username'];//Primary Key-2
$tRow[$i]['Username']=$row['Username'];//Posible Unique Field
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

public function getUsername()
{
return($this->Username);
}

public function setUsername($str)
{
$this->Username=$str;
}

public function getOfficer_id()
{
return($this->Officer_id);
}

public function setOfficer_id($str)
{
$this->Officer_id=$str;
}

public function getPassword()
{
return($this->Password);
}

public function setPassword($str)
{
$this->Password=$str;
}

public function getPassword1()
{
return($this->Password1);
}

public function setPassword1($str)
{
$this->Password1=$str;
}

public function getPassword2()
{
return($this->Password2);
}

public function setPassword2($str)
{
$this->Password2=$str;
}

public function getPassword3()
{
return($this->Password3);
}

public function setPassword3($str)
{
$this->Password3=$str;
}

public function getOffice_id()
{
return($this->Office_id);
}

public function setOffice_id($str)
{
$this->Office_id=$str;
}

public function getIp()
{
return($this->Ip);
}

public function setIp($str)
{
$this->Ip=$str;
}

public function getUser_type()
{
return($this->User_type);
}

public function setUser_type($str)
{
$this->User_type=$str;
}

public function getFullname()
{
return($this->Fullname);
}

public function setFullname($str)
{
$this->Fullname=$str;
}

public function getDesignation()
{
return($this->Designation);
}

public function setDesignation($str)
{
$this->Designation=$str;
}

public function getAss_officer_id()
{
return($this->Ass_officer_id);
}

public function setAss_officer_id($str)
{
$this->Ass_officer_id=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Username,Officer_id,Password,Password1,Password2,Password3,Office_id,Ip,User_type,Fullname,Designation,Ass_officer_id from user where Id='".$this->Id."' and Username='".$this->Username."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Officer_id'])>0)
$this->Old_Officer_id=$row['Officer_id'];
else
$this->Old_Officer_id="NULL";
if (strlen($row['Password'])>0)
$this->Old_Password=$row['Password'];
else
$this->Old_Password="NULL";
if (strlen($row['Password1'])>0)
$this->Old_Password1=$row['Password1'];
else
$this->Old_Password1="NULL";
if (strlen($row['Password2'])>0)
$this->Old_Password2=$row['Password2'];
else
$this->Old_Password2="NULL";
if (strlen($row['Password3'])>0)
$this->Old_Password3=$row['Password3'];
else
$this->Old_Password3="NULL";
if (strlen($row['Office_id'])>0)
$this->Old_Office_id=$row['Office_id'];
else
$this->Old_Office_id="NULL";
if (strlen($row['Ip'])>0)
$this->Old_Ip=$row['Ip'];
else
$this->Old_Ip="NULL";
if (strlen($row['User_type'])>0)
$this->Old_User_type=$row['User_type'];
else
$this->Old_User_type="NULL";
if (strlen($row['Fullname'])>0)
$this->Old_Fullname=$row['Fullname'];
else
$this->Old_Fullname="NULL";
if (strlen($row['Designation'])>0)
$this->Old_Designation=$row['Designation'];
else
$this->Old_Designation="NULL";
if (strlen($row['Ass_officer_id'])>0)
$this->Old_Ass_officer_id=$row['Ass_officer_id'];
else
$this->Old_Ass_officer_id="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Username,Officer_id,Password,Password1,Password2,Password3,Office_id,Ip,User_type,Fullname,Designation,Ass_officer_id from user where Id='".$this->Id."' and Username='".$this->Username."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Officer_id=$row['Officer_id'];
$this->Password=$row['Password'];
$this->Password1=$row['Password1'];
$this->Password2=$row['Password2'];
$this->Password3=$row['Password3'];
$this->Office_id=$row['Office_id'];
$this->Ip=$row['Ip'];
$this->User_type=$row['User_type'];
$this->Fullname=$row['Fullname'];
$this->Designation=$row['Designation'];
$this->Ass_officer_id=$row['Ass_officer_id'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from user where Id='".$this->Id."' and Username='".$this->Username."'";
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
$sql="delete from user where Id='".$this->Id."' and Username='".$this->Username."'";
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
$sql="update user set ";
if ($this->Old_Officer_id!=$this->Officer_id &&  strlen($this->Officer_id)>0)
{
if ($this->Officer_id=="NULL")
$sql=$sql."Officer_id=NULL";
else
$sql=$sql."Officer_id='".$this->Officer_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Officer_id=".$this->Officer_id.", ";
}

if ($this->Old_Password!=$this->Password &&  strlen($this->Password)>0)
{
if ($this->Password=="NULL")
$sql=$sql."Password=NULL";
else
$sql=$sql."Password='".$this->Password."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Password=".$this->Password.", ";
}

if ($this->Old_Password1!=$this->Password1 &&  strlen($this->Password1)>0)
{
if ($this->Password1=="NULL")
$sql=$sql."Password1=NULL";
else
$sql=$sql."Password1='".$this->Password1."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Password1=".$this->Password1.", ";
}

if ($this->Old_Password2!=$this->Password2 &&  strlen($this->Password2)>0)
{
if ($this->Password2=="NULL")
$sql=$sql."Password2=NULL";
else
$sql=$sql."Password2='".$this->Password2."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Password2=".$this->Password2.", ";
}

if ($this->Old_Password3!=$this->Password3 &&  strlen($this->Password3)>0)
{
if ($this->Password3=="NULL")
$sql=$sql."Password3=NULL";
else
$sql=$sql."Password3='".$this->Password3."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Password3=".$this->Password3.", ";
}

if ($this->Old_Office_id!=$this->Office_id &&  strlen($this->Office_id)>0)
{
if ($this->Office_id=="NULL")
$sql=$sql."Office_id=NULL";
else
$sql=$sql."Office_id='".$this->Office_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
}

if ($this->Old_Ip!=$this->Ip &&  strlen($this->Ip)>0)
{
if ($this->Ip=="NULL")
$sql=$sql."Ip=NULL";
else
$sql=$sql."Ip='".$this->Ip."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ip=".$this->Ip.", ";
}

if ($this->Old_User_type!=$this->User_type &&  strlen($this->User_type)>0)
{
if ($this->User_type=="NULL")
$sql=$sql."User_type=NULL";
else
$sql=$sql."User_type='".$this->User_type."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."User_type=".$this->User_type.", ";
}

if ($this->Old_Fullname!=$this->Fullname &&  strlen($this->Fullname)>0)
{
if ($this->Fullname=="NULL")
$sql=$sql."Fullname=NULL";
else
$sql=$sql."Fullname='".$this->Fullname."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Fullname=".$this->Fullname.", ";
}

if ($this->Old_Designation!=$this->Designation &&  strlen($this->Designation)>0)
{
if ($this->Designation=="NULL")
$sql=$sql."Designation=NULL";
else
$sql=$sql."Designation='".$this->Designation."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Designation=".$this->Designation.", ";
}

if ($this->Old_Ass_officer_id!=$this->Ass_officer_id &&  strlen($this->Ass_officer_id)>0)
{
if ($this->Ass_officer_id=="NULL")
$sql=$sql."Ass_officer_id=NULL";
else
$sql=$sql."Ass_officer_id='".$this->Ass_officer_id."'";
$i++;
$this->updateList=$this->updateList."Ass_officer_id=".$this->Ass_officer_id.", ";
}
else
$sql=$sql."Ass_officer_id=Ass_officer_id";


$cond="  where Id='".$this->Id."' and Username='".$this->Username."'";
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
$sql1="insert into user(";
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

if (strlen($this->Username)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Username";
if ($this->Username=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Username."'";
$this->updateList=$this->updateList."Username=".$this->Username.", ";
}

if (strlen($this->Officer_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Officer_id";
if ($this->Officer_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Officer_id."'";
$this->updateList=$this->updateList."Officer_id=".$this->Officer_id.", ";
}

if (strlen($this->Password)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Password";
if ($this->Password=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Password."'";
$this->updateList=$this->updateList."Password=".$this->Password.", ";
}

if (strlen($this->Password1)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Password1";
if ($this->Password1=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Password1."'";
$this->updateList=$this->updateList."Password1=".$this->Password1.", ";
}

if (strlen($this->Password2)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Password2";
if ($this->Password2=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Password2."'";
$this->updateList=$this->updateList."Password2=".$this->Password2.", ";
}

if (strlen($this->Password3)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Password3";
if ($this->Password3=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Password3."'";
$this->updateList=$this->updateList."Password3=".$this->Password3.", ";
}

if (strlen($this->Office_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Office_id";
if ($this->Office_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Office_id."'";
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
}

if (strlen($this->Ip)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ip";
if ($this->Ip=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ip."'";
$this->updateList=$this->updateList."Ip=".$this->Ip.", ";
}

if (strlen($this->User_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."User_type";
if ($this->User_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->User_type."'";
$this->updateList=$this->updateList."User_type=".$this->User_type.", ";
}

if (strlen($this->Fullname)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Fullname";
if ($this->Fullname=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Fullname."'";
$this->updateList=$this->updateList."Fullname=".$this->Fullname.", ";
}

if (strlen($this->Designation)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Designation";
if ($this->Designation=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Designation."'";
$this->updateList=$this->updateList."Designation=".$this->Designation.", ";
}

if (strlen($this->Ass_officer_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ass_officer_id";
if ($this->Ass_officer_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ass_officer_id."'";
$this->updateList=$this->updateList."Ass_officer_id=".$this->Ass_officer_id.", ";
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
$sql="select max(Id) from user";
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
$sql="select Id,Username,Officer_id,Password,Password1,Password2,Password3,Office_id,Ip,User_type,Fullname,Designation,Ass_officer_id from user where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Username']=$row['Username'];
$tRows[$i]['Officer_id']=$row['Officer_id'];
$tRows[$i]['Password']=$row['Password'];
$tRows[$i]['Password1']=$row['Password1'];
$tRows[$i]['Password2']=$row['Password2'];
$tRows[$i]['Password3']=$row['Password3'];
$tRows[$i]['Office_id']=$row['Office_id'];
$tRows[$i]['Ip']=$row['Ip'];
$tRows[$i]['User_type']=$row['User_type'];
$tRows[$i]['Fullname']=$row['Fullname'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Ass_officer_id']=$row['Ass_officer_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Username,Officer_id,Password,Password1,Password2,Password3,Office_id,Ip,User_type,Fullname,Designation,Ass_officer_id from user where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Username']=$row['Username'];
$tRows[$i]['Officer_id']=$row['Officer_id'];
$tRows[$i]['Password']=$row['Password'];
$tRows[$i]['Password1']=$row['Password1'];
$tRows[$i]['Password2']=$row['Password2'];
$tRows[$i]['Password3']=$row['Password3'];
$tRows[$i]['Office_id']=$row['Office_id'];
$tRows[$i]['Ip']=$row['Ip'];
$tRows[$i]['User_type']=$row['User_type'];
$tRows[$i]['Fullname']=$row['Fullname'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Ass_officer_id']=$row['Ass_officer_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
