<html>
<head><title>SQL Query</title></head>
<script type=text/javascript src="../validation.js"></script>
<script src="../jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() //Onload event of Form
{
$("#sql").change(function(event){
MyAjaxFunction("POST","Msg.php?id=0","",'ResultFrame',"HTML");        
document.getElementById('Save1').disabled=false;
}
);
}); //Ready Function
</script> 

<script type=text/javascript language=javascript>
function home()
{
window.location="../mainmenu.php";
}


function validate()
{
document.getElementById('Save1').disabled=true;
//MyAjaxFunction("POST","Msg.php?id=1","",'ResultFrame',"HTML");        
    
var a=document.getElementById('sql').value;  
//alert(a);
var b = a.replace("+","@"); 
//alert(b);
  
//var data="sql="+document.getElementById('sql').value;
var data="sql="+b;

if(notNull(a))
{
document.getElementById('ResultFrame').innerHTML="<image src=../image/Star.gif width=50 height=50><br>Executing Query, Please Wait..........";
MyAjaxFunction("POST","runQuery.php",data,'ResultFrame',"HTML");        
}
else
alert('Null String') ;   
}
</script>


<body>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require_once '../class/utility.class.php';
require_once '../class/class.Columns.php';
//require_once 'header.php';

$objUtility=new Utility();

//Start Verify
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: startmenu.php?unauth=1');
$auth="";

$dis="";

$_SESSION['rsl']=0;


header("Content-Type: text/html; charset=utf-8");   //FOR UNICODE
    
?>
<table border="0" align="center" width="80%">
<form name=myform method=post action=runquery.php>
<tr><td align=left>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="61%" ID="Table2">
<tr><td align="center" bgcolor="#FFFF99">
Enter SQL Query </td></tr>
<tr><td>
<textarea name=sql id="sql" rows=3 cols=120 style="font-family: Arial;background-color:white;color:black; font-size: 14px" <?php echo $dis;?>>
<?php echo $auth;?>
</textarea></td></tr>
<tr><td>
<input type=button value="Execute Query" name=Save1 id="Save1" onclick="validate()" style="font-family:Arial;background-color:orange;color:blue;font-weight:bold; font-size: 14px" <?php echo $dis;?>>
<input type=button value="Menu" name=id1 onclick="home()" style="font-family: Arial;background-color:red;color:black;font-weight:bold; font-size: 14px">

 </td></tr>
 </table>
 </td></tr>
 </table>
 </form>    
    <div align="center" id="ResultFrame">
    </div>
</body>
</html> 


