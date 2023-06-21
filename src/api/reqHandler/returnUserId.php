<?php

session_start();

//userID API
if(isset($_SESSION["id"])) {
    //get the id
    $userId = $_SESSION["id"];
    //prepare the response data
    $response = [
        'user_id'=> $userId,
        'message'=> 'user id successfully retrieved'
    ];
    //send it
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // Return an error response or handle the case when the user is not logged in
    $response = array(
    
      'message' => 'User ID not found in the session'
    );

    // Send the response as JSON
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode($response);
}
