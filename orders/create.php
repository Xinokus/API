<?php

use objects\Orders;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Orders.php';
    $database = new Database();
    $db = $database->getConnection();
    $orders = new Orders($db);
    $data = json_decode(file_get_contents("php://input"));
    if(true) {
        $orders->orderid = $data->orderid;
        $orders->agreementid = $data->agreementid;
        $orders->equipmenttype = $data->equipmenttype;
        $orders->userscomment = $data->userscomment;
        $orders->employeeid = $data->employeeid;
        $orders->organizationname = $data->organizationname;

        if ($orders->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Организация была создана."),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать организацию."),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать организацию. Данные неполные", JSON_UNESCAPED_UNICODE));
    }