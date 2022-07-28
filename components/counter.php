<?php
$counterFile = "../assets/json/counter.json";

$ip = $_SERVER['REMOTE_ADDR'];
$client = $_SERVER['HTTP_USER_AGENT'];

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

if(!in_array($ip, array_keys($countData['hosts']))){
    $countData['total']++;
    $countData['hosts'][$ip] = $client;

    file_put_contents($counterFile, json_encode($countData));
}

$count = $countData['total'];
echo "$count visitors";
?>