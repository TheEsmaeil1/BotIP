<?php

// Name: اسکریپت ورود کاربر و ثبت لوکیشن و ای پی
// Description: EsmaeilRich
// Version: 2024.01.23
// Author: EsmaeilRich (https://discord.gg/kvHBhGe9HT)

function get_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_location($ip) {
    $url = "http://ip-api.com/json/$ip";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response);
    $location = "Country: $data->country, City: $data->city";
    return $location;
}

function send_telegram_message($message) {
    $botToken = 'Token'; // توکن ربات را در این قسمت قرار بدید
    $chatId = 'id number'; // ایدی عددی خود را در این قسمت قرار بدهید
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = ['chat_id' => $chatId, 'text' => $message];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
}

$ip = get_ip();
$location = get_location($ip);

$message = "New user logged in. IP: $ip, Location: $location";
send_telegram_message($message);

// Name: اسکریپت ورود کاربر و ثبت لوکیشن و ای پی
// Description: EsmaeilRich
// Version: 2024.01.23
// Author: EsmaeilRich (https://discord.gg/kvHBhGe9HT)

?>
