<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Новини</title>
</head>
<?php
$conn = new PDO("mysql:host=localhost;dbname=mylocal", "root", "");
$reader = $conn->query("SELECT * FROM news");

?>
<body>

<?php include "navbar.php"; ?>
<div class="container">
    <h1>Головна сторінка</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reader as $row) {
            echo "
        <tr>
            <td>{$row['Id']}</td>
            <td>{$row['Name']}</td>
            <td>{$row['Description']}</td>
            <td>
                <img src='/images/{$row['Image']}' alt='{$row['Image']}' width='100'/>
                
            </td>
        </tr>
        ";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>