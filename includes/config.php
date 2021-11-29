<?php

function SendEmail($email_subject, &$message, $email_from, $email_to){

    $email_subscribe = '';
    //$headers = "From: $email_from;
    //                Content-Type: text/html; charset=UTF-8";

    //$headers = 'From: ' . $email_from . "\r\n" . 'Content-Type: text/html; charset=UTF-8';

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';

    // Additional headers
    $headers[] = 'From: ' . $email_from;

    $email_message = $message . $email_subscribe;

    return mail($email_to, $email_subject, $email_message, implode("\r\n", $headers));

}

function UserSignedUpOnEvent($event_id, $user_id){

    $query = "SELECT id FROM scheduled_events_users WHERE scheduled_event_id = $event_id AND user_id = $user_id";

    $rows = QuerySelect($query);

    if(count($rows) > 0)
        return true;

    return false;
}

function UpdateEventStatusIfFull($event_id){

    $query = "SELECT number_of_users, users_aplied, event_status FROM scheduled_events WHERE id = $event_id";

    $rows = QuerySelect($query);

    if(count($rows) > 0)
        if(intval($rows[0]['number_of_users']) <= intval($rows[0]['users_aplied']))
            if($rows[0]['event_status'] == "Open"){

                $query = "UPDATE scheduled_events SET event_status = 'Full' WHERE id = $event_id";
                QueryInsert($query);
            }
}

function last_monday($date){

    if(!is_numeric($date))
        $date = strtotime($date);
    if(date('w', $date) == 1)
        return date('Y-m-d', $date);
    else
        return date('Y-m-d', strtotime('last monday',$date));
    
}

function ContactUs($name, $email, $subject, $message){

    $user_id = 0;

    $logged_in = isLogedIn();

    if($logged_in)
        $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO contact_us(user_id, `name`, email, `subject`, message, send_at)
                VALUES($user_id, '$name', '$email', '$subject', '$message', NOW())";

    QueryInsert($query);

    $message = 'You have new Contact Us message from <b>' . $name . '</b> <a href="mailto: ' . $email . '">' . $email . '</a><br /><br /><br />';

    return SendEmail($subject, $message, 'contact@oaklandassistance.net', 'vuk3006@gmail.com');

}

function ChangeDateFormatPublicAmerican($date){
    
    $parts = explode('-', $date);
    
    if(count($parts) == 3)
        $date = $parts[1] . '/' . $parts[2] . '/' . $parts[0];
    
    return $date;   
}

function ChangeDateFormatDB($date){
    
    $parts = explode('/', $date);
    
    if(count($parts) == 3)
        $date = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
    
    return $date;   
}

function CreateFolder($folder){

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        $my_file = $folder . 'index.php';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
        //write some data here
        fclose($handle);
    }
}

function br2nl($string){
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

function Redirect($url, $statusCode = 303){
    header('Location: ' . $url, true, $statusCode);
    die();
}

function GetID_FromUniqueID($unique_id, $table){

    $query = "SELECT id FROM $table WHERE unique_id = '$unique_id'";
    $rows = QuerySelect($query);

    if(is_array($rows))
        if(count($rows) == 1)
            return $rows[0]["id"];

    return 0;
}

function GetUserTypeValue($type_id){

    $user_types = ['Home Seller', 'Homebuyer', 'Homeowner', 'Real Estate Agent', 'Contractor'];

    return $user_types[$type_id];
}

function GetUserData($user_id){

    $query = "SELECT id, unique_id, username
			  FROM users u
			  WHERE id = $user_id";

    $rows = QuerySelect($query);

    if(count($rows) > 0)
        return $rows[0];
    

    return false;
}

function in_array_r($item, $array){
    return preg_match('/"' . $item . '"/i', json_encode($array));
}

function GetUniqueID_FromID($id, $table){

    $query = "SELECT unique_id FROM $table WHERE id = " . $id;
    $rows = QuerySelect($query);

    if (is_array($rows))
        if (count($rows) == 1)
            return $rows[0]["unique_id"];

    return false;
}

function GenerateHashedString($string, $Rounds){

    $Salt = uniqid();
    $Algo = '6';

    $CryptSalt = '$' . $Algo . '$rounds=' . $Rounds . '$' . $Salt;

    $HashedString = crypt($string, $CryptSalt);

    $stringArray = explode("$", $HashedString);

    return $stringArray[count($stringArray) - 2] . "$" . $stringArray[count($stringArray) - 1];
}

function CheckHashedString($string, $HashedString, $Rounds){

    $Algo = '6';

    $CryptAlgo = '$' . $Algo . '$rounds=' . $Rounds . '$';

    $HashedString = $CryptAlgo . $HashedString;

    if(crypt($string, $HashedString) == $HashedString)
        return true;
    else
        return false;
    
}

function CheckIfEmailExists($email, $table){

    $query = "SELECT id FROM " . $table . " WHERE email = '" . $email . "'";
    $rows = QuerySelect($query);

    if(is_array($rows))
        if(count($rows) == 1)
            return $rows[0]["id"];
        
    return 0;
}

function CheckHashedPassword($password, $email, $table = 'users'){

    $query = "SELECT password, id FROM " . $table . " WHERE email = '" . $email . "'";
    $rows = QuerySelect($query);
    
    if(is_array($rows))
        if(count($rows) == 1){

            $databasePass = $rows[0]["password"];

            if(CheckHashedString($password, $databasePass, '1756'))
                return intval($rows[0]["id"]);
            else
                return "Incorrect Password.";
            

        }else
            return "That email does not exist in our database.";

}

function isLogedIn($table = 'users', $user_id = 'user_id'){

    if (isset($_SESSION[$user_id])) {

        if($table == 'admins')
            $query = "SELECT username FROM " . $table . " WHERE id = " . $_SESSION[$user_id];
        else
            $query = "SELECT first_name AS username FROM " . $table . " WHERE id = " . $_SESSION[$user_id];
    

        $rows = QuerySelect($query);

        if (is_array($rows))
            if (count($rows) == 1)
                return $rows[0]["username"];
            else
                return false;
        else
            return false;

    }else if(isset($_COOKIE["uud"]) && $table != 'admins'){

        if($_COOKIE["uud"] != ""){

            $query = "SELECT id, first_name AS username FROM " . $table . " WHERE unique_id = '" . $_COOKIE["uud"] . "'";

            $rows = QuerySelect($query);

            if(is_array($rows)){
                if(count($rows) == 1){
                    $_SESSION[$user_id] = $rows[0]["id"];
                    return $rows[0]["username"];
                }else
                    return false;
            }else
                return false;
        }else
            return false;
    }else
        return false;
    

}

function Check_Failed_attepmts(){

    global $display;
    global $captcha;

    $display = "block";

    if (isset($_SESSION['failed_attempts'])) {
        if($_SESSION['failed_attempts'] > 0)
            $_SESSION['failed_attempts'] += 1;
        else {
            $_SESSION['failed_attempts'] = 1;
            $_SESSION['failed_attempt_time'] = time();
        }

        if ($_SESSION['failed_attempts'] >= 3) {
            if (time() - $_SESSION['failed_attempt_time'] <= 60 * 15) {
                $captcha = true;
                $display = "none";

            } else {
                $_SESSION['failed_attempts'] = 1;
                $_SESSION['failed_attempt_time'] = time();
            }
        }
    } else {
        $_SESSION['failed_attempts'] = 1;
        $_SESSION['failed_attempt_time'] = time();
    }
}

function checkEmailRecoverPassword($email){

    $query = "SELECT unique_id, id FROM users WHERE email = N'" . $email . "'";

    $rows = QuerySelect($query);

    if (is_array($rows)) {
        if (count($rows) > 0) {

            $recovery_pass_unique_id = uniqid();

            $query = "INSERT INTO recover_pass
            		  VALUES(NULL, '" . $recovery_pass_unique_id . "', " . $rows[0]['id'] . ", '" . $rows[0]['unique_id'] . "', NOW())";

            if (QueryInsert($query)) {
                return $recovery_pass_unique_id;
            }
            // successfull generating recover pass
            else {
                return 1;
            }
            // unsuccessfull generating recover pass

        } else {
            return 0;
        }
        // no such mail in the database
    } else {
        return 0;
    }
    // no such mail in the database
}

function GetUsernameFromUser($user_id){

    $query = "SELECT CONCAT(first_name, ' ', last_name) AS username FROM users WHERE id = " . $user_id;

    $rows = QuerySelect($query);

    if(count($rows) > 0)
        return $rows[0]["username"];
    

    return false;
}


function GetStatusFromUser($user_id){

    $query = "SELECT status FROM users WHERE id = " . $user_id;

    $rows = QuerySelect($query);

    if(count($rows) > 0)
        return $rows[0]["status"];
    

    return "not registered";
}


function GetData($table, $value){

    $query = "SELECT id, $value AS value FROM $table";
    $rows = QuerySelect($query);

    if(is_array($rows))
        return $rows;
    
    return [];
}

function GetStates($country_id){

    $query = "SELECT id, name AS value FROM states WHERE country_id = $country_id";

    $rows = QuerySelect($query);

    if(is_array($rows))
        return $rows;
    
    return [];
}

function GetFieldFromTable($table, $field, $id){

    $query = "SELECT $field AS value FROM $table WHERE id = $id";
    
    $rows = QuerySelect($query);

    if(is_array($rows))
        if(count($rows) > 0)
            return $rows[0]['value'];

    return '';
}


function FromSecondsToTime($time_seconds){

    $minutes = "00";
    $hours   = "00";
    $seconds = AddZero($time_seconds);

    if($time_seconds >= 60)
        $seconds = AddZero($time_seconds % 60);
    if($time_seconds >= 60)
        $minutes = AddZero(floor(($time_seconds - $seconds) / 60) % 60);
    if($time_seconds >= 3600)
        $hours   = AddZero(floor($time_seconds / 3600));

    return "$hours:$minutes:$seconds";
}

function AddZero($number){

    if($number < 10)
        return "0" . $number;

    return $number;
}

function GetPageTextValues($page_id){

    $query = "SELECT text_value FROM page_text_values WHERE page_id = $page_id ORDER BY id";

    $rows = QuerySelect($query);

    $values = [];

    for($i = 0; $i < count($rows); $i++)
        $values[] = $rows[$i]['text_value'];
    

    return $values;
}


function GetPageTextValuesAdmin($page_id){

    $query = "SELECT ptv.id, text_value, page_title
              FROM page_text_values ptv, site_pages sp
              WHERE page_id = $page_id AND page_id = sp.id
              ORDER BY ptv.id ASC";

    $rows = QuerySelect($query);

    return $rows;
}