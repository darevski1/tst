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
<?=getHeader("Virtual Estimate ", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Virtual Estimate", 11);?>
    <div class="main-virtual pt-4">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 p-3">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>"
                        value="<?=$values[0]?>">
                    <input type="text" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">
                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[2]?>"><?=$values[2]?></textarea>
                    <input type="text" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                    <ul class="list-unstyled mt-5">
                        <li class="bold h5 d-flex align-items-center">
                            <i class="fas fa-check mr-2 "></i> <input type="text" name="edit_page_values"
                                class="form-control" id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                        </li>
                        <li class="bold h5 d-flex align-items-center">
                            <i class="fas fa-check mr-2"></i> <input type="text" name="edit_page_values"
                                class="form-control" id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                        </li>
                        <li class="bold h5 d-flex align-items-center">
                            <i class="fas fa-check mr-2"></i> <input type="text" name="edit_page_values"
                                class="form-control" id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                        </li>
                        <li class="bold h5 d-flex align-items-center">
                            <i class="fas fa-check mr-2"></i> <input type="text" name="edit_page_values"
                                class="form-control" id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">
                        </li>
                    </ul>
                    <div class="d-flex flex-row bd-highlight ">
                        <div class="bd-highlight">
                            <input type="text" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[8]?>" value="<?=$values[8]?>">
                        </div>
                        <div class="bd-highlight d-flex justify-content-end align-items-end">
                            <input type="text" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[9]?>" value="<?=$values[9]?>">
                        </div>
                    </div>
                    <div class="wrap-text">
                        <button class="btn btn-lg round-btn  main-btn btn-block btn-p mt-2" type="submit">Order
                            Now</button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 ml-auto d-flex align-items-center mt-4 mt-md-0">
                    <div class="col text-center">
                        <img src="../../assets/images/monitor.jpg" class="mx-auto d-block img-fluid">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-virtual-cl mt-5 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div
                    class="col-lg-7 col-md-7 col-sm-12 p-3 lft-block min-h600 themed-grid-col d-flex flex-column align-items-center justify-content-center">
                    <div class="wrap-text">
                        <input type="text" name="edit_page_values" class="form-control"
                            id="page_text_value_<?=$ids[10]?>" value="<?=$values[10]?>">

                        <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                            id="page_text_value_<?=$ids[11]?>"><?=$values[11]?></textarea>

                        <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                            id="page_text_value_<?=$ids[12]?>"><?=$values[12]?></textarea>
                    </div>
                </div>
                <div
                    class="col-lg-5 col-md-5 col-sm-12 pt-4 min-h600 rgt-block ml-auto d-flex flex-column align-items-center justify-content-center pb-5 mt-md-0  ">
                    <img src="../../assets/images/phone.png" alt="" class="mx-auto d-block img-fluid">
                    <div class="wrap-text">
                        <form action="">
                            <div class="form-group">
                                <label for="phone">Phone number:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg round-btn btn-block mt-4 main-btn btn-p" type="submit">Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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