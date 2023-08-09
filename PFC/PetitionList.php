<html>
<title></title>
</head>
<script type=text/javascript src="../Validation.js"></script>

<script language=javascript>
<!--

function reload()
{
var data="Ptype="+document.getElementById('Ptype').value;    
MyAjaxFunction("POST","LoadPetition.php",data,'List');
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function notNull(str)
{
var k=0;
var found=false;
var mylength=str.length;
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
if (k!=32)
found=true;
}
return(found);
}

function isNumber(ad)
{
if (isNaN(ad)==false && notNull(ad))
return(true);
else
return(false);
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate()
{
var a=myform.days.value ;// Primary Key

if (isdate(a,1)==true)
{
myform.action="DateWiseReceipt.php?tag=2";
myform.submit();
}
else
alert('Invalid Date');
}

function isdate(dt,tag)
{
//var dt=myform.Est_On.value;
var ln=parseInt(dt.length);
var dd;
var mm;
var yyyy;
var leapday;
var tt=true;
var i=dt.indexOf("/");
dd=dt.substr(0,i);
var j=dt.indexOf("/",(i+1));
mm=dt.substr((i+1),(j-i-1));
yyyy=dt.substr((j+1),(ln-j-1));
if(isNaN(yyyy)==false)
{
var t=parseInt(yyyy%4);
if(t==0)
leapday=29;
else
leapday=28;
}
if((tag==0) && ln==0)  //for null field No check
tt=true;
else
{
if (isNaN(dd)==false && isNaN(mm)==false && isNaN(yyyy)==false)
{
dd=Number(dd);
mm=Number(mm);
yyyy=Number(yyyy);
if( (mm>0) && (mm<13) && (dd>0) && (dd<32))
{
if((mm==4)||(mm==6)||(mm==9)||(mm==11)) //30st day
{
if (dd>30)
{
alert('Invalid Date '+dt+'(DD Part out of range)');
tt=false;
}
} // mm==4
if (mm==2)
{
if (dd>leapday)
{
alert('Invalid Date '+dt+'(DD Part)');
tt=false;
}
} //mm==2
}
else //mm>0 && dd>0
{
alert('Invalid Date '+dt+'(Month out of range)');
tt=false;
}
}
else  // Non numeric figure appears
{
alert('Invalid date '+dt);
tt=false;
}
}// not null
return(tt);
}

</script>
<body>


       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';
require_once '../class/class.pwd.php';
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

$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 8)==false) //8 for Process Certificate like PRC/caste and Non Creamy
header( 'Location: Mainmenu.php?unauth=1');


$objUtil=new myutility();

?>
  

 <?php

$objPt=new Petition_master();
$objPtype=new Petition_type();
//echo $_SESSION['mdate'];
$objPt->setCondString("status='Pending' and pet_type in('PR','CT','NC','DM') and AST='N' order by pet_date desc,pet_no");
$row=$objPt->getAllRecord();
//echo $objBm->returnSql;
?>
<div id="List">    
<table border=1 align=center cellpadding=4 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td width="68%" colspan="5" align="center"><font face="arial" size="2" color="blue"><b>PENDING PETITION LIST </b></td>
 <td align="center" width="25%" COLSPAN="2">
 <select id="Ptype" onchange="reload()">
<option value="0">-Select-
<option value="PR">PRC
<option value="CT">Caste
<option value="NC">Non Creamy
<option value="DM">Domicile
 </select>
 </td>
        <td align="center" width="7%">
 <input type=button value=Menu  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:red;color:black;width:80px">
           
        </td>
    </tr>
    
<tr><td width="5%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">SlNo</td> 
<td width="12%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition Type</td>  
<td width="24%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Name of Applicant</td> 
<td width="15%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Petition No</td> 
<td width="10%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Date</td> 
<td width="9%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Pending For(Days)</td> 
<td width="18%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Forwarded by</td>
<td width="7%" bgcolor="#99FFCC" align="center"><font face="arial" size="2">Process</td>
</tr>    
   
<?php
for($ii=0;$ii<count($row);$ii++)
{
if($row[$ii]['Pet_type']=="PR" || $row[$ii]['Pet_type']=="DM")
$plink="ProcessPRC.php?tag=0";
if($row[$ii]['Pet_type']=="CT")
$plink="ProcessCaste.php?tag=0";
if($row[$ii]['Pet_type']=="NC")
$plink="ProcessNC.php?tag=0";
$plink=$plink."&yr=".$row[$ii]['Pet_yr']."&pno=".$row[$ii]['Pet_no'];
?>
<tr>
<td align=center><font face="arial" size="2">
<?php
$tvalue=$ii+1;
echo $tvalue;
//$objPt->getExp_dt()
?>
</td>
<td align=center><font face="arial" size="1">
<?php
$objPtype->setCode($row[$ii]['Pet_type']);
if ($objPtype->EditRecord())
$tvalue=strtoupper($objPtype->getAbvr ());
else
$tvalue="&nbsp;";
echo $tvalue;
?>
</td>
<td align=left><font face="arial" size="2">
<?php
$tvalue=($row[$ii]['Applicant']);
echo strtoupper($tvalue);
?>
</td>
<td align=center><font face="arial" size="2"><B>
<?php
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
<td align=center><font face="arial" size="2">
<?php
$tvalue=$row[$ii]['Pet_date'];
$tvalue=$objUtility->to_date($tvalue);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<?php
$date1=date('Y-m-d');
$date2=substr($row[$ii]['Pet_date'],0,10);
$tvalue=$objUtility->dateDiff($date1, $date2);
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">&nbsp;
<?php
$objP=new Pwd();
$tvalue=$row[$ii]['Entered_by'];
$objP->setUid($tvalue);
if($objP->EditRecord())
echo $objP->getFullname();
else
echo $tvalue;
?>
</td>
<td align=center><font face="arial" size="2">
<a href="<?php echo $plink;?>">Click</td>
</tr></a>
<?php
} //for loop
?>
</table>
</div>
</body>
</html>
