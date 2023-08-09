<body>
<?//php include("connection.php"); ?>
<?php
session_start();
echo "First-".add(1,2,3)."<br>";
echo "second-".add();


function add($a,$b,$c)
{
if(!isset($a))
$a=1;
if(!isset($b))
$b=1;
if(!isset($c))
$c=1;
return($a+$b+$c);
}

?>
   
</body>
</html>
