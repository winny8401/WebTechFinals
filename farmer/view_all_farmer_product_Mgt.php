<?php include "./inculdes/farmer_header.php" ?>

<?php
global $database;

if (isset($_POST['submit'])) {
    $product = new Product();
    $product->categories = $_POST['product_cat'];
    $product->product_name = $_POST['product_title'];
    $product->product_price = $_POST['product_price'];
    $product->product_price = $_POST['product_price'];
    $product->product_keywords = $_POST['product_keywords'];
    $product->image = $database->escape_string($_FILES['image']['name']);
    $post_image_temp = $database->escape_string($_FILES['image']['tmp_name']);
    $product->product_description = $_POST['product_desc'];

    move_uploaded_file($post_image_temp, "../admin/images/$product->image");
    $product->create();
}
?>

<body>
    <!-- Side Bar -->
    <!-- End Side Bar -->
    <!-- Page wrapper  -->
    <?php include "./inculdes/farmer_navigation.php" ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <h2>Product & Category Management</h2>
                <p>Here you can add your products!</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="card-body">
                    <h4 class="card-title">View_Product Management</h4>
                    <div class="table-responsive">


                        <?php $products = Product::find_by_query("SELECT * FROM proudct WHERE usr_id = $session->id");

                        ?>

                        <section id="category">
                            <!-- Side Bar -->


                            <div class="page-wrapper">


                                <div class="row">

                                    <h4>Categories Overview</h4>
                                    <p>Below is a list of all categories available on AgriConnect.</p>
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product price</th>
                                                <th scope="col">Product Description</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Product Keyword</th>

                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Category Rows will be populated here -->
                                            <!-- Example static row: -->
                                            <?php foreach ($products as $product) : ?>

                                                <tr>

                                                    <td><?php echo $product->id ?></td>
                                                    <td><?php echo $product->categories ?> </td>
                                                    <td><?php echo $product->product_name ?> </td>
                                                    <td><?php echo $product->product_price ?> </td>
                                                    <td><?php echo $product->product_description ?> </td>
                                                    <td><?php echo $product->contact ?> </td>
                                                    <td><img src="<?php echo $product->image ?>" width="200px">
                                                    </td>
                                                    <td><?php echo $product->product_keywords ?> </td>
                                                    <td>
                                                        <!-- <a href="./actions/edit_product_Mgt_.php?id=<?php echo $product->id ?>"
                                                   class="btn btn-primary">Edit</a> -->
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn myBtn btn-primary" id="<?php echo $product->id ?>" data-toggle="modal" data-target="#modelId">
                                                            Edit
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" method="post" id="updateFrom" enctype="multipart/form-data">

                                                                            <div class="form-group">
                                                                                <label for="product-cat">Category:</label>
                                                                                <input type="text" class="form-control" id="product-cat" name="product_cat" placeholder="Enter Category" value="<?php echo $product->categories ?> ">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product-title">Product Name:</label>
                                                                                <input type="text" class="form-control" id="product-title" name="product_title" placeholder="Enter Product Name" value="<?php echo $product->product_name ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product-price">Price:</label>
                                                                                <input type="number" step="0.01" class="form-control" id="product-price" name="product_price" placeholder="Enter Product Price" value="<?php echo $product->product_price ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product-desc">Description:</label>
                                                                                <textarea class="form-control" id="product-desc" name="product_desc" placeholder="Enter Product Description">
<?php echo $product->product_description ?>
</textarea>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="product-image">Image:</label>
                                                                                <img src="../../admin/uploads/<?php echo $product->image ?>" width="200px" alt="">
                                                                                <input type="file" class="form-control" id="product-image" name="image">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product-keywords">Contact:</label>
                                                                                <input type="text" class="form-control" id="product-keywords" name="contact" value="<?php echo $product->contact ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product-keywords">Keywords:</label>
                                                                                <input type="text" class="form-control" id="product-keywords" name="product_keywords" placeholder="Enter Product Keywords" value="<?php echo $product->product_keywords ?>">
                                                                            </div>
                                                                            <!-- <input type="submit" name="submit" value="Update Product"
       class="btn btn-primary"> -->                                             <input type="hidden" name="id" id="id">
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <div class="alert text-success"></div>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                         
                                                                        <input type="button" value="Update" class="myUpdate btn btn-primary">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- More rows added here dynamically via server-side scripting or JavaScript -->
                                        </tbody>
                                    </table>
                                    <a class="btn btn-primary" href="farmer_product_Mgt.php">Add New Product </a>
                                </div>
                            </div>
                    </div>
                </div>
                </section>


            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <?php

    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        print_r($_POST);
    }

    ?>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
    <script>
        $('.myBtn').click(function(e) {
            e.preventDefault();
            
            var id = $(this).attr('id');
            document.getElementById('id').value= id
            if ($("#updateFrom")[0].checkValidity()) {
                $('.myUpdate').click(function(e) {
                    e.preventDefault();
                    $(".myUpdate").val('Please wait... ');
                    $.ajax({
                        url: 'handle_edit.php',
                        method: 'post',
                        data: $("#updateFrom").serialize() + '&action=update',
                        success: function(response) {
                            $(".myUpdate").val('Update');
                            $(".alert").text(response);
                        }
                    });
                });
            }

        });
    </script>
</body>

</html>