
<?php
include('../server/connection.php');
if (isset($_POST['create_product'])) {
    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_offer = $_POST['offer'];
    $product_category = $_POST['category'];
    $product_color = $_POST['color'];

    if ($_FILES['image1']['name'] != '') {
        $uploadfolder = $_SERVER['DOCUMENT_ROOT'] . '/Blondie/assets/imgs';
        $filename = $_FILES['image1']['name'];
        $image_path = $filename;
        move_uploaded_file($_FILES['image1']['tmp_name'], "$uploadfolder/$filename") or die('Could not copy file');


        //create new product
        $stmt = $conn->prepare("INSERT INTO products (product_name,product_description,product_price,product_special_offer,
                                                product_image,product_image2,product_image3,product_image4,product_category,product_color)
                                                VALUES(?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param(
            'ssssssssss',
            $product_name,
            $product_description,
            $product_price,
            $product_offer,
            $image_path,
            $image_path,
            $image_path,
            $image_path,
            $product_category,
            $product_color
        );


        if ($stmt->execute()) {
            header('location: products.php?product_created=Product has been created successfully');
        } else {
            header('location: product.php?product_failed=error occured, Please try again');
        }
    }
}

?>

<?php include('header.php'); ?>

<?php 
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
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
            <h2>Add New Product</h2>
            <div class="table-responsive">
                <form id="create-form" enctype="multipart/form-data" method="POST" action="add-product.php">
                    <p class="text-center" style="color:red;"><?php if (isset($_GET['error'])) {
                                                                    echo $_GET['error'];
                                                                } ?></p>
                    <div class="form-group mt-2">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="name" id="product-name" placeholder="Title">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" id="product-desc" placeholder="Description">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" id="product-price" placeholder="Price">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Spacial Offer/Sale</label>
                        <input type="number" class="form-control" name="offer" id="product-offer" placeholder="Sale">
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
                        <input type="text" class="form-control" name="color" id="product-color" placeholder="Color">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Image 1</label>
                        <input type="file" class="form-control" name="image1" id="image1" placehorder="Image 1" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Image 2</label>
                        <input type="file" class="form-control" name="image2" id="image2" placehorder="Image 2" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Image 3</label>
                        <input type="file" class="form-control" name="image3" id="image3" placehorder="Image 3" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Image 4</label>
                        <input type="file" class="form-control" name="image4" id="image4" placehorder="Image 4" required>
                    </div>
                    <div class="from-group mt-3">
                        <input type="submit" class="btn btn-secondary edit" name="create_product" value="Create">
                    </div>
                </form>
            </div>


        </main>
    </div>
</div>