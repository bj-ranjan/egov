<?php
include("header.php");
?>

    <script type="text/javascript" src="../validation.js"></script>
    <script language=javascript>
        <!--

	function IEBrowser()
	{
    if(navigator.appName.indexOf("Microsoft Internet Explorer") != -1)
    return(true);
    else
    return(false);    
    
	}


    function AutoBackup()
    {
if(IEBrowser()==true)
{
document.getElementById('MyBar').innerHTML="<image src=../image/Star.gif width=70 height=70><br>Database Backup in Progress, Please Wait........";
window.open('ProcessMyBackup.php','_self');
}
else
{
startTask();
}
}



        function validate(a)
        {

               myform.Save.disabled=true;
               myform.bk.disabled=true;
		 if(a==0)
                     {
             AutoBackup();
                     }
		 if(a==1)
               myform.action="ProcessBackup_PGSQL.php";
		 if(a==2)
               myform.action="ProcessBackup_SQLServer.php";
               //myform.submit();
               //document.getElementById('Result').innerHTML="<image src=../image/Star.gif width=70 height=70><br> Database Backup in Progress, Please Wait........";
             }

   

        function home()
        {
            myform.action="../mainmenu.php?tag=0";
            myform.submit();
        }

      //Progress Bar Related Java Code
      var es; 
function startTask() { 
  
es = new EventSource('ProcessBackup.php'); 
//a message is received 
es.addEventListener('message', function(e) { 
var result = JSON.parse( e.data ); 

if(e.lastEventId == 'CLOSE') { //CLOSE Event sent from Server
//addLog('Received CLOSE closing'); 
es.close(); 
//var pBar = document.getElementById('progressor'); 
//pBar.value = pBar.max; //max out the progress bar 
var str=ShowMyProgessBar(100,result.message);
document.getElementById('MyBar').innerHTML=str;
document.getElementById('Save').disabled=false;
document.getElementById('bk').disabled=false;
} 
else 
{
//var pBar = document.getElementById('progressor'); 

if(e.lastEventId == 'RESETBAR')   //Intermediate event
{    
//pBar.value = "0";
var str=ShowMyProgessBar(0,"");
document.getElementById('MyBar').innerHTML=str;
}
else  //Normal LOOP Running event
{
//pBar.value = result.progress; 
var str=ShowMyProgessBar(result.progress,result.message);
document.getElementById('MyBar').innerHTML=str;
}
} 
}); 

es.addEventListener('error', function(e) { 
addLog('Error occurred'); 
es.close(); 
}); 
} 

function stopTask() { 
es.close(); 
addLog('Interrupted'); 
} 

  
function ShowMyProgessBar(per,msg)
{
var tbl="<table border=1 align=center width=70% style=border-collapse: collapse;>"  ;
tbl=tbl+"<tr>";
var mtext="";
per=parseInt(per/5);

for(var i=1;i<=20;i++)
{
if(i<=per)  
var  bgcol="#66FF33";
else
var  bgcol="white";  
if(i==per)
mtext=(per*5)+"%";
else
mtext="&nbsp;";    
tbl=tbl+"<td width=5% bgcolor="+bgcol+"><font face=arial size=1>"+mtext+"</font></td>"; 
}//end for loop
tbl=tbl+"</tr><tr>";
tbl=tbl+"<td colspan=20 align=center><font face=arial size=2>"+msg+"</font></td>";
tbl=tbl+"<tr></table>";

return(tbl);
}
  
      
    </script>
    <body>
        <?php
//Start FORMBODY
        session_start();
        require_once '../class/class.pwd.php';
        require_once '../class/utility.class.php';

        $bfile = "Backup" . date('Ymd');

        $objUtility = new Utility();
        
$allowedroll = 2; //Change according to Business Logic
        $roll = $objUtility->VerifyRoll();
        //if (($roll == -1) || ($roll > $allowedroll))
        //header('Location: ../Mainmenu.php?unauth=1');

        

        $objTab = new Pwd();

//Start of FormDesign
        ?>
        <div id="Result" align="center">
<form name=myform action=""  method=POST >
<?php   

$i=0;
$det="Mysql";
$fun = " onclick=validate(".$i.")";
?>
<input type="button" name="Save" id="Save" value="Click to take Backup" onclick="validate(0)">
<input type="button" name="bk" id="bk" value="Home" onclick="home()">

</form>    
<br /> 
<div id="MyBar" align="center"></div>
<?php if(1==2) {?>
<progress id='progressor' value="0" max='100' style=""></progress> 
<?php } ?>

</body>
</html>
