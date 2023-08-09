
<body>
<script language="javascript">
<!--

function home()
{
window.location="./mainmenu.php?tag=0";
}

function selectall(i)
{
var fld;
for(j=1;j<=i;j++)
{
fld="Sel"+j;
if(document.getElementById('all').checked==true)
document.getElementById(fld).checked=true;
else
document.getElementById(fld).checked=false;
}
}

function check(i)
{
var fld;
var ok=false;
for(j=1;j<=i;j++)
{
fld="Sel"+j;
if(document.getElementById(fld).checked==true)
ok=true;
}
return(ok);
}

function go(i)
{
if(check(i))
{
document.getElementById('SaveData').value=1;
document.getElementById('save').disabled=true;
document.getElementById('del').disabled=true;
myform.action="Restore.php?tot="+i;
myform.submit();
}
else
alert('Select any File');
}

function clr(i)
{
if(check(i))
{
var name = confirm("All Selected Files will be Permentently Deleted?");
if (name == true)    
{    
document.getElementById('SaveData').value=2;
document.getElementById('save').disabled=true;
document.getElementById('del').disabled=true;
myform.action="Restore.php?tot="+i;
myform.submit();
}
}
else
alert('Select any File');
}

//END JAVA
</script>

<?php

session_start();
require_once './class/utility.class.php';
require_once './class/class.dbmanager.php';
$objCash=new Dbmanager();

$objUtility=new Utility();
$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: mainmenu.php?unauth=1');

if (isset($_POST['SaveData'])) //If Post data is to be Saved
$save = $_POST['SaveData'];
else
$save = 0;

if (isset($_GET['tot'])) //If Post data is to be Saved
$tot = $_GET['tot'];
else
$tot = 0;


?>
<form name=myform method=post>
<table border=1 align=center width=60%>
<tr><td align=center colspan=3><font face=arial size=2>Select to Execute Script under File<br>
 </td>
<td align=center> 
 <?php
$objCash->genButton("bk","Menu","70","green","black",12," onclick=home()");
?>
    </td></tr>
<tr><td align=center bgcolor=grey><font face=arial size=2>SlNo</td><td align=center bgcolor=grey><font face=arial size=2>File Name</td><td align=center bgcolor=grey><font face=arial size=2>Statements</td><td align=center bgcolor=grey><font face=arial size=2>Select</td></tr>
<?php
$i=1;
foreach(glob('./log/*.sql') as $filename)
{
$Sel="Sel".$i;
$name="Name".$i;
$row=explode("/",$filename);
$fname=$row[2];
//$size=(filesize($filename))
?>
<td align=center><font face=arial size=2><?php echo $i;?></td>
<td align=left><font face=arial size=2><?php echo $fname;?>
<input type=hidden name="<?php echo $name;?>"  id="<?php echo $name;?>" value=<?php echo $filename;?>>
</td>
<td align=center><font face=arial size=2><?php echo $objCash->TotLines($filename);?></td>
<td align=center><input type=checkbox name="<?php echo $Sel;?>" id="<?php echo $Sel;?>"></td></tr>
<?php
$i++;
}//foreach
$i--;
?>
<tr>
<td align=center>
&nbsp;
</td>
<td align=center ><font face=arial size=2>Select All<input type=checkbox id="all" onclick=selectall(<?php echo $i;?>)></td><td align=center >
<?php
$objCash->genButton("save","Restore Data","120","orange","black",12," onclick=go(".$i.")");
?>
<input type=hidden name="SaveData" id="SaveData" value=0>
</td>
<td align=center >
<?php
$objCash->genButton("del","Clear Files","100","red","black",12," onclick=clr(".$i.")");
?></td>
</tr>
</table>
</form>
<font face=arial size=1 color=orange>
<?php
if($save==1 && $tot>0)
{
for($k=1;$k<=$tot;$k++)
{
$Sel="Sel".$k;
$fname="Name".$k;
$filename=$_POST[$fname];
if(isset($_POST[$Sel]))
{
$objCash->RestoreData($filename,$a,$b);
echo $filename."  Success-".$a." ";
if($b>0)
echo "Fail-".$b;
echo "<br>";
} //if
}
} //$save=1

if($save==2 && $tot>0)
{
for($k=1;$k<=$tot;$k++)
{
$Sel="Sel".$k;
$fname="Name".$k;
if(isset($_POST[$Sel]))
{
$filename=$_POST[$fname];
if(file_exists($filename))
unlink($filename); 
} //if
}//for
header('location:Restore.php');
}//save==2
?>


</body>
</html>

