<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

