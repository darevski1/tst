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

<?=getHeader("Home Sellers Program", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Home Sellers", 4);?>
    <div class="home-sellers-hero">
        <div class="agents d-flex flex-column justify-content-center align-items-center">
            <div class="container-xl mb-5">

                <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>"
                    value="<?=$values[0]?>">

                <input type="text" name="edit_page_values" class="form-control mt-5" id="page_text_value_<?=$ids[1]?>"
                    value="<?=$values[1]?>">

            </div>
            <div class="container-xl">
                <div class="row no-gutters mt-5">
                    <div class="col-sm-6 mt-5">
                        <a href="" class="btn btn-small-mb btn-lg round-btn btn-block main-btn btn-p mt-5">
                            Get your free preliminary home value before and after renovation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-text-sellers-increase d-flex  justify-content-center align-items-center">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col text-center">
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="col-sm-12 mt-5">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[2]?>"
                        value="<?=$values[2]?>">
                    <div class="hrblue mb-5 mt-3"></div>
                    <textarea type="text" rows="6" name="edit_page_values" class="form-control"
                        id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>


                </div>
            </div>
        </div>
    </div>
    <div class="intro-text-sellers d-flex flex-column justify-content-center">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <!--
                    <h1 class="bold text-center mt-5 mb-5 sm-title-sm">Let's say your home is in poor orless than
                        average condition and could sell for $300,000.</h1> -->

                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="card pt-3 rounded_corners right-arrow" style="width: 18rem;">
                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <img src="../assets/images/img-h1.png" alt="">
                            </div>
                            <textarea type="text" rows="6" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[4]?>"><?=$values[4]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="card pt-3 rounded_corners right-arrow" style="width: 18rem;">
                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <img src="../assets/images/img-h2.png" alt="">
                            </div>
                            <textarea type="text" rows="6" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[5]?>"><?=$values[5]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="card pt-3 rounded_corners right-arrow" style="width: 18rem;">
                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <img src="../assets/images/img-h3.png" alt="">
                            </div>
                            <textarea type="text" rows="6" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[6]?>"><?=$values[6]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="card pt-3 rounded_corners" style="width: 18rem;">
                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <img src="../assets/images/img-h4.png" alt="">
                            </div>
                            <textarea type="text" rows="6" name="edit_page_values" class="form-control"
                                id="page_text_value_<?=$ids[7]?>"><?=$values[7]?></textarea>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-sm-12 mt-5">
                <textarea type="text" rows="3" name="edit_page_values" class="form-control"
                    id="page_text_value_<?=$ids[15]?>"><?=$values[15]?></textarea>
            </div>
        </div>
    </div>


    <div class="block_benefits pb-5">
        <div class="container-xl">
            <div class="row mt-5 mb-5">

                <div class="col-sm-10 offset-1">

                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[16]?>"
                        value="<?=$values[16]?>">
                </div>
            </div>
        </div>
        <div class="container-xl d-flex flex-column justify-content-center align-items-center">


            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[8]?>"
                        value="<?=$values[8]?>">
                </div>
            </div>

            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[9]?>"
                        value="<?=$values[9]?>">
                </div>
            </div>

            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[10]?>"
                        value="<?=$values[10]?>">
                </div>
            </div>

            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[11]?>"
                        value="<?=$values[11]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[12]?>"
                        value="<?=$values[12]?>">
                </div>
            </div>
            <div class="block_bt mb-3 d-flex align-items-center" data-aos="zoom-in-left">
                <div class="p-2 bd-highlight"><span> <i class="fas fa-check"></i> </span></div>
                <div class="p-2 bd-highlight col-sm-10 w-100">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[13]?>"
                        value="<?=$values[13]?>">
                </div>
            </div>
            <div class="col-sm-10">
                <textarea type="text" rows="3" name="edit_page_values" class="form-control"
                    id="page_text_value_<?=$ids[14]?>"><?=$values[14]?></textarea>
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