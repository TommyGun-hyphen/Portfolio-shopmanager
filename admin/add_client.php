<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/admin/partials/header.php');
        include_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
    ?>
    <div class="container border border-dark rounded p-5">
        <form action="add_client.php" method="post">
            <div class="mb-3">
                <label for="">Client's full name:</label>
                <input type="text" name="full_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Client's phone number:</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Client's email:</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Client's address:</label>
                <input type="text" name="address" class="form-control">
            </div>
            <button class="btn btn-primary float-right">Add client</button>
        </form>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['full_name'], $_POST['phone'], $_POST['email'], $_POST['address'])){
            $query = "INSERT INTO clients(full_name, phone, email, address) VALUES(?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$_POST['full_name'],$_POST['phone'], $_POST['email'], $_POST['address']]);
        }else{
            echo '<h3>pls fill all fields</h3>';
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>