<?php
$servername = "<db_host>";
$username = "<db_user>";
$password = "<db_passwd>";
$dbname = "<db_name>";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>