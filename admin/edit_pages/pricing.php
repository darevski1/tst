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
<?=getHeader($header_title, "../.");?>


<body>
 
    <?=GetEditHeader($header_title, 5);?>
    <main class="pricing-h d-flex justify-content-center align-items-center mt-5" style="min-height: auto;">
        <div class="pricing-header w-75 mb-5">
            <h1 class="display-4  text-center bold"><input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>"> <br>
                <small class="  text-white"><input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>"></small>
            </h1>
        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>"> 
        </div>
    </main>

 



    <div class="pricing d-flex align-items-center mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h3 class="display-6 bold mt-4">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                    </h3>
                    <ul class="list_price">
                        <li>
                            <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                        </li>
                        <li>
                            <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                        </li>
                        <li>
                          <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="bold hbs">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">
                    </h2>
                    <div class="col-sm-12 text-center">
                        <a href="./login" type="button" class="btn black_btn mt-4 w-300 btn-lg">Sign up to get started</a>
                    </div>
                    <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mt-5">
                </div>
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