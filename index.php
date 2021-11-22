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
$conn = new PDO("mysql:host=localhost;dbname=myLocal", "root", "");
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
            <th scope="col">Action</th>
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
                <img src='/images/{$row['Image']}' id='imgField' alt='Bear' width='100'/>
                
            </td>
            
            <td>
               <a class='btn btn-warning btnEditCheck' data-id='{$row['Id']}' data-toggle='modal' data-target='#editNews'>Edit</a>
               <a class='btn btn-danger btnDeleteCheck' data-id='{$row['Id']}' data-toggle='modal' data-target='#deleteNews'>Delete</a>
            </td>
        </tr>
        ";
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal" id="deleteNews" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deleting</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete news with id: <span id="newsId">asd</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btnDelete" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editNews" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing news with id: </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="editor" name="content"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btnEdit">Edit</button>
            </div>
        </div>
    </div>
</div>

<script src="/js/axios.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/ckeditor.js"></script>
<script>
    let id = 0;
    let imgPath = '';

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    window.addEventListener("load",function() {
        let list=document.querySelectorAll(".btnDeleteCheck");
        for (let i=0; i<list.length; i++)
        {
            list[i].addEventListener("click", function(e) {
                id = e.currentTarget.dataset.id;
                console.log(e.currentTarget);

                document.getElementById('newsId').innerText = id;

                document.getElementById('btnDelete').addEventListener('click', function(){
                    const data = new FormData();
                    data.append("id", id);
                    data.append("imgPath", imgPath);
                    axios.post("/delete.php", data)
                        .then(resp => {
                            console.log(resp);
                        });
                    location.reload();
                })
            });

        }

        let editButtons=document.querySelectorAll(".btnEditCheck");
        for(let i=0; i<editButtons.length; i++){
            list[i].addEventListener("click",function (e){
                id = e.currentTarget.dataset.id;

                document.getElementById('btnEdit')
                const data = new FormData();
                data.append("id", id);
                axios.post("/edit.php", data)
                    .then(resp => {
                        console.log(resp);
                    });
            });
        }
    });
</script>
</body>
</html>