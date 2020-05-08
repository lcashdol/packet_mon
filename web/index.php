<?php

$sdate = $_GET['d'];
$mysqli = new mysqli("localhost", "user", "password", "packets");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT d_date from entry group by d_date"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$out_id    = NULL;
$out_label = NULL;
$vdbid = NULL;
if (!$stmt->bind_result($out_id)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo "<h1>Select Date</h1><hr><form action=\"/index.php\">";
echo "<input list=\"dates\" name=\"d\"> <datalist id=\"dates\">";
while ($stmt->fetch()) {
    echo "<option value=\"$out_id\">$out_id</option>";
}
echo "</select></datalist><input type=\"submit\">";
include 'chart.php';
?>
<a href="date.php">Packet Counts by Day</a>
</body>
</html>
