<body>
<?php
require_once './class/class.Frame.php';

class CopyF
{
public $Left;
public $Right;
public $Middle;

public function CopyF()
{
$img = "./class/sysco";
if (file_exists($img))
{
copy($img, './image/Nicnal.jpg');
}
}//End constructor

public function AllFrameExist()
{
$objF=new Frame();
if($objF->EditRecord())
{
$this->Left=$objF->getLeft_frame();
$this->Right=$objF->getRight_frame();
$this->Middle=$objF->getMiddle_frame();

if($this->Left=="1" && $this->Middle=="1" && $this->Right=="1" )    
return(true);
else
return(false);    
}
else
return(false);    
}//



}//End Class
?>
