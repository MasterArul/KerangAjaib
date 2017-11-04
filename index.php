<?php
require_once('./line_class.php');
$channelAccessToken = 'Vqw1oQhb4axZdn8r8Ou5E0XXpjbpLs1Kg0YclzDn2vS1OQ6K+s/GmjkxmIWU+H97pF2Bv9vzEHPRSULQZNbzjZIemuZ8bj3aSOXr8jnaLBFr7mjSnwBwyEQ5fgzGIIhmZAa+Rre8rxQig/a5WIGADwdB04t89/1O/w1cDnyilFU='; //Channel access token
$channelSecret = '5cdcab743ff8ccecfddafd88c51df309';//Channel secret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$msg_type = $message['type'];
$botname = "Kerang Ajaib"; //Nama bot
$userId = $client->parseEvents()[0]['source']['userId'];
$groupId = $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp = $client->parseEvents()[0]['timestamp'];
$type = $client->parseEvents()[0]['type'];
$message = $client->parseEvents()[0]['message'];
$messageid = $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = explode(" ", $message['text']);
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

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
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} else {}

#---------------------------------------------------------------------
	else if ($command == '/keyword') {
	
	        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'template',
										'altText' => 'Keyword Bot',
										'template' => array(
											'type' => 'buttons',
											'thumbnailImageUrl' => 'https://raw.githubusercontent.com/farzain/api-line/master/zFz.png',
											'title' => 'zFz Line Bot',
											'text' => 'Klik tombol dibawahini',
											'actions' => array(
								array(
										'type' => 'message',
										'label' => 'Cari Anime',
										'text' => '/anime [Judul Anime]',
									),
								array(
										'type' => 'message',
										'label' => 'Cari Sinopsis Anime',
										'text' => '/anime-syn [Judul Anime]',
									)										
                        )
                  )
             )					
			 
        )
    );
	}
#---------------------------------------------------------------------

if(isset($balas)){
    $client->replyMessage($balas); 
    $result =  json_encode($balas);
    file_put_contents($botname.'.json',$result);
}
