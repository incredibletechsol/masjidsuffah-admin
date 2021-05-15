<?php
require_once "db_connect.php";
require_once "utilities.php";

function findTodaysMessageBoard()
{
    global $db;
    $todayDate = new DateTime();
    $todayDateString = $todayDate->format('Y-m-d');
    // $todayDateString = "2016-06-01";

    $query = "select * from message_board where enable = 1 and ? between start_date and end_date order by id limit 1";

    $statment = $db->prepare($query);
    if ($statment) {
        $statment->bind_param("s", $todayDateString);
        $statment->execute();
        $resultSet = $statment->get_result();
        $result = $resultSet->fetch_assoc();
        $statment->close();
    } else {
        trigger_error('Statement failed : ' . $statment->error, E_USER_ERROR);
    }
    return $result;
}

function findTodaysMessageBoardJson() {
    $messageArray = findTodaysMessageBoard();
    $result = null;
    if (isset($messageArray)) {
        $result = json_encode($messageArray, JSON_UNESCAPED_UNICODE);
    }
    return $result;
}

if (isset($_GET["printjson"])) {
    $messageJson = findTodaysMessageBoardJson();
    if (isset($messageJson)) {
        echo $messageJson;
    }
}