<?php
/**
 * Created by PhpStorm.
 * User: 38403
 * Date: 2018/5/28
 * Time: 15:44
 */
$db = new mysqli("localhost","root","psw010105","artstoredb");
function insertUser($name,$email,$psw,$tel,$address,$balance){
    global $db;
    $query = "INSERT INTO users VALUES(NULL,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssssd',$name,$email,$psw,$tel,$address,$balance);
    $stmt->execute();
//    echo "insert user data successfully";
}
function deleteUser($userID){
    global $db;
    $query = "DELETE FROM users WHERE userID = $userID";
    $stmt = $db->prepare($query);
    $stmt->execute();
//    echo "delete user data successfully";
}
function isExist($name){
    global $db;
    $query = "SELECT name FROM users WHERE name = $name";
    $stmt = $db->prepare($query);
    while ($stmt->fetch()){
        return true;
    }
    return false;
}
//insertUser("jed","123@dd.com","opopop","12345678998","kdah",1000);
//$name = "";
//$email = "";
//$psw = "";
//$tel = "";
//$address = "";
//$balance = 1000;
?>