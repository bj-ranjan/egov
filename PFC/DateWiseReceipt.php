<html>
<title></title>
</head>
<script language="JavaScript" src="../datepicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../datepicker/htmlDatePicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../validation.js"></script>


<script language=javascript>
<!--

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate(i)
{
var a=myform.days.value ;// Primary Key

if (isdate(a,1)==true)
{
var data="date="+document.getElementById('days').value;
if(i==1)
MyAjaxFunction("POST","DailySummary.php",data,"DivSum","HTML");
if(i==2)
MyAjaxFunction("POST","DateWiseDetail.php",data,"DivSum","HTML");

}
else
alert('Invalid Date');
}

 

</script>
<body>


       
<?php

session_start();
//require_once '../class/utility.php';
require_once '../class/utility.class.php';
//require_once '../class/class.sentence.php';
//require_once './class/class.petition_master.php';
require_once './class/class.petition_type.php';
require_once 'header.php';


if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

$objUtility=new Utility();
$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');



?>
<form name="myform" method="post"> 
    <font color="blue" size="2" face="arial">  
    <p align="center">
Report Date
<input type="text" size="12" name="days" id="days" value="<?php echo date('d/m/Y');?>" maxlength="10">
<img src="../datepicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(days);" alt="Click Here to Pick Date">
<input type="button" value="Summary" onclick="validate(1)" style="font-family:arial;font-weight:bold; font-size: 12px ; background-color:#FF9966;color:black;width:100px">
<input type="button" value="Receive Detail" onclick="validate(2)" style="font-family:arial;font-weight:bold; font-size: 12px ; background-color:#FF9966;color:black;width:100px">
<input type="button" value="Menu" onclick="home()">
 <hr>
</form>      
    <div id="DivSum">
    </div>
 
</body>
</html>
