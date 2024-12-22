<?php

use objects\Employee;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/employee.php';

    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $employee->search($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $employees_arr = array();
        $employees_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $employee_item = array(
                "employeeid" => $employeeid,
                "sectionid" => $sectionid,
                "firstname" => $firstname,
                "middlename" => $middlename,
                "lastname" => $lastname,
                "workposition" => $workposition,
                "earnings" => $earnings,
                "special" => $special,
                "employeemonth" => $employeemonth,
            );
            array_push($employees_arr["records"], $employee_item);
        }
        http_response_code(200);
        echo json_encode($employees_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."),JSON_UNESCAPED_UNICODE);
    }
