<?php

$host = 'db';
$user = 'user';
$pass = 'password';
$db   = 'test_db';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die(
        json_encode(
            [
                'result' => '_ERROR: '
                    . 'Не получилось установить соединение с базой данных'
            ]
        )
    );
}

if (
    !isset($_SERVER['HTTP_X_GUID'])
    || empty($_SERVER['HTTP_X_GUID'])
) {
    die(
        json_encode(
            [
                'result' => '_ERROR: Не передан GUID'
            ],
            JSON_UNESCAPED_UNICODE
        )
    );
}

$guid = $_SERVER['HTTP_X_GUID'];
if ($guid[14] != '4') {
    die(
        json_encode(
            [
                'result' => '_ERROR: Неправильный формат GUID'
            ],
            JSON_UNESCAPED_UNICODE
        )
    );
}

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

$response = ['GUID' => $guid];

if (
    !isset($data['login'])
    || empty($data['login'])
) {
    $response['result'] = '_ERROR: Не указан логин';
    die(
        json_encode(
            $response,
            JSON_UNESCAPED_UNICODE
        )
    );
}

if (
    !isset($data['password'])
    || empty($data['password'])
) {
    $response['result'] = '_ERROR: не указан пароль';
    die(
        json_encode(
            $response,
            JSON_UNESCAPED_UNICODE
        )
    );
}

$b64 = base64_encode(
    $data['login'] . ':' . $data['password']
);

$response['Answer'] = $b64;

$login = mysqli_real_escape_string(
    $conn,
    $data['login']
);

$password = mysqli_real_escape_string(
    $conn,
    $data['password']
);

$sql = "INSERT INTO _test_table (login, password, b64) 
        VALUES ('$login', '$password', '$b64')";

if (mysqli_query($conn, $sql)) {
    $response['result'] = '_SUCCESS';
} else {
    $response['result'] = '_ERROR: Ошибка базы данных: '
        . mysqli_error($conn);
}

echo json_encode(
    $response,
    JSON_UNESCAPED_UNICODE
);

mysqli_close($conn);
