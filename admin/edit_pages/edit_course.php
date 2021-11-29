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

    $course_unique_id = check_input($_GET['cuid']);

    $course_id = GetID_FromUniqueID($course_unique_id, "courses");

    if($course_id == 0)
        exit("");
    
    $query = "SELECT course_text, course_name FROM courses WHERE id = $course_id";

    $rows = QuerySelect($query);

    $course_name = $rows[0]["course_name"];
    $course_text = $rows[0]["course_text"];

    // $course_text = str_replace("<>", replace, subject)

} else {
    exit("");
}

?>
<!DOCTYPE html>
<html lang="en">

<?=GetHeaderSummernote("Edit $course_name", "../.");?>



<body class="bg-white">
    <div class="container-wide mb100 bg-white"> 

        <div class="tab-pane" id="v_pills_active_course">

            <div class="container">
                <div class="d-flex justify-content-between align-items-center fixedpos mt-4 mb-4">
                    <h3 class="nopd">Edit <b><?=$course_name?></b> content</h3>
                    <div class="d-flex justify-content-between align-items-center">

                        <button type="button" class="btn black_btn w-300 btn-lg mr-20" style="margin-right: 20px" 
                                onclick="SaveCourseText(<?=$course_id?>); ">Save Course Content</button>
                    </div>

                </div>
                <textarea type="text" class="form-control mt-5 summernote" id="course_text" style="height: 500px !important"><?=$course_text?></textarea>
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