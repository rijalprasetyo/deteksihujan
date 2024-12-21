<?php
header('Content-Type: application/json');

$url = 'https://mobile-projek-c5cac-default-rtdb.firebaseio.com/hujan_data.json';

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL
$response = curl_exec($ch);

// Log kesalahan jika ada
if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
    curl_close($ch);
    exit;
}

// Tutup cURL
curl_close($ch);

// Kirim respons ke frontend
echo $response;
?>
