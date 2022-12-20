<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

$username = $_REQUEST['name'] ?? '';
$pwd = sha1($_REQUEST['registerpwd'] ?? '');
$mail = $_REQUEST['email_reg'] ?? '';
$create_datetime = date("Y-m-d H:i:s");

$sql = "INSERT INTO users (username, password, email, creation_date, is_admin) VALUES ('$username', '$pwd', '$mail', '$create_datetime', 0)";

if ($db->query($sql) === TRUE) {
    echo "Rejestracja wykonana pomyślnie.<br><a href='login_page.php'>Powrót do logowania.</a>";
} else {
    echo "Rejestracja nie udana. <a href='registration_page.php'>Proszę spróbować jeszcze raz.</a>";
}