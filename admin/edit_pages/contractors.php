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

    if ($page_id == 0) {
        exit("");
    }

    $query = "SELECT id, text_value FROM page_text_values WHERE page_id = $page_id ORDER BY id ASC";

    $rows = QuerySelect($query);
    // echo $query;

    $ids = [];
    $values = [];

    for ($i = 0; $i < count($rows); $i++) {
        $ids[] = $rows[$i]['id'];
        $values[] = $rows[$i]['text_value'];
    }

} else {
    exit("");
}

?>

<!doctype html>
<html lang="en">

<?=getHeader("Contractors", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Contractors", 1);?>
    <div class="contractors-hero ">
        <div class="contractors d-flex justify-content-center align-items-center">
            <div class="container-xl">

                <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>"
                    value="<?=$values[0]?>">
                <br />
                <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[1]?>"
                    value="<?=$values[1]?>">
                <br />
                <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[2]?>"
                    value="<?=$values[2]?>">
                </h3>
            </div>
        </div>
    </div>
    <div class="intro-text pt-3">
        <div class="container-xl">
            <textarea name="edit_page_values" rows="6" class="form-control"
                id="page_text_value_<?=$ids[3]?>"><?=$values[3]?> </textarea>
            <br>
            <textarea name="edit_page_values" rows="6" class="form-control"
                id="page_text_value_<?=$ids[4]?>"><?=$values[4]?> </textarea>
        </div>
    </div>

    <div class="block_benefits pb-5">
        <div class="container-xl">
            <div class="row">
                <div class="col-sm-10 offset-1 text-center mt-5">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[5]?>"
                        value="<?=$values[5]?>">
                </div>
            </div>
        </div>
        <div class="container-xl d-flex flex-column justify-content-center align-items-center">
            <div class="block_bt mb-3 d-flex align-items-center mt-3" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[6]?>"
                        value="<?=$values[6]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center mt-3" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[7]?>"
                        value="<?=$values[7]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center mt-3" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[8]?>"
                        value="<?=$values[8]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center mt-3" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[9]?>"
                        value="<?=$values[9]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center mt-3" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[10]?>"
                        value="<?=$values[10]?>">
                </div>
            </div>




            <div class="text-center">
                <button class="btn btn-lg round-btn  main-btn btn-p mt-2" type="submit">Contact Us
                </button>
            </div>
        </div>
    </div>

    <?=getFooter("../.")?>
    <!-- Da se dodade -->
    <?=PopUpButtons()?>
</body>
<?=getBottomScripts("../.")?>
<script type="text/javascript" src="../../js/admin.js"></script>

</html>