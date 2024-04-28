<?php

  session_start();

  include('connection.php');


  //if user is not logged in
  if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;
    //if user is logged in
  }else{



  

  if(isset($_POST['place_order'])){
    //1. Get user info. and store it in database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $user_id = $_SESSION['user_id']; // Assuming you have a way to get the actual user ID
    $order_date = date('Y-m-d H:i:s');

    $stmt= $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES(?,?,?,?,?,?,?)");
    $datatype = "dsissss";
    $stmt->bind_param($datatype ,$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

    $stmt_status=$stmt->execute();

    if(!$stmt_status){
      header('location: index.php');
      exit;
    }


    //2.Issue new order and store order info. in database
   $order_id=$stmt->insert_id;
   $stmt->close();
   
  
  }





    //3. get product from cart (from session)

    foreach($_SESSION['cart'] as $key=>$value){
      $product = $_SESSION['cart'][$key]; //[return array]
      $product_id = $product['product_id'];
      $product_name = $product['product_name'];
      $product_price = $product['product_price'];
      $product_image = $product['product_image'];
      $product_quantity= $product['product_quantity'];


      //4. Store each single item in order_items in database
      $stmt1=$conn->prepare("INSERT INTO order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
      VALUES(?,?,?,?,?,?,?,?)");
      $datatype1='iissidis';
      $stmt1->bind_param($datatype1,$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);
      $stmt1->execute();
    }



  

    //5. Remove everythings from cart -->Delay until payment is done
    // unset($_SESSION['cart']);


    $_SESSION['order_id']=$order_id;


    //6. inform user weather everything is fine or there is a problem

    header('location: ../payment.php?order_status=order placed successfully');






  //}

}
?>