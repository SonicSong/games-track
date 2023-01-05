<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if(!isset($_COOKIE['user'])) {
    $username = "guest";
} else {
    $username = $_COOKIE['user'];
}

$sql_user = "SELECT * FROM users WHERE username = '$username'";
$result = $db->query($sql_user);
$row = $result->fetch_assoc();

