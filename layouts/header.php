<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top">
        <div class="container">
          <img class="logo" src="assets/imgs/logo.png" alt="">
          <h2 class="brand">Blondie</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-
target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-
label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>


              <li class="nav-item">
                <a href="cart.php">
                  <i class="fa-solid fa-cart-shopping">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){?>
                          <span​ style=" background-color: palevioletred;
                                        color: #fff;
                                        padding: 2px 5px;
                                        border-radius: 50%;
                                        margin: -5px;
                                        font-size:10px;">
                      <?php echo $_SESSION['quantity']; ?></span>
                      <?php } ?>
                </i></a>
                <a href="account.php"><i class="fa-solid fa-user mx-2"></i></a>
              </li>
             
              
            </ul>
          </div>
        </div>
      </nav>    
      