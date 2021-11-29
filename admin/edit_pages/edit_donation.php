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

if (isset($_GET['cuid']) && $_GET['cuid'] != "") {

    $donation_unique_id = check_input($_GET['cuid']);

    $donation_id = GetID_FromUniqueID($donation_unique_id, "donations");

    if($donation_id == 0)
        exit("");
    
    $query = "SELECT donation_name, content FROM donations WHERE id = $donation_id";

    $rows = QuerySelect($query);

    $donation_name = $rows[0]["donation_name"];
    $donation_content = $rows[0]["content"];

} else {
    exit("");
}

?>
<!DOCTYPE html>
<html lang="en">

<?=GetHeaderSummernote("Edit $donation_name", "../.");?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


<body class="bg-white">
    <div class="container-wide mb100 bg-white"> 

        <div class="tab-pane" id="v_pills_active_course">

            <div class="container">
                <div class="d-flex justify-content-between align-items-center fixedpos mt-4 mb-4">
                    <h3 class="nopd">Edit <b><?=$donation_name?></b> content</h3>
                    <div class="d-flex justify-content-between align-items-center">

                        <button type="button" class="btn black_btn w-300 btn-lg mr-20" style="margin-right: 20px" 
                                onclick="SaveDonationText(<?=$donation_id?>); ">Save Donation Content</button>
                    </div>
                </div>
                <input type="text" value="<?=$donation_name?>" class="form-control mb-5" id="donation_name"/>
                <textarea type="text" class="form-control mt-5 summernote" id="donation_text" rows="5" 
                          style="height: 500px !important"><?=$donation_content?></textarea>
            </div>
        </div>
    </div>


    <?=PopUpButtons()?>
</body>

<?=getBottomScripts("../.")?>
<script type="text/javascript" src="../../js/admin.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

</html>