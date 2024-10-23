<?php

use App\Controllers\Admin\CategoryController;

$categoryCont = new CategoryController;
$categories = $categoryCont->getAllCategory();

?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Categories</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= $categoryCont->getBranch($category["parent_id"], $category["title"]) ?></td>
                                        <td><img src="<?= "images/" . $category["image"] ?>" style="width:50px; aspect-ratio:1/1; object-fit:cover;" alt=""></td>
                                        <td><?= $category["title"] ?></td>
                                        <td><a href="category_edit.php?id=<?= $category["id"] ?>">Edit</a> </td>
                                        <td><a href="/../includes/category-delete.php?id=<?= $category["id"] ?>" onclick="return confirm('Are you sure to delete category?')">Delete</a></td>
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