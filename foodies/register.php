<?php
include_once 'inc/db_connect.php';
include_once 'inc/config.php';

//ΕΑΝ ΤΑ ΠΟΣΤ ΕΧΟΥΝ VALUE ΞΕΚΙΝΑΕΙ ΤΟ FILTER
if (isset( $_POST['email'] , $_POST['password'],$_POST['name'],$_POST['lname'],$_POST['phone'],$_POST['address'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // ΤΟ ΕΙΜΑΙL ΔΕΝ ΕΙΝΑΙ ΣΩΣΤΟ
        header('Location: ./index.php?error=Enter a valid email');
    }
    //ΚΑΙ ΑΛΛΟ ΦΙΛΤΕΡ ΚΑΙ SANITIZE
    $phone =filter_input(INPUT_POST,'phone',FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = md5($password);
    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
    //ΚΟΙΤΑΕΙ ΓΙΑ ΕΡΡΟΡ
    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $prep_stmt = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
   // κοιταει εαν υπαρχει το μαιλ
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            // το email υπαρχει
            header('Location: ./index.php?error=Email already exists');
                        $stmt->close();
                        $mysqli->close();
        }
    } else {//ΔΒ ΕΡΡΟΡ
        header('Location: ./index.php?error=Database error');
                $stmt->close();
                $mysqli->close();    }
    //κοιταει αν καποιο variable ειναι null
    if (!empty( $email and $password and $name and $lname and $phone and $address)){
//ξεκιναει το ινσερτ
if ($stmt = $mysqli->prepare("INSERT INTO users (EMAIL,PASSWORD,NAME,LNAME,PHONE,ADDRESS) VALUES (?, ?, ?, ?, ?, ?)")) {
    $stmt->bind_param("ssssis", $email, $password, $name, $lname, $phone, $address);
    // Execute the prepared query.
    if (! $stmt->execute()) {
        header('Location: ./index.php?error=Registration failure Database insert problem');
        //προβλημα με δβ
    }
}
header('Location: ./index.php?msg=You are now registered, Log in and make a reservation!');
//ΣΑΞΕΣ

$stmt->close();
$mysqli->close();
}
else {
    $stmt->close();
    $mysqli->close();
    header('Location: ./index.php?error=Fill in all of your information');
}
}

 
    ?>