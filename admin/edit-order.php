<?php include('header.php'); ?>

<?php
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders  WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();
} else if (isset($_POST['edit_order'])) {

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if ($stmt->execute()) {
        header('location: index.php?order_updated=Order has been updated successfully');
    } else {
        header('location: index.php?order_failed=error occured, Please try again');
    }
} else {
    header('index.php');
    exit;
}

?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">


        <?php include('side-menu.php') ?>


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="text">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>
            <h2 class="text">Edit Orders</h2>
            <div class="table-responsive">
                <form id="edit-order-form" method="POST" action="edit-order.php">
                    <?php foreach ($orders as $r) { ?>
                        <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {
                                                                        echo $_GET['error'];
                                                                    } ?></p>
                        <div class="form-group my-3">
                            <label for="">Order ID</label>
                            <p class="my-4"><?php echo $r['order_id']; ?></p>
                        </div>
                        <div class="form-group my-3">
                            <label for="">Order Price</label>
                            <p class="my-4"><?php echo $r['order_cost']; ?></p>
                        </div>

                        <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>">
                        <div class="form-group my-3">
                            <label for="">Order Status</label>
                            <select required name="order_status" id="" class="form-select">
                                <option value="not paid" <?php if ($r['order_status'] == 'not paid') {
                                                                echo "select";
                                                            } ?>>Not Paid</option>
                                <option value="paid" <?php if ($r['order_status'] == 'paid') {
                                                            echo "select";
                                                        } ?>>Paid</option>
                                <option value="shipped" <?php if ($r['order_status'] == 'shipped') {
                                                            echo "select";
                                                        } ?>>Shipped</option>
                                <option value="delivered" <?php if ($r['order_status'] == 'delivered') {
                                                                echo "select";
                                                            } ?>>Delivered</option>
                            </select>
                        </div>
                        <div class="form-group my-3">
                            <label for="">Order Date</label>
                            <p class="my-4"><?php echo $r['order_date']; ?></p>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-secondary edit" name="edit_order" value="Update">
                        </div>
                    <?php } ?>
                </form>


            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>