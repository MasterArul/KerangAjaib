<?php
require_once('./line_class.php');
$channelAccessToken = 'Vqw1oQhb4axZdn8r8Ou5E0XXpjbpLs1Kg0YclzDn2vS1OQ6K+s/GmjkxmIWU+H97pF2Bv9vzEHPRSULQZNbzjZIemuZ8bj3aSOXr8jnaLBFr7mjSnwBwyEQ5fgzGIIhmZAa+Rre8rxQig/a5WIGADwdB04t89/1O/w1cDnyilFU='; //Channel access token
$channelSecret = '5cdcab743ff8ccecfddafd88c51df309';//Channel secret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$msg_type = $message['type'];
$botname = "Kerang Ajaib"; //Nama bot

function send($input, $rt){
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
    return($send);
}

function jawabs(){
    $list_jwb = array(
		'Ya',
		'Tentu Iya',	    
		'Tidak',
		'Tentu Tidak',	    
		'Bisa jadi',
		'Mungkin',
		'Coba tanya lagi',
		'lebih keras',	    
		'Coba sekali lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah'
	   $filter[1] == 'mungkinkah'
	   $filter[2] == 'bisakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} else {}

if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
    file_put_contents($botname.'.json',$result);
}
