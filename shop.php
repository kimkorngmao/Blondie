<?php
session_start();
?>
<?php
include('server/connection.php');


//use the search section
if (isset($_POST['search'])) {

  //1. determine page number
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {

    //if user has already entered page then page number is the one that they are selected
    $page_no = $_GET['page_no'];
  } else {

    //if user just entered the page then default page is 1
    $page_no = 1;
  }


  $category = $_POST['category'];
  $price = $_POST['price'];
  //2.return number of products 
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
  $stmt1->bind_param('si', $category, $price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //3.product per page
  $total_records_per_page = 8;
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_page = ceil($total_records / $total_records_per_page);


  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
  $stmt2->bind_param('si', $category, $price);
  $stmt2->execute();
  $products = $stmt2->get_result(); //[]




  //return all products ->if small website
} else {


  //1. determine page number
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {

    //if user has already entered page then page number is the one that they are selected
    $page_no = $_GET['page_no'];
  } else {

    //if user just entered the page then default page is 1
    $page_no = 1;
  }

  //2.return number of products 
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  //3.product per page
  $total_records_per_page = 8;

  $offset = ($page_no - 1) * $total_records_per_page;

  $previous_page = $page_no - 1;

  $next_page = $page_no + 1;

  $adjacents = "2";

  $total_no_of_page = ceil($total_records / $total_records_per_page);

  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");

  $stmt2->execute();
  $products = $stmt2->get_result();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-
awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/style.css">


  <style>
    .product img {
      width: 100%;
      height: 300px;
      box-sizing: border-box;
      object-fit: cover;
    }

    .pagination a {
      color: rgb(255, 114, 138);
    }

    .pagination li:hover a {
      color: #fff;
      background-color: rgb(255, 114, 138);
    }

    #search {
      position: fixed;
      left: 0;
      top: -50px;
      width: 250px;

    }

    #shop {
      width: 70%
    }

    .product .buy-btn a {
      color: #fff;
      text-decoration: none;
    }

    .cart-quantity {
      background-color: palevioletred;
      color: #fff;
      padding: 2px 5px;
      border-radius: 50%;
      margin: -5px;

      font-size: 10px;
    }
  </style>


</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top">
    <div class="container">
      <img class="logo" src="assets/imgs/logo.png" alt="">
      <h2 class="brand">Blondie</h2>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs- target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria- label="Toggle navigation">
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
                <?php if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                  <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                <?php } ?>
              </i></a>
            <a href="account.php"><i class="fa-solid fa-user mx-2"></i></a>
          </li>


        </ul>
      </div>
    </div>
  </nav>



  <!-- Search -->

  <section id="search" class="my-5 py-5 ms-2 container">
    <div class="container mt-5 py-5">
      <p>Search Products</p>
      <hr>
    </div>

    <form action="shop.php" method="POST">
      <div class="row mx-auto ">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Category</p>
          <div class="form-check">
            <input class="form-check-input" value="Perfume" type="radio" name="category" id="category-one" <?php if (isset($category) && ($category == 'Perfume')) {
                                                                                                              echo 'checked';
                                                                                                            } ?>>
            <label class="form-check-label" for="flexRadioDefault1">
              Perfumes
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" value="coats" type="radio" name="category" id="category-two" <?php if (isset($category) && ($category == 'coats')) {
                                                                                                            echo 'checked';
                                                                                                          } ?>>
            <label class="form-check-label" for="flexRadioDefault2">
              Clothes
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" value="shoes" type="radio" name="category" id="category-three" <?php if (isset($category) && ($category == 'shoes')) {
                                                                                                              echo 'checked';
                                                                                                            } ?>>
            <label class="form-check-label" for="flexRadioDefault3">
              Shoes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" vlaue="bag" type="radio" name="category" id="category-four" <?php if (isset($category) && ($category == 'bag')) {
                                                                                                          echo 'checked';
                                                                                                        } ?>>
            <label class="form-check-label" for="flexRadioDefault4">
              Bags
            </label>
          </div>

        </div>
      </div>


      <div class="row mx-auto container mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Price</p>
          <input type="range" class="form-range w-60" name="price" value="<?php if (isset($price)) {
                                                                            echo $price;
                                                                          } else {
                                                                            echo '1000';
                                                                          } ?>" min="1" max="5000" id="customRange2">
          <div class="w-60">
            <span style="float:left;">$1</span>
            <span style="float:right;">$5000</span>

          </div>
        </div>
      </div>

      <div class="form-group my-3 mx-3">
        <input type="submit" name="search" value="Search" class="btn btn-primary">
      </div>
    </form>
  </section>








  <!-- Shop -->
  <section id="shop" class="container my-5 py-5 ">
    <div class="container  mt-5 py-5 ">
      <h3>Our Products</h3>
      <hr>
      <p>Here you can check out our feature products</p>
    </div>
    <div class="row mx-auto container">


      <?php while ($row = $products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <button type="button" class="buy-btn"><a href="<?php echo "single-product.php?product_id=" . $row['product_id'] ?>">Buy Now</a></button>
        </div>



      <?php } ?>






      <nav aria-label="Page navigation example">
        <ul class="pagination mt-5 mx-auto">

          <li class="page-item <?php if ($page_no <= 1) {
                                  echo 'disabled';
                                } ?>">
            <a class="page-link" href="<?php if ($page_no <= 1) {
                                          echo '#';
                                        } else {
                                          echo '?page_no=' . ($page_no - 1);
                                        } ?>">Previous</a>
          </li>

          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

          <?php if ($page_no >= 3) { ?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
          <?php } ?>

          <li class="page-item <?php if ($page_no >= $total_no_of_page) {
                                  echo 'disabled';
                                }  ?>">
            <a class="page-link" href="<?php if ($page_no >= $total_no_of_page) {
                                          echo '#';
                                        } else {
                                          echo '?page_no=' . ($page_no + 1);
                                        } ?>">Next</a>
          </li>
        </ul>
      </nav>

    </div>
  </section>



  <?php include('layouts/footer.php'); ?>