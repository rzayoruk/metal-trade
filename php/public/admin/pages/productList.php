<?php

use App\Controllers\Admin\ProductController;

$productController = new ProductController;
$products = $productController->getAllProduct();

?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Product</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="category_add.php" class="btn btn-info btn-xl">Add Category</a><br><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <!-- <th>Image</th> -->
                                    <th>Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= $productController->getBranch($product["category_id"]) ?></td>
                                        <!-- <td><img src="" style="width:50px; aspect-ratio:1/1; object-fit:cover;" alt=""></td> -->
                                        <td><?= $product["title"] ?></td>
                                        <td><a href="product_edit.php?id=<?= $product["id"] ?>">Edit</a> </td>
                                        <td><a href="/../includes/product-delete.php?id=<?= $product["id"] ?>" onclick="return confirm('Are you sure to delete product?')">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->