<?php include('layouts/header.php'); ?>

<?php

if (isset($_POST['order_pay_btn'])) {
  $order_status = $_POST['order_status'];
  $order_total_price =  $_POST['order_total_price'];
}
?>








<!-- Payment -->

<section class="my-5 py-5">
  <div class="container text-center mt3 pt-3">
    <h2 class="font-weight-bold">Payment</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto container text-center">


    <?php if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
      <?php // $amount= strval($_POST['order_total_price']); 
      ?>
      <?php $order_id = $_POST['order_id']; ?>
      <p>Total Payment:$ <?php echo $_POST['order_total_price']; ?></p>
      <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->
      <div id="paypal-button-container">
        <button id="pay-button">Pay Here with Your Card</button>
      </div>



    <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
      <?php // $amount= strval($_SESSION['total']) ;
      ?>
      <?php $order_id = $_SESSION['order_id']; ?>
      <p>Total Payment: $<?php echo $_SESSION['total']; ?></p>
      <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->
      <div id="paypal-button-container">
        <button id="pay-button">Pay Here with Your Card</button>
      </div>




    <?php } else { ?>
      <p style="color:palevioletred;">Hey you don't have any order yet!</p>

    <?php  } ?>






  </div>
</section>








<script>
  document.getElementById("pay-button").addEventListener("click", function() {
    alert("Are you sure want to pay?");
    window.location.href = "server/complete-payment.php?order_id=" + <?php echo $order_id ?>;
  });
</script>


<?php include('layouts/footer.php'); ?>