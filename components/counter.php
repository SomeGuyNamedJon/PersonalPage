<?php
session_start();
$counterFile = "../assets/json/counter.json";

$ip = $_SERVER['REMOTE_ADDR'];
$client = $_SERVER['HTTP_USER_AGENT'];

$homeIP = file_get_contents("/home/ubuntu/home_ip.json");
$homeIP = json_decode($homeIP, true);

if (!file_exists($counterFile)) {
    $template = array(
        "total" => 1,
        "hosts" => array(
            $ip => $client
        )
    );
    file_put_contents($counterFile, json_encode($template)) or die("Can't create file");
}

$countData = file_get_contents($counterFile);
$countData = json_decode($countData, true);

if(!isset($_SESSION['hasVisited']) && !in_array($ip, $homeIP)){
    $_SESSION['hasVisited']="yes";
    $countData['total']++;
    $countData['hosts'][$ip] = $client;

    file_put_contents($counterFile, json_encode($countData));
}

$count = $countData['total'];
echo "$count visitors";
?>