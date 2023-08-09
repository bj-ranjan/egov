<html>
<title></title>
</head>
<script type="text/javascript" src="../validation.js"></script>

<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>

<script language=javascript>
<!--

function summ()
{
var data="date1="+document.getElementById('days').value;
data=data+"&date2="+document.getElementById('days1').value
MyAjaxFunction("POST","summary.php",data,'DivSum',"HTML");
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate()
{
var a=myform.days.value ;// Primary Key
var b=myform.days1.value ;// Primary Key

if (isdate(a,1)==true && isdate(b,1)==true)
{
myform.action="DailyCollection.php?tag=2";
myform.submit();
}
else
alert('Invalid Date');
}


</script>
<body>


       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';
require_once '../class/class.sentence.php';
require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once 'header.php';
$objSen=new Sentence();
$objUtility=new Utility();
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;
$fees=0;
$type="";
$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');


$objUtil=new myutility();
$gross=0;
$bal=0;
//echo "01/".date('/m/Y');

if (!isset($_SESSION['mdate']))
$_SESSION['mdate']=date('d/m/Y');


if (!isset($_SESSION['mdate1']))
$_SESSION['mdate1']=date('d/m/Y');


///echo $_SESSION['mdate'];

if ($_tag==2)
{
if (isset($_POST['days']))
$_SESSION['mdate']=$_POST['days'] ; 
else
$_SESSION['mdate']=date('d/m/Y');  

if (isset($_POST['days1']))
$_SESSION['mdate1']=$_POST['days1'] ; 
else
$_SESSION['mdate1']=date('d/m/Y');

if (isset($_POST['catg']))
$type=$_POST['catg'];
else 
$type="0";    
}
?>
<form name="myform" method="post"> 
<font color="blue" size="2" face="arial">  
<p align="center">
Collection from 
<input type="text" size="12" name="days" id="days" value="<?php echo $_SESSION['mdate']?>" maxlength="10">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(days);" alt="Click Here to Pick Date">
to
<input type="text" size="12" name="days1" id="days1" value="<?php echo $_SESSION['mdate1']?>" maxlength="10">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(days1);" alt="Click Here to Pick Date">

<select name="catg" style="width:120px;">
<option value="0">ALL Category
<?php
$objPt=new Petition_type();
$objPt->setCondString(" Running='Y'");
$row=$objPt->getRow();
for($i=0;$i<count($row);$i++)
{
if ($type==$row[$i]['Code']) 
{
?>    
<option selected value="<?php echo $row[$i]['Code'];?>"><?php echo $row[$i]['Abvr'];?> 
<?php
}
else
{
?>
<option  value="<?php echo $row[$i]['Code'];?>"><?php echo $row[$i]['Abvr'];?> 
<?php    
}
}//for loop
?>
</select>
<input type="button" value="Summary" onclick="summ()" style="font-family:arial;font-weight:bold; font-size: 12px ; background-color:#FF9966;color:black;width:70px">
<input type="button" value="Detail" onclick="validate()" style="font-family:arial;font-weight:bold; font-size: 12px ; background-color:#FF9966;color:black;width:70px">
<input type="button" value="Menu" onclick="home()" <input type="button" value="Menu" onclick="home()" style="font-family:arial;font-weight:bold; font-size: 12px ; background-color:red;color:black;width:60px">
</p> 
    <hr>
</form>      
<div id="DivSum">
</div>        
 <?php


if ($_tag==2)
{
if (isset($_POST['days']))
{    
$_SESSION['mdate']=$_POST['days'];
$_SESSION['mdate1']=$_POST['days1'];
}
else
{
$_SESSION['mdate1']=date('d/m/Y');
$_SESSION['mdate']="01/".date('/m/Y');  
}
//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objPt=new Petition_master();
$objPtype=new Petition_type();
//echo $_SESSION['mdate'];
$date1=$objUtility->to_mysqldate($_SESSION['mdate']);
$date2=$objUtility->to_mysqldate($_SESSION['mdate1']);
if ($type!="0")
$cond="Pet_type='".$type."' and ";
else
$cond="";
$cond=$cond." issue_date between '".$date1."' and '".$date2."'  order by Issue_date,Pet_no";
$objPt->setCondString($cond);
$row=$objPt->getAllRecord();
//echo $objBm->returnSql;
?>
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="100%" colspan="6" align="center"><font face="arial" size="2" color="BLACK">PFC COLLECTION DETAIL FROM <?php echo $_SESSION['mdate']?> TO <?php echo $_SESSION['mdate1']?> </td></tr>
<tr><td width="7%" bgcolor="#6699CC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="7%" bgcolor="#6699CC" align="center"><font face="arial" size="2">Collection Date</td>
<td width="15%" bgcolor="#6699CC" align="center"><font face="arial" size="2">Petition Type</td>  
<td width="25%" bgcolor="#6699CC" align="center"><font face="arial" size="2">Petition No</td>  
<td width="25%" bgcolor="#6699CC" align="center"><font face="arial" size="2">Name of Applicant</td>    
<td width="15%" bgcolor="#6699CC" align="center"><font face="arial" size="2">Fees(in Rs)</td> 
</tr>    

<?php
$fees=0;
for($ii=0;$ii<count($row);$ii++)
{
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
//$objPt->getExp_dt()
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Issue_date'];
echo $objUtility->to_date($tvalue);
?>
</td>


<td align=center><font face="arial" size="2">
<?php
$objPtype->setCode($row[$ii]['Pet_type']);
if ($objPtype->EditRecord())
$tvalue=$objPtype->getAbvr ();
else
$tvalue="&nbsp;";
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$url="";
if ($row[$ii]['Pet_type']=="PR")
$url="<a href=PRC.php?";
if ($row[$ii]['Pet_type']=="CT")
$url="<a href=Caste.php?";
if ($row[$ii]['Pet_type']=="NC")
$url="<a href=NCL.php?";
if ($row[$ii]['Pet_type']=="DM")
$url="<a href=Domicile.php?";

if (strlen($url)>0 && $row[$ii]['Status']=="Processed")
{
$url=$url."yr=".$row[$ii]['Pet_yr']."&pno=".$row[$ii]['Pet_no'];    
$url=$url." target=_blank>Print</a>";
}
if(strlen($row[$ii]['Xohari_requestid'])>3)
$tvalue=($row[$ii]['Xohari_requestid']);
else
{
//$tvalue=($row[$ii]['Pet_type']);
$tvalue="";
$tvalue=$tvalue."".($row[$ii]['Pet_no']."/".$row[$ii]['Pet_yr']);   
}
echo $tvalue;
?>
 
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Applicant'];
echo $objSen->SentenceCase($tvalue);
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Fees'];
if (($tvalue)>0)
echo $tvalue;
else
echo "&nbsp;";
$fees=$fees+$tvalue;
?>
</td>
</tr>
<?php
} //for loop
//echo $ii;
} //$tag==2
?>
<tr>
<td align=right colspan="5" BGCOLOR="#6699CC"><font face="arial" size="2">
Total</td><td align=center BGCOLOR="#6699CC"><font face="arial" size="2">
<b><?php
echo $fees;
?></b>
</td>
</table>

</html>
