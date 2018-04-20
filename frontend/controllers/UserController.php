<?php

try {
    if ($action == 'ac'){
        include './views/ac.php';
    }elseif ($action == 'projector'){
        include './views/projector.php';
    }else {
        include './views/home.php';
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
}