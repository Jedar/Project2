<?php include 'db_connect.php'; ?>
<?php
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
$cnn = getConnect();
try{
    if (isset($_POST['name'])&&isset($_POST['psw'])&&isset($_POST['email'])&&isset($_POST['tel'])&&isset($_POST['address'])){
        $userName = $_POST['name'];
        $userPsw = $_POST['psw'];
        $userEmail = $_POST['email'];
        $userTel = $_POST['tel'];
        $userAddress = $_POST['address'];
        $userBalance = 0;
        if (!($userName&&(strlen($userName)>5)&&(!preg_match('/^[0-9]*$/',$userName))&&(!preg_match('/^[a-zA-Z]*$/',$userName)))){
            throw new Exception('wrong user name!');
        }
        if (!($userPsw&&(strlen($userPsw)>5)&&($userPsw != $userName))){
            throw new Exception('wrong password!');
        }
        if (!($userEmail&&(preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/',$userEmail)))){
            throw new Exception('wrong email!');
        }
        if (!$userTel){
            throw new Exception('empty email!');
        }
        if (!$userAddress){
            throw new Exception('empty address!');
        }
        $query = "SELECT * FROM users WHERE name='$userName'";
        $result = $cnn->query($query);
        $row = $result->fetch_assoc();
        if ($row){
            print json_encode([
                'success'=>false,
                'message'=>'repetitive user name',
                'type'=>'name'
            ]);
        }
        else{
            $query = "INSERT INTO users VALUES(NULL,?,?,?,?,?,?)";
            $stmt = $cnn->prepare($query);
            $stmt->bind_param('sssssd',$userName,$userEmail,$userPsw,$userTel,$userAddress,$userBalance);
            $stmt->execute();
            if ($stmt->affected_rows > 0){
                $_SESSION['isSigned'] = true;
                //userID not included
                $_SESSION['name'] = $userName;
                $_SESSION['balance'] = 0;
                $_SESSION['tel'] = $userTel;
                $_SESSION['email'] = $userEmail;
                $_SESSION['address'] = $userAddress;
                print json_encode([
                    'success'=>true,
                    'message'=>'register successfully'
                ]);
            }
            else{
                throw new Exception('fail to register, please try again later');
            }
        }
    }
    else{
        throw new Exception('wrong input!');
    }
}
catch (Exception $e){
    print json_encode([
        'success'=>false,
        'message'=>$e->getMessage(),
        'type'=>'error',
        'error'=>$e->getMessage()
    ]);
}
?>