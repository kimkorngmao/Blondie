<?php
session_start();
include('connection.php');

if(isset($_GET['order_id'])){

            //change order_status to paid

            $order_id=$_GET['order_id'];
            $order_status="paid";
            $user_id=$_SESSION['user_id'];
            $payment_date= date('Y-m-d H:i:s');

            $stmt=$conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
            $stmt->bind_param('si',$order_status , $order_id);

            $stmt->execute();


            //store payment info in database
            $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,payment_date)
                                    VALUES(?,?,?);");

            $stmt1->bind_param('iis',$order_id,$user_id,$payment_date);

            $stmt1->execute();




            //go to user account

            header('location: ../account.php?payment_message=paid successfully, thanks for your shopping with us');

}else{
    header('location: index.php');
    exit;
}







?>