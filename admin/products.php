<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @media (min-width: 768px) {
        .collapse.dont-collapse-sm {
            display: block;
            height: auto !important;
            visibility: visible;
            }
        }
    </style>
    <title>Manage products</title>
</head>
<body>
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        include_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/admin/partials/header.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/ProductsRepository.php');

        
    ?>
    <button class="btn btn-dark d-block d-sm-none" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse"><i class="fas fa-filter"></i></button>

<div class="navbar-collapse collapse dont-collapse-sm" id="filterCollapse">
<div class="container border border-dark rounded py-2">
    <form action="products.php" method="get" class="form-inline justify-content-center">
        <div class="row w-100 justify-content-between form-inline">
        
                <div class="col col-md-3 col-12 form-inline">
                    <label>order by:</label>
                    <select name="order_by" class="form-control ml-5">
                        <option value="price" <?= (isset($_GET['order_by']) && $_GET['order_by'] == "price" ? "selected" : "") ?>>price</option>
                        <option value="name" <?= (isset($_GET['order_by']) && $_GET['order_by'] == "name" ? "selected" : "") ?>>name</option>
                    </select>
                </div>
                <div class="col col-md-4 col-12 form-inline">
                    <label>order direction:</label>
                    <select name="order_direction" class="form-control ml-5">
                        <option value="asc" <?= (isset($_GET['order_direction']) && $_GET['order_direction'] == "asc" ? "selected" : "") ?>>ascendant</option>
                        <option value="desc" <?= (isset($_GET['order_direction']) && $_GET['order_direction'] == "desc" ? "selected" : "") ?>>descendant</option>
                    </select>
                </div>
                <div class="col col-md-4 col-12 form-inline">
                    <label>max price:</label>
                    <input type="text" name="max_price" class="form-control ml-5" value="<?= (isset($_GET['max_price']) ? $_GET['max_price'] : ""); ?>">  
                </div>
                <div class="col col-md-1 col-12 d-flex flex-row-reverse my-2">
                    <button class="btn btn-dark">Filter</button>
                </div>
            
        
        </div>
    </form>
</div>
</div>
    <div class="container border border-dark rounded mt-3">
        <div class="row justify-content-center my-4">
        <?php
        $order_by = null;
        $order_direction = null;
        $max_price = null;
        if(isset($_GET['order_by'])){$order_by = $_GET['order_by'];}
        if(isset($_GET['order_direction'])){$order_direction = $_GET['order_direction'];}
        if(isset($_GET['max_price'])){$max_price = $_GET['max_price'];}
        $products = ProductsRepository::getFiltered($order_by, $order_direction, $max_price);
        if(empty($products)){
            echo '<h3>the shop has no products at the moment.</h3>';
        }
        foreach($products as $product){
        ?>
            <div class="col col-md-3">
                <div class="card">
                    <img src="<?="/shopmanager/". $product->getImgUrl() ?>" alt="" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title"><?= $product->getName().'<br><small> | id:'.$product->getId() .'</small>'?></h3>
                        <p class="card-text">$<?= $product->getPrice() ?></p>
                        <small class="card-text text-secondary">&nbsp</small>
                        <?php
                            if($product->getPriceOld() > $product->getPrice()){
                                echo '<small class="card-text text-secondary"><s>$'.$product->getPriceOld().'</s></small>';
                            }
                        ?>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <form action="remove_product.php" method="post" class="w-100">
                        <input type="hidden" name="image_url" value="<?= $product->getImgUrl() ?>">
                            <button name="id" value="<?= $product->getId() ?>" class="btn btn-danger w-100">Remove</button>
                        </form>
                        <form action="" method="post" class="w-100">
                            <button class="btn btn-secondary w-100">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>