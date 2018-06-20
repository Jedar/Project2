<?php include_once 'messages_fns.php';?>
<?php include_once 'users_fns.php';?>

<?php
session_start();
$userID = $_SESSION['userID'];
$errorType = "";
$type = (isset($_POST['type']))?$_POST['type']:"";
try{
    switch ($type){
        case 'send':
            $receiver = $_POST['receiver'];
            $receiverID = getUserID($receiver);
            if (!$receiverID){
                $errorType = 1;
                throw new Exception('收件人不存在');
            }
            $content = $_POST['content'];
            $isSend = sendMessage($userID,$receiverID,$content);
            if ($isSend){
                print json_encode([
                    'success'=>true
                ]);
            }else{
                $errorType = 2;
                throw new Exception('An error occurs when send message');
            }
            break;
        case 'delete':
            $messageID = intval($_POST['messageID']);
            $isDelete = deleteMessage($messageID);
            if ($isDelete){
                print json_encode([
                    'success'=>true
                ]);
            }else{
                $errorType = 3;
                throw new Exception('An error occurs when delete message');
            }
            break;
        case 'read':
            $messageID = intval($_POST['messageID']);
            $isRead = readMessage($messageID);
            if ($isRead){
                print json_encode([
                    'success'=>true
                ]);
            }else{
                $errorType = 3;
                throw new Exception('An error occurs when check message');
            }
    }
}catch (Exception $e){
    print json_encode([
        'success'=>false,
        'errorType'=>$errorType,
        'message'=>$e->getMessage()
    ]);
}
?>