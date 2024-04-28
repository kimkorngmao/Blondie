<?php include('header.php') ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

?>

<?php
//1. determine page number
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {

    //if user has already entered page then page number is the one that they are selected
    $page_no = $_GET['page_no'];
} else {

    //if user just entered the page then default page is 1
    $page_no = 1;
}

//2.return number of orders
$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();


//3.product per page
$total_records_per_page = 5;

$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;

$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_page = ceil($total_records / $total_records_per_page);

//4. get all orders
$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");

$stmt2->execute();
$products = $stmt2->get_result();







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

            <h2 class="text">Products</h2>
            <?php if (isset($_GET['edit_success_message'])) { ?>
                <p class="text-center" style="color:green;"><?php echo $_GET['edit_success_message']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['edit_failure_message'])) { ?>
                <p class="text-center" style="color:red;"><?php echo $_GET['edit_failure_message']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['product_created'])) { ?>
                <p class="text-center" style="color:green;"><?php echo $_GET['product_created']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['product_failed'])) { ?>
                <p class="text-center" style="color:red;"><?php echo $_GET['product_failed']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['deleted_successfully'])) { ?>
                <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['deleted_failure'])) { ?>
                <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failure']; ?></p>
            <?php } ?>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>

                            <th scope="col">Product ID</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Offer</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Color</th>

                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>

                                <td><?php echo $product['product_id']; ?></td>
                                <td><img src="<?php echo "../assets/imgs/" . $product['product_image']; ?>" alt="" style="width:70px; height:70px;"></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo "$" . $product['product_price']; ?></td>
                                <td><?php echo $product['product_special_offer'] . "%"; ?></td>
                                <td><?php echo $product['product_category']; ?></td>
                                <td><?php echo $product['product_color']; ?></td>

                                <td><a class="btn btn-secondary edit" href="edit-product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                                <td><a class="btn btn-danger delete" href="delete-product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>







                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-5 mx-auto">

                        <li class="page-item <?php if ($page_no <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link edit" href="<?php if ($page_no <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo '?page_no=' . ($page_no -
                                                                    1);
                                                            } ?>">Previous</a>
                        </li>

                        <li class="page-item"><a class="page-link " href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link " href="?page_no=2">2</a></li>

                        <?php if ($page_no >= 3) { ?>
                            <li class="page-item"><a class="page-link " href="#">...</a></li>
                            <li class="page-item"><a class="page-link " href="<?php echo "?page_no=" . $page_no; ?>"><?php echo
                                                                                                                    $page_no; ?></a></li>
                        <?php } ?>

                        <li class="page-item <?php if ($page_no >= $total_no_of_page) {
                                                    echo 'disabled';
                                                }  ?>">
                            <a class="page-link edit" href="<?php if ($page_no >= $total_no_of_page) {
                                                                echo '#';
                                                            } else {
                                                                echo '?
page_no=' . ($page_no + 1);
                                                            } ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>