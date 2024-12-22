<?php
use objects\Employee;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Employee.php';
    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $data = json_decode(file_get_contents("php://input"));
    $employee->employeeid = $data->employeeid;
    $employee->sectionid = $data->sectionid;
    $employee->firstname = $data->firstname;
    $employee->middlename = $data->middlename;
    $employee->lastname = $data->lastname;
    $employee->workposition = $data->workposition;
    $employee->earnings = $data->earnings;
    $employee->special = $data->special;
    $employee->employeemonth = $data->employeemonth;
    if($employee->update()){
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