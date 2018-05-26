
<?php
include_once 'inc/functions.php';
sec_session_start();

// βγαζουμε ολα τα values που υπαρχουν
$_SESSION = array();

// παιρνουμε τα session parameters
$params = session_get_cookie_params();

// τα σβηνουμε
setcookie(session_name(),
    '', time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]);

// καταστρεφουμε το session
session_destroy();
header('Location: index.php');


?>