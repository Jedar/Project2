<?php
session_start();
try{
    if ($_SESSION["isSigned"]){
        $_SESSION["isSigned"] = false;
        unset($_SESSION['userID'],$_SESSION['name'],$_SESSION['balance'],$_SESSION['tel'],$_SESSION['email'],$_SESSION['address']);
        $turnPage = ($_SESSION['pagetype'] >= 3);
        $_SESSION = array();
        print json_encode([
            'success'=>true,
            'turnpage'=>$turnPage,
            'message'=>"log out successfully"
        ]);
    }
    else{
        print json_encode([
            'success'=>false,
            'message'=>"user does not log in, please login first"
        ]);
    }
}
catch (Exception $e){
    print json_encode([
        'success' => false,
        'message' =>"fail to log out, please try again later",
        'error' => $e->getMessage()
    ]);
}
?>