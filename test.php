<?php require_once 'artworks_fns.php';?>
<?php
print json_encode([
    'success'=>true,
    'count'=>count($_POST)
    ])
?>