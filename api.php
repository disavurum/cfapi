<?php
// Cloudflare API bilgileri
$email = 'seninmailin@example.com'; // Cloudflare hesabının e-posta adresi
$api_key = 'YOUR_GLOBAL_API_KEY'; // Cloudflare Global API Key
$zone_id = 'YOUR_ZONE_ID'; // Cloudflare Zone ID
$domain = 'example.com'; // Ana domain
$subdomain = 'ornek'; // Açılacak subdomain

// API endpoint (Doğru URL)
$url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records"; 

// API'ye gönderilecek veri (Yeni A kaydı oluşturuyoruz)
$data = [
    'type' => 'A', // A kaydı oluşturuyoruz
    'name' => "$subdomain.$domain",
    'content' => '192.168.1.1', // Yönlendirmek istediğin IP'yi gir
    'ttl' => 120, // 120 saniye zaman aşımı
    'proxied' => false // Cloudflare Proxy kapalı (true yaparsan aktif olur)
];

// cURL isteği
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Auth-Email: $email",
    "X-Auth-Key: $api_key",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

// Sonucu ekrana yazdır
echo $response;
?>
