<?php
if (!isset($_SESSION['track'])){
    $_SESSION['track'] = array();
}
$trackType = ['home.php','detail.php','search.php','shoppingcart.php','userpage.php'];
if (intval($_SESSION['pagetype']) >= 0){
    array_push($_SESSION['track'],$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING']);
    //add istrack to recognize whether a track url
}
?>