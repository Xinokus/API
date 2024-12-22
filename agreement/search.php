<?php

use objects\Agreement;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/Agreement.php';

    $database = new Database();
    $db = $database->getConnection();
    $agreement = new Agreement($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $agreement->search($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $agreements_arr = array();
        $agreements_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $agreement_item = array(
                "agreementid" => $agreementid,
                "organizationname" => $organizationname,
                "agreementdate" => $agreementdate,
                "employeeid" => $employeeid,
            );
            array_push($agreements_arr["records"], $agreement_item);
        }
        http_response_code(200);
        echo json_encode($agreements_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."),JSON_UNESCAPED_UNICODE);
    }
