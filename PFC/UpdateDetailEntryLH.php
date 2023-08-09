<script language=javascript>
<!--
function home()
{
myform.setAttribute("target","_self");//Open in Self   
myform.action="ProcessLH.php?tag=1";
myform.submit(); 
}

function validate(i,j)
{
myform.setAttribute("target","_blank");//Open in New Window
myform.action="NOK.php?yr="+i+"&pno="+j;
myform.submit();    
}
</script>

<?php
session_start();
require_once './class/class.petition_master.php';
require_once './class/class.legal_heir.php';
require_once '../class/utility.class.php';
require_once '../class/class.relation.php';
require_once '../class/class.sentence.php';

$objUtility=new Utility();
//if ($objUtility->VerifyRoll()==-1)
//header( 'Location: mainmenu.php?unauth=1');

$objLegal_heir=new Legal_heir();
$objPm=new Petition_master();

if (isset($_SESSION['username']))
$user=$_SESSION['username'];
else
$user=""; 

if(isset($_POST['Nos']))
$nos=$_POST['Nos'];
else
$nos=0;   

if(isset($_POST['Pet_yr']))
$Pet_yr=$_POST['Pet_yr'];
else
$Pet_yr=0;

if(isset($_POST['Pet_no']))
$Pet_no=$_POST['Pet_no'];
else
$Pet_no=0;

$objSen=new Sentence();
if(isset($_POST['Deceased']))
$Deceased=$objSen->SentenceCase ($_POST['Deceased']);
else
$Deceased="";

if(isset($_POST['DOD']))
$report="Date of Death-".$_POST['DOD'];
else
$report="";

if(isset($_POST['BO']))
$BO=$_POST['BO'];
else
$BO="";

if(isset($_POST['Memo']))
$Memo=$_POST['Memo'];
else
$Memo="";



$success=0;
$mytag=0;

//echo "NOS". $nos;

//echo "Petno". $Pet_no;

for ($ind=1;$ind<=$nos;$ind++)
{
   
$Slno="Slno".$ind;
$Slno=$_POST[$Slno];

$Nok="Nok".$ind;
$Nok=$objSen->SentenceCase ($_POST[$Nok]);

$Relation="Relation".$ind;
$Relation=$_POST[$Relation];

$Age="Age".$ind;
$Age=$_POST[$Age];

$Dob="Dob".$ind;

$Dob=$_POST[$Dob];
if ($objUtility->isdate($Dob)==false)
$Dob="NULL";
else
$Dob=$objUtility->to_mysqldate($Dob);


    
$objLegal_heir->setPet_yr($Pet_yr);
$objLegal_heir->setPet_no($Pet_no);
$objLegal_heir->setSlno($Slno);
$objLegal_heir->setNok($Nok);
$objLegal_heir->setAge($Age);
$objLegal_heir->setRelation($Relation);
$objLegal_heir->setDob($Dob);
if($objLegal_heir->SaveRecord())
{
$success++;
$objUtility->saveSqlLog("Legal_Heir",$objLegal_heir->returnSql) ;
$objUtility->Backup2Access("", $objLegal_heir->returnSql);
}
//echo $objLegal_heir->returnSql."<br>";

}//for loop

if($success==$nos)
{
$objPm->setPet_yr($Pet_yr);
$objPm->setPet_no($Pet_no);
$objPm->setAst("Y");
$objPm->setProcessed_by($user);
$objPm->setProcess_date(date('Y-m-d'));
$objPm->setStatus("Processed");
$objPm->setAst_report($report);
$objPm->setFather($Deceased);
$objPm->setBo_name($BO);
$objPm->setRejected_reason($Memo);
if($objPm->UpdateRecord())
{    
echo $objUtility->alert($success." Record Updated");
//$objUtility->saveSqlLog("Petition_master",$objPm->returnSql) ;
$objUtility->CreateLogFile("Petition_master", $objPm->returnSql, 2, "M");


$objUtility->Backup2Access("", $objPm->returnSql);

$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:100px";

?>
<form name=myform method="post">
<table border="1" width="50%" cellpadding="3" align="center">
<tr><td align="center" colspan="2">
<font face="arial" size="3" color="blue">
 Certificate of NOK for Petition No.<b><?php echo $Pet_yr."/".$Pet_no;?></b> is Processed Successfully.           
</td>
</tr>  
<td align="right" >  
<input type=button value=Back  name=back1 id=back1 onclick=home()  style="<?php echo $mystyle;?>">
</td>
<td align="left" >  
<input type=button value="Print"  name="Save" id="Save" onclick=validate("<?php echo $Pet_yr;?>","<?php echo $Pet_no;?>") style="<?php echo $mystyle;?>">
</td>
</tr>
</table>
</form>    
<?php
}
}  //$success==$nos 
    
?>