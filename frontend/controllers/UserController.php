<?php

try {
    $lastpresenceDao = new com\loabten\model\data\LastpresenceDao(com\loabten\model\data\DatabaseUtils::connect());
    if ($action == 'add_presence'){
        $room_id = $_POST['room_id'];
        $time = $_POST['time'];
        $result = $lastpresenceDao->insert($room_id,$time);
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
}