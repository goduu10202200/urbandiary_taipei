<?php
    include 'DBConnection.php';
    $raw_post_data = json_decode(file_get_contents('php://input'), true);
    
    $date =  "";
    $time = "";
    $title = "";
    $type =  "trip";
    $location = "";
    $id =  $raw_post_data['id'];
    $today = date("Y-m-d H:i:s");
    $date = date("Y-m-d");
   
    switch ($id) {
        case "t1":
            $time = "22:45";
            
            $title = "2018臺北周末音樂不斷電";
            $location = "臺北市松山文創園區文創大街";
            break;
        case "t2":
            $time = "22:45";
            $title = "2018臺北溫泉季";
            $location = "臺北市北投區北投溫泉博物館";
            break;
        case "t3":
            $time = "22:45";
            $title = "關渡國際自然藝術季";
            $location = "臺北市北投區關渡自然公園";
            break;
        case "t4":
            $time = "22:45";
            $title = "2018臺北海碩盃國際女子網球挑戰賽";
            $location = "臺北市松山區臺北小巨蛋";
            break;
        case "t5":
            $time = "22:45";
            $title = "2018士林官邸菊展";
            $location = "臺北市士林區士林官邸公園";
            break;
        case "t6":
            $time = "22:45";
            $title = "2018臺北馬拉松";
            $location = "臺北市信義區市民廣場";
            break;
    }

    $sql = "INSERT INTO scheduled (username, title, type, location, date, time, created_at)
    VALUES (1, '".$title."' ,'".$type."' ,'".$location."', '".$date."', '".$time."','".$today."')";

    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
