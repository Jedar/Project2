<?php include_once 'artworks_fns.php';?>
<?php include_once 'users_fns.php';?>
<?php include_once 'messages_fns.php';?>
<?php include_once 'carts_fns.php';?>

<?php
session_start();
$artworkID = false;
$userID = $_SESSION['userID'];
$errorType = 0;
try{
    switch ($_POST['type']){
        case 'upload':
            if (isset($_SESSION['upload_item'])){
                $artworkID = intval($_SESSION['upload_item']);
            }
            $isFile = ($_POST['isFile'] === '1');
            $artist = $_POST['artist'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $yearOfWork = $_POST['year'];
            $genre = $_POST['genre'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $price = $_POST['price'];
            $imgType = "";
            if ($isFile){
                if ($_FILES["file"]["type"] == "image/gif"){
                    $imgType = "gif";
                }
                if ($_FILES["file"]["type"] == "image/jpeg"){
                    $imgType = "jpg";
                }
                if ($_FILES["file"]["type"] == "image/pjpeg"){
                    $imgType = "jpg";
                }
                if ($_FILES["file"]["type"] == "image/png"){
                    $imgType = "png";
                }
                if (!$imgType){
                    $errorType = 10;
                    throw new Exception('wrong file type');
                }
                $tempFile = $_FILES['file']['tmp_name'];
            }
            if ($artworkID){
                $pathOld = getPath($artworkID);
                if ($isFile){
                    $path = $artworkID.".".$imgType;
                }else{
                    $path = $pathOld;
                }
                $oldArtwork = getArtwork($artworkID);
                if (updateArtwork($userID,$artworkID,$artist,$title,$path,$description,$yearOfWork,$genre,$width,$height,$price)){
                    $list = get_liker($artworkID);
                    foreach ($list as $value){
                        $message = '尊敬的用户，</br>您购物车中的艺术品'.$oldArtwork['title'].'(艺术品现名：'.$title.')的部分信息已经被发布者更改。</br>请注意这些更改，以免造成不必要的损失。';
                        sendMessage(1,$value['userID'],$message);
                    }
                    print json_encode([
                        'success'=>true,
                        'type'=>'update',
                        'message'=>'finish update',
                        'artworkID'=>$artworkID
                    ]);
                    if ($isFile){
                        if (file_exists("resources/img/".$pathOld)){
                            unlink("resources/img/".$pathOld);
                        }
                        move_uploaded_file($tempFile,"resources/img/".$path);
                    }
                }
                else{
                    $errorType = 11;
                    throw new Exception('occur error when updating');
                }
            }else{
                $artworkID = insertArtwork($userID,$artist,$title,$description,$yearOfWork,$genre,$width,$height,$price,$imgType);
                if ($artworkID){
                    $path = $artworkID.".".$imgType;
                    if (!move_uploaded_file($tempFile,"resources/img/".$path)){
                        $errorType = 12;
                        throw new Exception('occur error when move image');
                    }
                    print json_encode([
                        'success'=>true,
                        'type'=>'insert',
                        'message'=>'finish insert',
                        'artworkID'=>$artworkID
                    ]);
                }else{
                    $errorType = 13;
                    throw new Exception('occur error when inserting');
                }
            }
            break;
        case 'delete':
            if (isset($_POST['artworkID'])){
                $artworkID = $_POST['artworkID'];
                $artwork = getArtwork($artworkID);
                if (deleteArtwork($userID,$artworkID)){
                    if (file_exists("resources/img/".$artwork['imageFileName'])){
                        unlink("resources/img/".$artwork['imageFileName']);
                    }
                    $list = get_liker($artworkID);
                    foreach ($list as $value){
                        $message = '尊敬的用户，</br>很抱歉您购物车中的艺术品'.$artwork['title'].'已经被发布者删除。</br>希望您下次能及时购买。';
                        sendMessage(1,$value['userID'],$message);
                        delete($value['userID'],$artworkID);
                    }
                    print json_encode([
                        'success'=>true,
                        'type'=>'delete',
                        'message'=>'finish delete',
                        'artworkID'=>$artworkID
                    ]);
                }else{
                    throw new Exception('fail to delete');
                }
            }
            break;
        case 'recharge':
            $number = intval($_POST['number']);
            if (recharge($userID,$number)){
                $_SESSION['balance']+=$number;
                print json_encode([
                    'success'=>true,
                    'type'=>'recharge'
                ]);
            }else{
                throw new Exception('occur error when recharge');
            }
        default:
    }
}
catch (Exception $e){
    print json_encode([
        'success'=>false,
        'errorType'=>$errorType,
        'message'=>$e->getMessage()
    ]);
}
?>