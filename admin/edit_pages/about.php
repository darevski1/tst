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
 
    <?=GetEditHeader($header_title, 2);?>
    <div class="section-2 ">
        <div class="container">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4">
                    <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
          
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">
               
            </div>
            <div class="col-sm-12">
            <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>
            </div>
            <div class="col-sm-12 text-center">
                <a href="../../login" type="button" class="btn black_btn mt-4 w-300 btn-lg">
                    Sign up to get started</a>
            </div>
        </div>
    </div>
    <div class="section-l2 d-flex align-items-center justify-content-center">
        <div class="container ">
            <div class="row">
                <h2 class="bold display-5">
                
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">
                </h2>
                <p class="big_p mt-4">
                <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>
                </p>
                <div class="col-sm-12 amc">
                    <a href="./../login" type="button" class="btn black_btn mt-4 w-300 btn-lg">
                    Sign up to get started</a>

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