<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

require_once '../vendor/autoload.php';

if ($_GET['url']) {
    $url = explode("/", $_GET['url']);

    if ($url[0] === 'api') {

        array_shift($url);
        $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';

        array_shift($url);

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        try {
            $response = call_user_func_array(array(new $service, $method), $url);

            http_response_code(200);

            echo json_encode(array("status" => "success", "data" => $response), JSON_UNESCAPED_UNICODE);
            exit;
        } catch (\Exception $e) {

            http_response_code(404);

            echo json_encode(array("status" => "error", "data" => $e->getMessage()), JSON_UNESCAPED_UNICODE);

            exit;
        }
    }
}
