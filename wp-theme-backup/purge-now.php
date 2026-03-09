<?php
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/wp-load.php');

// Clear WordPress object cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "WP object cache flushed.\n";
}

// Purge Varnish via BAN
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1/',
    CURLOPT_CUSTOMREQUEST => 'BAN',
    CURLOPT_HTTPHEADER => [
        'Host: ad-times.com',
        'X-Ban-Url: .*',
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
]);
$r = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "BAN => HTTP $code\n";

// Purge Varnish via PURGE
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1/',
    CURLOPT_CUSTOMREQUEST => 'PURGE',
    CURLOPT_HTTPHEADER => [
        'Host: ad-times.com',
        'X-Purge-Method: regex',
        'X-Purge-Regex: .*',
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
]);
curl_exec($ch);
$code2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "PURGE => HTTP $code2\n";

// Breeze cache
if (function_exists('do_action')) {
    do_action('breeze_clear_all_cache');
    do_action('breeze_clear_varnish');
    echo "Breeze actions triggered.\n";
}

// Clear OPcache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache cleared.\n";
}

// Clear transients
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
echo "Transients cleared.\n";

echo "\nDone. " . date('Y-m-d H:i:s') . "\n";
unlink(__FILE__);
