<?php

use objects\Organization;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/organization.php';
    $database = new Database();
    $db = $database->getConnection();
    $organization = new Organization($db);
    $data = json_decode(file_get_contents("php://input"));
    if(true) {
        $organization->organizationname = $data->organizationname;
        $organization->agreementid = $data->agreementid;
        $organization->countryid = $data->countryid;
        $organization->address = $data->address;
        $organization->phone = $data->phone;
        $organization->email = $data->email;
        $organization->website = $data->website;

        if ($organization->create()) {
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