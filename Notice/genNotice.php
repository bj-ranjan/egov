<?php
session_start();
require_once 'utility.class.php';
require_once 'class.notice.php';

$objN=new Notice();

$objU=new Utility(1);

$fname="notice.html";
$data="<html><body bgcolor=white><div align='center'><img src='notice.jpg'  width='580' height='85' /></div>";
$objN->WriteF($fname, $data);
$data="<table align=center border=0 cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90%>";
$objN->AppendF($fname, $data);

$tag=1;

$margindate=$objU->datePlusMinus(date('Y-m-d'), -20);

$objN->ExecuteQuery("update notice set isnew='N' where uploaded_on<='".$margindate."'");


$sql="select link_description,link_file,isnew from notice where active='Y' order by slno desc";
$row=$objN->FetchRecords($sql);

$data="<tr><td  align=LEFT COLSPAN=2 ><A HREF='index.html'  style='text-decoration: none'>HOME</a></td></tr>";
$objN->AppendF($fname, $data);
for($i=0;$i<count($row);$i++)
{
if ($tag==1){
$bcol="#CCFFCC";
$tag=2;
}
else
{
$bcol="#FFFFCC";
$tag=1;
}     
$data="<tr><td align=center height='30' bgcolor='".$bcol."'><font face=arial size=3 color=black>".($i+1)."</font></td>";
$data.="<td align='left' height='30' bgcolor='".$bcol."'>";
$data.="<a href=".$row[$i][1]."  style='text-decoration: none' target=_blank>";
$data.="<font face=arial size=3 color=black>".$row[$i][0]."</font></a>";
if ($row[$i][2]=="Y") 
$data.="<img border='0' src='new.gif' width='20' height='13'>";

$data.="</td></tr>";

$objN->AppendF($fname, $data);
}//for loop       
        
$objN->AppendF($fname, "</table>")  ;      

$data="<div  align=center> The website has been designed and hosted  by National Informatics Centre <br>Content of the website is provided and  updated by District Administration, Nalbari (Assam).</div></body></html>";
$objN->AppendF($fname, $data);  
echo "Generated&";
?>

<a href='notice.html' target='_blank'>Download File By Right Clicking</a>