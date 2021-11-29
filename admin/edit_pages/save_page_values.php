<?php session_start();?>
<?php

include '../../includes/db.php';
include '../../includes/config.php';

ConnectToDatabase();

$table = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if (!$loged_in) {
    exit('1'); //not logged in
}

if (isset($_POST['pid']) && $_POST['pid'] != '' &&
    isset($_POST['j']) && $_POST['j'] != '') {

    $page_id = check_input($_POST['pid']);

    $json = $_POST['j'];

    for ($i = 0; $i < count($json); $i++) {

        $id = check_input($json[$i]['id']);
        $value = check_input($json[$i]['value']);

        $query = "UPDATE page_text_values
					SET  text_value = '$value'
				  WHERE  id = $id AND page_id = $page_id ORDER BY id ASC";

        QueryInsert($query);
    }

    $query = "UPDATE site_pages
                SET  updated_at = NOW()
               WHERE id = $page_id";


    QueryInsert($query);

    exit("2");

} else {
    exit('3');
}
// invalid arguments