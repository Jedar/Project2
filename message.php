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
                echo '<li class="nav-item">';
                if ($value['isRead'] == 0){
                    echo '<i class="fa fa-envelope-o"></i>';
                }else{
                    echo '<i class="fa fa-envelope-open-o"></i>';
                }
                echo '<a data-read="'.$value['isRead'].'" data-id="'.$value['messageID'].'" class="nav-link message-mark" data-toggle="pill" href="#'.$value['messageID'].'">'.$value['name']." -> ".$value['sendTime'].'</a>';
                echo '</li>';
            }
            ?>
        </ul>
        <div class="tab-content col-md-8 offset-md-1 border border-primary">
            <div class="tab-pane active container" id="send">
                <label for="receiver">收件人:</label>
                <input type="text" class="form-control" id="receiver" name="receiver">
                <br>
                <textarea class="form-control" placeholder="your message" rows="10" id="content"></textarea>
                <br>
                <button class="btn btn-primary float-right" id="bt-send-message">Send</button>
            </div>
            <?php
            foreach ($list as $value){
                echo '<div class="tab-pane container" id="'.$value['messageID'].'"><div class="div-message"><div class="message-content">'.$value['content'].'</div> <button class="btn btn-danger float-right bt-delete-message" data-id="'.$value['messageID'].'">删除</button></div></div>';
            }
            ?>
        </div>
    </div>
</main>

<?php require 'foot.inc.php';?>
</body>
</html>
