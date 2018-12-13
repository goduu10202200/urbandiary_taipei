<?php
     include 'DBConnection_mongo.php';
    $raw_post_data = json_decode(file_get_contents('php://input'), true);
    
    // 資料表
    $collection = 'scheduled';

    $kind = 'list';
    $date =  "";
    $time = "";
    $title = "";
    $type =  "trip";
    $location = "";
    $id =  $raw_post_data['id'];
    $today = date("Y-m-d H:i:s");
    $date_now = date("Y-m-d");
    $date_tomorrow = date("Y-m-d", strtotime(".$date_now. +1 day"));
    $latitude = "";
    $longitude = "";
    switch ($id) {
        case "t1":
            $time = "9:00";
            $title = "2018 士林官邸菊展";
            $location = "臺北市士林區士林官邸公園";
            $latitude = 25.0983538;
            $longitude = 121.5298217;
            break;
        case "t2":
            $time = "10:00";
            $title = "逆旅之域 The Flying Land";
            $location = "忠泰美術館";
            $latitude = 25.0442952;
            $longitude = 121.535126;
            break;
        case "t3":
            $time = "9:00";
            $title = "《Untitled》亞洲首個展";
            $location = "臺北市大安區仁愛路四段25-1號9樓";
            $latitude = 25.0382405;
            $longitude = 121.5425993;
            break;
        case "t4":
            $time = "9:00";
            $title = "「土絡天地海」草山聯合創作展";
            $location = "臺北市士林區凱旋路27號";
            $latitude = 25.1363084;
            $longitude = 121.54263;
            break;
        case "t5":
            $time = "10:00";
            $title = "「寂之守」陳秀雯創作個展";
            $location = "臺北市中山區中山北路二段39巷3號B2";
            $latitude = 25.0541778;
            $longitude = 121.5220553;
            break;
        case "t6":
            $time = "11:30";
            $title = "Long Time No Sebiro 好久不見穿西裝了你";
            $location = "臺北市大同區南京西路241號 米凱樂啤酒吧";
            $latitude = 25.0536831;
            $longitude = 121.5079709;
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
        'date'          => $date_tomorrow,
        'time'          => $time,
        'status'        => 0,
        'kind'          => $kind,
        'created_at'    =>  $today
    ]);

    // 執行BulkWrite
    $manager->executeBulkWrite($dbname.'.'.$collection, $bulk);
