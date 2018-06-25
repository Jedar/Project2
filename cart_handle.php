<?php require_once 'carts_fns.php';?>
<?php require_once 'artworks_fns.php';?>
<?php require_once 'users_fns.php';?>
<?php require_once 'orders_fns.php';?>
<?php include_once 'messages_fns.php';?>
<?php
session_start();
$artworkID = isset($_POST['artworkID'])?intval($_POST['artworkID']):"";
$artworkArr = isset($_POST['artworkArr'])?$_POST['artworkArr']:"";
$optype = isset($_POST['optype'])?$_POST['optype']:'none';
$userID = $_SESSION['userID'];
$errorType = 0;
try{
    if ($optype === 'insert'||$optype === 'delete'){
        if (!$artworkID){
            $errorType = 1;
            throw new Exception('wrong artwork ID');
        }
        if (!isExist_in_artworks($artworkID)){
            $errorType = 2;
            throw new Exception('wrong artwork ID');
        }
    }
    switch ($optype){
        case 'insert':
            if (isExist_in_carts($userID,$artworkID)){
                $errorType = 3;
                throw new Exception('artwork has been in your cart');
            }
            if (insert_carts($userID,$artworkID)){
                print json_encode([
                    'success'=>true,
                    'message'=>'success'
                ]);
            }
            break;
        case 'delete':
            if (!isExist_in_carts($userID,$artworkID)){
                $errorType = 4;
                throw new Exception('artwork not in your cart');
            }
            if (delete($userID,$artworkID)){
                print json_encode([
                    'success'=>true,
                    'message'=>'success',
                    'totalPrice'=>getCartPrice($userID)
                ]);
            }
            break;
        case 'payAll':
            $cartNum = intval($_POST['number']);
            $cart = getCart($userID);
            if (!$cartNum == count($cart)){
                $errorType = 11;
                throw new Exception('wrong cart item number');
            }
            $artworkArr = array();
            foreach ($cart as $value){
                array_push($artworkArr,$value['artworkID']);
            }
        case 'pay':
            if (!$artworkArr){
                $errorType = 1;
                throw new Exception('wrong artwork arrow');
            }
            $totalPrice = 0;
            foreach ($artworkArr as $id){
                if (isOrdered(intval($id))){
                    print json_encode([
                        'success'=>false,
                        'errorType'=>6,
                        'message'=>'artwork has been bought',
                        'artworkID'=>$id
                    ]);
                    exit();
                }else{
                    $totalPrice+=getPrice($id);
                }
            }
            $balance = getBalance($userID);
            if ($balance < $totalPrice){
                $errorType = 7;
                throw new Exception('not enough money');
            }
            $balance -=$totalPrice;
            if (!setBalance($userID,$balance)){
                $errorType = 8;
                throw new Exception('occur an set balance error');
            }
            $_SESSION['balance']-=$totalPrice;
            $orderID = insert_orders($userID,$totalPrice);
            if (!$orderID){
                $errorType = 9;
                throw new Exception('occur an insert error');
            }
            foreach ($artworkArr as $id){
                $owner = getOwner($id);
                setBalance($owner,getBalance($owner)+getPrice($id));
                if (!setOwner($id,$orderID)){
                    $errorType = 10;
                    throw new Exception('occur an insert error');
                }else{
                    delete($userID,$id);
                    $list = get_liker($id);
                    $artwork = getArtwork($id);
                    $message = '尊敬的用户，</br>您上传的艺术品'.$artwork['title'].'已经被'.$_SESSION['name'].'收藏家购买。</br>';
                    sendMessage(1,$owner,$message);
                    foreach ($list as $value){
                        $message = '尊敬的用户，</br>很抱歉您购物车中的艺术品'.$artwork['title'].'已经被其他收藏家购买。</br>希望您下次能及时购买。';
                        sendMessage(1,$value['userID'],$message);
                        delete($value['userID'],$id);
                    }
                }
            }
            print json_encode([
                'success'=>true,
                'totalPrice'=>getCartPrice($userID),
                'message'=>'success'
            ]);
            break;
        case 'none':
            $errorType = 5;
            throw new Exception('wrong post message');
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