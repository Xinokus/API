<?php

use objects\Employee;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/employee.php';
    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $data = json_decode(file_get_contents("php://input"));
    if(true) {
        $employee->employeeid = $data->employeeid;
        $employee->sectionid = $data->sectionid;
        $employee->firstname = $data->firstname;
        $employee->middlename = $data->middlename;
        $employee->lastname = $data->lastname;
        $employee->workposition = $data->workposition;
        $employee->earnings = $data->earnings;
        $employee->special = $data->special;
        $employee->employeemonth = $data->employeemonth;

        if ($employee->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Сотрудник был создан."),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать сотрудника."),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать сотрудника. Данные неполные", JSON_UNESCAPED_UNICODE));
    }