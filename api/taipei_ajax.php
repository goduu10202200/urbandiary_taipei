<?php
     include 'DBConnection_mongo.php';
    $raw_post_data = json_decode(file_get_contents('php://input'), true);
    
    $kind = 'list';
    $date =  "";
    $time = "";
    $title = "";
    $type =  "trip";
    $location = "";
    $id =  $raw_post_data['id'];
    $today = date("Y-m-d H:i:s");
    $date = date("Y-m-d");
    $latitude = "";
    $longitude = "";
    switch ($id) {
        case "t1":
            $time = "22:45";
            $title = "2018臺北周末音樂不斷電";
            $location = "臺北市松山文創園區文創大街";
            $latitude = 25.044117;
            $longitude = 121.5585953;
            break;
        case "t2":
            $time = "22:45";
            $title = "2018臺北溫泉季";
            $location = "臺北市北投區北投溫泉博物館";
            $latitude = 25.13679;
            $longitude = 121.5049873;
            break;
        case "t3":
            $time = "22:45";
            $title = "關渡國際自然藝術季";
            $location = "臺北市北投區關渡自然公園";
            $latitude = 25.118957;
            $longitude = 121.4687493;
            break;
        case "t4":
            $time = "22:45";
            $title = "2018臺北海碩盃國際女子網球挑戰賽";
            $location = "臺北市松山區臺北小巨蛋";
            $latitude = 25.05155;
            $longitude = 121.5475633;
            break;
        case "t5":
            $time = "22:45";
            $title = "2018士林官邸菊展";
            $location = "臺北市士林區士林官邸公園";
            $latitude = 25.1020745;
            $longitude = 121.533718;
            break;
        case "t6":
            $time = "22:45";
            $title = "2018臺北馬拉松";
            $location = "臺北市信義區市民廣場";
            $latitude = 25.0371169;
            $longitude = 121.5609001;
            break;
    }

    // 連線資料庫
    $manager = new MongoDB\Driver\Manager("mongodb://".$dbhost);

    // 插入資料，BulkWrite是批量插入
    $bulk = new MongoDB\Driver\BulkWrite;
    // 新增資料
    $bulk->insert([
        'username'      => 'mau123@gmail.com',
        'title'         => $title,
        'content'       => '',
        'type'          => $type,
        'location'      => $location,
        'latitude'      => $latitude,
        'longitude'     => $longitude,
        'date'          => $date,
        'time'          => $time,
        'status'        => 0,
        'kind'          => $kind,
        'created_at'    =>  $today
    ]);

    // 執行BulkWrite
    $manager->executeBulkWrite($dbname.'.'.$collection, $bulk);
