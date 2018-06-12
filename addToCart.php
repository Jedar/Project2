<?php require 'carts_fns.php';?>
<?php require 'artworks_fns.php';?>
<?php
session_start();
$artworkID = isset($_POST['artworkID'])?intval($_POST['artworkID']):"";
$userID = $_SESSION['userID'];
$errorType = 0;
try{
    if (!$artworkID){
        $errorType = 1;
        throw new Exception('wrong artwork ID');
    }
    if (!isExist_in_artworks($artworkID)){
        $errorType = 2;
        throw new Exception('wrong artwork ID');
    }
    if (isExist_in_carts($userID,$artworkID)){
        $errorType = 3;
        throw new Exception('artwork has been in your cart');
    }
    if (insert($userID,$artworkID)){
        print json_encode([
            'success'=>true,
            'message'=>'success'
        ]);
    }
}
catch (Exception $e){
    print json_encode([
        'success'=>false,
        'errorType'=>$errorType,
        'message'=>$e->getMessage()
    ]);
}
?>