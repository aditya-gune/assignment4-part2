<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

addtoDB();
function addtoDB(){
	global $mysqli;
$name = isset($_POST['name'])? $_POST['name']: '';
$category = isset($_POST['category'])? $_POST['category']: '';
$length = isset($_POST['length'])? $_POST['length']: '';

if (!($stmt = $mysqli->prepare("INSERT INTO movies (name, category, length) VALUES ('".$name ."', '".$category."', '".$length."')"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param('ssi', $name, $category, $length)) {
    echo "Name Binding Failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
}

?>




</body>
</html>