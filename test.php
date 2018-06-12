<?php include 'db_connect.php'?>
<?php
$cnn = getConnect();
$query = "SELECT * FROM users ORDER BY userID";
$result=$cnn->query($query);
$result->data_seek(2);
//$row=$result->fetch_row();
//echo ($row[1])."   ".($row[2]).'//';
//$result->data_seek(0);
//$row=$result->fetch_row();
//echo ($row[1])."   ".($row[2].'//');
$row=$result->fetch_assoc();
echo ($row['name'])."   ".($row['password']);
//$row=$result->fetch_assoc();
//echo ($row[1])."   ".($row[2]);
?>