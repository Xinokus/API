<?php

use objects\Agreement;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/agreement.php';
    $database = new Database();
    $db = $database->getConnection();
    $agreement = new Agreement($db);
    $data = json_decode(file_get_contents("php://input"));
    if(true) {
        $agreement->agreementid = $data->agreementid;
        $agreement->organizationname = $data->organizationname;
        $agreement->agreementdate = $data->agreementdate;
        $agreement->employeeid = $data->employeeid;

        if ($agreement->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Договор был создан."),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать договор."),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать договор. Данные неполные", JSON_UNESCAPED_UNICODE));
    }