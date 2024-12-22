<?php

use objects\Organization;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/organization.php';

    $database = new Database();
    $db = $database->getConnection();
    $organization = new Organization($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $organization->search($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $organizations_arr = array();
        $organizations_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $organization_item = array(
                "organizationname" => $organizationname,
                "agreementid" => $agreementid,
                "countryid" => $countryid,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "website" => $website,
            );
            array_push($organizations_arr["records"], $organization_item);
        }
        http_response_code(200);
        echo json_encode($organizations_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Организации не найдены."),JSON_UNESCAPED_UNICODE);
    }
