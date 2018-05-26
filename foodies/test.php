<?php

include_once 'inc/db_connect.php';
include_once 'inc/functions.php';

sec_session_start();
if (login_check($mysqli)== true){
    if (isset($_SESSION['user_id'])){
        echo $_SESSION['user_id'];
        echo $_SESSION['admin_val'];

    }}
else {
    echo 'no';
}


