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

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<body>
 
    <?=GetEditHeader($header_title, 11);?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4 mt-5">
                <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
                  
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">
               
            </div>
            <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>


            <div class="card mt-5">
                <div class="card-body">
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">
                            <p>
                     <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>
                    </p>
                </div>
            </div>
            <div class="card  mt-3">
                <div class="card-body">
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[5]?>"><?=$values[5]?></textarea>
                    </p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                    <p>
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[7]?>"><?=$values[7]?></textarea>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mb50 pb-3">
        <div class="row mb-5">
            <div class="col-md-6 col-sm-12 mr-1 p-1 ">
                <a href="../register" class="btn black_btn_outline btn-block btn-wider" type="button">Begin
                    Community
                    Service</a>
            </div>
            <div class="col-md-6 col-sm-12 p-1">
                <a href="../login" class="btn black_btn btn-block btn-wider" type="button">Login to Your
                    Account</a>
            </div>
        </div>
    </div>

    <?=getFooter("../.");?>
    <?=PopUpButtons()?>
</body>

    <?=getBottomScripts("../.");?>
<script type="text/javascript" src="../../js/admin.js"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

</html>