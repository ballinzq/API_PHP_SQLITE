<?php

namespace App;

include("./index.php");

use App\Query;

$query = new Query($pdo);

if (isset($_POST) && !empty($_POST)) {
    $result = $query->insertRecords($_POST);

    if ($result) {
        $success = array(
            "status" => '201',
            "message" => 'record created successful'
        );
        print json_encode($success);
    }
    else {
        $error500 = array(
            "status" => "500",
            "reason" => "INTERNAL_SERVER_ERROR",
            "message" => "Something went wrong with your request"
        );
        print json_encode($error500);
    }

    return;
}

if (isset($_GET['type']) && !isset($_GET['deleted'])) {
    $typeURL = $_GET['type'];
    $result = $query->getType($typeURL);

    if ($result)
        print json_encode($result);
    else {
        $error404 = array(
            "status" => "404",
            "reason" => "NOT_FOUND",
            "message" => "No matching value found"
        );
        print json_encode($error404);
    }
    return;
} 

if (isset($_GET['deleted']) && !isset($_GET['type'])) {
    $deletedURL = $_GET['deleted'];
    $result = $query->getDeleted($deletedURL);

    if ($result)
        print json_encode($result);
    else {
        $error404 = array(
            "status" => "404",
            "reason" => "NOT_FOUND",
            "message" => "No matching value found"
        );
        print json_encode($error404);
    }
    return;
}  

if (isset($_GET['type']) && isset($_GET['deleted'])) {
    $typeURL = $_GET['type'];
    $deletedURL = $_GET['deleted'];
    $result = $query->getTypeAndDeleted($typeURL, $deletedURL);

    if ($result)
        print json_encode($result);
    else {
        $error404 = array(
            "status" => "404",
            "reason" => "NOT_FOUND",
            "message" => "No matching value found"
        );
        print json_encode($error404);
    }
    return;
}  

// caso não tenha filtros.
$result = $query->get();
print json_encode($result);