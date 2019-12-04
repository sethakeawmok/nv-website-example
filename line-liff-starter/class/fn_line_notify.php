<?php

require_once '../config/config_th.php';
require_once '../plugins/line-bot-sdk/vendor/autoload.php';

// use LINE\LINEBot;
// use LINE\LINEBot\HTTPClient;
// use LINE\LINEBot\HTTPClient\CurlHTTPClient; 
// use LINE\LINEBot\MessageBuilder;
// use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
// use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event;
use LINE\LINEBot\Event\BaseEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\AccountLinkEvent;
use LINE\LINEBot\Event\MemberJoinEvent; 
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\QuickReplyBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\QuickReplyBuilder\ButtonBuilder\QuickReplyButtonBuilder;
use LINE\LINEBot\TemplateActionBuilder\CameraRollTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\CameraTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\LocationTemplateActionBuilder;
use LINE\LINEBot\RichMenuBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\Constant\Flex\ComponentIconSize;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentButtonHeight;
use LINE\LINEBot\Constant\Flex\ComponentSpaceSize;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BubbleStylesBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BlockStyleBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\IconComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SpacerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\FillerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SeparatorComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;


/**
 * BubbleContainerBuilder constructor.
 *
 * @param ContainerDirection|null $direction
 * @param BoxComponentBuilder|null $headerComponentBuilder
 * @param ImageComponentBuilder|null $heroComponentBuilder
 * @param BoxComponentBuilder|null $bodyComponentBuilder
 * @param BoxComponentBuilder|null $footerComponentBuilder
 * @param BubbleStylesBuilder|null $stylesBuilder
 */
 // ส่วนประกอบของ Bubble ประกอบด้วย parameter ต่างๆ ดังนี้
/*public function __construct(
    $direction = null, // กำหนด NULL หรือ "ltr" หรือ "rtl"
    $headerComponentBuilder = null, // box component ของ header block
    $heroComponentBuilder = null, // image component ของ hero block
    $bodyComponentBuilder = null,  // box component ของ body block
    $footerComponentBuilder = null,  // box component ของ footer block
    $stylesBuilder = null // style ของแต่ละ block
)*/
 
function notify_to_customer($msg_pd_detail_arr, $msg_pd_total_arr, $line_userID) {

    if (!empty($line_userID)){

        $BoxComponent_arr[] =   new BoxComponentBuilder(
            "horizontal",
            array(
                new TextComponentBuilder("ชื่อสินค้า",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                new SeparatorComponentBuilder(),
                new TextComponentBuilder("จำนวน",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                new SeparatorComponentBuilder(),
                new TextComponentBuilder("ราคา",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"),                        
            ),
            0,"md"
        );

        //print_r($msg_pd_detail_arr);
        foreach ($msg_pd_detail_arr as $key => $val_in_arr) {
            $pd_name_th = isset($val_in_arr['pd_name_th']) ? $val_in_arr['pd_name_th'] : "-";
            $pd_count = isset($val_in_arr['pd_count']) ? $val_in_arr['pd_count'] : "-";
            $pd_price = isset($val_in_arr['pd_price']) ? $val_in_arr['pd_price'] : "-";

            $BoxComponent_arr[] =   new BoxComponentBuilder(
                "horizontal",
                array(
                    new TextComponentBuilder($pd_name_th,NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                    new SeparatorComponentBuilder(),
                    new TextComponentBuilder($pd_count,NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                    new SeparatorComponentBuilder(),
                    new TextComponentBuilder($pd_price,NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"),                        
                ),
                0,"md"
            );

        }
        
        foreach ($msg_pd_total_arr as $key => $val_in_arr) {
            $pd_total_count = isset($val_in_arr['pd_total_count']) ? $val_in_arr['pd_total_count'] : "-";
            $pd_total_price = isset($val_in_arr['pd_total_price']) ? $val_in_arr['pd_total_price'] : "-";
            $order_id = isset($val_in_arr['order_id']) ? $val_in_arr['order_id'] : "";
            $FirstName = isset($val_in_arr['FirstName']) ? $val_in_arr['FirstName'] : "";
            
            $BoxComponent_arr[] =   new BoxComponentBuilder(
                "horizontal",
                array(
                    new TextComponentBuilder("รวม",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                    new SeparatorComponentBuilder(),
                    new TextComponentBuilder("$pd_total_count",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"), 
                    new SeparatorComponentBuilder(),
                    new TextComponentBuilder("$pd_total_price",NULL,NULL,"md","center",NULL,NULL,NULL,NULL,"#000000"),                        
                ),
                0,"md"
            );

        }

        $textReplyMessage = new BubbleContainerBuilder(
            "ltr",
            new BoxComponentBuilder(
                "vertical",
                array(
                    new TextComponentBuilder("แจ้งโอนเงิน  : ".$FirstName) 
                )
            ),
           
            // new ImageComponentBuilder(
            //     "https://www.ninenik.com/images/ninenik_page_logo.png",NULL,NULL,NULL,NULL,"full","20:13","cover"),
            
            new BoxComponentBuilder(
                "vertical",
                $BoxComponent_arr,
                0,"md"
            ),
            new BoxComponentBuilder(
                "horizontal",
                array(
                    new ButtonComponentBuilder(
                        new UriTemplateActionBuilder("ยืนยันคำสั่งซื้อ","https://analytics.2jds.com/line-liff-starter/confirm_payment.php?order_id=".$order_id),
                        NULL,NULL,NULL,"primary"
                    )
                )
            )
            //new BubbleStylesBuilder( // style ทั้งหมดของ bubble
                //new BlockStyleBuilder("#FFFFFF"),  // style สำหรับ header block
                //new BlockStyleBuilder("#FFFFFF"), // style สำหรับ hero block
                //new BlockStyleBuilder("#FFFFFF"), // style สำหรับ body block
                //new BlockStyleBuilder("#FFFFFF") // style สำหรับ footer block
            //)
        );

      
        $replyData = new FlexMessageBuilder("Flex",$textReplyMessage);

        $httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
        $bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_ID)); 
        
        //$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($replyData);
        $response = $bot->pushMessage($line_userID, $replyData);
        if ($response->isSucceeded()) {
            //echo 'Succeeded!'; 
        } 
    }    
}

function notify_to_customer_text_msg($msg_notify, $line_userID) {

    if (!empty($line_userID)){

        $httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
        $bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_ID)); 
        
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg_notify);
        $response = $bot->pushMessage($line_userID, $textMessageBuilder);
        if ($response->isSucceeded()) {
            //echo 'Succeeded!'; 
        } 
    }    
}

function notification_LineBot_to_agency_agent ($property_id, $user_id_arr, $AuthorID, $msg_noti_line_bot , $con_mysqli) {
    
    $user_id_arr = array_unique($user_id_arr);

    $in_comma = 0;
    $sql_where = '';
    foreach ($user_id_arr as $user_id_where) {
        if ($in_comma == 0){
            $sql_where = "'".$user_id_where."'";
        }else {
            $sql_where .= ",'".$user_id_where."'";
        }
        $in_comma +=1;
    }

    if (sizeof($user_id_arr) != 0){             
        if (sizeof($user_id_arr) == 1){
            $sql_where = ' = '.$sql_where;
        }else {
            $sql_where = ' IN ('.$sql_where.') ';
        }
    }

    if (!empty($sql_where)){
        
        if (!empty($AuthorID)){
            $get_info_line_qry = "SELECT * FROM kb_line_dev_provider WHERE agency_id = '$AuthorID'";
            $res_info_line_qry = mysqli_query($con_mysqli, $get_info_line_qry); 
            if (!$res_info_line_qry) {
                die('Invalid query0: ' . mysqli_error($con_mysqli));
            } 

            $row_info_line_qry = mysqli_fetch_array($res_info_line_qry);
            $line_channel_secret = isset($row_info_line_qry['channel_secret']) ? $row_info_line_qry['channel_secret'] : '70c5cfb06c10dae241a063b628289285';
            $line_channel_access_token = isset($row_info_line_qry['channel_access_token']) ? $row_info_line_qry['channel_access_token'] : 'LySBn7+H53cn7BfsDOYWjsa2U7+joC41P8DrHcpRfyhQAS9VC35NHgFCXR4JPMRpJ0UNaJe6bu+CcJjFs5zSYOsFa7G4g7PjE6YZ0RRyP5uG0m+jNbvm8sZbwxa76F3FB/92W4FpksuweygYvCndewdB04t89/1O/w1cDnyilFU=';

            $httpClient = new CurlHTTPClient($line_channel_access_token);
            $bot = new LINEBot($httpClient, array('channelSecret' => $line_channel_secret)); 

        } else {
            $httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
            $bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET)); 
        }
        
        $content = file_get_contents('php://input');
        $events = json_decode($content, true);
        

        $sql_get_user_line_bot = "SELECT * FROM kb_user_line_bot WHERE kb_userID $sql_where";
        $res_get_user_line_bot = mysqli_query($con_mysqli, $sql_get_user_line_bot); 
        if (!$res_get_user_line_bot) {
            die('Invalid query0: ' . mysqli_error($con_mysqli));
        } 
        while($row_user_line_bot = mysqli_fetch_array($res_get_user_line_bot))
        {   
            $LineBot_userID = isset($row_user_line_bot['LineBot_userID']) ? $row_user_line_bot['LineBot_userID'] : "";
            $LineBot_groupID = isset($row_user_line_bot['LineBot_groupID']) ? $row_user_line_bot['LineBot_groupID'] : "";
            $kb_user_login = isset($row_user_line_bot['kb_user_login']) ? $row_user_line_bot['kb_user_login'] : "";

            if (!empty($LineBot_groupID)){
                $id_sendMsg = $LineBot_groupID;
            }else {
                $id_sendMsg = $LineBot_userID;
            }

            if (!empty($id_sendMsg)){
                
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg_noti_line_bot." $kb_user_login");
                $response = $bot->pushMessage($id_sendMsg, $textMessageBuilder);
                if ($response->isSucceeded()) {
                    //echo 'Succeeded!'; 
                }   
            }     

        } 
    } 
    
}


function line_notify_message($message,$token){
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array( 
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                        ."Authorization: Bearer ".$token."\r\n"
                        ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents("https://notify-api.line.me/api/notify",FALSE,$context);
    $res = json_decode($result);
    return $res;
}  

?>