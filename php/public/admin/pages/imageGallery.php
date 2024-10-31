<?php
include "..//../../autoloader.php";

use App\Controllers\Admin\ImageGalleryController;

$obj = new ImageGalleryController;

$productId = $_GET["productId"];
// var_dump($productId);
// exit;
$images = $obj->getAllImage($productId);

?>


<!-- Main content -->
<section class="content">
    <h1 style="text-align:center;">Add New Image</h1>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action='../includes/image-gallery-add.php?productId=<?= $_GET['productId'] ?>' method="post" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="title">
                            </div>


                            <div class="form-group">
                                <label for="">Image :</label> <label width="20"></label>
                                <img id="imagePreview" style="max-width:150px; aspect-ratio:1/1; object-fit: cover;" src="" alt=""><br> <br>
                                <div class="input-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="prodImg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Gallery Images</h2>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>imageId</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($images as $image): ?>
                                    <tr>
                                        <td class="imageId"><?= $image["image_id"] ?></td>
                                        <td class="productName"><?= $image["product_title"] ?></td>
                                        <td class="image">

                                            <img class="galleryPreview" style="display:inline; max-width:50px; aspect-ratio:1/1; object-fit: cover;" src="<?= "../images/" . $image["image"] ?>" alt="">
                                            <input type="file" class="imageInput" style="display:none; width:100%;">
                                        </td>

                                        <td class="imageTitle">
                                            <p><?= $image["image_title"] ?></p>
                                        </td>

                                        <td>
                                            <div class="">
                                                <a onclick="editRow(this)" style="cursor:pointer;" class="editIcon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" width=40>
                                                        <path style="fill:#e4eaf8" d="M411.422 82.267H26.894c-10.113 0-18.311 8.198-18.311 18.311v384.528c0 10.113 8.198 18.311 18.311 18.311h384.528c10.113 0 18.311-8.198 18.311-18.311V100.578c0-10.113-8.199-18.311-18.311-18.311z" />
                                                        <path style="fill:#5b5d6e" d="m472.158 13.947 25.895 25.895c7.15 7.152 7.15 18.746 0 25.896L265.456 298.335a36.597 36.597 0 0 1-14.315 8.846l-40.698 13.566-19.192-19.192 13.566-40.698a36.628 36.628 0 0 1 8.846-14.314l232.6-232.596c7.15-7.151 18.744-7.151 25.895 0z" />
                                                        <path style="fill:#707487" d="M200.847 311.153 485.106 26.894l12.948 12.947c7.15 7.152 7.15 18.746 0 25.896L265.456 298.335a36.597 36.597 0 0 1-14.315 8.846l-40.698 13.566-9.596-9.594z" />
                                                        <path style="fill:#c7cfe2" d="m455.629 108.162-51.79-51.79 42.425-42.425c7.152-7.152 18.745-7.152 25.895 0l25.895 25.895c7.15 7.152 7.15 18.746 0 25.896l-42.425 42.424z" />
                                                        <path style="fill:#afb9d2" d="m429.733 82.267-25.895-25.895 42.425-42.425c7.152-7.152 18.745-7.152 25.895 0l12.948 12.947-55.373 55.373z" />
                                                        <path style="fill:#959cb5" d="m265.816 297.975-.36.36a36.597 36.597 0 0 1-14.315 8.846l-68.605 22.282 22.281-68.604a36.628 36.628 0 0 1 8.846-14.314l.361-.361 51.792 51.791z" />
                                                        <path style="fill:#afb9d2" d="m182.536 329.464 57.384-57.384 25.895 25.895-.361.36a36.6 36.6 0 0 1-14.314 8.846l-68.604 22.283z" />
                                                        <path transform="rotate(-134.999 440.456 71.532)" style="fill:#464655" d="M403.834 53.222h73.242V89.84h-73.242z" />
                                                        <path transform="rotate(134.999 453.408 84.49)" style="fill:#5b5d6e" d="M435.097 66.18h36.618v36.621h-36.618z" />
                                                        <path d="M429.733 183.549a8.583 8.583 0 0 0-8.583 8.583v18.31a8.583 8.583 0 0 0 17.166 0v-18.31a8.583 8.583 0 0 0-8.583-8.583zM429.733 238.482a8.583 8.583 0 0 0-8.583 8.583v238.041c0 5.364-4.364 9.728-9.728 9.728H26.894c-5.364 0-9.728-4.364-9.728-9.728V100.578c0-5.364 4.364-9.728 9.728-9.728h238.041a8.583 8.583 0 0 0 0-17.166H26.894C12.065 73.684 0 85.749 0 100.578v384.528C0 499.935 12.065 512 26.894 512h384.528c14.83 0 26.894-12.065 26.894-26.894V247.065a8.583 8.583 0 0 0-8.583-8.583zM301.558 90.85h18.31a8.583 8.583 0 0 0 0-17.166h-18.31a8.583 8.583 0 0 0 0 17.166z" />
                                                        <path d="M512 52.789c0-7.184-2.798-13.938-7.877-19.017L478.228 7.877C473.148 2.798 466.395 0 459.21 0c-7.185 0-13.938 2.798-19.017 7.877L207.596 240.475a45.413 45.413 0 0 0-10.921 17.67l-23.162 69.485a8.583 8.583 0 0 0 10.857 10.856l69.485-23.162a45.431 45.431 0 0 0 17.669-10.92L504.122 71.807c5.08-5.08 7.878-11.833 7.878-19.018zm-59.264 46.126-39.652-39.652 13.757-13.757 39.652 39.652-13.757 13.757zM265.815 285.836l-39.652-39.652L400.946 71.402l39.652 39.652-174.783 174.782zm-70.588 30.937 17.734-53.2a27.997 27.997 0 0 1 1.908-4.407l37.965 37.965a27.904 27.904 0 0 1-4.407 1.908l-53.2 17.734zM491.984 59.668 478.632 73.02 438.98 33.368l13.352-13.352a9.663 9.663 0 0 1 6.878-2.85 9.663 9.663 0 0 1 6.879 2.85l25.895 25.895c1.837 1.837 2.85 4.28 2.85 6.879s-1.013 5.04-2.85 6.878z" />
                                                    </svg>
                                                </a>

                                                <svg style="display:none; cursor:pointer; margin-right:16px;" class="updateBttn" onclick="update(this)" width=40 version="1.1" id="Icon_Set" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64" xml:space="preserve">
                                                    <style>
                                                        .st1 {
                                                            fill: #263238
                                                        }
                                                    </style>
                                                    <path class="st1" d="M4 32.5a.5.5 0 0 1-.5-.5C3.5 16.285 16.285 3.5 32 3.5a.5.5 0 0 1 0 1C16.836 4.5 4.5 16.836 4.5 32a.5.5 0 0 1-.5.5zM35 4.5h-1a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1zM32 60.5a.5.5 0 0 1 0-1c15.163 0 27.5-12.336 27.5-27.5a.5.5 0 0 1 1 0c0 15.715-12.785 28.5-28.5 28.5zM30 60.5h-1a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1z" />
                                                    <path class="st1" d="M32 56.5C18.491 56.5 7.5 45.509 7.5 32S18.491 7.5 32 7.5c13.51 0 24.5 10.991 24.5 24.5S45.51 56.5 32 56.5zm0-48C19.042 8.5 8.5 19.042 8.5 32S19.042 55.5 32 55.5 55.5 44.958 55.5 32 44.958 8.5 32 8.5z" />
                                                    <path d="M32 14c-9.941 0-18 8.059-18 18s8.059 18 18 18 18-8.059 18-18-8.059-18-18-18z" style="fill:#4db6ac" />
                                                    <path class="st1" d="M32 50.5c-10.201 0-18.5-8.299-18.5-18.5S21.799 13.5 32 13.5 50.5 21.799 50.5 32 42.201 50.5 32 50.5zm0-36c-9.649 0-17.5 7.851-17.5 17.5S22.351 49.5 32 49.5 49.5 41.649 49.5 32 41.649 14.5 32 14.5zM53 6.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z" />
                                                    <path class="st1" d="M51 8.5a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 1 0v4a.5.5 0 0 1-.5.5zM60 13h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z" />
                                                    <path class="st1" d="M58 15a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v4a.5.5 0 0 1-.5.5z" />
                                                    <g>
                                                        <path d="M28.995 39.864c-.384 0-.768-.146-1.061-.439l-6.718-6.717a1.5 1.5 0 1 1 2.121-2.121l5.657 5.657 11.667-11.667a1.5 1.5 0 1 1 2.121 2.121L30.056 39.424c-.293.293-.677.44-1.061.44z" style="fill:#fff" />
                                                        <path class="st1" d="M28.995 40.364a1.986 1.986 0 0 1-1.414-.586l-6.718-6.717a1.983 1.983 0 0 1-.586-1.414c0-.534.208-1.036.586-1.414.756-.756 2.072-.756 2.828 0l5.304 5.303 11.313-11.313c.756-.756 2.072-.756 2.828 0 .378.377.586.88.586 1.414s-.208 1.037-.586 1.414L30.409 39.778c-.378.378-.88.586-1.414.586zm-6.718-9.718c-.267 0-.518.104-.707.293s-.293.44-.293.707.104.518.293.707l6.718 6.717a1.023 1.023 0 0 0 1.414 0L42.43 26.343a.997.997 0 0 0 0-1.414 1 1 0 0 0-1.414 0L29.349 36.596a.5.5 0 0 1-.707 0l-5.657-5.657a.997.997 0 0 0-.708-.293z" />
                                                    </g>
                                                </svg>

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="display:none; cursor:pointer;" width=24 class="cancelBttn" onclick="cancel(this)">
                                                    <g data-name="5.Cancel">
                                                        <path d="M12 24a12 12 0 1 1 12-12 12.013 12.013 0 0 1-12 12zm0-22a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2z" />
                                                        <path d="m7.292 8.707 1.415-1.414 8 8-1.414 1.414z" />
                                                        <path d="m7.292 15.293 8-8 1.415 1.414-8 8z" />
                                                    </g>
                                                </svg>

                                            </div>

                                        </td>
                                        <td><a href="/../includes/image-gallery-delete.php?imageId=<?= $image["image_id"] ?>&productId=<?= $image["product_id"] ?>" onclick="return confirm('Are you sure to delete product?')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" width=40>
                                                    <path style="fill:#afb9d2" d="M427.435 74.773a17.69 17.69 0 0 0-17.164-13.401H101.729a17.69 17.69 0 0 0-17.163 13.401l-5.497 21.985h8.847l16.59 381.559c.618 14.195 12.306 25.388 26.514 25.388h249.964c14.209 0 25.896-11.191 26.514-25.388l16.59-381.559h8.847l-5.5-21.985z" />
                                                    <path style="fill:#959cb5" d="M212.715 478.317 202.48 96.757H88.299l16.205 381.559c.618 14.195 12.306 25.388 26.514 25.388h98.442c-8.974-.001-16.357-11.192-16.745-25.387z" />
                                                    <path d="M450.625 88.466h-11.219l-3.926-15.703a25.95 25.95 0 0 0-25.211-19.684h-86.367l-9.753-29.261A34.787 34.787 0 0 0 281.104 0h-50.208a34.79 34.79 0 0 0-33.046 23.818l-9.753 29.261H101.73a25.95 25.95 0 0 0-25.211 19.685l-3.926 15.702H61.374a8.294 8.294 0 0 0 0 16.588h18.599L96.218 478.68c.813 18.684 16.099 33.321 34.8 33.321h249.963a34.762 34.762 0 0 0 34.8-33.321l16.246-373.626h18.599a8.294 8.294 0 1 0-.001-16.588zM213.586 29.063a18.225 18.225 0 0 1 17.311-12.476h50.208a18.222 18.222 0 0 1 17.309 12.476l8.006 24.016H205.582l8.004-24.016zM92.611 76.787a9.385 9.385 0 0 1 9.119-7.12h308.543c4.32 0 8.07 2.928 9.119 7.119l2.919 11.68H89.69l2.921-11.679zm306.598 401.172a18.207 18.207 0 0 1-18.228 17.453H131.018a18.207 18.207 0 0 1-18.228-17.453L96.577 105.053h318.846l-16.214 372.906z" />
                                                    <path d="M255.999 467.764a8.294 8.294 0 0 0 8.294-8.294V140.996a8.294 8.294 0 0 0-16.588 0V459.47a8.295 8.295 0 0 0 8.294 8.294zM335.389 467.764l.234.003a8.294 8.294 0 0 0 8.286-8.064l7.372-265.4a8.295 8.295 0 0 0-16.581-.46l-7.373 265.4a8.297 8.297 0 0 0 8.062 8.521zM343.744 166.974l.234.003a8.294 8.294 0 0 0 8.286-8.064l.491-17.691a8.293 8.293 0 0 0-8.06-8.52c-4.547-.128-8.393 3.481-8.52 8.06l-.491 17.691a8.293 8.293 0 0 0 8.06 8.521zM175.659 433.484a8.292 8.292 0 0 0-8.06 8.52l.491 17.698a8.293 8.293 0 1 0 16.58-.459l-.491-17.698a8.279 8.279 0 0 0-8.52-8.061zM174.902 414.681a8.293 8.293 0 0 0 8.294-8.523l-7.373-265.396c-.127-4.578-3.973-8.174-8.52-8.06a8.292 8.292 0 0 0-8.06 8.52l7.373 265.396a8.293 8.293 0 0 0 8.286 8.063z" />
                                                </svg></a></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                        <script>
                            function editRow(editIcon) {
                                let cancelButtons = document.getElementsByClassName("cancelBttn");

                                for (cnclBttn of cancelButtons) { //we couldn't reach element of HTMLCollection with foreach like an array.
                                    cnclBttn.style.display !== "none" ? cancel(cnclBttn) : false;
                                }

                                let row = editIcon.closest("tr");


                                titleElem = row.querySelector(".imageTitle");
                                pTag = titleElem.querySelector("p"); // image title in p tag
                                let text = pTag.textContent;
                                pTag.style.display = "none";

                                // Create the input element
                                if (!row.querySelector(".imageTitleInput")) {
                                    const input = document.createElement('input');
                                    input.className = 'imageTitleInput';
                                    input.name = 'imageTitle';
                                    input.style.width = '100%';
                                    input.type = 'text';
                                    input.value = text;
                                    titleElem.appendChild(input);
                                } else {
                                    input = row.querySelector(".imageTitleInput");
                                    input.value = text;
                                    input.style.display = "inline";
                                }

                                //
                                editIcon.style.display = "none";
                                row.querySelector(".imageInput").style.display = "inline"; //fileInput
                                row.querySelector(".updateBttn").style.display = "inline";
                                row.querySelector(".cancelBttn").style.display = "inline";
                            }

                            function cancel(cancelIcon) {
                                let row = cancelIcon.closest("tr");
                                pTag = row.querySelector("p");

                                const input = row.querySelector(".imageTitleInput");
                                input.style.display = "none";


                                //imgPreview
                                const imageInput = row.querySelector(".imageInput");
                                imageInput.value = "";

                                //console.log(imageInput)

                                if (imageInput.previousElementSibling) {
                                    imageInput.previousElementSibling.style.display = "inline";
                                }

                                if (imageInput.nextElementSibling) {
                                    imageInput.nextElementSibling.style.display = "none";
                                }



                                row.querySelector(".editIcon").style.display = "inline";
                                pTag.style.display = "block";
                                row.querySelector(".updateBttn").style.display = "none";
                                row.querySelector(".imageInput").style.display = "none"; //fileInput
                                cancelIcon.style.display = "none";
                            }

                            function update(updateIcon) {

                                const row = updateIcon.closest('tr');
                                const imageInput = row.querySelector(".imageInput"); // image
                                const imageTitle = row.querySelector(".imageTitleInput").value;


                                const url = new URL(window.location.href)
                                const params = new URLSearchParams(url.search)
                                productId = params.get("productId")
                                imageId = row.querySelector(".imageId").textContent

                                let formData = new FormData();
                                formData.append("title", imageTitle);
                                formData.append("imageId", imageId);
                                formData.append("productId", productId);

                                if (imageInput.files[0]) {
                                    formData.append("prodImg", imageInput.files[0])
                                }

                                fetch("../includes/image-gallery-update.php", {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => {
                                        if (response.status == 200) {
                                            return response.json();
                                        } else {
                                            console.log("Status code : " + response.status)
                                        }
                                    })
                                    .then(result => {
                                        console.log(result)
                                        if (result.imageName) {

                                            const preview = row.querySelector(".galleryPreview");
                                            preview.src = "../images/" + result.imageName
                                        }

                                        const titleTd = row.querySelector(".imageTitle")
                                        const pTag = titleTd.querySelector("p");
                                        pTag.textContent = result.title;

                                        const cnclBttn = row.querySelector(".cancelBttn");
                                        cancel(cnclBttn);

                                    });

                            }

                            const fileInputs = document.querySelectorAll(".imageInput")
                            fileInputs.forEach(fileInput => {
                                fileInput.addEventListener('change', function() {
                                    const file = this.files[0];

                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            // Find the sibling <img> element
                                            const originPreview = fileInput.previousElementSibling;


                                            if (originPreview.style.display !== "none") {
                                                originPreview.style.display = "none";
                                            }

                                            if (!fileInput.nextElementSibling) {
                                                const jsPreview = document.createElement('img');
                                                jsPreview.style.width = "50px";
                                                jsPreview.className = 'jsPreview';
                                                jsPreview.name = 'jsPreview';
                                                jsPreview.src = e.target.result; // Update the image source
                                                originPreview.parentElement.appendChild(jsPreview);
                                            } else {
                                                const existedJsPreview = fileInput.nextElementSibling;
                                                existedJsPreview.src = e.target.result;
                                            }
                                            // imagePreview.src = e.target.result; // Update the image source


                                        };
                                        reader.readAsDataURL(file);

                                        // Update the label with the file name
                                        const label = document.querySelector(`label[for="${this.id}"]`);
                                        label.textContent = file.name;
                                    }
                                });

                            })
                        </script>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->