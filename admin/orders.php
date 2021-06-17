<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Orders</title>
</head>
<body>
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/admin/partials/header.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/OrdersRepository.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/ClientsRepository.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Order.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
    ?>

    <div class="container border border-dark rounded p-4">
        <?php
            foreach(OrdersRepository::getAll() as $order){
        ?>
            <div class="container border m-2">
                <button class="btn btn-dark rounded-0 p-0 px-1 float-left mr-3 mt-1" data-toggle="collapse" data-target="#order_details_<?= $order->getId() ?>">
                <i class="fas fa-plus"></i></button><h3><?= $order->getId() ?> | client: <?= $order->getClientId() ?>: <?= ClientsRepository::getById($order->getClientId())->getFullName() ?> | at: <?= $order->getDate() ?></h3>
                <div class="" id="order_details_<? $order->getId() ?>">
                <?php
                        foreach(OrdersRepository::getItems($order->getId()) as $item){
                ?>
                        <h5><?= $item->getName() ?></h5>

                <?php
                    }
                ?>
                </div>
            </div>
        <?php
            }

        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>