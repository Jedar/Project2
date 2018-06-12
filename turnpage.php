<?php
include 'artworks_fns.php';
session_start();
try{
    $pageIndex = (isset($_POST['pageIndex']))?intval($_POST['pageIndex']):0;
    $message = (isset($_POST['message']))?$_POST['message']:"1";
    switch ($message){
        case 'up':
            $pageIndex++;
            break;
        case 'down':
            $pageIndex--;
            break;
        case '':
            throw new Exception('nothing in message');
        default:
            $pageIndex = intval($message);
    }
    $result = getSearchResult($pageIndex);
    $pageInfo = $result['pageInfo'];
    print json_encode([
        'success'=>true,
        'pageIndex'=>$pageIndex,
        'pageInfo'=>$pageInfo,
        'numOfItems'=>$result['numOfItems'],
        'pageNum'=>$result['pageNum']
    ]);
}
catch (Exception $e){
    print json_encode([
        'success'=>false,
        'message'=>$e->getMessage()
    ]);
}
?>