<?php
use objects\Orders;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Orders.php';
    $database = new Database();
    $db = $database->getConnection();
    $orders = new Orders($db);
    $data = json_decode(file_get_contents("php://input"));
    $orders->orderid = $data->orderid;
    $orders->agreementid = $data->agreementid;
    $orders->equipmenttype = $data->equipmenttype;
    $orders->userscomment = $data->userscomment;
    $orders->employeeid = $data->employeeid;
    $orders->organizationname = $data->organizationname;
    if($orders->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Поставка обновлена."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить поставку."),
            JSON_UNESCAPED_UNICODE);
    }