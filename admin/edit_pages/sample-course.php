<?php session_start();?>
<?php

require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/generators.php';

ConnectToDatabase();


$table = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if (!$loged_in) {
    ?>
        <script type="text/javascript">
            window.location.replace("../login");
        </script>
    <?php
    exit();
}

if (isset($_GET['spuid']) && $_GET['spuid'] != "") {

    $page_unique_id = check_input($_GET['spuid']);

    $page_id = GetID_FromUniqueID($page_unique_id, "site_pages");

    if ($page_id == 0)
        exit("");
    
    $rows = GetPageTextValuesAdmin($page_id);

    $header_title = $rows[0]["page_title"];

    $ids = [];
    $values = [];

    for ($i = 0; $i < count($rows); $i++) {
        $ids[] = $rows[$i]['id'];
        $values[] = $rows[$i]['text_value'];
    }

}else
    exit("");

?>

<!DOCTYPE html>
<html lang="en">

<?=getHeader($page_title, "../.");?>


<body>
 
    <?=GetEditHeader($header_title, 7);?>
 
    <div class="container-wide mb100 bg-white"> 

        <div class="tab-pane" id="v_pills_courses">
            <div class="container">

                <div class="row h-100 mt-5">
                <input type="text" name="edit_page_values" class="form-controls mt-5"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>"> 
 
                    <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>
 
      

                </div>
            </div>
        </div>

 


    </div>

    <?=getFooter("../.");?>
    <?=PopUpButtons()?>

</body>

    <?=getBottomScripts("../.");?>
<script type="text/javascript" src="../../js/admin.js"></script>
</html>