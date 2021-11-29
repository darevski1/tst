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

<?=getHeader("Real Estate Agents", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Real Estate Agents", 3);?>
    <div class="agents-hero">
        <div class="agents d-flex justify-content-center align-items-center">
            <div class="container-xl">
                <input type="text" name="edit_page_values" class="form-control mt-5" id="page_text_value_<?=$ids[0]?>"
                    value="<?=$values[0]?>">

                <input type="text" name="edit_page_values" class="form-control mt-5" id="page_text_value_<?=$ids[13]?>"
                    value="<?=$values[13]?>">
            </div>
        </div>
    </div>
    <div class="intro-text d-flex flex-column justify-content-center" data-aos="fade-up">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col-md-6 col-sm-12 mt-5">
                    <h1 class="bold text-center">
                        <input type="text" name="edit_page_values" class="form-control mt-3"
                            id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">

                        <input type="text" name="edit_page_values" class="form-control mt-3"
                            id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">
                        <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-3"
                            id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>
                </div>
                <div class="col-md-6 col-sm-12 mt-5">
                    <input type="text" name="edit_page_values" class="form-control mt-3"
                        id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">

                    <input type="text" name="edit_page_values" class="form-control mt-3"
                        id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-3"
                        id="page_text_value_<?=$ids[6]?>"><?=$values[6]?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="block_benefits pb-5 mt-5">
        <div class="container-xl">
            <input type="text" name="edit_page_values" class="form-control mt-3" id="page_text_value_<?=$ids[7]?>"
                value="<?=$values[7]?>">
        </div>
        <div class="container-xl d-flex flex-column justify-content-center align-items-center">
            <div class="block_bt mb-3 d-flex align-items-center mt-5" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[8]?>"
                        value="<?=$values[8]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center " data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[9]?>"
                        value="<?=$values[9]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center " data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[10]?>"
                        value="<?=$values[10]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center " data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[11]?>"
                        value="<?=$values[11]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center " data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[12]?>"
                        value="<?=$values[12]?>">
                </div>
            </div>



            <div class="text-center">
                <button class="btn btn-lg round-btn  main-btn btn-p" type="submit">Contact us to refer client
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