<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// include composer autoload
require_once 'vendor/autoload.php';
 
// การตั้งเกี่ยวกับ bot
require_once 'bot_settings.php';
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล 
require_once '../dbconfig.php'; 
///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
// use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
// use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
// use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
// use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
// use LINE\LINEBot\ImagemapActionBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
// use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
// use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
// use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
// use LINE\LINEBot\TemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
 
// เชื่อมต่อกับ LINE Messaging API
$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));
 
$LineBot_userID = $LineBot_groupID = $LineBot_room = '';
// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');
 
// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $message = $events['events'][0]['message']['text']; 

    if(isset($events['events'][0]['source']['userId']) ){
        $LineBot_userID = $events['events'][0]['source']['userId'];

        $response = $bot->getProfile($LineBot_userID);
        if ($response->isSucceeded()) {
            $profile = $response->getJSONDecodedBody();
            $LineBot_displayName = $profile['displayName'];
            // echo $profile['pictureUrl'];
            // echo $profile['statusMessage'];
        }

    }
    if(isset($events['events'][0]['source']['groupId'])){
        $LineBot_groupID = $events['events'][0]['source']['groupId']; 
    }
    if(isset($arrayJson['events'][0]['source']['room'])){
        $LineBot_room = $events['events'][0]['source']['room']; 
    }

    if(!empty($message)){ 
       
        $message = trim($message);
        $chk_msg_register = substr($message,0,4); 
        if ($chk_msg_register == 'KBLB' && strlen($message) == 9) {
            
            $sql = "SELECT * FROM `kb_line_bot_generate_key` WHERE generate_key ='$message' ORDER BY ID DESC";
            $result = mysqli_query($con_mysqli, $sql);
            if(!$result){
                die("MySQL Error: " . mysqli_error($con_mysqli));
            }          
        
            $row = mysqli_fetch_array($result);
            $userID = isset($row['UserID']) ? $row['UserID'] : "";
            $user_login = isset($row['user_login']) ? $row['user_login'] : "";
            $user_role = isset($row['user_role']) ? $row['user_role'] : "";
    
            if ( !empty($userID) ){
        
                $sql_regis = "SELECT * FROM kb_user_line_bot WHERE kb_userID = $userID AND LineBot_userID = '$LineBot_userID'";
                $res_regis = mysqli_query($con_mysqli, $sql_regis);
                if(!$res_regis){
                    die("MySQL Error: " . mysqli_error($con_mysqli));
                }          
        
                $rowcount=mysqli_num_rows($res_regis);
                if ($rowcount == 0){
                    $sql = "INSERT INTO kb_user_line_bot (kb_userID, kb_user_login, kb_user_role, LineBot_userID, LineBot_groupID, LineBot_room, LineBot_displayName) 
                    VALUES ('$userID','$user_login','$user_role','$LineBot_userID','$LineBot_groupID','$LineBot_room','$LineBot_displayName')";            
                    
                    $result = mysqli_query($con_mysqli, $sql); 
                    if (!$result) {
                        die('Invalid query0: ' . mysqli_error($con_mysqli));
                    } 

                    $sql = " UPDATE kb_line_bot_generate_key SET generate_key = 'yes' WHERE UserID = $userID ";            
                    $result = mysqli_query($con_mysqli, $sql); 
                    if (!$result) {
                        die('Invalid query0: ' . mysqli_error($con_mysqli));
                    } 
                  
                    $msg_txt = "สมัคร Line Bot สำเร็จ !!! \nกรุณา Login เพื่อใส่ข้อมูลส่วนตัวของท่าน https://www.klungbaan.com/register-login/\n\n user : ".$user_login." \n pass : 12345678\n\n*กรุณาเปลี่ยน password หลังจาก Login";
                    $textMessageBuilder = new TextMessageBuilder($msg_txt);

                } else {
                     $textMessageBuilder = new TextMessageBuilder('คุณสมัคร Line Bot ไปแล้ว'); 
                }  
                
            } else {
                $textMessageBuilder = new TextMessageBuilder('Code นี้ไม่มีในระบบแล้ว'); 
            }
        } else {
            $textMessageBuilder = new TextMessageBuilder('Bot ไม่เข้าใจครับ'); 
        }

        $response = $bot->replyMessage($replyToken,$textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        } 
    
    } else {
        echo "";
    }
}

// Failed
//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>