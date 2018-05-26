<?php
include_once 'config.php';
 
function sec_session_start()
{
    $session_name = 'sec_session_id';   // ονομα του session
    $secure = SECURE;
    $httponly = true;
    // Αναγκαζει το session na χρησiμοποιει μονο cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../index.php?error=Could not initiate a safe session (ini_set)");
        exit();
    }
    // cookies parameters.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    session_name($session_name);
    session_start();            // ξεκιναει το session
    session_regenerate_id();    // σβηνει το παλιο ξεκιναει το καινουργιο

}
function login($email, $password, $mysqli) {

if ($stmt = $mysqli->prepare("SELECT id,password,admin 
        FROM users
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
    }

    $stmt->bind_result($user_id,$db_password,$admin_val);
    $stmt->fetch();



    if ($stmt->num_rows == 1)
        {
            // κοιταει αν υπαρχει ο κωδικος στην βδ

            if ($password == $db_password) {

                // ο κωδικος ειναι σωστος

                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                // καθαρισμος για ασφαλεια απο ΧSS σε περιπτωση που τυπωσουμε τη τιμη
                $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                $_SESSION['user_id'] = $user_id;
                $admin_val = preg_replace("/[^0-9]+/", "", $admin_val);
                $_SESSION['admin_val'] = $admin_val;




                $_SESSION['login_string'] = ($db_password . $user_browser);
                return true;
                } else {
                // Κωδικος ειναι λαθος


                return false;
                }

        }
        else {
            // ο χρηστης δεν υπαρχει

        return false;}

}




function login_check($mysqli) {
    //κοιτάει αν το session υπαρχει
    if (isset($_SESSION['user_id'],

        $_SESSION['login_string'],$_SESSION['admin_val'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $admin_val = $_SESSION['admin_val'];
        $user_browser = $_SERVER['HTTP_USER_AGENT'];


        // ξεκιναει το τσεκάρισμα
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM users 
                                      WHERE id = ? LIMIT 1")) {

            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // εκτελεσει του query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // εαν ο χρηστης υπαρχει παρε τα αποτελεσματα
                $stmt->bind_result($password);
                $stmt->fetch();

                $login_check = $password . $user_browser;

                if ($login_check == $login_string) {
                    // Logged In!
                    return true;
                } else {
                    // Not logged in 
                    return false;

                }
            } else {
                // Not logged in 
                return false;

            }
        } else {
            // Not logged in 
            return false;

        }
    } else {
        //Not logged in

        return false;
    }
}

//Καθαρισμος url
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {

        return '';
    } else {
        return $url;
    }
}