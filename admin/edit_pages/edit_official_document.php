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

if (isset($_GET['duid']) && $_GET['duid'] != "") {

    $document_unique_id = check_input($_GET['duid']);

    $document_id = GetID_FromUniqueID($document_unique_id, "documents");

    if($document_id == 0)
        exit("");
    
    $query = "SELECT document_name, content FROM documents WHERE id = $document_id";

    $rows = QuerySelect($query);

    $document_name = $rows[0]["document_name"];
    $content = $rows[0]["content"];

    // $content = "";
} else {
    exit("");
}

?>
<!DOCTYPE html>
<html lang="en">

<?=GetHeaderSummernote("Edit $document_name", "../.");?>



<body class="bg-white">
    <div class="container-wide mb100 bg-white"> 

        <div class="tab-pane" id="v_pills_active_course">

            <div class="container">
                <div class="d-flex justify-content-between align-items-center fixedpos mt-4 mb-4">
                    <h3 class="nopd">Edit <b><?=$document_name?></b> content</h3>
                    <div class="d-flex justify-content-between align-items-center">

                        <button type="button" class="btn black_btn w-300 btn-lg mr-20" style="margin-right: 20px" 
                                onclick="SaveDocumentText('<?=$document_unique_id?>'); ">Save Document Content</button>
                    </div>

                </div>
                <textarea type="text" class="form-control mt-5 summernote" id="document_text" style="height: 500px !important"><?=$content?></textarea>
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