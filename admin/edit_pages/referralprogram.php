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
<?=getHeader("Referral Program", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Referral Program", 9);?>
    <div class="hero_about d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 d-flex justify-content-center flex-column">
                    <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>"
                        value="<?=$values[0]?>">


                    <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                        id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>
                </div>

            </div>
        </div>
    </div>
    <!-- hero_login -->
    <div class="account_section">
        <div class="block-account">

        </div>
    </div>

    <div class="account_section_block">
        <div class="container d-flex justify-content-center">

            <div class="form-block2 p-3 nmt-450">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active bold text-center" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-selected="true">Refer a Friend</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link bold text-center" id="profile-tab" data-toggle="tab" href="#profile"
                            role="tab" aria-controls="profile" aria-selected="false">I have been referred</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane tab-pane-referal fade show active" id="home" role="tabpanel"
                        aria-labelledby="home-tab">


<input type="text" name="edit_page_values "  class="form-control mt-5"
                                        id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">

                        <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                        <div class="form-stl">

                            <form action="" onsubmit="return false">
                                <div class="form-group">

                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">

                                    <input type="text" name="referr_to_name_1" class="form-control"
                                        id="referr_to_name_1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                                    <input type="email" name="referr_to_email_1" class="form-control"
                                        id="referr_to_email_1">
                                </div>


                                <input type="text" name="edit_page_values " class="form-control mb-4 mt-4 "
                                    id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">

                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">

                                    <input type="text" name="referred_from_name_1" class="form-control"
                                        id="referred_from_name_1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[8]?>" value="<?=$values[8]?>">
                                    <input type="text" name="referred_from_email_1" class="form-control"
                                        id="referred_from_email_1">
                                </div>


                                <div class="alert alert-danger" role="alert" style="display: none" id="error_message_1">
                                </div>
                                <div class="alert alert-success" role="alert" style="display: none"
                                    id="success_message_1"></div>


                                <div class="form-group">
                                    <button type="button" onclick="Referr_1()"
                                        class="btn btn-lg round-btn btn-block main-btn btn-p mt-5">Submit</button>
                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="tab-pane tab-pane-referal fade" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">

                        <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id=" page_text_value_<?=$ids[9]?>" value="<?=$values[9]?>">
                        <!-- <h5 class="text-center mb-5 mt-2">We`d like to meet your friends we`ll <br />reward you for the
                intoduction.</h5> -->
                        <div class="form-stl">
                            <form action="">
                                <div class="form-group">

                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id=" page_text_value_<?=$ids[10]?>" value="<?=$values[10]?>">
                                    <input type="text" name="referr_to_name_2" class="form-control"
                                        id="referr_to_name_2_2">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[11]?>" value="<?=$values[11]?>">
                                    <input type="text" name="referr_to_email_2" class="form-control"
                                        id="referr_to_email_2">
                                </div>

                                <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id="page_text_value_<?=$ids[12]?>" value="<?=$values[12]?>">

                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id=" page_text_value_<?=$ids[13]?>" value="<?=$values[13]?>">
                                    <input type="text" name="referred_from_name_2" class="form-control"
                                        id="referred_from_name_2">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="edit_page_values " class="form-control mt-5"
                                        id=" page_text_value_<?=$ids[14]?>" value="<?=$values[14]?>">
                                    <input type="text" name="referred_from_email_2" class="form-control"
                                        id="referred_from_email_2">
                                </div>


                                <div class="alert alert-danger" role="alert" style="display: none" id="error_message_2">
                                </div>
                                <div class="alert alert-success" role="alert" style="display: none"
                                    id="success_message_2"></div>


                                <div class="form-group">
                                    <button type="button" onclick="Referr_2()"
                                        class="btn btn-lg round-btn btn-block main-btn btn-p mt-5">Submit
                                        Referral</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>

                <textarea type="text" rows="6" name="edit_page_values" class="form-control mt-5"
                                    id="page_text_value_<?=$ids[15]?>"><?=$values[15]?></textarea>

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