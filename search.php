<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 2;?>
<?php include_once 'head.inc.php'; ?>
<body>
<?php include_once 'nav.inc.php'; ?>
<?php include_once 'artworks_fns.php';?>
<?php
$result = getSearchResult(0);
$pageNum = $result['pageNum'];
$numOfItems = $result['numOfItems'];
$result=$result['pageInfo'];
$sort = (isset($_GET['sort']))?$_GET['sort']:"";
?>
<main>
    <h2 class="page-title">搜索结果:</h2>
    <div class="sortbar">
        <form method="get" action="" name="sort">
            <?php
            switch ($sort){
                case "":
                    echo '<p>排序方式:
                  价格:<input type="radio" name="sort" value="price" class="sort">
                热度:<input type="radio" name="sort" value="view" class="sort">
                标题:<input type="radio" name="sort" value="title" class="sort"></p>';break;
                case "price":
                    echo '<p>排序方式:
                  价格:<input type="radio" name="sort" value="price" class="sort" checked>
                热度:<input type="radio" name="sort" value="view" class="sort">
                标题:<input type="radio" name="sort" value="title" class="sort"></p>';break;
                case "view":
                    echo '<p>排序方式:
                  价格:<input type="radio" name="sort" value="price" class="sort">
                热度:<input type="radio" name="sort" value="view" class="sort" checked>
                标题:<input type="radio" name="sort" value="title" class="sort"></p>';break;
                case "title":
                    echo '<p>排序方式:
                  价格:<input type="radio" name="sort" value="price" class="sort">
                热度:<input type="radio" name="sort" value="view" class="sort">
                标题:<input type="radio" name="sort" value="title" class="sort" checked></p>';break;
            }
            ?>
        </form>
    </div>
    <div class="item-box" id="item-box">
        <?php
        if ($numOfItems == 0){
            echo '<h3 class="alert alert-info">抱歉，没有搜索到任何有关的艺术品</h3>';
        }
        for ($i = 0; $i < $numOfItems; $i++){
            $row=$result[$i];
            echo '<div class="item">
            <figure>
                <a href="detail.php?itemID='.$row['artworkID'].'"><img src="resources/img/'.$row['imageFileName'].'"></a>
            </figure>
            <div class="item-name">
                <h3>'.$row['title'].'</h3>
                <p>'.$row['artist'].'</p>
            </div>
            <p>'.$row['description'].'</p>
            <div>
                <a class="item-button" href="detail.php?itemID='.$row['artworkID'].'">查看</a>
                <a class="item-button" href="#">热度<span class="heat-number">'.$row['view'].'</span> </a>
            </div>
        </div>';
        }
        ?>
    </div>
    <div class="paging-div row justify-content-center">
        <ul class="pagination col-md-4" data-index="0" id="search-pagination">
            <?php
            echo '<li class="page-item disabled"><a class="page-link" data-target="down">Previous</a></li>';
            if ($pageNum < 6){
                for ($i = 0; $i < $pageNum ; $i++){
                    echo '<li class="page-item'.(($i == 0)?' active':'').'"><a class="page-link" data-target="'.$i.'">'.($i+1).'</a></li>';
                }
            }
            else{
                for ($i = 0; $i < 5 ; $i++){
                    echo '<li class="page-item'.(($i == 0)?' active':'').'"><a class="page-link" data-target="'.$i.'">'.($i+1).'</a></li>';
                }
                echo '<li class="page-item"><a class="page-link" data-target="5">...</a></li>';
                echo '<li class="page-item"><a class="page-link" data-target="'.($pageNum - 1).'">'.$pageNum.'</a></li>';
            }
            echo '<li class="page-item'.(($pageNum == 1||$pageNum == 0)?' disabled':'').'"><a class="page-link" data-target="up">Next</a></li>'
            ?>
        </ul>
    </div>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
