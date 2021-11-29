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
<?=getHeader("Other Service", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Other Service", 7);?>
    <div class="intro-text-sellers-increase d-flex  justify-content-center align-items-center">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>"
                        value="<?=$values[0]?>">
                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>


                    </h3>
                    <div class="hrblue mb-5 mt-3"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="selected_work">
        <div class="container">
            <div class="selected_work">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <div class="card rounded_corners other">
                                <div class="card-body">
                                    <input type="text" name="edit_page_values" class="form-control"
                                        id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">
                                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                                        id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-5">
                            <div class="card rounded_corners other">
                                <div class="card-body">
                                    <input type="text" name="edit_page_values" class="form-control"
                                        id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                                        id="page_text_value_<?=$ids[5]?>"><?=$values[5]?></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-5">
                            <div class="card rounded_corners other">
                                <div class="card-body">
                                    <input type="text" name="edit_page_values" class="form-control"
                                        id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                                        id="page_text_value_<?=$ids[7]?>"><?=$values[7]?></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-5">
                            <div class="card rounded_corners other">
                                <div class="card-body">
                                    <input type="text" name="edit_page_values" class="form-control"
                                        id="page_text_value_<?=$ids[8]?>" value="<?=$values[8]?>">
                                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                                        id="page_text_value_<?=$ids[9]?>"><?=$values[9]?></textarea>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-sm-12 mt-5">
                <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[10]?>"
                    value="<?=$values[10]?>">
            </div>
        </div>
    </div>
    <div class="contact mb-5">
        <div class="container-xl mt-2 mb-5">
            <div class="infoblock d-flex">
                <div class="col-sm-12 col-md-5 col-ld-5">
                    <div class="lf-block d-flex flex-column justify-content-center align-items-center referal_text">
                        <h3> Refer us to a home owner
                            that can benefit from our
                            services and
                            <span class="bold text-center">
                                receive. </span>
                        </h3>
                        <h1 class="bold mt-3">$500</h1>
                        <button class="btn btn-small-mb btn-lg round-btn btn-block main-btn btn-p mt-4">Refer a home
                            owner</button>

                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-ld-7 mtm-30">
                    <div class="form-contact ptb-50 ptb-50mb ">
                        <h2 class="text-center bold">Have a Question</h2>
                        <h4 class="text-center mb-5">Get in touch</h4>
                        <div class="form-stl">
                            <form action="">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="first_name" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Subject:</label>
                                    <input type="text" name="password" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Message</label>
                                    <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-lg round-btn btn-block main-btn btn-p mt-5">Send
                                    </button>
                                </div>
                            </form>
                        </div>
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