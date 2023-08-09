   
<?php
header('Refresh: 120;url=IndexPage.php');
session_start();
require_once "StartMenuhead.html";
require_once './class/utility.class.php';
require_once './class/class.copy.php';
require_once './class/class.Frame.php';


$objCp=new CopyF();
$objUtility=new Utility();

$fname=$objUtility->ApplicationFolder()."/Lastbackup.txt";
$dateb=$objUtility->ReadF($fname);


$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();

if (($roll==-1) ||  $allowedroll>1 ) //Not Authorised
{
$_SESSION['returnmsg']="You are not authosied " ; 
header( 'Location: indexPage.php?tag=1');    
}

if ($roll>$allowedroll) //Not Admonistrator
{
header( 'Location: indexPage.php?tag=1');    
}
 
   
if (isset($_GET['unauth']))  //Check area of authority
echo $objUtility->alert ("Unauthorised Area");

$_SESSION['prev']=1;

if (isset($_SESSION['uid']))
$user=$_SESSION['uid'];
else 
$user="";
if (isset($_SESSION['firstlogin']))
{
if($_SESSION['firstlogin']=="Y")
header( 'Location: index.php?tag=0');
}

?>
<p align="center>"Last Backupon:&nbsp;<?php echo $dateb;?></p>

</body>
</html>
