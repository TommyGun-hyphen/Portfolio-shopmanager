<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background:#191516">
        <a class="navbar-brand h2 ml-3" href="home.php">Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-5">
            <li class="nav-item ml-2"><a href="index.php" class="nav-link h6 font-weight-bold">Home</a></li>
            <li class="nav-item ml-2"><a href="products.php" class="nav-link h6 font-weight-bold">Products</a></li>
            <li class="nav-item ml-2"><a href="about.php" class="nav-link h6 font-weight-bold">About</a></li>
            <li class="nav-item ml-2"><a href="contact.php" class="nav-link h6 font-weight-bold">Contact</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ml-2"><a href="home.php" class="nav-link h6 font-weight-bold"><small>report a bug</small> <i class="fas fa-bug"></i></a></li>
            <li class="nav-item ml-2"><a href="cart.php" class="nav-link h6 font-weight-bold">Cart <i class="fas fa-shopping-cart"></i> <span style="height:20px;width:20px;display:inline-block;border-radius:20px;background:white;color:black;vertical-align:middle;"> <span style="margin-left:5px;" id="products_amount"><?= (isset($_SESSION['items'])?count($_SESSION['items']):0) ?></span></span> </a></li>
        </ul>
        </div>
    
    </nav>
</header>
<div class="mt-5 pt-5"></div>