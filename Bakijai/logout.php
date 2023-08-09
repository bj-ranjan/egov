<html>
<title></title>
</head>

<body>


<?php
session_start();
if(isset($_SESSION['prev']))
$prev=$_SESSION['prev'];
else
$prev=0;
if($prev==1)
header( 'Location: ../index.php.php?tag=1');
else
header( 'Location: ../startmenu.php?tag=1');
?>
</body>
</html>
