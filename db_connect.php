<?php
$host = "localhost";
$dbuser = "root";
$dbpsw = "psw010105";
$cnn = new mysqli($host,$dbuser,$dbpsw,'artstoredb');
$cnn->set_charset('UTF-8');
$cnn->query("SET character_set_client=utf8");
$cnn->query("SET character_set_results=utf8");
if ($cnn->connect_errno){
    echo '<p>Error: Could not connect to database.<br/>Please try again later</p>';
    exit();
}
function getConnect(){
    global $cnn;
    return $cnn;
}
?>