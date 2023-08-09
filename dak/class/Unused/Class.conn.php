<body>
<?php
$db=mysql_connect('localhost', 'root') or 
	die('Unable to connect , check your connection parameters.');
mysql_select_db('egovern', $db) or die(mysql_error($db));

?>