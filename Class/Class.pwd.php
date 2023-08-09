
<?php
require_once 'class.config.php';
class Pwd
{
private $Uid;
private $Pwd;
private $Roll;
private $Fullname;
private $Branch_code;
private $Active;
private $Firstlogin;
private $Area;
//extra Old Variable to store Pre update Data
private $Old_Uid;
private $Old_Pwd;
private $Old_Roll;
private $Old_Fullname;
private $Old_Branch_code;
private $Old_Active;
private $Old_Firstlogin;
private $Old_Area;
public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Branch_code="0";
private $Def_Active="Y";
private $Def_Firstlogin="Y";
//public function _construct($i) //for PHP6
public function Pwd()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from pwd";
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
$sql=" select count(*) from pwd where ".$condition;
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
$sql="select Uid,Pwd,Fullname from pwd where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Uid']=$row['Uid'];//Primary Key-1
$tRow[$i]['Pwd']=$row['Pwd'];//Posible Unique Field
$tRow[$i]['Fullname']=$row['Fullname'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getUid()
{
return($this->Uid);
}

public function setUid($str)
{
$this->Uid=$str;
}

public function getPwd()
{
return($this->Pwd);
}

public function setPwd($str)
{
$this->Pwd=$str;
}

public function getRoll()
{
return($this->Roll);
}

public function setRoll($str)
{
$this->Roll=$str;
}

public function getFullname()
{
return($this->Fullname);
}

public function setFullname($str)
{
$this->Fullname=$str;
}

public function getBranch_code()
{
return($this->Branch_code);
}

public function setBranch_code($str)
{
$this->Branch_code=$str;
}

public function getActive()
{
return($this->Active);
}

public function setActive($str)
{
$this->Active=$str;
}

public function getFirstlogin()
{
return($this->Firstlogin);
}

public function getFirst_login() 
{
return($this->Firstlogin);
}

public function setFirstlogin($str)
{
$this->Firstlogin=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}

public function getArea()
{
return($this->Area);
}

public function setArea($str)
{
$this->Area=$str;
}



private function copyVariable()
{
$sql="select Uid,Pwd,Roll,Fullname,Branch_code,Active,Firstlogin,Area from pwd where Uid='".$this->Uid."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Pwd'])>0)
$this->Old_Pwd=$row['Pwd'];
else
$this->Old_Pwd="NULL";
if (strlen($row['Roll'])>0)
$this->Old_Roll=$row['Roll'];
else
$this->Old_Roll="NULL";
if (strlen($row['Fullname'])>0)
$this->Old_Fullname=$row['Fullname'];
else
$this->Old_Fullname="NULL";
if (strlen($row['Branch_code'])>0)
$this->Old_Branch_code=$row['Branch_code'];
else
$this->Old_Branch_code="NULL";
if (strlen($row['Active'])>0)
$this->Old_Active=$row['Active'];
else
$this->Old_Active="NULL";
if (strlen($row['Firstlogin'])>0)
$this->Old_Firstlogin=$row['Firstlogin'];
else
$this->Old_Firstlogin="NULL";

if (strlen($row['Area'])>0)
$this->Old_Area=$row['Area'];
else
$this->Old_Area="NULL";

return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Uid,Pwd,Roll,Fullname,Branch_code,Active,Firstlogin,Area from pwd where Uid='".$this->Uid."'";

$result=mysql_query($sql);
if($result)
{
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Pwd=$row['Pwd'];
$this->Roll=$row['Roll'];
$this->Fullname=$row['Fullname'];
$this->Branch_code=$row['Branch_code'];
$this->Active=$row['Active'];
$this->Firstlogin=$row['Firstlogin'];
$this->Area=$row['Area'];
}
else
$this->Available=false;
}
else
echo $sql;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from pwd where Uid='".$this->Uid."'";
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
$sql="update pwd set ";
if ($this->Old_Pwd!=$this->Pwd &&  strlen($this->Pwd)>0)
{
if ($this->Pwd=="NULL")
$sql=$sql."Pwd=NULL";
else
$sql=$sql."Pwd='".$this->Pwd."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pwd=".$this->Pwd.", ";
}

if ($this->Old_Roll!=$this->Roll &&  strlen($this->Roll)>0)
{
if ($this->Roll=="NULL")
$sql=$sql."Roll=NULL";
else
$sql=$sql."Roll='".$this->Roll."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Roll=".$this->Roll.", ";
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


if ($this->Old_Area!=$this->Area &&  strlen($this->Area)>0)
{
if ($this->Area=="NULL")
$sql=$sql."Area=NULL";
else
$sql=$sql."Area='".$this->Area."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Area=".$this->Area.", ";
}
//o

if ($this->Old_Branch_code!=$this->Branch_code &&  strlen($this->Branch_code)>0)
{
if ($this->Branch_code=="NULL")
$sql=$sql."Branch_code=NULL";
else
$sql=$sql."Branch_code='".$this->Branch_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}

if ($this->Old_Active!=$this->Active &&  strlen($this->Active)>0)
{
if ($this->Active=="NULL")
$sql=$sql."Active=NULL";
else
$sql=$sql."Active='".$this->Active."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Active=".$this->Active.", ";
}

if ($this->Old_Firstlogin!=$this->Firstlogin &&  strlen($this->Firstlogin)>0)
{
if ($this->Firstlogin=="NULL")
$sql=$sql."Firstlogin=NULL";
else
$sql=$sql."Firstlogin='".$this->Firstlogin."'";
$i++;
$this->updateList=$this->updateList."Firstlogin=".$this->Firstlogin.", ";
}
else
$sql=$sql."Firstlogin=Firstlogin";


$cond="  where Uid='".$this->Uid."'";
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
$sql1="insert into pwd(";
$sql=" values (";
$mcol=0;
if (strlen($this->Uid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Uid";
if ($this->Uid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Uid."'";
$this->updateList=$this->updateList."Uid=".$this->Uid.", ";
}

if (strlen($this->Pwd)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pwd";
if ($this->Pwd=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pwd."'";
$this->updateList=$this->updateList."Pwd=".$this->Pwd.", ";
}

if (strlen($this->Roll)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Roll";
if ($this->Roll=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Roll."'";
$this->updateList=$this->updateList."Roll=".$this->Roll.", ";
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

if (strlen($this->Branch_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch_code";
if ($this->Branch_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch_code."'";
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}

if (strlen($this->Active)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Active";
if ($this->Active=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Active."'";
$this->updateList=$this->updateList."Active=".$this->Active.", ";
}

if (strlen($this->Area)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Area";
if ($this->Area=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Area."'";
$this->updateList=$this->updateList."Area=".$this->Area.", ";
}

if (strlen($this->Firstlogin)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Firstlogin";
if ($this->Firstlogin=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Firstlogin."'";
$this->updateList=$this->updateList."Firstlogin=".$this->Firstlogin.", ";
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
$sql="select Uid,Pwd,Roll,Fullname,Branch_code,Active,Firstlogin,Area from pwd where ".$this->condString;
$i=0;
//echo $sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Uid']=$row['Uid'];
$tRows[$i]['Pwd']=$row['Pwd'];
$tRows[$i]['Roll']=$row['Roll'];
$tRows[$i]['Fullname']=$row['Fullname'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Active']=$row['Active'];
$tRows[$i]['Firstlogin']=$row['Firstlogin'];
$tRows[$i]['Area']=$row['Area'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function checkArea($mystring,$code)
{
$myrow=array();
$found=false;
$myrow=explode(",",$mystring);
for ($i=0;$i<count($myrow);$i++)
{
//echo $myrow[$i]."=".$code."<br>";    
if (isset($myrow[$i]))  
{
if($myrow[$i]==$code)  
$found=true;     
}    
//echo $found;
} //for loop
return($found);
} 


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Uid,Pwd,Roll,Fullname,Branch_code,Active,Firstlogin,Area from pwd where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Uid']=$row['Uid'];
$tRows[$i]['Pwd']=$row['Pwd'];
$tRows[$i]['Roll']=$row['Roll'];
$tRows[$i]['Fullname']=$row['Fullname'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Active']=$row['Active'];
$tRows[$i]['Firstlogin']=$row['Firstlogin'];
$tRows[$i]['Area']=$row['Area'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
