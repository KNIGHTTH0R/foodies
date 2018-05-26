<?php
include_once 'inc/db_connect.php';
include_once 'inc/config.php';
include_once 'inc/functions.php';
sec_session_start();

//ΕΑΝ ΤΑ ΠΟΣΤ ΕΧΟΥΝ VALUE ΞΕΚΙΝΑΕΙ ΤΟ FILTER
if (isset($_POST['tables'],$_POST['date'],$_POST['time'],$_POST['name'],$_POST['lname'],$_POST['phone'])){

//ΞΕΚΙΝΑΕΙ ΤΟ FILTER
    $tables= filter_input(INPUT_POST, 'tables', FILTER_SANITIZE_NUMBER_INT);
    $date=$_POST['date'];
    $time=$_POST['time'];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);

    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $user_id=$_SESSION['user_id'];
    $admin_val=$SESSION['admin_val'];



    //EAN ΥΠΑΡΧΕΙ SQL ERROR  ΚΛΕΙΣΕ ΤΟ CONNECTION
    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //ΚΟΙΤΑΕΙ EAN ΚΑΠΟΙΟ VARIABLE EINAI NULL
    if (!empty( $tables and $date and $time and $name and $lname and $phone )){


        if ($stmt = $mysqli->prepare("INSERT INTO reservations (tables,Name,lname,phone,date,TIME,id) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ississs", $tables,$name,$lname,$phone,$date,$time,$user_id);
            // ΕΚΤΕΛΕΣΗ QUERY
            if (! $stmt->execute()) {
                //ΠΡΟΒΛΗΜΑ ΜΕ ΤΗΝ ΒΔ
                header('Location: ./index.php?error=Registration failure Database insert problem');

            }
        }
        //ΕΓΙΝΕ ΤΟ RESERVATION

        header('Location: ./index.php?msg=Reservation made!');

        $stmt->close();
        $mysqli->close();
    }
    else {
        //KAΠΟΙΟ VARIABLE HTAN NULL
        $mysqli->close();
        header('Location: ./index.php?error=Fill in all  your information');
    }








}

?>