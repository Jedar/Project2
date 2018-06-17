<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 6;?>
<?php include_once 'head.inc.php'; ?>
<body>
<?php include_once 'nav.inc.php'; ?>
<?php include_once 'messages_fns.php';?>
<?php
$userID = $_SESSION['userID'];

$list = getMessageList($userID);
?>
<main class="container">
    <div class="navbar row" id="main-message">
        <ul class="navbar-nav nav nav-pills bg-light col-md-3">
            <li class="nav-item">
                信息列表：
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#send">Send to</a>
            </li>
            <?php
            foreach ($list as $value){
                echo '<li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#'.$value['messageID'].'">'.$value['name']." -> ".$value['sendTime'].'</a>
            </li>';
            }
            ?>
        </ul>
        <div class="tab-content col-md-8 offset-md-1 border border-primary">
            <div class="tab-pane active container" id="send">
                <textarea class="form-control" placeholder="your message" rows="10"></textarea>
                <button class="btn btn-primary">Send</button>
            </div>
            <?php
            foreach ($list as $value){
                echo '<div class="tab-pane container" id="'.$value['messageID'].'"><div class="div-message">'.$value['content'].'</div></div>';
            }
            ?>
        </div>
    </div>
</main>

<?php require 'foot.inc.php';?>
</body>
</html>
