<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 2;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php include 'artworks_fns.php';?>
<?php
$result = getSearchResult(0);
$pageNum = $result['pageNum'];
$numOfItems = $result['numOfItems'];
$result=$result['pageInfo'];
?>
<main>
    <h2 class="page-title">搜索结果:</h2>
    <div class="sortbar">
        <form method="get" action="" name="sort">
            <p>排序方式 &nbsp;
                价格:<input type="radio" name="sort" value="price" class="sort">
                热度:<input type="radio" name="sort" value="view" class="sort">
                标题:<input type="radio" name="sort" value="title" class="sort"></p>
        </form>
    </div>
    <div class="item-box" id="item-box">
        <?php
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
            <p>'.getIntroduction($row['description']).'</p>
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
            echo '<li class="page-item'.(($pageNum == 1)?' disabled':'').'"><a class="page-link" data-target="up">Next</a></li>'
            ?>
        </ul>
    </div>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
