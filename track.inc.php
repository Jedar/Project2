<?php
if (!isset($_SESSION['track'])){
    $_SESSION['track'] = array();
    $_SESSION['track_type'] = array();
}

if (isset($_GET['track_index'])){
    $trackIndex = intval($_GET['track_index']);
    if ($trackIndex < 0){
        $trackIndex = 0;
    }
    if ($trackIndex >= count($_SESSION['track'])){
        $trackIndex = count($_SESSION['track']) - 2;
    }
    array_splice($_SESSION['track_type'],$trackIndex+1);
    array_splice($_SESSION['track'],$trackIndex+1);
} elseif ($pagetype >= 0){
    if (count($_SESSION['track_type']) == 0||$pagetype != $_SESSION['track_type'][count($_SESSION['track_type'])-1]){
        $get = "";
        if (strlen($_SERVER['QUERY_STRING']) == 0){
            $get = '?track_index='.count($_SESSION['track']);
        }
        else{
            $get = '&track_index='.count($_SESSION['track']);
        }
        array_push($_SESSION['track_type'],$pagetype);
        array_push($_SESSION['track'],$_SERVER['REQUEST_URI'].$get);
    }
}
$track = $_SESSION['track'];
$track_type = $_SESSION['track_type'];
function getTrack(){
    global $track,$track_type;
    $trackArr = ['首页','详情页面','搜索','购物车','个人页面','发布页面','邮件页面','聊天室'];
    echo '<div id="track-div"><ul class="track nav">
            <li class="arrow">您的足迹： </li>';
    for ($i = 0; $i < count($track); $i++){
        if ($i < count($track)-1){
            echo '<li><a href="'.$track[$i].'" class="nav-link">'.$trackArr[$track_type[$i]].'</a></li>';
            echo '<li class="arrow"><i class="fa fa-arrow-right"></i></li>';
        }
        else{
            echo '<li><a class="nav-link">'.$trackArr[$track_type[$i]].'</a></li>';
        }
    }
    echo '</ul></div>';
}
?>