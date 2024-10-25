<?php

require __DIR__ . "/../../../../autoloader.php";

use App\Controllers\Admin\ProductController;

$obj = new ProductController;

$parentId = null;
$depth = 1;
$arr = [];
$id = $_GET["id"];

$product =  $obj->bringDataForEdit($id);


?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Products</h1>
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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="../includes/product-update.php" method="post" enctype="multipart/form-data">

                        <div class="card-body">

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select2" style="width: 100%;" name="categoryId">
                                    <?php $obj->getAllCategoryWithTree($parentId, $depth, $arr, $id);
                                    ?>
                                </select>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="id">id</label>
                                <input type="text" class="form-control" name="id" value="<?= $id ?>">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?= $product["title"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <input type="text" class="form-control" placeholder="Enter keywords" name="keywords" value="<?= $product["keywords"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" placeholder="Enter description" name="description" value="<?= $product["description"] ?>">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" style="max-width: max-content;" name="status">
                                    <option value="1" <?= $product["status"] == true ? "selected" : " "; ?>>True</option>
                                    <option value="0" <?= $product["status"] == false ? "selected" : " "; ?>>False</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Slug</label>
                                <input type="text" class="form-control" placeholder="Enter slug for SEO" name="slug" value="<?= $product["slug"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" placeholder="quantity" name="quantity" value="<?= $product["quantity"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Min. Quantity</label>
                                <input type="number" class="form-control" placeholder="minquantity" name="minquantity" value="<?= $product["minquantity"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" placeholder="price" name="price" value="<?= $product["price"] ?>">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->