<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php
        include_once('partials/header.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/ProductsRepository.php');

    ?>
    <div class=" container border rounded p-3">
        <form action="add_product.php" method="post" enctype="multipart/form-data"> 
            <div class="mb-3">
                <label for="">Product name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Product price:</label>
                <input type="text" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Old product price(optional):</label>
                <input type="text" name="price_old" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Product image:</label>
                <div>
                    <input type="file" name="img" id="img_upload" class="d-block">
                </div>
            </div>
            <button class="btn btn-primary mt-4">ADD PRODUCT</button>
        </form>            
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/shopmanager/images/';
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $target_file = $target_dir.$_POST['name'].'.'.$imageFileType;
            $target_file_name = $_POST['name'].'.'.$imageFileType;
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if($uploadOk == 1 && isset($_POST['name'], $_POST['price']) && is_numeric($_POST['price'])){
                if(!ProductsRepository::nameExists($_POST['name'])){
                    if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
                        if(isset($_POST['price_old']) && $_POST['price_old'] != ""){
                            if(is_numeric($_POST['price_old'])){
                                $query = "INSERT INTO products(name, price, price_old, img_url) VALUES(?,?,?,?)";
                                $stmt = $conn->prepare($query);
                                $stmt->execute([ $_POST['name'], $_POST['price'], $_POST['price_old'], 'images/'.$_POST['name'].'.'.$imageFileType ]);
                            }else{
                                echo 'old price is not numeric';
                            }
                            
                        }else{
                            $query = "INSERT INTO products(name, price, price_old, img_url) VALUES(?,?,?,?)";
                            $stmt = $conn->prepare($query);
                            $stmt->execute([ $_POST['name'], $_POST['price'], $_POST['price'],  'images/'.$_POST['name'].'.'.$imageFileType]);
                        }
                    }else{
                        echo 'failed to upload image';
                    }
                }else{
                    echo 'a product with the same name already exists';
                }          
                
            }else{
                echo 'fill all the obligatory fields';
            }
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>