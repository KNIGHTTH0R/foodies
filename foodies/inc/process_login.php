<?php

include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start(); // ξεκιναει session

if (isset($_POST['email'], $_POST['password'] )) {
    $email = $_POST['email'];

    //κανω crypt το password και το συγκρινω με  αυτο της βασης δεδωμενων μαζι με mail
    $password =hash('md5',$_POST['password']);
    if (login($email, $password, $mysqli) == true) {
        // Login
        header('Location: ../index.php?msg=You are  logged in');
    } else {
        // λαθος login
       header('Location: ../index.php?error=Login Failed');

    }
} else {
    // καποιο λαθος εγινε , καποιο ποστ ειναι κενο
    echo 'Invalid Request';
}