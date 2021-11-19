<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/';
    $file_name = uniqid('300_').'.jpg';
    $file_save_path = $uploaddir.$file_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $file_save_path)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }

    $name=$_POST['name'];
    $description=$_POST['description'];
    $image=$_POST['image'];

    $conn = new PDO("mysql:host=localhost;dbname=mylocal", "root", "");
    $sql = "INSERT INTO `news` (`Name`, `Description`,`Image`) VALUES (?, ?, ?);";
    $conn->prepare($sql)->execute([$name,$description,$image]);
    header("Location: /");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Додати новину</title>
</head>
<?php

?>
<body>

<?php include "navbar.php"; ?>

<div class="container">
    <h1>Додати новину</h1>
    <form method="post">
        <div class="mb-3"">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="mb-3" class="form-label">
            <label for="description">Опис</label>
            <div id="editor">
            </div>
            <input type="hidden" class="form-control" id="description" name="description"></input>
        </div>
        <div class="mb-3" class="form-label">
            <label for="image">Фото</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Enter image">
        </div>
        <button type="submit" class="btn btn-primary" id="myBtn">Зберегти</button>
    </form>

</div>


<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/ckeditor.js"></script>
<script>
    let myEditor;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
            myEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    document.getElementById('myBtn').addEventListener('click',SaveDataFromEditor);
    function SaveDataFromEditor(){
        document.getElementById('description').value = myEditor.getData();
    }
</script>
</body>
</html>