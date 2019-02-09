<?php
function reply_msg($txtin,$replyToken)//สร้างข้อความและตอบกลับ
{
 $access_token = ‘oklVPUB0cPJytDgXcwCvq+RGA5F8c4s5Q/ahxIzccEsvo1hbTqewS0I+yhkNvw2LlsMkhqWwgkOeo3URrorvdIVNRj0V0/+97rd/xif2L5DxP/bXApdXPNQHMmxHe2syEQa1tMMJjntR/li4ahJe/QdB04t89/1O/w1cDnyilFU=’;
 $messages = [‘type’ => ‘text’,’text’ => $txtin];//สร้างตัวแปร 
 $url = ‘https://api.line.me/v2/bot/message/reply’;
 $data = [
 ‘replyToken’ => $replyToken,
 ‘messages’ => [$messages],
 ];
 $post = json_encode($data);
 $headers = array(‘Content-Type: application/json’, ‘Authorization: Bearer ‘ . $access_token);
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, “POST”);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);
 echo $result . “\r\n”;
}

// รับข้อมูล
$content = file_get_contents(‘php://input’);
$events = json_decode($content, true);
if (!is_null($events[‘events’])) 
{
 foreach ($events[‘events’] as $event) 
 {
 if ($event[‘type’] == ‘message’ && $event[‘message’][‘type’] == ‘text’)
 {
 $replyToken = $event[‘replyToken’];
 $txtin = $event[‘message’][‘text’];
 reply_msg($txtin,$replyToken); 
 }
 }
}
echo “BOT OK”;
