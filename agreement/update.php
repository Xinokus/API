<?php
use objects\Agreement;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Agreement.php';
    $database = new Database();
    $db = $database->getConnection();
    $agreement = new Agreement($db);
    $data = json_decode(file_get_contents("php://input"));
    $agreement->agreementid = $data->agreementid;
    $agreement->organizationname = $data->organizationname;
    $agreement->agreementdate = $data->agreementdate;
    $agreement->employeeid = $data->employeeid;
    if($agreement->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Договор обновлен."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить договор."),
            JSON_UNESCAPED_UNICODE);
    }