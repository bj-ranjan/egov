<body>
<?//php include("connection.php"); ?>
<?php
session_start();

require_once '../class/utility.class.php';
require_once './class/class.dak.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();

unset($_SESSION['lastid']);
$objDak=new Dak_entry();


if ($_SESSION['update']==1)
$a_Dak_id=$_POST['Dak_id'];
else
{
$a_Dak_id=$objDak->maxDak_id();
$_SESSION['lastid']=$a_Dak_id;
//echo $_SESSION['lastid'];
}




$mvalue[0]=$a_Dak_id;



if (!is_numeric($a_Dak_id))
$myTag++;




$b_Subject=$_POST['Subject'];
$mvalue[1]=$b_Subject;
if ($objUtility->SimpleValidate($b_Subject,200)==true)
{
if (strlen($b_Subject)==0)
{
$b_Subject="NULL";
}
}
else
{
$myTag++;
echo "subject=".$b_Subject." length=".strlen($b_Subject);
}

$c_Recvd_from=$_POST['Recvd_from'];
$mvalue[2]=$c_Recvd_from;
if ($objUtility->validate($c_Recvd_from,200)==true)
{
if (strlen($c_Recvd_from)==0)
{
$c_Recvd_from="NULL";
}
}
else
{
$myTag++;
echo "recvd from";
}

$d_Ltr_no=$_POST['Ltr_no'];
$mvalue[3]=$d_Ltr_no;
if ($objUtility->validate($d_Ltr_no,200)==true)
{
if (strlen($d_Ltr_no)==0)
{
$d_Ltr_no="NULL";
}
}
else
{
$myTag++;
echo "Ltr no";
}

//echo $_POST['Ltr_dt']."<br>";
$e_Ltr_dt=$_POST['Ltr_dt'];
$mvalue[4]=$e_Ltr_dt;
if($objUtility->isdate($e_Ltr_dt))
$e_Ltr_dt=$objUtility->to_mysqldate($e_Ltr_dt);
else
$e_Ltr_dt="NULL";


//$objUtility->to_mysqldate($n_Target_date)

$f_Ltr_format=$_POST['Ltr_format'];
$mvalue[5]=$f_Ltr_format;
if ($objUtility->validate($f_Ltr_format,70)==true)
{
if (strlen($f_Ltr_format)==0)
{
$f_Ltr_format="NULL";
}
}
else
{
$myTag++;
echo "Ltr format";
}

$g_Priority=$_POST['Priority'];
$mvalue[6]=$g_Priority;
if ($objUtility->validate($g_Priority,200)==true)
{
if (strlen($g_Priority)==0)
{
$g_Priority="NULL";
}
}
else
{
$myTag++;
echo "priority";
}

$h_Mark_branch=$_POST['Mark_branch'];
$mvalue[7]=$h_Mark_branch;
if ($objUtility->validate($h_Mark_branch,200)==true)
{
if (strlen($h_Mark_branch)==0)
{
$h_Mark_branch="NULL";
}
}
else
{
$myTag++;
echo "mark branch";
}

$reply="Yes";
$today=date('Y-m-d');


$n_Target_date="NULL";
if($g_Priority==1) //Immidiate
$n_Target_date=$objUtility->datePlus($today,1);
if($g_Priority==2) //urgent
$n_Target_date=$objUtility->datePlus($today,2);

if($g_Priority==3) //Fix Date
{
if(isset($_POST['Target_date']))
{
$n_Target_date=$_POST['Target_date'];
$n_Target_date=$objUtility->to_mysqldate($n_Target_date);
}
else
$objUtility->AlertNRedirect("Enter Target Date","dakentry.php");
}//$g_Priority==3

if($g_Priority==4) //other
$n_Target_date=$objUtility->datePlus($today,6);

if($g_Priority==5) //File Only
{
$reply="No";
$n_Target_date="NULL";
}

$mvalue[10]=$n_Target_date;

if ($objUtility->validate($n_Target_date,10)==true)
{
if (strlen($n_Target_date)==0)
{
$n_Target_date="NULL";
}
}
else
{
$myTag++;
echo "target date";
}

if(isset($_POST['Recv_yr']))
$Recvd_yr=$_POST['Recv_yr'];
else
 $Recvd_yr=   date("Y");



$mvalue[11]=$Recvd_yr;
if (!is_numeric($Recvd_yr))
$myTag++;

$mmode="";



if(isset($_POST['Branch_code']))
$Branch_code=$_POST['Branch_code'];
else
$Branch_code=0;    

if(isset($_POST['Remarks']))
$rem=$_POST['Remarks'];
else
$rem="-";


if ($myTag==0)
{
$objDak->setDak_id($a_Dak_id);
$objDak->setRecvd_yr($Recvd_yr);
$objDak->setSubject($b_Subject);
$objDak->setRecvd_from($c_Recvd_from);
$objDak->setLtr_no($d_Ltr_no);
$objDak->setLtr_dt($e_Ltr_dt);
$objDak->setLtr_format($f_Ltr_format);
$objDak->setPriority($g_Priority);
$objDak->setRemarks($rem);
$objDak->setMark_branch($h_Mark_branch);
if ($_SESSION['update']==0)
$objDak->setEntry_date(date('Y-m-d'));
$objDak->setTarget_date($n_Target_date);
$objDak->setReply($reply);
$objDak->setBranch_code($Branch_code);
if ($_SESSION['update']==0)
{
$result=$objDak->SaveRecord();
$mmode="Saved Dak Id-".$a_Dak_id;
$sql=$objDak->returnSql;
}
else
{
$result=$objDak->UpdateRecord();
$mmode="Updated Record";
$sql=$objDak->returnSql;
}
$_SESSION['msg']=$mmode;
if (!$result)
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Sql Error)<br>".$sql;
echo $sql;
$mmode="SQL Commit Error";
}
else
{
//Clear the Required Field back to Entry Form
$mvalue[0]="";
$mvalue[1]="";
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]="";
$mvalue[5]="";
$mvalue[6]="";
$mvalue[7]="";
//$mvalue[8]="";
$mvalue[9]="";
$mvalue[10]="";
$mvalue[11]="";

//echo $sql;

//Succesfully update hence make an entry in sql log
//$objUtility->saveSqlLog("Dak",$sql);
$objUtility->CreateLogFile("Dak", $sql, 2, "D");
 
$objUtility->Backup2Access("", $sql);
$_SESSION['update']=0;
$_SESSION['mvalue']=$mvalue;
} //$result
} 
else//$myTag==0
{
$_SESSION['mvalue']=$mvalue;
$_SESSION['msg']="Failed to Update(Data Type Error)<br>";
$mmode="Data Type Error";
}

echo $objUtility->AlertNRedirect($mmode,"dakentry.php?tag=1");

//header( 'Location: dakentry.php?tag=1');
//header( 'Location: dakentry.php?tag=1'); when it keep the form without count
?>
</body>
</html>
