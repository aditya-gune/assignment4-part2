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
if (!$mysqli->connect_errno) {
    //echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
fetchDB();
function fetchDB(){
	global $mysqli;
	if (!($stmt = $mysqli->prepare("SELECT name, category, length, rented FROM movies"))) {
    echo "Fetch Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Fetch Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$out_name = NULL;
$out_cat = NULL;
$out_length = NULL;
$out_rented = NULL;
if (!$stmt->bind_result($out_name, $out_cat, $out_length, $out_rented)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo "<table border = '1'>";
echo "<tr>";
echo "<th> Movie </th>";
echo "<th> Category </th>";
echo "<th> Length (Minutes) </th>";
echo "<th> Rented? </th>";
echo "<tbody>";
while ($stmt->fetch()) {
	
    echo "<tr>";
	echo "<td>" . $out_name . "</td>";
            echo "<td>" . $out_cat . "</td>";
            echo "<td>" . $out_length . "</td>";
			if($out_rented == 0)
            echo "<td> Available </td>";
			else
			echo "<td> Rented </td>";
	
            
}
echo "</tbody> </table>";
}
	
?>

</body>
</html>