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
<?=getHeader("Selected Work ", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Selected Work", 12);?>
    <div class="intro-text-sellers-increase d-flex  justify-content-center align-items-center">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <input type="text" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">

                    <div class="hrblue mb-5 mt-3"></div>

                    <input type="text" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">
                    <div class="row no-gutters">
                        <div class="col-sm-12 d-flex justify-content-center text-center">
                            <button class="btn btn-small-mb btn-lg round-btn btn-block main-btn btn-p mt-5 max-300hs">
                                Sign In
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-pills-icons w-100" role="tablist">
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <div class="btn-style text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#dashboard-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">
                            </div>
                        </li>
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <a class="btn-style text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#schedule-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                            </a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <a class="btn-s tyle text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#tasks-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                            </a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <a class="btn-style text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#bedrooms-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                            </a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <a class="btn-style text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#bathrooms-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                            </a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center ">
                            <a class="btn-style text-center block-gallery pointer d-flex justify-content-center align-items-center rounded_corners card-shadow border-card"
                                href="#basement-1" role="tab" data-toggle="tab">
                                <input type="text" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-space mt-5">
                        <div class="tab-pane active" id="dashboard-1">

                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->


                        </div>
                        <div class="tab-pane" id="schedule-1">
                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->

                        </div>
                        <div class="tab-pane" id="tasks-1">
                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->

                        </div>
                        <div class="tab-pane" id="bedrooms-1">
                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->

                        </div>
                        <div class="tab-pane" id="bathrooms-1">
                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->

                        </div>
                        <div class="tab-pane" id="basement-1">
                            <div class="container">

                                <hr class="mt-2 mb-5">

                                <div class="row text-center text-lg-left photos">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-4.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-1.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-3.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-2.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-6">
                                        <a href="../assets/gallery/p_1/img-2.jpg" class="d-block mb-4 h-100"
                                            data-lightbox="photos">
                                            <img class="img-fluid img-thumbnail" src="../assets/gallery/p_1/img-4.jpg"
                                                alt="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container -->

                        </div>
                    </div>
                </div>
                <input type="text" name="edit_page_values" class="form-control mt-5" id="page_text_value_<?=$ids[8]?>"
                    value="<?=$values[8]?>">
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