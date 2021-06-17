<?php
session_start();

?>

<html lang="en" style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body">
    
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        include_once('partials/header.php');
        require_once('config/ProductsRepository.php');
    ?>
    <?php
        $products = [];
        $total_price = 0;
        foreach($_SESSION['items'] as $item_id){
            $product = ProductsRepository::getById($item_id);
            $total_price = $total_price + $product->getPrice();
            $products[] = $product;
        }


    ?>
    
    <div class="row mx-0 px-0 d-flex justify-content-center">
    
        <div class="border justify-self-center border-dark rounded-0 col col-sm-7 col-10">
        <?php
            if(empty($products)){
                echo '<h3 class="text-center">You haven\'t purchased any products yet</h3>';
            }
            foreach($products as $product){
                
        ?>
            <div class="card my-2 border border-dark rounded-0">
                <div class="row no-gutters">
                    <div class="col-4 col-sm-3">
                        <img src="<?= $product->getImgUrl() ?>" style="max-width:10rem;" class="card-img border-right border-dark">
                    </div>
                    <div class="col-7 d-flex">
                        <div class="container my-auto">
                        <form action="remove_from_cart.php" method="post">
                                <span></span>
                                <button class="btn btn-danger rounded-0 d-flex d-sm-block float-right"  name="product_id" value="<?= $product->getId() ?>"><span class="d-none d-sm-block">Remove</span><i class="fas fa-times d-sm-none d-block"></i></button>
                            </form>
                            <h5 class="card-title"><?= $product->getName() ?></h5>
                            
                            <h6 class="card-text">$<?= $product->getPrice() ?> <span class="text-muted"><i><s>$<?= $product->getPriceOld() ?></s></i></span></h6>
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>

        <div class=" col col-sm-4 mx-3 my-3 col-10">
            <div class="border border-dark rounded px-2 mx-0 ">
                <h4>price details</h4>
                <hr>
                <div class="inline">
                    <button class="btn btn-dark mr-2" data-toggle="collapse" data-target="#orderDetails"><i class="fas fa-caret-down"></i></button><strong>price (<?= count($products); ?> items):</strong>
                
                    <strong class="float-right"> $<?= $total_price; ?></strong>
                    <div class="collapse" id="orderDetails">
                            <?php
                                foreach($products as $product){
                                ?>
                                <div class="inline">
                                    <span>&ensp;&ensp;&ensp;&ensp;&ensp; <?= $product->getName() ?></span>
                                    <span class="float-right">$<?= $product->getPrice() ?></span>
                                </div>
                                <?php
                                }
                            ?>
                        </div>
                </div>
                <div class="inline">
                    <strong>Delivery charges:</strong>
                    <strong class="float-right"> FREE!</strong>
                </div>
                <hr>
                <div class="inline">
                    <strong>Total amount:</strong>
                    <strong class="float-right"> $<?= $total_price; ?></strong>
                </div>
                <div class="form-inline my-2">
                <div class="my-2 d-md-flex">
                    <form action="reset_cart.php" method="post">
                        <button class="btn btn-danger mx-2 rounded-0" value="reset">Reset Cart</button>
                    </form>
                    <div>
                    <a href="checkout.php" class="unstyled"><button class="btn btn-warning mx-2 rounded-0" value="proceed">Proceed to checkout</button></a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once('partials/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>