<?php
include('layouts/header.php');
?>
<?php

include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $user_email = $_SESSION['user_email'];

  //if password don't match
  if ($password !== $confirmPassword) {
    header("location: account.php?error=Password don't match");

    //if password less than 6 char
  } else if (strlen($password) < 6) {
    header("location: account.php?error=Password must be at least 6 charachters");

    //no error
  } else {

    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', md5($password), $user_email);

    if ($stmt->execute()) {
      header('location: account.php?message=password has been updated successfully');
    } else {
      header('location: account.php?error=can not update password');
    }
  }
}

//get orders
if (isset($_SESSION['logged_in'])) {

  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders where user_id=?");

  $stmt->bind_param('i', $user_id);

  $stmt->execute();

  $orders = $stmt->get_result();
}
?>

<!-- Account -->
<section class="my-5 py-5">
  <div class="row container mx-auto">
    <?php if (isset($_GET['payment_message'])) { ?>
      <p class="mt-5 text-center" style="color:green;"><?php echo $_GET['payment_message']; ?></p>
    <?php } ?>
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <h3 class="font-weight-bold">Account Info.</h3>
      <hr class="mx-auto">
      <div class="account-info">
        <p>Name <span><?php if (isset($_SESSION['user_name'])) {
                        echo $_SESSION['user_name'];
                      }  ?></span></p>
        <p>Email <span><?php if (isset($_SESSION['user_email'])) {
                          echo $_SESSION['user_email'];
                        }  ?></span></p>
        <p><a href="#orders" id="order-btn">Your Order</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Log Out</a></p>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color:red"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                  } ?></p>
        <p class="text-center" style="color:green"><?php if (isset($_GET['message'])) {
                                                      echo $_GET['message'];
                                                    } ?></p>
        <h3>Change Password</h3>
        <hr class="mx-auto">
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" name="password" id="account-password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="account-confirm-password" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Order -->
<section id="orders" class="order container my-5 py-3">
  <div class="container mt-2">
    <h2 class="font-weight-bolde text-center">Your Orders</h2>
    <hr class="mx-auto">
  </div>
  <table class="mt-5 pt-5 text-center">
    <tr>
      <th>Order ID</th>
      <th>Order Cost</th>
      <th>Order Status</th>
      <th>Order Date</th>
      <th>Order Details</th>
    </tr>
    <tr>

      <?php while ($row = $orders->fetch_assoc()) { ?>

        <td>
          <span><?php echo $row['order_id']; ?></span>
        </td>
        <td>
          <span>$<?php echo $row['order_cost']; ?></span>
        </td>
        <td>
          <span><?php echo $row['order_status']; ?></span>
        </td>

        <td>
          <span><?php echo $row['order_date']; ?></span>
        </td>

        <td>
          <form action="order-details.php" method="POST">
            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
            <input type="hidden" value="<?php echo $row['order_id']; ?> " name="order_id">
            <input class="btn order-details-btn" name="order_details_btn" type="submit" value="Detail">
          </form>
        </td>
    </tr>

  <?php } ?>
  </table>

</section>














<?php
include('layouts/footer.php');
?>