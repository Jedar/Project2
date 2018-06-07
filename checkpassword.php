<?php include 'db_psw.php'; ?>
<?php
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
$cnn = new mysqli($host,$dbuser,$dbpsw,'artstoredb');

if ($cnn->connect_errno){
    echo '<p>Error: Could not connect to database.<br/>Please try again later</p>';
}
try{
    $userName = $_POST['user-name'];
    $userPsw = $_POST['user-psw'];
    $query = "SELECT * FROM users WHERE name = '$userName' AND password = '$userPsw'";
    $result = $cnn->query($query);
    if ($row = $result->fetch_assoc()){
        $_SESSION['isSigned'] = true;
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['balance'] = $row['balance'];
        $_SESSION['tel'] = $row['tel'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['address'] = $row['address'];
        
    }
}
catch (Exception $e){
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>