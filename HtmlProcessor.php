<?php

$json = file_get_contents('php://input');
$data = json_decode($json)->raw_text;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data)) {
    if (empty($data)) {
        http_response_code(500);
    }
    $pattern = '/\<a\s.*?\>(.*?)\<\/a\>/iums';
    $formatted_text = preg_replace($pattern, '$1', $data);
    $json = [
        'formatted_text' => $formatted_text,
    ];
    header('Content-Type: application/json');
    echo json_encode($json);
}
