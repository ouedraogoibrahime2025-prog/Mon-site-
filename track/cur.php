<?php
$ip = $_SERVER['REMOTE_ADDR'];
if ($ip === "::1") $ip = "1.1.1.1";

$response = @file_get_contents("https://ipwho.is/{$ip}");
if ($response) {
    $data = json_decode($response, true);

    if (!empty($data['success']) && $data['success'] === true) {
        $currency_symbol = $data['currency']['symbol'] ?? '';
        $currency_code   = $data['currency']['code'] ?? '';

        echo "Detected currency: {$currency_symbol} ({$currency_code})";
    } else {
        echo "Could not determine currency.";
    }
} else {
    echo "Failed to fetch IP info.";
}
?>