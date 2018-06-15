<?php require 'db_connect.php';?>
    <!DOCTYPE html>
    <html lang="en">
<?php $pagetype = 5;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php require_once 'artworks_fns.php';?>
<main class="container">
    <form method="post" action="upload_handle.php" class="upload-form" enctype="multipart/form-data">
        <fieldset class="card">
            <legend class="card-header">UPLOAD YOUR ARTWORK</legend>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="form-group">
                    <label for="artist">Artist:</label>
                    <input type="text" class="form-control" name="artist" id="artist" placeholder="Enter artist">
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter genre">
                            <div class="alert alert-warning hidden"></div>
                        </div>
                        <div class="form-group">
                            <label for="year">Year Of Artwork:</label>
                            <input type="number" class="form-control" name="year" id="year" placeholder="Enter year" min="-3000" max="2018" step="1">
                            <div class="alert alert-warning hidden"></div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2 border border-primary rounded">
                        <div class="form-group">
                            <label for="width">Width:</label>
                            <input type="number" class="form-control" name="width" id="width" placeholder="Enter width" min="0">
                            <div class="alert alert-warning hidden"></div>
                        </div>
                        <div class="form-group">
                            <label for="height">Height:</label>
                            <input type="number" class="form-control" name="height" id="height" placeholder="Enter height" min="0">
                            <div class="alert alert-warning hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter title" min="0" step="1">
                        <div class="alert alert-warning hidden"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="imageFile">Image File:</label>
                        <input type="file" class="form-control" name="imageFile" id="imageFile">
                        <div class="alert alert-warning hidden"></div>
                    </div>
                    <div class="card bg-light offset-md-1">
                        <div class="card-header">Preview Image</div>
                        <img id="img-preview" class="card-img">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" id="bt-upload" type="button">Commit</button>
            </div>
        </fieldset>
    </form>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
