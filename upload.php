<?php require 'db_connect.php';?>
    <!DOCTYPE html>
    <html lang="en">
<?php $pagetype = 5;?>
<?php include_once 'head.inc.php'; ?>
<body>
<?php include_once 'nav.inc.php'; ?>
<?php include_once'artworks_fns.php';?>
<?php
$isUpdate = false;
$userID = (isset($_SESSION['userID']))?$_SESSION['userID']:false;
if (isset($_GET['upload_item'])){
    $_SESSION['upload_item'] = $_GET['upload_item'];
    $row = getArtwork(intval($_GET['upload_item']));
    if (count($row) > 0){
        $isUpdate = true;
    }
}else{
    unset($_SESSION['upload_item']);
}

?>
<main class="container">
    <form method="post" action="upload_handle.php" class="upload-form" enctype="multipart/form-data">
        <fieldset class="card">
            <legend class="card-header">UPLOAD YOUR ARTWORK</legend>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <?php
                    if ($isUpdate){
                        echo '<input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="'.$row['title'].'">';
                    }else{
                        echo '<input type="text" class="form-control" name="title" id="title" placeholder="Enter title">';
                    }
                    ?>
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="form-group">
                    <label for="artist">Artist:</label>
                    <?php
                    if ($isUpdate){
                        echo '<input type="text" class="form-control" name="artist" id="artist" placeholder="Enter artist" value="'.$row['artist'].'">';
                    }else{
                        echo '<input type="text" class="form-control" name="artist" id="artist" placeholder="Enter artist">';
                    }
                    ?>
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <?php
                            if ($isUpdate){
                                echo '<input type="text" class="form-control" name="genre" id="genre" placeholder="Enter genre" value="'.$row['genre'].'">';
                            }else{
                                echo '<input type="text" class="form-control" name="genre" id="genre" placeholder="Enter genre">';
                            }
                            ?>
                            <div class="alert alert-warning hidden"></div>
                        </div>
                        <div class="form-group">
                            <label for="year">Year Of Artwork:</label>
                            <?php
                            if ($isUpdate){
                                echo '<input type="number" class="form-control" name="year" id="year" placeholder="Enter year" min="-3000" max="2018" step="1" value="'.$row['yearOfWork'].'">';
                            }else{
                                echo '<input type="number" class="form-control" name="year" id="year" placeholder="Enter year" min="-3000" max="2018" step="1">';
                            }
                            ?>
                            <div class="alert alert-warning hidden"></div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2 border border-primary rounded">
                        <div class="form-group">
                            <label for="width">Width:</label>
                            <?php
                            if ($isUpdate){
                                echo '<input min="0" type="number" class="form-control" name="width" id="width" placeholder="Enter width" value="'.$row['width'].'">';
                            }else{
                                echo '<input min="0" type="number" class="form-control" name="width" id="width" placeholder="Enter width">';
                            }
                            ?>
                            <div class="alert alert-warning hidden"></div>
                        </div>
                        <div class="form-group">
                            <label for="height">Height:</label>
                            <?php
                            if ($isUpdate){
                                echo '<input min="0" type="number" class="form-control" name="height" id="height" placeholder="Enter height" value="'.$row['height'].'">';
                            }else{
                                echo '<input min="0" type="number" class="form-control" name="height" id="height" placeholder="Enter height">';
                            }
                            ?>
                            <div class="alert alert-warning hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <?php
                    if ($isUpdate){
                        echo '<textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description">'.$row['description'].'</textarea>';
                    }else{
                        echo '<textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description"></textarea>';
                    }
                    ?>
                    <div class="alert alert-warning hidden"></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="price">Price:</label>
                        <?php
                        if ($isUpdate){
                            echo '<input min="0" step="1" type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="'.$row['price'].'">';
                        }else{
                            echo '<input min="0" step="1" type="number" class="form-control" name="price" id="price" placeholder="Enter price">';
                        }
                        ?>
                        <div class="alert alert-warning hidden"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="imageFile">Image File:</label>
                        <?php
                        if ($isUpdate){
                            echo '<input type="file" class="form-control" name="imageFile" id="imageFile" value="resources/img/'.$row['imageFileName'].'">';
                        }else{
                            echo '<input type="file" class="form-control" name="imageFile" id="imageFile">';
                        }
                        ?>
                        <div class="alert alert-warning hidden"></div>
                    </div>
                    <div class="card bg-light offset-md-1">
                        <div class="card-header">Preview Image</div>
                        <?php
                        if ($isUpdate){
                            echo '<img id="img-preview" class="card-img" alt="preview image" src="resources/img/'.$row['imageFileName'].'">';
                        }else{
                            echo '<img id="img-preview" class="card-img" alt="preview image" src="">';
                        }
                        ?>
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
