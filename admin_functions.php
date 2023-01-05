<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_REQUEST['title']) AND !empty($_REQUEST['genre'])) {
        $title = $_REQUEST['title'] ?? '';
        $release_date = $_REQUEST['release_date'] ?? '';
        $genre = $_REQUEST['genre'] ?? '';
        $publisher = $_REQUEST['publisher'] ?? '';
        $platform = $_REQUEST['platform'] ?? '';

        add_game($db, $title, $release_date, $genre, $publisher, $platform);
    } elseif(!empty($_REQUEST['new_pub'])){
        $new_pub = $_REQUEST['new_pub'] ?? '';

        add_publisher($db, $new_pub);
    } elseif(!empty($_REQUEST['new_plat'])){
        $new_plat = $_REQUEST['new_plat'];

        add_platform($db, $new_plat);
    } elseif(!empty($_REQUEST['new_gen'])){
        $new_gen = $_REQUEST['new_gen'];

        add_genre($db, $new_gen);
    }

}

function add_game($db, $title, $release_date, $genre, $publisher, $platform){
    $sql_add_game = "INSERT INTO games (id, title, release_date, genres_id, publishers_id, platforms_id, date_added)
VALUES (NULL, '$title', '$release_date', $genre, $publisher, $platform, current_timestamp())";

    try{
    $result = mysqli_query($db, $sql_add_game);

    if ($result) {
        echo "Dodawanie gry wykonane pomyślnie...";
        ?>
        <script>
            setTimeout(function() {
                window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
            }, 5000);
        </script>
        <?php
        return $result;
    }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Dodawanie gry nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Dodawanie gry nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}

function add_publisher($db, $pub_pub){
    $sql_add_pub = "INSERT INTO publishers (id, publisher) VALUES (NULL, '$pub_pub')";

    try{
        $result = mysqli_query($db, $sql_add_pub);

        if ($result) {
            echo "Dodawanie wydawcy wykonane pomyślnie...";
            ?>
            <script>
                setTimeout(function() {
                    window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
                }, 5000);
            </script>
            <?php
            return $result;
        }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Dodawanie wydawcy nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Dodawanie wydawcy nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}

function add_platform($db, $plat_plat){
    $sql_add_plat = "INSERT INTO platforms (id, platforms) VALUES (NULL, '$plat_plat')";

    try{
        $result = mysqli_query($db, $sql_add_plat);

        if ($result) {
            echo "Dodawanie platformy wykonane pomyślnie...";
            ?>
            <script>
                setTimeout(function() {
                    window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
                }, 5000);
            </script>
            <?php
            return $result;
        }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Dodawanie platformy nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Dodawanie platformy nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}

function add_genre($db, $gen_gen){
    $sql_add_gen = "INSERT INTO genres (id, genres) VALUES (NULL, '$gen_gen')";

    try{
        $result = mysqli_query($db, $sql_add_gen);

        if ($result) {
            echo "Dodawanie gatunku wykonane pomyślnie...";
            ?>
            <script>
                setTimeout(function() {
                    window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
                }, 5000);
            </script>
            <?php
            return $result;
        }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Dodawanie gatunku nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Dodawanie gatunku nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}

$db->close();