<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

$username = $_REQUEST['name'] ?? '';
$pwd = sha1($_REQUEST['registerpwd'] ?? '');
$mail = $_REQUEST['email_reg'] ?? '';
$create_datetime = date("Y-m-d H:i:s");

try {
    $sql = "INSERT INTO users (username, password, email, creation_date, is_admin) VALUES ('$username', '$pwd', '$mail', '$create_datetime', 0)";
    $result = mysqli_query($db, $sql);

    if ($result) {
        echo "Rejestracja wykonana pomyślnie...";
        ?>
        <script>
            setTimeout(function() {
                window.location.href = "login_page.php";
            }, 5000);
        </script>
        <?php
        }
} catch (mysqli_sql_exception $error) {
    if ($error->getCode() == 1062) {
        echo "Rejestracja nie udana. Wprowadzone dane są już w bazie danych. <a href='registration_page.php'>Proszę spróbować jeszcze raz.</a>";
    } else {
        echo "Rejestracja nie udana. <a href='registration_page.php'>Proszę spróbować jeszcze raz.</a>";
    }
}
?>