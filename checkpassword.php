<?php include 'db_connect.php'; ?>
<?php
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
$cnn = getConnect();
try{
    $userName = $_POST['name'];
    $userPsw = $_POST['psw'];
    $query = "SELECT * FROM users WHERE name = '$userName'";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    if ($row){
        if ($userPsw === $row['password']){
            $_SESSION['isSigned'] = true;
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['balance'] = $row['balance'];
            $_SESSION['tel'] = $row['tel'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];
            print json_encode([
                'success' => true
            ]);
        }
        else{
            print json_encode([
                'success'=>false,
                'type'=>'password',
                'message'=>"wrong password"
            ]);
        }
    }
    else{
        print json_encode([
            'success'=>false,
            'type'=>'username',
            'message'=>"user does not exist"
        ]);
    }
}
catch (Exception $e){
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>