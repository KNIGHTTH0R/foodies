<?php
include_once 'inc/functions.php';
include_once 'inc/db_connect.php';

if (isset( $_POST['res'])){





    $ids = implode("','", $_POST['res']);
    $sql=("DELETE FROM reservations WHERE res_id IN ('".$ids."')");


    //$sql = "DELETE  FROM reservations WHERE res_id = $ids ";
    $stmt=$mysqli->prepare($sql);
    if ($stmt){
        $stmt->execute();
        header('Location: ./dashboard.php');

        $stmt->close();
        $mysqli->close();
    }

    }



