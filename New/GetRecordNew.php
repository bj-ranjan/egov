<?php
//header("content-Type:application/json; charset=UTF-8");
//header('Access-Control-Allow-Origin:*');
//header('Content-Type:application/javascript;charset=UTF-8');
//header('Content-Type:application/javascript;charset=UTF-8');


session_start();
require_once 'class/class.adjust.php';

$objTab = new Adjust();

//$db=isset($_SESSION['Deo_Name'])?$_SESSION['Deo_Name']:'NA';

$db="";

//echo $db;
if ($_SERVER['REQUEST_METHOD'] == 'POST' || 1==1) {

  //CHECK PASSWORD
   // $uid = isset($_GET['uid']) ? $_GET['uid'] : '';
   // $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : '';

   // $dbpwd = $objTab->FetchColumn("pwd", "pwd", "uid=?", $Param = array($uid), "");
    //$hashpwd =hash("sha512",$pwd);

    $hashpwd="xxx";
    $dbpwd ="xxx";
       
  //END HASHING PASSWORD  

    $table = isset($_GET['table']) ? $_GET['table'] : 'POLICE_STATION';
    
   $columnnames=isset($_GET['columnnames'])?$_GET['columnnames']:'code,name';
    
    $cond = isset($_GET['cond']) ? $_GET['cond'] : '1=1 ';

    $param = isset($_GET['valueparam']) ? $_GET['valueparam'] : '';
    
    $ValueParam = array();
    $ValueParam = explode(",", $param);

    $ordby = isset($_GET['orderby']) ? $_GET['orderby'] : ' ';

//$postdata=file_get_contents("php://input");
//if(isset($postdata))
//{
//$request=json_decode($postdata);
//$res="Posted".count($request).$request->table;
//}
//else
//{
//$res="No post";
//}
    
    $sql="select ". $columnnames." from ".$table;
    if(strlen($cond)>2)
    $sql=$sql." where ".$cond;
    
    if(strlen($ordby)>2)
     $sql=$sql." order by ".$ordby;

    $json="";
    

    if ($hashpwd === $dbpwd) {    //password matched
        $row = $objTab->FetchRecords($sql, $ValueParam);

	$col=$objTab->colFetched;

        if (count($row) >= 0) {
            $data = "{" . chr(34) . "Found" . chr(34) . ":{";

            $json.= $data;
            
            $msg = "Result Rows " . count($row)." ";
	
            $data = chr(34) . "Message" . chr(34) . ":[{" . chr(34) . "msg" . chr(34) . ":" . chr(34) . $msg . chr(34) . "}],";
            $json.=$data;
            
            $data = chr(34) . "Result" . chr(34) . ":[";
            $json.=$data;
     
            for ($i = 0; $i < count($row); $i++) {

                if ($i > 0) {
                    $json.= ",";
                           }
                $json.= "{";
  
                for ($j = 0; $j < $col; $j++) {
                    if ($j > 0) {
                        $json.= ",";
                          }
                    $data = chr(34) . "column" . ($j + 1) . chr(34) . ":" . chr(34) . $row[$i][$j] ."  ".$db. chr(34);
                   $json.=$data;
                  }//$j

              $json.= "}";
              }//for loo
          $json.= "]";
           $json.= "}}";

          }
    } else {
       $json.= "{" . chr(34) . "Failed" . chr(34) . ":{";
   $json.= chr(34) . "Message" . chr(34) . ":" . chr(34) . "Authenticaton Failed ".  chr(34) . "}}";
    }
    
 }

 
 //echo $json;
//$json=json_encode($json);

//echo "<br>";


if(isset($_GET['callback']))
echo "jsonCallback([".$json."]);";
//echo "jsonCallback(".$json.");";
else
echo $json;
