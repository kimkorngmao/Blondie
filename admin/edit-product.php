<?php include('header.php'); ?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products  WHERE product_id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
} else if (isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];
    $color = $_POST['color'];
    $category = $_POST['category'];


    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=? , product_price=?, 
                                product_special_offer=? , product_color=?, product_category=? WHERE product_id=?");
    $stmt->bind_param('ssssssi', $title, $description, $price, $offer, $color, $category, $product_id);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Product has been updated successfully');
    } else {
        header('location: products.php?edit_failure_message=error occured, Please try again');
    }
} else {
    header('product.php');
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

            <h2 class="text">Edit Products</h2>
            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="edit-form" method="POST" action="edit-product.php">
                        <p class="text-center" style="color:red;">
                            <?php if (isset($_GET['error'])) {
                                echo $_GET['error'];
                            } ?>
                        </p>


                        <?php foreach ($products as $product) { ?>
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <div class="form-group mt-2">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']; ?> " name="title" placeholder="Title" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Description</label>
                                <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']; ?>" name="description" placeholder="Description" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Price</label>
                                <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']; ?>" name="price" placeholder="Price" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Category</label>
                                <select name="category" id="" class="form-select" require>
                                    <option value="perfumes">Perfumes</option>
                                    <option value="clothes">Clothes</option>
                                    <option value="bags">Bags</option>
                                    <option value="shoes">Shoes</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Color</label>
                                <input type="text" class="form-control" id="product-color" value="<?php echo $product['product_color']; ?>" name="color" placeholder="Product Color" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Special Offer /Sale</label>
                                <input type="text" class="form-control" id="product-offer" value="<?php echo $product['product_special_offer']; ?>" name="product_special_offer" placeholder="Product Special Offer" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-secondary edit" name="edit_btn" value="Update">
                            </div>

                    </form>
                <?php } ?>
                </div>

            </div>




            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
            </body>

            </html>