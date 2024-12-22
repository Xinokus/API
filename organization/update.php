<?php
use objects\Organization;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/organization.php';
    $database = new Database();
    $db = $database->getConnection();
    $organization = new Organization($db);
    $data = json_decode(file_get_contents("php://input"));
    $organization->organizationname = $data->organizationname;
    $organization->agreementid = $data->agreementid;
    $organization->countryid = $data->countryid;
    $organization->address = $data->address;
    $organization->phone = $data->phone;
    $organization->email = $data->email;
    $organization->website = $data->website;
    if($organization->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Организация обновлен."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить организацию."),
            JSON_UNESCAPED_UNICODE);
    }