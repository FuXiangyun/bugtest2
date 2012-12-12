<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>捉虫——The Bug Tracker</title>

<link rel="stylesheet" href="styles/layout.css" type="text/css">
</head>

<body>
<?php
include("DBO.php");
$object = new DBO();
$object->InitDBO("localhost","root","");
$array  = $object->LoginCheck("fuxiangyun","fuxiangyun");
echo $array[0];
?>
</body>
</html>
