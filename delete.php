<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $conn = new PDO("mysql:host=localhost;dbname=myLocal", "root", "");
    $sql = "DELETE FROM news WHERE Id = ?";
    $conn->prepare($sql)->execute([$_POST["id"]]);

    echo "Server deleted news with id ". $_POST["id"]. $_POST["imgPath"];
}
?>