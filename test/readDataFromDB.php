<?php
/**
 * Created by PhpStorm.
 * User: 38403
 * Date: 2018/5/27
 * Time: 22:03
 */
$con = new mysqli('localhost','root','psw010105','artstoredb');
if ($con){
    echo 'connect successfully <br>';
}
$query = "SELECT * FROM users";
$stmt = $con->prepare($query);
$stmt->bind_result($userID,$name,$email,$psw,$tel,$add,$balance);
$stmt->execute();
while ($stmt->fetch()){
    echo "<p> id: $userID name: $name";
}
?>