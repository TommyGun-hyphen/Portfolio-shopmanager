<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Shop</title>
</head>
<body>
    <header>
        <?php
        require_once('config/ProductsRepository.php');
            require_once('config/ProductsRepository.php');
            include_once('partials/header.php'); 
         ?>
    </header>
    <h1 class="text-center mb-4">FEATURED PRODUCTS</h1>
    <div class="container justify-content-center border border-dark rounded-0 " style="background:#191516">
    
        <div class="row justify-content-center">
        
        <?php
            
            foreach(ProductsRepository::getFeatured(4) as $product){
            ?>
            
                    <div class="col col-sm-4 col-md-3 col-6 my-3">
                        <div class="card my-2 mx-sm-2 rounded" style="background:#BBC7A4">
                            <div class="d-flex justify-content-center py-1"><img class="justify-self-center" style="max-width:97%;" src="<?= $product->getImgUrl() ?>" ></div>
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title"> <?= $product->getName() ?> </h3>
                                <?php
                                    if($product->getPriceOld() > $product->getPrice()){
                                        echo '<small class="card-text text-secondary"><s>$'.$product->getPriceOld().'</s></small>';
                                    }
                                ?>
                                <p class="card-text font-weight-bold">$<?= $product->getPrice() ?></p>
                                    <!-- <submit class="btn btn-primary" onclick="addToCart()">Add to cart</submit> -->
                                
                            </div>
                            <form action="add_to_cart.php" method="POST" class="w-100 p-0 m-0">
                                    <button class="btn w-100  text-white" style="background:#E54B4B" name="product[id]" value="<?= $product->getId() ?>">Add to cart</button>
                                </form>
                        </div>
                    </div>
            
        <?php
            }
        ?>
        
        </div>
    </div>





    <?php
        include_once('partials/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        // $("div").on('click', "addToCart", function(){
        //     alert('click');
        //     $ajax.({
        //         url:"add_to_cart.php",
        //         method:"POST",
        //         data:{id:$(this).val(),
        //         beforeSend:function(){
        //             alert('sent');
        //         },
        //         success::function(result){
        //             alert(result);
        //         }
        //         }
        //     });
        // });

    </script>
</body>
</html>