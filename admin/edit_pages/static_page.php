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

    $static_page_unique_id = check_input($_GET['spuid']);

    $static_page_id = GetID_FromUniqueID($static_page_unique_id, "static_pages");

    if($static_page_id == 0)
        exit("");
    
    $query = "SELECT content, page_title, page_name FROM static_pages WHERE id = $static_page_id";

    $rows = QuerySelect($query);

    $content    = $rows[0]["content"];
    $page_title = $rows[0]["page_title"];
    $page_name  = $rows[0]["page_name"];


} else {
    exit("");
}

?>
<!DOCTYPE html>
<html lang="en">


<?=GetHeaderSummernote("Edit $page_name", "../.");?>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<body>
 
    <nav class="navbar navbar-dark bg-dark bg-light">
        <div class="container-xl d-flex justify-content-between">
            <h4 class="text-white"><?=$page_name?> - page edit</h4>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-light" type="button">Cancel</button>
                <button class="btn btn-light" type="button" 
                    onclick="SaveStaticPage(<?=$static_page_id?>)">Save</button>
            </form>
        </div>
    </nav>
    <div class="section-2 ">
        <div class="container">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4">
                    <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
          
                <input type="text" class="form-controls mt-2"
                            id="static_page_title" value="<?=$page_title?>">
               
            </div>
            <div class="col-sm-12">
            <textarea type="text" rows="6" cols="15" class="form-controls mt-5 summernote"
                        id="static_page_content"><?=$content?></textarea>
            </div>
        </div>
    </div>

    <?=getFooter("../.");?>


    <?=PopUpButtons()?>

</body>

    <?=getBottomScripts("../.");?>
<script type="text/javascript" src="../../js/admin.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
</html>