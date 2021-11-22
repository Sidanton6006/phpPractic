<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
//    $conn = new PDO("mysql:host=localhost;dbname=myLocal", "root", "");
//    $sql = "UPDATE `news`
//            SET Name = '?', Description= '?', Image= '?'
//            WHERE Id = ?;";
//    $conn->prepare($sql)->execute([$_POST["id"]]);

    echo "Server response: ". $_POST["id"];
}
?>