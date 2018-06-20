<?php
session_start();
try{
    if ($_SESSION["isSigned"]){
        $_SESSION["isSigned"] = false;
        unset($_SESSION['userID'],$_SESSION['name'],$_SESSION['balance'],$_SESSION['tel'],$_SESSION['email'],$_SESSION['address']);
        $turnPage = (count($_SESSION['track'])>=1)?$_SESSION['track'][count($_SESSION['track'])-1]:"home.php";
        if (count($_SESSION['track'])>=1){
            $turnPage = $_SESSION['track'][count($_SESSION['track'])-1];
            if ($_SESSION['track_type'][count($_SESSION['track'])-1] > 2){
                $turnPage = 'home.php';
            }
        }else{
            $turnPage = 'home.php';
        }
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