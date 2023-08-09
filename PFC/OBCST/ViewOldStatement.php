  <STYLE type=text/css>
    @media screen{
       thead{display:table-header-group}
       }
   @media print{
       thead{display:table-header-group}
      body{margin-top:0.5 cm;margin-left:1.5 cm;margin-right:1 cm;margin-bottom:1}
      tfoot{display:none}
 pre {page-break-after: always;}
   }
 </STYLE>


<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.old_obc_st.php';



$type=isset($_GET['rType'])?$_GET['rType']:"Both";
$yr=isset($_GET['rYear'])?$_GET['rYear']:date('Y');
$no1=isset($_GET['No1'])?$_GET['No1']:0;
$no2=isset($_GET['No2'])?$_GET['No2']:0;


$no1=is_numeric($no1)?$no1:'0';
$no2=is_numeric($no2)?$no2:'0';


$cond="CERT_TYPE='".$type."' and  id between ".$no1." and ".$no2." order by id";

//echo $cond;

$Title="Statement of  OLD Certificate Record against ".$type;
$headList=array("Certificate ID","Name","Father/Husband","Village","Certificate No","Date");
$align=array(2,1,1,1,2,2);
$valueList=array();
$objUtility=new Utility();
$objOld_obc_st=new Old_obc_st();

$sql="SELECT ID ,NAME_OF_CERTHOLDER ,FATHERS_NAME ,VILLAGE,CERT_NO ,ISSUE_DATE  FROM OLD_RECORD where ".$cond;
$row=$objOld_obc_st->FetchRecords($sql);
for($ii=0;$ii<count($row);$ii++)
{
    
$valueList[$ii][0]=$row[$ii][0];

$valueList[$ii][1]=$row[$ii][1];

$valueList[$ii][2]=$row[$ii][2];

$valueList[$ii][3]=$row[$ii][3];
$valueList[$ii][4]=$row[$ii][4];
$valueList[$ii][5]=$objUtility->to_date($row[$ii][5]);
}


$objOld_obc_st->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));

 
?>


