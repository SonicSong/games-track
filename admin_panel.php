<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel administratora</title>
</head>
<body>
    <?php
    $db = mysqli_connect("localhost", "root", "", "games_track");
    if (!$db){
        die('Nie można było się połączyć z bazą danych: '.mysqli_error());
    }

    $sql = "SELECT * FROM users WHERE is_admin = 1";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    var_dump($row);

    ?>
</body>
</html>