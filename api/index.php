<?php
    include("functions.php");

    function deliver_response($status, $status_message, $data) {
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_message'] = $status_message;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
    }

    //process request
    header("Content-Type:application/json");
    if(!empty($_GET['name'])) {
        $name = $_GET['name'];
        $price = getPrice($name);

        if ($price < 0) {
            deliver_response(200, "book not found", NULL);
        } else {
            deliver_response(200, "book found", $price);
        }
    } else {
        deliver_response(400, "Invalid Request", NULL);
    }
?>