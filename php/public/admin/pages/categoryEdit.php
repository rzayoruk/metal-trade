<?php

require __DIR__ . "/../../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

$obj = new CategoryController;

$parentId = null;
$depth = 1;
$arr = [];
$id = $_GET["id"];

$categoryInfo =  $obj->bringDataForEdit($id);

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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="../includes/category-update.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control select2" style="width: 100%;" name="parentId">
                                    <option value="main">Main Category</option>
                                    <?php $obj->getAllCategoryWithTree($parentId, $depth, $arr, $id);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?= $categoryInfo["title"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <input type="text" class="form-control" placeholder="Enter keywords" name="keywords" value="<?= $categoryInfo["keywords"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" placeholder="Enter description" name="description" value="<?= $categoryInfo["description"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Image :</label> <label width="20"></label>
                                <img id="imagePreview" style="max-width:150px; aspect-ratio:1/1; object-fit: cover;" src="" alt=""><br> <br>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="catImg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" style="max-width: max-content;" name="status">
                                    <option value="1" <?= $categoryInfo["description"] == true ? "selected" : " "; ?>>True</option>
                                    <option value="0" <?= $categoryInfo["description"] == false ? "selected" : " "; ?>>False</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" placeholder="Enter slug for SEO" name="slug" value="<?= $categoryInfo["slug"] ?>">
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