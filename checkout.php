<?php
session_start();
?>
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
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
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
    <div class="row d-flex justify-content-center">
        <div class="col col-sm-7 col-10 mx-3 my-3 border border-dark rounded">
            <h3>ORDER INFO:</h3>
            <form action="add_order.php" method="post">
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <form action="add_order.php" method="post">
                    <button class="btn btn-primary float-right my-2">Send Order</button>
                </form>
            </form>
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
                    <form action="reset_cart.php" method="post">
                        <button class="btn btn-danger mx-2 rounded-0" value="reset">Reset Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once('partials/footer.php')
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>