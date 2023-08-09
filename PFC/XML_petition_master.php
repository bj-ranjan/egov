<?php
session_start();
require_once './class/class.petition_master.php';
//require_once '../class/utility.class.php';

//$objUtility=new Utility();
$objPetition_master=new Petition_master();
//Get Post variable

if(isset($_GET['id']))
$Param1=$_GET['id'];
else
$Param1=10;


if (isset($_POST['Pet_yr']))
$objPetition_master->setPet_yr($_POST['Pet_yr']);//Push Primary Key Data to Class
if (isset($_POST['Pet_no']))
$objPetition_master->setPet_no($_POST['Pet_no']);//Push Primary Key Data to Class

if ($objPetition_master->EditRecord()) //i.e Data Available
$found=true;
else
$found=false;

if ($found==true)
{
if($Param1==1)
{
?>
<RESULT>
<APPLICANT>
<?php
echo $objPetition_master->getApplicant();
?>
</APPLICANT>
<FATHER>
<?php
echo $objPetition_master->getFather();
?>
</FATHER>
<LAC_NO>
<?php
echo $objPetition_master->getLac_no();
?>
</LAC_NO>
<PART_NO>
<?php
echo $objPetition_master->getPart_no();
?>
</PART_NO>
<RES>
<?php
if ($objPetition_master->getAst()=="N" && $objPetition_master->getPet_type()=="ER")
echo "Y";
else
echo "N";
?>
</RES>
</RESULT>
<?php
} //param==1

if($Param1==0 && $objPetition_master->getAst()=="N" && $objPetition_master->getPet_type()=="ER")
{
$mystyle="font-family:arial; font-size: 14px ;font-weight:bold; background-color:orange;color:black;width:150px";
?>
<input type=button value="Reject Petition"  name="Save" id="Save" onclick=validate() style="<?php echo $mystyle;?>">
<?php
}//param1==0
else
if($Param1==0)
echo "Petition Type-".$objPetition_master->getPet_type()." Status-".$objPetition_master->getStatus();
?>
<?php
}//found=true
?>
