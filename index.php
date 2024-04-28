<?php
include('layouts/header.php');
?>

<!-- Home -->
<section id="home">
  <div class="container">
    <h5>NEW ARRIVALS</h5>
    <h1><span>Best Price</span> this season</h1>
    <p>Eshop offers the best products for the most affordable price</p>

  </div>
</section>

<!-- Brand -->
<section id="brand" class="container">
  <div class="row">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.jpg" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.jpg" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.jpg" />
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.jpg" />
  </div>
</section>

<!-- New -->

<section id="new" class="w-100">
  <div class="row p-0 m-0">

    <!-- One -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/1.jpg" />
      <div class="detail">
        <h2>Exstreamely Awesome Bag</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>


    <!-- Two -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/2.jpg" />
      <div class="detail">
        <h2>Awesome Shoe</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>


    <!-- Three -->

    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.jpg" />
      <div class="detail">
        <h2>50% OFF Jackets</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>
  </div>
</section>

<!-- Perfume -->
<section id="feature" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Perfume</h3>
    <hr class="mx-auto">
    <p>Here you can check out our feature products</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get-feature-product.php')  ?>


    <?php while ($row = $featured_products->fetch_assoc()) { ?>


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
        <a href="<?php echo "single-product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>

    <?php } ?>
  </div>
</section>

<!-- Banner -->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>MID SEASON'S SALE</h4>
    <h1>Autumn Clollection <br>Up to 30% OFF</h1>
    <button class="text-uppercase">Shop Now</button>
  </div>
</section>



<!-- Clothes -->
<section id="clothes" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Dresses & Coats</h3>
    <hr class="mx-auto">
    <p>Here you can check out our amazing clothes</p>
  </div>
  <div class="row mx-auto container-fluid">


    <?php include('server/get-coats.php') ?>

    <?php while ($row = $coats_products->fetch_assoc()) { ?>

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
        <a href="<?php echo "single-product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>


    <?php  }   ?>
  </div>
</section>


<!-- Bags -->


<section id="bags" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Best Bag</h3>
    <hr class="mx-auto">
    <p>Check out our amazing Bags</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get-bags.php'); ?>
    <?php while ($row = $bag->fetch_assoc()) { ?>
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
        <a href="<?php echo "single-product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>

    <?php  } ?>

  </div>
</section>


<!-- Shoes -->
<section id="shoes" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Shoes</h3>
    <hr class="mx-auto">
    <p>Here you can check out our amazing Shoes</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('server/get-shoes.php'); ?>
    <?php while ($row = $shoes->fetch_assoc()) { ?>
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
        <a href="<?php echo "single-product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php  } ?>
  </div>
</section>


<?php
include('layouts/footer.php');
?>